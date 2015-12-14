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
$titulo = "Informe de objetivos";

$filtros = " where 1 = 1 ";

if($_POST['anno'] != ''){
	$filtros .= " and anno = ".$_POST['anno']."";
}

if($_POST['estado']!=''){
	$filtros .= " and cumplido = ".$_POST['estado']." ";
}

$objetivos = select_normal("Select * from kz_tec_dir_objetivos $filtros order by anno desc");

if($objetivos){
	if($_POST['pdf']){		
		
		require(FPDF_PDF_RUTA.'lib/pdftable.inc.php');
		
		$p = new PDFTable('L');
		$p->SetMargins(3,43,0);
	
		foreach($objetivos as $key => $valor){
			$p->AddPage('L');
			$p->titulo(5,$titulo);
			$p->setfont('Arial','',8);
			$p->SetTitle(date("d-m-Y")."_informe_objetivos");
			$p->SetFillColor(255,255,255);
			$p->SetTextColor(0,0,0);
			$p->SetDrawColor(0,0,0);
			$tit = "bgcolor = #b5d6ff";
			
			$color1 = '5F5F5F';
			$color2 = 'FFFFFF';
			$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=4";
			
			$tabla = "<table border=1>";
				$tabla.="<tr>
					<td $tit width=25>OBJETIVO</td>
				</tr>
			</table>";
			
			$color1 = 'A6A6A6';
			$color2 = 'FFFFFF';
			$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
			$contenido = "align=center height=5 valign=middle";
			
			$tabla .= "<table border=1>
				<tr>
					<td $tit width=35>Objetivo</td>
					<td $tit width=27>".html_entity_decode("Fecha de creaci&oacute;n")."</td>
					<td $tit width=9>".html_entity_decode("A&ntilde;o")."</td>
					<td $tit width=186>".html_entity_decode("Descripci&oacute;n")."</td>
					<td $tit width=17>Plazo</td>
					<td $tit width=16>Cumplido</td>
				</tr>";
				$tabla .= "<tr>
					<td $contenido>".$valor['objetivo']."</td>
					<td $contenido>".$valor['fechacreacion']."</td>
					<td $contenido>".$valor['anno']."</td>	
					<td $contenido>".$valor['descripcion']."</td>
					<td $contenido>".$valor['plazoconsecucion']."</td>
					<td $contenido>".siono($valor['cumplido'])."</td>	
				</tr>";
			$tabla .= "</table>";
			
			$p->htmltable($tabla);
			$p->SetMargins(10,43,0);
			$p->ln(5);
			
			if($_POST['seg_obj']){
				$seg_obj = select_normal("Select * from kz_tec_dir_seguimientoobjetivos where objetivo like '".$valor['id']."' order by fecha");
				if($seg_obj){
					$color1 = '5F5F5F';
					$color2 = 'FFFFFF';
					$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=4";
					
					$tabla2 = "<table border=1>";
						$tabla2.="<tr>
							<td $tit width=55>SEGUIMIENTOS DEL OBJETIVO</td>
						</tr>
					</table>";
					
					$p->htmltable($tabla2);
					
					$color1 = 'A6A6A6';
					$color2 = 'FFFFFF';
					$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
					$contenido = "align=center height=5 valign=middle";
					$contenido_rojo = "bgcolor=#FF0000 align=center height=5 valign=middle";
					$contenido_ambar = "bgcolor=#F0640F align=center height=5 valign=middle";
					$contenido_verde = "bgcolor=#26C63F align=center height=5 valign=middle";
					
					$tabla3 = "<table border=1>
						<tr>	
							<td $tit width=17>Fecha</td>
							<td $tit width=73>Datos</td>
							<td $tit width=108>Observaciones</td>
							<td $tit width=56>Responsable</td>
							<td $tit width=29>".html_entity_decode("Grado consecuci&oacute;n")."</td>
						</tr>";
				
						foreach($seg_obj as $keysegobj => $valorsegobj){
							$tabla3 .= "<tr>
								<td $contenido>".$valorsegobj['fecha']."</td>
								<td $contenido>".$valorsegobj['datos']."</td>
								<td $contenido>".$valorsegobj['observaciones']."</td>	
								<td $contenido>".$valorsegobj['responsable']."</td>";
								if($valorsegobj['grado_consecucion'] <= '33'){
									$tabla3.="<td $contenido_rojo>".$valorsegobj['grado_consecucion']."%</td>";
								}
								elseif(($valorsegobj['grado_consecucion'] >= '34')&&($valorsegobj['grado_consecucion'] <= '66')){
									$tabla3.="<td $contenido_ambar>".$valorsegobj['grado_consecucion']."%</td>";
								}
								elseif(($valorsegobj['grado_consecucion'] >= '67')&&($valorsegobj['grado_consecucion'] <= '100')){
									$tabla3.="<td $contenido_verde>".$valorsegobj['grado_consecucion']."%</td>";
								}	
							$tabla3.="</tr>";
						}
					$tabla3.= "</table>";
					
					$p->htmltable($tabla3);
				}
			}
			$p->SetMargins(3,10,0);
		}	
		$p->output();
	}
}
else{
	echo "<script>alert('No se puede mostrar el informe. No hay objetivos.');</script>";
	echo "<script>window.close();</script>";
}?>
