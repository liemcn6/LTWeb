/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

/**
 *
 * @author DELL
 */
public class User {
    protected int id;
    protected String firstName;
    protected String midName;
    protected String lastName;
    protected String birthDay;
    protected int age;
    protected  boolean gender;
    protected  boolean isOnline;
    protected String username;
    protected String password;

    public User() {
    }

    public User(String firstName, String midName, String lastName, String birthDay, int age, boolean gender, boolean isOnline, String username, String password) {
        this.firstName = firstName;
        this.midName = midName;
        this.lastName = lastName;
        this.birthDay = birthDay;
        this.age = age;
        this.gender = gender;
        this.isOnline = isOnline;
        this.username = username;
        this.password = password;
    }

    public User(int id, String firstName, String midName, String lastName, String birthDay, int age, boolean gender, boolean isOnline, String username, String password) {
        this.id = id;
        this.firstName = firstName;
        this.midName = midName;
        this.lastName = lastName;
        this.birthDay = birthDay;
        this.age = age;
        this.gender = gender;
        this.isOnline = isOnline;
        this.username = username;
        this.password = password;
    }

    public User(String firstName, String midName, String lastName, String birthDay, int age, boolean gender) {
        this.firstName = firstName;
        this.midName = midName;
        this.lastName = lastName;
        this.birthDay = birthDay;
        this.age = age;
        this.gender = gender;
    }

    public User(int id, String firstName, String midName, String lastName, String birthDay, int age, boolean gender) {
        this.id = id;
        this.firstName = firstName;
        this.midName = midName;
        this.lastName = lastName;
        this.birthDay = birthDay;
        this.age = age;
        this.gender = gender;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getFirstName() {
        return firstName;
    }

    public void setFirstName(String firstName) {
        this.firstName = firstName;
    }

    public String getMidName() {
        return midName;
    }

    public void setMidName(String midName) {
        this.midName = midName;
    }

    public String getLastName() {
        return lastName;
    }

    public void setLastName(String lastName) {
        this.lastName = lastName;
    }

    public String getBirthDay() {
        return birthDay;
    }

    public void setBirthDay(String birthDay) {
        this.birthDay = birthDay;
    }

    public int getAge() {
        return age;
    }

    public void setAge(int age) {
        this.age = age;
    }

    public boolean isGender() {
        return gender;
    }

    public void setGender(boolean gender) {
        this.gender = gender;
    }

    public boolean isIsOnline() {
        return isOnline;
    }

    public void setIsOnline(boolean isOnline) {
        this.isOnline = isOnline;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }
    
    
}
