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
 * Descripcion: Funcion de conexion a la Base de Datos
 * Parametros: Nombre de la Base de Datos de control
 * Devuelve: Conexion, 1 eoc
*/
function conectar($bbdd){
	$link = mysql_connect("localhost", "root", BBDDPASS);
	
	if(mysql_select_db($bbdd, $link)){
		return($link);
	}
	else return(1);
}

/*
 * Descripcion: Funcion de desconexion de la Base de Datos
 * Parametros: Conexion establecida con la Base de Datos
 * Devuelve: 0, 1 eoc
*/
function desconectar($link){
	if(mysql_close($link)) return(0); else return(1); 
}

/*
 * Descripcion: Funcion para la creacion de una nueva Base de Datos cuando se realiza el registro de una nueva empresa
 * Parametros: Nombre de la Base de Datos de la empresa que se registra
 * Devuelve: -1 eoc
*/
function crear_nueva_bbdd($nombre_bbdd){
	$link = mysql_connect("localhost", "root", BBDDPASS);
	if(!$link){
	    die('No pudo conectarse: ' . mysql_error());
	}
	
	$sql = 'CREATE DATABASE '.$nombre_bbdd;
	if(mysql_query($sql, $link)){
		mysql_close($link);
		$importar = importar_sql($nombre_bbdd);
	}
	else{
		return -1;
	}
}

/*
 * Descripcion: Funcion para la importacion de la Base de Datos base para las empresas que se registren
 * Parametros: Nombre de la Base de Datos de la empresa que se registra
 * Devuelve: void
*/
function importar_sql($bbdd){
	$link = mysql_connect("localhost", "root", BBDDPASS);
	mysql_select_db($bbdd);
	if(file_exists('bbdd/kz_instagi_e_importar.sql')){
		$sql = explode(';', file_get_contents ('bbdd/kz_instagi_e_importar.sql'));
		$n = count ($sql) - 1;
		for ($i = 0; $i < $n; $i++){
			$query = $sql[$i];
			$result = mysql_query ($query)
			or die ('<p>Se ha producido un error al crear la base de datos de la empresa</p>');
		}
	}
	else{
		echo "El archivo kz_instagi_e_importar.sql no se ha podido encontrar";
	}
}

/*
 * Descripcion: Funcion para el login y comprobacion de la validacion
 * Parametros: Nombre de la empresa, usuario, password
 * Devuelve: Array con el nombre de la Base de Datos de la empresa y los usuarios, null eoc
*/
function validar_acceso($empresa, $usuario, $password){
	$link = conectar(BBDD);
	$sql = "Select * from clientes where codigo = '".$_POST['login_empresa']."'";
	$loginrs = mysql_query($sql);
	if(mysql_num_rows($loginrs)>0){
		$row = mysql_fetch_assoc($loginrs);
		desconectar($link);
		$bbdd = $row['bbdd'];
		$link = conectar($row['bbdd']);
		
		$sql = "Select * from kz_te_usuarios where usuario = '$usuario' and clave = '".md5($password)."'";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		desconectar($link);
		if($row) return(array($bbdd,$row));
		else return;
	}
	else return;
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
       $mail->Host = _EMAIL_HOST;
       $mail->Port = _EMAIL_PUERTO;
       $mail->Username = _EMAIL_USER;
       $mail->Password = _EMAIL_PASS;
       $mail->From = _EMAIL_USER;  
       $mail->FromName = _EMAIL_NAME;  
       $mail->Subject = "Acceso a ADEADA Talleres Electricos";  
       $mail->AltBody = "Acceso a ADEADA Talleres Electricos";  
       $mail->MsgHTML('La contraseña se ha modificado correctamente. Estos son los datos actuales para acceder a la aplicación:<br><br>Dirección aplicación: '.RUTA_APLICACION.'<br><br>Empresa: '.$nombre.'<br>Usuario: '.$usuario.'<br>Contraseña: '.$clave.'<br><br>---<br>ADEADA');
       $mail->AddAddress($email);
       $mail->IsHTML(true);
       
       if(!$mail->Send()) {
               echo "Error: " . $mail->ErrorInfo;
       }
}

/*
 * Descripcion: Funcion para cargar un combo con el valor del campo ya seleccionado
 * Parametros: Array de valores para el combo, valor del campo
 * Devuelve: void
*/
function combo_base_array($array, $sel){
	foreach($array as $key => $valor){
		if($valor == $sel){ $selec = "SELECTED"; } else { $selec = ""; }
		echo "<option value='$valor' ".$selec." >$valor</option>";
	}
}

/*
 * Descripcion: Array para cargar un combo con todos los meses del anno
*/
$array_meses = array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');

/*
 * Descripcion: Array para cargar un combo con todos los meses de anno en formato abreviado
*/
$arraymeses = array('','ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC');

/*
 * Descripcion: Array para cargar un combo con todos los meses de anno en formato numerico
*/
$array_meses_num = array('1','2','3','4','5','6','7','8','9','10','11','12');

/*
 * Descripcion: Array para cargar un combo con los annos. En este caso, desde 1950 hasta 2049
*/
for($i = 1950; $i < 2050; $i++){
	$array_annos[$i] = $i;
}

/*
 * Descripcion: Array para cargar un combo con annos. En este caso, desde 0 hasta 29
*/
for($i = 0; $i < 30; $i++){
	$array_annos_rev[$i] = $i;
}

/*
 * Descripcion: Array para cargar un combo con todos los meses de anno en formato numerico
*/
for($i = 0; $i < 13; $i++){
	$array_meses_rev[$i] = $i;
}

/*
 * Descripcion: Array para cargar un combo con los dias del mes
*/
for($i = 1; $i < 32; $i++){
	$array_dias_mes[$i] = $i;
}

/*
 * Descripcion: Array para cargar un combo con dias. En este caso, desde 0 hasta 1095
*/
for($i = 0; $i < 1096; $i++){
	$array_dias[$i] = $i;
}

/*
 * Descripcion: Array para cargar el combo con los valores de porcentaje de consecucion
*/
for($i = 0; $i < 101; $i++){
	$array_grado_consecucion[$i] = $i;
}

/*
 * Descripcion: Funcion que devuelve los valores de una consulta
 * Parametros: Consulta a realizar
 * Devuelve: Valores de la consulta, null eoc
*/
function select_normal($consulta){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = $consulta;
	
	$rs = mysql_query($sql);
	$i = 0;
	while($row = mysql_fetch_assoc($rs)){
		foreach($row as $key => $valor){
			$res[$i][$key] = $valor;
		}
		$i++;
	}
	desconectar($link);
	if($res) return($res);
	else return;
}

/*
 * Descripcion: Funcion que realiza la ejecucion de una consulta
 * Parametros: Consulta a ejecutar
 * Devuelve: 0, 1 eoc
*/
function ejecutar_query($query){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	if(mysql_query($query)){
	desconectar($link);
	return(0);
	}
	else{
		desconectar($link);
	 return(1);
	}
}

/*
 * Descripcion: Funcion que devuelve un "SI" o un "NO" dependiendo del valor del campo
 * Parametros: Valor del campo
 * Devuelve: SI si es 1, NO eoc
*/
function siono($numerico){
	if($numerico == 1){
		return('SI');
	}
	else return('NO');
}

/*
 * Descripcion: Funcion que comprueba si un valor es nulo
 * Parametros: Valor del campo
 * Devuelve: Null si el valor esta vacio, valor eoc
*/
function isnul($valor){
	if($valor == ''){
		return('null');
	}
	else return($valor);
}

/*
 * Descripcion: Funcion que devuelve el valor de la pagina seleccionada en la paginacion
 * Parametros: Consulta para contar los registros, cantidad de registros a mostrar por pagina, valor de la pagina actual
 * Devuelve: void
*/
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

/*
 * Descripcion: Funcion que devuelve los identificadores de las No Conformidades
 * Devuelve: Valores de la consulta, void eoc
*/
function array_num_nc(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "Select * from kz_tec_mej_noconformidades";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		$res[$row['id']] = $row['cnc'];
	}
	if($res) return($res);
}

/*
 * Descripcion: Funcion que devuelve los identificadores de los Documentos
 * Devuelve: Valores de la consulta, void eoc
*/
function array_num_doc(){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "Select * from kz_tec_doc_documentos";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		$res[$row['id']] = $row['cod'];
	}
	if($res) return($res);
}

/*
 * Descripcion: Funcion para crear el logotipo temporal de la empresa y mostrarlo en los informes
 * Parametros: Nombre de la Base de Datos de la empresa
 * Devuelve: Nombre del logo, void eoc
*/
function crear_imagen($bbdd){
	define($_SESSION[APLICACION_.'bbdd'],"root");
	
	$conexion = mysql_connect("localhost", "root", BBDDPASS);
	mysql_select_db(BBDD, $conexion);

	$cif_cliente = substr($bbdd, 13);
	$imagen = "SELECT l.contenido, l.tipo FROM logos l, clientes c WHERE c.codigo='".$cif_cliente."' AND c.id=l.id_cliente";
	$rs = mysql_query($imagen);
	if($row = mysql_fetch_assoc($rs)){
		if($row['tipo']=='image/jpeg'){
			$extension="jpg";
		}
		elseif($row['tipo']=='image/gif'){
			$extension="gif";
		}
		$nombre_fichero="../tmp/".uniqid().".".$extension;
		$f=file_put_contents($nombre_fichero,$row['contenido']);
		return($nombre_fichero);
	}
}

/*
 * Descripcion: Funcion para borrar el logotipo temporal de la empresa utilizado para mostrarlo en los informes
 * Parametros: Logotipo
 * Devuelve: void
*/
function borrar_imagen($imagen){
	unlink($imagen);
}
?>