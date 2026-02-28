@extends('layouts.admin')

@section('header_title', 'Detailed Analytics')

@section('content')
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-transparent border-bottom py-3">
            <h5 class="mb-0 fw-bold">Traffic & Application Trends (Last 30 Days)</h5>
        </div>
        <div class="card-body">
            <div style="height: 400px; width: 100%;">
                <canvas id="detailedChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Future: Add Geography or Category Breakdown here -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('detailedChart').getContext('2d');

            // Create Gradients
            let gradientViews = ctx.createLinearGradient(0, 0, 0, 400);
            gradientViews.addColorStop(0, 'rgba(59, 130, 246, 0.4)'); // Bright Blue
            gradientViews.addColorStop(1, 'rgba(59, 130, 246, 0.0)');

            let gradientApplies = ctx.createLinearGradient(0, 0, 0, 400);
            gradientApplies.addColorStop(0, 'rgba(16, 185, 129, 0.4)'); // Emerald Green
            gradientApplies.addColorStop(1, 'rgba(16, 185, 129, 0.0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartData['labels']) !!},
                    datasets: [{
                        label: 'Job Views',
                        data: {!! json_encode($chartData['views']) !!},
                        borderColor: '#3b82f6',
                        backgroundColor: gradientViews,
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#3b82f6',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }, {
                        label: 'Applied',
                        data: {!! json_encode($chartData['applies']) !!},
                        borderColor: '#10b981',
                        backgroundColor: gradientApplies,
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#10b981',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            align: 'end',
                            labels: {
                                usePointStyle: true,
                                boxWidth: 8,
                                font: {
                                    family: "'Inter', sans-serif",
                                    size: 13
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.95)',
                            titleColor: '#1e293b',
                            bodyColor: '#475569',
                            borderColor: '#e2e8f0',
                            borderWidth: 1,
                            padding: 12,
                            displayColors: true,
                            boxPadding: 4,
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 13
                            },
                            callbacks: {
                                label: function (context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += context.parsed.y;
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                font: {
                                    size: 11
                                },
                                color: '#64748b'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [4, 4],
                                color: '#f1f5f9',
                                drawBorder: false
                            },
                            ticks: {
                                precision: 0,
                                color: '#64748b',
                                padding: 10
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection