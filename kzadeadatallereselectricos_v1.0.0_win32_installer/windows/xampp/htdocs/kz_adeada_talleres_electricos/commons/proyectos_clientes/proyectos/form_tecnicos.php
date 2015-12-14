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
<?php
$tecnicos = select_normal("SELECT * FROM kz_te_proyecto_personal WHERE proyecto = '".$_POST['codigo']."'");
?>

<br>
<fieldset>
	<legend><b>Trabajadores asignados al trabajo <?php echo $_POST['codigo']; ?></b></legend>
	<?php if($tecnicos){ ?>
	<table class="tabla_sin_borde">
		<?php 
		foreach ($tecnicos as $key => $valor){ ?>
			<tr>
				<td>
					<?php echo "- ".$ARRAY_TECNICOS[$valor['tecnico']]; ?>
				</td>
				<td>
					<form action='index.php?menu=administracion_proyectos' method='POST'>
						<input class="bt-eliminar" type='submit' name='accion' value='Eliminar'>
						<input type='hidden' name='seleccion_formulario' value='tecnicos'></input>
						<input type='hidden' name='eliminar_tecnico' value='true'>
						<input type='hidden' name='codigo' value='<?php  echo $valor['proyecto']; ?>' />
						<input type='hidden' name='id' value='<?php  echo $valor['id']; ?>' />
						<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
						<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
					</form>
				</td>
			</tr>
			<?php 
			}
		?>
	</table>
	 <?php }
		else{
			echo "<i>(No hay trabajadores)</i>";
		} ?>
</fieldset>
<br>

<form action='index.php?menu=administracion_proyectos' method='POST'>
	<fieldset>
		<legend><b>Asignar t&eacute;cnico</b></legend>
		<table class="tabla_sin_borde">
			<tr>
				<td>Trabajador:</td>
				<td>
					<select name="tecnico" id="tecnico">
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
				</td>
			</tr>
		</table>
	</fieldset>
	<br><hr><br>
	
	<input type='hidden' name='asignar_tecnicos' value='true'></input>
	<input type='hidden' name='codigo' value='<?php  echo $_POST['codigo']; ?>'></input>
	
	Guardar y
	<select class="select-comun" name='seleccion_formulario'>
		<option value='tecnicos'>Asignar otro</option>
		<option value=''>Volver al listado</option>
	</select>
	
	<input class="bt-accion"  type='submit' name='accion' value='Continuar' /> 
	<input type='hidden' name='codigo' value='<?php  echo $_POST['codigo']; ?>'></input>
	<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>

</form>
</br>
<form action='index.php?menu=administracion_proyectos' method='POST'>
	<input class="bt-accion"  type='submit' name='accion' value='Cancelar' /> 
	<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>