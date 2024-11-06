/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 8.0.30 : Database - tokoku
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tokoku` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `tokoku`;

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id_barang` int NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(35) NOT NULL,
  `harga` varchar(35) NOT NULL,
  `stok` int NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `id_kategori` int NOT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `id_kategori` (`id_kategori`),
  CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

insert  into `barang`(`id_barang`,`nama_barang`,`harga`,`stok`,`gambar`,`id_kategori`) values 
(77,'Mefenamic Acid','4000',49,'a595d3ef0d62f12ec494fe0dae9f8906.jpg',16),
(89,'Kursi Roda','1500000',5,'df2cea73-0a46-46b4-83de-229ea02513be.jpg',20),
(90,'Ibuprofen','5500',77,'223016_18-6-2023_23-51-47.png',16),
(91,'Masker Medis','1500',150,'download.jpeg',17),
(92,'Vitamin C IPI','12000',25,'download.png',18),
(93,'Sarung Tangan Medis','2500',198,'download (1).jpeg',17),
(94,'Kain Kasa','2500',200,'download (2).jpeg',17),
(95,'Alat Tes Gula Darah','300000',15,'download (3).jpeg',19),
(96,'Termometer','90000',29,'download (4).jpeg',19);

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `kategori` varchar(35) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `kategori` */

insert  into `kategori`(`id_kategori`,`kategori`) values 
(16,'Obat - obatan'),
(17,'Alat Medis Rumah Tangga'),
(18,'Nutrisi dan Suplemen'),
(19,'Alat Tes Kesehatan'),
(20,'Alat Kesehatan');

/*Table structure for table `keranjang` */

DROP TABLE IF EXISTS `keranjang`;

CREATE TABLE `keranjang` (
  `id_keranjang` int NOT NULL AUTO_INCREMENT,
  `harga_barang` varchar(25) NOT NULL,
  `jumlah_beli` int NOT NULL DEFAULT '0',
  `status` varchar(30) NOT NULL,
  `waktu` datetime DEFAULT NULL,
  `total` float NOT NULL DEFAULT '0',
  `id_barang` int NOT NULL,
  `id_pengguna` int NOT NULL,
  PRIMARY KEY (`id_keranjang`),
  KEY `id_barang` (`id_barang`),
  KEY `id_pengguna` (`id_pengguna`),
  CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

/*Data for the table `keranjang` */

insert  into `keranjang`(`id_keranjang`,`harga_barang`,`jumlah_beli`,`status`,`waktu`,`total`,`id_barang`,`id_pengguna`) values 
(87,'5500',1,'lunas','2024-11-06 10:35:04',5500,90,11),
(88,'90000',1,'proses kirim','2024-11-06 11:23:06',90000,96,11);

/*Table structure for table `pengguna` */

DROP TABLE IF EXISTS `pengguna`;

CREATE TABLE `pengguna` (
  `id_pengguna` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tgl_lahir` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `hak` varchar(25) NOT NULL,
  PRIMARY KEY (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `pengguna` */

insert  into `pengguna`(`id_pengguna`,`nama`,`jenis_kelamin`,`tgl_lahir`,`username`,`password`,`hak`) values 
(6,'admin','Perempuan','2022-12-06','admin','admin','admin'),
(11,'iwan','Laki - Laki','2022-12-06','user','user','pengguna'),
(12,'tes','Laki - Laki','2024-11-16','aasf','asfsf','pengguna');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL AUTO_INCREMENT,
  `waktu_transaksi` datetime NOT NULL,
  `subtotal` bigint NOT NULL,
  `status_transaksi` varchar(30) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `rekening` varchar(100) NOT NULL,
  `id_pengguna` int NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `id_pengguna` (`id_pengguna`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`id_transaksi`,`waktu_transaksi`,`subtotal`,`status_transaksi`,`alamat`,`no_hp`,`rekening`,`id_pengguna`) values 
(69,'2024-11-06 10:35:04',5500,'lunas','rumah','01284','012840',11),
(70,'2024-11-06 11:23:06',90000,'proses kirim','tes','33','32',11);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
