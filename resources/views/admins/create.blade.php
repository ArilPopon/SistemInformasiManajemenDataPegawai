@extends('layouts.app')

@section('title', 'Tambah Admin')

@push('styles')
    <style>
        .form-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, .05);
        }

        .form-control {
            padding: 11px 13px;
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .12);
        }

        .form-card .btn {
            border-radius: 8px;
            padding: 10px 18px;
        }
    </style>
@endpush

@section('content')
    {{-- Header --}}
    <div class="mb-4">
        <a href="{{ route('superadmin.admins.index') }}" class="text-decoration-none text-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali ke Manajemen Admin
        </a>

        <h3 class="fw-bold mt-3 mb-1">Tambah Admin</h3>

        <p class="text-secondary mb-0">
            Buat akun administrator baru untuk mengakses sistem.
        </p>
    </div>

    {{-- Form Card --}}
    <div class="card form-card">
        <div class="card-body p-4 p-md-5">

            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="bg-primary-subtle text-primary rounded-3 p-3">
                    <i class="bi bi-person-plus-fill fs-4"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">Informasi Akun</h5>
                    <small class="text-secondary">
                        Lengkapi informasi akun Admin.
                    </small>
                </div>
            </div>

            <form id="createAdminForm" action="{{ route('superadmin.admins.store') }}" method="POST">

                @csrf

                {{-- Nama --}}
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">
                        Nama Lengkap
                    </label>

                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama lengkap"
                        value="{{ old('name') }}" required>

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">
                        Alamat Email
                    </label>

                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="contoh@email.com"
                        value="{{ old('email') }}" required>

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">
                        Password
                    </label>

                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter"
                        minlength="8" required>

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-semibold">
                        Konfirmasi Password
                    </label>

                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                        placeholder="Ulangi password" minlength="8" required>
                </div>

                {{-- Informasi --}}
                <div class="alert alert-info border-0">
                    <i class="bi bi-info-circle me-2"></i>
                    Akun yang dibuat melalui halaman ini otomatis memiliki
                    role <strong>Admin</strong>.
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('superadmin.admins.index') }}" class="btn btn-light border">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Simpan Admin
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const createAdminForm = document.getElementById('createAdminForm');

        createAdminForm.addEventListener('submit', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Tambah Admin?',
                text: 'Pastikan informasi akun yang dimasukkan sudah benar.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    createAdminForm.submit();
                }
            });
        });
    </script>
@endpush
