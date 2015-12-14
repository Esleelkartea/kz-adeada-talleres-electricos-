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

<?php if($_POST['id_real']){
	$manual = select_normal("SELECT * FROM kz_tec_doc_manual WHERE id = '".$_POST['id_real']."'"); 
}
else{
	if($_POST['id_manual']){
		$manual = select_normal("SELECT * FROM kz_tec_doc_manual WHERE id = '".$_POST['id_manual']."'");
	}
	else{
		$link = conectar(BBDDUSUARIO);
		$sql = "SELECT max(idrev) as maxima_rev FROM kz_tec_doc_manual WHERE iddoc = ".$_POST['rev_doc']."";
		$rs = mysql_query($sql);
		while($row = mysql_fetch_assoc($rs)){
			$manual = select_normal("SELECT * FROM kz_tec_doc_manual WHERE iddoc = ".$_POST['rev_doc']." AND idrev = ".$row['maxima_rev']."");
		}
	} 
}

if($manual)
	foreach($manual as $key => $valor){ ?>
	
	  <div id="cuerpo2">
	  
	  	<?php if(!$_POST['pag']){?>
			<form action="ver_manual.php" method="post" id="guardar_manual_<?php echo $valor['id']; ?>" name="form_guardar">
		<?php }
		else{
			if($_POST['pag'] == 'ficha_documento'){?>
			<form action="ficha_documento.php" method="post" id="guardar_manual_<?php echo $valor['id']; ?>" name="form_guardar">
				<input type='hidden' name='rev_doc' value='<?php echo $_POST['id_documento']; ?>'></input>
			<?php }
			else{
				if($_POST['pag'] == 'nueva_revision'){?>
				<form action="ficha_documento.php" method="post" id="guardar_manual_<?php echo $valor['id']; ?>" name="form_guardar">
					<input type='hidden' name='rev_doc' value='<?php echo $_POST['rev_doc']; ?>'></input>
				<?php }
			}
		}?>
	  
	  	  <input type='hidden' name='editar_manual' value='<?php echo $valor['id']; ?>'></input>
	  	  <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	      <table class="tabla_sin_borde" width="100%">
	      
	      	<?php if(!$_POST['pag']){?>
		      	<tr>
		          <td width="9%">Documento:</td>
		          <td><?php $doc=select_normal("SELECT dd.tipo, dd.cod, dd.nombre FROM kz_tec_doc_documentos dd, kz_tec_doc_manual dm WHERE dd.tipo = 'MANUAL' AND dd.id=dm.iddoc");
	         			foreach($doc as $keydoc => $valordoc){
	      					echo $valordoc['tipo']; ?> ||
	      					<?php echo $valordoc['cod']; ?> ||
	      					<?php echo $valordoc['nombre'];
	      				}?>
			      </td>
		        </tr>
		        <tr>
		          <td height='20'></td>
		        </tr>
	        <?php }?>
	        
	        <tr>
	          <td colspan=2>Descripci&oacute;n de los cambios realizados:</td>
	        </tr>
	        <tr>
	          <td colspan=2><textarea name="descripcion" id="descripcion" cols="115" rows="2"><?php echo $valor['descripcion']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td height='20'></td>
	        </tr>
	        <tr>
	          <td colspan=2>Presentaci&oacute;n de la empresa y su actividad:</td>
	        </tr>
	        <tr>
	          <td colspan=2><textarea name="presentacion_empresa" id="presentacion_empresa" cols="115" rows="3"><?php echo $valor['presentacion_empresa']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td colspan=2>Pol&iacute;tica de calidad de la organizaci&oacute;n:</td>
	        </tr>
	        <tr>
	          <td colspan=2><textarea name="politica_calidad" id="politica_calidad" cols="115" rows="3"><?php echo $valor['politica_calidad']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td colspan=2>Alcance del sistema de gesti&oacute;n de calidad:</td>
	        </tr>
	        <tr>
	          <td colspan=2><textarea name="alcance_sistema" id="alcance_sistema" cols="115" rows="3"><?php echo $valor['alcance_sistema']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td colspan=2>Referencia a los procedimientos:</td>
	        </tr>
	        <tr>
	          <td colspan=2><textarea name="referencia_procedimientos" id="referencia_procedimientos" cols="115" rows="3"><?php echo $valor['referencia_procedimientos']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td colspan=2>Mapa de procesos:</td>
	        </tr>
	        <tr>
	          <td colspan=2><textarea name="mapa_procesos" id="mapa_procesos" cols="115" rows="3"><?php echo $valor['mapa_procesos']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td colspan=2>Organigrama de la empresa:</td>
	        </tr>
	        <tr>
	          <td colspan=2><textarea name="organigrama_empresa" id="organigrama_empresa" cols="115" rows="3"><?php echo $valor['organigrama_empresa']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td colspan=2>Funciones y responsabilidades:</td>
	        </tr>
	        <tr>
	          <td colspan=2><textarea name="funciones_responsabilidades" id="funciones_responsabilidades" cols="115" rows="3"><?php echo $valor['funciones_responsabilidades']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td colspan=2>&nbsp;</td>
	        </tr>
	        <tr>
	          <td colspan=2>
	          	<input class="bt-accion" type="button" onclick="$('#guardar_manual_<?php echo $valor['id']; ?>').submit();"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
				<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />
   	
	          </td>
	        </tr>
	        <tr>
	          <td colspan=2>&nbsp;</td>
	        </tr>
	      </table>
	    </form>
		
		<?php if(!$_POST['pag']){?>
		<form action='ver_manual.php' method='post' id='cancelar_<?php echo $valor['id']; ?>'>
		<?php }
		else{?>
			<form action='ficha_documento.php' method='post' id='cancelar_<?php echo $valor['id']; ?>'>
		<?php }?>
		
			<input type='hidden' name='id_documento' value='<?php echo $_POST['id_documento']; ?>'></input>
			<input type='hidden' name='id_manual' value='<?php echo $valor['id']; ?>'></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
		</form>
	  </div>
	<?php }
  
include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
