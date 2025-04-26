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
	$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='3' OR kip='6'";
	if (!defined('DOSYA_AYAR')) include '../ayar.php';
	if (!defined('DOSYA_MENU')) include 'menu.php';
	if (!defined('DOSYA_PORTAL_AYARLAR')) include 'portal_ayarlar.php';
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';
	if (!defined('DOSYA_DILAYAR')) include 'diller/dil_ayarlari.php';

	// portal yonetim taban rengi nilgisi.
	$arka_tablo = "yonetim_bg2";
	
	
	// DOSYA SİLİNİYOR - BAŞLANGICI //
	if ($kosul == "dosya_sil"):

	
	
	$kategorino = @zkTemizle($_GET['kategorino']);
	$no = @zkTemizle($_GET['no']);
	
	// Sil Anahtarı Kontrol Ediliyor //
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'dosyalar.php?kategorino='.$kategorino,
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
	
	
	$vtsorgu = "SELECT setup_adi FROM $tablo_portal_indir WHERE no='$no'";
	$vtsonuc1 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$vtsonuc111 = $vt->fetch_assoc($vtsonuc1);

	@unlink('dosyalar/'.$vtsonuc111['setup_adi'].'');
	
	
	$vtsorgu = "DELETE FROM $tablo_portal_indir WHERE no='$no'";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
	$vtsorgu1 = "DELETE FROM $tablo_portal_indiryorum WHERE dosyano='$no'";
	
	$vtsonuc3 = $vt->query($vtsorgu1) or die ($vt->hata_ver());
	
	header ('Location: dosyalar.php?kategorino='.$kategorino.'');
	
	exit();
	endif;
	
	// DOSYA SİLİNİYOR - SONU //
	
	// DOSYANIN YENİ AYARLARI VERİTABANINA KAYDEDİLİYOR //	
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


	if ($kosul == "ayarlari_kaydet")
	{
	$tarih = time();
	
	$_POST['no'] = @zkTemizle($_POST['no']);
	
	if (( strlen(utf8_decode($_POST['dosya_baslik'])) > 60) OR ( strlen($_POST['dosya_baslik']) <  3) OR ( strlen($_POST['mesaj_icerik']) <  3))
	{

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './dosya_duzelt_sil.php?dosya=duzelt&amp;no='.$_POST['no'],
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_291,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}

	else
	{

	
	// magic_quotes_gpc açıksa //
	if (get_magic_quotes_gpc())
	$_POST['dosya_baslik'] = @zkTemizle2(stripslashes($_POST['dosya_baslik']));

	// magic_quotes_gpc kapalıysa //
	else $_POST['dosya_baslik'] = @zkTemizle2($_POST['dosya_baslik']);

	// magic_quotes_gpc açıksa //
	if (get_magic_quotes_gpc())
	$_POST['mesaj_icerik'] = @zkTemizle2(stripslashes($_POST['mesaj_icerik']));

	// magic_quotes_gpc kapalıysa //
	else $_POST['mesaj_icerik'] = @zkTemizle2($_POST['mesaj_icerik']);

	$_POST['dosya_boyutu'] = @zkTemizle2($_POST['dosya_boyutu']);
	$_POST['kategorino'] = @zkTemizle($_POST['kategorino']);
	$_POST['uretici'] = @zkTemizle2($_POST['uretici']);
	$_POST['dil'] = @zkTemizle2($_POST['dil']);
	$_POST['kullanim'] = @zkTemizle($_POST['kullanim']);
	$_POST['resim'] = @zkTemizle($_POST['resim']);


	$vtsorgu = "UPDATE $tablo_portal_indir SET degistirme_tarihi='$tarih', kategorino='$_POST[kategorino]', dosya_baslik='$_POST[dosya_baslik]', 
	dosya_boyutu='$_POST[dosya_boyutu]',
	dosya_aciklama='$_POST[mesaj_icerik]', degistiren='$kullanici_kim[kullanici_adi]', 
	degistirme_sayisi=degistirme_sayisi + 1,	degistiren_ip='$_SERVER[REMOTE_ADDR]', 
	bbcode_kullan='$bbcode_kullan', uretici='$_POST[uretici]', dil='$_POST[dil]', kullanim='$_POST[kullanim]', resim='$_POST[resim]' WHERE no='$_POST[no]' LIMIT 1";

    $vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
	header ('Location: dosyalar.php?no='.$_POST['no'].'');
	
	}
	exit();
	}
	// DOSYANIN YENİ AYARLARI VERİTABANINA KAYDEDİLİYOR - SONU //	
	
	

	$sayfa_adi = 'Dosya Düzeltme Sayfası';
	if (!defined('DOSYA_YONETIM_BASLIK')) include 'phpkf-bilesenler/yonetim_sayfa_baslik.php';
	menu();

	$kategorino = @zkTemizle($_GET['kategorino']);
	$no = @zkTemizle($_GET['no']);
	
	$vtsorgu = "SELECT * FROM $tablo_portal_indir WHERE no='$no' LIMIT 1";
	$vtsonuc1 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$vtsonuc = $vt->fetch_assoc($vtsonuc1);
	

	
	$Sorgu = "SELECT * FROM $tablo_portal_indirkategori";
	$kategori_sonuc = @$vt->query($Sorgu) or die ($vt->hata_ver());
	
	$dongule ='';
	$dongu ='';
	

	
	while ($kategoriler = $vt->fetch_array($kategori_sonuc)):

	
	$dongule .='<option value="'.$kategoriler['kategorino'].'"'; if ($kategoriler['kategorino'] == $vtsonuc['kategorino']) $dongule .= ' selected="selected"'; $dongule .= '>'.$kategoriler['kategoriadi'].''; $dongule .= '</option>';
	
	endwhile;
	
	

	 if ($ayarlar['bbcode'] == 1): 
	 $bbcode_sonucu = '<label style="cursor: pointer;">
	<input type="checkbox" name="bbcode_kullan" ';

	if ( (isset($vtsonuc['bbcode_kullan'])) AND ($vtsonuc['bbcode_kullan'] == 1) ) 
	{
	$bbcode_sonucu .= ' checked="checked"'; $bbcode_sonucu .= '>'.$kp_yonetim_62.'</label>';
	}
	else $bbcode_sonucu .= '>'.$kp_yonetim_62.'</label>';
	
	else: $bbcode_sonucu = '&nbsp;'.$kp_yonetim_63.'';

	endif;



	$dongusuz = array(
	'{KATEGORI_SONUCU}' => $dongule,
	'{NO}' => $no, 
	'{HTML}' => $kp_yonetim_279,
	'{BBCODE}' => $kp_yonetim_280,
	'{DUZ_METIN_DUZENLEYICI}' => $kp_dil_417,
	'{PORTAL_ARKA_TABLO_RENGI}' => $arka_tablo, 
	'{DEGISTIRILEMEZ}' => $kp_yonetim_278, 
	'{AYARLARI_KAYDET_SAYFASI_1}' => 'dosya_duzelt_sil.php?kosul=ayarlari_kaydet', 
	'{ORNEK}' => $kp_yonetim_170, 
	'{DOSYA_AYARLARI}' => $kp_yonetim_59, 
	'{DOSYA_ADI}' => $kp_dil_102, 
	'{DOSYA_ADI_SONUCU}' => $vtsonuc['dosya_baslik'], 
	'{DOSYA_ASRESI}' => $kp_yonetim_60, 
	'{DOSYA_ADRESI_SONUCU}' => $vtsonuc['dosya_adresi'], 
	'{URETICI_FIRMA}' => $kp_yonetim_90, 
	'{URETICI_FIRMA_SONUCU}' => $vtsonuc['uretici'], 
	'{KULLANIM}' => $kp_yonetim_91, 
	'{KULLANIM_SONUCU}' => $vtsonuc['kullanim'], 
	'{FREEWARE/Ucretsiz}' => $kp_yonetim_92, 
	'{SOFTWARE/Ucretli}' => $kp_yonetim_93, 
	'{SHAREWARE/Deneme}' => $kp_yonetim_94, 
	'{RESIM}' => $kp_yonetim_95, 
	'{RESIM_SONUCU}' => $vtsonuc['resim'], 
	'{DIL}' => $kp_yonetim_96, 
	'{DIL_SONUCU}' => $vtsonuc['dil'], 
	'{DOSYA_BOYUTU}' => $kp_dil_110, 
	'{DOSYA_BOYUTU_SONUCU}' => $vtsonuc['dosya_boyutu'], 
	'{KATEGORI_SEC}' => $kp_yonetim_79,
	'{DOSYA_ACIKLAMA}' => $kp_yonetim_66,
	'{FORM_ICERIK}' => $vtsonuc['dosya_aciklama'], 
	'{BBCODE_KULLAN}' => $kp_yonetim_62, 
	'{BBCODE_KAPALI}' => $kp_yonetim_63, 
	'{GONDER}' => $kp_yonetim_64, 
	'{TEMIZLE}' => $kp_yonetim_65,
	'{YAZI_RENGI}' => $kp_yonetim_67, 
	'{YAZI_BOYUTU}' => $kp_yonetim_68, 
	'{NORMAL}' => $kp_yonetim_69, 
	'{VARSAYILAN}' => $kp_yonetim_70, 
	'{BUYUK}' => $kp_yonetim_117);
	
	$bbcode = array('{BBCODE_SONUCU}' => $bbcode_sonucu);
	
	
	
	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'yonetim/temalar/'.$temadizini.'/dosya_duzelt_sil.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));
	$ornek1->dongusuz($dongusuz);
	$ornek1->dongusuz($bbcode);
	eval(TEMA_UYGULA);
?>