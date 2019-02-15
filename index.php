<?php
#output buffering
//ob_start(); //for testing

#Error Reporting
ini_set("display_errors", 1);
error_reporting(E_ALL);

#require autoload
require_once ('vendor/autoload.php');

require_once ('model/db-functions.php');

#Start session
session_start();
//print_r($_SESSION);

#Connect to database
$dbh = connect();
if(!$dbh) {
    exit;
}

#-------------------------------------------------------------------------------
#create an instance of the Base class
$f3 = Base::instance();

#Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);


#-------------------------------------------------------------------------------
#define a default route
$f3->route('GET /', function($f3) {

    $students = getStudents();
    //print_r($students);
    $f3->set('students', $students);

    $view = new Template();
    echo $view->render('views/all-students.html');
});


#-------------------------------------------------------------------------------
#Route to add-student.html
$f3->route("GET|POST /add", function ($f3) {

    if(!empty($_POST)) {//isset($_POST['submit'])
        //print_r($_POST);

        $sid = $_POST['sid'];
        $last = $_POST['last'];
        $first = $_POST['first'];
        $birthdate = $_POST['birthdate'];
        $gpa = $_POST['gpa'];
        $advisor = $_POST['advisor'];

        $success = addStudent($sid, $last, $first,
            $birthdate, $gpa, $advisor);

        #Student is added to DB successfully
        if($success) {

            #Create a student object
            $student = new Student($sid, $last, $first,
                $birthdate, $gpa, $advisor);

            #Add to session
            $_SESSION['student'] = $student;

            #Reroute to home page
            $f3->reroute('/');
        }
    }

    $view = new Template();
    echo $view->render('views/add-student.html');
});

#-------------------------------------------------------------------------------
#Run Fat-Free
$f3->run();
#output buffering
//ob_flush();