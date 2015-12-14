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
<script>document.getElementById("lnk_ver_reuniones").setAttribute("class", "seleccionado");</script>

<?php $decision = select_normal("SELECT a.id as id, a.idreunion as idreunion, a.responsable, a.plazo, b.decision as decision FROM kz_tec_dir_decisionesreunion a, kz_tec_dir_decisiones b WHERE a.iddecision = b.id AND idreunion = '".$_POST['id_reunion']."' AND iddecision = '".$_POST['id_decision']."'"); 
if($decision)
	foreach($decision as $key => $valor){ ?>
	
	  <div id="cuerpo2">
	  	<form action="ficha_reunion.php" method="post" id="guardar_decision_<?php echo $valor['id']; ?>" name="form_guardar">
	  	  <input type='hidden' name='editar_deci' value='<?php echo $valor['id']; ?>'></input>
	  	  <input type='hidden' name='id_reunion' value='<?php echo $valor['idreunion']; ?>'></input>
	  	  <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	      <table class="tabla_sin_borde" width="100%">
	        <tr>
	          <td width='25%'>Decisi&oacute;n:</td>
		      <td><?php echo $valor['decision']; ?></td>
	        </tr>
	        <tr>
	          <td>Responsable:</td>
		      <td><input type="text" name='responsable' id="responsable" value='<?php echo $valor['responsable']; ?>' size='35'></td>
	        </tr> 
	        <tr>
	          <td>Plazo:</td>
		      <td><input type='text' name='plazo' id='plazo' value='<?php echo $valor['plazo']; ?>' size='14'></input>
				  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal1'>
				  <script>
					Calendar.setup({
					trigger    : "cal1",
					inputField : "plazo"
					});
				  </script>
			  </td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>
	          	<input class="bt-accion" type="button" onclick="$('#guardar_decision_<?php echo $valor['id']; ?>').submit();"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          	
				<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />

	          </td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	      </table>
	    </form>
		
		<form action='ficha_reunion.php' method='post' id='cancelar_<?php echo $valor['id']; ?>'>
			<input type='hidden' name='id_reunion' value='<?php echo $_POST['id_reunion']; ?>'></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
		</form>
	  </div>
	<?php }
  
include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
