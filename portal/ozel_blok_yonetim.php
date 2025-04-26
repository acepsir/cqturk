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
	if (!defined('DOSYA_HATA')) include 'hata.php';
	if (!defined('DOSYA_DILAYAR')) include 'diller/dil_ayarlari.php';
	if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';


	/************************************************/
	/************************************************/
	
	// CHMOD UYARISI //
	if ((isset($_GET['bilgi'])) AND ($_GET['bilgi'] == 'iletisi'))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './ozel_blok_yonetim.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_dil_402,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();	
	}
	// CHMOD UYARISI - SONU //
	

	if ((isset($_GET['bilgi'])) AND ($_GET['bilgi'] == 'iletisi2'))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './blok_yonetim.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_343.'...',
	'{YONLENDIRME}' => $ileti__5,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();	
	}

	if ($kosul == 'dosya_duzelt')
	{
	
	$sorgu22 = $vt->query("select dosya_adi from $tablo_portal_sayfa where sayfa_no='$_POST[sayfa_no]' limit 1") or die ($vt->hata_ver());
	$sorgu_sonuc2 = $vt->fetch_assoc($sorgu22);
	
	$_POST['dosya_adi'] = zkTemizle2($_POST['dosya_adi']);
	
	$dosya = @fopen('./bloklar/'.$_POST['dosya_adi'].''.$_POST['uzanti'].'','w') or die(header('Location: ./ozel_blok_yonetim.php?bilgi=iletisi'));
	@fclose($dosya);
	
	if ($_POST['dosya_adi'] != $sorgu_sonuc2['dosya_adi'])
	{
	@unlink('bloklar/'.$sorgu_sonuc2['dosya_adi'].'');
	}
	
	if ($_POST['dosya_adi'] == 'index')
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './ozel_blok_yonetim.php',
	'{ILETI}' => $kp_yonetim_252,
	'{EK_YAZI}' => $kp_yonetim_253,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();	
	}
	
	$bul = array(' ','ş','Ş','ü','Ü','ö','Ö','ç','Ç','ğ','Ğ','ı','İ','-',',','*','<','>','+','/','-','?','!','{','}','(',')','&','%','$','#','^','[',']','|',"'",'<?','<?php','<%');
	$cvr = array('_','s','S','u','U','o','O','c','C','g','G','i','I','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','','<html>','<html>','<html>');
	
	$_POST['dosya_adi'] = str_replace($bul,$cvr,$_POST['dosya_adi']);

	//	magic_quotes_gpc açıksa	//
	if (get_magic_quotes_gpc())
	{
		$_POST['dosya_adi'] = @zkTemizle2(stripslashes($_POST['dosya_adi']));
		$_POST['baslik'] = @zkTemizle2(stripslashes($_POST['baslik']));
		$_POST['mesaj_icerik'] = stripslashes($_POST['mesaj_icerik']);
	}
	
	//	magic_quotes_gpc kapalıysa	//
	else
	{
		$_POST['dosya_adi'] = @zkTemizle2($_POST['dosya_adi']);
		$_POST['baslik'] = @zkTemizle2($_POST['baslik']);
	}
	$bul = array('<?','<?php','<%');
	$cvr = array('<html>','<html>','<html>');
	
	$_POST['mesaj_icerik'] = str_replace($bul,$cvr,$_POST['mesaj_icerik']);
	
	$dosya = @fopen('./bloklar/'.$_POST['dosya_adi'].''.$_POST['uzanti'].'','w') or die(header('Location: ./ozel_blok_yonetim.php?bilgi=iletisi'));
	@fwrite($dosya,$_POST['mesaj_icerik']);
	@fclose($dosya);
	
	$dosya_adresi = @zkTemizle('http://'.$_SERVER['HTTP_HOST'].''.dirname($_SERVER['PHP_SELF']).'/bloklar/'.$_POST['dosya_adi'].''.$_POST['uzanti'].'');
	
	$sql = "update $tablo_portal_sayfa SET baslik='$_POST[baslik]',dosya_adi='$_POST[dosya_adi]$_POST[uzanti]',dosya_adresi='$dosya_adresi',yer='2',uzanti='$_POST[uzanti]' where sayfa_no='$_POST[sayfa_no]'";
	$sql_sonuc = $vt->query($sql) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());


	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './blok_yonetim.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_344.'...',
	'{YONLENDIRME}' => $ileti__5,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}
	
	
	/************************************************/
	/************************************************/
	
	if ($kosul == 'sil')
	{
	
	############################################################
	############################################################
	
	
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'blok_yonetim.php',
	'{ILETI}' => $kp_yonetim_369,
	'{EK_YAZI}' => $kp_yonetim_370,
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
	
	############################################################
	############################################################
	
	$sorgu1 = $vt->query("select dosya_adi,kosul_adi from $tablo_portal_sayfa where sayfa_no='$_GET[sil]' AND yer='2' limit 1") or die ($vt->hata_ver());
	$sorgu_sonuc = $vt->fetch_assoc($sorgu1);
	
	@unlink('bloklar/'.$sorgu_sonuc['dosya_adi']);
	
	$sorgu2 = $vt->query("delete from $tablo_portal_sayfa where sayfa_no='$_GET[sil]' AND yer='2' limit 1") or die ($vt->hata_ver());
	$sorgu2 = $vt->query("delete from $tablo_portal_bloklar where blok_ad='$sorgu_sonuc[kosul_adi]' limit 1") or die ($vt->hata_ver());
	
	header('Location: ./ozel_blok_yonetim.php?bilgi=iletisi2');
	
	exit();
	}
	
	/************************************************/
	/************************************************/
	
	if ($kosul == 'duzelt')
	{
	
	############################################################
	############################################################
	
	
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'blok_yonetim.php',
	'{ILETI}' => $kp_yonetim_369,
	'{EK_YAZI}' => $kp_yonetim_370,
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
	
	############################################################
	############################################################


	$sayfa_adi = 'Özel Bloklar Sayfası';
	if (!defined('DOSYA_YONETIM_BASLIK')) include 'phpkf-bilesenler/yonetim_sayfa_baslik.php';
	menu();

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'yonetim/temalar/'.$temadizini.'/ozel_blok_yonetim.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));

	$ornek1->kosul('1',array('{}' => ''), false);


	$sorgu_sql1 = $vt->query("select baslik,dosya_adi,yer,uzanti,sayfa_no from $tablo_portal_sayfa where sayfa_no='$_GET[duzelt]' AND yer='2'") or die ($vt->hata_ver());
	$vtsonuc5 = $vt->fetch_assoc($sorgu_sql1);


	$dosya = './bloklar/'.$vtsonuc5['dosya_adi'];
	if (@fopen($dosya,'r') != '')
	{

	$dosya_ac = @fopen($dosya,'r');
	$form_icerik = '';

	while (! @feof($dosya_ac))
	{
	$yazdir = @fread($dosya_ac,filesize($dosya));
	$form_icerik .= $yazdir;
	}

	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './ozel_blok_yonetim.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_261,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}


	@fclose($dosya_ac);


	if ($vtsonuc5['uzanti'] == '.php') $uzanti_sonuc = mb_substr($vtsonuc5['dosya_adi'],0,-4, 'utf-8');
	else $uzanti_sonuc = mb_substr($vtsonuc5['dosya_adi'],0,-5, 'utf-8');

	if (!isset($form_icerik)) $form_icerik = '';

	$ornek1->dongusuz(array(
	'{BASLIK}' => $vtsonuc5['baslik'],
	'{DOSYA_ADI}' => $uzanti_sonuc,
	'{SAYFA_NO}' => $vtsonuc5['sayfa_no'],
	'{DUZ_METIN_DUZENLEYICI}' => $kp_dil_417,
	'{ACTION}' => "ozel_blok_yonetim.php?kosul=dosya_duzelt",
	'{YENI_BLOK_OLUSTUR}' => $kp_yonetim_341,
	'{GORUNECEK_BASLIK}' => $kp_yonetim_249,
	'{DOSYA_ADI22}' => $kp_yonetim_250,
	'{UZANTI_2}' => $kp_yonetim_242,
	'{BLOK_KODLARI}' => $kp_yonetim_338,
	'{BLOK_TEMIZLE}' => $kp_yonetim_339,
	'{BLOK_OLUSTUR}' => $kp_yonetim_342,
	'{FORM_ICERIK}' => $form_icerik));


	eval(TEMA_UYGULA);

	exit();
	}
	
	/************************************************/
	/************************************************/

	if ($kosul == 'yeni_blok')
	{
	
	$sorgu22 = $vt->query("select dosya_adi from $tablo_portal_sayfa where dosya_adi='$_POST[dosya_adi]$_POST[uzanti]' AND yer='2'") or die('sorgu başarısız !');
	$sorgu_sonuc2 = $vt->fetch_assoc($sorgu22);
	
	if ($_POST['dosya_adi'].$_POST['uzanti'] == $sorgu_sonuc2['dosya_adi'])
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './ozel_blok_yonetim.php',
	'{ILETI}' => $kp_dil_400,
	'{EK_YAZI}' => $kp_dil_401,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);
	
	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}
	
	if ($_POST['dosya_adi'].$_POST['uzanti'] == $sorgu_sonuc2['dosya_adi'])
	{
	$sorgu2 = $vt->query("delete from $tablo_portal_sayfa where dosya_adi='$_POST[dosya_adi]$_POST[uzanti]' AND yer='2'") or die ($vt->hata_ver());
	}
	
	
	if ($_POST['dosya_adi'] == 'index')
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './ozel_blok_yonetim.php',
	'{ILETI}' => $kp_yonetim_252,
	'{EK_YAZI}' => $kp_yonetim_253,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();	
	}
	
	$bul = array(' ','ş','Ş','ü','Ü','ö','Ö','ç','Ç','ğ','Ğ','ı','İ','-',',','*','<','>','+','/','-','?','!','{','}','(',')','&','%','$','#','^','[',']','|',"'",'<?','<?php','<%');
	$cvr = array('_','s','S','u','U','o','O','c','C','g','G','i','I','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','','<html>','<html>','<html>');
	
	$_POST['dosya_adi'] = @str_replace($bul,$cvr,$_POST['dosya_adi']);
	//	magic_quotes_gpc açıksa	//
	if (get_magic_quotes_gpc())
	{
		$_POST['dosya_adi'] = @zkTemizle2(stripslashes($_POST['dosya_adi']));
		$_POST['baslik'] = @zkTemizle2(stripslashes($_POST['baslik']));
		$_POST['mesaj_icerik'] = stripslashes($_POST['mesaj_icerik']);
	}
	
	//	magic_quotes_gpc kapalıysa	//
	else
	{
		$_POST['dosya_adi'] = @zkTemizle2($_POST['dosya_adi']);
		$_POST['baslik'] = @zkTemizle2($_POST['baslik']);
	}
	
	$rand = mb_substr(md5(uniqid(rand())),0,19, 'utf-8');
	
	
	
	$bul = array('<?','<?php','<%');
	$cvr = array('<html>','<html>','<html>');
	
	$_POST['mesaj_icerik'] = str_replace($bul,$cvr,$_POST['mesaj_icerik']);
	
	if ((isset($_POST['mesaj_icerik'])) AND ($_POST['mesaj_icerik'] !='') AND ($_POST['baslik'] !='') AND ($_POST['dosya_adi'] !=''))
	{
	@touch('./bloklar/'.$_POST['dosya_adi'].''.$_POST['uzanti'].'') or die(header('Location: ./ozel_blok_yonetim.php?bilgi=iletisi'));
	$dosya = @fopen('./bloklar/'.$_POST['dosya_adi'].''.$_POST['uzanti'].'','w') or die($kp_dil_403.':  /bloklar/'.$_POST['dosya_adi'].''.$_POST['uzanti']);
	@fwrite($dosya,$_POST['mesaj_icerik']) or die("$kp_yonetim_262");
	@fclose($dosya);
	
	$tarih = @time();
	$dosya_adresi = @zkTemizle('http://'.$_SERVER['HTTP_HOST'].''.dirname($_SERVER['PHP_SELF']).'/bloklar/'.$_POST['dosya_adi'].''.$_POST['uzanti'].'');
	
	$sql = "insert into $tablo_portal_sayfa (tarih,baslik,dosya_adi,dosya_adresi,kosul_adi,yer,uzanti)";
	$sql .= "values('$tarih','$_POST[baslik]','$_POST[dosya_adi]$_POST[uzanti]','$dosya_adresi','$rand','2','$_POST[uzanti]')";
	$sql_sonuc = $vt->query($sql) or die ($vt->hata_ver());
	
	$sorgu_BASLAT ="select blok_id from $tablo_portal_bloklar order by blok_id desc limit 1";
	$sorgu_sonuc = $vt->query($sorgu_BASLAT) or die ($vt->hata_ver());
	$id_sonuc = $vt->fetch_array($sorgu_sonuc);
	
	$yeni_id = $id_sonuc['blok_id']+'1';
		
	$sorgu_BASLAT3 ="select * from $tablo_portal_bloklar WHERE blok_yer='$_POST[yer]' order by blok_sira desc limit 1";
	$sorgu_sonuc3 = $vt->query($sorgu_BASLAT3) or die ($vt->hata_ver());
	$yer_sonuc = $vt->fetch_array($sorgu_sonuc3);
	
	$gidecegi_yer = $yer_sonuc['blok_sira']+'1';
	
	$portal_bloklar = "INSERT INTO $tablo_portal_bloklar VALUES ('$yeni_id', '$rand', '$_POST[yer]', $gidecegi_yer, 1);";
	$portal_bloklar_sonuc = $vt->query($portal_bloklar) or die ($vt->hata_ver());
	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './ozel_blok_yonetim.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_286,
	'{YONLENDIRME}' => $ileti__5,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './blok_yonetim.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_345.'...',
	'{YONLENDIRME}' => $ileti__5,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}

	/************************************************/
	/************************************************/



	$sayfa_adi = 'Özel Bloklar Sayfası';
	if (!defined('DOSYA_YONETIM_BASLIK')) include 'phpkf-bilesenler/yonetim_sayfa_baslik.php';
	menu();

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'yonetim/temalar/'.$temadizini.'/ozel_blok_yonetim.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));


	if (!isset($form_icerik)) $form_icerik = '';

	$ornek1->dongusuz(array(
	'{DUZ_METIN_DUZENLEYICI}' => $kp_dil_417,
	'{ACTION}' => "ozel_blok_yonetim.php?kosul=yeni_blok",
	'{YENI_BLOK_OLUSTUR}' => $kp_yonetim_333,
	'{GORUNECEK_BASLIK}' => $kp_yonetim_334,
	'{BASLIK}' => $kp_yonetim_239,
	'{DOSYA_ADI22}' => $kp_yonetim_240,
	'{DOSYA_ADI}' => $kp_yonetim_241,
	'{UZANTI_2}' => $kp_yonetim_242,
	'{BLOK_YERI}' => $kp_yonetim_335,
	'{SAG}' => $kp_yonetim_336,
	'{SOL}' => $kp_yonetim_337,
	'{BLOK_KODLARI}' => $kp_yonetim_338,
	'{BLOK_TEMIZLE}' => $kp_yonetim_339,
	'{BLOK_OLUSTUR}' => $kp_yonetim_340,
	'{FORM_ICERIK}' => $form_icerik));


	eval(TEMA_UYGULA);


?>