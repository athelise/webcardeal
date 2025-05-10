<?php
session_start();
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Пожалуйста, войдите в систему для записи на тест-драйв";
    header("Location: /auth.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $required = ['brand', 'model', 'date', 'time'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            $_SESSION['error'] = "Пожалуйста, заполните все поля";
            header("Location: /drive.php");
            exit();
        }
    }

    $brand = htmlspecialchars($_POST['brand']);
    $model = htmlspecialchars($_POST['model']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    $user_id = $_SESSION['user_id'];

    $servername = "localhost";
    $username = "root";
    $password = "Aicberg1337!_Aicberg1337!";
    $dbname = "shop";

    try {
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            throw new Exception("Ошибка подключения к БД: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO test_drives (user_id, brand, model, booking_date, booking_time) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса: " . $conn->error);
        }
        
        $stmt->bind_param("issss", $user_id, $brand, $model, $date, $time);
        $stmt->execute();
        
        $stmt = $conn->prepare("SELECT first_name, last_name, phone FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        
        if (!$user) {
            throw new Exception("Пользователь не найден");
        }

        $directory = __DIR__ . '/../excel_docs';
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        
        $filename = $directory . '/drive_' . $date . '.xlsx';
        
        if (file_exists($filename)) {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filename);
            $sheet = $spreadsheet->getActiveSheet();
            $lastRow = $sheet->getHighestRow() + 1;
        } else {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            
            $sheet->setCellValue('A1', 'Имя');
            $sheet->setCellValue('B1', 'Фамилия');
            $sheet->setCellValue('C1', 'Телефон');
            $sheet->setCellValue('D1', 'Бренд');
            $sheet->setCellValue('E1', 'Модель');
            $sheet->setCellValue('F1', 'Время');
            $lastRow = 2;
        }

        $sheet->setCellValue('A' . $lastRow, $user['first_name']);
        $sheet->setCellValue('B' . $lastRow, $user['last_name']);
        $sheet->setCellValue('C' . $lastRow, $user['phone']);
        $sheet->setCellValue('D' . $lastRow, $brand);
        $sheet->setCellValue('E' . $lastRow, $model);
        $sheet->setCellValue('F' . $lastRow, $time);

        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);

        $_SESSION['success'] = "Запись на тест-драйв успешно создана!";
        header('Location: /success_drive.php');
        exit();

    } catch (Exception $e) {
        $_SESSION['error'] = "Ошибка: " . $e->getMessage();
        header("Location: /drive.php");
        exit();
    } finally {
        if (isset($conn)) {
            $conn->close();
        }
    }
} else {
    $_SESSION['error'] = "Ошибка: Метод запроса не POST.";
    header("Location: /drive.php");
    exit();
}
?>