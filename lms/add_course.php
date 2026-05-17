<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include 'db.php';
?>
<?php
session_start();
include 'db.php';

// Проверка прав: только главный администратор
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin' || $_SESSION['username'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $desc = trim($_POST['description']);
    $img = trim($_POST['image_url']);

    if (!empty($title) && !empty($desc)) {
        $stmt = $pdo->prepare("INSERT INTO courses (title, description, image_url) VALUES (?, ?, ?)");
        $stmt->execute([$title, $desc, $img]);
        header("Location: admin.php?status=success");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создание курса | Панель управления</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f7f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .form-container { max-width: 700px; margin: 60px auto; }
        .card { border: none; border-radius: 25px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); }
        .btn-create { background: #6c5ce7; border: none; padding: 12px; font-weight: 600; border-radius: 12px; }
        .btn-create:hover { background: #5b4cc4; }
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
    <div class="container form-container">
        <div class="card p-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold m-0">Новый курс</h2>
                <a href="admin.php" class="btn btn-light rounded-pill px-4">Назад</a>
            </div>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold">НАЗВАНИЕ</label>
                    <input type="text" name="title" class="form-control form-control-lg" placeholder="Напр: Дизайн в Figma" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold">ОПИСАНИЕ</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="О чем этот курс..." required></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">URL ОБЛОЖКИ</label>
                    <input type="url" name="image_url" class="form-control" placeholder="https://images.unsplash.com/...">
                </div>
                <button type="submit" class="btn btn-primary btn-create w-100 text-white">ОПУБЛИКОВАТЬ КУРС</button>
            </form>
        </div>
    </div>
</body>
</html>