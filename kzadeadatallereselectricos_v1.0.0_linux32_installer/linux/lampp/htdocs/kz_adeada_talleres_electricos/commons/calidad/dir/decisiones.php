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

if($_POST['nuevadecision']){
	ejecutar_query("Insert into kz_tec_dir_decisionesreunion values(null, ".$_POST['id_reunion'].", ".$_POST['nuevadecision'].", '', '', '0')");
	echo "<script>alert('Decisi&oacute;n a&ntilde;adida correctamente');</script>";
}

$reunion = decisiones_reunion($idreunion_decision); ?>

<table style='width: 76%;' border=0>
	<tr>
		<td>
			<?php $decisiones = select_normal("Select * from kz_tec_dir_decisiones a where a.id not in (Select b.iddecision from kz_tec_dir_decisionesreunion b where b.cerrado = 1 OR idreunion = '".$_POST['id_reunion']."')"); ?>
			<div id='select_decisiones_<?php echo $idreunion_decision; ?>' style='<?php echo $display_combo; ?>'>
				<select style='width:100%;' name='combo_decisiones' id='combo_decisiones' size=5 onDblClick="$('#decisiones').load('decisiones.php', { nuevadecision: this.value, id_reunion: '<?php echo $idreunion; ?>' , ajax: true})">
					<?php foreach($decisiones as $key => $valor_decision){
						if(!in_array($valor_decision['id'],$reunion)){
							if($valor_decision['decision']!=''){?>
								<option value='<?php echo $valor_decision['id']; ?>'><?php echo $valor_decision['decision']; ?></option>
							<?php }
						}
					}?>
				</select>
			</div>
		</td>
	</tr>
</table>
