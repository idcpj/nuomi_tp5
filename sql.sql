#CREATE DATABASE `imooc_2o2_test`
#生活服务分类表
CREATE TABLE `o2o_category` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL DEFAULT '',
  `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `listorder` INT(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '-1 删除 0 待审 1审核',
  `craete_time` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` INT(11)  UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) ,
  KEY parent_id(`parent_id`)
)ENGINE =InnoDB AUTO_INCREMENT = 1 DEFAULT CHAR SET utf8;

#城市表
CREATE TABLE `o2o_city` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL DEFAULT '',
  `unname` VARCHAR(50) NOT NULL DEFAULT '',
  `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `listorder` INT(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '-1 删除 0 待审 1审核',
  `craete_time` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` INT(11)  UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) ,
  KEY parent_id(`parent_id`),
  UNIQUE KEY unname(`unname`)
)ENGINE =InnoDB AUTO_INCREMENT = 1 DEFAULT CHAR SET utf8;

#商圈表
CREATE TABLE `o2o_area` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL DEFAULT '',
  `city_id` INT(10) NOT NULL DEFAULT 0,
  `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `listorder` INT(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '-1 删除 0 待审 1审核',
  `craete_time` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` INT(11)  UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) ,
  KEY parent_id(`parent_id`),
  KEY city_id(`city_id`)
)ENGINE =InnoDB AUTO_INCREMENT = 1 DEFAULT CHAR SET utf8;


#商户表
CREATE TABLE `o2o_bis` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL DEFAULT '',
  `email` VARCHAR(50) NOT NULL DEFAULT '',
  `logo` VARCHAR(255) NOT NULL DEFAULT '',
  `licence_logo` VARCHAR(255) NOT NULL DEFAULT '',
  `description` TEXT NOT NULL DEFAULT '',
  `city_id` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `city_path` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'xx,xx形式',
  `bank_info` VARCHAR(50) NOT NULL DEFAULT '',
  `money` DECIMAL(20,2) NOT NULL DEFAULT 0,
  `bank_name` VARCHAR(50) NOT NULL DEFAULT '',
  `bank_user` VARCHAR(50) NOT NULL DEFAULT '',
  `faren` VARCHAR(20) NOT NULL DEFAULT '',
  `faren_tel` VARCHAR(50) NOT NULL DEFAULT '',
  `parent_id` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `listorder` INT(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '-1 删除 0 待审 1审核',
  `craete_time` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` INT(11)  UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) ,
  KEY city_id(`city_id`),
  KEY name(`name`)
)ENGINE =InnoDB AUTO_INCREMENT = 1 DEFAULT CHAR SET utf8;



#商户帐号表
CREATE TABLE `o2o_bis_account` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL DEFAULT '',
  `password` CHAR(32) NOT NULL DEFAULT '',
  `code` VARCHAR(10) NOT NULL DEFAULT '',
  `bis_id` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `last_login_ip` VARCHAR(20)  NOT NULL DEFAULT '',
  `last_login_time` INT(20)  UNSIGNED NOT NULL DEFAULT 0,
  `is_main` TINYINT(1)  UNSIGNED NOT NULL DEFAULT 0,
  `listorder` INT(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '-1 删除 0 待审 1审核',
  `craete_time` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` INT(11)  UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) ,
  KEY bis_id(`bis_id`),
  KEY username(`username`)
)ENGINE =InnoDB AUTO_INCREMENT = 1 DEFAULT CHAR SET utf8;



#商户门店表
CREATE TABLE `o2o_location` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL DEFAULT '',
  `logo` VARCHAR(255) NOT NULL DEFAULT '',
  `address` VARCHAR(255) NOT NULL DEFAULT '',
  `tel` VARCHAR(20) NOT NULL DEFAULT '',
  `contact` VARCHAR(20) NOT NULL DEFAULT '',
  `xpoint` VARCHAR(20) NOT NULL DEFAULT '',
  `ypoint` VARCHAR(20) NOT NULL DEFAULT '',
  `bis_id` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `open_time` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `content` TEXT NOT NULL DEFAULT '',
  `is_main` TINYINT(1) NOT NULL  DEFAULT 0,
  `api_address` VARCHAR(255) NOT NULL  DEFAULT '',
  `city_id` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `city_path` VARCHAR(50) NOT NULL DEFAULT '',
  `category_id` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `category_path` VARCHAR(50) NOT NULL DEFAULT '',
  `bank_info` VARCHAR(50) NOT NULL DEFAULT '',
  `listorder` INT(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '-1 删除 0 待审 1审核',
   `craete_time` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` INT(11)  UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) ,
  KEY bis_id(`bis_id`),
  KEY category_id(`category_id`),
  KEY name(`name`)
)ENGINE =InnoDB AUTO_INCREMENT = 1 DEFAULT CHAR SET utf8;

#团购商表
CREATE TABLE `o2o_deal`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL DEFAULT '',
  `category_id` INT(11) NOT NULL DEFAULT 0,
  `set_category_id` INT(11) NOT NULL DEFAULT 0,
  `bis_id` INT(11) NOT NULL DEFAULT 0,
  `location_ids` VARCHAR(100) NOT NULL DEFAULT '',
  `image` VARCHAR(200) NOT NULL DEFAULT '',
  `description` TEXT NOT NULL DEFAULT '',
  `end_time` INT(11) NOT NULL DEFAULT 0,
  `start_time` INT(11) NOT NULL DEFAULT 0,
  `origin_price` DECIMAL(20,2) NOT NULL DEFAULT 0,
  `current_price` DECIMAL(20,2) NOT NULL DEFAULT 0,
  `city_id` INT(11) NOT NULL DEFAULT 0,
  `buy_count` INT(11) NOT NULL DEFAULT 0,
  `total_count` INT(11) NOT NULL DEFAULT 0,
  `coupons_end_time` INT(11) NOT NULL DEFAULT 0,
  `coupons_begin_time` INT(11) NOT NULL DEFAULT 0,
  `xpoint` VARCHAR(20) NOT NULL DEFAULT '',
  `ypoint` VARCHAR(20) NOT NULL DEFAULT '',
  `bis_account_id` INT(10) NOT NULL DEFAULT 0,
  `balance_price` DECIMAL(20,2) NOT NULL DEFAULT 0,
  `notes` TEXT NOT NULL ,
  `listorder` INT(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '-1 删除 0 待审 1审核',
  `craete_time` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` INT(11)  UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY category_id(`category_id`),
  KEY set_category_id(`set_category_id`),
  KEY city_id(`city_id`),
  KEY start_time(`start_time`),
  KEY end_time(`end_time`)
)ENGINE =InnoDB AUTO_INCREMENT = 1 DEFAULT CHAR SET utf8;

#用户表
CREATE TABLE `o2o_user`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL DEFAULT '',
  `password` CHAR(32) NOT NULL DEFAULT '',
  `code` VARCHAR(10) NOT NULL DEFAULT '',
  `last_login_ip` VARCHAR(20)  NOT NULL DEFAULT '',
  `last_login_time` INT(20)  UNSIGNED NOT NULL DEFAULT 0,
  `email` VARCHAR(30) NOT NULL DEFAULT '',
  `mobile` VARCHAR(20) NOT NULL DEFAULT '',
  `listorder` INT(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '-1 删除 0 待审 1审核',
  `craete_time` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` INT(11)  UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) ,
  UNIQUE KEY username(`username`),
  UNIQUE KEY email(`email`)
)ENGINE =InnoDB AUTO_INCREMENT = 1 DEFAULT CHAR SET utf8;

CREATE TABLE `o2o_featured`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` TINYINT(1) NOT NULL DEFAULT 0,
  `title` VARCHAR(30) NOT NULL DEFAULT '',
  `image` VARCHAR(255) NOT NULL DEFAULT '',
  `url` VARCHAR(255) NOT NULL DEFAULT '',
  `description` VARCHAR(255) NOT NULL DEFAULT '',
  `listorder` INT(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '-1 删除 0 待审 1审核',
  `craete_time` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` INT(11)  UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
)ENGINE =InnoDB AUTO_INCREMENT = 1 DEFAULT CHAR SET utf8;
