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

$ARRAY_DOC = array_num_doc();

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

<script>document.getElementById("lnk_documentacion").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_ver_procedimientos").setAttribute("class", "seleccionado");</script>

<div id = "link_normal"><a class="bt-nuevo-documento" href="nuevo_procedimiento.php">Nuevo procedimiento</a></div>
<br><br>

<?php if($_POST['criterios']){
	if($_POST['buscar_por'] == 'todos'){
		$criterios = " AND objeto LIKE '%".$_POST['criterios']."%' OR alcance LIKE '%".$_POST['criterios']."%' OR responsabilidades LIKE '%".$_POST['criterios']."%'";	
	}
	else{
		$criterios = " AND ".$_POST['buscar_por']." LIKE '%".$_POST['criterios']."%'";
	}
	$procedimiento = select_normal("SELECT * FROM kz_tec_doc_procedimientos WHERE 1 = 1 $criterios");
}
else{
	unset($_POST['criterios']);
	$procedimiento = select_normal("SELECT a.id, a.iddoc, b.nombre FROM kz_tec_doc_procedimientos a, kz_tec_doc_documentos b, kz_tec_doc_revisiones c WHERE a.iddoc = b.id AND a.idrev = c.rev AND b.id = c.iddoc AND c.vigor = '1' LIMIT $limiteinf, $limitesup");
}

if($procedimiento){
  foreach($procedimiento as $key => $valor){ ?>

	<div id="cuerpo2">
	   	<div id="objetivo">
	     <table width="100%" border="1" cellspacing="0">
	       <tr>
	         <th>Cod. Documento</th>
	         <th>Nombre Documento</th>
	         <th>Acciones</th>
	       </tr>
	       <tr>
	        <td><?php echo $ARRAY_DOC[$valor['iddoc']]; ?></td>
	        <td><?php echo $valor['nombre']; ?></td>
	         <td>
	         	<a class="bt-editar" style="cursor:pointer; font-weight:bold;" onclick="$('#editar_procedimiento_<?php echo $valor['id'];  ?>').submit();"></a>
		        
		        <hr class="linea_separacion">
		        <a class="bt-eliminar" style="cursor:pointer; font-weight:bold;" onclick="if(confirm('&iquest;Desea eliminar este procedimiento?')){ 
		        $('#eliminar_procedimiento_<?php echo $valor['id'];  ?>').submit(); }"></a>
	         	
	         	<form action="editar_procedimiento.php" method="post" id="editar_procedimiento_<?php echo $valor['id'];?>">
					<input type='hidden' name='id_procedimiento' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
					<input type='hidden' name='buscar_por' value='<?php echo $_POST['buscar_por']; ?>'></input>
		  			<input type='hidden' name='criterios' value='<?php echo $_POST['criterios']; ?>'></input>
				</form>
	         	
	         	<form action='ver_procedimientos.php' method='post' id='eliminar_procedimiento_<?php echo $valor['id'];  ?>'>
					<input type='hidden' name='eliminar_procedimiento' value='<?php echo $valor['id']; ?>'></input>
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
	<form action='ver_procedimientos.php' method='POST' id="paginar_<?php echo $valor['id']; ?>" name="form_paginacion">
		P&aacute;gina:
		<select class="select-comun" name='p'>
			<?php
			paginacion("SELECT COUNT(id) as total FROM kz_tec_doc_procedimientos",PERSONAS_MOSTRAR, $_POST['p']);
			?>	
		</select>	
		<input class="bt-accion" type="button" onclick="$('#paginar_<?php echo $valor['id']; ?>').submit();"  name="img_ir" id="img_ir<?php echo $valor['id'];  ?>" value="IR" />

	</form>
	<br>
  <?php }
}
else{
	echo "No hay procedimientos<br><br>";
}

include('../struct/footer2.php'); ?>

</body>
</html>
