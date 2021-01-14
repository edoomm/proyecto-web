<?php
require('../../fpdf/fpdf.php');
include "./db.php";

$conexion = open_database();
$curp = $_GET["curp"];
$nombre = $_GET["nombre"];

$sqlInsAlumno = "SELECT alumno_has_grupo.curp_alumno, grupo.clave, grupo.horario FROM alumno_has_grupo, grupo WHERE curp_alumno = '$curp' AND alumno_has_grupo.clave_grupo = grupo.clave";
$resInsAlmno = mysqli_query($conexion,$sqlInsAlumno);
$resp = mysqli_fetch_row($resInsAlmno);

$data = array($resp[0],substr($resp[1],0,4),substr($resp[2],0,10),substr($resp[2],11));

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
    $this->MultiCell(95,11,utf8_decode('Instituto Politécnico Nacional Escuela Superior de Cómputo'),0,'C',0);
    $this->Ln();
    $this->SetFont('Arial','B',14);
    $this->Cell(15);
    $this->MultiCell(160,11,utf8_decode("Comprobante de grupo para examen diagnostico únicamente alumnos de INGRESO EN FEBRERO"),0,'C',0);
}

function Footer()
{
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

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
$header = array('Curp',utf8_decode('Salón'),utf8_decode('Día'),'Hora');
//$data = array('CERI000722HDFRVNA9','1101','2021-02-22','10:00:00');
// Carga de datos
//$data = $pdf->LoadData('paises.txt');

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->SetY(80);
$pdf->Cell(10);
$pdf->MultiCell(170,10,utf8_decode("Bienvenido a ESCOM $nombre, por favor lleva impresa esta hoja el día de tu examen DIAGNOSTICO, ya que te servirá para ingresar a las instalaciones y para identificar el salón en el que realizaras tu examen. Pon atención en esta hoja al día y la hora que se te asigno, para evitar cualquier confusión."),0,'J',0);
$pdf->SetY(130);
$pdf->Cell(25);
$pdf->ImprovedTable($header,$data);
$pdf->SetY(160);
$pdf->Cell(10);
$pdf->MultiCell(170,10,utf8_decode("NOTA: Si colocaste mal alguno de tus datos puedes cambiarlo iniciando sesión en tu perfil, de igual forma, si por alguna razón pierdes esta hoja, puedes descargarla nuevamente ingresando al sistema....(link)"),0,'J',0);
$pdf->Output();
?>