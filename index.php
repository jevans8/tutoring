<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');
require_once('model/validate.php'); //why is this necessary if it's in composer?????
require_once('model/database.php'); //why is this necessary if it's in composer?????

//Start a session (AFTER the autoload)
//session_start();
//DON'T FORGET TO ADD SESSION_DESTROY!!!!!!!!!!

//Instantiate the framework (Base class)
$f3 = Base::instance(); //Class::method()
$controller = new Controller($f3); //controller object
$validator = new Validate(); //validation object

//////////////////////////////////////////////////////////////////////////////////////////////////////
//Default route
$f3->route('GET|POST /', function($f3)
{
    $GLOBALS['controller']->login();
});

//////////////////////////////////////////////////////////////////////////////////////////////////////
//Student search route
$f3->route('GET /search', function()
{
    $GLOBALS['controller']->search();
});

//////////////////////////////////////////////////////////////////////////////////////////////////////
//New student route
$f3->route('GET|POST /newStudent', function($f3)
{
    $GLOBALS['controller']->newStudent();
});

//////////////////////////////////////////////////////////////////////////////////////////////////////
//View student route
$f3->route('GET|POST /viewStudent', function()
{
    $GLOBALS['controller']->viewStudent();
});

//////////////////////////////////////////////////////////////////////////////////////////////////////
//Run the framework (fat free)
$f3->run();

