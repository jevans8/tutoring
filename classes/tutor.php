<?php

/**
 * Class Tutor
 * Contains the methods for all tutor objects
 * @author Julia Evans, Elric Barkey, Zach Frehner
 * @version 1.0
 */
class Tutor extends Student
{
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////// fields
    private $_isTutor;

    //////////////////////////////////////////////////////////////////////////////////////////////////////// constructor
    /**
     * Default constructor
     * @param bool $isTutor
     */
    public function __construct()
    {
        $this->_isTutor = true;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     *
     */
    public function viewStudentInfo()
    {

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * creates a new student object and adds them to the database
     */
    public function addNewStudent()
    {
        $student = new Student($this->setFName(), $this->setLName(), $this->setSid(), $this->setEmail(), false);
        $_SESSION['student'] = $student;
        $_SESSION['student']->addStudent();
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     *
     * @return
     */
    public function addAttendance()
    {
        return ;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * @return
     */
    public function viewAttendance()
    {
        return ;
    }

}