<?php
  if ( ! defined('BASEPATH')) exit('Tidak ada akses skrip langsung yang diizinkan');

  class Url {

    function test_url(){
      // echo "Test URL OK";
    }

    public function base_url(){
      $base_url = (empty($_SERVER['HTTPS']) OR strtolower($_SERVER['HTTPS']) === 'off') ? 'http' : 'https';
      $base_url .= '://'. $_SERVER['HTTP_HOST'];
      $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

    	return $base_url;
    }

    function get_url(){
      // $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    	$url	= $_SERVER['QUERY_STRING'];
    	return $url;
    }

    function parsing_url(){
      $uri = parse_url(base_url(), PHP_URL_PATH);
      return str_replace(array('//', '../'), '/', trim($uri, '/'));
    }

    function url_tb(){
      $url = 'http://mandala.web.id/';
      return $url;
    }

  }
