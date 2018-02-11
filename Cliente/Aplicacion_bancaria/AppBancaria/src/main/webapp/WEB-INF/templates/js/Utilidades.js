
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

function cambiarTextoResp(objetivo, texto,tiempo) {
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
function checkDni(dni_input){	
	var rgx = new RegExp(/^[0-9]{8}[A-Z]{1}/i);
	return rgx.test(dni_input);
}

function disableForm(formulario, isDisable) {
    $("form#" + formulario + " :input").each(function () {
        $(this).prop("disabled", isDisable);
    });
}
function checkForm(formulario) {
    var isfull = true;
    $("form#" + formulario + " :input").each(function () {
        if ($(this).val() == ""){
            isfull = false;
        }
    });
    return isfull;
}