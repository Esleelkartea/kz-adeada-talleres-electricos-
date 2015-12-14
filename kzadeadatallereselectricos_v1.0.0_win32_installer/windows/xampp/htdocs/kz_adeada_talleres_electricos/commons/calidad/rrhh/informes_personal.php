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
		<table width="100%" border="1" cellspacing="0">
			<tr>
				<th colspan=2 style='background-color:grey;'>INFORMES DE PERSONAL</th>
			</tr>
			<tr>
				<th colspan=2 style='background-color:grey;'>Fichas de personal:</th>
			</tr>
			<tr>
				<td colspan=2>
					<form action='pdf_personal.php' target="new" id='pdf_personal' method='post'>
						<input type='hidden' name='pdf' value='pdf'>
						Sacar ficha de:
						<select class="select-comun" name='persona'>
							<option value=''>TODOS</option>
							<?php $personas = select_normal("SELECT * FROM kz_tec_rrhh_personal order by apellidos asc"); 
							foreach($personas as $key => $valor){?>
								<option value='<?php echo $valor['id']; ?>'>
									<?php echo $valor['apellidos'].", ".$valor['nombre']; ?>
								</option>
							<?php }?>
						</select>
					
						<input class="bt-accion" type="button" onclick="$('#pdf_personal').submit();" name="img_pdf" id="img_pdf" value="PDF" />

          			</form>
          		</td>
			</tr>
			<tr>
				<th colspan=2 style='background-color:grey;'>Listado de personal:</th>
			</tr>
			<tr>
				<td>
					<form action='pdf_lista_personal.php' method='post' target='new' id='pdf_lista_personal'>
						<input type='hidden' name='pdf' value='pdf'>
						
						<input class="bt-accion" type="button" onclick="$('#pdf_lista_personal').submit();"  name="img_pdf" id="img_pdf" value="PDF" />

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
