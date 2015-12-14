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
header("Content-Disposition: attachment; filename=Informe_partes_trabajo.xls");
header("Pragma: public");

include("../functions/globales.php");
include("../functions/funciones.php");
$personal = array_personal();
$columnas = columnas('kz_te_partes');
if(!$_POST['ini_d']){
	$_POST['ini_d'] = date('d');
	$_POST['ini_m'] = date('m');
	$_POST['ini_y'] = date('Y');
	
	$_POST['fin_d'] = date('d');
	$_POST['fin_m'] = date('m');
	$_POST['fin_y'] = date('Y');	
}

foreach($_POST as $key => $valor){
	if(substr($key,0,7)=='fil_col'){
		$filtros_columnas[count($filtros_columnas)] = $valor;
		
	}
}
if($filtros_columnas)
$filtros_columnas_implode = implode(',',$filtros_columnas);
$campos = $filtros_columnas_implode;

//PONER CRITERIOS EN LOS INFORMES

$criterios .= " and dia between '".date("Y-m-d",mktime(0,0,0,$_POST['ini_m'],$_POST['ini_d'],$_POST['ini_y']))."' and '".date("Y-m-d",mktime(0,0,0,$_POST['fin_m'],$_POST['fin_d'],$_POST['fin_y']))."' ";
if($_POST['fil_persona'] != ''){
	$criterios .= " and comercial = '".$_POST['fil_persona']."' ";
}
if($_POST['cliente_proyecto'] != ''){
	$dividir_cliente = explode("||", $_POST['cliente_proyecto']);
	$proyecto = $dividir_cliente[1];
	$cliente = $dividir_cliente[0];
	$criterios .= " and cliente = '".$cliente."' and proyecto = '".$proyecto."'";
}

//REALIZAMOS LA CONSULTA

$consulta = informe_partes($criterios." order by dia DESC, comercial ASC, hora_inicio ASC", $campos);

if($_POST['aplicar_filtros']){

	if($_POST['fil_persona']){
		$kms = select_normal("SELECT * FROM kz_te_dietas WHERE fecha between '".date("Y-m-d",mktime(0,0,0,$_POST['ini_m'],$_POST['ini_d'],$_POST['ini_y']))."' and '".date("Y-m-d",mktime(0,0,0,$_POST['fin_m'],$_POST['fin_d'],$_POST['fin_y']))."' and tecnico = '".$_POST['fil_persona']."'");
	}
	else{
		$kms = select_normal("SELECT * FROM kz_te_dietas WHERE fecha between '".date("Y-m-d",mktime(0,0,0,$_POST['ini_m'],$_POST['ini_d'],$_POST['ini_y']))."' and '".date("Y-m-d",mktime(0,0,0,$_POST['fin_m'],$_POST['fin_d'],$_POST['fin_y']))."'");
	}
	
	if($kms){
		foreach($kms as $key_km => $valor_km){
			if($valor_km['km'] > '75'){
				$horas_km = number_format((($valor_km['km'] - 75) / 70),2,'.','.');
				$horas_km_total = $horas_km_total + $horas_km;
			}
		}
	}?>

<table>
	<tr>
		<td colspan=3 style='text-decoration: underline;'>Informe de partes</td>
		<td colspan=9 style='text-align: right;'>Kz Adeada Talleres El&eacute;ctricos - <?php echo conversion_formato_fecha(date('Y-m-d'), 'abreviado')." -- ".date('H:i:s');?></td>
	</tr>
</table>
<br>

<table border=1>
	<tr>
		<td colspan=3 style='background-color: #969696;'>FILTROS</td>
	</tr>
	<tr>
		<td colspan=3>Trabajador: <?php echo $personal[$_POST['fil_persona']];?></td>
	</tr>
	<tr>
		<td colspan=3>Fecha inicial: <?php echo date("Y-m-d",mktime(0,0,0,$_POST['ini_m'],$_POST['ini_d'],$_POST['ini_y']));?></td>
	</tr>
	<tr>
		<td colspan=3>Fecha final: <?php echo date("Y-m-d",mktime(0,0,0,$_POST['fin_m'],$_POST['fin_d'],$_POST['fin_y']));?></td>
	</tr>
</table>
<br>
	
<?php 
$clientes = array_partes_clientes();
	echo "<table border=1>";
	echo "<tr>";
	foreach($filtros_columnas as $key => $valor){
		echo "<th style='background-color: #C0C0C0;'>".$columnas['partes'][$valor]['Comment']."</th>";
	}
	echo "</tr>";
	
	$dia_actual = '';
	$persona_actual = '';
	if($consulta)
	foreach($consulta as $key => $valor){
		
		echo "<tr>";
		
		$duracion['total'] = $duracion['total'] + $valor['total_duracion'];
		
		if($filtros_columnas)
		foreach($filtros_columnas as $key2 => $valor2){
			switch ($valor2){
			
				case 'id':
				break;
				case 'comercial':
					echo "<td>".$personal[$valor[$valor2]]."</td>";
				break;
				
				case 'cliente':
					echo "<td>".$clientes[$valor[$valor2]]."</td>";
				break;
				
				case 'dia':
					echo "<td>".conversion_formato_fecha($valor[$valor2],'abreviado')."</td>";
					break;
					
				case 'tipo_trabajo':
					echo "<td>".$ARRAY_TRABAJOS['trabajos_padre'][$valor[$valor2]]."</td>";
				break;
				case 'subtrabajo':
					echo "<td>".$ARRAY_TRABAJOS['trabajos_hijo'][$valor[$valor2]]."</td>";
				break;
				default:
					echo "<td>".$valor[$valor2]."</td>";
					break;
			}
		}
		
		echo "</tr>";
	}
	else { echo "<tr><th colspan=12>No hay resultados</th></tr>"; }
	$total = ($duracion['total'] / 60) + $horas_km_total;
	echo "<tr><th colspan=12 style='background-color: #969696;'> TOTAL HORAS: ".number_format($total,2,',','.')." horas (".number_format(($duracion['total'] / 60),2,',','.')."h de partes + ".$horas_km_total."h de kms)</th></td>";
	echo "</table>";
}
?>