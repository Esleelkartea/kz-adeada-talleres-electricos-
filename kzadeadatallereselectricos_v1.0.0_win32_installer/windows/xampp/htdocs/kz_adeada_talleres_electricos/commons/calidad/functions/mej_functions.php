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
 * Descripcion: Funcion para la creacion de una No Conformidad
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function nueva_noconformidad($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "Insert into kz_tec_mej_noconformidades 
	VALUES(null,
	 '".$datos['cnc']."',
	 '".$datos['origen_problema']."', 
	 '".$datos['detectada']."', 
	 '".$datos['detectada_por_nuevo']."',
	 '".$datos['fecha_detec']."',
	 '".$datos['descripcion']."', 
	 '".$datos['causa_estimada']."',
	 '".$datos['tratamiento']."',
	 '".$datos['responsable']."',
	 '".$datos['fecha_prev']."',
	 '".$datos['seguimiento']."',
	 '".$datos['fecha_cierre']."',
	 '".$datos['coste']."',
	 '".$datos['cierre_eficaz']."',
	 '".$datos['maquinaria']."',
	 '".$datos['mano_obra']."',
	 '".$datos['materia_prima']."',
	 '".$datos['mediciones']."', 
	 '".$datos['metodos']."',
	 '".$datos['orden_pedido']."',
	 '".$datos['unidades']."',
	 '".$datos['detectada_por_']."')";
	
	if(mysql_query($sql)){
		
		$sql2 = mysql_query("select * from kz_tec_mej_tiponc where tipo = '".$datos['origen_problema']."'");
		
		If ($row = mysql_fetch_array($sql2)){}
		else{
			$nuevoorigen = "Insert into kz_tec_mej_tiponc VALUES(null, '".$datos['origen_problema']."')";
			mysql_query ($nuevoorigen);
		}
		
		$sql3 = mysql_query("select * from kz_tec_mej_detectadaen where detectada_en = '".$datos['detectada']."'");
			
			If ($row = mysql_fetch_array($sql3)){}
			else{
				$nuevodetectadaen = "Insert into kz_tec_mej_detectadaen VALUES(null, '".$datos['detectada']."')";
				mysql_query ($nuevodetectadaen);
			}

			desconectar($link);
			echo "<script>alert('No Conformidad creada correctamente');</script>";
	}

	else {
		desconectar($link);
		echo "<script>alert('ERROR creando la No Conformidad');</script>";
	}
}

/*
 * Descripcion: Funcion para la eliminacion de una No Conformidad
 * Parametros: Identificador de la No Conformidad a eliminar
 * Devuelve: void
*/
function eliminar_noconformidad($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "delete from kz_tec_mej_noconformidades where id = ".$datos['eliminar_noconformidad'];

	if(mysql_query($sql)){
		
		$sql2 = mysql_query("select * from kz_tec_mej_noconformidades where tipoNC = '".$datos['que_tiponc']."'");
		
		If ($row = mysql_fetch_array($sql2)){}
		else{
			$eliminar_tiponc = "delete from kz_tec_mej_tiponc where tipo = '".$datos['que_tiponc']."'";
			mysql_query($eliminar_tiponc);
		}
		
		$sql3 = mysql_query("select * from kz_tec_mej_noconformidades where detectada_en = '".$datos['que_detectada']."'");
		
		If ($row = mysql_fetch_array($sql3)){}
		else{
			$eliminar_detectada = "delete from kz_tec_mej_detectadaen where detectada_en = '".$datos['que_detectada']."'";
			mysql_query($eliminar_detectada);
		}
		
		desconectar($link);
		echo "<script>alert('No Conformidad eliminada correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR eliminando la No Conformidad');</script>";
	}
}

/*
 * Descripcion: Funcion para la edicion de una No Conformidad
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function modificar_noconformidad($datos){
	If($datos['check_cierre']!=''){ $cierre=1; }
	else{ $cierre=0; }
	
	If($datos['check_maquinaria']!=''){ $maquinaria=1; }
	else{ $maquinaria=0; }
	
	If($datos['check_mano']!=''){ $mano=1; }
	else{ $mano=0; }
	
	If($datos['check_materia']!=''){ $materia=1; }
	else{ $materia=0; }
	
	If($datos['check_mediciones']!=''){ $mediciones=1; }
	else{ $mediciones=0; }
	
	If($datos['check_metodos']!=''){ $metodos=1; }
	else{ $metodos=0; }
	
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	if($datos['nuevo_origen'] != ''){
		$nuevoorigen = "Insert into kz_tec_mej_tiponc VALUES(null, '".$datos['nuevo_origen']."')";
		mysql_query ($nuevoorigen);
		$datos['tiponc'] = $datos['nuevo_origen'];
	}
	
	if($datos['nuevo_especif_origen'] != ''){
		$nuevoespeciforigen = "Insert into kz_tec_mej_detectadaen VALUES(null, '".$datos['nuevo_especif_origen']."')";
		mysql_query ($nuevoespeciforigen);
		$datos['detectada_en'] = $datos['nuevo_especif_origen'];
	}
	
	if($datos['nuevo_detectada_por'] != ''){
		$datos['detectada_por'] = $datos['nuevo_detectada_por'];
	}
	
	$sql = "UPDATE kz_tec_mej_noconformidades SET 
			cnc =  '".$datos['cnc']."',
			tipoNC =  '".$datos['tiponc']."',
			detectada_en =  '".$datos['detectada_en']."',
			detectada_por =  '".$datos['detectada_por']."',
			fecha_deteccion =  '".$datos['fecha_detec']."',
			descripcion =  '".$datos['descripcion']."',
			causa_estimada =  '".$datos['causa_estimada']."',
			tratamiento =  '".$datos['tratamiento']."',
			responsable =  '".$datos['responsable']."',
			fecha_prevista =  '".$datos['fecha_prev']."',
			seguimiento =  '".$datos['seguimiento']."',
			fecha_cierre =  '".$datos['fecha_cierre']."',
			coste =  '".$datos['coste']."',
			cierre_eficaz =  '".$cierre."',
			maquinaria =  '".$maquinaria."',
			mano_obra =  '".$mano."',
			materia_prima =  '".$materia."',
			mediciones =  '".$mediciones."',
			metodos =  '".$metodos."',
			orden_pedido =  '".$datos['orden_pedido']."',
			unidades =  '".$datos['unidades']."',
			detectada_por_ =  '".$datos['detectada_por_']."'
			WHERE  id = ".$datos['edi_noconformidad']." LIMIT 1";
	
	if(!mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('ERROR editando la No Conformidad');</script>";
	}
	else { 
		desconectar($link); 
		echo "<script>alert('No Conformidad editada correctamente');</script>";
	}	
}

/*
 * Descripcion: Funcion para la creacion de una Accion Correctiva/Mejora
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function nueva_acpm($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "INSERT INTO kz_tec_mej_acpm VALUES
	(null, '".$datos['num_nc']."', '".$datos['fecha_apertura']."', '".$datos['causa_probable']."', 
	'".$datos['tipo_accion']."', '".$datos['descripcion_accion']."', '".$datos['fecha_prevista_cierre']."',
	'".$datos['seguimiento']."', '".$datos['valoracion']."', '".$datos['fecha_cierre']."', '".$datos['responsable']."',
	'".$datos['coste']."', '".$datos['cierre_eficaz']."')";
	
	if(mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('".html_entity_decode("Acci&oacute;n")." creada correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR creando la ".html_entity_decode("Acci&oacute;n")."');</script>";
	}
}

/*
 * Descripcion: Funcion para la eliminacion de una Accion Correctiva/Mejora
 * Parametros: Identificador de la Accion a eliminar
 * Devuelve: void
*/
function eliminar_acpm($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "DELETE FROM kz_tec_mej_acpm WHERE id = ".$datos['eliminar_acpm'];

	if(mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('".html_entity_decode("Acci&oacute;n")." eliminada correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR eliminando la ".html_entity_decode("Acci&oacute;n")."');</script>";
	}
}

/*
 * Descripcion: Funcion para la edicion de una Accion Correctiva/Mejora
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function modificar_acpm($datos){
	If($datos['cierre_cumplido']!=''){
		$cierre=1;
	}
	else{
		$cierre=0;
	}
	
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "UPDATE kz_tec_mej_acpm SET 
	num_nc =  '".$datos['num_nc']."',
	fecha_apertura =  '".$datos['fecha_apertura']."',
	causa_probable =  '".$datos['causa_probable']."',
	tipo_accion =  '".$datos['tipo_accion']."',
	descripcion_accion =  '".$datos['descripcion_accion']."',
	fecha_prevista_cierre =  '".$datos['fecha_prevista_cierre']."',
	seguimiento =  '".$datos['seguimiento']."',
	valoracion =  '".$datos['valoracion']."',
	fecha_cierre =  '".$datos['fecha_cierre']."',
	responsable =  '".$datos['responsable']."',
	coste =  '".$datos['coste']."',
	cierre_eficaz =  '".$cierre."'
	WHERE  id = ".$datos['modificar_acpm']." LIMIT 1";
	
	if(!mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('ERROR editando la ".html_entity_decode("Acci&oacute;n")."');</script>";
	}
	else { 
		desconectar($link); 
		echo "<script>alert('".html_entity_decode("Acci&oacute;n")." editada correctamente');</script>";
	}
}

/*
 * Descripcion: Funcion para la creacion de una encuesta de satisfaccion
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function crear_encuesta_satisfaccion($datos){	
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "INSERT INTO kz_tec_mej_encuesta VALUES
	(null, '".$datos['organizacion']."', '".$datos['comercial']."', '".$datos['nombre']."', '".$datos['apellidos']."',
	'".$datos['fechaencuesta']."', '".$datos['fecharespuesta']."', '".$datos['sugerencias']."', '".$datos['analisis']."')";
	
	if(mysql_query($sql)){
		$idencuesta = mysql_insert_id();
		desconectar($link);		
		$campos = select_normal("SELECT * FROM kz_tec_mej_campos");
		$link = conectar($_SESSION[APLICACION_.'bbdd']);
		foreach($campos as $key => $valor){
			if($datos['pregunta_combo_'.$valor['id']] != ''){
				$campos2 = select_normal("SELECT * FROM kz_tec_mej_campos WHERE descripcion='".$datos['pregunta_combo_'.$valor['id']]."'");
				$link = conectar($_SESSION[APLICACION_.'bbdd']);
				foreach($campos2 as $key2 => $valor2){
					$sql = "INSERT INTO kz_tec_mej_valoraciones VALUES
					(null, '".$valor2['id']."', '".$idencuesta."', '".$datos['campocompetencia_'.$valor2['id']]."',
					'".$datos['campo_'.$valor2['id']]."', '".$datos['aspectoimportante_'.$valor2['id']]."')";
					
					if(!mysql_query($sql)){
						desconectar($link);
						echo "<script>alert('ERROR creando la encuesta');</script>";
					}
				}
			}
			if($datos['pregunta_'.$valor['id']] != ''){
				$sql = "INSERT INTO kz_tec_mej_campos VALUES(null, '".$datos['pregunta_'.$valor['id']]."')";
				mysql_query($sql);
				$ultima_insertada = mysql_insert_id();
				
				$sql = "INSERT INTO kz_tec_mej_valoraciones VALUES
				(null, '".$ultima_insertada."', '".$idencuesta."', '".$datos['campocompetencia_'.$valor['id']]."',
				'".$datos['campo_'.$valor['id']]."', '".$datos['aspectoimportante_'.$valor['id']]."')";
				if(!mysql_query($sql)){
					desconectar($link);
					echo "<script>alert('ERROR creando la encuesta');</script>";
				}	
			}
		}
		
		$sql = "INSERT INTO kz_tec_mej_motivosencuesta VALUES
		(null, '".$idencuesta."', '".$datos['mot_calidad']."', '".$datos['mot_precio']."', '".$datos['mot_confianza']."',
		'".$datos['mot_atencion']."', '".$datos['mot_servicio']."', '".$datos['mot_cercania']."', 
		'".$datos['mot_experiencia']."', '".$datos['mot_otros']."')";
		
		if(!mysql_query($sql)){
			desconectar($link);
			echo "<script>alert('ERROR creando la encuesta');</script>";
		}
		desconectar($link);
		echo "<script>alert('Encuesta creada correctamente');</script>";
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR creando la encuesta');</script>";
	}
}

/*
 * Descripcion: Funcion para la edicion de una encuesta de satisfaccion
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function mod_encuesta($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "UPDATE kz_tec_mej_encuesta SET 
	organizacion = '".$datos['organizacion']."',
	comercial = '".$datos['comercial']."',
	nombre = '".$datos['nombre']."',
	apellidos = '".$datos['apellidos']."',
	fechaencuesta = '".$datos['fechaencuesta']."',
	fecharespuesta = '".$datos['fecharespuesta']."',
	sugerencias = '".$datos['sugerencias']."',
	analisis = '".$datos['analisis']."' 
	WHERE id = ".$datos['modificar_encuesta'];
	
	if(!mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('ERROR editando la encuesta');</script>";
	}
	else {
		desconectar($link);
		$aspectos = select_normal("SELECT * FROM kz_tec_mej_campos");
		$link = conectar($_SESSION[APLICACION_.'bbdd']);
		foreach($aspectos as $key => $valor){
			$sql = "UPDATE kz_tec_mej_valoraciones SET 
			valoracion  = '".$datos['campo_'.$valor['id']]."',
			valcompetencia = '".$datos['campocompetencia_'.$valor['id']]."',
			aspectoimportante = '".$datos['aspectoimportante_'.$valor['id']]."' 
			WHERE idencuesta = '".$datos['modificar_encuesta']."' AND campo = '".$valor['id']."'";
			mysql_query($sql);
		}
		
		$sql = "UPDATE kz_tec_mej_motivosencuesta SET
		calidad = '".$datos['mot_calidad']."',
		precio = '".$datos['mot_precio']."',
		confianza = '".$datos['mot_confianza']."',
		atencion = '".$datos['mot_atencion']."',
		servicio = '".$datos['mot_servicio']."',
		cercania = '".$datos['mot_cercania']."',
		experiencia = '".$datos['mot_experiencia']."',
		otros = '".$datos['mot_otros']."' WHERE idencuesta = ".$datos['modificar_encuesta'];
		mysql_query($sql);
		
		desconectar($link);
		echo "<script>alert('Encuesta editada correctamente');</script>";
	}
	//return("Cuestionario modificado correctamente");
}

/*
 * Descripcion: Funcion para la eliminacion de una encuesta de satisfaccion
 * Parametros: Identificador de la encuesta a eliminar
 * Devuelve: void
*/
function eliminar_encuesta($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "DELETE FROM kz_tec_mej_encuesta WHERE id = ".$datos['eliminar_encuesta']."";
	
	if(!mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('ERROR eliminando la encuesta');</script>";
	}
	else { 
		desconectar($link); 
		echo "<script>alert('Encuesta eliminada correctamente');</script>";
	}
}
?>