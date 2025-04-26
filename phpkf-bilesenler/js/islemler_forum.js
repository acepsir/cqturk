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

function hepsiniSec(kodCizelgesi){
if(document.selection){var secim=document.body.createTextRange();secim.moveToElementText(document.getElementById(kodCizelgesi));secim.select();}else if(window.getSelection){var secim=document.createRange();secim.selectNode(document.getElementById(kodCizelgesi));window.getSelection().addRange(secim);}else if(document.createRange && (document.getSelection || window.getSelection)){secim=document.createRange();secim.selectNodeContents(document.getElementById(kodCizelgesi));a=window.getSelection ? window.getSelection() : document.getSelection();a.removeAllRanges();a.addRange(secim);}
}
function ResimBuyut(resim,ratgele,en,boy,islem){
var katman=document.getElementById(ratgele);if(islem=="buyut"){resim.width=en;resim.onclick=function(){ResimBuyut(resim,ratgele,en,boy,"kucult")};katman.style.width=(en-12)+"px";katman.innerHTML="Küçültmek için resmin üzerine tıklayın. Yeni pencerede açmak için buraya tıklayın."+" ("+en+"x"+boy+")";if(document.all)resim.style.cursor="pointer";else resim.style.cursor="-moz-zoom-out";}else if(islem=="kucult"){resim.width=600;resim.onclick=function(){ResimBuyut(resim,ratgele,en,boy,"buyut")};katman.style.width="588px";katman.innerHTML="Büyütmek için resmin üzerine tıklayın. Yeni pencerede açmak için buraya tıklayın."+" ("+en+"x"+boy+")";if(document.all)resim.style.cursor="pointer";else resim.style.cursor="-moz-zoom-in";}else if(islem=="ac")window.open(resim,"_blank","scrollbars=yes,left=1,top=1,width="+(en+40)+",height="+(boy+30)+",resizable=yes");
}
function ResimBoyutlandir(resim){
if(resim.width>"600"){var en=resim.width;var boy=resim.height;var adres=resim.src;var rastgele="resim_boyut_"+Math.random();oyazi=document.createTextNode("Büyütmek için resmin üzerine tıklayın. Yeni pencerede açmak için buraya tıklayın."+" ("+resim.width+"x"+resim.height+")");okatman=document.createElement("div");okatman.id=rastgele;okatman.className="resim_boyutlandir";okatman.align="left";okatman.title="Gerçek boyutunda görmek için resmin üzerine tıklayın!";okatman.style.cursor="pointer";okatman.onclick=function(){ResimBuyut(adres,rastgele,en,boy,"ac")};okatman.textNode=oyazi;okatman.appendChild(oyazi);resim.onclick=function(){ResimBuyut(resim,rastgele,en,boy,"buyut")};resim.width="600";resim.style="border:1px solid #000";resim.title="Gerçek boyutunda görmek için resmin üzerine tıklayın!";resim.parentNode.insertBefore(okatman, resim);if(document.all)resim.style.cursor="pointer";else resim.style.cursor="-moz-zoom-in";}
}
function ziplama(){
if (!document.all) return;
else{
var zipla = document.getElementById("zipla");
zipla.style.visibility=(zipla.style.visibility=="visible")?"hidden":"visible";}
}
function HizliArama(){
katman1=document.hizli_arama.sozcuk_herhangi;
if (katman1.value=="Arama..."){
katman1.value="";
katman1.style.color="#000000";}
else if (katman1.value==""){
katman1.value="Arama...";
katman1.style.color="#777777";}
}
function denetle_arama(){
var dogruMu = true;
if ((document.hizli_arama.sozcuk_herhangi.value.length < 3)||(document.hizli_arama.sozcuk_herhangi.value=="Arama...")){dogruMu=false;alert(jsl["arama_uyari"]);}
else;return dogruMu;
}
function aramaGoster(elementid){
if(document.getElementById(elementid).style.display=="block"){
document.getElementById(elementid).style.display = "none";}
else{document.getElementById(elementid).style.display = "block";}
}
function IsNumeric(deger){var desen = /^-{0,1}\d*\.{0,1}\d+$/;return (desen.test(deger));}
function aramaGoster(elementid){
if(document.getElementById(elementid).style.display=="block"){
document.getElementById(elementid).style.display = "none";}
else{document.getElementById(elementid).style.display = "block";}
}
function KodBoyut(kodCizelgesi,yon){
var alan=document.getElementById(kodCizelgesi).style.maxHeight;
if(alan!=""){alan="";yon.innerHTML="&#9650;";}
else{alan="342px";yon.innerHTML="&#9660;";}
document.getElementById(kodCizelgesi).style.maxHeight = alan;
}
function denetle_giris(){
var dogruMu=true;
if((document.giris.kullanici_adi.value.length < 4) || (document.giris.sifre.value.length < 5)){
dogruMu = false;alert(jsl["kullanici_adi_sifre_uyari"]);}
else;return dogruMu;
}
function denetle_posta(){
var dogruMu=true;if(document.giris.posta.value.length < 4){
dogruMu=false;alert(jsl["eposta_uyari"]);}
else;return dogruMu;
}
function denetle_yeni_sifre(){
var dogruMu=true;
if((document.giris.y_sifre1.value.length < 5) || (document.giris.y_sifre2.value.length < 5)){
dogruMu = false;alert(jsl["yeni_sifre_uyari"]);}
if (document.giris.y_sifre1.value != document.giris.y_sifre2.value){
dogruMu=false;alert(jsl["sifreler_uyusmuyor"]);}
else;return dogruMu;
}
function dogrula_giris(id){
var bos = "url('temalar/varsayilan/resimler/bos.png')";
var dogru = "url('temalar/varsayilan/resimler/dogru.png')";
var yanlis = "url('temalar/varsayilan/resimler/yanlis.png')";
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
function CerezYaz(cerezveri,site_dizin){
var cdizin = "; path="+site_dizin+"";
var ctarih=new Date();
ctarih.setTime(ctarih.getTime()+(7*24*60*60*1000));
ctarih = "; expires="+ctarih.toGMTString();
document.cookie="yorum_siralama="+cerezveri+ctarih+cdizin;
location.reload();
}
function uye_ara(){
var uye = document.duzenleyici_form.ozel_kime.value;
window.open("oi_yaz.php?kip=1&uye_ara="+uye, "_uyeara", "resizable=yes,width=390,height=350,scrollbars=yes");
}
if(window.navigator.userAgent.match(/MSIE /)){
document.createElement("header");
document.createElement("footer");
document.createElement("nav");
}
//  -->