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
$titulo = "Informe de Acciones Correctivas";

$ARRAY_NC = array_num_nc();

if($_POST['anno']){
	$filtros .= " and ano = ".$_POST['anno']."";
}

if($_POST['fecha1']!= ''){
	$filtros .= " and fecha_apertura >= '".$_POST['fecha1']."'";
	$l_filtros .= "<tr><td>Fecha inicio: ".$_POST['fecha1']."</td></tr>";
}

if($_POST['fecha2']!= ''){
	$filtros .= " and fecha_apertura  <= '".$_POST['fecha2']."'";
	$l_filtros .= "<tr><td>Fecha fin: ".$_POST['fecha2']."</td></tr>";
}

if($_POST['estado']!= ''){
	if($_POST['estado'] == 'SI'){
		$filtros .= " and fecha_cierre = '0000-00-00'";
	}
	else $filtros .= " and fecha_cierre <> '0000-00-00'";
	$l_filtros .= "<tr><td>Cerradas: ".siono($_POST['estado'])."</td></tr>";
}

if($_POST['tipo']!= ''){
	$filtros .= " and tipo_accion = '".$_POST['tipo']."'";
	$l_filtros .= "<tr><td>Tipo: ".$_POST['tipo']."</td></tr>";
}

if($_POST['ag_tipo']){
	$ag = "";
	$orden = "tipo_accion, ";
}
	
if($_POST['xls']){
	$acpm = select_normal("SELECT * FROM kz_tec_mej_acpm ORDER BY fecha_apertura desc");
	
	header('Content-type: application/vnd.ms-excel');
	header("Content-Disposition: attachment; filename=Informe_accionescorrectivas.xls");
	header("Pragma: no-cache");
	header("Pragma: public");?>
	<table><tr><td style='font-weight: bold; text-decoration: underline; font-size:1.3em;'><?php echo $titulo; ?></td></table>
	<br></br>
	
	<table border=1>
		<tr style='font-weight: bold; background-color: gray;'>
			<td><?php echo html_entity_decode("N&deg; NC")?></td>
			<td>FECHA DE APERTURA</td>
			<td>CAUSA PROBABLE</td>
			<td><?php echo html_entity_decode("TIPO ACCI&Oacute;N")?></td>
			<td><?php echo html_entity_decode("DESCRIPCI&Oacute;N ACCI&Oacute;N")?></td>
			<td>FECHA PREVISTA DE CIERRE</td>
			<td><?php echo html_entity_decode("SEGUIMIENTO ACCI&Oacute;N")?></td>
			<td><?php echo html_entity_decode("VALORACI&Oacute;N EFICACIA ACCI&Oacute;N")?></td>
			<td>FECHA CIERRE</td>
			<td>RESPONSABLE CIERRE</td>
			<td>CIERRE EFICAZ</td>
			<td><?php echo html_entity_decode("COSTE DE LA ACCI&Oacute;N")?></td>
		</tr>
		
		<?php if($acpm){
			foreach($acpm as $key => $valor){ ?>
				<tr>
					<td><?php echo $ARRAY_NC[$valor['num_nc']];?></td>
					<td><?php echo $valor['fecha_apertura'];?></td>
					<td><?php echo $valor['causa_probable'];?></td>
					<td><?php echo $valor['tipo_accion'];?></td>
					<td><?php echo $valor['descripcion_accion'];?></td>
					<td><?php echo $valor['fecha_prevista_cierre'];?></td>
					<td><?php echo $valor['seguimiento'];?></td>
					<td><?php echo $valor['valoracion'];?></td>
					<td><?php echo $valor['fecha_cierre'];?></td>
					<td><?php echo $valor['responsable'];?></td>
					<td><?php echo $valor['cierre_eficaz'];?></td>
					<td><?php echo $valor['coste'];?></td>
				</tr>
			<?php }
		}?>
	</table>
<?php }

else{
	$acpm = select_normal("SELECT * FROM kz_tec_mej_acpm where 1 = 1 $filtros order by $orden fecha_apertura desc");
		
	if($_POST['pdf']){
		
		require(FPDF_PDF_RUTA.'lib/pdftable.inc.php');
		
		$p = new PDFTable('P');
		$p->SetMargins(3,43,0);
		
		if($_POST['modo_resumen']){
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
			
			$tabla_cantidad = "<table>
				<tr><td>Cantidad total de Acciones Correctivas: ".count($acpm)."</td></tr>	
			</table>";
			
			$p->HTMLtable($tabla_cantidad);
			$p->ln(5);
			
			$color1 = 'A6A6A6';
			$color2 = 'FFFFFF';
			$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
			$nor = "align=center height=5 valign=middle";
			
			if(!$_POST['ag_tipo']){
				$tabla = "<table border=1>
					<tr>
						<td $tit width=20>Num NC</td>
						<td $tit width=23>Fecha apertura</td>
						<td $tit width=140>Causa probable</td>
						<td $tit width=54>".html_entity_decode("Tipo acci&oacute;n")."</td>
						<td $tit width=15>Coste</td>
						<td $tit width=19>Fecha cierre</td>
						<td $tit width=19>Cierre eficaz</td>
					</tr>";
			}
		}	
		if($acpm){
			foreach($acpm as $key => $valor){
				if(!$_POST['modo_resumen']){
					$p->AddPage('P');
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
					
					$tabla_cantidad = "<table>
						<tr><td>Cantidad total de Acciones Correctivas: ".count($acpm)."</td></tr>	
					</table>";
					
					$p->HTMLtable($tabla_cantidad);
					$p->ln(5);
					
					$color1 = 'A6A6A6';
					$color2 = 'FFFFFF';
					$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
					$nor = "align=center height=5 valign=middle";
					
					$tabla = "<table border=1>
				    	<tr>
				    		<td $tit width=30>Numero NC:</td>
				    		<td $nor width=174> ".$ARRAY_NC[$valor['num_nc']]."</td>
				    	</tr>
				    	<tr>
				    		<td $tit>Fecha apertura:</td>
				    		<td $nor>".$valor['fecha_apertura']."</td>
				    	</tr>
				    	<tr>
				    		<td $tit>Causa probable:</td>
				    		<td $nor>".$valor['causa_probable']."</td>
				    	</tr>    	
				    	<tr>
				    		<td $tit>".html_entity_decode("Tipo de acci&oacute;n").":</td>
				    		<td $nor>".$valor['tipo_accion']."</td>
				    	</tr>    	
				    	<tr>
				    		<td $tit>Descripcion:</td>
				    		<td $nor>".$valor['descripcion_accion']."</td>
				    	</tr>
				    </table>";
					
					$p->htmltable($tabla);
					$p->ln(5);
				    	
					$tabla = "<table border=1>
				    	<tr>
				    		<td $tit width=35>Fecha prevista cierre:</td>
				    		<td $nor width=169> ".$valor['fecha_prevista_cierre']."</td>
				    	</tr>
				    	<tr>
				    		<td $tit>Seguimiento:</td>
				    		<td $nor>".$valor['seguimiento']."</td>
				    	</tr>
				    	<tr>
				    		<td $tit>".html_entity_decode("Valoraci&oacute;n")."</td>
				    		<td $nor>".$valor['valoracion']."</td>
				    	</tr>    	
				    	<tr>
				    		<td $tit>Fecha cierre</td>
				    		<td $nor>".$valor['fecha_cierre']."</td>
				    	</tr>    	
				    	<tr>
				    		<td $tit>Responsable</td>
				    		<td $nor>".$valor['responsable']."</td>
				    	</tr>
				    	<tr>
				    		<td $tit>Coste</td>
				    		<td $nor>".$valor['coste']."</td>
				    	</tr>  
						<tr>
							<td $tit>Cierre eficaz:</td>
							<td $nor>".siono($valor['cierre_eficaz'])."</td>
						</tr>    	
				    </table>";
						
						$p->htmltable($tabla);
				}
				else {
					//CASO DE AGRUPAR POR
					if($_POST['ag_tipo']){
						if($valor['tipo_accion']!= $tipo_accion_ul){
							$tabla .= "</table>";
							
							$color1 = '5F5F5F';
							$color2 = 'FFFFFF';
							$tit = "bgcolor=#$color1 color=#$color2 valign=middle style=bold height=4";
							
							$p->HTMLtable($tabla);
							$tabla = "<table>
								<tr>
									<td $tit>".$valor['tipo_accion']."</td>
								</tr>
							</table>";
							$p->ln(5);
							$p->htmltable($tabla);
							
							$color1 = 'A6A6A6';
							$color2 = 'FFFFFF';
							$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
							$nor = "align=center height=5 valign=middle";
							
							$tabla = "<table border=1>
								<tr>
									<td $tit width=20>Num NC</td>
									<td $tit width=23>Fecha apertura</td>
									<td $tit width=140>Causa probable</td>
									<td $tit width=54>".html_entity_decode("Tipo acci&oacute;n")."</td>
									<td $tit width=15>Coste</td>
									<td $tit width=19>Fecha cierre</td>
									<td $tit width=19>Cierre eficaz</td>
								</tr>";
						}
					}
					$tabla .= "<tr>
						<td $nor>".$ARRAY_NC[$valor['num_nc']]."</td>
						<td $nor>".$valor['fecha_apertura']."</td>
						<td $nor>".$valor['causa_probable']."</td>
						<td $nor>".$valor['tipo_accion']."</td>
						<td $nor>".$valor['coste']."</td>
						<td $nor>".$valor['fecha_cierre']."</td>
						<td $nor>".siono($valor['cierre_eficaz'])."</td>
					</tr>";
					
					$tipo_accion_ul = $valor['tipo_accion'];
				}	
				$coste[$valor['tipo_accion']] = $coste[$valor['tipo_accion']] + $valor['coste'];
				$sumacoste = $sumacoste + $valor['coste'];
			}
			if($_POST['modo_resumen']){
				$tabla .= "</table>";
				$p->HTMLtable($tabla);
			}
			$p->ln(5);
			foreach($coste as $keycoste => $valorcoste){
					$p->Cell(40,5,"COSTE de -> $keycoste: $valorcoste euros",0,1);
			}
			$p->ln(5);
			$p->Cell(40,5,"COSTE TOTAL OCASIONADO: $sumacoste euros",0,1);
		}
		$p->output();
	}
}?>
