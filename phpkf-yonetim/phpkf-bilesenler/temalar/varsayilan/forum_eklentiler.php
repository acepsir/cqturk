<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();
eval(phpkf_tema_sayfa_baslik());
include_once('menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $tema_sayfa_baslik; ?></div>
<div class="kutu-icerik">

<div style="float:left;width:100%;text-align:left;padding-bottom:25px"><?php echo $sayfa_kip; ?></div>

<table cellspacing="1" cellpadding="6" width="100%" border="0" align="left" class="tablo-ana">
	<tr>
	<td class="tablo-ici" colspan="4" align="left">
<br>
<?php echo $esayfa_aciklama; ?>
<br>
<br>
	</td>
	</tr>



<?php
if (isset($tekli1)):
foreach($tekli1 as $ee_bilgi):
?>

	<tr class="tablo-ici eklenti_bilgi">
	<td align="center" valign="top" rowspan="2" width="90" style="padding-top:12px">
	<?php echo $ee_bilgi['kaldir']; ?>
	</td>
	<td align="center" valign="middle" rowspan="2">
	<?php echo $ee_bilgi['resim']; ?>
	</td>
	<td align="center" valign="middle" height="28" colspan="2">
	<b class="eklenti_adi"><?php echo $ee_bilgi['ad']; ?></b>
	</td>
	</tr>

	<tr class="tablo-ici eklenti_bilgi">
	<td align="left" valign="top" style="min-width:225px"><?php echo $ee_bilgi['aciklama1']; ?></td>

	<td align="left" valign="top" style="min-width:230px">
<div style="position: relative; float: center; overflow: auto; width: 100%; height: 140px;" onclick="this.style.height=''">
<?php echo $ee_bilgi['aciklama2']; ?>
</div>
	</td>
	</tr>

	<tr class="tablo-ici eklenti_bilgi">
	<td class="tablo-ici" align="left" valign="top" colspan="4">
<div style="position: relative; float: center; overflow: auto; width: 100%; height: 39px;" onclick="this.style.height=''">
<?php echo $ee_bilgi['aciklama3']; ?>
</div>
	</td>
	</tr>

	<tr><td class="tablo-alt" colspan="4" style="height:3px"></td></tr>


<?php
endforeach;
endif;

if (isset($eklenti_yok)): ?>

	<tr>
	<td align="center" height="50" colspan="4" class="tablo-ici">
<br>Yüklü Eklenti Yok<br><br>
<span style="font-weight:normal">Eklenti edinmek için <a href="http://www.phpkf.com/eklentiler.php" target="_blank">www.phpKF.com</a> eklentiler sayfasını ziyaret edin.</span>
<br><br>
	</td>
	</tr>

<?php endif; ?>

</table>

</div>
</div>
</div>