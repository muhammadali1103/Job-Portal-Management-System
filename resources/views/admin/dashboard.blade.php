@extends('layouts.admin')

@section('header_title', 'Dashboard Overview')

@section('content')
    <!-- Overview Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Jobs -->
        <div class="col-xl-3 col-sm-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-sm bg-indigo-subtle text-indigo rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #e0e7ff; color: #4338ca;">
                                <i class="bi bi-briefcase-fill fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1 text-uppercase fw-semibold fs-7" style="font-size: 0.75rem;">Total Jobs</p>
                            <h4 class="mb-0 fw-bold">{{ number_format($stats['total_jobs']) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Approval -->
        <div class="col-xl-3 col-sm-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-sm bg-warning-subtle text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #fef3c7; color: #d97706;">
                                <i class="bi bi-clock-fill fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1 text-uppercase fw-semibold" style="font-size: 0.75rem;">Pending Approval</p>
                            <h4 class="mb-0 fw-bold">{{ number_format($stats['pending_jobs']) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="col-xl-3 col-sm-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-sm bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #dcfce7; color: #15803d;">
                                <i class="bi bi-people-fill fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1 text-uppercase fw-semibold" style="font-size: 0.75rem;">Total Users</p>
                            <h4 class="mb-0 fw-bold">{{ number_format($stats['total_users']) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Total Applications -->
        <div class="col-xl-3 col-sm-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-sm bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #dbeafe; color: #1e40af;">
                                <i class="bi bi-file-earmark-text-fill fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1 text-uppercase fw-semibold" style="font-size: 0.75rem;">Applied</p>
                            <h4 class="mb-0 fw-bold">{{ number_format($stats['total_applications']) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .nav-pills .nav-link {
            color: #64748b;
            font-weight: 600;
            background: #f1f5f9;
            margin: 0 4px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .nav-pills .nav-link:hover {
            background: #e2e8f0;
            color: #334155;
        }
        .nav-pills .nav-link.active {
            background: #4f46e5;
            color: #ffffff !important;
        }
        .chart-container {
            position: relative;
            height: 220px;
            width: 220px;
            margin: 0 auto;
        }
        .chart-center-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>

    <!-- Analytics Section -->
    <div class="row mb-4">
        <!-- Performance Stats (Left) -->
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-2 px-4">
                    <h5 class="mb-0 fw-bold text-dark">Performance Overview</h5>
                    <p class="text-muted small mb-0">Track engagement metrics over different time periods.</p>
                </div>
                <div class="card-body px-4">
                    <ul class="nav nav-pills nav-fill mb-4" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active py-2" id="pills-daily-tab" data-bs-toggle="pill" data-bs-target="#pills-daily" type="button" role="tab">Daily</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link py-2" id="pills-weekly-tab" data-bs-toggle="pill" data-bs-target="#pills-weekly" type="button" role="tab">Weekly</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link py-2" id="pills-monthly-tab" data-bs-toggle="pill" data-bs-target="#pills-monthly" type="button" role="tab">Monthly</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        @foreach(['daily', 'weekly', 'monthly'] as $period)
                            <div class="tab-pane {{ $period === 'daily' ? 'show active' : '' }}" id="pills-{{ $period }}" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="p-3 rounded-4" style="background: linear-gradient(135deg, #e0e7ff 0%, #fae8ff 100%);">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <p class="text-indigo fw-bold mb-1 small text-uppercase" style="color: #4338ca;">Jobs Posted</p>
                                                    <h3 class="mb-0 fw-bold text-dark">{{ number_format($timeStats[$period]['jobs_posted']) }}</h3>
                                                </div>
                                                <div class="bg-white p-2 rounded-circle shadow-sm">
                                                    <i class="bi bi-briefcase-fill fs-5" style="color: #4338ca;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 bg-light rounded-4 h-100 border border-light-subtle">
                                            <p class="text-muted fw-bold mb-1 small text-uppercase">Views</p>
                                            <h4 class="mb-0 fw-bold text-dark">{{ number_format($timeStats[$period]['views']) }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 bg-light rounded-4 h-100 border border-light-subtle">
                                            <p class="text-muted fw-bold mb-1 small text-uppercase">Applied</p>
                                            <h4 class="mb-0 fw-bold text-success">{{ number_format($timeStats[$period]['clicks']) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Deep Analytics Charts (Right) -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Deep Analytics</h5>
                        <p class="text-muted small mb-0">Engagement & Device Breakdown</p>
                    </div>
                    <!-- Chart Filter Tabs -->
                    <ul class="nav nav-pills nav-pills-sm" id="chart-tab" role="tablist" style="font-size: 0.75rem;">
                        <li class="nav-item">
                            <button class="nav-link active px-2 py-1" id="chart-daily-tab" data-bs-toggle="pill" data-bs-target="#chart-daily" type="button">1D</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link px-2 py-1" id="chart-weekly-tab" data-bs-toggle="pill" data-bs-target="#chart-weekly" type="button">7D</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link px-2 py-1" id="chart-monthly-tab" data-bs-toggle="pill" data-bs-target="#chart-monthly" type="button">30D</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="chart-tabContent">
                        @foreach(['daily', 'weekly', 'monthly'] as $period)
                            <div class="tab-pane fade {{ $period === 'daily' ? 'show active' : '' }}" id="chart-{{ $period }}" role="tabpanel">
                                <div class="row align-items-center">
                                    <!-- Conversion Pie -->
                                    <div class="col-sm-6 text-center mb-4 mb-sm-0">
                                        <h6 class="text-muted text-uppercase small fw-bold mb-3">Engagement</h6>
                                        <div style="height: 180px; width: 180px; margin: 0 auto;">
                                            <canvas id="pieChart-{{ $period }}"></canvas>
                                        </div>
                                    </div>
                                    <!-- Device Pie -->
                                    <div class="col-sm-6 text-center">
                                        <h6 class="text-muted text-uppercase small fw-bold mb-3">Devices</h6>
                                        <div style="height: 180px; width: 180px; margin: 0 auto;">
                                            <canvas id="deviceChart-{{ $period }}"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chart.js Default Config
            Chart.defaults.font.family = "'Inter', sans-serif";
            
            const periods = ['daily', 'weekly', 'monthly'];
            const chartData = {!! json_encode($chartStats) !!};

            periods.forEach(period => {
                // 1. Engagement Pie Chart (Views vs Applied)
                // Actually Drop-off vs Applied makes more sense for a pie, or Views vs Applied (if applied is part of views).
                // Let's do Applied vs Drop-off (Views - Applied)
                let views = chartData[period].views;
                let applied = chartData[period].applies;
                let dropoff = Math.max(0, views - applied);

                new Chart(document.getElementById('pieChart-' + period), {
                    type: 'pie',
                    data: {
                        labels: ['Applied', 'Drop-off'],
                        datasets: [{
                            data: [applied, dropoff],
                            backgroundColor: ['#10b981', '#cbd5e1'], // Green, Slate 300
                            borderWidth: 2,
                            borderColor: '#ffffff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { boxWidth: 12, padding: 10, font: { size: 11 } }
                            }
                        }
                    }
                });

                // 2. Device Pie Chart
                let mobile = chartData[period].devices.mobile;
                let desktop = chartData[period].devices.desktop;

                new Chart(document.getElementById('deviceChart-' + period), {
                    type: 'pie',
                    data: {
                        labels: ['Desktop', 'Mobile'],
                        datasets: [{
                            data: [desktop, mobile],
                            backgroundColor: ['#6366f1', '#f43f5e'], // Indigo, Rose
                            borderWidth: 2,
                            borderColor: '#ffffff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { boxWidth: 12, padding: 10, font: { size: 11 } }
                            }
                        }
                    }
                });
            });
        });
    </script>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent border-bottom py-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 flex-grow-1">Recent Pending Jobs</h5>
                        <a href="{{ route('admin.jobs.index') }}" class="btn btn-sm btn-light text-primary fw-medium">View All</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
                                <tr class="text-muted text-uppercase" style="font-size: 0.75rem;">
                                    <th scope="col" class="ps-4">Job Title</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Posted</th>
                                    <th scope="col" class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recent_jobs as $job)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-light text-primary rounded d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                    <i class="bi bi-briefcase fs-5"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-dark fw-semibold">{{ $job->title }}</h6>
                                                    <small class="text-muted">{{ $job->job_type }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($job->company_logo)
                                                <div class="d-flex align-items-center">
                                                     <img src="{{ Storage::url($job->company_logo) }}" alt="" class="rounded-circle me-2" width="24" height="24">
                                                     <span class="fw-medium">{{ $job->company_name }}</span>
                                                </div>
                                            @elseif($job->company_name)
                                                <span class="fw-medium">{{ $job->company_name }}</span>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td><span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill">{{ $job->category->name }}</span></td>
                                        <td class="text-muted">{{ $job->created_at->diffForHumans() }}</td>
                                        <td class="text-end pe-4">
                                            <a href="{{ route('admin.jobs.show', $job) }}" class="btn btn-sm btn-soft-primary text-primary bg-primary-subtle fw-medium">Review</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <div class="mb-2"><i class="bi bi-inbox fs-1 opacity-25"></i></div>
                                            No pending jobs found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection