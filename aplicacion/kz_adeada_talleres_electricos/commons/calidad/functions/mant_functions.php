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
 * Descripcion: Funcion para la creacion de un equipo
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function crear_equipo($datos){	
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "INSERT INTO kz_tec_mant_equipos (id, 
	numero, 
	anofab, 
	ref, 
	fab, 
	modelo, 
	tipo, 
	referencia, 
	elemento, 
	descripcion, 
	categoria,
	estado, 
	ubicacion, 
	fechaadq, 
	precio, 
	sn, 
	fecharetirada, 
	funcion, 
	cee) 
	VALUES (NULL, 
	'".$datos['numero']."', 
	'".$datos['anofab']."', 
	'".$datos['ref']."', 
	'".$datos['fabricante']."', 
	'".$datos['modelo']."', 
	'".$datos['tipo']."', 
	'".$datos['referencia']."', 
	'".$datos['elemento']."', 
	'".$datos['descripcion']."', 
	'".$datos['categoria']."', 
	'".$datos['estado']."', 
	'".$datos['ubicacion']."', 
	'".$datos['fechaadq']."', 
	'".$datos['precioadq']."', 
	'".$datos['sn']."', 
	'".$datos['fecharetirada']."', 
	'".$datos['funcion']."', 
	'".$datos['cee']."');";
	
	if(mysql_query($sql)){
	
		$sql2 = mysql_query("select * from kz_tec_mant_categoria where categoria = '".$datos['categoria']."'");
		
		If ($row = mysql_fetch_array($sql2)){}
		else{
			$nuevacategoria = "Insert into kz_tec_mant_categoria VALUES(null, '".$datos['categoria']."')";
			mysql_query ($nuevacategoria);
		}
		
		$sql3 = mysql_query("select * from kz_tec_mant_ubicacion where ubicacion = '".$datos['ubicacion']."'");
		
		If ($row = mysql_fetch_array($sql3)){}
		else{
			$nuevaubicacion = "Insert into kz_tec_mant_ubicacion VALUES(null, '".$datos['ubicacion']."')";
			mysql_query ($nuevaubicacion);
		}

		desconectar($link);
		echo "<script>alert('Equipo creado correctamente');</script>";
	}
	
	else {
		desconectar($link);
		echo "<script>alert('ERROR creando el equipo');</script>";
	}
}

/*
 * Descripcion: Funcion para la eliminacion de un equipo
 * Parametros: Identificador del equipo a eliminar
 * Devuelve: void
*/
function eliminar_equipo($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);

	$sql = "delete from kz_tec_mant_equipos where id = ".$datos['eliminar_equipo']."";
	$sql2 = "delete from kz_tec_mant_pautas where equipo = ".$datos['eliminar_equipo']."";
	$sql3 = "delete from kz_tec_mant_correctivo where equipo = ".$datos['eliminar_equipo']."";
		
	if(mysql_query($sql)){
		
		$sql_categoria = mysql_query("select * from kz_tec_mant_equipos where categoria = '".$datos['que_categoria']."'");
					
		If ($row = mysql_fetch_array($sql_categoria)){}
		else{
			$eliminar_categoria = "delete from kz_tec_mant_categoria where categoria = '".$datos['que_categoria']."'";
			mysql_query($eliminar_categoria);
		}
		
		$sql_ubicacion = mysql_query("select * from kz_tec_mant_equipos where ubicacion = '".$datos['que_ubicacion']."'");
		
		If ($row = mysql_fetch_array($sql_ubicacion)){}
		else{
			$eliminar_ubicacion = "delete from kz_tec_mant_ubicacion where ubicacion = '".$datos['que_ubicacion']."'";
			mysql_query($eliminar_ubicacion);
		}
		
		if(mysql_query($sql2)){
			if(mysql_query($sql3)){
				desconectar($link);
				echo "<script>alert('Equipo eliminado correctamente');</script>";
			}
		}
	}
		
	else {
		desconectar($link);
		echo "<script>alert('ERROR eliminando el equipo');</script>";
	}	
}

/*
 * Descripcion: Funcion para la edicion de un equipo
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function  modificar_equipo($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	if($datos['nueva_categoria'] != ''){
		$nuevacategoria = "Insert into kz_tec_mant_categoria VALUES(null, '".$datos['nueva_categoria']."')";
		mysql_query ($nuevacategoria);
		$datos['categoria'] = $datos['nueva_categoria'];
	}
	
	if($datos['nueva_ubicacion'] != ''){
		$nuevaubicacion = "Insert into kz_tec_mant_ubicacion VALUES(null, '".$datos['nueva_ubicacion']."')";
		mysql_query ($nuevaubicacion);
		$datos['ubicacion'] = $datos['nueva_ubicacion'];
	}
	
	$sql = "UPDATE kz_tec_mant_equipos SET 
			numero =  '".$datos['numero']."',
			anofab =  '".$datos['anofab']."',
			ref =  '".$datos['ref']."',
			fab =  '".$datos['fabricante']."',
			modelo =  '".$datos['modelo']."',
			tipo =  '".$datos['tipo']."',
			referencia =  '".$datos['referencia']."',
			elemento =  '".$datos['elemento']."',
			descripcion =  '".$datos['descripcion']."',
			categoria =  '".$datos['categoria']."',
			estado =  '".$datos['estado']."',
			ubicacion =  '".$datos['ubicacion']."',
			fechaadq =  '".$datos['fechaadq']."',
			precio =  '".$datos['precioadq']."',
			sn =  '".$datos['sn']."',
			fecharetirada =  '".$datos['fecharetirada']."',
			funcion =  '".$datos['funcion']."',
			cee =  '".$datos['cee']."' 
			WHERE  id = ".$datos['modificar_equipo']." LIMIT 1";
	
	if(mysql_query($sql)){
		 desconectar($link); 
		 echo "<script>alert('Equipo editado correctamente');</script>"; 
	}

	else {
		desconectar($link); 
		echo "<script>alert('ERROR editando el equipo');</script>"; 
	}
}

/*
 * Descripcion: Funcion para la creacion de una pauta de un equipo
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function anadir_pauta($datos){	
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "INSERT INTO kz_tec_mant_pautas 
	values(null, ".$datos['pauta_equipo'].", '".$datos['descripcion']."', '".$datos['periodo']."', '".$datos['inicio']."', '".$datos['fin']."', '".$datos['responsable']."', '".$datos['tiempo_estimado']."', '".$datos['euros']."')";
	if(mysql_query($sql)){
	
		   desconectar($link);
		   echo "<script>alert('Pauta creada correctamente');</script>"; 
			}
			else {
				desconectar($link);
				echo "<script>alert('ERROR creando pauta');</script>";
			}
}

/*
 * Descripcion: Funcion para la eliminacion de una pauta de un equipo
 * Parametros: Identificador de la pauta a eliminar
 * Devuelve: void
*/
function eliminar_pauta($datos){	
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "delete from kz_tec_mant_pautas where id = ".$_POST['eliminar_pauta'];
	if(mysql_query($sql)){
	
		   desconectar($link);
		   echo "<script>alert('Pauta eliminada correctamente');</script>";
			}
			else {
				desconectar($link);
				echo "<script>alert('ERROR eliminando la pauta');</script>";
			}
}

/*
 * Descripcion: Funcion para la edicion de una pauta de un equipo
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function editar_pauta($datos){		
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "UPDATE kz_tec_mant_pautas SET 
			descripcion =  '".$datos['descripcion']."',
			periodicidad =  '".$datos['periodo']."',
			fechainicio =  '".$datos['inicio']."',
			fechafin =  '".$datos['fin']."',
			responsable =  '".$datos['responsable']."',
			tiempoestimado =  '".$datos['tiempo_estimado']."',
			euros =  '".$datos['euros']."'
			WHERE  id = ".$_POST['editar_pauta']." LIMIT 1";
	
	if(mysql_query($sql)){
		 desconectar($link);
		 echo "<script>alert('Pauta editada correctamente');</script>"; 
	}

	else {
		desconectar($link);
		echo "<script>alert('ERROR editando la pauta');</script>"; 
	}
}

/*
 * Descripcion: Funcion para la creacion de un mantenimiento correctivo de un equipo
 * Parametros: Valores de los campos a insertar
 * Devuelve: void
*/
function anadir_correctivo($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "INSERT INTO kz_tec_mant_correctivo 
	values(null, ".$datos['pauta_equipo'].", '".$datos['materiales']."', '".$datos['euros']."', '".$datos['fecha']."','".$datos['observaciones']."','".$datos['horas']."')";
	if(mysql_query($sql)){
	
		   desconectar($link);
		   echo "<script>alert('Mantenimiento correctivo creado correctamente');</script>"; 
			}
			else {
				desconectar($link);
				echo "<script>alert('ERROR creando el mantenimiento correctivo');</script>"; 
			}
}

/*
 * Descripcion: Funcion para la eliminacion de un mantenimiento correctivo de un equipo
 * Parametros: Identificador del mantenimiento correctivo a eliminar
 * Devuelve: void
*/
function eliminar_correctivo($datos){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "delete from kz_tec_mant_correctivo where id = ".$_POST['eliminar_correctivo'];
	if(mysql_query($sql)){
	
		   desconectar($link);
		   echo "<script>alert('Mantenimiento correctivo eliminado correctamente');</script>"; 
			}
			else {
				desconectar($link);
				echo "<script>alert('ERROR eliminando el mantenimiento correctivo');</script>";
			}
}

/*
 * Descripcion: Funcion para la edicion de un mantenimiento correctivo de un equipo
 * Parametros: Valores de los campos a editar
 * Devuelve: void
*/
function editar_correctivo($datos){		
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$sql = "UPDATE kz_tec_mant_correctivo SET 
			materiales =  '".$datos['materiales']."',
			euros =  '".$datos['euros']."',
			fecha_mant =  '".$datos['fecha']."',
			observaciones =  '".$datos['observaciones']."',
			horas =  '".$datos['horas']."'
			WHERE  id = ".$_POST['editar_correctivo']." LIMIT 1";
	
	if(mysql_query($sql)){
		 desconectar($link);
		 echo "<script>alert('Mantenimiento correctivo editado correctamentee');</script>";
	}

	else {
		desconectar($link);
		echo "<script>alert('ERROR editando el mantenimiento correctivo');</script>"; 
	}
}
?>