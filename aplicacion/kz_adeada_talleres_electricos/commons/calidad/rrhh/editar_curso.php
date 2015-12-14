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

<?php $curso = select_normal("SELECT * FROM kz_tec_rrhh_accformativa WHERE id = '".$_POST['id_curso']."'"); 
if($curso)
	foreach($curso as $key => $valor){ ?>
	
	  <div id="cuerpo2">
	  	<form action="ver_cursos.php" method="post" id="guardar_curso_<?php echo $valor['id']; ?>" name="form_guardar">
	  	  <input type='hidden' name='modificar_curso' value='<?php echo $valor['id']; ?>'></input>
	  	  <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	      <table class="tabla_sin_borde" width="100%">
	        <tr>
	          <td width="25%">A&ntilde;o:</td>
	          <td>
				<select name="ano" id="ano">
	      			<?php combo_base_array($array_annos,$valor['ano']);?>
	      		</select>
	      	  </td>
	        </tr>
	        <tr>
	          <td>Finalizado:</td>
	          <td>
	          	<select name="finalizado" id="finalizado">
	          		<?php combo_base_array(array('SI', 'NO'), $valor['accionfinalizada']);?>
	      		</select>
	      	  </td>
	        </tr>
	        <tr>
	          <td>Acci&oacute;n formativa:</td>
	          <td><textarea name="accionformativa" id="accionformativa" cols="70" rows="3"><?php echo $valor['accionformativa']; ?></textarea></td>
	        </tr>        
	        <tr>
	          <td>Dirigida a:</td>
	          <td><textarea name="dirigidaa" id="dirigidaa" cols="70" rows="3"><?php echo $valor['dirigida']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td>Objetivo de la acci&oacute;n:</td>
	          <td><textarea name="objetivo" cols="70" rows="3"><?php echo $valor['objetivo']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td>Fecha prevista (mes):</td>
	          <td>
	          	<select name="fechaprevista" id="fechaprevista">
	      			<?php combo_base_array($array_meses,$valor['fechaprevista']);?>
	     		</select>
	     	  </td>
	        </tr>
	        <tr>
	          <td>Impartido por:</td>
	          <td><input type="text" name="impartidopor" id='impartidopor' value='<?php echo $valor['impartidopor'];?>' size='35'></td>
	        </tr>
	        <tr>
	          <td>Plazo de evaluaci&oacute;n:</td>
	          <td><input type='text' name='plazo' id='plazo' value='<?php echo $valor['plazoevaluacion']; ?>' size='14'></input>
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
	          <td><input type="text" name="procesorelacionado" id='procesorelacionado' value='<?php echo $valor['procesorelacionado']; ?>' size='35'></td>
	        </tr>
	        <tr>
	          <td>Fecha comienzo real:</td>
	          <td><input type='text' name='fechacomienzo' id='fechacomienzo' value='<?php echo $valor['fechacomienzo'] ; ?>' size='14'></input>
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
	          <td><input type='text' name='fechafin' id='fechafin' value='<?php echo $valor['fechafinal']; ?>' size='14'></input>
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
	          <td><input type="text" name="responsable" id='responsable' value='<?php echo $valor['responsableseguimiento']; ?>' size='35'></td>
	        </tr>
	        <tr>
	          <td>Horas:</td>
	          <td><input type="text" name="horas" id='horas' value='<?php echo $valor['horas']; ?>' size='14'> horas</td>
	        </tr>
	        <tr>
	          <td>Asistentes al curso:</td>
	          <td id=asistentes><?php include("asistentes.php"); ?></td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>
	       	   	<input class="bt-accion" type="button" onclick="$('#guardar_curso_<?php echo $valor['id']; ?>').submit();"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          	
				<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />

	          </td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	      </table>
	    </form>
		
		<form action='ver_cursos.php' method='post' id='cancelar_<?php echo $valor['id']; ?>'>
			<input type='hidden' name='id_curso' value='<?php echo $valor['id']; ?>'></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
		</form>
	  </div>
	<?php }
  
include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
