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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<!-- Personalizacion -->
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="icon" type="image/x-icon" href="../img/favicon.ico" />
		<title>Adeada Talleres El&eacute;ctricos</title>

		<!-- Descripcion y tags -->
		<meta name="title" content="Aplciaci&oacute;n" />
		<meta name="description" content="Aplicaci&oacute;n" />
		<meta name="keywords" content="aplicacion" />
		
		<!-- Idioma -->
		<meta http-equiv="content-language" content="<?php echo substr($_SESSION[APLICACION_.'aplicacion_idioma'],0,2);?>" />
 
 		 		<!-- CSS -->
		<link href="../../../css/formateo.css" rel="stylesheet" type="text/css" />
		<link href="../../../css/estilos.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="<?php echo JS_RUTA_NIVEL1."excanvas.js";?>"></script> 
		<script type="text/javascript" src="<?php echo JS_RUTA_NIVEL1."jquery.js";?>"></script>    
		<script type="text/javascript" src="<?php echo JS_RUTA_NIVEL1."jquery.corner.js";?>"></script>
		<script type="text/javascript" src="<?php echo JS_RUTA_NIVEL1."jquery.validate.min.js";?>"></script> 
		<script type="text/javascript" src="<?php echo JS_RUTA_NIVEL1."validador.js";?>"></script> 
		<script type="text/javascript" src="<?php echo JS_RUTA_NIVEL1."jscal2.js";?>"></script>
		<script type="text/javascript" src="<?php echo JS_RUTA_NIVEL1."jscal2/lang/es.js";?>"></script>
		<script type="text/javascript" src="<?php echo JS_RUTA_NIVEL1."jqtransformplugin/jquery.jqtransform.min.js";?>"></script>
		<script type="text/javascript" src="<?php echo JS_RUTA_NIVEL1."jquery.windows-engine.js";?>"></script>
		<LINK REL=StyleSheet HREF="<?php echo CAL_RUTA_NIVEL1."jscal2.css";?>" TYPE="text/css" MEDIA=screen>
		<LINK REL=StyleSheet HREF="<?php echo CAL_RUTA_NIVEL1."border-radius.css";?>" TYPE="text/css" MEDIA=screen>
		<LINK REL=StyleSheet HREF="<?php echo CAL_RUTA_NIVEL1."matrix/matrix.css";?>" TYPE="text/css" MEDIA=screen>
		<script src="SpryAssets/SpryAccordion.js" type="text/javascript"></script>
		<script type="text/javascript">
	</script>
</head>

<body>
<div id="general">
	<div id="cabecera">
		  <div id="desconectarse">
			Bienvenid@
			<?php $usuario = select_normal("SELECT * FROM kz_te_usuarios WHERE usuario = '".$_SESSION[APLICACION_.'gt_usuario']."'");?>
			<span class="nomrbre_color"><?php echo $usuario[0]['usuario']; ?></span>
			<br />
			<a href="../cambiar_pass.php">(Cambiar contrase&ntilde;a/logo)</a>
			<p><a href="../../../index/index.php?desconectar=true">[desconectarse]</a></p>
		  </div>
		
		   <div id="logo"> 
			<h1>
				<a href="../../../index/index.php"><img src="../img/adeada-talletes-electricos.jpg" alt="Adeada Talleres El&eacute;ctricos" /></a>
			</h1>
			</div>
			<div id="logo2"> 
				<img src="../../../commons/mostrar_logo.php" width="200px" alt="logo de la empresa"></img>
			</div>
	</div>
	<div id="menu_principal">
		<ul>
			<li><a href="../documentacion.php" id='lnk_documentacion'>Documentaci&oacute;n</a></li>
			<li><a href="../direccion.php" id='lnk_direccion'>Direcci&oacute;n</a></li>
			<li><a href="../rrhh.php" id='lnk_rrhh'>Formaci&oacute;n</a></li>
		    <li><a href="../mantenimiento.php" id='lnk_mantenimiento'>Maquinaria</a></li>
		   	<li><a href="../mejora.php" id='lnk_mejora'>Mejora</a></li>
		   	<li id="ir-ainicio"><a href="../../../index/index.php">Volver</a></li>
		</ul> 
	</div>
    <div id="submenu">
    	<ul>
			<li><a id='lnk_ver_objetivos' href="ver_objetivos.php">Objetivos</a>|</li>
			<li><a id='lnk_ver_reuniones' href="ver_reuniones.php">Reuniones </a>|</li>
			<li><a id='lnk_ver_revisiones' href="ver_revisiones_calidad.php">Revisi&oacute;n por la direcci&oacute;n</a>|</li>
			<li><a id='lnk_ver_politicas' href="ver_politicas.php">Pol&iacute;tica de calidad</a>|</li>
		    <li><a id='lnk_informes' href="informes.php">Informes</a></li>
		</ul>
	</div>
 
  <div id="contenido">