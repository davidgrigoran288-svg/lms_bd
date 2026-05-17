<?php include 'db.php';
$id = (int)$_GET['id'];
$course = $pdo->prepare("SELECT * FROM courses WHERE id = ?");
$course->execute([$id]);
$course = $course->fetch();
$lessons = $pdo->prepare("SELECT * FROM lessons WHERE course_id = ?");
$lessons->execute([$id]);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"><title>Уроки курса</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h1>Курс: <?= $course['title'] ?></h1>
    <div class="list-group mt-4">
        <?php while($l = $lessons->fetch()): ?>
            <a href="lesson.php?id=<?= $l['id'] ?>" class="list-group-item list-group-item-action p-3 shadow-sm mb-2 rounded">
                <h5 class="mb-1">📖 <?= $l['title'] ?></h5>
                <small class="text-primary">Нажмите, чтобы начать изучение теории →</small>
            </a>
        <?php endwhile; ?>
    </div>
</div>
<style>
  
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
</body>
</html>