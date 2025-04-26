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
{{--<div class="sidebar">
    <h2>Админ Панель</h2>
    <a href="{{ route('add') }}">Добавить жителя</a>
    @if(!in_array($user->role->slug, ['users']))
        <a href="{{ route('users.index') }}">Управление администраторами</a>
    @endif
    <a href="{{ route('pilgrims.index') }}">Очередь</a>
    @if(in_array($user->role->slug, ['root_admin']))
        <a href="{{ route('states.index') }}">Области</a>
    @endif
    @if(in_array($user->role->slug, ['root_admin', 'state_admin']))
        <a href="{{ route('cities.index') }}">Города</a>
    @endif
    @if(in_array($user->role->slug, ['root_admin', 'state_admin', 'city_admin']))
        <a href="{{ route('districts.index') }}">Район</a>
    @endif
    @if(in_array($user->role->slug, ['root_admin', 'state_admin', 'city_admin', 'mahalla_admin']))
        <a href="{{ route('mahallas.index') }}">Махалла</a>
    @endif
    <a href="{{ route('status') }}">Профиль</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <a href="#" onclick="document.getElementById('logout-form').submit(); return false;">Выход</a>
</div>--}}
@include('layouts/sidebar')
<!-- Контент -->
<div class="content">
    <h1>Добро пожаловать, {{ $user->full_name }}!</h1>
    <div class="card-container">
        <div class="card">
            <h3>Жители</h3>
            <p>Всего: <span id="total-residents">0</span></p>
        </div>
        <div class="card">
            <h3>Очередь</h3>
            <p>В ожидании: <span id="queue-count">0</span></p>
        </div>
        <div class="card">
            <h3>Администраторы</h3>
            <p>Всего: <span id="admin-count">0</span></p>
        </div>
    </div>
</div>

<script>
    // Заглушка для демонстрации работы статистики
    document.getElementById('total-residents').textContent = 145;
    document.getElementById('queue-count').textContent = 57;
    document.getElementById('admin-count').textContent = 20;
</script>
</body>

</html>
