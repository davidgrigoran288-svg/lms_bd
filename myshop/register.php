<?php 
include 'db.php'; 

if (isset($_POST['register'])) {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хеширование пароля

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $user, $email, $pass);
    
    if ($stmt->execute()) {
        header("Location: login.php?success=1");
    } else {
        $error = "Ошибка при регистрации. Возможно, email уже занят.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Регистрация — TechStore</title>
</head>
<body style="display:flex; align-items:center; justify-content:center; height:100vh;">
    <div class="card" style="width:100%; max-width:400px;">
        <h2>Создать аккаунт</h2>
        <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Имя пользователя" required>
            <input type="email" name="email" placeholder="Электронная почта" required>
            <input type="password" name="password" placeholder="Придумайте пароль" required>
            <button name="register" class="btn" style="width:100%; margin-top:10px;">Зарегистрироваться</button>
        </form>
        <p style="margin-top:20px; font-size:14px;">Уже есть аккаунт? <a href="login.php">Войти</a></p>
    </div>
</body>
</html>