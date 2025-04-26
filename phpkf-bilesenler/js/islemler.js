<!-- //
/*
 +===========================================================+
 |                  php Kolay Forum (phpKF)                  |
 +===========================================================+
 |                                                           |
 |          Telif - Copyright (c) 2007 - 2019 phpKF          |
 |            www.phpKF.com   -   phpKF@phpKF.com            |
 |        Tüm hakları saklıdır - All Rights Reserved         |
 |              http://www.phpkf.com/telif.php               |
 |                                                           |
 +===========================================================+*/

function hepsiniSec(kodCizelgesi){if(document.selection){var secim=document.body.createTextRange();secim.moveToElementText(document.getElementById(kodCizelgesi));secim.select();}else if(window.getSelection){var secim=document.createRange();secim.selectNode(document.getElementById(kodCizelgesi));window.getSelection().addRange(secim);}else if(document.createRange && (document.getSelection || window.getSelection)){secim=document.createRange();secim.selectNodeContents(document.getElementById(kodCizelgesi));a=window.getSelection ? window.getSelection() : document.getSelection();a.removeAllRanges();a.addRange(secim);}
}
function KodBoyut(kodCizelgesi,yon,deger){
var alan=document.getElementById(kodCizelgesi).style.maxHeight;
if(alan!=""){alan="";yon.innerHTML="&#9650;";}
else{alan=deger+"px";yon.innerHTML="&#9660;";}
document.getElementById(kodCizelgesi).style.maxHeight=alan;
}
function IsNumeric(deger){
var desen = /^-{0,1}\d*\.{0,1}\d+$/;
return (desen.test(deger));
}
function CerezYaz(cerezveri,site_dizin){
var cdizin = "; path="+site_dizin+"";
var ctarih=new Date();
ctarih.setTime(ctarih.getTime()+(7*24*60*60*1000));
ctarih = "; expires="+ctarih.toGMTString();
document.cookie="yorum_siralama="+cerezveri+ctarih+cdizin;
location.reload();
}
function denetle_giris(){
var dogruMu = true;
if ((document.giris.kullanici_adi.value.length < 4) || (document.giris.sifre.value.length < 5)){
dogruMu = false;
alert(jsl["kullanici_adi_sifre_uyari"]);}
else;
return dogruMu;
}
function denetle_posta(){
var dogruMu = false;
alan = document.giris.posta;
if (alan.value.length > 4){
var desen = /^([-!#\$%&*+./0-9=?A-Z^_`a-z{|}~])+\@(([-!#\$%&*+/0-9=?A-Z^_`a-z{|}~])+\.)+([a-zA-Z0-9]{2,4})+$/;
if (alan.value.match(desen)) dogruMu = true;}
if (!dogruMu) alert(jsl["eposta_uyari"]);
return dogruMu;
}
function denetle_yeni_sifre(){
var dogruMu = true;
if ((document.giris.y_sifre1.value.length < 5) || (document.giris.y_sifre2.value.length < 5)){
dogruMu = false;
alert(jsl["yeni_sifre_uyari"]);}
if (document.giris.y_sifre1.value != document.giris.y_sifre2.value){
dogruMu = false;
alert(jsl["sifreler_uyusmuyor"]);}
else;
return dogruMu;
}
function dogrula_giris(id){
var bos = "url('phpkf-bilesenler/temalar/varsayilan/resimler/bos.png')";
var dogru = "url('phpkf-bilesenler/temalar/varsayilan/resimler/dogru.png')";
var yanlis = "url('phpkf-bilesenler/temalar/varsayilan/resimler/yanlis.png')";
var alan = document.getElementById(id);
if (id == 'kullanici_adi'){
var kucuk = 4;
var buyuk = 20;
var desen = /^[A-Za-z0-9-_ğĞüÜŞşİıÖöÇç.]+$/;}
else if ((id == 'sifre')||(id == 'sifre2')||(id == 'y_sifre1')||(id == 'y_sifre2')){
var kucuk = 5;
var buyuk = 20;
var desen = /^[A-Za-z0-9-_.&]+$/;}
else if (id == 'posta'){
var kucuk = 5;
var buyuk = 70;
var desen = /^([-!#\$%&*+./0-9=?A-Z^_`a-z{|}~])+\@(([-!#\$%&*+/0-9=?A-Z^_`a-z{|}~])+\.)+([a-zA-Z0-9]{2,4})+$/;}
else if (id == 'onay_kodu'){
var kucuk = 1;
var buyuk = 6;
var desen = /^[A-Za-z0-9]+$/;}
else{
var kucuk = 1;
var buyuk = 999;
var desen = /^.*$/;}
if (alan.value.length < kucuk){
if (alan.value.length==0) alan.style.backgroundImage=bos;
else if (!alan.value.match(desen)) alan.style.backgroundImage=yanlis;
else alan.style.backgroundImage=bos;}
else if (!alan.value.match(desen)) alan.style.backgroundImage=yanlis;
else if (alan.value.length > buyuk) alan.style.backgroundImage=yanlis;
else{
if (id == 'y_sifre2'){
if (document.getElementById('y_sifre1').value!=document.getElementById('y_sifre2').value)alan.style.backgroundImage=yanlis;
else alan.style.backgroundImage=dogru;}
else if (id == 'sifre2'){
if (document.getElementById('sifre').value!=document.getElementById('sifre2').value)alan.style.backgroundImage=yanlis;
else alan.style.backgroundImage=dogru;}
else alan.style.backgroundImage=dogru;}
}
function denetle_kayit(){
var dogruMu = true;
if ((document.form1.kullanici_adi.value == "") || (document.form1.posta.value == "") || (document.form1.sifre.value == "") || (document.form1.sifre2.value == "") ){
dogruMu = false;
alert(jsl["tum_alanlar_zorunlu"]);}
else if ( (document.form1.onay_kodu) && (document.form1.onay_kodu.value == "") ){
dogruMu = false;
alert(jsl["tum_alanlar_zorunlu"]);}
else if ( (document.form1.kayit_cevabi) && (document.form1.kayit_cevabi.value == "") ){
dogruMu = false;
alert(jsl["tum_alanlar_zorunlu"]);}
if (document.form1.sifre.value != document.form1.sifre2.value){
dogruMu = false; 
alert(jsl["sifreler_uyusmuyor"]);}
if (document.form1.kosul.checked != true ){
dogruMu = false;
alert(jsl["uyelik_kosul_uyari"]);}
return dogruMu;
}
function GonderAl(adres,id){
var katman = document.getElementById(id);
var veri_yolla = "name=value";
if (document.all) var istek = new ActiveXObject("Microsoft.XMLHTTP");
else var istek = new XMLHttpRequest();
istek.open("GET", adres, true);
istek.onreadystatechange = function(){
if (istek.readyState == 4){
if (istek.status == 200) katman.innerHTML = istek.responseText;
else katman.innerHTML = "<b>"+jsl["baglanti_yok"]+"</b>";}};
istek.send(veri_yolla);
}
function KAdi(){
var veri = document.getElementById("kullanici_adi").value;
if(veri != ""){
var adres = dosya_kayit+"?kosul=kadi&kadi="+veri;
var katman = "kullanici_adi-alan2";
var katman1 = document.getElementById(katman);
katman1.innerHTML = '<img src="phpkf-dosyalar/yukleniyor.gif" width="18" height="18" alt="." title="'+jsl["yukleniyor"]+'">';
setTimeout("GonderAl('"+adres+"','"+katman+"')",1000);}
}
function aramaGoster(elementid){
if(document.getElementById(elementid).style.display=='block'){
document.getElementById(elementid).style.display = 'none';}
else{
document.getElementById(elementid).style.display = 'block';}
}
function aramaYap(form, sayfa, seo){
if (sayfa == 'etiket'){
var deger = form.etiket.value;
var hata = jsl["etiket_uyari"];}
else{
var deger = form.arama.value;
var hata = jsl["arama_uyari"];}
var dogruMu = true;
if (deger.length < 3){
dogruMu = false;
alert(hata);}
else{
if (seo==1){
window.location.href = form.action+deger+'/';
dogruMu = false;}
}return dogruMu;
}
function YorumYanitla(id){
if(IsNumeric(id)){
var form = document.getElementById("duzenleyici_form");
var x=form.elements.length;
form.yanitla.value = id;
form.mesaj_icerik.placeholder = jsl["yorum_yanitlama_bilgi"];
window.location.hash = "#yorumyaz";}
}
function denetle_iletisim(){
var dogruMu = true;
if ((document.iletisimForm.ad_soyad.value == "") || (document.iletisimForm.posta.value == "") || (document.iletisimForm.icerik.value == "") || (document.iletisimForm.onay_kodu.value == "") ){
dogruMu = false;
alert(jsl["tum_alanlar_zorunlu"]);}
return dogruMu;
}
function profilGoster(gosterid, gizleid, gizleid2){
if (document.getElementById(gosterid).style.display == "block") {
document.getElementById(gosterid).style.display = 'block';
document.getElementById(gizleid).style.display = 'none';
document.getElementById(gizleid2).style.display = 'none';}
else {
document.getElementById(gosterid).style.display = 'block';
document.getElementById(gizleid).style.display = 'none';
document.getElementById(gizleid2).style.display = 'none';}
}
if(window.navigator.userAgent.match(/MSIE /)){
document.createElement("header");
document.createElement("footer");
document.createElement("nav");
}
//  -->