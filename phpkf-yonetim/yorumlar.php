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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5' OR kip='6'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_KULLANICI_KIMLIK')) include_once('../phpkf-bilesenler/kullanici_kimlik.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');



// yönetim oturum kodu
if (isset($_GET['yo'])) $_GET['yo'] = @zkTemizle($_GET['yo']);
else $_GET['yo'] = '';





//  YORUM SİLME, ONAY VE DÜZENLEME İŞLEMLERİ - BAŞI  //

if ( ((isset($_GET['kip'])) AND ($_GET['kip'] == 'sil')) OR
	((isset($_GET['kip'])) AND ($_GET['kip'] == 'onay')) OR
	((isset($_GET['kip'])) AND ($_GET['kip'] == 'duzenle')) OR
	((isset($_POST['duzenle'])) AND ($_POST['duzenle'] == 'duzenle')) )
{
	// yönetim oturum kodu kontrol ediliyor
	if ( ($_GET['kip'] != 'duzenle') AND ($_GET['yo'] != $yo) )
	{
		header('Location: hatalar.php?hata=45');
		exit();
	}

	if (isset($_GET['id'])) $yorumid = @zkTemizle($_GET['id']);
	else $yorumid = 0;

	if ( (!is_numeric($yorumid)) OR ($yorumid == 0) )
	{
		header('Location: hatalar.php?hata=11');
		exit();
	}


	// yorum veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_yorumlar WHERE id='$yorumid' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$yorum = $vt->fetch_assoc($vtsonuc);

	// yorum yoksa hata ver
	if (!isset($yorum['id']))
	{
		header('Location: hatalar.php?hata=11');
		exit();
	}



	// Onay verme-alma işlemleri
	if ($_GET['kip'] == 'onay')
	{
		if ($yorum['onay'] == '0') {$onay = 1; $arti = "yorum_sayi+1";}
		else {$onay = 0; $arti = "yorum_sayi-1";}

		$vtsorgu = "UPDATE $tablo_yorumlar SET onay='$onay' WHERE id='$yorumid' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		// Yazının yorum sayısı değiştiriliyor
		$vtsorgu = "UPDATE $tablo_yazilar SET yorum_sayi=$arti WHERE id='$yorum[yazi_id]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		header('Location: yorumlar.php');
		exit();
	}



	// yorum silme işlemleri
	elseif ($_GET['kip'] == 'sil')
	{
		$vtsorgu = "DELETE FROM $tablo_yorumlar WHERE id='$yorumid' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		// yorumun yanıtı yoksa
		if ($yorum['yanit'] == '0');

		// yorumun yanıtı varsa yanıtlar normal yorum yapılıyor
		elseif ($yorum['yanit'] == '1')
		{
			$vtsorgu = "UPDATE $tablo_yorumlar SET yanit=0 WHERE yanit='$yorumid' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
		}

		// yorum yanıt ise
		else
		{
			// başka yanit var mı bakılıyor
			$vtsorgu = "SELECT id FROM $tablo_yorumlar WHERE yanit='$yorum[yanit]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

			// yorumun başka yanıtı yoksa "yanıt" değeri sıfırlanıyor
			if (!$vt->num_rows($vtsonuc))
			{
				$vtsorgu = "UPDATE $tablo_yorumlar SET yanit=0 WHERE id='$yorum[yanit]' LIMIT 1";
				$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
			}
		}

		// yorum onaylı ise
		if ($yorum['onay'] == '1')
		{
			// Yazının yorum sayısı eksiltiliyor
			$vtsorgu = "UPDATE $tablo_yazilar SET yorum_sayi=yorum_sayi-1 WHERE id='$yorum[yazi_id]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
		}

		header('Location: hatalar.php?bilgi=12');
		exit();
	}



	// yorum düzenleme yapma işlemleri
	elseif ((isset($_POST['duzenle'])) AND ($_POST['duzenle'] == 'duzenle'))
	{
		if (isset($_POST['bbcode'])) $bbcode = 1;
		else $bbcode = 0;

		if (isset($_POST['ifade'])) $ifade = 1;
		else $ifade = 0;

		// magic_quotes_gpc açıksa
		if (get_magic_quotes_gpc())
		{
			$yorum_baslik = @ileti_yolla(stripslashes($_POST['mesaj_baslik']), 1);
			$yorum_icerik = @ileti_yolla(stripslashes($_POST['mesaj_icerik']), 2);
		}

		// magic_quotes_gpc kapalıysa
		else
		{
			$yorum_baslik = @ileti_yolla($_POST['mesaj_baslik'], 1);
			$yorum_icerik = @ileti_yolla($_POST['mesaj_icerik'], 2);
		}


		$vtsorgu = "UPDATE $tablo_yorumlar SET baslik='$yorum_baslik',icerik='$yorum_icerik',ifade='$ifade',bbcode='$bbcode' WHERE id='$yorumid' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		header('Location: hatalar.php?bilgi=13');
		exit();
	}



	// Yorum düzenleme alma işlemleri
	else
	{
		// yorumu yazan üye ise
		if ($yorum['yazan_id'] != 0)
		{
			$vtsorgu = "SELECT id,resim FROM $tablo_kullanicilar WHERE id='$yorum[yazan_id]' LIMIT 1";
			$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$uye_resim = $vt->fetch_assoc($vtsonuc2);

			if ($uye_resim['resim'] != '')
			{
				if ( (preg_match('/^http:\/\//i', $uye_resim['resim'])) OR (preg_match('/^https:\/\//i', $uye_resim['resim'])) OR (preg_match('/^ftp:\/\//i', $uye_resim['resim'])))
					$resim = $uye_resim['resim'];
				else $resim = '../'.$uye_resim['resim'];
			}
			else $resim = '../phpkf-dosyalar/resimler/varsayilan_resim.jpg';

			$yazan_adi = explode(';', $yorum['yazan']);
			if ($ayarlar['yazan_adi'] != 1) $yorum['yazan'] = $yazan_adi[0];
			else $yorum['yazan'] = $yazan_adi[1];
			$yazan_adi = $yazan_adi[0];

			$yazan = '<a href="../'.linkyap($phpkf_dosyalar['profil'].'?u='.$yorum['yazan_id'].'&kim='.$yazan_adi,$yazan_adi).'">'.$yorum['yazan'].'</a>';
		}

		// yorumu yazan ziyaretçi ise
		else
		{
			$d = urlencode('?d=http://'.$ayarlar['alanadi'].$anadizin.$ayarlar['v-ziyaretci_resmi']);
			$p = md5(strtolower(trim($yorum['posta'])));
			$yazan = '<a href="https://www.gravatar.com/'.$p.'">'.$yorum['yazan'].'</a>';
			$resim = 'https://www.gravatar.com/avatar/'.$p.$d;
		}



		$tarih = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $yorum['tarih'], $ayarlar['tarih'], true);
		$yazan_ip = $yorum['yazan_ip'];
		$eposta = $yorum['posta'];
		$yorum_baslik = $yorum['baslik'];
		$yorum_icerik = $yorum['icerik'];
		$bbcode = '';
		$ifade = '';


		if ($yorum['bbcode'] == 1) $bbcode = 'checked="checked"';
		if ($yorum['ifade'] == 1) $ifade = 'checked="checked"';


		$sayfa_adi = $ly['yorum_duzenleme'];
		$tema_sayfa_baslik = $ly['yorum_duzenleme'];




// Düzenleyici yükleniyor
$duzenleyici_dizin = '../';
$duzenleyici_bicim = 'bbcode';
$duzenleyici_tip = 'hizli';
$duzenleyici_id = 'mesaj_icerik';
$duzenleyici = $ayarlar['yduzenleyici'];


@ob_start();
@ob_implicit_flush(0);
include($duzenleyici_dizin.'phpkf-bilesenler/editor/index.php');
$editor_cikti = @ob_get_contents();
@ob_end_clean();







		$tema_sayfa_icerik = '
<form action="yorumlar.php?kip=duzenle&amp;id='.$yorumid.'&amp;yo='.$yo.'" method="post" name="duzenleyici_form" id="duzenleyici_form" onsubmit="return denetle_yazi()">
<input type="hidden" name="duzenle" value="duzenle" />


<table cellspacing="1" cellpadding="4" border="0" width="98%" align="center" class="tablo-ana">
	<tr class="tablo_ici">
	<td rowspan="2" width="150" align="center" valign="top" style="padding:10px; line-height:22px">
<img src="'.$resim.'" style="max-width:120px" />
<br />'.$yazan.'
<br />'.$eposta.'
<br />'.$yazan_ip.'
<br>
<br>
<div style="text-align:left">
<label for="bbcode" style="cursor:pointer"><input type="checkbox" '.$bbcode.' name="bbcode" id="bbcode" /> BBCode Kullan</label><br>
<label for="ifade" style="cursor:pointer"><input type="checkbox" '.$ifade.' name="ifade" id="ifade" /> İfade Kullan</label>
</div>
<div style="margin-top:30px">'.ifade_olustur(5).'</div>
	</td>

	<td align="left" valign="top" style="padding:10px">
<input class="input-alani" name="mesaj_baslik" type="text" value="'.$yorum_baslik.'" placeholder="'.$ly['yorum_baslik_bilgi'].'" style="width:96%; margin-bottom:10px" />
<textarea class="textarea" spellcheck="false" id="mesaj_icerik" name="mesaj_icerik" rows="9" style="width:96%">'.$yorum_icerik.'</textarea>
'.$editor_cikti.'
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="center" valign="middle" style="padding:10px;">
<input class="dugme dugme-mavi" name="mesaj_gonder" type="submit" value="'.$l['duzenle'].'" />
&nbsp;
<input class="dugme dugme-mavi" type="button" value="'.$l['temizle'].'" onclick="FormTemizle()" />
	</td>
	</tr>
</table>
</form>';

	}
}

//  YORUM SİLME, ONAY VE DÜZENLEME İŞLEMLERİ - SONU  //












// YORUMLAR - BAŞI //
// YORUMLAR - BAŞI //
// YORUMLAR - BAŞI //

else
{
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');

if ((isset($_GET['kip'])) AND ($_GET['kip'] == 'tum'))
{
	$eksorgu = '';
	$yorum_yok = $ly['hicbir_yorum_yok'];
	$yorum_kip_link = '<a href="yorumlar.php">'.$ly['onay_bekleyenler'].'</a> - '.$ly['tum_yorumlar'];
}

else
{
	$eksorgu = "WHERE onay='0'";
	$yorum_yok = $ly['onaysiz_yorum_yok'];
	$yorum_kip_link = $ly['onay_bekleyenler'].' - <a href="yorumlar.php?kip=tum">'.$ly['tum_yorumlar'].'</a>';
}


// yorum bildirimi varsa okundu olarak işaretleniyor
$vtsorgu = "UPDATE $tablo_bildirimler SET okundu='1' WHERE tip='5' AND okundu='0'";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


// toplam yorum sayısı alınıyor
$vtsorgu = "SELECT * FROM $tablo_yorumlar $eksorgu";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$toplam_yorum = $vt->num_rows($vtsonuc);


// sayfa no değeri kontrol ediliyor
if (isset($_GET['yms'])) $sayfano = zkTemizle($_GET['yms']);
else $sayfano = 1;
if ((!is_numeric($sayfano)) OR ($sayfano == 0)) $sayfano = 1;


$kosul_sayfa = ($sayfano * $ayarlar['syfkota_yorum'])-$ayarlar['syfkota_yorum'];
$TEMA_SAYFALAMA = phpkf_sayfalama($toplam_yorum, $ayarlar['syfkota_yorum'], $sayfano, 'yms=');



// yorumlar veritabanından çekiliyor
$vtsorgu = "SELECT * FROM $tablo_yorumlar $eksorgu ORDER BY id DESC LIMIT $kosul_sayfa, $ayarlar[syfkota_yorum]";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$sira = $kosul_sayfa;
$yorumlar = '';


while ($yorum = $vt->fetch_assoc($vtsonuc))
{
	// yazı başlığı veritabanından çekiliyor
	$vtsorgu = "SELECT id,baslik FROM $tablo_yazilar WHERE id='$yorum[yazi_id]' LIMIT 1";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$yazi = $vt->fetch_assoc($vtsonuc2);

	$yazi_baslik = '<a href="../'.$phpkf_dosyalar['cms'].'?y='.$yazi['id'].'">'.$yazi['baslik'].'</a>';
	$yorum_baslik = $yorum['baslik'];
	$yorum_icerik = $yorum['icerik'];


	// yorumu yazan üye ise
	if ($yorum['yazan_id'] != 0)
	{
		$vtsorgu = "SELECT id,resim FROM $tablo_kullanicilar WHERE id='$yorum[yazan_id]' LIMIT 1";
		$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$uye_resim = $vt->fetch_assoc($vtsonuc2);

		if ($uye_resim['resim'] != '')
		{
			if ( (preg_match('/^http:\/\//i', $uye_resim['resim'])) OR (preg_match('/^https:\/\//i', $uye_resim['resim'])) OR (preg_match('/^ftp:\/\//i', $uye_resim['resim'])))
			$resim = $uye_resim['resim'];
			else $resim = '../'.$uye_resim['resim'];
		}
		else $resim = '../phpkf-dosyalar/resimler/varsayilan_resim.jpg';

		$yazan_adi = explode(';', $yorum['yazan']);
		if ($ayarlar['yazan_adi'] != 1) $yorum['yazan'] = $yazan_adi[0];
		else $yorum['yazan'] = $yazan_adi[1];
		$yazan_adi = $yazan_adi[0];

		$yazan = '<a href="../'.linkyap($phpkf_dosyalar['profil'].'?u='.$yorum['yazan_id'].'&kim='.$yazan_adi,$yazan_adi).'">'.$yorum['yazan'].'</a>';
	}

	// yorumu yazan ziyaretçi ise
	else
	{
		$d = urlencode('?d=http://'.$ayarlar['alanadi'].$anadizin.$ayarlar['v-ziyaretci_resmi']);
		$p = md5(strtolower(trim($yorum['posta'])));
		$yazan = '<a href="https://www.gravatar.com/'.$p.'">'.$yorum['yazan'].'</a>';
		$resim = 'https://www.gravatar.com/avatar/'.$p.$d;
	}


	if ($yorum['onay'] == '1') $yorum_onay = '<a href="yorumlar.php?kip=onay&amp;id='.$yorum['id'].'&amp;yo='.$yo.'">'.$l['onayi_al'].'</a>';
	else $yorum_onay = '<a href="yorumlar.php?kip=onay&amp;id='.$yorum['id'].'&amp;yo='.$yo.'">'.$l['onayla'].'</a>';

	if ($yorum['bbcode'] == '1') $yorum_icerik = bbcode_acik($yorum_icerik,$yorum['id']);
	else $yorum_icerik = bbcode_kapali($yorum_icerik);
	if ($yorum['ifade'] == '1') $yorum_icerik = ifadeler($yorum_icerik);


	$sira++;
	$yazan_ip = $yorum['yazan_ip'];
	$eposta = $yorum['posta'];
	$tarih = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $yorum['tarih'], $ayarlar['tarih'], true);
	$yorum_duzenle = '<a href="yorumlar.php?kip=duzenle&amp;id='.$yorum['id'].'">'.$l['duzenle'].'</a>';
	$yorum_sil = '<a href="yorumlar.php?kip=sil&amp;id='.$yorum['id'].'&amp;yo='.$yo.'" onclick="return window.confirm(\''.$l['sil_uyari'].'\')">['.$l['sil'].']</a>';


	$yorumlar .= '<tr class="tablo-baslik">
	<td align="left" style="font-weight:normal">'.$sira.') &nbsp;'.$tarih.'</td>
	<td align="left" style="font-weight:normal">'.$yorum_baslik.'<span style="float:right" align="right">'.$yazi_baslik.'</span></td>
	</tr>

	<tr class="tablo_ici">
	<td align="center" valign="top" rowspan="2" style="padding:13px" width="130">
<img src="'.$resim.'" style="max-width:110px" />
<br />'.$yazan.'
<br />'.$eposta.'
<br />'.$yazan_ip.'
	</td>

	<td valign="top" style="padding:10px">
'.$yorum_icerik.'
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" height="20" style="height:20px">
'.$yorum_onay.' &nbsp; &nbsp; '.$yorum_duzenle.' &nbsp; &nbsp; '.$yorum_sil.'
	</td>
	</tr>';
}

if ($sira == 0) $yorumlar .= '<br><center>'.$yorum_yok.'</center>';



$sayfa_adi = $ly['yorumlar'];
$tema_sayfa_baslik = $ly['yorumlar'];


$tema_sayfa_icerik = '
<center>'.$yorum_kip_link.'</center>
<hr style="border:0; border-top:2px solid#ccc; width:310px"><br>
<table cellspacing="1" cellpadding="6" border="0" width="98%" align="center" class="tablo-ana">
'.$yorumlar.'
</table>
<br>';

} // koşul sonu

// YORUMLAR - SONU //
// YORUMLAR - SONU //
// YORUMLAR - SONU //





// tema dosyası yükleniyor
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>