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
  	<h1>Informes de finalizaci&oacute;n de trabajos por mes</h1>
	<br />
	<form action='index.php?menu=informes' method='POST'>
		<input type='hidden' name='pag' value='<?php echo $pag; ?>'>
		<fieldset><legend>Filtros</legend>
			<table class="tabla_sin_borde">
				<tr>
					<td width="15%">Trabajador:</td>
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
						<td>A&ntilde;o:</td>
						<td>
							<?php if($_POST['anno'] != ''){?>
								<select name='anno'><?php combo_base_array($array_annos, $_POST['anno']); ?></select>
							<?php }
							else{?>
								<select name='anno'><?php combo_base_array($array_annos, date("Y")); ?></select>
							<?php }?>
						</td>	
					</tr>
					<tr>
						<td>Mes:</td>
						<td>
							<?php if($_POST['anno'] != ''){?>
								<select name='mes'><?php combo_base_array($array_meses_letras, $_POST['mes']); ?></select>
							<?php }
							else{?>
								<select name='mes'><?php combo_base_array($array_meses_letras, date("m")); ?></select>
							<?php }?>
		
							<input class="bt-accion" type='submit' name='aplicar_filtros' value='Buscar'>
						</td>		
					</tr>
				<?php }?>
			</table>
		</fieldset>
	</form>
	
	<?php if($_POST['aplicar_filtros']){ ?>
		<br>
		<form action='../xls/informe_proyectosmes.php' method='POST'>
			<?php foreach($_POST as $key => $valor){
				?><input type='hidden' name='<?php echo $key; ?>' value='<?php echo $valor; ?>'>	<?php
			}
			?>
			<input type='hidden' name='persona' value='<?php echo $ID_PERSONA['id']; ?>'>
			<input class="bt-accion" type='submit' name='xls' value='Exportar a EXCEL'>
		</form>
		
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
		
		<table class='tabla_resultado_informe' width='100%'>
			<tr>
				<th class='cabecera_tabla_filtros'>Cliente || Trabajo</th>
				<th class='cabecera_tabla_filtros'>Prioridad</th>
				<th class='cabecera_tabla_filtros'>Fecha inicio</th>
				<th class='cabecera_tabla_filtros'>Fecha fin</th>
				<th class='cabecera_tabla_filtros'>Horas</th>
			</tr>
			
			<?php if($_POST['fil_persona'] != ''){
				$proyectos = select_normal("SELECT kz_te_proyectos.id as idproyecto, kz_te_proyectos.*, kz_te_clientes.* FROM kz_te_proyectos, kz_te_clientes, kz_te_proyecto_personal WHERE kz_te_clientes.id = kz_te_proyectos.cliente AND finalizado = '0' AND kz_te_proyecto_personal.tecnico = '".$_POST['fil_persona']."' AND kz_te_proyecto_personal.proyecto = kz_te_proyectos.id");
			}
			else{
				$proyectos = select_normal("SELECT kz_te_proyectos.id as idproyecto, kz_te_proyectos.*, kz_te_clientes.* FROM kz_te_proyectos, kz_te_clientes WHERE kz_te_clientes.id = kz_te_proyectos.cliente AND finalizado = '0'");
			}
			
			if($proyectos)
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
	<?php }?>
  </div>
</div>