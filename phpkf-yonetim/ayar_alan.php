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

$dosya_adi = 'ayar_alan.php';


// Alan tip bilgisi alınıyor
$vtsorgu = "SHOW FIELDS FROM $tablo_yazilar";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

while ($alan = $vt->fetch_assoc($vtsonuc))
{
	$alanlar_dizi[$alan['Field']] = $alan['Type'];
}


// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';


//  Yeni Alan Ekleme  //
if ( (isset($_POST['kip'])) AND (($_POST['kip'] == 'yeni') OR ($_POST['kip'] == 'duzenle')) )
{
	// Alanyap fonksiyonu
	function alanyap($metin)
	{
		$metin = mb_strtolower($metin, 'utf8');

		$ara = array (' ', ',', '.', 'ğ', 'ü', 'ş', 'ı', 'ö', 'ç');
		$degistir = array ('_', '_', '_', 'g', 'u', 's', 'i', 'o', 'c');
		$metin = str_replace($ara,$degistir,$metin);

		$ara = array(' ', '(', ')', '\'', '?' , '&nbsp', '&#34;', '&amp', 'http://', '&', '\r\n', '\n', '/', '\\', '+');
		$metin = str_replace($ara, '_', $metin);

		$ara = array('/[^a-z0-9\_<>]/', '/[\_]+/', '/<[^>]*>/');
		$degistir = array('', '_', '');
		$metin = @preg_replace($ara, $degistir, $metin);

		return $metin;
	}


	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hatalar.php?hata=45');
		exit();
	}

	// Ad girilmemişse hataya yönlendir
	if ( (!isset($_POST['ad'])) OR ($_POST['ad'] == '') )
	{
		header('Location: hatalar.php?hata=1');
		exit();
	}

	// Alana adı
	$ad = zkTemizle($_POST['ad']);
	$ad = alanyap(BoslukSil(zkTemizle4($ad)));

	// Alan adı kullanılıyorsa
	if ( ($_POST['kip'] == 'yeni') AND (isset($alanlar_dizi[$ad])) )
	{
		header('Location: hatalar.php?hata=225');
		exit();
	}


	// Yer (Sayfa) seçimi
	if (isset($_POST['yer']))
	{
		if ($_POST['yer'] == 'yazi') $yer = 'yazi';
		elseif ($_POST['yer'] == 'galeri') $yer = 'galeri';
		elseif ($_POST['yer'] == 'video') $yer = 'video';
		else $yer = 'icerik';
	}
	else $yer = 'icerik';


	// Form tipi seçimi
	if (isset($_POST['form_tip']))
	{
		if ($_POST['form_tip'] == 'radio') $form_tip = 'radio';
		elseif ($_POST['form_tip'] == 'select') $form_tip = 'select';
		elseif ($_POST['form_tip'] == 'checkbox') $form_tip = 'checkbox';
		elseif ($_POST['form_tip'] == 'textarea') $form_tip = 'textarea';
		else $form_tip = 'text';
	}
	else $form_tip = 'text';


	// Düzenleyici seçimi
	if (isset($_POST['duzenleyici']))
	{
		if ($_POST['duzenleyici'] == 'duzenleyici') $aciklama = 'duzenleyici';
		elseif ($_POST['duzenleyici'] == 'gduzenleyici') $aciklama = 'gduzenleyici';
		elseif ($_POST['duzenleyici'] == 'vduzenleyici') $aciklama = 'vduzenleyici';
		elseif ($_POST['duzenleyici'] == 'yduzenleyici') $aciklama = 'yduzenleyici';
		else $aciklama = 'duz';
	}
	else $aciklama = 'duz';


	// Seçenek bilgisi
	if (isset($_POST['secenek'])) $secenek = zkTemizle(zkTemizle4(BoslukSil($_POST['secenek'])));
	else $secenek = '';

	// Sıra bilgisi
	if (isset($_POST['sira'])) $sira = zkTemizleNumara($_POST['sira']);
	else $sira = 0;

	// Başlık bilgisi
	if (isset($_POST['baslik'])) $baslik = zkTemizle(zkTemizle4($_POST['baslik']));
	else $baslik = '';

	// Diğer bilgisi
	if (isset($_POST['diger'])) $diger = zkTemizle($_POST['diger']);
	else $diger = '';

	// Alan bilgisi
	if (isset($_POST['bilgi'])) $bilgi = zkTemizle(zkTemizle4($_POST['bilgi']));
	else $bilgi = '';

	// Azami karakter uzunluğu
	if ( (isset($_POST['boyut'])) AND ($_POST['boyut'] !='') )
		$boyut = zkTemizleNumara($_POST['boyut']);
	else $boyut = 1000;


	// Alan tipi seçimi
	if (isset($_POST['alan_tip']))
	{
		if ($_POST['alan_tip'] == 'text') $alan_tip = "TEXT";
		elseif ($_POST['alan_tip'] == 'longtext') $alan_tip = "LONGTEXT";
		elseif ($_POST['alan_tip'] == 'int'){
			if ($boyut > 10) $boyut = 10;
			$alan_tip = "INT($boyut) unsigned NOT NULL DEFAULT '0'";
		}
		else {
			if ($boyut > 1000) $boyut = 1000;
			$alan_tip = "VARCHAR($boyut) NOT NULL DEFAULT ''";
		}
	}
	else $alan_tip = "VARCHAR(1000) NOT NULL DEFAULT ''";


	// Alan düzenleme için veritabanı işlemleri
	if ($_POST['kip'] == 'duzenle')
	{
		// ayarlar tablosuna yeni alan ekleniyor
		$vtsorgu = "UPDATE `$tablo_ayarlar` SET form_tip='$form_tip', secenek='$secenek', aciklama='$aciklama', diger='$diger', bilgi='$bilgi', baslik='$baslik', sira='$sira', tip='$yer' WHERE etiket='ygv_$ad'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}


	// Alan ekleme için veritabanı işlemleri
	else
	{
		// yazılar tablosuna yeni alan ekleniyor
		$vtsorgu = "ALTER TABLE $tablo_yazilar ADD `$ad` $alan_tip";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		// ayarlar tablosuna yeni alan ekleniyor
		$vtsorgu = "INSERT INTO `$tablo_ayarlar` (etiket,deger,form_tip,secenek,secenek_tip,varsayilan,bos,diger,bilgi,baslik,aciklama,kat,sira,tip,kip)
		VALUES ('ygv_$ad', '', '$form_tip', '$secenek', 'html', '', 1, '$diger', '$bilgi', '$baslik', '$aciklama', 20, '$sira', '$yer', 20)";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}

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

	$alan = zkTemizle($_GET['sil']);

	// yazılar tablosundan alan kaldırılıyor
	$vtsorgu = "ALTER TABLE $tablo_yazilar DROP `$alan`";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// ayarlar tablosundan siliniyor
	$vtsorgu = "DELETE FROM $tablo_ayarlar WHERE etiket='ygv_$alan' LIMIT 1;";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

	header('Location: '.$dosya_adi);
	exit();
}



//  Düzenleme için Alma  //
elseif ( (isset($_GET['duzenle'])) AND ($_GET['duzenle'] != '') )
{
	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hatalar.php?hata=45');
		exit();
	}

	$ad = zkTemizle($_GET['duzenle']);

	// Düzenleme için alan bilgisi alınıyor
	$vtsorgu = "SELECT * FROM $tablo_ayarlar WHERE kip='20' AND etiket='ygv_$ad' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
	$alan = $vt->fetch_assoc($vtsonuc);


	$yeni_duzenle = $ly['alan_duzenleme'];
	$form_kip = 'duzenle';
	$duzenle_ad = '<input type="hidden" name="ad" value="'.$ad.'" /><input class="input-text" type="text" name="ad2" value="'.$ad.' ('.$ly['degistirilemez'].')" disabled="disabled" style="width:95%" />';
	$duzenle_baslik = $alan['baslik'];
	$duzenle_bilgi = $alan['bilgi'];
	$duzenle_sira = $alan['sira'];
	$duzenle_boyut = 'value="('.$ly['degistirilemez'].')" disabled="disabled"';
	$duzenle_secenek = $alan['secenek'];
	$duzenle_diger = str_replace('"', '&#34;', $alan['diger']);
	$duzenle_dugme = $ly['alan_duzenle'];
	$duzenleme_bilgi = '<div style="padding:0 0 10px 2px; font-size:11px">'.$ly['alan_duzenleme_bilgi'].'</div>';

	$duzenle_alan_tip = '<select name="alan_tip" disabled="disabled" class="input-alani" style="width:auto">
<option value="" selected="selected">'.$ly['degistirilemez'].'</option>
</select>';


	$ft1=''; $ft2=''; $ft3='';
	if ($alan['form_tip'] == 'text') $ft1 = ' selected="selected"';
	elseif ($alan['form_tip'] == 'textarea') $ft2 = ' selected="selected"';
	elseif ($alan['form_tip'] == 'select') $ft3 = ' selected="selected"';

	$fy1=''; $fy2=''; $fy3=''; $fy4='';
	if ($alan['tip'] == 'icerik') $fy1 = ' selected="selected"';
	elseif ($alan['tip'] == 'yazi') $fy2 = ' selected="selected"';
	elseif ($alan['tip'] == 'galeri') $fy3 = ' selected="selected"';
	elseif ($alan['tip'] == 'video') $fy4 = ' selected="selected"';

	$fd1=''; $fd2=''; $fd3=''; $fd4=''; $fd5='';
	if ($alan['aciklama'] == 'duz') $fd1 = ' selected="selected"';
	elseif ($alan['aciklama'] == 'duzenleyici') $fd2 = ' selected="selected"';
	elseif ($alan['aciklama'] == 'gduzenleyici') $fd3 = ' selected="selected"';
	elseif ($alan['aciklama'] == 'vduzenleyici') $fd4 = ' selected="selected"';
	elseif ($alan['aciklama'] == 'yduzenleyici') $fd5 = ' selected="selected"';
}


//  Normal Gösterim  //
else
{
	$yeni_duzenle = $ly['yeni_alan_ekle'];
	$form_kip = 'yeni';
	$duzenle_ad = '<input class="input-text" type="text" name="ad" value="" placeholder="'.$ly['alan_ad_bilgi'].'" maxlength="30" style="width:95%" />';
	$duzenle_baslik = '';
	$duzenle_bilgi = '';
	$duzenle_sira = '';
	$duzenle_boyut = 'value=""';
	$duzenle_secenek = '';
	$duzenle_diger = '';
	$duzenle_dugme = $ly['alan_ekle'];
	$duzenleme_bilgi = '';

	$ft1=' selected="selected"'; $ft2=''; $ft3='';
	$fy1=' selected="selected"'; $fy2=''; $fy3=''; $fy4='';
	$fd1=' selected="selected"'; $fd2=''; $fd3=''; $fd4=''; $fd5='';

	$duzenle_alan_tip = '<select name="alan_tip" class="input-alani" style="width:auto">
<option value="varchar" selected="selected">'.$ly['varchar_bilgi'].'</option>
<option value="text">'.$ly['text_bilgi'].'</option>
<option value="longtext">'.$ly['longtext_bilgi'].'</option>
<option value="int">'.$ly['int_bilgi'].'</option>
</select>';

}








//  SAYFA GÖSTERİMİ - BAŞI  //


$duzenle_simge = '<img src="phpkf-bilesenler/temalar/varsayilan/resimler/duzenle.png" width="17" height="17" alt="d" title="'.$l['duzenle'].'" />';
$sil_simge = '<img src="phpkf-bilesenler/temalar/varsayilan/resimler/sil.png" width="15" height="15" alt="s" title="'.$l['sil'].'" />';

$tema_sayfa_icerik = $ly['ayar_alan_bilgi'].'<br><br><br>
<table cellspacing="1" cellpadding="6" border="0" align="left" width="100%" bgcolor="#dddddd">
<tr class="tablo_ici"><td align="center" colspan="8"><b>'.$ly['eklenen_alanlar'].'</b></td></tr>
<tr class="tablo_ici">
<td align="center" width="28"><b>'.$ly['sira'].'</b></td>
<td align="center"><b>'.$ly['ad'].'</b></td>
<td align="center"><b>'.$ly['baslik'].'</b></td>
<td align="center"><b>'.$ly['bilgi'].'</b></td>
<td align="center" width="35"><b>'.$ly['yer'].'</b></td>
<td align="center" width="80"><b>'.$ly['form_tipi'].'</b></td>
<td align="center" width="125"><b>'.$ly['alan_tipi'].'</b></td>
<td align="center" width="65"><b>'.$ly['islemler'].'</b></td>
</tr>';



// Özel alanlar alınıyor
$vtsorgu = "SELECT * FROM $tablo_ayarlar WHERE kip='20' ORDER BY tip,sira,etiket";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
$sira = 1;

while ($alan = $vt->fetch_assoc($vtsonuc))
{
	$ad = str_replace('ygv_', '', $alan['etiket']);
	if ($alan['tip'] == 'yazi') $yer = $l['yazi'];
	elseif ($alan['tip'] == 'galeri') $yer = $l['galeri'];
	elseif ($alan['tip'] == 'video') $yer = $l['video'];
	else $yer = $ly['tum'];
	if (isset($alanlar_dizi[$ad])) $alan_tipi = $alanlar_dizi[$ad];
	else $alan_tipi = $ly['alan_yok'];


	$tema_sayfa_icerik .= '<tr class="tablo_ici" onmouseover="this.style.backgroundColor=\'#eeeeee\'" onmouseout="this.style.backgroundColor=\'#ffffff\'">
	<td align="left">'.$alan['sira'].'</td>
	<td align="left">'.$ad.'</td>
	<td align="left">'.$alan['baslik'].'</td>
	<td align="left">'.$alan['bilgi'].'</td>
	<td align="center">'.$yer.'</td>
	<td align="center">'.$alan['form_tip'].'</td>
	<td align="center">'.$alan_tipi.'</td>
	<td align="center"><a href="'.$dosya_adi.'?duzenle='.$ad.'&amp;yo='.$yo.'#duzenle">'.$duzenle_simge.'</a>&nbsp; &nbsp;
	<a href="'.$dosya_adi.'?sil='.$ad.'&amp;yo='.$yo.'"
	onclick="return window.confirm(\''.$ly['dikkat'].'\n'.$ly['alan_sil_uyari'].'\n'.$l['sil_uyari'].'\')">'.$sil_simge.'</a></td>
	</tr>';
	$sira++;
}

if ($sira==1) $tema_sayfa_icerik .= '<tr class="tablo_ici"><td align="center" colspan="8"><br>'.$ly['hicbir_alan_eklenmemis'].'<br><br></td></tr>';



$tema_sayfa_icerik .= '</table>
<div class="clear"></div>
<br><br><br>

<div style="clear:both;"></div>

'.$duzenleme_bilgi.'
<fieldset style="width:95%">
<legend>'.$yeni_duzenle.'</legend>
<a name="duzenle"></a>


<form name="form2" action="'.$dosya_adi.'" method="post">
<input type="hidden" name="yo" value="'.$yo.'" />
<input type="hidden" name="kip" value="'.$form_kip.'" />

<div class="phpkf-form-label"><label class="label">
'.$ly['ad'].'<br /></label>
'.$duzenle_ad.'
</div>

<div class="phpkf-form-label"><label class="label">
'.$ly['baslik'].'<br /></label>
<input class="input-text" type="text" name="baslik" value="'.$duzenle_baslik.'" placeholder="'.$ly['alan_baslik_bilgi'].'" style="width:95%" />
</div>

<div class="phpkf-form-label"><label class="label">
'.$ly['bilgi'].'<br /></label>
<input class="input-text" type="text" name="bilgi" value="'.$duzenle_bilgi.'" placeholder="'.$ly['alan_bilgi_bilgi'].'" style="width:95%" />
</div>

<div class="phpkf-form-label"><label class="label">
'.$ly['sira'].'<br /></label>
<input class="input-text" type="text" name="sira" value="'.$duzenle_sira.'" placeholder="'.$ly['alan_sira_bilgi'].'" maxlength="3" style="width:120px" />
</div>

<div class="phpkf-form-label"><label class="label">
'.$ly['yer_sayfa'].'<br /></label>
<select name="yer" class="input-alani" style="width:auto">
<option value="icerik"'.$fy1.'>'.$ly['tum_icerik_ekleme_sayfalari'].'</option>
<option value="yazi"'.$fy2.'>'.$ly['yazi_ekle_sayfasi'].'</option>
<option value="galeri"'.$fy3.'>'.$ly['galeri_ekle_sayfasi'].'</option>
<option value="video"'.$fy4.'>'.$ly['video_ekle_sayfasi'].'</option>
</select>
</div>

<div class="phpkf-form-label"><label class="label">
'.$ly['alan_tipi'].'<br /></label>
'.$duzenle_alan_tip.'
</div>

<div class="phpkf-form-label"><label class="label">
'.$ly['alan_boyutu'].'<br /></label>
<input class="input-text" type="text" name="boyut" '.$duzenle_boyut.' placeholder="'.$ly['azami_karakter_sayisi'].'" maxlength="4" style="width:140px" />
<span style="margin-top:5px;font-size:11px">
&nbsp; '.$ly['varchar_int_karakter_sayisi'].'
</span>
</div>


<div class="phpkf-form-label"><label class="label">
'.$ly['form_tipi'].'<br /></label>
<select name="form_tip" class="input-alani" style="width:auto">
<option value="text"'.$ft1.'>'.$ly['input_bilgi'].'</option>
<option value="textarea"'.$ft2.'>'.$ly['textarea_bilgi'].'</option>
<option value="select"'.$ft3.'>'.$ly['select_bilgi'].'</option>
</select>
</div>


<div class="phpkf-form-label"><label class="label">
'.$ly['duzenleyici'].'<br /></label>
<select name="duzenleyici" class="input-alani" style="width:auto">
<option value="duz"'.$fd1.'>'.$ly['duzenleyici_yok'].'</option>
<option value="duzenleyici"'.$fd2.'>'.$ly['ayarli_metin_duzenleyici'].'</option>
<option value="gduzenleyici"'.$fd3.'>'.$ly['ayarli_galeri_duzenleyici'].'</option>
<option value="vduzenleyici"'.$fd4.'>'.$ly['ayarli_video_duzenleyici'].'</option>
<option value="yduzenleyici"'.$fd5.'>'.$ly['ayarli_yorum_duzenleyici'].'</option>
</select>
<span style="margin-top:5px;font-size:11px">
&nbsp; '.$ly['editor_secim_bilgi'].'
</span>
</div>


<div class="phpkf-form-label"><label class="label">
'.$ly['secenekler'].'<br /></label>
<input class="input-text" type="text" name="secenek" value="'.$duzenle_secenek.'" placeholder="'.$ly['alan_secenek_bilgi'].'" style="width:95%" />

<div style="margin-top:5px;font-size:11px">
'.$ly['alan_form_tipi_bilgi'].'
</div>
</div>


<div class="phpkf-form-label"><label class="label">
'.$ly['diger_kodlar'].'<br /></label>
<input class="input-text" type="text" name="diger" value="'.$duzenle_diger.'" placeholder="'.$ly['diger_kodlar'].'" style="width:95%" />

<div style="margin-top:5px;font-size:11px">
'.$ly['diger_kodlar_bilgi'].'
</div>
</div>


<center>
<br>
<input class="dugme dugme-mavi" type="submit" name="yeni" value="'.$duzenle_dugme.'" />
</center>

</form>
</fieldset>
';



// tema dosyası yükleniyor
$sayfa_adi = $ly['icerik_alanlari'];
$tema_sayfa_baslik = $ly['icerik_alanlari'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>