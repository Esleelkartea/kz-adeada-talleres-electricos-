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
<script>document.getElementById("lnk_ver_perfiles").setAttribute("class", "seleccionado");</script>

<div id="cuerpo2">
	<form action="ver_perfiles.php" id="crear_perfil" name="form_crear" method="post">
      <input type='hidden' name='crear_perfil' value='crear_perfil'></input>
      <table class="tabla_sin_borde" width="100%">
        <tr>
          <td width="25%">Nombre:</td>
          <td>
          	Selecci&oacute;nalo:
          	<select name="nombre" id="nombre" onChange="$('#nuevo_nombre').attr('value', this.value);">
          		<option value=''></option>
	         	<?php $nombres = select_normal("SELECT * FROM kz_tec_rrhh_nombresperfiles");
	      		foreach($nombres as $keynombre => $valornombre){?>
	      			<option value='<?php echo $valornombre['nombre']; ?>'>
	      				<?php echo $valornombre['nombre']; ?>
	      			</option>
	      			<?php }?>
	      	</select>
	      	, o introduce uno nuevo:
	      	<input type='text' name='nuevo_nombre' id='nuevo_nombre' value='' size=35></input>
	      </td>
        </tr>
        <tr>
          <td>Funciones:</td>
          <td><textarea name="funciones" id="funciones" cols="95" rows="3"></textarea></td>
        </tr>
        <tr>
          <td>Formaci&oacute;n:</td>
          <td><textarea name="formacion" id="formacion" cols="95" rows="3"></textarea></td>
        </tr>        
        <tr>
          <td></td>
          <td><select name='forvsexp'><?php combo_base_array(array('Y','O'),''); ?></select></td>
        </tr>
        <tr>
          <td>Experiencia:</td>
          <td><textarea name="experiencia" id="experiencia" cols="95" rows="3"></textarea></td>
        </tr>
        <tr>
          <td>Caracter&iacute;sticas:</td>
          <td><textarea name="caracteristicas" id="caracteristicas" cols="95" rows="3"></textarea></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
          	<input class="bt-accion" type="button" onclick="$('#crear_perfil').submit();"  name="img_crear" id="img_crear" value="Crear" />
          	
			<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
    
    <form action="ver_perfiles.php" method="post" id="cancelar_<?php echo $valor['id'];?>">
	</form>
</div>
  
<?php include('../struct/footer2.php');?>
   
</div>
</div>

</body>
</html>
