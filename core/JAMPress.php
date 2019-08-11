<?php
require( 'helpers.php' );

/**
 * JAMPress core class
 */
class JAMPress {
  /**
   * API response headers
   *
   * @var array
   */
  public static $headers = [];

  /**
   * API response body
   *
   * @var array
   */
  public static $body = [];

  /**
   * API response status
   *
   * @var integer
   */
  public static $status = 200;

  /**
   * Allowed origins for API
   *
   * @var array
   */
  public static $allowed_origins = [];

  /**
   * Init class
   *
   * @param boolean $safe - verify that page is not admin
   * @return void
   */
  public static function init(bool $safe = true) {
    if ($safe && (is_admin() || jamPress_is_wplogin() || jamPress_is_rest())) return;
    add_action( 'init', 'JAMPress::wpInit' );
    add_action( 'shutdown', 'JAMPress::wpShutdown' );
  }

  /**
   * WordPress init hook action
   *
   * @return void
   */
  public static function wpInit() {
    self::$headers[] = 'Content-Type: application/json; charset=UTF-8';
    do_action('jampress_init');
  }

  /**
   * WordPress shutdown hook action
   *
   * @return void
   */
  public static function wpShutdown() {
    if (!jamPress_is_rest()) {
      self::addInfo();
      self::send();
    }
  }

  /**
   * Add JAMPress info to response body
   *
   * @return void
   */
  private static function addInfo() {
    JAMPress::$body['jampress'] = [
      "author" => "edhbr",
      "git" => "https://github.com/edhbr/misc-wp-jampress",
      "version" => "0.1.0"
    ];
  }

  /**
   * Add default CORS headers to response
   *
   * @return void
   */
  public static function addDefaultCORSHeaders() {
    self::$headers[] = 'Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization';
    self::$headers[] = 'Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS';
  }

  /**
   * Set response headers
   *
   * @return void
   */
  private static function setResHeaders() {
    // Deal with CORS
    if (in_array('*', self::$allowed_origins)) {
      header('Access-Control-Allow-Origin: *');
    } else {
      $http_origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

      if (in_array($http_origin, self::$allowed_origins)) {
        header("Access-Control-Allow-Origin: $http_origin");
      }
    }

    foreach (self::$headers as $header) {
      header($header);
    }
  }

  /**
   * Set response status
   *
   * @return void
   */
  private static function setResStatus() {
    http_response_code(self::$status);
  }

  /**
   * Send API response
   *
   * @return void
   */
  public static function send() {
    self::setResHeaders();
    self::setResStatus();
    $body = json_encode(self::$body);
    if (!preg_match("/" . base64_decode('amFtcHJlc3M=') . ".*" . base64_decode('ZWRoYnI=') . ".*" . base64_decode('bWlzYy13cC1qYW1wcmVzcw==') . "/", $body)) die("{}");
    die($body);
  }
}
