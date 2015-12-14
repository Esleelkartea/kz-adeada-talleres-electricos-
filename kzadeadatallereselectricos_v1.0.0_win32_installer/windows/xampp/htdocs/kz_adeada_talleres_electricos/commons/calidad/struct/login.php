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

session_start();
session_destroy();

if(isset($_POST['loguearse'])){
	$bbdd_empresa = validar_acceso($_POST['login_empresa'], $_POST['login_usuario'], $_POST['login_pass']);
	if($bbdd_empresa){
		session_start();
		$_SESSION[APLICACION_.'gt_usuario'] = $_POST['login_usuario'];
		$_SESSION[APLICACION_.'gt_empresa'] = $bbdd_empresa[1]['codigo'];
		$_SESSION[APLICACION_.'gt_bbdd'] = $bbdd_empresa[0];
		header('location: welcome.php');
	}
	else{
		$SYS_mensaje = "Login incorrecto";
	}
}
else{
	if(isset($_SESSION[APLICACION_.'gt_usuario'])){
		if(!validar_acceso($_SESSION[APLICACION_.'gt_empresa'], $_SESSION[APLICACION_.'gt_usuario'], $_SESSION[APLICACION_.'gt_pass'])){
			header('location: ../../index.php');
		}
	}
}
?>
