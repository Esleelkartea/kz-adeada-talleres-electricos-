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

<?php $documento = select_normal("SELECT * FROM kz_tec_doc_documentos WHERE id = '".$_POST['id_documento']."'"); 
if($documento)
	foreach($documento as $key => $valor){ ?>
	
	  <div id="cuerpo2">
	  	<form action="ficha_documento.php" method="post" id="guardar_documento_<?php echo $valor['id']; ?>" name="form_guardar">
	  	  <input type='hidden' name='edid_id' value='<?php echo $valor['id']; ?>'></input>
	  	  <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	      <table class="tabla_sin_borde" width="100%">
	        <tr>
	          <td width="25%">Tipo de documento:</td>
	          <td>
				<select name="tipo_documento"  id="tipo_documento" >
         			<?php combo_base_array(array('DOCUMENTO', 'REGISTRO', 'DOC / REG', 'MANUAL', 'PROCEDIMIENTO', 'NORMAS', 'IMPRESO', 'INSTRUCCION', 'CERTIFICADO', 'OTROS'),$valor['tipo']);?>
       			</select>
			  </td>
	        </tr>
	        <tr>
	          <td>C&oacute;digo:</td>
	          <td><input type="text" name="edid_cod" id="edid_cod" value='<?php echo $valor['cod']; ?>' size='35'></td>
	        </tr>
	        <tr>
	          <td>Nombre:</td>
	          <td><input type="text" name="edid_nombre" id="edid_nombre" value='<?php echo $valor['nombre']; ?>' size='35' /></td>
	        </tr>        
	        <tr>
	          <td>Descripci&oacute;n:</td>
	          <td><textarea name="edid_descripcion" id="edid_descripcion" cols="70" rows="3"><?php echo $valor['descripcion']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td>Tipo:</td>
	          <td><input type="text" name="edid_tipo" id="edid_tipo" value='<?php echo $valor['tipo_doc']; ?>' size='35'></td>
	        </tr>
	        <tr>
	          <td>Generado:</td>
	          <td><input type="text" name="generado" id="generado" value='<?php echo $valor['generado']; ?>' size='35'></td>
	        </tr>
	        <tr>
	          <td>Interno:</td>
	          <?php switch ($valor['interno']){ 
	          		case 1: 
	          			$v1 = "<option value='1'>Si</option><option value='0'>No</option>"; 
	          			break; 
	          		default: 
	          			$v1 = "<option value='0'>No</option><option value='1'>Si</option>"; 
	          			break; 
	          }?>
	          <td><Select name='edid_interno' id='edid_interno' ><?php echo $v1; ?></select></td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>
	          	<input class="bt-accion" type="button" onclick="$('#guardar_documento_<?php echo $valor['id']; ?>').submit();"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          	
				<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />
 	
	          </td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	      </table>
	    </form>
		
		<form action='ficha_documento.php' method='post' id='cancelar_<?php echo $valor['id']; ?>'>
			<input type='hidden' name='id_documento' value='<?php echo $valor['id']; ?>'></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
		</form>
	  </div>
	<?php }
  
include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
