//https://stackoverflow.com/questions/4112686/how-to-use-servlets-and-ajax

var input_num_cuenta;

$(document).ready(function () {
    $("#response_client_js").hide();
    $("#response").hide();
    $("#ver_movimientos").hide();

    $("#num_cuenta").keyup(function (ob) {
        var elem_input_val = $("#num_cuenta").get(0);
        input_num_cuenta = ob.currentTarget.value;
        if (!isNaN(input_num_cuenta)) {

            if (isNumCuentaComplete(input_num_cuenta)) {
                elem_input_val.setCustomValidity("");

                if (isValidNumCuenta(input_num_cuenta)) {
                    $("#ver_movimientos").show("slow");
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

$("#check_num_cuenta_form").submit(function (e) {
    e.preventDefault();

    console.log(input_num_cuenta);
});

function comprobarFechas() {
    var ini = $("#fecha_ini").val();
    var fin = $("#fecha_fin").val();
    ini = new Date(ini).getTime();
    fin = new Date(fin).getTime();

    console.log(ini + " " + fin);
    return (fin > ini);
}
$("#form_movimientos").submit(function (e) {
    e.preventDefault();
    if (comprobarFechas()) {


        cambiarTextoRespuesta("#dialog_span", "Cargando Movimientos ....");
        cambiarStatusAlert("#alert_type", "alert-success");

        $("#response_client_js").show("slow");
        $('.rows_movimientos').remove();
        $("#response").hide("slow");

        $.ajax({
            type: "POST",
            url: end_point_movimientos,
            data: {
                fecha_ini: $("#fecha_ini").val(),
                fecha_fin: $("#fecha_fin").val(),
                n_cuenta: $("#num_cuenta_fec").val(),
                ACTION: "search_movs"
            },
            success: function (result) {
                if (result === "null" || result.length == 2) {
                    cambiarTextoRespuesta("#dialog_span", "En este rango de fechas, no existen movimientos");
                    cambiarStatusAlert("#alert_type", "alert-info");
                } else {
                    console.log(result.length);
                    var trHtml = '<tr id="row_response">';
                    var resp = JSON.parse(result);
                    resp.forEach(function (movimiento) {
                        trHtml += "<tr class=\"rows_movimientos\"><td>" + movimiento.mo_ncu + "</td><td>" + movimiento.mo_fec + "</td><td>" + formatHora(movimiento.mo_hor) + "</td><td>" + movimiento.mo_des + "</td><td>" + movimiento.mo_imp + "</td></tr>";

                    });
                    $("#row_response").replaceWith(trHtml);
                    $("#response").show("slow");
                }
                console.log("Respuesta Server");
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                cambiarTextoRespuesta("#dialog_span", "Tenemos problemas en el Servidor, inténtalo otra vez");
                cambiarStatusAlert("#alert_type", "alert-danger");
                console.log(XMLHttpRequest + textStatus + errorThrown);
            }
        });
    } else {
        cambiarTextoRespuesta("#dialog_span", "La fecha de inicio tiene que ser menor a la final");
        cambiarStatusAlert("#alert_type", "alert-warning");


    }


});

function formatHora(hora) {

    var array_hora = hora.match(/[0-9]{2}/g);
    var hora_format = "";
    array_hora.forEach(function (dd) {
        hora_format += dd + ":";
    });
    return hora_format.substring(0, hora_format.length - 1);
}



function cambiarTextoRespuesta(objetivo, texto) {
    $(objetivo).text(texto);
    $("#response_client_js").show("slow");
    setTimeout(function () {
        $("#response_client_js").hide("slow");
    }, 10000);
}



function comprobarNumCuentaAjax(num_cuenta) {
    $.ajax({
        type: "POST",
        url: end_point_movimientos,
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
function mostrarDatosCuenta(cuenta) {
    $("#num_cuenta_db").text(cuenta.cu_ncu);
    $("#titular_cuenta_db").text(cuenta.cu_dn1 + " / " + cuenta.cu_dn2);
    $("#saldo_cuenta_db").text(cuenta.cu_sal + " €");
}
