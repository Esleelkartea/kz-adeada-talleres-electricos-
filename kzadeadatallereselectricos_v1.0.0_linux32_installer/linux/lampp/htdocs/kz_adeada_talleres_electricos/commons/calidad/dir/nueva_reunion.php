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
	<form action="ver_reuniones.php" id="crear_reunion" name="form_crear" method="post">
      <input type='hidden' name='new_reunion' value='new_reunion'></input>
      <table class="tabla_sin_borde" width="100%">
        <tr>
          <td width="25%">Departamento:</td>
          <td>
          Selecci&oacute;nalo:
          <select name='departamento' id='departamento' onChange="$('#departamento_tipo').attr('value', this.value);">
				<option value=''></option>
				<?php $departamentos = mostrar_departamentos(); 
				foreach($departamentos as $key => $valor){ ?>
					<option value='<?php echo $valor[0]; ?>'><?php echo $valor[0]; ?></option>
				<?php }?>
			  </select>
			  , o introduce uno nuevo:
			  <input type='text' name='departamento_tipo' id='departamento_tipo' class='requerido' value='' size=35></input>
		  </td>
        </tr>
        <tr>
          <td>Fecha:</td>
          <td><input type='text' name='fecha' id='fecha' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='edit_fechacreacion'>
			  <script>
				Calendar.setup({
				trigger    : "edit_fechacreacion",
				inputField : "fecha"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>Asistentes:</td>
	      <td><input type="text" name='asistentes' id="asistentes" value='' size='60'></td>
        </tr>        
        <tr>
          <td>Objeto de la reuni&oacute;n:</td>
          <td><input type="text" name='objeto' id="objeto" value='' size='35'></td>
        </tr>
        <tr>
          <td>Fecha siguiente reuni&oacute;n:</td>
          <td><input type='text' name='fechasig' id='fechasig' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal1'>
			  <script>
				Calendar.setup({
				trigger    : "cal1",
				inputField : "fechasig"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>Hora:</td>
          <td><input type="text" name='hora_siguiente' id="hora_siguiente" value='' size='14'></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
          	<input class="bt-accion" type="button" onclick="$('#crear_reunion').submit();"  name="img_crear" id="img_crear" value="Crear" />

			<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />

          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
    
    <form action="ver_reuniones.php" method="post" id="cancelar_<?php echo $valor['id'];?>">
	</form>
</div>
  
<?php include('../struct/footer2.php');?>
   
</div>
</div>

</body>
</html>
