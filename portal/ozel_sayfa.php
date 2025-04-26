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


// dosyası ınclude ediliyor.
if (!defined('DOSYA_AYAR')) include '../ayar.php';
if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../phpkf-bilesenler/kullanici_kimlik.php';
if (!defined('DOSYA_PORTAL_AYARLAR')) include 'portal_ayarlar.php';
if (!defined('DOSYA_SEC')) include 'sec.php';
if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';
if (!defined('DOSYA_SEO')) include '../phpkf-bilesenler/seo.php';
if (!defined('DOSYA_HATA')) include 'hata.php';


if ((isset($_GET['o_sayfa'])) AND ($_GET['o_sayfa'] != ''))
{
	$_GET['o_sayfa'] = @zkTemizle($_GET['o_sayfa']);
	if (is_numeric($_GET['o_sayfa']) == false) $_GET['o_sayfa'] = 0;
}

else $_GET['o_sayfa'] = 0;


$sorgu_sql = $vt->query("select sayfa_no,dosya_adi,baslik from $tablo_portal_sayfa where sayfa_no='$_GET[o_sayfa]' AND yer!='2' LIMIT 1") or die ($vt->hata_ver());
$vtsonuc_sql = $vt->fetch_assoc($sorgu_sql);


if ($vt->num_rows($sorgu_sql))
{
	$sayfa_adi = $vtsonuc_sql['baslik'];
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/ozel_sayfa.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));

	$ozel_orta_sayfa = tema_dosyasi2('sayfalar/'.$vtsonuc_sql['dosya_adi']);
	$ornek1->kosul('ort', array('{OZEL_ORTA_SAYFA}' => $ozel_orta_sayfa, '{OZEL__BASLIK}' => $vtsonuc_sql['baslik']), true);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	exit();
}

else
{
	$sayfa_adi = 'Özel sayfa hatası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';


	$ileti_sonuc = array(
	'{ADRES}' => '../'.$phpkf_dosyalar['portal'],
	'{ILETI}' => $kp_dil_538,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => '',
	'{YONLENDIRME2}' => $kp_dil_207,
	'{ILETI_BASLIK}' => $ileti_2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
}

?>
