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


if ($kullanici_kim['id'] != 1)
{
	header('Location: hata.php?hata=151');
	exit();
}


if (isset($_POST['gunsayisi'])) $gunsayisi = zkTemizleNumara($_POST['gunsayisi']);
else $gunsayisi = 0;


if ( ( isset($_POST['oi_sil']) ) AND ( $_POST['oi_sil'] == 'oi_sil' ) )
{
	if ( ($gunsayisi <= 0) OR ($gunsayisi > 999) )
	{
		header('Location: hata.php?hata=153');
		exit();
	}

	$tarih = time();
	$hesapla = ($tarih - ($gunsayisi * 86400));


	$vtsorgu = "DELETE FROM $tablo_ozel_ileti WHERE gonderme_tarihi < $hesapla AND alan_kutu!=4 AND gonderen_kutu!=4 AND okunma_tarihi IS NOT NULL";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	header('Location: hata.php?bilgi=47');
	exit();
}


elseif ( ( isset($_POST['oi_hesapla']) ) AND ( $_POST['oi_hesapla'] == 'oi_hesapla' ) )
{
	if ( ($gunsayisi <= 0) OR ($gunsayisi > 999) )
	{
		header('Location: hata.php?hata=153');
		exit();
	}


	$onayal = 'onayal';
	$tarih = time();
	$hesapla = ($tarih - ($gunsayisi * 86400));


	// SİLİNECEK ÖZEL İLETİ SAYISI ALINIYOR //
	$vtsorgu = "SELECT * FROM $tablo_ozel_ileti WHERE gonderme_tarihi < $hesapla AND alan_kutu!=4 AND gonderen_kutu!=4 AND okunma_tarihi IS NOT NULL";
	$eski_mesaj_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$oi_sayi = $vt->num_rows($eski_mesaj_sonuc);
}





//  SAYFA GÖSTERİMİ  //

if (empty($onayal)):

$tema_sayfa_icerik = '<form name="oi_sil" action="oi_sil.php" method="post">
<input type="hidden" name="oi_hesapla" value="oi_hesapla" />


<table cellspacing="1" width="100%" cellpadding="2" border="0" align="left">
	<tr>
	<td align="left" class="liste-veri">
<br> &nbsp; &nbsp; &nbsp; Bu sayfadan; belirttiğiniz günden eski, kaydedilen kutusuna taşınmamış özel iletileri silebilirsiniz. Günü girdikten sonra gelen sayfada, kaç özel iletinin silineceği belirtilir. İsterseniz silme işleminden bu kısımda vazgeçebilirsiniz.
<br><br>
&nbsp; &nbsp; &nbsp; Özel iletileri silmeden önce <a href="forum_duyurular.php?kip=yeni">buradan</a> sayfaya bir duyurusu ekleyerek, üyeleri silinmesini istemedikleri iletileri kaydetmeleri konusunda uyarabilirsiniz.
<br>
<center>
<br><br>

<input type="text" name="gunsayisi" size="4" class="input-text" maxlength="3" placeholder="'.$l['gun'].'" required />
<b>&nbsp; Günden eski kaydedilmemiş özel iletiler&nbsp;</b>
<br><br><br>
<input type="submit" value="Bul" class="dugme dugme-mavi" />
<br><br>
</center>
	</td>
	</tr>
</table>

</form>';



// BAŞLIKLARI SİL TIKLANMIŞSA

elseif (isset($onayal)):

$tema_sayfa_icerik = '';

if ($oi_sayi > 0)
{
	$tema_sayfa_icerik .= '
	<form name="oi_sil" action="oi_sil.php" method="post">
	<input type="hidden" name="oi_sil" value="oi_sil" />
	<input type="hidden" name="gunsayisi" value="'.$gunsayisi.'" />';
}


$tema_sayfa_icerik .= '<table cellspacing="1" width="100%" cellpadding="2" border="0" align="left">
	<tr>
	<td align="center" class="liste-veri">';


if ($oi_sayi > 0)
{
	$tema_sayfa_icerik .= '<br><br>
&nbsp; <b>'.$gunsayisi.'</b> günden eski özel ileti sayısı: <b>'.$oi_sayi.'</b>
	<br><br>
<b>Özel iletileri silmek istediğinize emin misiniz?</b>
<br><br><br>
<input type="submit" value="Evet Sil" class="dugme dugme-mavi" />
<br><br>';
}


else
{
	$tema_sayfa_icerik .= '<br><br>
	&nbsp; <b>Forumda '.$gunsayisi.' günden eski silinecek özel ileti yok</b>
	<br><br><br>';
}


$tema_sayfa_icerik .= '<br>
	</td>
	</tr>
</table>
</form>';

endif;



// tema dosyası yükleniyor
$sayfa_adi = 'Özel İleti Silme';
$tema_sayfa_baslik = $sayfa_adi;
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>