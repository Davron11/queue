<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Админ-панель | Haj Queue Uzbekistan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Rubik и Amiri -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&family=Amiri:wght@700&display=swap" rel="stylesheet">
    <!-- Font Awesome для иконок -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Rubik', sans-serif;
            background-color: #F5F5F5;
            color: #1A3C34;
            display: flex;
            min-height: 100vh;
        }

        /* Боковая панель */
        .sidebar {
            width: 250px;
            background-color: #1A3C34;
            color: #FFFFFF;
            padding: 30px 20px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
        }

        .sidebar h2 {
            font-family: 'Amiri', serif;
            color: #D4A017;
            font-size: 24px;
            margin-bottom: 30px;
            text-align: center;
            border-bottom: 1px solid #D4A017;
            padding-bottom: 15px;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-menu li a {
            display: flex;
            align-items: center;
            color: #FFFFFF;
            text-decoration: none;
            padding: 12px 15px;
            margin-bottom: 10px;
            border-radius: 6px;
            font-size: 15px;
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-menu li a i {
            margin-right: 10px;
        }

        .nav-menu li a:hover {
            background-color: #D4A017;
            color: #1A3C34;
        }

        .nav-menu li a.active {
            background-color: #D4A017;
            color: #1A3C34;
            font-weight: 600;
        }

        /* Основной контент */
        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 40px;
            min-height: 100vh;
            position: relative;
        }

        .main::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/storage/islamic-pattern.png') center/cover no-repeat;
            opacity: 0.05;
            z-index: -1;
        }

        h1 {
            font-family: 'Amiri', serif;
            color: #D4A017;
            font-size: 32px;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Карточки */
        .dashboard {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 40px;
            animation: fadeIn 0.5s ease-in;
        }

        .card {
            background: #FFFFFF;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            flex: 1;
            min-width: 200px;
            text-align: center;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            font-family: 'Amiri', serif;
            color: #1A3C34;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 24px;
            color: #D4A017;
            font-weight: 700;
        }

        /* Таблица */
        .user-management {
            background: #FFFFFF;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in;
        }

        .user-management h2 {
            font-family: 'Amiri', serif;
            color: #D4A017;
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #F5F5F5;
        }

        th {
            background: #1A3C34;
            color: #FFFFFF;
            font-weight: 600;
        }

        td {
            color: #1A3C34;
        }

        td button {
            padding: 8px 15px;
            margin-right: 5px;
            border: none;
            border-radius: 5px;
            font-size: 13px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        td button.edit {
            background-color: #D4A017;
            color: #1A3C34;
        }

        td button.edit:hover {
            background-color: #B8860B;
            transform: translateY(-2px);
        }

        td button.delete {
            background-color: #dc3545;
            color: #FFFFFF;
        }

        td button.delete:hover {
            background-color: #b02a37;
            transform: translateY(-2px);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
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

            .main {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }

            .dashboard {
                flex-direction: column;
            }

            .card {
                min-width: 100%;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
<div class="admin-container">
    <aside class="sidebar">
        <h2>Админ-панель</h2>
        <ul class="nav-menu">
            <li><a href="#"><i class="fas fa-desktop"></i> Мониторинг</a></li>
            <li><a href="#"><i class="fas fa-users-cog"></i> Управление пользователями</a></li>
            <li><a href="{{ route('pilgrims.index') }}"><i class="fas fa-list-ol"></i> Очередь</a></li>
            @if(in_array($user->role->slug, ['root_admin']))
                <li><a href="{{ route('states.index') }}"><i class="fas fa-globe"></i> Республика</a></li>
            @endif
            @if(in_array($user->role->slug, ['root_admin', 'state_admin']))
                <li><a href="{{ route('cities.index') }}"><i class="fas fa-city"></i> Города</a></li>
            @endif
            @if(in_array($user->role->slug, ['root_admin', 'state_admin', 'city_admin']))
                <li><a href="{{ route('districts.index') }}"><i class="fas fa-map-marker-alt"></i> Районы</a></li>
            @endif
            @if(in_array($user->role->slug, ['root_admin', 'state_admin', 'city_admin', 'mahalla_admin']))
                <li><a href="{{ route('mahallas.index') }}"><i class="fas fa-home"></i> Махалли</a></li>
            @endif
            <li><a href="#"><i class="fas fa-history"></i> История изменений</a></li>
            <li><a href="#"><i class="fas fa-bell"></i> Уведомления</a></li>
            <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Выход</a></li>
        </ul>
    </aside>

    <main class="main">
        <h1>Добро пожаловать, Администратор</h1>
        <section class="dashboard">
            <div class="card">
                <h3>Всего пользователей</h3>
                <p>1245</p>
            </div>
            <div class="card">
                <h3>Очередь</h3>
                <p>320</p>
            </div>
            <div class="card">
                <h3>Обработанные заявки</h3>
                <p>980</p>
            </div>
        </section>

        <section class="user-management">
            <h2>Управление пользователями</h2>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>ФИО</th>
                    <th>Телефон</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Иван Иванов</td>
                    <td>+998901234567</td>
                    <td>Активен</td>
                    <td>
                        <button class="edit"><i class="fas fa-edit"></i> Изменить</button>
                        <button class="delete"><i class="fas fa-trash"></i> Удалить</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </section>
    </main>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Пример обработки кнопок (добавить реальную логику в Laravel)
    document.querySelectorAll('.edit').forEach(button => {
        button.addEventListener('click', () => {
            alert('Редактирование пользователя...');
            // Перенаправление на маршрут редактирования
        });
    });

    document.querySelectorAll('.delete').forEach(button => {
        button.addEventListener('click', () => {
            if (confirm('Вы уверены, что хотите удалить пользователя?')) {
                alert('Пользователь удален');
                // Запрос на удаление через fetch
            }
        });
    });
</script>
</body>
</html>
