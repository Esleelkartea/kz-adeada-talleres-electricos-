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

<script>document.getElementById("lnk_direccion").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_ver_reuniones").setAttribute("class", "seleccionado");</script>

<div id = "link_normal"><a class="bt-nuevo-documento" href="nueva_reunion.php">Nueva reuni&oacute;n</a></div>

<div style='text-align:right;'>
	<form action='ver_reuniones.php' method='POST' id="buscar_<?php echo $valor['id']; ?>" name="form_buscar">
		Buscar por campo:
		<select class="select-comun" name='buscar_por' id='buscar_por'>
			<option value='todos'>TODOS</option>
			<option value='departamento'>Departamento</option>
			<option value='fecha'>Fecha</option>
			<option value='asistentes'>Asistentes</option>
			<option value='objeto'>Objeto de la reuni&oacute;n</option>
			<option value='fechasig'>Siguiente reuni&oacute;n</option>
		</select>
		<input class="bt-comun" type='text' name='criterios' value=''></input>
		<input class="bt-accion" type="button" onclick="$('#buscar_<?php echo $valor['id']; ?>').submit();" name="img_buscar" id="img_buscar<?php echo $valor['id'];  ?>" value="Buscar" />
          
		<input class="bt-accion" type="button" onclick="$('#mostrar_todos_<?php echo $valor['id']; ?>').submit();" name="img_mostrar_todos" id="img_mostrar_todos<?php echo $valor['id'];  ?>" value="Mostrar todos" />

	</form>	
	
	<form action='ver_reuniones.php' method='post' id='mostrar_todos_<?php echo $valor['id']; ?>'>
	</form>
</div>
<br />
<?php if($_POST['criterios']){
	if($_POST['buscar_por'] == 'todos'){
		$criterios = " AND departamento LIKE '%".$_POST['criterios']."%' OR fecha LIKE '%".$_POST['criterios']."%' OR asistentes LIKE '%".$_POST['criterios']."%' OR objeto LIKE '%".$_POST['criterios']."%' OR fechasig  LIKE '%".$_POST['criterios']."%'";
	}
	else{
		$criterios = " AND ".$_POST['buscar_por']." LIKE '%".$_POST['criterios']."%'";
	}
	$reuniones = select_normal("SELECT * FROM kz_tec_dir_reuniones WHERE 1 = 1 $criterios ORDER BY fecha DESC");
}
else{	
	unset($_POST['criterios']);
	$reuniones = select_normal("SELECT * FROM kz_tec_dir_reuniones ORDER BY fecha DESC LIMIT $limiteinf, $limitesup");
}

if($reuniones){
  foreach($reuniones as $key => $valor){ ?>
  
	<div id="abrir">  
		<a class="color_enlaces" href="javascript:" onclick="$('#form_abrir_<?php echo $valor['id']; ?>').submit();">abrir</a>
		<form action="ficha_reunion.php" method="post" id="form_abrir_<?php echo $valor['id'];?>">
			<input type='hidden' name='id_reunion' value='<?php echo $valor['id'];?>' ></input>
		</form>
	</div>
	
	<div id="cuerpo2">
	  	<div id="limpiar"></div>
	   	<div id="objetivo">
	     <table width="100%" border="1" cellspacing="0">
	       <tr>
	         <th>Departamento</th>
	         <th>Fecha</th>
	         <th>Asistentes</th>
	         <th>Objeto de la reuni&oacute;n</th>
	         <th>Siguiente reuni&oacute;n</th>
	         <th>Acciones</th>
	       </tr>
	       <tr>
	         <td><?php echo $valor['departamento']; ?></td>
	         <td><?php echo $valor['fecha']; ?></td>
	         <td><?php echo $valor['asistentes']; ?></td>
	         <td><?php echo $valor['objeto']; ?></td>
	         <td><?php echo $valor['fechasig']; ?></td>
	         <td>
	         	<a class="bt-eliminar" style="cursor:pointer;" onclick="if(confirm('&iquest;Desea eliminar esta reuni&oacute;n?')){ 
		        $('#eliminar_reunion_<?php echo $valor['id'];  ?>').submit(); }"></a>

	         	<form action='ver_reuniones.php' method='post' id='eliminar_reunion_<?php echo $valor['id'];  ?>'>
					<input type='hidden' name='eliminar_reunion' value='<?php echo $valor['id']; ?>'></input>
			 	</form>
	         </td>
	       </tr>
	     </table>
	   	</div>
	</div>
  <?php }
  
  if(!isset($_POST['criterios'])){?>
  	<br>
	<form action='ver_reuniones.php' method='POST' id="paginar_<?php echo $valor['id']; ?>" name="form_paginacion">
		P&aacute;gina:
		<select class="select-comun" name='p'>
			<?php
			paginacion("SELECT COUNT(id) as total FROM kz_tec_dir_reuniones",PERSONAS_MOSTRAR, $_POST['p']);
			?>	
		</select>	
		<input class="bt-accion" type="button" onclick="$('#paginar_<?php echo $valor['id']; ?>').submit();"  name="img_ir" id="img_ir<?php echo $valor['id'];  ?>" value="IR" />

	</form>
	<br>
  <?php }
}
else{
	echo "No hay reuniones<br><br>";
}

include('../struct/footer2.php'); ?>

</body>
</html>
