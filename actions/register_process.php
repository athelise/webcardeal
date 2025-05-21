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

    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (first_name, last_name, email, phone, password) 
            VALUES ('$first_name', '$last_name', '$email', '$phone', '$password')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['user'] = [
            'id' => $conn->insert_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email
        ];
        
        setcookie('user_email', $email, time() + (86400 * 30), "/"); // 30 days
        
        header("Location: /index_auth.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $conn->error;
        header("Location: /register.php");
        exit();
    }
}
$conn->close();
?> 