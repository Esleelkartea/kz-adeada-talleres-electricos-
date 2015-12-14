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

<div id="limpiar"></div>

<div id="cuerpo2">
	<div id="objetivo">
		<table width="100%" border="1" cellspacing="0">
			<tr>
				<th>INFORMES DE REVISION POR LA DIRECCION</th>
			</tr>
			<tr>
				<th style='background-color:grey;'>Fichas de la revisi&oacute;n por la direcci&oacute;n de Calidad:</th>
			</tr>
			<tr>
				<td>
					<form action='pdf_revision_direccion_calidad.php' method='post' target='new' id='pdf_revision_direccion_calidad'>
						<input type='hidden' name='pdf' value='pdf'>
						A&ntilde;o: 
						<select class="select-comun" name='anno'>
							<option value=''>TODOS</option>
							<?php combo_base_array($array_annos, date("Y"));?>
						</select>
						
						<input class="bt-accion" type="button" onclick="$('#pdf_revision_direccion_calidad').submit();"  name="img_pdf" id="img_pdf" value="PDF" />

					</form>
          		</td>
			</tr>
		</table>
	</div>
</div>

<?php include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
