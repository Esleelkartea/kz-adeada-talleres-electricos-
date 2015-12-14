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
require('../functions/doc_functions.php');
$titulo = "Informe de manual";

if($_POST['manual'] != ''){
	$filtros .= " and id = ".$_POST['manual']."";
}

if($_POST['pdf']){
	
	require(FPDF_PDF_RUTA.'lib/pdftable.inc.php');
	
	$p = new PDFTable('P');
	$p->SetMargins(3,43,0);
	$p->SetTitle(date("d-m-Y")."_revision_direccion");
	$p->SetFillColor(255,255,255);
	$p->SetTextColor(0,0,0);
	$p->SetDrawColor(0,0,0);
	
	$manual = select_normal("Select * from kz_tec_doc_manual WHERE 1=1 $filtros");
	if($manual)
		foreach($manual as $key => $valor){	
			$p->AddPage('P');
			$p->SetMargins(3,10,0);
			$p->titulo(5,$titulo);
			$p->setfont('Arial','',8);
			
			$color1 = '5F5F5F';
			$color2 = 'FFFFFF';
			$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=4";
			
			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->SetFillColor(166,166,166);
			$p->MultiCell(204,8,"".html_entity_decode("Presentaci&oacute;n")." de la empresa y su actividad",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,4,$valor['presentacion_empresa'],1,"L",false);
			$p->ln(5);
			
			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->SetFillColor(166,166,166);
			$p->MultiCell(204,8,"".html_entity_decode("Pol&iacute;tica")." de calidad de la ".html_entity_decode("organizaci&oacute;n")."",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['politica_calidad'],1,"L",false);
			$p->ln(5);
			
			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->SetFillColor(166,166,166);
			$p->MultiCell(204,8,"Alcance del sistema de ".html_entity_decode("gesti&oacute;n")." de calidad",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['alcance_sistema'],1,"L",false);
			$p->ln(5);
	
			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->MultiCell(204,8,"Referencia a los procedimientos",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['referencia_procedimientos'],1,"L",false);
			$p->ln(5);
			
			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->MultiCell(204,8,"Mapa de procesos",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['mapa_procesos'],1,"L",false);
			$p->ln(5);

			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->MultiCell(204,8,"Organigrama de la empresa",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['organigrama_empresa'],1,"L",false);
			$p->ln(5);
	
			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->MultiCell(204,8,"Funciones y responsabilidades",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['funciones_responsabilidades'],1,"L",false);
			$p->ln(5);
		}
	$p->output();
}?>
