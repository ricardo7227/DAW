/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var input_num_cuenta;


$(document).ready(function () {

    $("#crear_movimiento").click(createMovimiento);

    $("#input_ncuenta").keyup(function (ob) {
        var elem_input_val = $("#input_ncuenta").get(0);
        input_num_cuenta = ob.currentTarget.value;
        if (!isNaN(input_num_cuenta)) {

            if (isNumCuentaComplete(input_num_cuenta)) {
                elem_input_val.setCustomValidity("");

                if (isValidNumCuenta(input_num_cuenta)) {
                    // $("#ver_movimientos").show("slow");
                    comprobarNumCuentaAjax(input_num_cuenta);

                } else {
                    elem_input_val.setCustomValidity("Número de Cuenta inválido");
                    //$("#ver_movimientos").hide("slow");
                }

            } else {
                //$("#ver_movimientos").hide("slow");
                elem_input_val.setCustomValidity("Faltan " + (10 - input_num_cuenta.length) + " dígitos");
            }


        } else {
            elem_input_val.setCustomValidity("Número no válido");
        }


        $("#input_ncuenta_sub").click();

    });

});

$("#check_num_cuenta_form").submit(function (e) {
    e.preventDefault();

    console.log(input_num_cuenta);
});

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
                //$("#ver_movimientos").hide("slow");
            } else {

                var resp = JSON.parse(result);
                // mostrarDatosCuenta(resp);
                //$("#num_cuenta_fec").val(resp.cu_ncu);
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
function createMovimiento() {//TODO - hacer llamada crear movimiento
    var movimiento = new Object();
    movimiento.mo_ncu = $("#input_ncuenta").val();
    movimiento.mo_des = $("#input_descripcion").val();
    movimiento.mo_imp = $("#input_importe").val();


    $.ajax({
        type: "POST",
        url: end_point_operaciones,
        data: {
            mo_ncu: movimiento.mo_ncu,
            mo_des: movimiento.mo_des,
            mo_imp: movimiento.mo_imp,
            ACTION: "new_movimiento"
        },
        success: function (result) {
            if (result === "null") {
                cambiarTextoRespuesta("#dialog_span", "Fallo agregando registros a la base de datos");
                cambiarStatusAlert("#alert_type", "alert-warning");
                
            } else {

                var resp = JSON.parse(result);                
                cambiarTextoRespuesta("#dialog_span", resp.description);
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
function cambiarTextoRespuesta(objetivo, texto) {
    $(objetivo).text(texto);
    $("#response_client_js").show("slow");
    setTimeout(function () {
        $("#response_client_js").hide("slow");
    }, 10000);
}

