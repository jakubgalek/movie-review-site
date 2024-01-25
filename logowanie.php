<?php

// Rozpoczęcie sesji
session_start();

// Sprawdzenie, czy użytkownik jest już zalogowany
if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
    // Jeśli tak, przekieruj go na stronę pulpit.php
    header('Location: pulpit.php');
    exit();
}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Netflix IMDb</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php include('header.php'); ?>

<!-- Sekcja formularza logowania -->
<div class="form-box">
    <h1 class="form-box__title">Witamy na netflixowym IMDb!</h1>
    <p class="form-box__info">Chcesz coś obejrzeć na Netflixie, ale nie wiesz co wybrać? A może zależy ci na wyrażeniu opinii o filmie?
    Ten serwis został stworzony z myślą o Tobie!</p>
    
    <!-- Formularz logowania -->
    <form class="form-box__form form" action="zaloguj.php" method="post">
        <input class="form__text-input" type="text" name="login" id="e-mail" placeholder="nazwa użytkownika">
        <input class="form__text-input" type="password" name="haslo" id="password" placeholder="hasło">

        <?php
        // Wyświetlenie błędu logowania (jeśli istnieje)
        if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
        unset($_SESSION['blad']);
        ?>

        <button class="form__button" type="submit">Zaloguj</button>

        <!-- Przycisk do utworzenia nowego konta -->
        <p class="form-box__info"><a href="register.php">Utwórz nowe konto</a></p>
    </form>
</div>

<?php include('footer.php'); ?>

</body>
</html>
