-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2024 at 11:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `be21_cr5_animal_adoption_chidi`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `size` enum('small','medium','large') NOT NULL,
  `age` int(11) DEFAULT NULL,
  `vaccinated` tinyint(1) DEFAULT 0,
  `breed` varchar(100) DEFAULT NULL,
  `availability` enum('Adopted','Available') DEFAULT 'Available',
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`id`, `name`, `location`, `description`, `size`, `age`, `vaccinated`, `breed`, `availability`, `picture`) VALUES
(3, 'Spike', '101 Pet Street', 'A friendly but shy hedgehog.', 'small', 3, 1, 'Hedgehog', '', 'https://cdn.pixabay.com/photo/2016/12/13/05/15/puppy-1903313_1280.jpg'),
(4, 'Nemo', '101 prater street', 'A small fish with a big eart', 'small', 1, 0, 'Goldfish', '', 'https://cdn.pixabay.com/photo/2018/02/15/09/12/underwater-3154726_1280.jpg'),
(5, 'Max', '707 Canine Crescent', 'A gentle and well-behaved dog', 'large', 9, 1, 'Great Dane', '', 'https://cdn.pixabay.com/photo/2023/07/22/05/50/wolf-8142720_1280.png'),
(6, 'Leo', '606 Feline Ave', 'An adventurous and independent cat', 'large', 13, 1, 'Bengal', '', 'https://cdn.pixabay.com/photo/2024/01/29/20/40/cat-8540772_1280.jpg'),
(7, 'Snappy', '101 pet street ', 'A curious and friendly turtle.', 'large', 20, 1, 'Turtle', '', 'https://cdn.pixabay.com/photo/2019/09/08/15/53/giant-tortoises-4461315_1280.jpg'),
(8, 'Polly', '101 Pet Street', 'A talkative and colorful parrot', 'small', 2, 0, 'Parrot', 'Adopted', 'https://cdn.pixabay.com/photo/2018/08/12/16/59/parrot-3601194_1280.jpg'),
(9, 'Coco', '101 pet Street', 'A loyal and protective dog', 'large', 6, 1, 'German Shepherd', '', 'https://cdn.pixabay.com/photo/2023/11/30/07/04/shetland-sheepdog-8420917_1280.jpg'),
(12, 'Buddy', '101 Pet Street', 'A friendly and energetic dog', 'medium', 3, 1, 'Labrador', '', 'https://cdn.pixabay.com/photo/2019/08/19/07/45/corgi-4415649_1280.jpg'),
(13, 'Whiskers', '101 Pet Street', 'A calm and loving cat.very friendly and welcoming.', 'small', 5, 1, 'Siamese', 'Available', 'https://cdn.pixabay.com/photo/2023/12/15/21/47/cat-8451431_1280.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `adoption_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_adoption`
--

INSERT INTO `pet_adoption` (`id`, `user_id`, `pet_id`, `adoption_date`) VALUES
(1, 4, 4, '2024-04-06'),
(2, 4, 5, '2024-04-06'),
(3, 3, 4, '2024-04-06'),
(6, 3, 12, '2024-04-06'),
(7, 3, 3, '2024-04-06'),
(8, 3, 7, '2024-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('adm','user') DEFAULT 'user',
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `picture`, `password`, `status`, `is_admin`) VALUES
(3, 'fabian', 'fab', 'fabian@yahoo.com', '01236548', 'hemdkd', '', '33f1ac9818eb1eb88c0156eada16bae1fc00fb98e89645aab3c084a86f66bc63', 'user', 0),
(4, 'ikenna', 'ubah', 'ikenna@yahoo.com', '01325847', 'prater45', '', '655228d4a174bd7bd6bf86c2a9371fd195684f3390f0c9859e3a99354dfb80c2', 'adm', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `animal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
