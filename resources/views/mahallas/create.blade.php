<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавление жителя</title>
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
        }

        h1 {
            font-family: 'Amiri', serif; /* Шрифт как в профиле */
            color: #D4A017; /* Золотой акцент */
            margin-bottom: 20px;
            font-size: 2rem;
        }

        /* Форма */
        form {
            background: #FFFFFF; /* Белый фон как в profile-card */
            padding: 20px;
            border-radius: 15px; /* Закругления как в профиле */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Тень */
            max-width: 500px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
        }

        /* Фоновый орнамент */
        form::before {
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

        form label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
            color: #1A3C34; /* Тёмный текст */
            position: relative;
            z-index: 1;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #D4A0175e; /* Светло-золотая рамка */
            border-radius: 5px;
            background: #F5F5F5; /* Фон как в user-info */
            transition: border-color 0.3s, box-shadow 0.3s;
            position: relative;
            z-index: 1;
        }

        form input:focus {
            outline: none;
            border-color: #D4A017; /* Полный золотой при фокусе */
            box-shadow: 0 0 0 3px rgba(212, 160, 23, 0.2);
        }

        form button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            background-color: #D4A017; /* Золотой как в профиле */
            color: #1A3C34; /* Тёмный текст */
            font-size: 16px;
            font-weight: 600;
            transition: background 0.3s, transform 0.2s;
            position: relative;
            z-index: 1;
        }

        form button:hover {
            background-color: #B8860B; /* Темнее золотого */
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

            form {
                padding: 15px;
            }

            h1 {
                font-size: 1.5rem;
            }
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
