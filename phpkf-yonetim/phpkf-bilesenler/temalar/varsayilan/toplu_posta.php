<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();
eval(phpkf_tema_sayfa_baslik());
include_once('menu.php');
?>

<script type="text/javascript"><!-- //
function denetle()
{
	var dogruMu = true;
	if(document.eposta_form.adim.value.length < 1){
		dogruMu = false;
		alert("GÖNDERİM ADIMI KISMI BOŞ BIRAKILAMAZ !");}

	else if(document.eposta_form.eposta_baslik.value.length < 3){
		dogruMu = false;
		alert("YAZDIĞINIZ BAŞLIK 3 KARAKTERDEN UZUN OLMALIDIR !");}

	else if(document.eposta_form.eposta_icerik.value.length < 3){
		dogruMu = false;
		alert("YAZDIĞINIZ İLETİ 3 KARAKTERDEN UZUN OLMALIDIR !");}
	else;
	return dogruMu;
}
//  -->
</script>


<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $sayfa_adi; ?></div>
<div class="kutu-icerik">

<?php
// E-Posta gönderim ekranı
if (isset($tema_sayfa_icerik)):
echo $tema_sayfa_icerik;

// Sayfa girişi
else:
?>

<span class="liste-veri">
<?php echo $ly['toplu_eposta_bilgi']; ?>
<br><br>
</span>


<form action="toplu_posta.php" method="post" onsubmit="return denetle()" name="eposta_form">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">


<table cellspacing="1" width="100%" cellpadding="6" border="0" align="center" class="tablo-ana">
	<tr class="tablo_ici">
	<td align="left" class="liste-etiket" valign="middle" height="40" width="180">
<?php echo $ly['gonderilecek_uyeler']; ?> :
	</td>

	<td align="left" class="liste-veri">
<select name="kimlere" class="input-alani" style="width:auto">
<option value="tum"><?php echo $ly['tüm_uyeler']; ?></option>
<option value="e_haric"><?php echo $ly['engelli_haric_tum_uyeler']; ?></option>
<option value="ee_haric"><?php echo $ly['engelli_ve_etkisiz_haric_tum_uyeler']; ?></option>
<option value="yonetici"><?php echo $ly['sadece_yoneticiler']; ?></option>
<option value="yardimci"><?php echo $ly['sadece_yardimcilar']; ?></option>
<option value="engellenmis"><?php echo $ly['sadece_engellenmis_uyeler']; ?></option>
<option value="etkisiz"><?php echo $ly['sadece_etkisiz_uyeler']; ?></option>
</select>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" class="liste-etiket" valign="middle" height="40">
<?php echo $ly['gonderim_adimi']; ?> :
	</td>

	<td align="left" class="liste-veri">
<input class="input-alani" type="text" name="adim" size="4" maxlength="3" value="50" style="width:50px">
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" class="liste-etiket" valign="middle" height="40">
<?php echo $ly['eposta_baslik']; ?> :
	</td>

	<td align="left" class="liste-veri">
<input class="input-alani" type="text" name="eposta_baslik" size="53" maxlength="60" value="" style="width:96%">
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" class="liste-etiket" valign="top" rowspan="2">
<br>
<?php echo $ly['eposta_icerik']; ?> :
<br><br>
<div style="font-weight: normal">
<font size="1">
HTML <b><?php echo $ly['kapali']; ?></b><br>
BBCode <b><?php echo $ly['kapali']; ?></b><br>
(<?php echo $ly['sadece_duz_metin']; ?>)
<br><br><br>
<?php echo $l['uye_adi']; ?>: {uye_adi}<br>
<?php echo $ly['uye_eposta']; ?>: {uye_posta}
</font>
</div>
	</td>

	<td align="left" class="liste-veri">
<br>
<textarea class="textarea" cols="50" rows="12" name="eposta_icerik" style="width:96%">
</textarea>
<br><br>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="center" class="liste-veri" height="40" valign="middle">
<input class="dugme dugme-mavi" name="mesaj_gonder" type="submit" value="<?php echo $ly['epostalari_gonder']; ?>">
 &nbsp; 
<input class="dugme dugme-mavi" type="reset" value="<?php echo $l['temizle']; ?>">
	</td>
	</tr>
</table>

</form>


<?php endif; // e-posta gönder tıklanmış - tıklanmamış ?>


</div>
</div>
</div>