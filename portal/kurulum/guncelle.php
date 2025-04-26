<?php
/*
 +-=========================================================================-+
 |                             phpKF-Portal v3.00                            |
 +---------------------------------------------------------------------------+
 |                  Telif - Copyright (c) 2007 - 2019 phpKF                  |
 |                    www.phpKF.com   -   phpKF@phpKF.com                    |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkarma ve satma hakları sadece phpKF`ye aittir. |
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  phpKF.com/telif.php  adresini ziyaret edin. |
 +-=========================================================================-+*/


	$ornek1->kosul('1', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('3', array('' => ''), false);
	$ornek1->kosul('6', array('' => ''), false);
	$ornek1->kosul('7', array('' => ''), false);
	$ornek1->kosul('8', array('' => ''), false);
	$ornek1->kosul('9', array('' => ''), false);
	$ornek1->kosul('10', array('' => ''), false);



	// SÜRÜM 3.00 İSE //
	if ( (isset($portal_ayarlar['portal_surum'])) AND ($portal_ayarlar['portal_surum'] == $version) )
	{
		$ornek1->kosul('4', array('' => ''), false);
		$ornek1->kosul('5', array('' => ''), true);
		eval(TEMA_UYGULA);
		exit();
	}



	// SÜRÜM 1.70 VE ÜSTÜ İSE //
	if ( (isset($portal_ayarlar['portal_surum'])) AND ($portal_ayarlar['portal_surum'] > '1.21') )
	{
		$ornek1->kosul('5', array('' => ''), false);

		$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='tr' WHERE isim='portal_dili' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		$portal_portal_surum = "UPDATE `$tablo_portal_ayarlar` SET sayi='$version' WHERE isim='portal_surum' LIMIT 1";
		$portal_portal_surum_sonuc = $vt->query($portal_portal_surum) or die ($vt->hata_ver());
	}



	// SÜRÜM 1.21 İSE //
	elseif ( (isset($portal_ayarlar['portal_surum'])) AND ($portal_ayarlar['portal_surum'] == '1.21') )
	{
		$ornek1->kosul('5', array('' => ''), false);


	$portal_portal_surum = "UPDATE `$tablo_ayarlar` SET deger='1' WHERE etiket='portal_kullan' LIMIT 1";
	$portal_portal_surum_sonuc = $vt->query($portal_portal_surum) or die ($vt->hata_ver());

	$portal_portal_surum = "UPDATE `$tablo_portal_ayarlar` SET sayi='$version' WHERE isim='portal_surum' LIMIT 1";
	$portal_portal_surum_sonuc = $vt->query($portal_portal_surum) or die ($vt->hata_ver());
	
	$siteler_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('siteler_limit', '15');";
	$siteler_limit_sonucu = $vt->query($siteler_limit) or die ($vt->hata_ver());
	
	$siteler_dal_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('siteler_dal_limit', '10');";
	$siteler_dal_limit_sonucu = $vt->query($siteler_dal_limit) or die ($vt->hata_ver());
	
	$haber_dal_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('haber_dal_limit', '10');";
	$haber_dal_limit_sonucu = $vt->query($haber_dal_limit) or die ($vt->hata_ver());
	
	$haber_dalalt_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('haber_dalalt_limit', '10');";
	$haber_dalalt_limit_sonucu = $vt->query($haber_dalalt_limit) or die ($vt->hata_ver());
	
	$anket_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('anket_limit', '10');";
	$anket_limit_sonucu = $vt->query($anket_limit) or die ($vt->hata_ver());
	
	$dosya_dal_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('dosya_dal_limit', '10');";
	$dosya_dal_limit_sonucu = $vt->query($dosya_dal_limit) or die ($vt->hata_ver());
	
	$resim_ekleme = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('sil_anahtar', '$sil_anahtar')";
	$resim_ekleme_sonuc = $vt->query($resim_ekleme) or die ($vt->hata_ver());
	
	$haber_kaynagi = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('haber_kaynagi', '0');";
	$haber_kaynagi_sonucu = $vt->query($haber_kaynagi) or die ($vt->hata_ver());
	
	$blok_sekli = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_sekli', 'varsayilan_blok_tasarimi');";
	$blok_sekli_sonucu = $vt->query($blok_sekli) or die ($vt->hata_ver());
	
	$en_cok_mesaj_atanlar = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('en_cok_mesaj_atanlar', '10');";
	$en_cok_mesaj_atanlar_sonucu = $vt->query($en_cok_mesaj_atanlar) or die ($vt->hata_ver());

	$son_uyeler = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('son_uyeler', '10');";
	$son_uyeler_sonucu = $vt->query($son_uyeler) or die ($vt->hata_ver());
	
	$blok_dosya_kategorileri = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_dosya_kategorileri', '10');";
	$blok_dosya_kategorileri_sonucu = $vt->query($blok_dosya_kategorileri) or die ($vt->hata_ver());

	$blok_haber_kategorileri = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_haber_kategorileri', '10');";
	$blok_haber_kategorileri_sonucu = $vt->query($blok_haber_kategorileri) or die ($vt->hata_ver());

	$blok_galeri_kategorileri = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_galeri_kategorileri', '10');";
	$blok_galeri_kategorileri_sonucu = $vt->query($blok_galeri_kategorileri) or die ($vt->hata_ver());

	$blok_siteler_kategorileri = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_siteler_kategorileri', '10');";
	$blok_siteler_kategorileri_sonucu = $vt->query($blok_siteler_kategorileri) or die ($vt->hata_ver());

	$karakter_sinirlamasi = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('karakter_sinirlamasi', '750');";
	$karakter_sinirlamasi_sonucu = $vt->query($karakter_sinirlamasi) or die ($vt->hata_ver());

	$haberlere_giris_izni = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('haberlere_giris_izni', '1');";
	$haberlere_giris_izni_sonucu = $vt->query($haberlere_giris_izni) or die ($vt->hata_ver());







	/***************Haber Kategori Tablosu***************/
	$tablo122 = "CREATE TABLE `$tablo_portal_haberdal` (
	`id` int(11) NOT NULL auto_increment,
	`dal` varchar(100) NOT NULL,
	`tarih` int(11) unsigned NOT NULL default '0',
	PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sonuc123 = $vt->query($tablo122) or die ($vt->hata_ver());
	$tarih = time();
	$haber1 = "INSERT INTO `$tablo_portal_haberdal` VALUES (1, 'Ana Kategori', $tarih)";
	$haber_sonucu1 = $vt->query($haber1) or die ($vt->hata_ver());
	
	$portal_haber = "ALTER TABLE `$tablo_portal_haberler` ADD `dal_id` int(11) unsigned NOT NULL default '1'";
	$portal_haber_sonuc = $vt->query($portal_haber) or die ($vt->hata_ver());

	/***************Favori Siteler Tablosu***************/

	$tablo121 = "CREATE TABLE `$tablo_portal_siteekle` (
	`site_id` int(11) unsigned NOT NULL auto_increment,
	`dal_no` int(11) NOT NULL,
	`tarih` int(11) unsigned NOT NULL default '0',
	`site_title` varchar(60) NOT NULL default '',
	`adres` varchar(100) NOT NULL,
	`site_onay` varchar(2) NOT NULL default '0',
	`aciklama` varchar(250) NOT NULL,
	`ekleyen` varchar(25) NOT NULL,
	`tiklama_sayisi` int(11) unsigned default '0',
	`site_oy` int(11) NOT NULL default '0',
	`site_resim` text NOT NULL,
	`oy_verenler` text NOT NULL,
	PRIMARY KEY  (`site_id`),
	KEY `tarih` (`tarih`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8";

	$sonuc171 = $vt->query($tablo121) or die ($vt->hata_ver());
	$tarih = time();
	$icerik82 = "INSERT INTO `$tablo_portal_siteekle` (`site_id`, `dal_no`, `tarih`, `site_title`, `adres`, `site_onay`, `aciklama`, `ekleyen`, `tiklama_sayisi`, `site_oy`, `site_resim`, `oy_verenler`) VALUES(1, 1, $tarih, 'phpKF (php Kolay Forum ve Portal)', 'http://www.phpkf.com', '1', '%100 Türk yapımı Forum ve Portal Sistemleri.', 'ByLegenS', 0, 0, './temalar/varsayilan/resimler/resimler/indir.gif', ',');";
	$sonucc22 = $vt->query($icerik82) or die ($vt->hata_ver());


	/***************Favori Siteler Kategori Tablosu***************/

	$tablo122 = "CREATE TABLE `$tablo_portal_siteekledal` (
	`dal_no` int(11) unsigned NOT NULL auto_increment,
	`tarih` int(11) unsigned NOT NULL default '0',
	`baslik` varchar(60) NOT NULL,
	PRIMARY KEY  (`dal_no`),
	KEY `tarih` (`tarih`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8";

	$sonuc172 = $vt->query($tablo122) or die ($vt->hata_ver());
	$tarih = time();
	$icerik8 = "INSERT INTO `$tablo_portal_siteekledal` VALUES ('1', '$tarih', 'Ana Kategori')";
	$sonucc = $vt->query($icerik8) or die ($vt->hata_ver());



	/***************Bloklar Tablosu***************/

	$tablo13 = "CREATE TABLE `$tablo_portal_bloklar` (
	`blok_id` mediumint(5) unsigned NOT NULL auto_increment,
	`blok_ad` varchar(30) NOT NULL,
	`blok_yer` tinyint(1) unsigned NOT NULL,
	`blok_sira` tinyint(2) unsigned NOT NULL,
	`blok_acik` tinyint(1) unsigned default '1',
	UNIQUE KEY `id` (`blok_id`),
	KEY `blok_ad` (`blok_ad`),
	KEY `blok_yer` (`blok_yer`),
	KEY `blok_sira` (`blok_sira`),
	KEY `blok_acik` (`blok_acik`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sonuc18 = $vt->query($tablo13) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (1, 'sol_bloklar', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (2, 'sag_bloklar', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (3, 'davetiye_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (4, 'siteharitasi_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (5, 'anketler_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (6, 'dosyalar_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (7, 'galeri_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (8, 'haber_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (9, 'arama_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (10, 'siteler_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (11, 'takvim_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (12, 'duyuru', 2, 1, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (13, 'haber', 2, 2, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (14, 'son_mesajlar', 2, 3, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (15, 'portal_menusu', 1, 1, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (16, 'kullanici_masasi', 1, 2, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (17, 'forumlar', 1, 3, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (18, 'istatistikler', 1, 4, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (19, 'dogum_gunleri', 1, 5, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (20, 'takvim', 3, 1, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (21, 'encok_mesaj_atanlar', 3, 2, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (22, 'son_uyeler', 3, 3, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (23, 'resim_blok', 3, 4, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (24, 'dosyalar_blok', 3, 5, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (25, 'cevrimici_blok', 3, 6, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (26, 'son_anket', 3, 7, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());
	
	$portal_bloklar = "INSERT INTO `$tablo_portal_bloklar` VALUES (27, 'favori_siteler', 1, 6, 1);";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());
	
	$portal_bloklar = "INSERT INTO `$tablo_portal_bloklar` VALUES (28, 'haber_kategori_blok', 3, 8, 1);";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());
	
	$portal_bloklar = "INSERT INTO `$tablo_portal_bloklar` VALUES (29, 'galeri_kategori_blok', 1, 7, 1);";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());
	
	$tablo_blok_sil = "DROP TABLE $tablo_portal_blok";
	$tablo_blok_sil_sonuc = $vt->query($tablo_blok_sil) or die ($vt->hata_ver());

	
	
	$resim_genislik = "ALTER TABLE `$tablo_portal_galeri` ADD `resim_genislik` varchar(6) NOT NULL default'1024'";
	$resim_genislik_sonuc = $vt->query($resim_genislik) or die ($vt->hata_ver());

	$resim_yukseklik = "ALTER TABLE `$tablo_portal_galeri` ADD `resim_yukseklik` varchar(6) NOT NULL default'768'";
	$resim_yukseklik_sonuc = $vt->query($resim_yukseklik) or die ($vt->hata_ver());
	
		
		
	}
	// SÜRÜM 1.20 İSE //
	elseif ( (isset($portal_ayarlar['portal_surum'])) AND ($portal_ayarlar['portal_surum'] == '1.20') )
	{
	
		$ornek1->kosul('5', array('' => ''), false);
		
		
	$portal_portal_surum = "UPDATE `$tablo_ayarlar` SET deger='1' WHERE etiket='portal_kullan' LIMIT 1";
	$portal_portal_surum_sonuc = $vt->query($portal_portal_surum) or die ($vt->hata_ver());

	$portal_portal_surum = "UPDATE `$tablo_portal_ayarlar` SET sayi='$version' WHERE isim='portal_surum' LIMIT 1";
	$portal_portal_surum_sonuc = $vt->query($portal_portal_surum) or die ($vt->hata_ver());
	
	$siteler_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('siteler_limit', '15');";
	$siteler_limit_sonucu = $vt->query($siteler_limit) or die ($vt->hata_ver());
	
	$siteler_dal_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('siteler_dal_limit', '10');";
	$siteler_dal_limit_sonucu = $vt->query($siteler_dal_limit) or die ($vt->hata_ver());
	
	$haber_dal_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('haber_dal_limit', '10');";
	$haber_dal_limit_sonucu = $vt->query($haber_dal_limit) or die ($vt->hata_ver());
	
	$haber_dalalt_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('haber_dalalt_limit', '10');";
	$haber_dalalt_limit_sonucu = $vt->query($haber_dalalt_limit) or die ($vt->hata_ver());
	
	$anket_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('anket_limit', '10');";
	$anket_limit_sonucu = $vt->query($anket_limit) or die ($vt->hata_ver());
	
	$dosya_dal_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('dosya_dal_limit', '10');";
	$dosya_dal_limit_sonucu = $vt->query($dosya_dal_limit) or die ($vt->hata_ver());
	
	$resim_ekleme = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('sil_anahtar', '$sil_anahtar')";
	$resim_ekleme_sonuc = $vt->query($resim_ekleme) or die ($vt->hata_ver());
	
	$haber_kaynagi = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('haber_kaynagi', '0');";
	$haber_kaynagi_sonucu = $vt->query($haber_kaynagi) or die ($vt->hata_ver());
	
	$blok_sekli = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_sekli', 'varsayilan_blok_tasarimi');";
	$blok_sekli_sonucu = $vt->query($blok_sekli) or die ($vt->hata_ver());
	
	$en_cok_mesaj_atanlar = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('en_cok_mesaj_atanlar', '10');";
	$en_cok_mesaj_atanlar_sonucu = $vt->query($en_cok_mesaj_atanlar) or die ($vt->hata_ver());

	$son_uyeler = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('son_uyeler', '10');";
	$son_uyeler_sonucu = $vt->query($son_uyeler) or die ($vt->hata_ver());
	
	$blok_dosya_kategorileri = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_dosya_kategorileri', '10');";
	$blok_dosya_kategorileri_sonucu = $vt->query($blok_dosya_kategorileri) or die ($vt->hata_ver());

	$blok_haber_kategorileri = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_haber_kategorileri', '10');";
	$blok_haber_kategorileri_sonucu = $vt->query($blok_haber_kategorileri) or die ($vt->hata_ver());

	$blok_galeri_kategorileri = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_galeri_kategorileri', '10');";
	$blok_galeri_kategorileri_sonucu = $vt->query($blok_galeri_kategorileri) or die ($vt->hata_ver());

	$blok_siteler_kategorileri = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_siteler_kategorileri', '10');";
	$blok_siteler_kategorileri_sonucu = $vt->query($blok_siteler_kategorileri) or die ($vt->hata_ver());

	$karakter_sinirlamasi = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('karakter_sinirlamasi', '750');";
	$karakter_sinirlamasi_sonucu = $vt->query($karakter_sinirlamasi) or die ($vt->hata_ver());

	$haberlere_giris_izni = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('haberlere_giris_izni', '1');";
	$haberlere_giris_izni_sonucu = $vt->query($haberlere_giris_izni) or die ($vt->hata_ver());







	/***************Haber Kategori Tablosu***************/
	$tablo122 = "CREATE TABLE `$tablo_portal_haberdal` (
	`id` int(11) NOT NULL auto_increment,
	`dal` varchar(100) NOT NULL,
	`tarih` int(11) unsigned NOT NULL default '0',
	PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sonuc123 = $vt->query($tablo122) or die ($vt->hata_ver());
	$tarih = time();
	$haber1 = "INSERT INTO `$tablo_portal_haberdal` VALUES (1, 'Ana Kategori', $tarih)";
	$haber_sonucu1 = $vt->query($haber1) or die ($vt->hata_ver());
	
	$portal_haber = "ALTER TABLE `$tablo_portal_haberler` ADD `dal_id` int(11) unsigned NOT NULL default '1'";
	$portal_haber_sonuc = $vt->query($portal_haber) or die ($vt->hata_ver());

	/***************Favori Siteler Tablosu***************/

	$tablo121 = "CREATE TABLE `$tablo_portal_siteekle` (
	`site_id` int(11) unsigned NOT NULL auto_increment,
	`dal_no` int(11) NOT NULL,
	`tarih` int(11) unsigned NOT NULL default '0',
	`site_title` varchar(60) NOT NULL default '',
	`adres` varchar(100) NOT NULL,
	`site_onay` varchar(2) NOT NULL default '0',
	`aciklama` varchar(250) NOT NULL,
	`ekleyen` varchar(25) NOT NULL,
	`tiklama_sayisi` int(11) unsigned default '0',
	`site_oy` int(11) NOT NULL default '0',
	`site_resim` text NOT NULL,
	`oy_verenler` text NOT NULL,
	PRIMARY KEY  (`site_id`),
	KEY `tarih` (`tarih`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8";

	$sonuc171 = $vt->query($tablo121) or die ($vt->hata_ver());
	$tarih = time();
	$icerik82 = "INSERT INTO `$tablo_portal_siteekle` (`site_id`, `dal_no`, `tarih`, `site_title`, `adres`, `site_onay`, `aciklama`, `ekleyen`, `tiklama_sayisi`, `site_oy`, `site_resim`, `oy_verenler`) VALUES(1, 1, $tarih, 'phpKF (php Kolay Forum ve Portal)', 'http://www.phpkf.com', '1', '%100 Türk yapımı Forum ve Portal Sistemleri.', 'ByLegenS', 0, 0, './temalar/varsayilan/resimler/resimler/indir.gif', ',');";
	$sonucc22 = $vt->query($icerik82) or die ($vt->hata_ver());


	/***************Favori Siteler Kategori Tablosu***************/

	$tablo122 = "CREATE TABLE `$tablo_portal_siteekledal` (
	`dal_no` int(11) unsigned NOT NULL auto_increment,
	`tarih` int(11) unsigned NOT NULL default '0',
	`baslik` varchar(60) NOT NULL,
	PRIMARY KEY  (`dal_no`),
	KEY `tarih` (`tarih`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8";

	$sonuc172 = $vt->query($tablo122) or die ($vt->hata_ver());
	$tarih = time();
	$icerik8 = "INSERT INTO `$tablo_portal_siteekledal` VALUES ('1', '$tarih', 'Ana Kategori')";
	$sonucc = $vt->query($icerik8) or die ($vt->hata_ver());



	/***************Bloklar Tablosu***************/

	$tablo13 = "CREATE TABLE `$tablo_portal_bloklar` (
	`blok_id` mediumint(5) unsigned NOT NULL auto_increment,
	`blok_ad` varchar(30) NOT NULL,
	`blok_yer` tinyint(1) unsigned NOT NULL,
	`blok_sira` tinyint(2) unsigned NOT NULL,
	`blok_acik` tinyint(1) unsigned default '1',
	UNIQUE KEY `id` (`blok_id`),
	KEY `blok_ad` (`blok_ad`),
	KEY `blok_yer` (`blok_yer`),
	KEY `blok_sira` (`blok_sira`),
	KEY `blok_acik` (`blok_acik`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sonuc18 = $vt->query($tablo13) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (1, 'sol_bloklar', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (2, 'sag_bloklar', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (3, 'davetiye_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (4, 'siteharitasi_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (5, 'anketler_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (6, 'dosyalar_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (7, 'galeri_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (8, 'haber_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (9, 'arama_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (10, 'siteler_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (11, 'takvim_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (12, 'duyuru', 2, 1, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (13, 'haber', 2, 2, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (14, 'son_mesajlar', 2, 3, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (15, 'portal_menusu', 1, 1, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (16, 'kullanici_masasi', 1, 2, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (17, 'forumlar', 1, 3, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (18, 'istatistikler', 1, 4, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (19, 'dogum_gunleri', 1, 5, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (20, 'takvim', 3, 1, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (21, 'encok_mesaj_atanlar', 3, 2, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (22, 'son_uyeler', 3, 3, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (23, 'resim_blok', 3, 4, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (24, 'dosyalar_blok', 3, 5, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (25, 'cevrimici_blok', 3, 6, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (26, 'son_anket', 3, 7, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());
	
	$portal_bloklar = "INSERT INTO `$tablo_portal_bloklar` VALUES (27, 'favori_siteler', 1, 6, 1);";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());
	
	$portal_bloklar = "INSERT INTO `$tablo_portal_bloklar` VALUES (28, 'haber_kategori_blok', 3, 8, 1);";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());
	
	$portal_bloklar = "INSERT INTO `$tablo_portal_bloklar` VALUES (29, 'galeri_kategori_blok', 1, 7, 1);";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());
	
	$tablo_blok_sil = "DROP TABLE $tablo_portal_blok";
	$tablo_blok_sil_sonuc = $vt->query($tablo_blok_sil) or die ($vt->hata_ver());

	
	
	$resim_genislik = "ALTER TABLE `$tablo_portal_galeri` ADD `resim_genislik` varchar(6) NOT NULL default'1024'";
	$resim_genislik_sonuc = $vt->query($resim_genislik) or die ($vt->hata_ver());

	$resim_yukseklik = "ALTER TABLE `$tablo_portal_galeri` ADD `resim_yukseklik` varchar(6) NOT NULL default'768'";
	$resim_yukseklik_sonuc = $vt->query($resim_yukseklik) or die ($vt->hata_ver());
	


	}	
	// SÜRÜM 1.10 İSE //
	elseif ( (isset($portal_ayarlar['portal_surum'])) AND ($portal_ayarlar['portal_surum'] == '1.10') )
	{
		
		$ornek1->kosul('5', array('' => ''), false);
		
		
		
	$portal_portal_surum = "UPDATE `$tablo_ayarlar` SET deger='1' WHERE etiket='portal_kullan' LIMIT 1";
	$portal_portal_surum_sonuc = $vt->query($portal_portal_surum) or die ($vt->hata_ver());

	$portal_portal_surum = "UPDATE `$tablo_portal_ayarlar` SET sayi='$version' WHERE isim='portal_surum' LIMIT 1";
	$portal_portal_surum_sonuc = $vt->query($portal_portal_surum) or die ($vt->hata_ver());

	$galeri_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('galeri_limit', '10');";
	$galeri_limit_sonucu = $vt->query($galeri_limit) or die ($vt->hata_ver());

	$galeri_kb = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('galeri_kb', '200000');";
	$galeri_kb_sonucu = $vt->query($galeri_kb) or die ($vt->hata_ver());

	$haber_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('haber_limit', '5');";
	$haber_limit_sonucu = $vt->query($haber_limit) or die ($vt->hata_ver());
	
	$siteler_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('siteler_limit', '15');";
	$siteler_limit_sonucu = $vt->query($siteler_limit) or die ($vt->hata_ver());
	
	$siteler_dal_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('siteler_dal_limit', '10');";
	$siteler_dal_limit_sonucu = $vt->query($siteler_dal_limit) or die ($vt->hata_ver());
	
	$haber_dal_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('haber_dal_limit', '10');";
	$haber_dal_limit_sonucu = $vt->query($haber_dal_limit) or die ($vt->hata_ver());
	
	$haber_dalalt_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('haber_dalalt_limit', '10');";
	$haber_dalalt_limit_sonucu = $vt->query($haber_dalalt_limit) or die ($vt->hata_ver());
	
	$anket_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('anket_limit', '10');";
	$anket_limit_sonucu = $vt->query($anket_limit) or die ($vt->hata_ver());
	
	$dosya_dal_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('dosya_dal_limit', '10');";
	$dosya_dal_limit_sonucu = $vt->query($dosya_dal_limit) or die ($vt->hata_ver());

	$resim_ekleme = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('resim_ekleme', '1')";
	$resim_ekleme_sonuc = $vt->query($resim_ekleme) or die ($vt->hata_ver());

	$portal_anket_yorum = "ALTER TABLE `$tablo_portal_anketsoru` ADD anket_yorum varchar(1) NOT NULL default '1'";
	$portal_anket_yorum_sonuc = $vt->query($portal_anket_yorum) or die ($vt->hata_ver());
	
	$resim_ekleme = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('sil_anahtar', '$sil_anahtar')";
	$resim_ekleme_sonuc = $vt->query($resim_ekleme) or die ($vt->hata_ver());
	
	$haber_kaynagi = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('haber_kaynagi', '0');";
	$haber_kaynagi_sonucu = $vt->query($haber_kaynagi) or die ($vt->hata_ver());
	
	$blok_sekli = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_sekli', 'varsayilan_blok_tasarimi');";
	$blok_sekli_sonucu = $vt->query($blok_sekli) or die ($vt->hata_ver());
	
	$en_cok_mesaj_atanlar = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('en_cok_mesaj_atanlar', '10');";
	$en_cok_mesaj_atanlar_sonucu = $vt->query($en_cok_mesaj_atanlar) or die ($vt->hata_ver());

	$son_uyeler = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('son_uyeler', '10');";
	$son_uyeler_sonucu = $vt->query($son_uyeler) or die ($vt->hata_ver());
	
	$blok_dosya_kategorileri = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_dosya_kategorileri', '10');";
	$blok_dosya_kategorileri_sonucu = $vt->query($blok_dosya_kategorileri) or die ($vt->hata_ver());

	$blok_haber_kategorileri = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_haber_kategorileri', '10');";
	$blok_haber_kategorileri_sonucu = $vt->query($blok_haber_kategorileri) or die ($vt->hata_ver());

	$blok_galeri_kategorileri = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_galeri_kategorileri', '10');";
	$blok_galeri_kategorileri_sonucu = $vt->query($blok_galeri_kategorileri) or die ($vt->hata_ver());

	$blok_siteler_kategorileri = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_siteler_kategorileri', '10');";
	$blok_siteler_kategorileri_sonucu = $vt->query($blok_siteler_kategorileri) or die ($vt->hata_ver());

	$karakter_sinirlamasi = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('karakter_sinirlamasi', '750');";
	$karakter_sinirlamasi_sonucu = $vt->query($karakter_sinirlamasi) or die ($vt->hata_ver());

	$haberlere_giris_izni = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('haberlere_giris_izni', '1');";
	$haberlere_giris_izni_sonucu = $vt->query($haberlere_giris_izni) or die ($vt->hata_ver());









	/***************Favori Siteler Tablosu***************/

	$tablo121 = "CREATE TABLE `$tablo_portal_siteekle` (
	`site_id` int(11) unsigned NOT NULL auto_increment,
	`dal_no` int(11) NOT NULL,
	`tarih` int(11) unsigned NOT NULL default '0',
	`site_title` varchar(60) NOT NULL default '',
	`adres` varchar(100) NOT NULL,
	`site_onay` varchar(2) NOT NULL default '0',
	`aciklama` varchar(250) NOT NULL,
	`ekleyen` varchar(25) NOT NULL,
	`tiklama_sayisi` int(11) unsigned default '0',
	`site_oy` int(11) NOT NULL default '0',
	`site_resim` text NOT NULL,
	`oy_verenler` text NOT NULL,
	PRIMARY KEY  (`site_id`),
	KEY `tarih` (`tarih`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8";

	$sonuc171 = $vt->query($tablo121) or die ($vt->hata_ver());
	$tarih = time();
	$icerik82 = "INSERT INTO `$tablo_portal_siteekle` (`site_id`, `dal_no`, `tarih`, `site_title`, `adres`, `site_onay`, `aciklama`, `ekleyen`, `tiklama_sayisi`, `site_oy`, `site_resim`, `oy_verenler`) VALUES(1, 1, $tarih, 'phpKF (php Kolay Forum ve Portal)', 'http://www.phpkf.com', '1', '%100 Türk yapımı Forum ve Portal Sistemleri.', 'ByLegenS', 0, 0, './temalar/varsayilan/resimler/resimler/indir.gif', ',');";
	$sonucc22 = $vt->query($icerik82) or die ($vt->hata_ver());


	/***************Favori Siteler Kategori Tablosu***************/

	$tablo122 = "CREATE TABLE `$tablo_portal_siteekledal` (
	`dal_no` int(11) unsigned NOT NULL auto_increment,
	`tarih` int(11) unsigned NOT NULL default '0',
	`baslik` varchar(60) NOT NULL,
	PRIMARY KEY  (`dal_no`),
	KEY `tarih` (`tarih`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8";

	$sonuc172 = $vt->query($tablo122) or die ($vt->hata_ver());
	$tarih = time();
	$icerik8 = "INSERT INTO `$tablo_portal_siteekledal` VALUES ('1', '$tarih', 'Ana Kategori')";
	$sonucc = $vt->query($icerik8) or die ($vt->hata_ver());



	/***************Galeri Dal Tablosu***************/

	$tablo9 = "CREATE TABLE `$tablo_portal_galeridal` (
	`id` int(11) NOT NULL auto_increment,
	`dal` varchar(100) NOT NULL,
	`tarih` int(11) unsigned NOT NULL default '0',
	PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sonuc14 = $vt->query($tablo9) or die ($vt->hata_ver());


	/***************Galeri Tablosu***************/

	$tablo10 = "CREATE TABLE `$tablo_portal_galeri` (
	`no` mediumint(8) unsigned NOT NULL auto_increment,
	`id` int(11) NOT NULL,
	`resim` text NOT NULL,
	`tarih` int(11) unsigned NOT NULL default '0',
	`isim` varchar(30) NOT NULL default '',
	`boyut` varchar(20) NOT NULL,
	`aciklama` text NOT NULL,
	`puan_verenler` text NOT NULL,
	`ekleyen` varchar(20) NOT NULL default '',
	`resim_onay` varchar(10) NOT NULL,
	`puan` varchar(20) NOT NULL default '0',
	`sifrelenmis_resim_adi` varchar(20) default NULL,
	`resim_genislik` varchar(6) NOT NULL default '1024',
	`resim_yukseklik` varchar(6) NOT NULL default '768',
	PRIMARY KEY  (`no`),
	KEY `tarih` (`tarih`),
	KEY `id` (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sonuc15 = $vt->query($tablo10) or die ($vt->hata_ver());


	/***************Haber Kategori Tablosu***************/
	$tablo122 = "CREATE TABLE `$tablo_portal_haberdal` (
	`id` int(11) NOT NULL auto_increment,
	`dal` varchar(100) NOT NULL,
	`tarih` int(11) unsigned NOT NULL default '0',
	PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sonuc123 = $vt->query($tablo122) or die ($vt->hata_ver());
	$tarih = time();
	$haber1 = "INSERT INTO `$tablo_portal_haberdal` VALUES (1, 'Ana Kategori', $tarih)";
	$haber_sonucu1 = $vt->query($haber1) or die ($vt->hata_ver());


	/***************Haber Tablosu***************/

	$tablo11 = "CREATE TABLE `$tablo_portal_haberler` (
	`id` int(11) unsigned NOT NULL auto_increment,
	`dal_id` int(11) unsigned NOT NULL default '1',
	`baslik` varchar(50) NOT NULL,
	`icerik` text,
	`etiket` text,
	`yazan` varchar(21) NOT NULL default '',
	`onay` varchar(5) NOT NULL,
	`ip_adresi` varchar(15) NOT NULL,
	`tarih` int(11) unsigned NOT NULL default '0',
	`okunma_sayisi` mediumint(8) unsigned NOT NULL default '0',
	`bbcode_kullan` tinyint(1) NOT NULL default '0',
	`yorum` tinyint(1) NOT NULL default '1',
	PRIMARY KEY  (`id`),
	KEY `tarih` (`tarih`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sonuc16 = $vt->query($tablo11) or die ($vt->hata_ver());
	$tarih = time();
	$haber = "INSERT INTO `$tablo_portal_haberler` VALUES ('1','1','Haber Özelliği', 'Bu yeni sürümle birlikte haber kategori özelliği gelmiştir.\n\nYeni haber kategorisi ekleyin ve diğer haberlerinizi yeni eklediğiniz kategoriye aktarın\n\nyeni kategori eklemek için lütfen ( Portal Yönetimine gidiniz )', 'phpkf,phpkf-p,sürüm', '$kullanici_kim[kullanici_adi]', '1', '127.0.0.1', '$tarih', '0', '1', '1');";
	$haber_sonucu = $vt->query($haber) or die ($vt->hata_ver());


	/***************Haber Yorum Tablosu***************/

	$tablo12 = "CREATE TABLE `$tablo_portal_haberyorum` (
	`id` int(11) unsigned NOT NULL auto_increment,
	`haber_id` int(11) NOT NULL,
	`icerik` text,
	`yazan` varchar(21) NOT NULL default '',
	`tarih` int(11) unsigned NOT NULL default '0',
	PRIMARY KEY  (`id`),
	KEY `tarih` (`tarih`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sonuc17 = $vt->query($tablo12) or die ($vt->hata_ver());



	/***************Bloklar Tablosu***************/

	$tablo13 = "CREATE TABLE `$tablo_portal_bloklar` (
	`blok_id` mediumint(5) unsigned NOT NULL auto_increment,
	`blok_ad` varchar(30) NOT NULL,
	`blok_yer` tinyint(1) unsigned NOT NULL,
	`blok_sira` tinyint(2) unsigned NOT NULL,
	`blok_acik` tinyint(1) unsigned default '1',
	UNIQUE KEY `id` (`blok_id`),
	KEY `blok_ad` (`blok_ad`),
	KEY `blok_yer` (`blok_yer`),
	KEY `blok_sira` (`blok_sira`),
	KEY `blok_acik` (`blok_acik`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sonuc18 = $vt->query($tablo13) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (1, 'sol_bloklar', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (2, 'sag_bloklar', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (3, 'davetiye_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (4, 'siteharitasi_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (5, 'anketler_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (6, 'dosyalar_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (7, 'galeri_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (8, 'haber_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (9, 'arama_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (10, 'siteler_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (11, 'takvim_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (12, 'duyuru', 2, 1, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (13, 'haber', 2, 2, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (14, 'son_mesajlar', 2, 3, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (15, 'portal_menusu', 1, 1, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (16, 'kullanici_masasi', 1, 2, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (17, 'forumlar', 1, 3, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (18, 'istatistikler', 1, 4, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (19, 'dogum_gunleri', 1, 5, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (20, 'takvim', 3, 1, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (21, 'encok_mesaj_atanlar', 3, 2, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (22, 'son_uyeler', 3, 3, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (23, 'resim_blok', 3, 4, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (24, 'dosyalar_blok', 3, 5, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (25, 'cevrimici_blok', 3, 6, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (26, 'son_anket', 3, 7, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());
	
	$portal_bloklar = "INSERT INTO `$tablo_portal_bloklar` VALUES (27, 'favori_siteler', 1, 6, 1);";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());
	
	$portal_bloklar = "INSERT INTO `$tablo_portal_bloklar` VALUES (28, 'haber_kategori_blok', 3, 8, 1);";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());
	
	$portal_bloklar = "INSERT INTO `$tablo_portal_bloklar` VALUES (29, 'galeri_kategori_blok', 1, 7, 1);";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());
	
	$tablo_blok_sil = "DROP TABLE $tablo_portal_blok";
	$tablo_blok_sil_sonuc = $vt->query($tablo_blok_sil) or die ($vt->hata_ver());


	$tablo14 = "CREATE TABLE `$tablo_portal_anketyorum` (
	`id` int(11) unsigned NOT NULL auto_increment,
	`anketno` int(11) NOT NULL,
	`icerik` text,
	`yazan` varchar(21) NOT NULL default '',
	`tarih` int(11) unsigned NOT NULL default '0',
	PRIMARY KEY  (`id`),
	KEY `tarih` (`tarih`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sonuc19 = $vt->query($tablo14) or die ($vt->hata_ver());

	$tablo15 = "CREATE TABLE `$tablo_portal_sayfa` (
	`sayfa_no` mediumint(8) unsigned NOT NULL auto_increment,
	`tarih` int(11) unsigned NOT NULL default '0',
	`baslik` varchar(60) NOT NULL default '',
	`dosya_adi` text NOT NULL,
	`dosya_adresi` text NOT NULL,
	`kosul_adi` varchar(20) NOT NULL,
	`uzanti` varchar(10) NOT NULL,
	`yer` tinyint(1) NOT NULL,
	PRIMARY KEY  (`sayfa_no`),
	KEY `tarih` (`tarih`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
	$sonuc20 = $vt->query($tablo15) or die ($vt->hata_ver());

	
	
	}
	// SÜRÜM 1.0 İSE //
	elseif (!isset($portal_ayarlar['portal_surum']))
	{
	
		$ornek1->kosul('5', array('' => ''), false);
		
		

	/***************Favori Siteler Tablosu***************/

	$tablo121 = "CREATE TABLE `$tablo_portal_siteekle` (
	`site_id` int(11) unsigned NOT NULL auto_increment,
	`dal_no` int(11) NOT NULL,
	`tarih` int(11) unsigned NOT NULL default '0',
	`site_title` varchar(60) NOT NULL default '',
	`adres` varchar(100) NOT NULL,
	`site_onay` varchar(2) NOT NULL default '0',
	`aciklama` varchar(250) NOT NULL,
	`ekleyen` varchar(25) NOT NULL,
	`tiklama_sayisi` int(11) unsigned default '0',
	`site_oy` int(11) NOT NULL default '0',
	`site_resim` text NOT NULL,
	`oy_verenler` text NOT NULL,
	PRIMARY KEY  (`site_id`),
	KEY `tarih` (`tarih`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8";

	$sonuc171 = $vt->query($tablo121) or die ($vt->hata_ver());
	$tarih = time();
	$icerik82 = "INSERT INTO `$tablo_portal_siteekle` (`site_id`, `dal_no`, `tarih`, `site_title`, `adres`, `site_onay`, `aciklama`, `ekleyen`, `tiklama_sayisi`, `site_oy`, `site_resim`, `oy_verenler`) VALUES(1, 1, $tarih, 'phpKF (php Kolay Forum ve Portal)', 'http://www.phpkf.com', '1', '%100 Türk yapımı Forum ve Portal Sistemleri.', 'ByLegenS', 0, 0, './temalar/varsayilan/resimler/resimler/indir.gif', ',');";
	$sonucc22 = $vt->query($icerik82) or die ($vt->hata_ver());

	/***************Favori Siteler Kategori Tablosu***************/

	$tablo122 = "CREATE TABLE `$tablo_portal_siteekledal` (
	`dal_no` int(11) unsigned NOT NULL auto_increment,
	`tarih` int(11) unsigned NOT NULL default '0',
	`baslik` varchar(60) NOT NULL,
	PRIMARY KEY  (`dal_no`),
	KEY `tarih` (`tarih`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8";

	$sonuc172 = $vt->query($tablo122) or die ($vt->hata_ver());
	$tarih = time();
	$icerik8 = "INSERT INTO `$tablo_portal_siteekledal` VALUES ('1', '$tarih', 'Ana Kategori')";
	$sonucc = $vt->query($icerik8) or die ($vt->hata_ver());

	$portal_portal_surum = "UPDATE `$tablo_ayarlar` SET deger='1' WHERE etiket='portal_kullan' LIMIT 1";
	$portal_portal_surum_sonuc = $vt->query($portal_portal_surum) or die ($vt->hata_ver());

	$galeri_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('galeri_limit', '10');";
	$galeri_limit_sonucu = $vt->query($galeri_limit) or die ($vt->hata_ver());

	$galeri_kb = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('galeri_kb', '200000');";
	$galeri_kb_sonucu = $vt->query($galeri_kb) or die ($vt->hata_ver());

	$haber_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('haber_limit', '5');";
	$haber_limit_sonucu = $vt->query($haber_limit) or die ($vt->hata_ver());
	
	$siteler_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('siteler_limit', '15');";
	$siteler_limit_sonucu = $vt->query($siteler_limit) or die ($vt->hata_ver());
	
	$siteler_dal_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('siteler_dal_limit', '10');";
	$siteler_dal_limit_sonucu = $vt->query($siteler_dal_limit) or die ($vt->hata_ver());
	
	$haber_dal_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('haber_dal_limit', '10');";
	$haber_dal_limit_sonucu = $vt->query($haber_dal_limit) or die ($vt->hata_ver());
	
	$haber_dalalt_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('haber_dalalt_limit', '10');";
	$haber_dalalt_limit_sonucu = $vt->query($haber_dalalt_limit) or die ($vt->hata_ver());
	
	$anket_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('anket_limit', '10');";
	$anket_limit_sonucu = $vt->query($anket_limit) or die ($vt->hata_ver());
	
	$dosya_dal_limit = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('dosya_dal_limit', '10');";
	$dosya_dal_limit_sonucu = $vt->query($dosya_dal_limit) or die ($vt->hata_ver());

	$resim_ekleme = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('resim_ekleme', '1')";
	$resim_ekleme_sonuc = $vt->query($resim_ekleme) or die ($vt->hata_ver());

	$portal_surum = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('portal_surum', '$version')";
	$portal_surum_sonuc = $vt->query($portal_surum) or die ($vt->hata_ver());
	
	$haber_kaynagi = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('haber_kaynagi', '0');";
	$haber_kaynagi_sonucu = $vt->query($haber_kaynagi) or die ($vt->hata_ver());
	
	$blok_sekli = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_sekli', 'varsayilan_blok_tasarimi');";
	$blok_sekli_sonucu = $vt->query($blok_sekli) or die ($vt->hata_ver());
	
	$en_cok_mesaj_atanlar = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('en_cok_mesaj_atanlar', '10');";
	$en_cok_mesaj_atanlar_sonucu = $vt->query($en_cok_mesaj_atanlar) or die ($vt->hata_ver());

	$son_uyeler = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('son_uyeler', '10');";
	$son_uyeler_sonucu = $vt->query($son_uyeler) or die ($vt->hata_ver());
	
	$blok_dosya_kategorileri = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_dosya_kategorileri', '10');";
	$blok_dosya_kategorileri_sonucu = $vt->query($blok_dosya_kategorileri) or die ($vt->hata_ver());

	$blok_haber_kategorileri = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_haber_kategorileri', '10');";
	$blok_haber_kategorileri_sonucu = $vt->query($blok_haber_kategorileri) or die ($vt->hata_ver());

	$blok_galeri_kategorileri = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_galeri_kategorileri', '10');";
	$blok_galeri_kategorileri_sonucu = $vt->query($blok_galeri_kategorileri) or die ($vt->hata_ver());

	$blok_siteler_kategorileri = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('blok_siteler_kategorileri', '10');";
	$blok_siteler_kategorileri_sonucu = $vt->query($blok_siteler_kategorileri) or die ($vt->hata_ver());

	$karakter_sinirlamasi = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('karakter_sinirlamasi', '750');";
	$karakter_sinirlamasi_sonucu = $vt->query($karakter_sinirlamasi) or die ($vt->hata_ver());

	$haberlere_giris_izni = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('haberlere_giris_izni', '1');";
	$haberlere_giris_izni_sonucu = $vt->query($haberlere_giris_izni) or die ($vt->hata_ver());

	$portal_davetiye = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('davetiye', '2')";
	$portal_davetiye_sonuc = $vt->query($portal_davetiye) or die ($vt->hata_ver());
	
	$resim_ekleme = "INSERT INTO `$tablo_portal_ayarlar` VALUES ('sil_anahtar', '$sil_anahtar')";
	$resim_ekleme_sonuc = $vt->query($resim_ekleme) or die ($vt->hata_ver());

	$portal_anket_durum = "ALTER TABLE `$tablo_portal_anketsoru` ADD anket_durum varchar(6) NOT NULL default '1'";
	$portal_anket_durum_sonuc = $vt->query($portal_anket_durum) or die ($vt->hata_ver());

	$portal_anket_yorum = "ALTER TABLE `$tablo_portal_anketsoru` ADD anket_yorum varchar(1) NOT NULL default '1'";
	$portal_anket_yorum_sonuc = $vt->query($portal_anket_yorum) or die ($vt->hata_ver());

	$portal_anket_oy_kullanan_id = "ALTER TABLE `$tablo_portal_anketsoru` ADD `oy_kullanan_id` text";
	$portal_anket_oy_kullanan_id_sonuc = $vt->query($portal_anket_oy_kullanan_id) or die ($vt->hata_ver());

	$sorgu_baslat = "select oy_kullanan_id,anketno from $tablo_portal_anketoylar";
	$sorgu_baslat_sonuc = $vt->query($sorgu_baslat);
	while ($sonuc1 = $vt->fetch_assoc($sorgu_baslat_sonuc))
	{

	$sorgu_baslat11 = "select * from $tablo_portal_anketsoru where anketno='$sonuc1[anketno]'";
	$sorgu_baslat_sonuc11 = $vt->query($sorgu_baslat11);

	while ($sonuc11 = $vt->fetch_assoc($sorgu_baslat_sonuc11))
	{

	$oy_kullanan_id = $sonuc1['oy_kullanan_id'];
	$oy_kullanan_id = $sonuc11['oy_kullanan_id'].$oy_kullanan_id.',';

	$strSQL11 = "update $tablo_portal_anketsoru set oy_kullanan_id='$oy_kullanan_id'  where anketno like '%$sonuc1[anketno]%'";
	$sonuc11 = $vt->query($strSQL11) or die ($vt->hata_ver());


	}	

	}

	$sorgu_baslat = "SHOW FIELDS FROM $tablo_portal_anketoylar";
	$sorgu_baslat_sonuc = $vt->query($sorgu_baslat);
	$sonuc1a = $vt->num_rows($sorgu_baslat_sonuc);

	if (isset($sonuc1a))
	{
	$sil = "drop table $tablo_portal_anketoylar";
	$sil_sonuc = $vt->query($sil) or die ($vt->hata_ver());
	}








	/***************Galeri Dal Tablosu***************/

	$tablo9 = "CREATE TABLE `$tablo_portal_galeridal` (
	`id` int(11) NOT NULL auto_increment,
	`dal` varchar(100) NOT NULL,
	`tarih` int(11) unsigned NOT NULL default '0',
	PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sonuc14 = $vt->query($tablo9) or die ($vt->hata_ver());


	/***************Galeri Tablosu***************/

	$tablo10 = "CREATE TABLE `$tablo_portal_galeri` (
	`no` mediumint(8) unsigned NOT NULL auto_increment,
	`id` int(11) NOT NULL,
	`resim` text NOT NULL,
	`tarih` int(11) unsigned NOT NULL default '0',
	`isim` varchar(30) NOT NULL default '',
	`boyut` varchar(20) NOT NULL,
	`aciklama` text NOT NULL,
	`puan_verenler` text NOT NULL,
	`ekleyen` varchar(20) NOT NULL default '',
	`resim_onay` varchar(10) NOT NULL,
	`puan` varchar(20) NOT NULL default '0',
	`sifrelenmis_resim_adi` varchar(20) default NULL,
	`resim_genislik` varchar(6) NOT NULL default '1024',
	`resim_yukseklik` varchar(6) NOT NULL default '768',
	PRIMARY KEY  (`no`),
	KEY `tarih` (`tarih`),
	KEY `id` (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sonuc15 = $vt->query($tablo10) or die ($vt->hata_ver());


	/***************Haber Kategori Tablosu***************/
	$tablo122 = "CREATE TABLE `$tablo_portal_haberdal` (
	`id` int(11) NOT NULL auto_increment,
	`dal` varchar(100) NOT NULL,
	`tarih` int(11) unsigned NOT NULL default '0',
	PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sonuc123 = $vt->query($tablo122) or die ($vt->hata_ver());
	$tarih = time();
	$haber1 = "INSERT INTO `$tablo_portal_haberdal` VALUES (1, 'Ana Kategori', $tarih)";
	$haber_sonucu1 = $vt->query($haber1) or die ($vt->hata_ver());


	/***************Haber Tablosu***************/

	$tablo11 = "CREATE TABLE `$tablo_portal_haberler` (
	`id` int(11) unsigned NOT NULL auto_increment,
	`dal_id` int(11) unsigned NOT NULL default '1',
	`baslik` varchar(50) NOT NULL,
	`icerik` text,
	`etiket` text,
	`yazan` varchar(21) NOT NULL default '',
	`onay` varchar(5) NOT NULL,
	`ip_adresi` varchar(15) NOT NULL,
	`tarih` int(11) unsigned NOT NULL default '0',
	`okunma_sayisi` mediumint(8) unsigned NOT NULL default '0',
	`bbcode_kullan` tinyint(1) NOT NULL default '0',
	`yorum` tinyint(1) NOT NULL default '1',
	PRIMARY KEY  (`id`),
	KEY `tarih` (`tarih`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sonuc16 = $vt->query($tablo11) or die ($vt->hata_ver());
	$tarih = time();
	$haber = "INSERT INTO `$tablo_portal_haberler` VALUES ('1','1','Haber Özelliği', 'Bu yeni sürümle birlikte haber kategori özelliği gelmiştir.\n\nYeni haber kategorisi ekleyin ve diğer haberlerinizi yeni eklediğiniz kategoriye aktarın\n\nyeni kategori eklemek için lütfen ( Portal Yönetimine gidiniz )', 'phpkf,phpkf-p,sürüm', '$kullanici_kim[kullanici_adi]', '1', '127.0.0.1', '$tarih', '0', '1', '1');";
	$haber_sonucu = $vt->query($haber) or die ($vt->hata_ver());


	/***************Haber Yorum Tablosu***************/

	$tablo12 = "CREATE TABLE `$tablo_portal_haberyorum` (
	`id` int(11) unsigned NOT NULL auto_increment,
	`haber_id` int(11) NOT NULL,
	`icerik` text,
	`yazan` varchar(21) NOT NULL default '',
	`tarih` int(11) unsigned NOT NULL default '0',
	PRIMARY KEY  (`id`),
	KEY `tarih` (`tarih`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sonuc17 = $vt->query($tablo12) or die ($vt->hata_ver());


	/***************Bloklar Tablosu***************/

	$tablo13 = "CREATE TABLE `$tablo_portal_bloklar` (
	`blok_id` mediumint(5) unsigned NOT NULL auto_increment,
	`blok_ad` varchar(30) NOT NULL,
	`blok_yer` tinyint(1) unsigned NOT NULL,
	`blok_sira` tinyint(2) unsigned NOT NULL,
	`blok_acik` tinyint(1) unsigned default '1',
	UNIQUE KEY `id` (`blok_id`),
	KEY `blok_ad` (`blok_ad`),
	KEY `blok_yer` (`blok_yer`),
	KEY `blok_sira` (`blok_sira`),
	KEY `blok_acik` (`blok_acik`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sonuc18 = $vt->query($tablo13) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (1, 'sol_bloklar', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (2, 'sag_bloklar', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (3, 'davetiye_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (4, 'siteharitasi_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (5, 'anketler_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (6, 'dosyalar_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (7, 'galeri_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (8, 'haber_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (9, 'arama_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (10, 'siteler_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (11, 'takvim_sayfasi', 0, 0, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (12, 'duyuru', 2, 1, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (13, 'haber', 2, 2, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (14, 'son_mesajlar', 2, 3, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (15, 'portal_menusu', 1, 1, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (16, 'kullanici_masasi', 1, 2, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (17, 'forumlar', 1, 3, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (18, 'istatistikler', 1, 4, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (19, 'dogum_gunleri', 1, 5, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (20, 'takvim', 3, 1, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (21, 'encok_mesaj_atanlar', 3, 2, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (22, 'son_uyeler', 3, 3, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (23, 'resim_blok', 3, 4, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (24, 'dosyalar_blok', 3, 5, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (25, 'cevrimici_blok', 3, 6, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());

	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES (26, 'son_anket', 3, 7, 1)";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());
	
	$portal_bloklar = "INSERT INTO `$tablo_portal_bloklar` VALUES (27, 'favori_siteler', 1, 6, 1);";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());
	
	$portal_bloklar = "INSERT INTO `$tablo_portal_bloklar` VALUES (28, 'haber_kategori_blok', 3, 8, 1);";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());
	
	$portal_bloklar = "INSERT INTO `$tablo_portal_bloklar` VALUES (29, 'galeri_kategori_blok', 1, 7, 1);";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());
	
	$tablo_blok_sil = "DROP TABLE $tablo_portal_blok";
	$tablo_blok_sil_sonuc = $vt->query($tablo_blok_sil) or die ($vt->hata_ver());


	$tablo14 = "CREATE TABLE `$tablo_portal_anketyorum` (
	`id` int(11) unsigned NOT NULL auto_increment,
	`anketno` int(11) NOT NULL,
	`icerik` text,
	`yazan` varchar(21) NOT NULL default '',
	`tarih` int(11) unsigned NOT NULL default '0',
	PRIMARY KEY  (`id`),
	KEY `tarih` (`tarih`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";


	$sonuc19 = $vt->query($tablo14) or die ($vt->hata_ver());

	$tablo15 = "CREATE TABLE `$tablo_portal_sayfa` (
	`sayfa_no` mediumint(8) unsigned NOT NULL auto_increment,
	`tarih` int(11) unsigned NOT NULL default '0',
	`baslik` varchar(60) NOT NULL default '',
	`dosya_adi` text NOT NULL,
	`dosya_adresi` text NOT NULL,
	`kosul_adi` varchar(20) NOT NULL,
	`uzanti` varchar(10) NOT NULL,
	`yer` tinyint(1) NOT NULL,
	PRIMARY KEY  (`sayfa_no`),
	KEY `tarih` (`tarih`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
	$sonuc20 = $vt->query($tablo15) or die ($vt->hata_ver());
	}

?>