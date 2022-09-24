<?php
function crearMatriu($n){
    $Matriu=[[]];
    for($a=0;$a<$n;$a++){
        for($b=0;$b<$n;$b++){
            if($a==$b) {
                $Matriu[$a][$b]="*";
            } else if($a<$b) {
                $Matriu[$a][$b]=$a+$b;
            } else {
                $Matriu[$a][$b]=rand(10,20);
            }
        }
    }
    return $Matriu;
}
// Aqui com pots veure la funcio mostra matriu rebra una matriu i la representara amb el format de taula HTML
function mostraMatriu($Matriu){
    echo("<table>");
    for($a=0;$a<count($Matriu);$a++){
        echo"<tr>";
        for($b=0;$b<count($Matriu[0]);$b++){
           echo"<td>".$Matriu[$a][$b]."</td>"; 
        }
        echo"</tr>";
    }
    echo("</table>");
}
// Aqui com pots veure rep una matriu i la trona trasposada
function transposaMatriu($Matriu):array{
    $MatriuTrasposada= [[]];
    for($a=0;$a<count($Matriu[0]);$a++){
        for($b=0;$b<count($Matriu);$b++){
            $MatriuTrasposada[$a][$b]=$Matriu[$b][$a];
        }
    }
    return $MatriuTrasposada;
}
// Aqui hi han totes les variables
$n = 4;
$Matriu = [[]];
$Trasposada = [[]];
// aquesta variable es iugal a la execucio de la funcio crearmatriu.
$Matriu = crearMatriu($n);
// i aqui hi han la resta de funcions perque el programa funcioni.
mostraMatriu($Matriu);
mostraMatriu(transposaMatriu($Matriu));
?>