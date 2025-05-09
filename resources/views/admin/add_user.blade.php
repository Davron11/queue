<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление жителя</title>
    <!-- Google Fonts: Rubik и Amiri -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&family=Amiri:wght@700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Rubik', sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #F5F5F5; /* Фон как в профиле */
            color: #1A3C34; /* Основной цвет текста */
        }

        /* Централизованный стиль сайдбара */
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
            background: #FFFFFF; /* Белый фон как в profile-card */
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
            position: relative;
            overflow: hidden;
        }

        /* Фоновый орнамент */
        .content::before {
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

        h1 {
            font-family: 'Amiri', serif; /* Шрифт как в профиле */
            font-size: 28px;
            margin-bottom: 30px;
            color: #D4A017; /* Золотой акцент */
            position: relative;
            z-index: 1;
        }

        form {
            background: transparent; /* Убираем белый фон формы */
            padding: 0; /* Убираем внутренние отступы */
            text-align: left;
            position: relative;
            z-index: 1;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #1A3C34; /* Тёмный текст */
        }

        form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #D4A0175e; /* Светло-золотая рамка */
            border-radius: 8px;
            font-size: 14px;
            transition: border 0.3s, box-shadow 0.3s;
            background: #F5F5F5; /* Фон как в user-info */
        }

        form input:focus {
            outline: none;
            border-color: #D4A017; /* Полный золотой при фокусе */
            box-shadow: 0 0 0 3px rgba(212, 160, 23, 0.2);
        }

        form button {
            padding: 12px 25px;
            background-color: #D4A017; /* Золотая кнопка */
            color: #1A3C34;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            width: 100%;
        }

        form button:hover {
            background-color: #B8860B; /* Темнее золотого при наведении */
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

            .main {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }

            .content {
                padding: 20px;
            }

            h1 {
                font-size: 24px;
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
            <label for="full_name">{{ __('messages.full_name') }}:</label>
            <input type="text" id="full_name" name="full_name" required>

            <label for="phone">{{ __('messages.phone_number') }}:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email">

            <label for="address">{{ __('messages.address') }}:</label>
            <input type="text" id="address" name="address" required>

            <label for="passport">{{ __('messages.passport_data') }}</label>
            <input type="text" id="passport" name="passport" required pattern="[A-Z]{2} \d{7}" placeholder="AA 1234567">

            <label for="pinfl">{{ __('pinfl') }}:</label>
            <input type="text" id="pinfl" name="pinfl" required pattern="\d{14}" placeholder="12345678912345">

            <label for="password">{{ __('messages.password') }}:</label>
            <input type="password" id="password" name="password" required placeholder="Пароль">

            <label for="photo">{{ __('messages.photo') }}</label>
            <input type="file" id="photo" name="photo" accept="image/jpeg, image/png" required>

                <button type="submit">{{ __('messages.add') }}</button>
        </form>
    </div>
</div>

</body>
</html>
