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
<br><h4>Editar dietas</h4><br>

<?php
$criterios = " AND id = ".$_POST['id']."";
$dietas = select_normal("SELECT * FROM kz_te_dietas WHERE 1 = 1 $criterios");
		
$dieta = $dietas[0];
?>

<form action='index.php?menu=administracion_partes' method='POST'>
	<table class="tabla_sin_borde">
		<tr>
			<td width="25%">Fecha:</td>
			<td>
				<?php $fecha = explode('-',$dieta['fecha']); ?>
				<select name="ano"  id="ano" >
         			<?php	
      				combo_base_array($array_annos,$fecha[0]);
      				?>
        		</select> -
        		<select name="mes"  id="mes" >
         			<?php	
      				combo_base_array($array_meses,$fecha[1]);
      				?>
        		</select> -
				<select name="dia"  id="dia" >
         			<?php	
      				combo_base_array($array_dias,$fecha[2]);
      				?>
        		</select>
			</td>
		</tr>
		<tr>
			<td>Km:</td>
			<td><input type='text' name='km' value='<?php echo $dieta['km']; ?>' size='6'></input> km</td>
		</tr>
		<tr>
			<td>Parking / O.T.A.:</td>
			<td><input type='text' name='parking' value='<?php echo $dieta['parking']; ?>' size='6'></input> &euro;</td>
		</tr>
		<tr>
			<td>Peajes:</td>
			<td><input type='text' name='peajes' value='<?php echo $dieta['peajes']; ?>' size='6'></input> &euro;</td>
		</tr>
		<tr>
			<td>Comidas:</td>
			<td><input type='text' name='comidas' value='<?php echo $dieta['comidas']; ?>' size='6'></input> &euro;</td>
		</tr>
		<tr>
			<td>Otros:</td>
			<td><input type='text' name='otros' value='<?php echo $dieta['otros']; ?>' size='6'></input> &euro;</td>
		</tr>
		<tr>
			<td>Observaciones (otros):</td>
			<td><textarea name='observaciones' rows="3" cols="70%" onFocus="this.rows='10';" onBlur="this.rows='3';"><?php echo $dieta['observaciones']; ?></textarea></td>
		</tr>
	</table>
	<br><hr><br>
	
	<input type='hidden' name='editar_dietas' value='true'></input>
	
	Guardar y
	<select class="select-comun" name='seleccion_formulario'>
		<option value=''>Volver al listado</option>
	</select>
	
	<input class="bt-accion"  type='submit' name='accion' value='Continuar' /> 
	<input type='hidden' name='mantener_fecha' value='<?php echo $_POST['mantener_fecha']; ?>'>
	<input type='hidden' name='id' value='<?php  echo $dieta['id']; ?>'></input>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
	
</form>
<br />
<form action='index.php?menu=administracion_partes' method='POST'>
	<input class="bt-accion"  type='submit' name='accion' value='Cancelar' />
	<input type='hidden' name='mantener_fecha' value='<?php echo $_POST['mantener_fecha']; ?>'> 
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>