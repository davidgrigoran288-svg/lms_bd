<?php 
include 'db.php'; 
if (!isset($_SESSION['user_id'])) header("Location: login.php");

$u_id = $_SESSION['user_id'];
$user_name = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Личный кабинет — EcoSmart</title>
</head>
<body>
    <header>
        <div class="container" style="display:flex; justify-content:space-between; align-items:center;">
            <div class="logo" style="font-size:24px; font-weight:bold; color:var(--primary);">EcoSmart</div>
            <nav style="display:flex; align-items:center;">
                <a href="index.php">Каталог</a>
                <a href="cart.php">Корзина</a>
                
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <a href="admin.php" style="color: var(--primary); border: 1px solid var(--primary); padding: 5px 10px; border-radius: 8px; margin-left: 15px;">Админ-панель</a>
                <?php endif; ?>

                <a href="logout.php" style="color:#ff4444; margin-left:20px;">Выйти</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <div style="margin-top:50px; display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <h1 style="color:var(--primary); margin-bottom: 5px;">Привет, <?= htmlspecialchars($user_name) ?>!</h1>
                <p style="color:#94a3b8;">Статус аккаунта: <?= ($_SESSION['role'] === 'admin') ? 'Администратор' : 'Пользователь' ?></p>
            </div>
            <!-- Кнопка выхода в самом профиле -->
            <a href="logout.php" class="filter-btn" style="border-color: #ff4444; color: #ff4444;">Завершить сеанс</a>
        </div>
        
        <h3 style="margin-top:40px; color:#fff;">История заказов</h3>
        <div class="card" style="padding:0; overflow:hidden;">
            <?php 
            $orders = $conn->query("SELECT * FROM orders WHERE user_id = $u_id ORDER BY id DESC");
            if ($orders->num_rows > 0): ?>
                <table style="width:100%; border-collapse: collapse;">
                    <tr style="background: rgba(255,255,255,0.05); color: #94a3b8;">
                        <th style="padding:15px; text-align:left;">ID</th>
                        <th>Сумма</th>
                        <th>Статус</th>
                    </tr>
                    <?php while($row = $orders->fetch_assoc()): ?>
                        <tr style="border-bottom: 1px solid var(--glass-border); text-align:center;">
                            <td style="padding:15px; text-align:left;">#<?= $row['id'] ?></td>
                            <td><?= number_format($row['total_price'], 0, '', ' ') ?> ₽</td>
                            <td style="color:var(--primary);"><?= $row['status'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <div style="padding:40px; text-align:center; color:#94a3b8;">Заказов пока нет.</div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>