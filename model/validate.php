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
     * Return a value indicating if name param is valid
     * Valid names do not contain anything except letters
     * @param $name
     * @return bool
     */
    function validName($name)
    {
        return ctype_alpha($name);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Return a value indicating if email is valid
     * @param $email
     * @return bool
     */
    function validEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// NOT DONE
    /**
     * Return a value indicating if date is valid
     * @param $date
     * @return bool
     */
    function validDate($date)
    {
        //return false;
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// NOT DONE
    /**
     * Return a value indicating if time is valid
     * @param $time
     * @return bool
     */
    function validTime($time)
    {
        //return false;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// PULL FROM DB!!!
    /**
     * Return an array of valid courses
     * @return String[]
     */
    function getCourses()
    {
        return array("IT 328", "IT 334", "ENGL 335");
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// PULL FROM DB!!!!
    /**
     * Return an array of valid instructors
     * @return String[]
     */
    function getInstructors()
    {
        return array("Tina Ostrander", "Ken Hang", "Josh Archer", "Susan Uland");
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}

