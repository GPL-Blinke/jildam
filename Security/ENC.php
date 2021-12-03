<?php

/* Encriptacion y desencriptacion */

function enct($data, $key) {
  $encryption_key = base64_decode($key);
  $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
  $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
  return base64_encode($encrypted . '::' . $iv);
}

function denct($data, $key) {
  $encryption_key = base64_decode($key);
  list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
  return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}

/* Generador seguro */
function keygen($type){
  $base = random_bytes(22);
  $pass =  crypt($base, );
  var_dump($pass); /*
  for ($i=0; $i < 10; $i++) { 
      $pass =  crypt('myNewPassword', '$2y$15$usesomesillystringforsalt$');
  }*/
}

function better_crypt($input, $rounds = 7)
{
  $salt = "";
  $salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9));
  for($i=0; $i < 22; $i++) {
    $salt .= $salt_chars[array_rand($salt_chars)];
  }
  return crypt($input, sprintf('$2a$%02d$', $rounds) . $salt);
}

//keygen();

?>