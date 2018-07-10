<?php
require_once 'dist/dompdf/lib/html5lib/Parser.php';
require_once 'dist/dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once 'dist/dompdf/lib/php-svg-lib/src/autoload.php';
require_once 'dist/dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();


// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$text="<h1>ggg</h1>";
$dompdf = new Dompdf();
$dompdf->loadHtml($text);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
?>