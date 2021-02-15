
<?php
	$env = 'online'; // lokal atau online

	if($env=='lokal'){
		$host	 		= "localhost";
		$user	 		= "root";
		$pass	 		= "";
		$dabname	= "kopkarw1_kope";
		$base			= "http://localhost/project/koprasi/";
	}else{
		$host	 		= "ftp.simks.id";
		$user		 	= "simf1855_koperasi_oi";
		$pass	 		= "koperasi@2021";
		$dabname 	= "kopkarw1_kope";
		$base			= "http://koperasi-oi.simks.id/";
	}

	// $conn = mysql_connect( $host, $user, $pass) or die('Could not connect to mysql server.' );
	// mysql_select_db($dabname, $conn) or die('Could not select database.');

	$koneksi = mysqli_connect($host, $user, $pass, $dabname);

	$baseurl=$base;
?>
