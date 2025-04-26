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



	define('DOSYA_DAVETIYE',true);
	$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='3' OR kip='4' OR kip='5'";
	if (!defined('DOSYA_AYAR')) include '../ayar.php';
	if (!defined('DOSYA_GERECLER')) include '../phpkf-bilesenler/gerecler.php';
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_PORTAL_AYARLAR')) include 'portal_ayarlar.php';
	if (!defined('DOSYA_SEC')) include 'sec.php';
	if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';
	if (!defined('DOSYA_SEO')) include '../phpkf-bilesenler/seo.php';
	if (!defined('DOSYA_HATA')) include 'hata.php';
	
	
	// DAVETİYE GÖNDERİLİYOR //
		
	@$davet = $_GET['davet'];
	if ($davet == "gonder")
	{
	
	$sayfa_adi = 'Davetiye Sayfası';
	
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';

	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';
	
	if ($portal_bloklar_ayar['davetiye_sayfasi'] == 0)
		
	{
	
		if ($kullanici_kim['yetki'] == 1)
	
	// mail kime
	$kime = $_POST['aemail'];
	
		}
		
	elseif ($portal_bloklar_ayar['davetiye_sayfasi'] == 1)
		{
		// mail kime
	$kime = $_POST['aemail'];
	
		}
		
	else
		
		{
	
		if (!empty($kullanici_kim['id']))
	
	// mail kime
	$kime = $_POST['aemail'];
	
		} 
	
	

	// bilgiler alınıyor.
	$siteurl = $ayarlar['alanadi'];
	$sitedizin = $ayarlar['f_dizin'];
	$isim = $_POST['isim'];
	$aisim = $_POST['aisim'];
	$email = $_POST['email'];
	$eklenen_mesaj = $_POST['eklenen_mesaj'];
	$form = ''.$siteurl.' Davetiye';
	
	// mesj içeriği hazırlanıyor.
	$mesaj = '
	
	
	'.$siteurl.''.$sitedizin.'

	
	------------------------------------------------------------------------------
	

	'.@$kp_dil_203.' '.@$aisim.'; '.@$isim.' '.@$kp_dil_204.' '.@$siteurl.'`'.@$kp_dil_205.'...


	------------------------------------------------------------------------------
	
	'.@$eklenen_mesaj.'
	
	------------------------------------------------------------------------------
	
	
	'.$siteurl.''.$sitedizin.'
	
	';
	


	// bilgiler kontrol ediliyor.
	if ((empty($isim)) OR (empty($aisim))) {
	

	$ileti_sonuc = array(
	'{ADRES}' => 'davetiye.php',
	'{ILETI}' => $kp_dil_206,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => '',
	'{YONLENDIRME2}' => $kp_dil_207,
	'{ILETI_BASLIK}' => $kp_dil_107);


	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	
	}
	
	if (!@preg_match('/^([~&+.0-9a-z_-]+)@(([~&+0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', $_POST['email']))
	{

	$ileti_sonuc = array(
	'{ADRES}' => 'davetiye.php',
	'{ILETI}' => $kp_dil_208,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => '',
	'{YONLENDIRME2}' => $kp_dil_207,
	'{ILETI_BASLIK}' => $kp_dil_107);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	
	}
	
	if (!@preg_match('/^([~&+.0-9a-z_-]+)@(([~&+0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', $_POST['aemail']))
	{

	$ileti_sonuc = array(
	'{ADRES}' => 'davetiye.php',
	'{ILETI}' => $kp_dil_209,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => '',
	'{YONLENDIRME2}' => $kp_dil_207,
	'{ILETI_BASLIK}' => $kp_dil_107);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	
	//bilgiler kontrol ediliyor - sonu.



 
    //		POSTA YOLLANIYOR		//

	$isim = strtok( $isim, "\r\n" );
	$email = strtok( $email, "\r\n" );

	if (get_magic_quotes_gpc())
	{
        $mesaj = stripslashes( $mesaj );
	}


require('../phpkf-bilesenler/sinif_eposta.php');
$mail = new eposta_yolla();


if ($ayarlar['eposta_yontem'] == 'mail') $mail->MailKullan();
elseif ($ayarlar['eposta_yontem'] == 'smtp') $mail->SMTPKullan();


$mail->sunucu = $ayarlar['smtp_sunucu'];
if ($ayarlar['smtp_kd'] == '1') $mail->smtp_dogrulama = true;
else $mail->smtp_dogrulama = false;
$mail->kullanici_adi = $ayarlar['smtp_kullanici'];
$mail->sifre = $ayarlar['smtp_sifre'];

$mail->gonderen = $email;
$mail->gonderen_adi = $isim;
$mail->GonderilenAdres($kime);
$mail->YanitlamaAdres($email);
$mail->konu = $form;
$mail->icerik =$mesaj;


if ($mail->Yolla())
{
	$ileti_sonuc = array(
	'{ADRES}' => 'davetiye.php',
	'{ILETI}' => $kp_dil_211,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => '',
	'{YONLENDIRME2}' => $kp_dil_207,
	'{ILETI_BASLIK}' => $kp_dil_210);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
}

else
{

	$ileti_sonuc = array(
	'{ADRES}' => 'davetiye.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => '<br><br><center><font color="red">E-posta gönderilemedi !<p><u>Hata iletisi</u>: &nbsp; '.$mail->hata_bilgi.'</p></font></center>',
	'{YONLENDIRME}' => '',
	'{YONLENDIRME2}' => $kp_dil_207,
	'{ILETI_BASLIK}' => $kp_dil_435);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
}


	

	}

	// DAVETİYE GÖNDERİLİYOR - SONU //
	
	// DAVETİYE FORMU //
	
	if ($portal_bloklar_ayar['davetiye_sayfasi'] == 2)
		
	{
	
	
	
	
	$sayfa_adi = 'Davetiye Sayfası';
	
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';

	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';
	
	if (empty($kullanici_kim['id']))
			
			{
				$ileti_sonuc = array(
				'{ADRES}' => '../kayit.php',
				'{ILETI}' => '',
				'{EK_YAZI}' => '',
				'{YONLENDIRME}' => $kp_dil_108,
				'{YONLENDIRME2}' => $ileti__2,
				'{ILETI_BASLIK}' => $ileti_2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
				exit();

			}
	
$java = '<script type="text/javascript">
	<!-- //
	
	function denetle25()
{ 
	var dogruMu = true;
	if ((document.form.isim.value.length < 2) || (document.form.email.value.length < 5) || (document.form.aisim.value.length < 2) || (document.form.aemail.value.length < 5)) 
	{ 
		dogruMu = false; 
		alert(\''.$kp_dil_438.'\');
	}
	return dogruMu;
}
	//  -->
	</script>';
	
	$dongu_yok = array(
	'{JAVA_SCRIPT}' => $java,
	'{DAVETIYE}' => $kp_dil_212, 
	'{ISMINIZ}' => $kp_dil_213, 
	'{E-POSTA_ADRESINIZ}' => $kp_dil_214,
	'{ARKADASINIZIN_ISMI}' => $kp_dil_215, 
	'{ARKADASINIZIN_E-POSTA_ADRESI}' => $kp_dil_216, 
	'{MESAJINIZ}' => $kp_dil_219,
	'{GONDER}' => $kp_dil_217, 
	'{TEMIZLE}' => $kp_dil_218, 
	'{DAVETIYE_GONDER_SAYFASI}' => 'davetiye.php?davet=gonder',
	'{PORTAL_INDEX}' => 'davetiye.php');


	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/davetiye.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));
	$ornek1->dongusuz($dongu_yok);
	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	exit();
			}
		
	elseif ($portal_bloklar_ayar['davetiye_sayfasi'] == 1)
		
		{
	
	
	
	$sayfa_adi = 'Davetiye Sayfası';
	
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';

	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';

	$java = '<script type="text/javascript">
	<!-- //
	
	function denetle25()
{ 
	var dogruMu = true;
	if ((document.form.isim.value.length < 2) || (document.form.email.value.length < 5) || (document.form.aisim.value.length < 2) || (document.form.aemail.value.length < 5)) 
	{ 
		dogruMu = false; 
		alert(\''.$kp_dil_438.'\');
	}
	return dogruMu;
}
	//  -->
	</script>';
	
	$dongu_yok = array(
	'{JAVA_SCRIPT}' => $java,
	'{DAVETIYE}' => $kp_dil_212, 
	'{ISMINIZ}' => $kp_dil_213, 
	'{E-POSTA_ADRESINIZ}' => $kp_dil_214,
	'{ARKADASINIZIN_ISMI}' => $kp_dil_215, 
	'{ARKADASINIZIN_E-POSTA_ADRESI}' => $kp_dil_216, 
	'{MESAJINIZ}' => $kp_dil_219,
	'{GONDER}' => $kp_dil_217, 
	'{TEMIZLE}' => $kp_dil_218,
	'{DAVETIYE_GONDER_SAYFASI}' => 'davetiye.php?davet=gonder',	
	'{PORTAL_INDEX}' => 'davetiye.php');


	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/davetiye.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));
	$ornek1->dongusuz($dongu_yok);
	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	exit();

			}

	else
	{
	if ($kullanici_kim['yetki'] == 1)
	{
	$sayfa_adi = 'Davetiye Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';
	$java = '<script type="text/javascript">
	<!-- //
	function denetle25()
	{
	var dogruMu = true;
	if ((document.form.isim.value.length < 2) || (document.form.email.value.length < 5) || (document.form.aisim.value.length < 2) || (document.form.aemail.value.length < 5)) 
	{ 
		dogruMu = false; 
		alert(\''.$kp_dil_438.'\');
	}
	return dogruMu;
	}
	//  -->
	</script>';

	$dongu_yok = array(
	'{JAVA_SCRIPT}' => $java,
	'{DAVETIYE}' => $kp_dil_212, 
	'{ISMINIZ}' => $kp_dil_213, 
	'{E-POSTA_ADRESINIZ}' => $kp_dil_214,
	'{ARKADASINIZIN_ISMI}' => $kp_dil_215, 
	'{ARKADASINIZIN_E-POSTA_ADRESI}' => $kp_dil_216, 
	'{MESAJINIZ}' => $kp_dil_219,
	'{GONDER}' => $kp_dil_217, 
	'{TEMIZLE}' => $kp_dil_218, 
	'{DAVETIYE_GONDER_SAYFASI}' => 'davetiye.php?davet=gonder', 
	'{PORTAL_INDEX}' => 'davetiye.php');

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/davetiye.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));
	$ornek1->dongusuz($dongu_yok);
	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	exit();
	}

	else
	{
		$sayfa_adi = 'Davetiye Sayfası';
		if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
		if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';

		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $kp_yonetim_103,
		'{ADRES}' => 'sitemap.php',
		'{ILETI}' => $kp_dil_323,
		'{EK_YAZI}' => '',
		'{YONLENDIRME}' => $ileti__3,
		'{YONLENDIRME2}' => $ileti__2);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
		exit();
	}

	}
?>