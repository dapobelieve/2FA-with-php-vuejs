<?php
include "handle.php";

if(empty($_POST['message']))
{
	echo "Cannot send empty reply";
}else
{
	$id = $_POST['msgId'];
	$msg = $_POST['message'];

	$sql = mysqli_query($con,"UPDATE tbl_msg SET reply = '$msg', status = 'R' WHERE id =  $id ");
	echo 1;
}

?>