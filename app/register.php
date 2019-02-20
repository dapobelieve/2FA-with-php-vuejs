<?php
/**
 * Created by PhpStorm.
 * User: BELIEVE
 * Date: 2/17/2019
 * Time: 12:44 PM
 */

require_once ('init.php');

$db = new MySQLDatabase();

$cleanInput = $db->cleanInput($_POST);
//$cleanInput = $_POST;

echo json_encode($cleanInput);