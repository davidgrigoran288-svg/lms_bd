<?php
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM courses");
$courses = $stmt->fetchAll();
?>

<?php foreach ($courses as $course): ?>
    <h3><?= htmlspecialchars($course['title']) ?></h3>
<?php endforeach; ?>
<?php include 'db.php'; 
$category = $_GET['cat'] ?? 'all';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>EcoSmart — Эко-технологии 2026</title>
</head>
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
        <div style="text-align:center; margin: 60px 0;">
            <h1 style="font-size:42px;">Смартфоны для будущего</h1>
            <div style="display:flex; justify-content:center; gap:10px; margin-top:20px;">
                <a href="index.php?cat=all" class="btn" style="width:auto; padding:8px 25px; background:<?= $category=='all'?'var(--primary)':'#1e293b' ?>; color:<?= $category=='all'?'#000':'#fff' ?>;">Все</a>
                <a href="index.php?cat=Смартфон" class="btn" style="width:auto; padding:8px 25px; background:<?= $category=='Смартфон'?'var(--primary)':'#1e293b' ?>; color:<?= $category=='Смартфон'?'#000':'#fff' ?>;">Смартфоны</a>
                <a href="index.php?cat=Планшет" class="btn" style="width:auto; padding:8px 25px; background:<?= $category=='Планшет'?'var(--primary)':'#1e293b' ?>; color:<?= $category=='Планшет'?'#000':'#fff' ?>;">Планшеты</a>
            </div>
        </div>

        <div class="grid">
            <?php
            $query = ($category == 'all') ? "SELECT * FROM products" : "SELECT * FROM products WHERE category = '$category'";
            $res = $conn->query($query);
            while($p = $res->fetch_assoc()): ?>
                <div class="card" onclick="showDetails('<?= $p['name'] ?>', '<?= addslashes($p['description']) ?>', '<?= number_format($p['price'], 0, '', ' ') ?>', '<?= $p['image'] ?>')">
                    <img src="img/<?= $p['image'] ?>">
                    <h3 style="margin: 10px 0;"><?= $p['name'] ?></h3>
                    <div style="color:var(--primary); font-size:22px; font-weight:bold; margin-bottom:15px;">
                        <?= number_format($p['price'], 0, '', ' ') ?> ₽
                    </div>
                    <form method="POST" action="cart.php" onclick="event.stopPropagation();">
                        <input type="hidden" name="p_id" value="<?= $p['id'] ?>">
                        <button name="add" class="btn">В корзину</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Окно описания -->
    <div id="descModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <div style="display:flex; gap:30px; align-items:center;">
                <img id="m-img" style="width:250px; border-radius:15px;">
                <div style="text-align:left;">
                    <h2 id="m-name" style="color:var(--primary); margin-top:0;"></h2>
                    <p id="m-text" style="line-height:1.6; color:#94a3b8;"></p>
                    <div id="m-price" style="font-size:28px; font-weight:bold; margin-top:20px;"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDetails(name, desc, price, img) {
            document.getElementById('m-name').innerText = name;
            document.getElementById('m-text').innerText = desc;
            document.getElementById('m-price').innerText = price + ' ₽';
            document.getElementById('m-img').src = 'img/' + img;
            document.getElementById('descModal').style.display = 'flex';
        }
        function closeModal() { document.getElementById('descModal').style.display = 'none'; }
        window.onclick = function(e) { if(e.target.className == 'modal') closeModal(); }
    </script>
</body>
</html>