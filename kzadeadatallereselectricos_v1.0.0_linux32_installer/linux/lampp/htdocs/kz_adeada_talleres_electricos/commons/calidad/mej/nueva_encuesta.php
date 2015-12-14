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
<script>document.getElementById("lnk_ver_satisfaccion_clientes").setAttribute("class", "seleccionado");</script>

<div id="cuerpo2">
	<form action="ver_satisfaccion.php" id="crear_encuesta" name="form_crear" method="post">
      <input type='hidden' name='crear_encuesta_satisfaccion' value='crear_encuesta_satisfaccion'></input>
      <table class="tabla_sin_borde"width="100%">
      	<tr>
		  <td width='25%'>Organizaci&oacute;n:</td>
          <td><input type="text" name="organizacion" id='organizacion' value='' size='35'></td>
        </tr>
        <tr>
		  <td>Comercial:</td>
          <td><input type="text" name="comercial" id='comercial' value='' size='35'></td>
        </tr>
        <tr>
		  <td>Nombre:</td>
          <td><input type="text" name="nombre" id='nombre' value='' size='35'></td>
        </tr>
        <tr>
		  <td>Apellido:</td>
          <td><input type="text" name="apellidos" id='apellidos' value='' size='35'></td>
        </tr>
        <tr>
          <td>Fecha encuesta:</td>
          <td><input type='text' name='fechaencuesta' id='fechaencuesta' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal1'>
			  <script>
				Calendar.setup({
				trigger    : "cal1",
				inputField : "fechaencuesta"
				});
			  </script>
		  </td>
		</tr>
		<tr>
          <td>Fecha respuesta:</td>
          <td><input type='text' name='fecharespuesta' id='fecharespuesta' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal2'>
			  <script>
				Calendar.setup({
				trigger    : "cal2",
				inputField : "fecharespuesta"
				});
			  </script>
		  </td>
		</tr>
      </table>
      <br>
      
      <?php $aspectos = select_normal("SELECT * FROM kz_tec_mej_campos");?>
      
      <table style='color:black;' width="100%" border=1>
        <tr>
          <th style='font-size: small; padding: 3px;'>Aspecto a valorar<?php echo "<br>";?>(selecciona la pregunta por defecto en el desplegable, o introduce una nueva)</th>
    	  <th style='font-size: small; padding: 3px;'>Valoraci&oacute;n</th>
    	  <th style='font-size: small; padding: 3px;'>Valoraci&oacute;n frente a la comp.</th>
    	  <th style='font-size: small; padding: 3px;'>Importancia</th>
        </tr>
        <?php foreach($aspectos as $key => $valor){?>
          <tr>
			<th style='background-color: blue; text-align: right; padding: 3px;'>
				<select name="pregunta_combo_<?php echo $valor['id'];?>" id="pregunta_combo">
					<?php $preguntas = select_normal("SELECT * FROM kz_tec_mej_campos");?>
					<option></option>
					<?php foreach($preguntas as $keypregunta => $valorpregunta){?>
						<option value='<?php echo $valorpregunta['descripcion']; ?>'>
		      				<?php echo $valorpregunta['descripcion']; ?>
		      			</option>
		      		<?php }?>
				</select>
				<br><input type ="text" name='pregunta_<?php echo $valor['id'];  ?>' id='pregunta' size='80'></input>
			</th>
			<td style='text-align: center;'><select name='campo_<?php echo $valor['id'];  ?>'><?php combo_base_array(array(1,2,3,4,5,6,7,8,9,10,'no contesta')); ?></select></td>
			<td style='text-align: center;'><select name='campocompetencia_<?php echo $valor['id'];  ?>'><?php combo_base_array(array(1,2,3,4,5,6,7,8,9,10,'no contesta')); ?></select></td>
			<td style='text-align: center;'><input type='checkbox' name='importante_<?php echo $valor['id']; ?>' value='0' onClick="if(this.checked){ $('#aspectoimportante_<?php echo $valor['id'];  ?>').attr('value','1'); } else { $('#aspectoimportante_<?php echo $valor['id'];?>').attr('value','0');}">
				<input type='hidden' id = 'aspectoimportante_<?php echo $valor['id'];  ?>' name='aspectoimportante_<?php echo $valor['id'];  ?>' value='0'>
			</td>
		  </tr>
		<?php }?>
	  </table>
	  <table style='color:black;' width="100%" border=0>
	  	<tr>
	  	  <td width='15%'>
			<table style='color:black;' width="100%" border=0>
			  <tr>
				<th style='font-size: medium; padding: 3px;' colspan=2>Motivos de compra</th>
			  </tr>	
			  <tr>
				<td style='text-align: right; width: 90px; font-size: small;'>Calidad</td>
				<td style='text-align: center;'><input type='checkbox' name='motivo_calidad' value='0' onClick="if(this.checked){ $('#mot_calidad').attr('value','1'); } else { $('#mot_calidad').attr('value','0');}">
					<input type='hidden' id = 'mot_calidad' name='mot_calidad' value='0'>
				</td>
			  </tr>
			  <tr>
			  	<td style='text-align: right; font-size: small;'>Precio</td>
			  	<td style='text-align: center;'><input type='checkbox' name='motivo_precio' value='0' onClick="if(this.checked){ $('#mot_precio').attr('value','1'); } else { $('#mot_precio').attr('value','0');}">
					<input type='hidden' id = 'mot_precio' name='mot_precio' value='0'>
				</td>
			  </tr>
			  <tr>
			  	<td style='text-align: right; font-size: small;'>Confianza</td>
			  	<td style='text-align: center;'><input type='checkbox' name='motivo_confianza' value='0' onClick="if(this.checked){ $('#mot_confianza').attr('value','1'); } else { $('#mot_confianza').attr('value','0');}">
					<input type='hidden' id = 'mot_confianza' name='mot_confianza' value='0'>
				</td>
			  </tr>
			  <tr>
			  	<td style='text-align: right; font-size: small;'>Atenci&oacute;n</td>
			  	<td style='text-align: center;'><input type='checkbox' name='motivo_atencion' value='0' onClick="if(this.checked){ $('#mot_atencion').attr('value','1'); } else { $('#mot_atencion').attr('value','0');}">
					<input type='hidden' id = 'mot_atencion' name='mot_atencion' value='0'>
				</td>
			  </tr>
			  <tr>
			  	<td style='text-align: right; font-size: small;'>Servicio</td>
			  	<td style='text-align: center;'><input type='checkbox' name='motivo_servicio' value='0' onClick="if(this.checked){ $('#mot_servicio').attr('value','1'); } else { $('#mot_servicio').attr('value','0');}">
					<input type='hidden' id = 'mot_servicio' name='mot_servicio' value='0'>
				</td>
			  </tr>	
			  <tr>
			  	<td style='text-align: right; font-size: small;'>Cercan&iacute;a</td>
			  	<td style='text-align: center;'><input type='checkbox' name='motivo_cercania' value='0' onClick="if(this.checked){ $('#mot_cercania').attr('value','1'); } else { $('#mot_cercania').attr('value','0');}">
					<input type='hidden' id = 'mot_cercania' name='mot_cercania' value='0'>
				</td>
			  </tr>	
			  <tr>
			  	<td style='text-align: right; font-size: small;'>Experiencia</td>
			  	<td style='text-align: center;'><input type='checkbox' name='motivo_experiencia' value='0' onClick="if(this.checked){ $('#mot_experiencia').attr('value','1'); } else { $('#mot_experiencia').attr('value','0');}">
					<input type='hidden' id = 'mot_experiencia' name='mot_experiencia' value='0'>
				</td>
			  </tr>
			  <tr>
			  	<td style='text-align: right; font-size: small;'>Otros</td>
			  	<td style='text-align: center;'><input type='checkbox' name='motivootros' value='0' onClick="if(this.checked){ $('#mot_otros').toggle(); } else { $('#mot_otros').toggle();}">
					<textarea id = 'mot_otros' name='mot_otros' cols=40 rows=5 style='display: none;'></textarea>
				</td>
			  </tr>
			</table>
		  </td>
		  <td width='10%'></td>
		  <td style='width:5%'>
			<table style='color:black;' width="100%" border=0>
			  <tr>
				<th style='font-size: small; text-align: right; color:black;'>Sugerencias: </th>
				<td><textarea name='sugerencias' cols="70" rows="4"></textarea></td>
			  </tr>
			  <tr>
			  	<th style='font-size: small; text-align: right; color:black;'>An&aacute;lisis: </th>
			  	<td><textarea name='analisis' cols="70" rows="4"></textarea></td>
			  </tr>
			</table>
		  </td>
		</tr>
	  </table>
      <table class="tabla_sin_borde" width="100%">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>
          	<input class="bt-accion" type="button" onclick="$('#crear_encuesta').submit();"  name="img_crear" id="img_crear" value="Crear" />

			<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />

          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
</div>
  
<form action="ver_satisfaccion.php" method="post" id="cancelar_<?php echo $valor['id'];?>">
</form>

<?php include('../struct/footer2.php');?>
   
</div>
</div>

</body>
</html>
