<!DOCTYPE html>
<html lang="ca">
<head>
    <title>PHPògic</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Juga al PHPògic.">
    <link href="//fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
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

        $_SESSION['correctes'] = array();
    }
    if (isset($_GET['error'])) { 
        $missatgeError = "shown";
    }
  

    $length = 3;
    $cons = array('b','c','d','f','g','h','j','k','l',  
                  'm','n','p','r','s','t','v','w','x','y','z');
    $voca = array('a','e','i','o','u');
    $num = array('0','1','2','3','4','5','6','7','8','9','_');
    srand($_SESSION['date']);
    
    $max = $length/2;
     $password = '';
     $LLETRA = '';
    
    for($i=1;$i<=$max;$i++){
        $password .= $cons[rand(0,count($cons)-1)];
        $password .= $num[rand(0,count($num)-1)];
        $LLETRA .= $voca[rand(0,count($voca)-1)];
        $password .= $cons[rand(0,count($cons)-1)];
        $password .= $voca[rand(0,count($voca)-1)];
        $password .= $cons[rand(0,count($cons)-1)];
        
    }
    if(($length % 2) == 1) $password .= $cons[rand(0,count($cons)-1)];
?>


<body date-joc="2022-10-07">
<form method="POST" action="validacio.php">
<div class="main">
    <h1>
        <a href=""><img src="logo.png" height="54" class="logo" alt="PHPlògic"></a>
    </h1>
    <!--<div class="container-notifications">
        <p class="hide" id="message" style="">MISSATGE D'ERROR</p>
    </div>-->
    
    
    <div class="cursor-container">
        <p id="input-word"><span id="test-word" name="Paraula" ></span><span id="cursor">|</span></p>
    </div>
    <div class="container-hexgrid">
        <ul id="hex-grid">
            <li class="hex">
                <div class="hex-in">
                    <a class="hex-link"  date-lletra="<?= $password[0];?>"    draggable="false">
                        <p  ><?= $password[0] ?></p>
                    </a>                   
                 </div>
                 <li class="hex">
                    <div class="hex-in">
                        <a class="hex-link" date-lletra="<?= $password[1]; ?>" draggable="false">
                            <p><?= $password[1] ?></p>
                        </a>
                </div>
                <li class="hex">
                    <div class="hex-in">
                        <a class="hex-link" date-lletra="<?= $password[2]; ?>" draggable="false">
                            <p><?= $password[2] ?></p>
                        </a>
                </div>
            </li>
            <li class="hex">
                <div class="hex-in">
                    <a class="hex-link" date-lletra="<?= $LLETRA ?>" draggable="false" id="center-letter">
                        <p><?= $LLETRA ?></p>
                    </a>
                </div>
            </li>
            <li class="hex">
                    <div class="hex-in">
                        <a class="hex-link" date-lletra="<?= $password[3]; ?>" draggable="false">
                            <p><?= $password[3] ?></p>
                        </a>
                </div>
                <li class="hex">
                    <div class="hex-in">
                        <a class="hex-link" date-lletra="<?= $password[4]; ?>" draggable="false">
                            <p><?= $password[4] ?></p>
                        </a>
                </div>
                <li class="hex">
                    <div class="hex-in">
                        <a class="hex-link" date-lletra="<?= $password[5]; ?>" draggable="false">
                            <p><?= $password[5] ?></p>
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
</form>

    <div class="scoreboard">
        <div>Has trobat <span id="letters-found"></span> <span id="found-suffix">funcions</span><span id="discovered-text">.</span>

        </div>
        <div id="score"></div>
        <div id="level"></div>
    </div>

</div>

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