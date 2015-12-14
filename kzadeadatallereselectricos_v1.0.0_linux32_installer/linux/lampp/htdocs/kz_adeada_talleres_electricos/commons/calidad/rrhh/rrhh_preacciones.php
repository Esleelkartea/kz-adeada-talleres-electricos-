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

if($_POST['crear_personal']){
	$mensaje.= crear_personal($_POST);
}

if($_POST['editar_persona']){
	$mensaje.= editar_personal($_POST);
}

if($_POST['eliminar_personal']){
	$mensaje.= eliminar_persona($_POST);
}

if($_POST['modificar_valoraciones_comentario']){
	$mensaje.= modificar_valoraciones_comentario($_POST);
}

if($_POST['crear_curso']){
	$mensaje .= crear_curso($_POST);
}

if($_POST['modificar_curso']){
	$mensaje .= modificar_curso($_POST);
}

if($_POST['eliminar_curso']){
	$mensaje .= eliminar_curso($_POST);
}

if($_POST['editar_perfil']){
	$mensaje .= editar_perfil($_POST);
}

if($_POST['eliminar_perfil']){
	$mensaje .= eliminar_perfil($_POST);
}

if($_POST['crear_perfil']){
	$mensaje .= crear_perfil($_POST);
}
?>