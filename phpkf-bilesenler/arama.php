<?php
/*
 +-=========================================================================-+
 |                              phpKF-CMS v3.00                              |
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


$arama_kota = 10;

if (!defined('DOSYA_AYAR')) include_once('phpkf-ayar.php');
if (!defined('DOSYA_GERECLER')) include_once('phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('phpkf-bilesenler/sinif_tema.php');
if (!defined('DOSYA_BLOKLAR')) include_once('phpkf-bilesenler/bloklar.php');


// Arama Varsa
if ((isset($_GET['arama'])) AND (trim($_GET['arama']) != '') AND (strlen(trim($_GET['arama']))>2))
{
	$arama = zkTemizle($_GET['arama']);

	// sayfa değişkeni temizleniyor
	if (isset($_GET['as']))
	{
		$sayfano = zkTemizleNumara($_GET['as']);
		if ($sayfano == 0) $sayfano = 1;
	}
	else $sayfano = 1;


	// Dil seçimine göre içerik alınıyor
	$eksorgu = '';
	if ( ($ayarlar['dil_varsayilan'] != $site_dili) AND (preg_match("/,$site_dili,/", $ayarlar['dil_eklenen_alanlar'])) )
	{
		$eksorgu = "OR baslik_$site_dili LIKE '%$arama%' OR icerik_$site_dili LIKE '%$arama%'";
	}


	// toplam alınıyor
	$vtsorgu = "SELECT * FROM $tablo_yazilar WHERE baslik LIKE '%$arama%' OR icerik LIKE '%$arama%' $eksorgu";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$toplam_yazi = $vt->num_rows($vtsonuc);


	// sayfama alanı oluşturuluyor
	$TEMA_SAYFALAMA = phpkf_sayfalama($toplam_yazi, $arama_kota, $sayfano, 'as=');

	// sayfalama koşulu
	$kosul_sayfa = ($sayfano * $arama_kota)-$arama_kota;



	$vtsorgu = "SELECT * FROM $tablo_yazilar WHERE baslik LIKE '%$arama%' OR icerik LIKE '%$arama%' $eksorgu ORDER BY id DESC LIMIT $kosul_sayfa,$arama_kota";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while($yazi = $vt->fetch_assoc($vtsonuc))
	{
		// yazının ilk kategorisi bulunuyor
		$kat_id = explode(',', $yazi['kategori']);
		$kat_id = $kat_id[1];


		if ( ($ayarlar['dil_varsayilan'] != $site_dili) AND (preg_match("/,$site_dili,/", $ayarlar['dil_eklenen_alanlar'])) )
		{
			if (isset($yazi["etiket_$site_dili"])) $yazi['etiket'] = $yazi["etiket_$site_dili"];
			if (isset($yazi["baslik_$site_dili"])) $yazi['baslik'] = $yazi["baslik_$site_dili"];
			if (isset($yazi["icerik_$site_dili"])) $yazi['icerik'] = $yazi["icerik_$site_dili"];
		}


		$yazi['icerik'] = stripslashes(strip_tags($yazi['icerik']));
		if (preg_match('/(.*?){{DEVAMI}}/is',$yazi['icerik'], $sicerik, PREG_OFFSET_CAPTURE)) $yazi['icerik'] = $sicerik[0][0];
		elseif (mb_strlen($yazi['icerik']) > 1000) $yazi['icerik'] = mb_substr($yazi['icerik'],0,1000, 'utf-8').'.....';

		$bul = array('{{DEVAMI}}', $arama);
		$degis = array('', '<b style="background:#ffff00">'.$arama.'</b>');
		$yazi['icerik'] = @str_ireplace($bul, $degis, $yazi['icerik']);


		$yazi['goruntuleme'] = NumaraBicim($yazi['goruntuleme']);
		$yazi['yorum_sayi'] = NumaraBicim($yazi['yorum_sayi']);
		$yazi['tarih_ham'] = $yazi['tarih'];
		$yazi['yayin_tarihi_ham'] = $yazi['yayin_tarihi'];
		$yazi['tarih'] = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $yazi['tarih'], $ayarlar['tarih'], true);
		$yazi['yayin_tarihi'] = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $yazi['yayin_tarihi'], $ayarlar['tarih'], true);
		$yazi['link'] = linkyap($phpkf_dosyalar['cms'].'?k='.$kat_id.'&y='.$yazi['id'], $tum_kategoriler[$kat_id]['adres'], $yazi['adres']);

		$yazan_adi = explode(';', $yazi['yazan']);
		if ($ayarlar['yazan_adi'] != 1) $yazi['yazan'] = $yazan_adi[0];
		else $yazi['yazan'] = $yazan_adi[1];
		$yazan_adi = $yazan_adi[0];
		$yazi['profil'] = linkyap($phpkf_dosyalar['profil'].'?u='.$yazi['yazan_id'].'&kim='.$yazan_adi,$yazan_adi);

		$yazilar[] = $yazi;
	}

	if (!isset($yazilar)) $yazilar = false;


	$sayfa_adi = $l['arama'].': '.$arama;
	$TEMA_SAYFA_BASLIK = $l['arama'].': '.$arama;
	$arama_sonuc_yok = true;
}


// Arama Yoksa
else
{
	$sayfa_adi = $l['arama'];
	$TEMA_SAYFA_BASLIK = $l['arama'];
	$TEMA_SAYFALAMA = '';
	$arama_sonuc_yok = false;

	$yazilar = array();
}


// tema dosyası yükleniyor
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/arama.php'));
?>