<?php
include "../classes/db.php";
include "../classes/users.php";
extract($_POST);

$user_obj = new UsersClass($db);

$user_obj->set('user_id', $userID);
$user_obj->set('user_name', $userName);
$user_obj->set('user_password', $userPass);
$user_obj->set('user_city', $userCity);
$user_obj->set('user_dob', date('Y-m-d', strtotime($userDob)));
$update_status = $user_obj->update_user();

if($update_status){
	echo json_encode(array('success' => true, 'response' => 'Updated Successfully!'));
}
else{
	echo json_encode(array('success' => false, 'response' => 'Failed!'));
}

?>