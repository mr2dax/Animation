<?php

include error_reporting(0);

require 'config.php';

session_start();

if (!$_SESSION['status'] || $_SESSION['status'] == 'failed') {
  $parameter['command']='login';
}

$parameter = array_merge($_GET, $_POST);

function clearing_input($input_array) {
  foreach ($input_array as $key=>$value) {
    $value = strip_tags($value, '<b><i><u>');
    $value = preg_replace('/\r\n|\r|\n/', '<br>', $value);
    $value = str_replace('|', '&#124;', $value);
    $input_array[$key] = $value;
  }
  return $input_array;
}

$parameter = clearing_input($parameter);

if (DEBUG) {
  echo '<pre>';
  var_dump($parameter);
  echo'</pre>';
}
switch($parameter['command']) {
  case 'login':
    $_SESSION['status'] = 'failed';
    $users = file(USERS);
    foreach($users as $line) {
      list ($user, $pass) = explode(':', chop($line));
      if ($user==$parameter['login'] && $pass==md5($parameter['passwd'])) {
        $_SESSION['status'] = 'ok';
        $_SESSION['user'] = $user;
        $_SESSION['attempts'] = 1;
        break;
      }
    }
    if ($_SESSION['status']=='ok') {
      require 'start.php';
    } else {
      $_SESSION['attempts']++;
      if ($_SESSION['attempts'] > 3) {
        sleep(10);
      }
      require DEFAULTPAGE;
    }
    break;
  case 'logout':
    session_destroy();
    $cookie = session_get_cookie_params();
    setcookie(session_name(), "", 0, $cookie['path'], $cookie['domain']);
    require DEFAULTPAGE;
    break;
  case 'back':
    require 'start.php';
    break;
  default:
    require DEFAULTPAGE;
}
?>
