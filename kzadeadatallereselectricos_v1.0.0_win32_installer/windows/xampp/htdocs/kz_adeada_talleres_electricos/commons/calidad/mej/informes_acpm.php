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

<div id="limpiar"></div>

<div id="cuerpo2">
	<div id="objetivo">
		<form action='pdf_acpm.php' target="new" id='pdf_acpm' method='post'>
			<table width="100%" border="1" cellspacing="0">
				<tr>
					<th colspan=2>INFORMES DE ACCIONES CORRECTIVAS/MEJORA</th>
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
					<td colspan=2>Estado:
					<select class="select-comun" name='estado'>
						<option value=''>TODAS</option>
						<option value='SI'>Abiertas</option>
						<option value='NO'>Cerradas</option>
					</select>
					</td>
				</tr>
				<tr>
					<td colspan=2>Tipo:
						<select class="select-comun" name='tipo'>
							<option value=''>TODAS</option>
							<?php $tipos = select_normal("Select distinct(tipo_accion) from kz_tec_mej_acpm"); 
							foreach($tipos as $key => $valor) $tiposacpm[count($tiposacpm)] = $valor['tipo_accion'];
							combo_base_array($tiposacpm);?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan=2>Agrupar por tipo <input type='checkbox' name='ag_tipo'></td>
				</tr>
				<tr>
					<td colspan=2>Modo resumen <input type='checkbox' name='modo_resumen'></td>
				</tr>
				<tr>
					<td>
						<input class="bt-accion" type="button" onclick="$('#pdf_acpm').submit();"  name="img_pdf" id="img_pdf" value="PDF" />
	          			<input type='hidden' name='pdf' value='pdf'>
	          			<input class="bt-accion" type="button" onclick="$('#pdf_acpm_xls').submit();"  name="img_excel" id="img_excel" value="Hoja de c&aacute;lculo" />

	          		</td>
				</tr>
			</table>
		</form>
		
		<form action='pdf_acpm.php' method='post' id='pdf_acpm_xls'>
			<input type='hidden' name='xls' value='xls'></input>
		</form>
	</div>
</div>
	
<?php include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
