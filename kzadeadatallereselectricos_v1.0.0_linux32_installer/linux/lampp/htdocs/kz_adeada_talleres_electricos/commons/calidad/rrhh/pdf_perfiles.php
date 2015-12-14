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
require('../functions/rrhh_functions.php');
$titulo = "Informe de perfiles";

$perfiles = select_normal("Select * from kz_tec_rrhh_perfilespuestos");


require(FPDF_PDF_RUTA.'lib/pdftable.inc.php');

$p = new PDFTable('P');
$p->SetMargins(3,43,0);

if($perfiles){
	$table = "<table border=1>
		<tr>
			<th>Nombre</th>
			<th>Funciones</th>
			<th>Formacion</th>
			<th></th>
			<th>Experiencia</th>
			<th>".html_entity_decode("Caracter&iacute;sticas")."</th> 
			<th></th>
		</tr>";
	
		foreach($perfiles as $key => $valor){
			
			$p->AddPage('P');
			$p->SetMargins(3,10,0);
			$p->titulo(5,$titulo);	
			$p->setfont('Arial','',8);
			$p->SetTitle(date("d-m-Y")."_informe");
			$p->SetFillColor(166,166,166);
			$p->SetTextColor(255,255,255);
			$p->SetDrawColor(0,0,0);	
			$p->Cell(204,10,"PERFILES DE PUESTO",1,1,"C",true);
			$p->Ln(5);
			
			$p->SetFillColor(255,255,255);
			$p->SetTextColor(175,175,175);
			$p->Cell(180,10,"".html_entity_decode("Denominaci&oacute;n del puesto")."",0,1,"LB");
			
			$p->SetTextColor(0,0,0);
			$p->SetFontSize(15);
			$p->Cell(180,5,$valor['nombre'],0,1,"L");
			$p->Ln(8);
			
			$p->SetFontSize(10);
			$p->SetTextColor(175,175,175);
			$p->Cell(80,10,"Funciones",0,1);
			$p->SetTextColor(0,0,0);
			
			$tabla = "<table>
				<tr>
					<td>".$valor['funciones']."</td>
				</tr>
			</table>";
			$p->htmltable($tabla);
			$p->Ln(8);
			
			$p->SetFontSize(10);
			$p->SetTextColor(0,0,0);
			$p->SetTextColor(175,175,175);
			$p->Cell(80,10,"".html_entity_decode("Formaci&oacute;n requerida")."",0,0);
			$p->Cell(20,10,"",0,0);
			$p->Cell(80,10,"Experiencia requerida",0,1);
			
			$p->SetTextColor(0,0,0);
			$tabla = "<table>
				<tr>
					<td width=80>".$valor['formacion']."</td>
					<td width=20>".$valor['forvsexp']."</td>
					<td width=80>".$valor['experiencia']."</td>
				</tr>
			</table>";
			$p->htmltable($tabla);
			$p->Ln(8);
			
			$p->SetFontSize(10);
			$p->SetTextColor(175,175,175);
			$p->Cell(80,10,"".html_entity_decode("Caracter&iacute;sticas personales")."",0,1);
			$p->SetTextColor(0,0,0);
			
			$tabla = "<table>
				<tr>
					<td>".$valor['caracteristicas']."</td>
				</tr>
			</table>";
			$p->htmltable($tabla);
			
			$p->SetY(270);
			$tabla = "<table>
				<tr>
					<td width=80>".html_entity_decode("Fecha aprobaci&oacute;n").":</td>
					<td width=80>Aprobado por:</td>
				</tr>
			</table>";
			$p->htmltable($tabla);
			
			$table.="<tr>
				<td>".$valor['nombre']."</td>
				<td>".$valor['funciones']."</td>
				<td>".$valor['formacion']."</td>
				<td>".$valor['forvsexp']."</td>
				<td>".$valor['experiencia']."</td>
				<td>".$valor['caracteristicas']."</td>	
			</tr>";
		}
	$table.="</table>";
}
else{
	echo "<script>alert('No se puede mostrar el informe. No hay perfiles.');</script>";
	echo "<script>window.close();</script>";
}

$p->Output();?>
