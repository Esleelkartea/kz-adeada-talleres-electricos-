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
header("Content-Disposition: attachment; filename=Informe_listado_trabajos.xls");
header("Pragma: public");

include("../functions/globales.php");
include("../functions/funciones.php");

$proyectos = select_normal("SELECT * FROM kz_te_proyectos ORDER BY id");?>

<table>
	<tr>
		<td colspan=2 style='text-decoration: underline;'>Informe de listado de trabajos</td>
		<td colspan=5 style='text-align: right;'>KZ Adeada Talleres El&eacute;ctricos - <?php echo conversion_formato_fecha(date('Y-m-d'), 'abreviado')." -- ".date('H:i:s');?></td>
	</tr>
</table>
<br>

<table class='tabla_resultado_informe' width='100%' border=1>
	<tr>
		<td style='font-weight:bold; text-align: left; background-color: #C0C0C0;'>Cod.</td>
		<td style='font-weight:bold; text-align: left; background-color: #C0C0C0;'>Nombre</td>
		<td style='font-weight:bold; text-align: left; background-color: #C0C0C0;'>Cliente</td>
		<td style='font-weight:bold; text-align: left; background-color: #C0C0C0;'>Prioridad</td>
		<td style='font-weight:bold; text-align: left; background-color: #C0C0C0;'>Fecha inicio</td>
		<td style='font-weight:bold; text-align: left; background-color: #C0C0C0;'>Fecha fin</td>
		<td style='font-weight:bold; text-align: left; background-color: #C0C0C0;'>Finalizado</td>
	</tr>
	
	<?php if($proyectos)
	foreach($proyectos as $key => $valor){ ?>
	
		<tr>
			<td style='text-align: center;'><?php echo $valor['id'];?></td>
			<td style='text-align: center;'><?php echo $valor['nombre'];?></td>
			<td style='text-align: center;'><?php echo $PARTES_CLIENTES[$valor['cliente']];?></td>
			<td style='text-align: center;'><?php echo $valor['prioridad'];?></td>
			<td style='text-align: center;'><?php echo $valor['fecha_inicio'];?></td>
			<td style='text-align: center;'><?php echo $valor['fecha_prevista'];?></td>
			<?php if($valor['finalizado'] == '0'){ ?>
				<td style='text-align: center;'><?php echo 'NO'; ?></td>
			<?php } 
			if($valor['finalizado'] == '1'){ ?>
				<td style='text-align: center;'><?php echo 'SI'; ?></td>
			<?php } ?>
		</tr>
	<?php }?>
</table>