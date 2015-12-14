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
header("Content-Disposition: attachment; filename=Informe_visitas_previstas.xls");
header("Pragma: no-cache");

include("../functions/globales.php");
include("../functions/funciones.php");
$personal = array_personal(); ?>

<table>
	<tr>
		<td colspan=2 style='text-decoration: underline;'>Informe de finalizaci&oacute;n de trabajos por mes</td>
		<td colspan=3 style='text-align: right;'>KZ Adeada Talleres El&eacute;ctricos - <?php echo conversion_formato_fecha(date('Y-m-d'), 'abreviado')." -- ".date('H:i:s');?></td>
	</tr>
</table>
<br>

<table border=1>
	<tr>
		<td colspan=2 style='background-color: #969696;'>FILTROS</td>
	</tr>
	<tr>
		<td colspan=2>Trabajador: <?php echo $personal[$_POST['fil_persona']];?></td>
	</tr>
	<tr>
		<td colspan=2>A&ntilde;o: <?php echo $_POST['anno'];?></td>
	</tr>
	<tr>
		<td colspan=2>Mes: <?php echo $_POST['mes'];?></td>
	</tr>
</table>
<br>

<?php if($_POST['mes'] == 'ENERO'){ $mes_seleccionado = '01'; }
if($_POST['mes'] == 'FEBRERO'){ $mes_seleccionado = '02'; }
if($_POST['mes'] == 'MARZO'){ $mes_seleccionado = '03'; }
if($_POST['mes'] == 'ABRIL'){ $mes_seleccionado = '04'; }
if($_POST['mes'] == 'MAYO'){ $mes_seleccionado = '05'; }
if($_POST['mes'] == 'JUNIO'){ $mes_seleccionado = '06'; }
if($_POST['mes'] == 'JULIO'){ $mes_seleccionado = '07'; }
if($_POST['mes'] == 'AGOSTO'){ $mes_seleccionado = '08'; }
if($_POST['mes'] == 'SEPTIEMBRE'){ $mes_seleccionado = '09'; }
if($_POST['mes'] == 'OCTUBRE'){ $mes_seleccionado = '10'; }
if($_POST['mes'] == 'NOVIEMBRE'){ $mes_seleccionado = '11'; }
if($_POST['mes'] == 'DICIEMBRE'){ $mes_seleccionado = '12'; }?>

<table class='tabla_resultado_informe' width='100%' border=1>
	<tr>
		<td style='font-weight:bold; text-align: left; background-color: #C0C0C0;'>Cliente || Trabajo</td>
		<td style='font-weight:bold; text-align: left; background-color: #C0C0C0;'>Prioridad</td>
		<td style='font-weight:bold; text-align: left; background-color: #C0C0C0;'>Fecha inicio</td>
		<td style='font-weight:bold; text-align: left; background-color: #C0C0C0;'>Fecha fin</td>
		<td style='font-weight:bold; text-align: left; background-color: #C0C0C0;'>Horas</td>
	</tr>
	
	<?php 
	if($_POST['fil_persona'] != ''){
		$proyectos = select_normal("SELECT kz_te_proyectos.id as idproyecto, kz_te_proyectos.*, kz_te_clientes.* FROM kz_te_proyectos, kz_te_clientes, kz_te_proyecto_personal WHERE kz_te_clientes.id = kz_te_proyectos.cliente AND finalizado = '0' AND kz_te_proyecto_personal.tecnico = '".$_POST['fil_persona']."' AND kz_te_proyecto_personal.proyecto = kz_te_proyectos.id");
	}
	else{
		$proyectos = select_normal("SELECT kz_te_proyectos.id as idproyecto, kz_te_proyectos.*, kz_te_clientes.* FROM kz_te_proyectos, kz_te_clientes WHERE kz_te_clientes.id = kz_te_proyectos.cliente AND finalizado = '0'");
	}
	
	foreach($proyectos as $key => $valor){
		$dividir_fecha = explode ("-", $valor['fecha_prevista']);
		$ano = $dividir_fecha[0];
		$mes = $dividir_fecha[1];

		if(($ano == $_POST['anno']) && ($mes == $mes_seleccionado)){?>
			<tr>
				<td style='text-align: center;'><?php echo $valor['nombre_comercial']." || ".$valor['idproyecto']." - ".$valor['nombre'];?></td>
				<td style='text-align: center;'><?php echo $valor['prioridad'];?></td>
				<td style='text-align: center;'><?php echo $valor['fecha_inicio'];?></td>
				<td style='text-align: center;'><?php echo $valor['fecha_prevista'];?></td>
				<td style='text-align: center;'><?php echo $valor['horas_auditoria'];?></td>
			</tr>
		<?php }
	}?>	
</table>