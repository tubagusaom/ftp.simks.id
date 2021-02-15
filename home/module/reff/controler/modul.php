<?php

	if(isset($_GET['Refferensi'])){
			include "module/".$_MODULE[$i]."/view/refferensi.php";
	}
	elseif(isset($_GET['Detail-Akun'])){
			include "module/".$_MODULE[$i]."/view/detail_akun.php";
	}
	// ---------------------------------------------------------- //
	elseif(isset($_GET['Hak-Akses'])){
			include "module/".$_MODULE[$i]."/view/hak_akses.php";
	}
	elseif(isset($_GET['Proses-Akses'])){
			include "module/".$_MODULE[$i]."/model/akses_proses.php";
	}
	elseif(isset($_GET['Edit-Akses'])){
			include "module/".$_MODULE[$i]."/view/ubah_akses.php";
	}
	elseif(isset($_GET['Proses-Edit-Akses'])){
			include "module/".$_MODULE[$i]."/model/akses_proses.php";
	}
	// ---------------------------------------------------------- //
	elseif(isset($_GET['Edit-Refferensi'])){
			include "module/".$_MODULE[$i]."/view/ubah_refferensi.php";
	}
	elseif(isset($_GET['Proses-Edit-Ketentuan'])){
			include "module/".$_MODULE[$i]."/model/ubah_proses_refferensi.php";
	}
	elseif(isset($_GET['Proses-Ubah-Password'])){
			include "module/".$_MODULE[$i]."/model/password_proses.php";
	}
	elseif(isset($_GET['Logout'])){
			// unset($_SESSION['kd_user']);

			// session_start();
			if(isset($_SESSION['kd_user'])){
				session_unset();
				session_destroy();
			}

			echo"<script>location.replace('../')</script>";
	}
?>
