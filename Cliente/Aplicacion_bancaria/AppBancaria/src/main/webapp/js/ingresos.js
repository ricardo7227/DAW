/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$("#crear_movimiento").click(createMovimiento);


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

