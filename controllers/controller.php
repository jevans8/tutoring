<?php

/**
 * Class Controller
 */
class Controller
{
    private $_f3; //router
    private $_database;

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Controller constructor.
     * @param $_f3
     */
    public function __construct($_f3)
    {
        $this->_f3 = $_f3;
        $this->_database = new Database();
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Process default route (login page)
     */
    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            global $validator;

            //validate email
            if(empty($_POST['loginEmail']))
            {
                $this->_f3->set('errors["loginEmail"]', "Required field");
            }
            else if(!$validator->validEmail($_POST['loginEmail']))
            {
                $this->_f3->set('errors["loginEmail"]', "Please enter a valid email address");
            }
            //else if(){} //are they a tutor???
            //validate password
            if(empty($_POST['password']))
            {
                $this->_f3->set('errors["password"]', "Required field");
            }
            //else if(){} //is it the correct password??

            //if valid data
            if(empty($this->_f3->get('errors')))
            {
                $this->_f3->reroute('search');
            }

            //store variables in f3 hive to make form sticky
            $this->_f3->set('loginEmail', $_POST['loginEmail']);
        }

        $view = new Template();
        echo $view->render('views/login.html');

    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Process student search route
     */
    public function search()
    {
        $view = new Template();
        echo $view->render('views/search.html');

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $result = $GLOBALS['db']->displayResults();

            //display results
            echo "<div class='container'>";
            foreach ($result as $row) {
                //place into html areas
                echo "<p>" . "Name: " . $row['first_name'] . "  " . $row['last_name'] ."<br>"
                    . "SID: ". $row['student_id'] ."<br>".
                    "Email: ". $row['email']
                    ."<br>";
            }
            echo "</p>";
            echo "</div>";
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Process add new student route
     */
    public function newStudent()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            global $validator;

            //validate first name
            if(empty($_POST['fname']))
            {
                $this->_f3->set('errors["fname"]', "Required field");
            }
            else if(!$validator->validName($_POST['fname']))
            {
                $this->_f3->set('errors["fname"]', "Please enter a valid name");
            }

            //validate last name
            if(empty($_POST['lname']))
            {
                $this->_f3->set('errors["lname"]', "Required field");
            }
            else if(!$validator->validName($_POST['lname']))
            {
                $this->_f3->set('errors["lname"]', "Please enter a valid name");
            }

            //validate sid
            if(empty($_POST['sid']))
            {
                $this->_f3->set('errors["sid"]', "Required field");
            }
            else if(!$validator->validSid($_POST['sid']))
            {
                $this->_f3->set('errors["sid"]', "Please enter a valid SID");
            }

            //validate email
            if(empty($_POST['email']))
            {
                $this->_f3->set('errors["email"]', "Required field");
            }
            else if(!$validator->validEmail($_POST['email']))
            {
                $this->_f3->set('errors["email"]', "Please enter a valid email address");
            }

            //if valid data
            if(empty($this->_f3->get('errors')))
            {
                //create a student object
                $student = new Student();
                $student->setFName($_POST['fname']);
                $student->setLName($_POST['lname']);
                $student->setSid($_POST['sid']);
                $student->setEmail($_POST['email']);
                $student->isTutor();

                //store object in session array
                $_SESSION['student'] = $student;

                // var_dump($_POST);
                // var_dump($_SESSION);

                //adding the new student to the database
                $this->_database->addStudent($_SESSION['student']);

                $this->_f3->reroute('viewStudent');
            }

            //store variables in f3 hive to make form sticky
            $this->_f3->set('fname', $_POST['fname']);
            $this->_f3->set('lname', $_POST['lname']);
            $this->_f3->set('sid', $_POST['sid']);
            $this->_f3->set('email', $_POST['email']);
        }

        $view = new Template();
        echo $view->render('views/newStudent.html');
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Process view student route
     */
    public function viewStudent()
    {
        global $validator;

        //echo "<pre>";
        //var_dump($_SESSION);
        //echo "</pre>";

        //get student object fields and save in hive to be displayed
        $this->_f3->set('fname', $_SESSION['student']->getFName());
        $this->_f3->set('lname', $_SESSION['student']->getLName());
        $this->_f3->set('sid', $_SESSION['student']->getSid());
        $this->_f3->set('email', $_SESSION['student']->getEmail());

        //get courses
        $courses = $validator->getCourses();
        $this->_f3->set('courses', $courses);

        //get instructors
        $instructors = $validator->getInstructors();
        $this->_f3->set('instructors', $instructors);

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //validate date
            if(empty($_POST['date']))
            {
                $this->_f3->set('errors["date"]', "Required field");
            }

            //validate time in
            if(empty($_POST['timein']))
            {
                $this->_f3->set('errors["timein"]', "Required field");
            }

            //validate time out
            if(empty($_POST['timeout']))
            {
                $this->_f3->set('errors["timeout"]', "Required field");
            }

            //validate course
            if(empty($_POST['course']))
            {
                $this->_f3->set('errors["course"]', "Required field");
            }
            else if(!$validator->validCourse($_POST['course']))
            {
                $this->_f3->set('errors["course"]', "Please select a valid course");
            }

            //validate instructor
            if(empty($_POST['instructor']))
            {
                $this->_f3->set('errors["instructor"]', "Required field");
            }
            else if(!$validator->validInstructor($_POST['instructor']))
            {
                $this->_f3->set('errors["instructor"]', "Please select a valid instructor");
            }

            //if valid data
            if(empty($this->_f3->get('errors')))
            {
                //viewing the student from the database
                //$this->_database->viewStudentInfo($_SESSION['student']);

                $this->_f3->set('errors["none"]', "Attendance has been successfully logged");
            }

            //store variables in f3 hive to make form sticky
            $this->_f3->set('date', $_POST['date']);
            $this->_f3->set('timein', $_POST['timein']);
            $this->_f3->set('timeout', $_POST['timeout']);
            $this->_f3->set('selectedCourse', $_POST['course']);
            $this->_f3->set('selectedInstructor', $_POST['instructor']);
            $this->_f3->set('notes', $_POST['notes']);
        }

        $view = new Template();
        echo $view->render('views/viewStudent.html');

        session_unset();
        $_SESSION = array();
        session_destroy();
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}