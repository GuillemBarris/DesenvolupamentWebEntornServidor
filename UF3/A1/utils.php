<?php
/**
 * Dades i String Connexió
 */

try {
    $hostname = "localhost";
    $dbname = "dwes-guillembarris-autpdo";
    $usuarname = "dwes-user";
    $pw = "dwes-pass";
    $mysql = new PDO("mysql:host=$hostname;dbname=$dbname", "$usuarname", "$pw");
} catch (PDOException $exepcio) {
    echo "Failed to get DB handle: " . $exepcio->getMessage() . "\n";
    header("Location: index.php?error=database_error", true, 303);
    exit;
}

function llegirUsuari(string $correu): array {
    $sentencies = $mysql->prepare("SELECT `email`,`password`,`name` FROM users WHERE email = ?");
    $sentencies->execute(array($correu));
    return $sentencies->fetch();
}

function escriureUsuari(string $correu, string $contrasenya, string $nom): void{
    $sentencies = $mysql->prepare("INSERT INTO users (`email`, `password`, `name`) VALUES(?, MD5(?), ?)");
    $sentencies->execute(array($correu, $contrasenya, $nom));
}

function llegirConnexions(string $ip, string $usuari, string $date, string $status): void{
    $sentencies = $mysql->prepare("INSERT INTO connections (`ip`, `user`, `time`, `status`) VALUES(?, ?, ?, ?)");
    $sentencies->execute(array($ip, $usuari, $date, $status));
}

function escriureConnexions(string $usuari): array{
    $sentencies = $mysql->prepare("SELECT `ip`,`user`,`time`,`status` FROM connections WHERE user = ? AND status IN ('signup_success','signing_success')");
    $sentencies->execute(array($usuari));
    return $sentencies->fetchAll();
}

function print_conns(string $correu): string{
    $output = "";
    $data = escriureConnexions($correu);
    foreach ($data as $vals) {
        $output .= "Connexió des de " . $vals["ip"] . " amb data " . $vals["time"] . "<br>\n";   
    }
    return $output;
}