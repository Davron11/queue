<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Очередь</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
@include('layouts.sidebar')

<!-- Контент -->
<div class="content">
    <h1>Очередь</h1>
    <table class="queue-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Названия</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody id="queueList">
            @foreach($districts as $index => $district)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $district->name }}</td>
                    <td>
                        <!-- Здесь можно вставить кнопки: например, редактировать/удалить -->
                        <a href="#"
                           class="btn btn-sm btn-primary editBtn"
                           data-id="{{ $district->id }}"
                           data-name="{{ $district->name }}"
                           data-url="{{ route('districts.update', $district->id) }}"
                           data-bs-toggle="modal"
                           data-bs-target="#editPilgrimModal">
                            Редактировать
                        </a>
                        <form action="{{ route('districts.destroy', $district->id) }}" method="POST" style="display:inline;">
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
<div class="modal fade" id="editPilgrimModal" tabindex="-1" aria-labelledby="editPilgrimModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editPilgrimForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editPilgrimModalLabel">Редактировать паломника</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body row g-3">
                    <input type="hidden" name="id" id="editId">

                    <div class="col-md-6">
                        <label for="editFullName" class="form-label">ФИО</label>
                        <input type="text" class="form-control" name="name" id="editName" required>
                    </div>

                    {{--<div class="col-md-6">
                        <label for="editOblast" class="form-label">Область</label>
                        <select name="oblast_id" id="editOblast" class="form-select" required>
                            @foreach($oblasts as $oblast)
                                <option value="{{ $oblast->id }}">{{ $oblast->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="editCity" class="form-label">Город</label>
                        <select name="city_id" id="editCity" class="form-select" required>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="editDistrict" class="form-label">Район</label>
                        <select name="district_id" id="editDistrict" class="form-select" required>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="editMahalla" class="form-label">Махалля</label>
                        <select name="mahalla_id" id="editMahalla" class="form-select" required>
                            @foreach($mahallas as $mahalla)
                                <option value="{{ $mahalla->id }}">{{ $mahalla->name }}</option>
                            @endforeach
                        </select>
                    </div>--}}
                </div>
                <div class="modal-footer mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
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
