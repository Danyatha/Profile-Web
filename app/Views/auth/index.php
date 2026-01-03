<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .quote-section {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .quote-section::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
            animation: float 6s ease-in-out infinite;
        }

        .quote-section::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .quote-content {
            position: relative;
            z-index: 1;
        }

        .quote-icon {
            font-size: 48px;
            margin-bottom: 20px;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .quote-text {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 15px;
            line-height: 1.4;
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .quote-author {
            font-size: 14px;
            opacity: 0.9;
            font-style: italic;
        }

        .form-section {
            flex: 1;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #666;
            font-size: 14px;
        }

        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }

        .tab {
            flex: 1;
            padding: 12px;
            background: #f5f5f5;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            color: #666;
            transition: all 0.3s ease;
        }

        .tab.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .hidden {
            display: none;
        }

        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .popup-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .popup {
            background: white;
            border-radius: 16px;
            padding: 40px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            transform: scale(0.8);
            transition: all 0.3s ease;
            text-align: center;
        }

        .popup-overlay.show .popup {
            transform: scale(1);
        }

        .popup-icon {
            font-size: 64px;
            margin-bottom: 20px;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-10px);
            }

            75% {
                transform: translateX(10px);
            }
        }

        .popup h3 {
            color: #333;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .popup p {
            color: #666;
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .popup-buttons {
            display: flex;
            gap: 10px;
        }

        .popup-btn {
            flex: 1;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .popup-btn.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .popup-btn.primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .popup-btn.secondary {
            background: #f5f5f5;
            color: #666;
        }

        .popup-btn.secondary:hover {
            background: #e0e0e0;
        }

        .error-message {
            background: #fee;
            color: #c33;
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 15px;
            display: none;
            animation: slideDown 0.3s ease;
        }

        .error-message.show {
            display: block;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .quote-section {
                padding: 40px 30px;
            }

            .quote-text {
                font-size: 20px;
            }

            .form-section {
                padding: 40px 30px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="quote-section">
            <div class="quote-content">
                <div class="quote-icon">✨</div>
                <div class="quote-text" id="quoteText">Setiap langkah kecil adalah kemajuan</div>
                <div class="quote-author" id="quoteAuthor">- Anonim</div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-header">
                <h2>Selamat Datang!</h2>
                <p>Silakan login atau buat akun baru</p>
            </div>

            <div class="tabs">
                <button class="tab active" id="loginTab">Login</button>
                <button class="tab" id="registerTab">Register</button>
            </div>

            <form id="loginForm">
                <div class="error-message" id="loginError">
                    Email atau password salah!
                </div>
                <div class="form-group">
                    <label for="loginEmail">Email</label>
                    <input type="email" id="loginEmail" placeholder="nama@email.com" required>
                </div>
                <div class="form-group">
                    <label for="loginPassword">Password</label>
                    <input type="password" id="loginPassword" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="submit-btn">Masuk</button>
            </form>

            <form id="registerForm" class="hidden">
                <div class="form-group">
                    <label for="registerName">Nama Lengkap</label>
                    <input type="text" id="registerName" placeholder="Nama Anda" required>
                </div>
                <div class="form-group">
                    <label for="registerEmail">Email</label>
                    <input type="email" id="registerEmail" placeholder="nama@email.com" required>
                </div>
                <div class="form-group">
                    <label for="registerPassword">Password</label>
                    <input type="password" id="registerPassword" placeholder="Minimal 6 karakter" required>
                </div>
                <button type="submit" class="submit-btn">Daftar</button>
            </form>
        </div>
    </div>

    <div class="popup-overlay" id="popupOverlay">
        <div class="popup">
            <div class="popup-icon">🔒</div>
            <h3>Login Gagal</h3>
            <p>Password yang Anda masukkan salah. Belum memiliki akun?</p>
            <div class="popup-buttons">
                <button class="popup-btn secondary" id="closePopup">Coba Lagi</button>
                <button class="popup-btn primary" id="goToRegister">Daftar Sekarang</button>
            </div>
        </div>
    </div>

    <script>
        const quotes = [{
                text: "Setiap langkah kecil adalah kemajuan",
                author: "Anonim"
            },
            {
                text: "Kesuksesan dimulai dari keberanian mencoba",
                author: "Anonim"
            },
            {
                text: "Hari ini adalah kesempatan baru",
                author: "Anonim"
            },
            {
                text: "Percaya pada diri sendiri adalah kunci",
                author: "Anonim"
            },
            {
                text: "Jangan takut untuk bermimpi besar",
                author: "Anonim"
            },
            {
                text: "Perubahan dimulai dari diri sendiri",
                author: "Anonim"
            },
            {
                text: "Setiap hari adalah halaman baru",
                author: "Anonim"
            }
        ];

        let currentQuoteIndex = 0;

        function changeQuote() {
            const quoteText = document.getElementById('quoteText');
            const quoteAuthor = document.getElementById('quoteAuthor');

            quoteText.style.animation = 'none';
            quoteAuthor.style.animation = 'none';

            setTimeout(() => {
                currentQuoteIndex = (currentQuoteIndex + 1) % quotes.length;
                quoteText.textContent = quotes[currentQuoteIndex].text;
                quoteAuthor.textContent = '- ' + quotes[currentQuoteIndex].author;
                quoteText.style.animation = 'fadeIn 1s ease-in';
                quoteAuthor.style.animation = 'fadeIn 1s ease-in';
            }, 50);
        }

        setInterval(changeQuote, 5000);

        const loginTab = document.getElementById('loginTab');
        const registerTab = document.getElementById('registerTab');
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');

        loginTab.addEventListener('click', () => {
            loginTab.classList.add('active');
            registerTab.classList.remove('active');
            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
        });

        registerTab.addEventListener('click', () => {
            registerTab.classList.add('active');
            loginTab.classList.remove('active');
            registerForm.classList.remove('hidden');
            loginForm.classList.add('hidden');
        });

        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            const errorMsg = document.getElementById('loginError');
            const popup = document.getElementById('popupOverlay');

            // Simulasi validasi password (untuk demo, anggap password harus minimal 6 karakter)
            if (password.length < 6) {
                errorMsg.classList.add('show');
                setTimeout(() => {
                    popup.classList.add('show');
                }, 300);
            } else {
                errorMsg.classList.remove('show');
                alert('Login berhasil! 🎉');
            }
        });

        registerForm.addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Registrasi berhasil! 🎉');
        });

        const closePopup = document.getElementById('closePopup');
        const goToRegister = document.getElementById('goToRegister');
        const popup = document.getElementById('popupOverlay');

        closePopup.addEventListener('click', () => {
            popup.classList.remove('show');
            document.getElementById('loginPassword').value = '';
            document.getElementById('loginPassword').focus();
        });

        goToRegister.addEventListener('click', () => {
            popup.classList.remove('show');
            registerTab.click();
            document.getElementById('registerName').focus();
        });

        popup.addEventListener('click', (e) => {
            if (e.target === popup) {
                popup.classList.remove('show');
            }
        });
    </script>
</body>

</html>