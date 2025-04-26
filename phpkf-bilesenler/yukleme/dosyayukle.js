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


Tazele();

(function() {
	// getElementById
	function $id(id) {
		return document.getElementById(id);
	}


	function dosyaYukle(dosya)
	{
		setTimeout(function()
		{
			var adres = window.location.hash;
			var myRegexp = /(.*?)ddyuk=(.*?)$/;
			var match = myRegexp.exec(adres);
			if (match) dizinim = match[2];
			else dizinim = "";
			dizinim = dizinim.replace("..", "");
			dizinim = dizinim.replace("//", "/");
			dizinim = dizinim.replace("#", "");

			if (location.host.indexOf("sitepointstatic") >= 0) return

			if (window.XMLHttpRequest) var veriGonder=new XMLHttpRequest();
			else var veriGonder=new ActiveXObject("Microsoft.XMLHTTP");

			if (veriGonder.upload && dosya.size <= $id("yuklemeBoyutuSiniri").value)
			{
				// yukleme çubuğu oluşturuluyor
				var o = $id("yuklemecubugu");

				var yuklemecubugu1 = o.appendChild(document.createElement("div"));
				yuklemecubugu1.style.width = "300px";
				yuklemecubugu1.style.height = "80px";
				yuklemecubugu1.style.margin = "5px";
				yuklemecubugu1.style.padding = "10px";
				yuklemecubugu1.style.border = "1px solid #58ABD0";
				yuklemecubugu1.style.borderRadius = "10px";
				yuklemecubugu1.style.fontSize = "12px";
				yuklemecubugu1.style.overflow = "hidden";
				yuklemecubugu1.style.whiteSpace = "nowrap";
				yuklemecubugu1.style.textOverflow = "ellipsis";
				yuklemecubugu1.style.background = "white";
				yuklemecubugu1.style.textAlign = "center";
				var yuklemecubugu2 = yuklemecubugu1.appendChild(document.createElement("span"));
				var yuklemecubugu3 = yuklemecubugu1.appendChild(document.createElement("p"));
				yuklemecubugu1.appendChild(document.createTextNode(dosya.name));
				yuklemecubugu2.appendChild(document.createTextNode(jsl["yukleniyor"]));
				yuklemecubugu3.innerHTML = "&nbsp;";


				// yuklemecubugu bar
				veriGonder.upload.addEventListener("progress", function(e) {
					var pc1 = parseInt(100 - (e.loaded / e.total * 100));
					var pc2 = parseInt(0 + (e.loaded / e.total * 100));
					yuklemecubugu3.style.backgroundPosition = pc1 + "% 0";
					yuklemecubugu3.innerHTML = "%" + pc2;
				}, false);


				// dosya yükleme durumu
				veriGonder.onreadystatechange = function() {
					if (veriGonder.readyState == 4) {
						if(veriGonder.status == 200)
						{
							if (veriGonder.responseText == "yuklendi"){
								yuklemecubugu3.className = "yuklendi";
							}
							else if (veriGonder.responseText == "dosyabuyuk"){
								yuklemecubugu3.className = "hataolustu";
								yuklemecubugu3.innerHTML = jsl["dosya_buyuk"]+"<br>"+jsl["azami_dosya_boyutu"]+": "+(azami_boyut/1024)+" kb.";
								alert(jsl["dosya_buyuk"]+"\n\n"+jsl["azami_dosya_boyutu"]+": "+(azami_boyut/1024)+" kb.\n\n");
								return false;
							}
							else if (veriGonder.responseText == "kotadolu"){
								yuklemecubugu3.className = "hataolustu";
								yuklemecubugu3.innerHTML = jsl["kota_dolu"];
								alert(jsl["kota_dolu"]);
								return false;
							}
							else if (veriGonder.responseText == "desteklenmeyen"){
								yuklemecubugu3.className = "hataolustu";
								yuklemecubugu3.innerHTML = jsl["desteklenmeyen_dosya"];
								alert(jsl["desteklenmeyen_dosya"]);
							}
							else{
								yuklemecubugu3.className = "hataolustu";
							}
							setTimeout(function(){yuklemecubugu1.style.display = "none";},3000);
							setTimeout(function(){Tazele();},500);
						}
						else
						{
							yuklemecubugu3.className = "hataolustu";
							setTimeout(function(){yuklemecubugu1.style.display = "none";},3000);
							setTimeout(function(){Tazele();},500);
						}
					}
				};

				// yükleme başlatılıyor
				veriGonder.open("POST", duzenleyici_dizin+"phpkf-bilesenler/yukleme/index.php", true);
				veriGonder.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=utf-8");
				veriGonder.setRequestHeader("DOSYA-ADI", encodeURIComponent(dosya.name));
				veriGonder.setRequestHeader("VERICEK", encodeURIComponent(dizinim));
				veriGonder.send(dosya);
			}
		},300);
		
	}


	// Başlat
	function Baslat()
	{
		var dosyasecimi = $id("dosyasecimi"),
			dosyassurukleme = $id("dosyassurukleme");

			dosyasecimi.style.visibility = "hidden";
			dosyasecimi.style.position = "absolute";


		// dosya seçimi
		dosyasecimi.addEventListener("change", SecilenDosyalar, false);


		if (dosyassurukleme.addEventListener) {
			dosyassurukleme.addEventListener("dragenter", dosyaDragHover, false);
			dosyassurukleme.addEventListener("dragover", dosyaDragHover, false);
			dosyassurukleme.addEventListener("dragleave", dosyaDragHover, false);
			dosyassurukleme.addEventListener("drop", SecilenDosyalar, false);
		}
		else {
			if (dosyassurukleme.attachEvent) {
				dosyassurukleme.attachEvent("ondragenter", dosyaDragHover);
				dosyassurukleme.attachEvent("ondragover", dosyaDragHover);
				dosyassurukleme.attachEvent("ondragleave", dosyaDragHover);
				dosyassurukleme.attachEvent("ondrop", SecilenDosyalar);
			}
		}
		dosyassurukleme.style.display = "block";
	}


	// dosya sürükleme alanı
	function dosyaDragHover(e)
	{
		e.cancelBubble = true;
		e.stopPropagation();
		e.preventDefault();
		e.target.className = (e.type == "dragover" ? "hover" : "");
	}


	// dosya seçimi
	function SecilenDosyalar(e) {

		// etkinliği iptal et ve stil değiştir
		dosyaDragHover(e);

		// dosya listesi nesnesi
		var dosyalar = e.target.files || e.dataTransfer.files;

		// tüm dosya nesnelerini işle
		for (var i = 0, d; d = dosyalar[i]; i++) {
			dosyaYukle(d);
		}
	}

	if (window.File && window.FileList && window.FileReader) {
		Baslat();
	}

})();

//  -->