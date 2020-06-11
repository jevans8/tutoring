<?php

/**
 * Class Student
 * Contains the methods for all student objects
 * @author Julia Evans, Elric Barkey, Zach Frehner
 * @version 1.0
 */
class Student
{
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////// fields
    private $_fname;
    private $_lname;
    private $_sid;
    private $_email;
    private $_isTutor;

    //////////////////////////////////////////////////////////////////////////////////////////////////////// constructor
    /**
     * Default constructor
     * @param string $fname student first name
     * @param string $lname student last name
     * @param string $sid student id
     * @param string $email student email
     * @param bool $isTutor
     */
    public function __construct($fname = "Zach", $lname = "Frehner", $sid = "555555555", $email = "zfrehn@gmail.com", $isTutor = false)
    {
        $this->_fname = $fname; //OR $this->setFName($name);
        $this->_lname = $lname;
        $this->_sid = $sid;
        $this->_email = $email;
        $this->_isTutor = $isTutor;
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////// toString
    /**
     * toString() returns a String representation of a student object
     * @return String
     */
    public function toString()
    {
        $output = $this->_fname . " ";
        $output .= $this->_lname . " - ";
        $output .= $this->_sid . " - ";
        $output .= $this->_email;
        return $output;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////// first name
    /**
     * getter for first name
     * @return string student first name
     */
    public function getFName()
    {
        return $this->_fname;
    }

    /**
     * setter for first name
     * @param string $name student first name
     */
    public function setFName($name)
    {
        $this->_fname = $name;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////// last name
    /**
     * getter for last name
     * @return string student last name
     */
    public function getLName()
    {
        return $this->_lname;
    }

    /**
     * setter for last name
     * @param string $name student last name
     */
    public function setLName($name)
    {
        $this->_lname = $name;
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////// sid
    /**
     * getter for SID
     * @return string student SID
     */
    public function getSid()
    {
        return $this->_sid;
    }

    /**
     * setter for SID
     * @param string $sid student SID
     */
    public function setSid($sid)
    {
        $this->_sid = $sid;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////// email
    /**
     * getter for email
     * @return string student email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * setter for email
     * @param string $email student email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////// isTutor

    /**
     * Sets a boolean value that determines if they are a tutor or not
     * @param $isTutor
     */
    public function isTutor($isTutor)
    {
        $this->_isTutor = $isTutor;
        //return $this->_isTutor;
    }

}