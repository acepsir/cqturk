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



// yazı, galeri, video tip seçimi belirleniyor
$sayfa_adi = $ly['yazi_ve_sayfalar'];
$tema_sayfa_baslik = $ly['yazi_ve_sayfalar'];
$yeni_ekle = $ly['yeni_yazi_ekle'];
$tema_sayfa_icerik = '';
$ktip = '0';


if (isset($_GET['ktip']))
{
	if ($_GET['ktip'] == '1')
	{
		$sayfa_adi = $ly['galeriler'];
		$tema_sayfa_baslik = $ly['galeriler'];
		$yeni_ekle = $ly['yeni_galeri_ekle'];
		$ktip = 1;
	}
	elseif ($_GET['ktip'] == '2')
	{
		$sayfa_adi = $ly['videolar'];
		$tema_sayfa_baslik = $ly['videolar'];
		$yeni_ekle = $ly['yeni_video_ekle'];
		$ktip = 2;
	}
}


// Eklenen diller kontrol ediliyor
$dil_eklenen = ',';
if ($ayarlar['dil_eklenen_alanlar'] != ',')
{
	$dileklenen = explode(',', $ayarlar['dil_eklenen_alanlar']);
	foreach ($dileklenen as $dil)
	{
		if ($dil == '') continue;
		$yazi_ad = "baslik_$dil";

		// bağlantılar tablosunda dil var mı?
		$vtsorgu = "SHOW FIELDS FROM $tablo_yazilar WHERE Field='$yazi_ad'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		if ($vt->num_rows($vtsonuc)) $dil_eklenen .= $dil.',';
	}
}





//  KATEGORİ GÖSTERİMİ - BAŞI  //


if ( (isset($_GET['k'])) AND ($_GET['k'] != '') AND (is_numeric($_GET['k'])) AND ($_GET['k'] != 0) ):

$kat_id = @zkTemizle($_GET['k']);
$kat_kota = $ayarlar['syfkota_kat'];


// sayfa işlemleri
if ((isset($_GET['s'])) AND ($_GET['s'] != '')) $sayfano = @zkTemizle($_GET['s']);
else $sayfano = 1;
if (!is_numeric($sayfano)) $sayfano = 1;
if ($sayfano == 1) $baslangic = 1;
else $baslangic = ($sayfano*$kat_kota-$kat_kota)+1;


// kategori veritabanından çekiliyor
$vtsorgu = "SELECT id,baslik FROM $tablo_kategoriler WHERE id='$kat_id' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$kategori = $vt->fetch_assoc($vtsonuc);


// kategorideki yazıların toplamı alınıyor
$vtsorgu = "SELECT id FROM $tablo_yazilar WHERE kategori like '%,$kategori[id],%' AND alt_yazi=0";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$toplam_yazi = $vt->num_rows($vtsonuc);


$tema_sayfa_baslik = '"'.$kategori['baslik'].'" '.$ly['kategorisindeki'].' '.$sayfa_adi;
$tema_sayfa_icerik = '';
$duzenle_simge = '<img src="phpkf-bilesenler/temalar/varsayilan/resimler/duzenle.png" width="17" height="17" alt="d" style="margin-left:10px; margin-right:10px" title="'.$ly['yaziyi_duzenle'].'" />';
$sil_simge = '<img src="phpkf-bilesenler/temalar/varsayilan/resimler/sil.png" width="15" height="15" alt="s" style="margin-left:10px; margin-right:10px" title="'.$ly['yaziyi_sil'].'" />';
$alt_sayfa_simge = '<img src="phpkf-bilesenler/temalar/varsayilan/resimler/alt-sayfa.png" width="27" height="26" alt="a" style="margin-left:10px; margin-right:10px; margin-bottom:-8px" title="'.$ly['alt_sayfa_ekle'].'" />';


if ($toplam_yazi > 0)
{
	// toplam sayfa hesaplanıyor
	$toplam = ($toplam_yazi / $kat_kota);
	settype($toplam,'integer');
	if (($toplam_yazi % $kat_kota) != 0) $toplam++;

	// sayfalama koşulu hesaplanıyor
	$kosul_sayfa = ($sayfano * $kat_kota)-$kat_kota;


	// sayfa numarası toplam sayfadan büyükse hata ver
	if ($sayfano > $toplam)
	{
		header('Location: hatalar.php?hata=12');
		exit();
	}


	// yazılar veritabanından çekiliyor
	$vtsorgu = "SELECT id,tip,sayfa_no,baslik FROM $tablo_yazilar WHERE kategori like '%,$kategori[id],%' AND alt_yazi=0 ORDER BY tip!=1,tip!=3,yayin_tarihi DESC LIMIT $kosul_sayfa,$kat_kota";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	while($sayfalar = $vt->fetch_assoc($vtsonuc))
	{
		$altsayfa_ekle = ' &nbsp; <a href="yazi_ekle.php?ktip='.$ktip.'&amp;kip=altyazi&amp;y='.$sayfalar['id'].'" style="font-size:10px">'.$alt_sayfa_simge.'</a>';

		if ($sayfalar['tip'] == 0) $sayfa_tip = '<b style="padding:3px;cursor:help" title="'.$l['sayfa'].'">'.$ly['kisa_sayfa'].'</b>';
		elseif ($sayfalar['tip'] == 1) $sayfa_tip = '<b style="padding:3px;cursor:help" title="'.$l['anasayfa'].'">'.$ly['kisa_anasayfa'].'</b>';
		elseif ($sayfalar['tip'] == 3) $sayfa_tip = '<b style="padding:3px;cursor:help" title="'.$l['iletisim'].'">'.$ly['kisa_iletisim'].'</b>';
		elseif ($sayfalar['tip'] == 4) $sayfa_tip = '<b style="padding:3px;cursor:help" title="'.$l['galeri'].'">'.$ly['kisa_galeri'].'</b>';
		elseif ($sayfalar['tip'] == 5) $sayfa_tip = '<b style="padding:3px;cursor:help" title="'.$l['video'].'">'.$ly['kisa_video'].'</b>';
		else{
			$sayfa_tip = '<b style="padding:3px;cursor:help" title="'.$l['yazi'].'">'.$ly['kisa_yazi'].'</b>';
			$altsayfa_ekle = '';
		}


		// Dil seçim formu hazırlanıyor
		$dil_ekle = '';
		if ($dil_eklenen != ',')
		{
			$dileklenen = explode(',', $dil_eklenen);
			foreach ($dileklenen as $dil)
			{
				if ($dil == '') continue;
				$dil_ekle .= '<a href="yazi_ekle.php?kip=duzenle&amp;dil_ekle='.$dil.'&amp;y='.$sayfalar['id'].'" style="margin-left:20px" title="'.$diller[$dil].' '.$ly['icerik_ekle'].'">'.strtoupper($dil).'</a>';
			}
		}


		$tema_sayfa_icerik .= '<div class="form-div"><label class="yonetim-label" style="width:50%">'.$sayfa_tip.'
		<a href="../'.$phpkf_dosyalar['cms'].'?y='.$sayfalar['id'].'">'.$sayfalar['baslik'].'</a></label><div style="width:50%">
		<a href="yazi_ekle.php?ktip='.$ktip.'&amp;kip=duzenle&amp;y='.$sayfalar['id'].'" style="font-size:10px">'.$duzenle_simge.'</a> &nbsp; 
		<a href="phpkf-bilesenler/yazi_ekle_yap.php?ktip='.$ktip.'&amp;kip=sil&amp;y='.$sayfalar['id'].'&amp;yo='.$yo.'" style="font-size:10px" 
		onclick="return window.confirm(\''.$ly['icerik_sil_uyari'].'\')">'.$sil_simge.'</a>'.
		$dil_ekle.$altsayfa_ekle.'</div></div>';


		// Alt yazıları varsa
		if ($sayfalar['sayfa_no'] == 1)
		{
			// yazının alt yazıları veritabanından çekiliyor
			$vtsorgu = "SELECT id,baslik,sayfa_no FROM $tablo_yazilar WHERE alt_yazi='$sayfalar[id]' ORDER BY sayfa_no";
			$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());

			while($alt_yazilar = $vt->fetch_assoc($vtsonuc2))
			{
				$tema_sayfa_icerik .= '<div class="form-div" style="margin-left:30px"><label class="yonetim-label" style="width:50%">
				<b>'.$alt_yazilar['sayfa_no'].'.&nbsp;</b>
				<a href="../'.$phpkf_dosyalar['cms'].'?y='.$sayfalar['id'].'&amp;ys='.$alt_yazilar['sayfa_no'].'">'.$alt_yazilar['baslik'].'</a></label>
				<div style="width:50%;position:relative;left:-15px">
				<a href="yazi_ekle.php?ktip='.$ktip.'&amp;kip=duzenle&amp;y='.$alt_yazilar['id'].'" style="font-size:10px">'.$duzenle_simge.'</a> &nbsp; 
				<a href="phpkf-bilesenler/yazi_ekle_yap.php?ktip='.$ktip.'&amp;kip=sil&amp;y='.$alt_yazilar['id'].'&amp;yo='.$yo.'" style="font-size:10px" onclick="return window.confirm(\''.$ly['altsayfa_sil_uyari'].'\')">'.$sil_simge.'</a></div></div>';
			}
		}
	}
	$TEMA_SAYFALAMA = phpkf_sayfalama($toplam_yazi, $kat_kota, $sayfano, 's=');
}

else
{
	if ($ktip == 1) $tema_sayfa_icerik .= '<br /><center>'.$l['kategori_galeri_yok'].'</center><br />';
	elseif ($ktip == 2) $tema_sayfa_icerik .= '<br /><center>'.$l['kategori_video_yok'].'</center><br />';
	else $tema_sayfa_icerik .= '<br /><center>'.$l['kategori_yazi_yok'].'</center><br />';
}


//  KATEGORİ GÖSTERİMİ - SONU  //





//  ANA SAYFA GÖSTERİMİ - BAŞI  //


else:

// kategoriler veritabanından çekiliyor

$vtsorgu = "SELECT id,baslik FROM $tablo_kategoriler WHERE tip='$ktip' ORDER BY sira,id";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$toplam_kat = 0;

while($kategori = $vt->fetch_assoc($vtsonuc))
{
	if ($ktip == '0')
	{
		// kategorideki sayfaların toplamı alınıyor
		$vtsorgu = "SELECT id,baslik FROM $tablo_yazilar WHERE kategori like '%,$kategori[id],%' AND tip=0 AND alt_yazi=0";
		$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$toplam_sayfa = $vt->num_rows($vtsonuc2);

		// kategorideki ana sayfaların toplamı alınıyor
		$vtsorgu = "SELECT id,baslik FROM $tablo_yazilar WHERE kategori like '%,$kategori[id],%' AND tip=1 AND alt_yazi=0";
		$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$toplam_anasayfa = $vt->num_rows($vtsonuc2);

		// kategorideki iletişim sayfalarının toplamı alınıyor
		$vtsorgu = "SELECT id,baslik FROM $tablo_yazilar WHERE kategori like '%,$kategori[id],%' AND tip=3 AND alt_yazi=0";
		$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$toplam_iletisim = $vt->num_rows($vtsonuc2);

		// kategorideki yazıların toplamı alınıyor
		$vtsorgu = "SELECT id,baslik FROM $tablo_yazilar WHERE kategori like '%,$kategori[id],%' AND tip=2 AND alt_yazi=0";
		$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$toplam_yazi = $vt->num_rows($vtsonuc2);

		if (($toplam_sayfa + $toplam_yazi + $toplam_anasayfa + $toplam_iletisim) > 0)
		{
			$anasayfa_ek = '';
			if ($toplam_anasayfa > 0) $anasayfa_ek .= ' <b>'.$toplam_anasayfa.'</b> '.$l['anasayfa'].', ';
			if ($toplam_iletisim > 0) $anasayfa_ek .= ' <b>'.$toplam_iletisim.'</b> '.$l['iletisim'].$l['sayfasi'].', ';

			$kategori_yazi_sonuc = $anasayfa_ek.'<b>'.$toplam_sayfa.'</b> '.$l['sayfa'].' '.$l['ve'].' <b>'.$toplam_yazi.'</b> '.$l['yazi'];
			$tema_sayfa_icerik2 = '<li>'.str_replace('{00}', $kategori_yazi_sonuc, $ly['kategori_yazi_sonuc']).'</li>';
		}
		else $tema_sayfa_icerik2 = '<li>'.$l['kategori_yazi_yok'].'</li>';
	}

	elseif ($ktip == 1)
	{
		// kategorideki galerilerin toplamı alınıyor
		$vtsorgu = "SELECT id,baslik FROM $tablo_yazilar WHERE kategori like '%,$kategori[id],%' AND tip=4 AND alt_yazi=0";
		$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$toplam_galeri = $vt->num_rows($vtsonuc2);

		if ($toplam_galeri > 0) $tema_sayfa_icerik2 = '<li>'.str_replace('{00}', '<b>'.$toplam_galeri.'</b>', $l['kategori_galeri_sonuc']).'</li>';
		else $tema_sayfa_icerik2 = '<li>'.$l['kategori_galeri_yok'].'</li>';
	}

	else
	{
		// kategorideki videolar toplamı alınıyor
		$vtsorgu = "SELECT id,baslik FROM $tablo_yazilar WHERE kategori like '%,$kategori[id],%' AND tip=5 AND alt_yazi=0";
		$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$toplam_video = $vt->num_rows($vtsonuc2);

		if ($toplam_video > 0) $tema_sayfa_icerik2 = '<li>'.str_replace('{00}', '<b>'.$toplam_video.'</b>', $l['kategori_video_sonuc']).'</li>';
		else $tema_sayfa_icerik2 = '<li>'.$l['kategori_video_yok'].'</li>';
	}


	$tema_sayfa_icerik .= '<fieldset>
	<legend class="border">
	<a href="yazilar.php?ktip='.$ktip.'&amp;k='.$kategori['id'].'">'.$kategori['baslik'].'</a>
	</legend>
	<ul class="liste-daire">
	'.$tema_sayfa_icerik2.'
	</ul></fieldset>';

	unset($toplam_sayfa);
	unset($toplam_yazi);
	unset($toplam_anasayfa);
	$toplam_kat++;
}

// Hiç kategori yoksa
if ($toplam_kat == 0) $tema_sayfa_icerik .= $l['kategori_yok'];


//  ANA SAYFA GÖSTERİMİ - SONU  //


endif;



if (isset($kat_id)) {
	if ($ktip == 1) $sayfa_tipi_tanim = '<a href="yazilar.php">'.$l['yazilar'].'</a> &nbsp;|&nbsp; <b>'.$l['galeriler'].'</b> &nbsp;|&nbsp; <a href="yazilar.php?ktip=2">'.$l['videolar'].'</a>';
	elseif ($ktip == 2) $sayfa_tipi_tanim = '<a href="yazilar.php">'.$l['yazilar'].'</a> &nbsp;|&nbsp; <a href="yazilar.php?ktip=1">'.$l['galeriler'].'</a> &nbsp;|&nbsp; <b>'.$l['videolar'].'</b>';
	else $sayfa_tipi_tanim = '<span style="cursor:help" title="'.$ly['kisa_anasayfa'].' ('.$l['anasayfa'].') '.$ly['kisaltmasi'].'"><b>'.$ly['kisa_anasayfa'].' &nbsp;</b>'.$l['anasayfa'].'</span> &nbsp;|&nbsp;
<span style="cursor:help" title="'.$ly['kisa_sayfa'].' ('.$l['sayfa'].') '.$ly['kisaltmasi'].'"><b>'.$ly['kisa_sayfa'].' &nbsp;</b>'.$l['sayfa'].'</span> &nbsp;|&nbsp;
<span style="cursor:help" title="'.$ly['kisa_yazi'].' ('.$l['yazi'].') '.$ly['kisaltmasi'].'"><b>'.$ly['kisa_yazi'].' &nbsp;</b>'.$l['yazi'].'</span> &nbsp;|&nbsp;
<span style="cursor:help" title="'.$ly['kisa_iletisim'].' ('.$l['iletisim'].') '.$ly['kisaltmasi'].'"><b>'.$ly['kisa_iletisim'].' &nbsp;</b>'.$l['iletisim'].'</span> &nbsp;|&nbsp;
<span style="cursor:help" title="'.$ly['kisa_galeri'].' ('.$l['galeri'].') '.$ly['kisaltmasi'].'"><b>'.$ly['kisa_galeri'].' &nbsp;</b>'.$l['galeri'].'</span> &nbsp;|&nbsp;
<span style="cursor:help" title="'.$ly['kisa_video'].' ('.$l['video'].') '.$ly['kisaltmasi'].'"><b>'.$ly['kisa_video'].' &nbsp;</b>'.$l['video'].'</span>';

	$katman_aralik = 'margin-bottom:35px';
}
else {
	// kategori tipi
	if ($ktip == 1) $sayfa_tipi_tanim = '<a href="yazilar.php">'.$l['yazilar'].'</a> &nbsp;|&nbsp; <b>'.$l['galeriler'].'</b> &nbsp;|&nbsp; <a href="yazilar.php?ktip=2">'.$l['videolar'].'</a>';
	elseif ($ktip == 2) $sayfa_tipi_tanim = '<a href="yazilar.php">'.$l['yazilar'].'</a> &nbsp;|&nbsp; <a href="yazilar.php?ktip=1">'.$l['galeriler'].'</a> &nbsp;|&nbsp; <b>'.$l['videolar'].'</b>';
	else $sayfa_tipi_tanim = '<b>'.$l['yazilar'].'</b> &nbsp;|&nbsp; <a href="yazilar.php?ktip=1">'.$l['galeriler'].'</a> &nbsp;|&nbsp; <a href="yazilar.php?ktip=2">'.$l['videolar'].'</a>';

	$katman_aralik = 'margin-bottom:20px';
}


$tema_sayfa_icerik = '<div class="yonetim-form">
<div style="float:left;width:100%;margin-left:5px;'.$katman_aralik.'">
<div style="float:left;width:75%;text-align:left;">'.$sayfa_tipi_tanim.'</div>
<div style="float:left;width:25%;text-align:right;">[<a href="yazi_ekle.php?ktip='.$ktip.'">'.$yeni_ekle.'</a>]</div>
</div>

<div style="clear:both"></div>'
.$tema_sayfa_icerik.
'</div>';



// tema dosyası yükleniyor
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>