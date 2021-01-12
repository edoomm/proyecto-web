<?php
require('../../fpdf/fpdf.php');

class PDF extends FPDF
{
function Header()
{
    $this->Image('../../imgs/IPN_G.png',10,8,40);
    $this->Image('../../imgs/ESCOM_G.png',165,10,40);
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    $this->SetY(20);
    $this->Cell(50);
    $this->MultiCell(95,11,'Instituto Politecnico Nacional Escuela Superior de Computo',0,'C',0);
}

function Footer()
{
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

// // Cargar los datos
// function LoadData($file)
// {
//     // Leer las líneas del fichero
//     $lines = file($file);
//     $data = array();
//     foreach($lines as $line)
//         $data[] = explode(';',trim($line));
//     return $data;
// }

function ImprovedTable($header, $data)
{
    // Anchuras de las columnas
    $w = array(60, 25, 30, 30);
    // Cabeceras
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    $i=0;
    $this->Cell(25);
    // Datos
    foreach($data as $row)
    {
        $this->Cell($w[$i],10,$row,'LR');
        $i++;
    }
    $this->Ln();
    $this->Cell(25);
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}
}

$pdf = new PDF();
$header = array('Curp','Salon','Dia','Hora');
$data = array('CERI000722HDFRVNA9','1101','2021-02-22','10:00:00');
// Carga de datos
//$data = $pdf->LoadData('paises.txt');

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->SetY(60);
$pdf->Cell(10);
$pdf->MultiCell(170,10,"Bienvenido a ESCOM Ian, por favor lleva impresa esta hoja el dia de tu examen DIAGNOSTICO, ya que te servira para ingresar a las instalaciones y para identificar el salon en el que realizaras tu examen. Pon atencion en esta hoja al dia y la hora que se te asigno, para evitar cualquier confusion.",0,'J',0);
$pdf->SetY(110);
$pdf->Cell(25);
$pdf->ImprovedTable($header,$data);
$pdf->SetY(150);
$pdf->Cell(10);
$pdf->MultiCell(170,10,"NOTA: Si colocaste mal alguno de tus datos puedes cambiarlo iniciando sesion en tu perfil, de igual forma, si por alguna razon pierdes esta hoja, puedes descargarla nuevamente ingresando al sistema....(link)",0,'J',0);
$pdf->Output();
?>