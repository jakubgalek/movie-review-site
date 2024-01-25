<?php

// Rozpoczęcie sesji
session_start();

// Usunięcie wszystkich zmiennych związanych z bieżącą sesją
session_unset();

// Przekierowanie użytkownika na stronę główną (index.php)
header('Location: index.php');

?>
