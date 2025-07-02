<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Klinik SeHat</title>
    <!-- Memuat Google Fonts dan Font Awesome untuk ikon -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Variabel Warna & Gaya Dasar (Sama seperti tema utama) */
        :root {
            --primary: #4361ee;
            --primary-dark: #3f37c9;
            --danger: #f72585;
            --text: #2b2d42;
            --text-light: #6c757d;
            --bg: #f8f9fa;
            --card-bg: #ffffff;
            --border: #e9ecef;
            --success: #4cc9f0;
        }

        /* Penataan Body dengan Latar Belakang Gradien */
        body {
            font-family: 'Poppins', 'Segoe UI', Roboto, sans-serif;
            color: var(--text);
            /* Menambahkan gradien yang lembut dan modern */
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        /* Kontainer Utama Form */
        .form-wrapper {
            width: 100%;
            max-width: 420px;
            background: var(--card-bg);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        /* Penataan Logo dan Judul */
        .logo-container {
            text-align: center;
            margin-bottom: 16px;
        }
        .logo-img {
            height: 50px;
            width: auto;
        }
        .form-title {
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 8px;
            color: var(--primary-dark);
        }
        .form-subtitle {
            font-size: 14px;
            color: var(--text-light);
            text-align: center;
            margin-bottom: 24px;
        }

        /* Grup Form (Label + Input) */
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }
        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            box-sizing: border-box; /* Penting agar padding tidak mengubah lebar */
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        /* Tombol Toggle Password */
        .toggle-password {
            position: absolute;
            right: 16px;
            top: 42px; /* Sesuaikan posisi vertikal */
            cursor: pointer;
            color: var(--text-light);
        }

        /* Tombol Utama */
        .btn {
            width: 100%;
            background: var(--primary);
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(67, 97, 238, 0.2);
        }
        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        /* Opsi Tambahan (Ingat Saya & Lupa Password) */
        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            margin-bottom: 24px;
        }
        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .options a {
            color: var(--primary);
            text-decoration: none;
        }
        .options a:hover {
            text-decoration: underline;
        }

        /* Link untuk Beralih Form */
        .switch-form {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
        }
        .switch-form a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }
        .switch-form a:hover {
            text-decoration: underline;
        }
        
        /* Pesan Error */
        .error-message {
            background-color: rgba(247, 37, 133, 0.1);
            color: var(--danger);
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            font-size: 14px;
            margin-bottom: 16px;
        }

        /* Utility Class untuk Menyembunyikan Form */
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="form-wrapper">

        <!-- FORM LOGIN (Tampil secara default) -->
        <div id="login-form">
            <div class="logo-container">
                <img src="assets/logo.png" alt="E-Klinik SeHat" class="logo-img" onerror="this.style.display='none'">
            </div>
            <h1 class="form-title">Selamat Datang Kembali</h1>
            <p class="form-subtitle">Masuk untuk melanjutkan ke E-Klinik SeHat</p>

            <?php if (isset($_GET['error'])): ?>
                <div class="error-message">
                    <?= htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>

            <form action="function/proseslogin.php" method="POST">
                <div class="form-group">
                    <label for="login-username">Username</label>
                    <input type="text" name="username" id="login-username" placeholder="Masukkan nama pengguna Anda" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" name="password" id="login-password" placeholder="Masukkan kata sandi Anda" required>
                    <span class="toggle-password" onclick="togglePassword('login-password')">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
                <div class="options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Ingat saya</label>
                    </div>
                    <a href="#" class="forgot-password">Lupa kata sandi?</a>
                </div>
                <button type="submit" class="btn">Masuk</button>
            </form>
            <p class="switch-form">Belum punya akun? <a id="show-register">Daftar di sini</a></p>
        </div>

        <!-- FORM REGISTRASI (Tersembunyi secara default) -->
        <div id="register-form" class="hidden">
            <div class="logo-container">
                <img src="assets/logo.png" alt="E-Klinik SeHat" class="logo-img" onerror="this.style.display='none'">
            </div>
            <h1 class="form-title">Buat Akun Baru</h1>
            <p class="form-subtitle">Isi data di bawah untuk mendaftar</p>
            
            <form action="function/prosesregister.php" method="POST">
                <div class="form-group">
                    <label for="register-username">Username</label>
                    <input type="text" name="username" id="register-username" placeholder="Pilih nama pengguna" required>
                </div>
                <div class="form-group">
                    <label for="register-email">Email</label>
                    <input type="email" name="email" id="register-email" placeholder="Masukkan email Anda" required>
                </div>
                <div class="form-group">
                    <label for="register-password">Password</label>
                    <input type="password" name="password" id="register-password" placeholder="Buat kata sandi" required>
                    <span class="toggle-password" onclick="togglePassword('register-password')">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Konfirmasi Password</label>
                    <input type="password" name="confirm_password" id="confirm-password" placeholder="Konfirmasi kata sandi Anda" required>
                    <span class="toggle-password" onclick="togglePassword('confirm-password')">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
                <button type="submit" class="btn">Daftar</button>
            </form>
            <p class="switch-form">Sudah punya akun? <a id="show-login">Masuk di sini</a></p>
        </div>
    </div>

    <script>
        // --- SCRIPT UNTUK FUNGSI FORM ---

        // Mengambil elemen dari DOM
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        const showRegisterLink = document.getElementById('show-register');
        const showLoginLink = document.getElementById('show-login');

        // Event listener untuk beralih ke form registrasi
        showRegisterLink.addEventListener('click', () => {
            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');
        });

        // Event listener untuk beralih ke form login
        showLoginLink.addEventListener('click', () => {
            registerForm.classList.add('hidden');
            loginForm.classList.remove('hidden');
        });

        // Fungsi untuk toggle visibilitas password
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const icon = passwordInput.nextElementSibling.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
