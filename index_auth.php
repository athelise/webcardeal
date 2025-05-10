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
?>