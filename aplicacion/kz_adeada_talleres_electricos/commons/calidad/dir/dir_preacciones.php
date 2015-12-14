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

if($_POST['crear_objetivo']){
	$mensaje .= crear_objetivo($_POST);
}

if($_POST['eliminar_objetivo']){
	$mensaje .= eliminar_objetivo($_POST);
}

if($_POST['edio_id']){
	$mensaje .= editar_objetivo($_POST);
}

if($_POST['edio_seg_id']){
	$mensaje .= editar_seguimiento_objetivo($_POST);
}

if($_POST['crear_seguimiento_objetivo']){
	$mensaje .= crear_seguimiento_objetivo($_POST);
}

if($_POST['eliminar_segobjetivo']){
	$mensaje .= eliminar_seguimiento_objetivo($_POST);
}

if($_POST['eliminar_tema']){
	$mensaje .= eliminar_tema($_POST);
}

if($_POST['eliminar_decision']){
	$mensaje .= eliminar_decision($_POST);
}

if($_POST['editar_deci']){
	$mensaje .= editar_decision($_POST);
}

if($_POST['modificar_reunion']){
	$mensaje .= modificar_reunion($_POST);
}

if($_POST['anadir_tema']){
	$mensaje .= anadir_tema($_POST);
}

if($_POST['anadir_decision']){
	$mensaje .= anadir_decision($_POST);
}

if($_POST['new_reunion']){
	$mensaje .= nueva_reunion($_POST);
}

if($_POST['eliminar_reunion']){
	$mensaje .= eliminar_reunion($_POST);
}

if($_POST['tema_cerrado']){
	$mensaje .= cerrar_tema($_POST, $_POST['estado_cerrado']);
}

if($_POST['decision_cerrada']){
	$mensaje .= cerrar_decision($_POST, $_POST['estado_cerrada']);
}

if($_POST['eliminar_revision_calidad']){
	$mensaje .= eliminar_revision_calidad($_POST);
}

if($_POST['id_rev_calidad']){
	$mensaje .= modificar_revision_calidad($_POST);
}

if($_POST['new_revision_calidad']){
	$mensaje .= nueva_revision_calidad($_POST);
}

if($_POST['crear_politica']){
	$mensaje .= crear_politica($_POST);
}

if($_POST['eliminar_politica']){
	$mensaje .= eliminar_politica($_POST);
}

if($_POST['editar_politica']){
	$mensaje .= editar_politica($_POST);
}
?>