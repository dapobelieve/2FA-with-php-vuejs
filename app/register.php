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

//clean input
$cleanInput = $db->cleanInput($_POST);

//check mail exits
if ($user->checkMailExists($_POST['email']) === 1) {
    $data = [];
   echo  $res->respond(false, $data,'Email Address already exists on our servers');
}



//create user
echo $user->create($_POST);