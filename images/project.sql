-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 15, 2020 lúc 08:45 AM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `project`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `cat_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `imgUrl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `deleted_at`, `created_at`, `updated_at`, `imgUrl`) VALUES
(1, 'Fruits', NULL, '2020-06-18 08:31:01', NULL, 'category-1.jpg'),
(2, 'Juices', NULL, '2020-06-12 14:27:56', NULL, 'category-3.jpg'),
(3, 'VegeTables', NULL, '2020-06-13 10:30:37', NULL, 'category-2.jpg'),
(4, 'Dried', NULL, '2020-06-13 09:30:37', NULL, 'category-4.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `pr_id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` int(11) NOT NULL,
  `pr_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pr_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pr_price` double NOT NULL,
  `pr_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pr_description` varchar(2555) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pr_quantity` double(8,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `discount` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`pr_id`, `cat_id`, `pr_name`, `pr_image`, `pr_price`, `pr_title`, `pr_description`, `pr_quantity`, `deleted_at`, `created_at`, `updated_at`, `discount`) VALUES
(1, 3, 'BELL PEPPER', 'product-1.jpg', 120, 'This is sweet pepper', 'Bell peppers, also known as sweet peppers. The effect of bell peppers is evident in helping to enhance vision, prevent anemia and many other cancers and cardiovascular diseases.', 20.00, NULL, '2020-06-13 08:46:28', NULL, 20),
(2, 1, 'STRAWBERRY', 'product-2.jpg', 120, 'Strawberries scientific name: Fragaria', 'Strawberries scientific name: Fragaria, also known as strawberry land is a genus of angiosperms and flowering plants belonging to the family Rososa  for the most popular fruit. Strawberries come from the Americas and were bred by European gardeners in the', 20.00, NULL, '2020-06-10 06:56:11', NULL, 0),
(3, 3, 'GREEN BEARNS', 'product-3.jpg', 120, 'Green beans are the unripe', 'Green beans are the unripe, young fruit and protective pods of various cultivars of the common bean (Phaseolus vulgaris).[1][2] Immature or young pods of the runner bean (Phaseolus coccineus), yardlong bean (Vigna unguiculata subsp. sesquipedalis), and hy', 50.00, NULL, '2020-06-10 14:56:25', NULL, 0),
(4, 3, 'PURPLE CABBGE', 'product-4.jpg', 120, 'The red cabbage is a kind of cabbage', 'The red cabbage (purple-leaved varieties of Brassica oleracea Capitata Group) is a kind of cabbage, also known as Blaukraut after preparation. Its leaves are colored dark red/purple. However, the plant changes its color according to the pH value of the soil, due to a pigment belonging to anthocyanins.', 150.00, NULL, '2020-06-10 06:56:11', NULL, 10),
(5, 1, 'TOMATOE', 'product-5.jpg', 120, 'The tomato is the edible, often red, berry of the plant Solanum lycopersicum, commonly known as a tomato plant', 'The tomato is the edible, often red, berry of the plant Solanum lycopersicum, commonly known as a tomato plant. The species originated in western South America and Central America. The Nahuatl (the language used by the Aztecs) word tomatl gave rise to the Spanish word tomate, from which the English word tomato derived. Its domestication and use as a cultivated food may have originated with the indigenous peoples of Mexico', 20.00, NULL, '2020-06-10 06:56:11', NULL, 10),
(6, 1, 'BROCOLL', 'product-6.jpg', 120, 'Broccoli is an edible green plant in the cabbage family, whose large flowering head and stalk is eaten as a vegetable', 'Broccoli is an edible green plant in the cabbage family (family Brassicaceae, genus Brassica) whose large flowering head and stalk is eaten as a vegetable. The word broccoli comes from the Italian plural of broccolo, which means \"the flowering crest of a cabbage\", and is the diminutive form of brocco, meaning \"small nail\" or \"sprout\".', 30.00, NULL, '2020-06-10 06:56:11', NULL, 0),
(7, 1, 'CARROTS', 'product-7.jpg', 120, 'The carrot (Daucus carota subsp. sativus) is a root vegetable', 'The carrot (Daucus carota subsp. sativus) is a root vegetable, usually orange in colour, though purple, black, red, white, and yellow cultivars exist.[1] They are a domesticated form of the wild carrot, Daucus carota, native to Europe and Southwestern Asia. The plant probably originated in Persia and was originally cultivated for its leaves and seeds. The most commonly eaten part of the plant is the taproot, although the stems and leaves are eaten as well. The domestic carrot has been selectively bred for its greatly enlarged, more palatable, less woody-textured taproot.', 20.00, NULL, '2020-06-10 16:15:17', NULL, 15),
(8, 2, 'FRUITS JUICE', 'product-8.jpg', 120, 'Smoothie is a natural solution that contains tissues from fruits or vegetables.', 'Smoothie is a natural solution that contains tissues from fruits or vegetables. Juice is mechanically created by squeezing or squeezing or juicing fresh fruit or vegetables without the use of temperature or solvents. For example, orange juice is a solution extracted from oranges. Smoothies can be made at home from fresh vegetables by the use of your hands or by using electronic devices.', 55.00, NULL, '2020-06-10 06:56:11', NULL, 0),
(9, 3, '\r\nGARLIC', 'product-11.jpg', 55, 'Garlic (Allium sativum) is a species in the onion genus, Allium', 'Garlic (Allium sativum) is a species in the onion genus, Allium. Its close relatives include the onion, shallot, leek, chive,[2] and Chinese onion.[3] It is native to Central Asia and northeastern Iran, and has long been a common seasoning worldwide, with a history of several thousand years of human consumption and use.[4][5] It was known to ancient Egyptians, and has been used both as a food flavoring and as a traditional medicine', 35.00, NULL, '2020-06-10 06:56:11', NULL, 0),
(10, 1, 'APPLE', 'product-10.jpg', 100, 'An apple is an edible fruit produced by an apple tree (Malus domestica).', 'An apple is an edible fruit produced by an apple tree (Malus domestica). Apple trees are cultivated worldwide and are the most widely grown species in the genus Malus. The tree originated in Central Asia, where its wild ancestor, Malus sieversii, is still found today', 25.00, NULL, '2020-06-10 06:56:11', NULL, 5),
(11, 4, 'ONION', 'product-9.jpg', 55, 'The onion (Allium cepa L., from Latin cepa \"onion\")', 'The onion (Allium cepa L., from Latin cepa \"onion\"), also known as the bulb onion or common onion, is a vegetable that is the most widely cultivated species of the genus Allium. Its close relatives include the garlic, scallion, shallot, leek, chive, and Chinese onio.', 20.00, NULL, '2020-06-10 06:56:11', NULL, 0),
(12, 1, '\r\nCHILI', 'product-12.jpg', 35, 'The chili pepper  from Nahuatl chīlli', 'The chili pepper (also chile, chile pepper, chilli pepper, or chilli[4]), from Nahuatl chīlli (Nahuatl pronunciation:(About this soundlisten)), is the fruit of plants from the genus Capsicum which are members of the nightshade family, Solanaceae.[5] Chili peppers are widely used in many cuisines as a spice to add heat to dishes. The substances giving chili peppers their intensity when ingested or applied topically are capsaicin and related compounds known as capsaicinoids.', 20.00, NULL, '2020-06-10 06:56:11', NULL, 0),
(13, 3, 'ASPARAGUS', 'product-13.jpg', 75, 'Asparaguss a perennial flowering plant species in the genus Asparagus', 'Asparagus, or garden asparagus, folk name sparrow grass, scientific name Asparagus officinalis, is a perennial flowering plant species in the genus Asparagus. Its young shoots are used as a spring vegetable.', 15.00, NULL, '2020-06-10 06:56:11', NULL, 0),
(14, 3, '\r\nCABBAGE', 'product-14.jpg', 25, 'Cabbage (comprising several cultivars of Brassica oleracea) is a leafy green', 'Cabbage (comprising several cultivars of Brassica oleracea) is a leafy green, red (purple), or white (pale green) biennial plant grown as an annual vegetable crop for its dense-leaved heads. It is descended from the wild cabbage (B. oleracea var. oleracea), and belongs to the \"cole crops\" or brassicas, meaning it is closely related to broccoli and cauliflower (var. botrytis); Brussels sprouts (var. gemmifera); and Savoy cabbage', 15.00, NULL, '2020-06-10 06:56:11', NULL, 0),
(15, 4, 'Angelica sinensis', 'product-15.jpg', 199, 'Angelica sinensis', 'Angelica sinensis is a medicine with sweetness, pungency, mildness in Eastern medicine that helps to supplement blood, laxative, treat irregular menstruation, numbness of bones and joints ... very effectively', 5.00, NULL, '2020-06-18 08:31:01', NULL, 0),
(16, 4, 'Lotus root', 'product-16.jpg', 220, 'The lotus plant is a beautiful sight with majestic blooms ', 'The lotus plant is a beautiful sight with majestic blooms and unusual seedpods atop large leaves floating on ponds across Asia. Often depicted in paintings, the sacred plant has a symbolic significance in Hindu and Buddhist art and literature. The entire plant is edible, but the root that grows under the water is the most commonly used in cooking and is especially important in Chinese vegetarian cuisine. You probably remember them for the striking pattern that resembles old rotary dial phones', 15.00, NULL, '2020-06-10 06:56:11', NULL, 15);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `roles` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pr_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `pr_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
