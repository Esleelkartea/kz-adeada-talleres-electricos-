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

<?php if(!$_POST['pag']){?>
	<script>document.getElementById("lnk_ver_manual").setAttribute("class", "seleccionado");</script>
<?php }
else{?>
	<script>document.getElementById("lnk_ver_documentos").setAttribute("class", "seleccionado");</script>
<?php }?>

<div id="cuerpo2">

	<?php if(!$_POST['pag']){?>
		<form action="ver_manual.php" id="crear_manual" name="form_crear" method="post">
	<?php }
	else{?>
		<form action="ficha_documento.php" id="crear_manual" name="form_crear" method="post">
			<input type='hidden' name='rev_doc' value='<?php echo $_POST['id_documento']; ?>'></input>
	<?php }?>

      <input type='hidden' name='crear_manual' value='crear_manual'></input>
      <table class="tabla_sin_borde" width="100%">
      
      	<?php if(!$_POST['pag']){?>
	      	<tr>
	          <td width="9%">Documento:</td>
	          <td><select name="num_doc"  id="num_doc">
		         	<?php $doc=select_normal("SELECT * FROM kz_tec_doc_documentos WHERE tipo = 'MANUAL' AND kz_tec_doc_documentos.id NOT IN (SELECT iddoc FROM kz_tec_doc_manual)");?>
		         	<option></option><?php
		      		foreach($doc as $keydoc => $valordoc){?>
		      			<option value='<?php echo $valordoc['id']; ?>'>
		      				<?php echo $valordoc['tipo']; ?> ||
		      				<?php echo $valordoc['cod']; ?> ||
		      				<?php echo $valordoc['nombre']; ?>
		      			</option>
		      		<?php }?>
		          </select>
		      </td>
	        </tr>
	        <tr>
	          <td height='20'></td>
	        </tr>
        <?php }
        else{?>
        	<input type='hidden' name='num_doc' value='<?php echo $_POST['id_documento']; ?>'></input>
        <?php }?>
        
        <tr>
          <td colspan=2>Presentaci&oacute;n de la empresa y su actividad:</td>
        </tr>
        <tr>
          <td colspan=2><textarea name="presentacion_empresa" id="presentacion_empresa" cols="115" rows="3"></textarea></td>
        </tr>
        <tr>
          <td colspan=2>Pol&iacute;tica de calidad de la organizaci&oacute;n:</td>
        </tr>
        <tr>
          <td colspan=2><textarea name="politica_calidad" id="politica_calidad" cols="115" rows="3"></textarea></td>
        </tr>
        <tr>
          <td colspan=2>Alcance del sistema de gesti&oacute;n de calidad:</td>
        </tr>
        <tr>
          <td colspan=2><textarea name="alcance_sistema" id="alcance_sistema" cols="115" rows="3"></textarea></td>
        </tr>
        <tr>
          <td colspan=2>Referencia a los procedimientos:</td>
        </tr>
        <tr>
          <td colspan=2><textarea name="referencia_procedimientos" id="referencia_procedimientos" cols="115" rows="3"></textarea></td>
        </tr>
        <tr>
          <td colspan=2>Mapa de procesos:</td>
        </tr>
        <tr>
          <td colspan=2><textarea name="mapa_procesos" id="mapa_procesos" cols="115" rows="3"></textarea></td>
        </tr>
        <tr>
          <td colspan=2>Organigrama de la empresa:</td>
        </tr>
        <tr>
          <td colspan=2><textarea name="organigrama_empresa" id="organigrama_empresa" cols="115" rows="3"></textarea></td>
        </tr>
        <tr>
          <td colspan=2>Funciones y responsabilidades:</td>
        </tr>
        <tr>
          <td colspan=2><textarea name="funciones_responsabilidades" id="funciones_responsabilidades" cols="115" rows="3"></textarea></td>
        </tr>
        <tr>
          <td colspan=2>&nbsp;</td>
        </tr>
        <tr>
          <td colspan=2>
          	<input class="bt-accion" type="button" onclick="$('#crear_manual').submit();"  name="img_crear" id="img_crear" value="Crear" />

			<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $_POST['id_documento']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />
   	
          </td>
        </tr>
        <tr>
          <td colspan=2>&nbsp;</td>
        </tr>
      </table>
    </form>
    
    <?php if(!$_POST['pag']){?>
		<form action='ver_manual.php' method='post' id='cancelar_<?php echo $_POST['id_documento']; ?>'>
	<?php }
	else{?>
		<form action='ficha_documento.php' method='post' id='cancelar_<?php echo $_POST['id_documento']; ?>'>
	<?php }?>
    
		<input type='hidden' name='id_documento' value='<?php echo $_POST['id_documento']; ?>'></input>
		<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	</form>
</div>
  
<?php include('../struct/footer2.php');?>
   
</div>
</div>

</body>
</html>
