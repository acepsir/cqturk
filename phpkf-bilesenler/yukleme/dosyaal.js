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


var yukleme_duzenleyici_id = "";
var yukleme_duzenleyici_katman = "";

function YuklemeAcKapat(id){
	if(id){
		window.yukleme_duzenleyici_id = id;
		window.yukleme_duzenleyici_katman = id + "_div";
	}
	else{
		window.yukleme_duzenleyici_id = "mesaj_icerik";
		window.yukleme_duzenleyici_katman = "mesaj_icerik_div";
	}
	var pencere = document.getElementById("yukleme_pencere");
	if (pencere.style.display == "none") pencere.style.display = "inline";
	else pencere.style.display = "none";
}


// DOSYA SEÇME ALANI TÜM DOSYALAR VEYA TEK TEK
function dosyaSec(hangiDosya){
	var sec = document.getElementsByName("sec[]");

	// TÜM DOSYALAR
	if(hangiDosya == '')
	{
		for(var i=1; i < sec.length; i++){
			if(sec[0].checked == true)
			{
				sec[i].checked=true;
				document.getElementById("satir"+i).className = 'renklendir2';
			}
			else
			{
				sec[i].checked=false;
				document.getElementById("satir"+i).className = 'renklendir';
			}
		}
	}

	// TEK TEK
	else
	{
		if(sec[hangiDosya].checked == true)
			document.getElementById("satir"+hangiDosya).className = 'renklendir2';
		else
			document.getElementById("satir"+hangiDosya).className = 'renklendir';
	}
}
// DOSYA SEÇME ALANI TÜM DOSYALAR VEYA TEK TEK - SONU



// KLASÖR KUTUSU
function klasorOlustur(){
	if(document.getElementById("klasorAdi").style.display == 'none')
	{
		document.getElementById("klasorAdi").style.display="inline";
		document.getElementById("kisim").focus();
	}
	else document.getElementById("klasorAdi").style.display="none";
}



// DOSYA ALANI YENİLENİYOR
function Tazele(){
	var Ikon = document.getElementById('Ikon');
	Ikon.innerHTML ='<img src="'+duzenleyici_dizin+'phpkf-bilesenler/yukleme/yukleniyor.gif" alt="">';
	setTimeout(function(){
		VeriyiIlet('vericek');
		Ikon.innerHTML ='';
	},300);
}



// TÜM VERİLERİN İŞLENDİĞİ FONKSİYON
function VeriyiIlet(hangiIslem,dosyaIsim,chmod){
	setTimeout(function()
	{
		var dds = 0;
		var ddsayfa = 0;
		var dizinim = "/";
		var adres = window.location.hash;

		var myRegexp = /(.*?)#ddyuk=(.*?)$/;
		var match = myRegexp.exec(adres);
		if (match)
		{
			dizinim = match[2];
			dizinim = dizinim.replace("..", "");
			dizinim = dizinim.replace("//", "/");
			dizinim = dizinim.replace("#", "");
		}

		var myRegexp = /(.*?)#dds=([a-z0-9]*?)#/;
		var match = myRegexp.exec(adres);
		if (match)
		{
			ddsayfa = match[2];
			ddsayfa = ddsayfa.replace("..", "");
			ddsayfa = ddsayfa.replace("//", "/");
			ddsayfa = ddsayfa.replace("#", "");
		}
		if (!ddsayfa) ddsayfa = 0;

		if (ddsayfa == 0)
		{
			$("#ddsayfabas").css("display:none");
			$("#ddsayfageri").css("display:none");
		}
		else
		{
			$("#ddsayfabas").css("display:inline");
			$("#ddsayfageri").css("display:inline");
		}

		dds = ddsayfa;
		dds++;
		$("#ddsayfano").html(dds);


		// YENİ PENCERE
		if(hangiIslem == 'yenipencere')
		{
			var dAktar = dosyaIsim;
			dAktar = dAktar.replace("http://", "");
			dAktar = dAktar.replace("https://", "");
			dAktar = dAktar.replace("//", "/");
			dAktar = '//'+dAktar;
			var ortala = true;

			if(chmod == 'resim'){
				$("#Onizleme").html('<a id="resimOnizlemeLink" rel="" href="javascript:void(0)" onclick="yeniPencere()"><img class="Slayt_buyuk_resim" id="resimOnizleme" src="" alt="" /></a>');
				var resimOnizleme = document.getElementById("resimOnizleme");
				var resimOnizlemeLink = document.getElementById("resimOnizlemeLink");
				resimOnizleme.src=dAktar;
				resimOnizlemeLink.setAttribute("rel",dAktar);
				$(".SlaytPencereEnDis").css("display:block");
			}
			else{
				var uzanti = dAktar.split('.').pop();
				if((chmod == 'video')||(chmod == 'flash'))
				{
					if(video_etiketi.match(uzanti))
					{
						var ekod = yukleme_video;
						ekod = ekod.replace("{VIDEO}", dAktar);
						ekod = ekod.replace("{TYPE}", "video/"+uzanti);
					}
					else {
						var ekod = yukleme_embed;
						ekod = ekod.replace("{VIDEO}", dAktar);
						ekod = ekod.replace("{TYPE}", "video/"+uzanti);
						ortala=false;
					}
				}
				else{
					var ekod = yukleme_audio;
					ekod = ekod.replace("{VIDEO}", dAktar);
					ekod = ekod.replace("{TYPE}", "audio/"+uzanti);
				}
				$("#Onizleme").html(ekod);
				$(".SlaytPencereEnDis").css("display:block");
			}
			var secililer = '';
		}



		// DOSYA EKLE
		else if(hangiIslem == 'textareaEkleCoklu')
		{
			var sec = document.getElementsByName("sec[]");
			var textarea = window.document.getElementById(yukleme_duzenleyici_id);
			var veri = '';

			// SEÇİLEN TÜM DOSYALARIN İSİMLERİ VİRGÜL İLE AYIRILARAK PEŞ PEŞE YAZDIRILIYOR
			for(var i=1; i < sec.length; i++)
			{
				if(sec[i].checked == true)
				{
					if(sec[i].getAttribute('rel') != null)
					{
						var relAktar = sec[i].getAttribute('rel');
						relAktar = relAktar.replace("http://", "");
						relAktar = relAktar.replace("https://", "");
						relAktar = relAktar.replace("//", "/");
						relAktar = '//'+relAktar;

						var uzantilar = new Array();
						var uzantilar = relAktar.split('.');
						var uzanti = uzantilar[uzantilar.length-1];

						var dosyaadlari = new Array();
						var dosyaadlari = relAktar.split('/');
						var dosyaadlar = dosyaadlari[dosyaadlari.length-1];

						if ((uzanti == 'jpeg')||(uzanti == 'jpg')||(uzanti == 'gif')||(uzanti == 'png')||(uzanti == 'bmp')||(uzanti == 'ico'))
						{
							var kucukdosya;
							if ((uzanti == 'jpeg')||(uzanti == 'jpg')){
								kucukdosya = relAktar.replace(dosyaadlar, "k/"+dosyaadlar);
								img=new Image();
								img.src=kucukdosya;
								img.onload=function(){};
								if(img.width==0) kucukdosya = relAktar;
							}
							else if (uzanti == 'png'){
								kucukdosya = relAktar.replace(dosyaadlar, "k/"+dosyaadlar);
								kucukdosya = kucukdosya.replace(uzanti, "jpg");
								img=new Image();
								img.src=kucukdosya;
								img.onload=function(){};
								if(img.width==0) kucukdosya = relAktar;
							}
							else kucukdosya = relAktar;

							if (duzenleyici_bicim=="html") veri += '<div class="resim_boyutlandir"><a href="'+relAktar+'"><img src="'+kucukdosya+'"></a></div>'+"\n";
							else{
								if ((window.document.getElementById(yukleme_duzenleyici_katman)!= null)&&(window.document.getElementById(yukleme_duzenleyici_katman).style.display=="none")||(typeof($.sceditor) !== "undefined"))
									veri += '[url='+relAktar+'][img]'+kucukdosya+'[/img][/url]'+"\n";
								else veri += '<a href="'+relAktar+'"><img src="'+kucukdosya+'"></a>'+"\n";
							}
						}

						else if ((uzanti == 'mp4')||(uzanti == 'webm')||(uzanti == 'ogg')||(uzanti == 'ogv')||(uzanti == 'ogx')||(uzanti == 'ogm')){
							var ekod = yukleme_video;
							ekod = ekod.replace("{VIDEO}", ""+relAktar);
							ekod = ekod.replace("{TYPE}", "video/"+uzanti);
							if (duzenleyici_bicim=="html") veri += ekod+"\n";
							else veri += "[video]"+relAktar+"[/video]"+"\n";
						}

						else if ((uzanti == 'swf')||(uzanti == 'flv')||(uzanti == 'mp2')||(uzanti == 'mpg')||(uzanti == 'mpeg')||(uzanti == 'mov')||(uzanti == 'wmv')||(uzanti == 'avi')||(uzanti == '3gp')){
							var ekod = yukleme_embed;
							ekod = ekod.replace("{VIDEO}", ""+relAktar);
							ekod = ekod.replace("{TYPE}", "video/"+uzanti);
							if (duzenleyici_bicim=="html") veri += ekod+"\n";
							else veri += "[video]"+relAktar+"[/video]"+"\n";
						}

						else if ((uzanti == 'mp3')||(uzanti == 'wav')||(uzanti == 'ogg')||(uzanti == 'oga')||(uzanti == 'opus')||(uzanti == 'spx')||(uzanti == 'flac')||(uzanti == 'aif')){
							var ekod = yukleme_audio;
							ekod = ekod.replace("{VIDEO}", ""+relAktar);
							ekod = ekod.replace("{TYPE}", "audio/"+uzanti);
							if (duzenleyici_bicim=="html") veri += ekod+"\n";
							else veri += "[audio]"+relAktar+"[/audio]"+"\n";
						}

						else{
							if (duzenleyici_bicim=="html") veri += '<a href="'+relAktar+'"><b>'+dosyaadlar+'</b></a>'+"\n<br>";
							else{
								if ((window.document.getElementById(yukleme_duzenleyici_katman)!= null)&&(window.document.getElementById(yukleme_duzenleyici_katman).style.display=="none")||(typeof($.sceditor) !== "undefined"))
									veri += "[url="+relAktar+"][b]"+dosyaadlar+"[/b][/url]"+"\n";
								else veri += '<a href="'+relAktar+'"><b>'+dosyaadlar+'</b></a>'+"\n<br>";
							}
						}
					}
					sec[i].checked = false;
				}
			}

			DosyaEkle(veri);
			var secililer = '';
			YuklemeAcKapat();
		}


		// DOSYA VEYA KLASÖR SİL
		else if(hangiIslem == 'sil')
		{
			if (window.confirm(jsl["sil_uyari"]))
			{
				var sec = document.getElementsByName("sec[]");
				var secililer = ',';

				// SEÇİLEN TÜM DOSYALARIN İSİMLERİ VİRGÜL İLE AYIRILARAK PEŞ PEŞE YAZDIRILIYOR
				for(var i=1; i < sec.length; i++){
					if(sec[i].checked == true) secililer += sec[i].value +',';
				}
				if(secililer == ',') secililer = '';
			} else secililer = '';
		}



		// KLASÖR OLUŞTUR
		else if(hangiIslem == 'klasorOlstr')
		{
			var klsrolstr = document.getElementById("kisim");
			if(klsrolstr.value == '') secililer = '';
			else secililer = 'dolu';
		}



		// DOSYAYI VEYA KLASÖRÜ YENİDEN ADLANDIR
		else if(hangiIslem == 'yenidenadlandir')
		{
			var yeniAd = prompt(jsl["yeniden_adlandir"], dosyaIsim);

			if (yeniAd!=null) secililer = 'dolu';
			else secililer = '';
		}



		// DEĞİŞKEN BOŞ DEĞİLSE İŞLEM YAP
		if(secililer != '')
		{
			// DOSYA SİLME POST İŞLEMİ
			if(hangiIslem == 'sil') var veri_yolla ='sil='+secililer+'&vericek='+dizinim;

			// KLASÖR OLUŞTURMA POST İŞLEMİ
			else if(hangiIslem == 'klasorOlstr') var veri_yolla ='klasorolustur='+klsrolstr.value+'&vericek='+dizinim;

			// YENİDEN İSİMLENDİRME POST İŞLEMİ
			else if(hangiIslem == 'yenidenadlandir') var veri_yolla ='yenidenadlandir='+dosyaIsim+"|"+yeniAd+'&vericek='+dizinim;

			// VERİLERİ ÇEKME POST İŞLEMİ
			else if(hangiIslem == 'vericek') var veri_yolla ='vericek='+dizinim+"&dds="+ddsayfa;

			if (window.XMLHttpRequest) var VeriGonder=new XMLHttpRequest();
			else var VeriGonder=new ActiveXObject("Microsoft.XMLHTTP");


			VeriGonder.onreadystatechange =(function()
			{
				if (VeriGonder.readyState == 4 && VeriGonder.status==200)
				{
					// TÜM İŞLEMLER
					if(hangiIslem != 'vericek')
					{
						document.getElementById("kisim").value="";
						document.getElementById("klasorAdi").style.display="none";
						alert(VeriGonder.responseText);
						Tazele();
					}

					// EKRANA DOSYA VE KLASÖR LİSTELEME İŞLEMİ
					else document.getElementById("yenilemeAlani").innerHTML = VeriGonder.responseText;
				}
			});


			// AJAX POST
			VeriGonder.open("POST",''+duzenleyici_dizin+'phpkf-bilesenler/yukleme/index.php',true);
			VeriGonder.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=utf-8");
			VeriGonder.send(veri_yolla);
		}
	},100);
}

function yeniPencere(){
	window.open(document.getElementById("resimOnizlemeLink").getAttribute('rel'),'_blank','scrollbars=yes,left=0,top=0,resizable=yes,toolbar=0,status=0,width='+screen.width+',height='+screen.height);
}

function endisKutuKapat(){
	$(".SlaytPencereEnDis").css("display:none");
	$("#Onizleme").html("&nbsp;");
}

document.onkeyup = function(e){
	if (e.keyCode==27) endisKutuKapat();
}

function DosyaEkle(dosya)
{
	if (typeof(tinyMCE) !== "undefined") var Btinymce = tinyMCE.activeEditor;
	else var Btinymce = "";

	if (typeof($.sceditor) !== "undefined"){
		if ($("#"+yukleme_duzenleyici_id).sceditor("instance")) var Bsceditor = yukleme_duzenleyici_id;
		else var Bsceditor = "";
	}
	else var Bsceditor = "";


	// tinyMCE için
	if (Btinymce.id==yukleme_duzenleyici_id)
	{
		Btinymce.focus();
		Btinymce.selection.setContent(dosya);
	}

	// CKEditor için
	else if ( (typeof(CKEDITOR) !== "undefined") && (typeof(CKEDITOR.instances[yukleme_duzenleyici_id]) !== "undefined") )
	{
		CKEDITOR.instances[yukleme_duzenleyici_id].insertHtml(dosya);
	}

	// SCEditor için
	else if (Bsceditor==yukleme_duzenleyici_id)
	{
		$("#"+yukleme_duzenleyici_id).sceditor("instance").focus();
		var veri = $("#"+yukleme_duzenleyici_id).sceditor("instance").val();
		$("#"+yukleme_duzenleyici_id).sceditor("instance").val(veri+dosya);
	}

	// phpKF ve diğer editörler için
	else
	{
		if (window.document.getElementById(yukleme_duzenleyici_id) != null) window.document.getElementById(yukleme_duzenleyici_id).value += dosya;
		if (window.document.getElementById(yukleme_duzenleyici_katman) != null){
			window.document.getElementById(yukleme_duzenleyici_katman).innerHTML += dosya;
			if (window.document.getElementById(yukleme_duzenleyici_katman).className == "gformlar_mesajyaz") ResimIslem(yukleme_duzenleyici_katman);
		}
	}
}


function anaDizin()
{
	window.location = window.location.href.split("#")[0]+"#dds=0#ddyuk=/";
	$("#yenilemeAlani").html("");
	Tazele();
	return false;
}


function sayfaArttir(kip)
{
	var dds = 0;
	var dizinim = "/";
	var adres = window.location.hash;

	var myRegexp = /(.*?)#ddyuk=(.*?)$/;
	var match = myRegexp.exec(adres);
	if (match) dizinim = match[2];
	else dizinim = "/";
	dizinim = dizinim.replace("..", "");
	dizinim = dizinim.replace("//", "/");
	dizinim = dizinim.replace("#", "");

	var myRegexp = /(.*?)#dds=([a-z0-9]*?)#/;
	var match = myRegexp.exec(adres);
	if (match)
	{
		dds = match[2];
		dds = dds.replace("..", "");
		dds = dds.replace("//", "/");
		dds = dds.replace("#", "");
		dds = parseInt(dds);
	}
	if (!dds) dds = 0;
	if (kip=="bas") dds = 0;
	else if (kip=="geri") dds--;
	else if (kip=="eksiuc") dds-=3;
	else if (kip=="eksibes") dds-=5;
	else if (kip=="ileri") dds++;
	else if (kip=="artiuc") dds+=3;
	else if (kip=="artibes") dds+=5;
	if (dds < 0) dds = 0;

	window.scrollTo(0,0);
	window.location = window.location.href.split("#")[0]+"#dds="+dds+"#ddyuk="+dizinim;
	$("#yenilemeAlani").html("");
	if (kip!="guncel") Tazele();
	return false;
}

//  -->