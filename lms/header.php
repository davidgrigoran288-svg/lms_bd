<nav>
    <?php if(isset($_SESSION['user_id'])): ?>
        <a href="profile.php">Мой профиль</a>
        <a href="logout.php">Выход</a>
    <?php else: ?>
        <a href="login.php">Вход</a>
    <?php endif; ?>
</nav>