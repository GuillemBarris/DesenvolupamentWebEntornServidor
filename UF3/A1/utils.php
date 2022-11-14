<?php
/**
 * Dades i String Connexió
 */
try {
    $hostname = "localhost";
    $dbname = "dwes-guillembarris-autpdo";
    $usuariname = "dwes-user";
    $pw = "dwes-pass";
    $mysql = new PDO("mysql:host=$hostname;dbname=$dbname", "$usuariname", "$pw");
} catch (PDOException $exepcio) {
    echo "Failed to get DB handle: " . $exepcio->getMessage() . "\n";
    header("Location: index.php?error=database_error", true, 303);
    exit;
}
function llegirUsuari(string $correu): array | bool{
    global $mysql;
    $sentencies = $mysql->prepare("SELECT `email`,`password`,`name` FROM users WHERE email = ?");
      $sentencies->execute(array($correu));
    $linea = $sentencies->fetch();
    return $linea;
}
function escriureUsuari(string $correu, string $contrasenya, string $nom): void{
    global $mysql;
    $sentencies = $mysql->prepare("INSERT INTO users (`email`, `password`, `name`) VALUES(?, MD5(?), ?)");
    $sentencies->execute(array($correu, $contrasenya, $nom));
}
function llegirConnexions(string $ip, string $usuari, string $date, string $status): void{
    global $mysql;
    $sentencies = $mysql->prepare("INSERT INTO connections (`ip`, `user`, `time`, `status`) VALUES(?, ?, ?, ?)");
 
    $sentencies->execute(array($ip, $usuari, $date, $status));
}

function escriureConnexions(string $usuari): array{
    global $mysql;

    $sentencies = $mysql->prepare("SELECT `ip`,`user`,`time`,`status` FROM connections WHERE user = ?");
   
    $sentencies->execute(array($usuari));
    $linea = $sentencies->fetchAll();

    return $linea;
}

function print_conns(string $correu): string{
    $output = "";
    $data = escriureConnexions($correu);
    foreach ($data as $vals) {
        if ($vals["user"] == $correu && str_contains($vals["status"], "success"))
            $output .= "Connexió des de " . $vals["ip"] . " amb data " . $vals["time"] . "<br>\n";
    }
    return $output;
}