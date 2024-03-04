-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 04, 2024 lúc 08:34 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nnth`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietkhoahocs`
--

CREATE TABLE `chitietkhoahocs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `khoahoc_id` bigint(20) UNSIGNED NOT NULL,
  `thoi_gian_bat_dau` date NOT NULL,
  `thoi_gian_ket_thuc` date NOT NULL,
  `thoi_gian_hoc` varchar(50) NOT NULL,
  `dia_diem_hoc` varchar(100) NOT NULL,
  `thu_hoc` varchar(50) NOT NULL,
  `so_tiet_hoc` varchar(50) NOT NULL,
  `hoc_phi` text NOT NULL,
  `giangvien_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhsachlophocs`
--

CREATE TABLE `danhsachlophocs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `co_so` varchar(50) NOT NULL,
  `lop_hoc` varchar(50) NOT NULL,
  `khoahoc_id` bigint(20) UNSIGNED NOT NULL,
  `ma_sinh_vien` varchar(50) NOT NULL,
  `ho_dem` varchar(50) NOT NULL,
  `ten` varchar(50) NOT NULL,
  `ngay_sinh` varchar(50) NOT NULL,
  `gioi_tinh` varchar(10) NOT NULL,
  `lop_danh_nghia` varchar(50) NOT NULL,
  `so_dien_thoai` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ghi_chu` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `ketquas`
--

CREATE TABLE `ketquas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sinhvien_id` bigint(20) UNSIGNED NOT NULL,
  `diem_tin_hoc` varchar(5) DEFAULT NULL,
  `bang_tin_hoc` varchar(50) DEFAULT NULL,
  `diem_anh_van` varchar(5) DEFAULT NULL,
  `bang_anh_van` varchar(50) DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoahocs`
--

CREATE TABLE `khoahocs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dot_hoc` varchar(50) NOT NULL,
  `ma_khoahoc` varchar(50) NOT NULL,
  `ten_khoahoc` varchar(100) NOT NULL,
  `nguoi_dang_bai` varchar(50) NOT NULL,
  `ngay_khai_giang` date NOT NULL,
  `dia_diem_dang_ky` varchar(100) NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `loaikhoahoc_id` bigint(20) UNSIGNED NOT NULL,
  `trangthai` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaikhoahocs`
--

CREATE TABLE `loaikhoahocs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten_loaikhoahoc` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(29, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(30, '2019_08_19_000000_create_failed_jobs_table', 1),
(31, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(32, '2024_01_16_000000_create_quyens_table', 1),
(33, '2024_01_16_000001_create_users_table', 1),
(34, '2024_01_27_144843_create_loaikhoahocs_table', 1),
(35, '2024_01_27_144851_create_khoahocs_table', 1),
(36, '2024_01_27_144855_create_chitietkhoahocs_table', 1),
(37, '2024_01_27_144859_create_sinhviens_table', 1),
(38, '2024_01_27_144920_create_ketquas_table', 1),
(39, '2024_01_27_144937_create_danhsachlophocs_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyens`
--

CREATE TABLE `quyens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten_quyen` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quyens`
--

INSERT INTO `quyens` (`id`, `ten_quyen`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2024-01-27 14:51:47', '2024-01-27 14:51:47'),
(2, 'Giảng viên', '2024-01-27 14:51:47', '2024-01-27 14:51:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhviens`
--

CREATE TABLE `sinhviens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ma_sinh_vien` varchar(50) NOT NULL,
  `ho_dem` varchar(50) NOT NULL,
  `ten` varchar(50) NOT NULL,
  `ngay_sinh` varchar(50) NOT NULL,
  `gioi_tinh` varchar(10) NOT NULL,
  `thoi_gian_dang_ky` varchar(50) NOT NULL,
  `so_tien_da_dong` text NOT NULL,
  `so_tien_con_lai` text DEFAULT '0',
  `lop_danh_nghia` varchar(50) NOT NULL,
  `so_dien_thoai` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ghi_chu` text DEFAULT NULL,
  `trangthai` int(1) NOT NULL DEFAULT 0,
  `khoahoc_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `quyen_id` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `quyen_id`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Quản trị viên', 'admin@gmail.com', 1, '$2y$10$Td4FLyLu0du3sBvaY7rc8OaH5yYESQyQeMzEB1lg8q9tEonI./odm', '2024-01-27 14:52:54', '2024-01-27 14:52:54'),
(2, 'Giảng viên 1', 'giangvien1@gmail.com', 2, '$2y$10$Td4FLyLu0du3sBvaY7rc8OaH5yYESQyQeMzEB1lg8q9tEonI./odm', '2024-01-27 14:52:54', '2024-01-27 14:52:54');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietkhoahocs`
--
ALTER TABLE `chitietkhoahocs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chitietkhoahocs_khoahoc_id_foreign` (`khoahoc_id`),
  ADD KEY `chitietkhoahocs_giangvien_id_foreign` (`giangvien_id`);

--
-- Chỉ mục cho bảng `danhsachlophocs`
--
ALTER TABLE `danhsachlophocs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `danhsachlophocs_khoahoc_id_foreign` (`khoahoc_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `ketquas`
--
ALTER TABLE `ketquas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ketquas_sinhvien_id_foreign` (`sinhvien_id`);

--
-- Chỉ mục cho bảng `khoahocs`
--
ALTER TABLE `khoahocs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `khoahocs_loaikhoahoc_id_foreign` (`loaikhoahoc_id`);

--
-- Chỉ mục cho bảng `loaikhoahocs`
--
ALTER TABLE `loaikhoahocs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `quyens`
--
ALTER TABLE `quyens`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sinhviens`
--
ALTER TABLE `sinhviens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sinhviens_khoahoc_id_foreign` (`khoahoc_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_quyen_id_foreign` (`quyen_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitietkhoahocs`
--
ALTER TABLE `chitietkhoahocs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `danhsachlophocs`
--
ALTER TABLE `danhsachlophocs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ketquas`
--
ALTER TABLE `ketquas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `khoahocs`
--
ALTER TABLE `khoahocs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `loaikhoahocs`
--
ALTER TABLE `loaikhoahocs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `quyens`
--
ALTER TABLE `quyens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `sinhviens`
--
ALTER TABLE `sinhviens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietkhoahocs`
--
ALTER TABLE `chitietkhoahocs`
  ADD CONSTRAINT `chitietkhoahocs_giangvien_id_foreign` FOREIGN KEY (`giangvien_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chitietkhoahocs_khoahoc_id_foreign` FOREIGN KEY (`khoahoc_id`) REFERENCES `khoahocs` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `danhsachlophocs`
--
ALTER TABLE `danhsachlophocs`
  ADD CONSTRAINT `danhsachlophocs_khoahoc_id_foreign` FOREIGN KEY (`khoahoc_id`) REFERENCES `khoahocs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `ketquas`
--
ALTER TABLE `ketquas`
  ADD CONSTRAINT `ketquas_sinhvien_id_foreign` FOREIGN KEY (`sinhvien_id`) REFERENCES `sinhviens` (`id`);

--
-- Các ràng buộc cho bảng `khoahocs`
--
ALTER TABLE `khoahocs`
  ADD CONSTRAINT `khoahocs_loaikhoahoc_id_foreign` FOREIGN KEY (`loaikhoahoc_id`) REFERENCES `loaikhoahocs` (`id`);

--
-- Các ràng buộc cho bảng `sinhviens`
--
ALTER TABLE `sinhviens`
  ADD CONSTRAINT `sinhviens_khoahoc_id_foreign` FOREIGN KEY (`khoahoc_id`) REFERENCES `khoahocs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_quyen_id_foreign` FOREIGN KEY (`quyen_id`) REFERENCES `quyens` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
