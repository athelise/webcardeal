<?php 
$servername = "localhost";
$username = "root";
$password = "Aicberg1337!_Aicberg1337!";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn -> connect_error) {
    die("Failed connection". $conn -> connect_error);
}

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (first_name, last_name, email, phone, password)
        VALUES ('$first_name', '$last_name', '$email', '$phone', '$hashed_password')";

if ($conn -> query($sql) === TRUE) {
    header("Location: ../auth.php");
} else {
    echo "Error" . $sql . "<br>" . $conn -> error;
}

$conn -> close();
?>