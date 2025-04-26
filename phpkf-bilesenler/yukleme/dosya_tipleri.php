<?php
// Yüklenen dosya tiplerinin simgelerini ve
// otomatik eklenen kodları buradan yönetebilirsiniz.
// Dosya uzantılarını virgül ile ayırın.


// Tanımlı dosya tipleri

$TanimliDosyaTipleri = array(
'video_dosyalari' => 'mp4,m4v,webm,ogg,ogv,ogx,ogm,3gp,mp2,mpg,mpeg,vob,ts,wmv,asf,avi,mov,qt,mxf,mkv,',
'flash_dosyalari' => 'swf,flv,f4v,f4p,f4a,f4b,',
'ses_dosyalari' => 'mp3,m4a,wav,aiff,wma,flac,aiff,ogg,oga,opus,spx,',
'resim_dosyalari' => 'jpeg,jpg,gif,png,bmp,ico,tif,tiff,ppm,pgm,pbm,pnm,webp,svg,',
'arsiv_dosyalari' => 'zip,rar,tar.gz,tar,gz,cab,iso,apk,jar,dmg,bz2,7z,s7z,lzh,arj',
'metin_dosyalari' => 'txt,log,csv,,',
'ofis_dosyalari' => 'doc,docx,rtf,xls,xlsx,odt,pdf,',
'web_dosyalari' => 'htm,html,shtml,css,js,php,xml,sql,htaccess,asp,cgi,pl,'
);




// Editöre otomatik eklenen video, embed ve audio kodlarının geçerli olacağı dosya tipleri

$video_etiketi = 'mp4,m4v,webm,ogg,ogv,ogx,ogm,';
$embed_etiketi = '3gp,mp2,mpg,mpeg,vob,ts,wmv,asf,avi,mov,qt,mxf,mkv,swf,flv,f4v,f4p,f4a,f4b,';
$audio_etiketi = 'mp3,m4a,wav,aiff,wma,flac,aiff,ogg,oga,opus,spx,';

?>