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

require('../../functions/globales.php');
require('include/rutas.php');
require('functions/main.php');
require('struct/login2.php');
include('struct/header.php');
include('struct/cambiar_pass.php');
?>

<div id="menu_principal">
	<ul>
		<li><a href="documentacion.php">Documentaci&oacute;n</a></li>
		<li><a href="direccion.php">Direcci&oacute;n</a></li>
		<li><a href="rrhh.php">Formaci&oacute;n</a></li>
		<li><a href="mantenimiento.php">Maquinaria</a></li>
		<li><a href="mejora.php">Mejora</a></li>
		<li id="ir-ainicio"><a href="../../index/index.php">Volver</a></li>
	</ul>
</div>

<br>
<div class='mensaje'><?php  echo $cambiar; ?></div><br>
<p>Introduce los datos necesarios para cambiar la contrase&ntilde;a: </p><br>

<form id="form1" name="form1" method="post" action="cambiar_pass.php">
  <input type='hidden' value='cambiar_pass' name='cambiar_pass'></input>
  <div style="margin-left:30px">
  <table width="100%" border="0" class="tabla_sin_borde">
      <tr>
        <td width=23%>Contrase&ntilde;a actual:</td>
        <td><input name="pass_actual" type="password" class="valor_defecto_sin_cursiva" id="pass_actual" accesskey="e" tabindex="1" value="" size='40' /></td>
      </tr>
      <tr>
        <td>Nueva contrase&ntilde;a:</td>
        <td><input name="pass_nueva" type="password" class="valor_defecto_sin_cursiva" id="pass_nueva" accesskey="u" tabindex="2" value="" size='40' /></td>
      </tr>
      <tr>
      	<td></td>
      	<td style="font-size:0.7em; color:red">*La contrase&ntilde;a debe contar al menos con 4 caracteres (se recomienda que sean 8). Asimismo, tambi&eacute;n es recomendable el uso de n&uacute;meros y letras</td>
      </tr>
      <tr>
        <td>Repetir nueva contrase&ntilde;a:</td>
        <td><input name="pass_nueva_2" type="password" class="valor_defecto_sin_cursiva" id="pass_nueva_2" accesskey="c" tabindex="3" value="" size='40' /></td>
      </tr>
      <tr>
      <td height=15></td>
      <td></td>
      </tr>
      <tr>
      <td></td>
      <td><input style="cursor:pointer; width:90px;" type='submit' name='cambiar_pass' value='Cambiar'></td>
      </tr>
  </table>
  </div>
</form>

<br></br><hr><br />

<p>Selecciona el logo para cambiarlo: </p><br>
<form id="form1" name="form1" method="post" action="cambiar_pass.php" enctype="multipart/form-data">
  <input type='hidden' value='cambiar_logo' name='cambiar_logo'></input>
  <div style="margin-left:30px">
  <table width="100%" border="0" class="tabla_sin_borde">
      <tr>
		<td>Subir logo:</td>
		<td><input type='file' name='logo' id='logo' value=''></input></td>
	  </tr>
	  <tr>
      	<td></td>
      	<td style="font-size:0.7em; color:red">*Se recomienda que las dimensiones del logo sean de 400px de ancho y una altura de hasta 140px</td>
      </tr>
      <tr>
		<td></td>
		<td><img src="../../commons/mostrar_logo.php" width="200px"></img></td>
	  </tr>
      <tr>
      <td height=15></td>
      <td></td>
      </tr>
      <tr>
      <td></td>
      <td><input style="cursor:pointer;" type='submit' name='cambiar_logo' value='Cambiar logo'></td>
      </tr>
  </table>
  </div>
</form>
<br></br>

<?php include('struct/footer.php'); ?>
 
</div>

</body>
</html>
