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
            background: #FFFFFF; /* Белый фон */
            border-radius: 15px; /* Закругления как в профиле */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .modal-content::before {
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

        .modal-header {
            background: #1A3C34; /* Как в queue-info */
            color: #FFFFFF;
            border-bottom: none;
            position: relative;
            z-index: 1;
        }

        .modal-title {
            font-family: 'Amiri', serif;
            color: #D4A017; /* Золотой акцент */
            font-size: 1.5rem;
        }

        .modal-body {
            background: #F5F5F5; /* Фон как в user-info */
            position: relative;
            z-index: 1;
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
<!-- Сайдбар -->
@include('layouts.sidebar')

<!-- Контент -->
<div class="content">
    <h1>{{ __('messages.mahallas') }}</h1>
    <table class="queue-table">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('messages.name') }}</th>
            <th>{{ __('messages.actions') }}</th>
        </tr>
        </thead>
        <tbody id="queueList">
        @foreach($mahallas as $index => $mahalla)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $mahalla->name }}</td>
                <td>
                    <!-- Здесь можно вставить кнопки: например, редактировать/удалить -->
                    <a href="#"
                       class="btn btn-sm btn-primary editBtn"
                       data-id="{{ $mahalla->id }}"
                       data-name="{{ $mahalla->name }}"
                       data-url="{{ route('mahallas.update', $mahalla->id) }}"
                       data-bs-toggle="modal"
                       data-bs-target="#editPilgrimModal">
                        {{ __('messages.edit') }}
                    </a>
                    <form action="{{ route('mahallas.destroy', $mahalla->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">{{ __('messages.delete') }}</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="modal fade" id="editPilgrimModal" tabindex="-1" aria-labelledby="editPilgrimModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editPilgrimForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editPilgrimModalLabel">{{ __('messages.edit') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body row g-3">
                    <input type="hidden" name="pilgrim_id" id="editId">

                    <div class="col-md-6">
                        <label for="editName" class="form-label">{{ __('messages.name') }}</label>
                        <input type="text" class="form-control" name="name" id="editName" required>
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('editPilgrimModal');
        const form = document.getElementById('editPilgrimForm');

        document.querySelectorAll('.editBtn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const actionUrl = this.dataset.url;

                // Заполняем форму
                form.action = actionUrl;
                document.getElementById('editId').value = id;
                document.getElementById('editName').value = name;
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
