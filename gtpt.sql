-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 25, 2021 lúc 12:54 PM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `gtpt`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `categoryName` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `categoryName`) VALUES
(1, 'Đơn giản'),
(2, 'Cao cấp'),
(3, 'Chung cư mini'),
(4, 'Nhà trọ '),
(5, 'Cao cấp đặc biệt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `districts`
--

CREATE TABLE `districts` (
  `district_id` int(11) NOT NULL,
  `districtName` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `districts`
--

INSERT INTO `districts` (`district_id`, `districtName`) VALUES
(1, 'Nghệ An'),
(2, 'Hà Nội'),
(3, 'TP.Hồ Chí Minh'),
(4, 'Đà Nẵng'),
(5, 'Hải Phòng'),
(8, 'Quảng Nam');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `motel`
--

CREATE TABLE `motel` (
  `Motel_Id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `count_view` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `latlng` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `utilities` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `phone` varchar(255) NOT NULL,
  `approve` int(11) NOT NULL COMMENT '1-Available, 0-Unavailable',
  `status` int(11) DEFAULT NULL COMMENT '0-Chưa duyệt, 1-Đã kiểm duyệt, 2-Sai nội dung',
  `user_id` int(10) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `motel`
--

INSERT INTO `motel` (`Motel_Id`, `title`, `description`, `price`, `area`, `count_view`, `address`, `latlng`, `images`, `utilities`, `created_at`, `phone`, `approve`, `status`, `user_id`, `category_id`, `district_id`) VALUES
(1, 'Nhà cao cấp mini', '<p>Sạch</p>\r\n', 1000000, 20, 10, 'Nha Trang', '', '17874166.jpg', 'Sạch, sang', '2021-12-25 02:33:52', '0984637269', 1, 1, 35, 1, 1),
(32, 'Nhà cao cấp mini', '<p>Sạch</p>\r\n', 89000, 80000, 1, 'HN', '', 'Nhà cao cấp mini.jpg', 'Sạch', '2021-12-25 04:20:30', '0984637269', 0, 1, 35, 2, 2),
(37, 'Nhà trọ mini', '<p>Sạch, đẹp</p>\r\n', 600000, 20000, 2, 'Nghệ An', '', 'Chung cư.jpg', 'Sạch, sang', '2021-12-23 04:29:13', '0986837846', 0, 1, 35, 3, 1),
(38, 'Phong tro ', '<p>Phong rong rai, thoang mat</p>\r\n', 980000, 10000, 3, 'Ha Noi', '', 'cao cấp.jpg', 'Sạch, sang', '2021-12-22 22:26:40', '0986837846', 0, 2, 35, 4, 1),
(47, 'Phòng trọ cao cấp', 'Sạch đẹp, rộng rãi', 2000000, 30050, 2, 'Hồ Chí Minh', '', 'cao cấp.jpg', 'Có đầy đủ vật dụng', '2021-12-24 19:03:39', '0976534726', 0, 0, 35, 1, 1),
(48, 'Phòng trọ ở ghép', '<p>Sạch sẽ</p>\r\n', 1000000, 10000, 3, 'Huế', '', 'mini.jpg', 'Sạch sẽ, an toàn', '2021-12-25 01:09:02', '0375642367', 1, 1, 35, 1, 1),
(49, 'Cho thuê phòng trọ chính chủ', '<p>***** PHÒNG TRỌ 1071 HUỲNH TẤN PHÁT, Q7, gần ĐH Tôn Đức Thắng.</p>\r\n\r\n<p>- Phòng trọ nằm trên trục đường chính số 1071 Huỳnh Tấn Phát, Phú Thuận, Q 7. Đi 5 phút tới Phú Mỹ Hưng, đi 15 phút qua quận 1, gần trường ĐH Tôn Đức Thắng.</p>\r\n\r\n<p>- Phòng có CỬA SỔ, nhiều phòng có BAN CÔNG, đảm bảo ánh sáng ban ngày không cần mở đèn.</p>\r\n\r\n<p>- Toilet trong phòng, có BẾP nấu ăn. </p>\r\n\r\n<p>- Trong nhà có Thang máy đi lại.</p>\r\n\r\n<p>- Internet 4 đường truyền cáp quang mạnh, nhanh. Cáp Tivi.</p>\r\n\r\n<p>- Khóa vân tay khách về tự do.</p>\r\n\r\n<p>- Phòng cháy chữa cháy tự động, sân phơi quần áo.</p>\r\n\r\n<p>- Bỏ xe dưới tầng trệt, có bảo vệ trong coi, Có Camera an ninh quan sát.</p>\r\n\r\n<p>- Bảo vệ trong coi 24/24 giúp Bạn có cảm giác an toàn, được bảo vệ.</p>\r\n\r\n<p>- Có dịch vụ lau dọn hành lang hàng tuần sạch sẽ.</p>\r\n\r\n<p>- Có hổ trợ sửa chữa điện, nước…cơ bản giúp bạn an tâm sinh sống.</p>\r\n', 2500000, 25, 5, Hồ Chí Minh', '', 'Nhà cao cấp mini.jpg', 'Có đầy đủ vật dụng tiện nghi, an toàn', '2021-12-25 01:10:16', '0918180057 ', 0, 2, 35, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` varchar(11) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `Name`, `Username`, `Email`, `Password`, `Role`, `Phone`, `Avatar`) VALUES
(30, 'Hà Huy Sơn', 'son', 'son@gmail.com', '1234567', '1', '0978376294', 'Chung cư mini.jpg'),
(35, 'Trương Huy Mạnh', 'manh', 'manh@gmail.com', '1234567', '1', '0967239321', '17874166.jpg'),
(42, 'Nguyễn Đức Ngọc', 'ducngoc', 'ducngoc@gmail.com', '789', '0', '0967239729', 'ảnh 1.png'),
(43, 'Trần Trung Kiên', 'kien', 'kien@gmail.com', 'e9f11cb3aa86d8325ae442fb18d803c7', '', '0967239700', 'ảnh 3.jpg'),
(44, 'Nguyễn Văn Ngọc', 'vanngoc', 'vanngoc@gmail.com', '-vanngoc@123-', '1', '0967239657', 'ảnh 5.jpg'),
(45, 'Hùng Dũng', 'hungdung95', 'hungdung95@gmail.com', '1234', '1', '0967239791', 'ảnh 4.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`district_id`);

--
-- Chỉ mục cho bảng `motel`
--
ALTER TABLE `motel`
  ADD PRIMARY KEY (`Motel_Id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `district_id` (`district_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `districts`
--
ALTER TABLE `districts`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `motel`
--
ALTER TABLE `motel`
  MODIFY `Motel_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `motel`
--
ALTER TABLE `motel`
  ADD CONSTRAINT `motel_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `motel_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `motel_ibfk_3` FOREIGN KEY (`district_id`) REFERENCES `districts` (`district_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
