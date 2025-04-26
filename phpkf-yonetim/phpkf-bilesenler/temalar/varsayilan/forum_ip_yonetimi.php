<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();
eval(phpkf_tema_sayfa_baslik());
include_once('menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $tema_sayfa_baslik; ?></div>
<div class="kutu-icerik">


<?php if ( (isset($_GET['kip'])) AND (($_GET['kip'] == '1') OR ($_GET['kip'] == '2') ) ): ?>

<?php echo $sayfa_aciklama; ?>
<table cellspacing="1" width="100%" cellpadding="8" border="0" align="center" class="tablo-ana" style="margin-bottom:20px">
	<tr>
	<td colspan="6" class="tablo-baslik tablo-ici" align="center" valign="middle"><?php echo $uye_misafir; ?></td>
	</tr>

	<tr class="tablo-baslik">
	<td align="center" width="25">Sıra</td>
	<td align="center" width="100">Üye Adı</td>
	<td align="center">Son Bulunduğu Sayfa</td>
	<td align="center" width="120"><?php echo $kayit_ip; ?></td>
	<td align="center" width="120">Son Giriş Tarihi</td>
	</tr>

<?php
if (isset($tekli2)):
foreach($tekli2 as $ip_bilgi):
?>

	<tr class="tablo-satir">
	<td align="center"><?php echo $ip_bilgi['sira']; ?></td>
	<td align="left">&nbsp;<?php echo $ip_bilgi['uye_adi']; ?></td>
	<td align="left">&nbsp;<?php echo $ip_bilgi['hangi_sayfada']; ?></td>
	<td align="center"><?php echo $ip_bilgi['kayit']; ?></td>
	<td align="center"><?php echo $ip_bilgi['son_giris']; ?></td>
	</tr>

<?php endforeach; else: ?>
	<tr>
	<td align="center" height="50" colspan="5" class="tablo-ici">
Bu ip adresini kullanan üye veya misafir yok.
	</td>
	</tr>
<?php endif; ?>

</table>
<br><br>






<?php echo $sayfa_aciklama3; ?>
<table cellspacing="1" width="100%" cellpadding="8" border="0" align="center" class="tablo-ana">
	<tr>
	<td colspan="6" class="tablo-baslik" align="center" valign="middle"><?php echo $konular_cevaplar; ?></td>
	</tr>

	<tr class="tablo-baslik">
	<td align="center" width="25">Sıra</td>
	<td align="center">Başlık</td>
	<td align="center" width="110">Yazan</td>
	<td align="center" width="110"><?php echo $ip_degistiren; ?></td>
	<td align="center" width="104">İşlem</td>
	<td align="center" width="114">Tarih</td>
	</tr>

<?php
if (isset($tekli1)):
foreach($tekli1 as $ip_bilgi):
?>

	<tr class="tablo-satir">
	<td align="center"><?php echo $ip_bilgi['sira']; ?></td>
	<td align="left">&nbsp;<?php echo $ip_bilgi['baslik']; ?></td>
	<td align="center"><?php echo $ip_bilgi['yazan']; ?></td>
	<td align="center"><?php echo $ip_bilgi['ip_adresi']; ?></td>
	<td align="center"><?php echo $ip_bilgi['islem']; ?></td>
	<td align="center"><?php echo $ip_bilgi['tarih']; ?></td>
	</tr>

<?php endforeach; else: ?>
	<tr>
	<td align="center" height="50" colspan="6" class="tablo-ici">
Yazılan veya değiştirilen konu veya cevap yok.
	</td>
	</tr>
<?php endif; ?>



</table>
<?php echo $sayfalama; ?>







<?php else: ?>

<table cellspacing="0" cellpadding="7" width="650" border="0" align="left" class="tablo-ana">
	<tr>
	<td class="tablo-ici" colspan="2" align="left">
<?php echo $sayfa_aciklama2; ?>
	</td>
	</tr>

	<tr>
	<td class="tablo-ici" width="40%" height="60" align="right" valign="middle">
<b>IP Sorgulama:</b>
	</td>

	<td class="tablo-ici" align="left" valign="middle">
<form action="<?php echo $dosya_adi; ?>" method="get" name="form_ip">
<input type="hidden" name="kip" value="1" />
 &nbsp; <input class="input-text" name="ip" type="text" value="<?php echo $ip_adresi; ?>" maxlength="15" /> &nbsp; 
<input class="dugme dugme-mavi" type="submit" value="Bul" />
</form>
	</td>
	</tr>

	<tr>
	<td class="tablo-ici" height="60" align="right" valign="middle">
<b>Üye Sorgulama:</b>
	</td>

	<td class="tablo-ici" align="left" valign="middle">
<form action="<?php echo $dosya_adi; ?>" method="get" name="form_ip">
<input type="hidden" name="kip" value="2" />
 &nbsp; <input class="input-text" name="kim" type="text" value="<?php echo $uye_adi; ?>" maxlength="20" /> &nbsp; 
<input class="dugme dugme-mavi" type="submit" value="Bul" />
</form>
	</td>
	</tr>
</table>

<?php endif; ?>

<br>
</div>
</div>
</div>
