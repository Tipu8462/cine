-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2017 at 10:40 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `balaka`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`admin_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `contact_no` int(15) NOT NULL,
  `hall_name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`, `contact_no`, `hall_name`) VALUES
(1, 'tipu10@gmail.com', '1234', 0, ''),
(2, 'pksaha@gmail.com', '7410', 1816053415, 'Modhumoti');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `product_id` int(11) NOT NULL,
  `ip_add` varchar(1024) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(10, '2D'),
(16, '3D');

-- --------------------------------------------------------

--
-- Table structure for table `categories2`
--

CREATE TABLE IF NOT EXISTS `categories2` (
`category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories2`
--

INSERT INTO `categories2` (`category_id`, `category_name`) VALUES
(8, '2D'),
(11, '3D');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
`customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_contact_no` varchar(255) NOT NULL,
  `customer_city` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_image` varchar(255) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_password`, `customer_email`, `customer_contact_no`, `customer_city`, `customer_address`, `customer_image`, `ip_add`, `date`) VALUES
(22, 'PK Saha', '315131004', 'pksaha420@gmail.com', '01816053415', 'Dubai', 'Daudkandi        ', '1496825903 photo0040.jpg', '::1', '2017-06-07 08:58:23'),
(23, 'rbtn', '1234', 'trygyrt@gmail.com', '258874', 'Narayanganj', '        jygytfy', '1497513368 Chrysanthemum.jpg', '::1', '2017-06-15 07:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders`
--

CREATE TABLE IF NOT EXISTS `customer_orders` (
`order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `due_amount` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_orders`
--

INSERT INTO `customer_orders` (`order_id`, `customer_id`, `due_amount`, `invoice_no`, `total_products`, `order_date`, `order_status`) VALUES
(1, 19, '0', '591692981', '0', '2017-05-27 12:39:42', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `customer_payment`
--

CREATE TABLE IF NOT EXISTS `customer_payment` (
`payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_no` text NOT NULL,
  `amount_paid` text NOT NULL,
  `source` text NOT NULL,
  `transition_id` text NOT NULL,
  `pass_code` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
`movie_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `quality_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `movie_name` varchar(255) NOT NULL,
  `movie_cast` varchar(200) NOT NULL,
  `movie_director` varchar(220) NOT NULL,
  `movie_img1` varchar(255) NOT NULL,
  `movie_img2` varchar(255) NOT NULL,
  `movie_img3` varchar(255) NOT NULL,
  `movie_trailer` mediumtext NOT NULL,
  `movie_desc` text NOT NULL,
  `movie_date` date NOT NULL,
  `movie_time` varchar(6) NOT NULL,
  `movie_keyword` varchar(255) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `category_id`, `quality_id`, `date`, `movie_name`, `movie_cast`, `movie_director`, `movie_img1`, `movie_img2`, `movie_img3`, `movie_trailer`, `movie_desc`, `movie_date`, `movie_time`, `movie_keyword`, `status`) VALUES
(17, 16, 5, '2017-06-06 06:01:49', 'Fast and Furious 8', 'Vin Diesel, Dwayne Johnson, Jason Statham', 'F. Gary Gray', '1496728909_fast-and-furious-.jpg', '1496728909_fast-and-furious-8.jpg', '1496728909_fast-and-furious-8.jpg', '', '<p><em><strong>The Fate of the Furious</strong></em> (alternatively known as <em><strong>Fast &amp; Furious 8</strong></em> and <em><strong>Fast 8</strong></em>, and often stylized as <em><strong>F8</strong></em>) is a 2017 American <a title="Action film" href="https://en.wikipedia.org/wiki/Action_film">action film</a> directed by <a title="F. Gary Gray" href="https://en.wikipedia.org/wiki/F._Gary_Gray">F. Gary Gray</a> and written by <a title="Chris Morgan (writer)" href="https://en.wikipedia.org/wiki/Chris_Morgan_%28writer%29">Chris Morgan</a>.</p>', '0000-00-00', '00:00:', 'Fast, Furious', 'on'),
(18, 16, 4, '2017-06-06 06:13:08', 'Rings', ' Matilda Lutz, Alex Roe, Johnny Galecki', 'F. Javier Gutierrez', '1496729588_maxresdefault-1.jpg', '1496729588_images.jpg', '1496729588_images.jpg', '', '<p><em><strong>Rings</strong></em> is a 2017 American <a title="Supernatural" href="https://en.wikipedia.org/wiki/Supernatural">supernatural</a> <a title="Psychological horror" href="https://en.wikipedia.org/wiki/Psychological_horror">psychological horror film</a> directed by <a title="F. Javier Guti&eacute;rrez" href="https://en.wikipedia.org/wiki/F._Javier_Guti%C3%A9rrez">F. Javier Guti&eacute;rrez</a>, written by <a title="David Loucka" href="https://en.wikipedia.org/wiki/David_Loucka">David Loucka</a>, <a title="Jacob Aaron Estes" href="https://en.wikipedia.org/wiki/Jacob_Aaron_Estes">Jacob Aaron Estes</a> and <a title="Akiva Goldsman" href="https://en.wikipedia.org/wiki/Akiva_Goldsman">Akiva Goldsman</a></p>', '0000-00-00', '00:00:', 'Rings', 'on'),
(19, 10, 4, '2017-06-06 06:25:32', 'Guardian of the Galaxy 2', 'Chris Pratt, Zoe Saldana, Dave Bautista, Vin Diesel', ' 	James Gunn', '1496730332_4327607-hulk_and_the_guardians_of_the_galaxy___movie_by_worldbreakerhulk-d8ccbya.jpg', '1496730332_guardians-of-the-galaxy-vol-2-.jpg', '1496730332_guardians-of-the-galaxy-vol-2-.jpg', '', '<p><em><strong>Guardians of the Galaxy Vol. 2</strong></em> is a 2017 American <a title="Superhero film" href="https://en.wikipedia.org/wiki/Superhero_film">superhero film</a> based on the <a title="Marvel Comics" href="https://en.wikipedia.org/wiki/Marvel_Comics">Marvel Comics</a> superhero team <a title="Guardians of the Galaxy (2008 team)" href="https://en.wikipedia.org/wiki/Guardians_of_the_Galaxy_%282008_team%29">Guardians of the Galaxy</a>, produced by <a title="Marvel Studios" href="https://en.wikipedia.org/wiki/Marvel_Studios">Marvel Studios</a> and distributed by <a title="Walt Disney Studios Motion Pictures" href="https://en.wikipedia.org/wiki/Walt_Disney_Studios_Motion_Pictures">Walt Disney Studios Motion Pictures</a></p>', '0000-00-00', '00:00:', 'Guardians, Galaxy', 'on'),
(20, 10, 2, '2017-06-11 05:35:23', 'kakakk', 'dkdff', 'ffffffff', '1497159323_amaro-porano-jaha-chay-full-vi.jpg', '1497159323_amaro-porano-jaha-chay-full-vi.jpg', '1497159323_gal-gadot-wonder-woman-movie-j.jpg', '1497159323_', 'fff                ', '2017-07-01', '10 AM', 'ffffff', 'on'),
(21, 16, 4, '2017-06-17 08:02:46', 'hhhhh', 'iuhuhu', 'juijiu', '1497686566_Desert.jpg', '1497686566_Hydrangeas.jpg', '1497686566_Lighthouse.jpg', '1497686566_', 'jiouig7                ', '0000-00-00', '10 AM', 'jjiuju', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `movies2`
--

CREATE TABLE IF NOT EXISTS `movies2` (
`movie_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `quality_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `movie_name` varchar(255) NOT NULL,
  `movie_cast` varchar(200) NOT NULL,
  `movie_director` varchar(220) NOT NULL,
  `movie_img1` varchar(255) NOT NULL,
  `movie_img2` varchar(255) NOT NULL,
  `movie_img3` varchar(255) NOT NULL,
  `movie_desc` text NOT NULL,
  `movie_keyword` varchar(255) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies2`
--

INSERT INTO `movies2` (`movie_id`, `category_id`, `quality_id`, `date`, `movie_name`, `movie_cast`, `movie_director`, `movie_img1`, `movie_img2`, `movie_img3`, `movie_desc`, `movie_keyword`, `status`) VALUES
(10, 11, 5, '2017-06-07 01:05:24', 'Tubelight', 'Salman Khan, Zhu Zhu', 'Kabir Khan', '1496797524_hqdefault.jpg', '1496797524_maxresdefault.jpg', '1496797524_maxresdefault.jpg', '<p><em><strong>Tubelight</strong></em> is an upcoming Indian <a class="mw-redirect" title="Historical film" href="https://en.wikipedia.org/wiki/Historical_film">historical</a> <a title="War film" href="https://en.wikipedia.org/wiki/War_film">war drama</a> film written, and directed by <a title="Kabir Khan (director)" href="https://en.wikipedia.org/wiki/Kabir_Khan_%28director%29">Kabir Khan</a>.</p>', 'Tubelight', 'on'),
(11, 8, 3, '2017-06-11 05:37:24', 'hr78i87o', 'jr7k8t7', 'jjyk', '1497159444_aliencovenant_frfa.jpg', '1497159444_maxresdefault-1.jpg', '1497159444_baywatch.jpg', '<p>jytjffj</p>', 'dhyjtydj', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE IF NOT EXISTS `owner` (
`owner_id` int(20) NOT NULL,
  `hall_name` varchar(100) NOT NULL,
  `owner_name` varchar(50) NOT NULL,
  `owner_password` varchar(30) NOT NULL,
  `owner_email` varchar(50) NOT NULL,
  `contact_no` int(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `hall_name`, `owner_name`, `owner_password`, `owner_email`, `contact_no`) VALUES
(1, '', 'gnngfn', '155412', 'hfdgdgj@gmail.com', 266498945),
(3, 'Star Cineplex', 'RR Khan', '987654', 'star@gmail.com', 162345755),
(4, 'abc', 'def', '5555', 'abcdef@gmail.com', 456213),
(5, 'modhu', 'fbb', '8965', 'fdch@gmail.com', 78946),
(6, 'hhh', 'hhhh', '789', 'ffff@gmail.com', 7456);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
`page_id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `page_content` text,
  `page_keyword` text,
  `page_description` text,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pending_orders`
--

CREATE TABLE IF NOT EXISTS `pending_orders` (
  `customer_id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pending_orders`
--

INSERT INTO `pending_orders` (`customer_id`, `invoice_no`, `product_id`, `qty`, `order_status`) VALUES
(19, '591692981', 0, 0, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `quality`
--

CREATE TABLE IF NOT EXISTS `quality` (
`quality_id` int(11) NOT NULL,
  `quality_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quality`
--

INSERT INTO `quality` (`quality_id`, `quality_name`) VALUES
(2, '360px'),
(4, '720px'),
(5, '1080px');

-- --------------------------------------------------------

--
-- Table structure for table `quality2`
--

CREATE TABLE IF NOT EXISTS `quality2` (
`quality_id` int(11) NOT NULL,
  `quality_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quality2`
--

INSERT INTO `quality2` (`quality_id`, `quality_name`) VALUES
(3, '360px'),
(5, '720px'),
(6, '1080px');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
`schedule_id` int(10) NOT NULL,
  `movie_id` int(10) NOT NULL,
  `show_time` varchar(10) NOT NULL,
  `show_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
`v_id` int(11) NOT NULL,
  `video_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`admin_id`), ADD UNIQUE KEY `admin_email` (`admin_email`), ADD UNIQUE KEY `contact_no` (`contact_no`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
 ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `categories2`
--
ALTER TABLE `categories2`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
 ADD PRIMARY KEY (`customer_id`), ADD UNIQUE KEY `customer_email` (`customer_email`);

--
-- Indexes for table `customer_orders`
--
ALTER TABLE `customer_orders`
 ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `customer_payment`
--
ALTER TABLE `customer_payment`
 ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
 ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `movies2`
--
ALTER TABLE `movies2`
 ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
 ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
 ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `quality`
--
ALTER TABLE `quality`
 ADD PRIMARY KEY (`quality_id`);

--
-- Indexes for table `quality2`
--
ALTER TABLE `quality2`
 ADD PRIMARY KEY (`quality_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
 ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
 ADD PRIMARY KEY (`v_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `categories2`
--
ALTER TABLE `categories2`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `customer_orders`
--
ALTER TABLE `customer_orders`
MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer_payment`
--
ALTER TABLE `customer_payment`
MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `movies2`
--
ALTER TABLE `movies2`
MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
MODIFY `owner_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quality`
--
ALTER TABLE `quality`
MODIFY `quality_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `quality2`
--
ALTER TABLE `quality2`
MODIFY `quality_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
MODIFY `schedule_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
