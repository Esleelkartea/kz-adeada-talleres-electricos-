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
define('ROOT_DIR',$_SERVER['DOCUMENT_ROOT']."/kz_adeada_talleres_electricos/");
include(ROOT_DIR."functions/funciones.php");
include(ROOT_DIR."functions/globales.php");
?>

<h3>A&ntilde;adir planificaci&oacute;n</h3>

<?php 
//CARGAR TRABAJOS
$trabajos = obtener_trabajos();
?>

<form action='index.php?menu=planificacion' method='POST'>
	<table class="tabla_sin_borde">
		<tr>
			<td>Trabajador:</td>
			<td>
				<input type='hidden' name="comercial" id="comercial" value='<?php echo $_GET['comercial']; ?>'><?php echo $ARRAY_TECNICOS[$_GET['comercial']]; ?>
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
	         		$cliente_proyecto=select_normal("SELECT c.id as idcliente, c.nombre_comercial, p.id as idproyecto, p.nombre FROM kz_te_clientes c, kz_te_proyectos p, kz_te_proyecto_personal pp WHERE pp.proyecto=p.id and pp.tecnico='".$_GET['comercial']."' and c.id = p.cliente AND p.finalizado != 1 ORDER BY c.nombre_comercial");
	         		?><option></option><?php
	      			foreach($cliente_proyecto as $keyclienteproyecto => $valorclienteproyecto){
	      				?>
	      				<option value='<?php echo utf8_encode($valorclienteproyecto['idcliente'])."||".utf8_encode($valorclienteproyecto['idproyecto']); ?>'>
	      					<?php echo utf8_encode($valorclienteproyecto['nombre_comercial']); ?> || <?php echo $valorclienteproyecto['idproyecto']; ?> - <?php echo utf8_encode($valorclienteproyecto['nombre']); ?>
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
					foreach($provincias as $key => $valor){
					?>
						<option value='<?php echo utf8_encode($valor); ?>'><?php echo utf8_encode($valor); ?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<td>D&iacute;a:</td>
			<td>
				<?php $fechaparte = explode('-',$_GET['dia']); ?>
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
				<select name="inicio_horas"  id="inicio_horas" >
         			<?php	
      				combo_base_array($array_horainicio,$_GET['hora']);
      				?>
        		</select> :
				<select name='inicio_minutos' id='inicio_minutos'>
					<?php
      				combo_base_array($array_minutos,$_GET['minutos']);
      				?>		
				</select>
			</td>
		</tr>
		<tr>
			<td>Hora fin:</td>
			<td>		
				<select name="fin_horas"  id="fin_horas" >
         			<?php	
      				combo_base_array($array_horafin,$_GET['hora']+1);
      				?>
        		</select> :
				<select name='fin_minutos' id='fin_minutos'>
					<?php	
      				combo_base_array($array_minutos,$_GET['minutos']);
      				?>	
				</select>
			</td>
		</tr>
		<tr>
			<td>Tipo de trabajo:</td>
			<td>
			<?php
			foreach($trabajos as $trabajo_padre => $trabajo_hijo){ 
			echo "<input type='radio' name='tipo_trabajo' value='".$trabajo_hijo['id']."'>".utf8_encode($trabajo_padre)."</input>";
				if($trabajo_padre == 'Otros'){
					?> <input type='text' name='subtrabajo_otros' value='' size='30'><?php 
				}
			echo "<br>";
			}
			?>
			</td>
		</tr>
		<tr>
			<td>Labor a realizar:</td>
			<td><textarea name='labor_realizada' rows="3" cols="60"></textarea></td>
		</tr>
		<tr>
			<td>Otros:</td>
			<td><textarea name='otros' rows="3" cols="60"></textarea></td>
		</tr>
		<tr>
			<td>Tema importante:</td>
			<td><input type='checkbox' name='tema_importante' id='tema_importante'></td>
		</tr>
	</table>
	<br>
	
	<input type='hidden' name='anadir_planificacion_calendario' value='true'></input>
	<input class="bt-accion"  type='submit' name='guardar' value='Guardar' /> 
	<input type='hidden' name='pag' value='<?php  echo $_GET['pag']; ?>'></input>

</form>