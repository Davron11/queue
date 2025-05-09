<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Панель администратора</title>
    <!-- Google Fonts: Rubik и Amiri -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&family=Amiri:wght@700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Общие стили */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Rubik', sans-serif;
            background: #F5F5F5; /* Фон как в профиле */
            color: #1A3C34; /* Основной цвет текста */
            display: flex;
        }

        /* Сайдбар */
        .sidebar {
            width: 250px;
            background-color: #1A3C34; /* Как в queue-info */
            color: #FFFFFF;
            height: 100vh;
            padding: 20px;
            position: fixed;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .sidebar h2 {
            font-family: 'Amiri', serif; /* Шрифт как в заголовках профиля */
            color: #D4A017; /* Золотой акцент */
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        .sidebar a {
            text-decoration: none;
            color: #F5F5F5; /* Светлый текст */
            background: transparent; /* Убираем синий фон */
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
            font-size: 1rem;
        }

        .sidebar a:hover {
            background: #D4A017; /* Золотой при наведении */
            color: #1A3C34;
        }

        /* Контент */
        .content {
            margin-left: 270px;
            padding: 20px;
            width: 100%;
        }

        h1 {
            font-family: 'Amiri', serif; /* Шрифт как в профиле */
            color: #D4A017; /* Золотой акцент */
            margin-bottom: 20px;
            font-size: 2rem;
        }

        /* Карточки */
        .card-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            background: #FFFFFF; /* Белый фон как в profile-card */
            padding: 20px;
            border-radius: 15px; /* Закругления как в профиле */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Тень */
            width: 250px;
            text-align: center;
            transition: transform 0.3s;
            position: relative;
            overflow: hidden;
        }

        /* Фоновый орнамент для карточек */
        .card::before {
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

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            font-family: 'Amiri', serif;
            color: #D4A017; /* Золотой акцент */
            margin-bottom: 10px;
            font-size: 1.4rem;
            position: relative;
            z-index: 1;
        }

        .card p {
            color: #1A3C34; /* Тёмный текст */
            font-size: 1rem;
            position: relative;
            z-index: 1;
        }

        .card p span {
            font-weight: 600;
            color: #D4A017; /* Золотой для чисел */
        }

        /* Адаптивность */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .content {
                margin-left: 0;
                padding: 15px;
            }

            h1 {
                font-size: 1.5rem;
            }

            .card {
                width: 100%;
                max-width: 300px;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>
<!-- Сайдбар -->
@include('layouts/sidebar')
<!-- Контент -->
<div class="content">
    <h1>{{ __('messages.welcome') }}, {{ $user->full_name }}!</h1>
    <div class="card-container">
        <div class="card">
            <h3>{{ __('messages.residents') }}</h3>
            <p>{{ __('messages.all') }}: <span id="total-residents">{{ $pilgrims_count }}</span></p>
        </div>
        <div class="card">
            <h3>{{ __('messages.queue') }}</h3>
            <p>{{ __('messages.waiting') }}: <span id="queue-count">{{ $confirmed_pilgrims_count }}</span></p>
        </div>
        <div class="card">
            <h3>{{ __('messages.admins') }}</h3>
            <p>{{ __('messages.all') }}: <span id="admin-count">{{ $admins_count }}</span></p>
        </div>
    </div>
</div>
</body>

</html>
