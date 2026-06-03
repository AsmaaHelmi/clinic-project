-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2026 at 01:44 PM
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
-- Database: `clinic_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(20) DEFAULT NULL,
  `status` enum('pending','approved','cancelled') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `phone` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `doctor_id`, `appointment_date`, `appointment_time`, `status`, `created_at`, `phone`) VALUES
(1, 83, 23, '2026-06-11', '11:00 AM', 'pending', '2026-06-01 11:37:34', 1021189843);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `major_id` int(11) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'doctor.jpg',
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `user_id`, `major_id`, `phone`, `image`, `description`) VALUES
(22, 58, 29, '+1 (604) 391-7121', NULL, 'Numquam est doloremq'),
(23, 59, 27, '+1 (431) 966-9519', NULL, 'Saepe velit anim te'),
(24, 61, 27, '+1 (403) 467-9334', NULL, 'Necessitatibus dolor'),
(26, 63, 28, '+1 (573) 515-9924', NULL, 'Officiis ullamco sit'),
(27, 64, 28, '+1 (156) 383-5224', NULL, 'Aute accusamus ad la'),
(33, 75, 26, '+1 (838) 253-7587', NULL, 'Excepteur duis et au'),
(36, 79, 28, '+1 (324) 766-5394', NULL, 'Facilis perspiciatis'),
(38, 81, 27, '+1 (934) 651-4606', NULL, 'Voluptas nisi est di'),
(39, 82, 31, '+1 (911) 427-9329', NULL, 'Rerum iusto deserunt');

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
   `image` varchar(255) DEFAULT 'major.jpg',
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `title`, `description`) VALUES
(26, 'Internal Medicine', 'تشخيص وعلاج الأمراض العامة للكبار مثل الضغط والسكر وأمراض الجهاز الهضمي.'),
(27, 'Dermatology', 'علاج أمراض الجلد والشعر والأظافر والحساسية الجلدية'),
(28, 'Cardiology', 'تشخيص وعلاج أمراض القلب والأوعية الدموية.'),
(29, 'Neurology', 'علاج أمراض المخ والأعصاب مثل الصداع والصرع.'),
(30, 'Clinical Nutrition', 'وضع أنظمة غذائية علاجية وتحسين العادات الغذائية.'),
(31, 'Chest & Allergy', 'علاج أمراض الجهاز التنفسي والحساسية والربو.'),
(32, 'Neurology', 'علاج أمراض المخ والأعصاب مثل الصداع والصرع'),
(43, 'Nicholas Lowery', 'Ipsum fugit rerum n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','doctor','patient') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'asmaa', 'asmaa1@gmail.com', '123456', 'admin'),
(2, 'salma', 'salma@gmail.com', '$2y$10$kicox1od8V4Dymi4nteMKO5ofhr4wNoFrI4hp/nF7bILYvDzLGigG', 'admin'),
(3, 'Mark William', 'tepawypy@mailinator.com', 'A123456', 'admin'),
(4, 'Keane Sweeney', 'kuqy@mailinator.com', '$2y$10$3iZReBxnEV2Z7xqtcaQ27e3AggHWrvxwado0hLuj3weRN.6tuOe4O', 'doctor'),
(5, 'Rhoda Vaughn', 'hofilobe@mailinator.com', '$2y$10$nhhXCNIBPh1ULL1sEHrdCelZaXFq5X0Vclu8jU10N6cI7x9824nlC', 'doctor'),
(6, 'Molly Reed', 'tanafob@mailinator.com', '$2y$10$46yYnAdSw.1fBN82/KoTXuAoLCpYt/OU2t.WdDXrbYq6OBw/j/.zu', 'doctor'),
(7, 'Irene Parrish', 'zocejolid@mailinator.com', '$2y$10$xm9BvW0Ki2jt53XmFbbYju3vY5bml.fClZHqu8SVEXVUpfEf2Xt9G', 'doctor'),
(8, 'Rashad Nichols', 'qyzy@mailinator.com', '$2y$10$qjF7P2KTDmmujtxterkmb.6qtzwsUZOrMoXtRx/CLDJ2FAG3/a8ri', 'doctor'),
(9, 'Zoe Tyler', 'hixis@mailinator.com', '$2y$10$9wIruv0VcZOc2FITi1minunD0eYCkPyrQXEhuC4NkUwPnF5ykmIIu', 'doctor'),
(10, 'Trevor Rocha', 'dukity@mailinator.com', '$2y$10$OLNuKbCljFMskS0vTuEQ0OIknvAm2NKsQq7wfN9iJGWoEHo7L0796', 'doctor'),
(11, 'Cally Gill', 'hafohecyp@mailinator.com', '$2y$10$DrUibCnI2aliqREWCh3tPOspbP16cgKpn3inEZizCN5gf9UC9wKDa', 'doctor'),
(12, 'Xantha Nichols', 'lyco@mailinator.com', '$2y$10$EXUZDdfzi93wkiwrdFybg.WUAC2PdWND4ymrEbs5ZqJTj2LexhlmC', 'doctor'),
(13, 'Steel Black', 'xirijucu@mailinator.com', '$2y$10$YVvGdyV6wjgFMkd4TMEbw.smGsWFpVq5O.jbKzDJpLx/T0wFIla6O', 'doctor'),
(14, 'Stella Bray', 'pusexexeqa@mailinator.com', '$2y$10$5kT.3a4.ThcBVcIrYp8I3.f8MBy1V02g6pWMsuSfVL8qv1Bje3I8O', 'doctor'),
(15, 'Avye Nixon', 'luryt@mailinator.com', '$2y$10$NPcOHzuv2nDP06/Eygk3hOZ8Bj8LExYNmxXSSRCcmHs.EO1DNxxCm', 'doctor'),
(16, 'Quin Schroeder', 'tisib@mailinator.com', '$2y$10$o9UnRTQ/rswQnb1lFVg2uOLsKZC0bDRbW47T9LseWbnNIYA1ExGC6', 'doctor'),
(17, 'Axel Daugherty', 'bunyposacu@mailinator.com', '$2y$10$Z8J1s9NDyw0WIiSvioa5JeAghSjTbBQ4H0kDTptb8QCQtIiorRwhy', 'doctor'),
(18, 'Stuart England', 'migelud@mailinator.com', '$2y$10$7M6tsyZGdSQnznCdeImg..Jqjr8LdVHwa8l49fphtvVFp77ZfLLii', 'doctor'),
(19, 'Hadassah Dillard', 'buzudohucy@mailinator.com', '$2y$10$gOENu7sN1DxfZ08NkZ2LzuzEnWBg.Jurlj/zNRunEHzYo6PmD7xv.', 'doctor'),
(20, 'Nolan Rodriquez', 'qyxev@mailinator.com', '$2y$10$RSCj8dGIntXdiTqnzWZKL.Wo6SYZTcjaSxHnVWeV0chbA/WxrjHfG', 'doctor'),
(21, 'Kamal Santos', 'relyted@mailinator.com', '$2y$10$ZtvI35cjkevHM2P4NqzeSeqKDku2ancIYKXT1DGp3k4A4mk5PJvT6', 'doctor'),
(22, 'Virginia Farmer', 'kiwiwub@mailinator.com', '$2y$10$nuMh7LQ6i4XrIv2Nd5KE3uwp6PaE7mFQoIHVrLk4xa.qHQHuvsQ5K', 'doctor'),
(23, 'Timon Lawson', 'dumojire@mailinator.com', '$2y$10$G2X6wJN9Oqd5aXIjV4qqcuGP4Hjeb6uigMpESRJokfcDYCDr7d1O6', 'doctor'),
(24, 'Victoria Lamb', 'kaxefohu@mailinator.com', '$2y$10$MIbXixTf1/Cb.gVuR2Ajpewpul5v0lZCUryeEfeg9Z8v1WPbgnqwe', 'doctor'),
(25, 'Stella Brady', 'mafowagan@mailinator.com', '$2y$10$5pmElb7KljzM98Ozv8eUXOOi2YnDGmY8pl8ZBRfloc/Q37rD/PtCS', 'doctor'),
(27, 'Fatima Harrell', 'xuhezetym@mailinator.com', '$2y$10$QrEt/8ZTY0MUG4L2EHI33.zn0P0ADs0YsPsdXbRt80xN/LS11DkAe', 'doctor'),
(28, 'Jonah Jacobson', 'gosuwanuzu@mailinator.com', '$2y$10$RWBD98Oy3cTc3ApTWGQiSeR8wsHa83Gma62Fwj7c1wocu3udGX5wa', 'doctor'),
(29, 'Ariana Delacruz', 'qarowive@mailinator.com', '$2y$10$GCRMfN9vLOumLb7z4e.MiOzBsBbDnOQ6kARGckGOUl2J4vj36I4b6', 'doctor'),
(31, 'Cole Shaffer', 'qeheju@mailinator.com', '$2y$10$8wqhw6UDhIGsByag3G8speCNfIu0hAl0cRUxAWgYZsMFSE/TP99vi', 'doctor'),
(32, 'Jessamine Giles', 'liqebatima@mailinator.com', '$2y$10$/PQn.yU0APzPMA5zX5V8gO76IXDQjv/c61zs5sPW/IPM1fOdyQ5F6', 'doctor'),
(33, 'Jaquelyn Barr', 'tucarad@mailinator.com', '$2y$10$EFnII7QJn/oL2X8Qq9I5LOwawio6.SnJavTR4J0IKfAoBKjIgrwNG', 'doctor'),
(34, 'Gloria Best', 'fuha@mailinator.com', '$2y$10$YrEiqRK6W9dh9daS4LAiyO6H2fo7/qZY4lbNO4uL/6KQQ472EAzRS', 'doctor'),
(35, 'Dai Alston', 'vasasi@mailinator.com', '$2y$10$J7dn0o0qtVOXf/Mkm7oU7u2.682aA8skaA3MUGvvwYecNJpYM5cb.', 'doctor'),
(36, 'Odysseus Stark', 'gehem@mailinator.com', '$2y$10$Y1uQIXrY1a1aUlsxQxJD0.IfjOY0VEGDurMrDFDU46LCBUXbzwFG.', 'doctor'),
(37, 'Shellie Walton', 'govogylyja@mailinator.com', '$2y$10$Q50tuArNEbDcfoYmatpFOerxi3LBgSVnWo27.H3UKyztj6D0yG/Y.', 'doctor'),
(38, 'Keegan Roach', 'danejy@mailinator.com', '$2y$10$yQo02wcuFWNQbHexY6Uwc.alGcqmfB50fF2YQ0GkRCX6ut1n6vwSC', 'doctor'),
(39, 'Justin Herring', 'gygagyxuka@mailinator.com', '$2y$10$esGoaKdoLuQ2IpkrFtTi4.sc.3B7bmCthSE.jS/KWmbRMbB104fzW', 'doctor'),
(40, 'Fiona Hoover', 'suciqa@mailinator.com', '$2y$10$kSMnQAseWMiIb1.7/WXso.j/Nw/pcFgXnR1RIOhd08OGGLaXVnnrG', 'doctor'),
(41, 'Devin Nieves', 'mywacyvam@mailinator.com', '$2y$10$YHP50.BY9n3R01COeVH8QurXwdbo3b7rG7LCLFJIuTRUDdskDXayG', 'doctor'),
(42, 'Xantha Fischer', 'nake@mailinator.com', '$2y$10$9SjmZ8rV4p.rgWeOiPGb6Oukf/yg0oSy50v8gUw23vApJlD8okHpm', 'patient'),
(43, 'Todd Ford', 'gara@mailinator.com', '$2y$10$SGKyjArKCWgUwdXFQ2/M.OJBsps.U/piqy4MHkJS6thMZdfmw9AxC', 'patient'),
(44, 'Ross Hinton', 'lihi@mailinator.com', '$2y$10$T3Xy4jlpwZBJBpz./cW8oumVLqvJ8Z8e/B0fj1QgZGAyDZuh1hySO', 'doctor'),
(45, 'Cedric Hill', 'maton@mailinator.com', '$2y$10$7TAofejB1730CBP1id8/MuqpHM9osRYtAtuRjUPKBIF.R6ACscGzG', 'doctor'),
(46, 'Rae Mays', 'domow@mailinator.com', '$2y$10$ppYkD2I5BAVhJ84CvLbv3uTqWhiD1JYKJeqLMe4YQ.HG.dmOLuE0y', 'doctor'),
(47, 'Ray Velez', 'byvul@mailinator.com', '$2y$10$hgiF2m33mmnvHehBgE0MHOILzvZct9xOqLLkRrr61Eukf0UgJQdoW', 'doctor'),
(53, 'Theodore Coffey', 'ducoxy@mailinator.com', '$2y$10$YARm9xxuhq63PtSMcVHS5eJe4kmYS6W.dMD3Kh3au0ufkm8C56hh2', 'doctor'),
(55, 'Reece Compton', 'cigijox@mailinator.com', '$2y$10$qk1H9ElNk/CK0sdmQkvquuY2/qljgkf6jOv4BywtGVPJwL3l.qBwa', 'doctor'),
(56, 'Rudyard Gutierrez', 'tanabo@mailinator.com', '$2y$10$4msIPQ0MQzaBvawvchGLH.EOayi6MGxjBAn40p45hIgnFY4KcqQvW', 'doctor'),
(57, 'Olympia Kline', 'giho@mailinator.com', '$2y$10$w52YlLBwsX7gdD0SggET6.uASXLS1wgDGr2pOo/MEVGeyLWtDgHRK', 'doctor'),
(58, 'lasamilile@mailinator.com', 'xipepeg@mailinator.com', '$2y$10$TelM1Ui97aUO7.T7y/9dzObbeEMvFV1WKDAFpolX9iYTiLwyqAIm6', 'doctor'),
(59, 'dejeta@mailinator.com', 'lofaze@mailinator.com', '$2y$10$xC.9H3vyne0IsFLXcUhhGu0iFHmdwuSmiI64W5jyNuf7yveAHD.ju', 'doctor'),
(60, 'Emi Colon', 'tigomedo@mailinator.com', '$2y$10$9iOADSp7fsvLYXO1bXiC/uXi3YNhXSN9TGN8QxnUR7DHg3j2AeScy', 'doctor'),
(61, 'Reuben Nelson', 'kyqaxisuci@mailinator.com', '$2y$10$lVRORhqO4kQYp0Vnwqr0PeuhfranPl3Ea6kIDUyHrya3omv5BW6hu', 'doctor'),
(63, 'Rebecca Robinson', 'mase@mailinator.com', '$2y$10$e.ZNdxltn/d.R6ZA.bgsfO.8n1B7qIHuQb.d9VkbBYwWZBL3kS8YO', 'doctor'),
(64, 'Heidi Patton', 'keqacu@mailinator.com', '$2y$10$vbT.oV1L.WWyY7XYc/iiq.uadyf14vIz/zkpWPMCCufyViLARarvS', 'doctor'),
(69, 'asmaa', 'asmaa@gmail.com', '123456', 'admin'),
(70, 'Asmaa Helmi', 'asmaa_helmi2@gmail.com', '$2y$10$2/xMbMHv8XQqp//u17PODO17wLhK9lpbuCjJC9tR.PIgAFXOsTZFe', 'patient'),
(71, 'Hillary Leach', 'kimasuv@mailinator.com', '$2y$10$W4bG2oKGIjq9wqiFlF8oUebqrNBt7Fx3G1m9iJ09fvr2ZolttlTby', 'patient'),
(73, 'Paki Macdonald', 'muwa@mailinator.com', '$2y$10$XZuletWO3HtINX7O29QtO.Yx1plrRh4gIoFGSF506B1dK7SgfLWbG', 'patient'),
(74, 'new', 'new@gmail.com', '$2y$10$x8sWL9joL.x78mZHsD/BZONEC01hL6tU.hF0pFFN9ddtOiarGDLaG', 'patient'),
(75, 'Kaden Herman', 'rifigyxyqu@mailinator.com', '$2y$10$ZIMMCV.aVxO83IFFqtOmJOeaY0kMBZQBrKynlAGL6qzvFoataWE5e', 'doctor'),
(77, 'test', 'test@gmail.com', '$2y$10$JXNJ8XsHg.vRVQ.93M/a5.R/sqg/0iUiGboVpcGWEdDXfKF9XAJxy', 'admin'),
(79, 'Daria Aguilar', 'ripore@mailinator.com', '$2y$10$xgRPyyXZyVEhKpAas4hRu.s21iFfX7NM70sIcyJ7xaeOoVLE/79m6', 'doctor'),
(81, 'Ruth Miller', 'domyw@mailinator.com', '$2y$10$1U7iGrKqi3EPYonDRweZOOwXaJlA8wY6kyNatN.Nprp/s8GLFmLoq', 'doctor'),
(82, 'Ivor Rivera', 'hifelizili@mailinator.com', '$2y$10$ThTnx612THjzQdBT23yIxuKooH3M/8tNGimY5dd9m6x6Fo8Rv0ICq', 'doctor'),
(83, 'patient', 'patient@gmail.com', '$2y$10$n7uP9f7j2BHLX9SbE0oTruf3QMVkZmAyG4i3BCLWocf6yVjy/nwBW', 'patient');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_appointment_patient` (`patient_id`),
  ADD KEY `fk_appointment_doctor` (`doctor_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_doctor_user` (`user_id`),
  ADD KEY `fk_doctor_major` (`major_id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_appointment_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_appointment_patient` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `fk_doctor_major` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_doctor_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
