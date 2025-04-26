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


if (!defined('DOSYA_AYAR')) include '../../ayar.php';
if (!defined('DOSYA_GERECLER')) include '../../bilesenler/gerecler.php';
if (!defined('DOSYA_YONETIM_GUVENLIK')) include 'guvenlik.php';


// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';

if ($gyo != $yo)
{
	header('Location: ../hata.php?hata=45');
	exit();
}



$_POST['id'] = @zkTemizle($_POST['id']);

$vtsorgu = "SELECT id,kullanici_adi,sifre,posta,resim,grupid FROM $tablo_kullanicilar WHERE id='$_POST[id]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$satir = $vt->fetch_array($vtsonuc);


if ($satir['id'] == 1)
{
	header('Location: ../hata.php?hata=147');
	exit();
}




// FORM DOLUMU BAKILIYOR    //


if ($_POST['profil_degisti_mi'] == 'form_dolu'):


if ( (!$_POST['ysifre']) OR (!$_POST['ysifre2']) OR (!$_POST['posta']) OR (!$_POST['gercek_ad']) OR (!$_POST['dogum_tarihi']) )
{
	header('Location: ../hata.php?hata=73');
	exit();
}

if (!preg_match('/^[A-Za-z0-9-_ ğĞüÜŞşİıÖöÇç.]+$/', $_POST['gercek_ad']))
{
	header('Location: ../hata.php?hata=31');
	exit();
}

if ( strlen($_POST['gercek_ad']) > 30)
{
	header('Location: ../hata.php?hata=32');
	exit();
}

if ($_POST['ysifre'] != $_POST['ysifre2'])
{
	header('Location: ../hata.php?hata=33');
	exit();
}

if (!preg_match('/^[A-Za-z0-9-_.&]+$/', $_POST['ysifre']))
{
	header('Location: ../hata.php?hata=34');
	exit();
}

if (( strlen($_POST['ysifre']) > 20) OR ( strlen($_POST['ysifre']) < 5))
{
	header('Location: ../hata.php?hata=35');
	exit();
}

if ($_POST['sehir'] != '')
{
	if ((!preg_match('/^[A-Za-zğĞüÜŞşİıÖöÇç]+$/', $_POST['sehir'])) OR ( strlen($_POST['sehir']) > 30))
	{
		header('Location: ../hata.php?hata=36');
		exit();
	}
}

if ((!preg_match('/^[0-9-]+$/', $_POST['dogum_tarihi'])) OR ( strlen($_POST['dogum_tarihi']) != 10))
{
	header('Location: ../hata.php?hata=74');
	exit();
}

if (!preg_match('/^[012]+$/', $_POST['cinsiyet']))
{
	header('Location: ../hata.php?hata=79');
	exit();
}

if (!preg_match('/^[0-9]+$/', $_POST['yetki']))
{
	header('Location: ../hata.php?hata=148');
	exit();
}

if (!preg_match('/^[0-9]+$/', $_POST['eski_yetki']))
{
	header('Location: ../hata.php?hata=148');
	exit();
}

if ((!isset($_POST['grup'])) OR (!preg_match('/^[0-9]+$/', $_POST['grup'])))
{
	header('Location: ../hata.php?hata=204');
	exit();
}

if (!preg_match('/^([~&+.0-9a-z_-]+)@(([~&+0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', $_POST['posta']))
{
	header('Location: ../hata.php?hata=10');
	exit();
}

if ( strlen($_POST['posta']) > 70)
{
	header('Location: ../hata.php?hata=40');
	exit();
}

if ( strlen($_POST['web']) > 70)
{
	header('Location: ../hata.php?hata=75');
	exit();
}

if ( strlen($_POST['web']) != 0)
{
	if ((!preg_match('/^http:\/\//i', $_POST['web'])))
	{
		$_POST['web'] = 'http://'.$_POST['web'];
	}
}


if (!preg_match('/^[A-Za-z0-9-_]+$/', $_POST['tema_secim']))
{
	header('Location: ../hata.php?hata=76');
	exit();
}

if ( strlen($_POST['tema_secim']) > 20)
{
	header('Location: ../hata.php?hata=77');
	exit();
}


if ( (isset($_POST['tema_secimp'])) AND (!preg_match('/^[A-Za-z0-9-_]+$/', $_POST['tema_secimp'])) )
{
	header('Location: ../hata.php?hata=76');
	exit();
}

if  ( (isset($_POST['tema_secimp'])) AND ( strlen($_POST['tema_secimp']) > 20) )
{
	header('Location: ../hata.php?hata=77');
	exit();
}


if( strlen($_POST['imza']) > $ayarlar['imza_uzunluk'] )
{
	header('Location: ../hata.php?hata=78');
	exit();
}

if ( strlen($_POST['hakkinda']) > 1000 )
{
	header('Location: ../hata.php?hata=224');
	exit();
}


//  ANINDA MESAJLAŞMA ADRESLERİ //

if ( strlen($_POST['icq']) > 30)
{
	header('Location: ../hata.php?hata=79');
	exit();
}

if ( strlen($_POST['aim']) > 99)
{
	header('Location: ../hata.php?hata=80');
	exit();
}

if ( strlen($_POST['msn']) > 99)
{
	header('Location: ../hata.php?hata=81');
	exit();
}

if ( strlen($_POST['yahoo']) > 99)
{
	header('Location: ../hata.php?hata=82');
	exit();
}

if ( strlen($_POST['skype']) > 99)
{
	header('Location: ../hata.php?hata=83');
	exit();
}


//	İMZADAN ZARARLI KODLAR TEMİZLENİYOR	//

if ( isset($_POST['imza']) AND ($_POST['imza'] != '') )
{
	//	magic_quotes_gpc açıksa	//
	if (get_magic_quotes_gpc()) $_POST['imza'] = zkTemizle(stripslashes($_POST['imza']));

	//	magic_quotes_gpc kapalıysa	//
	else $_POST['imza'] = zkTemizle($_POST['imza']);
}


//	HAKKINDA BİLGİSİNDEN KODLAR TEMİZLENİYOR	//

if ( isset($_POST['hakkinda']) AND ($_POST['hakkinda'] != '') )
{
	//	magic_quotes_gpc açıksa	//
	if (get_magic_quotes_gpc()) $_POST['hakkinda'] = zkTemizle(stripslashes($_POST['hakkinda']));

	//	magic_quotes_gpc kapalıysa	//
	else $_POST['hakkinda'] = zkTemizle($_POST['hakkinda']);
}





		//	KULLANICI RESİMİNİN TİP VE BÜYÜKLÜĞÜNE BAKILIYOR - BAŞI 	//



//	RESİM SİL SEÇİLİYSE $kul_resim DEĞİŞKENİ BOŞALTILIYOR	//
if ( isset($_POST['resim_sil']) ) $kul_resim = '';


//	RESİM YÜKLEME KISMI - BAŞI	//

elseif ( ($ayarlar['resim_yukle'] == 1) AND (isset($_FILES['resim_yukle']['tmp_name']))
	AND ($_FILES['resim_yukle']['tmp_name'] != '') )
{
	list($genislik, $yukseklik, $tip) = @getimagesize($_FILES['resim_yukle']['tmp_name']);

	if ( (isset($tip)) AND ($tip == 2) )
	{
		$uzanti = '.jpg';

		if ( !@imagecreatefromjpeg($_FILES['resim_yukle']['tmp_name']) )
		{
			header('Location: ../hata.php?hata=84');
			exit();
		}
	}

	elseif ( (isset($tip)) AND ($tip == 1) )
	{
		$uzanti = '.gif';

		if ( !@imagecreatefromgif($_FILES['resim_yukle']['tmp_name']) )
		{
			header('Location: ../hata.php?hata=84');
			exit();
		}
	}

	elseif ( (isset($tip)) AND ($tip == 3) )
	{
		$uzanti = '.png';

		if ( !@imagecreatefrompng($_FILES['resim_yukle']['tmp_name']) )
		{
			header('Location: ../hata.php?hata=84');
			exit();
		}
	}

	else
	{
		header('Location: ../hata.php?hata=85');
		exit();
	}



	if ($_FILES['resim_yukle']['size'] > $ayarlar['resim_boyut'])
	{
		header('Location: ../hata.php?hata=86');
		exit();
	}

	if ( ($genislik > $ayarlar['resim_genislik']) OR ($yukseklik > $ayarlar['resim_yukseklik']) )
	{
		header('Location: ../hata.php?hata=87');
		exit();
	}

	$dosya_yolu = '../../dosyalar/resimler/yuklenen/'.rand(1111111111, 9999999999).$uzanti;

	if ( !@move_uploaded_file($_FILES["resim_yukle"]["tmp_name"],$dosya_yolu) )
	{
		header('Location: ../hata.php?hata=88');
		exit();
	}

	//	DOSYA SORUNSUZSA ../ temizlenip ADRES $kul_resim DEĞİŞKENİNE AKTARILIYOR	//
	$kul_resim = str_replace('../','',$dosya_yolu);
}


//	RESİM YÜKLEME KISMI - SONU	//




//	UZAK RESİM YÜKLEME KISMI - BAŞI	//


elseif ( ($ayarlar['uzak_resim'] == 1) AND (isset($_POST['uzak_resim'])) AND ($_POST['uzak_resim'] != '') OR 
	($ayarlar['resim_galerisi'] == 1) AND (isset($_POST['uzak_resim2'])) AND ($_POST['uzak_resim2'] != '') )
{
	if ( (isset($_POST['uzak_resim'])) AND ($_POST['uzak_resim'] != '') )
	$resim_adres = $_POST['uzak_resim'];

	elseif ( (isset($_POST['uzak_resim2'])) AND ($_POST['uzak_resim2'] != '') )
	$resim_adres = '../../'.$_POST['uzak_resim2'];

	if ( (!@getimagesize($resim_adres)) AND (preg_match('/^http:\/\//i', $resim_adres))
	OR (!@getimagesize($resim_adres)) AND (preg_match('/^ftp:\/\//i', $resim_adres)) )
	{
		header('Location: ../hata.php?hata=89');
		exit();
	}

	list($genislik, $yukseklik, $tip) = @getimagesize($resim_adres);

	if ( (isset($tip)) AND ($tip == 2) )
	{
		if ( !@imagecreatefromjpeg($resim_adres) )
		{
			header('Location: ../hata.php?hata=84');
			exit();
		}
	}

	elseif ( (isset($tip)) AND ($tip == 1) )
	{
		if ( !@imagecreatefromgif($resim_adres) )
		{
			header('Location: ../hata.php?hata=84');
			exit();
		}
	}

	elseif ( (isset($tip)) AND ($tip == 3) )
	{
		if ( !@imagecreatefrompng($resim_adres) )
		{
			header('Location: ../hata.php?hata=84');
			exit();
		}
	}

	else
	{
		header('Location: ../hata.php?hata=85');
		exit();
	}



	$resim_dosya = @file_get_contents($resim_adres);
	$resim_boyut = @round((strlen($resim_dosya)),2);

	if ($resim_boyut > $ayarlar['resim_boyut'])
	{
		header('Location: ../hata.php?hata=86');
		exit();
	}

	if ( ($genislik > $ayarlar['resim_genislik']) OR ($yukseklik > $ayarlar['resim_yukseklik']) )
	{
		header('Location: ../hata.php?hata=87');
		exit();
	}

	//	DOSYA SORUNSUZSA ../ temizlenip ADRES $kul_resim DEĞİŞKENİNE AKTARILIYOR	//
	$kul_resim = str_replace('../','',$resim_adres);
}

//	UZAK RESİM YÜKLEME KISMI - SONU	//


//	HİÇBİR ŞEY YÜKLENMİYORSA ESKİ RESİM ADRESİ $kul_resim DEĞİŞKENİNE AKTARILIYOR	//

else $kul_resim = $satir['resim'];



		//	KULLANICI RESİMİNİN TİP VE BÜYÜKLÜĞÜNE BAKILIYOR - SONU 	//









if ( (!preg_match('/^[01]+$/', $_POST['posta_goster'])) OR
		(!preg_match('/^[012]+$/', $_POST['dogum_tarihi_goster'])) OR
		(!preg_match('/^[01]+$/', $_POST['sehir_goster'])) OR
		(!preg_match('/^[01]+$/', $_POST['gizli'])) )
{
	header('Location: ../hata.php?hata=92');
	exit();
}



// 	E-POSTA ADRESİ DEĞİŞTİYSE YENİ ADRESLE DAHA ÖNCE KAYIT YAPILIP YAPILMADIĞI DENETLENİYOR 	//

$_POST['posta'] = zkTemizle($_POST['posta']);

if ($satir['posta'] != $_POST['posta'])
{
	$vtsorgu = "SELECT posta FROM $tablo_kullanicilar WHERE posta='$_POST[posta]' LIMIT 1";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());

	if ($vt->num_rows($vtsonuc2))
	{
		header('Location: ../hata.php?hata=93');
		exit();
	}
}

if (($_POST['ysifre'] == 'sifre_degismedi') OR ($_POST['ysifre2'] == 'sifre_degismedi'))
{
	$karma = $satir['sifre'];
}

//	ŞİFRE DEĞİŞTİRİLDİYSE ANAHTAR İLE BİRLEŞTİRİLİP SHA1 İLE ŞİFRELENİYOR	//

if (($_POST['ysifre'] != 'sifre_degismedi') OR ($_POST['ysifre2'] != 'sifre_degismedi'))
{
	$karma=sha1(($anahtar.$_POST['ysifre']));
}


$_POST['web'] = zkTemizle($_POST['web']);
$_POST['icq'] = zkTemizle($_POST['icq']);
$_POST['aim'] = zkTemizle($_POST['aim']);
$_POST['msn'] = zkTemizle($_POST['msn']);
$_POST['yahoo'] = zkTemizle($_POST['yahoo']);
$_POST['skype'] = zkTemizle($_POST['skype']);
$_POST['ozel_ad'] = zkTemizle($_POST['ozel_ad']);


// portal tema dizini
if (isset($_POST['tema_secimp'])) $temadizinip_sorgu = ",temadizinip='$_POST[tema_secimp]'";
else $temadizinip_sorgu = '';


$vtsorgu = "UPDATE $tablo_kullanicilar SET sifre='$karma',posta='$_POST[posta]',web='$_POST[web]',dogum_tarihi='$_POST[dogum_tarihi]',sehir='$_POST[sehir]',gercek_ad='$_POST[gercek_ad]',resim='$kul_resim',imza='$_POST[imza]',posta_goster='$_POST[posta_goster]',dogum_tarihi_goster='$_POST[dogum_tarihi_goster]',sehir_goster='$_POST[sehir_goster]',yetki='$_POST[yetki]',gizli='$_POST[gizli]',icq='$_POST[icq]',aim='$_POST[aim]',msn='$_POST[msn]',yahoo='$_POST[yahoo]',skype='$_POST[skype]',temadizini='$_POST[tema_secim]',ozel_ad='$_POST[ozel_ad]',grupid='$_POST[grup]',cinsiyet='$_POST[cinsiyet]',hakkinda='$_POST[hakkinda]' $temadizinip_sorgu WHERE id='$satir[id]' LIMIT 1";

$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());



// eski ve yeni yetkisi bölüm yardımcısı ise bir şey yapma
if (($_POST['eski_yetki'] == '3') AND ($_POST['yetki'] == '3'));


else
{
	// yeni yetkisi kayıtlı kullanıcı ise sadece yönetme yetkisi olan özel izinlerini sil
	if ($_POST['yetki'] == '0')
	{
		$vtsorgu = "DELETE FROM $tablo_ozel_izinler WHERE kulad='$satir[kullanici_adi]' AND yonetme='1'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}


	// yeni yetkisi yönetici veya forum yardımcısı ise tüm özel izinlerini sil
	elseif (($_POST['yetki'] == '1') OR ($_POST['yetki'] == '2'))
	{
		$vtsorgu = "DELETE FROM $tablo_ozel_izinler WHERE kulad='$satir[kullanici_adi]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}
}





//   GRUP AYARLARI - BAŞI   //

if ($satir['grupid'] != $_POST['grup'])
{
	// seçilen grubun bilgileri çekiliyor
	$vtsorgu = "SELECT id,yetki,uyeler,ozel_ad FROM $tablo_gruplar WHERE id='$_POST[grup]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$grupsatir = $vt->fetch_assoc($vtsonuc);


	// grup seçimi yapılmışsa
	if ($_POST['grup'] != '0')
	{
		// seçilen grubun yetkisi varsa üyeye uygulanıyor
		if ($grupsatir['yetki'] != '-1')
		{
			$vtsorgu = "UPDATE $tablo_kullanicilar SET yetki='$grupsatir[yetki]',ozel_ad='$grupsatir[ozel_ad]' WHERE id='$satir[id]'";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}

		// yoksa sadece özel ad değiştiriliyor
		else
		{
			$vtsorgu = "UPDATE $tablo_kullanicilar SET ozel_ad='$grupsatir[ozel_ad]' WHERE id='$satir[id]'";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}

		// daha önceden ek gruba eklenmemişse
		if (!preg_match("/$satir[id],/", $grupsatir['uyeler']))
		{
			// üye gruba ekleniyor
			$vtsorgu = "UPDATE $tablo_gruplar SET uyeler=CONCAT(uyeler,'$satir[id],') WHERE id='$_POST[grup]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}
	}
}

//   GRUP AYARLARI - SONU   //




//   EK GRUP SEÇİMİ - BAŞI   //

if ((isset($_POST['grup'])) AND ($_POST['grup'] != '0')) $sorguek = " AND id!='$_POST[grup]'";
else $sorguek = '';


// ek grup seçimi yapılmışsa
if ( (isset($_POST['grupc'])) AND (is_array($_POST['grupc'])) )
{
	// grup seçimleri sıralanıyor
	foreach ($_POST['grupc'] as $grupc)
	{
		// boş ve geçersiz olanlar geçiliyor
		if (($grupc == '') OR (!preg_match('/^[0-9]+$/', $grupc))) continue;

		// birincil grup geçiliyor
		if ((isset($_POST['grup'])) AND ($_POST['grup'] != '0') AND ($_POST['grup'] == $grupc)) continue;

		// seçilen grubun bilgileri çekiliyor
		$vtsorgu = "SELECT id,uyeler FROM $tablo_gruplar WHERE id='$grupc' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$gruplar = $vt->fetch_assoc($vtsonuc);


		// seçilen gruba dahil değilse ekleniyor
		if (!preg_match("/$satir[id],/", $gruplar['uyeler']))
		{
			$vtsorgu = "UPDATE $tablo_gruplar SET uyeler=CONCAT(uyeler,'$satir[id],') WHERE id='$grupc' LIMIT 1";
			$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}

		$sorguek .= " AND id!='$grupc'";
	}
}


// seçili olmayan gruplardaki üyeliklerine bakılıyor
$vtsorgu2 = "SELECT id,grup_adi,uyeler FROM $tablo_gruplar WHERE uyeler LIKE '%$satir[id],%' $sorguek ORDER BY id";
$vtsonucg = $vt->query($vtsorgu2) or die ($vt->hata_ver());

// gruplar sıralanıyor
while ($gruplar = $vt->fetch_assoc($vtsonucg))
{
	$cikart = str_replace("$satir[id],", '', $gruplar['uyeler']);

	// seçili olmayan gruplardaki üyelikleri siliniyor
	$vtsorgu = "UPDATE $tablo_gruplar SET uyeler='$cikart' WHERE id='$gruplar[id]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
}

	//   EK GRUP SEÇİMİ - SONU   //



	header('Location: ../hata.php?bilgi=32&mesaj_no='.$satir['id']);
	exit();

endif;
?>