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
<br><h4>Eliminar parte</h4><br>

<div class='mensaje_eliminar'>ATENCI&Oacute;N: Va a eliminar el siguiente parte. &iquest;Continuar?</div>
<br />
<form action='index.php?menu=administracion_partes' method='POST'>	
	<input name='seleccion_formulario' value='' type='hidden'>
	<input class="bt-accion"  type='submit' name='accion' value='CANCELAR' /> 
	<input type='hidden' name='mantener_fecha' value='<?php echo $_POST['mantener_fecha']; ?>'>
	<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
	<input class="bt-accion" type='submit' name='eliminar_parte' value='ELIMINAR' />
	<input type='hidden' name='mantener_fecha' value='<?php echo $_POST['mantener_fecha']; ?>'>
	<input type='hidden' name='seleccion_formulario' value=''>
	<input type='hidden' name='id' value='<?php  echo $persona['id']; ?>'></input>
	<br><br>
	
	<?php
	$criterios = " AND id = ".$_POST['id']."";
	$partes = select_normal("SELECT * FROM kz_te_partes WHERE 1 = 1 $criterios");
		
	$parte = $partes[0];
	?>
	
	<table class="tabla_sin_borde">
		<tr>
			<td width="25%">Trabajador:</td>
			<td class='dato'>
				<?php echo $ARRAY_TECNICOS[$parte['comercial']]; ?>
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
			<td>Labor realizada:</td>
			<td class='dato'><?php echo $parte['labor_realizada']; ?></td>
		</tr>
		<tr>
			<td>Otros:</td>
			<td class='dato'><?php echo $parte['otros']; ?></td>
		</tr>
	</table>

	<input type='hidden' name='id' value='<?php  echo $parte['id']; ?>'></input>
</form>