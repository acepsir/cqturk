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


/*
// Firefox üç renkli gradient
// background:-moz-linear-gradient(top,#58ABD0 0%,#58ABD0 50%,#58ABD0 100%);


preg_match('/-moz-linear-gradient\(top\,#([a-z0-9]*?) /i', $tema['body'], $renk_artalan1, PREG_OFFSET_CAPTURE, 3);
$renk_artalan1 = $renk_artalan1[1][0];

preg_match('/%,#([a-z0-9]*?) 50%/i', $tema['body'], $renk_artalan2, PREG_OFFSET_CAPTURE, 3);
$renk_artalan2 = $renk_artalan2[1][0];

preg_match('/%,#([a-z0-9]*?) 100%\);/i', $tema['body'], $renk_artalan3, PREG_OFFSET_CAPTURE, 3);
$renk_artalan3 = $renk_artalan3[1][0];


preg_match('/-moz-linear-gradient\(top\,#([a-z0-9]*?) /i', $tema['baslik'], $renk_baslik1, PREG_OFFSET_CAPTURE, 3);
$renk_baslik1 = $renk_baslik1[1][0];

preg_match('/%,#([a-z0-9]*?) 50%/i', $tema['baslik'], $renk_baslik2, PREG_OFFSET_CAPTURE, 3);
$renk_baslik2 = $renk_baslik2[1][0];

preg_match('/%,#([a-z0-9]*?) 100%\);/i', $tema['baslik'], $renk_baslik3, PREG_OFFSET_CAPTURE, 3);
$renk_baslik3 = $renk_baslik3[1][0];


<input type="hidden" name="artalan1" value="'.$renk_artalan1.'" />
<input type="hidden" name="artalan2" value="'.$renk_artalan2.'" />
<input type="hidden" name="artalan3" value="'.$renk_artalan3.'" />

<input type="hidden" name="baslik1" value="'.$renk_baslik1.'" />
<input type="hidden" name="baslik2" value="'.$renk_baslik2.'" />
<input type="hidden" name="baslik3" value="'.$renk_baslik3.'" />

*/



$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');



// temanın özellik dosyası yükleniyor ediliyor
if (@include('../phpkf-bilesenler/temalar/'.$secili_tema_cms.'/tema_ozellik.php'));
else {echo '<h2>Tema dosyası bulunamıyor!</h2>';exit();}


// temanın renk değişim desteği kontrol ediliyor
if ( (!isset($tema_bilgi['yonetimden_renk_degisimi'])) OR ($tema_bilgi['yonetimden_renk_degisimi'] != 1) )
{
	header('Location: hatalar.php?hata=23');
	exit();
}



// tema veritabanından çekiliyor
$vtsorgu = "SELECT * FROM $tablo_sablonlar WHERE ad='kullanilan' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$tema = $vt->fetch_assoc($vtsonuc);



preg_match('/background:#([a-z0-9]*?);/i', $tema['body'], $renk_artalan1, PREG_OFFSET_CAPTURE, 3);
$renk_artalan1 = $renk_artalan1[1][0];

preg_match('/a{color:#([a-z0-9]*?);}a:hover{color:#([a-z0-9]*?);}/i', $tema['link'], $renk_linkler, PREG_OFFSET_CAPTURE, 0);
$renk_link = $renk_linkler[1][0];
$renk_linkhover = $renk_linkler[2][0];

preg_match('/background-color:#([a-z0-9]*?);/i', $tema['baslik'], $renk_baslik, PREG_OFFSET_CAPTURE, 3);
$renk_baslik = $renk_baslik[1][0];

preg_match('/background:#([a-z0-9]*?);/i', $tema['ickatman'], $renk_ickatman, PREG_OFFSET_CAPTURE, 3);
$renk_ickatman = $renk_ickatman[1][0];

preg_match('/border-top:2px solid#([a-z0-9]*?);/i', $tema['ickatman'], $renk_katmanust, PREG_OFFSET_CAPTURE, 3);
$renk_katmanust = $renk_katmanust[1][0];

preg_match('/border-bottom:2px solid#([a-z0-9]*?);/i', $tema['ickatman'], $renk_katmanalt, PREG_OFFSET_CAPTURE, 3);
$renk_katmanalt = $renk_katmanalt[1][0];

preg_match('/border-left:1px solid#([a-z0-9]*?);/i', $tema['ickatman'], $renk_katmansol, PREG_OFFSET_CAPTURE, 3);
$renk_katmansol = $renk_katmansol[1][0];

preg_match('/border-right:1px solid#([a-z0-9]*?);/i', $tema['ickatman'], $renk_katmansag, PREG_OFFSET_CAPTURE, 3);
$renk_katmansag = $renk_katmansag[1][0];

preg_match('/color:#([a-z0-9]*?);/i', $tema['ickatman'], $renk_anayazi, PREG_OFFSET_CAPTURE, 3);
$renk_anayazi = $renk_anayazi[1][0];

preg_match('/a{color:#([a-z0-9]*?);}$/i', $tema['anayazi'], $renk_bloklink, PREG_OFFSET_CAPTURE, 0);
$renk_bloklink = $renk_bloklink[1][0];

preg_match('/background:#([a-z0-9]*?);/i', $tema['baslikyazig'], $renk_blokbaslik, PREG_OFFSET_CAPTURE, 3);
$renk_blokbaslik = $renk_blokbaslik[1][0];

preg_match('/color:#([a-z0-9]*?);/i', $tema['baslikyazig'], $renk_blokbaslikyazi, PREG_OFFSET_CAPTURE, 3);
$renk_blokbaslikyazi = $renk_blokbaslikyazi[1][0];

preg_match('/color:#([a-z0-9]*?);/i', $tema['baslikyazi'], $renk_baslikyazi, PREG_OFFSET_CAPTURE, 3);
$renk_baslikyazi = $renk_baslikyazi[1][0];

preg_match('/background-color:#([a-z0-9]*?);/i', $tema['menuler'], $renk_menuler1, PREG_OFFSET_CAPTURE, 3);
$renk_menuler1 = $renk_menuler1[1][0];

preg_match('/border-top:1px solid#([a-z0-9]*?);/i', $tema['menuler'], $renk_menuler2, PREG_OFFSET_CAPTURE, 3);
$renk_menuler2 = $renk_menuler2[1][0];

preg_match('/border-bottom:1px solid#([a-z0-9]*?);/i', $tema['menuler'], $renk_menuler3, PREG_OFFSET_CAPTURE, 3);
$renk_menuler3 = $renk_menuler3[1][0];

preg_match('/background-color:#([a-z0-9]*?);/i', $tema['menubag'], $renk_menubag1, PREG_OFFSET_CAPTURE, 3);
$renk_menubag1 = $renk_menubag1[1][0];

preg_match('/a{background-color:#([a-z0-9]*?);/i', $tema['menubag'], $renk_menubag2, PREG_OFFSET_CAPTURE, 3);
$renk_menubag2 = $renk_menubag2[1][0];

preg_match('/a{color:#([a-z0-9]*?);}/i', $tema['menubag_a'], $renk_menubag3, PREG_OFFSET_CAPTURE, 0);
$renk_menubag3 = $renk_menubag3[1][0];



// Renkler forma yollanıyor

$renk_form = '<input type="hidden" name="dolu" value="dolu" />
<input type="hidden" name="yo" value="'.$yo.'" />
<input type="hidden" name="artalan1" value="'.$renk_artalan1.'" />
<input type="hidden" name="link" value="'.$renk_link.'" />
<input type="hidden" name="linkhover" value="'.$renk_linkhover.'" />
<input type="hidden" name="ickatman" value="'.$renk_ickatman.'" />
<input type="hidden" name="katmanust" value="'.$renk_katmanust.'" />
<input type="hidden" name="katmanalt" value="'.$renk_katmanalt.'" />
<input type="hidden" name="katmansol" value="'.$renk_katmansol.'" />
<input type="hidden" name="katmansag" value="'.$renk_katmansag.'" />
<input type="hidden" name="blokbaslik" value="'.$renk_blokbaslik.'" />
<input type="hidden" name="blokbaslikyazi" value="'.$renk_blokbaslikyazi.'" />
<input type="hidden" name="sitebaslik" value="'.$renk_baslik.'" />
<input type="hidden" name="baslikyazi" value="'.$renk_baslikyazi.'" />
<input type="hidden" name="menuler1" value="'.$renk_menuler1.'" />
<input type="hidden" name="menuler2" value="'.$renk_menuler2.'" />
<input type="hidden" name="menuler3" value="'.$renk_menuler3.'" />
<input type="hidden" name="menubag1" value="'.$renk_menubag1.'" />
<input type="hidden" name="menubag2" value="'.$renk_menubag2.'" />
<input type="hidden" name="menubag3" value="'.$renk_menubag3.'" />
<input type="hidden" name="anayazi" value="'.$renk_anayazi.'" />
<input type="hidden" name="bloklink" value="'.$renk_bloklink.'" />
';


$sil_simge = '<img src="phpkf-bilesenler/temalar/varsayilan/resimler/sil.png" width="13" height="13" alt="s" style="margin-left:10px; margin-right:10px" title="'.$ly['sil'].'" />';



// şablonların adı alınıyor

$vtsorgu = "SELECT id,ad FROM $tablo_sablonlar WHERE ad!='kullanilan' ORDER BY id";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$sablonlar = '<div style="padding-bottom:7px"><b>'.$ly['sablonlar'].':</b></div>';

while ($sablon = $vt->fetch_assoc($vtsonuc))
{
	$link = '<a href="phpkf-bilesenler/renkuygula.php?kip=sablon&amp;id='.$sablon['id'].'&amp;yo='.$yo.'">';
	$sil = ' &nbsp; <a href="phpkf-bilesenler/renkuygula.php?kip=sil&amp;id='.$sablon['id'].'&amp;yo='.$yo.'" onclick="return window.confirm(jsl[\'sil_uyari\'])" style="position:absolute; left:150px">'.$sil_simge.'</a>';

	if ($sablon['ad'] != 'varsayilan') $ad = $sablon['ad'];
	else{
		$ad = 'Varsayılan';
		$sil = '';
	}

	$sablonlar .= '<div style="padding:7px 0">'.$link.$ad.'</a>'.$sil.'</div>';
}



// tema dosyası yükleniyor
$sablon_kullan = true;
$sayfa_adi = $ly['tema_renkleri'];
$tema_sayfa_baslik = $ly['tema_renk_degisimi'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/tasarim.php'));

?>