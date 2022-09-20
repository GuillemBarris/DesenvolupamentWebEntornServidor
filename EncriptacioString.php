<?php

$sp = 'kfhxivrozziuortghrvxrrkcrozxlwflrh';

$mr = ' hv ovxozwozv vj o vfrfjvivfj h vmzvlo e hrxvhlmov oz ozx.vw z xve hv loqvn il hv lmnlg izxvwrhrvml ,hv b lh mv,rhhv mf w zrxvlrh.m';


echo decrypt($sp);

echo '<br>';

echo decrypt($mr);

function abecedariAlReves($a) {

    $arr4 = str_split($a, 1);

    $arr5 = [];

    foreach($arr4 as $b) {

        if(ctype_alpha($b)){

            $arr6 = ord($b);

            $arr6 = 122 - $arr6 + 97;

            $b = chr($arr6);
        }
        array_push($arr5, $b);
    }
    $arr7 = implode($arr5);

    return $arr7;
};

function decrypt($sp) {

    $arr1 = str_split($sp, 3); 

    $arr2 = [];

    foreach($arr1 as $a) {

        $arr3 = abecedariAlReves($a);

        array_push($arr2 ,strrev($arr3));
        
    }
    $r = implode($arr2);
    return $r;


}

?>