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
<script>document.getElementById("lnk_informes").setAttribute("class", "seleccionado");</script>

<div id="cuerpo2">
	<div id="objetivo">
		<table width="100%" border="1" cellspacing="0">
			<tr>
				<th style='background-color:grey;'>INFORMES DE MAQUINARIA</th>
			</tr>
			<tr>
				<th style='background-color:grey;'>Fichas de equipos:</th>
			</tr>
			<tr>
				<td>
					<form action='pdf_fichas_equipos.php' method='post' target='new' id='pdf_fichas_equipos'>
						<input type='hidden' name='pdf' value='pdf'>
						Sacar ficha de: 
						<?php $equipos = select_normal("Select * from kz_tec_mant_equipos order by numero"); ?>
						<select class="select-comun" name='equipo'>
							<option value=''>TODOS</option>
							<?php foreach($equipos as $key => $valor){?>
								<option value='<?php echo $valor['id']; ?>'><?php echo $valor['numero']." || ".$valor['fab']." || ".$valor['modelo']; ?></option>
							<?php }?>
						</select>
						<input class="bt-accion" type="button" onclick="$('#pdf_fichas_equipos').submit();"  name="img_pdf" id="img_pdf" value="PDF" />

					</form>
				</td>
			</tr>
			<tr>
				<th style='background-color:grey;'>Listado de equipos:</th>
			</tr>
			<tr>
				<td>
					<form action='pdf_lista_equipos.php' method='post' target='new' id='pdf_lista_equipos'>
						<input type='hidden' name='pdf' value='pdf'>
						<input class="bt-accion" type="button" onclick="$('#pdf_lista_equipos').submit();"  name="img_pdf" id="img_pdf" value="PDF" />

					</form>
				</td>
			</tr>
			<tr>
				<th style='background-color:grey;'>Plan de mantenimiento:</th>
			</tr>
			<tr>
				<td>
					<form action='pdf_plan_mantenimiento.php' method='post' target='new' id='pdf_plan_mantenimiento'>
						<input type='hidden' name='pdf' value='pdf'>
						Plan de mantenimiento para: 
						<?php $equipos = select_normal("Select * from kz_tec_mant_equipos order by numero"); ?>
						<select class="select-comun" name='equipo'>
							<?php  foreach($equipos as $key => $valor){?>
								<option value='<?php echo $valor['id']; ?>'><?php echo $valor['numero']." || ".$valor['fab']." || ".$valor['modelo']; ?></option>
							<?php }?>
						</select>
						
						del a&ntilde;o 
						<select class="select-comun" name='anno'>
							<?php combo_base_array($array_annos, date("Y"));?>
						</select>
						
						<!-- Incluir sabados:  <input type='checkbox' name='sabados_incluidos' value='1'> -->
						
						<input class="bt-accion" type="button" onclick="$('#pdf_plan_mantenimiento').submit();" name="img_pdf" id="img_pdf" value="PDF" />

					</form>
          		</td>
			</tr>
			<tr>
				<th style='background-color:grey;'>Mantenimiento correctivo:</th>
			</tr>
			<tr>
				<td>
					<form action='pdf_mantenimiento_correctivo.php' method='post' target='new' id='pdf_mantenimiento_correctivo'>
						<input type='hidden' name='pdf' value='pdf'>
						Mantenimiento correctivo de: 
						<select class="select-comun" name='equipo'>
							<option value=''>TODOS</option>
							<?php foreach($equipos as $key => $valor){?>
								<option value='<?php echo $valor['id']; ?>'><?php echo $valor['numero']." || ".$valor['fab']." || ".$valor['modelo']; ?></option>
							<?php }?>
						</select>
						
						<br>
						Fecha inicio: <input class="input-comun" type='text'  id='fecha1' name='fecha1' value='' size=14>
						<img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal1'>
						<script>
					    Calendar.setup({
					        trigger    : "cal1",
					        inputField : "fecha1"
						    });
						</script><br>
						
						Fecha fin: <input class="input-comun" type='text'  id='fecha2' name='fecha2' value='' size=14>
						<img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal2'>
						<script>
					    Calendar.setup({
					        trigger    : "cal2",
					        inputField : "fecha2"
						    });
						</script>
						
						<br><br>
						<input class="bt-accion" type="button" onclick="$('#pdf_mantenimiento_correctivo').submit();"  name="img_pdf" id="img_pdf" value="PDF" />

					</form>
          		</td>
			</tr>
		</table>
	</div>
</div>
<br>
	
<?php include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
