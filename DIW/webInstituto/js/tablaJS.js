var rootTable = document.getElementById("table");
var table = document.createElement("table");
rootTable.appendChild(table);



//insertFila();
function insertFila(){
	with(document){		
		var tr = createElement("tr");		
		//td.textContent = "nue";
		//tr.appendChild(td);
		table.appendChild(tr);
		console.log(table);
	}
}
//eraseFila();
function eraseFila(){
	var fila = prompt("fila?");
	with(document){
		
		if(isSetCelda(fila,0)){
			table.childNodes[fila].remove();	
		}
		console.log(table.childNodes.length);
	}
}
function insertCelda(){
	var fila = prompt("fila?");
	var columna = prompt("celda?");
	var texto = prompt("Texto? ");
	var textNode = document.createTextNode(texto);
	var td = document.createElement("td");
	td.appendChild(textNode);
	table.childNodes[fila].insertBefore(td, table.childNodes[fila].childNodes[columna]);	
}

function eraseCelda(){
	var fila = prompt("fila?");
	var columna = prompt("celda?");
	if(isSetCelda(fila,columna)){
		table.childNodes[fila].childNodes[columna].remove();	
	}	
}

function searchCelda(){
	var fila = prompt("fila?");
	var columna = prompt("celda?");
	var texto = "Consulta celda f: " + fila + " c: " + columna + " : "; 
	var resultado = document.getElementById("consulta");
	if(isSetCelda(fila,columna)){
		resultado.innerHTML = texto + table.childNodes[fila].childNodes[columna].textContent;	
	}			
}

function setCelda(){
	var fila = parseInt(prompt("fila?"));
	var columna = prompt("celda?");
	var newText = prompt("Nuevo Texto? ");
	
	if(isSetCelda(fila,columna)){
		table.childNodes[fila].childNodes[columna].textContent = newText;	
	}

}

function isSetCelda(fila,columna){
	var isExist = true;
	if( table.childNodes[fila] == "undefined" || table.childNodes.length < fila || table.childNodes[fila].childNodes.length < columna ){
		var resultado = document.getElementById("consulta");
		resultado.innerHTML = "Fuera de rango " + fila + " : " + columna;		
		isExist = false;
	}
	return isExist;
}