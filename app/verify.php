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

$sql = "SELECT user.* FROM user 
        JOIN tokens ON tokens.user_id = user.id";

$result = $db->query($sql);

$dUser = $db->fetchArray($result);

if($db->numRows($result) === 1) {
    echo  $res->respond(true, $data,'Email Validation Successful');
    die();
}
echo $dUser['phone'];

//print_r();