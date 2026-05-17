<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $full_name = trim($_POST['full_name']);
    $group_number = trim($_POST['group_number']);
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    
    if ($stmt->fetch()) {
        $error = "Этот логин уже занят";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, full_name, group_number, password, role) VALUES (?, ?, ?, ?, 'user')");
        if ($stmt->execute([$username, $full_name, $group_number, $password])) {
            $_SESSION['success_msg'] = "Регистрация успешна! Теперь войдите.";
            header("Location: login.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Присоединиться к PRO-LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); 
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .auth-card {
            background: white;
            padding: 50px;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }
        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #636e72;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .form-control {
            border-radius: 12px;
            padding: 12px 18px;
            border: 2px solid #f1f2f6;
            background: #fdfdfe;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #6c5ce7;
            box-shadow: 0 0 0 4px rgba(108, 92, 231, 0.1);
            background: white;
        }
        .btn-register {
            background: linear-gradient(135deg, #6c5ce7 0%, #a29bfe 100%);
            border: none;
            border-radius: 12px;
            padding: 15px;
            font-weight: 700;
            color: white;
            margin-top: 10px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(108, 92, 231, 0.3);
            color: white;
        }
        .brand-logo {
            color: #6c5ce7;
            font-weight: 800;
            font-size: 1.5rem;
            margin-bottom: 30px;
            display: block;
            text-decoration: none;
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

<div class="auth-card text-center">
    <a href="index.php" class="brand-logo">PRO-LMS</a>
    <h3 class="fw-bold mb-2">Создать аккаунт</h3>
    <p class="text-muted mb-4">Начните свой путь в IT уже сегодня</p>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger py-2 rounded-3 small"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" class="text-start">
        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="form-label">ФИО студента</label>
                <input type="text" name="full_name" class="form-control" placeholder="Иванов Иван Иванович" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="form-label">Номер группы</label>
                <input type="text" name="group_number" class="form-control" placeholder="Напр: ИТ-21" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Логин (для входа)</label>
            <input type="text" name="username" class="form-control" placeholder="user123" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Придумайте пароль</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn btn-register w-100 shadow-sm">ЗАРЕГИСТРИРОВАТЬСЯ</button>
        
        <div class="mt-4">
            <span class="text-muted small">Уже учитесь у нас?</span>
            <a href="login.php" class="text-primary fw-bold small text-decoration-none ms-1">Войти в профиль</a>
        </div>
    </form>
</div>


</body>
</html>