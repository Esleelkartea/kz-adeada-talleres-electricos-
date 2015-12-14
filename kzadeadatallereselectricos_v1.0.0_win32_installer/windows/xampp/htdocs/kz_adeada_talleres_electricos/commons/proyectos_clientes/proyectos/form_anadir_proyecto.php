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
<br><h4>A&ntilde;adir trabajo</h4>
<br>

<?php
//print_r($_POST);

if($_POST['accion']=='Continuar'){
	unset($_POST);
}?>

<form action='index.php?menu=administracion_proyectos' method='POST'>
	<table class="tabla_sin_borde">
		<tr>
			<td>Cod. trabajo:</td>
			<?php 
			if($_POST['codigo']){
				$codigo=$_POST['codigo'];
			}
			else{
				$cod_max = select_normal("SELECT max(id) as maximo FROM kz_te_proyectos");
				$cod_max = $cod_max[0];
				$codigo = $cod_max['maximo'] + 1;
			}?>
			<td><input type='text' name='codigo' value='<?php echo $codigo;?>' size='23'></input></td>
		</tr>
		<tr>
			<td>Nombre:</td>
			<td><input type='text' name='nombre' value='<?php echo $_POST['nombre']?>' size='23'></input></td>
		</tr>
		<tr>
			<td>Encargado:</td>
			<td>
				<select name='comercial'>
					<?php	
	         		$sqlcomercial=select_normal("SELECT * FROM kz_te_personal ORDER BY nombre");
	         		?><option></option><?php
					foreach($sqlcomercial as $keycomercial => $valorcomercial){
						if($_POST['comercial'] == $valorcomercial['id']){
							$cliente_seleccionado = " SELECTED ";
						}
						else $cliente_seleccionado = ""; ?>
						
						<option value='<?php echo $valorcomercial['id']; ?>' <?php echo $cliente_seleccionado; ?>>
	      					<?php echo $valorcomercial['nombre']." ".$valorcomercial['apellidos']; ?>
						</option><?php
					} ?>
				</select>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top;">Cliente:</td>
			<td width="50%">
				<select name='cliente'>
					<?php	
	         		$sqlcliente=select_normal("SELECT * FROM kz_te_clientes ORDER BY nombre_comercial");
	         		?><option></option><?php
					foreach($sqlcliente as $keycomercial => $valorcliente){
						if($_POST['cliente'] == $valorcliente['id']){
							$cliente_seleccionado = " SELECTED ";
						}
						else $cliente_seleccionado = ""; ?>
						
						<option value='<?php echo $valorcliente['id']; ?>' <?php echo $cliente_seleccionado; ?>>
	      					<?php echo $valorcliente['nombre_comercial']; ?>
						</option><?php
					} ?>
				</select>
      		</td>
		</tr>
		<tr>
			<td>Externo / Interno:</td>
			<td>
				<select name="externo_interno">
					<option value="externo">externo</option>
					<option value="interno">interno</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Zona:</td>
			<td>
				<select name='zona'>
					<?php 
					$provincias = mostrar_provincias();
					?><option></option><?php 
					foreach($provincias as $key => $valor){
					?>
						<option value='<?php echo $valor; ?>'><?php echo $valor; ?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Prioridad:</td>
			<td>
				<select name="prioridad">
					<option></option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Fecha inicio:</td>
			<td>
				<select name="ano_inicio"  id="ano_inicio">
         			<?php	
      				combo_base_array($array_annos, $fpd["Y"]);
      				?>
        		</select> -
        		<select name="mes_inicio"  id="mes_inicio">
         			<?php	
      				combo_base_array($array_meses, $fpd["m"]);
      				?>
        		</select> -
				<select name="dia_inicio"  id="dia_inicio">
         			<?php	
      				combo_base_array($array_dias, $fpd["d"]);
      				?>
        		</select>
			</td>
		</tr>
		<tr>
			<td>Fecha fin prevista:</td>
			<td>
				<select name="ano_prevista"  id="ano_prevista">
         			<?php	
      				combo_base_array($array_annos, $fpd["Y"]);
      				?>
        		</select> -
        		<select name="mes_prevista"  id="mes_prevista">
         			<?php	
      				combo_base_array($array_meses, $fpd["m"]);
      				?>
        		</select> -
				<select name="dia_prevista"  id="dia_prevista">
         			<?php	
      				combo_base_array($array_dias, $fpd["d"]);
      				?>
        		</select>
			</td>
		</tr>
		<tr>
			<td>Fecha fin real:</td>
			<td>
				<select name="ano_real"  id="ano_real">
         			<?php	
      				combo_base_array($array_annos, $fpd["Y"]);
      				?>
        		</select> -
        		<select name="mes_real"  id="mes_real">
         			<?php	
      				combo_base_array($array_meses, $fpd["m"]);
      				?>
        		</select> -
				<select name="dia_real"  id="dia_real">
         			<?php	
      				combo_base_array($array_dias, $fpd["d"]);
      				?>
        		</select>
			</td>
		</tr>
		<tr>
			<td>Tipo trabajo:</td>
			<td>
				<select name="tipo_proyecto" id="tipo_proyecto">
	         		<?php
	         		$tipo_proyecto=select_normal("SELECT * FROM kz_te_tipo_proyecto ORDER BY proyecto");
	         		?><option></option><?php
	      			foreach($tipo_proyecto as $keytipoproyecto => $valortipoproyecto){
	      				?>
	      				<option value='<?php echo $valortipoproyecto['id']; ?>'>
	      					<?php echo $valortipoproyecto['proyecto']; ?>
	      				</option><?php
	      			}
	      			?>
       			</select>
       			<input type='text' name='tipo_proyecto_nuevo' value=''></input>
			</td>
		</tr>
		<tr>
			<td>Horas:</td>
			<td><input type='text' name='horas_auditoria' value='' size=2></input></td>
		</tr>
		<tr>
			<td>Observaciones:</td>
			<td><textarea name='observaciones' cols='100%' rows='3' onFocus="this.rows='10';" onBlur="this.rows='3';"></textarea></td>
		</tr>
		<tr>
			<td>Finalizado:</td>
			<td><input type='checkbox' name='finalizado' id='finalizado'></td>
		</tr>
	</table>
	<br><hr><br>
	
	<input type='hidden' name='anadir_proyecto' value='true'></input>
	<input type='hidden' name='tecnico' value='true'></input>
	
	Guardar y
	<select class="select-comun" name='seleccion_formulario'>
		<option value='objetivos'>A&ntilde;adir objetivos</option>
		<option value='tecnicos'>Asignar trabajadores</option>
		<option value='temas_pendientes'>A&ntilde;adir temas pendientes</option>
		<option value='anadir_proyecto'>A&ntilde;adir m&aacute;s</option>
		<option value=''>Volver al listado</option>
	</select>
	
	<input class="bt-accion"  type='submit' name='accion' value='Continuar' /> 
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
	<input type='hidden' name='mantener_fecha' value='<?php echo $fecha; ?>'>
</form>
<br />
<form action='index.php?menu=administracion_proyectos' method='POST'>
	<input class="bt-accion"  type='submit' name='accion' value='Cancelar' /> 
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>