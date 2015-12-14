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
<script>document.getElementById("lnk_ver_objetivos").setAttribute("class", "seleccionado");</script>

<div id = "link_normal"><a class="bt-nuevo-documento" href="nuevo_objetivo.php">Nuevo objetivo</a></div>

<div style='text-align:right;'>
	<form action='ver_objetivos.php' method='POST' id="buscar_<?php echo $valor['id']; ?>" name="form_buscar">
		Buscar por campo:
		<select class="select-comun" name='buscar_por' id='buscar_por'>
			<option value='todos'>TODOS</option>
			<option value='objetivo'>Objetivo</option>
			<option value='fechacreacion'>Fecha creaci&oacute;n</option>
			<option value='anno'>A&ntilde;o</option>
			<option value='descripcion'>Descripci&oacute;n</option>
			<option value='responsable'>Responsable</option>
			<option value='plazoconsecucion'>Plazo</option>
		</select>
		<input class="input-comun" type='text' name='criterios' value=''></input>
		<input class="bt-accion" type="button" onclick="$('#buscar_<?php echo $valor['id']; ?>').submit();" name="img_buscar" id="img_buscar<?php echo $valor['id'];  ?>" value="Buscar" />
          
		<input class="bt-accion" type="button" onclick="$('#mostrar_todos_<?php echo $valor['id']; ?>').submit();" name="img_mostrar_todos" id="img_mostrar_todos<?php echo $valor['id'];  ?>" value="Mostrar todos" />

	</form>	
	
	<form action='ver_objetivos.php' method='post' id='mostrar_todos_<?php echo $valor['id']; ?>'>
	</form>
</div>
<br />
<?php if($_POST['criterios']){
	if($_POST['buscar_por'] == 'todos'){
		$criterios = " AND objetivo LIKE '%".$_POST['criterios']."%' OR fechacreacion LIKE '%".$_POST['criterios']."%' OR anno LIKE '%".$_POST['criterios']."%' OR descripcion LIKE '%".$_POST['criterios']."%' OR responsable  LIKE '%".$_POST['criterios']."%' OR plazoconsecucion  LIKE '%".$_POST['criterios']."%'";
	}
	else{
		$criterios = " AND ".$_POST['buscar_por']." LIKE '%".$_POST['criterios']."%'";
	}
	$objetivos = select_normal("SELECT * FROM kz_tec_dir_objetivos WHERE 1 = 1 $criterios ORDER BY fechacreacion DESC");
} 
else{
	unset($_POST['criterios']);
	$objetivos = select_normal("SELECT * FROM kz_tec_dir_objetivos ORDER BY fechacreacion DESC LIMIT $limiteinf, $limitesup");
}

if($objetivos){
  foreach($objetivos as $key => $valor){ ?>

	<div id="abrir">
		<a class="color_enlaces" href="javascript:" onclick="$('#form_abrir_<?php echo $valor['id']; ?>').submit();">abrir</a>
		<form action="ficha_objetivo.php" method="post" id="form_abrir_<?php echo $valor['id'];?>">
			<input type='hidden' name='id_objetivo' value='<?php echo $valor['id'];?>' ></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
		</form>
	</div>	

	<div id="cuerpo2">
		<div id="limpiar"></div>
	   	<div id="objetivo">
	     <table width="100%" border="1" cellspacing="0">
	       <tr>
	         <th>Objetivo</th>
	         <th>Fecha creaci&oacute;n</th>
	         <th>A&ntilde;o</th>
	         <th>Descripci&oacute;n</th>
	         <th>Responsable</th>
	         <th>Periodicidad</th>
	         <th>Plazo</th>
	         <th>Cumplido</th>
	         <th>Acciones</th>
	       </tr>
	       <tr>
	         <td><?php echo $valor['objetivo']; ?></td>
	         <td><?php echo $valor['fechacreacion']; ?></td>
	         <td><?php echo $valor['anno']; ?></td>
	         <td><?php echo $valor['descripcion']; ?></td>
	         <td><?php echo $valor['responsable']; ?></td>
	         <td>Cada <?php echo $valor['periodicidad']; ?> d&iacute;as</td>
	         <td><?php echo $valor['plazoconsecucion']; ?></td>
	         <td><?php if(($valor['cumplido'])=='1'){ echo "SI"; }
						else{ echo "NO"; } ?></td>
	         <td>
	         	<a class="bt-eliminar" style="cursor:pointer;" onclick="if(confirm('Si elimina este objetivo, tambi&eacute;n se borrar&aacute; su seguimiento. &iquest;Continuar?')){ 
		        $('#eliminar_objetivo_<?php echo $valor['id'];  ?>').submit(); }"></a>

	         	<form action='ver_objetivos.php' method='post' id='eliminar_objetivo_<?php echo $valor['id'];  ?>'>
					<input type='hidden' name='eliminar_objetivo' value='<?php echo $valor['id']; ?>'></input>
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
	<form action='ver_objetivos.php' method='POST' id="paginar_<?php echo $valor['id']; ?>" name="form_paginacion">
		P&aacute;gina:
		<select class="select-comun" name='p'>
			<?php
			paginacion("SELECT COUNT(id) as total FROM kz_tec_dir_objetivos",PERSONAS_MOSTRAR, $_POST['p']);
			?>	
		</select>	
		<input class="bt-accion" type="button" onclick="$('#paginar_<?php echo $valor['id']; ?>').submit();"  name="img_ir" id="img_ir<?php echo $valor['id'];  ?>" value="IR" />

	</form>
	<br>
  <?php }
}
else{
	echo "No hay objetivos<br><br>";
}

include('../struct/footer2.php'); ?>

</body>
</html>
