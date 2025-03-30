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
        <div class="row mt-4 mb-4 g-3 justify-content-center">
            <div class="col-lg-2 col-md-6">
                <div class="card text-white bg-success h-100 text-center">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h5 class="card-title fw-bold">Total Responses</h5>
                        <p class="card-text display-4" id="officeSurveyCount"></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <div class="comment_card card text-white bg-primary h-100 text-center" data-bs-toggle="modal" data-bs-target="#commentsModal" style="cursor: pointer;">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h5 class="card-title fw-bold">Total Comments</h5>
                        <p class="card-text display-4" id="totalComments"></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-info h-100 text-center">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h5 class="card-title fw-bold">Citizen's Charter Satisfaction</h5>
                        <p class="card-text display-4" id="ccSatisfaction"></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <div class="card text-white bg-danger h-100 text-center">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h5 class="card-title fw-bold">Service Satisfaction</h5>
                        <p class="card-text display-4" id="serviceSatisfaction"></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <div class="card text-white bg-warning h-100 text-center">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h5 class="card-title fw-bold">Overall Satisfaction</h5>
                        <p class="card-text display-4" id="overallSatisfaction"></p>
                    </div>
                </div>
            </div>
        </div>




    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body text-center">
                    <h4 class="card-title fw-bold">Sex Distribution</h4>
                    <div style="margin: auto;">
                        <canvas id="sexChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body text-center">
                    <h4 class="card-title fw-bold">Age Distribution</h4>
                    <div style="margin: auto; width: 90%; height: 100%;">
                        <canvas id="ageChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card">
                <div class="card-body text-center">
                    <h4 class="card-title fw-bold">Service Distribution</h4>
                    <div class="container-fluid" style="width: 80%; height: 100%;">
                        <canvas id="serviceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <h4 class="card-title fw-bold">Client Type Distribution on 2025</h4>
                    <canvas id="clientTypeChart"></canvas>
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

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title fw-bold text-center mb-3">Service Satisfaction Ratings</h4>

                    <!-- List in Two Columns -->
                    <div class="d-flex justify-content-center">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><strong>SQD0:</strong></td>
                                            <td>I am satisfied with the service that I availed.</td>
                                        </tr>
                                        <tr>
                                            <td><strong>SQD1:</strong></td>
                                            <td>I spent a reasonable amount of time for my transaction.</td>
                                        </tr>
                                        <tr>
                                            <td><strong>SQD2:</strong></td>
                                            <td>The office followed the transaction's requirements and steps.</td>
                                        </tr>
                                        <tr>
                                            <td><strong>SQD3:</strong></td>
                                            <td>The steps for my transaction were easy and simple.</td>
                                        </tr>
                                        <tr>
                                            <td><strong>SQD4:</strong></td>
                                            <td>I easily found information about my transaction.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><strong>SQD5:</strong></td>
                                            <td>I paid a reasonable amount of fees for my transaction.</td>
                                        </tr>
                                        <tr>
                                            <td><strong>SQD6:</strong></td>
                                            <td>I feel the office was fair to everyone, or "walang palakasan".</td>
                                        </tr>
                                        <tr>
                                            <td><strong>SQD7:</strong></td>
                                            <td>I was treated courteously by the staff.</td>
                                        </tr>
                                        <tr>
                                            <td><strong>SQD8:</strong></td>
                                            <td>I got what I needed from the government office.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <!-- Chart Canvas -->
                    <div class="text-center mt-3">
                        <canvas id="sqdChart" height="120"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Comments Modal -->

<div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="commentsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fw-bold" id="commentsModalLabel">Client Reviews</h2>
                <button type="button" class="btn-close" onclick="window.location.href='/admin'" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
                <div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label for="startDate">Start Date:</label>
                                    <input type="date" id="startDate">
                                </div>
                                <div class="col">
                                    <label for="endDate">End Date:</label>
                                    <input type="date" id="endDate">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <button onclick="filterComments()">Filter</button>
                        </div>
                    </div>





                </div>

                <ul id="commentsList" class="list-unstyled"></ul>
                <ul id="commentsList" class="list-unstyled"></ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    let sexChart, ageChart, serviceChart, clientTypeChart, ratingsChart, sqdChart;

    function createCharts(data, clientData) {
        if (sexChart) sexChart.destroy();
        if (ageChart) ageChart.destroy();
        if (clientTypeChart) clientTypeChart.destroy();
        if (ratingsChart) ratingsChart.destroy();
        if (sqdChart) sqdChart.destroy();
        if (serviceChart) serviceChart.destroy();


        const ctxSex = document.getElementById("sexChart").getContext("2d");
        const ctxAge = document.getElementById("ageChart").getContext("2d");
        const ctxClientType = document.getElementById("clientTypeChart")?.getContext("2d");
        const ctxRatings = document.getElementById("ratingsChart").getContext("2d");
        const ctxSqd = document.getElementById("sqdChart")?.getContext("2d");
        const ctxService = document.getElementById("serviceChart")?.getContext("2d");

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
                        position: "right",
                        labels: {
                            boxWidth: 15,
                            font: {
                                size: 14
                            }
                        }
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
                        position: "right",
                        labels: {
                            boxWidth: 15,
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });

        const service_labels = data.service_responses.map(item => item.name);
        const service_values = data.service_responses.map(item => item.total_response);
        const backgroundColors = [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
            '#FF9F40', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
            '#9966FF', '#FF9F40', '#FF6384', '#36A2EB', '#FFCE56'
        ];

        serviceChart = new Chart(ctxService, {
            type: "doughnut",
            data: {
                labels: service_labels,
                datasets: [{
                    data: service_values,
                    backgroundColor: backgroundColors
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "right",
                        labels: {
                            boxWidth: 15,
                            font: {
                                size: 14
                            }
                        }
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
                                display: false,
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

        // Step 1: Collect all unique SQD categories for the X-axis
        const sqdCategories = [...new Set(data.sqd_counts.map(item => item.category))];

        // Step 2: Initialize an object to hold dataset values
        const ratingData = {};

        const sqdLabels = {
            0: "N/A",
            1: "Strongly Disagree",
            2: "Disagree",
            3: "Neither Agree nor Disagree",
            4: "Agree",
            5: "Strongly Agree"
        };

        const ratingColors = {
            0: "#A9A9A9", // Gray - N/A
            1: "#FF4C4C", // Red - Strongly Disagree
            2: "#FFA500", // Orange - Disagree
            3: "#FFD700", // Yellow - Neither Agree nor Disagree
            4: "#32CD32", // Green - Agree
            5: "#4682B4" // Blue - Strongly Agree
        };



        // Initialize each rating label with an empty dataset for every category
        Object.keys(sqdLabels).forEach(rating => {
            ratingData[rating] = {
                label: sqdLabels[rating], // Satisfaction rating label
                data: Array(sqdCategories.length).fill(0), // Default 0 count per SQD category
                backgroundColor: ratingColors[rating]
            };
        });

        // Step 3: Populate the datasets with actual counts
        data.sqd_counts.forEach(({
            category,
            rating,
            count
        }) => {
            const categoryIndex = sqdCategories.indexOf(category);
            if (categoryIndex !== -1) {
                ratingData[rating].data[categoryIndex] = count;
            }
        });

        // Step 4: Convert ratingData into an array for Chart.js
        const sqdDatasets = Object.values(ratingData);

        // Step 5: Create the chart
        if (ctxSqd) {
            sqdChart = new Chart(ctxSqd, { // Use global sqdChart variable
                type: "bar",
                data: {
                    labels: sqdCategories,
                    datasets: sqdDatasets
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {

                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        } else {
            console.error("Chart context (ctxSqd) is not defined.");
        }

    }

    function fetchSurveyData(officeId = "") {
        var surveyCountElement = document.getElementById("officeSurveyCount");
        var commentCountElement = document.getElementById("totalComments");
        var satisfactionElement = document.getElementById("overallSatisfaction");
        var ccSatisfactionElement = document.getElementById("ccSatisfaction");
        var serviceSatisfactionElement = document.getElementById("serviceSatisfaction");
        var commentsList = document.getElementById("commentsList");

        if (!surveyCountElement || !commentCountElement || !satisfactionElement || !ccSatisfactionElement || !serviceSatisfactionElement || !commentsList) {
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
                commentCountElement.textContent = data.comments_count || "0";
                satisfactionElement.textContent = data.overall_satisfaction || "0%";
                ccSatisfactionElement.textContent = data.cc_satisfaction_percentage || "0%";
                serviceSatisfactionElement.textContent = data.service_satisfaction_percentage || "0%";

                if (data.client_type_data && Array.isArray(data.client_type_data)) {
                    createCharts(data, data.client_type_data);
                } else {
                    console.warn("Invalid or missing client_type_data.");
                    createCharts(data, []);
                }

                // Populate comments modal
                commentsList.innerHTML = ""; // Clear previous comments
                if (data.email_comments && Array.isArray(data.email_comments)) {

                    commentsList.style.listStyle = "none";

                    data.email_comments.forEach(entry => {
                        let email = entry.email ? entry.email : "Anonymous";
                        let commentItem = document.createElement("li");
                        commentItem.classList.add("border-bottom", "py-2");

                        commentItem.innerHTML =
                            `<p style="font-size: 16px;">
                            <strong class="text-primary">${email}:</strong> <br>
                            <small class="text-muted" style="font-size: 14px;">${entry.created_at}</small><br><br>
                            <span style="font-size: 18px;">${entry.comments}</span>
                            </p>`;
                        commentsList.appendChild(commentItem);
                    });
                } else {
                    console.warn("No email comments found or invalid format.");
                    let noCommentItem = document.createElement("li");
                    noCommentItem.classList.add("list-group-item", "text-muted");
                    noCommentItem.textContent = "No comments available.";
                    commentsList.appendChild(noCommentItem);
                }
            })
            .catch(error => {
                console.error("Error fetching survey data:", error);
                surveyCountElement.textContent = "Error";
                commentCountElement.textContent = "Error";
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

        var totalCommentsCard = document.querySelector(".comment_card");
        var commentsModal = document.getElementById("commentsModal");

        if (totalCommentsCard && commentsModal) {
            totalCommentsCard.addEventListener("click", function() {
                let myModal = new bootstrap.Modal(commentsModal);
                myModal.show();
            });
        } else {
            if (!totalCommentsCard) console.error("Total Comments card not found.");
            if (!commentsModal) console.error("Modal with ID 'commentsModal' not found.");
        }
    });
</script>
