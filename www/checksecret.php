<?php

  $require_login = true;

  require '../knoopvszombies.ini.php';

  require 'module/includes.php';

  require 'module/general.php';
  
  if (!$GLOBALS['User']->RateLimit(1)) {
    header('X-PHP-Response-Code: 429', true, 403);
    echo(json_encode(array('error' => 'Too many requests; please wait before trying again.')));
    exit;
  }
  
  if (!isset($_GET['secret'])) {
    header('X-PHP-Response-Code: 400', true, 400);
    exit;
  }
  
  if (!$GLOBALS['state'] || !$GLOBALS['state']['active']) {
    header('X-PHP-Response-Code: 404', true, 404);
    echo(json_encode(array('error' => 'No active game')));
    exit;
  }

  $secret = $_GET['secret'];
  $check  = $GLOBALS['Game']->CheckSecretValid($GLOBALS['state']['gid'], $secret, true);
   
  if ($check[0]) {
    header('X-PHP-Response-Code: 200', true, 200);
    header('x-check: '.$check[1]);
    echo(json_encode(array('time' => $check[2])));
    exit;
  } else {
    header('X-PHP-Response-Code: 404', true, 404);
    echo(json_encode(array('error' => $check[1])));
    exit;
  }
?>
