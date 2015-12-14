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
<br><h4>A&ntilde;adir persona</h4><br>

<form action='index.php?menu=administracion_proyectos' method='POST'>
<fieldset><legend>Datos de la persona</legend>
	<table class="tabla_sin_borde">
		<tr>
			<td width="25%">Nombre:</td>
			<td><input type='text' name='nombre' value='<?php echo $_POST['nombre']; ?>' size=30></input></td>
		</tr>
		<tr>
			<td>Apellidos:</td>
			<td><input type='text' name='apellidos' value='<?php echo $_POST['apellidos']; ?>' size=30></input></td>
		</tr>
		<tr>
			<td>Funci&oacute;n:</td>
			<td>
				<select name='funcion'>
					<?php 
					$funciones = mostrar_funciones();
					
					combo_base_array($funciones, $_POST['funcion']);
					
					 ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Tel&eacute;fono:</td>
			<td><input type='text' name='telefono' value='<?php echo $_POST['telefono']; ?>' size=14></input></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type='text' name='email' value='<?php echo $_POST['email']; ?>' size=30></input></td>
		</tr>
		
	</table>
	</fieldset>
	<br>
	<fieldset><legend>Datos de usuario</legend>
	<table class="tabla_sin_borde">
	<tr>
			<td width="25%">
				Crear usuario:</td><td>
				<input type='checkbox' name='crear_usuario' id='crear_usuario' value='1' checked></td></tr>
				<tr>
				<td>
				Nombre de usuario:</td><td>
				<input type='text' name='nombre_usuario' id='nombre_usuario' value='<?php echo $_POST['nombre_usuario']; ?>' size='19'></td></tr>
				<tr>
				<td>
				Clave:</td><td>
				<input type='text' name='pass_usuario' id='pass_usuario' value='<?php echo $_POST['pass_usuario']; ?>' size='19'></td><td>*Dejar en blanco para autogenerarla</td></tr>
				<tr><td>
				Perfil:</td><td>
				<select name="perfil" id="perfil">
	         		<?php
	         		$perfil=select_normal("SELECT * FROM kz_te_s_perfil ORDER BY nombre");
	      			foreach($perfil as $keyperfil => $valorperfil){
	      				?>
	      				<option value='<?php echo $valorperfil['id']; ?>'>
	      					<?php echo $valorperfil['nombre']; ?>
	      				</option><?php
	      			}
	      			?>
       			</select>
			</td>
		</tr>
	</table>
	
	</fieldset>
	<br><hr><br>
	
	<input type='hidden' name='anadir_personal' value='true'></input>
	
	Guardar y
	<select class="select-comun" name='seleccion_formulario'>
		<option value='anadir_personal'>A&ntilde;adir m&aacute;s</option>
		<option value=''>Volver al listado</option>
	</select>
	
	<input class="bt-accion"  type='submit' name='accion' value='Continuar' /> 
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>
<br />
<form action='index.php?menu=administracion_proyectos' method='POST'>
	<input class="bt-accion"  type='submit' name='accion' value='Cancelar' /> 
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>