<?php
// TODO: Cal implementar tota la funcionalitat
try {
    $hostname = "localhost";
    $dbname = "wordpress";
    $usuariname = "dwes-user";
    $pw = "dwes-pass";
    $mysql = new PDO("mysql:host=$hostname;dbname=$dbname", "$usuariname", "$pw");
} catch (PDOException $exepcio) {
    echo "Failed to get DB handle: " . $exepcio->getMessage() . "\n";
    header("Location: index.php?error=database_error", true, 303);
    exit;
}
 function facelog_dbget($user){
    
   $dades = get_dades_user();
  $user[$linea];
}
function get_dades_user():array{
    global $mysql;
    $sentencies = $mysql->prepare("SELECT * FROM wp_users WHERE user_login LIKE wordpress");
    
      $sentencies->execute(array($correu));
    $linea = $sentencies->fetch();
    return $linea;
}