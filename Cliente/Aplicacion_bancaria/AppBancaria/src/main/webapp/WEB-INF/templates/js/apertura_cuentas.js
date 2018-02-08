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
                    $("#ver_movimientos").hide("slow");
                }

            } else {
                $("#ver_movimientos").hide("slow");
                elem_input_val.setCustomValidity("Faltan " + (10 - input_num_cuenta.length) + " dígitos");
            }


        } else {
            elem_input_val.setCustomValidity("Número no válido");
        }


        $("#num_cuenta_sub").click();

    });

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
function getValidRandomNumberDB() {
    var num_recomendado = getValidRandomValue();
    //TODO - implementar
    $.ajax({
        type: "POST",
        url: end_point_apertura_cuentas,
        data: {
            n_cuenta: num_cuenta,
            ACTION: "check_num_cuenta"
        },
        success: function (result) {
            if (result === "null") {
                cambiarTextoRespuesta("#dialog_span", "No existe el número de cuenta en base de datos");
                cambiarStatusAlert("#alert_type", "alert-warning");
                $("#ver_movimientos").hide("slow");
            } else {

                var resp = JSON.parse(result);
                mostrarDatosCuenta(resp);
                $("#num_cuenta_fec").val(resp.cu_ncu);
                cambiarTextoRespuesta("#dialog_span", "Número de Cuenta correcto");
                cambiarStatusAlert("#alert_type", "alert-success");
            }


            console.log("Respuesta Server");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            cambiarTextoRespuesta("#dialog_span", "Tenemos problemas en el Servidor, inténtalo otra vez");
            cambiarStatusAlert("#alert_type", "alert-danger");
            console.log(XMLHttpRequest + textStatus + errorThrown);
        }
    });
}
