<?php
include 'db.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') { header("Location: index.php"); exit(); }

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $cat = $_POST['category'];
    $desc = $_POST['description'];
    $img = $_POST['image']; // Имя файла, который вы положили в папку img

    $conn->query("INSERT INTO products (name, price, category, description, image) VALUES ('$name', '$price', '$cat', '$desc', '$img')");
    header("Location: admin.php");
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Добавить товар — EcoSmart</title>
</head>
<body>
    <div class="container" style="max-width:600px; margin-top:50px;">
        <div class="card">
            <h2 style="color:var(--primary); margin-bottom:30px;">Новый товар</h2>
            <form method="POST" style="display:flex; flex-direction:column;">
                <input type="text" name="name" placeholder="Название товара" required>
                <input type="number" name="price" placeholder="Цена (руб)" required>
                <select name="category" style="margin-bottom:15px;">
                    <option value="Смартфон">Смартфон</option>
                    <option value="Планшет">Планшет</option>
                    <option value="Аксессуар">Аксессуар</option>
                </select>
                <textarea name="description" placeholder="Описание" style="background:rgba(255,255,255,0.05); border:1px solid var(--glass-border); color:white; padding:12px; border-radius:12px; height:100px; margin-bottom:15px;"></textarea>
                <input type="text" name="image" placeholder="Имя файла картинки (например: phone.png)">
                <button name="save" class="btn">Сохранить товар</button>
                <a href="admin.php" style="text-align:center; margin-top:15px; color:#94a3b8; text-decoration:none;">Назад</a>
            </form>
        </div>
    </div>
</body>
</html>