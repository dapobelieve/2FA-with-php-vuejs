<?php

include "handle.php";

$name   = mysqli_real_escape_string($con,$_POST["fname"]);
$email  = mysqli_real_escape_string($con,$_POST['email']);
$mobile = mysqli_real_escape_string($con,$_POST['phone']);
$pass1  = mysqli_real_escape_string($con,$_POST['pass1']);
$pass2  = mysqli_real_escape_string($con,$_POST['pass2']);
$agegrp  = mysqli_real_escape_string($con,$_POST['ageup']);

// $address1 = $_POST['address1'];
// $address2 = $_POST['address2'];

//pregmatch strings
$mname = "/^[A-Z][a-zA-Z ]+$/";
$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
$number = "/^[0-9]{11}+$/";



if(empty($name) || empty($email) || empty($mobile) || empty($pass1) || empty($pass2)){
		
		echo "
			<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please Fill all fields..!</b>
			</div>
		";
		exit();
	}else {
	
			// if(strlen($pass1) < 7 ){
			// 	echo "
			// 		<div class='alert alert-danger'>
			// 			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			// 			<b>Password is weak</b>
			// 		</div>
			// 	";
			// 	exit();
			// }
			// if(strlen($pass2) < 7 ){
			// 	echo "
			// 		<div class='alert alert-danger'>
			// 			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			// 			<b>Password is weak</b>
			// 		</div>
			// 	";
			// 	exit();
			// }

			
			
			if(!preg_match($number,$mobile)){
				echo "
					<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Mobile number $mobile is not valid</b>
					</div>
				";
				exit();
			}

			if(!(strlen($mobile) == 11)){
				echo "
					<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Mobile number must be 11 digit</b>
					</div>
				";
				exit();
			}

		//existing email address in our database
		$sql = "SELECT id FROM tbl_patients WHERE email = '$email' LIMIT 1" ;
			$check_query = mysqli_query($con,$sql);
			$count_email = mysqli_num_rows($check_query);
			if($count_email > 0){
				echo "
					<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Email Address is already available Try Another email address</b>
					</div>
				";
				exit();
			}
			//phone number verification
			$sql2 = "SELECT id FROM tbl_patients WHERE phn = '$mobile' LIMIT 1" ;
			$check_query2 = mysqli_query($con,$sql2);
			$count_phone = mysqli_num_rows($check_query2);
			if($count_phone > 0){
				echo "
					<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Phone Number is already available in our Database</b>
					</div>
				";
				exit();
			}


			
			if($pass1 != $pass2){
				echo "
					<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>password is not same</b>
					</div>
				";exit();
			
			} else {
				$pass1 = $pass1;
				$sql = "INSERT INTO `tbl_patients` 
						VALUES ('', '$name', '$email', '$mobile', '$pass1','$agegrp', CURRENT_TIME())";
				$run_query = mysqli_query($con,$sql)or die(mysqli_error($con));

				$uid = mysqli_insert_id($con);

				$_SESSION['uid'] = $uid;


				if($run_query){
					echo 1;
				}
			}
}
	


?>






















































