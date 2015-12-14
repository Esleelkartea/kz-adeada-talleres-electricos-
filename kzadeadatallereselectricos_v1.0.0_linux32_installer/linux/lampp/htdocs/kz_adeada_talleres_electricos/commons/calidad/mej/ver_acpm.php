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

$ARRAY_NC = array_num_nc();

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
<script>document.getElementById("lnk_ver_acpm").setAttribute("class", "seleccionado");</script>

<div id="limpiar"></div>

<div id="link_normal"><a class="bt-nuevo-documento" href="nueva_acpm.php">Nueva Acci&oacute;n Correctiva/Mejora</a></div>

<div style='text-align:right;'>
	<form action='ver_acpm.php' method='POST' id="buscar_<?php echo $valor['id']; ?>" name="form_buscar">
		Buscar por campo:
		<select class="select-comun" name='buscar_por' id='buscar_por'>
			<option value='todos'>TODOS</option>
			<option value='fecha_apertura'>Fecha de apertura</option>
			<option value='descripcion_accion'>Descripci&oacute;n acci&oacute;n</option>
			<option value='tipo_accion'>Tipo acci&oacute;n</option>
			<option value='fecha_cierre'>Fecha cierre</option>
		</select>
		<input class="input-comun" type='text' name='criterios' value=''></input>
		<input class="bt-accion" type="button" onclick="$('#buscar_<?php echo $valor['id']; ?>').submit();" name="img_buscar" id="img_buscar<?php echo $valor['id'];  ?>" value="Buscar" />
          
		<input class="bt-accion" type="button" onclick="$('#mostrar_todos_<?php echo $valor['id']; ?>').submit();" name="img_mostrar_todos" id="img_mostrar_todos<?php echo $valor['id'];  ?>" value="Mostrar todos" />

	</form>	
	
	<form action='ver_acpm.php' method='post' id='mostrar_todos_<?php echo $valor['id']; ?>'>
	</form>
</div>
<br />

<?php if($_POST['criterios']){
	if($_POST['buscar_por'] == 'todos'){
		$criterios = " AND fecha_apertura LIKE '%".$_POST['criterios']."%' OR descripcion_accion LIKE '%".$_POST['criterios']."%' OR tipo_accion LIKE '%".$_POST['criterios']."%' OR fecha_cierre LIKE '%".$_POST['criterios']."%'";
	}
	else{
		$criterios = " AND ".$_POST['buscar_por']." LIKE '%".$_POST['criterios']."%'";
	}
	$acpms = select_normal("SELECT * FROM kz_tec_mej_acpm WHERE 1 = 1 $criterios ORDER BY fecha_apertura DESC");
}
else{
	unset($_POST['criterios']);
	$acpms = select_normal("SELECT * FROM kz_tec_mej_acpm ORDER BY fecha_apertura DESC LIMIT $limiteinf, $limitesup");
}

if($acpms){
  foreach($acpms as $key => $valor){ ?>

	<div id="cuerpo2">
	   	<div id="objetivo">
	     <table width="100%" border="1" cellspacing="0">
	       <tr>
	         <th>N&deg; NC</th>
	         <th>Fecha de apertura</th>
	         <th>Descripci&oacute;n acci&oacute;n</th>
	         <th>Tipo acci&oacute;n</th>
	         <th>Fecha cierre</th>
	         <th>Acciones</th>
	       </tr>
	       <tr>
	         <td><?php echo $ARRAY_NC[$valor['num_nc']]; ?></td>
	         <td><?php echo $valor['fecha_apertura']; ?></td>
	         <td><?php echo $valor['descripcion_accion']; ?></td>
	         <td><?php echo $valor['tipo_accion']; ?></td>
	         <td><?php echo $valor['fecha_cierre']; ?></td>
	         <td>
	         	<a class="bt-editar" style="cursor:pointer;" onclick="$('#editar_acpm_<?php echo $valor['id'];  ?>').submit();"></a>
		        
		        <hr class="linea_separacion">
		        <a class="bt-eliminar" style="cursor:pointer;" onclick="if(confirm('&iquest;Desea eliminar esta Acci&oacute;n?')){ 
		        $('#eliminar_acpm_<?php echo $valor['id'];  ?>').submit(); }"></a>

	         	<form action="editar_acpm.php" method="post" id="editar_acpm_<?php echo $valor['id'];?>">
					<input type='hidden' name='id_acpm' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
					<input type='hidden' name='buscar_por' value='<?php echo $_POST['buscar_por']; ?>'></input>
		  			<input type='hidden' name='criterios' value='<?php echo $_POST['criterios']; ?>'></input>
				</form>
	         	
	         	<form action='ver_acpm.php' method='post' id='eliminar_acpm_<?php echo $valor['id'];  ?>'>
					<input type='hidden' name='eliminar_acpm' value='<?php echo $valor['id']; ?>'></input>
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
	<form action='ver_acpm.php' method='POST' id="paginar_<?php echo $valor['id']; ?>" name="form_paginacion">
		P&aacute;gina:
		<select class="select-comun" name='p'>
			<?php
			paginacion("SELECT COUNT(id) as total FROM kz_tec_mej_acpm",PERSONAS_MOSTRAR, $_POST['p']);
			?>	
		</select>
		<input class="bt-accion" type="button" onclick="$('#paginar_<?php echo $valor['id']; ?>').submit();"  name="img_ir" id="img_ir<?php echo $valor['id'];  ?>" value="IR" />

	</form>
	<br>
  <?php }
}
else{
	echo "No hay Acciones<br><br>";
}

include('../struct/footer2.php'); ?>

</body>
</html>
