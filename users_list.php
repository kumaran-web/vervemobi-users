<?php
$pageTitle = "Users";
include "includes/header.php";
?>

<!-- Begin page content -->
<main role="main" class="container">
	<h1 class="mt-5">Users</h1>
	
	<?php
	$usersColumns = 6;
	?>
	<table id="usersData" class="table table-responsive table-bordered">
		<thead>
			<tr>
				<th>#</th>
				<th>User Name</th>
				<th>Password</th>
				<th>City</th>
				<th>DOB</th>
				<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
			<tr>
				<td colspan="<?=$usersColumns?>" class="loader">
					<i class="fa fa-spinner fa-spin"></i> Loading...
				</td>		
			</tr>
		</tbody>
	</table>
</main>
<!-- End page content -->

<script>
var usersColumns = '<?=$usersColumns?>';

$(document).ready(function(){
	loadUsersData();
});

function loadUsersData(){
	var usersTable = $('#usersData tbody');
	
	$.get('load-users', function(data){
		var info = jQuery.parseJSON(data);
		
		if(info.success){
			setTimeout(function(){
				var userData = info.response;
				
				var sno = 1;
				var htmlData = '';
				for(var u = 0;u < userData.length;u++){
					var user = userData[u];
					
					var user_id 		= user.user_id;
					var user_name		= user.user_name;
					var user_password	= user.user_password;
					var user_city		= user.user_city;
					var user_dob		= user.user_dob;
					
					var editOnlick		= "edit_user('"+user_id+"');";
					
					htmlData += '<tr id="user_row_'+user_id+'">';
						htmlData += '<td>'+sno+'</td>';
						htmlData += '<td class="editableColumn" id="userName'+user_id+'">'+user_name+'</td>';
						htmlData += '<td class="editableColumn" id="userPass'+user_id+'">'+user_password+'</td>';
						htmlData += '<td class="editableColumn" id="userCity'+user_id+'">'+user_city+'</td>';
						htmlData += '<td class="editableColumn" id="userDob'+user_id+'">'+changeDateFormat(user_dob)+'</td>';
						htmlData += '<td><button type="button" class="btn btn-primary btn-sm" id="update_btn_'+user_id+'" onclick="'+editOnlick+'">Edit</button></td>';
					htmlData += '</tr>';
					
					sno++;
				}
				
				usersTable.html(htmlData);
			}, 1000);
		}
		else{
			setTimeout(function(){ 
				usersTable.html('<tr><td colspan="'+usersColumns+'">'+info.response+'</td></tr>');
			}, 1000);
		}
	});
}

function edit_user(user_id){
	var updateBtn = $("#update_btn_"+user_id);
	
	updateBtn.removeClass();
	updateBtn.attr('class', 'btn btn-warning btn-sm');
				
	updateBtn.html('Save');
	updateBtn.attr("onclick", "update_user('"+user_id+"')");
	
	updateBtn.parents('tr').find('td.editableColumn').each(function() {
		var html = $(this).html();
		var input = $('<input type="text" class="form-control editableRecords" />');
		input.val(html);
		
		$(this).html(input);
	});
}

function update_user(user_id){
	var updateBtn = $("#update_btn_"+user_id);
	
	updateBtn.removeClass();
	updateBtn.attr("onclick", "");
	updateBtn.html('<i class="fa fa-spinner fa-spin"></i>');
	
	var updatedInfo = {};
	updatedInfo['userID'] = user_id;
	updateBtn.parents('tr').find('td.editableColumn').each(function() {
		var getUpdatedField = $(this).attr('id').slice(0,-1);
		var getUpdatedValue = $(this).find('input').val();
		
		updatedInfo[getUpdatedField] = getUpdatedValue;
	});
	
	$.post('update-user', updatedInfo, function(data){
		var info = jQuery.parseJSON(data);
		
		if(info.success){
			updateBtn.attr('class', 'btn btn-success btn-sm');
			updateBtn.html('<i class="fa fa-check"></i>');
			
			setTimeout(function(){
				updateBtn.parents('tr').find('td.editableColumn').each(function() {
					var getUpdatedValue = $(this).find('input').val();
					
					$(this).html(getUpdatedValue);
					
					updateBtn.removeClass();
					updateBtn.attr('class', 'btn btn-primary btn-sm');
					
					updateBtn.html('Edit');
					updateBtn.attr("onclick", "edit_user('"+user_id+"')");
				});
			}, 1000);
		}
		else{
			updateBtn.attr('class', 'btn btn-danger btn-sm');
			updateBtn.html('<i class="fa fa-times"></i>');
			
			setTimeout(function(){
				updateBtn.removeClass();
				updateBtn.attr('class', 'btn btn-primary btn-sm');
				
				updateBtn.html('Edit');
				updateBtn.attr("onclick", "edit_user('"+user_id+"')");
			}, 1000);
		}
	});
}
</script>

<?php
include "includes/footer.php";
?>
	