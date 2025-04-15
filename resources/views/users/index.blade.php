<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Очередь</title>
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

        /* Таблица */
        .queue-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .queue-table th, .queue-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .queue-table th {
            background-color: #007bff;
            color: white;
        }

        .queue-table tr:hover {
            background-color: #f1f1f1;
        }

        /* Кнопки действий */
        .actions button {
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            color: white;
            transition: background 0.2s;
        }

        .edit-btn {
            background: #ffc107;
        }

        .edit-btn:hover {
            background: #e0a800;
        }

        .delete-btn {
            background: #dc3545;
        }

        .delete-btn:hover {
            background: #c82333;
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
