var input_num_cuenta;
var input_dni_titular_1;

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

            if (isNumCuentaComplete(input_num_cuenta)) {
                elem_input_val.setCustomValidity("");

                if (isValidNumCuenta(input_num_cuenta)) {
                    $("#datos_dni_1").show("slow");
                    if (callNumCuentaAjax(input_num_cuenta, "check_number")) {
                        //TODO define el numero en el form  
                    }

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

    });//fin ncuenta input

    $("#dni_input").keyup(function (ob) {
        var elem_input_val = $("#dni_input").get(0);
        input_dni_titular_1 = ob.currentTarget.value;


        if (isNumDniComplete(input_dni_titular_1)) {
            elem_input_val.setCustomValidity("");

            if (checkDni(input_dni_titular_1)) {
                $("#datos_cliente_1").show("slow");
                if (callNumDniAjax(input_dni_titular_1, "check_number")) {
                    //TODO define el numero en el form  
                }

            } else {
                elem_input_val.setCustomValidity("DNI inválido");
                $("#datos_cliente_1").hide("slow");
            }

        } else {
            $("#datos_cliente_1").hide("slow");
            elem_input_val.setCustomValidity("Faltan " + (9 - input_dni_titular_1.length) + " caracteres");
        }





        $("#dni_titular_sub").click();

    });//fin dni input
    callNumCuentaAjax(getValidRandomValue(), "recommend_number");

});//fin ready

$("#check_num_cuenta_form").submit(function (e) {
    e.preventDefault();

});
$("#check_dni_titular_form").submit(function (e) {
    e.preventDefault();

});

function getValidRandomValue() {
    var max = 9999999999;
    var min = 0000000011;
    var recomend_num_cuenta = Math.floor(Math.random() * (max - min + 1) + min);

    var num = 10;
    while (!isValidNumCuenta(String(recomend_num_cuenta))) {
        recomend_num_cuenta = Math.floor(Math.random() * (max - min + 1) + min);
    }
    return recomend_num_cuenta;
}
function callNumCuentaAjax(num_recomendado, opcion) {

    var isValid = false;
    $.ajax({
        type: "POST",
        url: end_point_apertura_cuentas,
        data: {
            n_cuenta: num_recomendado,
            ACTION: "check_num_cuenta"
        },
        success: function (result) {
            switch (opcion) {
                case "recommend_number":
                    if (result === "null") {
                        cambiarTextoResp("#dialog_span", "Nº Cuenta recomendado: " + num_recomendado, 1000 * 60 * 2);
                        cambiarStatusAlert("#alert_type", "alert-info");

                    } else {
                        isValid = callNumCuentaAjax(getValidRandomValue(), "recommend_number");
                    }

                    break;
                case "check_number":
                    if (result === "null") {
                        cambiarTextoResp("#dialog_span", "Nº Cuenta válido : " + num_recomendado, 1000 * 60 * 10);
                        cambiarStatusAlert("#alert_type", "alert-success");
                        isValid = true;

                    } else {
                        var resp = JSON.parse(result);
                        cambiarTextoResp("#dialog_span", "Ya tenemos el " + num_recomendado + " en la base de datos, prueba con otro nº de cuenta", 1000 * 60);
                        cambiarStatusAlert("#alert_type", "alert-warning");

                        $("#datos_dni_1").hide("slow");
                    }
                    break;

            }



            console.log("Respuesta Server");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            cambiarTextoResp("#dialog_span", "Tenemos problemas en el Servidor, inténtalo otra vez", 1000 * 20);
            cambiarStatusAlert("#alert_type", "alert-danger");
            console.log(XMLHttpRequest + textStatus + errorThrown);
        }
    });
    return isValid;
}
function callNumDniAjax(dni_input, opcion) {

    var isValid = false;
    $.ajax({
        type: "POST",
        url: end_point_apertura_cuentas,
        data: {
            cl_dni: dni_input,
            ACTION: "check_dni_titular"
        },
        success: function (result) {
            switch (opcion) {
                case "recommend_number":
                    if (result === "null") {
                        cambiarTextoResp("#dialog_span", "Nº Cuenta recomendado: " + dni_input, 1000 * 60 * 2);
                        cambiarStatusAlert("#alert_type", "alert-info");

                    } else {
                        isValid = callNumCuentaAjax(getValidRandomValue(), "recommend_number");
                    }

                    break;
                case "check_number":
                    if (result === "null") {
                        cambiarTextoResp("#dialog_span", "Nº Cuenta válido : " + dni_input, 1000 * 60 * 10);
                        cambiarStatusAlert("#alert_type", "alert-success");
                        isValid = true;

                    } else {
                        var resp = JSON.parse(result);
                        cambiarTextoResp("#dialog_span", "Ya tenemos el " + dni_input + " en la base de datos, prueba con otro nº de cuenta", 1000 * 60);
                        cambiarStatusAlert("#alert_type", "alert-warning");

                        $("#datos_dni_1").hide("slow");
                    }
                    break;

            }



            console.log("Respuesta Server");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            cambiarTextoResp("#dialog_span", "Tenemos problemas en el Servidor, inténtalo otra vez", 1000 * 20);
            cambiarStatusAlert("#alert_type", "alert-danger");
            console.log(XMLHttpRequest + textStatus + errorThrown);
        }
    });
    return isValid;
}


