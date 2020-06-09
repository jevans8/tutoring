<?php

//echo "<pre>";
//var_dump($_SERVER);
//echo "</pre>";
//
//$home = $_SERVER['home'];
//require_once "$home/config.php";

if ($_SERVER['USER'] == 'jevansgr')
{
    require_once "/home/jevansgr/config.php";
}

else if ($_SERVER['USER'] == 'zfrehner')
{
    require_once "/home/zfrehner/config.php";
}
else
{
    require_once "/home/ebarkeyg_grc/config.php";
}


class Database
{
    private $_dbh;

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function __construct()
    {
        //connect to database with PDO
        try
        {
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            //echo "Connected to database!";
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function viewStudent()
    {
        //1. Define the query
        //2. Prepare the statement
        //3. Bind the parameters
        //4. Execute the statement
        //5. Process the result
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function addStudent()
    {
        //1. Define the query
        //2. Prepare the statement
        //3. Bind the parameters
        //4. Execute the statement
        //5. Process the result
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function editStudent()
    {
        //1. Define the query
        //2. Prepare the statement
        //3. Bind the parameters
        //4. Execute the statement
        //5. Process the result
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function deleteStudent()
    {
        //1. Define the query
        //2. Prepare the statement
        //3. Bind the parameters
        //4. Execute the statement
        //5. Process the result
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function addAttendance()
    {
        //1. Define the query
        //2. Prepare the statement
        //3. Bind the parameters
        //4. Execute the statement
        //5. Process the result
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function viewAttendance()
    {
        //1. Define the query
        //2. Prepare the statement
        //3. Bind the parameters
        //4. Execute the statement
        //5. Process the result
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}




