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
<?php session_start();
include("../functions/globales.php");
include("../root.php");

//CAPTURA DE LA VARIABLE DE PAGINA
if(!$_POST['pag']) $pag = '../commons/menu';
$pag = $_POST['pag'];

if(!isset($_COOKIE['gisper_sistema'])){
	header('Location: ../index.php');
}

include("../functions/funciones.php");
//include("../functions/proyectos.php");
include("../forms/login.php"); ?>

<body>
  <?php if($_POST['log_nombre']){
		$datos_login = comprobar_login($_POST['log_empresa'],$_POST['log_nombre'], $_POST['log_password']);
		if($datos_login != 1){
			$_SESSION[APLICACION_.'bbdd']=$datos_login['bbdd'];
			$_SESSION[APLICACION_.'empresa']=$_POST['log_empresa'];
		  	$_SESSION[APLICACION_.'user'] = $_POST['log_nombre'];
		  	$_SESSION[APLICACION_.'pass'] = $_POST['log_password'];
		  	$_SESSION[APLICACION_.'nombre_usuario'] = $datos_login['usuario'];
		  	$_SESSION[APLICACION_.'perfil'] = $datos_login['perfil'];
		}
  	}
  
	if($_POST['enviar_password']){
		$mensaje = recordar_password($_POST['recordar_empresa'], $_POST['recordar_email']);
	}
  
	if($_POST['registrarse']){
  		$mensaje = validar_registro($_POST['registrar_empresa'], $_POST['registrar_email'],$_POST['registrar_usuario'],$_POST['registrar_password'],$_POST['registrar_repetir_password']);
  	}
  
    //SI NO HAY SESION O ES INCORRECTA
	if(!$_SESSION[APLICACION_.'user'] || comprobar_login($_SESSION[APLICACION_.'empresa'],$_SESSION[APLICACION_.'user'], $_SESSION[APLICACION_.'pass']) == '1'){?>
  
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
		<head>
			<!-- Personalizacion -->
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			<link rel="icon" type="image/x-icon" href="../img/favicon.ico" />
			<title>Adeada Talleres El&eacute;ctricos</title>
	
			<!-- Descripcion y tags -->
			<meta name="title" content="Adeada Talleres Electricos"></meta>
			<meta name="description" content="Adeada Talleres Electricos"></meta>
			<meta name="keywords" content="Adeada Talleres Electricos"></meta>
			
			<!-- CSS -->
			<link href="../css/login.css" rel="stylesheet" type="text/css" media="screen"/>
			<link href="<?php echo JS_RUTA_NIVEL1."themes/default.css";?>" rel="stylesheet" type="text/css"/>	
			<link href="<?php echo JS_RUTA_NIVEL1."themes/alert.css";?>" rel="stylesheet" type="text/css"/>
			<script type="text/javascript" src="<?php echo JS_RUTA_NIVEL1."javascripts/prototype.js";?>"> </script>
			<script type="text/javascript" src="<?php echo JS_RUTA_NIVEL1."javascripts/effects.js";?>"> </script>
			<script type="text/javascript" src="<?php echo JS_RUTA_NIVEL1."javascripts/window.js";?>"> </script>
		</head>
		
		<body>
	     	<div class="logo">
	        	<img src="../img/adeada-talletes-electricos.jpg" alt="Adeada Talleres El&eacute;ctricos" />
	        </div>
            <?php if($_GET['opcion']=="recordar"){?>
            	<div id="cont-acceso">
            		<div id="acceso-bg-top">
            		<form id="form-acceso" name="login" method="post" action='index.php?opcion=recordar'>
						<fieldset>
		                    <legend><?php echo "Nueva clave";?></legend>
		                    <p>
		                        <label for="empresa"><?php echo "empresa"; ?></label>
		                        <input class="input-comun" title="empresa" name="recordar_empresa" type="text" id="empresa" />
		                    </p>
		                    <p>
		                        <label for="email"><?php echo "email"; ?></label>
		                        <input class="input-comun" title="email de usuario" name="recordar_email" type="text" id="email" />
		                    </p>
		                    <?php echo $mensaje;?>
		                    <p class="align-right">
		                        <input class="bt-comun" type="submit" name="enviar_password" value="<?php echo "enviar"?>" />
		                    </p>
		                </fieldset>
	                </form>
	            	</div>
       			</div>
       			 <form name="login" method="post" action='index.php'>
                	<input class="bt-volver" type="submit" name="volver" value="<?php echo "volver"?>" />
                </form>
			<?php }
			elseif($_GET['opcion']=="registrarse"){?>
				<div id="cont-acceso">
					<div id="acceso-bg-top">
	            		<form id="form-acceso" name="login" method="post" action='index.php?opcion=registrarse'>
							<fieldset>
			                    <legend><?php echo "Registro"; ?></legend>
			                    <p>
			                        <label for="empresa"><?php echo "empresa"; ?></label>
			                        <input class="input-comun" title="empresa" name="registrar_empresa" type="text" id="empresa" />
			                    </p>
			                    <p>
			                        <label for="email"><?php echo "email"; ?></label>
			                        <input class="input-comun" title="email de usuario" name="registrar_email" type="text" id="email" />
			                    </p>
			                    <p>
			                        <label for="usuario"><?php echo "usuario"; ?></label>
			                        <input class="input-comun" title="nombre de usuario" name="registrar_usuario" type="text" id="usuario" />
			                    </p>
			                    <p>
			                        <label for="password"><?php echo "contrase&ntilde;a"; ?></label>
			                        <input class="input-comun" title="password" name="registrar_password" type="password" id="password" />
			                    </p>
			                    <p>
			                        <label for="repetir_password"><?php echo "repetir contrase&ntilde;a"; ?></label>
			                        <input class="input-comun" title="repetir password" name="registrar_repetir_password" type="password" id="repetir_password" />
			                    </p>
			                    <?php echo $mensaje;?>
			                    <p class="align-right">
			                        <input class="bt-comun" type="submit" name="registrarse" value="<?php echo "registrarse"?>" />
			                    </p>
			                </fieldset>
		                </form>
		            </div>
       			</div>
       			<form name="login" method="post" action='index.php'>
                	<input class="bt-volver" type="submit" name="volver" value="<?php echo "volver"?>" />
                </form>
			<?php } 
			else{?>
				<div id="cont-acceso">
					<div id="acceso-bg-top">
	            		<form id="form-acceso" name="login" method="post" action='index.php'>
		               		<fieldset>
			                    <legend><?php echo "Zona de acceso"; ?></legend>
			                    <p>
			                        <label for="empresa"><?php echo "empresa"; ?></label>
			                        <input class="input-comun" title="empresa" name="log_empresa" type="text" id="empresa" />
			                    </p>
			                    <p>
			                        <label for="usuario"><?php echo "usuario"; ?></label>
			                        <input class="input-comun" title="nombre de usuario" name="log_nombre" type="text" id="usuario" />
			                    </p>
			                    <p>
			                        <label for="password"><?php echo "contrase&ntilde;a"; ?></label>
			                        <input class="input-comun" title="contrase&ntilde;a" name="log_password" type="password" id="password" />
			                    </p>
			                    <a class="align-center" href="index.php?opcion=recordar">&iquest;Has olvidado la contrase&ntilde;a?</a> &#149; 
			                    <a class="align-center" href="index.php?opcion=registrarse">Registrarse</a>
			                  	<?php echo $mensaje;?>
			                    <p class="align-right">
			                        <input class="bt-comun" type="submit" name="identificar_castellano" value="<?php echo "entrar"?>" />
				                </p>
			                </fieldset>	
			            </form>
	        		</div>
        		</div>
            <?php }?>			
		</body>
	</html>
<?php }else{
		$datos_usuario = comprobar_login($_SESSION[APLICACION_.'empresa'],$_SESSION[APLICACION_.'user'], $_SESSION[APLICACION_.'pass']);
		$datos_perfil = recoger_accesos($_SESSION[APLICACION_.'perfil'],$_COOKIE['gisper_sistema']);
		$ID_PERSONA = persona_relacionada($datos_usuario['id']); ?>
		
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo substr($_SESSION[APLICACION_.'aplicacion_idioma'],0,2);?>" lang="es">
		<head>
			<!-- Personalizacion -->
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			<link rel="icon" type="image/x-icon" href="../img/favicon.ico" />
			<title>Adeada Talleres Electricos</title>
	
			<!-- Descripcion y tags -->
			<meta name="title" content="Adeada Talleres Electricos" />
			<meta name="description" content="Adeada Talleres Electricos" />
			<meta name="keywords" content="Adeada Talleres Electricos" />
			
			<!-- Idioma -->
			<meta http-equiv="content-language" content="es" />
			
			<!-- Menu -->
			<link rel="start" href="index.php?menu=bienvenido" />
			<link rel="help" href="index.php?menu=ayuda" />
			<link rel="contents" href="index.php?menu=mapa" />
			<link rel="copyright" href="index.php?menu=privacidad" />
	 
	 		<!-- CSS -->
			<link href="../css/formateo.css" rel="stylesheet" type="text/css" />
			<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
			
			<link href="<?php echo JS_RUTA_NIVEL1."themes/default.css";?>" rel="stylesheet" type="text/css"/>	
			<link href="<?php echo JS_RUTA_NIVEL1."themes/alert.css";?>" rel="stylesheet" type="text/css"/>
			<script type="text/javascript" src="<?php echo JS_RUTA_NIVEL1."javascripts/prototype.js";?>"> </script>
			<script type="text/javascript" src="<?php echo JS_RUTA_NIVEL1."javascripts/effects.js";?>"> </script>
			<script type="text/javascript" src="<?php echo JS_RUTA_NIVEL1."javascripts/window.js";?>"> </script>
	
		</head>
		
		<body>
			<div id="general">
				<div id="cabecera">
					<div id="desconectarse">
						<p>Bienvenid@ <?php echo $_SESSION[APLICACION_.'nombre_usuario']; ?></p>
							<form action='index.php' method='post' id='cambiar_password' >
								<a style="cursor:pointer;" onclick="$('cambiar_password').submit();">Cambiar contrase&ntilde;a/logo</a>
								<input type='hidden' name='pag' value='../commons/modificar_clave_logo' />
							</form>
						<br />
						<a href="index.php?desconectar=true">desconectarse</a>
					</div>
					<div id="logo"> 
						<h1>
							<a href="index.php"><img src="../img/adeada-talletes-electricos.jpg" alt="Adeada Talleres El&eacute;ctricos" /></a>
						</h1>
					</div>
					<div id="logo2"> 
						<img  src="../commons/mostrar_logo.php" width="200px" alt="logo de la empresa"></img>
					</div>
				</div>	
<?php } ?>