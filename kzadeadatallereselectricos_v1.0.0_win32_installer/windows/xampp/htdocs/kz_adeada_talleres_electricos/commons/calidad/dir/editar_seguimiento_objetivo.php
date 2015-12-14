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

<?php $seguimiento_objetivo = select_normal("SELECT * FROM kz_tec_dir_seguimientoobjetivos WHERE id = '".$_POST['id_seguimiento_objetivo']."'"); 
if($seguimiento_objetivo)
	foreach($seguimiento_objetivo as $key => $valor){ ?>
	
	  <div id="cuerpo2">
	  	<form action="ficha_objetivo.php" method="post" id="guardar_seguimiento_objetivo_<?php echo $valor['id']; ?>" name="form_guardar">
	  	  <input type='hidden' name='edio_seg_id' value='<?php echo $valor['id']; ?>'></input>
	  	  <input type='hidden' name='edio_obj_id' value='<?php echo $_POST['id_objetivo']; ?>'></input>
	  	  <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	      <table class="tabla_sin_borde" width="100%">
	        <tr>
	          <td width="25%">Fecha:</td>
	          <td><input type='text' name='edio_seg_fecha' id='edio_seg_fecha<?php echo $valor['id']; ?>' value='<?php echo $valor['fecha']; ?>' size='14'></input>
				  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='edit_seg_fecha<?php echo $valor['id']; ?>'>
				  <script>
					Calendar.setup({
					trigger    : "edit_seg_fecha<?php echo $valor['id']; ?>",
					inputField : "edio_seg_fecha<?php echo $valor['id']; ?>"
					});
				  </script>
			  </td>
	        </tr>
	        <tr>
	          <td>Responsable:</td>
	          <td><input type="text" name="edio_seg_responsable" id="edio_seg_responsable" value='<?php echo $valor['responsable']; ?>' size='35' /></td>
	        </tr>
	        <tr>
	          <td>Datos:</td>
	          <td><textarea name="edio_seg_datos" id="edio_seg_datos" cols="70" rows="3"><?php echo $valor['datos']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td>Comentarios:</td>
	          <td><textarea name="edio_seg_observaciones" id="edio_seg_observaciones" cols="70" rows="3"><?php echo $valor['observaciones']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td>Grado de consecuci&oacute;n:</td>
	          <td><select name='edio_grado_consecucion' id='edio_grado_consecucion'>
					<?php combo_base_array($array_grado_consecucion, $valor['grado_consecucion']); ?>
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
	          	<input class="bt-accion" type="button" onclick="$('#guardar_seguimiento_objetivo_<?php echo $valor['id']; ?>').submit();"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          	
				<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />
 	
	          </td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	      </table>
	    </form>
		
		<form action='ficha_objetivo.php' method='post' id='cancelar_<?php echo $valor['id']; ?>'>
			<input type='hidden' name='id_objetivo' value='<?php echo $_POST['id_objetivo']; ?>'></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
		</form>
	  </div>
	<?php }
  
include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
