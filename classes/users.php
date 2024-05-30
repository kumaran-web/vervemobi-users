<?php 
class UsersClass {
	private $db;

	// user Section
	public $user_id 						=	'';
	public $user_name						=	'';
	public $user_password					=	'';
	public $user_city						=	'';
	public $user_dob						=	'';
	public $user_status						=	'';
	public $user_added_on					=	'';
	
	public $search_page_limit				=	30;
    public $search_total_results			=	0;
    public $search_total_result_pages		=	0;
    
	public $search_keyword					=	'';
	
    function __construct($db) {
		$this->db = $db;
	}
	
	function set($field, $value){
		$this->{$field} = $this->db->escape($value);
	}
	
	function get($field){
		return $this->{$field};
	}
    
	// Users Section
	public function update_user(){
		$record_id = $this->user_id;
		
		if($record_id > 0){
			$update_qry 	= "UPDATE `users` SET `user_name` = ?,`user_password` = ?,`user_city` = ?,`user_dob` = ? WHERE `user_id` = ?";
			$update_types	= 'ssssi';
			$update_params	= array(
								$this->user_name,
								$this->user_password,
								$this->user_city,
								$this->user_dob,
								$record_id
							  );
			
			$update_obj = $this->db->update($update_qry, $update_types, $update_params);
	    	
	    	if($update_obj){
	    		return true;
	    	}
	    	else{
	    		return false;
	    	}
		}
		else{
			return false;
		}
	}
	
	public function get_users_list($p=0){
		$users_list_qry 	= "";
		$users_list_type	= "";
		$users_list_params	= array();
		
		$limit = $this->search_page_limit;
		$start = $p*$limit;
		
		$user_status	= $this->user_status;
		$user_name		= $this->user_name;
		
		$sql_qry = "SELECT <RESULT> FROM `users` WHERE 1 = ? ";
		$users_list_type .= "i";
		$users_list_params[] = 1;
		
		if($user_status != ''){
			$sql_qry .= " AND `user_status` = ? ";
			
			$users_list_type .= "i";
			$users_list_params[] = $user_status;
		}
		
		if($user_name != ''){
			$sql_qry .= " AND `user_name` LIKE ? ";
			
			$users_list_type .= "s";
			for($sk=0;$sk<1;$sk++){
				$users_list_params[] = "%{$user_name}%";
			}
		}
		
		$totalSQL	= str_replace('<RESULT>', 'COUNT(*) AS TOTAL', $sql_qry);
        $total_obj	= $this->db->select($totalSQL, $users_list_type, $users_list_params);
		$total_rows = $total_obj->row->TOTAL;
		
		$this->search_total_results 		= $total_rows;
		$this->search_total_result_pages	= ceil($total_rows/$limit);
        
        $users_list_qry 	= str_replace('<RESULT>', '*', $sql_qry);
        $users_list_qry 	.= " ORDER BY `user_id` ASC";
        
        if($p!=-1){
        	$users_list_qry .= " LIMIT $start, $limit ";
        }
        
        $users_list_obj = $this->db->select($users_list_qry, $users_list_type, $users_list_params);
        $tot_num_rows	= $users_list_obj->num_rows;
        
        if($tot_num_rows > 0){
    		return $users_list_obj->rows;
		}
		else{
			return false;
		}
	}
	
	public function get_user_info(){
		$record_id = $this->user_id;
		
		if($record_id > 0){
			$user_list_qry		= "SELECT * FROM `users` WHERE `user_id` = ?";
			$user_list_type 	= "i";
			$user_list_params	= array(
									$record_id
								  );
			
	        $user_list_obj	= $this->db->select($user_list_qry, $user_list_type, $user_list_params);
	        $tot_num_rows	= $user_list_obj->num_rows;
        
			if($tot_num_rows > 0){
	    		return $user_list_obj->row;
			}
			else{
				return false;
			}
		}
		else{
			return false;	
		}
	}
	
	public function delete_user(){
		$record_id = $this->user_id;
		
		if($record_id > 0){
			$status = 1;
			
			$user_delete_qry	= "UPDATE `users` SET `user_status` = ? WHERE `user_id` = ?";
			$user_delete_type	= 'ii';
			$user_delete_params = array(
									$status,
									$record_id
								  );
			
			$user_delete_obj = $this->db->update($user_delete_qry, $user_delete_type, $user_delete_params);
	    	
	    	if($user_delete_obj){
	    		return true;
	    	}
	    	else{
	    		return false;
	    	}
		}
	}
	
}
?>