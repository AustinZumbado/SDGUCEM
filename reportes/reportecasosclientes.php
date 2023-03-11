<?php
/*  
    ------------------------------------------------
          INFORMACION TECNICA DEL SISTEMA
    ------------------------------------------------
        -> Autor: Daniel Rivera  
            https://github.com/DanielRivera03
    
        -> Sistema gestion de Casos [CRM]
            PHP Puro / MVC
        
        -> Inspirado bajo el software de codigo
            abierto VTiger Real, este sistema no
            tiene ninguna relacion directa con 
            el sistema mencionado previamente

        -> Creditos logo: https://www.vtiger.com/
    ---------------------------------------------------
    COMPARTIDO Y LIBERADO CON FINES ACADEMICOS 
    ---------------------------------------------------   
*/
session_start();
if(!isset($_SESSION['vsTipo']))
{
	header('location:../index.php');
}
$resp=$_SESSION['resp'];
require('../reportes/fpdf/fpdf.php');
// ZONA HORARIA LOCAL -> COSTA RICA [SV]
date_default_timezone_set('America/Costa_Rica');
$pdf=new FPDF('P','mm','LETTER');
$pdf->addpage('P');
$pdf->setfont('times','B'.'I',18);
$pdf->settextcolor(0,0,0);
$pdf->cell(200,20,'"Carta de Estudiate Activo"',0,0,'C');
$pdf->ln(30);
//Encabezado
$pdf->settextcolor(0,0,0);
$pdf->setfont('Arial','',12);
$pdf->MultiCell(196,5,utf8_decode($_SESSION['vsNombre'].' '.$_SESSION['vsApellidos'].', CEDULA No. '.$_SESSION['vsCedula'].', carné de estudiante regular '.$_SESSION['vsCodigoUser']
.', en la carrera de Bachillerato en '.$_SESSION['vsCarrera'].', de la Universidad de Ciencias Empresariales -UCEM- La Universidad de Alajuela.- Institución  de Educación Superior Privada reconocida mediante resolución 316-97 del CONESUP,  es estudiante activo(a) y para el presente Cuatrimestre (ENERO/ABRIL 2023 )  matriculó las siguientes materias:'), 0, 'J');
$pdf->ln(5);
//Bucle para imprimir los datos
 $pdf->setfont('Arial','',12);
 foreach($resp as $columnas=>$fila)
 {
	$pdf->Cell(20,10,'-',0,0,'C');
 	$pdf->Cell(30,12,utf8_decode($fila['Codigo del curso']),0,0,'L');
	$pdf->Cell(80,12,utf8_decode($fila['Curso']),0,0,'L');
	// // CASOS EN PROCESO
	//  if($fila['Estado_de_reporte']=="en proceso"){
	//  	$pdf->settextcolor(0, 184, 148);
	//  	$pdf->Cell(15,10,utf8_decode($fila['Estado_de_reporte']),0,0,'L');
	// // CASOS PENDIENTES	
	//  }else if($fila['Estado_de_reporte']=="pendiente"){
	//  	$pdf->settextcolor(214, 48, 49);
	//  	$pdf->Cell(15,10,utf8_decode($fila['Estado_de_reporte']),0,0,'L');
	// // CASOS CERRADOS	
	//  }else if($fila['Estado_de_reporte']=="cerrado"){
	//  	$pdf->settextcolor(45, 52, 54);
	//  	$pdf->Cell(15,10,utf8_decode($fila['Estado_de_reporte']),0,0,'L');
	//  }
 	$pdf->settextcolor(0,0,0);
 	$pdf->ln(5);
 }
 //Texto
// $pdf->Ln(20);
// $pdf->settextcolor(0,0,0);
// $pdf->setfont('Arial','',12);
// $pdf->MultiCell(196,5,utf8_decode('Se extiende la presente a solicitud del interesado (a) en la ciudad de Alajuela, el día '. date('l'.' '.'d').' de '. date('F'.', '.'Y'.'.')), 0, 'J');
//Pie de pagina
$posicionY=(240-$pdf->GetY());
$pdf->ln($posicionY);
$pdf->cell(0,0,'Cursos: '.count($resp),0,1,'R');
$pdf->output();
?>