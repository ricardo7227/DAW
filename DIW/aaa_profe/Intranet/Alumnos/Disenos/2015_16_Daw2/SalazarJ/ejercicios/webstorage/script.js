//ESTO HACE QUE AL CAMBIAR EL ESTADO LLAME A LA FUNCION CARGAREVENTOS
document.addEventListener('readystatechange',cargareventos,false);


function cargareventos()
{
	if(document.readyState == 'complete')
			{
				var Eanadir=document.getElementById("anadir");
				Eanadir.addEventListener('click',anadir,true);
				var Emodificar=document.getElementById("modificar");
				Emodificar.addEventListener('click',modificar,true);
				var Eborrar=document.getElementById("borrar");
				Eborrar.addEventListener('click',borrar,true);
				var EborrarTodo=document.getElementById("borrarTodo");
				EborrarTodo.addEventListener('click',borrarTodo,true);
				var Emostrar=document.getElementById("mostrar");
				Emostrar.addEventListener('click',mostrar,true);
				var Eocultar=document.getElementById("ocultar");
				Eocultar.addEventListener('click',ocultar,true);
			}
}

function anadir()
{
		var nombre= document.getElementById("nombre").value;
		var valor= document.getElementById("valor").value;
		window,localStorage.setItem(nombre,valor);
		alert("Añadido correctamente");
		window.location.reload();
}
function modificar()
{
	var nombreNuevo=prompt("Introduce nuevo nombre para"+document.getElementById("nombre").value+" :");
	var valorNuevo=prompt("Introduce su nuevo valor: ");
	localStorage.removeItem(document.getElementById("nombre").value);
	window.localStorage.setItem(nombreNuevo, valorNuevo);
	window.location.reload();
	alert("Se ha modificado correctamente");
}
function borrar()
{
	window.localStorage.removeItem(document.getElementById("nombre").value);
	alert("Se ha borrado correctamente");
	window.location.reload();
}
function borrarTodo()
{
	window.localStorage.clear();
	alert("Se ha borrado todo correctamente");
	window.location.reload();
}
function mostrar()
{
	var i;
	var nombre;
	var valor;
	var texto;
	for(i=0;i<window.localStorage.length;i++)
	{
		 nombre=window.localStorage.key(i);
		 valor=window.localStorage[window.localStorage.key(i)];
		 texto="<tr name='lista'><td>Nombre:"+nombre+"</td><td>Valor: "+valor+"</td></tr>";
		 document.getElementById("tabla1").insertAdjacentHTML("beforeend",texto);
		
	}
}
function ocultar()
{
	var i;
	var elementos=document.getElementsByName("lista");
	var veces=elementos.length;
	var elem;
	for(i=0;i<=veces;i++)
	{
		elem=elementos[0];
		elem.parentNode.removeChild(elem);
	}
}
