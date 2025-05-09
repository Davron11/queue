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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Rubik', sans-serif;
            background: #F5F5F5;
            color: #1A3C34;
            display: flex;
            min-height: 100vh;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Сайдбар */
        .sidebar {
            width: 250px;
            background-color: #1A3C34;
            color: #FFFFFF;
            height: 100vh;
            padding: 30px 20px;
            position: fixed;
            display: flex;
            flex-direction: column;
            gap: 10px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
        }

        .sidebar h2 {
            font-family: 'Amiri', serif;
            color: #D4A017;
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            border-bottom: 1px solid #D4A017;
            padding-bottom: 15px;
        }

        .sidebar a {
            text-decoration: none;
            color: #FFFFFF;
            padding: 12px 15px;
            border-radius: 6px;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center; /* Выравнивание текста по центру */
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a:hover {
            background-color: #D4A017;
            color: #1A3C34;
        }

        /* Контент */
        .content {
            margin-left: 250px;
            padding: 40px;
            width: calc(100% - 250px);
            position: relative;
            animation: fadeIn 0.5s ease-in;
        }

        .content::before {
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
            margin-bottom: 20px;
        }

        /* Таблица */
        .queue-table {
            width: 100%;
            border-collapse: collapse;
            background: #FFFFFF;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        .queue-table th, .queue-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(212, 160, 23, 0.3);
            text-align: left;
        }

        .queue-table th {
            background-color: #1A3C34;
            color: #FFFFFF;
            font-family: 'Amiri', serif;
            font-size: 16px;
        }

        .queue-table tr:hover {
            background-color: #F5F5F5;
        }

        /* Кнопки */
        .actions button, .btn {
            padding: 8px 15px;
            margin-right: 5px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-primary {
            background-color: #D4A017;
            color: #1A3C34;
        }

        .btn-primary:hover {
            background-color: #B8860B;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: #dc3545;
            color: #FFFFFF;
        }

        .btn-danger:hover {
            background-color: #b02a37;
            transform: translateY(-2px);
        }

        /* Модальное окно */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: #FFFFFF;
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: relative;
            font-family: 'Rubik', sans-serif;
            animation: modalFadeIn 0.3s ease-out;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal-content h2 {
            font-family: 'Amiri', serif;
            color: #D4A017;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .modal-content label {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            font-weight: 600;
            color: #1A3C34;
        }

        .modal-content input, .modal-content select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #D4A017;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .modal-content input:focus, .modal-content select:focus {
            outline: none;
            border-color: #1A3C34;
            box-shadow: 0 0 0 3px rgba(26, 60, 52, 0.2);
        }

        .modal-content button {
            padding: 12px 20px;
            margin: 5px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .modal-content .btn-success {
            background-color: #D4A017;
            color: #1A3C34;
        }

        .modal-content .btn-success:hover {
            background-color: #B8860B;
            transform: translateY(-2px);
        }

        .modal-content .btn-secondary {
            background-color: #1A3C34;
            color: #FFFFFF;
        }

        .modal-content .btn-secondary:hover {
            background-color: #D4A017;
            color: #1A3C34;
            transform: translateY(-2px);
        }

        .close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 24px;
            color: #1A3C34;
            cursor: pointer;
        }

        .form-label {
            color: #1A3C34;
            font-weight: 600;
        }

        .form-control, .form-select {
            border: 1px solid #D4A017;
            border-radius: 8px;
            background: #FFFFFF;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: #1A3C34;
            box-shadow: 0 0 0 3px rgba(26, 60, 52, 0.2);
            outline: none;
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
                padding: 20px;
            }

            .queue-table th, .queue-table td {
                padding: 10px;
                font-size: 12px;
            }

            h1 {
                font-size: 24px;
            }

            .modal-content {
                width: 95%;
                padding: 20px;
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
        <h1>{{ __('messages.queue') }}</h1>
        <a href="#" class="btn btn-sm btn-primary" onclick="openCreateModal(this)">
            {{ __('messages.create') }}
        </a>
    </div>
    <table class="queue-table">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('messages.full_name') }}</th>
            <th>{{ __('messages.pinfl') }}</th>
            <th>{{ __('messages.phone_number') }}</th>
            <th>{{ __('messages.address') }}</th>
            <th>{{ __('messages.actions') }}</th>
        </tr>
        </thead>
        <tbody id="queueList">
        @foreach($pilgrims as $index => $pilgrim)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pilgrim->full_name }}</td>
                <td>{{ $pilgrim->pinfl }}</td>
                <td>{{ $pilgrim->phone_number }}</td>
                <td>{{ \App\Services\PilgrimService::getAddress($pilgrim) }}</td>
                <td>
                    <a href="#" class="btn btn-sm btn-primary"
                       data-user=' {{json_encode([
                                   "id" => $pilgrim->id,
                                   "full_name" => $pilgrim->full_name,
                                   "pinfl" => $pilgrim->pinfl,
                                   "phone_number" => $pilgrim->phone_number,
                                   "address" => [
                                       "oblast_id" => $pilgrim->address->oblast_id ?? '',
                                       "city_id" => $pilgrim->address->city_id ?? '',
                                       "district_id" => $pilgrim->address->district_id ?? '',
                                       "mahalla_id" => $pilgrim->address->mahalla_id ?? '',
                                       "home" => $pilgrim->address->home ?? ''
                                   ],
                                   "passport_series" => $pilgrim->passport_data ?? '',
                                   "passport_number" => $pilgrim->passport_number ?? '',
                               ])}}'
                       onclick="openEditModal(this)">
                        {{ __('messages.edit') }}
                    </a>
                    <form action="{{ route('pilgrims.destroy', $pilgrim->id) }}" method="POST" style="display:inline;">
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
<div id="editModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editModal')">×</span>
        <h2>{{ __('messages.edit') }}</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label>{{ __('messages.full_name') }}</label>
                <input type="text" name="full_name" id="edit_full_name" value="{{ old('full_name', $user->full_name) }}" required>
            </div>

            <div>
                <label>{{ __('messages.pinfl') }}</label>
                <input type="text" name="pinfl" id="edit_pinfl" value="{{ old('pinfl', $user->pinfl) }}" required>
            </div>

            <div>
                <label>{{ __('messages.phone_number') }}</label>
                <input type="text" name="phone_number" id="edit_phone_number" value="{{ old('phone_number', $user->phone_number) }}" required>
            </div>

            <div>
                <label>{{ __('messages.passport_data') }}</label>
                <input type="text" name="passport_series" id="edit_passport_series" value="{{ old('passport_series', $user->passport_series ?? '') }}" required>
            </div>

            <div>
                <label>{{ __('messages.password') }}</label>
                <input type="password" name="password" id="edit_password" placeholder="Введите новый пароль">
            </div>

            <div>
                <label>{{ __('messages.regions') }}</label>
                <select name="oblast_id" id="edit_oblast_id" required>
                    <option value="">{{ __('messages.take') }} {{ __('messages.regions') }}</option>
                    @foreach($oblasts as $oblast)
                        <option value="{{ $oblast->id }}" {{ old('oblast_id', $user->address->oblast_id ?? '') == $oblast->id ? 'selected' : '' }}>
                            {{ $oblast->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>{{ __('messages.cites') }}</label>
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
        form.action = `/pilgrims/${userData.id}`;
        form.method = 'POST';

        if (!form.querySelector('[name="_method"]')) {
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PUT';
            form.appendChild(methodField);
        }

        document.getElementById('edit_full_name').value = userData.full_name;
        document.getElementById('edit_pinfl').value = userData.pinfl;
        document.getElementById('edit_phone_number').value = userData.phone_number;
        document.getElementById('edit_home').value = userData.address.home;
        document.getElementById('edit_oblast_id').value = userData.address.oblast_id;
        document.getElementById('edit_city_id').value = userData.address.city_id;
        document.getElementById('edit_district_id').value = userData.address.district_id;
        document.getElementById('edit_mahalla_id').value = userData.address.mahalla_id;
        document.getElementById('edit_passport_series').value = userData.passport_series;
        modal.style.display = 'block';
    }

    function openCreateModal(element) {
        const form = document.getElementById('editForm');
        const modal = document.getElementById('editModal');
        const modalTitle = modal.querySelector('h2');
        modalTitle.textContent = 'Создание';

        form.action = '/pilgrims';
        form.method = 'POST';

        document.getElementById('edit_full_name').value = '';
        document.getElementById('edit_pinfl').value = '';
        document.getElementById('edit_phone_number').value = '';
        document.getElementById('edit_home').value = '';
        document.getElementById('edit_oblast_id').value = '';
        document.getElementById('edit_city_id').value = '';
        document.getElementById('edit_district_id').value = '';
        document.getElementById('edit_mahalla_id').value = '';
        document.getElementById('edit_passport_series').value = '';
        document.getElementById('edit_password').value = '';

        const methodField = form.querySelector('[name="_method"]');
        if (methodField) {
            methodField.remove();
        }

        modal.style.display = 'block';
    }

    function closeModal() {
        const modal = document.getElementById('editModal');
        const modalTitle = modal.querySelector('h2');
        modalTitle.textContent = 'Редактировать жителя';
        modal.style.display = 'none';
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
