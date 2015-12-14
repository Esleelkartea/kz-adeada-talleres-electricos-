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
$titulo = "Informe de encuesta";

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
	
	$cuestionario = select_normal("Select * from kz_tec_mej_encuesta where id = ".$_POST['encuesta']."");
	$cuestionario = $cuestionario[0];
	
	$color1 = 'A6A6A6';
	$color2 = 'FFFFFF';
	$color3 = 'CECECE';
	$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
	$tit2 = "bgcolor=#$color3 color=#$color2 align=center valign=middle style=bold height=8";
	$nor = "align=center height=5 valign=middle";

	$tabla .= "<table border=1>
		<tr>
			<td $tit width=50>Cliente / Bezeroa: </td>
			<td $nor width=52>".$cuestionario['organizacion']."</td>
			<td $tit width=50>Comercial / Komertziala: </td>
			<td $nor width=52>".$cuestionario['comercial']."</td>
		</tr>
		<tr>
			<td $tit>Nombre / Izena: </td>
			<td $nor>".$cuestionario['nombre']."</td>
			<td $tit>Apellido / Abizena: </td>
			<td $nor>".$cuestionario['apellidos']."</td>
		</tr>
		<tr>
			<td $tit>Fecha encuesta / Inkesta data: </td>
			<td $nor>".$cuestionario['fechaencuesta']."</td>
			<td $tit>Fecha respuesta / Erantzute data: </td>
			<td $nor>".$cuestionario['fecharespuesta']."</td>
		</tr>
	</table>";
	
	$p->HTMLtable($tabla);
	$p->Ln(5);
		
	$aspectos = select_normal("Select kz_tec_mej_campos.id, kz_tec_mej_campos.descripcion, kz_tec_mej_valoraciones.campo from kz_tec_mej_campos, kz_tec_mej_valoraciones WHERE kz_tec_mej_campos.id = kz_tec_mej_valoraciones.campo AND kz_tec_mej_valoraciones.idencuesta='".$cuestionario['id']."'");
	
	$tabla = "<table border=1>
		<tr>
			<td $tit width=70>Aspecto a valorar / Baloratu beharrekoa</td>
			<td $tit width=34>".html_entity_decode("Valoraci&oacute;n")." / Balorazioa</td>
			<td $tit width=60>".html_entity_decode("Valoraci&oacute;n")." frente a la comp. / Balorazioa konpetentziarekiko</td>
			<td $tit width=40>Importancia / Garrantzia</td>
		</tr>";
		if($aspectos){
			foreach($aspectos as $key => $valor){
				$valoraciones = select_normal("Select * from kz_tec_mej_valoraciones where idencuesta='".$cuestionario['id']."' and campo = '".$valor['id']."'");
				$valoraciones = $valoraciones[0];
				$tabla .= "<tr>
				<td $nor align=left>".$valor['descripcion']."</td>
				<td $nor>".$valoraciones['valoracion']."</td>
				<td $nor>".$valoraciones['valcompetencia']."</td>
				<td $nor>".siono($valoraciones['aspectoimportante'])."</td>
				</tr>";
			}
		}
	$tabla .= "</table>";
	
	$p->HTMLtable($tabla);
	$p->ln(5);
		
	$motivos = select_normal("Select * from kz_tec_mej_motivosencuesta where idencuesta = '".$cuestionario['id']."'");
	$valormotivos = $motivos[0];
	
	$tabla = "<table border=1>
		<tr>
			<td $tit colspan=2>Motivos de compra</td>
		</tr>
		<tr>
			<td $tit2 width=25>Calidad</td>
			<td $nor width=40>".siono($valormotivos['calidad'])."</td>
		</tr>
		<tr>
			<td $tit2>Precio</td>
			<td $nor>".siono($valormotivos['precio'])."</td>
		</tr>
		<tr>
			<td $tit2>Confianza</td>
			<td $nor>".siono($valormotivos['confianza'])."</td>
		</tr>
		<tr>
			<td $tit2>".html_entity_decode("Atenci&oacute;n")."</td>
			<td $nor>".siono($valormotivos['atencion'])."</td>
		</tr>
		<tr>
			<td $tit2>Servicio</td>
			<td $nor>".siono($valormotivos['servicio'])."</td>
		</tr>
		<tr>
			<td $tit2>".html_entity_decode("Cercan&iacute;a")."</td>
			<td $nor>".siono($valormotivos['cercania'])."</td>
		</tr>			
		<tr>
			<td $tit2>Experiencia</td>
			<td $nor>".siono($valormotivos['experiencia'])."</td>
		</tr>
		<tr>
			<td $tit2>Otros</td>
			<td $nor>".$valormotivos['otros']."</td>
		</tr>
	</table>";
	
	$p->HTMLtable($tabla);
	$p->ln(5);
	
	$tabla = "<table border=1>
		<tr>
			<td $tit height=15 width=25>Sugerencias: </td>
			<td $nor width=179>".$cuestionario['sugerencias']."</td>
		</tr>
		<tr>
			<td $tit height=15>".html_entity_decode("An&aacute;lisis").": </td>
			<td $nor>".$cuestionario['analisis']."</td>
		</tr>
	</table>";
	
	$p->HTMLtable($tabla);
	$p->output();
}?>
