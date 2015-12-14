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
include('../struct/header_doc.php');
require('../functions/doc_functions.php');
require('doc_preacciones.php');
?>

<script>document.getElementById("lnk_documentacion").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_informes").setAttribute("class", "seleccionado");</script>

<div id="cuerpo2">
	<div id="objetivo">
		<table width="100%" border="1" cellspacing="0">
			<tr>
				<th colspan=2>INFORMES DE MANUAL</th>
			</tr>
			<tr>
				<th colspan=2 style='background-color:grey;'>Fichas de manual:</th>
			</tr>
			<tr>
				<td colspan=2>
					<form action='pdf_manual.php' target="new" id='pdf_manual' method='post'>
						<input type='hidden' name='pdf' value='pdf'>
						Sacar ficha de:
						<select class="select-comun" name='manual'>
							<option value=''>TODOS</option>
							<?php $manual = select_normal("SELECT * FROM kz_tec_doc_manual"); 
							foreach($manual as $key => $valor){?>
								<option value='<?php echo $valor['id']; ?>'>
									<?php echo $valor['presentacion_empresa']." || ".$valor['politica_calidad']; ?>
								</option>
							<?php }?>
						</select>
					
						<input class="bt-accion" type="button" onclick="$('#pdf_manual').submit();"  name="img_pdf" id="img_pdf" value="PDF" />

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
