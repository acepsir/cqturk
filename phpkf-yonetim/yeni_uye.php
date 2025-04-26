<?php
/*
 +-=========================================================================-+
 |                                phpKF v3.00                                |
 +---------------------------------------------------------------------------+
 |                  Telif - Copyright (c) 2007 - 2019 phpKF                  |
 |                    www.phpKF.com   -   phpKF@phpKF.com                    |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkarma ve satma hakları sadece phpKF`ye aittir. |
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  phpKF.com/telif.php  adresini ziyaret edin. |
 +-=========================================================================-+*/


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');


// ziyaretçi ip adresi alınıyor
if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
else $ip = $_SERVER['REMOTE_ADDR'];
$ip = zkTemizle4($ip);
$ip = zkTemizle($ip);



//  FORM DOLU İSE  //

if ((isset($_POST['kayit_yapildi_mi'])) AND ($_POST['kayit_yapildi_mi'] == 'form_dolu')):


// yönetim oturum kodu
if (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';


// yönetim oturum kodu kontrol ediliyor
if ($gyo != $yo)
{
	header('Location: hatalar.php?hata=45');
	exit();
}


// tüm alanlara bakılıyor

if ( (!$_POST['kullanici_adi']) OR (!$_POST['posta']) OR (!$_POST['sifre']) OR (!$_POST['sifre2']) )
{
	header('Location: hatalar.php?hata=26');
	exit();
}


if (!preg_match('/^[A-Za-z0-9-_ğĞüÜŞşİıÖöÇç.]+$/', $_POST['kullanici_adi']))
{
	header('Location: hatalar.php?hata=27');
	exit();
}

if (( strlen($_POST['kullanici_adi']) > 20) OR ( strlen($_POST['kullanici_adi']) < 4))
{
	header('Location: hatalar.php?hata=28');
	exit();
}

if ($_POST['sifre'] != $_POST['sifre2'])
{
	header('Location: hatalar.php?hata=33');
	exit();
}

if (!preg_match('/^[A-Za-z0-9-_.&]+$/', $_POST['sifre']))
{
	header('Location: hatalar.php?hata=34');
	exit();
}

if (( strlen($_POST['sifre']) > 20) OR ( strlen($_POST['sifre']) < 5))
{
	header('Location: hatalar.php?hata=35');
	exit();
}

if ( strlen($_POST['posta']) > 70)
{
	header('Location: hatalar.php?hata=40');
	exit();
}

if (!preg_match('/^([~&+.0-9a-z_-]+)@(([~&+0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', $_POST['posta']))
{
	header('Location: hatalar.php?hata=10');
	exit();
}

if (!preg_match('/^[0-9]+$/', $_POST['yetki']))
{
	header('Location: hatalar.php?hata=148');
	exit();
}



// e-posta gizleme

if (isset($_POST['eposta_gizle'])) $posta_goster = 0;
else $posta_goster = 1;

$_POST['posta'] = @zkTemizle($_POST['posta']);

$dogum_tarihi = '00-00-0000';

$tarih = time();


// anahtar değeri şifreyle karıştırılarak sha1 ile kodlanıyor
$karma = sha1(($anahtar.$_POST['sifre']));


// kullanıcı adının daha önce alınıp alınmadığına bakılıyor

$vtsorgu = "SELECT kullanici_adi FROM $tablo_kullanicilar WHERE kullanici_adi='$_POST[kullanici_adi]'";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());


// e-posta adresi ile daha önce kayıt yapılıp yapılmadığına bakılıyor

$vtsorgu = "SELECT posta FROM $tablo_kullanicilar WHERE posta='$_POST[posta]'";
$vtsonuc2 = $vt->query($vtsorgu) or die($vt->hata_ver());

if ($vt->num_rows($vtsonuc))
{
	header('Location: hatalar.php?hata=42');
	exit();
}

elseif ($vt->num_rows($vtsonuc2))
{
	header('Location: hatalar.php?hata=43');
	exit();
}




//  ÜYE KAYDI YAPILIYOR  //

$vtsorgu = "INSERT INTO $tablo_kullanicilar (kullanici_adi, sifre, posta, posta_goster, dogum_tarihi_goster, sehir_goster, gercek_ad, dogum_tarihi, katilim_tarihi, sehir, kul_etkin, son_giris, son_hareket, kul_ip, yetki, hangi_sayfada, sayfano)";
$vtsorgu .= "VALUES ('$_POST[kullanici_adi]','$karma','$_POST[posta]','$posta_goster',0,0,'$_POST[kullanici_adi]','00-00-0000','$tarih','','1','$tarih','$tarih','$ip', '$_POST[yetki]', 'Kullanıcı çıkış yaptı', '-1')";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

$kulid = $vt->insert_id();


header('Location: hatalar.php?bilgi=4&no='.$kulid);
exit();


endif;






$tema_sayfa_icerik = '<script type="text/javascript"><!-- //
//    phpKF
//  =========
//  Telif - Copyright (c) 2007 - 2019 phpKF
//  https://www.phpkf.com   -   phpkf@phpkf.com
//  Tüm hakları saklıdır - All Rights Reserved

function denetle(){
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
return dogruMu;}
function GonderAl(adres,katman){
var katman1 = document.getElementById(katman);
var veri_yolla = "name=value";
if (document.all) var istek = new ActiveXObject("Microsoft.XMLHTTP");
else var istek = new XMLHttpRequest();
istek.open("GET", adres, true);
istek.onreadystatechange = function(){
if (istek.readyState == 4){
	if (istek.status == 200) katman1.innerHTML = istek.responseText;
	else katman1.innerHTML = "<b>"+jsl["baglanti_yok"]+"</b>";}};
istek.send(veri_yolla);}
function KAdi(){
var veri = document.form1.kullanici_adi.value;
if(veri != ""){
var adres = "../'.$phpkf_dosyalar['kayit'].'?kosul=kadi&kadi="+veri;
var katman = "kullanici_adi-alan2";
var katman1 = document.getElementById(katman);
katman1.innerHTML = \'<img src="../phpkf-dosyalar/yukleniyor.gif" width="18" height="18" alt="." title="\'+jsl["yukleniyor"]+\'">\';
setTimeout("GonderAl(\'"+adres+"\',\'"+katman+"\')",1000);}}
//  -->
</script>';


$tema_sayfa_icerik .= '
<form action="yeni_uye.php" method="post" onsubmit="return denetle()" name="form1">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu" />
<input type="hidden" name="yo" value="'.$yo.'" />


<table cellspacing="1" width="450" cellpadding="7" border="0" align="center" class="tablo-ana">
	<tr class="tablo_ici">
	<td colspan="2" class="liste-veri" align="left">
<font size="1">
<i>'.$ly['tum_alanlar_zorunlu'].'</i>
</font>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" width="40%" height="50">'.$l['kullanici_adi'].':</td>

	<td align="left" width="60%" height="50">
<input type="text" placeholder="'.$l['kullanici_adi'].'" name="kullanici_adi" id="kullanici_adi" class="input-text giris-text" maxlength="20" value="" style="width:220px" onkeyup="javascript:dogrula_giris(this.id)" onblur="KAdi()" required />
<div style="padding-top:5px; height:18px; font-size:9px; color:#ff0000" id="kullanici_adi-alan2">
<a href="javascript:void(0)" onclick="KAdi()"><b>'.$l['denetle'].'</b></a>
</div>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" height="50">'.$l['eposta_adresi'].':</td>

	<td align="left" height="50">
<input type="email" placeholder="'.$l['eposta_adresi'].'" name="posta" id="posta" class="input-text giris-text" maxlength="70" value="" style="width:220px" onkeyup="javascript:dogrula_giris(this.id)" required />
<br><label style="cursor: pointer;"><input type="checkbox" name="eposta_gizle" />
<font style="font-size: 11px; font-weight: normal; font-style: italic;">'.$ly['eposta_gizle'].'</font></label>
	</td>
	</tr>


	<tr class="tablo_ici">
	<td align="left" height="50">'.$l['sifre'].':</td>

	<td align="left" height="50">
<input type="password" placeholder="'.$l['sifre'].'" name="sifre" id="sifre" class="input-text giris-text" maxlength="20" value="" style="width:220px" onkeyup="javascript:dogrula_giris(this.id)" required />
	</td>
	</tr>


	<tr class="tablo_ici">
	<td align="left" height="50">'.$l['sifre'].' '.$l['tekrar'].':</td>

	<td align="left" height="50">
<input type="password" placeholder="'.$l['sifre'].' '.$l['tekrar'].'" name="sifre2" id="sifre2" class="input-text giris-text" maxlength="20" value="" style="width:220px" onkeyup="javascript:dogrula_giris(this.id)" required />
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" height="50">'.$l['yetki'].':</td>

	<td align="left" height="50">
<select class="input-text" name="yetki" required>
<option value="0" selected="selected">'.$l['yetkisiz'].'</option>
<option value="3">'.$l['blm_yrd'].'</option>
<option value="2">'.$l['yardimci'].'</option>
<option value="1">'.$l['yonetici'].'</option>
</select>
	</td>
	</tr>


	<tr class="tablo_ici">
	<td align="center" valign="middle" height="50" colspan="2">
<input class="dugme dugme-mavi" type="submit" value="'.$ly['uye_olustur'].'" />
 &nbsp; &nbsp; 
<input class="dugme dugme-mavi" type="reset" value="'.$l['temizle'].'" />
	</td>
	</tr>

</table>
</form>
<br>

<script type="text/javascript"><!-- //
setTimeout("document.form1.kullanici_adi.value=\'\'",100);
setTimeout("document.form1.posta.value=\'\'",100);
setTimeout("document.form1.sifre.value=\'\'",100);
setTimeout("document.form1.sifre2.value=\'\'",100);
//  -->
</script>';



// tema dosyası yükleniyor
$sayfa_adi = $ly['yeni_uye_olusturma'];
$tema_sayfa_baslik = $ly['yeni_uye_olusturma'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>