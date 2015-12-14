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
$titulo = "".html_entity_decode("Informe de satisfacci&oacute;n")."";

function color_valor_1($valor){
	if($valor < 5) return "#FF3838";
	if(($valor >= 5) && ($valor <= 7)) return "#F9FF40";
	if(($valor >7 )) return "#73CB4D";
}

function aspectoimportante($valor){
	if($valor == 1) return('#73C3FF'); else return('#ffffff');
}

function check_motivo($valor){
	if($valor == 1) return("X");
	else return("");
}

if($_POST['pdf']){
	if($_POST['cliente']!= ''){
		$filtros .= " and organizacion = '".$_POST['cliente']."'";
	}
	if($_POST['fecha1']!= ''){
		$filtros .= " and fechaencuesta >= '".$_POST['fecha1']."'";
	}
	if($_POST['fecha2']!= ''){
		$filtros .= " and fechaencuesta <= '".$_POST['fecha2']."'";
	}
		
	
	require(FPDF_PDF_RUTA.'lib/pdftable.inc.php');
	
	$p = new PDFTable('L');
	$p->SetMargins(3,43,0);
	$p->AddPage('L');
	$p->SetMargins(3,10,0);
	$p->titulo(5,$titulo);
	$p->setfont('Arial','',8);
	$p->SetTitle(date("d-m-Y")."_revision_direccion");
	$p->SetFillColor(255,255,255);
	$p->SetTextColor(0,0,0);
	$p->SetDrawColor(0,0,0);
	
	if($_POST['cliente']!= ''){
		$p->Cell(0,3,"Cliente: ".$_POST['cliente'],0,1);
	}
	else{
		$p->Cell(0,3,"Cliente: TODOS",0,1);
	}
	$p->Cell(0,3,"Fecha inicio: ".$_POST['fecha1'],0,1);
	$p->Cell(0,3,"Fecha fin: ".$_POST['fecha2'],0,1);
	$p->ln(5);
	
	$p->Cell(40,5,"Tabla de valoraciones",0,1);
	
	$color1 = 'A6A6A6';
	$color2 = 'FFFFFF';
	$color3 = 'CECECE';
	$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
	$tit2 = "bgcolor=#$color3 color=#$color2 align=center valign=middle style=bold height=8";
	$nor = "align=center height=5 valign=middle";
	
	$clientes_entre_fechas = select_normal("Select * from kz_tec_mej_encuesta where 1 = 1 $filtros order by fechaencuesta");

	foreach($clientes_entre_fechas as $key => $valor_clientes){
		if($_POST['cliente']){
			$campos = select_normal("Select kz_tec_mej_campos.id, kz_tec_mej_campos.descripcion, kz_tec_mej_valoraciones.campo from kz_tec_mej_campos, kz_tec_mej_valoraciones WHERE kz_tec_mej_campos.id = kz_tec_mej_valoraciones.campo and kz_tec_mej_valoraciones.idencuesta='".$valor_clientes['id']."'");
		}
		else{
			$campos = select_normal("Select distinct(kz_tec_mej_campos.id), kz_tec_mej_campos.descripcion, kz_tec_mej_valoraciones.campo from kz_tec_mej_campos, kz_tec_mej_valoraciones WHERE kz_tec_mej_campos.id = kz_tec_mej_valoraciones.campo");
		}
	}
	
	if($clientes_entre_fechas){
		$tabla = "<table border=1>";
			//CABECERAS
			$tabla .= "<tr>
				<td $tit width=20>Organiz.</td>";
				if($campos)
				foreach($campos as $keycamp => $valorcamp){					
					$tabla .= "<td $tit2 width=8>".$valorcamp['id']."</td>";
				}	
				$tabla .= "<td $tit >Sumatorio</td>
				<td $tit>Media</td>";
			$tabla .= "</tr>";
			$indice3=0;
			foreach($clientes_entre_fechas as $key => $valor){
				$tabla .= "<tr>
					<td $tit2>".$valor['organizacion']."</td>";
					$suma = 0;
					$indice=0;
					$indice2=0;
					if($campos){
						foreach($campos as $keycamp => $valorcamp){
							$valoraciones = select_normal("Select * from kz_tec_mej_valoraciones where idencuesta = ".$valor['id']." and campo = ".$valorcamp['id']."");
							$valoraciones = $valoraciones[0];
							
							if(''==$valoraciones['valoracion']){
								$no_contar_valoraciones[$indice2]++;
							}	
							$indice2++;
							
							if(($valoraciones['valoracion'] == '') || ($valoraciones['valoracion'] == 'no contesta')){
								$indice++;
								$tabla .= "<td align=center valign=middle bgcolor = ".aspectoimportante($valoraciones['aspectoimportante'])."></td>";
							}
							else{
								$tabla .= "<td align=center valign=middle bgcolor = ".aspectoimportante($valoraciones['aspectoimportante']).">".$valoraciones['valoracion']."</td>";
							}
							
							$suma = $valoraciones['valoracion'] + $suma;
							$sum[$valorcamp['id']] = $sum[$valorcamp['id']] + $valoraciones['valoracion'];
						}
						$tabla .= "<td align=center valign=middle>".$suma."</td>";
						
						if($suma == '0'){
							$indice3++;
						}
						
						$sumadesumas = $sumadesumas + $suma;
						$entre_cuantos = (count($campos) - $indice);
						if($entre_cuantos == '0'){
							$media = 0;
						}
						else{
							$media = $suma / $entre_cuantos;
						}
						$mediademedias = $mediademedias + $media;
						$tabla .= "<td align=center valign=middle bgcolor=".color_valor_1($media).">".round($media,2)."</td>";
					}
				$tabla .= "</tr>";
			}
	
			//FILA DE SUMAS
			$tabla .= "<tr>
				<td $tit>Sumas</td>";
				if($sum)
				foreach($sum as $key => $valor){
					$tabla .= "<td align=center valign=middle>".$valor."</td>";
				}
				$tabla .= "<td align=center valign=middle>".$sumadesumas."</td>";
				$mediademedias = $mediademedias;
				$tabla .= "<td align=center valign=middle>".round($mediademedias,2)."</td>";	
			$tabla .= "</tr>";
	
			//FILA DE MEDIAS
			$tabla .= "<tr>
				<td $tit>Medias</td>";		
				$indice2 = 0;
				if($sum)
				foreach($sum as $key => $valor){
					$entre_cuantos2 = count($clientes_entre_fechas) - $no_contar_valoraciones[$indice2];
					if($entre_cuantos2 == '0'){
						$media = 0;
					}
					else{
						$media = $valor / $entre_cuantos2;
					}
					$tabla .= "<td align=center valign=middle bgcolor=".color_valor_1($media).">".round($media,2)."</td>";
					$indice2++;
				}

				$entre_cuantos4 = count($clientes_entre_fechas) - $indice3;
				if($entre_cuantos4 == '0'){
					$mediadesumas = 0;
				}
				else{
					$mediadesumas = $sumadesumas / $entre_cuantos4;
				}
				$tabla .= "<td align=center valign=middle>".round($mediadesumas,2)."</td>";
				//$mediademedias = $mediademedias / count($clientes_entre_fechas);
				//$tabla .= "<td align=center valign=middle>aa".round($mediademedias,2)."</td>";
			$tabla .= "</tr>";
		$tabla .= "</table>";
	
		$p->HTMLtable($tabla);
		$p->Ln(5);
		
		$suma = 0;
		$sumadesumas = 0;
		$mediademedias = 0;
		unset($sum);
		
		//VALORACION FRENTE A LA COMPETENCIA
		$p->AddPage('L');
		$p->Cell(40,5,"Tabla de valoraciones frente a la competencia",0,1);
		
		$color1 = 'A6A6A6';
		$color2 = 'FFFFFF';
		$color3 = 'CECECE';
		$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
		$tit2 = "bgcolor=#$color3 color=#$color2 align=center valign=middle style=bold height=8";
		$nor = "align=center height=5 valign=middle";
		
		$clientes_entre_fechas = select_normal("Select * from kz_tec_mej_encuesta where 1 = 1 $filtros order by fechaencuesta");
	
		foreach($clientes_entre_fechas as $key => $valor_clientes){		
			if($_POST['cliente']){
				$campos = select_normal("Select kz_tec_mej_campos.id, kz_tec_mej_campos.descripcion, kz_tec_mej_valoraciones.campo from kz_tec_mej_campos, kz_tec_mej_valoraciones WHERE kz_tec_mej_campos.id = kz_tec_mej_valoraciones.campo and kz_tec_mej_valoraciones.idencuesta='".$valor_clientes['id']."'");
			}
			else{
				$campos = select_normal("Select distinct(kz_tec_mej_campos.id), kz_tec_mej_campos.descripcion, kz_tec_mej_valoraciones.campo from kz_tec_mej_campos, kz_tec_mej_valoraciones WHERE kz_tec_mej_campos.id = kz_tec_mej_valoraciones.campo");
			}
		}
		
		$tabla = "<table border=1>";
			//CABECERAS
			$tabla .= "<tr>
				<td $tit width=14>Organiz.</td>";
				if($campos)
				foreach($campos as $keycamp => $valorcamp){
					$tabla .= "<td $tit2 width=8>".$valorcamp['id']."</td>";
				}
				$tabla .= "<td $tit>Sumatorio</td>
				<td $tit>Media</td>";
			$tabla .= "</tr>";
			$indice_3=0;
			foreach($clientes_entre_fechas as $key => $valor){
				$tabla .= "<tr>
					<td $tit2>".$valor['organizacion']."</td>";
					$suma = 0;
					$indice_=0;
					$indice_2=0;
					if($campos){
						foreach($campos as $keycamp => $valorcamp){
							$valoraciones = select_normal("Select * from kz_tec_mej_valoraciones where idencuesta = ".$valor['id']." and campo = ".$valorcamp['id']."");
							$valoraciones = $valoraciones[0];
							
							if(''==$valoraciones['valcompetencia']){
								$no_contar_valoraciones_[$indice_2]++;
							}	
							$indice_2++;
							
							if(($valoraciones['valcompetencia'] == '') || ($valoraciones['valcompetencia'] == 'no contesta')){
								$indice_++;
								$tabla .= "<td align=center valign=middle bgcolor = ".aspectoimportante($valoraciones['aspectoimportante'])."></td>";
							}
							else{
								$tabla .= "<td align=center valign=middle bgcolor = ".aspectoimportante($valoraciones['aspectoimportante']).">".$valoraciones['valcompetencia']."</td>";
							}
							$suma = $valoraciones['valcompetencia'] + $suma;
							$sum[$valorcamp['id']] = $sum[$valorcamp['id']] + $valoraciones['valcompetencia'];
						}
						$tabla .= "<td align=center valign=middle>".$suma."</td>";
						
						if($suma == '0'){
							$indice_3++;
						}
						
						$sumadesumas = $sumadesumas + $suma;
						$entre_cuantos = (count($campos) - $indice_);
						if($entre_cuantos == '0'){
							$media = 0;
						}
						else{
							$media = $suma / $entre_cuantos;
						}
						$mediademedias = $mediademedias + $media;
						$tabla .= "<td align=center valign=middle bgcolor=".color_valor_1($media).">".round($media,2)."</td>";
					}
				$tabla .= "</tr>";
			}

			//FILA DE SUMAS
			$tabla .= "<tr>
				<td $tit>Sumas</td>";
				if($sum)
				foreach($sum as $key => $valor){
					$tabla .= "<td align=center valign=middle>".$valor."</td>";
				}
				$tabla .= "<td align=center valign=middle>".$sumadesumas."</td>";
				$mediademedias = $mediademedias;
				$tabla .= "<td align=center valign=middle>".round($mediademedias,2)."</td>";	
			$tabla .= "</tr>";
		
			//FILA DE MEDIAS
			$tabla .= "<tr>
				<td $tit>Medias</td>";
				$indice_2 = 0;
				if($sum)
				foreach($sum as $key => $valor){
					$entre_cuantos3 = count($clientes_entre_fechas) - $no_contar_valoraciones_[$indice_2];
					if($entre_cuantos3 == '0'){
						$media = 0;
					}
					else{
						$media = $valor / $entre_cuantos3;
					}
					$tabla .= "<td align=center valign=middle bgcolor=".color_valor_1($media).">".round($media,2)."</td>";
					$indice_2++;
				}
				
				$entre_cuantos5 = count($clientes_entre_fechas) - $indice_3;
				if($entre_cuantos5 == '0'){
					$mediadesumas = 0;
				}
				else{
					$mediadesumas = $sumadesumas / $entre_cuantos5;
				}
	
				$tabla .= "<td align=center valign=middle>".round($mediadesumas,2)."</td>";
				//$mediademedias = $mediademedias / count($clientes_entre_fechas);
				//$tabla .= "<td align=center valign=middle>".round($mediademedias,2)."</td>";
			$tabla .= "</tr>";
		$tabla .= "</table>";
	}
	
	$p->HTMLtable($tabla);

	//MOTIVOS DDE COMPRA
	$p->AddPage('L');
	$p->Cell(40,5,"Motivos de compra",0,1);
	
	$color1 = 'A6A6A6';
	$color2 = 'FFFFFF';
	$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
	$nor = "align=center height=5 valign=middle";

	$tabla = "<table border=1>";
		$tabla.= "<tr>
			<td $tit width=70>Cliente</td>
			<td $tit width=18>Calidad</td>
			<td $tit width=18>Precio</td>
			<td $tit width=18>Confianza</td>
			<td $tit width=18>".html_entity_decode("Atenci&oacute;n")."</td>
			<td $tit width=18>Servicio</td>
			<td $tit width=18>".html_entity_decode("Cercan&iacute;a")."</td>
			<td $tit width=18>Experiencia</td>
			<td $tit width=94>Otros</td>
		</tr>";
		if($clientes_entre_fechas)
		foreach($clientes_entre_fechas as $key => $valor){
			$tabla .= "<tr>
				<td $nor>".$valor['organizacion']."</td>";
				$motivos_cliente = select_normal("Select * from kz_tec_mej_motivosencuesta where idencuesta = ".$valor['id']);
				$motivos_cliente = $motivos_cliente[0];
				$tabla.= "<td $nor>".check_motivo($motivos_cliente['calidad'])."</td>";
				$tabla.= "<td $nor>".check_motivo($motivos_cliente['precio'])."</td>";
				$tabla.= "<td $nor>".check_motivo($motivos_cliente['confianza'])."</td>";
				$tabla.= "<td $nor>".check_motivo($motivos_cliente['atencion'])."</td>";
				$tabla.= "<td $nor>".check_motivo($motivos_cliente['servicio'])."</td>";
				$tabla.= "<td $nor>".check_motivo($motivos_cliente['cercania'])."</td>";
				$tabla.= "<td $nor>".check_motivo($motivos_cliente['experiencia'])."</td>";
				$tabla.= "<td $nor>".$motivos_cliente['otros']."</td>
			</tr>";
		}
	$tabla .= "</table>";
	
	$p->HTMLtable($tabla);

	//LEYENDA --------------------------------------------------------------------------------------------
	$p->AddPage('L');
	$p->Cell(40,5,"Leyenda",0,1);
	
	$color1 = 'A6A6A6';
	$color2 = 'FFFFFF';
	$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
	$nor = "align=center height=5 valign=middle";

	$clientes_entre_fechas = select_normal("Select * from kz_tec_mej_encuesta where 1 = 1 $filtros order by fechaencuesta");
	
	foreach($clientes_entre_fechas as $key => $valor_clientes){
		if($_POST['cliente']){
			$campos = select_normal("Select kz_tec_mej_campos.id, kz_tec_mej_campos.descripcion, kz_tec_mej_valoraciones.campo from kz_tec_mej_campos, kz_tec_mej_valoraciones WHERE kz_tec_mej_campos.id = kz_tec_mej_valoraciones.campo and kz_tec_mej_valoraciones.idencuesta='".$valor_clientes['id']."'");
		}
		else{
			$campos = select_normal("Select distinct(kz_tec_mej_campos.id), kz_tec_mej_campos.descripcion, kz_tec_mej_valoraciones.campo from kz_tec_mej_campos, kz_tec_mej_valoraciones WHERE kz_tec_mej_campos.id = kz_tec_mej_valoraciones.campo");
		}
	}

	$tabla = "<table border=1>";
		$tabla .= "<tr>
			<td $tit width=15>Numero</td>
			<td $tit width=120>Campo</td>
		</tr>";
		if($campos)
		foreach($campos as $key => $valor){
			$tabla .= "<tr>
				<td $nor>".$valor['id']."</td>
				<td $nor>".$valor['descripcion']."</td>
			</tr>";
		}
	$tabla .= "</table>";
	
	$p->HTMLtable($tabla);
	$p->Ln(5);
	
	$tabla = "<table border=1>";
		$tabla .= "<tr>
			<td $tit>Color</td>
			<td $tit>Significado</td>
		</tr>";
		$tabla .= "<tr>
			<td bgcolor=".aspectoimportante(1)."></td>
			<td $nor>Aspecto importante</td>
		</tr>";
		$tabla .= "<tr>
			<td bgcolor=".color_valor_1(1)."></td>
			<td $nor>Inferior a 5</td>
		</tr>";
		$tabla .= "<tr>
			<td bgcolor=".color_valor_1(7)."></td>
			<td $nor>Entre 5 y 7</td>
		</tr>";
		$tabla .= "<tr>
			<td bgcolor=".color_valor_1(10)."></td>
			<td $nor>Mayor que 7</td>
		</tr>";
	$tabla .= "</table>";
	
	$p->HTMLtable($tabla);
	$p->output();
}?>
