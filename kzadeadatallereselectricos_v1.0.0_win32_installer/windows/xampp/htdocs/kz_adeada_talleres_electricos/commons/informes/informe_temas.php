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
  	<h1>Informes de temas pendientes</h1>

	
	<form action='index.php?menu=informes' method='POST'>
		<input type='hidden' name='pag' value='<?php echo $pag; ?>'>
		<fieldset><legend>Filtros</legend>
			<table class="tabla_sin_borde">
				<tr>
					<td width="20%">Trabajador:</td>
					<?php if(in_array(221,$datos_perfil['PERMISOS'])){ ?>
						<td>
							<select name='fil_persona'>
								<option value=''>TODOS</option>
								<?php $personal = array_personal();
								combo_base_array_2($personal, $_POST['fil_persona']); ?>
							</select>
							<input class="bt-accion"  type='submit' name='filtrar_clientes' value='Filtrar clientes'>
						</td>
					<?php }
					else{
						$personal = array_personal();?>
						<td>
							<input type='hidden' name="fil_persona" id="fil_persona" value='<?php echo $ID_PERSONA['id']; ?>'><?php echo $ID_PERSONA['nombre']." ".$ID_PERSONA['apellidos'];?>
							<input class="bt-accion"  type='submit' name='filtrar_clientes' value='Filtrar clientes'>
						</td>
					<?php }?>
				</tr>
				<?php if(($_POST['filtrar_clientes']) || ($_POST['aplicar_filtros'])){ ?>
					<tr>
						<td>Cliente || Trabajo:</td>
						<td>
							<?php 
							if($_POST['fil_persona'] != ''){
								$criterios2 .= " and kz_te_proyecto_personal.tecnico = '".$_POST['fil_persona']."' ";
							}
							?>
							<select name="cliente_proyecto" id="cliente_proyecto">
				         		<?php
				         		$cliente_proyecto=select_normal("SELECT distinct(kz_te_clientes.nombre_comercial), kz_te_clientes.id as idcliente, kz_te_proyectos.id as idproyecto, kz_te_proyectos.nombre FROM kz_te_clientes, kz_te_proyectos, kz_te_proyecto_personal WHERE kz_te_clientes.id = kz_te_proyectos.cliente and kz_te_proyecto_personal.proyecto = kz_te_proyectos.id and 1=1 $criterios2 ORDER BY kz_te_clientes.nombre_comercial");			      			
				      			foreach($cliente_proyecto as $keyclienteproyecto => $valorclienteproyecto){ ?>
				      				<option value='<?php echo $valorclienteproyecto['idcliente']."||".$valorclienteproyecto['idproyecto']; ?>'>
				      					<?php echo $valorclienteproyecto['nombre_comercial']; ?> || <?php echo $valorclienteproyecto['idproyecto']; ?> - <?php echo $valorclienteproyecto['nombre']; ?>
				      				</option><?php
				      			} ?>
			       			</select>
			       			<input class="bt-accion" type='submit' name='aplicar_filtros' value='Buscar'>
						</td>
					</tr>
				<?php }?>
				</table>
		</fieldset>
	</form>
	
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
	
		<br>
		<form action='../xls/informe_temas.php' method='POST'>
			<?php foreach($_POST as $key => $valor){
				?><input type='hidden' name='<?php echo $key; ?>' value='<?php echo $valor; ?>'>	<?php
			}
			?>
			<input class="bt-accion" type='submit' name='xls' value='Exportar a EXCEL'>
		</form>
	
		<table class='tabla_resultado_informe' width='100%'>
			<tr>
				<th style='font-family: helvetica, sans-serif; font-size: 0.8em; font-weight: bold; background-color: gray; padding: 5px;'>Fecha</th>
				<th style='font-family: helvetica, sans-serif; font-size: 0.8em; font-weight: bold; background-color: gray; padding: 5px;'>Descripci&oacute;n</th>
				<th style='font-family: helvetica, sans-serif; font-size: 0.8em; font-weight: bold; background-color: gray; padding: 5px;'>Responsable</th>
				<th style='font-family: helvetica, sans-serif; font-size: 0.8em; font-weight: bold; background-color: gray; padding: 5px;'>Plazo</th>
				<th style='font-family: helvetica, sans-serif; font-size: 0.8em; font-weight: bold; background-color: gray; padding: 5px;'>OK</th>
			</tr>
			<?php if($temas){
				foreach($temas as $key => $valor){ 
					if($persona_actual != $valor['responsable']){?>	
						<tr>
							<td colspan=8 style="font-weight:bold;" class='cabecera_tabla_filtros'><?php echo $personal[$valor['responsable']];?></td>
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
  </div>
</div>