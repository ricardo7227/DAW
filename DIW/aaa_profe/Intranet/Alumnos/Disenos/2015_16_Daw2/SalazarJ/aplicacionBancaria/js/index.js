$(document).ready(function()
			{
				
				$('#creabd').click(function(evento)
					{
							$(this).blur();
							evento.preventDefault();
							$("#contenido").css("display", "block");
							$("#contenido").load("creabd/creabd.php");
							
					}
				);
				
				$('#borrabd').click(function(evento)
						{
								$(this).blur();
								evento.preventDefault();
								$("#contenido").css("display", "block");
								$("#contenido").load("borrabd/borrabd.php");
								
						}
					);
				
				$('#creaCuenta').click(function(evento)
						{
								$(this).blur();
								evento.preventDefault();
								$("#contenido").css("display", "block");
								$("#contenido").load("creaCuenta/creaCuenta.php");
								
						}
					);
				
				$('#verMovimientos').click(function(evento)
						{
								$(this).blur();
								evento.preventDefault();
								$("#contenido").css("display", "block");
								$("#contenido").load("movimientos/movimientos.php");
								
						}
					);
				
				$('#cambioSaldo').click(function(evento){
								$(this).blur();
								evento.preventDefault();
								$("#contenido").css("display", "block");
								$("#contenido").load("cambioSaldo/cambioSaldo.php");
				});
				

				$('#borraCuenta').click(function(evento){
								$(this).blur();
								evento.preventDefault();
								$('#contenido').css("display","block");
								$('#contenido').load("borraCuenta/borraCuenta.php");
				});
				
			});
