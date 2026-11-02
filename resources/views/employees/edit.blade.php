@extends('layouts.app')

@section('title', 'Edit Pegawai')

@push('styles')
    <style>
        .form-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, .05);
        }

        .form-control,
        .form-select {
            padding: 11px 13px;
            border-radius: 8px;
        }

        .btn {
            border-radius: 8px;
            padding: 10px 18px;
        }

        .section-title {
            font-weight: 700;
            font-size: 17px;
        }
    </style>
@endpush

@section('content')

    <div class="container-fluid px-0">

        <!-- Header -->
        <div class="mb-4">
            <a href="{{ route('employees.index') }}" class="text-decoration-none text-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali ke Manajemen Pegawai
            </a>

            <h3 class="fw-bold mt-3 mb-1">Edit Pegawai</h3>

            <p class="text-secondary mb-0">
                Perbarui informasi data pegawai.
            </p>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terdapat kesalahan input:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Card -->
        <div class="card form-card">
            <div class="card-body p-4 p-md-5">

                <form id="editEmployeeForm" action="{{ route('employees.update', $employee) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <!-- Identitas Pegawai -->
                    <div class="mb-4">
                        <h5 class="section-title">
                            <i class="bi bi-person-vcard text-primary me-2"></i>
                            Identitas Pegawai
                        </h5>
                        <hr>
                    </div>

                    <div class="row g-3 mb-4">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                NIP <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                                value="{{ old('nip', $employee->nip) }}" placeholder="Masukkan NIP" maxlength="30" required>

                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $employee->name) }}" placeholder="Masukkan nama lengkap"
                                maxlength="150" required>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Jenis Kelamin <span class="text-danger">*</span>
                            </label>

                            <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>

                                <option value="">Pilih jenis kelamin</option>

                                <option value="L" {{ old('gender', $employee->gender) === 'L' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>

                                <option value="P" {{ old('gender', $employee->gender) === 'P' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>

                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Informasi Kelahiran dan Alamat -->
                    <div class="mb-4">
                        <h5 class="section-title">
                            <i class="bi bi-geo-alt text-primary me-2"></i>
                            Informasi Kelahiran dan Alamat
                        </h5>
                        <hr>
                    </div>

                    <div class="row g-3 mb-4">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Tempat Lahir <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="place_of_birth"
                                class="form-control @error('place_of_birth') is-invalid @enderror"
                                value="{{ old('place_of_birth', $employee->place_of_birth) }}"
                                placeholder="Contoh: Surabaya" maxlength="100" required>

                            @error('place_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Tanggal Lahir <span class="text-danger">*</span>
                            </label>

                            <input type="date" name="date_of_birth"
                                class="form-control @error('date_of_birth') is-invalid @enderror"
                                value="{{ old('date_of_birth', $employee->date_of_birth->format('Y-m-d')) }}"
                                max="{{ date('Y-m-d', strtotime('-1 day')) }}" required>

                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">
                                Alamat Lengkap <span class="text-danger">*</span>
                            </label>

                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3"
                                placeholder="Masukkan alamat lengkap" required>{{ old('address', $employee->address) }}</textarea>

                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Informasi Pekerjaan dan Kontak -->
                    <div class="mb-4">
                        <h5 class="section-title">
                            <i class="bi bi-briefcase text-primary me-2"></i>
                            Informasi Pekerjaan dan Kontak
                        </h5>
                        <hr>
                    </div>

                    <div class="row g-3 mb-4">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Pendidikan Terakhir <span class="text-danger">*</span>
                            </label>

                            <select name="last_education" class="form-select @error('last_education') is-invalid @enderror"
                                required>

                                <option value="">Pilih pendidikan</option>

                                @foreach (['SD', 'SMP', 'SMA/SMK', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3'] as $education)
                                    <option value="{{ $education }}"
                                        {{ old('last_education', $employee->last_education) === $education ? 'selected' : '' }}>
                                        {{ $education }}
                                    </option>
                                @endforeach

                            </select>

                            @error('last_education')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Jabatan <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="position"
                                class="form-control @error('position') is-invalid @enderror"
                                value="{{ old('position', $employee->position) }}" placeholder="Contoh: Staff IT"
                                maxlength="100" required>

                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Tanggal Masuk Kerja <span class="text-danger">*</span>
                            </label>

                            <input type="date" name="hire_date"
                                class="form-control @error('hire_date') is-invalid @enderror"
                                value="{{ old('hire_date', $employee->hire_date->format('Y-m-d')) }}" required>

                            @error('hire_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Nomor Telepon <span class="text-danger">*</span>
                            </label>

                            <input type="tel" name="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $employee->phone) }}" placeholder="Contoh: 081234567890"
                                maxlength="20" required>

                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Email
                            </label>

                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $employee->email) }}" placeholder="Contoh: pegawai@email.com">

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <small class="text-secondary">
                                Email bersifat opsional.
                            </small>
                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">

                        <a href="{{ route('employees.index') }}" class="btn btn-light border">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>
                            Perbarui Data
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script>
        const form = document.getElementById('editEmployeeForm');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Perbarui Data Pegawai?',
                text: 'Pastikan perubahan data pegawai sudah benar.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Perbarui',
                cancelButtonText: 'Batal'
            }).then(result => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
