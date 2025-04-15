<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Профиль пользователя</title>
    <style>
        /* Основные стили */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Карточка профиля */
        .profile-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        /* Фото профиля */
        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #007bff;
            margin-bottom: 15px;
        }

        /* Информация о пользователе */
        .user-info {
            margin-bottom: 15px;
            text-align: left;
        }

        .user-info p {
            margin: 5px 0;
            font-size: 16px;
        }

        .user-info strong {
            color: #007bff;
        }

        /* Статус и ожидание */
        .queue-info {
            margin-top: 15px;
            padding: 15px;
            background: #e9ecef;
            border-radius: 5px;
        }

        /* Кнопка выхода */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            color: white;
            background: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn:hover {
            background: #0056b3;
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
