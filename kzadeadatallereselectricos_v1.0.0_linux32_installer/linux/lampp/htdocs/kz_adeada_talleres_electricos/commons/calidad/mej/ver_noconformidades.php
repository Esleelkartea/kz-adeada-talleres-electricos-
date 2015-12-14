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
<script>document.getElementById("lnk_ver_noconformidades").setAttribute("class", "seleccionado");</script>

<form action='pdf_plantilla_noconformidad.php' method='post' target='new' id='pdf_plantilla_encuesta'>
	<input type='hidden' name='pdf' value='pdf'>
	<input class="bt-accion" type="button" onclick="$('#pdf_plantilla_encuesta').submit();"  name="img_pdf" id="img_pdf" value="PDF" />

</form>
<br>

<div id = "link_normal"><a class="bt-nuevo-documento" href="nueva_noconformidad.php">Nueva No Conformidad</a></div>

<div style='text-align:right;'>
	<form action='ver_noconformidades.php' method='POST' id="buscar_<?php echo $valor['id']; ?>" name="form_buscar">
		Buscar por campo:
		<select class="select-comun" name='buscar_por' id='buscar_por'>
			<option value='todos'>TODOS</option>
			<option value='cnc'>CNC</option>
			<option value='fecha_deteccion'>Fecha detecci&oacute;n</option>
			<option value='origen'>Origen de la NC</option>
			<option value='detectada_en'>Origen</option>
			<option value='descripcion'>Descripci&oacute;n</option>
			<option value='fecha_cierre'>Fecha cierre</option>
		</select>
		<input class="input-comun" type='text' name='criterios' value=''></input>
		<input class="bt-accion" type="button" onclick="$('#buscar_<?php echo $valor['id']; ?>').submit();" name="img_buscar" id="img_buscar<?php echo $valor['id'];  ?>" value="Buscar" />
         
		<input class="bt-accion" type="button" onclick="$('#mostrar_todos_<?php echo $valor['id']; ?>').submit();" name="img_mostrar_todos" id="img_mostrar_todos<?php echo $valor['id'];  ?>" value="Mostrar todos" />

	</form>	
	
	<form action='ver_noconformidades.php' method='post' id='mostrar_todos_<?php echo $valor['id']; ?>'>
	</form>
</div>
<br />

<?php if($_POST['criterios']){
	if($_POST['buscar_por'] == 'todos'){
		$criterios = " AND cnc LIKE '%".$_POST['criterios']."%' OR fecha_deteccion LIKE '%".$_POST['criterios']."%' OR tipoNC LIKE '%".$_POST['criterios']."%' OR detectada_en LIKE '%".$_POST['criterios']."%' OR descripcion LIKE '%".$_POST['criterios']."%' OR fecha_cierre LIKE '%".$_POST['criterios']."%'";
	}
	else{
		$criterios = " AND ".$_POST['buscar_por']." LIKE '%".$_POST['criterios']."%'";
	}
	$noconformidades = select_normal("SELECT * FROM kz_tec_mej_noconformidades WHERE 1 = 1 $criterios ORDER BY fecha_deteccion DESC");
}
else{
	unset($_POST['criterios']);
	$noconformidades = select_normal("SELECT * FROM kz_tec_mej_noconformidades ORDER BY fecha_deteccion DESC LIMIT $limiteinf, $limitesup");
}

if($noconformidades){
  foreach($noconformidades as $key => $valor){ ?>

	<div id="cuerpo2">
	   	<div id="objetivo">
	     <table width="100%" border="1" cellspacing="0">
	       <tr>
	         <th>CNC</th>
	         <th>Fecha detecci&oacute;n</th>
	         <th>Origen de la NC</th>
	         <th>Origen</th>
	         <th>Descripci&oacute;n</th>
	         <th>Fecha cierre</th>
	         <th>Acciones</th>
	       </tr>
	       <tr>
	         <td><?php echo $valor['cnc']; ?></td>
	         <td><?php echo $valor['fecha_deteccion']; ?></td>
	         <td><?php echo $valor['tipoNC']; ?></td>
	         <td><?php echo $valor['detectada_en']; ?></td>
	         <td><?php echo $valor['descripcion']; ?></td>
	         <td><?php echo $valor['fecha_cierre']; ?></td>
	         <td>
	         	<a class="bt-editar" style="cursor:pointer;" onclick="$('#editar_noconformidad_<?php echo $valor['id'];  ?>').submit();"></a>
		        
		        <hr class="linea_separacion">
		        <a class="bt-eliminar" style="cursor:pointer;" onclick="if(confirm('&iquest;Desea eliminar esta No Conformidad?')){ 
		        $('#eliminar_noconformidad_<?php echo $valor['id'];  ?>').submit(); }"></a>

	         	<form action="editar_noconformidad.php" method="post" id="editar_noconformidad_<?php echo $valor['id'];?>">
					<input type='hidden' name='id_noconformidad' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
				</form>
	         	
	         	<form action='ver_noconformidades.php' method='post' id='eliminar_noconformidad_<?php echo $valor['id'];  ?>'>
					<input type='hidden' name='eliminar_noconformidad' value='<?php echo $valor['id']; ?>'></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
			 	</form>
	         </td>
	       </tr>
	     </table>
	   	</div>
	</div>
  <?php }
  
  if(!isset($_POST['criterios'])){?>
  	<br />
  	<form action='ver_noconformidades.php' method='POST' id="paginar_<?php echo $valor['id']; ?>" name="form_paginacion">
		P&aacute;gina:
		<select class="select-comun" name='p'>
			<?php
			paginacion("SELECT COUNT(id) as total FROM kz_tec_mej_noconformidades",PERSONAS_MOSTRAR, $_POST['p']);
			?>	
		</select>	
		<input class="bt-accion" type="button" onclick="$('#paginar_<?php echo $valor['id']; ?>').submit();"  name="img_ir" id="img_ir<?php echo $valor['id'];  ?>" value="IR" />

	</form>
	<br />
  <?php }
}
else{
	echo "No hay No Conformidades<br><br>";
}

include('../struct/footer2.php'); ?>

</body>
</html>
