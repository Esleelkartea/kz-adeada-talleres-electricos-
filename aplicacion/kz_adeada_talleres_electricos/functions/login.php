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
function comprobar_login($empresa,$usuario, $password){
	
	$link = conectar(BBDD);
	$sql = "SELECT bbdd FROM clientes WHERE codigo= '$empresa'";
	$rs = mysql_query($sql);
	if(mysql_num_rows($rs)==0){
		mysql_close($link);
		return(1);
	}
	else{
		$row = mysql_fetch_assoc($rs);
		$bbdd=$row['bbdd'];
		mysql_close($link);
		$link = conectar($bbdd);
		$sql = "SELECT * FROM kz_te_usuarios WHERE usuario LIKE '$usuario' AND clave LIKE '".md5($password)."'";
		$rs = mysql_query($sql);
		if(mysql_num_rows($rs)==0)
		return(1);
		else{
			$row = mysql_fetch_assoc($rs);
			$row['bbdd']=$bbdd;
			return($row);
		}
	}
	
}

function recordar_password($empresa, $email){
	$link = conectar(BBDD);
	if(($empresa == '') || ($email == '')){
		$mensaje .= "<div class='error'>ERROR. No has introducido algunos de los datos</div>";
		return($mensaje);
		desconectar($link);
	}else{
		$sql = "SELECT bbdd FROM clientes WHERE codigo = '".$empresa."'";
		$rs = mysql_query($sql);
		if(mysql_num_rows($rs)>0){
			$row = mysql_fetch_assoc($rs);
			$link = conectar($row['bbdd']);
			$sql2 = "SELECT usuario FROM kz_te_usuarios WHERE email='".$email."'";
			$rs2 = mysql_query($sql2);
			if(mysql_num_rows($rs2)>0){
				$row2 = mysql_fetch_assoc($rs2);
				$clave = "i".uniqid();
				mysql_query("UPDATE kz_te_usuarios SET clave = '".md5($clave)."' WHERE email='".$email."'");
				$enviar_mail = envio_datos_recordar($empresa, $row2['usuario'], $clave, $email);
				$mensaje .= "<div class='error'>Se ha generado una nueva contrase&ntilde;a y se han reenviado los datos para acceder (La contrase&ntilde;a podr&aacute; modificarse cuando se acceda a la aplicaci&oacute;n)</div>";
				return($mensaje);
				desconectar($link);
			}
			else{
				$mensaje .= "<div class='error'>ERROR. Comprueba que el e-mail es correcto</div>";
				return($mensaje);
				desconectar($link);
			}        
		}
		else{
			$mensaje .= "<div class='error'>ERROR. No existe ninguna empresa registrada con ese nombre</div>";
			return($mensaje);
			desconectar($link);
		}
	}

}

function envio_datos_recordar($nombre, $usuario, $pass, $email){
	
	
	
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
       $mail->MsgHTML('Se ha asignado una nueva contraseña. Estos son los datos actuales para acceder a la aplicación:<br><br>Dirección aplicación: '.RUTA_APLICACION.'<br><br>Empresa: '.$nombre.'<br>Usuario: '.$usuario.'<br>Contraseña: '.$pass.'<br><br>*La contraseña podrá modificarse cuando se acceda a la aplicación<br><br>---<br>ADEADA');
       $mail->AddAddress($email);
       $mail->IsHTML(true);
       
       if(!$mail->Send()) {
               echo "Error: " . $mail->ErrorInfo;
       }
}

function recoger_accesos($perfil, $sistema){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$info_perfil = info_perfil($perfil);
	$info_accesos = explode(',',$info_perfil['accesos']);
	$info_permisos = explode(',',$info_perfil['permisos']);
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "Select * from kz_te_s_secciones order by id";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		$sql2 = "Select * from kz_te_s_accesos where acc_ini = ".$row['id']." $criterios order by acc_orden";
		$rs2 = mysql_query($sql2);
		while($row2 = mysql_fetch_assoc($rs2)){
			if(in_array($row2['acc_num'],$info_accesos)){
				$res['MENU'][$row['nombre']][$row2['acc_num']] = $row2;
				$sql3 = "Select * from kz_te_s_permisos where perm_acceso = ".$row2['acc_num'];
				$rs3 = mysql_query($sql3);
				while($row3 = mysql_fetch_assoc($rs3)){
					
				}
			}
		}
	}
	mysql_close($link);
	$res['ACCESOS'] = $info_accesos;
	$res['PERMISOS'] = $info_permisos;
	return($res);
}

function validar_registro($nombre, $email, $usuario, $pass, $pass_2){
 	$link = conectar(BBDD);
    if(($nombre == '') || ($email == '') || ($usuario == '') || ($pass == '') || ($pass_2 == '')){
        $mensaje .= "<div class='error'>ERROR. Faltan datos por introducir</div>";
        return($mensaje);
        desconectar($link);
    }
    else{
        if($pass == $pass_2){
            $sql = "SELECT nombre FROM clientes WHERE nombre = '".$nombre."'";
            $rs = mysql_query($sql);
            if(mysql_num_rows($rs)>0){
                $mensaje .= "<div class='error'>ERROR. Esta empresa ya est&aacute; registrada</div>";
                return($mensaje);
                desconectar($link);
            }
            else{
                $sql2 = "SELECT id FROM sys_correos WHERE correo = '".$email."'";
                $rs2 = mysql_query($sql2);
                if(mysql_num_rows($rs2)>0){
                    $nombre_cliente = str_replace(" ", "", $nombre);
                    mysql_query("INSERT INTO clientes (codigo, nombre, bbdd, fecha_alta) VALUES ('".$nombre_cliente."', '".$nombre."', 'kz_adeada_talleres_electricos_".$nombre_cliente."', '".date("Y-m-d")."')");
                    $cliente_insertado = mysql_insert_id();
                    $crear_bbdd = crear_nueva_bbdd("kz_adeada_talleres_electricos_".$nombre_cliente);
                    $link = conectar("kz_adeada_talleres_electricos_".$nombre_cliente);
                    mysql_query("INSERT INTO kz_te_usuarios (nombre, usuario, clave, email,perfil) VALUES ('".$usuario."', '".$usuario."', '".md5($pass)."', '".$email."', 1)");
                    $obtener_id_usuario="SELECT id FROM kz_te_usuarios";
                    $rs3 = mysql_query($obtener_id_usuario);
                    while($row3 = mysql_fetch_assoc($rs3)){
						foreach($row3 as $key3 => $valor3){
	                    	mysql_query("INSERT INTO kz_te_personal (nombre, email, usuario) VALUES ('".$usuario."', '".$email."', '".$valor3."')");
						}
                    }
                    $mensaje .= "<div class='error'>Registro realizado correctamente. Se ha enviado un e-mail con los datos para acceder a la aplicaci&oacute;n</div>";
                    $enviar_mail = envio_datos($nombre_cliente, $usuario, $pass, $email);
                    desconectar($link);
                    return($mensaje);
                }
                else{
                    $mensaje .= "<div class='error'>ERROR. No se ha podido realizar el registro. P&oacute;ngase en contacto con el administrador</div>";
                    return($mensaje);
                    desconectar($link);
                }
            }
        }
        else{
            $mensaje .= "<div class='error'>ERROR. Las contrase&ntilde;as no coindiden</div>";
            return($mensaje);
            desconectar($link);
        }
    }
}

function crear_nueva_bbdd($nombre_bbdd){
       $link = mysql_connect("localhost", BBDDUSUARIO, BBDDPASS);
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

function importar_sql($bbdd){
       $link = mysql_connect("localhost", BBDDUSUARIO, BBDDPASS);
       mysql_select_db($bbdd);
       if(file_exists('../bbdd/kz_adeada_importar.sql')){
               $sql = explode(';', file_get_contents ('../bbdd/kz_adeada_importar.sql'));
               $n = count ($sql) - 1;
               for ($i = 0; $i < $n; $i++){
                       $query = $sql[$i];
                       $result = mysql_query ($query)
                       or die ('<p>Se ha producido un error al crear la base de datos de la empresa</p>');
               }
       }
       else{
               echo "El archivo kz_adeada_importar.sql no se ha podido encontrar";
       }
}

function envio_datos($nombre, $usuario, $pass, $email){
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
    $mail->MsgHTML('El registro se ha realizado correctamente. Estos son los datos para acceder a la aplicación:<br><br>Dirección aplicación: '.RUTA_APLICACION.'<br><br>Empresa: '.$nombre.'<br>Usuario: '.$usuario.'<br>Contraseña: '.$pass.'<br><br>---<br>ADEADA');
    $mail->AddAddress($email);
    $mail->IsHTML(true);
   
    if(!$mail->Send()) {
        echo "Error: " . $mail->ErrorInfo;
    }
}


function recoger_accesos_2($perfil, $sistema, $seccion){
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$info_perfil = info_perfil($perfil);
	$info_accesos = explode(',',$info_perfil['accesos']);
	$info_permisos = explode(',',$info_perfil['permisos']);
	$link = conectar($_SESSION[APLICACION_.'bbdd']);
	$sql = "Select * from kz_te_s_secciones where id = '".$seccion."' order by id";
	
	
	
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		$sql2 = "Select * from kz_te_s_accesos where acc_ini = ".$row['id']." $criterios order by acc_orden";
		$rs2 = mysql_query($sql2);
		while($row2 = mysql_fetch_assoc($rs2)){
			if(in_array($row2['acc_num'],$info_accesos)){	
				$res['MENU'][$row['nombre']][$row2['acc_num']] = $row2;
				$sql3 = "Select * from kz_te_s_permisos where perm_acceso = ".$row2['acc_num'];
				$rs3 = mysql_query($sql3);
				while($row3 = mysql_fetch_assoc($rs3)){
					
				}
			}
		}
	}
	mysql_close($link);
	$res['ACCESOS'] = $info_accesos;
	$res['PERMISOS'] = $info_permisos;
	return($res);
}

function info_perfil($perfil){
	$sql = "Select * from kz_te_s_perfil where id = $perfil";
	$rs = mysql_query($sql);
	$row = mysql_fetch_assoc($rs);
	return($row);
}

function persona_relacionada($usuario){
	$datos_persona = select_normal("Select * from kz_te_personal where usuario = $usuario");
	return($datos_persona[0]);	
} ?>
