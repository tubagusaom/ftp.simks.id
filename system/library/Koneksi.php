<?php
  if ( ! defined('BASEPATH')) exit('Tidak ada akses skrip langsung yang diizinkan');

class Koneksi {
  // public static $koneksi;

  function testkoneksi(){
    echo "KONEKSI OK";
  }

  function login($koneksi){

     if (isset($_POST['login'])) {
       $user		=$_POST['username'];
       $pass		=md5($_POST['password']);

       $cekuser	= mysqli_query($koneksi,"SELECT a.id, a.id_akun, a.kd_user, a.pw_user AS password, a.akses_user, b.kd_user AS id_user, b.kd_role AS akses
         FROM user a JOIN t_user_role b ON b.kd_user = a.id WHERE a.kd_user='$user' AND a.stts_user NOT LIKE '3'AND a.stts_user NOT LIKE '4' AND a.stts_user NOT LIKE '5' AND a.stts_user NOT LIKE '6'");

       $jumlah	= mysqli_num_rows($cekuser);
       $hasil		= mysqli_fetch_array($cekuser);

       // if ($jumlah>0){
       //   var_dump($hasil); die();
       //
       //   session_unset();
 				//  session_destroy();
       // }

       if ($jumlah==0){
           echo "<script>alert('WARNING, ANDA TIDAK BERHAK AKSES !!!')</script>";
         }
       else{
         if($pass!=$hasil['password']) {
           echo "<script>alert('PASSWORD SALAH'); location.href=''</script>";
         }else{
           $_SESSION['id']=$hasil['id'];
           $_SESSION['id_akun']=$hasil['id_akun'];
           $_SESSION['kd_user']=$hasil['kd_user'];
           $_SESSION['akses_user']=$hasil['akses_user'];
           $_SESSION['id_user']=$hasil['id_user'];
           $_SESSION['akses']=$hasil['akses'];
           echo"<script>location.replace('home/')</script>";
         }
       }
     }
  }

  function logSesion($koneksi){
    if(isset($_SESSION['akses'])){
      echo "<script>location.replace('home/')</script>";
    }else {
      return $this->login($koneksi);
    }
  }

  function sesiOn(){
  	$logout = "../"; // redirect halaman logout

    if (isset($_SESSION['akses'])) {
      $timeout = 30; // setting timeout dalam menit

    	$timeout = $timeout * 60; // menit ke detik
    	if(isset($_SESSION['start_session'])){
    		$elapsed_time = time()-$_SESSION['start_session'];
    		if($elapsed_time >= $timeout){
    			session_destroy();
    			echo "<script type='text/javascript'>alert('Sesi telah berakhir');window.location='$logout'</script>";
    		}
    	}

    }else {
      header("Location: $logout");
    }

  	$_SESSION['start_session']=time();
  }

  function akses($akses){

    $data = array(
      '3' => 'superuser',
      '4' => 'ketua',
      '5' => 'admin',
      '16' => 'sekertaris',
      '17' => 'akunting',
      '18' => 'analis',
      '19' => 'anggota'
    );

    return $data[$akses];

  }

  // function DBakses(){
  //   $data1 = APPPATH."model/config/master_koneksi".EXT;
  //   $data2 = APPPATH."controler/init".EXT;
  //
  //   $link1 = fopen($data1, "r");
  //   $link2 = fopen($data2, "r");
  //
  //   return $link1;
  //   return $link2;
  // }

  //
  // function test_koneksi(){
  //   echo "Test Koneksi OK";
  // }

}
// spl_autoload_register("_library");
