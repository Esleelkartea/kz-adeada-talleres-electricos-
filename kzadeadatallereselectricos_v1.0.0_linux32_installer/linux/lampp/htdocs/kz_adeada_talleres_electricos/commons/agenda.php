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
<?php $alto_celda = '5px'; 
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
		$hoy = date("Y-m-d");
		$fechassemana = obtener_semana($hoy);
		$fechainicio = $fechassemana[0];
		$fechafin = $fechassemana[1];
	}
	}
	
$fpd = desglose_fecha_hora($fechainicio);
//MES EN BBDD

$mes_actual=gisper_meses($fechainicio,$fechafin);
//$mes_actual = select_normal("Select * from gisper_meses where fecha_inicio <= '$fechainicio' and fecha_fin >= '$fechainicio'");

$comienzomes = $mes_actual[0]['fecha_inicio'];
$finmes = $mes_actual[0]['fecha_fin'];
$nombre_mes = $mes_actual[0]['mes'];
//FIN MES BBDD
?>

<div id="cuerpo">
  <div id="contenido">
	<h1>Vista agenda</h1>
	<br />
	<form action='index.php?menu=administracion_partes' method='POST'>Partes de: 
	<?php
			 //PERMISO A�adir parte de cualquier persona P221 
			if(in_array(221,$datos_perfil['PERMISOS'])){ ?>
	
					<select class="select-comun" name="comercial" id="comercial">
		         		<?php
		         		combo_base_array_2($PERSONAL,$_POST['comercial']);
		      			?>
	       			</select>
	     	<?php //PERMISO A�adir parte de cualquier persona P221 
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
	$partes = select_normal("SELECT * FROM kz_te_partes WHERE comercial = ".$_POST['comercial']." and dia between '$fechainicio' and '$fechafin'");
	
	echo "<br><h4>Semana del ".conversion_formato_fecha($fechainicio,'abreviado')." al ".conversion_formato_fecha($fechafin,'abreviado')."</h4><br>";
	
	for($i = 0; $i < 10; $i++){
		$dia[$i][0] = 0;
	}
	if($partes)
	foreach($partes as $key => $valor){
		$dia[conversion_formato_fecha($valor['dia'],'diasemana')][count($dia[conversion_formato_fecha($valor['dia'],'diasemana')])] = hora_sin_segundos($valor['hora_inicio']);
		$parte[conversion_formato_fecha($valor['dia'],'diasemana')][hora_sin_segundos($valor['hora_inicio'])] = $valor;
	}
	
	$fecha[1] = $fechainicio;
	$fecha[0] = sumar_dias($fechainicio,6);
	for($i = 2; $i < 7; $i++){
		$fecha[$i] = sumar_dias($fechainicio,($i-1));
	}
	
	?>
	
	<div class='selector_semana'>
	
	<form  action='index.php?menu=administracion_partes' method='POST'>
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
	for($i = 7; $i < 20; $i++){
	
		foreach($intervalos as $key => $valor){
			echo "<tr>";
			if($valor == '00'){
				$mostrarhora = $i.":".$valor;
				echo "<th rowspan=12 class='hora'>$mostrarhora</th>";
				$raya_arriba = " border-top: 1px solid #037500;";
			}
			else{ $mostrarhora = ''; $raya_arriba = "border-top: 1px solid #f0f0f0; border-left: 1px solid #f0f0f0; border-right: 1px solid #f0f0f0; "; }
			
			for($s = 1; ($s < 8) && $s > 0 ; $s++){
				if($s==7) $s = 0;
				if($fecha[$s] == date("Y-m-d")){
					$diadehoy[$s] = 'background-color: #feffd2;';
				}
				$minutos = str_pad($i,2,"0",STR_PAD_LEFT);
				if($encita[$s] == $minutos.":".$valor){ $encita[$s]= ''; $class[$s]=''; $classcelda[$s] = "";}
				if(in_array($minutos.":".$valor,$dia[$s])){
				
					$contenido = "<div class='cita'>
					".hora_sin_segundos($parte[$s][$minutos.":".$valor]['hora_inicio'])."-".hora_sin_segundos($parte[$s][$minutos.":".$valor]['hora_fin'])."<br>
					".$PARTES_CLIENTES[$parte[$s][$minutos.":".$valor]['cliente']]."<br>
					".$ARRAY_PROYECTOS[$parte[$s][$minutos.":".$valor]['proyecto']]."<br>
					".$ARRAY_TRABAJOS['trabajos_padre'][$parte[$s][$minutos.":".$valor]['tipo_trabajo']]."</div>";
					$encita[$s] = hora_sin_segundos($parte[$s][$minutos.":".$valor]['hora_fin']);				
				}
				else $contenido = "";
				
				if($encita[$s] != ''){
					$class[$s] = "style='background-color: #ebebff; color: black; font-weight: bolder;border: 2px solid BLUE;'";
				}
				if($contenido != ''){
					echo $tabla[$i][$valor] = "<td rowspan=".(calcular_hora($parte[$s][$minutos.":".$valor]['hora_inicio'],$parte[$s][$minutos.":".$valor]['hora_fin'])/5)." $class[$s] style='$raya_arriba' >
					$contenido </td>";
				}
				else if($encita[$s] == '') {echo "<td $class[$s] style='$raya_arriba $diadehoy[$s] $domingo[$s]' ></td>";}
				if($s==0) $s = 7;
			}
			echo "</tr>";
		}
	
	}
	
	?>
	
	</table>
  </div>
</div>