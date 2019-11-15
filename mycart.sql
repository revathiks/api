/*
SQLyog Community v12.3.3 (64 bit)
MySQL - 10.1.35-MariaDB : Database - mycart
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mycart` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `mycart`;

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `category` */

insert  into `category`(`id`,`name`) values 
(1,'Focus'),
(2,'Working Memory');

/*Table structure for table `order_history` */

DROP TABLE IF EXISTS `order_history`;

CREATE TABLE `order_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `billing_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_mobile` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `order_history` */

insert  into `order_history`(`id`,`userid`,`billing_name`,`billing_email`,`shipping_name`,`shipping_email`,`shipping_address`,`shipping_mobile`,`createdon`) values 
(1,1,'','','ivy','ivyk@gmail.com','arumbakkam',NULL,'2019-11-15 09:16:13'),
(2,3,'','','reva','reva@gmail.com','tst',NULL,'2019-11-15 09:26:43'),
(3,3,'','','g','dfg','fgd',NULL,'2019-11-15 01:57:59'),
(4,3,'','','dgdd','fdg','fgd',NULL,'2019-11-15 02:06:44');

/*Table structure for table `order_items` */

DROP TABLE IF EXISTS `order_items`;

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `order_items` */

insert  into `order_items`(`id`,`order_id`,`product_id`,`product_code`,`quantity`,`price`) values 
(1,1,5,'PROD05',1,'300'),
(2,1,6,'PROD06',4,'250'),
(3,1,1,'PROD01',2,'100'),
(4,2,6,'PROD06',1,'250'),
(5,2,3,'PROD03',1,'150'),
(6,2,1,'PROD01',1,'100'),
(7,2,2,'PROD02',1,'200'),
(8,3,16,'sd43',1,'44'),
(9,3,15,'sdf',1,'4'),
(10,4,16,'sd43',1,'44'),
(11,4,15,'sdf',1,'4');

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) DEFAULT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `thumb` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`catid`,`code`,`name`,`description`,`price`,`thumb`) values 
(1,1,'PROD01','Toy Story ','Toy Story desc',100,'toy_story.jpg'),
(2,1,'PROD02','Wrap it up ','Wrap it up desc',200,'wrap-it-up.jpg'),
(3,1,'PROD03','Cloud 9','Cloud 9 desc',150,'cloud9.jpg'),
(4,2,'PROD04','Quick Flip','Quick Flip desc',250,'quickflip.jpg'),
(5,2,'PROD05','Think Link','Think Link desc',300,'think_link.jpg'),
(6,3,'PROD06','Trading Places','Trading Places desc',250,'trading_places.jpg'),
(8,NULL,'hfgh','ghf','gfhfgh',565,'empty.png'),
(9,NULL,'sdfd','sdfs','hfhf',45,'order_confirm.png'),
(10,NULL,'sd','dfds','dfg',4,'empty.png'),
(11,NULL,'asd','ads','ds',2,'empty.png'),
(12,NULL,'asds','ads','ds',2,'empty.png'),
(13,NULL,'3sdfsd','sfdsdfsd','sdfsd',0,'order_confirm.png'),
(14,NULL,'asdfd','sa','dsf',2,'checkmark.png'),
(15,NULL,'sdf','sdf','fd',4,'checkmark.png'),
(16,NULL,'sd43','revts','dgdf',44,'checkmark.png');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`fname`,`lname`,`username`,`email`,`mobile`,`password`,`pincode`,`city`) values 
(1,'revathi','s','revathiks','reva@gmail.com','9840279184','reva123',NULL,'chennai'),
(3,'ivy','k','vyk','ivy@gmail.com','4789566','ivy123',NULL,'chennai');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
