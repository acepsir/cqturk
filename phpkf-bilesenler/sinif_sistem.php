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


if (!defined('DOSYA_SISTEM_SINIF')) define('DOSYA_SISTEM_SINIF',true);


//  Kategoriler Fonksiyonu  //

function phpkf_kategoriler($kosul = array())
{
	global $vt,$tablo_kategoriler,$ayarlar,$site_dili,$anadizin,$phpkf_dosyalar;

	$vtsorgu = "SELECT * FROM $tablo_kategoriler $kosul[kosul] $kosul[sirala] $kosul[kota]";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// Kategori yoksa hata ver
	if (@preg_match('/LIMIT\ 1$/', $kosul['kota']))
	{
		if (!$vt->num_rows($vtsonuc))
		{
			header('Location: '.$anadizin.$phpkf_dosyalar['hata'].'?hata=501');
			exit();
		}
	}

	while($kategori = $vt->fetch_assoc($vtsonuc))
	{
		// Dil seçimine göre içerik alınıyor
		if ($ayarlar['dil_varsayilan'] != $site_dili)
		{
			if (isset($kategori['baslik_'.$site_dili])) $kategori['baslik'] = $kategori['baslik_'.$site_dili];
		}

		$kategori['link'] = linkyap($phpkf_dosyalar['cms'].'?kip=kat&k='.$kategori['id'], $kategori['adres']);
		$kategoriler[$kategori['id']] = $kategori;
	}

	if (isset($kategoriler)) return($kategoriler);
	else return(false);
}




//  Alt Kategoriler Fonksiyonu  //

function phpkf_alt_kategoriler($kosul = array())
{
	global $vt,$tablo_kategoriler,$ayarlar,$site_dili,$anadizin,$phpkf_dosyalar;
	$kategoriler = '';

	$vtsorgu = "SELECT * FROM $tablo_kategoriler $kosul[kosul] $kosul[sirala] $kosul[kota]";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	if ($vt->num_rows($vtsonuc))
	{
		$kategoriler .= "\r\n".'<ul class="liste-alt-kategori">';

		while($kategori = $vt->fetch_assoc($vtsonuc))
		{
			// Dil seçimine göre içerik alınıyor
			if ($ayarlar['dil_varsayilan'] != $site_dili)
			{
				if (isset($kategori['baslik_'.$site_dili])) $kategori['baslik'] = $kategori['baslik_'.$site_dili];
			}

			$adres = linkyap($phpkf_dosyalar['cms'].'?kip=kat&k='.$kategori['id'], $kategori['adres']);
			$kategoriler .= '<li><a href="'.$adres.'">'.$kategori['baslik'].'</a>';

			if ($kategori['alt_kat'] != '0')
			{
				$kosul = array('kosul' => "WHERE alt_kat='$kategori[id]'",
				'sirala' => $kosul['sirala'],
				'kota' => $kosul['kota']);

				$link = phpkf_alt_kategoriler($kosul);
				if ($link) $kategoriler .= '<li>'.$link.'</li>'."\r\n";
			}
			else $kategoriler .= '</li>'."\r\n";
		}

		$kategoriler .= '</ul>'."\r\n";
	}

	if (isset($kategoriler)) return($kategoriler);
	else return(false);
}




//  Yazılar Fonksiyonu  //

function phpkf_yazilar($kosul = array())
{
	global $vt,$tablo_yazilar,$tum_kategoriler,$ayarlar,$kullanici_kim,$site_dili,$l,$diller,$anadizin,$phpkf_dosyalar;

	// Sorguda etiket varsa, dil seçimine göre etiketler alınıyor
	if ($ayarlar['dil_varsayilan'] != $site_dili)
	{
		if (preg_match("/,$site_dili,/", $ayarlar['dil_eklenen_alanlar']))
$kosul['kosul'] = preg_replace("/etiket LIKE '%(.*?)%'/is", "etiket LIKE '%\\1%' OR etiket_$site_dili LIKE '%\\1%'", $kosul['kosul']);
	}

	$vtsorgu = "SELECT $kosul[alan] FROM $tablo_yazilar $kosul[kosul] $kosul[sirala] $kosul[kota]";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// Yazı yoksa hata ver
	if (@preg_match('/LIMIT\ 1$/', $kosul['kota']))
	{
		if (!$vt->num_rows($vtsonuc))
		{
			header('Location: '.$anadizin.$phpkf_dosyalar['hata'].'?hata=501');
			exit();
		}
	}

	while($yazi = $vt->fetch_assoc($vtsonuc))
	{
		// yazının ilk kategorisi bulunuyor
		$kat_id = explode(',', $yazi['kategori']);
		$kat_id = $kat_id[1];


		// Dil seçimine göre içerik alınıyor
		if ($ayarlar['dil_varsayilan'] != $site_dili)
		{
			if (isset($yazi['etiket_'.$site_dili])) $yazi['etiket'] = $yazi['etiket_'.$site_dili];
			if (isset($yazi['baslik_'.$site_dili])) $yazi['baslik'] = $yazi['baslik_'.$site_dili];
			if (isset($yazi['icerik_'.$site_dili])) $yazi['icerik'] = $yazi['icerik_'.$site_dili];
		}


		// devamı bilgisi varsa
		if (isset($yazi['icerik']))
		{
			if ( ($kosul['tum_icerik'] == 0) AND (preg_match('/(.*?){{DEVAMI}}/is',$yazi['icerik'], $sicerik, PREG_OFFSET_CAPTURE)) )
			{
				$yazi['icerik'] = $sicerik[0][0];
				$yazi['devami'] = '<a href="'.linkyap($phpkf_dosyalar['cms'].'?k='.$kat_id.'&y='.$yazi['id'], $tum_kategoriler[$kat_id]['adres'], $yazi['adres']).'">'.$l['devami_icin_tiklayin'].'...</a>';
			}
			else $yazi['devami'] = '';

			$yazi['icerik'] = str_replace('{{DEVAMI}}', '', $yazi['icerik']);
			$yazi['icerik'] = ozel_kodlar($yazi['icerik'], $yazi['id']);
		}
		else $yazi['devami'] = '';


		$yazi['goruntuleme'] = NumaraBicim($yazi['goruntuleme']);
		$yazi['yorum_sayi'] = NumaraBicim($yazi['yorum_sayi']);
		$yazi['tarih_ham'] = $yazi['tarih'];
		$yazi['yayin_tarihi_ham'] = $yazi['yayin_tarihi'];
		$yazi['tarih'] = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $yazi['tarih'], $ayarlar['tarih'], true);
		$yazi['yayin_tarihi'] = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $yazi['yayin_tarihi'], $ayarlar['tarih'], true);
		$yazi['link'] = linkyap($phpkf_dosyalar['cms'].'?k='.$kat_id.'&y='.$yazi['id'], $tum_kategoriler[$kat_id]['adres'], $yazi['adres']);

		$yazan_adi = explode(';', $yazi['yazan']);
		if ($ayarlar['yazan_adi'] != 1) $yazi['yazan'] = $yazan_adi[0];
		else $yazi['yazan'] = $yazan_adi[1];
		$yazan_adi = $yazan_adi[0];
		$yazi['profil'] = linkyap($phpkf_dosyalar['profil'].'?u='.$yazi['yazan_id'].'&kim='.$yazan_adi,$yazan_adi);

		if ($kullanici_kim['yetki'] == 1)
		{
			if ($yazi['tip'] == 4) $ktip = 1;
			elseif ($yazi['tip'] == 5) $ktip = 2;
			else $ktip = 0;

			// Farklı dillerde düzenleme bağlantısı
			$dil_ekle = '';
			if ($ayarlar['dil_eklenen_alanlar'] != ','){
				$dileklenen = explode(',', $ayarlar['dil_eklenen_alanlar']);
				foreach ($dileklenen as $dil){
					if ($dil == '') continue; $dil_ekle .= '<a href="phpkf-yonetim/yazi_ekle.php?ktip='.$ktip.'&amp;kip=duzenle&amp;dil_ekle='.$dil.'&amp;y='.$yazi['id'].'" style="margin-left:15px" title="'.$diller[$dil].' '.$l['icerik_ekle'].'">'.strtoupper($dil).'</a>';
			}}

			$yazi['duzenle'] = '<a style="border:0" href="phpkf-yonetim/yazi_ekle.php?ktip='.$ktip.'&amp;kip=duzenle&amp;y='.$yazi['id'].'">'.$l['duzenle'].'</a>'.$dil_ekle;
		}
		else $yazi['duzenle'] = '';

		$yazilar[] = $yazi;
	}

	if (isset($yazilar)) return($yazilar);
	else return(false);
}




//  Toplam Yazı Fonksiyonu  //

function phpkf_toplam_yazi($kosul = array())
{
	global $vt, $ayarlar, $tablo_yazilar, $site_dili;

	// Sorguda etiket varsa, dil seçimine göre etiketler alınıyor
	if ($ayarlar['dil_varsayilan'] != $site_dili)
	{
		if (preg_match("/,$site_dili,/", $ayarlar['dil_eklenen_alanlar']))
		$kosul['kosul'] = str_replace('etiket LIKE', 'etiket_'.$site_dili.' LIKE', $kosul['kosul']);
	}

	$vtsorgu = "SELECT id FROM $tablo_yazilar $kosul[kosul]";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$toplam = $vt->num_rows($vtsonuc);

	return($toplam);
}



//  Toplam Üye Fonksiyonu  //

function phpkf_toplam_uye($kosul = array())
{
	global $vt,$tablo_kullanicilar;

	$vtsorgu = "SELECT id FROM $tablo_kullanicilar $kosul[kosul]";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$toplam = $vt->num_rows($vtsonuc);

	return($toplam);
}



//  Yorumlar Fonksiyonu  //

function phpkf_yorumlar($kosul = array())
{
	global $o,$vt,$tablo_yorumlar,$tablo_kullanicilar,$ayarlar,$kullanici_kim,$l,$anadizin,$phpkf_dosyalar;

	$vtsorgu = "SELECT * FROM $tablo_yorumlar $kosul[kosul] $kosul[sirala] $kosul[kota]";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	while($yorum = $vt->fetch_assoc($vtsonuc))
	{
		// yorumu yazan üye ise
		if ($yorum['yazan_id'] != 0)
		{
			$vtsorgu = "SELECT id,resim FROM $tablo_kullanicilar WHERE id='$yorum[yazan_id]' LIMIT 1";
			$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$uye_resim = $vt->fetch_assoc($vtsonuc2);

			if ($uye_resim['resim'] != '') $yorum['resim'] = $uye_resim['resim'];
			else $yorum['resim'] = $ayarlar['v-uye_resmi'];

			$yorum['uye_mi'] = true;
			$yorum['hedef'] = '';
			$yazan_adi = explode(';', $yorum['yazan']);
			if ($ayarlar['yazan_adi'] != 1) $yorum['yazan'] = $yazan_adi[0];
			else $yorum['yazan'] = $yazan_adi[1];
			$yazan_adi = $yazan_adi[0];
			$yorum['profil'] = linkyap($phpkf_dosyalar['profil'].'?u='.$yorum['yazan_id'].'&kim='.$yazan_adi,$yazan_adi);
		}

		// yorumu yazan ziyaretçi ise
		else
		{
			$d = urlencode('?default=http://'.$ayarlar['alanadi'].$anadizin.$ayarlar['v-ziyaretci_resmi']);
			$p = md5(strtolower(trim($yorum['posta'])));
			$yorum['uye_mi'] = false;
			$yorum['hedef'] = 'rel="nofollow" target="_blank"';
			$yorum['profil'] = 'https://www.gravatar.com/'.$p;
			$yorum['resim'] = 'https://www.gravatar.com/avatar/'.$p.$d;
		}

		if (($yorum['bbcode'] == 1) AND ($kosul['bbcode'] == 1)) $yorum['icerik'] = bbcode_acik($yorum['icerik'], $yorum['id']);
		else $yorum['icerik'] = bbcode_kapali($yorum['icerik']);
		if (($yorum['ifade'] == 1) AND ($kosul['ifade'] == 1)) $yorum['icerik'] = ifadeler($yorum['icerik']);

		if ($kullanici_kim['yetki'] == 1) $yorum['duzenle'] = '<a href="phpkf-yonetim/yorumlar.php?kip=sil&amp;id='.$yorum['id'].'&yo='.$o.'" onclick="return window.confirm(\''.$l['sil_uyari'].'\')"><span class="sil" title="'.$l['sil'].'"></span></a><a href="phpkf-yonetim/yorumlar.php?kip=duzenle&amp;id='.$yorum['id'].'"><span class="duzenle" title="'.$l['duzenle'].'"></span></a>';
		else $yorum['duzenle'] = '';

		if (($yorum['yanit'] == 0) OR ($yorum['yanit'] == 1))
		{
			$yorum['yanit_mi'] = false;
			$yorum['yanitla'] = '<a href="javascript:void(0)" onclick="YorumYanitla('.$yorum['id'].')"><span class="yanitla" title="'.$l['yanitla'].'"></span></a>';
		}
		else
		{
			$yorum['yanit_mi'] = true;
			$yorum['yanitla'] = '<a href="javascript:void(0)" onclick="YorumYanitla('.$yorum['yanit'].')"><span class="yanitla" title="'.$l['yanitla'].'"></span></a>';
		}


		$yorum['tarih'] = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $yorum['tarih'], $ayarlar['tarih'], true);
		$yorumlar[] = $yorum;


		// Yanıtları varsa
		if ($yorum['yanit'] == 1)
		{
			$ic_kosul =array('kosul' => "WHERE yanit='$yorum[id]' AND onay='1'",
			'sirala' => 'ORDER BY id', 'kota' => '', 'bbcode' => $kosul['bbcode'], 'ifade' => $kosul['ifade']);

			$yanitlar = phpkf_yorumlar($ic_kosul);
			$yorumlar = array_merge((array)$yorumlar, (array)$yanitlar);
		}
	}
	if (isset($yorumlar)) return($yorumlar);
	else return(false);
}




//  Üyeler Fonksiyonu  //

function phpkf_uyeler($kosul = array())
{
	global $vt,$tablo_kullanicilar,$anadizin,$ayarlar,$phpkf_dosyalar;

	$vtsorgu = "SELECT $kosul[alan] FROM $tablo_kullanicilar $kosul[kosul] $kosul[sirala] $kosul[kota]";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// Üye yoksa hata ver
	if (@preg_match('/LIMIT\ 1$/', $kosul['kota']))
	{
		if (!$vt->num_rows($vtsonuc))
		{
			header('Location: '.$anadizin.$phpkf_dosyalar['hata'].'?hata=46');
			exit();
		}
	}

	while($uye = $vt->fetch_assoc($vtsonuc))
	{
		if ($uye['resim'] == '') $uye['resim'] = $ayarlar['v-uye_resmi'];

		$uye['link'] = linkyap($phpkf_dosyalar['profil'].'?u='.$uye['id'].'&kim='.$uye['kullanici_adi'],$uye['kullanici_adi']);

		$uye['kullanici_kimlik'] = ''; $uye['yonetim_kimlik'] = '';
		$uye['sifre'] = ''; $uye['kul_etkin_kod'] = ''; $uye['yeni_sifre'] = '';
		$uyeler[] = $uye;
	}

	if (isset($uyeler)) return($uyeler);
	else return(false);
}




//  Sayfalama Fonksiyonu  //

function phpkf_sayfalama($toplam_yazi,$kota,$sayfano,$ek,$toplam_link=0,$tasarim='',$dizi=array())
{
	global $tema_ozellik_sayfalama;
	if ($tasarim == '') $tasarim = $tema_ozellik_sayfalama;

	if ($toplam_link == 0) $toplam_link = $tasarim['sayi'];
	$ileri_geri = ($toplam_link / 2) - 1;

	if (isset($_SERVER['REQUEST_URI'])) $dosya = $_SERVER['REQUEST_URI'];
	else $dosya = '';
	$dosya = zkTemizle4($dosya);
	$dosya = zkTemizle($dosya);
	$dosya = preg_replace('#|((\&|\?)'.$ek.'(.*?))$|#si','',$dosya);
	$dosya = str_replace('&', '&amp;', $dosya);

	if ($ek == 'yms=') $ek2 = '#yorumlar';
	else $ek2 = '';

	if (@preg_match('/\?/', $dosya)) $ek = '&amp;'.$ek;
	else $ek = '?'.$ek;


	$toplam = ($toplam_yazi / $kota);
	settype($toplam,'integer');
	if (($toplam_yazi % $kota) != 0) $toplam++;

	if ($toplam_yazi > $kota)
	{
		$sayfalama = $tasarim['acilis'];

		if ($sayfano != 1)
		{
			$sayfalama .= '<a href="'.$dosya.$ek2.'">'.$tasarim['enbas'].'</a>';
			if ($sayfano != 2) $sayfalama .= '<a href="'.$dosya.$ek.($sayfano - 1).$ek2.'">'.$tasarim['geri'].'</a>';
			else $sayfalama .= '<a href="'.$dosya.$ek2.'">'.$tasarim['geri'].'</a>';
		}

		for ($sayi=1,$sayfa_sinir=$sayfano; $sayi < $toplam+1; $sayi++)
		{
			if ($sayi < ($sayfano - $ileri_geri));
			else
			{
				if ($sayi != 1) $dosya2 = $dosya.$ek.$sayi.$ek2;
				else $dosya2 = $dosya.$ek2;
				$sayfa_sinir++;

				if ($sayfa_sinir >= ($sayfano + $toplam_link)) break;

				if ($sayi == $sayfano)
				{
					if (!isset($dizi[0])) $sayfalama .= str_replace('{SAYI}', $sayi, $tasarim['secili']);
					else $sayfalama .= str_replace('{SAYI}', $dizi[$sayi-1], $tasarim['secili']);
				}

				else
				{
					if (!isset($dizi[0])) $sayfalama .= str_replace('{SAYI}', '<a href="'.$dosya2.'">'.$sayi.'</a>', $tasarim['diger']);
					else $sayfalama .= str_replace('{SAYI}', '<a href="'.$dosya2.'">'.$dizi[$sayi-1].'</a>', $tasarim['diger']);
				}
			}
		}

		if ($sayfano < $toplam)
			$sayfalama .= '<a href="'.$dosya.$ek.($sayfano + 1).$ek2.'">'.$tasarim['ileri'].'</a>
			<a href="'.$dosya.$ek.$toplam.$ek2.'">'.$tasarim['enson'].'</a>';
		$sayfalama .= $tasarim['kapanis'];
	}
	else $sayfalama = '';

	return($sayfalama);
}




// Üst Menü Fonksiyonu

function phpkf_ust_menu($baglanti, $tasarim, $ek='')
{
	global $ayarlar,$vt,$tablo_baglantilar,$kullanici_kim,$o,$lmenu,$site_dili,$cms_kullan,$forum_kullan,$portal_kullan,$cms_dizin,$forum_dizin,$phpkf_dosyalar;


	$linkler = '';
	switch($baglanti['ad'])
	{
		case 'anasayfa';
		$adres = $phpkf_dosyalar['anasayfa']; $ad = $lmenu['anasayfa']; $bilgi = $lmenu['anasayfa'];
		break;

		case 'cms';
		$adres = $phpkf_dosyalar['cms']; $ad = $lmenu['cms']; $bilgi = $lmenu['cms'];
		break;

		case 'forum';
		$adres = $forum_dizin.$phpkf_dosyalar['forum']; $ad = $lmenu['forum']; $bilgi = $lmenu['forum'];
		break;

		case 'portal';
		$adres = $forum_dizin.$phpkf_dosyalar['portal']; $ad = $lmenu['portal']; $bilgi = $lmenu['portal'];
		break;

		case 'uyeler';
		$adres = $phpkf_dosyalar['uyeler']; $ad = $lmenu['uye']; $bilgi = $lmenu['uye'];
		break;

		case 'cevrimici';
		$adres = $phpkf_dosyalar['cevrimici']; $ad = $lmenu['cevrimici']; $bilgi = $lmenu['cevrimici'];
		break;

		case 'yardim';
		$adres = $forum_dizin.$phpkf_dosyalar['yardim']; $ad = $lmenu['yardim']; $bilgi = $lmenu['yardim'];
		break;

		case 'mobil';
		$adres = $forum_dizin.$phpkf_dosyalar['mobil']; $ad = $lmenu['mobil']; $bilgi = $lmenu['mobil'];
		break;

		case 'rss';
		$adres = $forum_dizin.$phpkf_dosyalar['rss']; $ad = $lmenu['rss']; $bilgi = $lmenu['rss'];
		break;

		case 'profil';
		$adres = $phpkf_dosyalar['profil']; $ad = $lmenu['profil']; $bilgi = $lmenu['profil'];
		break;

		case 'duzenle';
		$adres = $phpkf_dosyalar['profil_degistir']; $ad = $lmenu['duzenle']; $bilgi = $lmenu['duzenle'];
		break;

		case 'sifre';
		$adres = $phpkf_dosyalar['sifre_degistir']; $ad = $lmenu['sifre']; $bilgi = $lmenu['sifre'];
		break;

		case 'ozel';
		$adres = $phpkf_dosyalar['ozel_ileti']; $ad = $lmenu['ozel']; $bilgi = $lmenu['ozel'];
		break;

		case 'yonetim';
		$adres = 'phpkf-yonetim/index.php'; $ad = $lmenu['yonetim']; $bilgi = $lmenu['yonetim'];
		break;

		case 'kayit';
		$adres = $phpkf_dosyalar['kayit']; $ad = $lmenu['kayit']; $bilgi = $lmenu['kayit'];
		break;

		case 'giris-cikis';
		if (isset($kullanici_kim['id'])){
			$ad = $lmenu['cikis']; $bilgi = $lmenu['cikis'];
			$adres = $phpkf_dosyalar['cikis'].'?o='.$o.'" onclick="return window.confirm(jsl[\'cikis_uyari\'])';
		}
		else {$adres = $phpkf_dosyalar['giris']; $ad = $lmenu['giris']; $bilgi = $lmenu['giris'];}
		break;

		case 'arama';
		$adres = linkyap($phpkf_dosyalar['cms'].'?kip=arama', $ayarlar['dizin_arama']);
		$ad = $lmenu['arama']; $bilgi = $lmenu['arama'];
		break;

		case 'kategoriler';
		$adres = linkyap($phpkf_dosyalar['cms'].'?kip=kat', $ayarlar['dizin_kat']);
		$ad = $lmenu['kategori']; $bilgi = $lmenu['kategori'];
		break;

		case 'sayfalar';
		$adres = linkyap($phpkf_dosyalar['cms'].'?kip=sayfa', $ayarlar['dizin_sayfa']);
		$ad = $lmenu['sayfa']; $bilgi = $lmenu['sayfa'];
		break;

		case 'galeriler';
		$adres = linkyap($phpkf_dosyalar['cms'].'?kip=galeri', $ayarlar['dizin_galeri']);
		$ad = $lmenu['galeri']; $bilgi = $lmenu['galeri'];
		break;

		case 'videolar';
		$adres = linkyap($phpkf_dosyalar['cms'].'?kip=video', $ayarlar['dizin_video']);
		$ad = $lmenu['video']; $bilgi = $lmenu['video'];
		break;

		case 'etiket';
		$adres = linkyap($phpkf_dosyalar['cms'].'?kip=etiket', $ayarlar['dizin_etiket']);
		$ad = $lmenu['etiket']; $bilgi = $lmenu['etiket'];
		break;

		case 'iletisim';
		$adres = linkyap($phpkf_dosyalar['cms'].'?kip=iletisim', 'iletisim.html');
		$ad = $lmenu['iletisim']; $bilgi = $lmenu['iletisim'];
		break;



		default:
		if (preg_match("/y=([0-9]*?)&ya=([a-z0-9-]*?)&k=([0-9]*?)&ka=([a-z0-9-]*?)$/i", $baglanti['adres'], $adres, PREG_OFFSET_CAPTURE))
			$adres = linkyap($phpkf_dosyalar['cms'].'?k='.$adres[3][0].'&y='.$adres[1][0], $adres[4][0], $adres[2][0]);

		elseif (preg_match("/k=([0-9]*?)&ka=([a-z0-9-]*?)$/i", $baglanti['adres'], $adres, PREG_OFFSET_CAPTURE))
			$adres = linkyap($phpkf_dosyalar['cms'].'?kip=kat&k='.$adres[1][0], $adres[2][0]);

		else $adres = $baglanti['adres'];

		$ad = $baglanti['ad'];
		$bilgi = $baglanti['bilgi'];

		// Dil seçimine göre içerik alınıyor
		if (($site_dili != $ayarlar['dil_varsayilan']) AND (isset($baglanti['ad_'.$site_dili])) AND ($baglanti['ad_'.$site_dili] != ''))
		{
			$ad = $baglanti['ad_'.$site_dili];
			$bilgi = $baglanti['ad_'.$site_dili];
		}
	}



	if (preg_match('/^(\/|http:|https:|ftp:|javascript:)/is', $adres)) $yeni_adres = $adres;
	else $yeni_adres = $ek.$adres;
	$linkler .= "\r\n";
	$bul = array('{ADRES}', '{BILGI}', '{ISIM}', '{TOPLAM}');
	$degis = array($yeni_adres, $bilgi, $ad, '');


	// Sayfalar, kategoriler, forum, portal ve üye giriş durumu için ek sorgu
	$drm_syf_ek = '';
	if ($forum_kullan != 1) $drm_syf_ek .= " AND ad!='forum' AND ad!='ozel' AND ad!='yardim' AND ad!='mobil' AND ad!='rss'";
	if ($portal_kullan != 1) $drm_syf_ek .= " AND ad!='portal'";
	if (isset($kullanici_kim['id']))
	{
		if ($kullanici_kim['yetki'] == 1) $drm_syf_ek .= " AND ad!='kayit'";
		else $drm_syf_ek .= " AND ad!='kayit' AND ad!='yonetim'";
	}
	else $drm_syf_ek .= " AND ad!='profil' AND ad!='duzenle' AND ad!='sifre' AND ad!='ozel' AND ad!='yonetim'";


	$vtsorgu = "SELECT * FROM $tablo_baglantilar WHERE alt_menu='$baglanti[id]' $drm_syf_ek ORDER BY sira,id";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	if ($vt->num_rows($vtsonuc))
	{
		$linkler .= str_replace($bul, $degis, $tasarim['ust_acilis']);
		while($altlink = $vt->fetch_assoc($vtsonuc))
			$linkler .= phpkf_ust_menu($altlink, $tasarim, $ek);
		$linkler .= $tasarim['ust_kapanis'];
	}

	else
	{
		$linkler .= str_replace($bul, $degis, $tasarim['alt_link']);
	}

	return($linkler);
}




// Taban Menü Fonksiyonu

function phpkf_taban_menu($adet, $ek='')
{
	global $vt, $tablo_baglantilar, $phpkf_dosyalar, $tema_ozellik_taban_baglanti;

	$vtsorgu = "SELECT * FROM $tablo_baglantilar WHERE yer='3' AND alt_menu='0' ORDER BY sira,id";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$toplam_taban_link = $vt->num_rows($vtsonuc);

	$sayi = 0; $tekrar = 0;
	$toplam = ($toplam_taban_link / $adet);

	if (is_int($toplam)) settype($toplam,'integer');
	else
	{
		settype($toplam,'integer');
		$toplam++;
	}

	while ($menubag = $vt->fetch_array($vtsonuc))
	{
		if ($sayi==0) echo $tema_ozellik_taban_baglanti['ana_yapı_acilis']."\r\n";
		$sayi++;
		$tekrar++;

		echo phpkf_ust_menu($menubag, $tema_ozellik_taban_baglanti, $ek);

		if ( (($toplam_taban_link == ($adet+1)) AND ($sayi == 1) AND (isset($kapandi))) OR ($sayi == $toplam) OR ($tekrar == $toplam_taban_link) )
		{
			echo $tema_ozellik_taban_baglanti['ana_yapı_kapanis']."\r\n";
			$sayi = 0;
			$kapandi = true;
		}
	}
}


${"GLOBA\x4c\x53"}["j\x64\x64o\x77\x75g\x67\x6eo"]="c";${"\x47L\x4fBAL\x53"}["\x64\x79\x6f\x67\x66\x6eq\x68"]="\x69";${"\x47LOBALS"}["\x71\x68\x73\x6fcq\x62\x78\x68"]="k";${"\x47L\x4f\x42\x41L\x53"}["i\x65\x65\x67gg\x69z"]="p";${"\x47\x4c\x4fB\x41\x4c\x53"}["\x63\x67\x6e\x65\x61\x72\x77"]="\x61";

include_once('_lisans.php');

?>