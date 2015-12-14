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
?>
 <div id="menu_principal">
	<ul>
		<li><a <?php if($_GET['menu']=="administracion_proyectos"){echo "class='seleccionado'";}?> href="index.php?menu=administracion_proyectos">Administraci&oacute;n de trabajos</a></li>
		<li><a <?php if($_GET['menu']=="administracion_partes"){echo "class='seleccionado'";}?> href="index.php?menu=administracion_partes">Administraci&oacute;n de partes</a></li>
		<li><a <?php if($_GET['menu']=="informes"){echo "class='seleccionado'";}?> href="index.php?menu=informes">Informes</a></li>
		<li><a <?php if($_GET['menu']=="planificacion"){echo "class='seleccionado'";}?> href="index.php?menu=planificacion">Planificaci&oacute;n</a></li>
		<?php if(in_array(221,$datos_perfil['PERMISOS'])){?>
			<li><a <?php if($_GET['menu']=="calidad"){echo "class='seleccionado'";}?> href="index.php?menu=calidad">Calidad</a></li>
		<?php }?>
	</ul>
</div>

<?php 
	if($_GET['menu']){
		switch($_GET['menu']){
			case "administracion_proyectos":?>
				<div id="submenu">
					<ul>
					<?php 
					$datos_perfil = recoger_accesos_2($_SESSION[APLICACION_.'perfil'],$_COOKIE['gisper_sistema'],'1');
				      if($datos_perfil && $cancelar_menu != 1){
						foreach($datos_perfil['MENU'] as $nombre_seccion => $opcionmenu){
						  foreach($opcionmenu as $key => $acceso){
						  	$acceso_r = str_replace(" ", "_", $acceso['acc_nombre']); ?>
						  	<li>
								<form action='index.php?menu=administracion_proyectos' method='post' id='acceso_<?php echo $acceso_r; ?>'>
								  <a style="cursor:pointer;" onclick="$('acceso_<?php echo $acceso_r; ?>').submit();" <?php if($acceso['acc_ruta']==$_POST['pag']){echo "class='seleccionado'";}?>><?php echo $acceso['acc_nombre']; ?></a>
								  <input type='hidden' name='pag' value='<?php echo $acceso['acc_ruta']; ?>' />
								</form>	  
							</li>
						  <?php }
						}
					  } 
					?>
					</ul>
				</div>
			<?php break;
		case "administracion_partes":?>
			<div id="submenu">
				<ul>
				<?php $datos_perfil = recoger_accesos_2($_SESSION[APLICACION_.'perfil'],$_COOKIE['gisper_sistema'],'2');
			      if($datos_perfil && $cancelar_menu != 1){
					foreach($datos_perfil['MENU'] as $nombre_seccion => $opcionmenu){
					  foreach($opcionmenu as $key => $acceso){
					    $acceso_r = str_replace(" ", "_", $acceso['acc_nombre']); ?>
					    <li>
							<form action='index.php?menu=administracion_partes' method='post' id='acceso_2_<?php echo $acceso_r; ?>'>
							  <a style="cursor:pointer;" onclick="$('acceso_2_<?php echo $acceso_r; ?>').submit();" <?php if($acceso['acc_ruta']==$_POST['pag']){echo "class='seleccionado'";}?>><?php echo $acceso['acc_nombre']; ?></a>
							  <input type='hidden' name='pag' value='<?php echo $acceso['acc_ruta']; ?>'>
							</form>	  
						</li>
					  <?php }
					}
				  } ?>
				</ul>
			</div>
		<?php break;
		case "informes":?>
			<div id="submenu">
				<ul>
			  		<?php $datos_perfil = recoger_accesos_2($_SESSION[APLICACION_.'perfil'],$_COOKIE['gisper_sistema'],'3');
				      if($datos_perfil && $cancelar_menu != 1){
						foreach($datos_perfil['MENU'] as $nombre_seccion => $opcionmenu){
						  foreach($opcionmenu as $key => $acceso){
						    $acceso_r = str_replace(" ", "_", $acceso['acc_nombre']); ?>
						    <li>
								<form action='index.php?menu=informes' method='post' id='acceso_3_<?php echo $acceso_r; ?>'>
								  <a style="cursor:pointer;" onclick="$('acceso_3_<?php echo $acceso_r; ?>').submit();" <?php if($acceso['acc_ruta']==$_POST['pag']){echo "class='seleccionado'";}?>><?php echo $acceso['acc_nombre']; ?></a>
								  <input type='hidden' name='pag' value='<?php echo $acceso['acc_ruta']; ?>'>
								</form>	  
							</li>
						  <?php }
						}
					  } ?>
				</ul>
			</div>
		<?php break;
		case "planificacion":?>
			<div id="submenu">
				<ul>
			  		 <?php $datos_perfil = recoger_accesos_2($_SESSION[APLICACION_.'perfil'],$_COOKIE['gisper_sistema'],'5');
				      if($datos_perfil && $cancelar_menu != 1){
						foreach($datos_perfil['MENU'] as $nombre_seccion => $opcionmenu){
						  foreach($opcionmenu as $key => $acceso){
						    $acceso_r = str_replace(" ", "_", $acceso['acc_nombre']); ?>
						    <li>
								<form action='index.php?menu=planificacion' method='post' id='acceso_5_<?php echo $acceso_r; ?>'>
								  <a style="cursor:pointer;" onclick="$('acceso_5_<?php echo $acceso_r; ?>').submit();" <?php if($acceso['acc_ruta']==$_POST['pag']){echo "class='seleccionado'";}?>><?php echo $acceso['acc_nombre']; ?></a>
								  <input type='hidden' name='pag' value='<?php echo $acceso['acc_ruta']; ?>'>
								</form>	  
							</li>
						  <?php }
						}
					  } ?>
				</ul>
			</div>
		<?php break;
		case "calidad":?>
			<div id="submenu">
				<ul>
			  		 <?php $datos_perfil = recoger_accesos_2($_SESSION[APLICACION_.'perfil'],$_COOKIE['gisper_sistema'],'6');
				      if($datos_perfil && $cancelar_menu != 1){
						foreach($datos_perfil['MENU'] as $nombre_seccion => $opcionmenu){
						  foreach($opcionmenu as $key => $acceso){
						    $acceso_r = str_replace(" ", "_", $acceso['acc_nombre']); ?>
						    <li>
								<a href="../commons/calidad/welcome.php">Calidad</a>
							</li>
						  <?php }
						}
					  } ?>
				</ul>
			</div>
		<?php break;
		}
	}
?>
<div id="contenido">

	
	
	
	
