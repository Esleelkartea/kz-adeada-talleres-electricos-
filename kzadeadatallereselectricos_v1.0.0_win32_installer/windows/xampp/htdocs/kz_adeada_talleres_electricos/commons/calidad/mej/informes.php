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
require('../../../functions/globales.php');
require('../include/rutas.php');
require('../functions/main.php');
require('../struct/login2.php');
include('../struct/header_mej.php');
require('../functions/mej_functions.php');
require('mej_preacciones.php');
?>

<script>document.getElementById("lnk_mejora").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_informes").setAttribute("class", "seleccionado");</script>

<div id="link_normal"><a class="color_enlaces" href="informes_satisfaccion.php">Satisfacci&oacute;n</a></div>
<br>
<div id = "link_normal"><a class="color_enlaces" href="informes_noconformidades.php">No Conformidades</a></div>
<br>
<div id = "link_normal"><a class="color_enlaces" href="informes_acpm.php">Acciones Correctivas/Mejora</a></div>
<br>

<?php include('../struct/footer2.php'); ?>

</body>
</html>
