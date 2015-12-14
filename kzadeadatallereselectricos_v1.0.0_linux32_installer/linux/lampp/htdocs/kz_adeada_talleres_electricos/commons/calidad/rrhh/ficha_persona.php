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
?>

<script>document.getElementById("lnk_rrhh").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_ver_personal").setAttribute("class", "seleccionado");</script>

<div id = "link_normal"><img src='../img/iconos/volver.png' id='plus' /> <a class="color_enlaces" href="javascript:" onclick="$('#volver_<?php echo $valor['id']; ?>').submit();">Volver</a></div>
<form action="ver_personal.php" method="post" id="volver_<?php echo $valor['id'];?>">
	<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
</form>
<br>

<?php if(isset($_POST['editar_persona'])){
	$persona = select_normal("SELECT * FROM kz_tec_rrhh_personal WHERE id = '".$_POST['editar_persona']."'");
}
else{
	if(isset($_POST['persona'])){
		$persona = select_normal("SELECT * FROM kz_tec_rrhh_personal WHERE id = '".$_POST['persona']."'");
	}
	else{
		$persona = select_normal("SELECT * FROM kz_tec_rrhh_personal WHERE id = '".$_POST['id_persona']."'");
	}
}?>

<div id="cuerpo2">
  <?php if($persona)
	foreach($persona as $key => $valor){ ?>
	   <div id="objetivo">
	     <table width="100%" border="0" cellspacing="0">
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
	         	<a class="bt-editar" style="cursor:pointer;" onclick="$('#editar_persona_<?php echo $valor['id'];  ?>').submit();"></a>
		        
		        <hr class="linea_separacion">
		        <a class="bt-eliminar" style="cursor:pointer;" onclick="if(confirm('Si elimina este registro se borrar&aacute;n tambi&eacute;n todas sus valoraciones. &iquest;Continuar?')){ 
		        $('#eliminar_persona_<?php echo $valor['id'];  ?>').submit(); }"></a>
	
	         	<form action="editar_persona.php" method="post" id="editar_persona_<?php echo $valor['id'];?>">
					<input type='hidden' name='id_persona' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
				</form>
	         	
	         	<form action='ver_personal.php' method='post' id='eliminar_persona_<?php echo $valor['id'];  ?>'>
					<input type='hidden' name='eliminar_personal' value='<?php echo $valor['id']; ?>'></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
			 	</form>
	         </td>
	       </tr>
	     </table>
	   </div>
	<?php }?>
  
  <div id="seguimiento">
  	<div id="triangulo"><img src="../img/triangulo.png" width="37" height="25" /></div>
  	<form action='ficha_persona.php' method='post' id='guardar_cursos_<?php echo $valor['id']; ?>'>
  		<input type='hidden' name='modificar_valoraciones_comentario' value='modificar_valoraciones_comentario'></input>
		<input type='hidden' name='persona' value='<?php echo $valor['id']; ?>'></input>
		<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
		<table width="100%" border="0" cellspacing="0">
	       <tr>
	         <th><p class="linea_blanca">FORMACION</p></th>
	       </tr>
	       <?php $cursos_asistidos = select_normal("SELECT a.id, a.curso, a.valoracion, a.comentarios, a.fecha, b.ano, b.accionformativa FROM kz_tec_rrhh_asistentesformacion a, kz_tec_rrhh_accformativa b WHERE a.persona = ".$valor['id']." AND a.curso = b.id ORDER BY b.ano");
   		   if($cursos_asistidos){
     		 foreach($cursos_asistidos as $key_cursos => $valor_cursos){?>
		       <tr>
		       	 <td>
		       	 	<input type='hidden' name='idv_<?php echo $valor_cursos['id'];?>' value='<?php echo $valor_cursos['id'];?>' id='<?php echo $valor_cursos['id']; ?>'></input>
		       	 	<input type='hidden' name='curso_<?php echo $valor_cursos['id'];?>' value='<?php echo $valor_cursos['curso'];?>' id='<?php echo $valor_cursos['curso']; ?>'></input>
					<div id="cuerpo2">
					   	<div id="seguimiento">
					     <table width="100%" border="1" cellspacing="0">
					       <tr>
					         <th style='background-color:lightgrey;'>Curso</th>
					         <th style='background-color:lightgrey;'>Valoraci&oacute;n</th>
					         <th style='background-color:lightgrey;'>Fecha</th>
					       </tr>
						   <tr>
						      <td><?php echo $valor_cursos['accionformativa']; ?> <?php echo "(".$valor_cursos['ano'].")"; ?></td>
						      <td>
								<select name="valoracion_<?php echo $valor_cursos['id'];?>" id="valoracion" >
				         			<?php combo_base_array(array('VALIDO', 'REGULAR', 'NO VALIDO') ,$valor_cursos['valoracion']);?>
				      			</select>
				      			<br>
				      			<textarea name='detvaloracion_<?php echo $valor_cursos['id'];?>' rows=2 cols=46><?php echo $valor_cursos['comentarios']; ?></textarea>
			      			  </td>
			      			  <td><input type='text' value='<?php echo $valor_cursos['fecha']; ?>' size='14' name='fecha_<?php echo $valor_cursos['id'];?>' id='fecha_<?php echo $valor_cursos['id']; ?>'>
							 		<img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal_<?php echo $valor_cursos['id']; ?>'>
									<script>
									   Calendar.setup({
									       trigger    : "cal_<?php echo $valor_cursos['id']; ?>",
									       inputField : "fecha_<?php echo $valor_cursos['id']; ?>"
										});
							 		</script>
			 				  </td>
						   </tr>
					     </table>
					   	</div>
					</div>
				 </td>
			   </tr>
		     <?php }?>
		     <tr>
		   	 	<td>
		   	 	<input class="boton" type="button" onclick="$('#guardar_cursos_<?php echo $valor['id']; ?>').submit();"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
				</td>
		     </tr>
		   <?php }
		   else{?>
		   		<tr><td><?php echo "<i>No hay cursos</i>";?></td></tr>
		   <?php }?>
		</table>
    </form>
  </div>
</div>

<?php include('../struct/footer2.php'); ?>

</div>

</body>
</html>