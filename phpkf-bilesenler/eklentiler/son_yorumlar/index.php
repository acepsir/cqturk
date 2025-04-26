<?php

if (!defined('PHPKF_ICINDEN')) exit();


//  Eklenti Bilgileri  //

$eklenti_bilgi = array(
'ad' => 'Son Yorumlar',
'yapimci' => 'phpKF',
'telif' => 'phpKF',
'adres' => 'https://www.phpkf.com',
'tarih' => '14.07.2014 (01.09.2019)',
'esurum' => '1.2',
'usurum' => '0.600;0.650;0.750;1.00;1.10;1.20;3.00',
'tip' => 'Blok',
'aciklama' => 'Bu eklenti, tüm sayfalarda çıkacak şekilde son yorumların göründüğü bir blok ekler.
Bloğun yerini ve genişliğini <a href="bloklar.php">Blok Yönetimi</a> sayfasından ayarlayabilirsiniz. Gösterilecek yorum sayısı, kategorisi, başlık ve içerik uzunluğu ayarlarını ise <a href="ayarlar.php?kip=eklenti#son_yorumlar_kat">Kurulu Eklentilerin Ayarları</a> sayfasından değiştirebilirsiniz.',
'resim_kucuk' => 'onizlemek.png',
'resim_buyuk' => 'onizlemeb.png',
);




//  EKLENTİ KURULUM İŞLEMLERİ - BAŞI  //

if ($eklenti_kurulum):

//  Eklenecek Bloklar  //
$blok_ekle[] = array(
'baslik' => 'Son Yorumlar',
'yer' => '2',
'genislik' => '250px',
'adres' => 'son_yorumlar_blok.php',
'kod' => '',
);



// Kategori seçimi
$ayar_ekle[] = array(
'kat' => '',
'sira' => '1',
'tip' => 'eklenti',
'kip' => '1',
'etiket' => 'son_yorumlar_kat',
'deger' => '0',
'form_tip' => 'select',
'secenek' => '0:Tüm Kategoriler|{KAT_ID}:{KATEGORILER}',
'secenek_tip' => 'numeric',
'varsayilan' => '0',
'bos' => '0',
'diger' => '',
'bilgi' => '',
'baslik' => 'Yazı kategorisi',
'aciklama' => 'Yazıların gösterileceği kategori.',
);


// Yazı sayısı ayarı
$ayar_ekle[] = array(
'kat' => '',
'sira' => '2',
'tip' => 'eklenti',
'kip' => '1',
'etiket' => 'son_yorumlar_sayi',
'deger' => '5',
'form_tip' => 'text',
'secenek_tip' => 'numeric',
'varsayilan' => '5',
'bos' => '0',
'diger' => 'maxlength="2" style="width:30px"',
'bilgi' => '5',
'baslik' => 'Gösterilecek yorum sayısı',
'aciklama' => 'Son yorumlar bloğunda gösterilecek yorum sayısı.',
);


// Yazı başlık karakter sınırlaması
$ayar_ekle[] = array(
'kat' => '',
'sira' => '3',
'tip' => 'eklenti',
'kip' => '1',
'etiket' => 'son_yorumlar_baslik',
'deger' => '20',
'form_tip' => 'text',
'secenek_tip' => 'numeric',
'varsayilan' => '20',
'bos' => '0',
'diger' => 'maxlength="3" style="width:30px"',
'bilgi' => '20',
'baslik' => 'Azami başlık karakter sayısı',
'aciklama' => 'Yazı başlığının alabileceği en fazla karakter sayısı. Girilen değerden uzunsa ... şeklinde kısaltılır.',
);


// Yazı İçerik karakter sınırlaması
$ayar_ekle[] = array(
'kat' => '',
'sira' => '4',
'tip' => 'eklenti',
'kip' => '1',
'etiket' => 'son_yorumlar_icerik',
'deger' => '50',
'form_tip' => 'text',
'secenek_tip' => 'numeric',
'varsayilan' => '50',
'bos' => '0',
'diger' => 'maxlength="3" style="width:30px"',
'bilgi' => '50',
'baslik' => 'Azami içerik karakter sayısı',
'aciklama' => 'Yorum içeriğinin alabileceği en fazla karakter sayısı. Girilen değerden uzunsa ... şeklinde kısaltılır.',
);


endif;

//  EKLENTİ KURULUM İŞLEMLERİ - SONU  //



//  EKLENTİ KALDIRMA İŞLEMLERİ - BAŞI  //

if ($eklenti_kaldirma):

// kaldırılacak ayarlar
$ayar_kaldir = array(
'son_yorumlar_kat',
'son_yorumlar_sayi',
'son_yorumlar_baslik',
'son_yorumlar_icerik',
);

endif;

//  EKLENTİ KALDIRMA İŞLEMLERİ - SONU  //

?>