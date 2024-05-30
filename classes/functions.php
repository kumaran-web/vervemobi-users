<?php
if(!function_exists('getCurrentPage')){
	function getCurrentPage(){
		$scriptName = $_SERVER['SCRIPT_NAME'];
		$pageName	= basename($scriptName);
	
	    $pageNameWithoutExtension = pathinfo($pageName, PATHINFO_FILENAME);
	
	    return $pageNameWithoutExtension;	
	}
}
?>