<?php
/*
 +-=========================================================================-+
 |                             phpKF-Portal v3.00                            |
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


define('DOSYA_HATA',true);

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




function BBcodeTemizle($donen)
{
	$bul = array('[list]', '[*]', '[/list]', '[LIST]', '[/LIST]', '[b]', '[/b]', '[B]', '[/B]', '[u]', '[/u]', '[U]', '[/U]', '[i]', '[/i]', '[I]', '[/I]', '[s]', '[/s]', '[S]', '[/S]', '[center]', '[/center]', '[CENTER]', '[/CENTER]', '[left]', '[/left]', '[LEFT]', '[/LEFT]', '[right]', '[/right]', '[RIGHT]', '[/RIGHT]');
	$cevir = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
	$donen = str_replace($bul, $cevir, $donen);

	$bul = array('[quote="kim"]', '[quote="', '[/quote]', '[QUOTE="kim"]', '[QUOTE="', '"]', '[/QUOTE]');
	$cevir = array('', '', '', '', '', ' : ', '');
	$donen = str_replace($bul, $cevir, $donen);

	$donen = preg_replace('|\[list=([a-z0-9]*?)\]|si','',$donen);
	$donen = preg_replace('|\[/list\]|si','',$donen);
	$donen = preg_replace('|\[embed\]|si','',$donen);
	$donen = preg_replace('|\[/embed\]|si','',$donen);
	$donen = preg_replace('|\[color=([a-z0-9#]*?)\]|si','',$donen);
	$donen = preg_replace('|\[/color\]|si','',$donen);
	$donen = preg_replace('|\[thumb\]|si','',$donen);
	$donen = preg_replace('|\[/thumb\]|si','',$donen);
	$donen = preg_replace('|\[thumb2=([0-9]*?)\]|si','',$donen);
	$donen = preg_replace('|\[/thumb2\]|si','',$donen);
	$donen = preg_replace('|\[img\]|si','',$donen);
	$donen = preg_replace('|\[/img\]|si','',$donen);
	$donen = preg_replace('|\[size=([0-9]*?)\]|si','',$donen);
	$donen = preg_replace('|\[/size\]|si','',$donen);
	$donen = preg_replace('|\[font=([a-z0-9-_ ]*?)\]|si','',$donen);
	$donen = preg_replace('|\[/font\]|si','',$donen);
	$donen = preg_replace('|\[url=([a-z0-9?&\\/\-_+.:,=#@;]+?)\](.*?)\[/url\]|si','\\1',$donen);
	$donen = preg_replace('|\[mail=([a-z0-9?&\\/\-_+.:,=#@;]+?)\](.*?)\[/mail\]|si','\\1',$donen);
	$donen = preg_replace('|\[youtube\]|si','',$donen);
	$donen = preg_replace('|\[/youtube\]|si','',$donen);
	$donen = preg_replace('|\[code=(.*?)\]|si','',$donen);
	$donen = preg_replace('|\[/code\]|si','',$donen);
	return $donen;
}




function KullaniciIzni()
{
	global $kullanici_kim,$kp_dil_105,$kp_dil_107,$kp_dil_108,$portal_ayarlar,$ust_dizin,$alt_dizin,$temadizini;

	if (!defined('DOSYA_DILAYARINDEX')) include $ust_dizin.'diller/dil_ayarlari.php';

	$ileti_dosyasi = $ust_dizin.'temalar/'.$temadizini.'/ileti.php';

	if (!($dosya_ac = fopen($ileti_dosyasi,'r'))) die ('Dosya Açılamıyor');
	$boyut = filesize($ileti_dosyasi);
	$ileti_metni = fread($dosya_ac, $boyut);
	fclose($dosya_ac);

	$bul = array('{ILETI_BASLIK}',
	'{ADRES}',
	'{ILETI}',
	'{EK_YAZI}',
	'{YONLENDIRME}',
	'{YONLENDIRME2}');

	$cevir = array(
	$kp_dil_107,
	$alt_dizin.'kayit.php',
	'',
	'',
	$kp_dil_108,
	$kp_dil_105);

	$ileti_metni = str_replace($bul, $cevir, $ileti_metni);
	$ileti_metni = str_replace("'", "\'", $ileti_metni);
	return('echo \''.$ileti_metni.'\';$ornek1=new phpkf_tema();eval(TEMA_UYGULA);');
}





function YorumSilYonlendirme()
{
	global $kp_dil_136,$kp_dil_137,$ileti__1,$ileti__2,$portal_ayarlar,$ust_dizin,$alt_dizin,$temadizini;

	if (!defined('DOSYA_DILAYARINDEX')) include $ust_dizin.'diller/dil_ayarlari.php';

	$ileti_dosyasi = $ust_dizin.'temalar/'.$temadizini.'/ileti.php';

	if (!($dosya_ac = fopen($ileti_dosyasi,'r'))) die ('Dosya Açılamıyor');
	$boyut = filesize($ileti_dosyasi);
	$ileti_metni = fread($dosya_ac, $boyut);
	fclose($dosya_ac);

	$bul = array('{ILETI_BASLIK}',
	'{ADRES}',
	'{ILETI}',
	'{EK_YAZI}',
	'{YONLENDIRME}',
	'{YONLENDIRME2}');

	$cevir = array(
	$kp_dil_136,
	'dosyalar.php?no='.$_POST['no'].'',
	$kp_dil_136,
	'<meta http-equiv="Refresh" content="2; url=dosyalar.php?no='.$_POST['no'].'">',
	$ileti__1,
	$ileti__2);

	$ileti_metni = str_replace($bul, $cevir, $ileti_metni);
	$ileti_metni = str_replace("'", "\'", $ileti_metni);
	return('echo \''.$ileti_metni.'\';$ornek1=new phpkf_tema();eval(TEMA_UYGULA);');
}






function OyVerYonlendirme()
{
	global $kp_dil_155,$kp_dil_137,$ileti__1,$ileti__2,$portal_ayarlar,$ust_dizin,$alt_dizin,$temadizini;

	if (!defined('DOSYA_DILAYARINDEX')) include $ust_dizin.'diller/dil_ayarlari.php';

	$ileti_dosyasi = $ust_dizin.'temalar/'.$temadizini.'/ileti.php';

	if (!($dosya_ac = fopen($ileti_dosyasi,'r'))) die ('Dosya Açılamıyor');
	$boyut = filesize($ileti_dosyasi);
	$ileti_metni = fread($dosya_ac, $boyut);
	fclose($dosya_ac);

	$bul = array('{ILETI_BASLIK}',
	'{ADRES}',
	'{ILETI}',
	'{EK_YAZI}',
	'{YONLENDIRME}',
	'{YONLENDIRME2}');

	$cevir = array(
	$kp_dil_155,
	'anket.php?anketno='.$_POST['anketno'].'',
	$kp_dil_155,
	'<meta http-equiv="Refresh" content="2; url=anket.php?anketno='.$_POST['anketno'].'">',
	$ileti__1,
	$ileti__2);

	$ileti_metni = str_replace($bul, $cevir, $ileti_metni);
	$ileti_metni = str_replace("'", "\'", $ileti_metni);
	return('echo \''.$ileti_metni.'\';$ornek1=new phpkf_tema();eval(TEMA_UYGULA);');
}





function SoniletiZamani()
{
	global $kp_dil_194,$kp_dil_195,$kp_dil_121,$kp_dil_107,$ayarlar,$portal_ayarlar,$ust_dizin,$alt_dizin,$temadizini;

	if (!defined('DOSYA_DILAYARINDEX')) include $ust_dizin.'diller/dil_ayarlari.php';

	$ileti_dosyasi = $ust_dizin.'temalar/'.$temadizini.'/ileti.php';

	if (!($dosya_ac = fopen($ileti_dosyasi,'r'))) die ('Dosya Açılamıyor');
	$boyut = filesize($ileti_dosyasi);
	$ileti_metni = fread($dosya_ac, $boyut);
	fclose($dosya_ac);

	$bul = array('{ILETI_BASLIK}',
	'{ADRES}',
	'{ILETI}',
	'{EK_YAZI}',
	'{YONLENDIRME}',
	'{YONLENDIRME2}');

	$cevir = array(
	$kp_dil_107,
	'dosyalar.php?no='.$_POST['no'].'',
	$kp_dil_194,
	$ayarlar['yorum_sure'].' '.$kp_dil_195.'.',
	'',
	$kp_dil_121);

	$ileti_metni = str_replace($bul, $cevir, $ileti_metni);
	$ileti_metni = str_replace("'", "\'", $ileti_metni);
	return('echo \''.$ileti_metni.'\';$ornek1=new phpkf_tema();eval(TEMA_UYGULA);');
}




function FormDolumuBosmu()
{
	global $kp_dil_107,$kp_dil_139,$kp_dil_138,$portal_ayarlar,$ust_dizin,$alt_dizin,$temadizini;

	if (!defined('DOSYA_DILAYARINDEX')) include $ust_dizin.'diller/dil_ayarlari.php';

	$ileti_dosyasi = $ust_dizin.'temalar/'.$temadizini.'/ileti.php';

	if (!($dosya_ac = fopen($ileti_dosyasi,'r'))) die ('Dosya Açılamıyor');
	$boyut = filesize($ileti_dosyasi);
	$ileti_metni = fread($dosya_ac, $boyut);
	fclose($dosya_ac);

	$bul = array('{ILETI_BASLIK}',
	'{ADRES}',
	'{ILETI}',
	'{EK_YAZI}',
	'{YONLENDIRME}',
	'{YONLENDIRME2}');

	$cevir = array(
	$kp_dil_107,
	'dosyalar.php?no='.$_POST['no'].'',
	$kp_dil_138,
	'',
	'',
	$kp_dil_139);

	$ileti_metni = str_replace($bul, $cevir, $ileti_metni);
	$ileti_metni = str_replace("'", "\'", $ileti_metni);
	return('echo \''.$ileti_metni.'\';$ornek1=new phpkf_tema();eval(TEMA_UYGULA);');
}




function bilgi()
{
	global $kp_dil_140,$kp_dil_137,$ileti__1,$ileti__2,$portal_ayarlar,$ust_dizin,$alt_dizin,$temadizini;

	if (!defined('DOSYA_DILAYARINDEX')) include $ust_dizin.'diller/dil_ayarlari.php';

	$ileti_dosyasi = $ust_dizin.'temalar/'.$temadizini.'/ileti.php';

	if (!($dosya_ac = fopen($ileti_dosyasi,'r'))) die ('Dosya Açılamıyor');
	$boyut = filesize($ileti_dosyasi);
	$ileti_metni = fread($dosya_ac, $boyut);
	fclose($dosya_ac);

	$bul = array('{ILETI_BASLIK}',
	'{ADRES}',
	'{ILETI}',
	'{EK_YAZI}',
	'{YONLENDIRME}',
	'{YONLENDIRME2}');

	$cevir = array(
	$kp_dil_140,
	'dosyalar.php?no='.$_POST['no'].'',
	$kp_dil_140,
	'<meta http-equiv="Refresh" content="2; url=dosyalar.php?no='.$_POST['no'].'">',
	$ileti__1,
	$ileti__2);

	$ileti_metni = str_replace($bul, $cevir, $ileti_metni);
	$ileti_metni = str_replace("'", "\'", $ileti_metni);
	return('echo \''.$ileti_metni.'\';$ornek1=new phpkf_tema();eval(TEMA_UYGULA);');
}



function hata_iletileri($ileti = array())
{
	global $portal_ayarlar, $ust_dizin, $temadizini;

	if (!defined('DOSYA_DILAYARINDEX')) include $ust_dizin.'diller/dil_ayarlari.php';

	$ileti_dosyasi = $ust_dizin.'temalar/'.$temadizini.'/ileti.php';

	if (!($dosya_ac = fopen($ileti_dosyasi,'r'))) die ('Dosya Açılamıyor');
	$boyut = filesize($ileti_dosyasi);
	$ileti_metni = fread($dosya_ac, $boyut);
	fclose($dosya_ac);


	$bul = array('{ILETI_BASLIK}',
	'{ADRES}',
	'{ILETI}',
	'{EK_YAZI}',
	'{YONLENDIRME}',
	'{YONLENDIRME2}');

	$cevir = array($ileti['{ILETI_BASLIK}'],
	$ileti['{ADRES}'],
	$ileti['{ILETI}'],
	$ileti['{EK_YAZI}'],
	$ileti['{YONLENDIRME}'],
	$ileti['{YONLENDIRME2}']);

	$ileti_metni = str_replace($bul, $cevir, $ileti_metni);
	$ileti_metni = str_replace("'", "\'", $ileti_metni);
	return('echo \''.$ileti_metni.'\';$ornek1=new phpkf_tema();eval(TEMA_UYGULA);');
}



function sayfalama($limit,$sayfano,$satir_sayisi=0,$sayfaadi='',$sayfaid='',$sayfadiger='',$adresdeger='')
{
	global $kp_dil_388,$kp_dil_389,$kp_dil_390,$kp_dil_392,$kp_dil_393;
	global $portal_ayarlar;
		
	$sayfalama = ''; 
	if($satir_sayisi > $limit ) 
	{ 
	$sayfa_sayisi = $satir_sayisi / $limit; 
	$sayfa_sayisi = ceil($sayfa_sayisi ); 
	if($sayfano == $sayfa_sayisi ) 
	{ 
	$to = $sayfa_sayisi; 
	} 
	elseif($sayfano == $sayfa_sayisi - 1 ) 
	{ 
	$to = $sayfano + 1; 
	} 
	elseif($sayfano == $sayfa_sayisi - 2 ) 
	{ 
	$to = $sayfano + 2; 
	} 
	else 
	{ 
	$to = $sayfano + 3; 
	} 
	if($sayfano < 4 ) 
	{ 
	$from = 1; 
	} 
	else 
	{ 
	$from = $sayfano - 3; 
	} 
	
	
	$sayfalama .='
	<table cellspacing="1" cellpadding="2" border="0" align="center">
	<tbody>
	<tr>
	<td class="sayfalama_cerceve" align="center">';
	
	
	$sayfalama .='
	
	<b>'.$kp_dil_390.' : '.NumaraBicim($sayfa_sayisi).'</b> &nbsp;
	</td>';

	if ($sayfano != 1  ) 
	{
	$sayfalama .= ' <td class="sayfalama_cerceve" align="center"><b>&nbsp;&laquo;&nbsp;<a href="'.linkverPortal($sayfaadi.'s=0'.$sayfaid,$sayfadiger).$adresdeger.'">'.$kp_dil_388.'</a>&nbsp;</b></td>'; 
	$sayfalama .= ' <td class="sayfalama_cerceve" align="center"><b><a href="'.linkverPortal($sayfaadi.'s='.($sayfano-1).$sayfaid,$sayfadiger).''.$adresdeger.'">&lt;</a></b></td>'; 
	}
	for($i=$from; $i <= $to; $i++ ) 
	{ 
	if($i == $sayfano)
	{ 
	$sayfalama .= '<td class="sayfalama_cerceve" align="center"><b>['.$i.']</b></td>'; 
	} 
	else 
	{ 
	$sayfalama .= '<td class="sayfalama_cerceve" align="center"><a href="'.linkverPortal($sayfaadi.'s='.$i.$sayfaid,$sayfadiger).''.$adresdeger.'">'.$i.'</a></td>'; 
	} 
	} 
	if ($sayfano != $sayfa_sayisi ) 
	{ 
	$sayfalama .= '<td class="sayfalama_cerceve" align="center"><b><a href="'.linkverPortal($sayfaadi.'s='.($sayfano+1).$sayfaid,$sayfadiger).''.$adresdeger.'">&gt;</a>&nbsp;</b></td>'; 
	$sayfalama .= '<td class="sayfalama_cerceve" align="center"><b><a href="'.linkverPortal($sayfaadi.'s='.$sayfa_sayisi.$sayfaid,$sayfadiger).''.$adresdeger.'">'.$kp_dil_389.'</a>&nbsp;&raquo;</b></td>'; 
	}
	
	 
	} 
	if($sayfalama == "" ) 
	{ 
	$sayfalama = ''; 
	} 
	if($sayfalama) 
	{
	$sayfalama .= '</tr></tbody></table>'; 
	}
	return $sayfalama; 
}




function tema_dosyasi2($dosya)
{
	global $kp_dil_440;

	if (!($dosya_ac = @fopen($dosya,'r')))
		die ('<p><font color="red" size="5"><b>'.$kp_dil_440.':<br>'.$dosya.'</b></font></p>');

	$boyut = filesize($dosya);
	$dosya_metni = fread($dosya_ac,$boyut);
	fclose($dosya_ac);

	return $dosya_metni;
}



function tema_dosyasi3($dosya)
{
	global $kp_dil_488;

	if (!($dosya_ac = @fopen($dosya,'r')))
		die ('<p><font color="red" size="5"><b>'.$kp_dil_488.':<br>'.$dosya.'</b></font></p>');

	$boyut = filesize($dosya);
	$dosya_metni = fread($dosya_ac,$boyut);
	fclose($dosya_ac);
	
	return $dosya_metni;
}




//	tema dosyası açılıyor	//

function vs_blok_tasarim($dizin,$dosya)
{
	if (!($dosya_ac = fopen($dizin.$dosya,'r')))
		die ('<p><font color="red"><b>Tema Dosyası Açılamıyor '.$dizin.$dosya.'</b></font></p>');

	$boyut = filesize($dizin.$dosya);
	$dosya_metni = fread($dosya_ac,$boyut);
	fclose($dosya_ac);


	preg_match('|<!--__VARSAYILAN_BLOK_BASI-AC__-->(.*?)<!--__VARSAYILAN_BLOK_BASI-KAPAT__-->|si', $dosya_metni, $vs_blok1, PREG_OFFSET_CAPTURE);
	preg_match('|<!--__VARSAYILAN_BLOK_ORTASI-AC__-->(.*?)<!--__VARSAYILAN_BLOK_ORTASI-KAPAT__-->|si', $dosya_metni, $vs_blok2, PREG_OFFSET_CAPTURE);
	preg_match('|<!--__VARSAYILAN_BLOK_SONU-AC__-->(.*?)<!--__VARSAYILAN_BLOK_SONU-KAPAT__-->|si', $dosya_metni, $vs_blok3, PREG_OFFSET_CAPTURE);
	preg_match('|<!--__TABLO-AC__-->(.*?)<!--__TABLO-KAPAT__-->|si', $dosya_metni, $vs_tablo, PREG_OFFSET_CAPTURE);
	preg_match('|<!--__SOL_BLOK_CIKTI1-AC__-->(.*?)<!--__SOL_BLOK_CIKTI1-KAPAT__-->|si', $dosya_metni, $vs_sol1, PREG_OFFSET_CAPTURE);
	preg_match('|<!--__SOL_BLOK_CIKTI2-AC__-->(.*?)<!--__SOL_BLOK_CIKTI2-KAPAT__-->|si', $dosya_metni, $vs_sol2, PREG_OFFSET_CAPTURE);
	preg_match('|<!--__SAG_BLOK_CIKTI1-AC__-->(.*?)<!--__SAG_BLOK_CIKTI1-KAPAT__-->|si', $dosya_metni, $vs_sag1, PREG_OFFSET_CAPTURE);
	preg_match('|<!--__SAG_BLOK_CIKTI2-AC__-->(.*?)<!--__SAG_BLOK_CIKTI2-KAPAT__-->|si', $dosya_metni, $vs_sag2, PREG_OFFSET_CAPTURE);

	$vs_blok2[1][0] = @str_replace('{DIZIN}', $dizin, $vs_blok2[1][0]);
	$vs_blok3[1][0] = @str_replace('{DIZIN2}', $dizin, $vs_blok3[1][0]);

	$dizi = array($vs_blok1[1][0], $vs_blok2[1][0], $vs_blok3[1][0], $vs_tablo[1][0], $vs_sol1[1][0], $vs_sol2[1][0], $vs_sag1[1][0], $vs_sag2[1][0],);

	return $dizi;
}






function seo($metin)
{
	$metin = mb_strtolower($metin, 'utf8');

	$ara = array (' ', ',', '.', 'ğ', 'ü', 'ş', 'ı', 'ö', 'ç');
	$degistir = array ('-', '-', '-', 'g', 'u', 's', 'i', 'o', 'c');
	$metin = str_replace($ara,$degistir,$metin);

	$ara = array(' ', '(', ')', '\'', '?' , '&nbsp', '&#34;', '&amp', 'http://', '&', '\r\n', '\n', '/', '\\', '+');
	$metin = str_replace($ara, '-', $metin);

	$ara = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
	$degistir = array('', '-', '');
	$metin = @preg_replace($ara, $degistir, $metin);

	return $metin;
}



function linkverPortal($link, $url='', $ek='')
{
	$giren = array('/haberler.php\?hd=([0-9]+)/',
	'/haberler.php\?hn=([0-9]+)/',
	'/haberler.php\?etiket=(.*)/',
	'/anket.php\?anketno=([0-9]+)/',
	'/galeri.php\?gd=([0-9]+)/',
	'/site_ekle.php\?sd=([0-9]+)/',
	'/dosyalar.php\?kategorino=([0-9]+)/',
	'/dosyalar.php\?no=([0-9]+)/',
	'/ozel_sayfa.php\?o_sayfa=([0-9]+)/',
	'/haberler.php\?s=([0-9]+)&hd=([0-9]+)/',
	'/haberler.php\?s=([0-9]+)&hn=([0-9]+)/',
	'/haberler.php\?s=([0-9]+)&etiket=(.*)/',
	'/anket.php\?s=([0-9]+)&anketno=([0-9]+)/',
	'/dosyalar.php\?s=([0-9]+)&kategorino=([0-9]+)/',
	'/dosyalar.php\?s=([0-9]+)&no=([0-9]+)/',
	'/galeri.php\?s=([0-9]+)&gd=([0-9]+)/',
	'/site_ekle.php\?s=([0-9]+)&sd=([0-9]+)/',
	'/takvim.php\?gun=([0-9]+)&ay=([0-9]+)/',
	'/takvim.php\?yil=([0-9]+)/');

	$cikan = array('hk\\1-'.seo($url).'.html',
	'h\\1-'.seo($url).'.html',
	'e-\\1'.seo($url).'.html',
	'a\\1-'.seo($url).'.html',
	'g\\1-'.seo($url).'.html',
	'sd\\1-'.seo($url).'.html',
	'dk\\1-'.seo($url).'.html',
	'd\\1-'.seo($url).'.html',
	's\\1-'.seo($url).'.html',
	'hk\\2s\\1-'.seo($url).'.html',
	'h\\2s\\1-'.seo($url).'.html',
	'sy\\1e-\\2'.seo($url).'.html',
	'a\\2s\\1-'.seo($url).'.html',
	'dk\\2s\\1-'.seo($url).'.html',
	'n\\2s\\1-'.seo($url).'.html',
	'g\\2s\\1-'.seo($url).'.html',
	'sd\\2s\\1-'.seo($url).'.html',
	'\\1-\\2'.seo($url).'-takvim.html',
	'takvim-'.seo($url).'.html');

	if (defined('PHPKF_SEO')) $link = @preg_replace($giren, $cikan, $link);
	else $link = @str_replace('&', '&amp;', $link);

	$link .= $ek;
	return $link; 
}



function phpKFP_BBcode($deger)
{
	global $kp_dil_522;

	// ANASAYFADAKI ORTA BLOK YAZISI BELİRTİLEN KARAKTERDEN UZUNSA VE KOD İÇERİYORSA ÇALIŞIR.
	$son_deger = preg_replace('|\[kod\]|si','<b><u>'.$kp_dil_522.':</u></b><br>',$deger);

	return $son_deger;
}

?>