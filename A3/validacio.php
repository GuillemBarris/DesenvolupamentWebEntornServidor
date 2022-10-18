<?php
session_start();

if (in_array($_POST['word'], $_SESSION['words'])) {
    $_SESSION['true'][] = $_POST['word'];
    unset($_SESSION['words'][array_search($_POST['word'], $_SESSION['words'])]);
    header('Location: index.php', true, 302);
} else if (in_array($_POST['word'], $_SESSION['true'])) {
    header('Location: index.php?error=Repetida', true, 303);
} else {
    header('Location: index.php?error=Incorrecte', true, 303);
}
?>
