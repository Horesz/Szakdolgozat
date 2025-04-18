-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Ápr 18. 17:28
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `szakdolgozat`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gaming PC', 'gaming-pc', 'Erőteljes gaming számítógépek a legjobb játékélményért.', 'images/categories/default.png', 'active', '2025-03-15 17:19:24', '2025-03-15 17:19:24'),
(2, 'Konzolok', 'konzolok', 'Népszerű játékkonzolok és kiegészítőik.', 'images/categories/default.png', 'active', '2025-03-15 17:19:24', '2025-03-15 17:19:24'),
(3, 'Gamer Monitorok', 'gamer-monitorok', 'Magas frissítési rátájú és válaszidejű gamer monitorok.', 'images/categories/default.png', 'active', '2025-03-15 17:19:24', '2025-03-15 17:19:24'),
(4, 'Gamer Billentyűzetek', 'gamer-billentyuzetek', 'Mechanikus és membránbillentyűzetek gamereknek.', 'images/categories/default.png', 'active', '2025-03-15 17:19:24', '2025-03-15 17:19:24'),
(5, 'Gamer Egerek', 'gamer-egerek', 'Nagy pontosságú és testreszabható egerek.', 'images/categories/default.png', 'active', '2025-03-15 17:19:24', '2025-03-15 17:19:24'),
(6, 'Gamer Fejhallgatók', 'gamer-fejhallgatok', 'Kiváló hangminőségű vezetékes és vezeték nélküli fejhallgatók.', 'images/categories/default.png', 'active', '2025-03-15 17:19:24', '2025-03-15 17:19:24'),
(7, 'Videójátékok', 'videojatekok', 'A legújabb és klasszikus játékok több platformra.', 'images/categories/default.png', 'active', '2025-03-15 17:19:24', '2025-03-15 17:19:24'),
(8, 'Gamer Székek', 'gamer-szekek', 'Kényelmes gamer székek hosszú játékmenetekhez.', 'images/categories/default.png', 'active', '2025-03-15 17:19:24', '2025-03-15 17:19:24'),
(9, 'Számítógép Alkatrészek', 'szamitogep-alkatreszek', 'Processzorok, videokártyák, memóriák és más alkatrészek.', 'images/categories/default.png', 'active', '2025-03-15 17:19:24', '2025-03-15 17:19:24'),
(10, 'Gamer Kiegészítők', 'gamer-kiegeszitok', 'Egérpadok, kontroller töltők és egyéb kiegészítők.', 'images/categories/default.png', 'active', '2025-03-15 17:19:24', '2025-03-15 17:19:24');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `discount_price` decimal(10,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_01_26_sessions_table', 1),
(5, '2024_11_16_181009_categories', 1),
(6, '2024_11_23_175432_products', 1),
(7, '2025_01_29_191559_product_images', 1),
(8, '2025_01_29_191649_discounts', 1),
(9, '2025_01_29_191726_reviews', 1),
(10, '2025_01_29_192000_related_products', 1),
(11, '2025_01_29_192121_add_seo_fields_to_products', 1),
(12, '2025_03_15_180849_modify_product_type_enum', 1),
(13, '2025_03_15_181216_add_alt_column_to_product_images', 1),
(14, '2025_03_22_174607_create_newsletters_table', 2),
(15, '2025_03_22_180100_orders', 2),
(16, '2025_03_22_180124_order_item', 2),
(17, '2025_04_17_134950_add_loyality_points', 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address_zip` varchar(255) NOT NULL,
  `address_city` varchar(255) NOT NULL,
  `address_street` varchar(255) NOT NULL,
  `address_additional` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `loyalty_points_used` int(11) NOT NULL DEFAULT 0,
  `loyalty_points_earned` int(11) NOT NULL DEFAULT 0,
  `total` decimal(10,2) NOT NULL,
  `shipping_method` enum('courier','pickup_point','store') NOT NULL DEFAULT 'courier',
  `payment_method` enum('card','transfer','cod') NOT NULL DEFAULT 'card',
  `payment_status` enum('pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',
  `order_status` enum('pending','processing','shipped','delivered','completed','cancelled','refunded') NOT NULL DEFAULT 'pending',
  `order_notes` text DEFAULT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `is_guest` tinyint(1) NOT NULL DEFAULT 0,
  `guest_token` varchar(255) DEFAULT NULL,
  `invoice_issued` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `firstname`, `lastname`, `email`, `phone`, `address_zip`, `address_city`, `address_street`, `address_additional`, `subtotal`, `shipping_cost`, `discount`, `loyalty_points_used`, `loyalty_points_earned`, `total`, `shipping_method`, `payment_method`, `payment_status`, `order_status`, `order_notes`, `coupon_code`, `is_guest`, `guest_token`, `invoice_issued`, `created_at`, `updated_at`) VALUES
(3, 4, 'GS250418SR53', 'Barnabás', 'Sinka', 'sinkabarni3@gmail.com', '06203717901', '3212', 'Gyöngyöshalász', 'Gyöngyösi út 28', NULL, 549900.00, 990.00, 0.00, 0, 549, 550890.00, 'pickup_point', 'cod', 'pending', 'pending', 'adsfdasf', NULL, 0, NULL, 0, '2025-04-18 10:52:51', '2025-04-18 10:52:51'),
(4, 4, 'GS250418OW5P', 'Barnabás', 'Sinka', 'sinkabarni3@gmail.com', '06203717901', '3212', 'Gyöngyöshalász', 'Gyöngyösi út 28', NULL, 549900.00, 0.00, 5400.00, 540, 549, 544500.00, 'store', 'cod', 'pending', 'pending', NULL, NULL, 0, NULL, 0, '2025-04-18 10:54:53', '2025-04-18 10:54:53'),
(5, 4, 'GS250418TNWQ', 'Barnabás', 'Sinka', 'sinkabarni3@gmail.com', '06203717901', '3212', 'Gyöngyöshalász', 'Gyöngyösi út 28', NULL, 549900.00, 990.00, 0.00, 0, 549, 550890.00, 'pickup_point', 'cod', 'pending', 'pending', 'asdasd', NULL, 0, NULL, 0, '2025-04-18 13:06:01', '2025-04-18 13:06:01'),
(6, 3, 'GS250418YGKW', 'Barnabás', 'Sinka', 'sinkabarni13@gmail.com', '06203717901', '3212', 'Gyöngyöshalász', 'Gyöngyösi út 28', NULL, 179990.00, 0.00, 0.00, 0, 179, 179990.00, 'store', 'card', 'pending', 'pending', NULL, NULL, 0, NULL, 0, '2025-04-18 13:12:48', '2025-04-18 13:12:48'),
(7, 3, 'GS250418PP13', 'Barnabás', 'Sinka', 'sinkabarni13@gmail.com', '06203717901', '3212', 'Gyöngyöshalász', 'Gyöngyösi út 28', NULL, 179990.00, 1490.00, 0.00, 0, 179, 181480.00, 'courier', 'card', 'pending', 'pending', NULL, NULL, 0, NULL, 0, '2025-04-18 13:14:53', '2025-04-18 13:14:53');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
(2, 3, 2, 'TitanForce Pro Gaming PC', 549900.00, 1, 549900.00, '2025-04-18 10:52:51', '2025-04-18 10:52:51'),
(3, 4, 2, 'TitanForce Pro Gaming PC', 549900.00, 1, 549900.00, '2025-04-18 10:54:53', '2025-04-18 10:54:53'),
(4, 5, 2, 'TitanForce Pro Gaming PC', 549900.00, 1, 549900.00, '2025-04-18 13:06:01', '2025-04-18 13:06:01'),
(5, 6, 4, 'PlayStation 5 Digital Edition', 179990.00, 1, 179990.00, '2025-04-18 13:12:48', '2025-04-18 13:12:48'),
(6, 7, 4, 'PlayStation 5 Digital Edition', 179990.00, 1, 179990.00, '2025-04-18 13:14:53', '2025-04-18 13:14:53');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(50) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `specifications` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`specifications`)),
  `short_description` text NOT NULL,
  `full_description` longtext NOT NULL,
  `original_price` decimal(10,2) DEFAULT NULL,
  `discount_percentage` int(11) NOT NULL DEFAULT 0,
  `status` enum('Aktív','Inaktív','Hamarosan érkezik','Elfogyott') NOT NULL DEFAULT 'Aktív',
  `warranty_months` int(11) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_new_arrival` tinyint(1) NOT NULL DEFAULT 0,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `technical_details` text DEFAULT NULL,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `average_rating` double NOT NULL DEFAULT 0,
  `total_reviews` int(11) NOT NULL DEFAULT 0,
  `weight` decimal(8,2) DEFAULT NULL,
  `shipping_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`shipping_details`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `price`, `stock_quantity`, `category_id`, `type`, `brand`, `specifications`, `short_description`, `full_description`, `original_price`, `discount_percentage`, `status`, `warranty_months`, `is_featured`, `is_new_arrival`, `images`, `technical_details`, `tags`, `average_rating`, `total_reviews`, `weight`, `shipping_details`, `created_at`, `updated_at`, `deleted_at`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(1, 'Razor GXT-5000 Gaming PC', 'razor-gxt-5000-gaming-pc', 999900.00, 15, 1, 'Gaming PC', 'Razor', '\"{\\\"Processzor\\\":\\\"AMD Ryzen 9 7900X\\\",\\\"Videok\\\\u00e1rtya\\\":\\\"NVIDIA GeForce RTX 4080 16GB\\\",\\\"Mem\\\\u00f3ria\\\":\\\"32GB DDR5 5200MHz\\\",\\\"T\\\\u00e1rhely\\\":\\\"2TB NVMe SSD\\\",\\\"T\\\\u00e1pegys\\\\u00e9g\\\":\\\"850W 80+ Gold\\\",\\\"H\\\\u0171t\\\\u00e9s\\\":\\\"RGB V\\\\u00edzh\\\\u0171t\\\\u00e9s\\\"}\"', 'Csúcsteljesítményű gamer PC RTX 4080 videokártyával és Ryzen 9 processzorral.', 'A Razor GXT-5000 a legújabb generációs gamer PC, amely kiváló teljesítményt nyújt a legújabb AAA játékokhoz is. Az NVIDIA RTX 4080 videokártya és az AMD Ryzen 9 7900X processzor kombinációja biztosítja a zökkenőmentes játékélményt akár 4K felbontáson is. Az elegáns RGB házban 32GB DDR5 memória és 2TB NVMe SSD található a villámgyors betöltési időkért.', 1099900.00, 9, 'Aktív', 36, 1, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:31', '2025-03-22 16:14:00', NULL, 'Razor GXT-5000 Gaming PC', 'Csúcsteljesítményű gamer PC RTX 4080 videokártyával és Ryzen 9 processzorral.', 'Razor, Gaming PC, Gaming PC'),
(2, 'TitanForce Pro Gaming PC', 'titanforce-pro-gaming-pc', 549900.00, 5, 1, 'Gaming PC', 'TitanForce', '\"{\\\"Processzor\\\":\\\"Intel Core i5-13600K\\\",\\\"Videok\\\\u00e1rtya\\\":\\\"NVIDIA GeForce RTX 3060 Ti 8GB\\\",\\\"Mem\\\\u00f3ria\\\":\\\"16GB DDR4 3200MHz\\\",\\\"T\\\\u00e1rhely\\\":\\\"1TB NVMe SSD\\\",\\\"T\\\\u00e1pegys\\\\u00e9g\\\":\\\"650W 80+ Bronze\\\",\\\"H\\\\u0171t\\\\u00e9s\\\":\\\"RGB L\\\\u00e9gh\\\\u0171t\\\\u00e9s\\\"}\"', 'Középkategóriás játékra optimalizált számítógép Intel i5 processzorral.', 'A TitanForce Pro egy kiváló ár-érték arányú gaming számítógép, amely megfizethető áron kínál jó teljesítményt. Az Intel Core i5-13600K processzor és az RTX 3060 Ti videokártya zökkenőmentes játékélményt biztosít 1440p felbontáson. A 16GB DDR4 memória és az 1TB NVMe SSD gyors betöltési időt és sokoldalú használatot tesz lehetővé.', 549900.00, 0, 'Aktív', 24, 0, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-04-18 13:06:01', NULL, 'TitanForce Pro Gaming PC', 'Középkategóriás játékra optimalizált számítógép Intel i5 processzorral.', 'TitanForce, Gaming PC, Gaming PC'),
(3, 'AlphaGamer Stealth RTX', 'alphagamer-stealth-rtx', 799900.00, 5, 4, 'Gaming PC', 'AlphaGamer', '\"{\\\"Processzor\\\":\\\"AMD Ryzen 7 7700X\\\",\\\"Videok\\\\u00e1rtya\\\":\\\"NVIDIA GeForce RTX 4070 12GB\\\",\\\"Mem\\\\u00f3ria\\\":\\\"32GB DDR5 5200MHz\\\",\\\"T\\\\u00e1rhely\\\":\\\"1TB NVMe SSD + 2TB HDD\\\",\\\"T\\\\u00e1pegys\\\\u00e9g\\\":\\\"750W 80+ Platinum SFX\\\",\\\"H\\\\u0171t\\\\u00e9s\\\":\\\"Egyedi Folyad\\\\u00e9kh\\\\u0171t\\\\u00e9s\\\"}\"', 'Kompakt méretű, erőteljes mini-ITX gaming PC egyedi hűtőrendszerrel.', 'Az AlphaGamer Stealth RTX egy kompakt, mégis nagy teljesítményű gamer PC, ami tökéletesen illeszkedik bármilyen játékállomáshoz. A mini-ITX formátum ellenére csúcskategóriás komponensekkel szereltük fel: Ryzen 7 processzor, RTX 4070 videokártya és 32GB memória biztosítja, hogy a legújabb játékokat is maximális grafikai beállításokkal élvezhesd.', 849900.00, 6, 'Inaktív', 36, 1, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-15 19:22:01', '2025-03-15 19:22:01', 'AlphaGamer Stealth RTX', 'Kompakt méretű, erőteljes mini-ITX gaming PC egyedi hűtőrendszerrel.', 'AlphaGamer, Gaming PC, Gaming PC'),
(4, 'PlayStation 5 Digital Edition', 'playstation-5-digital-edition', 179990.00, 8, 2, 'Konzol', 'Sony', '\"{\\\"CPU\\\":\\\"AMD Zen 2, 8 mag, 3.5GHz\\\",\\\"GPU\\\":\\\"AMD RDNA 2, 10.28 TFLOPS\\\",\\\"Mem\\\\u00f3ria\\\":\\\"16GB GDDR6\\\",\\\"T\\\\u00e1rhely\\\":\\\"825GB SSD\\\",\\\"Optikai meghajt\\\\u00f3\\\":\\\"Nincs\\\",\\\"H\\\\u00e1l\\\\u00f3zat\\\":\\\"Wi-Fi 6, Bluetooth 5.1\\\"}\"', 'Új generációs játékkonzol, optikai meghajtó nélkül, 825GB SSD-vel.', 'Merülj el a játék új generációjában a PlayStation 5 Digital Edition konzollal. Az erőteljes egyedi AMD processzorok, a nagy sebességű SSD és a DualSense kontroller új perspektívát nyit a konzolos játékokban. A digitális kiadás optikai meghajtó nélkül érkezik, így minden játékot a PlayStation Store-ból kell letöltened.', 189990.00, 5, 'Aktív', 24, 1, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-04-18 13:14:53', NULL, 'PlayStation 5 Digital Edition', 'Új generációs játékkonzol, optikai meghajtó nélkül, 825GB SSD-vel.', 'Sony, Konzol, Konzol'),
(5, 'Xbox Series X', 'xbox-series-x', 189990.00, 7, 2, 'Konzol', 'Microsoft', '\"{\\\"CPU\\\":\\\"AMD Zen 2, 8 mag, 3.8GHz\\\",\\\"GPU\\\":\\\"AMD RDNA 2, 12 TFLOPS\\\",\\\"Mem\\\\u00f3ria\\\":\\\"16GB GDDR6\\\",\\\"T\\\\u00e1rhely\\\":\\\"1TB NVMe SSD\\\",\\\"Optikai meghajt\\\\u00f3\\\":\\\"4K UHD Blu-ray\\\",\\\"H\\\\u00e1l\\\\u00f3zat\\\":\\\"Wi-Fi 6, Bluetooth 5.1\\\"}\"', 'Microsoft legerősebb konzolja 1TB SSD-vel és 4K játékélménnyel.', 'Az Xbox Series X a Microsoft eddigi legerősebb konzolja, amely 4K felbontáson és 120 képkocka/másodperc sebességgel biztosít élménydús játékot. A gyors betöltési idők és a visszafelé kompatibilitás révén kedvenc játékaid új életre kelnek. Az Xbox Game Pass szolgáltatással több száz játékhoz férhetsz hozzá havi előfizetés keretében.', 199990.00, 5, 'Aktív', 24, 1, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:09:06', NULL, 'Xbox Series X', 'Microsoft legerősebb konzolja 1TB SSD-vel és 4K játékélménnyel.', 'Microsoft, Konzol, Konzol'),
(6, 'Nintendo Switch OLED', 'nintendo-switch-oled', 129990.00, 12, 2, 'Konzol', 'Nintendo', '\"{\\\"Kijelz\\\\u0151\\\":\\\"7\\\\\\\" OLED, 1280x720\\\",\\\"Processzor\\\":\\\"NVIDIA Tegra X1\\\",\\\"Mem\\\\u00f3ria\\\":\\\"4GB LPDDR4\\\",\\\"T\\\\u00e1rhely\\\":\\\"64GB (b\\\\u0151v\\\\u00edthet\\\\u0151 microSD)\\\",\\\"Akkumul\\\\u00e1tor\\\":\\\"4310 mAh (4.5-9 \\\\u00f3ra)\\\",\\\"Csatlakoz\\\\u00f3k\\\":\\\"USB-C, HDMI (dokkol\\\\u00f3n)\\\"}\"', 'Továbbfejlesztett Switch konzol OLED kijelzővel és kibővített tárhellyel.', 'A Nintendo Switch OLED modell az eredeti Switch továbbfejlesztett változata, amely 7 colos OLED kijelzővel rendelkezik a még jobb vizuális élményért. A konzol megőrzi a hibrid jellegét, így TV-hez csatlakoztatva és hordozható módban is használhatod. Az állítható állvány, kibővített tárhely és továbbfejlesztett hangszórók teszik teljessé az élményt.', 139990.00, 7, 'Aktív', 24, 0, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:09:20', NULL, 'Nintendo Switch OLED', 'Továbbfejlesztett Switch konzol OLED kijelzővel és kibővített tárhellyel.', 'Nintendo, Konzol, Konzol'),
(7, 'ASUS ROG Swift PG279QM', 'asus-rog-swift-pg279qm', 299990.00, 6, 3, 'Monitor', 'ASUS', '\"{\\\"Kijelz\\\\u0151 m\\\\u00e9ret\\\":\\\"27\\\\\\\"\\\",\\\"Panel t\\\\u00edpus\\\":\\\"IPS\\\",\\\"Felbont\\\\u00e1s\\\":\\\"2560x1440 (WQHD)\\\",\\\"Friss\\\\u00edt\\\\u00e9si r\\\\u00e1ta\\\":\\\"240Hz\\\",\\\"V\\\\u00e1laszid\\\\u0151\\\":\\\"1ms (GtG)\\\",\\\"HDR\\\":\\\"VESA DisplayHDR 400\\\",\\\"Adapt\\\\u00edv szinkron\\\":\\\"NVIDIA G-Sync\\\"}\"', '27\" gaming monitor 240Hz frissítési rátával és G-Sync támogatással.', 'Az ASUS ROG Swift PG279QM a legigényesebb játékosok számára készült monitor. A 27 colos IPS panel 240Hz frissítéssel és 1ms válaszidővel rendelkezik, így tökéletes az e-sport játékokhoz. A NVIDIA G-Sync technológia kiküszöböli a képtörést, a HDR400 támogatás pedig élénk színeket biztosít. Az ergonomikus állvány lehetővé teszi a magasság, dőlésszög és forgatás beállítását a kényelmes használathoz.', 319990.00, 6, 'Aktív', 36, 1, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:07:49', NULL, 'ASUS ROG Swift PG279QM', '27\" gaming monitor 240Hz frissítési rátával és G-Sync támogatással.', 'ASUS, Monitor, Monitor'),
(8, 'LG UltraGear 27GN950-B', 'lg-ultragear-27gn950-b', 279990.00, 4, 3, 'Monitor', 'LG', '\"{\\\"Kijelz\\\\u0151 m\\\\u00e9ret\\\":\\\"27\\\\\\\"\\\",\\\"Panel t\\\\u00edpus\\\":\\\"Nano IPS\\\",\\\"Felbont\\\\u00e1s\\\":\\\"3840x2160 (4K UHD)\\\",\\\"Friss\\\\u00edt\\\\u00e9si r\\\\u00e1ta\\\":\\\"144Hz\\\",\\\"V\\\\u00e1laszid\\\\u0151\\\":\\\"1ms (GtG)\\\",\\\"HDR\\\":\\\"VESA DisplayHDR 600\\\",\\\"Adapt\\\\u00edv szinkron\\\":\\\"FreeSync Premium Pro, G-Sync Compatible\\\"}\"', '27\" 4K UHD Nano IPS monitor 144Hz frissítéssel és HDR600 támogatással.', 'Az LG UltraGear 27GN950-B egy prémium 4K gaming monitor, amely Nano IPS technológiával készült a lenyűgöző vizuális élményért. A 144Hz frissítési frekvencia és az 1ms válaszidő zökkenőmentes játékmenetet biztosít, míg a HDR600 tanúsítvány élénk színeket és részleteket garantál. A monitor AMD FreeSync Premium Pro és NVIDIA G-Sync kompatibilis, így bármilyen videokártyával tökéletesen működik.', 299990.00, 7, 'Aktív', 36, 0, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:07:59', NULL, 'LG UltraGear 27GN950-B', '27\" 4K UHD Nano IPS monitor 144Hz frissítéssel és HDR600 támogatással.', 'LG, Monitor, Monitor'),
(9, 'Samsung Odyssey G5', 'samsung-odyssey-g5', 119990.00, 10, 3, 'Monitor', 'Samsung', '\"{\\\"Kijelz\\\\u0151 m\\\\u00e9ret\\\":\\\"32\\\\\\\"\\\",\\\"Panel t\\\\u00edpus\\\":\\\"VA\\\",\\\"\\\\u00cdvelt kijelz\\\\u0151\\\":\\\"1000R\\\",\\\"Felbont\\\\u00e1s\\\":\\\"2560x1440 (QHD)\\\",\\\"Friss\\\\u00edt\\\\u00e9si r\\\\u00e1ta\\\":\\\"165Hz\\\",\\\"V\\\\u00e1laszid\\\\u0151\\\":\\\"1ms (MPRT)\\\",\\\"Adapt\\\\u00edv szinkron\\\":\\\"AMD FreeSync Premium\\\"}\"', '32\" ívelt QHD gaming monitor 165Hz frissítéssel és 1ms válaszidővel.', 'A Samsung Odyssey G5 ívelt kialakítású monitor tökéletes a belemerülő játékélményhez. A 32 colos VA panel 1000R görbülettel és 2560x1440 felbontással rendelkezik, amely éles képet és széles látószöget biztosít. A 165Hz frissítési ráta és az 1ms válaszidő folyamatos, akadozásmentes játékot garantál, míg az AMD FreeSync Premium technológia kiküszöböli a képtörést.', 139990.00, 14, 'Aktív', 24, 1, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:09:32', NULL, 'Samsung Odyssey G5', '32\" ívelt QHD gaming monitor 165Hz frissítéssel és 1ms válaszidővel.', 'Samsung, Monitor, Monitor'),
(10, 'Razer Huntsman V2', 'razer-huntsman-v2', 64990.00, 8, 10, 'Billentyűzet', 'Razer', '\"{\\\"T\\\\u00edpus\\\":\\\"Optikai mechanikus\\\",\\\"Kapcsol\\\\u00f3k\\\":\\\"Razer Optikai (Piros\\\\\\/Lila)\\\",\\\"Elrendez\\\\u00e9s\\\":\\\"Teljes m\\\\u00e9ret\\\\u0171\\\",\\\"RGB vil\\\\u00e1g\\\\u00edt\\\\u00e1s\\\":\\\"Razer Chroma RGB\\\",\\\"Csukl\\\\u00f3t\\\\u00e1masz\\\":\\\"M\\\\u00e1gneses, pl\\\\u00fcss bor\\\\u00edt\\\\u00e1s\\\\u00fa\\\",\\\"Hangcsillap\\\\u00edt\\\\u00e1s\\\":\\\"Igen, be\\\\u00e9p\\\\u00edtett hab\\\"}\"', 'Optikai kapcsolós gamer billentyűzet hang-csillapítással és RGB világítással.', 'A Razer Huntsman V2 a gyorsaság és a precizitás tökéletes kombinációja. Az optikai kapcsolók 0.2ms működési idővel rendelkeznek, ami villámgyors reakcióidőt biztosít a játékokban. A beépített hangcsillapító hab megszünteti a zavaró billentyűzajokat, a Chroma RGB világítás pedig tökéletesen illeszkedik a játékállomásodhoz. A kényelmes csuklótámasz és a dedikált médiavezérlők teszik teljessé az élményt.', 69990.00, 7, 'Aktív', 24, 0, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-15 17:22:32', NULL, 'Razer Huntsman V2', 'Optikai kapcsolós gamer billentyűzet hang-csillapítással és RGB világítással.', 'Razer, Billentyűzet, Billentyűzet'),
(11, 'HyperX Alloy Origins Core', 'hyperx-alloy-origins-core', 39990.00, 20, 10, 'Billentyűzet', 'HyperX', '\"{\\\"T\\\\u00edpus\\\":\\\"Mechanikus\\\",\\\"Kapcsol\\\\u00f3k\\\":\\\"HyperX Red (Line\\\\u00e1ris)\\\",\\\"Elrendez\\\\u00e9s\\\":\\\"Tenkeyless (TKL)\\\",\\\"V\\\\u00e1z\\\":\\\"Rep\\\\u00fcl\\\\u0151g\\\\u00e9p-min\\\\u0151s\\\\u00e9g\\\\u0171 alum\\\\u00ednium\\\",\\\"RGB vil\\\\u00e1g\\\\u00edt\\\\u00e1s\\\":\\\"Egyedileg programozhat\\\\u00f3\\\",\\\"K\\\\u00e1bel\\\":\\\"Lev\\\\u00e1laszthat\\\\u00f3 USB-C\\\"}\"', 'Alumínium vázas TKL mechanikus billentyűzet HyperX Red kapcsolókkal.', 'A HyperX Alloy Origins Core egy kompakt és tartós TKL (Tenkeyless) billentyűzet, amely repülőgép-minőségű alumínium vázzal rendelkezik. A HyperX Red lineáris kapcsolók ideálisak a gyors és csendes játékélményhez. A három fokozatú állíthatóságnak köszönhetően mindig megtalálhatod a legkényelmesebb pozíciót, míg a fényes RGB háttérvilágítás testreszabható a HyperX NGENUITY szoftverrel.', 44990.00, 11, 'Aktív', 24, 1, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-15 17:22:32', NULL, 'HyperX Alloy Origins Core', 'Alumínium vázas TKL mechanikus billentyűzet HyperX Red kapcsolókkal.', 'HyperX, Billentyűzet, Billentyűzet'),
(12, 'Logitech G Pro X Superlight', 'logitech-g-pro-x-superlight', 57990.00, 12, 10, 'Egér', 'Logitech', '\"{\\\"Szenzor\\\":\\\"HERO 25K\\\",\\\"Felbont\\\\u00e1s\\\":\\\"25.600 DPI\\\",\\\"S\\\\u00faly\\\":\\\"63g\\\",\\\"Vezet\\\\u00e9k n\\\\u00e9lk\\\\u00fcli\\\":\\\"LIGHTSPEED\\\",\\\"Akkumul\\\\u00e1tor\\\":\\\"70 \\\\u00f3ra\\\",\\\"Gombok sz\\\\u00e1ma\\\":\\\"5\\\"}\"', 'Ultrakönnyű vezeték nélküli e-sport egér, mindössze 63 gramm súllyal.', 'A Logitech G Pro X Superlight az eddigi legkönnyebb vezeték nélküli profi egér a Logitechtől. A mindössze 63 grammos súly és az aerodinamikus kialakítás tökéletes irányítást és gyorsaságot biztosít versenyhelyzetekben. A HERO 25K szenzor 25.600 DPI felbontása és a LIGHTSPEED vezeték nélküli technológia professzionális teljesítményt nyújt, 70 órás üzemidővel.', 64990.00, 11, 'Aktív', 24, 1, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:12:07', NULL, 'Logitech G Pro X Superlight', 'Ultrakönnyű vezeték nélküli e-sport egér, mindössze 63 gramm súllyal.', 'Logitech, Egér, Egér'),
(13, 'Razer DeathAdder V3 Pro', 'razer-deathadder-v3-pro', 54990.00, 8, 10, 'Egér', 'Razer', '\"{\\\"Szenzor\\\":\\\"Focus Pro 30K\\\",\\\"Felbont\\\\u00e1s\\\":\\\"30.000 DPI\\\",\\\"S\\\\u00faly\\\":\\\"63g\\\",\\\"Vezet\\\\u00e9k n\\\\u00e9lk\\\\u00fcli\\\":\\\"HyperSpeed\\\",\\\"Akkumul\\\\u00e1tor\\\":\\\"90 \\\\u00f3ra\\\",\\\"Gombok sz\\\\u00e1ma\\\":\\\"5\\\"}\"', 'Vezeték nélküli ergonomikus egér 90 millió kattintást bíró kapcsolókkal.', 'A Razer DeathAdder V3 Pro a legendás DeathAdder ergonomikus formáját ötvözi a legújabb technológiákkal. Az új optikai kapcsolók 90 millió kattintást bírnak, a Focus Pro 30K optikai szenzor pedig páratlan precizitást biztosít. Az egér HyperSpeed vezeték nélküli kapcsolattal rendelkezik, amely ugyanolyan gyors, mint a vezetékes megoldások. A 63 grammos súly és az ergonomikus kialakítás hosszú játékmenetekhez is ideális.', 59990.00, 8, 'Aktív', 24, 0, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:10:20', NULL, 'Razer DeathAdder V3 Pro', 'Vezeték nélküli ergonomikus egér 90 millió kattintást bíró kapcsolókkal.', 'Razer, Egér, Egér'),
(14, 'SteelSeries Rival 3', 'steelseries-rival-3', 14990.00, 25, 10, 'Egér', 'SteelSeries', '\"{\\\"Szenzor\\\":\\\"TrueMove Core\\\",\\\"Felbont\\\\u00e1s\\\":\\\"8.500 DPI\\\",\\\"S\\\\u00faly\\\":\\\"77g\\\",\\\"K\\\\u00e1bel\\\":\\\"1.8m gum\\\\u00edrozott\\\",\\\"Kapcsol\\\\u00f3k\\\":\\\"60 milli\\\\u00f3 kattint\\\\u00e1s\\\",\\\"Gombok sz\\\\u00e1ma\\\":\\\"6\\\"}\"', 'Megfizethető gaming egér TrueMove Core szenzorral és RGB világítással.', 'A SteelSeries Rival 3 tökéletes belépő szintű gaming egér, amely megfizethető áron kínál kiváló teljesítményt. A TrueMove Core optikai szenzor 8.500 DPI-vel működik, a mechanikus kapcsolók pedig 60 millió kattintásra vannak tervezve. Az egér könnyű, mindössze 77 grammos, és ergonomikus kialakítása hosszú játékidőt tesz lehetővé. A PrismSync RGB világítás testreszabható a SteelSeries Engine szoftverrel.', 17990.00, 17, 'Aktív', 24, 1, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:10:36', NULL, 'SteelSeries Rival 3', 'Megfizethető gaming egér TrueMove Core szenzorral és RGB világítással.', 'SteelSeries, Egér, Egér'),
(15, 'HyperX Cloud Alpha', 'hyperx-cloud-alpha', 34990.00, 20, 6, 'Fejhallgató', 'HyperX', '\"{\\\"Hangsz\\\\u00f3r\\\\u00f3k\\\":\\\"50mm dinamikus, dupla kamr\\\\u00e1s\\\",\\\"Frekvenciav\\\\u00e1lasz\\\":\\\"13Hz-27.000Hz\\\",\\\"Csatlakoz\\\\u00e1s\\\":\\\"3.5mm jack\\\",\\\"Mikrofon\\\":\\\"Lecsatolhat\\\\u00f3, zajsz\\\\u0171r\\\\u0151s\\\",\\\"K\\\\u00e1bel\\\":\\\"1.3m + 2m hosszabb\\\\u00edt\\\\u00f3\\\",\\\"S\\\\u00faly\\\":\\\"336g\\\"}\"', 'Prémium gaming fejhallgató dupla kamrás hangzással és lecsatolható mikrofonnal.', 'A HyperX Cloud Alpha dupla kamrás hangzástechnológiája a mély basszusokat és a tiszta magasakat elkülönítve kezeli, így kivételes hangminőséget biztosít. A memóriahabos fülpárnák hosszú játékmenetek során is kényelmet nyújtanak, a lecsatolható mikrofon pedig Discord és TeamSpeak tanúsítvánnyal rendelkezik a kiváló kommunikációért. Az alumínium váz tartós, mégis könnyű kialakítást biztosít.', 39990.00, 13, 'Aktív', 24, 1, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:10:54', NULL, 'HyperX Cloud Alpha', 'Prémium gaming fejhallgató dupla kamrás hangzással és lecsatolható mikrofonnal.', 'HyperX, Fejhallgató, Fejhallgató'),
(16, 'Logitech G Pro X', 'logitech-g-pro-x', 44990.00, 10, 10, 'Fejhallgató', 'Logitech', '\"{\\\"Hangsz\\\\u00f3r\\\\u00f3k\\\":\\\"50mm PRO-G\\\",\\\"Frekvenciav\\\\u00e1lasz\\\":\\\"20Hz-20.000Hz\\\",\\\"Csatlakoz\\\\u00e1s\\\":\\\"3.5mm jack \\\\\\/ USB\\\",\\\"Mikrofon\\\":\\\"Lecsatolhat\\\\u00f3, Blue VO!CE\\\",\\\"Surround\\\":\\\"DTS Headphone:X 2.0\\\",\\\"S\\\\u00faly\\\":\\\"320g\\\"}\"', 'Profi vezetékes fejhallgató Blue VO!CE mikrofontehnológiával.', 'A Logitech G Pro X a profi e-sportolók igényeire szabott gaming fejhallgató. A Blue VO!CE mikrofontehnológia valósidejű hangszűrést és -feldolgozást biztosít a kristálytiszta kommunikációért. A 7.1-es virtuális térhatású hangzás pontos helymeghatározást tesz lehetővé a játékokban, míg a DTS Headphone:X 2.0 technológia élethű hangélményt nyújt.', 49990.00, 10, 'Aktív', 24, 1, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:11:13', NULL, 'Logitech G Pro X', 'Profi vezetékes fejhallgató Blue VO!CE mikrofontehnológiával.', 'Logitech, Fejhallgató, Fejhallgató'),
(17, 'SteelSeries Arctis Nova Pro Wireless', 'steelseries-arctis-nova-pro-wireless', 129990.00, 5, 10, 'Fejhallgató', 'SteelSeries', '\"{\\\"Hangsz\\\\u00f3r\\\\u00f3k\\\":\\\"High Fidelity Drivers\\\",\\\"Zajsz\\\\u0171r\\\\u00e9s\\\":\\\"Akt\\\\u00edv zajsz\\\\u0171r\\\\u00e9s (ANC)\\\",\\\"Csatlakoz\\\\u00e1s\\\":\\\"2.4GHz \\\\\\/ Bluetooth 5.0\\\",\\\"Mikrofon\\\":\\\"Beh\\\\u00fazhat\\\\u00f3 ClearCast Gen 2\\\",\\\"Akkumul\\\\u00e1tor\\\":\\\"2 cser\\\\u00e9lhet\\\\u0151, 20 \\\\u00f3ra\\\",\\\"S\\\\u00faly\\\":\\\"338g\\\"}\"', 'Csúcskategóriás vezeték nélküli fejhallgató aktív zajszűréssel és cserélhető akkumulátorral.', 'A SteelSeries Arctis Nova Pro Wireless a gaming fejhallgatók új generációját képviseli. Az aktív zajszűrés (ANC) kizárja a külvilág zavaró hangjait, míg a különleges hangszórók kivételes minőségű hangzást biztosítanak. A rendszer két cserélhető akkumulátorral érkezik, amelyek egyike mindig tölthető a dokkolóban, így soha nem fogsz kényelmetlenül lemerülni játék közben. A vezeték nélküli bázisállomás 2.4GHz-es és Bluetooth kapcsolatot is biztosít.', 139990.00, 7, 'Aktív', 24, 0, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:11:26', NULL, 'SteelSeries Arctis Nova Pro Wireless', 'Csúcskategóriás vezeték nélküli fejhallgató aktív zajszűréssel és cserélhető akkumulátorral.', 'SteelSeries, Fejhallgató, Fejhallgató'),
(18, 'Elden Ring - PS5', 'elden-ring-ps5', 27990.00, 30, 7, 'Videójáték', 'FromSoftware', '\"{\\\"Platform\\\":\\\"PlayStation 5\\\",\\\"M\\\\u0171faj\\\":\\\"Akci\\\\u00f3 RPG\\\",\\\"Megjelen\\\\u00e9s\\\":\\\"2022\\\",\\\"J\\\\u00e1t\\\\u00e9kosok sz\\\\u00e1ma\\\":\\\"1 (+ online multi)\\\",\\\"Korhat\\\\u00e1r\\\":\\\"PEGI 16\\\",\\\"Nyelv\\\":\\\"Magyar feliratos\\\"}\"', 'Nyílt világú akció-RPG a FromSoftware-től és George R. R. Martin együttműködésében.', 'Az Elden Ring Hidetaka Miyazaki és George R. R. Martin közös alkotása, amely egy hatalmas, mitikus világgal és gazdag történettel várja a játékosokat. A játékban saját karakterünket alakítva járhatjuk be a Köztes Földeket, ahol veszélyes ellenfelek, lenyűgöző főellenségek és számos egyedi karakter vár ránk. A játék szabadságot ad a játékosoknak a kaland megélésére, lehetővé téve a saját játékstílus kialakítását.', 27990.00, 11, 'Aktív', 6, 1, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:05:54', NULL, 'Elden Ring - PS5', 'Nyílt világú akció-RPG a FromSoftware-től és George R. R. Martin együttműködésében.', 'FromSoftware, Videójáték, Videójáték'),
(19, 'The Legend of Zelda: Tears of the Kingdom - Nintendo Switch', 'the-legend-of-zelda-tears-of-the-kingdom-nintendo-switch', 19990.00, 25, 7, 'Videójáték', 'Nintendo', '\"{\\\"Platform\\\":\\\"Nintendo Switch\\\",\\\"M\\\\u0171faj\\\":\\\"Akci\\\\u00f3-kaland\\\",\\\"Megjelen\\\\u00e9s\\\":\\\"2023\\\",\\\"J\\\\u00e1t\\\\u00e9kosok sz\\\\u00e1ma\\\":\\\"1\\\",\\\"Korhat\\\\u00e1r\\\":\\\"PEGI 12\\\",\\\"Nyelv\\\":\\\"Angol (feliratos)\\\"}\"', 'A legendás Zelda sorozat legújabb fejezete a Nintendo Switch konzolra.', 'A The Legend of Zelda: Tears of the Kingdom a Breath of the Wild folytatása, amely új kalandokra viszi a játékosokat Hyrule birodalmában. Link ezúttal a levegőben úszó szigeteket is felfedezheti, új képességeket tanulhat és még több rejtvényt oldhat meg. A játék továbbfejlesztett fizikai rendszere és a tárgyak kombinálásának lehetősége számtalan kreatív megoldást kínál a játékosok számára.', 21990.00, 9, 'Aktív', 6, 1, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:06:09', NULL, 'The Legend of Zelda: Tears of the Kingdom - Nintendo Switch', 'A legendás Zelda sorozat legújabb fejezete a Nintendo Switch konzolra.', 'Nintendo, Videójáték, Videójáték'),
(20, 'Cyberpunk 2077 - Xbox Series X', 'cyberpunk-2077-xbox-series-x', 24990.00, 15, 7, 'Videójáték', 'CD Projekt Red', '\"{\\\"Platform\\\":\\\"Xbox Series X\\\\\\/S\\\",\\\"M\\\\u0171faj\\\":\\\"RPG\\\",\\\"Megjelen\\\\u00e9s\\\":\\\"2020 (Next-gen update: 2022)\\\",\\\"J\\\\u00e1t\\\\u00e9kosok sz\\\\u00e1ma\\\":\\\"1\\\",\\\"Korhat\\\\u00e1r\\\":\\\"PEGI 18\\\",\\\"Nyelv\\\":\\\"Magyar felirat \\\\u00e9s szinkron\\\"}\"', 'Futurisztikus, nyílt világú RPG a CD Projekt Red-től, next-gen frissítéssel.', 'Merülj el Night City veszélyes világában, ahol a hatalom, a luxus és a testmódosítások megszállottjai találkoznak. A Cyberpunk 2077-ben V bőrébe bújva egy halhatatlanság-kulcsot kereső zsoldos kalandjait élhetjük át. A játék hatalmas, szabadon bejárható metropoliszt kínál, ahol döntéseink alakítják a történetet és karakterünk fejlődését. Az Xbox Series X verzió next-gen frissítéssel érkezik, amely kihasználja a konzol teljes erejét.', 24990.00, 20, 'Aktív', 6, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:11:39', NULL, 'Cyberpunk 2077 - Xbox Series X', 'Futurisztikus, nyílt világú RPG a CD Projekt Red-től, next-gen frissítéssel.', 'CD Projekt Red, Videójáték, Videójáték'),
(21, 'Secretlab TITAN Evo 2022', 'secretlab-titan-evo-2022', 199990.00, 5, 8, 'Gamer Szék', 'Secretlab', '\"{\\\"Anyag\\\":\\\"NEO\\\\u2122 Hybrid Leatherette \\\\\\/ SoftWeave\\\\u2122 Plus\\\",\\\"Terhelhet\\\\u0151s\\\\u00e9g\\\":\\\"180 kg\\\",\\\"Kart\\\\u00e1maszok\\\":\\\"4D m\\\\u00e1gneses\\\",\\\"D\\\\u0151l\\\\u00e9ssz\\\\u00f6g\\\":\\\"165\\\\u00b0\\\",\\\"Magass\\\\u00e1g\\\\u00e1ll\\\\u00edt\\\\u00e1s\\\":\\\"Class 4 hidraulikus\\\",\\\"S\\\\u00faly\\\":\\\"37.5 kg\\\"}\"', 'Prémium gamer szék 4D kartámaszokkal és mágneses fejtámasszal.', 'A Secretlab TITAN Evo 2022 a legújabb generációs gamer szék, amely ötvözi a kényelmet és a tartósságot. A szabadalmaztatott puhébb hideg formázott hab tökéletes támogatást nyújt a hosszú játékmenetek során. A 4D kartámaszok és a mágneses memóriahabos fejtámasz testre szabható kényelmet biztosít, míg a továbbfejlesztett derékpárna dinamikusan alkalmazkodik a mozgásodhoz.', 199990.00, 5, 'Aktív', 36, 1, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:15:30', NULL, 'Secretlab TITAN Evo 2022', 'Prémium gamer szék 4D kartámaszokkal és mágneses fejtámasszal.', 'Secretlab, Gamer Szék, Gamer Szék'),
(22, 'noblechairs HERO', 'noblechairs-hero', 159990.00, 20, 8, 'Gamer Szék', 'noblechairs', '\"{\\\"Anyag\\\":\\\"PU b\\\\u0151r \\\\\\/ Val\\\\u00f3di b\\\\u0151r opci\\\\u00f3\\\",\\\"Terhelhet\\\\u0151s\\\\u00e9g\\\":\\\"150 kg\\\",\\\"Kart\\\\u00e1maszok\\\":\\\"4D\\\",\\\"D\\\\u0151l\\\\u00e9ssz\\\\u00f6g\\\":\\\"135\\\\u00b0\\\",\\\"Der\\\\u00e9kt\\\\u00e1masz\\\":\\\"Be\\\\u00e9p\\\\u00edtett, \\\\u00e1ll\\\\u00edthat\\\\u00f3\\\",\\\"S\\\\u00faly\\\":\\\"33 kg\\\"}\"', 'Prémium minőségű gamer szék beépített állítható deréktámasszal.', 'A noblechairs HERO a legigényesebb gamerek számára készült szék, amely tökéletes kombinációja a stílusnak és a funkcionalitásnak. A beépített, teljesen állítható deréktámasz és a bőséges ülőfelület hosszú játékmenetek során is biztosítja a kényelmet. A csúcsminőségű PU bőr borítás elegáns megjelenést és tartósságot biztosít, míg a hideg habos technológia optimális alátámasztást nyújt.', 169990.00, 6, 'Aktív', 24, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-15 18:09:13', NULL, 'noblechairs HERO', 'Prémium minőségű gamer szék beépített állítható deréktámasszal.', 'noblechairs, Gamer Szék, Gamer Szék'),
(23, 'AKRacing Core EX', 'akracing-core-ex', 119990.00, 15, 8, 'Gamer Szék', 'AKRacing', '\"{\\\"Anyag\\\":\\\"PU b\\\\u0151r \\\\\\/ Sz\\\\u00f6vet\\\",\\\"Terhelhet\\\\u0151s\\\\u00e9g\\\":\\\"150 kg\\\",\\\"Kart\\\\u00e1maszok\\\":\\\"3D\\\",\\\"D\\\\u0151l\\\\u00e9ssz\\\\u00f6g\\\":\\\"180\\\\u00b0\\\",\\\"Magass\\\\u00e1g\\\\u00e1ll\\\\u00edt\\\\u00e1s\\\":\\\"Class 4 hidraulikus\\\",\\\"S\\\\u00faly\\\":\\\"25 kg\\\"}\"', 'Megfizethető, mégis prémium minőségű gamer szék.', 'Az AKRacing Core EX egy elérhető árú, de minőségi gamer szék, amely tökéletes választás a mindennapi használatra. A hideg habbal töltött ülés és háttámla hosszú órákon át biztosítja a kényelmet, míg az acél váz és az ötágú alumínium talp garantálja a tartósságot. A szék 180 fokig dönthető háttámlával, magasságállítással és 3D kartámaszokkal rendelkezik.', 119990.00, 17, 'Aktív', 24, 1, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:12:20', NULL, 'AKRacing Core EX', 'Megfizethető, mégis prémium minőségű gamer szék.', 'AKRacing, Gamer Szék, Gamer Szék'),
(24, 'NVIDIA GeForce RTX 4080 SUPER', 'nvidia-geforce-rtx-4080-super', 599990.00, 4, 9, 'Videokártya', 'NVIDIA', '\"{\\\"GPU\\\":\\\"NVIDIA Ada Lovelace\\\",\\\"CUDA Magok\\\":\\\"10240\\\",\\\"Mem\\\\u00f3ria\\\":\\\"16GB GDDR6X\\\",\\\"Mem\\\\u00f3ria S\\\\u00e1vsz\\\\u00e9less\\\\u00e9g\\\":\\\"736 GB\\\\\\/s\\\",\\\"Csatol\\\\u00f3fel\\\\u00fclet\\\":\\\"PCIe 4.0 x16\\\",\\\"T\\\\u00e1pig\\\\u00e9ny\\\":\\\"320W\\\"}\"', 'Csúcskategóriás grafikus kártya 16GB GDDR6X memóriával.', 'Az NVIDIA GeForce RTX 4080 SUPER a legújabb Ada Lovelace architektúrán alapuló videokártya, amely kivételes teljesítményt nyújt mind a 4K játékhoz, mind a kreatív munkákhoz. A 16GB GDDR6X memória és az NVIDIA DLSS 3.5 technológia zökkenőmentes játékélményt biztosít a legigényesebb játékokban is. A sugárkövetés és az AI-alapú képjavítás új szintre emeli a vizuális élményt.', 599990.00, 8, 'Aktív', 36, 1, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-15 19:48:58', NULL, 'NVIDIA GeForce RTX 4080 SUPER', 'Csúcskategóriás grafikus kártya 16GB GDDR6X memóriával.', 'NVIDIA, Videokártya, NVIDIA GeForce RTX 4080 SUPER'),
(25, 'AMD Ryzen 9 7950X', 'amd-ryzen-9-7950x', 249990.00, 6, 9, 'Processzor', 'AMD', '\"{\\\"Architekt\\\\u00fara\\\":\\\"Zen 4\\\",\\\"Magok\\\\\\/Sz\\\\u00e1lak\\\":\\\"16\\\\\\/32\\\",\\\"Alap \\\\u00f3rajel\\\":\\\"4.5GHz\\\",\\\"Turb\\\\u00f3 \\\\u00f3rajel\\\":\\\"5.7GHz\\\",\\\"Cache\\\":\\\"80MB\\\",\\\"TDP\\\":\\\"170W\\\"}\"', 'Csúcsteljesítményű 16 magos processzor 5.7GHz-es órajellel.', 'Az AMD Ryzen 9 7950X a Zen 4 architektúrán alapuló processzor, amely 16 maggal és 32 szállal rendelkezik. Az 5.7GHz-es maximális órajel és a 80MB cache kivételes teljesítményt biztosít mind a játékokban, mind a professzionális alkalmazásokban. A processzor támogatja a PCIe 5.0 és DDR5 technológiákat, így jövőbiztos megoldást nyújt a legigényesebb felhasználók számára is.', 279990.00, 11, 'Aktív', 36, 1, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-15 17:22:32', NULL, 'AMD Ryzen 9 7950X', 'Csúcsteljesítményű 16 magos processzor 5.7GHz-es órajellel.', 'AMD, Processzor, AMD Ryzen 9 7950X'),
(26, 'Samsung 990 PRO 2TB NVMe SSD', 'samsung-990-pro-2tb-nvme-ssd', 89990.00, 10, 9, 'SSD', 'Samsung', '\"{\\\"Kapacit\\\\u00e1s\\\":\\\"2TB\\\",\\\"Csatlakoz\\\\u00f3\\\":\\\"M.2 NVMe PCIe 4.0\\\",\\\"Olvas\\\\u00e1si sebess\\\\u00e9g\\\":\\\"7450 MB\\\\\\/s\\\",\\\"\\\\u00cdr\\\\u00e1si sebess\\\\u00e9g\\\":\\\"6900 MB\\\\\\/s\\\",\\\"NAND t\\\\u00edpus\\\":\\\"V-NAND 3-bit MLC\\\",\\\"MTBF\\\":\\\"1.5 milli\\\\u00f3 \\\\u00f3ra\\\"}\"', 'Ultragyors NVMe SSD 7450 MB/s olvasási sebességgel.', 'A Samsung 990 PRO a legújabb PCIe 4.0 NVMe SSD, amely lenyűgöző 7450 MB/s olvasási és 6900 MB/s írási sebességet kínál. A 2TB kapacitás bőséges tárhelyet biztosít játékok, alkalmazások és egyéb fájlok számára. A Samsung V-NAND technológia és az optimalizált vezérlő hosszú élettartamot és megbízhatóságot garantál, míg a Dynamic Thermal Guard védelmet nyújt a túlmelegedés ellen.', 99990.00, 10, 'Aktív', 60, 0, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-15 17:22:32', NULL, 'Samsung 990 PRO 2TB NVMe SSD', 'Ultragyors NVMe SSD 7450 MB/s olvasási sebességgel.', 'Samsung, SSD, Samsung 990 PRO 2TB NVMe SSD'),
(27, 'Razer Gigantus V2 XXL', 'razer-gigantus-v2-xxl', 16990.00, 20, 10, 'Egérpad', 'Razer', '\"{\\\"M\\\\u00e9ret\\\":\\\"940 x 410 mm (XXL)\\\",\\\"Vastags\\\\u00e1g\\\":\\\"3 mm\\\",\\\"Anyag\\\":\\\"Mikrosz\\\\u00f6v\\\\u00f6tt textil\\\",\\\"Alap\\\":\\\"Cs\\\\u00fasz\\\\u00e1sg\\\\u00e1tl\\\\u00f3 gumi\\\",\\\"Szeg\\\\u00e9ly\\\":\\\"Varrott\\\",\\\"Fel\\\\u00fclet t\\\\u00edpusa\\\":\\\"Hibrid (sebess\\\\u00e9g \\\\u00e9s kontroll)\\\"}\"', 'Extra nagy méretű gamer egérpad optimalizált szövetfelülettel.', 'A Razer Gigantus V2 XXL egy prémium minőségű, asztalt borító egérpad, amely optimális felületet biztosít az egerek számára. A mikroszövött felület tökéletes egyensúlyt teremt a sebesség és a kontroll között, míg a csúszásgátló gumialap megakadályozza az elmozdulást. Az egérpad 3 mm vastag habos belső rétege kényelmes támaszt nyújt a csuklónak a hosszú játékmenetek során.', 16990.00, 12, 'Aktív', 12, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:12:49', NULL, 'Razer Gigantus V2 XXL', 'Extra nagy méretű gamer egérpad optimalizált szövetfelülettel.', 'Razer, Egérpad, Kiegészítő'),
(28, 'Glorious Model O Wireless', 'glorious-model-o-wireless', 34990.00, 15, 10, 'Egér', 'Glorious', '\"{\\\"Szenzor\\\":\\\"BAMF 19K DPI\\\",\\\"S\\\\u00faly\\\":\\\"69g\\\",\\\"Csatlakoz\\\\u00e1s\\\":\\\"2.4GHz vezet\\\\u00e9k n\\\\u00e9lk\\\\u00fcli\\\",\\\"Akkumul\\\\u00e1tor\\\":\\\"71 \\\\u00f3ra\\\",\\\"Kapcsol\\\\u00f3k\\\":\\\"Glorious mechanikus (80M)\\\",\\\"M\\\\u00e9ret\\\":\\\"128 x 66 x 37.5 mm\\\"}\"', 'Ultrakönnyű (69g) vezeték nélküli egér méhsejt dizájnnal.', 'A Glorious Model O Wireless a legnépszerűbb könnyű gaming egér vezeték nélküli változata. A mindössze 69 grammos súly és a méhsejt kialakítás tökéletes irányíthatóságot biztosít, míg a BAMF szenzor precíz követést és alacsony látenciát garantál. Az egér 71 órás üzemidővel rendelkezik, és a Glorious szoftverrel testreszabható RGB világítást és gombfunkciókat kínál.', 39990.00, 13, 'Aktív', 24, 1, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:13:33', NULL, 'Glorious Model O Wireless', 'Ultrakönnyű (69g) vezeték nélküli egér méhsejt dizájnnal.', 'Glorious, Egér, Kiegészítő'),
(29, 'Blue Yeti X', 'blue-yeti-x', 49990.00, 8, 10, 'Mikrofon', 'Blue Microphones', '\"{\\\"T\\\\u00edpus\\\":\\\"Kondenz\\\\u00e1tor\\\",\\\"Kapszul\\\\u00e1k\\\":\\\"4 kapszul\\\\u00e1s\\\",\\\"Ir\\\\u00e1nykarakterisztik\\\\u00e1k\\\":\\\"Kardioid, K\\\\u00e9tir\\\\u00e1ny\\\\u00fa, G\\\\u00f6mbkarakterisztika, Sztere\\\\u00f3\\\",\\\"Mintav\\\\u00e9telez\\\\u00e9s\\\":\\\"24-bit\\\\\\/48kHz\\\",\\\"Csatlakoz\\\\u00e1s\\\":\\\"USB\\\",\\\"Monitoroz\\\\u00e1s\\\":\\\"Nullak\\\\u00e9sleltet\\\\u00e9s\\\\u0171 fejhallgat\\\\u00f3 kimenet\\\"}\"', 'Professzionális minőségű USB mikrofon streameléshez és podcastokhoz.', 'A Blue Yeti X egy csúcsminőségű négy kapszulás kondenzátor mikrofon, amely professzionális hangminőséget biztosít a játékközvetítésekhez, podcastokhoz és YouTube-videókhoz. A valós idejű LED mérővel könnyen beállíthatod a megfelelő hangerőt, a Blue VO!CE technológia pedig hangeffektusok és szűrők széles választékát kínálja. A mikrofon négy iránykarakterisztikával rendelkezik, így bármilyen felvételi helyzethez alkalmazkodik.', 54990.00, 9, 'Aktív', 24, 1, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, '2025-03-15 17:22:32', '2025-03-22 16:14:43', NULL, 'Blue Yeti X', 'Professzionális minőségű USB mikrofon streameléshez és podcastokhoz.', 'Blue Microphones, Mikrofon, Kiegészítő');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `alt` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `is_primary`, `alt`, `created_at`, `updated_at`) VALUES
(89, 22, '/storage/products/tBgytyJRPktVlED4CrlEsXD0qj0hAEAmuYrpNzYP.webp', 1, NULL, '2025-03-15 19:19:29', '2025-03-15 19:19:29'),
(90, 2, '/storage/products/AKpAXe6bVzKjP55j9cqC1nwchdTUU4gcEJTVv0G4.webp', 1, NULL, '2025-03-15 19:21:28', '2025-03-15 19:21:28'),
(91, 4, '/storage/products/AMxteDUVXBNfUvcElPWuM2OOFl68aSVhrktolw5k.png', 1, NULL, '2025-03-15 19:27:52', '2025-03-15 19:27:52'),
(92, 5, '/storage/products/nWtxE6x4bQTtGnkYtAeFPfV7D37XaawzCHb6WawG.webp', 1, NULL, '2025-03-15 19:28:39', '2025-03-15 19:28:39'),
(93, 7, '/storage/products/nqIWKBJSE4JczzvL0zkKngiOLUl0fPmPIRCOTQmN.jpg', 1, NULL, '2025-03-15 19:30:55', '2025-03-15 19:30:55'),
(94, 6, '/storage/products/29VVILkxViIT53ZsCxgXMiIPNR0VHU5004TzsNRO.jpg', 1, NULL, '2025-03-15 19:31:04', '2025-03-15 19:31:04'),
(95, 8, '/storage/products/s6JuCDpIHcuzlh7o3umnF71FToO9w4LVBvdbrFPb.jpg', 1, NULL, '2025-03-15 19:32:00', '2025-03-15 19:32:00'),
(96, 9, '/storage/products/5dNz1enLO6YzeXFySJgPj8Td3zShT9lPJHYaq6NI.webp', 1, NULL, '2025-03-15 19:32:32', '2025-03-15 19:32:32'),
(97, 10, '/storage/products/Yfk12UpuBwcTbEORMsReXBJVa5GgwyUaBI7M3h6k.jpg', 1, NULL, '2025-03-15 19:33:01', '2025-03-15 19:33:01'),
(98, 11, '/storage/products/txAhLsltqUWNJPGUs152odWiw5TEcneTCwYAHRRw.jpg', 1, NULL, '2025-03-15 19:33:35', '2025-03-15 19:33:35'),
(99, 12, '/storage/products/FV9edy0UWD1EMzMw0PrNdiptXbG57NHWY6mcwN8N.jpg', 1, NULL, '2025-03-15 19:33:58', '2025-03-15 19:33:58'),
(100, 13, '/storage/products/ld7UqWRpihBmNPCWYhmaMBDyoTqmpXiRsDjQPEZX.jpg', 1, NULL, '2025-03-15 19:34:24', '2025-03-15 19:34:24'),
(101, 14, '/storage/products/uFSPQhzU8gdxK8B6tP8GP8oUdjjMpqzyFBE6MXbZ.webp', 1, NULL, '2025-03-15 19:35:09', '2025-03-15 19:35:09'),
(102, 15, '/storage/products/joM9XyP8bZgssfUiHg89LWZRGD42GwPR4Oev4SFx.jpg', 1, NULL, '2025-03-15 19:37:20', '2025-03-15 19:37:20'),
(103, 16, '/storage/products/AjsMWr0xYGf1785r8vxeNuavkUJY2nkQK4gr54Vy.jpg', 1, NULL, '2025-03-15 19:37:50', '2025-03-15 19:37:50'),
(104, 17, '/storage/products/itVRqlqqMHyayXzs6aBvtcoBwOxvwJyIn6G0OYKR.png', 1, NULL, '2025-03-15 19:38:20', '2025-03-15 19:38:20'),
(105, 18, '/storage/products/iQf6JkbeRaHuDHTbgh7u6HZfeWRAPECMHit98mBz.jpg', 1, NULL, '2025-03-15 19:38:59', '2025-03-15 19:38:59'),
(106, 19, '/storage/products/OrND1o14zgCWQDKq2IDjou9yAhrfUeRCT31dmIpt.webp', 1, NULL, '2025-03-15 19:39:43', '2025-03-15 19:39:43'),
(107, 20, '/storage/products/rmdbUNPAsebSosjieSRBCyU6FMOwlNKCRW52W4H7.jpg', 1, NULL, '2025-03-15 19:40:25', '2025-03-15 19:40:25'),
(108, 21, '/storage/products/lsZTcVWcuGRlIg86QWhNFXcl2N8lJHcxzqiAiSgh.webp', 1, NULL, '2025-03-15 19:41:09', '2025-03-15 19:41:09'),
(109, 23, '/storage/products/Z0XkfRU9AjkcZ2bvVTClqmvNRAK1QXUp8Mb98baP.avif', 1, NULL, '2025-03-15 19:41:54', '2025-03-15 19:41:54'),
(110, 24, '/storage/products/4Lvw4QLV7zSvePfTJKFytTYkKDNpY54pQ1NaUuQ8.jpg', 1, NULL, '2025-03-15 19:48:58', '2025-03-15 19:48:58'),
(111, 25, '/storage/products/QVzp8AGwlOswkdFjFYS762HhFc3bY9C2ywXdk4iQ.jpg', 1, NULL, '2025-03-15 19:49:34', '2025-03-15 19:49:34'),
(112, 26, '/storage/products/gh4gYCqFDVOdVoCvj1KABjIzBTeXvXym9uLnsLks.webp', 1, NULL, '2025-03-15 19:50:24', '2025-03-15 19:50:24'),
(113, 27, '/storage/products/5yCissO6W3Blv0QQd0Iw8BEIk4wuudSkVmthuTaC.jpg', 1, NULL, '2025-03-15 19:51:01', '2025-03-15 19:51:01'),
(114, 28, '/storage/products/iS92MacrO50vQFhawLs5qrzp6AjGfr94vkcxqBqQ.jpg', 1, NULL, '2025-03-15 19:51:39', '2025-03-15 19:51:39'),
(115, 29, '/storage/products/PJ04o76ODQBy3ITKbPAeegTISPiEZbXJucaj7LMI.webp', 1, NULL, '2025-03-15 19:52:05', '2025-03-15 19:52:05'),
(116, 1, '/storage/products/b6hmOuEqd674Sy40gr1N7XXhwZ8RpDPnh5AW1gk8.webp', 1, NULL, '2025-03-15 19:52:29', '2025-03-15 19:52:29');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `related_products`
--

CREATE TABLE `related_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `related_product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('VfyQNyO6xtY0RTalYffUmbTvUY4aACeaSeiu3RdC', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 OPR/117.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia1U5TjZSdWRIRjd4cFY0UHNUQnRQNVYweDBTd3ZDMzhrNGMweGpkaiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9vcmRlcnMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1744989969);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `address_zip` varchar(255) DEFAULT NULL,
  `address_city` varchar(255) DEFAULT NULL,
  `address_street` varchar(255) DEFAULT NULL,
  `address_additional` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin','munkatars') NOT NULL DEFAULT 'user',
  `loyalty_points` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phone`, `birth_date`, `address_zip`, `address_city`, `address_street`, `address_additional`, `password`, `role`, `loyalty_points`, `is_active`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Barnabás', 'Sinka', 'sinkabarni13@gmail.com', '06203717901', '2003-10-06', '3212', 'Gyöngyöshalász', 'Gyöngyösi út 28', NULL, '$2y$12$30YZUfU0UjMpQhQh/qQVCO/BaFIIlcGvq.MF80JuvKbHhODpyc4bS', 'admin', 358, 1, NULL, NULL, '2025-03-15 17:34:42', '2025-04-18 13:14:53'),
(4, 'Barnabás', 'Sinka', 'sinkabarni3@gmail.com', '06203717901', '2003-10-06', '3212', 'Gyöngyöshalász', 'Gyöngyösi út 28', NULL, '$2y$12$OGlaBgdy9Bn98LFwybsSuu6cES5qG1B7XkUYdmVmyg6Lxe01pVz/.', 'user', 1107, 1, NULL, NULL, '2025-03-15 19:29:29', '2025-04-18 13:06:01'),
(5, 'Barnabás', 'Sinka', 'sinkabarni14@gmail.com', '06203717901', '2003-10-06', '3212', 'Gyöngyöshalász', 'Gyöngyösi út 28', NULL, '$2y$12$9JwO1llzH9Bb.QifYFf1B.0lXO8vQ2hY.4lWSP77NAQGSZs18/XQO', 'munkatars', 0, 1, NULL, NULL, '2025-04-04 12:46:34', '2025-04-04 12:46:34');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- A tábla indexei `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discounts_product_id_foreign` (`product_id`);

--
-- A tábla indexei `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- A tábla indexei `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- A tábla indexei `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- A tábla indexei `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- A tábla indexei `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- A tábla indexei `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- A tábla indexei `related_products`
--
ALTER TABLE `related_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `related_products_product_id_foreign` (`product_id`),
  ADD KEY `related_products_related_product_id_foreign` (`related_product_id`);

--
-- A tábla indexei `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- A tábla indexei `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT a táblához `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT a táblához `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT a táblához `related_products`
--
ALTER TABLE `related_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Megkötések a táblához `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `related_products`
--
ALTER TABLE `related_products`
  ADD CONSTRAINT `related_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `related_products_related_product_id_foreign` FOREIGN KEY (`related_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
