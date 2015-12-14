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

<?php $reunion = select_normal("SELECT * FROM kz_tec_dir_reuniones WHERE id = '".$_POST['id_reunion']."'"); 
if($reunion)
	foreach($reunion as $key => $valor){ ?>
	
	  <div id="cuerpo2">
	  	<form action="ficha_reunion.php" method="post" id="guardar_reunion_<?php echo $valor['id']; ?>" name="form_guardar">
	  	  <input type='hidden' name='modificar_reunion' value='<?php echo $valor['id']; ?>'></input>
	  	  <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	      <table class="tabla_sin_borde" width="100%">
	        <tr>
	          <td width="25%">Departamento:</td>
	          <td>
	          Selecci&oacute;nalo:
	          <select name="departamento" id="departamento" onChange="$('#departamento_tipo').attr('value', this.value);">
	          		<option value=''></option>
         			<?php $sqldepartamento=select_normal("SELECT * FROM kz_tec_dir_departamentos");
      				foreach($sqldepartamento as $keydepartamento => $valordepartamento){
      					if($valor['departamento'] == $valordepartamento['departamento']){
      						$tipo_seleccionado = " SELECTED ";
      					} 
      					else $tipo_seleccionado = "";?>
      					<option value='<?php echo $valordepartamento['departamento']; ?>' <?php echo $tipo_seleccionado; ?>>
      						<?php echo $valordepartamento['departamento']; ?>
      					</option>
      				<?php }?>
       			  </select>
       			  , o introduce uno nuevo:
       			  <input type='text' name='departamento_tipo' id='departamento_tipo' value='' size=35></input>
       		  </td>
	        </tr>
	        <tr>
	          <td>Fecha:</td>
	          <td><input type='text' name='fecha' id='fecha' value='<?php echo $valor['fecha']; ?>' size='14'></input>
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
	          <td><input type="text" name='asistentes' id="asistentes" value='<?php echo $valor['asistentes']; ?>' size='60'></td>
	        </tr>        
	        <tr>
	          <td>Objeto de la reuni&oacute;n:</td>
	          <td><input type="text" name='objeto' id="objeto" value='<?php echo $valor['objeto']; ?>' size='35'></td>
	        </tr>
	        <tr>
	          <td>Fecha siguiente reuni&oacute;n:</td>
	          <td><input type='text' name='fechasig' id='fechasig' value='<?php echo $valor['fechasig']; ?>' size='14'></input>
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
	          <td><input type="text" name='hora_siguiente' id="hora_siguiente" value='<?php echo $valor['horasig']; ?>' size='14'></td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>
	          	<input class="bt-accion" type="button" onclick="$('#guardar_reunion_<?php echo $valor['id']; ?>').submit();"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          	
				<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />
   	
	          </td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	      </table>
	    </form>
		
		<form action='ficha_reunion.php' method='post' id='cancelar_<?php echo $valor['id']; ?>'>
			<input type='hidden' name='id_reunion' value='<?php echo $valor['id']; ?>'></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
		</form>
	  </div>
	<?php }
  
include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
