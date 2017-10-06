<script>
var compcuenta=0;
var compdesc=0;
var compimporte=0;


$(document).ready(function()
{
	$("#Ingresar").click(function(evento)
		{	
			evento.preventDefault();
			if(compcuenta!=0 && compdesc!=0 && compimporte!=0)
			{
				$("#destino").load("reintegros3.php",{cajaimporte: document.getElementById('cajaimporte').value, cajadesc: document.getElementById('cajadesc').value, cajanumcu:document.getElementById('cajanumcu').value});
			}
			else
				alert("Debes completar de una forma correcta los campos en rojo.");
		});

	$('#cajanumcu').focusout(function(evento)
		{
		comprobarnumcuenta();
		});
	$('#cajadesc').focusout(function(evento)
			{
			comprobardesc();
			});
	$('#cajaimporte').focusout(function(evento)
			{
			comprobarimporte();
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

	function comprobardesc()
	{
		compdesc=0;
		var cajadesc= document.getElementById('cajadesc');
		if (cajadesc.value=="")
		{
			compdesc=0;
			cajadesc.className="w3-input w3-border w3-pale-red";
		}
		else
		{
			compdesc=1;
			cajadesc.className="w3-input w3-border w3-pale-green";
		}					
		
	}

	function comprobarimporte()
	{
		compimporte=0;
		var cajaimporte= document.getElementById('cajaimporte');						
		if (cajaimporte.value >0 && cajaimporte.value<10000000)
		{
			compimporte=1;
			cajaimporte.className="w3-input w3-border w3-pale-green";
		}
		else
		{
			compimporte=0;
			cajaimporte.className="w3-input w3-border w3-pale-red";
		}	
	}
</script>
			
			<form class="w3-container">
				<div class="w3-half">
					<p> 
						<label class="w3-label w3-text-teal"><b>Numero de Cuenta:</b></label>
						<input id="cajanumcu" class="w3-input w3-border w3-light-grey" type="text">
					</p>
					<p> 
						<label class="w3-label w3-text-teal"><b>Descripción</b></label>
						<textarea id="cajadesc" class="w3-input w3-border"></textarea>
					</p>
					<p> 
						<label class="w3-label w3-text-teal"><b>Importe</b></label>
						<input id="cajaimporte" class="w3-input w3-border w3-light-grey" type="text">
					</p>
					<button id="Ingresar" name="Ingresar" class="w3-btn w3-teal">Restar</button>
				</div>
			
			</form>
<?php
?>