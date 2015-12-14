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
include('../struct/header_mant.php');
require('../functions/mant_functions.php');
require('mant_preacciones.php');
?>

<script>document.getElementById("lnk_mantenimiento").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_ver_equipos").setAttribute("class", "seleccionado");</script>

<div id="cuerpo2">
	<form action="ver_equipos.php" id="crear_equipo" name="form_crear" method="post">
      <input type='hidden' name='crear_equipo' value='crear_equipo'></input>
      <table class="tabla_sin_borde" width="100%">
        <tr>
          <td width="25%">N&ordm;:</td>
          <td><input type="text" name="numero" id='numero' value='' size='14'></td>
        </tr>
        <tr>
          <td>A&ntilde;o de fabricaci&oacute;n:</td>
          <td><select name='anofab' id='anofab'>
				<?php combo_base_array($array_annos, date("Y")); ?>
	          </select>
          </td>
        </tr>
        <tr>
          <td>Ref.:</td>
          <td><input type="text" name="ref" id="ref" value='' size='14'></td>
        </tr>        
        <tr>
          <td>Fabricante:</td>
          <td><input type="text" name="fabricante" id="fabricante" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Modelo:</td>
          <td><input type="text" name="modelo" id="modelo" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Tipo:</td>
          <td><input type="text" name="tipo" id="tipo" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Referencia:</td>
          <td><input type="text" name="referencia" id="referencia" value='' size='14'></td>
        </tr>
        <tr>
          <td>Elemento:</td>
          <td><input type="text" name="elemento" id="elemento" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Descripci&oacute;n:</td>
          <td><textarea name="descripcion" id="descripcion" cols="70" rows="3"></textarea></td>
        </tr>
        <tr>
          <td>Categor&iacute;a:</td>
          <td>
          	Selecci&oacute;nala:
          	<select name="que_categoria" id="que_categoria" onChange="$('#categoria').attr('value', this.value);">
       	 		<option value=''></option>
         		<?php $categoria=select_normal("SELECT * FROM kz_tec_mant_categoria");
      			foreach($categoria as $keycategoria => $valorcategoria){?>
      				<option value='<?php echo $valorcategoria['categoria']; ?>'>
      					<?php echo $valorcategoria['categoria']; ?>
      				</option>
      			<?php }?>
			</select>
			, o introduce una nueva:
			<input type='text' name='categoria' id='categoria' value=''></input>
		  </td>
        </tr>
        <tr>
          <td>Estado:</td>
          <td>
          	<select name="estado"  id="estado" >
         		<?php combo_base_array(array('BUENO','MALO','SATISFACTORIO'),'');?>
        	</select>
          </td>
        </tr>
        <tr>
          <td>Ubicaci&oacute;n:</td>
          <td>
          	Selecci&oacute;nala:
          	<select name="que_ubicacion" id="que_ubicacion" onChange="$('#ubicacion').attr('value', this.value);">
       	 		<option value=''></option>
         		<?php $ubicacion=select_normal("SELECT * FROM kz_tec_mant_ubicacion");
      			foreach($ubicacion as $keyubicacion => $valorubicacion){?>
      				<option value='<?php echo $valorubicacion['ubicacion']; ?>'>
      					<?php echo $valorubicacion['ubicacion']; ?>
      				</option>
      			<?php }?>
			</select>
			, o introduce una nueva:
			<input type='text' name='ubicacion' id='ubicacion' value=''></input>
		  </td>
        </tr>
        <tr>
          <td>Fecha de adq.:</td>
          <td><input type='text' name='fechaadq' id='fechaadq' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal1'>
			  <script>
				Calendar.setup({
				trigger    : "cal1",
				inputField : "fechaadq"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>Precio:</td>
          <td><input type="text" name="precioadq" id="precioadq" value='' size='14'></td>
        </tr>
        <tr>
          <td>S/N:</td>
          <td><input type="text" name="sn" id="sn" value='' size='14'></td>
        </tr>
        <tr>
          <td>Fecha de retirada:</td>
          <td><input type='text' name='fecharetirada' id='fecharetirada' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal2'>
			  <script>
				Calendar.setup({
				trigger    : "cal2",
				inputField : "fecharetirada"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>Funci&oacute;n:</td>
          <td><input type="text" name="funcion" id="funcion" value='' size='35'></td>
        </tr>
        <tr>
          <td>CEE:</td>
          <td><input type="text" name="cee" id="cee" value='' size='14'></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
          	<input class="bt-accion" type="button" onclick="$('#crear_equipo').submit();"  name="img_crear" id="img_crear" value="Crear" />

			<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />

          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
    
    <form action="ver_equipos.php" method="post" id="cancelar_<?php echo $valor['id'];?>">
	</form>
</div>
  
<?php include('../struct/footer2.php');?>
   
</div>
</div>

</body>
</html>
