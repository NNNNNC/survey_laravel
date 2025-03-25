<div class="row mt-4">
    <div class="col-md-3">
        <label for="officeFilter">Select Office:</label>
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
    <div class="col-md-6">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Responses</h5>
                <p class="card-text display-4" id="officeSurveyCount"></p>
            </div>
        </div>
    </div>

    <!-- Overall Satisfaction Card -->
    <div class="col-md-6">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Overall Satisfaction</h5>
                <p class="card-text display-4" id="overallSatisfaction"></p>
            </div>
        </div>
    </div>
</div>


<div class="row mt-2">
    <div class="col-md-3">
        <!-- Sex Distribution Chart -->
        <div class="card mb-3">
            <div class="card-body text-center">
                <h6 class="card-title">Sex Distribution</h6>
                <canvas id="sexChart" style="max-width: 200px; max-height: 200px;"></canvas>
            </div>
        </div>

        <!-- Age Distribution Chart -->
        <div class="card">
            <div class="card-body text-center">
                <h6 class="card-title">Age Distribution</h6>
                <canvas id="ageChart" style="max-width: 200px; max-height: 200px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Client Type Chart -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-body text-center">
                <h6 class="card-title">Client Type Distribution by Month</h6>
                <canvas id="clientTypeChart" width="600" height="238"></canvas>
            </div>
        </div>
    </div>
</div>

<canvas id="ratingsChart"></canvas>

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
        const ctxRatings = document.getElementById("ratingsChart")?.getContext("2d");

        // Handle missing or undefined age_distribution
        const ageLabels = data.age_distribution ? Object.keys(data.age_distribution) : [];
        const ageValues = data.age_distribution ? Object.values(data.age_distribution) : [];

        // Bar Chart for Ratings
        const categories = ["awareness", "visibility", "helpfulness"];

        const ratingsMap = {
            awareness: [
                "Knows what a CC and saw the office’s CC",
                "Knows what a CC but did not see the office’s CC",
                "Learned the CC by seeing the office’s CC",
                "Do not know and did not see the office’s CC"
            ],
            visibility: [
                "N/A",
                "Not visible",
                "Difficult to see",
                "Somewhat easy to see",
                "Easy to see"
            ],
            helpfulness: [
                "N/A",
                "Did not help",
                "Somewhat helped",
                "Helped very much"
            ]
        };

        // Assign colors for differentiation
        const ratingColors = [
            "#1f77b4", "#ff7f0e", "#2ca02c", "#d62728", "#9467bd",
            "#8c564b", "#e377c2", "#7f7f7f", "#bcbd22", "#17becf"
        ];

        const datasets = [];
        let colorIndex = 0;

        // Loop through each category and rating to create datasets
        categories.forEach(category => {
            ratingsMap[category].forEach(rating => {
                const count = (data.rating_counts || []).find(r => r.category === category && r.rating === rating)?.count || 0;

                datasets.push({
                    label: rating,
                    data: categories.map(c => (c === category ? count : 0)), // Place count in correct category position
                    backgroundColor: ratingColors[colorIndex % ratingColors.length] // Assign unique colors
                });

                colorIndex++;
            });
        });

        ratingsChart = new Chart(ctxRatings, {
            type: "bar",
            data: {
                labels: categories, // Awareness, Visibility, Helpfulness
                datasets: datasets
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: "Categories"
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: "Count"
                        },
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: "right", // Move legend to the right
                        align: "start", // Align legend items vertically
                        labels: {
                            boxWidth: 15, // Adjusts legend box size
                            padding: 10, // Adds spacing between legend items
                        }
                    }
                }
            }
        });


        // Doughnut Chart for Sex Distribution
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

        // Fixing Date Order for Client Type Bar Chart
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

        if (!surveyCountElement || !satisfactionElement) {
            console.error("Survey count or satisfaction elements not found.");
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
                satisfactionElement.textContent = data.overall_satisfaction || "0";

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