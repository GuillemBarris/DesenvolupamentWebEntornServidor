<?php
    session_start();
    $missatgeError = "hidden";
    if (isset($_GET['date'])) { 
        $_SESSION['date'] = $_GET['date'];
    }
    if (!isset($_SESSION['date']) || $_SESSION['date'] != date("Ymd")) { 
        if (!isset($_SESSION['date'])) { 
            $_SESSION['date'] = date("Ymd");
        }
       LLETRES();
        $_SESSION['correctes'] = array();
    }
    if (isset($_GET['error'])) { 
       
        $missatgeError = "show";
    }
    LLETRES();
    var_dump($_SESSION['words']);

   function LLETRES(){
    $Paraula = null;
   
    srand($_SESSION['date']);
    $Paraules = get_defined_functions()['internal'];
 
   while($Paraula == null){
         
    $cons = array('b','c','d','f','g','h','j','k','l',  
    'm','n','p','r','s','t','v','w','x','y','z');
     $voca = array('a','e','i','o','u');
        $num = array('0','1','2','3','4','5','6','7','8','9','_');
        shuffle($cons);
        shuffle($voca);
        shuffle($num);
        $_SESSION['LLETRA'] = $voca[0];
        $_SESSION['consonant'] = array($cons[0],$cons[1],$cons[2]);
        $_SESSION['numero'] = $num[0];
        $_SESSION['vocal'] = array($voca[1],$voca[2]);

        $Paraula = validarParaules(3, $Paraules);
    }
}
        
    
   
        function validarParaules(int $cantitat, array $Paraules){
    
    $l0 = $_SESSION['LLETRA'];
    $l1 = $_SESSION['consonant'][0];
    $l2 = $_SESSION['numero'];
    $l3 = $_SESSION['vocal'][0];
    $l4 = $_SESSION['consonant'][1];
    $l5 = $_SESSION['vocal'][1];
    $l6 = $_SESSION['consonant'][2];

    $regex = "/^[$l0$l1$l2$l3$l4$l5$l6]+$/";
    $_SESSION['words'] = array();
    foreach ($Paraules as $funcio) {
        if (str_contains($funcio, $l0) && preg_match($regex, $funcio)) {
            $_SESSION['words'][] = $funcio;
        }
    }
    if (count($_SESSION['words']) >= $cantitat) {
        return $_SESSION['words'];
    }
    return null;

 
}

?>

<html lang="ca">
<head>
    <title>PHPògic</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Juga al PHPògic.">
    <link href="//fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>


<body date-joc="2022-10-07">
<form method="POST" action="validacio.php">
<div class="main">
    <h1>
        <a href=""><img src="logo.png" height="54" class="logo" alt="PHPlògic"></a>
    </h1>
    <div class="container-notifications">
    <p class="hide" id="message" style='visibility: <?= $missatgeError ?>;'><?= $_GET['error'] ?></p>
    </div>
       <div class="cursor-container">
        <p id="input-word"><span id="test-word" name="paraula" ></span><span id="cursor">|</span></p>
        <input type="text" hidden="true" id="test-word-input" name="paraula">
    </div>
    <form method="POST" action="validacio.php">
    <div class="container-hexgrid">
        <ul id="hex-grid">
            <li class="hex">
                <div class="hex-in">
                    <a class="hex-link"  date-lletra="<?= $_SESSION['consonant'][0] ?>"    draggable="false">
                        <p  ><?= $_SESSION['consonant'][0]  ?></p>
                    </a>                   
                 </div>
                 <li class="hex">
                    <div class="hex-in">
                        <a class="hex-link" date-lletra="<?=$_SESSION['vocal'][0]?>" draggable="false">
                            <p><?= $_SESSION['vocal'][0] ?></p>
                        </a>
                </div>
                <li class="hex">
                    <div class="hex-in">
                        <a class="hex-link" date-lletra="<?= $_SESSION['numero'][0] ?>" draggable="false">
                            <p><?= $_SESSION['numero'][0] ?></p>
                        </a>
                </div>
            </li>
            <li class="hex">
                <div class="hex-in">
                    <a class="hex-link" date-lletra="<?= $_SESSION['LLETRA'][0] ?>" draggable="false" id="center-letter">
                        <p><?= $_SESSION['LLETRA'][0] ?></p>
                    </a>
                </div>
            </li>
            <li class="hex">
                    <div class="hex-in">
                        <a class="hex-link" date-lletra="<?= $_SESSION['consonant'][1]?>" draggable="false">
                            <p><?= $_SESSION['consonant'][1] ?></p>
                        </a>
                </div>
                <li class="hex">
                    <div class="hex-in">
                        <a class="hex-link" date-lletra="<?= $_SESSION['vocal'][1] ?>" draggable="false">
                            <p><?= $_SESSION['vocal'][0] ?></p>
                        </a>
                </div>
                <li class="hex">
                    <div class="hex-in">
                        <a class="hex-link" date-lletra="<?= $_SESSION['consonant'][2] ?>" draggable="false">
                            <p><?= $_SESSION['consonant'][2] ?></p>
                        </a>
                </div>
        </ul>
    </div>
   
    <div class="button-container">
        <button id="delete-button" type="button" title="Suprimeix l'última lletra" onclick="suprimeix()"> Suprimeix</button>
        <button id="shuffle-button" type="button" class="icon" aria-label="Barreja les lletres" title="Barreja les lletres">
            <svg width="16" aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 512 512">
                <path fill="currentColor"
                      d="M370.72 133.28C339.458 104.008 298.888 87.962 255.848 88c-77.458.068-144.328 53.178-162.791 126.85-1.344 5.363-6.122 9.15-11.651 9.15H24.103c-7.498 0-13.194-6.807-11.807-14.176C33.933 94.924 134.813 8 256 8c66.448 0 126.791 26.136 171.315 68.685L463.03 40.97C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971l41.75-41.749zM32 296h134.059c21.382 0 32.09 25.851 16.971 40.971l-41.75 41.75c31.262 29.273 71.835 45.319 114.876 45.28 77.418-.07 144.315-53.144 162.787-126.849 1.344-5.363 6.122-9.15 11.651-9.15h57.304c7.498 0 13.194 6.807 11.807 14.176C478.067 417.076 377.187 504 256 504c-66.448 0-126.791-26.136-171.315-68.685L48.97 471.03C33.851 486.149 8 475.441 8 454.059V320c0-13.255 10.745-24 24-24z"></path>
            </svg>
        </button>
       
       
        <button id="submit-button" type="submit" title="Introdueix la paraula" >Introdueix</button>
   
    </div>


    <div class="scoreboard">
    <div>
                Has trobat <span id="letters-found"><?= count($_SESSION['correctes']) ?>
                </span> <span id="found-suffix">funcions</span><span id="discovered-text">: <?= implode (", ", $_SESSION['correctes']) ?></span>
        </div>
        <div id="score"></div>
        <div id="level"></div>
    </div>
   
</div>
</form>


<script>
    
    function amagaError(){
        if(document.getElementById("message"))
            document.getElementById("message").style.opacity = "0"
    }
    function afegeixLletra(lletra){
        document.getElementById("test-word").innerHTML += lletra
    }
    function suprimeix(){
        document.getElementById("test-word").innerHTML = document.getElementById("test-word").innerHTML.slice(0, -1)
    }
    window.onload = () => {
    
        Array.from(document.getElementsByClassName("hex-link")).forEach((el) => {
            el.onclick = ()=>{afegeixLletra(el.getAttribute("date-lletra"))}
        })
        setTimeout(amagaError, 2000)
    
        let estat_cursor = true;
        setInterval(()=>{
            document.getElementById("cursor").style.opacity = estat_cursor ? "1": "0"
            estat_cursor = !estat_cursor
        }, 500)
    }
</script>
</body>
</html>