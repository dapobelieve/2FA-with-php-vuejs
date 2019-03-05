<?php
/**
 * Created by PhpStorm.
 * User: BELIEVE
 * Date: 3/4/2019
 * Time: 10:57 AM
 */
require_once ('init.php');

$data = [];

$db = new MySQLDatabase();

$request = $db->cleanInput($_POST);

//grab token & id
$token = $request['token'];
$userId = $request['id'];

//run query to fetch user and related token
//checking if token is valid

$sql = "SELECT user.*, code.token from user 
        JOIN code ON user.id = code.user_id
        WHERE user.id = '$userId' 
        AND code.token = '$token' 
        AND code.is_valid = 1";

$result = $db->query($sql);
$data = [];

$data = $db->fetchArray($result);

if($db->numRows($result) == 1) {

    echo  $res->respond(true, $data,'Mobile Verifiction Successful');
    die();
}else {
    echo $res->respond(false, $data, 'Invalid Token');
    die();
}

//echo  json_encode($data);

//return the user ot front end and log them in