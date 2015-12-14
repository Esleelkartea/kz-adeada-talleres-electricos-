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
  	<h1>Informes de listado de clientes</h1>
	<br />
	<?php $contar_clientes = select_normal("SELECT count(*) as total FROM kz_te_clientes ORDER BY nombre_comercial"); 
	$cantidad_total = $contar_clientes[0]['total'];
	$division = $cantidad_total / 2;
	$primera = round($division);
	$segunda = $cantidad_total - $primera;
	
	$clientes_primera = select_normal("SELECT * FROM kz_te_clientes ORDER BY nombre_comercial LIMIT $primera");
	$clientes_segunda = select_normal("SELECT * FROM kz_te_clientes ORDER BY nombre_comercial LIMIT $primera, $segunda");
	?>
	
	<form action='../xls/informe_clientes.php' method='POST'>
		<?php foreach($_POST as $key => $valor){
			?><input type='hidden' name='<?php echo $key; ?>' value='<?php echo $valor; ?>'>	<?php
		}
		?>
		<input class="bt-accion" type='submit' name='xls' value='Exportar a EXCEL'>
	</form>
	
	<table class="tabla_sin_borde" align="center" style="width:100%">
		<tr>
	    	<td width="42%">
				<table class='tabla_resultado_informe' >
					<tr>
						<th style='text-align: center;'>Cod.</th>
						<th style='text-align: center;'>Empresa</th>
						<th style='text-align: center;'>Tel&eacute;fono</th>
					</tr>
					
					<?php if($clientes_primera)
							foreach($clientes_primera as $key_p => $valor_p){ ?>
							
								<tr>
									<td style='text-align: center;'><?php echo $valor_p['id'];?></td>
									<td style='text-align: center;'><?php echo $valor_p['nombre_comercial'];?></td>
									<td style='text-align: center;'><?php if($valor_p['telefono']!=0){ echo $valor_p['telefono'];}?></td>
								</tr>
				
							<?php }?>
				
				</table>
			</td>
			<td width="1%"></td>
	    	<td style="vertical-align:top;" width="42%">
				<table class='tabla_resultado_informe'>
					<tr>
						<th style='text-align: center;'>Cod.</th>
						<th style='text-align: center;'>Empresa</th>
						<th style='text-align: center;'>Tel&eacute;fono</th>
					</tr>
					<?php if($clientes_segunda)
						foreach($clientes_segunda as $key_s => $valor_s){ ?>
							<tr>
								<td style='text-align: center;'><?php echo $valor_s['id'];?></td>
								<td style='text-align: center;'><?php echo $valor_s['nombre_comercial'];?></td>
								<td style='text-align: center;'><?php if($valor_s['telefono']!=0){ echo $valor_s['telefono'];}?></td>
							</tr>
						
						<?php }?>
				</table>
			</td>
		</tr>
	</table>
  </div>
</div>