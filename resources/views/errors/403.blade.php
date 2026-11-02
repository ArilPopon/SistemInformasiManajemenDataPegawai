<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak | SIMPEG</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: #f4f6fa;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .error-card {
            max-width: 520px;
            width: 100%;
            background: white;
            border-radius: 18px;
            padding: 45px 35px;
            text-align: center;
            box-shadow: 0 5px 25px rgba(0, 0, 0, .05);
        }

        .error-icon {
            width: 85px;
            height: 85px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fee2e2;
            color: #dc2626;
            border-radius: 50%;
            font-size: 38px;
        }

        .error-code {
            font-size: 75px;
            font-weight: 800;
            color: #172554;
            line-height: 1;
            margin-bottom: 15px;
        }

        .btn-home {
            background: #2563eb;
            color: white;
            padding: 11px 22px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            margin-top: 15px;
        }

        .btn-home:hover {
            background: #1d4ed8;
            color: white;
        }
    </style>
</head>

<body>

    <div class="error-card">

        <div class="error-icon">
            <i class="bi bi-shield-lock-fill"></i>
        </div>

        <div class="error-code">403</div>

        <h4 class="fw-bold mb-3">Akses Ditolak</h4>

        <p class="text-secondary mb-4">
            Maaf, kamu tidak memiliki izin untuk mengakses halaman ini.
            Halaman tersebut hanya dapat diakses oleh pengguna dengan hak akses tertentu.
        </p>

        <a href="{{ url('/dashboard') }}" class="btn-home">
            <i class="bi bi-house-door me-2"></i>
            Kembali ke Dashboard
        </a>

        <div class="mt-4 text-secondary small">
            <i class="bi bi-buildings me-1"></i>
            SIMPEG - Sistem Informasi Manajemen Pegawai
        </div>

    </div>

</body>

</html>
