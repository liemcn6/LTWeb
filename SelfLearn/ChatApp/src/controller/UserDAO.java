/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controller;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
import model.User;

/**
 *
 * @author DELL
 */
public class UserDAO {

    private String jdbcURL = "jdbc:mysql://localhost:3306/demo?useSSL=false";
    private String jdbcUsername = "root";
    private String jdbcPassword = "root";
    private static final String INSERT_USER_SQL = "INSERT INTO user" + " (firstName,midName,lastName,birthDay,age,gender) VALUES " +" (?, ?, ?, ?, ?, ?);";
 private static final String SELECT_USER_BY_ID = "select id,firstName,midName,lastName,birthDay,age,gender from user where id =  ?";
 private static final String SELECT_ALL_USER = "select * from user";
    private static final String DELETE_USER_SQL = "delete from user where id = ?;";
   private static final String UPDATE_USER_SQL = "update user set firstName = ?,midName = ?,lastName  =  ?,birthDay = ?,age = ?,gender = ? where  id =  ?;";
 
   
   public UserDAO() {
    }

    protected Connection getConnection() {
        Connection connection = null;
        try {
            Class.forName("com.mysql.jdbc.Driver");
            connection = DriverManager.getConnection(jdbcURL, jdbcUsername,
                    jdbcPassword);
        } catch (SQLException e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        } catch (ClassNotFoundException e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        }
        return connection;
    }

    public void insertUser(User user) throws SQLException {
        System.out.println(INSERT_USER_SQL);
        // try-with-resource statement will auto close the connection.
        try (Connection connection = getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(INSERT_USER_SQL)) {
            preparedStatement.setString(1, user.getFirstName());
            preparedStatement.setString(2, user.getMidName());
            preparedStatement.setString(3, user.getLastName());
            preparedStatement.setString(4, user.getBirthDay());
            preparedStatement.setInt(5, user.getAge());
            preparedStatement.setBoolean(6, user.isGender());
            //preparedStatement.setBoolean(7, user.isIsOnline());
            //preparedStatement.setString(8, user.getUsername());
            //preparedStatement.setString(9, user.getPassword());
            System.out.println(preparedStatement);
            preparedStatement.executeUpdate();
        } catch (SQLException e) {
            System.out.println(e);
        }
    }

    public User selectUser(int id) {
        User user = null;
        // Step 1: Establishing a Connection
        try (Connection connection = getConnection();
                // Step 2:Create a statement using connection object
                PreparedStatement preparedStatement
                = connection.prepareStatement(SELECT_USER_BY_ID);) {
            preparedStatement.setInt(1, id);
            System.out.println(preparedStatement);
            // Step 3: Execute the query or update query
            ResultSet rs = preparedStatement.executeQuery();
            // Step 4: Process the ResultSet object.
            while (rs.next()) {
                String firstName = rs.getString("firstName");
                String midName = rs.getString("midName");
                String lastName = rs.getString("lastName");
                String birthDay = rs.getString("birthDay");
                int age = rs.getInt("age");
                boolean gender = rs.getBoolean("gender");
                user = new User(id, firstName, midName, lastName, birthDay, age, gender);
            }
        } catch (SQLException e) {
            System.out.println(e);
        }
        return user;
    }

    public List< User> selectAllUsers() {
        // using try-with-resources to avoid closing resources (boiler plate code)
        List< User> users = new ArrayList<>();
        // Step 1: Establishing a Connection
        try (Connection connection = getConnection();
                // Step 2:Create a statement using connection object
                PreparedStatement preparedStatement
                = connection.prepareStatement(SELECT_ALL_USER);) {
            System.out.println(preparedStatement);
            // Step 3: Execute the query or update query
            ResultSet rs = preparedStatement.executeQuery();
            // Step 4: Process the ResultSet object.
            while (rs.next()) {
                int id = rs.getInt("id");
                String firstName = rs.getString("firstName");
                String midName = rs.getString("midName");
                String lastName = rs.getString("lastName");
                String birthDay = rs.getString("birthDay");
                int age = rs.getInt("age");
                boolean gender = rs.getBoolean("gender");
                
                users.add(new User(id, firstName, midName, lastName, birthDay, age, gender));
            }
        } catch (SQLException e) {
            System.out.println(e);
        }
        return users;
    }

    public boolean deleteUser(int id) throws SQLException {
        boolean rowDeleted;
        try (Connection connection = getConnection(); PreparedStatement statement
                = connection.prepareStatement(DELETE_USER_SQL);) {
            statement.setInt(1, id);
            rowDeleted = statement.executeUpdate() > 0;
        }
        return rowDeleted;
    }

    public boolean updateUser(User user) throws SQLException {
        boolean rowUpdated;
        try (Connection connection = getConnection(); 
                PreparedStatement statement
                = connection.prepareStatement(UPDATE_USER_SQL);) {
            statement.setString(1, user.getFirstName());
            statement.setString(2, user.getMidName());
            statement.setString(3, user.getLastName());
            statement.setString(4, user.getBirthDay());
            statement.setInt(5, user.getAge());
            statement.setBoolean(6, user.isGender());
            statement.setInt(7, user.getId());
            rowUpdated = statement.executeUpdate() > 0;
        }
        return rowUpdated;
    }
}
