/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import java.math.BigDecimal;


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
import model.Coche;

import org.apache.commons.dbutils.QueryRunner;

import utils.ConstantesError;

import utils.SqlQuery;

/**
 *
 * @author oscar
 */
public class CochesDAO {

    public List<Coche> getAllCochesJDBC() {
        List<Coche> lista = new ArrayList<>();
        Coche nuevo = null;

        Connection con = null;
        Statement stmt = null;
        ResultSet rs = null;
        try {
            con = DBConnection.getInstance().getConnection();
            stmt = con.createStatement();

            rs = stmt.executeQuery(SqlQuery.SELECT_ALL_COCHES);

            //STEP 5: Extract data from result set
            while (rs.next()) {
                //Retrieve by column name
                int id = rs.getInt(SqlQuery.ID);
                String nombre = rs.getString(SqlQuery.NOMBRE);
                Date fn = rs.getDate(SqlQuery.FECHA_NACIMIENTO);
                Boolean mayor = rs.getBoolean(SqlQuery.MAYOR_EDAD);
                nuevo = new Coche();
                nuevo.setCoche(nombre);
                nuevo.setId(id);
                
                lista.add(nuevo);
            }

        } catch (Exception ex) {
            Logger.getLogger(CochesDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            try {
                if (rs != null) {
                    rs.close();
                }
                if (stmt != null) {
                    stmt.close();
                }
            } catch (SQLException ex) {
                Logger.getLogger(CochesDAO.class.getName()).log(Level.SEVERE, null, ex);
            }

            DBConnection.getInstance().cerrarConexion(con);
        }
        return lista;

    }

    public boolean updateCocheJDBC(Coche coche) {
        boolean updated = false;
        Connection connection = null;

        PreparedStatement stmt = null;
        try {
            connection = DBConnection.getInstance().getConnection();

            stmt = connection.prepareStatement(SqlQuery.UPDATE_ALUMNO);

            stmt.setString(1, coche.getCoche());
            stmt.setDate(2, new java.sql.Date(coche.getFecha_compra().getTime()));
            
            stmt.setInt(4, (int) coche.getId());

            if (stmt.executeUpdate() > 0) {
                updated = Boolean.TRUE;
            }
        } catch (Exception e) {
            Logger.getLogger(CochesDAO.class.getName()).log(Level.SEVERE, null, e);
        } finally {
            try {
                if (stmt != null) {
                    stmt.close();
                }
            } catch (SQLException ex) {
                Logger.getLogger(CochesDAO.class.getName()).log(Level.SEVERE, null, ex);
            }

            DBConnection.getInstance().cerrarConexion(connection);
        }
        return updated;
    }//fin update

    public boolean insertCocheJDBC(Coche coche) {
        Connection connection = null;
        boolean insertado = false;
        PreparedStatement stmt = null;
        ResultSet rs = null;
        try {
            connection = DBConnection.getInstance().getConnection();

            stmt = connection.prepareStatement(SqlQuery.INSERT_ALUMNO, Statement.RETURN_GENERATED_KEYS);

            stmt.setString(1, coche.getCoche());
            stmt.setDate(2, new java.sql.Date(coche.getFecha_compra().getTime()));
            

            if (stmt.executeUpdate() > 0) {
                insertado = Boolean.TRUE;
            }
            rs = stmt.getGeneratedKeys();
            while (rs.next()) {
                BigDecimal bd = rs.getBigDecimal(1);
                coche.setId(bd.longValue());
            }

        } catch (Exception e) {
            Logger.getLogger(CochesDAO.class.getName()).log(Level.SEVERE, null, e);
        } finally {
            try {
                if (stmt != null) {
                    stmt.close();
                }
            } catch (SQLException ex) {
                Logger.getLogger(CochesDAO.class.getName()).log(Level.SEVERE, null, ex);
            }

            DBConnection.getInstance().cerrarConexion(connection);

        }
        return insertado;

    }//fin insert

    public int deleteCocheByIdJDBC(String key) {

        int filasErased = -1;
        Connection connection = null;

        PreparedStatement stmt = null;
        try {
            connection = DBConnection.getInstance().getConnection();;

            stmt = connection.prepareStatement(SqlQuery.DELETE_ALUMNO, Statement.RETURN_GENERATED_KEYS);

            stmt.setInt(1, Integer.valueOf(key));

            filasErased = stmt.executeUpdate();

        } catch (Exception e) {

            if (e.getMessage().contains(ConstantesError.errorForeingkey)) {
                filasErased = ConstantesError.CodeErrorClaveForanea;
            }
            Logger.getLogger(CochesDAO.class.getName()).log(Level.SEVERE, null, e);
        } finally {
            try {
                if (stmt != null) {
                    stmt.close();
                }
            } catch (SQLException ex) {
                Logger.getLogger(CochesDAO.class.getName()).log(Level.SEVERE, null, ex);
            }

            DBConnection.getInstance().cerrarConexion(connection);
        }
        return filasErased;
    }

    //DELETE_FORCE
    public boolean deleteCocheByIddbUtils(int key) throws SQLException {

        int filasNota = -1;
        int filasAlumno = -1;
        boolean borrado = Boolean.FALSE;

        Connection con = null;

        try {
            con = DBConnection.getInstance().getConnection();
            con.setAutoCommit(Boolean.FALSE);
            QueryRunner qr = new QueryRunner();

            filasNota = qr.update(con,
                    SqlQuery.DELETE_NOTA_ALUMNO,
                    key);
            filasAlumno = qr.update(con,
                    SqlQuery.DELETE_ALUMNO,
                    key);

            if (filasNota > 0 && filasAlumno > 0) {
                borrado = Boolean.TRUE;
                con.commit();
            } else {
                con.rollback();
            }

        } catch (Exception ex) {
            if (con != null) {
                con.rollback();
            }

            Logger.getLogger(CochesDAO.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            DBConnection.getInstance().cerrarConexion(con);
        }
        return borrado;

    }

}//fin clase
