<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>
<!--__KOSUL_BASLAT-1__--><!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="temalar/varsayilan/sablon.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="temalar/varsayilan/resimler/favicon.ico">
<title>Forum Üyelik Koşulları</title>
</head>
<body style="margin:20px">

<div align="center" style="position:relative; width:100%; height:10px;"></div>


<table cellspacing="0" cellpadding="10" border="0" align="center" class="genel-tablo" style="width:100%">
	<tr>
	<td align="center" valign="bottom" class="forum-kategori-baslik">
<font color="#ff0000">.:: Forum Üyelik Koşulları ::.</font>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="left">
<b> &nbsp; Foruma üye olmak için aşağıdaki maddeleri kabul etmeniz gerekmektedir.</b><br>

<ul style="padding:15px; margin:0px; font-size:13px; line-height:25px">
<li>Foruma yazdığınız içeriğin sorumluluğu tamamen size aittir, yazdığınız içerikten forum yazarı veya forum yöneticileri sorumlu tutulamaz.</li>

<li>Foruma mesaj attığınızda, tarihiyle birlikte ip adresiniz (internetteki kimliğiniz) de kaydedilir.</li>

<li>Forum yöneticileri uygunsuz bulduğu mesajları değiştirme ve/veya silme, üyeliğinizi iptal etme hakkına sahiptir.</li>

<li>Forumda yasaları aykırı her türlü yazı yazılması kesinlikle yasaktır.</li>

<li>Kopya yazılım, kopya müzik, hack, crack, warez gibi dosyaların veya içeriğin yazılması yasaktır.</li>

<li>Müstehcen, kaba, iftira niteliğinde, tehdit edici yazılar yazılması yasaktır.</li>

<li>Foruma yazdığınız yazıların yüz binlerce kişi tarafından okunabileceğini düşünerek; Türkçemize yakışan, imla kurallarına uygun güzel bir dille yazın.</li>

<li>Yukarıdaki maddelerin değiştirilme hakkı saklıdır.</li>
</ul>

</td></tr></table>
</body>
</html>

<!--__KOSUL_BITIR-1__-->



<!--__KOSUL_BASLAT-2__-->



<script type="text/javascript">
<!-- //
function SayiArttir(){
	var now = new Date();
	var sayac = Math.random();
	sayac++;
	document.images.onaykodu.src="bilesenler/onay_kodu.php?a=1&sayi="+sayac+"&oturum={SESSION_ID}";
}
//  -->
</script>

{JAVASCRIPT_KODU}


<form action="bilesenler/kayit_yap.php" method="post" onsubmit="return denetle()" name="form1">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu" />


<table cellspacing="0" cellpadding="0" border="0" align="center" class="genel-tablo" style="max-width:600px">
	<tr>
	<td class="forum-kategori-baslik" colspan="2" align="center" valign="middle">
Kullanıcı Kayıt
	</td>
	</tr>

	<tr>
	<td class="liste-veri" style="padding:15px;">

<table cellspacing="1" width="95%" cellpadding="10" border="0" align="center" bgcolor="#bbbbbb">
	<tr>
	<td class="liste-veri" bgcolor="#eeeeee" height="68" align="left" valign="top" id="kayityardim">

Tıkladığınız form alanıyla ilgili yardım bilgileri bu kısımda gösterilecektir.
Ayrıca her alanın sağ tarafındaki beliren küçük simge, size girdiğiniz verinin doğruluğunu göstecektir.<br><br>
<i>* Tüm alanların doldurulması zorunludur!</i>

	</td>
	</tr>
</table>

	</td>
	</tr>


	<tr>
	<td>

{EK_GIRISLER}

<table cellspacing="1" width="90%" cellpadding="10" border="0" align="center" class="tablo_border3">
	<tr bgcolor="#fafafa">
	<td align="left" class="liste-etiket" width="42%">
Kullanıcı Adı: 
	</td>

	<td align="left" class="liste-veri" width="58%">
<div style="float:left; width:90%">
<input type="text" class="formlar" name="kullanici_adi" style="width:90%" maxlength="20" value="{KULLANICI_ADI}" onblur="KAdi()" onclick="document.getElementById('kayityardim').innerHTML='<b>Kullanıcı Adı:</b>  En az 4, en fazla 20 karakter olabilir.<br>Latin ve Türkçe harf, rakam, alt çizgi( _ ), tire ( - ), nokta ( . ) kullanılabilir.<br>Bunların dışındaki özel karakterleri ve boşluk karakterini içeremez.'" onkeyup="javascript:dogrula(this.name,this.value)" required /> &nbsp; </div> 

<div style="float:left; width:20px; height:20px; margin-top:7px;" id="kullanici_adi-alan"></div><br>
<div style="float:left; width:100%; height:18px; top:5px; font-size:10px; color:#ff0000" id="kullanici_adi-alan2">
<a href="javascript:void(0);" onclick="KAdi()"><b>Kontrol Et</b></a>
</div>
	</td>
	</tr>



	<tr class="liste-etiket" bgcolor="#fafafa">
	<td align="left">
E-Posta Adresiniz:
<br>
<font style="font-weight: normal;" size="1">
Etkinleştirme için doğru olmalıdır.
</font>
	</td>

	<td align="left">
<div style="float:left; width:90%">
<input type="text" class="formlar" name="posta" style="width:90%" maxlength="70" value="{EPOSTA}" onclick="document.getElementById('kayityardim').innerHTML='<b>E-Posta Adresiniz:</b>  Gerçek ve çalışan bir E-Posta adresi girin. <br>Kayıttan sonra hesabınızın etkinleştirilmesi için E-Posta adresinizin doğru ve çalışır olması gerekmektedir.'" onkeyup="javascript:dogrula(this.name,this.value)" required /> &nbsp; 
<br><label style="cursor: pointer;"><input type="checkbox" name="eposta_gizle" onclick="document.getElementById('kayityardim').innerHTML='<b>E-Posta adresini gizle:</b>  E-Posta adresinizin profilinizde görünmemesi için bu kutucuğu tıklayın.'" />
<font style="font-size: 11px; font-weight: normal; font-style: italic;">E-Posta adresini gizle</font></label>
 &nbsp; </div>

<div style="float:left; width:20px; height:20px; margin-top:7px" id="posta-alan"></div>
	</td>
	</tr>



	<tr class="liste-etiket" bgcolor="#fafafa">
	<td align="left">
Şifre:
	</td>

	<td align="left">
<div style="float:left; width:90%">
<input type="password" class="formlar" name="sifre" style="width:90%" maxlength="20" value="" onclick="document.getElementById('kayityardim').innerHTML='<b>Şifre:</b>  En az 5, en fazla 20 karakter olabilir.<br>Latin harf, rakam, alt çizgi( _ ), tire ( - ), and ( & ), nokta ( . ) kullanılabilir. <br>Bunların dışındaki özel karakterleri, Türkçe karakterleri ve boşluk karakterini içeremez.<br>Büyük - küçük harf ayrımı vardır.'" onkeyup="javascript:dogrula(this.name,this.value)" required /> &nbsp; </div>

<div style="float:left; width:20px; height:20px; margin-top:7px" id="sifre-alan"></div>
	</td>
	</tr>



	<tr class="liste-etiket" bgcolor="#fafafa">
	<td align="left">
Şifre Onay: 
	</td>

	<td align="left">
<div style="float:left; width:90%">
<input type="password" class="formlar" name="sifre2" style="width:90%" maxlength="20" value="" onclick="document.getElementById('kayityardim').innerHTML='<b>Şifre Onay:</b>  Bir yukarı girdiğiniz şifrenin aynısını tekrar girin. En az 5, en fazla 20 karakter olabilir. Latin harf, rakam, alt çizgi( _ ), tire ( - ), and ( & ), nokta ( . ) kullanılabilir. Bunların dışındaki özel karakterleri, Türkçe karakterleri ve boşluk karakterini içeremez. Büyük - küçük harf ayrımı vardır.'" onkeyup="javascript:dogrula(this.name,this.value)" required /> &nbsp; </div>

<div style="float:left; width:20px; height:20px; margin-top:7px" id="sifre2-alan"></div>
	</td>
	</tr>


<!--__KOSUL_BASLAT-4__-->

	<tr class="liste-etiket" bgcolor="#fafafa">
	<td align="left">
Onay Kodu:
	</td>

	<td align="left">
<img src="bilesenler/onay_kodu.php?a=1&amp;oturum={ONAY_ID}" title="Bu onay kodunu alttaki alana yazın" alt="Bu onay kodunu alttaki alana yazın" id="onaykodu" border="1" width="200" height="40"> &nbsp; &nbsp; 
<img src="temalar/varsayilan/resimler/yenile.png" title="Onay kodunu değiştirmek için tıklayın" alt="Onay kodunu değiştirmek için tıklayın" style="cursor: pointer;" onclick="javascript:SayiArttir()" border="0" width="25" height="31">
	</td>
	</tr>



	<tr class="liste-etiket" bgcolor="#fafafa">
	<td align="left">
Üstteki onay kodunu giriniz.<br>
<font style="font-weight: normal;" size="1">
Resimdeki renkli karakterleri giriniz.
</font>
	</td>

	<td align="left">
<div style="float: left; position: relative;">
<input type="text" class="formlar" name="onay_kodu" id="onay_kodu" size="8" style="width: 70px" maxlength="6" onclick="document.getElementById('kayityardim').innerHTML='<b>Onay Kodu:</b> Resimdeki renkli harf ve sayılardan oluşan 6 karakterlik kodu giriniz.<br> Okumakta güçlük çekiyorsanız, sağ tarafındaki grafiği tıklayarak kodu değiştirin.<br> Büyük - küçük harf ayrımı yoktur.'" onkeyup="javascript:dogrula(this.name,this.value)" required /> &nbsp; </div>

<div style="float:left; width:20px; height:20px; margin-top:7px" id="onay_kodu-alan"></div>
<script type="text/javascript">
<!-- //
document.form1.onay_kodu.setAttribute("autocomplete","off");
//  -->
</script>
	</td>
	</tr>

<!--__KOSUL_BITIR-4__-->


<!--__KOSUL_BASLAT-3__-->

	<tr class="liste-etiket" bgcolor="#fafafa">
	<td align="left">
Kayıt Güvenlik Sorusu:<br>
<font style="font-weight: normal;">
{KAYIT_SORUSU}
</font>
	</td>

	<td align="left">
<input type="text" class="formlar" name="kayit_cevabi" style="width:80%" maxlength="100" value="{KAYIT_CEVABI}" onclick="document.getElementById('kayityardim').innerHTML='<b>Kayıt Güvenlik Sorusu:</b>  Sol tarafındaki basit sorunun cevabını yazın.'" onkeyup="javascript:dogrula(this.name,this.value)" required />
	</td>
	</tr>


<!--__KOSUL_BITIR-3__-->

</table>


	<tr>
	<td align="center" valign="middle" height="25" class="liste-etiket" bgcolor="#ffffff">
<label style="cursor: pointer;"><input type="checkbox" name="kosul" style="position:relative; top:2px;" required />
<b style="font-size: 11px; text-decoration:none">Üyelik koşullarını okudum ve kabul ediyorum.</b>
</label> &nbsp; - <a href="javascript:void(0);" onclick="window.open('kayit.php?kosul=kabul', 'uyelik_kosul', 'resizable=yes,toolbar=0,status=0,width=670,height=475');return false;" style="font-size: 10px;">üyelik koşulları</a> -<br>
	</td>
	</tr>

	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="center" valign="middle">
<br>
<input type="hidden" name="oturum" value="{PHP_SESSID}" />
<input class="dugme" type="submit" value="Kaydol" />
 &nbsp; &nbsp; 
<input class="dugme" type="reset" value="Temizle" />
<br>
<br>
	</td>
	</tr>
</table>

</form>

<div style="display: none">
<img width="0" height="0" border="0" src="temalar/varsayilan/resimler/dogru.png" alt="doğru">
<img width="0" height="0" border="0" src="temalar/varsayilan/resimler/yanlis.png" alt="yanlış">
<img width="0" height="0" border="0" src="dosyalar/yukleniyor.gif" alt="yükleniyor">
</div>

<script type="text/javascript">
<!-- //
document.form1.sifre.setAttribute("autocomplete","off");
document.form1.sifre2.setAttribute("autocomplete","off");
//  -->
</script>

<!--__KOSUL_BITIR-2__-->

