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

