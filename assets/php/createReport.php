<?php
require_once '../../vendor/autoload.php';

$css = file_get_contents('../css/mpdf.css'); // Estilo CSS

$style = '<style>' . $css . '</style>';

// Recibir la tabla HTML enviada por POST
$tablaHTML = $_POST['tablaAGEBs'];

// Crear una nueva instancia de mPDF
$mpdf = new \Mpdf\Mpdf([
    'format' => 'Letter',
    'orientation' => 'P',
    'default_font_size' => 10,
    'default_font' => 'Arial',
    'debug' => true,
]);

// Establecer márgenes
$mpdf->SetAutoPageBreak(true, 25);

// Establecer pie de página
$mpdf->setFooter('|pag {PAGENO} / {nbpg}|');

$html = $style . $tablaHTML;

// Agregar la tabla HTML al PDF
$mpdf->WriteHTML($html);

// Generar el PDF y enviarlo al navegador
$mpdf->Output('reporte-AGEBs.pdf', 'I');