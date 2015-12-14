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

//PAGINACION -------------------------------
if(!$_POST['p']){
	$limiteinf = 0;
	$limitesup = PERSONAS_MOSTRAR;
}
else{
	$limitesup= PERSONAS_MOSTRAR;
	$limiteinf= PERSONAS_MOSTRAR * $_POST['p'] - PERSONAS_MOSTRAR;
	
}
//FIN DE LA PAGINACION ---------------------
?>

<script>document.getElementById("lnk_mejora").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_ver_satisfaccion_clientes").setAttribute("class", "seleccionado");</script>

<table class="tabla_sin_borde" width="80%" border="0">
	<tr>
		<td>
			<form action='pdf_plantilla_encuesta_eu_es.php' method='post' target='new' id='pdf_plantilla_encuesta_eu_es'>
				<input type='hidden' name='pdf' value='pdf'>
				Plantilla cast./eusk.:
				<input class="bt-accion" type="button" onclick="$('#pdf_plantilla_encuesta_eu_es').submit();"  name="img_pdf" id="img_pdf" value="PDF" />

			</form>
		</td>
		<td>
			<form action='pdf_plantilla_encuesta_eu.php' method='post' target='new' id='pdf_plantilla_encuesta_eu'>
				<input type='hidden' name='pdf' value='pdf'>
				Plantilla eusk.:
				<input class="bt-accion" type="button" onclick="$('#pdf_plantilla_encuesta_eu').submit();"  name="img_pdf" id="img_pdf" value="PDF" />
	
			</form>
		</td>
		<td>
			<form action='pdf_plantilla_encuesta_es.php' method='post' target='new' id='pdf_plantilla_encuesta_es'>
				<input type='hidden' name='pdf' value='pdf'>
				Plantilla cast.:
				<input class="bt-accion" type="button" onclick="$('#pdf_plantilla_encuesta_es').submit();"  name="img_pdf" id="img_pdf" value="PDF" />

			</form>
		</td>
	</tr>
</table>
<br>

<div id="link_normal"><a class="bt-nuevo-documento" href="nueva_encuesta.php">Nueva encuesta</a></div>

<div style='text-align:right;'>
	<form action='ver_satisfaccion.php' method='POST' id="buscar_<?php echo $valor['id']; ?>" name="form_buscar">
		Buscar por campo:
		<select class="select-comun" name='buscar_por' id='buscar_por'>
			<option value='todos'>TODOS</option>
			<option value='organizacion'>Organizaci&oacute;n</option>
			<option value='comercial'>Comercial</option>
			<option value='fechaencuesta'>Fecha encuesta</option>
		</select>
		<input class="input-comun" type='text' name='criterios' value=''></input>
		<input class="bt-accion" type="button" onclick="$('#buscar_<?php echo $valor['id']; ?>').submit();" name="img_buscar" id="img_buscar<?php echo $valor['id'];  ?>" value="Buscar" />
          
		<input class="bt-accion" type="button" onclick="$('#mostrar_todos_<?php echo $valor['id']; ?>').submit();" name="img_mostrar_todos" id="img_mostrar_todos<?php echo $valor['id'];  ?>" value="Mostrar todos" />

	</form>	
	
	<form action='ver_satisfaccion.php' method='post' id='mostrar_todos_<?php echo $valor['id']; ?>'>
	</form>
</div>
<br>

<?php if($_POST['criterios']){
	if($_POST['buscar_por'] == 'todos'){
		$criterios = " AND (organizacion LIKE '%".$_POST['criterios']."%' OR comercial LIKE '%".$_POST['criterios']."%' OR fechaencuesta LIKE '%".$_POST['criterios']."%')";
	}
	else{
		$criterios = " AND (".$_POST['buscar_por']." LIKE '%".$_POST['criterios']."%')";
	}
	$encuestas = select_normal("SELECT * FROM kz_tec_mej_encuesta WHERE 1 = 1 $criterios ORDER BY fechaencuesta DESC");
}
else{
	unset($_POST['criterios']);
	$encuestas = select_normal("SELECT * FROM kz_tec_mej_encuesta ORDER BY fechaencuesta DESC LIMIT $limiteinf, $limitesup");
}

if($encuestas){
  foreach($encuestas as $key => $valor){ ?>

	<div id="cuerpo2">
	   	<div id="objetivo">
	     <table width="100%" border="1" cellspacing="0">
	       <tr>
	         <th>Organizaci&oacute;n</th>
	         <th>Comercial</th>
	         <th>Fecha encuesta</th>
	         <th>Acciones</th>
	       </tr>
	       <tr>
	         <td><?php echo $valor['organizacion']; ?></td>
	         <td><?php echo $valor['comercial']; ?></td>
	         <td><?php echo $valor['fechaencuesta']; ?></td>
	         <td>
	         	<a class="bt-editar" style="cursor:pointer;" onclick="$('#editar_encuesta_<?php echo $valor['id'];  ?>').submit();"></a>
		        
		        <hr class="linea_separacion">
		        <a class="bt-eliminar" style="cursor:pointer;" onclick="if(confirm('&iquest;Desea eliminar esta encuesta?')){ 
		        $('#eliminar_encuesta_<?php echo $valor['id'];  ?>').submit(); }"></a>
	         
	         	<form action="editar_encuesta.php" method="post" id="editar_encuesta_<?php echo $valor['id'];?>">
					<input type='hidden' name='id_encuesta' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
					<input type='hidden' name='buscar_por' value='<?php echo $_POST['buscar_por']; ?>'></input>
		  			<input type='hidden' name='criterios' value='<?php echo $_POST['criterios']; ?>'></input>
				</form>
	         	
	         	<form action='ver_satisfaccion.php' method='post' id='eliminar_encuesta_<?php echo $valor['id'];  ?>'>
					<input type='hidden' name='eliminar_encuesta' value='<?php echo $valor['id']; ?>'></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
					<input type='hidden' name='buscar_por' value='<?php echo $_POST['buscar_por']; ?>'></input>
		  			<input type='hidden' name='criterios' value='<?php echo $_POST['criterios']; ?>'></input>
			 	</form>
	         </td>
	       </tr>
	     </table>
	   	</div>
	</div>
  <?php }
  
  if(!isset($_POST['criterios'])){?>
  	<br />
	<form action='ver_satisfaccion.php' method='POST' id="paginar_<?php echo $valor['id']; ?>" name="form_paginacion">
		P&aacute;gina:
		<select class="select-comun" name='p'>
			<?php
			paginacion("SELECT COUNT(id) as total FROM kz_tec_mej_encuesta",PERSONAS_MOSTRAR, $_POST['p']);
			?>	
		</select>	
		<input class="bt-accion" type="button" onclick="$('#paginar_<?php echo $valor['id']; ?>').submit();"  name="img_ir" id="img_ir<?php echo $valor['id'];  ?>" value="IR" />
	</form>
	<br />
  <?php }
}
else{
	echo "No hay encuestas<br><br>";
}

include('../struct/footer2.php'); ?>

</body>
</html>
