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

<h3>Editar parte</h3>

<?php
	$trabajos = obtener_trabajos();

	if($_GET['tipo'] == 'real'){
		$criterios = " AND id = ".$_GET['id']."";
		$partes = select_normal("SELECT * FROM kz_te_partes WHERE 1 = 1 $criterios");
		$parte = $partes[0];
	}
	if($_GET['tipo'] == 'planificado'){
		$criterios = " AND id = ".$_GET['id']."";
		$partes = select_normal("SELECT * FROM kz_te_planificacion_partes WHERE 1 = 1 $criterios");
		
		$parte = $partes[0];
	}
	?>

<form action='index.php?menu=planificacion' method='POST'>
	<table class="tabla_sin_borde">
		<tr>
			<td>Trabajador:</td>
			<td><input type='hidden' name="comercial" id="comercial" value='<?php echo $_GET['comercial']; ?>'><?php echo $ARRAY_TECNICOS[$parte['comercial']]; ?></td>
		</tr>
		
	<?php // TRABAJAR CON PROYECTOS O100
			if($OPCIONES[100]){
		?>
		<tr>
			<td>Cliente || Trabajo:</td>
			<td>
				<select name="cliente_proyecto" id="cliente_proyecto">
	         		<?php
	         		$cliente_proyecto=select_normal("SELECT c.id as idcliente, c.nombre_comercial, p.id as idproyecto, p.nombre FROM kz_te_clientes c, kz_te_proyectos p, kz_te_proyecto_personal pp WHERE pp.proyecto=p.id and pp.tecnico='".$_GET['comercial']."' and c.id = p.cliente ORDER BY c.nombre_comercial");
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
							<?php echo utf8_encode($valorclienteproyecto['nombre_comercial']); ?> || <?php echo $valorclienteproyecto['idproyecto']; ?> - <?php echo $valorclienteproyecto['nombre']; ?>
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
					foreach($provincias as $keyx => $valorx) $provincias[$keyx] = utf8_encode($provincias[$keyx]);
					?><option></option><?php 
					utf8_decode(combo_base_array($provincias,utf8_encode($parte['provincia'])));?>
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
				echo "<input type='radio' name='tipo_trabajo' value='".$trabajo_hijo['id']."' ".seleccionado($parte['tipo_trabajo'],$trabajo_hijo['id'],'CHECKED').">".utf8_encode($trabajo_padre)."</input>";				
				if($trabajo_hijo['id'] == '6'){
					if(seleccionado($parte['tipo_trabajo'],$trabajo_hijo['id'],'CHECKED') ){
						?> <input type='text' name='subtrabajo_otros' value='<?php echo nl2br(utf8_encode($parte['subtrabajo'])); ?>' size='30'><?php
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
			<?php if($_GET['tipo'] == 'planificado'){?>
				<td>Labor a realizar:</td>
			<?php }
			elseif($_GET['tipo'] == 'real'){?>
				<td>Labor realizada:</td>
			<?php }?>
			<td><textarea name='labor_realizada' rows="3" cols="50"><?php echo nl2br(utf8_encode($parte['labor_realizada'])); ?></textarea></td>
		</tr>
		<tr>
			<td>Otros:</td>
			<td><textarea name='otros' rows="3" cols="50"><?php echo nl2br(utf8_encode($parte['otros'])); ?></textarea></td>
		</tr>
		
		<?php if($_GET['tipo'] == 'planificado'){?>
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
		<?php }?>
	</table>
	<br>
	
	<input type='hidden' name='editar_planificacion_calendario' value='true'></input>
	<input class="bt-accion"  type='submit' name='guardar' value='Guardar' /> 
	<input type='hidden' name='pag' value='<?php  echo $_GET['pag']; ?>'></input>
	<input type='hidden' name='tipo' value='<?php  echo $_GET['tipo']; ?>'></input>
	<input type='hidden' name='id' value='<?php  echo $parte['id']; ?>'></input>
	
</form>