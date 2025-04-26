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


if (!defined('PHPKF_ICINDEN')) exit();
if (!defined('DOSYA_GERECLER')) include_once('phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_KULLANICI_KIMLIK')) include_once('phpkf-bilesenler/kullanici_kimlik.php');


// Varsayılan Değerler
if (!isset($duzenleyici_dizin)) $duzenleyici_dizin = '';
if (!isset($duzenleyici_bicim)) $duzenleyici_bicim = 'bbcode';
if (!isset($duzenleyici_id)) $duzenleyici_id = 'mesaj_icerik';
if (!isset($yazi_icerik)) $yazi_icerik = '';
if (!isset($duzenleyici)) $duzenleyici = $ayarlar['yduzenleyici'];



if (!isset($deksorgu))
{
	$deksorgu = '';

	if ($duzenleyici == 'varsayilan') $deksorgu .= "kat='15'";

	elseif ( (($duzenleyici == 'tinymce') OR ($duzenleyici == 'tinymce_pro')) AND (!isset($ayarlar['tinymce_dosya'])) )
	{
		if ($deksorgu != '') $deksorgu .= ' OR ';
		$deksorgu .= "kat='12'";
	}

	if ( (isset($kullanici_kim['yetki'])) AND (!isset($ayarlar['yukleme_video'])) )
	{
		if ($deksorgu != '') $deksorgu .= ' OR ';
		$deksorgu .= "kat='14'";
	}

	// veritabanından tinymce ve/veya video-embed ayarları çekiliyor
	if ($deksorgu != '')
	{
		$vtsorgu = "SELECT etiket,deger FROM $tablo_ayarlar WHERE $deksorgu";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
		while ($ayar = $vt->fetch_assoc($vtsonuc)) $ayarlar[$ayar['etiket']] = $ayar['deger'];
	}
}



// ifadeler yükleniyor
if (!isset($ifade_yukle))
{
	$ifade_yukle_js = 'var ifade_yukle=false;';
	include_once($duzenleyici_dizin.'phpkf-bilesenler/editor/ifadeler.php');
}
else $ifade_yukle_js = 'var ifade_yukle=true;';


$postimage = "window.open('https://postimage.org/mini.php?mode=phpbb&areaid=0&hash=1&lang=turkish&code=hotlink&content=family&forumurl='+escape('$TEMA_SITE_ANADIZIN'),'_imagehost','resizable=yes,width=500,height=400')";


echo '<script type="text/javascript"><!-- //
var duzenleyici_dizin = "'.$duzenleyici_dizin.'";
var duzenleyici_bicim = "'.$duzenleyici_bicim.'";
var duzenleyici_id = "'.$duzenleyici_id.'";
var duzenleyici_katman = "'.$duzenleyici_id.'_div";
'.$ifade_yukle_js.'
//  -->
</script>';



// Düz textarea (yorum için)
if (isset($duzenleyici_textarea)) echo $duzenleyici_textarea;

if ($duzenleyici == 'duz')
{
	include($duzenleyici_dizin.'phpkf-bilesenler/editor/duz/index.php');
}

// phpKF Düzenleyici
elseif ($duzenleyici == 'varsayilan')
{
	include($duzenleyici_dizin.'phpkf-bilesenler/editor/phpkf/index.php');
}

// phpKF Galeri Düzenleyici
elseif ($duzenleyici == 'galeri')
{
	include($duzenleyici_dizin.'phpkf-bilesenler/editor/galeri/index.php');
}

// TinyMCE Düzenleyici
elseif ($duzenleyici == 'tinymce')
{
	include($duzenleyici_dizin.'phpkf-bilesenler/editor/tinymce/index.php');
}

// CKEditor Düzenleyici
elseif ($duzenleyici == 'ckeditor')
{
	include($duzenleyici_dizin.'phpkf-bilesenler/editor/ckeditor/index.php');
}

// SCEditor Düzenleyici
elseif ($duzenleyici == 'sceditor')
{
	include($duzenleyici_dizin.'phpkf-bilesenler/editor/sceditor/index.php');
}

// 3. Parti düzenleyiciler için
else
{
	include($duzenleyici_dizin.'phpkf-bilesenler/eklentiler/'.$duzenleyici.'/editor.php');
}



// js fonksiyonları hazırlanıyor
if (!isset($editor_yukle))
{
	$editor_yukle = true;
	$editorjs_ek = 'if (!ayril){var ayril=false;if(ayril_durum!=false)var ayril_durum=true;}
function Postimage(id){'.$postimage.';}
function YuklemeAcKapat(id){alert(jsl["dosya_yukleme_uyari"])}';
	$editorjs = '<script src="'.$duzenleyici_dizin.'phpkf-bilesenler/editor/editorler.js" type="text/javascript"></script>';
}
else {$editorjs = ''; $editorjs_ek ='';}


echo '<script type="text/javascript"><!-- //
var duzenleyici="'.$duzenleyici.'";
'.$editorjs_ek.'
//  -->
</script>
'.$editorjs.'
<div style="clear:both"></div>';



// Resim ve dosya yükleme butonu olmayan editörler için link ekle
if (($duzenleyici != 'varsayilan') AND ($duzenleyici != 'galeri') AND ($duzenleyici != 'tinymce') )
echo '<div id="dosya_resim_yukleme" style="text-align:center;line-height:20px">
<a href="javascript:void(0)" onclick="'.$postimage.';return false">'.$l['resim_ekle'].'</a>&nbsp; - &nbsp; 
<a href="javascript:void(0)" onclick="YuklemeAcKapat(\''.$duzenleyici_id.'\');return false">'.$l['dosya_ekle'].'</a>
</div>';



// Yöneticiler için dosya yükleme özelliği yükleniyor
if (isset($kullanici_kim['yetki']))
{
	if (($kullanici_kim['yetki'] != 1) AND ($ayarlar['yukleme_dosya_uye'] == ''));
	else include_once($duzenleyici_dizin.'phpkf-bilesenler/yukleme/yuzer.php');
}

?>

<div id="yukleme_pencere" class="yukleme" style="position:fixed;top:0;left:0;bottom:0;right:0;display:none;z-index:1001;margin:auto;width:100%;height:100%;overflow:auto;background-color:rgba(0,0,0,0.7);">
<iframe src="about:blank" id="dyukle" width="470" height="304" style="position:absolute;top:0;left:0;bottom:0;right:0;margin:auto;width:470px;height:304px;overflow:auto;border-radius:7px;border:3px solid #333333;background:#fefefe;"></iframe>
</div>
