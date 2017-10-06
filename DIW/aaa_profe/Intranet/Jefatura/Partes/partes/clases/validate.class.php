<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require 'config/global.php';

class validate {
    
    private $mMysqli;
    
    function __construct() {
        $this->mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    }
    function __destruct() {
        $this->mMysqli->close();
    }
    
    public function validateParteUpdate(){
        
        $totinciarray= array($_POST['idincidencia']);
        $totinci="";
        foreach($_POST['idincidencia'] as $valor){
                $totinci .=$valor.",";                
        }
        $totinci .="0";
            
        $query="update partes
                    set
                        pa_codalu=?,
                        pa_codinc=?,
                        pa_inctod=?,
                        pa_codsan=?,
                        pa_observ=?,
                        pa_fechas=?,
                        pa_horas=?,
                        pa_consid=?,
                        pa_codpro=?
                    where pa_id=?";
        $stmt= $this->mMysqli->prepare($query);
        
        $stmt->bind_param("iisisssssi", $idalumno,$idincidencia,$incitodas,$idsancion,$observaciones,$fecha,$hora,$considerada_como,$profesor,$idparte);
        $idalumno=$_POST['idalumno'];
        $idincidencia=$_POST['idincidencia'][0];
        $incitodas=$totinci;
        $idsancion=$_POST['idsancion'];
        $observaciones=$_POST['observaciones'];
        $fecha=$_POST['fecha'];
        $hora=$_POST['hora'];
        $considerada_como=$_POST['considerada_como'];
        $profesor=$_POST['profesor'];
        $idparte=$_POST['idparte'];
        $stmt->execute();
        
        return '../../../index.php?jefpar';    
    }
    public function validateUpdate(){
        
            if ( $_POST['quiereborrar'] == 1) {
                $query="delete from alumnos where al_codigo=?";
                $stmt= $this->mMysqli->prepare($query);
                $stmt->bind_param("i", $idalumno);
                $idalumno=$_POST['idalumno'];
                $stmt->execute();
            }else{
                $query="update alumnos set al_codgru=?,al_nombre=?,al_apell1=?,al_apell2=?,al_telef1=?,al_telef2=? where al_codigo=?";
                $stmt= $this->mMysqli->prepare($query);
                $stmt->bind_param("ssssssi", $idcurso,$nombre,$apellido1,$apellido2,$tel1,$tel2,$idalumno);

                $idcurso=$_POST['idcurso'];
                $nombre=$_POST['nombre'];
                $apellido1=$_POST['apellido1'];
                $apellido2=$_POST['apellido2'];
                $tel1=$_POST['telf1'];
                $tel2=$_POST['telf2'];
                $idalumno=$_POST['idalumno'];
                $stmt->execute();
            }
            $_SESSION['rowafected']=$stmt->affected_rows;        
            
            return '../../../index.php?jefpar';        
    }
    public function validateAlta(){
            $query="insert into alumnos (al_codgru,al_nombre,al_apell1,al_apell2,al_telef1,al_telef2) values (?,?,?,?,?,?)";
            $stmt= $this->mMysqli->prepare($query);
            $stmt->bind_param("ssssss", $idcurso,$nombre,$apellido1,$apellido2,$tel1,$tel2);

            $idcurso=$_POST['idcurso'];
            $nombre=$_POST['nombre'];
            $apellido1=$_POST['apellido1'];
            $apellido2=$_POST['apellido2'];
            $tel1=$_POST['telf1'];
            $tel2=$_POST['telf2'];
            
            $stmt->execute();

            $_SESSION['rowafected']=$stmt->affected_rows;        
            
            return '../../../index.php?jefpar';
    }
    public function validatePHP(){
        $errorExist=0;
        
        if ( isset($_SESSION['error']) )
            unset ( $_SESSION['error']);
        
        //validaciones
        
        
        //si todo ok y no hay errores, insertamos
        if ( $errorExist == 0){
            
            //mete todas los id de incidencia selecccionadas en el formulario
            $totinciarray= array($_POST['idincidencia']);
            $totinci="";
            foreach($_POST['idincidencia'] as $valor){
                $totinci .=$valor.",";                
            }
            $totinci .="0";
            
            if ( $_POST['considerada_como'] == "L") {
                //comprueba que no tenga 2 mas no asociadas
                //si las tiene
                $stmt=$this->mMysqli->prepare("select count(*) from partes where pa_codalu=? and pa_consid='L' and pa_asocia is null");
                $stmt->bind_param("i", $_POST['idalumno']);
                $stmt->bind_result($cuenta);
                $stmt->execute();
                $stmt->fetch();
                $stmt->close();
                
                
                if ( $cuenta > 2) { //esto es un error, no debe haber mas de dos leves sin asociar a grave
                    //mandar correo
                    return 'inconsistencia.php';
                }elseif ( $cuenta == 2) { //ya tiene dos leves, hay que insertar la leve y una grave adicional
                    $ahora=date("Ymd_His"); //clave
                    //
                    //inserta leve
                    $query="insert into partes (pa_codalu,pa_codinc,pa_codsan,pa_observ,pa_fechas,pa_horas,pa_consid,pa_codpro,pa_inctod) values (?,?,?,?,?,?,?,?,?)";
                    $stmt= $this->mMysqli->prepare($query);
                    $stmt->bind_param("iiissssss", $idalumno,$idincidencia,$idsancion,$observaciones,$fecha,$hora,$considerada,$profesor,$incitodas);

                    $idalumno=$_POST['idalumno'];
                    $idincidencia=$totinciarray[0];
                    $idsancion=$_POST['idsancion'];
                    $observaciones=$_POST['observaciones'];
                    $fecha=$_POST['dia'];
                    $hora=$_POST['hora'].':'.$_POST['minuto'];
                    $considerada=$_POST['considerada_como'];
                    $profesor=$_POST['profesor'];
                    $incitodas=$totinci;
                    
                    $stmt->execute();

                    $_SESSION['rowafected']=$stmt->affected_rows;
                    $_SESSION['pasa']="inserta leve";
                    $stmt->close(); 
                    
                    //inserta grave
                    
                    $query="insert into partes (pa_codalu,pa_codinc,pa_codsan,pa_observ,pa_fechas,pa_horas,pa_consid,pa_codpro,pa_inctod) values (?,?,?,?,?,?,?,?,?)";
                    $stmt= $this->mMysqli->prepare($query);
                    $stmt->bind_param("iiissssss", $idalumno,$idincidencia,$idsancion,$observaciones,$fecha,$hora,$considerada,$profesor,$incitodas);

                    $idalumno=$_POST['idalumno'];
                    $idincidencia=$totinciarray[0];
                    $idsancion=$_POST['idsancion'];
                    $observaciones='GRAVE AUTOGENERADA POR ACUMULACION DE 3 LEVES. Sancion igual a la última leve';
                    $fecha=$_POST['dia'];
                    $hora=$_POST['hora'].':'.$_POST['minuto'];
                    $considerada='G';
                    $clave=$ahora;
                    $profesor=$_POST['profesor'];
                    $incitodas=$totinci; 
                    $stmt->execute();

                    $_SESSION['rowafected']=$stmt->affected_rows;

                    $stmt->close(); 
                    
                    //asocia las leves a la nueva grave
                    
                    //1.Consulta id de la grave
                    /// 
                    $query3="select pa_id from partes where pa_codalu=? and pa_consid='G'";
                    $stmt=$this->mMysqli->prepare($query3);
                    $stmt->bind_param("is", $idalumno, $clave2);
                    $idalumno=$_POST['idalumno'];  
                    $clave2=$ahora;
                    
                    $stmt->bind_result($idParteGrave);
                    $stmt->execute();
                    $stmt->fetch();
                    $stmt->close();
                    
                    //2. Actualiza las 3 leves con el id de la grave
                    $stmt=$this->mMysqli->prepare("update partes set pa_asocia=? where pa_codalu=? and pa_consid='L' and pa_asocia is null");
                    $stmt->bind_param("ii", $idParteGrave,$idalumno);
                    $idalumno=$_POST['idalumno'];
                    $stmt->execute();
                    $stmt->close();
                    // fin de proceso, inserta 3 leve, inserta grave autogenerada, actualiza 3 leves
                }elseif ($cuenta<2) {
                    //solo inserta una leve mas
                    $query="insert into partes (pa_codalu,pa_codinc,pa_codsan,pa_observ,pa_fechas,pa_horas,pa_consid,pa_codpro,pa_inctod) values (?,?,?,?,?,?,?,?,?)";
                    $stmt= $this->mMysqli->prepare($query);
                    $stmt->bind_param("iiissssss", $idalumno,$idincidencia,$idsancion,$observaciones,$fecha,$hora,$considerada,$profesor,$incitodas);

                    $idalumno=$_POST['idalumno'];
                    $idincidencia=$totinciarray[0];
                    $idsancion=$_POST['idsancion'];
                    $observaciones=$_POST['observaciones'];
                    $fecha=$_POST['dia'];
                    $hora=$_POST['hora'].':'.$_POST['minuto'];
                    $considerada=$_POST['considerada_como'];
                    $profesor=$_POST['profesor'];
                    $incitodas=$totinci;
                    
                    $stmt->execute();

                    $_SESSION['rowafected']=$stmt->affected_rows;

                    $stmt->close();                    
                }
            }else{//es grave
                $query="insert into partes (pa_codalu,pa_codinc,pa_codsan,pa_observ,pa_fechas,pa_horas,pa_consid,pa_codpro,pa_inctod) values (?,?,?,?,?,?,?,?,?)";
                $stmt= $this->mMysqli->prepare($query);
                $stmt->bind_param("iiissssss", $idalumno,$idincidencia,$idsancion,$observaciones,$fecha,$hora,$considerada,$profesor,$incitodas);

                $idalumno=$_POST['idalumno'];
                $idincidencia=$totinciarray[0];
                $idsancion=$_POST['idsancion'];
                $observaciones=$_POST['observaciones'];
                $fecha=$_POST['dia'];
                $hora=$_POST['hora'].':'.$_POST['minuto'];
                $considerada=$_POST['considerada_como'];
                $profesor=$_POST['profesor'];
                $incitodas=$totinci;
                
                $stmt->execute();

                $_SESSION['rowafected']=$stmt->affected_rows;

                $stmt->close();
            }
            return 'partesalumno.php?idalumno='.$_POST['idalumno'];
        }else{
            // If errors are found, save current user input
            foreach ($_POST as $key => $value){
                $_SESSION['values'][$key] = $_POST[$key];
            }
            return '../../../index.php?jefpar';
        }
    }
    
}
?>
