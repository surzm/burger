/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50542
 Source Host           : localhost
 Source Database       : burgers

 Target Server Type    : MySQL
 Target Server Version : 50542
 File Encoding         : utf-8

 Date: 06/07/2016 08:22:40 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `app_users`
-- ----------------------------
DROP TABLE IF EXISTS `app_users`;
CREATE TABLE `app_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C2502824F85E0677` (`username`),
  UNIQUE KEY `UNIQ_C2502824E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `app_users`
-- ----------------------------
BEGIN;
INSERT INTO `app_users` VALUES ('2', 'new1', '$2y$13$NhIZtTai8XwijVpGvNiqceH8f7Xg4B4W5JNkTlqKUEYIwWjwdlmlm', 'mari@gmail.com', '1', '0', null), ('3', 'fartuk', '$2y$13$vM/Gj/7y0fpvEWg89RNksOt7/ZSjhfG21yBOJA1FIe3Cg6trvik0e', 'maggri@gmail.com', '1', '12617862', 'jsbdbsd'), ('4', 'gart', '$2y$13$bYdfB9pRXWylNS63rMOA1.26.360BAKFCuSN0gxEuBwmLZPXkNsi6', 'ansn@ahvs.ru', '1', '26523', 'bdsb'), ('5', 'admin', '$2y$13$V8Ka6bR/8iILAJmNcnmSwOCYMMNhGmTbky3l3NZfIV2/4p370gPyy', 'admin@mail.ru', '1', '789876587', 'admin street');
COMMIT;

-- ----------------------------
--  Table structure for `basket`
-- ----------------------------
DROP TABLE IF EXISTS `basket`;
CREATE TABLE `basket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) DEFAULT NULL,
  `id_session` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2246507BDD7ADDD` (`id_product`),
  CONSTRAINT `FK_2246507BDD7ADDD` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `basket`
-- ----------------------------
BEGIN;
INSERT INTO `basket` VALUES ('34', '2', '45', '1'), ('35', '1', '45', '2'), ('48', '2', 'b200a6c8ffe80f5d02573cad288c078d', '1'), ('63', '1', 'cb03a8ba380868c899457370880a5880', '1'), ('64', '2', 'd9c6164f0863cd76606a38634d68f4ba', '1'), ('70', '2', '50a5aceb12baea576adf539afe2ee5da', '1');
COMMIT;

-- ----------------------------
--  Table structure for `orders`
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone_number` int(255) NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `datetime` datetime NOT NULL,
  `status` int(11) DEFAULT NULL,
  `total_cost` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E52FFDEEA76ED395` (`user_id`),
  CONSTRAINT `FK_E52FFDEEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `orders`
-- ----------------------------
BEGIN;
INSERT INTO `orders` VALUES ('35', 'shbdhb', '17635165', 'bsdbvb', '2016-06-07 05:09:21', '0', '350', '2'), ('36', 'rotu', '12773816', 'more', '2016-06-07 05:42:17', '1', '1190', '4');
COMMIT;

-- ----------------------------
--  Table structure for `positions`
-- ----------------------------
DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) DEFAULT NULL,
  `id_order` int(11) DEFAULT NULL,
  `count` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Id_product` (`id_product`),
  KEY `id_order` (`id_order`),
  CONSTRAINT `FK_D69FE57C1BACD2A8` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`),
  CONSTRAINT `FK_D69FE57CDD7ADDD` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `positions`
-- ----------------------------
BEGIN;
INSERT INTO `positions` VALUES ('35', '1', '35', '1', '350'), ('36', '2', '36', '1', '390'), ('37', '1', '36', '1', '350'), ('38', '4', '36', '1', '450');
COMMIT;

-- ----------------------------
--  Table structure for `products`
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `products`
-- ----------------------------
BEGIN;
INSERT INTO `products` VALUES ('1', 'Бургер Монтана', '350', 'Бургер из говядины с фирменным соусом монтана, с маринованными огурчиками и помидорками ', '1'), ('2', 'Бургер Аляска', '420', 'Бургер из свенины с беконом и квашеной капустой', '1'), ('3', 'Бургер Нори', '300', 'Вегетарианский бургер с адыгейским сыром, завернутым в водоросли', '1'), ('4', 'Бургер Чичолина', '450', 'Бургер со смородиной', '1'), ('5', 'Бургер Бомбей', '300', 'Бургер с курицей', '1');
COMMIT;

-- ----------------------------
--  Table structure for `role`
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `role`
-- ----------------------------
BEGIN;
INSERT INTO `role` VALUES ('1', 'ROLE_ADMIN'), ('2', 'ROLE_USER');
COMMIT;

-- ----------------------------
--  Table structure for `user_role`
-- ----------------------------
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_2DE8C6A3A76ED395` (`user_id`),
  KEY `IDX_2DE8C6A3D60322AC` (`role_id`),
  CONSTRAINT `FK_2DE8C6A3D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
  CONSTRAINT `FK_2DE8C6A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `user_role`
-- ----------------------------
BEGIN;
INSERT INTO `user_role` VALUES ('4', '2'), ('5', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
