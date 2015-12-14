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
include('../struct/header_rrhh.php');
require('../functions/rrhh_functions.php');
require('rrhh_preacciones.php');
?>

<script>document.getElementById("lnk_rrhh").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_informes").setAttribute("class", "seleccionado");</script>

<div id="cuerpo2">
	<div id="objetivo">
		<form action='pdf_formacion.php' target="new" id='pdf_formacion' method='post'>
			<input type='hidden' name='pdf' value='pdf'>
			<table width="100%" border="1" cellspacing="0">
				<tr>
					<th colspan=2 style='background-color:grey;'>INFORMES DE FORMACION</th>
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
					<td>
					<input class="bt-accion" type="button" onclick="$('#pdf_formacion').submit();"  name="img_pdf" id="img_pdf" value="PDF" />

	          		</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<br>
	
<?php include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
