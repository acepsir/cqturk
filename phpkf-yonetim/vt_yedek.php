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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_KULLANICI_KIMLIK')) include_once('../phpkf-bilesenler/kullanici_kimlik.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');



if ($kullanici_kim['id'] != 1)
{
	header('Location: hatalar.php?hata=151');
	exit();
}




$tema_sayfa_icerik = '<table cellspacing="1" width="100%" cellpadding="5" border="0" align="center">
	<tr>
	<td align="left" class="liste-veri">';




//      GELİŞMİŞ KİPİ   -   BAŞI    //

if ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'gelismis') ):


//  PARÇA HESAPLAMA KISMI   -   BAŞI    //

if ( (isset($_GET['parca'])) AND ($_GET['parca'] == 'hesapla') ):

	$ytablo = zkTemizle($_GET['tablo']);


	//	TABLODAKİ SATIR SAYISI ALINIYOR 	//
	$sorgu = $vt->query("SHOW TABLE STATUS LIKE '$ytablo'") or die ($vt->hata_ver());
	$satir_sayisi = $vt->fetch_assoc($sorgu);


	$asama = $satir_sayisi['Rows'] / $_GET['adim'];
	settype($asama,'integer');
	if (($satir_sayisi['Rows'] % $_GET['adim']) != 0) $asama++;


$tema_sayfa_icerik .= '
<br>
<b>&nbsp; '.$ly['tablo_girdi_sayisi'].':</b> '.$satir_sayisi['Rows'].
'<br><b>&nbsp; '.$ly['parca_sayisi'].':</b> '.$asama;


//  PARÇA HESAPLAMA KISMI   -   SONU    //

//  BİRİNCİDEN SONRAKİ AŞAMALAR -   BAŞI    //


elseif ( (isset($_GET['toplamp'])) AND ($_GET['toplamp'] != '') ):

$_GET['devam']+=$_GET['adim'];

$parca = ($_GET['devam'] / $_GET['adim'])+1;

$asama = $_GET['toplamp'];

$tema_sayfa_icerik .= '
<br>
<b>&nbsp; '.$ly['yedekleme_asamasi'].': <font color="red">'.$parca.' / '.$asama.'</font></b>';




else:

endif;



if ( (isset($_GET['yedekle'])) AND ($_GET['yedekle'] == 'yedek_al') ):

$parca = ($_GET['devam'] / $_GET['adim'])+1;

$tema_sayfa_icerik .= '
<center>
<br><br><br>
<form name="yedekle" action="phpkf-bilesenler/vt_yedek_yap.php" method="post">
<input name="toplamp" type="hidden" value="'.$asama.'">
<input name="kip" type="hidden" value="gelismis">
<input name="yedekle" type="hidden" value="yedek_al">
<input name="tablo[]" type="hidden" value="'.$_GET['tablo'].'">
<input name="devam" type="hidden" value="'.$_GET['devam'].'">
<input name="adim" type="hidden" value="'.$_GET['adim'].'">
<input name="gzip" type="hidden" value="'.$_GET['gzip'].'">';


// son aşamaya kadar bu kısım

if ($asama >= ($parca+1))

$tema_sayfa_icerik .= '
<input class="dugme dugme-mavi" type="submit" value="'.$parca.'. '.$ly['parcayi_indir'].'">
</form>

<br><br><hr><br>
<b>'.$parca.'. '.$ly['indir_devam_tikla'].'</b>
<br><br><br>

<form name="yedekle2" action="vt_yedek.php" method="get">
<input name="toplamp" type="hidden" value="'.$asama.'">
<input name="kip" type="hidden" value="gelismis">
<input name="yedekle" type="hidden" value="yedek_al">
<input name="tablo" type="hidden" value="'.$_GET['tablo'].'">
<input name="devam" type="hidden" value="'.$_GET['devam'].'">
<input name="adim" type="hidden" value="'.$_GET['adim'].'">
<input name="gzip" type="hidden" value="'.$_GET['gzip'].'">
<input class="dugme dugme-mavi" type="submit" value="'.$ly['devam'].' &gt;&gt;">
</form>
</center>
';


// tek parça ise bu kısım

elseif ($asama == 1)

$tema_sayfa_icerik .= '
<b>'.$ly['tek_parca_indir'].'</b>

<br><br><br>

<input class="dugme dugme-mavi" type="submit" value="'.$ly['tumunu_indir'].'">
</form>
<br>
<br>
</center>';


// son aşamada bu kısım

else

$tema_sayfa_icerik .= '
<input class="dugme dugme-mavi" type="submit" value="'.$ly['son_parca_indir'].'">
</form>
<br>
<b>'.$ly['son_parca_bilgi'].'</b>
<br><br><br><br>
<a href="vt_yedek.php?kip=gelismis"><b>'.$ly['basa_donmek_icin_yiklayin'].'</b></a>
<br><br>
</center>';


//  BİRİNCİDEN SONRAKİ AŞAMALAR -   SONU    //





else:

//  GELİŞMİŞ KİP GİRİŞ SAYFASI -   BAŞI    //

$tema_sayfa_icerik .= '
<p align="center"><b>'.$ly['vt_yedekle_gelismis_baslik'].'</b></p>
<br>
'.$ly['vt_yedekle_gelismis_bilgi'].'
<br><br>


<form name="yedekle" action="vt_yedek.php" method="get">
<input name="kip" type="hidden" value="gelismis">
<input name="yedekle" type="hidden" value="yedek_al">
<input name="parca" type="hidden" value="hesapla">


<table cellspacing="0" width="450" cellpadding="2" border="0" align="center">
	<tr>
	<td class="liste-etiket" align="center"><b>'.$ly['tablolar'].'</b></td>
	</tr>

	<tr>
	<td class="liste-veri" align="center">
<select class="textarea" name="tablo" size="39" style="width:250px">';


$vtsorgu = $vt->query("SHOW TABLE STATUS") or die ($vt->hata_ver());
while ($tablolar = $vt->fetch_assoc($vtsorgu)){
	$tema_sayfa_icerik .= '<option value="'.$tablolar['Name'].'">'.$tablolar['Name'].'</option>'."\n";
}


$tema_sayfa_icerik .= '</select>
	</td>
	</tr>


	<tr>
	<td class="liste-veri" align="center" valign="top" colspan="2">
<br>
<b>'.$ly['gzip'].': </b> &nbsp;
<label style="cursor: pointer;"><input type="radio" name="gzip" value="0">&nbsp;'.$l['hayir'].'</label>
&nbsp; &nbsp;
<label style="cursor: pointer;"><input type="radio" name="gzip" value="1" checked="checked">&nbsp;'.$l['evet'].'</label>
<br><br><br>';


$tema_sayfa_icerik .= '<input type="hidden" name="devam" value="0">
<b>'.$ly['girdi_adimi'].':&nbsp;</b>
<input class="input-text" type="text" name="adim" size="8" value="1000" maxlength="4">&nbsp; 
<br><br><br>
<input class="dugme dugme-mavi" type="submit" value="'.$ly['parca_hesapla'].'">
<br><br>
	</td>
	</tr>
</table>
</form>';

//  GELİŞMİŞ KİP GİRİŞ SAYFASI -   SONU    //

endif; // devam etmeyi kapat

//  BİRİNCİ AŞAMA -   SONU    //

//      GELİŞMİŞ KİPİ   -   SONU    //





else:
//      NORMAL KİP   -   BAŞI    //

$tema_sayfa_icerik .= '<br>
'.$ly['vt_yedekle_normal_bilgi'].'
<br><br><br>


<form name="yedekle" action="phpkf-bilesenler/vt_yedek_yap.php" method="post">
<input name="yedekle" type="hidden" value="yedek_al">


<table cellspacing="0" width="450" cellpadding="2" border="0" align="center">
	<tr>
	<td class="liste-etiket" align="center"><b>'.$ly['tablolar'].'</b></td>
	</tr>

	<tr>
	<td class="liste-veri" align="center">
<select multiple="multiple" class="textarea" name="tablo[]" id="tablo" size="39" style="width:280px">';


$vtsorgu = $vt->query("SHOW TABLE STATUS") or die ($vt->hata_ver());
while ($tablolar = $vt->fetch_assoc($vtsorgu)){
	$tema_sayfa_icerik .= '<option value="'.$tablolar['Name'].'"';
	if (preg_match("/^$tablo_oneki/i", $tablolar['Name'])) $tema_sayfa_icerik .= ' selected="selected"';
	$tema_sayfa_icerik .= '>'.$tablolar['Name'].'</option>'."\n";
}


$tema_sayfa_icerik .= '</select>
	</td>
	</tr>

	<tr>
	<td class="liste-liste" align="center">
<a href="javascript:void(0)" onclick="hepsiniSec(\'ortak\')">'.$ly['ortak'].'</a>
&nbsp;-&nbsp;
<a href="javascript:void(0)" onclick="hepsiniSec(\'cms\')">'.$ly['cms'].'</a>
&nbsp;-&nbsp;
<a href="javascript:void(0)" onclick="hepsiniSec(\'forum\')">'.$ly['forum'].'</a>
&nbsp;-&nbsp;
<a href="javascript:void(0)" onclick="hepsiniSec(\'portal\')">'.$ly['portal'].'</a>
&nbsp;-&nbsp;
<a href="javascript:void(0)" onclick="hepsiniSec(\'phpkf\')">'.$ly['tum_phpkf'].'</a>
&nbsp;-&nbsp;
<a href="javascript:void(0)" onclick="hepsiniSec(\'hepsi\')">'.$ly['hepsini_sec'].'</a>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="center" valign="top" colspan="3">
<br>
<b>'.$ly['gzip'].': </b> &nbsp;
<label style="cursor: pointer;"><input type="radio" name="gzip" value="0">&nbsp;'.$l['hayir'].'</label>
&nbsp; &nbsp;
<label style="cursor: pointer;"><input type="radio" name="gzip" value="1" checked="checked">&nbsp;'.$l['evet'].'</label>

<br><br><br>

<input class="dugme dugme-mavi" type="submit" name="gonder" value="'.$ly['yedekle'].'">

	</td>
	</tr>
</table>
<br>
</form>';


        //      NORMAL KİP   -   SONU    //
endif;




$tema_sayfa_icerik .= '
	</td>
	</tr>
</table>


<script type="text/javascript"><!-- //
function hepsiniSec(sistem){
var tablo = document.getElementById("tablo");
for (i=0; i < tablo.options.length; i++){
	if (sistem=="ortak"){
		if (tablo.options[i].value.match("^'.$tablo_oneki.'ortak_"))
			tablo.options[i].selected = "selected";
		else tablo.options[i].selected = "";
	}
	else if (sistem=="cms"){
		if (tablo.options[i].value.match("^'.$tablo_oneki.'cms_"))
			tablo.options[i].selected = "selected";
		else tablo.options[i].selected = "";
	}
	else if (sistem=="forum"){
		if (tablo.options[i].value.match("^'.$tablo_oneki.'forum_"))
			tablo.options[i].selected = "selected";
		else tablo.options[i].selected = "";
	}
	else if (sistem=="portal"){
		if (tablo.options[i].value.match("^'.$tablo_oneki.'portal_"))
			tablo.options[i].selected = "selected";
		else tablo.options[i].selected = "";
	}
	else if (sistem=="phpkf"){
		if (tablo.options[i].value.match("^'.$tablo_oneki.'"))
			tablo.options[i].selected = "selected";
		else tablo.options[i].selected = "";
	}
	else tablo.options[i].selected = "selected";
}
}
// -->
</script>';



// tema dosyası yükleniyor
$sayfa_adi = $ly['veritabani_yedekleme'];
$tema_sayfa_baslik = $ly['veritabani_yedekleme'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>