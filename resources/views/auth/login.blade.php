<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Manajemen Pegawai</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: #f3f6fb;
            font-family: Arial, sans-serif;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            background: #fff;
            border: none;
            border-radius: 18px;
            padding: 38px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, .07);
        }

        .login-icon {
            width: 65px;
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            background: #eaf1ff;
            color: #2563eb;
            border-radius: 16px;
            font-size: 30px;
        }

        .form-control {
            padding: 12px 14px;
            border-radius: 9px;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .12);
        }

        .btn-login {
            padding: 12px;
            border-radius: 9px;
            background: #2563eb;
            border: none;
            font-weight: 600;
        }

        .btn-login:hover {
            background: #1d4ed8;
        }

        .password-toggle {
            cursor: pointer;
            color: #6c757d;
        }
    </style>
</head>

<body>

    <div class="login-wrapper">
        <div class="login-card">

            <div class="text-center mb-4">
                <div class="login-icon">
                    <i class="bi bi-people-fill"></i>
                </div>

                <h3 class="fw-bold mb-2">Selamat Datang</h3>

                <p class="text-secondary mb-0">
                    Sistem Informasi Manajemen Data Pegawai
                </p>
            </div>

            <form action="{{ route('login.process') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">
                        Email
                    </label>

                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email"
                        value="{{ old('email') }}" autocomplete="username" required autofocus>

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">
                        Password
                    </label>

                    <div class="input-group">
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password"
                            autocomplete="current-password" required>

                        <button class="btn btn-outline-secondary" type="button" id="togglePassword"
                            aria-label="Tampilkan password">
                            <i class="bi bi-eye" id="passwordIcon"></i>
                        </button>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input" value="1">

                        <label for="remember" class="form-check-label text-secondary">
                            Ingat saya
                        </label>
                    </div>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn btn-primary btn-login w-100">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Login
                </button>
            </form>

            <div class="text-center mt-4">
                <small class="text-secondary">
                    &copy; {{ date('Y') }} Sistem Informasi Manajemen Data Pegawai
                </small>
            </div>

        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const passwordIcon = document.getElementById('passwordIcon');

        togglePassword.addEventListener('click', function() {
            const isPassword = passwordInput.type === 'password';

            passwordInput.type = isPassword ? 'text' : 'password';

            passwordIcon.classList.toggle('bi-eye', !isPassword);
            passwordIcon.classList.toggle('bi-eye-slash', isPassword);

            togglePassword.setAttribute(
                'aria-label',
                isPassword ? 'Sembunyikan password' : 'Tampilkan password'
            );
        });
    </script>

</body>

</html>
