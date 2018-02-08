var input_num_cuenta;
$(document).ready(function () {
    $("#datos_dni_1").hide();
    $("#datos_cliente_1").hide();
    $("#new_titular").hide();
    $("#datos_dni_2").hide();
    $("#datos_cliente_2").hide();
    $("#importe").hide();
    $("#crear_cuenta").hide();
    
    $("#ncuenta_input").keyup(function (ob) {
        var elem_input_val = $("#ncuenta_input").get(0);
        input_num_cuenta = ob.currentTarget.value;
        if (!isNaN(input_num_cuenta)) {

            if (isNumCuentaComplete(input_num_cuenta)) {//TODO - corregir para cuentas
                elem_input_val.setCustomValidity("");

                if (isValidNumCuenta(input_num_cuenta)) {
                    $("#datos_dni_1").show("slow");
                    comprobarNumCuentaAjax(input_num_cuenta);

                } else {
                    elem_input_val.setCustomValidity("Número de Cuenta inválido");
                    $("#datos_dni_1").hide("slow");
                }

            } else {
                $("#datos_dni_1").hide("slow");
                elem_input_val.setCustomValidity("Faltan " + (10 - input_num_cuenta.length) + " dígitos");
            }


        } else {
            elem_input_val.setCustomValidity("Número no válido");
        }


        $("#num_cuenta_sub").click();

    });
    comprobarNumCuentaAjax(getValidRandomValue());

});

function getValidRandomValue(){
	var max = 9999999999;
	var min = 0000000011;
	var recomend_num_cuenta = Math.floor(Math.random()*(max-min+1)+min);

	var num = 10;
	while (!isValidNumCuenta(String(recomend_num_cuenta))){
		recomend_num_cuenta = Math.floor(Math.random()*(max-min+1)+min);
	}
	return recomend_num_cuenta;
}
function comprobarNumCuentaAjax(num_recomendado) {
    
    
    $.ajax({
        type: "POST",
        url: end_point_apertura_cuentas,
        data: {
            n_cuenta: num_recomendado,
            ACTION: "check_num_cuenta"
        },
        success: function (result) {
            if (result === "null") {
                cambiarTextoResp("#dialog_span", "Nº Cuenta recomendado: " + num_recomendado,1000*60);                
                cambiarStatusAlert("#alert_type", "alert-info");                
               
            } else {
                var resp = JSON.parse(result);
                
                console.log("Ya existen DB");
            }


            console.log("Respuesta Server");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            cambiarTextoResp("#dialog_span", "Tenemos problemas en el Servidor, inténtalo otra vez",1000*20);
            cambiarStatusAlert("#alert_type", "alert-danger");
            console.log(XMLHttpRequest + textStatus + errorThrown);
        }
    });
}


