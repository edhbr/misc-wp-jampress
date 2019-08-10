<?php
/**
 * Plugin Name: JAMPress
 * Plugin URI: https://github.com/edhbr/misc-wp-jampress
 * Description: A plugin to help make WordPress headless
 * Version: 0.1.0
 * Author: edhbr
 * Author URI: https://github.com/edhbr
 */

class JAMPress {
  public static $res = [];

  public static function init() {
    add_action( 'init', 'JAMPress::wpInit' );
    add_action( 'shutdown', 'JAMPress::wpShutdown' );
  }

  public static function wpInit() {
    JAMPress::$res['jampress'] = [
      "author" => "edhbr",
      "git" => "https://github.com/edhbr/misc-wp-jampress",
      "version" => "0.1.0"
    ];
  }

  public static function wpShutdown() {
    header("Content-Type: application/json; charset=UTF-8");
    self::send();
  }

  public static function send() {
    $res = json_encode(self::$res);
    if (!preg_match("/" . base64_decode('amFtcHJlc3M=') . ".*" . base64_decode('ZWRoYnI=') . ".*" . base64_decode('bWlzYy13cC1qYW1wcmVzcw==') . "/", $res)) die("{}");
    die($res);
  }
}

JAMPress::init(true);

