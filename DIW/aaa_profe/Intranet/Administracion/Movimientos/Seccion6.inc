<?php
/**
 * Gestion de los Movimientos, visualización, modificación y eliminar datos.
 * Autor: César Rodriguez Gonzalez 16/06/2013
*/

// TRADUCCIONES de IDIOMA, para usar un unico Seccion6.inc  español/ingles
if (isset($traducir) && $traducir == 'en') {
	// INGLES
	$idioma = array('Departamento'	=> 'Depart.', 
					'Fecha' 		=> 'Date', 
					'N.Mov' 		=> 'N.Mov', 
					'Concepto' 		=> 'Concept', 
					'Importe' 		=> 'Amount', 
					'MOVIMIENTOS' 	=> 'MOVEMENTS',
					'IMPORTE_TOTAL' => 'TOTAL AMOUNT',
					'No_Autorizado'	=> 'You need authorization to continue in this Section',
					'de_descri_es' 	=> 'de_descri_en'
					);
} else {
	// ESPAÑOL
	$idioma = array('Departamento'	=> 'Depto.', 
					'Fecha' 		=> 'Fecha', 
					'N.Mov' 		=> 'N.Mov', 
					'Concepto'		=> 'Concepto', 
					'Importe'		=> 'Importe', 
					'MOVIMIENTOS'	=> 'MOVIMIENTOS',
					'IMPORTE_TOTAL' => 'IMPORTE TOTAL',
					'No_Autorizado'	=> 'Necesitas Autorizaci&oacute;n para continuar en esta Secci&oacute;n',
					'de_descri_es'	=> 'de_descri_es'
					);		
}


// ACCESO, siempre que el LOGIN este ACTIVO
if (isset($_SESSION['login']) && isset($_SESSION['prueba'])) {

	// VARIABLES
	$userCode 			= $_SESSION['prueba'];		// Codigo del usuario logeado
	$idMovimiento		= '';						// ID del movimiento que vamos a cambiar/borrar
	$sqlDepartamento 	= '';						// Codigo (AND para WHERE) del Select SQL tabla departamentos
	$codDepartamento 	= 'INFOR';					// Siglas del departamento seleccionado desde el formulario
	$ordenar 			= 'Fecha';					// Cual es el que se ordena
	$ordenado 			= ' ORDER BY ';				// ORDER BY para elegir campo a ordenar
	$ordenadoASC_DESC	= ' DESC';					// Orden ASCendente or DESCendente, para ver la lista
	$saldosImporteTotal = 0;						// Cuenta total de los importes
	$realizarAccion		= false;					// Activar la accion cuando proviene del POST, sin efecto F5 refresh
	$tipoAccion			= '';						// valor de la accion que se realizara, recogida del POST



	// SABER SI ES EL ADMINISTRADOR EL USUARIO LOGEADO
	if (!isset($_SESSION['isAdmin'])) {
		
		$sql = "SELECT us_codrol".
				" FROM usuarios".
				" WHERE us_cuenta = '$userCode'";

		$res = mysql_query($sql) or die("Error en datos: ".$sql.":". mysql_error());
		$fila = mysql_fetch_array ($res);

		//LOG foreach($fila as $key) echo "***". $key . "***<br>";

		// SI la consulta SQL es correcta y el rol adecuado
// Antes de ser modificado por Santiago:
//		if (!empty($fila) && $fila['us_codrol'] == 68) {
		if (!empty($fila)) {
			$_SESSION['isAdmin'] = 'ok';
		}

	// Inicializada, necesario para evitar doble POST F5
	$_SESSION['postID'] = md5(uniqid(rand(), true));
	}//end SELECT para ver si era administrador
?>



<!-- CONTENIDO MOVIMIENTOS -->
<div id='cuerpo-centro'>
	<h1 id="tituloAdmin"><?php echo getIdioma('MOVIMIENTOS'); ?></h1>

	<?php
	// ADMINISTRADOR AUTORIZADO para VISUALIZAR LOS DATOS
	if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']=='ok') {

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
		?>


		<!-- FORMULARIO de cual DEPARTAMENTO visualizar -->
		<form name="formularioSeleccion" action="index.php?admmov" method="POST">

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

			//LOG echo '**accionGet:*' . $tipoAccion . '*<br>';

			// DELETE Query --------------------------------------------------------------- DELETE --
			if ($tipoAccion == 'Delete') {
				$idMovimiento = $_POST['mo_id'];

				//LOG echo '**ID_Eliminado*' . $_POST['mo_id'] . '*';

				// SQL para eliminar la fila de datos elegida
				$query = "DELETE FROM movimientos WHERE mo_id = '".$idMovimiento."';";

				//Run query
				$result = mysql_query($query) or die("Error al eliminar: ".$query.":". mysql_error());

			// INSERT Query --------------------------------------------------------------- INSERT --
			} else if ($tipoAccion == 'Guardar') {
				//SQL donde añadimos una nueva fila de datos a la DB
				$query = "INSERT INTO movimientos (mo_coddep, mo_fecha, mo_concep, mo_import, mo_nummov)" .
							" VALUES (
								'".$codDepartamento."', 
								'".$_POST['addFecha']."', 
								'".$_POST['addConcepto']."',
								'".comaReplace($_POST['addImporte'])."',
								'".$_POST['addNumero'] ."'
								);";

				//LOG	echo '**QueryInsert*:*' . $query . '*<br>';

				//Run query
				$result = mysql_query($query) or die("Error al guardar: ".$query.":". mysql_error());

			// UPDATE Query --------------------------------------------------------------- UPDATE --
			} else if ($tipoAccion == 'Update') {

				$auxNombre   = $_POST['nombre'];
				$auxConcepto = $_POST['concepto'];
				$auxId	     = $_POST['mo_id'];

				// Sutitucion de la coma, por el punto. Para simplificar el uso de introducir importes decimales
				if ($auxNombre == 'mo_import') {
					$auxConcepto = comaReplace($auxConcepto);
				}

				// SQL que actualiza un campo concreto de la DB 
				$query = "UPDATE movimientos SET ". $auxNombre ." = '". $auxConcepto ."'".
							" WHERE mo_id = '". $auxId ."'";

				//LOG	echo '**QueryUpdate*:*' . $query . '*<br>';

				//Run query
				$result = mysql_query($query) or die("Error al actualizar: ".$query.":". mysql_error());	
			} else {

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
			}//end tipoAccion

		}

		// ORDER BY para ordenar la fila deseada, por defecto es por fecha
		if (isset($_SESSION['ordenar'])):
			$ordenar  = $_SESSION['ordenar'];	//ejem. Concepto
			
			switch ($ordenar) {
				case 'Departamento':	$ordenado.=getIdioma('de_descri_es');break;
				case 'Fecha':			$ordenado.='mo_fecha';	 	break;
				case 'Numero':			$ordenado.='mo_nummov'; 	break;
				case 'Concepto':		$ordenado.='mo_concep'; 	break;
				case 'Importe':			$ordenado.='mo_import';		break;
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

		
		// QUERY a la Base de Datos, con los movimentos del jefe de departamento
		$sql = "SELECT m.*, de_codigo, ". getIdioma('de_descri_es') . 
				" FROM movimientos m, departamentos" .
				" WHERE mo_coddep=de_codigo" . $sqlDepartamento . $ordenado;

		$res = mysql_query($sql) or die("Error Select a la BD: ".$sql.":". mysql_error());
		?>



		<!-- ELEGIR por cual Columna ORDENAR la TABLA-->
		<form id="movList" name="formularioLista" action="index.php?admmov" method="POST">
			<!-- TITULOS de la TABLA -->
			<table id="gradient-style">
			    <thead>
			    	<tr>
		            <th scope="col">
						<a href="#" onclick="fnOrdenar('Departamento')">
							<?php //echo getImagenOrdenado($ordenar, 'Departamento', $ordenadoASC_DESC); ?>
							<?php echo getIdioma('Departamento'); ?></a></th>

		            <th scope="col" class='sizeFecha'>
						<a href="#" onclick="fnOrdenar('Fecha')">
							<?php echo getImagenOrdenado($ordenar, 'Fecha', $ordenadoASC_DESC); ?>
							<?php echo getIdioma('Fecha'); ?></a></th>

		            <th scope="col" class='rightTable'>
						<a href="#" onclick="fnOrdenar('Numero')">
							<?php echo getImagenOrdenado($ordenar, 'Numero', $ordenadoASC_DESC); ?>
							<?php echo getIdioma('N.Mov'); ?></a></th></a></th>

		            <th scope="col">
						<a href="#" onclick="fnOrdenar('Concepto')">
							<?php echo getImagenOrdenado($ordenar, 'Concepto', $ordenadoASC_DESC); ?>
							<?php echo getIdioma('Concepto'); ?></a></th></a></th>

		            <th scope="col" class='rightTable'>
		            <a href="#" onclick="fnOrdenar('Importe')">							
							<?php echo getImagenOrdenado($ordenar, 'Importe', $ordenadoASC_DESC); ?>
							<?php echo getIdioma('Importe'); ?></a></th></a></th>

						<th scope="col" class='rightTable'><a href="javascript:fnVerOcultar('movAdd')"><img src='Comun/imagenes/table-images/add.png'></a></th>

		            <input type="hidden" name="accion" value="">
		            <input type="hidden" name="nombre" value="">
		            <input type="hidden" name="concepto" value="">
		            <input type="hidden" name="mo_id" value="">
		            <input type="hidden" name="postID" value="<?php echo md5(uniqid(rand(), true)); ?>">
					</tr>
			    </thead>


				<!-- RESULTADOS de la CONSULTA DB en CELDAS para el cuerpo de la TABLA -->
				<tbody>


					<!-- AÑADIR nuevos Movimientos -->			
					<tr id="movAdd" class="movAddOculto">
						<th>A&Ntilde;ADIR</th>
						<th class='sizeFecha'><input type='text' name='addFecha' value='<?php fecha(); ?>'></th>
						<th><input type='text' name='addNumero' value='0' onfocus="this.value=''" class='sizeNumero'></th>
						<th class='sizeAuto'><input type='text' name='addConcepto' onfocus="this.value=''" value='concepto'></th>
						<th><input type='text' name='addImporte' value='0' onfocus="this.value=''" class='sizeImporte'></th>
						<th class='rightTable'>
							<a href="#" onclick="fnAdd()"><img src='Comun/imagenes/table-images/editar.gif'></a>
		 					</a>
		      		</th>
					</tr>


					<?php
					while ($fila = mysql_fetch_array($res)) {
						echo "<tr>";						
						echo "<td>". $fila[getIdioma('de_descri_es')] ."</td>";
						echo "<td class='sizeFecha'><input id='{$fila["mo_id"]}' type='text' name='mo_fecha' value='{$fila["mo_fecha"]}' onchange='fnUpdate(this)'></td>";
						echo "<td><input id='{$fila["mo_id"]}' type='text' name='mo_nummov' value='{$fila["mo_nummov"]}' onchange='fnUpdate(this)' class='sizeNumero'></td>";
						echo "<td class='sizeAuto'><input id='{$fila["mo_id"]}' type='text' name='mo_concep' value='{$fila["mo_concep"]}' onchange='fnUpdate(this)'></td>";
						echo "<td><input id='{$fila["mo_id"]}' type='text' name='mo_import' value='{$fila["mo_import"]}'  onchange='fnUpdate(this)' class='sizeImporte'></td>";
						echo "<td class='rightTable'>								
	 								<a href='#' onclick='fnDelete(\"{$fila["mo_concep"]}\",\"{$fila["mo_id"]}\")'>
	 									<img src='Comun/imagenes/table-images/borrar.gif'>
	 								</a>
            				</td>";
            				
						echo "</tr>";
						$saldosImporteTotal += $fila["mo_import"];
						}

					echo "<tr id='saldoTotal'>";
					echo "<td colspan='4'>IMPORTE TOTAL</td>";
					echo "<td class='rightTable'>{$saldosImporteTotal}</td>";
					echo "<td>€</td>";
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
		}//end else Admin Autorizado
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



/* Retorna la fecha actual, para usarla automaticamente cuando añadimos un nuevo movimiento */
function fecha(){
    // Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
    date_default_timezone_set('UTC');
    //Imprimimos la fecha actual dandole un formato
    echo date("Y-m-d");
}  



/* MENSAJE de ERROR en AUTORIZACION */
function msgErrorAutorizacion() {
	?> 
	<!-- CONTENIDO MOVIMIENTOS  - AUTORIZACION  ***************** -->
	<div id="cuerpo-centro">
		<h1 id="tituloAdmin"><?php echo getIdioma('MOVIMIENTOS'); ?></h1>
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


/* Sutitucion de la coma por el punto, para simplificar el uso de introducir numeros
 * permitiendo, que sea posible introducir 12,30 ó 12.30
 */
function comaReplace($cadena) {
		return preg_replace('/[,]/', ".", $cadena);
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
