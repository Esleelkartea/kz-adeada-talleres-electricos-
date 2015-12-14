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
<?php
if($_SESSION[APLICACION_.'user']){
	$ARRAY_TRABAJOS = array_trabajos();
	$OPCIONES = array_opciones();
	$PARTES_CLIENTES = array_partes_clientes();
	$ARRAY_TECNICOS = array_tecnicos();
	$ARRAY_TIPO_PROYECTO = array_tipo_proyecto();
	$ARRAY_USUARIOS = array_usuarios();
	$ARRAY_PERFILES = array_perfiles();
	$ARRAY_PROYECTOS = array_proyectos();
	$ARRAY_MESES = array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');
	$PROVINCIAS = array_provincias();
}
?>