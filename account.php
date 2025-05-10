<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "Aicberg1337!_Aicberg1337!";
$dbname = "shop";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Ошибка подключения к БД: " . $conn->connect_error);
    }
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT first_name, last_name, email, phone FROM users WHERE id = ?");
    
    if (!$stmt) {
        throw new Exception("Ошибка подготовки запроса: " . $conn->error);
    }
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if (!$user) {
        throw new Exception("Пользователь не найден");
    }
    $stmt = $conn->prepare("SELECT brand, model, booking_date, booking_time, status FROM test_drives WHERE user_id = ? ORDER BY booking_date DESC");
    
    if (!$stmt) {
        throw new Exception("Ошибка подготовки запроса: " . $conn->error);
    }
    
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $test_drives = $stmt->get_result();
} catch (Exception $e) {
    error_log($e->getMessage());
    die("Произошла ошибка. Пожалуйста, попробуйте позже.");
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="/styles/account.css">
    <link rel="shortcut icon" href="/src/icons/icon_site.png" type="image/x-icon">
</head>
<body>
    <header class="header">
        <nav class="nav container">
            <a href="/" class="nav__logo">WebCarDeal</a>
            <ul class="nav__list">
                <li class="nav__item"><a href="/catalog.php" class="nav__link">Каталог</a></li>
                <li class="nav__item"><a href="/drive.php" class="nav__link">Тест-драйв</a></li>
                <li class="nav__item"><a href="/account.php" class="nav__link">Личный кабинет</a></li>
                <li class="nav__item"><a href="/actions/logout.php" class="nav__link">Выйти</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="account">
            <div class="container">
                <h1 class="heading">Личный кабинет</h1>
                
                <div class="account__info">
                    <h2>Личная информация</h2>
                    <p><strong>Имя:</strong> <?php echo htmlspecialchars($user['first_name'] ?? 'Не указано'); ?></p>
                    <p><strong>Фамилия:</strong> <?php echo htmlspecialchars($user['last_name'] ?? 'Не указано'); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email'] ?? 'Не указано'); ?></p>
                    <p><strong>Телефон:</strong> <?php echo htmlspecialchars($user['phone'] ?? 'Не указано'); ?></p>
                </div>

                <div class="account__test-drives">
                    <h2>Записи на тест-драйв</h2>
                    <?php if ($test_drives->num_rows > 0): ?>
                        <div class="test-drives__list">
                            <?php while($booking = $test_drives->fetch_assoc()): ?>
                                <div class="test-drive">
                                    <p><strong>Автомобиль:</strong> <?php echo htmlspecialchars($booking['brand'] . ' ' . $booking['model']); ?></p>
                                    <p><strong>Дата:</strong> <?php echo htmlspecialchars($booking['booking_date']); ?></p>
                                    <p><strong>Время:</strong> <?php echo htmlspecialchars($booking['booking_time']); ?></p>
                                    <p><strong>Статус:</strong> <?php echo htmlspecialchars($booking['status']); ?></p>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <p>У вас пока нет записей на тест-драйв.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <?php $conn->close(); ?>
</body>
</html>