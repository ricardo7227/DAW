var input_num_cuenta;
//var input_dni_titular;

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

    introducirDatosDNI("dni_input", "datos_cliente_1", "dni_titular_sub", "response_dni_span", "response_dni", "check_datos_titular_form");

    callNumCuentaAjax(getValidRandomValue(), "recommend_number");

    $("#add_titular").click(function () {
        $("#check_datos_titular_form").click();
        if (checkForm("check_datos_titular_form")) {
            $("#datos_dni_2").show("slow");
            disableForm("check_dni_titular_form", true);
            introducirDatosDNI("dni_input_2", "datos_cliente_2", "dni_titular_sub_2", "response_dni_span_2", "response_dni_2", "check_datos_titular_form_2");
            compararDNI("check_dni_titular_form", "check_dni_titular_form_2");
        } else {
            disableForm("check_dni_titular_form", false);
            cambiarTextoResp("#response_dni_span", "Tienes que rellenar todos los apartados del primer cliente, antes de poder continuar", 1000 * 60 * 10);
            cambiarStatusAlert("#response_dni", "alert-warning");
        }
    });

});//fin ready

$("#check_num_cuenta_form").submit(function (e) {
    e.preventDefault();

});
$("#check_dni_titular_form").submit(function (e) {
    e.preventDefault();

});
$("#check_dni_titular_form_2").submit(function (e) {
    e.preventDefault();

});
$("#check_datos_titular_form").submit(function (e) {
    e.preventDefault();
});
$("#check_datos_titular_form_2").submit(function (e) {
    e.preventDefault();
});
$("#check_importe_form").submit(function (e) {
    e.preventDefault();
    var pendientes = "";
    var importe = $("#importe_input").val();
    createDivSpan("#response_importe", "response_importe_extra", "response_importe_span_extra");
    if (importe === "" || isNaN(importe) || importe == 0) {

        cambiarTextoResp("#response_importe_span_extra", "El importe tiene un formato incorrecto, tiene que ser mayor de cero y numérico", 1000 * 20 * 1);
        cambiarStatusAlert("#response_importe_extra", "alert-warning");
    } else {
        var saldo = $("#importe_input").val();

        if (checkForm("check_num_cuenta_form")) {
            var n_cuenta = $("#ncuenta_input").val();
        } else {
            pendientes += " Nº Cuenta, ";
            //numero cuenta vacio
        }
        if (checkForm("check_dni_titular_form")) {
            var dni_in = $("#dni_input").val();
        } else {
            pendientes += " 1º DNI titular, ";
            //numero dni titular vacio
        }
        if (checkForm("check_datos_titular_form")) {
            var cliente1 = extractDatosForm(dni_in, "check_datos_titular_form");

        } else {
            pendientes += " Datos personales Titular, ";
            //datos titular vacio
        }

        var inDatos2 = $("#datos_cliente_2").is(":visible");
        var lista_titulares = new Array(cliente1);
        if (inDatos2) {
            if (checkForm("check_datos_titular_form_2")) {
                var dni_in_2 = $("#dni_input_2").val();
                var cliente2 = extractDatosForm(dni_in_2,"check_datos_titular_form_2");
                lista_titulares.push(cliente2);
            } else {
                //formulario 2 vacio
                pendientes += " Datos personales 2º Titular ";
            }
        }
        
    }
    if (pendientes != "") {
        cambiarTextoResp("#response_importe_span_extra", "Tienes pendientes los siguientes apartados: " + pendientes, 1000 * 20 * 1);
        cambiarStatusAlert("#response_importe_extra", "alert-danger");
    }else{
        //enviar json
        var json_peticion_new_cuenta = {//TODO - controlar vacios y envio de JSON
            "n_cuenta": n_cuenta,
            "titulares": lista_titulares,
            "cl_sal": saldo
        }
        console.log(JSON.stringify(json_peticion_new_cuenta));
        sendNewAccount(json_peticion_new_cuenta);
    }

});

function sendNewAccount(json_new_account) {//TODO - confeccionar llamada
    $.ajax({
        type: 'POST',
        url: end_point_apertura_cuentas,
        data: {
            ACTION: "new_account",
            datos:JSON.stringify(json_new_account)
        },        
        success: function (result) {

        },
        error: function (result){
            
        }
    });
}

function getValidRandomValue() {
    var max = 9999999999;
    var min = 0000000011;
    var recomend_num_cuenta = Math.floor(Math.random() * (max - min + 1) + min);


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
function callNumDniAjax(dni_input, opcion, response_dni_span, response_dni, form_datos_titular) {

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

                case "check_number":
                    if (result === "null") {
                        cambiarTextoResp("#" + response_dni_span, "Rellena los datos del nuevo cliente", 1000 * 60 * 10);
                        cambiarStatusAlert("#" + response_dni, "alert-secondary");

                        disableForm(form_datos_titular, false);
                    } else {
                        var resp = JSON.parse(result);
                        cambiarTextoResp("#" + response_dni_span, "Ya tenemos un cliente para este DNI " + dni_input + " en la base de datos", 1000 * 60);
                        cambiarStatusAlert("#" + response_dni, "alert-info");
                        mostrarDatosDNI(form_datos_titular, resp);
                        disableForm(form_datos_titular, true);

                        isValid = true;
                    }
                    break;

            }
            $("#new_titular").show("slow");
            $("#importe").show("slow");
            $("#crear_cuenta").show("slow");


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

function mostrarDatosDNI(formulario, cliente) {
    $("#" + formulario + " input[name='nombre_input']").val(cliente.cl_nom);
    $("#" + formulario + " input[name='dir_input']").val(cliente.cl_dir);
    $("#" + formulario + " input[name='tel_input']").val(cliente.cl_tel);
    $("#" + formulario + " input[name='email_input']").val(cliente.cl_ema);
    $("#" + formulario + " input[name='fecha_input']").val(cliente.cl_fna);

}

function extractDatosForm(dni, formulario) {
    var nombre = $("#" + formulario + " input[name='nombre_input']").val();
    var dir = $("#" + formulario + " input[name='dir_input']").val();
    var tel = $("#" + formulario + " input[name='tel_input']").val();
    var email = $("#" + formulario + " input[name='email_input']").val();
    var fecha = $("#" + formulario + " input[name='fecha_input']").val();

    return new Cliente(dni, nombre, dir, tel, email, fecha);

}
function compararDNI(formulario1, formulario2) {

    var dni1 = $("#" + formulario1 + " input[name='dni_input']").val();
    $("#" + formulario2 + " input[name='dni_input']").keyup(function (ob) {
        var dni2 = ob.currentTarget.value;
        if (dni2.length == 9 && dni1 === dni2) {
            createDivSpan("#response_dni_2", "response_dni_2_extra", "response_dni_span_2_extra");

            cambiarTextoResp("#response_dni_span_2_extra", "El segundo cliente debe tener un DNI distinto al primero, tienes que cambiarlo", 1000 * 60 * 1);
            cambiarStatusAlert("#response_dni_2_extra", "alert-danger");

            setTimeout(function () {
                $("#" + formulario2 + " input[name='dni_input']").val("").focus();
                $("#datos_cliente_2").hide("slow");

            }, 2500);
        }

    });

}

function createDivSpan(objetivo, divID, spanID) {
    $(objetivo).append("<div id='" + divID + "'><span id='" + spanID + "'></span></div>");
}
function introducirDatosDNI(objetivo, cuerpo_input_datos, submit_dni_input, response_dni_span, response_dni, check_datos_titular_form) {
    $("#" + objetivo).keyup(function (ob) {
        var elem_input_val = $("#" + objetivo).get(0);
        var input_dni_titular = ob.currentTarget.value;


        if (isNumDniComplete(input_dni_titular)) {
            elem_input_val.setCustomValidity("");

            if (checkDni(input_dni_titular)) {

                $("#" + cuerpo_input_datos).show("slow");
                if (callNumDniAjax(input_dni_titular, "check_number", response_dni_span, response_dni, check_datos_titular_form)) {
                    //TODO define el numero en el form  
                }

            } else {
                elem_input_val.setCustomValidity("DNI inválido");
                $("#" + cuerpo_input_datos).hide("slow");
            }

        } else {
            $("#" + cuerpo_input_datos).hide("slow");
            elem_input_val.setCustomValidity("Faltan " + (9 - input_dni_titular.length) + " caracteres");
        }

        $("#" + submit_dni_input).click();

    });//fin dni input
}
