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
    <div class="col-md-9">
        <div class="card">
            <div class="card-body text-center">
                <h6 class="card-title">Client Type Distribution by Month</h6>
                <canvas id="clientTypeChart"></canvas>
            </div>
        </div>
    </div>
</div>






<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let sexChart, ageChart, clientTypeChart;

    function createCharts(data, clientData) {
        if (sexChart) sexChart.destroy();
        if (ageChart) ageChart.destroy();
        if (clientTypeChart) clientTypeChart.destroy();

        const ctxSex = document.getElementById("sexChart").getContext("2d");
        const ctxAge = document.getElementById("ageChart").getContext("2d");
        const ctxClientType = document.getElementById("clientTypeChart").getContext("2d");

        // Handle missing or undefined age_distribution
        const ageLabels = data.age_distribution ? Object.keys(data.age_distribution) : [];
        const ageValues = data.age_distribution ? Object.values(data.age_distribution) : [];

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
                    legend: { position: "right" }
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
                    legend: { position: "right" }
                }
            }
        });

        // Client Type Bar Chart
        if (clientData) {
            const groupedData = {};
            clientData.forEach(({ month, client_type, count }) => {
                if (!groupedData[month]) {
                    groupedData[month] = {};
                }
                groupedData[month][client_type] = count;
            });

            const months = Object.keys(groupedData).sort();
            const clientTypes = [...new Set(clientData.map(d => d.client_type))];

            const datasets = clientTypes.map(type => ({
                label: type,
                data: months.map(month => groupedData[month][type] || 0),
                backgroundColor: getRandomColor()
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
                        x: { title: { display: true, text: "Month" } },
                        y: { title: { display: true, text: "Number of Clients" } }
                    }
                }
            });
        }
    }

    function getRandomColor() {
        return `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.6)`;
    }

    function fetchSurveyData(officeId = "") {
        var surveyCountElement = document.getElementById("officeSurveyCount");
        var satisfactionElement = document.getElementById("overallSatisfaction");

        fetch("{{ route('survey.data') }}?office_id=" + officeId)
            .then(response => response.json())
            .then(data => {
                surveyCountElement.textContent = data.total_responses || "0";
                satisfactionElement.textContent = data.overall_satisfaction || "0";
                createCharts(data, data.client_type_data || []);
            })
            .catch(error => {
                console.error("Error fetching data:", error);
                surveyCountElement.textContent = "Error";
                satisfactionElement.textContent = "Error";
            });
    }

    document.getElementById("officeFilter").addEventListener("change", function() {
        fetchSurveyData(this.value);
    });

    window.onload = function() {
        fetchSurveyData("");
    };
</script>
