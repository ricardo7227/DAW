var xmlHttp = createXmlHttpRequestObject();
// retrieves the XMLHttpRequest object
function createXmlHttpRequestObject(){
// will store the reference to the XMLHttpRequest object
    var xmlHttp;
    // if running Internet Explorer
    if(window.ActiveXObject){
        try{
         xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (e){
            xmlHttp = false;
        }
    }else{
        try
        {
        xmlHttp = new XMLHttpRequest();
        }
        catch (e)
        {
        xmlHttp = false;
        }
    }
    // return the created object or display an error message
    if (!xmlHttp)
        alert("Error creating the XMLHttpRequest object.");
    else
        return xmlHttp;
}
function eliminaralumno() {
    var r=confirm("¿Seguro de eliminar al alumno?");
    if ( r==true){
        document.getElementById("quiereborrar").value=1;
        document.getElementById("formalta").submit();
    }else{
        return;
    }
}
function updateAlumno(){    
    self.location='updatealumno.php?idalumno=' + document.getElementById("Field35").value;
}
function altaalumno(){
    //comprueba obligatorios curso,nombre, appelido1, telef.1
    nombre = encodeURIComponent(document.getElementById("nombre").value);
    apellido1 = encodeURIComponent(document.getElementById("apellido1").value);
    apellido2 = encodeURIComponent(document.getElementById("apellido2").value);
    telf1 = encodeURIComponent(document.getElementById("telf1").value);
    
    if ( nombre == "" || nombre==null){alert('Nombre Obligatorio');return;}
    if ( apellido1 == "" || apellido1==null){alert('Apellido1 Obligatorio');return;}
    if ( apellido2 == "" || apellido2==null){alert('Apellido2 Obligatorio');return;}
    if ( telf1 == "" || telf1==null){alert('Al menos un telefono');return;}
    
    document.getElementById("formalta").submit();
}
function checkleves() {
    // proceed only if the xmlHttp object isn't busy
    tipoFalta=encodeURIComponent(document.getElementById("tipoFalta").value);
    
    if ( tipoFalta == "L") {
        if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0){

            // retrieve the name typed by the user on the form
            idalumno = encodeURIComponent(document.getElementById("Field35").value);
            // execute the quickstart.php page from the server   
            xmlHttp.open("GET", "checkleves.php?idalumno=" + idalumno, true);
            // define the method to handle server responses
            xmlHttp.onreadystatechange = handleServerResponse_x_leves;
            // make the server request
            xmlHttp.send(null);
        }
        else{
            // if the connection is busy, try again after one second
            //setTimeout('alumnos()', 1000);
            alert('Servidor ocupado');
        }  
    }else{
        document.getElementById("alertasfalta").innerHTML="";
    }
}
function handleServerResponse_x_leves(){
    
// move forward only if the transaction has completed
    if (xmlHttp.readyState == 4){
        // status of 200 indicates the transaction completed successfully
        if (xmlHttp.status == 200){  
            
            // extract the XML retrieved from the server
            xmlResponse = xmlHttp.responseXML;
            
            // obtain the document element (the root element) of the XML structure
            xmlDocumentElement = xmlResponse.documentElement;
            listaFaltas=xmlDocumentElement.firstChild.data;
            // get the text message, which is in the first child of
            // the the document element           
            //listaAlumnos = xmlDocumentElement.firstChild.data;              
            // update the client display using the data received from the server
            document.getElementById("alertasfalta").innerHTML ="<strong>"+listaFaltas+"</strong>";            
            
        }else{
            alert("There was a problem accessing the server: " + xmlHttp.statusText);
        }
    }
}

function alumnos(curso){
    // proceed only if the xmlHttp object isn't busy
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0){
        // retrieve the name typed by the user on the form
        name = encodeURIComponent(document.getElementById("Field25").value);
        // execute the quickstart.php page from the server      
        xmlHttp.open("GET", "alumnos.php?curso=" + curso, true);
        // define the method to handle server responses
        xmlHttp.onreadystatechange = handleServerResponse;
        // make the server request
        xmlHttp.send(null);
    }
    else{
        // if the connection is busy, try again after one second
        //setTimeout('alumnos()', 1000);
        alert('Servidor ocupado');
    }
}

function verParteAlumno(){
    self.location="partesalumno.php?idalumno=" + encodeURIComponent(document.getElementById("Field35").value);
}
function handleServerResponse(){

// move forward only if the transaction has completed
    if (xmlHttp.readyState == 4){
        // status of 200 indicates the transaction completed successfully
        if (xmlHttp.status == 200){  
            
            // extract the XML retrieved from the server
            xmlResponse = xmlHttp.responseXML;
            
            // obtain the document element (the root element) of the XML structure
            xmlDocumentElement = xmlResponse.documentElement;
            listaAlumnos=toCombo(xmlDocumentElement);
            // get the text message, which is in the first child of
            // the the document element           
            //listaAlumnos = xmlDocumentElement.firstChild.data;              
            // update the client display using the data received from the server
            document.getElementById("divAlumnos").innerHTML =listaAlumnos;            
            document.getElementById("informepartes").disabled=false;
            document.getElementById("updatealumno").disabled=false;
        }else{
            alert("There was a problem accessing the server: " + xmlHttp.statusText);
        }
    }
}

function toCombo(myXml){
    var display='<select id="Field35" name="idalumno" class="field select medium" tabindex="3">';
    
    myOptions=myXml.getElementsByTagName("option");    
    for (var i=0;i<myOptions.length;i++){        
        display+= "<option value='" + myOptions.item(i).getAttribute('value') + "'>" + myOptions.item(i).firstChild.nodeValue + "</option>";
    }
    display+="</select>";
    return (display);
    
}