<?php
  if ( ! defined('SYSDIR')) exit('Tidak ada akses skrip langsung yang diizinkan');

  $view_folder = 'home/view';
  $library = 'library';
  $support = 'support';
  $view_folder = str_replace("\n\r", ".", rtrim("\n\r\n\r/".$view_folder).'/');

  define('BASEPATH', str_replace("\\", "/", str_replace(" ", "", SYSDIR)));
  define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
  define('FCPATH', str_replace(SELF, '', __FILE__));
  define('VPATH', $view_folder  );
  define('LIBRARY', $library );
  define('SUPPORT', $support );
  define('EXT', '.php');

  $app_folder = "home";
  $app_folder = str_replace("\n\r", ".", rtrim("\n\r\n\r/".$app_folder).'/');

  if (is_dir($app_folder)) {
      define('APPPATH', $app_folder );
  } else {
      if (!is_dir(SYSDIR . '/')) {
          exit("Jalur folder aplikasi Anda tidak disetel dengan benar. Silakan buka file berikut dan perbaiki ini: " . SELF);
      }

      define('APPPATH', BASEPATH . $app_folder );
  }

  require_once SYSDIR.'controler.php';
  require_once APPPATH."model/config/master_koneksi.php";
  require_once APPPATH.'controler/init.php';

  // echo BASEPATHX;








  // define('APPPATH', $app_folder );

  // echo BASEPATHX;



  // echo testtesttest();

  // $akses = $this_login->akses(5);

  // class RP extends RP_Controller{}

  // class Demos {
  //    function Demo() {
  //       return(true);
  //    }
  //    function displayOne() {
  //       return(true);
  //    }
  //    function displayTwo() {
  //       return(true);
  //    }
  // }
  //
  // $method = get_class_methods(new Demos());
  // foreach ($method as $key => $method_name) {
  //    echo "$method_name \n";
  // }


// echo "<b style='color:red'>".register_shutdown_function('')."</b>";
