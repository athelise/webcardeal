<?php 
session_start();
require_once __DIR__ . "/html/index_auth.html";
?>

<?php 
$servername = "localhost";
$username = "root";
$password = "Aicberg1337!_Aicberg1337!";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_cars = "SELECT brand, model, price, photo_url FROM cars LIMIT 3";
$result_cars = $conn->query($sql_cars);

if ($result_cars->num_rows > 0) {
    echo '<section class="cars" id="cars">';
    echo '<div class="container">';
    echo '<div class="cars__heading">';
    echo '<h1 class="heading">Каталог</h1>';
    echo '</div>';
    echo '<div class="cars__list">';

    while($row = $result_cars->fetch_assoc()) {
        echo '<div class="car">';
        echo '<img src="' . $row["photo_url"] . '" alt="' . $row["brand"] . ' ' . $row["model"] . '" class="car__photo">';
        echo '<h2 class="car__name">' . $row["brand"] . ' ' . $row["model"] . '</h2>';
        echo '<p class="car__price">' . $row["price"] . '$</p>';
        echo '</div>';
    }

    echo '</div>';
    echo '<div class="cars__button">';
    echo '<a href="/catalog.php" class="button">Посмотреть еще</a>';
    echo '</div>';
    echo '</div>';
    echo '</section>';
} else {
    echo "Нет данных об автомобилях.";
}

$sql_employees = "SELECT first_name, last_name, position, description, photo_url FROM employees";
$result_employees = $conn->query($sql_employees);

if ($result_employees->num_rows > 0) {
    echo '<section class="employees" id="heroes">';
    echo '<div class="container">';
    echo '<div class="employees__heading">';
    echo '<h1 class="heading">Наши герои</h1>';
    echo '</div>';
    echo '<div class="employees__list">';

    while($row = $result_employees->fetch_assoc()) {
        echo '<div class="employee">';
        echo '<img src="' . $row["photo_url"] . '" alt="' . $row["first_name"] . ' ' . $row["last_name"] . '" class="employee__photo">';
        echo '<h2 class="employee__name">' . $row["first_name"] . ' ' . $row["last_name"] . '</h2>';
        echo '<p class="employee__position">' . $row["position"] . '</p>';
        echo '<p class="employee__description">' . $row["description"] . '</p>';
        echo '</div>';
    }

    echo '</div>';
    echo '</div>';
    echo '</section>';
} else {
    echo "Нет данных о сотрудниках.";
}

// Contact section
echo '<section class="contact" id="contact">';
echo '<div class="container">';
echo '<div class="contact__heading">';
echo '<h1 class="heading">Свяжитесь с нами</h1>';
echo '</div>';
echo '<div class="contact__content">';
echo '<div class="contact__info">';
echo '<div class="contact__item">';
echo '<h3>Адрес</h3>';
echo '<p>г. Казань, <br> ул. Сары Садыкова, 13</p>';
echo '</div>';
echo '<div class="contact__item">';
echo '<h3>Телефон</h3>';
echo '<p>+7 (999) 123-45-67</p>';
echo '<p>+7 (999) 876-54-32</p>';
echo '</div>';
echo '<div class="contact__item">';
echo '<h3>Email</h3>';
echo '<p>info@mir-tazikov.ru</p>';
echo '</div>';
echo '<div class="contact__item">';
echo '<h3>Время работы</h3>';
echo '<p>Пн-Пт: 9:00 - 20:00<br>Сб-Вс: 10:00 - 18:00</p>';
echo '</div>';
echo '</div>';
echo '<div class="contact__form">';
echo '<form class="form" action="/actions/submit_contact_auth.php" method="POST">';
if (isset($_SESSION['user'])) {
    echo '<input type="text" name="name" value="' . htmlspecialchars($_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name']) . '" class="form__input" required>';
    echo '<input type="email" name="email" value="' . htmlspecialchars($_SESSION['user']['email']) . '" class="form__input" required>';
} else {
    header("Location: /index.php");
    exit();
}
echo '<textarea name="message" placeholder="Ваше сообщение" class="form__textarea" required></textarea>';
echo '<button type="submit" class="button">Отправить</button>';
echo '</form>';
if (isset($_SESSION['message'])) {
    echo '<div class="message ' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
echo '</div>';
echo '</div>';
echo '</div>';
echo '</section>';

$conn->close();
?>

<?php 
require_once __DIR__ . "/html/footer.html"
?>