<script type="text/javascript">
 var cambiar = {
    accion:  function(hide, show){ this.ocultar(hide); this.mostrar(show); },
    ocultar: function(num){ document.getElementById("div"+num).style['display'] = "none"; },
    mostrar: function(num){ document.getElementById("div"+num).style['display'] = "block"; }
 };
</script>
<h1>Departamento Informatica</h1>
<div style="text-align:left; padding:20px;">
<img id="img_dept_inf" src="Comun/imagenes/Informatica/aula25peq.jpg" >
<p style="text-align:justify; margin:-2px 10px 10px 10px;">El instituto Enrique Tierno Galván se inauguró en 1985; entonces era un instituto sólo de Formación Profesional  donde convivían las familias de automoción, electrónica, electricidad, metal e informática, con turnos de mañana y tarde. De informática se impartía segundo grado  llegando a ser  un departamento con 18 profesores.<br />
A partir de 1992 en el centro se empieza a implantar anticipadamente la LOGSE, pasando a  denominarse "IES ENRIQUE TIERNO GALVÁN".<br />
En 1996 se implanta el nuevo ciclo de Grado Superior: Administración de Sistemas Informáticos en el turno de tarde, mientras que por la mañana se mantiene la Formación Profesional de Segundo Grado, conviviendo ambas enseñanzas dos cursos académicos.<br />
En 1998 se implanta el ciclo de Grado Superior: Desarrollo de Aplicaciones Informáticas en turno de mañana, desapareciendo completamente la Formación Profesional de Segundo Grado.<br />
Actualmente, se imparte el ciclo Desarrollo de Aplicaciones Web en turno de mañana  y el ciclo  Administración de Sistemas Informáticos y en Red en turno de tarde.
</p>
<hr />
<button class="boton_cambio nuestromodulos" onclick="cambiar.accion(2,1)">Nuestros modulos</button>
<button onclick="cambiar.accion(1,2)" class="boton_cambio nuestromodulos">Nuestros profesores</button>
	   <div class="divTable" id="div1">
	   <h2 style="text-align:center">Nuestros ciclos</h2>
             <div class="headRow">
                <div class="divCell" align="center">Nombre del ciclo</div>
                <div  class="divCell">Mas informaci&oacute;n</div>
             </div>
            <div class="divRow">
                <div class="divCell">Desarrollo de Aplicaciones WEB</div>
                <div class="divCell">
					<a href="index.php?dep=inf&modulo=daw">+info</a>
				</div>
            </div> 
			<div class="divRow">
                <div class="divCell">Administraci&oacute;n de sistemas inform&aacute;ticos en red</div>
                <div class="divCell">
					<a href="index.php?dep=inf&modulo=asir">+info</a>
				</div>
            </div>
      </div>
<div class="divTable" id="div2" style="display:none;">
	   <h2 style="text-align:center">Nuestros profesores</h2>
             <div class="headRow">
                <div class="divCell" align="center">Nombre del profesor</div>
                <div  class="divCell">Mas informaci&oacute;n</div>
             </div>
            <div class="divRow">
                <div class="divCell">Santiago</div>
                <div class="divCell"> <a href="/Departamentos/Informatica/web/profesores/santiago/index.html">Material didáctico</a> </div>
            </div> 
	     <div class="divRow">
                <div class="divCell">Marta</div>
                <div class="divCell"> <a href="/Departamentos/Informatica/web/profesores/marta/index1.htm">+info</a> </div>
            </div>

			
      </div>
      </div>
