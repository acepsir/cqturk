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


define('DOSYA_TEMA_SECILIYOR',true);

// EKLENMİŞ OLAN TEMALAR //


if (@is_file('ayar.php')) $dizin_adi = 'portal/temalar/';
else $dizin_adi = 'temalar/';


$secili_tema = $ayarlar['temadizini_portal'];

if( (isset($kullanici_kim['temadizinip'])) AND ($kullanici_kim['temadizinip'] != '') )
{
	if (defined('YONETIM_TEMADIZINI'))
	{
		$ayarlar['temadizini_portal'] = 'varsayilan';
		include 'temalar/'.$ayarlar['temadizini_portal'].'/tema.php';
		include 'yonetim/temalar/'.$ayarlar['temadizini_portal'].'/yonetim_tema.php';
	}

	else
	{
		include $dizin_adi.$kullanici_kim['temadizinip'].'/tema.php';
		$ayarlar['temadizini_portal'] = $kullanici_kim['temadizinip'];
	}
}

elseif ((isset($ayarlar['temadizini_portal'])) AND ($ayarlar['temadizini_portal'] != ''))
{
	if (defined('YONETIM_TEMADIZINI'))
	{
		$ayarlar['temadizini_portal'] = 'varsayilan';
		include 'temalar/'.$ayarlar['temadizini_portal'].'/tema.php';
		include 'yonetim/temalar/'.$ayarlar['temadizini_portal'].'/yonetim_tema.php';
	}

	else include $dizin_adi.$ayarlar['temadizini_portal'].'/tema.php';
}

else
{
	if (defined('YONETIM_TEMADIZINI'))
	{
		$ayarlar['temadizini_portal'] = 'varsayilan';
		include 'temalar/'.$ayarlar['temadizini_portal'].'/tema.php';
		include 'yonetim/temalar/'.$ayarlar['temadizini_portal'].'/yonetim_tema.php';
	}

	else
	{
		$ayarlar['temadizini_portal'] = 'varsayilan';
		include $dizin_adi.$ayarlar['temadizini_portal'].'/tema.php';
	}
}

$temadizini = $ayarlar['temadizini_portal'];

?>