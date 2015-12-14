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
$alto_celda = '3px'; 
$ancho_celda = '150px';
$PERSONAL = array_personal();
?>

<style>
.selector_semana{

width: 100%;
height: 40px;
border-top: 2px solid gray;

}
.agenda{
border: 1px solid black;
border-collapse: collapse;
padding: 0px;
margin: 0px;
}

.agenda td{

height: <?php echo $alto_celda; ?>;
width: 150px;
vertical-align: top;
padding: 0px;
margin: 0px;
}
.agenda th{

vertical-align: top;
border-bottom: 1px solid #037500;
border-top: 1px solid #037500;
padding: 0px;
margin: 0px;
}
.agenda th.hora{
padding: 10px;
}

.cita{

position: absolute;
vertical-align:top;
padding:0px;
margin: 0px;
width: 135px;
font-size: 0.7em;
overflow: hidden;
margin-top: 0px;
margin-left: 5px; 
}
</style>

<?php
if(!$_POST['comercial']){
	$_POST['comercial'] = $ID_PERSONA['id'];
}
if($_POST['ir_a_fecha']){

	$fechassemana = obtener_semana($_POST['ano']."-".$_POST['mes']."-".$_POST['dia']);
	$fechainicio = $fechassemana[0];
	$fechafin = $fechassemana[1];
}
else{ if($_POST['semana_anterior']){
	$fechad = sumar_dias($_POST['fecha'],-7);
		$fechassemana = obtener_semana($fechad);
		$fechainicio = $fechassemana[0];
		$fechafin = $fechassemana[1];
	}
	else if($_POST['semana_siguiente']){
		
		$fechad = sumar_dias($_POST['fecha'],7);
		$fechassemana = obtener_semana($fechad);
		$fechainicio = $fechassemana[0];
		$fechafin = $fechassemana[1];
	}
	else{
		if((!$_POST['ir_a_fecha'])&&(!$_POST['hoy'])&&($_POST['ano'])){
			$fecha_lunes = $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'];
			$fechassemana = obtener_semana($fecha_lunes);
			$fechainicio = $fechassemana[0];
			$fechafin = $fechassemana[1];
		}
		else{
			if($_POST['fecha_elim_conver']){
				$hoy = $_POST['fecha_elim_conver'];
				$fechassemana = obtener_semana($hoy);
				$fechainicio = $fechassemana[0];
				$fechafin = $fechassemana[1];
			}
			else{
				$hoy = date("Y-m-d");
				$fechassemana = obtener_semana($hoy);
				$fechainicio = $fechassemana[0];
				$fechafin = $fechassemana[1];
			}
		}
	}
	}
	
$fpd = desglose_fecha_hora($fechainicio);
//MES EN BBDD
$mes_actual = gisper_meses($fechainicio,$fechafin);
$comienzomes = $mes_actual[0]['fecha_inicio'];
$finmes = $mes_actual[0]['fecha_fin'];
$nombre_mes = $mes_actual[0]['mes'];
//FIN MES BBDD
?>
<div id="cuerpo">
  <div id="contenido">
  	<h1>Agenda planificaci&oacute;n</h1>
	<?php
	if($_POST['anadir_planificacion_calendario']){
		if($_POST['fin_horas'] > $_POST['inicio_horas']){
			$hora_real = comprobar_hora_ocupada_planificacion_real($_POST['comercial'], $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'], $_POST['inicio_horas'].":".$_POST['inicio_minutos'], $_POST['fin_horas'].":".$_POST['fin_minutos']);
			$hora_planificada = comprobar_hora_ocupada_planificacion_planificada($_POST['comercial'], $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'], $_POST['inicio_horas'].":".$_POST['inicio_minutos'], $_POST['fin_horas'].":".$_POST['fin_minutos']);
			
			if(count($hora_real) == 1){
				if(count($hora_planificada) == 1){
					$total_duracion = calcular_hora($_POST['inicio_horas'].":".$_POST['inicio_minutos'],$_POST['fin_horas'].":".$_POST['fin_minutos']);
					if(!$_POST['cliente_proyecto']){
						$mensaje .=  "<hr>ERROR. No has seleccionado el cliente || trabajo<hr>";
					}
					else{
						$clienteproyecto = explode("||",$_POST['cliente_proyecto']);
						if(!$_POST['tipo_trabajo']){
							$mensaje .=  "<hr>ERROR. No has seleccionado el tipo de trabajo<hr>";
						}
						else{
							if($_POST['tipo_trabajo'] == '6'){
								$subtrabajo = $_POST['subtrabajo_otros'];
							}
							
							If($_POST['tema_importante']!=''){
								$tema_importante=1;
							}
							else{
								$tema_importante=0;
							}
							$insertar_parte = ejecutar_query("INSERT INTO kz_te_planificacion_partes VALUES(null, '".$_POST['comercial']."', '".$clienteproyecto[0]."', '".$_POST['provincia']."', '".$clienteproyecto[1]."', '".$_POST['ano']."-".$_POST['mes']."-".$_POST['dia']."', '".$_POST['inicio_horas'].":".$_POST['inicio_minutos']."', '".$_POST['fin_horas'].":".$_POST['fin_minutos']."', '".$total_duracion."', '".$_POST['tipo_trabajo']."', '".$subtrabajo."', '".$_POST['labor_realizada']."', '".$_POST['otros']."', '".$tema_importante."', '".date('Y-m-d H:i:s')."')");
							$mensaje .=  "<hr>Se ha a&ntilde;adido el parte<hr>";
						}
					}
				}
				else{
					$mensaje .=  "<hr>ERROR. Ya existen partes para este rango de hora<hr>";
				}
			}
			else{
				$mensaje .=  "<hr>ERROR. Existen partes reales para ese rango de hora<hr>";
			}
		}
		else{
			if($_POST['fin_horas'] < $_POST['inicio_horas']){
				$mensaje .=  "<hr>ERROR. La hora final debe ser mayor a la hora inicial<hr>";
			}
			else{
				if($_POST['fin_minutos'] > $_POST['inicio_minutos']){
					$hora_real = comprobar_hora_ocupada_planificacion_real($_POST['comercial'], $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'], $_POST['inicio_horas'].":".$_POST['inicio_minutos'], $_POST['fin_horas'].":".$_POST['fin_minutos']);
					$hora_planificada = comprobar_hora_ocupada_planificacion_planificada($_POST['comercial'], $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'], $_POST['inicio_horas'].":".$_POST['inicio_minutos'], $_POST['fin_horas'].":".$_POST['fin_minutos']);
			
					if(count($hora_real) == 1){
						if(count($hora_planificada) == 1){
							$total_duracion = calcular_hora($_POST['inicio_horas'].":".$_POST['inicio_minutos'],$_POST['fin_horas'].":".$_POST['fin_minutos']);
							if(!$_POST['cliente_proyecto']){
								$mensaje .=  "<hr>ERROR. No has seleccionado el cliente || trabajo<hr>";
							}
							else{
								$clienteproyecto = explode("||",$_POST['cliente_proyecto']);
								if(!$_POST['tipo_trabajo']){
									$mensaje .=  "<hr>ERROR. No has seleccionado el tipo de trabajo<hr>";
								}
								else{
									if($_POST['tipo_trabajo'] == '6'){
										$subtrabajo = $_POST['subtrabajo_otros'];
									}

									If($_POST['tema_importante']!=''){
										$tema_importante=1;
									}
									else{
										$tema_importante=0;
									}
									$insertar_parte = ejecutar_query("INSERT INTO kz_te_planificacion_partes VALUES(null, '".$_POST['comercial']."', '".$clienteproyecto[0]."', '".$_POST['provincia']."', '".$clienteproyecto[1]."', '".$_POST['ano']."-".$_POST['mes']."-".$_POST['dia']."', '".$_POST['inicio_horas'].":".$_POST['inicio_minutos']."', '".$_POST['fin_horas'].":".$_POST['fin_minutos']."', '".$total_duracion."', '".$_POST['tipo_trabajo']."', '".$subtrabajo."', '".$_POST['labor_realizada']."', '".$_POST['otros']."', '".$tema_importante."', '".date('Y-m-d H:i:s')."')");
									$mensaje .=  "<hr>Se ha a&ntilde;adido el parte<hr>";
								}
							}
						}
						else{
							$mensaje .=  "<hr>ERROR. Ya existen partes para este rango de hora<hr>";
						}
					}
					else{
						$mensaje .=  "<hr>ERROR. Existen partes reales para ese rango de hora<hr>";
					}
				}
				else{
					if($_POST['fin_minutos'] < $_POST['inicio_minutos']){
						$mensaje .=  "<hr>ERROR. La hora final debe ser mayor a la hora inicial<hr>";
					}
					else{
						$mensaje .=  "<hr>ERROR. La hora inicial y la hora final no pueden coincidir<hr>";
					}
				}
			}
		}
	}
	
	if($_POST['editar_planificacion_calendario']){
		if($_POST['comercial']){
			$total_duracion = calcular_hora($_POST['inicio_horas'].":".$_POST['inicio_minutos'],$_POST['fin_horas'].":".$_POST['fin_minutos']);
			$clienteproyecto = explode("||",$_POST['cliente_proyecto']);
			if($_POST['tipo_trabajo'] == '6'){
				$subtrabajo = $_POST['subtrabajo_otros'];
			}
				
			If($_POST['tema_importante']!=''){
				$tema_importante=1;
			}
			else{
				$tema_importante=0;
			}
			
			if($_POST['tipo'] == 'real'){
				$editar_parte = ejecutar_query("UPDATE kz_te_partes SET
				comercial = '".$_POST['comercial']."',
				cliente = '".$clienteproyecto[0]."',
				provincia = '".$_POST['provincia']."',
				proyecto = '".$clienteproyecto[1]."',
				dia = '".$_POST['ano']."-".$_POST['mes']."-".$_POST['dia']."',
				hora_inicio = '".$_POST['inicio_horas'].":".$_POST['inicio_minutos']."',
				hora_fin = '".$_POST['fin_horas'].":".$_POST['fin_minutos']."',
				total_duracion = '".$total_duracion."',
				tipo_trabajo = '".$_POST['tipo_trabajo']."',
				subtrabajo = '".$subtrabajo."',
				labor_realizada = '".$_POST['labor_realizada']."',
				otros = '".$_POST['otros']."',
				tema_importante = '".$tema_importante."'
				where id = ".$_POST['id']."");
			}
			
			if($_POST['tipo'] == 'planificado'){
				$total_duracion = calcular_hora($_POST['inicio_horas'].":".$_POST['inicio_minutos'],$_POST['fin_horas'].":".$_POST['fin_minutos']);
				$clienteproyecto = explode("||",$_POST['cliente_proyecto']);		
				$editar_parte = ejecutar_query("UPDATE kz_te_planificacion_partes SET
				comercial = '".$_POST['comercial']."',
				cliente = '".$clienteproyecto[0]."',
				provincia = '".$_POST['provincia']."',
				proyecto = '".$clienteproyecto[1]."',
				dia = '".$_POST['ano']."-".$_POST['mes']."-".$_POST['dia']."',
				hora_inicio = '".$_POST['inicio_horas'].":".$_POST['inicio_minutos']."',
				hora_fin = '".$_POST['fin_horas'].":".$_POST['fin_minutos']."',
				total_duracion = '".$total_duracion."',
				tipo_trabajo = '".$_POST['tipo_trabajo']."',
				subtrabajo = '".$subtrabajo."',
				labor_realizada = '".$_POST['labor_realizada']."',
				otros = '".$_POST['otros']."',
				tema_importante = '".$tema_importante."'
				where id = ".$_POST['id']."");
			}
			
			$mensaje .=  "<hr>Se ha editado el parte<hr>";
		}
		else{
			$mensaje .=  "<hr>ERROR. No has seleccionado el comercial<hr>";
		}
	}
	
	if($_POST['eliminar_planificacion_calendario']){
		if($_POST['tipo'] == 'real'){
			$eliminar_parte = ejecutar_query("DELETE FROM kz_te_partes WHERE id = ".$_POST['id']."");
		}
		
		if($_POST['tipo'] == 'planificado'){
			$eliminar_parte = ejecutar_query("DELETE FROM kz_te_planificacion_partes WHERE id = ".$_POST['id']."");
		}
		
		$mensaje .=  "<hr>Se ha eliminado el parte<hr>";
	}
	
	if($_POST['convertir_planificacion_calendario']){
		$convertir = ejecutar_query("INSERT INTO kz_te_partes VALUES(null, '".$_POST['comercial']."', '".$_POST['cliente']."', '".$_POST['provincia']."', '".$_POST['proyecto']."', '".$_POST['fecha_elim_conver']."', '".$_POST['hora_inicio']."', '".$_POST['hora_fin']."', '".$_POST['total_duracion']."', '".$_POST['tipo_trabajo']."', '".$_POST['subtrabajo']."', '".$_POST['labor_realizada']."', '".$_POST['otros']."', 0, '".date('Y-m-d H:i:s')."')");
		
		if($_POST['tipo'] == 'real'){
			$eliminar_parte = ejecutar_query("DELETE FROM kz_te_partes WHERE id = ".$_POST['id']."");
		}
		
		if($_POST['tipo'] == 'planificado'){
			$eliminar_parte = ejecutar_query("DELETE FROM kz_te_planificacion_partes WHERE id = ".$_POST['id']."");
		}
		
		$mensaje .=  "<hr>Se ha convertido el parte<hr>";
	}
	
	if($_POST['anadir_dietas']){
		if($_POST['km'] > '75'){	
			$horas_dietas = number_format((($_POST['km'] - 75) / 70),2,'.','.');
		}
		
		$km = str_replace(",", ".", $_POST['km']);
		$parking = str_replace(",", ".", $_POST['parking']);
		$peajes = str_replace(",", ".", $_POST['peajes']);
		$comidas = str_replace(",", ".", $_POST['comidas']);
		$otros = str_replace(",", ".", $_POST['otros']);
			
		$anadir_dietas = ejecutar_query("INSERT INTO kz_te_dietas VALUES(null, '".$ID_PERSONA['id']."', '".$_POST['ano']."-".$_POST['mes']."-".$_POST['dia']."', '".$km."', '".$parking."', '".$peajes."', '".$comidas."', '".$otros."', '".$_POST['observaciones']."', '".$horas_dietas."')");
		
		$mensaje .=  "<hr>Se han a&ntilde;adido las dietas<hr>";
	}
	
	if($_POST['editar_dietas']){	
		$editar_editas = ejecutar_query("UPDATE kz_te_dietas SET
		fecha = '".$_POST['ano']."-".$_POST['mes']."-".$_POST['dia']."',
		km = '".$_POST['km']."',
		parking = '".$_POST['parking']."',
		peajes = '".$_POST['peajes']."',
		comidas = '".$_POST['comidas']."',
		otros = '".$_POST['otros']."',
		observaciones = '".$_POST['observaciones']."'
		where id = ".$_POST['id']."");
		
		$mensaje .=  "<hr>Se han editado las dietas<hr>";
	}
	
	if($_POST['eliminar_dietas']){
		$eliminar_dietas = ejecutar_query("DELETE FROM kz_te_dietas WHERE id = ".$_POST['id']."");
		
		$mensaje .=  "<hr>Se han eliminado las dietas<hr>";
	}
	?>
			
	<div class='mensaje'><?php echo $mensaje; ?></div><br>
			
	<?php 		
	switch ($_POST['seleccion_formulario']){
		case 'anadir_dietas':
			include("../commons/partes/dietas/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		case 'editar_dietas':
			include("../commons/partes/dietas/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		case 'eliminar_dietas':
			include("../commons/partes/dietas/form_".$_POST['seleccion_formulario'].".php");
			break;
			
		default: ?>
		
			<form action='index.php' method='POST'>Partes de: 
			<?php
				 //PERMISO Asignar parte de cualquier persona P221 
				if(in_array(221,$datos_perfil['PERMISOS'])){ ?>
		
						<select name="comercial" id="comercial">
			         		<?php
			         		combo_base_array_2($PERSONAL,$_POST['comercial']);
			      			?>
		       			</select>
		     	<?php //PERMISO Asignar parte de cualquier persona P221 
				} else { ?>
		
				<input type='hidden' name="comercial" id="comercial" value='<?php echo $ID_PERSONA['id']; ?>'><?php echo $ID_PERSONA['nombre']." ".$ID_PERSONA['apellidos']; ?>
				
				<?php } ?><br /><br />
				Seleccionar fecha:
					<input type='hidden' name='pag' value='<?php echo $pag; ?>'>
						<select class="select-comun" name="ano"  id="ano" >
		         			<?php	
		      				combo_base_array($array_annos,$fpd["Y"]);
		      				?>
		        		</select> -
		        		<select class="select-comun" name="mes"  id="mes" >
		         			<?php	
		      				combo_base_array($array_meses,$fpd["m"]);
		      				?>
		        		</select> -
						<select class="select-comun" name="dia"  id="dia" >
		         			<?php	
		      				combo_base_array($array_dias,$fpd["d"]);
		      				?>
		        		</select>
		        		
		       <input class="bt-accion" type='submit' name='ir_a_fecha' value='Ir a fecha'> <input class="bt-accion" type='submit' name='hoy' value='Hoy'>
			</form>
			<?php 
			
			
			//INFORMACION DE LOS PROYECTOS
			$PROYECTOS = select_normal("Select p.*, c.nombre_comercial from kz_te_proyectos p, kz_te_proyecto_personal a, kz_te_clientes c where p.cliente=c.id and p.finalizado = 0 and a.tecnico = ".$_POST['comercial']." and p.id = a.proyecto order by prioridad, nombre_comercial",'id');
			if($PROYECTOS)
			foreach($PROYECTOS as $key => $valor) $in_proyectos .= ",'$key'"; $in_proyectos = substr($in_proyectos,1,strlen($in_proyectos));
			$partes = select_normal("(SELECT 'real' as 'TIPO', kz_te_partes.* FROM kz_te_partes where kz_te_partes.dia between '$fechainicio' and '$fechafin' and kz_te_partes.comercial = ".$_POST['comercial'].") 
				UNION
				(SELECT 'planificado' as TIPO, kz_te_planificacion_partes.* FROM kz_te_planificacion_partes WHERE kz_te_planificacion_partes.dia between '$fechainicio' and '$fechafin' and  kz_te_planificacion_partes.comercial = ".$_POST['comercial'].")");
			
			$partes_naranjas = select_normal("SELECT 'naranja' as ESTADO, kz_te_planificacion_partes.* FROM kz_te_planificacion_partes WHERE tema_importante = '1' and kz_te_planificacion_partes.comercial = ".$_POST['comercial']." and kz_te_planificacion_partes.dia between '$fechainicio' and '$fechafin'");
			
			$partes_visitas = select_normal("SELECT 'visita' as ESTADO, kz_te_planificacion_partes.* FROM kz_te_planificacion_partes WHERE tipo_trabajo = '3' and kz_te_planificacion_partes.comercial = ".$_POST['comercial']." and kz_te_planificacion_partes.dia between '$fechainicio' and '$fechafin'");
			
			echo "<br><h4>Semana del ".conversion_formato_fecha($fechainicio,'abreviado')." al ".conversion_formato_fecha($fechafin,'abreviado')."</h4><br>";
			?>
			
			<table width=40%>
			<tr>
			<td style='background-color:#DFFEDE; width:25px; height:25px; border:2px solid GREEN'></td>
			<td style='width:90px;'>Partes reales</td>
			
			<td style='background-color:#ebebff; width: 25px; height:25px; border:2px solid BLUE'></td>
			<td style='width:100px;'>Partes planificadas</td>
			
			<td style='background-color:#FFE1B5; width: 25px; height:25px; border:2px solid ORANGE'></td>
			<td style='width:100px;'>Tema importante</td>
			</tr>
			</table>
			
			<?php 
			for($i = 0; $i < 10; $i++){
				$dia[$i][0] = 0;
			}
			if($partes)
			foreach($partes as $key => $valor){
				$dia[conversion_formato_fecha($valor['dia'],'diasemana')][count($dia[conversion_formato_fecha($valor['dia'],'diasemana')])] = hora_sin_segundos($valor['hora_inicio']);
				$parte[conversion_formato_fecha($valor['dia'],'diasemana')][hora_sin_segundos($valor['hora_inicio'])] = $valor;
			}
			
			if($partes_visitas)
			foreach($partes_visitas as $keyvisita => $valorvisita){
				$dia[conversion_formato_fecha($valorvisita['dia'],'diasemana')][count($dia[conversion_formato_fecha($valorvisita['dia'],'diasemana')])] = hora_sin_segundos($valorvisita['hora_inicio']);
				$parte_visita[conversion_formato_fecha($valorvisita['dia'],'diasemana')][hora_sin_segundos($valorvisita['hora_inicio'])] = $valorvisita;
			}
			
			if($partes_naranjas)
			foreach($partes_naranjas as $keynaranja => $valornaranja){
				$dia[conversion_formato_fecha($valornaranja['dia'],'diasemana')][count($dia[conversion_formato_fecha($valornaranja['dia'],'diasemana')])] = hora_sin_segundos($valornaranja['hora_inicio']);
				$parte_naranja[conversion_formato_fecha($valornaranja['dia'],'diasemana')][hora_sin_segundos($valornaranja['hora_inicio'])] = $valornaranja;
			}
			
			$fecha[1] = $fechainicio;
			$fecha[0] = sumar_dias($fechainicio,6);
			for($i = 2; $i < 7; $i++){
				$fecha[$i] = sumar_dias($fechainicio,($i-1));
			}
			?>
			
			<div class='selector_semana'>
				<form  action='index.php' method='POST'>
				<input type='hidden' name='pag' value='<?php echo $pag; ?>'>
				<table style='width: 100%;'>
				<tr><td style='width: 50%; text-align: left;'>
					<input style='margin-left: 0px;' type='submit' name='semana_anterior' value='Semana anterior'>
					<input type='hidden' name='fecha' value='<?php echo $fechainicio; ?>'>
					<input type='hidden' name='comercial' value='<?php echo $_POST['comercial'];  ?>'>
					</td>
					<td  style='width: 50%;  text-align: right;'>
					<input  style='margin-right: 0px;' type='submit' name='semana_siguiente' value='Semana siguiente'>
					</td>
				</tr></table>
				</form>
			</div>
			
			<table class='agenda'>
				<tr><th></th>
				<?php
				for($i = 1; $i < 7; $i++){
					echo "<th>".$ARRAY_DIAS_SEMANA[$i]."
					<br>".conversion_formato_fecha($fecha[$i],'d')." - ".substr($ARRAY_MESES[(conversion_formato_fecha($fecha[$i],'m'))-1],0,3)."
					</th>";
				}
				echo "<th>".$ARRAY_DIAS_SEMANA[0]." <br>".conversion_formato_fecha($fecha[0],'d')." - ".substr($ARRAY_MESES[(conversion_formato_fecha($fecha[0],'m'))-1],0,3)."</th>";
				?>
				</tr>
				
				<?php
				$domingo[0] = 'background-color: #afafaf;';
				$domingo[7] = 'background-color: #afafaf;';
				$intervalos = array('00','05','10','15','20','25','30','35','40','45','50','55');
				for($i = 7; $i < 22; $i++){
				
					foreach($intervalos as $key => $valor){
						echo "<tr>";
						if($valor == '00'){
							$mostrarhora = $i.":".$valor;
							echo "<th rowspan=12 >$mostrarhora</th>"; 
							$raya_arriba = " border-top: 1px solid #037500;";
						}
						else{ 
							if(in_array($valor,array('15','30','45'))){
								$raya_arriba = "border-top: 1px solid #f0f0f0; border-left: 1px solid #f0f0f0; border-right: 1px solid #f0f0f0; "; 
							}
							else $raya_arriba = "border-top: 1px solid white; border-left: 1px solid white; border-right: 1px solid white; "; 
							
						}
						
							$mostrarhora = '';
						
							for($s = 1; ($s < 8) && $s > 0 ; $s++){
								if($s==7) $s = 0;
								if($fecha[$s] == date("Y-m-d")){
									$diadehoy[$s] = 'background-color: #feffd2;';
								}
								$minutos = str_pad($i,2,"0",STR_PAD_LEFT);
								if($encita[$s] == $minutos.":".$valor){ $encita[$s]= ''; $class[$s]=''; $classcelda[$s] = "";}
								if(in_array($minutos.":".$valor,$dia[$s])){
								
									$contenido = "<div class='cita'>
									".hora_sin_segundos($parte[$s][$minutos.":".$valor]['hora_inicio'])."-".hora_sin_segundos($parte[$s][$minutos.":".$valor]['hora_fin'])."
									<a style='cursor:pointer;'><img src='../img/iconos/pencil.png' style='width:13px;' onClick=\"openDialog2(this,{pag: '$pag', tipo: '".$parte[$s][$minutos.":".$valor]['TIPO']."', id: '".$parte[$s][$minutos.":".$valor]['id']."', comercial: '".$_POST['comercial']."'});\" style='$raya_arriba $diadehoy[$s] $domingo[$s]'></a>
									<a style='cursor:pointer;'><img src='../img/iconos/real.png' style='width:22px;' onClick=\"openDialog4(this,{pag: '$pag', tipo: '".$parte[$s][$minutos.":".$valor]['TIPO']."', id: '".$parte[$s][$minutos.":".$valor]['id']."', comercial: '".$_POST['comercial']."'});\" style='$raya_arriba $diadehoy[$s] $domingo[$s]'></a>
									<a style='cursor:pointer;'><img src='../img/iconos/cancel.png' style='width:13px;' onClick=\"openDialog1(this,{pag: '$pag', tipo: '".$parte[$s][$minutos.":".$valor]['TIPO']."', id: '".$parte[$s][$minutos.":".$valor]['id']."', comercial: '".$_POST['comercial']."'});\" style='$raya_arriba $diadehoy[$s] $domingo[$s]'><br></a>
									".$PARTES_CLIENTES[$parte[$s][$minutos.":".$valor]['cliente']]."</div>";
									$encita[$s] = hora_sin_segundos($parte[$s][$minutos.":".$valor]['hora_fin']);
								}
								else $contenido = "";
								
								if($encita[$s] != ''){
									if(($parte[$s][$minutos.":".$valor]['TIPO']) == 'real'){
										$class[$s] = "style='background-color: #DFFEDE; color: black; font-weight: bolder;border: 2px solid GREEN;'";
									}
									if(($parte[$s][$minutos.":".$valor]['TIPO']) == 'planificado'){
										$class[$s] = "style='background-color: #ebebff; color: black; font-weight: bolder;border: 2px solid BLUE;'";
									}
									if(($parte_visita[$s][$minutos.":".$valor]['ESTADO']) == 'visita'){
										$class[$s] = "style='background-color: #FEFFAC; color: black; font-weight: bolder;border: 2px solid YELLOW;'";
									}
									if(($parte_naranja[$s][$minutos.":".$valor]['ESTADO']) == 'naranja'){
										$class[$s] = "style='background-color: #FFE1B5; color: black; font-weight: bolder;border: 2px solid ORANGE;'";
									}
								}
								if($contenido != ''){
									echo "<td  class='hora' id='$mostrarhora'rowspan=".(calcular_hora($parte[$s][$minutos.":".$valor]['hora_inicio'],$parte[$s][$minutos.":".$valor]['hora_fin'])/5)." $class[$s] style='$raya_arriba' >
									$contenido </td>";
								}
								else if($encita[$s] == '') {
									echo "<td $class[$s] onClick=\"openDialog3(this,{pag: '$pag', dia: '$fecha[$s]', minutos: '$valor', hora: '$i', comercial: '".$_POST['comercial']."'});\" style='$raya_arriba $diadehoy[$s] $domingo[$s]' ></td>";}
								if($s==0) $s = 7;
							}
							echo "</tr>";
					}
				}
				?>
				
				<script type="text/javascript">   
					function openDialog3(html,params) {
						var parametros = '';
					  	if(params)
							for (var k in params)
								parametros += "&"+k+"="+params[k];
							  
							    //var effect = new PopupEffect(html, {className: "popup_effect1"});
							    Dialog.alert({url: "../commons/planificacion_calendario/form_anadir.php?d=1" + parametros}, {width: 650,  height:600, okLabel: "CERRAR"});  
							    //Dialog.confirm("Test of confirm panel, check out debug window after closing it.", {width:600, height:510, okLabel: "close", buttonClass: "myButtonClass", id: "myDialogId", cancel:function(win) {debug("cancel confirm panel")}, ok:function(win) {debug("validate confirm panel"); return true;} }); 
							    //Dialog.confirm({url:"../commons/planificacion_calendario/form_anadir.php?d=1" + parametros}, {width: 600,  height:510,  okLabel: "CERRAR", showEffect:effect.show.bind(effect), hideEffect:effect.hide.bind(effect)})
					}
					function openDialog1(html,params) {
						var parametros = '';
					  	if(params)
							for (var k in params)
								parametros += "&"+k+"="+params[k];
							  
							    //var effect = new PopupEffect(html, {className: "popup_effect1"});
							    Dialog.alert({url: "../commons/planificacion_calendario/form_eliminar.php?d=1" + parametros}, {width: 650,  height:550, okLabel: "CANCELAR"});  
							    //Dialog.confirm("Test of confirm panel, check out debug window after closing it.", {width:600, height:510, okLabel: "close", buttonClass: "myButtonClass", id: "myDialogId", cancel:function(win) {debug("cancel confirm panel")}, ok:function(win) {debug("validate confirm panel"); return true;} }); 
							    //Dialog.confirm({url:"../commons/planificacion_calendario/form_anadir.php?d=1" + parametros}, {width: 600,  height:510,  okLabel: "CERRAR", showEffect:effect.show.bind(effect), hideEffect:effect.hide.bind(effect)})
					}
					function openDialog2(html,params) {
						var parametros = '';
					  	if(params)
							for (var k in params)
								parametros += "&"+k+"="+params[k];
							  
							    //var effect = new PopupEffect(html, {className: "popup_effect1"});
							    Dialog.alert({url: "../commons/planificacion_calendario/form_editar.php?d=1" + parametros}, {width: 650, height: 600, okLabel: "CANCELAR"});  
							    //Dialog.confirm("Test of confirm panel, check out debug window after closing it.", {width:600, height:510, okLabel: "close", buttonClass: "myButtonClass", id: "myDialogId", cancel:function(win) {debug("cancel confirm panel")}, ok:function(win) {debug("validate confirm panel"); return true;} }); 
							    //Dialog.confirm({url:"../commons/planificacion_calendario/form_anadir.php?d=1" + parametros}, {width: 600,  height:510,  okLabel: "CERRAR", showEffect:effect.show.bind(effect), hideEffect:effect.hide.bind(effect)})
					}
					function openDialog4(html,params) {
						var parametros = '';
					  	if(params)
							for (var k in params)
								parametros += "&"+k+"="+params[k];
							  
							   //var effect = new PopupEffect(html, {className: "popup_effect1"});
							    Dialog.alert({url: "../commons/planificacion_calendario/form_convertir.php?d=1" + parametros}, {width: 650,  height:550, okLabel: "CANCELAR"});  
							    //Dialog.confirm("Test of confirm panel, check out debug window after closing it.", {width:600, height:510, okLabel: "close", buttonClass: "myButtonClass", id: "myDialogId", cancel:function(win) {debug("cancel confirm panel")}, ok:function(win) {debug("validate confirm panel"); return true;} }); 
							    //Dialog.confirm({url:"../commons/planificacion_calendario/form_anadir.php?d=1" + parametros}, {width: 600,  height:510,  okLabel: "CERRAR", showEffect:effect.show.bind(effect), hideEffect:effect.hide.bind(effect)})
					}
				</script>
				
			</table>
			
			<br>
			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<th>Cliente</th>
					<th>Trabajo</th>
					<th>Prioridad</th>
					<th>Fecha fin</th>
					<th>Horas</th>
					<th>Horas pendientes</th>
				</tr>
				
				<?php if($PROYECTOS){
						foreach ($PROYECTOS as $key => $valor){
							$h_pendientes = horas_pendientes($valor['horas_auditoria'], $valor['id'], $ID_PERSONA['id']);	
						?>
						<tr>
							<td><?php echo $valor['nombre_comercial'];?></td>
							<td><?php echo $valor['id']." || ".$valor['nombre'];?></td>
							<td><?php echo $valor['prioridad'];?></td>
							<td><?php echo $valor['fecha_prevista'];?></td>
							<td><?php echo $valor['horas_auditoria'];?></td>
							<td><?php echo number_format(($h_pendientes),2,',','.')."h";?></td>
						</tr>
						<?php
					 	}
					}
					else{ ?>
						<tr>
							<td colspan=9>
								<?php echo "<i>(No hay ning&uacute;n trabajo)</i>"; ?>
					
							</td>
						</tr>
					<?php }?>
			</table>
			
			<br><hr><br>
			<form action='index.php' method='post'>
				<input type='hidden' name='mantener_fecha' value='<?php echo $fecha_parte; ?>'>
				<input class="bt-nuevo-documento" type='submit' name='accion' value='A&ntilde;adir dietas'>
				<input type='hidden' name='seleccion_formulario' value='anadir_dietas'>
				<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
			</form>
			
			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<th>Fecha</th>
					<th>Km</th>
					<th>Parking / O.T.A.</th>
					<th>Peajes</th>
					<th>Comidas</th>
					<th>Otros</th>
					<th>Observaciones (otros)</th>
				</tr>
							
				<?php	
				$dietas = select_normal("SELECT * FROM kz_te_dietas WHERE fecha >= '".$fechainicio."' and fecha <= '".$fechafin."' and tecnico = '".$ID_PERSONA['id']."' ORDER BY fecha desc");
			
				if($dietas){
				foreach($dietas as $key => $valor){ ?>
					<tr>
						<td><?php echo $valor['fecha']; ?></td>
						<td><?php echo number_format(($valor['km']),2,',','.'); ?>km</td>
						<td><?php echo number_format(($valor['parking']),2,',','.'); ?>&euro;</td>
						<td><?php echo number_format(($valor['peajes']),2,',','.'); ?>&euro;</td>
						<td><?php echo number_format(($valor['comidas']),2,',','.'); ?>&euro;</td>
						<td><?php echo number_format(($valor['otros']),2,',','.'); ?>&euro;</td>
						<td><?php echo $valor['observaciones']; ?></td>
						<td>
							<form action='index.php' method='POST'>
								<input class="bt-editar" type='submit' name='accion' value='Editar'>
								<input type='hidden' name='seleccion_formulario' value='editar_dietas'></input>
								<input type='hidden' name='id' value='<?php echo $valor['id']; ?>'></input>
								<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
							</form>
						</td>
						<td>
							<form action='index.php' method='POST'>
								<input class="bt-eliminar" type='submit' name='accion' value='Eliminar'>
								<input type='hidden' name='seleccion_formulario' value='eliminar_dietas'>
								<input type='hidden' name='id' value='<?php  echo $valor['id']; ?>' />
								<input type='hidden' name='pag' value='<?php  echo $pag; ?>'></input>
							</form>
						</td>
					</tr>		
				<?php }
				}
				else { ?>
					<tr>
						<td colspan=7>
							<?php echo "<i>(No est&aacute;n a&ntilde;adidas las dietas)</i>"; ?>
						</td>
					</tr>
				<?php } ?>
			</table>
	
			<?php
			$desc_partes = select_normal("SELECT kz_te_partes.*, kz_te_clientes.nombre_comercial as cliente, kz_te_proyectos.id as idproyecto, kz_te_proyectos.nombre as proyecto FROM (kz_te_partes LEFT OUTER JOIN kz_te_clientes ON kz_te_partes.cliente=kz_te_clientes.id) LEFT OUTER JOIN kz_te_proyectos ON kz_te_partes.proyecto=kz_te_proyectos.id WHERE kz_te_partes.dia between '$fechainicio' and '$fechafin' AND kz_te_partes.comercial = '".$_POST['comercial']."' ORDER BY dia");
			?>
			
			<br><hr><br>
			<b>Descripci&oacute;n de los partes:</b>
			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<th>Fecha</th>
					<th>Cliente || Trabajo</th>
					<th>Duraci&oacute;n</th>
					<th>Tipo trabajo</th>
					<th>Labor realizada</th>
					<th>Otros</th>
				</tr>
				
				<?php 
				if($desc_partes){
					foreach($desc_partes as $key => $valor){ ?>
						<tr>
							<td style='text-align: center;'><?php echo $valor['dia']; ?></td>
							<td style='text-align: center;'><?php echo $valor['cliente']." || ".$valor['idproyecto']." - ".$valor['proyecto'];?></td>
							<?php 
							$duracion = $valor['total_duracion'] / 60;
							?>
							<td style='text-align: center;'><?php echo number_format(($duracion),2,',','.')."h";?></td>
							<td><?php echo $ARRAY_TRABAJOS['trabajos_padre'][$valor['tipo_trabajo']]; ?> 
							<?php if(($valor['tipo_trabajo'] == '1') or ($valor['tipo_trabajo'] == '5')){ 
								if ($valor['subtrabajo'] != ''){ ?>
									=> <?php echo $valor['subtrabajo'];
								}
							}?>
							</td>
							<td style='text-align: center;'><?php echo $valor['labor_realizada']; ?></td>
							<td style='text-align: center;'><?php echo $valor['otros']; ?></td>
						</tr>
					<?php }
				}
				else { ?>
					<tr>
						<td colspan=6>
							<?php echo "<i>(No hay ning&uacute;n parte)</i>"; ?>
						</td>
					</tr>
				<?php } ?>
			</table>
			
			<?php break;
	}?>
  </div>
</div>