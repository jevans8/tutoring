<?php

class Student
{
    private $_name;
    private $_sid;
    private $_email;

    /**
     * Default constructor
     * @param $name student name
     * @param $sid student id
     * @param $email student email
     */
    public function __construct($name, $sid, $email)
    {
        $this->_name = $name; //OR $this->setName($name);
        $this->_sid = $sid;
        $this->_email = $email;
    }

    /**
     * toString() returns a String representation of a student object
     * @return String
     */
    public function toString()
    {
        $out = $this->_name . " - ";
        $out .= $this->_sid . " - ";
        $out .= $this->_email . " - ";
        return $out;
    }

    /**
     * @return string student name
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $name student name
     */
    public function setName($name)
    {
        $this->_name = $name;
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

}