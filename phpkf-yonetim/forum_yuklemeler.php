<?php
/*
 +-=========================================================================-+
 |                              phpKF Forum v3.00                            |
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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5' OR kip='6'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');



// yukleme dizini
$dosya_yolu = '../'.$ayarlar['yukleme_dizin'].'/';

// bu dosyanın adı
$dosya_adi = 'forum_yuklemeler.php';



// Simgeler
$sil_simge = '<img src="phpkf-bilesenler/temalar/varsayilan/resimler/sil.png" width="15" height="15" alt="s" style="position:relative;top:3px" title="'.$ly['dosya_sil'].'" />';

$ara_simge = '<img src="phpkf-bilesenler/temalar/varsayilan/resimler/arama.png" width="17" height="17" alt="a" style="position:relative;top:3px" title="'.$ly['dosya_ara'].'" />';

$oara_simge = '<img src="phpkf-bilesenler/temalar/varsayilan/resimler/arama.png" width="17" height="17" alt="a" style="position:relative;top:3px" title="'.$ly['oi_ara'].'" />';

$ac_simge = '<img src="phpkf-bilesenler/temalar/varsayilan/resimler/alt-sayfa.png" width="25" height="24" alt="d" style="position:relative;top:3px" title="'.$ly['dosya_indir'].'" />';


// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';



if ((isset($_GET['ara'])) AND ($_GET['ara'] != ''))
{
	$_GET['ara'] = @zkTemizle($_GET['ara']);

	// özel iletilerde aranıyor
	$vtsorgu = "SELECT id FROM $tablo_ozel_ileti WHERE ozel_icerik LIKE '%$_GET[ara]%' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$ozel = $vt->fetch_array($vtsonuc);

	if (isset($ozel['id'])) echo '<b>'.$l['var'].'</b>';
	else echo ''.$l['yok'].'';
	exit();
}



//	DOSYA SİLME İŞLEMLERİ - BAŞI	//

elseif ((isset($_GET['sil'])) AND ($_GET['sil'] != ''))
{
	// yönetim oturum kodu kontrol ediliyor
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}

	// Veri rakam değilse hata ver
	if (!is_numeric($_GET['sil']))
	{
		header('Location: hata.php?hata=45');
		exit();
	}

	// site kurucusu değilse hata ver
	if ($kullanici_kim['id'] != 1)
	{
		header('Location: hata.php?hata=151');
		exit();
	}

	// dosyanın bilgileri çekiliyor
	$vtsorgu = "SELECT id,dosya FROM $tablo_yuklemeler WHERE id='$_GET[sil]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$dosya = $vt->fetch_array($vtsonuc);

	// dosya yoksa hata ver
	if (!isset($dosya['id']))
	{
		header('Location: hata.php?hata=206');
		exit();
	}

	// dosya sunucudan siliniyor
	@unlink($dosya_yolu.$dosya['dosya']);

	// dosya girdisi veritabanından siliniyor
	$vtsorgu = "DELETE FROM $tablo_yuklemeler WHERE id='$_GET[sil]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	header('Location: hata.php?bilgi=49');
	exit();
}

//	DOSYA SİLME İŞLEMLERİ - SONU	//







$tema_sayfa_icerik = '
<script type="text/javascript"><!-- //
function GonderAl(adres,katman){
var katman1 = document.getElementById(katman);
var veri_yolla = "name=value";
if (document.all) var istek = new ActiveXObject("Microsoft.XMLHTTP");
else var istek = new XMLHttpRequest();
istek.open("GET", adres, true);

istek.onreadystatechange = function(){
if (istek.readyState == 4){
	if (istek.status == 200) katman1.innerHTML = istek.responseText;
	else katman1.innerHTML = \'<font color="#ff0000"><b>Bağlantı Kurulamadı !</b></font>\';}};
istek.send(veri_yolla);}

function ara(katman,veri){
adres = "'.$dosya_adi.'?ara="+veri;
var katman1 = document.getElementById(katman);
katman1.innerHTML = \'<img src="../phpkf-dosyalar/yukleniyor.gif" width="15" alt="Yü." title="Yükleniyor...">\';
setTimeout("GonderAl(\'"+adres+"\',\'"+katman+"\')",1000);}
//  -->
</script>



<table cellspacing="1" width="100%" cellpadding="5" border="0" align="center" class="tablo-ana">
	<tr class="tablo-baslik">
	<td align="center" valign="top" colspan="2" class="liste-veri">';

if ((isset($_GET['uye']) AND ($_GET['uye'] == '1')))
	$tema_sayfa_icerik .= '<a href="'.$dosya_adi.'?uye=0">Üye Adı &#9650;</a>';

elseif ((isset($_GET['uye'])) AND ($_GET['uye'] == '0'))
	$tema_sayfa_icerik .= '<a href="'.$dosya_adi.'?uye=1">Üye Adı &#9660;</a>';

else $tema_sayfa_icerik .= '<a href="'.$dosya_adi.'?uye=1">Üye Adı</a>';


$tema_sayfa_icerik .= '</td><td align="center" width="150" class="liste-veri">';


if ((!isset($_GET['uye'])) AND (!isset($_GET['tarih'])) AND (!isset($_GET['ip'])) AND (!isset($_GET['boyut'])))
	$tema_sayfa_icerik .= '<a href="'.$dosya_adi.'?tarih=1">Tarih &#9650;</a>';

elseif ((isset($_GET['tarih'])) AND ($_GET['tarih'] == '1'))
	$tema_sayfa_icerik .= '<a href="'.$dosya_adi.'?tarih=0">Tarih &#9660;</a>';

elseif ((isset($_GET['tarih']) AND ($_GET['tarih'] == '0')))
	$tema_sayfa_icerik .= '<a href="'.$dosya_adi.'?tarih=1">Tarih &#9650;</a>';

else $tema_sayfa_icerik .= '<a href="'.$dosya_adi.'?tarih=0">Tarih</a>';


$tema_sayfa_icerik .= '</td><td align="center" width="120" class="liste-veri">';


if ((isset($_GET['ip']) AND ($_GET['ip'] == '1')))
	$tema_sayfa_icerik .= '<a href="'.$dosya_adi.'?ip=0">IP Adresi &#9650;</a>';

elseif ((isset($_GET['ip'])) AND ($_GET['ip'] == '0'))
	$tema_sayfa_icerik .= '<a href="'.$dosya_adi.'?ip=1">IP Adresi &#9660;</a>';

else $tema_sayfa_icerik .= '<a href="'.$dosya_adi.'?ip=1">IP Adresi</a>';


$tema_sayfa_icerik .= '</td><td align="center" width="80" class="liste-veri">';


if ((isset($_GET['boyut']) AND ($_GET['boyut'] == '1')))
	$tema_sayfa_icerik .= '<a href="'.$dosya_adi.'?boyut=0">Boyut &#9650;</a>';

elseif ((isset($_GET['boyut'])) AND ($_GET['boyut'] == '0'))
	$tema_sayfa_icerik .= '<a href="'.$dosya_adi.'?boyut=1">Boyut &#9660;</a>';

else $tema_sayfa_icerik .= '<a href="'.$dosya_adi.'?boyut=1">Boyut</a>';


$tema_sayfa_icerik .= '</td>
	<td align="center" width="40" class="liste-veri">Sil</td>
	<td align="center" width="40" class="liste-veri">Ara</td>
	<td align="center" width="40" class="liste-veri">Ö.Ara</td>
	<td align="center" width="40" class="liste-veri">Aç</td>
	</tr>';





if ((isset($_GET['uye'])) AND ($_GET['uye'] == '1')) $eksorgu = "uye_adi ASC";
elseif ((isset($_GET['uye'])) AND ($_GET['uye'] == '0')) $eksorgu = "uye_adi DESC";
elseif ((isset($_GET['tarih'])) AND ($_GET['tarih'] == '1')) $eksorgu = "tarih DESC";
elseif ((isset($_GET['tarih'])) AND ($_GET['tarih'] == '0')) $eksorgu = "tarih ASC";
elseif ((isset($_GET['ip'])) AND ($_GET['ip'] == '1')) $eksorgu = "ip ASC";
elseif ((isset($_GET['ip'])) AND ($_GET['ip'] == '0')) $eksorgu = "ip DESC";
elseif ((isset($_GET['boyut'])) AND ($_GET['boyut'] == '1')) $eksorgu = "boyut ASC";
elseif ((isset($_GET['boyut'])) AND ($_GET['boyut'] == '0')) $eksorgu = "boyut DESC";
else $eksorgu = "id ASC";


$sira = 1;
$tboyut = 0;


$vtsorgu = "SELECT * FROM $tablo_yuklemeler ORDER BY $eksorgu";
$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());


while ($yukleme = $vt->fetch_array($vtsonuc2))
{
	if ($yukleme['boyut'] >= 1024) $dosya_boyut = NumaraBicim(($yukleme['boyut']/1024), 2).' mb';
	else $dosya_boyut = $yukleme['boyut'].' kb';


	$tema_sayfa_icerik .= '
	<tr class="tablo-satir">
	<td width="30" align="center">'.$sira.'</td>

	<td align="left"><a href="../profil.php?u='.$yukleme['uye_id'].'">'.$yukleme['uye_adi'].'</a></td>

	<td align="center">'.zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $yukleme['tarih'], $ayarlar['tarih'], false).'</td>

	<td align="left" style="padding-left:15px"><a href="forum_ip_yonetimi.php?kip=1&amp;ip='.$yukleme['ip'].'">'.$yukleme['ip'].'</a></td>

	<td align="right">'.$dosya_boyut.'</td>

	<td align="center"><a href="'.$dosya_adi.'?sil='.$yukleme['id'].'&amp;yo='.$yo.'" onclick="return window.confirm(jsl[\'sil_uyari\'])">'.$sil_simge.'</a></td>

	<td align="center">
	<a href="../arama.php?a=1&amp;b=1&amp;forum=tum&amp;tarih=tum_zamanlar&amp;sozcuk_hepsi='.$yukleme['dosya'].'" target="_blank">'.$ara_simge.'</a>
	</td>

	<td align="center">
	<div id="oara-'.$yukleme['id'].'"><a href="javascript:void(0);" onclick="ara(\'oara-'.$yukleme['id'].'\', \''.$yukleme['dosya'].'\')">'.$oara_simge.'</a></div>
	</td>

	<td align="center">
	<a href="'.$dosya_yolu.$yukleme['dosya'].'" target="_blank">'.$ac_simge.'</a>
	</td>
	</tr>
	';

	$sira++;
	$tboyut += $yukleme['boyut'];
}


$tema_sayfa_icerik .= '
	<tr class="tablo_ici">
	<td class="liste-veri" colspan="9">&nbsp;</td>
	</tr>

	<tr class="tablo_ici">
	<td align="center" colspan="9" class="liste-veri">
	<b>Toplam:</b>&nbsp; '.NumaraBicim($tboyut/1024, 2).' mb
	</td>
	</tr>
</table>';



// tema dosyası yükleniyor
$sayfa_adi = $ly['dosya_yuklemeleri'];
$tema_sayfa_baslik = $ly['dosya_yuklemeleri'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>