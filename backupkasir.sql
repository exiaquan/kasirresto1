/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 5.1.72-community : Database - dbkasir
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `d_diskonproduk` */

/*Table structure for table `d_invoice` */

DROP TABLE IF EXISTS `d_invoice`;

CREATE TABLE `d_invoice` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_invoice` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `satuan_produk` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `id_diskon` int(11) NOT NULL,
  `kode_diskon` int(11) NOT NULL,
  `diskon_persen` int(11) NOT NULL,
  `diskon_nominal` int(11) NOT NULL,
  `subtotal_amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

/*Data for the table `d_invoice` */

insert  into `d_invoice`(`id`,`id_invoice`,`id_produk`,`kode_produk`,`nama_produk`,`satuan_produk`,`jumlah`,`harga`,`id_diskon`,`kode_diskon`,`diskon_persen`,`diskon_nominal`,`subtotal_amount`) values 
(22,5,2,'asd123456','PRODUK COKLAT','PCS',5,1000,0,0,0,0,5000),
(25,6,3,'HNDNSG01','HENDRICK NASGOR SPECIAL','PCS',5,10000,0,0,0,0,50000),
(26,6,4,'TPG01','NASI TUMPENG','PCS',32,25000,0,0,0,0,800000),
(29,8,2,'asd123456','PRODUK COKLAT','PCS',5,1000,0,0,0,0,5000),
(30,8,3,'HNDNSG01','HENDRICK NASGOR SPECIAL','PCS',5,10000,0,0,0,0,50000),
(31,9,2,'asd123456','PRODUK COKLAT','PCS',10,1000,0,0,0,0,10000),
(32,9,3,'HNDNSG01','HENDRICK NASGOR SPECIAL','PCS',5,10000,0,0,0,0,50000),
(33,10,2,'asd123456','PRODUK COKLAT','PCS',10,1000,0,0,0,0,10000),
(34,7,2,'asd123456','PRODUK COKLAT','PCS',10,1000,0,0,0,0,10000),
(35,7,3,'HNDNSG01','HENDRICK NASGOR SPECIAL','PCS',10,10000,0,0,0,0,100000),
(36,11,2,'asd123456','PRODUK COKLAT','PCS',5,1000,0,0,0,0,5000);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `diskonproduk` */

/*Table structure for table `invoice` */

DROP TABLE IF EXISTS `invoice`;

CREATE TABLE `invoice` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(20) NOT NULL,
  `no_meja` char(5) DEFAULT NULL,
  `nama_customer` varchar(255) DEFAULT NULL,
  `total_amount` double NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `payment_no` varchar(20) DEFAULT NULL,
  `payment_amount` double DEFAULT '0',
  `payment_method` varchar(100) DEFAULT NULL,
  `payment_notes` text,
  `input_user` varchar(100) NOT NULL,
  `input_tglwaktu` date NOT NULL,
  `update_user` varchar(100) DEFAULT NULL,
  `update_tglwaktu` date DEFAULT NULL,
  `payment_status` int(1) DEFAULT '0',
  `tgl_invoice` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nama_pelayan` varchar(255) DEFAULT NULL,
  `payment_kembalian` double DEFAULT '0',
  `catatan` text,
  `sub_total` double DEFAULT '0',
  `diskon_persen` double DEFAULT '0',
  `diskon_amount` double DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `invoice` */

insert  into `invoice`(`id`,`nomor`,`no_meja`,`nama_customer`,`total_amount`,`payment_id`,`payment_no`,`payment_amount`,`payment_method`,`payment_notes`,`input_user`,`input_tglwaktu`,`update_user`,`update_tglwaktu`,`payment_status`,`tgl_invoice`,`nama_pelayan`,`payment_kembalian`,`catatan`,`sub_total`,`diskon_persen`,`diskon_amount`) values 
(5,'INV220405082756','1','hh',5000,NULL,NULL,NULL,NULL,NULL,'1','2022-04-04','1','2022-04-05',0,'2022-04-04 19:25:57','Hendrick',0,'asd',0,0,0),
(6,'INV220405083321','2','ee',850000,3,'P220329001',900000,'CASH','-','1','2022-04-05','1','2022-04-05',1,'2022-04-05 20:32:04','Hendrick',50000,'zxczxczxc\r\nzxczxczxczx $400\r\naaa',850000,0,0),
(7,'INV230413080534','2','ian',99000,3,'P220329001',99000,'CASH','-','1','2022-12-30','3','2023-04-13',1,'2022-12-30 10:12:42','Admin',0,'',110000,10,11000),
(8,'INV230413114238','01','Juven',55000,3,'P220329001',60000,'CASH','-','3','2023-04-13',NULL,NULL,1,'2023-04-13 11:42:38','Tama',5000,'',55000,0,0),
(9,'INV230413115117','04','Erlita',54000,3,'P220329001',60000,'CASH','-','3','2023-04-13',NULL,NULL,1,'2023-04-13 11:51:17','Hesti',6000,'',60000,10,6000),
(10,'INV230413073639','09','asw',10000,3,'P220329001',1000,'CASH','-','3','2023-04-13',NULL,NULL,1,'2023-04-13 19:36:39','brengserk',-9000,'',10000,0,0),
(11,'INV230419122933','6','ffhfh',4750,3,'P220329001',110000,'CASH','-','3','2023-04-19',NULL,NULL,1,'2023-04-19 12:29:33','sdsada',105250,'adasdad',5000,5,250);

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

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nomor` char(10) NOT NULL,
  `notes` text,
  `gambar` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `payment` */

insert  into `payment`(`id`,`nomor`,`notes`,`gambar`,`method`) values 
(3,'P220329001','-','P220329001.png','CASH');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `produk` */

insert  into `produk`(`id`,`kode`,`nama`,`satuan`,`jumlah`,`matauang`,`harga`,`katagori`,`foto_produk`) values 
(3,'HNDNSG01','Hendrick Nasgor Special','PCS',0,'Rp',10000,'NASI','HNDNSG01.jpg'),
(4,'TPG01','Nasi tumpeng','PCS',0,'Rp',25000,'NASI','TPG01.png');

/*Table structure for table `satuan` */

DROP TABLE IF EXISTS `satuan`;

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`kode`,`nama`,`gender`,`tgllahir`,`alamat`,`email`,`nohp`,`pass`,`hak_akses`,`sts_aktif`,`tglbuat`,`lastlogin`) values 
(1,'U220321001','Admin','pria','1994-01-20','test','admin@kasirresto.com','','dc27113f9da8eb614b6dc0ea942fe38cfad59edb7e6a27d8b8d64b9e1fb431b4bbe117ed2b65f205824b2a9d9aeeb5fff87200463ceda5205b9093e26fe401aeZ/44h/8Fb0jFy9XG6xSkOrcte7Naf4dA0NrHr0EmvYg=','01','1','2022-03-21 19:35:07',NULL),
(2,'U221118001','User','pria','2022-11-01','qwerty','user@kasirresto.com','','1c09d9a8c27326aafe7eca5883187e1e383c04a2a6781210dff66eab202bc48ee31e55f5501e175fb74f020ac3336c3a31d3a336e481c90f8d7ac83c3e1823c9qOhDtoP5PnfRkEL+2zG7jZCMa2USVhaej1NAgOBmP6s=','02','1','2022-11-18 19:56:23',NULL),
(3,'U230302001',NULL,NULL,NULL,NULL,'admin@kopimili.com',NULL,'aaf53018eeb5a134d2474c2bc5224b1e8f4bd11fb00c87f505f9528f89a23a1fe48f10ba955f530e95beaaa57a8eeaa4298af61e17a2c2acd9d38c7b4071fd9bOFNV7rArCpwTrM/WrsEANdQ4Xugo6/+CSxtzYfqxMdQ=','01','1','2023-03-02 12:36:35',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
