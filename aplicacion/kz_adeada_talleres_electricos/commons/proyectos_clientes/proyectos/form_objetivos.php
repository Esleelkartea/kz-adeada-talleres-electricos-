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
$annos = select_normal("SELECT distinct anno FROM kz_te_objetivos_proyectos WHERE proyecto = '".$_POST['codigo']."' ORDER BY anno");
?>

<br>
<fieldset>
	<legend><b>Objetivos para el trabajo <?php echo $_POST['codigo']; ?></b></legend>
	<?php if($annos){ ?>
		<table class="tabla_sin_borde">
			<?php foreach ($annos as $key => $valor){ ?>
				<tr>
					<td>
						<?php
						 echo "<b>".$valor['anno'].":</b>"; ?>
					</td>
				</tr>
				
				<?php 
				$objetivos = select_normal("SELECT * FROM kz_te_objetivos_proyectos WHERE proyecto = '".$_POST['codigo']."' and anno = '".$valor['anno']."'");
				foreach ($objetivos as $key => $valor){ ?>
				
				<tr>
					<td style='padding-left: 20px;'>
						<?php echo $valor['objetivo']; ?>
					</td>
					<td>
						<form action='index.php?menu=administracion_proyectos' method='POST'>
							<input class="bt-eliminar" type='submit' name='accion' value='Eliminar'>
							<input type='hidden' name='seleccion_formulario' value='objetivos'></input>
							<input type='hidden' name='eliminar_objetivo' value='true'>
							<input type='hidden' name='codigo' value='<?php  echo $valor['proyecto']; ?>' />
							<input type='hidden' name='id' value='<?php  echo $valor['id']; ?>' />
							<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
							<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
						</form>
					</td>
				</tr>
				<?php 
				}
			} ?>
		</table>
	<?php }
	else{
		echo "<i>(No hay objetivos)</i>";
	} ?>
</fieldset>
<br>

<form action='index.php?menu=administracion_proyectos' method='POST'>
	<fieldset>
		<legend><b>A&ntilde;adir objetivo</b></legend>
		<table class="tabla_sin_borde">
			<tr>
				<td>A&ntilde;o:</td>
				<td>
					<select name="anno"  id="anno" >
         				<?php combo_base_array($array_annos,$fpd["Y"]); ?>
        			</select>
				</td>
			</tr>
			<tr>
				<td>Objetivo:</td>
				<td><textarea name='objetivo' cols='85' rows='3' onFocus="this.rows='10';" onBlur="this.rows='3';"></textarea></td>
			</tr>
		</table>
	</fieldset>
	<br><hr><br>
	
	<input type='hidden' name='anadir_objetivo' value='true'></input>
	<input type='hidden' name='codigo' value='<?php  echo $_POST['codigo']; ?>'></input>
	
	Guardar y
	<select class="select-comun" name='seleccion_formulario'>
		<option value='objetivos'>A&ntilde;adir otro</option>
		<option value=''>Volver al listado</option>
	</select>
	
	<input class="bt-accion"  type='submit' name='accion' value='Continuar' /> 
	<input type='hidden' name='codigo' value='<?php  echo $_POST['codigo']; ?>'></input>
	<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>

</form>
</br>
<form action='index.php?menu=administracion_proyectos' method='POST'>
	<input class="bt-accion"  type='submit' name='accion' value='Cancelar' /> 
	<input type='hidden' name='p' value='<?php echo $_POST['p'];?>'></input>
	<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
</form>