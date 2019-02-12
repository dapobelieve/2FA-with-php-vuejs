<?php session_start(); ?>
<?php require_once "process-login.php";?>
<?php require_once "Banker.php";?>
<?php

//make withdrawal
if(isset($_GET['type'])){
	  $name = $_GET['wname'];
	  $amount = $_GET['wamount'];
	  $account = $_GET['waccount'];
	  $banker = new Banker($con, $_SESSION['user_id']);

	  if( $banker->checkAccountNumber($_GET['waccount']) ){

	    if((int)$banker->getBalance($account) < $amount){

	      echo "insufficient funds";
	      exit();

	    }else{

	      echo $banker->withDraw($amount, $account, $name);
	      echo "Transaction Successful";
	    }
	  }else{
	    
	    echo "Account Number does not exist";
	  }
}

//get summary
if(isset($_GET['accountNumber'])){
	// echo "works";
	$account = $_GET['accountNumber'];
	$banker = new Banker($con, $_SESSION['user_id']);
	if( $banker->checkAccountNumber($account) ){
		 echo $banker->getHistory($account);
	}else {
		$res = array(
			'status' => 0,
			'resc'   => 0,
			'msg'    => 'Account Number does not exist',
		);

		echo json_encode($res);
	}
}


//make deposit
if(isset($_GET['account'])){
  $name = $_GET['name'];
  $amount = $_GET['amount'];
  $account = $_GET['account'];

  $banker = new Banker($con, $_SESSION['user_id']);

  if( $banker->checkAccountNumber($_GET['account']) ){

    $banker->deposit($amount, $account, $name);

    echo "Deposit Successful";
  }else {
    echo "Account Number does not exist";
  }
}

//tansfer
if(isset($_GET['fdata'])){
  //check if account numbers exist
  $formData = json_decode($_GET['fdata'], true);
  $sender = $formData['sAcc'];
  $reciever = $formData['rAcc'];
  $amount = $formData['amount'];

  $banker = new Banker($con, $_SESSION['user_id']);
  if($banker->checkAccountNumber($sender)){

    if($banker->checkAccountNumber($reciever)){

      if($banker->getBalance($sender) > $amount){
      	//send money
      	$banker->transfer($sender, $amount, $reciever);
      	echo "Transfer Successful";

      }else{
      	echo "Sender has insufficient funds";
      }

    }else{
      echo "Recievers Account Number does not exist";
      exit();
    }
  }else{
    echo "Senders Account Number does not exist";
    exit();
  }
}

if(isset($_GET['funddata'])){
  //check if account numbers exist
  $formData = json_decode($_GET['funddata'], true);
  $sender = $formData['sAcc'];
  $reciever = $formData['rAcc'];
  $amount = $formData['amount'];
  $desc = $formData['desc'];

  // echo $reciever;

  $banker = new Banker($con, $_SESSION['user_id']);
  if($banker->checkAccountNumber($sender)){
  	
    if($banker->checkAccountNumber($reciever)){

      if($banker->getBalance($sender) > $amount){
      	//send money
      	$banker->transfer($sender, $amount, $reciever, $desc);
      	echo "Payment Successful";

      }else{
      	echo "Sender has insufficient funds";
      }

    }else{
      echo "Recievers Account Number does not exist";
      exit();
    }
  }else{
    echo "Senders Account Number does not exist";
    exit();
  }
}



?>

