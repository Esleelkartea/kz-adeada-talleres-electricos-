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
<div id="cuerpo">
  <div id="contenido">
  	<h1>Informes de listado de trabajos</h1>
	<br />
	<?php $proyectos = select_normal("SELECT * FROM kz_te_proyectos ORDER BY id");?>
	
	
	<form action='../xls/informe_listadoproyectos.php' method='POST'>
		<?php foreach($_POST as $key => $valor){
			?><input type='hidden' name='<?php echo $key; ?>' value='<?php echo $valor; ?>'>	<?php
		}
		?>
		<input class="bt-accion" type='submit' name='xls' value='Exportar a EXCEL'>
	</form>
	
	<table class='tabla_resultado_informe' width='100%'>
		<tr>
			<th class='cabecera_tabla_filtros' style='text-align: center;'>Cod.</th>
			<th class='cabecera_tabla_filtros' style='text-align: center;'>Nombre</th>
			<th class='cabecera_tabla_filtros' style='text-align: center;'>Cliente</th>
			<th class='cabecera_tabla_filtros' style='text-align: center;'>Prioridad</th>
			<th class='cabecera_tabla_filtros' style='text-align: center;'>Fecha inicio</th>
			<th class='cabecera_tabla_filtros' style='text-align: center;'>Fecha fin</th>
			<th class='cabecera_tabla_filtros' style='text-align: center;'>Finalizado</th>
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
  </div>
</div>