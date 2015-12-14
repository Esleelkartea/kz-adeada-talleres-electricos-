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

<?php $pauta = select_normal("SELECT * FROM kz_tec_mant_pautas WHERE id = '".$_POST['id_pauta']."'"); 
if($pauta)
	foreach($pauta as $key => $valor){ ?>
	
	  <div id="cuerpo2">
	  	<form action="ficha_equipo.php" method="post" id="guardar_pauta_<?php echo $valor['id']; ?>" name="form_guardar">
	  	  <input type='hidden' name='editar_pauta' value='<?php echo $valor['id']; ?>'></input>
	  	  <input type='hidden' name='edie_pauta' value='<?php echo $_POST['id_equipo']; ?>'></input>
	  	  <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	      <table class="tabla_sin_borde" width="100%">
	        <tr>
	          <td width="25%">Descripci&oacute;n:</td>
	          <td><textarea name="descripcion" id="descripcion" cols="70" rows="3"><?php echo $valor['descripcion'];?></textarea></td>
	        </tr>
	        <tr>
	          <td>Periocidad:</td>
	          <td>Cada <select name='periodo' id='periodo''>
						   <?php combo_base_array($array_dias, $valor['periodicidad'])?>
					   </select> d&iacute;as
			  </td>
	        </tr>
	        <tr>
	          <td>Responsable:</td>
	          <td><input type="text" name="responsable" id="responsable" value='<?php echo $valor['responsable'];?>' size='35' /></td>
	        </tr>
	        <tr>
	          <td>Tiempo estimado:</td>
	          <td><input type="text" name="tiempo_estimado" id='tiempo_estimado' value='<?php echo $valor['tiempoestimado'];?>' size='14'> horas</td>
	        </tr>
	        <tr>
	          <td>Euros:</td>
	          <td><input type="text" name="euros" id='euros' value='<?php echo $valor['euros'];?>' size='14'></td>
	        </tr>
	        <tr>
	          <td>Inicio:</td>
	          <td><input type='text' name='inicio' id='f_inicio' value='<?php echo $valor['fechainicio']; ?>' size='14'></input>
				  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal1'>
				  <script>
					Calendar.setup({
					trigger    : "cal1",
					inputField : "f_inicio"
					});
				  </script>
			  </td>
	        </tr>
	        <tr>
	          <td>Fin:</td>
	          <td><input type='text' name='fin' id='fin' value='<?php echo $valor['fechafin']; ?>' size='14'></input>
				  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal2'>
				  <script>
					Calendar.setup({
					trigger    : "cal2",
					inputField : "fin"
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
	          	<input class="bt-accion" type="button" onclick="$('#guardar_pauta_<?php echo $valor['id']; ?>').submit();"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          	
				<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />

	          </td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	      </table>
	    </form>
		
		<form action='ficha_equipo.php' method='post' id='cancelar_<?php echo $valor['id']; ?>'>
			<input type='hidden' name='id_equipo' value='<?php echo $_POST['id_equipo']; ?>'></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
		</form>
	  </div>
	<?php }
  
include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
