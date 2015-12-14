<?php 
///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT                                                   //
//                                                                       //
// 	Adeada Talleres Electricos                                           //
//          http://www.grupogisma.com                                    //
//                                                                       //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////
require('../../../functions/globales.php');
require('../include/rutas.php');
require('../functions/main.php');
require('../struct/login2.php');
require('../functions/dir_functions.php');
$titulo = "".html_entity_decode("Pol&iacute;tica de Calidad")."";

if($_POST['politica'] != ''){
	$filtropolitica = " where id = ".$_POST['politica']."";
}

$politicas = select_normal("SELECT * FROM kz_tec_dir_politicas $filtropolitica order by nombre asc"); 

if($politicas){
	if($_POST['pdf']){
		
		require(FPDF_PDF_RUTA.'lib/pdftable.inc.php');
		
		$p = new PDFTable('P');
		$p->SetMargins(15,43,300);
		
		foreach($politicas as $key => $valor){
			$p->AddPage('P');
			$p->SetMargins(15,10,170);
			$p->titulo(5,$titulo);	
			$p->setfont('Arial','',12);
			$p->SetTitle(date("d-m-Y")."_informe");
			$p->SetFillColor(255,255,255);
			$p->SetTextColor(0,0,0);
			$p->SetDrawColor(0,0,0);	
	
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',12);
			$p->MultiCell(180,5,$valor['politica'],0,"J",false);
			$p->ln(15);
			
			$p->MultiCell(180,6,$valor['fecha'],0,"R",false);
		}
		$p->output();
	}
}
else{
	echo "<script>alert('No se puede mostrar el informe. ".html_entity_decode("No hay pol&iacute;tica").".');</script>";
	echo "<script>window.close();</script>";
}?>
