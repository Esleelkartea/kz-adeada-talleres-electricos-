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
<script>document.getElementById("lnk_ver_personal").setAttribute("class", "seleccionado");</script>

<div id = "link_normal"><a class="bt-nuevo-documento" href="nueva_persona.php">Alta de personal</a></div>

<div style='text-align:right;'>
	<form action='ver_personal.php' method='POST' id="buscar_<?php echo $valor['id']; ?>" name="form_buscar">
		Buscar por campo:
		<select class="select-comun" name='buscar_por' id='buscar_por'>
			<option value='todos'>TODOS</option>
			<option value='nombre'>Nombre</option>
			<option value='apellidos'>Apellido</option>
			<option value='telefono'>Tel&eacute;fono</option>
			<option value='movil'>M&oacute;vil</option>
			<option value='email'>Email</option>
		</select>
		<input type='text' name='criterios' value=''></input>
		<input class="bt-accion" type="button" onclick="$('#buscar_<?php echo $valor['id']; ?>').submit();" name="img_buscar" id="img_buscar<?php echo $valor['id'];  ?>" value="Buscar" />
          
        <input class="bt-accion" type="button" onclick="$('#mostrar_todos_<?php echo $valor['id']; ?>').submit();" name="img_mostrar_todos" id="img_mostrar_todos<?php echo $valor['id'];  ?>" value="Mostrar todos" />
	</form>	
	
	<form action='ver_personal.php' method='post' id='mostrar_todos_<?php echo $valor['id']; ?>'>
	</form>
</div>
<br />
<?php if($_POST['criterios']){
	if($_POST['buscar_por'] == 'todos'){
		$criterios = " AND nombre LIKE '%".$_POST['criterios']."%' OR apellidos LIKE '%".$_POST['criterios']."%' OR telefono LIKE '%".$_POST['criterios']."%' OR movil LIKE '%".$_POST['criterios']."%' OR email LIKE '%".$_POST['criterios']."%'";
	}
	else{
		$criterios = " AND ".$_POST['buscar_por']." LIKE '%".$_POST['criterios']."%'";
	} 
	$personas = select_normal("SELECT * FROM kz_tec_rrhh_personal WHERE 1 = 1 $criterios ORDER BY apellidos");
}
else{
	unset($_POST['criterios']);
	$personas = select_normal("SELECT * FROM kz_tec_rrhh_personal ORDER BY apellidos LIMIT $limiteinf, $limitesup");
}

if($personas){
  foreach($personas as $key => $valor){ ?>

	<div id="abrir">
		<a class="color_enlaces" href="javascript:" onclick="$('#form_abrir_<?php echo $valor['id']; ?>').submit();">abrir</a>
		<form action="ficha_persona.php" method="post" id="form_abrir_<?php echo $valor['id'];?>">
			<input type='hidden' name='id_persona' value='<?php echo $valor['id'];?>' ></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
		</form>
	</div>

	<div id="cuerpo2">
		<div id="limpiar"></div>
	   	<div id="objetivo">
	     <table width="100%" border="1" cellspacing="0">
	       <tr>
	         <th>Nombre</th>
	         <th>Apellido</th>
	         <th>Tel&eacute;fono</th>
	         <th>M&oacute;vil</th>
	         <th>Email</th>
	         <th>Acciones</th>
	       </tr>
	       <tr>
	         <td><?php echo $valor['nombre']; ?></td>
	         <td><?php echo $valor['apellidos']; ?></td>
	         <td><?php echo $valor['telefono']; ?></td>
	         <td><?php echo $valor['movil']; ?></td>
	         <td><?php echo $valor['email']; ?></td>
	         <td>
	         	<a class="bt-eliminar" style="cursor:pointer;" onclick="if(confirm('Si elimina este registro se borrar&aacute;n tambi&eacute;n todas sus valoraciones. &iquest;Continuar?')){ 
		        $('#eliminar_persona_<?php echo $valor['id'];  ?>').submit(); }"></a>

	         	<form action='ver_personal.php' method='post' id='eliminar_persona_<?php echo $valor['id'];  ?>'>
					<input type='hidden' name='eliminar_personal' value='<?php echo $valor['id']; ?>'></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
			 	</form>
	         </td>
	       </tr>
	     </table>
	   	</div>
	</div>
  <?php }
  
  if(!isset($_POST['criterios'])){?>
  	<br>
	<form action='ver_personal.php' method='POST' id="paginar_<?php echo $valor['id']; ?>" name="form_paginacion">
		P&aacute;gina:
		<select class="select-comun" name='p'>
			<?php
			paginacion("SELECT COUNT(id) as total FROM kz_tec_rrhh_personal",PERSONAS_MOSTRAR, $_POST['p']);
			?>	
		</select>
		<input class="bt-accion" type="button" onclick="$('#paginar_<?php echo $valor['id']; ?>').submit();"  name="img_ir" id="img_ir<?php echo $valor['id'];  ?>" value="IR" />
	</form>
	<br>
  <?php }
}
else{
	echo "No hay personal<br><br>";
}

include('../struct/footer2.php'); ?>

</body>
</html>
