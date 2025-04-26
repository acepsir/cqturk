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

$dosya_adi = 'uye_gruplar.php';


// Simgeler
$duzenle_simge = '<img src="phpkf-bilesenler/temalar/varsayilan/resimler/duzenle.png" width="16" height="16" alt="d" style="margin-left:5px; margin-right:5px" title="'.$ly['degistir'].'" />';

$sil_simge = '<img src="phpkf-bilesenler/temalar/varsayilan/resimler/sil.png" width="15" height="15" alt="s" style="margin-left:5px; margin-right:5px" title="'.$l['sil'].'" />';





//  FORM DOLU İSE  //

if ((isset($_POST['form'])) AND ($_POST['form'] == 'dolu')):



if ((!isset($_POST['grup_adi'])) OR ($_POST['grup_adi'] == ''))
{
	header('Location: hata.php?hata=26');
	exit();
}

if (!preg_match('/^[A-Za-z0-9-_ ğĞüÜŞşİıÖöÇç.]+$/', $_POST['grup_adi']))
{
	header('Location: hata.php?hata=201');
	exit();
}

if ( ( strlen($_POST['grup_adi']) > 30) OR ( strlen($_POST['grup_adi']) < 4) )
{
	header('Location: hata.php?hata=202');
	exit();
}


//  veriler temizleniyor

if (isset($_POST['grup_adi'])) $_POST['grup_adi'] = zkTemizle($_POST['grup_adi']);
if (isset($_POST['ozel_ad'])) $_POST['ozel_ad'] = zkTemizle($_POST['ozel_ad']);
if (isset($_POST['grup_bilgi'])) $_POST['grup_bilgi'] = zkTemizle($_POST['grup_bilgi']);
if (isset($_POST['duzenle'])) $_POST['duzenle'] = zkTemizle($_POST['duzenle']);
if (isset($_POST['yetki'])) $_POST['yetki'] = zkTemizle($_POST['yetki']);


// grup gizleme
if (isset($_POST['grup_gizle'])) $grup_gizle = 1;
else $grup_gizle = 0;



//   YENİ GRUP OLUŞTURMA   //

if ((isset($_POST['yeni_grup'])) AND ($_POST['yeni_grup'] == 'yeni_grup'))
{
	// grup adının daha önce kullanılıp kullanılmadığına bakılıyor
	$vtsorgu = "SELECT grup_adi FROM $tablo_gruplar WHERE grup_adi='$_POST[grup_adi]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	if ($vt->num_rows($vtsonuc))
	{
		header('Location: hata.php?hata=203');
		exit();
	}


	// yeni grup kaydı yapılıyor
	$vtsorgu = "INSERT INTO $tablo_gruplar (grup_adi, sira, gizle, yetki, ozel_ad, uyeler, grup_bilgi)";
	$vtsorgu .= "VALUES ('$_POST[grup_adi]','$_POST[sira]', '$grup_gizle', '$_POST[yetki]', '$_POST[ozel_ad]', '', '$_POST[grup_bilgi]')";
	$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());
}



//   GRUP DÜZENLEME   //

elseif ((isset($_POST['duzenle'])) AND ($_POST['duzenle'] != ''))
{
	// grubun eski yetkisi "bölüm yardımcılığı" ise ve değiştirilmişse uyarı ver
	if ( ($_POST['eski_yetki'] == '3') AND ($_POST['yetki'] != '3') )
	{
		header('Location: hata.php?hata=205');
		exit();
	}

	// grubun eski ve yeni yetkileri "yetkisiz" değilse, yeni yetkiyi grup üyelerine uygula
	elseif ($_POST['yetki'] != '-1')
	{
		$vtsorgu = "UPDATE $tablo_kullanicilar SET yetki='$_POST[yetki]' WHERE grupid='$_POST[duzenle]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}

	// gruba özel ad eklenmişse veya silinmişse grup üyelerine uygulanıyor
	if ( ($_POST['ozel_ad'] != '') OR (($_POST['eski_ozel_ad'] != '') AND ($_POST['ozel_ad'] == '')) )
	{
		$vtsorgu = "UPDATE $tablo_kullanicilar SET ozel_ad='$_POST[ozel_ad]' WHERE grupid='$_POST[duzenle]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}

	// sıra değiştirilmişse diğer gruba uygulanıyor
	if ($_POST['eski_sira'] != $_POST['sira'])
	{
		$vtsorgu = "UPDATE $tablo_gruplar SET sira='$_POST[eski_sira]' WHERE sira='$_POST[sira]' LIMIT 1";
		$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}

	// grup bilgileri düzenleniyor
	$vtsorgu = "UPDATE $tablo_gruplar SET grup_adi='$_POST[grup_adi]', sira='$_POST[sira]', gizle='$grup_gizle', yetki='$_POST[yetki]', ozel_ad='$_POST[ozel_ad]', grup_bilgi='$_POST[grup_bilgi]' WHERE id='$_POST[duzenle]' LIMIT 1";
	$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());
}


header('Location: '.$dosya_adi);
exit();





//   GRUP SİLME İŞLEMLERİ   //

elseif ((isset($_GET['sil'])) AND ($_GET['sil'] != '')):


// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';

// yönetim oturum kodu kontrol ediliyor
if ($gyo != $yo)
{
	header('Location: hata.php?hata=45');
	exit();
}


$_GET['sil'] = zkTemizle($_GET['sil']);


// grup siliniyor
$vtsorgu = "DELETE FROM $tablo_gruplar WHERE id='$_GET[sil]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


// grubun özel izinleri siliniyor
$vtsorgu = "DELETE FROM $tablo_ozel_izinler WHERE grup='$_GET[sil]'";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


// grup üyelikleri iptal ediliyor
$vtsorgu = "UPDATE $tablo_kullanicilar SET grupid='0' WHERE grupid='$_GET[sil]'";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

header('Location: '.$dosya_adi);
exit();




endif;



// Düzenleme tıklanmışsa

if ((isset($_GET['duzenle'])) AND ($_GET['duzenle'] != ''))
{
	if (isset($_GET['duzenle'])) $_GET['duzenle'] = zkTemizle($_GET['duzenle']);

	$vtsorgu = "SELECT * FROM $tablo_gruplar WHERE id='$_GET[duzenle]' LIMIT 1";
	$vtsonuc_duzenle = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$satir_duzenle = $vt->fetch_assoc($vtsonuc_duzenle);

	// seçili grup yoksa
	if (!isset($satir_duzenle['id']))
	{
		header('Location: '.$dosya_adi);
		exit();
	}
}






//  SAYFA NORMAL GÖSTERİM  //

// Grupların bilgileri çekiliyor
$vtsorgu = "SELECT * FROM $tablo_gruplar ORDER BY sira";
$vtsonuc_grup = $vt->query($vtsorgu) or die ($vt->hata_ver());



$tema_sayfa_icerik = '
<script type="text/javascript"><!-- //
function silme_onay(){
	var onay1 = confirm("Bu grubu silmek istediğinize emin misiniz?");
	if (onay1){
		var onay2 = confirm("Gerçekten silmek istediğinize emin misiniz?");
		if (onay2) return true;
		else return false;
	}
	else return false;
}
// -->
</script>';


$tema_sayfa_icerik .= '
&nbsp; &nbsp; Grup oluşturma, düzenleme ve görüntüleme işlemlerini bu sayfadan yapabilirsiniz.
<br><br>
Bir gruba yetki verdiğinizde gruptaki tüm üyelerin yetkileri değişir. Grup yetkisi "Yok" olarak ayarlandığında grup üyelerinin yetkilerinde herhangi bir değişiklik olmaz.

<br><br>
Bir gruba özel ad verdiğinizde gruptaki tüm üyelerin özel adları değişir, boş bıraktığınızda  herhangi bir değişiklik olmaz.
<br>
<br>
<br>
<table cellspacing="1" width="580" cellpadding="5" border="0" align="center" class="tablo-ana">';




$tgrup = 0;

if (!$vt->num_rows($vtsonuc_grup))
{
	$tema_sayfa_icerik .= '
	<tr class="liste-veri">
	<td align="center" valign="middle" height="50" colspan="3" class="tablo_ici">
	<b>Henüz Hiçbir Grup Oluşturulmamış</b><br>
	</td>
	</tr>';
}


else
{
	$tema_sayfa_icerik .= '<tr class="liste-etiket">
	<td align="center" class="tablo_ici" width="43%">Grup Adı</td>
	<td align="center" class="tablo_ici" width="43%">Grup Üyeleri</td>
	<td align="center" class="tablo_ici" width="14%">İşlem</td></tr>';


	while ($satir_grup = $vt->fetch_assoc($vtsonuc_grup))
	{
		$tema_sayfa_icerik .= '
		<tr class="tablo_ici" >
		<td align="left" valign="top" height="30" class="liste-etiket">
		<b>'.$satir_grup['grup_adi'].'</b><font style="font-size: 11px; font-weight: normal">';

		if ($satir_grup['gizle'] == '1') $tema_sayfa_icerik .= '&nbsp; <i>(gizli)</i>';

		$tema_sayfa_icerik .= '<br><br>
		<a href="forum_uye_izinleri.php?grup='.$satir_grup['id'].'">Özel yetki ver</a>
		</font></td>
		<td align="left">
		<div class="liste-veri" style="overflow-y:auto; max-height:195px">';

		$vtsorgu = "SELECT id,kullanici_adi FROM $tablo_kullanicilar WHERE grupid='$satir_grup[id]'";
		$vtsonuc_grup2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$sayi = 1;

		if ($vt->num_rows($vtsonuc_grup2))
		{
			while ($satir_grup2 = $vt->fetch_assoc($vtsonuc_grup2))
			{
				$tema_sayfa_icerik .= '<b>'.$sayi.')</b>&nbsp; <a href="uye_degistir.php?u='.$satir_grup2['id'].'" title="Üye profilini değiştir">'.$satir_grup2['kullanici_adi'].'</a><br>';
				$sayi++;
			}
		}

		else $tema_sayfa_icerik .= '<b>Yok</b><br><br><a href="uyeler.php">Üye Ekle</a>';


		$tema_sayfa_icerik .= '</div></td>
		<td align="center" class="tablo_ici">
		<a href="'.$dosya_adi.'?duzenle='.$satir_grup['id'].'#duzenle" title="Grubu Düzenle">'.$duzenle_simge.'</a>
		<a href="'.$dosya_adi.'?sil='.$satir_grup['id'].'&amp;yo='.$yo.'" title="Grubu Sil" onclick="return silme_onay()">'.$sil_simge.'</a>
		</td></tr>';

		$tgrup++;
	}
}



$tema_sayfa_icerik .= '
</table>


<a name="duzenle"></a>
<form action="'.$dosya_adi.'" method="post" name="form1">
<input type="hidden" name="form" value="dolu" />
<input type="hidden" name="sira" value="'.($tgrup+1).'" />';


if ((isset($_GET['duzenle'])) AND ($_GET['duzenle'] != '')) $tema_sayfa_icerik .= '<input type="hidden" name="duzenle" value="'.$satir_duzenle['id'].'" />';
else $tema_sayfa_icerik .= '<input type="hidden" name="yeni_grup" value="yeni_grup" />';


$tema_sayfa_icerik .= '
<br><br>
<hr>
<br>
Yeni grup oluşturma ve düzenleme işlemlerini bu bölümden yapabilirsiniz.<br><br>
<font size="1">
<i>Tüm alanların doldurulması zorunludur!</i>
</font>
<br><br>
<center><b>';

if ((isset($_GET['duzenle'])) AND ($_GET['duzenle'] != '')) $tema_sayfa_icerik .= 'Grup Düzenleme';
else $tema_sayfa_icerik .= 'Yeni Grup Oluştur';

$tema_sayfa_icerik .= '
</b></center>

<table cellspacing="1" width="580" cellpadding="5" border="0" align="center" class="tablo-ana" style="margin-top:5px">
	<tr class="liste-etiket">
	<td align="left" width="45%" height="40" class="tablo_ici">Grup Adı:</td>

	<td align="left" width="55%" height="40"  class="tablo_ici">
<input type="text" class="input-text" name="grup_adi" size="37" maxlength="30" value="';

if (isset($satir_duzenle['grup_adi'])) $tema_sayfa_icerik .= $satir_duzenle['grup_adi'];

$tema_sayfa_icerik .= '" />
	</td>
	</tr>


	<tr class="liste-etiket">
	<td align="left" valign="top" height="40" class="tablo_ici">
Grup Açıklaması:<br>
<font size="1" style="font-weight: normal">
Açıklama en fazla 250 karakter olabilir.<br>
(Sadece düz metin)
</font>
<br><br><br><br><br><br>
<div id="bilgi_uzunluk" style="font-weight: normal">Eklenebilir Karakter: </div>
	</td>

	<td align="left" class="tablo_ici">
<textarea name="grup_bilgi" rows="10" cols="30" class="textarea" style="width: 85%; height:130px" onkeyup="BilgiUzunluk()">';

if (isset($satir_duzenle['grup_bilgi'])) $tema_sayfa_icerik .= $satir_duzenle['grup_bilgi'];

$tema_sayfa_icerik .= '</textarea>


<script type="text/javascript"><!-- //
function BilgiUzunluk()
{
	var div_katman = document.getElementById("bilgi_uzunluk");
	div_katman.innerHTML = "Eklenebilir Karakter: " + (250-document.form1.grup_bilgi.value.length);

	if (document.form1.grup_bilgi.value.length > 250)
	{
		alert("En fazla 250 karakter girebilirsiniz.");
		document.form1.grup_bilgi.value = document.form1.grup_bilgi.value.substr(0,250);
		div_katman.innerHTML = "Eklenebilir Karakter: 0";
	}
	return true;
}
BilgiUzunluk();
//  -->
</script>

	</td>
	</tr>


	<tr class="liste-etiket">
	<td align="left" width="45%" height="40" class="tablo_ici">Grup Özel Adı:</td>
	<td align="left" width="55%" height="40"  class="tablo_ici">
<input type="text" class="input-text" name="ozel_ad" size="37" maxlength="30" value="';

if (isset($satir_duzenle['ozel_ad'])) echo $satir_duzenle['ozel_ad'];

$tema_sayfa_icerik .= '" />
	</td>
	</tr>


	<tr class="liste-etiket">
	<td align="left" height="40" class="tablo_ici">Grup Yetkisi:</td>
	<td align="left" class="tablo_ici">';


if (isset($satir_duzenle['yetki']))
{
	$tema_sayfa_icerik .= '<input type="hidden" name="eski_yetki" value="'.$satir_duzenle['yetki'].'" />
<input type="hidden" name="eski_ozel_ad" value="'.$satir_duzenle['ozel_ad'].'" />
<select class="input-select" name="yetki">
	<option value="-1"';
	if ($satir_duzenle['yetki'] == '-1') $tema_sayfa_icerik .= ' selected="selected"';
	$tema_sayfa_icerik .= '>Yok</option>';

	$tema_sayfa_icerik .= '<option value="0"';
	if ($satir_duzenle['yetki'] == 0) $tema_sayfa_icerik .= ' selected="selected"';
	$tema_sayfa_icerik .= '>Kayıtlı Kullanıcı</option>';

	if ($satir_duzenle['yetki'] == 3) $tema_sayfa_icerik .= '<option value="3" selected="selected">Bölüm Yardımcısı</option>';

	$tema_sayfa_icerik .= '<option value="2"';
	if ($satir_duzenle['yetki'] == 2) $tema_sayfa_icerik .= ' selected="selected"';
	$tema_sayfa_icerik .= '>Forum Yardımcısı</option>';

	$tema_sayfa_icerik .= '<option value="1"';
	if ($satir_duzenle['yetki'] == 1) $tema_sayfa_icerik .= ' selected="selected"';
	$tema_sayfa_icerik .= '>Forum Yöneticisi</option></select> &nbsp;&nbsp;
	<font style="font-size: 11px; font-weight: normal"><a href="forum_uye_izinleri.php?grup='.$satir_duzenle['id'].'">Özel yetki ver</a></font>';
}

else
{
	$tema_sayfa_icerik .= '<select class="input-select" name="yetki">
	<option value="-1" selected="selected">Yok</option>
	<option value="0">Kayıtlı Kullanıcı</option>
	<option value="2">Forum Yardımcısı</option>
	<option value="1">Forum Yöneticisi</option>
	</select>';
}

$tema_sayfa_icerik .= '</td></tr>';




if (isset($satir_duzenle['sira']))
{
	$tema_sayfa_icerik .= '<tr class="liste-etiket">
	<td align="left" height="40" class="tablo_ici">
Grup Sırası:
	</td>

	<td align="left" class="tablo_ici">
<input type="hidden" name="eski_sira" value="'.$satir_duzenle['sira'].'" />
<select class="input-select" name="sira">';

	for($i=1; $i<=$tgrup; $i++)
	{
		$tema_sayfa_icerik .= '<option value="'.$i.'"';
		if ($satir_duzenle['sira'] == $i) echo ' selected="selected"';
		$tema_sayfa_icerik .= '>&nbsp;'.$i.'&nbsp;</option>';
	}


	$tema_sayfa_icerik .= '>Yok</option>
	</select>
	</td>
	</tr>';
}


$tema_sayfa_icerik .= '
	<tr class="liste-etiket">
	<td align="left" height="40" class="tablo_ici">Grup Durumu:</td>

	<td align="left" class="tablo_ici">
<label style="cursor:pointer">';


if ((isset($satir_duzenle['gizle'])) AND ($satir_duzenle['gizle'] == 1)) $tema_sayfa_icerik .= '<input type="checkbox" name="grup_gizle" checked="checked" />';
else $tema_sayfa_icerik .= '<input type="checkbox" name="grup_gizle" />';

$tema_sayfa_icerik .= '
<font style="font-size: 11px; font-weight: normal; position: relative; top:-2px;">Grubu gizle</font></label>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td colspan="2" class="liste-veri" align="center" valign="middle" height="50">';

if ((isset($_GET['duzenle'])) AND ($_GET['duzenle'] != '')) $tema_sayfa_icerik .= '<input class="dugme dugme-mavi" type="submit" value="Grubu Düzenle" />';
else $tema_sayfa_icerik .= '<input class="dugme dugme-mavi" type="submit" value="Grup Oluştur" />';


$tema_sayfa_icerik .= '</td>
</tr>
</table>
</form>
<br><br>';






// tema dosyası yükleniyor
$sayfa_adi = $ly['uye_gruplari'];
$tema_sayfa_baslik = $ly['uye_gruplari'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>