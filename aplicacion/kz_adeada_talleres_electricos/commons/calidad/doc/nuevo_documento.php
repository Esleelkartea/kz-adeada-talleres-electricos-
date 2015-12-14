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
include('../struct/header_doc.php');
require('../functions/doc_functions.php');
require('doc_preacciones.php');
?>

<script>document.getElementById("lnk_documentacion").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_ver_documentos").setAttribute("class", "seleccionado");</script>

<div id="cuerpo2">
	<form action="ver_documentos.php" id="crear_documento" name="form_crear" method="post">
      <input type='hidden' name='new_doc' value='new_doc'></input>
      <table class="tabla_sin_borde" width="100%" border="0">
        <tr>
          <td width="25%">Tipo de documento:</td>
          <td><select name='selector_nuevo' id='selector_nuevo'>
				<option value='DOCUMENTO'>DOCUMENTO</option>
				<option value='REGISTRO'>REGISTRO</option>
				<option value='DOC / REG'>DOC / REG</option>
				<option value='MANUAL'>MANUAL</option>
				<option value='PROCEDIMIENTO'>PROCEDIMIENTO</option>
				<option value='NORMAS'>NORMAS</option>
				<option value='IMPRESO'>IMPRESO</option>
				<option value='INSTRUCCION'>INSTRUCCION</option>
				<option value='CERTIFICADO'>CERTIFICADO</option>
				<option value='OTROS'>OTROS</option>
			  </select>
		  </td>
        </tr>
        <tr>
          <td>C&oacute;digo:</td>
          <td><input type="text" name="new_codigo" id="new_codigo" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Nombre:</td>
          <td><input type="text" name="new_nombre" id="new_nombre" value='' size='35' /></td>
        </tr>        
        <tr>
          <td>Descripci&oacute;n:</td>
          <td><textarea name="new_descripcion" id="new_descripcion" cols="70" rows="3"></textarea></td>
        </tr>
        <tr>
          <td>Aprobado:</td>
          <td><input type="text" name="new_aprobado" id="new_aprobado" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Generado:</td>
          <td><input type="text" name="new_generado" id="new_generado" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Tipo:</td>
          <td><input type="text" name="new_tipo" id="new_tipo" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Soporte:</td>
          <td><input type="text" name="new_soporte" id="new_soporte" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Realizado:</td>
          <td><input type="text" name="new_realizado" id="new_realizado" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Fecha:</td>
          <td><input type='text' name='new_fecha' id='new_fecha' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal1'>
			  <script>
				Calendar.setup({
				trigger    : "cal1",
				inputField : "new_fecha"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>Vigor:</td>
          <td><Select name='new_vigor' id='new_vigor' ><option value='1'>Si</option><option value='0'>No</option></select></td>
        </tr>
        <tr>
          <td>Interno:</td>
          <td><select name='new_interno' id='new_interno'><option value='1'>Si</option><option value='0'>No</option></select></td>
        </tr>
        <tr>
          <td>Lugar:</td>
          <td><input type="text" name="new_lugar" id="new_lugar" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Periodo:</td>
          <td><select name='new_anos' id='new_anos'>
				<?php for($i = 0; $i < 30; $i++){
					echo "<option value='$i'>$i</option>";
				}?>
			  </select> a&ntilde;os
			  <select name='new_meses' id='new_meses'>
				<?php for($i = 0; $i < 13; $i++){
					echo "<option value='$i'>$i</option>";
				}?>
			  </select> meses
		  </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
          	<input class="bt-accion" type="button" onclick="$('#crear_documento').submit();"  name="img_crear" id="img_crear" value="Crear" />

			<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />

          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
    
    <form action="ver_documentos.php" method="post" id="cancelar_<?php echo $valor['id'];?>">
	</form>
</div>
  
<?php include('../struct/footer2.php');?>
   
</div>
</div>

</body>
</html>
