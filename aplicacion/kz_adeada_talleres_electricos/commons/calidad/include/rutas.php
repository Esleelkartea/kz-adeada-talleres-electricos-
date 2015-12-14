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

//Definicion de la ruta raiz de la aplicacion
define("RAIZ", $_SERVER["DOCUMENT_ROOT"]."/kz_adeada_talleres_electricos/commons/calidad/");

//Ruta de la aplicacion

define("RUTA_APLICACION", "http://localhost/kz_adeada_talleres_electricos");

//Definicion de la cantidad de registros a mostrar por pagina
define("PERSONAS_MOSTRAR","10");

//Definicion de la ruta raiz de la libreria del calendario
define("CAL_RUTA_NIVEL1","../../../librerias/cal_kz_adeada_talleres_electricos/");

//Definicion de la ruta raiz de la libreria para el envio de emails
define("EMAIL_RUTA","../../librerias/mail/");

//Definicion de la ruta raiz de la libreria js
define('JS_RUTA_NIVEL1','../../../librerias/js/');

//Definicion de la ruta raiz de la libreria para los PDFs
define('FPDF_FONTPATH','../../../librerias/fpdf_kz_adeada_talleres_electricos/font/');
define('FPDF_PDF_RUTA','../../../librerias/fpdf_kz_adeada_talleres_electricos/pdf/');
?>