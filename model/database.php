<?php

//$user = $_SERVER['user'];
//$home = $_SERVER['home'];
//require_once "/home/$user/config.php";

//require_once "/home/jevansgr/config.php";
//require_once "/home/zfrehner_grc/config.php";
require_once "/home/ebarkeyg/config.php";

//connect to database with PDO
try
{
    $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    //echo "Connected to database!";
}
catch(PDOException $e)
{
    echo $e->getMessage();
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//VIEW STUDENT
//1. Define the query
//2. Prepare the statement
//3. Bind the parameters
//4. Execute the statement
//5. Process the result

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//ADD STUDENT
//1. Define the query
//2. Prepare the statement
//3. Bind the parameters
//4. Execute the statement
//5. Process the result

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//EDIT STUDENT
//1. Define the query
//2. Prepare the statement
//3. Bind the parameters
//4. Execute the statement
//5. Process the result

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//DELETE STUDENT
//1. Define the query
//2. Prepare the statement
//3. Bind the parameters
//4. Execute the statement
//5. Process the result

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//ADD ATTENDANCE
//1. Define the query
//2. Prepare the statement
//3. Bind the parameters
//4. Execute the statement
//5. Process the result

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//EDIT/DELETE ATTENDANCE ALSO??????
