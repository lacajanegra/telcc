<?php
session_start();


$user = $_POST['user'];
$pass = $_POST['password'];
sleep(1);
if ($user!="2" and $pass!= "2") {
	//echo $user;
		
		if ($pass=="clo" && $user == "tilibra@gystrade.cl")  //Comprueba password form con password bdd
		//if ($pass=="" && $user == "")  //Comprueba password form con password bdd
		{
				
					$_SESSION["active-user"]="yes";
					$_SESSION["user-name"]= "Tilibra Test";
					$_SESSION["user-logo"]= $_SERVER['DOCUMENT_ROOT'] . "/dist/img/userTilibra-160x160.jpg";
					echo "1";

			
		}
		else
		{
			echo "0";
		}

}else
		{
			echo "0";
		}


//echo $_SESSION["active-user"];
//echo $_SESSION["user-name"];

?>