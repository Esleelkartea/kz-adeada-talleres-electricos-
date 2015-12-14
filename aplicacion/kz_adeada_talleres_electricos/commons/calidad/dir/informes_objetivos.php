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
		<form action='pdf_lista_objetivos.php' method='post' target='new' id='pdf_lista_objetivos'>
			<table width="100%" border="1" cellspacing="0">
				<tr>
					<th style='background-color:grey;'>INFORMES DE OBJETIVOS</th>
				</tr>
				<tr>
					<th style='background-color:grey;'>Filtros del informe:</th>
				</tr>
				<tr>
					<td>
						<input type='hidden' name='pdf' value='pdf'>
						A&ntilde;o: 
						<select class="select-comun" name='anno'>
							<option value=''>TODOS</option>
							<?php foreach($array_annos as $key => $valor){?>
								<option value='<?php echo $valor; ?>'><?php echo $valor; ?></option>
							<?php }?>
						</select>	
					</td>
				</tr>
				<tr>
					<td>
						Cumplidos: 
						<select class="select-comun" name='estado'>
							<option value=''>TODOS</option>
							<option value='1'>SI</option>
							<option value='0'>NO</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Mostrar seguimiento <input type='checkbox' name='seg_obj' value='si'> 
					</td>
				</tr>
				<tr>
					<td>
						<input class="bt-accion" type="button" onclick="$('#pdf_lista_objetivos').submit();"  name="img_pdf" id="img_pdf" value="PDF" />

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
