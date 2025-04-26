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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='3' OR kip='5'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');


// Üye id temizleniyor
if (isset($_GET['u']))
{
	$uye_id = zkTemizle($_GET['u']);
	if (!is_numeric($uye_id)) $uye_id = 0;
}

// Üye adı tıklanmamışsa üyeler sayfasına yönlendir
else
{
	header('Location: uyeler.php');
	exit();
}

// site kurucusu buradan değiştirilemez uyarısı
if ($uye_id == 1)
{
	header('Location: hatalar.php?hata=147');
	exit();
}



//	KULLANICININ BİLGİLERİ VERİTABANINDAN ÇEKİLİYOR	//
$vtsorgu = "SELECT * FROM $tablo_kullanicilar WHERE id='$uye_id' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
$satir = $vt->fetch_array($vtsonuc);


if (!isset($satir['id']))
{
	header('Location: hatalar.php?hata=46');
	exit();
}




$resim_boyut = $ayarlar['uye_resim_yukseklik'].'x'.$ayarlar['uye_resim_genislik'].'px - '.($ayarlar['uye_resim_boyut']/1024).'kb';
$resim_boyut = str_replace('{00}', $resim_boyut, $l['resim_dosya_boyutu']);
$resim_yukleme_bilgi = $l['sadece_resim_dosyalari'].'<br>'.$resim_boyut;



$imza_azami = str_replace('{00}', $ayarlar['uye_imza_uzunluk'], $l['imza_hakkinda_azami']);
$imza_bilgi = $l['imza_bilgi'].'<br>'.$imza_azami.' '.$l['bbcode_ifade_kullanilabilir'];



$hakkinda_uzunluk = 1000;
$hakkinda_azami = str_replace('{00}', $hakkinda_uzunluk, $l['imza_hakkinda_azami']);
$hakkinda_bilgi = $l['hakkinda_bilgi'].'<br>'.$hakkinda_azami.' '.$l['bbcode_ifade_kullanilabilir'];



$javascript_kodu2 = '<script type="text/javascript"><!-- //
function imzaUzunluk(){
var div_katman = document.getElementById(\'imza_uzunluk\');
div_katman.innerHTML = \''.$l['karakter_sayisi'].': \' + ('.$ayarlar['uye_imza_uzunluk'].'-document.form1.imza.value.length);
if (document.form1.imza.value.length > '.$ayarlar['uye_imza_uzunluk'].'){
alert(\''.$l['imza'].': '.$imza_azami.'\');
document.form1.imza.value = document.form1.imza.value.substr(0,'.$ayarlar['uye_imza_uzunluk'].');
div_katman.innerHTML = \''.$l['karakter_sayisi'].': 0\';}
return true;}
function hakkindaUzunluk(){
var div_katman = document.getElementById(\'hakkinda_uzunluk\');
div_katman.innerHTML = \''.$l['karakter_sayisi'].': \' + ('.$hakkinda_uzunluk.'-document.form1.hakkinda.value.length);
if (document.form1.hakkinda.value.length > '.$hakkinda_uzunluk.'){
alert(\''.$l['hakkinda'].': '.$hakkinda_azami.'\');
document.form1.hakkinda.value = document.form1.hakkinda.value.substr(0,'.$hakkinda_uzunluk.');
div_katman.innerHTML = \''.$l['karakter_sayisi'].': 0\';}
return true;}
imzaUzunluk();
hakkindaUzunluk();
//  -->
</script>';


// tema dosyası yükleniyor
$sayfa_adi = $ly['uye_profilini_degistir'].': '.$satir['kullanici_adi'];
$tema_sayfa_baslik = $ly['uye_profilini_degistir'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/uye_degistir.php'));

?>