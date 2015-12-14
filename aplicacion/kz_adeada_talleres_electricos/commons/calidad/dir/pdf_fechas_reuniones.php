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
$titulo = "Informe de reuniones entre fechas";

if($_POST['fecha1']!= ''){
	$filtros .= " and fecha >= '".$_POST['fecha1']."'";
	$l_filtros .= "<tr><td>Fecha inicio: ".$_POST['fecha1']."</td></tr>";
}

if($_POST['fecha2']!= ''){
	$filtros .= " and fecha <= '".$_POST['fecha2']."'";
	$l_filtros .= "<tr><td>Fecha fin: ".$_POST['fecha2']."</td></tr>";
}

$reuniones = select_normal("SELECT * FROM kz_tec_dir_reuniones where 1 = 1 $filtros order by fecha desc");

if($reuniones){
	if($_POST['pdf']){
		
		require(FPDF_PDF_RUTA.'lib/pdftable.inc.php');
		
		$p = new PDFTable('P');
		$p->SetMargins(3,43,0);
		$p->AddPage('P');
		$p->SetMargins(3,10,0);
		$p->titulo(5,$titulo);
		$p->setfont('Arial','',8);
		$p->SetTitle(date("d-m-Y")."_informe");
		$p->SetFillColor(255,255,255);
		$p->SetTextColor(0,0,0);
		$p->SetDrawColor(0,0,0);
		
		$p->Cell(0,3,"Fecha inicio: ".$_POST['fecha1'],0,1);
		$p->Cell(0,3,"Fecha fin: ".$_POST['fecha2'],0,1);
			
		foreach($reuniones as $key => $valor){
			//CASO DE AGRUPAR POR
			if($valor['fecha']!= $tipo_accion_ul){
				$tabla .= "</table>";
				$p->HTMLtable($tabla);
				$p->ln(5);
				
				$color1 = '5F5F5F';
				$color2 = 'FFFFFF';
				$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=4";
				
				$tabla = "<table>
					<tr>
						<td $tit width=204>".$valor['fecha']."</td>
					</tr>
				</table>";
				
				$p->htmltable($tabla);
				
				$color1 = 'A6A6A6';
				$color2 = 'FFFFFF';
				$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
				$contenido = "align=center height=5 valign=middle";
			
				$tabla = "<table border=1>
					<tr>
						<td $tit width=17>Fecha</td>
						<td $tit width=56>Asistentes</td>
						<td $tit width=86>Objeto</td>
						<td $tit width=45>Departamento</td>
					</tr>";
			}
			$tabla .= "<tr>
				<td $contenido>".$valor['fecha']."</td>
				<td $contenido>".$valor['asistentes']."</td>
				<td $contenido>".$valor['objeto']."</td>
				<td $contenido>".$valor['departamento']."</td>
			</tr>
			</table>";
			$tipo_accion_ul = $valor['fecha'];	
		}	
	
	$p->HTMLtable($tabla);
	
	$p->output();
	}
}
else{
	echo "<script>alert('No se puede mostrar el informe. No hay reuniones.');</script>";
	echo "<script>window.close();</script>";
}?>
