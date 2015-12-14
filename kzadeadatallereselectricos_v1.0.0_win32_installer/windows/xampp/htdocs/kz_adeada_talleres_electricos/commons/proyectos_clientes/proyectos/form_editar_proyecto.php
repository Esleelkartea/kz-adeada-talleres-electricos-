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
<br><h4>Editar trabajo</h4><br>

<?php 
if(!$_POST['cargar_subvenciones']){
	$criterios = " AND id = '".$_POST['id']."'";
	$proyectos = select_normal("SELECT * FROM kz_te_proyectos WHERE 1 = 1 $criterios");
			
	$proyecto = $proyectos[0];
	
	$codigo=$proyecto['id'];
	$nombre=$proyecto['nombre'];
	$cliente=$proyecto['cliente'];
	$externo_interno=$proyecto['externo_interno'];
	$zona=$proyecto['zona'];
	$prioridad=$proyecto['prioridad'];	
	$fecha_inicio=$proyecto['fecha_inicio'];
	$fecha_prevista=$proyecto['fecha_prevista'];
	$fecha_real=$proyecto['fecha_real'];
	$fecha_visita_previa=$proyecto['fecha_visita_previa'];
	$fecha_auditoria=$proyecto['fecha_auditoria'];
	$check_auditoria=$proyecto['check_auditoria'];
	$tipo_proyectos=$proyecto['tipo_proyecto'];
	$periodo_visita=$proyecto['periodo_visita'];
	$horas_mes=$proyecto['horas_mes'];
	$horas_visita=$proyecto['horas_visita_previa'];
	$horas_auditoria=$proyecto['horas_auditoria'];
	$horas_prevision=$proyecto['horas_prevision'];
	$observaciones=$proyecto['observaciones'];
	$finalizado=$proyecto['finalizado'];
	$comercial=$proyecto['comercial'];
}
else{
	$codigo=$_POST['codigo'];
	$nombre=$_POST['nombre'];
	$cliente=$_POST['cliente'];
	$externo_interno=$_POST['externo_interno'];
	$zona=$_POST['zona'];
	$prioridad=$_POST['prioridad'];
	$ano_inicio=$_POST['ano_inicio'];
	$mes_inicio=$_POST['mes_inicio'];
	$dia_inicio=$_POST['dia_inicio'];
	$fecha_inicio=$_POST['ano_inicio']."-".$_POST['mes_inicio']."-".$_POST['dia_inicio'];
	$ano_prevista=$_POST['ano_prevista'];
	$mes_prevista=$_POST['mes_prevista'];
	$dia_prevista=$_POST['dia_prevista'];
	$fecha_prevista=$_POST['ano_prevista']."-".$_POST['mes_prevista']."-".$_POST['dia_prevista'];
	$ano_real=$_POST['ano_real'];
	$mes_real=$_POST['mes_real'];
	$dia_real=$_POST['dia_real'];
	$fecha_real=$_POST['ano_real']."-".$_POST['mes_real']."-".$_POST['dia_real'];
	$ano_visita=$_POST['ano_visita'];
	$mes_visita=$_POST['mes_visita'];
	$dia_visita=$_POST['dia_visita'];
	$fecha_visita_previa=$_POST['ano_visita']."-".$_POST['mes_visita']."-".$_POST['dia_visita'];
	$ano_auditoria=$_POST['ano_auditoria'];
	$mes_auditoria=$_POST['mes_auditoria'];
	$dia_auditoria=$_POST['dia_auditoria'];
	$fecha_auditoria=$_POST['ano_auditoria']."-".$_POST['mes_auditoria']."-".$_POST['dia_auditoria'];
	$check_auditoria=$_POST['check_auditoria'];
	$tipo_proyectos=$_POST['tipo_proyecto'];
	$tipo_proyecto_nuevo=$_POST['tipo_proyecto_nuevo'];
	$periodo_visita=$_POST['periodo_visita'];
	$horas_mes=$_POST['horas_mes'];
	$horas_visita=$_POST['horas_visita'];
	$horas_auditoria=$_POST['horas_auditoria'];
	$horas_prevision=$_POST['horas_prevision'];
	$observaciones=$_POST['observaciones'];
	$finalizado=$_POST['finalizado'];
	$comercial=$_POST['comercial'];
}
?>

<form action='index.php?menu=administracion_proyectos' method='POST'>
	<table class="tabla_sin_borde">
		<tr>
			<td>Cod. trabajo:</td>
			<?php if(in_array(221,$datos_perfil['PERMISOS'])){?>
				<td><?php echo $codigo; ?></td>
			<?php }
			else{?>
				<td class='dato'><?php echo $proyecto['id']; ?></td>
			<?php }?>
		</tr>
		<tr>
			<td>Nombre:</td>
			<?php if(in_array(221,$datos_perfil['PERMISOS'])){?>
				<td><input type='text' name='nombre' value='<?php echo $nombre; ?>' size='23'></input></td>
			<?php }
			else{?>
				<td class='dato'><?php echo $proyecto['nombre']; ?></td>
			<?php }?>
		</tr>
		<tr>
			<td>Encargado:</td>	
			<?php if(in_array(221,$datos_perfil['PERMISOS'])){?>
				<td>
					<select name='comercial'>
						<?php	
		         		$sqlcomercial=select_normal("SELECT * FROM kz_te_personal ORDER BY nombre");
		         		?><option></option><?php
						foreach($sqlcomercial as $keycomercial => $valorcomercial){
							if($comercial == $valorcomercial['id']){
								$cliente_seleccionado = " SELECTED ";
							}
							else $cliente_seleccionado = ""; ?>
							
							<option value='<?php echo $valorcomercial['id']; ?>' <?php echo $cliente_seleccionado; ?>>
		      					<?php echo $valorcomercial['nombre']." ".$valorcomercial['apellidos']; ?>
							</option><?php
						} ?>
					</select>
				</td>
			<?php }
			else{?>
				<td class='dato'><?php echo $ARRAY_TECNICOS[$proyecto['comercial']]; ?></td>
			<?php }?>
		</tr>
		<tr>
			<td>Cliente:</td>
			<?php if(in_array(221,$datos_perfil['PERMISOS'])){?>
				<td>
					<select name='cliente'>
						<?php	
		         		$sqlcliente=select_normal("SELECT * FROM kz_te_clientes ORDER BY nombre_comercial");
		         		?><option></option><?php
						foreach($sqlcliente as $keycomercial => $valorcliente){
							if($cliente == $valorcliente['id']){
								$cliente_seleccionado = " SELECTED ";
							}
							else $cliente_seleccionado = ""; ?>
							
							<option value='<?php echo $valorcliente['id']; ?>' <?php echo $cliente_seleccionado; ?>>
		      					<?php echo $valorcliente['nombre_comercial']; ?>
							</option><?php
						} ?>
					</select>
				</td>
			<?php }
			else{?>
				<td class='dato'><?php echo $PARTES_CLIENTES[$proyecto['cliente']]; ?></td>
			<?php }?>
		</tr>
		<tr>
			<td>Externo / Interno:</td>
			<?php if(in_array(221,$datos_perfil['PERMISOS'])){?>
				<td>
					<select name="externo_interno"  id="externo_interno" >
	        			<?php combo_base_array(array('externo','interno'),$externo_interno); ?>
	        		</select>
				</td>
			<?php }
			else{?>
				<td class='dato'><?php echo $proyecto['externo_interno']; ?></td>
			<?php }?>
		</tr>
		<tr>
			<td>Zona:</td>
			<?php if(in_array(221,$datos_perfil['PERMISOS'])){?>
				<td>
					<select name='zona'>
						<?php 
						$provincias = mostrar_provincias();
						?><option></option><?php 
						combo_base_array($provincias,$zona);
						?>
					</select>
				</td>
			<?php }
			else{?>
				<td class='dato'><?php echo $proyecto['zona']; ?></td>
			<?php }?>
		</tr>
		<tr>
			<td>Prioridad:</td>
			<?php if(in_array(221,$datos_perfil['PERMISOS'])){?>
				<td>
					<select name="prioridad"  id="prioridad" >
	         			<option></option><?php	
	      				combo_base_array($array_prioridades,$prioridad);
	      				?>
	        		</select>
				</td>
			<?php }
			else{?>
				<td class='dato'><?php echo $proyecto['prioridad']; ?></td>
			<?php }?>
		</tr>
		<tr>
			<td>Fecha inicio:</td>
			<?php if(in_array(221,$datos_perfil['PERMISOS'])){?>
				<td>
					<?php $fechainicio = explode('-',$fecha_inicio); ?>
					<select name="ano_inicio"  id="ano_inicio" >
	         			<?php	
	      				combo_base_array($array_annos,$fechainicio[0]);
	      				?>
	        		</select> -
	        		<select name="mes_inicio"  id="mes_inicio" >
	         			<?php	
	      				combo_base_array($array_meses,$fechainicio[1]);
	      				?>
	        		</select> -
					<select name="dia_inicio"  id="dia_inicio" >
	         			<?php	
	      				combo_base_array($array_dias,$fechainicio[2]);
	      				?>
	        		</select>
				</td>
			<?php }
			else{?>
				<td class='dato'><?php echo $proyecto['fecha_inicio']; ?></td>
			<?php }?>
		</tr>
		<tr>
			<td>Fecha fin prevista:</td>
			<?php if(in_array(221,$datos_perfil['PERMISOS'])){?>
				<td>
					<?php $fechaprevista = explode('-',$fecha_prevista); ?>
					<select name="ano_prevista"  id="ano_prevista" >
	         			<?php	
	      				combo_base_array($array_annos,$fechaprevista[0]);
	      				?>
	        		</select> -
	        		<select name="mes_prevista"  id="mes_prevista" >
	         			<?php	
	      				combo_base_array($array_meses,$fechaprevista[1]);
	      				?>
	        		</select> -
					<select name="dia_prevista"  id="dia_prevista" >
	         			<?php	
	      				combo_base_array($array_dias,$fechaprevista[2]);
	      				?>
	        		</select>
				</td>
			<?php }
			else{?>
				<td class='dato'><?php echo $proyecto['fecha_prevista']; ?></td>
			<?php }?>
		</tr>
		<tr>
			<td>Fecha fin real:</td>
			<?php if(in_array(221,$datos_perfil['PERMISOS'])){?>
				<td>
					<?php $fechareal = explode('-',$fecha_real); ?>
					<select name="ano_real"  id="ano_real" >
	         			<?php	
	      				combo_base_array($array_annos,$fechareal[0]);
	      				?>
	        		</select> -
	        		<select name="mes_real"  id="mes_real" >
	         			<?php	
	      				combo_base_array($array_meses,$fechareal[1]);
	      				?>
	        		</select> -
					<select name="dia_real"  id="dia_real" >
	         			<?php	
	      				combo_base_array($array_dias,$fechareal[2]);
	      				?>
	        		</select>
				</td>
			<?php }
			else{?>
				<td class='dato'><?php echo $proyecto['fecha_real']; ?></td>
			<?php }?>
		</tr>
		<tr>
			<td>Tipo trabajo:</td>
			<?php if(in_array(221,$datos_perfil['PERMISOS'])){?>
				<td>
					<select name='tipo_proyecto'>
						<?php	
		         		$sqltipo=select_normal("SELECT * FROM kz_te_tipo_proyecto ORDER BY proyecto");
		         		?><option></option><?php
						foreach($sqltipo as $keytipo => $valortipo){
							if($tipo_proyectos == $valortipo['id']){
								$tipo_seleccionado = " SELECTED ";
							}
							else $tipo_seleccionado = ""; ?>
							
							<option value='<?php echo $valortipo['id']; ?>' <?php echo $tipo_seleccionado; ?>>
		      					<?php echo $valortipo['proyecto']; ?>
							</option><?php
						} ?>
					</select>
					<input type='text' name='tipo_proyecto_nuevo' value='<?php echo $tipo_proyecto_nuevo;?>'></input>
				</td>
			<?php }
			else{?>
				<td class='dato'><?php echo $ARRAY_TIPO_PROYECTO[$proyecto['tipo_proyecto']]; ?></td>
			<?php }?>
		</tr>
		<tr>
			<td>Horas:</td>
			<?php if(in_array(221,$datos_perfil['PERMISOS'])){?>
				<td><input type='text' name='horas_auditoria' value='<?php echo $horas_auditoria; ?>' size=2></input></td>
			<?php }
			else{?>
				<td class='dato'><?php echo $proyecto['horas_auditoria']; ?></td>
			<?php }?>
		</tr>
		<tr>
			<td>Observaciones:</td>
			<?php if(in_array(221,$datos_perfil['PERMISOS'])){?>
				<td><textarea name='observaciones' cols='100%' rows='3' onFocus="this.rows='10';" onBlur="this.rows='3';"><?php echo $observaciones; ?></textarea></td>
			<?php }
			else{?>
				<td class='dato'><?php echo $proyecto['observaciones']; ?></td>
			<?php }?>
		</tr>
		<tr>
			<td>Finalizado:</td>
			<?php if(in_array(221,$datos_perfil['PERMISOS'])){?>
				<td>
					<?php 
					if(($proyecto['finalizado'])=='1'){ ?>
						<input  type='checkbox' name='finalizado' id='finalizado' value='<?php echo $finalizado; ?>' checked> <?php 
					}
					else{ ?> 
						<input  type='checkbox' name='finalizado' id='finalizado' value='<?php echo $finalizado; ?>'> <?php
					} ?>
				</td>
			<?php }
			else{?>
				<?php 
				if($proyecto['finalizado'] == '0'){ ?>
					<td class='dato'><?php echo 'NO'; ?></td>
				<?php } 
				if($proyecto['finalizado'] == '1'){ ?>
					<td class='dato'><?php echo 'SI'; ?></td>
				<?php } ?>
			<?php }?>
		</tr>
	</table>
	<br><hr><br>
	
	<input type='hidden' name='editar_proyecto' value='true'></input>
	
	<?php if(($_POST['desde'] == 'informe_proyectos') || ($_POST['modo_resumen']) || (($_POST['cargar_subvenciones'])&&($_POST['desde'] == 'informe_proyectos'))){?>
		<?php if(in_array(221,$datos_perfil['PERMISOS'])){?>
				<input class="bt-accion"  type='submit' name='volver_informe' value='Guardar' /> 
				<input type='hidden' name='pag' value='../commons/informes/informe_proyectos'></input>
				<?php if($_POST['tecnico']){?>
					<input type='hidden' name='fil_persona' value='<?php echo $_POST['tecnico']; ?>'></input>
				<?php }
				else{?>
					<input type='hidden' name='fil_persona' value='<?php echo $_POST['fil_persona']; ?>'></input>
				<?php }?>
				<input type='hidden' name='anno' value='<?php echo $_POST['anno']; ?>'></input>
				<input type='hidden' name='modo_resumen' value='<?php echo $_POST['modo_resumen']; ?>'></input>
				<input type='hidden' name='cliente_proyecto' value='<?php echo $_POST['cliente_proyecto']; ?>'></input>
				<input type='hidden' name='idproyecto' value='<?php echo $_POST['id']; ?>'></input>
				<?php if($_POST['cargar_subvenciones']!=''){?>
					<input type='hidden' name='subvenciones_cargadas' value='<?php $_POST['cargar_subvenciones'];?>'>
				<?php }
				else{?>
					<input type='hidden' name='subvenciones_cargadas' value='<?php $_POST['subvenciones_cargadas'];?>'>
				<?php }?>
			</form>
			
			<form action='index.php?menu=administracion_proyectos' method='POST'>
				<input class="bt-accion"  type='submit' name='volver_informe' value='Cancelar' />
				<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input> 
				<input type='hidden' name='pag' value='../commons/informes/informe_proyectos'></input>
				<?php if($_POST['tecnico']){?>
					<input type='hidden' name='fil_persona' value='<?php echo $_POST['tecnico']; ?>'></input>
				<?php }
				else{?>
					<input type='hidden' name='fil_persona' value='<?php echo $_POST['fil_persona']; ?>'></input>
				<?php }?>
				<input type='hidden' name='anno' value='<?php echo $_POST['anno']; ?>'></input>
				<input type='hidden' name='modo_resumen' value='<?php echo $_POST['modo_resumen']; ?>'></input>
				<input type='hidden' name='cliente_proyecto' value='<?php echo $_POST['cliente_proyecto']; ?>'></input>
				<input type='hidden' name='idproyecto' value='<?php echo $_POST['id']; ?>'></input>
				<?php if($_POST['cargar_subvenciones']!=''){?>
					<input type='hidden' name='subvenciones_cargadas' value='<?php $_POST['cargar_subvenciones'];?>'>
				<?php }
				else{?>
					<input type='hidden' name='subvenciones_cargadas' value='<?php $_POST['subvenciones_cargadas'];?>'>
				<?php }?>
			</form>
		<?php }
		else{?>
			<form action='index.php?menu=administracion_proyectos' method='POST'>
				<input class="bt-accion"  type='submit' name='volver_informe' value='Volver' />
				<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input> 
				<input type='hidden' name='pag' value='../commons/informes/informe_proyectos'></input>
				<?php if($_POST['tecnico']){?>
					<input type='hidden' name='fil_persona' value='<?php echo $_POST['tecnico']; ?>'></input>
				<?php }
				else{?>
					<input type='hidden' name='fil_persona' value='<?php echo $_POST['fil_persona']; ?>'></input>
				<?php }?>
				<input type='hidden' name='anno' value='<?php echo $_POST['anno']; ?>'></input>
				<input type='hidden' name='modo_resumen' value='<?php echo $_POST['modo_resumen']; ?>'></input>
				<input type='hidden' name='cliente_proyecto' value='<?php echo $_POST['cliente_proyecto']; ?>'></input>
				<input type='hidden' name='idproyecto' value='<?php echo $_POST['id']; ?>'></input>
				<?php if($_POST['cargar_subvenciones']!=''){?>
					<input type='hidden' name='subvenciones_cargadas' value='<?php $_POST['cargar_subvenciones'];?>'>
				<?php }
				else{?>
					<input type='hidden' name='subvenciones_cargadas' value='<?php $_POST['subvenciones_cargadas'];?>'>
				<?php }?>
			</form>
		<?php }
	}
	else{?>
			Guardar y
			<select class="select-comun" name='seleccion_formulario'>
				<option value=''>Volver al listado</option>
				<option value='ver_ficha'>Ir a la ficha</option>
			</select>
			
			<input class="bt-accion"  type='submit' name='accion' value='Continuar' /> 
			<input type='hidden' name='id' value='<?php  echo $proyecto['id']; ?>'></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
			<input type='hidden' name='codigo_trabajo' value='<?php echo $_POST['id'];?>'></input>
			<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
		</form>
		</br>
		<form action='index.php?menu=administracion_proyectos' method='POST'>
			<input class="bt-accion"  type='submit' name='accion' value='Cancelar' />
			<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input> 
			<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
		</form>
	<?php }?>
