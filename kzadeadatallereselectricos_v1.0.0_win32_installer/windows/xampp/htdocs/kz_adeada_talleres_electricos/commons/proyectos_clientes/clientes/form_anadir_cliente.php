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
<br><h4>A&ntilde;adir cliente</h4><br>

<form action='index.php?menu=administracion_proyectos' method='POST'>
	<table class="tabla_sin_borde">
		<tr>
			<td>Cod. cliente:</td>
			<td><input type='text' name='codigo' value=''></input></td>
		</tr>
		<tr>
			<td>CIF:</td>
			<td><input type='text' name='cif' value=''></input></td>
		</tr>
		<tr>
			<td>Raz&oacute;n social:</td>
			<td><input type='text' name='razon_social' value='' size=50></input></td>
		</tr>
		<tr>
			<td>Nombre:</td>
			<td><input type='text' name='nombre_comercial' value='' size=50></input></td>
		</tr>
		<tr>
			<td>Persona de contacto:</td>
			<td><input type='text' name='responsable_empresa' value='' size=50></input></td>
		</tr>
		<tr>
			<td>Direcci&oacute;n:</td>
			<td><input type='text' name='direccion' value='' size=50></input></td>
		</tr>
		<tr>
			<td>C&oacute;digo postal:</td>
			<td><input type='text' name='cp' value=''></input></td>
		</tr>
		<tr>
			<td>Poblaci&oacute;n:</td>
			<td><input type='text' name='poblacion' value='' size=30></input></td>
		</tr>
		<tr>
			<td>Comarca:</td>
			<td><input type='text' name='comarca' value='' size=30></input></td>
		</tr>
		<tr>
			<td>Provincia:</td>
			<td><input type='text' name='provincia' value='' size=30></input></td>
		</tr>
		<tr>
			<td>Tel&eacute;fono:</td>
			<td><input type='text' name='telefono' value='' size=30></input></td>
		</tr>
		<tr>
			<td>M&oacute;vil:</td>
			<td><input type='text' name='movil' value='' size=30></input></td>
		</tr>
		<tr>
			<td>Fax:</td>
			<td><input type='text' name='fax' value='' size=30></input></td>
		</tr>
		<tr>
			<td>Web:</td>
			<td><input type='text' name='web' value='' size=30></input></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type='text' name='email' value='' size=30></input></td>
		</tr>
		<tr>
			<td>Observaciones:</td>
			<td><textarea cols="100" rows="5" name='observaciones'></textarea></td>
		</tr>
	</table>
	<br><hr><br>
	
	<input type='hidden' name='anadir_cliente' value='true'></input>
	
	Guardar y
	<select class="select-comun" name='seleccion_formulario'>
		<option value='objetivos'>A&ntilde;adir objetivos</option>
		<option value='anadir_cliente'>A&ntilde;adir m&aacute;s</option>
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