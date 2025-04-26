<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вход в систему</title>
    <!-- Google Fonts: Rubik и Amiri -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&family=Amiri:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: 'Rubik', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #F5F5F5; /* Фон как в профиле */
            color: #1A3C34; /* Основной цвет текста */
        }

        .login-container {
            background: #FFFFFF; /* Белый фон как в profile-card */
            padding: 30px;
            border-radius: 15px; /* Закругления как в профиле */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Тень */
            width: 100%;
            max-width: 360px;
            text-align: center;
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Фоновый орнамент */
        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('islamic-pattern.png') center/cover no-repeat;
            opacity: 0.1;
            z-index: 0;
        }

        h1 {
            font-family: 'Amiri', serif; /* Шрифт как в заголовках профиля */
            color: #D4A017; /* Золотой акцент */
            margin-bottom: 20px;
            font-size: 2rem;
            position: relative;
            z-index: 1;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #D4A0175e; /* Светло-золотая рамка */
            border-radius: 5px;
            font-size: 14px;
            background: #F5F5F5; /* Фон как в user-info */
            transition: border-color 0.3s, box-shadow 0.3s;
            position: relative;
            z-index: 1;
        }

        input:focus {
            outline: none;
            border-color: #D4A017; /* Полный золотой при фокусе */
            box-shadow: 0 0 0 3px rgba(212, 160, 23, 0.2);
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #D4A017; /* Золотая кнопка */
            color: #1A3C34; /* Тёмный текст */
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            position: relative;
            z-index: 1;
        }

        button:hover {
            background-color: #B8860B; /* Темнее золотого */
            transform: translateY(-2px);
        }

        .forgot-password {
            margin-top: 15px;
            color: #D4A017; /* Золотой акцент */
            cursor: pointer;
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

        .forgot-password:hover {
            color: #B8860B; /* Темнее золотого */
            text-decoration: underline;
        }

        /* Модалка */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #FFFFFF; /* Белый фон */
            margin: 15% auto;
            padding: 20px;
            border: none;
            width: 80%;
            max-width: 300px;
            border-radius: 15px; /* Закругления как в профиле */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Орнамент для модалки */
        .modal-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('islamic-pattern.png') center/cover no-repeat;
            opacity: 0.1;
            z-index: 0;
        }

        .modal-content h3 {
            font-family: 'Amiri', serif;
            color: #D4A017; /* Золотой акцент */
            font-size: 1.5rem;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .modal-content p {
            color: #1A3C34;
            font-size: 14px;
            margin: 5px 0;
            position: relative;
            z-index: 1;
        }

        .modal-content strong {
            color: #1A3C34;
            font-weight: 600;
        }

        .close {
            color: #D4A017; /* Золотой акцент */
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            position: relative;
            z-index: 1;
        }

        .close:hover {
            color: #B8860B; /* Темнее золотого */
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Адаптивность */
        @media (max-width: 576px) {
            .login-container {
                padding: 20px;
                max-width: 100%;
            }
            h1 {
                font-size: 1.5rem;
            }
            .modal-content {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
<div class="login-container">
    <h1>Вход</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="text" name="pinfl" placeholder="Введите ваш ПИНФЛ" pattern="\d{14}" required>
        <input type="password" name="password" placeholder="Введите пароль" required>
        <button type="submit">Войти</button>
    </form>
    <div class="forgot-password" onclick="openModal()">Забыли пароль?</div>
</div>

<!-- Модалка для восстановления пароля -->
<div id="forgotPasswordModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">×</span>
        <h3>Свяжитесь с поддержкой:</h3>
        <p>По вопросам восстановления пароля свяжитесь по номеру:</p>
        <p><strong>+998 (90) 123-45-67</strong></p>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('forgotPasswordModal').style.display = 'block';
    }
    function closeModal() {
        document.getElementById('forgotPasswordModal').style.display = 'none';
    }
    window.onclick = function(event) {
        const modal = document.getElementById('forgotPasswordModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>
</body>
</html>
