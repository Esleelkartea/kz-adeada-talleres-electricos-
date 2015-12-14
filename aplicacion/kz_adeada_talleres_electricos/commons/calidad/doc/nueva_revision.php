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

<div id="cuerpo2">
   	<?php if($_POST['tipo_doc'] == 'MANUAL'){ 
	   	$hay_doc_real = select_normal("SELECT * FROM kz_tec_doc_manual WHERE iddoc='".$_POST['id_documento']."'");
   		if($hay_doc_real){?>
	   	 	<form action="editar_manual.php" id="crear_revision" name="form_crear" method="post">
	   	 		<input type='hidden' name='pag' value='nueva_revision'></input>
	   	 <?php }
	   	 else{?>
	   	 	<form action="ficha_documento.php" id="crear_revision" name="form_crear" method="post">
    			<input type='hidden' name='pag' value='nueva_revision'></input>
    			<input type='hidden' name='rev_doc' value='<?php echo $_POST['id_documento']; ?>'></input>
	   	 <?php }
	}
	else{
		if($_POST['tipo_doc'] == 'PROCEDIMIENTO'){
			$hay_doc_real = select_normal("SELECT * FROM kz_tec_doc_procedimientos WHERE iddoc='".$_POST['id_documento']."'");
   			if($hay_doc_real){?>
	   			<form action="editar_procedimiento.php" id="crear_revision" name="form_crear" method="post">
	   	 		<input type='hidden' name='pag' value='nueva_revision'></input>
	   	 	<?php }
			else{?>
	   	 		<form action="ficha_documento.php" id="crear_revision" name="form_crear" method="post">
    				<input type='hidden' name='pag' value='nueva_revision'></input>
    				<input type='hidden' name='rev_doc' value='<?php echo $_POST['id_documento']; ?>'></input>
	   	 <?php }
	   	}
	   	 elseif($_POST['tipo_doc'] == 'DOCUMENTO'){
	   	 	$hay_doc_real = select_normal("SELECT * FROM kz_tec_doc_documentos_reales WHERE iddoc='".$_POST['id_documento']."'");
   				if($hay_doc_real){?>
	   	 			<form action="editar_documento_real.php" id="crear_revision" name="form_crear" method="post">
	   	 				<input type='hidden' name='pag' value='nueva_revision'></input>
	   	 		<?php }
	   	 		else{?>
	   	 		<form action="ficha_documento.php" id="crear_revision" name="form_crear" method="post">
    				<input type='hidden' name='pag' value='nueva_revision'></input>
    				<input type='hidden' name='rev_doc' value='<?php echo $_POST['id_documento']; ?>'></input>
	   		<?php }
   		}
		else{?>
   	 		<form action="ficha_documento.php" id="crear_revision" name="form_crear" method="post">
    			<input type='hidden' name='pag' value='nueva_revision'></input>
    			<input type='hidden' name='rev_doc' value='<?php echo $_POST['id_documento']; ?>'></input>
   		<?php 
   		}
	}?>
   	
      <input type='hidden' name='newrev_doc' value='newrev_doc'></input>
      <input type='hidden' name='rev_doc' value='<?php echo $_POST['id_documento']; ?>'></input>
      <input type='hidden' name='tipo_doc' value='<?php echo $_POST['tipo_doc']; ?>'></input>
      <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
      <table class="tabla_sin_borde" width="100%">
        <tr>
          <td width="25%">Revisi&oacute;n:</td>
          <td><input type="text" name="revision" id="revision" value='' size='35'></td>
        </tr>
		<tr>
          <td>Soporte:</td>
          <td><input type="text" name="newrev_soporte" id="newrev_soporte" value='' size='35' /></td>
        </tr>
		<tr>
          <td>Realizado:</td>
          <td><input type="text" name="newrev_realizado" id="newrev_realizado" value='' size='35' /></td>
        </tr>
		<tr>
          <td>Aprobado:</td>
          <td><input type="text" name="newrev_aprobado" id="newrev_aprobado" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Fecha:</td>
          <td><input type='text' name='newrev_fecha' id='newrev_fecha' value='' size='14'></input>
			  <img style="cursor:pointer;" src='<?php echo CAL_RUTA_NIVEL1."img/calendar2.png";?>' id='cal1'>
			  <script>
				Calendar.setup({
				trigger    : "cal1",
				inputField : "newrev_fecha"
				});
			  </script>
		  </td>
        </tr>
        <tr>
          <td>Lugar:</td>
          <td><input type="text" name="lugar" id="lugar" value='' size='35' /></td>
        </tr>
        <tr>
          <td>Periodo:</td>
          <td>	
			<select name='anos' id='anos<?php echo $valor['id'];?>'>
				<?php for($i = 0; $i < 30; $i++){
					echo "<option value='$i'>$i</option>";	
				}?>
			</select> a&ntilde;os
			<select name='meses' id='meses<?php echo $valor['id']; ?>'>
				<?php for($i = 0; $i < 13; $i++){
					echo "<option value='$i'>$i</option>";
				}?>
			</select> meses
		  </td>
        </tr>
        <tr>
          <td>Desc. cambio:</td>
          <td><textarea name="newrev_cambio" id="newrev_cambio" cols="70" rows="3"></textarea></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
          	<input class="bt-accion" type="button" onclick="$('#crear_revision').submit();"  name="img_crear" id="img_crear" value="Crear" />

			<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $_POST['id_documento']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />
    	
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
    
    <form action='ficha_documento.php' method='post' id='cancelar_<?php echo $_POST['id_documento']; ?>'>
		<input type='hidden' name='id_documento' value='<?php echo $_POST['id_documento']; ?>'></input>
		<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	</form>
</div>

<?php include('../struct/footer2.php');?>
  
</div>
</div>

</body>
</html>
