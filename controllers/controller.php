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
        session_unset();

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
            else if(!$GLOBALS['db']->isTutor($_POST['loginEmail']))
            {
                $this->_f3->set('errors["loginEmail"]', "Access denied");
            }
            else //good email
            {
                //validate password
                if(empty($_POST['password']))
                {
                    $this->_f3->set('errors["password"]', "Required field");
                }
                else if(!$validator->validPassword($_POST['password']))
                {
                    $this->_f3->set('errors["password"]', "Incorrect password");
                }
            }

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
                    echo "<div class='row justify-content-center'>";
                    echo "<div class='col-6'>";
                    echo "<div class='small my-2 py-1 alert alert-danger' role='alert'>No results found</div>";
                    echo "<a href='newStudent'>Add New Student</a>";
                    echo "</div>";
                    echo "</div>";
                }
                else
                {
                    echo "<div class='card-columns'>";

                    //display results
                    foreach ($result as $row)
                    {
                        $fname = $row['first_name'];
                        $lname = $row['last_name'];
                        $sid = $row['student_id'];
                        $email = $row['email'];

                        echo "
                        <div class=\"card m-3\">
                            <form method='post' action=''>
                                <div class=\"card-body\">
                                    <h5 class=\"card-title\">$fname $lname</h5>
                                        <div class='form-group'>
                                            <input type='text' class='form-control-plaintext sr-only' name='fname' value='$fname'>
                                            <input type='text' class='form-control-plaintext sr-only' name='lname' value=$lname>
                                            <input type='text' class='form-control-plaintext sr-only' name='sid' value=$sid>
                                            <input type='text' class='form-control-plaintext sr-only' name='email' value='$email'>
                                        </div>                              
                                </div>
                                <div class=\"card-footer\">
                                    <!--<button type='submit' class='btn btn-primary stretched-link' name='view'>View Student</button>-->
                                    <button type=\"submit\" class=\"btn btn-link stretched-link\" name=\"view\">View Student</button>
                                </div>
                            </form>
                        </div>
                        ";

                    }

                    echo "</div>"; // container
                }

            }
            //no input
            else
            {
                echo "<div class='row justify-content-center'>";
                echo "<div class='col-6'>";
                echo "<div class='small my-3 py-1 alert alert-warning' role='alert'>Required field</div>";
                echo "</div>";
                echo "</div>";
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
                if(isset($_POST['isTutor']))
                {
                    //create a tutor object
                    $student = new Tutor();
                    $student->isTutor(); // == true
                }
                else
                {
                    //create a student object
                    $student = new Student();
                    $student->isTutor(); // == false
                }

                $student->setFName($_POST['fname']);
                $student->setLName($_POST['lname']);
                $student->setSid($_POST['sid']);
                $student->setEmail($_POST['email']);
                //$student->isTutor();

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
            $this->_f3->set('isTutor', $_POST['isTutor']);
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


        $courses = $this->_database->getCourses();

        $i = 0;
        $myArr = array();
        //loop over all my courses
        foreach ($courses as $course)
        {
            foreach ($course as $id)
            {
                $myArr[$i] = $id;

            }
            $i++;
        }

        //var_dump($courses);
        //var_dump($myArr);

        $this->_f3->set('courses', $myArr);

        //get instructors
        $instructors = $this->_database->getInstructors();

        $k = 0;
        $arr = array();
        //loop over all my instructors
        foreach ($instructors as $teacher)
        {
            for($j = 0; $j < 2; $j++)
            {
                $arr[$k] =  $teacher['first_name'] . " " . ucfirst($teacher['last_name']);
            }
            $k++;
        }

        //var_dump($arr);
        $this->_f3->set('instructors', $arr);


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