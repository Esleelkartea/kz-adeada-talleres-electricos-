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
header("Content-Disposition: attachment; filename=Informe_listado_clientes.xls");
header("Pragma: public");

include("../functions/globales.php");
include("../functions/funciones.php");

$clientes = select_normal("SELECT * FROM kz_te_clientes ORDER BY nombre_comercial");?>

<table>
	<tr>
		<td colspan=3 style='text-decoration: underline;'>Informe de listado de clientes</td>
	</tr>
	<tr>
		<td colspan=3 style='text-align: right;'>Kz Adeada Talleres El&eacute;ctricos - <?php echo conversion_formato_fecha(date('Y-m-d'), 'abreviado')." -- ".date('H:i:s');?></td>
	</tr>
</table>
<br>


<table class='tabla_resultado_informe' width='100%' border=1>
	<tr>
		<td width=30 style='font-weight:bold; text-align: left; background-color: #C0C0C0;'>Cod.</td>
		<td width=243px style='font-weight:bold; text-align: left; background-color: #C0C0C0;'>Nombre</td>
		<td width=243px style='font-weight:bold; text-align: left; background-color: #C0C0C0;'>Tel&eacute;fono</td>
	</tr>
	
	<?php if($clientes)
	foreach($clientes as $key => $valor){ ?>
	
		<tr>
			<td style='text-align: center;'><?php echo $valor['id'];?></td>
			<td style='text-align: center;'><?php echo $valor['nombre_comercial'];?></td>
			<td style='text-align: center;'><?php echo $valor['telefono'];?></td>
		</tr>

	<?php }?>
</table>