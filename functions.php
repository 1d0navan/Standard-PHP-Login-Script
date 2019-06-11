<?php

	//Standard Function Library
	//Copyright 2019 Lukas Dörr / RZDEV.DE | Alle Rechte vorbehalten.
	
	//REQUIRES FUNTINOAL CONFIGURATION config.php!!
	
	function clean($input)
	{
		include 'config.php';
		return mysqli_real_escape_string($con, $input);
	}
	
	function idgen($length = 16, $type = 4) 
    	{
		include 'config.php';
		
		//If Type = 1 (Only numbers)
		if($type == 1)
		{
			$characters = '0123456789';
		}
		
		//Only lower and upper letters
		if($type == 2)
		{
			$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		}
		
		//Numbers and letters BIG
		if($type == 3)
		{
			$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		}
		
		//Upper and lower letters, numbers and special chars
		if($type == 4)
		{
			$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*+-#?$%&/!:.,";
		}
		
		//Generate ID
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) 
		{
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		
		//Send back the ID
		return $randomString;
   	}
	
	
