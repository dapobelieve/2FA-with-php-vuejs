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

//INSERT QUERY
$query = "INSERT INTO user (name, email, password, phone, age)";
$query .= "VALUES ('Dapo Michaels', 'dapo@gmail.com', 'secret', '07069494803', 29)";
$result1 = $db->query($query);


$sql = "SELECT * FROM user where id > 1";
$resultSet = $db->query($sql);

//USE fetchArray Method for select queries
$user = $db->fetchArray($resultSet);


$lastId = $db->insertId();

echo "The last id inserted is: ".$lastId;



/**
 * use this to count the number of rows
 * returned from a select query
 *
 * useful for checking if an email or phone
 * number exits
 */
$numRows = $db->numRows($resultSet);

echo $numRows."<br>";

echo  $user['name'];




//echo $db->fetchArray($result);
