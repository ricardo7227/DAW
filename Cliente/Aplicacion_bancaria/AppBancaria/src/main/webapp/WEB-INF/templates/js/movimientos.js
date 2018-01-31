
console.log("movimientos");
//https://stackoverflow.com/questions/4112686/how-to-use-servlets-and-ajax

$(document).ready(function () {
    $("#response_client_js").hide();
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
        console.log("true");

        cambiarTextoRespuesta("#dialog_span", "Cargando Movimientos ....");
        cambiarStatusAlert("#alert_type", "alert-success");

        $("#response_client_js").show("slow");

        $.ajax({
            type: "POST",
            url: end_point_movimientos,
            data: {
                fecha_ini: $("#fecha_ini").val(),
                fecha_fin: $("#fecha_fin").val()
            },
            success: function (result) {
                var resp = JSON.parse(result);
                resp.forEach(function (movimiento) {
                $("#response").html("<strong>" + movimiento.mo_des + "</strong>");    
                });
                $("#response").html("<strong>" + result  + "</strong>");//TODO pendiente representar el JSON que recibe
                
            }
        });
    } else {
        cambiarTextoRespuesta("#dialog_span", "La fecha de inicio tiene que ser menor a la final");
        cambiarStatusAlert("#alert_type", "alert-warning");


    }


});

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