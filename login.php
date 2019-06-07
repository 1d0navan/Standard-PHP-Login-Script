<?php

	//Standard Login Form with user login validation
	//Copyright 2019 Lukas Dörr / RZDEV.DE | Alle Rechte vorbehalten.
	
	//Load all required files
	require 'config.php';
	require 'functions.php';
	
	//Where to send user when register validation fails. eave blank if the same page is used.
	$fail_url = ""; //?err=1234 will be added.
	
	//Where to send the user, when register was successful?
	$success_url = "index.php?login=success";
	
	//Allow Login Cookie to safe login //TODO
	$login_cookie = false;
	
	//Allow only login, when the email is validated (rank > 1)
	$deny_unferified_email = true;
	
	//Check if connection is ok
	if(!$con)
	{
		//Config is wrong or db is not connected
		?>
		<h1>FAILED TO CONNECT TO DATABASE!</h1>
		<?php
	}
	else
	{
		//Start User Session
		session_start();
		
		//Check if user is allready logged in.
		if(isset($_SESSION['user_id']))
		{
			//User is logged in. send him back
			header('location: user.php?err=1000');
			exit;
		}
		else
		{
			//Login Form or Login Procedere?
			if(!isset($_GET['do']))
			{
				//Login Form
				?>
<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<h1>Standard Login Procedere</h1>
		<form action="login.php?do=validate" method="post">
			<p>
				Username:<br>
				<input type="text" name="username" class="login_form" required autofocus>
			</p>
			<p>
				Password:<br>
				<input type="password" name="password" class="login_form" required>
			</p>
			<?php
				if($login_cookie)
				{
					?>
					<input type="checkbox" name="login_cookie" id="login_cookie" required><span for="login_cookie">Save Login credentials.</span>
					<br>
					<?php
				}
			?>
			<p>
				<br>
				<input type="submit" class="login_form" value="Login">
			</p>
		</form>
	</body>
</html>
				<?php
			}
			else
			{
				//Validate user credentials
				if($_GET['do'] == "validate")
				{
					//Check if password and username isset
					if(!isset($_POST['username']) && !isset($_POST['password']))
					{
						header('location: '.$fail_url.'?err=1001');
						exit;
					}
					else
					{
						//Clean Inputs
						$username = clean($_POST['username']);
						$password = sha1(clean($_POST['password']));
					
						//Select the user, which is not set to deleted. and which rank > 1 because his email needs to be validated.
						$check_user_login_text = "
						SELECT `user_id`, `rank` FROM `".pfx."user` WHERE `username` = '$username' AND `password` = '$password' AND `deleted` = '0' LIMIT 1";
						
						//Run the login query
						$check_user_login_query = mysqli_query($con, $check_user_login_text);
						
						if(!mysqli_num_rows($check_user_login_query))
						{
							//User not found or deleted
							header('location: '.$fail_url.'?err=1002');
							exit;
						}
						else
						{
							$get_user = mysqli_fetch_array($check_user_login_query);
							
							if($deny_unferified_email)
							{
								//Check if user rank is higher than 1, because 2 is verified user
								if($get_user['rank'] <= 1)
								{
									//User Email is not verified
									header('location: '.$fail_url.'?err=1003');
									exit;
								}
							}
							
							//Set User Session
							$_SESSION['user_id'] = $get_user['user_id'];
							
							//Send user to success page
							header('location: '.$success_url);
							exit;
						}
					}
				}
			}
		}
			
			
			
			
			
			
			
			
			
			
			