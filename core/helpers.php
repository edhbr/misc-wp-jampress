<?php
/**
 * Checks if the current request is a WP REST API request
 *
 * @return boolean
 */
function jamPress_is_rest() {
  $prefix = rest_get_url_prefix();
  if (defined('REST_REQUEST') && REST_REQUEST
      || isset($_GET['rest_route'])
          && strpos( trim( $_GET['rest_route'], '\\/' ), $prefix , 0 ) === 0)
      return true;

  $rest_url = wp_parse_url( home_url( $prefix ) );
  $current_url = wp_parse_url( add_query_arg( array( ) ) );
  return strpos( $current_url['path'], $rest_url['path'], 0 ) === 0;
}

/**
 * Checks if the current page is a login page
 *
 * @return boolean
 */
function jamPress_is_wplogin() {
  $ABSPATH = str_replace(array('\\','/'), DIRECTORY_SEPARATOR, ABSPATH);
  return ((in_array($ABSPATH.'wp-login.php', get_included_files()) || in_array($ABSPATH.'wp-register.php', get_included_files()) ) || (isset($_GLOBALS['pagenow']) && $GLOBALS['pagenow'] === 'wp-login.php') || $_SERVER['PHP_SELF']== '/wp-login.php');
}
