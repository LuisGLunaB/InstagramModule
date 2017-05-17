<?php
//?code=CODE
//?error=access_denied&error_reason=user_denied&error_description=The+user+denied+your+request
$ROOT = ".";  define("ROOT", $ROOT);
include_once( ROOT . "/InstagramObject/InstagramObject.php");

if( isset($_GET["code"])){
  $params["client_id"] = $client_id;
  $params["client_secret"] = $client_secret;
  $params["grant_type"] = "authorization_code";
  $params["redirect_uri"] = $redirect_uri;
  $params["code"] = $_GET["code"];

  $return = CURL("https://api.instagram.com/oauth/access_token",$params);
}else{
  $return = $_GET;
}

print_r($return);
