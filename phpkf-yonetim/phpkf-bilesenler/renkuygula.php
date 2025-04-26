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


if (!defined('DOSYA_AYAR')) include_once('../../phpkf-ayar.php');
if (!defined('DOSYA_GERECLER')) include_once('../../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('guvenlik.php');


// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';


// yönetim oturum kodu kontrol ediliyor
if ($gyo != $yo)
{
	header('Location: ../hatalar.php?hata=45');
	exit();
}



$vtsorgu = "SELECT * FROM $tablo_sablonlar WHERE ad='kullanilan' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$tema = $vt->fetch_assoc($vtsonuc);



// Şablon uygulama ve farklı kaydetme

if (isset($_POST['dolu']) AND ($_POST['dolu'] == 'dolu') )
{
	$_POST['artalan1'] = @zkTemizle($_POST['artalan1']);
	$_POST['link'] = @zkTemizle($_POST['link']);
	$_POST['linkhover'] = @zkTemizle($_POST['linkhover']);
	//$_POST['artalan2'] = @zkTemizle($_POST['artalan2']);
	//$_POST['artalan3'] = @zkTemizle($_POST['artalan3']);
	$_POST['ickatman']= @zkTemizle($_POST['ickatman']);
	$_POST['katmanust']= @zkTemizle($_POST['katmanust']);
	$_POST['katmanalt']= @zkTemizle($_POST['katmanalt']);
	$_POST['katmansol']= @zkTemizle($_POST['katmansol']);
	$_POST['katmansag']= @zkTemizle($_POST['katmansag']);
	$_POST['blokbaslik']= @zkTemizle($_POST['blokbaslik']);
	$_POST['blokbaslikyazi']= @zkTemizle($_POST['blokbaslikyazi']);
	$_POST['sitebaslik']= @zkTemizle($_POST['sitebaslik']);
	//$_POST['baslik2']= @zkTemizle($_POST['baslik2']);
	//$_POST['baslik3']= @zkTemizle($_POST['baslik3']);
	$_POST['baslikyazi'] = @zkTemizle($_POST['baslikyazi']);
	$_POST['menuler1'] = @zkTemizle($_POST['menuler1']);
	$_POST['menuler2'] = @zkTemizle($_POST['menuler2']);
	$_POST['menuler3'] = @zkTemizle($_POST['menuler3']);
	$_POST['menubag1'] = @zkTemizle($_POST['menubag1']);
	$_POST['menubag2'] = @zkTemizle($_POST['menubag2']);
	$_POST['menubag3'] = @zkTemizle($_POST['menubag3']);
	$_POST['anayazi'] = @zkTemizle($_POST['anayazi']);
	$_POST['bloklink'] = @zkTemizle($_POST['bloklink']);



	//$tema['body'] = preg_replace('|background:-moz-linear-gradient(.*?);|si', "background:-moz-linear-gradient\(top,#$_POST[artalan1] 0%,#$_POST[artalan2] 50%,#$_POST[artalan3] 100%\);", $tema['body']);
	//$tema['baslik'] = preg_replace('|background:-moz-linear-gradient(.*?);|si', "background:-moz-linear-gradient\(top,#$_POST[baslik1] 0%,#$_POST[baslik2] 50%,#$_POST[baslik3] 100%\);", $tema['baslik']);
	$tema['body'] = preg_replace('|background:#([a-z0-9]*?);|si', "background:#$_POST[artalan1];", $tema['body']);
	$tema['ickatman'] = preg_replace('|background:#([a-z0-9]*?);|si', "background:#$_POST[ickatman];", $tema['ickatman']);
	$tema['ickatman'] = preg_replace('|border-top:2px solid#([a-z0-9]*?);|si', "border-top:2px solid#$_POST[katmanust];", $tema['ickatman']);
	$tema['ickatman'] = preg_replace('|border-bottom:2px solid#([a-z0-9]*?);|si', "border-bottom:2px solid#$_POST[katmanalt];", $tema['ickatman']);
	$tema['ickatman'] = preg_replace('|border-left:1px solid#([a-z0-9]*?);|si', "border-left:1px solid#$_POST[katmansol];", $tema['ickatman']);
	$tema['ickatman'] = preg_replace('|border-right:1px solid#([a-z0-9]*?);|si', "border-right:1px solid#$_POST[katmansag];", $tema['ickatman']);
	$tema['baslikyazig'] = preg_replace('|background:#([a-z0-9]*?);|si', "background:#$_POST[blokbaslik];", $tema['baslikyazig']);
	$tema['baslikyazig'] = preg_replace('|color:#([a-z0-9]*?);|si', "color:#$_POST[blokbaslikyazi];", $tema['baslikyazig']);
	$tema['baslik'] = preg_replace('|background-color:#([a-z0-9]*?);|si', "background-color:#$_POST[sitebaslik];", $tema['baslik']);
	$tema['baslikyazi'] = preg_replace('|color:#([a-z0-9]*?);|si', "color:#$_POST[baslikyazi];", $tema['baslikyazi']);
	$tema['menuler'] = preg_replace('|background-color:#([a-z0-9]*?);|si', "background-color:#$_POST[menuler1];", $tema['menuler']);
	$tema['menuler'] = preg_replace('|border-top:1px solid#([a-z0-9]*?);|si', "border-top:1px solid#$_POST[menuler2];", $tema['menuler']);
	$tema['menuler'] = preg_replace('|border-bottom:1px solid#([a-z0-9]*?);|si', "border-bottom:1px solid#$_POST[menuler3];", $tema['menuler']);
	$tema['menubag'] = preg_replace('|background-color:#([a-z0-9]*?);|si', "background-color:#$_POST[menubag1];", $tema['menubag']);
	$tema['menubag'] = preg_replace('|a{background-color:#([a-z0-9]*?);|si', "a{background-color:#$_POST[menubag2];", $tema['menubag']);
	$tema['menubag_a'] = preg_replace('|color:#([a-z0-9]*?);|si', "color:#$_POST[menubag3];", $tema['menubag_a']);
	//$tema['anayazi'] = preg_replace('|color:#([a-z0-9]*?);|si', "color:#$_POST[anayazi];", $tema['anayazi']);

	$tema['ickatman'] = preg_replace('|.phpkf-blok-kutusu{color:#([a-z0-9]*?);|si', ".phpkf-blok-kutusu{color:#$_POST[anayazi];", $tema['ickatman']);
	$tema['anayazi'] = preg_replace('|a{color:#([a-z0-9]*?);}$|si', "a{color:#$_POST[bloklink];}", $tema['anayazi']);

	$tema['link'] = preg_replace('|a{color:#([a-z0-9]*?);}a:hover{color:#([a-z0-9]*?);}|si', "a{color:#$_POST[link];}a:hover{color:#$_POST[linkhover];}", $tema['link']);


	// şablon uygulama
	if (isset($_POST['uygula']))
	{
		$vtsorgu = "UPDATE $tablo_sablonlar SET body='$tema[body]',
		ickatman='$tema[ickatman]',
		baslik='$tema[baslik]',
		baslikyazi='$tema[baslikyazi]',
		baslikyazig='$tema[baslikyazig]',
		menuler='$tema[menuler]',
		menubag='$tema[menubag]',
		menubag_a='$tema[menubag_a]',
		anayazi='$tema[anayazi]',
		link='$tema[link]'
		WHERE ad='kullanilan' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		header('Location: ../hatalar.php?bilgi=10');
		exit();
	}


	// şablon kaydetme

	elseif (isset($_POST['kaydet']))
	{
		if ( (isset($_POST['sablon'])) AND ($_POST['sablon'] != '') )
			$sablon = @zkTemizle($_POST['sablon']);

		else
		{
			header('Location: ../hatalar.php?hata=7');
			exit();
		}

		$vtsorgu = "INSERT $tablo_sablonlar (ad,body,link,ickatman,kenar2,baslik,baslikyazi,baslikyazig,menuler,menubag,menubag_a,menubag_ahover,anayazi)
		VALUES ('$sablon','$tema[body]','$tema[link]','$tema[ickatman]','$tema[kenar2]','$tema[baslik]','$tema[baslikyazi]','$tema[baslikyazig]','$tema[menuler]','$tema[menubag]','$tema[menubag_a]','$tema[menubag_ahover]','$tema[anayazi]')";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		header('Location: ../hatalar.php?bilgi=11');
		exit();
	}
}





// Şablon Yükleme

elseif (isset($_GET['kip']) AND ($_GET['kip'] == 'sablon') )
{
	if (isset($_GET['id'])) $sablon = @zkTemizleNumara($_GET['id']);

	if ($sablon == 0)
	{
		header('Location: ../hatalar.php?hata=7');
		exit();
	}

	// yedek şablon veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_sablonlar WHERE id='$sablon' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$tema = $vt->fetch_assoc($vtsonuc);

	$vtsorgu = "UPDATE $tablo_sablonlar SET body='$tema[body]',
	link='$tema[link]',
	ickatman='$tema[ickatman]',
	kenar2='$tema[kenar2]',
	baslik='$tema[baslik]',
	baslikyazi='$tema[baslikyazi]',
	baslikyazig='$tema[baslikyazig]',
	menuler='$tema[menuler]',
	menubag='$tema[menubag]',
	menubag_a='$tema[menubag_a]',
	menubag_ahover='$tema[menubag_ahover]',
	anayazi='$tema[anayazi]'
	WHERE ad='kullanilan' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

	header('Location: ../tasarim.php');
	exit();
}




// Şablon Silme

elseif (isset($_GET['kip']) AND ($_GET['kip'] == 'sil') )
{
	if (isset($_GET['id'])) $sablon = @zkTemizleNumara($_GET['id']);

	if ($sablon == 0)
	{
		header('Location: ../hatalar.php?hata=7');
		exit();
	}

	if ( ($sablon == 1) OR ($sablon == 2))
	{
		header('Location: ../hatalar.php?hata=8');
		exit();
	}


	// şablon veritabanından siliniyor
	$vtsorgu = "DELETE FROM $tablo_sablonlar WHERE id='$sablon' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	header('Location: ../tasarim.php');
	exit();
}



else
{
	header('Location: ../hatalar.php?hata=1');
	exit();
}

?>