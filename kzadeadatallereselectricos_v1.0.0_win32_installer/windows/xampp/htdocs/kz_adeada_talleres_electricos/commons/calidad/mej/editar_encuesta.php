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

<?php $arraycheck=array(0=>'',1=>'CHECKED');

$encuesta = select_normal("SELECT * FROM kz_tec_mej_encuesta WHERE id = '".$_POST['id_encuesta']."'"); 
if($encuesta)
	foreach($encuesta as $key => $valor){ ?>
	
	  <div id="cuerpo2">
	  	<form action="ver_satisfaccion.php" method="post" id="guardar_encuesta_<?php echo $valor['id']; ?>" name="form_guardar">
	  	  <input type='hidden' name='modificar_encuesta' value='<?php echo $valor['id']; ?>'></input>
	  	  <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	  	  <input type='hidden' name='buscar_por' value='<?php echo $_POST['buscar_por']; ?>'></input>
		  <input type='hidden' name='criterios' value='<?php echo $_POST['criterios']; ?>'></input>
	      <table class="tabla_sin_borde" width="100%">
	      	<tr>
			  <td width='25%'>Organizaci&oacute;n:</td>
	          <td><input type="text" name="organizacion" id='organizacion' value='<?php echo $valor['organizacion']; ?>' size='35'></td>
	        </tr>
	        <tr>
			  <td>Comercial:</td>
	          <td><input type="text" name="comercial" id='comercial' value='<?php echo $valor['comercial']; ?>' size='35'></td>
	        </tr>
	        <tr>
			  <td>Nombre:</td>
	          <td><input type="text" name="nombre" id='nombre' value='<?php echo $valor['nombre']; ?>' size='35'></td>
	        </tr>
	        <tr>
			  <td>Apellido:</td>
	          <td><input type="text" name="apellidos" id='apellidos' value='<?php echo $valor['apellidos']; ?>' size='35'></td>
	        </tr>
	        <tr>
	          <td>Fecha encuesta:</td>
	          <td><input type='text' name='fechaencuesta' id='fechaencuesta' value='<?php echo $valor['fechaencuesta']; ?>' size='14'></input>
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
	          <td><input type='text' name='fecharespuesta' id='fecharespuesta' value='<?php echo $valor['fecharespuesta']; ?>' size='14'></input>
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
	      
	      <?php $aspectos = select_normal("SELECT kz_tec_mej_valoraciones.aspectoimportante, kz_tec_mej_valoraciones.valcompetencia, kz_tec_mej_valoraciones.valoracion, kz_tec_mej_campos.descripcion, kz_tec_mej_campos.id FROM kz_tec_mej_campos, kz_tec_mej_valoraciones WHERE kz_tec_mej_valoraciones.idencuesta='".$valor['id']."' AND kz_tec_mej_valoraciones.campo = kz_tec_mej_campos.id");?>
	      
	      <table style='color:black;' width="100%" border=1>
			<tr>
			  <th style='font-size: small; padding: 3px;'>Aspecto a valorar</th>
			  <th style='font-size: small; padding: 3px;'>Valoraci&oacute;n</th>
			  <th style='font-size: small; padding: 3px;'>Valoraci&oacute;n frente a la comp.</th>
			  <th style='font-size: small; padding: 3px;'>Importancia</th>
			</tr>
			
			<?php if($aspectos)
			foreach($aspectos as $key_aspectos => $valor_aspectos){
			  //$valoraciones = select_normal("Select * from kz_tec_mej_valoraciones where idencuesta='".$valor['id']."' and campo = '".$valor['id']."'");
			  //$valoraciones = $valoraciones[0];?>
			  <tr>
				<th style='background-color: blue; color: white; text-align: right; padding: 5px;'><?php echo $valor_aspectos['descripcion']; ?></th>
				<td style='text-align: center; padding: 5px;'><select name='campo_<?php echo $valor_aspectos['id'];  ?>'><?php combo_base_array(array(1,2,3,4,5,6,7,8,9,10,'no contesta'), $valor_aspectos['valoracion']); ?></select></td>
				<td style='text-align: center; padding: 5px;'><select name='campocompetencia_<?php echo $valor_aspectos['id'];  ?>'><?php combo_base_array(array(1,2,3,4,5,6,7,8,9,10,'no contesta'),$valor_aspectos['valcompetencia']); ?></select></td>
				<td style='text-align: center; padding: 5px;'><input type='checkbox' name='importante_<?php echo $valor_aspectos['id']; ?>' <?php echo $arraycheck[$valor_aspectos['aspectoimportante']];  ?> onClick="if(this.checked){ $('#aspectoimportante_<?php echo $valor_aspectos['id'];  ?>_<?php echo $valor['id']; ?>').attr('value','1'); } else { $('#aspectoimportante_<?php echo $valor_aspectos['id'];?>_<?php echo $valor['id']; ?>').attr('value','0');}">
					<input type='hidden' id = 'aspectoimportante_<?php echo $valor_aspectos['id'];  ?>_<?php echo $valor['id']; ?>' name='aspectoimportante_<?php echo $valor_aspectos['id'];  ?>' value='<?php echo $valor_aspectos['aspectoimportante'];?>'>
				</td>
			  </tr>
			  <?php	}?>
			</table>
		  <table style='color:black;' width="100%" border=0>
			<tr>
	  	  	  <td width='15%'>
			 	<?php $motivos = select_normal("SELECT * FROM kz_tec_mej_motivosencuesta WHERE idencuesta = '".$valor['id']."'");
				$valormotivos = $motivos[0];?>
				<table style='color:black;' width="100%" border=0>
				  <tr>
					<th style='font-size: medium; padding: 3px;' colspan=2>Motivos de compra</th>
				  </tr>
				  <tr>
					<td style='text-align: right; width: 90px; font-size: small;'>Calidad</td>
					<td style='text-align: center;'><input type='checkbox' name='motivo_calidad' <?php echo $arraycheck[$valormotivos['calidad']]; ?> onClick="if(this.checked){ $('#mot_calidad_<?php echo $valor['id']; ?>').attr('value','1'); } else { $('#mot_calidad_<?php echo $valor['id']; ?>').attr('value','0');}">
						<input type='hidden' id = 'mot_calidad_<?php echo $valor['id']; ?>' name='mot_calidad' value='<?php echo $valormotivos['calidad']; ?>'>
					</td>
				  </tr>
				  <tr>
					<td style='text-align: right; width: 90px; font-size: small;'>Precio</td>
					<td style='text-align: center;'><input type='checkbox' name='motivo_precio' <?php echo $arraycheck[$valormotivos['precio']]; ?> onClick="if(this.checked){ $('#mot_precio_<?php echo $valor['id']; ?>').attr('value','1'); } else { $('#mot_precio_<?php echo $valor['id']; ?>').attr('value','0');}">
						<input type='hidden' id = 'mot_precio_<?php echo $valor['id']; ?>' name='mot_precio' value='<?php echo $valormotivos['precio']; ?>'>
					</td>
				  </tr>
				  <tr>
					<td style='text-align: right; width: 90px; font-size: small;'>Confianza</td>
					<td style='text-align: center;'><input type='checkbox' name='motivo_confianza' <?php echo $arraycheck[$valormotivos['confianza']]; ?> onClick="if(this.checked){ $('#mot_confianza_<?php echo $valor['id']; ?>').attr('value','1'); } else { $('#mot_confianza_<?php echo $valor['id']; ?>').attr('value','0');}">
						<input type='hidden' id = 'mot_confianza_<?php echo $valor['id']; ?>' name='mot_confianza' value='<?php echo $valormotivos['confianza']; ?>'>
					</td>
				  </tr>
				  <tr>
					<td style='text-align: right; width: 90px; font-size: small;'>Atenci&oacute;n</td>
					<td style='text-align: center;'><input type='checkbox' name='motivo_atencion' <?php echo $arraycheck[$valormotivos['atencion']]; ?> onClick="if(this.checked){ $('#mot_atencion_<?php echo $valor['id']; ?>').attr('value','1'); } else { $('#mot_atencion_<?php echo $valor['id']; ?>').attr('value','0');}">
						<input type='hidden' id = 'mot_atencion_<?php echo $valor['id']; ?>' name='mot_atencion' value='<?php echo $valormotivos['atencion']; ?>'>
					</td>
				  </tr>
				  <tr>
					<td style='text-align: right; width: 90px; font-size: small;'>Servicio</td>
					<td style='text-align: center;'><input type='checkbox' name='motivo_servicio' <?php echo $arraycheck[$valormotivos['servicio']]; ?> onClick="if(this.checked){ $('#mot_servicio_<?php echo $valor['id']; ?>').attr('value','1'); } else { $('#mot_servicio_<?php echo $valor['id']; ?>').attr('value','0');}">
						<input type='hidden' id = 'mot_servicio_<?php echo $valor['id']; ?>' name='mot_servicio' value='<?php echo $valormotivos['servicio']; ?>'>
					</td>
				  </tr>	
				  <tr>
					<td style='text-align: right; width: 90px; font-size: small;'>Cercan&iacute;a</td>
					<td style='text-align: center;'><input type='checkbox' name='motivo_cercania' <?php echo $arraycheck[$valormotivos['cercania']]; ?> onClick="if(this.checked){ $('#mot_cercania_<?php echo $valor['id']; ?>').attr('value','1'); } else { $('#mot_cercania_<?php echo $valor['id']; ?>').attr('value','0');}">
						<input type='hidden' id = 'mot_cercania_<?php echo $valor['id']; ?>' name='mot_cercania' value='<?php echo $valormotivos['cercania']; ?>'>
					</td>
				  </tr>	
				  <tr>
					<td style='text-align: right; width: 90px; font-size: small;'>Experiencia</td>
					<td style='text-align: center;'><input type='checkbox' name='motivo_experiencia' <?php echo $arraycheck[$valormotivos['experiencia']]; ?> onClick="if(this.checked){ $('#mot_experiencia_<?php echo $valor['id']; ?>').attr('value','1'); } else { $('#mot_experiencia_<?php echo $valor['id']; ?>').attr('value','0');}">
						<input type='hidden' id = 'mot_experiencia_<?php echo $valor['id']; ?>' name='mot_experiencia' value='<?php echo $valormotivos['experiencia']; ?>'>
					</td>
				  </tr>
				  <tr>
					<td style='text-align: right; width: 90px; font-size: small;'>Otros</td>
					<td style='text-align: center;'><input type='checkbox' name='motivootros' <?php if($valormotivos['otros']!= ''){ echo "CHECKED"; } ?> onClick="if(this.checked){ $('#mot_otros_<?php echo $valor['id']; ?>').toggle(); $('#mot_otros_<?php echo $valor['id']; ?>').attr('value',''); } else { $('#mot_otros').toggle(); $('#mot_otros_<?php echo $valor['id']; ?>').attr('value',''); }">
						<textarea id = 'mot_otros_<?php echo $valor['id']; ?>' name='mot_otros' cols=40 rows=5 style='<?php if($valormotivos['otros']== ''){ echo "display: none;"; } ?>'><?php echo $valormotivos['otros']; ?></textarea>
					</td>
				  </tr>
			  	</table>
			  </td>
			  <td width='10%'></td>
			  <td style='width:5%'>
			 	<table>
				  <tr>
					<th style='font-size: small; text-align: right; color:black;'>Sugerencias: </th>
					<td><textarea name='sugerencias' cols="70" rows="4"><?php echo $valor['sugerencias']; ?></textarea><br></td>
				  </tr>
				  <tr>
					<th style='font-size: small; text-align: right; color:black;'>An&aacute;lisis: </th>
					<td><textarea name='analisis' cols="70" rows="4"><?php echo $valor['analisis']; ?></textarea><br></td>
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
	          	<input class="bt-accion" type="button" onclick="$('#guardar_encuesta_<?php echo $valor['id']; ?>').submit();"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          	
				<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />
          	
          		<input class="bt-accion" type="button" onclick="$('#pdf_encuesta').submit();"  name="img_pdf" id="img_pdf" value="PDF" />

	          </td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	        </tr>
	      </table>
	    </form>
	    
	    <form action='pdf_encuesta.php' method='post' target='new' id='pdf_encuesta'>
		  	 <input type='hidden' name='pdf' value='pdf'>
		  	 <input type='hidden' name='encuesta' value='<?php echo $valor['id']; ?>'>
  	  	</form>
		
		<form action='ver_satisfaccion.php' method='post' id='cancelar_<?php echo $valor['id']; ?>'>
			<input type='hidden' name='id_encuesta' value='<?php echo $valor['id']; ?>'></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
			<input type='hidden' name='buscar_por' value='<?php echo $_POST['buscar_por']; ?>'></input>
		  	<input type='hidden' name='criterios' value='<?php echo $_POST['criterios']; ?>'></input>
		</form>
	  </div>
	<?php }
  
include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
