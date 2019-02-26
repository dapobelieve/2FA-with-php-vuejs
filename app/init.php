<?php
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");


require_once ('MySQLDatabase.php');

//used for common user functions
require_once ('User.php');

// used to build the reponse class
require_once ('Response.php');

//for generating hashes
require_once  ('../core/Hash.php');