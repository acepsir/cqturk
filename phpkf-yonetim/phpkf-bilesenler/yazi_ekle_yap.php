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


if (!defined('DOSYA_AYAR')) include_once('../../phpkf-ayar.php');
if (!defined('DOSYA_GERECLER')) include_once('../../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('guvenlik.php');
if (!defined('DOSYA_KULLANICI_KIMLIK')) include_once('../../phpkf-bilesenler/kullanici_kimlik.php');
if (!defined('DOSYA_SEO')) include_once('../../phpkf-bilesenler/seo.php');


// ziyaretçi ip adresi alınıyor
if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
else $ip = $_SERVER['REMOTE_ADDR'];
$ip = zkTemizle4($ip);
$ip = zkTemizle($ip);


//  SAYFA SİLME İŞLEMLERİ  //

if ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'sil') ):


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
if (isset($_GET['y'])) $yazi_id = @zkTemizle($_GET['y']);
else $yazi_id = 0;

if ( (!is_numeric($yazi_id)) OR ($yazi_id == 0) )
{
	header('Location: ../hatalar.php?hata=4');
	exit();
}


// yazı veritabanından çekiliyor
$vtsorgu = "SELECT id,tip,kategori,adres,alt_yazi,sayfa_no FROM $tablo_yazilar WHERE id='$yazi_id' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$yazi = $vt->fetch_assoc($vtsonuc);


// yazı yoksa hata ver
if (!isset($yazi['id']))
{
	header('Location: ../hatalar.php?hata=4');
	exit();
}


// seçili kategorilerin yazı sayıları eksiltiliyor
$kategoriler = explode(',', $yazi['kategori']);
foreach ($kategoriler as $katid)
{
	if ($katid != '')
	{
		$vtsorgu = "UPDATE $tablo_kategoriler SET toplam=toplam-1 WHERE id='$katid' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu);
	}
}


// yazı siliniyor
$vtsorgu = "DELETE FROM $tablo_yazilar WHERE id='$yazi_id' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());


// üst sayfa ise alt sayfaları siliniyor
if ($yazi['id'] == 1)
{
	$vtsorgu = "DELETE FROM $tablo_yazilar WHERE alt_yazi='$yazi_id'";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
}


// alt sayfa ise diğer alt sayfaların sayfa numarası değiştiriliyor
else
{
	$vtsorgu = "UPDATE $tablo_yazilar SET sayfa_no=sayfa_no-1 WHERE alt_yazi='$yazi[alt_yazi]' AND sayfa_no > $yazi[sayfa_no]";
	$vtsonuc = $vt->query($vtsorgu);


	// üst sayfanın diğer alt sayfalarına bakılıyor
	$vtsorgu = "SELECT id,sayfa_no FROM $tablo_yazilar WHERE alt_yazi='$yazi[alt_yazi]'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// başka alt sayfası yoksa üst sayfanın sayfano değeri sıfırlanıyor
	if (!$vt->num_rows($vtsonuc))
	{
		$vtsorgu = "UPDATE $tablo_yazilar SET sayfa_no='0' WHERE id='$yazi[alt_yazi]'";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
	}
}



// Ana sayfa olarak ayarlanmışsa, ayarlardan çıkartılıyor
if ($ayarlar['anasyfyazi'] == $yazi_id)
{
	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='0' WHERE etiket='anasyfyazi' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='0' WHERE etiket='durum_anasayfa' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
}

else
{
	// sayfanın bağlantısı siliniyor
	$vtsorgu = "DELETE FROM $tablo_baglantilar WHERE adres like '%y=$yazi_id&%'";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
}


// yazının yorumları siliniyor
$vtsorgu = "DELETE FROM $tablo_yorumlar WHERE yazi_id='$yazi_id'";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());


// yazı tipine göre kategori tipi belirleme
if ($yazi['tip'] == '4') $ktip = 1;
elseif ($yazi['tip'] == '5') $ktip = 2;
else $ktip = '0';

header('Location: ../hatalar.php?bilgi=5&no='.$ktip);
exit();








//  SAYFA DÜZENLEME VE OLUŞTURMA İŞLEMLERİ  //

elseif ( (isset($_POST['dolu'])) AND ($_POST['dolu'] == 'dolu') ):


// yönetim oturum kodu
if (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';

// yönetim oturum kodu kontrol ediliyor
if ($gyo != $yo)
{
	header('Location: ../hatalar.php?hata=45');
	exit();
}


// Başlık ve içerik alanları boş ise
if ( (!isset($_POST['mesaj_baslik'])) OR ($_POST['mesaj_baslik'] == '') OR (!isset($_POST['mesaj_icerik'])) OR ($_POST['mesaj_icerik'] == '') )
{
	header('Location: ../hatalar.php?hata=16');
	exit();
}


$tarih = time();

if ($_POST['tip'] == '0') $tip = 0;
elseif ($_POST['tip'] == '1') $tip = 1;
elseif ($_POST['tip'] == '2') $tip = 2;
elseif ($_POST['tip'] == '3') $tip = 3;
elseif ($_POST['tip'] == '4') $tip = 4;
elseif ($_POST['tip'] == '5') $tip = 5;
else $tip = 2;


if ($_POST['yorum'] == '0') $yorum = 0;
elseif ($_POST['yorum'] == '1') $yorum = 1;
else $yorum = 1;


$kategori = '';

if ( (isset($_POST['kat'])) AND (is_array($_POST['kat'])) )
{
	$kategori = ',';
	foreach ($_POST['kat'] as $anahtar => $deger)
	{
		if ($anahtar == $deger)
		{
			if (is_numeric($deger)) $kategori .= @zkTemizle($deger).',';
		}
	}
}

if ($kategori == '') $kategori = ',1,';



// Yayın tarihi işlemleri - başı //

if (isset($_POST['hemen']))
{
	$yayin_tarihi = $tarih;
}

else
{
	if (isset($_POST['tarih_gun'])) {
		$tarih_gun = @zkTemizle($_POST['tarih_gun']);
		if (!is_numeric($tarih_gun)) $tarih_gun = 0;
	}
	else $tarih_gun = 0;

	if (isset($_POST['tarih_ay'])) {
		$tarih_ay = @zkTemizle($_POST['tarih_ay']);
		if (!is_numeric($tarih_ay)) $tarih_ay = 0;
	}
	else $tarih_ay = 0;

	if (isset($_POST['tarih_yil'])) {
		$tarih_yil = @zkTemizle($_POST['tarih_yil']);
		if (!is_numeric($tarih_yil)) $tarih_yil = 0;
	}
	else $tarih_yil = 0;

	if (isset($_POST['tarih_saat'])) {
		$tarih_saat = @zkTemizle($_POST['tarih_saat']);
		if (!is_numeric($tarih_saat)) $tarih_saat = 0;
	}
	else $tarih_saat = 0;

	if (isset($_POST['tarih_dakika'])) {
		$tarih_dakika = @zkTemizle($_POST['tarih_dakika']);
		if (!is_numeric($tarih_dakika)) $tarih_dakika = 0;
	}
	else $tarih_dakika = 0;

	$yayin_tarihi = mktime($tarih_saat,$tarih_dakika,1,$tarih_ay,$tarih_gun,$tarih_yil);
}

// Yayın tarihi işlemleri - sonu //



// magic_quotes_gpc açıksa
if (get_magic_quotes_gpc())
{
	$adres = @ileti_yolla(stripslashes(BoslukSil($_POST['adres'])), 1);
	$etiket = @ileti_yolla(stripslashes(BoslukSil($_POST['etiket'])), 1);
	$baslik = @ileti_yolla(stripslashes($_POST['mesaj_baslik']), 1);
	$icerik = @ileti_yolla(stripslashes($_POST['mesaj_icerik']), 4);
}

// magic_quotes_gpc kapalıysa
else
{
	$adres = @ileti_yolla(BoslukSil($_POST['adres']), 1);
	$etiket = @ileti_yolla(BoslukSil($_POST['etiket']), 1);
	$baslik = @ileti_yolla($_POST['mesaj_baslik'], 1);
	$icerik = @ileti_yolla($_POST['mesaj_icerik'], 4);
}




//  Etiket ve Adres işlemleri - başı  //

// adres veya etiket girilmemişse başlıktan türetiliyor
if ($adres == '') $adres = sefyap($baslik);
else $adres = sefyap($adres);
if ($etiket == '') $etiket = str_replace(' ', ',', $baslik);

$etiket = str_replace(', ', ',', $etiket);
$etiket = str_replace(' ,', ',', $etiket);
$bul = array('&amp;', '&gt;', '&lt;', '&#123;', '&#125;', '&#92;', '&#34;', '\'', '\\', '/', '!', '.', '(', ')', '[', ']', ',', '?', '+');

$etiket = explode(',', $etiket);
$etiketler = '';

foreach ($etiket as $etiketdepo)
{
	$etiketdepo = BoslukSil($etiketdepo);
	$etiketdepo = str_replace($bul, '', $etiketdepo);
	if (strlen($etiketdepo) > 2) $etiketler .= $etiketdepo.',';
}

//  Etiket ve Adres işlemleri - sonu  //




// alt sayfa işlemleri - başı //

if (isset($_POST['sayfa_no'])) $sayfa_no = @zkTemizle($_POST['sayfa_no']);
if (!is_numeric($sayfa_no)) $sayfa_no = 0;

if ( (isset($_POST['alt_yazi'])) AND ($_POST['alt_yazi'] != '') )
{
	$alt_yazi = @zkTemizle($_POST['alt_yazi']);
	if (!is_numeric($alt_yazi)) $alt_yazi = 0;

	if ($alt_yazi != 0)
	{
		// üst yazı veritabanından çekiliyor
		$vtsorgu = "SELECT id,adres FROM $tablo_yazilar WHERE id='$alt_yazi' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$ust_yazi = $vt->fetch_assoc($vtsonuc);

		// üst yazı varsa sayfa_no alanı 1 yapılıyor
		if (isset($ust_yazi['id']))
		{
			$vtsorgu = "UPDATE $tablo_yazilar SET sayfa_no='1' WHERE id='$alt_yazi' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
		}

		// üst yazı yoksa değerler sıfırlanıyor
		else
		{
			$alt_yazi = 0;
			$sayfa_no = 0;
		}
	}
}

else
{
	if ((isset($_POST['duzenle'])) AND ($_POST['duzenle'] != ''))
		$duzenle_id = @zkTemizle($_POST['duzenle']);

	// yeni yazı ise
	if (!isset($duzenle_id))
	{
		$sayfa_no = 0;
		$alt_yazi = 0;
	}

	// düzenleme ise
	else
	{
		// alt sayfaları var mı bakılıyor
		$vtsorgu = "SELECT id FROM $tablo_yazilar WHERE alt_yazi='$duzenle_id' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		// alt yazıları varsa sayfano değeri 1, yoksa 0 yapılıyor
		if ($vt->num_rows($vtsonuc)) $sayfa_no = 1;
		else $sayfa_no = 0;
		$alt_yazi = 0;
	}
}

// alt sayfa işlemleri - sonu //



// özel alanlar - başı //

$vtsorgu = "SHOW FIELDS FROM $tablo_yazilar WHERE Field!='id' AND Field!='tip' AND Field!='kategori' AND Field!='alt_yazi' AND Field!='sayfa_no' AND Field!='tarih' AND Field!='yayin_tarihi' AND Field!='yazan' AND Field!='yazan_id' AND Field!='yazan_ip' AND Field!='degistirme_tarihi' AND Field!='degistiren' AND Field!='degistiren_id' AND Field!='degistiren_ip' AND Field!='goruntuleme' AND Field!='yorum_durum' AND Field!='yorum_sayi' AND Field!='adres' AND Field!='etiket' AND Field!='baslik' AND Field!='icerik'";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
$eksorgu_insert = '';
$eksorgu_value = '';
$eksorgu_update = '';

// Özel alanlar ek sorguya ekleniyor
while ($alanlar = $vt->fetch_assoc($vtsonuc))
{
	$alan = $alanlar['Field'];
	if (isset($_POST[$alan]))
	{
		if (get_magic_quotes_gpc()) $deger = @ileti_yolla(stripslashes(trim($_POST[$alan])), 4);
		else $deger = @ileti_yolla(trim($_POST[$alan]), 4);

		$eksorgu_insert .= ",$alan";
		$eksorgu_value .= ",'$deger'";
		$eksorgu_update .= ",$alan='$deger'";
	}
}

// özel alanlar - sonu //





// SAYFA DÜZENLEME İŞLEMLERİ //

if ( (isset($_POST['duzenle'])) AND ($_POST['duzenle'] != '') )
{
	$yazi_id = @zkTemizle($_POST['duzenle']);

	if ( (!is_numeric($yazi_id)) OR ($yazi_id == 0) )
	{
		header('Location: ../hatalar.php?hata=4');
		exit();
	}


	// aynı adres var mı kontrol ediliyor
	$vtsorgu = "SELECT id,adres FROM $tablo_yazilar WHERE id!='$yazi_id' AND adres='$adres' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	if ($vt->num_rows($vtsonuc)) $adres = $adres.'-'.zaman('Y-m-d-H-i-s', $ayarlar['saat_dilimi'], false, time(), 0,false);


	if ((isset($_POST['dil_ekle'])) AND ($_POST['dil_ekle'] != ''))
	{
		$dil_ekle = zkTemizle($_POST['dil_ekle']);
		$vtsorgu = "UPDATE $tablo_yazilar SET etiket_$dil_ekle='$etiketler',baslik_$dil_ekle='$baslik',icerik_$dil_ekle='$icerik' WHERE id='$yazi_id' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		if ($tip == '1') $adres_git = $phpkf_dosyalar['cms'];
		elseif ($tip == '3') $adres_git = linkyap($phpkf_dosyalar['cms'].'?kip=iletisim', 'iletisim.html');
		else $adres_git = $phpkf_dosyalar['cms'].'?y='.$yazi_id;

		header('Location: ../hatalar.php?bilgi=6&git='.$adres_git);
		exit();
	}

	else
	{
		$vtsorgu = "UPDATE $tablo_yazilar SET tip='$tip',kategori='$kategori',alt_yazi='$alt_yazi',sayfa_no='$sayfa_no',yayin_tarihi='$yayin_tarihi',degistirme_tarihi='$tarih',degistiren='$kullanici_kim[kullanici_adi];$kullanici_kim[gercek_ad]',degistiren_id='$kullanici_kim[id]',degistiren_ip='$ip',yorum_durum='$yorum',adres='$adres',etiket='$etiketler',baslik='$baslik',icerik='$icerik' $eksorgu_update WHERE id='$yazi_id' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
	}



	// Sayfa no kontrol
	if ($alt_yazi != 0)
	{
		// tüm alt sayfaları veritabanından çekiliyor
		$vtsorgu = "SELECT id,sayfa_no FROM $tablo_yazilar WHERE alt_yazi='$alt_yazi' ORDER BY sayfa_no,id";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$a = 2;
		while ($altsyflar = $vt->fetch_assoc($vtsonuc))
		{
			if ($altsyflar['sayfa_no'] != $a)
			{
				// sayfa no hatalı ise düzeltiliyor
				$vtsorgu = "UPDATE $tablo_yazilar SET sayfa_no='$a' WHERE id='$altsyflar[id]'";
				$vtsonuc2 = $vt->query($vtsorgu) or die($vt->hata_ver());
			}
			$a++;
		}
	}


	// Ana sayfa yapılıyorsa, sayfa id`si ayarlar tablosuna giriliyor
	if ($tip == '1')
	{
		$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$yazi_id' WHERE etiket='anasyfyazi' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		$vtsorgu = "UPDATE $tablo_ayarlar SET deger='2' WHERE etiket='durum_anasayfa' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		// Başka ana sayfa varsa normal sayfa yapılıyor
		$vtsorgu = "UPDATE $tablo_yazilar SET tip='0' WHERE tip='1' AND id!='$yazi_id'";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		$adres_git = $phpkf_dosyalar['cms'];
	}

	// İletişim sayfası yapılıyorsa
	elseif ($tip == '3')
	{
		// Başka iletişim sayfası varsa normal sayfa yapılıyor
		$vtsorgu = "UPDATE $tablo_yazilar SET tip='0' WHERE tip='3' AND id!='$yazi_id'";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		$adres_git = linkyap($phpkf_dosyalar['cms'].'?kip=iletisim', 'iletisim.html');
	}

	else
	{
		// Ana sayfadan çıkartılıyorsa ayarlardan çıkartılıyor
		if ($ayarlar['anasyfyazi'] == $yazi_id)
		{
			$vtsorgu = "UPDATE $tablo_ayarlar SET deger='0' WHERE etiket='anasyfyazi' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

			$vtsorgu = "UPDATE $tablo_ayarlar SET deger='0' WHERE etiket='durum_anasayfa' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
		}

		// yazının seçilen ilk kategorisi bulunuyor
		$kat_id = explode(',', $kategori);
		$kat_id = $kat_id[1];

		// kategorisi veritabanından çekiliyor
		$vtsorgu = "SELECT id,adres,baslik FROM $tablo_kategoriler WHERE id='$kat_id' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$kat_id = $vt->fetch_assoc($vtsonuc);

		// Adres oluşturuluyor
		if (($alt_yazi!=0) AND ($sayfa_no!=0))
		{
			$yeni_adres = $ust_yazi['adres'];
			$adres_sayfa = 'ys='.$sayfa_no;
			$yaziid = $ust_yazi['id'];
		}
		else
		{
			$yeni_adres = $adres;
			$adres_sayfa = '';
			$yaziid = $yazi_id;
		}

		$adres_git = linkyap($phpkf_dosyalar['cms'].'?k='.$kat_id['id'].'&y='.$yaziid, $kat_id['adres'], $yeni_adres, $adres_sayfa);

		// sayfanın bağlantısı düzenleniyor
		$vtsorgu = "UPDATE $tablo_baglantilar SET adres='y=$yazi_id&ya=$yeni_adres&k=$kat_id[id]&ka=$kat_id[adres]',ad='$baslik',bilgi='$baslik' WHERE adres like '%y=$yazi_id&%'";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
	}

	$adres_git = str_replace('&amp;','veisareti',$adres_git);
	if ($tip == 4) $ktip = 1;
	elseif ($tip == 5) $ktip = 2;
	else $ktip = 0;


	header('Location: ../hatalar.php?bilgi=6&no='.$ktip.'&git='.$adres_git);
	exit();
}




// YENİ SAYFA OLUŞTURMA İŞLEMLERİ //

else
{
	$ktip = 0;

	// aynı adres var mı kontrol ediliyor
	$vtsorgu = "SELECT id,adres FROM $tablo_yazilar WHERE adres='$adres' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	if ($vt->num_rows($vtsonuc)) $adres = $adres.'-'.zaman('Y-m-d-H-i-s', $ayarlar['saat_dilimi'], false, time(), 0,false);


	$vtsorgu = "INSERT INTO $tablo_yazilar (tip,kategori,alt_yazi,sayfa_no,tarih,yayin_tarihi,yazan,yazan_id,yazan_ip,yorum_durum,adres,etiket,baslik,icerik $eksorgu_insert)
	VALUES('$tip','$kategori','$alt_yazi','$sayfa_no','$tarih','$yayin_tarihi','$kullanici_kim[kullanici_adi];$kullanici_kim[gercek_ad]','$kullanici_kim[id]','$ip','$yorum','$adres','$etiketler','$baslik','$icerik'$eksorgu_value)";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

	// sayfa id'si alınıyor
	$yazi_id = $vt->insert_id();

	// yazının seçilen ilk kategorisi bulunuyor
	$kategoriler = explode(',', $kategori);
	$kat_id = $kategoriler[1];

	// seçili kategorilerin yazı sayıları arttırılıyor
	foreach ($kategoriler as $katid)
	{
		if ($katid != '')
		{
			$vtsorgu = "UPDATE $tablo_kategoriler SET toplam=toplam+1 WHERE id='$katid' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
		}
	}


	// kategorisi veritabanından çekiliyor
	$vtsorgu = "SELECT id,adres,baslik FROM $tablo_kategoriler WHERE id='$kat_id' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$kat_id = $vt->fetch_assoc($vtsonuc);


	// Adres oluşturuluyor
	if (($alt_yazi!=0) AND ($sayfa_no!=0))
		$adres_git = linkyap($phpkf_dosyalar['cms'].'?k='.$kat_id['id'].'&y='.$ust_yazi['id'], $kat_id['adres'], $ust_yazi['adres'],'ys='.$sayfa_no);
	else $adres_git = linkyap($phpkf_dosyalar['cms'].'?k='.$kat_id['id'].'&y='.$yazi_id, $kat_id['adres'], $adres);


	// Sayfa no kontrol
	if ($alt_yazi != 0)
	{
		// tüm alt sayfaları veritabanından çekiliyor
		$vtsorgu = "SELECT id,sayfa_no FROM $tablo_yazilar WHERE alt_yazi='$alt_yazi' ORDER BY sayfa_no,id";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$a = 2;
		while ($altsyflar = $vt->fetch_assoc($vtsonuc))
		{
			if ($altsyflar['sayfa_no'] != $a)
			{
				// sayfa no hatalı ise düzeltiliyor
				$vtsorgu = "UPDATE $tablo_yazilar SET sayfa_no='$a' WHERE id='$altsyflar[id]'";
				$vtsonuc2 = $vt->query($vtsorgu) or die($vt->hata_ver());
			}
			$a++;
		}
	}


	// Ana sayfa olarak ayarlanmışsa, sayfa id`si ayarlar tablosuna giriliyor
	if ($tip == '1')
	{
		$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$yazi_id' WHERE etiket='anasyfyazi' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		$vtsorgu = "UPDATE $tablo_ayarlar SET deger='2' WHERE etiket='durum_anasayfa' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		// Başka ana sayfa varsa normal sayfa yapılıyor
		$vtsorgu = "UPDATE $tablo_yazilar SET tip='0' WHERE tip='1' AND id!='$yazi_id'";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		$adres_git = $phpkf_dosyalar['cms'];
	}


	// İletişim sayfası olarak ayarlanmışsa
	elseif ($tip == '3')
	{
		// Başka ana sayfa varsa normal sayfa yapılıyor
		$vtsorgu = "UPDATE $tablo_yazilar SET tip='0' WHERE tip='3' AND id!='$yazi_id'";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		$adres_git = linkyap($phpkf_dosyalar['cms'].'?kip=iletisim', 'iletisim.html');
	}


	// Normal Sayfa, Galeri ve Video ise
	elseif ( (($tip == '0') AND ($alt_yazi == '0')) OR ($tip == '4') OR ($tip == '5') )
	{
		if (isset($_POST['hemen'])) $yer = 1;
		else $yer = 0;
		if ($tip == 4) {$alt_menu = 6; $ktip = 1;}
		elseif ($tip == 5) {$alt_menu = 7; $ktip = 2;}
		else {$alt_menu = 5; $ktip = 0;}

		// Bağlantı oluşturuluyor
		$vtsorgu = "INSERT INTO $tablo_baglantilar (yer,sayfa,alt_menu,sistem,sira,ad,adres,bilgi)
		VALUES('$yer','0','$alt_menu','0', '0','$baslik','y=$yazi_id&ya=$adres&k=$kat_id[id]&ka=$kat_id[adres]','$baslik')";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
	}


	$adres_git = str_replace('&amp;','veisareti',$adres_git);

	header('Location: ../hatalar.php?bilgi=7&no='.$ktip.'&git='.$adres_git);
	exit();
}




// FORM BOŞ İSE //

else:

header('Location: ../hatalar.php?hata=1');
exit();



endif;
?>