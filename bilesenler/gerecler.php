<?php
/*
 +-=========================================================================-+
 |                       php Kolay Forum (phpKF) v2.10                       |
 +---------------------------------------------------------------------------+
 |               Telif - Copyright (c) 2007 - 2017 phpKF Ekibi               |
 |                 http://www.phpKF.com   -   phpKF@phpKF.com                |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkartma ve satma hakları sadece phpKF`ye aittir.|
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  www.phpKF.com  adresini ziyaret edin.       |
 +-=========================================================================-+*/


define('DOSYA_GERECLER',true);


function NumaraBicim($numara, $ondalik=0)
{
	$donen = @number_format($numara,$ondalik,',','.');
	return $donen;
}



function SatirAtla($metin)
{
    $donen = '';
    $bas = 0;

    while ( $secilen = substr($metin, $bas, 90) )
    {
        if ( (!@preg_match('/ /', $secilen)) AND (!@preg_match('/http/i', $secilen)) AND (!@preg_match('(^|[\n])', $secilen)) AND (!@preg_match('/-/', $secilen)) )
            $donen .= $secilen.'<wbr>';

        else $donen .= $secilen;
        $bas += 90;
    }
    return $donen;
}



// html için
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
    $donen = @urldecode($metin);
    $donen = @$vt->real_escape_string($donen);

    $bul = array('>', '<');
    $cevir = array('&gt;', '&lt;');
    $donen = @str_replace($bul, $cevir, $donen);

    return $donen;
}


function zkTemizle2($metin)
{
    global $vt;
    $donen = @$vt->real_escape_string($metin);

    $bul = array('&', '>', '<', '{', '}');
    $cevir = array('&amp;', '&gt;', '&lt;', '&#123;', '&#125;');
    $donen = @str_replace($bul, $cevir, $donen);

    return $donen;
}


//  önizleme temizleme için //

function zkTemizle3($metin)
{
    $bul = array('&', '>', '<', '{', '}', '\\');
    $cevir = array('&amp;', '&gt;', '&lt;', '&#123;', '&#125;', '&#92;');
    $donen = @str_replace($bul, $cevir, $metin);

    return $donen;
}


//  çift tırnak temizleme   //

function zkTemizle4($metin)
{
    $bul = array('"');
    $cevir = array('');
    $donen = @str_replace($bul, $cevir, $metin);

    return $donen;
}


//  Sadece numara kabul eder //

function zkTemizleNumara($metin)
{
    $donen = zkTemizle($metin);
    $bul = array('x','-','.',',');
    $cevir = array('');
    $donen = @str_replace($bul, $cevir, $donen);
    if (!is_numeric($donen)) $donen = 0;

    return $donen;
}


//  tüm iletiler için   //

function ileti_yolla($metin, $tip)
{
    if ($tip == 1) $donen = @str_replace('"', '&#34;', @zkTemizle2($metin));
    elseif ($tip == 2) $donen = @zkTemizle2($metin);
    elseif ($tip == 3) $donen = @str_replace('"', '&#34;', @zkTemizle3($metin));
    else $donen = @zkTemizle3($metin);

    return $donen;
}



function zonedate($tarih_bicimi, $saat_dilimi, $sunucu_zamani, $zaman)
{
    $yaz_saati = date('I');

    if ($sunucu_zamani)
    {
        if ($yaz_saati == 1) $bolge = 3600;
        else $bolge = 0;
    }

    else
    {
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

    $ozaman = gmdate('d.m.Y', $zaman + $bolge);
    $simdi = gmdate('d.m.Y', time() + $bolge);
    $dun = gmdate('d.m.Y', (time() + $bolge - 86400));
    $onceki = gmdate('d.m.Y', (time() + $bolge - 172800));

    if ($ozaman == $simdi) $tarih = 'Bugün, '.gmdate('H:i', $zaman + $bolge);
    elseif ($ozaman == $dun) $tarih = 'Dün, '.gmdate('H:i', $zaman + $bolge);
    elseif ($ozaman == $onceki) $tarih = 'Önceki gün, '.gmdate('H:i', $zaman + $bolge);
    else $tarih = gmdate($tarih_bicimi, $zaman + $bolge);

    return $tarih;
}



function zonedate2($tarih_bicimi, $saat_dilimi, $sunucu_zamani, $zaman)
{
    $yaz_saati = date('I');

    if ($sunucu_zamani)
    {
        if ($yaz_saati == 1) $bolge = 3600;
        else $bolge = 0;
    }

    else
    {
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

    $tarih = gmdate($tarih_bicimi, $zaman + $bolge);
    return $tarih;
}



function duzenli_ifadeler($metin)
{
    global $kullanici_kim;

    $donen = str_replace('  ',' &nbsp; ',$metin);

    $donen = preg_replace('#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is', '\\1<a href="\\2" target="_blank">\\2</a>', $donen);

    $donen = preg_replace('#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is', '\\1<a href="http://\\2" target="_blank">\\2</a>', $donen);

    $donen = preg_replace('#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i', '\\1<a href="mailto:\\2@\\3">\\2@\\3</a>', $donen);

    return $donen;
}



function imza_denetim($metin)
{
    return $metin;
}



function bbcode_kapali($metin)
{
    $donen = str_replace("\n", '<br>', duzenli_ifadeler(SatirAtla($metin)));
    return $donen;
}



function bbcode_acik($metin, $kodno)
{
	global $ayarlar, $kullanici_kim;

	$donen = preg_replace('|\[list=([a-z0-9]*?)\](.*?)\[/list\]|si','<ul type="\\1">\\2</ul>',$metin);

    $bul = array('[list]', '[*]', '[/list]', '[LIST]', '[/LIST]',
	'[b]', '[/b]', '[B]', '[/B]',
	'[u]', '[/u]', '[U]', '[/U]',
	'[i]', '[/i]', '[I]', '[/I]',
	'[s]', '[/s]', '[S]', '[/S]',
	'[center]', '[/center]', '[CENTER]', '[/CENTER]',
	'[left]', '[/left]', '[LEFT]', '[/LEFT]',
	'[right]', '[/right]', '[RIGHT]', '[/RIGHT]');

	$cevir = array('<ul>', '<li>', '</ul>', '<ul>', '</ul>',
	'<b>', '</b>', '<b>', '</b>',
	'<u>', '</u>', '<u>', '</u>',
	'<i>', '</i>', '<i>', '</i>',
	'<s>', '</s>', '<s>', '</s>',
	'<div align="center">', '</div>', '<div align="center">', '</div>',
	'<div align="left">', '</div>', '<div align="left">', '</div>',
	'<div align="right">', '</div>', '<div align="right">', '</div>');

	$donen = str_replace($bul, $cevir, $donen);


    if ($ayarlar['boyutlandirma'] == '1') $donen = preg_replace('|\[img\]([a-z0-9?&\\/\-_+.:,=#!@%;ğĞüÜŞşIİıÖöÇç ]+?)\[/img\]|si','<img src="\\1" alt="Resim Ekleme" onload="ResimBoyutlandir(this)" onclick="javascript:ResimBuyut(this)" />',$donen);
    else $donen = preg_replace('|\[img\]([a-z0-9?&\\/\-_+.:,=#!@%;ğĞüÜŞşIİıÖöÇç ]+?)\[/img\]|si','<img src="\\1" alt="Resim Ekleme" style="border:1px solid #ddd; max-width:99%" />',$donen);

    $donen = preg_replace('|\[color=([a-z0-9#]*?)\](.*?)\[/color\]|si','<font color="\\1">\\2</font>',$donen);
    $donen = preg_replace('|\[size=([0-9]*?)\](.*?)\[/size\]|si','<font size="\\1">\\2</font>',$donen);
    $donen = preg_replace('|\[font=([a-z0-9-_ ]*?)\](.*?)\[/font\]|si','<font face="\\1">\\2</font>',$donen);
    $donen = preg_replace('|\[url=([a-z0-9?&\\/\-_+.:,=#!@%;ğĞüÜŞşIİıÖöÇç ]+?)\](.*?)\[/url\]|si','<a href="\\1" target="_blank">\\2</a>',$donen);
    $donen = preg_replace('|\[mail=([a-z0-9?&\\/\-_+.:,=#!@%;I]+?)\](.*?)\[/mail\]|si','<a href="mailto:\\1">\\2</a>',$donen);
    $donen = preg_replace('|\[youtube\].*?youtube.com/watch\?v=([a-z0-9?&\\/\-_+.:,=#!@;I]+?)\[/youtube\]|si','<iframe width="560" height="315" src="//www.youtube.com/embed/\\1" frameborder="0" allowfullscreen></iframe>',$donen);
    $donen = preg_replace('|\[youtube\].*?youtu.be/([a-z0-9?&\\/\-_+.:,=#!@;I]+?)\[/youtube\]|si','<iframe width="560" height="315" src="//www.youtube.com/embed/\\1" frameborder="0" allowfullscreen></iframe>',$donen);
    $donen = preg_replace('|\[video]([a-z0-9?&\\/\-_+.:,=#!@;I]+?)\[/video\]|si','<video src="\\1" controls="true" preload="auto" width="100%">Browser does not support the video tag (Tarayıcı video etiketi desteklemiyor)</video>',$donen);
    $donen = preg_replace('|\[audio]([a-z0-9?&\\/\-_+.:,=#!@;I]+?)\[/audio\]|si','<audio src="\\1" controls="true">Browser does not support the audio tag (Tarayıcı audio etiketi desteklemiyor)</audio>',$donen);


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
			$bul = array('[quote="', '[/quote]', '[QUOTE="', '"]', '[/QUOTE]');
			$cevir = array('<div class="alinti_baslik"><b>Alıntı Çizelgesi:</b>&nbsp;', '</div><br>', '<div class="alinti_baslik"><b>Alıntı Çizelgesi:</b>&nbsp;', ' yazmış</div><div class="alinti_icerik">', '</div><br>');

			$donen2 .= str_replace($bul, $cevir, $depo);

			if (isset($uyusanlar[$dongu][1]))
			{
				$bul2 = array('&amp;', '&gt;', '&lt;', '&#123;', '&#125;', '&#92;','&nbsp;', '&#039;', '&quot;');
				$cevir2 = array('&', '>', '<', '{', '}', '\\', ' ', "'", '"');
				$kodlama = $uyusanlar[$dongu][1];
				$renklendi = @str_replace($bul2, $cevir2, $uyusanlar[$dongu][2]);

				$renklendi = highlight_string(('mwdvstqkhsnl_<?php '.$renklendi),true);
				$renklendi = str_replace('mwdvstqkhsnl_<span style="color: #0000BB">&lt;?php&nbsp;','<span style="color: #0000BB">',$renklendi);
				$renklendi = str_replace('mwdvstqkhsnl_<font color="#0000BB">&lt;?php&nbsp;','<span style="color: #0000BB">',$renklendi);

				$renklendi = str_replace(array('<code>', '</code>'), '', $renklendi);
				$renklendi = str_replace("\r\n", '<br />', $renklendi);

				$don = explode("<br />",$renklendi);
				$tsatir = count($don);
				for($i=0; $i < $tsatir; $i++) $satirlar .= ($i+1).'<br />';
				$satirlarSonuc = $satirlar;

				$donen2 .= '<div class="kod-cizelgesi"><div class="kod-baslik"><b>Kod Çizelgesi: '.$kodlama.'</b>
<span><a href="javascript:void(0);" onclick="javascript:hepsiniSec(\'kod_sec_'.$kodno.$dongu.'\');return false;">[Hepsini Seç]</a>';
if($tsatir>19) $donen2 .= '&nbsp;<a href="javascript:void(0);" title="Genişlet / Daralt" onclick="javascript:KodBoyut(\'kod_icerik_'.$kodno.$dongu.'\',this);">&#9660;</a>';
$donen2 .= '</span></div>
<div class="kod-icerik" id="kod_icerik_'.$kodno.$dongu.'" style="max-height:343px">
<div class="kodSatir">'.$satirlarSonuc.'</div>
<code class="kodlar" id="kod_sec_'.$kodno.$dongu.'">'.$renklendi.'<br /></code>
</div></div>';
				$satirlar='';
			}
			$dongu++;
		}
	}
	return $donen2;
}




//  İFADELER TANIMLANIYOR - BAŞI   //
//  Farklı ifadeler eklemek için şu konuya bakın:
//  http://www.phpkf.com/k1877-ifade-ekleme-ve-siralanisini-degistirme.html

$ifadeler_dizin = $TEMA_SITE_ANADIZIN.'dosyalar/ifadeler/';

$ifaadeler_dizi1 = array(
':)', ':d', ';)', ':(', ':g', ':p', '(h)', ':-a', ':i', ':-s', ':|', '*-)', '|-)', '-o)', ':-b', ':-o', ':s'
);

$ifaadeler_dizi2 = array(
'happy.gif',
'bigsmile.gif',
'wink.gif',
'sad.gif',
'grin48.jpg',
'tongue.gif',
'buff.gif',
'msnmix.gif',
'naughty.gif',
'bar.gif',
'msnmix2.gif',
'unimpressed1.gif',
'sleepy.gif',
'uga.gif',
'shy01.gif',
'confused.gif',
'cnf.gif'
);

//  İFADELER TANIMLANIYOR - SONU   //




function ifadeler($metin)
{
    global $ayarlar;
    global $ifadeler_dizin;
    global $ifaadeler_dizi1;
    global $ifaadeler_dizi2;
    $dongu = 0;

    foreach ($ifaadeler_dizi2 as $tek)
    {
        $cevir[] = '<img src="'.$ifadeler_dizin.$tek.'" title="'.$ifaadeler_dizi1[$dongu].'" alt="'.$ifaadeler_dizi1[$dongu].'" />';
        $dongu++;
    }

    $donen = str_replace($ifaadeler_dizi1, $cevir, $metin);
    return $donen;
}



function ifade_olustur($adet)
{
    global $ayarlar;
    global $ifadeler_dizin;
    global $ifaadeler_dizi1;
    global $ifaadeler_dizi2;

    $dongu = 0;
    $olustur = '';

    foreach ($ifaadeler_dizi2 as $tek)
    {
        $olustur .= '<img src="'.$ifadeler_dizin.$tek.'" title="'.$ifaadeler_dizi1[$dongu].'" alt="'.$ifaadeler_dizi1[$dongu].'" id="ifade'.($dongu+1).'" border="0" class="ifade" onmouseover="olay_fare_ustune2(this)" onmouseout="olay_fare_cekme2(this)" onmousedown="olay_fare_tikb(this)" onmouseup="olay_fare_tikb2(this)" onclick="islem_ifade(\''.$ifadeler_dizin.$tek.'\', \''.$ifaadeler_dizi1[$dongu].'\')" />&nbsp;'."\r\n";

        $dongu++;

        if ( ($dongu % $adet) == 0 ) $olustur .= '<br>';
    }

    return $olustur;
}

?>