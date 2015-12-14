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
<script>document.getElementById("lnk_ver_reuniones").setAttribute("class", "seleccionado");</script>

<div id = "link_normal"><img src='../img/iconos/volver.png' id='plus' /> <a class="color_enlaces" href="javascript:" onclick="$('#volver_<?php echo $valor['id']; ?>').submit();">Volver</a></div>
<form action="ver_reuniones.php" method="post" id="volver_<?php echo $valor['id'];?>">
	<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
</form>
<br>

<?php if(isset($_POST['modificar_reunion'])){
  	$reunion = select_normal("SELECT * FROM kz_tec_dir_reuniones WHERE id = '".$_POST['modificar_reunion']."'");
}
else{
	if(isset($_POST['tema_reunion'])){
	  	$reunion = select_normal("SELECT * FROM kz_tec_dir_reuniones WHERE id = '".$_POST['tema_reunion']."'");
	}
	else{
		if(isset($_POST['reunion_cerrartema'])){
		  	$reunion = select_normal("SELECT * FROM kz_tec_dir_reuniones WHERE id = '".$_POST['reunion_cerrartema']."'");
		}
		else{
			if(isset($_POST['decision_cerrartema'])){
			  	$reunion = select_normal("SELECT * FROM kz_tec_dir_reuniones WHERE id = '".$_POST['decision_cerrartema']."'");
			}
			else{
				if(isset($_POST['decision_reunion'])){
				  	$reunion = select_normal("SELECT * FROM kz_tec_dir_reuniones WHERE id = '".$_POST['decision_reunion']."'");
				}
				else{
						$reunion = select_normal("SELECT * FROM kz_tec_dir_reuniones WHERE id = '".$_POST['id_reunion']."'");
				}
			}
		}
	}
}?>

<div id="cuerpo2">
  <?php if($reunion)
	foreach($reunion as $key => $valor){ ?>
	   <div id="objetivo">
	     <table width="100%" border="0" cellspacing="0">
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
	         	<a class="bt-editar" style="cursor:pointer;" onclick="$('#editar_reunion_<?php echo $valor['id'];  ?>').submit();"></a>
		        
		        <hr class="linea_separacion">
		        <a class="bt-eliminar" style="cursor:pointer;" onclick="if(confirm('&iquest;Desea eliminar esta reuni&oacute;n?')){ 
		        $('#eliminar_reunion_<?php echo $valor['id'];  ?>').submit(); }"></a>
		
	         	<form action="editar_reunion.php" method="post" id="editar_reunion_<?php echo $valor['id'];?>">
					<input type='hidden' name='id_reunion' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
				</form>
	         	
	         	<form action='ver_reuniones.php' method='post' id='eliminar_reunion_<?php echo $valor['id'];  ?>'>
					<input type='hidden' name='eliminar_reunion' value='<?php echo $valor['id']; ?>'></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
			 	</form>
	         </td>
	       </tr>
	     </table>
	   </div>
	<?php }?>
	
  <form action='pdf_reunion.php' method='post' target='new' id='pdf_reunion'>
  	  <input type='hidden' name='pdf' value='pdf'>
  	  <input type='hidden' name='reunion' value='<?php echo $valor['id']; ?>'>
  	  <input class="bt-accion" type="button" onclick="$('#pdf_reunion').submit();"  name="img_pdf" id="img_pdf" value="PDF" />

  </form>	       
	
  <div id="anadir_algo">
   <div id="col2">
   	 <a class="color_enlaces" href="javascript:" onclick="$('#nueva_decision_<?php echo $valor['id']; ?>').submit();">+ decisi&oacute;n</a>
	 <form action="nueva_decision.php" method="post" id="nueva_decision_<?php echo $valor['id'];?>">
	 	<input type='hidden' name='id_reunion' value='<?php echo $valor['id'];?>' ></input>
	 	<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	 </form>
   </div>
   <div id="col1">
     <a class="color_enlaces" href="javascript:" onclick="$('#nuevo_tema_<?php echo $valor['id']; ?>').submit();">+ orden del d&iacute;a</a>
	 <form action="nuevo_tema.php" method="post" id="nuevo_tema_<?php echo $valor['id'];?>">
		<input type='hidden' name='id_reunion' value='<?php echo $valor['id'];?>' ></input>
		<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	 </form>
   </div>
   <div id="limpiar"></div>
  </div>
  
  <?php $temas_reunion = select_normal("SELECT a.id, a.tema, b.id as idtemareunion, b.idtema, b.cerrado FROM kz_tec_dir_temas a, kz_tec_dir_temasreunion b WHERE b.idreunion = ".$valor['id']." AND a.id=b.idtema");
  if($temas_reunion){?>
	  <div id="seguimiento">
	  	<div id="triangulo"><img src="../img/triangulo.png" width="37" height="25" /></div>
		<table width="100%" border="0" cellspacing="0">
	       <tr>
	         <th><p class="linea_blanca">&Oacute;RDENES DEL DIA</p></th>
	       </tr>
	       <tr>
	         <th>&Oacute;rden del d&iacute;a</th>
	         <th>Cerrado</th>
	         <th colspan=2>Acciones</th>
	       </tr>
	       <?php foreach($temas_reunion as $key_temas => $valor_temas){?>
	         <tr>
	         	<td><?php echo $valor_temas['tema']; ?></td>
	         	<td><?php if(($valor_temas['cerrado'])=='1'){ echo "SI"; }
						else{ echo "NO"; } ?></td>
	         	<td>
		         	<?php if(($valor_temas['cerrado']) == '0'){?>
		         		<a style="cursor:pointer;" onClick="$('#cerrar_tema_<?php echo $valor_temas['id']; ?>').submit();">Cerrar orden del d&iacute;a</a>
		         		<form action='ficha_reunion.php' name='cerrar_tema' method='post' id='cerrar_tema_<?php echo $valor_temas['id']; ?>'>
							<input type='hidden' name='estado_cerrado' id='estado_cerrado' value='1'></input>
							<input type='hidden' name='tema_cerrado' id='tema_cerrado' value='<?php echo $valor_temas['idtemareunion']; ?>'></input>
							<input type='hidden' name='reunion_cerrartema' id='reunion_cerrartema' value='<?php echo $valor['id']; ?>'></input>
							<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
						</form>
					<?php }?>
				</td>
				<td>
					<a class="bt-eliminar" style="cursor:pointer;" onclick="if(confirm('&iquest;Desea eliminar este orden del d&iacute;a?')){ 
		       		$('#eliminar_tema_<?php echo $valor_temas['id'];  ?>').submit(); }"></a>

		         	<form action='ficha_reunion.php' method='post' id='eliminar_tema_<?php echo $valor_temas['id'];  ?>'>
						<input type='hidden' name='eliminar_tema' value='<?php echo $valor_temas['id']; ?>'></input>
						<input type='hidden' name='id_reunion' value='<?php echo $valor['id'];?>' ></input>
						<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
				 	</form>
		         </td>
	         </tr>
	       <?php }?>
	    </table>
	  </div>
  <?php }?>
  
  <?php $decisiones = select_normal("SELECT a.id, a.decision, b.id as iddecisionreunion, b.iddecision, b.cerrado, b.responsable, b.plazo FROM kz_tec_dir_decisiones a, kz_tec_dir_decisionesreunion b WHERE b.idreunion = ".$valor['id']." AND a.id=b.iddecision");
  if($decisiones){?>
	  <div id="metas">
	  	<div id="triangulo"><img src="../img/triangulo.png" width="37" height="25" /></div>
		<table width="100%" border="0" cellspacing="0">
	       <tr>
	         <th><p class="linea_blanca">DECISIONES</p></th>
	       </tr>
	       <tr>
	         <th>Decisi&oacute;n</th>
	         <th>Responsable</th>
	         <th>Plazo</th>
	         <th>Cerrada</th>
	         <th colspan=2>Acciones</th>
	       </tr>
	      <?php foreach($decisiones as $key_decisiones => $valor_decisiones){?>
	       <tr>
	         <td><?php echo $valor_decisiones['decision']; ?></td>
	         <td><?php echo $valor_decisiones['responsable']; ?></td>
	         <td><?php echo $valor_decisiones['plazo']; ?></td>
	         <td><?php if(($valor_decisiones['cerrado'])=='1'){ echo "SI"; }
						else{ echo "NO"; } ?></td>
	         <td>
	         	<?php if(($valor_decisiones['cerrado']) == '0'){?>
	         		<a style="cursor:pointer;" onClick="$('#cerrar_decision_<?php echo $valor_decisiones['id']; ?>').submit();">Cerrar decisi&oacute;n</a>
	         		<form action='ficha_reunion.php' name='cerrar_decision' method='post' id='cerrar_decision_<?php echo $valor_decisiones['id']; ?>'>
						<input type='hidden' name='estado_cerrada' id='estado_cerrada' value='1'></input>
						<input type='hidden' name='decision_cerrada' id='decision_cerrada' value='<?php echo $valor_decisiones['iddecisionreunion']; ?>'></input>
						<input type='hidden' name='decision_cerrartema' id='reunion_cerrartema' value='<?php echo $valor['id']; ?>'></input>
						<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
					</form>
				<?php }?>
			 </td>		
			 <td>
			 	<a class="bt-editar" style="cursor:pointer;" onclick="$('#editar_decision_<?php echo $valor_decisiones['id'];  ?>').submit();"></a>
		        
		        <hr class="linea_separacion">
		        <a class="bt-eliminar" style="cursor:pointer;" onclick="if(confirm('&iquest;Desea eliminar esta decisi&oacute;n?')){ 
		        $('#eliminar_decision_<?php echo $valor_decisiones['id'];  ?>').submit(); }"></a>

	         	<form action='editar_decision.php' method='post' id='editar_decision_<?php echo $valor_decisiones['id'];  ?>'>
					<input type='hidden' name='editar_decision' value='<?php echo $valor_decisiones['id']; ?>'></input>
					<input type='hidden' name='id_decision' value='<?php echo $valor_decisiones['id'];?>' ></input>
					<input type='hidden' name='id_reunion' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
			 	</form>
	         
	         	<form action='ficha_reunion.php' method='post' id='eliminar_decision_<?php echo $valor_decisiones['id'];  ?>'>
					<input type='hidden' name='eliminar_decision' value='<?php echo $valor_decisiones['id']; ?>'></input>
					<input type='hidden' name='id_reunion' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
			 	</form>
	         </td>
	       </tr>
	      <?php }?>
		</table>
	  </div>
  <?php }?>
</div>

<?php include('../struct/footer2.php'); ?>

</div>

</body>
</html>
