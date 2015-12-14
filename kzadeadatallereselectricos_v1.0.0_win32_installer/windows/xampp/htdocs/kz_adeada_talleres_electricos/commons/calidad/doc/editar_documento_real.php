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
include('../struct/header_doc.php');
require('../functions/doc_functions.php');
require('doc_preacciones.php');
?>

<script>document.getElementById("lnk_documentacion").setAttribute("class", "seleccionado");</script>
<script>document.getElementById("lnk_ver_documentos").setAttribute("class", "seleccionado");</script>

<?php if($_POST['id_real']){ 
	$doc_real = select_normal("SELECT * FROM kz_tec_doc_documentos_reales WHERE id = '".$_POST['id_real']."'");
}
else{
	$link = conectar(BBDDUSUARIO);
	$sql = "SELECT max(idrev) as maxima_rev FROM kz_tec_doc_documentos_reales WHERE iddoc = ".$_POST['rev_doc']."";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_assoc($rs)){
		$doc_real = select_normal("SELECT * FROM kz_tec_doc_documentos_reales WHERE iddoc = ".$_POST['rev_doc']." AND idrev = ".$row['maxima_rev']."");
	}
}

if($doc_real)
	foreach($doc_real as $key => $valor){ ?>
	
	  <div id="cuerpo2">
	  
	  <?php if($_POST['pag'] == 'nueva_revision'){ ?>
	  	<form action="ficha_documento.php" method="post" id="guardar_documento_real_<?php echo $valor['id']; ?>" name="form_guardar">
	  		<input type='hidden' name='edid_real_id' value='<?php echo $_POST['rev_doc']; ?>'></input>
	  <?php }
	  else { ?>
	  	<form action="ficha_documento.php" method="post" id="guardar_documento_real_<?php echo $valor['id']; ?>" name="form_guardar">
	  		<input type='hidden' name='edid_real_id' value='<?php echo $_POST['id_documento']; ?>'></input>
	  <?php }?>
	  	
	  	  <input type='hidden' name='edireal_id' value='<?php echo $valor['id']; ?>'></input>
	  	  <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	      <table class="tabla_sin_borde" width="100%">
	        <tr>
	          <td width="25%">Fecha:</td>
	          <td><input type='text' name='fecha' id='fecha' value='<?php echo $valor['fecha']; ?>' size='14'></input>
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
	          <td>T&iacute;tulo:</td>
	          <td><input type="text" name="titulo" id="titulo" value='<?php echo $valor['titulo']; ?>' size='35' /></td>
	        </tr>
	        <tr>
          	  <td>Contenido:</td>
          	  <td><textarea name="contenido" cols="70" rows="3" onFocus="this.rows='30';" onBlur="this.rows='3';"><?php echo $valor['contenido']; ?></textarea></td>
        	</tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>
	          	<input class="bt-accion" type="button" onclick="$('#guardar_documento_real_<?php echo $valor['id']; ?>').submit();"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
				<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />
    	
	          </td>
	        </tr>
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>
	      </table>
	    </form>
		
		<form action='ficha_documento.php' method='post' id='cancelar_<?php echo $valor['id']; ?>'>
			<input type='hidden' name='id_documento' value='<?php echo $_POST['id_documento']; ?>'></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
		</form>
	  </div>
	<?php }
  
include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
