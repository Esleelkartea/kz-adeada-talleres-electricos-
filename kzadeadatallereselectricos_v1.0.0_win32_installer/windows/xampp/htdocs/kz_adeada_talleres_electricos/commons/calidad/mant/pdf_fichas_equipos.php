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
$titulo = "Informe de fichas de equipos";

if($_POST['equipo'] != ''){
	$filtroequipo = " where id = ".$_POST['equipo']."";
}
$equipos = select_normal("Select * from kz_tec_mant_equipos  $filtroequipo order by numero");

if($_POST['pdf']){
	
	require(FPDF_PDF_RUTA.'lib/pdftable.inc.php');

	$p = new PDFTable('P');
	$p->SetMargins(3,43,0);
	
	if($equipos){
		foreach($equipos as $key => $valor){
			$p->AddPage('P');
			$p->SetMargins(3,10,0);
			$p->titulo(5,$titulo);	
			$p->setfont('Arial','',8);
			
			$color1 = 'A6A6A6';
			$color2 = 'FFFFFF';
			$tit = "bgcolor=#$color1 color=#$color2 border=1 width=30%";
			$nor = "width=50%";

			$tabla = "<table>
				<tr>
					<td $tit>".html_entity_decode("N&deg; equipo")."</td>
					<td $nor>".$valor['numero']."</td>
					<td $tit>".html_entity_decode("Categor&iacute;a")."</td>
					<td $nor>".$valor['categoria']."</td>
				</tr>
				<tr>
					<td $tit>".html_entity_decode("A&ntilde;o fab").".</td>
					<td $nor>".$valor['anofab']."</td>
					<td $tit>Estado del equipo</td>
					<td $nor>".$valor['estado']."</td>
				</tr>
				<tr>
					<td $tit>Ref.</td>
					<td $nor>".$valor['ref']."</td>
					<td $tit>".html_entity_decode("Ubicaci&oacute;n")."</td>
					<td $nor>".$valor['ubicacion']."</td>
				</tr>
				<tr>
					<td $tit>Fabricante</td>
					<td $nor>".$valor['fab']."</td>
					<td $tit>Fecha adq.</td>
					<td $nor>".$valor['fechaadq']."</td>
				</tr>
				<tr>
					<td $tit>Modelo</td>
					<td $nor>".$valor['modelo']."</td>
					<td $tit>Precio adq.</td>
					<td $nor>".$valor['precio']." euros</td>
				</tr>
				<tr>
					<td $tit>Tipo</td>
					<td $nor>".$valor['tipo']."</td>
					<td $tit>S/N</td>
					<td $nor>".$valor['sn']."</td>
				</tr>
				<tr>
					<td $tit>Referencia</td>
					<td $nor>".$valor['referencia']."</td>
					<td $tit>Fecha retirada</td>
					<td $nor>".$valor['fecharetirada']."</td>
				</tr>
				<tr>
					<td $tit>Elemento</td>
					<td $nor>".$valor['elemento']."</td>
					<td $tit>".html_entity_decode("Funci&oacute;n")."</td>
					<td $nor>".$valor['funcion']."</td>
				</tr>
				<tr>
					<td $tit>".html_entity_decode("Descripci&oacute;n")."</td>
					<td $nor>".$valor['descripcion']."</td>
					<td $tit>CEE</td>
					<td $nor>".$valor['cee']."</td>
				</tr>
			</table>";
			
			$p->htmltable($tabla);
			$p->ln(10);
			
			$pautas = select_normal("Select * from kz_tec_mant_correctivo where equipo = ".$valor['id']."");
			
			$color1 = 'A6A6A6';
			$color2 = 'FFFFFF';
			$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
			$nor = "align=center height=5 valign=middle";
			
			$tabla = "<table border=1>
				<tr>
					<td border=0 colspan=5 style=bold>Mantenimiento correctivo</td>
				</tr>
				<tr>
					<td $tit width=17>Fecha</td>
					<td $tit width=11>Euros</td>
					<td $tit width=85>Observaciones</td>
					<td $tit width=80>Materiales</td>
					<td $tit width=11>Horas</td>
				</tr>";
			
				$sumaeuros = 0;
				$sumahoras = 0;
				if(!$pautas){
					$tabla.= "<tr><td colspan=5>No hay registros de mantenimiento correctivo</td></tr>";
				}
				else 
				foreach($pautas as $keypau => $valorpau){
					$tabla .="<tr>
						<td $nor>".$valorpau['fecha_mant']."</td>
						<td $nor>".$valorpau['euros']."</td>
						<td $nor>".$valorpau['observaciones']."</td>
						<td $nor>".$valorpau['materiales']."</td>
						<td $nor>".$valorpau['horas']."</td>
					</tr>";
					$sumahoras = $sumahoras + $valorpau['horas'];
					$sumaeuros = $sumaeuros + $valorpau['euros'];
				}
			$tabla .= "</table>";
			
			$p->htmltable($tabla);
			$p->Ln(2);
			$p->Cell(80,5,"TOTAL EUROS: ".$sumaeuros." euros",0,1);
			$p->Cell(80,5,"TOTAL HORAS: ".$sumahoras." horas",0,1);
			
			$p->Ln(10);
			
			$pautas = select_normal("Select * from kz_tec_mant_pautas where equipo = ".$valor['id']."");
			
			$color1 = 'A6A6A6';
			$color2 = 'FFFFFF';
			$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
			$nor = "align=center height=5 valign=middle";
			
			$tabla = "<table border=1>
				<tr>
					<td colspan=3 style=bold border=0>Mantenimiento preventivo</td>
				</tr>
				<tr>
					<td $tit width=93>Descripcion</td>
					<td $tit width=15>Periodo</td>
					<td $tit width=17>Inicio</td>
					<td $tit width=17>Fin</td>
					<td $tit width=62>Responsable</td>
				</tr>";
				
				$sumaeuros = 0;
				$sumahoras = 0;
				if(!$pautas){
					$tabla.= "<tr><td colspan=5>No hay registros de mantenimiento preventivo</td></tr>";
				}
				else
				foreach($pautas as $keypau => $valorpau){
					$tabla .="<tr>
						<td $nor>".$valorpau['descripcion']."</td>
						<td $nor>".$valorpau['periodicidad']." ".html_entity_decode("d&iacute;as")."</td>
						<td $nor>".$valorpau['fechainicio']."</td>
						<td $nor>".$valorpau['fechafin']."</td>
						<td $nor>".$valorpau['responsable']."</td>
					</tr>";
				}
			$tabla .= "</table>";
			
			$p->htmltable($tabla);
		}
	}
	else{
		echo "<script>alert('No se puede mostrar el informe. No hay equipos.');</script>";
		echo "<script>window.close();</script>";
	}
	$p->output();
}?>
