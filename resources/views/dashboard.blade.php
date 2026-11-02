@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
    <style>
        .stat-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .04);
            height: 100%;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 23px;
        }

        .chart-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .04);
            height: 100%;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }
    </style>
@endpush

@section('content')
    {{-- Header Dashboard --}}
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Dashboard</h3>
        <p class="text-secondary mb-0">
            Selamat datang, {{ auth()->user()->name }}!
            Berikut ringkasan data Sistem Informasi Manajemen Pegawai.
        </p>
    </div>

    {{-- Statistik Utama --}}
    <div class="row g-3 mb-4">

        {{-- Total Pegawai --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-2">Total Pegawai</p>
                        <h3 class="fw-bold mb-0">{{ $totalEmployees }}</h3>
                    </div>

                    <div class="stat-icon bg-primary-subtle text-primary">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pegawai Laki-laki --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-2">Pegawai Laki-laki</p>
                        <h3 class="fw-bold mb-0">{{ $totalMale }}</h3>
                    </div>

                    <div class="stat-icon bg-info-subtle text-info">
                        <i class="bi bi-person-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pegawai Perempuan --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-secondary mb-2">Pegawai Perempuan</p>
                        <h3 class="fw-bold mb-0">{{ $totalFemale }}</h3>
                    </div>

                    <div class="stat-icon bg-danger-subtle text-danger">
                        <i class="bi bi-person-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Admin khusus Superadmin --}}
        @if (auth()->user()->role === 'superadmin')
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-secondary mb-2">Total Admin</p>
                            <h3 class="fw-bold mb-0">{{ $totalAdmins }}</h3>
                        </div>

                        <div class="stat-icon bg-warning-subtle text-warning">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

    {{-- Grafik Jenis Kelamin dan Pendidikan --}}
    <div class="row g-3 mb-4">

        {{-- Grafik Jenis Kelamin --}}
        <div class="col-12 col-lg-5">
            <div class="card chart-card">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1">Jenis Kelamin Pegawai</h5>
                    <p class="text-secondary small mb-4">
                        Perbandingan jumlah pegawai laki-laki dan perempuan.
                    </p>

                    <div class="chart-container">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grafik Pendidikan --}}
        <div class="col-12 col-lg-7">
            <div class="card chart-card">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1">Pendidikan Terakhir</h5>
                    <p class="text-secondary small mb-4">
                        Jumlah pegawai berdasarkan pendidikan terakhir.
                    </p>

                    <div class="chart-container">
                        <canvas id="educationChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Grafik Usia Pegawai --}}
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="card chart-card">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1">Usia Pegawai</h5>
                    <p class="text-secondary small mb-4">
                        Distribusi jumlah pegawai berdasarkan kelompok usia.
                    </p>

                    <div class="chart-container">
                        <canvas id="ageChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Grafik Jabatan --}}
    <div class="row g-3">
        <div class="col-12">
            <div class="card chart-card">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1">Pegawai Berdasarkan Jabatan</h5>
                    <p class="text-secondary small mb-4">
                        Distribusi pegawai berdasarkan jabatan yang dimiliki.
                    </p>

                    <div class="chart-container">
                        <canvas id="positionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Pengaturan legenda untuk semua grafik
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        };

        // Data jenis kelamin
        const genderLabels = ['Laki-laki', 'Perempuan'];

        const genderData = [
            {{ $totalMale }},
            {{ $totalFemale }}
        ];

        new Chart(document.getElementById('genderChart'), {
            type: 'doughnut',
            data: {
                labels: genderLabels,
                datasets: [{
                    data: genderData,
                    backgroundColor: ['#2563eb', '#ec4899'],
                    borderWidth: 0
                }]
            },
            options: {
                ...chartOptions
            }
        });

        // Data pendidikan terakhir
        const educationLabels = @json($employeesByEducation->pluck('last_education'));
        const educationData = @json($employeesByEducation->pluck('total'));

        new Chart(document.getElementById('educationChart'), {
            type: 'bar',
            data: {
                labels: educationLabels,
                datasets: [{
                    label: 'Jumlah Pegawai',
                    data: educationData,
                    backgroundColor: '#3b82f6',
                    borderRadius: 6
                }]
            },
            options: {
                ...chartOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Data usia pegawai
        const ageLabels = @json($employeesByAge->pluck('age_group'));
        const ageData = @json($employeesByAge->pluck('total'));

        new Chart(document.getElementById('ageChart'), {
            type: 'bar',
            data: {
                labels: ageLabels,
                datasets: [{
                    label: 'Jumlah Pegawai',
                    data: ageData,
                    backgroundColor: '#3b82f6',
                    borderRadius: 6
                }]
            },
            options: {
                ...chartOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Data jabatan
        const positionLabels = @json($employeesByPosition->pluck('position'));
        const positionData = @json($employeesByPosition->pluck('total'));

        new Chart(document.getElementById('positionChart'), {
            type: 'bar',
            data: {
                labels: positionLabels,
                datasets: [{
                    label: 'Jumlah Pegawai',
                    data: positionData,
                    backgroundColor: '#3b82f6',
                    borderRadius: 6
                }]
            },
            options: {
                ...chartOptions,
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
@endpush
