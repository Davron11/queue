<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление жителя</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f6f8;
            color: #333;
        }

        .sidebar {
            width: 250px;
            background-color: #1e3a8a;
            color: #fff;
            padding: 30px 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar h2 {
            color: #fff;
            font-size: 22px;
            margin-bottom: 30px;
            font-weight: 600;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 15px;
        }

        .sidebar a {
            display: block;
            color: #e0e7ff;
            text-decoration: none;
            padding: 12px 15px;
            margin-bottom: 10px;
            border-radius: 6px;
            transition: background-color 0.2s, color 0.2s;
            font-size: 15px;
        }

        .sidebar a:hover {
            background-color: #3b82f6;
            color: white;
        }

        .sidebar a.active {
            background-color: #2563eb;
            color: #fff;
            font-weight: 600;
        }

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            min-height: 100vh;
        }

        .content {
            width: 100%;
            max-width: 700px;
            text-align: center;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 30px;
            color: #1e3a8a;
        }

        form {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            text-align: left;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
        }

        form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: border 0.3s;
        }

        form input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
        }

        form button {
            padding: 12px 25px;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        form button:hover {
            background-color: #1d4ed8;
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }

            .content {
                padding-top: 20px;
            }

            form {
                width: 100%;
            }
        }
    </style>
</head>
<body>

@include("layouts.sidebar")

<div class="main">
    <div class="content">
        <h1>Добавить жителя</h1>
        <form id="addUserForm" action="add_user.php" method="POST" enctype="multipart/form-data">
            <label for="full_name">ФИО:</label>
            <input type="text" id="full_name" name="full_name" required>

            <label for="phone">Телефон:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="email">Email (необязательно):</label>
            <input type="email" id="email" name="email">

            <label for="address">Адрес:</label>
            <input type="text" id="address" name="address" required>

            <label for="passport">Паспортные данные (серия и номер):</label>
            <input type="text" id="passport" name="passport" required pattern="[A-Z]{2} \d{7}" placeholder="AA 1234567">

            <label for="pinfl">ПИНФЛ:</label>
            <input type="text" id="pinfl" name="pinfl" required pattern="\d{14}" placeholder="12345678912345">

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required placeholder="Пароль">

            <label for="photo">Фото (JPEG/PNG, до 5MB):</label>
            <input type="file" id="photo" name="photo" accept="image/jpeg, image/png" required>

            <button type="submit">Добавить</button>
        </form>

    </div>
</div>

</body>
</html>
