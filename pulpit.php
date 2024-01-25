<?php
// Włączenie pliku z danymi do połączenia z bazą danych
include('connect.php');

// Rozpoczęcie sesji
session_start();

// Połączenie z bazą danych
$conn = new mysqli($host, $db_user, $db_password, $db_name);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obsługa formularza - dodawanie recenzji
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieID = $_POST["movie_title"];
    $userID = $_SESSION['UserID'];
    $score = $_POST["rating"];
    $comment = $_POST["text"];

    // Przygotowanie i wykonanie zapytania SQL
    $sql = "INSERT INTO ratings (MovieID, UserID, Score, Comment) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Sprawdzenie błędów przy przygotowywaniu zapytania
    if (!$stmt) {
        echo "Błąd przy przygotowywaniu zapytania: " . $conn->error;
        exit();
    }

    // Wiązanie parametrów zapytania
    $stmt->bind_param("iiis", $movieID, $userID, $score, $comment);

    // Wykonanie zapytania
    if ($stmt->execute()) {
        $_SESSION['recenzjaDodana'] = true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Zamknięcie przygotowanego zapytania
    $stmt->close();
}

// Zamknięcie połączenia z bazą danych
$conn->close();
?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Netflix IMDb</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="client.css">
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- Nawigacja -->
    <nav class="navigation">
        <span class="logo">Netflix IMDb</span>
        <ul class="menu">
		    <!-- Powitanie użytkownika -->
		    <li class="menu__item"><?php echo "Witaj " . $_SESSION['UserName'] . ' !'; ?></li>
		    <!-- Link do ustawień konta -->
		    <li class="menu__item"><?php echo '<a href="settings.php">Ustawienia konta</a>'; ?></li>
            <!-- Link do wylogowania -->
            <li class="menu__item"><?php echo '<a href="logout.php">Wyloguj!</a>'; ?></li>
        </ul>
    </nav>

    <div class="container">
        <!-- Formularz dodawania recenzji -->
        <div class="form-box">
            <h1 class="form-box__title">Dodaj recenzję</h1>
            <form class="form-box__form form" method="post" enctype="multipart/form-data">
                <!-- Wybór filmu -->
                <label>Film:</label>
                <select class="form__text-list" name="movie_title" required>
                    <?php
					// Wyświetlenie dostępnych filmów
					$conn = new mysqli($host, $db_user, $db_password, $db_name);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT MovieID, Title FROM movies";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["MovieID"] . "'>" . $row["Title"] . "</option>";
                        }
                    }

                    // Zamknięcie połączenia
                    $conn->close();
                    ?>
                </select>

                <!-- Wybór oceny -->
                <label>Ocena:</label>
                <select class="form__text-list" name="rating" required>
                    <?php
                    // Wyświetlenie opcji ocen od 1 do 10
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>

                <!-- Pole na treść recenzji -->
                <textarea class="form__text-input" name="text" id="password" placeholder="Napisz coś..."
                    rows="12"></textarea>

                <!-- Przycisk do dodawania recenzji -->
                <button class="form__button" type="submit" name="submit">Dodaj</button>
            </form>
        </div>

        <!-- Komunikat o dodaniu recenzji -->
        <?php
        if (isset($_SESSION['recenzjaDodana']) && $_SESSION['recenzjaDodana'] == true) {
            echo '<div class="recenzja-dodana-komunikat">Recenzja została pomyślnie dodana!</div>';
            $_SESSION['recenzjaDodana'] = false;
        }
        ?>
    </div>
	
	<!-- Dodatkowe style CSS -->
	<style>
	body {
		justify-content: normal;
	}
    form {
        width: 350px;
        margin: 0 auto;
        text-align: left;
    }

    label {
        display: block;
        margin-bottom: 8px;
    }

    input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box; 
        margin-bottom: 16px; 
    }
    </style>

    <?php include('footer.php'); ?>
</body>

</html>
