<?php

//new student form validation

function validName($name)
{
    return ctype_alpha($name);
}

function validSid($sid)
{
    return is_numeric($sid) && strlen($sid) == 9;
}

function validEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}