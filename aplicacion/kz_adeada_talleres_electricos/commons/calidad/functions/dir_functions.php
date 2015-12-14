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
 * Descripcion: Funcion para la creacion de un objetivo
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function crear_objetivo($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	If($datos['cumplido']!=''){
		$cumplido=1;
	}
	else{
		$cumplido=0;
	}
	
	$sql = "Insert into kz_tec_dir_objetivos 
	VALUES(null, '".$datos['objetivo']."', '".$datos['fechacreacion']."', '".$datos['anno']."', '".$datos['descripcion']."','".$datos['plazoconsecucion']."', '".$cumplido."', '".$datos['periodicidad']."', '".$datos['responsable']."')";
	
	if(mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('Objetivo creado correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR creando el objetivo');</script>";
	}
}

/*
 * Descripcion: Funcion para la eliminacion de un objetivo
 * Parametros: Identificador del objetivo a eliminar
 * Devuelve: void
*/
function eliminar_objetivo($datos){	
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "delete from kz_tec_dir_objetivos where id = ".$datos['eliminar_objetivo']."";
	$sql2 = "delete from kz_tec_dir_seguimientoobjetivos where objetivo = ".$datos['eliminar_objetivo']."";	
			
	if(mysql_query($sql)){
		echo "<script>alert('Objetivo eliminado correctamente');</script>";
		if(mysql_query($sql2)){
			desconectar($link);
		}
	}
	else {			
		desconectar($link);
		echo "<script>alert('ERROR eliminando el objetivo');</script>";		
	}
}

/*
 * Descripcion: Funcion para la edicion de un objetivo
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function editar_objetivo($datos){
	If($datos['edio_cumplido']!=''){
		$cumplido=1;
	}
	else{
		$cumplido=0;
	}
	
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "Update kz_tec_dir_objetivos set
	objetivo = '".$datos['edio_objetivo']."',
	fechacreacion = '".$datos['edio_fechacreacion']."', 
	anno = '".$datos['edio_anno']."', 
	descripcion = '".$datos['edio_descripcion']."',
	plazoconsecucion = '".$datos['edio_plazo']."',
	cumplido='".$cumplido."',
	periodicidad='".$datos['periodicidad']."',
	responsable='".$datos['edio_responsable']."'
	where id = ".$datos["edio_id"]."";
	
	if(!mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('ERROR editando el objetivo');</script>";
	}
	else { 
		desconectar($link);
		echo "<script>alert('Objetivo editado correctamente');</script>";
	}	
}

/*
 * Descripcion: Funcion para la edicion de un seguimiento de objetivo
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function editar_seguimiento_objetivo($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "Update kz_tec_dir_seguimientoobjetivos set
	fecha = '".$datos['edio_seg_fecha']."',
	datos = '".$datos['edio_seg_datos']."', 
	observaciones = '".$datos['edio_seg_observaciones']."', 
	responsable = '".$datos['edio_seg_responsable']."',
	grado_consecucion = '".$datos['edio_grado_consecucion']."'
	where id = ".$datos["edio_seg_id"]."";
	if(!mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('ERROR editando el seguimiento del objetivo');</script>";
	}
	else { 
		desconectar($link); 
		echo "<script>alert('Seguimiento de objetivo editado correctamente');</script>";
	}	
}

/*
 * Descripcion: Funcion para la creacion de un seguimiento de objetivo
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function crear_seguimiento_objetivo($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "Insert into kz_tec_dir_seguimientoobjetivos 
	VALUES(null, '".$datos['seg_obj']."',
	 '".$datos['fecha']."', 
	 '".$datos['datos']."', 
	 '".$datos['comentarios']."',
	 '".$datos['responsable']."',
	 '".$datos['grado_consecucion']."')";
	
	if(mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('Seguimiento de objetivo creado correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR creando el seguimiento del objetivo');</script>";
	}
}

/*
 * Descripcion: Funcion para la eliminacion de un seguimiento de objetivo
 * Parametros: Identificador del objetivo a eliminar
 * Devuelve: void
*/
function eliminar_seguimiento_objetivo($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "delete from kz_tec_dir_seguimientoobjetivos where id = ".$datos['eliminar_segobjetivo'];
	
	if(mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('Seguimiento de objetivo eliminado correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR eliminando el seguimiento del objetivo');</script>";
	}
}

/*
 * Descripcion: Funcion para la eliminacion de una orden del dia de una reunion
 * Parametros: Identificador de la orden del dia a eliminar
 * Devuelve: void
*/
function eliminar_tema($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "delete from kz_tec_dir_temasreunion where idreunion = ".$datos['id_reunion']." and idtema = ".$datos['eliminar_tema']."";
	$sql2 = "delete from kz_tec_dir_temas where id = ".$datos['eliminar_tema']."";

	if(mysql_query($sql)){
		if(mysql_query($sql2)){
			desconectar($link);
			echo "<script>alert('Orden del ".html_entity_decode("d&iacute;a")." eliminado correctamente');</script>";
		}
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR eliminando el orden del ".html_entity_decode("d&iacute;a").");</script>";
	}
}

/*
 * Descripcion: Funcion para la eliminacion de una decision de una reunion
 * Parametros: Identificador de la decision a eliminar
 * Devuelve: void
*/
function eliminar_decision($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "delete from kz_tec_dir_decisionesreunion where idreunion = ".$datos['id_reunion']." and iddecision = ".$datos['eliminar_decision']."";
	$sql2 = "delete from kz_tec_dir_decisiones where id = ".$datos['eliminar_decision']."";

	if(mysql_query($sql)){
		if(mysql_query($sql2)){
			desconectar($link);
			echo "<script>alert('".html_entity_decode("Decisi&oacute;n")." eliminada correctamente');</script>";
		}
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR eliminando la ".html_entity_decode("decisi&oacute;n").");</script>";
	}
}

/*
 * Descripcion: Funcion para la edicion de una decision de una reunion
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function editar_decision($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);

	$sql = "UPDATE kz_tec_dir_decisionesreunion SET 
			responsable =  '".$datos['responsable']."',
			plazo =  '".$datos['plazo']."'
			WHERE  id = ".$datos['editar_deci']." LIMIT 1";

	if(mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('".html_entity_decode("Decisi&oacute;n")." editada correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR editando la ".html_entity_decode("decisi&oacute;n")."');</script>";
	}
}

/*
 * Descripcion: Funcion para obtener las ordenes del dia de una reunion
 * Parametros: Identificador de la reunion
 * Devuelve: Valores de la consulta, void eoc
*/
function temas_reunion($reunion){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "Select idtema from kz_tec_dir_temasreunion where idreunion = $reunion";
	
	if($rs = mysql_query($sql)){
		$i=0;	
		while($row = mysql_fetch_assoc($rs)){
			foreach($row as $key => $valor){
				$res[$i] = $valor;
			}
			$i++;
		}
		desconectar($link); return($res); 
	}
	else {
		desconectar($link); 
	}
}

/*
 * Descripcion: Funcion para obtener las decisiones de una reunion
 * Parametros: Identificador de la reunion
 * Devuelve: Valores de la consulta, void eoc
*/
function decisiones_reunion($reunion){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "Select iddecision from kz_tec_dir_decisionesreunion where idreunion = $reunion";
	
	if($rs = mysql_query($sql)){
		$i=0;	
		while($row = mysql_fetch_assoc($rs)){
			foreach($row as $key => $valor){
				$res[$i] = $valor;
			}
			$i++;
		}
		desconectar($link); return($res); 
	}
	else {
		desconectar($link); 
	}
}

/*
 * Descripcion: Funcion para la edicion de una reunion
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function modificar_reunion($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	if($datos['departamento_tipo']!=''){
		$departamento=$datos['departamento_tipo'];
	}
	elseif($datos['departamento_tipo']==''){
		$departamento=$datos['departamento'];
	}
	
	$sql = "UPDATE kz_tec_dir_reuniones SET 
			fecha =  '".$datos['fecha']."',
			asistentes =  '".$datos['asistentes']."',
			objeto =  '".$datos['objeto']."',
			fechasig =  '".$datos['fechasig']."',
			horasig =  '".$datos['hora_siguiente']."',
			departamento =  '".$departamento."'
			WHERE  id = ".$datos['modificar_reunion']." LIMIT 1";

	if(mysql_query($sql)){
		$sql3 = mysql_query("select * from kz_tec_dir_departamentos where departamento = '".$datos['departamento_tipo']."'");
		If ($row = mysql_fetch_array($sql3)){}
		else{
			$nuevodepartamento = "Insert into kz_tec_dir_departamentos VALUES(null, '".$datos['departamento_tipo']."')";
			mysql_query ($nuevodepartamento);
		}
		
		desconectar($link);
		echo "<script>alert('".html_entity_decode("Reuni&oacute;n")." editada correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR editando la ".html_entity_decode("reuni&oacute;n")."');</script>";
	}
}

/*
 * Descripcion: Funcion para la creacion de una orden del dia
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function anadir_tema($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);

	$sql = mysql_query("Insert into kz_tec_dir_temas values(null, '".$datos['tema']."')");
	$ultimotema = mysql_insert_id();
	$sql2 = "Insert into kz_tec_dir_temasreunion values(null, ".$ultimotema.", ".$datos['tema_reunion'].", '0')";
	
	if(mysql_query($sql2)){
		desconectar($link);
		echo "<script>alert('Orden del ".html_entity_decode("d&iacute;a")." creado correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR creando el orden del ".html_entity_decode("d&iacute;a")."');</script>";
	}
}

/*
 * Descripcion: Funcion para la creacion de una decision
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function anadir_decision($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = mysql_query("Insert into kz_tec_dir_decisiones values(null, '".$datos['decision']."')");
	$ultimadecision = mysql_insert_id();
	$sql2 = "Insert into kz_tec_dir_decisionesreunion values(null, ".$datos['decision_reunion'].", '".$ultimadecision."', '".$datos['responsable']."', '".$datos['plazo']."', '0')";
	
	if(mysql_query($sql2)){
		desconectar($link);
		echo "<script>alert('".html_entity_decode("Decisi&oacute;n")." creada correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR creando la ".html_entity_decode("decisi&oacute;n")."');</script>";
	}
}

/*
 * Descripcion: Funcion para la creacion de una reunion
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function nueva_reunion($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "Insert into kz_tec_dir_reuniones 
	VALUES(null,
	 '".$datos['fecha']."',
	 '".$datos['asistentes']."', 
	 '".$datos['objeto']."', 
	 '".$datos['fechasig']."',
	 '".$datos['hora_siguiente']."',
	 '".$datos['departamento_tipo']."')";
	
	if(mysql_query($sql)){
		$sql2 = mysql_query("select * from kz_tec_dir_departamentos where departamento = '".$datos['departamento_tipo']."'");
		If ($row = mysql_fetch_array($sql2)){}
		else{
			$nuevodepartamento = "Insert into kz_tec_dir_departamentos VALUES(null, '".$datos['departamento_tipo']."')";
			mysql_query ($nuevodepartamento);
		}
		desconectar($link);
		echo "<script>alert('".html_entity_decode("Reuni&oacute;n")." creada correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR creando la ".html_entity_decode("reuni&oacute;n")."');</script>";
	}
}

/*
 * Descripcion: Funcion para la eliminacion de una reunion
 * Parametros: Identificador de la reunion a eliminar
 * Devuelve: void
*/
function eliminar_reunion($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "delete from kz_tec_dir_reuniones where id = ".$datos['eliminar_reunion'];
	$sql3 = "delete from kz_tec_dir_decisionesreunion where idreunion = ".$datos['eliminar_reunion'];
	$sql4 = "delete from kz_tec_dir_temasreunion where idreunion = ".$datos['eliminar_reunion'];

	if(mysql_query($sql)){
		if(mysql_query($sql3)){
			if(mysql_query($sql4)){
		
				$sql2 = mysql_query("select * from kz_tec_dir_reuniones where departamento = '".$datos['que_departamento']."'");
				
				If ($row = mysql_fetch_array($sql2)){}
				else{
					$eliminar_departamento = "delete from kz_tec_dir_departamentos where departamento = '".$datos['que_departamento']."'";
					mysql_query($eliminar_departamento);
				}
				desconectar($link);
				echo "<script>alert('".html_entity_decode("Reuni&oacute;n")." eliminada correctamente');</script>";
			}
		}
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR eliminando la ".html_entity_decode("reuni&oacute;n")."');</script>";
	}
}

/*
 * Descripcion: Funcion para cargar un combo con los departamentos de las reuniones
 * Devuelve: Valores de la consulta, void eoc
*/
function mostrar_departamentos(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);

	$sql = "Select distinct(departamento) from kz_tec_dir_departamentos";
	if($rs = mysql_query($sql)){
			$i=0;	
			while($row = mysql_fetch_row($rs)){
				foreach($row as $key => $valor){
					$res[$i][$key] = $valor;
				}
				$i++;
			}
			desconectar($link); return($res); 
	}
	else {
		desconectar($link); 
	}
}

/*
 * Descripcion: Funcion para cerrar una orden del dia de una reunion
 * Parametros: Estado del cierre, identificador de la orden del dia a cerrar
 * Devuelve: void
*/
function cerrar_tema($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "Update kz_tec_dir_temasreunion set cerrado = ".$datos['estado_cerrado']." where id = ".$datos['tema_cerrado']."";
	$res1 = mysql_query($sql);
		if($res1){
			desconectar($link);
			echo "<script>alert('Orden del ".html_entity_decode("d&iacute;a")." cerrado');</script>";
		}
		else { 
			desconectar($link); 
			echo "<script>alert('ERROR cerrando el orden del ".html_entity_decode("d&iacute;a")."');</script>";
		}
}

/*
 * Descripcion: Funcion para cerrar una decision de una reunion
 * Parametros: Estado del cierre, identificador de la decision a cerrar
 * Devuelve: void
*/
function cerrar_decision($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "Update kz_tec_dir_decisionesreunion set cerrado = ".$datos['estado_cerrada']." where id = ".$datos['decision_cerrada']."";
	$res1 = mysql_query($sql);
		if($res1){
			desconectar($link);
			echo "<script>alert('".html_entity_decode("Decisi&oacute;n")." cerrada');</script>";
		}
		else { 
			desconectar($link); 
			echo "<script>alert('ERROR cerrando la ".html_entity_decode("decisi&oacute;n")."');</script>";
		}
}

/*
 * Descripcion: Funcion para la eliminacion de una revision de direccion
 * Parametros: Identificador de la revision de direccion a eliminar
 * Devuelve: void
*/
function eliminar_revision_calidad($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "DELETE FROM kz_tec_dir_revisiondireccion WHERE id = ".$datos['eliminar_revision_calidad'];

	if(mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('".html_entity_decode("Revisi&oacute;n")." de ".html_entity_decode("direcci&oacute;n")." de calidad eliminada correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR eliminando la ".html_entity_decode("revisi&oacute;n")." de d".html_entity_decode("direcci&oacute;n")." de calidad');</script>";
	}
}

/*
 * Descripcion: Funcion para la edicion de una revision de direccion
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function modificar_revision_calidad($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "UPDATE kz_tec_dir_revisiondireccion SET 
	fecha =  '".$datos['fecha_modif']."',
	anno =  '".$datos['anno']."',
	asistentes =  '".$datos['asistentes']."',
	resultado =  '".$datos['resultado']."',
	retroalimentacion =  '".$datos['retroalimentacion']."',
	desempeno =  '".$datos['desempeno']."',
	conformidad =  '".$datos['conformidad']."',
	estado =  '".$datos['estado']."',
	acciones =  '".$datos['acciones']."',
	cambios =  '".$datos['cambios']."',
	recomendaciones =  '".$datos['recomendaciones']."',
	revision =  '".$datos['revision']."',
	decisiones1 =  '".$datos['decisiones1']."',
	decisiones2 =  '".$datos['decisiones2']."',
	decisiones3 =  '".$datos['decisiones3']."',
	objetivos =  '".$datos['objetivos']."',
	tratar_acciones_mejora =  '".$datos['tratar_acciones_mejora']."'
	WHERE  id = ".$datos['id_rev_calidad']." LIMIT 1";

	if(mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('".html_entity_decode("Revisi&oacute;n")." de ".html_entity_decode("direcci&oacute;n")." de calidad editada correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR editando la ".html_entity_decode("revisi&oacute;n")." de ".html_entity_decode("direcci&oacute;n")." de calidad');</script>";
	}
}

/*
 * Descripcion: Funcion para la creacion de una revision de direccion
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function nueva_revision_calidad($datos){	
	$link = conectar($_SESSION[APLICACION_.'bbdd']);

	$sql = "INSERT INTO kz_tec_dir_revisiondireccion VALUES
	('".$datos['id_revision_calidad']."', '".$datos['fecha']."', '".$datos['anno']."', '".$datos['asistentes']."', '".$datos['resultado']."', 
	'".$datos['retroalimentacion']."', '".$datos['desempeno']."', '".$datos['conformidad']."', '".$datos['estado']."', 
	'".$datos['acciones']."', '".$datos['cambios']."', '".$datos['recomendaciones']."', '".$datos['revision']."',
	'".$datos['decisiones1']."', '".$datos['decisiones2']."', '".$datos['decisiones3']."', '".$datos['objetivos']."', '".$datos['tratar_acciones_mejora']."')";
	
	if(mysql_query($sql)){			
		desconectar($link);
		echo "<script>alert('".html_entity_decode("Revisi&oacute;n")." de ".html_entity_decode("direcci&oacute;n")." de calidad creada correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR creando la ".html_entity_decode("revisi&oacute;n")." de ".html_entity_decode("direcci&oacute;n")." de calidad');</script>";
	}
}

/*
 * Descripcion: Funcion para la creacion de una politica
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function crear_politica($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);

	$sql = "Insert into kz_tec_dir_politicas 
	VALUES(null, '".$datos['nombre']."', '".$datos['politica']."', '".$datos['fecha']."')";
	
	if(mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('".html_entity_decode("Pol&iacute;tica")." de calidad creada correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR creando la ".html_entity_decode("pol&iacute;tica")." de calidad');</script>";
	}
}

/*
 * Descripcion: Funcion para la eliminacion de una politica
 * Parametros: Identificador de la politica a eliminar
 * Devuelve: void
*/
function eliminar_politica($datos){	
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "delete from kz_tec_dir_politicas where id = ".$datos['eliminar_politica']."";
		
	if(mysql_query($sql)){
		echo "<script>alert('".html_entity_decode("Pol&iacute;tica")." de calidad eliminada correctamente');</script>";
		desconectar($link);
	}
	else {			
		desconectar($link);
		echo "<script>alert('ERROR eliminando la ".html_entity_decode("pol&iacute;tica")." de calidad');</script>";		
	}
}

/*
 * Descripcion: Funcion para la edicion de una politica
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function editar_politica($datos){	
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "Update kz_tec_dir_politicas set
	nombre = '".$datos['nombre']."',
	politica = '".$datos['politica']."', 
	fecha = '".$datos['fecha']."'
	where id = ".$datos["editar_politica"]."";
	
	if(!mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('ERROR editando la ".html_entity_decode("pol&iacute;tica")." de calidad');</script>";
	}
	else { 
		desconectar($link);
		echo "<script>alert('".html_entity_decode("pol&iacute;tica")." de calidad editada correctamente');</script>";
	}	
}
?>