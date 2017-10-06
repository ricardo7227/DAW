
var contador=0;

function siguiente(){
	//comprobamos que el contador no sea mayor que el numero maximo de pagínas
	if(contador<4){
		contador++;
	}
	//se evalua el contador y se entra en su correspondiente case
	switch (contador){
			case 0:
				
				document.images["una"].src = "Periodicos/Inicio/capturas/1.jpg";
				document.images["una-una"].src = "Periodicos/Inicio/capturas/1.jpg";
				document.getElementById("una-dos").href="Periodicos/Inicio/Periodicos/1.pdf";
				
				document.images["dos"].src = "Periodicos/Inicio/capturas/2.jpg";
				document.images["dos-una"].src = "Periodicos/Inicio/capturas/2.jpg";
				document.getElementById("dos-dos").href="Periodicos/Inicio/Periodicos/2.pdf";
			
				document.images["tres"].src ="Periodicos/Inicio/capturas/3.jpg";
				document.images["tres-una"].src = "Periodicos/Inicio/capturas/3.jpg";
				document.getElementById("tres-dos").href="Periodicos/Inicio/Periodicos/3.pdf";
				
				document.images["cuatro"].src = "Periodicos/Inicio/capturas/4.jpg";
				document.images["cuatro-una"].src = "Periodicos/Inicio/capturas/4.jpg";
				document.getElementById("cuatro-dos").href="Periodicos/Inicio/Periodicos/4.pdf";

				document.getElementById("pag").innerHTML="Página "+(contador+1)+ " de 5";
			  break;
			case 1:
			
				document.images["una"].src = "Periodicos/Inicio/capturas/5.jpg";
				document.images["una-una"].src = "Periodicos/Inicio/capturas/5.jpg";
				document.getElementById("una-dos").href="Periodicos/Inicio/Periodicos/5.pdf";
				
				document.images["dos"].src = "Periodicos/Inicio/capturas/6.jpg";
				document.images["dos-una"].src = "Periodicos/Inicio/capturas/6.jpg";
				document.getElementById("dos-dos").href="Periodicos/Inicio/Periodicos/6.pdf";
					
				document.images["tres"].src ="Periodicos/Inicio/capturas/7.jpg";
				document.images["tres-una"].src = "Periodicos/Inicio/capturas/7.jpg";
				document.getElementById("tres-dos").href="Periodicos/Inicio/Periodicos/7.pdf";
			
				document.images["cuatro"].src = "Periodicos/Inicio/capturas/8.jpg";
				document.images["cuatro-una"].src = "Periodicos/Inicio/capturas/8.jpg";
				document.getElementById("cuatro-dos").href="Periodicos/Inicio/Periodicos/8.pdf";


				document.getElementById("pag").innerHTML="Página "+(contador+1)+ " de 5";
			  break;
			case 2:
				document.images["una"].src = "Periodicos/Inicio/capturas/9.jpg";
				document.images["una-una"].src = "Periodicos/Inicio/capturas/9.jpg";
				document.getElementById("una-dos").href="Periodicos/Inicio/Periodicos/9.pdf";
				
				document.images["dos"].src = "Periodicos/Inicio/capturas/10.jpg";
				document.images["dos-una"].src = "Periodicos/Inicio/capturas/10.jpg";
				document.getElementById("dos-dos").href="Periodicos/Inicio/Periodicos/10.pdf";
				
				document.images["tres"].src ="Periodicos/Inicio/capturas/11.jpg";
				document.images["tres-una"].src = "Periodicos/Inicio/capturas/11.jpg";
				document.getElementById("tres-dos").href="Periodicos/Inicio/Periodicos/11.pdf";
								
				document.images["cuatro"].src = "Periodicos/Inicio/capturas/12.jpg";
				document.images["cuatro-una"].src = "Periodicos/Inicio/capturas/12.jpg";
				document.getElementById("cuatro-dos").href="Periodicos/Inicio/Periodicos/12.pdf";


				document.getElementById("pag").innerHTML="Página "+(contador+1)+ " de 5";
			  break;
			case 3:
				document.images["una"].src = "Periodicos/Inicio/capturas/13.jpg";
				document.images["una-una"].src = "Periodicos/Inicio/capturas/13.jpg";
				document.getElementById("una-dos").href="Periodicos/Inicio/Periodicos/13.pdf";
				
				document.images["dos"].src = "Periodicos/Inicio/capturas/14.jpg";
				document.images["dos-una"].src = "Periodicos/Inicio/capturas/14.jpg";
				document.getElementById("dos-dos").href="Periodicos/Inicio/Periodicos/14.pdf";
				
				document.images["tres"].src ="Periodicos/Inicio/capturas/15.jpg";
				document.images["tres-una"].src = "Periodicos/Inicio/capturas/15.jpg";
				document.getElementById("tres-dos").href="Periodicos/Inicio/15.pdf";
				
				document.images["cuatro"].src = "Periodicos/Inicio/capturas/16.jpg";
				document.images["cuatro-una"].src = "Periodicos/Inicio/capturas/16.jpg";
				document.getElementById("cuatro-dos").href="Periodicos/Inicio/Periodicos/16.pdf";


				document.getElementById("pag").innerHTML="Página "+(contador+1)+ " de 5";
			  break;
			  default:
				document.images["una"].src = "Periodicos/Inicio/capturas/17.jpg";
				document.images["una-una"].src = "Periodicos/Inicio/capturas/17.jpg";
				document.getElementById("una-dos").href="Periodicos/Inicio/Periodicos/17.pdf";
				
				document.images["dos"].src = "Periodicos/Inicio/capturas/18.jpg";
				document.images["dos-una"].src = "Periodicos/Inicio/capturas/18.jpg";
				document.getElementById("dos-dos").href="Periodicos/Inicio/Periodicos/18.pdf";
				
				document.images["tres"].src ="Periodicos/Inicio/capturas/19.jpg";
				document.images["tres-una"].src = "Periodicos/Inicio/capturas/19.jpg";
				document.getElementById("tres-dos").href="Periodicos/Inicio/Periodicos/19.pdf";
				
				
				document.images["cuatro"].src = "Periodicos/Inicio/capturas/20.jpg";
				document.images["cuatro-una"].src = "Periodicos/Inicio/capturas/20.jpg";
				document.getElementById("cuatro-dos").href="Periodicos/Inicio/Periodicos/20.pdf";


				document.getElementById("pag").innerHTML="Página "+(contador+1)+ " de 5";
							
		}	

}

function anterior(){
	if(contador>0){
		contador--;
	}
	switch (contador){
			case 0:
				
				document.images["una"].src = "Periodicos/Inicio/capturas/1.jpg";
				document.images["una-una"].src = "Periodicos/Inicio/capturas/1.jpg";
				document.getElementById("una-dos").href="Periodicos/Inicio/Periodicos/1.pdf";
				
				document.images["dos"].src = "Periodicos/Inicio/capturas/2.jpg";
				document.images["dos-una"].src = "Periodicos/Inicio/capturas/2.jpg";
				document.getElementById("dos-dos").href="Periodicos/Inicio/Periodicos/2.pdf";
			
				document.images["tres"].src ="Periodicos/Inicio/capturas/3.jpg";
				document.images["tres-una"].src = "Periodicos/Inicio/capturas/3.jpg";
				document.getElementById("tres-dos").href="Periodicos/Inicio/Periodicos/3.pdf";
				
				document.images["cuatro"].src = "Periodicos/Inicio/capturas/4.jpg";
				document.images["cuatro-una"].src = "Periodicos/Inicio/capturas/4.jpg";
				document.getElementById("cuatro-dos").href="Periodicos/Inicio/Periodicos/4.pdf";

				document.getElementById("pag").innerHTML="Página "+(contador+1)+ " de 5";
			  break;
			case 1:
			
				document.images["una"].src = "Periodicos/Inicio/capturas/5.jpg";
				document.images["una-una"].src = "Periodicos/Inicio/capturas/5.jpg";
				document.getElementById("una-dos").href="Periodicos/Inicio/Periodicos/5.pdf";
				
				document.images["dos"].src = "Periodicos/Inicio/capturas/6.jpg";
				document.images["dos-una"].src = "Periodicos/Inicio/capturas/6.jpg";
				document.getElementById("dos-dos").href="Periodicos/Inicio/Periodicos/6.pdf";
					
				document.images["tres"].src ="Periodicos/Inicio/capturas/7.jpg";
				document.images["tres-una"].src = "Periodicos/Inicio/capturas/7.jpg";
				document.getElementById("tres-dos").href="Periodicos/Inicio/Periodicos/7.pdf";
			
				document.images["cuatro"].src = "Periodicos/Inicio/capturas/8.jpg";
				document.images["cuatro-una"].src = "Periodicos/Inicio/capturas/8.jpg";
				document.getElementById("cuatro-dos").href="Periodicos/Inicio/Periodicos/8.pdf";


				document.getElementById("pag").innerHTML="Página "+(contador+1)+ " de 5";
			  break;
			case 2:
				document.images["una"].src = "Periodicos/Inicio/capturas/9.jpg";
				document.images["una-una"].src = "Periodicos/Inicio/capturas/9.jpg";
				document.getElementById("una-dos").href="Periodicos/Inicio/Periodicos/9.pdf";
				
				document.images["dos"].src = "Periodicos/Inicio/capturas/10.jpg";
				document.images["dos-una"].src = "Periodicos/Inicio/capturas/10.jpg";
				document.getElementById("dos-dos").href="Periodicos/Inicio/Periodicos/10.pdf";
				
				document.images["tres"].src ="Periodicos/Inicio/capturas/11.jpg";
				document.images["tres-una"].src = "Periodicos/Inicio/capturas/11.jpg";
				document.getElementById("tres-dos").href="Periodicos/Inicio/Periodicos/11.pdf";
								
				document.images["cuatro"].src = "Periodicos/Inicio/capturas/12.jpg";
				document.images["cuatro-una"].src = "Periodicos/Inicio/capturas/12.jpg";
				document.getElementById("cuatro-dos").href="Periodicos/Inicio/Periodicos/12.pdf";


				document.getElementById("pag").innerHTML="Página "+(contador+1)+ " de 5";
			  break;
			case 3:
				document.images["una"].src = "Periodicos/Inicio/capturas/13.jpg";
				document.images["una-una"].src = "Periodicos/Inicio/capturas/13.jpg";
				document.getElementById("una-dos").href="Periodicos/Inicio/Periodicos/13.pdf";
				
				document.images["dos"].src = "Periodicos/Inicio/capturas/14.jpg";
				document.images["dos-una"].src = "Periodicos/Inicio/capturas/14.jpg";
				document.getElementById("dos-dos").href="Periodicos/Inicio/Periodicos/14.pdf";
				
				document.images["tres"].src ="Periodicos/Inicio/capturas/15.jpg";
				document.images["tres-una"].src = "Periodicos/Inicio/capturas/15.jpg";
				document.getElementById("tres-dos").href="Periodicos/Inicio/15.pdf";
				
				document.images["cuatro"].src = "Periodicos/Inicio/capturas/16.jpg";
				document.images["cuatro-una"].src = "Periodicos/Inicio/capturas/16.jpg";
				document.getElementById("cuatro-dos").href="Periodicos/Inicio/Periodicos/16.pdf";


				document.getElementById("pag").innerHTML="Página "+(contador+1)+ " de 5";
			  break;
			  default:
				document.images["una"].src = "Periodicos/Inicio/capturas/17.jpg";
				document.images["una-una"].src = "Periodicos/Inicio/capturas/17.jpg";
				document.getElementById("una-dos").href="Periodicos/Inicio/Periodicos/17.pdf";
				
				document.images["dos"].src = "Periodicos/Inicio/capturas/18.jpg";
				document.images["dos-una"].src = "Periodicos/Inicio/capturas/18.jpg";
				document.getElementById("dos-dos").href="Periodicos/Inicio/Periodicos/18.pdf";
				
				document.images["tres"].src ="Periodicos/Inicio/capturas/19.jpg";
				document.images["tres-una"].src = "Periodicos/Inicio/capturas/19.jpg";
				document.getElementById("tres-dos").href="Periodicos/Inicio/Periodicos/19.pdf";
				
				
				document.images["cuatro"].src = "Periodicos/Inicio/capturas/20.jpg";
				document.images["cuatro-una"].src = "Periodicos/Inicio/capturas/20.jpg";
				document.getElementById("cuatro-dos").href="Periodicos/Inicio/Periodicos/20.pdf";


				document.getElementById("pag").innerHTML="Página "+(contador+1)+ " de 5";
							
		}	
}
