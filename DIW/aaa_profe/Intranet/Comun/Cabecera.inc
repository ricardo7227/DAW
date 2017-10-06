<head>  
  <meta content='text/html; charset=utf-8' http-equiv='content-type'>
  <title>IES Enrique Tierno Galv&aacute;n</title>
  <meta name="author" content="Santiago Alonso Gómez">
  <meta name="description" content="Pagina principal IES Enrique Tierno Galvan">
  <meta name="keywords" content="Enrique, Tierno, Galvan, IES, secundaria, fp, Villaverde, Usera">

  <style type='text/css'>
	@import url('estilos.css');
  </style>

  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />

  <script type='text/javascript' src='js/jquery.js'></script>
  <script type='text/javascript' src='js/cycle.js'></script>	
  <script type='text/javascript' src='js/events.js'></script>	
  <script type='text/javascript' src='js/mov_script.js'></script>	
  <script type='text/javascript' src='js/dep_script.js'></script>
  <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
  <script type='text/javascript' src='js/reservas.js'></script>
<!-- Script para que funcione la visualizacion de periodicos -->
  <script type='text/javascript' src='js/periodicos.js'></script>
<!-- Script para mostrar/esconder un mensaje de Erasmus -->
  <script type='text/javascript' src='js/erasmus.js'></script>
<!-- Calendario de eventos de la sección 5 -->
  <script type='text/javascript'>
          $(document).ready(function(){
              $("#datepicker2").datepicker({ dateFormat: 'dd/mm/yy',currentText: 'Hoy',
                  monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                  'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                  monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                  'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                  dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                  dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié;', 'Juv', 'Vie', 'Sáb'],
                  dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],firstDay: 1});
              $('.slideshow').cycle ({
                  fx: 'zoom',
                  sync: false,
                  delay: -3000});
          });
  </script>

 <!--Formulario Multimedia- Imágenes -->
  <script>

 	$(document).ready(function()
        {
            var vcarpetaNueva;

            $("#enlaceajax2").click(function()
            {
	      	vcarpetaNueva=$('#cn').val();
		
              $("#destino").load("Multimedia/Gestion/GestionImagenes/gestionarFormularioImagenes.php",{carpetaNueva:vcarpetaNueva},function(){}); 
	    });

	  var vcarpetaBorrar;

            $("#enlaceajax3").click(function()
            {
	      	vcarpetaBorrar=$('#cb').val();
		
              $("#destino").load("Multimedia/Gestion/GestionImagenes/gestionarFormularioImagenes.php",{carpetaborrar:vcarpetaBorrar},function(){}); 
	    });

	 
       });
</script>


 <!--Formulario Multimedia- Vídeos -->
   <script>

   $(document).ready(function()
   {
     	var vvideoborrar;
         
          $("#enlaceajax4").click(function()
           {
		vvideoborrar=$("#vb").val();

		$("#mensajes").load("Multimedia/Gestion/GestionVideos/gestionarFormularioVideos.php",{videoborrar:vvideoborrar},function(){
			 
               }); 
	    });

        });

  </script> 	

<!-- Editor de páginas para departamentos y para las opciones Inicio -->
  <?php
       if ((isset($_GET['dep'])) || (isset($_GET['dirini'])) || (isset($_GET['jefini'])) ||
           (isset($_GET['admini'])) || (isset($_GET['aluini'])) || (isset($_GET['ampini'])))
       {
         echo "
         <script type='text/javascript' src='Departamentos/Inicio/tinymce/jscripts/tiny_mce/tiny_mce.js'></script>
         <script type='text/javascript'>
                 tinyMCE.init({
			mode : 'specific_textareas',
			plugins : 'jfilebrowser',
			theme_advanced_buttons1 : 'bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect',
			theme_advanced_buttons2 : 'bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,jfilebrowser,cleanup,help,code',
			theme_advanced_buttons3 : 'hr,removeformat,visualaid,|,sub,sup,|,charmap',
			editor_selector :'mceEditor'
                 });
        </script>";
      }
/* Opción Jefatura - Partes */
      elseif(isset($_GET['jefpar']))
      {
        echo'
             <!-- CSS -->
             <link rel="stylesheet" href="Jefatura/Partes/partes/css/structure.css" type="text/css" />
             <link rel="stylesheet" href="Jefatura/Partes/partes/css/form.css" type="text/css" />
             <link rel="stylesheet" type="text/css" href="Jefatura/Partes/partes/css/jscal2.css" />
             <link rel="stylesheet" type="text/css" href="Jefatura/Partes/partes/css/border-radius.css" />
             <link rel="stylesheet" type="text/css" href="Jefatura/Partes/partes/css/steel/steel.css" />
             <!-- JavaScript -->
             <script src="Jefatura/Partes/partes/js/wufoo.js"></script>
             <script src="Jefatura/Partes/partes/js/jscal2.js"></script>
             <script src="Jefatura/Partes/partes/js/lang/en.js"></script>
             <script src="Jefatura/Partes/partes/js/partes.js"></script>';
       }
  ?>
</head>
