<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "Aicberg1337!_Aicberg1337!";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn -> connect_error) {
    die("Failed connection". $conn -> connect_error);
}

$email = $_POST["email"];
$password = $_POST["password"];

$sql = "SELECT id, first_name, last_name, email, password FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email']
        ];
        header("Location: ../index_auth.php");
        exit();
    } else {
        echo "Неверный пароль!";
    }
} else {
    echo "Пользователь не найден!";
}

$stmt -> close();
$conn -> close();
?>