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

function EtkinYap(){
var durum = document.duzenleyici_form.hemen.checked;
if (durum){
	document.duzenleyici_form.tarih_gun.disabled = "disabled";
	document.duzenleyici_form.tarih_ay.disabled = "disabled";
	document.duzenleyici_form.tarih_yil.disabled = "disabled";
	document.duzenleyici_form.tarih_saat.disabled = "disabled";
	document.duzenleyici_form.tarih_dakika.disabled = "disabled";}
else{
	document.duzenleyici_form.tarih_gun.disabled = "";
	document.duzenleyici_form.tarih_ay.disabled = "";
	document.duzenleyici_form.tarih_yil.disabled = "";
	document.duzenleyici_form.tarih_saat.disabled = "";
	document.duzenleyici_form.tarih_dakika.disabled = "";}
}

function denetle_yazi(){
	var dogruMu=true;
	if(document.duzenleyici_form.adsoyad){
		if(document.duzenleyici_form.adsoyad.value.length < 3){
			dogruMu=false;
			alert(jsl["adsoyad_uyari"]);
		}
	}
	if((document.duzenleyici_form.posta)&&(dogruMu)){
		if(document.duzenleyici_form.posta.value.length < 3){
			dogruMu=false;
			alert(jsl["eposta_uyari"]);
		}
	}
	if((document.duzenleyici_form.onay_kodu)&&(dogruMu)){
		if(document.duzenleyici_form.onay_kodu.value.length!=6){
			dogruMu=false;
			alert(jsl["onaykodu_uyari"]);
		}
	}
	if((document.duzenleyici_form.mesaj_baslik)&&(dogruMu)){
		if(document.duzenleyici_form.mesaj_baslik.value.length < 3){
			dogruMu=false;
			alert(jsl["baslik_uyari"]);
		}
	}
	if ((duzenleyici=="varsayilan")||(duzenleyici=="galeri")){
		var div_katman = document.getElementById(duzenleyici_katman);
		if(div_katman.style.display=="inline")var textarea = div_katman.innerHTML.length;
		else var textarea = document.getElementById(duzenleyici_id).value;
	}
	else if ((duzenleyici=="tinymce")||(duzenleyici=="tinymce_pro")) var textarea = tinymce.get(duzenleyici_id).getContent();
	else if ((duzenleyici=="ckeditor")||(duzenleyici=="ckeditor_pro")) var textarea = CKEDITOR.instances[duzenleyici_id].getData();
	else if (duzenleyici=="sceditor") var textarea = $("#"+duzenleyici_id).sceditor("instance").val();
	else var textarea = document.getElementById(duzenleyici_id).value;

	if((textarea<3)&&(dogruMu)){
	dogruMu=false;
	alert(jsl["icerik_uyari"]);
	}
	else ayril=true;
	return dogruMu;
}

function onizle_mesaj(mobil_dizin){
if(!mobil_dizin) mobil_dizin = "";
if(document.duzenleyici_form.sayfa_onizleme.value=="oi_yaz")document.duzenleyici_form.action=mobil_dizin+"oi_yaz.php#onizleme";
else if(document.duzenleyici_form.sayfa_onizleme.value=="mesaj_degistir")document.duzenleyici_form.action=mobil_dizin+"mesaj_degistir.php#onizleme";
else document.duzenleyici_form.action=mobil_dizin+"mesaj_yaz.php#onizleme";
//if(document.duzenleyici_form.onsubmit())document.duzenleyici_form.submit();
}

function sayfadan_ayril(){
	if (duzenleyici=="varsayilan"){
		var div_katman = document.getElementById(duzenleyici_katman);
		if(div_katman.style.display=="inline") {if(div_katman.innerHTML.length < 7) ayril=true; document.getElementById("phpkf_eski_"+duzenleyici_id).value=div_katman.innerHTML;}
		else {if (document.getElementById(duzenleyici_id).value.length < 3) ayril=true; document.getElementById("phpkf_eski_"+duzenleyici_id).value=document.getElementById(duzenleyici_id).value;}
	}
	else if (duzenleyici=="galeri"){
		var div_katman=document.getElementById(duzenleyici_katman);if(div_katman.innerHTML.length < 7) ayril=true; document.getElementById(duzenleyici_id).value=div_katman.innerHTML;
	}
	else if ((duzenleyici=="tinymce")||(duzenleyici=="tinymce_pro")){if(tinymce.get(duzenleyici_id).getContent() < 3) ayril=true;}
	else if ((duzenleyici=="ckeditor")||(duzenleyici=="ckeditor_pro")){if(CKEDITOR.instances[duzenleyici_id].getData() < 3) ayril=true;}
	else if ((duzenleyici=="sceditor")||(duzenleyici=="sceditor_pro")){
		if ($("#"+duzenleyici_id).sceditor("instance").getWysiwygEditorValue().length == 36) ayril=true;
		else if ($("#"+duzenleyici_id).sceditor("instance").getWysiwygEditorValue().length < 3) ayril=true;
	}
	else {if(document.getElementById(duzenleyici_id).value.length < 3) ayril=true;}
	if (!ayril_durum) ayril=true;
	return ayril;
}

window.onbeforeunload = function(){
if (!ayril) sayfadan_ayril();
if(!ayril) return jsl["sayfa_ayril_uyari"];
};

function FormTemizle(){
	if(window.confirm(jsl["icerik_sil_uyari"])){
	if ((duzenleyici=="varsayilan")||(duzenleyici=="galeri")){
	document.getElementById(duzenleyici_id).value = "";
	document.getElementById(duzenleyici_katman).innerHTML = "";}
	else if ((duzenleyici=="tinymce")||(duzenleyici=="tinymce_pro")) tinymce.get(duzenleyici_id).setContent("");
	else if ((duzenleyici=="ckeditor")||(duzenleyici=="ckeditor_pro")) CKEDITOR.instances[duzenleyici_id].setData("");
	else if ((duzenleyici=="sceditor")||(duzenleyici=="sceditor_pro")) $("#"+duzenleyici_id).sceditor("instance").val("");
	else document.getElementById(duzenleyici_id).value = "";
	}
}
//  -->