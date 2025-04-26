<?php
// phpKF v3.00
// Hata Sayfası
// Türkçe Dil Dosyası



// Tekrar Eden Başlık ve Linkler
$lh['hata_iletisi'] = 'Hata iletisi';
$lh['bilgi_iletisi'] = 'Bilgi iletisi';
$lh['uyari_iletisi'] = 'Uyarı iletisi';
$lh['hatali_adres'] = 'Hatalı Adres !';
$lh['tikla_geri1'] = 'Geri dönmek için tıklayın.';
$lh['tikla_geri2'] = 'geri dönmek için tıklayın.';
$lh['tikla_geri3'] = 'Lütfen geri dönüp tekrar deneyin.';
$lh['tikla_giris'] = 'Giriş yapmak için tıklayın.';
$lh['tikla_hatirla1'] = 'Şifreyi hatırlamıyorsanız tıklayın.';
$lh['tikla_hatirla2'] = 'Kullanıcı adını hatırlamıyorsanız tıklayın.';
$lh['tikla_kayit'] = 'Üye olmak için tıklayın.';
$lh['tikla_anasayfa'] = 'Ana sayfaya gitmek için tıklayın.';
$lh['tikla_profil'] = 'Profilinizi görmek için tıklayın.';
$lh['onay_kodu_hatali'] = 'Onay kodu hatalı !';
$lh['spam_kutusu'] = 'Posta kutularınızı kontrol edin, spam kutusuna düşmüş olabilir.';
$lu['giris_yap'] = 'Giriş Yap';
$lu['uye_ol'] = 'Üye Ol';
$lu['facebook_giris'] = 'Facebook hesabıyla giriş yapabilirsiniz.';




//  BİLGİ İLETİLERİ  - BAŞI  //

// 1 -> 501 yapıldı
/**/$lb[1] = '<meta http-equiv="Refresh" content="5;url=konu.php?k='.$mesaj_no.$ks.'#c'.$cevap_no.'">İletiniz gönderilmiştir, okumak için <a href="konu.php?k='.$mesaj_no.$ks.'#c'.$cevap_no.'">tıklayın.</a><br />Foruma dönmek için <a href="forum.php?f='.$fno.'">tıklayın.</a>';


// 2 -> 502 yapıldı
/**/$lb[2] = '<meta http-equiv="Refresh" content="5;url=konu.php?k='.$mesaj_no.'">İletiniz gönderilmiştir, okumak için <a href="konu.php?k='.$mesaj_no.'">tıklayın.</a><br />Foruma dönmek için <a href="forum.php?f='.$fno.'">tıklayın.</a>';



/**/$lb[3] = '<meta http-equiv="Refresh" content="5;url=konu.php?k='.$mesaj_no.'&amp;f='.$fno.$fs.'">İletiniz değiştirilmiştir, okumak için <a href="konu.php?k='.$mesaj_no.'&amp;f='.$fno.$fs.'">tıklayın.</a><br />Foruma dönmek için <a href="forum.php?f='.$fno.'">tıklayın.</a>';

/**/$lb[4] = '<meta http-equiv="Refresh" content="5;url=konu.php?k='.$mesaj_no.$ks.'&amp;f='.$fno.$fs.'#c'.$cevap_no.'">İletiniz değiştirilmiştir, okumak için <a href="konu.php?k='.$mesaj_no.$ks.'&amp;f='.$fno.$fs.'#c'.$cevap_no.'">tıklayın.</a><br />Foruma dönmek için <a href="forum.php?f='.$fno.'">tıklayın.</a>';

/**/$lb[5] = 'Konuyu ve altındaki tüm cevapları silmek istediğinize emin misiniz ?<br /><br /><a href="phpkf-bilesenler/mesaj_sil.php?onay=kabul&amp;kip=mesaj&amp;fno='.$fno.'&amp;mesaj_no='.$mesaj_no.'&amp;o='.$go.$fs.'">Evet</a> &nbsp; - &nbsp; <a href="konu.php?k='.$mesaj_no.$fs.'">Hayır</a>';

/**/$lb[6] = 'Konu ve tüm cevapları silinmiştir.<br /><br />Foruma geri dönmek için <a href="forum.php?f='.$fno.$fs.'">tıklayın</a>';

/**/$lb[7] = 'Cevabı silmek istediğinize emin misiniz ?<br /><br /><a href="phpkf-bilesenler/mesaj_sil.php?onay=kabul&amp;kip=cevap&amp;mesaj_no='.$mesaj_no.'&amp;cevap_no='.$cevap_no.'&amp;o='.$go.$fs.$ks.'">Evet</a> &nbsp; - &nbsp; <a href="konu.php?k='.$mesaj_no.$fs.$ks.'">Hayır</a>';

/**/$lb[8] = 'Cevap silinmiştir.<br /><br />Konuya geri dönmek için <a href="konu.php?k='.$mesaj_no.$fs.$ks.'">tıklayın.</a>';

/**/$lb[9] = 'Seçtiğiniz konu taşınmıştır.<br /><br />Geldiğiniz bölüme dönmek için <a href="forum.php?f='.$fno1.'">tıklayın.</a><br />Konuyu taşıdığınız bölüme dönmek için <a href="forum.php?f='.$fno2.'">tıklayın.</a>';



$lb[10] = 'Profiliniz Güncellenmiştir...';



/**/$lb[11] = 'Özel iletiniz gönderilmiştir.<br /><br />Gönderilen kutusuna gitmek için <a href="ozel_ileti.php?kip=gonderilen">tıklayın.</a><meta http-equiv="Refresh" content="5;url=ozel_ileti.php?kip=gonderilen"><br /><br />Yazdığınız özel iletiyi görmek için <a href="oi_oku.php?oino='.$cevap_no.'#hzlcvp">tıklayın.</a>';

/**/$lb[12] = 'Forum ayarlarınız güncellenmiştir.<br /><br />Yönetim ana sayfasına dönmek için <a href="phpkf-yonetim/index.php">tıklayın.</a><meta http-equiv="Refresh" content="5;url=phpkf-yonetim/index.php">';

/**/$lb[13] = 'E-Postanız Gönderilmiştir...<br /><br /><a href="'.$phpkf_dosyalar['forum'].'">'.$lh['tikla_anasayfa'].'</a>';



$lb[14] = 'Etkinleştirme kodu başvurunuz tamamlanmıştır.<br /><br />Size gelen E-Postadaki bağlantıyı tıklayarak hesabınızı etkinleştirebilirsiniz.';

$lb[15] = 'Kayıt işleminiz başarıyla tamamlanmıştır.';

$lb[16] = 'Kayıt işleminiz başarıyla tamamlanmıştır.<br /><br />Hesabınızı etkinleştirmek için yapmanız gerekenler<br />size gönderilen E-Postada anlatılmaktadır.';



/**/$lb[17] = 'Kayıt işleminiz başarıyla tamamlanmıştır.<br /><br />Hesabınızın etkinleştirilmesi için forum yöneticisinin onayını beklemelisiniz.';



$lb[18] = 'Hesabınız zaten etkinleştirilmiş.';

$lb[19] = 'Hesabınız etkinleştirilmiştir.';

$lb[20] = 'Yeni şifre başvurunuz tamamlanmıştır.<br /><br />Şifre sıfırlaması için yapılması gerekenler gönderilen E-Postada anlatılmaktadır.';

$lb[21][0] = 'Yeni şifreniz oluşturulmuştur.';
$lb[21][1] = 'Yeni şifrenizle giriş yapmak için tıklayınız.';

$lb[22] = 'Yeni Şifre başvurunuz iptal edilmiştir. Eski şifreniz hâlâ geçerlidir.';



// 23 -> 500 yapıldı
/**/$lb[23] = 'Kullanıcı hesabı silinmiştir.<br /><br />Geri dönmek için <a href="phpkf-yonetim/uyeler.php?kip=engelli">tıklayın.</a>';

/**/$lb[24] = 'Kullanıcının engeli kaldırılmıştır.<br /><br />Geri dönmek için <a href="phpkf-yonetim/uyeler.php?kip=engelli">tıklayın.</a><br /><br />Engeli olmayan kullanıcıları görmek için <a href="phpkf-yonetim/uyeler.php">tıklayın.</a>';

/**/$lb[25] = 'Kullanıcı hesabı etkinleştirilmiştir.<br />Geri dönmek için <a href="phpkf-yonetim/uyeler.php?kip=etkisiz">tıklayın.</a><br /><br />Etkinleştirilmiş kullanıcıları görmek için <a href="phpkf-yonetim/uyeler.php">tıklayın.</a>';

/**/$lb[26] = 'Kullanıcı hesabı silinmiştir.<br /><br />Geri dönmek için <a href="phpkf-yonetim/uyeler.php?kip=etkisiz">tıklayın.</a>';

/**/$lb[27] = 'Forum dalı içinde bulunan; forumlar, alt forumlar, konular ve<br />cevaplarıyla beraber başarıyla silinmiştir.<br /><br />Forum Yönetimi sayfasına dönmek için <a href="phpkf-yonetim/forumlar.php">tıklayın.</a>';

/**/$lb[28] = 'Tüm forumlar, seçmiş olduğunuz forum dalına başarıyla taşınmıştır.<br /><br />Forum Yönetimi sayfasına dönmek için <a href="phpkf-yonetim/forumlar.php">tıklayın.</a>';

/**/$lb[29] = 'Forum, forumun konuları ve konuların cevapları başarıyla silinmiştir.<br /><br />Forum Yönetimi sayfasına dönmek için <a href="phpkf-yonetim/forumlar.php">tıklayın.</a>';

/**/$lb[30] = 'Forumun konuları ve konuların cevapları başarıyla taşınmıştır.<br /><br />Forum Yönetimi sayfasına dönmek için <a href="phpkf-yonetim/forumlar.php">tıklayın.</a>';

/**/$lb[31] = 'Forum, seçtiğiniz forum dalına başarıyla taşınmıştır.<br /><br />Forum Yönetimi sayfasına dönmek için <a href="phpkf-yonetim/forumlar.php">tıklayın.</a>';

/**/$lb[32] = 'Üyenin profili güncellenmiştir, görmek için <a href="'.$phpkf_dosyalar['profil'].'?u='.$mesaj_no.'">tıklayın.</a><br /><br />Etkin Kullanıcılar sayfasına dönmek için <a href="phpkf-yonetim/uyeler.php">tıklayın.</a><meta http-equiv="Refresh" content="5;url=yonetim/kullanicilar.php">';

/**/$lb[33] = 'Kullanıcı hesabı etkisizleştirilmiştir.<br />Geri dönmek için <a href="phpkf-yonetim/uyeler.php">tıklayın.</a><br /><br />Etkinleştirilmemiş kullanıcıları görmek için <a href="phpkf-yonetim/uyeler.php?kip=etkisiz">tıklayın.</a>';

/**/$lb[34] = 'Kullanıcı hesabı silinmiştir.<br /><br />Geri dönmek için <a href="phpkf-yonetim/uyeler.php">tıklayın.</a>';

/**/$lb[35] = 'Kullanıcı engellenmiştir.<br />Geri dönmek için <a href="phpkf-yonetim/uyeler.php">tıklayın.</a><br /><br />Engellenmiş kullanıcıları görmek için <a href="phpkf-yonetim/uyeler.php?kip=engelli">tıklayın.</a>';

/**/$lb[36] = 'Forumdaki eski mesajlar silinmiştir.';

/**/$lb[37] = 'E-POSTALARINIZ YOLLANMIŞTIR...';

/**/$lb[38] = 'Veritabanı yedeğiniz başarıyla geri yüklenmiştir.';

/**/$lb[39] = 'Yasaklama bilgileri güncellenmiştir.<br />Geri dönmek için <a href="phpkf-yonetim/yasaklamalar.php">tıklayın.</a>';

/**/$lb[40] = 'Güncelleme Başarıyla Tamamlanmıştır.';

/**/$lb[41] = 'Kullanıcı engellenmiştir.<br />Geri dönmek için <a href="phpkf-yonetim/uyeler.php?kip=etkisiz">tıklayın.</a><br /><br />Engellenmiş kullanıcıları görmek için <a href="phpkf-yonetim/uyeler.php?kip=engelli">tıklayın.</a>';




$lb[42] = 'E-Posta adresiniz kaydedilmiştir.<br /><br />Adres değişikliğin tamamlanması için yapmanız gerekenler<br />size gönderilen E-Postada anlatılmaktadır.';

$lb[43] = 'Şifreniz değiştirilmiştir...';

$lb[44] = 'Şifreniz ve E-Posta adresiniz kaydedilmiştir.<br /><br />Adres değişikliğin tamamlanması için yapmanız gerekenler<br />size gönderilen E-Postada anlatılmaktadır.';

$lb[45] = 'Yeni E-Posta adresiniz onaylanmış ve değiştirilmiştir.';



/**/$lb[46] = 'Özel ileti ayarlarınız güncellenmiştir.<br /><br />Geri dönmek için <a href="ozel_ileti.php?kip=ayarlar">tıklayın.</a><meta http-equiv="Refresh" content="5;url=ozel_ileti.php?kip=ayarlar">';

/**/$lb[47] = 'Forumdaki eski özel iletiler silinmiştir.<br /><br />Yönetim ana sayfasına dönmek için <a href="phpkf-yonetim/index.php">tıklayın.</a><meta http-equiv="Refresh" content="5;url=phpkf-yonetim/index.php">';

/**/$lb[48] = 'Üye başarıyla oluşturulmuştur, geri dönmek için <a href="phpkf-yonetim/yeni_uye.php">tıklayın.</a><br /><br />Üyenin profilini görmek için <a href="'.$phpkf_dosyalar['profil'].'?u='.$fno.'">tıklayın.</a><br />Üyenin profilini değiştirmek için <a href="phpkf-yonetim/uye_degistir.php?u='.$fno.'">tıklayın.</a>';

/**/$lb[49] = 'Dosya silinmiştir.<br /><br />Geri dönmek için <a href="phpkf-yonetim/forum_yuklemeler.php">tıklayın.</a>';

/**/$lb[50] = 'Dosya silinmiştir.<br /><br />Geri dönmek için <a href="'.$phpkf_dosyalar['profil_degistir'].'?kosul=yuklemeler">tıklayın.</a>';



$lb[51] = 'E-Posta adresiniz onaylanmıştır.<br /><br />Hesabınızın etkinleştirilmesi için site yöneticisinin onayını beklemelisiniz.';



/**/$lb[52] = 'Yorum silinmiştir.<br /><br />Geri dönmek için <a href="phpkf-yonetim/forum_silinmis.php">tıklayın.</a>';

/**/$lb[53] = 'Yorum başarıyla geri yüklenmiştir.<br /><br />Geri dönmek için <a href="phpkf-yonetim/forum_silinmis.php">tıklayın.</a>';

/**/$lb[54] = 'Bildirim silinmiştir.<br /><br />Geri dönmek için <a href="'.$phpkf_dosyalar['profil_degistir'].'?kosul=bildirim">tıklayın.</a>';

/**/$lb[55] = 'Takip ayarlarınız değiştirilmiştir....<br /><br />Geri dönmek için <a href="'.$phpkf_dosyalar['profil_degistir'].'?kosul=takip">tıklayın.</a>';



//--------------//


$lb[500] = 'Mesajınız alınmıştır, teşekkür ederiz.'; // 23 -> 500 yapıldı

$lb[501] = 'Yorumunuz eklenmiştir'; // 1 -> 501 yapıldı

$lb[502] = 'Yorumunuz alınmıştır, onaylandıktan sonra görünür olacaktır.'; // 2 -> 502 yapıldı

//  BİLGİ İLETİLERİ  - SONU  //









//  HATA İLETİLERİ  - BAŞI  //

// 1->501 yapıldı
$lh[1] = 'Son aramanızın üzerinden belli bir süre geçmeden yeni arama yapamazsınız !';


// 2->502 yapıldı
$lh[2] = 'Tüm alanlar boş bırakılamaz !<br />Aradığınız sözcük 3 harfden uzun olmalıdır !<br /><br />Lütfen <a href="'.$phpkf_dosyalar['arama'].'">geri</a> dönüp aramak istediğiniz sözcüğü ilgili bölüme giriniz.';


// 3->503 yapıldı
$lh[3] = 'Bu konuyu taşımaya yetkiniz yok !';


// 4->504 yapıldı
$lh[4] = 'Gönderilen kısmı boş bırakılamaz !';


// 5->505 yapıldı
$lh[5] = 'E-posta başlığı en az 3, en fazla 60 karakterden oluşmalıdır.<br /><br />E-posta içeriği en az 3 karakterden oluşmalıdır.';



$lh[6] = 'Son gönderdiğiniz iletinin üzerinden<br />{00} saniye geçmeden başka bir ileti gönderemezsiniz.';


// 7->506 yapıldı
$lh[7] = 'Hatalı kullanıcı adı !<br /><br />Göndermek istediğiniz kişiyi kontrol edip tekrar deneyiniz.';


$lh[8] = 'Lütfen E-Posta adresinizi yazınız !';


// eklendi, 40 ile aynı
$lh[9] = 'E-Posta adresiniz 100 karakterden uzun olamaz !';



$lh[10] = 'E-Posta adresiniz hatalı !';

$lh[11][0] = 'Kayıt işleminiz başarıyla tamamlanmıştır.';
$lh[11][1] = 'Fakat sunucudaki bir hatadan dolayı E-postanız gönderilememiştir !';
$lh[11][2] = 'Buradan etkinleştirme kodu başvurusunda bulunabilirsiniz.';

$lh[12] = 'Bu E-Posta adresine bağlı hesabınız zaten etkinleştirilmiş !';

$lh[13] = 'Yazdığınız E-Posta adresine ait herhangi bir kayıt bulunmamaktadır !';



/**/$lh[14] = 'Seçtiğiniz forum bölümü veritabanında bulunmamaktadır !';

/**/$lh[15] = 'Bu bölüme sadece yöneticiler girebilir !';

/**/$lh[16] = 'Bu bölüme sadece yöneticiler ve yardımcılar girebilir !';

/**/$lh[17] = 'Bu bölüme sadece, yöneticinin verdiği özel yetkilere sahip üyeler girebilir !';




$lh[18] = 'Lütfen kullanıcı adı ve şifrenizi giriniz !';

$lh[19] = 'Kullanıcı adı en az 4, en fazla 20 karakter olmalıdır !';

$lh[20] = 'Şifreniz en az 5, en fazla 20 karakter olmalıdır !';

$lh[21] = 'Beş başarısız giriş denemesi yaptınız.<br />{00} dakika boyunca hesabınız kilitlenmiştir.';

$lh[22] = 'Şifreniz Hatalı!<br />Caps Lock açık kalmış olabilir, şifrelerde büyük/küçük harf ayrımı vardır.';

$lh[23][0] = 'Hesabınız henüz etkinleştirilmemiş !<br /><br />Etkinleştirme için yapılması gerekenler gönderilen E-Postada anlatılmaktadır.';

$lh[23][1] = 'Etkinleştirme kodunu tekrar yolla';

$lh[24] = 'Hesabınız forum kurallarına uyulmadığı için engellenmiştir !';

$lh[25] = 'Çok fazla kayıt girişiminde bulundunuz. Daha sonra tekrar deneyin !';

$lh[26] = 'Tüm alanların doldurulması zorunludur !';

$lh[27] = 'Kullanıcı adında geçersiz karakterler var !<br /><br />Latin ve Türkçe harf, rakam, alt çizgi( _ ), tire ( - ), nokta ( . ) kullanılabilir.<br />Bunların dışındaki özel karakterleri ve boşluk karakterini içeremez.';

$lh[28] = 'Kullanıcı adı en az 4, en fazla 20 karakter olmalıdır !';

$lh[29] = 'Bu kullanıcı adı yasaklanmıştır, lütfen başka bir kullanıcı adı deneyin !';

$lh[30] = 'Bu E-Posta adresi yasaklanmıştır !';

$lh[31] = 'Ad Soyad alanında geçersiz karakterler var !<br /><br />Latin ve Türkçe harf, rakam, boşluk, alt çizgi( _ ), tire ( - ), nokta ( . ) kullanılabilir.<br />Bunların dışındaki özel karakterleri içeremez.';

$lh[32] = 'Ad Soyad en az 4, en fazla 30 karakter olmalıdır !';

$lh[33] = 'Yazdığınız şifreler uyuşmuyor !';

$lh[34] = 'Şifrenizde geçersiz karakterler var !<br /><br />Latin harf, rakam, alt çizgi( _ ), tire ( - ), and ( & ), nokta ( . ) kullanılabilir.<br />Bunların dışındaki özel karakterleri, Türkçe karakterleri ve boşluk karakterini içeremez.';

$lh[35] = 'Şifreniz en az 5, en fazla 20 karakter olmalıdır !';

$lh[36] = 'Geçersiz konum!';

$lh[37] = 'Geçersiz Doğum tarihi !';

$lh[38] = 'Doğum tarihinin yıl kısmı geçersiz !<br />Lütfen 1981 şeklinde 4 rakam ile yazınız.';


/**/$lh[39] = 'Silmeye çalıştığınız forumun alt forumları var. Önce alt forumlarını  silin !';


$lh[40] = 'E-Posta adresiniz 100 karakterden uzun olamaz !';

$lh[41] = 'Kayıt güvenlik sorusunun cevabı hatalı !<br /><br />Genelde buraya sadece robot programların giremeyeceği çok kolay sorular yazılır.<br /><br />Cevabı tahmin edemiyorsanız site yöneticisiyle iletişime geçin.';

$lh[42] = 'Bu kullanıcı adı kullanılmaktadır, lütfen başka bir isim deneyin !';

$lh[43] = 'Bu E-posta adresiyle daha önce kayıt yapılmıştır !';


// onay kodu hatası
//$lh[44] = '';


$lh[45] = 'Hatalı Adres !<br /><br />Lütfen kontrol edip tekrar deneyin.';


// 47 -> 46 yapıldı, 46 -> 500
$lh[46] = 'Aradığınız üye bulunamıyor !';


// 47 -> 46 yapıldı, 46 -> 500
$lh[47] = 'Seçtiğiniz konu veritabanında bulunmamaktadır !';


$lh[48] = 'Etkinleştirme kodunuzda eksik var, ya da adresi eksik kopyaladınız.<br /><br />Lütfen kontrol edip tekrar deneyiniz.<br />Yine aynı sorunla karşılaşırsanız site yöneticisine başvurun.';

$lh[49] = 'Etkinleştirme kodunuz hatalı, ya da adresi eksik kopyaladınız.<br /><br />Lütfen kontrol edip tekrar deneyiniz.<br />Yine aynı sorunla karşılaşırsanız site yöneticisine başvurun.';




/**/$lh[50] = 'Kilitli konuları değiştiremezsiniz !';

/**/$lh[51] = 'Kilitli konuların cevaplarını değiştiremezsiniz !';

/**/$lh[52] = 'Bu iletiyi değiştirmeye yetkiniz yok !';

/**/$lh[53] = 'İleti başlığı en az 3, en fazla 200 karakterden oluşmalıdır.<br /><br />İleti içeriği en az 3 karakterden oluşmalıdır.';

/**/$lh[54] = 'Bu konuyu kilitlemeye veya açmaya yetkiniz yok !';

/**/$lh[55] = 'Seçtiğiniz cevap veritabanında bulunmamaktadır !';

/**/$lh[56] = 'Bu iletiyi silmeye yetkiniz yok !';

/**/$lh[57] = 'Kilitli konulara cevap yazamazsınız !';

/**/$lh[58] = 'Bu bölüme sadece yöneticiler cevap yazabilir !';

/**/$lh[59] = 'Bu bölüme sadece yöneticiler ve yardımcılar cevap yazabilir !';

/**/$lh[60] = 'Bu bölüme sadece, yöneticinin verdiği özel yetkilere sahip üyeler cevap yazabilir !';

/**/$lh[61] = 'Site kurucusunu etkisizleştiremezsiniz !';

/**/$lh[62] = 'Aradığınız özel ileti bulunamıyor.<br />Silinmiş ya da okuma yetkiniz olmayabilir.';

/**/$lh[63] = 'Gönderilen kısmı boş bırakılamaz !';

/**/$lh[64] = 'Özel ileti başlığı en az 3, en fazla 60 karakterden oluşmalıdır.<br /><br />Özel İleti içeriği en az 3 karakterden oluşmalıdır.';

/**/$lh[65] = 'Son gönderdiğiniz iletinin üzerinden<br />{00} saniye geçmeden başka bir ileti gönderemezsiniz.';

/**/$lh[66] = 'Forumda bu isimde bir üye bulunmamaktadır.<br />Lütfen geri dönüp tekrar deneyin.';

/**/$lh[67] = 'Gönderdiğiniz kişinin Gelen Kutusu dolu olduğundan ileti gönderilemedi.';

/**/$lh[68] = 'Seçim yapmadınız !';

/**/$lh[69] = 'Bu özel iletiyi silmeye yetkiniz yok!';

/**/$lh[70] = 'Kaydedilen kutunuz dolu.<br />Boşaltmadan başka ileti kaydedemezsiniz.';

/**/$lh[71] = 'Bu iletiyi kaydetmeye yetkiniz yok!';






$lh[72] = 'Kullanıcı adı 20 karakterden uzun olamaz !';

$lh[73] = '* işaretli tüm alanların doldurulması zorunludur !';

$lh[74] = 'Doğum tarihi geçersiz !<br /><br />Lütfen tire(-)lerde dahil olmaz üzere 31-12-1985 şeklinde yazınız.';

$lh[75] = 'Web Adresiniz 100 karakterden uzun olamaz !';



/**/$lh[76] = 'Tema dizini adı, alt çizgi( _ ) ve tire ( - ) dışındaki özel karakterleri ve Türkçe karakterleri içeremez !';

/**/$lh[77] = 'Tema klasörünün adı 20 karakterden uzun olamaz !';




$lh[78] = 'İmzanız {00} karakterden uzun olamaz !';

$lh[79] = 'ICQ Numaranız 30 karakterden uzun olamaz !';

$lh[80] = 'Facebook adresiniz 100 karakterden uzun olamaz !';

$lh[81] = 'Skype Adınız 100 karakterden uzun olamaz !';

$lh[82] = 'Yahoo! Messenger Adınız 100 karakterden uzun olamaz !';

$lh[83] = 'Twitter adresiniz 100 karakterden uzun olamaz !';

$lh[84] = 'Yüklemeye çalıştığınız resim bozuk !';

$lh[85] = 'Sadece jpeg, gif veya png resimleri yüklenebilir !<br />Eğer dosyanız doğru tipte ise bozuk olabilir.';

$lh[86] = 'Yüklemeye çalıştığınız resim {00} kilobayt`dan büyük olamaz !';

$lh[87] = 'Yüklemeye çalıştığınız resmin boyutları {00}`den büyük olamaz !';

$lh[88] = 'Dosya yüklenemedi !<br /><br />Yöneticiyseniz FTP programınızdan /phpkf-dosyalar/resimler/yuklenen/<br />dizinine yazma hakkı vermeyi (chmod 777) deneyin.';

$lh[89] = 'Uzak resim, kontrol edilirken bir sorunla karşılaşıldı.<br />Sunucunun uzak dosya erişimi kapatılmış olabilir ya da<br />adreste veya resim dosyasında bir sorun olabilir.';

$lh[90] = 'Eklemeye çalıştığınız resim {00} kilobayt`dan büyük olamaz !';

$lh[91] = 'Eklemeye çalıştığınız resmin boyutları {00}`den büyük olamaz !';

$lh[92] = 'E-Posta Adresini Göster, Doğum Tarihini Göster, Şehir Göster ve<br />Çevrimiçi Durumunu Göster ayarları sadece açık-kapalı değeri alabilir !';

$lh[93] = 'Bu E-posta adresi başka bir kullanıcıya aittir !';

$lh[94] = 'YETKİNİZ YOK !!!';


/**/$lh[95] = 'Buradaki yazıları ancak forum üzerinden okuyabilirsiniz.';


$lh[96] = 'Yeni Şifre kodunuz hatalı, ya da adresi eksik kopyaladınız.<br />Lütfen kontrol edip tekrar deneyiniz.<br />Yine aynı sorunla karşılaşırsanız site yöneticisine başvurun.';

$lh[97] = 'Çok fazla girişiminde bulundunuz. Daha sonra tekrar deneyin !';



// 98 -> 507 yapıldı
/**/$lh[98] = 'Tüm alanları doldurmalısınız! <i>(SMTP sunucusu ayarları hariç)</i>';


// 99 -> 508 yapıldı // onay kodu hatası
/**/$lh[99] = 'Sayfa başlığı 100 karakterden uzun olamaz !';


// 100 -> 510 yapıldı
/**/$lh[100] = 'Alan adı 100 karakterden uzun olamaz !';


// 101 -> 511 yapıldı
/**/$lh[101] = 'Dizin adı 100 karakterden uzun olamaz !';


// 102 -> 509 yapıldı
/**/$lh[102] = 'Konu ve cevap sayısı alanlarına en fazla 99 değerini girebilirsiniz !';


/**/$lh[103] = 'Konu ve cevap sayısı alanları sadece rakamdan oluşabilir !';

/**/$lh[104] = 'Çerez geçerlilik süresi sadece rakamdan oluşabilir !';

/**/$lh[105] = 'Çerez geçerlilik süreleri en fazla 5 rakamdan oluşabilir !<br /><br />Yani en fazla 99`999 dakika değerini alabilir ki bu da 69 gün eder.';

/**/$lh[106] = 'İki ileti arası bekleme süresi sadece rakamdan oluşabilir !';

/**/$lh[107] = 'İki ileti arası bekleme süresi en fazla 86`400 saniye alabilir ki bu da 24 saat eder.';

/**/$lh[108] = 'Hesap kilit süresi sadece rakamdan oluşabilir !';

/**/$lh[109] = 'Beş başarısız girişten sonra hesabın kilitli kalacağı süre<br />en fazla 1440 dakika olabilir ki bu da 24 saat eder.';

/**/$lh[110] = 'Kayıt sorusu açık kapalı ayarları sadece açık-kapalı değeri alabilir !';

/**/$lh[111] = 'Kayıt sorusu ve cevabı 100 karakterden uzun olamaz !';

/**/$lh[112] = 'İmza uzunluğu 1 ila 500 arası olabilir !';

/**/$lh[113] = 'Tarih biçimi en fazla 20 karakter olabilir !';

/**/$lh[114] = 'Zaman dilimi 1 ila  4 karakter arası olabilir !';

/**/$lh[115] = 'Hatalı forum rengi !';

/**/$lh[116] = 'Hesap Etkinleştirme ayarı sadece kapalı, kullanıcı ve yönetici değerlerini alabilir !';

/**/$lh[117] = 'BBCode, Özel ileti ve Güncel Konular ayarları sadece açık-kapalı değeri alabilir !';

/**/$lh[118] = 'Gösterilecek güncel konu sayısı ayarı sadece rakamdan oluşabilir !';

/**/$lh[119] = 'Gösterilecek güncel konu sayısı ayarı 50`den fazla olamaz !';

/**/$lh[120] = 'Site kurucusu adı 100 karakterden uzun olamaz !';

/**/$lh[121] = 'Forum yöneticisi adı 100 karakterden uzun olamaz !';

/**/$lh[122] = 'Forum yardımcısı adı 100 karakterden uzun olamaz !';

/**/$lh[123] = 'Kayıtlı kullanıcı adı 100 karakterden uzun olamaz !';

/**/$lh[124] = 'Gelen, ulaşan ve kaydedilen kutusu kota değerleri en fazla 3 rakamdan oluşabilir !<br /><br />Yani en fazla 999 değerini alabilir.';

/**/$lh[125] = 'Gelen, ulaşan ve kaydedilen kutusu kota değerleri sadece rakamdan oluşabilir !';

/**/$lh[126] = 'Resim yükleme özelliği sadece açık-kapalı değeri alabilir !';

/**/$lh[127] = 'Uzak resim özelliği sadece açık-kapalı değeri alabilir !';

/**/$lh[128] = 'Resim galerisi özelliği sadece açık-kapalı değeri alabilir !';

/**/$lh[129] = 'Resim dosyasının büyüklüğü 1 ila 999 kb. arası olabilir !';

/**/$lh[130] = 'Resim boyutu en büyük 999 x 999 arası olabilir !';

/**/$lh[131] = 'Yönetici E-Posta adresi 100 karakterden uzun olamaz !';

/**/$lh[132] = 'E-Posta yöntemi sadece mail, sendmail ve smtp değerlerini alabilir !';

/**/$lh[133] = 'SMTP kimlik doğrulaması alanı sadece true ve false değerlerini alabilir !';

/**/$lh[134] = 'SMTP sunucu adresi 100 karakterden uzun olamaz !';

/**/$lh[135] = 'SMTP kullanıcı adı 100 karakterden uzun olamaz !';

/**/$lh[136] = 'SMTP şifresi 100 karakterden uzun olamaz !';

/**/$lh[137] = 'Site kurucusunu silemezsiniz !';

/**/$lh[138] = 'Bir hata oluştu ya da sayfaya doğrudan erişmeye çalışıyorsunuz.<br />Yapmak istediğiniz işlemi <a href="phpkf-yonetim/forumlar.php">Forum Yönetimi</a> sayfasından seçiniz.';

/**/$lh[139] = 'Seçtiğiniz forum dalı veritabanında bulunmamaktadır !';

/**/$lh[140] = 'Forum dalı başlığını girmeyi unuttunuz !';

/**/$lh[141] = 'Forum başlığını girmeyi unuttunuz !';

/**/$lh[142] = 'Taşımak istediğniz forum dalını seçmeyi unuttunuz.<br /><br />Lütfen geri dönüp tekrar deneyin.';

/**/$lh[143] = 'Taşımak istediğniz forumu seçmeyi unuttunuz.<br /><br />Lütfen geri dönüp tekrar deneyin.';




$lh[144] = 'Yönetim yetkiniz yok !';




/**/$lh[145] = '<a href="phpkf-yonetim/uyeler.php">Bu sayfadan</a> istediğiniz üyenin kullanıcı adını tıklayın.<br /><br />Açılan "Kullanıcı Profilini Değiştir" sayfasındaki, Diğer Yetkiler bağlantısını tıklayın.<br /><br />Açılan sayfadan özel yetki vermek istediğiniz forumu seçerek kullanıcıya istediğiniz özel yetkiyi verebilirsiniz.';

/**/$lh[146] = 'Seçtiğiniz forumun yetkisi sadece yöneticilere verilmiş.<br />Özel bir üyeye izin veremezsiniz !';

/**/$lh[147] = 'Site kurucusunun bilgilerini buradan değişteremezsiniz !';

/**/$lh[148] = 'Yetki alanı verisi geçersiz !';

/**/$lh[149] = 'Site kurucusunu engelleyemezsiniz !';

/**/$lh[150] = 'Varsayılan tema seçeneklerden kaldırılamaz !';

/**/$lh[151] = 'Bu sayfaya sadece site kurucusu girebilir.';

/**/$lh[152] = 'Forum seçmeyi unuttunuz !';

/**/$lh[153] = 'Gün alanına 1 ila 999 arasında bir sayı girmelisiniz.';

/**/$lh[154] = 'Seçmiş olduğunuz grupta hiçbir üye bulunmamaktadır !';

/**/$lh[155] = 'Sunucunuz sıkıştırılmış dosya oluşturulmasını desteklemiyor !';

/**/$lh[156] = 'Dosya Yüklenemedi, Dosya adı alınamadı !<br /><br />Bunun nedeni dosyanın 2mb.`dan büyük olması ya da<br />dosya adının kabul edilemeyen karakterler içermesi olabilir.<br /><br />Yedeği tablo tablo ayrı dosyalara bölmeyi deneyin veya dosya adını değiştirmeyi deneyin.';

/**/$lh[157] = '2mb.`dan büyük yedek yükleyemezsiniz.<br />Yedeği tablo tablo ayrı dosyalara bölmeyi deneyin.';

/**/$lh[158] = 'Sunucunuz sıkıştırılmış dosya yüklemesini desteklemiyor !';

/**/$lh[159] = 'Sadece .sql ve .gz uzantılı dosyalar yüklenebilir !';

/**/$lh[160] = 'BBCode, Özel ileti, Forum durumu, Portal kullanımı, Kayıt Onay Kodu, SEO,<br />Üye Alımı, Boyutlandırma, Güncel Konular, Bölüm ve Konu görüntüleyenler<br />ayarları sadece açık-kapalı değeri alabilir !';

/**/$lh[161] = 'Seçtiğiniz bölüm kapatılmış.<br />Özel bir üyeye izin veremezsiniz !';

/**/$lh[162] = 'Çevrimiçi süresi sadece rakamdan oluşabilir !';

/**/$lh[163] = 'Çevrimiçi süresi için en fazla 99 dakika değerini girebilirsiniz !';

/**/$lh[164] = 'Bu bölüm kapatılmıştır !';

/**/$lh[165] = 'Bu bölüme sadece yöneticiler konu açabilir !';

/**/$lh[166] = 'Bu bölüme sadece yöneticiler ve yardımcılar konu açabilir !';

/**/$lh[167] = 'Bu bölüme sadece, yöneticinin verdiği özel yetkilere sahip üyeler konu açabilir !';

/**/$lh[168] = 'Bu konu daha önceden geri yüklenmiş veya silinmemiş !';

/**/$lh[169] = 'Bu cevap daha önceden geri yüklenmiş veya silinmemiş !';

/**/$lh[170] = 'Bu konuyu üst veya alt konu yapmaya yetkiniz yok !';

/**/$lh[171] = 'Kurmaya çalıştığınız eklentinin adında kabul edilmeyen karakterler var !';

/**/$lh[172] = '/eklentiler dizinine yazılamıyor !<br /><br />Eklenti kurulumu için bu dizine yazma hakkı (chmod 777) vermelisiniz.';

/**/$lh[173] = 'Belirtilen eklenti dosyası bulunamıyor !<br /><br />Tıkladığınız adresi kontrol edip tekrar deneyin.';

/**/$lh[174] = 'Bu eklenti zaten kurulu !';




$lh[175] = 'Sunucudaki bir hatadan dolayı onay E-Postası gönderilememiştir !<br /><br />Lütfen daha sonra tekrar deneyin ve durumu yöneticiye bildirin.';




/**/$lh[176] = 'Bu üye kimseden özel ileti kabul etmiyor !';

/**/$lh[177] = 'Bu üye sizden özel ileti kabul etmiyor !';

/**/$lh[178] = 'Bu üye forumdan uzaklaştırılmış !';

/**/$lh[179] = 'Bu üyenin hesabı henüz etkinleştirilmemiş !';

/**/$lh[180] = 'Tarayıcınız çerez kabul etmiyor !<br />Tarayıcınızın çerez özelliği kapalı veya desteklemiyor olabilir.<br /><br />Giriş yapabilmeniz için çerez özelliği gereklidir.<br />Çerezlere izin verin veya başka bir tarayıcıda tekrar deneyin.';

/**/$lh[181] = 'Sadece yöneticiler güncelleme yapabilir !<br /><br />Yönetici olarak giriş yapıp tekrar deneyin.';

/**/$lh[182] = 'Bu eklenti kurulu değil !';

/**/$lh[183] = 'Bu eklenti zaten etkin !';

/**/$lh[184] = 'Bu eklenti zaten etkisiz !';

/**/$lh[185] = 'Bu eklenti kullandığınız sürüm ile uyumsuz görünüyor !';





$lh[186] = 'Ad Soyad alanına girdiğiniz isim yasaklanmıştır !';


/**/$lh[187] = 'Kurulu eklentileri silemezsiniz !<br />Önce eklentiyi kaldırıp sonra silmeyi deneyin.';


$lh[188] = 'Şifreniz yanlış !';





/**/$lh[189] = 'Kurmaya çalıştığınız eklenti portal için fakat sitenizde portal kurulu değil !';

/**/$lh[190] = 'Hatalı ip adresi !';

/**/$lh[191] = 'Bölüm yardımcısı adı 100 karakterden uzun olamaz !';

/**/$lh[192] = 'Bu bölüm konu açmaya kapatılmıştır !';

/**/$lh[193] = 'Bu bölüm cevap yazmaya kapatılmıştır !';

/**/$lh[194] = 'Seçtiğiniz bölümün yetkisi sadece yönetici ve yardımcılara verilmiş.<br />Özel bir üyeye izin veremezsiniz !';

/**/$lh[195] = 'Konuyu taşıdığınız bölümde yetkiniz yok !';

/**/$lh[196] = 'Bu tema kullandığınız sürüm ile uyumsuz görünüyor !';

/**/$lh[197] = 'Seçeneklerde olmayan bir tema varsayılan olarak ayarlanamaz !<br />Temayı önce seçenekler arasına ekleyin.';




$lh[198][0] = 'Kayıt işleminiz başarıyla tamamlanmıştır.';
$lh[198][1] = 'Fakat sunucudaki bir hatadan dolayı E-postanız gönderilememiştir !';

$lh[199] = 'Hesabınızın etkinleştirilmesi için site yöneticisinin onayını beklemelisiniz.';





/**/$lh[200] = 'Bu eklenti etkisizleştirmeyi desteklemiyor !';

/**/$lh[201] = 'Grup adında karakterler var !<br /><br />Latin ve Türkçe harf, rakam, boşluk, alt çizgi( _ ), tire ( - ), nokta ( . ) kullanılabilir. <br />Bunların dışındaki özel karakterleri içeremez.';

/**/$lh[202] = 'Grup adı en az 4, en fazla 30 karakter olmalıdır !';

/**/$lh[203] = 'Bu grup adı kullanılmaktadır, başka bir ad deneyin !';

/**/$lh[204] = 'Forumda böyle bir grup bulunmamaktadır !';

/**/$lh[205] = 'Grubun bölüm yardımcılığı yetkisini değiştirmek için önce<br /><a href="phpkf-yonetim/ozel_izinler.php">özel izinler</a> sayfasında görünen bölüm yönetme izinlerini alın !';

/**/$lh[206] = 'Aradığınız dosya bulunamıyor.<br />Dosya daha önceden silinmiş olabilir. Lütfen kontrol edip tekrar deneyin.';





$lh[207] = 'Sitede bu isimde bir üye bulunmamaktadır !<br />Kullanıcı adını yanlış girmiş olabilirsiniz.';

$lh[208] = 'Kullanıcı adı olarak E-posta adresi kullanılmamaktadır !<br /><br />Lütfen kayıt olurken yazdığınız kullanıcı adını giriniz.';



/**/$lh[209] = 'Seçtiğiniz yorum veritabanında bulunmamaktadır !';

/**/$lh[210] = 'Bu yorum daha önceden geri yüklenmiş veya silinmemiş !';

/**/$lh[211] = 'Hesap etkinleştirmesi sadece yöneticiler tarafından yapılmaktadır !<br ><br />Hesabınızın etkinleştirilmesi için site yöneticisinin onayını beklemelisiniz.'; // yeni



/**/$lh[220] = 'Aradığınız dosya bulunamıyor.<br />Dosya daha önceden silinmiş olabilir. Lütfen kontrol edip tekrar deneyin.';




$lh[221] = 'Hesabınızın etkinleştirilmesi için site yöneticisinin onayını beklemelisiniz.'; // yeni

$lh[223] = 'Hesabınız henüz etkinleştirilmemiş !<br /><br />Hesabınızın etkinleştirilmesi için önce size gönderilen E-Postadaki<br />bağlantıyı tıklayın daha sonra yöneticinin onayını bekleyin.'; // yeni

$lh[224] = 'Hakkında bilgisi 1000 karakterden uzun olamaz !';



//--------------//



$lh[500] = 'Ana sayfa dosyası bulunamıyor !<br /><br />Girilen dosya adı'; // 46 -> 500

$lh[501] = 'Aradığınız sayfa bulunamıyor !'; // 1->501

$lh[502] = 'Ad, Soyad girilmedi !'; // 2->502

$lh[503] = 'E-posta adresi girilmedi !'; // 3->503

$lh[504] = 'Yorum yazmayı unuttunuz !'; // 4->504

$lh[505] = 'FORM BOŞ !'; // 5->505

$lh[506] = 'Ana sayfa yazısı bulunmamaktadır !'; // 7->506

$lh[507] = 'Mesaj alanı 10 karakterden kısa olamaz !'; // 98->507

//$lh[508] = ''; // 99->508

$lh[509] = '"Başlık - Konu" alanında geçersiz karakterler var !<br /><br />Latin ve Türkçe harf, rakam, boşluk, alt çizgi( _ ), tire ( - ), nokta ( . ) kullanılabilir.<br />Bunların dışındaki özel karakterleri içeremez.'; // 100->509

$lh[510] = '"Başlık - Konu" en az 4, en fazla 100 karakter olmalıdır !'; // 101 -> 510


//  HATA İLETİLERİ  - SONU  //








//  UYARI İLETİLERİ  - BAŞI  //


$lu[1] = 'Sürüm güncellemesi yapılmış !';

$lu[2] = 'Özel İleti hizmeti kapatılmıştır !';



/**/$lu[3] = 'Seçtiğiniz kullanıcı bir yönetici !<br />Yöneticilerin yetkileri sınırsızdır.';

/**/$lu[4] = 'Seçtiğiniz kullanıcı forum yardımcısı !<br />Forum yardımcıları tüm forum bölümleri üzerinde yetki sahibidir.';

/**/$lu[5] = 'Konuyu ve altındaki tüm cevapları silmek istediğinize emin misiniz ?<br /><br /><a href="phpkf-bilesenler/mesaj_sil.php?onay=kabul&amp;kip=mesaj&amp;fno='.$fno.'&amp;mesaj_no='.$mesaj_no.'&amp;o='.$go.'&amp;fsayfa='.$fsayfa.'">Evet</a> &nbsp; - &nbsp; <a href="konu.php?k='.$mesaj_no.$fs.'">Hayır</a>';



$lu[6] = 'Bu sayfaya sadece üyeler girebilir !';



/**/$lu[7] = 'Cevabı silmek istediğinize emin misiniz ?<br /><br /><a href="phpkf-bilesenler/mesaj_sil.php?onay=kabul&amp;kip=cevap&amp;mesaj_no='.$mesaj_no.'&amp;cevap_no='.$cevap_no.'&amp;o='.$go.'&amp;fsayfa='.$fsayfa.'&amp;sayfa='.$sayfa.'">Evet</a> &nbsp; - &nbsp; <a href="konu.php?k='.$mesaj_no.$ks.$fs.'">Hayır</a>';



$lu[8] = 'Herhangi bir değişiklik yapmadınız.';

$lu[9] = 'Üye alımı geçici bir süre için durdurulmuştur !';

/**/$lu[10] = 'Bu konu henüz onaylanmamış!<br />Onaylanmamış konuları sadece üyeler görebilir !'; //yeni


//  UYARI İLETİLERİ  - SONU  //

?>