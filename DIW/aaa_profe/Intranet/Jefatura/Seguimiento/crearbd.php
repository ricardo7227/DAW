<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
   <title>Crear base de datos</title>
</head>
<body>
<br>
<?php
echo "Empezamos que no es poco<br>";
//									Conexión a MySQL
 $con = mysqli_connect("www.fpdaw.es", "fpdaw_es", "FaREv9eR") or
        die("No se pudo establecer la conexión con el servidor MySQL");
 echo "Conexión establecida.<br>";
//									Base de datos: basedatos
 echo "Procedo a crear la base de datos <br>";
 $sql = 'CREATE DATABASE basedatos';
 if (!mysqli_query($con, $sql)) {
     die ('No se puede crear la B.D. basedatos:' .
          mysqli_error($con));
 }
 echo "Base de datos creada <br>";
 $db = mysqli_select_db($con, 'basedatos');
 if (!$db) {
     die ('No se puede seleccionar la B.D. basedatos:' .
          mysqli_error($con));
 };
 echo "¡ Operación de selección perfecta !<br>";
//                                                                    	TABLA DE ROLES
 echo "Procedo a crear la tabla de roles<br>";
 $sql = "CREATE TABLE roles (ro_codigo tinyint(2)  NOT NULL, " .
                            "ro_descri varchar(50) NOT NULL, " .
                            "PRIMARY KEY (ro_codigo)) ENGINE = MYISAM;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de roles:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de roles<br>";
 $sql = "INSERT INTO roles (ro_codigo, ro_descri) VALUES (0, 'Usuario anónimo');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el rol 0:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el rol 0<br>";
 $sql = "INSERT INTO roles (ro_codigo, ro_descri) VALUES (10, 'Alumno genérico');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el rol 10:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el rol 10<br>";
 $sql = "INSERT INTO roles (ro_codigo, ro_descri) VALUES (20, 'Reservado: alumno de un departamento');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el rol 20:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el rol 20<br>";
 $sql = "INSERT INTO roles (ro_codigo, ro_descri) VALUES (30, 'Profesor genérico');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el rol 30:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el rol 30<br>";
 $sql = "INSERT INTO roles (ro_codigo, ro_descri) VALUES (40, 'Un profesor concreto');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el rol 40:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el rol 40<br>";
 $sql = "INSERT INTO roles (ro_codigo, ro_descri) VALUES (50, 'Profesor de un departamento concreto');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el rol 50:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el rol 50<br>";
 $sql = "INSERT INTO roles (ro_codigo, ro_descri) VALUES (60, 'Jefe de Departamento');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el rol 60:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el rol 60<br>";
 $sql = "INSERT INTO roles (ro_codigo, ro_descri) VALUES (65, 'Profesor que introduce partes de amonestación');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el rol 65:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el rol 65<br>";
 $sql = "INSERT INTO roles (ro_codigo, ro_descri) VALUES (70, 'Usuario de dirección');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el rol 70:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el rol 70<br>";
 $sql = "INSERT INTO roles (ro_codigo, ro_descri) VALUES (80, 'Un miembro concreto de la dirección');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el rol 80:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el rol 80<br>";
 $sql = "INSERT INTO roles (ro_codigo, ro_descri) VALUES (90, 'TIC');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el rol 90:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el rol 90<br>";
 $sql = "INSERT INTO roles (ro_codigo, ro_descri) VALUES (99, 'root');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el rol 99:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el rol 99<br>";
//									TABLA DE USUARIOS
 echo "Procedo a crear la tabla usuarios<br>";
 $sql = "CREATE TABLE usuarios (us_cuenta VARCHAR(30)  NOT NULL, " .
                               "us_codrol tinyint(2)   NOT NULL, " .
                               "us_contad mediumint(7) NOT NULL, " .
                               "us_varios varchar(32)  NOT NULL, " .
                               "PRIMARY KEY (us_cuenta), " .
                               "FOREIGN KEY (us_codrol) REFERENCES roles(ro_codigo)" .
                               ") ENGINE = MYISAM;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla usuarios:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de usuarios<br>";
 $sql = "INSERT INTO usuarios (us_cuenta, us_codrol, us_contad, us_varios) VALUES
                              ('11111', 10, 0, '".md5('11111')."');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el usuario 11111:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el usuario 11111<br>";
 $sql = "INSERT INTO usuarios (us_cuenta, us_codrol, us_contad, us_varios) VALUES
                              ('22222', 30, 0, '".md5('22222')."');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el usuario 22222:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el usuario 22222<br>";
 $sql = "INSERT INTO usuarios (us_cuenta, us_codrol, us_contad, us_varios) VALUES
                              ('33333', 70, 0, '".md5('33333')."');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el usuario 33333:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el usuario 33333<br>";
//									TABLA DE DEPARTAMENTOS
 echo "Procedo a crear la tabla de departamentos<br>";
 $sql = "CREATE TABLE departamentos (de_codigo VARCHAR(5)  NOT NULL, " .
                                    "de_descri VARCHAR(30) NOT NULL, " .
                                    "de_jefe   VARCHAR(5), " .
                                    "PRIMARY KEY (de_codigo), " .
                                    "FOREIGN KEY (de_jefe) REFERENCES profesores(pr_codigo)" .
                                    ") ENGINE = MYISAM;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla departamentos:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de departamentos<br>";
 $sql = "INSERT INTO departamentos (de_codigo, de_descri, de_jefe) VALUES ('INFOR', 'Informática', 'IF003');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el departamento de Informática:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el departamento de Informática<br>";
 $sql = "INSERT INTO departamentos (de_codigo, de_descri, de_jefe) VALUES ('AUTO', 'Automoción', 'MV3');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el departamento de Automoción:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el departamento de Automoción<br>";
 $sql = "INSERT INTO departamentos (de_codigo, de_descri, de_jefe) VALUES ('ELECA', 'Electricidad-Electrónica', 'EE1');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el departamento de Electricidad/Eca:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el departamento de Electricidad/Eca<br>";
 $sql = "INSERT INTO departamentos (de_codigo, de_descri, de_jefe) VALUES ('FRIO', 'Frio y calor', 'MM1');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el departamento de Frio y calor:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el departamento de Frio y calor<br>";
//									TABLA DE PROFESORES
 echo "Procedo a crear la tabla de profesores<br>";
 $sql = "CREATE TABLE profesores (pr_codigo VARCHAR(5)  NOT NULL, " .
                                 "pr_nombre VARCHAR(30) NOT NULL, " .
                                 "pr_apell1 VARCHAR(30), " .
                                 "pr_apell2 VARCHAR(30), " .
                                 "pr_direcc VARCHAR(50), " .
                                 "pr_poblac VARCHAR(50), " .
                                 "pr_provin VARCHAR(30), " .
                                 "pr_codpos VARCHAR(5),  " .
                                 "pr_telef1 VARCHAR(12), " .
                                 "pr_telef2 VARCHAR(12), " .
                                 "pr_email  VARCHAR(50), " .
                                 "pr_coddep VARCHAR(5), " .
                                 "pr_cuenta VARCHAR(30), " .
                                 "PRIMARY KEY (pr_codigo), " .
                                 "FOREIGN KEY (pr_coddep) REFERENCES departamentos(de_codigo), " .
                                 "FOREIGN KEY (pr_cuenta) REFERENCES usuarios(us_cuenta)" .
                                 ") ENGINE = MYISAM;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de profesores:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de profesores<br>";
 $sql = "INSERT INTO profesores (pr_codigo, pr_nombre, pr_coddep, pr_cuenta) VALUES
                                ('IF003', 'Carmen', 'INFOR', '22222');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta al profesor IF003:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el profesor IF003<br>";
 $sql = "INSERT INTO profesores (pr_codigo, pr_nombre, pr_coddep, pr_cuenta) VALUES
                                ('MV3', 'Eva', 'AUTO', '33333');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta al profesor MV3:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el profesor MV3<br>";
 $sql = "INSERT INTO profesores (pr_codigo, pr_nombre, pr_coddep) VALUES
                                ('EE1', 'Pepe', 'ELECA');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta al profesor EE1:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el profesor EE1<br>";
 $sql = "INSERT INTO profesores (pr_codigo, pr_nombre, pr_coddep) VALUES
                                ('MM1', 'Marcial', 'FRIO');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta al profesor MM1:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el profesor MM1<br>";
//									TABLA DE MOVIMIENTOS
 echo "Procedo a crear la tabla de movimientos<br>";
 $sql = "CREATE TABLE movimientos (mo_id SMALLINT(5) AUTO_INCREMENT, " .
                                  "mo_coddep VARCHAR(5), " .
                                  "mo_fecha  DATE, " .
                                  "mo_concep VARCHAR(50), " .
                                  "mo_import DECIMAL(10,2) NOT NULL, " .
                                  "mo_nummov INT(10), " .
                                  "PRIMARY KEY (mo_id), " .
                                  "FOREIGN KEY (mo_coddep) REFERENCES departamentos(de_codigo)" .
                                  ") ENGINE = MYISAM;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla movimientos:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de movimientos<br>";
 $sql = "INSERT INTO movimientos (mo_coddep, mo_fecha, mo_concep, mo_import, mo_nummov) VALUES " .
                                 "('INFOR', '2013-03-18', 'Compra de papel', 235, 5);";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el primer movimiento:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el primer movimiento<br>";
//									TABLA DE GRUPOS
 echo "Procedo a crear la tabla de grupos<br>";
 $sql = "CREATE TABLE grupos (gr_codigo VARCHAR(5) NOT NULL, " .
                             "gr_descri VARCHAR(50), " .
                             "gr_tutor1 VARCHAR(5), " .
                             "gr_delega INT(11), " .
                             "gr_subdel INT(11), " .
                             "PRIMARY KEY (gr_codigo), " .
                             "FOREIGN KEY (gr_tutor1) REFERENCES profesores(de_codigo), " .
                             "FOREIGN KEY (gr_delega, gr_subdel) REFERENCES alumnos(al_codigo, al_codigo)" .
                                  ") ENGINE = MYISAM;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de grupos:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de grupos<br>";
 $sql = "INSERT INTO grupos (gr_codigo, gr_descri) VALUES ('9521A', 'Administración de Sistemas Informáticos. Primer curso');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el grupo 9521A:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el grupo 9521A<br>";
 $sql = "INSERT INTO grupos (gr_codigo, gr_descri) VALUES ('9531A', 'Desarrollo de Aplicaciones Web. Segundo curso');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el grupo 9531A:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el grupo 9531A<br>";
//									TABLA DE ASIGNATURAS
 echo "Procedo a crear la tabla de asignaturas<br>";
 $sql = "CREATE TABLE asignaturas (as_codigo VARCHAR(5) NOT NULL, " .
                                  "as_descri VARCHAR(50), " .
                                  "PRIMARY KEY (as_codigo)) ENGINE = MYISAM;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de asignaturas:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de asignaturas<br>";
 $sql = "INSERT INTO asignaturas (as_codigo, as_descri) VALUES ('MATES', 'Matemáticas');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la asignatura MATES:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la asignatura MATES<br>";
 $sql = "INSERT INTO asignaturas (as_codigo, as_descri) VALUES ('ISO', 'Implantación de Sistemas Op.');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la asignatura ISO:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la asignatura ISO<br>";
//									TABLA DE ALUMNOS
 echo "Procedo a crear la tabla de alumnos<br>";
 $sql = "CREATE TABLE alumnos (al_codigo INT(11) NOT NULL, " .
                              "al_codgru VARCHAR(5), " .
                              "al_nombre VARCHAR(30) NOT NULL, " .
                              "al_apell1 VARCHAR(30), " .
                              "al_apell2 VARCHAR(30), " .
                              "al_direcc VARCHAR(50), " .
                              "al_poblac VARCHAR(50), " .
                              "al_provin VARCHAR(30), " .
                              "al_codpos VARCHAR(5),  " .
                              "al_telef1 VARCHAR(12), " .
                              "al_telef2 VARCHAR(12), " .
                              "al_email  VARCHAR(50), " .
                              "al_cuenta VARCHAR(30), " .
                              "PRIMARY KEY (al_codigo), " .
                              "FOREIGN KEY (al_codgru) REFERENCES grupos(gr_codigo), " .
                              "FOREIGN KEY (al_cuenta) REFERENCES usuarios(us_cuenta)" .
                              ") ENGINE = MYISAM;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de alumnos:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de alumnos<br>";
 $sql = "INSERT INTO alumnos (al_codigo, al_codgru, al_nombre, al_cuenta) VALUES
                             (10231, '9521A', 'Antonio', '11111');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta al alumno 10231:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el alumno 10231<br>";
 $sql = "INSERT INTO alumnos (al_codigo, al_codgru, al_nombre) VALUES (10232, '9531A', 'Sebastián');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta al alumno 10232:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el alumno 10232<br>";
//									TABLA DE SEGUIMIENTO
 echo "Procedo a crear la tabla de seguimiento<br>";
 $sql = "CREATE TABLE seguimiento (se_id     MEDIUMINT(8) AUTO_INCREMENT, " .
                                  "se_coddep VARCHAR(5) NOT NULL, " .
                                  "se_codpro VARCHAR(5) NOT NULL, " .
                                  "se_codasi VARCHAR(5) NOT NULL, " .
                                  "se_codgru VARCHAR(5) NOT NULL, " .
                                  "se_descri VARCHAR(1000) NOT NULL, " .
                                  "se_fechoy TIMESTAMP, " .
                                  "PRIMARY KEY (se_id), " .
                                  "FOREIGN KEY (se_coddep) REFERENCES departamentos(de_codigo), " .
                                  "FOREIGN KEY (se_codpro) REFERENCES profesores(pr_codigo), " .
                                  "FOREIGN KEY (se_codasi) REFERENCES asignaturas(as_codigo), " .
                                  "FOREIGN KEY (se_codgru) REFERENCES grupos(gr_codigo)" .
                                  ") ENGINE = MYISAM;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de seguimiento:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de seguimiento<br>";
 $sql = "INSERT INTO seguimiento (se_coddep, se_codpro, se_codasi, se_codgru, se_descri) VALUES
                                 ('INFOR', 'IF003', 'ISO', '9521A', 'Voy por el tema 12');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta un registro de seguimiento:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta un registro de seguimiento<br>";
//									TABLA DE INCIDENCIAS
 echo "Procedo a crear la tabla de incidencias<br>";
 $sql = "CREATE TABLE incidencias (in_id     INT(11) AUTO_INCREMENT, " .
                                  "in_descri VARCHAR(255) NOT NULL, " .
                                  "PRIMARY KEY (in_id)) ENGINE = MYISAM;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de incidencias:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de incidencias<br>";
 $sql = "INSERT INTO incidencias (in_descri) VALUES ('Fumar dentro del aula');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta un registro de incidencias:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta un registro de incidencias<br>";
 $sql = "INSERT INTO incidencias (in_descri) VALUES ('Romper intencionadamente mobiliario');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta un registro de incidencias:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta un registro de incidencias<br>";
//									TABLA DE SANCIONES
 echo "Procedo a crear la tabla de sanciones<br>";
 $sql = "CREATE TABLE sanciones (sa_id     INT(11) AUTO_INCREMENT, " .
                                "sa_descri VARCHAR(255) NOT NULL, " .
                                "PRIMARY KEY (sa_id)) ENGINE = MYISAM;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de sanciones:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de sanciones<br>";
 $sql = "INSERT INTO sanciones (sa_descri) VALUES ('Expulsión de tres dias');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta un registro de sanciones:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta un registro de sanciones<br>";
 $sql = "INSERT INTO sanciones (sa_descri) VALUES ('Expulsión de cinco dias');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta un registro de sanciones:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta un registro de sanciones<br>";
//									TABLA DE PARTES
 echo "Procedo a crear la tabla de partes<br>";
 $sql = "CREATE TABLE partes (pa_id     INT(11) AUTO_INCREMENT, " .
			     "pa_codalu INT(11) NOT NULL, " .
                             "pa_codinc INT(11) NOT NULL, " .
                             "pa_inctod VARCHAR(100) DEFAULT NULL, " .
                             "pa_codsan INT(11) NOT NULL, " .
                             "pa_observ TEXT, " .
                             "pa_fechas DATE NOT NULL, " .
                             "pa_horas  TIME NOT NULL, " .
                             "pa_consid VARCHAR(1) NOT NULL, " .
                             "pa_tareas VARCHAR(255) DEFAULT NULL, " .
                             "pa_aulatr VARCHAR(45) DEFAULT NULL, " .
                             "pa_asocia INT(11) DEFAULT NULL, " .
                             "pa_fechor VARCHAR(15) DEFAULT NULL, " .
                             "pa_codpro VARCHAR(5) DEFAULT NULL, " .
                             "PRIMARY KEY (pa_id), " .
                             "FOREIGN KEY (pa_codalu) REFERENCES alumnos(al_codigo), " .
                             "FOREIGN KEY (pa_codinc) REFERENCES incidencias(in_id), " .
                             "FOREIGN KEY (pa_codsan) REFERENCES sanciones(sa_id), " .
                             "FOREIGN KEY (pa_codpro) REFERENCES profesores(pr_codigo)" .
                             ") ENGINE = MYISAM;";

 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de partes:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de partes<br>";
 $sql = "INSERT INTO partes (pa_codalu, pa_codinc, pa_inctod, pa_codsan, pa_observ, pa_fechas, pa_horas, " .
                            "pa_consid, pa_tareas, pa_aulatr, pa_codpro) VALUES " .
                            "(10231, 1, '1,0', 1, 'Observación escrita por el profe', '2013-04-21', '12:10:21', " .
                            "'L', 'Escribir bla, bla, ...', 'Aula 01', 'IF003');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta un parte:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta un parte<br>";
 $sql = "INSERT INTO partes (pa_codalu, pa_codinc, pa_inctod, pa_codsan, pa_observ, pa_fechas, pa_horas, " .
                            "pa_consid, pa_tareas, pa_aulatr, pa_codpro) VALUES " .
                            "(10232, 2, '1,2,0', 2, 'Se subía por las paredes', '2013-04-21', '12:10:21', " .
                            "'G', 'Venir a estudiar', 'Biblioteca', 'MV3');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta un parte:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta un parte<br>";
//									TABLA DE MENUS
 echo "Procedo a crear la tabla de menus<br>";
 $sql = "CREATE TABLE menus (me_codigo int(6) NOT NULL, " .
							"me_idpadre  int(6) NOT NULL, " .
                            "me_texto_es  VARCHAR(20) NOT NULL, " .
							"me_texto_en  VARCHAR(20) NOT NULL, " .
                            "me_codrol TINYINT(2) NOT NULL, " .
                            "me_descri VARCHAR(30), " .
                            "me_enlace_es VARCHAR(50) NOT NULL, " .
							"me_enlace_en VARCHAR(50) NOT NULL, " .
                            "me_target VARCHAR(40) NOT NULL, " .
                            "PRIMARY KEY (me_codigo), " .
                            "FOREIGN KEY (me_codrol) REFERENCES roles(ro_codigo)" .
                            ") ENGINE = MYISAM;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de menus:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de menus<br>";
 $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (1, 0,'INICIO','HOME', 0, 'Home del sitio Web', 'index.php', 'index_en.php', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción INICIO:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción INICIO<br>";
 $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (2, 0,'DIRECCIÓN','HEADSHIP', 0, 'Publicaciones de la dirección', 'index.php?dir', 'index_en.php?dir', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción DIRECCIÓN:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción DIRECCIÓN<br>";
 $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (3, 0,'JEFATURA','HEAD OF STUDIES', 0, 'Publicaciones de Jefatura', 'index.php?jef', 'index_en.php?jef', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción JEFATURA:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción JEFATURA<br>";
 $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (4, 0,'ADMINISTRACIÓN','ADMINISTRATION', 0, 'Publicaciones de gestión económica', 'index.php?adm', 'index_en.php?adm', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción ADMINISTRACIÓN:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción ADMINISTRACIÓN<br>";
 $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (5, 0,'DEPARTAMENTOS','DEPARTMENTS', 0, 'Publicaciones de los departamentos', 'index.php?dep', 'index_en.php?dep', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción DEPARTAMENTOS:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción DEPARTAMENTOS<br>";
 $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (6, 0,'ALUMNOS','STUDENTS', 0, 'Publicaciones de los alumnos', 'index.php?alu', 'index_en.php?alu', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción ALUMNOS:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción ALUMNOS<br>";
 $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (7, 0,'AMPA','AMPA', 0, 'Publicaciones del AMPA', 'index.php?amp', 'index_en.php?amp', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción AMPA:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción AMPA<br>";
 $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (8, 0,'TIC','TIC', 0, 'Operaciones relacionadas con el TIC', 'index.php?tic', 'index_en.php?tic', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción TIC:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción TIC<br>";
 $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (9, 1,'Inicio','Home', 0, 'Página HOME', 'index.php', 'index_en.php', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción INICIO-Inicio:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción INICIO-Inicio<br>";
 $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (10, 1,'Contactar','Contact', 0, 'Información de contacto', 'index.php?inicon', 'index_en.php?inicon', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción INICIO-Contactar:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción INICIO-Contactar<br>";
  $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (11, 1,'Enseñanzas','Teachings', 0, 'Información de enseñanzas', 'index.php?iniens', 'index_en.php?iniens', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción INICIO-Enseñanzas:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción INICIO-Enseñanzas<br>";
  $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (12, 1,'Secretaría','Secretary\'s Office', 0, 'Información de secretaría', 'index.php?inisec', 'index_en.php?inisec', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción INICIO-Secretaría:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción INICIO-Secretaría<br>";
  $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (13, 2,'Inicio','Home', 0, 'Inicio de Dirección', 'index.php?dir', 'index_en.php?dir', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción DIRECCIÓN-Inicio:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción DIRECCIÓN-Inicio<br>";
   $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (14, 2,'Equipo Directivo','Leadership Team', 0, 'Información del equipo directivo', 'index.php?direqu', 'index_en.php?direqu', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción DIRECCIÓN-Equipo Directivo:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción DIRECCIÓN-Equipo Directivo<br>";
   $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (15, 2,'Consejo Escolar','School Council', 0, 'Información del consejo escolar', 'index.php?dircon', 'index_en.php?dircon', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción DIRECCIÓN-Consejo Escolar:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción DIRECCIÓN-Consejo Escolar<br>";
   $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (16, 4,'Inicio','Home', 0, 'Inicio de Administración', 'index.php?adm', 'index_en.php?adm', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción ADMINISTRACIÓN-Inicio:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción ADMINISTRACIÓN-Inicio<br>";
   $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (17, 4,'Saldo','Balance', 0, 'Información de saldos', 'index.php?admsal', 'index_en.php?admsal', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción ADMINISTRACIÓN-Saldos:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción ADMINISTRACIÓN-Saldos<br>";
   $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (18, 4,'Movimientos','Movements', 0, 'Información de movimientos', 'index.php?admmov', 'index_en.php?admmov', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción ADMINISTRACIÓN-Movimientos:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción ADMINISTRACIÓN-Movimientos<br>";
   $sql = "INSERT INTO menus (me_codigo, me_idpadre, me_texto_es, me_texto_en, me_codrol, me_descri, me_enlace_es, me_enlace_en, me_target) VALUES
                                 (19, 4,'Dietas','Allowances', 0, 'Información de dietas', 'index.php?admdie', 'index_en.php?admdie', '_self');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la opción ADMINISTRACIÓN-Inicio:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la opción ADMINISTRACIÓN-Inicio<br>";
//									TABLA DE RECURSOS_TIC
 echo "Procedo a crear la tabla de recursos gestionados por el TIC<br>";
 $sql = "CREATE TABLE recursos_tic (re_codigo VARCHAR(10) NOT NULL, " .
                                   "re_descor VARCHAR(100) NOT NULL, " .
                                   "re_deslar VARCHAR(1000), " .
                                   "re_locali VARCHAR(100), " .
                                   "PRIMARY KEY (re_codigo)" .
                                   ") ENGINE = MYISAM;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de recursos:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de recursos<br>";
 $sql = "INSERT INTO recursos_tic (re_codigo, re_descor, re_deslar, re_locali) VALUES " .
                                 "('AULACAF', 'Aula de ordenadores', 'Aula con 17 ordenadores que ...', " .
                                 "'Edificio C Planta primera');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el aula de ordenadores:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el aula de ordenadores<br>";
 $sql = "INSERT INTO recursos_tic (re_codigo, re_descor, re_deslar, re_locali) VALUES " .
                                 "('ORD-BIB-01', 'Ordenador 01 de la biblioteca', 'Marca, modelo, IP ...', " .
                                 "'Edificio A Planta baja. Biblioteca');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta un ordenador:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta un ordenador<br>";
 
//									TABLA DE DENEGADOS
 echo "Procedo a crear la tabla de denegados<br>";
 $sql = "CREATE TABLE denegados (de_codigo INT(5) NOT NULL AUTO_INCREMENT, " .
                                   "de_cuenta VARCHAR(30) NOT NULL, " .
                                   "de_varios VARCHAR(32), " .
                                   "de_ip VARCHAR(32), " .
                                   "PRIMARY KEY (de_codigo)" .
                                   ") ENGINE = MYISAM;";
if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de denegados:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de denegados<br>";
								   
//									TABLA DE RESERVAS_TIC (Proximamente)
//									TABLA DE INCIDENCIAS_TIC (Proximamente)
?>
</body>
</html>

