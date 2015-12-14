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

if($_POST['ajax']){
	require('../../../functions/globales.php');
	require('../include/rutas.php');
	require(RAIZ.'functions/main.php');
	require(RAIZ.'struct/login2.php');
	require(RAIZ.'functions/dir_functions.php');
	require(RAIZ.'dir/dir_preacciones.php');
	header('Content-Type:text/html; charset=ISO-8859-1');
	$idreunion = $_POST['id_reunion'];
}
else{
	$idreunion = $_POST['id_reunion'];
}

if($_POST['nuevotema']){	
	ejecutar_query("INSERT INTO kz_tec_dir_temasreunion VALUES(null, ".$_POST['nuevotema'].", ".$_POST['id_reunion'].", '0')");
	echo "<script>alert('Orden del d&iacute;a a&ntilde;adido correctamente');</script>";
}

$reunion = temas_reunion($idreunion); ?>

<table style='width: 73.4%;' border=0>
	<tr>
		<td>
			<?php $temas = select_normal("SELECT * FROM kz_tec_dir_temas a WHERE a.id NOT IN (SELECT b.idtema FROM kz_tec_dir_temasreunion b WHERE b.cerrado = 1 OR idreunion = '".$_POST['id_reunion']."')");?>
			<div id='select_temas_<?php echo $idreunion; ?>'>			
				<select style='width:100%' name='combo_temas' id='combo_temas' size=5 onDblClick="$('#temas').load('temas.php', { nuevotema: this.value, id_reunion: '<?php echo $idreunion; ?>' , ajax: true})">
					<?php foreach($temas as $key => $valor_tema){
						if(!in_array($valor_tema['id'],$reunion)){
							if($valor_tema['tema']!=''){?>
								<option value='<?php echo $valor_tema['id']; ?>'><?php echo $valor_tema['tema']; ?></option>
							<?php }
						}
					}?>
				</select>
			</div>
		</td>
	</tr>
</table>
