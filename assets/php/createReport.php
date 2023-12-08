<?php
require_once '../../vendor/autoload.php';

// Recibir la tabla HTML enviada por POST
$tablaHTML = $_POST['tablaAGEBs'];

// Crear una nueva instancia de mPDF
$mpdf = new \Mpdf\Mpdf();

// Agregar la tabla HTML al PDF
$mpdf->WriteHTML($tablaHTML);

// Generar el PDF y enviarlo al navegador
$mpdf->Output('reporte-AGEBs.pdf', 'I');
