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
$titulo = "Informe de personal";

$personas = select_normal("Select * from kz_tec_rrhh_personal order by apellidos");

if($personas){
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
		
		$tabla .= "<table border=1>
			<tr>
				<td $tit width=50>Nombre</td>
				<td $tit width=60>Apellido</td>
				<td $tit width=22>".html_entity_decode("Tel&eacute;fono")."</td>
				<td $tit width=22>".html_entity_decode("M&oacute;vil")."</td>
				<td $tit width=50>Email</td>
			</tr>";
		
		foreach($personas as $key => $valor){
			$tabla .= "<tr>
				<td $datos>".$valor['nombre']."</td>
				<td $datos>".$valor['apellidos']."</td>
				<td $datos>".$valor['telefono']."</td>	
				<td $datos>".$valor['movil']."</td>
				<td $datos>".$valor['email']."</td>	
			</tr>";
		}
		$tabla.= "</table>";
		$p->htmltable($tabla);
		
		$p->output();
	}
}
else{
	echo "<script>alert('No se puede mostrar el informe. No hay personal.');</script>";
	echo "<script>window.close();</script>";
}?>
