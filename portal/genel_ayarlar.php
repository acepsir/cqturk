<?php
/*
 +-=========================================================================-+
 |                             phpKF-Portal v3.00                            |
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


	// dosyası ınclude ediliyor.
	define('YONETIM_TEMADIZINI', true);
	if (!defined('DOSYA_AYAR')) include '../ayar.php';
	if (!defined('DOSYA_MENU')) include 'menu.php';
	if (!defined('DOSYA_PORTAL_AYARLAR')) include 'portal_ayarlar.php';
	if (!defined('DOSYA_DILAYAR')) include 'diller/dil_ayarlari.php';



	// portal yonetim taban rengi nilgisi.
	$arka_tablo = "yonetim_bg2";



	if ($kosul == 'iletisi'){
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './yonetim.php',
	'{ILETI}' => '<meta target="_top" http-equiv="Refresh" content="2; url=./yonetim.php">',
	'{EK_YAZI}' => $kp_yonetim_163,
	'{YONLENDIRME}' => $kp_yonetim_164,
	'{YONLENDIRME2}' => $kp_yonetim_165);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}
	
	if ($hata == 'iletisi'){
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './genel_ayarlar.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_386,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}

	// YAPILAN DEĞIŞIKLILIKLER VERITABANıNA KAYDEDILIYOR //


	if ($kosul == "ayarlari_kaydet")
	{
	//	FORM DOLU MU ?	//

	if ((isset($_POST['kayit_yapildi_mi'])) AND ($_POST['kayit_yapildi_mi'] == 'form_dolu')):

	$_POST['son_mesajlar_sayisi'] = @zkTemizle($_POST['son_mesajlar_sayisi']);
	$_POST['haber_limit'] = @zkTemizle($_POST['haber_limit']);
	$_POST['portal_dili'] = @zkTemizle($_POST['portal_dili']);
	$_POST['son_mesajlar_hr'] = @zkTemizle($_POST['son_mesajlar_hr']);
	$_POST['dosya_sayfalama'] = @zkTemizle($_POST['dosya_sayfalama']);
	$_POST['kullanici_izni'] = @zkTemizle($_POST['kullanici_izni']);
	$_POST['sitemaps'] = @zkTemizle($_POST['sitemaps']);
	$_POST['portal_genislik'] = @zkTemizle($_POST['portal_genislik']);
	$_POST['galeri_limit'] = @zkTemizle($_POST['galeri_limit']);
	$_POST['galeri_kb'] = @zkTemizle($_POST['galeri_kb']);
	$_POST['resim_ekleme'] = @zkTemizle($_POST['resim_ekleme']);
	$_POST['siteler_limit'] = @zkTemizle($_POST['siteler_limit']);
	$_POST['siteler_dal_limit'] = @zkTemizle($_POST['siteler_dal_limit']);
	$_POST['haber_dal_limit'] = @zkTemizle($_POST['haber_dal_limit']);
	$_POST['haber_dalalt_limit'] = @zkTemizle($_POST['haber_dalalt_limit']);
	$_POST['anket_limit'] = @zkTemizle($_POST['anket_limit']);
	$_POST['dosya_dal_limit'] = @zkTemizle($_POST['dosya_dal_limit']);
	$_POST['blok_sekli'] = @zkTemizle($_POST['blok_sekli']);
	$_POST['en_cok_mesaj_atanlar'] = @zkTemizle($_POST['en_cok_mesaj_atanlar']);
	$_POST['son_uyeler'] = @zkTemizle($_POST['son_uyeler']);
	$_POST['blok_dosya_kategorileri'] = @zkTemizle($_POST['blok_dosya_kategorileri']);
	$_POST['blok_haber_kategorileri'] = @zkTemizle($_POST['blok_haber_kategorileri']);
	$_POST['blok_galeri_kategorileri'] = @zkTemizle($_POST['blok_galeri_kategorileri']);
	$_POST['blok_siteler_kategorileri'] = @zkTemizle($_POST['blok_siteler_kategorileri']);
	$_POST['siteharitasi_sayfasi'] = @zkTemizle($_POST['siteharitasi_sayfasi']);
	$_POST['anketler_sayfasi'] = @zkTemizle($_POST['anketler_sayfasi']);
	$_POST['galeri_sayfasi'] = @zkTemizle($_POST['galeri_sayfasi']);
	$_POST['haber_sayfasi'] = @zkTemizle($_POST['haber_sayfasi']);
	$_POST['dosyalar_sayfasi'] = @zkTemizle($_POST['dosyalar_sayfasi']);
	$_POST['siteler_sayfasi'] = @zkTemizle($_POST['siteler_sayfasi']);
	$_POST['takvim_sayfasi'] = @zkTemizle($_POST['takvim_sayfasi']);
	$_POST['arama_sayfasi'] = @zkTemizle($_POST['arama_sayfasi']);
	$_POST['davetiye'] = @zkTemizle($_POST['davetiye']);
	$_POST['duyuru'] = @zkTemizle($_POST['duyuru']);
	$_POST['haber_ac'] = @zkTemizle($_POST['haber_ac']);
	$_POST['son_mesajlar_ac'] = @zkTemizle($_POST['son_mesajlar_ac']);
	$_POST['haber_kaynagi'] = zkTemizle($_POST['haber_kaynagi']);
	$_POST['karakter_sinirlamasi'] = zkTemizle($_POST['karakter_sinirlamasi']);
	$_POST['haberlere_giris_izni'] = zkTemizle($_POST['haberlere_giris_izni']);



	if ((is_numeric($_POST['son_mesajlar_sayisi']) == false) 
	OR (is_numeric($_POST['dosya_sayfalama']) == false)
	OR (is_numeric($_POST['sitemaps']) == false) 
	OR (is_numeric($_POST['haber_limit']) == false)
	OR (is_numeric($_POST['galeri_limit']) == false)
	OR (is_numeric($_POST['siteler_limit']) == false)
	OR (is_numeric($_POST['siteler_dal_limit']) == false)
	OR (is_numeric($_POST['haber_dal_limit']) == false)
	OR (is_numeric($_POST['haber_dalalt_limit']) == false)
	OR (is_numeric($_POST['en_cok_mesaj_atanlar']) == false)
	OR (is_numeric($_POST['son_uyeler']) == false)
	OR (is_numeric($_POST['blok_dosya_kategorileri']) == false)
	OR (is_numeric($_POST['blok_haber_kategorileri']) == false)
	OR (is_numeric($_POST['blok_galeri_kategorileri']) == false)
	OR (is_numeric($_POST['blok_siteler_kategorileri']) == false)
	OR (is_numeric($_POST['karakter_sinirlamasi']) == false)
	OR (is_numeric($_POST['anket_limit']) == false)
	OR (is_numeric($_POST['dosya_dal_limit']) == false))
	{
	header('Location: genel_ayarlar.php?hata=iletisi');
	exit();
	}

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[son_mesajlar_sayisi]' where isim='son_mesajlar_sayisi' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorguq1 = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[karakter_sinirlamasi]' where isim='karakter_sinirlamasi' LIMIT 1";
	$vtsonucq1 = $vt->query($vtsorguq1) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());
	
	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[dosya_sayfalama]' where isim='dosya_sayfalama' LIMIT 1";
	$vtsonuc9 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[sitemaps]' where isim='sitemaps' LIMIT 1";
	$vtsonuc11 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[haber_limit]' where isim='haber_limit' LIMIT 1";
	$vtsonuc16 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[galeri_limit]' where isim='galeri_limit' LIMIT 1";
	$vtsonuc16 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[siteler_dal_limit]' where isim='siteler_dal_limit' LIMIT 1";
	$vtsonuc16 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[siteler_limit]' where isim='siteler_limit' LIMIT 1";
	$vtsonuc16 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[haber_dal_limit]' where isim='haber_dal_limit' LIMIT 1";
	$vtsonuc16 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[haber_dalalt_limit]' where isim='haber_dalalt_limit' LIMIT 1";
	$vtsonuc16 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[anket_limit]' where isim='anket_limit' LIMIT 1";
	$vtsonuc16 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[dosya_dal_limit]' where isim='dosya_dal_limit' LIMIT 1";
	$vtsonuc16 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[en_cok_mesaj_atanlar]' where isim='en_cok_mesaj_atanlar' LIMIT 1";
	$vtsonuc17 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[son_uyeler]' where isim='son_uyeler' LIMIT 1";
	$vtsonuc17 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[blok_dosya_kategorileri]' where isim='blok_dosya_kategorileri' LIMIT 1";
	$vtsonuc17 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[blok_haber_kategorileri]' where isim='blok_haber_kategorileri' LIMIT 1";
	$vtsonuc17 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[blok_galeri_kategorileri]' where isim='blok_galeri_kategorileri' LIMIT 1";
	$vtsonuc17 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[blok_siteler_kategorileri]' where isim='blok_siteler_kategorileri' LIMIT 1";
	$vtsonuc17 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[portal_dili]' where isim='portal_dili' LIMIT 1";
	$vtsonuc3 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[son_mesajlar_hr]' where isim='son_mesajlar_hr' LIMIT 1";
	$vtsonuc7 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[kullanici_izni]' where isim='kullanici_izni' LIMIT 1";
	$vtsonuc10 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[portal_genislik]' where isim='portal_genislik' LIMIT 1";
	$vtsonuc13 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[galeri_kb]' where isim='galeri_kb' LIMIT 1";
	$vtsonuc17 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[resim_ekleme]' where isim='resim_ekleme' LIMIT 1";
	$vtsonuc18 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[blok_sekli]' where isim='blok_sekli' LIMIT 1";
	$vtsonuc19 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgusss = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[haberlere_giris_izni]' where isim='haberlere_giris_izni' LIMIT 1";
	$vtsonuc19sss = $vt->query($vtsorgusss) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_acik='$_POST[davetiye]' where blok_ad='davetiye_sayfasi' LIMIT 1";
	$vtsonuc14 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_acik='$_POST[siteharitasi_sayfasi]' where blok_ad='siteharitasi_sayfasi' LIMIT 1";
	$vtsonuc18 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_acik='$_POST[anketler_sayfasi]' where blok_ad='anketler_sayfasi' LIMIT 1";
	$vtsonuc19 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_acik='$_POST[dosyalar_sayfasi]' where blok_ad='dosyalar_sayfasi' LIMIT 1";
	$vtsonuc19 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_acik='$_POST[galeri_sayfasi]' where blok_ad='galeri_sayfasi' LIMIT 1";
	$vtsonuc20 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_acik='$_POST[haber_sayfasi]' where blok_ad='haber_sayfasi' LIMIT 1";
	$haber = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_acik='$_POST[arama_sayfasi]' where blok_ad='arama_sayfasi' LIMIT 1";
	$haber = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_acik='$_POST[siteler_sayfasi]' where blok_ad='siteler_sayfasi' LIMIT 1";
	$haber = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_acik='$_POST[takvim_sayfasi]' where blok_ad='takvim_sayfasi' LIMIT 1";
	$haber = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_acik='$_POST[duyuru]' where blok_ad='duyuru' LIMIT 1";
	$vtsonuc13 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_acik='$_POST[haber_ac]' where blok_ad='haber' LIMIT 1";
	$vtsonuc13 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_ayarlar SET sayi='$_POST[haber_kaynagi]' where isim='haber_kaynagi' LIMIT 1";
	$vtsonuc1 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_acik='$_POST[son_mesajlar_ac]' where blok_ad='son_mesajlar' LIMIT 1";
	$vtsonuc13 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	header('Location: genel_ayarlar.php?kosul=iletisi');
	endif;
	exit();
	}

	// YAPILAN DEĞIŞIKLILIKLER VERITABANıNA KAYDEDILIYOR - SONU //

	/***************************************************/

	$vtsorgu = "SELECT * FROM $tablo_portal_ayarlar";

	$dil_ayari = @$vt->query($vtsorgu);
	
	if (isset($dil_ayari))
	{
	while ($degeri = $vt->fetch_array($dil_ayari))
	{
		$deger = $degeri['0'];
		$dil_ayar[$deger] = $degeri['1'];
	}
	}

	$sayfa_adi = 'Genel Ayarlar Sayfası';
	if (!defined('DOSYA_YONETIM_BASLIK')) include 'phpkf-bilesenler/yonetim_sayfa_baslik.php';
	menu();


	$tablo = $portal_ayarlar['portal_genislik'];

	########################
	########################

	$dizin_adi = 'temalar/'.$temadizini.'/blok_tasarim/';
	
	$dizin = @opendir($dizin_adi);
	


	$blok_sekli = '<option value="varsayilan_blok_tasarimi"';

	if ($portal_ayarlar['blok_sekli'] == 'varsayilan_blok_tasarimi') 
	$blok_sekli .= ' selected="selected"';

	$blok_sekli .= '>'.$kp_yonetim_373.'</option>';

	while ( @gettype($bilgi = @readdir($dizin)) != 'boolean' )
	{
		if ( (@is_dir($dizin_adi.$bilgi)) AND (preg_match('/../', $bilgi))  AND (preg_match('/.../', $bilgi)) )
		{
			$blok_sekli .= '<option value="'.$bilgi.'"';
			if ($portal_ayarlar['blok_sekli'] == $bilgi) $blok_sekli .= ' selected="selected"';
			$blok_sekli .= '>'.$bilgi.'</option>';
		}
	}
	@closedir($dizin);

	########################
	########################



$dil1 = '';
foreach ($diller as $anahtar => $dil)
{
	if ($dil_ayar['portal_dili'] == $anahtar) $isaretle = ' selected="selected"';
	else $isaretle = '';
	$dil1 .= "\r\n".'<option value="'.$anahtar.'" '.$isaretle.'>'.$diller[$anahtar].'</option>';
}
$dil1 .= '</select>';




	########################
	########################

	$kb = '<option value="51200"';

	if ($portal_ayarlar['galeri_kb'] == 51200) 
	$kb .= ' selected="selected"';

	$kb .= '>50 KB.</option>';
	
	/*************************/
	
	$kb .= '<option value="102400"';

	if ($portal_ayarlar['galeri_kb'] == 102400) 
	$kb .= ' selected="selected"';

	$kb .= '>100 KB.</option>';
	
	/*************************/
	
	$kb .= '<option value="153600"';

	if ($portal_ayarlar['galeri_kb'] == 153600) 
	$kb .= ' selected="selected"';

	$kb .= '>150 KB.</option>';
	
	/*************************/
	
	$kb .= '<option value="204800"';

	if ($portal_ayarlar['galeri_kb'] == 204800) 
	$kb .= ' selected="selected"';

	$kb .= '>200 KB.</option>';
	
	/*************************/
	
	$kb .= '<option value="256000"';

	if ($portal_ayarlar['galeri_kb'] == 256000) 
	$kb .= ' selected="selected"';

	$kb .= '>250 KB.</option>';
	
	/*************************/
	
	$kb .= '<option value="307200"';

	if ($portal_ayarlar['galeri_kb'] == 307200) 
	$kb .= ' selected="selected"';

	$kb .= '>300 KB.</option>';
	
	/*************************/
	
	$kb .= '<option value="409600"';

	if ($portal_ayarlar['galeri_kb'] == 409600) 
	$kb .= ' selected="selected"';

	$kb .= '>400 KB.</option>';
	
	/*************************/
	
	$kb .= '<option value="512000"';

	if ($portal_ayarlar['galeri_kb'] == 512000) 
	$kb .= ' selected="selected"';

	$kb .= '>500 KB.</option>';
	
	/*************************/
	
	$kb .= '<option value="614400"';

	if ($portal_ayarlar['galeri_kb'] == 614400) 
	$kb .= ' selected="selected"';

	$kb .= '>600 KB.</option>';
	
	/*************************/
	
	$kb .= '<option value="768000"';

	if ($portal_ayarlar['galeri_kb'] == 768000) 
	$kb .= ' selected="selected"';

	$kb .= '>750 KB.</option>';
	
		/*************************/
	
	$kb .= '<option value="1048576"';

	if ($portal_ayarlar['galeri_kb'] == 1048576) 
	$kb .= ' selected="selected"';

	$kb .= '>1 MB.</option>';
	
	/*************************/
	
	$kb .= '<option value="1572864"';

	if ($portal_ayarlar['galeri_kb'] == 1572864) 
	$kb .= ' selected="selected"';

	$kb .= '>1.5 MB.</option>';
	
	/*************************/
	
	$kb .= '<option value="2097152"';

	if ($portal_ayarlar['galeri_kb'] == 2097152) 
	$kb .= ' selected="selected"';

	$kb .= '>2 MB.</option>';
	
	########################	
	########################

	$kullanici_izni_ = '<label style="cursor: pointer;"><input type="radio" name="kullanici_izni" value="1"';

	if ($portal_ayarlar['kullanici_izni'] == 1) 
	$kullanici_izni_ .= ' checked="checked"';

	$kullanici_izni_ .= '>'.$kp_yonetim_56.'</label>';

	/*************************/

	$kullanici_izni_ .= '<label style="cursor: pointer;"><input type="radio" name="kullanici_izni" value="0"';

	if ($portal_ayarlar['kullanici_izni'] == 0) 
	$kullanici_izni_ .= ' checked="checked"';

	$kullanici_izni_ .= '>'.$kp_yonetim_57.'</label>';


	########################
	########################	
	
	$haberlere_giris_izni = '<label style="cursor: pointer;"><input type="radio" name="haberlere_giris_izni" value="1"';

	if ($portal_ayarlar['haberlere_giris_izni'] == 1) 
	$haberlere_giris_izni .= ' checked="checked"';

	$haberlere_giris_izni .= '>'.$kp_yonetim_56.'</label>';

	/*************************/

	$haberlere_giris_izni .= '<label style="cursor: pointer;"><input type="radio" name="haberlere_giris_izni" value="0"';

	if ($portal_ayarlar['haberlere_giris_izni'] == 0) 
	$haberlere_giris_izni .= ' checked="checked"';

	$haberlere_giris_izni .= '>'.$kp_yonetim_57.'</label>';


	########################
	########################	

	$son_mesajlar_hr_ = '<label style="cursor: pointer;"><input type="radio" name="son_mesajlar_hr" value="Shareketli"';

	if ($portal_ayarlar['son_mesajlar_hr'] == 'Shareketli')
	$son_mesajlar_hr_ .= ' checked="checked"';

	$son_mesajlar_hr_ .= '>'.$kp_yonetim_47.'</label>';

	/*************************/

	$son_mesajlar_hr_ .= '<label style="cursor: pointer;"><input type="radio" name="son_mesajlar_hr" value="Shareketsiz"';

	if ($portal_ayarlar['son_mesajlar_hr'] == 'Shareketsiz')
	$son_mesajlar_hr_ .= ' checked="checked"';

	$son_mesajlar_hr_ .= '>'.$kp_yonetim_48.'</label>';


	########################
	########################

	$resim_ekleme = '<label style="cursor: pointer;"><input type="radio" name="resim_ekleme" value="1"';

	if ($portal_ayarlar['resim_ekleme'] == '1')
	$resim_ekleme .= ' checked="checked"';

	$resim_ekleme .= '>'.$kp_yonetim_185.'</label>';

	/*************************/

	$resim_ekleme .= '<label style="cursor: pointer;"><input type="radio" name="resim_ekleme" value="0"';

	if ($portal_ayarlar['resim_ekleme'] == '0')
	$resim_ekleme .= ' checked="checked"';

	$resim_ekleme .= '>'.$kp_yonetim_186.'</label>';


	########################
	########################
	
	########################################################################
	########################################################################
	
	$siteharitasi_sayfasi = '<label style="cursor: pointer;"><input type="radio"  name="siteharitasi_sayfasi" value="1"';

	if ($portal_bloklar_ayar['siteharitasi_sayfasi'] == 1) 
	$siteharitasi_sayfasi .= ' checked="checked"';

	$siteharitasi_sayfasi .= '>'.$kp_yonetim_185.'</label>';
	
	/*************************/
	
	$siteharitasi_sayfasi .= '<label style="cursor: pointer;"><input type="radio"  name="siteharitasi_sayfasi" value="0"';

	if ($portal_bloklar_ayar['siteharitasi_sayfasi'] == 0) 
	$siteharitasi_sayfasi .= ' checked="checked"';

	$siteharitasi_sayfasi .= '>'.$kp_yonetim_186.'</label>';
	
	########################
	########################
	
	$anketler_sayfasi = '<label style="cursor: pointer;"><input type="radio" name="anketler_sayfasi" value="1"';

	if ($portal_bloklar_ayar['anketler_sayfasi'] == 1) 
	$anketler_sayfasi .= ' checked="checked"';

	$anketler_sayfasi .= '>'.$kp_yonetim_185.'</label>';
	
	/*************************/
	
	$anketler_sayfasi .= '<label style="cursor: pointer;"><input type="radio" name="anketler_sayfasi" value="0"';

	if ($portal_bloklar_ayar['anketler_sayfasi'] == 0) 
	$anketler_sayfasi .= ' checked="checked"';

	$anketler_sayfasi .= '>'.$kp_yonetim_186.'</label>';
	
	########################
	########################
	
	$takvim_sayfasi = '<label style="cursor: pointer;"><input type="radio" name="takvim_sayfasi" value="1"';

	if ($portal_bloklar_ayar['takvim_sayfasi'] == 1) 
	$takvim_sayfasi .= ' checked="checked"';

	$takvim_sayfasi .= '>'.$kp_yonetim_185.'</label>';
	
	/*************************/
	
	$takvim_sayfasi .= '<label style="cursor: pointer;"><input type="radio" name="takvim_sayfasi" value="0"';

	if ($portal_bloklar_ayar['takvim_sayfasi'] == 0) 
	$takvim_sayfasi .= ' checked="checked"';

	$takvim_sayfasi .= '>'.$kp_yonetim_186.'</label>';
	
	########################
	########################
	
	$siteler_sayfasi = '<label style="cursor: pointer;"><input type="radio" name="siteler_sayfasi" value="1"';

	if ($portal_bloklar_ayar['siteler_sayfasi'] == 1) 
	$siteler_sayfasi .= ' checked="checked"';

	$siteler_sayfasi .= '>'.$kp_yonetim_185.'</label>';
	
	/*************************/
	
	$siteler_sayfasi .= '<label style="cursor: pointer;"><input type="radio" name="siteler_sayfasi" value="0"';

	if ($portal_bloklar_ayar['siteler_sayfasi'] == 0) 
	$siteler_sayfasi .= ' checked="checked"';

	$siteler_sayfasi .= '>'.$kp_yonetim_186.'</label>';
	
	########################
	########################
	
	$dosyalar_sayfasi = '<label style="cursor: pointer;"><input type="radio" name="dosyalar_sayfasi" value="1"';

	if ($portal_bloklar_ayar['dosyalar_sayfasi'] == 1) 
	$dosyalar_sayfasi .= ' checked="checked"';

	$dosyalar_sayfasi .= '>'.$kp_yonetim_185.'</label>';
	
	/*************************/
	
	$dosyalar_sayfasi .= '<label style="cursor: pointer;"><input type="radio" name="dosyalar_sayfasi" value="0"';

	if ($portal_bloklar_ayar['dosyalar_sayfasi'] == 0) 
	$dosyalar_sayfasi .= ' checked="checked"';

	$dosyalar_sayfasi .= '>'.$kp_yonetim_186.'</label>';
	
	########################
	########################
	
	$galeri_sayfasi = '<label style="cursor: pointer;"><input type="radio" name="galeri_sayfasi" value="1"';

	if ($portal_bloklar_ayar['galeri_sayfasi'] == 1) 
	$galeri_sayfasi .= ' checked="checked"';

	$galeri_sayfasi .= '>'.$kp_yonetim_185.'</label>';
	
	/*************************/
	
	$galeri_sayfasi .= '<label style="cursor: pointer;"><input type="radio" name="galeri_sayfasi" value="0"';

	if ($portal_bloklar_ayar['galeri_sayfasi'] == 0) 
	$galeri_sayfasi .= ' checked="checked"';

	$galeri_sayfasi .= '>'.$kp_yonetim_186.'</label>';
	
	########################
	########################
	
	$haber_sayfasi = '<label style="cursor: pointer;"><input type="radio" name="haber_sayfasi" value="1"';

	if ($portal_bloklar_ayar['haber_sayfasi'] == 1) 
	$haber_sayfasi .= ' checked="checked"';

	$haber_sayfasi .= '>'.$kp_yonetim_185.'</label>';
	
	/*************************/
	
	$haber_sayfasi .= '<label style="cursor: pointer;"><input type="radio" name="haber_sayfasi" value="0"';

	if ($portal_bloklar_ayar['haber_sayfasi'] == 0) 
	$haber_sayfasi .= ' checked="checked"';

	$haber_sayfasi .= '>'.$kp_yonetim_186.'</label>';
	
	
	
	########################
	########################
	
	$forum_secenek = '
<select name="haber_kaynagi" class="formlar">';






	// forum adları çekiliyor

	$vtsorgu = "SELECT id,forum_baslik,alt_forum FROM $tablo_forumlar
				WHERE alt_forum='0' AND okuma_izni='0' ORDER BY sira";
	$vtsonuc = $vt->query($vtsorgu);


	while ($forum_satir = $vt->fetch_array($vtsonuc))
	{
		// alt forumuna bakılıyor
		$vtsorgu = "SELECT id,forum_baslik FROM $tablo_forumlar
					WHERE alt_forum='$forum_satir[id]' ORDER BY sira";
		$vtsonuca = $vt->query($vtsorgu);


		if (!$vt->num_rows($vtsonuca))
		{
			if ($portal_ayarlar['haber_kaynagi'] == $forum_satir['id']) $forum_secenek .= '
			<option value="'.$forum_satir['id'].'" selected="selected"> &nbsp; - '.$forum_satir['forum_baslik'];

			else $forum_secenek .= '
			<option value="'.$forum_satir['id'].'"> &nbsp; - '.$forum_satir['forum_baslik'];
		}


		else
		{
			if ($portal_ayarlar['haber_kaynagi'] == $forum_satir['id']) $forum_secenek .= '
			<option value="'.$forum_satir['id'].'" selected="selected"> &nbsp; - '.$forum_satir['forum_baslik'];

			else $forum_secenek .= '
			<option value="'.$forum_satir['id'].'"> &nbsp; - '.$forum_satir['forum_baslik'];


			while ($alt_forum_satir = $vt->fetch_array($vtsonuca))
			{
				if ($portal_ayarlar['haber_kaynagi'] == $alt_forum_satir['id']) $forum_secenek .= '
				<option value="'.$alt_forum_satir['id'].'" selected="selected"> &nbsp; &nbsp; &nbsp; -- '.$alt_forum_satir['forum_baslik'];

				else $forum_secenek .= '
				<option value="'.$alt_forum_satir['id'].'"> &nbsp; &nbsp; &nbsp; -- '.$alt_forum_satir['forum_baslik'];
			}
		}
	}


$forum_secenek .= '</select>';


	$haber_ac = '<label style="cursor: pointer;"><input type="radio" name="haber_ac" value="6"';

	if ($portal_bloklar_ayar['haber'] == '6')
	$haber_ac .= ' checked="checked"';

	$haber_ac .= '>'.$kp_yonetim_371.'</label><br><br>';
	$haber_ac .= $forum_secenek.'<br><br><hr>';

	/*************************/
	
	$haber_ac .= '<label style="cursor: pointer;"><input type="radio" name="haber_ac" value="5"';

	if ($portal_bloklar_ayar['haber'] == '5')
	$haber_ac .= ' checked="checked"';

	$haber_ac .= '>'.$kp_yonetim_365.'</label><br>';

	/*************************/
	
	$haber_ac .= '<label style="cursor: pointer;"><input type="radio" name="haber_ac" value="4"';

	if ($portal_bloklar_ayar['haber'] == '4')
	$haber_ac .= ' checked="checked"';

	$haber_ac .= '>'.$kp_yonetim_364.'</label><br>';

	/*************************/
	
	$haber_ac .= '<label style="cursor: pointer;"><input type="radio" name="haber_ac" value="3"';

	if ($portal_bloklar_ayar['haber'] == '3')
	$haber_ac .= ' checked="checked"';

	$haber_ac .= '>'.$kp_yonetim_363.'</label><br>';

	/*************************/
	
	$haber_ac .= '<label style="cursor: pointer;"><input type="radio" name="haber_ac" value="2"';

	if ($portal_bloklar_ayar['haber'] == '2')
	$haber_ac .= ' checked="checked"';

	$haber_ac .= '>'.$kp_yonetim_359.'</label><br>';

	/*************************/

	$haber_ac .= '<label style="cursor: pointer;"><input type="radio" name="haber_ac" value="1"';

	if ($portal_bloklar_ayar['haber'] == '1')
	$haber_ac .= ' checked="checked"';

	$haber_ac .= '>'.$kp_yonetim_360.'</label><br>';
	
	/*************************/

	$haber_ac .= '<label style="cursor: pointer;"><input type="radio" name="haber_ac" value="0"';

	if ($portal_bloklar_ayar['haber'] == '0')
	$haber_ac .= ' checked="checked"';

	$haber_ac .= '>'.$kp_yonetim_361.'</label><br>';

	
	########################
	########################	


	$davetiye_ = '<option value="0"';

	if ($portal_bloklar_ayar['davetiye_sayfasi'] == 0)
	$davetiye_ .= ' selected="selected"';

	$davetiye_ .= '>'.$kp_yonetim_151.'</option>';

	/*************************/

	$davetiye_ .= '<option value="1"';

	if ($portal_bloklar_ayar['davetiye_sayfasi'] == 1)
	$davetiye_ .= ' selected="selected"';

	$davetiye_ .= '>'.$kp_yonetim_152.'</option>';

	/*************************/

	$davetiye_ .= '<option value="2"';

	if ($portal_bloklar_ayar['davetiye_sayfasi'] == 2)
	$davetiye_ .= ' selected="selected"';

	$davetiye_ .= '>'.$kp_yonetim_153.'</option>';


	########################
	########################
	$son_mesajlar_sayisi2 = '<label style="cursor: pointer;"><input type="radio" name="son_mesajlar_ac" value="1"';

	if ($portal_bloklar_ayar['son_mesajlar'] == '1')
	$son_mesajlar_sayisi2 .= ' checked="checked"';

	$son_mesajlar_sayisi2 .= '>'.$kp_yonetim_185.'</label>';

	/*************************/

	$son_mesajlar_sayisi2 .= '<label style="cursor: pointer;"><input type="radio" name="son_mesajlar_ac" value="0"';

	if ($portal_bloklar_ayar['son_mesajlar'] == '0')
	$son_mesajlar_sayisi2 .= ' checked="checked"';

	$son_mesajlar_sayisi2 .= '>'.$kp_yonetim_186.'</label>';
	
	########################
	########################
	$portal_arama = '<label style="cursor: pointer;"><input type="radio" name="arama_sayfasi" value="1"';

	if ($portal_bloklar_ayar['arama_sayfasi'] == '1')
	$portal_arama .= ' checked="checked"';

	$portal_arama .= '>'.$kp_yonetim_185.'</label>';

	/*************************/

	$portal_arama .= '<label style="cursor: pointer;"><input type="radio" name="arama_sayfasi" value="0"';

	if ($portal_bloklar_ayar['arama_sayfasi'] == '0')
	$portal_arama .= ' checked="checked"';

	$portal_arama .= '>'.$kp_yonetim_186.'</label>';
	
	########################
	########################
	$duyuru = '<label style="cursor: pointer;"><input type="radio" name="duyuru" value="1"';

	if ($portal_bloklar_ayar['duyuru'] == '1')
	$duyuru .= ' checked="checked"';

	$duyuru .= '>'.$kp_yonetim_185.'</label>';

	/*************************/

	$duyuru .= '<label style="cursor: pointer;"><input type="radio" name="duyuru" value="0"';

	if ($portal_bloklar_ayar['duyuru'] == '0')
	$duyuru .= ' checked="checked"';

	$duyuru .= '>'.$kp_yonetim_186.'</label>';


	########################################################################
	########################################################################




	$java = '<script type="text/javascript">
	
	<!--//
			function Kapali(obj, a){
			  var e=document.getElementById(a);
			  if(!e)return true;
				e.style.display="block"
			  return true;
			}

			function Acik(obj, a){
			  var e=document.getElementById(a);
			  if(!e)return true;
				e.style.display="none"
			  return true;
			}

function sec()
{
	for (i=0; i < document.form1.length; i++)
	{
        if (document.form1.elements[i].value == 1)
            document.form1.elements[i].checked = true;

	}
}

function kaldir()
{
	for (i=0; i < document.form1.length; i++)
	{
        if (document.form1.elements[i].value == 0)
            document.form1.elements[i].checked = true;

	}
}


			function karakterfiltre(deger) {
			var yaz = new String();
			var numaralar = \'0123456789\';
			var chars = deger.value.split(\'\');
			for (i = 0; i < chars.length; i++) {
			if (numaralar.indexOf(chars[i]) != -1) yaz += chars[i];
			}
			if (deger.value != yaz) deger.value = yaz;
			}
			
			//-->
			
			</script>';
	
	$dongusuz = array(
	'{JAVA_SCRIPT}' => $java,
	'{BLOK_LIMIT_AYARLARI}' => $kp_yonetim_384,
	'{HABER_LIMIT}' => $kp_yonetim_214,
	'{RESIM_EKLEME}' => $kp_yonetim_283,
	'{RESIM_EKLEME_SONUCU}' => $resim_ekleme,
	'{HABER_LIMIT_SONUCU}' => $portal_ayarlar['haber_limit'],
	'{GALERI_LIMIT}' => $kp_dil_311,
	'{GALERI_LIMIT_SONUCU}' => $portal_ayarlar['galeri_limit'],
	'{SITELER_DAL}' => $kp_yonetim_351,
	'{SITELER_DAL_LIMIT_SONUCU}' => $portal_ayarlar['siteler_dal_limit'],
	'{HABER_DAL}' => $kp_yonetim_353,
	'{HABER_DAL_LIMIT_SONUCU}' => $portal_ayarlar['haber_dal_limit'],
	'{DOSYA_DAL}' => $kp_yonetim_355,
	'{DOSYA_DAL_LIMIT_SONUCU}' => $portal_ayarlar['dosya_dal_limit'],
	'{ANKET}' => $kp_yonetim_356,
	'{ANKET_LIMIT_SONUCU}' => $portal_ayarlar['anket_limit'],
	'{HABER_DALALT}' => $kp_yonetim_354,
	'{HABER_DALALT_LIMIT_SONUCU}' => $portal_ayarlar['haber_dalalt_limit'],
	'{KARAKTER_SINIRLAMASI}' => $kp_yonetim_387,
	'{KARAKTER_SINIRLAMASI_SONUCU}' => $portal_ayarlar['karakter_sinirlamasi'],
	'{SITELER}' => $kp_yonetim_352,
	'{SITELER_LIMIT_SONUCU}' => $portal_ayarlar['siteler_limit'],
	'{PORTAL_ARKA_TABLO_RENGI}' => $arka_tablo,
	'{PORTAL_SAYFALAMALAR}' => $kp_yonetim_350,
	'{PORTAL_GENEL_AYARLARI}' => $kp_yonetim_40,
	'{PORTAL_DILI}' => $kp_yonetim_23,
	'{PORTAL_DILI_SONUCU}' => $dil1,
	'{BLOK_SEKLI_SONUCU}' => $blok_sekli,
	'{BLOK_SEKLI}' => $kp_yonetim_372,
	'{PORTAL_TABLO}' => $kp_yonetim_121,
	'{GALERI_KB}' => $kp_yonetim_184,
	'{GALERI_KB_SONUCU}' => $kb,
	'{PORTAL_TABLO_SONUCU}' => $tablo,
	'{SON_MESAJLAR_SAYISI}' => $kp_yonetim_18,
	'{SON_MESAJLAR_SAYISI_SONUCU}' => $portal_ayarlar['son_mesajlar_sayisi'],
	'{EN_COK_MESAJ_ATANLAR}' => $kp_yonetim_378,
	'{EN_COK_MESAJ_ATANLAR_SONUCU}' => $portal_ayarlar['en_cok_mesaj_atanlar'],
	'{SON_UYELER}' => $kp_yonetim_379,
	'{SON_UYELER_SONUCU}' => $portal_ayarlar['son_uyeler'],
	'{BLOK_DOSYA_KATEGORILERI}' => $kp_yonetim_380,
	'{BLOK_DOSYA_KATEGORILERI_SONUCU}' => $portal_ayarlar['blok_dosya_kategorileri'],
	'{BLOK_HABER_KATEGORILERI}' => $kp_yonetim_381,
	'{BLOK_HABER_KATEGORILERI_SONUCU}' => $portal_ayarlar['blok_haber_kategorileri'],
	'{BLOK_GALERI_KATEGORILERI}' => $kp_yonetim_382,
	'{BLOK_GALERI_KATEGORILERI_SONUCU}' => $portal_ayarlar['blok_galeri_kategorileri'],
	'{BLOK_SITELER_KATEGORILERI}' => $kp_yonetim_383,
	'{BLOK_SITELER_KATEGORILERI_SONUCU}' => $portal_ayarlar['blok_siteler_kategorileri'],
	'{DOSYA_SAYFALAMA}' => $kp_yonetim_54,
	'{DOSYA_SAYFALAMA_SONUCU}' => $portal_ayarlar['dosya_sayfalama'],
	'{SITEMAPS}' => $kp_yonetim_71.'&nbsp;'.$kp_yonetim_72,
	'{SITEMAPS_SONUCU}' => $portal_ayarlar['sitemaps'],
	'{KULLANICI_IZNI}' => $kp_yonetim_55,
	'{KULLANICI_IZNI_SONUCU}' => $kullanici_izni_,
	'{HABERLER_KULLANICI_IZNI}' => $kp_yonetim_388,
	'{HABERLER_KULLANICI_IZNI_SONUCU}' => $haberlere_giris_izni,
	'{SON_MESAJLAR_HR}' => $kp_yonetim_46,
	'{SON_MESAJLAR_HR_SONUCU}' => $son_mesajlar_hr_,
	'{GONDER}' => $kp_yonetim_26,
	'{AYARLARI_KAYDET_SAYFASI_1}' => 'genel_ayarlar.php?kosul=ayarlari_kaydet',
	'{TEMIZLE}' => $kp_yonetim_27,
	'{SON_MESAJLARI_KAPAT}' => $kp_yonetim_285,
	'{SON_MESAJLARI_KAPAT_SONUCU}' => $son_mesajlar_sayisi2,
	'{ORTA_BLOK}' => $kp_yonetim_362,
	'{HABER_AC}' => $kp_yonetim_284,
	'{HABER_AC_SONUCU}' => $haber_ac,
	'{SAYFA_AYARLARI}' => $kp_yonetim_190,
	'{SITEHARITASI_SONUCU}' => $kp_yonetim_187,
	'{A1_ANKETLER_SONUCU}' => $kp_yonetim_188,
	'{A1_SITELER_SONUCU}' => $kp_yonetim_317,
	'{TAKVIM_SONUCU}' => $kp_yonetim_389,
	'{A1_DOSYALAR_SONUCU}' => $kp_yonetim_209,
	'{RESIMGALERISI_SONUCU}' => $kp_yonetim_189,
	'{HABER_SONUCU}' => $kp_yonetim_210,
	'{SITEHARITASI_SONUCU2}' => $siteharitasi_sayfasi,
	'{PORTAL_ARAMA}' => $kp_yonetim_315,
	'{PORTAL_ARAMA_SONUCU}' => $portal_arama,
	'{DUYURU}' => $kp_yonetim_316,
	'{DUYURU_SONUCU}' => $duyuru,
	'{A1_ANKETLER_SONUCU2}' => $anketler_sayfasi,
	'{A1_SITELER_SONUCU2}' => $siteler_sayfasi,
	'{TAKVIM_SONUCU2}' => $takvim_sayfasi,
	'{A1_DOSYALAR_SONUCU2}' => $dosyalar_sayfasi,
	'{RESIMGALERISI_SONUCU2}' => $galeri_sayfasi,
	'{HABER_SONUCU2}' => $haber_sayfasi,
	'{DAVETIYE}' => $kp_yonetim_150,
	'{DAVETIYE_SONUCU}' => $davetiye_,
	'{HEPSINI_ACIK_SEC}' => $kp_yonetim_263,
	'{HEPSINI_KAPALI_SEC}' => $kp_yonetim_264,
	'{SAYFA_AYARLARI2}' => $kp_yonetim_213
	);



	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'yonetim/temalar/'.$temadizini.'/genel_ayarlar.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));
	$ornek1->dongusuz($dongusuz);
	eval(TEMA_UYGULA);

?>
