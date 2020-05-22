<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');
//require_once('model/data.php');

//Start a session (AFTER the autoload)
//session_start();

//Instantiate the framework (Base class)
$f3 = Base::instance(); //Class::method()

//////////////////////////////////////////////////////////////////////////////////////////////////////
//Default route
$f3->route('GET /', function(){

    $view = new Template();
    echo $view->render('views/home.html');

});

//////////////////////////////////////////////////////////////////////////////////////////////////////
//Run the framework (fat free)
$f3->run();

