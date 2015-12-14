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

if($_POST['new_noconformidad']){
	$mensaje .= nueva_noconformidad($_POST);
}

if($_POST['eliminar_noconformidad']){
	$mensaje .= eliminar_noconformidad($_POST);
}

if($_POST['edi_noconformidad']){
	$mensaje .= modificar_noconformidad($_POST);
}

if($_POST['new_acpm']){
	$mensaje .= nueva_acpm($_POST);
}

if($_POST['eliminar_acpm']){
	$mensaje .= eliminar_acpm($_POST);
}

if($_POST['modificar_acpm']){
	$mensaje .= modificar_acpm($_POST);
}

if($_POST['crear_encuesta_satisfaccion']){
	crear_encuesta_satisfaccion($_POST);
}

if($_POST['modificar_encuesta']){
	mod_encuesta($_POST);
}

if($_POST['eliminar_encuesta']){
	eliminar_encuesta($_POST);
}
?>