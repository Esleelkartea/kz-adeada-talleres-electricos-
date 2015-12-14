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
<br><h4>A&ntilde;adir parte</h4><br>

<?php
//CARGAR TRABAJOS
$trabajos = obtener_trabajos();
?>

<form action='index.php?menu=administracion_partes' method='POST'>
	<table class="tabla_sin_borde">
		<tr>
			<td width="25%">Trabajador:</td>
			<td>
			
			<?php			
			if($_POST['pag'] == '../commons/partes/partes'){
			
		 //PERMISO Crear parte de cualquier persona P221 
		if(in_array(221,$datos_perfil['PERMISOS'])){ ?>

				<select name="comercial" id="comercial">
	         		<?php
	         		$comercial=select_normal("SELECT * FROM kz_te_personal ORDER BY nombre");
	         		?><option></option><?php
	      			foreach($comercial as $keycomercial => $valorcomercial){
	      				?>
	      				<option value='<?php echo $valorcomercial['id']; ?>'>
	      					<?php echo $valorcomercial['nombre']; ?> <?php echo $valorcomercial['apellidos']; ?>
	      				</option><?php
	      			}
	      			?>
       			</select>
     	<?php //PERMISO A�adir parte de cualquier persona P221 
		} else { ?>

		<input type='hidden' name="comercial" id="comercial" value='<?php echo $ID_PERSONA['id']; ?>'><?php echo $ID_PERSONA['nombre']." ".$ID_PERSONA['apellidos']; ?>
			
		
		<?php }
		}
		if($_POST['pag'] == '../commons/partes/parte_diario'){?>
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
			<?php if($_POST['pag'] == '../commons/partes/partes'){ ?>
				<select name="cliente_proyecto" id="cliente_proyecto">
	         		<?php
	         		$cliente_proyecto=select_normal("SELECT c.id as idcliente, c.nombre_comercial, p.id as idproyecto, p.nombre FROM kz_te_clientes c, kz_te_proyectos p WHERE c.id = p.cliente AND p.finalizado != 1 ORDER BY c.nombre_comercial");
	         		?><option></option><?php
	      			foreach($cliente_proyecto as $keyclienteproyecto => $valorclienteproyecto){
	      				?>
	      				<option value='<?php echo $valorclienteproyecto['idcliente']."||".$valorclienteproyecto['idproyecto']; ?>'>
	      					<?php echo $valorclienteproyecto['nombre_comercial']; ?> || <?php echo $valorclienteproyecto['idproyecto']; ?> - <?php echo $valorclienteproyecto['nombre']; ?>
	      				</option><?php
	      			}
	      			?>
       			</select>
       			<?php }
       			if($_POST['pag'] == '../commons/partes/parte_diario'){ ?>
       				<select name="cliente_proyecto" id="cliente_proyecto">
	         		<?php
	         		$cliente_proyecto=select_normal("SELECT c.id as idcliente, c.nombre_comercial, p.id as idproyecto, p.nombre FROM kz_te_clientes c, kz_te_proyectos p, kz_te_proyecto_personal pp WHERE pp.proyecto=p.id and pp.tecnico='".$ID_PERSONA['id']."' and c.id = p.cliente AND p.finalizado != 1 ORDER BY c.nombre_comercial");
	         		?><option></option><?php
	      			foreach($cliente_proyecto as $keyclienteproyecto => $valorclienteproyecto){
	      				?>
	      				<option value='<?php echo $valorclienteproyecto['idcliente']."||".$valorclienteproyecto['idproyecto']; ?>'>
	      					<?php echo $valorclienteproyecto['nombre_comercial']; ?> || <?php echo $valorclienteproyecto['idproyecto']; ?> - <?php echo $valorclienteproyecto['nombre']; ?>
	      				</option><?php
	      			}
	      			?>
       			</select>
       			<?php }?>
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
					foreach($provincias as $key => $valor){
					?>
						<option value='<?php echo $valor; ?>'><?php echo $valor; ?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<td>D&iacute;a:</td>
			<td>
				<select name="ano"  id="ano" >
         			<?php	
      				combo_base_array($array_annos,$fpd["Y"]);
      				?>
        		</select> -
        		<select name="mes"  id="mes" >
         			<?php	
      				combo_base_array($array_meses,$fpd["m"]);
      				?>
        		</select> -
				<select name="dia"  id="dia" >
         			<?php	
      				combo_base_array($array_dias,$fpd["d"]);
      				?>
        		</select>
        		<?php $fecha = $fpd["Y"]."-".$fpd["m"]."-".$fpd["d"];?>
			</td>
		</tr>
		<tr>
			<td>Hora de inicio:</td>
			<td>
			
			<?php //APROXIMACI�N DE HORA

				$hora = ajustar_hora(date("H:i"));
				$hora = explode(":",$hora);
			?>
			
				<select name="inicio_horas"  id="inicio_horas" >
         			<?php	
      				combo_base_array($array_horainicio,$hora[0]);
      				?>
        		</select> :
				<select name='inicio_minutos' id='inicio_minutos'>
					<?php	
      				combo_base_array($array_minutos,$hora[1]);
      				?>		
				</select>
			</td>
		</tr>
		<tr>
			<td>Hora fin:</td>
			<td>
				<select name="fin_horas"  id="fin_horas" >
         			<?php	
      				combo_base_array($array_horafin,$hora[0]+1);
      				?>
        		</select> :
				<select name='fin_minutos' id='fin_minutos'>
					<?php	
      				combo_base_array($array_minutos,$hora[1]);
      				?>	
				</select>
			</td>
		</tr>
		<tr>
			<td>Tipo de trabajo:</td>
			<td>
			<?php
			foreach($trabajos as $trabajo_padre => $trabajo_hijo){ 
				echo "<input type='radio' name='tipo_trabajo' value='".$trabajo_hijo['id']."'>".$trabajo_padre."</input>";
					if($trabajo_padre == 'Otros'){
						?> <input type='text' name='subtrabajo_otros' value='' size='30'><?php 
					}
				echo "<br>";
			}
			?>
			</td>
		</tr>
		<tr>
			<td>Labor realizada:</td>
			<td><textarea name='labor_realizada' rows="3" cols="70%" onFocus="this.rows='10';" onBlur="this.rows='3';"></textarea></td>
		</tr>
		<tr>
			<td>Otros:</td>
			<td><textarea name='otros' rows="3" cols="70%" onFocus="this.rows='10';" onBlur="this.rows='3';"></textarea></td>
		</tr>
	</table>
	<br><hr><br>
	
	<input type='hidden' name='anadir_parte' value='true'></input>
	
	Guardar y
	<select class="select-comun" name='seleccion_formulario'>
		<option value='anadir_parte'>A&ntilde;adir m&aacute;s</option>
		<option value=''>Volver al listado</option>
	</select>
	
	<input class="bt-accion"  type='submit' name='accion' value='Continuar' /> 
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
	<input type='hidden' name='mantener_fecha' value='<?php echo $fecha; ?>'>
</form>
<br />
<form action='index.php?menu=administracion_partes' method='POST'>
	<input class="bt-accion"  type='submit' name='accion' value='Cancelar' /> 
	<input type='hidden' name='mantener_fecha' value='<?php echo $fecha; ?>'>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>