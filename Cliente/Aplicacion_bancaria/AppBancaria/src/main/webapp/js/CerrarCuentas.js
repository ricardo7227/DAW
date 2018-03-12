
$("#cerrar_cuenta").click(validarFormularios);
$("#build_modal").on("click", "#ok_modal", cerrarCuenta);

var cuenta = new Object();

function validarFormularios() {


    var formNcuenta = $("#check_num_cuenta_form");

    formNcuenta.validate({
        rules: {
            input_ncuenta: "required"
        },
        messages: {
            input_ncuenta: "Introduce un número de cuenta válido"
        }
    });


    if (formNcuenta.valid()) {
        //rellenamos el objeto
        cuenta.cu_ncu = $("#input_ncuenta").val();

        var jsonToSend = new Object();
        jsonToSend.titulo = "Cuidado, cambio irreversible?";
        jsonToSend.cuerpo = "Quieres cerrar la cuenta: " + cuenta.cu_ncu + " ?";
        console.log(jsonToSend);
        createAndLaunchModalView(jsonToSend);
    }


}

function cerrarCuenta() {



    $.ajax({
        type: "POST",
        url: end_point_cerrar_cuentas,
        data: {
            n_cuenta: cuenta.cu_ncu
        },
        success: function (result) {
            if (result === "null") {
                cambiarTextoRespuesta("#dialog_span", "Fallo eliminando la cuenta de base de datos");
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