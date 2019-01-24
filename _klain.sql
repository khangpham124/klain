-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 24, 2019 at 08:29 AM
-- Server version: 10.1.37-MariaDB-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vnesefreelance_klain`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_commentmeta`
--

CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_comments`
--

CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `comment_post_ID` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `comment_author` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_comments`
--

INSERT INTO `wp_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'Một người bình luận WordPress', 'wapuu@wordpress.example', 'https://wordpress.org/', '', '2019-01-06 08:02:02', '2019-01-06 08:02:02', 'Xin chào, đây là một bình luận\nĐể bắt đầu với quản trị bình luận, chỉnh sửa hoặc xóa bình luận, vui lòng truy cập vào khu vực Bình luận trong trang quản trị.\nAvatar của người bình luận sử dụng <a href=\"https://gravatar.com\">Gravatar</a>.', 0, 'post-trashed', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_links`
--

CREATE TABLE `wp_links` (
  `link_id` bigint(20) UNSIGNED NOT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_options`
--

CREATE TABLE `wp_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_options`
--

INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://vnese-freelance.co/projects/klain/admin', 'yes'),
(2, 'home', 'http://vnese-freelance.co/projects/klain/', 'yes'),
(3, 'blogname', 'Klain-portal', 'yes'),
(4, 'blogdescription', 'Một trang web mới sử dụng WordPress', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'khangpham421@gmail.com', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '1', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'j F, Y', 'yes'),
(24, 'time_format', 'g:i a', 'yes'),
(25, 'links_updated_date_format', 'j F, Y g:i a', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/%category%/%postname%/', 'yes'),
(29, 'rewrite_rules', 'a:245:{s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:8:\"users/?$\";s:25:\"index.php?post_type=users\";s:38:\"users/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?post_type=users&feed=$matches[1]\";s:33:\"users/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?post_type=users&feed=$matches[1]\";s:25:\"users/page/([0-9]{1,})/?$\";s:43:\"index.php?post_type=users&paged=$matches[1]\";s:12:\"customers/?$\";s:29:\"index.php?post_type=customers\";s:42:\"customers/feed/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?post_type=customers&feed=$matches[1]\";s:37:\"customers/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?post_type=customers&feed=$matches[1]\";s:29:\"customers/page/([0-9]{1,})/?$\";s:47:\"index.php?post_type=customers&paged=$matches[1]\";s:11:\"services/?$\";s:28:\"index.php?post_type=services\";s:41:\"services/feed/(feed|rdf|rss|rss2|atom)/?$\";s:45:\"index.php?post_type=services&feed=$matches[1]\";s:36:\"services/(feed|rdf|rss|rss2|atom)/?$\";s:45:\"index.php?post_type=services&feed=$matches[1]\";s:28:\"services/page/([0-9]{1,})/?$\";s:46:\"index.php?post_type=services&paged=$matches[1]\";s:7:\"ekip/?$\";s:24:\"index.php?post_type=ekip\";s:37:\"ekip/feed/(feed|rdf|rss|rss2|atom)/?$\";s:41:\"index.php?post_type=ekip&feed=$matches[1]\";s:32:\"ekip/(feed|rdf|rss|rss2|atom)/?$\";s:41:\"index.php?post_type=ekip&feed=$matches[1]\";s:24:\"ekip/page/([0-9]{1,})/?$\";s:42:\"index.php?post_type=ekip&paged=$matches[1]\";s:10:\"surgery/?$\";s:27:\"index.php?post_type=surgery\";s:40:\"surgery/feed/(feed|rdf|rss|rss2|atom)/?$\";s:44:\"index.php?post_type=surgery&feed=$matches[1]\";s:35:\"surgery/(feed|rdf|rss|rss2|atom)/?$\";s:44:\"index.php?post_type=surgery&feed=$matches[1]\";s:27:\"surgery/page/([0-9]{1,})/?$\";s:45:\"index.php?post_type=surgery&paged=$matches[1]\";s:11:\"supplies/?$\";s:28:\"index.php?post_type=supplies\";s:41:\"supplies/feed/(feed|rdf|rss|rss2|atom)/?$\";s:45:\"index.php?post_type=supplies&feed=$matches[1]\";s:36:\"supplies/(feed|rdf|rss|rss2|atom)/?$\";s:45:\"index.php?post_type=supplies&feed=$matches[1]\";s:28:\"supplies/page/([0-9]{1,})/?$\";s:46:\"index.php?post_type=supplies&paged=$matches[1]\";s:47:\"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:42:\"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:23:\"category/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:35:\"category/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:17:\"category/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:44:\"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:39:\"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:20:\"tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:32:\"tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:14:\"tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:45:\"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:40:\"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:21:\"type/([^/]+)/embed/?$\";s:44:\"index.php?post_format=$matches[1]&embed=true\";s:33:\"type/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?post_format=$matches[1]&paged=$matches[2]\";s:15:\"type/([^/]+)/?$\";s:33:\"index.php?post_format=$matches[1]\";s:52:\"servicescat/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?servicescat=$matches[1]&feed=$matches[2]\";s:47:\"servicescat/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?servicescat=$matches[1]&feed=$matches[2]\";s:28:\"servicescat/([^/]+)/embed/?$\";s:44:\"index.php?servicescat=$matches[1]&embed=true\";s:40:\"servicescat/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?servicescat=$matches[1]&paged=$matches[2]\";s:22:\"servicescat/([^/]+)/?$\";s:33:\"index.php?servicescat=$matches[1]\";s:48:\"typecat/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?typecat=$matches[1]&feed=$matches[2]\";s:43:\"typecat/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?typecat=$matches[1]&feed=$matches[2]\";s:24:\"typecat/([^/]+)/embed/?$\";s:40:\"index.php?typecat=$matches[1]&embed=true\";s:36:\"typecat/([^/]+)/page/?([0-9]{1,})/?$\";s:47:\"index.php?typecat=$matches[1]&paged=$matches[2]\";s:18:\"typecat/([^/]+)/?$\";s:29:\"index.php?typecat=$matches[1]\";s:49:\"userscat/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?userscat=$matches[1]&feed=$matches[2]\";s:44:\"userscat/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?userscat=$matches[1]&feed=$matches[2]\";s:25:\"userscat/([^/]+)/embed/?$\";s:41:\"index.php?userscat=$matches[1]&embed=true\";s:37:\"userscat/([^/]+)/page/?([0-9]{1,})/?$\";s:48:\"index.php?userscat=$matches[1]&paged=$matches[2]\";s:19:\"userscat/([^/]+)/?$\";s:30:\"index.php?userscat=$matches[1]\";s:33:\"users/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:43:\"users/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:63:\"users/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:58:\"users/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:58:\"users/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:39:\"users/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:22:\"users/([^/]+)/embed/?$\";s:38:\"index.php?users=$matches[1]&embed=true\";s:26:\"users/([^/]+)/trackback/?$\";s:32:\"index.php?users=$matches[1]&tb=1\";s:46:\"users/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:44:\"index.php?users=$matches[1]&feed=$matches[2]\";s:41:\"users/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:44:\"index.php?users=$matches[1]&feed=$matches[2]\";s:34:\"users/([^/]+)/page/?([0-9]{1,})/?$\";s:45:\"index.php?users=$matches[1]&paged=$matches[2]\";s:41:\"users/([^/]+)/comment-page-([0-9]{1,})/?$\";s:45:\"index.php?users=$matches[1]&cpage=$matches[2]\";s:30:\"users/([^/]+)(?:/([0-9]+))?/?$\";s:44:\"index.php?users=$matches[1]&page=$matches[2]\";s:22:\"users/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:32:\"users/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:52:\"users/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:47:\"users/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:47:\"users/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:28:\"users/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:37:\"customers/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:47:\"customers/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:67:\"customers/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:62:\"customers/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:62:\"customers/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:43:\"customers/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:26:\"customers/([^/]+)/embed/?$\";s:42:\"index.php?customers=$matches[1]&embed=true\";s:30:\"customers/([^/]+)/trackback/?$\";s:36:\"index.php?customers=$matches[1]&tb=1\";s:50:\"customers/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:48:\"index.php?customers=$matches[1]&feed=$matches[2]\";s:45:\"customers/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:48:\"index.php?customers=$matches[1]&feed=$matches[2]\";s:38:\"customers/([^/]+)/page/?([0-9]{1,})/?$\";s:49:\"index.php?customers=$matches[1]&paged=$matches[2]\";s:45:\"customers/([^/]+)/comment-page-([0-9]{1,})/?$\";s:49:\"index.php?customers=$matches[1]&cpage=$matches[2]\";s:34:\"customers/([^/]+)(?:/([0-9]+))?/?$\";s:48:\"index.php?customers=$matches[1]&page=$matches[2]\";s:26:\"customers/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:36:\"customers/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:56:\"customers/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:51:\"customers/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:51:\"customers/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:32:\"customers/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:36:\"services/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:46:\"services/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:66:\"services/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:61:\"services/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:61:\"services/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:42:\"services/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:25:\"services/([^/]+)/embed/?$\";s:41:\"index.php?services=$matches[1]&embed=true\";s:29:\"services/([^/]+)/trackback/?$\";s:35:\"index.php?services=$matches[1]&tb=1\";s:49:\"services/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?services=$matches[1]&feed=$matches[2]\";s:44:\"services/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?services=$matches[1]&feed=$matches[2]\";s:37:\"services/([^/]+)/page/?([0-9]{1,})/?$\";s:48:\"index.php?services=$matches[1]&paged=$matches[2]\";s:44:\"services/([^/]+)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?services=$matches[1]&cpage=$matches[2]\";s:33:\"services/([^/]+)(?:/([0-9]+))?/?$\";s:47:\"index.php?services=$matches[1]&page=$matches[2]\";s:25:\"services/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:35:\"services/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:55:\"services/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:50:\"services/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:50:\"services/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:31:\"services/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:32:\"ekip/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:42:\"ekip/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:62:\"ekip/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:57:\"ekip/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:57:\"ekip/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:38:\"ekip/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:21:\"ekip/([^/]+)/embed/?$\";s:37:\"index.php?ekip=$matches[1]&embed=true\";s:25:\"ekip/([^/]+)/trackback/?$\";s:31:\"index.php?ekip=$matches[1]&tb=1\";s:45:\"ekip/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?ekip=$matches[1]&feed=$matches[2]\";s:40:\"ekip/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?ekip=$matches[1]&feed=$matches[2]\";s:33:\"ekip/([^/]+)/page/?([0-9]{1,})/?$\";s:44:\"index.php?ekip=$matches[1]&paged=$matches[2]\";s:40:\"ekip/([^/]+)/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?ekip=$matches[1]&cpage=$matches[2]\";s:29:\"ekip/([^/]+)(?:/([0-9]+))?/?$\";s:43:\"index.php?ekip=$matches[1]&page=$matches[2]\";s:21:\"ekip/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:31:\"ekip/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:51:\"ekip/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:46:\"ekip/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:46:\"ekip/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:27:\"ekip/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:35:\"surgery/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:45:\"surgery/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:65:\"surgery/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:60:\"surgery/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:60:\"surgery/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:41:\"surgery/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:24:\"surgery/([^/]+)/embed/?$\";s:40:\"index.php?surgery=$matches[1]&embed=true\";s:28:\"surgery/([^/]+)/trackback/?$\";s:34:\"index.php?surgery=$matches[1]&tb=1\";s:48:\"surgery/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?surgery=$matches[1]&feed=$matches[2]\";s:43:\"surgery/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?surgery=$matches[1]&feed=$matches[2]\";s:36:\"surgery/([^/]+)/page/?([0-9]{1,})/?$\";s:47:\"index.php?surgery=$matches[1]&paged=$matches[2]\";s:43:\"surgery/([^/]+)/comment-page-([0-9]{1,})/?$\";s:47:\"index.php?surgery=$matches[1]&cpage=$matches[2]\";s:32:\"surgery/([^/]+)(?:/([0-9]+))?/?$\";s:46:\"index.php?surgery=$matches[1]&page=$matches[2]\";s:24:\"surgery/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:34:\"surgery/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:54:\"surgery/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:49:\"surgery/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:49:\"surgery/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:30:\"surgery/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:36:\"supplies/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:46:\"supplies/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:66:\"supplies/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:61:\"supplies/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:61:\"supplies/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:42:\"supplies/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:25:\"supplies/([^/]+)/embed/?$\";s:41:\"index.php?supplies=$matches[1]&embed=true\";s:29:\"supplies/([^/]+)/trackback/?$\";s:35:\"index.php?supplies=$matches[1]&tb=1\";s:49:\"supplies/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?supplies=$matches[1]&feed=$matches[2]\";s:44:\"supplies/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?supplies=$matches[1]&feed=$matches[2]\";s:37:\"supplies/([^/]+)/page/?([0-9]{1,})/?$\";s:48:\"index.php?supplies=$matches[1]&paged=$matches[2]\";s:44:\"supplies/([^/]+)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?supplies=$matches[1]&cpage=$matches[2]\";s:33:\"supplies/([^/]+)(?:/([0-9]+))?/?$\";s:47:\"index.php?supplies=$matches[1]&page=$matches[2]\";s:25:\"supplies/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:35:\"supplies/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:55:\"supplies/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:50:\"supplies/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:50:\"supplies/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:31:\"supplies/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:8:\"embed/?$\";s:21:\"index.php?&embed=true\";s:20:\"page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:17:\"comments/embed/?$\";s:21:\"index.php?&embed=true\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:20:\"search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:14:\"search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:23:\"author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:17:\"author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:19:\"([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:13:\"([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";s:31:\".+?/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:41:\".+?/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:61:\".+?/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:56:\".+?/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:56:\".+?/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:37:\".+?/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:22:\"(.+?)/([^/]+)/embed/?$\";s:63:\"index.php?category_name=$matches[1]&name=$matches[2]&embed=true\";s:26:\"(.+?)/([^/]+)/trackback/?$\";s:57:\"index.php?category_name=$matches[1]&name=$matches[2]&tb=1\";s:46:\"(.+?)/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:69:\"index.php?category_name=$matches[1]&name=$matches[2]&feed=$matches[3]\";s:41:\"(.+?)/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:69:\"index.php?category_name=$matches[1]&name=$matches[2]&feed=$matches[3]\";s:34:\"(.+?)/([^/]+)/page/?([0-9]{1,})/?$\";s:70:\"index.php?category_name=$matches[1]&name=$matches[2]&paged=$matches[3]\";s:41:\"(.+?)/([^/]+)/comment-page-([0-9]{1,})/?$\";s:70:\"index.php?category_name=$matches[1]&name=$matches[2]&cpage=$matches[3]\";s:30:\"(.+?)/([^/]+)(?:/([0-9]+))?/?$\";s:69:\"index.php?category_name=$matches[1]&name=$matches[2]&page=$matches[3]\";s:20:\".+?/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:30:\".+?/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:50:\".+?/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:45:\".+?/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:45:\".+?/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:26:\".+?/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:38:\"(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:33:\"(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:14:\"(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:26:\"(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:33:\"(.+?)/comment-page-([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&cpage=$matches[2]\";s:8:\"(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";}', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:4:{i:0;s:29:\"acf-repeater/acf-repeater.php\";i:1;s:30:\"advanced-custom-fields/acf.php\";i:2;s:37:\"tinymce-advanced/tinymce-advanced.php\";i:3;s:27:\"wp-pagenavi/wp-pagenavi.php\";}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '0', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', '', 'no'),
(40, 'template', 'wp-templ', 'yes'),
(41, 'stylesheet', 'wp-templ', 'yes'),
(42, 'comment_whitelist', '1', 'yes'),
(43, 'blacklist_keys', '', 'no'),
(44, 'comment_registration', '0', 'yes'),
(45, 'html_type', 'text/html', 'yes'),
(46, 'use_trackback', '0', 'yes'),
(47, 'default_role', 'subscriber', 'yes'),
(48, 'db_version', '38590', 'yes'),
(49, 'uploads_use_yearmonth_folders', '1', 'yes'),
(50, 'upload_path', '', 'yes'),
(51, 'blog_public', '1', 'yes'),
(52, 'default_link_category', '2', 'yes'),
(53, 'show_on_front', 'posts', 'yes'),
(54, 'tag_base', '', 'yes'),
(55, 'show_avatars', '1', 'yes'),
(56, 'avatar_rating', 'G', 'yes'),
(57, 'upload_url_path', '', 'yes'),
(58, 'thumbnail_size_w', '150', 'yes'),
(59, 'thumbnail_size_h', '150', 'yes'),
(60, 'thumbnail_crop', '1', 'yes'),
(61, 'medium_size_w', '300', 'yes'),
(62, 'medium_size_h', '300', 'yes'),
(63, 'avatar_default', 'mystery', 'yes'),
(64, 'large_size_w', '1024', 'yes'),
(65, 'large_size_h', '1024', 'yes'),
(66, 'image_default_link_type', 'none', 'yes'),
(67, 'image_default_size', '', 'yes'),
(68, 'image_default_align', '', 'yes'),
(69, 'close_comments_for_old_posts', '0', 'yes'),
(70, 'close_comments_days_old', '14', 'yes'),
(71, 'thread_comments', '1', 'yes'),
(72, 'thread_comments_depth', '5', 'yes'),
(73, 'page_comments', '0', 'yes'),
(74, 'comments_per_page', '50', 'yes'),
(75, 'default_comments_page', 'newest', 'yes'),
(76, 'comment_order', 'asc', 'yes'),
(77, 'sticky_posts', 'a:0:{}', 'yes'),
(78, 'widget_categories', 'a:2:{i:2;a:4:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:12:\"hierarchical\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(79, 'widget_text', 'a:0:{}', 'yes'),
(80, 'widget_rss', 'a:0:{}', 'yes'),
(81, 'uninstall_plugins', 'a:1:{s:27:\"wp-pagenavi/wp-pagenavi.php\";s:14:\"__return_false\";}', 'no'),
(82, 'timezone_string', '', 'yes'),
(83, 'page_for_posts', '0', 'yes'),
(84, 'page_on_front', '0', 'yes'),
(85, 'default_post_format', '0', 'yes'),
(86, 'link_manager_enabled', '0', 'yes'),
(87, 'finished_splitting_shared_terms', '1', 'yes'),
(88, 'site_icon', '0', 'yes'),
(89, 'medium_large_size_w', '768', 'yes'),
(90, 'medium_large_size_h', '0', 'yes'),
(91, 'wp_page_for_privacy_policy', '3', 'yes'),
(92, 'show_comments_cookies_opt_in', '0', 'yes'),
(93, 'initial_db_version', '38590', 'yes'),
(94, 'wp_user_roles', 'a:5:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:61:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:34:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}}', 'yes'),
(95, 'fresh_site', '0', 'yes'),
(96, 'WPLANG', '', 'yes'),
(97, 'widget_search', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(98, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(99, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(100, 'widget_archives', 'a:2:{i:2;a:3:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(101, 'widget_meta', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(102, 'sidebars_widgets', 'a:2:{s:19:\"wp_inactive_widgets\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:13:\"array_version\";i:3;}', 'yes'),
(103, 'widget_pages', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(104, 'widget_calendar', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(105, 'widget_media_audio', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(106, 'widget_media_image', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(107, 'widget_media_gallery', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(108, 'widget_media_video', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(109, 'nonce_key', 'kNPan^;=Lxt%2nw=Ae,EHttAB%o(82<O0Wpth,YiBl[[+c4n%Jm*zLE5u/Bq_.OR', 'no'),
(110, 'nonce_salt', '$XLGK=~v4[E:Y1A DVDC=n jJ!J yQw@yt8c3*hcl?p{:Kv0<=!wG?PK?,_1yDS?', 'no'),
(111, 'widget_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(112, 'widget_nav_menu', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(113, 'widget_custom_html', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(114, 'cron', 'a:5:{i:1548129722;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1548144122;a:3:{s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1548144131;a:2:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1548163373;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}s:7:\"version\";i:2;}', 'yes'),
(115, 'theme_mods_twentyseventeen', 'a:2:{s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1546866613;s:4:\"data\";a:4:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:9:\"sidebar-2\";a:0:{}s:9:\"sidebar-3\";a:0:{}}}}', 'yes'),
(125, 'auth_key', '>t@G>[6+Mj?ZY/nIBtx(g=J[|%cGsvKoUo~LTFQ&g7c?M[m2TbxtF/dmfi_$DfuX', 'no'),
(126, 'auth_salt', 't*YH0KM~EL8D(JJTUR)7[*JGbBu%*ZIyPWTyhxZhI68sbUE{h^a0N M;OK|`mkWo', 'no'),
(127, 'logged_in_key', '::|NV6Ls&M/r,-l>:npXiP4OX}(O2Uus4|cH-9d9TA,;1_2q+03F+Cs<IiGvapiY', 'no'),
(128, 'logged_in_salt', '{F[c/%)qBI(&z~VZu/X>;$7h#jEkaZjS`kg{I`ABDwuK46_EFNjRqe->0e+Ay1op', 'no'),
(133, 'can_compress_scripts', '0', 'no'),
(151, 'auto_core_update_notified', 'a:4:{s:4:\"type\";s:7:\"success\";s:5:\"email\";s:22:\"khangpham421@gmail.com\";s:7:\"version\";s:5:\"4.9.9\";s:9:\"timestamp\";i:1546761745;}', 'no'),
(175, 'new_admin_email', 'khangpham421@gmail.com', 'yes'),
(181, 'current_theme', 'Klain Portal', 'yes'),
(182, 'theme_mods_wp-templ', 'a:3:{i:0;b:0;s:18:\"nav_menu_locations\";a:0:{}s:18:\"custom_css_post_id\";i:-1;}', 'yes'),
(183, 'theme_switched', '', 'yes'),
(184, 'category_children', 'a:0:{}', 'yes'),
(199, 'recently_activated', 'a:0:{}', 'yes'),
(200, 'acf_version', '4.4.12', 'yes'),
(201, 'tadv_settings', 'a:6:{s:7:\"options\";s:15:\"menubar,advlist\";s:9:\"toolbar_1\";s:106:\"formatselect,bold,italic,blockquote,bullist,numlist,alignleft,aligncenter,alignright,link,unlink,undo,redo\";s:9:\"toolbar_2\";s:103:\"fontselect,fontsizeselect,outdent,indent,pastetext,removeformat,charmap,wp_more,forecolor,table,wp_help\";s:9:\"toolbar_3\";s:0:\"\";s:9:\"toolbar_4\";s:0:\"\";s:7:\"plugins\";s:104:\"anchor,code,insertdatetime,nonbreaking,print,searchreplace,table,visualblocks,visualchars,advlist,wptadv\";}', 'yes'),
(202, 'tadv_admin_settings', 'a:1:{s:7:\"options\";a:0:{}}', 'yes'),
(203, 'tadv_version', '4000', 'yes'),
(204, 'pagenavi_options', 'a:15:{s:10:\"pages_text\";s:36:\"Page %CURRENT_PAGE% of %TOTAL_PAGES%\";s:12:\"current_text\";s:13:\"%PAGE_NUMBER%\";s:9:\"page_text\";s:13:\"%PAGE_NUMBER%\";s:10:\"first_text\";s:13:\"&laquo; First\";s:9:\"last_text\";s:12:\"Last &raquo;\";s:9:\"prev_text\";s:7:\"&laquo;\";s:9:\"next_text\";s:7:\"&raquo;\";s:12:\"dotleft_text\";s:3:\"...\";s:13:\"dotright_text\";s:3:\"...\";s:9:\"num_pages\";i:5;s:23:\"num_larger_page_numbers\";i:3;s:28:\"larger_page_numbers_multiple\";i:10;s:11:\"always_show\";b:0;s:16:\"use_pagenavi_css\";b:1;s:5:\"style\";i:1;}', 'yes'),
(209, '_site_transient_update_core', 'O:8:\"stdClass\":4:{s:7:\"updates\";a:3:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:7:\"upgrade\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.0.3.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.0.3.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-5.0.3-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-5.0.3-new-bundled.zip\";s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"5.0.3\";s:7:\"version\";s:5:\"5.0.3\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.0\";s:15:\"partial_version\";s:0:\"\";}i:1;O:8:\"stdClass\":11:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.0.3.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.0.3.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-5.0.3-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-5.0.3-new-bundled.zip\";s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"5.0.3\";s:7:\"version\";s:5:\"5.0.3\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.0\";s:15:\"partial_version\";s:0:\"\";s:9:\"new_files\";s:1:\"1\";}i:2;O:8:\"stdClass\":11:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.0.2.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.0.2.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-5.0.2-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-5.0.2-new-bundled.zip\";s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"5.0.2\";s:7:\"version\";s:5:\"5.0.2\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.0\";s:15:\"partial_version\";s:0:\"\";s:9:\"new_files\";s:1:\"1\";}}s:12:\"last_checked\";i:1548117688;s:15:\"version_checked\";s:5:\"4.9.9\";s:12:\"translations\";a:0:{}}', 'no'),
(252, 'option_image', 'O:8:\"WP_Error\":2:{s:6:\"errors\";a:1:{s:12:\"upload_error\";a:1:{i:0;s:21:\"No file was uploaded.\";}}s:10:\"error_data\";a:0:{}}', 'yes'),
(289, 'typecat_children', 'a:0:{}', 'yes'),
(290, 'servicescat_children', 'a:0:{}', 'yes'),
(416, '_site_transient_timeout_browser_b65dce36d1027cb32c3f7e3ea134897a', '1548089267', 'no'),
(417, '_site_transient_browser_b65dce36d1027cb32c3f7e3ea134897a', 'a:10:{s:4:\"name\";s:6:\"Chrome\";s:7:\"version\";s:12:\"71.0.3578.98\";s:8:\"platform\";s:9:\"Macintosh\";s:10:\"update_url\";s:29:\"https://www.google.com/chrome\";s:7:\"img_src\";s:43:\"http://s.w.org/images/browsers/chrome.png?1\";s:11:\"img_src_ssl\";s:44:\"https://s.w.org/images/browsers/chrome.png?1\";s:15:\"current_version\";s:2:\"18\";s:7:\"upgrade\";b:0;s:8:\"insecure\";b:0;s:6:\"mobile\";b:0;}', 'no'),
(532, 'test_160', 'image_before_15_img', 'no'),
(533, '_test_160', 'field_160', 'no'),
(547, 'userscat_children', 'a:0:{}', 'yes'),
(565, '_193', 'image_before_6_img', 'no'),
(566, '__193', 'field_193', 'no'),
(582, '_site_transient_timeout_theme_roots', '1548119490', 'no'),
(583, '_site_transient_theme_roots', 'a:3:{s:13:\"twentyfifteen\";s:7:\"/themes\";s:15:\"twentyseventeen\";s:7:\"/themes\";s:13:\"twentysixteen\";s:7:\"/themes\";}', 'no'),
(584, '_site_transient_update_themes', 'O:8:\"stdClass\":4:{s:12:\"last_checked\";i:1548117692;s:7:\"checked\";a:3:{s:13:\"twentyfifteen\";s:3:\"2.0\";s:15:\"twentyseventeen\";s:3:\"1.7\";s:13:\"twentysixteen\";s:3:\"1.5\";}s:8:\"response\";a:3:{s:13:\"twentyfifteen\";a:4:{s:5:\"theme\";s:13:\"twentyfifteen\";s:11:\"new_version\";s:3:\"2.3\";s:3:\"url\";s:43:\"https://wordpress.org/themes/twentyfifteen/\";s:7:\"package\";s:59:\"https://downloads.wordpress.org/theme/twentyfifteen.2.3.zip\";}s:15:\"twentyseventeen\";a:4:{s:5:\"theme\";s:15:\"twentyseventeen\";s:11:\"new_version\";s:3:\"2.0\";s:3:\"url\";s:45:\"https://wordpress.org/themes/twentyseventeen/\";s:7:\"package\";s:61:\"https://downloads.wordpress.org/theme/twentyseventeen.2.0.zip\";}s:13:\"twentysixteen\";a:4:{s:5:\"theme\";s:13:\"twentysixteen\";s:11:\"new_version\";s:3:\"1.8\";s:3:\"url\";s:43:\"https://wordpress.org/themes/twentysixteen/\";s:7:\"package\";s:59:\"https://downloads.wordpress.org/theme/twentysixteen.1.8.zip\";}}s:12:\"translations\";a:0:{}}', 'no'),
(585, '_site_transient_update_plugins', 'O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1548117694;s:7:\"checked\";a:5:{s:30:\"advanced-custom-fields/acf.php\";s:6:\"4.4.12\";s:29:\"acf-repeater/acf-repeater.php\";s:5:\"1.1.1\";s:9:\"hello.php\";s:3:\"1.7\";s:37:\"tinymce-advanced/tinymce-advanced.php\";s:5:\"4.8.2\";s:27:\"wp-pagenavi/wp-pagenavi.php\";s:4:\"2.93\";}s:8:\"response\";a:2:{s:30:\"advanced-custom-fields/acf.php\";O:8:\"stdClass\":12:{s:2:\"id\";s:36:\"w.org/plugins/advanced-custom-fields\";s:4:\"slug\";s:22:\"advanced-custom-fields\";s:6:\"plugin\";s:30:\"advanced-custom-fields/acf.php\";s:11:\"new_version\";s:6:\"5.7.10\";s:3:\"url\";s:53:\"https://wordpress.org/plugins/advanced-custom-fields/\";s:7:\"package\";s:72:\"https://downloads.wordpress.org/plugin/advanced-custom-fields.5.7.10.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:75:\"https://ps.w.org/advanced-custom-fields/assets/icon-256x256.png?rev=1082746\";s:2:\"1x\";s:75:\"https://ps.w.org/advanced-custom-fields/assets/icon-128x128.png?rev=1082746\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:78:\"https://ps.w.org/advanced-custom-fields/assets/banner-1544x500.jpg?rev=1729099\";s:2:\"1x\";s:77:\"https://ps.w.org/advanced-custom-fields/assets/banner-772x250.jpg?rev=1729102\";}s:11:\"banners_rtl\";a:0:{}s:6:\"tested\";s:5:\"4.9.9\";s:12:\"requires_php\";b:0;s:13:\"compatibility\";O:8:\"stdClass\":0:{}}s:37:\"tinymce-advanced/tinymce-advanced.php\";O:8:\"stdClass\":13:{s:2:\"id\";s:30:\"w.org/plugins/tinymce-advanced\";s:4:\"slug\";s:16:\"tinymce-advanced\";s:6:\"plugin\";s:37:\"tinymce-advanced/tinymce-advanced.php\";s:11:\"new_version\";s:5:\"5.0.0\";s:3:\"url\";s:47:\"https://wordpress.org/plugins/tinymce-advanced/\";s:7:\"package\";s:65:\"https://downloads.wordpress.org/plugin/tinymce-advanced.5.0.0.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:68:\"https://ps.w.org/tinymce-advanced/assets/icon-256x256.png?rev=971511\";s:2:\"1x\";s:68:\"https://ps.w.org/tinymce-advanced/assets/icon-128x128.png?rev=971511\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:72:\"https://ps.w.org/tinymce-advanced/assets/banner-1544x500.png?rev=2011513\";s:2:\"1x\";s:71:\"https://ps.w.org/tinymce-advanced/assets/banner-772x250.png?rev=2011513\";}s:11:\"banners_rtl\";a:0:{}s:14:\"upgrade_notice\";s:100:\"<p>Major upgrade. Includes additional buttons and settings for the toolbars in the Block Editor.</p>\";s:6:\"tested\";s:5:\"5.0.3\";s:12:\"requires_php\";s:3:\"5.2\";s:13:\"compatibility\";O:8:\"stdClass\":0:{}}}s:12:\"translations\";a:0:{}s:9:\"no_update\";a:2:{s:9:\"hello.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:25:\"w.org/plugins/hello-dolly\";s:4:\"slug\";s:11:\"hello-dolly\";s:6:\"plugin\";s:9:\"hello.php\";s:11:\"new_version\";s:3:\"1.6\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/hello-dolly/\";s:7:\"package\";s:58:\"https://downloads.wordpress.org/plugin/hello-dolly.1.6.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:63:\"https://ps.w.org/hello-dolly/assets/icon-256x256.jpg?rev=969907\";s:2:\"1x\";s:63:\"https://ps.w.org/hello-dolly/assets/icon-128x128.jpg?rev=969907\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:65:\"https://ps.w.org/hello-dolly/assets/banner-772x250.png?rev=478342\";}s:11:\"banners_rtl\";a:0:{}}s:27:\"wp-pagenavi/wp-pagenavi.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:25:\"w.org/plugins/wp-pagenavi\";s:4:\"slug\";s:11:\"wp-pagenavi\";s:6:\"plugin\";s:27:\"wp-pagenavi/wp-pagenavi.php\";s:11:\"new_version\";s:4:\"2.93\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/wp-pagenavi/\";s:7:\"package\";s:59:\"https://downloads.wordpress.org/plugin/wp-pagenavi.2.93.zip\";s:5:\"icons\";a:2:{s:2:\"1x\";s:55:\"https://ps.w.org/wp-pagenavi/assets/icon.svg?rev=977997\";s:3:\"svg\";s:55:\"https://ps.w.org/wp-pagenavi/assets/icon.svg?rev=977997\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:67:\"https://ps.w.org/wp-pagenavi/assets/banner-1544x500.jpg?rev=1206758\";s:2:\"1x\";s:66:\"https://ps.w.org/wp-pagenavi/assets/banner-772x250.jpg?rev=1206758\";}s:11:\"banners_rtl\";a:0:{}}}}', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `wp_postmeta`
--

CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_postmeta`
--

INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(2, 3, '_wp_page_template', 'default'),
(3, 3, '_wp_trash_meta_status', 'draft'),
(4, 3, '_wp_trash_meta_time', '1546867369'),
(5, 3, '_wp_desired_post_slug', 'chinh-sach-bao-mat'),
(6, 2, '_wp_trash_meta_status', 'publish'),
(7, 2, '_wp_trash_meta_time', '1546867371'),
(8, 2, '_wp_desired_post_slug', 'Trang mẫu'),
(9, 7, '_edit_last', '1'),
(10, 7, '_edit_lock', '1546867643:1'),
(11, 7, '_wp_page_template', 'page-login.php'),
(12, 10, '_edit_last', '1'),
(13, 10, '_edit_lock', '1546871000:1'),
(14, 13, '_edit_last', '1'),
(15, 13, '_edit_lock', '1547847132:1'),
(16, 13, 'fullname', 'Nguyễn Hoàng Nhật Khánh'),
(17, 13, '_fullname', 'field_5c33644ae35b5'),
(18, 13, 'password', 'e10adc3949ba59abbe56e057f20f883e'),
(19, 13, '_password', 'field_5c336460e35b6'),
(20, 14, '_wp_attached_file', '2019/01/IMG_1499.jpg'),
(21, 14, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1571;s:6:\"height\";i:1571;s:4:\"file\";s:20:\"2019/01/IMG_1499.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:20:\"IMG_1499-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:20:\"IMG_1499-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:20:\"IMG_1499-768x768.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:22:\"IMG_1499-1024x1024.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:3:\"2.4\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:8:\"iPhone X\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:10:\"1544870115\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"6\";s:3:\"iso\";s:2:\"16\";s:13:\"shutter_speed\";s:18:\"0.0037878787878788\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"1\";s:8:\"keywords\";a:0:{}}}'),
(22, 13, '_thumbnail_id', '14'),
(23, 15, '_edit_last', '1'),
(24, 15, 'field_5c33644ae35b5', 'a:14:{s:3:\"key\";s:19:\"field_5c33644ae35b5\";s:5:\"label\";s:8:\"Fullname\";s:4:\"name\";s:8:\"fullname\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:0;}'),
(25, 15, 'field_5c336460e35b6', 'a:14:{s:3:\"key\";s:19:\"field_5c336460e35b6\";s:5:\"label\";s:8:\"Password\";s:4:\"name\";s:8:\"password\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:1;}'),
(26, 15, 'field_5c33646ce35b7', 'a:14:{s:3:\"key\";s:19:\"field_5c33646ce35b7\";s:5:\"label\";s:6:\"Mobile\";s:4:\"name\";s:6:\"mobile\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:2;}'),
(28, 15, 'position', 'normal'),
(29, 15, 'layout', 'no_box'),
(30, 15, 'hide_on_screen', ''),
(31, 15, '_edit_lock', '1547254564:1'),
(32, 1, '_wp_trash_meta_status', 'publish'),
(33, 1, '_wp_trash_meta_time', '1546872063'),
(34, 1, '_wp_desired_post_slug', 'chao-moi-nguoi'),
(35, 1, '_wp_trash_meta_comments_status', 'a:1:{i:1;s:1:\"1\";}'),
(36, 13, 'mobile', '0389025574‬'),
(37, 13, '_mobile', 'field_5c33646ce35b7'),
(46, 18, '_edit_last', '1'),
(47, 18, 'field_5c33f27f3013c', 'a:14:{s:3:\"key\";s:19:\"field_5c33f27f3013c\";s:5:\"label\";s:6:\"idCard\";s:4:\"name\";s:6:\"idcard\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:1;}'),
(49, 18, 'position', 'normal'),
(50, 18, 'layout', 'no_box'),
(51, 18, 'hide_on_screen', ''),
(52, 18, '_edit_lock', '1547862059:1'),
(53, 18, 'field_5c33f2b243b1c', 'a:14:{s:3:\"key\";s:19:\"field_5c33f2b243b1c\";s:5:\"label\";s:6:\"Mobile\";s:4:\"name\";s:6:\"mobile\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:4;}'),
(55, 18, 'field_5c33f2da0ab2e', 'a:11:{s:3:\"key\";s:19:\"field_5c33f2da0ab2e\";s:5:\"label\";s:9:\"imageCard\";s:4:\"name\";s:8:\"ic_front\";s:4:\"type\";s:5:\"image\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:11:\"save_format\";s:2:\"id\";s:12:\"preview_size\";s:9:\"thumbnail\";s:7:\"library\";s:3:\"all\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c33f334408e0\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:1:\"1\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:3;}'),
(57, 18, 'field_5c33f32c408df', 'a:14:{s:3:\"key\";s:19:\"field_5c33f32c408df\";s:5:\"label\";s:8:\"Facebook\";s:4:\"name\";s:8:\"facebook\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:5;}'),
(58, 18, 'field_5c33f334408e0', 'a:13:{s:3:\"key\";s:19:\"field_5c33f334408e0\";s:5:\"label\";s:13:\"Customer Type\";s:4:\"name\";s:13:\"customer_type\";s:4:\"type\";s:5:\"radio\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:7:\"choices\";a:2:{i:1;s:1:\"1\";i:2;s:1:\"2\";}s:12:\"other_choice\";s:1:\"0\";s:17:\"save_other_choice\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:6:\"layout\";s:8:\"vertical\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:6;}'),
(60, 18, 'field_5c33f35833f97', 'a:14:{s:3:\"key\";s:19:\"field_5c33f35833f97\";s:5:\"label\";s:7:\"History\";s:4:\"name\";s:7:\"history\";s:4:\"type\";s:12:\"relationship\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"return_format\";s:6:\"object\";s:9:\"post_type\";a:1:{i:0;s:7:\"surgery\";}s:8:\"taxonomy\";a:1:{i:0;s:3:\"all\";}s:7:\"filters\";a:1:{i:0;s:6:\"search\";}s:15:\"result_elements\";a:1:{i:0;s:9:\"post_type\";}s:3:\"max\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c33f334408e0\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:1:\"1\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:7;}'),
(62, 20, '_edit_last', '1'),
(63, 20, '_edit_lock', '1546915128:1'),
(64, 20, '_wp_page_template', 'page-search.php'),
(67, 23, '_wp_attached_file', '2019/01/new.jpg'),
(68, 23, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:960;s:6:\"height\";i:960;s:4:\"file\";s:15:\"2019/01/new.jpg\";s:5:\"sizes\";a:3:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:15:\"new-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:15:\"new-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:15:\"new-768x768.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"1\";s:8:\"keywords\";a:0:{}}}'),
(76, 24, '_edit_last', '1'),
(77, 24, '_edit_lock', '1546960759:1'),
(78, 24, '_wp_page_template', 'page-add-customer.php'),
(79, 15, 'field_5c342ed2171e3', 'a:14:{s:3:\"key\";s:19:\"field_5c342ed2171e3\";s:5:\"label\";s:7:\"id user\";s:4:\"name\";s:7:\"id_user\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:2:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:3;}'),
(80, 15, 'rule', 'a:5:{s:5:\"param\";s:9:\"post_type\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:5:\"users\";s:8:\"order_no\";i:0;s:8:\"group_no\";i:0;}'),
(81, 26, '_edit_last', '1'),
(82, 26, '_edit_lock', '1546926320:1'),
(83, 26, '_wp_page_template', 'page-add-user.php'),
(134, 40, '_wp_attached_file', '2019/01/architecture-1477041_1280.jpg'),
(135, 40, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1280;s:6:\"height\";i:720;s:4:\"file\";s:37:\"2019/01/architecture-1477041_1280.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:37:\"architecture-1477041_1280-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:37:\"architecture-1477041_1280-300x169.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:169;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:37:\"architecture-1477041_1280-768x432.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:432;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:38:\"architecture-1477041_1280-1024x576.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(157, 42, '_wp_attached_file', '2019/01/WhatsApp-Image-2019-01-08-at-6.53.09-PM.jpeg'),
(158, 42, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:813;s:6:\"height\";i:813;s:4:\"file\";s:52:\"2019/01/WhatsApp-Image-2019-01-08-at-6.53.09-PM.jpeg\";s:5:\"sizes\";a:3:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:52:\"WhatsApp-Image-2019-01-08-at-6.53.09-PM-150x150.jpeg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:52:\"WhatsApp-Image-2019-01-08-at-6.53.09-PM-300x300.jpeg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:52:\"WhatsApp-Image-2019-01-08-at-6.53.09-PM-768x768.jpeg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(164, 44, '_wp_attached_file', '2019/01/Lookbook.jpg'),
(165, 44, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:851;s:6:\"height\";i:947;s:4:\"file\";s:20:\"2019/01/Lookbook.jpg\";s:5:\"sizes\";a:3:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:20:\"Lookbook-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:20:\"Lookbook-270x300.jpg\";s:5:\"width\";i:270;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:20:\"Lookbook-768x855.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:855;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(169, 18, 'field_5c34c99b16d27', 'a:14:{s:3:\"key\";s:19:\"field_5c34c99b16d27\";s:5:\"label\";s:10:\"idCustomer\";s:4:\"name\";s:10:\"idcustomer\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c33f334408e0\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:1:\"1\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:0;}'),
(188, 48, '_edit_last', '1'),
(189, 48, '_edit_lock', '1547089970:1'),
(190, 48, '_wp_page_template', 'page-add-surgery.php'),
(191, 50, '_edit_last', '1'),
(192, 50, 'field_5c36c888f4dd0', 'a:15:{s:3:\"key\";s:19:\"field_5c36c888f4dd0\";s:5:\"label\";s:5:\"price\";s:4:\"name\";s:5:\"price\";s:4:\"type\";s:6:\"number\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:3:\"min\";s:0:\"\";s:3:\"max\";s:0:\"\";s:4:\"step\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:0;}'),
(193, 50, 'field_5c36c891f4dd1', 'a:15:{s:3:\"key\";s:19:\"field_5c36c891f4dd1\";s:5:\"label\";s:9:\"promotion\";s:4:\"name\";s:9:\"promotion\";s:4:\"type\";s:6:\"number\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:3:\"min\";s:0:\"\";s:3:\"max\";s:0:\"\";s:4:\"step\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:2;}'),
(194, 50, 'field_5c36c8a4f4dd2', 'a:14:{s:3:\"key\";s:19:\"field_5c36c8a4f4dd2\";s:5:\"label\";s:4:\"from\";s:4:\"name\";s:4:\"from\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:3;}'),
(195, 50, 'field_5c36c8adf4dd3', 'a:14:{s:3:\"key\";s:19:\"field_5c36c8adf4dd3\";s:5:\"label\";s:2:\"to\";s:4:\"name\";s:2:\"to\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:4;}'),
(197, 50, 'position', 'normal'),
(198, 50, 'layout', 'no_box'),
(199, 50, 'hide_on_screen', ''),
(200, 50, '_edit_lock', '1547864073:1'),
(202, 51, '_edit_last', '1'),
(203, 51, '_edit_lock', '1547094195:1'),
(204, 51, 'price', '12000000'),
(205, 51, '_price', 'field_5c36c888f4dd0'),
(206, 51, 'promotion', ''),
(207, 51, '_promotion', 'field_5c36c891f4dd1'),
(208, 51, 'from', ''),
(209, 51, '_from', 'field_5c36c8a4f4dd2'),
(210, 51, 'to', ''),
(211, 51, '_to', 'field_5c36c8adf4dd3'),
(212, 52, '_edit_last', '1'),
(213, 52, 'price', '60000000'),
(214, 52, '_price', 'field_5c36c888f4dd0'),
(215, 52, 'promotion', ''),
(216, 52, '_promotion', 'field_5c36c891f4dd1'),
(217, 52, 'from', ''),
(218, 52, '_from', 'field_5c36c8a4f4dd2'),
(219, 52, 'to', ''),
(220, 52, '_to', 'field_5c36c8adf4dd3'),
(221, 52, '_edit_lock', '1547947303:1'),
(222, 53, '_edit_last', '1'),
(223, 53, '_edit_lock', '1547247660:1'),
(224, 53, '_wp_page_template', 'page-confirm-surgery.php'),
(240, 18, 'field_5c375685aaaa4', 'a:14:{s:3:\"key\";s:19:\"field_5c375685aaaa4\";s:5:\"label\";s:7:\"Address\";s:4:\"name\";s:7:\"address\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c33f334408e0\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:1:\"1\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:2;}'),
(242, 56, '_edit_last', '1'),
(243, 56, 'field_5c3772ec05386', 'a:13:{s:3:\"key\";s:19:\"field_5c3772ec05386\";s:5:\"label\";s:6:\"status\";s:4:\"name\";s:6:\"status\";s:4:\"type\";s:5:\"radio\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:7:\"choices\";a:7:{s:3:\"tvv\";s:3:\"tvv\";s:4:\"bsnk\";s:4:\"bsnk\";s:4:\"quay\";s:4:\"quay\";s:3:\"bsk\";s:3:\"bsk\";s:9:\"phauthuat\";s:9:\"phauthuat\";s:7:\"hauphau\";s:7:\"hauphau\";s:4:\"cshp\";s:4:\"cshp\";}s:12:\"other_choice\";s:1:\"0\";s:17:\"save_other_choice\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:6:\"layout\";s:8:\"vertical\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c37762eaa6a0\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:4:\"cash\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:16;}'),
(245, 56, 'position', 'normal'),
(246, 56, 'layout', 'no_box'),
(247, 56, 'hide_on_screen', ''),
(248, 56, '_edit_lock', '1548053324:1'),
(249, 56, 'field_5c37762eaa6a0', 'a:13:{s:3:\"key\";s:19:\"field_5c37762eaa6a0\";s:5:\"label\";s:14:\"payment status\";s:4:\"name\";s:14:\"payment_status\";s:4:\"type\";s:5:\"radio\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:7:\"choices\";a:2:{s:9:\"Thu đủ\";s:9:\"Thu đủ\";s:12:\"Đặt cọc\";s:12:\"Đặt cọc\";}s:12:\"other_choice\";s:1:\"0\";s:17:\"save_other_choice\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:6:\"layout\";s:8:\"vertical\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c3772ec05386\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"tvv\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:19;}'),
(251, 56, 'field_5c3776f5c931a', 'a:13:{s:3:\"key\";s:19:\"field_5c3776f5c931a\";s:5:\"label\";s:14:\"payment detail\";s:4:\"name\";s:14:\"payment_detail\";s:4:\"type\";s:8:\"textarea\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:10:\"formatting\";s:2:\"br\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c3772ec05386\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"tvv\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:20;}'),
(253, 57, '_edit_last', '1'),
(254, 57, '_edit_lock', '1547139269:1'),
(255, 57, '_wp_page_template', 'page-counter.php'),
(257, 60, '_edit_last', '1'),
(258, 60, '_edit_lock', '1547861717:1'),
(259, 60, '_wp_page_template', 'page-doctor.php'),
(260, 63, '_edit_last', '1'),
(261, 63, '_edit_lock', '1547972535:1'),
(262, 63, '_wp_page_template', 'page-ekip.php'),
(263, 65, '_edit_last', '1'),
(264, 65, '_wp_page_template', 'page-after.php'),
(265, 65, '_edit_lock', '1548033108:1'),
(266, 67, '_edit_last', '1'),
(267, 67, '_edit_lock', '1548044589:1'),
(268, 67, '_wp_page_template', 'page-care.php'),
(269, 56, 'field_5c37e67cef8b7', 'a:14:{s:3:\"key\";s:19:\"field_5c37e67cef8b7\";s:5:\"label\";s:8:\"Fullname\";s:4:\"name\";s:8:\"fullname\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c3772ec05386\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"tvv\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:0;}'),
(281, 56, 'field_5c37e9e218968', 'a:14:{s:3:\"key\";s:19:\"field_5c37e9e218968\";s:5:\"label\";s:4:\"ekip\";s:4:\"name\";s:4:\"ekip\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c3772ec05386\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"tvv\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:15;}'),
(292, 70, '_edit_last', '1'),
(293, 70, 'field_5c37f18e57fd8', 'a:14:{s:3:\"key\";s:19:\"field_5c37f18e57fd8\";s:5:\"label\";s:4:\"unit\";s:4:\"name\";s:4:\"unit\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:2:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:0;}'),
(294, 70, 'rule', 'a:5:{s:5:\"param\";s:9:\"post_type\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:8:\"supplies\";s:8:\"order_no\";i:0;s:8:\"group_no\";i:0;}'),
(295, 70, 'position', 'normal'),
(296, 70, 'layout', 'no_box'),
(297, 70, 'hide_on_screen', ''),
(298, 70, '_edit_lock', '1547807378:1'),
(299, 71, '_edit_last', '1'),
(300, 71, 'unit', 'cái'),
(301, 71, '_unit', 'field_5c37f18e57fd8'),
(302, 71, '_edit_lock', '1547170246:1'),
(303, 72, '_edit_last', '1'),
(304, 72, '_edit_lock', '1547170258:1'),
(305, 72, 'unit', 'cái'),
(306, 72, '_unit', 'field_5c37f18e57fd8'),
(307, 73, '_edit_last', '1'),
(308, 73, '_edit_lock', '1547194933:1'),
(309, 73, 'unit', 'cái'),
(310, 73, '_unit', 'field_5c37f18e57fd8'),
(313, 13, 'id_user', ''),
(314, 13, '_id_user', 'field_5c342ed2171e3'),
(378, 82, '_wp_attached_file', '2019/01/banner_diy.jpg'),
(379, 82, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1440;s:6:\"height\";i:700;s:4:\"file\";s:22:\"2019/01/banner_diy.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:22:\"banner_diy-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:22:\"banner_diy-300x146.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:146;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:22:\"banner_diy-768x373.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:373;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:23:\"banner_diy-1024x498.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:498;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(387, 18, 'field_5c38630f05a4f', 'a:14:{s:3:\"key\";s:19:\"field_5c38630f05a4f\";s:5:\"label\";s:7:\"creator\";s:4:\"name\";s:7:\"creator\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c33f334408e0\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:1:\"1\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:8;}'),
(388, 18, 'rule', 'a:5:{s:5:\"param\";s:9:\"post_type\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:9:\"customers\";s:8:\"order_no\";i:0;s:8:\"group_no\";i:0;}'),
(455, 56, 'field_5c38b59aceb74', 'a:13:{s:3:\"key\";s:19:\"field_5c38b59aceb74\";s:5:\"label\";s:6:\"advise\";s:4:\"name\";s:6:\"advise\";s:4:\"type\";s:5:\"radio\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:7:\"choices\";a:2:{s:3:\"yes\";s:3:\"yes\";s:2:\"no\";s:2:\"no\";}s:12:\"other_choice\";s:1:\"0\";s:17:\"save_other_choice\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:6:\"layout\";s:8:\"vertical\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c3772ec05386\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"tvv\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:3;}'),
(456, 56, 'field_5c38b5c7ceb75', 'a:14:{s:3:\"key\";s:19:\"field_5c38b5c7ceb75\";s:5:\"label\";s:7:\"adviser\";s:4:\"name\";s:7:\"adviser\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c3772ec05386\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"tvv\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:4;}'),
(457, 56, 'field_5c38b5d5ceb76', 'a:14:{s:3:\"key\";s:19:\"field_5c38b5d5ceb76\";s:5:\"label\";s:7:\"channel\";s:4:\"name\";s:7:\"channel\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c3772ec05386\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"tvv\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:5;}'),
(458, 56, 'field_5c38b5e4ceb77', 'a:14:{s:3:\"key\";s:19:\"field_5c38b5e4ceb77\";s:5:\"label\";s:8:\"services\";s:4:\"name\";s:8:\"services\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c3772ec05386\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"tvv\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:6;}'),
(459, 56, 'field_5c38b5f3ceb78', 'a:14:{s:3:\"key\";s:19:\"field_5c38b5f3ceb78\";s:5:\"label\";s:4:\"date\";s:4:\"name\";s:4:\"date\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c3772ec05386\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"tvv\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:7;}'),
(460, 56, 'field_5c38b610ceb79', 'a:13:{s:3:\"key\";s:19:\"field_5c38b610ceb79\";s:5:\"label\";s:10:\"hasSurgery\";s:4:\"name\";s:10:\"hassurgery\";s:4:\"type\";s:5:\"radio\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:7:\"choices\";a:2:{s:3:\"yes\";s:3:\"yes\";s:2:\"no\";s:2:\"no\";}s:12:\"other_choice\";s:1:\"0\";s:17:\"save_other_choice\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:6:\"layout\";s:8:\"vertical\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c3772ec05386\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"tvv\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:8;}'),
(461, 56, 'field_5c38b62fceb7a', 'a:11:{s:3:\"key\";s:19:\"field_5c38b62fceb7a\";s:5:\"label\";s:14:\"detail history\";s:4:\"name\";s:14:\"detail_history\";s:4:\"type\";s:7:\"wysiwyg\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:7:\"toolbar\";s:4:\"full\";s:12:\"media_upload\";s:3:\"yes\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c3772ec05386\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"tvv\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:9;}'),
(462, 56, 'field_5c38b65bceb7b', 'a:11:{s:3:\"key\";s:19:\"field_5c38b65bceb7b\";s:5:\"label\";s:11:\"self status\";s:4:\"name\";s:11:\"self_status\";s:4:\"type\";s:7:\"wysiwyg\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:7:\"toolbar\";s:4:\"full\";s:12:\"media_upload\";s:3:\"yes\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c3772ec05386\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"tvv\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:10;}'),
(463, 56, 'field_5c38b684ceb7c', 'a:11:{s:3:\"key\";s:19:\"field_5c38b684ceb7c\";s:5:\"label\";s:6:\"target\";s:4:\"name\";s:6:\"target\";s:4:\"type\";s:7:\"wysiwyg\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:7:\"toolbar\";s:4:\"full\";s:12:\"media_upload\";s:3:\"yes\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c3772ec05386\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"tvv\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:11;}'),
(464, 56, 'field_5c38b69dceb7d', 'a:11:{s:3:\"key\";s:19:\"field_5c38b69dceb7d\";s:5:\"label\";s:7:\"caution\";s:4:\"name\";s:7:\"caution\";s:4:\"type\";s:7:\"wysiwyg\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:7:\"toolbar\";s:4:\"full\";s:12:\"media_upload\";s:3:\"yes\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c3772ec05386\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"tvv\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:12;}'),
(465, 56, 'field_5c38b6abceb7e', 'a:11:{s:3:\"key\";s:19:\"field_5c38b6abceb7e\";s:5:\"label\";s:13:\"doctor advise\";s:4:\"name\";s:13:\"doctor_advise\";s:4:\"type\";s:7:\"wysiwyg\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:7:\"toolbar\";s:4:\"full\";s:12:\"media_upload\";s:3:\"yes\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c3772ec05386\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"tvv\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:13;}'),
(466, 56, 'field_5c38b6bfceb7f', 'a:13:{s:3:\"key\";s:19:\"field_5c38b6bfceb7f\";s:5:\"label\";s:8:\"cus note\";s:4:\"name\";s:8:\"cus_note\";s:4:\"type\";s:8:\"textarea\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:10:\"formatting\";s:2:\"br\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c3772ec05386\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"tvv\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:14;}'),
(470, 56, 'field_5c3916c416b52', 'a:14:{s:3:\"key\";s:19:\"field_5c3916c416b52\";s:5:\"label\";s:6:\"mobile\";s:4:\"name\";s:6:\"mobile\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c38b59aceb74\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"yes\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:1;}'),
(486, 92, '_edit_last', '1'),
(487, 92, '_edit_lock', '1547253093:1'),
(488, 92, '_wp_page_template', 'page-add-supply.php'),
(489, 92, '_wp_trash_meta_status', 'publish'),
(490, 92, '_wp_trash_meta_time', '1547253405'),
(491, 92, '_wp_desired_post_slug', 'add-supply'),
(492, 94, '_edit_last', '1'),
(493, 94, '_edit_lock', '1547253359:1'),
(494, 94, '_wp_page_template', 'page-add-supply.php'),
(502, 98, 'unit', 'cái'),
(519, 102, '_wp_attached_file', '2019/01/icon-certificate03.png'),
(520, 102, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:79;s:6:\"height\";i:51;s:4:\"file\";s:30:\"2019/01/icon-certificate03.png\";s:5:\"sizes\";a:0:{}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(523, 103, '_edit_last', '1'),
(524, 103, '_edit_lock', '1547258348:1'),
(525, 103, '_wp_page_template', 'page-add-services.php'),
(526, 105, 'unit', NULL),
(527, 105, '_wp_trash_meta_status', 'publish'),
(528, 105, '_wp_trash_meta_time', '1547256604'),
(529, 105, '_wp_desired_post_slug', 'mui-boc-sun'),
(530, 106, 'price', '15000000'),
(531, 50, 'field_5c39436859e67', 'a:14:{s:3:\"key\";s:19:\"field_5c39436859e67\";s:5:\"label\";s:10:\"numb image\";s:4:\"name\";s:10:\"numb_image\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:2:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:1;}'),
(532, 50, 'rule', 'a:5:{s:5:\"param\";s:9:\"post_type\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:8:\"services\";s:8:\"order_no\";i:0;s:8:\"group_no\";i:0;}'),
(533, 107, 'price', '35000000'),
(551, 108, '_wp_attached_file', '2019/01/IMG_0560.jpg'),
(552, 108, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1280;s:6:\"height\";i:960;s:4:\"file\";s:20:\"2019/01/IMG_0560.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:20:\"IMG_0560-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:20:\"IMG_0560-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:20:\"IMG_0560-768x576.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:21:\"IMG_0560-1024x768.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"1\";s:8:\"keywords\";a:0:{}}}'),
(633, 114, 'fullname', 'Khang Phạm'),
(634, 114, 'password', 'e10adc3949ba59abbe56e057f20f883e'),
(635, 114, 'mobile', '0903189404'),
(636, 114, 'id_user', 'USR68'),
(637, 115, '_wp_attached_file', '2019/01/new-1.jpg'),
(638, 115, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:960;s:6:\"height\";i:960;s:4:\"file\";s:17:\"2019/01/new-1.jpg\";s:5:\"sizes\";a:3:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:17:\"new-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:17:\"new-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:17:\"new-1-768x768.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"1\";s:8:\"keywords\";a:0:{}}}'),
(639, 114, '_my_file_upload', '117'),
(640, 114, '_thumbnail_id', '117'),
(656, 114, 'password', 'd41d8cd98f00b204e9800998ecf8427e'),
(657, 116, '_wp_attached_file', '2019/01/WhatsApp-Image-2019-01-08-at-6.53.09-PM-1.jpeg'),
(658, 116, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:813;s:6:\"height\";i:813;s:4:\"file\";s:54:\"2019/01/WhatsApp-Image-2019-01-08-at-6.53.09-PM-1.jpeg\";s:5:\"sizes\";a:3:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:54:\"WhatsApp-Image-2019-01-08-at-6.53.09-PM-1-150x150.jpeg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:54:\"WhatsApp-Image-2019-01-08-at-6.53.09-PM-1-300x300.jpeg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:54:\"WhatsApp-Image-2019-01-08-at-6.53.09-PM-1-768x768.jpeg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(659, 114, 'password', 'afdd0b4ad2ec172c586e2150770fbf9e'),
(660, 117, '_wp_attached_file', '2019/01/new-2.jpg'),
(661, 117, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:960;s:6:\"height\";i:960;s:4:\"file\";s:17:\"2019/01/new-2.jpg\";s:5:\"sizes\";a:3:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:17:\"new-2-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:17:\"new-2-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:17:\"new-2-768x768.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"1\";s:8:\"keywords\";a:0:{}}}'),
(662, 119, 'fullname', 'Nguyễn Thị Thu Diễm'),
(663, 119, 'idcard', '123'),
(664, 119, 'mobile', '0906350881'),
(665, 119, 'facebook', ''),
(666, 119, 'address', 'Hồ Chí Minh'),
(667, 119, 'creator', 'Khang Phạm'),
(668, 119, '_edit_lock', '1547565379:1'),
(679, 121, '_wp_attached_file', '2019/01/architecture-1477041_1280-1.jpg'),
(680, 121, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1280;s:6:\"height\";i:720;s:4:\"file\";s:39:\"2019/01/architecture-1477041_1280-1.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:39:\"architecture-1477041_1280-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:39:\"architecture-1477041_1280-1-300x169.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:169;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:39:\"architecture-1477041_1280-1-768x432.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:432;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:40:\"architecture-1477041_1280-1-1024x576.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:576;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(687, 123, '_wp_attached_file', '2019/01/WhatsApp-Image-2019-01-08-at-6.53.09-PM-2.jpeg'),
(688, 123, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:813;s:6:\"height\";i:813;s:4:\"file\";s:54:\"2019/01/WhatsApp-Image-2019-01-08-at-6.53.09-PM-2.jpeg\";s:5:\"sizes\";a:3:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:54:\"WhatsApp-Image-2019-01-08-at-6.53.09-PM-2-150x150.jpeg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:54:\"WhatsApp-Image-2019-01-08-at-6.53.09-PM-2-300x300.jpeg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:54:\"WhatsApp-Image-2019-01-08-at-6.53.09-PM-2-768x768.jpeg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(691, 124, 'fullname', 'Huỳnh Minh Ngọc'),
(692, 124, 'idcard', '1234'),
(693, 124, 'mobile', '07070707'),
(694, 124, 'facebook', ''),
(695, 124, 'address', 'Bắc Ninh'),
(696, 124, 'creator', 'Khang Phạm'),
(697, 125, 'price', '80000000'),
(713, 56, 'field_5c3ed27d2a5e0', 'a:14:{s:3:\"key\";s:19:\"field_5c3ed27d2a5e0\";s:5:\"label\";s:5:\"price\";s:4:\"name\";s:5:\"price\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c38b59aceb74\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"yes\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:17;}'),
(843, 56, 'field_5c3f3d75a0fa8', 'a:11:{s:3:\"key\";s:19:\"field_5c3f3d75a0fa8\";s:5:\"label\";s:6:\"accept\";s:4:\"name\";s:6:\"accept\";s:4:\"type\";s:8:\"checkbox\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:7:\"choices\";a:1:{s:3:\"yes\";s:3:\"yes\";}s:13:\"default_value\";s:0:\"\";s:6:\"layout\";s:8:\"vertical\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c38b59aceb74\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"yes\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:22;}'),
(909, 136, '_wp_attached_file', '2019/01/architecture-1477041_1280-2.jpg'),
(910, 136, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1280;s:6:\"height\";i:853;s:4:\"file\";s:39:\"2019/01/architecture-1477041_1280-2.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:39:\"architecture-1477041_1280-2-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:39:\"architecture-1477041_1280-2-300x200.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:200;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:39:\"architecture-1477041_1280-2-768x512.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:512;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:40:\"architecture-1477041_1280-2-1024x682.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:682;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(924, 13, '_wp_old_slug', 'khanh-nguyen__trashed'),
(925, 137, 'fullname', 'Ngô Thị Thùy Trang'),
(926, 137, 'password', 'e10adc3949ba59abbe56e057f20f883e'),
(927, 137, 'mobile', '11111111'),
(928, 137, 'id_user', 'USR79'),
(929, 138, '_wp_attached_file', '2019/01/living-room-2569325_1280.jpg'),
(930, 138, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1280;s:6:\"height\";i:853;s:4:\"file\";s:36:\"2019/01/living-room-2569325_1280.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:36:\"living-room-2569325_1280-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:36:\"living-room-2569325_1280-300x200.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:200;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:36:\"living-room-2569325_1280-768x512.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:512;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:37:\"living-room-2569325_1280-1024x682.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:682;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(931, 137, '_my_file_upload', '138'),
(932, 137, '_thumbnail_id', '138'),
(952, 137, '_edit_lock', '1547953734:1'),
(953, 140, 'fullname', 'Đặng Thị Linh Đa'),
(954, 140, 'password', 'e10adc3949ba59abbe56e057f20f883e'),
(955, 140, 'mobile', '00000000'),
(956, 140, 'id_user', 'USR31'),
(957, 141, '_wp_attached_file', '2019/01/interior-2685521_1280.jpg'),
(958, 141, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1280;s:6:\"height\";i:853;s:4:\"file\";s:33:\"2019/01/interior-2685521_1280.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:33:\"interior-2685521_1280-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:33:\"interior-2685521_1280-300x200.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:200;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:33:\"interior-2685521_1280-768x512.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:512;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:34:\"interior-2685521_1280-1024x682.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:682;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(959, 140, '_my_file_upload', '141'),
(960, 140, '_thumbnail_id', '141'),
(961, 142, 'fullname', 'Xập thị xệ'),
(962, 142, 'idcard', '123'),
(963, 142, 'mobile', '090909'),
(964, 142, 'facebook', ''),
(965, 142, 'address', 'Đà Nẵng'),
(966, 142, 'creator', 'Khang Phạm'),
(984, 56, 'field_5c423c446807d', 'a:14:{s:3:\"key\";s:19:\"field_5c423c446807d\";s:5:\"label\";s:8:\"discount\";s:4:\"name\";s:13:\"sale_discount\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c38b59aceb74\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"yes\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:18;}');
INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1015, 56, 'field_5c42424931324', 'a:14:{s:3:\"key\";s:19:\"field_5c42424931324\";s:5:\"label\";s:7:\"approve\";s:4:\"name\";s:7:\"approve\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c38b59aceb74\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"yes\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:23;}'),
(1019, 56, 'field_5c424508a6c91', 'a:14:{s:3:\"key\";s:19:\"field_5c424508a6c91\";s:5:\"label\";s:5:\"total\";s:4:\"name\";s:5:\"total\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c38b59aceb74\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"yes\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:21;}'),
(1045, 56, 'field_5c4249c8bbbeb', 'a:14:{s:3:\"key\";s:19:\"field_5c4249c8bbbeb\";s:5:\"label\";s:10:\"cusId_post\";s:4:\"name\";s:10:\"cusid_post\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c38b59aceb74\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"yes\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:2;}'),
(1059, 140, '_edit_lock', '1547849424:1'),
(1060, 140, '_edit_last', '1'),
(1061, 140, '_fullname', 'field_5c33644ae35b5'),
(1062, 140, '_password', 'field_5c336460e35b6'),
(1063, 140, '_mobile', 'field_5c33646ce35b7'),
(1064, 140, '_id_user', 'field_5c342ed2171e3'),
(1086, 142, 'id_user', 'KLAIN_19'),
(1089, 142, '_edit_lock', '1548054755:1'),
(1114, 142, 'idcustomer', ''),
(1117, 147, 'fullname', 'room1'),
(1118, 147, 'password', 'e10adc3949ba59abbe56e057f20f883e'),
(1119, 147, 'mobile', '0000000000'),
(1120, 147, 'id_user', 'USR18'),
(1121, 148, '_wp_attached_file', '2019/01/Lookbook-1.jpg'),
(1122, 148, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:850;s:6:\"height\";i:947;s:4:\"file\";s:22:\"2019/01/Lookbook-1.jpg\";s:5:\"sizes\";a:3:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:22:\"Lookbook-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:22:\"Lookbook-1-269x300.jpg\";s:5:\"width\";i:269;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:22:\"Lookbook-1-768x856.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:856;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"1\";s:8:\"keywords\";a:0:{}}}'),
(1123, 147, '_my_file_upload', '148'),
(1124, 147, '_thumbnail_id', '148'),
(1128, 147, '_wp_old_slug', 'user-room1__trashed'),
(1129, 147, '_edit_lock', '1547972527:1'),
(1130, 147, '_edit_last', '1'),
(1131, 147, '_fullname', 'field_5c33644ae35b5'),
(1132, 147, '_password', 'field_5c336460e35b6'),
(1133, 147, '_mobile', 'field_5c33646ce35b7'),
(1134, 147, '_id_user', 'field_5c342ed2171e3'),
(1135, 149, 'fullname', 'Hà Văn Vọng'),
(1136, 149, 'password', 'e10adc3949ba59abbe56e057f20f883e'),
(1137, 149, 'mobile', '2222'),
(1138, 149, 'id_user', 'USR64'),
(1139, 150, '_wp_attached_file', '2019/01/wall-416060_1280.jpg'),
(1140, 150, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1280;s:6:\"height\";i:853;s:4:\"file\";s:28:\"2019/01/wall-416060_1280.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:28:\"wall-416060_1280-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:28:\"wall-416060_1280-300x200.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:200;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:28:\"wall-416060_1280-768x512.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:512;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:29:\"wall-416060_1280-1024x682.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:682;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(1141, 149, '_my_file_upload', '150'),
(1142, 149, '_thumbnail_id', '150'),
(1143, 151, 'fullname', 'Đỗ Quang Khải'),
(1144, 151, 'password', 'e10adc3949ba59abbe56e057f20f883e'),
(1145, 151, 'mobile', '5555555555'),
(1146, 151, 'id_user', 'USR68'),
(1147, 152, '_wp_attached_file', '2019/01/living-room-2569325_1280-1.jpg'),
(1148, 152, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1280;s:6:\"height\";i:853;s:4:\"file\";s:38:\"2019/01/living-room-2569325_1280-1.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:38:\"living-room-2569325_1280-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:38:\"living-room-2569325_1280-1-300x200.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:200;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:38:\"living-room-2569325_1280-1-768x512.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:512;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:39:\"living-room-2569325_1280-1-1024x682.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:682;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(1149, 151, '_my_file_upload', '152'),
(1150, 151, '_thumbnail_id', '152'),
(1151, 56, 'field_5c4280c6bdb60', 'a:8:{s:3:\"key\";s:19:\"field_5c4280c6bdb60\";s:5:\"label\";s:16:\"Doctor\'s section\";s:4:\"name\";s:0:\"\";s:4:\"type\";s:3:\"tab\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c38b59aceb74\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"yes\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:24;}'),
(1152, 56, 'field_5c4280e4bdb61', 'a:11:{s:3:\"key\";s:19:\"field_5c4280e4bdb61\";s:5:\"label\";s:3:\"BSK\";s:4:\"name\";s:3:\"bsk\";s:4:\"type\";s:7:\"wysiwyg\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:7:\"toolbar\";s:4:\"full\";s:12:\"media_upload\";s:3:\"yes\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c38b59aceb74\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"yes\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:29;}'),
(1154, 56, 'field_5c428361680c0', 'a:14:{s:3:\"key\";s:19:\"field_5c428361680c0\";s:5:\"label\";s:9:\"bsnk name\";s:4:\"name\";s:9:\"bsnk_name\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c38b59aceb74\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"yes\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:25;}'),
(1155, 56, 'field_5c42836e680c1', 'a:11:{s:3:\"key\";s:19:\"field_5c42836e680c1\";s:5:\"label\";s:11:\"bsnk advise\";s:4:\"name\";s:11:\"bsnk_advise\";s:4:\"type\";s:7:\"wysiwyg\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:7:\"toolbar\";s:4:\"full\";s:12:\"media_upload\";s:3:\"yes\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c38b59aceb74\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"yes\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:26;}'),
(1157, 56, 'field_5c4287eeb5c84', 'a:13:{s:3:\"key\";s:19:\"field_5c4287eeb5c84\";s:5:\"label\";s:12:\"Image before\";s:4:\"name\";s:12:\"image_before\";s:4:\"type\";s:8:\"repeater\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:10:\"sub_fields\";a:1:{i:0;a:12:{s:3:\"key\";s:19:\"field_5c42880eb5c85\";s:5:\"label\";s:3:\"img\";s:4:\"name\";s:3:\"img\";s:4:\"type\";s:5:\"image\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:12:\"column_width\";s:0:\"\";s:11:\"save_format\";s:6:\"object\";s:12:\"preview_size\";s:9:\"thumbnail\";s:7:\"library\";s:3:\"all\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c38b59aceb74\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"yes\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:0;}}s:7:\"row_min\";s:2:\"15\";s:9:\"row_limit\";s:2:\"15\";s:6:\"layout\";s:5:\"table\";s:12:\"button_label\";s:7:\"Add Row\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c38b59aceb74\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"yes\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:28;}'),
(1160, 52, 'numb_image', '15'),
(1161, 52, '_numb_image', 'field_5c39436859e67'),
(1162, 56, 'field_5c428a5c50c1a', 'a:14:{s:3:\"key\";s:19:\"field_5c428a5c50c1a\";s:5:\"label\";s:10:\"numb_image\";s:4:\"name\";s:10:\"numb_image\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c38b59aceb74\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"yes\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:27;}'),
(1190, 154, 'fullname', 'Trần văn A'),
(1191, 154, 'idcard', '333333'),
(1192, 154, 'mobile', '654321'),
(1193, 154, 'facebook', ''),
(1194, 154, 'address', 'Hồ Chí Minh'),
(1195, 154, 'creator', 'Đặng Thị Linh Đa'),
(1196, 107, '_edit_lock', '1547949135:1'),
(1197, 107, '_edit_last', '1'),
(1198, 107, '_price', 'field_5c36c888f4dd0'),
(1199, 107, 'numb_image', '6'),
(1200, 107, '_numb_image', 'field_5c39436859e67'),
(1201, 107, 'promotion', ''),
(1202, 107, '_promotion', 'field_5c36c891f4dd1'),
(1203, 107, 'from', ''),
(1204, 107, '_from', 'field_5c36c8a4f4dd2'),
(1205, 107, 'to', ''),
(1206, 107, '_to', 'field_5c36c8adf4dd3'),
(1229, 154, 'idcustomer', 'KLAIN_19'),
(1322, 151, '_edit_lock', '1547975458:1'),
(1323, 151, '_edit_last', '1'),
(1324, 151, '_fullname', 'field_5c33644ae35b5'),
(1325, 151, '_password', 'field_5c336460e35b6'),
(1326, 151, '_mobile', 'field_5c33646ce35b7'),
(1327, 151, '_id_user', 'field_5c342ed2171e3'),
(1328, 168, 'fullname', 'Nguyễn Minh Lệ Trinh'),
(1329, 168, 'password', 'e10adc3949ba59abbe56e057f20f883e'),
(1330, 168, 'mobile', '123123'),
(1331, 168, 'id_user', 'USR69'),
(1332, 168, '_thumbnail_id', 'O:8:\"WP_Error\":2:{s:6:\"errors\";a:1:{s:12:\"upload_error\";a:1:{i:0;s:21:\"No file was uploaded.\";}}s:10:\"error_data\";a:0:{}}'),
(1333, 169, 'fullname', 'Phạm Thị Bích Trâm'),
(1334, 169, 'password', 'e10adc3949ba59abbe56e057f20f883e'),
(1335, 169, 'mobile', '12341234'),
(1336, 169, 'id_user', 'USR59'),
(1337, 169, '_thumbnail_id', 'O:8:\"WP_Error\":2:{s:6:\"errors\";a:1:{s:12:\"upload_error\";a:1:{i:0;s:21:\"No file was uploaded.\";}}s:10:\"error_data\";a:0:{}}'),
(1338, 170, 'fullname', 'Văn Thị Yến'),
(1339, 170, 'password', 'e10adc3949ba59abbe56e057f20f883e'),
(1340, 170, 'mobile', '43214321'),
(1341, 170, 'id_user', 'USR66'),
(1342, 170, '_thumbnail_id', 'O:8:\"WP_Error\":2:{s:6:\"errors\";a:1:{s:12:\"upload_error\";a:1:{i:0;s:21:\"No file was uploaded.\";}}s:10:\"error_data\";a:0:{}}'),
(1343, 171, 'fullname', 'Đặng Hoàng Phi'),
(1344, 171, 'password', 'e10adc3949ba59abbe56e057f20f883e'),
(1345, 171, 'mobile', '123123123'),
(1346, 171, 'id_user', 'USR53'),
(1347, 171, '_thumbnail_id', 'O:8:\"WP_Error\":2:{s:6:\"errors\";a:1:{s:12:\"upload_error\";a:1:{i:0;s:21:\"No file was uploaded.\";}}s:10:\"error_data\";a:0:{}}'),
(1348, 172, 'fullname', 'Bùi Thị Mi Mi'),
(1349, 172, 'password', 'e10adc3949ba59abbe56e057f20f883e'),
(1350, 172, 'mobile', '101010'),
(1351, 172, 'id_user', 'USR61'),
(1352, 172, '_thumbnail_id', 'O:8:\"WP_Error\":2:{s:6:\"errors\";a:1:{s:12:\"upload_error\";a:1:{i:0;s:21:\"No file was uploaded.\";}}s:10:\"error_data\";a:0:{}}'),
(1353, 173, 'fullname', 'Phạm Duy Khánh'),
(1354, 173, 'password', 'e10adc3949ba59abbe56e057f20f883e'),
(1355, 173, 'mobile', '1234567'),
(1356, 173, 'id_user', 'USR100'),
(1357, 173, '_thumbnail_id', 'O:8:\"WP_Error\":2:{s:6:\"errors\";a:1:{s:12:\"upload_error\";a:1:{i:0;s:21:\"No file was uploaded.\";}}s:10:\"error_data\";a:0:{}}'),
(1358, 174, 'fullname', 'Nguyễn Kinh Lân'),
(1359, 174, 'password', 'e10adc3949ba59abbe56e057f20f883e'),
(1360, 174, 'mobile', '098'),
(1361, 174, 'id_user', 'USR87'),
(1362, 174, '_thumbnail_id', 'O:8:\"WP_Error\":2:{s:6:\"errors\";a:1:{s:12:\"upload_error\";a:1:{i:0;s:21:\"No file was uploaded.\";}}s:10:\"error_data\";a:0:{}}'),
(1363, 176, '_edit_last', '1'),
(1364, 176, 'field_5c44366974539', 'a:14:{s:3:\"key\";s:19:\"field_5c44366974539\";s:5:\"label\";s:7:\"doctor1\";s:4:\"name\";s:7:\"doctor1\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:2:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:0;}'),
(1365, 176, 'field_5c44367e7453a', 'a:14:{s:3:\"key\";s:19:\"field_5c44367e7453a\";s:5:\"label\";s:7:\"doctor2\";s:4:\"name\";s:7:\"doctor2\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:2:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:1;}'),
(1366, 176, 'field_5c4436877453b', 'a:14:{s:3:\"key\";s:19:\"field_5c4436877453b\";s:5:\"label\";s:8:\"nursing1\";s:4:\"name\";s:8:\"nursing1\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:2:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:2;}'),
(1367, 176, 'field_5c44368b7453c', 'a:14:{s:3:\"key\";s:19:\"field_5c44368b7453c\";s:5:\"label\";s:8:\"nursing2\";s:4:\"name\";s:8:\"nursing2\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:2:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:3;}'),
(1368, 176, 'field_5c4436907453d', 'a:14:{s:3:\"key\";s:19:\"field_5c4436907453d\";s:5:\"label\";s:8:\"nursing3\";s:4:\"name\";s:8:\"nursing3\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:2:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:4;}'),
(1369, 176, 'field_5c4436957453e', 'a:14:{s:3:\"key\";s:19:\"field_5c4436957453e\";s:5:\"label\";s:8:\"nursing4\";s:4:\"name\";s:8:\"nursing4\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:2:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:5;}'),
(1370, 176, 'field_5c44369a7453f', 'a:14:{s:3:\"key\";s:19:\"field_5c44369a7453f\";s:5:\"label\";s:8:\"nursing5\";s:4:\"name\";s:8:\"nursing5\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:2:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:6;}'),
(1371, 176, 'field_5c4436a474540', 'a:14:{s:3:\"key\";s:19:\"field_5c4436a474540\";s:5:\"label\";s:3:\"ktv\";s:4:\"name\";s:3:\"ktv\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:2:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:7;}'),
(1372, 176, 'field_5c4436ab74541', 'a:14:{s:3:\"key\";s:19:\"field_5c4436ab74541\";s:5:\"label\";s:5:\"input\";s:4:\"name\";s:5:\"input\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:2:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:8;}'),
(1373, 176, 'field_5c4436c274542', 'a:14:{s:3:\"key\";s:19:\"field_5c4436c274542\";s:5:\"label\";s:4:\"room\";s:4:\"name\";s:4:\"room\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:2:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:9;}'),
(1374, 176, 'rule', 'a:5:{s:5:\"param\";s:9:\"post_type\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:4:\"ekip\";s:8:\"order_no\";i:0;s:8:\"group_no\";i:0;}'),
(1375, 176, 'position', 'normal'),
(1376, 176, 'layout', 'no_box'),
(1377, 176, 'hide_on_screen', ''),
(1378, 176, '_edit_lock', '1547975806:1'),
(1379, 174, '_edit_lock', '1547975593:1'),
(1380, 173, '_edit_lock', '1547975544:1'),
(1381, 172, '_edit_lock', '1547975553:1'),
(1382, 114, '_edit_lock', '1547975419:1'),
(1383, 170, '_edit_lock', '1547975566:1'),
(1384, 174, '_edit_last', '1'),
(1385, 168, '_edit_lock', '1547975607:1'),
(1386, 177, 'doctor1', 'Đỗ Quang Khải'),
(1387, 177, 'doctor1', 'Hà Văn Vọng'),
(1388, 177, 'nursing1', 'Phạm Duy Khánh'),
(1389, 177, 'nursing2', 'Phạm Duy Khánh'),
(1390, 177, 'nursing3', 'Phạm Duy Khánh'),
(1391, 177, 'nursing4', 'Phạm Duy Khánh'),
(1392, 177, 'nursing5', 'Phạm Duy Khánh'),
(1393, 177, 'ktv', 'Nguyễn Kinh Lân'),
(1394, 177, 'input', 'Bùi Thị Mi Mi'),
(1395, 177, '_edit_lock', '1547975752:1'),
(1396, 65, '_wp_trash_meta_status', 'publish'),
(1397, 65, '_wp_trash_meta_time', '1548033298'),
(1398, 65, '_wp_desired_post_slug', 'after-surgery'),
(1399, 56, 'field_5c4520831324c', 'a:13:{s:3:\"key\";s:19:\"field_5c4520831324c\";s:5:\"label\";s:8:\"Supplies\";s:4:\"name\";s:8:\"supplies\";s:4:\"type\";s:8:\"textarea\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:10:\"formatting\";s:2:\"br\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c38b59aceb74\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"yes\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:31;}'),
(1433, 179, 'doctor1', 'Đỗ Quang Khải'),
(1434, 179, 'doctor1', 'Hà Văn Vọng'),
(1435, 179, 'nursing1', 'Đặng Hoàng Phi'),
(1436, 179, 'nursing2', 'Đặng Hoàng Phi'),
(1437, 179, 'nursing3', 'Đặng Hoàng Phi'),
(1438, 179, 'nursing4', 'Đặng Hoàng Phi'),
(1439, 179, 'nursing5', 'Đặng Hoàng Phi'),
(1440, 179, 'ktv', 'Nguyễn Kinh Lân'),
(1441, 179, 'input', 'Đặng Hoàng Phi'),
(1442, 179, 'room', 'room_4'),
(1473, 181, 'doctor1', 'Đỗ Quang Khải'),
(1474, 181, 'doctor1', 'Hà Văn Vọng'),
(1475, 181, 'nursing1', 'Phạm Duy Khánh'),
(1476, 181, 'nursing2', 'Phạm Duy Khánh'),
(1477, 181, 'nursing3', 'Phạm Duy Khánh'),
(1478, 181, 'nursing4', 'Phạm Duy Khánh'),
(1479, 181, 'nursing5', 'Phạm Duy Khánh'),
(1480, 181, 'ktv', 'Nguyễn Kinh Lân'),
(1481, 181, 'input', 'Phạm Thị Bích Trâm'),
(1482, 181, 'room', 'room_3'),
(1484, 181, '_wp_trash_meta_status', 'publish'),
(1485, 181, '_wp_trash_meta_time', '1548039133'),
(1486, 181, '_wp_desired_post_slug', 'rm_room_3_20190121_0240'),
(1487, 179, '_wp_trash_meta_status', 'publish'),
(1488, 179, '_wp_trash_meta_time', '1548039133'),
(1489, 179, '_wp_desired_post_slug', 'rm__'),
(1490, 177, '_wp_trash_meta_status', 'publish'),
(1491, 177, '_wp_trash_meta_time', '1548039133'),
(1492, 177, '_wp_desired_post_slug', 'rm_room_2_20190120_0916'),
(1520, 142, '_edit_last', '1'),
(1521, 142, '_idcustomer', 'field_5c34c99b16d27'),
(1522, 142, '_idcard', 'field_5c33f27f3013c'),
(1523, 142, '_address', 'field_5c375685aaaa4'),
(1524, 142, 'ic_front', ''),
(1525, 142, '_ic_front', 'field_5c33f2da0ab2e'),
(1526, 142, '_mobile', 'field_5c33f2b243b1c'),
(1527, 142, '_facebook', 'field_5c33f32c408df'),
(1528, 142, 'customer_type', '1'),
(1529, 142, '_customer_type', 'field_5c33f334408e0'),
(1530, 142, 'history', ''),
(1531, 142, '_history', 'field_5c33f35833f97'),
(1532, 142, '_creator', 'field_5c38630f05a4f'),
(1560, 184, 'doctor1', 'Đỗ Quang Khải'),
(1561, 184, 'doctor1', 'Hà Văn Vọng'),
(1562, 184, 'nursing1', 'Đặng Hoàng Phi'),
(1563, 184, 'nursing2', 'Đặng Hoàng Phi'),
(1564, 184, 'nursing3', 'Đặng Hoàng Phi'),
(1565, 184, 'nursing4', 'Đặng Hoàng Phi'),
(1566, 184, 'nursing5', 'Đặng Hoàng Phi'),
(1567, 184, 'ktv', 'Nguyễn Kinh Lân'),
(1568, 184, 'input', 'Bùi Thị Mi Mi'),
(1569, 184, 'room', 'room_3'),
(1570, 184, '_edit_lock', '1548041389:1'),
(1571, 185, 'doctor1', 'Đỗ Quang Khải'),
(1572, 185, 'doctor1', 'Hà Văn Vọng'),
(1573, 185, 'nursing1', 'Bùi Thị Mi Mi'),
(1574, 185, 'nursing2', 'Bùi Thị Mi Mi'),
(1575, 185, 'nursing3', 'Bùi Thị Mi Mi'),
(1576, 185, 'nursing4', 'Bùi Thị Mi Mi'),
(1577, 185, 'nursing5', 'Bùi Thị Mi Mi'),
(1578, 185, 'ktv', 'Nguyễn Kinh Lân'),
(1579, 185, 'input', 'Đặng Hoàng Phi'),
(1580, 185, 'room', 'room_2'),
(1581, 187, '_edit_last', '1'),
(1582, 187, '_edit_lock', '1548045269:1'),
(1583, 187, '_wp_page_template', 'page-after.php'),
(1584, 56, 'field_5c454c9a1ab70', 'a:11:{s:3:\"key\";s:19:\"field_5c454c9a1ab70\";s:5:\"label\";s:6:\"Report\";s:4:\"name\";s:6:\"report\";s:4:\"type\";s:7:\"wysiwyg\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:7:\"toolbar\";s:4:\"full\";s:12:\"media_upload\";s:3:\"yes\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5c38b59aceb74\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:3:\"yes\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:30;}'),
(1586, 56, 'rule', 'a:5:{s:5:\"param\";s:9:\"post_type\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:7:\"surgery\";s:8:\"order_no\";i:0;s:8:\"group_no\";i:0;}'),
(1587, 190, 'fullname', 'Nguyễn Thị Kim Ngân'),
(1588, 190, 'password', 'e10adc3949ba59abbe56e057f20f883e'),
(1589, 190, 'mobile', '55555'),
(1590, 190, 'id_user', 'USR58'),
(1591, 191, '_wp_attached_file', '2019/01/favicon.png'),
(1592, 191, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:80;s:6:\"height\";i:80;s:4:\"file\";s:19:\"2019/01/favicon.png\";s:5:\"sizes\";a:0:{}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(1593, 190, '_my_file_upload', '191'),
(1594, 190, '_thumbnail_id', '191'),
(1598, 192, 'fullname', 'Nguyễn Thị Thu'),
(1599, 192, 'idcard', '12345678'),
(1600, 192, 'mobile', '12345678'),
(1601, 192, 'facebook', 'https://www.facebook.com/?ref=logo'),
(1602, 192, 'address', 'Hồ Chí Minh'),
(1603, 192, 'creator', 'Đặng Thị Linh Đa'),
(1604, 193, 'fullname', 'Nguyễn Thị Thu'),
(1605, 193, 'mobile', '12345678'),
(1606, 193, 'cusid_post', '192'),
(1607, 193, 'advise', 'no'),
(1608, 193, 'adviser', ''),
(1609, 193, 'channel', ''),
(1610, 193, 'services', 'Mũi cấu trúc (sụn Hàn/sụn Mỹ)'),
(1611, 193, 'date', '21-1-2019'),
(1612, 193, 'hasSur', NULL),
(1613, 193, 'detail_history', NULL),
(1614, 193, 'self_status', NULL),
(1615, 193, 'caution', ''),
(1616, 193, 'target', ''),
(1617, 193, 'target', ''),
(1618, 193, 'doctor_advise', ''),
(1619, 193, 'cus_note', ''),
(1620, 193, 'status', NULL),
(1621, 193, 'price', '35000000'),
(1622, 193, 'sale_discount', '1000000'),
(1623, 193, 'numb_image', '6'),
(1624, 194, 'fullname', 'Nguyễn Thị Thu'),
(1625, 194, 'mobile', '12345678'),
(1626, 194, 'cusid_post', '192'),
(1627, 194, 'advise', 'no'),
(1628, 194, 'adviser', ''),
(1629, 194, 'channel', ''),
(1630, 194, 'services', 'Mũi cấu trúc (sụn Hàn/sụn Mỹ)'),
(1631, 194, 'date', '22-1-2019'),
(1632, 194, 'hasSur', 'no'),
(1633, 194, 'detail_history', NULL),
(1634, 194, 'self_status', NULL),
(1635, 194, 'caution', 'Không'),
(1636, 194, 'target', '\n            Cấu trúc nguyên thuỷ:<br>\n            Mũi tẹt, sóng thấp<br>\n            \n            Mong muốn của khách hàng:<br>\n            Tuỳ thuộc vào tư vấn của bác sĩ và tư vấn viên<br>\n            <br>\n            '),
(1637, 194, 'target', '\n            Cấu trúc nguyên thuỷ:<br>\n            Mũi tẹt, sóng thấp<br>\n            \n            Mong muốn của khách hàng:<br>\n            Tuỳ thuộc vào tư vấn của bác sĩ và tư vấn viên<br>\n            <br>\n            '),
(1638, 194, 'doctor_advise', 'Làm mũi cấu trúc'),
(1639, 194, 'cus_note', 'Cao hết cỡ'),
(1640, 194, 'status', 'tvv'),
(1641, 194, 'price', '35000000'),
(1642, 194, 'sale_discount', '2000000'),
(1643, 194, 'numb_image', '6'),
(1644, 194, '_wp_trash_meta_status', 'publish'),
(1645, 194, '_wp_trash_meta_time', '1548054902'),
(1646, 194, '_wp_desired_post_slug', 'sur_22'),
(1647, 193, 'accept', 'yes'),
(1648, 193, 'approve', 'Ngô Thị Thùy Trang'),
(1649, 193, 'payment_status', 'Thu đủ'),
(1650, 193, 'payment_detail', '\n            <strong>Phương thức thanh toán:</strong>cash<br>\n            <strong>Tình trạng thanh toán:</strong>Thu đủ<br>\n            '),
(1651, 193, '_my_file_upload', 'O:8:\"WP_Error\":2:{s:6:\"errors\";a:1:{s:12:\"upload_error\";a:1:{i:0;s:21:\"No file was uploaded.\";}}s:10:\"error_data\";a:0:{}}'),
(1652, 193, 'image_before', 'O:8:\"WP_Error\":2:{s:6:\"errors\";a:1:{s:12:\"upload_error\";a:1:{i:0;s:21:\"No file was uploaded.\";}}s:10:\"error_data\";a:0:{}}'),
(1653, 193, 'ekip', 'RM_room_2_20190121_0742'),
(1654, 195, 'doctor1', 'Đỗ Quang Khải'),
(1655, 195, 'doctor1', 'Hà Văn Vọng'),
(1656, 195, 'nursing1', 'Phạm Duy Khánh'),
(1657, 195, 'nursing2', 'Phạm Duy Khánh'),
(1658, 195, 'nursing3', 'Phạm Duy Khánh'),
(1659, 195, 'nursing4', 'Phạm Duy Khánh'),
(1660, 195, 'nursing5', 'Phạm Duy Khánh'),
(1661, 195, 'ktv', 'Nguyễn Kinh Lân'),
(1662, 195, 'input', 'Phạm Duy Khánh'),
(1663, 195, 'room', 'room_2');

-- --------------------------------------------------------

--
-- Table structure for table `wp_posts`
--

CREATE TABLE `wp_posts` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `guid` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_posts`
--

INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2019-01-06 08:02:02', '2019-01-06 08:02:02', 'Chúc mừng đến với WordPress. Đây là bài viết đầu tiên của bạn. Hãy chỉnh sửa hay xóa bài viết này, và bắt đầu viết blog!', 'Chào tất cả mọi người!', '', 'trash', 'open', 'open', '', 'chao-moi-nguoi__trashed', '', '', '2019-01-07 14:41:03', '2019-01-07 14:41:03', '', 0, 'http://vnese-freelance.co/projects/klain/admin/?p=1', 0, 'post', '', 1),
(2, 1, '2019-01-06 08:02:02', '2019-01-06 08:02:02', 'Đây là một trang mẫu. Nó khác với một bài blog bởi vì nó sẽ là một trang tĩnh và sẽ được thêm vào thanh menu của trang web của bạn (trong hầu hết theme). Mọi người thường bắt đầu bằng một trang Giới thiệu để giới thiệu bản thân đến người dùng tiềm năng. Bạn có thể viết như sau:\n\n<blockquote>Xin chào! Tôi là người giao thư bằng xe đạp vào ban ngày, một diễn viên đầy tham vọng vào ban đêm, và đây là trang web của tôi. Tôi sống ở Los Angeles, có một chú cho tuyệt vời tên là Jack, và tôi thích uống cocktail.</blockquote>\n\n...hay như thế này:\n\n<blockquote>Công ty XYZ Doohickey được thành lập vào năm 1971, và đã cung cấp đồ dùng chất lượng cho công chúng kể từ đó. Nằm ở thành phố Gotham, XYZ tạo việc làm cho hơn 2.000 người và làm tất cả những điều tuyệt vời cho cộng đồng Gotham.</blockquote>\n\nLà người dùng WordPress mới, bạn nên truy cập <a href=\"http://vnese-freelance.co/projects/klain/admin/wp-admin/\">trang quản trị</a> để xóa trang này và tạo các trang mới cho nội dung của bạn. Chúc vui vẻ!', 'Trang Mẫu', '', 'trash', 'closed', 'open', '', 'Trang mẫu__trashed', '', '', '2019-01-07 13:22:51', '2019-01-07 13:22:51', '', 0, 'http://vnese-freelance.co/projects/klain/admin/?page_id=2', 0, 'page', '', 0),
(3, 1, '2019-01-06 08:02:02', '2019-01-06 08:02:02', '<h2>Chúng tôi là ai</h2><p>Địa chỉ website là: http://vnese-freelance.co/projects/klain/admin.</p><h2>Thông tin cá nhân nào bị thu thập và tại sao thu thập</h2><h3>Bình luận</h3><p>Khi khách truy cập để lại bình luận trên trang web, chúng tôi thu thập dữ liệu được hiển thị trong biểu mẫu bình luận và cũng là địa chỉ IP của người truy cập và chuỗi user agent của người dùng trình duyệt để giúp phát hiện spam</p><p>Một chuỗi ẩn danh được tạo từ địa chỉ email của bạn (còn được gọi là hash) có thể được cung cấp cho dịch vụ Gravatar để xem bạn có đang sử dụng nó hay không. Chính sách bảo mật của dịch vụ Gravatar có tại đây: https://automattic.com/privacy/. Sau khi chấp nhận bình luận của bạn, ảnh tiểu sử của bạn được hiển thị công khai trong ngữ cảnh bình luận của bạn.</p><h3>Thư viện</h3><p>Nếu bạn tải hình ảnh lên trang web, bạn nên tránh tải lên hình ảnh có dữ liệu vị trí được nhúng (EXIF GPS) đi kèm. Khách truy cập vào trang web có thể tải xuống và giải nén bất kỳ dữ liệu vị trí nào từ hình ảnh trên trang web.</p><h3>Thông tin liên hệ</h3><h3>Cookies</h3><p>Nếu bạn viết bình luận trong website, bạn có thể cung cấp cần nhập tên, email địa chỉ website trong cookie. Các thông tin này nhằm giúp bạn không cần nhập thông tin nhiều lần khi viết bình luận khác. Cookie này sẽ được lưu giữ trong một năm.</p><p>Nếu bạn có tài khoản và đăng nhập và website, chúng tôi sẽ thiết lập một cookie tạm thời để xác định nếu trình duyệt cho phép sử dụng cookie. Cookie này không bao gồm thông tin cá nhân và sẽ được gỡ bỏ khi bạn đóng trình duyệt.</p><p>Khi bạn đăng nhập, chúng tôi sẽ thiết lập một vài cookie để lưu thông tin đăng nhập và lựa chọn hiển thị. Thông tin đăng nhập gần nhất lưu trong hai ngày, và lựa chọn hiển thị gần nhất lưu trong một năm. Nếu bạn chọn &quot;Nhớ tôi&quot;, thông tin đăng nhập sẽ được lưu trong hai tuần. Nếu bạn thoát tài khoản, thông tin cookie đăng nhập sẽ bị xoá.</p><p>Nếu bạn sửa hoặc công bố bài viết, một bản cookie bổ sung sẽ được lưu trong trình duyệt. Cookie này không chứa thông tin cá nhân và chỉ đơn giản bao gồm ID của bài viết bạn đã sửa. Nó tự động hết hạn sau 1 ngày.</p><h3>Nội dung nhúng từ website khác</h3><p>Các bài viết trên trang web này có thể bao gồm nội dung được nhúng (ví dụ: video, hình ảnh, bài viết, v.v.). Nội dung được nhúng từ các trang web khác hoạt động theo cùng một cách chính xác như khi khách truy cập đã truy cập trang web khác.</p><p>Những website này có thể thu thập dữ liệu về bạn, sử dụng cookie, nhúng các trình theo dõi của bên thứ ba và giám sát tương tác của bạn với nội dung được nhúng đó, bao gồm theo dõi tương tác của bạn với nội dung được nhúng nếu bạn có tài khoản và đã đăng nhập vào trang web đó.</p><h3>Phân tích</h3><h2>Chúng tôi chia sẻ dữ liệu của bạn với ai</h2><h2>Dữ liệu của bạn tồn tại bao lâu</h2><p>Nếu bạn để lại bình luận, bình luận và siêu dữ liệu của nó sẽ được giữ lại vô thời hạn. Điều này là để chúng tôi có thể tự động nhận ra và chấp nhận bất kỳ bình luận nào thay vì giữ chúng trong khu vực đợi kiểm duyệt.</p><p>Đối với người dùng đăng ký trên trang web của chúng tôi (nếu có), chúng tôi cũng lưu trữ thông tin cá nhân mà họ cung cấp trong hồ sơ người dùng của họ. Tất cả người dùng có thể xem, chỉnh sửa hoặc xóa thông tin cá nhân của họ bất kỳ lúc nào (ngoại trừ họ không thể thay đổi tên người dùng của họ). Quản trị viên trang web cũng có thể xem và chỉnh sửa thông tin đó.</p><h2>Các quyền nào của bạn với dữ liệu của mình</h2><p>Nếu bạn có tài khoản trên trang web này hoặc đã để lại nhận xét, bạn có thể yêu cầu nhận tệp xuất dữ liệu cá nhân mà chúng tôi lưu giữ về bạn, bao gồm mọi dữ liệu bạn đã cung cấp cho chúng tôi. Bạn cũng có thể yêu cầu chúng tôi xóa mọi dữ liệu cá nhân mà chúng tôi lưu giữ về bạn. Điều này không bao gồm bất kỳ dữ liệu nào chúng tôi có nghĩa vụ giữ cho các mục đích hành chính, pháp lý hoặc bảo mật.</p><h2>Các dữ liệu của bạn được gửi tới đâu</h2><p>Các bình luận của khách (không phải là thành viên) có thể được kiểm tra thông qua dịch vụ tự động phát hiện spam.</p><h2>Thông tin liên hệ của bạn</h2><h2>Thông tin bổ sung</h2><h3>Cách chúng tôi bảo vệ dữ liệu của bạn</h3><h3>Các quá trình tiết lộ dữ liệu mà chúng tôi thực hiện</h3><h3>Những bên thứ ba chúng tôi nhận dữ liệu từ đó</h3><h3>Việc quyết định và/hoặc thu thập thông tin tự động mà chúng tôi áp dụng với dữ liệu người dùng</h3><h3>Các yêu cầu công bố thông tin được quản lý</h3>', 'Chính sách bảo mật', '', 'trash', 'closed', 'open', '', 'chinh-sach-bao-mat__trashed', '', '', '2019-01-07 13:22:49', '2019-01-07 13:22:49', '', 0, 'http://vnese-freelance.co/projects/klain/admin/?page_id=3', 0, 'page', '', 0),
(5, 1, '2019-01-07 13:22:49', '2019-01-07 13:22:49', '<h2>Chúng tôi là ai</h2><p>Địa chỉ website là: http://vnese-freelance.co/projects/klain/admin.</p><h2>Thông tin cá nhân nào bị thu thập và tại sao thu thập</h2><h3>Bình luận</h3><p>Khi khách truy cập để lại bình luận trên trang web, chúng tôi thu thập dữ liệu được hiển thị trong biểu mẫu bình luận và cũng là địa chỉ IP của người truy cập và chuỗi user agent của người dùng trình duyệt để giúp phát hiện spam</p><p>Một chuỗi ẩn danh được tạo từ địa chỉ email của bạn (còn được gọi là hash) có thể được cung cấp cho dịch vụ Gravatar để xem bạn có đang sử dụng nó hay không. Chính sách bảo mật của dịch vụ Gravatar có tại đây: https://automattic.com/privacy/. Sau khi chấp nhận bình luận của bạn, ảnh tiểu sử của bạn được hiển thị công khai trong ngữ cảnh bình luận của bạn.</p><h3>Thư viện</h3><p>Nếu bạn tải hình ảnh lên trang web, bạn nên tránh tải lên hình ảnh có dữ liệu vị trí được nhúng (EXIF GPS) đi kèm. Khách truy cập vào trang web có thể tải xuống và giải nén bất kỳ dữ liệu vị trí nào từ hình ảnh trên trang web.</p><h3>Thông tin liên hệ</h3><h3>Cookies</h3><p>Nếu bạn viết bình luận trong website, bạn có thể cung cấp cần nhập tên, email địa chỉ website trong cookie. Các thông tin này nhằm giúp bạn không cần nhập thông tin nhiều lần khi viết bình luận khác. Cookie này sẽ được lưu giữ trong một năm.</p><p>Nếu bạn có tài khoản và đăng nhập và website, chúng tôi sẽ thiết lập một cookie tạm thời để xác định nếu trình duyệt cho phép sử dụng cookie. Cookie này không bao gồm thông tin cá nhân và sẽ được gỡ bỏ khi bạn đóng trình duyệt.</p><p>Khi bạn đăng nhập, chúng tôi sẽ thiết lập một vài cookie để lưu thông tin đăng nhập và lựa chọn hiển thị. Thông tin đăng nhập gần nhất lưu trong hai ngày, và lựa chọn hiển thị gần nhất lưu trong một năm. Nếu bạn chọn &quot;Nhớ tôi&quot;, thông tin đăng nhập sẽ được lưu trong hai tuần. Nếu bạn thoát tài khoản, thông tin cookie đăng nhập sẽ bị xoá.</p><p>Nếu bạn sửa hoặc công bố bài viết, một bản cookie bổ sung sẽ được lưu trong trình duyệt. Cookie này không chứa thông tin cá nhân và chỉ đơn giản bao gồm ID của bài viết bạn đã sửa. Nó tự động hết hạn sau 1 ngày.</p><h3>Nội dung nhúng từ website khác</h3><p>Các bài viết trên trang web này có thể bao gồm nội dung được nhúng (ví dụ: video, hình ảnh, bài viết, v.v.). Nội dung được nhúng từ các trang web khác hoạt động theo cùng một cách chính xác như khi khách truy cập đã truy cập trang web khác.</p><p>Những website này có thể thu thập dữ liệu về bạn, sử dụng cookie, nhúng các trình theo dõi của bên thứ ba và giám sát tương tác của bạn với nội dung được nhúng đó, bao gồm theo dõi tương tác của bạn với nội dung được nhúng nếu bạn có tài khoản và đã đăng nhập vào trang web đó.</p><h3>Phân tích</h3><h2>Chúng tôi chia sẻ dữ liệu của bạn với ai</h2><h2>Dữ liệu của bạn tồn tại bao lâu</h2><p>Nếu bạn để lại bình luận, bình luận và siêu dữ liệu của nó sẽ được giữ lại vô thời hạn. Điều này là để chúng tôi có thể tự động nhận ra và chấp nhận bất kỳ bình luận nào thay vì giữ chúng trong khu vực đợi kiểm duyệt.</p><p>Đối với người dùng đăng ký trên trang web của chúng tôi (nếu có), chúng tôi cũng lưu trữ thông tin cá nhân mà họ cung cấp trong hồ sơ người dùng của họ. Tất cả người dùng có thể xem, chỉnh sửa hoặc xóa thông tin cá nhân của họ bất kỳ lúc nào (ngoại trừ họ không thể thay đổi tên người dùng của họ). Quản trị viên trang web cũng có thể xem và chỉnh sửa thông tin đó.</p><h2>Các quyền nào của bạn với dữ liệu của mình</h2><p>Nếu bạn có tài khoản trên trang web này hoặc đã để lại nhận xét, bạn có thể yêu cầu nhận tệp xuất dữ liệu cá nhân mà chúng tôi lưu giữ về bạn, bao gồm mọi dữ liệu bạn đã cung cấp cho chúng tôi. Bạn cũng có thể yêu cầu chúng tôi xóa mọi dữ liệu cá nhân mà chúng tôi lưu giữ về bạn. Điều này không bao gồm bất kỳ dữ liệu nào chúng tôi có nghĩa vụ giữ cho các mục đích hành chính, pháp lý hoặc bảo mật.</p><h2>Các dữ liệu của bạn được gửi tới đâu</h2><p>Các bình luận của khách (không phải là thành viên) có thể được kiểm tra thông qua dịch vụ tự động phát hiện spam.</p><h2>Thông tin liên hệ của bạn</h2><h2>Thông tin bổ sung</h2><h3>Cách chúng tôi bảo vệ dữ liệu của bạn</h3><h3>Các quá trình tiết lộ dữ liệu mà chúng tôi thực hiện</h3><h3>Những bên thứ ba chúng tôi nhận dữ liệu từ đó</h3><h3>Việc quyết định và/hoặc thu thập thông tin tự động mà chúng tôi áp dụng với dữ liệu người dùng</h3><h3>Các yêu cầu công bố thông tin được quản lý</h3>', 'Chính sách bảo mật', '', 'inherit', 'closed', 'closed', '', '3-revision-v1', '', '', '2019-01-07 13:22:49', '2019-01-07 13:22:49', '', 3, 'http://vnese-freelance.co/projects/klain/admin/index.php/2019/01/07/3-revision-v1/', 0, 'revision', '', 0),
(6, 1, '2019-01-07 13:22:51', '2019-01-07 13:22:51', 'Đây là một trang mẫu. Nó khác với một bài blog bởi vì nó sẽ là một trang tĩnh và sẽ được thêm vào thanh menu của trang web của bạn (trong hầu hết theme). Mọi người thường bắt đầu bằng một trang Giới thiệu để giới thiệu bản thân đến người dùng tiềm năng. Bạn có thể viết như sau:\n\n<blockquote>Xin chào! Tôi là người giao thư bằng xe đạp vào ban ngày, một diễn viên đầy tham vọng vào ban đêm, và đây là trang web của tôi. Tôi sống ở Los Angeles, có một chú cho tuyệt vời tên là Jack, và tôi thích uống cocktail.</blockquote>\n\n...hay như thế này:\n\n<blockquote>Công ty XYZ Doohickey được thành lập vào năm 1971, và đã cung cấp đồ dùng chất lượng cho công chúng kể từ đó. Nằm ở thành phố Gotham, XYZ tạo việc làm cho hơn 2.000 người và làm tất cả những điều tuyệt vời cho cộng đồng Gotham.</blockquote>\n\nLà người dùng WordPress mới, bạn nên truy cập <a href=\"http://vnese-freelance.co/projects/klain/admin/wp-admin/\">trang quản trị</a> để xóa trang này và tạo các trang mới cho nội dung của bạn. Chúc vui vẻ!', 'Trang Mẫu', '', 'inherit', 'closed', 'closed', '', '2-revision-v1', '', '', '2019-01-07 13:22:51', '2019-01-07 13:22:51', '', 2, 'http://vnese-freelance.co/projects/klain/admin/index.php/2019/01/07/2-revision-v1/', 0, 'revision', '', 0),
(7, 1, '2019-01-07 13:22:59', '2019-01-07 13:22:59', '', 'Login', '', 'publish', 'closed', 'closed', '', 'login', '', '', '2019-01-07 13:22:59', '2019-01-07 13:22:59', '', 0, 'http://vnese-freelance.co/projects/klain/admin/?page_id=7', 0, 'page', '', 0),
(8, 1, '2019-01-07 13:22:59', '2019-01-07 13:22:59', '', 'Login', '', 'inherit', 'closed', 'closed', '', '7-revision-v1', '', '', '2019-01-07 13:22:59', '2019-01-07 13:22:59', '', 7, 'http://vnese-freelance.co/projects/klain/admin/index.php/2019/01/07/7-revision-v1/', 0, 'revision', '', 0),
(10, 1, '2019-01-07 14:25:04', '2019-01-07 14:25:04', 'a:7:{s:8:\"location\";a:1:{i:0;a:1:{i:0;a:3:{s:5:\"param\";s:9:\"post_type\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:5:\"users\";}}}s:8:\"position\";s:6:\"normal\";s:5:\"style\";s:7:\"default\";s:15:\"label_placement\";s:3:\"top\";s:21:\"instruction_placement\";s:5:\"label\";s:14:\"hide_on_screen\";s:0:\"\";s:11:\"description\";s:0:\"\";}', 'Users', 'users', 'publish', 'closed', 'closed', '', 'group_5c33612e46640', '', '', '2019-01-07 14:25:37', '2019-01-07 14:25:37', '', 0, 'http://vnese-freelance.co/projects/klain/?post_type=acf-field-group&#038;p=10', 0, 'acf-field-group', '', 0),
(11, 1, '2019-01-07 14:25:04', '2019-01-07 14:25:04', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Fullname', 'fullname', 'publish', 'closed', 'closed', '', 'field_5c336138a705b', '', '', '2019-01-07 14:25:04', '2019-01-07 14:25:04', '', 10, 'http://vnese-freelance.co/projects/klain/?post_type=acf-field&p=11', 0, 'acf-field', '', 0),
(12, 1, '2019-01-07 14:25:37', '2019-01-07 14:25:37', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Password', 'password', 'publish', 'closed', 'closed', '', 'field_5c33614a95cdc', '', '', '2019-01-07 14:25:37', '2019-01-07 14:25:37', '', 10, 'http://vnese-freelance.co/projects/klain/?post_type=acf-field&p=12', 1, 'acf-field', '', 0),
(13, 1, '2019-01-07 14:28:26', '2019-01-07 14:28:26', '', 'khanh.nguyen', '', 'publish', 'closed', 'closed', '', 'khanh-nguyen', '', '', '2019-01-16 15:06:31', '2019-01-16 15:06:31', '', 0, 'http://vnese-freelance.co/projects/klain/?post_type=users&#038;p=13', 0, 'users', '', 0),
(14, 1, '2019-01-07 14:35:16', '2019-01-07 14:35:16', '', 'IMG_1499', '', 'inherit', 'open', 'closed', '', 'img_1499', '', '', '2019-01-07 14:35:16', '2019-01-07 14:35:16', '', 13, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/IMG_1499.jpg', 0, 'attachment', 'image/jpeg', 0),
(15, 1, '2019-01-07 14:38:48', '2019-01-07 14:38:48', '', 'Users', '', 'publish', 'closed', 'closed', '', 'acf_users', '', '', '2019-01-08 05:02:25', '2019-01-08 05:02:25', '', 0, 'http://vnese-freelance.co/projects/klain/?post_type=acf&#038;p=15', 0, 'acf', '', 0),
(16, 1, '2019-01-07 14:41:03', '2019-01-07 14:41:03', 'Chúc mừng đến với WordPress. Đây là bài viết đầu tiên của bạn. Hãy chỉnh sửa hay xóa bài viết này, và bắt đầu viết blog!', 'Chào tất cả mọi người!', '', 'inherit', 'closed', 'closed', '', '1-revision-v1', '', '', '2019-01-07 14:41:03', '2019-01-07 14:41:03', '', 1, 'http://vnese-freelance.co/projects/klain/khong-phan-loai/1-revision-v1/', 0, 'revision', '', 0),
(18, 1, '2019-01-08 00:45:36', '2019-01-08 00:45:36', '', 'Customer', '', 'publish', 'closed', 'closed', '', 'acf_customer', '', '', '2019-01-11 09:34:17', '2019-01-11 09:34:17', '', 0, 'http://vnese-freelance.co/projects/klain/?post_type=acf&#038;p=18', 0, 'acf', '', 0),
(20, 1, '2019-01-08 02:41:08', '2019-01-08 02:41:08', '', 'Search', '', 'publish', 'closed', 'closed', '', 'search', '', '', '2019-01-08 02:41:08', '2019-01-08 02:41:08', '', 0, 'http://vnese-freelance.co/projects/klain/?page_id=20', 0, 'page', '', 0),
(21, 1, '2019-01-08 02:41:08', '2019-01-08 02:41:08', '', 'Search', '', 'inherit', 'closed', 'closed', '', '20-revision-v1', '', '', '2019-01-08 02:41:08', '2019-01-08 02:41:08', '', 20, 'http://vnese-freelance.co/projects/klain/khong-phan-loai/20-revision-v1/', 0, 'revision', '', 0),
(23, 1, '2019-01-08 04:01:01', '2019-01-08 04:01:01', '', 'new', '', 'inherit', 'open', 'closed', '', 'new', '', '', '2019-01-08 04:01:01', '2019-01-08 04:01:01', '', 0, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/new.jpg', 0, 'attachment', 'image/jpeg', 0),
(24, 1, '2019-01-08 04:31:09', '2019-01-08 04:31:09', '', 'Add Customer', '', 'publish', 'closed', 'closed', '', 'add-customer', '', '', '2019-01-08 15:21:29', '2019-01-08 15:21:29', '', 0, 'http://vnese-freelance.co/projects/klain/?page_id=24', 0, 'page', '', 0),
(25, 1, '2019-01-08 04:31:09', '2019-01-08 04:31:09', '', 'Add Customer', '', 'inherit', 'closed', 'closed', '', '24-revision-v1', '', '', '2019-01-08 04:31:09', '2019-01-08 04:31:09', '', 24, 'http://vnese-freelance.co/projects/klain/khong-phan-loai/24-revision-v1/', 0, 'revision', '', 0),
(26, 1, '2019-01-08 05:22:26', '2019-01-08 05:22:26', '', 'Add user', '', 'publish', 'closed', 'closed', '', 'add-user', '', '', '2019-01-08 05:22:26', '2019-01-08 05:22:26', '', 0, 'http://vnese-freelance.co/projects/klain/?page_id=26', 0, 'page', '', 0),
(27, 1, '2019-01-08 05:22:26', '2019-01-08 05:22:26', '', 'Add user', '', 'inherit', 'closed', 'closed', '', '26-revision-v1', '', '', '2019-01-08 05:22:26', '2019-01-08 05:22:26', '', 26, 'http://vnese-freelance.co/projects/klain/khong-phan-loai/26-revision-v1/', 0, 'revision', '', 0),
(40, 0, '2019-01-08 15:03:36', '2019-01-08 15:03:36', '', 'architecture-1477041_1280', '', 'inherit', 'open', 'closed', '', 'architecture-1477041_1280', '', '', '2019-01-08 15:03:36', '2019-01-08 15:03:36', '', 0, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/architecture-1477041_1280.jpg', 0, 'attachment', 'image/jpeg', 0),
(42, 0, '2019-01-08 15:07:30', '2019-01-08 15:07:30', '', 'WhatsApp Image 2019-01-08 at 6.53.09 PM', '', 'inherit', 'open', 'closed', '', 'whatsapp-image-2019-01-08-at-6-53-09-pm', '', '', '2019-01-08 15:07:30', '2019-01-08 15:07:30', '', 0, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/WhatsApp-Image-2019-01-08-at-6.53.09-PM.jpeg', 0, 'attachment', 'image/jpeg', 0),
(44, 0, '2019-01-08 15:09:46', '2019-01-08 15:09:46', '', 'Lookbook', '', 'inherit', 'open', 'closed', '', 'lookbook', '', '', '2019-01-08 15:09:46', '2019-01-08 15:09:46', '', 0, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/Lookbook.jpg', 0, 'attachment', 'image/jpeg', 0),
(48, 1, '2019-01-10 03:15:12', '2019-01-10 03:15:12', '', 'Add surgery', '', 'publish', 'closed', 'closed', '', 'add-surgery', '', '', '2019-01-10 03:15:12', '2019-01-10 03:15:12', '', 0, 'http://vnese-freelance.co/projects/klain/?page_id=48', 0, 'page', '', 0),
(49, 1, '2019-01-10 03:15:12', '2019-01-10 03:15:12', '', 'Add surgery', '', 'inherit', 'closed', 'closed', '', '48-revision-v1', '', '', '2019-01-10 03:15:12', '2019-01-10 03:15:12', '', 48, 'http://vnese-freelance.co/projects/klain/khong-phan-loai/48-revision-v1/', 0, 'revision', '', 0),
(50, 1, '2019-01-10 04:23:29', '2019-01-10 04:23:29', '', 'Services', '', 'publish', 'closed', 'closed', '', 'acf_services', '', '', '2019-01-12 01:31:27', '2019-01-12 01:31:27', '', 0, 'http://vnese-freelance.co/projects/klain/?post_type=acf&#038;p=50', 0, 'acf', '', 0),
(51, 1, '2019-01-10 04:23:59', '2019-01-10 04:23:59', '', '3 Cắt mí (trên/ dưới) hoặc treo chân mày', '', 'publish', 'closed', 'closed', '', '3-cat-mi-tren-duoi-hoac-treo-chan-may', '', '', '2019-01-10 04:24:37', '2019-01-10 04:24:37', '', 0, 'http://vnese-freelance.co/projects/klain/?post_type=services&#038;p=51', 0, 'services', '', 0),
(52, 1, '2019-01-10 04:25:57', '2019-01-10 04:25:57', '', 'Nâng ngực túi mentor/natrelee/nano thường', '', 'publish', 'closed', 'closed', '', '15-nang-nguc-tui-mentor-natrelee-nano-thuong', '', '', '2019-01-19 02:17:42', '2019-01-19 02:17:42', '', 0, 'http://vnese-freelance.co/projects/klain/?post_type=services&#038;p=52', 0, 'services', '', 0),
(53, 1, '2019-01-10 06:14:49', '2019-01-10 06:14:49', '', 'Confirm Services', '', 'publish', 'closed', 'closed', '', 'confirm-services', '', '', '2019-01-11 23:03:21', '2019-01-11 23:03:21', '', 0, 'http://vnese-freelance.co/projects/klain/?page_id=53', 0, 'page', '', 0),
(54, 1, '2019-01-10 06:14:49', '2019-01-10 06:14:49', '', 'Confirm Services', '', 'inherit', 'closed', 'closed', '', '53-revision-v1', '', '', '2019-01-10 06:14:49', '2019-01-10 06:14:49', '', 53, 'http://vnese-freelance.co/projects/klain/khong-phan-loai/53-revision-v1/', 0, 'revision', '', 0),
(56, 1, '2019-01-10 16:31:15', '2019-01-10 16:31:15', '', 'Surgery', '', 'publish', 'closed', 'closed', '', 'acf_surgery', '', '', '2019-01-21 04:38:33', '2019-01-21 04:38:33', '', 0, 'http://vnese-freelance.co/projects/klain/?post_type=acf&#038;p=56', 0, 'acf', '', 0),
(57, 1, '2019-01-10 16:50:26', '2019-01-10 16:50:26', '', 'form counter', '', 'publish', 'closed', 'closed', '', 'form-counter', '', '', '2019-01-10 16:50:26', '2019-01-10 16:50:26', '', 0, 'http://vnese-freelance.co/projects/klain/?page_id=57', 0, 'page', '', 0),
(59, 1, '2019-01-10 16:50:26', '2019-01-10 16:50:26', '', 'form counter', '', 'inherit', 'closed', 'closed', '', '57-revision-v1', '', '', '2019-01-10 16:50:26', '2019-01-10 16:50:26', '', 57, 'http://vnese-freelance.co/projects/klain/khong-phan-loai/57-revision-v1/', 0, 'revision', '', 0),
(60, 1, '2019-01-11 00:29:33', '2019-01-11 00:29:33', '', 'doctor confirm', '', 'publish', 'closed', 'closed', '', 'doctor-confirm', '', '', '2019-01-11 00:29:33', '2019-01-11 00:29:33', '', 0, 'http://vnese-freelance.co/projects/klain/?page_id=60', 0, 'page', '', 0),
(62, 1, '2019-01-11 00:29:33', '2019-01-11 00:29:33', '', 'doctor confirm', '', 'inherit', 'closed', 'closed', '', '60-revision-v1', '', '', '2019-01-11 00:29:33', '2019-01-11 00:29:33', '', 60, 'http://vnese-freelance.co/projects/klain/khong-phan-loai/60-revision-v1/', 0, 'revision', '', 0),
(63, 1, '2019-01-11 00:31:17', '2019-01-11 00:31:17', '', 'ekip surgery', '', 'publish', 'closed', 'closed', '', 'ekip-surgery', '', '', '2019-01-11 00:31:17', '2019-01-11 00:31:17', '', 0, 'http://vnese-freelance.co/projects/klain/?page_id=63', 0, 'page', '', 0),
(64, 1, '2019-01-11 00:31:17', '2019-01-11 00:31:17', '', 'ekip surgery', '', 'inherit', 'closed', 'closed', '', '63-revision-v1', '', '', '2019-01-11 00:31:17', '2019-01-11 00:31:17', '', 63, 'http://vnese-freelance.co/projects/klain/khong-phan-loai/63-revision-v1/', 0, 'revision', '', 0),
(65, 1, '2019-01-11 00:32:38', '2019-01-11 00:32:38', '', 'After Surgery', '', 'trash', 'closed', 'closed', '', 'after-surgery__trashed', '', '', '2019-01-21 01:14:58', '2019-01-21 01:14:58', '', 0, 'http://vnese-freelance.co/projects/klain/?page_id=65', 0, 'page', '', 0),
(66, 1, '2019-01-11 00:32:38', '2019-01-11 00:32:38', '', 'After Surgery', '', 'inherit', 'closed', 'closed', '', '65-revision-v1', '', '', '2019-01-11 00:32:38', '2019-01-11 00:32:38', '', 65, 'http://vnese-freelance.co/projects/klain/khong-phan-loai/65-revision-v1/', 0, 'revision', '', 0),
(67, 1, '2019-01-11 00:33:38', '2019-01-11 00:33:38', '', 'care', '', 'publish', 'closed', 'closed', '', 'care', '', '', '2019-01-11 00:33:38', '2019-01-11 00:33:38', '', 0, 'http://vnese-freelance.co/projects/klain/?page_id=67', 0, 'page', '', 0),
(68, 1, '2019-01-11 00:33:38', '2019-01-11 00:33:38', '', 'care', '', 'inherit', 'closed', 'closed', '', '67-revision-v1', '', '', '2019-01-11 00:33:38', '2019-01-11 00:33:38', '', 67, 'http://vnese-freelance.co/projects/klain/khong-phan-loai/67-revision-v1/', 0, 'revision', '', 0),
(70, 1, '2019-01-11 01:30:01', '2019-01-11 01:30:01', '', 'Supplies', '', 'publish', 'closed', 'closed', '', 'acf_supplies', '', '', '2019-01-11 01:30:01', '2019-01-11 01:30:01', '', 0, 'http://vnese-freelance.co/projects/klain/?post_type=acf&#038;p=70', 0, 'acf', '', 0),
(71, 1, '2019-01-11 01:33:00', '2019-01-11 01:33:00', '', 'Bơm tiêm 1ml', '', 'publish', 'closed', 'closed', '', 'bom-tiem-1ml', '', '', '2019-01-11 01:33:00', '2019-01-11 01:33:00', '', 0, 'http://vnese-freelance.co/projects/klain/?post_type=supplies&#038;p=71', 0, 'supplies', '', 0),
(72, 1, '2019-01-11 01:33:20', '2019-01-11 01:33:20', '', 'Dao 15', '', 'publish', 'closed', 'closed', '', 'dao-15', '', '', '2019-01-11 01:33:20', '2019-01-11 01:33:20', '', 0, 'http://vnese-freelance.co/projects/klain/?post_type=supplies&#038;p=72', 0, 'supplies', '', 0),
(73, 1, '2019-01-11 01:33:30', '2019-01-11 01:33:30', '', 'Dao 11', '', 'publish', 'closed', 'closed', '', 'dao-11', '', '', '2019-01-11 01:33:30', '2019-01-11 01:33:30', '', 0, 'http://vnese-freelance.co/projects/klain/?post_type=supplies&#038;p=73', 0, 'supplies', '', 0),
(82, 1, '2019-01-11 09:10:58', '2019-01-11 09:10:58', '', 'banner_diy', '', 'inherit', 'open', 'closed', '', 'banner_diy', '', '', '2019-01-11 09:10:58', '2019-01-11 09:10:58', '', 0, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/banner_diy.jpg', 0, 'attachment', 'image/jpeg', 0),
(92, 1, '2019-01-12 00:26:33', '2019-01-12 00:26:33', '', 'Add Supply', '', 'trash', 'closed', 'closed', '', 'add-supply__trashed', '', '', '2019-01-12 00:36:45', '2019-01-12 00:36:45', '', 0, 'http://vnese-freelance.co/projects/klain/?page_id=92', 0, 'page', '', 0),
(93, 1, '2019-01-12 00:26:33', '2019-01-12 00:26:33', '', 'Add Supply', '', 'inherit', 'closed', 'closed', '', '92-revision-v1', '', '', '2019-01-12 00:26:33', '2019-01-12 00:26:33', '', 92, 'http://vnese-freelance.co/projects/klain/khong-phan-loai/92-revision-v1/', 0, 'revision', '', 0),
(94, 1, '2019-01-12 00:37:54', '2019-01-12 00:37:54', '', 'Add supplies', '', 'publish', 'closed', 'closed', '', 'add-supplies', '', '', '2019-01-12 00:37:54', '2019-01-12 00:37:54', '', 0, 'http://vnese-freelance.co/projects/klain/?page_id=94', 0, 'page', '', 0),
(95, 1, '2019-01-12 00:37:54', '2019-01-12 00:37:54', '', 'Add supplies', '', 'inherit', 'closed', 'closed', '', '94-revision-v1', '', '', '2019-01-12 00:37:54', '2019-01-12 00:37:54', '', 94, 'http://vnese-freelance.co/projects/klain/khong-phan-loai/94-revision-v1/', 0, 'revision', '', 0),
(98, 1, '2019-01-12 00:48:52', '2019-01-12 00:48:52', '', 'đồ chơi', '', 'publish', 'closed', 'closed', '', 'do-choi', '', '', '2019-01-12 00:48:52', '2019-01-12 00:48:52', '', 0, 'http://vnese-freelance.co/projects/klain/supplies/do-choi/', 0, 'supplies', '', 0),
(102, 1, '2019-01-12 00:53:51', '2019-01-12 00:53:51', '', 'icon-certificate03', '', 'inherit', 'open', 'closed', '', 'icon-certificate03', '', '', '2019-01-12 00:53:51', '2019-01-12 00:53:51', '', 0, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/icon-certificate03.png', 0, 'attachment', 'image/png', 0),
(103, 1, '2019-01-12 01:06:13', '2019-01-12 01:06:13', '', 'Add services', '', 'publish', 'closed', 'closed', '', 'add-services', '', '', '2019-01-12 01:06:13', '2019-01-12 01:06:13', '', 0, 'http://vnese-freelance.co/projects/klain/?page_id=103', 0, 'page', '', 0),
(104, 1, '2019-01-12 01:06:13', '2019-01-12 01:06:13', '', 'Add services', '', 'inherit', 'closed', 'closed', '', '103-revision-v1', '', '', '2019-01-12 01:06:13', '2019-01-12 01:06:13', '', 103, 'http://vnese-freelance.co/projects/klain/khong-phan-loai/103-revision-v1/', 0, 'revision', '', 0),
(105, 1, '2019-01-12 01:29:32', '2019-01-12 01:29:32', '', 'Mũi bọc sụn', '', 'trash', 'closed', 'closed', '', 'mui-boc-sun__trashed', '', '', '2019-01-12 01:30:04', '2019-01-12 01:30:04', '', 0, 'http://vnese-freelance.co/projects/klain/supplies/mui-boc-sun/', 0, 'supplies', '', 0),
(106, 1, '2019-01-12 01:30:25', '2019-01-12 01:30:25', '', 'Mũi bọc sụn', '', 'publish', 'closed', 'closed', '', 'mui-boc-sun', '', '', '2019-01-12 01:30:25', '2019-01-12 01:30:25', '', 0, 'http://vnese-freelance.co/projects/klain/services/mui-boc-sun/', 0, 'services', '', 0),
(107, 1, '2019-01-12 01:35:20', '2019-01-12 01:35:20', '', 'Mũi cấu trúc (sụn Hàn/sụn Mỹ)', '', 'publish', 'closed', 'closed', '', 'mui-cau-truc-sun-han-sun-my', '', '', '2019-01-20 01:24:26', '2019-01-20 01:24:26', '', 0, 'http://vnese-freelance.co/projects/klain/services/mui-cau-truc-sun-han-sun-my/', 0, 'services', '', 0),
(108, 1, '2019-01-12 02:28:57', '2019-01-12 02:28:57', '', 'IMG_0560', '', 'inherit', 'open', 'closed', '', 'img_0560', '', '', '2019-01-12 02:28:57', '2019-01-12 02:28:57', '', 0, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/IMG_0560.jpg', 0, 'attachment', 'image/jpeg', 0),
(114, 1, '2019-01-13 02:38:35', '2019-01-13 02:38:35', '', 'khang.pham', '', 'publish', 'closed', 'closed', '', 'khang-pham', '', '', '2019-01-13 02:38:35', '2019-01-13 02:38:35', '', 0, 'http://vnese-freelance.co/projects/klain/users/khang-pham/', 0, 'users', '', 0),
(115, 1, '2019-01-13 02:38:35', '2019-01-13 02:38:35', '', 'new', '', 'inherit', 'open', 'closed', '', 'new-2', '', '', '2019-01-13 02:38:35', '2019-01-13 02:38:35', '', 114, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/new-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(116, 1, '2019-01-13 02:42:14', '2019-01-13 02:42:14', '', 'WhatsApp Image 2019-01-08 at 6.53.09 PM', '', 'inherit', 'open', 'closed', '', 'whatsapp-image-2019-01-08-at-6-53-09-pm-2', '', '', '2019-01-13 02:42:14', '2019-01-13 02:42:14', '', 114, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/WhatsApp-Image-2019-01-08-at-6.53.09-PM-1.jpeg', 0, 'attachment', 'image/jpeg', 0),
(117, 1, '2019-01-13 02:43:34', '2019-01-13 02:43:34', '', 'new', '', 'inherit', 'open', 'closed', '', 'new-3', '', '', '2019-01-13 02:43:34', '2019-01-13 02:43:34', '', 114, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/new-2.jpg', 0, 'attachment', 'image/jpeg', 0),
(119, 1, '2019-01-15 15:17:53', '2019-01-15 15:17:53', '', 'Nguyễn Thị Thu Diễm', '', 'publish', 'closed', 'closed', '', 'nguyen-thi-thu-diem', '', '', '2019-01-15 15:17:53', '2019-01-15 15:17:53', '', 0, 'http://vnese-freelance.co/projects/klain/customers/nguyen-thi-thu-diem/', 0, 'customers', '', 0),
(121, 1, '2019-01-15 15:21:25', '2019-01-15 15:21:25', '', 'architecture-1477041_1280', '', 'inherit', 'open', 'closed', '', 'architecture-1477041_1280-2', '', '', '2019-01-15 15:21:25', '2019-01-15 15:21:25', '', 0, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/architecture-1477041_1280-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(123, 1, '2019-01-15 15:22:12', '2019-01-15 15:22:12', '', 'WhatsApp Image 2019-01-08 at 6.53.09 PM', '', 'inherit', 'open', 'closed', '', 'whatsapp-image-2019-01-08-at-6-53-09-pm-3', '', '', '2019-01-15 15:22:12', '2019-01-15 15:22:12', '', 0, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/WhatsApp-Image-2019-01-08-at-6.53.09-PM-2.jpeg', 0, 'attachment', 'image/jpeg', 0),
(124, 1, '2019-01-15 16:32:47', '2019-01-15 16:32:47', '', 'Huỳnh Minh Ngọc', '', 'publish', 'closed', 'closed', '', 'huynh-minh-ngoc', '', '', '2019-01-15 16:32:47', '2019-01-15 16:32:47', '', 0, 'http://vnese-freelance.co/projects/klain/customers/huynh-minh-ngoc/', 0, 'customers', '', 0),
(125, 1, '2019-01-15 23:14:43', '2019-01-15 23:14:43', '', 'Nâng mông nội soi', '', 'publish', 'closed', 'closed', '', 'nang-mong-noi-soi', '', '', '2019-01-15 23:14:43', '2019-01-15 23:14:43', '', 0, 'http://vnese-freelance.co/projects/klain/services/nang-mong-noi-soi/', 0, 'services', '', 0),
(133, 1, '2019-01-16 14:43:17', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2019-01-16 14:43:17', '0000-00-00 00:00:00', '', 0, 'http://vnese-freelance.co/projects/klain/?post_type=surgery&p=133', 0, 'surgery', '', 0),
(136, 1, '2019-01-16 15:00:34', '2019-01-16 15:00:34', '', 'architecture-1477041_1280', '', 'inherit', 'open', 'closed', '', 'architecture-1477041_1280-3', '', '', '2019-01-16 15:00:34', '2019-01-16 15:00:34', '', 0, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/architecture-1477041_1280-2.jpg', 0, 'attachment', 'image/jpeg', 0),
(137, 1, '2019-01-16 15:08:25', '2019-01-16 15:08:25', '', 'trang.ngo', '', 'publish', 'closed', 'closed', '', 'trang-ngo', '', '', '2019-01-16 15:08:25', '2019-01-16 15:08:25', '', 0, 'http://vnese-freelance.co/projects/klain/users/trang-ngo/', 0, 'users', '', 0),
(138, 1, '2019-01-16 15:08:25', '2019-01-16 15:08:25', '', 'living-room-2569325_1280', '', 'inherit', 'open', 'closed', '', 'living-room-2569325_1280', '', '', '2019-01-16 15:08:25', '2019-01-16 15:08:25', '', 137, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/living-room-2569325_1280.jpg', 0, 'attachment', 'image/jpeg', 0),
(140, 1, '2019-01-18 20:45:05', '2019-01-18 20:45:05', '', 'da.dang', '', 'publish', 'closed', 'closed', '', 'da-dang', '', '', '2019-01-18 21:55:16', '2019-01-18 21:55:16', '', 0, 'http://vnese-freelance.co/projects/klain/users/da-dang/', 0, 'users', '', 0),
(141, 1, '2019-01-18 20:45:05', '2019-01-18 20:45:05', '', 'interior-2685521_1280', '', 'inherit', 'open', 'closed', '', 'interior-2685521_1280', '', '', '2019-01-18 20:45:05', '2019-01-18 20:45:05', '', 140, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/interior-2685521_1280.jpg', 0, 'attachment', 'image/jpeg', 0),
(142, 1, '2019-01-18 20:45:59', '2019-01-18 20:45:59', '', 'Xập thị xệ', '', 'publish', 'closed', 'closed', '', 'xap-thi-xe', '', '', '2019-01-21 03:23:04', '2019-01-21 03:23:04', '', 0, 'http://vnese-freelance.co/projects/klain/customers/xap-thi-xe/', 0, 'customers', '', 0),
(147, 1, '2019-01-18 22:04:11', '2019-01-18 22:04:11', '', 'user.room1', '', 'publish', 'closed', 'closed', '', 'user-room1', '', '', '2019-01-20 08:24:08', '2019-01-20 08:24:08', '', 0, 'http://vnese-freelance.co/projects/klain/users/user-room1/', 0, 'users', '', 0),
(148, 1, '2019-01-18 22:04:11', '2019-01-18 22:04:11', '', 'Lookbook', '', 'inherit', 'open', 'closed', '', 'lookbook-2', '', '', '2019-01-18 22:04:11', '2019-01-18 22:04:11', '', 147, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/Lookbook-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(149, 1, '2019-01-19 01:36:26', '2019-01-19 01:36:26', '', 'vong.ha', '', 'publish', 'closed', 'closed', '', 'vong-ha', '', '', '2019-01-19 01:36:26', '2019-01-19 01:36:26', '', 0, 'http://vnese-freelance.co/projects/klain/users/vong-ha/', 0, 'users', '', 0),
(150, 1, '2019-01-19 01:36:26', '2019-01-19 01:36:26', '', 'wall-416060_1280', '', 'inherit', 'open', 'closed', '', 'wall-416060_1280', '', '', '2019-01-19 01:36:26', '2019-01-19 01:36:26', '', 149, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/wall-416060_1280.jpg', 0, 'attachment', 'image/jpeg', 0),
(151, 1, '2019-01-19 01:42:31', '2019-01-19 01:42:31', '', 'khai.do', '', 'publish', 'closed', 'closed', '', 'khai-do', '', '', '2019-01-20 08:08:31', '2019-01-20 08:08:31', '', 0, 'http://vnese-freelance.co/projects/klain/users/khai-do/', 0, 'users', '', 0),
(152, 1, '2019-01-19 01:42:31', '2019-01-19 01:42:31', '', 'living-room-2569325_1280', '', 'inherit', 'open', 'closed', '', 'living-room-2569325_1280-2', '', '', '2019-01-19 01:42:31', '2019-01-19 01:42:31', '', 151, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/living-room-2569325_1280-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(154, 0, '2019-01-20 01:18:50', '2019-01-20 01:18:50', '', 'Trần văn A', '', 'publish', 'closed', 'closed', '', 'tran-van-a', '', '', '2019-01-20 01:18:50', '2019-01-20 01:18:50', '', 0, 'http://vnese-freelance.co/projects/klain/customers/tran-van-a/', 0, 'customers', '', 0),
(159, 1, '2019-01-20 02:18:07', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2019-01-20 02:18:07', '0000-00-00 00:00:00', '', 0, 'http://vnese-freelance.co/projects/klain/?post_type=surgery&p=159', 0, 'surgery', '', 0),
(168, 1, '2019-01-20 08:35:20', '2019-01-20 08:35:20', '', 'trinh.le', '', 'publish', 'closed', 'closed', '', 'trinh-le', '', '', '2019-01-20 08:35:20', '2019-01-20 08:35:20', '', 0, 'http://vnese-freelance.co/projects/klain/users/trinh-le/', 0, 'users', '', 0),
(169, 1, '2019-01-20 08:35:48', '2019-01-20 08:35:48', '', 'tram.pham', '', 'publish', 'closed', 'closed', '', 'tram-pham', '', '', '2019-01-20 08:35:48', '2019-01-20 08:35:48', '', 0, 'http://vnese-freelance.co/projects/klain/users/tram-pham/', 0, 'users', '', 0),
(170, 1, '2019-01-20 08:36:09', '2019-01-20 08:36:09', '', 'yen.van', '', 'publish', 'closed', 'closed', '', 'yen-van', '', '', '2019-01-20 08:36:09', '2019-01-20 08:36:09', '', 0, 'http://vnese-freelance.co/projects/klain/users/yen-van/', 0, 'users', '', 0),
(171, 1, '2019-01-20 08:36:40', '2019-01-20 08:36:40', '', 'phi.dang', '', 'publish', 'closed', 'closed', '', 'phi-dang', '', '', '2019-01-20 08:36:40', '2019-01-20 08:36:40', '', 0, 'http://vnese-freelance.co/projects/klain/users/phi-dang/', 0, 'users', '', 0),
(172, 1, '2019-01-20 08:36:58', '2019-01-20 08:36:58', '', 'mi.bui', '', 'publish', 'closed', 'closed', '', 'mi-bui', '', '', '2019-01-20 08:36:58', '2019-01-20 08:36:58', '', 0, 'http://vnese-freelance.co/projects/klain/users/mi-bui/', 0, 'users', '', 0),
(173, 1, '2019-01-20 08:37:23', '2019-01-20 08:37:23', '', 'khanh.pham', '', 'publish', 'closed', 'closed', '', 'khanh-pham', '', '', '2019-01-20 08:37:23', '2019-01-20 08:37:23', '', 0, 'http://vnese-freelance.co/projects/klain/users/khanh-pham/', 0, 'users', '', 0),
(174, 1, '2019-01-20 08:37:57', '2019-01-20 08:37:57', '', 'lan.nguyenk', '', 'publish', 'closed', 'closed', '', 'lan-nguyenk', '', '', '2019-01-20 09:13:13', '2019-01-20 09:13:13', '', 0, 'http://vnese-freelance.co/projects/klain/users/lan-nguyenk/', 0, 'users', '', 0),
(175, 1, '2019-01-20 08:50:21', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2019-01-20 08:50:21', '0000-00-00 00:00:00', '', 0, 'http://vnese-freelance.co/projects/klain/?post_type=ekip&p=175', 0, 'ekip', '', 0),
(176, 1, '2019-01-20 08:52:41', '2019-01-20 08:52:41', '', 'Ekip', '', 'publish', 'closed', 'closed', '', 'acf_ekip', '', '', '2019-01-20 08:52:41', '2019-01-20 08:52:41', '', 0, 'http://vnese-freelance.co/projects/klain/?post_type=acf&#038;p=176', 0, 'acf', '', 0),
(177, 0, '2019-01-20 09:16:43', '2019-01-20 09:16:43', '', 'RM_room_2_20190120_0916', '', 'trash', 'closed', 'closed', '', 'rm_room_2_20190120_0916__trashed', '', '', '2019-01-21 02:52:13', '2019-01-21 02:52:13', '', 0, 'http://vnese-freelance.co/projects/klain/ekip/rm_room_2_20190120_0916/', 0, 'ekip', '', 0),
(179, 0, '2019-01-21 01:50:02', '2019-01-21 01:50:02', '', 'RM__', '', 'trash', 'closed', 'closed', '', 'rm____trashed', '', '', '2019-01-21 02:52:13', '2019-01-21 02:52:13', '', 0, 'http://vnese-freelance.co/projects/klain/ekip/rm__/', 0, 'ekip', '', 0),
(181, 0, '2019-01-21 02:40:22', '2019-01-21 02:40:22', '', 'RM_room_3_20190121_0240', '', 'trash', 'closed', 'closed', '', 'rm_room_3_20190121_0240__trashed', '', '', '2019-01-21 02:52:13', '2019-01-21 02:52:13', '', 0, 'http://vnese-freelance.co/projects/klain/ekip/rm_room_3_20190121_0240/', 0, 'ekip', '', 0),
(184, 0, '2019-01-21 03:26:58', '2019-01-21 03:26:58', '', 'RM_room_3_20190121_0326', '', 'publish', 'closed', 'closed', '', 'rm_room_3_20190121_0326', '', '', '2019-01-21 03:26:58', '2019-01-21 03:26:58', '', 0, 'http://vnese-freelance.co/projects/klain/ekip/rm_room_3_20190121_0326/', 0, 'ekip', '', 0),
(185, 0, '2019-01-21 03:30:32', '2019-01-21 03:30:32', '', 'RM_room_2_20190121_0330', '', 'publish', 'closed', 'closed', '', 'rm_room_2_20190121_0330', '', '', '2019-01-21 03:30:32', '2019-01-21 03:30:32', '', 0, 'http://vnese-freelance.co/projects/klain/ekip/rm_room_2_20190121_0330/', 0, 'ekip', '', 0),
(186, 1, '2019-01-21 04:21:35', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2019-01-21 04:21:35', '0000-00-00 00:00:00', '', 0, 'http://vnese-freelance.co/projects/klain/?page_id=186', 0, 'page', '', 0),
(187, 1, '2019-01-21 04:25:48', '2019-01-21 04:25:48', '', 'After surgery', '', 'publish', 'closed', 'closed', '', 'after-surgery', '', '', '2019-01-21 04:25:48', '2019-01-21 04:25:48', '', 0, 'http://vnese-freelance.co/projects/klain/?page_id=187', 0, 'page', '', 0),
(188, 1, '2019-01-21 04:25:48', '2019-01-21 04:25:48', '', 'After surgery', '', 'inherit', 'closed', 'closed', '', '187-revision-v1', '', '', '2019-01-21 04:25:48', '2019-01-21 04:25:48', '', 187, 'http://vnese-freelance.co/projects/klain/khong-phan-loai/187-revision-v1/', 0, 'revision', '', 0),
(189, 1, '2019-01-21 04:37:06', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2019-01-21 04:37:06', '0000-00-00 00:00:00', '', 0, 'http://vnese-freelance.co/projects/klain/?post_type=acf&p=189', 0, 'acf', '', 0),
(190, 1, '2019-01-21 04:40:47', '2019-01-21 04:40:47', '', 'ngan.nguyen', '', 'publish', 'closed', 'closed', '', 'ngan-nguyen', '', '', '2019-01-21 04:40:47', '2019-01-21 04:40:47', '', 0, 'http://vnese-freelance.co/projects/klain/users/ngan-nguyen/', 0, 'users', '', 0),
(191, 1, '2019-01-21 04:40:47', '2019-01-21 04:40:47', '', 'favicon', '', 'inherit', 'open', 'closed', '', 'favicon', '', '', '2019-01-21 04:40:47', '2019-01-21 04:40:47', '', 190, 'http://vnese-freelance.co/projects/klain/admin/wp-content/uploads/2019/01/favicon.png', 0, 'attachment', 'image/png', 0),
(192, 0, '2019-01-21 07:09:13', '2019-01-21 07:09:13', '', 'Nguyễn Thị Thu', '', 'publish', 'closed', 'closed', '', 'nguyen-thi-thu', '', '', '2019-01-21 07:09:13', '2019-01-21 07:09:13', '', 0, 'http://vnese-freelance.co/projects/klain/customers/nguyen-thi-thu/', 0, 'customers', '', 0),
(193, 0, '2019-01-21 07:11:20', '2019-01-21 07:11:20', '', 'SUR_87', '', 'publish', 'closed', 'closed', '', 'sur_87', '', '', '2019-01-21 07:11:20', '2019-01-21 07:11:20', '', 0, 'http://vnese-freelance.co/projects/klain/surgery/sur_87/', 0, 'surgery', '', 0),
(194, 0, '2019-01-21 07:14:28', '2019-01-21 07:14:28', '', 'SUR_22', '', 'trash', 'closed', 'closed', '', 'sur_22__trashed', '', '', '2019-01-21 07:15:02', '2019-01-21 07:15:02', '', 0, 'http://vnese-freelance.co/projects/klain/surgery/sur_22/', 0, 'surgery', '', 0),
(195, 0, '2019-01-21 07:42:11', '2019-01-21 07:42:11', '', 'RM_room_2_20190121_0742', '', 'publish', 'closed', 'closed', '', 'rm_room_2_20190121_0742', '', '', '2019-01-21 07:42:11', '2019-01-21 07:42:11', '', 0, 'http://vnese-freelance.co/projects/klain/ekip/rm_room_2_20190121_0742/', 0, 'ekip', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_termmeta`
--

CREATE TABLE `wp_termmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_terms`
--

CREATE TABLE `wp_terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_terms`
--

INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Chưa được phân loại', 'khong-phan-loai', 0),
(2, 'manager', 'manager', 0),
(3, 'adviser', 'adviser', 0),
(4, 'counter', 'counter', 0),
(5, 'doctor', 'doctor', 0),
(6, 'nursing', 'nursing', 0),
(7, 'customer care', 'customer-care', 0),
(8, 'sale', 'sale', 0),
(9, 'body', 'body', 0),
(10, 'mắt', 'mat', 0),
(11, 'mũi', 'mui', 0),
(12, 'môi', 'moi', 0),
(13, 'ngực', 'nguc', 0),
(14, 'hút mỡ', 'hut-mo', 0),
(15, 'mông', 'mong', 0),
(16, 'khác', 'khac', 0),
(17, 'face', 'face', 0),
(18, 'room', 'room', 0),
(19, 'boss', 'boss', 0),
(20, 'ktv', 'ktv', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_relationships`
--

CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_term_relationships`
--

INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0),
(13, 2, 0),
(51, 10, 0),
(51, 17, 0),
(52, 9, 0),
(52, 13, 0),
(106, 11, 0),
(106, 17, 0),
(107, 11, 0),
(107, 17, 0),
(114, 2, 0),
(125, 9, 0),
(125, 15, 0),
(137, 4, 0),
(140, 8, 0),
(147, 18, 0),
(149, 5, 0),
(151, 19, 0),
(168, 6, 0),
(169, 6, 0),
(170, 6, 0),
(171, 6, 0),
(172, 6, 0),
(173, 6, 0),
(174, 20, 0),
(190, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_taxonomy`
--

CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_term_taxonomy`
--

INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 0),
(2, 2, 'userscat', '', 0, 2),
(3, 3, 'userscat', '', 0, 0),
(4, 4, 'userscat', '', 0, 1),
(5, 5, 'userscat', '', 0, 1),
(6, 6, 'userscat', '', 0, 6),
(7, 7, 'userscat', '', 0, 1),
(8, 8, 'userscat', '', 0, 1),
(9, 9, 'servicescat', '', 0, 2),
(10, 10, 'typecat', '', 0, 1),
(11, 11, 'typecat', '', 0, 2),
(12, 12, 'typecat', '', 0, 0),
(13, 13, 'typecat', '', 0, 1),
(14, 14, 'typecat', '', 0, 0),
(15, 15, 'typecat', '', 0, 1),
(16, 16, 'typecat', '', 0, 0),
(17, 17, 'servicescat', '', 0, 3),
(18, 18, 'userscat', '', 0, 1),
(19, 19, 'userscat', '', 0, 1),
(20, 20, 'userscat', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wp_usermeta`
--

CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_usermeta`
--

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'admin'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'syntax_highlighting', 'true'),
(7, 1, 'comment_shortcuts', 'false'),
(8, 1, 'admin_color', 'fresh'),
(9, 1, 'use_ssl', '0'),
(10, 1, 'show_admin_bar_front', 'true'),
(11, 1, 'locale', ''),
(12, 1, 'wp_capabilities', 'a:1:{s:13:\"administrator\";b:1;}'),
(13, 1, 'wp_user_level', '10'),
(14, 1, 'dismissed_wp_pointers', 'wp496_privacy'),
(15, 1, 'show_welcome_panel', '0'),
(16, 1, 'session_tokens', 'a:2:{s:64:\"b897f5001bf7eefc88e9b4d92f7988505ca722264bb9c20e9e67bd9d14edc78a\";a:4:{s:10:\"expiration\";i:1548774888;s:2:\"ip\";s:13:\"42.112.81.218\";s:2:\"ua\";s:120:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36\";s:5:\"login\";i:1547565288;}s:64:\"bd0a4aa8a6de5dbbc0daa9455ab389b0da47b410bd2b3776833ea54b579b9011\";a:4:{s:10:\"expiration\";i:1548205763;s:2:\"ip\";s:13:\"14.161.11.192\";s:2:\"ua\";s:120:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36\";s:5:\"login\";i:1548032963;}}'),
(17, 1, 'wp_dashboard_quick_press_last_post_id', '118'),
(18, 1, 'community-events-location', 'a:1:{s:2:\"ip\";s:12:\"42.117.238.0\";}'),
(19, 1, 'show_try_gutenberg_panel', '0'),
(20, 1, 'closedpostboxes_dashboard', 'a:4:{i:0;s:19:\"dashboard_right_now\";i:1;s:18:\"dashboard_activity\";i:2;s:21:\"dashboard_quick_press\";i:3;s:17:\"dashboard_primary\";}'),
(21, 1, 'metaboxhidden_dashboard', 'a:0:{}'),
(22, 1, 'closedpostboxes_users', 'a:0:{}'),
(23, 1, 'metaboxhidden_users', 'a:2:{i:0;s:6:\"acf_18\";i:1;s:7:\"slugdiv\";}'),
(24, 1, 'wp_user-settings', 'libraryContent=browse'),
(25, 1, 'wp_user-settings-time', '1546871715'),
(26, 79, 'ic_front', '80');

-- --------------------------------------------------------

--
-- Table structure for table `wp_users`
--

CREATE TABLE `wp_users` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_users`
--

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'admin', '$P$BVjaO.vx83xgMN324ORpuQsagEGDMK.', 'admin', 'khangpham421@gmail.com', '', '2019-01-06 08:02:02', '', 0, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_comments`
--
ALTER TABLE `wp_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_email`(10));

--
-- Indexes for table `wp_links`
--
ALTER TABLE `wp_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Indexes for table `wp_options`
--
ALTER TABLE `wp_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Indexes for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_posts`
--
ALTER TABLE `wp_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`(191)),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`);

--
-- Indexes for table `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_terms`
--
ALTER TABLE `wp_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

--
-- Indexes for table `wp_term_relationships`
--
ALTER TABLE `wp_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indexes for table `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Indexes for table `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_users`
--
ALTER TABLE `wp_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`),
  ADD KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_comments`
--
ALTER TABLE `wp_comments`
  MODIFY `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wp_links`
--
ALTER TABLE `wp_links`
  MODIFY `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_options`
--
ALTER TABLE `wp_options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=586;

--
-- AUTO_INCREMENT for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1664;

--
-- AUTO_INCREMENT for table `wp_posts`
--
ALTER TABLE `wp_posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_terms`
--
ALTER TABLE `wp_terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `wp_users`
--
ALTER TABLE `wp_users`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
