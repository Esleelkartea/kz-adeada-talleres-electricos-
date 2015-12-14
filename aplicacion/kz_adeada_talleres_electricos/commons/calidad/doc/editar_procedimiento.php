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
	<script>document.getElementById("lnk_ver_procedimientos").setAttribute("class", "seleccionado");</script>
<?php }
else{?>
	<script>document.getElementById("lnk_ver_documentos").setAttribute("class", "seleccionado");</script>
<?php }?>

<?php if($_POST['id_real']){
	$procedimiento = select_normal("SELECT * FROM kz_tec_doc_procedimientos WHERE id = '".$_POST['id_real']."'"); 
}
else{
	if($_POST['id_procedimiento']){
		$procedimiento = select_normal("SELECT * FROM kz_tec_doc_procedimientos WHERE id = '".$_POST['id_procedimiento']."'");
	} 
	else{
		$link = conectar(BBDDUSUARIO);
		$sql = "SELECT max(idrev) as maxima_rev FROM kz_tec_doc_procedimientos WHERE iddoc = ".$_POST['rev_doc']."";
		$rs = mysql_query($sql);
		while($row = mysql_fetch_assoc($rs)){
			$procedimiento = select_normal("SELECT * FROM kz_tec_doc_procedimientos WHERE iddoc = ".$_POST['rev_doc']." AND idrev = ".$row['maxima_rev']."");
		}
	} 
}

if($procedimiento)
	foreach($procedimiento as $key => $valor){ ?>
	
	  <div id="cuerpo2">
	  	
		<?php if(!$_POST['pag']){?>
			<form action="ver_procedimientos.php" method="post" id="guardar_procedimiento_<?php echo $valor['id']; ?>" name="form_guardar">
		<?php }
		else{
			if($_POST['pag'] == 'ficha_documento'){?>
			<form action="ficha_documento.php" method="post" id="guardar_procedimiento_<?php echo $valor['id']; ?>" name="form_guardar">
				<input type='hidden' name='rev_doc' value='<?php echo $_POST['id_documento']; ?>'></input>
			<?php }
			else{
				if($_POST['pag'] == 'nueva_revision'){?>
				<form action="ficha_documento.php" method="post" id="guardar_procedimiento_<?php echo $valor['id']; ?>" name="form_guardar">
					<input type='hidden' name='rev_doc' value='<?php echo $_POST['rev_doc']; ?>'></input>
				<?php }
			}
		}?>

	  	  <input type='hidden' name='editar_procedimiento' value='<?php echo $valor['id']; ?>'></input>
	  	  <input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	      <table class="tabla_sin_borde" width="100%">
	      
	      	<?php if(!$_POST['pag']){?>
		      	<tr>
		          <td width="9%">Documento:</td>
		          <td><?php $doc=select_normal("SELECT dd.tipo, dd.cod, dd.nombre FROM kz_tec_doc_documentos dd, kz_tec_doc_procedimientos dp WHERE dd.tipo = 'PROCEDIMIENTO' AND dd.id=dp.iddoc");
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
	          <td colspan=2>Objeto:</td>
	        </tr>
	        <tr>
	          <td colspan=2><textarea name="objeto" id="objeto" cols="115" rows="3"><?php echo $valor['objeto']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td colspan=2>Alcance:</td>
	        </tr>
	        <tr>
	          <td colspan=2><textarea name="alcance" id="alcance" cols="115" rows="3"><?php echo $valor['alcance']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td colspan=2>Responsabilidades:</td>
	        </tr>
	        <tr>
	          <td colspan=2><textarea name="responsabilidades" id="responsabilidades" cols="115" rows="3"><?php echo $valor['responsabilidades']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td colspan=2>Desarrollo:</td>
	        </tr>
	        <tr>
	          <td colspan=2><textarea name="desarrollo" id="desarrollo" cols="115" rows="3"><?php echo $valor['desarrollo']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td colspan=2>Flujo del proceso:</td>
	        </tr>
	        <tr>
	          <td colspan=2><textarea name="flujo_proceso" id="flujo_proceso" cols="115" rows="3"><?php echo $valor['flujo_proceso']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td colspan=2>Referencias:</td>
	        </tr>
	        <tr>
	          <td colspan=2><textarea name="referencias" id="referencias" cols="115" rows="3"><?php echo $valor['referencias']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td colspan=2>Registros asociados:</td>
	        </tr>
	        <tr>
	          <td colspan=2><textarea name="registros_asociados" id="registros_asociados" cols="115" rows="3"><?php echo $valor['registros_asociados']; ?></textarea></td>
	        </tr>
	        <tr>
	          <td colspan=2>&nbsp;</td>
	        </tr>
	        <tr>
	          <td colspan=2>
	          	<input class="bt-accion" type="button" onclick="$('#guardar_procedimiento_<?php echo $valor['id']; ?>').submit();"  name="img_guardar" id="img_guardar<?php echo $valor['id'];  ?>" value="Guardar" />
          	
				<input class="bt-accion" type="button" onclick="$('#cancelar_<?php echo $valor['id']; ?>').submit();" name="img_cancelar" id="img_cancelar<?php echo $valor['id'];  ?>" value="Cancelar" />

	          </td>
	        </tr>
	        <tr>
	          <td colspan=2>&nbsp;</td>
	        </tr>
	      </table>
	    </form>
		
		<?php if(!$_POST['pag']){?>
		<form action='ver_procedimientos.php' method='post' id='cancelar_<?php echo $valor['id']; ?>'>
		<?php }
		else{?>
			<form action='ficha_documento.php' method='post' id='cancelar_<?php echo $valor['id']; ?>'>
		<?php }?>
		
			<input type='hidden' name='id_documento' value='<?php echo $_POST['id_documento']; ?>'></input>
			<input type='hidden' name='id_procedimiento' value='<?php echo $valor['id']; ?>'></input>
			<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
		</form>
	  </div>
	<?php }
  
include('../struct/footer2.php'); ?>
  
</div>

</body>
</html>
