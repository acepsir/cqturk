<?php
/*
 +-=========================================================================-+
 |                              phpKF Forum v3.00                            |
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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_KULLANICI_KIMLIK')) include_once('../phpkf-bilesenler/kullanici_kimlik.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');


if ($kullanici_kim['id'] != 1)
{
	header('Location: hata.php?hata=151');
	exit();
}


if ( ( isset($_POST['basliklari_sil']) ) AND ( $_POST['basliklari_sil'] == 'basliklari_sil' ) )
{
	$_POST['fno'] = @zkTemizle($_POST['fno']);

	$tarih = time();
	$hesapla = ($tarih - ($_POST['gunsayisi'] * 86400));

	if ($_POST['fno'] != 'tumu' )
	$hangi_forumdan = "hangi_forumdan='$_POST[fno]' AND";
	else $hangi_forumdan = '';


	// MESAJLAR SİLİNİYOR
	$vtsorgu = "SELECT id FROM $tablo_mesajlar WHERE $hangi_forumdan son_mesaj_tarihi < $hesapla";
	$mesaj_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "DELETE FROM $tablo_mesajlar WHERE $hangi_forumdan son_mesaj_tarihi < $hesapla";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// CEVAPLAR SİLİNİYOR
	while ($eski_mesaj = $vt->fetch_assoc($mesaj_sonuc))
	{
		$vtsorgu = "DELETE FROM $tablo_cevaplar WHERE $hangi_forumdan hangi_basliktan='$eski_mesaj[id]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}


	// FORUM BİLGİLERİ ÇEKİLİYOR
	$vtsorgu = "SELECT id FROM $tablo_forumlar";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	while ($forum_satir = $vt->fetch_assoc($vtsonuc))
	{
		// FORUMDAKİ BAŞLIKLARIN SAYISI ALINIYOR
		$vtsonuc9 = $vt->query("SELECT id FROM $tablo_mesajlar WHERE hangi_forumdan='$forum_satir[id]'") or die ($vt->hata_ver());
		$konu_sayi = $vt->num_rows($vtsonuc9);


		// FORUMDAKİ TÜM MESAJLARIN SAYISI ALINIYOR
		$vtsonuc9 = $vt->query("SELECT id FROM $tablo_cevaplar WHERE hangi_forumdan='$forum_satir[id]'") or die ($vt->hata_ver());
		$cevap_sayi = $vt->num_rows($vtsonuc9);


		// KONU VE CEVAP SAYISI YENİ ALANLARA GİRİLİYOR
		$vtsorgu = "UPDATE `$tablo_forumlar` SET konu_sayisi='$konu_sayi', cevap_sayisi='$cevap_sayi' WHERE id='$forum_satir[id]' LIMIT 1";
		$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}


	header('Location: hata.php?bilgi=36');
	exit();
}



elseif ( ( isset($_POST['forum_goster']) ) AND ( $_POST['forum_goster'] == 'forum_goster' ) )
{
	if ( empty($_POST['fno']) OR ($_POST['fno'] == '') )
	{
		header('Location: hata.php?hata=152');
		exit();
	}

	if ( ($_POST['gunsayisi'] <= 0) OR ($_POST['gunsayisi'] > 9999) )
	{
		header('Location: hata.php?hata=153');
		exit();
	}

	$_POST['fno'] = @zkTemizle($_POST['fno']);

	$onayal = 'onayal';
	$tarih = time();
	$hesapla = ($tarih - ($_POST['gunsayisi'] * 86400));

	if ($_POST['fno'] != 'tumu' )
	$hangi_forumdan = "hangi_forumdan='$_POST[fno]' AND";
	else $hangi_forumdan = '';


	// SİLİNECEK MESAJ SAYISI ALINIYOR
	$vtsorgu = "SELECT id FROM $tablo_mesajlar WHERE $hangi_forumdan son_mesaj_tarihi < $hesapla";
	$eski_mesaj_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$mesaj_sayi = $vt->num_rows($eski_mesaj_sonuc);


	// SİLİNECEK MESAJ SAYISI ALINIYOR
	$toplam_cevap_sayi = 0;
	while ($eski_mesaj = $vt->fetch_assoc($eski_mesaj_sonuc))
	{
		$vtsorgu = "SELECT id FROM $tablo_cevaplar WHERE $hangi_forumdan hangi_basliktan='$eski_mesaj[id]'";
		$eski_cevap_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		$cevap_sayi = $vt->num_rows($eski_cevap_sonuc);
		$toplam_cevap_sayi += $cevap_sayi;
	}
}





// FORUM İZİNLERİ TABLOSU BAŞI


// başlıkları sil tıklanmışsa
if (empty($onayal)):


// forum dalı adları çekiliyor
$vtsorgu = "SELECT id,ana_forum_baslik FROM $tablo_dallar ORDER BY sira";
$dallar_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$forum_secenek = '<select name="fno" class="input-select" size="15" style="height:unset">
<option value="tumu">&nbsp; - TÜM FORUMLAR -</option>';

while ($dallar_satir = $vt->fetch_array($dallar_sonuc))
{
	$forum_secenek .= '<option value="">[ '.$dallar_satir['ana_forum_baslik'].' ]</option>';

	// forum adları çekiliyor
	$vtsorgu = "SELECT id,forum_baslik,alt_forum FROM $tablo_forumlar WHERE alt_forum='0' AND dal_no='$dallar_satir[id]' ORDER BY sira";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($forum_satir = $vt->fetch_array($vtsonuc))
	{
		// alt forumuna bakılıyor
		$vtsorgu = "SELECT id,forum_baslik FROM $tablo_forumlar WHERE alt_forum='$forum_satir[id]' ORDER BY sira";
		$vtsonuca = $vt->query($vtsorgu) or die ($vt->hata_ver());


		if (!$vt->num_rows($vtsonuca)) $forum_secenek .= '<option value="'.$forum_satir['id'].'"> &nbsp; + '.$forum_satir['forum_baslik'].'</option>';
		else
		{
			$forum_secenek .= '<option value="'.$forum_satir['id'].'"> &nbsp; + '.$forum_satir['forum_baslik'].'</option>';

			while ($alt_forum_satir = $vt->fetch_array($vtsonuca))
				$forum_secenek .= '<option value="'.$alt_forum_satir['id'].'"> &nbsp; &nbsp; &nbsp; - '.$alt_forum_satir['forum_baslik'].'</option>';
		}
	}
}

$forum_secenek .= '</select>';



$tema_sayfa_icerik = '<form name="temizleme" action="forum_temizle.php" method="post">
<input type="hidden" name="forum_goster" value="forum_goster" />


<table cellspacing="1" width="100%" cellpadding="2" border="0" align="center">
	<tr>
	<td align="left" class="liste-veri">

<br> &nbsp; &nbsp; &nbsp; Bu sayfadan; belirttiğiniz gün sayısı içerisinde cevap yazılmayan başlıkları ve cevaplarını silebilirsiniz. Forumu seçip, gün girdikten sonra gelen sayfada, kaç başlığın ve bunlara bağlı kaç cevabın silineceği belirtilir. İsterseniz silme işleminden bu kısımda vazgeçebilirsiniz.

<br><br>
<center>
<b>Forum Seç:</b>
<br>
'.$forum_secenek.'
<br>
<br>
<input type="text" name="gunsayisi" size="6" class="input-text" maxlength="4" />
<b>&nbsp; Gündür cevap yazılmayan &nbsp;</b>
<br><br><br>
<input type="submit" value="Başlıkları Bul" class="dugme dugme-mavi" />
<br><br><br>
</center>
	</td>
	</tr>
</table>
</form>';





// BAŞLIKLARI SİL TIKLANMIŞSA

elseif (isset($onayal)):


$fno = '';
$gunsayisi = '';
if (isset($_POST['fno'])) $fno = $_POST['fno'];
if (isset($_POST['gunsayisi'])) $gunsayisi = $_POST['gunsayisi'];



$tema_sayfa_icerik = '
<form name="temizleme" action="forum_temizle.php" method="post">
<input type="hidden" name="basliklari_sil" value="basliklari_sil" />
<input type="hidden" name="fno" value="'.$fno.'" />
<input type="hidden" name="gunsayisi" value="'.$gunsayisi.'" />

<table cellspacing="1" width="100%" cellpadding="2" border="0" align="center">
	<tr>
	<td align="left" class="liste-veri">
&nbsp; Seçmiş olduğunuz forumda son <b>'.$_POST['gunsayisi'].'</b> gündür cevap yazılmamış;
<br><br> &nbsp; Başlık sayısı: <b>'.$mesaj_sayi.'</b>
<br> &nbsp; Başlıklara bağlı cevap sayısı: <b>'.$toplam_cevap_sayi.'</b>

<center>
<br><br>
<b>Başlık ve cevaplarını silmek istediğinize emin misiniz?</b>
<br><br>
<input type="submit" value="Evet Sil" class="dugme dugme-mavi" />
<br><br><br>
</center>
	</td>
	</tr>
</table>

</form>';



//  FORM İZİNLERİ GÖRÜNTÜLENİYOR - BİTİŞ  //

endif;






// tema dosyası yükleniyor
$sayfa_adi = $ly['forum_temizleme'];
$tema_sayfa_baslik = $ly['forum_temizleme'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>