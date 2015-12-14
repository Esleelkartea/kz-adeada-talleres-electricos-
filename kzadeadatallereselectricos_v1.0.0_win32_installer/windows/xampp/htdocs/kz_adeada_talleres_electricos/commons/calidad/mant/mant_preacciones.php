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

if($_POST['crear_equipo']){
	$mensaje.= crear_equipo($_POST);
}

if($_POST['eliminar_equipo']){
	$mensaje.= eliminar_equipo($_POST);
}

if($_POST['modificar_equipo']){
	$mensaje.= modificar_equipo($_POST);
}

if($_POST['anadir_pauta']){
	$mensaje.= anadir_pauta($_POST);
}

if($_POST['eliminar_pauta']){
	$mensaje.= eliminar_pauta($_POST);
}

if($_POST['editar_pauta']){
	$mensaje.= editar_pauta($_POST);
}

if($_POST['anadir_correctivo']){
	$mensaje.= anadir_correctivo($_POST);
}

if($_POST['eliminar_correctivo']){
	$mensaje.= eliminar_correctivo($_POST);
}

if($_POST['editar_correctivo']){
	$mensaje.= editar_correctivo($_POST);
}
?>