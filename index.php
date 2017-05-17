<?php
// Enviroment
$ROOT = ".";  define("ROOT", $ROOT);
include_once( ROOT . "/InstagramObject/InstagramObject.php");

echo "<a href='$Instagaram_login_url;'>Instagram Login</a>";
$AT = array( "access_token" => $access_token );

$user_id = "4647836027"; //https://www.instagram.com/mkti.marketing/?__a=1
$media_id = "1503712689956063794_4647836027";


// Poder hacer los siguientes 3 llamados sólo con el Objeto HTTPRequester
// antes de querer construir el InstagramObject.
echo "<br><br>";
echo "Perfil:<br>";
echo file_get_contents("https://api.instagram.com/v1/users/$user_id/?access_token=$access_token");
echo "<br><br>";

echo "Posts Recientes:<br>";
echo file_get_contents("https://api.instagram.com/v1/users/$user_id/media/recent/?access_token=$access_token");
echo "<br><br>";

echo "1 Post en especifico:<br>";
echo file_get_contents("https://api.instagram.com/v1/media/$media_id?access_token=$access_token");
echo "<br><br>";



?>
