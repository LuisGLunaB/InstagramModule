<?php
include_once( ROOT . "/InstagramObject/credentials.php");


//Construir este objeto primero...
class HTTPRequester{
  // $Parameters es un array associativo con los datos a enviar
  public function REQUEST($URL,$Parameters,$Request_type="POST"){
    //esta función es la principal, todos los request pasan por aquí
    //va a ser muy parecida a mi funcion "CURL" que escribi más abajo
    return $data;
  }
  public function GET($URL,$Parameters){
    //Codigo especial para GETS
    $data = $this->REQUEST($URL,$Parameters,"GET");
    return $data;
  }
  public function POST($URL,$Parameters){
    //Codigo especial para POSTS
    $data = $this->REQUEST($URL,$Parameters,"POST");
    return $data;
  }
  public function DEL($URL,$Parameters){
    //Codigo especial para DELS
    $data = $this->REQUEST($URL,$Parameters,"DEL");
    return $data;
  }
}

//...y después éste.
class InstagramObject extends HTTPRequester{
  protected $API = "https://api.instagram.com/";
  protected $app_id = "";
  protected $app_secret = "";
  protected $access_token = "";
  //protected o public... las demas variables de credentials.php
  public $data = "";
  //funciones especificas de Instagram, tratando de que la mayoria de las variables
  //que necesiten los llamados ya sean attributos dentro del Objeto.
  //Ejemplo:
  public function getUser($user_id){
    $API = $this->API;
    $access_token = $this->access_token;

    $Parameters = array(
      "user_id" => $user_id,
      "access_token" => $access_token
    );//solo es un ejemplo, no sé que key/values te pida cada llamado

    $this->data = $this->POST("$API/direccion_especifica_para_este_llamado",$Parameters);
    return $this->data;
  }
}

function CURL($endpoint,$params=NULL){
  //Funcion para hacer un POST enviando datos.
  $params = ( is_null($params) ) ? array("dummypost1"=>12345) : $params;
  $handler = curl_init( $endpoint );
  curl_setopt( $handler, CURLOPT_POST, 1);
  //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
  curl_setopt( $handler, CURLOPT_POSTFIELDS, http_build_query($params) );
  //curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json',"OAuth-Token: $token"));
  curl_setopt( $handler, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt( $handler, CURLOPT_HEADER, 0);
  curl_setopt( $handler, CURLOPT_RETURNTRANSFER, 1);

  return curl_exec( $handler );
}

function sCURL($endpoint, $params, $secret){
  $sig = generate_sig($endpoint, $params, $secret);
  return CURL($endpoint, array("access_token"=>$params["access_token"],"sig"=>$sig) );
}
function generate_sig($endpoint, $params, $secret) {
  //Este es un ejemplo que copié y pegue de Instagram para hacer request encriptados
  $sig = $endpoint;
  ksort($params);
  foreach ($params as $key => $val) {
    $sig .= "|$key=$val";
  }
  return hash_hmac('sha256', $sig, $secret, false);
}
