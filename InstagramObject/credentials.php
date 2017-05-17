<?php
$debugging = True;

if($debugging){
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}else{
	error_reporting(0);
	ini_set('display_errors', 0);
}

//Credenciales, solcitud de accesso y url de la API.
$client_id = "e391e7968e99432592a235a203192fcc";
$client_secret = "2b51525a5a4845d88cc817d80b2afaeb";
$access_token = "4647836027.e391e79.24d42873cb194f0b92dc4a027c93acb2";

$redirect_uri = "http://instagram.mkti.mx/instagram_login.php";
$scope = "basic+likes+comments+public_content+follower_list+relationships";

$API = "https://api.instagram.com/";
$oAuth_uri = $API . "oauth/authorize/?client_id=$client_id";
$Instagaram_login_url = $oAuth_uri . "&scope=$scope&redirect_uri=$redirect_uri&response_type=code";
