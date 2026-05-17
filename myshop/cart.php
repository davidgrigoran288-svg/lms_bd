<?php include 'db.php'; 
if(isset($_POST['add'])) { $_SESSION['cart'][] = $_POST['p_id']; header("Location: cart.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="ru">
<head><link rel="stylesheet" href="style.css"><title>Корзина — EcoSmart</title></head>
<body>
<header>
    <div class="container" style="display:flex; justify-content:space-between; align-items:center;">
        <div class="logo" style="font-size:24px; font-weight:bold; color:var(--primary);">EcoSmart</div>
        <nav style="display:flex; align-items:center;">
            <a href="index.php">Каталог</a>
            <a href="cart.php">Корзина (<?= count($_SESSION['cart'] ?? []) ?>)</a>
            <a href="profile.php">Профиль</a>
            
            <?php 
            // Кнопка админки: показывается только если роль в сессии равна 'admin'
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="admin.php" style="background: rgba(0, 255, 136, 0.1); color: var(--primary); padding: 5px 12px; border-radius: 8px; border: 1px solid var(--primary); margin-left: 15px;">
                    Админ-панель
                </a>
            <?php endif; ?>
        </nav>
    </div>
</header>   
<div class="container">
        <h1 style="margin: 40px 0; color:var(--primary);">Ваш выбор</h1>
        
        <div style="display:flex; flex-direction:column; gap:20px;">
            <?php 
            $total = 0;
            if(!empty($_SESSION['cart'])):
                foreach($_SESSION['cart'] as $id):
                    $item = $conn->query("SELECT * FROM products WHERE id = $id")->fetch_assoc();
                    $total += $item['price'];
            ?>
                <div class="card" style="display:flex; align-items:center; justify-content:space-between; padding:15px 30px; cursor:default;">
                    <div style="display:flex; align-items:center; gap:25px;">
                        <img src="img/<?= $item['image'] ?>" style="width:70px; height:70px; object-fit:contain; margin:0;">
                        <div>
                            <h3 style="margin:0;"><?= $item['name'] ?></h3>
                            <small style="color:#64748b;"><?= $item['category'] ?></small>
                        </div>
                    </div>
                    <div style="font-size:22px; font-weight:bold; color:var(--primary);">
                        <?= number_format($item['price'], 0, '', ' ') ?> ₽
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="card" style="text-align:right; border-color:var(--primary); background:rgba(0,255,136,0.05);">
                <span style="font-size:18px; color:#94a3b8;">Общая стоимость:</span>
                <h2 style="font-size:36px; margin:10px 0; color:var(--primary);"><?= number_format($total, 0, '', ' ') ?> ₽</h2>
                <form action="payment.php" method="POST">
    <button type="submit" class="btn" style="width: 100%; padding: 15px;">Перейти к оплате</button>
</form>
            </div>
            
            <?php else: ?>
                <div class="card" style="text-align:center; padding:60px;">
                    <h2>Корзина пуста</h2>
                    <a href="index.php" class="btn" style="width:auto; display:inline-block; margin-top:20px; text-decoration:none;">К покупкам</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>