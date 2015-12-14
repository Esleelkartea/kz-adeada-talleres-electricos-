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
include('../struct/header_mej.php');
require('../functions/mej_functions.php');
require('mej_preacciones.php');
?>

<script>document.getElementById("lnk_mejora").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_ver_acpm").setAttribute("class", "seleccionado");</script>

<div id="limpiar"></div>

<div id="cuerpo2">
	<form action="ver_acpm.php" id="crear_acpm" name="form_crear" method="post">
      <input type='hidden' name='new_acpm' value='new_acpm'></input>
      <table class="tabla_sin_borde" width="100%">
        <tr>
          <td width="19%">N&deg; NC:</td>
          <td><select name="num_nc"  id="num_nc">
	         	<?php $noconf=select_normal("SELECT * FROM kz_tec_mej_noconformidades");?>
	         	<option></option><?php
	      		foreach($noconf as $keynoconf => $valornoconf){?>
	      			<option value='<?php echo $valornoconf['id']; ?>'>
	      				<?php echo $valornoconf['cnc']; ?> ||
	      				<?php echo $valornoconf['tipoNC']; ?> ||
	      				<?php echo $valornoconf['descripcion']; ?> ||
	      				<?php echo $valornoconf['fecha_deteccion']; ?>
	      			</option>
	      		<?php }?>
	          </select>
	      </td>
        </tr>
        <tr>
          <td>Fecha de apertura:</td>
          <td><input type='text' name='fecha_apertura' id='fecha_apertura' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal3'>
			  <script>
				Calendar.setup({
				trigger    : "cal3",
				inputField : "fecha_apertura"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>Causa probable:</td>
          <td><textarea name="causa_probable" id="causa_probable" cols="70" rows="3"></textarea></td>
        </tr>        
        <tr>
          <td>Tipo acci&oacute;n:</td>
          <td>
          	<select name="tipo_accion"  id="tipo_accion" >
         		<?php combo_base_array(array('Correctiva', 'Mejora'),$valor['tipo_accion']);?>
       	 	</select>
	      </td>
        </tr>
        <tr>
          <td>Descripci&oacute;n acci&oacute;n:</td>
          <td><textarea name="descripcion_accion" id="descripcion_accion" cols="70" rows="3"></textarea></td>
        </tr>
        <tr>
          <td>Fecha prevista cierre:</td>
          <td><input type='text' name='fecha_prevista_cierre' id='fecha_prevista_cierre' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal2'>
			  <script>
				Calendar.setup({
				trigger    : "cal2",
				inputField : "fecha_prevista_cierre"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>Seguimiento acci&oacute;n:</td>
          <td><textarea name="seguimiento" cols="70" rows="5"></textarea></td>
        </tr>
        <tr>
          <td>Valoraci&oacute;n eficacia acci&oacute;n:</td>
          <td><textarea name="valoracion" id="valoracion" cols="70" rows="3"></textarea></td>
        </tr>
        <tr>
          <td>Fecha cierre:</td>
          <td><input type='text' name='fecha_cierre' id='fecha_cierre' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal1'>
			  <script>
				Calendar.setup({
				trigger    : "cal1",
				inputField : "fecha_cierre"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>Responsable cierre:</td>
          <td><input type="text" name="responsable" id="responsable" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Cierre eficaz:</td>
          <td><input name='cierre_eficaz_nuevo' type="checkbox" id='cierre_eficaz_nuevo'  onClick="if(this.checked){ $('#cierre_eficaz').attr('value','1');  } else{ $('#cierre_eficaz').attr('value','0'); }">
          	  <input name='cierre_eficaz' type="hidden" id='cierre_eficaz' value='0'>
          </td>
        </tr>
         <tr>
          <td>Coste de la acci&oacute;n:</td>
          <td><input type="text" name="coste" id="coste" value='' size='14' /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
          	<input class="bt-accion" type="button" onclick="$('#crear_acpm').submit();"  name="img_crear" id="img_crear" value="Crear" />

			<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />

          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
    
    <form action="ver_acpm.php" method="post" id="cancelar_<?php echo $valor['id'];?>">
	</form>
    
</div>
  
<?php include('../struct/footer2.php');?>
   
</div>
</div>

</body>
</html>
