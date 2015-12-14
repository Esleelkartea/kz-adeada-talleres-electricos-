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
include('../struct/header_mant.php');
require('../functions/mant_functions.php');
require('mant_preacciones.php');
?>

<script>document.getElementById("lnk_mantenimiento").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_ver_equipos").setAttribute("class", "seleccionado");</script>

<?php $equipo = select_normal("SELECT * FROM kz_tec_mant_equipos WHERE id = '".$_POST['id_equipo']."'"); 
if($equipo)
	foreach($equipo as $key => $valor){ ?>
	
	  <div id="cuerpo2">
	  	<form action="ficha_equipo.php" method="post" id="guardar_equipo_<?php echo $valor['id']; ?>" name="form_guardar">
	  	  <input type='hidden' name='modificar_equipo' value='<?php echo $valor['id']; ?>'></input>
	  	  <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	      <table class="tabla_sin_borde" width="100%">
	        <tr>
	          <td width="25%">N&ordm;:</td>
	          <td><input type="text" name="numero" id='numero' value='<?php echo $valor['numero']; ?>' size='14'></td>
	        </tr>
	        <tr>
	          <td>A&ntilde;o de fabricaci&oacute;n:</td>
	          <td>
	          	<select name="anofab"  id="anofab" >
         			<?php combo_base_array($array_annos,$valor['anofab']);?>
        		</select>
        	  </td>
	        </tr>
	        <tr>
	          <td>Ref.:</td>
	          <td><input type="text" name="ref" id="ref" value='<?php echo $valor['ref']; ?>' size='14'></td>
	        </tr>        
	        <tr>
	          <td>Fabricante:</td>
	          <td><input type="text" name="fabricante" id="fabricante" value='<?php echo $valor['fab']; ?>' size='35' /></td>
	        </tr>
	        <tr>
	          <td>Modelo:</td>
	          <td><input type="text" name="modelo" id="modelo" value='<?php echo $valor['modelo']; ?>' size='35' /></td>
	        </tr>
	        <tr>
	          <td>Tipo:</td>
	          <td><input type="text" name="tipo" id="tipo" value='<?php echo $valor['tipo']; ?>' size='35' /></td>
	        </tr>
	        <tr>
	          <td>Referencia:</td>
	          <td><input type="text" name="referencia" id="referencia" value='<?php echo $valor['referencia']; ?>' size='14'></td>
	        </tr>
	        <tr>
	          <td>Elemento:</td>
	          <td><input type="text" name="elemento" id="elemento" value='<?php echo $valor['elemento']; ?>' size='35' /></td>
	        </tr>
	        <tr>
	          <td>Descripci&oacute;n:</td>
	          <td><textarea name="descripcion" id="descripcion" cols="70" rows="3"><?php echo $valor['descripcion']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td>Categor&iacute;a:</td>
	          <td>
	          	Selecci&oacute;nala:
	          	<select name="categoria" id="categoria">
    				<option value=''></option>
		         	<?php $categoria=select_normal("SELECT * FROM kz_tec_mant_categoria");
		      		foreach($categoria as $keycategoria => $valorcategoria){
		      			if($valor['categoria'] == $valorcategoria['categoria']){
		      				$tipo_seleccionado = " SELECTED ";
		      			} 
		      			else $tipo_seleccionado = "";?>
		      			<option value='<?php echo $valorcategoria['categoria']; ?>' <?php echo $tipo_seleccionado; ?>>
		      				<?php echo $valorcategoria['categoria']; ?>
		      			</option>
		      		<?php }?>
		       	</select>
		       	, o introduce una nueva:
       			<input type='text' name='nueva_categoria' id='nueva_categoria' value=''></input>
       		  </td>
	        </tr>
	        <tr>
	          <td>Estado:</td>
	          <td>
	          	<select name="estado"  id="estado" >
         			<?php combo_base_array(array('BUENO','MALO','SATISFACTORIO'),$valor['estado']);?>
        		</select>
        	  </td>
	        </tr>
	        <tr>
	          <td>Ubicaci&oacute;n:</td>
	          <td>
	          	Selecci&oacute;nala:
	          	<select name="ubicacion" id="ubicacion">
					<option value=''></option>
		         	<?php $ubicacion=select_normal("SELECT * FROM kz_tec_mant_ubicacion");
		      		foreach($ubicacion as $keyubicacion => $valorubicacion){
		      			if($valor['ubicacion'] == $valorubicacion['ubicacion']){
		      				$tipo_seleccionado = " SELECTED ";
		      			} 
		      			else $tipo_seleccionado = "";?>
		      			<option value='<?php echo $valorubicacion['ubicacion']; ?>' <?php echo $tipo_seleccionado; ?>>
		      				<?php echo $valorubicacion['ubicacion']; ?>
		      			</option>
		      			<?php }?>
		       	</select>
		       	, o introduce una nueva:
       			<input type='text' name='nueva_ubicacion' id='nueva_ubicacion' value=''></input>
			  </td>
	        </tr>
	        <tr>
	          <td>Fecha de adq.:</td>
	          <td><input name="fechaadq" type="text" id="fechaadq<?php echo $valor['id']; ?>" value='<?php echo $valor['fechaadq']; ?>'>
      			  <img src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal1<?php echo $valor['id']; ?>'>
				  <script>
			      Calendar.setup({
			          trigger    : "cal1<?php echo $valor['id']; ?>",
			          inputField : "fechaadq<?php echo $valor['id']; ?>"
				      });
				  </script>
			  </td>
	        </tr>
	        <tr>
	          <td>Precio:</td>
	          <td><input type="text" name="precioadq" id="precioadq" value='<?php echo $valor['precio']; ?>' size='14'></td>
	        </tr>
	        <tr>
	          <td>S/N:</td>
	          <td><input type="text" name="sn" id="sn" value='<?php echo $valor['sn']; ?>' size='14'></td>
	        </tr>
	        <tr>
	          <td>Fecha de retirada:</td>
	          <td><input name="fecharetirada" type="text" id="fecharetirada<?php echo $valor['id']; ?>" value='<?php echo $valor['fecharetirada']; ?>'>
          		  <img src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal2<?php echo $valor['id']; ?>'>
				  <script>
			      Calendar.setup({
			          trigger    : "cal2<?php echo $valor['id']; ?>",
			          inputField : "fecharetirada<?php echo $valor['id']; ?>"
				      });
				  </script>
			  </td>
	        </tr>
	        <tr>
	          <td>Funci&oacute;n:</td>
	          <td><input type="text" name="funcion" id="funcion" value='<?php echo $valor['funcion']; ?>' size='35'></td>
	        </tr>
	        <tr>
	          <td>CEE:</td>
	          <td><input type="text" name="cee" id="cee" value='<?php echo $valor['cee']; ?>' size='14'></td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>
	          	<input class="bt-accion" type="button" onclick="$('#guardar_equipo_<?php echo $valor['id']; ?>').submit();"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          	
				<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />
   	
	          </td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	      </table>
	    </form>
		
		<form action='ficha_equipo.php' method='post' id='cancelar_<?php echo $valor['id']; ?>'>
			<input type='hidden' name='id_equipo' value='<?php echo $valor['id']; ?>'></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
		</form>
	  </div>
	<?php }
  
include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
	