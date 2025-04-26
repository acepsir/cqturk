<?php
// phpKF v3.00
// Hata Sayfası
// İngilizce Dil Dosyası



// Tekrar Eden Başlık ve Linkler
$lh['hata_iletisi'] = 'رسالة خطأ';
$lh['bilgi_iletisi'] = 'رسالة معلومات';
$lh['uyari_iletisi'] = 'رسالة تحذير';
$lh['hatali_adres'] = 'عنوان خاطئ!';
$lh['tikla_geri1'] = 'انقر للعودة.';
$lh['tikla_geri2'] = 'انقر للعودة.';
$lh['tikla_geri3'] = 'الرجاء العودة والمحاولة مجددا.';
$lh['tikla_giris'] = 'انقر لتسجيل الدخول.';
$lh['tikla_hatirla1'] = 'انقر إذا كنت لا تتذكر كلمة المرور.';
$lh['tikla_hatirla2'] = 'انقر إذا كنت لا تتذكر كلمة المرور.';
$lh['tikla_kayit'] = 'انقر للتسجيل.';
$lh['tikla_anasayfa'] = 'انقر للذهاب إلى الصفحة الرئيسية.';
$lh['tikla_profil'] = 'انقر لرؤية ملف التعريف الخاص بك.';
$lh['onay_kodu_hatali'] = 'رمز التأكيد غير صحيح!';
$lh['spam_kutusu'] = 'تحقق من أن صناديق البريد الخاصة بك قد سقطت في صندوق البريد العشوائي.';
$lu['giris_yap'] = 'تسجيل الدخول';
$lu['uye_ol'] = 'سجل';
$lu['facebook_giris'] = 'يمكنك تسجيل الدخول باستخدام حساب Facebook.';




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



$lb[10] = 'Your profile has been updated ...';



/**/$lb[11] = 'Özel iletiniz gönderilmiştir.<br /><br />Gönderilen kutusuna gitmek için <a href="ozel_ileti.php?kip=gonderilen">tıklayın.</a><meta http-equiv="Refresh" content="5;url=ozel_ileti.php?kip=gonderilen"><br /><br />Yazdığınız özel iletiyi görmek için <a href="oi_oku.php?oino='.$cevap_no.'#hzlcvp">tıklayın.</a>';

/**/$lb[12] = 'Forum ayarlarınız güncellenmiştir.<br /><br />Yönetim ana sayfasına dönmek için <a href="phpkf-yonetim/index.php">tıklayın.</a><meta http-equiv="Refresh" content="5;url=phpkf-yonetim/index.php">';

/**/$lb[13] = 'E-Postanız Gönderilmiştir...<br /><br /><a href="'.$phpkf_dosyalar['forum'].'">'.$lh['tikla_anasayfa'].'</a>';



$lb[14] = 'Your activation code has been completed.<br /><br />You can activate your account by clicking on the link in the Email you received.';

$lb[15] = 'Your registration has been completed successfully.';

$lb[16] = 'Your registration has been completed successfully.<br /><br />What you need to do to activate your account is described in the email you sent.';



/**/$lb[17] = 'Kayıt işleminiz başarıyla tamamlanmıştır.<br /><br />Hesabınızın etkinleştirilmesi için forum yöneticisinin onayını beklemelisiniz.';



$lb[18] = 'Your account is already activated.';

$lb[19] = 'Your account has been activated.';

$lb[20] = 'Your new password has been applied.<br /><br />What you need to do to reset your password is described in the email you sent.';

$lb[21][0] = 'Your new password has been created.';
$lb[21][1] = 'Click to log in with your new password.';

$lb[22] = 'Your New Password application has been canceled. Your old ciphers are still valid.';



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




$lb[42] = 'Your email address has been saved.<br /><br />What you need to do to complete your address change is in the email you sent.';

$lb[43] = 'Your password has been changed ...';

$lb[44] = 'Your password and your email address have been saved.<br /><br />What you need to do to complete your address change is in the email you sent.';

$lb[45] = 'Your new email address has been approved and has been changed.';



/**/$lb[46] = 'Özel ileti ayarlarınız güncellenmiştir.<br /><br />Geri dönmek için <a href="ozel_ileti.php?kip=ayarlar">tıklayın.</a><meta http-equiv="Refresh" content="5;url=ozel_ileti.php?kip=ayarlar">';

/**/$lb[47] = 'Forumdaki eski özel iletiler silinmiştir.<br /><br />Yönetim ana sayfasına dönmek için <a href="phpkf-yonetim/index.php">tıklayın.</a><meta http-equiv="Refresh" content="5;url=phpkf-yonetim/index.php">';

/**/$lb[48] = 'Üye başarıyla oluşturulmuştur, geri dönmek için <a href="phpkf-yonetim/yeni_uye.php">tıklayın.</a><br /><br />Üyenin profilini görmek için <a href="'.$phpkf_dosyalar['profil'].'?u='.$fno.'">tıklayın.</a><br />Üyenin profilini değiştirmek için <a href="phpkf-yonetim/uye_degistir.php?u='.$fno.'">tıklayın.</a>';

/**/$lb[49] = 'Dosya silinmiştir.<br /><br />Geri dönmek için <a href="phpkf-yonetim/forum_yuklemeler.php">tıklayın.</a>';

/**/$lb[50] = 'Dosya silinmiştir.<br /><br />Geri dönmek için <a href="'.$phpkf_dosyalar['profil_degistir'].'?kosul=yuklemeler">tıklayın.</a>';



$lb[51] = 'Your email address is confirmed.<br /><br />You must wait for the site administrator`s approval to activate your account.';



/**/$lb[52] = 'Yorum silinmiştir.<br /><br />Geri dönmek için <a href="phpkf-yonetim/forum_silinmis.php">tıklayın.</a>';

/**/$lb[53] = 'Yorum başarıyla geri yüklenmiştir.<br /><br />Geri dönmek için <a href="phpkf-yonetim/forum_silinmis.php">tıklayın.</a>';

/**/$lb[54] = 'Bildirim silinmiştir.<br /><br />Geri dönmek için <a href="'.$phpkf_dosyalar['profil_degistir'].'?kosul=bildirim">tıklayın.</a>';

/**/$lb[55] = 'Takip ayarlarınız değiştirilmiştir....<br /><br />Geri dönmek için <a href="'.$phpkf_dosyalar['profil_degistir'].'?kosul=takip">tıklayın.</a>';



//--------------//


$lb[500] = 'تم استلام رسالتك ، شكرا لك.'; // 23 -> 500 yapıldı

$lb[501] = 'تمت إضافة تعليقك'; // 1 -> 501 yapıldı

$lb[502] = 'تم استلام تعليقك وسيظهر بعد تأكيده.'; // 2 -> 502 yapıldı

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



$lh[6] = 'You can not post another comment after<br />{00} seconds past the last comment you posted.';


// 7->506 yapıldı
$lh[7] = 'Hatalı kullanıcı adı !<br /><br />Göndermek istediğiniz kişiyi kontrol edip tekrar deneyiniz.';


$lh[8] = 'Please enter your email address!';


// eklendi, 40 ile aynı
$lh[9] = 'Your email address can not be longer than 100 characters!';



$lh[10] = 'Your email address is incorrect!';

$lh[11][0] = 'Your registration has been completed successfully.';
$lh[11][1] = 'But your email could not be sent because of a server error!';
$lh[11][2] = 'You can find it here in the activation code reference.';

$lh[12] = 'Your account linked to this email address has already been activated!';

$lh[13] = 'Your email address does not exist!';



/**/$lh[14] = 'Seçtiğiniz forum bölümü veritabanında bulunmamaktadır !';

/**/$lh[15] = 'Bu bölüme sadece yöneticiler girebilir !';

/**/$lh[16] = 'Bu bölüme sadece yöneticiler ve yardımcılar girebilir !';

/**/$lh[17] = 'Bu bölüme sadece, yöneticinin verdiği özel yetkilere sahip üyeler girebilir !';




$lh[18] = 'Please enter your username and password!';

$lh[19] = 'Username must be at least 4, at most 20 characters!';

$lh[20] = 'The password must be at least 5, at most 20 characters!';

$lh[21] = 'You did five unsuccessful login attempts.<br />Your account has been locked for {00} minutes.';

$lh[22] = 'Your password is wrong!<br />Caps Lock can be on, passwords are case sensitive.';

$lh[23][0] = 'Your account has not yet been activated!<br /><br />What you need to do to activate your account is described in the email you sent.';

$lh[23][1] = 'Resend activation code';

$lh[24] = 'Your account has been banned!';

$lh[25] = 'You are attempting to register too many times. Try again later!';

$lh[26] = 'Filling out all fields is mandatory!';

$lh[27] = 'Invalid characters in username!<br /><br />Latin and Turkish letters, digits, underscores ( _ ), hyphens ( - ), periods ( . ) Can be used.<br />They can not contain any special characters and space characters outside them.';

$lh[28] = 'Username must be at least 4, at most 20 characters!';

$lh[29] = 'This username is forbidden, please try another username!';

$lh[30] = 'This e-mail address is forbidden!';

$lh[31] = 'Invalid characters in Name Last Name field!<br /><br />Latin and Turkish letters, digits, spaces, underscores ( _ ), hyphens ( - ), periods ( . ) Can be used.<br />They can not contain special characters outside of them.';

$lh[32] = 'Name Last Name must be at least 4, at most 30 characters!';

$lh[33] = 'The passwords do not match!';

$lh[34] = 'There are invalid characters in the password!<br /><br />Latin letters, digits, underscores ( _ ), hyphens ( - ), and ( & ), periods ( . ) can be used.<br />Special characters outside them can not contain Turkish characters and spaces.';

$lh[35] = 'The password must be at least 5, at most 20 characters!';

$lh[36] = 'Invalid location!';

$lh[37] = 'Invalid Birth date!';

$lh[38] = 'The year part of the date of birth is invalid!<br />Please write in 4 numbers in the form of 1981.';


/**/$lh[39] = 'Silmeye çalıştığınız forumun alt forumları var. Önce alt forumlarını  silin !';


$lh[40] = 'Your email address can not be longer than 100 characters!';

$lh[41] = 'The answer to the record security question is incorrect!<br /><br />In general, here are some very easy questions that only bot script can enter.<br /><br />If you can not guess the answer, contact the site administrator.';

$lh[42] = 'This username is used, please try another name!';

$lh[43] = 'This email has already been registered with!';


// onay kodu hatası
//$lh[44] = '';


$lh[45] = 'Wrong Address!<br /><br />Please check and try again.';


// 47 -> 46 yapıldı, 46 -> 500
$lh[46] = 'The member you are looking for is not found!';


// 47 -> 46 yapıldı, 46 -> 500
$lh[47] = '';


$lh[48] = 'Your activation code is missing, or you have incompletely copied the address.<br /><br />Please check and try again.<br />If you encounter the same problem again, contact the site administrator.';

$lh[49] = 'Your activation code is incorrect, or you`ve copied the address incorrectly.<br /><br />Please check and try again.<br />If you encounter the same problem again, contact the site administrator.';




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






$lh[72] = 'User name can not be longer than 20 characters!';

$lh[73] = '* marked all fields are required!';

$lh[74] = 'Birth date is invalid!<br /><br />Please write 31-12-1985, not including hyphens ( - ).';

$lh[75] = 'Your Web address can not be longer than 100 characters!';



/**/$lh[76] = 'Tema dizini adı, alt çizgi( _ ) ve tire ( - ) dışındaki özel karakterleri ve Türkçe karakterleri içeremez !';

/**/$lh[77] = 'Tema klasörünün adı 20 karakterden uzun olamaz !';




$lh[78] = 'Your signature can not be longer than {00} characters!';

$lh[79] = 'Your ICQ Number can not be longer than 30 characters!';

$lh[80] = 'Your Facebook address can not be longer than 100 characters!';

$lh[81] = 'Your Skype Name can not be longer than 100 characters!';

$lh[82] = 'Your Yahoo! Messenger Name can not be longer than 100 characters!';

$lh[83] = 'Your Twitter address can not be longer than 100 characters!';

$lh[84] = 'The image you tried to load is corrupted!';

$lh[85] = 'Only jpeg, gif or png images can be uploaded!<br />If your file is the correct type, it may be corrupted.';

$lh[86] = 'The picture you try to upload can not be larger than {00} kb';

$lh[87] = 'The size of the image you try to upload can not be bigger than {00}';

$lh[88] = 'The file could not be uploaded!<br /><br />As an administrator, try to give the FTP program the right to write to the<br />/phpkf-dosyalar/resimler/yuklenen/ directory (chmod 777).';

$lh[89] = 'Remote image encountered a problem while checking.<br />The remote file access of the server may be turned off or<br />there may be a problem with the address or image file.';

$lh[90] = 'The picture you are trying to add can not be bigger than {00} kb';

$lh[91] = 'The size of the images you are trying to insert can not be bigger than {00}';

$lh[92] = 'Show E-Mail Address, Show Birth Date, Show City, and Show Online Status settings can only have open-close values!';

$lh[93] = 'This e-mail address belongs to another user!';

$lh[94] = 'NO AUTHORIZATION !!!';


/**/$lh[95] = 'Buradaki yazıları ancak forum üzerinden okuyabilirsiniz.';


$lh[96] = 'Your new password code is incorrect, or you have copied the address incomplete.<br />Please check and try again.<br />If you encounter the same problem again, contact the site administrator.';

$lh[97] = 'You are making too many attempts. Try again later!';



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




$lh[144] = 'No Authorization!';




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




$lh[175] = 'The confirmation E-mail has not been sent due to a server error!<br /> <br />Please try again later and report the situation to the manager.';




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





$lh[186] = 'The name you entered in the Last Name field is forbidden!';


/**/$lh[187] = 'Kurulu eklentileri silemezsiniz !<br />Önce eklentiyi kaldırıp sonra silmeyi deneyin.';


$lh[188] = 'Wrong password !';





/**/$lh[189] = 'Kurmaya çalıştığınız eklenti portal için fakat sitenizde portal kurulu değil !';

/**/$lh[190] = 'Hatalı ip adresi !';

/**/$lh[191] = 'Bölüm yardımcısı adı 100 karakterden uzun olamaz !';

/**/$lh[192] = 'Bu bölüm konu açmaya kapatılmıştır !';

/**/$lh[193] = 'Bu bölüm cevap yazmaya kapatılmıştır !';

/**/$lh[194] = 'Seçtiğiniz bölümün yetkisi sadece yönetici ve yardımcılara verilmiş.<br />Özel bir üyeye izin veremezsiniz !';

/**/$lh[195] = 'Konuyu taşıdığınız bölümde yetkiniz yok !';

/**/$lh[196] = 'Bu tema kullandığınız sürüm ile uyumsuz görünüyor !';

/**/$lh[197] = 'Seçeneklerde olmayan bir tema varsayılan olarak ayarlanamaz !<br />Temayı önce seçenekler arasına ekleyin.';




$lh[198][0] = 'Your registration has been completed successfully.';
$lh[198][1] = 'But your email could not be sent because of a server error!';

$lh[199] = 'You must wait for the site administrator`s approval to activate your account.';





/**/$lh[200] = 'Bu eklenti etkisizleştirmeyi desteklemiyor !';

/**/$lh[201] = 'Grup adında karakterler var !<br /><br />Latin ve Türkçe harf, rakam, boşluk, alt çizgi( _ ), tire ( - ), nokta ( . ) kullanılabilir. <br />Bunların dışındaki özel karakterleri içeremez.';

/**/$lh[202] = 'Grup adı en az 4, en fazla 30 karakter olmalıdır !';

/**/$lh[203] = 'Bu grup adı kullanılmaktadır, başka bir ad deneyin !';

/**/$lh[204] = 'Forumda böyle bir grup bulunmamaktadır !';

/**/$lh[205] = 'Grubun bölüm yardımcılığı yetkisini değiştirmek için önce<br /><a href="phpkf-yonetim/ozel_izinler.php">özel izinler</a> sayfasında görünen bölüm yönetme izinlerini alın !';

/**/$lh[206] = 'Aradığınız dosya bulunamıyor.<br />Dosya daha önceden silinmiş olabilir. Lütfen kontrol edip tekrar deneyin.';





$lh[207] = 'There is no member on the site by this name!<br />You may have entered the username incorrectly.';

$lh[208] = 'Email address is not used as user name!<br /><br />Please enter the username that you wrote down while registering.';



/**/$lh[209] = 'Seçtiğiniz yorum veritabanında bulunmamaktadır !';

/**/$lh[210] = 'Bu yorum daha önceden geri yüklenmiş veya silinmemiş !';

/**/$lh[211] = 'Account activation is performed only by administrators!<br ><br />You must wait for the site administrator`s approval to activate your account.'; // yeni



/**/$lh[220] = 'Aradığınız dosya bulunamıyor.<br />Dosya daha önceden silinmiş olabilir. Lütfen kontrol edip tekrar deneyin.';




$lh[221] = 'You must wait for the site administrator`s approval to activate your account.'; // yeni

$lh[223] = 'Your account has not yet been activated!<br /><br />To activate your account, click the link in the E-mail that was sent to you first,<br />then wait for the administrator`s confirmation.'; // yeni

$lh[224] = 'The information about it can not be longer than 1000 characters!';



//--------------//



$lh[500] = 'لم يتم العثور على ملف الصفحة الرئيسية! <br /> <br /> تم إدخال اسم الملف'; // 46 -> 500

$lh[501] = 'الصفحة غير موجودة!'; // 1->501

$lh[502] = 'الاسم ، اسم العائلة لم تدخل!'; // 2->502

$lh[503] = 'لم يتم إدخال عنوان البريد الإلكتروني!'; // 3->503

$lh[504] = 'نسيت كتابة تعليق!'; // 4->504

$lh[505] = 'نموذج فارغ!'; // 5->505

$lh[506] = 'لا الصفحة الرئيسية وظيفة!'; // 7->506

$lh[507] = 'لا يمكن أن يكون حقل الرسالة أقصر من 10 أحرف!'; // 98->507

//$lh[508] = ''; // 99->508

$lh[509] = 'يحتوي حقل "العنوان - الموضوع" على أحرف غير صالحة! <br /> <br /> يمكن استخدام الأحرف اللاتينية والتركية والأرقام والمسافات والشرطات السفلية (_) والشرطات (-) والنقاط (.). <br /> لا يمكن أن تحتوي على أحرف خاصة خارجها.'; // 100->509

$lh[510] = 'يجب أن يكون "العنوان - الموضوع" على الأقل 4 ، على الأقل 100 حرف'; // 101 -> 510


//  HATA İLETİLERİ  - SONU  //








//  UYARI İLETİLERİ  - BAŞI  //


$lu[1] = 'تم تحديث الإصدار!';

$lu[2] = 'تم إيقاف تشغيل خدمة الرسائل الشخصية!';



/**/$lu[3] = 'Seçtiğiniz kullanıcı bir yönetici !<br />Yöneticilerin yetkileri sınırsızdır.';

/**/$lu[4] = 'Seçtiğiniz kullanıcı forum yardımcısı !<br />Forum yardımcıları tüm forum bölümleri üzerinde yetki sahibidir.';

/**/$lu[5] = 'Konuyu ve altındaki tüm cevapları silmek istediğinize emin misiniz ?<br /><br /><a href="phpkf-bilesenler/mesaj_sil.php?onay=kabul&amp;kip=mesaj&amp;fno='.$fno.'&amp;mesaj_no='.$mesaj_no.'&amp;o='.$go.'&amp;fsayfa='.$fsayfa.'">Evet</a> &nbsp; - &nbsp; <a href="konu.php?k='.$mesaj_no.$fs.'">Hayır</a>';



$lu[6] = 'يمكن للأعضاء فقط الوصول إلى هذه الصفحة!';



/**/$lu[7] = 'Cevabı silmek istediğinize emin misiniz ?<br /><br /><a href="phpkf-bilesenler/mesaj_sil.php?onay=kabul&amp;kip=cevap&amp;mesaj_no='.$mesaj_no.'&amp;cevap_no='.$cevap_no.'&amp;o='.$go.'&amp;fsayfa='.$fsayfa.'&amp;sayfa='.$sayfa.'">Evet</a> &nbsp; - &nbsp; <a href="konu.php?k='.$mesaj_no.$ks.$fs.'">Hayır</a>';



$lu[8] = 'لم تقم بأي تغييرات.';

$lu[9] = 'تم تعليق تجنيد الأعضاء مؤقتًا!';

/**/$lu[10] = 'Bu konu henüz onaylanmamış!<br />Onaylanmamış konuları sadece üyeler görebilir !'; //yeni


//  UYARI İLETİLERİ  - SONU  //

?>