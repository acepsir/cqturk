<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();
eval(phpkf_tema_sayfa_baslik());
include_once('menu.php');
?>

<form name="yasak" action="yasaklamalar.php" method="post">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $ly['kullanici_adi_yasaklama']; ?></div>
<div class="kutu-icerik">



<table border="0" align="center" cellspacing="0" cellpadding="0" width="490">
	<tr>
	<td class="liste-veri" align="left" valign="top" colspan="2">
<br>
<?php echo $ly['kullanici_adi_yasaklama_bilgi']; ?>
<br><br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="left" valign="top">
<br>
<b><?php echo $ly['ornek']; ?> :</b>
<br>
<br>Ahmet
<br>Mehmet
<br>*Veli
<br>Veli*
<br>*Veli*
	</td>
	<td align="right" valign="middle">
<textarea name="kulad" class="textarea" cols="35" rows="8" style="width:290px">
<?php echo $yasak_kulad[0]; ?>
</textarea>
	</td>
	</tr>
</table>
<br>


		<!--		YASAK E-POSTA ADRESLERİ			-->

</div>
<div class="kutu-baslik ara-baslik"><?php echo $ly['eposta_yasaklama']; ?></div>
<div class="kutu-icerik">


<table border="0" align="center" cellspacing="0" cellpadding="0" width="490">
	<tr>
	<td class="liste-veri" align="left" valign="top" colspan="2">
<br>
<?php echo $ly['eposta_yasaklama_bilgi']; ?>
<br><br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="left" valign="top">
<br>
<b><?php echo $ly['ornek']; ?>:</b>
<br>
<br>ahmet@yahoo.com
<br>mehmet@hotmail.com
<br>*@spam.com
	</td>
	<td align="right" valign="middle">
<textarea name="posta" class="textarea" cols="35" rows="8" style="width:290px">
<?php echo $yasak_posta[0]; ?>
</textarea>
	</td>
	</tr>
</table>
<br>





		<!--		YASAK AD SOYADLAR       -->

</div>
<div class="kutu-baslik ara-baslik"><?php echo $ly['adsoyad_yasaklama']; ?></div>
<div class="kutu-icerik">


<table border="0" align="center" cellspacing="0" cellpadding="0" width="490">
	<tr>
	<td class="liste-veri" align="left" valign="top" colspan="2">
<br>
<?php echo $ly['adsoyad_yasaklama_bilgi']; ?>
<br><br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="left" valign="top">
<br>
<b><?php echo $ly['ornek']; ?>:</b>
<br>
<br>Ahmet
<br>Mehmet
<br>Veli
	</td>
	<td class="liste-veri" align="right" valign="middle">
<textarea name="adsoyad" class="textarea" cols="35" rows="8" style="width:290px">
<?php echo $yasak_adsoyad[0]; ?>
</textarea>
	</td>
	</tr>
</table>
<br>



		<!--		SANSÜRLENECEK SÖZCÜKLER			-->

</div>
<div class="kutu-baslik ara-baslik"><?php echo $ly['sozcuk_yasaklama']; ?></div>
<div class="kutu-icerik">


<table border="0" align="center" cellspacing="0" cellpadding="0" width="490">
	<tr>
	<td class="liste-veri" align="left" valign="top" colspan="2">
<br>
<?php echo $ly['sozcuk_yasaklama_bilgi'][0]; ?>
<br><br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="center" valign="top">
<br>
<b><?php echo $ly['ornek']; ?>:</b>
<br>
<br>küfür
<br>hack
<br>crack
	</td>
	<td class="liste-veri" align="right" valign="middle">
<textarea name="sozcukler" class="textarea" cols="35" rows="8" style="width:230px">
<?php echo $yasak_sozcukler[0]; ?>
</textarea>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="left" valign="top">
<br><br>
<?php echo $ly['sozcuk_yasaklama_bilgi'][1]; ?>
	</td>
	<td class="liste-veri" align="right" valign="middle">
<br><br>
<input name="cumle" class="input-alani" value="<?php echo $yasak_cumle[0]; ?>" size="33" style="width:230px">
	</td>
	</tr>

</table>
<br>



		<!--		YASAKLI IPLER			-->

</div>
<div class="kutu-baslik ara-baslik"><?php echo $ly['ip_yasaklama']; ?></div>
<div class="kutu-icerik">


<table border="0" align="center" cellspacing="0" cellpadding="0" width="490">
	<tr>
	<td class="liste-veri" align="left" valign="top" colspan="2">
<br>
<?php echo $ly['ip_yasaklama_bilgi']; ?>
<br><br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="center" valign="top">
<br>
<b><?php echo $ly['ornek']; ?>:</b>
<br>
<br>192.168.1.1
<br>127.0.0.1
	</td>
	<td class="liste-veri" align="right" valign="middle">
<textarea name="yasak_ip" class="textarea" cols="35" rows="8" style="width:290px">
<?php echo $yasak_ip[0]; ?>
</textarea>
	</td>
	</tr>

</table>


<div style="text-align:center; margin-top:25px; margin-bottom:15px">
<input class="dugme dugme-mavi" type="submit" value="<?php echo $l['gonder']; ?>">
&nbsp; &nbsp;
<input class="dugme dugme-mavi" type="reset" value="<?php echo $l['temizle']; ?>">
</div>



</div>
</div>
</div>

</form>