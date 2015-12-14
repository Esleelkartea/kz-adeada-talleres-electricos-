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
include('../struct/header_dir.php');
require('../functions/dir_functions.php');
require('dir_preacciones.php');
?>

<script>document.getElementById("lnk_direccion").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_ver_objetivos").setAttribute("class", "seleccionado");</script>

<div id="cuerpo2">
    <form action="ficha_objetivo.php" id="crear_seguimiento_objetivo" name="form_crear" method="post">
      <input type='hidden' name='crear_seguimiento_objetivo' value='crear_seguimiento_objetivo'></input>
      <input type='hidden' name='seg_obj' value='<?php echo $_POST['id_objetivo']; ?>'></input>
      <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
      <table class="tabla_sin_borde" width="100%">
        <tr>
          <td width="25%">Fecha:</td>
          <td><input type='text' name='fecha' id='fecha' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal1'>
			  <script>
				Calendar.setup({
				trigger    : "cal1",
				inputField : "fecha"
				});
			  </script>
		  </td>
        </tr>
		<tr>
          <td>Responsable:</td>
          <td><input type="text" name="responsable" id="responsable" value='' size='35' /></td>
        </tr>
		<tr>
          <td>Datos:</td>
          <td><textarea name="datos" id="datos" cols="70" rows="3"></textarea></td>
        </tr>
		<tr>
          <td>Comentarios:</td>
          <td><textarea name="comentarios" id="comentarios" cols="70" rows="3"></textarea></td>
        </tr>
        <tr>
          <td>Grado de consecuci&oacute;n:</td>
          <td><select name='grado_consecucion' id='grado_consecucion'>
				<?php combo_base_array($array_grado_consecucion, ''); ?>
	          </select> %
	      </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
          	<input class="bt-accion" type="button" onclick="$('#crear_seguimiento_objetivo').submit();"  name="img_crear" id="img_crear" value="Crear" />

			<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $_POST['id_objetivo']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />
	
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
    
    <form action='ficha_objetivo.php' method='post' id='cancelar_<?php echo $_POST['id_objetivo']; ?>'>
		<input type='hidden' name='id_objetivo' value='<?php echo $_POST['id_objetivo']; ?>'></input>
		<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	</form>
</div>

<?php include('../struct/footer2.php');?>
  
</div>
</div>

</body>
</html>
