<?php

$testkey = "$2a$20$9fhjZD8n/1xU/u/Bh8RuJeHvINt./YaTu7d6t.daWx.zDOV1Ew1Oi";

if (isset($_POST["pass"])) {
    $sha256test = encryptthis($_POST["pass"], $testkey);
    echo $sha256test;
    $sha256testdecrypt = decryptthis($sha256test, $testkey);
    echo "<br>".$sha256testdecrypt;
}
//ENCRYPT FUNCTION
    function encryptthis($data, $key) {
    $encryption_key = base64_decode($key);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
    }
    
    //DECRYPT FUNCTION
    function decryptthis($data, $key) {
    $encryption_key = base64_decode($key);
    list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }


    $privateKey = openssl_pkey_new(array(
        'private_key_bits' => 2048,      // Tamaño de la llave
        'private_key_type' => OPENSSL_KEYTYPE_RSA,
    ));
    // Guardar la llave privada en el archivo private.key. No compartir este archivo con nadie
    openssl_pkey_export_to_file($privateKey, 'private.key');
    
    // Generar la llave pública para la llave privada
    $a_key = openssl_pkey_get_details($privateKey);

    // Guardar la llave pública en un archivo public.key.
    // Envía este archivo a cualquiera que quiera enviarte datos encriptados
    file_put_contents('public.key', $a_key['key']);

    // Libera la llave privada
    openssl_free_key($privateKey);

    // Datos a enviar
    $texto = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eleifend vestibulum nunc sit amet mattis. Nulla at volutpat nulla. Pellentesque sodales vel ligula quis consequat. Suspendisse dapibus dolor nec viverra venenatis. Pellentesque blandit vehicula eleifend.';
    echo 'Texto plano: ' . $texto;
    // Comprimir los datos a enviar
    $texto = gzcompress($texto);
    // Obtener la llave pública
    $publicKey = openssl_pkey_get_public('file:///path/to/public.key');
    $a_key = openssl_pkey_get_details($publicKey);
    // Encriptar los datos en porciones pequeñas, combinarlos y enviarlo
    $chunkSize = ceil($a_key['bits'] / 8) - 11;
    $output = '';
    while ($texto)
    {
        $chunk = substr($texto, 0, $chunkSize);
        $texto = substr($texto, $chunkSize);
        $encrypted = '';
        if (!openssl_public_encrypt($chunk, $encrypted, $publicKey))
        {
            die('Ha habido un error al encriptar');
        }
        $output .= $encrypted;
    }
    openssl_free_key($publicKey);
    // Estos son los datos encriptados finales a enviar:
    $encrypted = $output;

    // Obtener la llave privada
    if (!$privateKey = openssl_pkey_get_private('file:///path/to/private.key'))
        {
            die('No se ha podido obtener la llave privada');
        }
        $a_key = openssl_pkey_get_details($privateKey);
        // Desencriptar los datos de las porciones
        $chunkSize = ceil($a_key['bits'] / 8);
        $output = '';
        while ($encrypted)
        {
            $chunk = substr($encrypted, 0, $chunkSize);
            $encrypted = substr($encrypted, $chunkSize);
            $decrypted = '';
            if (!openssl_private_decrypt($chunk, $decrypted, $privateKey))
            {
                die('Fallo al desencriptar datos');
            }
            $output .= $decrypted;
        }
        openssl_free_key($privateKey);
        // Descomprimir los datos
        $output = gzuncompress($output);
        echo '<br /><br /> Datos sin encriptar: ' . $output;
?>

<!DOCTYPE html>
<html lang="es-AR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="SecurityTest.php" method="post">
        <input type="text" name="pass">
        <input type="submit">
    </form>
</body>
</html>