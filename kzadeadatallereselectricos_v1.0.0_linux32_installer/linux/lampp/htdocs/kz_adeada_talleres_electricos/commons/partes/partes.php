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
  	<h1>Partes</h1>

	<?php	
	if($_POST['cambiar_fecha']){
		$fecha_parte = $_POST['ano']."-".$_POST['mes']."-".$_POST['dia']; 
	}
	else {
		if($_POST['mantener_fecha']){
		
			$fecha_parte = $_POST['mantener_fecha']; 
		}
		else{
			$fecha_parte = date("Y-m-d"); 
		}
	}
	
	//FECHA PARTE DESGLOSADA
	$fpd = desglose_fecha_hora($fecha_parte);
	
	//PAGINACION -------------------------------
	if(!$_POST['p']){
		$limiteinf = 0;
		$limitesup = PERSONAS_MOSTRAR;
	}
	else{
		$limitesup= PERSONAS_MOSTRAR;
		$limiteinf= PERSONAS_MOSTRAR * $_POST['p'] - PERSONAS_MOSTRAR;
	}
	//FIN DE LA PAGINACION ---------------------
	
	if($_POST['anadir_parte']){
		if($_POST['comercial']){
			
			if($_POST['fin_horas'] > $_POST['inicio_horas']){
				$hora_real = comprobar_hora_ocupada_real($_POST['comercial'], $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'], $_POST['inicio_horas'].":".$_POST['inicio_minutos'], $_POST['fin_horas'].":".$_POST['fin_minutos']);
				$hora_planificada = comprobar_hora_ocupada_planificada($_POST['comercial'], $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'], $_POST['inicio_horas'].":".$_POST['inicio_minutos'], $_POST['fin_horas'].":".$_POST['fin_minutos']);
							
				if(count($hora_real) == 1){
					if(count($hora_planificada) == 1){
						$total_duracion = calcular_hora($_POST['inicio_horas'].":".$_POST['inicio_minutos'],$_POST['fin_horas'].":".$_POST['fin_minutos']);
						if(!$_POST['cliente_proyecto']){
							$mensaje .=  "<hr>ERROR. No has seleccionado el cliente || trabajo<hr>";
						}
						else{
							$clienteproyecto = explode("||",$_POST['cliente_proyecto']);
							if(!$_POST['tipo_trabajo']){
								$mensaje .=  "<hr>ERROR. No has seleccionado el tipo de trabajo<hr>";
							}
							else{
								if($_POST['tipo_trabajo'] == '1'){
									if($_POST['subtrabajo_gisma']){
										$subtrabajo = $_POST['subtrabajo_gisma'];
									}
									if($_POST['subtrabajo_gisma_nuevo']){
										$subtrabajo = $_POST['subtrabajo_gisma_nuevo'];
									}
								}
								if($_POST['tipo_trabajo'] == '6'){
									$subtrabajo = $_POST['subtrabajo_otros'];
								}
								$insertar_parte = ejecutar_query("INSERT INTO kz_te_partes VALUES(null, '".$_POST['comercial']."', '".$clienteproyecto[0]."', '".$_POST['provincia']."', '".$clienteproyecto[1]."', '".$_POST['ano']."-".$_POST['mes']."-".$_POST['dia']."', '".$_POST['inicio_horas'].":".$_POST['inicio_minutos']."', '".$_POST['fin_horas'].":".$_POST['fin_minutos']."', '".$total_duracion."', '".$_POST['tipo_trabajo']."', '".$subtrabajo."', '".$_POST['labor_realizada']."', '".$_POST['otros']."', 0, '".date('Y-m-d H:i:s')."')");
								$mensaje .=  "<hr>Se ha a&ntilde;adido el parte<hr>";
							}
						}
					}
					else{
						$mensaje .=  "<hr>ERROR. Existen partes planificadas para ese rango de hora<hr>";
					}
				}
				else{
					$mensaje .=  "<hr>ERROR. Ya existen partes para ese rango de hora<hr>";
				}
			}
			else{
				if($_POST['fin_horas'] < $_POST['inicio_horas']){
					$mensaje .=  "<hr>ERROR. La hora final debe ser mayor a la hora inicial<hr>";
				}
				else{
					if($_POST['fin_minutos'] > $_POST['inicio_minutos']){
						$hora_real = comprobar_hora_ocupada_real($_POST['comercial'], $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'], $_POST['inicio_horas'].":".$_POST['inicio_minutos'], $_POST['fin_horas'].":".$_POST['fin_minutos']);
						$hora_planificada = comprobar_hora_ocupada_planificada($_POST['comercial'], $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'], $_POST['inicio_horas'].":".$_POST['inicio_minutos'], $_POST['fin_horas'].":".$_POST['fin_minutos']);
					
						if(count($hora_real) == 1){
							if(count($hora_planificada) == 1){
								$total_duracion = calcular_hora($_POST['inicio_horas'].":".$_POST['inicio_minutos'],$_POST['fin_horas'].":".$_POST['fin_minutos']);
								if(!$_POST['cliente_proyecto']){
									$mensaje .=  "<hr>ERROR. No has seleccionado el cliente || trabajo<hr>";
								}
								else{
									$clienteproyecto = explode("||",$_POST['cliente_proyecto']);
									if(!$_POST['tipo_trabajo']){
										$mensaje .=  "<hr>ERROR. No has seleccionado el tipo de trabajo<hr>";
									}
									else{
										if($_POST['tipo_trabajo'] == '1'){
											if($_POST['subtrabajo_gisma']){
												$subtrabajo = $_POST['subtrabajo_gisma'];
											}
											if($_POST['subtrabajo_gisma_nuevo']){
												$subtrabajo = $_POST['subtrabajo_gisma_nuevo'];
											}
										}
										if($_POST['tipo_trabajo'] == '5'){
											$subtrabajo = $_POST['subtrabajo_otros'];
										}
										$insertar_parte = ejecutar_query("INSERT INTO kz_te_partes VALUES(null, '".$_POST['comercial']."', '".$clienteproyecto[0]."', '".$_POST['provincia']."', '".$clienteproyecto[1]."', '".$_POST['ano']."-".$_POST['mes']."-".$_POST['dia']."', '".$_POST['inicio_horas'].":".$_POST['inicio_minutos']."', '".$_POST['fin_horas'].":".$_POST['fin_minutos']."', '".$total_duracion."', '".$_POST['tipo_trabajo']."', '".$subtrabajo."', '".$_POST['labor_realizada']."', '".$_POST['otros']."', 0, '".date('Y-m-d H:i:s')."')");
										$mensaje .=  "<hr>Se ha a&ntilde;adido el parte<hr>";
									}
								}
							}
							else{
								$mensaje .=  "<hr>ERROR. Existen partes planificadas para ese rango de hora<hr>";
							}
						}
						else{
							$mensaje .=  "<hr>ERROR. Ya existen partes para ese rango de hora<hr>";
						}
					}
					else{
						if($_POST['fin_minutos'] < $_POST['inicio_minutos']){
							$mensaje .=  "<hr>ERROR. La hora final debe ser mayor a la hora inicial<hr>";
						}
						else{
							$mensaje .=  "<hr>ERROR. La hora inicial y la hora final no pueden coincidir<hr>";
						}
					}		
				}
			}
		}
		else{
			$mensaje .=  "<hr>ERROR. No has seleccionado el comercial<hr>";
		}
	}
	
	if($_POST['editar_parte']){
		if($_POST['comercial']){
			$total_duracion = calcular_hora($_POST['inicio_horas'].":".$_POST['inicio_minutos'],$_POST['fin_horas'].":".$_POST['fin_minutos']);
			$clienteproyecto = explode("||",$_POST['cliente_proyecto']);		
			if($_POST['tipo_trabajo'] == '1'){
				if($_POST['subtrabajo_gisma']){
					$subtrabajo = $_POST['subtrabajo_gisma'];
				}
				if($_POST['subtrabajo_gisma_nuevo']){
					$subtrabajo = $_POST['subtrabajo_gisma_nuevo'];
				}
			}
			if($_POST['tipo_trabajo'] == '6'){
				$subtrabajo = $_POST['subtrabajo_otros'];
			}
			
			$editar_parte = ejecutar_query("UPDATE kz_te_partes SET
			comercial = '".$_POST['comercial']."',
			cliente = '".$clienteproyecto[0]."',
			provincia = '".$_POST['provincia']."',
			proyecto = '".$clienteproyecto[1]."',
			dia = '".$_POST['ano']."-".$_POST['mes']."-".$_POST['dia']."',
			hora_inicio = '".$_POST['inicio_horas'].":".$_POST['inicio_minutos']."',
			hora_fin = '".$_POST['fin_horas'].":".$_POST['fin_minutos']."',
			total_duracion = '".$total_duracion."',
			tipo_trabajo = '".$_POST['tipo_trabajo']."',
			subtrabajo = '".$subtrabajo."',
			labor_realizada = '".$_POST['labor_realizada']."',
			otros = '".$_POST['otros']."'
			where id = ".$_POST['id']."");
		
			$mensaje .=  "<hr>Se ha editado el parte<hr>";
		}
		else{
			$mensaje .=  "<hr>ERROR. No has seleccionado el comercial<hr>";
		}
	}
	
	if($_POST['eliminar_parte']){
		$eliminar_parte = ejecutar_query("DELETE FROM kz_te_partes WHERE id = ".$_POST['id']."");
		
		$mensaje .=  "<hr>Se ha eliminado el parte<hr>";
	}
	?>
	
	<div class='mensaje'><?php  echo $mensaje; ?></div>
	
	<?php 
	switch ($_POST['seleccion_formulario']){
		case 'anadir_parte':
			include("../commons/partes/partes/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		case 'editar_parte':
			include("../commons/partes/partes/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		case 'eliminar_parte':
			include("../commons/partes/partes/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		case 'ver_ficha':
			include("../commons/partes/partes/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		default:
			
			$partes = select_normal("SELECT a.*, b.nombre as nombrecomercial, b.apellidos as apellidoscomercial FROM kz_te_partes a, kz_te_personal b WHERE 1=1 and a.comercial=b.id ORDER BY  a.dia DESC, a.hora_inicio  LIMIT $limiteinf, $limitesup");
			?>
			
			<br>
			<form action='index.php?menu=administracion_partes' method='post'>
				<input class="bt-nuevo-documento" type='submit' name='accion' value='A&ntilde;adir parte'>
				<input type='hidden' name='seleccion_formulario' value='anadir_parte'>
				<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
			</form>
			
			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<th>Trabajador</th>
					<th>Cliente</th>
					<th>D&iacute;a</th>
					<th>Tipo de trabajo</th>
					
				</tr>
				
				<?php
				if($partes){
				foreach($partes as $key => $valor){?>
					<tr>
						<td><?php echo $valor['nombrecomercial']; ?> <?php echo $valor['apellidoscomercial']; ?></td>
						<td><?php echo $PARTES_CLIENTES[$valor['cliente']]; ?></td>
						<td><?php echo $valor['dia']; ?></td>
						<td><?php echo $ARRAY_TRABAJOS['trabajos_padre'][$valor['tipo_trabajo']]; ?> 
							<?php if($valor['tipo_trabajo'] == '6'){ 
								if ($valor['subtrabajo'] != ''){ ?>
									=> <?php echo $valor['subtrabajo'];
								}
							}?>
						</td>
						<td>
							<form action='index.php?menu=administracion_partes' method='POST'>
								<input class="bt-editar" type='submit' name='accion' value='Editar'>
								<input type='hidden' name='seleccion_formulario' value='editar_parte'></input>
								<input type='hidden' name='id' value='<?php echo $valor['id']; ?>'></input>
								<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
								<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
							</form>
						</td>
						<td>
							<form action='index.php?menu=administracion_partes' method='POST'>
								<input class="bt-eliminar" type='submit' name='accion' value='Eliminar'>
								<input type='hidden' name='seleccion_formulario' value='eliminar_parte'>
								<input type='hidden' name='id' value='<?php  echo $valor['id']; ?>' />
								<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
								<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
							</form>
						</td>
					</tr>
							
				<?php }
				} 
				else { ?>
					<tr>
						<td colspan=4>
							<?php echo "<i>(No hay ning&uacute;n parte)</i>"; ?>
						</td>
					</tr>
				<?php } ?>
			</table>
			
			<?php if($partes){ ?>
				<form action='index.php?menu=administracion_partes' method='POST'>
					<select class="select-comun" name='p'>
						<?php
						paginacion("SELECT COUNT(id) as total FROM kz_te_partes WHERE 1 = 1 $criterios",PERSONAS_MOSTRAR, $_POST['p']);
						?>	
					</select>
					<input class="bt-accion" type='submit' name='accion' value='IR' /> 
					<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
				</form>
			<?php }
			break;
	}?>
  </div>
</div>