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
 * Descripcion: Funcion para la creacion de un empleado
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function crear_personal($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql_comprobar = "SELECT nombre, apellidos FROM kz_tec_rrhh_personal WHERE nombre='".$datos['nombre']."' and apellidos='".$datos['apellidos']."'";
	
	$rs = mysql_query($sql_comprobar);
	
	if(mysql_num_rows($rs)==0){
	
		$sql = "Insert into kz_tec_rrhh_personal
		(nombre, apellidos, telefono, movil, email, direccion, cp, funciones, titulacion, formacion, alta, baja, poblacion, experiencia, fecha_nacimiento, dni, seguridad_social, centro) 
		values(
		 '".$datos['nombre']."',
	 	 '".$datos['apellidos']."',
	  	 '".$datos['telefono']."',
	 	 '".$datos['movil']."',
		 '".$datos['email']."',
	 	 '".$datos['direccion']."',
	 	 '".$datos['cp']."',
	  	 '".$datos['funciones']."',
	 	 '".$datos['titulacion']."',
	 	 '".$datos['formacion']."', 	   	 
	 	 '".$datos['alta']."',
	  	 '".$datos['baja']."',
	 	 '".$datos['poblacion']."',
	 	 '".$datos['experiencia']."',
	 	 '".$datos['fecha_nacimiento']."',
	 	 '".$datos['dni']."',
	 	 '".$datos['seg_social']."',
	 	 '".$datos['centro']."')";
		mysql_query($sql);
			
				
		$ultimo_id = mysql_insert_id();
		desconectar($link);
		$puestos = puestos_empresa();
		$link = conectar($_SESSION[APLICACION_.'bbdd']);
		if($puestos)
		foreach($puestos as $key => $valor){	
			$sql2 = "Insert into rrhh_valoraciones values(".$ultimo_id.",'".date("Y-m-d")."',0,".$valor['id'].",null)";
			mysql_query($sql2);	
		}
			desconectar($link);
			echo "<script>alert('Alta creada correctamente');</script>";
	}
	else{
		desconectar($link);
		echo "<script>alert('ERROR. Esta persona ya ".html_entity_decode("est&aacute;")." dada de alta');</script>";
	}		
}

/*
 * Descripcion: Funcion para la edicion de un empleado
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function editar_personal($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "UPDATE kz_tec_rrhh_personal
	set	nombre  =  '".$datos['nombre']."',
 	apellidos =  '".$datos['apellidos']."',
  	telefono =  '".$datos['telefono']."',
 	movil =  '".$datos['movil']."',
	email =  '".$datos['email']."',
 	direccion = '".$datos['direccion']."',
 	cp =  '".$datos['cp']."',
  	funciones =  '".$datos['funciones']."',
 	titulacion =  '".$datos['titulacion']."',
 	formacion =  '".$datos['formacion']."', 	   	 
 	alta =  '".$datos['alta']."',
  	baja =  '".$datos['baja']."',
 	poblacion = '".$datos['poblacion']."',
 	experiencia = '".$datos['experiencia']."',
 	fecha_nacimiento = '".$datos['fecha_nacimiento']."',
 	dni = '".$datos['dni']."',
 	seguridad_social = '".$datos['seg_social']."',
 	centro = '".$datos['centro']."'
	where id = ".$datos['editar_persona']."";
	if(mysql_query($sql)){
		 desconectar($link); 
		 echo "<script>alert('Registro editado correctamente');</script>"; 
	}

	else {
		desconectar($link); 
		echo "<script>alert('ERROR editando el registro');</script>"; 
	}
}

/*
 * Descripcion: Funcion para la eliminacion de un empleado
 * Parametros: Identificador del empleado a eliminar
 * Devuelve: void
*/
function eliminar_persona($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "delete from kz_tec_rrhh_personal where id = ".$datos['eliminar_personal']."";
	mysql_query($sql);

	$sql2 = "delete from rrhh_valoraciones where trabajador = ".$datos['eliminar_personal']."";
	mysql_query($sql2);
	desconectar($link);
	/*$plan = select_normal("select id from rrhh_planacogida where persona = ".$datos['eliminar_personal']."");
	
	if($plan){
		
		mysql_query("delete from rrhh_planacogida where persona = ".$datos['eliminar_personal']."");
		mysql_query("delete from rrhh_detalleplanacogida where idplan = ".$plan[0]['id']."");
	}*/
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	mysql_query("delete from kz_tec_rrhh_asistentesformacion where persona = ".$datos['eliminar_personal']."");
	
	desconectar($link);
	echo "<script>alert('Registro eliminado correctamente');</script>";
}

/*
 * Descripcion: Funcion para la edicion de las valoraciones
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function modificar_valoraciones_comentario($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	foreach($datos as $key => $valor){
		
		if(substr($key, 0, 4)=='idv_'){
			
			$det = explode('_',$key);
			
			$sql = "UPDATE kz_tec_rrhh_asistentesformacion SET
			valoracion = '".$datos['valoracion_'.$det[1]]."',
			comentarios = '".$datos['detvaloracion_'.$det[1]]."',
			fecha='".$datos['fecha_'.$det[1]]."'
			WHERE kz_tec_rrhh_asistentesformacion.curso=".$datos['curso_'.$det[1]]." and kz_tec_rrhh_asistentesformacion.persona=".$datos['persona']." and kz_tec_rrhh_asistentesformacion.id=".$datos['idv_'.$det[1]]."";
			mysql_query($sql);	
		}
	}

	if(mysql_query($sql)){
		desconectar($link);
		echo "<script>alert('Valoraciones editadas correctamente');</script>";  	
	}
	else{
		desconectar($link);
		echo "<script>alert('ERROR editando las valoraciones');</script>";  
	}
}

/*
 * Descripcion: Funcion para valorar las funciones
 * Parametros: Filtros
 * Devuelve: Valores de la consulta, void eoc
*/
function puestos_empresa($filtro = ''){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "Select id, nombre from rrhh_tablavaloraciones $filtro";
	if($rs = mysql_query($sql)){
					$i=0;	
			while($row = mysql_fetch_assoc($rs)){

				foreach($row as $key => $valor){
					$res[$i][$key] = $valor;

				}
									$i++;
			}
		 desconectar($link); return($res); }
	else {desconectar($link); }
}

/*
 * Descripcion: Funcion para la creacion de un curso
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function crear_curso($datos){	
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "Insert into kz_tec_rrhh_accformativa
	(id, ano, accionformativa, accionfinalizada, dirigida, objetivo, fechaprevista, impartidopor, plazoevaluacion, 
	procesorelacionado, fechacomienzo, fechafinal, responsableseguimiento, horas) 
	values(
	null,
	 '".$datos['ano']."',
 	 upper('".$datos['accionformativa']."'),
  	 '".$datos['finalizado']."',
  	 '".$datos['dirigidaa']."',
 	 '".$datos['objetivo']."',
	 '".$datos['fechaprevista']."',
 	 '".$datos['impartidopor']."',
 	 '".$datos['plazo']."',
  	 upper('".$datos['procesorelacionado']."'),
 	 '".$datos['fechacomienzo']."',
 	 '".$datos['fechafin']."', 	   	 
 	 upper('".$datos['responsable']."'),
 	 '".$datos['horas']."')";
	if(mysql_query($sql)){
		   desconectar($link);
		   echo "<script>alert('Curso creado correctamente');</script>"; 
	}
	else{ desconectar($link);
	echo "<script>alert('ERROR creando el curso');</script>"; 
	}
}

/*
 * Descripcion: Funcion para la edicion de un curso
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function modificar_curso($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "UPDATE kz_tec_rrhh_accformativa SET ano = '".$datos['ano']."',
	accionformativa = '".$datos['accionformativa']."',
	accionfinalizada = '".$datos['finalizado']."',
	dirigida = '".$datos['dirigidaa']."',
	objetivo = '".$datos['objetivo']."',
	fechaprevista = '".$datos['fechaprevista']."',
	impartidopor = '".$datos['impartidopor']."',
	plazoevaluacion = '".$datos['plazo']."',
	fechacomienzo = '".$datos['fechacomienzo']."',
	fechafinal = '".$datos['fechafin']."',
	responsableseguimiento = upper('".$datos['responsable']."'),
	procesorelacionado = upper('".$datos['procesorelacionado']."'),
	horas = '".$datos['horas']."' where id=".$datos['modificar_curso']."";
	if(mysql_query($sql)){
		 desconectar($link);
		 echo "<script>alert('Curso editado correctamente');</script>";   
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR editando el curso');</script>";  
	}
}

/*
 * Descripcion: Funcion para la eliminacion de un curso
 * Parametros: Identificador del curso a eliminar
 * Devuelve: void
*/
function eliminar_curso($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
		$sql = "delete from kz_tec_rrhh_accformativa where id = ".$datos['eliminar_curso']."";
		$sql2 = "delete from kz_tec_rrhh_asistentesformacion where curso = ".$datos['eliminar_curso']."";
		
		if(mysql_query($sql)){
			if(mysql_query($sql2)){
				desconectar($link);
				 echo "<script>alert('Curso eliminado correctamente');</script>"; 
			}
		}
		else {
			desconectar($link);
			 echo "<script>alert('ERROR eliminando el curso');</script>"; 
		}
}
	
/*
 * Descripcion: Funcion para obtener los asistentes a un curso
 * Parametros: Identificador del curso
 * Devuelve: Valores de las consulta, void eoc
*/
function asistentes_a_curso($curso){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "Select persona from kz_tec_rrhh_asistentesformacion where curso = $curso";
	if($rs = mysql_query($sql)){
					$i=0;	
			while($row = mysql_fetch_assoc($rs)){

				foreach($row as $key => $valor){
					$res[$i] = $valor;

				}
				$i++;
			}
		 desconectar($link); return($res); }

	else {desconectar($link); }
}

/*
 * Descripcion: Funcion para la edicion de un perfil
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function editar_perfil($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	if($datos['nuevo_nombre'] != ''){
		$nuevonombre = "INSERT INTO kz_tec_rrhh_nombresperfiles VALUES(null, '".$datos['nuevo_nombre']."')";
		mysql_query ($nuevonombre);
		$datos['nombre'] = $datos['nuevo_nombre'];
	}
	
	$sql = "UPDATE kz_tec_rrhh_perfilespuestos SET
	nombre = '".$datos['nombre']."',
	funciones = '".$datos['funciones']."',
	formacion = '".$datos['formacion']."',
	experiencia = '".$datos['experiencia']."',
	caracteristicas = '".$datos['caracteristicas']."',
	forvsexp = '".$datos['forvsexp']."' WHERE kz_tec_rrhh_perfilespuestos.id =".$datos['editar_perfil']." LIMIT 1 ;";
	
	if(mysql_query($sql)){
	 desconectar($link);
	 echo "<script>alert('Perfil editado correctamente');</script>";   
	}

	else {
		desconectar($link);
		echo "<script>alert('ERROR editando el perfil');</script>";   
	}	
}

/*
 * Descripcion: Funcion para la eliminacion de un perfil
 * Parametros: Identificador del perfil a eliminar
 * Devuelve: void
*/
function eliminar_perfil($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "delete from kz_tec_rrhh_perfilespuestos where id = ".$datos['eliminar_perfil']."";
	
	if(mysql_query($sql)){
		desconectar($link); 
		echo "<script>alert('Perfil eliminado correctamente');</script>"; 
	}
	else {
		desconectar($link); 
		echo "<script>alert('ERROR eliminando el perfil');</script>";
	}	
}

/*
 * Descripcion: Funcion para la creacion de un perfil
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function crear_perfil($datos){	
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "Insert into kz_tec_rrhh_perfilespuestos
	values(null, '".$datos['nuevo_nombre']."', '".$datos['funciones']."', '".$datos['formacion']."', '".$datos['experiencia']."', '".$datos['caracteristicas']."', '".$datos['forvsexp']."')";
	
	if(mysql_query($sql)){
		$sql2 = mysql_query("select * from kz_tec_rrhh_nombresperfiles where nombre = '".$datos['nuevo_nombre']."'");
		If ($row = mysql_fetch_array($sql2)){}
		else{
			$nuevonombre = "Insert into kz_tec_rrhh_nombresperfiles VALUES(null, '".$datos['nuevo_nombre']."')";
			mysql_query ($nuevonombre);
		}
		desconectar($link);
		echo "<script>alert('Perfil creado correctamente');</script>"; 
	}
	else {
		desconectar($link);
		echo "<script>alert('ERROR creando el perfil');</script>"; 
	}
}
?>