<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход | Конструктор портфолио</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 500px;
            padding: 2rem;
        }

        .form-card {
            background: white;
            border-radius: 2rem;
            padding: 2.5rem;
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
            transition: transform 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-5px);
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            text-align: center;
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        .input-group {
            margin-bottom: 1.25rem;
        }

        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 0.85rem;
            color: #374151;
        }

        .input-group input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .input-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .btn-primary {
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 1rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .error-message {
            background: #fee2e2;
            color: #dc2626;
            padding: 0.75rem;
            border-radius: 0.75rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            text-align: center;
            border-left: 4px solid #dc2626;
        }

        .footer-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .footer-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 640px) {
            .container {
                padding: 1rem;
            }
            .form-card {
                padding: 1.5rem;
            }
            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h1>Добро пожаловать</h1>
            <p class="subtitle">Войдите в свой аккаунт</p>

            <form method="POST" action="/login" >
                @csrf

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Введите email" required>
                </div>

                <div class="input-group">
                    <label for="password">Пароль</label>
                    <input type="password" id="password" name="password" placeholder="Введите пароль" required>
                </div>

                <div id="errorMessage" class="error-message" style="display: none;"></div>

                <button type="submit" class="btn-primary">Войти</button>
            </form>

            <p class="footer-link">
                Нет аккаунта? <a href="/register">Зарегистрироваться</a>
            </p>
        </div>
    </div>
</body>
</html>
