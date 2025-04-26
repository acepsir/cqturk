<?php
if (!defined('PHPKF_ICINDEN')) exit();

//  EKLENTİ BİLGİLERİ  //

$eklenti_bilgi = array(
'ad' => 'Tema İletişim Bilgileri',
'yapimci' => 'phpKF',
'telif' => 'Yok',
'adres' => 'https://www.phpkf.com',
'tarih' => '20.08.2019 (15.09.2019)',
'esurum' => '1.0',
'usurum' => '0.600;0.650;0.750;1.00;1.10;1.20;3.00',
'tip' => 'Tema',
'aciklama' => '<a href="ayarlar.php?kip=tema#iletisim_telefon"><u>Tema ayarlarına</u></a> Telefon, E-Posta, Facebook, Twitter ve Instagram adres alanları ekler. Eklenen bilgileri temada istediğiniz yerde aşağıdaki php kodu ekleyerek kullanabilirsiniz.<br><pre>&lt;?php echo $ayarlar["iletisim_telefon"]; ?&gt;<br>&lt;?php echo $ayarlar["iletisim_eposta"]; ?&gt;<br>&lt;?php echo $ayarlar["iletisim_adres"]; ?&gt;<br>&lt;?php echo $ayarlar["iletisim_facebook"]; ?&gt;<br>&lt;?php echo $ayarlar["iletisim_twitter"]; ?&gt;<br>&lt;?php echo $ayarlar["iletisim_instagram"]; ?&gt;</pre>',
'resim_kucuk' => 'onizleme.png',
'resim_buyuk' => 'onizleme.png',
);




//  Eklenecek Ayarlar - Baş //

if ($eklenti_kurulum):

// Telefon
$ayar_ekle[] = array(
'kat' => '13',
'sira' => '9',
'tip' => 'tema',
'kip' => '1',
'etiket' => 'iletisim_telefon',
'deger' => '',
'form_tip' => 'text',
'secenek' => '',
'secenek_tip' => 'html',
'varsayilan' => '',
'bos' => '1',
'diger' => '',
'bilgi' => 'Telefon Numarası',
'baslik' => 'Telefon',
'aciklama' => 'İletişim telefon numarası giriniz.',
);

// E-Posta
$ayar_ekle[] = array(
'kat' => '13',
'sira' => '10',
'tip' => 'tema',
'kip' => '1',
'etiket' => 'iletisim_eposta',
'deger' => '',
'form_tip' => 'text',
'secenek' => '',
'secenek_tip' => 'html',
'varsayilan' => '',
'bos' => '1',
'diger' => '',
'bilgi' => 'İletişim E-Posta Adresi',
'baslik' => 'E-Posta',
'aciklama' => 'İletişim e-posta adresi giriniz.',
);


// Adres
$ayar_ekle[] = array(
'kat' => '13',
'sira' => '11',
'tip' => 'tema',
'kip' => '1',
'etiket' => 'iletisim_adres',
'deger' => '',
'form_tip' => 'textarea',
'secenek' => '',
'secenek_tip' => 'html',
'varsayilan' => '',
'bos' => '1',
'diger' => 'rows="4"',
'bilgi' => 'İletişim Adresi',
'baslik' => 'Adres',
'aciklama' => 'İletişim adresi giriniz.',
);


// Facebook
$ayar_ekle[] = array(
'kat' => '13',
'sira' => '12',
'tip' => 'tema',
'kip' => '1',
'etiket' => 'iletisim_facebook',
'deger' => '',
'form_tip' => 'text',
'secenek_tip' => 'text',
'varsayilan' => '',
'bos' => '1',
'diger' => '',
'bilgi' => 'https://www.facebook.com/',
'baslik' => 'Facebook',
'aciklama' => 'Facebook adresini giriniz.',
);


// Twitter
$ayar_ekle[] = array(
'kat' => '13',
'sira' => '13',
'tip' => 'tema',
'kip' => '1',
'etiket' => 'iletisim_twitter',
'deger' => '',
'form_tip' => 'text',
'secenek_tip' => 'text',
'varsayilan' => '',
'bos' => '1',
'diger' => '',
'bilgi' => 'https://www.twitter.com/',
'baslik' => 'Twitter',
'aciklama' => 'Twitter adresini giriniz.',
);


// instagram
$ayar_ekle[] = array(
'kat' => '13',
'sira' => '14',
'tip' => 'tema',
'kip' => '1',
'etiket' => 'iletisim_instagram',
'deger' => '',
'form_tip' => 'text',
'secenek_tip' => 'text',
'varsayilan' => '',
'bos' => '1',
'diger' => '',
'bilgi' => 'https://www.instagram.com/',
'baslik' => 'instagram',
'aciklama' => 'instagram adresi giriniz.',
);


endif;

//  Eklenecek Ayarlar - Son //









if ($eklenti_kaldirma):

// kaldırılacak ayarlar
$ayar_kaldir = array(
'iletisim_telefon', 'iletisim_eposta', 'iletisim_adres', 'iletisim_facebook', 'iletisim_twitter', 'iletisim_instagram'
);


endif;

?>