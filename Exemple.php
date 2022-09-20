<?php
//Aqui es mostra la paraula que es vol encriptar
$string= "casa";
echo $string;
//Aqui es posen les seguents comandes per encriptarla
$cifrat = "AES-128-CTR";
$l = openssl_cipher_iv_length($cifrat);
$iv = '1234567891011121';
$clau = "W3docs";
$encriptat = openssl_encrypt($string, $cifrat, $clau, $iv);
//aqui surt encriptada
echo $encriptat;
//Aqui es fa el proces de desencriptacio
$div = '1234567891011121';
$dclau = "W3docs";
$desencriptat = openssl_decrypt($encriptat, $cifrat, $dclau, $div);
// aqui es mostra desencriptada
echo $desencriptat;

?>