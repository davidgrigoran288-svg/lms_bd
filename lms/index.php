<?php
session_start();
// Если пользователь не вошел, отправляем на логин
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm mb-5">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand fw-bold text-primary" href="index.php">PRO-LMS</a>
        
        <div class="d-flex align-items-center">
            <span class="me-3 text-muted">
    Привет, <b><?= htmlspecialchars($_SESSION['username'] ?? 'Гость') ?></b>
</span>
            
            <?php if ($_SESSION['role'] == 'admin'): ?>
                <a href="admin.php" class="btn btn-admin me-2">
                    <i class="bi bi-shield-lock-fill"></i> Админ-панель
                </a>
            <?php endif; ?>
            
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Выйти</a>
        </div>
    </div>
</nav>

<style>
.btn-admin {
    background: linear-gradient(135deg, #ffd700 0%, #ff8c00 100%);
    color: #000 !important;
    font-weight: 800;
    border: none;
    border-radius: 10px;
    padding: 8px 20px;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
    transition: 0.3s;
}
.btn-admin:hover { transform: scale(1.05); box-shadow: 0 6px 20px rgba(255, 215, 0, 0.5); }
</style>
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRO-LMS | Платформа обучения</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        
        
        .course-card {
            border: none;
            border-radius: 20px;
            transition: all 0.3s ease;
            background: #fff;
            overflow: hidden;
            height: 100%; 
            display: flex;
            flex-direction: column;
        }

        .course-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
        }

        .course-img {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .btn-learn {
            background: linear-gradient(135deg, #6c5ce7 0%, #a29bfe 100%);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 12px;
            padding: 12px;
        }

        .btn-learn:hover {
            color: white;
            opacity: 0.9;
        }

        .section-title {
            font-weight: 700;
            margin-bottom: 40px;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 4px;
            background: #6c5ce7;
            border-radius: 2px;
        }
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

<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="index.php">PRO-LMS</a>
    </div>
</nav>

<div class="container mb-5">
    <h2 class="section-title text-dark">Доступные направления</h2>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php
        $stmt = $pdo->query("SELECT * FROM courses");
        while ($course = $stmt->fetch()):
        
            $img = !empty($course['image_url']) ? $course['image_url'] : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800';
        ?>
        <div class="col">
    <div class="card course-card shadow-sm h-100">
        <img src="<?= !empty($course['image_url']) ? htmlspecialchars($course['image_url']) : 'https://via.placeholder.com/800x400?text=No+Image' ?>" 
             class="card-img-top" 
             alt="<?= htmlspecialchars($course['title']) ?>"
             style="height: 200px; object-fit: cover;">
        
        <div class="card-body d-flex flex-column">
            <h5 class="fw-bold"><?= htmlspecialchars($course['title']) ?></h5>
            <p class="text-muted small"><?= mb_strimwidth($course['description'], 0, 100, "...") ?></p>
            <div class="mt-auto">
                <a href="course.php?id=<?= $course['id'] ?>" class="btn btn-primary w-100 rounded-pill">Начать путь</a>
            </div>
        </div>
    </div>
</div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>