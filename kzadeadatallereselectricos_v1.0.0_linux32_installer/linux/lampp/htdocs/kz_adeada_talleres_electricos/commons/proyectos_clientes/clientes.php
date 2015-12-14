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
	<h1>Clientes</h1>

	<?php
	if($_POST['mantener_fecha']){
		$fecha_parte = $_POST['mantener_fecha']; 
	}
	else{
		$fecha_parte = date("Y-m-d"); 
	}
	
	//FECHA PARTE DESGLOSADA
	$fpd = desglose_fecha_hora($fecha_parte);
	
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
	
	if($_POST['anadir_cliente']){
		if($_POST['codigo']){
			$link = conectar($_SESSION[APLICACION_.'bbdd']);
			$sql_comprobar = "SELECT id FROM kz_te_clientes WHERE id='".$_POST['codigo']."'";
			$rs = mysql_query($sql_comprobar);
			if(mysql_num_rows($rs)==0){
				$insertar_cliente = ejecutar_query("INSERT INTO kz_te_clientes VALUES('".$_POST['codigo']."', '".$_POST['cif']."', '".$_POST['razon_social']."', '".$_POST['nombre_comercial']."', '".$_POST['responsable_empresa']."', '".$_POST['direccion']."', '".$_POST['cp']."', '".$_POST['poblacion']."', '".$_POST['comarca']."', '".$_POST['provincia']."', '".$_POST['telefono']."', '".$_POST['movil']."', '".$_POST['fax']."', '".$_POST['email']."', '".$_POST['web']."', '".$_POST['observaciones']."')");
				$mensaje .=  "<hr>Se ha a&ntilde;adido el cliente<hr>";
			}
			else{
				desconectar($link);
				$mensaje .=  "<hr>ERROR. Este cliente ya est&aacute; dado de alta<hr>";
			}
		}
		else{
			$mensaje .=  "<hr>ERROR. No has introducido el c&oacute;digo<hr>";
		}
	}
	
	if($_POST['editar_cliente']){	
		$editar_cliente = ejecutar_query("UPDATE kz_te_clientes SET
		cif = '".$_POST['cif']."',
		razon_social = '".$_POST['razon_social']."',
		nombre_comercial = '".$_POST['nombre_comercial']."',
		responsable_empresa = '".$_POST['responsable_empresa']."',
		direccion = '".$_POST['direccion']."',
		cp = '".$_POST['cp']."',
		poblacion = '".$_POST['poblacion']."',
		comarca = '".$_POST['comarca']."',
		provincia = '".$_POST['provincia']."',
		telefono = '".$_POST['telefono']."',
		movil = '".$_POST['movil']."',
		fax = '".$_POST['fax']."',
		email = '".$_POST['email']."',
		web = '".$_POST['web']."',
		observaciones = '".$_POST['observaciones']."'
		where id = '".$_POST['id']."'");
		
		$mensaje .=  "<hr>Se ha editado el cliente<hr>";
	}
	
	if($_POST['eliminar_cliente']){
		$eliminar_cliente = ejecutar_query("DELETE FROM kz_te_clientes WHERE id = '".$_POST['id']."'");
		
		$mensaje .=  "<hr>Se ha eliminado el cliente<hr>";
	}
	
	if($_POST['anadir_objetivo']){
		if($_POST['objetivo']){
			$link = conectar(BBDDUSUARIO);
			$anadir_objetivo = ejecutar_query("INSERT INTO kz_te_objetivos_clientes VALUES ('null', '".$_POST['codigo']."', '".$_POST['anno']."', '".$_POST['objetivo']."')");
		
			$mensaje .=  "<hr>Objetivo a&ntilde;adido correctamente<hr>";
		}
		else{
			$mensaje .=  "<hr>ERROR. No has introducido el objetivo<hr>";
		}
	}
	
	if($_POST['eliminar_objetivo']){
		$eliminar_objetivo = ejecutar_query ("DELETE FROM kz_te_objetivos_clientes WHERE id = ".$_POST['id']."");
		
		$mensaje .=  "<hr>Objetivo eliminado correctamente<hr>";
	}
	?>
	
	<div class='mensaje'><?php  echo $mensaje; ?></div>
	
	<?php 
	switch ($_POST['seleccion_formulario']){
		case 'anadir_cliente':
			include("../commons/proyectos_clientes/clientes/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		case 'editar_cliente':
			include("../commons/proyectos_clientes/clientes/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		case 'eliminar_cliente':
			include("../commons/proyectos_clientes/clientes/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		case 'ver_ficha':
			include("../commons/proyectos_clientes/clientes/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		case 'objetivos':
			include("../commons/proyectos_clientes/clientes/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		default:
	
			if($_POST['buscar_cliente']=='Buscar'){
				$criterios = " AND nombre_comercial LIKE '%".$_POST['criterios']."%' or responsable_empresa LIKE '%".$_POST['criterios']."%'";	
			}
			else unset($_POST['criterios']);
				
			$clientes = select_normal("SELECT * FROM kz_te_clientes WHERE 1 = 1 $criterios ORDER BY nombre_comercial LIMIT $limiteinf, $limitesup");
			?>
			
			<br>
			<form action='index.php?menu=administracion_proyectos' method='post'>
				<input type='text' name='criterios' value='<?php echo $_POST['criterios']; ?>'></input>
				<input class="bt-accion" type='submit' name='buscar_cliente' value='Buscar'>
				<input class="bt-accion" type='submit' name='buscar_cliente' value='Mostrar todos'></input>
				<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
			</form>
			<br>
			
			<form action='index.php?menu=administracion_proyectos' method='post'>
				<input class="bt-nuevo-documento"  type='submit' name='accion' value='A&ntilde;adir cliente'>
				<input type='hidden' name='seleccion_formulario' value='anadir_cliente'>
				<input type='hidden' name='pag' value='<?php echo $pag; ?>'></input>
			</form>
			<br />
			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<th>Nombre</th>
					<th>Persona de contacto</th>
					<th>Tel&eacute;fono</th>
					<th>Email</th>
				</tr>
					
				<?php
				if($clientes){
				foreach($clientes as $key => $valor){
				?>
	
					<tr>
						<td><?php echo $valor['nombre_comercial']; ?></td>
						<td><?php echo $valor['responsable_empresa']; ?></td>
						<td><?php echo $valor['telefono']; ?></td>
						<td><?php echo $valor['email']; ?></td>
						<td>
							<form action='index.php?menu=administracion_proyectos' method='POST'>
								<input class="bt-accion"  type='submit' name='accion' value='Objetivos'>
								<input type='hidden' name='seleccion_formulario' value='objetivos'></input>
								<input type='hidden' name='nombre' value='<?php echo $valor['empresa']; ?>'></input>
								<input type='hidden' name='codigo' value='<?php echo $valor['id']; ?>'></input>
								<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
								<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
							</form>
						</td>
						<td>
							<form action='index.php?menu=administracion_proyectos' method='POST'>
								<input class="bt-editar"  type='submit' name='accion' value='Editar'>
								<input type='hidden' name='seleccion_formulario' value='editar_cliente'></input>
								<input type='hidden' name='id' value='<?php echo $valor['id']; ?>'></input>
								<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
								<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
							</form>
						</td>
						<td>
							<form action='index.php?menu=administracion_proyectos' method='POST'>
								<input class="bt-eliminar"  type='submit' name='accion' value='Eliminar'>
								<input type='hidden' name='seleccion_formulario' value='eliminar_cliente'>
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
						<td colspan=5>
							<?php echo "<i>(No hay ning&uacute;n cliente)</i>"; ?>
				
						</td>
					</tr>
				<?php } ?>
			</table>
			
			<?php if($clientes){ ?>
				<form action='index.php?menu=administracion_proyectos' method='POST'>
					<select class="select-comun" name='p'>
						<?php
						paginacion("SELECT COUNT(id) as total FROM kz_te_clientes WHERE 1 = 1 $criterios",PERSONAS_MOSTRAR, $_POST['p']);
						?>	
					</select>
					<?php if($_POST['buscar_cliente']=='Buscar'){ ?>
						<input type='hidden' name='buscar_cliente' value='<?php echo $_POST['buscar_cliente']; ?>'>
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