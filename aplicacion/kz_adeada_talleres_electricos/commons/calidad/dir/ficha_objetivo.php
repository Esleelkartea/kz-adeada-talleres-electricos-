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
?>

<script>document.getElementById("lnk_direccion").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_ver_objetivos").setAttribute("class", "seleccionado");</script>

<div id = "link_normal"><img src='../img/iconos/volver.png' id='plus' /> <a class="color_enlaces" href="javascript:" onclick="$('#volver_<?php echo $valor['id']; ?>').submit();">Volver</a></div>
<form action="ver_objetivos.php" method="post" id="volver_<?php echo $valor['id'];?>">
	<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
</form>
<br>

<?php if(isset($_POST['edio_id'])){
  	$objetivo = select_normal("SELECT * FROM kz_tec_dir_objetivos WHERE id = '".$_POST['edio_id']."'");
}
else{
	if(isset($_POST['seg_obj'])){
	  	$objetivo = select_normal("SELECT * FROM kz_tec_dir_objetivos WHERE id = '".$_POST['seg_obj']."'");
	}
	else{
		if(isset($_POST['edio_obj_id'])){
		  	$objetivo = select_normal("SELECT * FROM kz_tec_dir_objetivos WHERE id = '".$_POST['edio_obj_id']."'");
		}
		else{
			$objetivo = select_normal("SELECT * FROM kz_tec_dir_objetivos WHERE id = '".$_POST['id_objetivo']."'");
}}}?>

<div id="cuerpo2">
  <?php if($objetivo)
	foreach($objetivo as $key => $valor){ ?>
	   <div id="objetivo">
	     <table width="100%" border="0" cellspacing="0">
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
	         	<a class="bt-editar" style="cursor:pointer;" onclick="$('#editar_objetivo_<?php echo $valor['id'];  ?>').submit();"></a>
		        
		        <hr class="linea_separacion">
		        <a class="bt-eliminar" style="cursor:pointer;" onclick="if(confirm('Si elimina este objetivo, tambi&eacute;n se borrar&aacute; su seguimiento. &iquest;Continuar?')){ 
		        $('#eliminar_objetivo_<?php echo $valor['id'];  ?>').submit(); }"></a>
		
	         	<form action="editar_objetivo.php" method="post" id="editar_objetivo_<?php echo $valor['id'];?>">
					<input type='hidden' name='id_objetivo' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
				</form>
	         	
	         	<form action='ver_objetivos.php' method='post' id='eliminar_objetivo_<?php echo $valor['id'];  ?>'>
					<input type='hidden' name='eliminar_objetivo' value='<?php echo $valor['id']; ?>'></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
			 	</form>
	         </td>
	       </tr>
	     </table>
	   </div>
	<?php }?>
	   
  <div id="anadir_algo">
   <div id="col1">
     <a class="color_enlaces" href="javascript:" onclick="$('#nuevo_seguimiento_objetivo_<?php echo $valor['id']; ?>').submit();">+ seguimiento</a>
	 <form action="nuevo_seguimiento_objetivo.php" method="post" id="nuevo_seguimiento_objetivo_<?php echo $valor['id'];?>">
		<input type='hidden' name='id_objetivo' value='<?php echo $valor['id'];?>' ></input>
		<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	 </form>
   </div>
   <div id="limpiar"></div>
  </div>
	   
  <?php $seguimientos_objetivo = select_normal("SELECT * FROM kz_tec_dir_seguimientoobjetivos WHERE objetivo = '".$valor['id']."' ORDER BY fecha DESC");
  if($seguimientos_objetivo)
	foreach($seguimientos_objetivo as $key_seg_obj => $valor_seg_obj){?>
	  <div id="seguimiento">
	    <div id="triangulo"><img src="../img/triangulo.png" width="37" height="25" /></div>
		<table width="100%" border="0" cellspacing="0">
	       <tr>
	         <th><p class="linea_blanca">SEGUIMIENTO</p></th>
	       </tr>
	       <tr>
	         <th>Fecha</th>
	         <th>Responsable</th>
	         <th>Datos</th>
	         <th>Grado consecuci&oacute;n</th>
	         <th>Acciones</th>
	       </tr>
	       <tr>
	         <td><?php echo $valor_seg_obj['fecha']; ?></td>
	         <td><?php echo $valor_seg_obj['responsable']; ?></td>
	         <td><?php echo $valor_seg_obj['datos']; ?></td>
	         <?php if($valor_seg_obj['grado_consecucion'] <= '33'){?>
	         	<td class="grado_consecucion_rojo_letra"><?php echo $valor_seg_obj['grado_consecucion']."%"; ?></td>
	         <?php }
	         elseif(($valor_seg_obj['grado_consecucion'] >= '34')&&($valor_seg_obj['grado_consecucion'] <= '66')){?>
	         	<td class="grado_consecucion_ambar_letra"><?php echo $valor_seg_obj['grado_consecucion']."%"; ?></td>
	         <?php }
	         elseif(($valor_seg_obj['grado_consecucion'] >= '67')&&($valor_seg_obj['grado_consecucion'] <= '100')){?>
	         	<td class="grado_consecucion_verde_letra"><?php echo $valor_seg_obj['grado_consecucion']."%"; ?></td>
	         <?php }?>
	         <td>
	         	<a class="bt-editar" style="cursor:pointer;" onclick="$('#editar_seguimiento_objetivo_<?php echo $valor_seg_obj['id'];  ?>').submit();"></a>
		        
		        <hr class="linea_separacion">
		        <a class="bt-eliminar" style="cursor:pointer;" onclick="if(confirm('&iquest;Desea eliminar este seguimiento?')){ 
		        $('#eliminar_segobjetivo_<?php echo $valor_seg_obj['id'];  ?>').submit(); }"></a>
					
	         	<form action="editar_seguimiento_objetivo.php" method="post" id="editar_seguimiento_objetivo_<?php echo $valor_seg_obj['id'];?>">
					<input type='hidden' name='id_seguimiento_objetivo' value='<?php echo $valor_seg_obj['id'];?>' ></input>
					<input type='hidden' name='id_objetivo' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
				</form>
	         	
	         	<form action='ficha_objetivo.php' method='post' id='eliminar_segobjetivo_<?php echo $valor_seg_obj['id'];  ?>'>
					<input type='hidden' name='eliminar_segobjetivo' value='<?php echo $valor_seg_obj['id']; ?>'></input>
					<input type='hidden' name='id_objetivo' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
			 	</form>
	         </td>
	       </tr>
	    </table>
	  </div>
	<?php }?>
</div>

<?php include('../struct/footer2.php'); ?>

</div>

</body>
</html>
