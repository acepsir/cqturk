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

var resimno = 0;
if (!temadizini) var temadizini = "varsayilan"
var slayt_sablon = "phpkf-bilesenler/temalar/"+temadizini+"/css/slayt.css";

document.write('<style type="text/css" scoped="scoped">\
@import url("'+slayt_sablon+'");\
</style>\
<div class="SlaytPencereEnDis">\
<div class="SlaytBaslik">\
<div id="SlaytToplam"></div>\
<div id="SlaytGit"><span id="SlaytGeri"></span><span id="galeri_sayac"></span><span id="SlaytIleri"></span>\
<div id="SlaytBilgi">('+jsl["galeri_bilgi"]+')</div></div>\
<div class="SlaytKapat"><a href="javascript:void(0)" id="SlaytKapat">X</a></div>\
</div>\
<div id="SlaytPencereIc" class="SlaytPencereIc">\
<div id="SlaytKaydir"></div>\
<a id="Slayt_buyuk_resim_adres" href="javascript:void(0)" onclick="yeniPencere()"><img class="Slayt_buyuk_resim" class="Slayt_buyuk_resim" onLoad="PencereBoyut(this)" src="phpkf-dosyalar/yukleniyor3.gif" alt="" /></a>\
</div></div>');

if(window.navigator.userAgent.match(/(android|mobile)/i)){
var mobil_tarayici = true;
$("#SlaytBilgi").html(jsl["galeri_bilgi_mobil"]);
}
else{
var mobil_tarayici = false;
}

$.sayfaYuklendi(function(){
	$(".SlaytKucukResim").tik(function(){
		var link = $(this).return().parentElement;
		$(link).tik(function(event){$.dur(event);});
		$("#Slayt_buyuk_resim_adres").attrEkle("rel", link.href);
		$(".Slayt_buyuk_resim").attrEkle("src", link.href);
		$(".SlaytPencereEnDis").goster({display:"block"});
		if (mobil_tarayici) $("#SlaytKaydir").goster({display:"block"});
	});

	$("#SlaytKapat").tik(function(){
		$('.SlaytPencereEnDis').gizle({display:'none'});
		$(".Slayt_buyuk_resim").attrEkle("src", "phpkf-dosyalar/yukleniyor3.gif");
		if (mobil_tarayici) $('#SlaytKaydir').gizle({display:'none'});
	});
});
function PencereBoyut(adres){
	ToplamResim(adres.src);
}
function ToplamResim(adres){
	var resimler = $("#SlaytResimler");
	var resim = resimler.ilk().bul("a");
	var toplam = resim.length;
	$("#SlaytToplam").html(jsl["toplam"]+": "+toplam);
	var i;
	for (i=0; i<toplam; i++){
		if (resimler.ilk().bul("a").uye(i).return().href == adres){
			resimno = i;
			Tuslar(i,toplam);
			if (i==0) $("#SlaytGeri").html('<b class="geri">&#9664;</b>');
			else $("#SlaytGeri").html('<a class="geri" href="javascript:void(0)" onclick="javascript:geriResim('+i+')"><b>&#9664;</b></a>');
			$("#galeri_sayac").html((i+1)+'/'+toplam);
			if ((i+1)==toplam) $("#SlaytIleri").html('<b class="ileri">&#9654;</b>');
			else $("#SlaytIleri").html('<a class="ileri" href="javascript:void(0)" onclick="javascript:ileriResim('+i+')"><b>&#9654;</b></a>');
		}
	}
}
function geriResim(no){
	no--;
	$(".Slayt_buyuk_resim").attrEkle("src", "phpkf-dosyalar/yukleniyor3.gif");
	adres = $("#SlaytResimler").ilk().bul("a").uye(no).return().href;
	$("#Slayt_buyuk_resim_adres").attrEkle("rel", adres);
	$(".Slayt_buyuk_resim").attrEkle("src", adres);
}
function ileriResim(no){
	no++;
	$(".Slayt_buyuk_resim").attrEkle("src", "phpkf-dosyalar/yukleniyor3.gif");
	adres = $("#SlaytResimler").ilk().bul("a").uye(no).return().href;
	$("#Slayt_buyuk_resim_adres").attrEkle("rel", adres);
	$(".Slayt_buyuk_resim").attrEkle("src", adres);
}
function Tuslar(no,toplam){
if ($(".SlaytPencereEnDis").cssGetir("display")!="none"){
document.onkeyup = function(e){
switch (e.keyCode){
	case 37: // Sol yön tuşu
	case 33: // page up tuşu
	if (no!=0) geriResim(no);
	break;
	case 39: // sağ yön tuşu
	case 34: // page down tuşu
	if ((no+1)!=toplam) ileriResim(no);
	break;
	case 38: // yukarı yön tuşu
	case 36: // home tuşu
	geriResim(1);
	break;
	case 40: // aşağı yön tuşu
	case 35: // End tuşu
	geriResim(toplam);
	break;
	case 27: // Esc çıkış tuşu
	$('.SlaytPencereEnDis').gizle({display:'none'});
	break;
	}
};}
}
function yeniPencere(){
	window.open(document.getElementById("Slayt_buyuk_resim_adres").getAttribute('rel'),'_blank','scrollbars=yes,left=0,top=0,resizable=yes,toolbar=0,status=0,width='+screen.width+',height='+screen.height);
}
var touchStartCoords =  {'x':-1, 'y':-1},
touchEndCoords = {'x':-1, 'y':-1},
direction = 'undefined',
minDistanceXAxis = 30,
maxDistanceYAxis = 900,
maxAllowedTime = 1000,
startTime = 0,
elapsedTime = 0;

function calistir(katman) {
targetElement = document.getElementById(katman);
addMultipleListeners(targetElement, 'mousedown touchstart', swipeStart);
addMultipleListeners(targetElement, 'mousemove touchmove', swipeMove);
addMultipleListeners(targetElement, 'mouseup touchend', swipeEnd);
}
function swipeStart(e) {
e = e ? e : window.event;
e = ('changedTouches' in e)?e.changedTouches[0] : e;
touchStartCoords = {'x':e.pageX, 'y':e.pageY};
startTime = new Date().getTime();
}
function swipeMove(e){
e = e ? e : window.event;
e.preventDefault();
}
function swipeEnd(e) {
e = e ? e : window.event;
e = ('changedTouches' in e)?e.changedTouches[0] : e;
touchEndCoords = {'x':e.pageX - touchStartCoords.x, 'y':e.pageY - touchStartCoords.y};
elapsedTime = new Date().getTime() - startTime;
if (elapsedTime <= maxAllowedTime){
if (Math.abs(touchEndCoords.x) >= minDistanceXAxis && Math.abs(touchEndCoords.y) <= maxDistanceYAxis){
direction = (touchEndCoords.x < 0)? 'left' : 'right';
switch(direction){
case 'left':ileriResim(resimno);break;
case 'right':geriResim(resimno);break;}
}}}
function addMultipleListeners(el, s, fn) {
var evts = s.split(' ');
for (var i=0, iLen=evts.length; i<iLen; i++) {
el.addEventListener(evts[i], fn, false);
}}

calistir("SlaytKaydir");

//  -->