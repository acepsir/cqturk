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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');



// Bloklar veritabanından çekiliyor

$vtsorgu = "SELECT * FROM $tablo_bloklar order by sira";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


$BlokKatmanWhileArray = array();
$BlokOzelWhileArray = array();
$BlokIdWhileArray = array();
$BlokBaslikWhileArray = array();


while ($bloklar = $vt->fetch_assoc($vtsonuc))
{
	$BlokOzelWhileArray[] = $bloklar['ozel_blok'];
	$BlokKatmanWhileArray[] = $bloklar['durum'];
	$BlokIdWhileArray[] = $bloklar['ad'];
	$BlokBaslikWhileArray[] = $bloklar['baslik'];
}




$tema_sayfa_icerik = '
<link rel="stylesheet" type="text/css" media="screen" href="phpkf-bilesenler/css/bloklar.css">

<div id="yeni_blok_kod" class="blsyenipencere ikinciadim endis">
<center>
<div class="kutudevami">
<div id="kutuboyutu">
<div class="kutukomple">
<h2>'.$ly['blok_kodlari'].'<span><a onclick="document.getElementById(\'yeni_blok_kod\').style.display=\'none\';"><button class="dugme dugme-mavi" style="padding:0 5px;height:25px;line-height:20px;">'.$ly['kodlari_kaydet'].'</button></a></span></h2>
<div class="kutuyazialani">
<textarea class="textarea" name="yeniblokkod" id="kodblogualani" style="width:550px; height:280px;"></textarea>
</div>
</div>
</div>
</div>
</center>
</div>
<div style="float:left;position:relative;border:1px solid #ddd;padding:10px;width:573px;margin-right:30px">

';





$sol_bloklar = '<fieldset style="width:150px; padding:5px; float:left; margin-right:10px;"><legend>'.$ly['sol_bloklar'].'</legend><div class="bloklar_yapi2" id="sol_bloklar_alani"><ul id="sol_bloklar" style="padding:10px 0; border:0;">';

$kapali_bloklar = '<fieldset style="width:150px; padding:5px; float:left; margin-right:10px;"><legend>'.$ly['kapali_bloklar'].'</legend><div class="bloklar_yapi2" id="kapali_bloklar_alani"><ul id="kapali_bloklar" style="padding:10px 0; border:0;">';

$sag_bloklar = '<fieldset style="width:150px; padding:5px; float:left;"><legend>'.$ly['sag_bloklar'].'</legend><div class="bloklar_yapi2" id="sag_bloklar_alani"><ul id="sag_bloklar" style="padding:10px 0; border:0;">';


for($i=0; $i < count($BlokIdWhileArray); $i++)
{
	if($BlokKatmanWhileArray[$i] == '1')
	{
		$sol_bloklar .= '<li id="'.$BlokIdWhileArray[$i].'" rel="normal">'.$BlokBaslikWhileArray[$i].'<a href="javascript:void(0);" style="float:right;" rel="'.$BlokIdWhileArray[$i].'" title="'.$BlokBaslikWhileArray[$i].'" class="duzeltLink"><img src="phpkf-bilesenler/temalar/varsayilan/resimler/duzenle.png" width="13" height="13" /></a>';

		if($BlokOzelWhileArray[$i] == 1) 
		{
			$sol_bloklar .= '<a href="javascript:void(0);" style="float:right;" rel="'.$BlokIdWhileArray[$i].'" class="silLink"><img src="phpkf-bilesenler/temalar/varsayilan/resimler/sil.png" width="12" height="12" /></a>';
		}
		$sol_bloklar .= '</li>';
	}
}


for($i=0; $i < count($BlokIdWhileArray); $i++)
{
	if($BlokKatmanWhileArray[$i] == '0')
	{
		$kapali_bloklar .= '<li id="'.$BlokIdWhileArray[$i].'" rel="normal">'.$BlokBaslikWhileArray[$i].'<a href="javascript:void(0);" style="float:right;" rel="'.$BlokIdWhileArray[$i].'" title="'.$BlokBaslikWhileArray[$i].'"  class="duzeltLink"><img src="phpkf-bilesenler/temalar/varsayilan/resimler/duzenle.png" width="13" height="13" /></a>';

		if($BlokOzelWhileArray[$i] == 1) 
		{
			$kapali_bloklar .= '<a href="javascript:void(0);" style="float:right;" rel="'.$BlokIdWhileArray[$i].'" class="silLink"><img src="phpkf-bilesenler/temalar/varsayilan/resimler/sil.png" width="12" height="12" /></a>';
		}
		$kapali_bloklar .= '</li>';
	}
}


for($i=0; $i < count($BlokIdWhileArray); $i++)
{
	if($BlokKatmanWhileArray[$i] == '2')
	{
		$sag_bloklar .= '<li id="'.$BlokIdWhileArray[$i].'" rel="normal">'.$BlokBaslikWhileArray[$i].'<a href="javascript:void(0);" style="float:right;" rel="'.$BlokIdWhileArray[$i].'" title="'.$BlokBaslikWhileArray[$i].'" class="duzeltLink"><img src="phpkf-bilesenler/temalar/varsayilan/resimler/duzenle.png" width="13" height="13" /></a>';

		if($BlokOzelWhileArray[$i] == 1) 
		{
			$sag_bloklar .= '<a href="javascript:void(0);" style="float:right;" rel="'.$BlokIdWhileArray[$i].'" class="silLink"><img src="phpkf-bilesenler/temalar/varsayilan/resimler/sil.png" width="12" height="12" /></a>';
		}
		$sag_bloklar .= '</li>';
	}
}


$kapanis_tagi = '</ul></div></fieldset>';

$sol_bloklar .= $kapanis_tagi;
$kapali_bloklar .= $kapanis_tagi;
$sag_bloklar .= $kapanis_tagi;

$tema_sayfa_icerik .= $sol_bloklar.$kapali_bloklar.$sag_bloklar;





$tema_sayfa_icerik .= '
</div>
<a name="ayarlar"></a>
<div style="float:left;text-align:center;width:595px">
<fieldset>
<legend>'.$ly['ayarlar'].'</legend>

<input class="dugme dugme-mavi" type="submit" name="yeni" id="ayarlariKaydet" value="'.$ly['degisiklikleri_uygula'].'" />
&nbsp;
<input class="dugme dugme-mavi" type="submit" name="yeni" id="yeniOlustur" value="'.$ly['yeni_blok_olustur'].'" />

<span id="ayarlarKaydediliyor" style="border:1px solid #ddd;display:block;height:15px;margin-top:10px;padding:5px">&nbsp;</span>


<div class="label" style="display:none" id="BlokDuzeltmeAlani">

<div style="clear:both; padding:10px"></div>
<input type="hidden" name="baslik2" id="baslik2" value="">
<input type="hidden" name="OzelBlokmu" id="OzelBlokmu" value="0">

<div class="phpkf-form-label">
<label class="label" for="siteadi">'.$ly['baslik'].'<br /></label>
<input class="input-text" type="text" id="baslik1" maxlength="50" style="width:370px" />
</div>

<div class="phpkf-form-label">
<label class="label" for="siteadi">'.$ly['blok_adresi'].'<br /></label>
<input class="input-text" type="text" id="dosyaadres" style="width:370px" />
</div>

<div class="phpkf-form-label">
<label class="label" for="siteadi">'.$ly['blok_genisligi'].'<br /></label>
<input class="input-text" type="text" id="blok_genislik_durumu2" style="width:370px" />
</div>


<div class="phpkf-form-label" style="display:none;" id="kodDuzeltmeBlogu">
<label class="label">
<button onclick="BlokKodlari(\'yklenyr2\');" class="dugme dugme-mavi" style="display:none;margin-top:-6px;margin-left:-20px" id="kodDuzeltmeButon">'.$ly['kod_ekle_degistir'].'</button> &nbsp; 
</label>
<input type="button" id="verileriKaydetButonu" value="'.$l['duzenle'].'" class="dugme dugme-mavi">
</div>

</div>


<div class="phpkf-form-label" id="KayitKatmani"></div>
<span id="yklenyr2"></span>
<span id="ListeYukle"></span>
</fieldset>


<fieldset style="display:none;">
<textarea type="text" name="sol_bloklar_textarea" id="sol_bloklar_textarea" style="width:1%; height:1%;"></textarea><br>
<textarea type="text" name="kapali_bloklar_textarea" id="kapali_bloklar_textarea" style="width:1%; height:1%;"></textarea><br>
<textarea type="text" name="sag_bloklar_textarea" id="sag_bloklar_textarea" style="width:1%; height:1%;"></textarea><br>
</fieldset>

<script>
var yukleniyor = "'.$ly['yukleniyor'].'";
var duzenleniyor = "'.$ly['duzenleniyor'].'";
var kaydediliyor = "'.$ly['kaydediliyor'].'";
var uygulaniyor = "'.$ly['uygulaniyor'].'";
var blok_olusturuldu = "'.$ly['blok_olusturuldu'].'";
var lutfen_alan_seciniz = "'.$ly['lutfen_alan_seciniz'].'";
var blok_baslik = "'.$ly['blok_baslik'].'";
var lutfen_bos_birakmayin = "'.$ly['lutfen_bos_birakmayin'].'";
var blok_sil_uyari = "'.$ly['blok_sil_uyari'].'";
</script>

<script type="text/javascript" src="phpkf-bilesenler/js/betik_bloklar.js"></script>
<script type="text/javascript" src="phpkf-bilesenler/js/surukle_birak.js"></script>
</div>
';



// tema dosyası yükleniyor
$sayfa_adi = $ly['bloklar'];
$tema_sayfa_baslik = $ly['bloklar'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>