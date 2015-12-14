<div id="cuerpo">
  <div id="contenido">
  	<h1>Proyectos</h1>
	
	<?php 
	//PAGINACION -----------------------------------------------------
	if(!$_POST['p']){
		$limiteinf = 0;
		$limitesup = PERSONAS_MOSTRAR;
	}
	else{
		$limitesup= PERSONAS_MOSTRAR;
		$limiteinf= PERSONAS_MOSTRAR * $_POST['p'] - PERSONAS_MOSTRAR;
		
	}
	//FIN DE LA PAGINACION -------------------------------------------
	
	if($_POST['anadir_tema']){
		if($_POST['tema']){
			$link = conectar($_SESSION[APLICACION_."gisper_bbdd"]);
			
			If($_POST['ok']!=''){
				$ok=1;
			}
			else{
				$ok=0;
			}
			
			$anadir_tema = ejecutar_query("INSERT INTO kz_te_temas_pendientes VALUES ('null', '".$_POST['id']."', '".$_POST['tema']."', '".$_POST['ano']."-".$_POST['mes']."-".$_POST['dia']."', '".$_POST['responsable']."', '".$_POST['plazo']."', '".$ok."')");
		
			$mensaje .=  "<hr>Tema a&ntilde;adido correctamente<hr>";
		}
		else{
			$mensaje .=  "<hr>ERROR. No has introducido el tema<hr>";
		}
	}
	
	if($_POST['eliminar_tema']){
		$eliminar_tema = ejecutar_query ("DELETE FROM kz_te_temas_pendientes WHERE id = ".$_POST['id_tema']."");
		
		$mensaje .=  "<hr>Tema eliminado correctamente<hr>";
	}
	
	if($_POST['cerrar_tema']){
		$editar_tema = ejecutar_query("UPDATE kz_te_temas_pendientes SET
		ok = '1'
		where id = ".$_POST['id_tema']."");
		
		$mensaje .=  "<hr>Tema cerrado correctamente<hr>";
	}
	?>
	
	<div class='mensaje'><?php  echo $mensaje; ?></div> 
	
	<?php 
	switch ($_POST['seleccion_formulario']){
		case 'temas_pendientes':
			include("../commons/proyectos_tecnico/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		default:
			$proyectos = select_normal("SELECT kz_te_proyectos.* FROM kz_te_proyectos, kz_te_proyecto_personal WHERE kz_te_proyecto_personal.tecnico='".$ID_PERSONA['id']."' and kz_te_proyectos.id=kz_te_proyecto_personal.proyecto ORDER BY finalizado, kz_te_proyectos.cliente LIMIT $limiteinf, $limitesup");?>
			
			<br>
			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<th>Nombre</th>
					<th>Cliente</th>
					<th>Fecha inicio</th>
					<th>Fecha fin</th>
					<th>Finalizado</th>
				</tr>
				
				<?php
				if($proyectos){
					foreach($proyectos as $key => $valor){ ?>
					
						<tr>
							<td><?php echo $valor['nombre']; ?></td>
							<td><?php echo $PARTES_CLIENTES[$valor['cliente']]; ?></td>
							<td><?php echo $valor['fecha_inicio']; ?></td>
							<td><?php echo $valor['fecha_prevista']; ?></td>
							
							<?php 
							if($valor['finalizado'] == '0'){ ?>
								<td><?php echo 'NO'; ?></td>
							<?php }
							if($valor['finalizado'] == '1'){ ?>
								<td><?php echo 'SI' ?></td>
							<?php }?>
							<td>
								<form action='index.php' method='POST'>
									<input type='submit' class="bt-accion" name='accion' value='Temas pendientes'>
									<input type='hidden' name='seleccion_formulario' value='temas_pendientes'>
									<input type='hidden' name='id' value='<?php  echo $valor['id']; ?>' />
									<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
								</form>
							</td>
						</tr>
						
					<?php }
				}
				else { ?>
					<tr>
						<td colspan=5>
							<?php echo "<i>(No hay ning&uacute;n proyecto)</i>"; ?> 
						</td>
					</tr>
				<?php } ?>
			</table>
			
			<?php if($proyectos){ ?>
				<br />
				<form action='index.php' method='POST'>
					<select class="select-comun" name='p'>
						<?php
						paginacion("SELECT COUNT(kz_te_proyecto_personal.id) as total FROM kz_te_proyectos, kz_te_proyecto_personal WHERE kz_te_proyectos.id=kz_te_proyecto_personal.proyecto and kz_te_proyecto_personal.tecnico='".$ID_PERSONA['id']."' and 1 = 1 $criterios", PERSONAS_MOSTRAR, $_POST['p']);
						?>	
					</select>
					<input type='submit' class="bt-accion" name='accion' value='IR' /> 
					<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
				</form>
			<?php }
			break;
	}?>
  </div>
</div>