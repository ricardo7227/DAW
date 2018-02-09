/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package utilidades;

/**
 *
 * @author daw
 */
public class Api {
    public static final String BASE_URL_EMT = "https://openbus.emtmadrid.es:9443/emt-proxy-server/last";
    
    //end-points
    public static String END_POINT_GET_ARRIVE_STOP = BASE_URL_EMT + "/geo/GetArriveStop.php";
    public static String END_POINT_GET_LIST_LINES = BASE_URL_EMT + "/bus/GetListLines.php";
    public static String END_POINT_GET_ROUTE_LINE = BASE_URL_EMT + "/bus/GetRouteLines.php";
    public static String END_POINT_GetNodesLines= BASE_URL_EMT + "/bus/GetNodesLines.php";
    
    
    
}
