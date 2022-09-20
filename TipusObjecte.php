<?php
$d = new DateTime();
$tipus_de_d = gettype( $d );
/* Exercici 5 : echo "el valor de \$d és $d";*/
/*Exercici 6: Aqui indiquem la classe que es la variable $d*/
$classe_de_d = get_class($d);

echo "el valor de \$d 
      conté el valor " . $d->format( "d/m/Y") .
	  " i és del tipus $tipus_de_d
      i és de la classe $classe_de_d";
      /*Exercici 6: Aqui a dalt ho escribim perque ho mostri per pantalla*/
      
?>
