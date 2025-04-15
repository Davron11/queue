<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавление жителя</title>
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

        /* Форма */
        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }

        form label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            transition: background 0.3s;
        }

        form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<!-- Сайдбар -->
<div class="sidebar">
    <h2>Меню</h2>
    <a href="#dashboard">Панель</a>
    <a href="#queue">Очередь</a>
    <a href="#admins">Администраторы</a>
    <a href="#profile">Профиль</a>
    <a href="#logout">Выход</a>
</div>

<!-- Контент -->
<div class="content">
    <h1>Добавить жителя</h1>
    <form id="addResidentForm">
        <label for="fullName">ФИО:</label>
        <input type="text" id="fullName" required>

        <label for="phone">Номер телефона:</label>
        <input type="tel" id="phone" required>

        <label for="email">Email (необязательно):</label>
        <input type="email" id="email">

        <label for="address">Адрес:</label>
        <input type="text" id="address" required>

        <label for="passport">Паспортные данные (AA 1234567):</label>
        <input type="text" id="passport" pattern="[A-Z]{2} \d{7}" title="Формат: AA 1234567" required>

        <label for="pinfl">ПИНФЛ (14 цифр):</label>
        <input type="text" id="pinfl" pattern="\d{14}" title="Должно быть 14 цифр" required>

        <label for="photo">Фотография:</label>
        <input type="file" id="photo" accept="image/*" required>

        <button type="submit">Добавить жителя</button>
    </form>
</div>
<script>
    // Простой обработчик формы
    document.getElementById("addResidentForm").addEventListener("submit", function (e) {
        e.preventDefault();
        alert("Житель успешно добавлен!");
        this.reset();
    });
</script>
</body>
</html>

