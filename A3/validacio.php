
<?php
session_start();

if (in_array($_POST['words'], $_SESSION['words'])) {
    $_SESSION['correctes'][] = $_POST['word'];
    unset($_SESSION['words'][array_search($_POST['word'], $_SESSION['words'])]);
    header('Location: index.php', true, 302);
    //code if true
} else if (in_array($_POST['words'], $_SESSION['correctes'])) {
    header('Location: index.php?error=Repetida', true, 303);
} else {
    header('Location: index.php?error=Incorrecte', true, 303);
}
?>