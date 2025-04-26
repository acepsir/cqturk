<?php
/*
 +-=========================================================================-+
 |                       php Kolay Forum (phpKF) v2.10                       |
 +---------------------------------------------------------------------------+
 |               Telif - Copyright (c) 2007 - 2017 phpKF Ekibi               |
 |                 http://www.phpKF.com   -   phpKF@phpKF.com                |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkartma ve satma hakları sadece phpKF`ye aittir.|
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  www.phpKF.com  adresini ziyaret edin.       |
 +-=========================================================================-+*/


if (!defined('DOSYA_AYAR')) include '../ayar.php';
if (!defined('DOSYA_YONETIM_GUVENLIK')) include 'bilesenler/guvenlik.php';
if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';


//  FORM DOLU İSE  //

if ((isset($_POST['kayit_yapildi_mi'])) AND ($_POST['kayit_yapildi_mi'] == 'form_dolu')):


// yönetim oturum kodu
if (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';


// yönetim oturum kodu kontrol ediliyor
if ($gyo != $yo)
{
	header('Location: hata.php?hata=45');
	exit();
}


// tüm alanlara bakılıyor

if ( (!$_POST['kullanici_adi']) OR (!$_POST['posta']) OR (!$_POST['sifre']) OR (!$_POST['sifre2']) )
{
	header('Location: hata.php?hata=26');
	exit();
}


if (!preg_match('/^[A-Za-z0-9-_ğĞüÜŞşİıÖöÇç.]+$/', $_POST['kullanici_adi']))
{
	header('Location: hata.php?hata=27');
	exit();
}

if (( strlen($_POST['kullanici_adi']) > 20) OR ( strlen($_POST['kullanici_adi']) < 4))
{
	header('Location: hata.php?hata=28');
	exit();
}

if ($_POST['sifre'] != $_POST['sifre2'])
{
	header('Location: hata.php?hata=33');
	exit();
}

if (!preg_match('/^[A-Za-z0-9-_.&]+$/', $_POST['sifre']))
{
	header('Location: hata.php?hata=34');
	exit();
}

if (( strlen($_POST['sifre']) > 20) OR ( strlen($_POST['sifre']) < 5))
{
	header('Location: hata.php?hata=35');
	exit();
}

if ( strlen($_POST['posta']) > 70)
{
	header('Location: hata.php?hata=40');
	exit();
}

if (!preg_match('/^([~&+.0-9a-z_-]+)@(([~&+0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', $_POST['posta']))
{
	header('Location: hata.php?hata=10');
	exit();
}

if (!preg_match('/^[0-9]+$/', $_POST['yetki']))
{
	header('Location: hata.php?hata=148');
	exit();
}



// e-posta gizleme

if (isset($_POST['eposta_gizle'])) $posta_goster = 0;
else $posta_goster = 1;

$_POST['posta'] = $vt->real_escape_string($_POST['posta']);

$tarih = time();


// anahtar değeri şifreyle karıştırılarak sha1 ile kodlanıyor
$karma = sha1(($anahtar.$_POST['sifre']));


// kullanıcı adının daha önce alınıp alınmadığına bakılıyor

$vtsorgu = "SELECT kullanici_adi FROM $tablo_kullanicilar WHERE kullanici_adi='$_POST[kullanici_adi]'";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


// e-posta adresi ile daha önce kayıt yapılıp yapılmadığına bakılıyor

$vtsorgu = "SELECT posta FROM $tablo_kullanicilar WHERE posta='$_POST[posta]'";
$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());

if ($vt->num_rows($vtsonuc))
{
	header('Location: hata.php?hata=42');
	exit();
}

elseif ($vt->num_rows($vtsonuc2))
{
	header('Location: hata.php?hata=43');
	exit();
}




//  ÜYE KAYDI YAPILIYOR  //

$vtsorgu = "INSERT INTO $tablo_kullanicilar (kullanici_adi, sifre, posta, posta_goster, dogum_tarihi_goster, sehir_goster, gercek_ad, dogum_tarihi, katilim_tarihi, sehir, kul_etkin, son_giris, son_hareket, kul_ip, yetki, hangi_sayfada,sayfano)";
$vtsorgu .= "VALUES ('$_POST[kullanici_adi]','$karma','$_POST[posta]','$posta_goster',0,0,'$_POST[kullanici_adi]','00-00-0000','$tarih','','1','$tarih','$tarih','$_SERVER[REMOTE_ADDR]', '$_POST[yetki]', 'Kullanıcı çıkış yaptı', '-1')";
$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());

$kulid = $vt->insert_id();


header('Location: hata.php?bilgi=48&fno='.$kulid);
exit();


endif;



$sayfa_adi = 'Yönetim Yeni Üye Oluşturma';
include_once('bilesenler/sayfa_baslik.php');

include_once('temalar/'.$temadizini.'/menu.php');
?>


<script type="text/javascript"><!-- //
//  php Kolay Forum (phpKF)
//  =======================
//  Telif - Copyright (c) 2007 - 2017 phpKF Ekibi
//  http://www.phpkf.com   -   phpkf @ phpkf.com
//  Tüm hakları saklıdır - All Rights Reserved

function denetle(){
var dogruMu = true;
for (var i=0; i<10; i++){
	if (document.form1.elements[i].value == ''){
		dogruMu = false;
		alert('TÜM ALANLARIN DOLDURULMASI ZORUNLUDUR !');
		break;}}
if (document.form1.sifre.value != document.form1.sifre2.value){
	dogruMu = false;
	alert('YAZDIĞINIZ ŞİFRELER UYUŞMUYOR !');}
return dogruMu;}
function Temizle(){
document.getElementById('kullanici_adi_alan2').innerHTML = '<a href="javascript:void(0);" onclick="KAdi()">Kontrol Et</a>';}
function GonderAl(adres,katman){
var katman1 = document.getElementById(katman);
var veri_yolla = "name=value";
if (document.all) var istek = new ActiveXObject("Microsoft.XMLHTTP");
else var istek = new XMLHttpRequest();
istek.open("GET", adres, true);
istek.onreadystatechange = function(){
if (istek.readyState == 4){
	if (istek.status == 200) katman1.innerHTML = istek.responseText;
	else katman1.innerHTML = "<b>Bağlantı Kurulamadı !</b>";}};
istek.send(veri_yolla);}
function KAdi(){
var veri = document.form1.kullanici_adi.value;
if(veri != ''){
var adres = "../kayit.php?kosul=kadi&kadi="+veri;
var katman = "kullanici_adi_alan2";
var katman1 = document.getElementById(katman);
katman1.innerHTML = '<img src="../dosyalar/yukleniyor.gif" width="18" height="18" alt="Yü." title="Yükleniyor...">';
setTimeout("GonderAl('"+adres+"','"+katman+"')",1000);}}
// -->
</script>


<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Yeni Üye Oluşturma</div>
<div class="kutu-icerik">


<form action="yeni_uye.php" method="post" onsubmit="return denetle()" name="form1">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
<input type="hidden" name="yo" value="<?php echo $yo; ?>">


<table cellspacing="1" width="500" cellpadding="5" border="0" align="center" bgcolor="#dddddd">
	<tr class="tablo_ici">
	<td colspan="2" class="liste-veri" align="left" valign="bottom">
<font size="1">
<i>Tüm alanların doldurulması zorunludur!</i>
</font>
	</td>
	</tr>

	<tr class="liste-etiket">
	<td align="left" width="40%" height="40" class="tablo_ici">
Kullanıcı Adı:
	</td>

	<td align="left" width="60%" height="40" class="tablo_ici">
<div style="float: left; position: relative;">
<input type="text" class="formlar" name="kullanici_adi" size="35" style="width: 220px" maxlength="20" value="" onkeyup="javascript:Temizle()" onblur="KAdi()"> &nbsp; </div>

<div style="float: left; width: 20px; height: 20px; position: relative;" id="kullanici_adi_alan"></div><br>
<div style="float: left; width: 250px; height: 18px; position: relative; top: 5px; font-size:10px; color: #ff0000" id="kullanici_adi_alan2">
<a href="javascript:void(0);" onclick="KAdi()">Kontrol Et</a>
</div>
	</td>
	</tr>


	<tr class="liste-etiket">
	<td align="left" height="40" class="tablo_ici">
E-Posta Adresi:
	</td>

	<td align="left" height="40" class="tablo_ici">
<input type="text" class="formlar" name="posta" size="35" style="width: 220px" maxlength="70" value=""><br><label style="cursor: pointer;"><input type="checkbox" name="eposta_gizle">
<font style="font-size: 11px; font-weight: normal; font-style: italic;">E-Posta adresini gizle</font></label>
	</td>
	</tr>


	<tr class="liste-etiket">
	<td align="left" height="40" class="tablo_ici">
Şifre: 
	</td>

	<td align="left" height="40" class="tablo_ici">
<input type="password" class="formlar" name="sifre" size="35" style="width: 220px" maxlength="20" value="">
	</td>
	</tr>


	<tr class="liste-etiket">
	<td align="left" height="40" class="tablo_ici">
Şifre Onay: 
	</td>

	<td align="left" height="40" class="tablo_ici">
<input type="password" class="formlar" name="sifre2" size="35" style="width: 220px" maxlength="20" value="">
	</td>
	</tr>


	<tr class="liste-etiket">
	<td align="left" height="40" class="tablo_ici">
Yetkisi:
	</td>

	<td align="left" height="40" class="tablo_ici">
<select class="formlar" name="yetki">
<option value="0" selected="selected">Kayıtlı Kullanıcı</option>
<option value="2">Forum Yardımcısı</option>
<option value="1">Forum Yöneticisi</option>
</select>
	</td>
	</tr>


	<tr class="liste-etiket">
	<td align="center" valign="middle" height="50" colspan="2" class="tablo_ici">
<input class="dugme" type="submit" value="Kaydol">
 &nbsp; &nbsp; 
<input class="dugme" type="reset" value="Temizle">
	</td>
	</tr>

</table>
</form>

</div>
</div>
</div>

<script type="text/javascript">
<!-- //
document.form1.sifre.setAttribute("autocomplete","off");
document.form1.sifre2.setAttribute("autocomplete","off");
//  -->

</script>

<?php
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/bos.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));
eval(TEMA_UYGULA);
?>