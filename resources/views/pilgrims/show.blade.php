<?php
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
$currentLocale = app()->getLocale();
$otherLocale = ($currentLocale === 'ru') ? 'uz' : 'ru';
?>
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
    <link rel="stylesheet" href="ы">
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
        .btn:hover {
            background: #b88e15;
        }

        /* Обёртка для кнопок */
        .button-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
            position: relative;
            z-index: 1;
        }

        .btn i {
            margin-right: 6px;
        }

        /* Стили таблицы */
        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            position: relative;
            z-index: 1;
        }

        .user-table th, .user-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        .user-table th {
            background-color: #1A3C34;
            color: #F5F5F5;
            font-weight: bold;
        }

        .user-table td {
            background-color: #fff;
            color: #1A3C34;
        }

        .user-table tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

    </style>
</head>
<body>
<div class="profile-card">
    <img src="{{ asset('images/profile.png') }}" alt="Фото профиля" class="profile-photo" id="profilePhoto">
    <h2 id="fullName">{{ $pilgrim->full_name }}</h2>
    <div class="user-info">
        <p><strong>ПИНФЛ:</strong> <span id="pinfl">{{ $pilgrim->pinfl }}</span></p>
        <p><strong>Телефон:</strong> <span id="phone">{{ $pilgrim->phone_number }}</span></p>
        <p><strong>Адрес:</strong> <span id="address">{{ \App\Services\PilgrimService::getAddress($pilgrim) }}</span></p>
        <p><strong>Email:</strong> <span id="email">{{ $pilgrim->email }}</span></p>
    </div>

    <div class="queue-info">
        <h3>Очередь</h3>
        <table>
            <tr>
                <th>#</th>
                <th>{{ __('messages.hajj') }}</th>
                <th>{{ __('messages.umra') }}</th>
            </tr>
            <tr>
                <td>{{ __('messages.position') }}</td>
                <td>{{ \App\Services\PilgrimService::getPosition($pilgrim, 'hajj') }}</td>
                <td>{{ \App\Services\PilgrimService::getPosition($pilgrim, 'umra') }}</td>
            </tr>
            <tr>
                <td>{{ __('messages.status') }}</td>
                <td>{{ __('messages.' . $pilgrim->hajj_status) }}</td>
                <td>{{ __('messages.' . $pilgrim->umra_status) }}</td>
            </tr>
            <tr>
                <td>{{ __('messages.waiting_time') }}</td>
                <td>{{ \App\Services\PilgrimService::getHajjWaitingTime($pilgrim) . ' ' . __('messages.years') }}</td>
                <td></td>
            </tr>
        </table>
    </div>
    <form method="POST" action="{{ route('locale.switch') }}">
        @csrf
        @if($currentLocale === 'uz')
            <button class="btn" type="submit" name="locale" value="ru">
                {{ __('messages.ru') }}
            </button>
        @elseif($currentLocale === 'ru')
            <button class="btn" type="submit" name="locale" value="uz">
                {{ __('messages.uz') }}
            </button>
        @endif
    </form>
    <button class="btn" onclick="logout()">Выход</button>
    <button class="btn" onclick="window.open('{{ route("tour_operators") }}')">
        <i class="fa-solid fa-window-restore"></i> Тур агенства
    </button>

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
