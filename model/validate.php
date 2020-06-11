<?php

/**
 * Class Validate
 * Contains the form validation methods
 * @author Julia Evans, Elric Barkey, Zach Frehner
 * @version 1.0
 */
class Validate
{
    /**
     * Return a value indicating if password param is valid
     * @param $pw
     * @return bool
     */
    function validPassword($pw)
    {
        return $pw == "password";
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////// name
    /**
     * Return a value indicating if name param is valid
     * Valid names do not contain anything except letters
     * @param $name
     * @return bool
     */
    function validName($name)
    {
        return ctype_alpha($name);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////// sid
    /**
     * Return a value indicating if SID is valid
     * Valid SIDs contain only digits and are 9 digits long
     * @param $sid
     * @return bool
     */
    function validSid($sid)
    {
        return is_numeric($sid) && strlen($sid) == 9;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////// email
    /**
     * Return a value indicating if email is valid
     * @param $email
     * @return bool
     */
    function validEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////// courses
    /**
     * Return a value indicating if course is valid
     * @param $course
     * @return bool
     */
    function validCourse($course)
    {
        $validCourses = $this->getCourses();
        return in_array($course, $validCourses);
    }

    /**
     * Return an array of valid courses
     * @return String[]
     */
    function getCourses()
    {
        return array("IT 328", "IT 334", "IT 333", "IT 220");
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////// instructors
    /**
     * Return a value indicating if instructor is valid
     * @param $instructor
     * @return bool
     */
    function validInstructor($instructor)
    {
        $validInstructors = $this->getInstructors();
        return in_array($instructor, $validInstructors);
    }

    /**
     * Return an array of valid instructors
     * @return String[]
     */
    function getInstructors()
    {
        return array("tina Ostrander", "ken Hang", "josh Archer", "susan Uland");
    }

}

