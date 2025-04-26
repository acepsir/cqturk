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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kat='11' OR kat='14'";
if (!defined('DOSYA_AYAR')) include_once('../../phpkf-ayar.php');
if (!defined('DOSYA_KULLANICI_KIMLIK')) include_once('../kullanici_kimlik.php');
include_once('dosya_tipleri.php');


// Üye yetkisi denetleniyor
if (!$kullanici_kim) exit($l['dosya_yukleme_uyari']);
if (($kullanici_kim['yetki'] != 1) AND ($ayarlar['yukleme_dosya_uye'] == '')) exit($l['dosya_yukleme_uyari']);


// Yetkiye göre yükleme dizini ve dosya türleri
if ($kullanici_kim['yetki'] == 1)
{
	$DosyaTurleri = str_replace(' ', '', $ayarlar['yukleme_dosya']);
	$yukleme_dizin = $ayarlar['yukleme_dizin'];
	$yukleme_boyut = 1073741824;
}
else
{
	$DosyaTurleri = str_replace(' ', '', $ayarlar['yukleme_dosya_uye']);
	$yukleme_dizin = str_replace('{uye_id}', $kullanici_kim['id'], $ayarlar['yukleme_dizin_uye']);
	$yukleme_boyut = $ayarlar['yukleme_boyut'];
}

// resim boyut ve kalite değişkenleri
$genislik = $ayarlar['yukleme_genislik'];
$yukseklik = $ayarlar['yukleme_yukseklik'];
$kalite = $ayarlar['yukleme_kalite'];


// yükleme dizin adı hazırlanıyor
if (@preg_match('/^\//', $yukleme_dizin)) $yukleme_dizin = substr($yukleme_dizin, 1);
if (@preg_match('/\/$/', $yukleme_dizin)) $yukleme_dizin = substr($yukleme_dizin, 0, -1);
$IstenilenDizin = urldecode("../../$yukleme_dizin/");

if (!@touch($IstenilenDizin))
{
	@mkdir($IstenilenDizin, 0755);
	@touch($IstenilenDizin.'/index.html');
}



// DOSYA VE DİZİN BOYUTU FORMATI AYARLANIYOR
function BoyutKontrol($boyut)
{
	// SEMBOLLER HAZIRLANIYOR
	$sembol = array('<strong>Byte</strong>', '<strong>KB</strong>', '<strong>MB</strong>', '<strong>GB</strong>', '<strong>TB</strong>', '<strong>PB</strong>', '<strong>EB</strong>', '<strong>ZB</strong>', '<strong>YB</strong>');

	// BOYUT TAM RAKAM OLARAK AYARLANIYOR
	$boyutx=ceil($boyut);

	// BYTE FORMATI AYARLANIYOR
	if (strlen($boyutx) <= 3) $boyut = number_format($boyut).' '.$sembol[0];
	elseif (strlen($boyutx) <= 6) $boyut = number_format(($boyut / 1024),1).' '.$sembol[1];
	elseif (strlen($boyutx) <= 9) $boyut = number_format(($boyut / 1024/1024),1).' '.$sembol[2];
	elseif (strlen($boyutx) <= 12) $boyut = number_format(($boyut / 1024/1024/1024),1).' '.$sembol[3];
	elseif (strlen($boyutx) <= 15) $boyut = number_format(($boyut / 1024/1024/1024/1024),1).' '.$sembol[4];
	elseif (strlen($boyutx) <= 18) $boyut = number_format(($boyut / 1024/1024/1024/1024/1024),1).' '.$sembol[5];
	elseif (strlen($boyutx) <= 21) $boyut = number_format(($boyut / 1024/1024/1024/1024/1024/1024),1).' '.$sembol[6];
	elseif (strlen($boyutx) <= 24) $boyut = number_format(($boyut / 1024/1024/1024/1024/1024/1024/1024),1).' '.$sembol[7];
	elseif (strlen($boyutx) <= 27) $boyut = number_format(($boyut / 1024/1024/1024/1024/1024/1024/1024/1024),1).' '.$sembol[8];

	// VERİ DÖNDÜRÜLÜYOR
	return $boyut;
}


// BULUNULAN KONUMDAKİ TÜM DOSYALARIN VE KLASÖRLERİN BOYUTU ALINIYOR
function filesize_r($klasor)
{
	if(!file_exists($klasor)) return 0;
	if(is_file($klasor)) return filesize($klasor);
	$ret = 0;

	// KLASÖR BOŞ DEĞİLSE İŞLEM YAP
	if($glob = glob($klasor."/*"))
	{
		foreach($glob as $fn)
		$ret += filesize($fn);
		return $ret;
	}
}



// BULUNULAN KONUMDAKİ TÜM DOSYA VE KLASÖRLER ÇEKİLİYOR
function Konum()
{
	global $anadizin, $DosyaTurleri, $ayarlar, $TanimliDosyaTipleri, $dds, $l;

	list($IstenilenDizin, $SuankiKonum, $DosyaKonum, $UstDizin) = Neredeyim();

	$count = 0;
	$kota = 20;
	$bas = ($dds * $kota);
	$son = ($dds * $kota)+$kota;

	$say = 1;
	$Cikti = '<div><b>'.$l['konum'].':</b> ';

	if($SuankiKonum != '') $Cikti .= '<a href="javascript:void(0)" onclick="VeriyiIlet(\'vericek\'), this.href=window.location.href.split(\'#\')[0]+\'#dds=0#ddyuk='.$UstDizin.'/\'">[ '.$l['ust_dizin'].' ]</a> &nbsp; ';

	$Knm = str_replace('../', '', $IstenilenDizin);
	$Knm = $anadizin.$Knm;


	$Cikti .= $Knm.$SuankiKonum.'</div><br />
	<table><tr class="ilkSatir">
	<th><input name="sec[]" type="checkbox" onclick="dosyaSec(\'\');" /></th>
	<th class="ad">'.$l['dosya_adi'].'</th>
	<th>'.$l['degistirme_tarihi'].'</th>
	<th>'.$l['boyut'].'</th>
	</tr>';


	// TÜM KLASÖRLER ÇEKİLİYOR
	$dizin = @opendir($IstenilenDizin.$SuankiKonum.'/');
	while (($count < $son) && (@gettype($bilgi = @readdir($dizin)) != 'boolean'))
	{
		if ((@is_dir($IstenilenDizin.$SuankiKonum.$bilgi)) and (($bilgi) != '.') and (($bilgi) != '..') and (($bilgi) != 'k'))
		{
			$count++;
			if ($count <= $bas) continue;

			$Cikti .= '<tr class="renklendir" id="satir'.$say.'">
			<td><input onclick="dosyaSec('.$say.');" name="sec[]" type="checkbox" value="'.$bilgi.'" /></td>
			<td><a href="javascript:void(0)" onclick="VeriyiIlet(\'vericek\'), this.href=window.location.href.split(\'#\')[0]+\'#dds=0#ddyuk='.$SuankiKonum.$bilgi.'/\'"><div class="dosyalar klasor"></div></a>
			<a href="javascript:void(0)" onclick="javascript:VeriyiIlet(\'yenidenadlandir\',\''.$bilgi.'\'), this.href=window.location.href.split(\'#\')[0]+\'#dds=0#ddyuk='.$SuankiKonum.'/\'" title="'.$l['yeniden_adlandir'].'">
			<div class="yaziOrtala2">&nbsp;'.$bilgi.'</div></a></td>
			<td align="center">'.zaman('d-m-Y',$ayarlar['saat_dilimi'],false,filemtime($IstenilenDizin.$SuankiKonum.$bilgi),0,true).'</td>
			<td align="center">'.BoyutKontrol(filesize_r($IstenilenDizin.$SuankiKonum.$bilgi)).'</td>
			</tr>';
			$say++;
		}
	}
	@closedir($dizin);





	// TÜM DOSYALAR ÇEKİLİYOR
	$dizin2 = @opendir($IstenilenDizin.$SuankiKonum.'/');
	while (($count < $son) && (@gettype($bilgi2 = @readdir($dizin2)) != 'boolean'))
	{
		$uzanti = @end(explode('.',$bilgi2));

		if (@is_file($IstenilenDizin.$SuankiKonum.$bilgi2) and (@preg_match("/$uzanti/", $DosyaTurleri)) )
		{
			$count++;
			if ($count <= $bas) continue;
			$resimGenislik = 0;
			$resimYukseklik = 0;

			if (preg_match("/$uzanti,/", $TanimliDosyaTipleri['resim_dosyalari'])) $dtip="resim";
			elseif (@preg_match("/$uzanti,/", $TanimliDosyaTipleri['arsiv_dosyalari'])) $dtip="arsiv";
			elseif (@preg_match("/$uzanti,/", $TanimliDosyaTipleri['video_dosyalari'])) $dtip="video";
			elseif (@preg_match("/$uzanti,/", $TanimliDosyaTipleri['ses_dosyalari'])) $dtip="ses";
			elseif (@preg_match("/$uzanti,/", $TanimliDosyaTipleri['flash_dosyalari'])) $dtip="flash";
			elseif (@preg_match("/$uzanti,/", $TanimliDosyaTipleri['metin_dosyalari'])) $dtip="metin";
			elseif (@preg_match("/$uzanti,/", $TanimliDosyaTipleri['ofis_dosyalari'])) $dtip="ofis";
			elseif (@preg_match("/$uzanti,/", $TanimliDosyaTipleri['web_dosyalari'])) $dtip="web";
			else $dtip = "dosya";

			$Cikti .= '<tr class="renklendir" id="satir'.$say.'">
			<td><input onclick="dosyaSec('.$say.')" name="sec[]" type="checkbox" value="'.$bilgi2.'" id="'.$bilgi2.'" rel="'.$DosyaKonum.$SuankiKonum.$bilgi2.'" /></td>
			<td>';

			if($dtip == 'resim')
			{
				if (($uzanti=='jpg')OR($uzanti=='jpeg')OR($uzanti=='png')OR($uzanti=='gif')OR($uzanti=='ico')OR($uzanti=='bmp'))
				{
					if ($uzanti == 'png') $resim = str_replace('.png', '.jpg', $bilgi2);
					else $resim = $bilgi2;

					if (@is_file($IstenilenDizin.$SuankiKonum.'k/'.$resim)) $kresim = $DosyaKonum.$SuankiKonum.'k/'.$resim;
					else $kresim = $DosyaKonum.$SuankiKonum.$bilgi2;

					list($resimGenislik, $resimYukseklik) = @getimagesize(str_replace(' ', '%20', $DosyaKonum.$SuankiKonum.$bilgi2));

					$Cikti .= '<a href="javascript:void(0)" onclick="VeriyiIlet(\'yenipencere\',\''.$DosyaKonum.$SuankiKonum.$bilgi2.'\',\'resim\')"><div class="resim_alani"><img src="'.$kresim.'" alt="." /></div></a>';
				}
				else $Cikti .= '<a href="'.$DosyaKonum.$SuankiKonum.$bilgi2.'"><div class="dosyalar '.$dtip.'">&nbsp;</div></a>';
			}

			elseif (($dtip == 'video') OR ($dtip == 'ses') OR ($dtip == 'flash'))
			{
				$Cikti .= "<a href=\"javascript:void(0)\" onclick=\"VeriyiIlet('yenipencere','$DosyaKonum$SuankiKonum$bilgi2','$dtip')\"><div class=\"dosyalar $dtip\">&nbsp;</div></a>";
			}

			else $Cikti .= '<a href="'.$DosyaKonum.$SuankiKonum.$bilgi2.'"><div class="dosyalar '.$dtip.'">&nbsp;</div></a>';


			if (($resimGenislik==0) AND ($resimYukseklik==0)) $dosya_bilgi = '&nbsp;'.$bilgi2;
			else $dosya_bilgi = '&nbsp;'.$bilgi2.'<br>&nbsp;('.$resimGenislik.'x'.$resimYukseklik.')';


			$Cikti .= '<a href="javascript:void(0)" onclick="javascript:VeriyiIlet(\'yenidenadlandir\',\''.$bilgi2.'\'), this.href=window.location.href.split(\'#\')[0]+\'#dds=0#ddyuk='.$SuankiKonum.'/\'" title="'.$l['yeniden_adlandir'].'">
			<div class="yaziOrtala">'.$dosya_bilgi.'</div></a></td>
			<td align="center">'.zaman('d-m-Y',$ayarlar['saat_dilimi'],false,filemtime($IstenilenDizin.$SuankiKonum.$bilgi2),0,true).'</td>
			<td align="center">'.BoyutKontrol(filesize($IstenilenDizin.$SuankiKonum.$bilgi2)).'</td>
			</tr>';

			$say++;
		}
	}


	if (($say==1) AND ($count>0)) $Cikti .= '<tr class="renklendir"><td colspan="4" valign="top" align="center"><br>'.$l['sona_gelindi'].'<br><br></td></tr>';
	elseif ($say==1) $Cikti .= '<tr class="renklendir"><td colspan="4" valign="top" align="center"><br>'.$l['klasor_bos'].'<br><br></td></tr>';


	// Sayfalama
	if ( ($say!=1) OR (($say==1) AND ($count>0)) OR ($kota<=($say-1)) )
	{
		$Cikti .= '<tr><td colspan="4" valign="top" align="center"><br><div class="sayfalama"><div class="dis"><div class="ic">';

		if ($dds!=0) $Cikti .= '<a id="ddsayfabas" href="javascript:void(0)" onclick="javascript:sayfaArttir(\'bas\')"><span class="enbas">&laquo;</span></a>
		<a id="ddsayfaartibes" href="javascript:void(0)" onclick="javascript:sayfaArttir(\'eksibes\')"><span class="geri">-5</span></a>
		<a id="ddsayfaartius" href="javascript:void(0)" onclick="javascript:sayfaArttir(\'eksiuc\')"><span class="geri">-3</span></a>
		<a id="ddsayfageri" href="javascript:void(0)" onclick="javascript:sayfaArttir(\'geri\')"><span class="geri">&nbsp;&#9668;&nbsp;</span></a>';

		$Cikti .= '<span id="ddsayfano" class="secili">'.($dds+1).'</span>';

		if (($say!=0) AND ($say!=1) AND ($kota<=($say-1)) ) $Cikti .= '<a id="ddsayfaileri" href="javascript:void(0)" onclick="javascript:sayfaArttir(\'ileri\')"><span class="ileri">&nbsp;&#9658;&nbsp;</span></a>
		<a id="ddsayfaartius" href="javascript:void(0)" onclick="javascript:sayfaArttir(\'artiuc\')"><span class="ileri">+3</span></a>
		<a id="ddsayfaartibes" href="javascript:void(0)" onclick="javascript:sayfaArttir(\'artibes\')"><span class="ileri">+5</span></a>';

		if ($say!=1) $Cikti .= '</div></div></div></td></tr>';
	}

	$Cikti .= '</tbody></table>';

	return $Cikti;
}



// DİZİN TESPİTİ YAPILIYOR
function Neredeyim()
{
	// DIŞARIDAN DEĞİŞKEN AKTARILIYOR
	global $SuankiKonum, $IstenilenDizin, $anadizin, $protocol;

	if(substr($SuankiKonum,0,1) == '/') $SuankiKonum = substr($SuankiKonum,1,-1);
	$IstenilenDizin = str_replace('//', '/', $IstenilenDizin);
	$DosyaKonumIcin = str_replace('../', '', $IstenilenDizin);

	/* SİTE ADRESİ ALINIYOR */
	if(getenv("HTTP_HOST")) $ServerAlanadi = getenv('HTTP_HOST');
	else $ServerAlanadi = $_SERVER['HTTP_HOST'];

	$ServerAlanadi = str_replace('//', '/', $ServerAlanadi);
	$DosyaKonum = $protocol.'://'.$ServerAlanadi.$anadizin.$DosyaKonumIcin;

	// ÜST DİZİNE GİDEBİLMEK İÇİN BAĞLANTI HAZIRLANIYOR
	$ustdizin1 = explode('/',$SuankiKonum);
	$UstDizin = "";

	// DİZİNLER DÖNGÜYE SOKULUYOR
	for($i=0; $i < (count($ustdizin1)-2); $i++){
		$UstDizin .= $ustdizin1[$i];
		if($i != (count($ustdizin1)-1)) $UstDizin .= "/";
	}

	return array($IstenilenDizin, $SuankiKonum, $DosyaKonum, $UstDizin);
}



// TÜM KLASÖR VE DOSYALAR SİLİNİYOR
function KlasorSil($konum)
{
	// EN SONA SLASH EKLENİYOR
	if (substr($konum, strlen($konum)-1, 1)!= '/') $konum .= '/';

	// BELİRTİLEN KONUM AÇILIYOR
	if ($ac = @opendir($konum)) 
	{
		// DOSYALAR VE KLASÖRLER LİSTELENİYOR
		while ($objeler = readdir($ac)) 
		{
			if ($objeler!= '.' && $objeler!= '..') 
			{
				// KLASÖR İŞLEMLERİ
				if (@is_dir($konum.$objeler)) 
				{
					if (!KlasorSil($konum.$objeler))
					return false;
				} 
				// DOSYA İŞLEMLERİ
				elseif (is_file($konum.$objeler))
				{
					if (!unlink($konum.$objeler))
					return false;
				}
			}
		}
		@closedir($ac);
		// KLASÖR SİL
		if (!rmdir($konum)) return false;
		else return true;
	}
	else
	{
		// KLASÖR SİL
		if (!rmdir($konum)) return false;
		else return true;
	}
	return true;
}




// DOSYA OLUŞTURMA, KLASÖR OLUŞTURMA, İSİM DEĞİŞTİRME VE SİLME İŞLEMLERİ YAPILIYOR
function IslemYap()
{
	global $Durum, $GelenVeri, $DosyaTurleri, $genislik, $yukseklik, $kalite, $yukleme_boyut, $l;
	list($IstenilenDizin, $SuankiKonum) = Neredeyim();
	$Cikti = '';

	// DOSYA VE KLASÖR OLUŞTURUCU
	if ($Durum == 'dosyayukle')
	{
		$uzanti = @end(explode('.',$GelenVeri));
		$dosya_boyut = $_SERVER['CONTENT_LENGTH'];

		if ($dosya_boyut > $yukleme_boyut) $Cikti = 'dosyabuyuk';

		elseif (@preg_match("/$uzanti/", $DosyaTurleri))
		{
			$resim_yol = $IstenilenDizin.$SuankiKonum;
			$resim_adi = isimDonustur($GelenVeri);

			// YENİ VE ESKİ İSİM AYIKLANIYOR
			if(file_put_contents($resim_yol.$resim_adi, file_get_contents('php://input')))
			{
				if (($uzanti=='jpg')OR($uzanti=='jpeg')OR($uzanti=='png'))
				{
					$bilgi = getimagesize(str_replace(' ', '%20', $resim_yol.$resim_adi));
					list($ozgen, $ozyuk) = $bilgi;
					$ozoran = $ozgen/$ozyuk;

					if (($ozgen>$genislik) OR ($ozyuk>$yukseklik))
					{
						if ($genislik/$yukseklik > $ozoran) $genislik = $yukseklik*$ozoran;
						else $yukseklik = $genislik/$ozoran;

						if (!@touch($resim_yol.'/k/')) {@mkdir($resim_yol.'/k', 0755); @touch($resim_yol.'/k/index.html');}

						if ($uzanti != 'png') $kaynak = imagecreatefromjpeg($resim_yol.$resim_adi);
						else {
							$kaynak = imagecreatefrompng($resim_yol.$resim_adi);
							$resim_adi = str_replace($uzanti, '', $resim_adi).'jpg';
						}

						$resim_yeni = imagecreatetruecolor($genislik, $yukseklik);
						imagecopyresampled($resim_yeni, $kaynak, 0, 0, 0, 0, $genislik, $yukseklik, $ozgen, $ozyuk);
						$resim_sonuc = imagejpeg($resim_yeni, $resim_yol.'/k/'.$resim_adi, round($kalite));
					}
				}
				$Cikti = 'yuklendi';
			}
			else $Cikti = 'yuklenmedi';
		}
		else $Cikti = 'desteklenmeyen';
	}


	// DOSYA VE KLASÖR OLUŞTURUCU
	if($Durum == 'klasorolustur')
	{
		// KONUM BİLGİSİ ALINIYOR
		$value = $IstenilenDizin.$SuankiKonum;

		// KLASÖR OLUŞTURUCU
		if($Durum == 'klasorolustur')
		{
			// KLASÖR OLUŞTURULUYOR
			if(@mkdir($value.$GelenVeri, 0755))
			{
				@touch($value.$GelenVeri.'/index.html');
				$Cikti = $l['klasor_olusturuldu']; // İŞLEM BİLGİSİ
			}
			else $Cikti = $l['klasor_var']; // İŞLEM BİLGİSİ
		}
	}



	// DOSYA VE KLASÖR YENİDEN İSİMLENDİRME ALANI
	if($Durum == 'yenidenadlandir')
	{
		// YENİ VE ESKİ İSİM AYIKLANIYOR
		$eskiIsim = current(explode('|',$GelenVeri));
		$yeniIsim = @end(explode('|',$GelenVeri));
		$uzanti = @end(explode('.',$yeniIsim));

		// İSİM DEĞİŞTİRİLİYOR
		if (!@preg_match("/$uzanti/", $DosyaTurleri)) $Cikti = $l['isim_degistirilemedi'];
		elseif (@rename($IstenilenDizin.$SuankiKonum.$eskiIsim, $IstenilenDizin.$SuankiKonum.$yeniIsim))
		{
			if (@rename($IstenilenDizin.$SuankiKonum.'k/'.$eskiIsim, $IstenilenDizin.$SuankiKonum.'k/'.$yeniIsim));
			$Cikti = $l['isim_degistirildi'];
		}
		else $Cikti = $l['isim_degistirilemedi'];
	}



	// DOSYA VE KLASÖR SİLİCİ
	if($Durum == 'sil')
	{
		// VİRGÜLLER TEMİZLENİYOR
		$dizi = explode(',',substr($GelenVeri,1,-1));

		foreach($dizi as $key => $value)
		{
			$value = strip_tags($value);

			// DOSYA SİLİCİ
			if(is_file($IstenilenDizin.$SuankiKonum.$value))
			{
				if(file_exists($IstenilenDizin.$SuankiKonum.$value))
				{
					@unlink($IstenilenDizin.$SuankiKonum.$value);
					if (preg_match('/.png$/is', $value))
					{
						$kucukresim = str_replace('.png', '', $value);
						$kucukresim = 'k/'.$kucukresim.'.jpg';
					}
					else $kucukresim = 'k/'.$value;
					@unlink($IstenilenDizin.$SuankiKonum.$kucukresim);
				}
			}

			// KLASÖR SİLİCİ
			else
			{
				KlasorSil($IstenilenDizin.$SuankiKonum.$value);
			}
		}

		// İŞLEM BİLGİSİ
		$Cikti = $l['secilenler_silindi'];
	}
	return $Cikti;
}



function isimDonustur($isim)
{
	$isim = rawurldecode($isim);
	$b = array(' ',',','ş','Ş','ü','Ü','ö','Ö','ç','Ç','ğ','Ğ','ı','İ');
	$d = array('-','_','s','s','u','u','o','o','c','c','g','g','i','i');
	$isim = @str_replace ($b, $d, $isim);
	$isim = @strtolower($isim);
	$isim = @preg_replace('#[^-a-zA-Z0-9_.]#','',$isim);
	return $isim;
}



// VERİLER AYIKLANIYOR

$islem = 'veriCek';
$isim = (isset($_SERVER['HTTP_DOSYA_ADI']) ? $_SERVER['HTTP_DOSYA_ADI'] : false);

if($isim)
{
	$islem = 'dosyayukle';
	$gVeri = $isim;
	$_POST['vericek'] = (isset($_SERVER['HTTP_VERICEK']) ? rawurldecode($_SERVER['HTTP_VERICEK']) : false);
}

// KLASÖR OLUŞTURUCU
elseif(isset($_POST['klasorolustur']))
{
	$islem = 'klasorolustur';
	$gVeri = $_POST['klasorolustur'];
}
// YENİDEN ADLANDIRMA
elseif(isset($_POST['yenidenadlandir']))
{
	$islem = 'yenidenadlandir';
	$gVeri = $_POST['yenidenadlandir'];
}
// DOSYA VE KLASÖR SİLME
elseif(isset($_POST['sil']))
{
	$islem = 'sil';
	$gVeri = $_POST['sil'];
}
// VERİ ÇEKME İŞLEMİ
elseif(isset($_POST['vericek']))
{
	$islem = 'veriCek';
}




// POST İŞLEMİ VARSA
if ( (isset($islem)) AND (isset($_POST['vericek'])) )
{
	// İŞLEM LİSTELEME DEĞİLSE
	if ($islem != 'veriCek')
	{
		$Durum = $islem;
		$gVeri = strip_tags($gVeri);
		$GelenVeri = $gVeri;
	}

	$SuankiKonum = strip_tags(urldecode($_POST['vericek']));

	if (isset($_POST['dds'])) $dds = $_POST['dds'];
	else $dds = '';

	// İŞLEM YAPILIYOR
	if($islem != 'veriCek') $Cikti = IslemYap();
	else $Cikti = Konum();

	// ÇIKTI ALINIYOR
	exit($Cikti);
}
?>