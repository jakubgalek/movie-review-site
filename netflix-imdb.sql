-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 21 Gru 2023, 23:12
-- Wersja serwera: 10.1.37-MariaDB
-- Wersja PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `netflix`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `movies`
--

CREATE TABLE `movies` (
  `MovieID` int(11) NOT NULL,
  `Title` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `ReleaseYear` int(11) DEFAULT NULL,
  `Genre` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `Rating` decimal(3,1) DEFAULT NULL,
  `Duration` int(11) DEFAULT NULL,
  `Director` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL,
  `poster` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `movies`
--

INSERT INTO `movies` (`MovieID`, `Title`, `ReleaseYear`, `Genre`, `Rating`, `Duration`, `Director`, `poster`) VALUES
(1, 'Psycho', 1960, 'Horror', '8.5', 109, 'Alfred Hitchcock', '/netflix/posters/Psycho.jpg'),
(2, 'Vertigo', 1958, 'Mystery', '8.3', 128, 'Alfred Hitchcock', '/netflix/posters/Vertigo.jpg'),
(3, 'North by Northwest', 1959, 'Przygodowy', '8.3', 136, 'Alfred Hitchcock', '/netflix/posters/North_by_Northwest.jpg'),
(4, 'The Lord of the Rings: The Fellowship of the Ring', 2001, 'Przygodowy', '8.8', 178, 'Peter Jackson', '/netflix/posters/The_Lord_of_the_Rings_The_Fellowship_of_the_Ring.jpg'),
(5, 'The Lord of the Rings: The Two Towers', 2002, 'Przygodowy', '8.7', 179, 'Peter Jackson', '/netflix/posters/The_Lord_of_the_Rings_The_Two_Towers.jpg'),
(6, 'The Lord of the Rings: The Return of the King', 2003, 'Przygodowy', '8.9', 201, 'Peter Jackson', '/netflix/posters/The_Lord_of_the_Rings_The_Return_of_the_King.jpg'),
(7, 'The Hobbit: An Unexpected Journey', 2012, 'Przygodowy', '7.8', 169, 'Peter Jackson', '/netflix/posters/The_Hobbit_An_Unexpected_Journey.jpg'),
(8, 'The Hobbit: The Desolation of Smaug', 2013, 'Przygodowy', '7.8', 161, 'Peter Jackson', '/netflix/posters/The_Hobbit_The_Desolation_of_Smaug.jpg'),
(9, 'The Hobbit: The Battle of the Five Armies', 2014, 'Przygodowy', '7.4', 144, 'Peter Jackson', '/netflix/posters/The_Hobbit_The_Battle_of_the_Five_Armies.jpg'),
(10, 'Rear Window', 1954, 'Mystery', '8.5', 112, 'Alfred Hitchcock', '/netflix/posters/Rear_Window.jpg'),
(11, 'The Birds', 1963, 'Horror', '7.7', 119, 'Alfred Hitchcock', '/netflix/posters/The_Birds.jpg'),
(12, 'Dial M for Murder', 1954, 'Kryminał', '8.2', 105, 'Alfred Hitchcock', '/netflix/posters/Dial_M_for_Murder.jpg'),
(13, 'King Kong', 2005, 'Akcja', '7.2', 187, 'Peter Jackson', '/netflix/posters/King_Kong.jpg'),
(14, 'Heavenly Creatures', 1994, 'Biografia', '7.3', 99, 'Peter Jackson', '/netflix/posters/Heavenly_Creatures.jpg'),
(15, 'District 9', 2009, 'Akcja', '7.9', 112, 'Peter Jackson', '/netflix/posters/District_9.jpg'),
(16, 'Gran Torino', 2008, 'Dramat', '8.1', 116, 'Clint Eastwood', '/netflix/posters/Gran_Torino.jpg'),
(17, 'Shutter Island', 2010, 'Mystery', '8.1', 138, 'Martin Scorsese', '/netflix/posters/Shutter_Island.jpg'),
(18, 'Whiplash', 2014, 'Dramat', '8.5', 106, 'Damien Chazelle', '/netflix/posters/Whiplash.jpg'),
(19, 'The Prestige', 2006, 'Dramat', '8.5', 130, 'Christopher Nolan', '/netflix/posters/The_Prestige.jpg'),
(20, 'The Dark Knight', 2008, 'Akcja', '8.0', 152, 'Christopher Nolan', '/netflix/posters/The_Dark_Knight.jpg'),
(21, 'Parasite', 2019, 'Komedia', '8.6', 132, 'Bong Joon-ho', '/netflix/posters/Parasite.jpg'),
(22, 'Monty Python and the Holy Grail', 1975, 'Przygodowy', '8.2', 91, 'Terry Gilliam, Terry Jones', '/netflix/posters/Monty_Python_and_the_Holy_Grail.jpg'),
(23, 'Life of Brian', 1979, 'Komedia', '8.1', 94, 'Terry Jones', '/netflix/posters/Life_of_Brian.jpg'),
(24, 'The Wolf of Wall Street', 2013, 'Biografia', '8.2', 180, 'Martin Scorsese', '/netflix/posters/The_Wolf_of_Wall_Street.jpg'),
(25, 'Oppenheimer', 2023, 'Dramat', '8.1', 180, 'Christopher Nolan', '/netflix/posters/Oppenheimer.jpg'),
(26, 'Barbie', 2023, 'Komedia', '6.7', 114, 'Greta Gerwig', '/netflix/posters/Barbie.jpg'),
(27, 'Reservoir Dogs', 1992, 'Kryminał', '8.3', 99, 'Quentin Tarantino', '/netflix/posters/Reservoir_Dogs.jpg'),
(28, 'Pulp Fiction', 1994, 'Kryminał', '8.9', 154, 'Quentin Tarantino', '/netflix/posters/Pulp_Fiction.jpg'),
(29, 'Jackie Brown', 1997, 'Kryminał', '7.5', 154, 'Quentin Tarantino', '/netflix/posters/Jackie_Brown.jpg'),
(30, 'Kill Bill: Volume 1', 2003, 'Akcja', '8.1', 111, 'Quentin Tarantino', '/netflix/posters/Kill_Bill_Volume_1.jpg'),
(31, 'Kill Bill: Volume 2', 2004, 'Akcja', '8.0', 137, 'Quentin Tarantino', '/netflix/posters/Kill_Bill_Volume_2.jpg'),
(32, 'Death Proof', 2007, 'Thriller', '7.0', 113, 'Quentin Tarantino', '/netflix/posters/Death_Proof.jpg'),
(33, 'Inglourious Basterds', 2009, 'Przygodowy', '8.3', 153, 'Quentin Tarantino', '/netflix/posters/Inglourious_Basterds.jpg'),
(34, 'Django Unchained', 2012, 'Dramat', '8.4', 165, 'Quentin Tarantino', '/netflix/posters/Django_Unchained.jpg'),
(35, 'The Hateful Eight', 2015, 'Kryminał', '7.8', 168, 'Quentin Tarantino', '/netflix/posters/The_Hateful_Eight.jpg'),
(36, 'Once Upon a Time in Hollywood', 2019, 'Komedia', '7.6', 161, 'Quentin Tarantino', '/netflix/posters/Once_Upon_a_Time_in_Hollywood.jpg'),
(37, '2001: A Space Odyssey', 1968, 'Sci-Fi', '8.3', 149, 'Stanley Kubrick', '/netflix/posters/2001_A_Space_Odyssey.jpg'),
(38, 'A Clockwork Orange', 1971, 'Kryminał', '8.3', 136, 'Stanley Kubrick', '/netflix/posters/A_Clockwork_Orange.jpg'),
(39, 'The Shining', 1980, 'Horror', '8.4', 146, 'Stanley Kubrick', '/netflix/posters/The_Shining.jpg'),
(40, 'Full Metal Jacket', 1987, 'Dramat', '8.1', 116, 'Stanley Kubrick', '/netflix/posters/Full_Metal_Jacket.jpg'),
(41, 'Eyes Wide Shut', 1999, 'Dramat', '7.4', 159, 'Stanley Kubrick', '/netflix/posters/Eyes_Wide_Shut.jpg'),
(42, 'Eraserhead', 1977, 'Horror', '7.4', 89, 'David Lynch', '/netflix/posters/Eraserhead.jpg'),
(43, 'Blue Velvet', 1986, 'Dramat', '7.7', 120, 'David Lynch', '/netflix/posters/Blue_Velvet.jpg'),
(44, 'Twin Peaks: Fire Walk with Me', 1992, 'Dramat', '7.3', 135, 'David Lynch', '/netflix/posters/Twin_Peaks_Fire_Walk_with_Me.jpg'),
(45, 'Lost Highway', 1997, 'Mystery', '7.6', 134, 'David Lynch', '/netflix/posters/Lost_Highway.jpg'),
(46, 'Mulholland Drive', 2001, 'Mystery', '8.0', 147, 'David Lynch', '/netflix/posters/Mulholland_Drive.jpg'),
(47, 'Inland Empire', 2006, 'Dramat', '6.9', 180, 'David Lynch', '/netflix/posters/Inland_Empire.jpg'),
(48, 'Se7en', 1995, 'Kryminał', '8.6', 127, 'David Fincher', '/netflix/posters/Se7en.jpg'),
(49, 'Fight Club', 1999, 'Dramat', '8.8', 139, 'David Fincher', '/netflix/posters/Fight_Club.jpg'),
(50, 'The Social Network', 2010, 'Biografia', '7.7', 120, 'David Fincher', '/netflix/posters/The_Social_Network.jpg'),
(51, 'Gone Girl', 2014, 'Kryminał', '8.1', 149, 'David Fincher', '/netflix/posters/Gone_Girl.jpg'),
(52, 'Mindhunter (TV Series)', 2017, 'Kryminał', '8.6', NULL, 'David Fincher', '/netflix/posters/Mindhunter_(TV_Series).jpg'),
(53, 'Mank', 2020, 'Biografia', '7.0', 131, 'David Fincher', '/netflix/posters/Mank.jpg'),
(54, 'Miś', 1980, 'Komedia', '8.1', 112, 'Stanisław Bareja', '/netflix/posters/Mis.jpg'),
(55, 'Alternatywy 4 (TV Series)', 1983, 'Komedia', '8.5', NULL, 'Stanisław Bareja', '/netflix/posters/Alternatywy_4_(TV_Series).jpg'),
(56, 'Knife in the Water', 1962, 'Dramat', '7.6', 94, 'Roman Polański', '/netflix/posters/Knife_in_the_Water.jpg'),
(57, 'Rosemary\'s Baby', 1968, 'Horror', '8.0', 136, 'Roman Polański', '/netflix/posters/Rosemarys_Baby.jpg'),
(58, 'Chinatown', 1974, 'Kryminał', '8.2', 130, 'Roman Polański', '/netflix/posters/Chinatown.jpg'),
(59, 'The Pianist', 2002, 'Biografia', '8.5', 150, 'Roman Polański', '/netflix/posters/The_Pianist.jpg'),
(60, 'Harry Potter and the Philosopher\'s Stone', 2001, 'Fantasy', '7.6', 152, 'Chris Columbus', '/netflix/posters/Harry_Potter_and_the_Philosophers_Stone.jpg'),
(61, 'Harry Potter and the Chamber of Secrets', 2002, 'Fantasy', '7.4', 161, 'Chris Columbus', '/netflix/posters/Harry_Potter_and_the_Chamber_of_Secrets.jpg'),
(62, 'Harry Potter and the Prisoner of Azkaban', 2004, 'Fantasy', '7.9', 142, 'Alfonso Cuarón', '/netflix/posters/Harry_Potter_and_the_Prisoner_of_Azkaban.jpg'),
(63, 'Harry Potter and the Goblet of Fire', 2005, 'Fantasy', '7.7', 157, 'Mike Newell', '/netflix/posters/Harry_Potter_and_the_Goblet_of_Fire.jpg'),
(64, 'Harry Potter and the Order of the Phoenix', 2007, 'Fantasy', '7.5', 138, 'David Yates', '/netflix/posters/Harry_Potter_and_the_Order_of_the_Phoenix.jpg'),
(65, 'Harry Potter and the Half-Blood Prince', 2009, 'Fantasy', '7.6', 153, 'David Yates', '/netflix/posters/Harry_Potter_and_the_Half-Blood_Prince.jpg'),
(66, 'Harry Potter and the Deathly Hallows – Part 1', 2010, 'Fantasy', '7.7', 146, 'David Yates', '/netflix/posters/Harry_Potter_and_the_Deathly_Hallows_Part_1.jpg'),
(67, 'Harry Potter and the Deathly Hallows – Part 2', 2011, 'Fantasy', '8.1', 130, 'David Yates', '/netflix/posters/Harry_Potter_and_the_Deathly_Hallows_Part_2.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ratings`
--

CREATE TABLE `ratings` (
  `RatingID` int(11) NOT NULL,
  `MovieID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Score` int(11) DEFAULT NULL,
  `Comment` text COLLATE utf8_polish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `ratings`
--

INSERT INTO `ratings` (`RatingID`, `MovieID`, `UserID`, `Score`, `Comment`) VALUES
(1, 6, 4, 10, '\r\nWładca Pierścieni: Powrót Króla to epicki finał trylogii Petera Jacksona, a zarazem jeden z najbardziej oszałamiających wizualnie i emocjonalnie poruszających filmów wszech czasów. Film opowiada o losach Froda Bagginsa i jego towarzyszy, którzy wyruszają do Mordoru, aby zniszczyć Jedyny Pierścień, jedyną rzecz, która może pokonać Czarnego Władcę Saurona.'),
(10, 3, 3, 7, ' Film trzyma w napięciu od początku do końca, a aktorstwo Caryego Granta i Evy Marie Saint jest znakomite. Jest to jeden z najlepszych filmów Hitchcocka, który warto zobaczyć przynajmniej raz w życiu.'),
(12, 4, 2, 6, 'Bardzo dobry film, polecam! Świetna fabuła i znakomite aktorstwo.'),
(17, 4, 3, 9, 'Uwielbiłem ten film za świetne tempo i wspaniałą ścieżkę dźwiękową.'),
(18, 5, 2, 8, 'Solidny film, który zaskoczył mnie nietypowym zakończeniem.'),
(21, 2, 2, 9, 'Genialny film! Mistrzowska gra aktorska i pełna intryga.'),
(23, 5, 3, 8, 'Film zaskoczył mnie pozytywnie, polecam!'),
(26, 12, 3, 9, 'Fantastyczny film! Doskonała fabuła i znakomite aktorstwo.'),
(29, 31, 3, 6, 'Intrygujący, ale momentami traciłam wątek.'),
(31, 37, 2, 8, 'Wciągający, świetna gra aktorska.'),
(32, 41, 3, 9, 'Znakomita produkcja! Niesamowita historia.'),
(34, 46, 2, 8, 'Niezła historia, trzyma w napięciu.'),
(35, 36, 3, 6, 'Słaba fabuła, ale momentami wciągający.'),
(37, 42, 2, 9, 'Wspaniała produkcja! Świetny scenariusz i aktorstwo.'),
(38, 39, 3, 7, 'Ciekawy film, choć niektóre momenty były przewidywalne.'),
(40, 43, 2, 6, 'Nieźle, ale mogło być lepiej.'),
(41, 34, 3, 7, 'Przyzwoity, choć brakowało mi głębi w fabule.'),
(43, 45, 2, 8, 'Znakomity film, nie spodziewałem się takiego zakończenia.'),
(44, 29, 3, 6, 'Nieco przeciętny, ale momentami emocjonujący.'),
(46, 44, 2, 8, 'Dobra rozrywka, polecam! Wciągający scenariusz.'),
(47, 33, 3, 9, 'Wspaniała produkcja! Doskonale zrealizowany film.'),
(49, 35, 2, 8, 'Zaskakujący, świetnie zagrany film.'),
(50, 26, 3, 6, 'Nieco przewidywalny, ale ogólnie warty obejrzenia.'),
(51, 51, 3, 9, 'Znakomita produkcja! Doskonała fabuła i znakomite aktorstwo.'),
(53, 53, 2, 8, 'Dobry film, zaskakujący koniec.'),
(54, 54, 3, 6, 'Nieźle, ale mogło być lepiej.'),
(56, 56, 2, 8, 'Dobra rozrywka, polecam! Wciągający scenariusz.'),
(57, 57, 3, 9, 'Genialny film! Ciekawa historia i świetne wykonanie.'),
(59, 59, 2, 8, 'Nieco przeciętny, ale momentami emocjonujący.'),
(60, 60, 3, 6, 'Ciekawy film, choć nie brakowało mu kilku poprawek.'),
(62, 62, 2, 8, 'Zaskakujący, świetnie zagrany film.'),
(63, 63, 3, 9, 'Wspaniała produkcja! Doskonale zrealizowany film.'),
(69, 6, 3, 9, 'Wspaniała produkcja! Doskonale zrealizowany film.'),
(70, 7, 3, 7, 'Przyjemny film, choć brakowało mu pewnej finezji.'),
(72, 9, 4, 6, 'Nieco rozczarowujący, oczekiwałem więcej.'),
(74, 11, 3, 7, 'Przyzwoita produkcja, choć momentami przewidywalna.'),
(75, 8, 2, 6, 'Niesamowity film! Zdecydowanie jeden z moich ulubionych.'),
(79, 10, 4, 3, 'Trochę rozczarowujący, ale mimo to warty obejrzenia.'),
(82, 14, 2, 6, 'Zaskakująca fabuła i genialne aktorstwo. Polecam!'),
(83, 14, 4, 7, 'Bardzo wzruszająca historia. Płakałem jak dziecko.'),
(84, 15, 2, 3, 'Trochę rozczarowujący, ale mimo to warty obejrzenia.'),
(86, 13, 2, 8, 'Niesamowity film! Zdecydowanie jeden z moich ulubionych.'),
(88, 65, 2, 7, 'Świetna komedia! Doskonałe poczucie humoru.'),
(92, 66, 3, 4, 'Epicka przygoda. Widziałem go już kilka razy.'),
(94, 67, 2, 7, 'Wciągający dramat. Emocje na najwyższym poziomie.'),
(120, 1, 2, 8, 'Intrygujący film, polecam!'),
(128, 9, 2, 6, 'Nieco rozczarowujący, spodziewałem się więcej.'),
(130, 11, 4, 7, 'Przyjemny film, choć brakowało mu dynamiki.'),
(135, 16, 2, 7, 'Nieco przeciętny, ale momentami emocjonujący.'),
(136, 17, 3, 9, 'Wspaniała produkcja! Doskonała fabuła i wykonanie.'),
(138, 19, 3, 8, 'Bardzo dobra historia, trzyma w napięciu do ostatniej sceny.'),
(139, 20, 2, 6, 'Nieco rozczarowujący, spodziewałem się więcej.'),
(141, 22, 3, 7, 'Przyjemny film, choć brakowało mu dynamiki.'),
(143, 24, 2, 7, 'Przyjemna rozrywka, chociaż fabuła mogła być bardziej rozbudowana.'),
(144, 25, 3, 9, 'Znakomity film! Doskonale zrealizowany, wciągający od początku do końca.'),
(145, 26, 4, 8, 'Ciekawy koncept, chociaż niektóre momenty były przewidywalne.'),
(146, 27, 2, 7, 'Nieco przeciętny, ale zaskakujący finał.'),
(147, 28, 3, 9, 'Wspaniała produkcja! Świetna gra aktorska i dynamiczna akcja.'),
(149, 30, 3, 8, 'Bardzo dobra historia, trzyma w napięciu do ostatnich minut.'),
(150, 31, 2, 6, 'Nieco rozczarowujący, ale warto dać mu szansę.'),
(152, 33, 2, 8, 'Zaskakujący, intrygujący, świetnie zagrany film.'),
(153, 34, 3, 7, 'Przyjemna rozrywka, chociaż niektóre wątki były naciągane.'),
(155, 36, 2, 7, 'Nieco przeciętny, ale momentami zaskakujący.'),
(156, 37, 3, 9, 'Wspaniała produkcja! Doskonała gra aktorska i poruszająca fabuła.'),
(158, 39, 3, 8, 'Bardzo dobra historia, zakończona nieoczekiwanym zwrotem akcji.'),
(159, 40, 2, 6, 'Nieco rozczarowujący, ale wart obejrzenia dla oryginalnego pomysłu.'),
(161, 42, 2, 8, 'Zaskakujący finał, który nadaje całej historii nowy sens.'),
(162, 43, 3, 7, 'Przyjemna rozrywka, choć kilka wątków było trochę przewidywalnych.'),
(164, 45, 3, 7, 'Przyjemna rozrywka, chociaż fabuła mogła być bardziej rozbudowana.'),
(165, 46, 3, 9, 'Znakomity film! Doskonale zrealizowany, wciągający od początku do końca.'),
(167, 48, 2, 7, 'Nieco przeciętny, ale zaskakujący finał.'),
(168, 49, 3, 9, 'Wspaniała produkcja! Świetna gra aktorska i dynamiczna akcja.'),
(170, 51, 3, 8, 'Bardzo dobra historia, trzyma w napięciu do ostatnich minut.'),
(171, 52, 2, 6, 'Nieco rozczarowujący, ale warto dać mu szansę.'),
(173, 54, 2, 8, 'Zaskakujący, intrygujący, świetnie zagrany film.'),
(174, 55, 3, 7, 'Przyjemna rozrywka, chociaż niektóre wątki były naciągane.'),
(176, 57, 2, 7, 'Nieco przeciętny, ale momentami zaskakujący.'),
(177, 58, 3, 9, 'Wspaniała produkcja! Doskonała gra aktorska i poruszająca fabuła.'),
(179, 60, 3, 8, 'Bardzo dobra historia, zakończona nieoczekiwanym zwrotem akcji.'),
(180, 61, 2, 6, 'Nieco rozczarowujący, ale wart obejrzenia dla oryginalnego pomysłu.'),
(182, 63, 2, 8, 'Zaskakujący finał, który nadaje całej historii nowy sens.'),
(183, 64, 3, 7, 'Przyjemna rozrywka, choć kilka wątków było trochę przewidywalnych.'),
(184, 13, 4, 8, 'Intrygujący film, wart obejrzenia!'),
(186, 15, 3, 9, 'Znakomity film! Doskonale zrealizowany, wciągający od początku do końca.'),
(188, 17, 2, 7, 'Nieco przeciętny, ale zaskakujący finał.'),
(189, 18, 3, 9, 'Wspaniała produkcja! Świetna gra aktorska i dynamiczna akcja.'),
(191, 20, 3, 8, 'Bardzo dobra historia, trzyma w napięciu do ostatnich minut.'),
(192, 21, 3, 6, 'Nieco rozczarowujący, ale warto dać mu szansę.'),
(194, 23, 2, 8, 'Zaskakujący, intrygujący, świetnie zagrany film.'),
(195, 24, 3, 7, 'Przyjemna rozrywka, chociaż niektóre wątki były naciągane.'),
(197, 26, 2, 7, 'Nieco przeciętny, ale momentami zaskakujący.'),
(198, 27, 3, 9, 'Wspaniała produkcja! Doskonała gra aktorska i poruszająca fabuła.'),
(200, 29, 3, 8, 'Bardzo dobra historia, zakończona nieoczekiwanym zwrotem akcji.'),
(201, 30, 2, 6, 'Nieco rozczarowujący, ale wart obejrzenia dla oryginalnego pomysłu.'),
(203, 32, 2, 8, 'Zaskakujący finał, który nadaje całej historii nowy sens.'),
(204, 33, 3, 7, 'Przyjemna rozrywka, choć kilka wątków było trochę przewidywalnych.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL,
  `Birthdate` date DEFAULT NULL,
  `SubscriptionType` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `JOIN_DATE` date DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `email`, `Birthdate`, `SubscriptionType`, `JOIN_DATE`, `password`) VALUES
(1, 'test', 'test@test.test', '1985-05-20', 'Basic', '2022-02-02', 'test'),
(2, 'karol', 'karol@o2.com', '1985-05-20', 'Premium+', '2022-02-15', 'masnyben2222'),
(3, 'adam', 'adam@wp.com', '1992-08-10', 'Basic', '2022-03-10', 'witek1234'),
(4, 'angelika', 'angelika@gmail.com', '1995-04-25', 'Premium', '2023-12-19', 'kingkongstrong');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`MovieID`);

--
-- Indeksy dla tabeli `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`RatingID`),
  ADD KEY `MovieID` (`MovieID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `ratings`
--
ALTER TABLE `ratings`
  MODIFY `RatingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`MovieID`) REFERENCES `movies` (`MovieID`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
