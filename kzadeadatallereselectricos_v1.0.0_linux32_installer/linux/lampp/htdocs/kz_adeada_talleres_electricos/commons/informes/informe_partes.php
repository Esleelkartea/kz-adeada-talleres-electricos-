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
  	<h1>Informes de partes de trabajo</h1>

	<?php if(!$_POST['ini_d']){
		$_POST['ini_d'] = date('d');
		$_POST['ini_m'] = date('m');
		$_POST['ini_y'] = date('Y');
		
		$_POST['fin_d'] = date('d');
		$_POST['fin_m'] = date('m');
		$_POST['fin_y'] = date('Y');	
	}
	
	foreach($_POST as $key => $valor){
		if(substr($key,0,7)=='fil_col'){
			$filtros_columnas[count($filtros_columnas)] = $valor;
		}
	}
	if($filtros_columnas)
	$filtros_columnas_implode = implode(',',$filtros_columnas);
	$campos = $filtros_columnas_implode;
	
	//PONER CRITERIOS EN LOS INFORMES
	$criterios .= " and dia between '".date("Y-m-d",mktime(0,0,0,$_POST['ini_m'],$_POST['ini_d'],$_POST['ini_y']))."' and '".date("Y-m-d",mktime(0,0,0,$_POST['fin_m'],$_POST['fin_d'],$_POST['fin_y']))."' ";
	if($_POST['fil_persona'] != ''){
		$criterios .= " and comercial = '".$_POST['fil_persona']."' ";
	}
	if($_POST['cliente_proyecto'] != ''){
		$dividir_cliente = explode("||", $_POST['cliente_proyecto']);
		$proyecto = $dividir_cliente[1];
		$cliente = $dividir_cliente[0];
		$criterios .= " and cliente = '".$cliente."' and proyecto = '".$proyecto."'";
	}
	
	//REALIZAMOS LA CONSULTA
	$consulta = informe_partes($criterios." order by dia DESC, comercial ASC, hora_inicio ASC", $campos);?>
	
	
	<form action='index.php?menu=informes' method='POST'>
		<input type='hidden' name='pag' value='<?php echo $pag; ?>'>
		<fieldset><legend>Filtros</legend>
			<table class="tabla_sin_borde">
				<tr>
					<td width="20%">Trabajador:</td>
					<?php if(in_array(221,$datos_perfil['PERMISOS'])){ ?>
						<td>
							<select name='fil_persona'>
								<option value=''>TODOS</option>
								<?php $personal = array_personal();	
								combo_base_array_2($personal, $_POST['fil_persona']); ?>
							</select>
							<input class="bt-accion" type='submit' name='filtrar_clientes' value='Filtrar clientes'>
						</td>
					<?php }
					else{ 
						$personal = array_personal();?>
						<td>
							<input type='hidden' name="fil_persona" id="fil_persona" value='<?php echo $ID_PERSONA['id']; ?>'><?php echo $ID_PERSONA['nombre']." ".$ID_PERSONA['apellidos'];?>
							<input class="bt-accion" type='submit' name='filtrar_clientes' value='Filtrar clientes'>
						</td>
					<?php }?>
				</tr>
				<?php if(($_POST['filtrar_clientes']) || ($_POST['aplicar_filtros'])){ ?>
					<tr>
						<td>Cliente || Trabajo:</td>
						<td>
							<?php 
							if($_POST['fil_persona'] != ''){
								$criterios2 .= " and kz_te_proyecto_personal.tecnico = '".$_POST['fil_persona']."' ";
							}?>
							<select name="cliente_proyecto" id="cliente_proyecto">
								<option value=''>TODOS</option>
				         		<?php
				         		$cliente_proyecto=select_normal("SELECT distinct(kz_te_clientes.nombre_comercial), kz_te_clientes.id as idcliente, kz_te_proyectos.id as idproyecto, kz_te_proyectos.nombre FROM kz_te_clientes, kz_te_proyectos, kz_te_proyecto_personal WHERE kz_te_clientes.id = kz_te_proyectos.cliente and kz_te_proyecto_personal.proyecto = kz_te_proyectos.id and 1=1 $criterios2 ORDER BY kz_te_clientes.nombre_comercial");			      			
				      			foreach($cliente_proyecto as $keyclienteproyecto => $valorclienteproyecto){ ?>
				      				<option value='<?php echo $valorclienteproyecto['idcliente']."||".$valorclienteproyecto['idproyecto']; ?>'>
				      					<?php echo $valorclienteproyecto['nombre_comercial']; ?> || <?php echo $valorclienteproyecto['idproyecto']; ?> - <?php echo $valorclienteproyecto['nombre']; ?>
				      				</option><?php
				      			} ?>
			       			</select>
						</td>
					</tr>
					<tr>
						<td>Fecha inicial:</td>
						<td>
							<select name='ini_d'><?php combo_base_array($array_dias, $_POST['ini_d']); ?></select>
							<select name='ini_m'><?php combo_base_array($array_meses, $_POST['ini_m']); ?></select>
							<select name='ini_y'><?php combo_base_array($array_annos, $_POST['ini_y']); ?></select>
						</td>
					</tr>
					<tr>
						<td>Fecha final:</td>
						<td>
							<select name='fin_d'><?php combo_base_array($array_dias, $_POST['fin_d']); ?></select>
							<select name='fin_m'><?php combo_base_array($array_meses, $_POST['fin_m']); ?></select>
							<select name='fin_y'><?php combo_base_array($array_annos, $_POST['fin_y']); ?></select>
						<input class="bt-accion" type='submit' name='aplicar_filtros' value='Buscar'></td>
					</tr>
					<tr><td>Mostrar:</td>
						<td>
							<?php $columnas = columnas('kz_te_partes');
							foreach($columnas['partes'] as $key => $valor){
								switch ($valor['Field']){
									case 'id':
										break;
									case 'system_date':
										break;
									case 'auditoria':
										break;
									case 'tema_importante':
										break;
									case 'proyecto':
										if($OPCIONES[100]){
											?><input type='checkbox' name='fil_col_<?php echo $valor['Field']; ?>' value='<?php echo $valor['Field']; ?>' CHECKED><?php echo $valor['Comment']; ?><br><?php
										}
									break;
									
									default: ?>
									<input type='checkbox' name='fil_col_<?php echo $valor['Field']; ?>' value='<?php echo $valor['Field']; ?>' CHECKED><?php echo $valor['Comment']; ?><br><?php
								}
							}?>
						</td>
					</tr>
				<?php }?>
			</table>
		</fieldset>
	</form>
	
	<?php if($_POST['aplicar_filtros']){
		if($_POST['fil_persona']){
			$kms = select_normal("SELECT * FROM kz_te_dietas WHERE fecha between '".date("Y-m-d",mktime(0,0,0,$_POST['ini_m'],$_POST['ini_d'],$_POST['ini_y']))."' and '".date("Y-m-d",mktime(0,0,0,$_POST['fin_m'],$_POST['fin_d'],$_POST['fin_y']))."' and tecnico = '".$_POST['fil_persona']."'");
		}
		else{
			$kms = select_normal("SELECT * FROM kz_te_dietas WHERE fecha between '".date("Y-m-d",mktime(0,0,0,$_POST['ini_m'],$_POST['ini_d'],$_POST['ini_y']))."' and '".date("Y-m-d",mktime(0,0,0,$_POST['fin_m'],$_POST['fin_d'],$_POST['fin_y']))."'");
		}
		
		if($kms){
			foreach($kms as $key_km => $valor_km){
				if($valor_km['km'] > '75'){
					$horas_km = number_format((($valor_km['km'] - 75) / 70),2,'.','.');
					$horas_km_total = $horas_km_total + $horas_km;
				}
			}
		}?>
		
		<br>
		<form action='../xls/informe_partes.php' method='POST'>
			<?php foreach($_POST as $key => $valor){?>
				<input type='hidden' name='<?php echo $key; ?>' value='<?php echo $valor; ?>'>	<?php
			}?>
			<input class="bt-accion" type='submit' name='xls' value='Exportar a EXCEL'>
		</form>
		
		<?php $clientes = array_partes_clientes();
		echo "<table>";
			echo "<tr>";
				foreach($filtros_columnas as $key => $valor){
					echo "<th class='cabecera_tabla_filtros'>".$columnas['partes'][$valor]['Comment']."</th>";
				}
			echo "</tr>";
			
			$dia_actual = '';
			$persona_actual = '';
			if($consulta)
			foreach($consulta as $key => $valor){
				if($dia_actual != $valor['dia']){
					echo "<tr><td colspan=20 class='cab_fecha' ><span style='font-weight:bold;'>".conversion_formato_fecha($valor['dia'])."</span></td></tr"; 
					$dia_actual = $valor['dia'];
					$persona_actual = '';
				}
				
				echo "<tr>";
					$duracion['total'] = $duracion['total'] + $valor['total_duracion'];
					
					if($persona_actual != $valor['comercial']){
						echo "<tr><th class='cab_persona' colspan=20>".$personal[$valor['comercial']]."</th></tr>"; 
						$persona_actual = $valor['comercial'];
					}
					
					if($filtros_columnas)
					foreach($filtros_columnas as $key2 => $valor2){
						switch ($valor2){
							case 'id':
								break;
							case 'system_date':
								break;
							case 'auditoria':
								break;
							case 'tema_importante':
								break;
							case 'comercial':
								echo "<td>".$personal[$valor[$valor2]]."</td>";
								break;
							case 'cliente':
								echo "<td>".$clientes[$valor[$valor2]]."</td>";
								break;
							case 'dia':
								echo "<td>".conversion_formato_fecha($valor[$valor2],'abreviado')."</td>";
								break;
							case 'tipo_trabajo':
								echo "<td>".$ARRAY_TRABAJOS['trabajos_padre'][$valor[$valor2]]."</td>";
								break;
							case 'subtrabajo':
								echo "<td>".$valor[$valor2]."</td>";
								break;
							default:
								echo "<td>".$valor[$valor2]."</td>";
								break;
						}
					}
				echo "</tr>";
			}
			else { echo "<tr><th colspan=12><i>(No hay resultados)</i></th></tr>"; }
			$total = ($duracion['total'] / 60) + $horas_km_total;
			echo "<tr><th colspan=12> TOTAL HORAS: ".number_format($total,2,',','.')." horas (".number_format(($duracion['total'] / 60),2,',','.')."h de partes + ".$horas_km_total."h de kms)</th></td>";
		echo "</table>";
	}?>
  </div>
</div>