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
    require_once "/home/ebarkeyg/config.php";
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
    function viewStudentInfo($sid)
    {
        //1. Define the query
        $sql = "SELECT * FROM student WHERE student_id = $sid";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        //SKIP

        //4. Execute the statement
        $statement->execute();

        //5. Process the result
        return $statement->fetchAll(PDO);
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function addStudent($student)
    {
        //1. Define the query
        $sql= "INSERT INTO student (student_id, first_name, last_name, email, is_tutor) 
    VALUES (:student_id, :first_name, :last_name, :email, :is_tutor)";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':student_id', $student->getSid());
        $statement->bindParam(':first_name', $student->getFName());
        $statement->bindParam(':last_name', $student->getLName());
        $statement->bindParam(':email', $student->getEmail());
        $statement->bindParam(':is_tutor', $student->isTutor());

        //4. Execute the statement
        $statement->execute();

        //5. Process the result - SKIP
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function addAttendance()
    {
        //1. Define the query
        /*$sql = "INSERT INTO attendance (`instructor_email`, `student_id`, `date`, `time_in`, `time_out`, `course_title`, `instructor_name`, `notes`)
    VALUES ('tostrander@mail.greenriver.edu', '987654321', '2020-05-28', '2020-05-28 16:08:12', '2020-05-28 16:25:12', 'IT 328', \"T. Ostrander\", \"great class\");";*/

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

    //print students
    function viewStudent()
    {
        //Read fro database
        //1. Define the query
        $sql = "SELECT * FROM student ORDER BY first_name ASC";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters - SKIP

        //4. Execute the statement
        $statement->execute();

        //5. Process the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}