<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();
eval(phpkf_tema_sayfa_baslik());
include_once('menu.php');
?>
<script src="phpkf-bilesenler/js/islemler.js"></script>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $tema_sayfa_baslik; ?></div>
<div class="kutu-icerik kayit-form">



<?php if ((isset($_GET['kip'])) AND ($_GET['kip'] != '')): ?>


<table cellspacing="0" cellpadding="0" border="0" align="center" style="width:728px">
	<tr class="tablo_ici">
	<td align="left" class="liste-veri" colspan="2">


<form action="<?php echo $dosya_adi; ?>" method="post" name="duzenleyici_form" id="duzenleyici_form" onsubmit="return denetle_yazi()">
<input type="hidden" name="duyuru" value="<?php echo $kip; ?>" />
<input type="hidden" name="yo" value="<?php echo $yo; ?>">
<input type="hidden" name="dno" value="<?php echo $dno; ?>" />
<input type="hidden" name="bbcode_kullan" value="" />


<table cellspacing="0" width="100%" cellpadding="0" border="0" align="center" class="tablo_ici">
	<tr>
	<td class="liste-etiket" align="left" width="105">&nbsp; BÖLÜM: <br></td>
	<td class="liste-etiket" valign="top"><?php echo $forum_secenek; ?></td>
	</tr>

	<tr>
	<td colspan="2" height="15"></td>
	</tr>

	<tr>
	<td class="liste-etiket" align="left">&nbsp; KONU:</td>
	<td class="liste-etiket" valign="top" style="padding-right:14px">
<input class="form-buyut input-text" type="text" name="mesaj_baslik" size="25" maxlength="60" value="<?php echo $duyuru_baslik; ?>">
	</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td></td>
	</tr>


	<tr>
	<td class="liste-etiket" valign="top" rowspan="4" align="left">
&nbsp; İÇERİK:
<p>
<div style="font-weight: normal">
<font size="1">
<br><br><br>
&nbsp; HTML <b>açık</b><br>
&nbsp; BBCode <b>kapalı</b>
</font>
</div>
	</td>


	<td class="liste-etiket" valign="top" id="tablo_buyut2">
<?php
// Düzenleyici (Editör) yükleniyor
$ifade_yukle = true;
$duzenleyici_dizin = '../';
$duzenleyici_bicim = 'html';

$duzenleyici = $ayarlar['duzenleyici'];
if ($duzenleyici == '') $duzenleyici = 'varsayilan';

$duzenleyici_id = 'mesaj_icerik';

echo '<textarea cols="40" rows="15" name="mesaj_icerik" id="mesaj_icerik" class=" textarea" placeholder="'.$ly['yazi_icerigi'].'">'.$duyuru_icerik.'</textarea>';

include($duzenleyici_dizin.'phpkf-bilesenler/editor/index.php');
?>

	</td>
	</tr>

	<tr>
	<td style="height:10px">&nbsp;</td>
	</tr>

	<tr>
	<td align="center" class="liste-etiket" valign="top" colspan="2">
<input class="dugme dugme-mavi" name="mesaj_gonder" type="submit" value="<?php echo $l['gonder']; ?>" style="letter-spacing:4px" />
 &nbsp; 
<input type="button" class="dugme dugme-mavi" value="<?php echo $l['temizle']; ?>" onclick="FormTemizle()" />
	</td>
	</tr>

	<tr>
	<td style="height:30px">&nbsp;</td>
	</tr>
</table>
</form>

	</td>
	</tr>
</table>







<?php else: ?>


<div style="width: 100%; float: left; padding-bottom:25px">
<div style="width: 35%; float: left; margin-top:12px"><a href="<?php echo $dosya_adi; ?>?kip=yeni"><b>[ Yeni Duyuru Ekle ]</a></b></div>
<div style="width: 64%; float: right; text-align: right;">
<form action="<?php echo $dosya_adi; ?>" method="get" name="duyuru_sirala">
<select name="sirala" class="input-select" style="width:unset">
<?php echo $siralama_secenek; ?>
</select>
&nbsp; <input class="dugme dugme-mavi" type="submit" value="Sırala">
</form>
</div>
</div>


<?php
// DUYURU VARSA DÖNGÜYE GİRİLİYOR //
if ($vt->num_rows($duyuru_sonuc)):

while ($duyurular = $vt->fetch_assoc($duyuru_sonuc)):

if ($duyurular['fno'] == 'tum') $forum_baslik = '- TÜM SAYFALAR -';
elseif ($duyurular['fno'] == 'por') $forum_baslik = '- PORTAL ANA SAYFA -';
elseif ($duyurular['fno'] == 'ozel') $forum_baslik = '- ÖZEL İLETİ SAYFALARI -';
elseif ($duyurular['fno'] == 'mis') $forum_baslik = '- MİSAFİRLER -';
elseif ($duyurular['fno'] == 'uye') $forum_baslik = '- TÜM ÜYELER -';
elseif ($duyurular['fno'] == 'byar') $forum_baslik = '- BÖLÜM YARDIMCILARI VE ÖZEL ÜYELER -';
elseif ($duyurular['fno'] == 'fyar') $forum_baslik = '- FORUM YARDIMCILARI ';
elseif ($duyurular['fno'] == 'yon') $forum_baslik = '- YÖNETİCİLER -';
else $forum_baslik = $tumforum_satir[$duyurular['fno']].' DUYURUSU';

$dno = $duyurular['id'];

$bag_duzenle = '<a href="'.$dosya_adi.'?kip=duzenle&amp;dno='.$dno.'">'.$duzenle_simge.'</a> &nbsp; ';
$bag_sil = '<a href="'.$dosya_adi.'?kip=sil&amp;dno='.$dno.'&amp;yo='.$yo.'" onclick="return window.confirm(\''.$l['sil_uyari'].'\')">'.$sil_simge.'</a>';
?>
<table cellspacing="1" width="100%" cellpadding="10" border="0" align="left" class="tablo-ana" style="margin-bottom:40px">
	<tr class="tablo-baslik">
	<td align="left" >
<div style="float:left;text-align:left;width:33%"><?php echo $duyurular['duyuru_baslik']; ?></div>
<div style="float:left;text-align:center;width:33%"><?php echo $forum_baslik; ?></div>
<div style="float:left;text-align:right;width:33%"><?php echo $bag_duzenle.$bag_sil; ?></div>
	</td>
	</tr>

	<tr>
	<td align="left" class="tablo_ici liste-veri">
<?php echo $duyurular['duyuru_icerik']; ?>
	</td>
	</tr>
</table>

<?php endwhile; ?>





<?php else: ?>

<table cellspacing="1" width="100%" cellpadding="6" border="0" align="left" class="tablo_border4">
	<tr class="tablo_ici">
	<td align="center" class="liste-etiket" colspan="2">
<br><br>
Henüz Duyuru Yok !
<br><br><br>
	</td>
	</tr>
</table>

<?php endif; endif; ?>


</div>
</div>
</div>
