@extends('layouts.app')

@section('title', 'Edit Admin')

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

        <h3 class="fw-bold mt-3 mb-1">Edit Admin</h3>

        <p class="text-secondary mb-0">
            Perbarui informasi akun administrator.
        </p>
    </div>

    {{-- Edit Informasi Admin --}}
    <div class="card form-card mb-4">
        <div class="card-body p-4 p-md-5">

            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="bg-primary-subtle text-primary rounded-3 p-3">
                    <i class="bi bi-person-gear fs-4"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">Informasi Akun</h5>
                    <small class="text-secondary">
                        Ubah nama dan alamat email Admin.
                    </small>
                </div>
            </div>

            <form id="editAdminForm" action="{{ route('superadmin.admins.update', $admin->id) }}" method="POST">

                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">
                        Nama Lengkap
                    </label>

                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $admin->name) }}"
                        required>

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold">
                        Alamat Email
                    </label>

                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $admin->email) }}"
                        required>

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('superadmin.admins.index') }}" class="btn btn-light border">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Reset Password --}}
    <div class="card form-card">
        <div class="card-body p-4 p-md-5">

            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="bg-warning-subtle text-warning rounded-3 p-3">
                    <i class="bi bi-shield-lock fs-4"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">Reset Password</h5>
                    <small class="text-secondary">
                        Atur password baru jika Admin lupa password.
                    </small>
                </div>
            </div>

            <div class="alert alert-warning border-0">
                <i class="bi bi-info-circle me-2"></i>
                Password lama tidak diperlukan untuk proses reset.
            </div>

            <form id="resetPasswordForm" action="{{ route('superadmin.admins.reset-password', $admin->id) }}"
                method="POST">

                @csrf
                @method('PUT')

                {{-- Password Baru --}}
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">
                        Password Baru
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
                        Konfirmasi Password Baru
                    </label>

                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                        placeholder="Ulangi password baru" minlength="8" required>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-key me-1"></i>
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Konfirmasi edit informasi Admin
        document.getElementById('editAdminForm')
            .addEventListener('submit', function(event) {
                event.preventDefault();

                const form = this;

                Swal.fire({
                    title: 'Simpan perubahan?',
                    text: 'Informasi akun Admin akan diperbarui.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#2563eb',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Simpan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

        // Konfirmasi reset password
        document.getElementById('resetPasswordForm')
            .addEventListener('submit', function(event) {
                event.preventDefault();

                const form = this;

                Swal.fire({
                    title: 'Reset password?',
                    text: 'Password Admin akan diganti dengan password baru.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d97706',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Reset',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
    </script>
@endpush
