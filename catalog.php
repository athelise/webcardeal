<?php
session_start(); // Добавляем старт сессии

$servername = "localhost";
$username = "root";
$password = "Aicberg1337!_Aicberg1337!";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function displayCars($conn, $category = null) {
    $sql = "SELECT brand, model, price, photo_url, class FROM cars";
    if ($category) {
        $sql .= " WHERE class = '$category'";
    }
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="cars__list">';
        while($row = $result->fetch_assoc()) {
            echo '<div class="car">';
            echo '<img src="' . $row["photo_url"] . '" alt="' . $row["brand"] . ' ' . $row["model"] . '" class="car__photo">';
            echo '<h2 class="car__name">' . $row["brand"] . ' ' . $row["model"] . '</h2>';
            echo '<p class="car__price">' . $row["price"] . '$</p>';
            echo '<p class="car__class">' . $row["class"] . '</p>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo "Нет данных об автомобилях.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог автомобилей</title>
    <link rel="stylesheet" href="../styles/catalog.css">
    <link rel="shortcut icon" href="../src/icons/icon_site.png" type="image/x-icon">
</head>
<body>
    <header class="header">
        <nav class="nav container">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="<?php echo isset($_SESSION['user']) ? '/index_auth.php' : '/index.php'; ?>" class="nav__link">
                        Главная
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="sidebar">
            <ul class="category__list">
                <li class="category__item"><a href="#" class="category__link" data-category="all">Все автомобили</a></li>
                <li class="category__item"><a href="#" class="category__link" data-category="SUV">SUV</a></li>
                <li class="category__item"><a href="#" class="category__link" data-category="Sedan">Sedan</a></li>
            </ul>
        </div>

        <div class="content">
            <div id="all" class="category-content">
                <?php displayCars($conn); ?>
            </div>
            <div id="SUV" class="category-content" style="display: none;">
                <?php displayCars($conn, 'SUV'); ?>
            </div>
            <div id="Sedan" class="category-content" style="display: none;">
                <?php displayCars($conn, 'Sedan'); ?>
            </div>
        </div>
    </div>

    <script src="../scripts/catalog.js"></script>
</body>
</html>

<?php
$conn->close();
?>