//ESTO HACE QUE AL CAMBIAR EL ESTADO LLAME A LA FUNCION CARGAREVENTOS
document.addEventListener('readystatechange',cargareventos,false);


function cargareventos()
{
	if(document.readyState == 'complete')
			{
				var elemento1=document.getElementById("elemento1");
				elemento1.addEventListener('click',anadir,true);
				var elemento2=document.getElementById("elemento2");
				elemento2.addEventListener('click',listado,true);
				var elemento3=document.getElementById("elemento3");
				elemento3.addEventListener('click',modificar,true);
				var elemento4=document.getElementById("elemento4");
				elemento4.addEventListener('click',borraruno,true);
				var elemento5=document.getElementById("elemento5");
				elemento5.addEventListener('click',borrartodo,true);
				var elemento6=document.getElementById("elemento6");
				elemento6.addEventListener('click',borrarlistado,true);
			}
}


function anadir()
{
	var nombre=document.getElementById('nombre').value;
	var valor=document.getElementById('valor').value;
	window.localStorage.setItem(nombre,valor);
}

function listado()
{
	for(var i=0;i<window.localStorage.length;i++)
	{
		var nombre=window.localStorage.key(i);
		var valor=window.localStorage[window.localStorage.key(i)];
		var linea="<p name='parrafo'><strong>Nombre:</strong> "+ nombre + "<strong> Valor actual:</strong>"+ valor + "</p>";
		document.body.insertAdjacentHTML('beforeend',linea);
	}
}

function borrar()
{
	var nombre=document.getElementById('nombre').value;
	localStorage.removeItem(nombre);
	window.location.reload();  
}

function borraruno()
{
	borrar()
	alert('Se ha borrado todo el elemento');
}

function borrartodo()
{
	window.localStorage.clear();
	alert('Se ha borrado todo el Storage');
}

function modificar()
{
	var nuevonombre=prompt("Introduzca un nuevo nombre de variable:");
	var nuevovalor=prompt("Introduzca el valor:");
	borrar();
	alert("Los datos han sido modificados");
	window.localStorage.setItem(nuevonombre,nuevovalor);
}



function borrarlistado()
{
	var parrafos=document.getElementsByName("parrafo");
	for (var i=0; i<parrafos.length; i++)
	{
		parrafos[i].innerHTML = "";
	}
}