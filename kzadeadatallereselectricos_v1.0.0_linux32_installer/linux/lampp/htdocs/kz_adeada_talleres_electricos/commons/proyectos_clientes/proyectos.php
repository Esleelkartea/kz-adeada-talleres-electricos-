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
 	<h1>Trabajos</h1>

	<?php
	if($_POST['mantener_fecha']){
		$fecha_parte = $_POST['mantener_fecha']; 
	}
	else{
		$fecha_parte = date('Y-m-d'); 
	}
	
	//FECHA PARTE DESGLOSADA
	$fpd = desglose_fecha_hora($fecha_parte);
	
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
	
	if($_POST['anadir_proyecto']){
		if($_POST['codigo']){
			if($_POST['cliente']){
				$link = conectar($_SESSION[APLICACION_."gisper_bbdd"]);
				$sql_comprobar = "SELECT id FROM kz_te_proyectos WHERE id='".$_POST['codigo']."'";
				$rs = mysql_query($sql_comprobar) or die( "Error en $sql_comprobar: " . mysql_error() );
				if(mysql_num_rows($rs)==0){
					If($_POST['finalizado']!=''){
						$finalizado=1;
					}
					else{
						$finalizado=0;
					}
					if($_POST['tipo_proyecto']){
						$tipo_proyecto = $_POST['tipo_proyecto'];
					}
					
					if($_POST['tipo_proyecto_nuevo']){
						$tipo_proyecto = $_POST['tipo_proyecto_nuevo'];
						$nuevo_tipo_proyecto = ejecutar_query("INSERT INTO kz_te_tipo_proyecto VALUES(null, '".$_POST['tipo_proyecto_nuevo']."')");
						$tipo_proyecto = mysql_insert_id();
					}
					
					$insertar_proyecto = ejecutar_query("INSERT INTO kz_te_proyectos VALUES('".$_POST['codigo']."', '".$_POST['nombre']."', '".$_POST['cliente']."', '".$_POST['zona']."', '".$_POST['prioridad']."', '".$_POST['ano_inicio']."-".$_POST['mes_inicio']."-".$_POST['dia_inicio']."', '".$_POST['ano_prevista']."-".$_POST['mes_prevista']."-".$_POST['dia_prevista']."', '".$_POST['ano_real']."-".$_POST['mes_real']."-".$_POST['dia_real']."', '".$tipo_proyecto."', '".$_POST['horas_auditoria']."', '".$_POST['observaciones']."', '".$finalizado."', '".$_POST['externo_interno']."', '".$_POST['comercial']."')");
					//echo "INSERT INTO kz_te_proyectos VALUES('".$_POST['codigo']."', '".$_POST['nombre']."', '".$_POST['cliente']."', '".$_POST['zona']."', '".$_POST['prioridad']."', '".$_POST['ano_inicio']."-".$_POST['mes_inicio']."-".$_POST['dia_inicio']."', '".$_POST['ano_prevista']."-".$_POST['mes_prevista']."-".$_POST['dia_prevista']."', '".$_POST['ano_real']."-".$_POST['mes_real']."-".$_POST['dia_real']."', '".$tipo_proyecto."', '".$_POST['horas_auditoria']."', '".$_POST['observaciones']."', '".$finalizado."', '".$_POST['externo_interno']."', '".$_POST['comercial']."')";
					$mensaje .=  "<hr>Se ha a&ntilde;adido el nuevo trabajo<hr>";

					
				}
				else{
					desconectar($link);
					$mensaje .=  "<hr>ERROR. Este trabajo ya est&aacute; dado de alta<hr>";
				}
			}
			else{
				$mensaje .=  "<hr>ERROR. No has seleccionado el cliente<hr>";
			}
		}
		else{
			$mensaje .=  "<hr>ERROR. No has introducido el c&oacute;digo<hr>";
		}
	}
	
	if($_POST['editar_proyecto']){
		if($_POST['cliente']){
			If($_POST['finalizado']!=''){
				$finalizado=1;
			}
			else{
				$finalizado=0;
			}
			if($_POST['tipo_proyecto']){
				$tipo_proyecto = $_POST['tipo_proyecto'];
			}
			if($_POST['tipo_proyecto_nuevo']){
				$tipo_proyecto = $_POST['tipo_proyecto_nuevo'];
				$nuevo_tipo_proyecto = ejecutar_query("INSERT INTO kz_te_tipo_proyecto VALUES(null, '".$_POST['tipo_proyecto_nuevo']."')");
				$tipo_proyecto = mysql_insert_id();
			}
			
			$editar_proyecto = ejecutar_query("UPDATE kz_te_proyectos SET
			nombre = '".$_POST['nombre']."',
			cliente = '".$_POST['cliente']."',
			zona = '".$_POST['zona']."',
			prioridad = '".$_POST['prioridad']."',
			fecha_inicio = '".$_POST['ano_inicio']."-".$_POST['mes_inicio']."-".$_POST['dia_inicio']."',
			fecha_prevista = '".$_POST['ano_prevista']."-".$_POST['mes_prevista']."-".$_POST['dia_prevista']."',
			fecha_real = '".$_POST['ano_real']."-".$_POST['mes_real']."-".$_POST['dia_real']."',
			tipo_proyecto = '".$tipo_proyecto."',
			horas_auditoria = '".$_POST['horas_auditoria']."',
			observaciones = '".$_POST['observaciones']."',
			finalizado = '".$finalizado."',
			externo_interno = '".$_POST['externo_interno']."',
			comercial = '".$_POST['comercial']."'
			where id = '".$_POST['codigo_trabajo']."'");
			$mensaje .=  "<hr>Se ha editado el trabajo<hr>";
		}
		else{
			$mensaje .=  "<hr>ERROR. No has seleccionado el cliente<hr>";
		}
	}
	
	if($_POST['eliminar_proyecto']){
		$link = conectar($_SESSION[APLICACION_."gisper_bbdd"]);
		$tecnicos_asignados = "SELECT * FROM kz_te_proyecto_personal WHERE proyecto='".$_POST['id']."'";
		$rs = mysql_query($tecnicos_asignados);
		if(mysql_num_rows($rs) != 0){
			$eliminar_tecnicos = ejecutar_query("DELETE FROM kz_te_proyecto_personal WHERE proyecto = '".$_POST['id']."'");
		}
		
		$objetivos = "SELECT * FROM kz_te_objetivos_proyectos WHERE proyecto='".$_POST['id']."'";
		$rs2 = mysql_query($objetivos);
		if(mysql_num_rows($rs2) != 0){
			$eliminar_objetivos = ejecutar_query("DELETE FROM kz_te_objetivos_proyectos WHERE proyecto = '".$_POST['id']."'");
		}
		
		$temas_pendientes = "SELECT * FROM kz_te_temas_pendientes WHERE proyecto='".$_POST['id']."'";
		$rs3 = mysql_query($temas_pendientes);
		if(mysql_num_rows($rs3) != 0){
			$eliminar_objetivos = ejecutar_query("DELETE FROM kz_te_temas_pendientes WHERE proyecto = '".$_POST['id']."'");
		}
		
		$eliminar_proyecto = ejecutar_query("DELETE FROM kz_te_proyectos WHERE id = '".$_POST['id']."'");
		
		$mensaje .=  "<hr>Se ha eliminado el trabajo<hr>";
	}
	
	if($_POST['asignar_tecnicos']){
		$link = conectar($_SESSION[APLICACION_."gisper_bbdd"]);
		$comprobar_tecnico = "SELECT * FROM kz_te_proyecto_personal WHERE proyecto = '".$_POST['codigo']."' and tecnico = '".$_POST['tecnico']."'";
		$rs = mysql_query($comprobar_tecnico);
		if(mysql_num_rows($rs) != 0){
			$mensaje .=  "<hr>ERROR. Este trabajador ya est&aacute; asignado<hr>";
		}
		else{
			if($_POST['tecnico'] == 0){
				$mensaje .=  "<hr>ERROR. No has seleccionado ning&uacute;n trabajador<hr>";
			}
			else{
				$asignar_tecnico = ejecutar_query("INSERT INTO kz_te_proyecto_personal VALUES ('null', '".$_POST['tecnico']."', '".$_POST['codigo']."')");
				
				$mensaje .=  "<hr>Trabajador asignado correctamente<hr>";
			}
		}
	}
	
	if($_POST['eliminar_tecnico']){
		$eliminar_tecnico = ejecutar_query ("DELETE FROM kz_te_proyecto_personal WHERE id = ".$_POST['id']."");
		
		$mensaje .=  "<hr>Trabajador eliminado correctamente<hr>";
	}
	
	if($_POST['anadir_objetivo']){
		if($_POST['objetivo']){
			$link = conectar($_SESSION[APLICACION_."gisper_bbdd"]);
			$anadir_objetivo = ejecutar_query("INSERT INTO kz_te_objetivos_proyectos VALUES ('null', '".$_POST['codigo']."', '".$_POST['anno']."', '".$_POST['objetivo']."')");
		
			$mensaje .=  "<hr>Objetivo a&ntilde;adido correctamente<hr>";
		}
		else{
			$mensaje .=  "<hr>ERROR. No has introducido el objetivo<hr>";
		}
	}
	
	if($_POST['eliminar_objetivo']){
		$eliminar_objetivo = ejecutar_query ("DELETE FROM kz_te_objetivos_proyectos WHERE id = ".$_POST['id']."");
		
		$mensaje .=  "<hr>Objetivo eliminado correctamente<hr>";
	}
	
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
	} ?>
	
	<div class='mensaje'><?php echo $mensaje; ?></div>
	
	<?php if(!$_POST['cargar_subvenciones']){
		switch ($_POST['seleccion_formulario']){
			case 'anadir_proyecto':
				include("../commons/proyectos_clientes/proyectos/form_".$_POST['seleccion_formulario'].".php");
				break;
				
			case 'editar_proyecto': 
				include("../commons/proyectos_clientes/proyectos/form_".$_POST['seleccion_formulario'].".php");
				break;
				
			case 'eliminar_proyecto':
				include("../commons/proyectos_clientes/proyectos/form_".$_POST['seleccion_formulario'].".php");
				break;
				
			case 'ver_ficha':
				include("../commons/proyectos_clientes/proyectos/form_".$_POST['seleccion_formulario'].".php");
				break;
				
			case 'tecnicos':
				include("../commons/proyectos_clientes/proyectos/form_".$_POST['seleccion_formulario'].".php");
				break;
				
			case 'objetivos':
				include("../commons/proyectos_clientes/proyectos/form_".$_POST['seleccion_formulario'].".php");
				break;
				
			case 'temas_pendientes':
				include("../commons/proyectos_clientes/proyectos/form_".$_POST['seleccion_formulario'].".php");
				break;
				
			default:		
				if($_POST['buscar_proyecto']=='Buscar'){
					$criterios = " AND p.id LIKE '%".$_POST['criterios']."%' or p.nombre LIKE '%".$_POST['criterios']."%' or p.fecha_inicio LIKE '%".$_POST['criterios']."%' or c.nombre_comercial LIKE '%".$_POST['criterios']."%'";
					
					if(!$_POST['orden']){ $_POST['orden'] ='id'; $_POST['orden2'] = 'asc'; }
					
					$proyectos = select_normal("SELECT p.*, c.nombre_comercial FROM kz_te_proyectos p LEFT OUTER JOIN kz_te_clientes c ON p.cliente=c.id WHERE 1 = 1 $criterios ORDER BY ".$_POST['orden']." ".$_POST['orden2']."");	
				}
				else{
					unset($_POST['criterios']);
				
					//VARIABLES DE ORDEN
					if(!$_POST['orden']){ $_POST['orden'] ='id'; $_POST['orden2'] = 'asc';}	
					$proyectos = select_normal("SELECT p.*, c.nombre_comercial FROM kz_te_proyectos p LEFT OUTER JOIN kz_te_clientes c ON p.cliente=c.id WHERE 1 = 1 $criterios ORDER BY ".$_POST['orden']." ".$_POST['orden2']." LIMIT $limiteinf, $limitesup");
				} ?>
				
				<br>
				<form action='index.php?menu=administracion_proyectos' method='post'>
					<input class="input-comun" type='text' name='criterios' value='<?php echo $_POST['criterios']; ?>'></input>
					<input class="bt-accion" type='submit' name='buscar_proyecto' value='Buscar'>
					<input class="bt-accion" type='submit' name='buscar_proyecto' value='Mostrar todos'></input>
					<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
				</form>
				<br>
				
				<form action='index.php?menu=administracion_proyectos' method='post'>
					<input class="bt-nuevo-documento" type='submit' name='accion' value='A&ntilde;adir trabajo'>
					<input type='hidden' name='seleccion_formulario' value='anadir_proyecto'>
					<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
				</form>
				
				<table width="100%" border="1" cellpadding="0" cellspacing="0">
					<tr>
						<th>C&oacute;digo</th>
						<th>Nombre</th>
						<th>Cliente</th>
						<th>Int./Ext.</th>
						<th>Fecha inicio</th>
						<th>Final.</th>
					</tr>
					
					<?php if($proyectos){
						foreach($proyectos as $key => $valor){ ?>
							<tr>
								<td><?php echo $valor['id']; ?></td>
								<td><?php echo $valor['nombre']; ?></td>
								<td><?php echo $PARTES_CLIENTES[$valor['cliente']]; ?></td>
								<td><?php echo $valor['externo_interno']; ?></td>
								<td><?php echo $valor['fecha_inicio']; ?></td>
								
								<?php if($valor['finalizado'] == '0'){ ?>
									<td><?php echo 'NO'; ?></td>
								<?php }
								if($valor['finalizado'] == '1'){ ?>
									<td><?php echo 'SI' ?></td>
								<?php }?>
		
								<td>
									<form action='index.php?menu=administracion_proyectos' method='POST'>
										<input class="bt-accion"  type='submit' name='accion' value='Objetivos'>
										<input type='hidden' name='seleccion_formulario' value='objetivos'></input>
										<input type='hidden' name='codigo' value='<?php echo $valor['id']; ?>'></input>
										<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
										<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
									</form>
								</td>
								<td>
									<form action='index.php?menu=administracion_proyectos' method='POST'>
										<input class="bt-accion"  type='submit' name='accion' value='Trabajadores'>
										<input type='hidden' name='seleccion_formulario' value='tecnicos'></input>
										<input type='hidden' name='codigo' value='<?php echo $valor['id']; ?>'></input>
										<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
										<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
									</form>
								</td>
								<td>
									<form action='index.php?menu=administracion_proyectos' method='POST'>
										<input class="bt-accion"  type='submit' name='accion' value='Temas pendientes'>
										<input type='hidden' name='seleccion_formulario' value='temas_pendientes'></input>
										<input type='hidden' name='id' value='<?php echo $valor['id']; ?>'></input>
										<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
										<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
									</form>
								</td>
								<td>
									<form action='index.php?menu=administracion_proyectos' method='POST'>
										<input class="bt-editar" type='submit' name='accion' value='Editar'>
										<input type='hidden' name='seleccion_formulario' value='editar_proyecto'></input>
										<input type='hidden' name='id' value='<?php echo $valor['id']; ?>'></input>
										<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
										<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
									</form>
								</td>
								<td>
									<form action='index.php?menu=administracion_proyectos' method='POST'>
										<input class="bt-eliminar" type='submit' name='accion' value='Eliminar'>
										<input type='hidden' name='seleccion_formulario' value='eliminar_proyecto'>
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
								<?php echo "<i>(No hay ning&uacute;n trabajo)</i>"; ?> 
							</td>
						</tr>
					<?php } ?>
				</table>
				<br />
				<?php if($proyectos){ 
					if($_POST['buscar_proyecto']!='Buscar'){ ?>
						<form action='index.php?menu=administracion_proyectos' method='POST'>
							<select class="select-comun" name='p'>
								<?php 
								paginacion("SELECT COUNT(id) as total FROM kz_te_proyectos WHERE 1 = 1 $criterios", PERSONAS_MOSTRAR, $_POST['p']); ?>	
							</select>
							<input class="bt-accion" type='submit' name='accion' value='IR' />
							<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
						</form>
					<?php }
				}
				break;
		}
	}
	else{
		if(!$_POST['editar_proyecto']){
			include("../commons/proyectos_clientes/proyectos/form_anadir_proyecto.php");
		}
		else{
			include("../commons/proyectos_clientes/proyectos/form_editar_proyecto.php");
		}
	} ?>
  </div>
</div>