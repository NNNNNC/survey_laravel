<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Survey Data by Office</h4>
            </div>
            <div class="card-body">
                <!-- Office Filter -->
                <div class="mb-3">
                    <label for="officeFilter">Filter by Office:</label>
                    <select id="officeFilter" class="form-control">
                        <option value="">All Offices</option>
                        @foreach($offices as $office)
                            <option value="{{ $office->id }}">{{ $office->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Chart -->
                <canvas id="surveyChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let ctx = document.getElementById('surveyChart').getContext('2d');
    let surveyChart;

    function loadChart(officeId = '') {
        fetch(`/admin/survey-data?office_id=${officeId}`)
            .then(response => response.json())
            .then(data => {
                let labels = data.map(item => item.office_name);
                let awareness = data.map(item => item.avg_awareness);
                let visibility = data.map(item => item.avg_visibility);
                let helpfulness = data.map(item => item.avg_helpfulness);

                if (surveyChart) {
                    surveyChart.destroy();
                }

                surveyChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Awareness',
                                data: awareness,
                                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            },
                            {
                                label: 'Visibility',
                                data: visibility,
                                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            },
                            {
                                label: 'Helpfulness',
                                data: helpfulness,
                                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    }

    document.getElementById('officeFilter').addEventListener('change', function () {
        loadChart(this.value);
    });

    loadChart();
});
</script>