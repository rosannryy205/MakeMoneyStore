-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 23, 2025 lúc 02:43 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

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
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_detail`
--

INSERT INTO `cart_detail` (`id`, `product_id`, `quantity`, `price`) VALUES
(11, 57, 1, 0);

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
  `size` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL COMMENT 'số lượng tồn kho',
  `created_at` datetime NOT NULL COMMENT 'ngày tạo',
  `updated_at` datetime NOT NULL COMMENT 'ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size`, `stock`, `created_at`, `updated_at`) VALUES
(8, 2, '3 UK - 35 EUR - 22 cm', 5, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(9, 2, '3.5 UK - 36 EUR - 22.5 cm', 12, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(10, 2, '4.5 UK - 37 EUR - 23.5 cm', 13, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(11, 2, '5.5 UK - 38 EUR - 24.5 cm', 6, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(12, 2, '6 UK - 39 EUR - 24.5 cm', 7, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(13, 3, '3.5 UK - 36 EUR - 22.5 cm', 14, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(14, 3, '4.5 UK - 37 EUR - 23.5 cm', 5, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(15, 3, '5.5 UK - 38 EUR - 24.5 cm', 5, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(16, 3, '7 UK - 40 EUR - 25.5 cm', 11, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(17, 3, '7.5 UK - 41 EUR - 26 cm', 7, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(18, 3, '8.5 UK - 42 EUR - 27 cm', 9, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(19, 5, '3 UK - 35 EUR - 22 cm', 12, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(20, 5, '3.5 UK - 36 EUR - 22.5 cm', 13, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(21, 5, '5 UK - 37.5 EUR - 24 cm', 12, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(22, 5, '5.5 UK - 38 EUR - 24.5 cm', 12, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(23, 5, '7 UK - 40 EUR - 25.5 cm', 11, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(24, 5, '7.5 UK - 41 EUR - 26 cm', 9, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(25, 55, '3.5 UK - 36 EUR - 22.5 cm', 12, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(26, 55, '4.5 UK - 37 EUR - 23.5 cm', 5, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(27, 55, '5.5 UK - 38 EUR - 24.5 cm', 11, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(28, 55, '6 UK - 39 EUR - 24.5 cm', 5, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(29, 55, '7 UK - 40 EUR - 25.5 cm', 9, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(30, 55, '7.5 UK - 41 EUR - 26 cm', 5, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(31, 55, '8.5 UK - 42 EUR - 27 cm', 12, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(32, 55, '9.5 UK - 43 EUR - 28 cm', 11, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(33, 55, '10 UK - 44 EUR - 28.5 cm', 10, '2025-01-19 09:04:07', '2025-01-19 09:04:07'),
(34, 57, '8.5 UK - 42 EUR - 27 cm', 12, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(35, 57, '9.5 UK - 43 EUR - 28 cm', 9, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(36, 57, '10 UK - 44 EUR - 28.5 cm', 5, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(37, 58, '4 UK - 36.5 EUR - 23 cm', 5, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(38, 58, '4.5 UK - 37 EUR - 23.5 cm', 6, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(39, 58, '5 UK - 37.5 EUR - 24 cm', 7, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(40, 58, '5.5 UK - 38 EUR - 24.5 cm', 9, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(41, 58, '6 UK - 39 EUR - 24.5 cm', 7, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(42, 58, '6.5 UK - 39.5 EUR - 25 cm', 9, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(43, 59, '37.5', 8, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(44, 59, '38', 8, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(45, 59, '38.5', 9, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(46, 59, '39', 12, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(47, 60, '4 UK - 36.5 EUR - 23 cm', 5, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(48, 60, '4.5 UK - 37 EUR - 23.5 cm', 7, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(49, 60, '5 UK - 37.5 EUR - 24 cm', 8, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(50, 60, '5.5 UK - 38 EUR - 24.5 cm', 9, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(51, 60, '6 UK - 39 EUR - 24.5 cm', 8, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(52, 60, '6.5 UK - 39.5 EUR - 25 cm', 9, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(53, 60, '7 UK - 40 EUR - 25.5 cm', 9, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(54, 60, '7.5 UK - 41 EUR - 26 cm', 13, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(55, 60, '8 UK - 41.5 EUR - 26.5 cm', 22, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(56, 60, '8.5 UK - 42 EUR - 27 cm', 22, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(57, 61, '7 UK - 40 EUR - 25.5 cm', 23, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(58, 61, '7.5 UK - 41 EUR - 26 cm', 12, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(59, 61, '8.5 UK - 42 EUR - 27 cm', 3, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(60, 61, '9.5 UK - 43 EUR - 28 cm\r\n', 6, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(61, 61, '10 UK - 44 EUR - 28.5 cm', 12, '2025-01-19 10:14:23', '2025-01-19 10:14:23'),
(62, 61, '10.5 UK - 44.5 EUR - 29 cm', 22, '2025-01-19 10:14:23', '2025-01-19 10:14:23');

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
  ADD PRIMARY KEY (`id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `product_id` (`product_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

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
  ADD CONSTRAINT `cart_detail_ibfk_1` FOREIGN KEY (`id`) REFERENCES `carts` (`id`),
  ADD CONSTRAINT `cart_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

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
  ADD CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
