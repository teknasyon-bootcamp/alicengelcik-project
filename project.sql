-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: mariadb
-- Üretim Zamanı: 13 Eki 2021, 20:24:34
-- Sunucu sürümü: 10.6.4-MariaDB-1:10.6.4+maria~focal
-- PHP Sürümü: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `project`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `table` varchar(100) NOT NULL,
  `process` varchar(100) NOT NULL COMMENT 'create,update,delete',
  `user_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `category`
--

INSERT INTO `category` (`id`, `category`, `created_at`) VALUES
(1, 'TECHNOLOGY', '2021-10-04 11:57:33'),
(2, 'BUSINESS', '2021-10-04 11:57:33'),
(3, 'ECONOMY', '2021-10-04 11:57:33'),
(4, 'SPORT', '2021-10-04 11:57:33'),
(5, 'HEALTH', '2021-10-04 11:57:33'),
(6, 'MAGAZINE', '2021-10-04 11:57:33');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `new_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `anonymous` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` int(11) NOT NULL,
  `confirm_user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`id`, `new_id`, `user_id`, `anonymous`, `comment`, `status`, `confirm_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur, hic?', 2, 1, '2021-10-06 18:06:29', '2021-10-09 10:19:20'),
(2, 1, 1, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur, hic?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur, hic?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur, hic?', 2, 1, '2021-10-06 18:06:29', '2021-10-09 10:19:20'),
(6, 1, 2, 1, 'Anonymous comment', 2, NULL, '2021-10-07 22:56:54', '2021-10-09 10:19:20'),
(7, 1, 1, 0, 'Test normal yorum', 2, NULL, '2021-10-08 07:03:04', '2021-10-09 12:16:58'),
(10, 2, 1, 0, 'test haber 2 yorum', 2, NULL, '2021-10-09 12:32:00', '2021-10-09 12:32:22'),
(37, 2, 1, 1, 'test anonymous', 2, NULL, '2021-10-13 19:59:39', '2021-10-13 20:00:00'),
(39, 1, 1, 0, 'gdfgdfg', 1, NULL, '2021-10-13 22:09:51', '2021-10-13 22:09:51');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comment_status`
--

CREATE TABLE `comment_status` (
  `id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `value` varchar(50) NOT NULL,
  `value_tr` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `comment_status`
--

INSERT INTO `comment_status` (`id`, `status_id`, `value`, `value_tr`) VALUES
(1, 1, 'Awaiting Approval', 'Onay Bekliyor'),
(2, 2, 'Approved/Published', 'Yayınlandı'),
(3, 3, 'Denied', 'Reddedildi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `config_name` varchar(50) NOT NULL,
  `config_type` varchar(50) NOT NULL COMMENT '1 day, 2 year',
  `config_value` int(11) NOT NULL COMMENT 'süre'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `config`
--

INSERT INTO `config` (`id`, `config_name`, `config_type`, `config_value`) VALUES
(1, 'news_time', '1', 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `header` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `news`
--

INSERT INTO `news` (`id`, `header`, `content`, `image`, `user_id`, `update_user_id`, `created_at`, `updated_at`) VALUES
(1, '1-) Lorem ipsum dolor sit amet, consectetur', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque enim illum ipsam molestiae perspiciatis porro provident soluta veritatis. A ad aspernatur blanditiis delectus deserunt dicta eum ex, harum, impedit iure labore laudantium magnam, maiores nisi officia optio porro quaerat quam qui quis quod quos repellat repudiandae sit soluta totam voluptate voluptatibus. Alias aspernatur at autem consectetur corporis delectus dolore, ducimus enim facere fuga inventore ipsam, molestiae natus necessitatibus nesciunt optio quae quam quia quo ratione similique tempora tempore velit veniam voluptate. Ad assumenda aut corporis culpa cum dolorem eius explicabo ipsa, iusto, mollitia natus neque numquam ut voluptatem voluptatibus? Aspernatur fuga neque officia voluptatum. Adipisci aliquam amet beatae consequatur cum cumque distinctio esse eum expedita illum libero, maiores molestiae quae, quod suscipit veritatis voluptate? Expedita facere perferendis sapiente suscipit voluptates voluptatibus. Beatae eaque eum iure iusto laborum minima officiis omnis similique? A amet architecto asperiores aut consequatur, culpa delectus deleniti deserunt doloremque eaque earum et ex expedita hic id ipsam labore laboriosam laudantium modi nam nulla obcaecati placeat porro quae quis quod recusandae saepe sed sint tempore veniam vero voluptatem voluptates. Accusamus aliquam aliquid atque consequatur cupiditate debitis deleniti dolor doloribus earum eius eligendi enim hic id illum impedit in itaque, maxime minus nam necessitatibus odit officia officiis perspiciatis possimus quas quasi, quis quod quos reprehenderit similique totam ut vel vero. A commodi dolorum eaque illum minima, natus necessitatibus nisi numquam omnis quo, ratione, repellendus repudiandae vitae. Consequuntur distinctio dolores, eligendi impedit in quam recusandae sit? Ab accusamus adipisci architecto blanditiis consequuntur corporis cumque dolore ducimus ea esse excepturi fuga harum iusto maxime minima, necessitatibus nemo nulla perspiciatis quaerat qui quidem quo quos recusandae repellat reprehenderit tempore, unde vitae? Ad alias autem eos ex excepturi fuga, nisi officia quos, repellat, sit vel veritatis? Aut error est facere ipsam maiores nihil officiis, quia velit veniam voluptate. Eaque iste quibusdam tempora veniam! Asperiores cupiditate eos ex nihil repellat vel? Ab asperiores commodi corporis doloribus facere, maiores odio, possimus repudiandae rerum sed velit voluptatibus? Alias, asperiores at cum expedita inventore iusto nam nulla placeat provident quaerat qui reprehenderit rerum saepe temporibus vero? Ad consequuntur eaque esse facere, iste laborum magni minus natus nesciunt nobis obcaecati, quibusdam totam unde, veniam voluptatibus. Ipsam, iusto vel. Accusantium, alias autem consequatur cupiditate deleniti dolor dolores dolorum eligendi eum explicabo, facere hic in ipsa modi mollitia nam natus necessitatibus nihil nobis nulla optio porro quasi repellendus rerum sapiente tenetur ut voluptates? Ad animi, aperiam asperiores at, delectus deserunt ea eum exercitationem labore libero magni minima nam nostrum perferendis quam quo quod quos ratione. Adipisci aliquid amet at aut blanditiis consectetur debitis dolore doloribus impedit iste itaque iusto laboriosam nesciunt obcaecati, porro quam, recusandae repellat reprehenderit sequi, tenetur ullam unde voluptas voluptatibus! Alias ea error explicabo magni modi, possimus ratione soluta tempore velit voluptates. Necessitatibus qui, unde. A aliquam consequatur delectus dolores eius incidunt laudantium minima nemo placeat quam quasi, qui temporibus veniam veritatis voluptates. Consectetur eius, error ex fugiat non totam voluptates! Error est libero nemo possimus quos?', 'news_61612e66ae9505.71521731.jpg', 1, NULL, '2021-10-05 22:12:56', '2021-10-09 12:38:45'),
(2, '2- Lorem ipsum dolor sit amet, consectetur.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque enim illum ipsam molestiae perspiciatis porro provident soluta veritatis. A ad aspernatur blitiis delectus deserunt dicta eum ex, harum, impedit iure labore laudantium magnam, maiores nisi officia optio porro quaerat quam qui quis quod quos repellat repudiae sit soluta totam voluptate voluptatibus. Alias aspernatur at autem consectetur corporis delectus dolore, ducimus enim facere fuga inventore ipsam, molestiae natus necessitatibus nesciunt optio quae quam quia quo ratione similique tempora tempore velit veniam voluptate. Ad assumenda aut corporis culpa cum dolorem eius explicabo ipsa, iusto, mollitia natus neque numquam ut voluptatem voluptatibus? Aspernatur fuga neque officia voluptatum. Adipisci aliquam amet beatae consequatur cum cumque distinctio esse eum expedita illum libero, maiores molestiae quae, quod suscipit veritatis voluptate? Expedita facere perferendis sapiente suscipit voluptates voluptatibus. Beatae eaque eum iure iusto laborum minima officiis omnis similique? A amet architecto asperiores aut consequatur, culpa delectus deleniti deserunt doloremque eaque earum et ex expedita hic id ipsam labore laboriosam laudantium modi nam nulla obcaecati placeat porro quae quis quod recusae saepe sed sint tempore veniam vero voluptatem voluptates. Accusamus aliquam aliquid atque consequatur cupiditate debitis deleniti dolor doloribus earum eius eligendi enim hic id illum impedit in itaque, maxime minus nam necessitatibus odit officia officiis perspiciatis possimus quas quasi, quis quod quos reprehenderit similique totam ut vel vero. A commodi dolorum eaque illum minima, natus necessitatibus nisi numquam omnis quo, ratione, repellendus repudiae vitae. Consequuntur distinctio dolores, eligendi impedit in quam recusae sit? Ab accusamus adipisci architecto blitiis consequuntur corporis cumque dolore ducimus ea esse excepturi fuga harum iusto maxime minima, necessitatibus nemo nulla perspiciatis quaerat qui quidem quo quos recusae repellat reprehenderit tempore, unde vitae? Ad alias autem eos ex excepturi fuga, nisi officia quos, repellat, sit vel veritatis? Aut error est facere ipsam maiores nihil officiis, quia velit veniam voluptate. Eaque iste quibusdam tempora veniam! Asperiores cupiditate eos ex nihil repellat vel? Ab asperiores commodi corporis doloribus facere, maiores odio, possimus repudiae rerum sed velit voluptatibus? Alias, asperiores at cum expedita inventore iusto nam nulla placeat provident quaerat qui reprehenderit rerum saepe temporibus vero? Ad consequuntur eaque esse facere, iste laborum magni minus natus nesciunt nobis obcaecati, quibusdam totam unde, veniam voluptatibus. Ipsam, iusto vel. Accusantium, alias autem consequatur cupiditate deleniti dolor dolores dolorum eligendi eum explicabo, facere hic in ipsa modi mollitia nam natus necessitatibus nihil nobis nulla optio porro quasi repellendus rerum sapiente tenetur ut voluptates? Ad animi, aperiam asperiores at, delectus deserunt ea eum exercitationem labore libero magni minima nam nostrum perferendis quam quo quod quos ratione. Adipisci aliquid amet at aut blitiis consectetur debitis dolore doloribus impedit iste itaque iusto laboriosam nesciunt obcaecati, porro quam, recusae repellat reprehenderit sequi, tenetur ullam unde voluptas voluptatibus! Alias ea error explicabo magni modi, possimus ratione soluta tempore velit voluptates. Necessitatibus qui, unde. A aliquam consequatur delectus dolores eius incidunt laudantium minima nemo placeat quam quasi, qui temporibus veniam veritatis voluptates. Consectetur eius, error ex fugiat non totam voluptates! Error est libero nemo possimus quos?\r\n', 'news_61612e825f8c04.86707496.jpg', 1, NULL, '2021-10-05 22:12:56', '2021-10-12 17:22:33'),
(101, 'sfasfasfasfasf', 'dfgsdgsdgsdg', 'news_6165ca3041ef93.24546039.jpg', 11, 11, '2021-10-12 20:06:42', '2021-10-12 20:47:28'),
(103, 'sgsdfgsdfds', 'sdfsdfsfsdf', 'news_6165ca6f158696.36046816.jpg', 2, NULL, '2021-10-12 20:48:31', '2021-10-12 20:48:31');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `news_view`
--

CREATE TABLE `news_view` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `news_view`
--

INSERT INTO `news_view` (`id`, `news_id`, `created_at`, `user_id`) VALUES
(7, 103, '2021-10-12 21:50:03', 1),
(8, 1, '2021-10-12 22:14:34', 1),
(9, 2, '2021-10-12 22:14:36', 1),
(10, 101, '2021-10-12 22:14:37', 1),
(11, 1, '2021-10-13 05:51:09', 1),
(12, 101, '2021-10-13 05:58:23', 1),
(13, 2, '2021-10-13 05:58:49', 1),
(14, 103, '2021-10-13 05:58:50', 1),
(15, 1, '2021-10-13 23:24:21', 11);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `desc`) VALUES
(1, 'Haber Ekleme-Düzenleme', 'Editor-Haber ekleme işlemi'),
(2, 'Yorum Denetleme', 'Moderator-Yorum onay, red, silme işlemleri'),
(3, 'Hesap İşlemleri', 'Moderator-Userdan gelen hesap silme işlem denetimi'),
(4, 'Kategori Kontrolü', 'Moderator-Editörün kategorilerini düzenleme'),
(5, 'Haber Denetimi(Tüm)', 'Moderator-Haber ekle, silme, düzenleme işlemleri'),
(6, 'Editor ve Kullanıcı Aktivitelerini görme', 'Moderator- Sadece Editor ve Kullanıcı Aktivitelerini görme yetkisi'),
(7, 'Editor, Kullanıcı Yetki Düzenleme', 'Moderator-Editor, Kullanıcılara ait Yetkilerin Düzenlenmesi'),
(8, 'Haber Düzenleme Süresi', 'Moderator-Belirlenen süre içerisinde Editor haber düzenlemesi yapabilir'),
(9, 'Yetki Düzenleme', 'Admin - Tüm kullanıcıların yetkilerinin düzenlemesi'),
(10, 'Tüm Aktiviteler', 'Admin-Tüm activity loglarını görme'),
(11, 'Bakım modu', 'Admin-Sistemi bakım moduna alma'),
(12, 'Hesap silme isteği', 'User-Hesap silme isteğinde bulunma'),
(13, 'Yorum Ekleme', 'User-Yorum ekleme'),
(14, 'Haber kategorileri yetkisi', 'Haber kategorilerini ekleme silme düzenleme'),
(99, 'Panel-Yönetim Yetkisi', 'Bu yetki olmadıkça yönetim paneline ulaşamasın');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `resource_category`
--

CREATE TABLE `resource_category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `resource` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `resource_category`
--

INSERT INTO `resource_category` (`id`, `category_id`, `resource_id`, `resource`) VALUES
(1, 1, 1, 'news'),
(2, 4, 2, 'news'),
(270, 3, 10, 'follow'),
(271, 2, 10, 'follow'),
(288, 1, 2, 'user'),
(289, 2, 2, 'user'),
(290, 4, 2, 'user'),
(291, 6, 2, 'user'),
(326, 2, 101, 'news'),
(335, 1, 11, 'user'),
(336, 2, 11, 'user'),
(337, 3, 11, 'user'),
(338, 4, 11, 'user'),
(339, 5, 11, 'user'),
(340, 6, 11, 'user'),
(341, 1, 103, 'news'),
(361, 1, 1, 'follow'),
(362, 2, 1, 'follow'),
(363, 3, 1, 'follow'),
(370, 1, 1, 'user'),
(371, 2, 1, 'user'),
(372, 3, 1, 'user'),
(373, 4, 1, 'user'),
(374, 5, 1, 'user'),
(375, 6, 1, 'user'),
(376, 1, 10, 'user'),
(377, 2, 10, 'user');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `resource_permission`
--

CREATE TABLE `resource_permission` (
  `id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `resource` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `resource_permission`
--

INSERT INTO `resource_permission` (`id`, `permission_id`, `resource_id`, `resource`) VALUES
(133, 12, 4, 'role'),
(134, 13, 4, 'role'),
(191, 1, 3, 'role'),
(192, 99, 3, 'role'),
(243, 1, 2, 'role'),
(244, 2, 2, 'role'),
(245, 3, 2, 'role'),
(246, 4, 2, 'role'),
(247, 5, 2, 'role'),
(248, 6, 2, 'role'),
(249, 7, 2, 'role'),
(250, 8, 2, 'role'),
(251, 99, 2, 'role'),
(252, 1, 1, 'role'),
(253, 2, 1, 'role'),
(254, 3, 1, 'role'),
(255, 4, 1, 'role'),
(256, 5, 1, 'role'),
(257, 6, 1, 'role'),
(258, 7, 1, 'role'),
(259, 8, 1, 'role'),
(260, 9, 1, 'role'),
(261, 10, 1, 'role'),
(262, 11, 1, 'role'),
(263, 12, 1, 'role'),
(264, 13, 1, 'role'),
(265, 14, 1, 'role'),
(266, 99, 1, 'role');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `resource_role`
--

CREATE TABLE `resource_role` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `resource` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `resource_role`
--

INSERT INTO `resource_role` (`id`, `role_id`, `resource_id`, `resource`) VALUES
(1, 1, 1, 'user'),
(2, 2, 2, 'user'),
(11, 3, 10, 'user'),
(12, 4, 11, 'user');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `roles`
--

INSERT INTO `roles` (`id`, `role`, `level`) VALUES
(1, 'Admin', 1),
(2, 'Moderator', 2),
(3, 'Editor', 3),
(4, 'User', 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `gender` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `gender`, `email`, `password`, `image`) VALUES
(1, 'Eray', 'Aydın', 1, 'admin@admin.com', '$2y$10$Iby9fRRxVUDLzeYzpB/VYeCdGwDFhx1pVBr3Fwqom36ghFObG.N8u', 'user_male.png'),
(2, 'Test', 'Moderator', 2, 'moderator@moderator.com', '$2y$10$rQ9xlPlE8v5nTcxNRJcMtOvYvCm1hfrSwA2RCnSYkvryNfMQk5ovK', 'user_female.png'),
(10, 'Test', 'Editor', 1, 'editor@editor.com', '$2y$10$L4FQV/wC3dQdjBZ8WMPVAuUh4dKlwNpVyRYqSrr/jw0Vqf67Af5Nq', 'user_male.png'),
(11, 'Test', 'User', 2, 'user@user.com', '$2y$10$xTAruUgAYCXOFUkfZP/oL.BhSMoAJsIOH7.VPFCZ7mH/9YqIH.3r2', 'user_female.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_delete`
--

CREATE TABLE `user_delete` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` text NOT NULL,
  `confirm_user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `user_delete`
--

INSERT INTO `user_delete` (`id`, `name`, `email`, `gender`, `user_id`, `status`, `description`, `confirm_user_id`, `created_at`, `updated_at`) VALUES
(11, 'Selami Yılmaz', 'selami@selami.com', 1, 3, 2, 'bfxgdsgsg', NULL, '2021-10-09 22:04:08', '2021-10-11 06:14:04'),
(14, 'test test', 'test@test.com', 1, 5, 2, 'cxvxcvcxvcxv', NULL, '2021-10-11 05:44:56', '2021-10-11 06:20:24'),
(15, 'test test', '1test@test.com', 1, 6, 2, 'cxvxcvcxvcxv', NULL, '2021-10-11 05:44:56', '2021-10-11 06:30:44'),
(16, 'test test', '2test@test.com', 1, 7, 2, 'cxvxcvcxvcxv', NULL, '2021-10-11 05:44:56', '2021-10-11 07:13:05'),
(17, 'test test', '3test@test.com', 1, 8, 3, 'cxvxcvcxvcxv', NULL, '2021-10-11 05:44:56', '2021-10-11 23:10:00'),
(18, 'test test', '4test@test.com', 1, 9, 3, 'cxvxcvcxvcxv', NULL, '2021-10-11 05:44:56', '2021-10-11 23:10:00'),
(24, 'veli veli', 'veli@veli.com', 1, 16, 2, 'fdghdfgdfg', 1, '2021-10-13 21:38:52', '2021-10-13 21:39:21');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_delete_status`
--

CREATE TABLE `user_delete_status` (
  `id` int(11) NOT NULL,
  `status_id` varchar(100) NOT NULL,
  `value_tr` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `user_delete_status`
--

INSERT INTO `user_delete_status` (`id`, `status_id`, `value_tr`, `value`) VALUES
(1, '1', 'Onay bekliyor', 'Awaiting Approval'),
(2, '2', 'Onaylandı', 'Approved'),
(3, '3', 'Reddedildi', 'Denied');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `comment_status`
--
ALTER TABLE `comment_status`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Tablo için indeksler `news_view`
--
ALTER TABLE `news_view`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `resource_category`
--
ALTER TABLE `resource_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Category` (`category_id`);

--
-- Tablo için indeksler `resource_permission`
--
ALTER TABLE `resource_permission`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `resource_role`
--
ALTER TABLE `resource_role`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `user_delete`
--
ALTER TABLE `user_delete`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `user_delete_status`
--
ALTER TABLE `user_delete_status`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Tablo için AUTO_INCREMENT değeri `comment_status`
--
ALTER TABLE `comment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- Tablo için AUTO_INCREMENT değeri `news_view`
--
ALTER TABLE `news_view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Tablo için AUTO_INCREMENT değeri `resource_category`
--
ALTER TABLE `resource_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=378;

--
-- Tablo için AUTO_INCREMENT değeri `resource_permission`
--
ALTER TABLE `resource_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- Tablo için AUTO_INCREMENT değeri `resource_role`
--
ALTER TABLE `resource_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `user_delete`
--
ALTER TABLE `user_delete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Tablo için AUTO_INCREMENT değeri `user_delete_status`
--
ALTER TABLE `user_delete_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
