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
<br><h4>Ficha de cliente</h4><br>

<?php 
$criterios = " and id = '".$_POST['id']."'";
$clientes = select_normal("SELECT * FROM kz_te_clientes WHERE 1 = 1 $criterios");
		
$cliente = $clientes[0];	
?>

<table class="tabla_sin_borde">
	<tr>
		<td width="25%">Cod. cliente:</td>
		<td class='dato'><?php echo $cliente['id']; ?></td>
	</tr>
	<tr>
		<td>CIF:</td>
		<td class='dato'><?php echo $cliente['cif']; ?></td>
	</tr>
	<tr>
		<td>Raz&oacute;n social:</td>
		<td class='dato'><?php echo $cliente['razon_social']; ?></td>
	</tr>
	<tr>
		<td>Nombre comercial:</td>
		<td class='dato'><?php echo $cliente['nombre_comercial']; ?></td>
	</tr>
	<tr>
		<td>Persona de contacto:</td>
		<td class='dato'><?php echo $cliente['responsable_empresa']; ?></td>
	</tr>
	<tr>
		<td>Direcci&oacute;n:</td>
		<td class='dato'><?php echo $cliente['direccion']; ?></td>
	</tr>
	<tr>
		<td>C&oacute;digo postal:</td>
		<td class='dato'><?php echo $cliente['cp']; ?></td>
	</tr>
	<tr>			
		<td>Poblacion:</td>
		<td class='dato'><?php echo $cliente['poblacion']; ?></td>
	</tr>
	<tr>			
		<td>Comarca:</td>
		<td class='dato'><?php echo $cliente['comarca']; ?></td>
	</tr>
	<tr>			
		<td>Provincia:</td>
		<td class='dato'><?php echo $cliente['provincia']; ?></td>
	</tr>
	<tr>			
		<td>Tel&eacute;fono:</td>
		<td class='dato'><?php echo $cliente['telefono']; ?></td>
	</tr>
	<tr>			
		<td>M&oacute;vil:</td>
		<td class='dato'><?php echo $cliente['movil']; ?></td>
	</tr>
	<tr>			
		<td>Fax:</td>
		<td class='dato'><?php echo $cliente['fax']; ?></td>
	</tr>
	<tr>			
		<td>Web:</td>
		<td class='dato'><?php echo $cliente['web']; ?></td>
	</tr>
	<tr>			
		<td>Email:</td>
		<td class='dato'><?php echo $cliente['email']; ?></td>
	</tr>
	<tr>			
		<td>Observaciones:</td>
		<td class='dato'><?php echo $cliente['observaciones']; ?></td>
	</tr>
</table>
<br><hr><br>

<form action='index.php?menu=administracion_proyectos' method='POST'>	
	<select class="select-comun" name='seleccion_formulario'>
		<option value=''>Volver al listado</option>
		<option value='editar_cliente'>Editar cliente</option>
	</select>
		
	<input class="bt-accion"  type='submit' name='accion' value='Continuar' /> 
	<input type='hidden' name='id' value='<?php  echo $cliente['id']; ?>'></input>
	<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>