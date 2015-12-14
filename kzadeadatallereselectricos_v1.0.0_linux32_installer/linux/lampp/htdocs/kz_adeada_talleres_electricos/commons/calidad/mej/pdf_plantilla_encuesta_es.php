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
require('../functions/mej_functions.php');
$titulo = "".html_entity_decode("Encuesta de satisfacci&oacute;n")."";

if($_POST['pdf']){	
	
	require(FPDF_PDF_RUTA.'lib/pdftable.inc.php');

	$p = new PDFTable('P');
	$p->SetMargins(3,43,0);
	$p->AddPage('P');
	$p->SetMargins(3,10,0);
	$p->titulo(5,$titulo);
	$p->setfont('Arial','',8);
	$p->SetTitle(date("d-m-Y")."_revision_direccion");
	$p->SetFillColor(255,255,255);
	$p->SetTextColor(0,0,0);
	$p->SetDrawColor(0,0,0);
	
	$color1 = 'A6A6A6';
	$color2 = 'FFFFFF';
	$color3 = 'CECECE';
	$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=7";
	$tit2 = "bgcolor=#$color3 color=#$color2 align=center valign=middle style=bold height=7";
	$nor = "align=center height=5 valign=middle";

	$tabla .= "<table border=1>
		<tr>
			<td $tit width=50>Cliente: </td>
			<td $nor width=52></td>
			<td $tit width=50>Comercial: </td>
			<td $nor width=52></td>
		</tr>
		<tr>
			<td $tit>Nombre: </td>
			<td $nor></td>
			<td $tit>Apellido: </td>
			<td $nor></td>
		</tr>
		<tr>
			<td $tit>Fecha encuesta: </td>
			<td $nor></td>
		</tr>
	</table>";
	
	$p->HTMLtable($tabla);
	$p->Ln(5);
		
	$aspectos = select_normal("Select * from kz_tec_mej_campos_es");
	
	$tabla = "<table border=1>
		<tr>
			<td $tit width=70>Aspecto a valorar</td>
			<td $tit width=34>".html_entity_decode("Valoraci&oacute;n")." (de 1 a 10)</td>
			<td $tit width=60>".html_entity_decode("Valoraci&oacute;n")." frente a la comp. (de 1 a 10)</td>
			<td $tit width=40>Importancia (marcar con una X)</td>
		</tr>";
		foreach($aspectos as $key => $valor){
			$tabla .= "<tr>
			<td $nor align=left>".$valor['descripcion']."</td>
			<td $nor></td>
			<td $nor></td>
			<td $nor></td>
			</tr>";
		}
	$tabla .= "</table>";
	
	$p->HTMLtable($tabla);
	$p->ln(5);
		
	$tabla = "<table border=1>
		<tr>
			<td $tit width=60>Motivos de compra</td>
			<td $tit width=110>(Marcar los aspectos por los que contrata nuestros servicios)</td>
		</tr>
		<tr>
			<td $tit2>Calidad</td>
			<td></td>
		</tr>
		<tr>
			<td $tit2>Precio</td>
			<td></td>
		</tr>
		<tr>
			<td $tit2>Confianza</td>
			<td></td>
		</tr>
		<tr>
			<td $tit2>".html_entity_decode("Atenci&oacute;n")."</td>
			<td></td>
		</tr>
		<tr>
			<td $tit2>Servicio</td>
			<td></td>
		</tr>
		<tr>
			<td $tit2>".html_entity_decode("Cercan&iacute;a")."</td>
			<td></td>
		</tr>			
		<tr>
			<td $tit2>Experiencia</td>
			<td></td>
		</tr>
		<tr>
			<td $tit2>Otros</td>
			<td></td>
		</tr>
	</table>";
	
	$p->HTMLtable($tabla);
	$p->ln(5);
	
	$tabla = "<table border=1>
		<tr>
			<td $tit height=15 width=45>Sugerencias:</td>
			<td $nor width=159></td>
		</tr>
		<tr>
			<td $tit height=15>".html_entity_decode("An&aacute;lisis").":</td>
			<td $nor></td>
		</tr>
	</table>";
	
	$p->HTMLtable($tabla);
	$p->output();
}?>
