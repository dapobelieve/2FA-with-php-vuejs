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

$cleanInput = $db->cleanInput($_POST);

//check mail exits
if ($user->checkMailExists($cleanInput['email']) === 1) {
    $email = $cleanInput['email'];
    $pass  = md5($cleanInput['password']);

    $sql = "SELECT * FROM user where email = '$email' and password = '$pass' ";
    $result = $db->query($sql);

    if ($db->numRows($result) == 1){
        $userData = $db->fetchArray($result);
        $data = $userData;
        echo  $res->respond(true, $data,'User Found');
        die();
    }else {
        $data = [];
        echo  $res->respond(false, $data,'Wrong Password');
        die();
    }
    
}else {
    $data = [];
    echo  $res->respond(false, $data,'Email Address does not exist on our servers');
    die();
}