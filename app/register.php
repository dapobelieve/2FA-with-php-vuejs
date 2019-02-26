<?php
/**
 * Created by PhpStorm.
 * User: BELIEVE
 * Date: 2/17/2019
 * Time: 12:44 PM
 */


require_once ('init.php');

$db = new MySQLDatabase();
$user = new User;
$data = '';

//clean input
$cleanInput = $db->cleanInput($_POST);

//check mail exits
if ($user->checkMailExists($_POST['email']) === 1) {
    $data = [];
   echo  $res->respond(false, $data,'Email Address already exists on our servers');
   die();
}


//check phone exits
if ($user->checkPhoneExists($_POST['phone']) === 1) {
    $data = [];
    echo  $res->respond(false, $data,'Phone Number already exists on our servers');
    die();
}


//create user
$response = $user->create($_POST);
if($response) {
    echo  $res->respond(true, $data,'Registration Successful, Please check your mail to verify your account.');
    die();
}else {
    echo $res->respond(false, $data,$response);
    die();
}
