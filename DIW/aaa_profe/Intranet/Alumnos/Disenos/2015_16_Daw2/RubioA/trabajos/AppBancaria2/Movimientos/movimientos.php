<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Listado de Movimientos</title>
		<link rel="stylesheet" href="style/w3.css">
		<link rel="stylesheet" type="text/css" href="style/estilo.css">
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
		<script src="js/jquery-1.12.0.min.js" type="text/javascript"></script>
		<script type="text/javascript">
		
			$(document).ready(function()
				{
				$("#Buscar").click(function(evento)
					{	
						evento.preventDefault();
						$("#cargando").css("display","inline");
						$("#destino").load("buscarmovimientos.php",{cajanumcu:document.getElementById('cajanumcu').value},function()
							{
							$("#cargando").css("display","none");
							});
					});
				$('#cajanumcu').focusout(function(evento)
						{
						comprobarnumcuenta();
						});
				});

			function comprobarnumcuenta()
			{
				compcuenta=0;
				var cajacuenta= document.getElementById('cajanumcu');						
				var numcu=cajacuenta.value;
				var primeros= numcu.substr(0,9);
				var ultimo=parseInt(numcu.substr(9,1));
				var suma=0;
				for (i=0;i<9;i++)
				{
					suma=eval(suma + parseInt(primeros[i]));
				}
				if(suma%9 == ultimo)
				{
					cajacuenta.className="w3-input w3-border w3-pale-green";
					compcuenta=1;
				}
				else
				{
					cajacuenta.className="w3-input w3-border w3-pale-red";
					compcuenta=0;
				}
			}
					
		</script>
	</head>
	<body>	
		<header class="cabecera w3-container w3-teal">
  			<a href="index.php"><h1><i class="fa fa-bank w3-xxxlarge"></i>Aplicación Bancaria</h1></a>
		</header>
		<div class="cabecera w3-container w3-teal">
			  <h2>Listado de Movimientos</h2>
		</div>
		
		
		<div class="w3-animate-opacity formulario w3-card-16">
			<form class="w3-container">
				<div class="w3-half">
					<p> 
						<label class="w3-label w3-text-teal"><b>Numero de Cuenta:</b></label>
						<input id="cajanumcu" class="w3-input w3-border w3-light-grey" type="text">
					</p>
					<p> 
						<label class="w3-label w3-text-teal"><b>Fecha del Primer Movimiento</b></label>
						<input id="cajaprimov" class="w3-input w3-border w3-light-grey" type="text">
					</p>
					<p> 
						<label class="w3-label w3-text-teal"><b>Fecha del Segundo Movimiento</b></label>
						<input id="cajasegmov" class="w3-input w3-border w3-light-grey" type="text">
					</p>
					<div name="cargando" style="display:none;" id="cargando" class="w3-opacity w3-animate-bottom w3-card-8">					
						<p><i class="fa fa-spinner fa-spin"></i> Cargando los movimientos</p>
					</div>
					<button value="Buscar" id="Buscar" class="w3-btn w3-teal">Buscar Movimientos</button>
				</div>
				<div id="destino" >
					
							
				</div>
				
			</form>
			
		</div>
		
		
		
		
		
		<div class="w3-container w3-teal">
			  <p>Alejandro Rubio</p>
		</div>
	</body>
</html>
	
<?php
?>