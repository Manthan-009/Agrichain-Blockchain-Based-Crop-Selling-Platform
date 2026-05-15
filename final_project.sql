-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2025 at 03:57 PM
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
-- Database: `final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyer_address`
--

CREATE TABLE `buyer_address` (
  `u_id` int(11) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `set_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buyer_address`
--

INSERT INTO `buyer_address` (`u_id`, `address`, `set_at`) VALUES
(12, 'B-91, Yogiraj Society, Yogi chowk, Surat, 395010', '2025-02-28 12:58:20'),
(19, 'B-91, Yogiraj Society, Yogi chowk, Surat, 395010', '2025-03-21 12:09:42');

-- --------------------------------------------------------

--
-- Table structure for table `cart_data`
--

CREATE TABLE `cart_data` (
  `cart_item_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `c_total` decimal(10,2) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_data`
--

INSERT INTO `cart_data` (`cart_item_id`, `u_id`, `crop_id`, `quantity`, `price`, `c_total`, `added_date`) VALUES
(80, 12, 18, 210, 0.20, 42.00, '2025-04-07 03:40:09');

-- --------------------------------------------------------

--
-- Table structure for table `common_chat`
--

CREATE TABLE `common_chat` (
  `chat_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `u_role` varchar(50) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `common_chat`
--

INSERT INTO `common_chat` (`chat_id`, `u_id`, `u_name`, `u_role`, `message`, `created_at`) VALUES
(3, 12, 'Raja Krishna', 'Buyer', 'My name is Raja Krishna, and I would like to talk about this platform. This platform is the greatest platform for Farmer.', '2025-03-06 11:36:37'),
(4, 19, 'Aryan', 'Buyer', 'Hello everyone.', '2025-03-21 12:08:43');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `c_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `u_name` varchar(100) NOT NULL,
  `u_mail` varchar(100) NOT NULL,
  `u_subject` varchar(250) NOT NULL,
  `u_message` varchar(1000) NOT NULL,
  `u_role` varchar(100) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`c_id`, `u_id`, `u_name`, `u_mail`, `u_subject`, `u_message`, `u_role`, `time`) VALUES
(2, 12, 'Raja', 'rajakrishna0058@gmail.com', 'Login Related', 'I cannot able to logged in My Account.', 'Buyer', '2025-03-04 11:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `crop_data`
--

CREATE TABLE `crop_data` (
  `crop_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `c_img` varchar(255) NOT NULL,
  `c_type` varchar(500) NOT NULL,
  `category` varchar(255) NOT NULL,
  `c_quantity` double NOT NULL,
  `c_price` double NOT NULL,
  `c_description` varchar(1500) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crop_data`
--

INSERT INTO `crop_data` (`crop_id`, `u_id`, `c_img`, `c_type`, `category`, `c_quantity`, `c_price`, `c_description`, `created_time`) VALUES
(17, 11, 'grape-fruits-isolated-transparent-background_191095-14707-removebg-preview.jpg', 'Red Grapes', 'Fruits', 1560, 0.1, 'Red grapes, a variety of Vitis vinifera, are celebrated for their striking reddish-purple hue and delightful balance of sweetness and tartness. These juicy fruits, often enjoyed fresh or as a key ingredient in wines, jams, and desserts, owe their vibrant color to anthocyanins—powerful antioxidants that also contribute to their health benefits. Rich in resveratrol, particularly concentrated in the skin, red grapes are linked to improved heart health, while their natural sugars, fiber, and vitamins C and K make them a nutritious snack, offering about 104 calories per cup. Popular types like Red Globe, Crimson Seedless, and Flame Seedless cater to different tastes, from bold and juicy to crisp and tangy. Whether savored on their own, pressed into a glass of Merlot, or roasted for a savory twist, red grapes bring both flavor and versatility to the table.', '2025-02-28 12:57:33'),
(18, 11, 'instagram-img-08.jpg', 'Strawberry', 'Fruits', 0, 0.2, 'Strawberries, scientifically known as Fragaria × ananassa, are vibrant, juicy, and sweet fruits belonging to the rose family (Rosaceae). Originating from a hybrid of two wild strawberry species from North America and Chile, they were first cultivated in France during the 18th century and have since become one of the most popular berries worldwide. These heart-shaped fruits are renowned for their bright red color, tiny edible seeds speckling their surface, and a delightful balance of sweetness and tartness. Strawberries are not only a delicious treat but also a nutritional powerhouse, rich in vitamin C, antioxidants like anthocyanins, and dietary fiber, which contribute to heart health, immune support, and anti-inflammatory benefits.', '2025-02-28 15:02:46'),
(19, 11, 'wheat-grains-bowl-wheat-popcorn-bowl-wheat-seed-rustic.jpg', 'Wheat', 'Grains', 750, 0.3, 'The grain is incredibly versatile, milled into flour for bread, pasta, and pastries, or processed into products like couscous and breakfast cereals. Wheat thrives in temperate climates with well-drained loamy soil, and its major producers today include China, India, Russia, and the United States, with harvests typically occurring in late spring to early fall depending on the region. Beyond nutrition, wheat has cultural and economic significance, symbolizing sustenance and prosperity in many societies, and its gluten content—while beneficial for baking—has sparked dietary debates in recent years.', '2025-02-28 15:04:26'),
(20, 11, 'pexels-julieaagaard-2294471.jpg', 'Mango', 'Fruits', 550, 0.4, 'The mango, often referred to as the \"king of fruits,\" is a tropical fruit renowned for its juicy, sweet, and vibrant flesh, which ranges in color from golden yellow to deep orange. Scientifically known as Mangifera indica, it belongs to the Anacardiaceae family and is native to South Asia, particularly India, where it has been cultivated for over 4,000 years. Mangoes are not only prized for their delicious taste but also for their rich nutritional profile, offering a wealth of vitamins such as A, C, and E, along with dietary fiber and antioxidants that support immune health and digestion. Available in numerous varieties—over 500 globally, including popular ones like Alphonso, Kent, and Tommy Atkins—mangoes vary in size, shape, and flavor, from creamy and floral to tangy and tart.', '2025-03-01 07:09:13'),
(23, 11, 'cinnamon-6607375_1280.jpg', 'Cinnamon', 'Spices & Herbs', 700, 0.8, 'Cinnamon, a beloved spice derived from the inner bark of trees in the Cinnamomum genus, is a warm, aromatic treasure that has captivated palates for centuries. Its rich, sweet flavor carries hints of woodiness and subtle spice, making it a versatile addition to both sweet and savory dishes. Typically harvested from regions like Sri Lanka (Ceylon cinnamon) and Southeast Asia (Cassia cinnamon), it comes in two main forms: delicate, papery sticks rolled into quills or finely ground powder. In the kitchen, cinnamon shines in baked goods like cinnamon rolls and apple pie, infuses depth into spiced beverages like mulled wine or chai tea, and even enhances savory Middle Eastern and North African dishes such as tagines or rice pilafs.', '2025-03-07 08:53:11'),
(27, 18, 'tomato.jpg', 'Tomato', 'Vegetables', 1600, 0.9, 'Tomatoes, scientifically known as Solanum lycopersicum, are vibrant, juicy fruits native to western South America and Central America, though they’re commonly used as vegetables in culinary contexts. Initially domesticated by indigenous peoples in Mexico, they were introduced to Europe by Spanish explorers in the 16th century, eventually spreading worldwide. Rich in vitamins C and K, potassium, and antioxidants like lycopene—which may reduce the risk of heart disease and cancer—tomatoes thrive in warm climates and well-drained soil, with varieties ranging from tiny cherry tomatoes to hefty beefsteaks. They’re a staple in cuisines globally, enjoyed raw, cooked, or processed into sauces, and while typically red, they can also be yellow, green, or purple depending on the cultivar.', '2025-03-21 12:05:10'),
(28, 18, 'potato.jpg', 'Potato', 'Vegetables', 1295, 0.4, 'The potato (Solanum tuberosum) is a starchy tuber crop native to the Andes in South America, where it has been cultivated for over 7,000 years. It is now one of the world most important staple crops, ranking as the fourth-largest food crop globally after rice, wheat, and maize. Potatoes are versatile, nutritious, and easy to grow in various climates, making them a dietary staple in many cultures.', '2025-04-06 11:16:36');

-- --------------------------------------------------------

--
-- Table structure for table `educators_content`
--

CREATE TABLE `educators_content` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `media_url` text NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `educators_content`
--

INSERT INTO `educators_content` (`id`, `title`, `category`, `content`, `media_url`, `uploaded_at`) VALUES
(2, 'Types of Crop', 'Crop Type', '<h1>Crop Classification</h1> <p>Crops are classified based on their growth season, use, and biological characteristics. Understanding different crop types helps farmers make informed decisions on cultivation, storage, and distribution. Below are the main categories of crops:</p> <h2>1. Cereal Crops</h2> <p>Cereal crops are staple food sources rich in carbohydrates. They are widely grown for human consumption and animal feed. Examples include rice (<i>Oryza sativa</i>), wheat (<i>Triticum spp.</i>), maize (<i>Zea mays</i>), barley (<i>Hordeum vulgare</i>), and oats (<i>Avena sativa</i>).</p> <h2>2. Pulses (Legumes)</h2> <p>Pulses are protein-rich crops that enhance soil fertility by fixing nitrogen. They are essential for a balanced diet. Examples include lentils (<i>Lens culinaris</i>), chickpeas (<i>Cicer arietinum</i>), peas (<i>Pisum sativum</i>), and soybeans (<i>Glycine max</i>).</p> <h2>3. Oilseed Crops</h2> <p>These crops are grown primarily for oil extraction, which is used in cooking, cosmetics, and biofuels. Examples include sunflower (<i>Helianthus annuus</i>), mustard (<i>Brassica spp.</i>), groundnut (peanut) (<i>Arachis hypogaea</i>), and soybean (<i>Glycine max</i>).</p> <h2>4. Fiber Crops</h2> <p>Fiber crops are used in textile and industrial applications. Examples include cotton (<i>Gossypium spp.</i>), jute (<i>Corchorus spp.</i>), hemp (<i>Cannabis sativa</i>), and flax (<i>Linum usitatissimum</i>).</p> <h2>5. Horticultural Crops</h2> <p>These crops include fruits and vegetables that provide essential vitamins and minerals.</p> <h3>Fruits:</h3> <p>Mango, banana, apple, grapes, pineapple, and orange.</p> <h3>Vegetables:</h3> <p>Tomato, onion, carrot, cabbage, and spinach.</p>', 'Types_of_Crops.mp4', '2025-02-18 12:54:14'),
(3, 'What is Blockchain?', 'Blockchain Education', '<h1>Blockchain Technology</h1>\r\n        <p>Blockchain is a decentralized, distributed ledger technology that records transactions across multiple computers securely and transparently. It is best known as the technology behind cryptocurrencies like Bitcoin and Ethereum, but its applications extend far beyond digital currencies.</p>\r\n\r\n        <h2>Key Features of Blockchain:</h2>\r\n        <ul>\r\n            <li><strong>Decentralization:</strong> No single entity controls the network; instead, it is maintained by multiple nodes (computers).</li>\r\n            <li><strong>Immutability:</strong> Once a transaction is recorded, it cannot be altered or deleted.</li>\r\n            <li><strong>Transparency:</strong> All transactions are visible to participants on the network, increasing trust.</li>\r\n            <li><strong>Security:</strong> Transactions are encrypted and verified using consensus mechanisms like Proof of Work (PoW) or Proof of Stake (PoS).</li>\r\n        </ul>\r\n\r\n        <h2>Applications of Blockchain in Agrichain:</h2>\r\n        <p>Since you\'re working on an Agrichain-related website, blockchain can play a crucial role in:</p>\r\n        <ul>\r\n            <li><strong>Supply Chain Transparency:</strong> Tracking food from farm to table, ensuring authenticity.</li>\r\n            <li><strong>Smart Contracts:</strong> Automating agreements between farmers, suppliers, and buyers.</li>\r\n            <li><strong>Traceability:</strong> Preventing fraud and ensuring food safety by providing detailed records.</li>\r\n            <li><strong>Payments and Financing:</strong> Facilitating secure and fast transactions for farmers and traders.</li>\r\n        </ul>', 'blockchain_info.mp4', '2025-02-18 14:49:26'),
(13, 'Types of Crops', 'Crop Type', '<h1>Crop Classification</h1>\r\n    <p>Crops are classified based on their growth season, use, and biological characteristics. Understanding different crop types helps farmers make informed decisions on cultivation, storage, and distribution. Below are the main categories of crops:</p>\r\n\r\n    <h2>1. Cereal Crops</h2>\r\n    <p>Cereal crops are staple food sources rich in carbohydrates. They are widely grown for human consumption and animal feed.</p>\r\n    <ul>\r\n        <li>Rice (<i>Oryza sativa</i>)</li>\r\n        <li>Wheat (<i>Triticum spp.</i>)</li>\r\n        <li>Maize (<i>Zea mays</i>)</li>\r\n        <li>Barley (<i>Hordeum vulgare</i>)</li>\r\n        <li>Oats (<i>Avena sativa</i>)</li>\r\n    </ul>\r\n\r\n    <h2>2. Pulses (Legumes)</h2>\r\n    <p>Pulses are protein-rich crops that enhance soil fertility by fixing nitrogen. They are essential for a balanced diet.</p>\r\n    <ul>\r\n        <li>Lentils (<i>Lens culinaris</i>)</li>\r\n        <li>Chickpeas (<i>Cicer arietinum</i>)</li>\r\n        <li>Peas (<i>Pisum sativum</i>)</li>\r\n        <li>Soybeans (<i>Glycine max</i>)</li>\r\n    </ul>\r\n\r\n    <h2>3. Oilseed Crops</h2>\r\n    <p>These crops are grown primarily for oil extraction, which is used in cooking, cosmetics, and biofuels.</p>\r\n    <ul>\r\n        <li>Sunflower (<i>Helianthus annuus</i>)</li>\r\n        <li>Mustard (<i>Brassica spp.</i>)</li>\r\n        <li>Groundnut (peanut) (<i>Arachis hypogaea</i>)</li>\r\n        <li>Soybean (<i>Glycine max</i>)</li>\r\n    </ul>\r\n\r\n    <h2>4. Fiber Crops</h2>\r\n    <p>Fiber crops are used in textile and industrial applications.</p>\r\n    <ul>\r\n        <li>Cotton (<i>Gossypium spp.</i>)</li>\r\n        <li>Jute (<i>Corchorus spp.</i>)</li>\r\n        <li>Hemp (<i>Cannabis sativa</i>)</li>\r\n        <li>Flax (<i>Linum usitatissimum</i>)</li>\r\n    </ul>\r\n\r\n    <h2>5. Horticultural Crops</h2>\r\n    <p>These crops include fruits and vegetables that provide essential vitamins and minerals.</p>\r\n    <h3>Fruits:</h3>\r\n    <ul>\r\n        <li>Mango</li>\r\n        <li>Banana</li>\r\n        <li>Apple</li>\r\n        <li>Grapes</li>\r\n        <li>Pineapple</li>\r\n        <li>Orange</li>\r\n    </ul>\r\n    <h3>Vegetables:</h3>\r\n    <ul>\r\n        <li>Tomato</li>\r\n        <li>Onion</li>\r\n        <li>Carrot</li>\r\n        <li>Cabbage</li>\r\n        <li>Spinach</li>\r\n    </ul>', 'Types_of_Crops.mp4', '2025-03-21 13:10:56'),
(16, 'How Farmer use this Site?', 'How to access this Site?', '<h1>Agrichain Farmer Process</h1>\r\n\r\n    <div>\r\n        <h2>1. Registration</h2>\r\n        <ul>\r\n            <li>Navigate to the \"Sign Up\" section on the login and registration page.</li>\r\n            <li>Provide required details, including name, email address, password, confirmation password, and set user role to \"farmer.\"</li>\r\n            <li>Submit the registration form.</li>\r\n            <li>Receive confirmation of successful registration and log in using credentials.</li>\r\n        </ul>\r\n    </div>\r\n\r\n    <div>\r\n        <h2>2. Wallet Connection</h2>\r\n        <ul>\r\n            <li>Log in to the platform and access the dashboard.</li>\r\n            <li>Select the \"Connect Wallet\" option.</li>\r\n            <li>Authenticate with Metamask to link the Ethereum wallet.</li>\r\n            <li>Validate and store the wallet address in the system.</li>\r\n            <li>View the wallet address displayed on the dashboard.</li>\r\n        </ul>\r\n    </div>\r\n\r\n    <div>\r\n        <h2>3. Crop Listing</h2>\r\n        <ul>\r\n            <li>Navigate to the \"List Crop\" section from the dashboard.</li>\r\n            <li>Fill out the crop listing form with crop image, name, type, category, quantity available, price per kilogram, and detailed description.</li>\r\n            <li>Submit the form to add the crop to the marketplace.</li>\r\n            <li>Crop is listed and visible to buyers on the platform.</li>\r\n        </ul>\r\n    </div>\r\n\r\n    <div>\r\n        <h2>4. Crop Management (Update/Delete)</h2>\r\n        <ul>\r\n            <li>Access the \"Update Crop\" option from the dashboard or farmer footer.</li>\r\n            <li>Select the crop to modify.</li>\r\n            <li>Update details such as quantity or price, or choose to delete the listing.</li>\r\n            <li>Confirm changes or removal of the crop listing.</li>\r\n        </ul>\r\n    </div>\r\n\r\n    <div>\r\n        <h2>5. Buyer Interaction and Sale</h2>\r\n        <ul>\r\n            <li>Monitor incoming buyer inquiries via the specific chat module.</li>\r\n            <li>Respond to buyer messages about crop details or negotiations.</li>\r\n            <li>Buyer adds crop to cart and completes purchase using cryptocurrency.</li>\r\n            <li>Receive notification of the sale and blockchain transaction confirmation.</li>\r\n        </ul>\r\n    </div>\r\n\r\n    <div>\r\n        <h2>6. Order Fulfillment</h2>\r\n        <ul>\r\n            <li>Access the order details from the dashboard or \"Update Status\" option.</li>\r\n            <li>Update the delivery status (e.g., pending, shipped, delivered).</li>\r\n            <li>Coordinate with the buyer via chat if needed.</li>\r\n            <li>Confirm order completion once delivered.</li>\r\n        </ul>\r\n    </div>\r\n\r\n    <div>\r\n        <h2>7. Transaction Completion and Feedback</h2>\r\n        <ul>\r\n            <li>Verify the cryptocurrency payment in the connected wallet.</li>\r\n            <li>Check the transaction recorded in the system with a blockchain hash.</li>\r\n            <li>Await buyer feedback and rating post-delivery.</li>\r\n            <li>Review buyer feedback on the dashboard, if provided.</li>\r\n        </ul>\r\n    </div>\r\n\r\n    <div>\r\n        <h2>8. Analytics and Education</h2>\r\n        <ul>\r\n            <li>Access analytics module from the dashboard to view crop trends and sales data.</li>\r\n            <li>Explore educational resources on crops and blockchain technology.</li>\r\n            <li>Use insights to optimize future listings or transactions.</li>\r\n            <li>Engage in community forums for additional support or knowledge sharing.</li>\r\n        </ul>\r\n    </div>\r\n\r\n    <div>\r\n        <h2>9. Ongoing Engagement</h2>\r\n        <ul>\r\n            <li>Regularly log in to monitor listings, orders, and messages.</li>\r\n            <li>Update crop listings as new harvests become available.</li>\r\n            <li>Maintain wallet connection for seamless transactions.</li>\r\n            <li>Contact support via \"Contact Us\" if issues arise, concluding the process cycle.</li>\r\n        </ul>\r\n    </div>', 'Before buying Crop Farmer.mp4', '2025-04-07 11:43:16');

-- --------------------------------------------------------

--
-- Table structure for table `fb_chat`
--

CREATE TABLE `fb_chat` (
  `chat_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `u_name` varchar(50) NOT NULL,
  `message` varchar(1024) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fb_chat`
--

INSERT INTO `fb_chat` (`chat_id`, `f_id`, `b_id`, `t_id`, `u_name`, `message`, `date_time`) VALUES
(8, 11, 12, 70, 'Ram Raja', 'Hi I am a Farmer.', '2025-03-04 12:32:34'),
(9, 11, 12, 70, 'Ram Raja', 'Hi I am a Farmer.', '2025-03-04 12:33:34'),
(10, 11, 12, 70, 'Raja  Krishna', 'How are You?', '2025-03-04 14:18:53'),
(11, 11, 12, 70, 'Raja  Krishna', 'How are You?', '2025-03-04 14:20:06'),
(12, 11, 12, 72, 'Ram Raja', 'Hello.', '2025-03-04 14:28:09'),
(13, 11, 12, 70, 'Ram Raja', 'My name is Ram Raja.', '2025-03-05 15:06:50'),
(14, 11, 12, 71, 'Raja  Krishna', 'Hello, Where is my Order.', '2025-03-06 14:57:11'),
(15, 11, 12, 73, 'Ram Raja', 'How was our service?', '2025-03-13 16:08:44'),
(16, 11, 12, 75, 'Raja  Krishna', 'Hello', '2025-03-14 09:56:33'),
(18, 11, 19, 82, 'Aryan Korat', 'Hi You provide good service.', '2025-03-21 12:10:24'),
(19, 11, 19, 82, 'Ram Raja', 'Thank you.', '2025-03-21 12:12:59');

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `order_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `cart_item_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rating` decimal(5,2) NOT NULL,
  `feedback` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`order_id`, `u_id`, `crop_id`, `farmer_id`, `cart_item_id`, `total_price`, `quantity`, `status`, `order_date`, `rating`, `feedback`) VALUES
(73, 12, 17, 11, 67, 5.00, 50, 'Delivered', '2025-03-08 03:59:59', 0.00, ''),
(74, 12, 18, 11, 64, 10.00, 50, 'Delivered', '2025-03-08 04:00:56', 0.00, ''),
(75, 12, 23, 11, 68, 40.00, 50, 'Out of Delivery', '2025-04-07 01:43:09', 0.00, ''),
(80, 19, 17, 11, 74, 1.00, 10, 'Delivered', '2025-03-21 12:14:12', 5.00, 'Good Service.'),
(81, 19, 17, 11, 75, 1.00, 10, 'Processing', '2025-04-02 21:54:02', 0.00, ''),
(82, 19, 17, 11, 78, 1.00, 10, 'Processing', '2025-04-06 06:48:56', 0.00, ''),
(83, 19, 18, 11, 79, 4.00, 20, 'Processing', '2025-04-06 06:52:58', 0.00, ''),
(84, 19, 28, 18, 81, 2.00, 5, 'Processing', '2025-04-07 03:31:00', 0.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `specific_chat`
--

CREATE TABLE `specific_chat` (
  `chat_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `u_role` varchar(50) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specific_chat`
--

INSERT INTO `specific_chat` (`chat_id`, `u_id`, `u_name`, `u_role`, `message`, `created_at`) VALUES
(4, 11, 'Ram Raja', 'Farmer', 'Hello, I sell 5000KG Wheat in every Year.', '2025-03-01 06:11:46'),
(5, 12, 'Raja Krishna', 'Buyer', 'I am Best Buyer in Agrichin.\r\n', '2025-03-01 13:17:37'),
(6, 11, 'Ram Raja', 'Farmer', 'I plow Wheat and Sugarcane in every year.', '2025-03-06 08:41:51'),
(8, 18, 'Manthan', 'Farmer', 'I am Manthan.', '2025-03-21 12:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `cart_item_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `blockchain_hash` varchar(255) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `buyer_id`, `farmer_id`, `crop_id`, `cart_item_id`, `amount`, `blockchain_hash`, `transaction_date`) VALUES
(75, 12, 11, 17, 67, 5.00, '0xdfb91571afd4131e6328579554da5791b92cd7d15fce771a0bb91ae365f0e0f2', '2025-03-06 10:25:15'),
(76, 12, 11, 18, 64, 10.00, '0x3d8a9952478e3fbc9d3541a62d60826e590a7afa0bbb022a5eba048d7850e269', '2025-03-07 06:52:34'),
(77, 12, 11, 23, 68, 40.00, '0x49cb7fba8697c28260009fd0bd2d5391b17fce7398166d185a8dac4848d3185b', '2025-03-07 22:19:17'),
(82, 19, 11, 17, 74, 1.00, '0x8d8185c1f428948b39704f3ea18d3fab2732d761f61812f5acb47abf271ef731', '2025-03-21 07:39:55'),
(83, 19, 11, 17, 75, 1.00, '0xb3cf75af2727c87272f91a1ea950d841fed85108803ca426885b4e03ed6a1417', '2025-04-02 21:54:02'),
(84, 19, 11, 17, 78, 1.00, '0x7a32ca7fffa43154c8176fc4d11692f565a18d6cd7b5138872546c3fedf62ec8', '2025-04-06 06:48:56'),
(85, 19, 11, 18, 79, 4.00, '0x04733b38947772b17e64e0754590270acba11764b7ef938ba5d4f71fb64a331c', '2025-04-06 06:52:58'),
(86, 19, 18, 28, 81, 2.00, '0xafdb2a0b89f65485ce9c293c1c7d0f51deeef167160f13c9f494fbeaa3a1f789', '2025-04-07 03:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(100) NOT NULL,
  `u_mail` varchar(100) NOT NULL,
  `user_role` varchar(100) NOT NULL,
  `u_password` varchar(100) NOT NULL,
  `u_confirm_pass` varchar(100) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_name`, `u_mail`, `user_role`, `u_password`, `u_confirm_pass`, `date_time`) VALUES
(11, 'Ram', 'ramraja12589@gmail.com', 'Farmer', 'TWFiQDI4MTA1', 'TWFiQDI4MTA1', '2025-02-28 12:48:52'),
(12, 'Raja  Krishna', 'rajakrishna0058@gmail.com', 'Buyer', 'TWFiQDI4MTA1', 'TWFiQDI4MTA1', '2025-02-28 12:50:31'),
(18, 'Manthan', 'manthanbeladiya2468@gmail.com', 'Farmer', 'TWFiQDI4MTA1', 'TWFiQDI4MTA1', '2025-03-21 12:03:21'),
(19, 'Aryan Korat', 'aryankorat155@gmail.com', 'Buyer', 'TWFiQDI4MTA1', 'TWFiQDI4MTA1', '2025-03-21 12:08:10');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_addresses`
--

CREATE TABLE `wallet_addresses` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `wallet_address` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet_addresses`
--

INSERT INTO `wallet_addresses` (`id`, `u_id`, `wallet_address`, `created_at`) VALUES
(33, 11, '0x779154ed1ababa0c20f857c046c0fae08055e3ba', '2025-03-06 10:54:15'),
(46, 19, '0x9402f87bb7cb3d3995a79935483b6892b6d994b8', '2025-03-21 12:08:58'),
(47, 12, '0x779154ed1ababa0c20f857c046c0fae08055e3ba', '2025-04-03 15:52:54'),
(50, 18, '0x779154ed1ababa0c20f857c046c0fae08055e3ba', '2025-04-06 04:01:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyer_address`
--
ALTER TABLE `buyer_address`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `cart_data`
--
ALTER TABLE `cart_data`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `crop_id` (`crop_id`);

--
-- Indexes for table `common_chat`
--
ALTER TABLE `common_chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `crop_data`
--
ALTER TABLE `crop_data`
  ADD PRIMARY KEY (`crop_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `educators_content`
--
ALTER TABLE `educators_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fb_chat`
--
ALTER TABLE `fb_chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `specific_chat`
--
ALTER TABLE `specific_chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `crop_id` (`crop_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_mail` (`u_mail`);

--
-- Indexes for table `wallet_addresses`
--
ALTER TABLE `wallet_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_id` (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_data`
--
ALTER TABLE `cart_data`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `common_chat`
--
ALTER TABLE `common_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `crop_data`
--
ALTER TABLE `crop_data`
  MODIFY `crop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `educators_content`
--
ALTER TABLE `educators_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `fb_chat`
--
ALTER TABLE `fb_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `specific_chat`
--
ALTER TABLE `specific_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `wallet_addresses`
--
ALTER TABLE `wallet_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buyer_address`
--
ALTER TABLE `buyer_address`
  ADD CONSTRAINT `buyer_address_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`);

--
-- Constraints for table `cart_data`
--
ALTER TABLE `cart_data`
  ADD CONSTRAINT `cart_data_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`),
  ADD CONSTRAINT `cart_data_ibfk_2` FOREIGN KEY (`crop_id`) REFERENCES `crop_data` (`crop_id`),
  ADD CONSTRAINT `cart_data_ibfk_3` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`),
  ADD CONSTRAINT `cart_data_ibfk_4` FOREIGN KEY (`crop_id`) REFERENCES `crop_data` (`crop_id`);

--
-- Constraints for table `common_chat`
--
ALTER TABLE `common_chat`
  ADD CONSTRAINT `common_chat_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`),
  ADD CONSTRAINT `common_chat_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`);

--
-- Constraints for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD CONSTRAINT `contact_us_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`),
  ADD CONSTRAINT `contact_us_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`);

--
-- Constraints for table `crop_data`
--
ALTER TABLE `crop_data`
  ADD CONSTRAINT `crop_data_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`),
  ADD CONSTRAINT `crop_data_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`);

--
-- Constraints for table `specific_chat`
--
ALTER TABLE `specific_chat`
  ADD CONSTRAINT `specific_chat_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`),
  ADD CONSTRAINT `specific_chat_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`crop_id`) REFERENCES `crop_data` (`crop_id`);

--
-- Constraints for table `wallet_addresses`
--
ALTER TABLE `wallet_addresses`
  ADD CONSTRAINT `wallet_addresses_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`),
  ADD CONSTRAINT `wallet_addresses_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
