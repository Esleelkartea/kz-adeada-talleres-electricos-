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
<script>document.getElementById("lnk_informes").setAttribute("class", "seleccionado");</script>

<div id="cuerpo2">
	<div id="objetivo">
		<form action='pdf_noconformidades.php' target="new" id='pdf_noconformidades' method='post'>
			<table width="100%" border="1" cellspacing="0">
				<tr>
					<th colspan=2 style='background-color:grey;'>INFORMES DE NO CONFORMIDADES</th>
				</tr>
				<tr>
					<th colspan=2 style='background-color:grey;'>Filtros del informe:</th>
				</tr>
				<tr>
					<td colspan=2>Fecha inicio:  <input class="input-comun" type='text'  id='fecha1c' name='fecha1' value='' size=14>
						<img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal1c'>
						<script>
					    Calendar.setup({
					        trigger    : "cal1c",
					        inputField : "fecha1c"
						    });
						</script>
					</td>
				</tr>
				<tr>
					<td colspan=2>Fecha fin: <input class="input-comun" type='text'  id='fecha2c' name='fecha2' value='' size=14>
						<img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal2c'>
						<script>
					    Calendar.setup({
					        trigger    : "cal2c",
					        inputField : "fecha2c"
						    });
						</script>
					</td>
				</tr>
				<tr>
					<td colspan=2>Origen de la NC:
					<select class="select-comun" name='tiponc'>
						<?php $origenes = select_normal("Select distinct(tipo) from kz_tec_mej_tiponc"); 
						foreach($origenes as $key => $valor) $tiposnc[count($tiposnc)] = $valor['tipo'];?>
						<option value=''>TODAS</option>
						<?php combo_base_array($tiposnc);?>
					</select>
					</td>
				</tr>	
				<tr>
					<td colspan=2>Especificaci&oacute;n de origen:
					<select class="select-comun" name='detectada_en'>
						<?php $detectada = select_normal("Select distinct(detectada_en) from kz_tec_mej_detectadaen"); 
						foreach($detectada as $key => $valor) $detectadaen[count($detectadaen)] = $valor['detectada_en'];?>
						<option value=''>TODAS</option>
						<?php combo_base_array($detectadaen);?>
					</select>
					</td>
				</tr>	
				<tr>
					<td colspan=2>Clasificaci&oacute;n de origen:
					<select class="select-comun" name='detectada_por'>
						<?php unset($detectadaen);
						$detectada = select_normal("Select distinct(detectada_por) from kz_tec_mej_noconformidades"); 
						foreach($detectada as $key => $valor) $detectadaen[count($detectadaen)] = $valor['detectada_por'];?>
						<option value=''>TODAS</option>
						<?php combo_base_array($detectadaen);?>
					</select>
					</td>
				</tr>
				<tr>
					<td colspan=2>Cierre eficaz:
					<select class="select-comun" name='cierre_eficaz'>
						<option value=''>TODAS</option>
						<option value='1'>SI</option>
						<option value='0'>NO</option>
					</select>
					</td>
				</tr>
				<tr>
					<td colspan=2>Maquinaria:
					<select class="select-comun" name='maquinaria'>
						<option value=''>TODAS</option>
						<option value='1'>SI</option>
						<option value='0'>NO</option>
					</select>
					</td>
				</tr>
				<tr>
					<td colspan=2>M&eacute;todos:
					<select class="select-comun" name='metodos'>
						<option value=''>TODAS</option>
						<option value='1'>SI</option>
						<option value='0'>NO</option>
					</select>
					</td>
				</tr>
				<tr>
					<td colspan=2>Mano de obra:
					<select class="select-comun" name='mano_obra'>
						<option value=''>TODAS</option>
						<option value='1'>SI</option>
						<option value='0'>NO</option>
					</select>
					</td>
				</tr>
				<tr>
					<td colspan=2>Mediciones:
					<select class="select-comun" name='mediciones'>
						<option value=''>TODAS</option>
						<option value='1'>SI</option>
						<option value='0'>NO</option>
					</select>
					</td>
				</tr>
				<tr>
					<td colspan=2>Modo resumen <input type='checkbox' name='modo_resumen'></td>
				</tr>
				<tr>
					<td>
						<input class="bt-accion" type="button" onclick="$('#pdf_noconformidades').submit();"  name="img_pdf" id="img_pdf" value="PDF" />
	          			<input type='hidden' name='pdf' value='pdf'>
	          			<input class="bt-accion" type="button" onclick="$('#pdf_noconformidades_xls').submit();"  name="img_excel" id="img_excel" value="Hoja de c&aacute;lculo" />

	          		</td>
				</tr>
			</table>
		</form>
		
		<form action='pdf_noconformidades.php' target='new' method='post' id='pdf_noconformidades_xls'>
			<input type='hidden' name='xls' value='xls'></input>
		</form>
	</div>
</div>
<br>
	
<?php include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
