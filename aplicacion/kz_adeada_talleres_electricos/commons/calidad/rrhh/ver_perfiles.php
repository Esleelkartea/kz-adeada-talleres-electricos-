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

<script>document.getElementById("lnk_rrhh").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_ver_perfiles").setAttribute("class", "seleccionado");</script>

<div id = "link_normal"><a class="bt-nuevo-documento" href="nuevo_perfil.php">Nuevo perfil</a></div>

<div style='text-align:right;'>
	<form action='ver_perfiles.php' method='POST' id="buscar_<?php echo $valor['id']; ?>" name="form_buscar">
		Buscar por campo:
		<select class="select-comun" name='buscar_por' id='buscar_por'>
			<option value='todos'>TODOS</option>
			<option value='nombre'>Nombre</option>
			<option value='funciones'>Funciones</option>
			<option value='formacion'>Formaci&oacute;n</option>
			<option value='experiencia'>Experiencia</option>
			<option value='caracteristicas'>Caracter&iacute;sticas</option>
		</select>
		<input class="input-comun" type='text' name='criterios' value=''></input>
		<input class="bt-accion" type="button" onclick="$('#buscar_<?php echo $valor['id']; ?>').submit();" name="img_buscar" id="img_buscar<?php echo $valor['id'];  ?>" value="Buscar" />
          
		<input class="bt-accion" type="button" onclick="$('#mostrar_todos_<?php echo $valor['id']; ?>').submit();" name="img_mostrar_todos" id="img_mostrar_todos<?php echo $valor['id'];  ?>" value="Mostrar todos" />
	</form>	
	
	<form action='ver_perfiles.php' method='post' id='mostrar_todos_<?php echo $valor['id']; ?>'>
	</form>
</div>
<br />

<?php if($_POST['criterios']){
	if($_POST['buscar_por'] == 'todos'){
		$criterios = " AND nombre LIKE '%".$_POST['criterios']."%' OR funciones LIKE '%".$_POST['criterios']."%' OR formacion LIKE '%".$_POST['criterios']."%' OR experiencia LIKE '%".$_POST['criterios']."%' OR caracteristicas LIKE '%".$_POST['criterios']."%'";
	}
	else{
		$criterios = " AND ".$_POST['buscar_por']." LIKE '%".$_POST['criterios']."%'";
	}
	$perfiles = select_normal("SELECT * FROM kz_tec_rrhh_perfilespuestos WHERE 1 = 1 $criterios ORDER BY nombre");
}
else{
	unset($_POST['criterios']);
	$perfiles = select_normal("SELECT * FROM kz_tec_rrhh_perfilespuestos ORDER BY nombre LIMIT $limiteinf, $limitesup");
}

if($perfiles){
  foreach($perfiles as $key => $valor){ ?>

	<div id="cuerpo2">
	   	<div id="objetivo">
	     <table width="100%" border="1" cellspacing="0">
	       <tr>
	         <th width="15%">Nombre</th>
	         <th width="30%">Funciones</th>
	         <th width="15%">Formaci&oacute;n</th>
	         <th></th>
	         <th width="15%">Experiencia</th>
	         <th width="15%">Caracter&iacute;sticas</th>
	         <th width="15%">Acciones</th>
	       </tr>
	       <tr>
	         <td><?php echo $valor['nombre']; ?></td>
	         <td><?php echo $valor['funciones']; ?></td>
	         <td><?php echo $valor['formacion']; ?></td>
	         <td><?php echo $valor['forvsexp']; ?></td>
	         <td><?php echo $valor['experiencia']; ?></td>
	         <td><?php echo $valor['caracteristicas']; ?></td>
	         <td>
	         	<a class="bt-editar" style="cursor:pointer;" onclick="$('#editar_perfil_<?php echo $valor['id'];  ?>').submit();"></a>
		        
		        <hr class="linea_separacion">
		        <a class="bt-eliminar" style="cursor:pointer;" onclick="if(confirm('&iquest;Desea eliminar este perfil?')){ 
		        $('#eliminar_perfil_<?php echo $valor['id'];  ?>').submit(); }"></a>

	         	<form action="editar_perfil.php" method="post" id="editar_perfil_<?php echo $valor['id'];?>">
					<input type='hidden' name='id_perfil' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
				</form>
	         	
	         	<form action='ver_perfiles.php' method='post' id='eliminar_perfil_<?php echo $valor['id'];  ?>'>
					<input type='hidden' name='eliminar_perfil' value='<?php echo $valor['id']; ?>'></input>
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
	<form action='ver_perfiles.php' method='POST' id="paginar_<?php echo $valor['id']; ?>" name="form_paginacion">
		P&aacute;gina:
		<select class="select-comun" name='p'>
			<?php
			paginacion("SELECT COUNT(id) as total FROM kz_tec_rrhh_perfilespuestos",PERSONAS_MOSTRAR, $_POST['p']);
			?>	
		</select>	
		<input class="bt-accion" type="button" onclick="$('#paginar_<?php echo $valor['id']; ?>').submit();"  name="img_ir" id="img_ir<?php echo $valor['id'];  ?>" value="IR" />

	</form>
	<br>
  <?php }
}
else{
	echo "No hay perfiles<br><br>";
}

include('../struct/footer2.php'); ?>

</body>
</html>
