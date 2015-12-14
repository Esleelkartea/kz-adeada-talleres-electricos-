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
require('../../../functions/globales.php');
require('../include/rutas.php');
require('../functions/main.php');
require('../struct/login2.php');
require('../functions/rrhh_functions.php');
$titulo = "Informe de fichas de personal";

if($_POST['persona'] != ''){
	$filtropersona = " where id = ".$_POST['persona']."";
}

$personas = select_normal("SELECT * FROM kz_tec_rrhh_personal $filtropersona order by apellidos asc"); 

if($personas){
	if($_POST['pdf']){
		
		require(FPDF_PDF_RUTA.'lib/pdftable.inc.php');
		
		$p = new PDFTable('P');
		$p->SetMargins(3,43,0);
		
		foreach($personas as $key => $valor){
			$p->AddPage('P');
			$p->SetMargins(3,10,0);
			$p->titulo(5,$titulo);	
			$p->setfont('Arial','',8);
			$p->SetTitle(date("d-m-Y")."_informe");
			$p->SetFillColor(255,255,255);
			$p->SetTextColor(0,0,0);
			$p->SetDrawColor(0,0,0);	
			
			$color1 = 'A6A6A6';
			$color2 = 'FFFFFF';
			$color3 = 'CECECE';
			$tit = "bgcolor=#$color3 color=#$color2 align=center valign=middle style=bold height=8";
			$tit2 = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
			$tit3 = "bgcolor=#5F5F5F color=#$color2 align=center valign=middle style=bold height=4";
			$nor = "align=center height=5 valign=middle";
			
			$tablam = "<table border=1>
				<tr>
					<td $tit3 colspan=4>Datos personales</td>
				</tr>	
				<tr>		
					<td $tit2 width=35>Nombre:</td>
					<td $nor width=62>".$valor['nombre']."</td>
					<td $tit2 width=30>Funciones:</td>
					<td $nor width=77>".$valor['funciones']."</td>
				</tr>
					<tr>
						<td $tit2>Apellidos:</td>
						<td $nor>".$valor['apellidos']."</td>
						<td $tit2>".html_entity_decode("Titulaci&oacute;n").":</td>
						<td $nor>".$valor['titulacion']."</td>
					</tr>
					<tr>
						<td $tit2>".html_entity_decode("Tel&eacute;fono").":</td>
						<td $nor>".$valor['telefono']."</td>
						<td $tit2>".html_entity_decode("Formaci&oacute;n").":</td>
						<td $nor>".$valor['formacion']."</td>						
					</tr>	
					<tr>
						<td $tit2>".html_entity_decode("M&oacute;vil").":</td>
						<td $nor>".$valor['movil']."</td>	
						<td $tit2>Experiencia:</td>
						<td $nor>".$valor['experiencia']."</td>									
					</tr>	
					<tr>
						<td $tit2>Email:</td>
						<td $nor>".$valor['email']."</td>
						<td $tit2>Fecha alta:</td>
						<td $nor>".$valor['alta']."</td>					
					</tr>
					<tr>
						<td $tit2>".html_entity_decode("Direcci&oacute;n").":</td>
						<td $nor>".$valor['direccion']."</td>
						<td $tit2>Fecha baja:</td>
						<td $nor>".$valor['baja']."</td>	
					</tr>	
					<tr>
						<td $tit2>C.P.:</td>
						<td $nor>".$valor['cp']."</td>
					</tr>	
					<tr>
						<td $tit2>".html_entity_decode("Poblaci&oacute;n").":</td>
						<td $nor>".$valor['poblacion']."</td>
					</tr>
					<tr>
						<td $tit2>Fecha de nacimiento:</td>
						<td $nor>".$valor['fecha_nacimiento']."</td>
					</tr>
					<tr>
						<td $tit2>DNI:</td>
						<td $nor>".$valor['dni']."</td>
					</tr>
					<tr>
						<td $tit2>".html_entity_decode("N&deg; Seg. Social").":</td>
						<td $nor>".$valor['seguridad_social']."</td>
					</tr>
			</table>";
				
			$p->htmltable($tablam);
			$p->Ln(5);
			
			$tablam = "<table border=1>
				<tr>
					<td $tit3 colspan=3>Cursos</td>
				</tr>
				<tr>
					<td $tit2 width=90>Curso</td>
					<td $tit2 width=97>".html_entity_decode("Valoraci&oacute;n")."</td>
					<td $tit2 width=17>Fecha</td>
				</tr>";
				$cursos_asistidos = select_normal("Select a.id, a.curso, a.valoracion, a.comentarios, a.fecha, b.ano, b.accionformativa from kz_tec_rrhh_asistentesformacion a, kz_tec_rrhh_accformativa b where a.persona = ".$valor['id']." and a.curso = b.id order by b.ano");
				
				if($cursos_asistidos){	
					foreach($cursos_asistidos as $key11 => $valor11){ 
						$tablam .= "<tr>
							<td $nor>(".$valor11['ano'].") ".$valor11['accionformativa']."</td>
							<td $nor>".$valor11['valoracion'].": ".$valor11['comentarios']."</td>
					      	<td $nor>".$valor11['fecha']."</td>
						</tr>";			
					}
				}
				else $tablam.= "<tr><td colspan=3>No hay cursos</td></tr>";
			$tablam .= "</table>";
			
			$p->htmltable($tablam);
		}
		$p->output();
	}
}
else{
	echo "<script>alert('No se puede mostrar el informe. No hay personal.');</script>";
	echo "<script>window.close();</script>";
}?>
