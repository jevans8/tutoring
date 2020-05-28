<?php

/**
 * Controller class
 */
class Controller
{
    private $_f3; //router

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Controller constructor.
     * @param $_f3
     */
    public function __construct($_f3)
    {
        $this->_f3 = $_f3;
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Process default route (home page)
     */
    public function home()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->_f3->reroute('search');
        }

        $view = new Template();
        echo $view->render('views/home.html');

    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Process student search route
     */
    public function search()
    {
        $view = new Template();
        echo $view->render('views/search.html');
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Process add new student route
     */
    public function newStudent()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //validate first name
            if(empty($_POST['fname']))
            {
                $this->_f3->set('errors["fname"]', "Required field");
            }
            else if(!validName($_POST['fname']))
            {
                $this->_f3->set('errors["fname"]', "Please enter a valid name");
            }

            //validate last name
            if(empty($_POST['lname']))
            {
                $this->_f3->set('errors["lname"]', "Required field");
            }
            else if(!validName($_POST['lname']))
            {
                $this->_f3->set('errors["lname"]', "Please enter a valid name");
            }

            //validate sid
            if(empty($_POST['sid']))
            {
                $this->_f3->set('errors["sid"]', "Required field");
            }
            else if(!validSid($_POST['sid']))
            {
                $this->_f3->set('errors["sid"]', "Please enter a valid SID");
            }

            //validate email
            if(empty($_POST['email']))
            {
                $this->_f3->set('errors["email"]', "Required field");
            }
            else if(!validEmail($_POST['email']))
            {
                $this->_f3->set('errors["email"]', "Please enter a valid email address");
            }

            //if valid data
            if(empty($this->_f3->get('errors')))
            {
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
        $view = new Template();
        echo $view->render('views/viewStudent.html');
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}