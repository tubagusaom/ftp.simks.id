<?php
  if ( ! defined('BASEPATH')) exit('Tidak ada akses skrip langsung yang diizinkan');

require_once SYSDIR."Loader.php";

class RP_Controller extends Loader {}

function _support($class) {
    $data = SYSDIR.SUPPORT."/{$class}".EXT;
    if (is_readable($data)) {
        require_once $data;
    }
}

function _library($class) {
    $data = SYSDIR.LIBRARY."/{$class}".EXT;
    if (is_readable($data)) {
        require_once $data;
    }
}

spl_autoload_register("_support");
spl_autoload_register("_library");

$this_login   = new Koneksi();
$this_url     = new Url();

$url_support_ = new Url_support();
$url_support_->methodarray($this_url);


function base_url() {
  return BASEURL;
}

function get_url(){
  return GETURL;
}

function parsing_url(){
  return PARSINGURL;
}

function url_tb(){
  return URLTB;
}

function merge_get_url($url_get){
  return I_Controler::merge_get_url($url_get);
}

function load_views($file,$data, $store = false){
  return I_Controler::load_view($file,$data, $store = false);
}

function load_view($view){
  return I_Controler::load_view($view);
}

function load_file($file){
  return Loader::load_file($file);
}




// define('AOM', array('Kliwon', 'Legi', 'Pahing', 'Pon', 'Wage'));
//   define('SATU', 5 + 3);
//   define('DUA', 2);

// echo BASEPATH;
//
//
//   const ONE = 1 + 1;
//   const TWO = 2;
//
//   // echo ONE + TWO;
//
//   define("GREETING","Hello you! How are you today?");
//   // echo constant('SATU');


// echo APPPATH;
// echo "<br><br>";
