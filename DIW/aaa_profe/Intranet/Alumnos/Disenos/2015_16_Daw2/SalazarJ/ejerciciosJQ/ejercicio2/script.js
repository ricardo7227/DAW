// gestor del evento onClick
// se selecciona el elemento (si no lo estaba)
// si estaba seleccionado, se anula la selcción
// y vuelve a la clase normal
$(document).ready( function()
	{
			$('tr').click(function(evento)
				{	var exp= new RegExp("classSeleccionado");
					if(exp.test(($(this).attr("class"))))
					{
				
						$(this).removeClass("classSeleccionado");						
						
												
					}
					else
					{
						$(this).addClass("classSeleccionado");	
													
					}
				}			
			)
			
			$('tr').mouseover(function(evento)
				{
					if($(this).attr("class")!="classSeleccionado")
					{
						$(this).addClass("classResaltado");
					}
				}
			)
			
			$('tr').mouseout(function(evento)
				{
					if($(this).attr("class")!="classSeleccionado")
					{
						$(this).removeClass("classResaltado");
						$(this).addClass("classNormal");
					}					
				}			
			)
	}
)
/*
function classClick(elemento) {
	if (elemento.className=="classSeleccionado") {
		elemento.className="classNormal";
	} else {
		elemento.className="classSeleccionado";
	}
}
// gestor del evento onMouseOver
// cambia a la clase resaltado
function classMouseOver(elemento) {
	if (elemento.className!="classSeleccionado") {
		elemento.className="classResaltado";
	}
}
// gestor del evento onMouseOut
// cambia a la clase normal, salvo
// que el elemento ya esté seleccionado
function classMouseOut(elemento) {
	if (elemento.className!="classSeleccionado") {
		elemento.className="classNormal";
	}
}*/