<?php

class Student
{
    private $_fname;
    private $_lname;
    private $_sid;
    private $_email;
    private $_isTutor;

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

    /**
     * @return string student first name
     */
    public function getFName()
    {
        return $this->_fname;
    }

    /**
     * @param string $name student first name
     */
    public function setFName($name)
    {
        $this->_fname = $name;
    }

    /**
     * @return string student last name
     */
    public function getLName()
    {
        return $this->_lname;
    }

    /**
     * @param string $name student last name
     */
    public function setLName($name)
    {
        $this->_lname = $name;
    }

    /**
     * @return string student SID
     */
    public function getSid()
    {
        return $this->_sid;
    }

    /**
     * @param string $sid student SID
     */
    public function setSid($sid)
    {
        $this->_sid = $sid;
    }

    /**
     * @return string student email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param string $email student email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return bool are they a tutor?
     */
    public function isTutor()
    {
        return $this->_isTutor;
    }

}