/*
 Navicat Premium Data Transfer

 Source Server         : Mysql
 Source Server Type    : MySQL
 Source Server Version : 80027 (8.0.27)
 Source Host           : localhost:3306
 Source Schema         : jalin

 Target Server Type    : MySQL
 Target Server Version : 80027 (8.0.27)
 File Encoding         : 65001

 Date: 14/02/2023 10:34:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for app_settings
-- ----------------------------
DROP TABLE IF EXISTS `app_settings`;
CREATE TABLE `app_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` json NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_global` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_settings_user_id_foreign` (`user_id`),
  CONSTRAINT `app_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of app_settings
-- ----------------------------
BEGIN;
INSERT INTO `app_settings` (`id`, `user_id`, `type`, `name`, `value`, `status`, `is_global`, `created_at`, `updated_at`) VALUES (1, 1, 'setting', 'layout_setting', '{\"setting\": {\"footer\": {\"value\": \"default\"}, \"app_name\": {\"value\": \"\"}, \"card_color\": {\"value\": \"card-default\"}, \"page_layout\": {\"value\": \"container-fluid\"}, \"theme_color\": {\"value\": \"theme-color-default\"}, \"sidebar_type\": {\"value\": []}, \"theme_scheme\": {\"value\": \"light\"}, \"header_banner\": {\"value\": \"default\"}, \"header_navbar\": {\"value\": \"default\"}, \"sidebar_color\": {\"value\": \"sidebar-white\"}, \"theme_font_size\": {\"value\": \"theme-fs-md\"}, \"body_font_family\": {\"value\": \"Inter\"}, \"theme_transition\": {\"value\": null}, \"sidebar_menu_style\": {\"value\": \"left-bordered\"}, \"heading_font_family\": {\"value\": null}, \"theme_scheme_direction\": {\"value\": \"ltr\"}, \"theme_style_appearance\": {\"value\": []}}, \"storeKey\": \"huisetting\", \"saveLocal\": \"\"}', 1, 1, '2022-11-29 14:00:54', '2022-11-29 14:00:54');
COMMIT;

-- ----------------------------
-- Table structure for banks
-- ----------------------------
DROP TABLE IF EXISTS `banks`;
CREATE TABLE `banks` (
  `kode_bank` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`kode_bank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of banks
-- ----------------------------
BEGIN;
INSERT INTO `banks` (`kode_bank`, `name`) VALUES ('008', 'Mandiri');
COMMIT;

-- ----------------------------
-- Table structure for config_file_details
-- ----------------------------
DROP TABLE IF EXISTS `config_file_details`;
CREATE TABLE `config_file_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code_trans` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int NOT NULL,
  `field_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_at` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `length` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `config_file_details_code_trans_foreign` (`code_trans`),
  CONSTRAINT `config_file_details_code_trans_foreign` FOREIGN KEY (`code_trans`) REFERENCES `config_files` (`code_trans`)
) ENGINE=InnoDB AUTO_INCREMENT=248 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of config_file_details
-- ----------------------------
BEGIN;
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (1, '54', 1, 'trx_time', 'Waktu Transaksi', '0', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (2, '54', 2, 'trx_tgl', 'Tanggal Transaksi', '10', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (3, '54', 3, 'kode_terminal', 'Kode Terminal', '20', '17');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (4, '54', 4, 'no_kartu', 'No Kartu', '37', '19');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (5, '54', 5, 'jenis_message', 'Jenis Message', '56', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (6, '54', 6, 'kode_proses', 'Kode Pemrosesan', '65', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (7, '54', 7, 'nom_transaksi', 'Nominal Transaksi', '75', '15');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (8, '54', 8, 'kode_kesalahan', 'Kode Kesalahan', '91', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (9, '54', 9, 'kode_bank_iss', 'Kode Bank Issuer', '101', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (10, '54', 10, 'no_ref', 'No Refrensi', '110', '13');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (11, '54', 11, 'merchant_type', 'Merchant Type', '123', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (12, '54', 12, 'kode_retail', 'Kode Retail', '132', '21');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (13, '54', 13, 'approval', 'Kode Approval', '153', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (14, '54', 14, 'orig_nom', 'Orig Nomor Refrensi', '164', '11');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (15, '54A', 1, 'trx_time', 'Waktu Transaksi', '0', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (16, '54A', 2, 'trx_tgl', 'Tanggal Transaksi', '10', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (17, '54A', 3, 'kode_terminal', 'Kode Terminal', '20', '17');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (18, '54A', 4, 'no_kartu', 'No Kartu', '37', '19');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (19, '54A', 5, 'jenis_message', 'Jenis Message', '56', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (20, '54A', 6, 'kode_proses', 'Kode Pemrosesan', '65', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (21, '54A', 7, 'nom_transaksi', 'Nominal Transaksi', '75', '15');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (22, '54A', 8, 'kode_kesalahan', 'Kode Kesalahan', '91', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (23, '54A', 9, 'kode_bank_iss', 'Kode Bank Issuer', '101', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (24, '54A', 10, 'no_ref', 'No Refrensi', '110', '13');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (25, '54A', 11, 'merchant_type', 'Merchant Type', '123', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (26, '54A', 12, 'kode_retail', 'Kode Retail', '132', '21');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (27, '54A', 13, 'approval', 'Kode Approval', '153', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (28, '54A', 14, 'orig_nom', 'Orig Nomor Refrensi', '164', '11');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (29, '54B', 1, 'trx_time', 'Waktu Transaksi', '0', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (30, '54B', 2, 'trx_tgl', 'Tanggal Transaksi', '10', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (31, '54B', 3, 'kode_terminal', 'Kode Terminal', '20', '17');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (32, '54B', 4, 'no_kartu', 'No Kartu', '37', '19');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (33, '54B', 5, 'jenis_message', 'Jenis Message', '56', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (34, '54B', 6, 'kode_proses', 'Kode Pemrosesan', '65', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (35, '54B', 7, 'nom_transaksi', 'Nominal Transaksi', '75', '15');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (36, '54B', 8, 'kode_kesalahan', 'Kode Kesalahan', '91', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (37, '54B', 9, 'kode_bank_iss', 'Kode Bank Issuer', '101', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (38, '54B', 10, 'no_ref', 'No Refrensi', '110', '13');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (39, '54B', 11, 'merchant_type', 'Merchant Type', '123', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (40, '54B', 12, 'kode_retail', 'Kode Retail', '132', '21');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (41, '54B', 13, 'approval', 'Kode Approval', '153', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (42, '54B', 14, 'orig_nom', 'Orig Nomor Refrensi', '164', '11');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (43, '54C', 1, 'trx_time', 'Waktu Transaksi', '0', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (44, '54C', 2, 'trx_tgl', 'Tanggal Transaksi', '10', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (45, '54C', 3, 'kode_terminal', 'Kode Terminal', '20', '17');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (46, '54C', 4, 'no_kartu', 'No Kartu', '37', '19');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (47, '54C', 5, 'jenis_message', 'Jenis Message', '56', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (48, '54C', 6, 'kode_proses', 'Kode Pemrosesan', '65', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (49, '54C', 7, 'nom_transaksi', 'Nominal Transaksi', '75', '15');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (50, '54C', 8, 'kode_kesalahan', 'Kode Kesalahan', '91', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (51, '54C', 9, 'kode_bank_iss', 'Kode Bank Issuer', '101', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (52, '54C', 10, 'no_ref', 'No Refrensi', '110', '13');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (53, '54C', 11, 'merchant_type', 'Merchant Type', '123', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (54, '54C', 12, 'kode_retail', 'Kode Retail', '132', '21');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (55, '54C', 13, 'approval', 'Kode Approval', '153', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (56, '54C', 14, 'orig_nom', 'Orig Nomor Refrensi', '164', '11');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (57, '54D', 1, 'trx_time', 'Waktu Transaksi', '0', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (58, '54D', 2, 'trx_tgl', 'Tanggal Transaksi', '10', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (59, '54D', 3, 'kode_terminal', 'Kode Terminal', '20', '17');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (60, '54D', 4, 'no_kartu', 'No Kartu', '37', '19');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (61, '54D', 5, 'jenis_message', 'Jenis Message', '56', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (62, '54D', 6, 'kode_proses', 'Kode Pemrosesan', '65', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (63, '54D', 7, 'nom_transaksi', 'Nominal Transaksi', '75', '15');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (64, '54D', 8, 'kode_kesalahan', 'Kode Kesalahan', '91', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (65, '54D', 9, 'kode_bank_iss', 'Kode Bank Issuer', '101', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (66, '54D', 10, 'no_ref', 'No Refrensi', '110', '13');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (67, '54D', 11, 'merchant_type', 'Merchant Type', '123', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (68, '54D', 12, 'kode_retail', 'Kode Retail', '132', '21');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (69, '54D', 13, 'approval', 'Kode Approval', '153', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (70, '54D', 14, 'orig_nom', 'Orig Nomor Refrensi', '164', '11');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (71, '54D', 15, 'fee_iss', 'Fee Issuer', '174', '14');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (72, '54D', 16, 'fee_switching', 'Fee Switching', '187', '14');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (73, '54D', 17, 'fee_lbg_svc', 'Fee LBG SVC', '201', '14');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (74, '54D', 18, 'fee_lbg_std', 'Fee LBG STD', '215', '14');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (75, '54D', 19, 'net_nominal', 'Net Nominal', '229', '14');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (76, '54E', 1, 'trx_time', 'Waktu Transaksi', '0', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (77, '54E', 2, 'trx_tgl', 'Tanggal Transaksi', '10', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (78, '54E', 3, 'kode_terminal', 'Kode Terminal', '20', '17');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (79, '54E', 4, 'no_kartu', 'No Kartu', '37', '19');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (80, '54E', 5, 'jenis_message', 'Jenis Message', '56', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (81, '54E', 6, 'kode_proses', 'Kode Pemrosesan', '65', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (82, '54E', 7, 'nom_transaksi', 'Nominal Transaksi', '75', '15');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (83, '54E', 8, 'kode_kesalahan', 'Kode Kesalahan', '91', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (84, '54E', 9, 'kode_bank_iss', 'Kode Bank Issuer', '101', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (85, '54E', 10, 'no_ref', 'No Refrensi', '110', '13');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (86, '54E', 11, 'merchant_type', 'Merchant Type', '123', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (87, '54E', 12, 'kode_retail', 'Kode Retail', '132', '21');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (88, '54E', 13, 'approval', 'Kode Approval', '153', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (89, '54E', 14, 'orig_nom', 'Orig Nomor Refrensi', '164', '11');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (90, '54F', 1, 'trx_time', 'Waktu Transaksi', '0', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (91, '54F', 2, 'trx_tgl', 'Tanggal Transaksi', '10', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (92, '54F', 3, 'kode_terminal', 'Kode Terminal', '20', '17');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (93, '54F', 4, 'no_kartu', 'No Kartu', '37', '19');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (94, '54F', 5, 'jenis_message', 'Jenis Message', '56', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (95, '54F', 6, 'kode_proses', 'Kode Pemrosesan', '65', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (96, '54F', 7, 'nom_transaksi', 'Nominal Transaksi', '75', '15');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (97, '54F', 8, 'kode_kesalahan', 'Kode Kesalahan', '91', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (98, '54F', 9, 'kode_bank_iss', 'Kode Bank Issuer', '101', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (99, '54F', 10, 'no_ref', 'No Refrensi', '110', '13');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (100, '54F', 11, 'merchant_type', 'Merchant Type', '123', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (101, '54F', 12, 'kode_retail', 'Kode Retail', '132', '21');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (102, '54F', 13, 'approval', 'Kode Approval', '153', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (103, '54F', 14, 'orig_nom', 'Orig Nomor Refrensi', '164', '11');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (104, '56', 1, 'trx_time', 'Waktu Transaksi', '0', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (105, '56', 2, 'trx_tgl', 'Tanggal Transaksi', '10', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (106, '56', 3, 'kode_terminal', 'Kode Terminal', '20', '17');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (107, '56', 4, 'no_kartu', 'No Kartu', '37', '19');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (108, '56', 5, 'jenis_message', 'Jenis Message', '56', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (109, '56', 6, 'kode_proses', 'Kode Pemrosesan', '65', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (110, '56', 7, 'nom_transaksi', 'Nominal Transaksi', '75', '15');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (111, '56', 8, 'kode_kesalahan', 'Kode Kesalahan', '91', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (112, '56', 9, 'kode_bank_acq', 'Kode Bank Acquirer', '101', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (113, '56', 10, 'no_ref', 'No Refrensi', '110', '13');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (114, '56', 11, 'merchant_type', 'Merchant Type', '123', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (115, '56', 12, 'kode_retail', 'Kode Retail', '132', '21');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (116, '56', 13, 'approval', 'Kode Approval', '153', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (117, '56', 14, 'orig_nom', 'Orig Nomor Refrensi', '164', '11');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (118, '56A', 1, 'trx_time', 'Waktu Transaksi', '0', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (119, '56A', 2, 'trx_tgl', 'Tanggal Transaksi', '10', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (120, '56A', 3, 'kode_terminal', 'Kode Terminal', '20', '17');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (121, '56A', 4, 'no_kartu', 'No Kartu', '37', '19');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (122, '56A', 5, 'jenis_message', 'Jenis Message', '56', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (123, '56A', 6, 'kode_proses', 'Kode Pemrosesan', '65', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (124, '56A', 7, 'nom_transaksi', 'Nominal Transaksi', '75', '15');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (125, '56A', 8, 'kode_kesalahan', 'Kode Kesalahan', '91', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (126, '56A', 9, 'kode_bank_acq', 'Kode Bank Acquirer', '101', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (127, '56A', 10, 'no_ref', 'No Refrensi', '110', '13');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (128, '56A', 11, 'merchant_type', 'Merchant Type', '123', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (129, '56A', 12, 'kode_retail', 'Kode Retail', '132', '21');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (130, '56A', 13, 'approval', 'Kode Approval', '153', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (131, '56A', 14, 'orig_nom', 'Orig Nomor Refrensi', '164', '11');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (132, '56B', 1, 'trx_time', 'Waktu Transaksi', '0', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (133, '56B', 2, 'trx_tgl', 'Tanggal Transaksi', '10', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (134, '56B', 3, 'kode_terminal', 'Kode Terminal', '20', '17');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (135, '56B', 4, 'no_kartu', 'No Kartu', '37', '19');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (136, '56B', 5, 'jenis_message', 'Jenis Message', '56', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (137, '56B', 6, 'kode_proses', 'Kode Pemrosesan', '65', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (138, '56B', 7, 'nom_transaksi', 'Nominal Transaksi', '75', '15');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (139, '56B', 8, 'kode_kesalahan', 'Kode Kesalahan', '91', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (140, '56B', 9, 'kode_bank_acq', 'Kode Bank Acquirer', '101', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (141, '56B', 10, 'no_ref', 'No Refrensi', '110', '13');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (142, '56B', 11, 'merchant_type', 'Merchant Type', '123', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (143, '56B', 12, 'kode_retail', 'Kode Retail', '132', '21');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (144, '56B', 13, 'approval', 'Kode Approval', '153', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (145, '56B', 14, 'orig_nom', 'Orig Nomor Refrensi', '164', '11');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (146, '56C', 1, 'trx_time', 'Waktu Transaksi', '0', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (147, '56C', 2, 'trx_tgl', 'Tanggal Transaksi', '10', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (148, '56C', 3, 'kode_terminal', 'Kode Terminal', '20', '17');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (149, '56C', 4, 'no_kartu', 'No Kartu', '37', '19');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (150, '56C', 5, 'jenis_message', 'Jenis Message', '56', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (151, '56C', 6, 'kode_proses', 'Kode Pemrosesan', '65', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (152, '56C', 7, 'nom_transaksi', 'Nominal Transaksi', '75', '15');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (153, '56C', 8, 'kode_kesalahan', 'Kode Kesalahan', '91', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (154, '56C', 9, 'kode_bank_acq', 'Kode Bank Acquirer', '101', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (155, '56C', 10, 'no_ref', 'No Refrensi', '110', '13');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (156, '56C', 11, 'merchant_type', 'Merchant Type', '123', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (157, '56C', 12, 'kode_retail', 'Kode Retail', '132', '21');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (158, '56C', 13, 'approval', 'Kode Approval', '153', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (159, '56C', 14, 'orig_nom', 'Orig Nomor Refrensi', '164', '11');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (160, '56D', 1, 'trx_time', 'Waktu Transaksi', '0', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (161, '56D', 2, 'trx_tgl', 'Tanggal Transaksi', '10', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (162, '56D', 3, 'kode_terminal', 'Kode Terminal', '20', '17');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (163, '56D', 4, 'no_kartu', 'No Kartu', '37', '19');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (164, '56D', 5, 'jenis_message', 'Jenis Message', '56', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (165, '56D', 6, 'kode_proses', 'Kode Pemrosesan', '65', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (166, '56D', 7, 'nom_transaksi', 'Nominal Transaksi', '75', '15');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (167, '56D', 8, 'kode_kesalahan', 'Kode Kesalahan', '91', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (168, '56D', 9, 'kode_bank_acq', 'Kode Bank Acquirer', '101', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (169, '56D', 10, 'no_ref', 'No Refrensi', '110', '13');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (170, '56D', 11, 'merchant_type', 'Merchant Type', '123', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (171, '56D', 12, 'kode_retail', 'Kode Retail', '132', '21');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (172, '56D', 13, 'approval', 'Kode Approval', '153', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (173, '56D', 14, 'orig_nom', 'Orig Nomor Refrensi', '164', '11');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (174, '56D', 15, 'fee_iss', 'Fee Issuer', '174', '14');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (175, '56D', 16, 'fee_switching', 'Fee Switching', '187', '14');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (176, '56D', 17, 'fee_lbg_svc', 'Fee LBG SVC', '201', '14');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (177, '56D', 18, 'fee_lbg_std', 'Fee LBG STD', '215', '14');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (178, '56D', 19, 'net_nominal', 'Net Nominal', '229', '14');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (179, '56F', 1, 'trx_time', 'Waktu Transaksi', '0', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (180, '56F', 2, 'trx_tgl', 'Tanggal Transaksi', '10', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (181, '56F', 3, 'kode_terminal', 'Kode Terminal', '20', '17');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (182, '56F', 4, 'no_kartu', 'No Kartu', '37', '19');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (183, '56F', 5, 'jenis_message', 'Jenis Message', '56', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (184, '56F', 6, 'kode_proses', 'Kode Pemrosesan', '65', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (185, '56F', 7, 'nom_transaksi', 'Nominal Transaksi', '75', '15');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (186, '56F', 8, 'kode_kesalahan', 'Kode Kesalahan', '91', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (187, '56F', 9, 'kode_bank_acq', 'Kode Bank Acquirer', '101', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (188, '56F', 10, 'no_ref', 'No Refrensi', '110', '13');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (189, '56F', 11, 'merchant_type', 'Merchant Type', '123', '9');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (190, '56F', 12, 'kode_retail', 'Kode Retail', '132', '21');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (191, '56F', 13, 'approval', 'Kode Approval', '153', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (192, '56F', 14, 'orig_nom', 'Orig Nomor Refrensi', '164', '11');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (193, 'Core', 1, 'cabang', 'Cabang', '9', '3');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (194, 'Core', 2, 'acq', 'Acquirer', '13', '8');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (195, 'Core', 3, 'iss', 'Issuer', '22', '8');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (196, 'Core', 4, 'destination', 'Destination', '34', '11');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (197, 'Core', 5, 'terminal', 'Terminal', '47', '8');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (198, 'Core', 6, 'produk', 'Produk', '56', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (199, 'Core', 7, 'io', 'I/O', '63', '2');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (200, 'Core', 8, 'msg', 'MSG', '67', '4');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (201, 'Core', 9, 'proses', 'Proses', '72', '6');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (202, 'Core', 10, 'trx_tgl', 'Tanggal', '79', '10');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (203, 'Core', 11, 'no_kartu', 'No Kartu', '90', '17');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (204, 'Core', 12, 'no_rek_db', 'No Rek DB', '108', '15');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (205, 'Core', 13, 'no_rek_cr', 'No Rek CR', '126', '15');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (206, 'Core', 14, 'nilai_transaksi', 'Nilai Transaksi', '145', '16');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (207, 'Core', 15, 'nilai_replace_rev', 'Nilai Replace Rev', '163', '18');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (208, 'Core', 16, 'hist_post', 'Hist Post', '188', '4');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (209, 'Core', 17, 'rec_num', 'Rec Num', '194', '12');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (210, 'DSPT01', 1, 'trx_code', 'Trx code', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (211, 'DSPT01', 2, 'trx_tgl', 'Tanggal Trx', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (212, 'DSPT01', 3, 'trx_time', 'Jam Trx', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (213, 'DSPT01', 4, 'ref_no', 'Ref No', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (214, 'DSPT01', 5, 'trace_no', 'Trace No', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (215, 'DSPT01', 6, 'term_id', 'Term ID', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (216, 'DSPT01', 7, 'no_kartu', 'No Kartu', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (217, 'DSPT01', 8, 'kode_iss', 'Kode ISS', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (218, 'DSPT01', 9, 'kode_acq', 'Kode ACQ', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (219, 'DSPT01', 10, 'marchant_id', 'MerchantID', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (220, 'DSPT01', 11, 'merchant_type', 'Merchant Type', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (221, 'DSPT01', 12, 'marchant_location', 'Merchant Location', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (222, 'DSPT01', 13, 'marchant_name', 'Merchant Name', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (223, 'DSPT01', 14, 'marchant_code', 'Nominal Merchant Code', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (224, 'DSPT01', 15, 'dispute_trans_code', 'Dispute Trans Code', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (225, 'DSPT01', 16, 'dispute_amount', 'Dispute Amount', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (226, 'DSPT01', 17, 'charge_back_fee', 'Chargeback Fee', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (227, 'DSPT01', 18, 'fee_return', 'Fee Return', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (228, 'DSPT01', 19, 'dispute_net_amount', 'Dispute Net Amount', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (229, 'DSPT02', 1, 'trx_code', 'Trx code', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (230, 'DSPT02', 2, 'trx_tgl', 'Tanggal Trx', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (231, 'DSPT02', 3, 'trx_time', 'Jam Trx', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (232, 'DSPT02', 4, 'ref_no', 'Ref No', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (233, 'DSPT02', 5, 'trace_no', 'Trace No', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (234, 'DSPT02', 6, 'term_id', 'Term ID', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (235, 'DSPT02', 7, 'no_kartu', 'No Kartu', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (236, 'DSPT02', 8, 'kode_iss', 'Kode ISS', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (237, 'DSPT02', 9, 'kode_acq', 'Kode ACQ', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (238, 'DSPT02', 10, 'marchant_id', 'MerchantID', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (239, 'DSPT02', 11, 'merchant_type', 'Merchant Type', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (240, 'DSPT02', 12, 'marchant_location', 'Merchant Location', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (241, 'DSPT02', 13, 'marchant_name', 'Merchant Name', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (242, 'DSPT02', 14, 'marchant_code', 'Nominal Merchant Code', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (243, 'DSPT02', 15, 'dispute_trans_code', 'Dispute Trans Code', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (244, 'DSPT02', 16, 'dispute_amount', 'Dispute Amount', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (245, 'DSPT02', 17, 'charge_back_fee', 'Chargeback Fee', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (246, 'DSPT02', 18, 'fee_return', 'Fee Return', '0', '0');
INSERT INTO `config_file_details` (`id`, `code_trans`, `sort`, `field_name`, `name`, `start_at`, `length`) VALUES (247, 'DSPT02', 19, 'dispute_net_amount', 'Dispute Net Amount', '0', '0');
COMMIT;

-- ----------------------------
-- Table structure for config_files
-- ----------------------------
DROP TABLE IF EXISTS `config_files`;
CREATE TABLE `config_files` (
  `code_trans` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`code_trans`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of config_files
-- ----------------------------
BEGIN;
INSERT INTO `config_files` (`code_trans`, `file_name`) VALUES ('54', 'Jalin Harian');
INSERT INTO `config_files` (`code_trans`, `file_name`) VALUES ('54A', 'Jalin Harian');
INSERT INTO `config_files` (`code_trans`, `file_name`) VALUES ('54B', 'Jalin Harian');
INSERT INTO `config_files` (`code_trans`, `file_name`) VALUES ('54C', 'Jalin Harian');
INSERT INTO `config_files` (`code_trans`, `file_name`) VALUES ('54D', 'Jalin Harian');
INSERT INTO `config_files` (`code_trans`, `file_name`) VALUES ('54E', 'Jalin Harian');
INSERT INTO `config_files` (`code_trans`, `file_name`) VALUES ('54F', 'Jalin Harian');
INSERT INTO `config_files` (`code_trans`, `file_name`) VALUES ('56', 'Jalin Harian');
INSERT INTO `config_files` (`code_trans`, `file_name`) VALUES ('56A', 'Jalin Harian');
INSERT INTO `config_files` (`code_trans`, `file_name`) VALUES ('56B', 'Jalin Harian');
INSERT INTO `config_files` (`code_trans`, `file_name`) VALUES ('56C', 'Jalin Harian');
INSERT INTO `config_files` (`code_trans`, `file_name`) VALUES ('56D', 'Jalin Harian');
INSERT INTO `config_files` (`code_trans`, `file_name`) VALUES ('56E', 'Jalin Harian');
INSERT INTO `config_files` (`code_trans`, `file_name`) VALUES ('56F', 'Jalin Harian');
INSERT INTO `config_files` (`code_trans`, `file_name`) VALUES ('Core', 'Core');
INSERT INTO `config_files` (`code_trans`, `file_name`) VALUES ('DSPT01', 'Jalin Klaim');
INSERT INTO `config_files` (`code_trans`, `file_name`) VALUES ('DSPT02', 'Jalin Klaim');
COMMIT;

-- ----------------------------
-- Table structure for cores
-- ----------------------------
DROP TABLE IF EXISTS `cores`;
CREATE TABLE `cores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `upload_file_document_id` bigint unsigned NOT NULL,
  `tgl` date NOT NULL,
  `cabang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acq` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iss` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terminal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `produk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `io` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `msg` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proses` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx_tgl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_kartu` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_rek_db` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_rek_cr` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_transaksi` decimal(15,2) NOT NULL DEFAULT '0.00',
  `nilai_replace_rev` decimal(15,2) DEFAULT NULL,
  `hist_post` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rec_num` decimal(15,2) DEFAULT NULL,
  `rekap_bruto` enum('normal','hold','clear') COLLATE utf8mb4_unicode_ci DEFAULT 'normal',
  PRIMARY KEY (`id`),
  KEY `cores_upload_file_document_id_foreign` (`upload_file_document_id`),
  CONSTRAINT `cores_upload_file_document_id_foreign` FOREIGN KEY (`upload_file_document_id`) REFERENCES `upload_file_documents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2319 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cores
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for jalin_harian
-- ----------------------------
DROP TABLE IF EXISTS `jalin_harian`;
CREATE TABLE `jalin_harian` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `upload_file_document_id` bigint unsigned NOT NULL,
  `tgl` date NOT NULL,
  `kode_report` enum('54','54A','54B','54C','54D','54E','54F','56','56A','56B','56C','56D','56E','56F') COLLATE utf8mb4_unicode_ci NOT NULL,
  `trx_time` time NOT NULL,
  `trx_tgl` date NOT NULL,
  `kode_terminal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kartu` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_message` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_proses` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_transaksi` decimal(20,2) NOT NULL,
  `kode_kesalahan` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_bank_iss` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_bank_acq` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_ref` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merchant_type` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_retail` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orig_nom` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee_iss` decimal(20,2) DEFAULT NULL,
  `fee_switching` decimal(20,2) DEFAULT NULL,
  `fee_lbg_svc` decimal(20,2) DEFAULT NULL,
  `fee_lbg_std` decimal(20,2) DEFAULT NULL,
  `net_nominal` decimal(20,2) DEFAULT NULL,
  `rekap_bruto` enum('normal','hold','clear') COLLATE utf8mb4_unicode_ci DEFAULT 'normal',
  `rekap_netto` enum('normal','hold','clear') COLLATE utf8mb4_unicode_ci DEFAULT 'normal',
  PRIMARY KEY (`id`),
  KEY `jalin_harian_upload_file_document_id_foreign` (`upload_file_document_id`),
  CONSTRAINT `jalin_harian_upload_file_document_id_foreign` FOREIGN KEY (`upload_file_document_id`) REFERENCES `upload_file_documents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=549 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jalin_harian
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for jalin_klaim
-- ----------------------------
DROP TABLE IF EXISTS `jalin_klaim`;
CREATE TABLE `jalin_klaim` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `upload_file_document_id` bigint unsigned NOT NULL,
  `tgl` date NOT NULL,
  `jenis` enum('acq','iss') COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_report` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trx_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trx_tgl` date NOT NULL,
  `trx_time` time NOT NULL,
  `ref_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trace_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `term_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kartu` decimal(50,0) NOT NULL,
  `kode_iss` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_acq` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marchant_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marchant_location` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marchant_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` decimal(20,2) NOT NULL,
  `marchant_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dispute_trans_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_num` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dispute_amount` decimal(20,2) NOT NULL,
  `charge_back_fee` decimal(20,2) NOT NULL,
  `fee_return` decimal(20,2) NOT NULL,
  `dispute_net_amount` decimal(20,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jalin_klaim_upload_file_document_id_foreign` (`upload_file_document_id`),
  CONSTRAINT `jalin_klaim_upload_file_document_id_foreign` FOREIGN KEY (`upload_file_document_id`) REFERENCES `upload_file_documents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jalin_klaim
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for jalin_rekaps
-- ----------------------------
DROP TABLE IF EXISTS `jalin_rekaps`;
CREATE TABLE `jalin_rekaps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `upload_file_document_id` bigint unsigned NOT NULL,
  `tgl` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acq_jml_trx_purchase` int NOT NULL,
  `acq_acq_switch_purchase` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'A',
  `acq_iss_switch_purchase` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'B',
  `acq_iss_purchase` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'C',
  `acq_lbg_standard_purchase` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'D',
  `acq_lbg_service_purchase` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'E',
  `acq_total_fee_purchase` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'F',
  `acq_total_nominal_transaksi_purchase` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'G',
  `acq_jml_trx_refund` decimal(20,2) NOT NULL DEFAULT '0.00',
  `acq_fee_iss_refund` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'H',
  `acq_total_nominal_transaksi_refund` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'I',
  `iss_jml_trx_purchase` decimal(20,2) NOT NULL DEFAULT '0.00',
  `iss_fee_iss_purchase` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'J',
  `iss_total_nominal_transaksi_purchase` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'K',
  `iss_jml_trx_refund` decimal(20,2) NOT NULL DEFAULT '0.00',
  `iss_fee_iss_refund` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'L',
  `iss_total_nominal_transaksi_refund` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'M',
  `subtotal_gross_kewajiban` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'N',
  `subtotal_gross_hak` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'O',
  `acq_kewajiban_dispute` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'P',
  `acq_hak_dispute` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'Q',
  `iss_kewajiban_dispute` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'R',
  `iss_hak_dispute` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'S',
  `subtotal_gross_kewajiban_t` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'T',
  `subtotal_gross_hak_u` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'U',
  `total_gross_kewajiban_v` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'V',
  `total_gross_hak_w` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'W',
  `total_net_kewajiban` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'X',
  `total_net_hak` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT 'Y',
  PRIMARY KEY (`id`),
  KEY `jalin_rekaps_upload_file_document_id_foreign` (`upload_file_document_id`),
  CONSTRAINT `jalin_rekaps_upload_file_document_id_foreign` FOREIGN KEY (`upload_file_document_id`) REFERENCES `upload_file_documents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jalin_rekaps
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for menu_manager_role
-- ----------------------------
DROP TABLE IF EXISTS `menu_manager_role`;
CREATE TABLE `menu_manager_role` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_manager_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_manager_role_menu_manager_id_foreign` (`menu_manager_id`),
  KEY `menu_manager_role_role_id_foreign` (`role_id`),
  CONSTRAINT `menu_manager_role_menu_manager_id_foreign` FOREIGN KEY (`menu_manager_id`) REFERENCES `menu_managers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menu_manager_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of menu_manager_role
-- ----------------------------
BEGIN;
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (170, 5, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (171, 4, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (172, 2, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (173, 3, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (174, 12, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (175, 13, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (176, 14, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (177, 18, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (178, 15, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (179, 32, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (180, 31, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (181, 19, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (182, 20, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (183, 25, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (184, 22, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (185, 24, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (186, 29, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (187, 28, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (188, 8, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (189, 9, 1);
INSERT INTO `menu_manager_role` (`id`, `menu_manager_id`, `role_id`) VALUES (190, 10, 1);
COMMIT;

-- ----------------------------
-- Table structure for menu_managers
-- ----------------------------
DROP TABLE IF EXISTS `menu_managers`;
CREATE TABLE `menu_managers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` tinyint NOT NULL DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('module','header','line','static') COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_managers_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of menu_managers
-- ----------------------------
BEGIN;
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (2, 26, 'Bank', 'bank', '/backend/bank', NULL, 'module', NULL, 3);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (3, 26, 'Tanda Tangan', 'signature', '/backend/signature', NULL, 'module', NULL, 4);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (4, 26, 'Roles', 'roles', '/backend/roles', NULL, 'module', NULL, 2);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (5, 26, 'Pengguna Aplikasi', 'users', '/backend/users', NULL, 'module', NULL, 1);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (8, 27, 'Menu Manager', 'menu-manager', '/backend/menu-manager', 'fa-duotone fa-sitemap', 'module', NULL, 1);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (9, 27, 'Config Dokumen', 'config-file', '/backend/config-file', 'fa-duotone fa-gears', 'module', NULL, 2);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (10, 27, 'Logo', 'settings-logo', '/backend/settings-logo', 'fa-duotone fa-image', 'module', NULL, 3);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (11, 0, 'File', NULL, NULL, 'fa-duotone fa-folder-open', 'static', NULL, 2);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (12, 11, 'Upload Jalin Harian', 'upload-jalin-harian', '/backend/upload-jalin-harian', NULL, 'module', NULL, 1);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (13, 11, 'Upload Jalin Klaim', 'upload-jalin-klaim', '/backend/upload-jalin-klaim', NULL, 'module', NULL, 2);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (14, 11, 'Upload Jalin Rekapitulasi', 'upload-jalin-rekap', '/backend/upload-jalin-rekap', NULL, 'module', NULL, 3);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (15, 17, 'Jalin Harian', 'jalin-harian', '/backend/jalin-harian', NULL, 'module', NULL, 1);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (17, 0, 'Data', NULL, NULL, 'fa-duotone fa-files', 'static', NULL, 3);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (18, 11, 'Upload Core', 'upload-core', '/backend/upload-core', NULL, 'module', NULL, 4);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (19, 17, 'Core', 'core', '/backend/core', NULL, 'module', NULL, 4);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (20, 21, 'Rekap Bruto', 'rekap-bruto', '/backend/rekap-bruto', NULL, 'module', NULL, 1);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (21, 0, 'Rekap', NULL, NULL, 'fa-duotone fa-cubes', 'static', NULL, 4);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (22, 23, 'Bruto Jalin', 'penampungan-bruto-jalin', '/backend/penampungan-bruto-jalin', NULL, 'module', NULL, 1);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (23, 0, 'Penampungan', NULL, NULL, 'fa-duotone fa-trash-can-clock', 'static', NULL, 5);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (24, 23, 'Bruto Core', 'penampungan-bruto-core', '/backend/penampungan-bruto-core', NULL, 'module', NULL, 2);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (25, 21, 'Rekap Netto', 'rekap-netto', '/backend/rekap-netto', NULL, 'module', NULL, 2);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (26, 0, 'Master Data', NULL, NULL, 'fa-duotone fa-database', 'static', NULL, 1);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (27, 0, 'Pengaturan', NULL, NULL, 'fa-duotone fa-gears', 'static', NULL, 6);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (28, 23, 'Netto Rekap', 'penampungan-netto-rekap', '/backend/penampungan-netto-rekap', NULL, 'module', NULL, 4);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (29, 23, 'Netto Jalin', 'penampungan-netto-jalin', '/backend/penampungan-netto-jalin', NULL, 'module', NULL, 3);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (31, 17, 'Jalin Rekapitulasi', 'jalin-rekap', '/backend/jalin-rekap', NULL, 'module', NULL, 3);
INSERT INTO `menu_managers` (`id`, `parent_id`, `title`, `slug`, `path_url`, `icon`, `type`, `position`, `sort`) VALUES (32, 17, 'Jalin Klaim', 'jalin-klaim', '/backend/jalin-klaim', NULL, 'module', NULL, 2);
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '2013_08_19_080120_create_roles_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6, '2021_10_07_130202_create_menu_managers_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7, '2021_11_19_115145_create_permissions_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8, '2021_11_19_115611_create_permission_role_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9, '2022_04_01_070620_create_app_settings_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10, '2022_08_20_052305_create_menu_manager_role_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11, '2022_09_06_012850_create_sessions_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12, '2022_10_31_164311_create_settings_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13, '2022_11_29_132847_create_banks_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (14, '2022_11_29_133001_create_signatures_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (15, '2022_11_29_133322_create_upload_file_documents_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (16, '2022_11_29_133434_create_jalin_harians_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (27, '2022_12_01_104343_create_config_files_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (28, '2022_12_01_104535_create_config_file_details_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (29, '2022_12_05_002122_create_jalin_klaims_table', 3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (30, '2022_12_05_002213_create_jalin_rekapitulasis_table', 3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (31, '2022_12_06_120531_create_cores_table', 3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (35, '2022_12_09_161653_create_rekap_brutos_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (36, '2023_02_02_104722_create_rekap_nettos_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (37, '2023_02_03_110806_create_jalin_rekaps_table', 5);
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=629 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
BEGIN;
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (545, 13, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (546, 14, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (547, 15, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (548, 16, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (549, 9, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (550, 10, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (551, 11, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (552, 12, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (553, 1, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (554, 2, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (555, 3, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (556, 4, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (557, 5, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (558, 6, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (559, 7, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (560, 8, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (561, 29, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (562, 30, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (563, 31, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (564, 32, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (565, 33, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (566, 34, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (567, 35, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (568, 36, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (569, 37, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (570, 38, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (571, 39, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (572, 40, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (573, 45, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (574, 46, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (575, 47, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (576, 48, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (577, 41, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (578, 42, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (579, 43, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (580, 44, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (581, 81, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (582, 82, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (583, 83, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (584, 84, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (585, 77, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (586, 78, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (587, 79, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (588, 80, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (589, 49, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (590, 50, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (591, 51, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (592, 52, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (593, 53, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (594, 54, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (595, 55, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (596, 56, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (597, 65, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (598, 66, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (599, 67, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (600, 68, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (601, 57, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (602, 58, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (603, 59, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (604, 60, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (605, 61, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (606, 62, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (607, 63, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (608, 64, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (609, 73, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (610, 74, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (611, 75, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (612, 76, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (613, 69, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (614, 70, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (615, 71, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (616, 72, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (617, 17, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (618, 18, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (619, 19, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (620, 20, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (621, 21, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (622, 22, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (623, 23, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (624, 24, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (625, 25, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (626, 26, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (627, 27, 1);
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES (628, 28, 1);
COMMIT;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_manager_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`),
  KEY `permissions_menu_manager_id_foreign` (`menu_manager_id`),
  CONSTRAINT `permissions_menu_manager_id_foreign` FOREIGN KEY (`menu_manager_id`) REFERENCES `menu_managers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
BEGIN;
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (1, 2, 'Bank List', 'bank-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (2, 2, 'Bank Create', 'bank-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (3, 2, 'Bank Edit', 'bank-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (4, 2, 'Bank Delete', 'bank-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (5, 3, 'Tanda Tangan List', 'signature-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (6, 3, 'Tanda Tangan Create', 'signature-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (7, 3, 'Tanda Tangan Edit', 'signature-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (8, 3, 'Tanda Tangan Delete', 'signature-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (9, 4, 'Roles List', 'roles-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (10, 4, 'Roles Create', 'roles-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (11, 4, 'Roles Edit', 'roles-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (12, 4, 'Roles Delete', 'roles-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (13, 5, 'Pengguna Aplikasi List', 'users-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (14, 5, 'Pengguna Aplikasi Create', 'users-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (15, 5, 'Pengguna Aplikasi Edit', 'users-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (16, 5, 'Pengguna Aplikasi Delete', 'users-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (17, 8, 'Menu Manager List', 'menu-manager-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (18, 8, 'Menu Manager Create', 'menu-manager-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (19, 8, 'Menu Manager Edit', 'menu-manager-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (20, 8, 'Menu Manager Delete', 'menu-manager-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (21, 9, 'Config Dokumen List', 'config-file-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (22, 9, 'Config Dokumen Create', 'config-file-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (23, 9, 'Config Dokumen Edit', 'config-file-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (24, 9, 'Config Dokumen Delete', 'config-file-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (25, 10, 'Logo List', 'settings-logo-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (26, 10, 'Logo Create', 'settings-logo-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (27, 10, 'Logo Edit', 'settings-logo-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (28, 10, 'Logo Delete', 'settings-logo-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (29, 12, 'Upload Jalin Harian List', 'upload-jalin-harian-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (30, 12, 'Upload Jalin Harian Create', 'upload-jalin-harian-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (31, 12, 'Upload Jalin Harian Edit', 'upload-jalin-harian-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (32, 12, 'Upload Jalin Harian Delete', 'upload-jalin-harian-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (33, 13, 'Upload Jalin Klaim List', 'upload-jalin-klaim-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (34, 13, 'Upload Jalin Klaim Create', 'upload-jalin-klaim-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (35, 13, 'Upload Jalin Klaim Edit', 'upload-jalin-klaim-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (36, 13, 'Upload Jalin Klaim Delete', 'upload-jalin-klaim-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (37, 14, 'Upload Jalin Rekapitulasi List', 'upload-jalin-rekap-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (38, 14, 'Upload Jalin Rekapitulasi Create', 'upload-jalin-rekap-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (39, 14, 'Upload Jalin Rekapitulasi Edit', 'upload-jalin-rekap-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (40, 14, 'Upload Jalin Rekapitulasi Delete', 'upload-jalin-rekap-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (41, 15, 'Jalin Harian List', 'jalin-harian-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (42, 15, 'Jalin Harian Create', 'jalin-harian-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (43, 15, 'Jalin Harian Edit', 'jalin-harian-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (44, 15, 'Jalin Harian Delete', 'jalin-harian-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (45, 18, 'Upload Core List', 'upload-core-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (46, 18, 'Upload Core Create', 'upload-core-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (47, 18, 'Upload Core Edit', 'upload-core-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (48, 18, 'Upload Core Delete', 'upload-core-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (49, 19, 'Core List', 'core-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (50, 19, 'Core Create', 'core-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (51, 19, 'Core Edit', 'core-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (52, 19, 'Core Delete', 'core-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (53, 20, 'Rekap Bruto List', 'rekap-bruto-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (54, 20, 'Rekap Bruto Create', 'rekap-bruto-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (55, 20, 'Rekap Bruto Edit', 'rekap-bruto-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (56, 20, 'Rekap Bruto Delete', 'rekap-bruto-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (57, 22, 'Bruto Jalin List', 'penampungan-bruto-jalin-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (58, 22, 'Bruto Jalin Create', 'penampungan-bruto-jalin-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (59, 22, 'Bruto Jalin Edit', 'penampungan-bruto-jalin-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (60, 22, 'Bruto Jalin Delete', 'penampungan-bruto-jalin-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (61, 24, 'Bruto Core List', 'penampungan-bruto-core-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (62, 24, 'Bruto Core Create', 'penampungan-bruto-core-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (63, 24, 'Bruto Core Edit', 'penampungan-bruto-core-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (64, 24, 'Bruto Core Delete', 'penampungan-bruto-core-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (65, 25, 'Rekap Netto List', 'rekap-netto-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (66, 25, 'Rekap Netto Create', 'rekap-netto-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (67, 25, 'Rekap Netto Edit', 'rekap-netto-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (68, 25, 'Rekap Netto Delete', 'rekap-netto-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (69, 28, 'Netto Rekap List', 'penampungan-netto-rekap-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (70, 28, 'Netto Rekap Create', 'penampungan-netto-rekap-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (71, 28, 'Netto Rekap Edit', 'penampungan-netto-rekap-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (72, 28, 'Netto Rekap Delete', 'penampungan-netto-rekap-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (73, 29, 'Netto Jalin List', 'penampungan-netto-jalin-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (74, 29, 'Netto Jalin Create', 'penampungan-netto-jalin-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (75, 29, 'Netto Jalin Edit', 'penampungan-netto-jalin-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (76, 29, 'Netto Jalin Delete', 'penampungan-netto-jalin-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (77, 31, 'Jalin Rekapitulasi List', 'jalin-rekap-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (78, 31, 'Jalin Rekapitulasi Create', 'jalin-rekap-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (79, 31, 'Jalin Rekapitulasi Edit', 'jalin-rekap-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (80, 31, 'Jalin Rekapitulasi Delete', 'jalin-rekap-delete');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (81, 32, 'Jalin Klaim List', 'jalin-klaim-list');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (82, 32, 'Jalin Klaim Create', 'jalin-klaim-create');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (83, 32, 'Jalin Klaim Edit', 'jalin-klaim-edit');
INSERT INTO `permissions` (`id`, `menu_manager_id`, `name`, `slug`) VALUES (84, 32, 'Jalin Klaim Delete', 'jalin-klaim-delete');
COMMIT;

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for rekap_brutos
-- ----------------------------
DROP TABLE IF EXISTS `rekap_brutos`;
CREATE TABLE `rekap_brutos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tgl_rekap` date NOT NULL,
  `jalin_harian_id` bigint unsigned NOT NULL,
  `core_id` bigint unsigned NOT NULL,
  `rekap_netto` enum('normal','hold','clear') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  PRIMARY KEY (`id`),
  KEY `rekap_brutos_jalin_harian_id_foreign` (`jalin_harian_id`),
  KEY `rekap_brutos_core_id_foreign` (`core_id`),
  CONSTRAINT `rekap_brutos_core_id_foreign` FOREIGN KEY (`core_id`) REFERENCES `cores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rekap_brutos_jalin_harian_id_foreign` FOREIGN KEY (`jalin_harian_id`) REFERENCES `jalin_harian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of rekap_brutos
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for rekap_nettos
-- ----------------------------
DROP TABLE IF EXISTS `rekap_nettos`;
CREATE TABLE `rekap_nettos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tgl_rekap` date NOT NULL,
  `rekap_bruto_id` bigint unsigned NOT NULL,
  `jalin_harian_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rekap_nettos_rekap_bruto_id_foreign` (`rekap_bruto_id`),
  KEY `rekap_nettos_jalin_harian_id_foreign` (`jalin_harian_id`),
  CONSTRAINT `rekap_nettos_jalin_harian_id_foreign` FOREIGN KEY (`jalin_harian_id`) REFERENCES `jalin_harian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rekap_nettos_rekap_bruto_id_foreign` FOREIGN KEY (`rekap_bruto_id`) REFERENCES `rekap_brutos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=894 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of rekap_nettos
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dashboard_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` (`id`, `name`, `slug`, `dashboard_url`) VALUES (1, 'Super Admin', 'super-admin', '/backend/dashboard');
COMMIT;

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of sessions
-- ----------------------------
BEGIN;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('pKHqxdAByKs6HEphNQoUUpEH8jg9sdK65mrImRGy', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYldRYkNQY1U2VkttclNVeXFFSER6RmVvcXg2Z29MUnk5ZkNKRVZqbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9iYWNrZW5kL3VwbG9hZC1jb3JlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1676345663);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('QIEWuFsirYCRg9bqbCX7FRjwnTL511NMifEeLNwM', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTk5SSnNLckhYSERZdG04RWV4T0VMbklJY3dKRXNXdTJqYjRXcGFiQSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9iYWNrZW5kL2NvcmUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1676260904);
COMMIT;

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of settings
-- ----------------------------
BEGIN;
INSERT INTO `settings` (`name`, `value`) VALUES ('logo', 'logo.png');
INSERT INTO `settings` (`name`, `value`) VALUES ('title_side', 'Bank Lampung');
COMMIT;

-- ----------------------------
-- Table structure for signatures
-- ----------------------------
DROP TABLE IF EXISTS `signatures`;
CREATE TABLE `signatures` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of signatures
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for upload_file_documents
-- ----------------------------
DROP TABLE IF EXISTS `upload_file_documents`;
CREATE TABLE `upload_file_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_file` enum('jalin','xlink','core') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_laporan` enum('jalin_rekap','jalin_clearing','jalin_harian','jalin_klaim','jalin_transaksi','core') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_dokumen` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of upload_file_documents
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint unsigned DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `name`, `username`, `email`, `role_id`, `image`, `email_verified_at`, `password`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'Super Admin', 'admin', 'admin@example.com', 1, NULL, '2022-11-29 14:00:54', '$2y$10$XBZ7BuVrWSk.zjHwsyvk0u/7BfUoGNDRcKLl5WfizFETfKG6UbZVG', 1, NULL, '2022-11-29 14:00:54', '2022-11-29 14:00:54');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
