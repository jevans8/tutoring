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

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}

