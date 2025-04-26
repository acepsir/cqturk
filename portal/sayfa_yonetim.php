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

	$sayfa_adi = 'Özel Sayfalar Sayfası';
	if (!defined('DOSYA_YONETIM_BASLIK')) include 'phpkf-bilesenler/yonetim_sayfa_baslik.php';

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'yonetim/temalar/'.$temadizini.'/sayfa_yonetim.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));


	if (isset($_GET['kosul'])) $kosul = $_GET['kosul'];
	else $kosul = '';


	/************************************************/
	/************************************************/

	// CHMOD UYARISI //
	if ((isset($_GET['bilgi'])) AND ($_GET['bilgi'] == 'iletisi'))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './sayfa_yonetim.php',
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
	'{ADRES}' => './sayfa_yonetim.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_267.'...',
	'{YONLENDIRME}' => $ileti__5,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}


	if ($kosul == 'dosya_duzelt')
	{
	
	$sorgu22 = $vt->query("select dosya_adi from $tablo_portal_sayfa where sayfa_no='$_POST[sayfa_no]' AND yer!='2' limit 1") or die ($vt->hata_ver());
	$sorgu_sonuc2 = $vt->fetch_assoc($sorgu22);
	
	$_POST['dosya_adi'] = zkTemizle2($_POST['dosya_adi']);
	
	$dosya = @fopen('./sayfalar/'.$_POST['dosya_adi'].''.$_POST['uzanti'].'','w') or die(header('Location: ./sayfa_yonetim.php?bilgi=iletisi'));
	@fclose($dosya);
	
	if ($_POST['dosya_adi'] != $sorgu_sonuc2['dosya_adi'])
	{
	@unlink('sayfalar/'.$sorgu_sonuc2['dosya_adi'].'');
	}
	
	if ($_POST['dosya_adi'] == 'index')
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './sayfa_yonetim.php',
	'{ILETI}' => $kp_yonetim_252,
	'{EK_YAZI}' => $kp_yonetim_253,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();	
	}
	
	$bul = array(' ','ş','Ş','ü','Ü','ö','Ö','ç','Ç','ğ','Ğ','ı','İ','-',',','*','<','>','+','/','-','?','!','{','}','(',')','&','%','$','#','^','[',']','|',"'",'<?','<?php','<%','\\','"',"'","=");
	$cvr = array('_','s','S','u','U','o','O','c','C','g','G','i','I','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','','<html>','<html>','<html>','','','','');
	
	$_POST['dosya_adi'] = @str_replace($bul,$cvr,$_POST['dosya_adi']);
	
	$bul2 = array('-',',','*','<','>','+','/','-','?','!','{','}','(',')','&','%','$','#','^','[',']','|',"'",'<?','<?php','<%','\\','"',"'","=");
	$cvr2 = array('_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','','<html>','<html>','<html>','','','','');
	
	$_POST['baslik'] = @str_replace($bul2,$cvr2,$_POST['baslik']);

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
	
	$dosya = @fopen('./sayfalar/'.$_POST['dosya_adi'].''.$_POST['uzanti'].'','w') or die(header('Location: ./sayfa_yonetim.php?bilgi=iletisi'));
	@fwrite($dosya,$_POST['mesaj_icerik']);
	@fclose($dosya);
	
	$dosya_adresi = @zkTemizle('http://'.$_SERVER['HTTP_HOST'].''.dirname($_SERVER['PHP_SELF']).'/sayfalar/'.$_POST['dosya_adi'].''.$_POST['uzanti'].'');
	
	$sql = "update $tablo_portal_sayfa SET baslik='$_POST[baslik]',dosya_adi='$_POST[dosya_adi]$_POST[uzanti]',dosya_adresi='$dosya_adresi',yer='$_POST[yer]',uzanti='$_POST[uzanti]' where sayfa_no='$_POST[sayfa_no]' AND yer!='2'";
	$sql_sonuc = $vt->query($sql) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());


	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './sayfa_yonetim.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_254.'...',
	'{YONLENDIRME}' => $ileti__5,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}
	
	
	/************************************************/
	/************************************************/
	
	if ($kosul == 'sil')
	{
	$sorgu1 = $vt->query("select dosya_adi from $tablo_portal_sayfa where sayfa_no='$_POST[sil]' AND yer!='2' limit 1") or die ($vt->hata_ver());
	$sorgu_sonuc = $vt->fetch_assoc($sorgu1);
	
	@unlink('sayfalar/'.$sorgu_sonuc['dosya_adi']);
	
	$sorgu2 = $vt->query("delete from $tablo_portal_sayfa where sayfa_no='$_POST[sil]' AND yer!='2'  limit 1") or die ($vt->hata_ver());
	
	header('Location: ./sayfa_yonetim.php?bilgi=iletisi2');
	
	exit();
	}
	
	/************************************************/
	/************************************************/
	
	if ($kosul == 'duzelt')
	{
	$ornek1->kosul('1',array('{}' => ''), false);

	menu();

	$sorgu_sql1 = $vt->query("select baslik,dosya_adi,yer,uzanti,sayfa_no from $tablo_portal_sayfa where sayfa_no='$_POST[duzelt]' AND yer!='2'") or die ($vt->hata_ver());
	$vtsonuc5 = $vt->fetch_assoc($sorgu_sql1);
		

	############################
	############################
	
	$yer = '<option value="1"';

	if ($vtsonuc5['yer'] == '1') 
	$yer .= ' selected="selected"';

	$yer .= '>'.$kp_yonetim_244.'</option>';
	
	
	$yer .= '<option value="0"';

	if ($vtsonuc5['yer'] == '0') 
	$yer .= ' selected="selected"';

	$yer .= '>'.$kp_yonetim_245.'</option>';
	
	############################
	
	

	$dosya = './sayfalar/'.$vtsonuc5['dosya_adi'];
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
	'{ADRES}' => './sayfa_yonetim.php',
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
	
	
	
	$ornek1->dongusuz(array(
	'{DUZ_METIN_DUZENLEYICI}' => $kp_dil_417,
	'{ACIKLAMA2}' => "",
	'{YENI_SAYFA_OLUSTUR}' => $kp_yonetim_248,
	'{ACTION}' => "sayfa_yonetim.php?kosul=dosya_duzelt",
	'{GORUNECEK_BASLIK}' => $kp_yonetim_249,
	'{YENI_SAYFA}' => $kp_yonetim_239,
	'{DOSYA_ADI22}' => $kp_yonetim_250,
	'{YENI_SAYFA2}' => $kp_yonetim_241,
	'{SAYFA_YERI}' => $kp_yonetim_243,
	'{YER}' => $yer,
	'{BASLIK}' => $vtsonuc5['baslik'],
	'{DOSYA_ADI}' => $uzanti_sonuc,
	'{SAYFA_NO}' => $vtsonuc5['sayfa_no'],
	'{SAYFA_ICERIGI}' => $kp_yonetim_246,
	'{SAYFAYI_OLUSTUR}' => $kp_yonetim_251,
	'{FORM_ICERIK}' => $form_icerik));


	
	eval(TEMA_UYGULA);
	
	exit();
	}
	
	/************************************************/
	/************************************************/

	if ($kosul == 'yeni_sayfa')
	{
	
	$sorgu22 = $vt->query("select dosya_adi from $tablo_portal_sayfa where dosya_adi='$_POST[dosya_adi]$_POST[uzanti]'") or die ($vt->hata_ver());
	
	while ($sorgu_sonuc2 = $vt->fetch_assoc($sorgu22))
	{
	
	if ($dosya = $_POST['dosya_adi'].$_POST['uzanti'] == $sorgu_sonuc2['dosya_adi'])
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './sayfa_yonetim.php',
	'{ILETI}' => $kp_dil_400,
	'{EK_YAZI}' => $kp_dil_401,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);
	
	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}
	}
	
	if ($_POST['dosya_adi'].$_POST['uzanti'] == $sorgu_sonuc2['dosya_adi'])
	{
	$sorgu2 = $vt->query("delete from $tablo_portal_sayfa where dosya_adi='$_POST[dosya_adi]$_POST[uzanti]' AND yer!='2'") or die ($vt->hata_ver());
	}
	
	
	if ($_POST['dosya_adi'] == 'index')
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './sayfa_yonetim.php',
	'{ILETI}' => $kp_yonetim_252,
	'{EK_YAZI}' => $kp_yonetim_253,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();	
	}
	
	$bul = array(' ','ş','Ş','ü','Ü','ö','Ö','ç','Ç','ğ','Ğ','ı','İ','-',',','*','<','>','+','/','-','?','!','{','}','(',')','&','%','$','#','^','[',']','|',"'",'<?','<?php','<%','\\','"',"'","=");
	$cvr = array('_','s','S','u','U','o','O','c','C','g','G','i','I','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','','<html>','<html>','<html>','','','','');
	
	$_POST['dosya_adi'] = @str_replace($bul,$cvr,$_POST['dosya_adi']);
	
	$bul2 = array('-',',','*','<','>','+','/','-','?','!','{','}','(',')','&','%','$','#','^','[',']','|',"'",'<?','<?php','<%','\\','"',"'","=");
	$cvr2 = array('_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','','<html>','<html>','<html>','','','','');
	
	$_POST['baslik'] = @str_replace($bul2,$cvr2,$_POST['baslik']);
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
	@touch('./sayfalar/'.$_POST['dosya_adi'].''.$_POST['uzanti'].'') or die(header('Location: ./sayfa_yonetim.php?bilgi=iletisi'));
	$dosya = @fopen('./sayfalar/'.$_POST['dosya_adi'].''.$_POST['uzanti'].'','w') or die($kp_dil_403.':  /sayfalar/'.$_POST['dosya_adi'].''.$_POST['uzanti']);
	@fwrite($dosya,$_POST['mesaj_icerik']) or die("$kp_yonetim_262");
	@fclose($dosya);
	
	$tarih = @time();
	$dosya_adresi = @zkTemizle('http://'.$_SERVER['HTTP_HOST'].''.dirname($_SERVER['PHP_SELF']).'/sayfalar/'.$_POST['dosya_adi'].''.$_POST['uzanti'].'');
	
	$sql = "insert into $tablo_portal_sayfa (tarih,baslik,dosya_adi,dosya_adresi,kosul_adi,yer,uzanti)";
	$sql .= "values('$tarih','$_POST[baslik]','$_POST[dosya_adi]$_POST[uzanti]','$dosya_adresi','$rand','$_POST[yer]','$_POST[uzanti]')";
	$sql_sonuc = $vt->query($sql) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());
	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './sayfa_yonetim.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_286,
	'{YONLENDIRME}' => $ileti__5,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './sayfa_yonetim.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_255.'...',
	'{YONLENDIRME}' => $ileti__5,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}
	
	/************************************************/
	/************************************************/


	menu();
	$sorgu_sql = $vt->query("select baslik,sayfa_no from $tablo_portal_sayfa where yer!='2'") or die ($vt->hata_ver());
	
	$dongu ='';
	
	while ($vtsonuc = $vt->fetch_assoc($sorgu_sql))
	{
	$dongu .= '<option value="'.$vtsonuc['sayfa_no'].'">'.$vtsonuc['baslik'].'</option>';	
	}
	if ($dongu =='')
	{
	$ornek1->dongusuz(array('{KILITLE}' => 'disabled="disabled"'));
	$dongu .='<option value="">'.$kp_yonetim_376.'</option>';	
	}
	else
	{
	$ornek1->dongusuz(array('{KILITLE}' => ''));
	}
	$ornek1->dongusuz(array('{DEGER}' => $dongu));
	
	
	
	/************************************************/
	/************************************************/
	
	$sorgu_sql2 = $vt->query("select baslik,sayfa_no from $tablo_portal_sayfa where yer!='2'") or die ($vt->hata_ver());
	
	$dongu2 ='';
	while ($vtsonuc2 = $vt->fetch_assoc($sorgu_sql2))
	{
	$dongu2 .= '<option value="'.$vtsonuc2['sayfa_no'].'">'.$vtsonuc2['baslik'].'</option>';	
	}
	if ($dongu2 =='')
	{
	$ornek1->dongusuz(array('{KILITLE}' => 'disabled="disabled"'));
	$dongu2 .='<option value="">'.$kp_yonetim_376.'</option>';
	}
	else
	{
	$ornek1->dongusuz(array('{KILITLE}' => ''));
	}
	$ornek1->dongusuz(array('{DEGER2}' => $dongu2));
	
	
	
	
	
	############################
	
	$yer = '<option value="1">'.$kp_yonetim_244.'</option>';
	$yer .= '<option value="0">'.$kp_yonetim_245.'</option>';
	
	############################


	if (!isset($form_icerik)) $form_icerik = '';

	$ornek1->dongusuz(array(
	'{DUZ_METIN_DUZENLEYICI}' => $kp_dil_417,
	'{ACIKLAMA1}' => $kp_yonetim_259,
	'{ACTION}' => "sayfa_yonetim.php?kosul=yeni_sayfa",
	'{ACIKLAMA2}' => $kp_yonetim_260,
	'{SAYFA_DUZELT_SIL}' => $kp_yonetim_258,
	'{YENI_SAYFA_OLUSTUR}' => $kp_yonetim_232,
	'{SAYFA_DUZELT}' => $kp_yonetim_233,
	'{DUZELT}' => $kp_yonetim_234,
	'{SAYFA_SIL}' => $kp_yonetim_235,
	'{SIL}' => $kp_yonetim_236,
	'{SIL_UYARI}' => $kp_yonetim_237,
	'{GORUNECEK_BASLIK}' => $kp_yonetim_238,
	'{YENI_SAYFA}' => $kp_yonetim_239,
	'{DOSYA_ADI22}' => $kp_yonetim_240,
	'{YENI_SAYFA2}' => $kp_yonetim_241,
	'{UZANTI_2}' => $kp_yonetim_242,
	'{SAYFA_YERI}' => $kp_yonetim_243,
	'{YER}' => $yer,
	'{BASLIK}' => $kp_yonetim_239,
	'{DOSYA_ADI}' => $kp_yonetim_241,
	'{SAYFA_ICERIGI}' => $kp_yonetim_246,
	'{SAYFAYI_OLUSTUR}' => $kp_yonetim_247,
	'{SAYFA_DUZELT_SAYFASI}' => $kp_yonetim_248,
	'{GORUNEN_BASLIK}' => $kp_yonetim_249,
	'{DOSYANIN_ADI}' => $kp_yonetim_250,
	'{SAYFAYI_DUZELT}' => $kp_yonetim_251,
	'{FORM_ICERIK}' => $form_icerik));


	eval(TEMA_UYGULA);

?>