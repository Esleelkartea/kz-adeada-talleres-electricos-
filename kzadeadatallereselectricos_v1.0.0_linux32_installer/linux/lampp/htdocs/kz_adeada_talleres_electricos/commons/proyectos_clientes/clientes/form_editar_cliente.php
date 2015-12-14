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
<br><h4>Editar cliente</h4><br>

<?php 
$criterios = " AND id = '".$_POST['id']."'";
$clientes = select_normal("SELECT * FROM kz_te_clientes WHERE 1 = 1 $criterios");
		
$cliente = $clientes[0];	
?>

<form action='index.php?menu=administracion_proyectos' method='POST'>
	<table class="tabla_sin_borde">
		<tr>
			<td>Cod. cliente:</td>
			<td><?php echo $cliente['id']; ?></td>
		</tr>
		<tr>
			<td>CIF:</td>
			<td><input type='text' name='cif' value='<?php echo $cliente['cif']; ?>'></input></td>
		</tr>
		<tr>
			<td>Raz&oacute;n social:</td>
			<td><input type='text' name='razon_social' value='<?php echo $cliente['razon_social']; ?>' size=50></input></td>
		</tr>
		<tr>
			<td>Nombre comercial:</td>
			<td><input type='text' name='nombre_comercial' value='<?php echo $cliente['nombre_comercial']; ?>' size=50></input></td>
		</tr>
		<tr>
			<td>Persona de contacto:</td>
			<td><input type='text' name='responsable_empresa' value='<?php echo $cliente['responsable_empresa']; ?>' size=50></input></td>
		</tr>
		<tr>
			<td>Direcci&oacute;n:</td>
			<td><input type='text' name='direccion' value='<?php echo $cliente['direccion']; ?>' size=50></input></td>
		</tr>
		<tr>
			<td>C&oacute;digo postal:</td>
			<td><input type='text' name='cp' value='<?php echo $cliente['cp']; ?>'></input></td>
		</tr>
		<tr>
			<td>Poblaci&oacute;n:</td>
			<td><input type='text' name='poblacion' value='<?php echo $cliente['poblacion']; ?>' size=30></input></td>
		</tr>
		<tr>
			<td>Comarca:</td>
			<td><input type='text' name='comarca' value='<?php echo $cliente['comarca']; ?>' size=30></input></td>
		</tr>
		<tr>
			<td>Provincia:</td>
			<td><input type='text' name='provincia' value='<?php echo $cliente['provincia']; ?>' size=30></input></td>
		</tr>
		<tr>
			<td>Tel&eacute;fono:</td>
			<td><input type='text' name='telefono' value='<?php echo $cliente['telefono']; ?>' size=30></input></td>
		</tr>
		<tr>
			<td>M&oacute;vil:</td>
			<td><input type='text' name='movil' value='<?php echo $cliente['movil']; ?>' size=30></input></td>
		</tr>
		<tr>
			<td>Fax:</td>
			<td><input type='text' name='fax' value='<?php echo $cliente['fax']; ?>' size=30></input></td>
		</tr>
		<tr>
			<td>Web:</td>
			<td><input type='text' name='web' value='<?php echo $cliente['web']; ?>' size=30></input></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type='text' name='email' value='<?php echo $cliente['email']; ?>' size=30></input></td>
		</tr>
		<tr>
			<td>Observaciones:</td>
			<td><textarea cols="100" rows="5" name='observaciones'><?php echo $cliente['observaciones']; ?></textarea></td>
		</tr>
	</table>
	<br><hr><br>
	
	<input type='hidden' name='editar_cliente' value='true'></input>
	
	Guardar y
	<select class="select-comun" name='seleccion_formulario'>
		<option value=''>Volver al listado</option>
		<option value='ver_ficha'>Ir a la ficha</option>
	</select>
	
	<input class="bt-accion"  type='submit' name='accion' value='Continuar' /> 
	<input type='hidden' name='id' value='<?php  echo $cliente['id']; ?>'></input>
	<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>
<br />
<form action='index.php?menu=administracion_proyectos' method='POST'>
	<input class="bt-accion"  type='submit' name='accion' value='Cancelar' /> 
	<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>