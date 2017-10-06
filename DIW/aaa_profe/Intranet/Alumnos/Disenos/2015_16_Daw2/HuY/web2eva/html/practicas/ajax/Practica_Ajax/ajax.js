$(document).ready(
	function(){
		$("#enviar").click(
			function(evento){
				evento.preventDefault();
				$("#cargando").css("display", "inline");
				$("#destino").load("ajax.php", 
					{nombre:document.myForm.nombre.value, apellido:document.myForm.apellido.value}, 
					function(){
						$("#cargando").css("display", "none");
					}
				);
			}
		);
	}
);