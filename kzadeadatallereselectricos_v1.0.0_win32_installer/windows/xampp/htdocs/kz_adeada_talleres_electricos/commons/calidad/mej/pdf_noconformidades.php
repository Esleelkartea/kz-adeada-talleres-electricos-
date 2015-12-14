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
$titulo = "Informe de No Conformidades";

if($_POST['anno']){
	$filtros .= " and ano = ".$_POST['anno']."";
}

if($_POST['fecha1']!= ''){
	$filtros .= " and fecha_deteccion >= '".$_POST['fecha1']."'";
	$l_filtros .= "<tr><td>Fecha inicio: ".$_POST['fecha1']."</td></tr>";
}

if($_POST['fecha2']!= ''){
	$filtros .= " and fecha_deteccion <= '".$_POST['fecha2']."'";
	$l_filtros .= "<tr><td>Fecha fin: ".$_POST['fecha2']."</td></tr>";
}

if($_POST['cierre_eficaz']!= ''){
	$filtros .= " and cierre_eficaz = '".$_POST['cierre_eficaz']."'";
	$l_filtros .= "<tr><td>Cierre eficaz: ".siono($_POST['cierre_eficaz'])."</td></tr>";
}

if($_POST['maquinaria']!= ''){
	$filtros .= " and maquinaria = '".$_POST['maquinaria']."'";
	$l_filtros .= "<tr><td>Maquinaria: ".siono($_POST['maquinaria'])."</td></tr>";
}

if($_POST['metodos']!= ''){
	$filtros .= " and metodos = '".$_POST['metodos']."'";
	$l_filtros .= "<tr><td>".html_entity_decode("M&eacute;todos").": ".siono($_POST['metodos'])."</td></tr>";
}

if($_POST['mano_obra']!= ''){
	$filtros .= " and mano_obra = '".$_POST['mano_obra']."'";
	$l_filtros .= "<tr><td>Mano de obra: ".siono($_POST['mano_obra'])."</td></tr>";
}

if($_POST['mediciones']!= ''){
	$filtros .= " and mediciones = '".$_POST['mediciones']."'";
	$l_filtros .= "<tr><td>Mediciones: ".siono($_POST['mediciones'])."</td></tr>";
}

if($_POST['tiponc']!= ''){
	$filtros .= " and tipoNC = '".$_POST['tiponc']."'";
	$l_filtros .= "<tr><td>Origen de la NC: ".$_POST['tiponc']."</td></tr>";
}
if($_POST['detectada_en']!= ''){
	$filtros .= " and detectada_en = '".$_POST['detectada_en']."'";
	$l_filtros .= "<tr><td>Especificar origen: ".$_POST['detectada_en']."</td></tr>";
}

if($_POST['detectada_por']!= ''){
	$filtros .= " and detectada_por = '".$_POST['detectada_por']."'";
	$l_filtros .= "<tr><td>".html_entity_decode("Clasificaci&oacute;n de origen").": ".$_POST['detectada_por']."</td></tr>";
}

$nc = select_normal("SELECT * FROM kz_tec_mej_noconformidades order by cnc");

if($nc){
	if($_POST['xls']){
		header('Content-type: application/vnd.ms-excel');
		header("Content-Disposition: attachment; filename=Informe_noconformidades.xls");
		header("Pragma: no-cache");
		header("Pragma: public");?>
		<table><tr><td style='font-weight: bold; text-decoration: underline; font-size:1.4em;'><?php echo $titulo; ?></td></table>
		<br></br>
	
		<table border=1>
			<tr style='font-weight: bold; background-color: gray;'>
				<td>CNC</td>
				<td>ORIGEN DE LA NC</td>
				<td><?php echo html_entity_decode("ESPECIFICACI&Oacute;N DE ORIGEN")?></td>
				<td><?php echo html_entity_decode("CLASIFICACI&Oacute;N DE ORIGEN")?></td>
				<td>DETECTADA POR</td>
				<td><?php echo html_entity_decode("FECHA DE DETECCI&Oacute;N")?></td>
				<td>ORDEN/PEDIDO</td>
				<td><?php echo html_entity_decode("DESCRIPCI&Oacute;N DEL PROBLEMA: &iquest;QU&Eacute; HA PASADO?")?></td>
				<td>CAUSA ESTIMADA</td>
				<td><?php echo html_entity_decode("SOLUCI&Oacute;N A TOMAR: &iquest;QU&Eacute; HAGO PARA SOLUCIONARLO?")?></td>
				<td><?php echo html_entity_decode("RESPONSABLE TRATAMIENTO: &iquest;QUI&Eacute;N LO HACE?")?></td>
				<td><?php echo html_entity_decode("&iquest;CU&Aacute;NDO TIENE QUE ESTAR HECHO?")?></td>
				<td><?php echo html_entity_decode("SEGUIMIENTO REALIZADO DE LA SOLUCI&Oacute;N ADOPTADA")?></td>
				<td><?php echo html_entity_decode("FECHA CIERRE: &iquest;CU&Aacute;NDO SE HA HECHO?")?></td>
				<td>CIERRE EFICAZ</td>
				<td>COSTE OCASIONADO</td>
				<td>UNIDADES</td>
				<td>MAQUINARIA</td>
				<td>MANO DE OBRA</td>
				<td>MATERIA PRIMA</td>
				<td>MEDICIONES</td>
				<td><?php echo html_entity_decode("M&Eacute;TODOS")?></td>
			</tr>
			
			<?php if($nc){
				foreach($nc as $key => $valor){ ?>
					<tr>
						<td><?php echo $valor['cnc'];?></td>
						<td><?php echo $valor['tipoNC'];?></td>
						<td><?php echo $valor['detectada_en'];?></td>
						<td><?php echo $valor['detectada_por'];?></td>
						<td><?php echo $valor['detectada_por_'];?></td>
						<td><?php echo $valor['fecha_deteccion'];?></td>
						<td><?php echo $valor['orden_pedido'];?></td>
						<td><?php echo $valor['descripcion'];?></td>
						<td><?php echo $valor['causa_estimada'];?></td>
						<td><?php echo $valor['tratamiento'];?></td>
						<td><?php echo $valor['responsable'];?></td>
						<td><?php echo $valor['fecha_prevista'];?></td>
						<td><?php echo $valor['seguimiento'];?></td>
						<td><?php echo $valor['fecha_cierre'];?></td>
						<td><?php echo $valor['cierre_eficaz'];?></td>
						<td><?php echo $valor['coste'];?></td>
						<td><?php echo $valor['unidades'];?></td>
						<td><?php echo $valor['maquinaria'];?></td>
						<td><?php echo $valor['mano_obra'];?></td>
						<td><?php echo $valor['materia_prima'];?></td>
						<td><?php echo $valor['mediciones'];?></td>
						<td><?php echo $valor['metodos'];?></td>
					</tr>
				<?php }
			}?>
		</table>
	<?php }
	else{
		$nc = select_normal("SELECT * FROM kz_tec_mej_noconformidades where 1 = 1 $filtros order by fecha_deteccion desc");
	
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
	
				$color1 = 'A6A6A6';
				$color2 = 'FFFFFF';
				$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
				$nor = "align=center height=5 valign=middle";
				
				$filtrostab = "<table>";
				$filtrostab .= $l_filtros;
				$filtrostab .= "</table>";
				
				$p->HTMLtable($filtrostab);
				$p->ln(5);
	
				$p->Cell(0,3,"Cantidad total de NC: ".count($nc),0,1);
				$p->Ln(5);
				
				$tabla = "<table border=1>
					<tr>
						<td $tit width=25>CNC</td>
						<td $tit width=20>Fecha detec.</td>
						<td $tit width=25>Origen de la NC</td>
						<td $tit width=32>Especific. de origen</td>
						<td $tit width=27>Clasific. de origen</td>
						<td $tit width=30>Detectada por</td>
						<td $tit width=75>".html_entity_decode("Resumen descripci&oacute;n")."</td>
						<td $tit width=10>Coste</td>
						<td $tit width=10>Unid.</td>
						<td $tit width=19>Fecha cierre</td>
						<td $tit width=17>Cierre efic.</td>
					</tr>";
			}
			if($nc){
				foreach($nc as $key => $valor){
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
	
						$p->Cell(0,3,"Cantidad total de NC: ".count($nc),0,1);
						$p->Ln(5);
							
						$color1 = 'A6A6A6';
						$color2 = 'FFFFFF';
						$tit = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
						$nor = "align=center height=5 valign=middle";
							
						$tabla = "<table border=1>
					    	<tr>
					    		<td $tit width=40>CNC:</td>
					    		<td $nor width=80> ".$valor['cnc']."</td>
					    	</tr>
					    	<tr>
					    		<td $tit>Origen del problema:</td>
					    		<td $nor>".$valor['tipoNC']."</td>
					    	</tr>
					    	<tr>
					    		<td $tit>".html_entity_decode("Especificaci&oacute;n de origen").":</td>
					    		<td $nor>".$valor['detectada_en']."</td>
					    	</tr>    	
					    	<tr>
					    		<td $tit>".html_entity_decode("Clasificaci&oacute;n de origen").":</td>
					    		<td $nor>".$valor['detectada_por']."</td>
					    	</tr>
					    	<tr>
					    		<td $tit>Detectada por:</td>
					    		<td $nor>".$valor['detectada_por_']."</td>
					    	</tr>   	
					    	<tr>
					    		<td $tit>".html_entity_decode("Fecha de detecci&oacute;n").":</td>
					    		<td $nor>".$valor['fecha_deteccion']."</td>
					    	</tr>
					    	<tr>
					    		<td $tit>Orden / Pedido:</td>
					    		<td $nor>".$valor['orden_pedido']."</td>
					    	</tr>
					    </table>";
							
						$p->htmltable($tabla);
						$p->ln(5);
						    		
						$tabla = "<table border=1>
						    <tr>
						    	<td $tit width=70>".html_entity_decode("Descripci&oacute;n del problema &iquest;Qu&eacute; ha pasado?").":</td>
						    	<td $nor width=134> ".$valor['descripcion']."</td>
						    </tr>
					    	<tr>
					    		<td $tit>Causa estimada:</td>
					    		<td $nor>".$valor['causa_estimada']."</td>
					    	</tr>
					    	<tr>
					    		<td $tit>".html_entity_decode("Soluci&oacute;n a tomar: &iquest;Qu&eacute; hago para solucionarlo?")."</td>
					    		<td $nor>".$valor['tratamiento']."</td>
					    	</tr>    	
					    	<tr>
					    		<td $tit>".html_entity_decode("Responsable tratamiento: &iquest;Qui&eacute;n lo hace?")."</td>
					    		<td $nor>".$valor['responsable']."</td>
					    	</tr>    	
					    	<tr>
					    		<td $tit>".html_entity_decode("&iquest;Cu&aacute;ndo tiene que estar hecho?")."</td>
					    		<td $nor>".$valor['fecha_prevista']."</td>
					    	</tr>
					    	<tr>
					    		<td $tit>".html_entity_decode("Seguimiento realizado de la soluci&oacute;n adoptada").":</td>
					    		<td $nor>".$valor['seguimiento']."</td>
					    	</tr>
							<tr>
								<td $tit>".html_entity_decode("Fecha cierre: &iquest;Cu&aacute;ndo se ha hecho?").":</td>
								<td $nor>".$valor['fecha_cierre']."</td>
							</tr>  
							<tr>
								<td $tit>Cierre eficaz: </td>
								<td $nor>".siono($valor['cierre_eficaz'])."</td>
							</tr>    	
					    </table>";
		
						$p->htmltable($tabla);
						$p->ln(5);
						
						$tabla = "<table border=1 >
					    	<tr>
					    		<td $tit width=30>Coste ocasionado:</td>
					    		<td $nor width=20> ".$valor['coste']." euros</td>
					    	</tr>
					    	<tr>
					    		<td $tit>Maquinaria</td>
					    		<td $nor>".siono($valor['maquinaria'])."</td>
					    	</tr>
					    	<tr>
					    		<td $tit>Mano de obra</td>
					    		<td $nor>".siono($valor['mano_obra'])."</td>
					    	</tr>    	
					    	<tr>
					    		<td $tit>Materia prima</td>
					    		<td $nor>".siono($valor['materia_prima'])."</td>
					    	</tr>    	
					    	<tr>
					    		<td $tit>Mediciones</td>
					    		<td $nor>".siono($valor['mediciones'])."</td>
					    	</tr>
					    	<tr>
					    		<td $tit>".html_entity_decode("M&eacute;todos")."</td>
					    		<td $nor>".siono($valor['metodos'])."</td>
					    	</tr>
					    </table>";
	
						$p->htmltable($tabla);
					}
					else {
						$tabla .= "<tr>
							<td $nor>".$valor['cnc']."</td>
							<td $nor>".$valor['fecha_deteccion']."</td>
							<td $nor>".$valor['tipoNC']."</td>
							<td $nor>".$valor['detectada_en']."</td>
							<td $nor>".$valor['detectada_por']."</td>
							<td $nor>".$valor['detectada_por_']."</td>
							<td $nor>".$valor['descripcion']."</td>
							<td $nor>".$valor['coste']."</td>
							<td $nor>".$valor['unidades']."</td>
							<td $nor>".$valor['fecha_cierre']."</td>
							<td $nor>".siono($valor['cierre_eficaz'])."</td>
						</tr>";
					}	
					$sumacoste = $sumacoste + $valor['coste'];
				}
				if($_POST['modo_resumen']){
					$tabla .= "</table>";
					$p->HTMLtable($tabla);
				}
				$p->ln(5);
				$p->Cell(40,10,"COSTE TOTAL OCASIONADO: $sumacoste euros",0,1);
			}
			$p->output();
		}
	}
}
else{
	echo "<script>alert('No se puede mostrar el informe. No hay No Conformidades.');</script>";
	echo "<script>window.close();</script>";
}?>
