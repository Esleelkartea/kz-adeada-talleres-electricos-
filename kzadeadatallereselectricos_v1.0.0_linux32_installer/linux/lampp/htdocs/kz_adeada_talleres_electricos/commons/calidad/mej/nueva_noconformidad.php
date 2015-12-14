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
<script>document.getElementById("lnk_ver_noconformidades").setAttribute("class", "seleccionado");</script>

<div id="cuerpo2">
	<form action="ver_noconformidades.php" id="crear_noconformidad" name="form_crear" method="post">
      <input type='hidden' name='new_noconformidad' value='new_noconformidad'></input>
      <table class="tabla_sin_borde" width="100%">
        <tr>
          <td width="45%">CNC:</td>
          <td colspan=5><input type="text" name="cnc" value='' size='14'></td>
        </tr>
        <tr>
          <td>Fecha de detecci&oacute;n:</td>
          <td colspan=5><input type='text' name='fecha_detec' id='fecha_detec' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal3'>
			  <script>
				Calendar.setup({
				trigger    : "cal3",
				inputField : "fecha_detec"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>Orden/Pedido:</td>
          <td colspan=5><input type="text" name="orden_pedido" id=orden_pedido value='' size='35' /></td>
        </tr>        
        <tr>
          <td>Origen de la NC (interna, externa, ...):</td>
          <td colspan=5>
          	Selecciona:
          	<select name="tiponc" id="tiponc" onChange="$('#origen_problema').attr('value', this.value);">
          		<option value=''></option>
	         	<?php $tipo_nc=select_normal("SELECT * FROM kz_tec_mej_tiponc");
	      		foreach($tipo_nc as $keytiponc => $valortiponc){?>
	      			<option value='<?php echo $valortiponc['tipo']; ?>'>
	      				<?php echo $valortiponc['tipo']; ?>
	      			</option>
	      			<?php }?>
	      	</select>
	      	, o introduce:
	       	<input type='text' name='origen_problema' id='origen_problema' value='' size=30></input>
	      </td>
        </tr>
        <tr>
          <td>Especificar origen (dpto. compras, ...):</td>
          <td colspan=5>
          	Selecciona:
          	<select name="detectada_en" id="detectada_en" onChange="$('#detectada').attr('value', this.value);">
       		 	<option value=''></option>
         		<?php $detectada=select_normal("SELECT * FROM kz_tec_mej_detectadaen");
      			foreach($detectada as $keydetectada => $valordetectada){?>
      			<option value='<?php echo $valordetectada['detectada_en']; ?>'>
      				<?php echo $valordetectada['detectada_en']; ?>
      			</option>
      			<?php }?>
       		</select>
       		, o introduce:
       		<input type='text' name='detectada' id='detectada' value='' size=30></input>
       	  </td>
        </tr>
        <tr>
          <td>Clasificaci&oacute;n de origen (secci&oacute;n utillajes, ...):</td>
          <td colspan=5>
          	Selecciona:
          	<select name="detectada_por" id="detectada_por" onChange="$('#detectada_por_nuevo').attr('value', this.value);">
       		 	<option value=''></option>
         		<?php $detectada_por=select_normal("SELECT distinct(detectada_por) FROM kz_tec_mej_noconformidades");
      			foreach($detectada_por as $keydetectadapor => $valordetectadapor){?>
      			<option value='<?php echo $valordetectadapor['detectada_por']; ?>'>
      				<?php echo $valordetectadapor['detectada_por']; ?>
      			</option>
      			<?php }?>
       		</select>
       		, o introduce:
       		<input type='text' name='detectada_por_nuevo' id='detectada_por_nuevo' value='' size=30></input>
       	  </td>
        </tr>
        <tr>
          <td>Detectada por:</td>
          <td colspan=5><input type="text" name="detectada_por_" id="detectada_por_" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Descripci&oacute;n del problema &iquest;Qu&eacute; ha pasado?:</td>
          <td colspan=5><textarea name="descripcion" id="descripcions" cols="70" rows="3"></textarea></td>
        </tr>
        <tr>
          <td>Causa estimada:</td>
          <td colspan=5><textarea name="causa_estimada" id="causa_estimada" cols="70" rows="3"></textarea></td>
        </tr>
        <tr>
          <td>Soluci&oacute;n a tomar &iquest;Qu&eacute; hago para solucionarlo?:</td>
          <td colspan=5><textarea name="tratamiento" id="tratamiento" cols="70" rows="3"></textarea></td>
        </tr>
        <tr>
          <td>Responsable tratamiento &iquest;Qui&eacute;n lo hace?:</td>
          <td colspan=5><input type="text" name="responsable" id="responsable" value='' size='35' /></td>
        </tr>
        <tr>
          <td>&iquest;Cu&aacute;ndo tiene que estar hecho?:</td>
          <td colspan=5><input type='text' name='fecha_prev' id='fecha_prev' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal2'>
			  <script>
				Calendar.setup({
				trigger    : "cal2",
				inputField : "fecha_prev"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>Seguimiento realizado de la soluci&oacute;n adoptada:</td>
          <td colspan=5><textarea name="seguimiento" cols="70" rows="3"></textarea></td>
        </tr>
        <tr>
          <td>Fecha cierre &iquest;Cu&aacute;ndo se ha hecho?:</td>
          <td colspan=5><input type='text' name='fecha_cierre' id='fecha_cierre' value='' size='14'></input>
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
          <td>Cierre eficaz:</td>
          <td colspan=5><input name='cierre_eficaz_nuevo' type="checkbox" id='cierre_eficaz_nuevo'  onClick="if(this.checked){ $('#cierre_eficaz').attr('value','1');  } else{ $('#cierre_eficaz').attr('value','0'); }">
          	  <input name='cierre_eficaz' type="hidden" id='cierre_eficaz' value='0'></td>
        </tr>
        <tr>
          <td>Coste ocasionado:</td>
          <td colspan=5><input type="text" name="coste" id="coste" value='' size='14' /></td>
        </tr>
        <tr>
          <td>Unidades:</td>
          <td colspan=5><input type="text" name="unidades" id="unidades" value='' size='14' /></td>
        </tr>
        <tr>
          <td>Maquinaria:</td>
          <td><input name='maquinaria_nuevo' type="checkbox" id='maquinaria_nuevo'  onClick="if(this.checked){ $('#maquinaria').attr('value','1');  } else{ $('#maquinaria').attr('value','0'); }">
			  <input name='maquinaria' type="hidden" id='maquinaria' value='0'>
		  </td>
		  <td style='text-align: center;'>Mano de obra:</td>
          <td><input name='mano_obra_nuevo' type="checkbox" id='mano_obra_nuevo'  onClick="if(this.checked){ $('#mano_obra').attr('value','1');  } else{ $('#mano_obra').attr('value','0'); }">
			  <input name='mano_obra' type="hidden" id='mano_obra' value='0'>
		  </td>
		  <td style='text-align: center;'>Materia prima:</td>
          <td><input name='materia_prima_nuevo' type="checkbox" id='materia_prima_nuevo'  onClick="if(this.checked){ $('#materia_prima').attr('value','1');  } else{ $('#materia_prima').attr('value','0'); }">
			  <input name='materia_prima' type="hidden" id='materia_prima' value='0'>
		  </td>
        </tr>
        <tr>
          <td>Mediciones:</td>
          <td><input name='mediciones_nuevo' type="checkbox" id='mediciones_nuevo'  onClick="if(this.checked){ $('#mediciones').attr('value','1');  } else{ $('#mediciones').attr('value','0'); }">
			  <input name='mediciones' type="hidden" id='mediciones' value='0'>
		  </td>
		  <td style='text-align: center;'>M&eacute;todos:</td>
          <td><input name='metodos_nuevo' type="checkbox" id='metodos_nuevo'  onClick="if(this.checked){ $('#metodos').attr('value','1');  } else{ $('#metodos').attr('value','0'); }">
			  <input name='metodos' type="hidden" id='metodos' value='0'>
		  </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan=5>
          	<input class="bt-accion" type="button" onclick="$('#crear_noconformidad').submit();"  name="img_crear" id="img_crear" value="Crear" />

			<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />

          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan=5>&nbsp;</td>
        </tr>
      </table>
    </form>
    
    <form action="ver_noconformidades.php" method="post" id="cancelar_<?php echo $valor['id'];?>">
	</form>
</div>
  
<?php include('../struct/footer2.php');?>
   
</div>
</div>

</body>
</html>
