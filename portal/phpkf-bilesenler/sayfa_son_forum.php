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


if (!defined('PHPKF_ICINDEN')) exit();


// bildirim dosyası yükleniyor
if (@is_file('ayar.php')) $tdiz = '';
else $tdiz = '../';
$bldrm_dizin = $tdiz;
include $tdiz.'phpkf-bilesenler/bildirim.php';


// Taban yazı ve logo
$TEMA_SITE_TABAN_YAZI = $ayarlar['site_taban'];
$TEMA_SITE_TABAN_KOD = $ayarlar['site_taban_kod'];
$TEMA_LOGO_ALT = $ayarlar['tema_logo_alt'];


if ($TEMA_LOGO_ALT != '')
{
	if (@!preg_match('/\<img/', $TEMA_LOGO_ALT))
	{
		if ((@!preg_match('/\<a/', $TEMA_LOGO_ALT)) AND ($temadizini == 'varsayilan')) $TEMA_LOGO_ALT = '<a href="'.$anadizin.'">'.$TEMA_LOGO_ALT.'</a>';
		$TEMA_LOGO_ALT = '<span>'.$TEMA_LOGO_ALT.'</span>';
	}
}


// Yönetim bağlantıları
$yonetim = '';
if ( (isset($kullanici_kim['yetki'])) AND ($kullanici_kim['yetki'] == 1) )
{
	$yonetim .= '<a href="'.$alt_dizin.'phpkf-yonetim/index.php">'.$kp_dil_225.'</a>';
}

// yönetim bağlantıları
$yonetim_masasi = $ayarlar['site_taban'].'<br>';


// Portal dizini
if ($ayarlar['f_dizin'] == '/') $fdizin = '';
else $fdizin = $ayarlar['f_dizin'];
$onadres = 'http://'.$ayarlar['alanadi'].$fdizin.'/';
$tema_secimi = '';

if (@is_file('ayar.php'))
{
	$ust_dizin ='portal/';
	$alt_dizin ='';
}
else
{
	$ust_dizin ='';
	$alt_dizin ='../';
}


$dongusuz = array('{YONETIM_MASASI}' => $yonetim,
'{TEMA_SECIMI}' => $tema_secimi,
'{ALT_DIZIN}' => $alt_dizin,
'{UST_DIZIN}' => $ust_dizin,
'{FORUM_INDEX}' => $phpkf_dosyalar['forum'],
'{PORTAL_INDEX}' => $phpkf_dosyalar['portal']);
eval(TEMA_UYGULA_SON);
$vt->close();
unset($vt);
?>