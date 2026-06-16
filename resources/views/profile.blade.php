<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет | Конструктор портфолио</title>
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
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }

        .profile-header {
            background: white;
            border-radius: 1.5rem;
            padding: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        .profile-header h1 {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 0.5rem;
        }

        .profile-header .username {
            color: #6b7280;
            font-size: 1rem;
        }

        .portfolio-view {
            background: white;
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        .portfolio-header {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid #e5e7eb;
        }

        .portfolio-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .portfolio-header .portfolio-description {
            color: #6b7280;
            line-height: 1.6;
        }

        .portfolio-section {
            margin-bottom: 2rem;
        }

        .portfolio-section h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #1f2937;
        }

        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .skill-tag {
            background: linear-gradient(135deg, #e0e7ff 0%, #ede9fe 100%);
            color: #5b21b6;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .projects-grid, .images-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1rem;
        }

        .project-card {
            background: #f9fafb;
            padding: 1rem;
            border-radius: 1rem;
            transition: all 0.3s ease;
            min-width: 0;
        }

        .project-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .project-card h4 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1f2937;
        }

        .portfolio-description {
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .project-card p {
            font-size: 0.875rem;
            color: #6b7280;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .project-card,
        .portfolio-description {
            min-width: 0;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .image-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 1rem;
            transition: all 0.3s ease;
        }

        .image-card img:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .empty-portfolio {
            text-align: center;
            padding: 3rem;
        }

        .empty-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .empty-portfolio p {
            margin-bottom: 1rem;
            color: #6b7280;
        }

        .btn-primary {
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .loading, .error, .empty-text {
            text-align: center;
            padding: 2rem;
            color: #6b7280;
        }

        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 0.75rem;
                padding: 1rem;
            }
            .main-container {
                padding: 1rem;
            }
            .profile-header h1 {
                font-size: 1.5rem;
            }
            .projects-grid, .images-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="nav-container">
        <div class="logo">Конструктор портфолио</div>
        <div class="nav-links">

            @auth
                <button class="nav-btn" onclick="location.href='/home'">
                    Главная
                </button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-btn logout-btn">Выйти</button>
                </form>
            @endauth

            @guest
                <button class="nav-btn" onclick="location.href='/login'">
                    Войти
                </button>
                <button class="nav-btn" onclick="location.href='/register'">
                    Регистрация
                </button>
            @endguest

        </div>
    </div>
</nav>

<div class="main-container">
    <div class="profile-header">
        <h1>{{ $portfolio->title ?? 'Моё портфолио' }}</h1>
        <p class="name">Пользователь: <strong>{{ auth()->user()->name }}</strong></p>
    </div>
    <div id="portfolioContent" class="portfolio-view">
        @if($portfolio)
    <div class="portfolio-header">
        <h2>{{ $portfolio->title }}</h2>
        <p class="portfolio-description">
            {{ $portfolio->description }}
        </p>
    </div>
    <div class="portfolio-section">
        <h3>Навыки</h3>

        <div class="skills-list">
            @foreach($portfolio->skills as $skill)
                <span class="skill-tag">{{ $skill->name}}</span>
            @endforeach
        </div>
    </div>
    <div class="portfolio-section">
        <h3>Проекты</h3>

        <div class="projects-grid">
            @foreach($portfolio->projects as $project)
                <div class="project-card">
                    <h4>{{ $project->title }}</h4>
                    <p>{{ $project->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
    <div class="portfolio-section">
        <h3>Работы</h3>

        <div class="images-grid">
            @foreach($portfolio->images as $image)
                <div class="image-card">
                    <img src="{{ asset('storage/' . $image->image_url) }}">
                </div>
            @endforeach
        </div>
    </div>
        <div>
        <button class="btn-primary"
                onclick="location.href='/portfolio/edit'">
            Редактировать портфолио
        </button>
    </div>
    @else
    <div class="empty-portfolio">
        <p>Портфолио пока не создано</p>
        <button class="btn-primary"
                onclick="location.href='/portfolio/edit'">
            Создать портфолио
        </button>
    </div>
    @endif
    </div>
</div>
@if(auth()->user()->isAdmin())
    @include('admin-users')
@endif
</body>
</html>
