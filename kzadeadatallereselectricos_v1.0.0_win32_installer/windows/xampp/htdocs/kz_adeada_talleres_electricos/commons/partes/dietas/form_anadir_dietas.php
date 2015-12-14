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
<br><h4>A&ntilde;adir dietas</h4><br>

<form action='index.php?menu=administracion_partes' method='POST'>
	<table class="tabla_sin_borde">
		<tr>
		<?php if($_POST['pag'] == '../commons/partes/parte_diario'){ ?>
			<td width="25%">Fecha:</td>
			<td>
				<?php $fecha = explode('-', $_POST['mantener_fecha']) ?>
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
		<?php }
		else{ ?>
			<td>Fecha:</td>
			<td>
				<select name="ano"  id="ano" >
         			<?php	
      				combo_base_array($array_annos,date("Y"));
      				?>
        		</select> -
        		<select name="mes"  id="mes" >
         			<?php	
      				combo_base_array($array_meses,date("m"));
      				?>
        		</select> -
				<select name="dia"  id="dia" >
         			<?php	
      				combo_base_array($array_dias,date("d"));
      				?>
        		</select>
			</td>
			<?php }?>
		</tr>
		<tr>
			<td>Km:</td>
			<td><input type='text' name='km' value='' size='6'></input> km</td>
		</tr>
		<tr>
			<td>Parking / O.T.A.:</td>
			<td><input type='text' name='parking' value='' size='6'></input> &euro;</td>
		</tr>
		<tr>
			<td>Peajes:</td>
			<td><input type='text' name='peajes' value='' size='6'></input> &euro;</td>
		</tr>
		<tr>
			<td>Comidas:</td>
			<td><input type='text' name='comidas' value='' size='6'></input> &euro;</td>
		</tr>
		<tr>
			<td>Otros:</td>
			<td><input type='text' name='otros' value='' size='6'></input> &euro;</td>
		</tr>
		<tr>
			<td>Observaciones (otros):</td>
			<td><textarea name='observaciones' rows="3" cols="70%" onFocus="this.rows='10';" onBlur="this.rows='3';"></textarea></td>
		</tr>
	</table>
	<br><hr><br>
	
	<input type='hidden' name='anadir_dietas' value='true'></input>
	
	Guardar y
	<select class="select-comun" name='seleccion_formulario'>
		<option value='anadir_dietas'>A&ntilde;adir m&aacute;s</option>
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