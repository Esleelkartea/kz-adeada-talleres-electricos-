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
?>
<div id="cuerpo">
  <div id="contenido">
	<h1>Informes de trabajos</h1>

	<form action='index.php?menu=informes' method='POST'>
		<input type='hidden' name='pag' value='<?php echo $pag; ?>'>
		<fieldset><legend>Filtros</legend>
			<table class="tabla_sin_borde">
				<tr>
					<td width="20%">Trabajador:</td>
					<?php if(in_array(221,$datos_perfil['PERMISOS'])){ ?>
						<td >
							<select name='fil_persona'>
								<?php $personal = array_personal();
								combo_base_array_2($personal, $_POST['fil_persona']); ?>
							</select>
							<input class="bt-accion"  type='submit' name='filtrar_clientes' value='Filtrar clientes'>
						</td>
					<?php }
					else{
						$personal = array_personal();?>
						<td>
							<input type='hidden' name="fil_persona" id="fil_persona" value='<?php echo $ID_PERSONA['id']; ?>'><?php echo $ID_PERSONA['nombre']." ".$ID_PERSONA['apellidos'];?>
							<input class="bt-accion"  type='submit' name='filtrar_clientes' value='Filtrar clientes'>
						</td>
					<?php }?>
				</tr>
				<?php if(($_POST['filtrar_clientes']) || ($_POST['aplicar_filtros'])){ ?>
					<tr>
						<td>Cliente || Trabajo:</td>
						<td>
							<select name="cliente_proyecto" id="cliente_proyecto">
				         		<?php
				         		$cliente_proyecto=select_normal("SELECT kz_te_clientes.id as idcliente, kz_te_clientes.nombre_comercial, kz_te_proyectos.id as idproyecto, kz_te_proyectos.nombre FROM kz_te_clientes, kz_te_proyectos, kz_te_proyecto_personal WHERE kz_te_clientes.id = kz_te_proyectos.cliente and kz_te_proyecto_personal.proyecto = kz_te_proyectos.id and kz_te_proyecto_personal.tecnico = '".$_POST['fil_persona']."' ORDER BY kz_te_clientes.nombre_comercial");
				      			foreach($cliente_proyecto as $keyclienteproyecto => $valorclienteproyecto){ ?>
				      				<option value='<?php echo $valorclienteproyecto['idcliente']."||".$valorclienteproyecto['idproyecto']; ?>'>
				      					<?php echo $valorclienteproyecto['nombre_comercial']; ?> || <?php echo $valorclienteproyecto['idproyecto']; ?> - <?php echo $valorclienteproyecto['nombre']; ?>
				      				</option><?php
				      			} ?>
			       			</select>
						</td>
					</tr>
					<tr>
						<td>A&ntilde;o:</td>
						<?php if($_POST['anno'] != ''){?>
							<td><select name='anno'><?php combo_base_array($array_annos, $_POST['anno']); ?></select>
						<?php }
						else{?>
							<td><select name='anno'><?php combo_base_array($array_annos, date('Y')); ?></select>
						<?php }?>
						<input class="bt-accion"  type='submit' name='aplicar_filtros' value='Buscar'></td>
					</tr>
				<?php }?>
			</table>
		</fieldset>
	</form>
	
	<?php if(($_POST['aplicar_filtros']) || ($_POST['volver_informe'])){
		$mostrar_tecnico = select_normal("SELECT nombre, apellidos FROM kz_te_personal WHERE id = '".$_POST['fil_persona']."'");
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
		
			<br>
			<form action='../xls/informe_proyectos.php' method='POST'>
				<?php foreach($_POST as $key => $valor){
					?><input type='hidden' name='<?php echo $key; ?>' value='<?php echo $valor; ?>'>	<?php
				}
				?>
				<input class="bt-accion" type='submit' name='xls' value='Exportar a EXCEL'>
			</form>

			<table class='tabla_resultado_informe' width='100%'>
				<tr>
					<td colspan=14 class='cabecera_tabla_filtros'><?php echo $tecnico['nombre']." ".$tecnico['apellidos'];?></td>
				</tr>
				<tr>
					<td colspan=6 class='cab_persona'><?php echo $clienteproyecto['cliente']." || ".$clienteproyecto['idproyecto']." - ".$clienteproyecto['proyecto'];?></td>
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
					<td style='font-size: 0.6em; background-color: #ECEAEA;'>ENERO</td>
					<td style='font-size: 0.6em; background-color: #ECEAEA;'>FEBRERO</td>
					<td style='font-size: 0.6em; background-color: #ECEAEA;'>MARZO</td>
					<td style='font-size: 0.6em; background-color: #ECEAEA;'>ABRIL</td>
					<td style='font-size: 0.6em; background-color: #ECEAEA;'>MAYO</td>
					<td style='font-size: 0.6em; background-color: #ECEAEA;'>JUNIO</td>
					<td style='font-size: 0.6em; background-color: #ECEAEA;'>JULIO</td>
					<td style='font-size: 0.6em; background-color: #ECEAEA;'>AGOSTO</td>
					<td style='font-size: 0.6em; background-color: #ECEAEA;'>SEPTIEMBRE</td>
					<td style='font-size: 0.6em; background-color: #ECEAEA;'>OCTUBRE</td>
					<td style='font-size: 0.6em; background-color: #ECEAEA;'>NOVIEMBRE</td>
					<td style='font-size: 0.6em; background-color: #ECEAEA;'>DICIEMBRE</td>
					<td class='cab_persona'>TOTALES</td>
				</tr>

				<tr>
					<td style='background-color: #ECEAEA;'>H. totales</td>
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
					<td style='background-color: #ECEAEA; font-weight: bold; text-align: center;'>
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
					<td colspan=14 class='cab_persona'>Partes de <?php echo $tecnico['nombre']." ".$tecnico['apellidos'];?> para <?php echo $clienteproyecto['cliente']." || ".$clienteproyecto['idproyecto']." - ".$clienteproyecto['proyecto'];?>:</td>
				</tr>
				<tr>
					<td style='background-color: #ECEAEA;'>Fecha</td>
					<td style='background-color: #ECEAEA;'>Duraci&oacute;n</td>
					<td style='background-color: #ECEAEA;' colspan = 7>Labor realizada</td>
					<td style='background-color: #ECEAEA;' colspan = 5>Otros</td>
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
					<td colspan=14 class='cab_persona'>Temas pendientes para <?php echo $clienteproyecto['cliente']." || ".$clienteproyecto['idproyecto']." - ".$clienteproyecto['proyecto'];?>:</td>
				</tr>
				<tr>
					<td style='background-color: #ECEAEA;'>Fecha</td>
					<td style='background-color: #ECEAEA;' colspan = 9>Descripci&oacute;n</td>
					<td style='background-color: #ECEAEA;' colspan = 2>Responsable</td>
					<td style='background-color: #ECEAEA;'>Plazo</td>
					<td style='background-color: #ECEAEA;'>OK</td>
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
  </div>
</div>