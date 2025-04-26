<?php

// Tablo adları tanımlanıyor
$tablo_portal_ayarlar = $tablo_oneki.'portal_ayarlar';
$tablo_portal_anketsecenek = $tablo_oneki.'portal_anketsecenek';
$tablo_portal_anketsoru = $tablo_oneki.'portal_anketsoru';
$tablo_portal_anketyorum = $tablo_oneki.'portal_anketyorum';
$tablo_portal_bloklar = $tablo_oneki.'portal_bloklar';
$tablo_portal_galeri = $tablo_oneki.'portal_galeri';
$tablo_portal_galeridal = $tablo_oneki.'portal_galeridal';
$tablo_portal_haberdal = $tablo_oneki.'portal_haberdal';
$tablo_portal_haberler = $tablo_oneki.'portal_haberler';
$tablo_portal_haberyorum = $tablo_oneki.'portal_haberyorum';
$tablo_portal_indir = $tablo_oneki.'portal_indir';
$tablo_portal_indirkategori = $tablo_oneki.'portal_indirkategori';
$tablo_portal_indiryorum = $tablo_oneki.'portal_indiryorum';
$tablo_portal_sayfa = $tablo_oneki.'portal_sayfa';
$tablo_portal_siteekle = $tablo_oneki.'portal_siteekle';
$tablo_portal_siteekledal = $tablo_oneki.'portal_siteekledal';

$sil_anahtar = substr(sha1(md5(uniqid(rand(111111111111,999999999999)))),0,12);





//  VERİTABANI BİLGİLERİ  //
$veritabani_portal = "



--		`portal_ayarlar` TABLOSU VERiLERi

CREATE TABLE `$tablo_portal_ayarlar` (
`isim` varchar(30) NOT NULL DEFAULT '',
`sayi` text,
PRIMARY KEY (`isim`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `$tablo_portal_ayarlar` VALUES ('galeri_limit', '10');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('haber_limit', '5');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('siteler_limit', '15');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('siteler_dal_limit', '10');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('haber_dal_limit', '10');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('anket_limit', '10');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('dosya_dal_limit', '10');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('haber_dalalt_limit', '10');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('galeri_kb', '2097152');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('son_mesajlar_sayisi', '10');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('portal_dili', 'tr');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('portal_arka_tablo', 'beyaz');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('son_mesajlar_hr', 'Shareketsiz');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('dosya_sayfalama', '20');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('kullanici_izni', '1');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('sitemaps', '100');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('yorum_izni', '1');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('sayfa_gosterim', '4');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('anket_izni', '1');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('portal_genislik', '95%');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('portal_surum', '$guncel_surum_portal');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('resim_ekleme', '1');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('sil_anahtar', '$sil_anahtar');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('haber_kaynagi', '0');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_sekli', 'varsayilan_blok_tasarimi');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('en_cok_mesaj_atanlar', '10');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('son_uyeler', '10');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_dosya_kategorileri', '10');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_haber_kategorileri', '10');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_galeri_kategorileri', '10');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_siteler_kategorileri', '10');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('karakter_sinirlamasi', '750');

INSERT INTO `$tablo_portal_ayarlar` VALUES ('haberlere_giris_izni', '1');




--		`portal_anketsecenek` TABLOSU VERiLERi

CREATE TABLE `$tablo_portal_anketsecenek` (
`secenekno` int(10) NOT NULL AUTO_INCREMENT,
`anketno` int(10) NOT NULL DEFAULT '0',
`secenek` varchar(250) NOT NULL DEFAULT '',
`oylar` mediumint(8) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`secenekno`),
KEY `anketno` (`anketno`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





--		`portal_anketsoru` TABLOSU VERiLERi

CREATE TABLE `$tablo_portal_anketsoru` (
`anketno` int(10) NOT NULL AUTO_INCREMENT,
`anket_soru` varchar(250) NOT NULL,
`tarih` int(11) unsigned NOT NULL DEFAULT '0',
`anket_durum` varchar(6) NOT NULL,
`anket_yorum` varchar(1) NOT NULL DEFAULT '1',
`oy_kullanan_id` text,
PRIMARY KEY (`anketno`),
KEY `tarih` (`tarih`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





--		`portal_anketyorum` TABLOSU VERiLERi

CREATE TABLE `$tablo_portal_anketyorum` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`anketno` int(11) NOT NULL,
`icerik` text,
`yazan` varchar(21) NOT NULL DEFAULT '',
`tarih` int(11) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `tarih` (`tarih`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




--		`$tablo_portal_bloklar` TABLOSU VERiLERi

CREATE TABLE `$tablo_portal_bloklar` (
  `blok_id` mediumint(5) unsigned NOT NULL AUTO_INCREMENT,
  `blok_ad` varchar(30) NOT NULL,
  `blok_yer` tinyint(1) unsigned NOT NULL,
  `blok_sira` tinyint(2) unsigned NOT NULL,
  `blok_acik` tinyint(1) unsigned DEFAULT '1',
  UNIQUE KEY `id` (`blok_id`),
  KEY `blok_ad` (`blok_ad`),
  KEY `blok_yer` (`blok_yer`),
  KEY `blok_sira` (`blok_sira`),
  KEY `blok_acik` (`blok_acik`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;


INSERT INTO `$tablo_portal_bloklar` VALUES (1, 'sol_bloklar', 0, 0, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (2, 'sag_bloklar', 0, 0, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (3, 'davetiye_sayfasi', 0, 0, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (4, 'siteharitasi_sayfasi', 0, 0, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (5, 'anketler_sayfasi', 0, 0, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (6, 'dosyalar_sayfasi', 0, 0, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (7, 'galeri_sayfasi', 0, 0, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (8, 'haber_sayfasi', 0, 0, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (9, 'arama_sayfasi', 0, 0, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (10, 'siteler_sayfasi', 0, 0, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (11, 'takvim_sayfasi', 0, 0, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (12, 'duyuru', 2, 1, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (13, 'haber', 2, 2, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (14, 'son_mesajlar', 2, 3, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (15, 'portal_menusu', 1, 1, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (16, 'kullanici_masasi', 1, 2, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (17, 'forumlar', 1, 3, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (18, 'istatistikler', 1, 4, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (19, 'dogum_gunleri', 1, 5, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (20, 'takvim', 3, 1, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (21, 'encok_mesaj_atanlar', 3, 2, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (22, 'son_uyeler', 3, 3, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (23, 'resim_blok', 3, 4, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (24, 'dosyalar_blok', 3, 5, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (25, 'cevrimici_blok', 3, 6, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (26, 'son_anket', 3, 7, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (27, 'favori_siteler', 1, 6, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (28, 'haber_kategori_blok', 3, 8, 1);

INSERT INTO `$tablo_portal_bloklar` VALUES (29, 'galeri_kategori_blok', 1, 7, 1);





--		`portal_galeri` TABLOSU VERiLERi

CREATE TABLE `$tablo_portal_galeri` (
`no` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`id` int(11) NOT NULL,
`resim` text NOT NULL,
`tarih` int(11) unsigned NOT NULL DEFAULT '0',
`isim` varchar(30) NOT NULL DEFAULT '',
`boyut` varchar(20) NOT NULL,
`aciklama` text NOT NULL,
`puan_verenler` text NOT NULL,
`ekleyen` varchar(20) NOT NULL DEFAULT '',
`resim_onay` varchar(10) NOT NULL,
`puan` varchar(20) NOT NULL DEFAULT '0',
`sifrelenmis_resim_adi` varchar(20) DEFAULT NULL,
`resim_genislik` varchar(6) NOT NULL DEFAULT '1024',
`resim_yukseklik` varchar(6) NOT NULL DEFAULT '768',
PRIMARY KEY (`no`),
KEY `tarih` (`tarih`),
KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





--		`portal_galeridal` TABLOSU VERiLERi

CREATE TABLE `$tablo_portal_galeridal` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`dal` varchar(100) NOT NULL,
`tarih` int(11) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


INSERT INTO `$tablo_portal_galeridal` VALUES (1, 'Ana Kategori', '$tarih');





--		`portal_haberdal` TABLOSU VERiLERi

CREATE TABLE `$tablo_portal_haberdal` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`dal` varchar(100) NOT NULL,
`tarih` int(11) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_portal_haberdal` VALUES (1, 'Ana Kategori', '$tarih');





--		`portal_haberler` TABLOSU VERiLERi

CREATE TABLE `$tablo_portal_haberler` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`dal_id` int(11) unsigned NOT NULL DEFAULT '1',
`baslik` varchar(50) NOT NULL,
`icerik` text,
`etiket` text,
`yazan` varchar(21) NOT NULL DEFAULT '',
`onay` varchar(5) NOT NULL,
`ip_adresi` varchar(15) NOT NULL,
`tarih` int(11) unsigned NOT NULL DEFAULT '0',
`okunma_sayisi` mediumint(8) unsigned NOT NULL DEFAULT '0',
`bbcode_kullan` tinyint(1) NOT NULL DEFAULT '0',
`yorum` tinyint(1) NOT NULL DEFAULT '1',
PRIMARY KEY (`id`),
KEY `tarih` (`tarih`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_portal_haberler` VALUES (1, 1, 'phpKF`ye Hoş Geldiniz', 'phpKF-Portal kurulumunuz başarıyla tamamlanmıştır...\n\nYönetici olarak giriş yaptığınızda üst menüde görünen [url=yonetim.php][/u][u]Yönetim[/u][/url] bağlantısını tıklayarak, yönetimle ilgili işlemlere ulaşabilirsiniz.\n\nphpKF`yi seçtiğiniz için teşekkür ederiz...', 'phpkf,phpkf-portal,sürüm', '$yonetici_adi', '1', '127.0.0.1', '$tarih', 0, 1, 1);





--		`portal_haberyorum` TABLOSU VERiLERi

CREATE TABLE `$tablo_portal_haberyorum` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`haber_id` int(11) NOT NULL,
`icerik` text,
`yazan` varchar(21) NOT NULL DEFAULT '',
`tarih` int(11) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `tarih` (`tarih`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





--		`portal_indir` TABLOSU VERiLERi

CREATE TABLE `$tablo_portal_indir` (
`no` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`kategorino` int(5) NOT NULL DEFAULT '0',
`tarih` int(11) unsigned NOT NULL DEFAULT '0',
`dosya_baslik` varchar(60) NOT NULL DEFAULT '',
`dosya_boyutu` varchar(20) NOT NULL,
`dosya_adresi` varchar(200) NOT NULL,
`dosya_aciklama` text NOT NULL,
`ekleyen` varchar(20) NOT NULL DEFAULT '',
`degistirme_tarihi` int(11) unsigned DEFAULT NULL,
`indirme_sayisi` mediumint(8) unsigned NOT NULL DEFAULT '0',
`degistirme_sayisi` smallint(5) unsigned NOT NULL DEFAULT '0',
`degistiren` varchar(20) DEFAULT NULL,
`ekleyen_ip` varchar(15) DEFAULT NULL,
`degistiren_ip` varchar(15) DEFAULT NULL,
`bbcode_kullan` tinyint(1) NOT NULL DEFAULT '0',
`uretici` varchar(50) NOT NULL DEFAULT '',
`dil` varchar(30) NOT NULL DEFAULT '',
`kullanim` varchar(60) NOT NULL DEFAULT '',
`setup_adi` varchar(180) NOT NULL DEFAULT '',
`resim` text NOT NULL,
PRIMARY KEY (`no`),
KEY `tarih` (`tarih`),
KEY `kategorino` (`kategorino`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





--		`portal_indirkategori` TABLOSU VERiLERi

CREATE TABLE `$tablo_portal_indirkategori` (
`kategorino` int(5) NOT NULL AUTO_INCREMENT,
`kategoriadi` varchar(100) NOT NULL,
PRIMARY KEY (`kategorino`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_portal_indirkategori` VALUES (1, 'Ana Kategori');





--		`portal_indiryorum` TABLOSU VERiLERi

CREATE TABLE `$tablo_portal_indiryorum` (
`yorumno` int(10) unsigned NOT NULL AUTO_INCREMENT,
`yorum_tarih` int(11) unsigned NOT NULL DEFAULT '0',
`yorum_icerik` text NOT NULL,
`yorumlayan` varchar(20) NOT NULL DEFAULT '',
`dosyano` mediumint(8) unsigned NOT NULL DEFAULT '0',
`kategorino` smallint(5) unsigned NOT NULL DEFAULT '0',
`yorumlayan_ip` varchar(15) DEFAULT NULL,
PRIMARY KEY (`yorumno`),
KEY `dosyano` (`dosyano`),
KEY `kategorino` (`kategorino`),
KEY `yorum_tarih` (`yorum_tarih`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





--		`portal_sayfa` TABLOSU VERiLERi

CREATE TABLE `$tablo_portal_sayfa` (
`sayfa_no` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`tarih` int(11) unsigned NOT NULL DEFAULT '0',
`baslik` varchar(60) NOT NULL DEFAULT '',
`dosya_adi` text NOT NULL,
`dosya_adresi` text NOT NULL,
`kosul_adi` varchar(20) NOT NULL,
`uzanti` varchar(10) NOT NULL,
`yer` tinyint(1) NOT NULL,
PRIMARY KEY (`sayfa_no`),
KEY `tarih` (`tarih`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





--		`portal_siteekle` TABLOSU VERiLERi

CREATE TABLE `$tablo_portal_siteekle` (
`site_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`dal_no` int(11) NOT NULL,
`tarih` int(11) unsigned NOT NULL DEFAULT '0',
`site_title` varchar(60) NOT NULL DEFAULT '',
`adres` varchar(100) NOT NULL,
`site_onay` varchar(2) NOT NULL DEFAULT '0',
`aciklama` varchar(250) NOT NULL,
`ekleyen` varchar(25) NOT NULL,
`tiklama_sayisi` int(11) unsigned DEFAULT '0',
`site_oy` int(11) NOT NULL DEFAULT '0',
`site_resim` text NOT NULL,
`oy_verenler` text NOT NULL,
PRIMARY KEY (`site_id`),
KEY `tarih` (`tarih`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;





--		`portal_siteekledal` TABLOSU VERiLERi

CREATE TABLE `$tablo_portal_siteekledal` (
`dal_no` int(11) unsigned NOT NULL AUTO_INCREMENT,
`tarih` int(11) unsigned NOT NULL DEFAULT '0',
`baslik` varchar(60) NOT NULL,
PRIMARY KEY (`dal_no`),
KEY `tarih` (`tarih`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_portal_siteekledal` VALUES (1, '$tarih', 'Ana Kategori');

";

?>