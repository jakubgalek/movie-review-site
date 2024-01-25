<?php
session_start();

if (!isset($_SESSION['zalogowany'])) {
    header('Location: index.php');
    exit();
}

function deleteReviewsAndUser($userId, $pdo) {
    try {
        $pdo->beginTransaction();

        // Usuń recenzje użytkownika
        $stmtDeleteReviews = $pdo->prepare('DELETE FROM ratings WHERE UserID = ?');
        $stmtDeleteReviews->execute([$userId]);

        // Sprawdź ile rekordów zostało usuniętych
        $deletedReviewsCount = $stmtDeleteReviews->rowCount();

        if ($deletedReviewsCount > 0) {
            echo "Usunięto $deletedReviewsCount recenzji użytkownika.";
        } else {
            echo "Użytkownik nie miał żadnych recenzji do usunięcia.";
        }

        // Usuń użytkownika
        $stmtDeleteUser = $pdo->prepare('DELETE FROM users WHERE userID = ?');
        $stmtDeleteUser->execute([$userId]);

        // Zatwierdź transakcję
        $pdo->commit();

        echo "Użytkownik został pomyślnie usunięty.";

    } catch (PDOException $e) {
        $pdo->rollBack();
        throw new Exception('Błąd usuwania recenzji i użytkownika: ' . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username'], $_POST['password'])) {
        $providedUsername = $_POST['username'];
        $providedPassword = $_POST['password'];

        try {
            $pdo = new PDO('mysql:host=localhost;dbname=netflix', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmtGetUser = $pdo->prepare('SELECT * FROM users WHERE UserName = ?');
            $stmtGetUser->execute([$providedUsername]);
            $user = $stmtGetUser->fetch(PDO::FETCH_ASSOC);

            if ($user && $providedPassword == $user['password']) {
                $userId = $user['UserID'];

                // Usunięcie recenzji użytkownika i jego konta
                deleteReviewsAndUser($userId, $pdo);

                session_destroy();
                header('Location: index.php');
                exit();
            } else {
                $error = "Podano nieprawidłową nazwę konta lub hasło.";
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    } else {
        $error = "Proszę podać nazwę konta i hasło.";
    }
}

// Pobierz dane użytkownika z sesji
$userId = $_SESSION['UserID'];
$userName = $_SESSION['UserName'];
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Netflix IMDb - Usuń Konto</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="client.css">
</head>

<body>
    <nav class="navigation">
        <span class="logo">Netflix IMDb</span>
        <ul class="menu">
            <li class="menu__item"><?php echo "Witaj " . $_SESSION['UserName'] . ' !'; ?></li>
            <li class="menu__item"><?php echo '<a href="pulpit.php">Pulpit</a>'; ?></li>
            <li class="menu__item"><?php echo '<a href="logout.php">Wyloguj!</a>'; ?></li>
        </ul>
    </nav>

    <div class="delete-account-form">
        <style>
            body {
                justify-content: normal;
            }
            form {
                width: 350px;
                margin: 0 auto;
                text-align: left;
                padding-top: 20vh;
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
            button {
                width: 100%;
            }
        </style>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2>Formularz usuwania konta</h2>
            <?php
            if (isset($error)) {
                echo '<p style="color: red;">' . $error . '</p>';
            }
            ?>
            <div>
                <label for="username">Twoja nazwa konta:</label>
                <input type="text" class="form__text-list" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Hasło:</label>
                <input type="text" class="form__text-list" id="password" name="password" required>
            </div>
            <div>
                <button class="form__button" type="submit" name="submit">Potwierdzam usunięcie mojego konta</button>
            </div>
        </form>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
