<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Очередь</title>
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
            position: relative;
        }

        h1 {
            font-family: 'Amiri', serif; /* Шрифт как в профиле */
            color: #D4A017; /* Золотой акцент */
            margin-bottom: 20px;
            font-size: 2rem;
        }

        /* Таблица */
        .queue-table {
            width: 100%;
            border-collapse: collapse;
            background: #FFFFFF; /* Белый фон как в profile-card */
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Тень как в профиле */
            overflow: hidden;
            position: relative;
        }

        /* Фоновый орнамент для таблицы */
        .queue-table::before {
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

        .queue-table th, .queue-table td {
            padding: 12px;
            border-bottom: 1px solid #D4A0175e; /* Светло-золотая граница */
            text-align: left;
            position: relative;
            z-index: 1;
        }

        .queue-table th {
            background-color: #1A3C34; /* Как в queue-info */
            color: #FFFFFF;
            font-family: 'Amiri', serif;
            font-size: 1.1rem;
        }

        .queue-table tr:hover {
            background-color: #F5F5F5; /* Фон как в user-info */
        }

        /* Кнопки действий */
        .actions button, .btn {
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: background 0.3s, transform 0.2s;
            display: inline-block;
            text-align: center;
            text-decoration: none;
            color: #1A3C34;
        }

        .btn-primary {
            background: #D4A017; /* Золотой как в профиле */
        }

        .btn-primary:hover {
            background: #B8860B; /* Темнее золотого */
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #D4A017; /* Золотой вместо красного для единообразия */
        }

        .btn-danger:hover {
            background: #B8860B;
            transform: translateY(-2px);
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

            .queue-table th, .queue-table td {
                padding: 8px;
                font-size: 0.9rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            .btn {
                padding: 4px 8px;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .queue-table {
                display: block;
                overflow-x: auto;
            }

            .queue-table th, .queue-table td {
                min-width: 120px;
            }
        }
    </style>
</head>
<body>
<!-- Сайдбар -->
@include("layouts.sidebar")

<!-- Контент -->
<div class="content">
    <h1>Очередь</h1>
    <table class="queue-table">
        <thead>
        <tr>
            <th>#</th>
            <th>ФИО</th>
            <th>ПИНФЛ</th>
            <th>Номер телефона</th>
            <th>Адрес</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody id="queueList">
        @foreach($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->pinfl }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->address }}</td>
                <td>
                    <!-- Здесь можно вставить кнопки: например, редактировать/удалить -->
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Редактировать</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{--<script>
    // Пример данных для очереди
    const queueData = [
        { id: 1, name: "Иван Иванов", pinfl: "12345678901234", phone: "+998901234567", address: "г. Ташкент, ул. Амира Темура, д.10" },
        { id: 2, name: "Ольга Петрова", pinfl: "23456789012345", phone: "+998931234567", address: "г. Самарканд, ул. Буюк Ипак Йули, д.5" },
        { id: 3, name: "Сергей Смирнов", pinfl: "34567890123456", phone: "+998951234567", address: "г. Бухара, ул. Навои, д.3" }
    ];
    // Функция для отрисовки данных в таблице
    function renderQueue() {
        const queueList = document.getElementById("queueList");
        queueList.innerHTML = "";

        queueData.forEach((resident, index) => {
            const row = document.createElement("tr");

            row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${resident.name}</td>
                    <td>${resident.pinfl}</td>
                    <td>${resident.phone}</td>
                    <td>${resident.address}</td>
                    <td class="actions">
                        <button class="edit-btn" onclick="editResident(${resident.id})">Изменить</button>
                        <button class="delete-btn" onclick="deleteResident(${resident.id})">Удалить</button>
                    </td>
                `;
            queueList.appendChild(row);
        });
    }

    // Функции редактирования и удаления
    function editResident(id) {
        alert("Редактирование жителя ID: " + id);
    }

    function deleteResident(id) {
        if (confirm("Вы уверены, что хотите удалить жителя ID: " + id + "?")) {
            alert("Житель ID: " + id + " удален");
        }
    }

    // Инициализация списка при загрузке страницы
    window.onload = renderQueue;
</script>--}}
</body>
</html>
