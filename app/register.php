<?php
/**
 * Created by PhpStorm.
 * User: BELIEVE
 * Date: 2/17/2019
 * Time: 12:44 PM
 */
require_once ('MySQLDatabase.php');

header('Content-type: application/json');
header('Access-Control-Allow-Headers: Content-Type');
header("Access-Control-Allow-Origin: *");

// echo json_encode($_POST);

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

//existing email address in our database
if (!checkIfEmailExists($input['email'])) {
	$name = $input['name'];
	$email = $input['email'];
	$mobile = $input['mobile'];
	$pass1 = md5($input['pass1']);
	$agegrp = $input['agegrp'];


	$result['message'] = '';
	$result['error']  = false;

	if($name){
		$result['message']  = "Posted Values => ".$name."-".$email."-".$mobile."-".$agegrp;
		$result['error']  = false;
	}
	else {
		$result['error']  = 'Form submission failed.';
	}
	$result->json_encode($result);
	$query = "INSERT INTO 'tbl_patients'
						VALUES ('', '$result['name']', '$result['email']', '$result['mobile']', '$result['pass1']','$result['agegrp']', CURRENT_TIME())";
	$submit = new MySQLDatabase;
	$post = $submit->query($query);
	$submit->closeConnection();
}



// Check if email exists
function checkIfEmailExists($email)
{
	$connect = new MySQLDatabase;
    $stmt = $connect->query("SELECT * FROM tbl_patients WHERE email = '$email' LIMIT 1");
    // $stmt-> $connect->prepare($stmt);
    // $user = $stmt->fetch();

    if ($stmt) {
        return "Email already exist. Please use another email";
    }
    $connect->closeConnection();
}