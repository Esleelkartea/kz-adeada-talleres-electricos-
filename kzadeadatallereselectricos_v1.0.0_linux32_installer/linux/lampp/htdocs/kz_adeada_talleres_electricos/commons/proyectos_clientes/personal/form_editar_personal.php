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
<br><h4>Editar persona</h4><br>

<?php
$criterios = " AND id = ".$_POST['id']."";
$personal = select_normal("SELECT * FROM kz_te_personal WHERE 1 = 1 $criterios ORDER BY nombre");	
$persona = $personal[0];
?>

<form action='index.php?menu=administracion_proyectos' method='POST'>
	<fieldset>
		<legend>Datos de la persona</legend>
		<table class="tabla_sin_borde">
			<tr>
				<td width="25%">Nombre:</td>
				<td><input type='text' name='nombre' value='<?php echo $persona['nombre']; ?>' size=30></input></td>
			</tr>
			<tr>
				<td>Apellidos:</td>
				<td><input type='text' name='apellidos' value='<?php echo $persona['apellidos']; ?>' size=30></input></td>
			</tr>
			<tr>
				<td>Funci&oacute;n:</td>
				<td>
					<select name='funcion'>
						<?php
						$sqlfuncion=select_normal("SELECT * FROM kz_te_funciones ORDER BY funcion");
						foreach($sqlfuncion as $keyfuncion => $valorfuncion){
							if($persona['funcion'] == $valorfuncion['funcion']){
								$funcion_seleccionada = " SELECTED ";
							}
							else $funcion_seleccionada = ""; ?>
							
							<option value='<?php echo $valorfuncion['funcion']; ?>' <?php echo $funcion_seleccionada; ?>>
								<?php echo $valorfuncion['funcion']; ?>
							</option><?php
						} ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Tel&eacute;fono:</td>
				<td><input type='text' name='telefono' value='<?php echo $persona['telefono']; ?>' size=14></input></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type='text' name='email' value='<?php echo $persona['email']; ?>' size=30></input></td>
			</tr>
		</table>
	</fieldset>
	<br>
	
	<fieldset>
		<legend>Datos de usuario</legend>
		<table class="tabla_sin_borde">
			<tr>
				<td width="25%">
					Editar usuario:
				</td>
				<td>
					<input type='checkbox' name='editar_usuario' id='crear_usuario' value='1'>
				</td>
			</tr>
			<tr>
				<td>
					Clave:
				</td>
				<td>
					<input type='text' name='pass_usuario' id='pass_usuario' value='' size='19'></td><td>*Dejar en blanco para autogenerarla
				</td>
			</tr>
			<tr>
				<td>
					Perfil:
				</td>
				<td>
				<?php 
					$obtener_perfil = select_normal("SELECT perfil FROM kz_te_usuarios WHERE id = ".$persona['usuario']."");
					?>
					<select name="perfil"  id="perfil" >
	         			<?php	
	      				combo_base_array_perfiles($ARRAY_PERFILES,$obtener_perfil[0]['perfil']);
	      				?>
        			</select>
				</td>
			</tr>
		</table>
	
	</fieldset>
	<br><hr><br>
	
	<input type='hidden' name='editar_personal' value='true'></input>
	
	Guardar y
	<select class="select-comun" name='seleccion_formulario'>
		<option value=''>Volver al listado</option>
		<option value='ver_ficha'>Ir a la ficha</option>
	</select>
	
	<input class="bt-accion"  type='submit' name='accion' value='Continuar' /> 
	<input type='hidden' name='id' value='<?php  echo $persona['id']; ?>'></input>
	<input type='hidden' name='usuario' value='<?php  echo $persona['usuario']; ?>'></input>
	<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>
<br />
<form action='index.php?menu=administracion_proyectos' method='POST'>
	<input class="bt-accion"  type='submit' name='accion' value='Cancelar' /> 
	<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>