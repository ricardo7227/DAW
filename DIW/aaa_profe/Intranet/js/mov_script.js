	// SUBMIT ORDER BY, envia la accion de como se quiere ordenar la tabla
	function fnOrdenar(valor) {
		document.formularioLista.accion.value	= valor;
		document.formularioLista.submit()
	}


	// SUBMIT DELETE, segun el ID proporcionado
	function fnDelete(concepto, valorID) {
		var borrar = confirm(concepto + "  ¿Quieres eliminarlo?");
		if (borrar){
	  		document.formularioLista.accion.value	= 'Delete';
			document.formularioLista.mo_id.value	= valorID;
			document.formularioLista.submit();		
		}
	}


	// SUBMIT INSERT INTO, para guardar el nuevo movimiento
	function fnAdd() {
		document.formularioLista.accion.value	= 'Guardar';
		document.formularioLista.submit();	
	}


	// SUBMIT UPDATE, donde modificaremos campos
	function fnUpdate(obj) {
		//LOG alert(obj.id + "  "+ obj.name + "  "+ obj.value);
		document.formularioLista.accion.value	= 'Update';
		document.formularioLista.mo_id.value	= obj.id;
		document.formularioLista.nombre.value	= obj.name;
		document.formularioLista.concepto.value	= obj.value;
		document.formularioLista.submit();	
	}


	// VER/OCULTAR ADD, Muestra los campos donde proceder a añadir el nuevo movimiento	
	function fnVerOcultar(id) {
		var elemento = document.getElementById(id);

		if (elemento.className == "movAddOculto")
			elemento.className = "movAddDisplay";
		else 
			elemento.className = "movAddOculto";
	}



/*
	$(function() {
	    $("#delete").on("click", function(e) {
	        var mo_id = $(this).attr("value");
	        e.preventDefault();
			  
	        $("<div>Are you sure you want to continue?</div>").dialog({
	            buttons: {
	                "Ok": function() {
	                 		document.formularioLista.accion.value='Delete';
								document.formularioLista.mo_id.value=mo_id;
								document.formularioLista.submit();
								$(this).dialog("close");
	                },
	                "Cancel": function() {
	                    $(this).dialog("close");
	                }
	            }
	        });
	    });
	});
*/