<?php
include('../../extension/connect.php');
include('../../extension/check-login.php');


if(!isset($_POST['uid']) && empty($_POST['uid'])){
	
}else{
	$u = mysqli_real_escape_string($con,$_POST['uid']);
	$up = mysqli_real_escape_string($con,$_POST['upline']);
    $newpass = rand(0,9999991);
    $authvpn = md5($newpass);
    
    $query = mysqli_query($con,"UPDATE users SET user_pass = '$newpass', user_encryptedPass = '$authvpn' WHERE user_id='$u' and user_upline='$up'");
    if($query)
    {
    	$data['response'] = 1;
    }else{
    	$data['response'] = 0;
    }
    	
	echo json_encode($data);
}
?>