<?php

/**
 * Llegeix les dades del fitxer. Si el document no existeix torna un array buit.
 *
 * @param string $file
 * @return array
 * 
 */

function llegeix(string $file) : array{
    $file = file_get_contents("user.json");
    $dades = array($_SESSION['singup']  );
    $var = [];
    if ( file_exists($file) ) {
        $var = json_decode(file_get_contents($file), true);
    }
      return  escriure($dades, $file);
    
}




/**
* Guarda les dades a un fitxer
*
* @param array $dades
* @param string $file
*/
function escriu(array $dades, string $file): void{
   file_put_contents($file,json_encode($dades, JSON_PRETTY_PRINT));
}
?>

