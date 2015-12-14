<?php session_start();
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
?>
<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Informe_trabajos.xls");
header("Pragma: public");

include("../functions/globales.php");
include("../functions/funciones.php");

$style['cabecera_tabla_filtros'] = ' bgcolor=#969696 ';
$style['cab_persona'] = ' bgcolor=#969696 ';
$color="background-color: #C0C0C0;";

if($_POST['aplicar_filtros']){?>
	<table>
		<tr>
			<td colspan=3 style='text-decoration: underline;'>Informe de trabajos</td>
			<td colspan=11 style='text-align: right;'>Kz Adeada Talleres El&eacute;ctricos - <?php echo conversion_formato_fecha(date('Y-m-d'), 'abreviado')." -- ".date('H:i:s');?></td>
		</tr>
	</table>
	<br>
	<?php $mostrar_tecnico = select_normal("SELECT nombre, apellidos FROM kz_te_personal WHERE id = '".$_POST['fil_persona']."'");
	$tecnico = $mostrar_tecnico[0];
	
	$dividir_cliente = explode("||", $_POST['cliente_proyecto']);
	$proyecto = $dividir_cliente[1];
	$cliente = $dividir_cliente[0];
	$mostrar_cliente_proyecto = select_normal("SELECT kz_te_clientes.id as idcliente, kz_te_clientes.nombre_comercial as cliente, kz_te_proyectos.id as idproyecto, kz_te_proyectos.nombre as proyecto FROM kz_te_clientes, kz_te_proyectos WHERE kz_te_clientes.id = '".$cliente."' and kz_te_clientes.id = kz_te_proyectos.cliente and kz_te_proyectos.id = '".$proyecto."'");
	$clienteproyecto = $mostrar_cliente_proyecto[0];
	$tecnico_proyecto = select_normal("SELECT * FROM kz_te_proyecto_personal WHERE tecnico = '".$_POST['fil_persona']."' and proyecto = '".$clienteproyecto['idproyecto']."'");
	$fechas_proyecto = select_normal("SELECT horas_auditoria, fecha_inicio, fecha_prevista FROM kz_te_proyectos WHERE id = '".$clienteproyecto['idproyecto']."'");
	$fechas = $fechas_proyecto[0];
	$dividir_fecha_inicio = explode("-", $fechas['fecha_inicio']);
	$anno_inicio = $dividir_fecha_inicio[0];
	$mes_inicio = $dividir_fecha_inicio[1];
	$dividir_fecha_fin = explode("-", $fechas['fecha_prevista']);
	$anno_fin = $dividir_fecha_fin[0];
	$mes_fin = $dividir_fecha_fin[1];
	
	$objetivos = select_normal("SELECT objetivo FROM kz_te_objetivos_proyectos WHERE proyecto = '".$clienteproyecto['idproyecto']."' and anno = '".$_POST['anno']."'");
	if($tecnico_proyecto){ ?>
		<table border="1" width='100%'>
			<tr>
				<td colspan=14 style='font-weight: bold; background-color:#969696;'><?php echo $tecnico['nombre']." ".$tecnico['apellidos'];?></td>
			</tr>
			<tr>
				<td colspan=6 <?php echo $style['cab_persona']; ?>><?php echo $clienteproyecto['cliente']." || ".$clienteproyecto['idproyecto']." - ".$clienteproyecto['proyecto'];?></td>
				<td colspan=8><u>Objetivos:</u><br>
				<?php
				if($objetivos){
					foreach($objetivos as $key => $valorobjetivo){
						echo $valorobjetivo['objetivo']."<br>";
					}
				}
				else{
					echo "<i>(No hay objetivos)</i>";
				}?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td style='font-size: 0.6em; <?php echo $color;?>'>ENERO</td>
				<td style='font-size: 0.6em; <?php echo $color;?>'>FEBRERO</td>
				<td style='font-size: 0.6em; <?php echo $color;?>'>MARZO</td>
				<td style='font-size: 0.6em; <?php echo $color;?>'>ABRIL</td>
				<td style='font-size: 0.6em; <?php echo $color;?>'>MAYO</td>
				<td style='font-size: 0.6em; <?php echo $color;?>'>JUNIO</td>
				<td style='font-size: 0.6em; <?php echo $color;?>'>JULIO</td>
				<td style='font-size: 0.6em; <?php echo $color;?>'>AGOSTO</td>
				<td style='font-size: 0.6em; <?php echo $color;?>'>SEPTIEMBRE</td>
				<td style='font-size: 0.6em; <?php echo $color;?>'>OCTUBRE</td>
				<td style='font-size: 0.6em; <?php echo $color;?>'>NOVIEMBRE</td>
				<td style='font-size: 0.6em; <?php echo $color;?>'>DICIEMBRE</td>
				<td style='background-color: #C0C0C0'>TOTALES</td>
			</tr>

			<tr>
				<td style='background-color: #C0C0C0'>H. totales</td>
				<td style='text-align: center;'>
					<?php 
					//if ($enero == 1){							
						$h_realizadas_enero = horas_realizadas_mes($clienteproyecto['idproyecto'], $_POST['fil_persona'], 'ENERO', $_POST['anno']);	
						echo number_format(($h_realizadas_enero),2,',','.')."h";
					//}
					?>
				</td>
				<td style='text-align: center;'>
					<?php 
					//if ($febrero == 1){		
						$h_realizadas_febrero = horas_realizadas_mes($clienteproyecto['idproyecto'], $_POST['fil_persona'], 'FEBRERO', $_POST['anno']);	
						echo number_format(($h_realizadas_febrero),2,',','.')."h";
					//}
					?>
				</td>
				<td style='text-align: center;'>
					<?php 
					//if ($marzo == 1){		
						$h_realizadas_marzo = horas_realizadas_mes($clienteproyecto['idproyecto'], $_POST['fil_persona'], 'MARZO', $_POST['anno']);
						echo number_format(($h_realizadas_marzo),2,',','.')."h";
					//}
					?>
				</td>
				<td style='text-align: center;'>
					<?php 
					//if ($abril == 1){		
						$h_realizadas_abril = horas_realizadas_mes($clienteproyecto['idproyecto'], $_POST['fil_persona'], 'ABRIL', $_POST['anno']);	
						echo number_format(($h_realizadas_abril),2,',','.')."h";
					//}
					?>
				</td>
				<td style='text-align: center;'>
					<?php 
					//if ($mayo == 1){		
						$h_realizadas_mayo = horas_realizadas_mes($clienteproyecto['idproyecto'], $_POST['fil_persona'], 'MAYO', $_POST['anno']);	
						echo number_format(($h_realizadas_mayo),2,',','.')."h";
					//}
					?>
				</td>
				<td style='text-align: center;'>
					<?php 
					//if ($junio == 1){		
						$h_realizadas_junio = horas_realizadas_mes($clienteproyecto['idproyecto'], $_POST['fil_persona'], 'JUNIO', $_POST['anno']);	
						echo number_format(($h_realizadas_junio),2,',','.')."h";
					//}
					?>
				</td>
				<td style='text-align: center;'>
					<?php 
					//if ($julio == 1){		
						$h_realizadas_julio = horas_realizadas_mes($clienteproyecto['idproyecto'], $_POST['fil_persona'], 'JULIO', $_POST['anno']);	
						echo number_format(($h_realizadas_julio),2,',','.')."h";
					//}
					?>
				</td>
				<td style='text-align: center;'>
					<?php 
					//if ($agosto == 1){		
						$h_realizadas_agosto = horas_realizadas_mes($clienteproyecto['idproyecto'], $_POST['fil_persona'], 'AGOSTO', $_POST['anno']);	
						echo number_format(($h_realizadas_agosto),2,',','.')."h";
					//}
					?>
				</td>
				<td style='text-align: center;'>
					<?php 
					//if ($septiembre == 1){		
						$h_realizadas_septiembre = horas_realizadas_mes($clienteproyecto['idproyecto'], $_POST['fil_persona'], 'SEPTIEMBRE', $_POST['anno']);	
						echo number_format(($h_realizadas_septiembre),2,',','.')."h";
					//}
					?>
				</td>
				<td style='text-align: center;'>
					<?php 
					//if ($octubre == 1){		
						$h_realizadas_octubre = horas_realizadas_mes($clienteproyecto['idproyecto'], $_POST['fil_persona'], 'OCTUBRE', $_POST['anno']);	
						echo number_format(($h_realizadas_octubre),2,',','.')."h";
					//}
					?>
				</td>
				<td style='text-align: center;'>
					<?php 
					//if ($noviembre == 1){		
						$h_realizadas_noviembre = horas_realizadas_mes($clienteproyecto['idproyecto'], $_POST['fil_persona'], 'NOVIEMBRE', $_POST['anno']);	
						echo number_format(($h_realizadas_noviembre),2,',','.')."h";
					//}
					?>
				</td>
				<td style='text-align: center;'>
					<?php 
					//if ($diciembre == 1){		
						$h_realizadas_diciembre = horas_realizadas_mes($clienteproyecto['idproyecto'], $_POST['fil_persona'], 'DICIEMBRE', $_POST['anno']);	
						echo number_format(($h_realizadas_diciembre),2,',','.')."h";
					//}
					?>
				</td>
				<td style='background-color: #C0C0C0; font-weight: bold; text-align: center;'>
					<?php 
					$h_realizadas = $h_realizadas_enero + $h_realizadas_febrero + $h_realizadas_marzo + $h_realizadas_abril + $h_realizadas_mayo + $h_realizadas_junio + $h_realizadas_julio + $h_realizadas_agosto + $h_realizadas_septiembre + $h_realizadas_octubre + $h_realizadas_noviembre + $h_realizadas_diciembre;
					echo number_format(($h_realizadas),2,',','.')."h";
					?>
				</td>
			</tr>
			<tr>
				<th style='background-color: black;' colspan=14></th>
			</tr>
			
			<tr>
				<td colspan=14 <?php echo $style['cab_persona']; ?>>Partes de <?php echo $tecnico['nombre']." ".$tecnico['apellidos'];?> para <?php echo $clienteproyecto['cliente']." || ".$clienteproyecto['idproyecto']." - ".$clienteproyecto['proyecto'];?>:</td>
			</tr>
			<tr>
				<td style='background-color: #C0C0C0; font-size: 0.8em;'>Fecha</td>
				<td style='background-color: #C0C0C0; font-size: 0.8em;'>Duraci&oacute;n</td>
				<td style='background-color: #C0C0C0; font-size: 0.8em;' colspan = 7>Labor realizada</td>
				<td style='background-color: #C0C0C0; font-size: 0.8em;' colspan = 5>Otros</td>
			</tr>
			<?php
			$fecha_inicio=$_POST['anno']."-01-01";
			$fecha_fin=$_POST['anno']."-12-31";
			$partes = select_normal("SELECT * FROM kz_te_partes WHERE comercial = '".$_POST['fil_persona']."' and proyecto = '".$clienteproyecto['idproyecto']."' and dia >= '".$fecha_inicio."' and dia <= '".date("Y-m-d")."' and dia between '".$fecha_inicio."' and '".$fecha_fin."' ORDER BY dia desc");
			if($partes){
				foreach($partes as $keypartes => $valorpartes){?>				
					<tr>
						<td><?php echo conversion_formato_fecha($valorpartes['dia'], 'abreviado');?></td>
						<?php 
						$duracion = $valorpartes['total_duracion'] / 60;
						?>
						<td style='text-align: center;'><?php echo number_format(($duracion),2,',','.')."h";?></td>
						<td colspan = 7><?php echo $valorpartes['labor_realizada'];?></td>
						<td colspan = 5><?php echo $valorpartes['otros'];?></td>
					</tr>
				<?php }
			}
			?><tr>
				<td colspan=14 <?php echo $style['cab_persona']; ?>>Temas pendientes para <?php echo $clienteproyecto['cliente']." || ".$clienteproyecto['idproyecto']." - ".$clienteproyecto['proyecto'];?>:</td>
			</tr>
			<tr>
				<td style='background-color: #C0C0C0; font-size: 0.8em;'>Fecha</td>
				<td style='background-color: #C0C0C0; font-size: 0.8em;' colspan = 9>Descripci&oacute;n</td>
				<td style='background-color: #C0C0C0; font-size: 0.8em;' colspan = 2>Responsable</td>
				<td style='background-color: #C0C0C0; font-size: 0.8em;'>Plazo</td>
				<td style='background-color: #C0C0C0; font-size: 0.8em;'>OK</td>
			</tr>
			<?php
				$temas_pendientes = select_normal("SELECT * FROM kz_te_temas_pendientes WHERE responsable = '".$_POST['fil_persona']."' and proyecto = '".$clienteproyecto['idproyecto']."' and fecha >= '".$fecha_inicio."' and fecha <= '".date("Y-m-d")."' and fecha between '".$fecha_inicio."' and '".$fecha_fin."' ORDER BY ok");
				if($temas_pendientes){
					foreach($temas_pendientes as $keytemas => $valortemas){
						$tecnicos = select_normal("SELECT * FROM kz_te_personal WHERE id = '".$valortemas['responsable']."'");
						$tecnico = $tecnicos[0];
						
						if($valortemas['ok'] == '0'){
							$ok = 'NO';
						}
						if($valortemas['ok'] == '1'){
							$ok = 'SI';	
						}?>
						
						<tr>
							<td><?php echo conversion_formato_fecha($valortemas['fecha'], 'abreviado');?></td>
							<td colspan = 9><?php echo $valortemas['tema'];?></td>
							<td colspan = 2><?php echo $tecnico['nombre']." ".$tecnico['apellidos'];?></td>
							<td><?php echo conversion_formato_fecha($valortemas['plazo'], 'abreviado');?></td>
							<td><?php echo $ok;?></td>
						</tr>
					<?php }
				}
		?></table>
	<?php  
	}
	else{
		echo "<br><div class='mensaje'>Sin resultados</div>";
	}
}?>