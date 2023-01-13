-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2020 at 09:00 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movies`
--

-- --------------------------------------------------------

--
-- Table structure for table `crew`
--

CREATE TABLE `crew` (
  `id` int(12) NOT NULL,
  `fullName` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crew`
--

INSERT INTO `crew` (`id`, `fullName`) VALUES
(1, 'Michael Haneke'),
(2, 'Stefan Arndt'),
(3, 'Nadine Muse'),
(4, 'Darius Khondji'),
(5, 'Jean-Louis Trintignant'),
(6, 'Emmanuelle Riva'),
(7, 'Ingmar Bergman'),
(8, 'Jörn Donner'),
(9, 'Sylvia Ingemarsson'),
(10, 'Sven Nykvist'),
(11, 'Bertil Guve'),
(12, 'Pernilla Allwin'),
(13, 'Terry Gilliam'),
(14, 'Arnon Milchan'),
(15, 'Julian Doyle'),
(16, 'Roger Pratt'),
(17, 'Jonathan Pryce'),
(18, 'Robert De Niro'),
(19, 'Robert Eggers'),
(20, 'Arnon Milchan'),
(21, 'Louise Ford'),
(22, 'Jarin Blaschke'),
(23, 'Robert Pattinson'),
(24, 'Willem Dafoe'),
(25, 'Paul Thomas Anderson'),
(26, 'Leslie Jones'),
(27, 'Robert Elswit'),
(28, 'Adam Sandler'),
(29, 'Emily Watson'),
(30, 'Nicolas Roeg'),
(31, 'Michael Deeley'),
(32, 'Walter Tevis'),
(33, 'Graeme Clifford'),
(34, 'Anthony B. Richmond'),
(35, 'David Bowie'),
(36, 'Rip Torn'),
(37, 'Masaki Kobayashi'),
(38, 'Shigeru Wakatsuki'),
(39, 'Yoko Mizuki'),
(40, 'Hisashi Sagara'),
(41, 'Yoshio Miyajima'),
(42, 'Michiyo Aratama'),
(43, 'Misako Watanabe'),
(44, 'Michael Mann'),
(45, 'William Goldenberg'),
(46, 'Dion Beebe'),
(47, 'Jamie Foxx'),
(48, 'Colin Farrell'),
(49, 'Spike Lee'),
(50, 'Jon Kilik'),
(51, 'Barry Alexander Brown'),
(52, 'Arthur Jafa'),
(53, 'Alfre Woodard'),
(54, 'Delroy Lindo'),
(55, 'Jason Reitman'),
(56, 'Diablo Cody'),
(57, 'Stefan Grube'),
(58, 'Eric Steelberg'),
(59, 'Charlize Theron'),
(60, 'Mackenzie Davis'),
(61, 'Vittorio De Sica'),
(62, 'Giuseppe Amato'),
(63, 'Cesare Zavattini'),
(64, 'Eraldo Da Roma'),
(65, 'G.R. Aldo'),
(66, 'Carlo Battisti'),
(67, 'Lina Gennari'),
(68, 'Juzo Itami'),
(69, 'Yasushi Tamaoki'),
(70, 'Akira Suzuki'),
(71, 'Yonezô Maeda'),
(72, 'Nobuko Miyamoto'),
(73, 'Masahiko Tsugawa'),
(74, 'Todd Haynes'),
(75, 'Tessa Ross'),
(76, 'Patricia Highsmith'),
(77, 'Affonso Gonçalves'),
(78, 'Edward Lachman'),
(79, 'Rooney Mara'),
(80, 'Cate Blanchett'),
(81, 'Rian Johnson'),
(82, 'Arnon Milchan'),
(86, 'Daniel Craig'),
(87, 'Chris Evans'),
(88, 'Bob Ducsay\r\n\r\n'),
(89, 'Steve Yedlin'),
(90, 'Luc Dardenne'),
(91, 'Marie-Hélène Dozo'),
(92, 'Alain Marcoen'),
(93, 'Marion Cotillard'),
(94, 'Fabrizio Rongione'),
(95, 'Wes Anderson'),
(96, 'Andrew Weisblum'),
(97, 'Robert D. Yeoman'),
(98, 'Bill Murray'),
(99, 'Benicio del Toro'),
(100, 'Quentin Tarantino'),
(101, 'Lawrence Bender'),
(102, 'Sally Menke'),
(103, 'Andrzej Sekula'),
(104, 'John Travolta'),
(105, 'Samuel L. Jackson'),
(106, 'Martin Scorsese'),
(107, 'Julia Phillips'),
(108, 'Paul Schrader'),
(109, 'Tom Rolf'),
(110, 'Michael Chapman'),
(111, 'Robert De Niro'),
(112, 'Jodie Foster'),
(113, 'Robert Zemeckis'),
(114, 'Steven Spielberg'),
(116, 'Arthur Schmidt'),
(117, 'Dean Cundey'),
(118, 'Michael J. Fox'),
(119, 'Christopher Lloyd'),
(120, 'Luca Guadagnino'),
(121, 'James Ivory'),
(122, 'Walter Fasano'),
(123, 'Sayombhu Mukdeeprom'),
(124, 'Timothée Chalamet'),
(125, 'Armie Hammer');

-- --------------------------------------------------------

--
-- Table structure for table `crew_movieroles`
--

CREATE TABLE `crew_movieroles` (
  `crew_id` int(12) NOT NULL,
  `movieRoles_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crew_movieroles`
--

INSERT INTO `crew_movieroles` (`crew_id`, `movieRoles_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 6),
(6, 6),
(7, 1),
(7, 2),
(8, 3),
(9, 4),
(10, 5),
(11, 6),
(12, 6),
(13, 1),
(13, 2),
(14, 3),
(15, 4),
(16, 5),
(17, 6),
(18, 6),
(19, 1),
(19, 2),
(20, 3),
(21, 4),
(22, 5),
(23, 6),
(24, 6),
(25, 1),
(25, 2),
(25, 3),
(26, 4),
(27, 5),
(28, 6),
(29, 6),
(30, 1),
(31, 2),
(32, 3),
(33, 4),
(34, 5),
(35, 6),
(36, 6),
(37, 1),
(38, 2),
(39, 3),
(40, 4),
(41, 5),
(42, 6),
(43, 6),
(44, 1),
(44, 2),
(44, 3),
(45, 4),
(46, 5),
(47, 6),
(48, 6),
(49, 1),
(49, 2),
(50, 3),
(51, 4),
(52, 5),
(53, 6),
(54, 6),
(55, 1),
(56, 2),
(57, 4),
(58, 5),
(59, 3),
(59, 6),
(60, 6),
(61, 1),
(62, 2),
(63, 3),
(64, 4),
(65, 5),
(66, 6),
(67, 6),
(68, 1),
(68, 2),
(69, 3),
(70, 4),
(71, 5),
(72, 6),
(73, 6),
(74, 1),
(75, 2),
(76, 3),
(77, 4),
(78, 5),
(79, 6),
(80, 6),
(81, 1),
(81, 2),
(82, 3),
(86, 6),
(87, 6),
(88, 4),
(89, 5),
(90, 1),
(90, 2),
(90, 3),
(91, 4),
(92, 5),
(93, 6),
(94, 6),
(95, 1),
(95, 2),
(95, 3),
(96, 4),
(97, 5),
(98, 6),
(99, 6),
(100, 1),
(100, 2),
(101, 3),
(102, 4),
(103, 5),
(104, 6),
(105, 6),
(106, 1),
(107, 2),
(108, 3),
(109, 4),
(110, 5),
(111, 6),
(112, 6),
(113, 1),
(113, 2),
(114, 3),
(116, 4),
(117, 5),
(118, 6),
(119, 6),
(120, 1),
(121, 2),
(121, 3),
(122, 4),
(123, 5),
(124, 6),
(125, 6);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(2) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'action'),
(2, 'adventure'),
(3, 'animation'),
(4, 'comedy'),
(5, 'crime'),
(6, 'documentary'),
(7, 'drama'),
(8, 'family'),
(9, 'fantasy'),
(10, 'history'),
(11, 'horror'),
(12, 'music'),
(13, 'mystery'),
(14, 'romance'),
(15, 'science fiction'),
(16, 'thriller'),
(17, 'western');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `year` int(4) NOT NULL,
  `length` int(3) NOT NULL,
  `synopsis` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `title`, `year`, `length`, `synopsis`) VALUES
(1, 'Amour', 2012, 127, 'Georges and Anne are in their eighties. They are cultivated, retired music teachers. Their daughter, who is also a musician, lives abroad with herfamily. One day, Anne has a stroke, and the couple’s bond of love is severely tested.'),
(2, 'Fanny and Alexander', 1982, 188, 'As children in the loving Ekdahl family, Fanny and Alexander enjoy a happy life with their parents, who run a theater company. After their father dies unexpectedly, however, the siblings end up in a joyless home when their mother, Emilie, marries a stern bishop. The bleak situation gradually grows worse as the bishop becomes more controlling, but dedicated relatives make a valiant attempt to aid Emilie, Fanny and Alexander.'),
(3, 'Brazil', 1985, 132, 'Low-level bureaucrat Sam Lowry escapes the monotony of his day-to-day life through a recurring daydream of himself as a virtuous hero saving a beautiful damsel. Investigating a case that led to the wrongful arrest and eventual death of an innocent man instead of wanted terrorist Harry Tuttle, he meets the woman from his daydream, and in trying to help her gets caught in a web of mistaken identities, mindless bureaucracy and lies.'),
(4, 'The Lighthouse', 2019, 110, 'Two lighthouse keepers try to maintain their sanity while living on a remote and mysterious New England island in the 1890s.'),
(5, 'Punch-Drunk Love', 2002, 96, 'A socially awkward and volatile small business owner meets the love of his life after being threatened by a gang of scammers.'),
(6, 'The Man Who Fell to Earth', 1976, 138, 'Thomas Jerome Newton is an alien who has come to Earth in search of water to save his home planet. Aided by lawyer Oliver Farnsworth, Thomas uses his knowledge of advanced technology to create profitable inventions. While developing a method to transport water, Thomas meets Mary-Lou, a quiet hotel clerk, and begins to fall in love with her. Just as he is ready to leave Earth, Thomas is intercepted by the U.S. government, and his entire plan is threatened.'),
(7, 'Kwaidan', 1964, 182, 'Taking its title from an archaic Japanese word meaning “ghost story,” this anthology adapts four folk tales. A penniless samurai marries for money with tragic results. A man stranded in a blizzard is saved by Yuki the Snow Maiden, but his rescue comes at a cost. Blind musician Hoichi is forced to perform for an audience of ghosts. An author relates the story of a samurai who sees another warrior’s reflection in his teacup.'),
(8, 'Miami Vice', 2006, 132, 'Miami Vice is a feature film based on the 1980s action drama TV series. The film tells the story of vice detectives Crockett and Tubbs and how their personal and professional lives are dangerously getting mixed.'),
(9, 'Crooklyn', 1994, 115, 'From Spike Lee comes this vibrant semi-autobiographical portrait of a school-teacher, her stubborn jazz-musician husband and their five kids living in ’70s Brooklyn.'),
(10, 'Tully', 2018, 96, 'Marlo, a mother of three, including a newborn, is gifted a night nanny by her brother. Hesitant at first, she quickly forms a bond with the thoughtful, surprising, and sometimes challenging nanny named Tully.'),
(11, 'Umberto D.', 1952, 91, 'When elderly pensioner Umberto Domenico Ferrari returns to his boarding house from a protest calling for a hike in old-age pensions, his landlady demands her 15,000-lire rent by the end of the month or he and his small dog will be turned out onto the street. Unable to get the money in time, Umberto fakes illness to get sent to a hospital, giving his beloved dog to the landlady’s pregnant and abandoned maid for temporary safekeeping.'),
(12, 'Supermarket Woman', 1996, 127, 'Goro’s supermarket is not doing well; the rival “Bargains Galore” threatens his business. A chance encounter with Hanako, an energetic woman he knew in grade school, results in big retail and life changes.'),
(13, 'Carol', 2015, 118, 'In 1950s New York, a department-store clerk who dreams of a better life falls for an older, married woman.'),
(14, 'Knives Out', 2019, 132, 'When renowned crime novelist Harlan Thrombey is found dead at his estate just after his 85th birthday, the inquisitive and debonair Detective Benoit Blanc is mysteriously enlisted to investigate. From Harlan’s dysfunctional family to his devoted staff, Blanc sifts through a web of red herrings and self-serving lies to uncover the truth behind Harlan’s untimely death.'),
(15, 'Two Days, One Night', 2014, 95, 'Sandra is a young woman who has only one weekend to convince her colleagues they must give up their bonuses in order for her to keep her job — not an easy task in this economy.'),
(16, 'The French Dispatch', 2020, 108, 'The staff of a European publication decides to publish a memorial edition highlighting the three best stories from the last decade: an artist sentenced to life imprisonment, student riots, and a kidnapping resolved by a chef.'),
(17, 'Pulp Fiction', 1994, 154, 'A burger-loving hit man, his philosophical partner, a drug-addled gangster’s moll and a washed-up boxer converge in this sprawling, comedic crime caper. Their adventures unfurl in three stories that ingeniously trip back and forth in time.'),
(18, 'Taxi Driver', 1976, 114, 'A mentally unstable Vietnam War veteran works as a night-time taxi driver in New York City where the perceived decadence and sleaze feed his urge for violent action, attempting to save a preadolescent prostitute in the process.'),
(19, 'Back To The Future', 1985, 116, 'Eighties teenager Marty McFly is accidentally sent back in time to 1955, inadvertently disrupting his parents’ first meeting and attracting his mother’s romantic interest. Marty must repair the damage to history by rekindling his parents’ romance and – with the help of his eccentric inventor friend Doc Brown – return to 1985.');

-- --------------------------------------------------------

--
-- Table structure for table `moviephoto`
--

CREATE TABLE `moviephoto` (
  `id` int(12) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `src` varchar(50) NOT NULL,
  `alt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `moviephoto`
--

INSERT INTO `moviephoto` (`id`, `movie_id`, `src`, `alt`) VALUES
(1, 1, '1.jpg', 'Amour'),
(2, 2, '2.jpg', 'Fanny And Alexander'),
(3, 3, '3.jpg', 'Brazil'),
(4, 4, '4.jpg', 'The Lighthouse'),
(5, 5, '5.jpg', 'Punch-Drunk Love'),
(6, 6, '6.jpg', 'The Man Who Fell To Earth'),
(7, 7, '7.jpg', 'Kwaidan'),
(8, 8, '8.jpg', 'Miami Vice'),
(9, 9, '9.jpg', 'Crooklyn'),
(10, 10, '10.jpg', 'Tully'),
(11, 11, '11.jpg', 'Umberto D.'),
(12, 12, '12.jpg', 'Supermarker Woman'),
(13, 13, '13.jpg', 'Carol'),
(14, 14, '14.jpg', 'Knives Out'),
(15, 15, '15.jpg', 'Two Days, One Night'),
(16, 16, '16.jpg', 'The French Dispatch'),
(17, 17, '17.jpg', 'Pulp Fiction'),
(18, 18, '18.jpg', 'Taxi Driver'),
(19, 19, '19.jpg', 'Back To The Future'),
(20, 20, '20.jpg', 'Call Me By Your Name');

-- --------------------------------------------------------

--
-- Table structure for table `movieroles`
--

CREATE TABLE `movieroles` (
  `id` int(2) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movieroles`
--

INSERT INTO `movieroles` (`id`, `name`) VALUES
(1, 'director'),
(2, 'writer'),
(3, 'producer'),
(4, 'editor'),
(5, 'cinematographer'),
(6, 'actor');

-- --------------------------------------------------------

--
-- Table structure for table `movie_crew`
--

CREATE TABLE `movie_crew` (
  `crew_id` int(12) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie_crew`
--

INSERT INTO `movie_crew` (`crew_id`, `movie_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 4),
(20, 4),
(21, 4),
(22, 4),
(23, 4),
(24, 4),
(25, 5),
(26, 5),
(27, 5),
(28, 5),
(29, 5),
(30, 6),
(31, 6),
(32, 6),
(33, 6),
(34, 6),
(35, 6),
(36, 6),
(37, 7),
(38, 7),
(39, 7),
(40, 7),
(41, 7),
(42, 7),
(43, 7),
(44, 8),
(45, 8),
(46, 8),
(47, 8),
(48, 8),
(49, 9),
(50, 9),
(51, 9),
(52, 9),
(53, 9),
(54, 9),
(55, 10),
(56, 10),
(57, 10),
(58, 10),
(59, 10),
(60, 10),
(61, 11),
(62, 11),
(63, 11),
(64, 11),
(65, 11),
(66, 11),
(67, 11),
(68, 12),
(69, 12),
(70, 12),
(71, 12),
(72, 12),
(73, 12),
(74, 13),
(75, 13),
(76, 13),
(77, 13),
(78, 13),
(79, 13),
(80, 13),
(81, 14),
(82, 14),
(86, 14),
(87, 14),
(88, 14),
(89, 14),
(90, 15),
(91, 15),
(92, 15),
(93, 15),
(94, 15),
(95, 16),
(96, 16),
(97, 16),
(98, 16),
(99, 16),
(100, 17),
(101, 17),
(102, 17),
(103, 17),
(104, 17),
(105, 17),
(106, 18),
(107, 18),
(108, 18),
(109, 18),
(110, 18),
(111, 18),
(112, 18),
(113, 19),
(114, 19),
(116, 19),
(117, 19),
(118, 19),
(119, 19);

-- --------------------------------------------------------

--
-- Table structure for table `movie_genre`
--

CREATE TABLE `movie_genre` (
  `movie_id` int(11) NOT NULL,
  `genre_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie_genre`
--

INSERT INTO `movie_genre` (`movie_id`, `genre_id`) VALUES
(1, 7),
(1, 14),
(2, 7),
(2, 9),
(2, 13),
(3, 4),
(3, 15),
(4, 7),
(4, 9),
(4, 11),
(4, 13),
(5, 7),
(5, 14),
(6, 7),
(6, 15),
(7, 7),
(7, 9),
(7, 11),
(8, 1),
(8, 5),
(9, 4),
(9, 7),
(10, 4),
(10, 7),
(11, 7),
(12, 4),
(13, 7),
(13, 14),
(14, 4),
(14, 13),
(15, 7),
(16, 4),
(16, 7),
(16, 14),
(17, 5),
(17, 16),
(18, 5),
(18, 7),
(19, 2),
(19, 8),
(19, 9);

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE `navigation` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `link` varchar(60) DEFAULT NULL,
  `level` int(8) NOT NULL,
  `type` varchar(40) NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`id`, `name`, `link`, `level`, `type`, `parent_id`) VALUES
(1, 'movies', 'movies.php', 1, 'header', NULL),
(2, 'reviews', 'reviews.php', 1, 'header', NULL),
(3, 'watchlist', 'watchlist.php', 1, 'header', NULL),
(4, 'useful links', NULL, 1, 'footer', NULL),
(5, 'social', NULL, 1, 'footer', NULL),
(6, 'instagram', 'https://www.instagram.com/', 2, 'footer', 5),
(8, 'twitter', 'https://www.twitter.com/', 2, 'footer', 5),
(9, 'author', 'author.php', 2, 'footer', 4),
(10, 'documentation', 'documentation.pdf', 2, 'footer', 4),
(11, 'contact', 'contact.php', 1, 'header', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `offeredanswers`
--

CREATE TABLE `offeredanswers` (
  `id` int(8) NOT NULL,
  `text` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offeredanswers`
--

INSERT INTO `offeredanswers` (`id`, `text`) VALUES
(1, 'Very often'),
(2, 'Moderately often'),
(3, 'Not at all often');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(5) NOT NULL,
  `text` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `text`) VALUES
(1, 'How often do you watch movies?'),
(2, 'Out of all the movies you\'ve seen, what\'s your favorite?');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(13) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `text` varchar(1400) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `user_id`, `movie_id`, `text`, `date_posted`) VALUES
(1, 1, 3, 'The Film That Changed My Life. Saw it 10 times or more during its theatrical run, and it pretty much singlehandedly kick-started my sense of the medium as more than passing entertainment; can\'t really pretend to be objective about it now, though I\'d expected to rate it even higher. As an exercise, I tried very hard this time—my first viewing since around 1994 or \'95—to watch it as if I don\'t have it memorized, imagining how it would play to virgin eyes. For about half an hour, it was clearly the greatest movie ever made, a stunningly realized dystopic-absurdist playground/nightmare. Then Gilliam is forced to start paying at least marginal attention to the narrative, which isn\'t his forte, and it idles down to merely magnificent. Much as I\'d like to, though, I can\'t blame that all on Greist. Brazil is a masterpiece in every way...except rhythmically.', '2020-03-28 20:18:27'),
(2, 1, 5, 'I can\'t say it\'s PT Anderson\'s best, but goddamn is it my favorite. Such a great character study that really hits home just how great of an actor Adam Sandler can be. Actually everyone is pretty darn perfect in this. From Philip Seymour Hoffman\'s balance of menacing and cartoonish, the seven sisters inanity, to Emily Watson portraying Lena\'s head over heels Innocents with utmost sincerity. It\'s all just...ugh, so damn beautiful that I want to bite it.', '2020-03-28 20:19:22'),
(4, 2, 9, 'Wow. This was extremely authentic and powerful, a nostalgic recall to the glory days of innocent childhood aided by a perfect soundtrack reminiscent of the era and Lee’s direction was outstanding. There’s also some crazy good child acting here (particularly from Zelda Harris) not to mention the exemplary performances from Alfre Woodard and Delroy Lindo. I liked this far more than I expected to', '2020-03-28 20:20:14'),
(5, 3, 9, 'Yeah! I am once again asking for somebody to see this with me! Lovely! N-word!!!!', '2020-03-28 20:28:59'),
(6, 1, 16, 'another film added to the saoirse x timothée universe 💜🌷🍒🦋🌈🥺💗', '2020-03-28 20:34:40'),
(7, 1, 13, '\"my angel, flung out of space\" - corinthians 13:11', '2020-03-28 20:37:46'),
(8, 1, 10, 'cute and warm. it makes me feel like everything is gonna be okay in the end', '2020-03-28 20:39:20'),
(9, 4, 4, 'Christina Aguilera and I are friends no matter what the media makes up.', '2020-03-28 20:40:54');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(3) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'subscriber');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id` int(5) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id`, `name`) VALUES
(1, 'Movie viewing');

-- --------------------------------------------------------

--
-- Table structure for table `surveyanswer`
--

CREATE TABLE `surveyanswer` (
  `id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `survey_id` int(5) NOT NULL,
  `question_id` int(5) NOT NULL,
  `text` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surveyanswer`
--

INSERT INTO `surveyanswer` (`id`, `user_id`, `survey_id`, `question_id`, `text`) VALUES
(1, 5, 1, 1, 'Very often'),
(2, 5, 1, 2, 'THISSSSS');

-- --------------------------------------------------------

--
-- Table structure for table `survey_question_offeredanswer`
--

CREATE TABLE `survey_question_offeredanswer` (
  `survey_id` int(5) NOT NULL,
  `question_id` int(5) NOT NULL,
  `offeredAnswer_id` int(8) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `survey_question_offeredanswer`
--

INSERT INTO `survey_question_offeredanswer` (`survey_id`, `question_id`, `offeredAnswer_id`, `id`) VALUES
(1, 1, 1, 1),
(1, 1, 2, 2),
(1, 1, 3, 3),
(1, 2, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(60) NOT NULL,
  `role_id` int(3) NOT NULL DEFAULT 2,
  `active` bit(1) NOT NULL DEFAULT b'0',
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullName`, `username`, `password`, `email`, `role_id`, `active`, `dateCreated`) VALUES
(1, 'Teodora Nedeljkovic', 'teodora', 'ce256bd982b689e87529b15f85c5cf39', 'nedeljkovicteodora@gmail.com', 2, b'0', '2020-03-28 18:55:15'),
(2, 'The Rock', 'therock', 'f649698d64598626c5a26ee7c8a60a80', 'therock@hotmail.com', 2, b'0', '2020-03-28 19:32:39'),
(3, 'Bernie Sanders', 'bernies', 'cc8798b8034e004858b2781d42b82cf1', 'berniesanders@gmail.com', 2, b'0', '2020-03-28 19:35:38'),
(4, 'Britney Spears', 'britney', '680f48e43d5e17256edbb522eaf820cc', 'britneyspears@yahoo.com', 2, b'0', '2020-03-28 19:41:46'),
(5, 'Admin Admin', 'admin', '2e33a9b0b06aa0a01ede70995674ee23', 'nedeljkovicteodora3@gmail.com', 1, b'0', '2020-03-29 00:56:59');

-- --------------------------------------------------------

--
-- Table structure for table `userphoto`
--

CREATE TABLE `userphoto` (
  `id` int(12) NOT NULL,
  `user_id` int(11) NOT NULL,
  `src` varchar(110) NOT NULL,
  `alt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userphoto`
--

INSERT INTO `userphoto` (`id`, `user_id`, `src`, `alt`) VALUES
(1, 1, '1585423443author.jpg', 'teodora'),
(5, 5, '1585597732icon.png', 'admin'),
(6, 3, '1586429128Webp.net-resizeimage.jpg', 'bernies');

-- --------------------------------------------------------

--
-- Table structure for table `user_movie(watchlist)`
--

CREATE TABLE `user_movie(watchlist)` (
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_movie(watchlist)`
--

INSERT INTO `user_movie(watchlist)` (`user_id`, `movie_id`) VALUES
(1, 13),
(1, 15),
(4, 2),
(5, 1),
(5, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crew`
--
ALTER TABLE `crew`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crew_movieroles`
--
ALTER TABLE `crew_movieroles`
  ADD PRIMARY KEY (`crew_id`,`movieRoles_id`),
  ADD KEY `movieRoles_id` (`movieRoles_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movieroles`
--
ALTER TABLE `movieroles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_crew`
--
ALTER TABLE `movie_crew`
  ADD PRIMARY KEY (`crew_id`,`movie_id`),
  ADD KEY `movie_crew_ibfk_2` (`movie_id`);

--
-- Indexes for table `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD PRIMARY KEY (`movie_id`,`genre_id`),
  ADD KEY `movie_genre_ibfk_2` (`genre_id`);

--
-- Indexes for table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `offeredanswers`
--
ALTER TABLE `offeredanswers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`,`user_id`,`movie_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQ_userrole_name` (`name`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surveyanswer`
--
ALTER TABLE `surveyanswer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `survey_id` (`survey_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `survey_question_offeredanswer`
--
ALTER TABLE `survey_question_offeredanswer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offeredAnswer_id` (`offeredAnswer_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQ_user_username` (`username`),
  ADD UNIQUE KEY `UQ_user_email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `userphoto`
--
ALTER TABLE `userphoto`
  ADD PRIMARY KEY (`id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_movie(watchlist)`
--
ALTER TABLE `user_movie(watchlist)`
  ADD PRIMARY KEY (`user_id`,`movie_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crew`
--
ALTER TABLE `crew`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `movieroles`
--
ALTER TABLE `movieroles`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `navigation`
--
ALTER TABLE `navigation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `offeredanswers`
--
ALTER TABLE `offeredanswers`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `surveyanswer`
--
ALTER TABLE `surveyanswer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `survey_question_offeredanswer`
--
ALTER TABLE `survey_question_offeredanswer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `userphoto`
--
ALTER TABLE `userphoto`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crew_movieroles`
--
ALTER TABLE `crew_movieroles`
  ADD CONSTRAINT `crew_movieroles_ibfk_1` FOREIGN KEY (`movieRoles_id`) REFERENCES `movieroles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `crew_movieroles_ibfk_2` FOREIGN KEY (`crew_id`) REFERENCES `crew` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movie_crew`
--
ALTER TABLE `movie_crew`
  ADD CONSTRAINT `movie_crew_ibfk_1` FOREIGN KEY (`crew_id`) REFERENCES `crew` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movie_crew_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD CONSTRAINT `movie_genre_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movie_genre_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `navigation`
--
ALTER TABLE `navigation`
  ADD CONSTRAINT `navigation_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `navigation` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surveyanswer`
--
ALTER TABLE `surveyanswer`
  ADD CONSTRAINT `surveyanswer_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `surveyanswer_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `surveyanswer_ibfk_3` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `survey_question_offeredanswer`
--
ALTER TABLE `survey_question_offeredanswer`
  ADD CONSTRAINT `survey_question_offeredanswer_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `survey_question_offeredanswer_ibfk_2` FOREIGN KEY (`offeredAnswer_id`) REFERENCES `offeredanswers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `survey_question_offeredanswer_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Constraints for table `userphoto`
--
ALTER TABLE `userphoto`
  ADD CONSTRAINT `userphoto_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_movie(watchlist)`
--
ALTER TABLE `user_movie(watchlist)`
  ADD CONSTRAINT `user_movie(watchlist)_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_movie(watchlist)_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
