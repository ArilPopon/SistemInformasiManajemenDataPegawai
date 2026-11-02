@extends('layouts.app')

@section('title', 'Detail Pegawai')

@push('styles')
    <style>
        .detail-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, .05);
        }

        .detail-label {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .detail-value {
            font-weight: 600;
            margin-bottom: 22px;
        }
    </style>
@endpush

@section('content')

    <div class="container-fluid px-0">

        <!-- Tombol Kembali -->
        <a href="{{ route('employees.index') }}" class="text-decoration-none text-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali ke Manajemen Pegawai
        </a>

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mt-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">Detail Pegawai</h3>
                <p class="text-secondary mb-0">
                    Informasi lengkap data pegawai.
                </p>
            </div>

            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-1"></i>
                Edit Pegawai
            </a>
        </div>

        <!-- Detail Card -->
        <div class="card detail-card">
            <div class="card-body p-4 p-md-5">

                <!-- Identitas Pegawai -->
                <h5 class="fw-bold mb-4">
                    <i class="bi bi-person-vcard text-primary me-2"></i>
                    Identitas Pegawai
                </h5>

                <div class="row">
                    <div class="col-md-6">
                        <p class="detail-label">NIP</p>
                        <p class="detail-value">{{ $employee->nip }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="detail-label">Nama Lengkap</p>
                        <p class="detail-value">{{ $employee->name }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="detail-label">Jenis Kelamin</p>
                        <p class="detail-value">
                            {{ $employee->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </p>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Informasi Kelahiran dan Alamat -->
                <h5 class="fw-bold mb-4">
                    <i class="bi bi-geo-alt text-primary me-2"></i>
                    Informasi Kelahiran dan Alamat
                </h5>

                <div class="row">
                    <div class="col-md-6">
                        <p class="detail-label">Tempat Lahir</p>
                        <p class="detail-value">{{ $employee->place_of_birth }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="detail-label">Tanggal Lahir</p>
                        <p class="detail-value">
                            {{ $employee->date_of_birth->format('Y-m-d') }}
                        </p>
                    </div>

                    <div class="col-12">
                        <p class="detail-label">Alamat</p>
                        <p class="detail-value">{{ $employee->address }}</p>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Informasi Pekerjaan dan Kontak -->
                <h5 class="fw-bold mb-4">
                    <i class="bi bi-briefcase text-primary me-2"></i>
                    Informasi Pekerjaan dan Kontak
                </h5>

                <div class="row">
                    <div class="col-md-6">
                        <p class="detail-label">Pendidikan Terakhir</p>
                        <p class="detail-value">{{ $employee->last_education }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="detail-label">Jabatan</p>
                        <p class="detail-value">{{ $employee->position }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="detail-label">Tanggal Masuk Kerja</p>
                        <p class="detail-value">
                            {{ $employee->hire_date->format('Y-m-d') }}
                        </p>
                    </div>

                    <div class="col-md-6">
                        <p class="detail-label">Nomor Telepon</p>
                        <p class="detail-value">{{ $employee->phone }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="detail-label">Email</p>
                        <p class="detail-value">
                            {{ $employee->email ?: '-' }}
                        </p>
                    </div>
                </div>

                <hr class="my-3">

                <!-- Informasi Waktu Data -->
                <div class="text-secondary small">
                    Dibuat: {{ $employee->created_at->format('Y-m-d H:i') }}
                    <br>
                    Terakhir diperbarui:
                    {{ $employee->updated_at->format('Y-m-d H:i') }}
                </div>

            </div>
        </div>

    </div>

@endsection
