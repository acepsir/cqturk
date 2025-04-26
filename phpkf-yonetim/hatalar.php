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


$phpkf_ayarlar_kip = "";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');



// Dil dosyası yükleniyor
if (@include_once('phpkf-bilesenler/diller/'.$site_dili.'/hata.php'));
else include_once('phpkf-bilesenler/diller/tr/hata.php');



//  ZARARLI KODLAR TEMİZLENİYOR  //

if ((!isset($_GET['no'])) OR (!is_numeric($_GET['no']))) $no = 0;
else $no = $_GET['no'];

if (isset($_GET['git']))
{
	$git = @zkTemizle(@zkTemizle4($_GET['git']));
	$git = str_replace('veisareti','&amp;',$git);
}

elseif (isset($_SERVER['HTTP_REFERER']))
{
	$git = @zkTemizle(@zkTemizle4($_SERVER['HTTP_REFERER']));
	$git = str_replace('veisareti','&amp;',$git);
}
else $git = '';






//  BİLGİ İLETİLERİ  - BAŞI  //


$bilgi_no[1] = '<meta http-equiv="Refresh" content="5;url=ayarlar.php?kip='.$git.'" />'.$lyb[1].', <a href="ayarlar.php?kip='.$git.'">'.$lyh['tikla_geri2'].'</a>';

$bilgi_no[2] = '<meta http-equiv="Refresh" content="5;url=eklentiler.php#'.$git.'" />'.$lyb[2].', <a href="eklentiler.php#'.$git.'">'.$lyh['tikla_geri2'].'</a>';

$bilgi_no[3] = '<meta http-equiv="Refresh" content="5;url=eklentiler.php#'.$git.'" />'.$lyb[3].', <a href="eklentiler.php#'.$git.'">'.$lyh['tikla_geri2'].'</a>';

$bilgi_no[4] = $lyb[4][0].', <a href="yeni_uye.php">'.$lyh['tikla_geri2'].'</a><br /><br /><a href="../'.$phpkf_dosyalar['profil'].'?u='.$no.'">'.$lyb[4][1].'</a><br /><a href="uye_degistir.php?u='.$no.'">'.$lyb[4][2].'</a>';

$bilgi_no[5] = '<meta http-equiv="Refresh" content="5;url=yazilar.php?ktip='.$no.'" />'.$lyb[5].', <a href="yazilar.php?ktip='.$no.'">'.$lyh['tikla_geri2'].'</a>';

$bilgi_no[6] = '<meta http-equiv="Refresh" content="5;url=yazilar.php?ktip='.$no.'" />'.$lyb[6][0].', <a href="../'.$git.'">'.$lyb[6][1].'</a><br /><a href="yazilar.php?ktip='.$no.'">'.$lyb[6][2].'</a>';

$bilgi_no[7] = '<meta http-equiv="Refresh" content="5;url=yazilar.php?ktip='.$no.'" />'.$lyb[7][0].', <a href="../'.$git.'">'.$lyb[7][1].'</a><br /><a href="yazilar.php?ktip='.$no.'">'.$lyb[7][2].'</a>';

$bilgi_no[8] = '<meta http-equiv="Refresh" content="5;url=kategoriler.php?ktip='.$no.'" />'.$lyb[8].', <a href="kategoriler.php?ktip='.$no.'">'.$lyh['tikla_geri2'].'</a>';

$bilgi_no[9] = '<meta http-equiv="Refresh" content="5;url=kategoriler.php?ktip='.$no.'" />'.$lyb[9].', <a href="kategoriler.php?ktip='.$no.'">'.$lyh['tikla_geri2'].'</a>';

$bilgi_no[10] = '<meta http-equiv="Refresh" content="5;url=tasarim.php" />'.$lyb[10].', <a href="tasarim.php">'.$lyh['tikla_geri2'].'</a>';

$bilgi_no[11] = '<meta http-equiv="Refresh" content="5;url=tasarim.php" />'.$lyb[11].', <a href="tasarim.php">'.$lyh['tikla_geri2'].'</a>';

$bilgi_no[12] = '<meta http-equiv="Refresh" content="5;url='.$git.'" />'.$lyb[12].', <a href="'.$git.'">'.$lyh['tikla_geri2'].'</a>';

$bilgi_no[13] = '<meta http-equiv="Refresh" content="5;url=yorumlar.php" />'.$lyb[13].', <a href="yorumlar.php">'.$lyh['tikla_geri2'].'</a>';

$bilgi_no[14] = $lyb[14];

$bilgi_no[15] = $lyb[15].'<br /><br /><a href="eklentiler.php#'.$git.'">'.$lyh['tikla_geri1'].'</a>';

$bilgi_no[16] = $lyb[16].'<br /><br /><a href="eklentiler.php#'.$git.'">'.$lyh['tikla_geri1'].'</a>';

$bilgi_no[17] = '<meta http-equiv="Refresh" content="5;url=temalar.php" />'.$lyb[2].', <a href="temalar.php">'.$lyh['tikla_geri2'].'</a>';

$bilgi_no[18] = '<meta http-equiv="Refresh" content="5;url=baglantilar.php?kip='.$git.'" />'.$lyb[1].', <a href="baglantilar.php?kip='.$git.'">'.$lyh['tikla_geri2'].'</a>';

$bilgi_no[19] = '<meta http-equiv="Refresh" content="5;url=kategoriler.php?ktip='.$no.'" />'.$lyb[1].', <a href="kategoriler.php?ktip='.$no.'">'.$lyh['tikla_geri2'].'</a>';

$bilgi_no[20] = '<meta http-equiv="Refresh" content="5;url=eklentiler.php#'.$git.'" />'.$lyb[20].', <a href="eklentiler.php#'.$git.'">'.$lyh['tikla_geri2'].'</a>';

$bilgi_no[21] = $lyb[21].'<br /><br /><a href="eklentiler.php#'.$git.'">'.$lyh['tikla_geri1'].'</a>';

$bilgi_no[23] = $lyb[23].'<br /><br /><a href="uyeler.php?kip=engelli">'.$lyh['tikla_geri1'].'</a>';

$bilgi_no[24] = $lyb[24][0].' <a href="uyeler.php?kip=engelli">'.$lyh['tikla_geri1'].'</a><br /><br /><a href="uyeler.php">'.$lyb[24][1].'</a>';

$bilgi_no[25] = $lyb[25][0].' <a href="uyeler.php?kip=etkisiz">'.$lyh['tikla_geri1'].'</a><br /><br /><a href="uyeler.php">'.$lyb[25][1].'</a>';

$bilgi_no[26] = $lyb[26].'<br /><br /><a href="uyeler.php?kip=etkisiz">'.$lyh['tikla_geri1'].'</a>';

$bilgi_no[32] = $lyb[32][0].', <a href="../'.$phpkf_dosyalar['profil'].'?u='.$no.'">'.$lyb[32][1].'</a><br /><br /><a href="uyeler.php">'.$lyb[32][2].'</a><meta http-equiv="Refresh" content="5;url=uyeler.php">';

$bilgi_no[33] = $lyb[33][0].' <a href="uyeler.php">'.$lyh['tikla_geri1'].'</a><br /><br /><a href="uyeler.php?kip=etkisiz">'.$lyb[33][1].'</a>';

$bilgi_no[34] = $lyb[23].'<br /><br /><a href="uyeler.php">'.$lyh['tikla_geri1'].'</a>';

$bilgi_no[35] = $lyb[35][0].' <a href="uyeler.php">'.$lyh['tikla_geri1'].'</a><br /><br /><a href="uyeler.php?kip=engelli">'.$lyb[35][1].'</a>';

$bilgi_no[37] = $lyb[37];

$bilgi_no[39] = $lyb[39].'<br><br><a href="yasaklamalar.php">'.$lyh['tikla_geri1'].'</a>';


//  BİLGİ İLETİLERİ  - SONU  //




//  HATA İLETİLERİ  - BAŞI  //


$hata_no[1] = $lyh[1];

$hata_no[2] = $lyh[2];

$hata_no[3] = $lyh[3];

$hata_no[4] = $lyh[4];

$hata_no[5] = $lyh[5];

$hata_no[6] = $lyh[6];

$hata_no[7] = $lyh[7];

$hata_no[8] = $lyh[8];

$hata_no[9] = $lyh[9];

$hata_no[10] = $lyh[10];

$hata_no[11] = $lyh[11];

$hata_no[12] = $lyh[12];

$hata_no[13] = $lyh[13];

$hata_no[14] = $lyh[14].'<br />'.$git;

$hata_no[15] = $lyh[15];

$hata_no[16] = $lyh[16];

$hata_no[17] = $lyh[17];

$hata_no[18] = $lyh[18];

$hata_no[19] = $lyh[19];

$hata_no[20] = $lyh[20];

$hata_no[21] = $lyh[21];

$hata_no[22] = $lyh[22];

$hata_no[23] = $lyh[23];

$hata_no[26] = $lyh[26];

$hata_no[27] = $lyh[27];

$hata_no[28] = $lyh[28];

$hata_no[31] = $lyh[31];

$hata_no[32] = $lyh[32];

$hata_no[33] = $lyh[33];

$hata_no[34] = $lyh[34];

$hata_no[35] = $lyh[35];

$hata_no[36] = $lyh[36];

$hata_no[40] = $lyh[40];

$hata_no[42] = $lyh[42];

$hata_no[43] = $lyh[43];

$hata_no[45] = $lyh['hatali_adres'].'<br />'.$lyh['tikla_geri3'];

$hata_no[46] = $lyh[46];

$hata_no[61] = $lyh[61];

$hata_no[73] = $lyh[73];

$hata_no[74] = $lyh[74];

$hata_no[75] = $lyh[75];

$hata_no[76] = $lyh[76];

$hata_no[77] = $lyh[77];

$hata_no[78] = str_replace('{00}', $ayarlar['uye_imza_uzunluk'], $lyh[78]);

$hata_no[79] = $lyh[79];

$hata_no[80] = $lyh[80];

$hata_no[81] = $lyh[81];

$hata_no[82] = $lyh[82];

$hata_no[83] = $lyh[83];

$hata_no[84] = $lyh[84];

$hata_no[85] = $lyh[85];

$hata_no[86] = str_replace('{00}', ($ayarlar['uye_resim_boyut']/1024), $lyh[86]);

$hata_no[87] = str_replace('{00}', ($ayarlar['uye_resim_genislik'].'x'.$ayarlar['uye_resim_yukseklik']), $lyh[87]);

$hata_no[88] = $lyh[88];

$hata_no[89] = $lyh[89];

$hata_no[90] = str_replace('{00}', ($ayarlar['uye_resim_boyut']/1024), $lyh[90]);

$hata_no[91] = str_replace('{00}', ($ayarlar['uye_resim_genislik'].'x'.$ayarlar['uye_resim_yukseklik']), $lyh[91]);

$hata_no[92] = $lyh[92];

$hata_no[93] = $lyh[93];

$hata_no[94] = $lyh[94];

$hata_no[137] = $lyh[137];

$hata_no[144] = $lyh[144];

$hata_no[147] = $lyh[147];

$hata_no[148] = $lyh[148];

$hata_no[149] = $lyh[149];

$hata_no[151] = $lyh[151];

$hata_no[156] = $lyh[156];

$hata_no[157] = $lyh[157];

$hata_no[158] = $lyh[158];

$hata_no[159] = $lyh[159];

$hata_no[224] = $lyh[224];

$hata_no[225] = '<meta http-equiv="Refresh" content="5;url=ayar_alan.php" />'.$lyh[225].'<br><a href="ayar_alan.php">'.$lyh['tikla_geri1'].'</a>';

$hata_no[226] = '<meta http-equiv="Refresh" content="5;url=ayar_dil.php" />'.$lyh[226].'<br><a href="ayar_dil.php">'.$lyh['tikla_geri1'].'</a>';


//  HATA İLETİLERİ  - SONU  //




//  UYARI İLETİLERİ  - BAŞI  //


$uyari_no[1] = $lyu[1];

$uyari_no[2] = $lyu[2];


//  UYARI İLETİLERİ  - SONU  //




// GELEN VERİYE GÖRE SAYFA HAZIRLANIYOR - BAŞI  //

if ( isset($_GET['bilgi']) )
{
	if ( (empty($bilgi_no[$_GET['bilgi']])) OR (!is_numeric($_GET['bilgi'])) )
	{
		$sayfa_adi = $lyh['hatali_adres'];
		$hata_baslik = $lyh['hatali_adres'];
		$hata_icerik = $lyh['hatali_adres'];
	}

	else
	{
		$sayfa_adi = $lyh['bilgi_iletisi'];
		$hata_baslik = $lyh['bilgi_iletisi'];
		$hata_icerik = $bilgi_no[$_GET['bilgi']];
	}
}



elseif ( isset($_GET['hata']) )
{
	if ( (empty($hata_no[$_GET['hata']])) OR (!is_numeric($_GET['hata'])) )
	{
		$sayfa_adi = $lyh['hatali_adres'];
		$hata_baslik = $lyh['hatali_adres'];
		$hata_icerik = $lyh['hatali_adres'];
	}

	else
	{
		$sayfa_adi = $lyh['hata_iletisi'];
		$hata_baslik = $lyh['hata_iletisi'];
		$hata_icerik = '<font color="red">'.$hata_no[$_GET['hata']].'</font>';
	}
}



elseif ( isset($_GET['uyari']) )
{
	if ( (empty($uyari_no[$_GET['uyari']])) OR (!is_numeric($_GET['uyari'])) )
	{
		$sayfa_adi = $lyh['hatali_adres'];
		$hata_baslik = $lyh['hatali_adres'];
		$hata_icerik = $lyh['hatali_adres'];
	}

	else
	{
		$sayfa_adi = $lyh['uyari_iletisi'];
		$hata_baslik = $lyh['uyari_iletisi'];
		$hata_icerik = $uyari_no[$_GET['uyari']];
	}
}



else
{
	$sayfa_adi = $lyh['hatali_adres'];
	$hata_baslik = $lyh['hatali_adres'];
	$hata_icerik = $lyh['hatali_adres'];
}

// GELEN VERİYE GÖRE SAYFA HAZIRLANIYOR - SONU  //



$tema_sayfa_baslik = $hata_baslik;
$tema_sayfa_icerik = '<center><br />'.$hata_icerik.'<br /><br /></center>';


// tema dosyası yükleniyor
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>