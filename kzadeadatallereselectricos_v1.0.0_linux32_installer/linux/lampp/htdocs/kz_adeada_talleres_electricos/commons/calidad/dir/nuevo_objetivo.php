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
	<form action="ver_objetivos.php" id="crear_objetivo" name="form_crear" method="post">
      <input type='hidden' name='crear_objetivo' value='crear_objetivo'></input>
      <table class="tabla_sin_borde" width="100%" >
        <tr>
          <td width="25%">Objetivo:</td>
          <td><input type="text" name="objetivo" value='' size='35'></td>
        </tr>
        <tr>
          <td>Fecha de creaci&oacute;n:</td>
          <td><input type='text' name='fechacreacion' id='fechacreacion' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal1'>
			  <script>
				Calendar.setup({
				trigger    : "cal1",
				inputField : "fechacreacion"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>A&ntilde;o:</td>
          <td><select name='anno' id='anno'>
				<?php combo_base_array($array_annos, date("Y")); ?>
	          </select>
          </td>
        </tr>        
        <tr>
          <td>Descripci&oacute;n:</td>
          <td><textarea name="descripcion" id="descripcion" cols="70" rows="3"></textarea></td>
        </tr>
        <tr>
          <td>Responsable:</td>
          <td><input type="text" name="responsable" id="responsable" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Periocidad:</td>
          <td>Cada <select name='periodicidad' id='periodicidad'>
				     <?php for($i=0; $i<365; $i++){ ?>
				       <option value='<?php echo $i;?>'><?php echo $i; ?></option>
					 <?php } ?>
				   </select> d&iacute;as
		  </td>
        </tr>
        <tr>
          <td>Plazo de consecuci&oacute;n:</td>
          <td><input type='text' name='plazoconsecucion' id='plazoconsecucion' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal2'>
			  <script>
				Calendar.setup({
				trigger    : "cal2",
				inputField : "plazoconsecucion"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>Cumplido:</td>
          <td><input type='checkbox' name='cumplido' id='cumplido'></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
          	<input class="bt-accion" type="button" onclick="$('#crear_objetivo').submit();"  name="img_crear" id="img_crear" value="Crear" />

			<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />

          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
    
    <form action="ver_objetivos.php" method="post" id="cancelar_<?php echo $valor['id'];?>">
	</form>
</div>
  
<?php include('../struct/footer2.php');?>
   
</div>
</div>

</body>
</html>
