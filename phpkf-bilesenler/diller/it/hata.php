<?php
// phpKF v3.00
// Hata Sayfası
// İtalyanca Dil Dosyası



// Tekrar Eden Başlık ve Linkler
$lh['hata_iletisi'] = 'Messaggio di errore';
$lh['bilgi_iletisi'] = 'Messaggio Informativo';
$lh['uyari_iletisi'] = 'Messaggio di avvertimento';
$lh['hatali_adres'] = 'Indirizzo Errato !';
$lh['tikla_geri1'] = 'Fare clic per tornare indietro.';
$lh['tikla_geri2'] = 'Fare clic per tornare indietro.';
$lh['tikla_geri3'] = 'Per favore, tornate indietro e riprovate.';
$lh['tikla_giris'] = 'Fare clic per entrare.';
$lh['tikla_hatirla1'] = 'Fai clic su se non ricordi la password.';
$lh['tikla_hatirla2'] = 'Se non ricordi il nome utente, fai clic su di esso.';
$lh['tikla_kayit'] = 'Clicca qui per registrarti.';
$lh['tikla_anasayfa'] = 'Clicca qui per andare alla home page.';
$lh['tikla_profil'] = 'Clicca qui per vedere il tuo profilo.';
$lh['onay_kodu_hatali'] = 'Il codice di conferma non è corretto!';
$lh['spam_kutusu'] = 'Posta kutularınızı kontrol edin, spam kutusuna düşmüş olabilir.';
$lu['giris_yap'] = 'Giriş Yap';
$lu['uye_ol'] = 'Üye Ol';
$lu['facebook_giris'] = 'Facebook hesabıyla giriş yapabilirsiniz.';




//  BİLGİ İLETİLERİ  - BAŞI  //

$lb[1] = 'il tuo commento è stato aggiunto';

$lb[2] = ' il tuo commento è stato ricevuto, sarà visibile una volta approvato.';

/**/$lb[3] = '<meta http-equiv="Refresh" content="5;url=konu.php?k='.$mesaj_no.'&amp;f='.$fno.$fs.'">İletiniz değiştirilmiştir, okumak için <a href="konu.php?k='.$mesaj_no.'&amp;f='.$fno.$fs.'">tıklayın.</a><br />Foruma dönmek için <a href="forum.php?f='.$fno.'">tıklayın.</a>';

/**/$lb[4] = '<meta http-equiv="Refresh" content="5;url=konu.php?k='.$mesaj_no.$ks.'&amp;f='.$fno.$fs.'#c'.$cevap_no.'">İletiniz değiştirilmiştir, okumak için <a href="konu.php?k='.$mesaj_no.$ks.'&amp;f='.$fno.$fs.'#c'.$cevap_no.'">tıklayın.</a><br />Foruma dönmek için <a href="forum.php?f='.$fno.'">tıklayın.</a>';

/**/$lb[5] = 'Konuyu ve altındaki tüm cevapları silmek istediğinize emin misiniz ?<br /><br /><a href="phpkf-bilesenler/mesaj_sil.php?onay=kabul&amp;kip=mesaj&amp;fno='.$fno.'&amp;mesaj_no='.$mesaj_no.'&amp;o='.$go.$fs.'">Evet</a> &nbsp; - &nbsp; <a href="konu.php?k='.$mesaj_no.$fs.'">Hayır</a>';

/**/$lb[6] = 'Konu ve tüm cevapları silinmiştir.<br /><br />Foruma geri dönmek için <a href="forum.php?f='.$fno.$fs.'">tıklayın</a>';

/**/$lb[7] = 'Cevabı silmek istediğinize emin misiniz ?<br /><br /><a href="phpkf-bilesenler/mesaj_sil.php?onay=kabul&amp;kip=cevap&amp;mesaj_no='.$mesaj_no.'&amp;cevap_no='.$cevap_no.'&amp;o='.$go.$fs.$ks.'">Evet</a> &nbsp; - &nbsp; <a href="konu.php?k='.$mesaj_no.$fs.$ks.'">Hayır</a>';

/**/$lb[8] = 'Cevap silinmiştir.<br /><br />Konuya geri dönmek için <a href="konu.php?k='.$mesaj_no.$fs.$ks.'">tıklayın.</a>';

/**/$lb[9] = 'Seçtiğiniz konu taşınmıştır.<br /><br />Geldiğiniz bölüme dönmek için <a href="forum.php?f='.$fno1.'">tıklayın.</a><br />Konuyu taşıdığınız bölüme dönmek için <a href="forum.php?f='.$fno2.'">tıklayın.</a>';

$lb[10] = 'il tuo profilo è stato aggiornato...';

/**/$lb[11] = 'Özel iletiniz gönderilmiştir.<br /><br />Gönderilen kutusuna gitmek için <a href="ozel_ileti.php?kip=gonderilen">tıklayın.</a><meta http-equiv="Refresh" content="5;url=ozel_ileti.php?kip=gonderilen"><br /><br />Yazdığınız özel iletiyi görmek için <a href="oi_oku.php?oino='.$cevap_no.'#hzlcvp">tıklayın.</a>';

/**/$lb[12] = 'Forum ayarlarınız güncellenmiştir.<br /><br />Yönetim ana sayfasına dönmek için <a href="phpkf-yonetim/index.php">tıklayın.</a><meta http-equiv="Refresh" content="5;url=phpkf-yonetim/index.php">';

/**/$lb[13] = 'E-Postanız Gönderilmiştir...<br /><br /><a href="'.$phpkf_dosyalar['forum'].'">'.$lh['tikla_anasayfa'].'</a>';

$lb[14] = 'la vostra domanda di codice di attivazione è completata.<br /><br />puoi attivare il tuo account cliccando sul link nella mail ricevuta.';

$lb[15] = ' la registrazione è stata completata con successo.';

$lb[16] = ' La registrazione è stata completata con successo.<br /><br />cosa fare per attivare il tuo account<br />è descritto nell\'e-mail inviata a te.';

/**/$lb[17] = 'Kayıt işleminiz başarıyla tamamlanmıştır.<br /><br />Hesabınızın etkinleştirilmesi için forum yöneticisinin onayını beklemelisiniz.';

$lb[18] = 'il tuo account è già abilitato.';

$lb[19] = ' il tuo account è attivato.';

$lb[20] = ' la nuova applicazione password è completata .<br /><br />ciò che dovete fare per reimpostare la password è descritto nell\'e-mail inviata a voi.';

$lb[21] [0] = ' la nuova password è stata creata.';
$lb[21] [1] = 'Clicca qui per effettuare il login con la nuova password.';

$lb[22] = 'La tua nuova domanda di password è stata cancellata. I tuoi vecchi codici sono ancora validi.';

$lb[23] = ' il vostro messaggio ci ha raggiunto.';

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

$lb[42] = 'il tuo indirizzo email è stato salvato.<br /><br />address what you need to do to complete the change <br />is described in the E-mail sent to you.';

$lb[43] = 'La password è stata cambiata...';

$lb[44] = 'la password e l\'indirizzo email sono stati salvati .<br /><br />address what you need to do to complete the change<br />is described in the E-mail sent to you.';

$lb[45] = 'il tuo nuovo indirizzo email è stato approvato e sostituito.';

/**/$lb[46] = 'Özel ileti ayarlarınız güncellenmiştir.<br /><br />Geri dönmek için <a href="ozel_ileti.php?kip=ayarlar">tıklayın.</a><meta http-equiv="Refresh" content="5;url=ozel_ileti.php?kip=ayarlar">';

/**/$lb[47] = 'Forumdaki eski özel iletiler silinmiştir.<br /><br />Yönetim ana sayfasına dönmek için <a href="phpkf-yonetim/index.php">tıklayın.</a><meta http-equiv="Refresh" content="5;url=phpkf-yonetim/index.php">';

/**/$lb[48] = 'Üye başarıyla oluşturulmuştur, geri dönmek için <a href="phpkf-yonetim/yeni_uye.php">tıklayın.</a><br /><br />Üyenin profilini görmek için <a href="'.$phpkf_dosyalar['profil'].'?u='.$fno.'">tıklayın.</a><br />Üyenin profilini değiştirmek için <a href="phpkf-yonetim/uye_degistir.php?u='.$fno.'">tıklayın.</a>';

/**/$lb[49] = 'Dosya silinmiştir.<br /><br />Geri dönmek için <a href="phpkf-yonetim/forum_yuklemeler.php">tıklayın.</a>';

/**/$lb[50] = 'Dosya silinmiştir.<br /><br />Geri dönmek için <a href="'.$phpkf_dosyalar['profil_degistir'].'?kosul=yuklemeler">tıklayın.</a>';

$lb[51] = 'il tuo indirizzo email è approvato .<br /><br />è necessario attendere l\'approvazione dell\'amministratore per attivare il proprio account.';

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

$lh[1] = ' la pagina che stai cercando non può essere trovata !';

$lh[2] = ' name, lastname non Inserito !';

$lh[3] = 'indirizzo e-mail non Inserito !';

$lh[4] = ' Hai dimenticato di scrivere un commento !';

$lh[5] = ' forma vuota !';

$lh[6] = 'non è possibile inviare un altro commento senza<br />{00} secondi sul tuo ultimo commento.';

$lh[7] = ' non c\'è una home page !';

$lh[8] = ' inserire il proprio indirizzo email!';

// eklendi, 40 ile aynı
$lh[9] = 'E-Posta adresiniz 100 karakterden uzun olamaz !';

$lh[10] = ' il tuo indirizzo email non è corretto!';

$lh[11][0] = ' la registrazione è stata completata con successo.';
$lh[11][1] = ' ma la tua email non può essere inviata a causa di un errore del server !';
$lh[11][2] = 'potete richiedere il codice di attivazione qui.';

$lh[12] = ' il tuo account connesso a questo indirizzo email è già abilitato !';

$lh[13] = ' non c\'è traccia dell\'indirizzo email che digiti !';

/**/$lh[14] = 'Seçtiğiniz forum bölümü veritabanında bulunmamaktadır !';

/**/$lh[15] = 'Bu bölüme sadece yöneticiler girebilir !';

/**/$lh[16] = 'Bu bölüme sadece yöneticiler ve yardımcılar girebilir !';

/**/$lh[17] = 'Bu bölüme sadece, yöneticinin verdiği özel yetkilere sahip üyeler girebilir !';

$lh[18] = ' inserire nome utente e password !';

$lh[19] = ' il nome utente deve essere almeno 4, massimo 20 caratteri !';

$lh[20] = ' la password deve essere di almeno 5 caratteri e al massimo 20 caratteri !';

$lh[21] = ' hai fatto cinque tentativi di input falliti.<br />{00} il tuo account è stato bloccato per minuti.';

$lh[22] = ' la password non è corretta!<br />caps lock può essere lasciato acceso, le password sono separate per caso.';

$lh[23][0] = ' il tuo account non è ancora stato attivato !<br /><br />cosa fare per attivare il tuo account <br />è descritto nell\'e-mail inviata a te.';

$lh[23][1] = "codice di attivazione di ritrasmissione";

$lh[24] = ' il tuo account è bloccato !';

$lh[25] = ' avete cercato di registrare troppo. Riprova più tardi !';

$lh[26] = ' tutti i campi devono essere compilati !';

$lh[27] = ' ci sono caratteri non validi nel nome utente !<br /> <br />lettere, numeri, underscore( _ ), hyphens ( - ), periodi ( . ) utilizzabile.<br />oltre a questi, non può contenere caratteri e spazi speciali.';

$lh[28] = ' il nome utente deve essere almeno 4, massimo 20 caratteri !';

$lh[29] = ' this user name is banned, please try another user name !';

$lh[30] = ' This email address is banned !';

$lh[31] = ' ci sono caratteri non validi nel campo Nome !<br /><br />lettere, numeri, spazi, sottolineature( _ ), trattino ( - ), periodo ( . ) utilizzabile. <br />non può contenere caratteri speciali diversi da questi.';

$lh[32] = ' name lastname deve essere almeno 4, fino a 30 caratteri !';

$lh[33] = ' le password che digiti non corrispondono !';

$lh [34] = ' ci sono caratteri non validi nella password !<br /><br />lettera latina, cifra, sottolineatura ( _ ), trattino ( - ), e ( & ), periodo (. ) utilizzabile.<br />oltre a questi, non può contenere caratteri speciali, caratteri turchi e caratteri spaziali.';

$lh[35] = ' la password deve essere di almeno 5 caratteri e al massimo 20 caratteri !';

$lh[36] = ' posizione non valida!';

$lh[37] = ' Data di nascita non valida !';

$lh[38] = ' La parte Dell\'anno della data di nascita non è valida !<br />scrivere nel 1981 con 4 cifre.';

/**/$lh[39] = 'Silmeye çalıştığınız forumun alt forumları var. Önce alt forumlarını  silin !';

$lh[40] = 'il tuo indirizzo email non può essere più di 100 caratteri !';

$lh[41] = ' La Risposta alla domanda sulla cauzione di registrazione è errata !<br /><br />In Generale, ci sono domande molto facili che solo i programmi robot possono entrare.<br /><br />se non riesci ad indovinare la risposta, contatta l\'amministratore.';

$lh[42] = ' questo nome utente è usato, si prega di provare un altro nome !';

$lh[43] = ' Questo indirizzo e-mail è già stato registrato !';

$lh[45] = 'indirizzo sbagliato !<br /><br />controllare e riprovare.';

$lh[46] = ' il file Home non può essere trovato !<br /><br />nome file inserito';

$lh[47] = ' il membro che state cercando non può essere trovato !';

$lh[48] = 'il vostro codice di attivazione è mancante, o avete copiato l\'indirizzo è mancante.<br /><br />controllare e riprovare.<br />contatta l\'amministratore se riscontri di nuovo lo stesso problema.';

$lh[49] = ' il vostro codice di attivazione è errato, o avete copiato l\'indirizzo mancante.<br /><br />controllare e riprovare.<br />contatta l\'amministratore se riscontri di nuovo lo stesso problema.';

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

$lh[72] = ' il nome utente non può essere più lungo di 20 caratteri !';

$lh[73] = ' * tutti i campi contrassegnati devono essere compilati !';

$lh[74] = ' data di nascita non è valida !<br /><br />Si prega di digitare 31-12-1985, compreso il trattino (-).';

$lh[75] = ' il tuo indirizzo web non può essere più lungo di 100 caratteri !';

/**/$lh[76] = 'Tema dizini adı, alt çizgi( _ ) ve tire ( - ) dışındaki özel karakterleri ve Türkçe karakterleri içeremez !';

/**/$lh[77] = 'Tema klasörünün adı 20 karakterden uzun olamaz !';

$lh[78] = ' la firma non può essere più lunga di {00} caratteri !';

$lh[79] = ' il vostro numero ICQ non può essere più di 30 caratteri !';

$lh[80] = 'il tuo indirizzo Facebook non può essere più di 100 caratteri !';

$lh[81] = ' il tuo nome Skype non può essere più lungo di 100 caratteri !';

$lh[82] = ' Yahoo! Il tuo nome Messaggero non può essere più di 100 caratteri !';

$lh[83] = ' il tuo indirizzo Twitter non può essere più di 100 caratteri !';

$lh[84] = ' l\'immagine che stai cercando di caricare è corrotta !';

$lh[85] = ' solo le immagini JPEG, GIF o PNG possono essere caricate !<br />se il file è del tipo corretto, potrebbe essere danneggiato.';

$lh[86] = ' l\'immagine che si sta cercando di caricare non può essere superiore a {00} kilobyte !';

$lh[87] = 'la dimensione dell\'immagine che si sta cercando di caricare non può essere superiore a {00}!';

$lh[88] = ' file non può essere caricato !<br /><br />Se sei un amministratore, prova a dare il tuo programma FTP /phpkf-dosyalar/resimler/yuklenen/<br />scrivi alla directory (chmod 777).';

$lh[89] = 'c\'è stato un problema nel controllare l\'immagine remota.<br />il server potrebbe avere accesso remoto ai file disattivati, oppure potrebbe esserci un problema con l\'indirizzo o il file immagine.';

$lh[90] = ' l\'immagine che si sta cercando di aggiungere non può essere superiore a {00} kilobyte !';

$lh[91] = ' la dimensione dell\'immagine che si sta cercando di aggiungere non può essere superiore a {00}!';

$lh[92] = ' mostra l\'indirizzo e-mail, Mostra la data di nascita, mostra la città e<br />mostra le impostazioni di Stato online possono ricevere solo il valore on-off !';

$lh[93] = ' questo indirizzo e-mail appartiene ad un altro utente !';

$lh[94] = 'non siete autorizzati !!!';

/**/$lh[95] = 'Buradaki yazıları ancak forum üzerinden okuyabilirsiniz.';

$lh[96] = ' la tua nuova password non è corretta, oppure hai copiato l\'indirizzo mancante.<br />controllare e riprovare.<br />contatta l\'amministratore se riscontri di nuovo lo stesso problema.';

$lh[97] = ' avete tentato troppo. Riprova più tardi !';

$lh[98] = ' il campo messaggio non può essere inferiore a 10 caratteri !';

// 99 -> 508 yapıldı // onay kodu hatası
/**/$lh[99] = 'Sayfa başlığı 100 karakterden uzun olamaz !';

$lh[100] = 'ci sono caratteri non validi nel campo"title - subject"!<br /><br />lettere, numeri, spazi, sottolineature( _ ), trattino ( - ), periodo ( . ) utilizzabile.<br />non può contenere caratteri speciali diversi da questi.';

$lh[101] = 'title-subject\' deve essere almeno 4, fino a 100 caratteri !';

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

$lh[144] = 'non ti è permesso amministrare !';

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

$lh[175] = ' l\'email di conferma non può essere inviata a causa di un errore sul server !<br /><br />riprovare più tardi e avvisare l\'amministratore.';

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

$lh[186] = ' il nome che hai inserito nel campo nome è vietato !';

/**/$lh[187] = 'Kurulu eklentileri silemezsiniz !<br />Önce eklentiyi kaldırıp sonra silmeyi deneyin.';

$lh[188] = ' la password non è corretta !';

/**/$lh[189] = 'Kurmaya çalıştığınız eklenti portal için fakat sitenizde portal kurulu değil !';

/**/$lh[190] = 'Hatalı ip adresi !';

/**/$lh[191] = 'Bölüm yardımcısı adı 100 karakterden uzun olamaz !';

/**/$lh[192] = 'Bu bölüm konu açmaya kapatılmıştır !';

/**/$lh[193] = 'Bu bölüm cevap yazmaya kapatılmıştır !';

/**/$lh[194] = 'Seçtiğiniz bölümün yetkisi sadece yönetici ve yardımcılara verilmiş.<br />Özel bir üyeye izin veremezsiniz !';

/**/$lh[195] = 'Konuyu taşıdığınız bölümde yetkiniz yok !';

/**/$lh[196] = 'Bu tema kullandığınız sürüm ile uyumsuz görünüyor !';

/**/$lh[197] = 'Seçeneklerde olmayan bir tema varsayılan olarak ayarlanamaz !<br />Temayı önce seçenekler arasına ekleyin.';

$lh[198] [0] = ' la registrazione è stata completata con successo.';
$lh[198] [1] = ' ma la tua email non può essere inviata a causa di un errore del server !';

$lh[199] = ' devi aspettare l\'approvazione dell\'amministratore del sito per attivare il tuo account.';

/**/$lh[200] = 'Bu eklenti etkisizleştirmeyi desteklemiyor !';

/**/$lh[201] = 'Grup adında karakterler var !<br /><br />Latin ve Türkçe harf, rakam, boşluk, alt çizgi( _ ), tire ( - ), nokta ( . ) kullanılabilir. <br />Bunların dışındaki özel karakterleri içeremez.';

/**/$lh[202] = 'Grup adı en az 4, en fazla 30 karakter olmalıdır !';

/**/$lh[203] = 'Bu grup adı kullanılmaktadır, başka bir ad deneyin !';

/**/$lh[204] = 'Forumda böyle bir grup bulunmamaktadır !';

/**/$lh[205] = 'Grubun bölüm yardımcılığı yetkisini değiştirmek için önce<br /><a href="phpkf-yonetim/ozel_izinler.php">özel izinler</a> sayfasında görünen bölüm yönetme izinlerini alın !';

/**/$lh[206] = 'Aradığınız dosya bulunamıyor.<br />Dosya daha önceden silinmiş olabilir. Lütfen kontrol edip tekrar deneyin.';

$lh[207] = ' non ci sono membri di questo nome sul sito !<br />Si può aver inserito il nome utente in modo errato.';

$lh[208] = ' indirizzo email non è usato come nome utente !<br /><br />inserire il nome utente scritto durante la registrazione.';

/**/$lh[209] = 'Seçtiğiniz yorum veritabanında bulunmamaktadır !';

/**/$lh[210] = 'Bu yorum daha önceden geri yüklenmiş veya silinmemiş !';

/**/$lh[211] = 'Hesap etkinleştirmesi sadece yöneticiler tarafından yapılmaktadır !<br ><br />Hesabınızın etkinleştirilmesi için site yöneticisinin onayını beklemelisiniz.'; // yeni

/**/$lh[220] = 'Aradığınız dosya bulunamıyor.<br />Dosya daha önceden silinmiş olabilir. Lütfen kontrol edip tekrar deneyin.';

$lh[221] = ' devi aspettare l\'approvazione dell\'amministratore per attivare il tuo account !';

$lh[223] = 'Hesabınız henüz etkinleştirilmemiş !<br /><br />Hesabınızın etkinleştirilmesi için önce size gönderilen E-Postadaki<br />bağlantıyı tıklayın daha sonra yöneticinin onayını bekleyin.'; // yeni

$lh[224] = ' le informazioni su non possono superare 1000 caratteri !';


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

$lu[1] = 'Aggiornamento versione!';

$lu[2] = 'Il servizio di messaggi privati ​​è stato chiuso!';

/**/$lu[3] = 'Seçtiğiniz kullanıcı bir yönetici !<br />Yöneticilerin yetkileri sınırsızdır.';

/**/$lu[4] = 'Seçtiğiniz kullanıcı forum yardımcısı !<br />Forum yardımcıları tüm forum bölümleri üzerinde yetki sahibidir.';

/**/$lu[5] = 'Konuyu ve altındaki tüm cevapları silmek istediğinize emin misiniz ?<br /><br /><a href="phpkf-bilesenler/mesaj_sil.php?onay=kabul&amp;kip=mesaj&amp;fno='.$fno.'&amp;mesaj_no='.$mesaj_no.'&amp;o='.$go.'&amp;fsayfa='.$fsayfa.'">Evet</a> &nbsp; - &nbsp; <a href="konu.php?k='.$mesaj_no.$fs.'">Hayır</a>';

$lu[6] = 'Solo i membri possono entrare in questa pagina!';

/**/$lu[7] = 'Cevabı silmek istediğinize emin misiniz ?<br /><br /><a href="phpkf-bilesenler/mesaj_sil.php?onay=kabul&amp;kip=cevap&amp;mesaj_no='.$mesaj_no.'&amp;cevap_no='.$cevap_no.'&amp;o='.$go.'&amp;fsayfa='.$fsayfa.'&amp;sayfa='.$sayfa.'">Evet</a> &nbsp; - &nbsp; <a href="konu.php?k='.$mesaj_no.$ks.$fs.'">Hayır</a>';

$lu[8] = 'Non hai apportato alcuna modifica.';

$lu[9] = 'L\'acquisto del membro è stato temporaneamente interrotto!';

/**/$lu[10] = 'Bu konu henüz onaylanmamış!<br />Onaylanmamış konuları sadece üyeler görebilir !'; //yeni


//  UYARI İLETİLERİ  - SONU  //

?>