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

<div id = "link_normal"><img src='../img/iconos/volver.png' id='plus' /> <a class="color_enlaces" href="javascript:" onclick="$('#volver_<?php echo $valor['id']; ?>').submit();">Volver</a></div>
<form action="ver_documentos.php" method="post" id="volver_<?php echo $valor['id'];?>">
	<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
</form>
<br>

<?php if(isset($_POST['rev_iddoc'])){
	$documento = select_normal("SELECT * FROM kz_tec_doc_documentos WHERE id = '".$_POST['rev_iddoc']."'");
}
else{
	if(isset($_POST['rev_doc'])){
		$documento = select_normal("SELECT * FROM kz_tec_doc_documentos WHERE id = '".$_POST['rev_doc']."'");
	}
	else{
		if(isset($_POST['edid_id'])){
			$documento = select_normal("SELECT * FROM kz_tec_doc_documentos WHERE id = '".$_POST['edid_id']."'");
		}
		else{
			if(isset($_POST['edid_rev_id'])){
				$documento = select_normal("SELECT * FROM kz_tec_doc_documentos WHERE id = '".$_POST['edid_rev_id']."'");
			}
			else{
				if(isset($_POST['real_doc'])){
					$documento = select_normal("SELECT * FROM kz_tec_doc_documentos WHERE id = '".$_POST['real_doc']."'");
				}
				else{
					if(isset($_POST['edid_real_id'])){
						$documento = select_normal("SELECT * FROM kz_tec_doc_documentos WHERE id = '".$_POST['edid_real_id']."'");
					}
					else{
						$documento = select_normal("SELECT * FROM kz_tec_doc_documentos WHERE id = '".$_POST['id_documento']."'");
					}
				}
			}
		}
	}
}
?>

<div id="cuerpo2">
  <?php if($documento)
	foreach($documento as $key => $valor){ ?>
	   <div id="objetivo">
	     <table width="100%" border="0" cellspacing="0">
	       <tr>
	         <th>Tipo</th>
	         <th>Cod</th>
	         <th>Nombre</th>
	         <th>Descripci&oacute;n</th>
	         <th>Tipo</th>
	         <th>Generado</th>
	         <th>Interno</th>
	         <th>Acciones</th>
	       </tr>
	       <tr>
	         <td><?php echo $valor['tipo']; ?></td>
	         <td><?php echo $valor['cod']; ?></td>
	         <td><?php echo $valor['nombre']; ?></td>
	         <td><?php echo $valor['descripcion']; ?></td>
	         <td><?php echo $valor['tipo_doc']; ?></td>
	         <td><?php echo $valor['generado']; ?></td>
	         <td><?php if(($valor['interno'])=='1'){ echo "SI"; }
						else{ echo "NO"; } ?></td>
	         <td>
	         	<a class="bt-editar" style="cursor:pointer; font-weight:bold;" onclick="$('#editar_documento_<?php echo $valor['id'];  ?>').submit();"></a>
		        
		        <hr class="linea_separacion">
		        <a class="bt-eliminar" style="cursor:pointer; font-weight:bold;" onclick="if(confirm('Si elimina este documento, tambi&eacute;n se borrar&aacute;n sus revisiones. &iquest;Continuar?')){ 
		        $('#eliminar_documento_<?php echo $valor['id'];  ?>').submit(); }"></a>
	         				
	         	<form action="editar_documento.php" method="post" id="editar_documento_<?php echo $valor['id'];?>">
					<input type='hidden' name='id_documento' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
				</form>
	         	
	         	<form action='ver_documentos.php' method='post' id='eliminar_documento_<?php echo $valor['id'];  ?>'>
					<input type='hidden' name='eli_doc' value='<?php echo $valor['id']; ?>'></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
			 	</form>
	         </td>
	       </tr>
	     </table>
	   </div>
	<?php }?>
	
  <div id="anadir_algo">
   <div id="col2">
   	 <a class="color_enlaces" href="javascript:" onclick="$('#nueva_revision_<?php echo $valor['id']; ?>').submit();">+ revisi&oacute;n</a>
	 <form action="nueva_revision.php" method="post" id="nueva_revision_<?php echo $valor['id'];?>">
	 	<input type='hidden' name='id_documento' value='<?php echo $valor['id'];?>' ></input>
	 	<input type='hidden' name='tipo_doc' value='<?php echo $valor['tipo'];?>' ></input>
	 	<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	 </form>
   </div>
   <div id="col2">
   	<?php if($valor['tipo'] == 'MANUAL'){ 
   		$hay_doc_real = select_normal("SELECT * FROM kz_tec_doc_manual WHERE iddoc='".$valor['id']."'");
   		if(!$hay_doc_real){?>
   			<a class="color_enlaces" href="javascript:" onclick="$('#nuevo_documento_real_<?php echo $valor['id']; ?>').submit();">+ documento real</a>
   	 		<form action="nuevo_manual.php" method="post" id="nuevo_documento_real_<?php echo $valor['id'];?>">
   	 			<input type='hidden' name='pag' value='ficha_documento'></input>
   	 	<?php } 
	}
    else{
    	if($valor['tipo'] == 'PROCEDIMIENTO'){ 
    		$hay_doc_real = select_normal("SELECT * FROM kz_tec_doc_procedimientos WHERE iddoc='".$valor['id']."'");
   			if(!$hay_doc_real){?>
   				<a class="color_enlaces" href="javascript:" onclick="$('#nuevo_documento_real_<?php echo $valor['id']; ?>').submit();">+ documento real</a>
    			<form action="nuevo_procedimiento.php" method="post" id="nuevo_documento_real_<?php echo $valor['id'];?>">
    				<input type='hidden' name='pag' value='ficha_documento'></input>
    		<?php }
    	}
    	else{
    		$hay_doc_real = select_normal("SELECT * FROM kz_tec_doc_documentos_reales WHERE iddoc='".$valor['id']."'");
   			if(!$hay_doc_real){?>
				<a class="color_enlaces" href="javascript:" onclick="$('#nuevo_documento_real_<?php echo $valor['id']; ?>').submit();">+ documento real</a>   			
    			<form action="nuevo_documento_real.php" method="post" id="nuevo_documento_real_<?php echo $valor['id'];?>">
    				<input type='hidden' name='pag' value='ficha_documento'></input>
    		<?php }
    	}
    }

   	 
   	 if($valor['tipo'] == 'MANUAL'){ ?>
   	 	<form action="nuevo_manual.php" method="post" id="nuevo_documento_real_<?php echo $valor['id'];?>">
   	 		<input type='hidden' name='pag' value='ficha_documento'></input>
   	 <?php }
   	 else{
   	 	if($valor['tipo'] == 'PROCEDIMIENTO'){ ?>
   	 		<form action="nuevo_procedimiento.php" method="post" id="nuevo_documento_real_<?php echo $valor['id'];?>">
   	 			<input type='hidden' name='pag' value='ficha_documento'></input>
   	 	<?php }
   	 	else{?>
   	 		<form action="nuevo_documento_real.php" method="post" id="nuevo_documento_real_<?php echo $valor['id'];?>">
   	 	<?php }
   	 } ?>
   	
	 	<input type='hidden' name='id_documento' value='<?php echo $valor['id'];?>' ></input>
	 	<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
	 </form>
   </div>
   <div id="limpiar"></div>
  </div>
  
  <?php $revisiones = select_normal("SELECT * FROM kz_tec_doc_revisiones WHERE iddoc = '".$valor['id']."' ORDER BY fecha DESC");
  if($revisiones)
  	foreach($revisiones as $key_rev => $valor_rev){?>
	  <div id="seguimiento">
	    <div id="triangulo"><img src="../img/triangulo.png" width="37" height="25" /></div>
		<table width="100%" border="0" cellspacing="0">
	       <tr>
	         <th><p class="linea_blanca">REVISIONES</p></th>
	       </tr>
	       <tr>
	         <th>Rev.</th>
	         <th>Fecha</th>
	         <th>Soporte</th>
	         <th>Realizado</th>
	         <th>Aprobado</th>
	         <th>Vigor</th>
	         <th>Cambios</th>
	         <th>Periodo</th>
	         <th>Lugar</th>
	         <th colspan=2>Acciones</th>
	       </tr>
	       <tr>
	         <td><?php echo $valor_rev['rev']; ?></td>
	         <td><?php echo $valor_rev['fecha']; ?></td>
	         <td><?php echo $valor_rev['soporte']; ?></td>
	         <td><?php echo $valor_rev['realizado']; ?></td>
	         <td><?php echo $valor_rev['aprobado']; ?></td>
	         <td><?php echo siono($valor_rev["vigor"]); ?></td>
	         <td><?php echo $valor_rev['cambio']; ?></td>
	         <td><?php $periodo  = explode(',', $valor_rev['periodo']);
				 echo $periodo[0]." a&ntilde;os, ".$periodo[1]." meses";?>
			 </td>
	         <td><?php echo $valor_rev['lugar']; ?></td>
	         <td width=54><?php if($valor_rev["vigor"]==0){ ?>
	         		<a style='color:#9ACD32; cursor:pointer;' onClick="$('#setrev_vigor_<?php echo $valor_rev['id']; ?>').submit();">Poner en vigor</a>
					<form action='ficha_documento.php' name='setrev_vigor' method='post' id='setrev_vigor_<?php echo $valor_rev['id']; ?>'>
						<input type='hidden' name='estado_vigor' id='estado_vigor' value='1'></input>
						<input type='hidden' name='rev_iddoc' id='rev_iddoc' value='<?php echo $valor['id']; ?>'></input>
						<input type='hidden' name='rev_vigor' id='rev_vigor' value='<?php echo $valor_rev['id']; ?>'></input>
						<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
					</form> 
				 <?php }
				 else { ?>
					<a style='color:red; cursor:pointer;' onClick="$('#unsetrev_vigor_<?php echo $valor_rev['id']; ?>').submit();">Quitar en vigor</a>
					<form action='ficha_documento.php' name='unsetrev_vigor' method='post' id='unsetrev_vigor_<?php echo $valor_rev['id']; ?>'>
						<input type='hidden' name='estado_vigor' id='estado_vigor' value='0'></input>
						<input type='hidden' name='rev_iddoc' id='rev_iddoc' value='<?php echo $valor['id']; ?>'></input>
						<input type='hidden' name='rev_vigor' id='rev_vigor' value='<?php echo $valor_rev['id']; ?>'></input>
						<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
					</form> 
				 <?php }?>
			 </td>
			 <td>
			 	<a class="bt-editar" style="cursor:pointer; font-weight:bold;" onclick="$('#editar_revision_<?php echo $valor_rev['id'];  ?>').submit();"></a>

			 	<?php if (count($revisiones) > 1){ ?>
			 		<hr class="linea_separacion">
					<a class="bt-eliminar" style="cursor:pointer; font-weight:bold;" onclick="if(confirm('&iquest;Desea eliminar esta revisi&oacute;n?')){ 
		        		$('#eliminar_revision_<?php echo $valor_rev['id'];  ?>').submit(); }"></a>
		         							
		         	<form action='ficha_documento.php' method='post' id='eliminar_revision_<?php echo $valor_rev['id'];  ?>'>
						<input type='hidden' name='elimrev_id' value='<?php echo $valor_rev['id']; ?>'></input>
						<input type='hidden' name='id_documento' value='<?php echo $valor['id'];?>' ></input>
						<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
				 	</form>
				<?php }?>
				
				<form action="editar_revision.php" method="post" id="editar_revision_<?php echo $valor_rev['id'];?>">
					<input type='hidden' name='id_revision' value='<?php echo $valor_rev['id'];?>' ></input>
					<input type='hidden' name='id_documento' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
				</form>
	         </td>
	       </tr>
	    </table>
	  </div>
	  
	  <?php if($valor['tipo'] == 'MANUAL'){
	  $doc_reales = select_normal("SELECT * FROM kz_tec_doc_manual WHERE iddoc = '".$valor['id']."' AND idrev = '".$valor_rev['rev']."'");
	  if($doc_reales){?>
		  <div id="seguimiento">
	    	<div id="triangulo"><img src="../img/triangulo.png" width="37" height="25" /></div>
			<table width="100%" border="0" cellspacing="0">
		       <tr>
		         <th><p class="linea_blanca">DOCUMENTOS REALES</p></th>
		       </tr>
		       <tr>
		         <th>Descripci&oacute;n cambios</th>
		         <th colspan=2>Acciones</th>
		       </tr>
		      <?php foreach($doc_reales as $key_real => $valor_real){?>
		       <tr>
		         <td><?php echo $valor_real['descripcion']; ?></td>
		         <td>
		         <a class="bt-editar" style="cursor:pointer; font-weight:bold;" onclick="$('#editar_documento_real_<?php echo $valor_real['id'];  ?>').submit();"></a>
		        
					<form action="editar_manual.php" method="post" id="editar_documento_real_<?php echo $valor_real['id'];?>">
						<input type='hidden' name='pag' value='ficha_documento' ></input>
						<input type='hidden' name='id_real' value='<?php echo $valor_real['id'];?>' ></input>
						<input type='hidden' name='id_documento' value='<?php echo $valor['id'];?>' ></input>
						<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
					</form>
		         </td>
		         <td>
		         	<form action='pdf_manual.php' method='post' target='new' id='pdf_documento_real_<?php echo $valor_real['id'];?>'>
	  	  				<input type='hidden' name='pdf' value='pdf'>
	  	 			 	<input type='hidden' name='manual' value='<?php echo $valor_real['id']; ?>'>
	  	 			 	<input class="boton" type="button" onclick="$('#pdf_documento_real_<?php echo $valor_real['id'];?>').submit();"  name="img_pdf" id="img_pdf" value="PDF" />

	  				</form>
				 </td>
		       </tr>
		      <?php }?>
		    </table>
		  </div>
	  <?php }
  }
  else{
  	if($valor['tipo'] == 'PROCEDIMIENTO'){
  	  $doc_reales = select_normal("SELECT * FROM kz_tec_doc_procedimientos WHERE iddoc = '".$valor['id']."' AND idrev = '".$valor_rev['rev']."'");
	  if($doc_reales){?>
		   <div id="seguimiento">
	    	<div id="triangulo"><img src="../img/triangulo.png" width="37" height="25" /></div>
			<table width="100%" border="0" cellspacing="0">
		       <tr>
		         <th><p class="linea_blanca">DOCUMENTOS REALES</p></th>
		       </tr>
		       <tr>
		         <th>Descripci&oacute;n cambios</th>
		         <th colspan=2>Acciones</th>
		       </tr>
		      <?php foreach($doc_reales as $key_real => $valor_real){?>
		       <tr>
		         <td><?php echo $valor_real['descripcion']; ?></td>
		         <td>
				 	<a class="bt-editar" style="cursor:pointer; font-weight:bold;" onclick="$('#editar_documento_real_<?php echo $valor_real['id'];  ?>').submit();"></a>
					
					<form action="editar_procedimiento.php" method="post" id="editar_documento_real_<?php echo $valor_real['id'];?>">
						<input type='hidden' name='pag' value='ficha_documento' ></input>
						<input type='hidden' name='id_real' value='<?php echo $valor_real['id'];?>' ></input>
						<input type='hidden' name='id_documento' value='<?php echo $valor['id'];?>' ></input>
						<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
					</form>
		         </td>
		         <td>
		         	<form action='pdf_procedimientos.php' method='post' target='new' id='pdf_documento_real_<?php echo $valor_real['id'];?>'>
	  	  				<input type='hidden' name='pdf' value='pdf'>
	  	 			 	<input type='hidden' name='procedimiento' value='<?php echo $valor_real['id']; ?>'>
	  	 			 	<input class="boton" type="button" onclick="$('#pdf_documento_real_<?php echo $valor_real['id'];?>').submit();"  name="img_pdf" id="img_pdf" value="PDF" />
	  	 			
	  				</form>
				 </td>
		       </tr>
		      <?php }?>
		    </table>
		  </div>
	  <?php }
  	}
  	else{
  	$doc_reales = select_normal("SELECT * FROM kz_tec_doc_documentos_reales WHERE iddoc = '".$valor['id']."' AND idrev = '".$valor_rev['rev']."' ORDER BY fecha DESC");
  if($doc_reales){?>
	   <div id="seguimiento">
	    <div id="triangulo"><img src="../img/triangulo.png" width="37" height="25" /></div>
		<table width="100%" border="0" cellspacing="0">
	       <tr>
	         <th><p class="linea_blanca">DOCUMENTOS REALES</p></th>
	       </tr>
	       <tr>
	         <th>Fecha</th>
	         <th>T&iacute;tulo</th>
	         <th colspan=2>Acciones</th>
	       </tr>
	      <?php foreach($doc_reales as $key_real => $valor_real){?>
	       <tr>
	         <td><?php echo $valor_real['fecha']; ?></td>
	         <td><?php echo $valor_real['titulo']; ?></td>
	         <td>
			 	<a class="bt-editar" style="cursor:pointer; font-weight:bold;" onclick="$('#editar_documento_real_<?php echo $valor_real['id'];  ?>').submit();"></a>
				
				<form action="editar_documento_real.php" method="post" id="editar_documento_real_<?php echo $valor_real['id'];?>">
					<input type='hidden' name='id_real' value='<?php echo $valor_real['id'];?>' ></input>
					<input type='hidden' name='id_documento' value='<?php echo $valor['id'];?>' ></input>
					<input type='hidden' name='p' value='<?php echo $_POST['p']; ?>'></input>
				</form>
	         </td>
	         <td>
	         	<form action='pdf_documento_real.php' method='post' target='new' id='pdf_documento_real_<?php echo $valor_real['id'];?>'>
  	  				<input type='hidden' name='pdf' value='pdf'>
  	 			 	<input type='hidden' name='documento_real' value='<?php echo $valor_real['id']; ?>'>
  	 			 	<input class="boton" type="button" onclick="$('#pdf_documento_real_<?php echo $valor_real['id'];?>').submit();"  name="img_pdf" id="img_pdf" value="PDF" />

  				</form>
			 </td>
	       </tr>
	      <?php }?>
	    </table>
	  </div>
  <?php }
  	}
  }
	  
}?>
</div>
<div id="limpiar"></div>

<?php include('../struct/footer2.php'); ?>

</div>

</body>
</html>
