<?php

//connect to correct config file
if ($_SERVER['USER'] == 'ebarkeyg')
{
    require_once "/home/ebarkeyg/config.php";
}
else if ($_SERVER['USER'] == 'zfrehner')
{
    require_once "/home/zfrehner/config.php";
}
else
{
    require_once "/home/jevansgr/config.php";
}

/**
 * Class Database
 * Contains the database methods
 * @author Julia Evans, Elric Barkey, Zach Frehner
 * @version 1.0
 */
class Database
{
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////// fields
    private $_dbh;

    //////////////////////////////////////////////////////////////////////////////////////////////////////// constructor
    /**
     * Database constructor
     */
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

    //////////////////////////////////////////////////////////////////////////////////////////////////////// add student
    /**
     * Adds a student to the database
     * @param $student
     */
    function addStudent($student)
    {
        //1. Define the query
        $sql= "INSERT INTO student (student_id, first_name, last_name, email, is_tutor) VALUES (:student_id, :first_name, :last_name, :email, :is_tutor)";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':student_id', $student->getSid());
        $statement->bindParam(':first_name', $student->getFName());
        $statement->bindParam(':last_name', $student->getLName());
        $statement->bindParam(':email', $student->getEmail());
        $statement->bindParam(':is_tutor', $student->getTutorStatus());

        //4. Execute the statement
        $statement->execute();

        //5. Process the result - SKIP
    }

    ///////////////////////////////////////////////////////////////////////////////////////////// display search results
    /**
     * Selects all the students from the database whose first/last name contain the input
     * @param $input
     * @return array
     */
    function displayResults($input)
    {
        //1. Define the query
        $sql = "SELECT * FROM student WHERE first_name LIKE '%$input%' OR last_name LIKE '%$input%' ORDER BY first_name ASC";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters - SKIP

        //4. Execute the statement
        $statement->execute();

        //5. Process the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////// isTutor
    /**
     * Checks if email is tutor email
     * @param $email
     * @return bool
     */
    function isTutor($email)
    {
        //1. Define the query
        $sql = "SELECT * FROM `student` WHERE is_tutor = 1";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters - SKIP

        //4. Execute the statement
        $statement->execute();

        //5. Process the results
        $validTutors = $statement->fetchAll(PDO::FETCH_ASSOC);

        //check if email is one of the valid tutors
        foreach($validTutors as $tutor)
        {
            if($tutor['email'] == $email)
            {
                return true;
            }
        }

        return false;
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////// get instructors
    /**
     * Return an array of valid instructors
     * @return String[]
     */
    function getInstructors()
    {
        $sql = "SELECT * FROM instructor ORDER BY first_name ASC";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters - SKIP

        //4. Execute the statement
        $statement->execute();

        //5. Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
        //return array("Tina Ostrander", "Ken Hang", "Josh Archer", "Susan Uland");
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////// get courses
    /**
     * Return an array of valid courses
     * @return String[]
     */
    function getCourses()
    {
        $sql = "SELECT * FROM course ORDER BY title ASC";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters - SKIP

        //4. Execute the statement
        $statement->execute();

        //5. Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

}




