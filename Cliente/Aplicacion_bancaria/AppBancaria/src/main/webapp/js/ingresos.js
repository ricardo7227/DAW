/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$("#crear_movimiento").click(validarFormularios);
$("#build_modal").on("click", "#ok_modal", createMovimiento);

var newMovimiento = new Object();//objeto para registrar un nuevo movimiento

$(document).ready(function () {


});
function validarFormularios() {


    var formNcuenta = $("#check_num_cuenta_form");
    var formCuerpo = $('#cuerpo_ing_rei_form');
    formNcuenta.validate({
        rules: {
            input_ncuenta: "required"
        },
        messages: {
            input_ncuenta: "Introduce un número de cuenta válido"
        }
    });
    formCuerpo.validate({
        rules: {
            input_descripcion: "required",
            input_importe: "required"
        },
        messages: {
            input_descripcion: "Introduce una descripción de la operación  que vas a realizar",
            input_importe: "Por favor, introduce un importe válido para esta operación"
        }
    });

    if (formCuerpo.valid() && formNcuenta.valid()) {
        //rellenamos el objeto
        newMovimiento.mo_ncu = $("#input_ncuenta").val();
        newMovimiento.mo_des = $("#input_descripcion").val();
        newMovimiento.mo_imp = $("#input_importe").val();

        var jsonToSend = new Object();
        jsonToSend.titulo = "Nuevo movimiento a registrar";
        jsonToSend.cuerpo = JSON.stringify(newMovimiento);
        console.log(jsonToSend);
        createAndLaunchModalView(jsonToSend);
    }


}



function createMovimiento() {

    $.ajax({
        type: "POST",
        url: end_point_operaciones,
        data: {
            mo_ncu: newMovimiento.mo_ncu,
            mo_des: newMovimiento.mo_des,
            mo_imp: newMovimiento.mo_imp,
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

