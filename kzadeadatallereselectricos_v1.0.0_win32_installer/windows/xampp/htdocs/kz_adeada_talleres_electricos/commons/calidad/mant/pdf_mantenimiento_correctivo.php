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
$titulo = "Informe de mant. correctivo";

if($_POST['equipo']!= ''){
	$filtroequipo .= " and id = ".$_POST['equipo']." ";
}

if($_POST['fecha1']!= ''){
	$filtrosmant .= " and fecha_mant >= '".$_POST['fecha1']."'";
	$l_filtros .= "<tr><td>Fecha inicio: ".$_POST['fecha1']."</td></tr>";
}

if($_POST['fecha2']!= ''){
	$filtrosmant .= " and fecha_mant <= '".$_POST['fecha2']."'";
	$l_filtros .= "<tr><td>Fecha fin: ".$_POST['fecha2']."</td></tr>";
}

$equipos = select_normal("Select * from kz_tec_mant_equipos where 1 = 1 $filtroequipo order by numero");

if($equipos){
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
		
		$p->ln(5);
		
		if($equipos)
			foreach($equipos as $key => $valor){
				$mant = select_normal("Select * from kz_tec_mant_correctivo where equipo = ".$valor['id']." $filtrosmant order by fecha_mant desc");
				if($mant){
					$color1 = 'A6A6A6';
					$color2 = 'FFFFFF';
					$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
					$nor = "align=center height=5 valign=middle";
					
					$tabla = "<table border=1>
						<tr>
							<td $tit width=34>".html_entity_decode("N&uacute;mero equipo")."</td>
							<td $tit width=34>Ref.</td>
							<td $tit width=34>Fabricante</td>
							<td $tit width=34>Modelo</td>
							<td $tit width=34>Tipo</td>
							<td $tit width=34>Referencia</td>
						</tr>";
						
						$tabla .= "<tr>
							<td $nor>".$valor['numero']."</td>
							<td $nor>".$valor['ref']."</td>
							<td $nor>".$valor['fab']."</td>	
							<td $nor>".$valor['modelo']."</td>
							<td $nor>".$valor['tipo']."</td>	
							<td $nor>".$valor['referencia']."</td>
						</tr>";
					$tabla.= "</table>";
					$p->SetMargins(10,43,0);
					$p->htmltable($tabla);
					$p->ln(5);
		
					if($mant){
						$color1 = 'CECECE';
						$color2 = 'FFFFFF';
						$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
						$nor = "align=center height=5 valign=middle";
						
						$tabla = "<table border=1 margin-left=50>";
							$tabla .= "<tr>
								<td $tit width=68>Materiales</td>
								<td $tit width=17>Euros</td>
								<td $tit width=17>Fecha</td>
								<td $tit width=78>Observaciones</td>
								<td $tit width=17>Horas</td>
							</tr>";
						if($mant)
							foreach($mant as $key2 => $valor2){
								$tabla .= "<tr>
									<td $nor>".$valor2['materiales']."</td>
									<td $nor>".$valor2['euros']."</td>
									<td $nor>".$valor2['fecha_mant']."</td>
									<td $nor>".$valor2['observaciones']."</td>
									<td $nor>".$valor2['horas']."</td>
								</tr>";
								
								$sumahoras[$valor['id']] = $sumahoras[$valor['id']] + $valor2['horas'];
								$sumaeuros[$valor['id']] = $sumaeuros[$valor['id']] + $valor2['euros'];
							}
						
						$p->htmltable($tabla);
						$p->Ln(2);
						
						$p->Cell(80,5,"Euros: ".$sumaeuros[$valor['id']]." euros",0,1);
						$p->Cell(80,5,"Horas: ".$sumahoras[$valor['id']]." horas",0,1);
						$p->SetMargins(3,10,0);
						$p->ln(10);
					}
					
					
				}
		
			}
			if($sumaeuros && $sumahoras){
				$color1 = 'A6A6A6';
				$color2 = 'FFFFFF';
				$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8 width=204";
				
				$tabla = "<table border=1>";
					$tabla .= "<tr>
						<td $tit>TOTAL EUROS: ".array_sum($sumaeuros)." euros</td>
					</tr>";
					$tabla .= "<tr>
						<td $tit>TOTAL HORAS: ".array_sum($sumahoras)." horas</td>
					</tr>";
				$tabla.= "</table>";
				
				$p->htmltable($tabla);
			}
		$p->output();
	}
}
else{
	echo "<script>alert('No se puede mostrar el informe. No hay equipos.');</script>";
	echo "<script>window.close();</script>";
}?>
