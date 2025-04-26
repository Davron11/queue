<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Профиль пользователя | Haj Queue Uzbekistan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Rubik и Amiri -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&family=Amiri:wght@700&display=swap" rel="stylesheet">
    <!-- Font Awesome для иконок -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Основные стили */
        body {
            font-family: 'Rubik', sans-serif;
            background-color: #F5F5F5;
            color: #1A3C34;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        /* Карточка профиля */
        .profile-card {
            background: #FFFFFF;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
            padding: 30px;
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
            pointer-events: none; /* <-- вот это добавь */
        }


        /* Фото профиля */
        .profile-photo {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #D4A017;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        /* Заголовок */
        .profile-card h2 {
            font-family: 'Amiri', serif;
            color: #D4A017;
            font-size: 2rem;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        /* Информация о пользователе */
        .user-info {
            background: #F5F5F5;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: left;
            position: relative;
            z-index: 1;
        }

        .user-info p {
            margin: 8px 0;
            font-size: 1rem;
            display: flex;
            align-items: center;
        }

        .user-info i {
            color: #D4A017;
            margin-right: 10px;
        }

        .user-info strong {
            color: #1A3C34;
            font-weight: 600;
        }

        /* Очередь */
        .queue-info {
            background: #1A3C34;
            color: #FFFFFF;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            position: relative;
            z-index: 1;
        }

        .queue-info h3 {
            font-family: 'Amiri', serif;
            color: #D4A017;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .queue-info p {
            margin: 5px 0;
            font-size: 0.95rem;
        }

        /* Кнопки */
        .btn-custom {
            display: inline-block;
            padding: 10px 25px;
            margin: 10px 5px;
            font-size: 1rem;
            font-weight: 600;
            color: #1A3C34;
            background: #D4A017;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        .btn-custom:hover {
            background: #B8860B;
            transform: translateY(-2px);
        }

        /* Адаптивность */
        @media (max-width: 576px) {
            .profile-card {
                padding: 20px;
                max-width: 100%;
            }
            .profile-photo {
                width: 100px;
                height: 100px;
            }
            .profile-card h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
<div class="profile-card">
    <img src="https://via.placeholder.com/130" alt="Фото профиля" class="profile-photo" id="profilePhoto">
    <h2 id="fullName">Иванов Иван Иванович</h2>
    <div class="user-info">
        <p><i class="fas fa-id-card"></i> <strong>ПИНФЛ:</strong> <span id="pinfl">12345678901234</span></p>
        <p><i class="fas fa-phone"></i> <strong>Телефон:</strong> <span id="phone">+998 (90) 123-45-67</span></p>
        <p><i class="fas fa-map-marker-alt"></i> <strong>Адрес:</strong> <span id="address">г. Ташкент, ул. Мирзо Улугбека, 45</span></p>
        <p><i class="fas fa-envelope"></i> <strong>Email:</strong> <span id="email">ivanov@example.com</span></p>
    </div>
    <div class="queue-info">
        <h3>Очередь</h3>
        <p><strong>Позиция:</strong> <span id="queuePosition">42</span></p>
        <p><strong>Статус:</strong> <span id="queueStatus">Ожидание</span></p>
        <p><strong>Ориентировочное время ожидания:</strong> <span id="estimatedTime">3 недели</span></p>
    </div>
    <button class="btn-custom" onclick="window.location.href='{{ route('dashboard') }}'">Панель</button>
    <button class="btn-custom" onclick="logout()">Выход</button>
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
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
