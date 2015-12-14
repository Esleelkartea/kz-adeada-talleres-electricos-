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
?>

<script>document.getElementById("lnk_mantenimiento").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_ver_equipos").setAttribute("class", "seleccionado");</script>

<div id = "link_normal"><img src='../img/iconos/volver.png' id='plus' /> <a class="color_enlaces" href="javascript:" onclick="$('#volver_<?php echo $valor['id']; ?>').submit();">Volver</a></div>
<form action="ver_equipos.php" method="post" id="volver_<?php echo $valor['id'];?>">
	<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
</form>
<br>

<?php if(isset($_POST['modificar_equipo'])){
	$equipo = select_normal("SELECT * FROM kz_tec_mant_equipos WHERE id = '".$_POST['modificar_equipo']."'");
}
else{
	if(isset($_POST['pauta_equipo'])){
		$equipo = select_normal("SELECT * FROM kz_tec_mant_equipos WHERE id = '".$_POST['pauta_equipo']."'");
	}
	else{
		if(isset($_POST['edie_pauta'])){
			$equipo = select_normal("SELECT * FROM kz_tec_mant_equipos WHERE id = '".$_POST['edie_pauta']."'");
		}
		else{
			if(isset($_POST['edie_correctivo'])){
				$equipo = select_normal("SELECT * FROM kz_tec_mant_equipos WHERE id = '".$_POST['edie_correctivo']."'");
			}
			else{
				$equipo = select_normal("SELECT * FROM kz_tec_mant_equipos WHERE id = '".$_POST['id_equipo']."'");
			}
		}
	}
}?>

<div id="cuerpo2">
  <?php if($equipo)
	foreach($equipo as $key => $valor){ ?>
	   <div id="objetivo">
	     <table width="100%" border="0" cellspacing="0">
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
	         	<a class="bt-editar" style="cursor:pointer;" onclick="$('#editar_equipo_<?php echo $valor['id'];  ?>').submit();"></a>
		        
		        <hr class="linea_separacion">
		        <a class="bt-eliminar" style="cursor:pointer;" onclick="if(confirm('Si elimina este equipo, tambi&eacute;n se borrar&aacute; su plan de mantenimiento. &iquest;Desea continuar?')){ 
		        $('#eliminar_equipo_<?php echo $valor['id'];  ?>').submit(); }"></a>
		
	         	<form action="editar_equipo.php" method="post" id="editar_equipo_<?php echo $valor['id'];?>">
					<input type='hidden' name='id_equipo' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
				</form>
	         	
	         	<form action='ver_equipos.php' method='post' id='eliminar_equipo_<?php echo $valor['id'];  ?>'>
					<input type='hidden' name='eliminar_equipo' value='<?php echo $valor['id']; ?>'></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
			 	</form>
	         </td>
	       </tr>
	     </table>
	   </div>
	<?php }?>
	
  <div id="anadir_algo">
     <div id="col2">
      <a class="color_enlaces" href="javascript:" onclick="$('#nuevo_correctivo_<?php echo $valor['id']; ?>').submit();">+ correctivo</a>
   <form action="nuevo_correctivo.php" method="post" id="nuevo_correctivo_<?php echo $valor['id'];?>">
 	  <input type='hidden' name='id_equipo' value='<?php echo $valor['id'];?>' ></input>
 	  <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
   </form>
     </div>
     <div id="col1">
       <a class="color_enlaces" href="javascript:" onclick="$('#nueva_pauta_<?php echo $valor['id']; ?>').submit();">+ pauta</a>
   <form action="nueva_pauta.php" method="post" id="nueva_pauta_<?php echo $valor['id'];?>">
  	<input type='hidden' name='id_equipo' value='<?php echo $valor['id'];?>' ></input>
  	<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
   </form>
     </div>
     <div id="limpiar"></div>
  </div>

  <?php $pautas = select_normal("SELECT * FROM kz_tec_mant_pautas WHERE equipo = '".$valor['id']."' ORDER BY fechainicio DESC");
  if($pautas){?>
	  <div id="seguimiento">
	  	<div id="triangulo"><img src="../img/triangulo.png" width="37" height="25" /></div>
		<table width="100%" border="0" cellspacing="0">
	       <tr>
	         <th><p class="linea_blanca">PAUTAS DE MANTENIMIENTO</p></th>
	       </tr>
	       <tr>
	         <th>Descripci&oacute;n</th>
	         <th>Periodo</th>
	         <th>Responsable</th>
	         <th>Tiempo estimado</th>
	         <th>Euros</th>
	         <th>Inicio</th>
	         <th>Fin</th>
	         <th>Acciones</th>
	       </tr>
	      <?php foreach($pautas as $key_pauta => $valor_pauta){?>
	       <tr>
	         <td><?php echo $valor_pauta['descripcion']; ?></td>
	         <td>Cada <?php echo $valor_pauta['periodicidad']; ?> d&iacute;as</td>
	         <td><?php echo $valor_pauta['responsable']; ?></td>
	         <td><?php echo $valor_pauta['tiempoestimado']; ?> horas</td>
	         <td><?php echo $valor_pauta['euros']; ?></td>
	         <td><?php echo $valor_pauta['fechainicio']; ?></td>
	         <td><?php echo $valor_pauta['fechafin']; ?></td>
			 <td>
			 	<a class="bt-editar" style="cursor:pointer;" onclick="$('#editar_pauta_<?php echo $valor_pauta['id'];  ?>').submit();"></a>
		        
		        <hr class="linea_separacion">
		        <a class="bt-eliminar" style="cursor:pointer;" onclick="if(confirm('&iquest;Desea eliminar esta pauta?')){ 
		        $('#eliminar_pauta_<?php echo $valor_pauta['id'];  ?>').submit(); }"></a>
		
	         	<form action="editar_pauta.php" method="post" id="editar_pauta_<?php echo $valor_pauta['id'];?>">
					<input type='hidden' name='id_pauta' value='<?php echo $valor_pauta['id'];?>' ></input>
					<input type='hidden' name='id_equipo' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
				</form>
	         							
	         	<form action='ficha_equipo.php' method='post' id='eliminar_pauta_<?php echo $valor_pauta['id'];  ?>'>
					<input type='hidden' name='eliminar_pauta' value='<?php echo $valor_pauta['id']; ?>'></input>
					<input type='hidden' name='id_equipo' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
			 	</form>
	         </td>
	       </tr>
	      <?php }?>
	    </table>
	  </div>
  <?php }?>

  <?php $correctivos = select_normal("SELECT * FROM kz_tec_mant_correctivo WHERE equipo = '".$valor['id']."' ORDER BY fecha_mant DESC");
  if($correctivos){?>
	  <div id="metas">
	  	<div id="triangulo"><img src="../img/triangulo.png" width="37" height="25" /></div>
		<table width="100%" border="0" cellspacing="0">
	       <tr>
	         <th><p class="linea_blanca">MANTENIMIENTO CORRECTIVO</p></th>
	       </tr>
	       <tr>
	         <th>Fecha</th>
	         <th>Euros</th>
	         <th>Observaciones</th>
	         <th>Materiales</th>
	         <th>Horas</th>
	         <th>Acciones</th>
	       </tr>
	      <?php foreach($correctivos as $key_correctivo => $valor_correctivo){?>
	       <tr>
	         <td><?php echo $valor_correctivo['fecha_mant']; ?></td>
	         <td><?php echo $valor_correctivo['euros']; ?></td>
	         <td><?php echo $valor_correctivo['observaciones']; ?></td>
	         <td><?php echo $valor_correctivo['materiales']; ?></td>
	         <td><?php echo $valor_correctivo['horas']; ?></td>
	         <td>
	         	<a class="bt-editar" style="cursor:pointer;" onclick="$('#editar_correctivo_<?php echo $valor_correctivo['id'];  ?>').submit();"></a>
		        
		        <hr class="linea_separacion">
		        <a class="bt-eliminar" style="cursor:pointer;" onclick="if(confirm('&iquest;Desea eliminar este mantenimiento correctivo?')){ 
		        $('#eliminar_correctivo_<?php echo $valor_correctivo['id'];  ?>').submit(); }"></a>

	         	<form action="editar_correctivo.php" method="post" id="editar_correctivo_<?php echo $valor_correctivo['id'];?>">
					<input type='hidden' name='id_correctivo' value='<?php echo $valor_correctivo['id'];?>' ></input>
					<input type='hidden' name='id_equipo' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
				</form>
	         
	         	<form action='ficha_equipo.php' method='post' id='eliminar_correctivo_<?php echo $valor_correctivo['id'];  ?>'>
					<input type='hidden' name='eliminar_correctivo' value='<?php echo $valor_correctivo['id']; ?>'></input>
					<input type='hidden' name='id_equipo' value='<?php echo $valor['id'];?>' ></input>
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
