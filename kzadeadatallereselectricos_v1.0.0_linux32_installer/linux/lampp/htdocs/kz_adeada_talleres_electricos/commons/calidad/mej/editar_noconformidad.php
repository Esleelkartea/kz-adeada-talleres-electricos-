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

<?php $noconformidad = select_normal("SELECT * FROM kz_tec_mej_noconformidades WHERE id = '".$_POST['id_noconformidad']."'"); 
if($noconformidad)
	foreach($noconformidad as $key => $valor){ ?>
	
	  <div id="cuerpo2">
	  	<form action="ver_noconformidades.php" method="post" id="guardar_noconformidad_<?php echo $valor['id']; ?>" name="form_guardar">
	  	  <input type='hidden' name='edi_noconformidad' value='<?php echo $valor['id']; ?>'></input>
	  	  <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	      <table class="tabla_sin_borde" width="100%">
	        <tr>
	          <td width="39%">CNC:</td>
	          <td colspan=5><input type="text" name="cnc" value='<?php echo $valor['cnc']; ?>' size='14'></td>
	        </tr>
	        <tr>
	          <td>Fecha de detecci&oacute;n:</td>
	          <td colspan=5><input type='text' name='fecha_detec' id='fecha_detec' value='<?php echo $valor['fecha_deteccion']; ?>' size='14'></input>
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
	          <td colspan=5><input type="text" name="orden_pedido" id=orden_pedido value='<?php echo $valor['orden_pedido']; ?>' size='35' /></td>
	        </tr>        
	        <tr>
	          <td>Origen de la NC (interna, externa, ...):</td>
	          <td colspan=5>
	          	Selecciona:
	          	<select name="tiponc" id="tiponc">
         			<?php $sqltiponc=select_normal("SELECT * FROM kz_tec_mej_tiponc");
      				foreach($sqltiponc as $keytiponc => $valortiponc){
      					if($valor['tipoNC'] == $valortiponc['tipo']){
      						$tipo_seleccionado = " SELECTED ";
      					} 
      					else $tipo_seleccionado = "";?>
      					<option value='<?php echo $valortiponc['tipo']; ?>' <?php echo $tipo_seleccionado; ?>>
      						<?php echo $valortiponc['tipo']; ?>
      					</option>
      				<?php }?>
       			</select>
       			, o introduce:
       			<input type='text' name='nuevo_origen' id='nuevo_origen' value='' size=30></input>
		      </td>
	        </tr>
	        <tr>
	          <td>Especificar origen (dpto. compras, ...):</td>
	          <td colspan=5>
	          	Selecciona:
	          	<select name="detectada_en" id="detectada_en">
         			<?php $detectada=select_normal("SELECT * FROM kz_tec_mej_detectadaen");
      				foreach($detectada as $keydetectada => $valordetectada){
      					if($valor['detectada_en'] == $valordetectada['detectada_en']){
      						$tipo_seleccionado = " SELECTED ";
      					} 
      					else $tipo_seleccionado = "";?>
      					<option value='<?php echo $valordetectada['detectada_en']; ?>' <?php echo $tipo_seleccionado; ?>>
      						<?php echo $valordetectada['detectada_en']; ?>
      					</option>
      				<?php }?>
       			</select>
       			, o introduce:
       			<input type='text' name='nuevo_especif_origen' id='nuevo_especif_origen' value='' size=30></input>
	       	  </td>
	        </tr>
	        <tr>
	          <td>Clasificaci&oacute;n de origen (secci&oacute;n utillajes, ...):</td>
	          <td colspan=5>
	          	Selecciona:
	          	<select name="detectada_por" id="detectada_por">
         			<?php $detectada_por=select_normal("SELECT distinct(detectada_por) FROM kz_tec_mej_noconformidades");
      				foreach($detectada_por as $keydetectadapor => $valordetectadapor){
      					if($valor['detectada_por'] == $valordetectadapor['detectada_por']){
      						$tipo_seleccionado = " SELECTED ";
      					} 
      					else $tipo_seleccionado = "";?>
      					<option value='<?php echo $valordetectadapor['detectada_por']; ?>' <?php echo $tipo_seleccionado; ?>>
      						<?php echo $valordetectadapor['detectada_por']; ?>
      					</option>
      				<?php }?>
       			</select>
       			, o introduce:
       			<input type='text' name='nuevo_detectada_por' id='nuevo_detectada_por' value='' size=30></input>
	       	  </td>
	        </tr>
	        <tr>
	          <td>Detectada por:</td>
	          <td colspan=5><input type="text" name="detectada_por_" id='detectada_por_' value='<?php echo $valor['detectada_por_']; ?>' size='35' /></td>
	        </tr>
	        <tr>
	          <td>Descripci&oacute;n del problema &iquest;Qu&eacute; ha pasado?:</td>
	          <td colspan=5><textarea name="descripcion" id="descripcions" cols="70" rows="3"><?php echo $valor['descripcion']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td>Causa estimada:</td>
	          <td colspan=5><textarea name="causa_estimada" id="causa_estimada" cols="70" rows="3"><?php echo $valor['causa_estimada']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td>Soluci&oacute;n a tomar &iquest;Qu&eacute; hago para solucionarlo?:</td>
	          <td colspan=5><textarea name="tratamiento" id="tratamiento" cols="70" rows="3"><?php echo $valor['tratamiento']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td>Responsable tratamiento &iquest;Qui&eacute;n lo hace?:</td>
	          <td colspan=5><input type="text" name="responsable" id="responsable" value='<?php echo $valor['responsable']; ?>' size='35' /></td>
	        </tr>
	        <tr>
	          <td>&iquest;Cu&aacute;ndo tiene que estar hecho?:</td>
	          <td colspan=5><input type='text' name='fecha_prev' id='fecha_prev' value='<?php echo $valor['fecha_prevista']; ?>' size='14'></input>
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
	          <td colspan=5><textarea name="seguimiento" cols="70" rows="3"><?php echo $valor['seguimiento']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td>Fecha cierre &iquest;Cu&aacute;ndo se ha hecho?:</td>
	          <td colspan=5><input type='text' name='fecha_cierre' id='fecha_cierre' value='<?php echo $valor['fecha_cierre']; ?>' size='14'></input>
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
	          <td colspan=5><?php if(($valor['cierre_eficaz'])=='1'){ ?>
					<input  type='checkbox' name='check_cierre' id='check_cierre' class='requerido' value='<?php echo $valor['cierre_eficaz']; ?>' checked> <?php 
				  }
				  else{?> 
					<input  type='checkbox' name='check_cierre' id='check_cierre' class='requerido' value='<?php echo $valor['cierre_eficaz']; ?>'> <?php
				  }?>
				</td>
	        </tr>
	        <tr>
	          <td>Coste ocasionado:</td>
	          <td colspan=5><input type="text" name="coste" id="coste" value='<?php echo $valor['coste']; ?>' size='14' /></td>
	        </tr>
	        <tr>
	          <td>Unidades:</td>
	          <td colspan=5><input type="text" name="unidades" id="unidades" value='<?php echo $valor['unidades']; ?>' size='14' /></td>
	        </tr>
	        <tr>
	          <td>Maquinaria:</td>
	          <td><?php if(($valor['maquinaria'])=='1'){ ?>
					<input  type='checkbox' name='check_maquinaria' id='check_maquinaria' class='requerido' value='<?php echo $valor['maquinaria']; ?>' checked> <?php 
				  }
				  else{?> 
					<input  type='checkbox' name='check_maquinaria' id='check_maquinaria' class='requerido' value='<?php echo $valor['maquinaria']; ?>'> <?php
				  }?>
			  </td>
			  <td style='text-align: center;'>Mano de obra:</td>
	          <td><?php if(($valor['mano_obra'])=='1'){ ?>
					<input  type='checkbox' name='check_mano' id='check_mano' class='requerido' value='<?php echo $valor['mano_obra']; ?>' checked> <?php 
				  }
				  else{?> 
					<input  type='checkbox' name='check_mano' id='check_mano' class='requerido' value='<?php echo $valor['mano_obra']; ?>'> <?php
				  }?>
			  </td>
			  <td style='text-align: center;'>Materia prima:</td>
	          <td><?php if(($valor['materia_prima'])=='1'){ ?>
					<input  type='checkbox' name='check_materia' id='check_materia' class='requerido' value='<?php echo $valor['materia_prima']; ?>' checked> <?php 
				  }
				  else{?> 
					<input  type='checkbox' name='check_materia' id='check_materia' class='requerido' value='<?php echo $valor['materia_prima']; ?>'> <?php
				  }?>
			  </td>
	        </tr>
	        <tr>
	          <td>Mediciones:</td>
	          <td><?php if(($valor['mediciones'])=='1'){ ?>
					<input  type='checkbox' name='check_mediciones' id='check_mediciones' class='requerido' value='<?php echo $valor['mediciones']; ?>' checked> <?php 
				  }
				  else{?> 
					<input  type='checkbox' name='check_mediciones' id='check_mediciones' class='requerido' value='<?php echo $valor['mediciones']; ?>'> <?php
			  	  }?>
			  </td>
			  <td style='text-align: center;'>M&eacute;todos:</td>
	          <td><?php if(($valor['metodos'])=='1'){ ?>
					<input  type='checkbox' name='check_metodos' id='check_metodos' class='requerido' value='<?php echo $valor['metodos']; ?>' checked> <?php 
				  }
				  else{?> 
					<input  type='checkbox' name='check_metodos' id='check_metodos' class='requerido' value='<?php echo $valor['metodos']; ?>'> <?php
				  }?>
			  </td>
	        </tr>
	        <tr><td height=30></td></tr>
	        <tr>
	          <td width="33%" valign="top">Acciones Correctivas relacionadas:</td>
	          <td colspan=5>
	          <?php $acpm = select_normal("SELECT * FROM kz_tec_mej_acpm WHERE num_nc = '".$valor['id']."'");
	          if($acpm)
	          foreach($acpm as $key_acpm => $valor_acpm){
	        	?><?php echo "- ".$valor_acpm['fecha_apertura']." || ".$valor_acpm['causa_probable']." || ".$valor_acpm['descripcion_accion']."               <br>";?>
	          <?php } ?>
	          </td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td colspan=5>
	          	<input class="bt-accion" type="button" onclick="$('#guardar_noconformidad_<?php echo $valor['id']; ?>').submit();"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          	
				<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />

	          </td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td colspan=5>&nbsp;</td>
	        </tr>
	      </table>
	    </form>
		
		<form action='ver_noconformidades.php' method='post' id='cancelar_<?php echo $valor['id']; ?>'>
			<input type='hidden' name='id_noconformidad' value='<?php echo $valor['id']; ?>'></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
		</form>
	  </div>
	<?php }
  
include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
