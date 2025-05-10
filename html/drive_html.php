<?php
$servername = "localhost";
$username = "root";
$password = "Aicberg1337!_Aicberg1337!";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT brand, model, photo_url FROM drive";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Запись на тест драйв</title>
    <link rel="stylesheet" href="../styles/drive.css">
    <link rel="shortcut icon" href="../src/icons/icon_site.png" type="image/x-icon">
</head>
<body>
    <header class="header">
        <nav class="nav container">
            <ul class="nav__list">
                <li class="nav__item"><a href="/index.php" class="nav__link">Главная</a></li>
            </ul>
        </nav>
    </header>

    <section class="test-drive">
        <div class="container">
            <div class="test-drive__heading">
                <h1 class="heading">Запись на тест-драйв</h1>
            </div>
            <form action="../actions/save_drive.php" method="post" class="test-drive__form">
                <div class="cars__list">
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="car" data-brand="' . $row["brand"] . '" data-model="' . $row["model"] . '">';
                            echo '<img src="' . $row["photo_url"] . '" alt="' . $row["brand"] . ' ' . $row["model"] . '" class="car__photo">';
                            echo '<h2 class="car__name">' . $row["brand"] . ' ' . $row["model"] . '</h2>';
                            echo '</div>';
                        }
                    } else {
                        echo "Нет данных об автомобилях.";
                    }
                    ?>
                </div>
                <div class="date-time__selection">
                    <div>
                        <label for="date">Выберите дату:</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div>
                        <label for="time">Выберите время:</label>
                        <input type="time" id="time" name="time" required>
                    </div>
                </div>
                <input type="hidden" id="selected_brand" name="brand" required>
                <input type="hidden" id="selected_model" name="model" required>
                <button type="submit" class="submit__button">Записаться</button>
            </form>
        </div>
    </section>

    <script src="../scripts/drive.js"></script>
</body>
</html>

<?php
$conn->close();
?>