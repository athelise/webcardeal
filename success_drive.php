<?php 
session_start();

if (!isset($_SESSION['success'])) {
    header("Location: /drive.php");
    exit();
}

require_once __DIR__ . '/html/success_drive.html';
?>