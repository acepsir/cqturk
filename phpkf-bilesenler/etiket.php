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


$etiket_kota = 10;

if (!defined('DOSYA_AYAR')) include_once('phpkf-ayar.php');
if (!defined('DOSYA_GERECLER')) include_once('phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('phpkf-bilesenler/sinif_tema.php');
if (!defined('DOSYA_BLOKLAR')) include_once('phpkf-bilesenler/bloklar.php');


// Etiket Varsa
if ((isset($_GET['etiket'])) AND (trim($_GET['etiket']) != ''))
{
	$etiket = zkTemizle($_GET['etiket']);

	// sayfa değişkeni temizleniyor
	if (isset($_GET['es']))
	{
		$sayfano = zkTemizleNumara($_GET['es']);
		if ($sayfano == 0) $sayfano = 1;
	}
	else $sayfano = 1;


	// yazıların toplamı alınıyor
	$toplam_yazi = phpkf_tema_toplam_yazi(array('etiket' => $etiket));

	// sayfama alanı oluşturuluyor
	$TEMA_SAYFALAMA = phpkf_sayfalama($toplam_yazi, $etiket_kota, $sayfano, 'es=');

	// sayfalama koşulu
	$kosul_sayfa = ($sayfano * $etiket_kota)-$etiket_kota;

	$etiket_kosul = array(
	'alan' => '*',
	'tum_icerik' => 0,
	'etiket' => $etiket,
	'sayfa' => $kosul_sayfa,
	'kota' => $etiket_kota,
	);

	$sayfa_adi = $l['etiket'].': '.$etiket;
	$TEMA_SAYFA_BASLIK = $l['etiket'].': '.$etiket;
	$etiket_sonuc_yok = true;
}


// Etiket Yoksa
else
{
	$etiket = '';
	$TEMA_SAYFALAMA = '';

	$etiket_kosul = array(
	'etiket' => 'yok-etiket-yok',
	'sayfa' => 999,
	'kota' => 1,
	);

	$sayfa_adi = $l['etiket'];
	$TEMA_SAYFA_BASLIK = $l['etiket'];
	$etiket_sonuc_yok = false;
}


// tema dosyası yükleniyor
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/etiket.php'));
?>