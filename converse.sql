-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 21, 2025 lúc 01:26 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `converse`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'người sở hữu giỏ hàng',
  `quantity` int(11) NOT NULL DEFAULT 0 COMMENT 'số lượng',
  `total_amount` int(11) NOT NULL DEFAULT 0 COMMENT 'tổng số tiền',
  `create_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'ngày đặt',
  `status` set('gio-hang','cho-xac-nhan','dang-chuan-bị','dang-giao-hang','hoan-tat-don-hang','huy-don') NOT NULL DEFAULT 'gio-hang' COMMENT 'trạnng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `quantity`, `total_amount`, `create_at`, `status`) VALUES
(10, 7, 0, 0, '0000-00-00 00:00:00', 'gio-hang'),
(11, 8, 0, 0, '2025-02-20 19:47:13', 'gio-hang');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_detail`
--

CREATE TABLE `cart_detail` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_sizes_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_detail`
--

INSERT INTO `cart_detail` (`id`, `product_id`, `product_sizes_id`, `quantity`, `price`) VALUES
(10, 57, 79, 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'tên danh mục',
  `created_at` datetime NOT NULL COMMENT 'ngày tạo',
  `update_at` datetime NOT NULL COMMENT 'ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `update_at`) VALUES
(1, 'Giày Sneaker', '2025-01-18 12:57:46', '2025-01-18 12:57:46'),
(4, 'Big SALE', '2025-01-18 12:59:39', '2025-01-18 12:59:39'),
(5, 'Tra Cứu Đơn Hàng', '2025-01-18 12:59:39', '2025-01-18 12:59:39'),
(6, 'Chính Sách Khách Hàng', '2025-01-18 12:59:39', '2025-01-18 12:59:39'),
(7, 'Ưu đãi', '2025-01-18 12:59:39', '2025-01-18 12:59:39'),
(10, 'Ưu đãi cực sốc', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `fav_products`
--

CREATE TABLE `fav_products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL COMMENT 'tên sản phẩm',
  `image` varchar(255) NOT NULL COMMENT 'đường dẫn ảnh',
  `category_id` int(11) NOT NULL COMMENT 'danh mục sản phẩm',
  `price` int(50) NOT NULL COMMENT 'giá sản phẩm',
  `sale_percent` int(11) NOT NULL COMMENT 'phần trăm sale\r\n',
  `description` text NOT NULL COMMENT 'mô tả sản phẩm',
  `sales` int(11) NOT NULL COMMENT 'lượt bán',
  `created_at` datetime NOT NULL COMMENT 'ngày tạo',
  `update_at` datetime NOT NULL COMMENT 'ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `category_id`, `price`, `sale_percent`, `description`, `sales`, `created_at`, `update_at`) VALUES
(2, 'Giày Converse All Star Lift Platform Lunar New Year 2025 High Top A13351C', '1740209676-p2.webp', 1, 1500000, 50, 'Thiết kế & Thông số Kỹ Thuật của Giày Converse<br><br>\r\n\r\n+ Chất liệu: Vải canvas cao cấp hoặc da tổng hợp (tùy dòng sản phẩm).<br>  \r\n+ Đế giày: Cao su lưu hóa bền bỉ, chống trơn trượt.<br>  \r\n+ Lót giày: Công nghệ Ortholite giúp thoáng khí, khử mùi.<br>  \r\n+ Bộ đệm: Một số dòng sử dụng CX Foam tăng độ êm ái.<br>  \r\n+ Cấu trúc: Cổ thấp (Low-top), cổ cao (High-top) hoặc cổ lửng (Mid-top).<br>  \r\n+ Trọng lượng: Dao động từ 300-500g (tùy kích cỡ và chất liệu).<br>  \r\n+ Size: Đa dạng từ 35-47 (EU) phù hợp cho cả nam và nữ.<br>  \r\n+ Màu sắc & họa tiết: Nhiều phiên bản từ trơn màu đến họa tiết độc đáo.<br>  \r\n', 50, '2025-01-18 13:09:36', '2025-01-18 13:09:36'),
(3, 'Giày Converse Chuck Taylor 1970 Lunar New Year 2025 High Top A13349C Shoes Sneaker', 'p3.webp', 1, 2500000, 89, 'Thiết kế & Thông số Kỹ Thuật của Giày Converse<br><br>\r\n\r\n+ Chất liệu: Vải canvas cao cấp hoặc da tổng hợp (tùy dòng sản phẩm).<br>  \r\n+ Đế giày: Cao su lưu hóa bền bỉ, chống trơn trượt.<br>  \r\n+ Lót giày: Công nghệ Ortholite giúp thoáng khí, khử mùi.<br>  \r\n+ Bộ đệm: Một số dòng sử dụng CX Foam tăng độ êm ái.<br>  \r\n+ Cấu trúc: Cổ thấp (Low-top), cổ cao (High-top) hoặc cổ lửng (Mid-top).<br>  \r\n+ Trọng lượng: Dao động từ 300-500g (tùy kích cỡ và chất liệu).<br>  \r\n+ Size: Đa dạng từ 35-47 (EU) phù hợp cho cả nam và nữ.<br>  \r\n+ Màu sắc & họa tiết: Nhiều phiên bản từ trơn màu đến họa tiết độc đáo.<br>  \r\n', 15, '2025-01-18 13:09:36', '2025-01-18 13:09:36'),
(5, 'Giày Converse Chuck 70 Low Seasonal Color Citron This A07431C Low Top', 'p4.webp', 1, 1590000, 10, 'Thiết kế & Thông số Kỹ Thuật của Giày Converse<br><br>\r\n\r\n+ Chất liệu: Vải canvas cao cấp hoặc da tổng hợp (tùy dòng sản phẩm).<br>  \r\n+ Đế giày: Cao su lưu hóa bền bỉ, chống trơn trượt.<br>  \r\n+ Lót giày: Công nghệ Ortholite giúp thoáng khí, khử mùi.<br>  \r\n+ Bộ đệm: Một số dòng sử dụng CX Foam tăng độ êm ái.<br>  \r\n+ Cấu trúc: Cổ thấp (Low-top), cổ cao (High-top) hoặc cổ lửng (Mid-top).<br>  \r\n+ Trọng lượng: Dao động từ 300-500g (tùy kích cỡ và chất liệu).<br>  \r\n+ Size: Đa dạng từ 35-47 (EU) phù hợp cho cả nam và nữ.<br>  \r\n+ Màu sắc & họa tiết: Nhiều phiên bản từ trơn màu đến họa tiết độc đáo.<br>  \r\n', 77, '2025-01-18 13:09:36', '2025-01-18 13:09:36'),
(55, 'Giày Converse Chuck Taylor All Star Platform High Top Black Glitter A05436C', 'p5.webp', 1, 1090000, 50, 'Thiết kế & Thông số Kỹ Thuật của Giày Converse<br><br>\r\n\r\n+ Chất liệu: Vải canvas cao cấp hoặc da tổng hợp (tùy dòng sản phẩm).<br>  \r\n+ Đế giày: Cao su lưu hóa bền bỉ, chống trơn trượt.<br>  \r\n+ Lót giày: Công nghệ Ortholite giúp thoáng khí, khử mùi.<br>  \r\n+ Bộ đệm: Một số dòng sử dụng CX Foam tăng độ êm ái.<br>  \r\n+ Cấu trúc: Cổ thấp (Low-top), cổ cao (High-top) hoặc cổ lửng (Mid-top).<br>  \r\n+ Trọng lượng: Dao động từ 300-500g (tùy kích cỡ và chất liệu).<br>  \r\n+ Size: Đa dạng từ 35-47 (EU) phù hợp cho cả nam và nữ.<br>  \r\n+ Màu sắc & họa tiết: Nhiều phiên bản từ trơn màu đến họa tiết độc đáo.<br>  \r\n', 56, '2025-01-18 13:09:36', '2025-01-18 13:09:36'),
(57, 'Giày Converse Chuck Taylor All Star 1970s Mule Recycled Canvas White 172592C', 'p6.webp', 1, 1490000, 0, 'Thiết kế & Thông số Kỹ Thuật của Giày Converse<br><br>\r\n\r\n+ Chất liệu: Vải canvas cao cấp hoặc da tổng hợp (tùy dòng sản phẩm).<br>  \r\n+ Đế giày: Cao su lưu hóa bền bỉ, chống trơn trượt.<br>  \r\n+ Lót giày: Công nghệ Ortholite giúp thoáng khí, khử mùi.<br>  \r\n+ Bộ đệm: Một số dòng sử dụng CX Foam tăng độ êm ái.<br>  \r\n+ Cấu trúc: Cổ thấp (Low-top), cổ cao (High-top) hoặc cổ lửng (Mid-top).<br>  \r\n+ Trọng lượng: Dao động từ 300-500g (tùy kích cỡ và chất liệu).<br>  \r\n+ Size: Đa dạng từ 35-47 (EU) phù hợp cho cả nam và nữ.<br>  \r\n+ Màu sắc & họa tiết: Nhiều phiên bản từ trơn màu đến họa tiết độc đáo.<br>  \r\n', 300, '2025-01-19 09:30:23', '2025-01-19 09:30:23'),
(58, 'Giày Converse Chuck 70 High De Luxe Heel ‘Egret’ A05348C', 'p7.webp', 1, 1490000, 30, 'Thiết kế & Thông số Kỹ Thuật của Giày Converse<br><br>\r\n\r\n+ Chất liệu: Vải canvas cao cấp hoặc da tổng hợp (tùy dòng sản phẩm).<br>  \r\n+ Đế giày: Cao su lưu hóa bền bỉ, chống trơn trượt.<br>  \r\n+ Lót giày: Công nghệ Ortholite giúp thoáng khí, khử mùi.<br>  \r\n+ Bộ đệm: Một số dòng sử dụng CX Foam tăng độ êm ái.<br>  \r\n+ Cấu trúc: Cổ thấp (Low-top), cổ cao (High-top) hoặc cổ lửng (Mid-top).<br>  \r\n+ Trọng lượng: Dao động từ 300-500g (tùy kích cỡ và chất liệu).<br>  \r\n+ Size: Đa dạng từ 35-47 (EU) phù hợp cho cả nam và nữ.<br>  \r\n+ Màu sắc & họa tiết: Nhiều phiên bản từ trơn màu đến họa tiết độc đáo.<br>  \r\n', 0, '2025-01-19 09:38:36', '2025-01-19 09:38:36'),
(59, 'Giày Converse Run Star Legacy CX Platform Tailored Lines Pink High Top A10409C', 'p8.webp', 1, 1550000, 38, 'Thiết kế & Thông số Kỹ Thuật của Giày Converse<br><br>\r\n\r\n+ Chất liệu: Vải canvas cao cấp hoặc da tổng hợp (tùy dòng sản phẩm).<br>  \r\n+ Đế giày: Cao su lưu hóa bền bỉ, chống trơn trượt.<br>  \r\n+ Lót giày: Công nghệ Ortholite giúp thoáng khí, khử mùi.<br>  \r\n+ Bộ đệm: Một số dòng sử dụng CX Foam tăng độ êm ái.<br>  \r\n+ Cấu trúc: Cổ thấp (Low-top), cổ cao (High-top) hoặc cổ lửng (Mid-top).<br>  \r\n+ Trọng lượng: Dao động từ 300-500g (tùy kích cỡ và chất liệu).<br>  \r\n+ Size: Đa dạng từ 35-47 (EU) phù hợp cho cả nam và nữ.<br>  \r\n+ Màu sắc & họa tiết: Nhiều phiên bản từ trơn màu đến họa tiết độc đáo.<br>  \r\n', 0, '2025-01-19 09:38:36', '2025-01-19 09:38:36'),
(60, 'Giày Converse Chuck 70 De Luxe Squared \"Grey Area\" A08280C High Top', 'p9.webp', 1, 1190000, 46, 'Thiết kế & Thông số Kỹ Thuật của Giày Converse<br><br>\r\n\r\n+ Chất liệu: Vải canvas cao cấp hoặc da tổng hợp (tùy dòng sản phẩm).<br>  \r\n+ Đế giày: Cao su lưu hóa bền bỉ, chống trơn trượt.<br>  \r\n+ Lót giày: Công nghệ Ortholite giúp thoáng khí, khử mùi.<br>  \r\n+ Bộ đệm: Một số dòng sử dụng CX Foam tăng độ êm ái.<br>  \r\n+ Cấu trúc: Cổ thấp (Low-top), cổ cao (High-top) hoặc cổ lửng (Mid-top).<br>  \r\n+ Trọng lượng: Dao động từ 300-500g (tùy kích cỡ và chất liệu).<br>  \r\n+ Size: Đa dạng từ 35-47 (EU) phù hợp cho cả nam và nữ.<br>  \r\n+ Màu sắc & họa tiết: Nhiều phiên bản từ trơn màu đến họa tiết độc đáo.<br>  \r\n', 0, '2025-01-19 09:38:36', '2025-01-19 09:38:36'),
(61, 'Giày Converse Chuck Taylor All Star CX Explore Foundation A06764C High Top', 'p10.webp', 1, 1990000, 54, 'Thiết kế & Thông số Kỹ Thuật của Giày Converse<br><br>\r\n\r\n+ Chất liệu: Vải canvas cao cấp hoặc da tổng hợp (tùy dòng sản phẩm).<br>  \r\n+ Đế giày: Cao su lưu hóa bền bỉ, chống trơn trượt.<br>  \r\n+ Lót giày: Công nghệ Ortholite giúp thoáng khí, khử mùi.<br>  \r\n+ Bộ đệm: Một số dòng sử dụng CX Foam tăng độ êm ái.<br>  \r\n+ Cấu trúc: Cổ thấp (Low-top), cổ cao (High-top) hoặc cổ lửng (Mid-top).<br>  \r\n+ Trọng lượng: Dao động từ 300-500g (tùy kích cỡ và chất liệu).<br>  \r\n+ Size: Đa dạng từ 35-47 (EU) phù hợp cho cả nam và nữ.<br>  \r\n+ Màu sắc & họa tiết: Nhiều phiên bản từ trơn màu đến họa tiết độc đáo.<br>  \r\n', 0, '2025-01-19 09:38:36', '2025-01-19 09:38:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL COMMENT 'sản phẩm liên quan',
  `image_url` varchar(255) NOT NULL COMMENT 'đường dẫn ảnh nhỏ',
  `image_show` varchar(255) NOT NULL COMMENT 'ảnh chính'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_url`, `image_show`) VALUES
(10, 2, 'p2.webp', 'p2.webp'),
(11, 2, 'p2.1.webp', ''),
(12, 2, 'p2.2.webp', ''),
(13, 2, 'p2.3.webp', ''),
(14, 2, 'p2.4.webp', ''),
(15, 2, 'p2.5.webp', ''),
(16, 2, 'p2.6.webp', ''),
(17, 2, 'p2.7.webp', ''),
(18, 3, 'p3.webp', 'p3.webp'),
(19, 3, 'p3.1.webp', ''),
(20, 3, 'p3.2.webp', ''),
(21, 3, 'p3.3.webp', ''),
(22, 3, 'p3.4.webp', ''),
(23, 3, 'p3.5.webp', ''),
(24, 3, 'p3.6.webp', ''),
(25, 3, 'p3.7.webp', ''),
(26, 5, 'p4.webp', 'p4.webp'),
(27, 5, 'p4.1.webp', ''),
(28, 5, 'p4.2.webp', ''),
(29, 5, 'p4.5.webp', ''),
(30, 5, 'p4.4.png', ''),
(31, 5, 'p4.3.png', ''),
(32, 5, 'p4.6.webp', ''),
(33, 55, 'p5.webp', 'p5.webp'),
(34, 55, 'p5.1.webp', ''),
(35, 55, 'p5.2.webp', ''),
(36, 55, 'p5.3.webp', ''),
(37, 55, 'p5.4.webp', ''),
(38, 55, 'p5.5.webp', ''),
(39, 55, 'p5.6.webp', ''),
(40, 55, 'p5.7.webp', ''),
(41, 57, 'p6.webp', 'p6.webp'),
(42, 57, 'p6.1.webp', ''),
(43, 57, 'p6.2.webp', ''),
(44, 57, 'p6.3.webp', ''),
(45, 57, 'p6.4.webp', ''),
(46, 57, 'p6.5.webp', ''),
(47, 57, 'p6.6.webp', ''),
(48, 57, 'p6.7.webp', ''),
(49, 58, 'p7.webp', 'p7.webp'),
(50, 58, 'p7.1.webp', ''),
(51, 58, 'p7.2.webp', ''),
(52, 58, 'p7.3.webp', ''),
(53, 58, 'p7.4.webp', ''),
(54, 58, 'p7.5.webp', ''),
(55, 58, 'p7.6.webp', ''),
(56, 58, 'p7.7.webp', ''),
(57, 59, 'p8.webp', 'p8.webp'),
(58, 59, 'p8.1.webp', ''),
(59, 59, 'p8.2.webp', ''),
(60, 59, 'p8.3.webp', ''),
(61, 59, 'p8.4.webp', ''),
(62, 59, 'p8.5.webp', ''),
(63, 59, 'p8.6.webp', ''),
(64, 59, 'p8.7.webp', ''),
(65, 60, 'p9.webp', 'p9.webp'),
(66, 60, 'p9.1.webp', ''),
(67, 60, 'p9.2.webp', ''),
(68, 60, 'p9.3.webp', ''),
(69, 60, 'p9.4.webp', ''),
(70, 60, 'p9.5.webp', ''),
(71, 60, 'p9.6.webp', ''),
(72, 60, 'p9.7.webp', ''),
(73, 61, 'p10.webp', 'p10.webp'),
(74, 61, 'p10.1.webp', ''),
(75, 61, 'p10.2.webp', ''),
(76, 61, 'p10.3.webp', ''),
(77, 61, 'p10.4.webp', ''),
(78, 61, 'p10.5.webp', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL COMMENT 'liên kết sản phẩm',
  `size_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL COMMENT 'số lượng tồn kho',
  `created_at` datetime NOT NULL COMMENT 'ngày tạo',
  `updated_at` datetime NOT NULL COMMENT 'ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size_id`, `stock`, `created_at`, `updated_at`) VALUES
(63, 2, 1, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 2, 3, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 2, 6, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 2, 9, 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 2, 12, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 3, 2, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 3, 4, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 3, 5, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 3, 10, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 3, 13, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 55, 1, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 55, 2, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 55, 5, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 55, 7, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 55, 11, 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 57, 3, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 57, 4, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 57, 6, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 57, 8, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 57, 12, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 58, 2, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 58, 4, 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 58, 5, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 58, 9, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 58, 13, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 59, 1, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 59, 3, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 59, 6, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 59, 10, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 59, 11, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 60, 2, 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 60, 4, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 60, 7, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 60, 8, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 60, 12, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 61, 3, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 61, 5, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 61, 6, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 61, 9, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 61, 13, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `size_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sizes`
--

INSERT INTO `sizes` (`id`, `size_name`) VALUES
(1, '0 UK - 32 EUR - 20 cm'),
(2, '0.5 UK - 33 EUR - 20.5 cm'),
(3, '1 UK - 34 EUR - 21 cm'),
(4, '1.5 UK - 35 EUR - 21.5 cm'),
(5, '2 UK - 36 EUR - 22 cm'),
(6, '2.5 UK - 37 EUR - 22.5 cm'),
(7, '3 UK - 38 EUR - 23 cm'),
(8, '3.5 UK - 39 EUR - 23.5 cm'),
(9, '4 UK - 40 EUR - 24 cm'),
(10, '4.5 UK - 41 EUR - 24.5 cm'),
(11, '5 UK - 42 EUR - 25 cm'),
(12, '5.5 UK - 43 EUR - 25.5 cm'),
(13, '6 UK - 44 EUR - 26 cm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `image` varchar(255) DEFAULT NULL COMMENT 'ảnh đại diện',
  `name` varchar(100) NOT NULL COMMENT 'tên người dùng',
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL COMMENT 'mật khẩu đã mã hóa',
  `phone` varchar(10) NOT NULL COMMENT 'số điện thoại',
  `address` text DEFAULT NULL COMMENT 'địa chỉ',
  `role` int(11) NOT NULL COMMENT 'vai trò',
  `status` varchar(50) NOT NULL COMMENT 'trạng thái',
  `created_at` datetime NOT NULL COMMENT 'ngày tạo',
  `updated_at` datetime NOT NULL COMMENT 'ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `image`, `name`, `email`, `password`, `phone`, `address`, `role`, `status`, `created_at`, `updated_at`) VALUES
(7, '1739273094_windows-11-logo-colorful-background-digital-art-hd-wallpaper-uhdpaper.com-127@0@h.jpg', 'Võ Minh Khánh ', 'minhkhanhv23@gmail.com', '0919943410@zZ', '0919943410', '35 QL1A, Thới An, Quận 12, TpHCM', 0, 'active', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'avatar-trang-4.jpg', 'Lê Hoàng Yến Nhi', 'khanhvmps39093@gmail.com', '02052005@zZ', '0919943410', NULL, 0, 'active', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'avatar-trang-4.jpg', 'cường', 'cuong@gmail.com', '0919943410@zZ', '0919943410', NULL, 0, 'active', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'avatar-trang-4.jpg', 'Admin', 'admin@gmail.com', '123\r\n', '', NULL, 1, 'active', '2025-02-18 06:25:10', '2025-02-18 06:25:10'),
(11, 'avatar-trang-4.jpg', 'Võ Minh Khánh', 'vincentvo.khanh@gmail.com', '02052005@zZ', '0919943410', NULL, 0, 'active', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD PRIMARY KEY (`id`,`product_id`,`product_sizes_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `cart_detail_ibfk_2` (`product_sizes_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `fav_products`
--
ALTER TABLE `fav_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Chỉ mục cho bảng `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `fav_products`
--
ALTER TABLE `fav_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT cho bảng `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT cho bảng `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD CONSTRAINT `cart_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_detail_ibfk_2` FOREIGN KEY (`product_sizes_id`) REFERENCES `product_sizes` (`id`);

--
-- Các ràng buộc cho bảng `fav_products`
--
ALTER TABLE `fav_products`
  ADD CONSTRAINT `fav_products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fav_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_sizes_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
