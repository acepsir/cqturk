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


function ETemizle2($metin)
{
	$bul = array('\\');
	$cevir = array('');
	$donen = @str_replace($bul, $cevir, $metin);

	return $donen;
}

function ETemizle($metin)
{
	$bul = array('&', '{', '}', '\\',"'");
	$cevir = array('&', '&#123;', '&#125;', '',"\'");
	$donen = @str_replace($bul, $cevir, $metin);

	return $donen;
}



if (isset($_POST['yeniblok_baslik']) AND ($_POST['yeniblok_baslik'] != ''))
{
	//	ZARARLI KODLAR TEMİZLENİYOR	//
	//	magic_quotes_gpc açıksa	//
	if (get_magic_quotes_gpc())
	{
		$_POST['yeniblok_adres'] = ETemizle(stripslashes($_POST['yeniblok_adres']),2);
		$_POST['yeniblok_baslik'] = ETemizle(stripslashes($_POST['yeniblok_baslik']),2);
		$_POST['yeniblok_baslik'] = str_replace('&amp;','&',$_POST['yeniblok_baslik']);

		$_POST['yeniblok_kod'] = ETemizle2(stripslashes($_POST['yeniblok_kod']),1);
		$_POST['yeniblok_kod'] = str_replace('&amp;','&',$_POST['yeniblok_kod']);
	}

	//	magic_quotes_gpc kapalıysa	//
	else
	{
		$_POST['yeniblok_adres'] = ETemizle($_POST['yeniblok_adres'],2);
		$_POST['yeniblok_baslik'] = ETemizle($_POST['yeniblok_baslik'],2);
		$_POST['yeniblok_baslik'] = str_replace('&amp;','&',$_POST['yeniblok_baslik']);

		$_POST['yeniblok_kod'] = ETemizle2($_POST['yeniblok_kod'],1);
		$_POST['yeniblok_kod'] = str_replace('&amp;','&',$_POST['yeniblok_kod']);
	}


	$vtsorgu = "INSERT INTO $tablo_bloklar (ad,sira,baslik,durum,ozel_blok,ozel_ikon,blok_genislik,adres,ozel_blok_kod)";
	$vtsorgu .= "VALUES ('$_POST[yeniblok_id]','0','$_POST[yeniblok_baslik]','0','1','','200px','','');";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	exit();
}


elseif (isset($_POST['sil']) AND ($_POST['sil'] != ''))
{
	$vtsorgu = "DELETE FROM $tablo_bloklar WHERE ad='$_POST[sil]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	exit();
}



elseif (isset($_POST['sorgula']) AND ($_POST['sorgula'] != ''))
{
	$vtsorgu = "SELECT * FROM $tablo_bloklar WHERE ad='$_POST[sorgula]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
	$vtsonuc2 = $vt->fetch_assoc($vtsonuc) or die ($vt->hata_ver());

	echo $vtsonuc2['ozel_blok'].'[[[ayrac]]]'.$vtsonuc2['blok_genislik'].'[[[ayrac]]]'.$vtsonuc2['ozel_blok_kod'].'[[[ayrac]]]'.$vtsonuc2['adres'];
	exit();
}


else
{
	if (!isset($_POST['dosyaadres'])) $_POST['dosyaadres'] = '';
	if (!isset($_POST['blok_ad'])) $_POST['blok_ad'] = '';
	if (!isset($_POST['ozelblokkod'])) $_POST['ozelblokkod'] = '';



	//	ZARARLI KODLAR TEMİZLENİYOR	//
	//	magic_quotes_gpc açıksa	//
	if (get_magic_quotes_gpc())
	{
		$_POST['dosyaadres'] = stripslashes($_POST['dosyaadres']);
		$_POST['blok_ad'] = stripslashes($_POST['blok_ad']);
		$_POST['ozelblokkod'] = stripslashes($_POST['ozelblokkod']);
	}

	$_POST['dosyaadres'] = ETemizle($_POST['dosyaadres'],2);
	$_POST['blok_ad'] = ETemizle($_POST['blok_ad'],2);
	$_POST['blok_ad'] = str_replace('&amp;','&',$_POST['blok_ad']);

	$_POST['ozelblokkod'] = ETemizle2($_POST['ozelblokkod'],1);
	$_POST['ozelblokkod'] = str_replace('&amp;','&',$_POST['ozelblokkod']);


	if ( ($_POST['ozelblokkod'] != '') OR ($_POST['dosyaadres'] != '') )
	{
		$vtsorgu = "UPDATE $tablo_bloklar SET adres='$_POST[dosyaadres]',ozel_blok_kod='$_POST[ozelblokkod]',blok_genislik='$_POST[blokgenislik]' where ad='$_POST[blok_ad_id]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
	}


	if ( (isset($_POST['blok_ad_id'])) AND ($_POST['blok_ad_id'] != '') AND ($_POST['blok_ad'] != '') )
	{
		$vtsorgu = "UPDATE $tablo_bloklar SET baslik='$_POST[blok_ad]',
		blok_genislik='$_POST[blokgenislik]' WHERE ad='$_POST[blok_ad_id]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
	}

	if (isset($_POST['islem']) AND ($_POST['islem'] == 'ayar_kaydet'))
	{
		$ad = array();
		$yer = array();
		$sira = array();
		$say = 0;

		if(isset($_POST['sol_bloklar']))
		{
			$elemanlar = explode('|', substr($_POST['sol_bloklar'],1,-1));
			foreach($elemanlar as $anahtar => $deger)
			{
				$eleman = explode(':', $deger);
				$ad[$say] = $eleman[0];
				$yer[$say] = 1;
				$sira[$say] = ($eleman[1]+1);
				$say++;
			}
		}

		if(isset($_POST['kapali_bloklar']))
		{
			$elemanlar = explode('|', substr($_POST['kapali_bloklar'],1,-1));

			foreach($elemanlar as $anahtar => $deger)
			{
				$eleman = explode(':', $deger);
				$ad[$say] = $eleman[0];
				$yer[$say] = 0;
				@$sira[$say] = ($eleman[1]+1);
				$say++;
			}
		}

		if(isset($_POST['sag_bloklar']))
		{
			$elemanlar = explode('|', substr($_POST['sag_bloklar'],1,-1));

			foreach($elemanlar as $anahtar => $deger)
			{
				$eleman = explode(':', $deger);
				$ad[$say] = $eleman[0];
				$yer[$say] = 2;
				@$sira[$say] = ($eleman[1]+1);
				$say++;
			}
		}

		foreach($ad as $anahtar => $deger)
		{
			$vtsorgu = "UPDATE $tablo_bloklar SET sira='$sira[$anahtar]', durum='$yer[$anahtar]' where ad='$ad[$anahtar]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
		}
	}
}
?>