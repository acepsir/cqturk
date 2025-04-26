<?php
/*
 +-=========================================================================-+
 |                       php Kolay Forum (phpKF) v2.10                       |
 +---------------------------------------------------------------------------+
 |               Telif - Copyright (c) 2007 - 2017 phpKF Ekibi               |
 |                 http://www.phpKF.com   -   phpKF@phpKF.com                |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkartma ve satma hakları sadece phpKF`ye aittir.|
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  www.phpKF.com  adresini ziyaret edin.       |
 +-=========================================================================-+*/


@ini_set('magic_quotes_runtime', 0);
header("Content-type: text/html; charset=utf-8");
$guncel_surum = '2.10';


// dil dosyası yükleniyor

if ((isset($_COOKIE['forum_dili'])) AND ($_COOKIE['forum_dili'] != ''))
{
	if ($_COOKIE['forum_dili'] == 'english') include 'dil/english.php';
	else include 'dil/turkce.php';
}
else include 'dil/turkce.php';



//  AYAR DOSYASINI İNDİR TIKLANDIĞINDA ÇALIŞACAK KISIM  //

if ( (isset($_POST['guncelleme_yapildi'])) AND (isset($_POST['ayar_bilgi'])) AND
	($_POST['guncelleme_yapildi'] == 'tamam') )
{ 
	header('Content-Type: text/x-delimtext; name="ayar.php"');
	header('Content-disposition: attachment; filename=ayar.php');

	//  magic_quotes_gpc açıksa //
	if (get_magic_quotes_gpc())
	echo stripslashes($_POST['ayar_bilgi']);

	//  magic_quotes_gpc kapalıysa  //
	else echo $_POST['ayar_bilgi'];
	exit();
}



// ayar.php yok, kurulum yapılmamış.
$phpkf_ayarlar_kip = "";
if (!@is_file('../ayar.php'))
{
	echo '<br><center><font color="red" face="arial" size="4">ayar.php dosyası yok !</font>
	<br><br>Kurulum yapmadıysanız önce <a href="index.php">kurulum sayfasından</a> kurulum yapın.</center>';

	exit();
}

else
{
	include '../ayar.php';
	if (!isset($vtsecim))
	{
		$giris_gec = true;
		$vtsecim = 'mysql';
		$vtadres = @$cfgdbhost;
		$vtisim = @$cfgdbisim;
		$vtkul = @$cfgdbkul;
		$vtsifre = @$cfgdbsifre;

		include_once('../bilesenler/vt_baglanti.php');
	}
}

if (!isset($portal_kullan)) $portal_kullan = 0;
$ayar_guncelle = true;



//  SADECE YÖNETİCİLER GÜNCELLEME YAPABİLİR  //

$giris_formu = '<!DOCTYPE html><html lang="tr" dir="ltr"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../temalar/varsayilan/resimler/favicon.png" rel="icon" type="image/png" />
<link href="sablon.css" rel="stylesheet" type="text/css" />
<title>'.$dil_kurulum[87].'</title></head><body>
<div class="ana_govde" style="margin:0 auto; width:100%; max-width:770px">
<center><b style="color:#ff0000"><br><br>Sadece yöneticiler güncelleme yapabilir !
<br><br>Giriş sayfasından veya alttaki formdan yönetici olarak giriş yapıp tekrar deneyin.</b>
<br><br><br></center>
<form name="giris" action="../giris.php" method="post">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
<input type="hidden" name="git" value="kurulum/index.php">
<table cellspacing="1" width="350" cellpadding="10" border="0" align="center" bgcolor="#d0d0d0">
<tbody><tr bgcolor="#ffffff"><td width="100" align="left"><b>Kullanıcı Adı:</b></td><td align="left" style="padding-right:15px">
<input type="text" name="kullanici_adi" size="20" maxlength="20" class="formlar"></td>
</tr><tr bgcolor="#ffffff"><td align="left"><b>Şifre:</b></td><td align="left" style="padding-right:15px">
<input type="password" name="sifre" size="20" maxlength="20" class="formlar"></td>
</tr><tr bgcolor="#ffffff"><td height="30" align="left"><label style="cursor:pointer"><input type="checkbox" name="hatirla">Beni hatırla</label></td>
<td align="center" valign="top"><input type="submit" value="Giriş Yap" class="dugme"></td>
</tr></tbody></table></form>
</div></body></html>';

if (isset($giris_gec));
elseif ( (isset($_COOKIE['kullanici_kimlik'])) AND ($_COOKIE['kullanici_kimlik'] != '') )
{
	$vtsorgu = "SELECT id,yetki FROM $tablo_kullanicilar WHERE kullanici_kimlik='$_COOKIE[kullanici_kimlik]' LIMIT 1";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$kullanici_kim = $vt->fetch_assoc($vtsonuc);

	if ( (!isset($kullanici_kim['yetki'])) OR ($kullanici_kim['yetki'] != '1') )
	{
		echo $giris_formu;
		exit();
	}
}
else
{
	echo $giris_formu;
	exit();
}





// GÜNCELLEME YAPILMIŞSA //

if ((isset($ayarlar['surum'])) AND ($ayarlar['surum'] == $guncel_surum))
{
	echo $vt_hata_tablo[0].$dil_kurulum[89].$vt_hata_tablo[1].'<center>'.$dil_kurulum[90].'<br>'.'</center>'.$vt_hata_tablo[2];
	exit();
}


// Eklenti Kurulum
function xml_oku($dosya){
$ebilgi = new XMLReader();
$ebilgi->open($dosya, 'iso-8859-9');
while ($ebilgi->read()){
if ($ebilgi->nodeType == XMLReader::ELEMENT) $etiket = $ebilgi->name;
elseif (($ebilgi->nodeType == XMLReader::TEXT) OR ($ebilgi->nodeType == XMLReader::CDATA)){
if ($etiket == 'eklenecek_dosya') $dizi[$etiket][0] = $ebilgi->value;
elseif ($etiket == 'dizin_olustur') $dizi[$etiket][0] = $ebilgi->value;
elseif ($etiket == 'kur_veritabani') $dizi[$etiket][0] = $ebilgi->value;
else $dizi[$etiket] = $ebilgi->value;}}
$ebilgi->close();
return($dizi);
}




//   SÜRÜM 1.20 İSE   //
//   SÜRÜM 1.20 İSE   //


if ((isset($ayarlar['surum'])) AND ($ayarlar['surum'] == '1.20'))
{
	$ayarlar['surum'] = '1.40';
	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='1.40' WHERE etiket='surum' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('sonkonular', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('kacsonkonu', '10')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('temadizini', 'varsayilan')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('tema_secenek', 'varsayilan,')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_kullanicilar ADD temadizini varchar(25) DEFAULT NULL";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
}











//   SÜRÜM 1.40 İSE   //
//   SÜRÜM 1.40 İSE   //


if ((isset($ayarlar['surum'])) AND ($ayarlar['surum'] == '1.40'))
{
	$ayarlar['surum'] = '1.50';
	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='1.50' WHERE etiket='surum' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('cevrimici', '600')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('forum_durumu', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_ozel_izinler ADD konu_acma TINYINT(1) NOT NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	//  FORUMLAR TABLOSUNA YENİ ALANLAR EKLENİYOR   //

	$vtsorgu = "ALTER TABLE $tablo_forumlar ADD konu_acma_izni TINYINT(1) NOT NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_forumlar ADD konu_sayisi MEDIUMINT(8) UNSIGNED NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_forumlar ADD cevap_sayisi INT(10) UNSIGNED NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_forumlar ADD alt_forum SMALLINT(5) UNSIGNED NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_forumlar ADD INDEX (alt_forum)";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	//  KULLANICILAR TABLOSUNA YENİ ALANLAR EKLENİYOR   //

	$vtsorgu = "ALTER TABLE $tablo_kullanicilar ADD temadizinip varchar(25) DEFAULT NULL";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_kullanicilar ADD ozel_ad VARCHAR(30) DEFAULT NULL";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// FORUM BİLGİLERİ ÇEKİLİYOR	//

	$vtsorgu = "SELECT id FROM $tablo_forumlar";
	$vtsonuc = $vt->query($vtsorgu);


	while ($forum_satir = $vt->fetch_assoc($vtsonuc))
	{
		//	FORUMDAKİ BAŞLIKLARIN SAYISI ALINIYOR	//

		$result = $vt->query("SELECT id FROM $tablo_mesajlar WHERE hangi_forumdan='$forum_satir[id]'");
		$konu_sayi = $vt->num_rows($result);


		//	FORUMDAKİ TÜM MESAJLARIN SAYISI ALINIYOR	//

		$result = $vt->query("SELECT id FROM $tablo_cevaplar WHERE hangi_forumdan='$forum_satir[id]'");
		$cevap_sayi = $vt->num_rows($result);


		//  KONU VE CEVAP SAYISI YENİ ALANLARA GİRİLİYOR    //

		$vtsorgu = "UPDATE $tablo_forumlar SET konu_sayisi='$konu_sayi', cevap_sayisi='$cevap_sayi'
			WHERE id='$forum_satir[id]' LIMIT 1";
		$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}
}





//   SÜRÜM 1.50 İSE   //
//   SÜRÜM 1.50 İSE   //


if ((isset($ayarlar['surum'])) AND ($ayarlar['surum'] == '1.50'))
{
	$ayarlar['surum'] = '1.60';
	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='1.60' WHERE etiket='surum' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_mesajlar ADD silinmis TINYINT(1) NOT NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_cevaplar ADD silinmis TINYINT(1) NOT NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
}





//   SÜRÜM 1.60 İSE   //
//   SÜRÜM 1.60 İSE   //


if ((isset($ayarlar['surum'])) AND ($ayarlar['surum'] == '1.60'))
{
	$ayarlar['surum'] = '1.70';
	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='1.70' WHERE etiket='surum' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('portal_kullan', '$portal_kullan')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('onay_kodu', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_kullanicilar ADD posta2 VARCHAR(100) DEFAULT NULL";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_yasaklar ADD tip TINYINT(1) NOT NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_yasaklar VALUES ('adsoyad', '', '0')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_mesajlar ADD ifade TINYINT(1) NOT NULL DEFAULT '1'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_cevaplar ADD ifade TINYINT(1) NOT NULL DEFAULT '1'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_ozel_ileti ADD ifade TINYINT(1) NOT NULL DEFAULT '1'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_mesajlar ADD son_cevap int(10) unsigned NOT NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_mesajlar ADD son_cevap_yazan varchar(20) NULL";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// konular alınıyor
	$vtsorgu = "SELECT id FROM $tablo_mesajlar WHERE cevap_sayi!=0 ORDER BY id";
	$vtsonuc = $vt->query($vtsorgu);

	while ($konular = $vt->fetch_assoc($vtsonuc))
	{
		// son cevap alınıyor
		$vtsorgu = "SELECT id,tarih,cevap_yazan FROM $tablo_cevaplar WHERE hangi_basliktan='$konular[id]' AND silinmis=0 ORDER BY tarih DESC LIMIT 1";
		$soncevap_sonuc = $vt->query($vtsorgu);
		$soncevap = $vt->fetch_assoc($soncevap_sonuc);

		// son cevap bilgileri giriliyor
		$vtsorgu = "UPDATE $tablo_mesajlar SET son_cevap='$soncevap[id]',son_mesaj_tarihi='$soncevap[tarih]',son_cevap_yazan='$soncevap[cevap_yazan]' where id='$konular[id]' LIMIT 1";
		$soncevap_sonuc = $vt->query($vtsorgu);
	}
}





//   SÜRÜM 1.70 İSE   //
//   SÜRÜM 1.70 İSE   //


if ( (isset($ayarlar['surum'])) AND ($ayarlar['surum'] == '1.70') )
{
	$ayarlar['surum'] = '1.80';
	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='1.80' WHERE etiket='surum' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('blm_yrd', 'Bölüm Yardımcısı')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('kul_resim', 'dosyalar/resimler/galeri/resim_yok.png')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('boyutlandirma', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('duyuru_tarihi', '0')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_forumlar ADD gizle TINYINT(1) NOT NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_kullanicilar SET yetki='3' WHERE yetki='2'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// özel ileti - başı
	$vtsorgu = "SELECT id,gonderen_kopya,alan_kutu FROM $tablo_ozel_ileti WHERE gonderen_kopya!='' ORDER BY id";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($oileti = $vt->fetch_array($vtsonuc))
	{
		$vtsorgu = "UPDATE $tablo_ozel_ileti SET alan_kutu='$oileti[alan_kutu]' WHERE id='$oileti[gonderen_kopya]' LIMIT 1";
		$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}

	$vtsorgu = "DELETE FROM $tablo_ozel_ileti WHERE gonderen_kopya!=''";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_ozel_ileti DROP gonderen_kopya";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	// özel ileti - sonu
}





//   SÜRÜM 1.80 İSE   //
//   SÜRÜM 1.80 İSE   //


if ((isset($ayarlar['surum'])) AND ($ayarlar['surum'] == '1.80'))
{
	$ayarlar['surum'] = '1.90';
	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='1.90' WHERE etiket='surum' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('bolum_kisi', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('konu_kisi', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('uye_kayit', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('oi_uyari', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	$vtsorgu = "INSERT INTO $tablo_yasaklar VALUES ('yasak_ip','','0')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	$vtsorgu = "ALTER TABLE $tablo_kullanicilar ADD `grupid` smallint(5) unsigned DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_kullanicilar ADD `sayfano` VARCHAR(25) NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_oturumlar ADD `sayfano` VARCHAR(25) NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	$vtsorgu = "UPDATE $tablo_kullanicilar SET sayfano='-1' where hangi_sayfada='Kullanıcı çıkış yaptı'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());



	$vtsorgu = "ALTER TABLE $tablo_ozel_izinler CHANGE `kulad` `kulad` VARCHAR(30)";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_ozel_izinler ADD `kulid` mediumint(8) unsigned NOT NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_ozel_izinler ADD `grup` smallint(5) unsigned NOT NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// özel izinler id alma - başı
	$vtsorgu = "SELECT kulad FROM $tablo_ozel_izinler ORDER BY kulad";
	$vtsonucoi = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($oizin = $vt->fetch_array($vtsonucoi))
	{
		$vtsorgu = "SELECT id FROM $tablo_kullanicilar WHERE kullanici_adi='$oizin[kulad]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$kulid = $vt->fetch_array($vtsonuc);


		$vtsorgu = "UPDATE $tablo_ozel_izinler SET kulid='$kulid[id]' WHERE kulad='$oizin[kulad]'";
		$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}
	// özel izinler id alma - sonu



	$tablo_eklentiler = $tablo_oneki.'eklentiler';
	$tablo_gruplar = $tablo_oneki.'gruplar';
	$tablo_yuklemeler = $tablo_oneki.'yuklemeler';


	$vtsorgu = "CREATE TABLE `$tablo_eklentiler` (
	`ad` varchar(40) NOT NULL,
	`kur` tinyint(1) unsigned NOT NULL,
	`etkin` tinyint(1) unsigned NOT NULL,
	`vt` tinyint(1) unsigned NOT NULL,
	`dosya` tinyint(1) unsigned NOT NULL,
	`dizin` tinyint(1) unsigned NOT NULL,
	`sistem` tinyint(1) unsigned NOT NULL,
	`usurum` varchar(5) NOT NULL,
	`esurum` varchar(5) NOT NULL,
	PRIMARY KEY (`ad`)
	) ENGINE=MyISAM CHARSET=utf8;";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	$vtsorgu = "CREATE TABLE `$tablo_gruplar` (
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
	) ENGINE=MyISAM CHARSET=utf8;";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	$vtsorgu = "CREATE TABLE `$tablo_yuklemeler` (
	`id` int(8) unsigned NOT NULL AUTO_INCREMENT,
	`tarih` int(11) NOT NULL DEFAULT '0',
	`boyut` int(7) unsigned DEFAULT '0',
	`ip` varchar(15) DEFAULT NULL,
	`uye_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
	`uye_adi` varchar(20) NOT NULL DEFAULT '',
	`dosya` varchar(30) NOT NULL,
	PRIMARY KEY (`id`)
	) ENGINE=MyISAM CHARSET=utf8;";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());



	// Tüm kurulu eklentiler taranıyor

	$yedizin_adi = '../eklentiler/';
	$yedizin = @opendir($yedizin_adi);
	while (@gettype($bilgi = @readdir($yedizin)) != 'boolean')
	{
		$vt_islem = 0;
		$dosya_islem = 0;
		$dizin_islem = 0;

		if ((@is_dir($yedizin_adi.$bilgi)) AND ($bilgi != '.') AND ($bilgi != '..'))
		{
			if (@is_file($yedizin_adi.$bilgi.'/eklenti_bilgi.xml')) $edbilgi = @xml_oku($yedizin_adi.$bilgi.'/eklenti_bilgi.xml');
			else continue;

			if ($edbilgi['eklenti_kurulu']!='1') continue;

			if (isset($edbilgi['eklenti_etkin'])) $eetkin = 1;
			else $eetkin = 2;

			if (isset($edbilgi['kur_veritabani'])) $vt_islem = 1;
			if (isset($edbilgi['eklenecek_dosya'])) $dosya_islem = 1;
			if (isset($edbilgi['dizin_olustur'])) $dizin_islem = 1;
		}
		else continue;

		$vtsorgu = "INSERT INTO $tablo_eklentiler VALUES ('$bilgi', '1', '$eetkin', '$vt_islem', '$dosya_islem', '$dizin_islem', '$edbilgi[sistem]', '$edbilgi[uyumlu_surum]', '$edbilgi[eklenti_surumu]')";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		unset($edbilgi);
	}
	@closedir($yedizin);
}







//   SÜRÜM 1.90 İSE   //
//   SÜRÜM 1.90 İSE   //


if ((isset($ayarlar['surum'])) AND ($ayarlar['surum'] == '1.90'))
{
	$ayarlar['surum'] = '1.95';
	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='1.95' WHERE etiket='surum' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE `$tablo_kullanicilar` ADD `cinsiyet` TINYINT(1) NOT NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE `$tablo_kullanicilar` ADD `hakkinda` TEXT";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE `$tablo_kullanicilar` ADD `takip` TEXT";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE `$tablo_kullanicilar` ADD `yrm_sayi` mediumint(6) unsigned NOT NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE `$tablo_kullanicilar` ADD `yrm_yapilan` mediumint(6) unsigned NOT NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE `$tablo_ozel_ileti` ADD `cevap_sayi` tinyint(3) unsigned NOT NULL DEFAULT 0";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE `$tablo_ozel_ileti` ADD `cevap` int(10) unsigned NOT NULL DEFAULT 0";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());



	$tablo_bildirimler = $tablo_oneki.'bildirimler';
	$tablo_yorumlar = $tablo_oneki.'yorumlar';


	$vtsorgu = "CREATE TABLE `$tablo_bildirimler` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`tarih` int(11) unsigned NOT NULL,
	`uye_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
	`seviye` tinyint(1) unsigned NOT NULL DEFAULT '0',
	`tip` tinyint(1) unsigned NOT NULL DEFAULT '0',
	`okundu` tinyint(1) unsigned NOT NULL DEFAULT '0',
	`bildirim` varchar(255) NOT NULL,
	PRIMARY KEY (`id`),
	KEY `uye_id` (`uye_id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	$vtsorgu = "CREATE TABLE `$tablo_yorumlar` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`tarih` int(11) unsigned NOT NULL,
	`uye_adi` varchar(20) NOT NULL,
	`uye_id` mediumint(8) unsigned NOT NULL,
	`yazan` varchar(20) NOT NULL,
	`yazan_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
	`yazan_ip` varchar(15) DEFAULT NULL,
	`silinmis` tinyint(1) unsigned NOT NULL DEFAULT '0',
	`onay` tinyint(1) unsigned NOT NULL DEFAULT '0',
	`sikayet` text NOT NULL,
	`yorum_icerik` text NOT NULL,
	PRIMARY KEY (`id`),
	KEY `uye_id` (`uye_id`),
	KEY `tarih` (`tarih`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

}




//   SÜRÜM 1.95 İSE   //
//   SÜRÜM 1.95 İSE   //


if ((isset($ayarlar['surum'])) AND ($ayarlar['surum'] == '1.95'))
{
	$ayarlar['surum'] = '2.00';
	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$guncel_surum' WHERE etiket='surum' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='varsayilan,' WHERE etiket='tema_secenek' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='varsayilan' WHERE etiket='temadizini' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_kullanicilar SET temadizini='varsayilan' WHERE id='1' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_ayarlar CHANGE `deger` `deger` TEXT NULL DEFAULT NULL";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_ayarlar  ADD `kip` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_ayarlar ADD INDEX(`kip`)";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET kip='1'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('vt_hata', '1', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('duzenleyici', 'varsayilan', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('duzenleyici_secenek', 'varsayilan,tinymce,ckeditor', '2')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('tema_genislik', '95%', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('tema_logo_ust', 'phpKF Forum', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('tema_logo_alt', '<i style=\"letter-spacing:10px\">phpKF</i>', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('cms_kullan', '0', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('cms_icinden', '0', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

}






//   SÜRÜM 2.00 İSE   //
//   SÜRÜM 2.00 İSE   //


if ((isset($ayarlar['surum'])) AND ($ayarlar['surum'] == '2.00'))
{
	// ayar.php üstüne yazılmasın
	$ayar_guncelle = false;

	$ayarlar['surum'] = $guncel_surum;
	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$guncel_surum' WHERE etiket='surum' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('meta_diger', '<meta name=\"rating\" content=\"All\" />
<meta name=\"content-language\" content=\"tr\" />
<meta name=\"robots\" content=\"index, follow\" />', 1)";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('site_taban_kod', '', 1)";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('smtp_port', '587', 1)";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('yduzenleyici', 'duz', 1)";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='duz,varsayilan,tinymce,ckeditor,sceditor' WHERE etiket='duzenleyici_secenek' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('yukleme_dosya', 'zip,rar,tar.gz,tar,gz,jpg,jpeg,gif,png,bmp,ico,wav,mp3,mp4,ogg,ogv,oga,webm,flv,swf,mpeg,mpg,mp2,wmv,mkv,avi,mov,3gp,', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('yukleme_dizin', 'dosyalar/yuklemeler', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('yukleme_boyut', '10485760', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('yukleme_genislik', '2000', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('yukleme_yukseklik', '2000', '1')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_yuklemeler CHANGE `dosya` `dosya` VARCHAR(100) NOT NULL";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_bildirimler CHANGE `tip` `tip` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

}



		//	AYAR.PHP DOSYA İÇERİĞİ - BAŞI 	//


if (!isset($forum_index)) $forum_index = 'index.php';
if (!isset($portal_index)) $portal_index = 'portal_index.php';


$ayar_cikti = '&lt;?php

if (!defined(\'PHPKF_ICINDEN\')) define(\'PHPKF_ICINDEN\', true);
if (!defined(\'DOSYA_AYAR\')) define(\'DOSYA_AYAR\',true);

//  PHP hata gösterme ve kayıt ayarları
@error_reporting(E_ALL);
@ini_set(\'display_errors\',\'off\');
@ini_set(\'log_errors\', 1);

//  veritabanı seçimi
$vtsecim = \'mysql\';

//  veritabanı sunucu adresi
$vtadres = \''.$vtadres.'\';

//  veritabanı kullanıcı adı
$vtkul = \''.$vtkul.'\';

//  veritabanı şifresi
$vtsifre = \''.$vtsifre.'\';

//  veritabanı ismi
$vtisim = \''.$vtisim.'\';

//  tablo öneki
$tablo_oneki = \''.$tablo_oneki.'\';

//  kullanıcı şifrelerinin karıştırılacağı anahtar sözcük
$anahtar = \''.$anahtar.'\';

//  forum açılış tarihi
$forum_acilis = '.$forum_acilis.';

//  forum ana sayfasının dosya adi (varsayılan index.php; CMS kullanıyorsanız forum_index.php yapın)
$forum_index = \''.$forum_index.'\';

//  portal ana sayfasının dosya adi (varsayılan portal_index.php)
$portal_index = \''.$portal_index.'\';

//  CMS ana sayfasının dosya adi (varsayılan index.php)
$cms_index = \'index.php\';

//  CMS tablo öneki
$cms_tablo_oneki = \'phpkfcms_\';

//  CMS dizini
$cms_dizin = \'\';

//  CMS üyelik sistemi kullanma ayarı
$cms_uyelik = 0;

// veritabanı bağlantısı yapılıyor
include_once(\'bilesenler/vt_baglanti.php\');

//  çerez dizini
$cerez_dizin = $ayarlar[\'f_dizin\'];

?&gt;';


		//	AYAR.PHP DOSYA İÇERİĞİ - SONU 	//






//  GÜNCELLEME TAMAMLANDI İLETİSİ - ayar dosyasına yazma hakkı yok  //

$guncelleme_tamam1 = '<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../temalar/varsayilan/resimler/favicon.ico" rel="icon" type="image/x-icon" />
<title>Güncelleme Başarıyla Tamamlanmıştır</title>
</head>
<body>
<center><br><h1>Güncelleme Başarıyla Tamamlanmıştır.</h1><br>
<form action="guncelle.php" method="post" name="guncelleme_formu2">
<input type="hidden" name="guncelleme_yapildi" value="tamam">
<input type="hidden" name="ayar_bilgi" value="'.$ayar_cikti.'">
<font face="arial" size="3">
<font color="red">Sunucunuzda yazma hakkı bulunmadığı için <b>ayar.php</b> dosyasını sizin yüklemeniz gerekiyor.</font></center>
<br><br><li>Son olarak alttaki "Ayar Dosyasını indir" düğmesini tıkladıktan sonra gelen "ayar.php" dosyasını, eski ayar.php dosyasının üzerine yazın.
<p><li>"kurulum" klasörünü, içindeki tüm dosyalarla beraber silin.
<br><br><br>
<center><input class="dugme" type="submit" value="Ayar Dosyasını indir">
<br><br><a href="../index.php">Forum Ana Sayfasına Gitmek için Tıklayın</a>
</font>
</center>
</form>
</body>
</html>';



//  GÜNCELLEME TAMAMLANDI İLETİSİ - ayar dosyası başarıyla güncellendi.  //

$guncelleme_tamam2 = '<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../temalar/varsayilan/resimler/favicon.ico" rel="icon" type="image/x-icon" />
<title>Güncelleme Başarıyla Tamamlanmıştır</title>
</head>
<body>
<center><br><h1>Güncelleme Başarıyla Tamamlanmıştır.</h1><br>
<font face="arial" size="3">
<b>ayar.php dosyası otomatik olarak oluşturulmuştur.</b>
<br><br><li>Son olarak "kurulum" klasörünü, içindeki tüm dosyalarla beraber silin.
<br><br><br><a href="../index.php">Forum Ana Sayfasına Gitmek için Tıklayın</a>
</font>
</center>
</body>
</html>';



//  GÜNCELLEME TAMAMLANDI İLETİSİ - ayar dosyası güncellenmiyor  //

$guncelleme_tamam3 = '<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../temalar/varsayilan/resimler/favicon.ico" rel="icon" type="image/x-icon" />
<title>Güncelleme Başarıyla Tamamlanmıştır</title>
</head>
<body>
<center><br><h1>Güncelleme Başarıyla Tamamlanmıştır.</h1><br>
<font face="arial" size="3">
<br><li>Son olarak "kurulum" klasörünü, içindeki tüm dosyalarla beraber silin.
<br><br><br><a href="../index.php">Forum Ana Sayfasına Gitmek için Tıklayın</a>
</font>
</center>
</body>
</html>';





$adi_ayarphp = '../ayar.php';

if (!$ayar_guncelle) echo $guncelleme_tamam3;

else
{
	if (@is_writable($adi_ayarphp))
	{
		$dosya_ayarphp = @fopen($adi_ayarphp, 'w');

		@flock($dosya_ayarphp, 2);

		$bul = array('&gt;', '&lt;', '&quot;');
		$cevir = array('>', '<', '"');
		$ayar_cikti = @str_replace($bul, $cevir, $ayar_cikti);

		@fwrite($dosya_ayarphp, $ayar_cikti);

		@flock($dosya_ayarphp, 3);
		@fclose($dosya_ayarphp);

		echo $guncelleme_tamam2;
	}

	else echo $guncelleme_tamam1;
}
?>