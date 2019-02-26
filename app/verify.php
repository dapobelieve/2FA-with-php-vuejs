<?php
/**
 * Created by PhpStorm.
 * User: BELIEVE
 * Date: 2/25/2019
 * Time: 2:41 PM
 */
require_once ('init.php');

$data = [];

$db = new MySQLDatabase();

$request = $db->cleanInput($_POST);

$token = $request['val'];

$sql = "SELECT user.* FROM user 
        JOIN tokens ON tokens.user_id = user.id
        WHERE tokens.token = '$token'
        LIMIT 1";

$result = $db->query($sql);

$dUser = $db->fetchArray($result);


if($db->numRows($result) == 1) {
    $data = $dUser;
    echo  $res->respond(true, $data,'Email Validation Successful');
    die();
}else {
    echo $res->respond(false, $data, 'Invalid Verification Link');
    die();
}