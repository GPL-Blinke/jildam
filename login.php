<html lang="es-AR">
<head>
    <meta charset="UTF-3">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jildam</title>
</head>
<body>
    <form id="seexo" action="login.php" method="post">
        Email: <input type="text" name="email"><br>
        Contraseña: <input type="password" name="contrasena"><br>
        <input type="submit" value="Enviar">
        <br>
        <input type="submit" formaction="index.php" value="Atras">
    </form>
</body>
</html>

<?php

error_reporting(0);

function eliminar_acentos($cadena){
		
    //Reemplazamos la A y a
    $cadena = str_replace(
    array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
    array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
    $cadena
    );

    //Reemplazamos la E y e
    $cadena = str_replace(
    array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
    array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
    $cadena );

    //Reemplazamos la I y i
    $cadena = str_replace(
    array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
    array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
    $cadena );

    //Reemplazamos la O y o
    $cadena = str_replace(
    array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
    array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
    $cadena );

    //Reemplazamos la U y u
    $cadena = str_replace(
    array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
    array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
    $cadena );

    //Reemplazamos la N, n, C y c
    $cadena = str_replace(
    array('Ñ', 'ñ', 'Ç', 'ç'),
    array('N', 'n', 'C', 'c'),
    $cadena
    );
    
    return $cadena;
}

if (null !== htmlspecialchars($_POST["contrasena"]) && null !== htmlspecialchars($_POST["email"])){
    $contrasenac = $_POST["contrasena"];
    $emailc = $_POST["email"];
    $contrasena = strip_tags($contrasenac);
    $emaila = strip_tags($emailc);
}

$hotsdb = "localhost";  
$basededatos = "jildam";  

$usuariodb = "root";  
$clavedb = "";   

$tabla_db1 = "login";

$mysqli = new mysqli($hotsdb, $usuariodb, $clavedb, $basededatos, 3306);

$consulta = "SELECT email, usuario FROM $tabla_db1 WHERE email='$emaila' AND contrasena='$contrasena'";
$result = $mysqli->query($consulta);
$row = $result->fetch_array(MYSQLI_ASSOC);

if ($row["email"] !== null && $row["usuario"] !== null) {
    $usernamecrud = $row["usuario"];
    $usuariocaps = strtolower($usernamecrud);
    $usuariospaces = str_replace(" ", "_", $usuariocaps);
    $usuariodbcreate = eliminar_acentos($usuariospaces);

    setcookie("login", "true", time() + (86400 * 30), "/");
    setcookie("username", $usernamecrud, time() + (86400 * 30), "/");
    setcookie("dbusername", $usuariodbcreate, time() + (86400 * 30), "/");

    echo "Has iniciado sesion con exito";
    echo "<br><form><input type='submit' formaction='inicio.php' value='Inicio'></form>";
}

?>