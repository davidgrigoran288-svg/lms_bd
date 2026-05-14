<?php
include 'db.php';

// Защита: только для админов
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Удаление товара (логика)
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM products WHERE id = $id");
    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Панель управления — EcoSmart</title>
</head>
<body>
    <header>
        <div class="container" style="display:flex; justify-content:space-between; align-items:center;">
            <div class="logo" style="color:var(--primary); font-weight:bold; font-size:24px;">EcoSmart Admin</div>
            <nav>
                <a href="index.php">На сайт</a>
                <a href="logout.php" style="color:#ff4444; margin-left:20px;">Выйти</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1 style="margin-top:40px;">Управление магазином</h1>

        <!-- Статистика -->
        <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:20px; margin-bottom:40px;">
            <div class="card" style="text-align:center;">
                <small style="color:#94a3b8;">Всего товаров</small>
                <h2 style="color:var(--primary);"><?= $conn->query("SELECT id FROM products")->num_rows ?></h2>
            </div>
            <div class="card" style="text-align:center;">
                <small style="color:#94a3b8;">Заказов принято</small>
                <h2 style="color:var(--primary);"><?= $conn->query("SELECT id FROM orders")->num_rows ?></h2>
            </div>
            <div class="card" style="text-align:center;">
                <small style="color:#94a3b8;">Пользователей</small>
                <h2 style="color:var(--primary);"><?= $conn->query("SELECT id FROM users")->num_rows ?></h2>
            </div>
        </div>

        <!-- Управление товарами -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <h2>Список товаров</h2>
            <a href="add_product.php" class="btn" style="width:auto;">+ Добавить товар</a>
        </div>

        <div class="card" style="padding:0; overflow:hidden;">
            <table style="width:100%; border-collapse: collapse; color:#e2e8f0;">
                <thead style="background: rgba(255,255,255,0.05);">
                    <tr>
                        <th style="padding:15px; text-align:left;">ID</th>
                        <th>Фото</th>
                        <th style="text-align:left;">Название</th>
                        <th>Цена</th>
                        <th>Категория</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $products = $conn->query("SELECT * FROM products ORDER BY id DESC");
                    while($p = $products->fetch_assoc()): ?>
                    <tr style="border-bottom: 1px solid var(--glass-border); text-align:center;">
                        <td style="padding:15px; text-align:left;">#<?= $p['id'] ?></td>
                        <td><img src="img/<?= $p['image'] ?>" style="width:40px; height:40px; object-fit:contain;"></td>
                        <td style="text-align:left;"><?= $p['name'] ?></td>
                        <td><?= number_format($p['price'], 0, '', ' ') ?> ₽</td>
                        <td><?= $p['category'] ?></td>
                        <td>
                            <a href="?delete=<?= $p['id'] ?>" onclick="return confirm('Удалить товар?')" style="color:#ff4444; text-decoration:none;">Удалить</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>