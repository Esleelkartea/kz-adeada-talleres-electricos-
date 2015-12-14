<?php session_start();
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
include("../functions/globales.php");
define(BBDDUSUARIO,"root");
define(BBDDPASS,"");
$conexion = mysql_connect("localhost", "root", BBDDPASS);
mysql_select_db(BBDD, $conexion);

if($_SESSION[APLICACION_.'bbdd']){ 	
	$bbdd_empresa = $_SESSION[APLICACION_.'bbdd'];
	$imagen = "SELECT l.contenido, l.tipo FROM logos l, clientes c WHERE c.bbdd='".$bbdd_empresa."' AND c.id=l.id_cliente";
	$rs = mysql_query($imagen);
	if($row = mysql_fetch_assoc($rs)){
		header('Content-type: '.$row['tipo']);
		echo $row['contenido'];
	}
} ?>
