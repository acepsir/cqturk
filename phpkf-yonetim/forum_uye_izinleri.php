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


$dosya_adi = 'forum_uye_izinleri.php';



//  ÜYE İŞLEMLERİ  //

if ((isset($_GET['kim'])) AND ($_GET['kim'] != ''))
{
	// Üye bilgileri veritabanından çekiliyor

	$_GET['kim'] = zkTemizle(trim($_GET['kim']));

	$vtsorgu = "SELECT id,kullanici_adi,yetki,grupid FROM $tablo_kullanicilar WHERE kullanici_adi='$_GET[kim]' AND engelle='0' AND kul_etkin='1' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$kullanici_satir = $vt->fetch_array($vtsonuc);

	if (empty($kullanici_satir))
	{
		header('Location: hata.php?hata=46');
		exit();
	}


	// Seçilen üye yönetici ise uyarı ver

	if ($kullanici_satir['yetki'] == 1)
	{
		header('Location: hata.php?uyari=3');
		exit();
	}

	if ($kullanici_satir['yetki'] == 2)
	{
		header('Location: hata.php?uyari=4');
		exit();
	}

	$sayfa_adi = $ly['uye_yetkileri'].': '.$_GET['kim'];
	$tablo_baslik = '- Forum Seçimi -';
}



//  GRUP İŞLEMLERİ  //

elseif ((isset($_GET['grup'])) AND ($_GET['grup'] != ''))
{
	// Grup bilgileri veritabanından çekiliyor

	$_GET['grup'] = zkTemizle(trim($_GET['grup']));

	$vtsorgu = "SELECT * FROM $tablo_gruplar WHERE id='$_GET[grup]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$grup_satir = $vt->fetch_array($vtsonuc);

	if (empty($grup_satir))
	{
		header('Location: hata.php?hata=204');
		exit();
	}


	$sayfa_adi = $ly['grup_yetkileri'].': '.$grup_satir['grup_adi'];
	$tablo_baslik = '- Forum Seçimi -';
}



else
{
	$sayfa_adi = $ly['uye_ve_grup_yetkileri'];
	$tablo_baslik = '- Üye Seçimi -';
}





//  ÜYE İZİN BİLGİLERİ DEĞİŞTİRİLİYOR  //

if ((isset($_POST['izindegistir'])) AND ($_POST['izindegistir'] == 'uye'))
{
	if (isset($_POST['okuma'])) $_POST['okuma'] = zkTemizle($_POST['okuma']);
	if (isset($_POST['yazma'])) $_POST['yazma'] = zkTemizle($_POST['yazma']);
	if (isset($_POST['yonetme'])) $_POST['yonetme'] = zkTemizle($_POST['yonetme']);
	if (isset($_POST['konu_acma'])) $_POST['konu_acma'] = zkTemizle($_POST['konu_acma']);
	if (isset($_POST['fno'])) $_POST['fno'] = zkTemizle($_POST['fno']);


	// ÖZEL İZİN BİLGİLERİ ÇEKİLİYOR
	$vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE grup='0' AND kulad='$kullanici_satir[kullanici_adi]' AND fno='$_POST[fno]'";
	$VARMI = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// DAHA ÖNCEDEN BU FORUM İÇİN YETKİLENDİRİL-MEMİŞSE INSERT
	if (!$vt->num_rows($VARMI))
	{
		// SADECE YETKİ VERİLMİŞSE GİR
		if ( (isset($_POST['okuma'])) AND ($_POST['okuma'] == '1') OR (isset($_POST['yazma'])) AND ($_POST['yazma'] == '1')
		OR (isset($_POST['yonetme'])) AND ($_POST['yonetme'] == '1') OR (isset($_POST['konu_acma'])) AND ($_POST['konu_acma'] == '1') )
		{
			// SADECE YÖNETİM VERİLMİŞ İSE DİĞERLERİ DE VERİLİYOR
			// KULLANICI YETKİ DERECESİ 3 YAPILIYOR

			if ($_POST['yonetme'] == '1')
			{
				$vtsorgu = "UPDATE $tablo_kullanicilar SET yetki='3' WHERE id='$kullanici_satir[id]' LIMIT 1";
				$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

				$_POST['okuma'] = 1;
				$_POST['yazma'] = 1;
				$_POST['konu_acma'] = 1;
			}

			$vtsorgu = "INSERT INTO $tablo_ozel_izinler (kulad,kulid,grup,fno,okuma,yazma,yonetme,konu_acma)";
			$vtsorgu .= "VALUES ('$kullanici_satir[kullanici_adi]','$kullanici_satir[id]','0','$_POST[fno]','$_POST[okuma]','$_POST[yazma]','$_POST[yonetme]','$_POST[konu_acma]')";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}
	}



	//  DAHA ÖNCEDEN BU FORUM İÇİN YETKİLENDİRİLMİŞSE UPDATE  //
	else
	{
		// YETKİSİ GERİ ALINIYORSA VERİTABANINDAN SİL
		if (($_POST['okuma'] == '0') AND ($_POST['yazma'] == '0') AND ($_POST['konu_acma'] == '0') AND ($_POST['yonetme'] == '0'))
		{
			$vtsorgu = "DELETE FROM $tablo_ozel_izinler WHERE grup='0' AND kulad='$kullanici_satir[kullanici_adi]' AND fno='$_POST[fno]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

			// kullanıcının başka yardımcılığı varmı bakılıyor
			$vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE grup='0' AND kulad='$kullanici_satir[kullanici_adi]' AND yonetme='1' LIMIT 1";
			$yardimcilik = $vt->query($vtsorgu) or die ($vt->hata_ver());

			if (!$vt->num_rows($yardimcilik))
			{
				if ($kullanici_satir['grupid'] != '0')
				{
					// kullanıcının üye olduğu grubun yardımcılığı varmı bakılıyor
					$vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE grup='$kullanici_satir[grupid]' AND yonetme='1' LIMIT 1";
					$yardimcilik2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
				}

				// hiçbir yardımcılığı yoksa yetkisi normale düşürülüyor
				if (!isset($yardimcilik2['fno']))
				{
					$vtsorgu = "UPDATE $tablo_kullanicilar SET yetki='0' WHERE id='$kullanici_satir[id]' LIMIT 1";
					$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
				}
			}
		}

		else
		{
			// SADECE YÖNETİM VERİLMİŞ İSE DİĞERLERİ DE VERİLİYOR
			// KULLANICI YETKİ DERECESİ 3 YAPILIYOR

			if ($_POST['yonetme'] == '1')
			{
				$vtsorgu = "UPDATE $tablo_kullanicilar SET yetki='3' WHERE id='$kullanici_satir[id]' LIMIT 1";
				$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

				$_POST['okuma'] = 1;
				$_POST['yazma'] = 1;
				$_POST['konu_acma'] = 1;
			}

			$vtsorgu = "UPDATE $tablo_ozel_izinler SET okuma='$_POST[okuma]', yazma='$_POST[yazma]', yonetme='$_POST[yonetme]', konu_acma='$_POST[konu_acma]' WHERE kulad='$kullanici_satir[kullanici_adi]' AND fno='$_POST[fno]'";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


			// YÖNETİM VERİLMEMİŞSE, BAŞKA YARDIMCILIĞI DA YOKSA...
			// KULLANICI YETKİSİ NORMALE DÜŞÜRÜLÜYOR

			if ($_POST['yonetme'] == '0')
			{
				$vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE kulad='$kullanici_satir[kullanici_adi]' AND yonetme='1'";
				$yardimcilik = $vt->query($vtsorgu) or die ($vt->hata_ver());

				if (!$vt->num_rows($yardimcilik))
				{
					$vtsorgu = "UPDATE $tablo_kullanicilar SET yetki='0' WHERE id='$kullanici_satir[id]' LIMIT 1";
					$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
				}
			}
		}
	}
}






//  GRUP İZİN BİLGİLERİ DEĞİŞTİRİLİYOR  //

if ((isset($_POST['izindegistir'])) AND ($_POST['izindegistir'] == 'grup'))
{
	if (isset($_POST['okuma'])) $_POST['okuma'] = zkTemizle($_POST['okuma']);
	if (isset($_POST['yazma'])) $_POST['yazma'] = zkTemizle($_POST['yazma']);
	if (isset($_POST['yonetme'])) $_POST['yonetme'] = zkTemizle($_POST['yonetme']);
	if (isset($_POST['konu_acma'])) $_POST['konu_acma'] = zkTemizle($_POST['konu_acma']);
	if (isset($_POST['fno'])) $_POST['fno'] = zkTemizle($_POST['fno']);



	// SADECE YÖNETİM VERİLMİŞ İSE DİĞERLERİ DE VERİLİYOR
	// KULLANICI YETKİ DERECESİ 3 YAPILIYOR
	if ( (isset($_POST['yonetme'])) AND ($_POST['yonetme'] == '1') )
	{
		$_POST['okuma'] = 1;
		$_POST['yazma'] = 1;
		$_POST['konu_acma'] = 1;

		$vtsorgu = "UPDATE $tablo_kullanicilar SET yetki='3' WHERE grupid='$grup_satir[id]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		$vtsorgu = "UPDATE $tablo_gruplar SET yetki='3' WHERE id='$grup_satir[id]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}


	// ÖZEL İZİN BİLGİLERİ ÇEKİLİYOR
	$vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE grup='$grup_satir[id]' AND fno='$_POST[fno]'";
	$VARMI = $vt->query($vtsorgu) or die ($vt->hata_ver());



	// DAHA ÖNCEDEN BU FORUM İÇİN YETKİLENDİRİL-MEMİŞSE INSERT
	if (!$vt->num_rows($VARMI))
	{
		// SADECE YETKİ VERİLMİŞSE GİR
		if ( (isset($_POST['okuma'])) AND ($_POST['okuma'] == '1') OR (isset($_POST['yazma'])) AND ($_POST['yazma'] == '1')
		OR (isset($_POST['yonetme'])) AND ($_POST['yonetme'] == '1') OR (isset($_POST['konu_acma'])) AND ($_POST['konu_acma'] == '1') )
		{
			$vtsorgu = "INSERT INTO $tablo_ozel_izinler (kulad,kulid,grup,fno,okuma,yazma,yonetme,konu_acma)";
			$vtsorgu .= "VALUES ('$grup_satir[grup_adi]', '0', '$grup_satir[id]', '$_POST[fno]','$_POST[okuma]','$_POST[yazma]','$_POST[yonetme]','$_POST[konu_acma]')";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}
	}


	//  DAHA ÖNCEDEN BU FORUM İÇİN YETKİLENDİRİLMİŞSE UPDATE  //

	else
	{
		// YETKİSİ GERİ ALINIYORSA VERİTABANINDAN SİL
		if (($_POST['okuma'] == '0') AND ($_POST['yazma'] == '0') AND ($_POST['konu_acma'] == '0') AND ($_POST['yonetme'] == '0'))
		{
			$vtsorgu = "DELETE FROM $tablo_ozel_izinler WHERE grup='$grup_satir[id]' AND fno='$_POST[fno]'";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

			// GRUBUN BAŞKA YÖNETİCİLİĞİ YOKSA, KULLANICI YETKİSİ NORMALE DÜŞÜRÜLÜYOR
			$vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE grup='$grup_satir[id]' AND yonetme='1'";
			$yardimcilik = $vt->query($vtsorgu) or die ($vt->hata_ver());

			if (!$vt->num_rows($yardimcilik))
			{
				$vtsorgu = "UPDATE $tablo_gruplar SET yetki='-1' WHERE id='$grup_satir[id]'";
				$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


				// Ayrıca grup üyelerinin başka yardımcılığı olup olmadığına bakılıyor
				$vtsorgu = "SELECT id FROM $tablo_kullanicilar WHERE grupid='$grup_satir[id]'";
				$vtsonucguye = $vt->query($vtsorgu) or die ($vt->hata_ver());

				while ($guye = $vt->fetch_assoc($vtsonucguye))
				{
					$vtsorgu = "SELECT kulid FROM $tablo_ozel_izinler WHERE kulid='$guye[id]' AND yonetme='1'";
					$yardimcilik = $vt->query($vtsorgu) or die ($vt->hata_ver());

					// başka yardımcılığı yoksa yetkisi normale düşürülüyor
					if (!$vt->num_rows($yardimcilik))
					{
						$vtsorgu = "UPDATE $tablo_kullanicilar SET yetki='0' WHERE id='$guye[id]' LIMIT 1";
						$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
					}
				}
			}
		}

		else
		{
			$vtsorgu = "UPDATE $tablo_ozel_izinler SET okuma='$_POST[okuma]', yazma='$_POST[yazma]', yonetme='$_POST[yonetme]', konu_acma='$_POST[konu_acma]' WHERE grup='$grup_satir[id]' AND fno='$_POST[fno]'";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


			// YÖNETİM VERİLMEMİŞSE, BAŞKA YARDIMCILIĞI DA YOKSA...
			// KULLANICI YETKİSİ NORMALE DÜŞÜRÜLÜYOR
			if ($_POST['yonetme'] == '0')
			{
				$vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE grup='$grup_satir[id]' AND yonetme='1'";
				$yardimcilik = $vt->query($vtsorgu) or die ($vt->hata_ver());

				if (!$vt->num_rows($yardimcilik))
				{
					$vtsorgu = "UPDATE $tablo_kullanicilar SET yetki='0' WHERE grupid='$grup_satir[id]'";
					$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

					$vtsorgu = "UPDATE $tablo_gruplar SET yetki='-1' WHERE id='$grup_satir[id]'";
					$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
				}
			}
		}
	}
}








//  İZİNLERİ GÖSTER TIKLANIŞSA  //

if ((isset($_POST['izingoster'])) AND ($_POST['izingoster'] != ''))
{
	if ((!isset($_POST['forum_sec'])) OR ($_POST['forum_sec'] == ''))
	{
		header('Location: hata.php?hata=152');
		exit();
	}

	else $_POST['forum_sec'] = zkTemizle($_POST['forum_sec']);


	// FORUM İZİN BİLGİLERİ ÇEKİLİYOR
	$vtsorgu = "SELECT id,forum_baslik,okuma_izni,yazma_izni,konu_acma_izni FROM $tablo_forumlar WHERE id='$_POST[forum_sec]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$forum_izin = $vt->fetch_array($vtsonuc);


	//  SEÇİLEN FORUMUN İZİNLERİ ÖZEL AYARINDA DEĞİLSE UYARILIYOR  //

	if (($forum_izin['okuma_izni'] == 5) OR ($forum_izin['konu_acma_izni'] == 5) OR ($forum_izin['yazma_izni'] == 5))
	{
		header('Location: hata.php?hata=161');
		exit();
	}

	if (($forum_izin['okuma_izni'] == 1) OR ($forum_izin['konu_acma_izni'] == 1) OR ($forum_izin['yazma_izni'] == 1))
	{
		header('Location: hata.php?hata=146');
		exit();
	}

	if (($forum_izin['okuma_izni'] == 2) OR ($forum_izin['konu_acma_izni'] == 2) OR ($forum_izin['yazma_izni'] == 2))
	{
		header('Location: hata.php?hata=194');
		exit();
	}


	// üye - grup seçimi
	if ($_POST['izingoster'] == 'uye') $ek_sorgu = "kulad='$kullanici_satir[kullanici_adi]'";
	else $ek_sorgu = "grup='$grup_satir[id]'";


	// İZİN BİLGİLERİ ÇEKİLİYOR
	$vtsorgu = "SELECT * FROM $tablo_ozel_izinler WHERE $ek_sorgu AND fno='$forum_izin[id]'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$izinler_satir = $vt->fetch_array($vtsonuc);


	// DAHA ÖNCEDEN BU FORUM İÇİN YETKİLENDİRİLMEMİŞSE
	// DEĞİŞKEN DEĞERİ 0 (YETKİSİZ) YAPILIYOR
	if (empty($izinler_satir))
	{
		$izinler_satir['okuma_izni'] = 0;
		$izinler_satir['yazma_izni'] = 0;
		$izinler_satir['konu_acma_izni'] = 0;
		$izinler_satir['yonetme_izni'] = 0;
	}
}








//  SAYFA GÖSTERİMİ  //

$tema_sayfa_icerik = '<table cellspacing="0" width="610" cellpadding="0" border="0" align="center">
	<tr class="tablo_ici">
	<td align="left" class="liste-veri">';



if ((!isset($kullanici_satir['id'])) AND (!isset($grup_satir['id']))):

$tema_sayfa_icerik .= '<script type="text/javascript"><!-- //
function uye_ara(){
var uye = document.kul_izinleri.kim.value;
window.open("../oi_yaz.php?kip=2&uye_ara="+uye, "_uyeara", "resizable=yes,width=390,height=350,scrollbars=yes");}
//  -->
</script>


<form name="kul_izinleri" action="'.$dosya_adi.'" method="get">
<p align="center">
<b>Üye Adı: &nbsp; </b><input type="text" name="kim" value="" class="input-text" />
&nbsp;<input type="submit" value="Yetki" class="dugme dugme-mavi" />
&nbsp;&nbsp; <a style="font-weight: normal; text-decoration: underline" href="javascript:uye_ara();">Üye Ara</a>
</p>
</form>

<br>
<br>

&nbsp; &nbsp; Üyelere özel yetkiler vermek için yukarıdaki alana üyenin kullanıcı adını tam olarak yazın.
<br>
Ya da <a href="uyeler.php">bu sayfadan</a> istediğiniz üyenin yanındaki <b>Ö. Yetki</b> bağlantısını tıklayın.
<br>
<br>
Gruplar için; <a href="uye_gruplar.php">bu sayfadan</a> istediğiniz üye grubunun yanındaki <b>Özel yetki ver</b> bağlantısını tıklayın.
<br>
<br>
<br>Üye veya grup seçimini yaptıktan sonra açılan sayfadan özel yetki vermek istediğiniz forumu seçerek istediğiniz özel yetkiyi verebilirsiniz. 

<br><br>
	</td>
	</tr>
';




elseif ((isset($kullanici_satir['id'])) OR (isset($_GET['grup']))):


if (isset($kullanici_satir['id']))
{
	$tema_sayfa_icerik .= '<form name="kul_izinleri" action="'.$dosya_adi.'?kim='.$kullanici_satir['kullanici_adi'].'#izinver" method="post">
	<input type="hidden" name="izingoster" value="uye" />

	<br> &nbsp; &nbsp; &nbsp; <b>'.$kullanici_satir['kullanici_adi'].'</b> isimli üyeye, bölüm yardımcılığı veya özel izin vermek istediğiniz forumu aşağıdan seçip, "Forumu Seç" düğmesine tıklayın. Daha sonra altta çıkan alandan okuma, konu açma, cevap yazma veya yönetme yetkisi verebilirsiniz.';
}

else
{
	$tema_sayfa_icerik .= '<form name="grup_izinleri" action="'.$dosya_adi.'?grup='.$grup_satir['id'].'#izinver" method="post">
	<input type="hidden" name="izingoster" value="grup" />

	<br> &nbsp; &nbsp; &nbsp; <b>'.$grup_satir['grup_adi'].'</b> isimli gruba, bölüm yardımcılığı veya özel izin vermek istediğiniz forumu aşağıdan seçip, "Forumu Seç" düğmesine tıklayın. Daha sonra altta çıkan alandan okuma, konu açma, cevap yazma veya yönetme yetkisi verebilirsiniz.';
}



$tema_sayfa_icerik .= '<br><br>
<center>
<b>Forum Seç:</b>
<br><br>';





// forum dalı adları çekiliyor

$vtsorgu = "SELECT id,ana_forum_baslik FROM $tablo_dallar ORDER BY sira";
$dallar_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$forum_secenek = '<select name="forum_sec" class="input-select" size="15" style="height:unset">';

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

			if ( ( isset($_POST['forum_sec']) ) AND ($_POST['forum_sec'] == $forum_satir['id']) ) $forum_secenek .= ' selected="selected">';
			elseif ( ( isset($_POST['fno']) ) AND ($_POST['fno'] == $forum_satir['id']) ) $forum_secenek .= ' selected="selected">';
			else $forum_secenek .= '>';

			$forum_secenek .= ' &nbsp; + '.$forum_satir['forum_baslik'].'</option>';
		}


		else
		{
			$forum_secenek .= '
			<option value="'.$forum_satir['id'].'"';

			if ( ( isset($_POST['forum_sec']) ) AND ($_POST['forum_sec'] == $forum_satir['id']) ) $forum_secenek .= ' selected="selected">';
			elseif ( ( isset($_POST['fno']) ) AND ($_POST['fno'] == $forum_satir['id']) ) $forum_secenek .= ' selected="selected">';
			else $forum_secenek .= '>';

			$forum_secenek .= ' &nbsp; + '.$forum_satir['forum_baslik'].'</option>';


			while ($alt_forum_satir = $vt->fetch_array($vtsonuca))
			{
				$forum_secenek .= '
				<option value="'.$alt_forum_satir['id'].'"';

				if ( ( isset($_POST['forum_sec']) ) AND ($_POST['forum_sec'] == $alt_forum_satir['id']) ) $forum_secenek .= ' selected="selected">';
				elseif ( ( isset($_POST['fno']) ) AND ($_POST['fno'] == $alt_forum_satir['id']) ) $forum_secenek .= ' selected="selected">';
				else $forum_secenek .= '>';

				$forum_secenek .= ' &nbsp; &nbsp; &nbsp; - '.$alt_forum_satir['forum_baslik'].'</option>';
			}
		}
	}
}


$forum_secenek .= '</select>';



$tema_sayfa_icerik .= $forum_secenek.'
</center>
<br>
<p align="center"><input type="submit" value="Forum Seç" class="dugme dugme-mavi" /></p>
<br>';



if ((isset($_POST['izindegistir'])) AND ($_POST['izindegistir'] == 'uye'))
$tema_sayfa_icerik .= '<p align="center"><font color="green"><b>'.$kullanici_satir['kullanici_adi'].' isimli üyenin, " '.$_POST['fad']. ' "<br>forumundaki izinleri değiştirilmiştir.</b></font></p><br>';

elseif ((isset($_POST['izindegistir'])) AND ($_POST['izindegistir'] == 'grup'))
$tema_sayfa_icerik .= '<p align="center"><font color="green"><b>'.$grup_satir['grup_adi'].' isimli grubun, " '.$_POST['fad']. ' "<br>forumundaki izinleri değiştirilmiştir.</b></font></p><br>';


$tema_sayfa_icerik .= '
</form>
	</td>
	</tr>';




// FORUM SEÇ TIKLANMIŞSA //

if (isset($forum_izin)):


$tema_sayfa_icerik .= '
<tr class="tablo_ici">
<td align="center">

<a name="izinver"></a>
<hr>
<br>';



$tema_sayfa_icerik .= '<font class="liste-etiket">'.$forum_izin['forum_baslik'].' Bölümü İzinleri</font>
<br><br>';


if (isset($kullanici_satir['id']))
{
	$tema_sayfa_icerik .= '<form name="kul_izinleri" action="'.$dosya_adi.'?kim='.$kullanici_satir['kullanici_adi'].'" method="post">
	<input type="hidden" name="izindegistir" value="uye" />
	<input type="hidden" name="fno" value="'.$forum_izin['id'].'" />
	<input type="hidden" name="fad" value="'.$forum_izin['forum_baslik'].'" />';
}

else
{
	$tema_sayfa_icerik .= '<form name="grup_izinleri" action="'.$dosya_adi.'?grup='.$grup_satir['id'].'" method="post">
	<input type="hidden" name="izindegistir" value="grup" />
	<input type="hidden" name="fno" value="'.$forum_izin['id'].'" />
	<input type="hidden" name="fad" value="'.$forum_izin['forum_baslik'].'" />';
}



$tema_sayfa_icerik .= '
<table cellspacing="1" cellpadding="2" width="450" border="0" align="center">
	<tr>
	<td class="liste-etiket" align="left" width="120" valign="top">Okuma:</td>
	<td class="liste-veri" align="left" valign="top">';



//  OKUMA YETKİLERİ

if ((empty($forum_izin['okuma_izni'])) OR ($forum_izin['okuma_izni'] == 0))
{
	$tema_sayfa_icerik .= 'Herkesin okuma yetkisi var.';
	$tema_sayfa_icerik .= '<input type="hidden" name="okuma" value="0" />';
}

elseif ((isset($forum_izin['okuma_izni'])) AND ($forum_izin['okuma_izni'] == 4))
{
	$tema_sayfa_icerik .= 'Tüm üyelerin okuma yetkisi var.';
	$tema_sayfa_icerik .= '<input type="hidden" name="okuma" value="0" />';
}

else
{
	$tema_sayfa_icerik .= '<select name="okuma" class="input-select">';

	if ((empty($izinler_satir['okuma'])) OR ($izinler_satir['okuma'] == 0))
	$tema_sayfa_icerik .= '<option value="0" selected="selected">Yetkisi Yok</option>
	<option value="1">Yetki Ver</option>';

	elseif ((isset($izinler_satir['okuma'])) AND ($izinler_satir['okuma'] == 1))
	$tema_sayfa_icerik .= '<option value="0">Yetkiyi Al</option>
	<option value="1" selected="selected">Yetkisi Var</option>';

	$tema_sayfa_icerik .= '</select>';
}

$tema_sayfa_icerik .= '
<br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" align="left" valign="top">Konu Açma:</td>
	<td class="liste-veri" align="left" valign="top">';


//  KONU YETKİLERİ

if ((empty($forum_izin['konu_acma_izni'])) OR ($forum_izin['konu_acma_izni'] == 0))
{
	$tema_sayfa_icerik .= 'Zaten tüm üyelerin konu açma yetkisi var.';
	$tema_sayfa_icerik .= '<input type="hidden" name="konu_acma" value="0" />';
}

elseif ((isset($forum_izin['konu_acma_izni'])) AND ($forum_izin['konu_acma_izni'] == 2))
{
	$tema_sayfa_icerik .= 'Sadece bölüm yardımcılığı yetkisi verdiğiniz üyeler konu açabilir.';
	$tema_sayfa_icerik .= '<input type="hidden" name="konu_acma" value="0" />';
}

else
{
	$tema_sayfa_icerik .= '<select name="konu_acma" class="input-select">';

	if ((empty($izinler_satir['konu_acma'])) OR ($izinler_satir['konu_acma'] == 0))
	$tema_sayfa_icerik .= '<option value="0" selected="selected">Yetkisi Yok</option>
	<option value="1">Yetki Ver</option>';

	elseif ((isset($izinler_satir['konu_acma'])) AND ($izinler_satir['konu_acma'] == 1))
	$tema_sayfa_icerik .= '<option value="0">Yetkiyi Al</option>
	<option value="1" selected="selected">Yetkisi Var</option>';

	$tema_sayfa_icerik .= '</select>';
}



$tema_sayfa_icerik .= '<br><br>
	</td>
	</tr>


	<tr>
	<td class="liste-etiket" align="left" valign="top">Cevap Yazma:</td>
	<td class="liste-veri" align="left" valign="top">';


//  CEVAP YETKİLERİ

if ((empty($forum_izin['yazma_izni'])) OR ($forum_izin['yazma_izni'] == 0))
{
	$tema_sayfa_icerik .= 'Zaten tüm üyelerin cevap yazma yetkisi var.';
	$tema_sayfa_icerik .= '<input type="hidden" name="yazma" value="0" />';
}

else
{
	$tema_sayfa_icerik .= '<select name="yazma" class="input-select">';

	if ((empty($izinler_satir['yazma'])) OR ($izinler_satir['yazma'] == 0))
	$tema_sayfa_icerik .= '<option value="0" selected="selected">Yetkisi Yok</option>
	<option value="1">Yetki Ver</option>';

	elseif ((isset($izinler_satir['yazma'])) AND ($izinler_satir['yazma'] == 1))
	$tema_sayfa_icerik .= '<option value="0">Yetkiyi Al</option>
	<option value="1" selected="selected">Yetkisi Var</option>';

	$tema_sayfa_icerik .= '</select>';
}


$tema_sayfa_icerik .= '
<br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" align="left" valign="top">Yönetme:</td>
	<td class="liste-veri" align="left" valign="top">';



//  YÖNETME YETKİLERİ

if (($forum_izin['konu_acma_izni'] == 1) OR ($forum_izin['yazma_izni'] == 1))
$tema_sayfa_icerik .= 'Bu forumu sadece yöneticiler yönetebilir.';

elseif ((empty($izinler_satir['yonetme'])) OR ($izinler_satir['yonetme'] == 0))
$tema_sayfa_icerik .= '<select name="yonetme" class="input-select">
<option value="0" selected="selected">Yetkisi Yok</option>
<option value="1">Yetki Ver</option>
</select> &nbsp; Bu bölümün yardımcısı yap.';


elseif ((isset($izinler_satir['yonetme'])) AND ($izinler_satir['yonetme'] == 1))
$tema_sayfa_icerik .= '<select name="yonetme" class="input-select">
<option value="0">Yetkiyi Al</option>
<option value="1" selected="selected">Yetkisi Var</option>
</select> &nbsp; Bu bölümün yardımcısı yap.';



$tema_sayfa_icerik .= '<br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="left" valign="top" colspan="2">
<i>Yönetme yetkisi verdiğinizde, üye o bölümün yardımcısı olur. Ayrıca okuma, konu açma veya cevap yazma yetkisi vermenize gerek kalmaz.</i>
	</td>
	</tr>
</table>


<br>
<input type="submit" value="İzinleri Değiştir" class="dugme dugme-mavi" />

<br><br>
</form>';


//  FORM İZİNLERİ GÖRÜNTÜLENİYOR - SONU  //

endif;
endif;



$tema_sayfa_icerik .= '</table>';



// tema dosyası yükleniyor
$sayfa_adi = 'Üye ve Grup Yetkileri';
$tema_sayfa_baslik = 'Üye ve Grup Yetkileri';
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>