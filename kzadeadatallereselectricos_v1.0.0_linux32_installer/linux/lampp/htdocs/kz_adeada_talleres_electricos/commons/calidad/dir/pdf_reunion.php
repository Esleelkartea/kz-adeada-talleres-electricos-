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
$titulo = "".html_entity_decode("Informe de reuni&oacute;n")."";

if($_POST['pdf']){
	
	require(FPDF_PDF_RUTA.'lib/pdftable.inc.php');
	
	$p = new PDFTable('P');
	$p->SetMargins(3,43,0);
	$p->SetTitle(date("d-m-Y")."_revision_direccion");
	$p->SetFillColor(255,255,255);
	$p->SetTextColor(0,0,0);
	$p->SetDrawColor(0,0,0);	
	
	$reunion = select_normal("Select * from kz_tec_dir_reuniones where id = ".$_POST['reunion']."");
	$reunion = $reunion[0];
	
	$p->AddPage('P');
	$p->SetMargins(3,10,0);
	$p->titulo(5,$titulo);
	$p->setfont('Arial','',8);
	
	$color1 = 'A6A6A6';
	$color2 = 'FFFFFF';
	$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
	$nor = "align=center height=5 valign=middle";
	
	$tabla .= "<table border=1>
		<tr>
			<td $tit width=40>Fecha: </td>
			<td $nor width=100>".$reunion['fecha']."</td>
		</tr>
		<tr>
			<td $tit>Asistentes: </td>
			<td $nor> ".$reunion['asistentes']."</td>
		</tr>
		<tr>
			<td $tit>".html_entity_decode("Objeto de la reuni&oacute;n").": </td>
			<td $nor>".$reunion['objeto']."</td>
		</tr>
		<tr>
			<td $tit>".html_entity_decode("Fecha siguiente reuni&oacute;n").": </td>
			<td $nor>".$reunion['fechasig'].", ".$reunion['horasig']."</td>
		</tr>
		<tr>
			<td $tit>Departamento: </td><td $nor>".$reunion['departamento']."</td>
		</tr>
	</table>";
	
	$p->HTMLtable($tabla);
	$p->Ln(5);
	
	$temas_tratados = select_normal("Select * from kz_tec_dir_temasreunion where idreunion  = ".$reunion['id']."");
	$tabla = "<table border=1>
		<tr>
			<td $tit width=191>".html_entity_decode("&Oacute;rden del d&iacute;a")."</td>
			<td $tit width=13>Cerrado</td>
		</tr>";
	
		if($temas_tratados)
		foreach($temas_tratados as $key => $valor){
			$tema= select_normal("Select * from kz_tec_dir_temas where id=".$valor['idtema']."");
			$tema = $tema[0];
			$tabla .= "<tr>
				<td $nor>".$tema['tema']."</td>
				<td $nor>".siono($valor['cerrado'])."</td>
			</tr>";
		}
	$tabla .= "</table>";
	$p->HTMLtable($tabla);
	$p->ln(5);
			
	$dec = select_normal("Select * from kz_tec_dir_decisionesreunion a, kz_tec_dir_decisiones b where idreunion=".$reunion['id']." and a.iddecision=b.id");
	$tabla = "<table border=1>
		<tr>
			<td $tit width=132>".html_entity_decode("Decisi&oacute;n adoptada")."</td>
			<td $tit width=55>Responsable</td>
			<td $tit width=17>Plazo</td>
		</tr>";
	
		if($dec)
		foreach($dec as $keydec => $valordec){
			$tabla .= "<tr>
				<td $nor>".$valordec['decision']."</td>
				<td $nor>".$valordec['responsable']."</td>
				<td $nor>".$valordec['plazo']."</td>
			</tr>";
		}
	$tabla .= "</table>";
	
	$p->HTMLtable($tabla);
	$p->output();
}?>
