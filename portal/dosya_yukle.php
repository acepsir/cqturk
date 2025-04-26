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
	if (!defined('DOSYA_DILAYAR')) include 'diller/dil_ayarlari.php';
	// portal yonetim taban rengi nilgisi.
	$arka_tablo = "yonetim_bg2";


	// bilgi iletisi ekrana yazdırılıyor.
	if ((isset($_GET['bilgi'])) AND ($_GET['bilgi'] == "iletisi"))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => 'dosya_yukle.php',
	'{ILETI}' => '<meta target="_top" http-equiv="Refresh" content="3; url=dosya_yukle.php">',
	'{EK_YAZI}' => $kp_dil_405,
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}
	
	// bilgi iletisi ekrana yazdırılıyor - sonu.

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


	if ($kosul == "dosya_ekle")
	{
	
	$tarih = time();

	//	FORM DOLU MU ?	//
	if (( strlen(utf8_decode($_POST['dosya_baslik'])) >  60) OR ( strlen($_POST['dosya_baslik']) <  3) OR ( strlen($_POST['mesaj_icerik']) <  3))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosya_yukle.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_256,
	'{YONLENDIRME}' => $kp_yonetim_257,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}
	
	if ((isset($_POST['kayit_yapildi_mi'])) AND ($_POST['kayit_yapildi_mi'] == 'form_dolu')):

	

	
	$dosya_sorgu = "select dosya_baslik from $tablo_portal_indir where dosya_baslik='$_POST[dosya_baslik]'";
	$dosya_sorgu_sonuc = $vt->query($dosya_sorgu) or die ($vt->hata_ver());
	$dosya_sorgu2 = $vt->num_rows($dosya_sorgu_sonuc);

	
	
	// AYNI DOSYA DAHA ÖNCE YUKLENMİŞMİ KONTROL EDİLİYOR DOSYA ADINA GÖRE//
	if ($dosya_sorgu2)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosya_yukle.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_108,
	'{YONLENDIRME}' => $kp_yonetim_109,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}
	
	
	if (isset($_POST['ekle']) AND ($_POST['ekle'] != '') AND ($_POST['ekle'] != 'http://') )
	{

	
	// AYNI DOSYA DAHA ÖNCE YUKLENMİŞMİ KONTROL EDİLİYOR DOSYA ADINA GÖRE//
	if ($dosya_sorgu2['dosya_baslik'] == $_POST['dosya_baslik']){

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosya_yukle.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_108,
	'{YONLENDIRME}' => $kp_yonetim_109,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}
	
	// magic_quotes_gpc açıksa //
	if (get_magic_quotes_gpc())
	$_POST['ekle'] = @zkTemizle2(stripslashes($_POST['ekle']));

	// magic_quotes_gpc kapalıysa //
	else $_POST['ekle'] = @zkTemizle2($_POST['ekle']);
	
	$dosya_yeni_adi = null;
	
	$dosya_yukle = true;
	
	$dosya_adresi = $_POST['ekle'];
	
	}
	
	elseif (isset($_FILES['dup']) AND ($_FILES['dup'] != '') )
	
	{
	
	$dosya_kaynak = $_FILES["dup"]["tmp_name"];
	$dosya_isim = $_FILES["dup"]["name"];
	$dosya_uzanti = $_FILES["dup"]["type"];
	$dosya_boyut = $_FILES["dup"]["size"];
	$dosya_hata = $_FILES['dup']['error'];
	$dosya_hedef = "dosyalar";

	$bul = array(' ','ş','Ş','ü','Ü','ö','Ö','ç','Ç','ğ','Ğ','ı','İ','-',',','*','<','>','+','/','-','?','!','{','}','(',')','&','%','$','#','^','[',']','|');
	$degistir = array('_','s','S','u','U','o','O','c','C','g','G','i','I','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_');
	$dosya_yeni_adi = str_replace($bul, $degistir, $dosya_isim);

	$dosya_uzanti2 = substr($dosya_isim, -4);
	$dosya_uzanti3 = substr($dosya_isim, -3);

	$dosya_sorgu = "select setup_adi from $tablo_portal_indir where setup_adi='$dosya_yeni_adi'";
	$dosya_sorgu_sonuc = $vt->query($dosya_sorgu) or die ($vt->hata_ver());
	$dosya_sorgu2 = $vt->num_rows($dosya_sorgu_sonuc);


	// AYNI DOSYA DAHA ÖNCE YUKLENMİŞMİ KONTROL EDİLİYOR SETUP ADINA GÖRE//
	if ($dosya_sorgu2)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosya_yukle.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_108,
	'{YONLENDIRME}' => $kp_yonetim_109,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}
	



	// DOSYA BOYUTU KONTROL EDİLİYOR //
	elseif ($dosya_boyut > 2097952)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosya_yukle.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_yonetim_105,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}

	//	DOSYA YÜKLEMEDE HATA OLURSA - DOSYA 2`MB. DAN BÜYÜKSE	//

	elseif ( (isset($dosya_hata)) AND ($dosya_hata = 0) )
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosya_yukle.php',
	'{ILETI}' => $kp_yonetim_122,
	'{EK_YAZI}' => $kp_yonetim_123,
	'{YONLENDIRME}' => $kp_yonetim_124,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}

	// DOSYA UZANTISI KONTROL EDİLİYOR //
	elseif ($dosya_uzanti2!=".zip" and $dosya_uzanti2!=".rar" and $dosya_uzanti2!=".tar" and $dosya_uzanti2!=".bz2" and $dosya_uzanti2!=".exe" and $dosya_uzanti3!=".gz" and $dosya_uzanti3!=".bz")
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosya_yukle.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_yonetim_104,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}
	else
	{

	// DOSYA DOSYALAR KLASÖRÜNE KOPYALANIYOR //
	$dosya_yukle = @move_uploaded_file($dosya_kaynak,$dosya_hedef.'/'.$dosya_yeni_adi); 
	

	// DOSYA BİLGİLERİ VERİ TABANINA KAYDEDİLİYOR - BAŞLANGICI //
	$dosya_adresi = @zkTemizle('http://'.$ayarlar['alanadi'].$ayarlar['f_dizin'].'/portal/dosyalar/'.$dosya_yeni_adi.'');

	}
	
	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosya_yukle.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_272,
	'{YONLENDIRME}' => '',
	'{YONLENDIRME2}' => $kp_yonetim_106);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}
	
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

	$vtsorgu = "INSERT INTO $tablo_portal_indir (tarih, dosya_baslik, dosya_boyutu, dosya_adresi, dosya_aciklama, ekleyen, ekleyen_ip, bbcode_kullan,kategorino,uretici,dil,kullanim,setup_adi,resim)";

	$vtsorgu .= "VALUES ('$tarih','$_POST[dosya_baslik]','$_POST[dosya_boyutu]','$dosya_adresi','$_POST[mesaj_icerik]',
	'$kullanici_kim[kullanici_adi]', '$_SERVER[REMOTE_ADDR]', '$bbcode_kullan','$_POST[kategorino]','$_POST[uretici]','$_POST[dil]','$_POST[kullanim]','$dosya_yeni_adi','$_POST[resim]')";
	$vtsonuc5 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	if($dosya_yukle)
	{
	header('Location: dosya_yukle.php?bilgi=iletisi');
	}
	else
	{ 
	// Chmod(777)  uyarisi.
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosya_yukle.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_107,
	'{YONLENDIRME}' => '',
	'{YONLENDIRME2}' => $kp_yonetim_106);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}

	
	endif;

	exit();
	}

	// DOSYA BİLGİLERİ VERİ TABANINA KAYDEDİLİYOR - SONU //
	// YENİ DOSYA VERİTABANINA EKLENİYOR - SONU //


	// KATEGORİ EKLENİYOR - BAŞLANGICI //

	if ($kosul == "kategori_ekle")
	{
	$tarih = time();

	//	FORM DOLU MU ?	//
	if (( strlen(utf8_decode($_POST['kategoriadi'])) >  100) OR ( strlen($_POST['kategoriadi']) <  3) )
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'dosya_yukle.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_288,
	'{YONLENDIRME}' => '',
	'{YONLENDIRME2}' => $kp_yonetim_106);

	yonetim_hata_iletileri($ileti_sonuc);
	
	exit();
	}

	else
	{

	if ((isset($_POST['kayit_yapildi_mi'])) AND ($_POST['kayit_yapildi_mi'] == 'form_dolu')):

	$_POST['kategoriadi'] = @zkTemizle2($_POST['kategoriadi']);

	$vtsorgu = "INSERT INTO $tablo_portal_indirkategori (kategoriadi)";

	$vtsorgu .= "VALUES ('$_POST[kategoriadi]')";
	$vtsonuc5 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());


	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => 'dosya_yukle.php',
	'{ILETI}' => '<meta target="_top" http-equiv="Refresh" content="3; url=dosya_yukle.php">',
	'{EK_YAZI}' => $kp_dil_406,
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	endif;

	}
	exit();
	}
	// KATEGORİ EKLENİYOR -  SONU //


	// KATEGORİ SİLİNİYOR - BAŞLANGICI //



	if ($kosul == "kategori_sil")
	{
	
	// Sil Anahtarı Kontrol Ediliyor //
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'dosya_yukle.php',
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

	$_POST['kategorino'] = @zkTemizle($_POST['kategorino']);

	$vtsorgu = "DELETE FROM $tablo_portal_indirkategori WHERE kategorino='$_POST[kategorino]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "SELECT setup_adi FROM $tablo_portal_indir WHERE kategorino='$_POST[kategorino]'";
	$vtsonuc1 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	while ($vtsonuc111 = $vt->fetch_assoc($vtsonuc1)):

	@unlink('dosyalar/'.$vtsonuc111['setup_adi'].'');

	$vtsorgu = "DELETE FROM $tablo_portal_indir WHERE kategorino='$_POST[kategorino]'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu2 = "DELETE FROM $tablo_portal_indiryorum WHERE kategorino='$_POST[kategorino]'";
	$vtsonuc2 = $vt->query($vtsorgu2) or die ($vt->hata_ver());

	endwhile;


	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => 'dosya_yukle.php',
	'{ILETI}' => '<meta target="_top" http-equiv="Refresh" content="3; url=dosya_yukle.php">',
	'{EK_YAZI}' => $kp_dil_407,
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);

	exit();

	}

	// KATEGORİ SİLİNİYOR - SONU //


	$sayfa_adi = 'Dosya Yükleme Sayfası';
	if (!defined('DOSYA_YONETIM_BASLIK')) include 'phpkf-bilesenler/yonetim_sayfa_baslik.php';
	menu();

	$Sorgu = "SELECT * FROM $tablo_portal_indirkategori order by kategorino DESC";
	$kategori_sonuc = @$vt->query($Sorgu) or die ($vt->hata_ver());
	
	$dongule = '';
	
	while ($kategoriler = $vt->fetch_array($kategori_sonuc)):
	
	$dongule .='<option value="'.$kategoriler['kategorino'].'">'.$kategoriler['kategoriadi'].'</option>';
	
	endwhile;
	
	if (!$vt->num_rows($kategori_sonuc)) $dongule .='';

	$Sorgu = "SELECT * FROM $tablo_portal_indirkategori order by kategorino DESC";
	$kategori_sonuc = @$vt->query($Sorgu) or die ($vt->hata_ver());

	$dongule2 = '';
	
	while ($kategoriler = $vt->fetch_array($kategori_sonuc)):

	$dongule2 .='<option value="'.$kategoriler['kategorino'].'">'.$kategoriler['kategoriadi'].'</option>';

	endwhile;

	if (!$vt->num_rows($kategori_sonuc)) $dongule2 .='';

	if ($ayarlar['bbcode'] == 1): 
	$bbcode_sonucu = '<label style="cursor: pointer;">
	<input type="checkbox" name="bbcode_kullan" checked="checked">'.$kp_yonetim_62.'</label>';

	else: $bbcode_sonucu = '&nbsp;'.$kp_yonetim_63.'';

	endif;


$java = '<script type="text/javascript">
<!-- //
function yukle(yukleniyorr)
{
	var yukleniyor = document.getElementById(yukleniyorr);

	if (document.getElementById)
	{
		if(yukleniyor.style.background==\'url(temalar/varsayilan/resimler/resimler/indiriliyor2.gif) no-repeat\')
		{
			yukleniyor.style.background=\'url(temalar/varsayilan/resimler/resimler/indiriliyor.gif) no-repeat\';
			yukleniyor.style.padding=\'0px 3px 0px 3px\';
		}
		else
		{
			yukleniyor.style.background=\'url(temalar/varsayilan/resimler/resimler/indiriliyor2.gif) no-repeat\';
			yukleniyor.style.padding=\'0px 3px 0px 3px\';
			
		}
	}
}
//  -->
</script>';


	$dongu_yok = array(
	'{SECENEKLER}' => $dongule,
	'{SECENEKLER2}' => $dongule2,
	'{JAVA_SCRIPT}' => $java,
	'{HTML}' => $kp_yonetim_279,
	'{BBCODE}' => $kp_yonetim_280,
	'{DUZ_METIN_DUZENLEYICI}' => $kp_dil_417, 
	'{DOSYA_EKKLE2}' => $kp_yonetim_276, 
	'{DOSYA_EKKLE}' => $kp_yonetim_275, 
	'{DOSYA_YUKKLEE2}' => $kp_yonetim_274, 
	'{DOSYA_YUKKLEE}' => $kp_yonetim_273, 
	'{PORTAL_ARKA_TABLO_RENGI}' => $arka_tablo, 
	'{AZAMI_BOYUT}' => $kp_yonetim_169, 
	'{ORNEK}' => $kp_yonetim_170, 
	'{KATEGORI_EKLE}' => $kp_yonetim_81, 
	'{KATEGORI_ADI}' => $kp_yonetim_76, 
	'{SILINECEK_KATEGORI}' => $kp_yonetim_77, 
	'{KATEGORI_NO}' => $kategoriler['kategorino'], 
	'{KATEGORI_ADI}' => $kategoriler['kategoriadi'], 
	'{KATEGORIYI_SIL}' => $kp_yonetim_80, 
	'{SIL_UYARISI2}' => $kp_dil_398,  
	'{DOSYA_EKLE}' => $kp_yonetim_100, 
	'{KATEGORI_SEC}' => $kp_yonetim_79, 
	'{DOSYA_BASLIK}' => $kp_dil_102, 
	'{DOSYA_BOYUTU}' => $kp_dil_110, 
	'{URETICI}' => $kp_yonetim_90, 
	'{KULLANIM}' => $kp_yonetim_91, 
	'{FREEWARE/Ucretsiz}' => $kp_yonetim_92, 
	'{SOFTWARE/Ucretli}' => $kp_yonetim_93, 
	'{SHAREWARE/Deneme}' => $kp_yonetim_94,  
	'{RESIM}' => $kp_yonetim_95, 
	'{DIL}' => $kp_yonetim_96,  
	'{DOSYA_SEC}' => $kp_yonetim_101,
	'{DOSYA_ACIKLAMA}' => $kp_yonetim_66,
	'{FORM_ICERIK}' => '',
	'{BBCODE_KULLAN}' => $kp_yonetim_62, 
	'{BBCODE_KAPALI}' => $kp_yonetim_63, 
	'{GONDER}' => $kp_yonetim_64, 
	'{TEMIZLE}' => $kp_yonetim_65,
	'{YAZI_RENGI}' => $kp_yonetim_67, 
	'{YAZI_BOYUTU}' => $kp_yonetim_68, 
	'{NORMAL}' => $kp_yonetim_69, 
	'{VARSAYILAN}' => $kp_yonetim_70, 
	'{KATEGORI_EKLE_SAYFASI_1}' => 'dosya_yukle.php?kosul=kategori_ekle', 
	'{KATEGORI_SIL_SAYFASI_1}' => 'dosya_yukle.php?kosul=kategori_sil&amp;anahtar='.$portal_ayarlar['sil_anahtar'], 
	'{DOSYA_EKLE_SAYFASI_1}' => 'dosya_yukle.php?kosul=dosya_ekle',
	'{BUYUK}' => $kp_yonetim_117);


	$bbcode = array('{BBCODE_SONUCU}' => $bbcode_sonucu);

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'yonetim/temalar/'.$temadizini.'/dosya_yukle.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));
	$ornek1->dongusuz($dongu_yok);
	$ornek1->dongusuz($bbcode);
	eval(TEMA_UYGULA);

?>