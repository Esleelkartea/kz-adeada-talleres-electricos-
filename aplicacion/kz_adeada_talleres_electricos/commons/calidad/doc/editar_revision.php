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

<?php $revision = select_normal("SELECT * FROM kz_tec_doc_revisiones WHERE id = '".$_POST['id_revision']."'"); 
if($revision)
	foreach($revision as $key => $valor){ ?>
	
	  <div id="cuerpo2">
	  	<form action="ficha_documento.php" method="post" id="guardar_revision_<?php echo $valor['id']; ?>" name="form_guardar">
	  	  <input type='hidden' name='edirev_id' value='<?php echo $valor['id']; ?>'></input>
	  	    <input type='hidden' name='edid_rev_id' value='<?php echo $_POST['id_documento']; ?>'></input>
	  	  <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	      <table class="tabla_sin_borde" width="100%">
		    <tr>
	          <td width="25%">Revisi&oacute;n:</td>
	          <td><input type="text" name="revision" id="revision" value='<?php echo $valor['rev']; ?>' size='35'></td>
	        </tr>
			<tr>
	          <td>Soporte:</td>
	          <td><input type="text" name="soporte" id="soporte" value='<?php echo $valor['soporte']; ?>' size='35' /></td>
	        </tr>
			<tr>
	          <td>Realizado:</td>
	          <td><input type="text" name="realizado" id="realizado" value='<?php echo $valor['realizado']; ?>' size='35' /></td>
	        </tr>
			<tr>
	          <td>Aprobado:</td>
	          <td><input type="text" name="aprobado" id="aprobado" value='<?php echo $valor['aprobado']; ?>' size='35' /></td>
	        </tr>
	        <tr>
	          <td>Fecha:</td>
	          <td><input type='text' name='fecha' id='fecha' value='<?php echo $valor['fecha']; ?>' size='14'></input>
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
	          <td>Lugar:</td>
	          <td><input type="text" name="lugar" id="lugar" value='<?php echo $valor['lugar']; ?>' size='35' /></td>
	        </tr>
	        <tr>
	          <td>Periodo:</td>
	          <td>
	          <?php $periodo = explode(',',$valor['periodo']); ?>
				<select name="anos"  id="anos" >
         			<?php combo_base_array($array_annos_rev,$periodo[0]);?>
        		</select> a&ntilde;os
				<select name="meses"  id="meses" >
         			<?php combo_base_array($array_meses_rev,$periodo[1]);?>
        		</select> meses
			  </td>
	        </tr>
	        <tr>
	          <td>Desc. cambio:</td>
	          <td><textarea name="cambio" id="cambio" cols="70" rows="3"><?php echo $valor['cambio']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>
	          	<input class="bt-accion" type="button" onclick="$('#guardar_revision_<?php echo $valor['id']; ?>').submit();"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
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
			<input type='hidden' name='id_documento' value='<?php echo $_POST['id_documento']; ?>'></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
		</form>
	  </div>
	<?php }
  
include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
