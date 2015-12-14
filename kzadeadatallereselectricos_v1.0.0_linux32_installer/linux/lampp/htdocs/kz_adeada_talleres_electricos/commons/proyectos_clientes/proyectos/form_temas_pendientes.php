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
<?php
$temas_pendientes = select_normal("SELECT * FROM kz_te_temas_pendientes t WHERE proyecto = '".$_POST['id']."' ORDER BY ok");
?>

<br><b>Temas pendientes del trabajo <?php echo $_POST['id']; ?>:</b><hr>
	<?php if($temas_pendientes){ ?>
		<table class="tabla_sin_borde" border=1>
			<tr>
				<th>Fecha</th>
				<th>Descripci&oacute;n</th>
				<th>Responsable</th>
				<th>Plazo</th>
				<th>OK</th>
			</tr>
			<?php 
			foreach ($temas_pendientes as $key => $valor){
				
				$tecnicos = select_normal("SELECT * FROM kz_te_personal WHERE id = '".$valor['responsable']."'");
				$tecnico = $tecnicos[0];
				
				if($valor['ok'] == '0'){
					$ok = 'NO';
				}
				if($valor['ok'] == '1'){
					$ok = 'SI';	
				}?>
				
				<tr>
					<td><?php echo $valor['fecha']; ?></td>
					<td><?php echo $valor['tema']; ?></td>
					<td><?php echo $tecnico['nombre']." ".$tecnico['apellidos']; ?></td>
					<td><?php echo $valor['plazo']; ?></td>
					<td><?php echo $ok; ?></td>
					
					<td>	
						<form action='index.php?menu=administracion_proyectos' method='POST'>
							<input class="bt-accion"  type='submit' name='accion' value='Cerrar'>
							<input type='hidden' name='seleccion_formulario' value='temas_pendientes'></input>
							<input type='hidden' name='cerrar_tema' value='true'>
							<input type='hidden' name='id' value='<?php  echo $valor['proyecto']; ?>' />
							<input type='hidden' name='id_tema' value='<?php  echo $valor['id']; ?>' />
							<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
							<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
						</form>
					</td>
					
					<td>
						<form action='index.php?menu=administracion_proyectos' method='POST'>
							<input class="bt-eliminar" type='submit' name='accion' value='Eliminar'>
							<input type='hidden' name='seleccion_formulario' value='temas_pendientes'></input>
							<input type='hidden' name='eliminar_tema' value='true'>
							<input type='hidden' name='id' value='<?php  echo $valor['proyecto']; ?>' />
							<input type='hidden' name='id_tema' value='<?php  echo $valor['id']; ?>' />
							<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
							<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
						</form>
					</td>
				</tr>
				<?php 
				}
			?>
		</table>
	<?php }
	else{
		echo "<i>(No hay temas pendientes)</i><br>";
	} ?>
<br>

<form action='index.php?menu=administracion_proyectos' method='POST'>
	<b>A&ntilde;adir tema:</b><hr>
	<table class="tabla_sin_borde">
		<tr>
			<td>Fecha:</td>
			<td>
				<select name="ano"  id="ano" >
         			<?php	
      				combo_base_array($array_annos,date("Y"));
      				?>
        		</select> -
        		<select name="mes"  id="mes" >
         			<?php	
      				combo_base_array($array_meses,date("m"));
      				?>
        		</select> -
				<select name="dia"  id="dia" >
         			<?php	
      				combo_base_array($array_dias,date("d"));
      				?>
        		</select>
			</td>
		</tr>
		<tr>
			<td>Tema:</td>
			<td>
				<textarea name='tema' cols='85' rows='3' onFocus="this.rows='10';" onBlur="this.rows='3';"></textarea>
			</td>
		</tr>
		<tr>
			<td>Responsable:</td>
			<td>
				<select name="responsable" id="responsable">
         		<?php
         		$comercial=select_normal("SELECT * FROM kz_te_personal ORDER BY nombre");
         		?><option></option><?php
      			foreach($comercial as $keycomercial => $valorcomercial){
      				?>
      				<option value='<?php echo $valorcomercial['id']; ?>'>
      					<?php echo $valorcomercial['nombre']; ?> <?php echo $valorcomercial['apellidos']; ?>
      				</option><?php
      			}
      			?>
       			</select>
			</td>
		</tr>
		<tr>
			<td>Plazo:</td>
			<td>
				<input type='text' name='plazo' id='plazo' size='9'>
			</td>
		</tr>
		<tr>
			<td>Finalizado:</td>
			<td>
				<input type='checkbox' name='ok' id='ok'>
			</td>
		</tr>
	</table>
	<br><hr><br>
	
	<input type='hidden' name='anadir_tema' value='true'></input>
	<input type='hidden' name='id' value='<?php  echo $_POST['id']; ?>'></input>
	
	Guardar y
	<select class="select-comun" name='seleccion_formulario'>
		<option value='temas_pendientes'>A&ntilde;adir otro</option>
		<option value=''>Volver al listado</option>
	</select>
	
	<input class="bt-accion"  type='submit' name='accion' value='Continuar' /> 
	<input type='hidden' name='id' value='<?php  echo $_POST['id']; ?>'></input>
	<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>
</br>
<form action='index.php?menu=administracion_proyectos' method='POST'>
	<input class="bt-accion"  type='submit' name='accion' value='Cancelar' /> 
	<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>