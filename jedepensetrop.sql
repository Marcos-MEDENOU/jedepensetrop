-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 15 nov. 2023 à 07:57
-- Version du serveur : 5.7.33
-- Version de PHP : 8.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jedepensetrop`
--

-- --------------------------------------------------------

--
-- Structure de la table `blog_author`
--

CREATE TABLE `blog_author` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `blog_author`
--

INSERT INTO `blog_author` (`id`, `name`, `email`, `photo`, `bio`, `created_at`, `updated_at`) VALUES
(6, 'dodo', 'dodo@gmail.com', NULL, 'toto', '2023-06-05 18:38:18', '2023-06-06 06:15:16'),
(7, 'serge', 'serge@gmail.com', NULL, 'data manager', '2023-06-06 06:12:22', '2023-06-06 06:12:22');

-- --------------------------------------------------------

--
-- Structure de la table `blog_category`
--

CREATE TABLE `blog_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `is_visible` tinyint(1) NOT NULL DEFAULT '0',
  `seo_title` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `blog_category`
--

INSERT INTO `blog_category` (`id`, `name`, `slug`, `description`, `is_visible`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(57, 'ww', 'ww', 'ww', 1, 'ww', 'ww', '2023-06-06 06:12:59', '2023-06-06 06:12:59'),
(58, 'qQ', 'q', 'q', 1, 'q', 'q', '2023-06-06 09:51:02', '2023-06-06 09:51:02');

-- --------------------------------------------------------

--
-- Structure de la table `blog_post`
--

CREATE TABLE `blog_post` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_author_id` bigint(20) UNSIGNED DEFAULT NULL,
  `blog_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` datetime DEFAULT NULL,
  `seo_title` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `blog_post`
--

INSERT INTO `blog_post` (`id`, `blog_author_id`, `blog_category_id`, `title`, `slug`, `content`, `published_at`, `seo_title`, `seo_description`, `image`, `post_visible`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'fdhhd', 'dfhdh', '<p>dgdfhfg</p>', NULL, 'fdh', 'reyth', NULL, 0, '2023-06-07 12:18:12', '2023-06-07 12:18:12'),
(2, NULL, NULL, 'tr', 'tr', '<p>fdhd</p>', NULL, 'dgfd', 'fd', NULL, 0, '2023-06-07 12:21:51', '2023-06-07 12:21:51'),
(3, NULL, NULL, 'jky', 'yk', '<p>ykut</p>', NULL, 'tyk', 'tykt', NULL, 0, '2023-06-07 12:22:26', '2023-06-07 12:22:26'),
(4, NULL, NULL, 'gzer', 'ererg', '<p>ryeytrh</p>', '2023-06-07 18:02:00', 'trheet', 'erhe', NULL, 0, '2023-06-07 16:02:53', '2023-06-07 16:02:53');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `machine_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id`, `name`, `description`, `machine_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin Menu', 'admin', '2023-06-05 07:52:47', '2023-06-05 07:52:47'),
(2, 'testeur', 'un simple testeur', 'testeur', '2023-06-12 08:32:36', '2023-06-12 08:32:36');

-- --------------------------------------------------------

--
-- Structure de la table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `enabled` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `name`, `uri`, `description`, `parent_id`, `weight`, `enabled`, `created_at`, `updated_at`, `icon`) VALUES
(1, 1, 'Dashboard', '/dashboard', NULL, NULL, 0, 1, '2023-06-05 07:52:47', '2023-06-12 09:47:52', 'mdiViewDashboard'),
(2, 1, 'Permissions', '/<admin>/permission', NULL, NULL, 1, 1, '2023-06-05 07:52:47', '2023-06-12 09:48:37', 'mdiAccountKeyOutline'),
(3, 1, 'Roles', '/<admin>/role', NULL, NULL, 2, 1, '2023-06-05 07:52:47', '2023-06-12 09:50:13', 'mdiRobot'),
(4, 1, 'Users', '/<admin>/user', NULL, NULL, 3, 1, '2023-06-05 07:52:47', '2023-06-12 09:51:58', 'mdiAccountGroup'),
(5, 1, 'Menus', '/<admin>/menu', NULL, NULL, 4, 1, '2023-06-05 07:52:47', '2023-06-12 09:52:24', 'mdiMenu'),
(6, 1, 'Categories', '/<admin>/category', 'Categorie articles crud', NULL, 5, 1, '2023-06-05 08:28:41', '2023-06-12 11:12:57', 'mdiPostageStamp'),
(7, 1, 'Auteurs', '/<admin>/author', 'author of blog system', NULL, 7, 1, '2023-06-05 16:12:01', '2023-06-12 09:53:21', 'mdiAccountConvert'),
(8, 1, 'Posts', '/<admin>/posts', 'postviews', NULL, 7, 1, '2023-06-06 07:29:02', '2023-06-12 09:55:09', 'mdiPostOutline');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_06_03_143327_create_menu_tables', 1),
(6, '2023_06_03_144306_create_permission_tables', 1),
(7, '2023_06_04_204317_blog_category', 1),
(8, '2023_06_04_205927_blog_post', 1),
(9, '2023_06_04_213913_blog_author', 1);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(3, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(1, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 6),
(1, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'permission list', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(2, 'permission create', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(3, 'permission edit', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(4, 'permission delete', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(5, 'role list', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(6, 'role create', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(7, 'role edit', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(8, 'role delete', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(9, 'user list', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(10, 'user create', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(11, 'user edit', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(12, 'user delete', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(13, 'menu list', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(14, 'menu create', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(15, 'menu edit', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(16, 'menu delete', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(17, 'menu.item list', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(18, 'menu.item create', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(19, 'menu.item edit', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(20, 'menu.item delete', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'writer', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(2, 'admin', 'web', '2023-06-05 07:52:46', '2023-06-05 07:52:46'),
(3, 'super-admin', 'web', '2023-06-05 07:52:47', '2023-06-05 07:52:47');

-- --------------------------------------------------------

--
-- Structure de la table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(5, 1),
(9, 1),
(13, 1),
(17, 1),
(9, 2),
(10, 2),
(11, 2),
(12, 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@example.com', '2023-06-05 07:52:47', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Db8MgKQH1oyiOVOyAIvYASWiMXKXpOuJ1zUNb762fCA4E7HRpZZpiz3swNgG', '2023-06-05 07:52:47', '2023-06-05 07:52:47'),
(2, 'Admin User', 'admin@example.com', '2023-06-05 07:52:47', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'CSh8dLdC7A', '2023-06-05 07:52:47', '2023-06-05 07:52:47'),
(4, 'mmedenou', 'marcosmedenou@gmail.com', NULL, '$2y$10$aW65fwPcln/T0InKQ/UdquBwMn.ZyWvvabBnzLDUClVVJBkfiCC5S', 'NMYbpFekmtfMuzBCZqaVYwzHJjXweWFnr9dC87QsRLiAbijZiU6AEEdEnpck', '2023-06-05 07:57:05', '2023-06-05 07:59:23'),
(5, 'sahid', 'sahid@gmail.com', NULL, '$2y$10$uEltGuZnfb0xFy7hm3yfjeSeSHuRoX1NpWbJeg014rlepmrjhkHy2', '5yzcyl9OKOyQ61RRoSlJUHJAQrojiIqBtF71H3h6x9A3fFdaGIRxIvPHiTJF', '2023-06-05 10:35:50', '2023-06-05 10:35:50'),
(6, 'test', 'testy@gmail.com', NULL, '$2y$10$pZm/DJOZcxPXwAzX7SbVEesO0upilDHtqwjM9BHhahcaICTU5Dosy', NULL, '2023-06-05 14:38:28', '2023-06-05 18:31:15'),
(7, 'akanni', 'geoffroyxxx@gmail.com', NULL, '$2y$10$ycBhOhekemgdoume5sd36.e9VcDyaXIgZ.upGENyhH6tDeb2ZGaR2', NULL, '2023-06-05 15:13:53', '2023-06-05 18:52:57'),
(8, 'tobi', 'tobi@gmail.com', NULL, '$2y$10$uoF.bSBhZkcrGeZkSp5RwOJI5wuqOePPJVA8zIbKoWQ3NdOrPlOZ6', NULL, '2023-06-12 10:56:34', '2023-06-12 10:56:34');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `blog_author`
--
ALTER TABLE `blog_author`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_author_email_unique` (`email`);

--
-- Index pour la table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_category_slug_unique` (`slug`);

--
-- Index pour la table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_post_slug_unique` (`slug`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_machine_name_unique` (`machine_name`);

--
-- Index pour la table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `blog_author`
--
ALTER TABLE `blog_author`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
