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

//PAGINACION -----------------------------------------------------
if(!$_POST['p']){
	$limiteinf = 0;
	$limitesup = PERSONAS_MOSTRAR;
}
else{
	$limitesup= PERSONAS_MOSTRAR;
	$limiteinf= PERSONAS_MOSTRAR * $_POST['p'] - PERSONAS_MOSTRAR;
	
}
//FIN DE LA PAGINACION -------------------------------------------
?>

<div id="cuerpo">
  <div id="contenido">
  	<h1>Parte diario <?php echo $fecha_parte; ?></h1>
  	<br />
	<form action='index.php?menu=administracion_partes' method='POST'>
		Seleccionar fecha:
					<select class="select-comun" name="dia"  id="dia" >
	         			<?php	
	      				combo_base_array($array_dias,$fpd["d"]);
	      				?>
	        		</select> - 
	        		<select class="select-comun" name="mes"  id="mes" >
	         			<?php	
	      				combo_base_array($array_meses,$fpd["m"]);
	      				?>
	        		</select> -
	
	        		<select class="select-comun" name="ano"  id="ano" >
	         			<?php	
	      				combo_base_array($array_annos,$fpd["Y"]);
	      				?>
	        		</select>
		<input class="bt-accion" type='submit' name='cambiar_fecha' value='Ir a fecha'> <input class="bt-accion" type='submit' name='hoy' value='Hoy'>
		<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
	</form>
	
	<?php 
	//PERMISO Asignar cualquier persona en el parte P221
	if(!in_array(221,$datos_perfil['PERMISOS'])){ 
		$_POST['comercial'] = $ID_PERSONA['id'];
	}
	// FIN P221
	
	if($_POST['anadir_parte']){
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
				$mensaje .=  "<hr>ERROR. Ya existen partes para este rango de hora<hr>";
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
									$insertar_parte = ejecutar_query("INSERT INTO kz_te_partes VALUES(null, '".$_POST['comercial']."', '".$clienteproyecto[0]."', '".$_POST['provincia']."', '".$clienteproyecto[1]."', '".$_POST['ano']."-".$_POST['mes']."-".$_POST['dia']."', '".$_POST['inicio_horas'].":".$_POST['inicio_minutos']."', '".$_POST['fin_horas'].":".$_POST['fin_minutos']."', '".$total_duracion."', '".$_POST['tipo_trabajo']."', '".$subtrabajo."', '".$_POST['labor_realizada']."', '".$_POST['otros']."', 0,'".date('Y-m-d H:i:s')."')");
									$mensaje .=  "<hr>Se ha a&ntilde;adido el parte<hr>";
								}
							}
						}
						else{
							$mensaje .=  "<hr>ERROR. Existen partes planificadas para ese rango de hora<hr>";
						}
					}
					else{
						$mensaje .=  "<hr>ERROR. Ya existen partes para este rango de hora<hr>";
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
	
	if($_POST['editar_parte']){
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
		if($_POST['tipo_trabajo'] == '5'){
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
	
	if($_POST['eliminar_parte']){
		$eliminar_parte = ejecutar_query("DELETE FROM kz_te_partes WHERE id = ".$_POST['id']."");
		
		$mensaje .=  "<hr>Se ha eliminado el parte<hr>";
	}
	
	if($_POST['anadir_dietas']){
		if($_POST['km'] > '75'){	
			$horas_dietas = number_format((($_POST['km'] - 75) / 70),2,'.','.');
		}
		
		$km = str_replace(",", ".", $_POST['km']);
		$parking = str_replace(",", ".", $_POST['parking']);
		$peajes = str_replace(",", ".", $_POST['peajes']);
		$comidas = str_replace(",", ".", $_POST['comidas']);
		$otros = str_replace(",", ".", $_POST['otros']);
		
		$anadir_dietas = ejecutar_query("INSERT INTO kz_te_dietas VALUES(null, '".$ID_PERSONA['id']."', '".$_POST['ano']."-".$_POST['mes']."-".$_POST['dia']."', '".$km."', '".$parking."', '".$peajes."', '".$comidas."', '".$otros."', '".$_POST['observaciones']."', '".$horas_dietas."')");
		
		$mensaje .=  "<hr>Se han a&ntilde;adido las dietas<hr>";
	}
	
	if($_POST['editar_dietas']){
		
		if($_POST['km'] > '75'){	
			$horas_dietas = number_format((($_POST['km'] - 75) / 70),2,'.','.');
		}
		
		$editar_editas = ejecutar_query("UPDATE kz_te_dietas SET
		fecha = '".$_POST['ano']."-".$_POST['mes']."-".$_POST['dia']."',
		km = '".$_POST['km']."',
		parking = '".$_POST['parking']."',
		peajes = '".$_POST['peajes']."',
		comidas = '".$_POST['comidas']."',
		otros = '".$_POST['otros']."',
		observaciones = '".$_POST['observaciones']."',
		horas = '".$horas_dietas."'
		where id = ".$_POST['id']."");
		
		$mensaje .=  "<hr>Se han editado las dietas<hr>";
	}
	
	if($_POST['eliminar_dietas']){
		$eliminar_dietas = ejecutar_query("DELETE FROM kz_te_dietas WHERE id = ".$_POST['id']."");
		
		$mensaje .=  "<hr>Se han eliminado las dietas<hr>";
	}
	?>
	
	<br><div class='mensaje'><?php  echo $mensaje; ?></div><br>
	
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
			
		case 'anadir_dietas':
			include("../commons/partes/dietas/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		case 'editar_dietas':
			include("../commons/partes/dietas/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		case 'eliminar_dietas':
			include("../commons/partes/dietas/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		default:
			$partes = select_normal("SELECT a.id as idparte, a.*, b.nombre as nombrecomercial, b.apellidos as apellidoscomercial, a.tipo_trabajo FROM kz_te_partes a, kz_te_personal b WHERE 1=1 and a.comercial=b.id and dia = '$fecha_parte' and comercial = ".$ID_PERSONA['id']." ORDER BY a.hora_inicio");
			?><form action='index.php?menu=administracion_partes' method='post'>
				<input type='hidden' name='mantener_fecha' value='<?php echo $fecha_parte; ?>'>
				<input class="bt-nuevo-documento" type='submit' name='accion' value='A&ntilde;adir parte'>
				<input type='hidden' name='seleccion_formulario' value='anadir_parte'>
				<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
			</form>
			
			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<th>Hora</th>
					<th>Cliente</th>
					<th>Tipo de trabajo</th>
				</tr>
							
				<?php
				if($partes){
				foreach($partes as $key => $valor){ ?>
					<tr>
						<td><?php echo $valor['hora_inicio']." - ".$valor['hora_fin']; ?></td>
						<td><?php echo $PARTES_CLIENTES[$valor['cliente']]; ?></td>
						<td><?php echo $ARRAY_TRABAJOS['trabajos_padre'][$valor['tipo_trabajo']]; ?> 
							<?php if(($valor['tipo_trabajo'] == '1') or ($valor['tipo_trabajo'] == '5')){ 
								if ($valor['subtrabajo'] != ''){ ?>
									=> <?php echo $valor['subtrabajo'];
								}
							}?>
						</td>
						<td>
							<form action='index.php?menu=administracion_partes' method='POST'>
								<input class="bt-editar" type='submit' name='accion' value='Editar'>
								<input type='hidden' name='mantener_fecha' value='<?php echo $fecha_parte; ?>'>
								<input type='hidden' name='seleccion_formulario' value='editar_parte'></input>
								<input type='hidden' name='id' value='<?php echo $valor['id']; ?>'></input>
								<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
								<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
							</form>
						</td>
						<td>
							<form action='index.php?menu=administracion_partes' method='POST'>
								<input class="bt-eliminar" type='submit' name='accion' value='Eliminar'>
								<input type='hidden' name='mantener_fecha' value='<?php echo $fecha_parte; ?>'>
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
						<td colspan=3>
							<?php echo "<i>(No hay ning&uacute;n parte)</i>"; ?>
						</td>
					</tr>
				<?php } ?>
			</table>
			<?php 
			$calcular_horas_jornada = select_normal("SELECT sum(total_duracion) as horas_jornada FROM kz_te_partes WHERE dia = '".$fecha_parte."' and comercial = '".$ID_PERSONA['id']."'");
			$calcular_horas_km = select_normal("SELECT sum(horas) as horas_km FROM kz_te_dietas WHERE fecha = '".$fecha_parte."' and tecnico = '".$ID_PERSONA['id']."'");
			$horas_jornada = $calcular_horas_jornada[0];
			$horas_km = $calcular_horas_km[0];
			?>
			
			<h2>Horas totales de la jornada:	
			<?php 
			$horas_partes = number_format(($horas_jornada['horas_jornada'] / 60),2,'.','.');
			$horas = $horas_partes + $horas_km['horas_km'];
			echo $horas."h";
			?></h2>
		
			
			<?php 
			$dietas = select_normal("SELECT * FROM kz_te_dietas WHERE fecha = '".$fecha_parte."' and tecnico = '".$ID_PERSONA['id']."'");
			?>
			
			
			<form action='index.php?menu=administracion_partes' method='post'>
				<input type='hidden' name='mantener_fecha' value='<?php echo $fecha_parte; ?>'>
				<input class="bt-nuevo-documento" type='submit' name='accion' value='A&ntilde;adir dietas'>
				<input type='hidden' name='seleccion_formulario' value='anadir_dietas'>
				<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
			</form>
			
			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<th>Km</th>
					<th>Parking / O.T.A.</th>
					<th>Peajes</th>
					<th>Comidas</th>
					<th>Otros</th>
					<th>Observaciones (otros)</th>
				</tr>
							
				<?php
				if($dietas){
				foreach($dietas as $key => $valor){ ?>
					<tr>
						<td><?php echo number_format(($valor['km']),2,',','.'); ?>km</td>
						<td><?php echo number_format(($valor['parking']),2,',','.'); ?>&euro;</td>
						<td><?php echo number_format(($valor['peajes']),2,',','.'); ?>&euro;</td>
						<td><?php echo number_format(($valor['comidas']),2,',','.'); ?>&euro;</td>
						<td><?php echo number_format(($valor['otros']),2,',','.'); ?>&euro;</td>
						<td><?php echo $valor['observaciones']; ?></td>
						<td>
							<form action='index.php?menu=administracion_partes' method='POST'>
								<input class="bt-editar" type='submit' name='accion' value='Editar'>
								<input type='hidden' name='mantener_fecha' value='<?php echo $fecha_parte; ?>'>
								<input type='hidden' name='seleccion_formulario' value='editar_dietas'></input>
								<input type='hidden' name='id' value='<?php echo $valor['id']; ?>'></input>
								<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
							</form>
						</td>
						<td>
							<form action='index.php?menu=administracion_partes' method='POST'>
								<input class="bt-eliminar" type='submit' name='accion' value='Eliminar'>
								<input type='hidden' name='mantener_fecha' value='<?php echo $fecha_parte; ?>'>
								<input type='hidden' name='seleccion_formulario' value='eliminar_dietas'>
								<input type='hidden' name='id' value='<?php  echo $valor['id']; ?>' />
								<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
							</form>
						</td>
					</tr>		
				<?php }
				}
				else { ?>
					<tr>
						<td colspan=6>
							<?php echo "<i>(No est&aacute;n a&ntilde;adidas las dietas)</i>"; ?>
						</td>
					</tr>
				<?php } ?>
			</table>
			
			<?php 
			break;
	}?>
  </div>
</div>