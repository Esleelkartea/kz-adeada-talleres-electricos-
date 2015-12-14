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
	require(RAIZ.'functions/rrhh_functions.php');
	require(RAIZ.'rrhh/rrhh_preacciones.php');
	header('Content-Type:text/html; charset=ISO-8859-1');
	$curso_asistentes = $_POST['curso'];
}
else{
	$curso_asistentes = $valor['id'];
}

$display_combo = 'display: none;';

if($_POST['nuevoasistente']){
	ejecutar_query("INSERT INTO kz_tec_rrhh_asistentesformacion values(null, ".$_POST['curso'].", ".$_POST['nuevoasistente'].", null, null, null)");
	$display_combo = "";
}

if($_POST['quitarasistente']){
	ejecutar_query("delete from  kz_tec_rrhh_asistentesformacion where curso = ".$_POST['curso']." and persona = ".$_POST['quitarasistente']."");
}

$asistentes = asistentes_a_curso($curso_asistentes);?>

<table style='width: 45%;' border=0>
	<tr>
		<td><img style="cursor:pointer;" src='<?php echo "../img/iconos/plus.png"; ?>' onClick="$('#select_asistentes').toggle();"></img>
		<?php $personas = select_normal("SELECT id, nombre, apellidos FROM kz_tec_rrhh_personal ORDER BY nombre"); ?>
		
			<div id='select_asistentes' style='<?php echo $display_combo; ?>'>
				<select name='combo_asistentes' id='combo_asistentes' size=5 onDblClick="$('#asistentes').load('asistentes.php', { nuevoasistente: this.value, curso: '<?php echo $curso_asistentes; ?>', ajax : true })">
					<?php foreach($personas as $keyp => $valorp){
						if(!in_array($valorp['id'],$asistentes)){?>
							<option value='<?php echo $valorp['id']; ?>'><?php echo $valorp['nombre']." ".$valorp['apellidos']; ?></option>
						<?php }
					}?>
				</select>
			</div>
		</td>
	</tr>

	<?php 
	if($asistentes){
		$strasistentes = implode(",",$asistentes);
		$nombres_asistentes = select_normal("SELECT id, nombre, apellidos FROM kz_tec_rrhh_personal WHERE id IN (".$strasistentes.")");
		foreach($nombres_asistentes as $keya => $valora){?>
		  <tr>
		  	<td><?php echo $valora['nombre']." ".$valora['apellidos']; ?></td>
			<td><img style="cursor:pointer;" src='<?php echo "../img/iconos/minus.png"; ?>' onClick="$('#asistentes').load('asistentes.php', { quitarasistente: '<?php echo $valora['id']; ?>', curso: '<?php echo $curso_asistentes; ?>', ajax : true })"></img></td>
		  </tr>
		<?php }
	}
	else{
		echo "<tr><td>No hay asistentes</td></tr>";
	}?>
</table>
