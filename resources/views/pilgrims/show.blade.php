<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Профиль пользователя</title>
    <!-- Google Fonts: Rubik и Amiri -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&family=Amiri:wght@700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Основные стили */
        body {
            font-family: 'Rubik', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F5F5F5; /* Фон как в профиле */
            color: #1A3C34; /* Основной цвет текста */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Карточка профиля */
        .profile-card {
            background: #FFFFFF; /* Белый фон как в profile-card */
            padding: 20px;
            border-radius: 15px; /* Закругления как в профиле */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Тень */
            max-width: 400px;
            width: 100%;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Фоновый орнамент */
        .profile-card::before {
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

        /* Фото профиля */
        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #D4A017; /* Золотая рамка */
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }

        /* Заголовок */
        h2 {
            font-family: 'Amiri', serif; /* Шрифт как в профиле */
            color: #D4A017; /* Золотой акцент */
            font-size: 1.8rem;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }

        /* Информация о пользователе */
        .user-info {
            margin-bottom: 15px;
            text-align: left;
            position: relative;
            z-index: 1;
        }

        .user-info p {
            margin: 5px 0;
            font-size: 16px;
            color: #1A3C34; /* Тёмный текст */
        }

        .user-info strong {
            color: #D4A017; /* Золотой акцент */
            font-weight: 600;
        }

        /* Статус и ожидание */
        .queue-info {
            margin-top: 15px;
            padding: 15px;
            background: #1A3C34; /* Тёмный фон как в queue-info */
            border-radius: 5px;
            color: #F5F5F5; /* Светлый текст */
            position: relative;
            z-index: 1;
        }

        .queue-info h3 {
            font-family: 'Amiri', serif;
            color: #D4A017; /* Золотой акцент */
            font-size: 1.4rem;
            margin-bottom: 10px;
        }

        .queue-info p {
            margin: 5px 0;
            font-size: 14px;
        }

        .queue-info strong {
            color: #D4A017; /* Золотой акцент */
            font-weight: 600;
        }

        /* Кнопка выхода */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            color: #1A3C34; /* Тёмный текст */
            background: #D4A017; /* Золотой фон */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s, transform 0.2s;
            position: relative;
            z-index: 1;
        }

        .btn:hover {
            background: #B8860B; /* Темнее золотого */
            transform: translateY(-2px);
        }

        /* Адаптивность */
        @media (max-width: 576px) {
            .profile-card {
                padding: 15px;
                max-width: 100%;
            }

            h2 {
                font-size: 1.5rem;
            }

            .queue-info h3 {
                font-size: 1.2rem;
            }

            .user-info p, .queue-info p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
<div class="profile-card">
    <img src="https://via.placeholder.com/120" alt="Фото профиля" class="profile-photo" id="profilePhoto">
    <h2 id="fullName">Иванов Иван Иванович</h2>
    <div class="user-info">
        <p><strong>ПИНФЛ:</strong> <span id="pinfl">{{ $pilgrim->pinfl }}</span></p>
        <p><strong>Телефон:</strong> <span id="phone">{{ $pilgrim->phone }}</span></p>
        <p><strong>Адрес:</strong> <span id="address">{{ $pilgrim->address }}</span></p>
        <p><strong>Email:</strong> <span id="email">ivanov@example.com</span></p>
    </div>

    <div class="queue-info">
        <h3>Очередь</h3>
        <p><strong>Позиция:</strong> <span id="queuePosition">42</span></p>
        <p><strong>Статус:</strong> <span id="queueStatus">Ожидание</span></p>
        <p><strong>Ориентировочное время ожидания:</strong> <span id="estimatedTime">3 недели</span></p>
    </div>

    <button class="btn" onclick="logout()">Выход</button>
</div>

<script>
    function logout() {
        if (confirm('Вы уверены, что хотите выйти?')) {
            fetch('/logout', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                if (response.ok) {
                    window.location.href = '/login';
                } else {
                    alert('Ошибка при выходе. Попробуйте снова.');
                }
            }).catch(error => console.error('Ошибка:', error));
        }
    }
</script>
</body>
</html>
