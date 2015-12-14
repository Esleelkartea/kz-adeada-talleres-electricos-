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
$titulo = "Informe de orden del ".html_entity_decode("d&iacute;a")."";

$filtros = " where 1 = 1 ";

if($_POST['anno'] != ''){	
	$filtros .= " and anno = ".$_POST['anno']."";
}

if($_POST['estado']!=''){
	$filtros .= " and cumplido = ".$_POST['estado']." ";
}

$departamentos = select_normal("Select distinct(departamento) from kz_tec_dir_reuniones");

if($departamentos){
	if($_POST['pdf']){
		
		require(FPDF_PDF_RUTA.'lib/pdftable.inc.php');
		
		$p = new PDFTable('P');
		$p->SetMargins(3,43,0);
		$p->AddPage('P');
		$p->SetMargins(3,10,0);
		$p->titulo(5,$titulo);
		$p->setfont('Arial','',8);
		$p->SetTitle(date("d-m-Y")."_informe_objetivos");
		$p->SetFillColor(255,255,255);
		$p->SetTextColor(0,0,0);
		$p->SetDrawColor(0,0,0);
	
		foreach($departamentos as $key => $valor){
			
			$color1 = '5F5F5F';
			$color2 = 'FFFFFF';
			$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=4";
			
			$tabla = "<table>
				<tr>
					<td $tit width=204>DEPARTAMENTO: ".$valor['departamento']."</td>
				</tr>
			</table>";
			
			$p->htmltable($tabla);
			
			$color1 = 'A6A6A6';
			$color2 = 'FFFFFF';
			$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
			$contenido = "align=center height=5 valign=middle";
		
			$tabla = "<table border=1>
				<tr>
					<td $tit width=204>".html_entity_decode("&Oacute;rdenes")." del ".html_entity_decode("d&iacute;a")." pendientes</td>
				</tr>";
				$temas_pendientes = select_normal("Select distinct(a.tema), a.id, c.departamento from kz_tec_dir_temas a, kz_tec_dir_reuniones c where a.id in (Select b.idtema from kz_tec_dir_temasreunion b where cerrado = 0 and c.id = b.idreunion) and c.departamento = '".$valor['departamento']."'");
				if($temas_pendientes){
					foreach($temas_pendientes as $key2 => $valor2){
						$tabla.= "<tr>
							<td $contenido>".$valor2['tema']."</td>
						</tr>";
					}
				}
				else{
					$tabla.="<tr><td>No hay ".html_entity_decode("&oacute;rdenes del d&iacute;a")." pendientes</td></tr>";
				}
			$tabla.="</table>";
			
			$p->htmltable($tabla);
			$p->ln(2);
			
			$color1 = 'A6A6A6';
			$color2 = 'FFFFFF';
			$color3 = 'CECECE';
			$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
			$tit2 = "bgcolor=#$color3 color=#$color2 align=center valign=middle style=bold height=8";
			$contenido = "align=center height=5 valign=middle";
		
			$tabla = "<table border=1>
				<tr>
					<td $tit colspan=3>Decisiones pendientes</td>
				</tr>";
				$dec_pendientes = select_normal("Select distinct(a.decision),  a.id, c.departamento, d.responsable, d.plazo from kz_tec_dir_decisiones a, kz_tec_dir_reuniones c, kz_tec_dir_decisionesreunion d where a.id in (Select b.iddecision from kz_tec_dir_decisionesreunion b where cerrado = 0 and c.id = b.idreunion) and c.departamento = '".$valor['departamento']."' and d.iddecision = a.id and d.idreunion = c.id order by plazo desc");
				if($dec_pendientes){
					foreach($dec_pendientes as $key2 => $valor2){
						$tabla.= "<tr>
							<td $tit2 width=132>".html_entity_decode("Decisi&oacute;n")."</td>
							<td $tit2 width=55>Responsable</td>
							<td $tit2 width=17>Plazo</td>
						</tr>
						<tr>
							<td $contenido>".$valor2['decision']."</td>
							<td $contenido>".$valor2['responsable']."</td>
							<td $contenido>".$valor2['plazo']."</td>
						</tr>";
					}
				}
				else{
					$tabla.="<tr><td width=204>No hay decisiones pendientes</td></tr>";
				}
			$tabla.="</table>";
			
			$p->htmltable($tabla);
			$p->ln(10);
		}	
		$p->output();
	
	}
}
else{
	echo "<script>alert('No se puede mostrar el informe. No hay reuniones.');</script>";
	echo "<script>window.close();</script>";
}?>
