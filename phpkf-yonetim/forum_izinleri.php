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
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');



if ( ( isset($_POST['izindegistir']) ) AND ( $_POST['izindegistir'] == 'izindegistir' ) )
{
	$_POST['okuma_izni'] = zkTemizle($_POST['okuma_izni']);
	$_POST['yazma_izni'] = zkTemizle($_POST['yazma_izni']);
	$_POST['konu_acma_izni'] = zkTemizle($_POST['konu_acma_izni']);
	$_POST['fno'] = zkTemizle($_POST['fno']);


	// misafirlere açıksa gizlenmesin
	if ($_POST['okuma_izni'] == '0') $_POST['gizle'] = 0;


	// okuma izni sadece yöneticiler içinse ve diğer izinler de kapalı değilse, diğer izinleri sadece yönetici olarak değiştir
	if ($_POST['okuma_izni'] == '1')
	{
		if ($_POST['konu_acma_izni'] != '5') $_POST['konu_acma_izni'] = 1;
		if ($_POST['yazma_izni'] != '5') $_POST['yazma_izni'] = 1;
	}


	// okuma izni yardımcılar içinse ve diğer izinler daha düşükse
	if ($_POST['okuma_izni'] == '2')
	{
		if (($_POST['konu_acma_izni'] == '0') OR ($_POST['konu_acma_izni'] == '3')) $_POST['konu_acma_izni'] = 2;
		if (($_POST['yazma_izni'] == '0') OR ($_POST['yazma_izni'] == '3')) $_POST['yazma_izni'] = 2;
	}


	// okuma izni özel üyeler içinse ve diğer izinler tüm üyeler ise
	if ($_POST['okuma_izni'] == '3')
	{
		if ($_POST['konu_acma_izni'] == '0') $_POST['konu_acma_izni'] = 3;
		if ($_POST['yazma_izni'] == '0') $_POST['yazma_izni'] = 3;
	}


	// okuma izni kapalı ise diğer izinleri de kapat
	if ($_POST['okuma_izni'] == '5')
	{
		$_POST['konu_acma_izni'] = 5;
		$_POST['yazma_izni'] = 5;
	}



	// FORUM İZİN BİLGİLERİ DEĞİŞTİRİLİYOR //

	$vtsorgu = "UPDATE $tablo_forumlar SET 
	okuma_izni='$_POST[okuma_izni]', yazma_izni='$_POST[yazma_izni]', konu_acma_izni='$_POST[konu_acma_izni]', gizle='$_POST[gizle]'
	WHERE id='$_POST[fno]' LIMIT 1";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
}




elseif ( ( isset($_POST['izingoster']) ) AND ( $_POST['izingoster'] == 'izingoster' ) )
{
	if ( (!isset($_POST['forum_izin'])) OR (is_numeric($_POST['forum_izin']) == false) )
	{
		header('Location: hata.php?hata=152');
		exit();
	}

	else $_POST['forum_izin'] = zkTemizle($_POST['forum_izin']);


	// FORUM İZİN BİLGİLERİ ÇEKİLİYOR //

	$vtsorgu = "SELECT id,forum_baslik,okuma_izni,yazma_izni,konu_acma_izni,gizle FROM $tablo_forumlar
			WHERE id='$_POST[forum_izin]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$izinler_satir = $vt->fetch_array($vtsonuc);
}




//  SAYFA GÖSTERİMİ  //

$tema_sayfa_icerik = '
<table cellspacing="0" width="100%" cellpadding="2" border="0" align="left">
	<tr>
	<td align="left" class="liste-veri">

<form name="forum_izinleri" action="forum_izinleri.php" method="post">
<input type="hidden" name="izingoster" value="izingoster" />';



if ( (!isset($_POST['izindegistir'])) AND (!isset($_POST['izingoster'])) )
{
$tema_sayfa_icerik .= 'İzinlerini görüntülemek ve/veya düzenlemek istediğiniz forumu aşağıdan seçip <b>İzinleri Göster</b> düğmesini tıklayın.

<br><br>Forum bölümü yetkisi olarak <b>Özel Üyeleri</b> seçtiğinizde, istediğiniz kullanıcıya ilgili forum bölümüne erişimi için okuma, yazma veya yönetme yetkisi verebilirsiniz.
<br>Herhangi bir üyeye forum bölümünü yönetme yetkisi verdiğinizde üye o forum bölümünün yardımcısı olur, yetkisi de <b>Bölüm Yardımcısı</b> olur.
<br>
<br>
Forum bölümünün ayarlanmış yetkiden daha düşük yetkili üyeler ilgili forumu yönetemez.
Yani herhangi bir yetkisi yöneticiler olarak ayarlanmış bir forum bölümü için, daha düşük yetkiye sahip bir üyeye yönetme yetkisi verilemez. Bu durum yardımcı yetkisi verilmiş forum bölümleri için de geçerlidir.
<br>
<br>
<b><u>Bölüm Yardımcısı Atama:</u></b>&nbsp; Herhangi bir üyeye bölüm yardımcısı yetkisi ve/veya özel yetkiler vermek için, <a href="uyeler.php">bu sayfadan</a> istediğiniz üyenin kullanıcı adını tıklayın. Açılan, "Kullanıcı Profilini Değiştir" sayfasından <b>Diğer Yetkiler</b> bağlantısını tıklayın. Yeni açılan sayfadan yetki vermek istediğiniz forumu seçerek kullanıcıya istediğiniz yetkiyi verebilirsiniz.
<br>
Yönetme yetkisi verdiğinizde üyenin yetkisi bölüm yardımcısı olur.
<br>
<br>
<b><u>Forum Gizleme:</u></b>&nbsp; İstediğiniz forum bölümlerini, 
ayarlanan okuma yetkisinden düşük üyelere gizleyebilirsiniz. Mesela bir forum bölümünün okuma yetkisini sadece yöneticiler olarak ayarlayıp gizlediğinizde, bu bölüm ve konuları sadece yöneticiler tarafından görüntülenecektir.';
}

else $tema_sayfa_icerik .= '<br><center><a href="forum_izinleri.php"><b>- Yardım Göster -</b></a></center>';




$tema_sayfa_icerik .= '<br><br><br>
<center>
<b>Forum Seç:</b> &nbsp;
<br>';



// forum dalı adları çekiliyor
$vtsorgu = "SELECT id,ana_forum_baslik FROM $tablo_dallar ORDER BY sira";
$dallar_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


$forum_secenek = '<select name="forum_izin" class="input-select" size="15" style="min-width:250px; height:unset">';

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
			$forum_secenek .= '
			<option value="'.$forum_satir['id'].'"';

			if ( ( isset($_POST['forum_izin']) ) AND ($_POST['forum_izin'] == $forum_satir['id']) ) $forum_secenek .= ' selected="selected">';
			elseif ( ( isset($_POST['fno']) ) AND ($_POST['fno'] == $forum_satir['id']) ) $forum_secenek .= ' selected="selected">';
			else $forum_secenek .= '>';

			$forum_secenek .= ' &nbsp; + '.$forum_satir['forum_baslik'].'</option>';
		}


		else
		{
			$forum_secenek .= '
			<option value="'.$forum_satir['id'].'"';

			if ( ( isset($_POST['forum_izin']) ) AND ($_POST['forum_izin'] == $forum_satir['id']) ) $forum_secenek .= ' selected="selected">';
			elseif ( ( isset($_POST['fno']) ) AND ($_POST['fno'] == $forum_satir['id']) ) $forum_secenek .= ' selected="selected">';
			else $forum_secenek .= '>';

			$forum_secenek .= ' &nbsp; + '.$forum_satir['forum_baslik'].'</option>';


			while ($alt_forum_satir = $vt->fetch_array($vtsonuca))
			{
			
				$forum_secenek .= '
				<option value="'.$alt_forum_satir['id'].'"';

				if ( ( isset($_POST['forum_izin']) ) AND ($_POST['forum_izin'] == $alt_forum_satir['id']) ) $forum_secenek .= ' selected="selected">';
				elseif ( ( isset($_POST['fno']) ) AND ($_POST['fno'] == $alt_forum_satir['id']) ) $forum_secenek .= ' selected="selected">';
				else $forum_secenek .= '>';

				$forum_secenek .= ' &nbsp; &nbsp; &nbsp; - '.$alt_forum_satir['forum_baslik'].'</option>';
			}
		}
	}
}


$forum_secenek .= '</select>';

$tema_sayfa_icerik .= $forum_secenek;



$tema_sayfa_icerik .= '<br><br>
<input type="submit" value="İzinleri Göster" class="dugme dugme-mavi" />
</center>
<br>
</form>';


if ( ( isset($_POST['izindegistir']) ) AND ( $_POST['izindegistir'] == 'izindegistir' ) )
$tema_sayfa_icerik .= '<p align="center"><b><font color="green">Forum izinleri değiştirilmiştir.</b></p><br>';


$tema_sayfa_icerik .= '</td></tr>';



//  FORUM İZİNLERİNİ GÖSTER TIKLANMIŞSA - BAŞI  //

if (isset($izinler_satir)):

$tema_sayfa_icerik .= '
	<tr>
	<td align="center" valign="top">

<form name="forum_izinleri" action="forum_izinleri.php" method="post">
<input type="hidden" name="izindegistir" value="izindegistir" />
<input type="hidden" name="fno" value="'.$izinler_satir['id'].'" />


<hr>
<br><br>
<div><b>'.$izinler_satir['forum_baslik'].' Bölümü İzinleri</b></div>
<br><br>


<table cellspacing="1" cellpadding="2" width="450" border="0" align="center" class="tablo_ici">
	<tr>
	<td class="liste-etiket" align="right" valign="top" width="115">Okuma: &nbsp; </td>

	<td class="liste-veri" align="left" valign="middle">
<select name="okuma_izni" class="input-select" size="6" style="height:unset">
<option value="0"'.(($izinler_satir['okuma_izni']==0)?' selected="selected"':'').'>Herkes</option>
<option value="4"'.(($izinler_satir['okuma_izni']==4)?' selected="selected"':'').'>Tüm Üyeler</option>
<option value="3"'.(($izinler_satir['okuma_izni']==3)?' selected="selected"':'').'>Özel Üyeler ve Yöneticiler</option>
<option value="2"'.(($izinler_satir['okuma_izni']==2)?' selected="selected"':'').'>Yardımcılar ve Yöneticiler</option>
<option value="1"'.(($izinler_satir['okuma_izni']==1)?' selected="selected"':'').'>Sadece Yöneticiler</option>
<option value="5"'.(($izinler_satir['okuma_izni']==5)?' selected="selected"':'').'>Kapalı</option>
</select>
<br><br>
	</td>
	</tr>


	<tr>
	<td class="liste-etiket" align="right" valign="top">Konu Açma: &nbsp; </td>

	<td class="liste-veri" align="left" valign="middle">
<select name="konu_acma_izni" class="input-select" size="5" style="height:unset">
<option value="0"'.(($izinler_satir['konu_acma_izni']==0)?' selected="selected"':'').'>Tüm Üyeler</option>
<option value="3"'.(($izinler_satir['konu_acma_izni']==3)?' selected="selected"':'').'>Özel Üyeler ve Yöneticiler</option>
<option value="2"'.(($izinler_satir['konu_acma_izni']==2)?' selected="selected"':'').'>Yardımcılar ve Yöneticiler</option>
<option value="1"'.(($izinler_satir['konu_acma_izni']==1)?' selected="selected"':'').'>Sadece Yöneticiler</option>
<option value="5"'.(($izinler_satir['konu_acma_izni']==5)?' selected="selected"':'').'>Kapalı</option>
</select>
<br><br>
	</td>
	</tr>


	<tr>
	<td class="liste-etiket" align="left" valign="top">Cevap Yazma: &nbsp; </td>

	<td class="liste-veri" align="left" valign="middle">
<select name="yazma_izni" class="input-select" size="5" style="height:unset">
<option value="0"'.(($izinler_satir['yazma_izni']==0)?' selected="selected"':'').'>Tüm Üyeler</option>
<option value="3"'.(($izinler_satir['yazma_izni']==3)?' selected="selected"':'').'>Özel Üyeler ve Yöneticiler</option>
<option value="2"'.(($izinler_satir['yazma_izni']==2)?' selected="selected"':'').'>Yardımcılar ve Yöneticiler</option>
<option value="1"'.(($izinler_satir['yazma_izni']==1)?' selected="selected"':'').'>Sadece Yöneticiler</option>
<option value="5"'.(($izinler_satir['yazma_izni']==5)?' selected="selected"':'').'>Kapalı</option>
</select>
<br><br>
	</td>
	</tr>



	<tr>
	<td class="liste-etiket" align="right" valign="top">Gizleme: &nbsp; </td>

	<td class="liste-veri" align="left" valign="top">
<select name="gizle" class="input-select" style="height:unset">
<option value="0"'.(($izinler_satir['gizle']==0)?' selected="selected"':'').'>Göster</option>
<option value="1"'.(($izinler_satir['gizle']==1)?' selected="selected"':'').'>Gizle</option>
</select>
<br><br>
	</td>
	</tr>




	<tr>
	<td class="liste-etiket" align="right" valign="top">Yönetme: &nbsp; </td>
	<td class="liste-veri" align="left" valign="top">';

if ( ($izinler_satir['yazma_izni'] == 1) OR ($izinler_satir['konu_acma_izni'] == 1) OR ($izinler_satir['okuma_izni'] == 1) )
	$tema_sayfa_icerik .= 'Sadece Forum Yöneticileri';

else if ( ($izinler_satir['yazma_izni'] == 2) OR ($izinler_satir['konu_acma_izni'] == 2) OR ($izinler_satir['okuma_izni'] == 2) )
	$tema_sayfa_icerik .= 'Forum Yöneticileri ve Forum Yardımcıları';

else if ( ($izinler_satir['yazma_izni'] == 3) OR ($izinler_satir['konu_acma_izni'] == 3) OR ($izinler_satir['okuma_izni'] == 3) )
	$tema_sayfa_icerik .= 'Forum yöneticileri, yardımcıları ve bölümün yardımcıları
	<br><br><a href="uyeler.php">Bu Bölüme Yardımcılar Ata</a>';

elseif ( ($izinler_satir['yazma_izni'] == 5) OR ($izinler_satir['konu_acma_izni'] == 5) OR ($izinler_satir['okuma_izni'] == 5) )
	$tema_sayfa_icerik .= 'Sadece Forum Yöneticileri';

else $tema_sayfa_icerik .= 'Forum yöneticileri, yardımcıları ve bölümün yardımcıları
	<br><br><a href="uyeler.php">Bu Bölüme Yardımcılar Ata</a>';

$tema_sayfa_icerik .= '
	</td>
	</tr>


</table>
<br>
<br><input type="submit" value="İzinleri Değiştir" class="dugme dugme-mavi" /><br>
</form><br><br>
	</td>
	</tr>';




//  FORM İZİNLERİ GÖRÜNTÜLENİYOR - SONU  //

endif;


$tema_sayfa_icerik .= '</table>';


// tema dosyası yükleniyor
$sayfa_adi = $ly['forum_izinleri'];
$tema_sayfa_baslik = $ly['forum_izinleri'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>