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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');
$tema_sayfa_icerik = '';



// ANA FORUM DALI BİLGİLERİ ÇEKİLİYOR
$vtsorgu = "SELECT * FROM $tablo_dallar ORDER BY sira";
$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());



//  FORUM DALLARI SIRALANIYOR - BAŞI  //

while ($dallar_satir = $vt->fetch_assoc($vtsonuc2)):

$tema_sayfa_icerik .= '
<table cellspacing="1" width="98%" cellpadding="4" border="0" align="center" class="tablo-ana">
	<tr class="tablo-baslik">
	<td align="left" colspan="2">&nbsp;&nbsp;'.$dallar_satir['ana_forum_baslik'].'
	</td>

	<td align="center" width="80" style="font-weight:normal">
<a href="forum_duzen.php?kip=dal_duzenle&amp;dalno='.$dallar_satir['id'].'"><font style="font-size:11px">düzenle</font></a>
	</td>

	<td align="center" width="70" style="font-weight:normal">
<a href="forum_sil.php?kip=dal_sil&amp;dalno='.$dallar_satir['id'].'"><font style="font-size:11px">sil / taşı</font></a>
	</td>

	<td align="center" width="85" style="font-weight:normal">
<a href="phpkf-bilesenler/forum_duzen_yap.php?kip=dal_yukari&amp;yo='.$yo.'&amp;sira='.$dallar_satir['sira'].'"><font style="font-size:11px">yukarı al</font></a><br>
<a href="phpkf-bilesenler/forum_duzen_yap.php?kip=dal_asagi&amp;yo='.$yo.'&amp;sira='.$dallar_satir['sira'].'"><font style="font-size:11px">aşağı al</font></a>
	</td>
	</tr>';




//  FORUMLAR SIRALANIYOR - BAŞI  //


// ÜST FORUM BİLGİLERİ ÇEKİLİYOR
$vtsorgu = "SELECT * FROM $tablo_forumlar WHERE alt_forum='0' AND dal_no='$dallar_satir[id]' ORDER BY sira";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());




$ust_forumlar_formu = '';

while ($forum_satir = $vt->fetch_assoc($vtsonuc))
{
	$ust_forumlar_formu .= '<option value="'.$forum_satir['id'].'"> &nbsp; + '.$forum_satir['forum_baslik'].'</option>';

	$tema_sayfa_icerik .= '<tr class="tablo_ici">
	<td width="50" align="center" class="liste-veri" style="padding:10px">';


	if (empty($forum_satir['resim']))
	$tema_sayfa_icerik .= '<img border="0" src="../temalar/varsayilan/resimler/forum01.gif" alt="Forum Simgesi">';

	elseif ( (preg_match('/^http:\/\//i', $forum_satir['resim'])) OR (preg_match('/^https:\/\//i', $forum_satir['resim'])) OR (preg_match('/^ftp:\/\//i', $forum_satir['resim'])) OR (preg_match('/^\//i', $forum_satir['resim'])) )
	$tema_sayfa_icerik .= '<img width="30 border="0" src="'.$forum_satir['resim'].'" alt="Forum Simgesi">';

	else $tema_sayfa_icerik .= '<img width="30 border="0" src="../'.$forum_satir['resim'].'" alt="Forum Simgesi">';


	$tema_sayfa_icerik .='</td>

	<td align="left" class="liste-veri">
	<a href="../forum.php?f='.$forum_satir['id'].'">'.$forum_satir['forum_baslik'].'</a><br>'.$forum_satir['forum_bilgi'].'
	</td>

	<td align="center" width="80" class="liste-veri">
	<a href="forum_duzen.php?kip=forum_duzenle&amp;fno='.$forum_satir['id'].'">düzenle</a>
	</td>

	<td align="center" width="70" class="liste-veri">
	<a href="forum_sil.php?kip=forum_sil&amp;fno='.$forum_satir['id'].'">sil / taşı</a>
	</td>
	</td>

	<td align="center" width="85" class="liste-veri">
	<a href="phpkf-bilesenler/forum_duzen_yap.php?kip=forum_yukari&amp;dalno='.$forum_satir['dal_no'].'&amp;fno='.$forum_satir['id'].'&amp;ustforum=1&amp;yo='.$yo.'&amp;sira='.$forum_satir['sira'].'">yukarı al</a><br>
	<a href="phpkf-bilesenler/forum_duzen_yap.php?kip=forum_asagi&amp;dalno='.$forum_satir['dal_no'].'&amp;fno='.$forum_satir['id'].'&amp;ustforum=1&amp;yo='.$yo.'&amp;sira='.$forum_satir['sira'].'">aşağı al</a>
	</td>
	</tr>';



	// ALT FORUMLARINA BAKILIYOR
	$vtsorgu = "SELECT * FROM $tablo_forumlar WHERE alt_forum='$forum_satir[id]' ORDER BY sira";
	$vtsonuca = $vt->query($vtsorgu) or die ($vt->hata_ver());


	if ($vt->num_rows($vtsonuca))
	{
		$tema_sayfa_icerik .= '
		<tr>
		<td colspan="5" class="tablo_ici">

		<table cellspacing="3" width="100%" cellpadding="3" border="0" align="center" class="tablo_ici">';



		while ($alt_forum_satir = $vt->fetch_array($vtsonuca))
		{
			$tema_sayfa_icerik .= '<tr class="tablo_ici">
			<td width="75" align="right"><img border="0" src="../temalar/varsayilan/resimler/alt_forum.png" alt="Alt Forumlar">&nbsp;</td>
			<td width="50" align="center" class="liste-veri">';


			if (empty($alt_forum_satir['resim'])) $tema_sayfa_icerik .= '<img border="0" src="../temalar/varsayilan/resimler/forum01.gif" alt="Alt Forum Simgesi">';

			elseif ( (preg_match('/^http:\/\//i', $alt_forum_satir['resim'])) OR (preg_match('/^https:\/\//i', $alt_forum_satir['resim'])) OR (preg_match('/^ftp:\/\//i', $alt_forum_satir['resim'])) OR (preg_match('/^\//i', $alt_forum_satir['resim'])) )
				$tema_sayfa_icerik .= '<img width="30 border="0" src="'.$alt_forum_satir['resim'].'" alt="Forum Simgesi">';

			else $tema_sayfa_icerik .= '<img width="30 border="0" src="../'.$alt_forum_satir['resim'].'" alt="alt forum">';


			$tema_sayfa_icerik .='</td>

			<td align="left" class="liste-veri">
			<a href="../forum.php?f='.$alt_forum_satir['id'].'">'.$alt_forum_satir['forum_baslik'].'</a><br>'.$alt_forum_satir['forum_bilgi'].'
			</td>

			<td align="center" width="76" class="liste-veri">
			<a href="forum_duzen.php?kip=forum_duzenle&amp;fno='.$alt_forum_satir['id'].'">düzenle</a>
			</td>

			<td align="center" width="68" class="liste-veri">
			<a href="forum_sil.php?kip=forum_sil&amp;fno='.$alt_forum_satir['id'].'">sil / taşı</a>
			</td>

			<td align="center" width="75" class="liste-veri">
			<a href="phpkf-bilesenler/forum_duzen_yap.php?kip=forum_yukari&amp;dalno='.$alt_forum_satir['dal_no'].'&amp;fno='.$alt_forum_satir['id'].'&amp;altforum='.$forum_satir['id'].'&amp;yo='.$yo.'&amp;sira='.$alt_forum_satir['sira'].'"><i>yukarı al</i></a><br>
			<a href="phpkf-bilesenler/forum_duzen_yap.php?kip=forum_asagi&amp;dalno='.$alt_forum_satir['dal_no'].'&amp;fno='.$alt_forum_satir['id'].'&amp;altforum='.$forum_satir['id'].'&amp;yo='.$yo.'&amp;sira='.$alt_forum_satir['sira'].'"><i>aşağı al</i></a>
			</td>
			</tr>';
		}


		$tema_sayfa_icerik .= '</table>
		</td>
		</tr>';
	}
}




$tema_sayfa_icerik .= '
	<tr class="tablo_ici">
	<td width="50">&nbsp;</td>
	<td class="liste-veri" height="80" align="left" valign="middle">

<form action="phpkf-bilesenler/forum_duzen_yap.php?yo='.$yo.'" method="post" name="yeni_forum">
<input type="hidden" name="kip" value="yeni_forum" />
<input type="hidden" name="sira" value="sonsira" />
<input type="hidden" name="dalno" value="'.$dallar_satir['id'].'" />

<div style="margin-bottom:5px">
<div style="float:left; font-weight:bold; padding-top:6px; width:80px">Başlık:</div>
<input class="input-text" type="text" name="forum_baslik" size="50" value="" style="width:320px" />
</div>

<div style="margin-bottom:5px">
<div style="float:left; font-weight:bold; padding-top:6px; width:80px">Açıklama:</div>
<input class="input-text" type="text" name="forum_bilgi" size="50" value="" style="width:320px" />
</div>

<div style="margin-bottom:12px">
<div style="float:left; font-weight:bold; padding-top:6px; width:80px">Alt Forum:</div>
<select name="alt_forum" class="input-select">
<option value="ust" selected="selected">ÜST FORUM OLUŞTUR</option>
'.$ust_forumlar_formu.'
</select>
</div>

<input class="dugme dugme-mavi" type="submit" value="Yeni forum oluştur" name="yeni_forum" style="margin-left:80px" />
</form>
	</td>
	<td colspan="3">&nbsp;</td>
	</tr>
</table><br>';

endwhile;




//  TÜM FORUMLARIN SIRALANIŞI - SONU  //



$tema_sayfa_icerik .= '
<form action="phpkf-bilesenler/forum_duzen_yap.php?yo='.$yo.'" method="post" name="yeni_dal">
<input type="hidden" name="kip" value="yeni_dal" />
&nbsp; <b>Yeni Forum Dalı Adı: </b>
<br>
&nbsp; <input class="input-text" type="text" name="ana_forum_baslik" value="" size="60" />
<br>
<br>
&nbsp; <input class="dugme dugme-mavi" type="submit" value="Oluştur" name="yeni_dal" />
</form>';



$sayfa_adi = $ly['forum_yonetim'];
$tema_sayfa_baslik = $ly['forum_yonetim'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>