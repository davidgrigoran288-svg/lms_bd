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


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}


if (isset($_GET['delete_course'])) {
    $id = (int)$_GET['delete_course'];
    $stmt = $pdo->prepare("DELETE FROM courses WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin.php?msg=Курс удален");
    exit;
}


$total_users = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'user'")->fetchColumn();
$total_courses = $pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn();
$courses = $pdo->query("SELECT * FROM courses")->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель управления | PRO-LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root { --admin-gradient: linear-gradient(135deg, #2c3e50 0%, #000000 100%); }
        body { background: #f0f2f5; font-family: 'Inter', sans-serif; }
        .sidebar { background: var(--admin-gradient); min-height: 100vh; color: white; padding: 20px; }
        .stat-card { border: none; border-radius: 15px; transition: 0.3s; }
        .stat-card:hover { transform: translateY(-5px); }
        .table-card { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .btn-action { border-radius: 10px; padding: 8px 15px; }
  
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

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar d-none d-md-block shadow">
            <h4 class="fw-bold mb-5 mt-2 text-warning"><i class="bi bi-shield-shaded"></i> ADMIN HQ</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-3"><a href="admin.php" class="nav-link text-white"><i class="bi bi-speedometer2 me-2"></i> Дашборд</a></li>
                <li class="nav-item mb-3"><a href="index.php" class="nav-link text-white opacity-75"><i class="bi bi-house me-2"></i> На сайт</a></li>
                <li class="nav-item mt-5"><a href="logout.php" class="nav-link text-danger"><i class="bi bi-box-arrow-left me-2"></i> Выйти</a></li>
            </ul>
        </div>

        <div class="col-md-10 p-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Обзор системы</h2>
                
                    <div class="mb-4 text-end">
    <?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin'): ?>
        
    <?php else: ?>
    <?php endif; ?>
</div>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
    <a href="add_course.php" class="btn btn-primary btn-create px-4 py-2 shadow-sm d-flex align-items-center">
        <i class="bi bi-plus-circle-fill me-2"></i> Создать новый курс
    </a>
<?php else: ?>
<?php endif; ?>
                </button>
            </div>

            <div class="row mb-5">
                <div class="col-md-4">
                    <div class="card stat-card bg-white p-4 shadow-sm">
                       <div class="col-md-4">
    <a href="admin_users.php" class="text-decoration-none text-dark">
        <div class="card stat-card bg-white h-100 shadow-sm border-0" style="transition: 0.3s; cursor: pointer;">
            <div class="d-flex align-items-center p-4">
                <div class="p-3 bg-primary bg-opacity-10 rounded-4 me-3 text-primary">
                    <i class="bi bi-person-badge fs-2"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-0 small uppercase fw-bold">Студентов</h6>
                    <h3 class="fw-bold mb-0"><?= $total_users ?></h3>
                    <small class="text-primary">Посмотреть всех →</small>
                </div>
            </div>
        </div>
    </a>
</div>   
                    </div>
                </div>
                
                <div class="col-md-4">
                    
                    <div class="card stat-card bg-white p-4 shadow-sm border-start border-primary border-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted text-uppercase small fw-bold">Всего курсов</h6>
                                <h2 class="fw-bold mb-0"><?= $total_courses ?></h2>
                            </div>
                            <div class="text-primary"><i class="bi bi-book fs-3"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-card border-0 shadow-sm">
                <h5 class="fw-bold mb-4">Управление контентом</h5>
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Название курса</th>
                            <th>Описание</th>
                            <th class="text-end">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $c): ?>
                        <tr>
                            <td class="text-muted">#<?= $c['id'] ?></td>
                            <td class="fw-bold"><?= htmlspecialchars($c['title']) ?></td>
                            <td class="text-muted small"><?= mb_strimwidth($c['description'], 0, 60, "...") ?></td>
                            <td class="text-end">
                                <a href="course.php?id=<?= $c['id'] ?>" class="btn btn-sm btn-outline-secondary btn-action me-2">Просмотр</a>
                                <a href="admin.php?delete_course=<?= $c['id'] ?>" 
                                   onclick="return confirm('Вы уверены? Все уроки этого курса также будут удалены!')" 
                                   class="btn btn-sm btn-danger btn-action">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>