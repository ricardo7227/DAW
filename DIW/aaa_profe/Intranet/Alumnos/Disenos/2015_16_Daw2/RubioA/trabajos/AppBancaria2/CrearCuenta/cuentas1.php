<?php
?>
<script type="text/javascript">

$(document).ready(function()
	{
	$("#Buscar").click(function(evento)
		{	
			evento.preventDefault();
			$("#destino").load("cuentas2.php",{cajanumcu:document.getElementById('cajanumcu').value});
		});
	$("#Buscardni").click(function(evento)
			{	
				evento.preventDefault();
				$("#destino").load("cuentas3.php",{cajanumcu:document.getElementById('cajanumcu').value, cajanumcu:document.getElementById('cajanumdni').value});
			});
	$('#cajanumcu').focusout(function(evento)
			{
			comprobarnumcuenta();
			});
	});
	


function comprobarnumcuenta()
{
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
	}
	else
	{
		cajacuenta.className="w3-input w3-border w3-pale-red";
	}
}
</script>
		<div class='w3-animate-opacity w3-teal cabecera w3-container w3-leftbar w3-border-teal'><h3> Busque un numero de Cuenta</h3><p>Si el numero no existe pero es valido, se podrá crear a continuación</p></div>
		
		<p> 
			<label class="w3-label w3-text-teal"><b>Numero de Cuenta:</b></label>
				<input id="cajanumcu" class="w3-input w3-border w3-light-grey" type="text">
		</p>				
		<p> 
			<button value="Buscar" id="Buscar" class="w3-btn w3-teal">Buscar</button>					
		</p>

	