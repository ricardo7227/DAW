
console.log("movimientos");
//https://stackoverflow.com/questions/4112686/how-to-use-servlets-and-ajax

$(document).ready(function () {
    $("#response_client_js").hide();
    $("#response").hide();
});

function comprobarFechas() {
    var ini = $("#fecha_ini").val();
    var fin = $("#fecha_fin").val();
    ini = new Date(ini).getTime();
    fin = new Date(fin).getTime();

    console.log(ini + " " + fin);
    return (fin > ini);
}
$("form").submit(function (e) {
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
                fecha_fin: $("#fecha_fin").val()
            },
            success: function (result) {
                var trHtml = '<tr id="row_response">';
                var resp = JSON.parse(result);
                resp.forEach(function (movimiento) {
                    trHtml += "<tr class=\"rows_movimientos\"><td>" + movimiento.mo_ncu + "</td><td>" + movimiento.mo_fec + "</td><td>" + formatHora(movimiento.mo_hor) + "</td><td>" + movimiento.mo_des + "</td><td>" + movimiento.mo_imp + "</td></tr>";

                });
                $("#row_response").replaceWith(trHtml);
                $("#response").show("slow");
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

function cambiarStatusAlert(objetivo, clase) {

    var status_alerts = ["alert-primary", "alert-secondary", "alert-success", "alert-danger", "alert-warning", "alert-info", "alert-light", "alert-dark"];
    status_alerts.forEach(function (status) {
        if ($(objetivo).hasClass(status)) {
            $(objetivo).removeClass(status);
        }
    });
    $(objetivo).addClass(clase);
}

function cambiarTextoRespuesta(objetivo, texto) {
    $(objetivo).text(texto);
    $("#response_client_js").show("slow");
    setTimeout(function () {
        $("#response_client_js").hide("slow");
    }, 10000);
}
