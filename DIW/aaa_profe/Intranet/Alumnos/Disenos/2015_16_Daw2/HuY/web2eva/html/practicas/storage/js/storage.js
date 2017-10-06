document.addEventListener('readystatechange', f_cargarEventos, false);

function f_cargarEventos(evento){
    debugger;
    if (document.readyState=='complete')
	{
        document.getElementById('almacenar').addEventListener("click", f_almacenar, false);
        document.getElementById('consultar').addEventListener("click", f_consultar, false);
        document.getElementById('modificar').addEventListener("click", f_modificar, false);
        document.getElementById('borrarItem').addEventListener("click", f_borrarItem, false);
        document.getElementById('borrarAlmacen').addEventListener("click", f_borrarAlmacen, false);
        document.getElementById('listar').addEventListener("click", f_listar, false);
        document.getElementById('borrarListado').addEventListener("click", f_borrarListado, false);
    }
}

function f_getNombre(){
    return document.getElementById('nombre').value;
}

function f_getValor(){
    return document.getElementById('valor').value;
}

function f_limpiarEntrada(){
    document.getElementById('nombre').value = "" ;
    document.getElementById('valor').value = "" ;
}

function f_almacenar(){
		var nombre=f_getNombre();
		var valor=f_getValor();
        
		window.localStorage.setItem(nombre,valor);
        document.getElementById('parrafo').innerHTML += "<p>Se ha almacenado el item <b>" + nombre + "</b> con el valor <b>" + valor + "</b>";
        
        f_limpiarEntrada();
}
    
function f_consultar(){
    var nombre=f_getNombre();

    if (window.localStorage.getItem(nombre)){
        var mensaje =  "<p>El item " + nombre + " tiene el valor " + window.localStorage.getItem(nombre) + "</p>";
        document.getElementById('parrafo').innerHTML += mensaje;   
	}
}

function f_modificar(){
    var nombre=f_getNombre();
    var valor=f_getValor();
    
    if (window.localStorage.getItem(nombre)){
        window.localStorage.setItem(nombre,valor);
        document.getElementById('parrafo').innerHTML += "<p>El item " + nombre + " tiene como nuevo valor " + valor + "</p>";    
	}
}
    
function f_borrarItem(){
    var nombre=f_getNombre();
    
    if (window.localStorage.getItem(nombre)){
        window.localStorage.removeItem(nombre);
        document.getElementById('parrafo').innerHTML += "Se ha borrado el item " + nombre;
	}
}

function f_insertar(nombre,valor){
	var mensaje = '<p><strong>Nombre:</strong> '+ nombre;
	mensaje += '<strong> Valor actual:</strong> '+ valor +'</p>';
    document.getElementById('parrafo').innerHTML += mensaje;
}

function f_listar(){
	if (document.readyState == 'complete'){
		for (var i=window.localStorage.length-1;i>=0;i--){
            f_insertar(
                window.localStorage.key(i),
                window.localStorage[window.localStorage.key(i)]);
        }
	}
}

function f_borrarListado(){
    document.getElementById('parrafo').innerHTML = "";     
}

function f_borrarAlmacen(){
    window.localStorage.clear();
    document.getElementById('parrafo').innerHTML = "Se ha borrado todos los items.";
}
   