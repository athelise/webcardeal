<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /index.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "Aicberg1337!_Aicberg1337!";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$user_id = $_SESSION['user']['id'];
$created_at = date('Y-m-d H:i:s');

$sql = "INSERT INTO contact_messages (user_id, name, email, message, created_at) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("issss", $user_id, $name, $email, $message, $created_at);

if ($stmt->execute()) {
    $_SESSION['message'] = "Ваше сообщение успешно отправлено!";
    $_SESSION['message_type'] = "success";
} else {
    $_SESSION['message'] = "Ошибка при отправке сообщения. Пожалуйста, попробуйте позже.";
    $_SESSION['message_type'] = "error";
}

$stmt->close();
$conn->close();

header('Location: /personal_account.php');
exit();
?> 