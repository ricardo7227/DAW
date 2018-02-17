/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package utils;

/**
 *
 * @author oscar
 */
public class Constantes {

    public static String alumnosList = "alumnosList";
    public static String asignaturasList = "asignaturasList";
    public static String notaResult = "notaResult";
    public static String notaMessage = "notaMessage";

    public static String alumnoResult = "alumnoResult";
    public static String asignaturaResult = "asignaturaResult";

    public static String alumnosJSP = "alumnosJsp.jsp";
    public static String indexJSP = "index.jsp";
    public static String asignaturasJSP = "asignaturasjsp.jsp";
    public static String notasJSP = "notasjsp.jsp";
    public static String registroJSP = "registroJsp.jsp";

    public static String actionJSP = "action";
    public static final String ACTION_TEMPLATE = "ACTION";

    public static final String INSERT = "INSERT";
    public static final String UPDATE = "UPDATE";
    public static final String DELETE = "DELETE";
    public static final String VIEW = "VIEW";
    public static final String DELETE_FORCE = "DELETE_FORCE";
    public static final String REGISTRAR = "REGISTRAR";
    public static final String VALIDATE = "VALIDATE";
    public static final String LOGIN = "LOGIN";
    public static final String LOGOUT = "LOGOUT";

    public static final String BASE_URL_SERVER = "baseUrlServer";
    public static final String OFFSET = "offset";
    public static final String MESSAGE_TO_USER_OUT_OF_RANGE = "No tienes Acceso al Contenido";
    public static final String MESSAGE_TO_USER = "messageToUser";
    public static final String INDEX_TEMPLATE = "index.ftl";
    public static final String LEVEL_ACCESS = "levelAccess";

    public static final String DEFAULT_ENCODING = "UTF-8";
    public static final String CONTENT_TYPE = "text/html; charset=UTF-8";

    //columna movimientos
    public static final String MOV_NUM_CUENTA = "mo_ncu";
    public static final String MOV_FECHA = "mo_fec";
    public static final String MOV_HORA = "mo_hor";
    public static final String MOV_DESCRIP = "mo_des";
    public static final String MOV_IMPORTE = "mo_imp";

    //columna Cuenta
    public static final String CU_NUM_CUENTA = "cu_ncu";

    //columna cliente
    public static final String CLIENTE_DNI = "cl_dni";
    public static final String CLIENTE_NOMBRE = "cl_nom";
    public static final String CLIENTE_DIRECCION = "cl_dir";
    public static final String CLIENTE_TELEFONO = "cl_tel";
    public static final String CLIENTE_EMAIL = "cl_ema";
    public static final String CLIENTE_F_NACIMIENTO = "cl_fna";
    public static final String CLIENTE_F_CL_CREA = "cl_fcl";
    public static final String CLIENTE_NUM_CUENTAS = "cl_ncu";
    public static final String CLIENTE_SALDO = "cl_sal";
    //Columnas Users
    public static final String USERS = "USERS";
    public static final String ID = "ID";
    public static final String NOMBRE = "NOMBRE";
    public static final String PASSWORD = "PASSWORD";
    public static final String ACTIVO = "ACTIVO";
    public static final String CODIGO_ACTIVACION = "CODIGO_ACTIVACION";
    public static final String FECHA_ACTIVACION = "FECHA_ACTIVACION";
    public static final String EMAIL = "EMAIL";

    //servlet Movimientos
    public static final String FECHA_INI = "fecha_ini";
    public static final String FECHA_FIN = "fecha_fin";
    public static final String N_CUENTA = "n_cuenta";
    public static final String TITULARES = "titulares";

    public static final String MSJ_APERTURA_CUENTA = "Nueva Cuenta Abierta";
    public static final String MSJ_APERTURA_CUENTA_N_ERRONEO = "El número de cuenta solicitado es inválido, porque ya esta asignado";
    public static final String MSJ_APERTURA_CUENTA_CAMPOS_FAIL = "El cliente/s no relleno todos los campos, o utiliza el mismo DNI para dos clientes distintos";
    public static final String MSJ_APERTURA_CUENTA_SERVIDOR_FAIL = "Tenemos problemas registrando la nueva cuenta en el servidor, inténtalo más tarde";
    public static final String MSJ_APERTURA_CUENTA_OK = "Cuenta Creada Satisfactoriamente";

    //ajax
    public static final String CHECK_NUM_CUENTA = "check_num_cuenta";
    public static final String SEARCH_MOVIMIENTOS = "search_movs";
    public static final String CHECK_DNI_TITULAR = "check_dni_titular";
    public static final String NEW_ACCOUNT = "new_account";
    public static final String DATOS = "datos";

    public static String resultadoQuery = "resultado";
    public static String messageQueryAlumnoInserted = "El alumno fue insertado en la lista";
    public static String messageQueryAlumnoInsertedFail = "Alumno no agregado en la lista, vuelve a intentarlo";
    public static String messageQueryAlumnoUpdated = "El alumno fue actualizado en la lista";
    public static String messageQueryAlumnoUpdatedFail = "Problemas actualizando el alumno, inténtalo otra vez";
    public static String messageQueryAlumnoDeleted = "El alumno fue eliminado correctamente de la lista";
    public static String messageQueryAlumnoDeletedFail = "Cuidado! el alumno tiene notas, Quieres borrarlo?";
    public static String messageQueryAlumnoDeletedFailedAgain = "Seguimos sin poder borrar el alumno";

    public static String messageQueryAsignaturaInserted = "Asignatura fue insertado en la lista";
    public static String messageQueryAsignaturaInsertFailed = "Asignatura no agregada a la base de datos";
    public static String messageQueryAsignaturaUpdated = "Asignatura actualizada correctamente";
    public static String messageQueryAsignaturaUpdateFailed = "Error en la actualización de Asignatura";
    public static String messageQueryAsignaturaDeleted = "Asignatura eliminada correctamente";
    public static String messageQueryAsignaturaDeletedFail = "Cuidado! Tienes alumnos que estan cursando esta asignatura. Estás Seguro?";
    public static String messageQueryAsignaturaDeletedFailedAgain = "Problemas graves, no pudimos borrar la Asignatura";

    public static String messageQueryNotaMissing = "No tiene nota";
    public static String messageQueryNotaUpdated = "Hemos actualizado la nota correctamente";
    public static String messageQueryNotaUpdatedFail = "Falló en la actualización de Nota";

    public static String messageUserExist = "Ya tenemos un usuario con un Nombre o Email igual";
    public static String messageUserMissingFields = "Te faltan campos por rellenar";
    public static String messageUserErrorInsert = "Tenemos un problema en el servicio, Intentalo más tarde";
    public static String messageUserRegisterSubmitEmail = "Estás a un paso de completar tu registro, \n por favor, revisa tu correo";
    public static String messageUserRegisterSubmitEmailFail = "Tenemos problemas para enviarte un correo de confirmación";
    public static String messageUserValidateEmailFail = "Tenemos problemas validando tu Email, enlace de Validación Erróneo, faltan parametros";
    public static String messageUserValidateEmailFailID = "Tenemos problemas validando tu Email, enlace de Validación Erróneo";
    public static String messageUserValidateFail = "No podemos Validar tu cuenta intentalo más tarde.";
    public static String messageUserValidateOk = "Felicidades, Hemos validado tu cuenta.";
    public static String messageUserValidateEmailTimeOut = "Has sobrepasado el tiempo de validación";
    public static String messageUserLoginFailNombre = "Error en las credenciales, El Usuario no existe";
    public static String messageUserLoginFailPassword = "Contraseña Errónea";
    public static String messageUserLoginFailActivo = "Quieto parado! Este Usuario no ha sido validado";

    public static String messageFromServer = "messageFromServer";
    public static String LOGIN_ON = "loginOnFromServer";

    //email
    public static String emailSubjectValidate = "ASTOLFO SL: Hola %s - Correo de Activación";

    public static int MAX_RANDOM = 30;
    public static int MIN_RANDOM = 20;
    public static long MAX_TIME_TO_VALIDATE = 1000 * 60 * 60;//1hora

    //servlet Login        
    public static final String MESSAGE_USER_LOGIN_FAIL_PASSWORD = "Contraseña Errónea";
    public static final String MESSAGE_USER_LOGIN_FAIL_ACTIVO = "Quieto parado! Este Usuario no ha sido validado";
    public static final String MESSAGE_USER_LOGIN_FAIL_NOMBRE = "Error en las credenciales, El Usuario no existe";
    public static final String MESSAGE_USER_MISSING_FIELDS = "Te faltan campos por rellenar";

    public static final String MESSAGE_USER_NEW_PASSWORD = "%s esta es tu nueva contraseña: %s ";
    public static final String MESSAGE_USER_NEW_PASSWORD_EMAIL = "Te acabamos de enviar tu nueva contraseña, revisa tu correo";
    public static final String MESSAGE_USER_NEW_PASSWORD_EMAIL_FAIL = "Tenemos problemas para enviarte un correo con tu nueva contraseña, pero ya esta cambiada";
    public static final String MESSAGE_USER_NEW_PASSWORD_WRONG_COMPARE = "la nueva contraseña, no coincide con sus confirmación";
    public static final String MESSAGE_USER_NEW_PASSWORD_WRONG = "No hemos podido cambiar la contraseña, intentalo otra vez";
    public static final String MESSAGE_USER_PASSWORD_FAIL = "Contraseña Actual Errónea";
    public static final String EMAIL_SUBJECT_NEW_PASSWORD = "CRUD:  %s - Nueva Contraseña";

}
