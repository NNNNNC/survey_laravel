<div style="width: 90%; margin:auto;">
    <div class="row">
        <div class="col-md-3">
            <label class="fw-bold mb-2" for="officeFilter">Select Office:</label>
            <select id="officeFilter" class="form-control">
                <option value="">All Offices</option> <!-- Default Option -->
                @foreach($offices as $office)
                <option value="{{ $office->id }}">{{ $office->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Total Responses Card -->
        <div class="col">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Total Responses</h5>
                    <p class="card-text display-4" id="officeSurveyCount"></p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Citizen's Charter Satisfaction</h5>
                    <p class="card-text display-4" id="ccSatisfaction"></p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Service Satisfaction</h5>
                    <p class="card-text display-4" id="serviceSatisfaction"></p>
                </div>
            </div>
        </div>

        <!-- Overall Satisfaction Card -->
        <div class="col">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Overall Satisfaction</h5>
                    <p class="card-text display-4" id="overallSatisfaction"></p>
                </div>
            </div>
        </div>


    </div>


    <div class="row">
        <div class="col-md-3 ">
            <div class="card">
                <div class="card-body text-center">
                    <h4 class="card-title fw-bold">Sex Distribution</h4>
                    <div style="width: 80%; margin: auto;">
                        <canvas id="sexChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <h4 class="card-title fw-bold">Age Distribution</h4>
                    <div style="width: 80%; margin: auto;">
                        <canvas id="ageChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <h4 class="card-title fw-bold">Client Type Distribution by Month</h4>
                    <canvas id="clientTypeChart" height="195"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <h4 class="card-title fw-bold">Citizen's Charter(CC) Questions</h4>
                    <canvas id="ratingsChart" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    let sexChart, ageChart, clientTypeChart, ratingsChart;

    function createCharts(data, clientData) {
        if (sexChart) sexChart.destroy();
        if (ageChart) ageChart.destroy();
        if (clientTypeChart) clientTypeChart.destroy();
        if (ratingsChart) ratingsChart.destroy();

        const ctxSex = document.getElementById("sexChart").getContext("2d");
        const ctxAge = document.getElementById("ageChart").getContext("2d");
        const ctxClientType = document.getElementById("clientTypeChart")?.getContext("2d");
        // const ctxRatings = document.getElementById("ratingsChart")?.getContext("2d");
        // Handle missing or undefined age_distribution
        const ageLabels = data.age_distribution ? Object.keys(data.age_distribution) : [];
        const ageValues = data.age_distribution ? Object.values(data.age_distribution) : [];

        // Bar Chart for Ratings
        // Extract unique rating titles for x-axis
        const category = ['awareness', 'helpfulness', 'visibility'];
        const ratingLabels = data.rating_counts.map(item => item.rating);
        // Extract count values for y-axis
        const ratingCounts = data.rating_counts.map(item => item.count);


        const ratingCountsMap = Object.fromEntries(
            data.rating_counts.map(item => [item.rating, item.count])
        );

        if (typeof ratingsChart !== "undefined" && ratingsChart !== null) {
            ratingsChart.destroy();
        }

        const ctxRatings = document.getElementById("ratingsChart").getContext("2d");

        // Define colors for each category
        const categoryColors = {
            "Awareness": "#3498db",
            "Helpfulness": "#2ecc71",
            "Visibility": "#e74c3c"
        };

        // Map category values to readable names
        const categoryMap = {
            "awareness": "Awareness",
            "helpfulness": "Helpfulness",
            "visibility": "Visibility"
        };

        // Group data by category
        const groupedData = {};
        data.rating_counts.forEach(({
            category,
            rating,
            count
        }) => {
            const categoryName = categoryMap[category] || category;
            if (!groupedData[categoryName]) {
                groupedData[categoryName] = {};
            }
            groupedData[categoryName][rating] = count;
        });

        // Extract unique categories and ratings
        const categories = [...new Set(data.rating_counts.map(item => categoryMap[item.category] || item.category))];
        const allRatings = [...new Set(data.rating_counts.map(d => d.rating))];

        // Prepare datasets dynamically (grouped by category)
        const datasets = categories.map(category => ({
            label: category, // Use mapped category name
            backgroundColor: categoryColors[category] || "#95a5a6",
            data: allRatings.map(rating => groupedData[category]?.[rating] || 0)
        }));

        // Debugging
        console.log("Grouped Data:", groupedData);
        console.log("Categories (Mapped):", categories);
        console.log("All Ratings:", allRatings);

        // Generate the chart
        ratingsChart = new Chart(ctxRatings, {
            type: "bar",
            data: {
                labels: allRatings, // Ratings as labels
                datasets: datasets
            },
            options: {
                indexAxis: 'y',

                responsive: true,
                plugins: {
                    legend: {
                        position: "top"
                    }
                },
                scales: {
                    x: {
                        stacked: true,
                        title: {
                            display: true,
                            text: "Total Responses"
                        },
                        ticks: {
                            autoSkip: false,
                            maxRotation: 45,
                            minRotation: 0
                        }
                    },
                    y: {
                        stacked: true,
                        title: {
                            display: true,
                            text: "CC Questions"
                        }
                    }
                }
            }
        });

        sexChart = new Chart(ctxSex, {
            type: "doughnut",
            data: {
                labels: ["Male", "Female"],
                datasets: [{
                    data: [data.male_count || 0, data.female_count || 0],
                    backgroundColor: ["#3498db", "#e74c3c"]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "right"
                    }
                }
            }
        });

        // Doughnut Chart for Age Distribution
        ageChart = new Chart(ctxAge, {
            type: "doughnut",
            data: {
                labels: ageLabels,
                datasets: [{
                    data: ageValues,
                    backgroundColor: ["#1abc9c", "#f39c12", "#9b59b6", "#e67e22", "#2ecc71"]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "right"
                    }
                }
            }
        });


        if (clientData) {
            const groupedData = {};
            clientData.forEach(({
                month,
                client_type,
                count
            }) => {
                if (!groupedData[month]) {
                    groupedData[month] = {};
                }
                groupedData[month][client_type] = count;
            });

            // Month mapping
            const monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            const months = Object.keys(groupedData)
                .map(Number) // Convert to numbers for sorting
                .sort((a, b) => a - b) // Sort numerically
                .map(m => monthNames[m - 1]); // Convert to month names

            const clientTypes = [...new Set(clientData.map(d => d.client_type))];

            // Define specific colors for each client type
            const clientColors = {
                "Business": "#3498db", // Blue
                "Citizen": "#2ecc71", // Green
                "Government": "#e74c3c" // Red
            };

            const datasets = clientTypes.map(type => ({
                label: type,
                data: months.map((month, index) => groupedData[index + 1]?.[type] || 0),
                backgroundColor: clientColors[type] || "#95a5a6" // Default Gray if unknown type
            }));

            clientTypeChart = new Chart(ctxClientType, {
                type: "bar",
                data: {
                    labels: months,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: "Month"
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: "Number of Clients"
                            }
                        }
                    }
                }
            });
        }


    }

    function fetchSurveyData(officeId = "") {
        var surveyCountElement = document.getElementById("officeSurveyCount");
        var satisfactionElement = document.getElementById("overallSatisfaction");
        var ccSatisfactionElement = document.getElementById("ccSatisfaction");
        var serviceSatisfactionElement = document.getElementById("serviceSatisfaction");

        if (!surveyCountElement || !satisfactionElement || !ccSatisfactionElement || !serviceSatisfactionElement) {
            console.error("One or more survey elements not found.");
            return;
        }

        fetch("{{ route('survey.data') }}?office_id=" + encodeURIComponent(officeId))
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok " + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                surveyCountElement.textContent = data.total_responses || "0";
                satisfactionElement.textContent = data.overall_satisfaction || "0%";
                ccSatisfactionElement.textContent = data.cc_satisfaction_percentage || "0%";
                serviceSatisfactionElement.textContent = data.service_satisfaction_percentage || "0%";

                if (data.client_type_data && Array.isArray(data.client_type_data)) {
                    createCharts(data, data.client_type_data);
                } else {
                    console.warn("Invalid or missing client_type_data.");
                    createCharts(data, []);
                }
            })
            .catch(error => {
                console.error("Error fetching survey data:", error);
                surveyCountElement.textContent = "Error";
                satisfactionElement.textContent = "Error";
                ccSatisfactionElement.textContent = "Error";
                serviceSatisfactionElement.textContent = "Error";
            });
    }

    // Ensure the element exists before adding an event listener
    document.addEventListener("DOMContentLoaded", function() {
        var officeFilter = document.getElementById("officeFilter");
        if (officeFilter) {
            officeFilter.addEventListener("change", function() {
                fetchSurveyData(this.value);
            });
        } else {
            console.error("Office filter dropdown not found.");
        }

        fetchSurveyData(""); // Fetch initial data on page load
    });
</script>