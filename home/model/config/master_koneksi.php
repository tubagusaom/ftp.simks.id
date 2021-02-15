
<?php
	$env = 'lokal'; // lokal atau online

	if($env=='lokal'){
		$host	 		= "localhost";
		$user	 		= "root";
		$pass	 		= "";
		$dabname	= "kopkarw1_kope";
		$base			= "http://localhost/project/koprasi/";
	}else{
		$host	 		= "localhost";
		$user		 	= "root";
		$pass	 		= "";
		$dabname 	= "kopkarw1_kope";
		$base			= "http://ebe.esy.es/";
	}

	// $conn = mysql_connect( $host, $user, $pass) or die('Could not connect to mysql server.' );
	// mysql_select_db($dabname, $conn) or die('Could not select database.');

	$koneksi = mysqli_connect($host, $user, $pass, $dabname);

	$baseurl=$base;
?>
