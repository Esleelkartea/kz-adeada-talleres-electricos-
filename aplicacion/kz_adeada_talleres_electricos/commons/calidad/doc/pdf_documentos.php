<?php session_start();
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
require('../functions/doc_functions.php');
$titulo = "Informe de documentos";

if($_POST['tipodoc'] != ''){
	$filtros = " and tipo = '".$_POST['tipodoc']."'";
}
$documentos = documentos(BBDDUSUARIO, $_POST['orden'],'',$filtros);

if($documentos){	
	if($_POST['xls']){
		//header("Pragma: ");
		header('Cache-control: ');
		header("Expires: -1000");
		//header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=Informe_documentos.xls");
		header("Pragma: public");?>
		<table><tr><td><?php echo $titulo; ?></td></table>
	<?php }
	
	$color1 = 'A6A6A6';
	$color2 = 'FFFFFF';
	$clasetd = "bgcolor=#$color1 color=#$color2 align=center valign=middle style=bold height=8";
	$clasetd2 = "align=center height=5 valign=middle";
	
	$tablam .= "<table border=1>
		<tr>
			<td $clasetd width=26>Tipo documento</td>
			<td $clasetd width=18>".html_entity_decode("C&oacute;digo")."</td>
			<td $clasetd width=33>Nombre</td>
			<td $clasetd width=49>".html_entity_decode("Descripci&oacute;n")."</td>
			<td $clasetd width=23>Tipo</td>
			<td $clasetd width=23>Soporte</td>
			<td $clasetd width=21>Generado</td>
			<td $clasetd width=21>Aprobado</td>
			<td $clasetd width=17>Fecha</td>
			<td $clasetd width=26>Periodo</td>
			<td $clasetd width=16>Lugar</td>
			<td $clasetd width=10>Vigor</td>
			<td $clasetd width=7>Int.</td>
		</tr>";
	
		$tablam .= "";
		foreach($documentos as $key => $valor){
			if(($_POST['vigor'] != '' && $_POST['vigor'] == $valor['vigor']) || $_POST['vigor'] == ''){
			 
				$periodo  = explode(',', $valor['periodo']);
				$periodo = $periodo[0]." ".html_entity_decode("a&ntilde;os").", ".$periodo[1]." meses";
			
				$tablam.= "<tr>
					<td $clasetd2>".$valor['tipo']."</td>
					<td $clasetd2>".$valor['cod']."</td>
					<td $clasetd2>".$valor['nombre']."</td>
					<td $clasetd2>".$valor['descripcion']."</td>
					<td $clasetd2>".$valor['tipo_doc']."</td>
					<td $clasetd2>".$valor['soporte']."</td>
					<td $clasetd2>".$valor['generado']."</td>
					<td $clasetd2>".$valor['aprobado']."</td>
					<td $clasetd2>".$valor['fecha']."</td>
					<td $clasetd2>".$periodo."</td>
					<td $clasetd2>".$valor['lugar']."</td>
					<td $clasetd2>".siono($valor['vigor'])."</td>
					<td $clasetd2>".siono($valor['interno'])."</td>
				</tr>";
			}
		}
	$tablam .= "</table>";
	
	if($_POST['xls']){
		echo $tabladocs.$tablam;
	}
	
	if($_POST['pdf']){
		
		require(FPDF_PDF_RUTA.'lib/pdftable.inc.php');
		
		$p = new PDFTable('P');
		$p->SetMargins(3,43,0);
		$p->AddPage('L');	
		$p->SetMargins(3,10,0);
		$p->titulo(5,$titulo);
		$p->setfont('Arial','',8);
		$p->SetTitle(date("d-m-Y")."_informe");
		$p->SetFillColor(255,255,255);
		$p->SetTextColor(0,0,0);
		$p->SetDrawColor(0,0,0);
		
		if($_POST['tipodoc']) $p->Cell(0,3,"Tipo de documento: ".$_POST['tipodoc'],0,1);
		else $p->Cell(0,3,"Tipo de documento: TODOS",0,1);
		
		$p->Ln(5);
	
		$p->htmltable($tablam);
		$p->output();
	}
}
else{
	echo "<script>alert('No se puede mostrar el informe. No hay documentos.');</script>";
	echo "<script>window.close();</script>";
}?>
