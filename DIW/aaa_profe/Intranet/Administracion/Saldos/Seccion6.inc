<?php
/**
 * Visualizacion de los Saldos.
 * Autor: César Rodriguez Gonzalez 16/06/2013
*/

// TRADUCCIONES de IDIOMA, para usar un unico Seccion6.inc  español/ingles
if (isset($traducir) && $traducir == 'en') {
	// INGLES
	$idioma = array('Departamento'	=> 'Departament', 
					'Fecha' 		=> 'Date', 
					'Concepto' 		=> 'Concept', 
					'Importe' 		=> 'Amount', 
					'SALDOS' 		=> 'BALANCES',
					'IMPORTE_TOTAL' => 'TOTAL AMOUNT',
					'No_Autorizado'	=> 'You need authorization to continue in this Section',
					'de_descri_es' 	=> 'de_descri_en'
					);
} else {
	// ESPAÑOL
	$idioma = array('Departamento'	=> 'Departameno', 
					'Fecha' 		=> 'Fecha', 
					'Concepto'		=> 'Concepto', 
					'Importe'		=> 'Importe', 
					'SALDOS'		=> 'SALDOS',
					'IMPORTE_TOTAL' => 'IMPORTE TOTAL',
					'No_Autorizado'	=> 'Necesitas Autorizaci&oacute;n para continuar en esta Secci&oacute;n',
					'de_descri_es'	=> 'de_descri_es'
					);		
}



// ACCESO, siempre que el LOGIN este ACTIVO
if (isset($_SESSION['login']) && isset($_SESSION['prueba'])) {
	
	// VARIABLES
	$userCode 			= $_SESSION['prueba'];	// Codigo del usuario logeado
	$sqlDepartamento 		= '';					// Codigo (AND para WHERE) del Select SQL tabla departamentos
	$codDepartamento 	= 'INFOR';					// Siglas del departamento seleccionado desde el formulario, para el usuario ROL
	$ordenar 			= 'Fecha';				// Cual es el que se ordena
	$ordenado 			= ' ORDER BY ';			// ORDER BY para elegir campo a ordenar
	$ordenadoASC_DESC	= ' DESC';				// Orden ASCendente or DESCendente, para ver la lista
	$saldosImporteTotal = 0;					// Cuenta total de los importes
	$realizarAccion	= false;					// Activar la accion cuando proviene del POST, sin efecto F5 refresh
	$tipoAccion			= '';					// valor de la accion que se realizara, recogida del POST


	// SABER A QUE DEPARTAMENTO PERTENECE EL PROFESOR/USUARIO LOGEADO
	// Y SI ES JEFE DE DEPARTAMENTO
	if (!isset($_SESSION['jefeDept'])) {
		
		$sql = "SELECT pr_coddep,". getIdioma('de_descri_es') .", de_jefe
				FROM usuarios, profesores, departamentos
				WHERE us_cuenta = '". $userCode . "'" .
				" AND us_cuenta = pr_cuenta" .
				" AND pr_coddep = de_codigo" .
				" AND pr_codigo = de_jefe";

	/*
		// Verificar Conexion a la DB
		if (!$conexion || !mysql_select_db('basedatos', $conexion))
			die("Error conectando a la BD: " . mysql_error());
	*/

		$res = mysql_query($sql) or die("Error en datos: ".$sql.":". mysql_error());
		$fila = mysql_fetch_array ($res);

		//LOG foreach($fila as $key) echo "***". $key . "***<br>";

		if (!empty($fila)) {
			// SI, consulta SQL es correcta, es Jefe de Departamento
			$_SESSION['jefeDept'] = 'ok';
		}

	// Inicializada, necesario para que evitar doble POST F5
	$_SESSION['postID'] = md5(uniqid(rand(), true));
	}//end SELECT para ver si era Jefe de Departamento	


	// SABER SI ES EL ADMINISTRADOR EL USUARIO LOGEADO
	if (!isset($_SESSION['isAdmin'])) {
		
		$sql = "SELECT us_codrol".
				" FROM usuarios".
				" WHERE us_cuenta = '$userCode'";

		$res = mysql_query($sql) or die("Error en datos: ".$sql.":". mysql_error());
		$fila = mysql_fetch_array ($res);

		//LOG foreach($fila as $key) echo "***". $key . "***<br>";

		// SI la consulta SQL es correcta y el rol adecuado
// Antes de ser modificado por Santiago
//		if (!empty($fila) && $fila['us_codrol'] == 68) {
		if (!empty($fila)) {
			$_SESSION['isAdmin'] = 'ok';
		}

	// Inicializada, necesario para evitar doble POST F5
	$_SESSION['postID'] = md5(uniqid(rand(), true));
	}//end SELECT para ver si era administrador	
?>



<!-- CONTENIDO SALDOS -->
<div id='cuerpo-centro'>
	<h1 id="tituloAdmin"><?php echo getIdioma('SALDOS'); ?></h1>

	<?php
	// JEFE/ADMINISTRADOR AUTORIZADO para VISUALIZAR LOS DATOS
	if ((isset($_SESSION['jefeDept']) && $_SESSION['jefeDept']=='ok')
		|| (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']=='ok')) {		

		// Variable POST del Departamento a visualizar, elegido desde el Formulario
		if (isset($_POST['departamentoFormulario'])) {
			$_SESSION['codDepartamento'] = $_POST['departamentoFormulario'];
		}

		// Siglas seleccionadas del departamento
	   	if (isset($_SESSION['codDepartamento'])) {
	   		$codDepartamento = $_SESSION['codDepartamento'];
	   	}

 		// Codigo para el select de la tabla
 		$sqlDepartamento = ' and de_codigo="' . $codDepartamento . '"';

		/* para ver todos los departamentos
		if ($codDepartamento == 'TODOS') $sqlDepartamento='';
		*/
 		
 		// Variales de session para mantener cual departamento fue seleccionado en el formulario
 		$_SESSION['sqlDepartamento'] = $sqlDepartamento;

		//LOG echo "**DepSel*:*" . $_SESSION['sqlDepartamento'] ."*<br>*codDep:*". $_SESSION['codDepartamento'] . "<br>";
		
 		/* FORMULARIO ROL ADMINISTRADOR, para Seleccionar Departamento*/
		if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']=='ok') {			
			?>
			<!-- FORMULARIO de cual DEPARTAMENTO visualizar -->
			<form name="formularioSeleccion" action="index.php?admsal" method="POST">

			<!-- SELECT DE DEPARTAMENTOS PARA ELEGIR CUAL VISUALIZAR -->
			<select name="departamentoFormulario" size=1 onchange="document.formularioSeleccion.submit()">
			<!-- <option value='TODOS'>TODOS</option> -->
				<?php
				// Departamento que sera visualizado
				if (isset($_SESSION['sqlDepartamento'])) {
					$sqlDepartamento = $_SESSION['sqlDepartamento'];
				}

				$sql = "SELECT de_codigo, ". getIdioma('de_descri_es') ." FROM departamentos ORDER BY de_codigo";
				$res = mysql_query($sql) or die("Error en ".$sql.":". mysql_error());

				while ($dep = mysql_fetch_row ($res)) {
						if ($codDepartamento == $dep[0]) {
							echo ("<OPTION value='$dep[0]' SELECTED>$dep[1]</OPTION>\n");
						} else {
							echo ("<OPTION value='$dep[0]'>$dep[1]</OPTION>\n");
						}
				}//end while

			    echo '</select>
			    	  <noscript><input type="submit" value="Actualizar"></noscript>
			    	  </form>';
			}
			//end <!-- FORMULARIO DE DEPARTAMENTOS -->


		// Valor ID del Post, para evitar el Refresh F5 o reenvios iguales del formulario
		if (isset($_POST['postID'])) {
			
			if (isset($_SESSION['postID']) && $_SESSION['postID'] != $_POST['postID']) {
				$realizarAccion = true;
			}

			$_SESSION['postID'] = $_POST['postID'];
			//LOG echo '**POSTID*' . $_POST['postID'] . '*<br>';
		}

		// Variable POST de por cual Columna sera Ordenado, elegido desde el formularioLista
		if (isset($_POST['accion']) && $realizarAccion) {
			$tipoAccion = $_POST['accion'];
		}

		//LOG echo '**accionGet:*' . $tipoAccion . '*<br>';

		// ASC/DESC ---------------------------------------------------------- ORDER By ASC/DESC --
		if ($tipoAccion != '') {
			$_SESSION['ordenar'] = $tipoAccion;

			// Activado el modo ASC-DESCendente al ser pulsada el mismo campo
			if (isset($_SESSION['ordenarAnterior']) && 
				stristr($_SESSION['ordenarAnterior'], $tipoAccion) && 
				stristr($_SESSION['ordenarAnterior'], 'ASC')) {
				//LOG echo "**orderOld:* ". $_SESSION['ordenarAnterior'] ." ***<br>";echo "**accion:* ". $tipoAccion ." ***<br>";
				$_SESSION['ordenarTipo']=' DESC';
			} else {
				$_SESSION['ordenarTipo']=' ASC';
			}				
		}

		// ORDER BY cuando la accion sea ordenar la fila deseada, por defecto es por fecha
		if (isset($_SESSION['ordenar'])):
			$ordenar  = $_SESSION['ordenar'];	//ejem. Concepto

			switch ($ordenar) {
				case 'Departamento': 	$ordenado.=getIdioma('de_descri_es'); break;
				case 'Fecha': 			$ordenado.='mo_fecha'; 	break;
				case 'Concepto':	 	$ordenado.='mo_concep'; break;
				case 'Importe': 		$ordenado.='mo_import';	break;
				default:				$ordenado.='mo_fecha';
				}

			//LOG echo "*O:**". $ordenar . $_SESSION['ordenarTipo']." ***<br>";

			$ordenadoASC_DESC = $_SESSION['ordenarTipo'];

			$_SESSION['ordenarAnterior'] = $ordenar . $ordenadoASC_DESC;
			$ordenado.=$ordenadoASC_DESC;

		else:
		    $_SESSION['ordenar'] = 'mo_fecha';
			$_SESSION['ordenarTipo'] =' DESC';
			$ordenado = ' ORDER BY mo_fecha DESC';
		endif; //end Ordenar

		//LOG echo "*dep:** ". $sqlDepartamento ." ***";echo "*Order:**". $ordenado ." ***<br>";
		//LOG echo "*orderOld:** ". $_SESSION['ordenarAnterior'] ." ***<br>";echo "*orderTipo:** ". $ordenadoASC_DESC . " *<br>";

		
		// QUERY a la Base de Datos, recogiendo el nombre completo del departamento al que corresponde el saldo
		$sql = "SELECT m.*, de_codigo, ". getIdioma('de_descri_es') . 
				" FROM movimientos m, departamentos" .
				" WHERE mo_coddep=de_codigo" . $sqlDepartamento . $ordenado;

		$res = mysql_query($sql) or die("Error Select a la BD: ".$sql.":". mysql_error());
		?>

		<!-- ELEGIR por cual Columna ORDENAR la TABLA-->
		<form name="formularioLista" action="index.php?admsal" method="POST">

			<!-- TITULOS de la TABLA -->
			<table id="gradient-style">
			    <thead>
			    	<tr>
			            <th scope="col">
							<a href="#" onclick="document.formularioLista.accion.value='Departamento';document.formularioLista.submit()">
								<?php //echo getImagenOrdenado($ordenar, 'Departamento', $ordenadoASC_DESC); ?>		
								<?php echo getIdioma('Departamento'); ?></a></th>

			            <th scope="col" class='sizeFecha'>
							<a href="#" onclick="document.formularioLista.accion.value='Fecha';document.formularioLista.submit()">
								<?php echo getImagenOrdenado($ordenar, 'Fecha', $ordenadoASC_DESC); ?>
								<?php echo getIdioma('Fecha'); ?></a></th>

			            <th scope="col">
							<a href="#" onclick="document.formularioLista.accion.value='Concepto';document.formularioLista.submit()">
								<?php echo getImagenOrdenado($ordenar, 'Concepto', $ordenadoASC_DESC); ?>
								<?php echo getIdioma('Concepto'); ?></a></th>

			            <th scope="col" class='rightTable'>
							<a href="#" onclick="document.formularioLista.accion.value='Importe';document.formularioLista.submit()">
								<?php echo getImagenOrdenado($ordenar, 'Importe', $ordenadoASC_DESC); ?>
								<?php echo getIdioma('Importe'); ?></a></th>

			            <input type="hidden" name="accion" value="">
			            <input type="hidden" name="postID" value="<?php echo md5(uniqid(rand(), true)); ?>">
			        </tr>
			    </thead>


				<!-- RESULTADOS de la CONSULTA DB en CELDAS para el cuerpo de la TABLA -->
				<tbody>
					<?php
					while ($fila = mysql_fetch_array($res)) {
						echo "<tr>";
						echo "<td>". $fila[getIdioma('de_descri_es')] ."</td>";
						echo "<td class='sizeFecha'>{$fila["mo_fecha"]}</td>";
						echo "<td class='sizeAuto'>{$fila["mo_concep"]}</td>";
						echo "<td class='sizeImporte'>{$fila["mo_import"]}</td>";
						echo "</tr>";
						$saldosImporteTotal += $fila["mo_import"];
						}

					echo "<tr id='saldoTotal'>";
					echo "<td colspan='3'>". getIdioma('IMPORTE_TOTAL'). "</td>";
					echo "<td class='rightTable'>{$saldosImporteTotal} €</td>";
					echo "</tr>";
			 		?>    			
				</tbody>
			</table>		
		</form>


		<?php			 
			/*
			 * La función mysql_free_result() es para liberar la memoria
			 * que hemos reservado para gestionar el conjunto de campos devueltos por
			 * la base de datos (que puede ser muy grande según lo que saquemos con la query).
			*/
			mysql_free_result($res);
			mysql_close();

		}//end else Jefe Autorizado
		else {
			msgErrorAutorizacionSeccion();
		}
	 	?>

</div>


<?php
// end Autorizacion
	} else {
		msgErrorAutorizacion();
}// end else Login



/**
 * Segun el tipo de Ordenamiento activo, retorna la imagen relacionada con el Ascendente o Descendente
 * mostrandola en el HEAD de la TABLA, en la CELDA que este siendo ordenada.
 */
function getImagenOrdenado($getCualOrdenar, $getTablaOrdenar, $getTipoOrdenar) {
	$imagenASC	= "<img class='imagenOrdenadoPosicion' src='Comun/imagenes/table-images/arrow-up.png'>";
	$imagenDESC	= "<img class='imagenOrdenadoPosicion' src='Comun/imagenes/table-images/arrow-down.png'>";

	if ($getCualOrdenar == $getTablaOrdenar) {
		if ($getTipoOrdenar == ' DESC') return $imagenDESC; else return $imagenASC;
	} else {
		return '';
	}	
}



/* MENSAJE de ERROR en AUTORIZACION */
function msgErrorAutorizacion() {
		?> 
		<!-- CONTENIDO SALDOS  - AUTORIZACION  ***************** -->
		<div id="cuerpo-centro">
			<h1 id="tituloAdmin"><?php echo getIdioma('SALDOS'); ?></h1>
			<?php msgErrorAutorizacionSeccion() ?>
		</div>
		<?php
}


/* MENSAJE de ERROR en AUTORIZACION - SECCION */
function msgErrorAutorizacionSeccion() {
		?> 
			<h2 id="errorAutorizacion"><?php echo getIdioma('No_Autorizado'); ?><h2>
		<?php
}


// GET del IDIOMA a visualizar
function getIdioma($texto) {
	global $idioma;
	return $idioma[$texto];
}


/**
 * Filtro de Seguridad para evitar ataques XSS (Cross-Site Scripting Attacks) provenientes del POST.
 * Solo se admite máximo 50 caracteres, alfanumericos (No simbolos) excepto, [-,. ]
 * - formularioSeleccion	- Siglas [de_codigo] del Departamento a visualizar (ROL>=DIRECCION) 
 * - formularioLista 		- El Orden de visualización de las columnas "Departamento,Fecha,Concepto,Importe"
 *
function XSS($cadena) {
		return substr( preg_replace('/[^\w\d-,. ]/', "", $cadena), 0, 50);
}
*/
?>
