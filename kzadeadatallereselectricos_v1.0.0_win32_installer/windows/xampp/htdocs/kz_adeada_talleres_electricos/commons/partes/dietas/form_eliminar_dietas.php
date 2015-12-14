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
<br><h4>Eliminar dietas</h4><br>

<div class='mensaje_eliminar'>ATENCI&Oacute;N: Va a eliminar las dietas del d&iacute;a. &iquest;Continuar?</div>
<br />
<form action='index.php?menu=administracion_partes' method='POST'>	
	<input name='seleccion_formulario' value='' type='hidden'>
	<input class="bt-accion"  type='submit' name='accion' value='CANCELAR' /> 
	<input type='hidden' name='mantener_fecha' value='<?php echo $_POST['mantener_fecha']; ?>'>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>

	<input class="bt-accion" type='submit' name='eliminar_dietas' value='ELIMINAR' />
	<input type='hidden' name='seleccion_formulario' value=''>
	<input type='hidden' name='id' value='<?php  echo $persona['id']; ?>'></input>

	<br><br>
	
	<?php
	$criterios = " AND id = ".$_POST['id']."";
	$dietas = select_normal("SELECT * FROM kz_te_dietas WHERE 1 = 1 $criterios");
		
	$dieta = $dietas[0];
	?>
	
	<table class="tabla_sin_borde">
		<tr>
			<td width="25%">Fecha:</td>
			<td class='dato'><?php echo $dieta['fecha']; ?></td>
		</tr>
		<tr>
			<td>Km:</td>
			<td class='dato'><?php echo number_format(($dieta['km']),2,',','.'); ?> km</td>
		</tr>
		<tr>
			<td>Parking / O.T.A.:</td>
			<td class='dato'><?php echo number_format(($dieta['parking']),2,',','.'); ?> &euro;</td>
		</tr>
		<tr>
			<td>Peajes:</td>
			<td class='dato'><?php echo number_format(($dieta['peajes']),2,',','.'); ?> &euro;</td>
		</tr>
		<tr>
			<td>Comidas:</td>
			<td class='dato'><?php echo number_format(($dieta['comidas']),2,',','.'); ?> &euro;</td>
		</tr>
		<tr>
			<td>Otros:</td>
			<td class='dato'><?php echo number_format(($dieta['otros']),2,',','.'); ?> &euro;</td>
		</tr>
		<tr>
			<td>Observaciones (otros):</td>
			<td class='dato'><?php echo $dieta['observaciones']; ?></td>
		</tr>
	</table>
	
	<input type='hidden' name='id' value='<?php  echo $dieta['id']; ?>'></input>
</form>