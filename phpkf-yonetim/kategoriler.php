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
if (!defined('DOSYA_KULLANICI_KIMLIK')) include_once('../phpkf-bilesenler/kullanici_kimlik.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');


// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';


// yazı, galeri, video tip seçimi belirleniyor
$sayfa_adi = $ly['yazi_kategorileri'];
$tema_sayfa_baslik = $ly['yazi_kategorileri'];
$ktip = '0';
$diger_kategoriler = '<b>'.$l['yazi'].'</b>
<br><a href="kategoriler.php?ktip=1">'.$l['galeri'].'</a>
<br><a href="kategoriler.php?ktip=2">'.$l['video'].'</a>';


if (isset($_GET['ktip']))
{
	if ($_GET['ktip'] == '1')
	{
		$sayfa_adi = $ly['galeri_kategorileri'];
		$tema_sayfa_baslik = $ly['galeri_kategorileri'];
		$ktip = 1;
		$diger_kategoriler = '<a href="kategoriler.php">'.$l['yazi'].'</a>
		<br><b>'.$l['galeri'].'</b>
		<br><a href="kategoriler.php?ktip=2">'.$l['video'].'</a>';
	}
	elseif ($_GET['ktip'] == '2')
	{
		$sayfa_adi = $ly['video_kategorileri'];
		$tema_sayfa_baslik = $ly['video_kategorileri'];
		$ktip = 2;
		$diger_kategoriler = '<a href="kategoriler.php">'.$l['yazi'].'</a>
		<br><a href="kategoriler.php?ktip=1">'.$l['galeri'].'</a>
		<br><b>'.$l['video'].'</b>';
	}
}


// yönetim oturum kodu kontrol ediliyor
if ( (isset($_GET['kip'])) OR (isset($_POST['kip'])) )
{
	if ($gyo != $yo)
	{
		header('Location: hatalar.php?hata=45');
		exit();
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
		$kat_ad = "baslik_$dil";

		// kategoriler tablosunda dil var mı?
		$vtsorgu = "SHOW FIELDS FROM $tablo_kategoriler WHERE Field='$kat_ad'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		if ($vt->num_rows($vtsonuc)) $dil_eklenen .= $dil.',';
	}
}





//   İŞLEMLER - BAŞI   //


// Kategori sıralama uygulama

if ( (isset($_POST['kip'])) AND ($_POST['kip'] == 'uygula') )
{
	$sira_ham = @zkTemizle($_POST['siralama']);

	if ($sira_ham != '')
	{
		$sira_dizi = explode('|', $sira_ham);

		foreach ($sira_dizi as $sira)
		{
			if ($sira == '') continue;
			$a = explode(':', $sira);
			if ( (!isset($a[0])) OR (!isset($a[1])) OR (!isset($a[2])) ) continue;
			$a[2] = ($a[2]+1);

			$vtsorgu = "UPDATE $tablo_kategoriler SET alt_kat='$a[1]', sira='$a[2]' WHERE id='$a[0]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
		}
	}

	header('Location: hatalar.php?bilgi=19&no='.$ktip);
	exit();
}





//  Kategori oluşturma işlemleri

elseif ( (isset($_POST['kip'])) AND ($_POST['kip'] == 'yeni') )
{
	$katadi = BoslukSil(@zkTemizle($_POST['katadi']));

	if ( (!isset($katadi)) OR ($katadi == '') )
	{
		header('Location: hatalar.php?hata=5');
		exit();
	}


	// magic_quotes_gpc açıksa
	if (get_magic_quotes_gpc())
	{
		$katadres = ileti_yolla(stripslashes(BoslukSil($_POST['adres'])), 1);
		$katadres = sefyap($katadres);
		$kat_bilgi = ileti_yolla(stripslashes(BoslukSil($_POST['bilgi'])), 4);
	}

	// magic_quotes_gpc kapalıysa
	else
	{
		$katadres = ileti_yolla(BoslukSil($_POST['adres']), 1);
		$katadres = sefyap($katadres);
		$kat_bilgi = ileti_yolla(BoslukSil($_POST['bilgi']), 4);
	}


	// Diğer diller
	$sorgu_ek = '';
	$sorgu_ek2 = '';
	if ($dil_eklenen != ',')
	{
		$dileklenen = explode(',', $dil_eklenen);
		foreach ($dileklenen as $dil)
		{
			if ($dil == '') continue;
			$a = BoslukSil(@zkTemizle($_POST['baslik_'.$dil]));
			$sorgu_ek .= ",baslik_$dil";
			$sorgu_ek2 .= ",'$a'";
		}
	}


	// aynı adres var mı kontrol ediliyor
	$vtsorgu = "SELECT id,adres FROM $tablo_kategoriler WHERE adres='$katadres' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	if ( ($vt->num_rows($vtsonuc)) OR ($ayarlar['dizin_kat'] == $katadres)
		OR ($ayarlar['dizin_sayfa'] == $katadres) OR ($ayarlar['dizin_galeri'] == $katadres)
		OR ($ayarlar['dizin_video'] == $katadres) OR ($ayarlar['dizin_etiket'] == $katadres)
		OR ($ayarlar['dizin_arama'] == $katadres) )
	{
		$katadres = $katadres.'-'.zaman('Y-m-d-H-i-s', $ayarlar['saat_dilimi'], false, time(), 0,false);
	}


	// kategori veritabanına giriliyor
	$vtsorgu = "INSERT INTO $tablo_kategoriler (adres,baslik,bilgi,sira,tip $sorgu_ek)
	VALUES('$katadres','$katadi','$kat_bilgi','0','$ktip' $sorgu_ek2)";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());


	// kategori id'si alınıyor
	$katid = $vt->insert_id();

	// kategori tipi
	if ($ktip == 1) $alt_menu = 6;
	elseif ($ktip == 2) $alt_menu = 7;
	else $alt_menu = 4;

	// kategori için bağlantı oluşturuluyor
	$vtsorgu = "INSERT INTO $tablo_baglantilar (yer,sayfa,alt_menu,sistem,sira,ad,adres,bilgi)
	VALUES('1','0','$alt_menu','0', '0','$katadi','k=$katid&ka=$katadres','$kat_bilgi')";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());


	header('Location: hatalar.php?bilgi=8&no='.$ktip);
	exit();
}




//  Kategori düzenleme işlemleri

elseif ( (isset($_POST['kip'])) AND ($_POST['kip'] == 'duzenle') )
{
	if ( (!isset($_POST['id'])) OR ($_POST['id'] == '') )
	{
		header('Location: hatalar.php?hata=6');
		exit();
	}

	if ( (!is_numeric($_POST['id'])) OR ($_POST['id'] == '0') )
	{
		header('Location: hatalar.php?hata=6');
		exit();
	}

	$katid = BoslukSil(@zkTemizle($_POST['id']));
	$katadi = BoslukSil(@zkTemizle($_POST['katadi']));
	$kat_sira = BoslukSil(@zkTemizle($_POST['sira']));


	// magic_quotes_gpc açıksa
	if (get_magic_quotes_gpc())
	{
		$katadres = ileti_yolla(stripslashes(BoslukSil($_POST['adres'])), 1);
		$katadres = sefyap($katadres);
		$kat_bilgi = ileti_yolla(stripslashes(BoslukSil($_POST['bilgi'])), 4);
	}

	// magic_quotes_gpc kapalıysa
	else
	{
		$katadres = ileti_yolla(BoslukSil($_POST['adres']), 1);
		$katadres = sefyap($katadres);
		$kat_bilgi = ileti_yolla(BoslukSil($_POST['bilgi']), 4);
	}


	// Diğer diller
	$sorgu_ek = '';
	if ($dil_eklenen != ',')
	{
		$dileklenen = explode(',', $dil_eklenen);
		foreach ($dileklenen as $dil)
		{
			if ($dil == '') continue;
			$a = BoslukSil(@zkTemizle($_POST['baslik_'.$dil]));
			$sorgu_ek .= ",baslik_$dil='$a'";
		}
	}


	// aynı adres var mı kontrol ediliyor
	$vtsorgu = "SELECT id,adres FROM $tablo_kategoriler WHERE adres='$katadres' AND id!='$katid' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	if ( ($vt->num_rows($vtsonuc)) OR ($ayarlar['dizin_kat'] == $katadres)
		OR ($ayarlar['dizin_sayfa'] == $katadres) OR ($ayarlar['dizin_galeri'] == $katadres)
		OR ($ayarlar['dizin_video'] == $katadres) OR ($ayarlar['dizin_etiket'] == $katadres)
		OR ($ayarlar['dizin_arama'] == $katadres) )
	{
		$katadres = $katadres.'-'.zaman('Y-m-d-H-i-s', $ayarlar['saat_dilimi'], false, time(), 0,false);
	}


	// kategori düzenleniyor
	$vtsorgu = "UPDATE $tablo_kategoriler SET adres='$katadres',baslik='$katadi',bilgi='$kat_bilgi' $sorgu_ek WHERE id='$katid' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

	// kategorinin bağlantısı düzenleniyor
	$vtsorgu = "UPDATE $tablo_baglantilar SET adres='k=$katid&ka=$katadres',ad='$katadi',bilgi='$kat_bilgi' WHERE adres like 'k=$katid&%' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());


	header('Location: kategoriler.php?ktip='.$ktip);
	exit();
}




// Kategori silme işlemleri

elseif ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'sil') )
{
	if ( (!isset($_GET['k'])) OR ($_GET['k'] == '') )
	{
		header('Location: hatalar.php?hata=6');
		exit();
	}

	if ( (!is_numeric($_GET['k'])) OR ($_GET['k'] == '0') OR ($_GET['k'] == '1') )
	{
		header('Location: hatalar.php?hata=6');
		exit();
	}

	$katid = @zkTemizle($_GET['k']);


	// kategori siliniyor
	$vtsorgu = "DELETE FROM $tablo_kategoriler WHERE id='$katid' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

	// kategorinin bağlantısı siliniyor
	$vtsorgu = "DELETE FROM $tablo_baglantilar WHERE adres like '%k=$katid&%'";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

	// kategorinin yazıları siliniyor
	$vtsorgu = "DELETE FROM $tablo_yazilar WHERE kategori like '%,$katid,%'";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

	// kategorinin yorumları siliniyor
	$vtsorgu = "DELETE FROM $tablo_yorumlar WHERE kat_id='$katid'";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

	header('Location: hatalar.php?bilgi=9&no='.$ktip);
	exit();
}

//   İŞLEMLER - SONU   //






//  NORMAL GÖRÜNÜM İŞLEMLERİ - BAŞI  //


// kategori düzenleme için alma

if ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'duzenle') )
{
	if ( (!isset($_GET['k'])) OR ($_GET['k'] == '') )
	{
		header('Location: hatalar.php?hata=6');
		exit();
	}

	if ( (!is_numeric($_GET['k'])) OR ($_GET['k'] == '0') )
	{
		header('Location: hatalar.php?hata=6');
		exit();
	}

	$katid = @zkTemizle($_GET['k']);
	$vtsorgu = "SELECT * FROM $tablo_kategoriler WHERE id='$katid' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$kategori = $vt->fetch_assoc($vtsonuc);

	$katad = $kategori['baslik'];
	$kat_bilgi = $kategori['bilgi'];
	$katadres = $kategori['adres'];
	$form_ek ='<input type="hidden" name="kip" value="duzenle" />
	<input type="hidden" name="id" value="'.$kategori['id'].'" />';
	$form_yolla = '<input class="dugme dugme-mavi" type="submit" name="yeni" value="'.$ly['degistir'].'" />';
	$yeni_duzenle = $ly['kategori_duzenleme'];


	// Diğer diller
	if ($dil_eklenen != ',')
	{
		$dileklenen = explode(',', $dil_eklenen);
		foreach ($dileklenen as $dil)
		{
			if ($dil == '') continue;
			if (isset($kategori['baslik_'.$dil])) $bagad_diger[$dil] = $kategori['baslik_'.$dil];
		}
	}
}


else
{
	$katad = '';
	$kat_bilgi = '';
	$katadres = '';
	$form_ek ='<input type="hidden" name="kip" value="yeni" />';
	$form_yolla = '<input class="dugme dugme-mavi" type="submit" name="yeni" value="'.$ly['kategori_olustur'].'" />';
	$yeni_duzenle = $ly['kategori_ekleme'];


	// Diğer diller
	if ($dil_eklenen != ',')
	{
		$dileklenen = explode(',', $dil_eklenen);
		foreach ($dileklenen as $dil)
		{
			if ($dil == '') continue;
			$bagad_diger[$dil] = '';
		}
	}
}






// Sınırsız bağlantı fonksiyonu

function phpkf_yonetim_kategoriler($katid)
{
	global $vt, $tablo_kategoriler, $ayarlar, $yo, $ktip, $site_dili, $l;
	$linkler = '';

	$vtsorgu = "SELECT * FROM $tablo_kategoriler WHERE alt_kat='$katid' ORDER BY sira,id";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	if ($vt->num_rows($vtsonuc))
	{
		while($altkat = $vt->fetch_assoc($vtsonuc))
		{
			// Dil seçimine göre içerik alınıyor
			if ($ayarlar['dil_varsayilan'] != $site_dili)
			{
				if (isset($altkat['baslik_'.$site_dili])) $altkat['baslik'] = $altkat['baslik_'.$site_dili];
			}

			$linkler .= "\r\n".'<li id="'.$altkat['id'].'" rel="normal"><div style="margin-bottom:5px;">'.$altkat['baslik'];
			$linkler .= '<span style="float:right"><a href="kategoriler.php?ktip='.$ktip.'&amp;kip=sil&amp;k='.$altkat['id'].'&amp;yo='.$yo.'" onclick="return window.confirm(\''.$l['sil_uyari'].'\')"><img src="phpkf-bilesenler/temalar/varsayilan/resimler/sil.png" width="12" height="12" class="silLink" /></a>';
			$linkler .= '<a href="kategoriler.php?ktip='.$ktip.'&amp;kip=duzenle&amp;k='.$altkat['id'].'&amp;yo='.$yo.'"><img src="phpkf-bilesenler/temalar/varsayilan/resimler/duzenle.png" width="13" height="13" class="duzeltLink" /></a></span></div><ul>';
			$linkler .= phpkf_yonetim_kategoriler($altkat['id']);
			$linkler .= "</ul></li>";
		}
	}

	return($linkler);
}



// kategoriler veritabanından çekiliyor

$vtsorgu = "SELECT * FROM $tablo_kategoriler WHERE tip='$ktip' AND alt_kat='0' ORDER BY sira,id";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$surukle_birak = '';

while($kategori = $vt->fetch_assoc($vtsonuc))
{
	// Dil seçimine göre içerik alınıyor
	if ($ayarlar['dil_varsayilan'] != $site_dili)
	{
		if (isset($kategori['baslik_'.$site_dili])) $kategori['baslik'] = $kategori['baslik_'.$site_dili];
	}

	$surukle_birak .= '<li id="'.$kategori['id'].'" rel="sistem"><div style="margin-bottom:5px;">'.$kategori['baslik'].'<span style="float:right">';

	if ($kategori['id'] != '1') $surukle_birak .= '<a href="kategoriler.php?ktip='.$ktip.'&amp;kip=sil&amp;k='.$kategori['id'].'&amp;yo='.$yo.'" onclick="return window.confirm(\''.$ly['kategori_sil_uyari'].'\')"><img src="phpkf-bilesenler/temalar/varsayilan/resimler/sil.png" width="12" height="12" class="silLink" /></a>&nbsp;';

	$surukle_birak .= '<a href="kategoriler.php?ktip='.$ktip.'&amp;kip=duzenle&amp;k='.$kategori['id'].'&amp;yo='.$yo.'"><img src="phpkf-bilesenler/temalar/varsayilan/resimler/duzenle.png" width="13" height="13" class="duzeltLink" /></a></span></div><ul>';
	$surukle_birak .= phpkf_yonetim_kategoriler($kategori['id']);
	$surukle_birak .= "</ul></li>";
}



// Dil seçim formu hazırlanıyor
$diger_diller = '';
if ($dil_eklenen != ',')
{
	$dileklenen = explode(',', $dil_eklenen);
	foreach ($dileklenen as $dil)
	{
		if ($dil == '') continue;
		if (isset($bagad_diger[$dil])) $a = $bagad_diger[$dil];
		else $a = '';
		$diger_diller .= '<div class="phpkf-form-label"><label class="label">'.$diller[$dil].'<br /></label>
<input class="input-text" type="text" name="baslik_'.$dil.'" value="'.$a.'" style="width:90%" /></div>';
	}
}



$tema_sayfa_icerik = '<a name="duzenle"></a>
<link rel="stylesheet" type="text/css" media="screen" href="phpkf-bilesenler/css/baglantilar.css">

<form name="form1" action="kategoriler.php?ktip='.$ktip.'" method="post">
<input type="hidden" name="kip" value="uygula" />
<input type="hidden" name="yo" value="'.$yo.'" />

<div style="display:none">
<textarea name="siralama" id="siralama" rows="1" cols="1" style="width:100px;height:100px"></textarea>
<textarea name="gizleme" id="gizleme" rows="1" cols="1" style="width:100px;height:100px"></textarea>
<textarea name="copkutusu" id="copkutusu" rows="1" cols="1" style="width:100px;height:100px"></textarea>
</div>

<fieldset style="float:left; margin-right:20px;">
<legend>'.$l['kategoriler'].'</legend>

<div class="bloklar_yapi2" id="gorunen_baglantilar">
<div style="margin-bottom:10px;text-align:center">
<input class="dugme dugme-mavi" type="submit" name="yeni" value="'.$ly['degisiklikleri_uygula'].'" />
<hr style="border:0; border-bottom:1px solid #aaa"/>
</div>
<ul id="baglantilar" style="padding:10px;">
'.$surukle_birak.'
</ul>
</div>
</fieldset>
</form>



<fieldset style="width:450px">
<legend>'.$yeni_duzenle.'</legend>

<form name="form2" action="kategoriler.php?ktip='.$ktip.'" method="post" onsubmit="return yarim_denetle()">
<input type="hidden" name="yo" value="'.$yo.'" />
'.$form_ek.'
<div class="phpkf-form-label"><label class="label">'.$ly['baslik'].'<br /></label>
<input class="input-text" type="text" name="katadi" value="'.$katad.'" onkeyup="SefYapKat(this.value)" style="width:90%" />
</div>
'.$diger_diller.'

<div class="phpkf-form-label"><label class="label">'.$ly['aciklama'].'<br /></label>
<input class="input-text" type="text" name="bilgi" value="'.$kat_bilgi.'" style="width:90%" />
</div>

<div class="phpkf-form-label"><label class="label">'.$ly['sef_adres'].'<br /></label>
<input class="input-text" type="text" name="adres" value="'.$katadres.'" style="width:90%" />
</div>

<center>
'.$form_yolla.'
</center>

</form>
</fieldset>

<div style="position:absolute;top:47px;right:12px">
<fieldset style="margin:0;padding:10px;text-align:center">
<legend>'.$l['kategoriler'].'</legend>
'.$diger_kategoriler.'
</fieldset>
</div>

<div style="clear:both"></div><br><br>


<script type="text/javascript"><!-- //
function yarim_denetle(){
	var dogruMu = true;

	if (document.form2.katadi.value=="") dogruMu = false;
	if (document.form2.bilgi.value=="") dogruMu = false;
	if (document.form2.adres.value=="") dogruMu = false;

	if (!dogruMu) alert(jsl["kategori_alanlar_zorunludur"]);
	return dogruMu;
}
//  -->
</script>

<script src="phpkf-bilesenler/js/islemler.js"></script>
<script type="text/javascript" src="phpkf-bilesenler/js/surukle_birak.js"></script>
';




// tema dosyası yükleniyor
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>