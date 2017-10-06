function dep_cambiarPestania(idOcultar, idMostrar, idPestAct, idPestNon){
		var obj1 = document.getElementById(idOcultar);
		var obj2 = document.getElementById(idMostrar);
		var obj3 = document.getElementById(idPestAct);
		var obj4 = document.getElementById(idPestNon);
		obj1.style.display = "none";
		obj2.style.display = "block";
		obj3.style.borderBottom = "0";
		obj3.style.height = "27px";
		obj4.style.borderBottom = "2px #005C99 solid ";
		obj4.style.height = "25px";
	}