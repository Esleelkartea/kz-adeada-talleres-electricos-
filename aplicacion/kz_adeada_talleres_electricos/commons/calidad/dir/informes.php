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
include('../struct/header_dir.php');
require('../functions/dir_functions.php');
require('dir_preacciones.php');
?>

<script>document.getElementById("lnk_direccion").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_informes").setAttribute("class", "seleccionado");</script>

<div id = "link_normal"><a class="color_enlaces" href="informes_objetivos.php">Objetivos</a></div>
<br>
<div id = "link_normal"><a class="color_enlaces" href="informes_reuniones.php">Reuniones</a></div>
<br>
<div id="link_normal"><a class="color_enlaces" href="informes_revision_direccion.php">Revisi&oacute;n por la direcci&oacute;n</a></div>
<br>
<div id="link_normal"><a class="color_enlaces" href="informes_politica.php">Pol&iacute;tica de calidad</a></div>
<br>

<?php include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
