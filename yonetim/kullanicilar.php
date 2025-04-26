<?php
/*
 +-=========================================================================-+
 |                       php Kolay Forum (phpKF) v2.10                       |
 +---------------------------------------------------------------------------+
 |               Telif - Copyright (c) 2007 - 2017 phpKF Ekibi               |
 |                 http://www.phpKF.com   -   phpKF@phpKF.com                |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkartma ve satma hakları sadece phpKF`ye aittir.|
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  www.phpKF.com  adresini ziyaret edin.       |
 +-=========================================================================-+*/


if (!defined('DOSYA_AYAR')) include '../ayar.php';
if (!defined('DOSYA_YONETIM_GUVENLIK')) include 'bilesenler/guvenlik.php';
if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';

if (empty($_GET['sayfa'])) $_GET['sayfa'] = 0;
else $_GET['sayfa'] = @zkTemizle($_GET['sayfa']);

if (empty($_GET['sirala'])) $_GET['sirala'] = 1;
else $_GET['sirala'] = @zkTemizle($_GET['sirala']);

if (empty($_GET['kullanici'])) $_GET['kullanici'] = 1;
else $_GET['kullanici'] = @zkTemizle($_GET['kullanici']);

if (empty($_GET['kul_id'])) $_GET['kul_id'] = 0;
else $_GET['kul_id'] = @zkTemizle($_GET['kul_id']);

if (empty($_GET['kul_ara'])) $_GET['kul_ara'] = '%';
else
{
	$_GET['kul_ara'] = @zkTemizle(trim($_GET['kul_ara']));
	$_GET['kul_ara'] = @str_replace('*','%',$_GET['kul_ara']);
}



// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';


//		KULLANICI ETKİSİZLEŞTİRME		 //

if ($_GET['kullanici'] == 'etkisiz')
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}

	if ($_GET['kul_id'] == 1)
	{
		header('Location: hata.php?hata=61');
		exit();
	}


	$vtsorgu = "UPDATE $tablo_kullanicilar SET kul_etkin='0', kullanici_kimlik='', yonetim_kimlik='' WHERE id='$_GET[kul_id]' LIMIT 1";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());

	header('Location: hata.php?bilgi=33');
	exit();
}



//		KULLANICI ETKİNLEŞTİRME		 //

if ($_GET['kullanici'] == 'etkin')
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	$vtsorgu = "UPDATE $tablo_kullanicilar SET kul_etkin='1',kul_etkin_kod='0' WHERE id='$_GET[kul_id]' LIMIT 1";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());

	header('Location: hata.php?bilgi=25');
	exit();
}



//		KULLANICI SİLME		//

if ($_GET['kullanici'] == 'sil')
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}

	if ($_GET['kul_id'] == 1)
	{
		header('Location: hata.php?hata=137');
		exit();
	}


	$vtsorgu = "DELETE FROM $tablo_kullanicilar WHERE id='$_GET[kul_id]' LIMIT 1";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());

	if ((isset($_GET['kip'])) AND ($_GET['kip'] == 'engelli'))
		header('Location: hata.php?bilgi=23');

	elseif ((isset($_GET['kip'])) AND ($_GET['kip'] == 'etkisiz'))
		header('Location: hata.php?bilgi=26');

	else header('Location: hata.php?bilgi=34');
	exit();
}



//		KULLANICI ENGELLE		//

if ($_GET['kullanici'] == 'engelle')
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}

	if ($_GET['kul_id'] == 1)
	{
		header('Location: hata.php?hata=149');
		exit();
	}


	$vtsorgu = "UPDATE $tablo_kullanicilar SET engelle='1', kullanici_kimlik='', yonetim_kimlik='' WHERE id='$_GET[kul_id]' LIMIT 1";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());

	header('Location: hata.php?bilgi=35');
	exit();
}



//		KULLANICI ENGELİNİ KALDIRMA		//

if ($_GET['kullanici'] == 'engel_kaldir')
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}

	$vtsorgu = "UPDATE $tablo_kullanicilar SET engelle='0' WHERE id='$_GET[kul_id]' LIMIT 1";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());

	header('Location: hata.php?bilgi=24');
	exit();
}








//	KİP SEÇİMİ	//

if ((isset($_GET['kip'])) AND ($_GET['kip'] == 'engelli'))
{
	$eksorgu = "engelle='1' AND kul_etkin='1'";
	$sayfaek = 'kip=engelli&amp;';
	$sayfa_adi = 'Yönetim Engellenmiş Kullanıcılar';
	$syf_baslik = 'Engellenmiş Kullanıcılar';
	$vtsonuc_yok = 'Aradığınız koşula uyan engellenmiş kullanıcı yok !';
	$form_bilgisi = '<form action="kullanicilar.php" name="kul_ara" method="get">
<input type="hidden" name="kip" value="engelli">';
	$uye_alan1 = '';
	$uye_alan2 = 'Engel Kaldır';
	$uye_alan3 = '';
}

elseif ((isset($_GET['kip'])) AND ($_GET['kip'] == 'etkisiz'))
{
	$eksorgu = "kul_etkin='0'";
	$sayfaek = 'kip=etkisiz&amp;';
	$sayfa_adi = 'Yönetim Etkin Olmayan Kullanıcılar';
	$syf_baslik = 'Etkin Olmayan Kullanıcılar';
	$vtsonuc_yok = 'Aradığınız koşula uyan hesabı etkinleştirilmemiş kullanıcı yok !';
	$form_bilgisi = '<form action="kullanicilar.php" name="kul_ara" method="get">
<input type="hidden" name="kip" value="etkisiz">';
	$uye_alan1 = 'Engelle';
	$uye_alan2 = 'Etkin yap';
	$uye_alan3 = '';
}

else
{
	$eksorgu = "engelle='0' AND kul_etkin='1'";
	$sayfaek = '';
	$sayfa_adi = 'Yönetim Etkin Kullanıcılar';
	$syf_baslik = 'Etkin Kullanıcılar';
	$vtsonuc_yok = 'Aradığınız koşula uyan kullanıcı yok !';
	$form_bilgisi = '<form action="kullanicilar.php" name="kul_ara" method="get">';
	$uye_alan1 = 'Engelle';
	$uye_alan2 = 'Etkisiz yap';
	$uye_alan3 = 'Yetki';
}







//	SORGU SONUCUNDAKİ TOPLAM SONUÇ SAYISI ALINIYOR	//

$vtsonuc9 = $vt->query("SELECT id FROM $tablo_kullanicilar WHERE $eksorgu AND kullanici_adi LIKE '$_GET[kul_ara]%'") or die ($vt->hata_ver());
$satir_sayi = $vt->num_rows($vtsonuc9);

$uyeler_kota = 30;

$toplam_sayfa = ($satir_sayi / $uyeler_kota);
settype($toplam_sayfa,'integer');

if (($satir_sayi % $uyeler_kota) != 0) $toplam_sayfa++;


//	KULLANICILARIN BİLGİLERİ ÇEKİLİYOR	//

$vtsorgu = "SELECT id,kullanici_adi,mesaj_sayisi,katilim_tarihi,kul_ip FROM $tablo_kullanicilar WHERE $eksorgu AND kullanici_adi LIKE '$_GET[kul_ara]%' ORDER BY ";

if ($_GET['sirala'] == 'mesaj_0dan9a') $vtsorgu .= "mesaj_sayisi LIMIT $_GET[sayfa],$uyeler_kota";
elseif ($_GET['sirala'] == 'mesaj_9dan0a') $vtsorgu .= "mesaj_sayisi DESC LIMIT $_GET[sayfa],$uyeler_kota";
elseif ($_GET['sirala'] == 'katilim_9dan0a') $vtsorgu .= "id DESC LIMIT $_GET[sayfa],$uyeler_kota";
elseif ($_GET['sirala'] == 'ad_AdanZye') $vtsorgu .= "kullanici_adi LIMIT $_GET[sayfa],$uyeler_kota";
elseif ($_GET['sirala'] == 'ad_ZdenAya') $vtsorgu .= "kullanici_adi DESC LIMIT $_GET[sayfa],$uyeler_kota";
elseif ($_GET['sirala'] == 'yetki') $vtsorgu .= "yetki=0, yetki=3, yetki=2, yetki=1, id LIMIT $_GET[sayfa],$uyeler_kota";
else $vtsorgu .= "id LIMIT $_GET[sayfa],$uyeler_kota";

$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());




//  SAYFA BAŞLIK    //

include_once('bilesenler/sayfa_baslik.php');




$siralama_secenek = '<option value="1">Katılım tarihine göre
<option value="katilim_9dan0a" ';

if ($_GET['sirala'] == 'katilim_9dan0a') $siralama_secenek .= 'selected="selected"';
$siralama_secenek .= '>Katılım tarihine göre tersten

<option value="ad_AdanZye" ';
if ($_GET['sirala'] == 'ad_AdanZye') $siralama_secenek .= 'selected="selected"';
$siralama_secenek .= '>Kullanıcı adına göre A\'dan Z\'ye

<option value="ad_ZdenAya" ';
if ($_GET['sirala'] == 'ad_ZdenAya') $siralama_secenek .= 'selected="selected"';
$siralama_secenek .= '>Kullanıcı adına göre Z\'den A\'ya

<option value="mesaj_9dan0a" ';
if ($_GET['sirala'] == 'mesaj_9dan0a') $siralama_secenek .= 'selected="selected"';
$siralama_secenek .= '>İleti sayısına göre

<option value="mesaj_0dan9a" ';
if ($_GET['sirala'] == 'mesaj_0dan9a') $siralama_secenek .= 'selected="selected"';
$siralama_secenek .= '>İleti sayısına göre tersten

<option value="yetki" ';
if ($_GET['sirala'] == 'yetki') $siralama_secenek .= 'selected="selected"';
$siralama_secenek .= '>Yetkisine göre(Yöneticiler önde)';




//  ÜYELERİN BİLGİLERİ SIRALANIYOR  //

while ($uyeler_satir = $vt->fetch_array($vtsonuc2)):


$uye_ileti = '<a href="../oi_yaz.php?ozel_kime='.$uyeler_satir['kullanici_adi'].'">ileti</a>';

$uye_adi = '&nbsp;<a href="kullanici_degistir.php?u='.$uyeler_satir['id'].'">'.$uyeler_satir['kullanici_adi'].'</a>';

$uye_katilim = zonedate('d-m-Y', $ayarlar['saat_dilimi'], false, $uyeler_satir['katilim_tarihi']);

$uye_ip = '<a href="ip_yonetimi.php?kip=1&amp;ip='.$uyeler_satir['kul_ip'].'">'.$uyeler_satir['kul_ip'].'</a>';



if ((isset($_GET['kip'])) AND ($_GET['kip'] == 'engelli'))
{
	$uye_etkin = '<a href="kullanicilar.php?kul_id='.$uyeler_satir['id'].'&amp;yo='.$yo.'&amp;kullanici=engel_kaldir" onclick="return window.confirm(\'Kullanıcı engelini kaldırmak istediğinize emin misiniz?\')">Engel Kaldır</a>';

	$uye_sil = '<a href="kullanicilar.php?kip='.$_GET['kip'].'&amp;kul_id='.$uyeler_satir['id'].'&amp;yo='.$yo.'&amp;kullanici=sil" onclick="return window.confirm(\'Kullanıcıyı silmek istediğinize emin misiniz ?\')">Sil</a>';

	$uye_engel = '&nbsp; &nbsp; &nbsp; ';
	$uye_yetki = '&nbsp; &nbsp; &nbsp; ';
}

elseif ((isset($_GET['kip'])) AND ($_GET['kip'] == 'etkisiz'))
{
	$uye_engel = '<a href="kullanicilar.php?kul_id='.$uyeler_satir['id'].'&amp;yo='.$yo.'&amp;kullanici=engelle" onclick="return window.confirm(\'Kullanıcıyı engellemek istediğinize emin misiniz ?\')">Engelle</a>';

	$uye_etkin = '<a href="kullanicilar.php?kul_id='.$uyeler_satir['id'].'&amp;yo='.$yo.'&amp;kullanici=etkin" onclick="return window.confirm(\'Kullanıcıyı etkinleştirmek istediğinize emin misiniz ?\')">Etkin yap</a>';

	$uye_sil = '<a href="kullanicilar.php?kip='.$_GET['kip'].'&amp;kul_id='.$uyeler_satir['id'].'&amp;yo='.$yo.'&amp;kullanici=sil" onclick="return window.confirm(\'Kullanıcıyı silmek istediğinize emin misiniz ?\')">Sil</a>';
	$uye_yetki = '&nbsp; &nbsp; &nbsp; ';
}

else
{
	$uye_engel = '<a href="kullanicilar.php?kul_id='.$uyeler_satir['id'].'&amp;yo='.$yo.'&amp;kullanici=engelle" onclick="return window.confirm(\'Kullanıcıyı engellemek istediğinize emin misiniz ?\')">Engelle</a>';

	$uye_etkin = '<a href="kullanicilar.php?kul_id='.$uyeler_satir['id'].'&amp;yo='.$yo.'&amp;kullanici=etkisiz" onclick="return window.confirm(\'Kullanıcıyı etkisizleştirmek istediğinize emin misiniz ?\')">Etkisiz yap</a>';

	$uye_sil = '<a href="kullanicilar.php?kul_id='.$uyeler_satir['id'].'&amp;yo='.$yo.'&amp;kullanici=sil" onclick="return window.confirm(\'Kullanıcıyı silmek istediğinize emin misiniz ?\')">Sil</a>';
	$uye_yetki = '<a href="kul_izinler.php?kim='.$uyeler_satir['kullanici_adi'].'">Ö. Yetki</a>';
}


//	veriler tema motoruna yollanıyor	//

$tekli1[] = array('{UYE_ILETI}' => $uye_ileti,
'{UYE_ADI}' => $uye_adi,
'{UYE_MESAJ}' => NumaraBicim($uyeler_satir['mesaj_sayisi']),
'{UYE_KATILIM}' => $uye_katilim,
'{UYE_YETKI}' => $uye_yetki,
'{UYE_IP_ADRESI}' => $uye_ip,
'{UYE_ENGEL}' => $uye_engel,
'{UYE_ETKIN}' => $uye_etkin,
'{UYE_SIL}' => $uye_sil);


endwhile;



//  SAYFALAMA   //

$sayfalama = '';

if ($satir_sayi > $uyeler_kota):

$sayfalama .= '<p>
<table cellspacing="1" cellpadding="2" border="0" align="right" class="tablo_border">
	<tr>
	<td class="forum_baslik">
Toplam '.$toplam_sayfa.' Sayfa:&nbsp;
	</td>
';


if ($_GET['sayfa'] != 0)
{
	$sayfalama .= '<td bgcolor="#ffffff" class="liste-veri" title="ilk sayfaya git">';
	$sayfalama .= '&nbsp;<a href="kullanicilar.php?'.$sayfaek.'sayfa=0&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">&laquo;ilk</a>&nbsp;</td>';
	
	$sayfalama .= '<td bgcolor="#ffffff" class="liste-veri" title="önceki sayfaya git">';
	$sayfalama .= '&nbsp;<a href="kullanicilar.php?'.$sayfaek.'sayfa='.($_GET['sayfa'] - $uyeler_kota).'&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">&lt;</a>&nbsp;</td>';
}

for ($sayi=0,$sayfa_sinir=$_GET['sayfa']; $sayi < $toplam_sayfa; $sayi++)
{
	if ($sayi < (($_GET['sayfa'] / $uyeler_kota) - 3));

	else
	{
		$sayfa_sinir++;
		if ($sayfa_sinir >= ($_GET['sayfa'] + 8)) {break;}
		if (($sayi == 0) and ($_GET['sayfa'] == 0))
		{
			$sayfalama .= '<td bgcolor="#ffffff" class="liste-veri" title="Şu an bulunduğunuz sayfa">';
			$sayfalama .= '&nbsp;<b>[1]</b>&nbsp;</td>';
		}
	
		elseif (($sayi + 1) == (($_GET['sayfa'] / $uyeler_kota) + 1))
		{
			$sayfalama .= '<td bgcolor="#ffffff" class="liste-veri" title="Şu an bulunduğunuz sayfa">';
			$sayfalama .= '&nbsp;<b>['.($sayi + 1).']</b>&nbsp;</td>';
		}
	
		else
		{
			$sayfalama .= '<td bgcolor="#ffffff" class="liste-veri" title="'.($sayi + 1).' numaralı sayfaya git">';

			$sayfalama .= '&nbsp;<a href="kullanicilar.php?'.$sayfaek.'sayfa='.($sayi * $uyeler_kota).'&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">'.($sayi + 1).'</a>&nbsp;</td>';
		}
	}
}
if ($_GET['sayfa'] < ($satir_sayi - $uyeler_kota))
{
	$sayfalama .= '<td bgcolor="#ffffff" class="liste-veri" title="sonraki sayfaya git">';
	$sayfalama .= '&nbsp;<a href="kullanicilar.php?'.$sayfaek.'sayfa='.($_GET['sayfa'] + $uyeler_kota).'&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">&gt;</a>&nbsp;</td>';

	$sayfalama .= '<td bgcolor="#ffffff" class="liste-veri" title="son sayfaya git">';
	$sayfalama .= '&nbsp;<a href="kullanicilar.php?'.$sayfaek.'sayfa='.(($toplam_sayfa - 1) * $uyeler_kota).'&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">son&raquo;</a>&nbsp;</td>';
}

$sayfalama .= '</tr>
</table>';

endif;




//	TEMA UYGULANIYOR	//

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/kullanicilar.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));


if (isset($tekli1))
{
	$ornek1->kosul('2', array(''=>''), false);
	$ornek1->kosul('1', array(''=>''), true);

	$ornek1->tekli_dongu('1',$tekli1);
}

else
{
	$tekli1[] = array('{UYE_ILETI}' => '',
	'{UYE_ADI}' => '',
	'{UYE_MESAJ}' => '',
	'{UYE_KATILIM}' => '',
	'{UYE_YETKI}' => '',
	'{UYE_ENGEL}' => '',
	'{UYE_ETKIN}' => '',
	'{UYE_SIL}' => '');

	$ornek1->tekli_dongu('1',$tekli1);

	$ornek1->kosul('2', array('{SONUC_YOK}' => $vtsonuc_yok), true);
	$ornek1->kosul('1', array(''=>''), false);
}


$dongusuz = array('{FORM_BILGISI}' => $form_bilgisi,
'{SAYFA_BASLIK}' => $syf_baslik,
'{KULLANICI_ARA}' => @str_replace('%','*',$_GET['kul_ara']),
'{SIRALAMA_SECENEK}' => $siralama_secenek,
'{SAYFALAMA}' => $sayfalama,
'{UYE_ALAN1}' => $uye_alan1,
'{UYE_ALAN2}' => $uye_alan2,
'{UYE_ALAN3}' => $uye_alan3,
'{ARAMA_SONUC_YAZISI1}' => 'Aradığınız koşula uyan üye sayısı:',
'{ARAMA_SONUC_YAZISI2}' => '(Engellenmiş ve etkinleştirilmemiş olanlar hariç)',
'{UYE_SAYISI}' => NumaraBicim($satir_sayi));

$ornek1->dongusuz($dongusuz);

eval(TEMA_UYGULA);

?>