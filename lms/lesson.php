<?php include 'db.php';
$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT lessons.*, courses.title as c_title, courses.image_url FROM lessons JOIN courses ON lessons.course_id = courses.id WHERE lessons.id = ?");
$stmt->execute([$id]);
$lesson = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $lesson['title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f4f7f9; color: #2d3436; }
        .hero-banner { 
            height: 350px; background: url('<?= $lesson['image_url'] ?>') center/cover;
            position: relative; border-radius: 0 0 50px 50px; margin-bottom: -100px;
        }
        .hero-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(180deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.7) 100%);
            border-radius: 0 0 50px 50px;
        }
        .lesson-container { max-width: 900px; position: relative; z-index: 2; }
        .theory-card { 
            background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);
            border-radius: 30px; padding: 50px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .breadcrumb-custom a { color: #fff; text-decoration: none; opacity: 0.8; }
        .theory-text { font-size: 1.25rem; line-height: 1.9; color: #444; }
        .btn-start-dz {
            background: linear-gradient(135deg, #6c5ce7 0%, #a29bfe 100%);
            border: none; border-radius: 50px; padding: 20px 50px;
            font-weight: 700; transition: transform 0.3s ease;
        }
        .btn-start-dz:hover { transform: scale(1.05); color: white; }
       
  
    body {
        background-color: #0f0c29; 
        background-image: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
        background-attachment: fixed;
        color: #e0e0e0; 
        font-family: 'Segoe UI', Roboto, sans-serif;
        min-height: 100vh;
        margin: 0;
    }


    nav, .navbar {
        background: rgba(15, 12, 41, 0.95) !important;
        border-bottom: 2px solid #6c5ce7;
    }

  
    .card {
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(108, 92, 231, 0.3) !important;
        color: white !important;
        backdrop-filter: blur(5px);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        border-color: #a29bfe !important;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
    }

 
    h1, h2, h3, .text-primary {
        color: #a29bfe !important;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }


    .btn-primary {
        background-color: #6c5ce7 !important;
        border: none !important;
        padding: 10px 25px;
        font-weight: bold;
    }

    .btn-primary:hover {
        background-color: #8275e9 !important;
        box-shadow: 0 0 15px rgba(108, 92, 231, 0.5);
    }

    .bg-light, [style*="background: #f8f9fa"] {
        background: rgba(108, 92, 231, 0.1) !important;
        border-left: 5px solid #6c5ce7 !important;
        color: #ffffff !important;
        padding: 20px !important;
        border-radius: 10px;
    }

    </style>
</head>
<body>

<div class="hero-banner">
    <div class="hero-overlay d-flex align-items-center">
        <div class="container lesson-container text-white">
            <nav class="breadcrumb-custom mb-3"><a href="index.php">Главная</a> / <a href="course.php?id=<?= $lesson['course_id'] ?>"><?= $lesson['c_title'] ?></a></nav>
            <h1 class="display-4 fw-bold"><?= $lesson['title'] ?></h1>
        </div>
    </div>
</div>

<div class="container lesson-container pb-5">
    <div class="theory-card">
        <div class="theory-text">
            <span class="badge bg-primary mb-3">Лекция дня</span>
            <?= nl2br(htmlspecialchars($lesson['content'])) ?>
        </div>
        
        <div class="text-center mt-5">
            <div class="p-4 rounded-4 mb-4" style="background: #f8f9ff; border: 1px dashed #6c5ce7;">
                <h5 class="fw-bold">Готовы проверить себя?</h5>
                <p class="text-muted">После нажатия кнопки вам будет предложен тест из нескольких вопросов.</p>
            </div>
            <a href="quiz.php?lesson_id=<?= $lesson['id'] ?>" class="btn btn-start-dz btn-lg shadow-lg text-white">
                НАЧАТЬ ПРОХОЖДЕНИЕ ДОМАШНЕГО ЗАДАНИЯ
            </a>
        </div>
    </div>
</div>

</body>
</html>