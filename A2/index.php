<!DOCTYPE html>
<html lang="ca">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Calculadora</title>
</head>
<body>
    <?php
    $numero = isset($_POST['numero']);
    $Mostrar = isset($_POST['Mostrar']);
    $operacio = isset($_POST["operacio"]);
    $Posicio = isset($_POST['Posicio']);
    $PosicioNumero = isset($_POST['PosicioNum']);
    $igual = isset($_POST['Igual']);
    $equalPressed = "0";
    if ($numero && $igual && $_POST['Igual'] == "1" || $Mostrar && $_POST['Mostrar'] == "ERROR") {
    $_POST['Mostrar'] = "";
    }
//Aques if mostrara el que ha de sortir en la pantalla i si no ha de sortir res perque esta equivocat donara ERROR
if ($Mostrar) {
    $resultat = $_POST["Mostrar"];
    $Moure = strpos($resultat, '|') != mb_strlen($resultat) - 1;
    if ($numero) {
        $resultat = Numero($resultat, $Moure);
    }
    if ($operacio) {
        $operacio = $_POST['operacio'];
        if ($operacio == "C") {
            $resultat = "";
            $PosicioNum = 0;
        } else  if ($operacio == "=") {
            $equalPressed = "1";
            $resultat = TencarParentesis($resultat);
            try {
                $number = '(\d+(.\d+)?)'; // Aqui fem que el nombre pugi tenir comes és a dir podra se 3 o 3.5
                $funcions = '(?:sinh?|cosh?|tanh?|abs|acosh?|asinh?|atanh?|exp|log10|deg2rad|rad2deg|sqrt|ceil|floor|round)'; 
                $operadors = '[+\/*\^-]'; // Operacions que es poden fer
                $ExpresionsRegulars = '/((' . $number . '|' . $funcions . '\s*\((?1)+\)|\((?1)+\))(?:' . $operadors . '(?2))*)+/'; 
                if (preg_match($ExpresionsRegulars, $resultat)) {
                    $resultat = preg_replace('!\|!', '', $resultat); // Substitueix el cursor per una cadena buida
                    $mathOperation = $resultat;
                    eval('$resultat = ' . $resultat . ';');
                } else {
                    $resultat = "ERROR";
                }
            } catch (DivisionByZeroError $e) {
                $resultat = "INF";
            } catch (Throwable $t) {
                $resultat = "ERROR";
            }
        } else if ($operacio == "SIN" || $operacio == "COS") {
            $resultat = SinCos($resultat, $operacio, $Moure);
        } else if ($operacio == "(" && $operacio == ")") {
            $resultat = Parenetsis($operacio, $Moure, $resultat);
        } else if ($operacio == "-") {
            $resultat =  DosNegatius($operacio, $Moure, $resultat);
        } else if ($operacio == "x²") {
            $resultat = TencarParentesis($resultat);
            $resultat = "($resultat)**2";
        } else {
            $resultat .= $operacio;
        }
    }
// Aquest if  ens indica la posicio a on esta el numero, aixo no es mostra pero serveix perque els numeros no quedin devant dels altres
    if ($PosicioNumero) {

        $PosicioNum = $_POST['PosicioNum'];
        $resultat = preg_replace('!\|!', '', $resultat); // Substitueix el cursor per buit perquè els cursors no s'apilin
        if (!($Posicio)) {
            $PosicioNum = mb_strlen($resultat);
        } else {
            $Posicio = $_POST['Posicio'];         
        }
        $Array = str_split($resultat);
        array_splice($Array, $PosicioNum, 0, "|");
        $resultat = implode($Array);
    }
} else {
    $PosicioNum = 0;
    $resultat = "";
}
if (is_float($resultat)) {
    $resultat = number_format((float)$resultat, 4, '.', '');
}
/**
 * Comprova si la cadena s'ha d'encapsular
 * comprovant el seu darrer caràcter, que ha de ser
 * numèric per retornar cert
 */
function Encapsular(String $resultat): bool
{
    $resultat = preg_replace('!\|!', '', $resultat);
    $UltimCharacter = substr($resultat, -1);
    return is_numeric($UltimCharacter) || $UltimCharacter != "*";
}
 function TencarParentesis($resultat): String{   
       $ObrirParentesis = substr_count($resultat, "(");
                
        $TencarParentesis = substr_count($resultat, ")");
                
        $Diferent = $ObrirParentesis - $TencarParentesis;
            
       if ($Diferent < 0) {
        return $resultat;
           }
         return $resultat . str_repeat(")", $Diferent);
}
/**
 *Comprova si l'últim caràcter de la cadena
 * supera la prova ExpressionsRegulars. 
 */

function AcabaAmb(String $resultat, String $ExpresionsRegulars){
    $resultat = preg_replace('!\|!', '', $resultat); // Substitueix el cursor per buit per evitar comportaments estranys
    if (mb_strlen($resultat) == 0) {
        return false;
    }
    return preg_match($ExpresionsRegulars, mb_substr($resultat, -1));
}
// crea el que es mostrara quan cliquem SIN o quant cliquem COS
function SinCos($resultat, $operacio, $Moure)
{
    if ($Moure) {
        $operacio == "SIN" ? $resultat = PosarElCursor($resultat, "sin(") : $resultat = PosarElCursor($resultat, "cos(");
    } else {
        if (Encapsular($resultat)) {
            $operacio == "SIN" ? $resultat = "sin(" . $resultat . ")" : $resultat =  "cos(" . $resultat . ")";
        } else {
            $operacio == "SIN" ? $resultat .= "sin(" : $resultat .= "cos(";
        }
    }
    return $resultat;
}
// Possa el curso a la ultima possisio.
function PosarElCursor($String, $numero)
{
    $Array = str_split($String);
    array_splice($Array, strpos($String, '|'), 0, $numero);
    $String = implode($Array);
    return $String;
}
function Parenetsis($operacio, $Moure, $resultat)
{
    if ($Moure) {

        $resultat = PosarElCursor($resultat, $operacio);
    } else {
        if (AcabaAmb($resultat, '/^[0-9]$/')) {
            $resultat .= "*";
        }
        $resultat .= "(";
    }
}
// Aqui ens deixera mostra el numero
function Numero($resultat, $Moure)
{
    $numero = $_POST['numero'];

    if ($Moure) {

        $resultat = PosarElCursor($resultat, $numero);
    } else {
        if (AcabaAmb($resultat, "/\)$/")) {
            $resultat .= "*";
        }
        $resultat .= $numero;
    }
    return $resultat;
}
// Aqui possem que passa quant hi ha dos digits negatius
function DosNegatius($operacio, $Moure, $resultat)
{
    if ($Moure) {

        $resultat = PosarElCursor($resultat, $operacio);
    } else {
        if (AcabaAmb($resultat, '/^\-$/')) {
            $resultat .= "(";
        }
        $resultat .= "-";
    }
    return $resultat;
}
?>
    <div class="container">
        <form operacio="" name="calc" class="calculator" method="POST">
            <input type="hidden" name="Igual" value="<?= $equalPressed ?>">
            <input type="hidden" name="PosicioNum" value="<?= $PosicioNum ?>">
            <input type="text" class="value" readonly name="Mostrar" value="<?= $resultat ?>" />     
            <span class="num"><input type="submit" name="operacio" value="("></span>
            <span class="num"><input type="submit" name="operacio" value=")"></span>
             <span class="num"><input type="submit" name="operacio" value="SIN"></span>
            <span class="num"><input type="submit" name="operacio" value="COS"></span>
            <span class="num"><input type="submit" name="operacio" value="x²"></span>
            <span class="num clear"><input type="submit" name="operacio" value="C"></span>
            <span class="num"><input type="submit" name="operacio" value="/"></span>
            <span class="num"><input type="submit" name="operacio" value="*"></span>
            <span class="num"><input type="submit" name="numero" value="7"></span>
            <span class="num"><input type="submit" name="numero" value="8"></span>
            <span class="num"><input type="submit" name="numero" value="9"></span>
            <span class="num"><input type="submit" name="operacio" value="-"></span>
            <span class="num"><input type="submit" name="numero" value="4"></span>
            <span class="num"><input type="submit" name="numero" value="5"></span>
            <span class="num"><input type="submit" name="numero" value="6"></span>
            <span class="num plus"><input type="submit" name="operacio" value="+"></span>
            <span class="num"><input type="submit" name="numero" value="1"></span>
            <span class="num"><input type="submit" name="numero" value="2"></span>
            <span class="num"><input type="submit" name="numero" value="3"></span>
            <span class="num"><input type="submit" name="numero" value="0"></span>
            <span class="num"><input type="submit" name="numero" value="00"></span>
            <span class="num"><input type="submit" name="operacio" value="."></span>
            <span class="num equal"><input type="submit" name="operacio" value="="></span>
        </form>
    </div>
</body>
