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
include('../struct/header_rrhh.php');
require('../functions/rrhh_functions.php');
require('rrhh_preacciones.php');
?>

<script>document.getElementById("lnk_rrhh").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_ver_cursos").setAttribute("class", "seleccionado");</script>

<div id="cuerpo2">
	<form action="ver_cursos.php" id="crear_curso" name="form_crear" method="post">
      <input type='hidden' name='crear_curso' value='crear_curso'></input>
      <table class="tabla_sin_borde" width="100%">
        <tr>
          <td width="26%">A&ntilde;o:</td>
          <td>
			<select name="ano" id="ano">
      			<?php combo_base_array($array_annos,date("Y"));?>
      		</select>
      	  </td>
        </tr>
        <tr>
          <td>Finalizado:</td>
          <td>
          	<select name="finalizado" id="finalizado">
          		<?php combo_base_array(array('SI', 'NO'), 'NO');?>
      		</select>
      	  </td>
        </tr>
        <tr>
          <td>Acci&oacute;n formativa:</td>
          <td><textarea name="accionformativa" id="accionformativa" cols="70" rows="3"></textarea></td>
        </tr>        
        <tr>
          <td>Dirigida a:</td>
          <td><textarea name="dirigidaa" id="dirigidaa" cols="70" rows="3"></textarea></td>
        </tr>
        <tr>
          <td>Objetivo de la acci&oacute;n:</td>
          <td><textarea name="objetivo" cols="70" rows="3"></textarea></td>
        </tr>
        <tr>
          <td>Fecha prevista (mes):</td>
          <td>
          	<select name="fechaprevista" id="fechaprevista">
      			<?php combo_base_array($array_meses,$array_meses[date("m") - 1]);?>
     		</select>
     	  </td>
        </tr>
        <tr>
          <td>Impartido por:</td>
          <td><input type="text" name="impartidopor" id='impartidopor' value='' size='35'></td>
        </tr>
        <tr>
          <td>Plazo de evaluaci&oacute;n:</td>
          <td><input type='text' name='plazo' id='plazo' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal1'>
			  <script>
				Calendar.setup({
				trigger    : "cal1",
				inputField : "plazo"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>Proceso relacionado:</td>
          <td><input type="text" name="procesorelacionado" id='procesorelacionado' value='' size='35'></td>
        </tr>
        <tr>
          <td>Fecha comienzo real:</td>
          <td><input type='text' name='fechacomienzo' id='fechacomienzo' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal2'>
			  <script>
				Calendar.setup({
				trigger    : "cal2",
				inputField : "fechacomienzo"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>Fecha final real:</td>
          <td><input type='text' name='fechafin' id='fechafin' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal3'>
			  <script>
				Calendar.setup({
				trigger    : "cal3",
				inputField : "fechafin"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>Responsable de seguimiento:</td>
          <td><input type="text" name="responsable" id='responsable' value='' size='35'></td>
        </tr>
        <tr>
          <td>Horas:</td>
          <td><input type="text" name="horas" id='horas' value='' size='14'> horas</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
          	<input class="bt-accion" type="button" onclick="$('#crear_curso').submit();"   name="img_crear" id="img_crear" value="Crear" />
          	
			<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />

          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
    
    <form action="ver_cursos.php" method="post" id="cancelar_<?php echo $valor['id'];?>">
	</form>
</div>
  
<?php include('../struct/footer2.php');?>
   
</div>
</div>

</body>
</html>
