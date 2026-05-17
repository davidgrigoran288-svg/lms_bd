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

// Удаление студента
if (isset($_GET['delete_user'])) {
    $id = (int)$_GET['delete_user'];
    // Не даем админу удалить самого себя
    if ($id != $_SESSION['user_id']) {
        $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);
        header("Location: admin_users.php?msg=deleted");
        exit;
    }
}

$users = $pdo->query("SELECT * FROM users WHERE role = 'user' ORDER BY group_number ASC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Управление студентами</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: #f0f2f5; }
        .sidebar { background: #1a1a2e; min-height: 100vh; color: white; padding: 20px; }
        .user-card { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        
  
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
        <div class="col-md-2 sidebar">
            <h4 class="fw-bold mb-4">LMS Admin</h4>
            <a href="admin.php" class="nav-link text-white-50 mb-3"><i class="bi bi-book me-2"></i> Курсы</a>
            <a href="admin_users.php" class="nav-link text-white mb-3 fw-bold"><i class="bi bi-people me-2"></i> Студенты</a>
            <hr>
            <a href="index.php" class="nav-link text-white-50"><i class="bi bi-arrow-left"></i> На сайт</a>
        </div>

        <div class="col-md-10 p-5">
            <h2 class="fw-bold mb-4">Список студентов</h2>
            
            <div class="user-card">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ФИО</th>
                            <th>Группа</th>
                            <th>Логин</th>
                            <th class="text-end">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $u): ?>
                        <tr>
                            <td class="fw-bold"><?= htmlspecialchars($u['full_name']) ?></td>
                            <td><span class="badge bg-primary rounded-pill"><?= htmlspecialchars($u['group_number']) ?></span></td>
                            <td class="text-muted"><?= htmlspecialchars($u['username']) ?></td>
                            <td class="text-end">
                                <a href="admin_users.php?delete_user=<?= $u['id'] ?>" 
                                   class="btn btn-outline-danger btn-sm rounded-3" 
                                   onclick="return confirm('Удалить студента?')">
                                    <i class="bi bi-trash"></i> Удалить
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