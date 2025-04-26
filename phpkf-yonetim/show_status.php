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



$tema_sayfa_icerik = '
<table cellspacing="1" width="550" cellpadding="4" border="0" class="tablo-ana">';



//  MYSQL SUNUCUNUN ÇALIŞMA SÜRESİ ALINIYOR //

$vtsorgu = "SHOW STATUS LIKE 'Uptime'";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
$mysql_calisma = $vt->fetch_assoc($vtsonuc);


$acilis = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, (time()-$mysql_calisma['Value']));

$gun = ($mysql_calisma['Value'] / 60 / 60 / 24);
settype($gun,'integer');
$saat = (($mysql_calisma['Value'] / 60 / 60 ) % 24);
$dakika = (($mysql_calisma['Value'] / 60 ) % 60);
$saniye = ($mysql_calisma['Value'] % 60);


$tema_sayfa_icerik .= '
<tr class="tablo_ici">
<td align="left" class="liste-veri" colspan="2">
<b> &nbsp; '.$ly['mysql_calisma_suresi'].': &nbsp; </b>'.$gun.' '.$l['gun'].', '.$saat.' '.$l['saat'].', '.$dakika.' '.$l['dakika'].' '.$l['ve'].' '.$saniye.' '.$l['saniye'].'

<p><b> &nbsp; '.$ly['mysql_baslama_zamani'].': &nbsp; </b>'.$acilis.'
<br><br><br>
</td>
</tr>
';




//	MySQL BİLGİLERİ ÇEKİLİYOR	//

$vtsorgu = "SHOW STATUS";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

while ($show_status = $vt->fetch_array($vtsonuc))
{
	$tema_sayfa_icerik .= '
	<tr class="tablo-satir">
	<td align="left">'.$show_status[0].'</td>
	<td align="left" width="40%">'.$show_status[1].'</td>
	</tr>';
}


$tema_sayfa_icerik .= '</table>';



// tema dosyası yükleniyor
$sayfa_adi = $ly['mysql_bilgileri'];
$tema_sayfa_baslik = $ly['mysql_bilgileri'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>