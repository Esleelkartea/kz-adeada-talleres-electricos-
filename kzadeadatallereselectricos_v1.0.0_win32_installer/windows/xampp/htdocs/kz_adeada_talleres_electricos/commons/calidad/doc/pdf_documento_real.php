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

if($_POST['pdf']){
	
	require(FPDF_PDF_RUTA.'lib/pdftable.inc.php');
	
	$p = new PDFTable('P');
	$p->SetMargins(3,43,0);
	$p->SetTitle(date("d-m-Y")."_revision_direccion");
	$p->SetFillColor(255,255,255);
	$p->SetTextColor(0,0,0);
	$p->SetDrawColor(0,0,0);	
	
	$doc_real = select_normal("Select * from kz_tec_doc_documentos_reales where id = ".$_POST['documento_real']."");
	$doc_real = $doc_real[0];
	
	$p->AddPage('P');
	$p->SetMargins(10,10,0);
	$p->setfont('Arial','B',12);
	
	$color1 = 'A6A6A6';
	$color2 = 'FFFFFF';
	$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
	$nor = "align=center height=5 valign=middle";
	
	$p->cell(0,0,$doc_real['titulo'],0,0,'C');
	$p->ln(15);
	
	$p->setfont('Arial','',10);
	$p->MultiCell(188,5,$doc_real['contenido'],0,'J');

	$p->output();
}?>
