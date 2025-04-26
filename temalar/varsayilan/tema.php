<?php

// Tema adı ve renk değişimi desteği
$t_tema_adi = 'Varsayılan';
$t_renkler = array('Mavi'=>'mavi', 'Koyu Gri'=>'siyah');



if ( (isset($_COOKIE['forum_rengi'])) AND ($_COOKIE['forum_rengi'] != '') )
{
	switch($_COOKIE['forum_rengi'])
	{
		case 'siyah';
		$ayarlar['forum_rengi'] = 'siyah';
		break;

		default:
		$ayarlar['forum_rengi'] = 'mavi';
	}
}



// düğme renkleri
if ($ayarlar['forum_rengi'] != 'siyah')
{
	// şablon
	$css_satiri = 'temalar/varsayilan/sablon.css';

	// alıntı, sil, taşı, değiştir, kilitle ve ip simgeleri
	$simge_alinti = 'border="0" src="temalar/varsayilan/resimler/alinti.png"';
	$simge_sil = 'border="0" src="temalar/varsayilan/resimler/sil.png"';
	$simge_tasi = 'border="0" src="temalar/varsayilan/resimler/tasi.png"';
	$simge_degistir = 'border="0" src="temalar/varsayilan/resimler/degistir.png"';
	$simge_kilitle = 'border="0" src="temalar/varsayilan/resimler/kilitle.png"';
	$simge_ip = 'border="0" src="temalar/varsayilan/resimler/ip.png"';
	$simge_ust = 'border="0" src="temalar/varsayilan/resimler/ustkonu.png"';
	$sonileti_rengi = 'temalar/varsayilan/resimler/sonileti.gif';

	// forum ve konu klasörleri
	$forumbilgileri_resim = 'width="40" height="40" border="0" src="temalar/varsayilan/resimler/evb.png"';
	$cevrimici_resim = 'width="40" height="40" border="0" src="temalar/varsayilan/resimler/cevrimici.png"';
}

else
{
	// şablon
	$css_satiri = 'temalar/varsayilan/sablon.css" rel="stylesheet" type="text/css" />
<link href="temalar/varsayilan/sablon_koyu.css';

	// alıntı, sil, taşı, değiştir, kilitle ve ip simgeleri
	$simge_alinti = 'border="0" src="temalar/varsayilan/resimler/alintis.png"';
	$simge_sil = 'border="0" src="temalar/varsayilan/resimler/sils.png"';
	$simge_tasi = 'border="0" src="temalar/varsayilan/resimler/tasis.png"';
	$simge_degistir = 'border="0" src="temalar/varsayilan/resimler/degistirs.png"';
	$simge_kilitle = 'border="0" src="temalar/varsayilan/resimler/kilitles.png"';
	$simge_ip = 'border="0" src="temalar/varsayilan/resimler/ips.png"';
	$simge_ust = 'border="0" src="temalar/varsayilan/resimler/ustkonus.png"';
	$sonileti_rengi = 'temalar/varsayilan/resimler/soniletis.gif';

	$forumbilgileri_resim = 'width="40" height="40" border="0" src="temalar/varsayilan/resimler/evbs.png"';
	$cevrimici_resim = 'width="40" height="40" border="0" src="temalar/varsayilan/resimler/cevrimicis.png"';
}


// forum ve konu klasörleri
$acik_forum = 'border="0" src="temalar/varsayilan/resimler/klasor/acik.png"';
$kapali_forum = 'border="0" src="temalar/varsayilan/resimler/klasor/kapali.png"';
$uyeler_forum = 'border="0" src="temalar/varsayilan/resimler/klasor/uyeler.png"';
$ozel_forum = 'border="0" src="temalar/varsayilan/resimler/klasor/ozel.png"';
$yonetici_forum = 'border="0" src="temalar/varsayilan/resimler/klasor/ykilit.png"';
$yardimci_forum = 'border="0" src="temalar/varsayilan/resimler/klasor/ykilit1.png"';
$acik_konu = 'border="0" src="temalar/varsayilan/resimler/klasor/acik_k.png"';
$kilitli_konu = 'border="0" src="temalar/varsayilan/resimler/klasor/ykilit_k.png"';
$ust_konu = 'border="0" src="temalar/varsayilan/resimler/klasor/ozel_k.png"';


// özel ileti gönder, cevap yaz, yeni konu, ve kilitli düğmeleri
$yenibaslik_rengi = '<span class="dugme">Yeni Başlık</span>';
$cevapyaz_rengi = '<span class="dugme">Cevap Yaz</span>';
$kilitli_rengi = '<span class="dugme" style="cursor:help; padding-left:13px; padding-right:13px">Kilitli Konu</span>';
$oi_rengi = '<span class="dugme">Özel ileti gönder</span>';
$basliktabani = '';

?>