<?php
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title><?=$pageTitle?></title>
	<link rel="icon" href="assets/images/kumaran_logo.png" type="image/x-icon" />
	
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="assets/css/bootbox.css?v=<?=rand()?>">
	<link rel="stylesheet" href="assets/css/app.css?v=<?=rand()?>">
	
	<script src="assets/js/bootbox.js"></script>
	<script src="assets/js/app.js?v=<?=rand()?>"></script>
</head>

<body>
	
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="home"><?=$web_app_name?></a>
			</div>
			
			<ul class="nav navbar-nav">
				<li class="<?=($pageName == 'index') ? 'active' : '';?>">
					<a href="home">Home</a>
				</li>
				<li class="<?=($pageName == 'users_list') ? 'active' : '';?>">
					<a href="users">Users</a>
				</li>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<li><a href="javascript:;"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
				<li><a href="javascript:;"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			</ul>
		</div>
	</nav>
	