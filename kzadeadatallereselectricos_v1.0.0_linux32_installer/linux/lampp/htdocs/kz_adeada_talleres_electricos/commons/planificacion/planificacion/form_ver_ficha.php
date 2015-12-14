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
<br><h4>Ficha de planificaci&oacute;n</h4><br>

<?php	
	$criterios = " AND a.id = ".$_POST['id']." AND a.comercial=b.id";
	$partes = select_normal("SELECT a.id, a.proyecto, a.provincia, a.cliente, a.tipo_trabajo, a.subtrabajo, b.nombre, b.apellidos, a.dia, a.hora_inicio, a.hora_fin, a.labor_realizada, a.otros, a.tema_importante FROM kz_te_planificacion_partes a, kz_te_personal b WHERE 1 = 1 $criterios");
	$criterios2 = "AND w.id = ".$_POST['id']." AND w.proyecto=x.id and x.cliente=z.id";
	$proyectos = select_normal("SELECT z.nombre_comercial, y.nombre, y.apellidos FROM kz_te_clientes z, kz_te_personal y, kz_te_proyectos x, kz_te_planificacion_partes w WHERE 1=1 $criterios2");
	$parte = $partes[0];
	$proyecto = $proyectos[0];
?>

<table class="tabla_sin_borde">
	<tr>
		<td width="25%">Trabajador:</td>
		<td class='dato'>
			<?php echo $parte['nombre']; ?> <?php echo $parte['apellidos']; ?>
		</td>
	</tr>
	<?php // TRABAJAR CON PROYECTOS O100
		if($OPCIONES[100]){
	?>
	<tr>
		<td>Cliente:</td>
		<td class='dato'>
			<?php echo $PARTES_CLIENTES[$parte['cliente']]; ?>
		</td>
	</tr>
	<tr>
		<td>Trabajo:</td>
		<td class='dato'>
			<?php echo $ARRAY_PROYECTOS[$parte['proyecto']]; ?>
		</td>
	</tr>
	<?php } //TRABAJAR CON PROYECTOS O100 ?>
	
	<tr>
		<td>Provincia:</td>
		<td class='dato'><?php echo $parte['provincia']; ?></td>
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
			<?php echo $ARRAY_TRABAJOS['trabajos_padre'][$parte['tipo_trabajo']]; ?> 
			<?php if($parte['tipo_trabajo'] == '6'){ 
				if ($parte['subtrabajo'] != ''){ ?>
					=> <?php echo $parte['subtrabajo'];
				}
			}?>
		</td>
	</tr>
	<tr>
		<td>Labor a realizar:</td>
		<td class='dato'><?php echo $parte['labor_realizada']; ?></td>
	</tr>
	<tr>
		<td>Otros:</td>
		<td class='dato'><?php echo $parte['otros']; ?></td>
	</tr>
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
</table>
<br><hr><br>
	
<form action='index.php?menu=planificacion' method='POST'>	
	<select class="select-comun" name='seleccion_formulario'>
		<option value=''>Volver al listado</option>
		<option value='editar_planificacion'>Editar planificaci&oacute;n</option>
	</select>
		
	<input class="bt-accion"  type='submit' name='accion' value='Continuar' /> 
	<input type='hidden' name='id' value='<?php  echo $parte['id']; ?>'></input>
	<input type='hidden' name='mantener_fecha' value='<?php echo $_POST['mantener_fecha']; ?>'>
	<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>