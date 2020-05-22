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
$f3->route('GET /newStudent', function(){

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

