<?php
$servername = "localhost";
$username = "root";
$password = "Aicberg1337!_Aicberg1337!";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);
$query = "SELECT brand, model, photo_url FROM drive";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Запись на тест-драйв</title>
    <link rel="stylesheet" href="../styles/drive.css">
    <link rel="shortcut icon" href="../src/icons/icon_site.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <a href="/index_auth.php" class="back-button">← На главную</a>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <section class="test-drive">
            <div class="test-drive__heading">
                <h1 class="heading">Запись на тест-драйв</h1>
            </div>

            <div class="cars__list">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="car" data-brand="<?php echo $row['brand']; ?>" data-model="<?php echo $row['model']; ?>">
                        <img src="<?php echo $row['photo_url']; ?>" alt="<?php echo $row['brand'] . ' ' . $row['model']; ?>" class="car__photo">
                        <h2 class="car__name"><?php echo $row['brand'] . ' ' . $row['model']; ?></h2>
                    </div>
                <?php endwhile; ?>
            </div>

            <form action="../actions/save_drive.php" method="POST" class="date-time__selection">
                <input type="hidden" name="brand" id="selected-brand">
                <input type="hidden" name="model" id="selected-model">
                
                <div>
                    <label for="date">Выберите дату:</label>
                    <input type="date" id="date" name="date" required min="<?php echo date('Y-m-d'); ?>">
                </div>
                
                <div>
                    <label for="time">Выберите время:</label>
                    <input type="time" id="time" name="time" required min="09:00" max="18:00">
                </div>

                <button type="submit" class="submit__button" disabled>Записаться на тест-драйв</button>
            </form>
        </section>
    </div>

    <script src="../scripts/drive.js"></script>
</body>
</html>