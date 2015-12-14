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
<?php
if(!isset($RUTA_RAIZ)){
	$RUTA_RAIZ = $_SERVER['DOCUMENT_ROOT'];
}

define('ROOT_DIR',$RUTA_RAIZ."/kz_adeada_talleres_electricos/");
include(ROOT_DIR."functions/constantes.php");
include(ROOT_DIR."functions/conexion.php");
include(ROOT_DIR."functions/login.php");
include(ROOT_DIR."functions/informes.php");

function select_normal($consulta, $id_de_array = ''){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = $consulta;
	$rs = mysql_query($sql);
	$i = 0;
	while($row = mysql_fetch_assoc($rs)){
		foreach($row as $key => $valor){
			if($id_de_array != ''){
				$res[$row[$id_de_array]][$key] = $valor;	
			}
			else 
				$res[$i][$key] = $valor;
		}
		$i++;
	}
	desconectar($link);
	if($res) return($res);
	else return;
}

function ejecutar_query($query){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	if(mysql_query($query)){
		return mysql_insert_id();
		desconectar($link);
		return(0);
	}
	else{
		desconectar($link);
	 	return(1);
	}
}

function gisper_meses($fecha_inicio, $fecha_fin){
	//echo $fecha_inicio;
	$dividir_fecha_inicio=explode("-",$fecha_inicio);
	$ano_inicio=$dividir_fecha_inicio[0];
	$mes_inicio=$dividir_fecha_inicio[1];
	$dividir_fecha_fin=explode("-",$fecha_fin);
	$ano_fin=$dividir_fecha_fin[0];
	$mes_fin=$dividir_fecha_fin[1];
	
	$res[0]['fecha_inicio']=$ano_inicio."-".$mes_inicio."-01";
	$res[0]['fecha_fin']=$ano_fin."-".$mes_fin."-".ultimo_dia($ano_fin,$mes_fin);
	$array_meses_letras = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
	$res[0]['mes']=$array_meses_letras[((int)$mes_inicio-1)];
	return $res;
}

function ultimo_dia($anho,$mes){
		
   if (((fmod($anho,4)==0) and (fmod($anho,100)!=0)) or (fmod($anho,400)==0)) {
       $dias_febrero = 29;
   } else {
       $dias_febrero = 28;
   }
   switch($mes) {
       case 01:case 1: return 31; break;
       case 02:case 2: return $dias_febrero; break;
       case 03:case 3: return 31; break;
       case 04:case 4: return 30; break;
       case 05:case 5: return 31; break;
       case 06:case 6: return 30; break;
       case 07:case 7: return 31; break;
       case 08:case 8: return 31; break;
       case 09:case 9: return 30; break;
       case 10: return 31; break;
       case 11: return 30; break;
       case 12: return 31; break;
   }
} 

function mostrar_funciones(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "SELECT DISTINCT(funcion) FROM kz_te_funciones ORDER BY funcion";
	if($rs = mysql_query($sql)){
		$i=0;	
		while($row = mysql_fetch_row($rs)){
			foreach($row as $key => $valor){
				$res[count($res)] = $valor;
			}
			$i++;
		}
		desconectar($link); return($res); 
	}
	else {
		desconectar($link); 
	}
}

function mostrar_periodicidad(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "SELECT DISTINCT(periodicidad) FROM kz_te_periodicidad_cobro";
	if($rs = mysql_query($sql)){
		$i=0;	
		while($row = mysql_fetch_row($rs)){
			foreach($row as $key => $valor){
				$res[count($res)] = $valor;
			}
			$i++;
		}
		desconectar($link); return($res); 
	}
	else {
		desconectar($link); 
	}
}

function mostrar_facturado_por(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "SELECT DISTINCT(facturado_por) FROM kz_te_facturado_por";
	if($rs = mysql_query($sql)){
		$i=0;	
		while($row = mysql_fetch_row($rs)){
			foreach($row as $key => $valor){
				$res[count($res)] = $valor;
			}
			$i++;
		}
		desconectar($link); return($res); 
	}
	else {
		desconectar($link); 
	}
}

function mostrar_provincias(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "SELECT DISTINCT(provincia) FROM kz_te_provincias ORDER BY provincia";
	if($rs = mysql_query($sql)){
		$i=0;	
		while($row = mysql_fetch_row($rs)){
			foreach($row as $key => $valor){
				$res[count($res)] = $valor;
			}
			$i++;
		}
		desconectar($link); return($res); 
	}
	else {
		desconectar($link); 
	}
}

function obtener_trabajos(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "Select * from kz_te_tipo_trabajo order by id";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		$res[$row['trabajo']]['id'] = $row['id'];
		$sql = "Select * from kz_te_detalle_trabajo where idtrabajo  = ".$row['id']." order by orden";
		$rs2 = mysql_query($sql);
		while($row2 = mysql_fetch_assoc($rs2)){
			$res[$row['trabajo']]['subtrabajos'][count($res[$row['trabajo']]['subtrabajos'])]['id'] = $row2['id'];
			$res[$row['trabajo']]['subtrabajos'][count($res[$row['trabajo']]['subtrabajos'])-1]['trabajo'] = $row2['trabajo'];
		}
	}
	if($res) return($res);
}

function array_opciones(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "Select * from kz_te_s_opciones where activada = 1 order by num asc";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		foreach($row as $key => $valor){
			$res[$row['num']][$key] = $valor;
		}
	}
	return($res);
}

function obtener_mes($fecha){
	$fecha = explode(" ",$fecha);
	$dia = explode("-",$fecha[0]);
	$res['m'] = $dia[1];
	return($res['m']);
}

function meses_entre_fechas($ano_inicio, $ano_fin, $mes_inicio, $mes_fin){
	if(($mes_inicio == $mes_fin) && ($ano_inicio == $ano_fin)){
		$meses = 0;
	}
	else{
		$meses_inicio = 12 - $mes_inicio;
		$meses_fin = $mes_fin;
		$anos = $ano_fin - ($ano_inicio + 1);
		$meses_anos = $anos * 12;
		
		$meses = $meses_inicio + $meses_fin + $meses_anos;
	}
	return $meses;
}

function calcular_visitas_totales($ano_inicio, $ano_fin, $mes_inicio, $mes_fin, $visitas_mes){
	$meses = meses_entre_fechas($ano_inicio, $ano_fin, $mes_inicio, $mes_fin);
	$totales = $meses * $visitas_mes;
	return $totales;
}

function calcular_horas_totales($ano_inicio, $ano_fin, $mes_inicio, $mes_fin, $horas_mes){
	$meses = meses_entre_fechas($ano_inicio, $ano_fin, $mes_inicio, $mes_fin);
	$totales = $meses * $horas_mes;
	return $totales;	
}

function visitas_realizadas($proyecto, $comercial){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql2 = "select * from gisper_meses";
	$rs2 = mysql_query($sql2);
	while($row2 = mysql_fetch_assoc($rs2)){
		$sql = "SELECT count(*) FROM kz_te_partes WHERE comercial = '$comercial' and proyecto = '$proyecto' and dia >= '".$row2['fecha_inicio']."' and dia <= '".date("Y-m-d")."' and '".date("Y-m-d")."' between '".$row2['fecha_inicio']."' and '".$row2['fecha_fin']."'";
		$rs = mysql_query($sql);
		$row = mysql_fetch_row($rs);
		if($row[0] > 0){
			$res = $row[0];
		}
	}
	if($res){ return $res; }
	else{ return "0"; }
}

function visitas_total_realizadas($proyecto, $comercial, $anno){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$inicio_anno = $anno."-01-01";
	$fin_anno = $anno."-12-31";
	
	$sql = "SELECT count(*) FROM kz_te_partes WHERE tipo_trabajo = '3' and comercial = '$comercial' and proyecto = '$proyecto' AND dia BETWEEN '".$inicio_anno."' AND '".$fin_anno."'";
	$rs = mysql_query($sql);
	$resultado = mysql_fetch_row($rs);
	$res = $resultado[0];
	
	if($res){ return $res; }
	else{ return "0"; }
}

function visitas_realizadas_mes($proyecto, $comercial, $mes, $anno){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	if($mes == '01'){ $mes = 'ENERO'; }
	if($mes == '02'){ $mes = 'FEBRERO'; }
	if($mes == '03'){ $mes = 'MARZO'; }
	if($mes == '04'){ $mes = 'ABRIL'; }
	if($mes == '05'){ $mes = 'MAYO'; }
	if($mes == '06'){ $mes = 'JUNIO'; }
	if($mes == '07'){ $mes = 'JULIO'; }
	if($mes == '08'){ $mes = 'AGOSTO'; }
	if($mes == '09'){ $mes = 'SEPTIEMBRE'; }
	if($mes == '10'){ $mes = 'OCTUBRE'; }
	if($mes == '11'){ $mes = 'NOVIEMBRE'; }
	if($mes == '12'){ $mes = 'DICIEMBRE'; }
	
	$sql2 = "select * from gisper_meses where mes = '$mes' and anno = '".$anno."'";
	$rs2 = mysql_query($sql2);
	while($row2 = mysql_fetch_assoc($rs2)){
		$sql = "SELECT count(*) FROM kz_te_partes WHERE tipo_trabajo = '3' and comercial = '$comercial' and proyecto = '$proyecto' and dia >= '".$row2['fecha_inicio']."' and dia <= '".date("Y-m-d")."' and dia between '".$row2['fecha_inicio']."' and '".$row2['fecha_fin']."'";
		$rs = mysql_query($sql);
		$row = mysql_fetch_row($rs);
		if($row[0] > 0){
			$res = $row[0];
		}
	}
	if($res){ return $res; }
	else{ return "0"; }
}

function visitas_pendientes($visitas, $proyecto, $comercial){
	$realizadas = visitas_realizadas($proyecto, $comercial);
	$pendientes = $visitas - $realizadas;
	return $pendientes;
}

function visitas_pendientes_planificacion($visitas, $proyecto, $comercial){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql2 = "select * from gisper_meses";
	$rs2 = mysql_query($sql2);
	while($row2 = mysql_fetch_assoc($rs2)){
		$sql = "SELECT count(*) FROM kz_te_planificacion_partes WHERE comercial = '$comercial' and proyecto = '$proyecto' and dia >= '".date("Y-m-d")."' and dia <= '".$row2['fecha_fin']."' and '".date("Y-m-d")."' between '".$row2['fecha_inicio']."' and '".$row2['fecha_fin']."'";
		$rs = mysql_query($sql);
		$row = mysql_fetch_row($rs);
		if($row[0] > 0){
			$res = $row[0];
		}
	}
	$pendientes = visitas_pendientes($visitas, $proyecto, $comercial);
	$pendientes_planificacion = $pendientes - $res; 
	
	if($pendientes_planificacion){ return $pendientes_planificacion; }
	else{ return "0"; }
}

function horas_realizadas($proyecto, $comercial){	
	$link = conectar($_SESSION[APLICACION_.'bbdd']);

		$sql = "SELECT count(id) as total_id, sum(total_duracion) as total FROM kz_te_partes WHERE comercial = '$comercial' and proyecto = '$proyecto'";
		$rs = mysql_query($sql);
		$row = mysql_fetch_row($rs);
		if($row[0] > 0){
			$res = $res + ($row[1] / 60);	
		}
	
	if($res){ return $res; }
	else{ return "0"; }
}

function horas_total_realizadas($proyecto, $comercial, $anno){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	$inicio_anno = $anno."-01-01";
	$fin_anno = $anno."-12-31";

	$sql = "SELECT sum(total_duracion) FROM kz_te_partes WHERE comercial = '$comercial' AND proyecto = '$proyecto' AND dia BETWEEN '".$inicio_anno."' AND '".$fin_anno."'";
	$rs = mysql_query($sql);
	$resultado = mysql_fetch_row($rs);
	$res = $resultado[0] / 60;

	if($res){ return $res; }
	else{ return "0"; }
}

function horas_realizadas_mes($proyecto, $comercial, $mes, $anno){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	
	if($mes == 'ENERO'){ $mes = '01'; }
	if($mes == 'FEBRERO'){ $mes = '02'; }
	if($mes == 'MARZO'){ $mes = '03'; }
	if($mes == 'ABRIL'){ $mes = '04'; }
	if($mes == 'MAYO'){ $mes = '05'; }
	if($mes == 'JUNIO'){ $mes = '06'; }
	if($mes == 'JULIO'){ $mes = '07'; }
	if($mes == 'AGOSTO'){ $mes = '08'; }
	if($mes == 'SEPTIEMBRE'){ $mes = '09'; }
	if($mes == 'OCTUBRE'){ $mes = '10'; }
	if($mes == 'NOVIEMBRE'){ $mes = '11'; }
	if($mes == 'DICIEMBRE'){ $mes = '12'; }
	$fecha_inicio=$anno."-".$mes."-01";
	$fecha_fin=$anno."-".$mes."-".ultimo_dia($anno,$mes);
	$sql = "SELECT count(id) as total_id, sum(total_duracion) as total FROM kz_te_partes WHERE comercial = '$comercial' and proyecto = '$proyecto' and dia >= '".$fecha_inicio."' and dia <= '".date("Y-m-d")."' and dia between '".$fecha_inicio."' and '".$fecha_fin."'";
	$rs = mysql_query($sql);
	$row = mysql_fetch_row($rs);
	if($row[0] > 0){
		$res = $res + ($row[1] / 60);	
	}

	if($res){ return $res; }
	else{ return "0"; }
}

function horas_pendientes($horas, $proyecto, $comercial){
	$realizadas = horas_realizadas($proyecto, $comercial);
	$pendientes = $horas - $realizadas;
	return $pendientes;
}

function array_partes_clientes(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "Select * from kz_te_clientes";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		$res[$row['id']] = $row['nombre_comercial'];
	}
	if($res) return($res);
}

function array_tecnicos(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "Select * from kz_te_personal";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		$res[$row['id']] = $row['nombre']." ".$row['apellidos'];
	}
	if($res) return($res);
}

function array_tipo_proyecto(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "Select * from kz_te_tipo_proyecto";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		$res[$row['id']] = $row['proyecto'];
	}
	if($res) return($res);
}

function array_perfiles(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "Select * from kz_te_s_perfil order by nombre";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		$res[$row['id']] = $row['id'];
	}
	if($res) return($res);
}

function nombre_perfil($idperfil){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "Select nombre from kz_te_s_perfil WHERE id=".$idperfil."";
	$rs = mysql_query($sql);
	$row = mysql_fetch_assoc($rs);
	$res = $row['nombre'];
	if($res) return($res);
}

function array_usuarios(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "Select * from kz_te_usuarios";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		$sql2 = "Select * from kz_te_s_perfil where id=".$row['perfil']."";
		$rs2 = mysql_query($sql2);
		while($row2 = mysql_fetch_assoc($rs2)){
			$res[$row['id']] = $row2['nombre'];
		}
	}
	if($res) return($res);
}

function array_personal(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql2 = "Select * from kz_te_personal order by nombre";
	$rs2 = mysql_query($sql2);
	while($row2 = mysql_fetch_assoc($rs2)){
		$res[$row2['id']] = $row2['nombre']." ".$row2['apellidos'];
	}
	if($res) return($res);
}

function array_personal_indicadores(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql2 = "Select * from kz_te_personal WHERE nombre != 'Ekaitz' AND nombre != 'Kepa' AND nombre != 'Pablo' AND nombre != 'Christian' AND nombre != 'Ainhoa' order by nombre";
	$rs2 = mysql_query($sql2);
	while($row2 = mysql_fetch_assoc($rs2)){
		$res[$row2['id']] = $row2['nombre']." ".$row2['apellidos'];
	}
	if($res) return($res);
}

function array_proyectos(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql2 = "Select * from kz_te_proyectos order by id";
	$rs2 = mysql_query($sql2);
	while($row2 = mysql_fetch_assoc($rs2)){
		if($row2['nombre']){
			$res[$row2['id']] = $row2['id']." || ".$row2['nombre'];
		}
		else{
			$res[$row2['id']] = $row2['id'];
		}
	}
	if($res) return($res);
}

function array_proyectos_informe(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql2 = "Select * from kz_te_proyectos order by id";
	$rs2 = mysql_query($sql2);
	while($row2 = mysql_fetch_assoc($rs2)){
		if($row2['nombre']){
			$res[$row2['id']] = $row2['id']." - ".$row2['nombre'];
		}
		else{
			$res[$row2['id']] = $row2['id'];
		}
	}
	if($res) return($res);
}

function array_trabajos(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "Select * from kz_te_tipo_trabajo";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		$res['trabajos_padre'][$row['id']] = $row['trabajo'];
	}
	$sql = "Select * from kz_te_detalle_trabajo";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		$res['trabajos_hijo'][$row['id']] = $row['trabajo'];
	}
	if($res) return($res);
}

function paginacion ($sql, $numero, $pagina_actual){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$contar = mysql_query($sql);
	$cantidad = mysql_fetch_array($contar);
	$total=$cantidad[0] / $numero;
	
	for($i = 1; $i < $total + 1; $i++){
		if($pagina_actual == $i){
			$seleccionado = 'SELECTED';
		}
		else $seleccionado = '';
		echo "<option value='$i' $seleccionado>$i</option>";
	}
}

function combo_base_array_perfiles($array, $sel){
	foreach($array as $key => $valor){
		if($valor == $sel){ $selec = "SELECTED"; } else { $selec = ""; }
		echo "<option value='$valor' ".$selec." >".nombre_perfil($valor)."</option>";
	}
}

function combo_base_array($array, $sel){
	foreach($array as $key => $valor){
		if($valor == $sel){ $selec = "SELECTED"; } else { $selec = ""; }
		echo "<option value='$valor' ".$selec." >$valor</option>";
	}
}

//ESTA UTILIZA EL KEY COMO EL VALOR
function combo_base_array_2($array, $sel=''){
	foreach($array as $key => $valor){
		if($key == $sel){ $selec = "SELECTED"; } else { $selec = ""; }
		echo "<option value='$key' ".$selec." >$valor</option>";
	}
}

for($i = 1; $i < 4; $i++){
	$array_prioridades[$i] = $i;
}

for($i = 1950; $i < 2051; $i++){
	$array_annos[$i] = $i;
}

for($i = 1; $i < 13; $i++){
	$array_meses[$i] = $i;
}

$array_meses_letras = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');

for($i = 1; $i < 32; $i++){
	$array_dias[$i] = $i;
}

for($i = 7; $i < 23; $i++){
	$array_horainicio[$i] = $i;
}

for($i = 7; $i < 23; $i++){
	$array_horafin[$i] = $i;
}

for($i = 0; $i < 60; $i+=5){
	$array_minutos[$i] = str_pad($i,2,"0",STR_PAD_LEFT);
}

function ajustar_hora($hora){
	$hora = explode(':',$hora);
	$minutos = $hora[1];
	$decimales = substr($minutos,strlen($minutos)-1,1);
	$parte2 = $minutos - substr($minutos,strlen($minutos)-1,1);

	if($decimales == 1 || $decimales == 2){
		$decimales = 0;	
	}
	else{ 
		if($decimales == 3 || $decimales == 4 || $decimales == 6 || $decimales == 7){
			$decimales = 5;
		}
		else {
			if($decimales == 8 || $decimales == 9){
				$decimales = 0;
				
				$aumento_minutos = 10;
			}		
		}
	}
	
	$resminutos = (int)$parte2 + (int)$aumento_minutos + (int)$decimales;
	if($resminutos == 60){
		$aumento_hora = 1;
		$resminutos = '00';
	}
	return ($hora[0] + $aumento_hora).":".$resminutos;
}

function calcular_hora ($horainicio, $horafin){
	$horainicio = explode(':',$horainicio);
	$horafin = explode(':',$horafin);
	$min_inicio = ($horainicio[0]*60)+$horainicio[1];
	$min_fin = ($horafin[0]*60)+$horafin[1];
	$total_min = $min_fin - $min_inicio;
	return ($total_min);
}

function seleccionado($valor1, $valor2, $tipo){
	if($valor1 == $valor2){
		return($tipo);
	}
}

function generar_contrasena(){
	for($i = 1; $i < 5; $i++){
		$pass = $pass.rand(0,9);
	}
	return $pass;
}

function desglose_fecha_hora($fecha){
	$fecha = explode(" ",$fecha);
	if($fecha[1]){
		$hora = explode(":".$fecha[1]);
		$res['H'] = $hora[0];
		$res['i'] = $hora[1];
		$res['s'] = $hora[2];
	}
	$dia = explode("-",$fecha[0]);
	$res['d'] = $dia[2];
	$res['m'] = $dia[1];
	$res['Y'] = $dia[0];
	return($res);
}

function conversion_formato_fecha($fecha, $formato = 'elegante'){
	$fecha = desglose_fecha_hora($fecha);
	$nueva_fecha = mktime(0,0,0,$fecha['m'],$fecha['d'],$fecha['Y']);
	$dias = array('Domingo', 'Lunes', 'Martes', 'Mi&eacute;rcoles', 'Jueves', 'Viernes', 'S&aacute;bado');
    $diasemana =  $dias[date("w", $nueva_fecha)];
    
	switch ($formato){
		case 'elegante':
			return($diasemana.", ".$fecha['d']." del ".$fecha['m']." del ".$fecha['Y']);
			break;
		case 'abreviado':
			return($fecha['d']."/".$fecha['m']."/".$fecha['Y']);
			break;
		case 'diasemana':
			return(date("w", $nueva_fecha));
			break;
		case 'd':
			return(date("d", $nueva_fecha));
			break;
		case 'm':
			return(date("m", $nueva_fecha));
			break;			
	}
}

function cambiar_formato_fecha($fecha){
	$fecha = desglose_fecha_hora($fecha);
	$nueva_fecha = $fecha['d']."-".$fecha['m']."-".$fecha['Y'];
	return $nueva_fecha;
}

function columnas($tabla){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);	
	$result = mysql_query("SHOW FULL columns  from  $tabla ");
	if (!$result) {
	    echo 'Could not run query: ' . mysql_error();
	    exit;
	}
	if (mysql_num_rows($result) > 0) {
	    while ($row = mysql_fetch_assoc($result)) {
	        $res['partes'][$row['Field']] = $row;
	    }
	}
	mysql_close($link);
	return($res);
}

function hora_sin_segundos($hora){
	$hora = explode(":",$hora);
	return($hora[0].":".$hora[1]);
}

function comprobar_hora_ocupada_real($comercial, $fecha, $inicio, $fin){	
	$sql = "(Select count(*) as 'fuera_de_criterio' from kz_te_partes where comercial = $comercial and dia = '$fecha' and
	((hora_inicio <= '$inicio' and hora_fin <= '$inicio') or (hora_inicio >= '$fin' and hora_fin >= '$fin')))
	UNION
	(Select count(*) as 'fuera_de_criterio' from kz_te_partes where comercial = $comercial and dia = '$fecha')";
	
	$res = select_normal($sql);
	return($res);
	
}

function comprobar_hora_ocupada_planificada($comercial, $fecha, $inicio, $fin){	
	$sql = "(Select count(*) as 'fuera_de_criterio' from kz_te_planificacion_partes where comercial = $comercial and dia = '$fecha' and
	((hora_inicio <= '$inicio' and hora_fin <= '$inicio') or (hora_inicio >= '$fin' and hora_fin >= '$fin')))
	UNION
	(Select count(*) as 'fuera_de_criterio' from kz_te_planificacion_partes where comercial = $comercial and dia = '$fecha')";

	$res = select_normal($sql);
	return($res);
}

function comprobar_hora_ocupada_planificacion_real($comercial, $fecha, $inicio, $fin){
	$sql = "(Select count(*) as 'fuera_de_criterio' from kz_te_partes where comercial = $comercial and dia = '$fecha' and
	((hora_inicio <= '$inicio' and hora_fin <= '$inicio') or (hora_inicio >= '$fin' and hora_fin >= '$fin')))
	UNION
	(Select count(*) as 'fuera_de_criterio' from kz_te_partes where comercial = $comercial and dia = '$fecha')";
	
	$res = select_normal($sql);
	return($res);
}

function comprobar_hora_ocupada_planificacion_planificada($comercial, $fecha, $inicio, $fin){
	$sql = "(Select count(*) as 'fuera_de_criterio' from kz_te_planificacion_partes where comercial = $comercial and dia = '$fecha' and
	((hora_inicio <= '$inicio' and hora_fin <= '$inicio') or (hora_inicio >= '$fin' and hora_fin >= '$fin')))
	UNION
	(Select count(*) as 'fuera_de_criterio' from kz_te_planificacion_partes where comercial = $comercial and dia = '$fecha')";
	
	$res = select_normal($sql);
	return($res);
}

function sumar_dias($fecha,$dias){
	$fecha = desglose_fecha_hora($fecha);
	$fechares = date("Y-m-d",mktime(0,0,0,$fecha['m'],($fecha['d']+$dias),$fecha['Y']));
	return($fechares);
}

function obtener_semana($fecha){
	$fechad = desglose_fecha_hora($fecha);
	$diasemana = conversion_formato_fecha($fecha,'diasemana');
	if($diasemana == 0){
		$res[0] = sumar_dias($fecha,'-6');
		$res[1] = $fecha;
	}
	else{
		if($diasemana == 1){
			$res[0] = $fecha;
			$res[1] = sumar_dias($fecha,6);
		}
		else {
			$res[0] = sumar_dias($fecha,(-($diasemana-1)));
			$res[1] = sumar_dias($res[0],6);
		}
	}
	return($res);
}

function valores_negativos($valor){
	if($valor < '0'){ $estilo = "color: red;"; }
	return($estilo);
}

function plazos_pasados($valor){
	if($valor > '0'){ $estilo = "color: red;"; }
	return($estilo);
}

function menos_horas($realizadas, $mes){
	if($realizadas > $mes){ $estilo = "color: red;"; }
	return($estilo);
}

function es_tercer_lunes($fecha_a_comparar,$inicio_mes,$fin_mes){
	$es_tercer_lunes=false;
	$fecha_a_mirar=$inicio_mes;
 	$contador_de_lunes=0;
       
	while($contador_de_lunes<3){
   		if(date('N',strtotime($fecha_a_mirar))==1){
			$contador_de_lunes=$contador_de_lunes+1;
		}
		if($contador_de_lunes<3){
			$fecha_a_mirar=date('Y-m-d',strtotime($fecha_a_mirar." + 1 days"));
		}
	}
	$tercer_lunes=$fecha_a_mirar;
	$tercer_lunes_gnu=strtotime($tercer_lunes);
 	$fin_mes_gnu=strtotime($fin_mes);
	if($fecha_a_comparar==$tercer_lunes&&$tercer_lunes_gnu<=$fin_mes_gnu){
		$es_tercer_lunes=true;
	}
	return $es_tercer_lunes;
}

function array_provincias(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "Select * from kz_te_provincias";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		$res[$row['id']] = $row['provincia'];
	}
	if($res) return($res);
}

function horas_proyectos_comercial($anno,$proyecto){
	$link = conectar(BBDDUSUARIO);

	$proyectos = "SELECT id, fecha_auditoria, horas_mes, horas_auditoria, horas_visita_previa FROM kz_te_proyectos WHERE id = '".$proyecto."'";
	$rs = mysql_query($proyectos);
	while($row = mysql_fetch_assoc($rs)){
		$fechas_proyecto = select_normal("SELECT fecha_inicio, fecha_prevista FROM kz_te_proyectos WHERE id = '".$proyecto."'");
		$fechas_proyecto = $fechas_proyecto[0];
		$fecha_inicio = explode("-", $fechas_proyecto['fecha_inicio']);
		$anno_inicio = $fecha_inicio[0];
		$mes_inicio = $fecha_inicio[1];
		$fecha_fin = explode("-", $fechas_proyecto['fecha_prevista']);
		$anno_fin = $fecha_fin[0];
		$mes_fin = $fecha_fin[1];
		
		if($anno_inicio == $anno){
			if($anno_fin == $anno){ 
				if($mes_inicio <= '08'){
					if($mes_fin >= '08'){ $mes_agosto = 1; }
					else{ $mes_agosto = 0; }
				}
				else{ $mes_agosto = 0; }
				$meses = $mes_fin - $mes_inicio + 1;								
			}
			else{
				if($anno_fin > $anno){ 
					if($mes_inicio <= '08'){ $mes_agosto = 1; }
					else{ $mes_agosto = 0; }
					$meses = 13 - $mes_inicio; 
				}
				else{ $meses = 0; }
		}}
		else{
			if($anno_inicio < $anno){	
				if($anno_fin == $anno){ 
					if($mes_fin >= '08'){ $mes_agosto = 1; }
					else{ $mes_agosto = 0; }
					$meses = 0 + $mes_fin; 
				}
				else{
					if($anno_fin > $anno){ 
						$meses = 12; 
						$mes_agosto = 1;
					}
					else{ 
						$meses = 0;
						$mes_agosto = 0; 
			}}}
			else{ 
				$meses = 0;
				$mes_agosto = 0; 
		}}
	
		$fecha_auditoria = explode("-", $row['fecha_auditoria']);
		$ano_auditoria = $fecha_auditoria[0];
		
		if($ano_auditoria == $anno){ $auditoria = 1; }
		else{ $auditoria = 0; }
		
		if($auditoria == '1'){
			if($mes_agosto == '1'){
				$meses = $meses - 1;
				$horas_agosto = $row['horas_mes'] / 4;
				$h_asignadas = ($row['horas_mes'] * $meses) + $row['horas_auditoria'] + $row['horas_visita_previa'] + $horas_agosto;
			}
			else{ $h_asignadas = ($row['horas_mes'] * $meses) + $row['horas_auditoria'] + $row['horas_visita_previa']; }
		}
		else{
			if($mes_agosto == '1'){
				$meses = $meses - 1;
				$horas_agosto = $row['horas_mes'] / 4;
				$h_asignadas = ($row['horas_mes'] * $meses) + $horas_agosto;
			}
			else{ $h_asignadas = ($row['horas_mes'] * $meses); }	
		}
	}
	return($h_asignadas);
}

function cambiar_pass($actual, $nueva, $nueva_2){
       $link = conectar(BBDD);
       $sql = "SELECT codigo FROM clientes WHERE bbdd='".$_SESSION[APLICACION_.'bbdd']."'";
       $rs = mysql_query($sql);
       if(mysql_num_rows($rs)>0){
               $row = mysql_fetch_assoc($rs);
               $empresa = $row['codigo'];
               desconectar($link);
       }
       $link = conectar($_SESSION[APLICACION_.'bbdd']);
       if(($actual == '') || ($nueva == '') || ($nueva_2 == '')){
               $mensaje .= "<hr>ERROR. Faltan datos por introducir<hr>";
               return($mensaje);
               desconectar($link);
       }
       else{
               $actual_md5 = md5($actual);
               $sql2 = "SELECT clave, email FROM kz_te_usuarios WHERE usuario='".$_SESSION[APLICACION_.'user']."'";
               $rs2 = mysql_query($sql2);
               if(mysql_num_rows($rs2)>0){
                       $row2 = mysql_fetch_assoc($rs2);
                       if($row2['clave'] == $actual_md5){
                               if($nueva == $nueva_2){
                                       mysql_query("UPDATE kz_te_usuarios SET clave = '".md5($nueva)."' WHERE usuario='".$_SESSION[APLICACION_.'user']."'");
										//echo "UPDATE kz_te_usuarios SET clave = '".md5($nueva)."' WHERE usuario='".$_SESSION[APLICACION_.'user']."'";
                                       $usuario = $_SESSION[APLICACION_.'user'];
                                       $email = $row2['email'];
                                       $enviar_mail = envio_datos_cambiar_pass($empresa, $usuario, $nueva, $email);
                                       $mensaje .= "<hr>Contrase&ntilde;a modificada correctamente. Se han reenviado los datos para acceder<hr>";
                                       //return($mensaje);
                                       desconectar($link);
                                       session_destroy();
                                       header("Location: ".RUTA_APLICACION);
                               }
                               else{
                                       $mensaje .= "<hr>ERROR. Las nuevas contrase&ntilde;as no coinciden<hr>";
                                       return($mensaje);
                                       desconectar($link);
                               }
                       }
                       else{
                               $mensaje .= "<hr>ERROR. La contrase&ntilde;a actual no coincide<hr>";
                               return($mensaje);
                               desconectar($link);
                       }        
               }
       }
}

function cambiar_logo($logo){
	
       $link = conectar(BBDD);
       if($logo){
               $bbdd_empresa = $_SESSION[APLICACION_.'bbdd'];
               $seleccionar_cliente="SELECT c.id FROM clientes c, logos l WHERE c.bbdd='".$bbdd_empresa."' AND c.id=l.id_cliente";
               $rs = mysql_query($seleccionar_cliente);
               if($row = mysql_fetch_assoc($rs)){
                       $archivo = $logo["tmp_name"];
                          $tipo    = $logo["type"];
                          $tamano  = $logo["size"];
                          if(is_uploaded_file($archivo)&&($tipo=='image/gif'||$tipo=='image/jpeg')){
                                  $fp = fopen($archivo, "rb");
                               $contenido = fread($fp, $tamano);
                                  $contenido = addslashes($contenido);
                                  fclose($fp);
                                  mysql_query("UPDATE logos SET contenido='".$contenido."', tipo='".$tipo."', tamano='".$tamano."' WHERE id_cliente='".$row['id']."'");
                                  $mensaje .= "<hr>El logo se ha sustituido correctamente<hr>";
                                  return($mensaje);
                          }
                          else{
                                  $mensaje .= "<hr>No has seleccionado ning&uacute;n logo<hr>";
                                  return($mensaje);
                          }
               }
               else{
                       $cliente="SELECT id FROM clientes WHERE bbdd='".$bbdd_empresa."'";
                       $rs = mysql_query($cliente);
                       if($row = mysql_fetch_assoc($rs)){
                               $archivo = $logo["tmp_name"];
                                  $tipo    = $logo["type"];
                                  $tamano  = $logo["size"];
                                  if(is_uploaded_file($archivo)&&($tipo=='image/gif'||$tipo=='image/jpeg')){
                                          $fp = fopen($archivo, "rb");
                                          $contenido = fread($fp, $tamano);
                                          $contenido = addslashes($contenido);
                                          fclose($fp);
                                          mysql_query("INSERT INTO logos (id_cliente, contenido, tipo, tamano) VALUES ('".$row['id']."', '".$contenido."', '".$tipo."', '".$tamano."')");
                                          $mensaje .= "<hr>El logo se ha subido correctamente<hr>";
                                          return($mensaje);
                                  }
                       }
               }
       }
       desconectar($link);
}

function envio_datos_cambiar_pass($nombre, $usuario, $clave, $email){
       include(EMAIL_RUTA."class.phpmailer.php");
       include(EMAIL_RUTA."class.smtp.php");
       
       $mail = new PHPMailer();
       $mail->IsSMTP();
       $mail->SMTPAuth = true;
       $mail->SMTPSecure = "ssl";
       $mail->Host = "smtp.gmail.com";
       $mail->Port = 465;
       $mail->Username = "adeada.kz@gmail.com";
       $mail->Password = "adeada.kz01";
       $mail->From = "adeada.kz@gmail.com";  
       $mail->FromName = "ADEADA";  
       $mail->Subject = "Acceso a ADEADA Talleres Electricos";  
       $mail->AltBody = "Acceso a ADEADA Talleres Electricos";  
       $mail->MsgHTML('La contraseña se ha modificado correctamente. Estos son los datos actuales para acceder a la aplicación:<br><br>Dirección aplicación: '.RUTA_APLICACION.'<br><br>Empresa: '.$nombre.'<br>Usuario: '.$usuario.'<br>Contraseña: '.$clave.'<br><br>---<br>ADEADA');
       $mail->AddAddress($email);
       $mail->IsHTML(true);
       
       if(!$mail->Send()) {
               echo "Error: " . $mail->ErrorInfo;
       }
}

include(ROOT_DIR."functions/variables.php"); ?>
