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
	
		<form action='pdf_documentos.php' target="new" id='pdf_documentos' method='post'>
			<input type='hidden' name='orden' value='tipo'></input>
			<table width="100%" border="1" cellspacing="0">
				<tr>
					<th colspan=2>INFORMES DE DOCUMENTOS</th>
				</tr>
				<tr>
					<th colspan=2 style='background-color:grey;'>Filtros del informe:</th>
				</tr>
				<tr>
					<td colspan=2>Tipo de documento: 
						<select class="select-comun" name='tipodoc' id='tipodoc'>
							<option value=''>TODOS</option>
							<option value='DOCUMENTO'>DOCUMENTOS</option>
							<option value='REGISTRO'>REGISTROS</option>
							<option value='DOC / REG'>DOC / REG</option>
							<option value='MANUAL'>MANUALES</option>
							<option value='PROCEDIMIENTO'>PROCEDIMIENTOS</option>
							<option value='NORMAS'>NORMAS</option>
							<option value='IMPRESO'>IMPRESOS</option>
							<option value='INSTRUCCION'>INSTRUCCIONES</option>
							<option value='CERTIFICADO'>CERTIFICADOS</option>
							<option value='OTROS'>OTROS</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan=2>En vigor: 
					<select class="select-comun" name='vigor' id='vigor'>
						<option value=''>TODOS</option>
						<option value='1'>SI</option>
						<option value='0'>NO</option>
					</select></td>
				</tr>
				<tr>
					<td>
						<input class="bt-accion" type="button" onclick="$('#pdf_documentos').submit();"  name="img_pdf" id="img_pdf" value="PDF" />
		          		<input type='hidden' name='pdf' value='pdf'>
						<input class="bt-accion" type="button" onclick="$('#pdf_documentos_xls').submit();"  name="img_excel" id="img_excel" value="Hoja de c&aacute;lculo" />
	          		</td>
				</tr>
			</table>
		</form>
		
		<form action='pdf_documentos.php' target="new" method='post' id='pdf_documentos_xls'>
			<input type='hidden' name='orden' value='tipo'></input>
			<input type='hidden' name='xls' value='xls'></input>
		</form>
		
	</div>
</div>
	
<?php include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
