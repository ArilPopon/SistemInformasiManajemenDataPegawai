@extends('layouts.app')

@section('title', 'Profil Pengguna')

@push('styles')
    <style>
        .profile-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .04);
        }

        .profile-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 26px;
        }

        .form-control {
            padding: 11px 13px;
            border-radius: 8px;
        }

        .profile-card .btn {
            border-radius: 8px;
            padding: 10px 18px;
        }
    </style>
@endpush

@section('content')
    {{-- Header --}}
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Profil Pengguna</h3>
        <p class="text-secondary mb-0">
            Kelola informasi akun dan keamanan password Anda.
        </p>
    </div>

    {{-- Notifikasi Berhasil --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Informasi Profil --}}
    <div class="card profile-card mb-4">
        <div class="card-body p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="profile-icon bg-primary-subtle text-primary">
                    <i class="bi bi-person-fill"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
                    <p class="text-secondary mb-1">{{ $user->email }}</p>
                    <span class="badge bg-primary">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Profil --}}
    <div class="card profile-card mb-4">
        <div class="card-body p-4 p-md-5">

            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="bg-primary-subtle text-primary rounded-3 p-3">
                    <i class="bi bi-person-gear fs-4"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">Informasi Profil</h5>
                    <small class="text-secondary">
                        Perbarui nama dan alamat email Anda.
                    </small>
                </div>
            </div>

            <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">
                        Nama Lengkap
                    </label>

                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}"
                        required>

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold">
                        Alamat Email
                    </label>

                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}"
                        required>

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Ubah Password --}}
    <div class="card profile-card">
        <div class="card-body p-4 p-md-5">

            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="bg-warning-subtle text-warning rounded-3 p-3">
                    <i class="bi bi-shield-lock fs-4"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">Ubah Password</h5>
                    <small class="text-secondary">
                        Perbarui password untuk menjaga keamanan akun.
                    </small>
                </div>
            </div>

            <form id="changePasswordForm" action="{{ route('profile.password') }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="current_password" class="form-label fw-semibold">
                        Password Lama
                    </label>

                    <input type="password" name="current_password" id="current_password"
                        class="form-control @error('current_password') is-invalid @enderror"
                        placeholder="Masukkan password lama" required>

                    @error('current_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

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
                        Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Konfirmasi edit profil
        document.getElementById('editProfileForm')
            .addEventListener('submit', function(event) {
                event.preventDefault();

                const form = this;

                Swal.fire({
                    title: 'Simpan perubahan profil?',
                    text: 'Nama dan email akun Anda akan diperbarui.',
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

        // Konfirmasi ubah password
        document.getElementById('changePasswordForm')
            .addEventListener('submit', function(event) {
                event.preventDefault();

                const form = this;

                Swal.fire({
                    title: 'Ubah password?',
                    text: 'Pastikan password baru sudah benar.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d97706',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Ubah',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
    </script>
@endpush
