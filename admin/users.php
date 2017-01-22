<?php
$users = User::find_all();
?>
<div class="container">
	<div class="row">
		<div class="span12">
			<a id="add-users" class="btn btn-success pull-right"><i class="icon-plus"></i></a>
			<a id="hide-add-users-form" class="btn pull-right hide"><i class="icon-minus"></i></a>
		</div>
		<div class="span12">
			<form onsubmit="return false" action="javascript:void(0)" class="form-horizontal pull-right" style="display: none" id="add-user-form">
				<legend style="text-align: right">Add New User</legend>

				<div class="control-group">
					<label for="email" class="control-label">E-mail</label>
					<div class="controls">
						<input type="text" class="span2" id="email">
					</div>
				</div><!-- End email -->

				<div class="control-group">
					<label for="firstname" class="control-label">First Name</label>
					<div class="controls">
						<input type="text" class="span2" id="firstname">
					</div>
				</div><!-- End firstname -->

				<div class="control-group">
					<label for="lastname" class="control-label">Last Name</label>
					<div class="controls">
						<input type="text" class="span2" id="lastname">
					</div>
				</div><!-- End lastname -->

				<div class="control-group">
					<label for="password" class="control-label">Password</label>
					<div class="controls">
						<input type="password" class="span2" id="password">
					</div>
				</div><!-- End password -->

				<div class="control-group">
					<label for="password2" class="control-label">Confirm</label>
					<div class="controls">
						<input type="password" class="span2" id="password2">
					</div>
				</div><!-- End password2 -->

				<div class="form-actions">
				  	<button type="submit" class="btn btn-primary" id="save-user">Add User!</button>
				  	<img style="margin-left: 10px" class="hide" src="img/ajax-loader.gif" id="loader" alt="Loader">
				</div>
			</form>
		</div>
		<div class="span12">
			<table id="users-table" class="table table-hovered">
				<thead>
					<tr>
						<th>Name</th>
						<th>E-mail</th>
						<th style="text-align: right">Number of events organised</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($users as $user): ?>
						<tr data-id="<?php echo $user->id ?>" class="user">
							<td class="name"><?php echo $user->firstname ?> <?php echo $user->lastname ?></td>
							<td class="email"><?php echo $user->email ?></td>
							<td class="events_count" style="text-align: right"><?php echo $user->count_events() ?></td>
							<td style="text-align: right"><a class="btn btn-danger btn-mini delete-user-button">&times;</a></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function () {
		$('.delete-user-button').on('click', function() {
			var user_name = $(this).parent().siblings('.name');
			var user_row = $(this).parent().parent();

			if(confirm('Are you sure you want to delete "' + user_name.text()+'"?')) {
				delete_user(user_row);
			}
		});

		$('#add-users').on('click', function() {
			$('#add-user-form').slideDown('slow', function() {
				$('#add-users').addClass('hide');
				$('#hide-add-users-form').removeClass('hide');
			});
		});


		$('#hide-add-users-form').on('click', function() {
			$('#add-user-form').slideUp('slow', function() {
				$('#hide-add-users-form').addClass('hide');
				$('#add-users').removeClass('hide');
			});
		});

		function delete_user(user_row) {
			var data = { user_id: user_row.data('id') };
            console.log(data, user_row);
			$.ajax({
				url: "admin/delete_user.php",
				type: "POST",
				data: data,
				success: function(msg) {
					if(msg) {
						var message = '<div class="alert alert-warning"> \
								<button type="button" class="close" data-dismiss="alert">&times;</button> \
								User ' + user_row.children('.name').text() + ' was deleted!</div>';

						$('#users-table').parent()
							.prepend(message);

						user_row.slideUp('slow', function() {
							$(this).remove();
						})
					}
				}
			});
		}

		$('#add-user-form').submit(function() {
			var email = $('#email').val();
			var firstname = $('#firstname').val();
			var lastname = $('#lastname').val();
			var password = $('#password').val();
			var password2 = $('#password2').val();

						/* Email-Verification*/
            if(email === "")
                return alert('Invalid Email');
if ( !(/^[a-z0-9]+_?[a-z0-9]+@[a-z]+.[a-z]{2,3}$/.test(email)))

                return alert('Email format should be as follows: myname@domain.com / nom_prenom@domain.com / me23@yahoo.com');
            
            /* First-Name Verification*/
             if(firstname === "")
                return alert('Invalid First Name');
            if(/[0-9]/.test(firstname))
                return alert('First name can not contain numbers');
                
            /* Last Name Verification*/
         if(lastname === "")
                return alert('Invalid Last Name');
        if(/[0-9]/.test(lastname))
                return alert('Last name can not contain numbers');
                
            /* password verification  */          
       if(password === ""){                
                return alert('Invalid Password');
            }
            if(password2 === ""){                
                return alert('Please confirm your password');
            }

                
       if(password != password2){
                alert(password);
                alert(password2);
                 return alert('Password confirmation did not match.');
                }
               
         
			var data = {
				email: email,
				firstname: firstname,
				lastname: lastname,
				password: password
			};

			$('#save-user').attr('disabled', true);
			$('#loader').removeClass('hide');

			$.ajax({
				url: "admin/insert_user.php",
				data: data,
				type: "POST",
				success: function(user_id) {
					$('#add-user-form :input').val('');
					$('#save-user').attr('disabled', false);
					$('#loader').addClass('hide');

					var message = '<div class="alert alert-success"> \
								<button type="button" class="close" data-dismiss="alert">&times;</button> \
								User ' + data.firstname + ' ' + data.lastname + ' was added successfully!</div>';

					var newRow = '<tr data-id="'+user_id+'" class="user"> \
									<td class="name">'+data.firstname+' '+data.lastname+'</td> \
									<td class="email">'+data.email+'</td> \
									<td class="events_count" style="text-align: right">0</td> \
									<td style="text-align: right"><a class="btn btn-danger btn-mini delete-user-button">&times;</a></td> \
								</tr>';

					$('#users-table').parent()
								.prepend(message);

					$('#users-table').append(newRow);
				}
			});
		});
	});
</script>
