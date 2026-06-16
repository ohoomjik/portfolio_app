<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование портфолио | Конструктор портфолио</title>
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

        .form-card {
            background: white;
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        .form-card h1 {
            font-size: 1.75rem;
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
            margin-bottom: 1.5rem;
        }

        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 0.85rem;
            color: #374151;
        }

        .input-group input,
        .input-group textarea {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .input-group input:focus,
        .input-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
            margin-top: 0.5rem;
        }

        .dynamic-item {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            align-items: center;
        }

        .dynamic-item input {
            flex: 1;
            padding: 0.75rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .dynamic-item input:focus {
            outline: none;
            border-color: #667eea;
        }
        .image-card {
            position: relative;
        }

        .delete-image-btn {
         position: absolute;
            top: 8px;
            right: 8px;
            background: rgba(0,0,0,0.6);
            color: white;
            border: none;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            cursor: pointer;
        }

        .delete-image-btn:hover {
            background: red;
        }

        .remove-btn {
            padding: 0.625rem 1rem;
            background: #fee2e2;
            color: #dc2626;
            border: none;
            border-radius: 0.75rem;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .remove-btn:hover {
            background: #fecaca;
            transform: scale(1.05);
        }

        .btn-secondary {
            padding: 0.625rem 1.25rem;
            background: #6b7280;
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .btn-secondary:hover {
            background: #4b5563;
            transform: translateY(-2px);
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
            margin-top: 1rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
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


        .success-message {
            background: #dcfce7;
            color: #16a34a;
            padding: 0.875rem;
            border-radius: 0.75rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            text-align: center;
            border-left: 4px solid #16a34a;
        }

        .error-message {
            background: #fee2e2;
            color: #dc2626;
            padding: 0.875rem;
            border-radius: 0.75rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            text-align: center;
            border-left: 4px solid #dc2626;
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
            .form-card {
                padding: 1.5rem;
            }
            .dynamic-item {
                flex-direction: column;
            }
            .remove-btn {
                width: 100%;
            }
        }
    </style>
</head>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<body>

<div class="main-container">
    <div class="form-card">
        <h1>Моё портфолио</h1>
        <p class="subtitle">
            <?php if(isset($adminMode)): ?>
                Редактирование портфолио пользователя <strong><?php echo e($portfolio->user->name ?? ''); ?></strong>
            <?php else: ?>
                Заполните информацию о себе
            <?php endif; ?>
        </p>

        <form method="POST" action="<?php echo e(isset($adminMode) ? route('admin.portfolio.update', $portfolio->id) : route('portfolio.update')); ?>" id="portfolioForm" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
            <div class="input-group">
                <label for="name">Название портфолио *</label>
                <input type="text" id="name" name="name" value="<?php echo e($portfolio->title ?? ''); ?>" placeholder="Например: Веб-разработчик" required>
            </div>

            <div class="input-group">
                <label for="description">Описание</label>
                <textarea id="description" name="description" rows="4"> <?php echo e($portfolio->description ?? ''); ?></textarea>
            </div>

            <div class="input-group">
                <label for="skills">Навыки (через запятую)</label>
                <input type="text" id="skills" name="skills" value="<?php echo e(isset($portfolio) ? $portfolio->skills->pluck ('name')->implode (',') : ''); ?>" placeholder="HTML, CSS, JavaScript, React, PHP">
            </div>

            <div class="section-title">🚀 Проекты</div>
                <?php $__currentLoopData = $portfolio->projects ?? collect(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="input-group">
                <input name="projects[<?php echo e($i); ?>][title]"
                    value="<?php echo e($project->title); ?>"
                    placeholder="Название проекта">
                <input name="projects[<?php echo e($i); ?>][description]"
                    value="<?php echo e($project->description); ?>"
                    placeholder="Описание">
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if(($portfolio->projects ?? collect())->isEmpty()): ?>
                <p>Пока нет проектов</p>
            <?php endif; ?>
            <button type="button" id="addProjectBtn" class="btn-secondary">+ Добавить проект</button>

            <div class="section-title">📷 Примеры работ</div>
            <div id="imageInputs">

                <?php if(($portfolio->images ?? collect())->isNotEmpty()): ?>
                    <div class="images-grid" style="margin-bottom: 15px;">
                <?php $__currentLoopData = $portfolio->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="image-card" data-id="<?php echo e($image->id); ?>">
                    <img src="<?php echo e(asset('storage/' . $image->image_url)); ?>" alt="work">
                    <button type="button"
                            class="delete-image-btn"
                            data-id="<?php echo e($image->id); ?>">
                        ✕
                    </button>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php else: ?>
            <p>Пока нет изображений</p>
            <?php endif; ?>

            <div class="input-group">
                <input type="file" name="images[]" accept="image/*" class="image-input">
                <div class="file-preview"></div>
            </div>

</div>

        <button type="button" id="addImageBtn" class="btn-secondary">+ Добавить фото</button>

            <div id="message" class="success-message" style="display: none;"></div>
            <div id="errorMessage" class="error-message" style="display: none;"></div>

            <button type="submit" class="btn-primary">Сохранить портфолио</button>
        </form>
    </div>
</div>
</body>
<script src="<?php echo e(asset('scripts/PortfolioEdit.js')); ?>"></script>
</html>
<?php /**PATH C:\xampp\htdocs\test-demo\resources\views/edit-portfolio.blade.php ENDPATH**/ ?>