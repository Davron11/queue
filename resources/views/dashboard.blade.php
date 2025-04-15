<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Панель администратора</title>
    <style>
        /* Общие стили */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
        }

        /* Сайдбар */
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            height: 100vh;
            padding: 20px;
            position: fixed;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            text-decoration: none;
            color: white;
            background: #007bff;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            transition: background 0.2s;
        }

        .sidebar a:hover {
            background: #0056b3;
        }

        /* Контент */
        .content {
            margin-left: 270px;
            padding: 20px;
            width: 100%;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        /* Карточки */
        .card-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 250px;
            text-align: center;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            color: #007bff;
            margin-bottom: 10px;
        }

        .card p {
            color: #333;
        }
    </style>
</head>

<body>
<!-- Сайдбар -->
<div class="sidebar">
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

</div>

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
