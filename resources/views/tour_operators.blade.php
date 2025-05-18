<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тир-лист тур агентств для Умры</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #F5F5F5;
            font-family: 'Rubik', sans-serif;
            color: #1A3C34;
        }
        .header {
            background-color: #1A3C34;
            color: #D4A017;
            padding: 2rem;
            text-align: center;
            font-family: 'Amiri', serif;
        }
        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
        }
        .card {
            background-color: #FFFFFF;
            border: 2px solid #D4A017;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #1A3C34;
            color: #D4A017;
            font-family: 'Amiri', serif;
            font-size: 1.5rem;
            padding: 1rem;
            border-radius: 8px 8px 0 0;
        }
        .card-body {
            padding: 1.5rem;
        }
        .stars {
            color: #D4A017;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        .logo-placeholder {
            width: 100px;
            height: 100px;
            background-color: #D4A017;
            color: #1A3C34;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 1rem;
        }
        .modal-content {
            border: 2px solid #D4A017;
            border-radius: 10px;
            background-color: #FFFFFF;
        }
        .modal-header {
            background-color: #1A3C34;
            color: #D4A017;
            border-bottom: none;
        }
        .modal-title {
            font-family: 'Amiri', serif;
        }
        .modal-body {
            font-family: 'Rubik', sans-serif;
            color: #1A3C34;
        }
        .btn-primary {
            background-color: #D4A017;
            border-color: #D4A017;
            color: #1A3C34;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #b88b14;
            border-color: #b88b14;
        }
        .fade-in {
            animation: fadeIn 1s ease-in;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @media (max-width: 768px) {
            .header h1 {
                font-size: 1.8rem;
            }
            .card-header {
                font-size: 1.2rem;
            }
            .logo-placeholder {
                width: 80px;
                height: 80px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
<div class="header fade-in">
    <h1>Тир-лист тур агентств для Умры</h1>
</div>
<div class="container my-5">
    <div class="row">
        <!-- Talisman Tour -->
        <div class="col-md-6 col-lg-4 fade-in">
            <div class="card">
                <div class="card-header">Talisman Tour</div>
                <div class="card-body">
                    <div class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <div class="logo-placeholder">Логотип Talisman Tour</div>
                    <p>Ведущий оператор с турами в Умру. Отели 4–5*, трансферы, визы, гиды. Высокая репутация, положительные отзывы.</p>
                    <p><strong>Телефон:</strong> +998 71 200-20-20</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTalisman">Подробнее</button>
                </div>
            </div>
        </div>
        <!-- Mandarin Tour -->
        <div class="col-md-6 col-lg-4 fade-in">
            <div class="card">
                <div class="card-header">Mandarin Tour</div>
                <div class="card-body">
                    <div class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                    <div class="logo-placeholder">Логотип Mandarin Tour</div>
                    <p>Надежное агентство с турами в Умру. Отели 3–4*, трансферы, хороший сервис. Меньше опыта в паломничестве.</p>
                    <p><strong>Телефон:</strong> +998 71 252-22-77</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalMandarin">Подробнее</button>
                </div>
            </div>
        </div>
        <!-- Ajva Tour -->
        <div class="col-md-6 col-lg-4 fade-in">
            <div class="card">
                <div class="card-header">Ajva Tour</div>
                <div class="card-body">
                    <div class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <div class="logo-placeholder">Логотип Ajva Tour</div>
                    <p>Специализируется на Умре. Проживание, трансферы, визы, средний бюджет. Меньше известности.</p>
                    <p><strong>Телефон:</strong> +998 71 244-44-88</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAjva">Подробнее</button>
                </div>
            </div>
        </div>
        <!-- Fayz Tourizm -->
        <div class="col-md-6 col-lg-4 fade-in">
            <div class="card">
                <div class="card-header">Fayz Tourizm</div>
                <div class="card-body">
                    <div class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                    <div class="logo-placeholder">Логотип Fayz Tourizm</div>
                    <p>Бюджетные туры в Умру, отели 3*. Базовый сервис, вопросы к надежности из-за прошлых нарушений.</p>
                    <p><strong>Телефон:</strong> +998 71 233-33-44</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFayz">Подробнее</button>
                </div>
            </div>
        </div>
        <!-- Olmos Travel -->
        <div class="col-md-6 col-lg-4 fade-in">
            <div class="card">
                <div class="card-header">Olmos Travel</div>
                <div class="card-body">
                    <div class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <div class="logo-placeholder">Логотип Olmos Travel</div>
                    <p>Эконом-туры в Умру, стандартные пакеты. Ограниченная информация, базовая репутация.</p>
                    <p><strong>Телефон:</strong> +998 71 252-52-00</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalOlmos">Подробнее</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<!-- Talisman Tour Modal -->
<div class="modal fade" id="modalTalisman" tabindex="-1" aria-labelledby="modalTalismanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTalismanLabel">Talisman Tour</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Рейтинг:</strong> ★★★★★</p>
                <p><strong>Описание:</strong> Ведущий туроператор с индивидуальными турами в Умру. Проживание в отелях 4–5*, трансферы, визовая поддержка, гиды. Высокая репутация, положительные отзывы о других турах.</p>
                <p><strong>Телефон:</strong> +998 71 200-20-20</p>
                <p><strong>Сайт:</strong> <a href="http://talisman-tour.uz" target="_blank">talisman-tour.uz</a></p>
            </div>
        </div>
    </div>
</div>
<!-- Mandarin Tour Modal -->
<div class="modal fade" id="modalMandarin" tabindex="-1" aria-labelledby="modalMandarinLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMandarinLabel">Mandarin Tour</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Рейтинг:</strong> ★★★★½</p>
                <p><strong>Описание:</strong> Надежное агентство с турами в Умру. Проживание в отелях 3–4*, трансферы, хороший сервис. Меньше опыта в паломничестве, но высокая общая репутация.</p>
                <p><strong>Телефон:</strong> +998 71 252-22-77</p>
                <p><strong>Сайт:</strong> <a href="http://mandarin-tour.uz" target="_blank">mandarin-tour.uz</a></p>
            </div>
        </div>
    </div>
</div>
<!-- Ajva Tour Modal -->
<div class="modal fade" id="modalAjva" tabindex="-1" aria-labelledby="modalAjvaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAjvaLabel">Ajva Tour</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Рейтинг:</strong> ★★★★</p>
                <p><strong>Описание:</strong> Специализируется на турах в Умру. Проживание, трансферы, визы, подходит для среднего бюджета. Меньше известности по сравнению с лидерами.</p>
                <p><strong>Телефон:</strong> +998 71 244-44-88</p>
                <p><strong>Сайт:</strong> <a href="http://ajva-tour.uz" target="_blank">ajva-tour.uz</a></p>
            </div>
        </div>
    </div>
</div>
<!-- Fayz Tourizm Modal -->
<div class="modal fade" id="modalFayz" tabindex="-1" aria-labelledby="modalFayzLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFayzLabel">Fayz Tourizm</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Рейтинг:</strong> ★★★½</p>
                <p><strong>Описание:</strong> Бюджетные туры в Умру с отелями 3*, базовыми трансферами. Вопросы к надежности из-за прошлых нарушений, ограниченная информация.</p>
                <p><strong>Телефон:</strong> +998 71 233-33-44</p>
                <p><strong>Сайт:</strong> <a href="http://yellowpages.uz" target="_blank">yellowpages.uz</a></p>
            </div>
        </div>
    </div>
</div>
<!-- Olmos Travel Modal -->
<div class="modal fade" id="modalOlmos" tabindex="-1" aria-labelledby="modalOlmosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalOlmosLabel">Olmos Travel</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Рейтинг:</strong> ★★★</p>
                <p><strong>Описание:</strong> Эконом-туры в Умру, стандартные пакеты. Ограниченная информация, базовая репутация, но активный сайт и контакты.</p>
                <p><strong>Телефон:</strong> +998 71 252-52-00</p>
                <p><strong>Сайт:</strong> <a href="http://olmos-travel.uz" target="_blank">olmos-travel.uz</a></p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
