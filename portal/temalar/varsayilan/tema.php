<?php

// Tema adı ve renk değişimi desteği
$t_tema_adi = 'Varsayılan';
$t_renkler = array('Mavi'=>'mavi', 'Mor'=>'mor', 'Koyu Gri'=>'siyah');


if (@is_file('ayar.php'))
{
	$ust_dizin ='portal/';
	$alt_dizin ='';
}
else 
{
	$ust_dizin ='';
	$alt_dizin ='../';
}


if ( (isset($_COOKIE['forum_rengi'])) AND ($_COOKIE['forum_rengi'] != '') )
{
	switch($_COOKIE['forum_rengi'])
	{
		case 'mor';
		$ayarlar['tema_renk'] = 'mor';
		break;

		case 'gri';
		$ayarlar['tema_renk'] = 'gri';
		break;

		case 'siyah';
		$ayarlar['tema_renk'] = 'siyah';
		break;

		default:
		$ayarlar['tema_renk'] = 'mavi';
	}
}



$dosya = $ust_dizin.'temalar/varsayilan/blok_tasarim/'.$portal_ayarlar['blok_sekli'].'/'.$portal_ayarlar['blok_sekli'].'.php';

if ($portal_ayarlar['blok_sekli'] == 'varsayilan_blok_tasarimi') $blok_css = '';
elseif (($dosya_ac = @fopen($dosya,'r')) AND (preg_match('/^[A-Za-z0-9_.]+$/', $dosya) == 0) )
{
	$blok_css = '<link href="'.$ust_dizin.'temalar/varsayilan/blok_tasarim/'.$portal_ayarlar['blok_sekli'].'/sablon.css" rel="stylesheet" type="text/css" />';
	@fclose($dosya_ac);
}
else $blok_css = '';



// düğme renkleri
if ($ayarlar['tema_renk'] == 'mor')
{
	// şablon
	$css_satiri = '<link href="'.$ust_dizin.'temalar/varsayilan/css/sablon.css" rel="stylesheet" type="text/css" />
<link href="'.$ust_dizin.'temalar/varsayilan/css/sablon_mor.css" rel="stylesheet" type="text/css" />
<link href="'.$ust_dizin.'temalar/varsayilan/css/portal_stil.css" rel="stylesheet" type="text/css" />'.$blok_css;
	$basliktabani = '';
	$sonileti_rengi = $ust_dizin.'temalar/varsayilan/resimler/resimler/sonileti.gif';

	// alıntı, sil, taşı, değiştir, kilitle ve ip simgeleri
	$simge_yazdir = 'width="22" height="22" border="0" src="'.$ust_dizin.'temalar/varsayilan/resimler/resimler/yazdir.png"';
	$simge_sil = 'width="22" height="22" border="0" src="'.$ust_dizin.'temalar/varsayilan/resimler/resimler/sil.png"';
	$simge_degistir = 'width="22" height="22" border="0" src="'.$ust_dizin.'temalar/varsayilan/resimler/resimler/degistir.png"';
	$alinti_cubuk = 'color:#000000;';
}

elseif ($ayarlar['tema_renk'] == 'gri')
{
	// şablon
	$css_satiri = '<link href="'.$ust_dizin.'temalar/varsayilan/css/sablon.css" rel="stylesheet" type="text/css" />
<link href="'.$ust_dizin.'temalar/varsayilan/css/sablon_koyu.css" rel="stylesheet" type="text/css" />
<link href="'.$ust_dizin.'temalar/varsayilan/css/portal_stil.css" rel="stylesheet" type="text/css" />'.$blok_css;
	$basliktabani = '';
	$sonileti_rengi = $ust_dizin.'temalar/varsayilan/resimler/resimler/soniletis.gif';

	// alıntı, sil, taşı, değiştir, kilitle ve ip simgeleri
	$simge_yazdir = 'width="22" height="22" border="0" src="'.$ust_dizin.'temalar/varsayilan/resimler/resimler/yazdirs.png"';
	$simge_sil = 'width="22" height="22" border="0" src="'.$ust_dizin.'temalar/varsayilan/resimler/resimler/sils.png"';
	$simge_degistir = 'width="22" height="22" border="0" src="'.$ust_dizin.'temalar/varsayilan/resimler/resimler/degistirs.png"';
	$alinti_cubuk = 'color:#000000;';
}





elseif ($ayarlar['tema_renk'] == 'siyah')
{
	// şablon
	$css_satiri = '<link href="'.$ust_dizin.'temalar/varsayilan/css/sablon.css" rel="stylesheet" type="text/css" />
<link href="'.$ust_dizin.'temalar/varsayilan/css/sablon_siyah.css" rel="stylesheet" type="text/css" />
<link href="'.$ust_dizin.'temalar/varsayilan/css/portal_stil.css" rel="stylesheet" type="text/css" />'.$blok_css;
	$basliktabani = '';
	$sonileti_rengi = $ust_dizin.'temalar/varsayilan/resimler/resimler/soniletis.gif';

	// alıntı, sil, taşı, değiştir, kilitle ve ip simgeleri
	$simge_yazdir = 'width="22" height="22" border="0" src="'.$ust_dizin.'temalar/varsayilan/resimler/resimler/yazdirs.png"';
	$simge_sil = 'width="22" height="22" border="0" src="'.$ust_dizin.'temalar/varsayilan/resimler/resimler/sils.png"';
	$simge_degistir = 'width="22" height="22" border="0" src="'.$ust_dizin.'temalar/varsayilan/resimler/resimler/degistirs.png"';
	$alinti_cubuk = 'color:#000000;';
}




else
{
	// şablon
	$css_satiri = '<link href="'.$ust_dizin.'temalar/varsayilan/css/sablon.css" rel="stylesheet" type="text/css" />
<link href="'.$ust_dizin.'temalar/varsayilan/css/portal_stil.css" rel="stylesheet" type="text/css" />'.$blok_css;
	$basliktabani = '';
	$sonileti_rengi = $ust_dizin.'temalar/varsayilan/resimler/resimler/sonileti.gif';

	// alıntı, sil, taşı, değiştir, kilitle ve ip simgeleri
	$simge_yazdir = 'width="22" height="22" border="0" src="'.$ust_dizin.'temalar/varsayilan/resimler/resimler/yazdir.png"';
	$simge_sil = 'width="22" height="22" border="0" src="'.$ust_dizin.'temalar/varsayilan/resimler/resimler/sil.png"';
	$simge_degistir = 'width="22" height="22" border="0" src="'.$ust_dizin.'temalar/varsayilan/resimler/resimler/degistir.png"';
	$alinti_cubuk = 'color:#000000;';
}




//  GENEL MENÜ TASARIMI  //

// Tüm sayfaların üstünde bulunan genel menü tasarımı

$tema_ozellik_genel_menu = array(
// üst link açılış
'ust_acilis' => '<li role="menuitem"><a href="{ADRES}" title="{BILGI}">{ISIM}</a>
<ul class="dropdown-menu2" role="menu">',

// üst link kapanış
'ust_kapanis' => '</ul></li>',

// alt link
'alt_link' => '<li role="menuitem"><a href="{ADRES}" title="{BILGI}">{ISIM}</a></li>'
);





//  BAĞLANTILAR VE KATEGORİLER BLOKLARININ TASARIMI  //

// Sayfaların sol ve sağında bulunan
// bağlantılar ve kategoriler bloklarının içindeki sıralama kodları

$tema_ozellik_blok_baglanti = array(
// ana yapı açılış
'ana_yapı_acilis' => '<ul class="kutu-liste">',

// ana yapı kapanış
'ana_yapı_kapanis' => '</ul>',

// üst link açılış
'ust_acilis' => '<li><a href="{ADRES}" title="{BILGI}">{ISIM} <i class="toplam">{TOPLAM}</i></a>
<ul style="list-style-type:none;padding-left:15px">',

// üst link kapanış
'ust_kapanis' => '</ul></li>',

// alt link
'alt_link' => '<li><a href="{ADRES}" title="{BILGI}">{ISIM} <i class="toplam">{TOPLAM}</i></a></li>'
);




//  TABAN BAĞLANTILARI TASARIMI  //

// Sayfaların altında bulunan taban linklerinin sıralanma kodları

$tema_ozellik_taban_baglanti = array(
// ana yapı açılış
'ana_yapı_acilis' => '<div class="footer-linkler"><ul>',

// ana yapı kapanış
'ana_yapı_kapanis' => '</ul></div>',

// üst link açılış
'ust_acilis' => '<li><a href="{ADRES}" title="{BILGI}">{ISIM}</a>
<ul>',

// üst link kapanış
'ust_kapanis' => '</ul></li>',

// alt link
'alt_link' => '<li><a href="{ADRES}" title="{BILGI}">{ISIM}</a></li>'
);
?>