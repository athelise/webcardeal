<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'Бренд');
    $sheet->setCellValue('B1', 'Модель');
    $sheet->setCellValue('C1', 'Время');

    $sheet->setCellValue('A2', $brand);
    $sheet->setCellValue('B2', $model);
    $sheet->setCellValue('C2', $time);

    $directory = __DIR__ . '/../excel_docs';
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true);
    }
    $filename = $directory . '/drive_' . $date . '.xlsx';

    $writer = new Xlsx($spreadsheet);
    $writer->save($filename);

    header('Location: /../success_drive.php');
} else {
    echo "Ошибка: Метод запроса не POST.";
}
?>