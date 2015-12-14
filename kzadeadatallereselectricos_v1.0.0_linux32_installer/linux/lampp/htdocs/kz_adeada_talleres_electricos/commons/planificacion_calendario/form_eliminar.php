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

<h3>Eliminar parte</h3>

<div class='mensaje_eliminar'><?php echo utf8_encode("ATENCI&Oacute;N: Va a eliminar el siguiente parte. &iquest;Continuar?");?></div>
<br />
<form action='index.php?menu=planificacion' method='POST'>
	<input class="bt-accion" type='submit' name='eliminar_planificacion_calendario' value='ELIMINAR' />
	<input type='hidden' name='pag' value='<?php  echo $_GET['pag']; ?>'></input>
	<input type='hidden' name='tipo' value='<?php  echo $_GET['tipo']; ?>'></input>
	<br><br>
	
	<?php
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
	
	<table class="tabla_sin_borde">
		<tr>
			<td width="25%">Trabajador:</td>
			<td class='dato'>
				<input type='hidden' name="comercial" id="comercial" value='<?php echo $_GET['comercial']; ?>'><?php echo $ARRAY_TECNICOS[$parte['comercial']]; ?>
			</td>
		</tr>
		<?php // TRABAJAR CON PROYECTOS O100
			if($OPCIONES[100]){
		?>
		<tr>
			<td>Cliente:</td>
			<td class='dato'>
				<?php echo utf8_encode($PARTES_CLIENTES[$parte['cliente']]); ?>
			</td>
		</tr>
		<tr>
			<td>Trabajo:</td>
			<td class='dato'>
				<?php echo utf8_encode($ARRAY_PROYECTOS[$parte['proyecto']]); ?>
			</td>
		</tr>
		<?php } //TRABAJAR CON PROYECTOS O100 ?>
		
		<tr>
			<td>Provincia:</td>
			<td class='dato'><?php echo utf8_encode($parte['provincia']); ?></td>
		</tr>
		<tr>
			<td>D&iacute;a:</td>
			<td class='dato'><?php echo $parte['dia']; ?></td>
		</tr>
		<tr>
			<td>Hora de inicio:</td>
			<td class='dato'><?php echo $parte['hora_inicio']; ?></td>
		</tr>
		<tr>
			<td>Hora fin:</td>
			<td class='dato'><?php echo $parte['hora_fin']; ?></td>
		</tr>
		<tr>
			<td>Tipo de trabajo:</td>
			<td class='dato'>
				<?php echo utf8_encode($ARRAY_TRABAJOS['trabajos_padre'][$parte['tipo_trabajo']]); ?> 
				<?php if($parte['tipo_trabajo'] == '6'){ 
					if ($parte['subtrabajo'] != ''){ ?>
						=> <?php echo utf8_encode($parte['subtrabajo']);
					}
				}?>
			</td>
		</tr>
		<tr>
			<?php if($_GET['tipo'] == 'planificado'){?>
				<td>Labor a realizar:</td>
			<?php }
			elseif($_GET['tipo'] == 'real'){?>
				<td>Labor realizada:</td>
			<?php }?>
			<td class='dato'><?php echo nl2br(utf8_encode($parte['labor_realizada'])); ?></td>
		</tr>
		<tr>
			<td>Otros:</td>
			<td class='dato'><?php echo nl2br(utf8_encode($parte['otros'])); ?></td>
		</tr>
		
		<?php if($_GET['tipo'] == 'planificado'){?>
			<tr>
				<td>Tema importante:</td>
				<?php 
				if($parte['tema_importante'] == '0'){ ?>
					<td class='dato'><?php echo 'NO'; ?></td>
				<?php } 
				if($parte['tema_importante'] == '1'){ ?>
					<td class='dato'><?php echo 'SI'; ?></td>
				<?php } ?>
			</tr>
		<?php }?>
	</table>

	<input type='hidden' name='id' value='<?php  echo $parte['id']; ?>'></input>
	<input type='hidden' name='fecha_elim_conver' value='<?php  echo $parte['dia']; ?>'></input>
</form>