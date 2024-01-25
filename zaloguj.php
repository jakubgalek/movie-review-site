<?php

// Rozpocznij sesję
session_start();

// Sprawdź, czy przesłano formularz z danymi logowania
if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
{
    header('Location: index.php'); // Jeśli nie, przekieruj do strony logowania
    exit();
}

// Podłącz plik z danymi do połączenia z bazą danych
require_once "connect.php";

// Utwórz obiekt mysqli i ustaw kodowanie na utf8
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
$polaczenie->set_charset("utf8");

// Sprawdź, czy udało się połączyć z bazą danych
if ($polaczenie->connect_errno != 0)
{
    echo "Error: ".$polaczenie->connect_errno;
}
else
{
    // Pobierz dane z formularza logowania
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    
    // Zabezpiecz dane przed wstrzykiwaniem SQL i konwersją znaków
    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

    // Sprawdź poprawność danych logowania w bazie danych
    if ($rezultat = @$polaczenie->query(
        sprintf("SELECT * FROM users WHERE BINARY UserName='%s' AND BINARY password='%s'",
        mysqli_real_escape_string($polaczenie,$login),
        mysqli_real_escape_string($polaczenie,$haslo))))
    {
        // Sprawdź, ile użytkowników pasuje do podanych danych
        $ilu_userow = $rezultat->num_rows;
        if($ilu_userow > 0)
        {
            // Ustaw zmienną sesyjną oznaczającą zalogowanie
            $_SESSION['zalogowany'] = true;
            
            // Pobierz dane użytkownika i zapisz je w zmiennych sesyjnych
            $wiersz = $rezultat->fetch_assoc();
            $_SESSION['UserID'] = $wiersz['UserID'];
            $_SESSION['UserName'] = $wiersz['UserName'];
            $_SESSION['email'] = $wiersz['email'];
            $_SESSION['password'] = $wiersz['password'];
            
            // Wyczyść ewentualny wcześniejszy błąd logowania
            unset($_SESSION['blad']);
            $rezultat->free_result();
            header('Location: pulpit.php'); // Przekieruj do strony głównej po zalogowaniu
            
        } else {
            
            // Jeśli nie znaleziono pasujących użytkowników, ustaw błąd logowania
            $_SESSION['blad'] = '<span style="color:red; font-size:13px;">Nieprawidłowa nazwa lub hasło!</span>';
            header('Location: logowanie.php'); // Przekieruj do strony logowania
            
        }
        
    }
    
    // Zamknij połączenie z bazą danych
    $polaczenie->close();
}

?>
