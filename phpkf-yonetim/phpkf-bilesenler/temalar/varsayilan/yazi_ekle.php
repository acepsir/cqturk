<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();
eval(phpkf_tema_sayfa_baslik());
include_once('menu.php');
?>
<script src="phpkf-bilesenler/js/islemler.js"></script>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $yeni_duzenle ;?></div>
<div class="kutu-icerik kayit-form">

<div style="position:absolute;top:40px;right:12px">
<fieldset style="margin:0;padding:12px;text-align:center">
<legend><?php echo $lymenu['icerikler']; ?></legend>
<?php echo $diger_kategoriler; ?>
</fieldset>
</div>


<form action="phpkf-bilesenler/yazi_ekle_yap.php" method="post" onsubmit="return denetle_yazi()" name="duzenleyici_form" id="duzenleyici_form">
<input type="hidden" name="dolu" value="dolu" />
<?php echo '<input type="hidden" name="yo" value="'.$yo.'" />'.$yazi_duzenle; ?>


<table cellspacing="0" cellpadding="0" border="0" align="left" class="tablo_border" width="100%">
	<tr>
	<td align="left" valign="top" width="215">



<table cellspacing="0" cellpadding="0" border="0" align="left" width="215" style="border:0px solid #ccc;margin-top:1px">
	<tr>
	<td align="left" valign="middle" width="80" height="40">
<b><?php echo $ly['alt_sayfa']; ?>:</b>
	</td>
	<td align="left" valign="middle" width="120">
<input class="input-text" type="text" name="alt_yazi" size="3" maxlength="11" value="<?php echo $alt_yazi; ?>" style="width:80px" placeholder="<?php echo $ly['alt_sayfa']; ?> ID" />
	</td>
	</tr>

	<tr>
	<td align="left" valign="middle" height="40">
<b><?php echo $ly['sayfa_no']; ?>:</b>
	</td>
	<td align="left" valign="middle">
<input class="input-text" type="text" name="sayfa_no" size="3" maxlength="5" value="<?php echo $yazi_no; ?>" style="width:80px" placeholder="<?php echo $ly['sayfa_no']; ?>" />
	</td>
	</tr>

	<tr>
	<td align="left" valign="top" colspan="2">
<div style="width:100%;margin:12px;"></div>
<b><?php echo $ly['yayin_tarihi']; ?>:</b> &nbsp;
<label style="cursor:pointer"><input type="checkbox" name="hemen" id="hemen" <?php echo $tarih_hemen; ?> onclick="EtkinYap()" /><?php echo $ly['simdi']; ?></label>
<br />
<div style="width:100%;margin:12px;"></div>
<input class="input-text" type="text" name="tarih_gun" size="3" maxlength="2" value="<?php echo $tarih_gun; ?>" style="width:33px" placeholder="<?php echo $l['gun']; ?>" />
<input class="input-text" type="text" name="tarih_ay" size="3" maxlength="2" value="<?php echo $tarih_ay; ?>" style="width:33px" placeholder="<?php echo $l['ay']; ?>" />
<input class="input-text" type="text" name="tarih_yil" size="3" maxlength="4" value="<?php echo $tarih_yil; ?>" style="width:39px" placeholder="<?php echo $l['yil']; ?>" />
<br />
<div style="width:100%;margin:10px;"></div>
<input class="input-text" type="text" name="tarih_saat" size="3" maxlength="2" value="<?php echo $tarih_saat; ?>" style="width:42px" placeholder="<?php echo $l['saat']; ?>" /> :
<input class="input-text" type="text" name="tarih_dakika" size="3" maxlength="4" value="<?php echo $tarih_dakika; ?>" style="width:42px" placeholder="<?php echo $l['dakika']; ?>" />
	</td>
	</tr>

	<tr>
	<td align="left" valign="top" colspan="2">
<div id="kategori_liste" style="border:1px solid #ccc; width:195px; height:187px; white-space:nowrap; overflow-x:auto;overflow-y:scroll;margin-top:20px">
<div style="float:left;width:100%">
<b style="float:left"><?php echo $l['kategori']; ?>:</b>
<a href="javascript:void(0)" onclick="$('#kategori_liste').cssEkle('height','')" style="float:right"><?php echo $ly['genislet']; ?> &#8645;&nbsp;</a>
</div>
<div class="clear"></div>

<div style="margin:5px;"></div>
<?php

function phpkf_yonetim_kategoriler($kategori, $ek='')
{
	global $vt, $tablo_kategoriler, $ayarlar, $site_dili, $katid, $ktip, $ilk;

	$kategoriler = '<label style="cursor:pointer"><input style="margin-top:9px" type="checkbox" name="kat['.$kategori['id'].']" value="'.$kategori['id'].'"';

	if (isset($katid)) {
		if (preg_match("/,$kategori[id],/", $katid)) $kategoriler .= ' checked="checked"';
	}
	else
	{
		if ($kategori['id'] == '1') {
			$kategoriler .= ' checked="checked"';
			$ilk=false;
		}
		else {
			if (($ilk) AND ($ktip != 0)) {
				$kategoriler .= ' checked="checked"';
				$ilk=false;
			}
		}
	}
	$kategoriler .= ' />'.$ek.$kategori['baslik'].'</label><br />';

	$vtsorgu = "SELECT * FROM $tablo_kategoriler WHERE alt_kat='$kategori[id]' ORDER BY sira,id";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	if ($vt->num_rows($vtsonuc))
	{
		while ($kategori = $vt->fetch_assoc($vtsonuc))
		{
			// Dil seçimine göre içerik alınıyor
			if ($ayarlar['dil_varsayilan'] != $site_dili)
			{
				if (isset($kategori['baslik_'.$site_dili])) $kategori['baslik'] = $kategori['baslik_'.$site_dili];
			}
			$kategoriler .= phpkf_yonetim_kategoriler($kategori, ' -');
		}
	}

	return($kategoriler);
}


// Kategoriler veritabanından çekiliyor
$vtsorgu = "SELECT * FROM $tablo_kategoriler WHERE tip='$ktip' AND alt_kat='0' ORDER BY alt_kat,sira,id";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$ilk = true;
$kategoriler = '';
while ($kategori = $vt->fetch_assoc($vtsonuc))
{
	// Dil seçimine göre içerik alınıyor
	if ($ayarlar['dil_varsayilan'] != $site_dili)
	{
		if (isset($kategori['baslik_'.$site_dili])) $kategori['baslik'] = $kategori['baslik_'.$site_dili];
	}
	$kategoriler .= phpkf_yonetim_kategoriler($kategori);
}
echo $kategoriler;
?>
<div style="margin:5px;"></div>
</div>
	</td>
	</tr>

	<tr>
	<td align="left" valign="middle" height="60">
<b><?php echo $ly['tip']; ?>:</b>
	</td>
	<td align="left" valign="middle">
<select name="tip" class="input-alani" style="width:auto">
<?php
if ($ktip == '1') echo '<option value="4" selected="selected">'.$l['galeri'].'</option>';

elseif ($ktip == '2') echo '<option value="5" selected="selected">'.$l['video'].'</option>';

else
{
	echo '<option value="2"';
	if ($tip == '2') echo ' selected="selected">'.$l['yazi'].'</option>';
	else echo '>'.$l['yazi'].'</option>';

	echo '<option value="0"';
	if ($tip == '0') echo ' selected="selected">'.$l['sayfa'].'</option>';
	else echo '>'.$l['sayfa'].'</option>';

	echo '<option value="1"';
	if ($tip == '1') echo ' selected="selected">'.$l['anasayfa'].'</option>';
	else echo '>'.$l['anasayfa'].'</option>';

	echo '<option value="3"';
	if ($tip == '3') echo ' selected="selected">'.$l['iletisim'].'</option>';
	else echo '>'.$l['iletisim'].'</option>';
}
?>
</select>
	</td>
	</tr>

	<tr>
	<td align="left" valign="middle" height="30">
<b><?php echo $l['yorum']; ?>:</b>
	</td>
	<td align="left" valign="middle">
<select name="yorum" class="input-alani" style="width:auto">
<?php

echo '<option value="1"';
if ($yorum == '1') echo ' selected="selected">'.$ly['acik'].'</option>';
else echo '>'.$ly['acik'].'</option>';

echo '<option value="0"';
if ($yorum == '0') echo ' selected="selected">'.$ly['kapali'].'</option>';
else echo '>'.$ly['kapali'].'</option>';

?>
</select>
	</td>
	</tr>
</table>

	</td>
	<td align="left" valign="top">


<table cellspacing="0" cellpadding="0" border="0" align="left" id="tablo_buyut">
	<tr>
	<td align="left" valign="middle" height="40" width="65">
<b><?php echo $ly['baslik']; ?>:&nbsp;&nbsp;&nbsp;&nbsp;</b>
	</td>
	<td align="left" valign="middle">
<input class="form-buyut input-text" type="text" name="mesaj_baslik" size="75" maxlength="99" <?php echo 'value="'.$yazi_baslik.'" '.$SefYapYazi; ?> placeholder="<?php echo $ly['yazi_baslik']; ?>" required />
	</td>
	</tr>

	<tr>
	<td align="left" valign="middle" height="40">
<b><?php echo $ly['adres']; ?>:</b>
	</td>
	<td align="left" valign="middle">
<input class="form-buyut input-text" type="text" name="adres" size="75" maxlength="99" <?php echo 'value="'.$yazi_adres.'"'.$disable; ?> placeholder="<?php echo $ly['adres_bilgi']; ?>" />
	</td>
	</tr>


	<tr>
	<td align="left" valign="middle" height="45">
<b><?php echo $l['etiket']; ?>:</b>
<div style="margin-bottom:5px"></div>
	</td>
	<td align="left" valign="middle">
<input class="form-buyut input-text" type="text" name="etiket" size="75" <?php echo 'value="'.$yazi_etiket.'"'; ?> placeholder="<?php echo $ly['etiket_bilgi']; ?>" />
<div style="margin-bottom:5px"></div>
	</td>
	</tr>




<?php
$ifade_yukle = true;
$duzenleyici_dizin = '../';
$duzenleyici_bicim = 'html';

// Özel alanlar alınıyor
$vtsorgu = "SELECT * FROM $tablo_ayarlar WHERE tip='icerik' AND kip='20' OR tip='$itip' AND kip='20' ORDER BY sira,etiket";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
while ($alanlar = $vt->fetch_assoc($vtsonuc)):
?>
	<tr>
	<td align="left" valign="top" height="40">
<div style="margin-bottom:5px"></div>
<b><?php echo $alanlar['baslik']; ?>:&nbsp;&nbsp;</b>
	</td>
	<td align="left" valign="top">
<?php
$ad = str_replace('ygv_', '', $alanlar['etiket']);
if ((isset($_GET['kip'])) AND ($_GET['kip'] == 'duzenle'))
{
	if (isset($yazi[$ad])) $deger = $yazi[$ad];
	else $deger = '';
}
else $deger = '';


if ($alanlar['form_tip'] == 'text')
echo '<input name="'.$ad.'" value="'.$deger.'" placeholder="'.$alanlar['bilgi'].'" type="text" class="form-buyut input-text" size="75" '.$alanlar['diger'].' />';

elseif ($alanlar['form_tip'] == 'textarea')
{
	if ($alanlar['aciklama'] == 'duzenleyici') $duzenleyici = $ayarlar['duzenleyici'];
	elseif ($alanlar['aciklama'] == 'gduzenleyici') $duzenleyici = $ayarlar['gduzenleyici'];
	elseif ($alanlar['aciklama'] == 'vduzenleyici') $duzenleyici = $ayarlar['vduzenleyici'];
	elseif ($alanlar['aciklama'] == 'yduzenleyici') $duzenleyici = $ayarlar['yduzenleyici'];
	else $duzenleyici = 'duz';

	if ($duzenleyici != 'duz'){
		echo '</td></tr><tr><td colspan="2">';
		$style_ekle = '';
	}
	else $style_ekle = 'mceNoEditor';

	$duzenleyici_id = $ad;
	echo '<textarea name="'.$ad.'" id="'.$ad.'" placeholder="'.$alanlar['bilgi'].'" class="form-buyut textarea '.$style_ekle.'" '.$alanlar['diger'].'>'.$deger.'</textarea>';
	include($duzenleyici_dizin.'phpkf-bilesenler/editor/index.php');
}

elseif ($alanlar['form_tip'] == 'select')
{
	if (!preg_match('/style=/i', $alanlar['diger'])) $style_ekle = 'style="width:auto" ';
	else $style_ekle = '';

	$select = '';
	$secenek_dizi = explode('|', $alanlar['secenek']);
	foreach ($secenek_dizi as $secenek_tek)
	{
		$secenek = explode(':', $secenek_tek);
		if ($secenek[0] == '') continue;
		if ($secenek[0] == $deger) $secili = 'selected="selected"';
		else $secili = '';
		$select .= "\r\n<option value=\"$secenek[0]\" $secili>$secenek[1]</option>";
	}
	echo '<select name="'.$ad.'" class="input-alani" '.$style_ekle.$alanlar['diger'].'>'.$select.'</select>';
}
?>
	</td>
	</tr>
<?php endwhile; ?>





	<tr>
	<td align="left" valign="top" colspan="2" id="tablo_buyut2" style="padding-top:10px">

<!--   TEXTAREA - BAŞI   -->
<?php
if ($ktip == 1) $duzenleyici = $ayarlar['gduzenleyici'];
elseif ($ktip == 2) $duzenleyici = $ayarlar['vduzenleyici'];
else $duzenleyici = $ayarlar['duzenleyici'];
if ($duzenleyici == '') $duzenleyici = 'varsayilan';

$duzenleyici_id = 'mesaj_icerik';
echo '<textarea cols="40" rows="15" name="mesaj_icerik" id="mesaj_icerik" class="form-buyut textarea" placeholder="'.$ly['yazi_icerigi'].'">'.$yazi_icerik.'</textarea>';
include($duzenleyici_dizin.'phpkf-bilesenler/editor/index.php');
?>
<!--   TEXTAREA - SONU   -->

<script type="text/javascript"><!-- //
EtkinYap();
//  -->
</script>
	</td>
	</tr>

	<tr>
	<td align="center" colspan="2" style="padding-top:15px; padding-bottom:5px">
<input class="dugme dugme-mavi" name="mesaj_gonder" type="submit" value="<?php echo $l['gonder']; ?>" style="letter-spacing:4px" />
 &nbsp; 
<input type="button" class="dugme dugme-mavi" value="<?php echo $l['temizle']; ?>" onclick="FormTemizle()" />
	</td>
	</tr>
</table>
</td></tr></table>
</form>

<div style="clear:both;"></div>
</div>
</div>
</div>