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
<br><h4>Eliminar persona</h4><br>

<div class='mensaje_eliminar'>ATENCI&Oacute;N: Va a eliminar el siguiente registro con su correspondiente usuario. &iquest;Continuar?</div>
<br />
<form action='index.php?menu=administracion_proyectos' method='POST'>	
	<input name='seleccion_formulario' value='' type='hidden'>
	<input class="bt-accion"  type='submit' name='accion' value='CANCELAR' /> 
	<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
	<input class="bt-accion" type='submit' name='eliminar_personal' value='ELIMINAR' />
	<input type='hidden' name='seleccion_formulario' value=''>
	<input type='hidden' name='id' value='<?php  echo $persona['id']; ?>'></input>
	<br><br>
	<?php 
	$criterios = " and id = ".$_POST['id']."";
	$personal = select_normal("SELECT * FROM kz_te_personal WHERE 1 = 1 $criterios ORDER BY nombre");
	$persona = $personal[0];	
	?>
	
	<table class="tabla_sin_borde">
		<tr>
			<td width="25%">Nombre:</td>
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
	
	<input type='hidden' name='id' value='<?php  echo $persona['id']; ?>'></input>
	<input type='hidden' name='usuario' value='<?php  echo $persona['usuario']; ?>'></input>
</form>