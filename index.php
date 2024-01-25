<?php

// Rozpoczęcie sesji
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany; jeśli tak, przekieruj do pulpit.php
if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {
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

    <!-- Sekcja formularza -->
    <div class="form-box">
        <div class="table-container">

            <?php
            // Dane do połączenia z bazą danych
            $host = "localhost";
            $uzytkownik = "root";
            $haslo = "";
            $baza_danych = "netflix";

            // Nawiązywanie połączenia z bazą danych
            $polaczenie = new mysqli($host, $uzytkownik, $haslo, $baza_danych);
            $polaczenie->set_charset("utf8");

            // Sprawdzanie, czy połączenie się udało
            if ($polaczenie->connect_error) {
                die("Błąd połączenia z bazą danych: " . $polaczenie->connect_error);
            }

            // Zapytanie SQL w celu pobrania danych z tabeli "movies"
            $zapytanie_dane = "SELECT movies.*, AVG(ratings.Score) AS AverageRating 
                   FROM movies 
                   LEFT JOIN ratings ON movies.MovieID = ratings.MovieID 
                   GROUP BY movies.MovieID";
            $wynik_dane = $polaczenie->query($zapytanie_dane);

            // Sprawdzenie, czy zapytanie zwróciło wyniki
            if ($wynik_dane->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>ID</th><th>Tytuł</th><th>Reżyser</th><th>Gatunek</th><th>Rok wydania</th><th>Czas trwania</th><th>Ocena<th>Plakat</th><th>Recenzje</th></tr>";

                // Wyświetlanie danych
                while ($row = $wynik_dane->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['MovieID'] . "</td>";
                    echo "<td>" . $row['Title'] . "</td>";
                    echo "<td>" . $row['Director'] . "</td>";
                    echo "<td>" . $row['Genre'] . "</td>";
                    echo "<td>" . $row['ReleaseYear'] . "</td>";
                    echo "<td>" . $row['Duration'] . " min" . "</td>";
                    echo "<td>" . number_format($row['AverageRating'], 2) . " ☆" . "</td>";
                    echo "<td><img src='" . $row['poster'] . "' alt='Movie Poster' width='150' height='200'></td>";

                    // Zapytanie SQL w celu pobrania danych z tabeli "ratings" dla danego filmu
                    $movieID = $row['MovieID'];
                    $zapytanie_oceny = "SELECT ratings.*, users.UserName FROM ratings 
                                   JOIN users ON ratings.UserID = users.UserID
                                   WHERE ratings.MovieID = $movieID";
                    $wynik_oceny = $polaczenie->query($zapytanie_oceny);

                    // Sprawdzenie, czy zapytanie zwróciło wyniki
                    if ($wynik_oceny->num_rows > 0) {
                        echo "<td>";
                        while ($ratingData = $wynik_oceny->fetch_assoc()) {
                            echo "Użytkownik: " . $ratingData['UserName'] . " | Ocena: " . $ratingData['Score'];

                            // Sprawdź, czy istnieje komentarz
                            if (!empty($ratingData['Comment'])) {
                                echo "<br>Komentarz: " . $ratingData['Comment'];
                            }

                            echo "<br>";
                        }
                        echo "</td>";
                    } else {
                        echo "<td>Brak oceny</td>";
                    }

                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Brak danych w tabeli 'movies'.";
            }

            // Zamykanie połączenia z bazą danych
            $polaczenie->close();
            ?>

            <p class="form-box__info"> </p>
        </div>
    </div>

    <?php include('footer.php'); ?>

</body>

</html>
