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
  	<h1>Planificaci&oacute;n <?php echo $fecha_parte; ?></h1>
	<br />
	<form action='index.php?menu=planificacion' method='POST'>
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
	
	if($_POST['anadir_planificacion']){	
		if($_POST['fin_horas'] > $_POST['inicio_horas']){
			$hora_real = comprobar_hora_ocupada_planificacion_real($_POST['comercial'], $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'], $_POST['inicio_horas'].":".$_POST['inicio_minutos'], $_POST['fin_horas'].":".$_POST['fin_minutos']);
			$hora_planificada = comprobar_hora_ocupada_planificacion_planificada($_POST['comercial'], $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'], $_POST['inicio_horas'].":".$_POST['inicio_minutos'], $_POST['fin_horas'].":".$_POST['fin_minutos']);
			
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
							if($_POST['tipo_trabajo'] == '6'){
								$subtrabajo = $_POST['subtrabajo_otros'];
							}
							If($_POST['tema_importante']!=''){
								$tema_importante=1;
							}
							else{
								$tema_importante=0;
							}
							$insertar_parte = ejecutar_query("INSERT INTO kz_te_planificacion_partes VALUES(null, '".$_POST['comercial']."', '".$clienteproyecto[0]."', '".$_POST['provincia']."', '".$clienteproyecto[1]."', '".$_POST['ano']."-".$_POST['mes']."-".$_POST['dia']."', '".$_POST['inicio_horas'].":".$_POST['inicio_minutos']."', '".$_POST['fin_horas'].":".$_POST['fin_minutos']."', '".$total_duracion."', '".$_POST['tipo_trabajo']."', '".$subtrabajo."', '".$_POST['labor_realizada']."', '".$_POST['otros']."', '".$tema_importante."', '".date('Y-m-d H:i:s')."')");
							$mensaje .=  "<hr>Se ha a&ntilde;adido el parte<hr>";
						}
					}
				}
				else{
					$mensaje .=  "<hr>ERROR. Ya existen partes para este rango de hora<hr>";
				}
			}
			else{
				$mensaje .=  "<hr>ERROR. Existen partes reales para ese rango de hora<hr>";
			}
		}
		else{
			if($_POST['fin_horas'] < $_POST['inicio_horas']){
				$mensaje .=  "<hr>ERROR. La hora final debe ser mayor a la hora inicial<hr>";
			}
			else{
				if($_POST['fin_minutos'] > $_POST['inicio_minutos']){
					$hora_real = comprobar_hora_ocupada_planificacion_real($_POST['comercial'], $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'], $_POST['inicio_horas'].":".$_POST['inicio_minutos'], $_POST['fin_horas'].":".$_POST['fin_minutos']);
					$hora_planificada = comprobar_hora_ocupada_planificacion_planificada($_POST['comercial'], $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'], $_POST['inicio_horas'].":".$_POST['inicio_minutos'], $_POST['fin_horas'].":".$_POST['fin_minutos']);
			
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
									if($_POST['tipo_trabajo'] == '6'){
										$subtrabajo = $_POST['subtrabajo_otros'];
									}
									If($_POST['tema_importante']!=''){
										$tema_importante=1;
									}
									else{
										$tema_importante=0;
									}
									$insertar_parte = ejecutar_query("INSERT INTO kz_te_planificacion_partes VALUES(null, '".$_POST['comercial']."', '".$clienteproyecto[0]."', '".$_POST['provincia']."', '".$clienteproyecto[1]."', '".$_POST['ano']."-".$_POST['mes']."-".$_POST['dia']."', '".$_POST['inicio_horas'].":".$_POST['inicio_minutos']."', '".$_POST['fin_horas'].":".$_POST['fin_minutos']."', '".$total_duracion."', '".$_POST['tipo_trabajo']."', '".$subtrabajo."', '".$_POST['labor_realizada']."', '".$_POST['otros']."', '".$tema_importante."', '".date('Y-m-d H:i:s')."')");
									$mensaje .=  "<hr>Se ha a&ntilde;adido el parte<hr>";
								}
							}
						}
						else{
							$mensaje .=  "<hr>ERROR. Ya existen partes para este rango de hora<hr>";
						}
					}
					else{
						$mensaje .=  "<hr>ERROR. Existen partes reales para ese rango de hora<hr>";
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
	
	if($_POST['editar_planificacion']){
		$total_duracion = calcular_hora($_POST['inicio_horas'].":".$_POST['inicio_minutos'],$_POST['fin_horas'].":".$_POST['fin_minutos']);
		$clienteproyecto = explode("||",$_POST['cliente_proyecto']);
		if($_POST['tipo_trabajo'] == '6'){
			$subtrabajo = $_POST['subtrabajo_otros'];
		}
			
		If($_POST['tema_importante']!=''){
			$tema_importante=1;
		}
		else{
			$tema_importante=0;
		}
		
		$editar_parte = ejecutar_query("UPDATE kz_te_planificacion_partes SET
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
		otros = '".$_POST['otros']."',
		tema_importante = '".$tema_importante."'
		where id = ".$_POST['id']."");
		
		$mensaje .=  "<hr>Se ha editado el parte<hr>";
	}
	
	if($_POST['eliminar_planificacion']){
		$eliminar_parte = ejecutar_query("DELETE FROM kz_te_planificacion_partes WHERE id = ".$_POST['id']."");
		
		$mensaje .=  "<hr>Se ha eliminado el parte<hr>";
	}
	
	//INFORMACION DE LOS PROYECTOS
	$PROYECTOS = select_normal("Select p.*, c.nombre_comercial from kz_te_proyectos p, kz_te_proyecto_personal a, kz_te_clientes c where p.cliente=c.id and p.finalizado = 0 and a.tecnico = ".$ID_PERSONA['id']." and p.id = a.proyecto order by prioridad",'id');
	if($PROYECTOS)
	foreach($PROYECTOS as $key => $valor) $in_proyectos .= ",'$key'"; $in_proyectos = substr($in_proyectos,1,strlen($in_proyectos));
	$partes = select_normal("(SELECT 'real' as 'TIPO', kz_te_partes.* FROM kz_te_partes where kz_te_partes.dia < '".date("Y-m-d")."' and kz_te_partes.comercial = ".$ID_PERSONA['id'].") 
		UNION
		(SELECT 'planificado' as 'TIPO', kz_te_planificacion_partes.* FROM kz_te_planificacion_partes WHERE kz_te_planificacion_partes.dia >= '".date("Y-m-d")."' and kz_te_planificacion_partes.comercial = ".$ID_PERSONA['id'].")");
	?>
	
	<br>
	<table width="100%" border="1" cellpadding="0" cellspacing="0">
		<tr>
			<th>Cliente</th>
			<th>Trabajo</th>
			<th>Prioridad</th>
			<th>Fecha fin</th>
			<th>Horas</th>
			<th>Horas pendientes</th>
		</tr>
		
		<?php if($PROYECTOS){
			foreach ($PROYECTOS as $key => $valor){
				$h_pendientes = horas_pendientes($valor['horas_auditoria'], $valor['id'], $ID_PERSONA['id']);	
			?>
			<tr>
				<td><?php echo $valor['nombre_comercial'];?></td>
				<td><?php echo $valor['id']." || ".$valor['nombre'];?></td>
				<td><?php echo $valor['prioridad'];?></td>
				<td><?php echo $valor['fecha_prevista'];?></td>
				<td><?php echo $valor['horas_auditoria'];?></td>
				<td><?php echo number_format(($h_pendientes),2,',','.')."h";?></td>
			</tr>
			<?php
		 	}
		}
		else{ ?>
			<tr>
				<td colspan=9>
					<?php echo "<i>(No hay ning&uacute;n trabajo)</i>"; ?>
		
				</td>
			</tr>
		<?php }?>
	</table>
	<br>
	
	<div class='mensaje'><?php  echo $mensaje; ?></div>
	
	<?php
	switch ($_POST['seleccion_formulario']){
		case 'anadir_planificacion':
			include("../commons/planificacion/planificacion/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		case 'editar_planificacion':
			include("../commons/planificacion/planificacion/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		case 'eliminar_planificacion':
			include("../commons/planificacion/planificacion/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		case 'ver_ficha':
			include("../commons/planificacion/planificacion/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		default:
	
			//$planificacion_partes = select_normal("SELECT a.id as idparte, a.*, b.nombre as nombrecomercial, b.apellidos as apellidoscomercial, a.tipo_trabajo FROM kz_te_planificacion_partes a, kz_te_personal b WHERE 1=1 and a.comercial=b.id and dia = '$fecha_parte' and comercial = ".$ID_PERSONA['id']." ORDER BY a.hora_inicio LIMIT $limiteinf, $limitesup");
			$planificacion_partes = select_normal("SELECT a.id as idparte, a.*, b.nombre as nombrecomercial, b.apellidos as apellidoscomercial, a.tipo_trabajo FROM kz_te_planificacion_partes a, kz_te_personal b WHERE 1=1 and a.comercial=b.id and dia = '$fecha_parte' and comercial = ".$ID_PERSONA['id']." ORDER BY a.hora_inicio"); ?>
			
			<br>
			<form action='index.php?menu=planificacion' method='post'>
				<input type='hidden' name='mantener_fecha' value='<?php echo $fecha_parte; ?>'>
				<input class="bt-nuevo-documento" type='submit' name='accion' value='A&ntilde;adir planificaci&oacute;n'>
				<input type='hidden' name='seleccion_formulario' value='anadir_planificacion'>
				<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
			</form>
			
			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<th>Trabajo</th>
					<th>Hora</th>
					<th>Cliente</th>
					<th>Tipo de trabajo</th>
				</tr>
							
				<?php
				if($planificacion_partes){
				foreach($planificacion_partes as $key => $valor){ ?>
					<tr>
						<td><?php echo $ARRAY_PROYECTOS[$valor['proyecto']]; ?></td>
						<td><?php echo $valor['hora_inicio']." - ".$valor['hora_fin']; ?></td>
						<td><?php echo $PARTES_CLIENTES[$valor['cliente']]; ?></td>
						<td><?php echo $ARRAY_TRABAJOS['trabajos_padre'][$valor['tipo_trabajo']]; ?> 
							<?php if($valor['tipo_trabajo'] == '6'){ 
								if ($valor['subtrabajo'] != ''){ ?>
									=> <?php echo $valor['subtrabajo'];
								}
							}?>
						</td>
						<td>
							<form action='index.php?menu=planificacion' method='POST'>
								<input class="bt-editar" type='submit' name='accion' value='Editar'>
								<input type='hidden' name='seleccion_formulario' value='editar_planificacion'></input>
								<input type='hidden' name='mantener_fecha' value='<?php echo $fecha_parte; ?>'>
								<input type='hidden' name='id' value='<?php echo $valor['id']; ?>'></input>
								<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
								<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
							</form>
						</td>
						<td>
							<form action='index.php?menu=planificacion' method='POST'>
								<input class="bt-eliminar" type='submit' name='accion' value='Eliminar'>
								<input type='hidden' name='seleccion_formulario' value='eliminar_planificacion'>
								<input type='hidden' name='mantener_fecha' value='<?php echo $fecha_parte; ?>'>
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
			
			<?php break;
	}?>
  </div>
</div>