<?php

// CARGA DE PÁGINAS WEB DESDE SITIOS EXTERNOS

 /* Opción sin opción (carga de EducaMadrid */
 
    if (!$_SERVER['QUERY_STRING']) 
    {
	    echo '<!DOCTYPE html>
                  <html>
                     <head>
                        <meta http-equiv="refresh" content="0; url=http://www.educa2.madrid.org/web/tiernogalvan">
                     </head>
                     <body>
                     </body>
                   </html>';

    }
	
 /* Opción tictab */
/*
    elseif ($_SERVER['QUERY_STRING'] == 'tictab')
    {
	    echo '<!DOCTYPE html>
                  <html>
                     <head>
                        <meta http-equiv="refresh" content="0; url=http://www.tiernogalvan.es/phpmyadmin">
                     </head>
                     <body>
                     </body>
                   </html>';
    }
*/
    else
// CARGA DE PAGINAS WEB INTERNAS
    {
	echo "
	<!DOCTYPE HTML>
	<html>";

	include 'Comun/Cabecera.inc';

	echo "<body onload=\"changedate('return')\">
	<div id='centro'>";

	include_once ('Comun/Seccion1.inc');
	include_once ('Comun/Seccion2.inc');

// CONTROL DEL ROL DEL USUARIO 
    if (isset($_SESSION['prueba']))
    {
        $roles=mysql_query("select us_codrol from usuarios where us_cuenta='" .
               $_SESSION['prueba']."'");
		
	$obtengoRoles=mysql_fetch_array($roles);
	$rolusuario=$obtengoRoles[0];
    }
    else
    {
        $rolusuario=0;
    }

 /* Opción INICIO - INICIO */
 
    if ($_SERVER['QUERY_STRING'] == 'iniini') 
	{
		if ($rolusuario >= 0)
		{
			include 'Inicio/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";

			include 'Inicio/Seccion5.inc';
			include 'Inicio/Inicio/Seccion6.inc';
			include 'Inicio/Seccion7.inc';
				  
			echo "</div>";
		}
		else
		{
			include 'Inicio/Inicio/Seccion3.inc'; 
			echo "<div id='cuerpo'>";
			include 'Inicio/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Inicio/Seccion7.inc';
			echo '</div>';
		}
	}
	
 /* Opción INICIO - CONTACTAR */ 
 
    elseif ($_SERVER['QUERY_STRING'] == 'inicon') 
	{
		if ($rolusuario >= 0)
		{
			include 'Inicio/Contactar/Seccion3.inc'; 
			echo "<div id='cuerpo'>";

			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Inicio/Contactar/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';

			echo "</div>";
		}
		else
		{
			include 'Inicio/Contactar/Seccion3.inc'; 
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';
		}
	}
	
 /* Opción INICIO - ENSEÑANZAS */   
 
	elseif ($_SERVER['QUERY_STRING'] == 'iniens') 
	{
		if ($rolusuario >= 0)
		{
			include 'Inicio/Ensenanzas/Seccion3.inc';
			
			echo "<div id='cuerpo'>";

			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Inicio/Ensenanzas/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';

			echo "</div>";
		}
		else
		{
			include 'Inicio/Ensenanzas/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';
		}
	}
	
 /* Opción INICIO - SECRETARIA */   
 
	elseif ($_SERVER['QUERY_STRING'] == 'inisec') 
	{
		if ($rolusuario >= 0)
		{
			include 'Inicio/Secretaria/Seccion3.inc';
			echo "<div id='cuerpo'>";

			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Inicio/Secretaria/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';

			echo "</div>";
		}
		else
		{
			include 'Inicio/Secretaria/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';
		}
	}

/* Opción (INICIO) - ERASMUS*/

	elseif ($_SERVER['QUERY_STRING'] == 'erasmus')
        {
           include 'Erasmus/Seccion3.inc';
           echo "<div id='cuerpo'>";
           include 'Erasmus/Seccion5.inc';
           include 'Erasmus/Seccion6.inc';
           include 'Erasmus/Seccion7.inc';
           echo "</div>";
        }

        /*formulario erasmus*/
	elseif ($_SERVER['QUERY_STRING'] == 'era_form') 
	{
		if ($rolusuario >= 0)
		{
			include 'Erasmus/Seccion3.inc';
			echo "<div id='cuerpo'>";

			include 'Erasmus/Seccion5.inc';
			include 'Erasmus/formularioEra.inc';
			include 'Erasmus/Seccion7.inc';

			echo "</div>";
		}
		else
		{
			include 'Erasmus/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';
		}
	}

 /* Opción (INICIO) Periodico */   

        elseif ($_SERVER['QUERY_STRING'] == 'periodico' || (isset($_GET['periodico'])))
	{
		if ($rolusuario >= 0)
		{
			include 'Periodicos/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Periodicos/Inicio/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
		else
		{
			include 'Periodicos/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Periodicos/Inicio/Seccion6_sinedit.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
	}

/* Opción DIRECCION - Inicio */  
	
	elseif ($_SERVER['QUERY_STRING'] == 'dirini' || (isset($_GET['dirini'])))
	{
		if ($rolusuario >= 70)
		{
			include 'Direccion/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Direccion/Inicio/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
		else
		{
			include 'Direccion/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Direccion/Inicio/Seccion6_sinedit.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
	}

  /* Opción DIRECCIÓN - EQUIPO DIRECTIVO */  
	
	elseif ($_SERVER['QUERY_STRING'] == 'direqu') 
	{
		if ($rolusuario >= 0)
		{
			include 'Direccion/EquipoDirectivo/Seccion3.inc';
			echo "<div id='cuerpo'>";

			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Direccion/EquipoDirectivo/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';

			echo "</div>";
		}
		else
		{
			include 'Direccion/EquipoDirectivo/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';			
		}
	}
		
  /* Opción DIRECCIÓN - CONSEJO ESCOLAR */  

	elseif ($_SERVER['QUERY_STRING'] == 'dircon') 
	{
		if ($rolusuario >= 0)
		{
			include 'Direccion/Consejo/Seccion3.inc';
			echo "<div id='cuerpo'>";

			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Direccion/Consejo/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';

			echo "</div>";
		}
		else
		{
			include 'Direccion/Consejo/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';	
		}
	}

/* Opción JEFATURA - Inicio */  
	
	elseif ($_SERVER['QUERY_STRING'] == 'jefini' || (isset($_GET['jefini'])))
	{
		if ($rolusuario >= 70)
		{
			include 'Jefatura/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Jefatura/Inicio/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
		else
		{
			include 'Jefatura/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Jefatura/Inicio/Seccion6_sinedit.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
	}

/* Opción JEFATURA - Documentos */  
	elseif ($_SERVER['QUERY_STRING'] == 'jefdoc' || (isset($_GET['jefdoc']))) 
	{
		if ($rolusuario >= 30)
		{
		if (isset($_SESSION['login']) && ($_SESSION['login']=='ok'))
		{
			
			include 'Jefatura/Documentos/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Jefatura/Documentos/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';  
			echo "</div>";
			
		}
		else
		{
			header("Location: index.php?opcion=login3");
		}
		}
		else
		{
			include 'Jefatura/Documentos/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';				
		}
	}

	/* Opción JEFATURA - Programaciones */  
	
		elseif ($_SERVER['QUERY_STRING'] == 'jefpro') 
		{
		if ($rolusuario >= 30)
		{
			echo '<meta http-equiv="refresh" content="0, url=Jefatura/Seguimiento/index.php ">';
		}
		else	
		{
			include 'Jefatura/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';			
			}
		
		}

	/* Opción JEFATURA - PARTES */  
	
		elseif ($_SERVER['QUERY_STRING'] == 'jefpar') 
	{
		if ($rolusuario >= 65)
		{
		echo "<div id='cuerpo'>";
		include 'Jefatura/Partes/Seccion6.inc';
		echo "</div>"; 
		}
		else
		{
			include 'Jefatura/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';				
		}
	}
	/* Opción JEFATURA - SUBIR ACTA */  
	elseif ($_SERVER['QUERY_STRING'] == 'jefactsub') 
	{
		if ($rolusuario == 60)
		{
		include 'actas/Subir_Acta/Seccion3.inc';
		echo "<div id='cuerpo'>";

		include 'Comun/Seccion_5/Seccion5.inc';
		include 'actas/Subir_Acta/Subir.inc';
		include 'Comun/Seccion_7/Seccion7.inc';

		echo "</div>";
		}
		else
		{
			include 'Jefatura/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';				
		}
	}
	/* Opción JEFATURA - Consultar ACTA */  
	elseif ($_SERVER['QUERY_STRING'] == 'jefactcon') 
	{
		if ($rolusuario >= 30)
		{
		include 'actas/Consultar_Acta/Seccion3.inc';
		echo "<div id='cuerpo'>";

		include 'Comun/Seccion_5/Seccion5.inc';
		include 'actas/Consultar_Acta/Consultar.inc';
		include 'Comun/Seccion_7/Seccion7.inc';

		echo "</div>";
		}
		else
		{
			include 'Jefatura/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';				
		}
	}

/* Opción ADMINISTRACION - Inicio */  
	
	elseif ($_SERVER['QUERY_STRING'] == 'admini' || (isset($_GET['admini'])))
	{
		if ($rolusuario >= 68)
		{
			include 'Administracion/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Administracion/Inicio/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
		else
		{
			include 'Administracion/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Administracion/Inicio/Seccion6_sinedit.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
	}

/* Opción ADMINISTRACIÓN - SALDOS */  
	
	elseif ($_SERVER['QUERY_STRING'] == 'admsal') 
	{
		if ($rolusuario >= 30)
		{
			include 'Administracion/Saldos/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Administracion/Saldos/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';

			echo "</div>";
		}
		else
		{
			include 'Administracion/Saldos/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';
		}
	}
	
  /* Opción ADMINISTRACIÓN - MOVIMIENTOS */  
	
	elseif ($_SERVER['QUERY_STRING'] == 'admmov') 
	{
		if ($rolusuario >= 68)
		{
			include 'Administracion/Movimientos/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Administracion/Movimientos/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';

			echo "</div>";
		}
		else
		{
			include 'Administracion/Movimientos/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';
		}
	}
	
  /* Opción ADMINISTRACIÓN - DIETAS */  
	
	elseif ($_SERVER['QUERY_STRING'] == 'admdie') 
	{
		if ($rolusuario >= 0)
		{
			include 'Administracion/Dietas/Seccion3.inc';
			echo "<div id='cuerpo'>";

			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Administracion/Dietas/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';

			echo "</div>";
		}
		else
		{
			include 'Administracion/Dietas/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';
		}
	}
/* Opción DEPARTAMENTOS - INICIO */  
	
	elseif ($_SERVER['QUERY_STRING'] == 'dep' || (isset($_GET['dep']))) 
	{
		if ($rolusuario >= 60)
		{
			include 'Departamentos/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Departamentos/Inicio/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
		elseif ($rolusuario >= 0)
		{
			include 'Departamentos/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Departamentos/Inicio/Seccion6_sinedit.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
		else
		{
			include 'Departamentos/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';			
		}
	}

/* Opción ALUMNOS - Inicio */  
	
	elseif ($_SERVER['QUERY_STRING'] == 'alu' || (isset($_GET['alu'])))
	{
		if ($rolusuario == 28)
		{
			include 'Alumnos/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Alumnos/Inicio/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
		else
		{
			include 'Alumnos/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Alumnos/Inicio/Seccion6_sinedit.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
	}

/* Opción ALUMNOS - Diseños web */
  
	elseif ($_SERVER['QUERY_STRING'] == 'aludis' || (isset($_GET['aludis']))) 
	{
		if ($rolusuario >= 0)
		{
			include 'Alumnos/Disenos/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Alumnos/Disenos/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';  
			echo "</div>";
			
		}
		else
		{
			include 'Alumnos/Documentos/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';				
		}
	}

/* Opción AMPA - Inicio */  
	
	elseif ($_SERVER['QUERY_STRING'] == 'ampini' || (isset($_GET['ampini'])))
	{
		if ($rolusuario == 14)
		{
			include 'Ampa/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Ampa/Inicio/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
		else
		{
			include 'Ampa/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Ampa/Inicio/Seccion6_sinedit.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
	}
	
/* Opción AMPA - Gestionar socios - Inicio*/  
	
	elseif ($_SERVER['QUERY_STRING'] == 'ampsocges' || (isset($_GET['ampsocges'])))
	{
		if ($rolusuario == 14)
		{
			include 'Ampa/GestionarSocios/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Ampa/GestionarSocios/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
		else
		{
			include 'Ampa/GestionarSocios/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
	}
	
/* Opción AMPA - Gestionar socios - Alta socios*/  
	
	elseif ($_SERVER['QUERY_STRING'] == 'ampsocgesalta' || (isset($_GET['ampsocgesalta'])))
	{
		if ($rolusuario == 14)
		{
			include 'Ampa/GestionarSocios/AltaSocio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Ampa/GestionarSocios/AltaSocio/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
		else
		{
			include 'Ampa/GestionarSocios/AltaSocio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
	}
	
/* Opción AMPA - Gestionar socios - Buscar socios*/  
	
	elseif ($_SERVER['QUERY_STRING'] == 'ampsocgesbusqueda' || (isset($_GET['ampsocgesbusqueda'])))
	{
		if ($rolusuario == 14)
		{
			include 'Ampa/GestionarSocios/BuscarSocio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Ampa/GestionarSocios/BuscarSocio/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
		else
		{
			include 'Ampa/GestionarSocios/BuscarSocio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
	}
	
/* Opción AMPA - Gestionar socios - Pagar cuota */  
	
	elseif ($_SERVER['QUERY_STRING'] == 'ampsocgespagar' || (isset($_GET['ampsocgespagar'])))
	{
		if ($rolusuario == 14)
		{
			include 'Ampa/GestionarSocios/PagarCuota/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Ampa/GestionarSocios/PagarCuota/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
		else
		{
			include 'Ampa/GestionarSocios/PagarCuota/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
	}
	
/* Opción TIC - INICIO */ 
	
	elseif ($_SERVER['QUERY_STRING'] == 'ticini' || (isset($_GET['ticini']))) 
	{
		if ($rolusuario >= 0)
		{
			if (isset($_SESSION['login']) && ($_SESSION['login']=='ok'))
			{
				
					include 'Tic/Inicio/Seccion3.inc';
					echo "<div id='cuerpo'>";
					include 'Comun/Seccion_5/Seccion5.inc';
					include 'Tic/Inicio/Seccion6.inc';
					include 'Comun/Seccion_7/Seccion7.inc';
						  
					echo "</div>";
			}
			else
			{
				header("Location: index.php?opcion=login3");
			}
		}
		else
		{
			include 'Tic/Inicio/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';	
		}
		
	}

/* Opción TIC - Recursos y condiciones de uso */  
	
	elseif ($_SERVER['QUERY_STRING'] == 'ticrec') 
	{
		if ($rolusuario >= 0)
		{
			include 'Tic/Condiciones/Seccion3.inc';
			echo "<div id='cuerpo'>";

			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Tic/Condiciones/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		}
		else
		{
			include 'Tic/Condiciones/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';				
		}
	}
//Tic Tablas
	elseif ($_SERVER['QUERY_STRING'] == 'tictab' || (isset($_GET['tictab']))) 
	{
               if ($rolusuario >= 68)
		{
		   if (isset($_SESSION['login']) && ($_SESSION['login']=='ok'))
		       {
			include 'Tic/Tablas/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			include 'Tic/Tablas/Seccion6.inc';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo "</div>";
		       }
		     else
		       {
			header("Location: index.php?opcion=login3");
		       }
		}
		else
		{
			include 'Tic/Tablas/Seccion3.inc'; 
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';	
		}
	}

// Opción bolsa - trabajo 
 
	elseif ($_SERVER['QUERY_STRING'] == 'bolsa') 
	{
		include 'Inicio/Inicio/Seccion3.inc';
		echo "<div id='cuerpo'>";

		include 'Comun/Seccion_5/Seccion5.inc';
		include 'BolsaTrabajo/Index.inc';
		include 'Comun/Seccion_7/Seccion7.inc';
			  
		echo "</div>";
	}
	
	elseif ($_SERVER['QUERY_STRING'] == 'boferta') 
	{
		include 'Inicio/Inicio/Seccion3.inc';
		echo "<div id='cuerpo'>";

		include 'Comun/Seccion_5/Seccion5.inc';
		include 'BolsaTrabajo/Empresa/borrarOferta/boroferta.inc';
		include 'Comun/Seccion_7/Seccion7.inc';
			  
		echo "</div>";
	}
	
	elseif ($_SERVER['QUERY_STRING'] == 'ofertas') 
	{
		include 'Inicio/Inicio/Seccion3.inc';
		echo "<div id='cuerpo'>";

		include 'Comun/Seccion_5/Seccion5.inc';
		include 'BolsaTrabajo/Empresa/guardarOferta/ofertas.inc';
		include 'Comun/Seccion_7/Seccion7.inc';
			  
		echo "</div>";
	}
	
	elseif ($_SERVER['QUERY_STRING'] == 'curriculum') 
	{
		include 'Inicio/Inicio/Seccion3.inc';
		echo "<div id='cuerpo'>";

		include 'Comun/Seccion_5/Seccion5.inc';
		include 'BolsaTrabajo/Alumno/guardarCurriculum/curriculum.inc';
		include 'Comun/Seccion_7/Seccion7.inc';
			  
		echo "</div>";
	}
	
		elseif ($_SERVER['QUERY_STRING'] == 'inscribirse') 
	{
		include 'Inicio/Inicio/Seccion3.inc';
		echo "<div id='cuerpo'>";

		include 'Comun/Seccion_5/Seccion5.inc';
		include 'BolsaTrabajo/Alumno/Inscribirse/inscribirse.inc';
		include 'Comun/Seccion_7/Seccion7.inc';
			  
		echo "</div>";
	}
	
		elseif ($_SERVER['QUERY_STRING'] == 'curricula') 
	{
		include 'Inicio/Inicio/Seccion3.inc';
		echo "<div id='cuerpo'>";

		include 'Comun/Seccion_5/Seccion5.inc';
		include 'Inicio/curricula.inc';
		include 'Comun/Seccion_7/Seccion7.inc';
			  
		echo "</div>";
	}
	
		elseif ($_SERVER['QUERY_STRING'] == 'vofertas') 
	{
		include 'Inicio/Inicio/Seccion3.inc';
		echo "<div id='cuerpo'>";

		include 'Comun/Seccion_5/Seccion5.inc';
		include 'BolsaTrabajo/Alumno/listarOfertas/verofertas.inc';
		include 'Comun/Seccion_7/Seccion7.inc';
			  
		echo "</div>";
		
	}
	
			elseif ($_SERVER['QUERY_STRING'] == 'borCurriculum') 
	{
		include 'Inicio/Inicio/Seccion3.inc';
		echo "<div id='cuerpo'>";

		include 'Comun/Seccion_5/Seccion5.inc';
		include 'BolsaTrabajo/Alumno/borrarCurriculum/borCurriculum.inc';
		include 'Comun/Seccion_7/Seccion7.inc';
			  
		echo "</div>";
	}
	
	elseif ($_SERVER['QUERY_STRING'] == 'listarcurriculum') 
	{
		include 'Inicio/Inicio/Seccion3.inc';
		echo "<div id='cuerpo'>";

		include 'Comun/Seccion_5/Seccion5.inc';
		include 'BolsaTrabajo/Empresa/verCurriculum/listarcurriculum.inc';
		include 'Comun/Seccion_7/Seccion7.inc';
			  
		echo "</div>";
	}
	
	elseif ($_SERVER['QUERY_STRING'] == 'opccurriculum') 
	{
		include 'Inicio/Inicio/Seccion3.inc';
		echo "<div id='cuerpo'>";

		include 'Comun/Seccion_5/Seccion5.inc';
		include 'BolsaTrabajo/Alumno/guardarCurriculum/opccurriculum.php';
		include 'Comun/Seccion_7/Seccion7.inc';
			  
		echo "</div>";
	}
	
		elseif ($_SERVER['QUERY_STRING'] == 'opcofertas') 
	{
		include 'Inicio/Inicio/Seccion3.inc';
		echo "<div id='cuerpo'>";

		include 'Comun/Seccion_5/Seccion5.inc';
		include 'BolsaTrabajo/Empresa/guardarOferta/opcofertas.php';
		include 'Comun/Seccion_7/Seccion7.inc';
			  
		echo "</div>";
	}
		
		elseif ($_SERVER['QUERY_STRING'] == 'opccurriculumbd') 
	{
		include 'Inicio/Inicio/Seccion3.inc';
		echo "<div id='cuerpo'>";

		include 'Comun/Seccion_5/Seccion5.inc';
		include 'BolsaTrabajo/Alumno/guardarCurriculum/opccurriculumbd.inc';
		include 'Comun/Seccion_7/Seccion7.inc';
			  
		echo "</div>";
	}
		
		elseif ($_SERVER['QUERY_STRING'] == 'opccurriculumdoc') 
	{
		include 'Inicio/Inicio/Seccion3.inc';
		echo "<div id='cuerpo'>";

		include 'Comun/Seccion_5/Seccion5.inc';
		include 'BolsaTrabajo/Alumno/guardarCurriculum/opccurriculumdoc.inc';
		include 'Comun/Seccion_7/Seccion7.inc';
			  
		echo "</div>";
	}
	
			elseif ($_SERVER['QUERY_STRING'] == 'opcofertabd') 
	{
		include 'Inicio/Inicio/Seccion3.inc';
		echo "<div id='cuerpo'>";

		include 'Comun/Seccion_5/Seccion5.inc';
		include 'BolsaTrabajo/Empresa/guardarOferta/opcofertabd.inc';
		include 'Comun/Seccion_7/Seccion7.inc';
			  
		echo "</div>";
	}
		
		elseif ($_SERVER['QUERY_STRING'] == 'opcofertadoc') 
	{
		include 'Inicio/Inicio/Seccion3.inc';
		echo "<div id='cuerpo'>";

		include 'Comun/Seccion_5/Seccion5.inc';
		include 'BolsaTrabajo/Empresa/guardarOferta/opcofertadoc.inc';
		include 'Comun/Seccion_7/Seccion7.inc';
			  
		echo "</div>";
	}

/* Opción MULTIMEDIA  - IMÁGENES */  
	
	elseif ($_SERVER['QUERY_STRING'] == 'multimg')
	{
		if ($rolusuario >= 0)
		{
			include 'Multimedia/Imagenes/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Multimedia/Imagenes/Seccion6.inc';
			echo "</div>";
		}
		else
		{
			include 'Multimedia/Imagenes/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';	
		}
	}

/* Opción MULTIMEDIA - VÍDEOS */  
	
	elseif ($_SERVER['QUERY_STRING'] == 'multivid') 
	{
		if ($rolusuario >= 0)
		{
			include 'Multimedia/Videos/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Multimedia/Videos/Seccion6.inc';
			echo "</div>";
		}
		else
		{
			include 'Multimedia/Videos/Seccion3.inc';
			echo "<div id='cuerpo'>";
			include 'Comun/Seccion_5/Seccion5.inc';
			echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
			include 'Comun/Seccion_7/Seccion7.inc';
			echo '</div>';	
		}
	}
	
/* Opción MULTIMEDIA - GESTIÓN IMÁGENES */  
	
		elseif ($_SERVER['QUERY_STRING'] == 'multigesimg') 
		{
			if ($rolusuario >= 30)
			{
				include 'Multimedia/Gestion/GestionImagenes/Seccion3.inc';
				echo "<div id='cuerpo'>";
				include 'Comun/Seccion_5/Seccion5.inc';
				include 'Multimedia/Gestion/GestionImagenes/Seccion6.inc';
				include 'Comun/Seccion_7/Seccion7.inc';
				echo '</div>';	
			}
			else
			{
				include 'Multimedia/Gestion/GestionImagenes/Seccion3.inc';
				echo "<div id='cuerpo'>";
				include 'Comun/Seccion_5/Seccion5.inc';
				echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
				echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
				include 'Comun/Seccion_7/Seccion7.inc';
				echo '</div>';	
			}
		}

/* Opción MULTIMEDIA - GESTIÓN VÍDEOS */  
	
		elseif ($_SERVER['QUERY_STRING'] == 'multigesvid') 
		{
			if ($rolusuario >= 30)
			{
				include 'Multimedia/Gestion/GestionVideos/Seccion3.inc';
				echo "<div id='cuerpo'>";
				include 'Comun/Seccion_5/Seccion5.inc';
				include 'Multimedia/Gestion/GestionVideos/Seccion6.inc';
				include 'Comun/Seccion_7/Seccion7.inc';
				echo '</div>';	
			}
			else
			{
				include 'Multimedia/Gestion/GestionIVideos/Seccion3.inc';
				echo "<div id='cuerpo'>";
				include 'Comun/Seccion_5/Seccion5.inc';
				echo '<div id="cuerpo-centro"> No tiene los suficientes privilegios para entrar a esta zona</div>';
				echo '<meta http-equiv="refresh" content="3;url=index.php"> ';
				include 'Comun/Seccion_7/Seccion7.inc';
				echo '</div>';	
			}
		}

/* FIN OPCIONES */     

        include_once ('Comun/Seccion8.inc');

	echo "</div>
	</body>
	</html> ";
    }
?>
