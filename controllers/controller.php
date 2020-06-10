<?php

/**
 * Class Controller
 * Contains the routing methods for the app
 * @author Julia Evans, Zach Frehner, Elric Barkey
 * @version 1.0
 */
class Controller
{
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////// fields
    private $_f3; //router
    private $_database;

    //////////////////////////////////////////////////////////////////////////////////////////////////////// constructor
    /**
     * Controller constructor
     * @param $_f3
     */
    public function __construct($_f3)
    {
        $this->_f3 = $_f3;
        $this->_database = new Database();
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////// login
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

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////// search
    /**
     * Process student search route
     */
    public function search()
    {
        $view = new Template();
        echo $view->render('views/search.html');

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            echo "<div class='container'>";

            if(!empty($_POST['search']))
            {
                //search for student in database
                $result = $GLOBALS['db']->displayResults($_POST['search']);

                //no results
                if(sizeof($result) == 0)
                {
                    echo "<div class='small my-1 py-1 alert alert-danger' role='alert'>No results found</div>";
                    echo "<a href='newStudent' class='btn btn-primary btn-block' role='button'>Add New Student</a>";
                }
                else
                {
                    //display results
                    foreach ($result as $row)
                    {
                        $fname = $row['first_name'];
                        $lname = $row['last_name'];
                        $sid = $row['student_id'];
                        $email = $row['email'];


                        echo "
                        <form method='post' action=''>
                            <div class='form-group'>
                                <!--<label for='search'>First Name:</label>-->
                                <input type='text' class='form-control-plaintext' id='fname' name='fname' value='$fname' readonly>
                                <!--<label for='search'>Last Name:</label>-->
                                <input type='text' class='form-control-plaintext' id='lname' name='lname' value=$lname readonly>
                                <!--<label for='search'>SID:</label>-->
                                <input type='text' class='form-control-plaintext' id='sid' name='sid' value=$sid readonly>
                                <!--<label for='search'>Email:</label>-->
                                <input type='text' class='form-control-plaintext' id='email' name='email' value='$email' readonly>
                            </div>
                            <button type='submit' class='btn btn-primary' name='view'>View Student</button>
                        </form>
                        <br>
                        ";

                    }
                }

            }
            //no input
            else
            {
                echo "<div class='small my-1 py-1 alert alert-warning' role='alert'>Required field</div>";
            }

            echo "</div>";

            //if view student button has been clicked
            if(isset($_POST['view']))
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

                //redirect
                $this->_f3->reroute("viewStudent");
            }

        }

    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////// new student
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

                //store student object in session array
                $_SESSION['student'] = $student;

                //add the new student to the database
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

    /////////////////////////////////////////////////////////////////////////////////////////////////////// view student
    /**
     * Process view student route
     */
    public function viewStudent()
    {
        global $validator;

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

        //if form has been submitted
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

        //destroy session
        //session_unset();
        //$_SESSION = array();
        //session_destroy();
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}