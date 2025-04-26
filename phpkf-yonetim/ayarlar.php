<?php
/*
 +-=========================================================================-+
 |                                phpKF v3.00                                |
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


$phpkf_ayarlar_kip = "";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');


// Dil dosyası yükleniyor
if (@include_once('phpkf-bilesenler/diller/'.$site_dili.'/ayarlar.php'));
else include_once('phpkf-bilesenler/diller/tr/ayarlar.php');



$phpkf_tarih = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, time(), $ayarlar['tarih'],false);

$sayfa_form_ac = '<form name="ayarlar" action="phpkf-bilesenler/ayarlar_yap.php" method="post" onsubmit="return denetle()">
<input type="hidden" name="dolu" value="dolu" />
<input type="hidden" name="yo" value="'.$yo.'" />';
$etkin_yap = '';
$javascript = '';
$jsdenetle = '';



// Kategoriler CMS kurulu ise veritabanından çekiliyor
$vtsorgu = "SHOW TABLES LIKE '$tablo_kategoriler'";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

if ($vt->num_rows($vtsonuc))
{
	$vtsorgu = "SELECT * FROM $tablo_kategoriler ORDER BY id";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$sira = 0;

	while ($kategori = $vt->fetch_assoc($vtsonuc))
	{
		$kategoriler[$kategori['id']]['id'] = $kategori['id'];
		$kategoriler[$kategori['id']]['adres'] = $kategori['adres'];
		$kategoriler[$kategori['id']]['baslik'] = $kategori['baslik'];
		$kategoriler[$kategori['id']]['bilgi'] = $kategori['bilgi'];
		$sira++;
	}
}
else $kategoriler = array();




//  AYARLAR OLUŞTURULUYOR - BAŞI  //

function AyarOlustur($ayarlar_dizi)
{
	global $vt, $ayarlar, $secili_tema_cms, $secili_tema, $etkin_yap, $phpkf_tarih, $tablo_eklentiler, $l, $ly, $lya, $kategoriler, $diller;

	$ayarlar_icerik = '';

	$ara_baslik_icerik1 ='</div></div>
	<div class="kutu-baslik ara-baslik">';

	$ara_baslik_icerik2 = '</div>
	<div class="kutu-icerik">
	<div class="yonetim-form">';


	foreach ($ayarlar_dizi as $ayar_tek)
	{
		if (!is_array($ayar_tek)) continue;

		// dil verileri alınıyor
		if (isset($lya[$ayar_tek['etiket']]))
		{
			// Tema rengi
			if ($ayar_tek['etiket']=='tema_renk_cms'){
				if ($secili_tema_cms == 'varsayilan') $secenek = 'mavi:'.$ly['sablon_ayarli'];
				else $secenek = 'mavi:'.$ly['tek_renk'];

				if (@include_once('../phpkf-bilesenler/temalar/'.$secili_tema_cms.'/tema_ozellik.php')){
					if ((isset($t_renkler))AND(is_array($t_renkler))){$secenek=''; foreach($t_renkler as $renk1=>$renk2){if($secenek!='')$secenek.='|'; $secenek.=$renk2.':'.$renk1;}}
					unset($t_renkler);
				}
			}
			elseif ($ayar_tek['etiket']=='tema_renk'){
				$secenek = 'mavi:'.$ly['tek_renk'];
				if (@include_once('../temalar/'.$secili_tema.'/tema.php')){
					if ((isset($t_renkler))AND(is_array($t_renkler))){$secenek=''; foreach($t_renkler as $renk1=>$renk2){if($secenek!='')$secenek.='|'; $secenek.=$renk2.':'.$renk1;}}
					unset($t_renkler);
				}
			}

			// Düzenleyici
			elseif (($ayar_tek['etiket']=='duzenleyici')OR($ayar_tek['etiket']=='gduzenleyici')OR($ayar_tek['etiket']=='vduzenleyici')OR($ayar_tek['etiket']=='bduzenleyici')OR($ayar_tek['etiket']=='yduzenleyici')
				OR($ayar_tek['etiket']=='duzenleyici_html_tema')OR($ayar_tek['etiket']=='duzenleyici_bbcode_tema')OR($ayar_tek['etiket']=='duzenleyici_hizli_tema'))
				$secenek = $ayar_tek['secenek'];

			// Diğer
			else $secenek = $lya[$ayar_tek['etiket']]['secenek'];
			$baslik = $lya[$ayar_tek['etiket']]['baslik'];
			$bilgi = $lya[$ayar_tek['etiket']]['bilgi'];
			$aciklama = $lya[$ayar_tek['etiket']]['aciklama'];
		}

		// dil verisi yoksa, özel ayar ise veritabanından alınıyor
		else
		{
			$secenek = $ayar_tek['secenek'];
			$baslik = $ayar_tek['baslik'];
			$bilgi = $ayar_tek['bilgi'];
			$aciklama = $ayar_tek['aciklama'];
		}


		// Dakika ve bayt değerleri
		if ($ayar_tek['etiket'] == 'tarih_bicimi') $aciklama = str_replace('{phpkf_tarih}', $phpkf_tarih, $aciklama);
		elseif ($ayar_tek['etiket'] == 'smtp_sifre'){if ($ayar_tek['deger'] != '') $ayar_tek['deger'] = 'sifre_degismedi';}
		elseif ($ayar_tek['etiket'] == 'uye_cevrimici_sure') $ayar_tek['deger'] = ($ayar_tek['deger']/60);
		elseif ($ayar_tek['etiket'] == 'uye_kilit_sure') $ayar_tek['deger'] = ($ayar_tek['deger']/60);
		elseif ($ayar_tek['etiket'] == 'k_cerez_zaman') $ayar_tek['deger'] = ($ayar_tek['deger']/60);
		elseif ($ayar_tek['etiket'] == 'uye_resim_boyut') $ayar_tek['deger'] = ($ayar_tek['deger']/1024);
		elseif ($ayar_tek['etiket'] == 'yukleme_boyut') $ayar_tek['deger'] = ($ayar_tek['deger']/1024);


		// Ara başlık oluşturuluyor
		if ($ayar_tek['sira'] == 1)
		{
			if ($ayar_tek['kat'] == 2) $ayarlar_icerik .= $ara_baslik_icerik1.$lya['site_basliklari'].'<a name="site_baslik"></a>'.$ara_baslik_icerik2;
			elseif ($ayar_tek['kat'] == 3) $ayarlar_icerik .= $ara_baslik_icerik1.$lya['sayfalama_ayarlari'].'<a name="sayfalama"></a>'.$ara_baslik_icerik2;
			elseif ($ayar_tek['kat'] == 7) $ayarlar_icerik .= $ara_baslik_icerik1.$lya['kayit_ayarlari'].'<a name="kayit"></a>'.$ara_baslik_icerik2;
			elseif ($ayar_tek['kat'] == 8) $ayarlar_icerik .= $ara_baslik_icerik1.$lya['resim_ayarlari'].'<a name="resim"></a>'.$ara_baslik_icerik2;
			elseif ($ayar_tek['kat'] == 10) $ayarlar_icerik .= $ara_baslik_icerik1.$lya['smtp_ayarlari'].'<a name="smtp"></a>'.$ara_baslik_icerik2;

			// Eklenti ve tema için, özel ayar kategorileri
			else
			{
				// Eklenti bilgileri veritabanından çekiliyor
				$vtsorgu = "SELECT baslik FROM $tablo_eklentiler WHERE ayar_kat='$ayar_tek[kat]' LIMIT 1";
				$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
				$ekl_satir = $vt->fetch_assoc($vtsonuc);

				if (isset($ekl_satir['baslik'])) $ayarlar_icerik .= $ara_baslik_icerik1.$ekl_satir['baslik'].'<a name="'.$ayar_tek['etiket'].'"></a>'.$ara_baslik_icerik2;
			}
		}


		if ($ayar_tek['bos'] == '0') $yildiz = ' *'; else $yildiz = '';
		$ayarlar_icerik .= '<a name="'.$ayar_tek['etiket'].'"></a><div class="form-div"><label class="yonetim-label">'.$baslik.$yildiz.'</label><div>';


		// text ve password için
		if ( ($ayar_tek['form_tip'] == 'text') OR ($ayar_tek['form_tip'] == 'password') )
		$ayarlar_icerik .= "\r\n".'<input class="input-alani" name="'.$ayar_tek['etiket'].'" type="'.$ayar_tek['form_tip'].'" value="'.$ayar_tek['deger'].'" placeholder="'.$bilgi.'" '.$ayar_tek['diger'].' />'."\r\n";


		// textarea için
		elseif ($ayar_tek['form_tip'] == 'textarea')
		{
			$ayarlar_icerik .= "\r\n".'<textarea class="textarea" spellcheck="false" name="'.$ayar_tek['etiket'].'" placeholder="'.$bilgi.'" '.$ayar_tek['diger'].' cols="30">'.$ayar_tek['deger'].'</textarea>'."\r\n";
		}


		// seçimli formlar
		elseif ( ($ayar_tek['form_tip'] == 'radio') OR ($ayar_tek['form_tip'] == 'select') OR ($ayar_tek['form_tip'] == 'checkbox') )
		{
			$secenek_dizi = explode('|', $secenek);

			if ($ayar_tek['form_tip'] == 'select') $select = "\r\n".'<select name="'.$ayar_tek['etiket'].'" '.$ayar_tek['diger'].$bilgi.' class="input-select" style="width:auto">';

			$i = 0;
			foreach ($secenek_dizi as $secenek_tek)
			{
				$secenek = explode(':', $secenek_tek);

				if ($secenek[0] == '') continue;

				// radio için
				if ($ayar_tek['form_tip'] == 'radio')
				{
					if ($ayarlar[$ayar_tek['etiket']] == $secenek[0]){
						$isaretle = ' checked="checked"';
						if ($ayar_tek['etiket'] == 'durum_anasayfa') $etkin_yap = 'EtkinYap('.$secenek[0].');';}

					else $isaretle = '';

					$ayarlar_icerik .= "\r\n".'<label style="cursor:pointer"><input type="radio" name="'.$ayar_tek['etiket'].'" value="'.$secenek[0].'" '.$ayar_tek['diger'].$isaretle.' />'.$secenek[1].'</label> &nbsp; ';

					if ($ayar_tek['etiket'] == 'seo') $ayarlar_icerik .= '<br>';
				}

				// select için
				elseif ($ayar_tek['form_tip'] == 'select')
				{
					if ($ayarlar[$ayar_tek['etiket']] == $secenek[0]) $isaretle = ' selected="selected"';
					else $isaretle = '';

					if ($secenek[1] == '{KATEGORILER}')
					{
						foreach ($kategoriler as $kategori)
						{
							if ($ayarlar[$ayar_tek['etiket']] == $kategori['id']) $isaretle = ' selected="selected"';
							else $isaretle = '';
							$select .= "\r\n".'<option value="'.$kategori['id'].'" '.$isaretle.'>'.$kategori['baslik'].'</option>';
						}
					}

					elseif ($secenek[1] == '{DILLER}')
					{
						$dil_eklenen = explode(',', $ayarlar['dil_eklenen']);
						foreach ($diller as $anahtar => $dil)
						{
							if ($ayar_tek['deger'] == $anahtar) $isaretle = ' selected="selected"';
							else $isaretle = '';
							$select .= "\r\n".'<option value="'.$anahtar.'" '.$isaretle.'>'.$diller[$anahtar].'</option>';
						}
					}

					else $select .= "\r\n".'<option value="'.$secenek[0].'" '.$isaretle.'>'.$secenek[1].'</option>';
				}

				// checkbox için
				elseif ($ayar_tek['form_tip'] == 'checkbox')
				{
					if ($ayarlar[$ayar_tek['etiket']] == $secenek[0]) $isaretle = ' checked="checked"';
					else $isaretle = '';

					$ayarlar_icerik .= "\r\n".'<label style="cursor:pointer"><input type="checkbox" name="'.$ayar_tek['etiket'].'" value="'.$secenek[0].'" '.$ayar_tek['diger'].$isaretle.' />'.$secenek[1].'</label> &nbsp; ';
				}
				$i++;
			}

			if ($ayar_tek['form_tip'] == 'select') $ayarlar_icerik .= $select."\r\n".'</select>'."\r\n";

		}

		else $ayarlar_icerik .= '<font color="#ff0000"><b>Hatalı input tipi !</b></font>';

		$ayarlar_icerik .= '<small>'.$aciklama.'</small></div></div>'."\r\n\r\n";
	}

	return($ayarlar_icerik);
}

//  AYARLAR OLUŞTURULUYOR - SONU  //






//    KİPE GÖRE SAYFA GÖSTERİMİ  -  BAŞI   //
//    KİPE GÖRE SAYFA GÖSTERİMİ  -  BAŞI   //
//    KİPE GÖRE SAYFA GÖSTERİMİ  -  BAŞI   //



if ( (isset($_GET['kip'])) AND ($_GET['kip'] !='') )
{

//  ENTEGRASYON AYARLARI - BAŞI  //

if ($_GET['kip'] =='entegrasyon')
{
	$sayfa_adi = $lya['entegrasyon_ayarlari'];
	$tema_sayfa_baslik = $lya['entegrasyon_ayarlari'];
	$sayfa_form_ac .= '<input type="hidden" name="kip" value="entegrasyon" />';


	// Entegrasyon ayarları veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_ayarlar WHERE kat='19' ORDER BY kat,sira";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($ayarlar_tek = $vt->fetch_assoc($vtsonuc))
	{
		if ($ayarlar_tek['bos'] == '1') $jsdenetle .= '&&(alan.name!="'.$ayarlar_tek['etiket'].'")';
		$ayarlar_dizi[] = $ayarlar_tek;
	}

	$ayarlar_icerik = AyarOlustur($ayarlar_dizi);
}

//  ENTEGRASYON AYARLARI - SONU  //




//  FORUM AYARLARI - BAŞI  //

elseif ($_GET['kip'] =='forum')
{
	$sayfa_adi = $lya['forum_ayarlari'];
	$tema_sayfa_baslik = $lya['forum_ayarlari'];
	$sayfa_form_ac .= '<input type="hidden" name="kip" value="forum" />';


	// Forum ayarları veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_ayarlar WHERE kat='16' ORDER BY kat,sira";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($ayarlar_tek = $vt->fetch_assoc($vtsonuc))
	{
		if ($ayarlar_tek['bos'] == '1') $jsdenetle .= '&&(alan.name!="'.$ayarlar_tek['etiket'].'")';
		$ayarlar_dizi[] = $ayarlar_tek;
	}

	$ayarlar_icerik = AyarOlustur($ayarlar_dizi);
}

//  FORUM AYARLARI - SONU  //




//  SEO AYARLARI - BAŞI  //

elseif ($_GET['kip'] =='seo')
{
	$sayfa_adi = $lya['seo_ayarlari'];
	$tema_sayfa_baslik = $lya['seo_ayarlari'];
	$sayfa_form_ac .= '<input type="hidden" name="kip" value="seo" />';


	// SEO ayarları veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_ayarlar WHERE kat='4' ORDER BY kat,sira";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($ayarlar_tek = $vt->fetch_assoc($vtsonuc))
	{
		if ($ayarlar_tek['bos'] == '1') $jsdenetle .= '&&(alan.name!="'.$ayarlar_tek['etiket'].'")';
		$ayarlar_dizi[] = $ayarlar_tek;
	}

	$ayarlar_icerik = AyarOlustur($ayarlar_dizi);
}

//  SEO AYARLARI - SONU  //




//  TARİH AYARLARI - BAŞI  //

elseif ($_GET['kip'] =='tarih')
{
	$sayfa_adi = $lya['tarih_ayarlari'];
	$tema_sayfa_baslik = $lya['tarih_ayarlari'];
	$sayfa_form_ac .= '<input type="hidden" name="kip" value="tarih" />';


	// Tarih ayarları veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_ayarlar WHERE kat='5' ORDER BY kat,sira";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($ayarlar_tek = $vt->fetch_assoc($vtsonuc))
	{
		if ($ayarlar_tek['bos'] == '1') $jsdenetle .= '&&(alan.name!="'.$ayarlar_tek['etiket'].'")';
		$ayarlar_dizi[] = $ayarlar_tek;
	}

	$ayarlar_icerik = AyarOlustur($ayarlar_dizi);
}

//  TARİH AYARLARI - SONU  //




//  ÜYELİK AYARLARI - BAŞI  //

elseif ($_GET['kip'] =='uyelik')
{
	$sayfa_adi = $lya['uyelik_ayarlari'];
	$tema_sayfa_baslik = $lya['uyelik_ayarlari'];
	$sayfa_form_ac .= '<input type="hidden" name="kip" value="uyelik" />';


	// Üyelik ayarları veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_ayarlar WHERE kat='6' OR kat='7' OR kat='8' OR kat='17' ORDER BY kat=8,kat=17,kat=7,kat=6,sira";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($ayarlar_tek = $vt->fetch_assoc($vtsonuc))
	{
		if ($ayarlar_tek['bos'] == '1') $jsdenetle .= '&&(alan.name!="'.$ayarlar_tek['etiket'].'")';
		$ayarlar_dizi[] = $ayarlar_tek;
	}

	$ayarlar_icerik = AyarOlustur($ayarlar_dizi);
}

//  ÜYELİK AYARLARI - SONU  //





//  E-POSTA AYARLARI - BAŞI  //

elseif ($_GET['kip'] =='eposta')
{
	$sayfa_adi = $lya['eposta_ayarlari'];
	$tema_sayfa_baslik = $lya['eposta_ayarlari'];
	$sayfa_form_ac .= '<input type="hidden" name="kip" value="eposta" />';


	// E-Posta ayarları veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_ayarlar WHERE kat='9' OR kat='10' ORDER BY kat,sira";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($ayarlar_tek = $vt->fetch_assoc($vtsonuc))
	{
		if ($ayarlar_tek['bos'] == '1') $jsdenetle .= '&&(alan.name!="'.$ayarlar_tek['etiket'].'")';
		$ayarlar_dizi[] = $ayarlar_tek;
	}

	$ayarlar_icerik = AyarOlustur($ayarlar_dizi);
}

//  E-POSTA AYARLARI - SONU  //




//  ÖZEL İLETİ AYARLARI - BAŞI  //

elseif ($_GET['kip'] =='ozel_ileti')
{
	$sayfa_adi = $lya['ozel_ileti_ayarlari'];
	$tema_sayfa_baslik = $lya['ozel_ileti_ayarlari'];
	$sayfa_form_ac .= '<input type="hidden" name="kip" value="ozel_ileti" />';


	// Forum ayarları veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_ayarlar WHERE kat='18' ORDER BY kat,sira";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($ayarlar_tek = $vt->fetch_assoc($vtsonuc))
	{
		if ($ayarlar_tek['bos'] == '1') $jsdenetle .= '&&(alan.name!="'.$ayarlar_tek['etiket'].'")';
		$ayarlar_dizi[] = $ayarlar_tek;
	}

	$ayarlar_icerik = AyarOlustur($ayarlar_dizi);
}

//  ÖZEL İLETİ AYARLARI - SONU  //




//  DÜZENLEYİCİ AYARLARI - BAŞI  //

elseif ($_GET['kip'] =='duzenleyici')
{
	$sayfa_adi = $lya['duzenleyici_ayarlari'];
	$tema_sayfa_baslik = $lya['duzenleyici_ayarlari'];
	$sayfa_form_ac .= '<input type="hidden" name="kip" value="duzenleyici" />';


	// Düzenleyici ayarları veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_ayarlar WHERE kat='11' ORDER BY sira";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($ayarlar_tek = $vt->fetch_assoc($vtsonuc))
	{
		if ($ayarlar_tek['bos'] == '1') $jsdenetle .= '&&(alan.name!="'.$ayarlar_tek['etiket'].'")';
		$ayarlar_dizi[] = $ayarlar_tek;
	}

	$ayarlar_icerik = AyarOlustur($ayarlar_dizi);
}

//  DÜZENLEYİCİ AYARLARI - SONU  //




//  TinMCE DÜZENLEYİCİ AYARLARI - BAŞI  //

elseif ($_GET['kip'] =='tinymce')
{
	$sayfa_adi = $lya['tinymce_duzenleyici_ayarlari'];
	$tema_sayfa_baslik = $lya['tinymce_duzenleyici_ayarlari'];
	$sayfa_form_ac .= '<input type="hidden" name="kip" value="tinymce" />';


	// Düzenleyici ayarları veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_ayarlar WHERE kat='12' ORDER BY sira";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($ayarlar_tek = $vt->fetch_assoc($vtsonuc))
	{
		if ($ayarlar_tek['bos'] == '1') $jsdenetle .= '&&(alan.name!="'.$ayarlar_tek['etiket'].'")';
		$ayarlar_dizi[] = $ayarlar_tek;
	}

	$ayarlar_icerik = AyarOlustur($ayarlar_dizi);
}

//  TinMCE DÜZENLEYİCİ AYARLARI - SONU  //




//  phpKF DÜZENLEYİCİ AYARLARI - BAŞI  //

elseif ($_GET['kip'] =='phpkf')
{
	$sayfa_adi = $lya['phpkf_duzenleyici_ayarlari'];
	$tema_sayfa_baslik = $lya['phpkf_duzenleyici_ayarlari'];
	$sayfa_form_ac .= '<input type="hidden" name="kip" value="phpkf" />';


	// Düzenleyici ayarları veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_ayarlar WHERE kat='15' ORDER BY sira";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($ayarlar_tek = $vt->fetch_assoc($vtsonuc))
	{
		if ($ayarlar_tek['bos'] == '1') $jsdenetle .= '&&(alan.name!="'.$ayarlar_tek['etiket'].'")';
		$ayarlar_dizi[] = $ayarlar_tek;
	}

	$ayarlar_icerik = AyarOlustur($ayarlar_dizi);
}

//  phpKF DÜZENLEYİCİ AYARLARI - SONU  //




//  YÜKLEME AYARLARI - BAŞI  //

elseif ($_GET['kip'] =='yukleme')
{
	$sayfa_adi = $lya['yukleme_ayarlari'];
	$tema_sayfa_baslik = $lya['yukleme_ayarlari'];
	$sayfa_form_ac .= '<input type="hidden" name="kip" value="yukleme" />';


	// Düzenleyici ayarları veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_ayarlar WHERE kat='14' ORDER BY sira";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($ayarlar_tek = $vt->fetch_assoc($vtsonuc))
	{
		if ($ayarlar_tek['bos'] == '1') $jsdenetle .= '&&(alan.name!="'.$ayarlar_tek['etiket'].'")';
		$ayarlar_dizi[] = $ayarlar_tek;
	}

	$ayarlar_icerik = AyarOlustur($ayarlar_dizi);
}

//  YÜKLEME AYARLARI - SONU  //




//  EKLENTİ AYARLARI - BAŞI  //

elseif ($_GET['kip'] =='eklenti')
{
	$sayfa_adi = $lya['kurulu_eklentilerin_ayarlari'];
	$tema_sayfa_baslik = $lya['kurulu_eklentilerin_ayarlari'];
	$sayfa_form_ac .= '<input type="hidden" name="kip" value="eklenti" />';
	$ayarlar_icerik = '';


	// Eklenti ayarları veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_ayarlar WHERE tip='eklenti' AND kat>=100 ORDER BY kat,sira";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($ayarlar_tek = $vt->fetch_assoc($vtsonuc))
	{
		if ($ayarlar_tek['bos'] == '1') $jsdenetle .= '&&(alan.name!="'.$ayarlar_tek['etiket'].'")';
		$ayarlar_dizi[] = $ayarlar_tek;
	}

	if (isset($ayarlar_dizi)) $ayarlar_icerik = AyarOlustur($ayarlar_dizi);


	if ($ayarlar_icerik != '')
	{
		$ayarlar_icerik = '<div class="form-div" style="text-align:center">'.$lya['eklenti_ayar_bilgi'].'</div>'.$ayarlar_icerik;
	}
}

//  EKLENTİ AYARLARI - SONU  //




//  TEMA AYARLARI - BAŞI  //

elseif ($_GET['kip'] =='tema')
{
	$sayfa_adi = $lya['tema_ayarlari'];
	$tema_sayfa_baslik = $lya['tema_ayarlari'];
	$sayfa_form_ac .= '<input type="hidden" name="kip" value="tema" />';
	$tema_icerik = '';

	$ayarlar_icerik = '<div class="form-div" style="text-align:center">'.$lya['tema_ayar_bilgi'];

	//if ((isset($_GET['sistem'])) AND ($_GET['sistem'] == 'forum')) $eksorgu = "AND etiket!='tema_renk_cms'";
	//else $eksorgu = "AND etiket!='tema_renk'";


	// Tema ayarları veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_ayarlar WHERE tip='tema' ORDER BY sira";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($ayarlar_tek = $vt->fetch_assoc($vtsonuc))
	{
		if ($ayarlar_tek['bos'] == '1') $jsdenetle .= '&&(alan.name!="'.$ayarlar_tek['etiket'].'")';
		$ayarlar_dizi[] = $ayarlar_tek;
	}

	if (isset($ayarlar_dizi)) $tema_icerik = AyarOlustur($ayarlar_dizi);


	if ($tema_icerik == '')
	{
		$ayarlar_icerik .= '<br><br>'.$lya['tema_ayar_yok'].'</div>';
	}
	else $ayarlar_icerik .= '</div>'.$tema_icerik;
}

//  TEMA AYARLARI - SONU  //




// hatalı kip için genel ayarlara yönlendir
else
{
	header('Location: ayarlar.php');
	exit();
}


} // kip sonu


//    KİPE GÖRE SAYFA GÖSTERİMİ  -  SONU   //
//    KİPE GÖRE SAYFA GÖSTERİMİ  -  SONU   //
//    KİPE GÖRE SAYFA GÖSTERİMİ  -  SONU   //






//  GENEL AYARLAR - BAŞI  //

else
{
	$sayfa_adi = $lya['genel_ayarlar'];
	$tema_sayfa_baslik = $lya['genel_ayarlar'];
	$sayfa_form_ac .= '<input type="hidden" name="kip" value="genel" />';


	// Genel ayarlar veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_ayarlar WHERE kat='1' OR kat='2' OR kat='3' ORDER BY kat,sira";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($ayarlar_tek = $vt->fetch_assoc($vtsonuc))
	{
		if ($ayarlar_tek['bos'] == '1') $jsdenetle .= '&&(alan.name!="'.$ayarlar_tek['etiket'].'")';
		$ayarlar_dizi[] = $ayarlar_tek;
	}

	$ayarlar_icerik = AyarOlustur($ayarlar_dizi);


	$javascript = 'function EtkinYap(durum){
		var durum;
		var dosya;
		if (durum=="1"){
			document.ayarlar.anasyfdosya.disabled="";
			if (document.ayarlar.anasyfdosya.value=="") document.ayarlar.anasyfdosya.placeholder="'.$ly['dosya_adi_giriniz'].'";}
		else{
			document.ayarlar.anasyfdosya.disabled = "disabled";
			if (document.ayarlar.anasyfdosya.value=="") document.ayarlar.anasyfdosya.placeholder="'.$ly['kapali'].'";}
	}';
}

//  GENEL AYARLAR - SONU  //








// Eklenti ayarı yoksa
if ($ayarlar_icerik == '')
{
if ( (isset($_GET['kip'])) AND ($_GET['kip'] =='eklenti') )
	$yok_iletisi = $lya['eklenti_ayar_bilgi'].'<br><br><br>'.$lya['eklenti_ayar_yok'];
else $yok_iletisi = '';

$tema_sayfa_icerik = '<div class="yonetim-form">
<div class="form-div" style="text-align:center">'.$yok_iletisi.'</div>
</div>';
}


//  GÖNDER BUTONU  //
else
{
$tema_sayfa_icerik = '<div class="yonetim-form">
'.$ayarlar_icerik.'
<script type="text/javascript"><!-- //
function denetle(){
var dogruMu = true;
for (var i=0; i<document.ayarlar.elements.length; i++){
var alan = document.ayarlar.elements[i];
if ((alan.name!="uygula")'.$jsdenetle.'&&(alan.value=="")) dogruMu = false;}
if (!dogruMu) alert(jsl["isaretli_alanlar_zorunludur"]);
return dogruMu;}
'.$javascript.'
'.$etkin_yap.'
// -->
</script>
<div class="form-div" style="text-align:center">
<button type="submit" name="uygula" class="dugme dugme-mavi">'.$lya['ayar_kaydet'].'</button>
</div>
</div>';
}


$sayfa_form_kapat = '</form>';



// tema dosyası yükleniyor
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>