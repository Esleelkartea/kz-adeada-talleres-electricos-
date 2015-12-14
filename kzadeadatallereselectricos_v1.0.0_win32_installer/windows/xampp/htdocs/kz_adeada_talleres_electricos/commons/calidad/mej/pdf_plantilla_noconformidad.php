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
$titulo = "No Conformidad";

if($_POST['pdf']){
	
	require(FPDF_PDF_RUTA.'lib/pdftable.inc.php');
	
	$p = new PDFTable('P');
	$p->SetMargins(3,38,0);
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
	$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=7";
	$nor = "align=center height=5 valign=middle";
		
	$tabla = "<table border=1>
    	<tr>
    		<td $tit width=40>CNC:</td>
    		<td $nor width=80></td>
    	</tr>
    	<tr>
    		<td $tit>Origen del problema:</td>
    		<td $nor></td>
    	</tr>
    	<tr>
    		<td $tit>".html_entity_decode("Especificaci&oacute;n de origen").":</td>
    		<td $nor></td>
    	</tr>    	
    	<tr>
    		<td $tit>".html_entity_decode("Clasificaci&oacute;n de origen").":</td>
    		<td $nor></td>
    	</tr>
    	<tr>
    		<td $tit>Detectada por:</td>
    		<td $nor></td>
    	</tr>	
    	<tr>
    		<td $tit>".html_entity_decode("Fecha de detecci&oacute;n").":</td>
    		<td $nor></td>
    	</tr>
    	<tr>
    		<td $tit>Orden / Pedido:</td>
    		<td $nor></td>
    	</tr>
    </table>";
		
	$p->htmltable($tabla);
	$p->ln(5);
	    		
	$tabla = "<table border=1>
	    <tr>
	    	<td $tit width=70 height=40>".html_entity_decode("Descripci&oacute;n del problema &iquest;Qu&eacute; ha pasado?").":</td>
	    	<td $nor width=134></td>
	    </tr>
    	<tr>
    		<td $tit height=25>Causa estimada:</td>
    		<td $nor></td>
    	</tr>
    	<tr>
    		<td $tit height=19>".html_entity_decode("Soluci&oacute;n a tomar: &iquest;Qu&eacute; hago para solucionarlo?")."</td>
    		<td $nor></td>
    	</tr>    	
    	<tr>
    		<td $tit>".html_entity_decode("Responsable tratamiento: &iquest;Qui&eacute;n lo hace?")."</td>
    		<td $nor></td>
    	</tr>    	
    	<tr>
    		<td $tit>".html_entity_decode("&iquest;Cu&aacute;ndo tien que estar hecho?")."</td>
    		<td $nor></td>
    	</tr>
    	<tr>
    		<td $tit height=25>".html_entity_decode("Seguimiento realizado de la soluci&oacute;n adoptada").":</td>
    		<td $nor></td>
    	</tr>
		<tr>
			<td $tit>".html_entity_decode("Fecha cierre: &iquest;Cu&aacute;ndo se ha hecho?").":</td>
			<td $nor></td>
		</tr>  
		<tr>
			<td $tit>Cierre eficaz: </td>
			<td $nor></td>
		</tr>    	
    </table>";

	$p->htmltable($tabla);
	$p->ln(5);
	
	$tabla = "<table border=1 >
    	<tr>
    		<td $tit width=30>Coste ocasionado:</td>
    		<td $nor width=40></td>
    	</tr>
    	<tr>
    		<td $tit>Maquinaria</td>
    		<td $nor></td>
    	</tr>
    	<tr>
    		<td $tit>Mano de obra</td>
    		<td $nor></td>
    	</tr>    	
    	<tr>
    		<td $tit>Materia prima</td>
    		<td $nor></td>
    	</tr>    	
    	<tr>
    		<td $tit>Mediciones</td>
    		<td $nor></td>
    	</tr>
    	<tr>
    		<td $tit>".html_entity_decode("M&eacute;todos")."</td>
    		<td $nor></td>
    	</tr>
    </table>";

	$p->htmltable($tabla);	
	$p->output();
}?>
