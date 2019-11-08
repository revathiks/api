/*
SQLyog Community v8.6 GA
MySQL - 5.5.5-10.1.35-MariaDB : Database - react_learn
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`react_learn` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `react_learn`;

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `category` */

insert  into `category`(`id`,`name`) values (1,'Focus'),(2,'Working Memory');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`catid`,`code`,`name`,`description`,`price`,`thumb`) values (1,1,'PROD01','Toy Story ','Toy Story desc',100,'toy_story.jpg'),(2,1,'PROD02','Wrap it up ','Wrap it up desc',200,'wrap-it-up.jpg'),(3,1,'PROD03','Cloud 9','Cloud 9 desc',150,'cloud9.jpg'),(4,2,'PROD04','Quick Flip','Quick Flip desc',250,'quickflip.jpg'),(5,2,'PROD05','Think Link','Think Link desc',300,'think_link.jpg'),(6,3,'PROD06','Trading Places','Trading Places desc',250,'trading_places.jpg');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`fname`,`lname`,`email`,`grade`,`password`) values (17,'t','yrt','rtyyrt',2,'tr'),(18,'dsf','sdf','fds',2,'dfs'),(19,'fhg','fgh','fgh',1,'ghf'),(22,'hfg','fgh','gfh',1,'gh'),(23,'tyt','tytr','ty',1,'ty'),(24,'sdfsf','sfd','sfd',1,'fd'),(25,'gh','ghf','hg',1,'fgh'),(26,'aaaaw','gfh','gfhf',0,'ghff'),(29,'reva','ks','ggg',2,'hhh'),(30,'reva','s','reva@gmail.com',1,'reva123');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
