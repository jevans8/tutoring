<?php

class Tutor extends Student
{

    /**
     *
     */
    public function viewStudentInfo()
    {

    }

    /**
     * creates a new student object
     */
    public function addNewStudent()
    {
        $student = new Student($this->setFName(), $this->setLName(),
                                $this->setSid(), $this->setEmail(),
                                false);
        $_SESSION['student'] = $student;

        $_SESSION['student']->addStudent();
    }

    /**
     *
     * @return
     */
    public function addAttendance()
    {
        return ;
    }

    /**
     * @return
     */
    public function viewAttendance()
    {
        return ;
    }




}