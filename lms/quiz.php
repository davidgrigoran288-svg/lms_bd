<?php 
include 'db.php';

if (!isset($_GET['lesson_id'])) {
    die("Урок не выбран. <a href='index.php'>На главную</a>");
}

$lesson_id = (int)$_GET['lesson_id'];

// 1. Получаем ID курса из URL (обязательно приводим к числу)
$course_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// 2. ПОДГОТОВКА запроса (Этой строки у вас либо нет, либо в ней ошибка)
$q_stmt = $pdo->prepare("SELECT * FROM quiz_questions WHERE course_id = ?");

// 3. ВЫПОЛНЕНИЕ запроса (Строка 12)
$q_stmt->execute([$course_id]);

// 4. ПОЛУЧЕНИЕ данных
$questions = $q_stmt->fetchAll();

$score = null;
$correct_count = 0;
$total_questions = count($questions);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ans']) && is_array($_POST['ans'])) {
        foreach ($_POST['ans'] as $q_id => $user_val) {
            $check = $pdo->prepare("SELECT correct_option FROM quiz_questions WHERE id = ?");
            $check->execute([$q_id]);
            if ($check->fetchColumn() == $user_val) {
                $correct_count++;
            }
        }
        $score = ($total_questions > 0) ? ($correct_count / $total_questions) * 100 : 0;
    } else {
        $score = 0;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Домашнее задание</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .quiz-container { max-width: 700px; margin: 50px auto; }
        .card { border-radius: 15px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        .option-label { cursor: pointer; display: block; padding: 15px; border: 1px solid #dee2e6; border-radius: 10px; margin-bottom: 10px; transition: 0.3s; }
        .option-label:hover { background-color: #f0f7ff; border-color: #0d6efd; }
        input[type="radio"]:checked + .option-label { background-color: #e7f1ff; border-color: #0d6efd; color: #084298; font-weight: bold; }
    
  
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
    <div class="container quiz-container">
        <?php if ($score !== null): ?>
            <div class="card p-5 text-center shadow">
                <?php if ($score >= 70): ?>
                    <div class="text-success mb-4"><i class="bi bi-check-circle-fill" style="font-size: 4rem;"></i></div>
                    <h2 class="fw-bold text-success">Отличная работа!</h2>
                    <p class="lead">Вы прошли тест на <b><?= round($score) ?>%</b></p>
                    <div class="mt-4">
                        <a href="index.php" class="btn btn-primary btn-lg rounded-pill px-5">К списку курсов</a>
                    </div>
                <?php else: ?>
                    <div class="text-danger mb-4"><i class="bi bi-exclamation-triangle-fill" style="font-size: 4rem;"></i></div>
                    <h2 class="fw-bold text-danger">Нужно повторить</h2>
                    <p class="lead">Ваш результат: <b><?= round($score) ?>%</b>. Попробуйте еще раз!</p>
                    <div class="mt-4 d-grid gap-2 d-md-block">
                        <a href="quiz.php?lesson_id=<?= $lesson_id ?>" class="btn btn-warning btn-lg rounded-pill px-5 fw-bold shadow-sm">Начать заново</a>
                        <a href="lesson.php?id=<?= $lesson_id ?>" class="btn btn-outline-secondary btn-lg rounded-pill px-5">Теория</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <form method="POST" class="card shadow p-4 bg-white">
                <h3 class="fw-bold mb-4">Тест: Проверка знаний</h3>
                <?php foreach ($questions as $index => $q): ?>
                    <div class="mb-5">
                        <p class="fw-bold fs-5 mb-3"><?= ($index + 1) ?>. <?= htmlspecialchars($q['question_text']) ?></p>
                        <div class="options">
                            <?php foreach (['a', 'b', 'c'] as $opt): ?>
                                <input type="radio" class="btn-check" name="ans[<?= $q['id'] ?>]" id="q<?= $q['id'].$opt ?>" value="<?= $opt ?>" required>
                                <label class="option-label" for="q<?= $q['id'].$opt ?>">
                                    <?= strtoupper($opt) ?>) <?= htmlspecialchars($q['option_'.$opt]) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <button type="submit" class="btn btn-success w-100 py-3 fw-bold rounded-pill shadow-sm">ОТПРАВИТЬ НА ПРОВЕРКУ</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>