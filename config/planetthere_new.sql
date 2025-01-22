-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2025 at 01:39 PM
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
-- Database: `planetthere_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `blocker_id` int(11) NOT NULL,
  `blocked_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`blocker_id`, `blocked_id`) VALUES
(3, 9),
(3, 11),
(3, 14),
(4, 3),
(4, 6),
(6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`) VALUES
(3, 'Arts & Culture'),
(8, 'Community & Charity'),
(4, 'Conferences & Seminars'),
(10, 'Family & Kids'),
(15, 'Fashion & Lifestyle'),
(5, 'Festivals & Fairs'),
(7, 'Food & Drink Events'),
(13, 'Gaming & Esports'),
(12, 'Health & Wellness'),
(14, 'Movies & Screenings'),
(1, 'Music & Concerts'),
(2, 'Sports & Fitness'),
(9, 'Tech & Innovation'),
(11, 'Travel & Adventure'),
(6, 'Workshops & Classes');

-- --------------------------------------------------------

--
-- Table structure for table `category_event`
--

CREATE TABLE `category_event` (
  `CategoryID` int(11) NOT NULL,
  `EventID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `EventID` int(11) NOT NULL,
  `EventName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Description` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Frequency` int(11) DEFAULT NULL,
  `MaxParticipants` int(11) DEFAULT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `AvailablePlaces` int(11) DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT 1,
  `EventManagerID` int(11) NOT NULL,
  `LocationName` varchar(255) DEFAULT NULL,
  `LocationAddress` varchar(255) DEFAULT NULL,
  `LocationCapacity` int(11) DEFAULT NULL,
  `RepeatUntil` date DEFAULT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `CategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `EventName`, `Description`, `Frequency`, `MaxParticipants`, `StartDate`, `EndDate`, `AvailablePlaces`, `IsActive`, `EventManagerID`, `LocationName`, `LocationAddress`, `LocationCapacity`, `RepeatUntil`, `image1`, `image2`, `CategoryID`) VALUES
(5, 'Art Exhibition', 'The City Art Gallery is proud to host an exclusive one-day art exhibition showcasing a curated collection of contemporary artists from both local and international backgrounds. Visitors will have the opportunity to experience thought-provoking paintings, sculptures, and mixed media installations. In addition to the art, there will be live music performances and a wine tasting in the gallery\'s outdoor space. This event aims to promote the creative spirit and connect artists with collectors and art lovers alike. Come explore the intersections of modern art and culture.', 0, 100, '2025-01-15 10:00:00', '2025-01-15 17:00:00', NULL, 1, 3, 'City Art Gallery', '123 Main St, Downtown', 100, '0000-00-00', '/uploads/events/event_6761a93fc2aee.jpg', '/uploads/events/event_6761a93fc2e7c.jpg', 3),
(6, 'Tech Conference', 'The Tech Conference is one of the largest annual gatherings of technology professionals, entrepreneurs, and innovators. The event will feature keynote speeches from industry leaders, technical workshops, and panel discussions covering the latest trends in artificial intelligence, cloud computing, blockchain, and cybersecurity. Attendees will also have the chance to network with thought leaders, explore emerging technologies in the exhibitor hall, and learn how they can leverage cutting-edge tools and platforms to advance their careers or businesses. Whether you\'re a tech enthusiast or a seasoned professional, this conference offers invaluable insights and opportunities.', 0, 500, '2025-02-20 09:00:00', '2025-02-20 18:00:00', NULL, 1, 4, 'Downtown Conference Center', '456 Tech Ave, Silicon City', 500, '0000-00-00', '/uploads/events/event_6761ce6fa335e.jpg', '/uploads/events/event_6761ce6fa39ac.jpg', 9),
(7, 'Charity Run', 'Lace up your sneakers and join the Charity Run in Central Park, where participants will run, jog, or walk to raise funds for local hospitals and medical research. The event includes a 5K, 10K, and a special family-friendly 1K route, ensuring that everyone can participate regardless of fitness level. All proceeds from the event will be donated to support healthcare initiatives in the community, including improving patient care and funding medical research. Post-race festivities will include live music, food trucks, and a celebration of the impact that our collective efforts can have on improving health and wellbeing.', 0, 2000, '2025-06-01 07:00:00', '2025-06-01 00:00:00', NULL, 1, 4, 'Central Park', '101 Central Ave, Metropolis', 2000, '0000-00-00', '/uploads/events/event_6761d0795e780.jpeg', '/uploads/events/event_6761d0795ea2f.jpg', 8),
(8, 'Cooking Class', 'Explore the delicious world of Italian cuisine in this hands-on cooking class, led by an expert chef with over 20 years of experience. In this interactive workshop, you’ll learn how to make classic Italian dishes such as fresh pasta, risotto, and tiramisu. The session will cover key culinary techniques, including knife skills, sauce preparation, and plating, and you’ll get to enjoy your creations at the end of the class. Whether you\'re a beginner or an experienced home cook, this class is the perfect opportunity to improve your cooking skills and immerse yourself in the flavors of Italy.', 0, 30, '2025-03-15 15:00:00', '2025-03-15 18:00:00', NULL, 1, 4, 'Culinary School', '234 Chef St, Cooktown', 30, '0000-00-00', '/uploads/events/event_6761d2416ce03.jpg', '/uploads/events/event_6761d2416d06b.jpg', 6),
(9, 'Music Festival', 'Join us for a three-day celebration of music, culture, and community at the Riverside Park Music Festival! Featuring a diverse lineup of international and local musicians, the festival will showcase performances across multiple stages, ranging from indie rock to electronic dance music. Between shows, festival-goers can enjoy local food trucks, artisan markets, and outdoor activities like yoga classes and dance workshops. There will also be a family-friendly zone with interactive performances for children. Whether you\'re a music lover or looking to relax in nature, this festival is the perfect escape to kick off the summer season.', 0, 3000, '2025-05-10 17:00:00', '2025-05-10 23:00:00', NULL, 0, 4, 'Riverside Park', '789 Riverside Dr, Lakeview', 3000, '0000-00-00', '/uploads/events/event_6761d30ed688b.jpg', '/uploads/events/event_6761d30ed6b94.jpg', 3),
(11, 'Business Networking Meetup', 'The Business Networking Meetup is a dynamic event that brings together entrepreneurs, professionals, and business owners from various industries. This event aims to foster new connections, share business strategies, and explore potential collaborations. Attendees will have the chance to network in a relaxed atmosphere, exchange ideas, and attend short presentations on topics such as branding, digital marketing, and scaling businesses. If you’re looking to expand your professional network, gain insights into growing your business, or simply connect with like-minded professionals, this is the perfect event for you. and for your friends', 0, 200, '2025-04-10 17:30:00', '2025-04-10 20:00:00', NULL, 1, 6, 'Downtown Business Hub', '567 Corporate Blvd, Business City', 200, '0000-00-00', '/uploads/events/event_6761d73a1eac9.jpg', '/uploads/events/event_6761d73a1edab.jpg', 4),
(12, 'Yoga Retreat', 'Escape the hustle and bustle of everyday life and immerse yourself in the tranquil surroundings of the Mountain Retreat Center for a rejuvenating yoga retreat. This three-day retreat will focus on yoga, meditation, and mindfulness, offering classes for all levels, from beginners to experienced practitioners. The retreat will include daily yoga sessions, guided meditation, nature walks, and wholesome, locally-sourced meals. In addition, you\'ll have time for relaxation, personal reflection, and group discussions on mindfulness and wellness practices. Whether you\'re looking to deepen your yoga practice or simply take a break from your busy life, this retreat offers the perfect balance of relaxation and growth.', 0, 50, '2025-07-01 09:00:00', '2025-07-03 18:00:00', NULL, 1, 6, 'Mountain Retreat Center', '101 Mountain Rd, Hilltop Village', 50, '0000-00-00', '/uploads/events/event_6761d7fb6f65f.jpg', '/uploads/events/event_6761d7fb6f8aa.jpg', 12),
(13, 'International Film Festival', 'The International Film Festival brings together filmmakers from around the world to showcase their latest works. Over three days, the festival will screen a selection of international films, including documentaries, feature films, and shorts. Attendees can enjoy screenings, panel discussions, and networking opportunities with filmmakers, actors, and industry professionals. Don\'t miss the chance to experience global cinema at its finest.', 0, 200, '2025-07-10 18:00:00', '2025-07-12 23:00:00', NULL, 1, 6, 'City Theatre', '123 Cinema St, Downtown', 200, NULL, '/uploads/events/event_6761dde09be83.jpg', '/uploads/events/event_6761dde09c0b0.jpg', 3),
(14, 'Monthly Fitness Bootcamp', 'Join our Monthly Fitness Bootcamp, designed to push your limits and improve your strength, stamina, and overall fitness! Every month, we gather at the City Park Gym for a 2-hour high-intensity workout session. Whether you\'re a beginner or an experienced fitness enthusiast, each session is tailored to help you achieve your fitness goals. With a variety of exercises including strength training, cardio, and flexibility, this bootcamp is perfect for those looking to get fit and stay motivated. Sign up today and commit to your fitness journey for the next four months!', 30, 50, '2025-01-15 08:00:00', '2025-01-15 10:00:00', NULL, 1, 6, 'City Park Gym', '123 Workout Lane, Fit Town', 50, '2025-05-15', '/uploads/events/event_6761ded5d074f.jpg', '/uploads/events/event_6761ded5d0baf.jpg', 2),
(15, 'Monthly Fitness Bootcamp', 'Join our Monthly Fitness Bootcamp, designed to push your limits and improve your strength, stamina, and overall fitness! Every month, we gather at the City Park Gym for a 2-hour high-intensity workout session. Whether you\'re a beginner or an experienced fitness enthusiast, each session is tailored to help you achieve your fitness goals. With a variety of exercises including strength training, cardio, and flexibility, this bootcamp is perfect for those looking to get fit and stay motivated. Sign up today and commit to your fitness journey for the next four months!', 30, 50, '2025-02-14 08:00:00', '2025-02-14 10:00:00', NULL, 1, 6, 'City Park Gym', '123 Workout Lane, Fit Town', 50, '2025-05-15', '/uploads/events/event_6761ded5d074f.jpg', '/uploads/events/event_6761ded5d0baf.jpg', 2),
(17, 'Monthly Fitness Bootcamp', 'Join our Monthly Fitness Bootcamp, designed to push your limits and improve your strength, stamina, and overall fitness! Every month, we gather at the City Park Gym for a 2-hour high-intensity workout session. Whether you\'re a beginner or an experienced fitness enthusiast, each session is tailored to help you achieve your fitness goals. With a variety of exercises including strength training, cardio, and flexibility, this bootcamp is perfect for those looking to get fit and stay motivated. Sign up today and commit to your fitness journey for the next four months!', 30, 50, '2025-04-15 08:00:00', '2025-04-15 10:00:00', NULL, 1, 6, 'City Park Gym', '123 Workout Lane, Fit Town', 50, '2025-05-15', '/uploads/events/event_6761ded5d074f.jpg', '/uploads/events/event_6761ded5d0baf.jpg', 2),
(18, 'Innovators\' Hackathon 2025', 'Join the Innovators\' Hackathon 2025, where developers, designers, and tech enthusiasts come\r\n together to create cutting-edge solutions for real-world challenges. This two-day event will feature\r\n  exciting coding competitions, mentorship from industry leaders, and workshops on emerging technologies\r\n   like AI, IoT, and blockchain. Participants will work in teams to build innovative projects and compete\r\n    for cash prizes and recognition. Whether you\'re a seasoned programmer or a newcomer, this event is a\r\n	 great opportunity to learn, collaborate, and showcase your skills. Don’t miss this chance to be part of the future of tech!', 0, 300, '2025-08-15 09:00:00', '2025-08-16 18:00:00', NULL, 1, 17, 'Tech Nexus Lab', '101 Innovation Way, Tech City', 300, NULL, '/uploads/events/event_6762f079cbf92.jpg', '/uploads/events/event_6762f079cc276.jpg', 9);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `FaqID` int(11) NOT NULL,
  `Question` text NOT NULL,
  `Answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`FaqID`, `Question`, `Answer`) VALUES
(2, 'What is PlanetThere?', 'PlanetThere is an event management platform that allows users to create, promote, and participate in various events. Whether you\'re an event planner or an attendee, PlanetThere simplifies the process and enhances your event experience.'),
(3, 'How do I create an account?', 'Creating an account on PlanetThere is simple and quick. Click on the \"Sign Up\" button located at the top right corner of the website. Have your email address at hand because you will need it to finalize the sing up process.'),
(4, 'How do I create my own event?', 'To create your own event on PlanetThere, log in to your account and navigate to the \"Create Event\" section. Fill in the event details such as title, description, date, time, location, and any other relevant information. Once you\'ve entered all the details, click \"Publish\" to make your event live and start promoting it to potential attendees.'),
(5, 'How does PlanetThere ensure event quality?', 'PlanetThere is committed to maintaining high-quality events on its platform. We implement a thorough vetting process for all event organizers, ensuring they meet our standards. Additionally, we provide tools and resources to help organizers create engaging and well-managed events. Our support team actively monitors events and user feedback to address any issues promptly. By fostering a community of responsible organizers and attentive users, PlanetThere ensures a positive and enriching event experience for everyone.');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `follower_id` int(11) NOT NULL,
  `followed_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`follower_id`, `followed_id`) VALUES
(3, 4),
(3, 6),
(3, 8),
(3, 12),
(3, 13),
(3, 14),
(4, 3),
(4, 6),
(6, 4),
(6, 5),
(6, 12),
(8, 3),
(8, 4),
(8, 5),
(8, 6),
(8, 7),
(9, 3),
(9, 4),
(9, 5),
(9, 6),
(10, 3),
(10, 4),
(10, 5),
(10, 6),
(11, 3),
(11, 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `reset_token` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token_expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `UserID` int(11) NOT NULL,
  `EventID` int(11) NOT NULL,
  `RegistrationDate` datetime NOT NULL DEFAULT current_timestamp(),
  `RegistrationID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`UserID`, `EventID`, `RegistrationDate`, `RegistrationID`, `Quantity`) VALUES
(3, 7, '2024-12-18 00:12:14', 1, 1),
(3, 9, '2024-12-18 14:15:30', 2, 1),
(3, 12, '2024-12-18 17:11:38', 3, 1),
(6, 6, '2024-12-18 00:09:22', 4, 1),
(3, 8, '2025-01-09 15:08:32', 10, 29),
(5, 8, '2025-01-09 15:28:12', 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `Score` int(11) DEFAULT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Comment` text DEFAULT NULL,
  `EventID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tac`
--

CREATE TABLE `tac` (
  `tacID` int(11) NOT NULL,
  `conditionT` text NOT NULL,
  `detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tac`
--

INSERT INTO `tac` (`tacID`, `conditionT`, `detail`) VALUES
(2, 'Acceptance of Terms', 'By accessing and using PlanetThere, you agree to comply with these Terms and Conditions. If you disagree with these terms, you must refrain from using the platform.\r\n\r\n'),
(3, 'Account Creation and Platform Usage', 'Users must create an account with accurate and up-to-date information to access certain features. The platform is designed for event planners and attendees to manage and participate in events, including a waitlist feature for events with limited spots (placement on the waitlist does not guarantee participation).'),
(4, 'Responsibilities of Users', 'Event Planners: Must ensure the accuracy of their event information and refrain from uploading content that violates laws or infringes on third-party rights. PlanetThere reserves the right to approve, deny, or remove events that violate our policies or guidelines.\n\nAttendees: Should register for events responsibly, adhere to event-specific rules, and may cancel their participation within specified time limits.'),
(5, 'User Conduct and Administrative Rights', 'Users must behave respectfully towards others. Any abuse, harassment, or violation of rules may result in account suspension or termination. PlanetThere administrators have the authority to monitor activity, remove content, and take necessary actions to maintain the platform\'s integrity.'),
(6, 'Privacy Policy', 'Users are encouraged to review the Privacy Policy and acknowledge that data provided during registration and use may be stored and processed for operational purposes.'),
(7, 'Disclaimer of Liability', 'PlanetThere disclaims all liability for event-related disputes, technical issues, or user misconduct.'),
(8, 'Contact Information', 'For any queries or concerns, please contact our support team.'),
(9, 'Legal Notice', 'All content and services provided on PlanetThere are the intellectual property of PlanetThere, unless otherwise noted. Unauthorized reproduction, distribution, or use of any content without explicit permission is strictly prohibited. PlanetThere reserves the right to take legal action against any unauthorized use or infringement.');


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `IsAdmin` tinyint(1) DEFAULT 0,
  `IsBanned` tinyint(1) DEFAULT 0,
  `PasswordHash` varchar(255) NOT NULL,
  `ProfileImage` varchar(255) DEFAULT NULL,
  `phonePublic` tinyint(1) DEFAULT 1,
  `dobPublic` tinyint(1) DEFAULT 1,
  `reset_token` varchar(255) NOT NULL,
  `token_expiry` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `FirstName`, `LastName`, `Phone`, `DateOfBirth`, `Email`, `IsAdmin`, `IsBanned`, `PasswordHash`, `ProfileImage`, `phonePublic`, `dobPublic`, `reset_token`, `token_expiry`) VALUES
(3, 'CCD', 'Mehdi', 'BOUCHENE', '0778841040', '2003-12-12', 'lm_bouchene@esi.dz', 0, 0, '$2y$10$M/8WuAg59L44D/LoLHuLke4zMHb21D8uAfl.1tgrx1LiihVOI3742', '/uploads/users/user_67617930c6eb6.jpg', 0, 0, '', '0000-00-00 00:00:00'),
(4, 'KamKam', 'Kamel', 'BOUCHERBA', '0758018224', '1993-12-12', 'kamel.boucherba92@gmail.com', 0, 0, '$2y$10$v2GRY42DgFOO908sdEAqIeg9Z7cf6UXTcDCNIR3L55pJ/i8HScBnm', '/uploads/users/user_67617f236efcd.jpg', 1, 1, '', '2024-12-19 14:11:12'),
(5, 'DOMINIK', 'The Strong', 'Dominik', '0758018224', '2002-12-23', 'mehdi.bouchene@eleve.isep.fr', 0, 0, '$2y$10$KaTfgHmEhTqVYdwBKD4JceLlKjH9ztGHkjh2ETf/MyNFO1vgRnfU6', '/uploads/users/user_676185966d2b9.jpg', 1, 1, '', '2024-12-19 14:11:12'),
(6, 'Kasper', 'The polish', 'Kasper', '0778234918', '2003-12-09', 'contact@esi.dz', 1, 0, '$2y$10$gRl8cpyF4APLDUnQN9g8gOGaTruM0t5nHK/3v0ai4wYIIAgq8/XXK', '/uploads/users/user_6761865e2d706.png', 1, 1, '', '2024-12-19 14:11:12'),
(7, 'EventLover200', 'Lyna', 'Sarah', '0231231242', '2000-12-04', 'mehdibouchene03@gmail.com', 0, 0, '$2y$10$Gb4YbVQSJcsfo8HWKYYd4u3c9DMoS4QdRUewOPrM9emnDvTyuL5XO', '/uploads/users/user_67618721870e3.jpg', 1, 1, '', '2024-12-19 14:11:12'),
(8, 'MonicaPeace', 'Anne', 'Sandra', '0312412412', '2000-12-21', 'thePeaceLover@gmail.com', 0, 0, '$2y$10$rOly6fHezBR1TRxuc/pCxOVogJDu2NukiRFOCC.yGixOw8RThilim', '/uploads/users/user_676188cf4d0e1.jpg', 1, 1, '', '2024-12-19 14:11:12'),
(9, 'Ania', 'Natalie', 'Peace', '0239391429', '2001-09-12', 'ILoveEvents@gmail.com', 0, 0, '$2y$10$omOJAWTCZNxw5K2Mxzy3.Oy/W9omg7wjDZg4DbGnV29UUONCRO1Ve', '/uploads/users/user_6761899e9419b.jpg', 1, 1, '', '2024-12-19 14:11:12'),
(10, 'Nassim', 'Allaoua', 'nassim', '0758012321', '2003-05-15', 'nassimallaoua@gmail.com', 0, 0, '$2y$10$ykoFDh8npngHK6mX/d6IR.oZ.Kgb1WkJ86yyizv8SP5Y8rRtI.4sC', '/uploads/users/user_67618ae07f636.jpg', 1, 1, '', '2024-12-19 14:11:12'),
(11, 'Zecqcqcqcqcquie', 'Zakaria', 'Bouterfa', '0239392321', '2005-02-05', 'zakibouterfa@gmail.com', 0, 0, '$2y$10$PmqThFggFx2NwUfCFTn8UOV4nJ8F8fBweS.miv99LblDmvRHkm22m', '/uploads/users/user_67618d50f3a92.jpg', 1, 1, '', '2024-12-19 14:11:12'),
(12, 'Siney', 'Yanis', 'Chadouli', '0758018221', '2002-08-04', 'yanischadouli@gmail.com', 0, 0, '$2y$10$gy1oY9DXly/vXo/GsdWdEu6wIJ6elICYyLHNBVwDSbUesVktx/7oa', '/uploads/users/user_67618e1e305b0.jpg', 1, 1, '', '2024-12-19 14:11:12'),
(13, 'keikeito', 'Tarek', 'Chettouh', '0212321231', '2004-12-01', 'tarekchetouh@gmail.com', 0, 1, '$2y$10$gOf7JzD9FIVzrcLGRAtjxusEEk7OaZXeOMifhwtIcax72ZG/Xhrha', '/uploads/users/user_67618e7dd81d8.jpg', 1, 1, '', '2024-12-19 14:11:12'),
(14, 'BatnaMan', 'Anis', 'Laoubi', '0762866985', '2001-08-06', 'anislaoubi@gmail.com', 0, 0, '$2y$10$yy.NGSApQjoh7FjOpT6SDO5D1jEYn7BnP3u9ca58sh0qDxupg1qX2', '/uploads/users/user_67618ec9b94bc.jpg', 1, 1, '', '2024-12-19 14:11:12'),
(15, 'tsobal', 'Racim', 'Tobal', '0762862315', '2002-03-02', 'racimtobal@gmail.com', 0, 0, '$2y$10$AyvCO5yAZOXgU2u4TtmmLe5xLdu8neTGSK29HfsEjoEqa6ooGpKfm', '/uploads/users/user_67618fc2e1909.jpg', 1, 1, '', '2024-12-19 14:11:12'),
(16, 'EazyYellow', 'Jaune', 'Amine', '0762866904', '2005-12-09', 'amine@gmail.com', 0, 0, '$2y$10$OvL.Bg1LJfcxCamR7AZxO.0lecDmQUz.aIF99oFZUtcGPWuZmRSKy', '/uploads/users/user_67619014734dc.jpg', 1, 1, '', '2024-12-19 14:11:12'),
(17, 'ClientPres', 'wda', 'dwad', '0778841040', '2003-12-12', 'client@gmail.com', 0, 0, '$2y$10$MyFv.vvB8pJ9s46MlD9q9en6.UFr4S3SS4kD55NdD2vMH9jmgn/Q.', '/uploads/users/user_6762efa5a7540.jpg', 1, 1, '', '2024-12-19 14:11:12');

-- --------------------------------------------------------

--
-- Table structure for table `waitlisting`
--

CREATE TABLE `waitlisting` (
  `WaitlistingDate` date NOT NULL,
  `UserID` int(11) NOT NULL,
  `EventID` int(11) NOT NULL,
  `waitlisting` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `waitlisting`
--

INSERT INTO `waitlisting` (`WaitlistingDate`, `UserID`, `EventID`, `waitlisting`) VALUES
('0000-00-00', 6, 8, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`blocker_id`,`blocked_id`),
  ADD KEY `blocked_id` (`blocked_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`),
  ADD KEY `CategoryName` (`CategoryName`);

--
-- Indexes for table `category_event`
--
ALTER TABLE `category_event`
  ADD PRIMARY KEY (`CategoryID`,`EventID`),
  ADD KEY `EventID` (`EventID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`),
  ADD KEY `EventManagerID` (`EventManagerID`),
  ADD KEY `fk_category` (`CategoryID`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`FaqID`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`follower_id`,`followed_id`),
  ADD KEY `followed_id` (`followed_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`reset_token`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`RegistrationID`),
  ADD KEY `fk_userid` (`UserID`),
  ADD KEY `fk_eventid` (`EventID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`UserID`,`EventID`),
  ADD KEY `EventID` (`EventID`);

--
-- Indexes for table `tac`
--
ALTER TABLE `tac`
  ADD PRIMARY KEY (`tacID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `Username` (`Username`),
  ADD KEY `Email` (`Email`);

--
-- Indexes for table `waitlisting`
--
ALTER TABLE `waitlisting`
  ADD PRIMARY KEY (`waitlisting`),
  ADD KEY `fk_userid_waitlist` (`UserID`),
  ADD KEY `fk_eventid_waitlist` (`EventID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `FaqID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `RegistrationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tac`
--
ALTER TABLE `tac`
  MODIFY `tacID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `waitlisting`
--
ALTER TABLE `waitlisting`
  MODIFY `waitlisting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blocks`
--
ALTER TABLE `blocks`
  ADD CONSTRAINT `blocks_ibfk_1` FOREIGN KEY (`blocker_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `blocks_ibfk_2` FOREIGN KEY (`blocked_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `category_event`
--
ALTER TABLE `category_event`
  ADD CONSTRAINT `category_event_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_event_ibfk_2` FOREIGN KEY (`EventID`) REFERENCES `events` (`EventID`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`EventManagerID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`followed_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `fk_eventid` FOREIGN KEY (`EventID`) REFERENCES `events` (`EventID`),
  ADD CONSTRAINT `fk_userid` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `registrations_ibfk_2` FOREIGN KEY (`EventID`) REFERENCES `events` (`EventID`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `events` (`EventID`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `waitlisting`
--
ALTER TABLE `waitlisting`
  ADD CONSTRAINT `fk_eventid_waitlist` FOREIGN KEY (`EventID`) REFERENCES `events` (`EventID`),
  ADD CONSTRAINT `fk_userid_waitlist` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `waitlisting_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `waitlisting_ibfk_2` FOREIGN KEY (`EventID`) REFERENCES `events` (`EventID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
