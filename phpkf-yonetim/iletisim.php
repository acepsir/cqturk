<?php
/*
 +-=========================================================================-+
 |                              phpKF-CMS v3.00                              |
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
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');



if ( (isset($_GET['sil'])) AND ($_GET['sil'] != '') AND (is_numeric($_GET['sil'])) AND ($_GET['sil'] != 0) )
{
	// yönetim oturum kodu
	if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
	else $gyo = '';

	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: ../hatalar.php?hata=45');
		exit();
	}

	// yazı id kontrol ediliyor
	if (isset($_GET['sil'])) $id = @zkTemizle($_GET['sil']);
	else $id = 0;

	if ( (!is_numeric($id)) OR ($id == 0) )
	{
		header('Location: ../hatalar.php?hata=4');
		exit();
	}


	// mesaj veritabanından çekiliyor
	$vtsonuc = $vt->query("SELECT id FROM $tablo_iletisim WHERE id='$id' LIMIT 1") or die ($vt->hata_ver());
	$mesaj = $vt->fetch_assoc($vtsonuc);


	// yazı yoksa hata ver
	if (!isset($mesaj['id']))
	{
		header('Location: ../hatalar.php?hata=4');
		exit();
	}

	// mesaj siliniyor
	$vtsonuc = $vt->query("DELETE FROM $tablo_iletisim WHERE id='$id'") or die ($vt->hata_ver());


	header('Location: iletisim.php');
	exit();
}




else if ( (isset($_GET['i'])) AND ($_GET['i'] != '') AND (is_numeric($_GET['i'])) AND ($_GET['i'] != 0) )
{
	$id = @zkTemizle($_GET['i']);

	// iletişim bilgisi veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_iletisim WHERE id='$id' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$Mesaj = $vt->fetch_assoc($vtsonuc);
?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
<title><?php echo $ly['iletisim_mesajlari']; ?></title>
</head>
<body>
	<table width="100%" cellpadding="10" cellspacing="1" bgcolor="silver" border="0" align="left">
		<tr>
			<td colspan="2" bgcolor="white" valign="middle" align="center"><?php echo $ly['iletisim_mesajlari']; ?></td>
		</tr>
		<tr>
			<td width="120px" bgcolor="white" valign="middle" align="left"><?php echo $l['ad_soyad']; ?>: </td>
			<td bgcolor="white" valign="middle" align="left"><?php echo $Mesaj['ad_soyad']; ?></td>
		</tr>
		<tr>
			<td bgcolor="white" valign="middle" align="left"><?php echo $l['eposta']; ?>: </td>
			<td bgcolor="white" valign="middle" align="left"><?php echo $Mesaj['posta']; ?></td>
		</tr>
		<tr>
			<td bgcolor="white" valign="middle" align="left"><?php echo $l['ipadresi']; ?>: </td>
			<td bgcolor="white" valign="middle" align="left"><?php echo $Mesaj['ip']; ?></td>
		</tr>
		<tr>
			<td bgcolor="white" valign="middle" align="left"><?php echo $l['tarih']; ?>: </td>
			<td bgcolor="white" valign="middle" align="left"><?php echo zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $Mesaj['tarih'], $ayarlar['tarih'], true); ?></td>
		</tr>
		<tr>
			<td bgcolor="white" valign="middle" align="left"><?php echo $l['ipadresi']; ?>: </td>
			<td bgcolor="white" valign="middle" align="left"><?php echo $Mesaj['baslik']; ?></td>
		</tr>
		<tr>
			<td bgcolor="white" valign="top" align="left"><?php echo $l['icerik']; ?>: </td>
			<td bgcolor="white" valign="middle" align="left"><?php echo nl2br($Mesaj['icerik']); ?></td>
		</tr>
	</table>
</body>
</html>
<?php
$vtsonuc = $vt->query("UPDATE $tablo_iletisim SET okundu='1' WHERE id='$id' LIMIT 1") or die ($vt->hata_ver());
exit();

}



else
{
	$kota = 10;

	// sayfa işlemleri
	if ((isset($_GET['s'])) AND ($_GET['s'] != '')) $sayfano = @zkTemizle($_GET['s']);
	else $sayfano = 1;
	if (!is_numeric($sayfano)) $sayfano = 1;
	if ($sayfano == 1) $baslangic = 1;
	else $baslangic = ($sayfano*$kota-$kota)+1;


	// iletişim sayfası alınıyor
	$vtsorgu = "SELECT id FROM $tablo_yazilar WHERE tip=3 LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$iletisim_syf = $vt->fetch_assoc($vtsonuc);



	if (isset($iletisim_syf['id'])) $tema_sayfa_icerik = '[<a href="yazi_ekle.php?kip=duzenle&y='.$iletisim_syf['id'].'">'.$ly['iletisim_sayfasi_duzenle'].'</a>]<br /><br />';
	else $tema_sayfa_icerik = '[<a href="yazi_ekle.php?kip=iletisim">'.$ly['iletisim_sayfasi_ekle'].'</a>]<br /><br />';


	// mesajların toplamı alınıyor
	$vtsonuc = $vt->query("SELECT id FROM $tablo_iletisim") or die ($vt->hata_ver());
	$toplam_yazi = $vt->num_rows($vtsonuc);

	if ($toplam_yazi > 0)
	{
		// toplam sayfa hesaplanıyor
		$toplam = ($toplam_yazi / $kota);
		settype($toplam,'integer');
		if (($toplam_yazi % $kota) != 0) $toplam++;

		// sayfalama koşulu hesaplanıyor
		$kosul_sayfa = ($sayfano * $kota)-$kota;

		// sayfa numarası toplam sayfadan büyükse hata ver
		if ($sayfano > $toplam)
		{
			header('Location: hatalar.php?hata=12');
			exit();
		}

		// mesajlar veritabanından çekiliyor
		$vtsorgu = "SELECT id,baslik,okundu FROM $tablo_iletisim ORDER BY id LIMIT $kosul_sayfa,$kota";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		$tema_sayfa_icerik .= '<script type="text/javascript">
		function sayfa_ac(gelen){window.open(gelen,\'_blank\',\'scrollbars=yes,left=200,top=100,resizable=no,toolbar=0,status=0,width=590,height=500\');}
		</script>
		<fieldset>
		<legend class="border">'.$l['mesajlar'].'</legend>
		<ul class="liste-daire" style="list-style:none; padding:0;">';


		while($mesajlar = $vt->fetch_assoc($vtsonuc))
		{
			$tema_sayfa_icerik .= '<li style="border:1px solid silver;float:left; width:100%;">
			<span style="float:left; width:90%;">
			<a href="javascript:void(0);" onclick="sayfa_ac(\'iletisim.php?i='.$mesajlar['id'].'\');"';
			if($mesajlar['okundu'] == '0') $tema_sayfa_icerik .= ' style="display:block; padding:6px; font-weight:bolder;"';
			else $tema_sayfa_icerik .= ' style="display:block; padding:6px; font-weight:normal;"';
			$tema_sayfa_icerik .= '>'.$mesajlar['baslik'].'</a>
			</span>
			<span style="float:right; width:10%;">
			<a style="display:block; padding:6px;" href="iletisim.php?sil='.$mesajlar['id'].'&amp;yo='.$yo.'" 
			onclick="return window.confirm(\''.$l['sil_uyari'].'\')">[ '.$l['sil'].' ]</a>
			</span>
			</li>';
		}


		$TEMA_SAYFALAMA = phpkf_sayfalama($toplam_yazi, $kota, $sayfano, 's=');

		$tema_sayfa_icerik .= '</ul></fieldset>';
	}
	else $tema_sayfa_icerik .= '<br /><center>'.$ly['mesaj_yok'].'</center><br />';



	// tema dosyası yükleniyor
	$sayfa_adi = $ly['iletisim_mesajlari'];
	$tema_sayfa_baslik = $ly['iletisim_mesajlari'];
	eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));
}
?>