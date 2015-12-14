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

if($_POST['new_doc']){
	$mensaje .= nuevo_documento($_POST);
}

if($_POST['eli_doc']){
	$mensaje .= eliminar_documento($_POST);
}

if($_POST['edid_id']){
	$mensaje .= editar_documento($_POST);
}

if($_POST['newrev_doc']){
	$mensaje .= nueva_revision($_POST);
}

if($_POST['rev_vigor']){
	$mensaje .= poner_en_vigor_rev($_POST, $_POST['estado_vigor']);
}

if($_POST['elimrev_id']){
	$mensaje .= eliminar_revision($_POST);
}

if($_POST['edirev_id']){
	$mensaje .= editar_revision($_POST);
}

if($_POST['newdoc_real']){
	$mensaje .= nuevo_documento_real($_POST);
}

if($_POST['edireal_id']){
	$mensaje .= editar_documento_real($_POST);
}

if($_POST['eliminar_manual']){
	$mensaje .= eliminar_manual($_POST);
}

if($_POST['editar_manual']){
	$mensaje .= editar_manual($_POST);
}

if($_POST['crear_manual']){
	$mensaje .= crear_manual($_POST);
}

if($_POST['eliminar_procedimiento']){
	$mensaje .= eliminar_procedimiento($_POST);
}

if($_POST['editar_procedimiento']){
	$mensaje .= editar_procedimiento($_POST);
}

if($_POST['crear_procedimiento']){
	$mensaje .= crear_procedimiento($_POST);
}
?>