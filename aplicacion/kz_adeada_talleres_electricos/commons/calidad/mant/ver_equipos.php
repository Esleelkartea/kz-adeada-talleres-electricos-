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
include('../struct/header_mant.php');
require('../functions/mant_functions.php');
require('mant_preacciones.php');

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

<script>document.getElementById("lnk_mantenimiento").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_ver_equipos").setAttribute("class", "seleccionado");</script>

<div id = "link_normal"><a class="bt-nuevo-documento" href="nuevo_equipo.php">Nuevo equipo</a></div>

<div style='text-align:right;'>
	<form action='ver_equipos.php' method='POST' id="buscar_<?php echo $valor['id']; ?>" name="form_buscar">
		Buscar por campo:
		<select class="select-comun" name='buscar_por' id='buscar_por'>
			<option value='todos'>TODOS</option>
			<option value='numero'>N&uacute;mero</option>
			<option value='ref'>Ref.</option>
			<option value='fab'>Fabricante</option>
			<option value='modelo'>Modelo</option>
			<option value='tipo'>Tipo</option>
		</select>
		<input class="input-comun" type='text' name='criterios' value=''></input>
		<input class="bt-accion" type="button" onclick="$('#buscar_<?php echo $valor['id']; ?>').submit();" name="img_buscar" id="img_buscar<?php echo $valor['id'];  ?>" value="Buscar" />
          
		<input class="bt-accion" type="button" onclick="$('#mostrar_todos_<?php echo $valor['id']; ?>').submit();" name="img_mostrar_todos" id="img_mostrar_todos<?php echo $valor['id'];  ?>" value="Mostrar todos" />

	</form>	
	
	<form action='ver_equipos.php' method='post' id='mostrar_todos_<?php echo $valor['id']; ?>'>
	</form>
</div>
<br />

<?php if($_POST['criterios']){
	if($_POST['buscar_por'] == 'todos'){
		$criterios = " AND numero LIKE '%".$_POST['criterios']."%' OR ref LIKE '%".$_POST['criterios']."%' OR fab LIKE '%".$_POST['criterios']."%' OR modelo LIKE '%".$_POST['criterios']."%' OR tipo LIKE '%".$_POST['criterios']."%'";
	}
	else{
		$criterios = " AND ".$_POST['buscar_por']." LIKE '%".$_POST['criterios']."%'";
	}
	$equipos = select_normal("SELECT * FROM kz_tec_mant_equipos WHERE 1 = 1 $criterios ORDER BY numero");
}
else{
	unset($_POST['criterios']);
	$equipos = select_normal("SELECT * FROM kz_tec_mant_equipos ORDER BY numero LIMIT $limiteinf, $limitesup");
}

if($equipos){
  foreach($equipos as $key => $valor){ ?>

	<div id="abrir">
		<a class="color_enlaces" href="javascript:" onclick="$('#form_abrir_<?php echo $valor['id']; ?>').submit();">abrir</a>
		<form action="ficha_equipo.php" method="post" id="form_abrir_<?php echo $valor['id'];?>">
			<input type='hidden' name='id_equipo' value='<?php echo $valor['id'];?>' ></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
		</form>
	</div>

	<div id="cuerpo2">
		<div id="limpiar"></div>
	   	<div id="objetivo">
	     <table width="100%" border="1" cellspacing="0">
	       <tr>
	         <th>N&uacute;mero</th>
	         <th>Ref.</th>
	         <th>Fabricante</th>
	         <th>Modelo</th>
	         <th>Tipo</th>
	         <th>Acciones</th>
	       </tr>
	       <tr>
	         <td><?php echo $valor['numero']; ?></td>
	         <td><?php echo $valor['ref']; ?></td>
	         <td><?php echo $valor['fab']; ?></td>
	         <td><?php echo $valor['modelo']; ?></td>
	         <td><?php echo $valor['tipo']; ?></td>
	         <td>
	         	<a class="bt-eliminar" style="cursor:pointer;" onclick="if(confirm('Si elimina este equipo, tambi&eacute;n se borrar&aacute; su plan de mantenimiento. &iquest;Desea continuar?')){ 
		        $('#eliminar_equipo_<?php echo $valor['id'];  ?>').submit(); }"></a>

	         	<form action='ver_equipos.php' method='post' id='eliminar_equipo_<?php echo $valor['id'];  ?>'>
					<input type='hidden' name='eliminar_equipo' value='<?php echo $valor['id']; ?>'></input>
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
	<form action='ver_equipos.php' method='POST' id="paginar_<?php echo $valor['id']; ?>" name="form_paginacion">
		P&aacute;gina:
		<select class="select-comun" name='p'>
			<?php
			paginacion("SELECT COUNT(id) as total FROM kz_tec_mant_equipos",PERSONAS_MOSTRAR, $_POST['p']);
			?>	
		</select>	
		<input class="bt-accion" type="button" onclick="$('#paginar_<?php echo $valor['id']; ?>').submit();"  name="img_ir" id="img_ir<?php echo $valor['id'];  ?>" value="IR" />

	</form>
	<br />
  <?php }
}
else{
	echo "No hay equipos<br><br>";
}

include('../struct/footer2.php'); ?>

</body>
</html>
