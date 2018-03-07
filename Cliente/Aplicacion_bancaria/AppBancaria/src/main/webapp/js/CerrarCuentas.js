
$("#cerrar_cuenta").click(cerrarCuenta);

function cerrarCuenta() {
    var cuenta = new Object();
    cuenta.cu_ncu = $("#input_ncuenta").val();

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