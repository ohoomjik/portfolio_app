<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная | Конструктор портфолио</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .nav-links {
            display: flex;
            gap: 1rem;
        }

        .nav-btn {
            padding: 0.5rem 1.25rem;
            background: none;
            border: none;
            color: #4b5563;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .nav-btn:hover {
            background: #f3f4f6;
            transform: translateY(-2px);
        }

        .logout-btn {
            color: #dc2626;
        }

        .logout-btn:hover {
            background: #fee2e2;
        }

        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .search-section {
            background: white;
            padding: 2rem;
            border-radius: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        .search-section h2 {
            margin-bottom: 1rem;
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
        }

        .search-box {
            display: flex;
            gap: 1rem;
        }

        .search-input {
            flex: 1;
            padding: 0.875rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 1rem;
        }

        .search-input:focus {
            outline: none;
            border-color: #667eea;
        }

        .search-btn {
            padding: 0.875rem 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-weight: 600;
            cursor: pointer;
        }

        .portfolios-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
        }

        .portfolio-card {
            background: white;
            border-radius: 1.5rem;
            padding: 1.5rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .portfolio-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .portfolio-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            color: #1f2937;
        }

        .portfolio-card .author {
            color: #8b5cf6;
            font-size: 0.75rem;
            margin-bottom: 0.75rem;
            font-weight: 500;
        }

        .portfolio-card .description {
            color: #6b7280;
            font-size: 0.875rem;
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .skills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }

        .skill-tag {
            background: linear-gradient(135deg, #e0e7ff 0%, #ede9fe 100%);
            color: #5b21b6;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .view-btn {
            width: 100%;
            padding: 0.625rem;
            background: #f3f4f6;
            border: none;
            border-radius: 0.75rem;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .view-btn:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .empty {
            text-align: center;
            padding: 3rem;
            color: white;
            font-size: 1.125rem;
        }

        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 0.75rem;
                padding: 1rem;
            }
            .search-box {
                flex-direction: column;
            }
            .portfolios-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <?php if(auth()->guard()->check()): ?>

    <?php else: ?>

    <?php endif; ?>

<nav class="navbar">
    <div class="nav-container">
        <div class="logo">Конструктор портфолио</div>
        <div class="nav-links">

            <?php if(auth()->guard()->check()): ?>
                <button class="nav-btn" onclick="location.href='/profile'">
                    Личный кабинет
                </button>

                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="nav-btn logout-btn">Выйти</button>
                </form>
            <?php endif; ?>

            <?php if(auth()->guard()->guest()): ?>
                <button class="nav-btn" onclick="location.href='/login'">
                    Войти
                </button>
                <button class="nav-btn" onclick="location.href='/register'">
                    Регистрация
                </button>
            <?php endif; ?>

        </div>
    </div>
</nav>

<div class="main-container">
    <div class="search-section">
        <h2>Портфолио пользователей</h2>
        <div class="search-box">
            <input type="text" id="searchInput" class="search-input" placeholder="Поиск по имени или навыкам...">
            <button id="searchBtn" class="search-btn">Найти</button>
        </div>
    </div>

    <div id="portfoliosList" class="portfolios-grid"></div>
</div>
<script>
    window.authUser = {
        isAdmin: <?php echo e(auth()->check() && auth()->user()->isAdmin() ? 'true' : 'false'); ?>

    };
</script>
<script src="<?php echo e(asset('scripts/PortfolioView.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\test-demo\resources\views/home.blade.php ENDPATH**/ ?>