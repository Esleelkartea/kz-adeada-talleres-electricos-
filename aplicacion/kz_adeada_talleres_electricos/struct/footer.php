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
</div>
			<div id="pie">
				<ul>
                	<li>
                		<form action='index.php' method='post' id='menu_inicio' >
							<a accesskey="1" style="cursor:pointer;" onclick="$('menu_inicio').submit();">Inicio</a>
							<input type='hidden' name='pag' value='../commons/welcome' />
						</form>
                	</li>   	
                    <li>
                    	<form action='index.php' method='post' id='menu_accesibilidad' >
							<a accesskey="0" style="cursor:pointer;" onclick="$('menu_accesibilidad').submit();">Accesibilidad</a>
							<input type='hidden' name='pag' value='../commons/accesibilidad' />
						</form>
                  	</li>             	
                    <li>
                    	<form action='index.php' method='post' id='menu_privacidad' >
							<a accesskey="4" style="cursor:pointer;" onclick="$('menu_privacidad').submit();">Privacidad</a>
							<input type='hidden' name='pag' value='../commons/privacidad' />
						</form>
                    </li>               	
                    <li>
                    	<form action='index.php' method='post' id='menu_contacto' >
							<a accesskey="3" style="cursor:pointer;" onclick="$('menu_contacto').submit();">Contacto</a>
							<input type='hidden' name='pag' value='../commons/contacto' />
						</form>
                   </li>                	
                    <li>
                    	<?php if(in_array(221,$datos_perfil['PERMISOS'])){?>
							<a accesskey="5" style="cursor:pointer;" href="../documentos/manual_usuario_administrador.pdf" target="_blank" title="Esta acci&oacute;n abrir&aacute; una nueva pesta&ntilde;a o ventana">Manual</a>
						<?php }else{?>
							<a accesskey="5" style="cursor:pointer;" href="../documentos/manual_usuario.pdf" target="_blank" title="Esta acci&oacute;n abrir&aacute; una nueva pesta&ntilde;a o ventana">Manual</a>
						<?php }?>
				</ul>
                
                <div id="copyright">
                    <p>Aplicaci&oacute;n Adeada Talleres El&eacute;ctricos | Adeada <abbr lang="es" title="Tel&eacute;fono">Tel.</abbr> 945 25 33 88 | adeada@adeada.com</p>
            	</div>
                
                <div id="patrocinio">
                	<img class="adeada" src="../img/general/adeada.jpg" alt="Adeada" />
                    <img src="../img/general/logo_spri.jpg" alt="Spri" />
                </div>
                
                <div class="clear"> </div>
            </div>
		</div>
	</body>
</html>