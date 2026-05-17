<?php
session_start();
include 'db.php';
include 'style_inc.php'; // Наш фиолетовый дизайн

// Проверяем, вошел ли пользователь
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Получаем данные пользователя
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мой профиль | LMS</title>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <div class="text-center mb-4">
                    <div style="width: 100px; height: 100px; background: #6c5ce7; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 2rem; color: white;">
                        <?= mb_substr($user['username'], 0, 1) ?>
                    </div>
                    <h2 class="mt-3"><?= htmlspecialchars($user['username']) ?></h2>
                    <p class="text-muted">На сайте с: <?= date('d.m.Y', strtotime($user['created_at'])) ?></p>
                </div>

                <hr style="border-color: rgba(255,255,255,0.1);">
                
                <div class="user-info">
                    <p><strong>Полное имя:</strong> <?= htmlspecialchars($user['full_name'] ?? 'Не указано') ?></p>
                    <p><strong>О себе:</strong> <?= htmlspecialchars($user['bio'] ?? 'Информация отсутствует') ?></p>
                    <p><strong>Роль:</strong> <span class="badge bg-primary"><?= $user['role'] ?></span></p>
                </div>

                <div class="mt-4 d-grid gap-2">
                    <a href="edit_profile.php" class="btn btn-outline-primary">Редактировать профиль</a>
                    <a href="logout.php" class="btn btn-danger btn-sm">Выйти из аккаунта</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>