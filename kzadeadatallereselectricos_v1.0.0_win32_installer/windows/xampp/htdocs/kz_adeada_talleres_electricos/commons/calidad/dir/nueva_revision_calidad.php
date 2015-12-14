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
<script>document.getElementById("lnk_ver_revisiones").setAttribute("class", "seleccionado");</script>

<div id="limpiar"></div>

<div id="cuerpo2">
	<form action="" id="formulario" name="formulario" method="post">
      <input type='hidden' name='new_revision_calidad' value='new_revision_calidad'></input>
      
      <?php $coger_ultimo = select_normal("SELECT max(id) as maximo FROM kz_tec_dir_revisiondireccion");
      $coger_ultimo = $coger_ultimo[0]; 
      $ultimo = $coger_ultimo['maximo'] + 1; ?>
      <input type='hidden' name='id_revision_calidad' value='<?php echo $ultimo; ?>'></input>
      
      <table class="tabla_sin_borde" width="100%">
        <tr>
          <td width="25%">Fecha de la revisi&oacute;n:</td>
          <td><input type='text' name='fecha' id='fecha' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal'>
			  <script>
				Calendar.setup({
				trigger    : "cal",
				inputField : "fecha"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>A&ntilde;o de la gesti&oacute;n:</td>
          <td><select name='anno' id='anno'>
				<?php combo_base_array($array_annos, date("Y")); ?>
	          </select>
          </td>
        </tr>
        <tr>
          <td>Asistentes:</td>
          <td><input type="text" name="asistentes" id="asistentes" value='' size='60' /></td>
        </tr>
        <tr><td height='15px'></td></tr>
        <tr>
          <td colspan=2>Resultado de auditorias:</td>
        </tr>
		<tr>
          <td colspan=2><textarea name="resultado" id="resultado" rows="3" cols="90" onFocus="this.rows='30';" onBlur="this.rows='3';"></textarea></td>
        </tr>
        <tr>
          <td colspan=2 style="text-align:right;">
          	<input class="boton" type="button" onclick="document.formulario.action='editar_revision_calidad.php'; document.formulario.submit()"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          </td>
        </tr>
        <tr>
          <td colspan=2>Retroalimentaci&oacute;n del cliente:</td>
        </tr>
		<tr>
          <td colspan=2><textarea name="retroalimentacion" id="retroalimentacion" rows="3" cols="90" onFocus="this.rows='30';" onBlur="this.rows='3';"></textarea></td>
        </tr>
        <tr>
          <td colspan=2 style="text-align:right;">
          	<input class="boton" type="button" onclick="document.formulario.action='editar_revision_calidad.php'; document.formulario.submit()"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          </td>
        </tr>
        <tr>
          <td colspan=2>Desempe&ntilde;o de los procesos:</td>
        </tr>
		<tr>
          <td colspan=2><textarea name="desempeno" id="desempeno" rows="3" cols="90" onFocus="this.rows='30';" onBlur="this.rows='3';"></textarea></td>
        </tr>
        <tr>
          <td colspan=2 style="text-align:right;">
          	<input class="boton" type="button" onclick="document.formulario.action='editar_revision_calidad.php'; document.formulario.submit()"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          </td>
        </tr>
        <tr>
          <td colspan=2>Conformidad del producto:</td>
        </tr>
		<tr>
          <td colspan=2><textarea name="conformidad" id="conformidad" rows="3" cols="90" onFocus="this.rows='30';" onBlur="this.rows='3';"></textarea></td>
        </tr>
        <tr>
          <td colspan=2 style="text-align:right;">
          	<input class="boton" type="button" onclick="document.formulario.action='editar_revision_calidad.php'; document.formulario.submit()"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          </td>
        </tr>
        <tr>
          <td colspan=2>Estado de las acciones correctivas y preventivas:</td>
        </tr>
		<tr>
          <td colspan=2><textarea name="estado" id="estado" rows="3" cols="90" onFocus="this.rows='30';" onBlur="this.rows='3';"></textarea></td>
        </tr>
        <tr>
          <td colspan=2 style="text-align:right;">
          	<input class="boton" type="button" onclick="document.formulario.action='editar_revision_calidad.php'; document.formulario.submit()"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          </td>
        </tr>
        <tr>
          <td colspan=2>Acciones de seguimiento de revisiones por la direcci&oacute;n previas:</td>
        </tr>
		<tr>
          <td colspan=2><textarea name="acciones" id="acciones" rows="3" cols="90" onFocus="this.rows='30';" onBlur="this.rows='3';"></textarea></td>
        </tr>
        <tr>
          <td colspan=2 style="text-align:right;">
          	<input class="boton" type="button" onclick="document.formulario.action='editar_revision_calidad.php'; document.formulario.submit()"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          </td>
        </tr>
        <tr>
          <td colspan=2>Cambios que podr&iacute;an afectar al sistema de gesti&oacute;n de calidad:</td>
        </tr>
		<tr>
          <td colspan=2><textarea name="cambios" id="cambios" rows="3" cols="90" onFocus="this.rows='30';" onBlur="this.rows='3';"></textarea></td>
        </tr>
        <tr>
          <td colspan=2 style="text-align:right;">
          	<input class="boton" type="button" onclick="document.formulario.action='editar_revision_calidad.php'; document.formulario.submit()"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          </td>
        </tr>
        <tr>
          <td colspan=2>Recomendaciones para la mejora:</td>
        </tr>
		<tr>
          <td colspan=2><textarea name="recomendaciones" id="recomendaciones" rows="3" cols="90" onFocus="this.rows='30';" onBlur="this.rows='3';"></textarea></td>
        </tr>
        <tr>
          <td colspan=2 style="text-align:right;">
          	<input class="boton" type="button" onclick="document.formulario.action='editar_revision_calidad.php'; document.formulario.submit()"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          </td>
        </tr>
        <tr>
          <td colspan=2>Revisi&oacute;n de la politica del sistema de gesti&oacute;n:</td>
        </tr>
		<tr>
          <td colspan=2><textarea name="revision" id="revision" rows="3" cols="90" onFocus="this.rows='30';" onBlur="this.rows='3';"></textarea></td>
        </tr>
        <tr>
          <td colspan=2 style="text-align:right;">
          	<input class="boton" type="button" onclick="document.formulario.action='editar_revision_calidad.php'; document.formulario.submit()"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          </td>
        </tr>
        <tr>
          <td colspan=2>Decisiones relacionadas en lo referente a necesidades de recursos:</td>
        </tr>
		<tr>
          <td colspan=2><textarea name="decisiones1" id="decisiones1" rows="3" cols="90" onFocus="this.rows='30';" onBlur="this.rows='3';"></textarea></td>
        </tr>
        <tr>
          <td colspan=2 style="text-align:right;">
          	<input class="boton" type="button" onclick="document.formulario.action='editar_revision_calidad.php'; document.formulario.submit()"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          </td>
        </tr>
        <tr>
          <td colspan=2>Decisiones relacionadas con la mejora de la eficacia del sistema de gesti&oacute;n de la calidad y sus procesos:</td>
        </tr>
		<tr>
          <td colspan=2><textarea name="decisiones2" id="decisiones2" rows="3" cols="90" onFocus="this.rows='30';" onBlur="this.rows='3';"></textarea></td>
        </tr>
        <tr>
          <td colspan=2 style="text-align:right;">
          	<input class="boton" type="button" onclick="document.formulario.action='editar_revision_calidad.php'; document.formulario.submit()"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          </td>
        </tr>
        <tr>
          <td colspan=2>Decisiones y acciones relacionadas con la mejora del producto:</td>
        </tr>
		<tr>
          <td colspan=2><textarea name="decisiones3" id="decisiones3" rows="3" cols="90" onFocus="this.rows='30';" onBlur="this.rows='3';"></textarea></td>
        </tr>
        <tr>
          <td colspan=2 style="text-align:right;">
          	<input class="boton" type="button" onclick="document.formulario.action='editar_revision_calidad.php'; document.formulario.submit()"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          </td>
        </tr>
        <tr>
          <td colspan=2>Objetivos de calidad:</td>
        </tr>
		<tr>
          <td colspan=2><textarea name="objetivos" id="objetivos" rows="3" cols="90" onFocus="this.rows='30';" onBlur="this.rows='3';"></textarea></td>
        </tr>
         <tr>
          <td colspan=2 style="text-align:right;">
          	<input class="boton" type="button" onclick="document.formulario.action='editar_revision_calidad.php'; document.formulario.submit()"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          </td>
        </tr>
        <tr>
          <td colspan=2>Tratar las acciones de mejora:</td>
        </tr>
		<tr>
          <td colspan=2><textarea name="tratar_acciones_mejora" id="tratar_acciones_mejora" rows="3" cols="90" onFocus="this.rows='30';" onBlur="this.rows='3';"></textarea></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan=2>
          	<input class="bt-accion" type="button" onclick="document.formulario.action='ver_revisiones_calidad.php'; document.formulario.submit()"  name="img_crear" id="img_crear" value="Crear" />

			<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />

          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
</div>

<form action="ver_revisiones_calidad.php" method="post" id="cancelar_<?php echo $valor['id'];?>">
</form>

<?php include('../struct/footer2.php');?>
   
</div>
</div>

</body>
</html>
