<?php session_start();
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
?>
<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Informe_temas_pendientes.xls");
header("Pragma: public");

include("../functions/globales.php");
include("../functions/funciones.php");
$personal = array_personal();

if($_POST['fil_persona'] != ''){
	$criterios .= " and responsable = '".$_POST['fil_persona']."' ";
}

$temas = select_normal("SELECT * FROM kz_te_temas_pendientes WHERE ok = '0' and 1=1 $criterios ORDER BY plazo");

$persona_actual = ''; ?>

<table>
	<tr>
		<td colspan=2 style='text-decoration: underline;'>Informe de temas pendientes</td>
		<td colspan=3 style='text-align: right;'>KZ Adeada Talleres El&eacute;ctricos - <?php echo conversion_formato_fecha(date('Y-m-d'), 'abreviado')." -- ".date('H:i:s');?></td>
	</tr>
</table>
<br>

<table border=1>
	<tr>
		<td colspan=3 style='background-color: #969696;'>FILTROS</td>
	</tr>
	<tr>
		<?php 
		if($_POST['fil_persona'] != ''){?>
			<td colspan=3>Trabajador: <?php echo $personal[$_POST['fil_persona']];?></td>
		<?php }
		else{ ?>
			<td colspan=3>Trabajador: <?php echo "TODOS";?></td>
		<?php }?>
	</tr>
	<tr>
		<td colspan=3>Cliente || Trabajo: <?php echo $_POST['cliente_proyecto'];?></td>
	</tr>
</table>
<br>

<?php 
if($_POST['fil_persona'] != ''){
	$criterios .= " and responsable = '".$_POST['fil_persona']."' ";
}

$dividir_cliente = explode("||", $_POST['cliente_proyecto']);
$proyecto = $dividir_cliente[1];

if($proyecto != ''){
	$criterios3 .= " and proyecto = '".$proyecto."' ";
}

$temas = select_normal("SELECT * FROM kz_te_temas_pendientes WHERE ok = '0' and 1=1 $criterios and 1=1 $criterios3 ORDER BY plazo");

$persona_actual = '';

if($_POST['aplicar_filtros']){?>

	<table class='tabla_resultado_informe' width='100%' border=1>
		<tr>
			<td width=70 style='font-weight: bold; background-color: #969696; font-size: 1.1em;'>Fecha</td>
			<td width=500 style='font-weight: bold; background-color: #969696; font-size: 1.1em;'>Descripci&oacute;n</td>
			<td width=250 style='font-weight: bold; background-color: #969696; font-size: 1.1em;'>Responsable</td>
			<td width=70 style='font-weight: bold; background-color: #969696; font-size: 1.1em;'>Plazo</td>
			<td width=30 style='font-weight: bold; background-color: #969696; font-size: 1.1em;'>OK</td>
		</tr>
		<?php if($temas){
			foreach($temas as $key => $valor){ 
				if($persona_actual != $valor['responsable']){?>	
					<tr>
						<th colspan=5 style='background-color: #C0C0C0;'><?php echo $personal[$valor['responsable']];?></th>
						<?php $persona_actual = $valor['responsable']; ?>
					</tr>
				<?php }
				
				if($valor['ok'] == '0'){
					$ok = 'NO';
				} 
				if($valor['ok'] == '1'){
					$ok = 'SI';	
				}?>
				
				<tr>
					<td><?php echo $valor['fecha'];?></td>
					<td><?php echo $valor['tema'];?></td>
					<td><?php echo $personal[$valor['responsable']];?></td>
					<td><?php echo $valor['plazo'];?></td>
					<td><?php echo $ok;?></td>
				</tr>
			<?php }
		}
		else{
			echo "<tr><th colspan=5><i>(No hay resultados)</i></th></tr>";
		}?>
	</table>
<?php }?>