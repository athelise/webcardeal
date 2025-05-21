<?php 
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Пожалуйста, войдите в систему для записи на тест-драйв";
    header("Location: /auth.php");
    exit();
}

if (!file_exists(__DIR__ . "/html/drive_html.php")) {
    die("Error: drive_html.php file not found");
}

require_once __DIR__ . "/html/drive_html.php";
?>