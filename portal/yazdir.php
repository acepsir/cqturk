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


	if (!defined('DOSYA_AYAR')) include '../ayar.php';
	if (!defined('DOSYA_PORTAL_AYARLAR')) include 'portal_ayarlar.php';
	if (!defined('DOSYA_GERECLER')) include '../phpkf-bilesenler/gerecler.php';
	if (!defined('DOSYA_SEO')) include '../phpkf-bilesenler/seo.php';
	if (!defined('DOSYA_HATA')) include 'hata.php';
	if (!defined('DOSYA_DILAYAR')) include 'diller/dil_ayarlari.php';

	if (isset($_GET['no']) AND is_numeric($_GET['no']) == true) $gelen_no = @zkTemizle($_GET['no']);
	else $gelen_no = 0;
	
	// magic_quotes_gpc açıksa //
	if (get_magic_quotes_gpc())
	{
	$gelen_dosya = @zkTemizle2(stripslashes($_GET['dosya']));
	$gelen_veri = @zkTemizle2(stripslashes($_GET['veri']));
	$gelen_kosul = @zkTemizle2(stripslashes($_GET['kosul']));
	}
	// magic_quotes_gpc kapalıysa //
	else 
	{
	$gelen_dosya = @zkTemizle2($_GET['dosya']);
	$gelen_veri = @zkTemizle2($_GET['veri']);
	$gelen_kosul = @zkTemizle2($_GET['kosul']);
	}

if ($gelen_dosya == 'dosyalar')
{
    $deger ="$tablo_portal_indir";
    $kosullar ="WHERE no='$gelen_no' LIMIT 1";
    $konu_baslik ='dosya_baslik';
    $tarih = 'tarih';
    $ekleyen = 'ekleyen';
    $icerik = 'dosya_aciklama';
    $bbcode = 'bbcode_kullan';
}

elseif ($gelen_dosya == 'haberler')
{
    $deger ="$tablo_portal_haberler";
    $kosullar ="WHERE id='$gelen_no' LIMIT 1";
    $konu_baslik ='baslik';
    $tarih = 'tarih';
    $ekleyen = 'yazan';
    $icerik = 'icerik';
    $bbcode = 'bbcode_kullan';
}

else
{
    $ileti_sonuc = array(
    '{ILETI_BASLIK}' => $kp_yonetim_103,
    '{ADRES}' => '../'.$phpkf_dosyalar['portal'],
    '{ILETI}' => '',
    '{EK_YAZI}' => '',
    '{YONLENDIRME}' => $kp_dil_255,
    '{YONLENDIRME2}' => $kp_yonetim_106);

    echo '<br><br><center><b>'.$kp_dil_255.'</b></center>';
    exit();
}


    $vtsorgu = "SELECT $konu_baslik,$tarih,$ekleyen,$icerik,$bbcode FROM $deger $kosullar";
    $vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
    $yazdir_sonuc = $vt->fetch_assoc($vtsonuc);



	if (!$vt->num_rows($vtsonuc))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => '../'.$phpkf_dosyalar['portal'],
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_255,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	echo '<br><br><center><b>'.$kp_dil_255.'</b></center>';
	exit();
	}
	else 
	
	{
	
	echo '
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
	<html>
	<head>
	<title>'.$kp_dil_100.'</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="Pragma" Content="no-cache">
	<meta http-equiv="Cache-Control" Content="no-cache">
	<meta http-equiv="Content-Style-Type" Content="text/css">
	</head>
	<body>
	<table width="100%" class="cizgi_renk" border="0" cellpadding="3" cellspacing="1" bgcolor="white">
	<tr>
	<td align="left" class="haber_alt">
	<br>
	<div align="left">

	<font color="#333333" face="Verdana" style="font-size: 12px"><b>'.$kp_dil_71.' :</b> </font>&nbsp;
	<font color="#0000ff" face="Verdana" style="font-size: 12px"><b>'.$yazdir_sonuc[$konu_baslik].'</b></font>

	<font face="Verdana" style="font-size: 12px">
	<br>
	'.$kp_dil_72.' : <a href="../'.linkver('profil.php?kim='.$yazdir_sonuc[$ekleyen],$yazdir_sonuc[$ekleyen]).'">'.$yazdir_sonuc[$ekleyen].'</a>
	&nbsp;|&nbsp;'.$kp_dil_73.' : '.zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $yazdir_sonuc[$tarih]);

	echo '
	</font>
	</div>
	<div align="right">
	<input onclick="window.print();" type="button" value="'.$kp_dil_100.'">
	</div>
	<br>
	<br>
	
	<div style="width: 100%; float: left; position: relative; border: 0px solid #0099ff; overflow: auto;">
	<font face="Verdana" style="font-size: 12px">';

	if ( ($yazdir_sonuc[$bbcode] == 1) AND ($ayarlar['bbcode'] == 1) )
	{
	$yazdir_sonuc[$icerik] = preg_replace('|\[code=(.*?)\]|si','[kod]',$yazdir_sonuc[$icerik]);
	echo phpKFP_BBcode(bbcode_acik($yazdir_sonuc[$icerik],$yazdir_sonuc[$icerik]));
	}
	else
	{
	echo phpKFP_BBcode(bbcode_kapali($yazdir_sonuc[$icerik]));
	}
	
	echo '
	</font>
	</div>
	<br>
	<br>
	<div align="right">
	<input onclick="window.print();" type="button" value="'.$kp_dil_100.'">
	</div>
	</td>
	</tr>
	</table>
	</body>
	</html>';
}

?>