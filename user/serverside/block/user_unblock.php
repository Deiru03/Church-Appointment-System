<?php
include('../../extension/connect.php');
include('../../extension/check-login.php');


if(!isset($_POST['uid']) && empty($_POST['uid'])){
	
}else{
	$u = mysqli_real_escape_string($con,$_POST['uid']);

	$query = mysqli_query($con,"UPDATE users SET is_freeze='0' WHERE user_id='".$u."'");
    if($query)
	{
		$data['response'] = 1;
	}else{
		$data['response'] = 0;
	}
	echo json_encode($data);
}
?>