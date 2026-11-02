@extends('layouts.app')

@section('title', 'Manajemen Pegawai')

@push('styles')
    <style>
        .main-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, .05);
        }

        .table th {
            white-space: nowrap;
        }

        .btn {
            border-radius: 8px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid px-0">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Manajemen Pegawai</h3>
                <p class="text-secondary mb-0">
                    Kelola seluruh data pegawai.
                </p>
            </div>

            <a href="{{ route('employees.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Pegawai
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Table Card -->
        <div class="card main-card">
            <div class="card-body p-4">

                <!-- Search -->
                <form action="{{ route('employees.index') }}" method="GET" class="row g-2 mb-4">
                    <div class="col-md-5">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari NIP, nama, atau jabatan..." value="{{ request('search') }}">
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search me-1"></i>
                            Cari
                        </button>
                    </div>

                    <div class="col-auto">
                        <a href="{{ route('employees.index') }}" class="btn btn-light border">
                            Reset
                        </a>
                    </div>
                </form>

                <!-- Employee Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Jenis Kelamin</th>
                                <th>Jabatan</th>
                                <th>Pendidikan</th>
                                <th>No. Telepon</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($employees as $employee)
                                <tr>
                                    <td>{{ $employees->firstItem() + $loop->index }}</td>
                                    <td>{{ $employee->nip }}</td>
                                    <td class="fw-semibold">{{ $employee->name }}</td>
                                    <td>
                                        {{ $employee->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </td>
                                    <td>{{ $employee->position }}</td>
                                    <td>{{ $employee->last_education }}</td>
                                    <td>{{ $employee->phone }}</td>

                                    <td>
                                        <div class="d-flex justify-content-center gap-1">

                                            <!-- Detail -->
                                            <a href="{{ route('employees.show', $employee) }}"
                                                class="btn btn-sm btn-info text-white" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ route('employees.edit', $employee) }}"
                                                class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <!-- Hapus -->
                                            <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                                                class="delete-form">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-secondary">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                        Belum ada data pegawai.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $employees->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const currentForm = this;

                Swal.fire({
                    title: 'Hapus data pegawai?',
                    text: 'Data pegawai yang dihapus tidak dapat dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then(result => {
                    if (result.isConfirmed) {
                        currentForm.submit();
                    }
                });
            });
        });
    </script>
@endpush
