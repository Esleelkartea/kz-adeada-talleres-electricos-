<?php //session_destroy();
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
include("../struct/common.php");
if(($_SESSION[APLICACION_.'user'] || comprobar_login($_SESSION[APLICACION_.'empresa'],$_SESSION[APLICACION_.'user'], $_SESSION[APLICACION_.'pass']) != '1')){ 
	include('../commons/menu.php');
	if(file_exists($pag.".php")){
		include($pag.".php");
	}
	else{
		include("../commons/welcome.php");
	}
	include("../struct/footer.php");
}
 ?>