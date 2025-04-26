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


	define('DOSYA_HABERLER',true);
	$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='3' OR kip='5' OR kip='6'";
	if (!defined('DOSYA_AYAR')) include '../ayar.php';
	if (!defined('DOSYA_GERECLER')) include '../phpkf-bilesenler/gerecler.php';
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_PORTAL_AYARLAR')) include 'portal_ayarlar.php';
	if (!defined('DOSYA_SEC')) include 'sec.php';
	if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';
	if (!defined('DOSYA_SEO')) include '../phpkf-bilesenler/seo.php';
	if (!defined('DOSYA_HATA')) include 'hata.php';





if ( (isset($_GET['id'])) AND ($_GET['id'] != '') )
{
    $_GET['id'] = @zkTemizle($_GET['id']);
    $_GET['id'] = @zkTemizle4($_GET['id']);
    $_GET['id'] = @str_replace(array('-','x','.'), '', $_GET['id']);
    if (is_numeric($_GET['id']) == false) $_GET['id'] = 0;
    if ($_GET['id'] < 0) $_GET['id'] = 0;
}


if ( (isset($_GET['etiket'])) AND ($_GET['etiket'] != '') )
{
	$_GET['etiket'] = @zkTemizle4($_GET['etiket']);
	$_GET['etiket'] = @zkTemizle($_GET['etiket']);
	$_GET['etiket'] = mb_substr($_GET['etiket'], 0, 20, 'utf-8');
}




	$sayfa_adi = 'Haberler Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/haberler.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));


	$ornek1->dongusuz(array(
	'{HABER_EKLE_LINK}' => 'haberler.php?kosul=haber_ekle',
	'{ALT_DIZIN}' => $alt_dizin,
	'{UST_DIZIN}' => $ust_dizin));

	
	
	if ($kosul == 'haber_ekle')
	{

	
	if ($portal_bloklar_ayar['haber_sayfasi'] == 1)
	{
	
	$ornek1->kosul('3', array('' => ''), true);
	$ornek1->kosul('dal', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('1', array('' => ''), false);
	
	
	if (isset($_GET['haber_duzenle']))
	{
	$sayfa_adi = 'Haber Düzenleme Sayfası';

	if ($portal_bloklar_ayar['haber_sayfasi'] == 1)
	{

	// HABERİ DÜZELTMEYE ÇALIŞAN KİŞİ YÖNETİCİ DEĞİLSE UYARILIYOR //
	if ($kullanici_kim['yetki'] != 1)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_279,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	// HABERİ DÜZELTMEYE ÇALIŞAN KİŞİ YÖNETİCİ DEĞİLSE UYARILIYOR - SONU //

/*
	$sayfa_adi = 'Haber Düzenleme Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';
*/

	// gelen id nümerik'mi bakılıyor.
	if (is_numeric($_GET['hn']) == true) $_GET['hn'] = @zkTemizle($_GET['hn']);
	else $_GET['hn'] = 0;
	
	// bilgiler çekiliyor.
	$sorgu1113 = "select * from $tablo_portal_haberler where id='$_GET[hn]'";
	$sorgu1113_sonuc = $vt->query($sorgu1113) or die ($vt->hata_ver());
	$vtsonuc3 = $vt->fetch_assoc($sorgu1113_sonuc);
	
	
	$Sorgu = "SELECT * FROM $tablo_portal_haberdal";
	$dal_sonuc = @$vt->query($Sorgu) or die ($vt->hata_ver());

	$dal_secenek ='';
	
	while ($dallar = $vt->fetch_array($dal_sonuc)):


	$dal_secenek .='<option value="'.$dallar['id'].'"'; 
	if ($dallar['id'] == $vtsonuc3['dal_id']) $dal_secenek .=' selected="selected"'; 
	$dal_secenek .='>'.$dallar['dal'].''; 
	$dal_secenek .='</option>';

	endwhile;
	
	###############################################
	
	$yorum_sonucu1 = '<option value="1"';
	
	if ($vtsonuc3['yorum'] == 1) 
	$yorum_sonucu1 .= ' selected="selected"';

	$yorum_sonucu1 .= '>'.$kp_dil_371.'</option>';

	$yorum_sonucu1 .= '<option value="0"';

	if ($vtsonuc3['yorum'] == 0) 
	$yorum_sonucu1 .= ' selected="selected"';

	$yorum_sonucu1 .= '>'.$kp_dil_372.'</option>';


	$dongusuz = array(
	'{DAL_SECENEK}' => $dal_secenek,
	'{KATEGORI_SECIN}' => $kp_dil_271,
	'{HTML}' => $kp_dil_419,
	'{BBCODE}' => $kp_dil_420,
	'{DUZ_METIN_DUZENLEYICI}' => $kp_dil_417,
	'{YORUM}' => $kp_dil_370,
	'{YORUM_SONUC}' => $yorum_sonucu1,
	'{HABER_BASLIK}' => $kp_dil_345,
	'{ETIKETLER}' => $kp_dil_346,
	'{LUTFEN}' => $kp_dil_347,
	'{ORNEK}' => $kp_dil_348,
	'{ICERIK}' => $kp_dil_349,
	'{BBCODE_YARDIM}' => $kp_dil_350,
	'{GONDER}' => $kp_dil_341,
	'{TEMIZLE}' => $kp_dil_342,
	'{YENI_HABER_EKLE}' => $kp_dil_354,
	'{BUYUK}' => $kp_yonetim_117,
	'{ID}' => $vtsonuc3['id'],
	'{YAZI_RENGI}' => $kp_yonetim_67, 
	'{YAZI_BOYUTU}' => $kp_yonetim_68, 
	'{NORMAL}' => $kp_yonetim_69, 
	'{VARSAYILAN}' => $kp_yonetim_70, 
	'{HABERI_EKLE}' => 'haberler.php?kosul=haber_kaydet', 
	'{PORTAL_ARKA_TABLO_RENGI}' => $arka_tablo,
	'{DUZENLE}' => '1',
	'{BASLIK}' => $vtsonuc3['baslik'],
	'{ETIKET}' => $vtsonuc3['etiket'],
	'{FORM_ICERIK}' => $vtsonuc3['icerik']);



	// tema uygulanıyor.
	$ornek1->dongusuz($dongusuz);
	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	}


	exit();
	}


	$sayfa_adi = 'Haber Ekleme Sayfası';

	// HABER EKLEMEYE ÇALIŞAN KİŞİ ÜYE DEĞİLSE UYARILIYOR //
	if (empty($kullanici_kim['id']))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './giris.php?git=giris',
	'{ILETI}' => $kp_dil_308,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__4,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	// HABER EKLEMEYE ÇALIŞAN KİŞİ ÜYE DEĞİLSE UYARILIYOR - SONU //



/*
	// sayfa ayarları yapılıyor.
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';
*/

	$Sorgu1 = "select id,dal from $tablo_portal_haberdal";
	$Sorgu_kontrol1 = $vt->query($Sorgu1) or die ($vt->hata_ver());


	$dal_secenek = '';

	while ($Sorgu_sonuc1 = $vt->fetch_assoc($Sorgu_kontrol1))
	{
	$dal_secenek .= '<option value="'.$Sorgu_sonuc1['id'].'">'.$Sorgu_sonuc1['dal'].'</option>';
	}

	$yorum_sonucu1 = '<option value="1">'.$kp_dil_371.'</option>';
	$yorum_sonucu1 .= '<option value="0">'.$kp_dil_372.'</option>';



	$dongu_yok = array(
	'{KATEGORI_SECIN}' => $kp_dil_271,
	'{HTML}' => $kp_dil_419,
	'{BBCODE}' => $kp_dil_420,
	'{DUZ_METIN_DUZENLEYICI}' => $kp_dil_417,
	'{YORUM}' => $kp_dil_370,
	'{YORUM_SONUC}' => $yorum_sonucu1,
	'{YENI_HABER_EKLE}' => $kp_dil_344,
	'{HABER_BASLIK}' => $kp_dil_345,
	'{ETIKETLER}' => $kp_dil_346,
	'{LUTFEN}' => $kp_dil_347,
	'{ORNEK}' => $kp_dil_348,
	'{ICERIK}' => $kp_dil_349,
	'{BBCODE_YARDIM}' => $kp_dil_350,
	'{GONDER}' => $kp_dil_341,
	'{TEMIZLE}' => $kp_dil_342,
	'{ID}' => '',
	'{HABERI_EKLE}' => 'haberler.php?kosul=haber_kaydet',
	'{BUYUK}' => $kp_yonetim_117,
	'{YAZI_RENGI}' => $kp_yonetim_67, 
	'{YAZI_BOYUTU}' => $kp_yonetim_68, 
	'{NORMAL}' => $kp_yonetim_69, 
	'{VARSAYILAN}' => $kp_yonetim_70, 
	'{ARKA_TABLO}' => $arka_tablo,
	'{DAL_SECENEK}' => $dal_secenek,
	'{DUZENLE}' => '0',
	'{BASLIK}' => '',
	'{ETIKET}' => '',
	'{FORM_ICERIK}' => '');


	// tema uygulanıyor.
	$ornek1->dongusuz($dongu_yok);
	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	}
	else
	{
	// haber sayfası kapalıysa uyarı veriliyor.
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}


	exit();
	}

	if ($kosul == 'haber_kaydet')
	{

	$sayfa_adi = 'Haber Ekleme Sayfası';

	if ($portal_bloklar_ayar['haber_sayfasi'] == 1)
	{

	// YENİ DOSYA VERİTABANINA EKLENİYOR //
	if (isset($_POST['bbcode_kullan']))
	{
        $bbcode_kullan = 1;

        // img ve url etiketleriyle çerez çalma girişimi engelleniyor //
        $_POST['mesaj_icerik'] = preg_replace('|\[img\]javascript|si','.',$_POST['mesaj_icerik']);
        $_POST['mesaj_icerik'] = preg_replace('|\[img\] javascript|si','.',$_POST['mesaj_icerik']);
        $_POST['mesaj_icerik'] = preg_replace('|\[url=javascript|si','.',$_POST['mesaj_icerik']);
        $_POST['mesaj_icerik'] = preg_replace('|\[url= javascript|si','.',$_POST['mesaj_icerik']);
	}

	else $bbcode_kullan = 0;
	

	// HABER EKLEMEYE ÇALIŞAN KİŞİ ÜYE DEĞİLSE UYARILIYOR //
	if (empty($kullanici_kim['id']))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './giris.php?git=giris',
	'{ILETI}' => $kp_dil_308,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__4,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	// HABER EKLEMEYE ÇALIŞAN KİŞİ ÜYE DEĞİLSE UYARILIYOR - SONU //

	
	
	if ((isset($_POST['dal_id'])) AND (is_numeric($_POST['dal_id']) == true)) $_POST['dal_id'] = @zkTemizle($_POST['dal_id']);
	else $_POST['dal_id'] = 0;
	
	$sorgu1ww = "select id from $tablo_portal_haberdal where id='$_POST[dal_id]'";
	$sor = $vt->query($sorgu1ww) or die ($vt->hata_ver());
	
	if (!$vt->num_rows($sor))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_535,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	/* HABER BAŞLIK, ETİKET, AÇIKLAMA BEKLENEN KARAKTERDEN FAZLAYSA VEYA AZ İSE UYARI VERİLİYOR */
	if ((strlen($_POST['etiket']) < 3) OR (strlen($_POST['mesaj_icerik']) < 10) OR (strlen($_POST['mesaj_baslik']) < 3) OR (strlen(utf8_decode($_POST['mesaj_baslik'])) > 50))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'haberler.php?kosul=haber_ekle',
	'{ILETI}' => $kp_dil_351,
	'{EK_YAZI}' => $kp_dil_352,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	/* HABER BAŞLIK, ETİKET, AÇIKLAMA BEKLENEN KARAKTERDEN FAZLAYSA VEYA AZ İSE UYARI VERİLİYOR - SONU */


	$ornek1->kosul('1', array('' => ''), false);
	$ornek1->kosul('dal', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('3', array('' => ''), false);
	

/*
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';
*/

	$bul = array("'",'"','/','\\',' ','^','%','&','{','}','(',')','[',']','=','-','_','#','$','+','!','?',';',':','.','>','<','|','@','~','™','©','º','®','ª','¦','*','½');
	$cvr = array('','','','','','','','','','','','','','','','','','','','','','','','',",",'','','','','','','','','','','','','');
	
	 $_POST['etiket'] = str_replace($bul, $cvr, $_POST['etiket']);

	// magic_quotes_gpc açıksa //
    if (get_magic_quotes_gpc())
    {
        $_POST['mesaj_baslik'] = @ileti_yolla(stripslashes($_POST['mesaj_baslik']),1);
        $_POST['mesaj_icerik'] = @ileti_yolla(stripslashes($_POST['mesaj_icerik']),2);
        $_POST['etiket'] = @ileti_yolla(stripslashes($_POST['etiket']),1);
        $yorum_bilgisi = @ileti_yolla(stripslashes($_POST['yorum']),2);
    }

    // magic_quotes_gpc kapalıysa //
    else
    {
        $_POST['mesaj_baslik'] = @ileti_yolla($_POST['mesaj_baslik'],1);
        $_POST['mesaj_icerik'] = @ileti_yolla($_POST['mesaj_icerik'],2);
        $_POST['etiket'] = @ileti_yolla($_POST['etiket'],1);
        $yorum_bilgisi = @ileti_yolla($_POST['yorum'],2);
    }
	
	
	$_POST['hd'] = @zkTemizle2($_POST['hd']);
	
	$ip_adresi_bilgisi = @zkTemizle($_SERVER['REMOTE_ADDR']);


	// yetkiye göre onay durumu ayarlanıyor.
	if ($kullanici_kim['yetki'] == 1) $onay_durum = '1';
	else $onay_durum = '0';


	// değişkendeki veriler virgülden ayrılıp dizi değişkene aktarılıyor //
	
	
	
	$depo_bosluk = explode(',', $_POST['etiket']);

	$depo_sayi = count($depo_bosluk);

	$etiketler_sonucu = '';


	for ($a=0; $a < $depo_sayi; $a++)
	{
	$depo_bosluk[$a] = trim($depo_bosluk[$a]);

	// 3 karakterden kısa dizi elemanları diziden atılıyor	//
	if (strlen($depo_bosluk[$a]) > 2)
	$etiketler_sonucu .= $depo_bosluk[$a].',';
	}

	$etiketler_sonucu = mb_substr($etiketler_sonucu, 0, -1, 'utf-8');


	// tarih bilgisi alınıyor.
	$tarih = time();
	
	
	
	if ($_POST['duzenle'] == 1)
	{
	
	// HABERİ DEĞİŞTİRMEYE ÇALIŞAN KİŞİ YÖNETİCİ DEĞİLSE UYARILIYOR //
	if ($kullanici_kim['yetki'] != 1)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_279,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	// HABERİ DEĞİŞTİRMEYE ÇALIŞAN KİŞİ YÖNETİCİ DEĞİLSE UYARILIYOR - SONU //
	
	// veriler kaydediliyor.
	$vtsorgu = "UPDATE $tablo_portal_haberler SET dal_id='$_POST[dal_id]', baslik='$_POST[mesaj_baslik]', icerik='$_POST[mesaj_icerik]', etiket='$etiketler_sonucu', yorum='$yorum_bilgisi' WHERE id='$_POST[id]' LIMIT 1";
	$vtsonuc5 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>');
	}
	else
	{
	// veriler kaydediliyor.
	$vtsorgu = "INSERT INTO $tablo_portal_haberler (dal_id, tarih, baslik, icerik, yazan, onay, ip_adresi, bbcode_kullan, etiket, yorum)";
	$vtsorgu .= "VALUES ('$_POST[dal_id]','$tarih','$_POST[mesaj_baslik]','$_POST[mesaj_icerik]','$kullanici_kim[kullanici_adi]','$onay_durum', '$ip_adresi_bilgisi', '1','$etiketler_sonucu','$yorum_bilgisi')";
	$vtsonuc5 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>');
	}


	// yetkiye göre bilgi iletisi yazdırılıyor.
	if ($kullanici_kim['yetki'] != 1)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => 'haberler.php?hd='.$_POST['dal_id'],
	'{ILETI}' => $kp_dil_288,
	'{EK_YAZI}' => $kp_dil_289,
	'{YONLENDIRME}' => $kp_dil_290 ,
	'{YONLENDIRME2}' => $ileti__2);
	}
	elseif ($_POST['duzenle'] != 1)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => 'haberler.php?hd='.$_POST['dal_id'],
	'{ILETI}' => $kp_dil_353,
	'{EK_YAZI}' => '<meta target="_top" http-equiv="Refresh" content="3; url=./'.'haberler.php?hd='.$_POST['dal_id'].'">',
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);
	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => 'haberler.php?hn='.$_POST['id'],
	'{ILETI}' => $kp_dil_399,
	'{EK_YAZI}' => '<meta target="_top" http-equiv="Refresh" content="3; url=./'.'haberler.php?hn='.$_POST['id'].'">',
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);
	}

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));

	}


	else
	{
	// haber sayfası kapalıysa uyarı veriliyor.
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}


	exit();
	}


	// HABER SİLİNİYOR //
	if ($kosul == 'haber_sil')
	{

	$sayfa_adi = 'Haber Silme Sayfası';

	if ($portal_bloklar_ayar['haber_sayfasi'] == 1)
	{

	// HABERİ SİLMEYE ÇALIŞAN KİŞİ YÖNETİCİ DEĞİLSE UYARILIYOR //
	if ($kullanici_kim['yetki'] != 1)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_279,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	// HABERİ SİLMEYE ÇALIŞAN KİŞİ YÖNETİCİ DEĞİLSE UYARILIYOR - SONU //

	// Sil Anahtarı Kontrol Ediliyor //
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_487,
	'{EK_YAZI}' => $kp_dil_322,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	else
	{	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());
	}
	
	// Sil Anahtarı Kontrol Ediliyor - Sonu //

	// gelen id nümerik'mi bakılıyor.
	if (is_numeric($_GET['hn']) == true) $_GET['hn'] = @zkTemizle($_GET['hn']);
	else $_GET['hn'] = 0;

	$sorgu = "SELECT * FROM $tablo_portal_haberler WHERE id='$_GET[hn]' LIMIT 1";
	$sorgu_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
	$vtsonuc = $vt->fetch_assoc($sorgu_sonuc);


	// BÖYLE BİR HABER YOKSA UYARILIYOR //
	if (!$vt->num_rows($sorgu_sonuc))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_355,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	// BÖYLE BİR HABER YOKSA UYARILIYOR - SONU //


	// HABER VARSA SİLİNİYOR //

	$sil_sorgu = "DELETE FROM $tablo_portal_haberler WHERE id='$_GET[hn]' LIMIT 1";
	$sil_sorgu_sonuc = $vt->query($sil_sorgu) or die ($vt->hata_ver());

	// YORUM VARSA SİLİNİYOR //
	$sil_sorgu1 = "DELETE FROM $tablo_portal_haberyorum WHERE haber_id='$_GET[hn]'";
	$sil_sorgu_sonuc1 = $vt->query($sil_sorgu1) or die ($vt->hata_ver());


	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_356,
	'{EK_YAZI}' => '<meta target="_top" http-equiv="Refresh" content="2; url=./'.'haberler.php">',
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	}

	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	exit();

	}
	// HABER VARSA SİLİNİYOR - SONU //



	if ($kosul == 'haber_yorum_ekle')
	{

	$sayfa_adi = 'Yorum Kaydetme Sayfası';

	if ($portal_bloklar_ayar['haber_sayfasi'] == 1)
	{

	// gelen id nümerik'mi bakılıyor.
	if ( (isset($_POST['id'])) AND (is_numeric($_POST['id']) == true) ) $_POST['id'] = @zkTemizle($_POST['id']);
	else $_POST['id'] = 0;

	
	$tarih = time();
	
	// son ileti süresi
	if ( ($kullanici_kim['son_ileti']) > ($tarih - $ayarlar['yorum_sure']) )
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_dil_107,
	'{ADRES}' => 'haberler.php?hn='.$_POST['id'],
	'{ILETI}' => $kp_dil_194,
	'{EK_YAZI}' => ''.$ayarlar['yorum_sure'].' '.$kp_dil_195.'.',
	'{YONLENDIRME}' => '',
	'{YONLENDIRME2}' => $kp_dil_121);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	
	$sorgu__1 = "SELECT yorum FROM $tablo_portal_haberler WHERE id='$_POST[id]' LIMIT 1";
	$sorgu_sonuc__1 = $vt->query($sorgu__1) or die ($vt->hata_ver());
	$vtsonuc__1 = $vt->fetch_assoc($sorgu_sonuc__1);
	
	if (!$vt->num_rows($sorgu_sonuc__1))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_336,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	// haber yorumlara kapalıysa uyarı veriliyor.
	if ($vtsonuc__1['yorum'] == 0)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'haberler.php?hn='.$_POST['id'],
	'{ILETI}' => $kp_dil_373,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}



	// YORUM EKLEMEYE ÇALIŞAN KİŞİ ÜYE DEĞİLSE UYARILIYOR //
	if (empty($kullanici_kim['id']))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './giris.php?git=giris',
	'{ILETI}' => $kp_dil_308,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__4,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	// YORUM EKLEMEYE ÇALIŞAN KİŞİ ÜYE DEĞİLSE UYARILIYOR - SONU //


	// magic_quotes_gpc açıksa //
	if (get_magic_quotes_gpc())
	$_POST['icerik'] = @zkTemizle2(stripslashes($_POST['icerik']));

	// magic_quotes_gpc kapalıysa //
	else $_POST['icerik'] = @zkTemizle2($_POST['icerik']);
	
	/* YORUM İÇERİĞİ 3 KARAKTERDEN AZ İSE UYARI VERİLİYOR */
	if (!isset($_POST['icerik']))
	{
	echo '<script type="text/javascript">
	<!--
	location.href="haberler.php";
	//-->
	</script>';
	exit();
	}

	elseif (strlen($_POST['icerik']) < 3)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'haberler.php?hn='.$_POST['id'],
	'{ILETI}' => $kp_dil_357,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	/* YORUM İÇERİĞİ 3 KARAKTERDEN AZ İSE UYARI VERİLİYOR - SONU */
	

	$ornek1->kosul('1', array('' => ''), false);
	$ornek1->kosul('dal', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('3', array('' => ''), false);

/*
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';
*/


	$tarih = time();
	
			
	//  SANSÜRLENECEK SÖZCÜKLER ALINIYOR    //

    $vtsorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='sozcukler' LIMIT 1";
    $yasak_sonuc = $vt->query($vtsorgu);
    $yasak_sozcukler = $vt->fetch_row($yasak_sonuc);
    $ysk_sozd = explode("\r\n", $yasak_sozcukler[0]);


    //  SANSÜR CÜMLESİ ALINIYOR //

    $vtsorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='cumle' LIMIT 1";
    $yasak_sonuc = $vt->query($vtsorgu);
    $yasak_cumle = $vt->fetch_row($yasak_sonuc);


    //  SANSÜR UYGULANIYOR  //

    if ($ysk_sozd[0] != '')
    {
        if (function_exists('str_ireplace'))
        {
            $_POST['icerik'] = str_ireplace($ysk_sozd, $yasak_cumle[0], $_POST['icerik']);
            $_POST['icerik'] = str_ireplace($ysk_sozd, $yasak_cumle[0], $_POST['icerik']);
        }

        else
        {
            $_POST['icerik'] = str_replace($ysk_sozd, $yasak_cumle[0], $_POST['icerik']);
            $_POST['icerik'] = str_replace($ysk_sozd, $yasak_cumle[0], $_POST['icerik']);
        }
    }

	// veriler kaydediliyor.
	$vtsorgu = "INSERT INTO $tablo_portal_haberyorum (tarih, haber_id,  icerik, yazan)";

	$vtsorgu .= "VALUES ('$tarih','$_POST[id]','$_POST[icerik]','$kullanici_kim[kullanici_adi]')";
	$vtsonuc5 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>');

	$son_ieti = "UPDATE $tablo_kullanicilar SET son_ileti='$tarih' WHERE id='$kullanici_kim[id]'";
	
	$vtsonuc1 = $vt->query($son_ieti) or die ($vt->hata_ver());
	

	// bilgi iletisi yazdırılıyor.
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => 'haberler.php?hn='.$_POST['id'],
	'{ILETI}' => $kp_dil_358,
	'{EK_YAZI}' => '<meta target="_top" http-equiv="Refresh" content="3; url=./'.'haberler.php?hn='.$_POST['id'].'">',
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	}

	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	exit();
	}

	if ($kosul == 'haber_yorum_sil')
	{

	$sayfa_adi = 'Yorum Silme Sayfası';

	if ($portal_bloklar_ayar['haber_sayfasi'] == 1)
	{

	// YORUMU SİLMEYE ÇALIŞAN KİŞİ YÖNETİCİ DEĞİLSE UYARILIYOR //
	if ($kullanici_kim['yetki'] != 1)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_279,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	// YORUMU SİLMEYE ÇALIŞAN KİŞİ YÖNETİCİ DEĞİLSE UYARILIYOR - SONU //
	
	if (is_numeric($_GET['hn']) == true) $_GET['hn'] = @zkTemizle($_GET['hn']);
	else $_GET['hn'] = 0;

	
	// Sil Anahtarı Kontrol Ediliyor //
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'haberler.php?hn='.$_GET['no'],
	'{ILETI}' => $kp_dil_487,
	'{EK_YAZI}' => $kp_dil_322,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	else
	{
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());
	}
	
	// Sil Anahtarı Kontrol Ediliyor - Sonu //
	
	
	$sorgu = "SELECT id FROM $tablo_portal_haberyorum WHERE id='$_GET[hn]' LIMIT 1";
	$sorgu_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());

	// sorgu 0 değeri döndürürse uyarı veriliyor.
	if (!$vt->num_rows($sorgu_sonuc))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'haberler.php?hn='.$_GET['no'],
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_364,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	// yorum siliniyor.
	$sil_sorgu = "DELETE FROM $tablo_portal_haberyorum WHERE id='$_GET[hn]' LIMIT 1";
	$sil_sorgu_sonuc = $vt->query($sil_sorgu) or die ($vt->hata_ver());


	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'haberler.php?hn='.$_GET['no'],
	'{ILETI}' => $kp_dil_365,
	'{EK_YAZI}' => '<meta target="_top" http-equiv="Refresh" content="3; url=./haberler.php?hn='.$_GET['no'].'">',
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	}
	else
	{

	// haberler sayfası kapalıysa uyarı veriliyor.
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	exit();
	}

	if (isset($_GET['hd']))
	{
	
	// gelen id nümerik'mi bakılıyor.
	if (is_numeric($_GET['hd']) == false) 
	{
	// haber sayfası açıkmı kapalımı bakılıyor.
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_473,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	else
	{
	$_GET['hd'] = @zkTemizle($_GET['hd']);
	}


	// SEO ADRESİNİN DOĞRULUĞU KONTROL EDİLİYOR YANLIŞSA DOĞRU ADRESE YÖNLENDİRİLİYOR //
	$sorgu1111 = "select id,dal from $tablo_portal_haberdal where id='$_GET[hd]' LIMIT 1";
	$sorgu1111_sonuc = $vt->query($sorgu1111) or die ($vt->hata_ver());
	$haber_satir = $vt->fetch_assoc($sorgu1111_sonuc);
	$dogru_adres = seo($haber_satir['dal']);

	if ( (isset($_SERVER['REQUEST_URI'])) AND ($_SERVER['REQUEST_URI'] != '') AND (!@preg_match("/-$dogru_adres.html/i", $_SERVER['REQUEST_URI'])) AND (!@preg_match('/haberler\.php\?/i', $_SERVER['REQUEST_URI'])) )
	{
		$yonlendir = linkverPortal('haberler.php?hd='.$haber_satir['id'], $haber_satir['dal']);
		echo '<meta http-equiv="Refresh" content="0;url='.$yonlendir.'">';
		exit();
	}
	
	
	if ($portal_bloklar_ayar['haber_sayfasi'] == 1)
	{

	$sayfa_adi = 'Haberler Sayfası';

	$ornek1->kosul('1', array('' => ''), true);
	$ornek1->kosul('dal', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('3', array('' => ''), false);
	

/*
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';
*/

	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;

	// etiket'e göre veritabanından haberler çekiliyor.
	if (isset($_GET['etiket']))
	{
	$limit = '15'; 
	$kosullar = "where onay='1' AND etiket like '%$_GET[etiket]%' order by tarih desc"; 
	$tabloadi = $tablo_portal_haberler; 

	$vtsorgu = $vt->query("SELECT COUNT(* ) FROM $tabloadi $kosullar" ); 
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}
	$sorgu1111 = "select * from $tabloadi $kosullar LIMIT $baslangic,$limit";
	$sorgu1111_sonuc = $vt->query($sorgu1111) or die ($vt->hata_ver());
	$toplam_haber = $vt->num_rows($sorgu1111_sonuc);
	}
	else
	{
	$limit = $portal_ayarlar['haber_dal_limit']; 
	$kosullar = "where onay='1' AND dal_id='$_GET[hd]' order by tarih desc"; 
	$tabloadi = $tablo_portal_haberler; 

	$vtsorgu = $vt->query("SELECT COUNT(* ) FROM $tabloadi $kosullar" ); 
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}
	$sorgu1111 = "select * from $tabloadi $kosullar LIMIT $baslangic,$limit";
	$sorgu1111_sonuc = $vt->query($sorgu1111) or die ($vt->hata_ver());
	$toplam_haber = $vt->num_rows($sorgu1111_sonuc);
	}

	$sorgu11112 = "select id,baslik from $tablo_portal_haberler where onay='1' AND dal_id='$_GET[hd]' order by tarih desc limit 1";
	$sorgu11112_sonuc = $vt->query($sorgu11112) or die ($vt->hata_ver());
	$vtsonuc222 = $vt->fetch_assoc($sorgu11112_sonuc);
	
	$sorgu1ww = "select id,dal from $tablo_portal_haberdal where id='$_GET[hd]'";
	$sorgu1ww_sonuc = $vt->query($sorgu1ww) or die ($vt->hata_ver());
	$vtsonuc22ww = $vt->fetch_assoc($sorgu1ww_sonuc);



	// veriler döngüye sokuluyor.
	while($vtsonuc = $vt->fetch_assoc($sorgu1111_sonuc))
	{

	$donduruver[] = array(
	'{SON_ILETI_RENGI}' => $sonileti_rengi,
	'{HABER_LINK}' => '<a href="'.linkverPortal('haberler.php?hn='.$vtsonuc['id'], $vtsonuc['baslik']).'"><b>'.$vtsonuc['baslik'].'</b></a>',
	'{ID}' => $vtsonuc['id'],
	'{YAZAN2}' => '<a href="'.linkver('../profil.php?kim='.$vtsonuc['yazan'],$vtsonuc['yazan']).'">'.$vtsonuc['yazan'].'</a>',
	'{OKUNMA2}' =>$vtsonuc['okunma_sayisi'],
	'{ACILIS_TARİH}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $vtsonuc['tarih']));

	}

	// etiket değişkeni dolumu boşmu bakılıyor.
	if (isset($_GET['etiket']))
	{
	$ornek1->dongusuz(array('{HABERLER}' => $_GET['etiket'].' '.$kp_dil_366));
	}
	else
	{
	$ornek1->dongusuz(array('{HABERLER}' => $kp_dil_325));
	}
	if (isset($_GET['etiket']))
	{
	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,'haberler.php?','etiket='.$_GET['etiket'].'',$adresdeger='');
	}
	else
	{
	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,'haberler.php?','&hd='.$_GET['hd'],$vtsonuc22ww['dal'].'',$adresdeger='');
	}
	
	$dongusuz1a1 = array(
	'{SAYFALAMA}' => $tablo,
	'{HABER}' => $kp_dil_326,
	'{EKLENME_TARIHI}' => $kp_dil_327,
	'{YAZAN}' => $kp_dil_328,
	'{OKUNMA}' => $kp_dil_329,
	'{HABER_EKLE}' => $kp_dil_330,
	'{BURADA_TOPLAM}' => $kp_dil_331,
	'{HABER_VAR}' => $kp_dil_332,
	'{EN_SON_EKLENEN_HABER}' => $kp_dil_334,
	'{TOPLAM_HABER}' => $toplam_haber,
	'{BASLIK2}' => $vtsonuc222['baslik'],
	'{ADRES2}' => linkverPortal('haberler.php?hn='.$vtsonuc222['id'],$vtsonuc222['baslik']),
	'{PORTAL_ARKA_TABLO_RENGI}' => $arka_tablo
	);



	// etiket değişkenine göre bilgi yazdırılıyor.
	if (!isset($donduruver)) 
	{

	if (isset($_GET['etiket']))
	{
	$donduruver[] = array(
	'{SON_ILETI_RENGI}' => '',
	'{ACILIS_TARİH}' => '&nbsp;',
	'{HABER_LINK}' => '&nbsp;'.$kp_dil_367.'<br>',
	'{ID}' => '',
	'{YAZAN2}' => '&nbsp;',
	'{OKUNMA2}' => '&nbsp;');
	}
	else
	{		
	$donduruver[] = array(
	'{SON_ILETI_RENGI}' => '',
	'{ACILIS_TARİH}' => '&nbsp;',
	'{HABER_LINK}' => '&nbsp;'.$kp_dil_335.'<br>',
	'{ID}' => '',
	'{YAZAN2}' => '&nbsp;',
	'{OKUNMA2}' => '&nbsp;');
	}		
	}



	// tema uygulanıyor.
	$ornek1->dongusuz($dongusuz1a1);
	$ornek1->tekli_dongu('1',$donduruver);
	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	}

	else
	{
	// haber sayfası açıkmı kapalımı bakılıyor.
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	exit();
	}

	if (isset($_GET['etiket']))
	{
	

	if ($portal_bloklar_ayar['haber_sayfasi'] == 1)
	{

	$sayfa_adi = 'Haberler Sayfası';

	$ornek1->kosul('1', array('' => ''), true);
	$ornek1->kosul('dal', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('3', array('' => ''), false);

/*
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';
*/

	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;
	
	$limit = $portal_ayarlar['haber_dalalt_limit']; 
	$kosullar = "where onay='1' AND etiket like '%$_GET[etiket]%' order by tarih desc"; 
	$tabloadi = $tablo_portal_haberler; 

	$vtsorgu = $vt->query("SELECT COUNT(* ) FROM $tabloadi $kosullar" ); 
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}
	$sor = "select * from $tabloadi $kosullar LIMIT $baslangic,$limit";
	$sor_sonuc = $vt->query($sor) or die ($vt->hata_ver());
	$sorsonuc = $vt->fetch_assoc($sor_sonuc);
	
	$sorgu1111 = "select * from $tabloadi $kosullar LIMIT $baslangic,$limit";
	$sorgu1111_sonuc = $vt->query($sorgu1111) or die ($vt->hata_ver());
	$toplam_haber = $vt->num_rows($sorgu1111_sonuc);
	

	$sorgu11112 = "select id,baslik from $tablo_portal_haberler where onay='1' AND dal_id='$sorsonuc[dal_id]' order by tarih desc limit 1";
	$sorgu11112_sonuc = $vt->query($sorgu11112) or die ($vt->hata_ver());
	$vtsonuc222 = $vt->fetch_assoc($sorgu11112_sonuc);



	// veriler döngüye sokuluyor.
	while($vtsonuc = $vt->fetch_assoc($sorgu1111_sonuc))
	{

	$donduruver[] = array(
	'{SON_ILETI_RENGI}' => $sonileti_rengi,
	'{HABER_LINK}' => '<a href="'.linkverPortal('haberler.php?hn='.$vtsonuc['id'],$vtsonuc['baslik']).'"><b>'.$vtsonuc['baslik'].'</b></a>',
	'{ID}' => $vtsonuc['id'],
	'{YAZAN2}' =>'<a href="'.linkver('../profil.php?kim='.$vtsonuc['yazan'],$vtsonuc['yazan']).'">'.$vtsonuc['yazan'].'</a>',
	'{OKUNMA2}' =>$vtsonuc['okunma_sayisi'],
	'{ACILIS_TARİH}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $vtsonuc['tarih']));

	}


	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,'haberler.php?','&etiket='.$_GET['etiket'].'',$adresdeger='');
	
	
	
	$dongusuz = array(
	'{HABERLER}' => $_GET['etiket'].' '.$kp_dil_366,
	'{SAYFALAMA}' => $tablo,
	'{HABER}' => $kp_dil_326,
	'{EKLENME_TARIHI}' => $kp_dil_327,
	'{YAZAN}' => $kp_dil_328,
	'{OKUNMA}' => $kp_dil_329,
	'{HABER_EKLE}' => $kp_dil_330,
	'{BURADA_TOPLAM}' => $kp_dil_331,
	'{HABER_VAR}' => $kp_dil_332,
	'{EN_SON_EKLENEN_HABER}' => $kp_dil_334,
	'{TOPLAM_HABER}' => $toplam_haber,
	'{BASLIK2}' => $vtsonuc222['baslik'],
	'{ADRES2}' => linkverPortal('haberler.php?hn='.$vtsonuc222['id'],$vtsonuc222['baslik']),
	'{PORTAL_ARKA_TABLO_RENGI}' => $arka_tablo
	);



	// etiket değişkenine göre bilgi yazdırılıyor.
	if (!isset($donduruver)) 
	{

	if (isset($_GET['etiket']))
	{
	$donduruver[] = array(
	'{SON_ILETI_RENGI}' => '',
	'{ACILIS_TARİH}' => '&nbsp;',
	'{HABER_LINK}' => '&nbsp;'.$kp_dil_367.'<br>',
	'{ID}' => '',
	'{YAZAN2}' => '&nbsp;',
	'{OKUNMA2}' => '&nbsp;');
	}
	else
	{		
	$donduruver[] = array(
	'{SON_ILETI_RENGI}' => '',
	'{ACILIS_TARİH}' => '&nbsp;',
	'{HABER_LINK}' => '&nbsp;'.$kp_dil_335.'<br>',
	'{ID}' => '',
	'{YAZAN2}' => '&nbsp;',
	'{OKUNMA2}' => '&nbsp;');
	}		
	}



	// tema uygulanıyor.
	$ornek1->dongusuz($dongusuz);
	$ornek1->tekli_dongu('1',$donduruver);
	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	}

	else
	{
	// haber sayfası açıkmı kapalımı bakılıyor.
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	exit();
	}
	
	if (isset($_GET['hn']))
	{
	

	if ($portal_ayarlar['haberlere_giris_izni'] == 0)
	{

	if (empty($kullanici_kim['id']))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_3,
	'{ADRES}' => './giris.php?git=giris',
	'{ILETI}' => $kp_dil_524,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__4,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	}

	// gelen id nümerik'mi bakılıyor.
	if (is_numeric($_GET['hn']) == true) $_GET['hn'] = @zkTemizle($_GET['hn']);
	else $_GET['hn'] = 0;


	// SEO ADRESİNİN DOĞRULUĞU KONTROL EDİLİYOR YANLIŞSA DOĞRU ADRESE YÖNLENDİRİLİYOR //
	$sorgu1111 = "select id,baslik from $tablo_portal_haberler where id='$_GET[hn]' LIMIT 1";
	$sorgu1111_sonuc = $vt->query($sorgu1111) or die ($vt->hata_ver());
	$haber_satir = $vt->fetch_assoc($sorgu1111_sonuc);
	$dogru_adres = seo($haber_satir['baslik']);

	if ( (isset($_SERVER['REQUEST_URI'])) AND ($_SERVER['REQUEST_URI'] != '') AND (!@preg_match("/-$dogru_adres.html/i", $_SERVER['REQUEST_URI'])) AND (!@preg_match('/haberler\.php\?/i', $_SERVER['REQUEST_URI'])) )
	{
		$yonlendir = linkverPortal('haberler.php?hn='.$haber_satir['id'], $haber_satir['baslik']);
		echo '<meta http-equiv="Refresh" content="0;url='.$yonlendir.'">';
		exit();
	}


	$sayfa_adi = 'Haber İçerik Sayfası';

	if ($portal_bloklar_ayar['haber_sayfasi'] == 1)
	{
	$ornek1->kosul('2', array('' => ''), true);
	$ornek1->kosul('dal', array('' => ''), false);
	$ornek1->kosul('3', array('' => ''), false);
	$ornek1->kosul('1', array('' => ''), false);

/*
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';
*/

	// yetkiye göre veri çekiliyor.
	if ($kullanici_kim['yetki'] == 1)
	{
	$sorgu1112 = "select * from $tablo_portal_haberler where id='$_GET[hn]'";
	$sorgu1112_sonuc = $vt->query($sorgu1112) or die ($vt->hata_ver());
	$vtsonuc2 = $vt->fetch_assoc($sorgu1112_sonuc);
	}
	else
	{
	$sorgu1112 = "select * from $tablo_portal_haberler where id='$_GET[hn]' AND onay='1'";
	$sorgu1112_sonuc = $vt->query($sorgu1112) or die ($vt->hata_ver());
	$vtsonuc2 = $vt->fetch_assoc($sorgu1112_sonuc);
	}

	// gelen veri yoksa bilgi yazdırılıyor.
	if (!$vt->num_rows($sorgu1112_sonuc))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_336,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	if ($kullanici_kim['yetki'] == 1) $yorm_sil_buton = $kp_dil_338;
	else $yorm_sil_buton = '';

	if (is_numeric($_GET['hn']) == true) $_GET['hn'] = @zkTemizle($_GET['hn']);
	else $_GET['hn'] = 0;

	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;
	
	$limit = '10'; 
	$kosullar = "where haber_id='$_GET[hn]' order by tarih desc"; 
	$tabloadi = $tablo_portal_haberyorum; 

	$vtsorgu = $vt->query("SELECT COUNT(* ) FROM $tabloadi $kosullar" ); 
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	} 
	
	// veritabanından yorumlar çekiliyor.
	$sorgu11132 = "select * from $tabloadi $kosullar LIMIT $baslangic,$limit";
	$sorgu11132_sonuc = $vt->query($sorgu11132) or die ($vt->hata_ver());
	$vtsonuc33 = $vt->num_rows($sorgu11132_sonuc);// veritabanından yorumlar çekiliyor.

	// etiketler ayırılıyor.
	$etiket = explode(',',$vtsonuc2['etiket']);

	$kac_tane = count($etiket);

	$cikan_haberler = '';


	for ($i=0; $kac_tane > $i; $i++)
	{
	// etiket sorgu başlıyor.
	$sorguetiket = "select * from $tablo_portal_haberler where id!='$vtsonuc2[id]' $cikan_haberler AND onay='1' AND etiket like '%$etiket[$i]%' order by tarih desc limit 10";

	$sorguetiket_sonuc = $vt->query($sorguetiket) or die ($vt->hata_ver());


	while ($vtsonucetiket = $vt->fetch_assoc($sorguetiket_sonuc))
	{
	$donduR[] = array(
	'{ETIKET_BASLIK}' => '<a href="'.linkverPortal('haberler.php?hn='.$vtsonucetiket['id'],$vtsonucetiket['baslik']).'">'.$vtsonucetiket['baslik'].'</a>',
	'{ETIKET_YAZAN}' => '<a href="'.linkver('../profil.php?kim='.$vtsonucetiket['yazan'],$vtsonucetiket['yazan']).'">'.$vtsonucetiket['yazan'].'</a>',
	'{ETIKET_OKUNMA_SAYISI}' => $vtsonucetiket['okunma_sayisi'],
	'{ETIKET_TARIH}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $vtsonucetiket['tarih']));


	$cikan_haberler .= " AND id!='$vtsonucetiket[id]'";


	}
	}

	if (!isset($donduR))
	{
	$donduR[] = array(
	'{ETIKET_BASLIK}' => $kp_dil_439,
	'{ETIKET_YAZAN}' => '',
	'{ETIKET_OKUNMA_SAYISI}' => '',
	'{ETIKET_TARIH}' => '');
	}

	$ornek1->dongusuz(array(
	'{BENZER_HABERLER}' => $kp_dil_387,
	'{BASSLIK}' => $kp_dil_362,
	'{B_YAZAN}' => $kp_dil_328,
	'{B_OKUNMA_SAYISI}' => $kp_dil_329,
	'{B_TARIH}' => $kp_dil_327));


	$ornek1->tekli_dongu('E',$donduR);


	// yorumlar döngüye sokuluyor.
	while ($vtsonuc32 = $vt->fetch_assoc($sorgu11132_sonuc)):

	$dongu_baslat[] = array(
	'{YORUMLARA_KAPALI}' => '',
	'{YORUM}' => bbcode_kapali(ifadeler($vtsonuc32['icerik'])),
	'{SIL3}' => $yorm_sil_buton,
	'{YORUM_YAZAN}' => '<a href="'.linkver('../profil.php?kim='.$vtsonuc32['yazan'],$vtsonuc32['yazan']).'">'.$vtsonuc32['yazan'].'</a>',
	'{YORUM_SIL}' => 'haberler.php?kosul=haber_yorum_sil&amp;hn='.$vtsonuc32['id'].'&amp;no='.$vtsonuc2['id'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'],
	'{Y_TARIH}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $vtsonuc32['tarih']));

	endwhile;

	if ($vtsonuc2['yorum'] != 1) 
	{
	$ornek1->kosul('7', array('' => ''), false);
	$ornek1->dongusuz(array(
	'{YORUMLARA_KAPALI}' => '&nbsp;&nbsp;'.$kp_dil_369,
	'{YORUM}' => '',
	'{YORUM_YAZAN}' => '',
	'{SIL3}' => '',
	'{YORUM_SIL}' => '',
	'{Y_TARIH}' => ''));
	}
	else
	{
	if (!isset($dongu_baslat))
	{
	$ornek1->kosul('7', array('' => ''), true);
	$dongu_baslat[] = array(
	'{YORUMLARA_KAPALI}' => '',
	'{YORUM}' => '<br>&nbsp;&nbsp;'.$kp_dil_337.'',
	'{YORUM_YAZAN}' => '',
	'{SIL3}' => '',
	'{YORUM_SIL}' => '',
	'{Y_TARIH}' => '');
	}	

	$ornek1->tekli_dongu('2',$dongu_baslat);
	}

	$aciklama_sonucu = '';

	$vtsonuc2['icerik'] = ifadeler($vtsonuc2['icerik']);
	
	if ( ($vtsonuc2['bbcode_kullan'] == 1) AND ($ayarlar['bbcode'] == 1) )
	{
	
	$aciklama_sonucu .= phpKFP_BBcode(bbcode_acik($vtsonuc2['icerik'],$vtsonuc2['id']));
	}
	else
	{
	$aciklama_sonucu .= bbcode_kapali($vtsonuc2['icerik']);
	}	

	if ($kullanici_kim['yetki'] == 1) $ornek1->kosul('5', array('' => ''), true);
	else $ornek1->kosul('5', array('' => ''), false);


	if (!empty($kullanici_kim['id'])) $ornek1->kosul('6', array('' => ''), true);
	else $ornek1->kosul('6', array('' => ''), false);

	// etiketler ayırılıyor.
	
	$etiket = explode(',',$vtsonuc2['etiket']);

	$kac_tane = count($etiket);

	$vtsonuc11a = '';

	for ($i=0; $kac_tane > $i; $i++)
	{
	if ($etiket[$i] != 1)
	{
	$etiket2 = @str_replace(' ','%20',$etiket[$i]);
	$vtsonuc11a .= '<a href="'.linkverPortal('haberler.php?etiket='.$etiket2).'">'.$etiket[$i].'</a>&nbsp;, &nbsp;';
	}
	else
	{
	$etiket2 = @str_replace(' ','%20',$etiket[$i]);
	$vtsonuc11a .= '<a href="'.linkverPortal('haberler.php?etiket='.$etiket2).'">'.$etiket[$i].'</a> &nbsp;';	
	}
	}
	
	$sorgu1ww = "select id,baslik from $tablo_portal_haberler where id='$_GET[hn]'";
	$sorgu1ww_sonuc = $vt->query($sorgu1ww) or die ($vt->hata_ver());
	$vtsonuc22ww = $vt->fetch_assoc($sorgu1ww_sonuc);
	
	$tablo1 = sayfalama($limit,$sayfa,$satir_sayisi,'haberler.php?','&hn='.$_GET['hn'],$vtsonuc22ww['baslik'].'',$adresdeger='');
	
	
	$java = '<script type="text/javascript">
	<!-- //
	
	function denetle25()
{ 
	var dogruMu = true;
	if ((document.form.icerik.value.length < 3)) 
	{ 
		dogruMu = false; 
		alert(\''.$kp_dil_357.'\');
	}
	return dogruMu;
}

	//  -->
	</script>
	
	';
	
	
	$dongu_yok = array(
	'{DOSYAYI_YAZDIR}' => '<a target="_blank" href="yazdir.php?dosya=haberler&amp;veri=konu&amp;kosul=portal&amp;no='.$vtsonuc2['id'].'">'.$kp_dil_100.'</a>',
	'{JAVA_SCRIPT}' => $java,
	'{YORUMLAR}' => $kp_dil_142,
	'{SAYFALAMA1}' => $tablo1,
	'{SIL_UYARISI}' => $kp_dil_151,
	'{HABERLER}' => $kp_dil_325,
	'{ETIKETLER}' => $kp_dil_368,
	'{SIL2}' => $kp_dil_338,
	'{DUZENLE}' => $kp_dil_339,
	'{HABER_EKLE}' => $kp_dil_330,
	'{YAZAN2}' => $kp_dil_328,
	'{OKUNMA2}' => $kp_dil_329,
	'{TARIH2}' => $kp_dil_340,
	'{TOPLAM_YORUM2}' => $kp_dil_343,
	'{GONDER}' => $kp_dil_341,
	'{TEMIZLE}' => $kp_dil_342,
	'{ETIKET}' => $vtsonuc11a,
	'{TOPLAM_YORUM}' => $vtsonuc33,
	'{YORUM_EKLE}' => 'haberler.php?kosul=haber_yorum_ekle',
	'{ID}' => $vtsonuc2['id'],
	'{PORTAL_ARKA_TABLO_RENGI}' => $arka_tablo,
	'{BASLIK}' => $vtsonuc2['baslik'],
	'{DUZENLEME}' => 'haberler.php?kosul=haber_ekle&amp;haber_duzenle&amp;hn='.$vtsonuc2['id'],
	'{SIL}' => 'haberler.php?kosul=haber_sil&amp;hn='.$vtsonuc2['id'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'],
	'{ACIKLAMA}' => $aciklama_sonucu,
	'{YAZAN}' => '<a href="'.linkver('../profil.php?kim='.$vtsonuc2['yazan'],$vtsonuc2['yazan']).'">'.$vtsonuc2['yazan'].'</a>',
	'{OKUNMA}' => $vtsonuc2['okunma_sayisi']+1,
	'{TARİH}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $vtsonuc2['tarih']));

	// gelen id nümerik'mi bakılıyor.
	if (is_numeric($_GET['hn']) == true) $_GET['hn'] = @zkTemizle($_GET['hn']);
	else $_GET['hn'] = 0;

	// okunma sayısı arttırılıyor.
	$vt->query("UPDATE $tablo_portal_haberler SET okunma_sayisi=okunma_sayisi +1 WHERE id='$_GET[hn]'") or die ($vt->hata_ver());


	// tema uygulanıyor.
	$ornek1->dongusuz($dongu_yok);
	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	}

	else
	{
	// haber sayfası açıkmı kapalımı diye bakılıyor.
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}


	exit();
	}
	


	
	// HABERLER SAYFASI //
	
	if ($portal_bloklar_ayar['haber_sayfasi'] == 1):

/*
	$sayfa_adi = 'Haberler Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';
*/

	$ornek1->kosul('dal', array('' => ''), true);
	$ornek1->kosul('1', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('3', array('' => ''), false);


	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;

	$limit = $portal_ayarlar['haber_dal_limit']; 
	$kosullar = "order by tarih desc"; 
	$tabloadi = $tablo_portal_haberdal; 

	$vtsorgu = $vt->query("SELECT COUNT(* ) FROM $tabloadi $kosullar" ); 
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@$sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}	

	$Sorgu = "select * from $tabloadi $kosullar LIMIT $baslangic,$limit";
	$Sorgu_kontrol = $vt->query($Sorgu) or die ($vt->hata_ver());

	$dallar = '';

	while ($Sorgu_sonuc = $vt->fetch_assoc($Sorgu_kontrol))
	{

	
	$haber_resim_sonucu1 = 'temalar/'.$temadizini.'/resimler/resimler/haber.gif';
	


	$Sorgu11 = $vt->query("select * from $tablo_portal_haberler where dal_id='$Sorgu_sonuc[id]' AND onay='1'") or die ($vt->hata_ver());
	$haber_sayisi = $vt->num_rows($Sorgu11);



	$dallar_dongu[] = array(
	'{DAL_ADRES}' => linkverPortal('haberler.php?hd='.$Sorgu_sonuc['id'], $Sorgu_sonuc['dal']),
	'{HABER_SAYISI}' => $haber_sayisi,
	'{HABER}' => $haber_resim_sonucu1,
	'{DAL}' => $Sorgu_sonuc['dal']);

	}

	unset($Sorgu);
	unset($Sorgu_kontrol);
	unset($Sorgu_sonuc);

	$kilitle = '';
	$kilit_ileti = '';

	if (!empty($kullanici_kim['id'])) $ornek1->kosul('3', array('' => ''), true);
	else $ornek1->kosul('d3', array('' => ''), false);


	if (!isset($dallar_dongu)) 
	{
	$ornek1->kosul('d6', array('{SONUC}' => $kp_dil_304), true);
	$ornek1->kosul('d5', array('' => ''), false);
	}
	else 
	{
	$ornek1->kosul('d5', array('' => ''), true);
	$ornek1->kosul('d6', array('{SONUC}' => ''), false);
	}

	if (!isset($dallar_dongu))
	{
	$dallar_dongu[] = array(
	'{DAL_ADRES}' => '',
	'{HABER_SAYISI}' => '',
	'{HABER}' => '',
	'{DAL}' => '');
	}

	$ornek1->tekli_dongu('d1',$dallar_dongu);

	$Sorgu_a2 = "select * from $tablo_portal_haberler where onay='1'";
	$Sorgu_kontrol_a2 = $vt->query($Sorgu_a2) or die ($vt->hata_ver());
	$Sorgu_sonuc_a2 = $vt->num_rows($Sorgu_kontrol_a2);

	$Sorgu_a3 = "select * from $tablo_portal_haberler where onay='1' order by tarih desc limit 1";
	$Sorgu_kontrol_a3 = $vt->query($Sorgu_a3) or die ($vt->hata_ver());
	$Sorgu_sonuc_a3 = $vt->fetch_assoc($Sorgu_kontrol_a3);

	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,'haberler.php?',$adresdeger='');

	

	
	$ornek1->dongusuz(array(
	'{SAYFALAMA}' => $tablo,
	'{ARKA_TABLO}' => $arka_tablo,
	'{SON}' => '',
	'{BURADA}' => $kp_dil_299,
	'{HABER_VAR}' => $kp_dil_332,
	'{SON_EKLENEN2}' => $kp_dil_334,
	'{TOPLAM_HABER_SAYISI}' => $Sorgu_sonuc_a2,
	'{SON_HABER_BILGISI}' => $Sorgu_sonuc_a3['baslik'],
	'{SON_HABER_ADRESI}' => linkverPortal('haberler.php?hn='.$Sorgu_sonuc_a3['id'],$Sorgu_sonuc_a3['baslik']),
	'{HABER_DALLARI}' => $kp_dil_474,
	'{DALLAR}' => $kp_dil_268,
	'{HABER_EKLEME_SAYFASI}' => 'haberler.php?kosul=haber_ekle',
	'{HABER_EKLEME_SAYFASI_ADI}' => $kp_dil_475,
	'{TOPLAM_HABER}' => $kp_dil_476));

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	exit();




	else:
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'haberler.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	endif;

	// HABERLER SAYFASI - SONU //

?>