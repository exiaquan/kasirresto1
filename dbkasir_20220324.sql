/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 5.7.36-log : Database - dbkasir
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbkasir` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `dbkasir`;

/*Table structure for table `d_diskonproduk` */

DROP TABLE IF EXISTS `d_diskonproduk`;

CREATE TABLE `d_diskonproduk` (
  `id` int(11) NOT NULL,
  `id_diskonproduk` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `max_beli` int(11) NOT NULL,
  `diskon_persen` int(11) NOT NULL,
  `diskon_nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `d_diskonproduk` */

/*Table structure for table `diskonproduk` */

DROP TABLE IF EXISTS `diskonproduk`;

CREATE TABLE `diskonproduk` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tglwaktu_mulai` datetime NOT NULL,
  `tglwaktu_akhir` datetime NOT NULL,
  `input_user` varchar(100) NOT NULL,
  `input_tanggalwaktu` datetime NOT NULL,
  `update_user` int(11) NOT NULL,
  `update_tanggalwaktu` datetime NOT NULL,
  `sts_aktif` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `diskonproduk` */

/*Table structure for table `id_invoice` */

DROP TABLE IF EXISTS `id_invoice`;

CREATE TABLE `id_invoice` (
  `id` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `satuan_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `id_diskon` int(11) NOT NULL,
  `kode_diskon` int(11) NOT NULL,
  `diskon_persen` int(11) NOT NULL,
  `diskon_nominal` int(11) NOT NULL,
  `subtotal_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `id_invoice` */

/*Table structure for table `invoice` */

DROP TABLE IF EXISTS `invoice`;

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `nomor` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `payment_no` int(11) NOT NULL,
  `payment_amount` int(11) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `payment_notes` varchar(255) NOT NULL,
  `input_user` varchar(100) NOT NULL,
  `inout_tglwaktu` date NOT NULL,
  `update_user` varchar(100) NOT NULL,
  `update_tglwaktu` date NOT NULL,
  `payment_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `invoice` */

/*Table structure for table `katagoribarang` */

DROP TABLE IF EXISTS `katagoribarang`;

CREATE TABLE `katagoribarang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `katagoribarang` */

insert  into `katagoribarang`(`id`,`kode`,`nama`) values 
(1,'K001','SNACK'),
(2,'K002','NASI'),
(3,'K003','MIE'),
(4,'K004','MINUMAN');

/*Table structure for table `paymentinvoice` */

DROP TABLE IF EXISTS `paymentinvoice`;

CREATE TABLE `paymentinvoice` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `method` varchar(50) NOT NULL,
  `ammount` int(11) NOT NULL,
  `sts_payment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `paymentinvoice` */

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT '0',
  `matauang` char(10) DEFAULT 'Rp',
  `harga` double DEFAULT '0',
  `katagori` varchar(255) DEFAULT NULL,
  `foto_produk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `produk` */

insert  into `produk`(`id`,`kode`,`nama`,`satuan`,`jumlah`,`matauang`,`harga`,`katagori`,`foto_produk`) values 
(1,'s123','tester','PCS',0,'Rp',20000,'SNACK',NULL);

/*Table structure for table `satuan` */

DROP TABLE IF EXISTS `satuan`;

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `satuan` */

insert  into `satuan`(`id`,`kode`,`nama`) values 
(1,'S001','PCS');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `tgllahir` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nohp` varchar(20) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `hak_akses` char(2) DEFAULT '00',
  `sts_aktif` varchar(15) DEFAULT '1',
  `tglbuat` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lastlogin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`kode`,`nama`,`gender`,`tgllahir`,`alamat`,`email`,`nohp`,`pass`,`hak_akses`,`sts_aktif`,`tglbuat`,`lastlogin`) values 
(1,'U220321001','Hendrick','pria','1994-01-20','test','hendricklie1@gmail.com','081227101594','31644915f40111b5fb3bb6fde5d094459630773f19e77617b3924493fa7c0505b865eb9d5b76c8a8399c61f48d4fd50ec6387707a1305123f1e728fc1ecca89cHSnKYQpBaxMnBkXkPKciQEL+Mi/xRuYsuBQScXN5b21/hSYM+uMnK9L+IoXlkEAY','01','1','2022-03-21 19:35:07',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
