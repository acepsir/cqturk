<?php

//  VERİTABANI BİLGİLERİ  //
$veritabani_cms = "



--		`bloklar` TABLOSU VERiLERi

CREATE TABLE `$tablo_bloklar` (
`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`ad` varchar(50) NOT NULL,
`sira` mediumint(8) unsigned NOT NULL,
`baslik` varchar(100) NOT NULL DEFAULT 'Yeni Blok',
`durum` tinyint(1) unsigned NOT NULL DEFAULT '0',
`ozel_blok` tinyint(1) unsigned NOT NULL DEFAULT '1',
`ozel_ikon` varchar(255) DEFAULT NULL,
`blok_genislik` varchar(20) NOT NULL DEFAULT '200px',
`adres` varchar(255) DEFAULT NULL,
`ozel_blok_kod` mediumtext,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_bloklar` VALUES (1, 'kategoriler', 1, 'Kategoriler', 2, 0, '', '200px', '', '');

INSERT INTO `$tablo_bloklar` VALUES (2, 'baglantilar', 1, 'Bağlantılar', 1, 0, '', '200px', '', '');





--		`iletisim` TABLOSU VERiLERi

CREATE TABLE IF NOT EXISTS `$tablo_iletisim` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`tarih` int(11) unsigned NOT NULL,
`ad_soyad` varchar(20) NOT NULL,
`baslik` varchar(100) NOT NULL,
`posta` varchar(100) NOT NULL,
`icerik` text NOT NULL,
`ip` varchar(15) NOT NULL,
`okundu` tinyint(1) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





--		`kategoriler` TABLOSU VERiLERi

CREATE TABLE `$tablo_kategoriler` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`adres` varchar(255) NOT NULL DEFAULT '',
`baslik` varchar(255) NOT NULL,
`bilgi` text NOT NULL,
`sira` int(11) unsigned NOT NULL DEFAULT '0',
`alt_kat` int(11) unsigned NOT NULL DEFAULT '0',
`tip` tinyint(1) unsigned NOT NULL DEFAULT '0',
`toplam` int(11) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `sira` (`sira`),
KEY `adres` (`adres`),
KEY `alt_kat` (`alt_kat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_kategoriler` VALUES (1, 'genel', 'Genel', 'Genel Kategori', 1, 0, 0, 1);

INSERT INTO `$tablo_kategoriler` VALUES (2, 'genel-galeri', 'Genel Galeri', 'Genel Galeri', 2, 0, 1, 0);

INSERT INTO `$tablo_kategoriler` VALUES (3, 'genel-video', 'Genel Video', 'Genel Video', 3, 0, 2, 0);

INSERT INTO `$tablo_kategoriler` VALUES (4, 'genel-alt-1', 'Genel Alt 1', 'Genel Alt 1', 1, 1, 0, 0);

INSERT INTO `$tablo_kategoriler` VALUES (5, 'genel-alt-2', 'Genel Alt 2', 'Genel Alt 2', 2, 1, 0, 0);






--		`sablonlar` TABLOSU VERiLERi

CREATE TABLE `$tablo_sablonlar` (
`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`ad` varchar(100) NOT NULL,
`body` text NOT NULL,
`link` text NOT NULL,
`ickatman` text NOT NULL,
`kenar2` text NOT NULL,
`baslik` text NOT NULL,
`baslikyazi` text NOT NULL,
`baslikyazig` text NOT NULL,
`menuler` text NOT NULL,
`menubag` text NOT NULL,
`menubag_a` text NOT NULL,
`menubag_ahover` text NOT NULL,
`anayazi` text NOT NULL,
PRIMARY KEY (`id`),
KEY `kullanici_adi` (`ad`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_sablonlar` VALUES (1, 'varsayilan', 'body{background:#EEEEEE;}', 'a{color:#246A8A;}a:hover{color:#333333;}', '.phpkf-blok-kutusu{background:#FFFFFF;color:#333333;border-top:2px solid#58ABD0;border-bottom:2px solid#58ABD0;border-left:1px solid#CBCBCB;border-right:1px solid#CBCBCB;}', '', '.site-baslik{background-color:#58ABD0;}', '#baslikyazi{color:#FFFFFF;}', '.phpkf-blok-kutusu .kutu-baslik{background:#F3F3F3;color:#555555;}', '#genel-menu{background-color:#246A8A;border-top:1px solid#246A8A;border-bottom:1px solid#246A8A;}', '#genel-menu ul li ul.dropdown-menu2{background-color:#246A8A;}#genel-menu ul li:hover > a{background-color:#165E80;}', '.genel-menu ul a{color:#FFFFFF;}', '', '.phpkf-blok-kutusu .kutu-icerik ul.kutu-liste li > a{color:#555555;}');

INSERT INTO `$tablo_sablonlar` VALUES (2, 'kullanilan', 'body{background:#EEEEEE;}', 'a{color:#246A8A;}a:hover{color:#333333;}', '.phpkf-blok-kutusu{background:#FFFFFF;color:#333333;border-top:2px solid#58ABD0;border-bottom:2px solid#58ABD0;border-left:1px solid#CBCBCB;border-right:1px solid#CBCBCB;}', '', '.site-baslik{background-color:#58ABD0;}', '#baslikyazi{color:#FFFFFF;}', '.phpkf-blok-kutusu .kutu-baslik{background:#F3F3F3;color:#555555;}', '#genel-menu{background-color:#246A8A;border-top:1px solid#246A8A;border-bottom:1px solid#246A8A;}', '#genel-menu ul li ul.dropdown-menu2{background-color:#246A8A;}#genel-menu ul li:hover > a{background-color:#165E80;}', '.genel-menu ul a{color:#FFFFFF;}', '', '.phpkf-blok-kutusu .kutu-icerik ul.kutu-liste li > a{color:#555555;}');

INSERT INTO `$tablo_sablonlar` VALUES (3, 'Mor', 'body{background:#EEEEEE;}', 'a{color:#5D7492;}a:hover{color:#333333;}', '.phpkf-blok-kutusu{background:#FFFFFF;color:#333333;border-top:2px solid#566E8A;border-bottom:2px solid#DDDDDD;border-left:1px solid#DDDDDD;border-right:1px solid#DDDDDD;}', '.dugme.dugme-mavi{background-color:#768CA5;}.sabit-menu{background:#455c77;}.sabit-menu ul a:hover{background:#455C77;}.sabit-menu ul li ul.dropdown-menu{display:none;background-color:#455C77;}.sabit-menu ul li:hover > a{background-color:#36475C;}.sabit-menu ul li ul.dropdown-menu li a:hover{background-color:#36475C;}.sabit-menu .klogo a{background:url(\"temalar/varsayilan/resimler/bildirim_logo.png\") no-repeat 6px 9px;}.sabit-menu .klogo:hover > a, .sabit-menu .klogo ul.dropdown-menu li a{background:url(\"temalar/varsayilan/resimler/bildirim_logo.png\") no-repeat 6px 9px;background-color:#36475C;}#phpkf-footer{background:#5F738A;border-top:1px solid#4B6481;}.enalt{background:#3D5269;}.tablo-baslik{border-top:2px solid#566E8A;}', '.site-baslik{background-color:#768CA5;}', '#baslikyazi{color:#FFFFFF;}', '.phpkf-blok-kutusu .kutu-baslik{background:#F3F3F3;color:#555555;}', '#genel-menu{background-color:#566E8A;border-top:1px solid#506E92;border-bottom:1px solid#47688F;}', '#genel-menu ul a:hover{background-color:#45566B;}#genel-menu ul li ul.dropdown-menu2{background-color:#566E8A;}#genel-menu ul li:hover > a{background-color:#45566B;}#genel-menu ul li ul.dropdown-menu2 li a:hover{background-color:#45566B;}', '.genel-menu ul a{color:#FFFFFF;}', '', '.phpkf-blok-kutusu .kutu-icerik ul.kutu-liste li > a{color:#555555;}');

INSERT INTO `$tablo_sablonlar` VALUES (4, 'Koyu Gri', 'body{background:#EEEEEE;}', 'a{color:#555555;}a:hover{color:#000000;}', '.phpkf-blok-kutusu{background:#FFFFFF;color:#333333;border-top:2px solid#555555;border-bottom:2px solid#DDDDDD;border-left:1px solid#CBCBCB;border-right:1px solid#CBCBCB;}', '.dugme.dugme-mavi{background-color:#444444;}.tablo-baslik{border-top:2px solid#444444;}', '.site-baslik{background-color:#555555;}', '#baslikyazi{color:#FFFFFF;}', '.phpkf-blok-kutusu .kutu-baslik{background:#F3F3F3;color:#555555;}', '#genel-menu{background-color:#444444;border-top:1px solid#666666;border-bottom:1px solid#333333;}', '#genel-menu ul a:hover{background-color:#333333;}#genel-menu ul li ul.dropdown-menu2{background-color:#333333;}#genel-menu ul li:hover > a{background-color:#333333;}#genel-menu ul li ul.dropdown-menu2 li a:hover{background-color:#444444;}', '.genel-menu ul a{color:#FFFFFF;}', '', '.phpkf-blok-kutusu .kutu-icerik ul.kutu-liste li > a{color:#555555;}');

INSERT INTO `$tablo_sablonlar` VALUES (5, 'Siyah', 'body{background:#222222;color:#DDDDDD;}', 'a{color:#898989;}a:hover{color:#EEEEEE;}', '.phpkf-blok-kutusu{background:#111111;color:#BBBBBB;border-top:2px solid#000000;border-bottom:2px solid#000000;border-left:1px solid#000000;border-right:1px solid#000000;}', '.phpkf-blok-kutusu .kutu-icerik ul.kutu-liste li > a:hover{background:#333333;color:#DDDDDD;}.phpkf-blok-kutusu .kutu-icerik ul.kutu-liste li a.active{background:#333333;color:#AAAAAA;font-weight:bold;}.sabit-menu{background:#000000;}.sabit-menu ul a:hover{background:#333333;}.sabit-menu ul li ul.dropdown-menu{display:none;background-color:#333333;}.sabit-menu ul li:hover > a{background-color:#333333;}.sabit-menu ul li ul.dropdown-menu li a:hover{background-color:#444444;}.sabit-menu .klogo a{background:#000000 url(\"temalar/varsayilan/resimler/bildirim_logo.png\") no-repeat 6px 9px;}.sabit-menu .klogo:hover > a, .sabit-menu .klogo ul.dropdown-menu li a{background:#333333 url(\"temalar/varsayilan/resimler/bildirim_logo.png\") no-repeat 6px 9px;}.phpkf-blok-kutusu .kutu-footer{background: #000000;border-top:1px solid#716D6D;}#phpkf-footer{background:#222222;border-top:3px solid#000000;}.enalt{background:#000000;}.dugme.dugme-mavi{background-color:#000000;}fieldset {background-color:unset;border:1px solid#474747}.uye-arama-alani{background:#111111;border-bottom: 1px solid#716D6D;}.liste-veri{color:#DDDDDD;}.tablo-ana{background:#000000;}.tablo-ici, .tablo-satir,.tablo-ust{background:#222222;}.tablo-alt{background:#222222;}.tablo-satir:hover{background:#333333;}.tablo-baslik{background:#000000;border-top:0;padding:11px 0;border-bottom:1px solid#716D6D;color:#CCCCCC;font-weight:normal}.profil-kutusu, .profil-goruntule-ic, .profil-goruntule-ic ul.profil-sol-menu li a, .pro-duzenle, .pro-duzenle fieldset, .profil-dugmeler, .galeri-dugmeler, .dizinler, .resimler, .yazi-etiket{background:#252525;border:1px solid#000000;}.profil-goruntule-ic .sol-kisim, .profil-goruntule-ic .sag-kisim{background:#252525;}.profil-kutusu .baslik, .pro-duzenle .baslik{background:#000000;border:1px solid#393939}.profil-kutusu .kutu-ic .kutu-liste{border:1px solid#000000;}.profil-kutusu .kutu-ic .kutu-liste .liste-sol{background:#252525;border-right:1px solid#000;}.resimler .galeri-resim{background:#252525;border:2px solid#000000;}.resimler .galeri-resim:hover{background:#252525;border:2px solid#999999;}.dizinler ul.dizin-listesi li.secili{background:#252525;border:1px solid#000000;}.dizinler ul.dizin-listesi li{background:#333333;border:1px solid#000000;}.ifadeler{background:#F2F2F2;padding:3px}.yorum-listesi .yorum{border:1px solid#393939;color:#DDDDDD;}.yorum-listesi .yorum .yorum-icerik .yorum-yazi{border-top:1px solid#393939;}.tablo_ici{background:#111111;}.kullanici{color:#BBBBBB;}div.bloklar_yapi2 UL LI{background:#222222 !important;border:1px solid#666666 !important;color:#FFFFFF !important;}.input-alani, .input-alani:focus, .input-text, .input-text:focus, .input-select, .input-select:focus, .textarea, .textarea:focus{background:#333333;border:1px solid#000000;color:#DDDDDD;}.input-text.giris-text{background-repeat:no-repeat;background-position:right 7px center;}.input-alani:disabled{color:#BBBBBB;}.yonetim-form > div.form-div{background:#111111;border:1px solid#716D6D;}.yonetim-form > div.form-div > .yonetim-label, .yonetim-legend{color:#888888;}#cop_alani #cop, #gizle_alani #gizle{border:1px solid#666666 !important;}.popup-yan-menu{background:#222222 !important;border:1px solid#000000 !important;}.yukleme, .yukleme-alani{background:#222222 !important;border:1px solid#000000 !important;}.yukleme li{ background:#222222 !important; border:1px solid#000000 !important;}.yukleme table tr.ilkSatir th{ border:1px solid#000000 !important;}.yukleme table tr.renklendir2 td, table tr.renklendir td{border:1px solid#000000 !important;}.yukleme .dosyalar, .yukleme .resim_alani{border-right:1px solid#000000 !important;}.yukleme table tr.ilkSatir{background:#000000 !important;color:#BBBBBB;}.yukleme table tr.renklendir{background:#222222 !important;color:#BBBBBB;}.renklendir a:link, .renklendir a:visited, .renklendir a:active{color:#898989 !important;}.renklendir a:hover{color:#EEEEEE !important;}', '.site-baslik{background-color:#222222;}', '#baslikyazi{color:#FFFFFF;}', '.phpkf-blok-kutusu .kutu-baslik{background:#000000;color:#CCCCCC;border-bottom:1px solid#716D6D;}', '#genel-menu{background-color:#000000;border-top:1px solid#474747;border-bottom:1px solid#716D6D;}', '#genel-menu ul a:hover{background-color:#222222;}#genel-menu ul li ul.dropdown-menu2{background-color:#222222;}#genel-menu ul li:hover > a{background-color:#222222;}#genel-menu ul li ul.dropdown-menu2 li a:hover{background-color:#333333;}', '.genel-menu ul a{color:#CCCCCC;}', '', '.phpkf-blok-kutusu .kutu-icerik ul.kutu-liste li > a{color:#888888;}');





--		`yazilar` TABLOSU VERiLERi

CREATE TABLE `$tablo_yazilar` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`tip` tinyint(1) unsigned NOT NULL DEFAULT '0',
`kategori` varchar(255) NOT NULL DEFAULT '',
`alt_yazi` int(11) unsigned NOT NULL DEFAULT '0',
`sayfa_no` smallint(5) unsigned NOT NULL DEFAULT '0',
`tarih` int(11) unsigned NOT NULL DEFAULT '0',
`yayin_tarihi` int(11) unsigned NOT NULL DEFAULT '0',
`yazan` varchar(99) NOT NULL DEFAULT '',
`yazan_id` int(11) unsigned NOT NULL DEFAULT '0',
`yazan_ip` varchar(39) DEFAULT NULL DEFAULT '',
`degistirme_tarihi` int(11) unsigned NOT NULL DEFAULT '0',
`degistiren` varchar(99) NOT NULL DEFAULT '',
`degistiren_id` int(11) unsigned NOT NULL DEFAULT '0',
`degistiren_ip` varchar(39) NOT NULL DEFAULT '',
`goruntuleme` bigint(20) unsigned NOT NULL DEFAULT '0',
`yorum_durum` tinyint(1) unsigned NOT NULL DEFAULT '1',
`yorum_sayi` int(11) unsigned NOT NULL DEFAULT '0',
`adres` varchar(255) NOT NULL DEFAULT '',
`etiket` varchar(1000) NOT NULL DEFAULT '',
`baslik` varchar(255) NOT NULL DEFAULT '',
`icerik` longtext NOT NULL,
PRIMARY KEY (`id`),
KEY `tip` (`tip`),
KEY `adres` (`adres`),
KEY `yayin_tarihi` (`yayin_tarihi`),
KEY `tarih` (`tarih`),
KEY `kategori` (`kategori`),
KEY `alt_yazi` (`alt_yazi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_yazilar` VALUES (1, 2, ',1,', 0, 0, $tarih, $tarih, '$yonetici_adi;$yonetici_adi', 1, '127.0.0.1', 0, '', 0, '', 0, 1, 1, 'phpkfye-hosgeldiniz', 'phpKF,', 'phpKF`ye Hoş Geldiniz', '<b>CMS kurulumunuz başarıyla tamamlanmıştır...</b><br><br><br><img src=\"".$neden_phpkf."\" alt=\"phpKF\"> <br><br><br>Yönetici olarak giriş yaptığınızda üst menüde görünen <a href=\"phpkf-yonetim/index.php\"><u>Yönetim</u></a> bağlantısını tıklayarak, yönetimle ilgili işlemlere ulaşabilirsiniz.<br><br>phpKF`yi seçtiğiniz için teşekkür ederiz...');

INSERT INTO `$tablo_yazilar` VALUES (2, 3, ',1,', 0, 0, $tarih, $tarih, '$yonetici_adi;$yonetici_adi', 1, '127.0.0.1', 0, '', 0, '', 0, 1, 0, 'iletisim', '', 'İletişim', 'Aşağıda yer alan bilgilerle bizimle iletişime geçebilirsiniz.<br>Ayrıca her türlü istek, öneri ve şikayetleriniz için aşağıdaki formu kullanabilirsiniz.<br><br><p><strong>Adres:</strong> <br> Mahalle, Cadde, Sokak, No:<br> İlçe<br>Şehir<br>Ülke<br><br></p><p><strong>Tel:</strong> +90 212 000 00 00 <br> <strong>Tel:</strong> +90 555 000 00 00 <br><br><strong>E-Posta:</strong>  <a href=\"#\">info@siteadi.com</a> <br> <strong>Web Site: </strong> <a href=\"#\">www.siteadi.com</a></p>');





--		`yorumlar` TABLOSU VERiLERi

CREATE TABLE `$tablo_yorumlar` (
`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`tarih` int(11) unsigned NOT NULL DEFAULT '0',
`yazan` varchar(99) NOT NULL DEFAULT '',
`yazan_id` int(11) unsigned NOT NULL DEFAULT '0',
`yazan_ip` varchar(39) NOT NULL DEFAULT '',
`degistirme_tarihi` int(11) unsigned DEFAULT NULL,
`degistiren` varchar(99) DEFAULT NULL DEFAULT '',
`degistiren_id` int(11) unsigned DEFAULT NULL DEFAULT '0',
`degistiren_ip` varchar(39) DEFAULT NULL DEFAULT '',
`posta` varchar(100) DEFAULT NULL DEFAULT '',
`yazi_id` bigint(20) unsigned NOT NULL DEFAULT '0',
`kat_id` int(11) unsigned NOT NULL DEFAULT '0',
`yanit` bigint(20) unsigned NOT NULL DEFAULT '0',
`sikayet` text,
`bbcode` tinyint(1) NOT NULL DEFAULT '0',
`ifade` tinyint(1) NOT NULL DEFAULT '0',
`silinmis` tinyint(1) NOT NULL DEFAULT '0',
`onay` tinyint(1) NOT NULL DEFAULT '0',
`baslik` varchar(255) NOT NULL DEFAULT '',
`icerik` text NOT NULL,
PRIMARY KEY (`id`),
KEY `yazan` (`yazan`),
KEY `yazi_id` (`yazi_id`),
KEY `kat_id` (`kat_id`),
KEY `tarih` (`tarih`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_yorumlar` VALUES (1, $tarih, '$yonetici_adi;$yonetici_adi', 1, '127.0.0.1', NULL, '', NULL, '', '', 1, 1, 0, '', 1, 1, 0, 1, '', 'Düz yazı\r\n[b]Kalın yazı[/b]\r\nGülücük :)');

";

?>