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
$titulo = "".html_entity_decode("Revisi&oacute;n por la direcci&oacute;n de Caliad")."";

$filtros = " where 1 = 1 ";

if($_POST['anno'] != ''){
	$filtros .= " and anno = ".$_POST['anno']."";
}

if($_POST['pdf']){
	
	require(FPDF_PDF_RUTA.'lib/pdftable.inc.php');
	
	$p = new PDFTable('P');
	$p->SetMargins(3,43,0);
	$p->SetTitle(date("d-m-Y")."_revision_direccion");
	$p->SetFillColor(255,255,255);
	$p->SetTextColor(0,0,0);
	$p->SetDrawColor(0,0,0);
	
	$rev = select_normal("Select * from kz_tec_dir_revisiondireccion $filtros order by anno DESC, fecha desc");
	if($rev)
		foreach($rev as $key => $valor){	
			$p->AddPage('P');
			$p->SetMargins(3,10,0);
			$p->titulo(5,$titulo);
			$p->setfont('Arial','',8);
			
			$color1 = '5F5F5F';
			$color2 = 'FFFFFF';
			$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=4";
			
			$tabla = "<table>
				<tr>
					<td $tit width=204>".$valor['fecha']."</td>
				</tr>
			</table>";
			
			$p->htmltable($tabla);
			$p->ln(5);
			
			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->SetFillColor(166,166,166);
			$p->MultiCell(204,8,"Asistentes",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,4,$valor['asistentes'],1,"C",false);
			$p->ln(5);
			
			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->SetFillColor(166,166,166);
			$p->MultiCell(204,8,"Resultado de auditoria",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['resultado'],1,"L",false);
			$p->ln(5);
			
			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->SetFillColor(166,166,166);
			$p->MultiCell(204,8,"".html_entity_decode("Retroalimentaci&oacute;n del cliente")."",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['retroalimentacion'],1,"L",false);
			$p->ln(5);
	
			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->MultiCell(204,8,"".html_entity_decode("Desempe&ntilde;o")." de los procesos",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['desempeno'],1,"L",false);
			$p->ln(5);
			
			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->MultiCell(204,8,"Conformidad del producto",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['conformidad'],1,"L",false);
			$p->ln(5);

			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->MultiCell(204,8,"Estado de las acciones correctivas y preventivas",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['estado'],1,"L",false);
			$p->ln(5);
	
			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->MultiCell(204,8,"Acciones de seguimiento de revisiones por la ".html_entity_decode("direcci&oacute;n")." previas",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['acciones'],1,"L",false);
			$p->ln(5);

			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->MultiCell(204,8,"".html_entity_decode("Cambios que podr&aacute;n afectar al sistema de gesti&oacute;n de la caliadd")."",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['cambios'],1,"L",false);
			$p->ln(5);
			
			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->MultiCell(204,8,"Recomendaciones para la mejora",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['recomendaciones'],1,"L",false);
			$p->ln(5);
	
			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->MultiCell(204,8,"".html_entity_decode("Revisi&oacute;n de la pol&iacute;tica del sistema de gesti&oacute;n")."",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['revision'],1,"L",false);
			$p->ln(5);
	
			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->MultiCell(204,8,"Decisiones relacionadas en lo referente a necesidades de recursos",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['decisiones1'],1,"L",false);
			$p->ln(5);

			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->MultiCell(204,8,"Decisiones relacionadas con la mejora de la eficacia del sistema de ".html_entity_decode("gesti&oacute;n")." de la calidad y sus procesos",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['decisiones2'],1,"L",false);
			$p->ln(5);

			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->MultiCell(204,8,"Decisiones  y acciones relacionadas con la mejora del producto",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['decisiones3'],1,"L",false);
			$p->ln(5);
			
			$p->SetFont('Arial','B',8);
			$p->SetTextColor(255,255,255);
			$p->MultiCell(204,8,"Tratar las acciones de mejora",1,"C",true);
			$p->SetTextColor(0,0,0);
			$p->SetFont('Arial','',7);
			$p->MultiCell(204,3,$valor['tratar_acciones_mejora'],1,"L",false);
			$p->ln(5);
		}
	$p->output();
}?>
