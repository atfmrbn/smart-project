-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Bulan Mei 2024 pada 09.26
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_management`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `published_year` year(4) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `status` enum('available','unavailable') NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `books`
--

INSERT INTO `books` (`id`, `user_id`, `category_id`, `title`, `author`, `publisher`, `published_year`, `isbn`, `image`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Laravel 10', 'Joko', 'Anton', '0000', '123', 'img/EVpceAZyy4uuOAivliS02j5lcTRuZe5xZApdnbhy.png', 'Belajar Web dengan Framework Laravel', 'available', NULL, NULL, '2024-05-27 17:29:01'),
(5, NULL, 15, 'Sapiens: Riwayat Singkat Umat Manusia', 'Yuval Noah Harari', 'Nalar', '2011', '978-602-9226-40-5', NULL, 'Sapiens membahas tentang evolusi manusia, peradaban kuno, revolusi industri, dan globalisasi.', 'available', NULL, '2024-05-25 20:43:45', '2024-05-26 20:07:08'),
(6, NULL, 14, 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Lentera Pustaka', '1985', '978-602-453-354-9', NULL, 'Novel klasik ini menceritakan kisah perjuangan Minke, seorang pribumi di masa penjajahan Belanda, melawan kolonialisme dan rasisme.', 'available', NULL, '2024-05-25 22:15:14', '2024-05-26 02:54:24'),
(8, NULL, 8, 'Fisika Dasar', 'Ir. Sutanto, Ph.D', 'Penerbit Sains', '2022', '978-602-112-2', NULL, 'Prinsip-prinsip dasar fisika dengan ilustrasi yang jelas dan mudah dipahami.', 'available', NULL, '2024-05-27 04:03:55', '2024-05-27 04:03:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_categories`
--

CREATE TABLE `book_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `book_categories`
--

INSERT INTO `book_categories` (`id`, `name`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'TI', 'Teknologi yang digunakan untuk menyimpan, memproses, dan mengirimkan informasi.', NULL, NULL, '2024-05-26 07:52:31'),
(2, 'Ensiklopedia', 'Buku referensi yang berisi informasi ringkas dan komprehensif tentang berbagai topik.', NULL, '2024-05-24 22:41:21', '2024-05-24 22:41:21'),
(5, 'Jurnal', 'Publikasi berkala yang berisi artikel tentang berbagai topik.', NULL, '2024-05-24 23:12:12', '2024-05-24 23:51:14'),
(6, 'Ekonomi', 'Studi tentang produksi, distribusi, dan konsumsi barang dan jasa.', NULL, '2024-05-24 23:56:14', '2024-05-24 23:56:14'),
(7, 'Hukum', 'Sistem aturan dan peraturan yang mengatur masyarakat.', NULL, '2024-05-24 23:56:38', '2024-05-24 23:56:38'),
(8, 'Fisika', 'Studi tentang sifat dasar alam, termasuk materi, energi, dan ruang waktu.', NULL, '2024-05-24 23:56:56', '2024-05-24 23:56:56'),
(9, 'Kimia', 'Studi tentang sifat dan interaksi zat.', NULL, '2024-05-24 23:57:26', '2024-05-24 23:57:26'),
(10, 'Biologi', 'Studi tentang makhluk hidup.', NULL, '2024-05-24 23:57:40', '2024-05-24 23:57:40'),
(11, 'Geologi', 'Studi tentang struktur dan sejarah Bumi.', NULL, '2024-05-24 23:57:53', '2024-05-24 23:57:53'),
(12, 'Kamus', 'Buku referensi yang berisi daftar kata-kata dalam suatu bahasa beserta maknanya.', NULL, '2024-05-24 23:59:05', '2024-05-24 23:59:05'),
(13, 'Astronomi', 'Studi tentang benda-benda langit, seperti bintang, planet, dan galaksi.', NULL, '2024-05-24 23:59:31', '2024-05-24 23:59:31'),
(14, 'Fiksi', 'buku yang ceritanya berdasarkan imajinasi dan kreasi penulis, bukan berdasarkan fakta atau kenyataan.', NULL, '2024-05-25 20:33:12', '2024-05-25 20:33:12'),
(15, 'Antropologi', 'ilmu sosial yang mempelajari budaya, masyarakat, dan perilaku manusia', NULL, '2024-05-25 20:37:37', '2024-05-25 20:37:37'),
(16, 'Psikologi', 'ilmu yang mempelajari pikiran dan perilaku manusia.', NULL, '2024-05-25 20:41:50', '2024-05-25 20:41:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `borrowing_books`
--

CREATE TABLE `borrowing_books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `librarian_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `checkout_date` date NOT NULL,
  `due_date` date NOT NULL,
  `pay` int(50) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'borrowing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `borrowing_books`
--

INSERT INTO `borrowing_books` (`id`, `librarian_id`, `student_id`, `description`, `checkout_date`, `due_date`, `pay`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, NULL, 4, 'sering telat', '2024-05-27', '2024-05-29', NULL, 'borrowing', '2024-05-26 20:05:52', '2024-05-26 20:05:52', NULL),
(10, NULL, 3, 'sada', '2024-05-29', '2024-05-30', NULL, 'borrowing', '2024-05-29 06:35:11', '2024-05-29 06:35:11', NULL),
(16, NULL, 2, 'simpan pinjam', '2024-05-30', '2024-05-31', NULL, 'borrowing', '2024-05-29 23:51:53', '2024-05-29 23:51:53', NULL),
(17, NULL, 3, 'pinjam lagi ni anak mungkin kutu buku', '2024-05-30', '2024-05-30', NULL, 'borrowing', '2024-05-30 07:08:29', '2024-05-30 07:08:29', NULL),
(18, NULL, 4, 'minjam bentar', '2024-05-31', '2024-06-01', NULL, 'borrowing', '2024-05-30 23:02:01', '2024-05-30 23:02:01', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `borrowing_book_details`
--

CREATE TABLE `borrowing_book_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `borrowing_book_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `returned_date` datetime DEFAULT NULL,
  `penalty` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `borrowing_book_details`
--

INSERT INTO `borrowing_book_details` (`id`, `borrowing_book_id`, `book_id`, `returned_date`, `penalty`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 4, 1, '2024-05-30 14:13:48', '100', '2024-05-27 18:54:09', '2024-05-30 07:13:48', NULL),
(7, 4, 8, '2024-05-30 14:24:29', '500', '2024-05-27 18:54:14', '2024-05-30 07:24:29', NULL),
(19, 16, 6, '2024-05-30 21:45:36', '0', '2024-05-30 00:12:03', '2024-05-30 14:45:36', NULL),
(21, 16, 8, '2024-05-30 21:59:21', '0', '2024-05-30 14:44:57', '2024-05-30 14:59:21', NULL),
(22, 16, 1, '2024-05-30 21:59:28', '0', '2024-05-30 14:45:30', '2024-05-30 14:59:28', NULL),
(23, 17, 6, '2024-05-31 06:15:58', '500', '2024-05-30 15:28:48', '2024-05-30 23:15:58', NULL),
(24, 18, 5, '2024-05-31 06:02:26', '0', '2024-05-30 23:02:09', '2024-05-30 23:02:26', NULL),
(25, 18, 6, NULL, NULL, '2024-05-30 23:02:21', '2024-05-30 23:02:21', NULL),
(26, 18, 8, NULL, NULL, '2024-05-31 02:31:00', '2024-05-31 02:31:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `classrooms`
--

CREATE TABLE `classrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classroom_type_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `classrooms`
--

INSERT INTO `classrooms` (`id`, `classroom_type_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '10IPA1', '2024-05-28 03:41:06', '2024-05-28 03:41:06', NULL),
(2, 2, '10IPS1', '2024-05-28 03:41:06', '2024-05-28 03:41:06', NULL),
(3, 1, '11IPA1', '2024-05-29 20:19:32', '2024-05-29 20:19:32', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `classroom_types`
--

CREATE TABLE `classroom_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `classroom_types`
--

INSERT INTO `classroom_types` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ilmu Pengetahuan Alam', 'untuk kelas ipa', '2024-05-28 03:39:44', '2024-05-28 03:39:44', NULL),
(2, 'Ilmu Pengetahuan Sosial', 'untuk ips', '2024-05-28 03:39:44', '2024-05-28 03:39:44', NULL),
(3, 'Bahasa', 'untuk kelas bahasa', '2024-05-28 20:06:46', '2024-05-28 20:06:46', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `configurations`
--

CREATE TABLE `configurations` (
  `id` tinyint(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `book_penalty` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `configurations`
--

INSERT INTO `configurations` (`id`, `name`, `address`, `phone`, `email`, `book_penalty`) VALUES
(1, 'SMA Gamelab Indonesia', 'Salatiga', '344344', 'sma_gamelab@gmail.com', 500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `curriculums`
--

CREATE TABLE `curriculums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `curriculums`
--

INSERT INTO `curriculums` (`id`, `year`, `description`, `is_default`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2022/2023', 'kurikulum kompetensi', 0, '2024-05-16 03:36:05', '2024-05-31 03:39:30', NULL),
(2, '2023/2024', 'kurikulum merdeka', 1, '2024-05-28 03:36:38', '2024-05-31 03:39:30', NULL),
(3, '2021/2022', 'kurikulum kompetensi', 0, '2024-05-29 19:15:10', '2024-05-30 22:57:21', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `grades`
--

CREATE TABLE `grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_type_id` bigint(20) UNSIGNED NOT NULL,
  `student_teacher_classroom_relationship_id` bigint(20) UNSIGNED NOT NULL,
  `value` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_24_033309_create_books_table', 2),
(6, '2024_05_24_033936_create_books_table', 3),
(7, '2024_05_24_092550_create_book_categories_table', 4),
(8, '2024_05_24_093827_create_books_table', 5),
(9, '2024_05_24_143724_create_classroom_types_table', 6),
(10, '2024_05_24_143758_create_task_types_table', 6),
(11, '2024_05_24_143841_create_curriculums_table', 6),
(12, '2024_05_24_144021_create_tuition_types_table', 6),
(13, '2024_05_24_144127_create_subjects_table', 6),
(14, '2024_05_24_144157_create_classrooms_table', 6),
(15, '2024_05_24_144242_create_teacher_subject_relationships_table', 6),
(16, '2024_05_24_144330_create_teacher_classroom_relationships_table', 7),
(17, '2024_05_24_144510_create_teacher_homeroom_relationships_table', 7),
(18, '2024_05_24_144557_create_student_teacher_classroom_relationships_table', 8),
(19, '2024_05_24_144926_create_student_teacher_homeroom_relationships_table', 9),
(20, '2024_05_24_145054_create_grades_table', 9),
(21, '2024_05_24_145320_create_tuitions_table', 9),
(22, '2024_05_26_013528_add_image_and_published_date_to_books_table', 10),
(23, '2024_05_26_110853_create_borrowing_books_table', 11),
(24, '2024_05_26_115827_add_password_to_users_table', 12),
(25, '2024_05_26_120643_create_borrowing_books_table', 13),
(26, '2024_05_27_125018_create_borrowing_book_details_table', 14),
(27, '2024_05_29_064037_add_penalty_and_returned_date_to_table_borrowing_book_detail', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `student_teacher_classroom_relationships`
--

CREATE TABLE `student_teacher_classroom_relationships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_classroom_relationship_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `student_teacher_homeroom_relationships`
--

CREATE TABLE `student_teacher_homeroom_relationships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_homeroom_relationship_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `student_teacher_homeroom_relationships`
--

INSERT INTO `student_teacher_homeroom_relationships` (`id`, `student_id`, `teacher_homeroom_relationship_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 1, NULL, NULL, NULL),
(2, 2, 2, NULL, NULL, NULL),
(3, 4, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classroom_type_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `subjects`
--

INSERT INTO `subjects` (`id`, `classroom_type_id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Biologi', 'berkaitan dengan ilmu tentang tumbuhan', NULL, NULL, NULL),
(2, 2, 'Sejarah', 'ilmu yang bikin ngantuk', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `task_types`
--

CREATE TABLE `task_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `task_types`
--

INSERT INTO `task_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kuis 1', '2024-05-31 03:57:30', '2024-05-31 03:57:30', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `teacher_classroom_relationships`
--

CREATE TABLE `teacher_classroom_relationships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `curriculum_id` bigint(20) UNSIGNED NOT NULL,
  `classroom_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_subject_relationship_id` bigint(20) UNSIGNED NOT NULL,
  `schedule_day` date NOT NULL,
  `schedule_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `teacher_homeroom_relationships`
--

CREATE TABLE `teacher_homeroom_relationships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `classroom_id` bigint(20) UNSIGNED NOT NULL,
  `curriculum_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `teacher_homeroom_relationships`
--

INSERT INTO `teacher_homeroom_relationships` (`id`, `teacher_id`, `classroom_id`, `curriculum_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 1, 2, NULL, NULL, NULL),
(2, 5, 2, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `teacher_subject_relationships`
--

CREATE TABLE `teacher_subject_relationships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `teacher_subject_relationships`
--

INSERT INTO `teacher_subject_relationships` (`id`, `teacher_id`, `subject_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 1, NULL, NULL, NULL),
(2, 5, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tuitions`
--

CREATE TABLE `tuitions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tuition_types`
--

CREATE TABLE `tuition_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `identity_number` varchar(15) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `born_date` date NOT NULL,
  `phone` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `role` enum('Super Admin','Admin','Librarian','Teacher','Student','Parent') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `identity_number`, `name`, `username`, `password`, `email`, `gender`, `born_date`, `phone`, `nik`, `address`, `role`, `created_at`, `updated_at`) VALUES
(1, '0530001', 'Andi', 'andi1', '', 'andi@example.com', 'Laki-laki', '0000-00-00', '0821212121', '123123123131', 'semarang', 'Super Admin', NULL, NULL),
(2, '2410001', 'Joko', 'Joko', '123', 'joko@example.com', 'Laki-laki', '2024-05-26', '93123213', '1231', 'Malangsari', 'Student', NULL, NULL),
(3, '2410002', 'Anton', 'anton1', '$2y$12$PB0zc.8G./ZYD/IMDkPmeuxnsA6DI8JyKpUAcC5wMr08bTYL04FUK', 'anton1@example.com', 'Laki-laki', '2006-04-27', '0821212121', '23321321', 'Semarang', 'Student', '2024-05-26 19:55:43', '2024-05-26 19:55:43'),
(4, '2410003', 'Angle', 'angle', '$2y$12$T8fRpzYQJCu3kIjALIF.ReA5AdgVYXgpZF1xl0gS5mbR5gb7ua6XC', 'angle@example', 'Perempuan', '2005-05-27', '08121212', '42342342', 'Semarang', 'Student', '2024-05-26 20:04:46', '2024-05-26 20:04:46'),
(5, '9020001', 'Sulatri', 'sulas999', '1', 'sulastri@gmai.com', 'Perempuan', '2024-05-27', '1', '1', '1', 'Teacher', NULL, NULL),
(6, '9520002', 'Nur Hidayah', 'nurcaem90', '2', '2', 'Perempuan', '2024-05-28', '2', '2', '', 'Teacher', NULL, NULL),
(8, '2030001', 'Agung', 'agung1', '$2y$12$nd.xBz7uE4oAxZXT/ZHY6ep.g9LvZ2mF/zllYAdJbYOoMy2tFlk6W', 'agung1@example.com', 'Laki-laki', '2024-05-28', '213123', '12312312', 'Semarang', 'Librarian', '2024-05-28 00:15:31', '2024-05-28 00:15:31'),
(9, '9720001', 'Budi Doremi', 'budiDow', '12333', 'budy@bud.com', 'Laki-laki', '2024-05-29', '2424', '23444', 'semarang dekat debi', 'Teacher', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_isbn_unique` (`isbn`),
  ADD KEY `books_category_id_foreign` (`category_id`),
  ADD KEY `books_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `book_categories`
--
ALTER TABLE `book_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `borrowing_books`
--
ALTER TABLE `borrowing_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrowing_books_librarian_id_foreign` (`librarian_id`),
  ADD KEY `borrowing_books_student_id_foreign` (`student_id`);

--
-- Indeks untuk tabel `borrowing_book_details`
--
ALTER TABLE `borrowing_book_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrowing_book_details_borrowing_book_id_foreign` (`borrowing_book_id`),
  ADD KEY `borrowing_book_details_book_id_foreign` (`book_id`);

--
-- Indeks untuk tabel `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classrooms_classroom_type_id_foreign` (`classroom_type_id`);

--
-- Indeks untuk tabel `classroom_types`
--
ALTER TABLE `classroom_types`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `curriculums`
--
ALTER TABLE `curriculums`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grades_task_type_id_foreign` (`task_type_id`),
  ADD KEY `grades_student_teacher_classroom_relationship_id_foreign` (`student_teacher_classroom_relationship_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `student_teacher_classroom_relationships`
--
ALTER TABLE `student_teacher_classroom_relationships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_teacher_classroom_relationships_student_id_foreign` (`student_id`),
  ADD KEY `tcr_id` (`teacher_classroom_relationship_id`);

--
-- Indeks untuk tabel `student_teacher_homeroom_relationships`
--
ALTER TABLE `student_teacher_homeroom_relationships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_teacher_homeroom_relationships_student_id_foreign` (`student_id`),
  ADD KEY `thr_id` (`teacher_homeroom_relationship_id`);

--
-- Indeks untuk tabel `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subjects_classroom_type_id_foreign` (`classroom_type_id`);

--
-- Indeks untuk tabel `task_types`
--
ALTER TABLE `task_types`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `teacher_classroom_relationships`
--
ALTER TABLE `teacher_classroom_relationships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_classroom_relationships_curriculum_id_foreign` (`curriculum_id`),
  ADD KEY `teacher_classroom_relationships_classroom_id_foreign` (`classroom_id`),
  ADD KEY `tsr_id` (`teacher_subject_relationship_id`);

--
-- Indeks untuk tabel `teacher_homeroom_relationships`
--
ALTER TABLE `teacher_homeroom_relationships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_homeroom_relationships_teacher_id_foreign` (`teacher_id`),
  ADD KEY `teacher_homeroom_relationships_classroom_id_foreign` (`classroom_id`),
  ADD KEY `teacher_homeroom_relationships_curriculum_id_foreign` (`curriculum_id`);

--
-- Indeks untuk tabel `teacher_subject_relationships`
--
ALTER TABLE `teacher_subject_relationships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_subject_relationships_teacher_id_foreign` (`teacher_id`),
  ADD KEY `teacher_subject_relationships_subject_id_foreign` (`subject_id`);

--
-- Indeks untuk tabel `tuitions`
--
ALTER TABLE `tuitions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tuition_types`
--
ALTER TABLE `tuition_types`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nik_unique` (`nik`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `book_categories`
--
ALTER TABLE `book_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `borrowing_books`
--
ALTER TABLE `borrowing_books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `borrowing_book_details`
--
ALTER TABLE `borrowing_book_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `classroom_types`
--
ALTER TABLE `classroom_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `curriculums`
--
ALTER TABLE `curriculums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `student_teacher_classroom_relationships`
--
ALTER TABLE `student_teacher_classroom_relationships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `student_teacher_homeroom_relationships`
--
ALTER TABLE `student_teacher_homeroom_relationships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `task_types`
--
ALTER TABLE `task_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `teacher_classroom_relationships`
--
ALTER TABLE `teacher_classroom_relationships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `teacher_homeroom_relationships`
--
ALTER TABLE `teacher_homeroom_relationships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `teacher_subject_relationships`
--
ALTER TABLE `teacher_subject_relationships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tuitions`
--
ALTER TABLE `tuitions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tuition_types`
--
ALTER TABLE `tuition_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `book_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `books_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `borrowing_books`
--
ALTER TABLE `borrowing_books`
  ADD CONSTRAINT `borrowing_books_librarian_id_foreign` FOREIGN KEY (`librarian_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrowing_books_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `borrowing_book_details`
--
ALTER TABLE `borrowing_book_details`
  ADD CONSTRAINT `borrowing_book_details_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrowing_book_details_borrowing_book_id_foreign` FOREIGN KEY (`borrowing_book_id`) REFERENCES `borrowing_books` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `classrooms`
--
ALTER TABLE `classrooms`
  ADD CONSTRAINT `classrooms_classroom_type_id_foreign` FOREIGN KEY (`classroom_type_id`) REFERENCES `classroom_types` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_student_teacher_classroom_relationship_id_foreign` FOREIGN KEY (`student_teacher_classroom_relationship_id`) REFERENCES `student_teacher_classroom_relationships` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grades_task_type_id_foreign` FOREIGN KEY (`task_type_id`) REFERENCES `task_types` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `student_teacher_classroom_relationships`
--
ALTER TABLE `student_teacher_classroom_relationships`
  ADD CONSTRAINT `student_teacher_classroom_relationships_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tcr_id` FOREIGN KEY (`teacher_classroom_relationship_id`) REFERENCES `teacher_classroom_relationships` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `student_teacher_homeroom_relationships`
--
ALTER TABLE `student_teacher_homeroom_relationships`
  ADD CONSTRAINT `student_teacher_homeroom_relationships_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `thr_id` FOREIGN KEY (`teacher_homeroom_relationship_id`) REFERENCES `teacher_homeroom_relationships` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_classroom_type_id_foreign` FOREIGN KEY (`classroom_type_id`) REFERENCES `classroom_types` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `teacher_classroom_relationships`
--
ALTER TABLE `teacher_classroom_relationships`
  ADD CONSTRAINT `teacher_classroom_relationships_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_classroom_relationships_curriculum_id_foreign` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculums` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tsr_id` FOREIGN KEY (`teacher_subject_relationship_id`) REFERENCES `teacher_subject_relationships` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `teacher_homeroom_relationships`
--
ALTER TABLE `teacher_homeroom_relationships`
  ADD CONSTRAINT `teacher_homeroom_relationships_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_homeroom_relationships_curriculum_id_foreign` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculums` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_homeroom_relationships_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `teacher_subject_relationships`
--
ALTER TABLE `teacher_subject_relationships`
  ADD CONSTRAINT `teacher_subject_relationships_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_subject_relationships_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
