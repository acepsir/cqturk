<?php

//  VERİTABANI BİLGİLERİ  //
$veritabani_forum = "



--		`cevaplar` TABLOSU VERiLERi

CREATE TABLE `$tablo_cevaplar` (
`id` int(10) unsigned NOT NULL auto_increment,
`tarih` int(11) unsigned NOT NULL,
`cevap_baslik` varchar(255) NOT NULL DEFAULT '',
`cevap_icerik` text NOT NULL,
`cevap_yazan` varchar(20) NOT NULL,
`hangi_basliktan` mediumint(8) unsigned NOT NULL,
`degistirme_tarihi` int(11) unsigned default NULL,
`degistirme_sayisi` smallint(5) unsigned NOT NULL default '0',
`degistiren` varchar(20) default NULL,
`hangi_forumdan` smallint(5) unsigned NOT NULL,
`yazan_ip` varchar(39) default NULL,
`degistiren_ip` varchar(39) default NULL,
`bbcode_kullan` tinyint(1) NOT NULL default '0',
`silinmis` tinyint(1) NOT NULL default '0',
`ifade` tinyint(1) NOT NULL default '1',
PRIMARY KEY (`id`),
KEY `cevap_yazan` (`cevap_yazan`),
KEY `hangi_basliktan` (`hangi_basliktan`),
KEY `hangi_forumdan` (`hangi_forumdan`),
KEY `tarih` (`tarih`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





--		`dallar` TABLOSU VERiLERi

CREATE TABLE `$tablo_dallar` (
`id` smallint(5) unsigned NOT NULL auto_increment,
`ana_forum_baslik` text NOT NULL,
`sira` tinyint(3) unsigned NOT NULL default '1',
PRIMARY KEY (`id`),
KEY `sira` (`sira`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_dallar` VALUES (1, 'Deneme Forum Dalı 1', 1);





--		`duyurular` TABLOSU VERiLERi

CREATE TABLE `$tablo_duyurular` (
`id` smallint(5) unsigned NOT NULL auto_increment,
`fno` varchar(5) default NULL,
`duyuru_baslik` varchar(255) NOT NULL DEFAULT '',
`duyuru_icerik` text,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_duyurular` VALUES (1, 'tum', 'phpKF`ye Hoş Geldiniz !', '<center><b>Forum Kurulumunuz Başarıyla Tamamlanmıştır.</b><p>Yönetici olarak giriş yaptığınızda üst menüde görünen <a href=\"phpkf-yonetim/index.php\"><u>Yönetim</u></a> bağlantısını tıklayarak, yönetimle ilgili işlemlere ulaşabilirsiniz.</center>');





--		`forumlar` TABLOSU VERiLERi

CREATE TABLE `$tablo_forumlar` (
`id` smallint(5) unsigned NOT NULL auto_increment,
`dal_no` smallint(5) unsigned NOT NULL,
`forum_baslik` text NOT NULL,
`forum_bilgi` text NOT NULL,
`sira` tinyint(3) unsigned NOT NULL default '1',
`okuma_izni` tinyint(1) NOT NULL default '0',
`yazma_izni` tinyint(1) NOT NULL default '0',
`resim` varchar(250) default NULL,
`konu_acma_izni` tinyint(1) NOT NULL default '0',
`konu_sayisi` mediumint(8) unsigned default '0',
`cevap_sayisi` int(10) unsigned default '0',
`alt_forum` smallint(5) unsigned default '0',
`gizle` tinyint(1) NOT NULL default '0',
PRIMARY KEY (`id`),
KEY `dal_no` (`dal_no`),
KEY `sira` (`sira`),
KEY `alt_forum` (`alt_forum`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_forumlar` VALUES (1, 1, 'Deneme Forumu 1', 'Bu forum deneme amaçlı açılmıştır.', 1, 0, 0, '', 0, 1, 0, 0, 0);

INSERT INTO `$tablo_forumlar` VALUES (2, 1, 'Deneme Alt Forumu', 'Bu alt forum deneme amaçlı açılmıştır.', 1, 0, 0, '', 0, 0, 0, 1, 0);





--		`gruplar` TABLOSU VERiLERi

CREATE TABLE `$tablo_gruplar` (
`id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
`grup_adi` varchar(30) NOT NULL,
`sira` tinyint(2) unsigned NOT NULL DEFAULT '0',
`gizle` tinyint(1) unsigned NOT NULL DEFAULT '0',
`yetki` tinyint(1) NOT NULL DEFAULT '-1',
`ozel_ad` varchar(30) DEFAULT NULL,
`uyeler` text,
`grup_bilgi` varchar(250) DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `grup_adi` (`grup_adi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





--		`mesajlar` TABLOSU VERiLERi

CREATE TABLE `$tablo_mesajlar` (
`id` mediumint(8) unsigned NOT NULL auto_increment,
`tarih` int(11) unsigned NOT NULL,
`mesaj_baslik` varchar(255) NOT NULL DEFAULT '',
`mesaj_icerik` text NOT NULL,
`yazan` varchar(20) NOT NULL,
`degistirme_tarihi` int(11) unsigned default NULL,
`hangi_forumdan` smallint(5) unsigned NOT NULL,
`goruntuleme` mediumint(8) unsigned NOT NULL default '0',
`cevap_sayi` smallint(5) unsigned NOT NULL default '0',
`son_mesaj_tarihi` int(11) unsigned default NULL,
`degistirme_sayisi` smallint(5) unsigned NOT NULL default '0',
`degistiren` varchar(20) default NULL,
`yazan_ip` varchar(39) default NULL,
`degistiren_ip` varchar(39) default NULL,
`bbcode_kullan` tinyint(1) NOT NULL default '0',
`ust_konu` tinyint(1) NOT NULL default '0',
`kilitli` tinyint(1) NOT NULL default '0',
`silinmis` tinyint(1) NOT NULL default '0',
`ifade` tinyint(1) NOT NULL default '1',
`son_cevap` int(10) unsigned NOT NULL DEFAULT '0',
`son_cevap_yazan` varchar(20) NULL,
PRIMARY KEY (`id`),
KEY `tarih` (`tarih`),
KEY `yazan` (`yazan`),
KEY `hangi_forumdan` (`hangi_forumdan`),
KEY `cevap_sayi` (`cevap_sayi`),
KEY `son_mesaj_tarihi` (`son_mesaj_tarihi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_mesajlar` VALUES (1, $tarih, 'phpKF`ye Hoş Geldiniz', '[quote=\"phpKF\"]Forum kurulumunuz başarıyla tamamlanmıştır...[/quote]\nYönetici olarak giriş yaptığınızda üst menüde görünen [url=phpkf-yonetim/index.php][u]Yönetim[/u][/url] bağlantısını tıklayarak, yönetimle ilgili işlemlere ulaşabilirsiniz.\n\nphpKF`yi seçtiğiniz için teşekkür ederiz...', '$yonetici_adi', NULL, 1, 0, 0, $tarih, 0, NULL, NULL, '', 1, 0, 0, 0, 0, 0, NULL);





--		`ozel_ileti` TABLOSU VERiLERi

CREATE TABLE `$tablo_ozel_ileti` (
`id` int(10) unsigned NOT NULL auto_increment,
`kimden` varchar(20) NOT NULL,
`kime` varchar(20) NOT NULL,
`ozel_baslik` varchar(255) NOT NULL DEFAULT '',
`ozel_icerik` text NOT NULL,
`gonderme_tarihi` int(11) unsigned NOT NULL,
`okunma_tarihi` int(11) unsigned default NULL,
`gonderen_kutu` tinyint(1) NOT NULL default '0',
`alan_kutu` tinyint(1) NOT NULL default '0',
`bbcode_kullan` tinyint(1) NOT NULL default '0',
`ifade` tinyint(1) NOT NULL default '1',
`cevap_sayi` tinyint(3) unsigned NOT NULL default '0',
`cevap` int(10) unsigned NOT NULL default '0',
PRIMARY KEY (`id`),
KEY `kimden` (`kimden`),
KEY `kime` (`kime`),
KEY `gonderme_tarihi` (`gonderme_tarihi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





--		`ozel_izinler` TABLOSU VERiLERi

CREATE TABLE `$tablo_ozel_izinler` (
`kulad` varchar(30) NOT NULL,
`kulid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`grup` smallint(5) unsigned NOT NULL DEFAULT '0',
`fno` smallint(5) unsigned NOT NULL,
`okuma` tinyint(1) NOT NULL default '0',
`yazma` tinyint(1) NOT NULL default '0',
`yonetme` tinyint(1) NOT NULL default '0',
`konu_acma` tinyint(1) NOT NULL default '0',
`cevap_sayi` tinyint(3) unsigned DEFAULT '0',
`cevap` int(10) unsigned DEFAULT '0',
KEY `kulid` (`kulid`),
KEY `kulad` (`kulad`),
KEY `fno` (`fno`),
KEY `grup` (`grup`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





--		`pyorumlar` TABLOSU VERiLERi

CREATE TABLE `$tablo_pyorumlar` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`tarih` int(11) unsigned NOT NULL,
`uye_adi` varchar(20) NOT NULL,
`uye_id` mediumint(8) unsigned NOT NULL,
`yazan` varchar(20) NOT NULL,
`yazan_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
`yazan_ip` varchar(39) DEFAULT NULL,
`silinmis` tinyint(1) unsigned NOT NULL DEFAULT '0',
`onay` tinyint(1) unsigned NOT NULL DEFAULT '0',
`sikayet` text,
`yorum_icerik` text NOT NULL,
PRIMARY KEY (`id`),
KEY `uye_id` (`uye_id`),
KEY `tarih` (`tarih`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





--		`yuklemeler` TABLOSU VERiLERi

CREATE TABLE `$tablo_yuklemeler` (
`id` int(8) unsigned NOT NULL AUTO_INCREMENT,
`tarih` int(11) NOT NULL DEFAULT '0',
`boyut` int(7) unsigned DEFAULT '0',
`ip` varchar(15) DEFAULT NULL,
`uye_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
`uye_adi` varchar(20) NOT NULL DEFAULT '',
`dosya` varchar(100) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

";

?>