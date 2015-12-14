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
$titulo = "Informe de equipos";

$equipos = select_normal("Select * from kz_tec_mant_equipos order by numero");

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
	
	$color1 = 'A6A6A6';
	$color2 = 'FFFFFF';
	$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
	$datos = "align=center height=5 valign=middle";
	
	if($equipos){
		$tabla .= "<table border=1>
			<tr>
				<td $tit width=34>".html_entity_decode("N&uacute;mero")."</td>
				<td $tit width=34>Ref.</td>
				<td $tit width=34>Fabricante</td>
				<td $tit width=34>Modelo</td>
				<td $tit width=34>Tipo</td>
				<td $tit width=34>Referencia</td>
			</tr>";
			foreach($equipos as $key => $valor){
				$tabla .= "<tr>
					<td $datos>".$valor['numero']."</td>
					<td $datos>".$valor['ref']."</td>
					<td $datos>".$valor['fab']."</td>	
					<td $datos>".$valor['modelo']."</td>
					<td $datos>".$valor['tipo']."</td>	
					<td $datos>".$valor['referencia']."</td>
				</tr>";
			}
		$tabla.= "</table>";
	}
	else{
		echo "<script>alert('No se puede mostrar el informe. No hay equipos.');</script>";
		echo "<script>window.close();</script>";
	}
	$p->htmltable($tabla);
	
	$p->output();
}?>
