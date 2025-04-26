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


$(".yonetim-menu").classGecis("goster", "gizle");
$(".i").classEkle("arti").html("+");

$(".ara-baslik").tik(function(e)
{
	var a = this.parentNode;

	if ($(this).ilk().bul("i").html() == "+")
	{
		$(this).ilk().bul("i").classSil("arti").html("-");
		$(a).ilk().bul("div").uye("1").classGecis("gizle", "goster");
	}
	else
	{
		$(this).ilk().bul("i").classEkle("arti").html("+");
		$(a).ilk().bul("div").uye("1").classGecis("goster", "gizle");
	}
});


if(document.getElementById("yonetimMenu"))
{
	var adres = window.location.href;
	var adres_dosya =  adres.substring(adres.lastIndexOf("/")+1);
	var adres_dosya2 =  adres.split('/').pop().split('#')[0].split('?')[0];
	var toplam_link = document.getElementById("yonetimMenu").querySelectorAll("li").length;
	var menuLinkler = $("#yonetimMenu li");

	for (i=toplam_link-1; i=>0; i--)
	{
		var bulunan = menuLinkler.uye(i).bul("a");
		if (adres_dosya == "") adres_dosya = "index.php";
		else if (adres_dosya.match(/^hata.php/gi)) adres_dosya = "index.php";
		else if (adres_dosya.match(/^hatalar.php/gi)) adres_dosya = "index.php";
		else if (adres_dosya.match(/^uye_degistir.php/gi)) adres_dosya = "uyeler.php";
		else if (adres_dosya.match(/^forum_duzen.php/gi)) adres_dosya = "forumlar.php";
		else if (adres_dosya.match(/ktip=0&kip=duzenle&/gi)) adres_dosya = "yazi_ekle.php?ktip=0";
		else if (adres_dosya.match(/ktip=1&kip=duzenle&/gi)) adres_dosya = "yazi_ekle.php?ktip=1";
		else if (adres_dosya.match(/ktip=2&kip=duzenle&/gi)) adres_dosya = "yazi_ekle.php?ktip=2";

		if ((bulunan.attrGetir("href") == adres_dosya) || (bulunan.attrGetir("href") == adres_dosya2))
		{
			bulunan.classEkle("active");
			a = menuLinkler.uye(i).don().parentNode.parentNode;
			b = a.parentNode;
			c = $(b).ilk().bul("div").uye("0");
			$(a).classGecis("gizle", "goster");
			$(c).ilk().bul("i").classSil("arti").html("-");
			break;
		}
	}
}
//  -->