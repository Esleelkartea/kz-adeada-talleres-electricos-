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
require('../functions/mant_functions.php');
$titulo = "Informe de plan de mantenimiento";

if($_POST['equipo'] != ''){
	$filtroequipo = " where id = ".$_POST['equipo']."";
}
else{
	echo "<script>alert('No se puede mostrar el informe. No hay equipos.');</script>";
	echo "<script>window.close();</script>";
}
$equipos = select_normal("Select * from kz_tec_mant_equipos $filtroequipo order by numero"); 

if($_POST['pdf']){
	
	require(FPDF_PDF_RUTA.'lib/pdftable.inc.php');
	
	$p = new PDFTable('L');
	$p->SetMargins(3,43,0);
	$p->AddPage('L');
	$p->SetMargins(3,10,0);
	$p->titulo(5,$titulo);
	$p->setfont('Arial','',8);
	$p->SetTitle(date("d-m-Y")."_informe");
	$p->SetFillColor(255,255,255);
	$p->SetTextColor(0,0,0);
	$p->SetDrawColor(0,0,0);	
	
	$equipo = select_normal("Select * from kz_tec_mant_equipos where id = ".$_POST['equipo']."");
	$equipo = $equipo[0];
	
	$p->Cell(0,3,"".html_entity_decode("A&ntilde;o mant.").": ".$_POST['anno'],0,1);
	$p->Cell(0,3,"Equipo: ".$equipo['numero']." || ".$equipo['ref']." || ".$equipo['fab']." || ".$equipo['modelo'],0,1);
	$p->Ln(5);
	$p->HTMLtable($tabla);

	$pautas = select_normal("Select * from kz_tec_mant_pautas where equipo= '".$_POST['equipo']."'");
	
	if($pautas){
		foreach($pautas as $key => $valor){
			$fechainicio = explode('-',$valor['fechainicio']);
			$fechafin = explode('-',$valor['fechafin']);
			$Y = $fechainicio[0];
			$incremento  = 0;
			
			foreach($valor as $key3 => $valor3){
				$pautas2[$key][$key3] = $valor3;
			}
			
			$arraypauta[$key][count($arraypauta[$key])] = $valor['fechainicio'];
			$fechasiguiente = date("Y-m-d",mktime(0,0,0,$fechainicio[1],($fechainicio[2]) ,$fechainicio[0]));
			while($Y < ($_POST['anno'] + 1)){
				$fechasiguiente = date("Y-m-d",mktime(0,0,0,$fechainicio[1],($fechainicio[2] + $incremento) ,$fechainicio[0]));
				$Y = date("Y", mktime(0,0,0,$fechainicio[1],($fechainicio[2] + $incremento) ,$fechainicio[0]));
				$incremento = $incremento + $valor['periodicidad'];
				$fechasig = explode('-',$fechasiguiente);
				if(mktime(0,0,0,$fechasig[1],$fechasig[2] ,$fechasig[0]) < mktime(0,0,0,$fechafin[1],$fechafin[2] ,$fechafin[0])){
					$arraypauta[$key][$fechasiguiente] = $fechasiguiente;
				}
				else $Y++;
			}
		}
		
		foreach($equipos as $key => $valor){
			$color1 = 'A6A6A6';
			$color2 = 'FFFFFF';
			$color3 = 'CECECE';
			$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
			$tit2 = "bgcolor=#$color3 color=#$color2 align=center valign=middle style=bold height=8";
			$nor = "align=center height=5 valign=middle";
			
			$tabla = "<table border=1>";
				$anno = $_POST['anno'];
				
				$tabla.= "<tr>
					<td bgcolor=#$color1 color=#$color2 width=11 align=center>MES</td>";
					for($i = 1; $i <= 31; $i++){
						$tabla .= "<td bgcolor=#$color3 color=#$color2 align=center width=9>$i</td>";
					}
				$tabla .= "</tr>";
				
				for($m = 1; $m <= 12; $m++){
					$tabla .= "<tr><td bgcolor=#$color3 color=#$color2 align=center>".$arraymeses[$m]."</td>";
				
					for($i = 1; $i <= 31; $i++){
						$color = "";
						$bgcolor = "";
						
						foreach($arraypauta as $key => $valor){
							$dia = str_pad((int) $i,2,"0",STR_PAD_LEFT);
							$mes = str_pad((int) $m,2,"0",STR_PAD_LEFT);
								if(in_array($_POST['anno']."-".$mes."-".$dia,$valor)){
									$Tdate = getdate(mktime(0,0,0,$mes, $dia, $_POST['anno']));
			   						$wday = $Tdate["wday"]; 
		   							if(($wday == 6) || ($wday == 0)){
		   							 	//$bgcolor = " bgcolor=#ff6565 style=bold align=center";
		   							 	if($wday == 0){
		   							 		$arraypauta[$key][date("Y-m-d",mktime(0,0,0,$mes, $dia, $_POST['anno']))] = date("Y-m-d",mktime(0,0,0,$mes, ($dia + 1), $_POST['anno']));
		   							 	}
		   							 	else { 
		   							 		if($_POST['sabados_incluidos']){
		   							 			$color .= "-".($key+1);
		   							 		}
		   							 		else {
		   							 		$arraypauta[$key][date("Y-m-d",mktime(0,0,0,$mes, $dia, $_POST['anno']))] = date("Y-m-d",mktime(0,0,0,$mes, ($dia - 1), $_POST['anno']));
		   							 		$color .= "-".($key+1);
		   							 		}
		   							 	}
		   							}
									else{
										$color .= "-".($key+1);
									}
									//$bgcolor = " bgcolor = #e2ffe3 style=bold align=center";
								}
						}
						$tabla .= "<td $bgcolor>".substr($color,1,strlen($color))."</td>";
					}
				$tabla .= "</tr>";
				}
			$tabla .= "</table>";
			$p->htmltable($tabla);
			$p->Ln(5);
			
			$tabla = "<table border=1>";
			$tabla .= "<tr>
				<td width=20 $tit>".html_entity_decode("N&uacute;mero")."</td>
				<td width=90 $tit>".html_entity_decode("Descripci&oacute;n")."</td>
				<td width=20 $tit>Fecha inicio</td>
				<td width=20 $tit>Fecha fin</td>
				<td width=62 $tit>Responsable</td>
			</tr>";
			
			foreach($pautas2 as $key => $valor){
				$tabla .= "<tr>
					<td $nor>".($key + 1)."</td>
					<td $nor>".$valor['descripcion']."</td>
					<td $nor>".$valor['fechainicio']."</td>
					<td $nor>".$valor['fechafin']."</td>
					<td $nor>".$valor['responsable']."</td>
				</tr>";
			}
			$tabla .= "</table>";
				
			$p->HTMLtable($tabla);
		}
	}
	$p->output();
}?>
