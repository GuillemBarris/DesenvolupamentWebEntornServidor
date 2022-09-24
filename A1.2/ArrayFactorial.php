<?php
function factorial($numero){
    for ($i=$numero-1;$i>1;$i-- ){
        $numero=$numero*$i;        
      }
      return $numero;
}
function factorialArray($arrayNombre) {
  $factorials=array();
  if ( is_array($arrayNombre)){
    foreach ($arrayNombreas$numero) {
      if(is_int($numero)&&$numero>=0) {
         $factorials[]=factorial($numero);
      }
      else {
        return false;
      }
      
    }
  }
  else {        
    return false;
  }
  return $factorials;
}
$nombres = array(1, 2, 3 ,4);    
$factorial = factorialArray($nombres);
var_dump ($factorial);
?>
