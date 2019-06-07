<?php

	//Standard Config File w/ connection, timezone and db prefix
	//Copyright 2019 Lukas Dörr / RZDEV.DE | Alle Rechte vorbehalten.
	
	
	//Database Connection placeholder
	define('host','localhost');
	define('user','root');
	define('pass','');
	define('db','standard_user');
	
	//Prefix for database
	define('pfx','');
	
	//Default Timezone
	date_default_timezone_set('Europe/Berlin');
	
	//Database Connection
	$con = mysqli_connect(host, user, pass, db);
	