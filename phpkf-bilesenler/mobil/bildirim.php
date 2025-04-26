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


$sayfa_adi = 'phpKF Mobil Android Servis';
$user_agent = $_SERVER['HTTP_USER_AGENT'];


if (@preg_match('/phpKF\ Android\ Uygulamasi/', $user_agent)) $sayfa_numara = '44,0';
elseif (@preg_match('/Firefox\//', $user_agent)) $sayfa_numara = '44,1';
elseif (@preg_match('/Chrome\//', $user_agent)) $sayfa_numara = '44,2';
else $sayfa_numara = '44,0';



if ( (isset($_SERVER['REQUEST_URI'])) AND ($_SERVER['REQUEST_URI'] != '') )
{
	if ( (preg_match("/\/phpkf-bilesenler\//i", $_SERVER['REQUEST_URI'])) OR
		(preg_match("/\/mobil\//i", $_SERVER['REQUEST_URI'])) )
	{
		$kaltdizin = '../../';
		$altdizin = '../';
	}
	else{
		$kaltdizin = '../';
		$altdizin = '';
	}
}
else{
	$kaltdizin = '../';
	$altdizin = '';
}


include_once($kaltdizin.'phpkf-ayar.php');
include_once($altdizin.'gerecler.php');


$tarih = time();
$guncel_saat = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $tarih, $ayarlar['tarih'], false);


// kip verisi alınıyor
if (isset($_GET['kip'])) 
{
	$_GET['kip'] = @str_replace(array('-','x','.'), '', $_GET['kip']);
	if (is_numeric($_GET['kip'])) $kip = $_GET['kip'];
	else $kip = 0;
	if (($kip==0) OR ($kip==1) OR ($kip==2) OR ($kip==3));
	else $kip = 0;
}
else $kip = 0;



// Üye giriş denetimi
if (isset($_GET['denetim']))
{
	if ($_GET['denetim'] == '2') exit();
	else
	{
		if ( (isset($_COOKIE['kullanici_kimlik'])) AND ($_COOKIE['kullanici_kimlik'] != '') )
		{
			$_COOKIE['kullanici_kimlik'] = @zkTemizle($_COOKIE['kullanici_kimlik']);

			$vtsorgu = "SELECT id,kullanici_kimlik,son_hareket,kul_ip FROM $tablo_kullanicilar
					WHERE kullanici_kimlik='$_COOKIE[kullanici_kimlik]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
			$satir = $vt->fetch_assoc($vtsonuc);

			if (!$vt->num_rows($vtsonuc))
			{
				setcookie('kullanici_kimlik', '', 0, $cerez_dizin, $cerez_alanadi);
				setcookie('yonetim_kimlik', '', 0, $cerez_dizin, $cerez_alanadi);
				setcookie('kfk_okundu', '', 0, $cerez_dizin, $cerez_alanadi);
			}

			else setcookie('kullanici_kimlik', $satir['kullanici_kimlik'], time() +$ayarlar['k_cerez_zaman'], $cerez_dizin, $cerez_alanadi);
		}

		else setcookie('kullanici_kimlik', '', 0, $cerez_dizin, $cerez_alanadi);
		exit();
	}
}



include_once($altdizin.'kullanici_kimlik.php');
include_once($altdizin.'oturum.php');
header("Content-type: text/xml; charset=UTF-8");
$sayfa_cikis = '';
$bilsayi = 0;



// üye ise zaman değeri: son hareket
if (isset($kullanici_kim['id'])) $zaman = $kullanici_kim['son_hareket'];

// misafir ise zaman değeri: bir önceki ziyaret, değilse sıfır
else
{
	if ( (isset($_GET['zaman'])) AND ($_GET['zaman'] != '') AND ($_GET['zaman'] != '0') AND (is_numeric($_GET['zaman'])) )
	$zaman = $_GET['zaman'];
	else $zaman = 0;
}


$bul = array('<b>', ',</b>');
$cevir = array('', '');

$bul2 = array('&amp;', '&lt;', '&gt;', '&#34;');
$cevir2 = array('&', '<', '>', '"');


// Boş Bildirim XML
$bosbildirim = '<BILDIRIM>
<BASLIK> </BASLIK>
<KONU> </KONU>
<ADRES><![CDATA['.$TEMA_SITE_ANADIZIN.$phpkf_dosyalar['mobil'].']]></ADRES>
<ZAMAN>'.$tarih.'</ZAMAN>
<TARIH>'.$guncel_saat.'</TARIH>
<YAZAN> </YAZAN>
<UYARI>0</UYARI>
</BILDIRIM>';

// Takip uyarı bildirim, bölüm seçilmemiş
$takipuyari1 = '<BILDIRIM>
<BASLIK>Takip Uyarı</BASLIK>
<KONU>Takip için seçim yapılmalıdır</KONU>
<ADRES><![CDATA['.$TEMA_SITE_ANADIZIN.$phpkf_dosyalar['profil_degistir'].'?kosul=takip]]></ADRES>
<ZAMAN>'.$tarih.'</ZAMAN>
<TARIH>'.$guncel_saat.'</TARIH>
<YAZAN>'.$ayarlar['alanadi'].'</YAZAN>
<UYARI>1</UYARI>
</BILDIRIM>';

// Takip Uyarı bildirim, giriş yapılmamış
$takipuyari2 = '<BILDIRIM>
<BASLIK>Takip Uyarı</BASLIK>
<KONU>Takip için üye girişi yapılmalıdır</KONU>
<ADRES><![CDATA['.$TEMA_SITE_ANADIZIN.$phpkf_dosyalar['mobil'].']]></ADRES>
<ZAMAN>'.$tarih.'</ZAMAN>
<TARIH>'.$guncel_saat.'</TARIH>
<YAZAN>'.$ayarlar['alanadi'].'</YAZAN>
<UYARI>1</UYARI>
</BILDIRIM>';




//  YENİ İLETİLERE BAKILIYOR    //
//  YENİ İLETİLERE BAKILIYOR    //
//  YENİ İLETİLERE BAKILIYOR    //


// Servisin her çalışması
if ($zaman != 0)
{
	// CMS yeni yazılar alınıyor
	$sorgu = "SELECT id,tip,yayin_tarihi,yazan,baslik FROM $tablo_yazilar WHERE yayin_tarihi > '$zaman' ORDER BY yayin_tarihi DESC LIMIT 10";
	$yazi_sonuc = $vt->query($sorgu) or die();

	while ($yazi_satir = $vt->fetch_assoc($yazi_sonuc))
	{
		$bilsayi++;
		$bildirim_tarihi = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $yazi_satir['yayin_tarihi'], $ayarlar['tarih'], true);
		$bildirim_tarihi = @str_replace($bul, $cevir, $bildirim_tarihi);

		$yazan_adi = explode(';', $yazi_satir['yazan']);
		if ($ayarlar['yazan_adi'] != 1) $yazi_satir['yazan'] = $yazan_adi[0];
		else{
			if (isset($yazan_adi[1])) $yazi_satir['yazan'] = $yazan_adi[1];
			else $yazi_satir['yazan'] = $yazan_adi[0];
		}

		if ($yazi_satir['tip'] == 4) {$bilkonu[0] = 'galeri'; $bilkonu[1] = 'Galeri';}
		elseif ($yazi_satir['tip'] == 5) {$bilkonu[0] = 'video'; $bilkonu[1] = 'Video';}
		else {$bilkonu[0] = 'yazı'; $bilkonu[1] = 'Yazı';}

		// Bildirim XML
		$sayfa_cikis .= '<BILDIRIM>
		<BASLIK><![CDATA[Yeni bir '.$bilkonu[0].' var]]></BASLIK>
		<KONU><![CDATA['.$bilkonu[1].': '.$yazi_satir['baslik'].']]></KONU>
		<ADRES><![CDATA['.$TEMA_SITE_ANADIZIN.$phpkf_dosyalar['cms'].'?y='.$yazi_satir['id'].']]></ADRES>
		<ZAMAN>'.$tarih.'</ZAMAN>
		<TARIH><![CDATA['.$bildirim_tarihi.']]></TARIH>
		<YAZAN><![CDATA['.$yazi_satir['yazan'].']]></YAZAN>
		<UYARI>1</UYARI>
		</BILDIRIM>';
	}



	// CMS yeni yorumlar alınıyor
	$sorgu = "SELECT id,tarih,yazan,yazi_id,baslik FROM $tablo_yorumlar WHERE onay='1' AND tarih > '$zaman' ORDER BY tarih DESC LIMIT 10";
	$yorum_sonuc = $vt->query($sorgu) or die();

	while ($yorum_satir = $vt->fetch_assoc($yorum_sonuc))
	{
		$bilsayi++;
		$bildirim_tarihi = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $yorum_satir['tarih'], $ayarlar['tarih'], true);
		$bildirim_tarihi = @str_replace($bul, $cevir, $bildirim_tarihi);

		// Yazı başlığı alınıyor
		$sorgu1 = "SELECT id,baslik FROM $tablo_yazilar WHERE id='$yorum_satir[yazi_id]' ORDER BY tarih DESC LIMIT 1";
		$yazi_sonuc = $vt->query($sorgu1) or die();
		$yazi_satir = $vt->fetch_assoc($yazi_sonuc);

		$yazan_adi = explode(';', $yorum_satir['yazan']);
		if ($ayarlar['yazan_adi'] != 1) $yorum_satir['yazan'] = $yazan_adi[0];
		else{
			if (isset($yazan_adi[1])) $yorum_satir['yazan'] = $yazan_adi[1];
			else $yorum_satir['yazan'] = $yazan_adi[0];
		}

		// Bildirim XML
		$sayfa_cikis .= '<BILDIRIM>
		<BASLIK><![CDATA[Yeni bir yorum var]]></BASLIK>
		<KONU><![CDATA[Yorum: '.$yazi_satir['baslik'].']]></KONU>
		<ADRES><![CDATA['.$TEMA_SITE_ANADIZIN.$phpkf_dosyalar['cms'].'?y='.$yazi_satir['id'].']]></ADRES>
		<ZAMAN>'.$tarih.'</ZAMAN>
		<TARIH><![CDATA['.$bildirim_tarihi.']]></TARIH>
		<YAZAN><![CDATA['.$yorum_satir['yazan'].']]></YAZAN>
		<UYARI>1</UYARI>
		</BILDIRIM>';
	}



	// Forum kullanılıyorsa - başı
	if ($ayarlar['forum_kullan'])
	{
		// Her şey veya takip edilenler seçiliyse, yeni iletilere bakılıyor
		if ( ($kip == 0) OR ($kip == 2) )
		{
			// TAKİP EDİLENLER SEÇİLİYSE
			if ($kip == 2)
			{
				if (isset($kullanici_kim['id']))
				{
					$vtsorgu = "SELECT id,takip FROM $tablo_kullanicilar WHERE id='$kullanici_kim[id]' LIMIT 1";
					$takip_sonuc = $vt->query($vtsorgu) or die();
					$takip_veri = $vt->fetch_assoc($takip_sonuc);

					if ($takip_veri['takip'] != '')
					{
						$takip_dizi = explode(";", $takip_veri['takip']);
						$takip_eksorgu = '';

						foreach ($takip_dizi as $takip_tek)
						{
							if (preg_match('/^f-/i', $takip_tek))
								$takip_eksorgu .= " silinmis='0' AND hangi_forumdan='".substr($takip_tek,2)."' AND son_mesaj_tarihi > '$zaman' OR";
						}
						$takip_eksorgu = substr($takip_eksorgu, 0, -2);


						$sorgu = $vt->query("SELECT id FROM $tablo_mesajlar WHERE $takip_eksorgu") or die();
						$sorgu1 = "SELECT id,yazan,mesaj_baslik,son_mesaj_tarihi,cevap_sayi,son_cevap,son_cevap_yazan
						FROM $tablo_mesajlar WHERE $takip_eksorgu ORDER BY son_mesaj_tarihi DESC LIMIT 10";

						$konu_sayi = $vt->num_rows($sorgu);
						$m_arama_sonuc = $vt->query($sorgu1) or die();
					}

					// takip için bölüm seçilmemiş, uyarı veriliyor
					else
					{
						$konu_sayi = 0;
						$sayfa_cikis .= $takipuyari1;
					}
				}


				// üye girişi yapılmamış, uyarı veriliyor
				else
				{
					$konu_sayi = 0;
					$sayfa_cikis .= $takipuyari2;
				}
			}



			// HER ŞEY SEÇİLİYSE
			else
			{
				$sorgu = $vt->query("SELECT id FROM $tablo_mesajlar WHERE silinmis='0' AND son_mesaj_tarihi > '$zaman'") or die();
				$sorgu1 = "SELECT id,yazan,mesaj_baslik,son_mesaj_tarihi,cevap_sayi,son_cevap,son_cevap_yazan
				FROM $tablo_mesajlar WHERE silinmis='0' AND son_mesaj_tarihi > '$zaman'
				ORDER BY son_mesaj_tarihi DESC LIMIT 10";

				$konu_sayi = $vt->num_rows($sorgu);
				$m_arama_sonuc = $vt->query($sorgu1) or die();
			}




			// YENİ İLETİ VARSA
			if ($konu_sayi > 0)
			{
				while ($mesaj_satir = $vt->fetch_assoc($m_arama_sonuc))
				{
					$bilsayi++;
					$bildirim_tarihi = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $mesaj_satir['son_mesaj_tarihi'], $ayarlar['tarih'], true);
					$bildirim_tarihi = @str_replace($bul, $cevir, $bildirim_tarihi);
					$mesaj_baslik = @str_replace($bul2, $cevir2, $mesaj_satir['mesaj_baslik']);


					// Yeni Cevap ise
					if ($mesaj_satir['cevap_sayi'] != 0)
					{
						// konu çok sayfalı ise son sayfaya git
						if ($mesaj_satir['cevap_sayi'] > $ayarlar['ksyfkota'])
						{
							$sayfaya_git = (($mesaj_satir['cevap_sayi']-1) / $ayarlar['ksyfkota']);
							settype($sayfaya_git,'integer');
							$sayfaya_git = ($sayfaya_git * $ayarlar['ksyfkota']);

							$sonagit = '&aks='.$sayfaya_git.'#c'.$mesaj_satir['son_cevap'];
						}
						else $sonagit = '#c'.$mesaj_satir['son_cevap'];


						// Bildirim XML
						$sayfa_cikis .= '<BILDIRIM>
						<BASLIK><![CDATA[Yeni bir cevap var]]></BASLIK>
						<KONU><![CDATA[Cevap: '.$mesaj_baslik.']]></KONU>
						<ADRES><![CDATA['.$TEMA_SITE_ANADIZIN.$phpkf_dosyalar['mobil'].'?ak='.$mesaj_satir['id'].$sonagit.']]></ADRES>
						<ZAMAN>'.$tarih.'</ZAMAN>
						<TARIH><![CDATA['.$bildirim_tarihi.']]></TARIH>
						<YAZAN><![CDATA['.$mesaj_satir['son_cevap_yazan'].']]></YAZAN>
						<UYARI>1</UYARI>
						</BILDIRIM>';
					}

					// Yeni Konu ise
					else
					{
						// Bildirim XML
						$sayfa_cikis .= '<BILDIRIM>
						<BASLIK><![CDATA[Yeni bir konu var]]></BASLIK>
						<KONU><![CDATA[Konu: '.$mesaj_baslik.']]></KONU>
						<ADRES><![CDATA['.$TEMA_SITE_ANADIZIN.$phpkf_dosyalar['mobil'].'?ak='.$mesaj_satir['id'].']]></ADRES>
						<ZAMAN>'.$tarih.'</ZAMAN>
						<TARIH><![CDATA['.$bildirim_tarihi.']]></TARIH>
						<YAZAN><![CDATA['.$mesaj_satir['yazan'].']]></YAZAN>
						<UYARI>1</UYARI>
						</BILDIRIM>';
					}
				}
			}
		}
	} // Forum kullanılıyorsa - sonu
}





//  KULLANICI GİRİŞ YAPMIŞSA    //
//  KULLANICI GİRİŞ YAPMIŞSA    //
//  KULLANICI GİRİŞ YAPMIŞSA    //

if (isset($kullanici_kim['id']))
{
	// Forum kullanılıyorsa - başı
	if ($ayarlar['forum_kullan'])
	{
		// Üyenin özel iletilerine bakılıyor //
		$sorgu = $vt->query("SELECT * FROM $tablo_ozel_ileti WHERE kime='$kullanici_kim[kullanici_adi]' AND alan_kutu='1' AND okunma_tarihi is null AND gonderme_tarihi > '$zaman' OR kime='$kullanici_kim[kullanici_adi]' AND kimden='$kullanici_kim[kullanici_adi]' AND alan_kutu='1' AND okunma_tarihi is null") or die();
		$oi_sayi = $vt->num_rows($sorgu);


		// Yeni özel ileti varsa
		if ($oi_sayi > 0)
		{
			$sorgu2 = "SELECT * FROM $tablo_ozel_ileti WHERE kime='$kullanici_kim[kullanici_adi]' AND alan_kutu='1' AND okunma_tarihi is null AND gonderme_tarihi > '$zaman' OR kime='$kullanici_kim[kullanici_adi]' AND kimden='$kullanici_kim[kullanici_adi]' AND alan_kutu='1' AND okunma_tarihi is null ORDER BY gonderme_tarihi DESC LIMIT 10";
			$oi_sonuc = $vt->query($sorgu2) or die();

			while ($oi_satir = $vt->fetch_assoc($oi_sonuc))
			{
				$bilsayi++;
				$bildirim_tarihi = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $oi_satir['gonderme_tarihi'], $ayarlar['tarih'], true);
				$bildirim_tarihi = @str_replace($bul, $cevir, $bildirim_tarihi);

				// Bildirim XML
				$sayfa_cikis .= '<BILDIRIM>
				<BASLIK><![CDATA[Yeni bir özel iletiniz var]]></BASLIK>
				<KONU><![CDATA[Özel ileti: '.$oi_satir['ozel_baslik'].']]></KONU>
				<ADRES><![CDATA['.$TEMA_SITE_ANADIZIN.'mobil/oi_oku.php?oino='.$oi_satir['id'].'#hzlcvp]]></ADRES>
				<ZAMAN>'.$tarih.'</ZAMAN>
				<TARIH><![CDATA['.$bildirim_tarihi.']]></TARIH>
				<YAZAN><![CDATA['.$oi_satir['kimden'].']]></YAZAN>
				<UYARI>1</UYARI>
				</BILDIRIM>';
			}
		}
	} // Forum kullanılıyorsa - sonu




	//  ÜYE BİLDİRİMLERİ  //
	//  ÜYE BİLDİRİMLERİ  //

	// yöneticiler için ek sorgu
	if ($kullanici_kim['yetki'] != 0) $eksorgu = "OR seviye='1' AND okundu='0'";
	else $eksorgu = '';

	// Üyenin bildirimlerine bakılıyor
	$sorgu = "SELECT * FROM $tablo_bildirimler WHERE uye_id='$kullanici_kim[id]' AND okundu='0' AND seviye!='1' $eksorgu ORDER BY id";
	$bilsonuc = $vt->query($sorgu) or die($vt->hata_ver());

	while ($bildirim = $vt->fetch_assoc($bilsonuc))
	{
		$okundu = false;
		$bildirim_tarihi = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $bildirim['tarih'], $ayarlar['tarih'], true);
		$bildirim_tarihi = @str_replace($bul, $cevir, $bildirim_tarihi);

		// profil yorum bildirimleri
		if ($bildirim['tip'] == '2')
		{
			$bilsayi++;
			$okundu = true;

			// Bildirim XML
			$sayfa_cikis .= '<BILDIRIM>
			<BASLIK><![CDATA[Yeni bir profil yorumunuz var]]></BASLIK>
			<KONU><![CDATA[Profil yorumu]]></KONU>
			<ADRES><![CDATA['.$TEMA_SITE_ANADIZIN.$phpkf_dosyalar['profil'].']]></ADRES>
			<ZAMAN>'.$tarih.'</ZAMAN>
			<TARIH><![CDATA['.$bildirim_tarihi.']]></TARIH>
			<YAZAN><![CDATA['.$bildirim['bildirim'].']]></YAZAN>
			<UYARI>1</UYARI>
			</BILDIRIM>';
		}


		// teşekkür bildirimleri
		elseif ($bildirim['tip'] == '4')
		{
			$bilsayi++;
			$okundu = true;
			$tsk_konu = explode(';', $bildirim['bildirim']);

			// Bildirim XML
			$sayfa_cikis .= '<BILDIRIM>
			<BASLIK><![CDATA[Bir yazınıza teşekkür edildi]]></BASLIK>
			<KONU><![CDATA[Teşekkür edildi]]></KONU>
			<ADRES><![CDATA['.$TEMA_SITE_ANADIZIN.'konu.php?'.$tsk_konu[1].']]></ADRES>
			<ZAMAN>'.$tarih.'</ZAMAN>
			<TARIH><![CDATA['.$bildirim_tarihi.']]></TARIH>
			<YAZAN><![CDATA['.$tsk_konu[0].']]></YAZAN>
			<UYARI>1</UYARI>
			</BILDIRIM>';
		}


		// CMS yorum bildirimleri
		elseif ($bildirim['tip'] == '5')
		{
			$bilsayi++;
			$okundu = true;

			// Bildirim XML
			$sayfa_cikis .= '<BILDIRIM>
			<BASLIK><![CDATA[Onaysız yorum var]]></BASLIK>
			<KONU><![CDATA[Onaysız yorum]]></KONU>
			<ADRES><![CDATA['.$TEMA_SITE_ANADIZIN.'phpkf-yonetim/yorumlar.php]]></ADRES>
			<ZAMAN>'.$tarih.'</ZAMAN>
			<TARIH><![CDATA['.$bildirim_tarihi.']]></TARIH>
			<YAZAN><![CDATA['.$bildirim['bildirim'].']]></YAZAN>
			<UYARI>1</UYARI>
			</BILDIRIM>';
		}


		// sipariş bildirimleri
		elseif ($bildirim['tip'] == '6')
		{
			$bilsayi++;
			$okundu = true;

			// Bildirim XML
			$sayfa_cikis .= '<BILDIRIM>
			<BASLIK><![CDATA[Yeni bir sipariş var]]></BASLIK>
			<KONU><![CDATA[Ürün Sipariş]]></KONU>
			<ADRES><![CDATA['.$TEMA_SITE_ANADIZIN.'phpkf-yonetim/ozel_sayfa.php?s=phpkf-bilesenler/eklentiler/urunler/urunler_yonetim.php&siparisler]]></ADRES>
			<ZAMAN>'.$tarih.'</ZAMAN>
			<TARIH><![CDATA['.$bildirim_tarihi.']]></TARIH>
			<YAZAN><![CDATA['.$bildirim['bildirim'].']]></YAZAN>
			<UYARI>1</UYARI>
			</BILDIRIM>';
		}


		// ödeme bildirimleri
		elseif ($bildirim['tip'] == '7')
		{
			$bilsayi++;
			$okundu = true;

			// Bildirim XML
			$sayfa_cikis .= '<BILDIRIM>
			<BASLIK><![CDATA[Yeni bir ödeme var]]></BASLIK>
			<KONU><![CDATA[Ürün Ödeme]]></KONU>
			<ADRES><![CDATA['.$TEMA_SITE_ANADIZIN.'phpkf-yonetim/ozel_sayfa.php?s=phpkf-bilesenler/eklentiler/urunler/urunler_yonetim.php&siparisler]]></ADRES>
			<ZAMAN>'.$tarih.'</ZAMAN>
			<TARIH><![CDATA['.$bildirim_tarihi.']]></TARIH>
			<YAZAN><![CDATA['.$bildirim['bildirim'].']]></YAZAN>
			<UYARI>1</UYARI>
			</BILDIRIM>';
		}

		if ($okundu == true)
		{
			// okundu olarak işaretle
			$sorgu2 = "UPDATE $tablo_bildirimler SET okundu='1' WHERE id='$bildirim[id]' LIMIT 1";
			$vtsonuc2 = $vt->query($sorgu2) or die($vt->hata_ver());
		}
	}
}



$sayfa_bas = '<?xml version="1.0" encoding="UTF-8"?>'."\r\n".'<PHPKF>'."\r\n";
if ($bilsayi == 0) $sayfa_bas .= $bosbildirim;
$sayfa_cikis = $sayfa_bas.$sayfa_cikis."\r\n".'</PHPKF>';
echo $sayfa_cikis;

?>