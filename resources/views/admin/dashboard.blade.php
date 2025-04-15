<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель</title>
    <link rel="stylesheet" href="dashboard.css"> <!-- Подключи стили -->
</head>
<body>
    <div class="admin-container">
        <aside class="sidebar">
            <h2>Админ-панель</h2>
            <ul class="nav-menu">
                <li><a href="#"><i class="fas fa-desktop"></i> Мониторинг</a></li>
                <li><a href="#"><i class="fas fa-users-cog"></i> Управление пользователями</a></li>
                <li><a href="{{ route('pilgrims.index') }}"><i class="fas fa-list-ol"></i> Очередь</a></li>

                {{-- Администрирование по уровням --}}
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
                <li><a href="#"><i class="fas fa-sign-out-alt"></i> Выход</a></li>
            </ul>

        </aside>

        <main class="content">
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
                            <td><button>Изменить</button> <button>Удалить</button></td>
                        </tr>

                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <script src="dashboard.js"></script>
</body>
</html>
