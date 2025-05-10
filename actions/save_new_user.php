<?php 
$servername = "localhost";
$username = "name_user";
$password = "password";
$dbname = "db_name";

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

// Тут запрос SQL
$sql = ;

if ($conn -> query($sql) === TRUE) {
    echo "New user create";
} else {
    echo "Error" . $sql . "<br>" . $conn -> error;
}

$conn -> close();
?>