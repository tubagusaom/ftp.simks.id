<?php
  session_start();
  // var_dump($_SESSION['akses']);

  $jalur_sistem = "system";
  $app_folder = "home";

  define('SYSDIR', str_replace("\n\r", ".", rtrim("\n\r\n\r/".$jalur_sistem).'/'));
  // define('BASEPATH', str_replace("\\", "/", str_replace(" ", "", SYSDIR)));

  require SYSDIR.'Rupro.php';
  $this_login->sesiOn();

  // printf (base_url());
  // echo $this_load->load_test();
  // echo SYSDIR;
  // echo load_view('test','data', true);
?>



<html>
	<?php
    require_once load_view('fs_head');
    require_once load_view('fs_body');
  ?>
</html>
