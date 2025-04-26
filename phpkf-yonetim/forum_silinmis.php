<?php
/*
 +-=========================================================================-+
 |                              phpKF Forum v3.00                            |
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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_KULLANICI_KIMLIK')) include_once('../phpkf-bilesenler/kullanici_kimlik.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');


$dosya_adi = 'forum_silinmis.php';
$dosya_konu_silinmis = 'forum_konu_silinmis.php';



// site kurucusu değilse hata ver
if ($kullanici_kim['id'] != 1)
{
	header('Location: hata.php?hata=151');
	exit();
}


// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';


//  BAŞLIĞI GERİ YÜKLEME İŞLEMLERİ   //

if ( (isset($_GET['kurtark'])) AND ($_GET['kurtark'] != '') )
{
	if (isset($_GET['kurtark'])) $_GET['kurtark'] = @zkTemizle($_GET['kurtark']);


	if (is_numeric($_GET['kurtark']) == false)
	{
		header('Location: hata.php?hata=47');
		exit();
	}


	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}

	// başlığın bilgileri çekiliyor
	$vtsorgu = "SELECT hangi_forumdan,silinmis FROM $tablo_mesajlar WHERE id='$_GET[kurtark]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// başlık yoksa
	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: hata.php?hata=47');
		exit();
	}

	$fno = $vt->fetch_assoc($vtsonuc);
	// başlık zaten geri yüklenmişse
	if ($fno['silinmis'] != 1)
	{
		header('Location: hata.php?hata=168');
		exit();
	}


	// başlığın silinen cevapları varsa döngüye sokularak teker teker geri yükleniyor
	$vtsorgu1 = "SELECT id FROM $tablo_cevaplar WHERE hangi_basliktan='$_GET[kurtark]' ORDER BY id DESC";
	$vtsonuc_konu = $vt->query($vtsorgu1) or die ($vt->hata_ver());


	$toplam_cevap = 0;

	while ($cevaplari_yukle = $vt->fetch_assoc($vtsonuc_konu))
	{
		$vtsorgu2 = "UPDATE $tablo_cevaplar SET silinmis=0 WHERE id='$cevaplari_yukle[id]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu2) or die ($vt->hata_ver());


		// forumun cevap sayisi arttırılıyor
		$vtsorgu3 = "UPDATE $tablo_forumlar SET cevap_sayisi=cevap_sayisi + 1 WHERE id='$fno[hangi_forumdan]' LIMIT 1";
		$vtsonuc3 = $vt->query($vtsorgu3) or die ($vt->hata_ver());
		$toplam_cevap++;
	}


	// başlığın son cevabı çekiliyor
	$vtsorgu = "SELECT id,tarih,cevap_yazan FROM $tablo_cevaplar WHERE hangi_basliktan='$_GET[kurtark]' ORDER BY tarih DESC LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$son_mesaj = $vt->fetch_assoc($vtsonuc);


	// cevabı yoksa
	if (empty($son_mesaj['tarih']))
		$vtsorgu = "UPDATE $tablo_mesajlar SET silinmis=0, cevap_sayi=0, son_mesaj_tarihi=tarih, son_cevap=0, son_cevap_yazan=NULL WHERE id='$_GET[kurtark]'";

	// cevabı varsa
	else $vtsorgu = "UPDATE $tablo_mesajlar SET silinmis=0, cevap_sayi='$toplam_cevap', son_mesaj_tarihi='$son_mesaj[tarih]', son_cevap='$son_mesaj[id]', son_cevap_yazan='$son_mesaj[cevap_yazan]' WHERE id='$_GET[kurtark]'";

	// konu geri yükleniyor, son mesaj tarihi ve son cevap bilgileri güncelleniyor
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// forumun konu sayısı arttırılıyor
	$vtsorgu = "UPDATE $tablo_forumlar SET konu_sayisi=konu_sayisi + 1 WHERE id='$fno[hangi_forumdan]' LIMIT 1";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());


	header('Location: ../konu.php?k='.$_GET['kurtark']);
	exit();
}




//  CEVABI GERİ YÜKLEME İŞLEMLERİ   //

elseif ( (isset($_GET['kurtarc'])) AND ($_GET['kurtarc'] != '') )
{
	if (isset($_GET['kurtarc'])) $_GET['kurtarc'] = @zkTemizle($_GET['kurtarc']);


	if (is_numeric($_GET['kurtarc']) == false)
	{
		header('Location: hata.php?hata=55');
		exit();
	}


	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	// cevabın bilgileri çekiliyor
	$vtsorgu = "SELECT hangi_forumdan,silinmis,hangi_basliktan FROM $tablo_cevaplar WHERE id='$_GET[kurtarc]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// cevap yoksa
	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: hata.php?hata=55');
		exit();
	}

	$fno = $vt->fetch_assoc($vtsonuc);
	// cevap zaten geri yüklenmişse
	if ($fno['silinmis'] != 1)
	{
		header('Location: hata.php?hata=169');
		exit();
	}


	// cevap geri yükleniyor
	$vtsorgu = "UPDATE $tablo_cevaplar SET silinmis=0 WHERE id='$_GET[kurtarc]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// forumun cevap sayısı arttırılıyor
	$vtsorgu = "UPDATE $tablo_forumlar SET cevap_sayisi=cevap_sayisi + 1 WHERE id='$fno[hangi_forumdan]' LIMIT 1";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// başlığın son cevabı çekiliyor
	$vtsorgu = "SELECT id,tarih,cevap_yazan FROM $tablo_cevaplar WHERE silinmis=0 AND hangi_basliktan='$fno[hangi_basliktan]' ORDER BY tarih DESC LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$son_mesaj = $vt->fetch_assoc($vtsonuc);


	// başka cevabı yoksa, başlık tarihi son mesaj tarihi olarak giriliyor, cevap_sayi ve son_cevap sıfır yapılıyor, son_cevap_yazan siliniyor
	if (empty($son_mesaj['tarih']))
	{
		$vtsorgu = "UPDATE $tablo_mesajlar SET cevap_sayi=0, son_mesaj_tarihi=tarih, son_cevap=0, son_cevap_yazan=NULL WHERE id='$fno[hangi_basliktan]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}

	// cevap varsa, tarihi son mesaj tarihi olarak giriliyor, cevap sayısı bir arttırılıyor, cevap no ve cevap yazan giriliyor
	else
	{
		$vtsorgu = "UPDATE $tablo_mesajlar SET cevap_sayi=cevap_sayi + 1, son_mesaj_tarihi='$son_mesaj[tarih]', son_cevap='$son_mesaj[id]', son_cevap_yazan='$son_mesaj[cevap_yazan]' WHERE id='$fno[hangi_basliktan]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}

	if (is_numeric($_GET['ks']) == false) $_GET['ks'] = 0;

	header('Location: ../konu.php?k='.$fno['hangi_basliktan'].'&amp;ks='.$_GET['ks'].'#c'.$_GET['kurtarc']);
	exit();
}




//  YORUMU GERİ YÜKLEME İŞLEMLERİ   //

elseif ( (isset($_GET['kurtary'])) AND ($_GET['kurtary'] != '') )
{
	if (isset($_GET['kurtarc'])) $_GET['kurtary'] = @zkTemizle($_GET['kurtarc']);


	if (is_numeric($_GET['kurtary']) == false)
	{
		header('Location: hata.php?hata=209');
		exit();
	}


	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	// yorumun bilgileri çekiliyor
	$vtsorgu = "SELECT id,silinmis,uye_id,yazan_id FROM $tablo_pyorumlar WHERE id='$_GET[kurtary]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// yorum yoksa
	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: hata.php?hata=209');
		exit();
	}

	$yno = $vt->fetch_assoc($vtsonuc);
	// yorum zaten geri yüklenmişse
	if ($yno['silinmis'] != 1)
	{
		header('Location: hata.php?hata=210');
		exit();
	}


	// yorum geri yükleniyor
	$vtsorgu = "UPDATE $tablo_pyorumlar SET silinmis=0, onay=1 WHERE id='$_GET[kurtary]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// yorum yazanın yorum sayısı arttırılıyor
	$vtsorgu = "UPDATE $tablo_kullanicilar SET yrm_yapilan=yrm_yapilan + 1 WHERE id='$yno[yazan_id]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// yorum yapılanın yorum sayısı arttırılıyor
	$vtsorgu = "UPDATE $tablo_kullanicilar SET yrm_sayi=yrm_sayi + 1 WHERE id='$yno[uye_id]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	header('Location: hata.php?bilgi=53');
	exit();
}




//  BAŞLIK KALICI SİLME İŞLMELERİ   //

elseif ( (isset($_GET['silk'])) AND ($_GET['silk'] != '') )
{
	if (isset($_GET['silk'])) $_GET['silk'] = @zkTemizle($_GET['silk']);


	if (is_numeric($_GET['silk']) == false)
	{
		header('Location: hata.php?hata=47');
		exit();
	}


	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	// başlığın bilgileri çekiliyor
	$vtsorgu = "SELECT hangi_forumdan,yazan FROM $tablo_mesajlar WHERE id='$_GET[silk]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// başlık yoksa
	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: hata.php?hata=47');
		exit();
	}

	$fno = $vt->fetch_assoc($vtsonuc);


	// başlık siliniyor
	$vtsorgu = "DELETE FROM $tablo_mesajlar WHERE id='$_GET[silk]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// konu açanın mesaj sayısı eksiltiliyor
	$vtsorgu = "UPDATE $tablo_kullanicilar SET mesaj_sayisi=mesaj_sayisi - 1 WHERE kullanici_adi='$fno[yazan]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// cevapların bilgileri çekiliyor
	$vtsorgu = "SELECT id,cevap_yazan FROM $tablo_cevaplar WHERE hangi_basliktan='$_GET[silk]'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($cevaplar = $vt->fetch_assoc($vtsonuc))
	{
		// başlığın cevapları varsa siliniyor
		$vtsorgu2 = "DELETE FROM $tablo_cevaplar WHERE id='$cevaplar[id]' LIMIT 1";
		$vtsonuc2 = $vt->query($vtsorgu2) or die ($vt->hata_ver());

		// cevap yazanın mesaj sayısı eksiltiliyor
		$vtsorgu3 = "UPDATE $tablo_kullanicilar SET mesaj_sayisi=mesaj_sayisi - 1 WHERE kullanici_adi='$cevaplar[cevap_yazan]' LIMIT 1";
		$vtsonuc3 = $vt->query($vtsorgu3) or die ($vt->hata_ver());
	}


	header('Location: hata.php?bilgi=6&fno='.$fno['hangi_forumdan'].'&fsayfa=0');
	exit();
}




//  CEVAP KALICI SİLME İŞLMELERİ   //

elseif ( (isset($_GET['silc'])) AND ($_GET['silc'] != '') )
{
	if (isset($_GET['silc'])) $_GET['silc'] = @zkTemizle($_GET['silc']);


	if (is_numeric($_GET['silc']) == false)
	{
		header('Location: hata.php?hata=55');
		exit();
	}


	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	// cevabın bilgileri çekiliyor
	$vtsorgu = "SELECT hangi_basliktan,cevap_yazan FROM $tablo_cevaplar WHERE id='$_GET[silc]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// cevap yoksa
	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: hata.php?hata=55');
		exit();
	}

	$fno = $vt->fetch_assoc($vtsonuc);


	// cevap siliniyor
	$vtsorgu = "DELETE FROM $tablo_cevaplar WHERE id='$_GET[silc]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// cevap yazanın mesaj sayısı eksiltiliyor
	$vtsorgu = "UPDATE $tablo_kullanicilar SET mesaj_sayisi=mesaj_sayisi - 1 WHERE kullanici_adi='$fno[cevap_yazan]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	header('Location: hata.php?bilgi=8&mesaj_no='.$fno['hangi_basliktan'].'&fsayfa=0&sayfa=0');
	exit();
}




//  YORUMU KALICI SİLME İŞLMELERİ   //

elseif ( (isset($_GET['sily'])) AND ($_GET['sily'] != '') )
{
	if (isset($_GET['sily'])) $_GET['sily'] = @zkTemizle($_GET['sily']);


	if (is_numeric($_GET['sily']) == false)
	{
		header('Location: hata.php?hata=209');
		exit();
	}


	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	// yorumun bilgileri çekiliyor
	$vtsorgu = "SELECT id FROM $tablo_pyorumlar WHERE id='$_GET[sily]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// yorum yoksa
	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: hata.php?hata=209');
		exit();
	}

	$fno = $vt->fetch_assoc($vtsonuc);


	// yorum siliniyor
	$vtsorgu = "DELETE FROM $tablo_pyorumlar WHERE id='$_GET[sily]'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	header('Location: hata.php?bilgi=52');
	exit();
}







//  SAYFA NORMAL GÖSTERİM BAŞI  //
//  SAYFA NORMAL GÖSTERİM BAŞI  //
//  SAYFA NORMAL GÖSTERİM BAŞI  //


// Simgeler
$simge_sil = 'temalar/varsayilan/resimler/sil.png"';
$simge_degistir = 'temalar/varsayilan/resimler/degistir.png"';
$simge_ip = 'temalar/varsayilan/resimler/ip.png"';
$simge_gerial = 'temalar/varsayilan/resimler/gerial.png"';

$gerial_simge = '<img src="../'.$simge_gerial.'" width="22" height="22" alt="d" style="margin-left:5px; margin-right:5px" title="'.$ly['degistir'].'" />';
$sil_simge = '<img src="../'.$simge_sil.'" width="22" height="22" alt="s" style="margin-left:5px; margin-right:5px" title="'.$l['sil'].'" />';



// FORUM BAŞLIKLARI ÇEKİLİYOR
$vtsorgu = "SELECT id,forum_baslik FROM $tablo_forumlar";
$vtsonuc4 = $vt->query($vtsorgu) or die ($vt->hata_ver());

while ($forum_satir = $vt->fetch_assoc($vtsonuc4))
	$tumforum_satir[$forum_satir['id']] = $forum_satir['forum_baslik'];


// SİLİNMİŞ KONULAR ÇEKİLİYOR
$vtsorgu = "SELECT id,yazan,hangi_forumdan,son_mesaj_tarihi,cevap_sayi,goruntuleme,mesaj_baslik,yazan,son_cevap_yazan FROM $tablo_mesajlar WHERE silinmis='1' ORDER BY son_mesaj_tarihi";
$vtsonuc10 = $vt->query($vtsorgu) or die ($vt->hata_ver());

// SİLİNMİŞ CEVAPLAR ÇEKİLİYOR
$vtsorgu = "SELECT id,tarih,cevap_baslik,cevap_yazan,hangi_basliktan,hangi_forumdan FROM $tablo_cevaplar WHERE silinmis='1' ORDER BY id";
$vtsonuc11 = $vt->query($vtsorgu) or die ($vt->hata_ver());


// SİLİNMİŞ YORUMLAR ÇEKİLİYOR
$vtsorgu = "SELECT * FROM $tablo_pyorumlar WHERE silinmis=1 ORDER BY id";
$vtsonuc13 = $vt->query($vtsorgu) or die ($vt->hata_ver());




// tema dosyası yükleniyor
$sayfa_adi = $ly['silinen_iletiler'];
$tema_sayfa_baslik = $ly['silinen_iletiler'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/forum_silinmis.php'));

?>