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
<div id="cuerpo">
  <div id="contenido">
	<h1>Personal</h1>

	<?php 
	
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
	
	if($_POST['anadir_personal']){
		if($_POST['nombre']){
		
			$link = conectar($_SESSION[APLICACION_."gisper_bbdd"]);
			$comprobar_persona = select_normal("SELECT nombre, apellidos FROM kz_te_personal WHERE nombre='".$_POST['nombre']."' AND apellidos='".$_POST['apellidos']."'");
		
			if($_POST['crear_usuario']){
				$comprobar_usuario = select_normal("Select id from kz_te_usuarios where usuario = '".$_POST['nombre_usuario']."'");
			}
			
			//------------- INICIO USUARIO
			if($_POST['crear_usuario']){
				if(($comprobar_usuario == '') && ($comprobar_persona == '')){
					if($_POST['pass_usuario']){
						$clave = $_POST['pass_usuario'];
					}
					else{
						$clave=generar_contrasena();
					}
					if($_POST['nombre_usuario']){
						$usuario = $_POST['nombre_usuario'];
					}
					else{
						$usuario = $_POST['nombre'];
					}
					
					$crear_usuario = ejecutar_query("INSERT INTO kz_te_usuarios VALUES(null, '".$_POST['nombre']." ".$_POST['apellidos']."', '".$usuario."', '".md5($clave)."', '".$_POST['email']."', '".$_POST['perfil']."')");
					$mensaje .=  "<hr>*El usuario asignado a ".$_POST['nombre']." ".$_POST['apellidos']." es <b>".$usuario."</b> con la contrase&ntilde;a <b>$clave</b>";
					$ucorrecto = 0;
				}
				else {
					$ucorrecto = 1;
					$_POST['seleccion_formulario'] = 'anadir_personal';
				}
			}
			else { $ucorrecto = 0; }
			// ------------- FIN USUARIO
			
			if(($comprobar_persona == '') && ($ucorrecto == 0)){
				$insertar_persona = ejecutar_query("INSERT INTO kz_te_personal VALUES(null, '".$_POST['nombre']."', '".$_POST['apellidos']."', '".$_POST['funcion']."', '".$_POST['telefono']."', '".$_POST['email']."', '".$crear_usuario."')");
				$mensaje .=  "<br><hr>Se ha a&ntilde;adido el nuevo registro<hr>";
				$upersona = 0;
			}
			else{
				$upersona = 1;	
				$_POST['seleccion_formulario'] = 'anadir_personal';
			}
			
			if ($upersona == 1 || $ucorrecto == 1){
				$mensaje .=  "<hr>ERROR. Compruebe que la persona o el usuario no existan<hr>";
			}
		}
		else{
			$mensaje .=  "<hr>ERROR. No has introducido el nombre<hr>";
		}
	}
	
	if($_POST['editar_personal']){
		if($_POST['nombre']){
			$editar_persona = ejecutar_query("UPDATE kz_te_personal SET
			nombre = '".$_POST['nombre']."',
			apellidos = '".$_POST['apellidos']."',
			funcion = '".$_POST['funcion']."',
			telefono = '".$_POST['telefono']."',
			email = '".$_POST['email']."'
			where id = ".$_POST['id']."");
			
			if($_POST['editar_usuario']){
				if($_POST['pass_usuario']){
					$clave = $_POST['pass_usuario'];
				}
				else{
					$clave=generar_contrasena();
				}

				$editar_usuario = ejecutar_query("UPDATE kz_te_usuarios SET
				clave = '".md5($clave)."',
				perfil = ".$_POST['perfil']."
				WHERE id = ".$_POST['usuario']."");
				
				$mensaje .=  "<hr>*La nueva contrase&ntilde;a asignada a ".$_POST['nombre']." ".$_POST['apellidos']." es: <b>".$clave."</b>";
			}
			$mensaje .=  "<hr>Se ha editado el registro<hr>";
		}
		else{
			$mensaje .=  "<hr>ERROR. No has introducido el nombre<hr>";
		}
	}
	
	if($_POST['eliminar_personal']){
		$eliminar_usuario = ejecutar_query("DELETE FROM kz_te_usuarios WHERE id = ".$_POST['usuario']."");
		$eliminar_persona = ejecutar_query("DELETE FROM kz_te_personal WHERE id = ".$_POST['id']."");
	
		$mensaje .=  "<hr>Se ha eliminado el registro<hr>";
	}
	
	?><div class='mensaje'><?php  echo $mensaje; ?></div><?php 
	switch ($_POST['seleccion_formulario']){
		case 'anadir_personal':
			include("../commons/proyectos_clientes/personal/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		case 'editar_personal':
			include("../commons/proyectos_clientes/personal/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		case 'eliminar_personal':
			include("../commons/proyectos_clientes/personal/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		case 'ver_ficha':
			include("../commons/proyectos_clientes/personal/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		default:
	
			if($_POST['buscar_personal']=='Buscar'){
				$criterios1 = " AND nombre LIKE '%".$_POST['criterios']."%' or apellidos LIKE '%".$_POST['criterios']."%' or funcion LIKE '%".$_POST['criterios']."%'";
			}
			else unset($_POST['criterios']);
			
			//VARIABLES DE ORDEN
			if(!$_POST['orden']){ $_POST['orden'] ='apellidos'; $_POST['orden2'] = 'asc';}
	
			$personal = select_normal("SELECT * FROM kz_te_personal WHERE 1 = 1 $criterios1 ORDER BY ".$_POST['orden']." ".$_POST['orden2']." LIMIT $limiteinf, $limitesup");
			?>
			
			<br>
			<form action='index.php?menu=administracion_proyectos' method='post'>
				<input type='text' name='criterios' value='<?php echo $_POST['criterios']; ?>'></input>
				<input class="bt-accion" type='submit' name='buscar_personal' value='Buscar'>
				<input class="bt-accion" type='submit' name='buscar_personal' value='Mostrar todos'></input>
				<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
			</form>
			<br>
			
			<form action='index.php?menu=administracion_proyectos' method='post'>
				<input class="bt-nuevo-documento" type='submit' name='accion' value='A&ntilde;adir personal'>
				<input type='hidden' name='seleccion_formulario' value='anadir_personal'>
				<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
			</form>
			
			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>Funci&oacute;n</th>
					<th>Tel&eacute;fono</th>
					<th>Email</th>
					<th>Usuario</th>
				</tr>
					
				<?php
				if($personal){
					foreach($personal as $key => $valor){
					?>
		
						<tr>
							<td><?php echo $valor['nombre']; ?></td>
							<td><?php echo $valor['apellidos']; ?></td>
							<td><?php echo $valor['funcion']; ?></td>
							<td><?php echo $valor['telefono']; ?></td>
							<td><?php echo $valor['email']; ?></td>
							<td><?php if($ARRAY_USUARIOS[$valor['usuario']]) {						
										echo $ARRAY_USUARIOS[$valor['usuario']]; 
									}
									else{
										echo "---";
									} ?>
							</td>
							<td>
								<form action='index.php?menu=administracion_proyectos' method='POST'>
									<input class="bt-editar" type='submit' name='accion' value='Editar'>
									<input type='hidden' name='seleccion_formulario' value='editar_personal'></input>
									<input type='hidden' name='id' value='<?php echo $valor['id']; ?>'></input>
									<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
									<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
								</form>
							</td>
							<td>
								<form action='index.php?menu=administracion_proyectos' method='POST'>
									<input class="bt-eliminar" type='submit' name='accion' value='Eliminar'>
									<input type='hidden' name='seleccion_formulario' value='eliminar_personal'>
									<input type='hidden' name='id' value='<?php  echo $valor['id']; ?>' />
									<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
									<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
								</form>
							</td>
						</tr>
						
					<?php }
				}
				else { ?>
					<tr>
						<td colspan=6>
							<?php echo "<i>(No hay ning&uacute;n registro)</i>"; ?> 
						
						</td>
					</tr>
				<?php } ?>
			</table>
			
			<?php if(personal){ ?>
				<form action='index.php?menu=administracion_proyectos' method='POST'>
					<select class="select-comun" name='p'>
						<?php
						paginacion("SELECT COUNT(id) as total FROM kz_te_personal WHERE 1 = 1 $criterios",PERSONAS_MOSTRAR, $_POST['p']);
						?>	
					</select>
					<?php if($_POST['buscar_personal']=='Buscar'){ ?>
						<input type='hidden' name='buscar_personal' value='<?php echo $_POST['buscar_personal']; ?>'>
						<input type='hidden' name='criterios' value='<?php echo $_POST['criterios']; ?>'>
					<?php } ?>
					<input class="bt-accion" type='submit' name='accion' value='IR' /> 
					<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
				</form>
			<?php }
			break;
	}?>
  </div>
</div>