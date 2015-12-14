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
<?php if($_POST['cambiar_pass']){
	$mensaje = cambiar_pass($_POST['pass_actual'], $_POST['pass_nueva'], $_POST['pass_nueva_2']);
}elseif($_POST['cambiar_logo']){
	$mensaje = cambiar_logo($_FILES['logo']);
}
echo $mensaje;

?>


<p>Introduce los datos necesarios para cambiar la contrase&ntilde;a: </p><br>

<form id="form1" name="form1" method="post" action="index.php">
  <input type='hidden' value='../commons/modificar_clave_logo' name='pag'></input>
  <div style="margin-left:30px">
  <table width="100%" border="0" class="tabla_sin_borde">
      <tr>
        <td width=25%>Contrase&ntilde;a actual:</td>
        <td width="25%"><input name="pass_actual" type="password" class="valor_defecto_sin_cursiva" id="pass_actual" accesskey="e" tabindex="1" value="" size='40' /></td>
      </tr>
      <tr>
        <td>Nueva contrase&ntilde;a:</td>
        <td><input name="pass_nueva" type="password" class="valor_defecto_sin_cursiva" id="pass_nueva" accesskey="u" tabindex="2" value="" size='40' /></td>
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

<?php if(in_array(221,$datos_perfil['PERMISOS'])){?>
<br></br><hr><br />
	<p style="color:black;">Selecciona el logo para cambiarlo: </p><br>
	<form id="form1" name="form1" method="post" action="index.php" enctype="multipart/form-data">
	  <input type='hidden' value='../commons/modificar_clave_logo' name='pag'></input>
	  <div style="margin-left:30px">
	  <table width="100%" border="0" class="tabla_sin_borde">
	      <tr>
	        <td style="color:black;">Subir logo:</td>
	        <td><input type='file' name='logo' id='logo' value=''></input></td>
	      </tr>
	      <tr>
	          <td></td>
	          <td style="font-size:0.7em; color:red">*Se recomienda que las dimensiones del logo sean de 400px de ancho y una altura de hasta 140px</td>
	      </tr>
	      <tr>
	        <td></td>
	        <td><img src="../commons/mostrar_logo.php" width="200px"></img></td>
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
<?php }?>