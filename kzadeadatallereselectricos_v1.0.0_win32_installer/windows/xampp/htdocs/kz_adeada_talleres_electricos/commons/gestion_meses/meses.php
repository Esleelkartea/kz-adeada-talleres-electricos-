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
?>
<div class='titulo_seccion'>Meses</div>

<?php
$anno = select_normal("SELECT distinct(anno) FROM gisper_meses WHERE anno = '".date('Y')."'");
$meses = select_normal("SELECT * FROM gisper_meses WHERE anno = '".date('Y')."'");
?>

<br>
<form action='index.php' method='post'>
	<input class="bt-nuevo-documento" type='submit' name='accion' value='A&ntilde;adir nuevos meses'>
	<input type='hidden' name='seleccion_formulario' value='anadir_parte'>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>

<hr>
<table>
	<tr>
		<th>A�o:</th>
		<?php foreach($anno as $key => $valor){?>
		<td><?php echo $valor['anno']?></td>
		<?php }?>
	</tr>
</table>
<hr>

<?php foreach($meses as $key => $valor){?>
<table>
	<tr>
		<th><?php echo $valor['mes']?></th>
		<td>Desde: <?php echo $valor['fecha_inicio']?></td>
	</tr>
	<tr>
		<td></td>
		<td>Hasta: <?php echo $valor['fecha_fin']?></td>
	</tr>
</table>
<?php }?>