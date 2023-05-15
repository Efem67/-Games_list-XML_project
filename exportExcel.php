<?php
require 'vendor/autoload.php';

// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment;filename="nazwa_pliku.xlsx"');
// header('Cache-Control: max-age=0');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
// $sheet->setCellValue('A1', 'Hello World !');

$sheet->getColumnDimension('A')->setWidth(22);
$sheet->getColumnDimension('B')->setWidth(22);
$sheet->getColumnDimension('C')->setWidth(22);
$sheet->getColumnDimension('D')->setWidth(22);

$styleArrayFirstRow = [
    'font' => [
        'bold' => true,
    ]
];

$highestColumn = $sheet->getHighestColumn();
$sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray($styleArrayFirstRow);

$sheet
    ->getStyle('A1:D1')
    ->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()
    ->setARGB('c2d6ff');

$doc = new DOMDocument();
$doc->load('games.xml');

$teksik = "Nazwa gry";
$sheet->setCellValueByColumnAndRow(1, 1, "Nazwa gry");
$sheet->setCellValueByColumnAndRow(2, 1, "Miniaturka");
$sheet->setCellValueByColumnAndRow(3, 1, "Autor");
$sheet->setCellValueByColumnAndRow(4, 1, "Czasopismo");


$games = $doc->getElementsByTagName('game');
$i = 0;
foreach ($games as $game) {

    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    $drawing->setName('Gfx');

    try {
        $drawing->setPath('./pictures/' . $game->getElementsByTagName('picture')->item(0)->textContent);
    } catch (Exception $e) {
        $drawing->setPath('./pictures/unknown.jpg');
    }

    $drawing->setHeight(200); // ewentualna wielkość

    $comment = $sheet->getComment("A" . ($i + 2));
    $comment->setBackgroundImage($drawing);
    $comment->setSizeAsBackgroundImage(); //jeśli chcemy komentarz wielkości obrazka

    $sheet->setCellValueByColumnAndRow(1, $i + 2, $game->getElementsByTagName('title')->item(0)->textContent);
    $sheet->setCellValueByColumnAndRow(2, $i + 2, $game->getElementsByTagName('picture')->item(0)->textContent);
    $sheet->setCellValueByColumnAndRow(3, $i + 2, $game->getElementsByTagName('author')->item(0)->textContent);
    $sheet->setCellValueByColumnAndRow(4, $i + 2, strip_tags($game->getElementsByTagName('magazine')->item(0)->textContent));

    $i++;
}

// $writer = new Xlsx($spreadsheet);
// $writer->save('games.xlsx');
$fileName = 'games.xlsx';
$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
$writer->save('php://output');


// echo $doc->saveXML();
// $doc->save("games.xml");

header("Location: main.php");
exit();
