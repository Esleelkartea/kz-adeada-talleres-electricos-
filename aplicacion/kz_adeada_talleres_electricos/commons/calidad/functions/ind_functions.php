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
 * Descripcion: Funcion que devuelve los valores de los indicadores activos
 * Devuelve: Valores de la consulta, void eoc
*/
function indicadores_activos(){
	$link = conectar(BBDDUSUARIO);
	$sql = "Select * from kz_tec_ind_indicadores where activo = 1 order by orden asc";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		$res[count($res)] = $row;
	}
	desconectar($link);
	return($res);
}

/*
 * Descripcion: Funcion que devuelve los valores de cada uno de los indicadores activos
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicadores_objetivos($anno){
	$link = conectar(BBDDUSUARIO);
	$sql = "Select a.indicador, a.anno, a.valor, a.obj, a.operador, a.responsable, 
	 b.nombre as nombre from kz_tec_ind_objetivos a, kz_tec_ind_indicadores b where a.indicador = b.id and a.anno = $anno order by a.indicador";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		$res[$row['indicador']] = $row;
	}
	desconectar($link);
	return($res);
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Objetivos por anno"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_1($anno){
	$link = conectar(BBDDUSUARIO);
	$sql = "Select * from kz_tec_dir_objetivos where fechacreacion between '".$anno."-01-01' and '".$anno."-12-31'";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
	
	$mes = substr($row['fechacreacion'],5,2);
	$mes = (int)$mes;
		$res[$mes][count($res[$mes])] = $row;
	}
	return($res);
	desconectar($link);
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Objetivos por anno cumplidos"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_2($anno){
	$link = conectar(BBDDUSUARIO);
	$sql = "Select * from kz_tec_dir_objetivos where plazoconsecucion between '".$anno."-01-01' and '".$anno."-12-31' and cumplido = 1";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
	
	$mes = substr($row['plazoconsecucion'],5,2);
	$mes = (int)$mes;
		$res[$mes][count($res[$mes])] = $row;
	}
	return($res);
	desconectar($link);
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Numero de reuniones"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_3($anno){
	$link = conectar(BBDDUSUARIO);
	$sql = "Select * from kz_tec_dir_reuniones where fecha between '".$anno."-01-01' and '".$anno."-12-31' ";
	$rs = mysql_query($sql);

	while($row = mysql_fetch_assoc($rs)){
	
		$mes = substr($row['fecha'],5,2);
		$mes = (int)$mes;
			$res[$mes][count($res[$mes])] = $row;
		}
	return($res);
	desconectar($link);
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Temas pendientes por mes"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_4($anno){
	for($i  = 1; $i < 14; $i++){
		$res[$i][count($res[$i])] = $i;
	}
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Nuevos cursos"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_5($anno){
	$link = conectar(BBDDUSUARIO);
	$sql = "Select * from kz_tec_rrhh_accformativa where fechacomienzo between '".$anno."-01-01' and '".$anno."-12-31' ";
	$rs = mysql_query($sql);

	while($row = mysql_fetch_assoc($rs)){
	
		$mes = substr($row['fechacomienzo'],5,2);
		$mes = (int)$mes;
			$res[$mes][count($res[$mes])] = $row;
		}
	return($res);
	desconectar($link);
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Valoraciones (Validas)"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_6($anno){
	$link = conectar(BBDDUSUARIO);
	$sql = "Select * from kz_tec_rrhh_asistentesformacion where fecha between '".$anno."-01-01' and '".$anno."-12-31' and valoracion = 'VALIDO'";
	$rs = mysql_query($sql);

	while($row = mysql_fetch_assoc($rs)){
	
		$mes = substr($row['fecha'],5,2);
		$mes = (int)$mes;
			$res[$mes][count($res[$mes])] = $row;
		}
	return($res);
	desconectar($link);	
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Valoraciones (Regular)"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_7($anno){
	$link = conectar(BBDDUSUARIO);
	$sql = "Select * from kz_tec_rrhh_asistentesformacion where fecha between '".$anno."-01-01' and '".$anno."-12-31' and valoracion = 'REGULAR'";
	$rs = mysql_query($sql);

	while($row = mysql_fetch_assoc($rs)){
	
		$mes = substr($row['fecha'],5,2);
		$mes = (int)$mes;
			$res[$mes][count($res[$mes])] = $row;
		}
	return($res);
	desconectar($link);
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Valoraciones (No valido)"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_8($anno){
	$link = conectar(BBDDUSUARIO);
	$sql = "Select * from kz_tec_rrhh_asistentesformacion where fecha between '".$anno."-01-01' and '".$anno."-12-31' and valoracion = 'NO VALIDO'";
	$rs = mysql_query($sql);

	while($row = mysql_fetch_assoc($rs)){
	
		$mes = substr($row['fecha'],5,2);
		$mes = (int)$mes;
			$res[$mes][count($res[$mes])] = $row;
		}
	return($res);
	desconectar($link);
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Nuevas incorporaciones"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_9($anno){
	$link = conectar(BBDDUSUARIO);
	$sql = "Select * from kz_tec_rrhh_personal where alta between '".$anno."-01-01' and '".$anno."-12-31' ";
	$rs = mysql_query($sql);

	while($row = mysql_fetch_assoc($rs)){
	
		$mes = substr($row['alta'],5,2);
		$mes = (int)$mes;
			$res[$mes][count($res[$mes])] = $row;
		}
	return($res);
	desconectar($link);
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Numero de equipos activos"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_11($anno){
	$link = conectar(BBDDUSUARIO);
	$sql = "Select * from kz_tec_mant_equipos where fechaadq between '".$anno."-01-01' and '".$anno."-12-31' ";
	$rs = mysql_query($sql);

	while($row = mysql_fetch_assoc($rs)){
	
		$mes = substr($row['fechaadq'],5,2);
		$mes = (int)$mes;
			$res[$mes][count($res[$mes])] = $row;
		}
	return($res);
	desconectar($link);
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Coste de mantenimiento correctivo"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_12($anno){
	$link = conectar(BBDDUSUARIO);
	$sql = "Select * from kz_tec_mant_correctivo where fecha_mant between '".$anno."-01-01' and '".$anno."-12-31' ";
	$rs = mysql_query($sql);

	while($row = mysql_fetch_assoc($rs)){
		$mes = substr($row['fecha_mant'],5,2);
		$mes = (int)$mes;
		$res[$mes]['suma'] = $res[$mes]['suma'] + $row['euros'];
		
	}
		
	return($res);
	desconectar($link);
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Horas de mantenimiento correctivo"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_13($anno){
	$link = conectar(BBDDUSUARIO);
	$sql = "Select * from kz_tec_mant_correctivo where fecha_mant between '".$anno."-01-01' and '".$anno."-12-31' ";
	$rs = mysql_query($sql);

	while($row = mysql_fetch_assoc($rs)){
	
		$mes = substr($row['fecha_mant'],5,2);
		$mes = (int)$mes;
			$res[$mes]['horas'] = $res[$mes]['horas'] + $row['horas'];
		}
	return($res);
	desconectar($link);
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Mantenimiento preventivo (Horas)"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_14($anno){
	for($i  = 1; $i < 14; $i++){
		$res[$i][count($res[$i])] = $i;
	}
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Encuestas"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_15($anno){
	$link = conectar(BBDDUSUARIO);
	$sql = "Select * from kz_tec_mej_encuesta where fechaencuesta between '".$anno."-01-01' and '".$anno."-12-31' ";
	$rs = mysql_query($sql);

	while($row = mysql_fetch_assoc($rs)){
	
		$mes = substr($row['fechaencuesta'],5,2);
		$mes = (int)$mes;
				$res[$mes][count($res[$mes])] = $row;
		}
	return($res);
	desconectar($link);
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Numero de acciones correctivas"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_18($anno, $tipo){
	$link = conectar(BBDDUSUARIO);
	$sql = "Select * from kz_tec_mej_acpm where fecha_apertura between '".$anno."-01-01' and '".$anno."-12-31' and tipo_accion = '".$tipo."'";
	$rs = mysql_query($sql);

	while($row = mysql_fetch_assoc($rs)){
	
		$mes = substr($row['fecha_apertura'],5,2);
		$mes = (int)$mes;
				$res[$mes][count($res[$mes])] = $row;
		}
	return($res);
	desconectar($link);
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Media de satisfaccion"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_21($anno){
	for($i  = 1; $i < 14; $i++){
		$res[$i][count($res[$i])] = $i;
	}
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Coste de mantenimiento preventivo"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_22($anno){
	$link = conectar(BBDDUSUARIO);
	
	$sql = "Select * from kz_tec_mant_pautas where fechainicio between '".$anno."-01-01' and '".$anno."-12-31'";
	$rs = mysql_query($sql);

	while($row = mysql_fetch_assoc($rs)){
		$mes = substr($row['fechainicio'],5,2);		
		$mes = (int)$mes;
		$res[$mes]['suma'] = $res[$mes]['suma'] + $row['euros'];
	}
	
	return($res);
	desconectar($link);	
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Coste de no conformidades"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_23($anno){
	$link = conectar(BBDDUSUARIO);
	$sql = "Select * from kz_tec_mej_noconformidades where fecha_deteccion between '".$anno."-01-01' and '".$anno."-12-31' ";
	$rs = mysql_query($sql);

	while($row = mysql_fetch_assoc($rs)){
	
		$mes = substr($row['fecha_deteccion'],5,2);
		$mes = (int)$mes;
			$res[$mes]['suma'] = $res[$mes]['suma'] + $row['coste'];
			
		}
	return($res);
	desconectar($link);
}

/*
 * Descripcion: Funcion que devuelve los valores del indicador "Numero de no conformidades"
 * Parametros: Anno
 * Devuelve: Valores de la consulta, void eoc
*/
function indicador_25($anno){
	$link = conectar(BBDDUSUARIO);
		
	$sql = "Select * from kz_tec_mej_noconformidades where fecha_deteccion between '".$anno."-01-01' and '".$anno."-12-31'";
	$rs = mysql_query($sql);

	while($row = mysql_fetch_assoc($rs)){
		$mes = substr($row['fecha_deteccion'],5,2);
		$mes = (int)$mes;
				$res[$mes][count($res[$mes])] = $row;
		}
	return($res);
	desconectar($link);
}

/*
 * Descripcion: Funcion para editar los valores de los objetivos
 * Parametros: Identificador del indicador, anno, operador del indicador, valor del indicador, objetivo del indicador, responsable del indicador
 * Devuelve: 
*/
function actualizar_obj_indicador($indicador,$anno, $operador, $valor, $obj, $responsable){
	$link = conectar(BBDDUSUARIO);
	$sql = "Select * from kz_tec_ind_objetivos where anno = $anno and indicador = $indicador";
	$rs = mysql_query($sql);
	
	if(mysql_num_rows($rs)>0){
		$sql = "UPDATE kz_tec_ind_objetivos set
		operador = '".$operador."',
		valor = ".isnul($valor).",
		obj = ".isnul($obj).",
		responsable = '".$responsable."' where anno = $anno and indicador = $indicador";
		mysql_query($sql);
	}
	else mysql_query("INSERT into kz_tec_ind_objetivos values($indicador, $anno, ".isnul($valor).", ".isnul($obj).", '$operador', '$responsable')");
	desconectar($link);
}
?>