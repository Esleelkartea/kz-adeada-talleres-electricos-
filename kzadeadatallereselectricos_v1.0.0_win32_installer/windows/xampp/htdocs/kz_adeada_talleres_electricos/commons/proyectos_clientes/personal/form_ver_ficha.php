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
<br><h4>Ficha de persona</h4><br>

<?php 
$criterios = " and id = ".$_POST['id']."";
$personal = select_normal("SELECT * FROM kz_te_personal WHERE 1 = 1 $criterios ORDER BY nombre");
		
$persona = $personal[0];	
?>

<table>
	<tr>
		<td>Nombre:</td>
		<td class='dato'><?php echo $persona['nombre']; ?></td>
	</tr>
	<tr>
		<td>Apellidos:</td>
		<td class='dato'><?php echo $persona['apellidos']; ?></td>
	</tr>
	<tr>
		<td>Funci&oacute;n:</td>
		<td class='dato'><?php echo $persona['funcion']; ?></td>
	</tr>
	<tr>
		<td>Tel&eacute;fono:</td>
		<td class='dato'><?php echo $persona['telefono']; ?></td>
	</tr>
	<tr>
		<td>Email:</td>
		<td class='dato'><?php echo $persona['email']; ?></td>
	</tr>
</table>
<br><hr><br>

<form action='index.php?menu=administracion_proyectos' method='POST'>	
	<select class="select-comun" name='seleccion_formulario'>
		<option value=''>Volver al listado</option>
		<option value='editar_personal'>Editar persona</option>
	</select>
		
	<input class="bt-accion"  type='submit' name='accion' value='Continuar' /> 
	<input type='hidden' name='id' value='<?php  echo $persona['id']; ?>'></input>
	<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>