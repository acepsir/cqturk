<?php
/*
 +-=========================================================================-+
 |                                phpKF v3.00                                |
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


@session_start();
$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='2' OR kip='4'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_GERECLER')) include_once('gerecler.php');
if ((isset($_SERVER['HTTP_REFERER'])) AND (@preg_match('/\/kayit.php$/', $_SERVER['HTTP_REFERER']))) $phpkf_dosyalar['hata'] = 'hata.php';



// ziyaretçi ip adresi alınıyor
if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
else $ip = $_SERVER['REMOTE_ADDR'];
$ip = zkTemizle4($ip);
$ip = zkTemizle($ip);


// üye alımı kapalıysa
if ($ayarlar['kayit_uyelik'] != 1)
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?uyari=9');
	exit();
}


// kayıt deneme sayısı her denemede arttırılıyor
if (empty($_SESSION['kayit_deneme'])) $_SESSION['kayit_deneme'] = 1;
else $_SESSION['kayit_deneme']++;


// kayıt denemesi beşe ulaştığında hata iletisi veriliyor
if ($_SESSION['kayit_deneme'] > 5)
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=25');
	exit();
}


// BİLGİLERİ TEKRAR GİRMEYE GEREK KALMAMASI İÇİN OTURUMA KAYDEDİLİYOR
$_SESSION['kullanici_adi'] = zkTemizle4($_POST['kullanici_adi']);
$_SESSION['posta'] = zkTemizle4($_POST['posta']);




// kayıt sorusu özelliği açık ise
if ($ayarlar['kayit_soru'] == '1') $_SESSION['kayit_cevabi'] = zkTemizle4($_POST['kayit_cevabi']);

// onay kodu kapalı ise
if ($ayarlar['kayit_onay_kodu'] != '1')
{
	$_POST['onay_kodu'] = 'kapali';
	$_SESSION['onay_kodu'] = 'kapali';
}



// KAYIT ALANINDA EKSİK VARSA UYARILIYOR
if ( (!@$_POST['kullanici_adi']) OR (!@$_POST['sifre']) OR (!@$_POST['posta']) ):

header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=26');
exit();





// GÖRSEL ONAY KODU DOĞRU İSE DEVAM
elseif ( (isset($_POST['onay_kodu'])) AND (!is_array($_POST['onay_kodu'])) AND (isset($_SESSION['onay_kodu'])) AND (@strtolower($_POST['onay_kodu']) == @strtolower($_SESSION['onay_kodu'])) ):



// KAYIT BİLGİLERİNİN DOĞRULUĞU DENETLENİYOR //

if (!preg_match('/^[A-Za-z0-9-_ğĞüÜŞşİıÖöÇç.]+$/', $_POST['kullanici_adi']))
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=27');
	exit();
}
if ((strlen($_POST['kullanici_adi']) > 20) OR (strlen($_POST['kullanici_adi']) < 4))
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=28');
	exit();
}

if ($_POST['sifre'] != $_POST['sifre2'])
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=33');
	exit();
}
if (!preg_match('/^[A-Za-z0-9-_.&]+$/', $_POST['sifre']))
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=34');
	exit();
}
if ((strlen($_POST['sifre']) > 20) OR (strlen($_POST['sifre']) < 5))
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=35');
	exit();
}

if (strlen($_POST['posta']) > 100)
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=40');
	exit();
}

if (!preg_match('/^([~&+.0-9a-z_-]+)@(([~&+0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', $_POST['posta']))
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=10');
	exit();
}

if ($ayarlar['kayit_soru'] == 1)
{
	if (strtolower($_POST['kayit_cevabi']) != strtolower($ayarlar['kayit_cevabi']))
	{
		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=41');
		exit();
	}
}





//  YASAKLAR - BAŞI  //


// YASAK KULLANICI ADLARI ALINIYOR
$vtsorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='kulad' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
$yasak_kulad = $vt->fetch_row($vtsonuc);
$ysk_kuladd = explode("\r\n", $yasak_kulad[0]);


// KULLANICI ADI YASAKLARLARI
if ($ysk_kuladd[0] != '')
{
	$dongu_sayi = count($ysk_kuladd);
	for ($d=0; $d < $dongu_sayi; $d++)
	{
		if ( (!preg_match('/^\*/', $ysk_kuladd[$d])) AND (!preg_match('/\*$/', $ysk_kuladd[$d])) )
			$ysk_kuladd[$d] = '^'.$ysk_kuladd[$d].'$';

		elseif (!preg_match('/^\*/', $ysk_kuladd[$d])) $ysk_kuladd[$d] = '^'.$ysk_kuladd[$d];

		elseif (!preg_match('/\*$/', $ysk_kuladd[$d])) $ysk_kuladd[$d] .= '$';

		$ysk_kuladd[$d] = str_replace('*', '', $ysk_kuladd[$d]);


		if (preg_match("/$ysk_kuladd[$d]/i", $_POST['kullanici_adi']))
		{
			header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=29');
			exit();
		}
	}
}




// YASAK POSTA ADRESLERİ ALINIYOR
$vtsorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='posta' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
$yasak_posta = $vt->fetch_row($vtsonuc);
$ysk_postad = explode("\r\n", $yasak_posta[0]);


// E-POSTA ADRESİ YASAKLARI
if ($ysk_postad[0] != '')
{
	$dongu_sayi = count($ysk_postad);
	for ($i=0; $i<$dongu_sayi; $i++)
	{
		if ( (!preg_match('/^\*/', $ysk_postad[$i])) AND (!preg_match('/\*$/', $ysk_postad[$i])) )
		$ysk_postad[$i] = '^'.$ysk_postad[$i].'$';

		elseif (!preg_match('/^\*/', $ysk_postad[$i])) $ysk_postad[$i] = '^'.$ysk_postad[$i];

		elseif (!preg_match('/\*$/', $ysk_postad[$i])) $ysk_postad[$i] .= '$';

		$ysk_postad[$i] = str_replace('*', '', $ysk_postad[$i]);


		if (preg_match("/$ysk_postad[$i]/i", $_POST['posta']))
		{
			header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=30');
			exit();
		}
	}
}

//  YASAKLAR - SONU  //






if ($_POST['kayit_yapildi_mi'] == 'form_dolu')
{
	$tarih = time();
	$kullanici_adi = zkTemizle($_POST['kullanici_adi']);
	$posta = zkTemizle($_POST['posta']);
	$dogum_tarihi = '00-00-0000';


	// KULLANICI ADININ DAHA ÖNCE ALINIP ALINMADIĞI DENETLENİYOR
	$vtsorgu = "SELECT kullanici_adi FROM $tablo_kullanicilar WHERE kullanici_adi='$kullanici_adi'";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
	if ($vt->num_rows($vtsonuc))
	{
		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=42');
		exit();
	}

	// E-POSTA İLE DAHA ÖNCE KAYIT YAPILIP YAPILMADIĞI DENETLENİYOR
	$vtsorgu = "SELECT posta FROM $tablo_kullanicilar WHERE posta='$posta'";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
	if ($vt->num_rows($vtsonuc))
	{
		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=43');
		exit();
	}

	else
	{
		// anahtar değeri şifreyle karıştırılarak sha1 ile kodlanıyor
		$karma = sha1(($anahtar.$_POST['sifre']));

		// hesap ektinleştirme kapalı
		if ($ayarlar['kayit_hesap_etkin'] == 0)
		{
			$kul_etkin = 1;
			$kul_etkin_kod = 0;
		}

		// hesap ektinleştirme açık
		else
		{
			// etkinleştirme kodu oluşturuluyor
			$kul_etkin = 0;
			$kul_etkin_kod = sha1(microtime());
			$kul_etkin_kod = substr($kul_etkin_kod,9,10);
		}

		$vtsorgu = "INSERT INTO $tablo_kullanicilar (kullanici_adi, sifre, posta, posta_goster, gercek_ad, dogum_tarihi, dogum_tarihi_goster, katilim_tarihi, sehir, sehir_goster, kul_etkin, kul_etkin_kod, son_giris, son_hareket, kul_ip, sayfano, hangi_sayfada)";

		$vtsorgu .= "VALUES ('$kullanici_adi','$karma','$posta','0','$kullanici_adi','$dogum_tarihi','0','$tarih','','0','$kul_etkin','$kul_etkin_kod','$tarih','$tarih','$ip','-1','')";

		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		$kulid = $vt->insert_id();



		// phpkf-bilsesenler/postalar/kayit.txt dosyasındaki yazılar alınıyor

		$posta_baslik = $ayarlar['site_adi'].' Sitesine Hoş Geldiniz';
		if ($ayarlar['kayit_hesap_etkin'] == 0)
		{
			$dosya = './postalar/kayit0.txt';
			$site_link = $TEMA_SITE_ANADIZIN.$phpkf_dosyalar['giris'];
		}
		elseif ($ayarlar['kayit_hesap_etkin'] == 1)
		{
			$dosya = './postalar/kayit1.txt';
			$site_link = $TEMA_SITE_ANADIZIN.'phpkf-bilesenler/kul_etkin.php?kulid='.$kulid.'&kulkod='.$kul_etkin_kod;
		}
		else
		{
			$dosya = './postalar/kayit2.txt';
			$site_link = $TEMA_SITE_ANADIZIN.'phpkf-bilesenler/kul_etkin.php?kulid='.$kulid.'&kulkod='.$kul_etkin_kod;
		}


		if (!($dosya_ac = fopen($dosya,'r'))) die ('Dosya Açılamıyor');
		$posta_metni = fread($dosya_ac,3072);
		fclose($dosya_ac);

		$bul = array('{siteadi}',
		'{kullanici_adi}',
		'{sifre}',
		'{posta}',
		'{site_link}');

		$cevir = array($ayarlar['site_adi'],
		$_POST['kullanici_adi'],
		$_POST['sifre'],
		$_POST['posta'],
		$site_link);

		$posta_metni = str_replace($bul,$cevir,$posta_metni);




		// HESAP BİLGİLERİ VE HESAP ETKİNLEŞTİRME KODU POSTALANIYOR
		require('sinif_eposta.php');
		$mail = new eposta_yolla();


		if ($ayarlar['eposta_yontem'] == 'mail') $mail->MailKullan();
		elseif ($ayarlar['eposta_yontem'] == 'smtp') $mail->SMTPKullan();


		$mail->sunucu = $ayarlar['smtp_sunucu'];
		if ($ayarlar['smtp_kd'] == '1') $mail->smtp_dogrulama = true;
		else $mail->smtp_dogrulama = false;
		$mail->kullanici_adi = $ayarlar['smtp_kullanici'];
		$mail->sifre = $ayarlar['smtp_sifre'];

		$mail->gonderen = $ayarlar['site_posta'];
		$mail->gonderen_adi = $ayarlar['site_adi'];

		$mail->GonderilenAdres($_POST['posta']);

		$mail->YanitlamaAdres($ayarlar['site_posta']);
		$mail->konu = $posta_baslik;
		$mail->icerik = $posta_metni;



		if ($mail->Yolla())
		{
			// KAYIT İŞLEMİ TAMAMLANDI, EKRAN ÇIKTISI VERİLİYOR
			if ($ayarlar['kayit_hesap_etkin'] == 0)
			{
				header('Location: ../'.$phpkf_dosyalar['hata'].'?bilgi=15');
				exit();
			}
			elseif ($ayarlar['kayit_hesap_etkin'] == 1)
			{
				header('Location: ../'.$phpkf_dosyalar['hata'].'?bilgi=16');
				exit();
			}
			else
			{
				header('Location: ../'.$phpkf_dosyalar['hata'].'?bilgi=17');
				exit();
			}
		}

		else
		{
			// E-POSTA GÖNDERİLEMEDİ
			if ($ayarlar['kayit_hesap_etkin'] == 0)
			{
				header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=198');
				exit();
			}
			elseif ($ayarlar['kayit_hesap_etkin'] == 1)
			{
				header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=11');
				exit();
			}
			else
			{
				header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=199');
				exit();
			}
		}
	}
}

$gec = '';



else:

header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=44');
exit();

endif;

?>