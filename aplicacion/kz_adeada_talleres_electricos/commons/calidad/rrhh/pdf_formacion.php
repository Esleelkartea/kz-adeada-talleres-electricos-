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
$titulo = "".html_entity_decode("Informe de formaci&oacute;n")."";

if($_POST['anno']){
	$filtros .= " and ano = ".$_POST['anno']."";
}

if($_POST['fecha1']!= ''){
	$filtros .= " and fechacomienzo >= '".$_POST['fecha1']."'";
	$l_filtros .= "<tr><td>Fecha inicio: ".$_POST['fecha1']."</td></tr>";
}

if($_POST['fecha2']!= ''){
	$filtros .= " and fechacomienzo <= '".$_POST['fecha2']."'";
	$l_filtros .= "<tr><td>Fecha fin: ".$_POST['fecha2']."</td></tr>";
}

$cursos = select_normal("Select * from kz_tec_rrhh_accformativa where 1 = 1 $filtros order by fechacomienzo");

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
	
	$filtrostab = "<table>";
	$filtrostab .= $l_filtros;
	$filtrostab .= "</table>";
	
	$p->HTMLtable($filtrostab);
	$p->ln(5);
	
	$color1 = 'A6A6A6';
	$color2 = 'FFFFFF';
	$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
	$nor = "align=center height=5 valign=middle";

	if($cursos){
		$tabla = "<table width=260 border=1>
			<tr>
				<td $tit width=9>".html_entity_decode("A&ntilde;o")."</td>
				<td $tit width=16>Finalizado</td>
				<td $tit width=60>Accion formativa</td>
				<td $tit width=22>Fecha prevista</td>
				<td $tit width=24>Fecha comienzo</td>
				<td $tit width=17>Fecha final</td>
				<td $tit width=50>Impartido por</td>
				<td $tit width=42>Proceso relacionado</td>
				<td $tit width=50>Responsable seguimiento</td>
			</tr>";
		
			foreach($cursos as $key => $valor){		
				$tabla .= "<tr>
					<td $nor>".$valor['ano']."</td>
					<td $nor>".$valor['accionfinalizada']."</td>
					<td $nor>".$valor['accionformativa']."</td>	
					<td $nor>".$valor['fechaprevista']."</td>
					<td $nor>".$valor['fechacomienzo']."</td>	
					<td $nor>".$valor['fechafinal']."</td>
					<td $nor>".$valor['impartidopor']."</td>
					<td $nor>".$valor['procesorelacionado']."</td>
					<td $nor>".$valor['responsableseguimiento']."</td>	
				</tr>";
		}
		$tabla.= "</table>";
	}
	else{
		echo "<script>alert('No se puede mostrar el informe. No hay cursos.');</script>";
		echo "<script>window.close();</script>";
	}
	
	$p->htmltable($tabla);
	$p->output();
}?>
