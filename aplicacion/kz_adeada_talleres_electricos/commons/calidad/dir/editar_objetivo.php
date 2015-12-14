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

<?php $objetivo = select_normal("SELECT * FROM kz_tec_dir_objetivos WHERE id = '".$_POST['id_objetivo']."'"); 
if($objetivo)
	foreach($objetivo as $key => $valor){ ?>
	
	  <div id="cuerpo2">
	  	<form action="ficha_objetivo.php" method="post" id="guardar_objetivo_<?php echo $valor['id']; ?>" name="form_guardar">
	  	  <input type='hidden' name='edio_id' value='<?php echo $valor['id']; ?>'></input>
	  	  <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	      <table class="tabla_sin_borde" width="100%">
	        <tr>
	          <td width="25%">Objetivo:</td>
	          <td><input type="text" name="edio_objetivo" id="edio_objetivo" value='<?php echo $valor['objetivo']; ?>' size='35'></td>
	        </tr>
	        <tr>
	          <td>Fecha de creaci&oacute;n:</td>
	          <td><input type='text' name='edio_fechacreacion' id='edio_fechacreacion<?php echo $valor['id']; ?>' value='<?php echo $valor['fechacreacion']; ?>' size='14'></input>
				  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='edit_fechacreacion<?php echo $valor['id']; ?>'>
				  <script>
					Calendar.setup({
					trigger    : "edit_fechacreacion<?php echo $valor['id']; ?>",
					inputField : "edio_fechacreacion<?php echo $valor['id']; ?>"
					});
				  </script>
			  </td>
	        </tr>
	        <tr>
	          <td>A&ntilde;o:</td>
	          <td><select name='edio_anno' id='edio_anno'>
					<?php combo_base_array($array_annos, $valor['anno']); ?>
		          </select>
	          </td>
	        </tr>        
	        <tr>
	          <td>Descripci&oacute;n:</td>
	          <td><textarea name="edio_descripcion" id="edio_descripcion" cols="70" rows="3"><?php echo $valor['descripcion']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td>Responsable:</td>
	          <td><input type="text" name="edio_responsable" id="edio_responsable" value='<?php echo $valor['responsable']; ?>' size='35' /></td>
	        </tr>
	        <tr>
	          <td>Periocidad:</td>
	          <td>Cada <select name='periodicidad' id='periodicidad'>
					     <?php combo_base_array($array_dias, $valor['periodicidad']) ?>
					   </select> d&iacute;as
			  </td>
	        </tr>
	        <tr>
	          <td>Plazo de consecuci&oacute;n:</td>
	          <td><input type='text' name='edio_plazo' id='edio_plazo<?php echo $valor['id']; ?>' value='<?php echo $valor['plazoconsecucion']; ?>' size='14'></input>
				  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='edit_calplazo<?php echo $valor['id']; ?>'>
				  <script>
					Calendar.setup({
					trigger    : "edit_calplazo<?php echo $valor['id']; ?>",
					inputField : "edio_plazo<?php echo $valor['id']; ?>"
					});
				  </script>
			  </td>
	        </tr>
	        <tr>
	          <td>Cumplido:</td>
	          <td><?php if(($valor['cumplido'])=='1'){ ?>
					<input  type='checkbox' name='edio_cumplido' id='edio_cumplido' value='<?php echo $valor['cumplido']; ?>' checked> <?php 
				  }
				  else{ ?> 
					<input  type='checkbox' name='edio_cumplido' id='edio_cumplido' value='<?php echo $valor['cumplido']; ?>'> 
				  <?php } ?>
			  </td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>
	          	<input class="bt-accion" type="button" onclick="$('#guardar_objetivo_<?php echo $valor['id']; ?>').submit();"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          	
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
			<input type='hidden' name='id_objetivo' value='<?php echo $valor['id']; ?>'></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
		</form>
	  </div>
	<?php }
  
include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
