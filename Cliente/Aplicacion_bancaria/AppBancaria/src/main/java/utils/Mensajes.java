/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package utils;

/**
 *
 * @author Gato
 */
public class Mensajes {

    public static final String MSJ_APERTURA_CUENTA = "Nueva Cuenta Abierta";
    public static final String MSJ_APERTURA_CUENTA_N_ERRONEO = "El número de cuenta solicitado es inválido, porque ya esta asignado";
    public static final String MSJ_APERTURA_CUENTA_CAMPOS_FAIL = "El cliente/s no relleno todos los campos, o utiliza el mismo DNI para dos clientes distintos";
    public static final String MSJ_APERTURA_CUENTA_SERVIDOR_FAIL = "Tenemos problemas registrando la nueva cuenta en el servidor, inténtalo más tarde";
    public static final String MSJ_APERTURA_CUENTA_OK = "Cuenta Creada Satisfactoriamente";
    
    public static final String MSJ_MOVIMIENTO_CREADO = "Movimiento agregado a nuestros registros";
    public static final String MSJ_MOVIMIENTO_CAMPOS_INCOMPLETOS = "No has introducido todos los campos necesarios para registrar un movimiento";
    public static final String MSJ_CUENTA_INVALIDA = "La cuenta nº %s es inválida";
    public static final String MSJ_CUENTA_CERRADA = "Cuenta: %s eliminada correctamente";
    public static final String MSJ_CUENTA_CERRADA_FAIL = "Fallo eliminando la cuenta: %s";
    
    public static final String MSJ_NUM_CUENTA_ERRONEA = "Número de cuenta: %s erróneo";
    
    public static String SUPERADO_LIMITES_PETICIONES = "Has superado el límite de peticiones diarias";
    public static String FALTA_API_KEY = "No tienes una Apikey válida";
    public static String FALTAN_CAMPOS = "Faltan campos en el objeto";
    
}
