<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Просмотр портфолио | Конструктор портфолио</title>
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
        }

        .main-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
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

        .portfolio-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .portfolio-header .author {
            color: #8b5cf6;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .portfolio-header .portfolio-description {
            color: #4b5563;
            line-height: 1.6;
        }

        .portfolio-section {
            margin-bottom: 2rem;
        }

        .portfolio-section h2 {
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
        }

        .project-card h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .project-card p {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .image-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 1rem;
        }

        .empty-text {
            text-align: center;
            padding: 2rem;
            color: #9ca3af;
        }

        .error {
            text-align: center;
            padding: 3rem;
            color: #dc2626;
        }

        .btn-primary {
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 0.75rem;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 0.75rem;
            }
            .main-container {
                padding: 1rem;
            }
            .portfolio-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="nav-container">
        <div class="logo">Конструктор портфолио</div>
        <div class="nav-links">
            <button class="nav-btn" onclick="location.href='/home'">Главная</button>
            <button class="nav-btn" onclick="location.href='/profile'">Личный кабинет</button>
        </div>
    </div>
</nav>
    <div class="main-container">
    <div id="portfolioContent" class="portfolio-view">
        <div class="portfolio-header">
    <h1>{{ $portfolio->title }}</h1>
    <div class="author">
        👤 Автор: {{ $portfolio->user->name }}
    </div>
    <p class="portfolio-description">
        {{ $portfolio->description }}
    </p>
    </div>
    <div class="portfolio-section">
    <h2>📚 Навыки</h2>
    <div class="skills-list">
        @forelse($portfolio->skills as $skill)
            <span class="skill-tag">{{ $skill->name }}</span>
        @empty
            <p class="empty-text">Навыки не добавлены</p>
        @endforelse

    </div>
</div>
    <div class="portfolio-section">
    <h2>🚀 Проекты</h2>
    @if($portfolio->projects->count())
        <div class="projects-grid">
            @foreach($portfolio->projects as $project)
                <div class="project-card">
                    <h3>{{ $project->title }}</h3>
                    <p>{{ $project->description }}</p>
                </div>
            @endforeach
        </div>
        @else
        <p class="empty-text">
            Проекты не добавлены
        </p>
        @endif
    </div>

    <div class="portfolio-section">
    <h2>📷 Примеры работ</h2>
    @if($portfolio->images->count())
        <div class="images-grid">
            @foreach($portfolio->images as $image)
                <div class="image-card">
                    <img src="{{ asset('storage/' . $image->image_url) }}">
                </div>
            @endforeach
        </div>
        @else
        <p class="empty-text">Фотографии не добавлены</p>
        @endif
    </div>

</div>
</div>
</body>
</html>
