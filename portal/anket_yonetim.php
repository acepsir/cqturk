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
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';
	if (!defined('DOSYA_DILAYAR')) include 'diller/dil_ayarlari.php';

	// portal yonetim taban rengi nilgisi.
	$arka_tablo = "yonetim_bg2";

	// Forum için anket ekletisi
	$forum_icin_anket_eklentisi = false;


	// bilgi iletisi ekrana yazdırılıyor.
	if ($bilgi == "iletisi")
	{
	header ('Location: anket_yonetim.php');
	exit();
	}


	// ANKET SORUSU EKLENIYOR //

	if ($kosul == "anket_soru_ekle")
	{
	$tarih = time();

	//	FORM DOLU MU ?	//
	if (( strlen(utf8_decode($_POST['anket_soru'])) >  250) OR ( strlen($_POST['anket_soru']) <  3) )
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './anket_yonetim.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_289,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}

	else
	{

	if ((isset($_POST['kayit_yapildi_mi'])) AND ($_POST['kayit_yapildi_mi'] == 'form_dolu')):

	// magic_quotes_gpc açıksa //
	if (get_magic_quotes_gpc())
	$_POST['anket_soru'] = @zkTemizle2(stripslashes($_POST['anket_soru']));

	// magic_quotes_gpc kapalıysa //
	else $_POST['anket_soru'] = @zkTemizle2($_POST['anket_soru']);

	$vtsorgu = "INSERT INTO $tablo_portal_anketsoru (tarih, anket_soru, anket_durum,oy_kullanan_id)";

	$vtsorgu .= "VALUES ('$tarih','$_POST[anket_soru]','1',',')";
	$vtsonuc5 = $vt->query($vtsorgu) or die ($vt->hata_ver());

	header('Location: anket_yonetim.php?bilgi=iletisi');
	endif;

	}
	exit();
	}
	// ANKET SORUSU EKLENIYOR - SONU //

	// ANKET KAPATILIYOR //

	if ($kosul == "anket_kapat"):

	$anketno = @zkTemizle($_POST['anketno']);

	$vtsorgu111 = "UPDATE $tablo_portal_anketsoru SET anket_durum='0' WHERE anketno='$anketno' LIMIT 1";

	$vtsonuc123 = $vt->query($vtsorgu111) or die ($vt->hata_ver());

	header ('Location: anket_yonetim.php?bilgi=iletisi');

	exit();
	endif;
	// ANKET KAPATILIYOR - SONU //

	// ANKET AÇILIYOR //

	if ($kosul == "anket_ac"):

	$anketno = @zkTemizle($_POST['anketno']);

	$vtsorgu111 = "UPDATE $tablo_portal_anketsoru SET anket_durum='1' WHERE anketno='$anketno' LIMIT 1";

	$vtsonuc123 = $vt->query($vtsorgu111) or die ($vt->hata_ver());

	header ('Location: anket_yonetim.php?bilgi=iletisi');

	exit();
	endif;
	// ANKET AÇILIYOR - SONU //

	// ANKET  YORUM  AÇ-KAPA //

	if ($kosul == "yorum_ac_kapa"):

	$anketno = @zkTemizle($_POST['anketno']);
	$yorum_ac_kapa = @zkTemizle($_POST['yorum_ac_kapa']);

	$vtsorgu111 = "UPDATE $tablo_portal_anketsoru SET anket_yorum='$yorum_ac_kapa' WHERE anketno='$anketno' LIMIT 1";

	$vtsonuc123 = $vt->query($vtsorgu111) or die ($vt->hata_ver());

	header ('Location: anket_yonetim.php?bilgi=iletisi');

	exit();
	endif;
	// ANKET  YORUM  AÇ-KAPA - SONU //



	// ANKET SECENEKLERI VERITABANıNA KAYDEDILIYOR //

	if ($kosul == "secenek_ekle")
	{

	if (( strlen(utf8_decode($_POST['secenek'])) >  100) OR ( strlen($_POST['secenek']) <  2) )
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './anket_yonetim.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_290,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}

	if ((isset($_POST['kayit_yapildi_mi'])) AND ($_POST['kayit_yapildi_mi'] == 'form_dolu')):

	$_POST['anketno'] = @zkTemizle($_POST['anketno']);

	// magic_quotes_gpc açıksa //
	if (get_magic_quotes_gpc())
	$_POST['secenek'] = @zkTemizle2(stripslashes($_POST['secenek']));

	// magic_quotes_gpc kapalıysa //
	else $_POST['secenek'] = @zkTemizle2($_POST['secenek']);

	$vtsorgu = "INSERT INTO $tablo_portal_anketsecenek (secenek,anketno)";

	$vtsorgu .= "VALUES ('$_POST[secenek]','$_POST[anketno]')";
	$vtsonuc5 = $vt->query($vtsorgu) or die ($vt->hata_ver());

	header('Location: anket_yonetim.php?bilgi=iletisi');
	endif;


	exit();
	}
	// ANKET SECENEKLERI VERITABANıNA KAYDEDILIYOR -SONU //

	//ANKET SİLİNİYOR //	
	
	if ($kosul == "anket_sil"):

	// Sil Anahtarı Kontrol Ediliyor //
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'anket_yonetim.php',
	'{ILETI}' => $kp_dil_487,
	'{EK_YAZI}' => $kp_dil_322,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);

	exit();
	}
	else
	{
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());
	}
	
	// Sil Anahtarı Kontrol Ediliyor - Sonu //
	
	$anketno = @zkTemizle($_GET['anketno']);

	$vtsorgu = "DELETE FROM $tablo_portal_anketsoru WHERE anketno='$anketno'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu1 = "DELETE FROM $tablo_portal_anketsecenek WHERE anketno='$anketno'";
	$vtsonuc1 = $vt->query($vtsorgu1) or die ($vt->hata_ver());

	$vtsorgu2 = "DELETE FROM $tablo_portal_anketyorum WHERE anketno='$anketno'";
	$vtsonuc2 = $vt->query($vtsorgu2) or die ($vt->hata_ver());

	header('Location: anket_yonetim.php?bilgi=iletisi');

	exit();

	endif;

	if ($kosul == "anket_sil_form"):
	
	// Sil Anahtarı Kontrol Ediliyor //
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'anket_yonetim.php',
	'{ILETI}' => $kp_dil_487,
	'{EK_YAZI}' => $kp_dil_322,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);

	exit();
	}
	else
	{
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());
	}
	
	// Sil Anahtarı Kontrol Ediliyor - Sonu //

	$anketno = @zkTemizle($_POST['anketno']);

	$vtsorgu = "DELETE FROM $tablo_portal_anketsoru WHERE anketno='$anketno'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu1 = "DELETE FROM $tablo_portal_anketsecenek WHERE anketno='$anketno'";
	$vtsonuc1 = $vt->query($vtsorgu1) or die ($vt->hata_ver());

	$vtsorgu2 = "DELETE FROM $tablo_portal_anketyorum WHERE anketno='$anketno'";
	$vtsonuc2 = $vt->query($vtsorgu2) or die ($vt->hata_ver());

	header('Location: anket_yonetim.php?bilgi=iletisi');

	exit();

	endif;
	//ANKET SİLİNİYOR -SONU //


	//SEÇENEK SİLİNİYOR //
	if ($kosul == "secenek_sil"):
	
	// Sil Anahtarı Kontrol Ediliyor //
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'anket_yonetim.php',
	'{ILETI}' => $kp_dil_487,
	'{EK_YAZI}' => $kp_dil_322,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);

	exit();
	}
	else
	{
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());
	}
	
	// Sil Anahtarı Kontrol Ediliyor - Sonu //

	$secenekno = @zkTemizle($_GET['secenekno']);

	$vtsorgu1 = "DELETE FROM $tablo_portal_anketsecenek WHERE secenekno='$secenekno'";

	$vtsonuc1 = $vt->query($vtsorgu1) or die ($vt->hata_ver());

	header ('Location: anket_yonetim.php?bilgi=iletisi');

	exit();
	endif;


	//SEÇENEK SİLİNİYOR -SONU //

	// ANKET DÜZENLEME - BAŞLANGICI //

	if ($kosul == "anket_duzenle2"):

	if (( strlen(utf8_decode($_POST['anket_soru'])) >  250) OR ( strlen($_POST['anket_soru']) <  3) )
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './anket_yonetim.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_289,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}

	$anketno = @zkTemizle($_POST['anketno']);

	// magic_quotes_gpc açıksa //
	if (get_magic_quotes_gpc())
	$anket_soru = @zkTemizle2($_POST['anket_soru']);

	// magic_quotes_gpc kapalıysa //
	else $anket_soru = @zkTemizle2($_POST['anket_soru']);


	if ($forum_icin_anket_eklentisi)
	{
		$vtsorgu111 = "UPDATE $tablo_portal_anketsoru SET anket_soru='$anket_soru',forum_yer='$_POST[forum_yer]' WHERE anketno='$anketno' LIMIT 1";
	}
	else
	{
		$vtsorgu111 = "UPDATE $tablo_portal_anketsoru SET anket_soru='$anket_soru' WHERE anketno='$anketno' LIMIT 1";
	}

	$vtsonuc123 = $vt->query($vtsorgu111) or die ($vt->hata_ver());

	header ('Location: anket_yonetim.php?bilgi=iletisi');

	exit();
	endif;
	// ANKET DÜZENLEME - SONU//



	// ANKET DÜZENLEME - BAŞLANGICI //

	if ($kosul == "anket_duzenle"):

	if (( strlen(utf8_decode($_POST['secenek'])) >  100) OR ( strlen($_POST['secenek']) <  2) )
	{

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './anket_yonetim.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_290,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}

	$secenek = @zkTemizle2($_POST['secenek']);

	$secenekno = @zkTemizle($_GET['secenekno']);

	$vtsorgu111 = "UPDATE $tablo_portal_anketsecenek SET secenek='$secenek' WHERE secenekno='$secenekno' LIMIT 1";

	$vtsonuc123 = $vt->query($vtsorgu111) or die ($vt->hata_ver());

	header ('Location: anket_yonetim.php?bilgi=iletisi');

	exit();
	endif;
	// ANKET DÜZENLEME - SONU//

	$sayfa_adi = 'Anket Sayfası';
	if (!defined('DOSYA_YONETIM_BASLIK')) include 'phpkf-bilesenler/yonetim_sayfa_baslik.php';
	menu();

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'yonetim/temalar/'.$temadizini.'/anket_yonetim.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));


	$Sorgu = "SELECT * FROM $tablo_portal_anketsoru";
	$anket_sonuc1 = $vt->query($Sorgu) or die ($vt->hata_ver());
	$anketsoru = $vt->fetch_assoc($anket_sonuc1);

	if ($kosul == "duzenle"){

	$ornek1->kosul('1', array('' => ''), true);
	$ornek1->kosul('2', array('' => ''), false);
	if (!$forum_icin_anket_eklentisi) $ornek1->kosul('3', array('' => ''), false);


	$_GET['anketno'] = @zkTemizle($_GET['anketno']);

	$vtsorgu1 = "SELECT * FROM $tablo_portal_anketsoru where anketno='$_POST[anketno]'";
	$anketler_sonuc1 = $vt->query($vtsorgu1) or die ($vt->hata_ver());
	$anketler1 = $vt->fetch_assoc($anketler_sonuc1);

	$vtsorgu = "SELECT * FROM $tablo_portal_anketsecenek where anketno='$_POST[anketno]'";
	$anketler_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	

	if (!$vt->num_rows($anketler_sonuc))
	{
	$kilit2 = ' disabled="disabled"';
	$uyari = $kp_yonetim_167;
	}
	else
	{
	$kilit2 = '';
	$uyari = '';
	}

	while ($anketler = $vt->fetch_assoc($anketler_sonuc)):

	$dongu[] = array(
	'{YONETIM_ARKA_TABLO_RENGI}' => $arka_tablo,
	'{S_ANKET_NO}' => $anketler['anketno'],
	'{SECENEK_NO}' => $anketler['secenekno'],
	'{SECENEK}' => $anketler['secenek'],
	'{ANKET_DUZENLE_SAYFASI_1}' => 'anket_yonetim.php?kosul=anket_duzenle&amp;secenekno='.$anketler['secenekno'],
	'{ANKET_SIL_SAYFASI_1}' => 'anket_yonetim.php?kosul=secenek_sil&amp;secenekno='.$anketler['secenekno'].'&amp;anketno='.$anketler['anketno'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'],
	'{SECENEK_DUZELT}' => $kp_yonetim_98,
	'{SECENEK_SIL}' => $kp_dil_162,
	'{SECENEK_SIL_UYARI}' => $kp_dil_151);

	endwhile;


	################

	$anket_yorum = '<label style="cursor: pointer;"><input type="radio"  name="yorum_ac_kapa" value="1"';

	if ($anketler1['anket_yorum'] == 1) 
	$anket_yorum .= ' checked="checked"';

	$anket_yorum .= '>'.$kp_yonetim_185.'</label>';

	/*************************/

	$anket_yorum .= '<label style="cursor: pointer;"><input type="radio"  name="yorum_ac_kapa" value="0"';

	if ($anketler1['anket_yorum'] == 0) 
	$anket_yorum .= ' checked="checked"';

	$anket_yorum .= '>'.$kp_yonetim_186.'</label>';

	################

	if ($forum_icin_anket_eklentisi) $forum_yer = $anketler1['forum_yer'];
	else $forum_yer = '';

	$dongusuz = array(
	'{DEGISTIR}' => $kp_yonetim_26,
	'{YORUM}' => $kp_yonetim_266,
	'{YORUM_SONUCU}' => $anket_yorum,
	'{YONETIM_ARKA_TABLO_RENGI}' => $arka_tablo,
	'{ANKET_AYARLARI}' => $kp_yonetim_99,
	'{KILIT2}' => $kilit2,
	'{UYARI}' => $uyari,
	'{ANKET_NO}' => $anketler1['anketno'],
	'{ANKET_SORUSU}' => $kp_yonetim_83,
	'{ANKET_DUZENLE2_SAYFASI_1}' => 'anket_yonetim.php?kosul=anket_duzenle2&amp;anketno='.$anketler1['anketno'],
	'{YORUM_AC_KAPA}' => 'anket_yonetim.php?kosul=yorum_ac_kapa',
	'{ANKET_SORUSU_SONUCU}' => $anketler1['anket_soru'],
	'{ANKETI_DUZENLE}' => $kp_yonetim_98,
	'{FORUM_YERI}' => $forum_yer);




	$bilgi_ver = $kp_dil_222;
	$devre_disi = $kp_dil_223;

	if (isset($dongu))
	{
	$ornek1->tekli_dongu('1',$dongu);
	}
	else
	{
	$ornek1->tekli_dongu('1', array(array(
	'{SECENEK}' => '', 
	'{ANKET_SIL_SAYFASI_1}' => 'anket_yonetim.php',
	'{SECENEK_SIL_UYARI}' => $kp_yonetim_287,
	'{SECENEK_DUZELT}' => $kp_yonetim_98, 
	'{SECENEK_SIL}' => $kp_dil_162)));

	}

	$ornek1->dongusuz($dongusuz);
	eval(TEMA_UYGULA);

	
	exit();
	}
	else
	{

	$ornek1->kosul('2', array('' => ''), true);
	$ornek1->kosul('1', array('' => ''), false);
	if (!$forum_icin_anket_eklentisi) $ornek1->kosul('3', array('' => ''), false);


	$Sorgu = "SELECT anketno,anket_soru FROM $tablo_portal_anketsoru where anket_durum='1' ORDER by tarih DESC";
	$anket_sonuc = $vt->query($Sorgu) or die ($vt->hata_ver());


	$secenek = '';
	
	while ($anketler1 = $vt->fetch_array($anket_sonuc)):

	$secenek .= '<option value="'.$anketler1['anketno'].'">'.$anketler1['anket_soru'].'</option>';

	endwhile;
	
	if ($secenek !='')
	{
	$ornek1->dongusuz(array('{SECENEK_DONGU1}' => $secenek));
	}
	else
	{
	$ornek1->dongusuz(array('{SECENEK_DONGU1}' => '<option value="">'.$kp_yonetim_166.'</option>'));
	}


	$Sorgu = "SELECT anketno,anket_soru FROM $tablo_portal_anketsoru ORDER by tarih DESC";
	$anket_sonuc = $vt->query($Sorgu) or die ($vt->hata_ver());

	$secenek2 = '';

	while ($anketler2 = $vt->fetch_array($anket_sonuc)):


	$secenek2 .= '<option value="'.$anketler2['anketno'].'">'.$anketler2['anket_soru'].'</option>';


	endwhile;
	
	
	if ($secenek2 !='')
	{
	$ornek1->dongusuz(array('{SECENEK_DONGU2}' => $secenek2));
	}
	else
	{
	$ornek1->dongusuz(array('{SECENEK_DONGU2}' => '<option value="">'.$kp_yonetim_166.'</option>'));
	}



	$Sorgu2 = "SELECT anketno,anket_soru FROM $tablo_portal_anketsoru where anket_durum='1'";
	$anket_sonuc1 = $vt->query($Sorgu2) or die ($vt->hata_ver());

	$anketler11 = $vt->fetch_array($anket_sonuc1);


	$Sorgu22 = "SELECT * FROM $tablo_portal_anketsoru  ORDER by tarih DESC";
	$anket_sonuc22 = $vt->query($Sorgu22) or die ($vt->hata_ver());

	$secenek3 = '';

	while ($anketler3 = $vt->fetch_array($anket_sonuc22)):

	$secenek3 .= '<option value="'.$anketler3['anketno'].'">'.$anketler3['anket_soru'].'</option>';


	endwhile;

	if ($secenek3 !='')
	{
	$ornek1->dongusuz(array('{SECENEK_DONGU3}' => $secenek3));
	}
	else
	{
	$ornek1->dongusuz(array('{SECENEK_DONGU3}' => '<option value="">'.$kp_yonetim_166.'</option>'));
	}

	$Sorgua = "SELECT * FROM $tablo_portal_anketsoru where anket_durum='1' ORDER by tarih DESC";
	$anket_sonuca = $vt->query($Sorgua) or die ($vt->hata_ver());
	
	$secenek4 = '';
	
	while ($anketler4 = $vt->fetch_array($anket_sonuca)):

	$secenek4 .= '<option value="'.$anketler4['anketno'].'">'.$anketler4['anket_soru'].'</option>';

	endwhile;
	
	if ($secenek4 !='')
	{
	$ornek1->dongusuz(array('{SECENEK_DONGU4}' => $secenek4));
	}
	else
	{
	$ornek1->dongusuz(array('{SECENEK_DONGU4}' => '<option value="">'.$kp_yonetim_166.'</option>'));

	}

	$Sorgua1 = "SELECT * FROM $tablo_portal_anketsoru where anket_durum='0' ORDER by tarih DESC";
	$anket_sonuca1 = $vt->query($Sorgua1) or die ($vt->hata_ver());
	
	$secenek5 = '';
	
	while ($anketler5 = $vt->fetch_array($anket_sonuca1)):

	$secenek5 .= '<option value="'.$anketler5['anketno'].'">'.$anketler5['anket_soru'].'</option>';


	endwhile;
	
	if ($secenek5 !='')
	{
	$ornek1->dongusuz(array('{SECENEK_DONGU5}' => $secenek5));
	}
	else
	{
	$ornek1->dongusuz(array('{SECENEK_DONGU5}' => '<option value="">'.$kp_yonetim_166.'</option>'));
	}


	$vtsorgu1 = "SELECT * FROM $tablo_portal_anketsoru ORDER by tarih DESC";
	$anketler_sonuc1 = $vt->query($vtsorgu1) or die ($vt->hata_ver());
	if ($vt->num_rows($anketler_sonuc1))
	{
	while ($anket_sonuc1 = $vt->fetch_assoc($anketler_sonuc1)):

	$vtsorgu3 = $vt->query("SELECT * FROM $tablo_portal_anketsecenek where anketno='$anket_sonuc1[anketno]'") or die ($vt->hata_ver());
	$secenek_varmi = $vt->num_rows($vtsorgu3);

	if (($secenek_varmi) == 0)
	{
	$dongu6[] = array(
	'{PORTAL_INDEX}' => '',
	'{ANKET_NO}' => '',
	'{ANKET_SORU}' => '<font face="Verdana" style="font-size: 12px">'.$anket_sonuc1['anket_soru'].'</font>&nbsp;&nbsp;&nbsp;<font style="color: red">( '.$kp_yonetim_168.' )</font>');
	}
	else
	{

	$dongu6[] = array(
	'{ANKET_NO}' => $anket_sonuc1['anketno'],
	'{ANKET_SORU}' => '<a href="anket.php?kosul=anket_secenekler&amp;anketno='.$anket_sonuc1['anketno'].'"><font face="Verdana" style="font-size: 12px">'.$anket_sonuc1['anket_soru'].'</font></a>',
	'{PORTAL_INDEX}' => 'anket.php');

	}
	endwhile;
	}
	if (isset($dongu6))
	{
	$ornek1->tekli_dongu('6',$dongu6);
	}
	else
	{
	$ornek1->tekli_dongu('6', array(array('{ANKET_SORU}' => '<center><font face="Verdana" style="font-size: 12px">'.$kp_dil_221.'</font></center>')));
	}

	$vtsorgukilit = $vt->query("SELECT * FROM $tablo_portal_anketsoru") or die ($vt->hata_ver());

	$kilit = '';

	if (!$vt->num_rows($vtsorgukilit))
	{
	$kilit .= 'disabled="disabled"';
	}
	else
	{
	$kilit .= '';
	}

	$vtsorgukilit = $vt->query("SELECT * FROM $tablo_portal_anketsoru where anket_durum='0'") or die ($vt->hata_ver());

	$ackilit = '';

	if (!$vt->num_rows($vtsorgukilit))
	{
	$ackilit .= ' disabled="disabled"';
	}
	else
	{
	$ackilit .= '';
	}

	$vtsorgukilit = $vt->query("SELECT * FROM $tablo_portal_anketsoru where anket_durum='1'") or die ($vt->hata_ver());

	$kapatkilit = '';

	if (!$vt->num_rows($vtsorgukilit))
	{
	$kapatkilit .= ' disabled="disabled"';
	}
	else
	{
	$kapatkilit .= '';
	}

	$dongusuz2 = array(
	'{TEMA_DIZINI}' => $temadizini,
	'{KILITLE}' => $kilit,
	'{A_KILITLE}' => $ackilit,
	'{K_KILITLE}' => $kapatkilit,
	'{YONETIM_ARKA_TABLO_RENGI}' => $arka_tablo,
	'{ANKET_AYARLARI}' => $kp_yonetim_99,
	'{ANKET_SORUSU}' => $kp_yonetim_83,
	'{SORU_EKLE}' => $kp_yonetim_86,
	'{SECENEK_EKLE}' => $kp_yonetim_84,
	'{ANKET_SİL}' => $kp_yonetim_87,
	'{KAPAT}' =>  $kp_yonetim_161,
	'{AC}' =>  $kp_yonetim_172,
	'{KAPAT2}' =>  $kp_yonetim_162,
	'{AC2}' =>  $kp_yonetim_173,
	'{ANKETI_KAPAT}' =>  $kp_yonetim_160,
	'{ANKETI_AC}' =>  $kp_yonetim_171,
	'{ANKET_SİL2}' =>  $kp_dil_151,
	'{ANKET_DUZENLE}' => $kp_yonetim_98,
	'{SORU_EKLE_SAYFASI_1}' => 'anket_yonetim.php?kosul=anket_soru_ekle',
	'{SECENEK_EKLE_SAYFASI_1}' => 'anket_yonetim.php?kosul=secenek_ekle',
	'{ANKET_SIL_SAYFASI_2}' => 'anket_yonetim.php?kosul=anket_sil_form&amp;anahtar='.$portal_ayarlar['sil_anahtar'],
	'{ANKET_DUZENLE_SAYFASI_2}' => 'anket_yonetim.php?kosul=duzenle',
	'{ANKET_KAPAT_SAYFASI_1}' => 'anket_yonetim.php?kosul=anket_kapat',
	'{ANKET_AC_SAYFASI_1}' => 'anket_yonetim.php?kosul=anket_ac',
	'{EKLENEN_ANKETLER}' => $kp_yonetim_89); 



	$ornek1->dongusuz($dongusuz2);
	
	eval(TEMA_UYGULA);

	
	}
?>