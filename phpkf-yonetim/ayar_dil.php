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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');

$dosya_adi = 'ayar_dil.php';



// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';


//  Yeni Alan Ekleme  //
if ( (isset($_POST['kip'])) AND ($_POST['kip'] == 'yeni') AND (trim($_POST['ad']) != '') )
{
	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hatalar.php?hata=45');
		exit();
	}

	// Dil adı temizleniyor
	$dil = zkTemizle($_POST['ad']);
	$dil = BoslukSil(zkTemizle4($dil));

	$dil_eklenen = str_replace($dil.',', '', $ayarlar['dil_eklenen']);
	$dil_eklenen = $dil_eklenen.$dil.',';
	$dil_eklenen_alanlar = str_replace($dil.',', '', $ayarlar['dil_eklenen_alanlar']);
	$dil_eklenen_alanlar = $dil_eklenen_alanlar.$dil.',';



	// bağlantılar tablosunda dil var mı?
	$bag_ad = "ad_$dil";
	$vtsorgu = "SHOW FIELDS FROM $tablo_baglantilar WHERE Field='$bag_ad'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// Dil kullanılıyorsa
	if ($vt->num_rows($vtsonuc))
	{
		header('Location: hatalar.php?hata=226');
		exit();
	}


	// yazılar tablosuna yeni dil alanları ekleniyor
	$vtsorgu = "ALTER TABLE $tablo_yazilar ADD `etiket_$dil` varchar(1000) NULL DEFAULT NULL";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_yazilar ADD `baslik_$dil` VARCHAR(255) NULL DEFAULT NULL";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_yazilar ADD `icerik_$dil` LONGTEXT";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// bağlantılar ve kategoriler tablolarına yeni dil alanları ekleniyor
	$vtsorgu = "ALTER TABLE $tablo_baglantilar ADD `ad_$dil` VARCHAR(255) NULL DEFAULT NULL";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_kategoriler ADD `baslik_$dil` VARCHAR(255) NULL DEFAULT NULL";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// ayarlar tablosuna yeni dil alanı ekleniyor
	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$dil_eklenen' WHERE etiket='dil_eklenen' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$dil_eklenen_alanlar' WHERE etiket='dil_eklenen_alanlar' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	header('Location: '.$dosya_adi);
	exit();
}



//  Alan Silme  //
elseif ( (isset($_GET['sil'])) AND ($_GET['sil'] != '') )
{
	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hatalar.php?hata=45');
		exit();
	}

	// Dil adı temizleniyor
	$dil = zkTemizle($_GET['sil']);
	$dil = BoslukSil(zkTemizle4($dil));

	$dil_eklenen = str_replace("$dil,", '', $ayarlar['dil_eklenen']);
	$dil_eklenen_alanlar = str_replace("$dil,", '', $ayarlar['dil_eklenen_alanlar']);


	// yazılar tablosundan dil alanları kaldırılıyor
	$vtsorgu = "ALTER TABLE $tablo_yazilar DROP `etiket_$dil`";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_yazilar DROP `baslik_$dil`";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_yazilar DROP `icerik_$dil`";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// bağlantılar ve kategoriler tablolarından dil alanları kaldırılıyor
	$vtsorgu = "ALTER TABLE $tablo_baglantilar DROP `ad_$dil`";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "ALTER TABLE $tablo_kategoriler DROP `baslik_$dil`";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// ayarlar tablosundan dil alanı kaldırılıyor
	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$dil_eklenen' WHERE etiket='dil_eklenen' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$dil_eklenen_alanlar' WHERE etiket='dil_eklenen_alanlar' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	header('Location: '.$dosya_adi);
	exit();
}







//  SAYFA GÖSTERİMİ - BAŞI  //


// Eklenen dil tablosu hazırlanıyor
$dil_eklenen_alanlar = explode(',', $ayarlar['dil_eklenen_alanlar']);
$sil_simge = '<img src="phpkf-bilesenler/temalar/varsayilan/resimler/sil.png" width="15" height="15" alt="s" title="'.$ly['dili_sil'].'" />';
$dil_tablo = '';
$sira = 1;

foreach ($dil_eklenen_alanlar as $dil)
{
	if ($dil == '') continue;

	// Alan kontrol ediliyor
	//$vtsorgu = "SHOW FIELDS FROM $tablo_baglantilar WHERE Field='ad_$dil'";
	//$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	//if (!$vt->num_rows($vtsonuc)) continue;

	$dil_tablo .= '<tr class="tablo_ici" onmouseover="this.style.backgroundColor=\'#eeeeee\'" onmouseout="this.style.backgroundColor=\'#ffffff\'">
	<td align="center">'.$sira.'</td>
	<td align="left">'.$diller[$dil].'</td>
	<td align="center"><a href="'.$dosya_adi.'?sil='.$dil.'&amp;yo='.$yo.'"
	onclick="return window.confirm(\''.$ly['dikkat'].'\n'.$ly['dil_sil_uyari'].'\n'.$l['sil_uyari'].'\')">'.$sil_simge.'</a></td>
	</tr>';
	$sira++;
}

if ($sira==1) $dil_tablo .= '<tr class="tablo_ici"><td align="center" colspan="8"><br>'.$ly['hicbir_dil_eklenmemis'].'<br><br></td></tr>';




// Dil seçim formu hazırlanıyor
$dil_select = '';
foreach ($diller as $anahtar => $dil)
{
	$dil_select .= '<option value="'.$anahtar.'">'.$dil.' - '.$dillerg[$anahtar].'</option>'."\r\n";
}







// Sayfa hazırlanıyor

$tema_sayfa_icerik = $ly['dil_ayar_bilgi'].'
<br><br><br><br>

<table cellspacing="1" cellpadding="6" border="0" align="left" width="300" bgcolor="#dddddd">
<tr class="tablo_ici"><td align="center" colspan="8"><b>'.$ly['eklenen_diller'].'</b></td></tr>
<tr class="tablo_ici">
<td align="center" width="20">#</td>
<td align="center"><b>'.$ly['dil'].'</b></td>
<td align="center" width="35"><b>'.$ly['sil'].'</b></td>
</tr>
'.$dil_tablo.'
</table>
<div class="clear"></div>
<br><br>
<div style="clear:both;"></div>

<form name="form2" action="'.$dosya_adi.'" method="post">
<input type="hidden" name="yo" value="'.$yo.'" />
<input type="hidden" name="kip" value="yeni" />
<select name="ad" class="input-select" style="min-width:100px; width:auto">
<option value=""> - '.$l['dil_sec'].' - </option>
'.$dil_select.'
</select>&nbsp;
<input class="dugme dugme-mavi" type="submit" name="ekle" value="'.$ly['dil_ekle'].'" />
</form>
<br>';



// tema dosyası yükleniyor
$sayfa_adi = $ly['dil_ayarlari'];
$tema_sayfa_baslik = $ly['dil_ayarlari'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>