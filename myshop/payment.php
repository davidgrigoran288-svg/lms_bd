<?php include 'db.php'; 
if (empty($_SESSION['cart'])) { header("Location: index.php"); exit(); }

// Считаем итоговую сумму
$total_sum = 0;
foreach($_SESSION['cart'] as $id) {
    $res = $conn->query("SELECT price FROM products WHERE id = $id");
    $item = $res->fetch_assoc();
    $total_sum += $item['price'];
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Оплата заказа — EcoSmart</title>
    <style>
        .payment-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 30px;
        }
        .pay-card {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            padding: 30px;
            border-radius: 20px;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .pay-card:hover {
            border-color: var(--primary);
            background: rgba(0, 255, 136, 0.05);
        }
        .pay-card input { display: none; }
        .pay-card.active {
            border-color: var(--primary);
            box-shadow: 0 0 15px rgba(0, 255, 136, 0.2);
        }
        .pay-icon { font-size: 40px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <header>
        <div class="container"><div class="logo" style="color:var(--primary); font-weight:bold; font-size:24px;">EcoSmart</div></div>
    </header>

    <div class="container" style="max-width: 800px;">
        <h1 style="margin-top: 40px;">Выберите способ оплаты</h1>
        <p style="color: #94a3b8;">Сумма к оплате: <span style="color: var(--primary); font-weight: bold; font-size: 24px;"><?= number_format($total_sum, 0, '', ' ') ?> ₽</span></p>

        <form action="complete_order.php" method="POST">
            <div class="payment-grid">
                <!-- Карта -->
                <label class="pay-card" id="card_label">
                    <input type="radio" name="pay_method" value="card" required onclick="selectPay('card_label')">
                    <div class="pay-icon">💳</div>
                    <strong>Банковской картой</strong>
                    <small style="color: #64748b;">Visa, MasterCard, МИР</small>
                </label>

                <!-- СБП -->
                <label class="pay-card" id="sbp_label">
                    <input type="radio" name="pay_method" value="sbp" onclick="selectPay('sbp_label')">
                    <div class="pay-icon">📲</div>
                    <strong>СБП</strong>
                    <small style="color: #64748b;">Мгновенно по QR-коду</small>
                </label>

                <!-- Рассрочка -->
                <label class="pay-card" id="installments_label">
                    <input type="radio" name="pay_method" value="installments" onclick="selectPay('installments_label')">
                    <div class="pay-icon">📅</div>
                    <strong>Рассрочка</strong>
                    <small style="color: #64748b;">0% до 12 месяцев</small>
                </label>

                <!-- Кредит -->
                <label class="pay-card" id="credit_label">
                    <input type="radio" name="pay_method" value="credit" onclick="selectPay('credit_label')">
                    <div class="pay-icon">🏦</div>
                    <strong>В кредит</strong>
                    <small style="color: #64748b;">Низкая ставка от банков</small>
                </label>
            </div>

            <button type="submit" class="btn" style="margin-top: 40px; padding: 20px; font-size: 18px;">Подтвердить и оплатить</button>
        </form>
    </div>

    <script>
        function selectPay(id) {
            // Снимаем выделение со всех
            document.querySelectorAll('.pay-card').forEach(c => c.classList.remove('active'));
            // Добавляем выбранному
            document.getElementById(id).classList.add('active');
        }
    </script>
</body>
</html>