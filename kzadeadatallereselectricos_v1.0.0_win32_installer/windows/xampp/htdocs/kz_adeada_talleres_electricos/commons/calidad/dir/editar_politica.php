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

<script>document.getElementById("lnk_rrhh").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_ver_politicas").setAttribute("class", "seleccionado");</script>

<div id="limpiar"></div>

<?php $politica = select_normal("SELECT * FROM kz_tec_dir_politicas WHERE id = '".$_POST['id_politica']."'"); 
if($politica)
	foreach($politica as $key => $valor){ ?>
	
	  <div id="cuerpo2">
	  	<form action="ver_politicas.php" method="post" id="guardar_politica_<?php echo $valor['id']; ?>" name="form_guardar">
	  	  <input type='hidden' name='editar_politica' value='<?php echo $valor['id']; ?>'></input>
	  	  <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	      <table class="tabla_sin_borde" width="100%">
	        <tr>
	          <td width="25%">Nombre de la pol&iacute;tica:</td>
	          <td><input type="text" name="nombre" id="nombre" value='<?php echo $valor['nombre']; ?>' size='50' /></td>
	        </tr>
	        <tr>
	          <td>Fecha:</td>
	          <td><input type="text" name="fecha" id="fecha" value='<?php echo $valor['fecha']; ?>' size='50' /></td>
	        </tr>
	        <tr><td height='15px'></td></tr>
	        <tr>
	          <td colspan=2>Descripci&oacute;n de la pol&iacute;tica:</td>
	        </tr>
	        <tr>
	          <td colspan=2><textarea name="politica" id="politica" rows="10" cols="70" onFocus="this.rows='100';" onBlur="this.rows='10';"><?php echo $valor['politica']; ?></textarea></td>
	        </tr>        
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	        <tr>
	          <td colspan=2>
	          	<input class="bt-accion" type="button" onclick="$('#guardar_politica_<?php echo $valor['id']; ?>').submit();"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          	
				<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />
 	
	          </td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	      </table>
	    </form>
		
		<form action='ver_politicas.php' method='post' id='cancelar_<?php echo $valor['id']; ?>'>
			<input type='hidden' name='id_politica' value='<?php echo $valor['id']; ?>'></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
		</form>
	  </div>
	<?php }
  
include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
