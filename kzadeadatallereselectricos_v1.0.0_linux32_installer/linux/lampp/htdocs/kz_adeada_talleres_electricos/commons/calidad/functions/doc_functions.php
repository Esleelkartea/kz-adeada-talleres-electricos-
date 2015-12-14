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

/*
 * Descripcion: Funcion para obtener los valores a mostrar en el informe de documentos y revisiones
 * Parametros: Nombre de la Base de Datos, filtros del informe
 * Devuelve: Valores de la consulta, void eoc
*/
function documentos($bd, $orden = '', $orden2 = '', $filtros=''){
	if($orden == ''){
		$orden = "order by 
		 a.cod ASC";
	}
	else 
	$orden = "order by a.$orden ASC";
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	 $sql = "SELECT a.tipo, a.id, a.interno, a.cod, a.nombre, a.descripcion, a.tipo_doc, a.generado FROM kz_tec_doc_documentos a where 1 = 1 $filtros $orden";
	$rs = mysql_query($sql);
	$i = 0;
	while($row = mysql_fetch_assoc($rs)){
		
				$sql2 = "Select  b.fecha AS fecha, b.realizado, b.aprobado, b.vigor, b.soporte, b.rev AS rev, b.id as idrev, b.periodo as periodo, b.lugar as lugar from kz_tec_doc_revisiones b where b.iddoc = ".$row['id']."";
				$rs2 = mysql_query($sql2);
				$en_vigor = 0;
				while($row2 = mysql_fetch_assoc($rs2)){
					
						if($row2['vigor'] == 1){
							foreach($row2 as $key2 => $valor2){
								$datos[$i][$key2] = $valor2;
								$en_vigor = 1;
							}
						}
						else {
							if($en_vigor == 0){
								foreach($row2 as $key2 => $valor2){
									$datos[$i][$key2] = $valor2;
									$en_vigor = 0;
								}
							}
						}
				}
		
			foreach($row as $key => $valor){
				$datos[$i][$key] =$valor;

			}
				$i++;
	}
	desconectar($link);
	return($datos);
}

/*
 * Descripcion: Funcion para la creacion de un documento
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function nuevo_documento($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	foreach($datos as $key => $valor){
		
		$datos[str_replace("new_","", $key)] = $datos[$key];
		$datos[str_replace("rnew_","", $key)] = $datos[$key];
		$datos[str_replace("drnew_","", $key)] = $datos[$key];
		
		
	}

	$sql = "Insert into kz_tec_doc_documentos 
	(id, tipo, interno, cod, nombre, descripcion, generado, tipo_doc) 
	values(null,
	 '".$datos['selector_nuevo']."',
 	 '".$datos['interno']."',
  	 '".$datos['codigo']."',
 	 '".$datos['nombre']."',
	 '".$datos['descripcion']."',
 	 '".$datos['generado']."',
 	 '".$datos['tipo']."')";
	if(mysql_query($sql)){
		$ultimo_id = mysql_insert_id();
		$sql = "Insert into kz_tec_doc_revisiones 
		(id, rev, soporte, realizado, aprobado, cambio, fecha, lugar, periodo, vigor, iddoc) 
		values(null, 
		 0,
	 	 '".$datos['soporte']."',
	  	 '".$datos['realizado']."',
	 	 '".$datos['aprobado']."',
		 '".$datos['cambio']."',
	 	 '".$datos['fecha']."',
	 	 '".$datos['lugar']."',
	 	 '".$datos['anos'].",".$datos['meses']."',	 
	 	 '".$datos['vigor']."',
	 	 $ultimo_id
		)";
			if(!mysql_query($sql)){
				desconectar($link);
				echo "<script>alert('ERROR creando la ".html_entity_decode("revisi&oacute;n")."');</script>";
			}
			else { 
				desconectar($link); 
				echo "<script>alert('Documento creado correctamente');</script>";
			}
	}
	else {
		desconectar($link); 
		echo "<script>alert('ERROR creando el documento');</script>";
	}
}

/*
 * Descripcion: Funcion para la eliminacion de un documento
 * Parametros: Identificador del documento a eliminar
 * Devuelve: void
*/
function eliminar_documento($datos){
		$link = conectar($_SESSION[APLICACION_.'bbdd']);
		$sql = "Delete from kz_tec_doc_documentos where id = ".$datos['eli_doc']."";
		$elimdoc = mysql_query($sql);
		$sql = "Delete from kz_tec_doc_revisiones where iddoc = ".$datos['eli_doc']."";
		$elimrev = mysql_query($sql);
		
		if($elimdoc && $elimrev){
			desconectar($link);
			echo "<script>alert('Documento eliminado correctamente');</script>";
		}
		else { 
			desconectar($link);
			echo "<script>alert('ERROR eliminando el documento');</script>"; 
		}
}

/*
 * Descripcion: Funcion para la edicion de un documento
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function editar_documento($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
		$sql = "Update kz_tec_doc_documentos 
		set tipo = '".$datos['tipo_documento']."', interno = '".$datos['edid_interno']."', cod = '".$datos['edid_cod']."', nombre = '".$datos['edid_nombre']."', descripcion = '".$datos['edid_descripcion']."',generado = '".$datos['generado']."', tipo_doc = '".$datos['edid_tipo']."' where id = ".$datos["edid_id"]."";
		if(!mysql_query($sql)){
					desconectar($link);
					echo "<script>alert('ERROR editando el documento');</script>";
		}
		else { 
			desconectar($link); 
			echo "<script>alert('Documento editado correctamente');</script>";
		}
}

/*
 * Descripcion: Funcion para la creacion de una revision de un documento
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function nueva_revision($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	if($datos['tipo_doc'] == 'MANUAL'){
		$sql = mysql_query("Insert into kz_tec_doc_revisiones 
		(id, rev, soporte, realizado, aprobado, cambio, fecha, lugar,periodo, vigor, iddoc) 
		values(null,'".$datos['revision']."', '".$datos['newrev_soporte']."', 
		'".$datos['newrev_realizado']."', 
		'".$datos['newrev_aprobado']."',  
		'".$datos['newrev_cambio']."',
		'".$datos['newrev_fecha']."', 
		'".$datos['lugar']."', 
		'".$datos['anos'].",".$datos['meses']."',
		'".$datos['vigor']."',
		'".$datos['rev_doc']."')");
		
		$sql2 = "SELECT max(idrev) as maxima_rev FROM kz_tec_doc_manual WHERE iddoc = ".$datos['rev_doc']."";
			
		$rs = mysql_query($sql2);
		while($row = mysql_fetch_assoc($rs)){
			if($row['maxima_rev']){
				$sql3 = "SELECT * FROM kz_tec_doc_manual WHERE iddoc = ".$datos['rev_doc']." AND idrev = ".$row['maxima_rev']."";
					
				$rs2 = mysql_query($sql3);
				while($row2 = mysql_fetch_assoc($rs2)){
					$sql4 = "Insert into kz_tec_doc_manual 
					(id, presentacion_empresa, politica_calidad, alcance_sistema, referencia_procedimientos, mapa_procesos, organigrama_empresa, funciones_responsabilidades, iddoc, idrev, descripcion) 
					values(null,'".$row2['presentacion_empresa']."', '".$row2['politica_calidad']."', 
					'".$row2['alcance_sistema']."', 
					'".$row2['referencia_procedimientos']."',  
					'".$row2['mapa_procesos']."',
					'".$row2['organigrama_empresa']."', 
					'".$row2['funciones_responsabilidades']."',
					'".$datos['rev_doc']."',
					'".$datos['revision']."',
					'".$row2['descripcion']."')";
					
					if(!mysql_query($sql4)){
						desconectar($link);
						echo "<script>alert('ERROR creando la revisi&oacute;n');</script>";
					}
					else { 
						$ultimo_id = mysql_insert_id();
						desconectar($link); 
						poner_en_vigor_rev(array("rev_iddoc"=>$datos['newrev_id'],"rev_vigor"=>$ultimo_id));
						echo "<script>alert('Revisi&oacute;n creada correctamente');</script>";
					}
				}
			}
			echo "<script>alert('Revisi&oacute;n creada correctamente');</script>";
		}
	}
	else{
		if($datos['tipo_doc'] == 'PROCEDIMIENTO'){
			$sql = mysql_query("Insert into kz_tec_doc_revisiones 
			(id, rev, soporte, realizado, aprobado, cambio, fecha, lugar,periodo, vigor, iddoc) 
			values(null,'".$datos['revision']."', '".$datos['newrev_soporte']."', 
			'".$datos['newrev_realizado']."', 
			'".$datos['newrev_aprobado']."',  
			'".$datos['newrev_cambio']."',
			'".$datos['newrev_fecha']."', 
			'".$datos['lugar']."', 
			'".$datos['anos'].",".$datos['meses']."',
			'".$datos['vigor']."',
			'".$datos['rev_doc']."')");
			
			$sql2 = "SELECT max(idrev) as maxima_rev FROM kz_tec_doc_procedimientos WHERE iddoc = ".$datos['rev_doc']."";
				
			$rs = mysql_query($sql2);
			while($row = mysql_fetch_assoc($rs)){
				if($row['maxima_rev']){
					$sql3 = "SELECT * FROM kz_tec_doc_procedimientos WHERE iddoc = ".$datos['rev_doc']." AND idrev = ".$row['maxima_rev']."";
						
					$rs2 = mysql_query($sql3);
					while($row2 = mysql_fetch_assoc($rs2)){
						$sql4 = "Insert into kz_tec_doc_procedimientos 
						(id, objeto, alcance, responsabilidades, desarrollo, flujo_proceso, referencias, registros_asociados, iddoc, idrev, descripcion) 
						values(null,'".$row2['objeto']."', '".$row2['alcance']."', 
						'".$row2['responsabilidades']."', 
						'".$row2['desarrollo']."',  
						'".$row2['flujo_proceso']."',
						'".$row2['referencias']."', 
						'".$row2['registros_asociados']."',
						'".$datos['rev_doc']."',
						'".$datos['revision']."',
						'".$row2['descripcion']."')";
						
						if(!mysql_query($sql4)){
							desconectar($link);
							echo "<script>alert('ERROR creando la ".html_entity_decode("revisi&oacute;n")."');</script>";
						}
						else { 
							$ultimo_id = mysql_insert_id();
							desconectar($link); 
							poner_en_vigor_rev(array("rev_iddoc"=>$datos['newrev_id'],"rev_vigor"=>$ultimo_id));
							echo "<script>alert('".html_entity_decode("Revisi&oacute;n")." creada correctamente');</script>";
						}
					}
				}
				echo "<script>alert('".html_entity_decode("Revisi&oacute;n")." creada correctamente');</script>";
			}
		}
		else{
			$sql = mysql_query("Insert into kz_tec_doc_revisiones 
			(id, rev, soporte, realizado, aprobado, cambio, fecha, lugar,periodo, vigor, iddoc) 
			values(null,'".$datos['revision']."', '".$datos['newrev_soporte']."', 
			'".$datos['newrev_realizado']."', 
			'".$datos['newrev_aprobado']."',  
			'".$datos['newrev_cambio']."',
			'".$datos['newrev_fecha']."', 
			'".$datos['lugar']."', 
			'".$datos['anos'].",".$datos['meses']."',
			'".$datos['vigor']."',
			'".$datos['rev_doc']."')");
			
			$sql2 = "SELECT max(idrev) as maxima_rev FROM kz_tec_doc_documentos_reales WHERE iddoc = ".$datos['rev_doc']."";
				
			$rs = mysql_query($sql2);
			while($row = mysql_fetch_assoc($rs)){
				if($row['maxima_rev']){
					$sql3 = "SELECT * FROM kz_tec_doc_documentos_reales WHERE iddoc = ".$datos['rev_doc']." AND idrev = ".$row['maxima_rev']."";
						
					$rs2 = mysql_query($sql3);
					while($row2 = mysql_fetch_assoc($rs2)){
						$sql4 = "Insert into kz_tec_doc_documentos_reales 
						(id, iddoc, titulo, contenido, fecha, idrev) 
						values(null,'".$datos['rev_doc']."', '".$row2['titulo']."', 
						'".$row2['contenido']."', 
						'".$row2['fecha']."',
						'".$datos['revision']."')";
						
						if(!mysql_query($sql4)){
							desconectar($link);
							echo "<script>alert('ERROR creando la revisi&oacute;n');</script>";
						}
						else { 
							$ultimo_id = mysql_insert_id();
							desconectar($link); 
							poner_en_vigor_rev(array("rev_iddoc"=>$datos['newrev_id'],"rev_vigor"=>$ultimo_id));
							echo "<script>alert('".html_entity_decode("Revisi&oacute;n")." creada correctamente');</script>";
						}
					}
				}
				echo "<script>alert('".html_entity_decode("Revisi&oacute;n")." creada correctamente');</script>";
			}
		}
	}	
}

/*
 * Descripcion: Funcion para poner en vigor una revision de un documento
 * Parametros: Estado de la revision, identificador de la revision
 * Devuelve: Mensaje de confirmacion
*/
function poner_en_vigor_rev($datos){
		$link = conectar($_SESSION[APLICACION_.'bbdd']);
		$sql = "Update kz_tec_doc_revisiones set vigor = ".$datos['estado_vigor']." where id = ".$datos['rev_vigor']."";
		$res1 = mysql_query($sql);
		$sql = "Update kz_tec_doc_revisiones set vigor = 0 where id <> ".$datos['rev_vigor']." and iddoc = ".$datos['rev_iddoc']."";
		$res2 = mysql_query($sql);
			if($res1 && $res2){
				desconectar($link);
				return('Revisi&oacute;n puesta en vigor correctamente');
			}
			else { desconectar($link); return('ERROR al poner en vigor la revisi&oacute;n'); }
}

/*
 * Descripcion: Funcion para la eliminacion de una revision de un documento 
 * Parametros: Identificador de la revision a eliminar
 * Devuelve: void
*/
function eliminar_revision($datos){
		$link = conectar($_SESSION[APLICACION_.'bbdd']);
		$sql = "Delete from kz_tec_doc_revisiones where id = ".$datos['elimrev_id']."";
		$elimdoc = mysql_query($sql);
		
		
		if($elimdoc){
			desconectar($link);
			echo "<script>alert('".html_entity_decode("Revisi&oacute;n")." eliminada correctamente');</script>"; 
		}
		else { 
			desconectar($link);
			echo "<script>alert('ERROR eliminando la ".html_entity_decode("revisi&oacute;n")."');</script>";  
		}
}

/*
 * Descripcion: Funcion para la edicion de una revision de un documento
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function editar_revision($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "Update kz_tec_doc_revisiones set
	rev = '".$datos['revision']."',
	soporte = '".$datos['soporte']."',
	realizado = '".$datos['realizado']."',
	aprobado = '".$datos['aprobado']."',
	fecha = '".$datos['fecha']."',
	lugar = '".$datos['lugar']."',
	periodo = '".$datos['anos'].",".$datos['meses']."',
	cambio = '".$datos['cambio']."'
	where id = ".$datos["edirev_id"]."";
	if(!mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('ERROR editando la ".html_entity_decode("revisi&oacute;n")."');</script>";
	}
	else { 
		desconectar($link); 
		echo "<script>alert('".html_entity_decode("Revisi&oacute;n")." editada correctamente');</script>";
	}
}

/*
 * Descripcion: Funcion para la creacion de un documento real
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function nuevo_documento_real($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "Insert into kz_tec_doc_documentos_reales 
	(id, iddoc, titulo, contenido, fecha, idrev) 
	values(null,'".$datos['real_doc']."', '".$datos['titulo']."', '".$datos['contenido']."', '".$datos['fecha']."', 0)";
	
		if(!mysql_query($sql)){
			desconectar($link);
			echo "<script>alert('ERROR creando el documento');</script>";
		}
		else { 
			desconectar($link); 
			echo "<script>alert('Documento creado correctamente');</script>";
		}
}

/*
 * Descripcion: Funcion para la edicion de un documento real
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function editar_documento_real($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);

	$sql = "UPDATE kz_tec_doc_documentos_reales SET 
	titulo =  '".$datos['titulo']."',
	contenido =  '".$datos['contenido']."',
	fecha =  '".$datos['fecha']."'
	WHERE  id = ".$datos['edireal_id']." LIMIT 1";
	
	/*$sql = "Insert into kz_tec_doc_documentos_reales 
	(id, iddoc, titulo, contenido, fecha) 
	values(null,'".$datos['edid_real_id']."', '".$datos['titulo']."', '".$datos['contenido']."', '".$datos['fecha']."')";*/
	
	if(!mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('ERROR editando el documento');</script>";
	}
	else { 
		desconectar($link); 
		echo "<script>alert('Documento editado correctamente');</script>";
	}
}

/*
 * Descripcion: Funcion para la eliminacion de un manual
 * Parametros: Identificador del manual a eliminar
 * Devuelve: void
*/
function eliminar_manual($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "DELETE FROM kz_tec_doc_manual WHERE id = ".$datos['eliminar_manual'];

	if(mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('Manual eliminado correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR eliminando el manual');</script>";
	}
}

/*
 * Descripcion: Funcion para la edicion de un manual
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function editar_manual($datos){	
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "UPDATE kz_tec_doc_manual SET 
	presentacion_empresa =  '".$datos['presentacion_empresa']."',
	politica_calidad =  '".$datos['politica_calidad']."',
	alcance_sistema =  '".$datos['alcance_sistema']."',
	referencia_procedimientos =  '".$datos['referencia_procedimientos']."',
	mapa_procesos =  '".$datos['mapa_procesos']."',
	organigrama_empresa =  '".$datos['organigrama_empresa']."',
	funciones_responsabilidades =  '".$datos['funciones_responsabilidades']."',
	descripcion =  '".$datos['descripcion']."'
	WHERE  id = ".$datos['editar_manual']." LIMIT 1";

	if(mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('Manual editado correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR editando el manual');</script>";
	}
}

/*
 * Descripcion: Funcion para la creacion de un manual
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function crear_manual($datos){
	if($_POST['rev_doc']){
		$documento = $_POST['rev_doc'];
	}
	else{
		$documento = $datos['num_doc'];
	}
	
	$link = conectar($_SESSION[APLICACION_.'bbdd']);

	if($datos['num_doc']!=''){	
		$sql = "INSERT INTO kz_tec_doc_manual VALUES
		('null', '".$datos['presentacion_empresa']."', '".$datos['politica_calidad']."', '".$datos['alcance_sistema']."',
		'".$datos['referencia_procedimientos']."', '".$datos['mapa_procesos']."', 
		'".$datos['organigrama_empresa']."', '".$datos['funciones_responsabilidades']."', '".$documento."', 0,
		'".$datos['descripcion']."')";
		
		if(mysql_query($sql)){			
			desconectar($link);
			echo "<script>alert('Manual creado correctamente');</script>";
		}
		else {
			desconectar($link);
			echo "<script>alert('ERROR creando el manual');</script>";
		}
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR creando el manual');</script>";
	}
}

/*
 * Descripcion: Funcion para la eliminacion de un procedimiento
 * Parametros: Identificador del procedimiento a eliminar
 * Devuelve: void
*/
function eliminar_procedimiento($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "DELETE FROM kz_tec_doc_procedimientos WHERE id = ".$datos['eliminar_procedimiento'];

	if(mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('Procedimiento eliminado correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR eliminando el procedimiento');</script>";
	}
}

/*
 * Descripcion: Funcion para la edicion de un procedimiento
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function editar_procedimiento($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "UPDATE kz_tec_doc_procedimientos SET 
	objeto =  '".$datos['objeto']."',
	alcance =  '".$datos['alcance']."',
	responsabilidades =  '".$datos['responsabilidades']."',
	desarrollo =  '".$datos['desarrollo']."',
	flujo_proceso =  '".$datos['flujo_proceso']."',
	referencias =  '".$datos['referencias']."',
	registros_asociados =  '".$datos['registros_asociados']."',
	descripcion =  '".$datos['descripcion']."'
	WHERE  id = ".$datos['editar_procedimiento']." LIMIT 1";

	if(mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('Procedimiento editado correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR editando el procedimiento');</script>";
	}
}

/*
 * Descripcion: Funcion para la creacion de un procedimiento
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function crear_procedimiento($datos){	
	
	if($_POST['rev_doc']){
		$documento = $_POST['rev_doc'];
	}
	else{
		$documento = $datos['num_doc'];
	}
	
	$link = conectar($_SESSION[APLICACION_.'bbdd']);

	if($datos['num_doc']!=''){
		$sql = "INSERT INTO kz_tec_doc_procedimientos VALUES
		('null', '".$datos['objeto']."', '".$datos['alcance']."', '".$datos['responsabilidades']."',
		'".$datos['desarrollo']."', '".$datos['flujo_proceso']."', 
		'".$datos['referencias']."', '".$datos['registros_asociados']."', '".$documento."', 0,
		'".$datos['descripcion']."')";
		
		if(mysql_query($sql)){			
			desconectar($link);
			echo "<script>alert('Procedimiento creado correctamente');</script>";
		}
		else {
			desconectar($link);
			echo "<script>alert('ERROR creando el procedimiento');</script>";
		}
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR creando el manual');</script>";
	}
}
?>