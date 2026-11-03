@extends('layouts.app')

@section('title', 'Manajemen Pegawai')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

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

        /* Jarak dan posisi bagian atas DataTables */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 18px;
        }

        /* Dropdown jumlah data */
        .dataTables_wrapper .dataTables_length {
            text-align: left;
        }

        .dataTables_wrapper .dataTables_length label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 0;
            white-space: nowrap;
        }

        .dataTables_wrapper .dataTables_length select {
            width: 75px;
            min-width: 75px;
            height: 38px;
            padding: 6px 28px 6px 10px;
            margin: 0 !important;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-position: right 8px center;
            cursor: pointer;
        }

        /* Search box di sebelah kanan */
        .dataTables_wrapper .dataTables_filter {
            text-align: right;
        }

        .dataTables_wrapper .dataTables_filter label {
            display: inline-flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            margin-bottom: 0;
            white-space: nowrap;
        }

        .dataTables_wrapper .dataTables_filter input {
            width: 220px;
            height: 38px;
            padding: 6px 12px;
            margin: 0 !important;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            outline: none;
            box-shadow: none;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, .12);
        }

        /* Ikon sorting tabel */
        #employeeTable thead th {
            padding-right: 30px !important;
            vertical-align: middle;
        }

        /* Pagination */
        .dataTables_wrapper .dataTables_paginate {
            margin-top: 8px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 6px !important;
        }

        /* Tampilan mobile */
        @media (max-width: 576px) {

            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                text-align: left;
                margin-bottom: 12px;
            }

            .dataTables_wrapper .dataTables_filter label {
                justify-content: flex-start;
                flex-wrap: wrap;
            }

            .dataTables_wrapper .dataTables_filter input {
                width: 100%;
            }
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

                <div class="table-responsive">
                    <table id="employeeTable" class="table table-hover align-middle w-100">
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
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
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
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {

            // Inisialisasi DataTables
            $('#employeeTable').DataTable({
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],

                order: [
                    [1, 'asc']
                ],

                columnDefs: [{
                    targets: [0, 7],
                    orderable: false,
                    searchable: false
                }],

                language: {
                    search: 'Cari:',
                    searchPlaceholder: 'Cari NIP, nama, jabatan...',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data pegawai',
                    infoEmpty: 'Tidak ada data pegawai',
                    infoFiltered: '(disaring dari _MAX_ total data)',
                    zeroRecords: 'Data pegawai tidak ditemukan',
                    emptyTable: 'Belum ada data pegawai',
                    paginate: {
                        first: 'Pertama',
                        last: 'Terakhir',
                        next: 'Berikutnya',
                        previous: 'Sebelumnya'
                    }
                },

                drawCallback: function() {
                    const api = this.api();
                    const start = api.page.info().start;

                    api.column(0, {
                        page: 'current'
                    }).nodes().each(function(cell, index) {
                        cell.innerHTML = start + index + 1;
                    });
                }
            });

            // Konfirmasi hapus menggunakan SweetAlert2
            $(document).on('submit', '.delete-form', function(event) {
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
                }).then((result) => {
                    if (result.isConfirmed) {
                        currentForm.submit();
                    }
                });
            });

        });
    </script>
@endpush
