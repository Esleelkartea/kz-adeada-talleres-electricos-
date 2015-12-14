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
<script>document.getElementById("lnk_informes").setAttribute("class", "seleccionado");</script>

<div id="cuerpo2">
	<div id="objetivo">
		<table width="100%" border="1" cellspacing="0">
			<tr>
				<th style='background-color:grey;'>INFORMES DE REUNIONES</th>
			</tr>
			<tr>
				<th style='background-color:grey;'>Reuniones entre fechas:</th>
			</tr>
			<tr>
				<td> 
					<form action='pdf_fechas_reuniones.php' method='post' target='new' id='pdf_fechas_reuniones'>
						<input type='hidden' name='pdf' value='pdf'>
						Fecha inicio:  <input class="input-comun" type='text'  id='fecha1' name='fecha1' value='' size=14>
						<img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal1'>
						<script>
					    Calendar.setup({
					        trigger    : "cal1",
					        inputField : "fecha1"
						    });
						</script>
						
						<br>
						Fecha fin: <input class="input-comun" type='text'  id='fecha2' name='fecha2' value='' size=14>
						<img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal2'>
						<script>
					    Calendar.setup({
					        trigger    : "cal2",
					        inputField : "fecha2"
						    });
						</script>
						
						<br><br>
						<input class="bt-accion" type="button" onclick="$('#pdf_fechas_reuniones').submit();"  name="img_pdf" id="img_pdf" value="PDF" />

					</form>
          		</td>
			</tr>
			<tr>
				<th style='background-color:grey;'>Ordenes del d&iacute;a por departamento:</th>
			</tr>
			<tr>
				<td> 
					<form action='pdf_temas_pendientes.php' method='post' target='new' id='pdf_temas_pendientes'>
						<input type='hidden' name='pdf' value='pdf'>
						<input class="bt-accion" type="button" onclick="$('#pdf_temas_pendientes').submit();"  name="img_pdf" id="img_pdf" value="PDF" />

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
