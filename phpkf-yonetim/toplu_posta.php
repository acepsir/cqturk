<?php
/*
 +-=========================================================================-+
 |                                phpKF v3.00                                |
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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5' OR kip='4'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_GERECLER')) include_once('phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');





		//  TOPLU E-POSTA GÖNDER TIKLANMIŞSA    -   BAŞI    //


if ( (isset($_POST['kayit_yapildi_mi'])) AND ($_POST['kayit_yapildi_mi'] == 'form_dolu') ):


$tema_sayfa_icerik = '
<table cellspacing="1" width="100%" cellpadding="4" border="0" align="center">
	<tr>
	<td align="left" class="liste-veri">
';



if (($_POST['eposta_baslik']=='') or ( strlen($_POST['eposta_baslik']) < 3)
	OR ( strlen($_POST['eposta_baslik']) > 60) or ($_POST['eposta_icerik']=='')
	OR ( strlen($_POST['eposta_icerik']) < 3)):

	$tema_sayfa_icerik .= '<center><br><br><font color="red"><b>
		E-posta başlığı en az 3, en fazla 60 karakterden oluşmalıdır.
		<br><br>E-posta içeriği en az 3 karakterden oluşmalıdır.</b></font><br><br><br>
		<b>Lütfen <a href="toplu_posta.php">geri dönüp</a> tekrar deneyin.</b><br><br></center>';


else:


//	magic_quotes_gpc açıksa	//

if (get_magic_quotes_gpc())
{
	$_POST['eposta_baslik'] = stripslashes($_POST['eposta_baslik']);
	$_POST['eposta_icerik'] = stripslashes($_POST['eposta_icerik']);
}


//  SEÇİLEN ALANA GÖRE SORGU YAPILIYOR  //

if ( (isset($_POST['kimlere'])) AND ($_POST['kimlere'] != '') )
{
	if ($_POST['kimlere'] == 'tum') $eposta_kimlere = "";
	elseif ($_POST['kimlere'] == 'e_haric') $eposta_kimlere = "WHERE engelle='0'";
	elseif ($_POST['kimlere'] == 'ee_haric') $eposta_kimlere = "WHERE engelle='0' AND kul_etkin='1'";
	elseif ($_POST['kimlere'] == 'yonetici') $eposta_kimlere = "WHERE yetki='1'";
	elseif ($_POST['kimlere'] == 'yardimci') $eposta_kimlere = "WHERE yetki='2'";
	elseif ($_POST['kimlere'] == 'engellenmis') $eposta_kimlere = "WHERE engelle='1' AND kul_etkin='1'";
	elseif ($_POST['kimlere'] == 'etkisiz') $eposta_kimlere = "WHERE kul_etkin='0'";


	//	GÖNDERİLECEK ÜYELERİN SAYISI ALINIYOR	//
	
	$vtsorgu = "SELECT posta FROM $tablo_kullanicilar $eposta_kimlere";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$satir_sayi = $vt->num_rows($vtsonuc);


	//  GÖNDERECEK KİMSE YOKSA HATA VERİLİYOR   //

	if (empty($satir_sayi))
	{
		$tema_sayfa_icerik .= '<center><br><font color="red"><b>'.$ly['grupta_uye_yok'].'</b></font><br><br></center>';
	}


	//  E-POSTA GÖNDERME KISMI - BAŞI   //

	else
	{
		if ( (isset($_POST['adim'])) AND (is_numeric($_POST['adim']) == false) ) $_POST['adim'] = 50;
		if ( (isset($_POST['adim'])) AND ($_POST['adim'] != '') ) $adim = $_POST['adim'];

		if ( (isset($_POST['devam'])) AND (is_numeric($_POST['devam']) == false) ) $devam = 0;
		if ( (!isset($_POST['devam'])) OR ($_POST['devam'] == '') ) $devam = 0;
		else $devam = $_POST['devam'];


		if ($satir_sayi >= $devam)
		{
			//	GÖNDERİLECEK E-POSTA ADRESLERİ ÇEKİLİYOR	//

			$vtsorgu = "SELECT kullanici_adi,posta FROM $tablo_kullanicilar $eposta_kimlere ORDER BY id LIMIT $devam,$adim";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


			//		POSTA YOLLANIYOR		//

			require('../phpkf-bilesenler/sinif_eposta.php');

			while ($eposta_gonderilen = $vt->fetch_assoc($vtsonuc))
			{
				$posta_bul = array('{uye_adi}', '{uye_posta}');
				$posta_cevir = array($eposta_gonderilen['kullanici_adi'], $eposta_gonderilen['posta']);


				$mail = new eposta_yolla();

				if ($ayarlar['eposta_yontem'] == 'mail') $mail->MailKullan();
				elseif ($ayarlar['eposta_yontem'] == 'smtp') $mail->SMTPKullan();


				$mail->sunucu = $ayarlar['smtp_sunucu'];
				if ($ayarlar['smtp_kd'] == '1') $mail->smtp_dogrulama = true;
				else $mail->smtp_dogrulama = false;
				$mail->kullanici_adi = $ayarlar['smtp_kullanici'];
				$mail->sifre = $ayarlar['smtp_sifre'];


				$mail->gonderen = $ayarlar['site_posta'];
				$mail->gonderen_adi = $ayarlar['site_adi'];
				$mail->GonderilenAdres($eposta_gonderilen['posta']);
				$mail->YanitlamaAdres($ayarlar['site_posta']);

				$mail->konu = str_replace($posta_bul, $posta_cevir,$_POST['eposta_baslik']);
				$mail->icerik = str_replace($posta_bul, $posta_cevir, $_POST['eposta_icerik']);


				if (!$mail->Yolla())
				{
					$tema_sayfa_icerik .= '<br><center><font color="red"><b>'.$ly['eposta_gonderilemedi'].'<br><br>'.$l['hata_iletisi'].': ';
					$tema_sayfa_icerik .= $mail->hata_bilgi;
					$tema_sayfa_icerik .= '</b></font></center><br>';
					break;
				}
				usleep(30000);
			}



			$kacdakac = ($devam / $adim) + 1;

			$asama = $satir_sayi / $adim;
			settype($asama,'integer');
			if (($satir_sayi % $adim) != 0) $asama++;



			if ($mail->hata_bilgi)
			{
				$tema_sayfa_icerik .= '<br><center><font color="red"><b>'.$ly['gonderim_durduruldu'].'</b></font></center><br>';
			}


			elseif ($satir_sayi <= ($devam + $adim))
			{
				$tema_sayfa_icerik .= '<br><br><center><b>'.$ly['epostalar_yollandi'].'</b></center><br><br>';
			}


			else
			{
				$tema_sayfa_icerik .= '
					<form action="toplu_posta.php" method="post" name="eposta_form2">
					<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
					<input type="hidden" name="adim" value="'.$adim.'">
					<input type="hidden" name="devam" value="'.($devam + $adim).'">
					<input type="hidden" name="kimlere" value="'.$_POST['kimlere'].'">
					<input type="hidden" name="eposta_baslik" value="'.$_POST['eposta_baslik'].'">
					<input type="hidden" name="eposta_icerik" value="'.$_POST['eposta_icerik'].'">

					<br><br>

					<p><b>'.$ly['gonderilecek_toplam_eposta'].': </b>'.$satir_sayi.'
					<p><b>'.$ly['gonderim_adimi'].': </b>'.$adim.'
					<p><b>'.$ly['gonderim_asamasi'].': <font color="red">
					'.$kacdakac.' / '.$asama.'</font></b>
					<br><br><br>
					<center>'.$ly['3saniye_devam_tikla'].'<br><br><br>
					<input class="dugme" type="submit" value="'.$ly['devam'].' &gt;&gt;">
					</center></form><br>
					<script type="text/javascript"><!-- //
						setTimeout("document.eposta_form2.submit()",3000);
					//-->
					</script>';
			}
		}

		else $tema_sayfa_icerik .= '<br><center><b>'.$ly['epostalar_yollandi'].'</b></center><br>';
	}


	//  E-POSTA GÖNDERME KISMI - SONU   //
}



//  SEÇİM ALANINDA HATA VARSA  //

else $tema_sayfa_icerik .= '<center><br><font color="red"><b>'.$ly['grupta_uye_yok'].'</b></font><br><br></center>';

endif; // form dolu - boş

$tema_sayfa_icerik .= '
	</td>
	</tr>
</table>
';

		//  TOPLU E-POSTA GÖNDER TIKLANMIŞSA    -   SONU    //

endif;




// tema dosyası yükleniyor
$sayfa_adi = $ly['toplu_eposta_gonderimi'];
$tema_sayfa_baslik = $ly['toplu_eposta_gonderimi'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/toplu_posta.php'));
?>