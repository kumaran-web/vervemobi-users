<?php
include "../classes/db.php";
include "../classes/users.php";
extract($_GET);

$user_obj = new UsersClass($db);

if(isset($p) && $p!=""){
	$page = $p - 1;	
}
else{
	$p = 1;
	$page = 0;
}
$page = -1;

$user_obj->set('user_status', 0);
$users_list = $user_obj->get_users_list($page);

// echo "<pre>", print_r($users_list) ,"</pre>";

if(!empty($users_list)){
	echo json_encode(array('success' => true, 'response' => $users_list));
}
else{
	echo json_encode(array('success' => false, 'response' => 'No data found'));
}

?>