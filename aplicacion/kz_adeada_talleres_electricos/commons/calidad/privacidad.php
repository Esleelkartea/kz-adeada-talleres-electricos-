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

require('../../functions/globales.php');
require('include/rutas.php');
require('functions/main.php');
require('struct/login2.php');
include('struct/header.php');
?>

<div id="menu_principal">
	<ul>
		<li><a href="documentacion.php">Documentaci&oacute;n</a></li>
		<li><a href="direccion.php" class="seleccionado">Direcci&oacute;n</a></li>
		<li><a href="rrhh.php">Formaci&oacute;n</a></li>
		<li><a href="mantenimiento.php">Maquinaria</a></li>
		<li><a href="mejora.php">Mejora</a></li>
		<li id="ir-ainicio"><a href="../../index/index.php">Volver</a></li>
	</ul>
</div>
<div id="contenido">
<h2>Declaraci&oacute;n de privacidad</h2>

<?php include('struct/footer.php'); ?>