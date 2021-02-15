<?php
  if ( ! defined('BASEPATH')) exit('Tidak ada akses skrip langsung yang diizinkan');

require_once APPPATH.'controler/I_Controler.php';

class Loader extends I_Controler
{
    public static $title, $body, $I_Controler;

    // function __autoload($I_Controler)
    public function __construct()
    {
        $this->title = "Ini class Loader";
        $this->body = "Ini Isi nya";
        // $this->base_url = $I_Controler;
    }

    // function load_db(){
    //     require_once $koneksi = APPPATH."model/config/master_koneksi.php";
    //
    //     return $koneksi;
    // }

    function test_loader(){
      echo "loader ok";
    }

    function load_test(){
        return $this->test();
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getBody()
    {
        return $this->body;
    }
}

// $thisloader = new Loader();

// echo $I_Controler->testicontroler();
// echo login($koneksi);
// $this_load = new Loader;


	// protected $_module;
  // $clas = array();

  // if (! function_exists('base_url')) {
  //   function base_url(){
  // 		echo $this_url;
  //   }
  // }

  // function __autoload($classname) {
  //   $class_name = strtolower($classname);
  //   $path       = "{$classname}.php";
  //
  //   if (file_exists($path)) {
  //     require_once($path);
  //   } else {
  //     die("The file {$classname}.php could not be found!");
  //   }
  // }

  // spl_autoload_register(function ($classname) {
  //     @require_once(APPPATH."controler/$classname.php");
  // });







  // echo $classname;

  // $classname = new I_Controler;

  // function base_url(){
  //   return I_Controler::base_url();
  // }

  // function get_url(){
  //   return I_Controler::get_url();
  // }
  //
  // function merge_get_url($url_get){
  //   return I_Controler::merge_get_url();
  // }
  //
  // function parsing_url(){
  //   return I_Controler::parsing_url();
  // }


// function base_url(){
//   $base_url = (empty($_SERVER['HTTPS']) OR strtolower($_SERVER['HTTPS']) === 'off') ? 'http' : 'https';
//   $base_url .= '://'. $_SERVER['HTTP_HOST'];
//   $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
//
//   return $base_url;
// }



  // echo APPPATH;
