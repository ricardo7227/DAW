
function isValidNumCuenta(num_cuenta) {
    var isValidNum = false;
    var corte1 = num_cuenta.substring(0, num_cuenta.length - 1);
    var corte2 = parseInt(num_cuenta.charAt(num_cuenta.length - 1));

    var array_n_cu = corte1.match(/[0-9]/g);
    var suma_array = 0;
    array_n_cu.forEach(function (num) {
        suma_array += parseInt(num);

    });
    if (corte1 % 9 == corte2) {
        isValidNum = true;
    }
    return isValidNum;
}
function isNumCuentaComplete(inp) {
    return inp.length == 10;
}
function isNumDniComplete(inp) {
    return inp.length == 9;
}

function cambiarTextoResp(objetivo, texto, tiempo) {
    $(objetivo).text(texto);
    $(objetivo).show("slow");
    setTimeout(function () {
        $(objetivo).hide("slow");
    }, tiempo);
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
function checkDni(dni_input) {
    var rgx = new RegExp(/^[0-9]{8}[A-Z]{1}/i);
    return rgx.test(dni_input);
}

function disableForm(formulario, isDisable) {
    $("form#" + formulario + " :input").each(function () {
        $(this).prop("disabled", isDisable);
    });
}
function disableAllForm(array_formularios, isDisable) {
    for (var item in array_formularios) {
        disableForm(array_formularios[item],isDisable);
    }
}
function cleanForm(formulario) {
    $("form#" + formulario + " :input").each(function () {
        $(this).val("");
    });
}
function cleanAllForms(array_formularios) {
    for (var item in array_formularios) {
        cleanForm(array_formularios[item]);
    }
}

/**
 * Comprueba si un formulario esta lleno
 * @param {type} formulario
 * @returns {Boolean}
 */
function checkForm(formulario) {
    var isfull = true;
    $("form#" + formulario + " :input").each(function () {
        if ($(this).val() == "") {
            isfull = false;
        }
    });
    return isfull;
}
/***
 * Muestra u oculta un array de identificadores
 * @param {type} array_campos
 * @param {type} opcion - mostrar
 * @returns {undefined}
 */
function showHideCampos(array_campos, opcion) {
    if (opcion === "mostar") {
        for (var objetivo in array_campos) {
            $(array_campos[objetivo]).show("slow");
        }
    } else {
        for (var objetivo in array_campos) {
            $(array_campos[objetivo]).hide("slow");
        }
    }
}

//crear vista modal de confirmación

function injectModalInPage(code) {
    $("#build_modal").html(code);

}
function createAndLaunchModalView(genericObject) {
    injectModalInPage(buildCodeModal(genericObject));
    $('#request_modal').modal('show');
}

function buildCodeModal(genericObject) {
    var cabecera = genericObject.titulo;
    var okText = "OK";
    var code = '<div class="modal fade" tabindex="-1" role="dialog" id="request_modal">' +
            '<div class="modal-dialog" role="document">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<h5 class="modal-title">' + cabecera + '</h5>' +
            '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            '</div>' +
            '<div class="modal-body">' +
            '<p>' + genericObject.cuerpo + '</p>' +
            '</div>' +
            '<div class="modal-footer">' +            
            '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>' +
            '<button type="button" class="btn btn-primary" data-dismiss="modal" id="ok_modal">' + okText + '</button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';


    return code;
}