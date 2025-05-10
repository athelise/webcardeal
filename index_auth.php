<?php 
require_once __DIR__ . "/html/index_auth.html"
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

$sql = "SELECT first_name, last_name, position, description, photo_url FROM employees";
$result = $conn->query($sql);

if ($result -> num_rows > 0) {
    echo '<section class="employees" id="heroes">';
    echo '<div class="container">';
    echo '<div class="employees__heading">';
    echo '<h1 class="heading">Наши герои</h1>';
    echo '</div>';
    echo '<div class="employees__list">';

    while($row = $result->fetch_assoc()) {
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

$sql = "SELECT brand, model, price, photo_url FROM cars LIMIT 3";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<section class="cars" id="cars">';
    echo '<div class="container">';
    echo '<div class="cars__heading">';
    echo '<h1 class="heading">Каталог</h1>';
    echo '</div>';
    echo '<div class="cars__list">';

    while($row = $result->fetch_assoc()) {
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

$conn->close();
?>

<?php 
require_once __DIR__ . "/html/footer.html"
?>