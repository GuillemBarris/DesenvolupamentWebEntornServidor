<?php
    // creo un array amb 3 elements
    //Exercici 2: $a = array( );
    $a = array(5,7,11);
    print_r( $a );
    echo "<br>";

    //afegeixo més elements a l'array
    $a[] = 13;  
    $a[] = 17;
    print_r( $a );
    echo "<br>";
    $a[] = 18;

    //encara un altre
   
    array_push ($a, 25);
    ;
    
    print_r( $a );
    echo "<br>";

    //pinto elements de l'array
    echo "El valor de del tercer element de l'array és " . $a[2];
    echo "<br>";

    unset($a[0]); 
    unset($a[1]); // el valor 7 seguia a la possició 1
    print_r( $a );
    echo "<br>";
    //Exercici 3
    $tipus_de_a = gettype($a);
    echo "La array obtenim el tipus $tipus_de_a";
    echo "<br>";
    //Exercici 4
    array_push($a, 25);
    $a[]=25;
    //Exercici 5
    echo "El valor de el 4 elemen de l'array és " . $a[3];
    //Exercici 6
    unset($a[2]);
    echo "Element eliminat" . $a[2];
?>
