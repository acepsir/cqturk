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


if (!defined('PHPKF_ICINDEN')) exit();
define('DOSYA_GERECLER',true);


function NumaraBicim($numara, $ondalik=0)
{
	$donen = @number_format($numara,$ondalik,',','.');
	return $donen;
}


function BoslukSil($metin)
{
	$donen = $metin;
	$donen = trim($donen);
	return $donen;
}


// yazılar için, html izni var
function zkTemizle0($metin)
{
	global $vt;

	$donen = $metin;
	$donen = @$vt->real_escape_string($donen);
	return $donen;
}


function zkTemizle($metin)
{
	global $vt;

	$donen = $metin;
	$donen = @urldecode($donen);
	$donen = @$vt->real_escape_string($donen);

	$bul = array('>', '<');
	$cevir = array('&gt;', '&lt;');
	$donen = @str_replace($bul, $cevir, $donen);

	return $donen;
}


function zkTemizle2($metin)
{
	global $vt;

	$donen = $metin;
	$donen = @$vt->real_escape_string($donen);

	$bul = array('&', '>', '<', '{', '}');
	$cevir = array('&amp;', '&gt;', '&lt;', '&#123;', '&#125;');
	$donen = @str_replace($bul, $cevir, $donen);

	return $donen;
}


// önizleme temizleme için
function zkTemizle3($metin)
{
	$donen = $metin;
	$bul = array('&', '>', '<', '{', '}', '\\');
	$cevir = array('&amp;', '&gt;', '&lt;', '&#123;', '&#125;', '&#92;');
	$donen = @str_replace($bul, $cevir, $donen);

	return $donen;
}


// çift tırnak temizleme
function zkTemizle4($metin)
{
	$donen = $metin;
	$bul = array('%22', '"', 'PHPSESSID');
	$cevir = array('','','');
	$donen = @str_replace($bul, $cevir, $donen);

	return $donen;
}


// Sadece numara kabul eder
function zkTemizleNumara($metin)
{
	$donen = $metin;
	$donen = zkTemizle($donen);
	$bul = array('x','-','.',',');
	$cevir = array('');
	$donen = @str_replace($bul, $cevir, $donen);
	if (!is_numeric($donen)) $donen = 0;

	return $donen;
}



// tüm iletiler için
function ileti_yolla($metin, $tip)
{
	$donen = $metin;

	// başlıklar için, html ve bazı karakterler yok
	if ($tip == 1) $donen = @str_replace('"', '&#34;', @zkTemizle2($donen));

	// cms yorum ve forum yazıları için, html yok
	elseif ($tip == 2) $donen = @zkTemizle2($donen);

	// başlıklar önizleme için, html ve bazı karakterler yok
	elseif ($tip == 3) $donen = @str_replace('"', '&#34;', @zkTemizle3($donen));

	// html izni var
	elseif ($tip == 4) $donen = @zkTemizle0($donen);

	// yazılar önizleme için, html yok
	else $donen = @zkTemizle3($donen);

	return $donen;
}




// Zaman fonksiyonu
function zaman($tarih_bicimi,$saat_dilimi,$sunucu_zamani,$zaman,$bicim=0,$bugun=false)
{
	global $l;

	if ($sunucu_zamani)
	{
		$yaz_saati = date('I');
		if ($yaz_saati == 1) $bolge = 3600;
		else $bolge = 0;
	}

	else
	{
		$yaz_saati = date('I');
		if ($saat_dilimi >> 0)
		{
			if ($yaz_saati == 1) $bolge = ($saat_dilimi + 1) * 3600;
			else $bolge = $saat_dilimi * 3600;
		}

		else
		{
			if ($yaz_saati == 1) $bolge = 3600;
			else $bolge = 0;
		}
	}

	if ($bugun)
	{
		$ozaman = gmdate('d.m.Y', $zaman + $bolge);
		$simdi = gmdate('d.m.Y', time() + $bolge);
		$dun = gmdate('d.m.Y', (time() + $bolge - 86400));
		$onceki = gmdate('d.m.Y', (time() + $bolge - 172800));

		if ($ozaman == $simdi) $tarih = $l['bugun'].', '.gmdate('H:i', $zaman + $bolge);
		elseif ($ozaman == $dun) $tarih = $l['dun'].', '.gmdate('H:i', $zaman + $bolge);
		elseif ($ozaman == $onceki) $tarih = $l['onceki_gun'].', '.gmdate('H:i', $zaman + $bolge);
		else
		{
			if ($bicim == 0) $tarih = gmdate($tarih_bicimi, $zaman + $bolge);
			else $tarih = mb_convert_encoding(strftime($tarih_bicimi, $zaman),"UTF-8","ISO-8859-9");
		}
	}
	else
	{
		if ($bicim == 0) $tarih = gmdate($tarih_bicimi, $zaman + $bolge);
		else $tarih = mb_convert_encoding(strftime($tarih_bicimi, $zaman),"UTF-8","ISO-8859-9");
	}

	return $tarih;
}


// Zaman fonksiyonu (Eski forum için, bugün var)
function zonedate($tarih_bicimi,$saat_dilimi,$sunucu_zamani,$zaman,$bicim=0,$bugun=true)
{
	global $l, $ayarlar;
	$bicim = $ayarlar['tarih'];
	$tarih = zaman($tarih_bicimi,$saat_dilimi,$sunucu_zamani,$zaman,$bicim,$bugun);
	return $tarih;
}


// Zaman fonksiyonu (Eski forum için, bugün yok)
function zonedate2($tarih_bicimi,$saat_dilimi,$sunucu_zamani,$zaman,$bicim=0,$bugun=false)
{
	global $l, $ayarlar;
	$bicim = $ayarlar['tarih'];
	$tarih = zaman($tarih_bicimi,$saat_dilimi,$sunucu_zamani,$zaman,$bicim,$bugun);
	return $tarih;
}




// Düzenli ifadeler
function duzenli_ifadeler($metin)
{
	global $kullanici_kim;

	$donen = $metin;
	$donen = str_replace('  ',' &nbsp; ',$donen);
	$donen = preg_replace('#(^|[\n ])([\w]+?://[\w\#$%&çşğüöı~/.\-;:=,?@\[\]+]*)#is', '\\1<a href="\\2" target="_blank">\\2</a>', $donen);
	$donen = preg_replace('#(^|[\n ])((www|ftp)\.[\w\#$%&çşğüöı~/.\-;:=,?@\[\]+]*)#is', '\\1<a href="http://\\2" target="_blank">\\2</a>', $donen);
	$donen = preg_replace('#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i', '\\1<a href="mailto:\\2@\\3">\\2@\\3</a>', $donen);
	return $donen;
}


// Satır atlama
function SatirAtla($metin)
{
	$donen = '';
	$bas = 0;

	while ($secilen = substr($metin, $bas, 90))
	{
		if ( (!@preg_match('/ /', $secilen)) AND (!@preg_match('/http/i', $secilen)) AND (!@preg_match('(^|[\n])', $secilen)) AND (!@preg_match('/-/', $secilen)) )
			$donen .= $secilen.'<wbr>';

		else $donen .= $secilen;
		$bas += 90;
	}
	return $donen;
}


// imza denetim
function imza_denetim($metin)
{
	return $metin;
}


// Yorumlar ve Forum-Portal Yazılar için BBCode Kapalı
function bbcode_kapali($metin)
{
	$donen = $metin;
	$donen = str_replace("\n", '<br>', duzenli_ifadeler(SatirAtla($donen)));
	return $donen;
}




// Yorumlar için BBCode Açık
function bbcode_acik($metin, $kodno)
{
	global $ayarlar, $kullanici_kim;

	$donen = $metin;
	$donen = preg_replace('|\[list=([a-z0-9]*?)\](.*?)\[/list\]|si','<ul type="\\1">\\2</ul>',$donen);

    $bul = array('[list]', '[*]', '[/list]', '[LIST]', '[/LIST]',
	'[b]', '[/b]', '[B]', '[/B]',
	'[u]', '[/u]', '[U]', '[/U]',
	'[i]', '[/i]', '[I]', '[/I]',
	'[s]', '[/s]', '[S]', '[/S]', '[hr]', '[HR]',
	'[sub]', '[/sub]', '[SUB]', '[/SUB]',
	'[sup]', '[/sup]', '[SUP]', '[/SUP]',
	'[center]', '[/center]', '[CENTER]', '[/CENTER]',
	'[left]', '[/left]', '[LEFT]', '[/LEFT]',
	'[right]', '[/right]', '[RIGHT]', '[/RIGHT]',
	'[justify]', '[/justify]', '[JUSTIFY]', '[/JUSTIFY]');

	$cevir = array('<ul>', '<li>', '</ul>', '<ul>', '</ul>',
	'<b>', '</b>', '<b>', '</b>',
	'<u>', '</u>', '<u>', '</u>',
	'<i>', '</i>', '<i>', '</i>',
	'<s>', '</s>', '<s>', '</s>', '<hr class="yatay_cizgi">', '<hr class="yatay_cizgi">',
	'<sub>', '</sub>', '<sub>', '</sub>',
	'<sup>', '</sup>', '<sup>', '</sup>',
	'<div align="center">', '</div>', '<div align="center">', '</div>',
	'<div align="left">', '</div>', '<div align="left">', '</div>',
	'<div align="right">', '</div>', '<div align="right">', '</div>',
	'<div align="justify">', '</div>', '<div align="justify">', '</div>');

	$donen = str_ireplace($bul, $cevir, $donen);


	$donen = preg_replace('|\[table=([0-9%]*?)\]|si','<table class="bbcode_tablo" width="\\1">',$donen);
	$bul = array('[table]', '[/table]','[tr]', '[/tr]','[td]', '[/td]','[th]', '[/th]');
	$cevir = array('<table class="bbcode_tablo">','</table>','<tr>', '</tr>','<td>', '</td>','<th>', '</th>');
	$donen = str_ireplace($bul, $cevir, $donen);


	$donen = preg_replace('|\[img\]([a-z0-9?&\\/\-_+.:,=#!@%;ğĞüÜŞşIİıÖöÇç ]+?)\[/img\]|si','<img src="\\1" alt="." style="border:1px solid #ddd; max-width:99%" />',$donen);

    $donen = preg_replace('|\[color=([a-z0-9#]*?)\](.*?)\[/color\]|si','<font color="\\1">\\2</font>',$donen);
	$donen = preg_replace('|\[bgcolor=([a-z0-9#]*?)\](.*?)\[/bgcolor\]|si','<span style="background-color:\\1">\\2</span>',$donen);
	$donen = preg_replace('|\[h([0-9]*?)\](.*?)\[/h([0-9]*?)\]|si','<h\\1>\\2</h\\3>',$donen);
	$donen = preg_replace('|\[size=([0-9]*?)\](.*?)\[/size\]|si','<font size="\\1">\\2</font>',$donen);
	$donen = preg_replace('|\[font=([a-z0-9-_ ]*?)\](.*?)\[/font\]|si','<font face="\\1">\\2</font>',$donen);
	$donen = preg_replace('|\[url=([a-z0-9?&\\/\-_+.:,=#!@%;ğĞüÜŞşIİıÖöÇç ]+?)\](.*?)\[/url\]|si','<a href="\\1" target="_blank">\\2</a>',$donen);
	$donen = preg_replace('|\[mail=([a-z0-9?&\\/\-_+.:,=#!@%;I]+?)\](.*?)\[/mail\]|si','<a href="mailto:\\1">\\2</a>',$donen);
	$donen = preg_replace('|\[youtube\].*?youtube.com/watch\?v=([a-z0-9?&\\/\-_+.:,=#!@;I]+?)\[/youtube\]|si','<iframe width="560" height="315" src="https://www.youtube.com/embed/\\1" frameborder="0" allowfullscreen></iframe>',$donen);
	$donen = preg_replace('|\[youtube\].*?youtu.be/([a-z0-9?&\\/\-_+.:,=#!@;I]+?)\[/youtube\]|si','<iframe width="560" height="315" src="https://www.youtube.com/embed/\\1" frameborder="0" allowfullscreen></iframe>',$donen);
	$donen = preg_replace('|\[video]([a-z0-9?&\\/\-_+.:,=#!@;I]+?)\[/video\]|si','<video src="\\1" controls="true" preload="auto" width="100%">Browser does not support the video tag (Tarayıcı video etiketi desteklemiyor)</video>',$donen);
	$donen = preg_replace('|\[audio]([a-z0-9?&\\/\-_+.:,=#!@;I]+?)\[/audio\]|si','<audio src="\\1" controls="true" preload="auto">Browser does not support the audio tag (Tarayıcı audio etiketi desteklemiyor)</audio>',$donen);



	$kod_bul = preg_match_all('|\[code=(.*?)\](.*?)\[/code\]|si', $donen, $uyusanlar, PREG_SET_ORDER);

	if (isset($kod_bul))
	{
		$parcala = preg_split('|\[code=(.*?)\](.*?)\[/code\]|si', $donen, -1, PREG_SPLIT_OFFSET_CAPTURE);
		$dongu = 0;
		$donen2 = '';
		$satirlar = '';

		foreach ($parcala as $yazi)
		{
			$depo = str_replace("\n", '<br>', duzenli_ifadeler($yazi[0]));
			$bul = array('[quote]', '[quote="', '"]', '[/quote]');
			$cevir = array('<div class="alinti-cizelgesi"><div class="kimden alinti_baslik">Alıntı</div><div class="icerik alinti_icerik">', '<div class="alinti-cizelgesi"><div class="kimden alinti_baslik">', '</div><div class="icerik alinti_icerik">', '</div></div>');

			$donen2 .= str_ireplace($bul, $cevir, $depo);

			if (isset($uyusanlar[$dongu][1]))
			{
				$bul2 = array('&amp;', '&gt;', '&lt;', '&#123;', '&#125;', '&#92;','&nbsp;', '&#039;', '&quot;');
				$cevir2 = array('&', '>', '<', '{', '}', '\\', ' ', "'", '"');
				$kodlama = $uyusanlar[$dongu][1];
				$renklendi = str_replace($bul2, $cevir2, $uyusanlar[$dongu][2]);

				$renklendi = highlight_string(('mwdvstqkhsnl_<?php '.$renklendi),true);
				$renklendi = str_replace('mwdvstqkhsnl_<span style="color: #0000BB">&lt;?php&nbsp;','<span style="color: #0000BB">',$renklendi);
				$renklendi = str_replace('mwdvstqkhsnl_<font color="#0000BB">&lt;?php&nbsp;','<span style="color: #0000BB">',$renklendi);

				$don = explode("<br />", $renklendi);
				$tsatir = count($don);
				$renklendi = str_replace(array("\n", "\r", "</code><code>"), array('', '', '</code>'.PHP_EOL.'<code>'), implode('</code><code>', $don));

				$donen2 .= '<div class="kod-cizelgesi"><div class="baslik"><b>Kod Çizelgesi: '.$kodlama.'</b><span><a href="javascript:void(0)" onclick="javascript:hepsiniSec(\'kod_sec_'.$kodno.$dongu.'\');return false">[Hepsini Seç]</a>';
				if($tsatir>15) $donen2 .= '&nbsp;<a href="javascript:void(0)" title="Genişlet / Daralt" onclick="javascript:KodBoyut(\'kod_icerik_'.$kodno.$dongu.'\',this,336)">&#9660;</a>';
				$donen2 .= '</span></div><div class="kod-icerik" id="kod_icerik_'.$kodno.$dongu.'" style="max-height:336px"><pre id="kod_sec_'.$kodno.$dongu.'" class="kodlar">'.$renklendi.'</pre></div></div>';
			}
			$dongu++;
		}
	}
	return $donen2;
}




// yazılardaki özel kodlar
function ozel_kodlar($metin, $kodno)
{
$donen = $metin;
$kod_bul = preg_match_all('|\<pre\>(.*?)\</pre\>|si', $donen, $uyusanlar, PREG_SET_ORDER);

if (isset($kod_bul))
{
	$parcala = preg_split('|\<pre\>(.*?)\</pre\>|si', $donen, -1, PREG_SPLIT_OFFSET_CAPTURE);
	$dongu = 0;
	$donen2 = '';

	foreach ($parcala as $yazi)
	{
		$donen2 .= $yazi[0];
		if (isset($uyusanlar[$dongu][1]))
		{
			$bul2 = array('&amp;', '&gt;', '&lt;', '&#123;', '&#125;', '&#92;','&nbsp;', '&#039;', '&quot;');
			$cevir2 = array('&', '>', '<', '{', '}', '\\', ' ', "'", '"');
			$renklendi = str_replace($bul2, $cevir2, $uyusanlar[$dongu][1]);

			$renklendi = highlight_string(('mwdvstqkhsnl_<?php '.$renklendi),true);
			$renklendi = str_replace('mwdvstqkhsnl_<span style="color: #0000BB">&lt;?php&nbsp;','<span style="color: #0000BB">',$renklendi);
			$renklendi = str_replace('mwdvstqkhsnl_<font color="#0000BB">&lt;?php&nbsp;','<span style="color: #0000BB">',$renklendi);

			$don = explode("<br />", $renklendi);
			$tsatir = count($don);
			$renklendi = str_replace(array("\n", "\r", "</code><code>"), array('', '', '</code>'.PHP_EOL.'<code>'), implode('</code><code>', $don));

			$donen2 .= '<div class="kod-cizelgesi"><div class="baslik"><b>Kod Çizelgesi:</b><span><a href="javascript:void(0)" onclick="javascript:hepsiniSec(\'kod_sec_'.$kodno.$dongu.'\');return false">[Hepsini Seç]</a>';
			if($tsatir>15) $donen2 .= '&nbsp;<a href="javascript:void(0)" title="Genişlet / Daralt" onclick="javascript:KodBoyut(\'kod_icerik_'.$kodno.$dongu.'\',this,336)">&#9660;</a>';
			$donen2 .= '</span></div><div class="kod-icerik" id="kod_icerik_'.$kodno.$dongu.'" style="max-height:336px"><pre id="kod_sec_'.$kodno.$dongu.'" class="kodlar">'.$renklendi.'</pre></div></div>';
		}
		$dongu++;
	}
}
return $donen2;
}




//  İFADELER TANIMLANIYOR - BAŞI   //
//  Farklı ifadeler eklemek için şu konuya bakın:
//  http://www.phpkf.com/k1877-ifade-ekleme-ve-siralanisini-degistirme.html

$ifadeler_dizin = $TEMA_SITE_ANADIZIN.'phpkf-dosyalar/ifadeler/';

$ifadeler_dizi = array(
array('k'=>':)', 'b'=>':)', 'd'=>'happy.gif'),
array('k'=>':d', 'b'=>':d', 'd'=>'bigsmile.gif'),
array('k'=>';)', 'b'=>';)', 'd'=>'wink.gif'),
array('k'=>':(', 'b'=>':(', 'd'=>'sad.gif'),
array('k'=>':g', 'b'=>':g', 'd'=>'grin48.jpg'),
array('k'=>':p', 'b'=>':p', 'd'=>'tongue.gif'),
array('k'=>'(h)', 'b'=>'(h)', 'd'=>'buff.gif'),
array('k'=>':-a', 'b'=>':-a', 'd'=>'msnmix.gif'),
array('k'=>':i', 'b'=>':i', 'd'=>'naughty.gif'),
array('k'=>':-s', 'b'=>':-s', 'd'=>'bar.gif'),
array('k'=>':|', 'b'=>':|', 'd'=>'msnmix2.gif'),
array('k'=>'*-)', 'b'=>'*-)', 'd'=>'unimpressed1.gif'),
array('k'=>'|-)', 'b'=>'|-)', 'd'=>'sleepy.gif'),
array('k'=>'-o)', 'b'=>'-o)', 'd'=>'uga.gif'),
array('k'=>':-b', 'b'=>':-b', 'd'=>'shy01.gif'),
array('k'=>':-o', 'b'=>':-o', 'd'=>'confused.gif'),
array('k'=>':s', 'b'=>':s', 'd'=>'cnf.gif'),
array('k'=>':-u', 'b'=>':-u', 'd'=>'up.png'),
array('k'=>':-d', 'b'=>':-d', 'd'=>'down.png'),
array('k'=>':-v', 'b'=>':-v', 'd'=>'victory.png'),
);

//  İFADELER TANIMLANIYOR - SONU   //




function ifadeler($metin)
{
	global $ayarlar, $ifadeler_dizi, $ifadeler_dizin;

	foreach ($ifadeler_dizi as $tek)
	{
		$bul[] = $tek['k'];
		$cevir[] = '<img src="'.$ifadeler_dizin.$tek['d'].'" title="'.$tek['b'].'" alt="'.$tek['k'].'" />';
	}

	$donen = str_replace($bul, $cevir, $metin);
	return $donen;
}



function ifade_olustur($adet)
{
	global $ayarlar, $ifadeler_dizi, $ifadeler_dizin;

	$olustur = '';
	$dongu = 0;

	foreach ($ifadeler_dizi as $tek)
	{
		$olustur .= '<img src="'.$ifadeler_dizin.$tek['d'].'" title="'.$tek['b'].'" alt="'.$tek['k'].'" id="ifade'.($dongu+1).'" border="0" class="ifade" onclick="islem_ifade(\''.$ifadeler_dizin.$tek['d'].'\', \''.$tek['k'].'\')" />&nbsp;'."\r\n";

		$dongu++;
		if ( ($dongu % $adet) == 0 ) $olustur .= '<br>';
	}

	return $olustur;
}

?>