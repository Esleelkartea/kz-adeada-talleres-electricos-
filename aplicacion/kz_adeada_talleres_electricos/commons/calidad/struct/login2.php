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
$_SESSION[APLICACION_.'gt_usuario']=$_SESSION[APLICACION_.'user'];
$_SESSION[APLICACION_.'gt_empresa']=$_SESSION[APLICACION_.'empresa'];
$_SESSION[APLICACION_.'gt_pass']=$_SESSION[APLICACION_.'pass'];
//$_SESSION['nombre_usuario'] = $datos_login['nombre'];

if(isset($_SESSION[APLICACION_.'gt_usuario'])){
	if(validar_acceso($_SESSION[APLICACION_.'gt_empresa'], $_SESSION[APLICACION_.'gt_usuario'], $_SESSION[APLICACION_.'gt_pass'])==1){
		header('location: ../../index.php');
	}
}
else {
	if(file_exists('../../index.php'))
		header('location: ../../index.php');
	else header('location: ../../../index.php');
}
define("BBDDUSUARIO",$_SESSION['gisper_bbdd']);
//define("BBDDUSUARIO",$_SESSION['gt_bbdd']);
?>
