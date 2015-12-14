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
require('../../../functions/globales.php');
require('../include/rutas.php');
require('../functions/main.php');
require('../struct/login2.php');
include('../struct/header_rrhh.php');
require('../functions/rrhh_functions.php');
require('rrhh_preacciones.php');
?>

<script>document.getElementById("lnk_rrhh").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_ver_personal").setAttribute("class", "seleccionado");</script>

<div id="cuerpo2">
	<form action="ver_personal.php" id="crear_persona" name="form_crear" method="post">
      <input type='hidden' name='crear_personal' value='crear_personal'></input>
      <table class="tabla_sin_borde" width="100%">
        <tr>
          <td width="25%">Nombre:</td>
          <td><input type="text" name="nombre" id="nombre" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Apellido:</td>
          <td><input type="text" name="apellidos" id="apellidos" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Tel&eacute;fono:</td>
          <td><input type="text" name="telefono" id="telefono" value='' size='14' /></td>
        </tr>        
        <tr>
          <td>M&oacute;vil:</td>
          <td><input type="text" name="movil" id="movil" value='' size='14' /></td>
        </tr>
        <tr>
          <td>Email:</td>
          <td><input type="text" name="email" id="email" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Direcci&oacute;n:</td>
          <td><input type="text" name="direccion" id="direccion" value='' size='60' /></td>
        </tr>
        <tr>
          <td>C.P.:</td>
          <td><input type="text" name="cp" id="cp" value='' size='14' /></td>
        </tr>
        <tr>
          <td>Poblaci&oacute;n:</td>
          <td><input type="text" name="poblacion" id="poblacion" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Fecha de nacimiento:</td>
          <td><input type='text' name='fecha_nacimiento' id='fecha_nacimiento' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal1'>
			  <script>
				Calendar.setup({
				trigger    : "cal1",
				inputField : "fecha_nacimiento"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>DNI:</td>
          <td><input type="text" name="dni" id="dni" value='' size='14' /></td>
        </tr>
        <tr>
          <td>N&deg; Seg. Social:</td>
          <td><input type="text" name="seg_social" id="seg_social" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Centro:</td>
          <td><input type="text" name="centro" id="centro" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Alta:</td>
          <td><input type='text' name='alta' id='alta' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal2'>
			  <script>
				Calendar.setup({
				trigger    : "cal2",
				inputField : "alta"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>Funciones:</td>
          <td><textarea name="funciones" id="funciones" cols="70" rows="3"></textarea></td>
        </tr>
          <tr>
          <td>Titulaci&oacute;n:</td>
          <td><textarea name="titulacion" id="titulacion" cols="70" rows="3"></textarea></td>
        </tr>
          <tr>
          <td>Formaci&oacute;n:</td>
          <td><textarea name="formacion" id="formacion" cols="70" rows="3"></textarea></td>
        </tr>
          <tr>
          <td>Experiencia:</td>
          <td><textarea name="experiencia" id="experiencia" cols="70" rows="3"></textarea></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
          	<input class="bt-accion" type="button" onclick="$('#crear_persona').submit();"  name="img_crear" id="img_crear" value="Crear" />
          	
			<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />

          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
    
    <form action="ver_personal.php" method="post" id="cancelar_<?php echo $valor['id'];?>">
	</form>
</div>
  
<?php include('../struct/footer2.php');?>
   
</div>
</div>

</body>
</html>
