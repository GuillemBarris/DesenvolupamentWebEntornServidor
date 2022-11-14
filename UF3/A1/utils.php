<?php
/**
 * Dades i String Connexió
 */
try {
    $hostname = "localhost";
    $dbname = "dwes-guillembarris-autpdo";
    $username = "dwes-user";
    $pw = "dwes-pass";
    $conn = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
} catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    header("Location: index.php?error=database_error", true, 303);
    exit;
}

function obtenirUsuari(string $email, string $password, string $name): void
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users (`email`, `password`, `name`) VALUES(?, MD5(?), ?)");
    $stmt->execute(array($email, $password, $name));
}
function llegirUsuari(string $email): array | bool
{
    global $conn;
    $stmt = $conn->prepare("SELECT `email`,`password`,`name` FROM users WHERE email = ?");
      $stmt->execute(array($email));
    $row = $stmt->fetch();
    return $row;
}
function llegirConnexions(string $ip, string $user, string $time, string $status): void
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO connections (`ip`, `user`, `time`, `status`) VALUES(?, ?, ?, ?)");
 
    $stmt->execute(array($ip, $user, $time, $status));
}

function ObtenirConnexions(string $user): array
{
    global $conn;

    $stmt = $conn->prepare("SELECT `ip`,`user`,`time`,`status` FROM connections WHERE user = ?");
   
    $stmt->execute(array($user));
    $row = $stmt->fetchAll();

    return $row;
}
function print_conns(string $email): string
{
    $output = "";
    $data = ObtenirConnexions($email);
    foreach ($data as $vals) {
        if ($vals["user"] == $email && str_contains($vals["status"], "success"))
            $output .= "Connexió des de " . $vals["ip"] . " amb data " . $vals["time"] . "<br>\n";
    }
    return $output;
}