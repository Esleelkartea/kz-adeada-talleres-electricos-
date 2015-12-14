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
require(RAIZ.'functions/main.php');
require(RAIZ.'struct/registro.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link type="image/x-icon" href="img/iconos/favicon.ico" rel="icon" />
<meta content="GISTEK" name="author"/>
<meta content="GISTEK" name="organization"/>
<meta content="Guipuzcoa" name="locality"/>
<meta content="es" name="lang"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>_:: INSTAGI - Electricistas ::_</title>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<LINK REL=StyleSheet HREF="<?php echo CAL_RUTA_NIVEL1."jscal2.css";?>" TYPE="text/css" MEDIA=screen>
<LINK REL=StyleSheet HREF="<?php echo CAL_RUTA_NIVEL1."border-radius.css";?>" TYPE="text/css" MEDIA=screen>
<LINK REL=StyleSheet HREF="<?php echo CAL_RUTA_NIVEL1."matrix/matrix.css";?>" TYPE="text/css" MEDIA=screen>
</head>

<body>
<div id="general">
  <p><img src="img/logo.jpg" ></img></p><br>
	<div class='mensaje'><?php  echo $registrar; ?></div><br>
	<p>Introduce los datos para realizar el registro en la aplicaci&oacute;n: </p><br>
	
   	<form id="form1" name="form1" method="post" action="registrarse.php" enctype="multipart/form-data">
   	 <input type='hidden' value='registrarse' name='registrarse'></input>
   	 <div style="margin-left:30px">
     <table width="100%" border="0">
      <tr>
        <td width=32%>CIF/NIF:</td>
        <td><input name="registro_cif" type="text" class="valor_defecto" id="cif_nif" accesskey="e" tabindex="1" value="" size='40' /></td>
      </tr>
      <tr>
      	<td></td>
      	<td style="font-size:0.7em; color:red">*El CIF/NIF debe ser introducido sin guiones, sin barras, sin puntos, sin espacios y con la letra correspondiente</td>
      </tr>
      <tr>
        <td>E-mail:</td>
        <td><input name="registro_email" type="text" class="valor_defecto" id="email" accesskey="e" tabindex="1" value="" size='40' /></td>
      </tr>
      <tr>
        <td>Contrase&ntilde;a:</td>
        <td><input name="registro_pass" type="password" class="valor_defecto_sin_cursiva" id="pass" accesskey="u" tabindex="2" value="" size='40' /></td>
      </tr>
      <tr>
      	<td></td>
      	<td style="font-size:0.7em; color:red">*La contrase&ntilde;a debe contar al menos con 4 caracteres (se recomienda que sean 8). Asimismo, tambi&eacute;n es recomendable el uso de n&uacute;meros y letras</td>
      </tr>
      <tr>
        <td>Repetir contrase&ntilde;a:</td>
        <td><input name="registro_pass_2" type="password" class="valor_defecto_sin_cursiva" id="pass_2" accesskey="c" tabindex="3" value="" size='40' /></td>
      </tr>
      <tr>
		<td>Subir logo:</td>
		<td><input type='file' name='logo' id='logo' value=''></input></td>
	  </tr>
	  <tr>
      	<td></td>
      	<td style="font-size:0.7em; color:red">*Se recomienda que las dimensiones del logo sean de 400px de ancho y una altura de hasta 140px</td>
      </tr>
      <tr>
      	<td height=15></td>
      	<td></td>
      	<td></td>
      </tr>
      <tr>
      	<td></td>
      	<td><input style="cursor:pointer; width:90px;" type='submit' name='registrarse' value='Registrarse'></td>
      	<td></td>
      </tr>
     </table>
     </div>
   	</form>
   
   	<div id="volver">
   		<img src="img/iconos/volver.png" /><a href="index.php"> Volver</a>
   	</div>
   	<br></br>
</div>

<script type="text/javascript">
<!--
swfobject.registerObject("FlashID");
//-->
</script>

</body>
</html>
