<?php

	session_start();
	
	if (isset($_POST['email']))
	{
		$wszystko_OK=true;
		
		//Sprawdź poprawność username'a
		$username = $_POST['username'];
		
		//Sprawdzenie długości username'a
		if ((strlen($username)<3) || (strlen($username)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_username']="Nazwa użytkownika musi mieć od 3 do 20 znaków!";
		}
		
		if (ctype_alnum($username)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_username']="Nazwa użytkownika musi składać się wyłącznie z liter i cyfr (bez polskich znaków)";
		}
		
		// Sprawdź poprawność adresu email
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Wprowadź poprawny adres e-mail!";
		}
		
		//Sprawdź poprawność hasła
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi mieć od 8 do 20 znaków!";
		}
		
		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasła się nie zgadzają!";
		}	
		
		//Czy zaakceptowano regulamin?
		if (!isset($_POST['regulamin']))
		{
			$wszystko_OK=false;
			$_SESSION['e_regulamin']="Potwierdź akceptację regulaminu!";
		}				
		
		$sekret = "6LeUTIcUAAAAADlKvNuia50oKyzFIwLSo4J9xxPv";
		
		$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
		
		$odpowiedz = json_decode($sprawdz);
		
		if ($odpowiedz->success==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_bot']="Potwierdź że nie jesteś robotem!";
		}		
		
		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_username'] = $username;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_haslo1'] = $haslo1;
		$_SESSION['fr_haslo2'] = $haslo2;
		if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			$polaczenie->set_charset("utf8");

			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//Czy email już istnieje?
				$rezultat = $polaczenie->query("SELECT UserID FROM users WHERE email='$email'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_email']="Istnieje już konto z takim adresem e-mail!";
				}		

				//Czy username jest już zarezerwowany?
				$rezultat = $polaczenie->query("SELECT UserID FROM users WHERE UserName='$username'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_usernameow = $rezultat->num_rows;
				if($ile_takich_usernameow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_username']="Ta nazwa użytkownika jest już zajęta! Użyj innej.";
				}
				
				if ($wszystko_OK==true)
				{
					
				// Pobierz największe ID użytkownika z tabeli users
				$result = $polaczenie->query("SELECT MAX(UserID) AS max_id FROM users");
				$row = $result->fetch_assoc();
				$max_id = $row['max_id'];

				// Jeżeli nie ma żadnych rekordów w tabeli, ustaw ID na 1, w przeciwnym razie dodaj 1 do największego ID
				$new_id = ($max_id === null) ? 1 : $max_id + 1;

					if ($polaczenie->query("INSERT INTO users VALUES ('$new_id',  '$username',  '$email', NULL, NULL,NULL, '$haslo1' )"))
					{
						$_SESSION['udanarejestracja']=true;
						$_SESSION['zalogowany']=true;
						
						$login = htmlentities($_SESSION['fr_username'], ENT_QUOTES, "UTF-8");
						$haslo = htmlentities($_SESSION['fr_haslo1'], ENT_QUOTES, "UTF-8");
					
						if ($rezultat = @$polaczenie->query(
						sprintf("SELECT * FROM users WHERE BINARY UserName='%s' AND BINARY password='%s'",
						mysqli_real_escape_string($polaczenie,$login),
						mysqli_real_escape_string($polaczenie,$haslo))))
						{
							$ilu_userow = $rezultat->num_rows;
							if($ilu_userow>0)
							{
								$_SESSION['zalogowany'] = true;
								
								$wiersz = $rezultat->fetch_assoc();
								$_SESSION['UserID'] = $wiersz['UserID'];
								$_SESSION['UserName'] = $wiersz['UserName'];
								$_SESSION['email'] = $wiersz['email'];
								
								unset($_SESSION['blad']);
								$rezultat->free_result();
								header('Location: pulpit.php');
								
							} else {
								
								$_SESSION['blad'] = '<span style="color:red; font-size:13px;">Nieprawidłowa nazwa lub hasło!</span>';
								header('Location: index.php');
								
							}
							
						}
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
				}
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
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
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>

<?php include('header.php'); ?>

<div class="form-box">
  <h1 class="form-box__title">Rejestracja</h1>
    <p class="form-box__info">Aby dzielić się swoimi opiniami na temat filmów, musisz utworzyć konto!</p>

<form method="post" class="form-box__form form">
	
	<input type="text" value="<?php
		if (isset($_SESSION['fr_username']))
		{
			echo $_SESSION['fr_username'];
			unset($_SESSION['fr_username']);
		}
	?>" name="username" placeholder="nazwa użytkownika" class="form__text-input">
	
	<?php
		if (isset($_SESSION['e_username']))
		{
			echo '<div class="error">'.$_SESSION['e_username'].'</div>';
			unset($_SESSION['e_username']);
		}
	?>
	
	<input type="email" value="<?php
		if (isset($_SESSION['fr_email']))
		{
			echo $_SESSION['fr_email'];
			unset($_SESSION['fr_email']);
		}
	?>" name="email" placeholder="e-mail" class="form__text-input">
	
	<?php
		if (isset($_SESSION['e_email']))
		{
			echo '<div class="error">'.$_SESSION['e_email'].'</div>';
			unset($_SESSION['e_email']);
		}
	?>
	
	<input type="password"  value="<?php
		if (isset($_SESSION['fr_haslo1']))
		{
			echo $_SESSION['fr_haslo1'];
			unset($_SESSION['fr_haslo1']);
		}
	?>" name="haslo1" placeholder="hasło" class="form__text-input">
	
	<?php
		if (isset($_SESSION['e_haslo']))
		{
			echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
			unset($_SESSION['e_haslo']);
		}
	?>		
	
	<input type="password" value="<?php
		if (isset($_SESSION['fr_haslo2']))
		{
			echo $_SESSION['fr_haslo2'];
			unset($_SESSION['fr_haslo2']);
		}
	?>" name="haslo2" placeholder="powtórz hasło" class="form__text-input">
	
	<label class="terms">
		<input type="checkbox" name="regulamin" <?php
		if (isset($_SESSION['fr_regulamin']))
		{
			echo "checked";
			unset($_SESSION['fr_regulamin']);
		}
			?>/> Akceptuję regulamin
	</label>
	
	<?php
		if (isset($_SESSION['e_regulamin']))
		{
			echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
			unset($_SESSION['e_regulamin']);
		}
	?>	
	
	<div class="g-recaptcha" data-sitekey="6LeUTIcUAAAAAOWoquG3JjjqjZ4Lq3VVAdk6jlel"></div>
		
	<?php
		if (isset($_SESSION['e_bot']))
		{
			echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
			unset($_SESSION['e_bot']);
		}
	?>	
    
	
	<input type="submit" value="Ukończ rejestrację" class="form__button">
	<p class="form-box__info"><a href="logowanie.php">Zaloguj się</a></p>
    </form>
</div>

<?php include('footer.php'); ?>

</body>
</html>