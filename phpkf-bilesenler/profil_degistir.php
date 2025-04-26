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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='3'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_GERECLER')) include_once('gerecler.php');
if (!defined('DOSYA_GUVENLIK')) include_once('guvenlik.php');
if (!defined('DOSYA_KULLANICI_KIMLIK')) include_once 'kullanici_kimlik.php';
if (!defined('DOSYA_TEMA_SINIF')) include_once('sinif_tema.php');

$_COOKIE['kullanici_kimlik'] = $vt->real_escape_string($_COOKIE['kullanici_kimlik']);




    //  E-POSTA - ŞİFRE DEĞİŞTİRME - BAŞI  //

if ( (isset($_GET['kosul'])) AND ($_GET['kosul'] == 'sifre') ):

$TEMA_SAYFA_KIP = 'SIFRE';

// kullanıcı bilgilileri çekiliyor

$vtsorgu = "SELECT id,posta FROM $tablo_kullanicilar WHERE kullanici_kimlik='$_COOKIE[kullanici_kimlik]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$satir = $vt->fetch_array($vtsonuc);

$javascript_kodu = '<script type="text/javascript"><!--
function denetle(){
var dogruMu = true;
for (var i=0; i<10; i++){
	if (document.form1.elements[i].value==""){
		dogruMu = false;
		alert(jsl["isaretli_alanlar_zorunludur"]);
		break;}}
if (document.form1.ysifre.value != document.form1.ysifre2.value){
	dogruMu = false; 
	alert(jsl["sifreler_uyusmuyor"]);}
return dogruMu;}
//  -->
</script>';


$TEMA_FORM_BILGI = '<form name="form1" action="phpkf-bilesenler/profil_degistir_yap.php?o='.$o.'" method="post" onsubmit="return denetle()">
<input type="hidden" name="profil_degisti_mi" value="form_dolu" />
<input type="hidden" name="islem_turu" value="sifre" />';

$uye_posta = $satir['posta'];

$TEMA_ALAN_BILGI = '<font size="1"><i>&nbsp;&nbsp; '.$l['isaretli_alanlar_zorunludur'].'</i></font>';





// tema dosyası yükleniyor
$sayfano = 29;
$sayfa_adi = $l['sifre_degistir'];
$TEMA_SAYFA_BASLIK = $l['sifre_degistir'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/profil_degistir.php'));



    //  E-POSTA - ŞİFRE DEĞİŞTİRME - SONU  //








    // NORMAL PROFİL DEĞİŞTİRME - BAŞI  //

else:

$TEMA_SAYFA_KIP = 'BILGI';




// kullanıcı bilgilileri çekiliyor

$vtsorgu = "SELECT * FROM $tablo_kullanicilar WHERE kullanici_kimlik='$_COOKIE[kullanici_kimlik]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$satir = $vt->fetch_array($vtsonuc);



			//	RESİM YÜKLEME AYARLARI - BAŞI	//

$TEMA_RESIM_YUKLEME_ALANLARI = false;

if (($ayarlar['uye_resim_galerisi'] == 1) OR ($ayarlar['uye_resim_yukle'] == 1))
{
	$TEMA_RESIM_YUKLEME_ALANLARI = true;

	$resim_boyut = $ayarlar['uye_resim_yukseklik'].'x'.$ayarlar['uye_resim_genislik'].'px - '.($ayarlar['uye_resim_boyut']/1024).'kb';
	$resim_boyut = str_replace('{00}', $resim_boyut, $l['resim_dosya_boyutu']);
	$resim_yukleme_bilgi = $l['sadece_resim_dosyalari'].'<br>'.$resim_boyut;



	// GEÇERLİ RESİM GÖSTERİLİYOR	//

	if ( (isset($_POST['secim_yap'])) AND (isset($_POST['galeri_resimi'])) AND ($_POST['galeri_resimi'] != '') )
		$gecerli_resim = '<img src="'.$_POST['galeri_resimi'].'" alt="'.$l['uye_resmi'].'">&nbsp;
<label style="cursor: pointer;">
<input type="checkbox" name="resim_sil">'.$l['gecerli_resmi_sil'].'</label>';

	elseif ($satir['resim'])
		$gecerli_resim = '<img src="'.$satir['resim'].'" alt="'.$l['uye_resmi'].'">&nbsp;
<label style="cursor: pointer;">
<input type="checkbox" name="resim_sil">'.$l['gecerli_resmi_sil'].'</label>';

	else $gecerli_resim = $l['yok'];


	// RESİM GALERİSİ AÇIKSA	//

	if ($ayarlar['uye_resim_galerisi'] == 1)
	{
		$galeri_link = $phpkf_dosyalar['profil'].'?kip=pgaleri';

		if ((isset($_POST['secim_yap'])) AND (isset($_POST['galeri_resimi'])) AND ($_POST['galeri_resimi'] != ''))
			$uzak_resim2 = $_POST['galeri_resimi'];

		else $uzak_resim2 = '';
	}

	else $galeri_link = '';
}







				//	RESİM YÜKLEME AYARLARI - SONU	//




if($satir['posta_goster'] == 1) $posta_goster_evet = 'checked="checked"';
else $posta_goster_evet = '';

if($satir['posta_goster'] == 0) $posta_goster_hayir = 'checked="checked"';
else $posta_goster_hayir = '';

$posta_goster = '<label style="cursor: pointer;">
<input type=radio name="posta_goster" value="1" '.$posta_goster_evet.'>'.$l['evet'].'</label>&nbsp;&nbsp;
<label style="cursor: pointer;">
<input type="radio" name="posta_goster" value="0" '.$posta_goster_hayir.'>'.$l['hayir'].'</label>';




if($satir['dogum_tarihi_goster'] == 1) $dogum_goster_evet = 'checked="checked"';
else $dogum_goster_evet = '';

if($satir['dogum_tarihi_goster'] == 2) $yas_goster_evet = 'checked="checked"';
else $yas_goster_evet = '';

if($satir['dogum_tarihi_goster'] == 0) $dogum_goster_hayir = 'checked="checked"';
else $dogum_goster_hayir = '';


$dogum_goster = '<label style="cursor: pointer;">
<input type="radio" name="dogum_tarihi_goster" value="1" '.$dogum_goster_evet.'>'.$l['tarih'].'</label>&nbsp;&nbsp;

<label style="cursor: pointer;">
<input type="radio" name="dogum_tarihi_goster" value="2" '.$yas_goster_evet.'>'.$l['yas'].'</label>&nbsp;&nbsp;

<label style="cursor: pointer;">
<input type="radio" name="dogum_tarihi_goster" value="0" '.$dogum_goster_hayir.'>'.$l['gizle'].'</label>';




if($satir['sehir_goster'] == 1) $sehir_goster_evet = 'checked="checked"';
else $sehir_goster_evet = '';

if($satir['sehir_goster'] == 0) $sehir_goster_hayir = 'checked="checked"';
else $sehir_goster_hayir = '';


$sehir_goster = '<label style="cursor: pointer;">
<input type="radio" name="sehir_goster" value="1" '.$sehir_goster_evet.'>'.$l['evet'].'</label>&nbsp;&nbsp;

<label style="cursor: pointer;">
<input type="radio" name="sehir_goster" value="0" '.$sehir_goster_hayir.'>'.$l['hayir'].'</label>';




if($satir['gizli'] == 0) $cevrimici_goster_evet = 'checked="checked"';
else $cevrimici_goster_evet = '';

if($satir['gizli'] == 1) $cevrimici_goster_hayir = 'checked="checked"';
else $cevrimici_goster_hayir = '';



$cevrimici_goster = '<label style="cursor: pointer;">
<input type="radio" name="gizli" value="0" '.$cevrimici_goster_evet.'>'.$l['evet'].'</label>&nbsp;&nbsp;

<label style="cursor: pointer;">
<input type="radio" name="gizli" value="1" '.$cevrimici_goster_hayir.'>'.$l['hayir'].'</label>';










//	DOĞUM TARİHİ SEÇENEKLERİ	//

$dogum = explode('-', $satir['dogum_tarihi']);

$uye_dogum = '<select class="input-text" name="dogum_gun" required>';
if ($dogum[0] == '00') $uye_dogum .= '<option value="">'.$l['gun'].'</option>';

for ($i=1; $i<32; $i++)
{
	if ($i<10) $a = '0'.$i;
	else $a = $i;
	$uye_dogum .= '<option value="'.$a.'"';
	if ($dogum[0] == $i) $uye_dogum .= ' selected="selected"';
	$uye_dogum .= '>'.$a.'</option>';
}

$uye_dogum .= '</select> &nbsp;<select class="input-text" name="dogum_ay" required>';
if ($dogum[1] == '00') $uye_dogum .= '<option value="">'.$l['ay'].'</option>';

for ($i=1; $i<13; $i++)
{
	if ($i<10) $a = '0'.$i;
	else $a = $i;
	$uye_dogum .= '<option value="'.$a.'"';
	if ($dogum[1] == $i) $uye_dogum .= ' selected="selected"';
	$uye_dogum .= '>'.$a.'</option>';
}

$uye_dogum .= '</select> &nbsp;<select class="input-text" name="dogum_yil" required>';
if ($dogum[2] == '0000') $uye_dogum .= '<option value="">'.$l['yil'].'</option>';

$i=date('Y');
for ($i; $i>1929; $i--)
{
	if ($dogum[2] != $i) $uye_dogum .= '<option value="'.$i.'">'.$i.'</option>';
	else $uye_dogum .= '<option value="'.$i.'" selected="selected">'.$i.'</option>';
}

$uye_dogum .= '</select>';



// Cinsiyet seçimi
$uye_cinsiyet = '<select class="input-text" name="cinsiyet">
<option value="0">'.$l['secin'].'</option>
<option value="1"';
if ($satir['cinsiyet'] == '1') $uye_cinsiyet .= ' selected="selected"';
$uye_cinsiyet .= '>'.$l['erkek'].'</option>
<option value="2"';
if ($satir['cinsiyet'] == '2') $uye_cinsiyet .= ' selected="selected"';
$uye_cinsiyet .= '>'.$l['kadin'].'</option></select>';




$imza_azami = str_replace('{00}', $ayarlar['uye_imza_uzunluk'], $l['imza_hakkinda_azami']);
$imza_bilgi = $l['imza_bilgi'].'<br>'.$imza_azami.' '.$l['bbcode_ifade_kullanilabilir'];


$hakkinda_uzunluk = 1000;
$hakkinda_azami = str_replace('{00}', $hakkinda_uzunluk, $l['imza_hakkinda_azami']);
$hakkinda_bilgi = $l['hakkinda_bilgi'].'<br>'.$hakkinda_azami.' '.$l['bbcode_ifade_kullanilabilir'];


$javascript_kodu = '<script type="text/javascript"><!--
function denetle(){
var dogruMu = true;
for (var i=0; i<15; i++){
if (document.form1.elements[i].value==""){
	dogruMu = false; 
	alert(jsl["isaretli_alanlar_zorunludur"]);
	break;}}
return dogruMu;}
//  -->
</script>';


$javascript_kodu2 = '<script type="text/javascript"><!-- //
function imzaUzunluk(){
var div_katman = document.getElementById(\'imza_uzunluk\');
div_katman.innerHTML = \''.$l['karakter_sayisi'].': \' + ('.$ayarlar['uye_imza_uzunluk'].'-document.form1.imza.value.length);
if (document.form1.imza.value.length > '.$ayarlar['uye_imza_uzunluk'].'){
alert(\''.$l['imza'].': '.$imza_azami.'\');
document.form1.imza.value = document.form1.imza.value.substr(0,'.$ayarlar['uye_imza_uzunluk'].');
div_katman.innerHTML = \''.$l['karakter_sayisi'].': 0\';}
return true;}
function hakkindaUzunluk(){
var div_katman = document.getElementById(\'hakkinda_uzunluk\');
div_katman.innerHTML = \''.$l['karakter_sayisi'].': \' + ('.$hakkinda_uzunluk.'-document.form1.hakkinda.value.length);
if (document.form1.hakkinda.value.length > '.$hakkinda_uzunluk.'){
alert(\''.$l['hakkinda'].': '.$hakkinda_azami.'\');
document.form1.hakkinda.value = document.form1.hakkinda.value.substr(0,'.$hakkinda_uzunluk.');
div_katman.innerHTML = \''.$l['karakter_sayisi'].': 0\';}
return true;}
imzaUzunluk();
hakkindaUzunluk();
//  -->
</script>';


$uye_adi = $satir['kullanici_adi'];
$uye_tam_adi = $satir['gercek_ad'];
$uye_sehir = $satir['sehir'];
$uye_imza = $satir['imza'];
$uye_hakkinda = $satir['hakkinda'];
$uye_web = $satir['web'];
$uye_icq = $satir['icq'];
$uye_facebook = $satir['aim'];
$uye_msn = $satir['msn'];
$uye_yahoo = $satir['yahoo'];
$uye_twitter = $satir['skype'];
$TEMA_ALAN_BILGI = '<font size="1"><i>&nbsp;&nbsp; '.$l['isaretli_alanlar_zorunludur'].'</i></font>';


$TEMA_FORM_BILGI = '<form name="form1" action="phpkf-bilesenler/profil_degistir_yap.php?o='.$o.'" method="post" enctype="multipart/form-data" onsubmit="return denetle()">
<input type="hidden" name="profil_degisti_mi" value="form_dolu" />
<input type="hidden" name="MAX_FILE_SIZE" value="1022999" />
<input type="hidden" name="islem_turu" value="normal" />';



// tema dosyası yükleniyor
$sayfano = 30;
$sayfa_adi = $l['profil_degistir'];
$TEMA_SAYFA_BASLIK = $l['profil_degistir'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/profil_degistir.php'));

endif;

?>