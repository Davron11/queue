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

        /* Модалки */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

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

        /* Кнопка закрытия */
        .close {
            color: #aaa;
            position: absolute;
            top: 12px;
            right: 16px;
            font-size: 26px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
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
                        <a href="#" class="btn btn-sm btn-primary"
                           onclick="openEditModal({{ $user->id }}, '{{ $user->full_name }}', '{{ $user->pinfl }}', '{{ $user->phone_number }}', '{{ $user->address }}')">
                            Редактировать
                        </a>
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

<div id="editModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editModal')">&times;</span>
        <h2>Редактировать пользователя</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label>ФИО</label>
                <input type="text" name="full_name" id="edit_full_name" value="{{ old('full_name', $user->full_name) }}" required>
            </div>

            <div>
                <label>ПИНФЛ</label>
                <input type="text" name="pinfl" id="edit_pinfl" value="{{ old('pinfl', $user->pinfl) }}" required>
            </div>

            <div>
                <label>Номер телефона</label>
                <input type="text" name="phone_number" id="edit_phone_number" value="{{ old('phone_number', $user->phone_number) }}" required>
            </div>

            <!-- Новые поля -->
            <div>
                <label>Область</label>
                <select name="oblast_id" id="edit_oblast_id" required>
                    <option value="">Выберите область</option>
                    @foreach($oblasts as $oblast)
                        <option value="{{ $oblast->id }}" {{ old('oblast_id', $user->oblast_id) == $oblast->id ? 'selected' : '' }}>
                            {{ $oblast->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Город</label>
                <select name="city_id" id="edit_city_id" required>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" {{ old('city_id', $user->address->city_id) == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Район</label>
                <select name="district_id" id="edit_district_id" required>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}" {{ old('district_id', $user->address->district_id) == $district->id ? 'selected' : '' }}>
                            {{ $district->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Махалла</label>
                <select name="mahalla_id" id="edit_mahalla_id" required>
                    @foreach($mahallas as $mahalla)
                        <option value="{{ $mahalla->id }}" {{ old('mahalla_id', $user->address->mahalla_id) == $mahalla->id ? 'selected' : '' }}>
                            {{ $mahalla->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Дом</label>
                <input type="text" name="home" id="edit_home" value="{{ old('home', $user->address->home) }}" required>
            </div>

            <button type="submit" class="btn btn-success">Сохранить</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal('editModal')">Отмена</button>
        </form>
    </div>
</div>

<script>
    // Функция для открытия модалки редактирования
    function openEditModal(id, fullName, pinfl, phoneNumber, address, oblastId, cityId, districtId, mahallaId, home) {
        const form = document.getElementById('editForm');
        form.action = `/users/${id}`; // маршрут обновления

        document.getElementById('edit_full_name').value = fullName;
        document.getElementById('edit_pinfl').value = pinfl;
        document.getElementById('edit_phone_number').value = phoneNumber;
        document.getElementById('edit_home').value = home;

        // Устанавливаем выбранные значения для селекторов
        document.getElementById('edit_oblast_id').value = oblastId;
        document.getElementById('edit_city_id').value = cityId;
        document.getElementById('edit_district_id').value = districtId;
        document.getElementById('edit_mahalla_id').value = mahallaId;

        // Если нужно, добавьте здесь логику для динамической загрузки данных городов, районов и махалл
        // через AJAX в зависимости от выбранной области, города и т.д.

        document.getElementById('editModal').style.display = 'block';
    }

    // Функция для открытия модалки удаления
    function openDeleteModal(actionUrl) {
        document.getElementById('deleteForm').action = actionUrl;
        document.getElementById('deleteModal').style.display = 'block';
    }

    // Функция для закрытия модалки
    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }

    // Закрытие модалки при клике вне её
    window.onclick = function(event) {
        ['editModal', 'deleteModal'].forEach(modalId => {
            let modal = document.getElementById(modalId);
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    }
</script>
</body>
</html>
