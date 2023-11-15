-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 13 Nov 2023 pada 04.39
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_shop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` int NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `code`, `name`, `phone_number`, `email`, `address`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_active`) VALUES
(1, 'C001', 'Adelia Fitri', '081336596224', 'adelia@gmail.com', 'Gresik', '2023-10-21 06:00:25', NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `product_code` varchar(20) DEFAULT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `description` text,
  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `unit` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'PCS' COMMENT 'satuan',
  `discount_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `stock` int NOT NULL DEFAULT '0' COMMENT 'stock',
  `image` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'gambar dari product'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `product_name`, `category_id`, `product_code`, `is_active`, `created_at`, `updated_at`, `created_by`, `updated_by`, `description`, `price`, `unit`, `discount_amount`, `stock`, `image`) VALUES
(1, 'Sepatu', 1, 'P0001', '1', '2023-10-11 06:33:07', '2023-11-01 14:12:13', NULL, NULL, 'Sepatu ', '100000.00', 'PCS', '10.00', 0, '[\"products-2.jpg\"]'),
(3, 'Chocolate Brownis Cake', 2, 'P0003', '1', '2023-10-17 09:00:47', '2023-11-12 05:21:25', NULL, NULL, 'make with dark chocolates', '15000.00', 'PCS', '5.00', 6, '[\"products-2.jpg\"]'),
(5, 'slice chocolate cake', 2, 'P0005', '1', '2023-10-20 03:25:02', '2023-11-01 14:10:52', NULL, NULL, 'coklat belgia', '13000.00', 'PCS', '7.00', 7, '[\"razvan-mirel-rN0f6VgN9LY-unsplash.jpg\"]\r\n'),
(11, 'cake', 2, 'P0009', '1', '2023-11-02 09:56:54', NULL, NULL, NULL, 'Tart and cupcake', '35000.00', 'PCS', '5.00', 5, '[\"michaela-baum-VnM6_liIRJ0-unsplash.jpg\",\"swapnil-dwivedi-Nl8Oa6ZuNcA-unsplash.jpg\"]'),
(13, 'Red Velvet Cake', 2, 'P0010', '1', '2023-11-11 06:10:54', NULL, NULL, NULL, 'e', '13000.00', 'PCS', '5.00', 5, '[\"1699683054.jpg\"]'),
(14, 'chantily slice Cake', 2, 'P0011', '1', '2023-11-11 06:11:35', NULL, NULL, NULL, 'enak', '13000.00', 'PCS', '3.00', 3, '[\"1699683095.jpg\"]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products_circulations`
--

CREATE TABLE `products_circulations` (
  `id` int NOT NULL,
  `trx_date` date NOT NULL,
  `reff` varchar(20) DEFAULT NULL,
  `in` int NOT NULL DEFAULT '0',
  `out` int NOT NULL DEFAULT '0',
  `product_id` int NOT NULL,
  `remaining_stock` int NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `product_categories`
--

INSERT INTO `product_categories` (`id`, `category_name`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_active`) VALUES
(1, 'Sports', '2023-10-11 06:32:38', NULL, NULL, NULL, '1'),
(2, 'Daily', '2023-10-11 06:32:42', NULL, NULL, NULL, '1'),
(3, 'Accesoris', '2023-10-11 06:32:54', NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase`
--

CREATE TABLE `purchase` (
  `id` int NOT NULL,
  `code` varchar(20) NOT NULL,
  `trx_date` date NOT NULL,
  `sub_amount` decimal(15,2) DEFAULT NULL COMMENT 'total semua',
  `amount_total` decimal(15,2) DEFAULT NULL COMMENT 'total setelah diskon',
  `discount_amount` decimal(15,0) DEFAULT NULL COMMENT 'nominal diskon',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `total_products` int DEFAULT NULL,
  `vendor_id` int NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` int NOT NULL,
  `purchase_id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `amount_total` decimal(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `id` int NOT NULL,
  `code` varchar(20) NOT NULL,
  `trx_date` date NOT NULL,
  `sub_amount` decimal(15,2) DEFAULT NULL COMMENT 'total semua',
  `amount_total` decimal(15,2) DEFAULT NULL COMMENT 'total setelah diskon',
  `discount_amount` decimal(15,0) DEFAULT NULL COMMENT 'nominal diskon',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `total_products` int DEFAULT NULL,
  `customer_id` int NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales_details`
--

CREATE TABLE `sales_details` (
  `id` int NOT NULL,
  `sales_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `amount_total` decimal(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `group_id` int DEFAULT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `username`, `password`, `last_login_at`, `created_at`, `updated_at`, `created_by`, `updated_by`, `group_id`, `is_active`) VALUES
(1, 'Super Admin', 'super@gmail.com', '001122334455', 'uadmin', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', NULL, '2023-10-11 06:23:15', '2023-10-11 06:23:59', NULL, NULL, 1, '1'),
(2, 'Seller Satu', 'seller@gmail.com', '001122334456', 'seller', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', NULL, '2023-10-11 06:24:40', NULL, NULL, NULL, 2, '1'),
(3, 'Admin Product', 'adminproduct@gmail.com', '001122334457', 'products', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', NULL, '2023-10-11 06:25:14', NULL, NULL, NULL, 3, '1'),
(4, 'Adelia Fitri', 'adeliafitri972@gmail.com', '085784387196', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, '2023-10-27 13:16:03', NULL, NULL, NULL, NULL, '1'),
(5, 'Admin Adel', 'adeliafitri972@gmail.com', '081336596224', '81336596224', '25d55ad283aa400af464c76d713c07ad', NULL, '2023-10-29 03:52:58', '2023-10-29 03:56:02', NULL, NULL, 3, '1'),
(6, 'Admin 2', 'admin@gmail.com', '081345678902', '81345678902', 'e807f1fcf82d132f9bb018ca6738a19f', NULL, '2023-10-29 04:40:57', NULL, NULL, NULL, 3, '1'),
(7, 'Admin 3', 'admin3@gmail.com', '087531246930', '87531246930', '32cacb2f994f6b42183a1300d9a3e8d6', NULL, '2023-11-02 10:21:09', NULL, NULL, NULL, 3, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_active`, `description`) VALUES
(1, 'Super Admin', '2023-10-11 06:19:54', '2023-10-11 06:20:33', NULL, NULL, '1', 'Group user super admin'),
(2, 'Seller', '2023-10-11 06:20:08', '2023-10-11 06:21:17', NULL, NULL, '1', 'Group user seller'),
(3, 'Admin Products', '2023-10-11 06:21:32', '2023-10-11 06:21:40', NULL, NULL, '1', 'Group user admin product');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vendors`
--

CREATE TABLE `vendors` (
  `id` int NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `is_active` enum('1','0') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `vendors`
--

INSERT INTO `vendors` (`id`, `code`, `name`, `phone_number`, `email`, `address`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_active`) VALUES
(1, 'V001', 'Subak Grosir', '081974563214', 'subak_grosir@gmail.com', 'Surabaya', '2023-10-21 06:04:07', NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_products`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_products` (
`category_name` varchar(255)
,`id` int
,`image` text
,`price` decimal(15,2)
,`product_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_products`
--
DROP TABLE IF EXISTS `view_products`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_products`  AS SELECT `p`.`id` AS `id`, `p`.`product_name` AS `product_name`, `p`.`price` AS `price`, `p`.`image` AS `image`, `c`.`category_name` AS `category_name` FROM (`products` `p` join `product_categories` `c` on((`p`.`category_id` = `c`.`id`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_UN` (`code`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_UN` (`product_code`),
  ADD KEY `products_FK` (`category_id`);

--
-- Indeks untuk tabel `products_circulations`
--
ALTER TABLE `products_circulations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchases_UN` (`code`),
  ADD KEY `purchase_FK` (`vendor_id`);

--
-- Indeks untuk tabel `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_details_FK` (`product_id`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_UN` (`code`),
  ADD KEY `sales_FK` (`customer_id`);

--
-- Indeks untuk tabel `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_details_FK` (`product_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_UN` (`username`);

--
-- Indeks untuk tabel `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_UN` (`code`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `products_circulations`
--
ALTER TABLE `products_circulations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_FK` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_FK` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `purchase_details_FK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_FK` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sales_details`
--
ALTER TABLE `sales_details`
  ADD CONSTRAINT `sales_details_FK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
