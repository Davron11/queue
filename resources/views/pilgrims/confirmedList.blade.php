<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Очередь</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .header {
            display: flex;
            justify-content: space-between; /* Размещение элементов с максимальным расстоянием между ними */
            align-items: center; /* Центрируем элементы по вертикали */
            margin-bottom: 10px; /* Добавим небольшой отступ снизу */
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
        }

        .edit-btn, .btn-primary {
            background: #D4A017; /* Золотой как в профиле */
            color: #1A3C34;
        }

        .edit-btn:hover, .btn-primary:hover {
            background: #B8860B; /* Темнее золотого */
            transform: translateY(-2px);
        }

        .delete-btn, .btn-danger {
            background: #D4A017; /* Золотой вместо красного для единообразия */
            color: #1A3C34;
        }

        .delete-btn:hover, .btn-danger:hover {
            background: #B8860B;
            transform: translateY(-2px);
        }

        /* Модальное окно */
        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 30px 40px;
            border-radius: 12px;
            width: 500px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            position: relative;
            font-family: 'Segoe UI', sans-serif;
        }

        .modal-content h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        .modal-content label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #444;
        }

        .modal-content input[type="text"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
            transition: border 0.3s ease;
        }

        .modal-content input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }

        .modal-content button {
            padding: 10px 18px;
            margin-top: 10px;
            margin-right: 10px;
            font-size: 14px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .modal-content .btn-success {
            background-color: #28a745;
            color: white;
        }

        .modal-content .btn-success:hover {
            background-color: #218838;
        }

        .modal-content .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .modal-content .btn-secondary:hover {
            background-color: #5a6268;
        }

        .form-label {
            color: #1A3C34;
            font-weight: 600;
        }

        .form-control, .form-select {
            border: 1px solid #D4A0175e; /* Светло-золотая рамка */
            border-radius: 5px;
            background: #FFFFFF;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: #D4A017;
            box-shadow: 0 0 0 3px rgba(212, 160, 23, 0.2);
            outline: none;
        }

        .modal-footer {
            border-top: none;
            position: relative;
            z-index: 1;
        }

        .btn-secondary {
            background: #1A3C34; /* Тёмный фон */
            color: #FFFFFF;
            border: none;
        }

        .btn-secondary:hover {
            background: #D4A017; /* Золотой при наведении */
            color: #1A3C34;
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
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
<?php
$user = \Illuminate\Support\Facades\Auth::user();
?>
    <!-- Сайдбар -->
@include('layouts.sidebar')

<!-- Контент -->
<div class="content">
    <div class="header">
        <h1>Список подтверждённых</h1>
        <div style="display: flex; gap: 10px;">
            <a href="#" class="btn btn-sm btn-primary" onclick="openAddModal(this)">
                Выбрать
            </a>

            <!-- Форма для отправки POST-запроса на /pilgrims/complete -->
            <form action="{{ route('pilgrims.complete') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-sm btn-success">
                    Завершить
                </button>
            </form>
        </div>
    </div>
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
        @foreach($pilgrims as $index => $pilgrim)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pilgrim->full_name }}</td>
                <td>{{ $pilgrim->pinfl }}</td>
                <td>{{ $pilgrim->phone_number }}</td>
                <td>{{
                            $pilgrim->address->oblast->name .
                            ', ' .
                            $pilgrim->address->city->name .
                            ', ' .
                            $pilgrim->address->district->name .
                            ', ' .
                            $pilgrim->address->mahalla->name .
                            ', ' .
                            $pilgrim->address->home
                        }}</td>
                <td>
                    <form action="{{ route('pilgrims.return', ['id' => $pilgrim->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Отменить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div id="addModal" class="modal" style="display: none; position: fixed; top: 0; left: 0;
    width: 100%; height: 100%; background: rgba(0,0,0,0.5); align-items: center; justify-content: center;">
    <div style="background: white; padding: 20px; border-radius: 8px; width: 300px;">
        <h5>Введите число</h5>
        <form id="addForm" action="{{ route('pilgrims.addConfirm') }}" method="POST">
            @csrf
            <input type="number" name="number" required style="width: 100%; padding: 8px; margin-top: 10px;">
            <div style="margin-top: 15px; text-align: right;">
                <button type="submit" class="btn btn-primary">Подтвердить</button>
                <button type="button" onclick="closeAddModal()" class="btn btn-secondary">Отмена</button>
            </div>
        </form>
    </div>
</div>
<script>
    function openAddModal(button) {
        document.getElementById('addModal').style.display = 'flex';
    }

    function closeAddModal() {
        document.getElementById('addModal').style.display = 'none';
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
