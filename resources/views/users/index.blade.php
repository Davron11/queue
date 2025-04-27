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
        .content {
            width: 100%;
        }
        .header {
            display: flex;
            justify-content: space-between; /* Размещение элементов с максимальным расстоянием между ними */
            align-items: center; /* Центрируем элементы по вертикали */
            margin-bottom: 10px; /* Добавим небольшой отступ снизу */
        }
        h1 {
            margin: 0; /* Убираем стандартные отступы */
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
    <div class="header">
        <h1>Очередь</h1>
        <a href="#" class="btn btn-sm btn-primary" onclick="openEditModal(this)">
            Создать
        </a>
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
            @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->pinfl }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{
                            $user->address ? (
                                $user->address->oblast->name . ' ' .
                                $user->address->city->name . ' ' .
                                $user->address->oblast->name . ' ' .
                                $user->address->mahalla->name . ' ' .
                                $user->address->home
                            ) : ''

                    }}</td>
                    <td>
                        <!-- Здесь можно вставить кнопки: например, редактировать/удалить -->
                        <a href="#" class="btn btn-sm btn-primary"
                           data-user=' {{json_encode([
                               "id" => $user->id,
                               "full_name" => $user->full_name,
                               "pinfl" => $user->pinfl,
                               "phone_number" => $user->phone_number,
                               "address" => [
                                   "oblast_id" => $user->address->oblast_id ?? '',
                                   "city_id" => $user->address->city_id ?? '',
                                   "district_id" => $user->address->district_id ?? '',
                                   "mahalla_id" => $user->address->mahalla_id ?? '',
                                   "home" => $user->address->home ?? ''
                               ],
                               "passport_series" => $user->passport_data ?? '',
                               "passport_number" => $user->passport_number ?? '',
                               "role_id" => $user->role_id ?? ''
                           ])}}'
                           onclick="openEditModal(this)">
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

            <div>
                <label>Серия паспорта</label>
                <input type="text" name="passport_series" id="edit_passport_series" value="{{ old('passport_series', $user->passport_series ?? '') }}" required>
            </div>

            <div>
                <label>Роль</label>
                <select name="role_id" id="edit_role_id" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id', $user->role_id ?? '') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Новый пароль</label>
                <input type="password" name="password" id="edit_password" placeholder="Введите новый пароль">
            </div>

            <!-- Новые поля -->
            <div>
                <label>Область</label>
                <select name="oblast_id" id="edit_oblast_id" required>
                    <option value="">Выберите область</option>
                    @foreach($oblasts as $oblast)
                        <option value="{{ $oblast->id }}" {{ old('oblast_id', $user->address->oblast_id ?? '') == $oblast->id ? 'selected' : '' }}>
                            {{ $oblast->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Город</label>
                <select name="city_id" id="edit_city_id" required>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" {{ old('city_id', $user->address->city_id ?? '') == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Район</label>
                <select name="district_id" id="edit_district_id" required>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}" {{ old('district_id', $user->address->district_id ?? '') == $district->id ? 'selected' : '' }}>
                            {{ $district->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Махалла</label>
                <select name="mahalla_id" id="edit_mahalla_id" required>
                    @foreach($mahallas as $mahalla)
                        <option value="{{ $mahalla->id }}" {{ old('mahalla_id', $user->address->mahalla_id ?? '') == $mahalla->id ? 'selected' : '' }}>
                            {{ $mahalla->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Дом</label>
                <input type="text" name="home" id="edit_home" value="{{ old('home', $user->address->home ?? '') }}" required>
            </div>

            <button type="submit" class="btn btn-success">Сохранить</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal('editModal')">Отмена</button>
        </form>
    </div>
</div>

<script>
    function openEditModal(element) {
        const userData = JSON.parse(element.getAttribute('data-user'));

        const form = document.getElementById('editForm');
        const modal = document.getElementById('editModal');
        console.log(userData)
        // Если userData.id пустой, это значит, что мы создаём нового пользователя
        if (!userData) {
            // Для создания нового пользователя форма должна использовать POST
            form.action = '/users'; // Или route('users.store') для использования с именованным маршрутом
            form.method = 'POST';

            // Очистка всех полей формы для создания
            document.getElementById('edit_full_name').value = '';
            document.getElementById('edit_pinfl').value = '';
            document.getElementById('edit_phone_number').value = '';
            document.getElementById('edit_home').value = '';
            document.getElementById('edit_oblast_id').value = '';
            document.getElementById('edit_city_id').value = '';
            document.getElementById('edit_district_id').value = '';
            document.getElementById('edit_mahalla_id').value = '';
            document.getElementById('edit_passport_series').value = '';
            document.getElementById('edit_role_id').value = '';

            // Очистка поля пароля
            document.getElementById('edit_password').value = '';

            // Убираем скрытое поле для метода PUT
            const methodField = form.querySelector('[name="_method"]');
            if (methodField) {
                methodField.remove();
            }
        } else {
            // Если id есть, это значит, что мы редактируем существующего пользователя
            form.action = `/users/${userData.id}`; // Или route('users.update', userData.id)
            form.method = 'POST'; // Метод по умолчанию

            // Добавляем скрытое поле _method с PUT
            if (!form.querySelector('[name="_method"]')) {
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'PUT';
                form.appendChild(methodField);
            }

            // Заполняем форму данными пользователя
            document.getElementById('edit_full_name').value = userData.full_name;
            document.getElementById('edit_pinfl').value = userData.pinfl;
            document.getElementById('edit_phone_number').value = userData.phone_number;
            document.getElementById('edit_home').value = userData.address.home;
            document.getElementById('edit_oblast_id').value = userData.address.oblast_id;
            document.getElementById('edit_city_id').value = userData.address.city_id;
            document.getElementById('edit_district_id').value = userData.address.district_id;
            document.getElementById('edit_mahalla_id').value = userData.address.mahalla_id;
            document.getElementById('edit_passport_series').value = userData.passport_series;
            document.getElementById('edit_role_id').value = userData.role_id;
        }

        // Открываем модалку
        modal.style.display = 'block';
    }
    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
    }
</script>
</body>
</html>
