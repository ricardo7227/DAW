<?php

/**
 
 * $Id: jFileBrowser, 2010.
 * @author Juaniquillo
 * @copyright Copyright © 2010, Victor Sanchez (Juaniquillo).
 * @email juaniquillo@gmail.com
 * @website http://juaniquillo.com

 */

$validacion = isset($_POST['validacion']) ? $_POST['validacion'] : null ;
$sub_validacion = isset($_POST['sub_validacion']) ? $_POST['sub_validacion'] : null ;

//validaciones
if (isset($validacion) && !empty($validacion)) {
	
	include('mensajes.inc.php');
	//recogiendo los valores del form
	
	$usuario_val_1 = trim(isset($_POST['usuario'])) ? trim($_POST['usuario']) : null;
	$nombre_val_1 = trim(isset($_POST['nombre'])) ? trim($_POST['nombre']) : null;
	$id_val_1 = trim(isset($_POST['id'])) ? trim($_POST['id']) : null;
	$valor_val_1 = trim(isset($_POST['value'])) ? trim($_POST['value']) : null;
	$pwd_val_1 = trim(isset($_POST['contrasena'])) ? trim($_POST['contrasena']) : null;
	$pwd2_val_1 = trim(isset($_POST['contrasena2'])) ? trim($_POST['contrasena2']) : null;
	$email_val_1 = trim(isset($_POST['email'])) ? trim($_POST['email']) : null;
	$email2_val_1 = trim(isset($_POST['email2'])) ? trim($_POST['email2']) : null;
	$apellido_val_1 = trim(isset($_POST['apellido'])) ? trim($_POST['apellido']) : null;
	$pueblo_id_val_1 = isset($_POST['enviar_web']) ? $_POST['enviar_web'] : null;
	$categoria_val_1 = isset($_POST['categoria']) ? $_POST['categoria'] : null;
	$categoria2_val_1 = isset($_POST['categoria2']) ? $_POST['categoria2'] : null;
	$direccion1_val_1 = trim(isset($_POST['direccion1'])) ? trim($_POST['direccion1']) : null;
	$direccion2_val_1 = trim(isset($_POST['direccion2'])) ? trim($_POST['direccion2']) : null;
	$pueblo2_id_val_1 = isset($_POST['pueblo2']) ? $_POST['pueblo2'] : null;
	$zip_val_1 = trim(isset($_POST['zip'])) ? trim($_POST['zip']) : null;
	$telefono_val_1 = trim(isset($_POST['telefono'])) ? trim($_POST['telefono']) : null;
	$telefono2_val_1 = trim(isset($_POST['telefono2'])) ? trim($_POST['telefono2']) : null;
	$fax_val_1 = trim(isset($_POST['fax'])) ? trim($_POST['fax']) : null;
	$descripcion_val_1 = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
	$descripcion_info_val_1 = isset($_POST['descripcion_info']) ? $_POST['descripcion_info'] : null;
	$descripcion_pag_val_1 = isset($_POST['descripcion_pag']) ? $_POST['descripcion_pag'] : null;
	$anuncio_val_1 = isset($_POST['anuncio_editable_ta']) ? $_POST['anuncio_editable_ta'] : null;
	$id_anuncio_val_1 = trim(isset($_POST['id_anuncio'])) ? trim($_POST['id_anuncio']) : null;
	$disponible_val_1 = isset($_POST['disponible']) ? $_POST['disponible'] : null;
	$web_val_1 = isset($_POST['web']) ? $_POST['web'] : null;
	$enviar_web_val_1 = isset($_POST['enviar_web']) ? $_POST['enviar_web'] : null;
	$orden_val_1 = isset($_POST['orden']) ? $_POST['orden'] : null;
	$anunciante_val_1 = isset($_POST['anunciante']) ? $_POST['anunciante'] : null;
	$nivel_val_1 = isset($_POST['nivel']) ? $_POST['nivel'] : null;
	$areal_val_1 = isset($_POST['area']) ? $_POST['area'] : null;
	$activo_val_1 = isset($_POST['activo']) ? $_POST['activo'] : null;
	$publico_val_1 = isset($_POST['publico']) ? $_POST['publico'] : null;
	$costum_val_1 = isset($_POST['costum']) ? $_POST['costum'] : null;
	$meta_val_1 = isset($_POST['meta']) ? $_POST['meta'] : null;
	$domain_val_1 = isset($_POST['domain']) ? $_POST['domain'] : null;
	$domain_seguro_val_1 = isset($_POST['domain_seguro']) ? $_POST['domain_seguro'] : null;
	$anio_comienzo_val_1 = isset($_POST['anio_comienzo']) ? $_POST['anio_comienzo'] : null;
	$nombre_dueno_val_1 = isset($_POST['nombre_dueno']) ? $_POST['nombre_dueno'] : null;
	$direccion_dueno_val_1 = isset($_POST['direccion_dueno']) ? $_POST['direccion_dueno'] : null;
	$archivo_costum_val_1 = isset($_POST['archivo_costum']) ? $_POST['archivo_costum'] : null;
	$codigo_val_1 = isset($_POST['codigo']) ? $_POST['codigo'] : null;
	$precio_val_1 = isset($_POST['precio']) ? $_POST['precio'] : null;
	$precio2_val_1 = isset($_POST['precio2']) ? $_POST['precio2'] : null;
	$descuento_val_1 = isset($_POST['descuento']) ? $_POST['descuento'] : null;
	$descuento2_val_1 = isset($_POST['descuento2']) ? $_POST['descuento2'] : null;
	$stock_val_1 = isset($_POST['stock']) ? $_POST['stock'] : null;
	$producto_val_1 = isset($_POST['producto']) ? $_POST['producto'] : null;
	$contenido_val_1 = isset($_POST['contenido']) ? $_POST['contenido'] : null;
	$select_cont_val_1 = isset($_POST['select_cont']) ? $_POST['select_cont'] : null;
	$select_mod_val_1 = isset($_POST['select_mod']) ? $_POST['select_mod'] : null;
	$html_mode_val_1 = isset($_POST['html_mode']) ? $_POST['html_mode'] : null;
	$script_val_1 = isset($_POST['script']) ? $_POST['script'] : null;
	$orden_val_1 = isset($_POST['ordenar1']) ? $_POST['ordenar1'] : null;
	$peso_val_1 = isset($_POST['peso']) ? $_POST['peso'] : null;
	$estilos_val_1 = isset($_POST['estilos']) ? $_POST['estilos'] : null;
	$button_ml = isset($_POST['button_ml']) ? $_POST['button_ml'] : null;
	$tipo_cat_val_1 = isset($_POST['tipo_cat']) ? $_POST['tipo_cat'] : null;
	$content_pos_val_1 = isset($_POST['content_pos']) ? $_POST['content_pos'] : null;
	$email_gen_usar_val_1 = isset($_POST['email_gen_usar']) ? $_POST['email_gen_usar'] : null;
	$titulo_val_1 = isset($_POST['titulo']) ? $_POST['titulo'] : null;
	$disclaimer_val_1 = isset($_POST['disclaimer']) ? $_POST['disclaimer'] : null;
	$sub_padre_val_1 = isset($_POST['sub-padre']) ? $_POST['sub-padre'] : null;
	$sub_nivel_val_1 = isset($_POST['sub-nivel']) ? $_POST['sub-nivel'] : null;
	$disponible_car_val_1 = isset($_POST['disponible_car']) ? $_POST['disponible_car'] : null;
	$en_menu_val_1 = trim(isset($_POST['en_menu'])) ? trim($_POST['en_menu']) : null;
	$att_grupo_val_1 = isset($_POST['att_grupo']) ? $_POST['att_grupo'] : null;
	$att_indiv_val_1 = isset($_POST['att_indiv']) ? $_POST['att_indiv'] : null;
	$id_cat_val_1 = isset($_POST['id_cat']) ? $_POST['id_cat'] : null;
	$ajax_val_1 = isset($_POST['ajax']) ? $_POST['ajax'] : null;
	$cantidad_val_1 = isset($_POST['cantidad']) ? $_POST['cantidad'] : null;
	$shipping_val_1 = isset($_POST['shipping']) ? $_POST['shipping'] : null;
	$descripcion_email_val_1 = isset($_POST['descripcion_email']) ? $_POST['descripcion_email'] : null;
	
	$imagen_val_1 = isset($_FILES['imagen']['tmp_name']);
	$borrar_imagen_val_1 = isset($_POST['borrar_imagen']);
	
	$archivo_val_1 = isset($_FILES['archivo']['tmp_name']);
	
	//array de tipos de imagenes y archivos
	//$get_imag = array('1' => 'gif', '2' => 'jpg', '3' => 'png');
	//$get_archiv = array('1' => 'pdf', '2' => 'doc', '3' => 'docx', '4' => 'xls', '5' => 'xlsx', '6' => 'ppt', '7' => 'pptx');
	$get_archiv_img = array('pdf', 'doc', 'docx', 'xls','xlsx','ppt', 'pptx', 'gif', 'jpg', 'txt', 'jpeg', 'png');
	
	$header_generico = 'Location: home.php?mostrar='.isset($mostrar).'&sub='.isset($sub_secc).'&id='.isset($id).'&modulo='.isset($modulo).'&id2='.isset($id2).'';
	
	//expresiones regulares
	$lat = "a-zA-ZÁÉÍÓÚáéíóú"; //caracteres latinos alfanumricos
	$lat2 = "a-zA-Z0-9_-"; //caracteres latinos alfanumricos con guion
	$lat3 = "0-9"; //numeros del 0 al 9
	$lat4 = "0-9 ()-"; //numeros del 0 al 9 mas parentisis, guion y espacio
	$lat5 = "a-zA-Z -_"; //caracteres latinos alfanumricos con guion y espacio
	$lat6 = "a-zA-Z_-"; //caracteres latinos alfanumricos con guion
	$lat7 = "a-zA-Z0-9 _-"; //caracteres latinos alfanumricos con guion y espacio
	
	switch($validacion){
		//crear categoria
		case 1:{
			if(strlen($nombre_val_1) > 50) $mensaje_err .= $mensaje_glob_v[2];
			$mensaje_err .= $mensaje_glob_v[validarReq($nombre_val_1, 1)];
			//$mensaje_err .= $mensaje_glob_v[validarReq($activo_val_1, 80)];
			//$mensaje_err .= $mensaje_glob_v[validarReq($tipo_cat_val_1, 11)];
			
			if(empty($mensaje_err)) {
				$insert_nom = GetSQLValueString($nombre_val_1, "text");
				//$insert_descrip_lar = GetSQLValueString($descrip_larg_val_1, "text");
				$tipo_cat_nom = GetSQLValueString($tipo_cat_val_1, "int");
				$activo_cat = GetSQLValueString($activo_val_1, "int");
				$insert_date = GetSQLValueString($fecha_act, "date");
				$insert_usu = GetSQLValueString($usuario_nombre, "text");
				$insert_padre = GetSQLValueString($sub_padre_val_1, "int");
				$insert_nivel = GetSQLValueString($sub_nivel_val_1, "int");
				
				$campos_cat = 'tipo_cat, name_cat, status_cat, fecha_cat, usu_cat';
				$valores_cat = "$tipo_cat_nom, $insert_nom, 1, $insert_date, $insert_usu";
				
				if(InsertarInfo('categorias', $campos_cat, $valores_cat, $sql_db, $conexion_gal)) $mensaje_err = $mensaje_glob_v[11];
				header('Location: filebrowser.php');
			}
		}
		break;
		//borrar categoria
		case 2:{
			$mensaje_err .= $mensaje_glob_v[validarReq($id_val_1, 11)];
			
			if(empty($mensaje_err)) {
				$insert_id = GetSQLValueString($id_val_1, "int");
				//exit;
				$query_img = SeleccionarInfo('archivos', '*', $sql_db, $conexion_gal, TRUE, "categoria_archivos = $insert_id");
				$num_img = NumerodeCampos($query_img);
				//exit;
				$query_rs_contenido2 = "DELETE FROM categorias WHERE cat_id_cat = $insert_id";
				if(!$rs_contenido2 = mysql_query($query_rs_contenido2, $conexion_gal)) $mensaje_err = $mensaje_glob_v[11];
				else {
					$query_img = SeleccionarInfo('archivos', '*', $sql_db, $conexion_gal, TRUE, "categoria_archivos = $insert_id");
					$num_img = NumerodeCampos($query_img);
					if($num_img > 0){
						while($result_categorias_img = ResultadoArrayAssoc($query_img)){
							$id_archv_brr = $result_categorias_img['id_archivos'];
							if(!BorrarArchivo($id_archv_brr, $sql_db, $conexion_gal, $ruta.'archivos/')) {
								$mensaje_err = $mensaje_glob_v[11];
								break;
							}
						}
					}
				header('Location: filebrowser.php');
				}
			}
		}
		break;
		//subir imagen
		case 3:{
			//echo count($archivo_val_1);exit;
			//if(count($archivo_val_1) < 1) $mensaje_err .= $mensaje_glob_v[3];
			if(count($archivo_val_1) > 6) $mensaje_err .= $mensaje_glob_v[4];
			$mensaje_err=null;
			
			if (isset($mensaje_glob_v[validarMenu($categoria_val_1, 2)]))
			{
				$mensaje_err .= $mensaje_glob_v[2];
			}
			//$mensaje_err .= isset($mensaje_glob_v[validarMenu($categoria_val_1, 2)]);
			
			$tamano_img = explode('.',$_FILES['archivo']['name'][isset($key)]);
			$cantidad_archv = count($tamano_img);
			$extension = strtolower($tamano_img[--$cantidad_archv]);
			
			foreach($_FILES['archivo']['name'] as $key2 => $valor){
				if(!empty($valor)){
					$tamano_img = explode('.',$_FILES['archivo']['name'][$key2]);
					$cantidad_archv = count($tamano_img);
					$extension = strtolower($tamano_img[--$cantidad_archv]);
					
					if(!in_array($extension, $get_archiv_img)) $mensaje_err .= $mensaje_glob_v[5];
				}
				else $mensaje_err .= $mensaje_glob_v[3];
				if($_FILES['archivo']['size'][$key2] > 4194304) $mensaje_err .= $mensaje_glob_v[6];
			}
			//if(empty($extension)) $mensaje_err .= $mensaje_glob_v[validarReq($id_val_1, 11)];
			
			if(empty($mensaje_err)) {
				
				foreach($_FILES['archivo']['tmp_name'] as $key => $valor) {
					if(!empty($valor)){
						//$insert_nom = GetSQLValueString($nombre_val_1, "text");
					
						$insert_cat = GetSQLValueString($categoria_val_1, "int");
						$insert_categoria = GetSQLValueString($categoria_val_1, "int");
						$insert_nombre_orig = GetSQLValueString($_FILES['archivo']['name'][$key], "text");
						$insert_tipo = GetSQLValueString('1', "int");
						$insert_descrip = GetSQLValueString(isset($descrip_cort_val_1), "text");
						$insert_date = GetSQLValueString($fecha_act, "date");
						
						$insert_id = GetSQLValueString($id_val_1, "int");
						
						/*$tamano_img = explode('.',$_FILES['archivo']['name'][$key]);
						$cantidad_archv = count($tamano_img);
						$extension = $tamano_img[--$cantidad_archv];*/
						
						//movemos el archivo
						$archivo_nuevo = $_FILES['archivo']['name'][$key];
						$add_dir = 'archivos';
						$add = $add_dir."/".$archivo_nuevo;
						
						$mover_archivos = (move_uploaded_file($valor, $add));
						chmod("$add",0777);
						
						if($mover_archivos) {
							$campos_img = 'tipo_archivos, categoria_archivos, id_tipo_archivos, nombre_archivos, archivo_archivos, extension_archivos, fecha_archivos';
							$valores_img = "'tinymce', $insert_categoria, $insert_id, $insert_nombre_orig, '$archivo_nuevo', '$extension', $insert_date";
				
							if(InsertarInfo('archivos', $campos_img, $valores_img, $sql_db, $conexion_gal)) $mensaje_err = $mensaje_glob_v[11];
							else{
								$se_movio = TRUE;
							}
						}
						else $mensaje_err = $mensaje_glob_v[34];
					}
				}
				if($se_movio == TRUE) {
					if(!empty($cat)) {
						//$seccion = 1;
						//$id = $cat;
						header('Location: filebrowser.php?seccion=1&id='.$cat);
					}
					else unset($seccion);
				}
			}	
		}
		break;
		//borrar imagen
		case 4:{
			$mensaje_err=null;
			$mensaje_err .= isset($mensaje_glob_v['validarReq('.$id_val_1.', 11)']);
			if(empty($mensaje_err)) {
				$insert_id = GetSQLValueString($id_val_1, "int");
				
				$query_rs_archivos = "SELECT * FROM archivos WHERE id_archivos = $insert_id";
				$rs_archivos = mysql_query($query_rs_archivos, $conexion_gal) or die('no se pudo conectar a la base de datos');
				$row_rs_archivos = mysql_fetch_assoc($rs_archivos);
				$totalRows_rs_archivos = mysql_num_rows($rs_archivos);
				
				if($totalRows_rs_archivos > 0){
					if(!BorrarArchivo($insert_id, $sql_db, $conexion_gal, isset($ruta).'archivos/')) {
						$mensaje_err = $mensaje_glob_v[11];
					}
					else {
					}
				}
			}
		}
		break;
		default:{}
	}
}
?>