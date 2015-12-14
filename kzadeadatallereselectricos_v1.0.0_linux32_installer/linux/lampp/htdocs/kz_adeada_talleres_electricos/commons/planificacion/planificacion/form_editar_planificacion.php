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
<br><h4>Editar planificaci&oacute;n</h4><br>

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
//CARGAR TRABAJOS
$trabajos = obtener_trabajos();
?>

<?php
$criterios = " AND id = ".$_POST['id']."";
$partes = select_normal("SELECT * FROM kz_te_planificacion_partes WHERE 1 = 1 $criterios");

//$partes = select_normal("SELECT a.id, b.nombre, b.apellidos, c.empresa, c.nombre as nombrecliente, c.apellidos as apellidoscliente, a.provincia, a.dia, a.hora_inicio, a.hora_fin, e.trabajo as trabajo, f.trabajo as subtrabajo, a.labor_realizada, a.otros FROM partes a, personal b, clientes c, tipo_trabajo e, detalle_trabajo f  WHERE 1 = 1 $criterios");
		
$parte = $partes[0];	
?>

<form action='index.php?menu=planificacion' method='POST'>
	<table class="tabla_sin_borde">
		<tr>
			<td width="25%">Trabajador:</td>
			<td>
			
			<?php

			if($_POST['pag'] == '../commons/partes/partes'){
			
			//PERMISO A�adir parte de cualquier persona P221 
				if(in_array(221,$datos_perfil['PERMISOS'])){ ?>
				<select name='comercial'>
					<?php	
	         		$sqlcomercial=select_normal("SELECT * FROM kz_te_personal ORDER BY nombre");
	         		?><option></option><?php
					foreach($sqlcomercial as $keycomercial => $valorcomercial){
						if($parte['comercial'] == $valorcomercial['id']){
							$comercial_seleccionado = " SELECTED ";
						}
						else $comercial_seleccionado = ""; ?>
						
						<option value='<?php echo $valorcomercial['id']; ?>' <?php echo $comercial_seleccionado; ?>>
	      					<?php echo $valorcomercial['nombre']; ?> <?php echo $valorcomercial['apellidos']; ?>
						</option><?php
					} ?>
				</select>
				<?php //PERMISO A�adir parte de cualquier persona P221 
		} else { 
		$persona = select_normal("Select * from kz_te_personal where id = ".$parte['comercial']);
			?>
		<input type='hidden' name="comercial" id="comercial" value='<?php echo $parte['comercial']; ?>'><?php echo $persona[0]['nombre']." ".$persona[0]['apellidos']; ?>
			
		
		
		<?php }
		}
		else{?>
			<input type='hidden' name="comercial" id="comercial" value='<?php echo $ID_PERSONA['id']; ?>'>	
			<?php echo $ID_PERSONA['nombre']." ".$ID_PERSONA['apellidos']; ?>

		<?php }?>
			</td>
		</tr>
	<?php // TRABAJAR CON PROYECTOS O100
			if($OPCIONES[100]){
		?>
		<tr>
			<td>Cliente || Trabajo:</td>
			<td>
				<select name="cliente_proyecto" id="cliente_proyecto">
	         		<?php
	         		$cliente_proyecto=select_normal("SELECT c.id as idcliente, c.nombre_comercial, p.id as idproyecto, p.nombre FROM kz_te_clientes c, kz_te_proyectos p, kz_te_proyecto_personal pp WHERE pp.proyecto=p.id and pp.tecnico='".$ID_PERSONA['id']."' and c.id = p.cliente ORDER BY c.nombre_comercial");
	         		?><option></option><?php
	      			foreach($cliente_proyecto as $keyclienteproyecto => $valorclienteproyecto){
	      				if($parte['cliente'] == $valorclienteproyecto['idcliente']){
	      					if($parte['proyecto'] == $valorclienteproyecto['idproyecto']){
	      						$cliente_proyecto_seleccionado = " SELECTED ";
	      					}
	      					else{
	      						$cliente_proyecto_seleccionado = "";
	      					}
	      				}
	      				else{
	      					$cliente_proyecto_seleccionado = "";
	      				}
	      				?>
	      				<option value='<?php echo $valorclienteproyecto['idcliente']."||".$valorclienteproyecto['idproyecto']; ?>' <?php echo $cliente_proyecto_seleccionado; ?>>
							<?php echo $valorclienteproyecto['nombre_comercial']; ?> || <?php echo $valorclienteproyecto['idproyecto']; ?> - <?php echo $valorclienteproyecto['nombre']; ?>
						</option><?php
	      			}
	      			?>
       			</select>
			</td>
		</tr>
       		<?php } //TRABAJAR CON PROYECTOS O100 ?>

		
		<tr>
			<td>Provincia:</td>
			<td>
				<select name='provincia'>
					<?php 
					$provincias = mostrar_provincias();
					?><option></option><?php 
					combo_base_array($provincias,$parte['provincia']);
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>D&iacute;a:</td>
			<td>
				<?php $fechaparte = explode('-',$parte['dia']); ?>
				<select name="ano"  id="ano" >
         			<?php	
      				combo_base_array($array_annos,$fechaparte[0]);
      				?>
        		</select> -
        		<select name="mes"  id="mes" >
         			<?php	
      				combo_base_array($array_meses,$fechaparte[1]);
      				?>
        		</select> -
				<select name="dia"  id="dia" >
         			<?php	
      				combo_base_array($array_dias,$fechaparte[2]);
      				?>
        		</select>
			</td>
		</tr>
		<tr>
			<td>Hora de inicio:</td>
			<td>
				<?php $horainicio = explode(':', $parte['hora_inicio']); $horafin = explode(':', $parte['hora_fin']); ?>
				<select name="inicio_horas"  id="inicio_horas" >
         			<?php	
      				combo_base_array($array_horainicio,$horainicio[0]);
      				?>
        		</select> :
				<select name='inicio_minutos' id='inicio_minutos'>
					<?php	
      				combo_base_array($array_minutos,$horainicio[1]);
      				?>		
				</select>
			</td>
		</tr>
		<tr>
			<td>Hora fin:</td>
			<td>
				<select name="fin_horas"  id="fin_horas">
         			<?php	
      				combo_base_array($array_horafin,$horafin[0]);
      				?>
        		</select> :
				<select name='fin_minutos' id='fin_minutos'>
					<?php	
      				combo_base_array($array_minutos,$horafin[1]);
      				?>		
				</select>
			</td>
		</tr>
		<tr>
			<td>Tipo de trabajo:</td>
			<td>	
			<?php
			foreach($trabajos as $trabajo_padre => $trabajo_hijo){ 
				if($parte['tipo_trabajo'] == $trabajo_hijo['id']) $selected = 'SELECTED'; else $selected = 'SELECTED';
				echo "<input type='radio' name='tipo_trabajo' value='".$trabajo_hijo['id']."' ".seleccionado($parte['tipo_trabajo'],$trabajo_hijo['id'],'CHECKED').">".$trabajo_padre."</input>";

				if($trabajo_hijo['id'] == '6'){
					if(seleccionado($parte['tipo_trabajo'],$trabajo_hijo['id'],'CHECKED') ){
						?> <input type='text' name='subtrabajo_otros' value='<?php echo $parte['subtrabajo']; ?>' size='30'><?php
					}
					else{
						?> <input type='text' name='subtrabajo_otros' value='' size='30'><?php
					}
				}

				echo "<br>";
			}
			?>
			</td>
		</tr>
		<tr>
			<td>Labor a realizar:</td>
			<td><textarea name='labor_realizada' rows="3" cols="70%" onFocus="this.rows='10';" onBlur="this.rows='3';"><?php echo $parte['labor_realizada']; ?></textarea></td>
		</tr>
		<tr>
			<td>Otros:</td>
			<td><textarea name='otros' rows="3" cols="70%" onFocus="this.rows='10';" onBlur="this.rows='3';"><?php echo $parte['otros']; ?></textarea></td>
		</tr>
		<tr>
			<td>Tema importante:</td>
			<td>
				<?php 
				if(($parte['tema_importante'])=='1'){ ?>
					<input  type='checkbox' name='tema_importante' id='tema_importante' value='<?php echo $parte['tema_importante']; ?>' checked> <?php 
				}
				else{ ?> 
					<input  type='checkbox' name='tema_importante' id='tema_importante' value='<?php echo $parte['tema_importante']; ?>'> <?php
				} ?>
			</td>
		</tr>
	</table>
	<br><hr><br>
	
	<input type='hidden' name='editar_planificacion' value='true'></input>
	
	Guardar y
	<select class="select-comun" name='seleccion_formulario'>
		<option value=''>Volver al listado</option>
		<option value='ver_ficha'>Ir a la ficha</option>
	</select>
	
	<input class="bt-accion"  type='submit' name='accion' value='Continuar' /> 
	<input type='hidden' name='mantener_fecha' value='<?php echo $_POST['mantener_fecha']; ?>'>
	<input type='hidden' name='id' value='<?php  echo $parte['id']; ?>'></input>
	<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>
<br />
<form action='index.php?menu=planificacion' method='POST'>
	<input class="bt-accion"  type='submit' name='accion' value='Cancelar' /> 
	<input type='hidden' name='mantener_fecha' value='<?php echo $_POST['mantener_fecha']; ?>'>
	<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>