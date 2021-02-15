<?php
  session_start();

  $jalur_sistem = "system";

  define('SYSDIR', str_replace("\n\r", ".", rtrim($jalur_sistem).'/'));
  // define('BASEPATH', str_replace("\\", "/", str_replace(" ", "", SYSDIR)));

  require_once SYSDIR.'Rupro.php';
  // $this_login->logSesion($koneksi);

  // $this_support->test_variable();

?>
