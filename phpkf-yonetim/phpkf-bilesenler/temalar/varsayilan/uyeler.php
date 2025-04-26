<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

eval(phpkf_tema_sayfa_baslik());
include_once('menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">

<div class="kutu-baslik"><?php echo $tema_sayfa_baslik; ?></div>
<div class="kutu-icerik">

<?php echo $form_bilgisi; ?>

<table cellspacing="0" cellpadding="0" border="0" align="center">
	<tr>
	<td align="center" height="25">
<a href="uyeler.php"><?php echo $ly['etkin_uyeler']; ?></a> &nbsp; | &nbsp;
<a href="uyeler.php?kip=etkisiz"><?php echo $ly['etkin_olmayan_uyeler']; ?></a> &nbsp; | &nbsp;
<a href="uyeler.php?kip=engelli"><?php echo $ly['engellenmis_uyeler']; ?></a> &nbsp; | &nbsp;
<a href="yeni_uye.php"><?php echo $ly['yeni_uye_ekle']; ?></a>
	</td>
	</tr>
</table>


<table cellspacing="10" width="95%" cellpadding="0" border="0" align="center" style="margin-top:20px">
	<tr>
	<td valign="bottom" height="35" align="left">
<input class="input-text" type="text" name="kul_ara" size="20" maxlength="20" value="<?php echo $uye_ara; ?>">
&nbsp;<input type="submit" value="<?php echo $l['ara']; ?>" class="dugme dugme-mavi">
	</td>

	<td valign="bottom" align="right">
<select name="sirala" class="input-text">
<?php echo $siralama_secenek; ?>
</select>
&nbsp;<input type="submit" value="<?php echo $l['uye_sirala']; ?>" class="dugme dugme-mavi">
	</td>
	</tr>

	<tr>
	<td valign="top" align="center" colspan="2">

<table cellspacing="1" width="100%" cellpadding="6" border="0" align="center" class="tablo-ana" style="margin-top:10px">
	<tr class="tablo-baslik">
	<td style="min-width:100px"><?php echo $l['uye_adi']; ?></td>
	<td width="120"><?php echo $l['yetki']; ?></td>
	<td width="60"><?php echo $ly['ileti']; ?></td>
	<td width="135"><?php echo $ly['katilim']; ?></td>
	<td width="135"><?php echo $l['son_giris']; ?></td>
	<td width="110"><?php echo $ly['ipadresi']; ?></td>
	<td width="150" style="min-width:80px; max-width:150px"><?php echo $ly['islemler']; ?></td>
	</tr>
	<?php echo $uyeler_dongu; ?>
</table>
	</td>
	</tr>

	<tr>
	<td valign="top" align="center" colspan="2" style="padding-top:25px">
<?php echo $sayfalama; ?>

<p align="left">
<font face="verdana" size="1">
<?php echo $ly['uye_arama_sonuc'].' <b>'.$uye_sayisi; ?></b>
</font>


</td></tr></table>
</form>

</div>

</div>
</div>