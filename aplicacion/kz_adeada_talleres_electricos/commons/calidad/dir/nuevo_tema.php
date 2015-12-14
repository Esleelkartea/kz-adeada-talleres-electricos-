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
<script>document.getElementById("lnk_ver_reuniones").setAttribute("class", "seleccionado");</script>

<div id="cuerpo2">
	<form action="ficha_reunion.php" id="crear_tema" name="form_crear" method="post">
      <input type='hidden' name='anadir_tema' value='anadir_tema'></input>
      <input type='hidden' name='tema_reunion' value='<?php echo $_POST['id_reunion']; ?>'></input>
      <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
      <table class="tabla_sin_borde" width="100%">
      	<tr>
          <td width='25%'>A&ntilde;adir ordenes del d&iacute;a pendientes:</td>
	      <td id='temas'><?php include("temas.php"); ?></td>
        </tr>
        <tr>
          <td>Nuevo orden del d&iacute;a:</td>
	      <td><input type="text" name='tema' id="tema" value='' size='70'></td>
        </tr>        
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
          	<input class="bt-accion" type="button" onclick="$('#crear_tema').submit();"  name="img_crear" id="img_crear" value="Crear" />

			<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $_POST['id_reunion']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />
    	
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
    
    <form action='ficha_reunion.php' method='post' id='cancelar_<?php echo $_POST['id_reunion']; ?>'>
		<input type='hidden' name='id_reunion' value='<?php echo $_POST['id_reunion']; ?>'></input>
		<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	</form>
    
</div>
  
<?php include('../struct/footer2.php');?>
   
</div>
</div>

</body>
</html>
