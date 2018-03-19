/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package spring.controller;

import java.util.Locale;
import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.validation.BindingResult;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PostMapping;
import spring.model.Alumno;
import spring.servicios.AlumnosServicios;

/**
 *
 * @author daw
 */
@Controller
public class AlumnosController {

    @Autowired
    private AlumnosServicios servicios;
    
    @ModelAttribute("alumno")
    public Alumno formBackingObject() {
        return new Alumno();
    }

    @GetMapping("/alumnos")
    public String getAlumnos(Locale locale, Model model) {
        model.addAttribute("alumnosList", servicios.getAllAlumnos());
        return "alumnosJsp";
    }

    @PostMapping("/addAlumno")
    public String addAlumno(@ModelAttribute("alumno") @Valid Alumno alumno, BindingResult result, Model model) {
        if (result.hasErrors()) {
            model.addAttribute("alumnosList", servicios.getAllAlumnos());
            return "alumnosJsp";
        }
        servicios.insertAlumno(alumno);
        
        return "alumnosJsp";        
    }

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
//    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
//            throws ServletException, IOException {
//        AlumnosServicios servicios = new AlumnosServicios();
//
//        request.setCharacterEncoding("UTF-8");
//        String action = request.getParameter(Constantes.actionJSP);
//        Alumno alumno = null;
//        String messageToUser = null;
//        Map<String, String[]> parametros = request.getParameterMap();
//        if (action != null && !action.isEmpty()) {
//
//            switch (action) {
//                case Constantes.UPDATE:
//
//                    alumno = servicios.tratarParametros(parametros);
//                    messageToUser = (servicios.updateAlumnoJDBC(alumno)) ? Constantes.messageQueryAlumnoUpdated : Constantes.messageQueryAlumnoUpdatedFail;
//
//                    break;
//                case Constantes.INSERT:
//
//                    alumno = servicios.tratarParametros(parametros);
//                    messageToUser = (servicios.insertAlumnoJDBC(alumno)) ? Constantes.messageQueryAlumnoInserted : Constantes.messageQueryAlumnoInsertedFail;
//
//                    break;
//                case Constantes.DELETE:
//                    String key = request.getParameter(SqlQuery.ID.toLowerCase());
//                    int deleted = 0;
//                    if (key != null && !key.isEmpty()) {
//                        deleted = servicios.deleteAlumnoJDBC(key);
//                    }
//                    if (deleted == ConstantesError.CodeErrorClaveForanea) {
//                        alumno = servicios.tratarParametros(parametros);
//                        request.setAttribute(Constantes.alumnoResult, alumno);
//                        messageToUser = Constantes.messageQueryAlumnoDeletedFail;
//
//                    } else if (deleted > 0 && deleted < ConstantesError.CodeErrorClaveForanea) {
//
//                        messageToUser = Constantes.messageQueryAlumnoDeleted;
//                    }
//                    break;
//                case Constantes.DELETE_FORCE:
//
//                    alumno = servicios.tratarParametros(parametros);
//                     {
//                        try {
//                            boolean borrado = servicios.deleteAlumnoForce((int) alumno.getId());
//
//                            messageToUser = (borrado) ? Constantes.messageQueryAlumnoDeleted : Constantes.messageQueryAlumnoDeletedFailedAgain;
//
//                        } catch (SQLException ex) {
//                            Logger.getLogger(AlumnosController.class.getName()).log(Level.SEVERE, null, ex);
//                        }
//                    }
//                    //1º -> BORRAR NOTA 
//                    //2º -> BORRAR ALUMNO
//                    break;
//
//            }
//        }
//
//        if (messageToUser != null) {
//            request.setAttribute(Constantes.resultadoQuery, messageToUser);
//        }
//
//        request.setAttribute(Constantes.alumnosList, servicios.getAllAlumnos());//envia la lista al jsp
//        request.getRequestDispatcher("/" + Constantes.alumnosJSP).forward(request, response);
//    }
}
