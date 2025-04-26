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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='3' OR kip='5' OR kip='6'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');


$dosya_adi = 'forum_duyurular.php';

// Simgeler
$duzenle_simge = '<img src="phpkf-bilesenler/temalar/varsayilan/resimler/duzenle.png" width="16" height="16" alt="d" style="margin-left:5px; margin-right:5px" title="'.$ly['degistir'].'" />';

$sil_simge = '<img src="phpkf-bilesenler/temalar/varsayilan/resimler/sil.png" width="15" height="15" alt="s" style="margin-left:5px; margin-right:5px" title="'.$l['sil'].'" />';




// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';


//  DUYURU EKLENİYOR  //

if ( (isset($_POST['duyuru'])) AND ($_POST['duyuru'] == 'ekle') )
{
	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	if ( (!isset($_POST['fno'])) OR  ($_POST['fno'] == '') )
	{
		header('Location: hata.php?hata=152');
		exit();
	}

	else $_POST['fno'] = zkTemizle($_POST['fno']);


	// zararlı kodlar temizleniyor
	$bul = array('meta ');
	$cevir = array('');

	$_POST['mesaj_baslik'] = str_replace($bul, $cevir, $_POST['mesaj_baslik']);
	$_POST['mesaj_icerik'] = str_replace($bul, $cevir, $_POST['mesaj_icerik']);


	//	magic_quotes_gpc açıksa	//
	if (get_magic_quotes_gpc())
	{
		$_POST['mesaj_baslik'] = @ileti_yolla(stripslashes($_POST['mesaj_baslik']), 1);
		$_POST['mesaj_icerik'] = @ileti_yolla(stripslashes($_POST['mesaj_icerik']), 4);
	}

	//	magic_quotes_gpc kapalıysa	//
	else
	{
		$_POST['mesaj_baslik'] = @ileti_yolla($_POST['mesaj_baslik'], 1);
		$_POST['mesaj_icerik'] = @ileti_yolla($_POST['mesaj_icerik'], 4);
	}

	$vtsorgu = "INSERT INTO $tablo_duyurular (fno,duyuru_baslik,duyuru_icerik) VALUES ('$_POST[fno]','$_POST[mesaj_baslik]', '$_POST[mesaj_icerik]')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	header('Location: '.$dosya_adi);
	exit();
}



//	SEÇİLİ DUYURU SİLİNİYOR	//

if ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'sil') )
{
	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	$_GET['dno'] = zkTemizle($_GET['dno']);

	$vtsorgu = "DELETE FROM $tablo_duyurular WHERE id='$_GET[dno]'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	header('Location: '.$dosya_adi);
	exit();
}



//	SEÇİLİ DUYURU DÜZENLENİYOR	//

if ( (isset($_POST['duyuru'])) AND ($_POST['duyuru'] == 'duzenle') )
{
	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	if ( (!isset($_POST['fno'])) OR  ($_POST['fno'] == '') )
	{
		header('Location: hata.php?hata=152');
		exit();
	}

	else $_POST['fno'] = zkTemizle($_POST['fno']);

	$_POST['dno'] = zkTemizle($_POST['dno']);


	// zararlı kodlar temizleniyor
	$bul = array('meta ');
	$cevir = array('');

	$_POST['mesaj_baslik'] = str_replace($bul, $cevir, $_POST['mesaj_baslik']);
	$_POST['mesaj_icerik'] = str_replace($bul, $cevir, $_POST['mesaj_icerik']);


	//	magic_quotes_gpc açıksa	//
	if (get_magic_quotes_gpc())
	{
		$_POST['mesaj_baslik'] = @ileti_yolla(stripslashes($_POST['mesaj_baslik']), 1);
		$_POST['mesaj_icerik'] = @ileti_yolla(stripslashes($_POST['mesaj_icerik']), 4);
	}

	//	magic_quotes_gpc kapalıysa	//
	else
	{
		$_POST['mesaj_baslik'] = @ileti_yolla($_POST['mesaj_baslik'], 1);
		$_POST['mesaj_icerik'] = @ileti_yolla($_POST['mesaj_icerik'], 4);
	}

	$vtsorgu = "UPDATE $tablo_duyurular SET fno='$_POST[fno]',duyuru_baslik='$_POST[mesaj_baslik]',duyuru_icerik='$_POST[mesaj_icerik]' WHERE id='$_POST[dno]'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	header('Location: '.$dosya_adi);
	exit();
}
















//  DUYURU DÜZENLEME BAĞLANTISI TIKLANMIŞSA - BAŞI  //



if ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'duzenle') ):

$_GET['dno'] = @zkTemizle($_GET['dno']);


// DUYURUNUN BİLGİLERİ ÇEKİLİYOR
$vtsorgu = "SELECT * FROM $tablo_duyurular where id='$_GET[dno]' LIMIT 1";
$duzenle_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$duyuru_duzenle = $vt->fetch_assoc($duzenle_sonuc);


$sayfa_baslik = 'Duyuru Düzenleme';
$duyuru_baslik = @str_replace('&','&#38',$duyuru_duzenle['duyuru_baslik']);
$duyuru_icerik = @str_replace('&','&#38',$duyuru_duzenle['duyuru_icerik']);


$forum_secenek = '
<select name="fno" class="input-select">';

if ($duyuru_duzenle['fno'] == 'tum') $forum_secenek .= '<option value="tum" selected="selected"> &nbsp; - TÜM SAYFALAR -</option>';
else $forum_secenek .= '<option value="tum"> &nbsp; - TÜM SAYFALAR -</option>';

if ($portal_kullan == 1) 
{
	if ($duyuru_duzenle['fno'] == 'por') $forum_secenek .= '<option value="por" selected="selected"> &nbsp; - PORTAL ANA SAYFASI -</option>';
	else $forum_secenek .= '<option value="por"> &nbsp; - PORTAL ANA SAYFA -</option>';
}

if ($duyuru_duzenle['fno'] == 'ozel') $forum_secenek .= '<option value="ozel" selected="selected"> &nbsp; - ÖZEL İLETİ SAYFALARI -</option>';
else $forum_secenek .= '<option value="ozel"> &nbsp; - ÖZEL İLETİ SAYFALARI -</option>';

if ($duyuru_duzenle['fno'] == 'mis') $forum_secenek .= '<option value="mis" selected="selected"> &nbsp; - MİSAFİRLER -</option>';
else $forum_secenek .= '<option value="mis"> &nbsp; - MİSAFİRLER -</option>';

if ($duyuru_duzenle['fno'] == 'uye') $forum_secenek .= '<option value="uye" selected="selected"> &nbsp; - TÜM ÜYELER -</option>';
else $forum_secenek .= '<option value="uye"> &nbsp; - TÜM ÜYELER -</option>';

if ($duyuru_duzenle['fno'] == 'byar') $forum_secenek .= '<option value="byar" selected="selected"> &nbsp; - BÖLÜM YARDIMCILARI VE ÖZEL ÜYELER -</option>';
else $forum_secenek .= '<option value="byar"> &nbsp; - BÖLÜM YARDIMCILARI VE ÖZEL ÜYELER -</option>';

if ($duyuru_duzenle['fno'] == 'fyar') $forum_secenek .= '<option value="fyar" selected="selected"> &nbsp; - FORUM YARDIMCILARI -</option>';
else $forum_secenek .= '<option value="fyar"> &nbsp; - FORUM YARDIMCILARI -</option>';

if ($duyuru_duzenle['fno'] == 'yon') $forum_secenek .= '<option value="yon" selected="selected"> &nbsp; - YÖNETİCİLER -</option>';
else $forum_secenek .= '<option value="yon"> &nbsp; - YÖNETİCİLER -</option>';



// forum dalı adları çekiliyor
$vtsorgu = "SELECT id,ana_forum_baslik FROM $tablo_dallar ORDER BY sira";
$dallar_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


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


		if (!$vt->num_rows($vtsonuca))
		{
			if ($duyuru_duzenle['fno'] == $forum_satir['id']) $forum_secenek .= '
			<option value="'.$forum_satir['id'].'" selected="selected"> &nbsp; - '.$forum_satir['forum_baslik'].'</option>';

			else $forum_secenek .= '
			<option value="'.$forum_satir['id'].'"> &nbsp; - '.$forum_satir['forum_baslik'].'</option>';
		}


		else
		{
			if ($duyuru_duzenle['fno'] == $forum_satir['id']) $forum_secenek .= '
			<option value="'.$forum_satir['id'].'" selected="selected"> &nbsp; - '.$forum_satir['forum_baslik'].'</option>';

			else $forum_secenek .= '
			<option value="'.$forum_satir['id'].'"> &nbsp; - '.$forum_satir['forum_baslik'].'</option>';


			while ($alt_forum_satir = $vt->fetch_array($vtsonuca))
			{
				if ($duyuru_duzenle['fno'] == $alt_forum_satir['id']) $forum_secenek .= '
				<option value="'.$alt_forum_satir['id'].'" selected="selected"> &nbsp; &nbsp; &nbsp; -- '.$alt_forum_satir['forum_baslik'].'</option>';

				else $forum_secenek .= '
				<option value="'.$alt_forum_satir['id'].'"> &nbsp; &nbsp; &nbsp; -- '.$alt_forum_satir['forum_baslik'].'</option>';
			}
		}
	}
}

$forum_secenek .= '</select>';


$kip = 'duzenle';
$dno = $duyuru_duzenle['id'];
$form_buton = $l['duzenle'];


//  DUYURU DÜZENLEME BAĞLANTISI TIKLANMIŞSA - SONU  //








elseif ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'yeni') ):


$sayfa_baslik = 'Duyuru Ekleme';


$forum_secenek = '
<select name="fno" class="input-select">
<option value="tum"> &nbsp; - TÜM FORUM SAYFALARI -</option>';

if ($portal_kullan == 1) $forum_secenek .= '<option value="por"> &nbsp; - PORTAL ANA SAYFASI -</option>';

$forum_secenek .= '<option value="ozel"> &nbsp; - ÖZEL İLETİ SAYFALARI -</option>
<option value="mis"> &nbsp; - MİSAFİRLER -</option>
<option value="uye"> &nbsp; - TÜM ÜYELER -</option>
<option value="byar"> &nbsp; - BÖLÜM YARDIMCILARI VE ÖZEL ÜYELER -</option>
<option value="fyar"> &nbsp; - FORUM YARDIMCILARI -</option>
<option value="yon"> &nbsp; - YÖNETİCİLER -</option>
<option value=""> &nbsp; --------------------------------------------------</option>';



// forum dalı adları çekiliyor
$vtsorgu = "SELECT id,ana_forum_baslik FROM $tablo_dallar ORDER BY sira";
$dallar_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


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


		if (!$vt->num_rows($vtsonuca))
			$forum_secenek .= '
			<option value="'.$forum_satir['id'].'"> &nbsp; + '.$forum_satir['forum_baslik'].'</option>';


		else
		{
			$forum_secenek .= '
			<option value="'.$forum_satir['id'].'"> &nbsp; + '.$forum_satir['forum_baslik'].'</option>';


			while ($alt_forum_satir = $vt->fetch_array($vtsonuca))
				$forum_secenek .= '
				<option value="'.$alt_forum_satir['id'].'"> &nbsp; &nbsp; &nbsp; - '.$alt_forum_satir['forum_baslik'].'</option>';
		}
	}
}

$forum_secenek .= '</select>';


$kip = 'ekle';
$dno = '0';
$form_buton = $l['gonder'];
$duyuru_baslik = '';
$duyuru_icerik = '';







//  GİRİŞ SAYFASI - DUYURULAR SIRALANIYOR  //

else:


// FORUM BİLGİLERİ ÇEKİLİYOR
$vtsorgu = "SELECT id,forum_baslik,okuma_izni FROM $tablo_forumlar ORDER BY dal_no, sira";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

while ($forum_satir = $vt->fetch_array($vtsonuc))
{
	$tumforum_satir[$forum_satir['id']] = $forum_satir['forum_baslik'];
}



// DUYURU SIRALAMA ŞEKLİ

if (isset($_GET['sirala']))
{
	if ($_GET['sirala'] == 'f1')
	{
		$duyuru_sirala = 'fno';
		$siralama_secenek = '<option value="f2">Forum sırasına göre tersten</option>
<option value="f1" selected="selected">Forum sırasına göre</option>
<option value="d2">Oluşturulma sırasına göre tersten</option>
<option value="d1">Oluşturulma sırasına göre</option>';
	}

	elseif ($_GET['sirala'] == 'f2')
	{
		$duyuru_sirala = 'fno DESC';
		$siralama_secenek = '<option value="f2" selected="selected">Forum sırasına göre tersten</option>
<option value="f1">Forum sırasına göre</option>
<option value="d2">Oluşturulma sırasına göre tersten</option>
<option value="d1">Oluşturulma sırasına göre</option>';
	}

	elseif ($_GET['sirala'] == 'd1')
	{
		$duyuru_sirala = 'id';
		$siralama_secenek = '<option value="f2">Forum sırasına göre tersten</option>
<option value="f1">Forum sırasına göre</option>
<option value="d2">Oluşturulma sırasına göre tersten</option>
<option value="d1" selected="selected">Oluşturulma sırasına göre</option>';
	}

	elseif ($_GET['sirala'] == 'd2')
	{
		$duyuru_sirala = 'id DESC';
		$siralama_secenek = '<option value="f2">Forum sırasına göre tersten</option>
<option value="f1">Forum sırasına göre</option>
<option value="d2" selected="selected">Oluşturulma sırasına göre tersten</option>
<option value="d1">Oluşturulma sırasına göre</option>';
	}
}

else
{
	$duyuru_sirala = 'fno DESC';
	$siralama_secenek = '<option value="f2" selected="selected">Forum sırasına göre tersten</option>
<option value="f1">Forum sırasına göre</option>
<option value="d2">Oluşturulma sırasına göre tersten</option>
<option value="d1">Oluşturulma sırasına göre</option>';
}




// DUYURU BİLGİLERİ ÇEKİLİYOR
$vtsorgu = "SELECT * FROM $tablo_duyurular ORDER BY $duyuru_sirala";
$duyuru_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

endif;



// tema dosyası yükleniyor
$sayfa_adi = $ly['duyurular'];
$tema_sayfa_baslik = $ly['duyurular'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/forum_duyurular.php'));

?>