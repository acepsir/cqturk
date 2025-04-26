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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');



//  VERİTABANI EK YÜK GİDERME İŞLEMİ   //

if ( (isset($_GET['vt'])) AND ($_GET['vt'] == 'ekyuk') )
{
	$vtsorgu = "SHOW TABLE STATUS LIKE '%'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$ekyuk_sonucu = '';

	while ($tablo_bilgileri = $vt->fetch_array($vtsonuc))
	{
		$vtsorgu = "OPTIMIZE TABLE $tablo_bilgileri[Name]";
		$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$ekyuk_bilgisi = $vt->fetch_assoc($vtsonuc2);
		$ekyuk_sonucu .= $ekyuk_bilgisi['Table'].' &nbsp;-&nbsp; '.$ekyuk_bilgisi['Op'].
		' &nbsp;-&nbsp; '.$ekyuk_bilgisi['Msg_type'].' &nbsp;-&nbsp; '.$ekyuk_bilgisi['Msg_text'].'<br>';
	}
}



//  VERİTABANI ONARMA İŞLEMİ    //

if ( (isset($_GET['vt'])) AND ($_GET['vt'] == 'onar') )
{
	$vtsorgu = "SHOW TABLE STATUS LIKE '%'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$onarma_sonucu = '';

	while ($tablo_bilgileri = $vt->fetch_array($vtsonuc))
	{
		$vtsorgu = "REPAIR TABLE $tablo_bilgileri[Name]";
		$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$onarma_bilgisi = $vt->fetch_assoc($vtsonuc2);
		$onarma_sonucu .= $onarma_bilgisi['Table'].' &nbsp;-&nbsp; '.$onarma_bilgisi['Op'].
		' &nbsp;-&nbsp; '.$onarma_bilgisi['Msg_type'].' &nbsp;-&nbsp; '.$onarma_bilgisi['Msg_text'].'<br>';
	}
}



$tema_sayfa_icerik = '<div style="width: 620px; margin:0 auto">';


//  VERİTABANINDAKİ EK YÜKÜ GİDER TILANMIŞSA //

if ( (isset($ekyuk_sonucu)) AND ($ekyuk_sonucu != '') )
{
	$tema_sayfa_icerik .= '<center><b>'.$ly['ekyuk_giderildi'].'</b></center><br>
	&nbsp;&nbsp; '.$ly['ekyuk_ayrinti'].':<br><br>'.
	$ekyuk_sonucu.'
	<br><br><center>***************************************</center><br><br>';
}


//  VERİTABANINI ONAR TILANMIŞSA //

elseif ( (isset($onarma_sonucu)) AND ($onarma_sonucu != '') )
{
	$tema_sayfa_icerik .= '<center><b>'.$ly['veritabanı_onarildi'].'</b></center><br>
	&nbsp;&nbsp; '.$ly['onarma_ayrinti'].':<br><br>'.
	$onarma_sonucu.'
	<br><br><center>***************************************</center><br><br>';
}

else
{
	$tema_sayfa_icerik .= $ly['vt_yonetim_bilgi'].'<br><br>';
}

$tema_sayfa_icerik .= '<table cellspacing="1" width="620" cellpadding="6" border="0" align="center" class="tablo-ana">
	<tr class="tablo-baslik">
	<td width="160">'.$ly['tablo_adi'].'</td>
	<td width="80">'.$ly['girdi'].'</td>
	<td width="120">'.$ly['veri_boyutu'].'</td>
	<td width="120">'.$ly['index_boyutu'].'</td>
	<td>'.$ly['ek_yuk'].'</td>
	</tr>';




//	VERİTABANI BOYUTU HESAPLANIYOR - BAŞI	//

$vtsorgu = "SHOW TABLE STATUS LIKE '%'";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$toplam_boyut = 0;
$toplam_satir = 0;
$toplam_ekyuk = 0;

while ($tablo_bilgileri = $vt->fetch_array($vtsonuc))
{
	$toplam_boyut += ($tablo_bilgileri['Data_length'] + $tablo_bilgileri['Index_length']);
	$toplam_satir += $tablo_bilgileri['Rows'];
	$toplam_ekyuk += $tablo_bilgileri['Data_free'];

	$ekyuk = $tablo_bilgileri['Data_free'];
	if ($ekyuk != 0) $ekyuk = NumaraBicim($ekyuk/1024, 2).' <b>kb</b>';
	else $ekyuk = '';


	$tema_sayfa_icerik .= '<tr class="liste-veri tablo-satir">
	<td align="left">'.$tablo_bilgileri['Name'].'</td>
	<td align="right">'.NumaraBicim($tablo_bilgileri['Rows']).'</td>
	<td align="right">'.NumaraBicim($tablo_bilgileri['Data_length']/1024, 1).' <b>kb</b></td>
	<td align="right">'.NumaraBicim($tablo_bilgileri['Index_length']/1024, 1).' <b>kb</b></td>
	<td align="right">'.$ekyuk.'</td>
	</tr>';
}

$tema_sayfa_icerik .= '<tr class="liste-veri tablo-ici">
<td align="left" colspan="5">&nbsp;</td>
</tr>
<tr class="tablo-ici">
<td align="right"><b>'.$ly['toplam'].'</b>&nbsp;</td>
<td align="right">'.NumaraBicim($toplam_satir).'</td>
<td align="right" colspan="2">'.NumaraBicim($toplam_boyut/1024/1024, 2).' <b>mb</b></td>
<td align="right">'.NumaraBicim($toplam_ekyuk/1024, 2).' <b>kb</b></td>
</tr>';


//	VERİTABANI BOYUTU HESAPLANIYOR - SONU	//


$tema_sayfa_icerik .= '
	<tr class="tablo-ici">
	<td align="left" colspan="5">
<br><br>
 &nbsp;&nbsp; <a href="vt_yonetim.php?vt=ekyuk">'.$ly['ekyuk_gider'].'</a>
<p>
 &nbsp;&nbsp; <a href="vt_yonetim.php?vt=onar">'.$ly['tablo_onar'].'</a>


<br><br>
	</td>
	</tr>

</table>

</div>';



// tema dosyası yükleniyor
$sayfa_adi = $ly['veritabani_yonetimi'];
$tema_sayfa_baslik = $ly['veritabani_yonetimi'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>