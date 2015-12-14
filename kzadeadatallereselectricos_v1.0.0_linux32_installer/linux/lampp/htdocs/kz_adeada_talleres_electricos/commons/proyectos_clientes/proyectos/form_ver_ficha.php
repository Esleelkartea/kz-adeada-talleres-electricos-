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
<br><h4>Ficha del trabajo</h4><br>

<?php
if($_POST['accion'] == 'Ver proyecto'){
	$criterios = " AND id = '".$_POST['idproyecto']."'";
}
else{
	$criterios = " AND id = '".$_POST['id']."'";
}

$proyectos = select_normal("SELECT * FROM kz_te_proyectos WHERE 1 = 1 $criterios");		
$proyecto = $proyectos[0];
?>

<table class="tabla_sin_borde">
	<tr>
		<td width="25%">Cod. trabajo:</td>
		<td class='dato'><?php echo $proyecto['id']; ?></td>
	</tr>
	<tr>
		<td>Nombre:</td>
		<td class='dato'><?php echo $proyecto['nombre']; ?></td>
	</tr>
	<tr>
		<td>Encargado:</td>
		<td class='dato'><?php echo $ARRAY_TECNICOS[$proyecto['comercial']]; ?></td>
	</tr>
	<tr>
		<td>Cliente:</td>
		<td class='dato'><?php echo $PARTES_CLIENTES[$proyecto['cliente']]; ?></td>
	</tr>
	<tr>
		<td>Externo / Interno:</td>
		<td class='dato'><?php echo $proyecto['externo_interno']; ?></td>
	</tr>
	<tr>
		<td>Zona:</td>
		<td class='dato'><?php echo $proyecto['zona']; ?></td>
	</tr>
	<tr>
		<td>Prioridad:</td>
		<td class='dato'><?php echo $proyecto['prioridad']; ?></td>
	</tr>
	<tr>
		<td>Fecha inicio:</td>
		<td class='dato'><?php echo $proyecto['fecha_inicio']; ?></td>
	</tr>
	<tr>
		<td>Fecha fin prevista:</td>
		<td class='dato'><?php echo $proyecto['fecha_prevista']; ?></td>
	</tr>
	<tr>
		<td>Fecha fin real:</td>
		<td class='dato'><?php echo $proyecto['fecha_real']; ?></td>
	</tr>
	<tr>
		<td>Tipo trabajo:</td>
		<td class='dato'><?php echo $ARRAY_TIPO_PROYECTO[$proyecto['tipo_proyecto']]; ?></td>
	</tr>
	<tr>
		<td>Horas:</td>
		<td class='dato'><?php echo $proyecto['horas_auditoria']; ?></td>
	</tr>
	<tr>
		<td>Observaciones:</td>
		<td class='dato'><?php echo $proyecto['observaciones']; ?></td>
	</tr>
	<tr>
		<td>Finalizado:</td>
		<?php 
		if($proyecto['finalizado'] == '0'){ ?>
			<td class='dato'><?php echo 'NO'; ?></td>
		<?php } 
		if($proyecto['finalizado'] == '1'){ ?>
			<td class='dato'><?php echo 'SI'; ?></td>
		<?php } ?>
	</tr>
</table>
<br><hr><br>

<?php if($_POST['accion'] != 'Ver proyecto'){?>
<form action='index.php?menu=administracion_proyectos' method='POST'>	
	<select class="select-comun" name='seleccion_formulario'>
		<option value=''>Volver al listado</option>
		<option value='editar_proyecto'>Editar trabajo</option>
	</select>
		
	<input class="bt-accion"  type='submit' name='accion' value='Continuar' /> 
	<input type='hidden' name='id' value='<?php  echo $proyecto['id']; ?>'></input>
	<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
	<input type='hidden' name='pag' value='<?php echo $pag; ?>'></input>
</form>
<?php }?>