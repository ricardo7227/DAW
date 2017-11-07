/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import model.Alumno;
import java.math.BigInteger;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import java.util.ArrayList;
import java.sql.Date;
import java.sql.PreparedStatement;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.naming.Context;
import javax.naming.InitialContext;
import javax.sql.DataSource;

import org.apache.commons.dbutils.QueryRunner;
import org.apache.commons.dbutils.ResultSetHandler;
import org.apache.commons.dbutils.handlers.BeanHandler;
import org.apache.commons.dbutils.handlers.BeanListHandler;
import org.apache.commons.dbutils.handlers.ScalarHandler;

import utils.SqlQuery;

/**
 *
 * @author oscar
 */
public class AlumnosDAO {

    public List<Alumno> getAllAlumnos() {
        List<Alumno> lista = null;
        DBConnection db = new DBConnection();
        Connection con = null;
        try {
            con = db.getConnection();
            QueryRunner qr = new QueryRunner();
            ResultSetHandler<List<Alumno>> h
                    = new BeanListHandler<Alumno>(Alumno.class);
            lista = qr.query(con, "select * FROM ALUMNOS", h);

        } catch (Exception ex) {
            Logger.getLogger(AlumnosDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            db.cerrarConexion(con);
        }
        return lista;
    }

    public List<Alumno> getAllAlumnosJDBC() {
        List<Alumno> lista = new ArrayList<>();
        Alumno nuevo = null;
        DBConnection db = new DBConnection();
        Connection con = null;
        Statement stmt = null;
        ResultSet rs = null;
        try {
            con = db.getConnection();
            stmt = con.createStatement();
            //String sql;
            //sql = "SELECT * FROM ALUMNOS";
            rs = stmt.executeQuery(SqlQuery.SELECT_ALL_ALUMNOS);

            //STEP 5: Extract data from result set
            while (rs.next()) {
                //Retrieve by column name
                int id = rs.getInt(SqlQuery.ID);
                String nombre = rs.getString(SqlQuery.NOMBRE);
                Date fn = rs.getDate(SqlQuery.FECHA_NACIMIENTO);
                Boolean mayor = rs.getBoolean(SqlQuery.MAYOR_EDAD);
                nuevo = new Alumno();
                nuevo.setFecha_nacimiento(fn);
                nuevo.setId(id);
                nuevo.setMayor_edad(mayor);
                nuevo.setNombre(nombre);
                lista.add(nuevo);
            }

        } catch (Exception ex) {
            Logger.getLogger(AlumnosDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            try {
                if (rs != null) {
                    rs.close();
                }
                if (stmt != null) {
                    stmt.close();
                }
            } catch (SQLException ex) {
                Logger.getLogger(AlumnosDAO.class.getName()).log(Level.SEVERE, null, ex);
            }

            db.cerrarConexion(con);
        }
        return lista;

    }

    public Alumno getUserById(int id) {
        Alumno user = null;
        DBConnection db = new DBConnection();

        Connection con = null;
        try {
            Context ctx = new InitialContext();
            DataSource ds = (DataSource) ctx.lookup("jdbc/db4free");
            con = ds.getConnection();
            QueryRunner qr = new QueryRunner();
            ResultSetHandler<Alumno> h
                    = new BeanHandler<>(Alumno.class);
            user = qr.query(con, "select * FROM ALUMNOS where ID = ?", h, id);
        } catch (Exception ex) {
            Logger.getLogger(AlumnosDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            db.cerrarConexion(con);
        }
        return user;
    }

    public Alumno getUser(Alumno userOriginal) {
        Alumno user = null;
        DBConnection db = new DBConnection();
        Connection con = null;
        try {
            con = db.getConnection();
            QueryRunner qr = new QueryRunner();
            ResultSetHandler<Alumno> h
                    = new BeanHandler<>(Alumno.class);
            user = qr.query(con, "select * FROM LOGIN where USER = ?", h, userOriginal.getNombre());
        } catch (Exception ex) {
            Logger.getLogger(AlumnosDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            db.cerrarConexion(con);
        }
        return user;
    }

    public void delUser(Alumno u) {
        DBConnection db = new DBConnection();
        Connection con = null;
        try {
            con = db.getConnection();
            QueryRunner qr = new QueryRunner();

            int filas = qr.update(con,
                    "DELETE FROM LOGIN WHERE ID=?",
                    u.getId());

        } catch (Exception ex) {
            Logger.getLogger(AlumnosDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            db.cerrarConexion(con);
        }
    }

    public void updateUserJDBC(Alumno alumno) {
        DBConnection dBConnection = new DBConnection();
        Connection connection = null;

        PreparedStatement stmt = null;
        try {
            connection = dBConnection.getConnection();

            stmt = connection.prepareStatement(SqlQuery.UPDATE_ALUMNO);

            stmt.setString(1, alumno.getNombre());
            stmt.setDate(2, new java.sql.Date(alumno.getFecha_nacimiento().getTime()));
            stmt.setBoolean(3, alumno.getMayor_edad());
            stmt.setInt(4, (int) alumno.getId());

            stmt.executeUpdate();

        } catch (Exception e) {
            Logger.getLogger(AlumnosDAO.class.getName()).log(Level.SEVERE, null, e);
        } finally {
            try {
                if (stmt != null) {
                    stmt.close();
                }
            } catch (SQLException ex) {
                Logger.getLogger(AlumnosDAO.class.getName()).log(Level.SEVERE, null, ex);
            }

            dBConnection.cerrarConexion(connection);
        }

    }//fin update

    public void updateUser(Alumno u) {
        DBConnection db = new DBConnection();
        Connection con = null;
        try {
            con = db.getConnection();
            QueryRunner qr = new QueryRunner();

            int filas = qr.update(con,
                    "UPDATE LOGIN SET MAIL=? WHERE USER=?",
                    "", "");

        } catch (Exception ex) {
            Logger.getLogger(AlumnosDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            db.cerrarConexion(con);
        }
    }

    public boolean insertUserJDBC(Alumno alumno) {
        DBConnection dBConnection = new DBConnection();
        Connection connection = null;
        boolean insertado = false;
        PreparedStatement stmt = null;
        try {
            connection = dBConnection.getConnection();

            stmt = connection.prepareStatement(SqlQuery.INSERT_ALUMNO, Statement.RETURN_GENERATED_KEYS);

            stmt.setString(1, alumno.getNombre());
            stmt.setDate(2, new java.sql.Date(alumno.getFecha_nacimiento().getTime()));
            stmt.setBoolean(3, alumno.getMayor_edad());

            if (stmt.executeUpdate() > 0) {
                insertado = Boolean.TRUE;
            }

        } catch (Exception e) {
            Logger.getLogger(AlumnosDAO.class.getName()).log(Level.SEVERE, null, e);
        } finally {
            try {
                if (stmt != null) {
                    stmt.close();
                }
            } catch (SQLException ex) {
                Logger.getLogger(AlumnosDAO.class.getName()).log(Level.SEVERE, null, ex);
            }

            dBConnection.cerrarConexion(connection);

        }
        return insertado;

    }//fin update

    public Alumno addUser(Alumno u, String activacion) {
        DBConnection db = new DBConnection();
        Connection con = null;

        try {
            con = db.getConnection();
            con.setAutoCommit(false);
            QueryRunner qr = new QueryRunner();

            BigInteger id = qr.insert(con,
                    "INSERT INTO LOGIN (USER,PASSWORD,MAIL,ACTIVACION,ACTIVO,FECHA_RENOVACION) VALUES(?,?,?,?,?,now())",
                    new ScalarHandler<BigInteger>(),
                    "", "", "", activacion, 0);

            u.setId(id.longValue());
            con.commit();

        } catch (Exception ex) {
            Logger.getLogger(AlumnosDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            db.cerrarConexion(con);
        }
        return u;

    }

    public void deleteUserByIdJDBC(String key) {
        DBConnection dBConnection = new DBConnection();
        Connection connection = null;

        PreparedStatement stmt = null;
        try {
            connection = dBConnection.getConnection();

            stmt = connection.prepareStatement(SqlQuery.DELETE_ALUMNO, Statement.RETURN_GENERATED_KEYS);

            stmt.setInt(1, Integer.valueOf(key));

            stmt.executeUpdate();

        } catch (Exception e) {
            Logger.getLogger(AlumnosDAO.class.getName()).log(Level.SEVERE, null, e);
        } finally {
            try {
                if (stmt != null) {
                    stmt.close();
                }
            } catch (SQLException ex) {
                Logger.getLogger(AlumnosDAO.class.getName()).log(Level.SEVERE, null, ex);
            }

            dBConnection.cerrarConexion(connection);
        }

    }

}
