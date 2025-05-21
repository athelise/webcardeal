<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "Aicberg1337!_Aicberg1337!";
    $dbname = "shop";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Сообщение успешно отправлено!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Ошибка при отправке сообщения: " . $conn->error;
        $_SESSION['message_type'] = "error";
    }

    $conn->close();
    header("Location: /#contact");
    exit();
}
?> 