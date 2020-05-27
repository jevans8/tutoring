<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');
require_once('model/validate.php');

//Start a session (AFTER the autoload)
session_start();

//Instantiate the framework (Base class)
$f3 = Base::instance(); //Class::method()

//////////////////////////////////////////////////////////////////////////////////////////////////////
//Default route
$f3->route('GET|POST /', function($f3) {

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $f3->reroute('search');
    }

    $view = new Template();
    echo $view->render('views/home.html');

});

//////////////////////////////////////////////////////////////////////////////////////////////////////
//Student search route
$f3->route('GET /search', function(){

    $view = new Template();
    echo $view->render('views/search.html');

});

//////////////////////////////////////////////////////////////////////////////////////////////////////
//New student route
$f3->route('GET|POST /newStudent', function($f3){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //validate first name
        if(empty($_POST['fname']))
        {
            $f3->set('errors["fname"]', "Required field");
        }
        else if(!validName($_POST['fname']))
        {
            $f3->set('errors["fname"]', "Please enter a valid name");
        }

        //validate last name
        if(empty($_POST['lname']))
        {
            $f3->set('errors["lname"]', "Required field");
        }
        else if(!validName($_POST['lname']))
        {
            $f3->set('errors["lname"]', "Please enter a valid name");
        }

        //validate sid
        if(empty($_POST['sid']))
        {
            $f3->set('errors["sid"]', "Required field");
        }
        else if(!validSid($_POST['sid']))
        {
            $f3->set('errors["sid"]', "Please enter a valid SID");
        }

        //validate email
        if(empty($_POST['email']))
        {
            $f3->set('errors["email"]', "Required field");
        }
        else if(!validEmail($_POST['email']))
        {
            $f3->set('errors["email"]', "Please enter a valid email address");
        }

        //if valid data
        if(empty($f3->get('errors')))
        {
            $f3->reroute('viewStudent');
        }

        //store variables in f3 hive to make form sticky
        $f3->set('fname', $_POST['fname']);
        $f3->set('lname', $_POST['lname']);
        $f3->set('sid', $_POST['sid']);
        $f3->set('email', $_POST['email']);
    }

    $view = new Template();
    echo $view->render('views/newStudent.html');

});

//////////////////////////////////////////////////////////////////////////////////////////////////////
//View student route
$f3->route('GET /viewStudent', function(){

    $view = new Template();
    echo $view->render('views/viewStudent.html');

});

//////////////////////////////////////////////////////////////////////////////////////////////////////
//Run the framework (fat free)
$f3->run();

