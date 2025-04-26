<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();
eval(phpkf_tema_sayfa_baslik());
include_once('menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $tema_sayfa_baslik; ?></div>
<div class="kutu-icerik">


<?php if ($portal_kullan == 1): ?>
<div style="width:100%; height:30px;">
<div style="width:200px; height:17px; text-align: left; float: left"><?php echo $kip_forum; ?></div>
<div style="width:200px; height:17px; text-align: right; float: right"><?php echo $kip_portal; ?></div>
</div>
<?php endif; ?>



<?php if ( (isset($_GET['kip'])) AND (($_GET['kip'] == 'yukle') OR ($_GET['kip'] == 'pyukle')) ): ?>

<table cellspacing="1" cellpadding="8" width="100%" border="0" align="left" class="tablo-ana">
	<tr>
	<td class="tablo-ici" colspan="4" align="left">
<br>
<?php echo $sayfa_icerik; ?>
	</td>
	</tr>
	</table>


<?php else: ?>


<br>
<?php echo $sayfa_aciklama; ?>
<br><br><br>
<center>Kullanmak istediğiniz temayı alttan seçiniz.<br>
Kullanılan Tema: <?php if ($kip == 'forum') echo $secili_tema; else echo $ayarlar['temadizini_portal']; ?>
</center>
<br>


<table cellspacing="1" cellpadding="8" border="0" align="center" class="tablo-ana">
	<tr class="tablo-baslik">
	<td align="center" width="65" height="20">Kullanım</td>
	<td align="center" width="85">Ekle/Kaldır</td>
	<td align="center" width="280">Tema Görünümü</td>
	<td align="center" width="320">Tema Bilgisi</td>
	</tr>


<?php
foreach ($tekli1 as $tt_bilgi):

echo '<tr>
	<td align="center" width="68" valign="middle" class="tablo-ici">'.$tt_bilgi['kullanim'].'</td>
	<td align="center" width="85" valign="middle" class="tablo-ici">'.$tt_bilgi['ekle_kaldir'].'</td>
	<td align="center" width="280" valign="top" class="tablo-ici">'.$tt_bilgi['resim'].'</td>

	<td align="left" valign="top" width="320" class="tablo-ici" style="line-height:22px">
<a name="'.$tt_bilgi['dizin'].'"></a>
Tema adı: &nbsp;'.$tt_bilgi['ad'].'
<br>Yapımcı: &nbsp;'.$tt_bilgi['yapimci'].'
<br>Uyumlu Sürümler: &nbsp;'.$tt_bilgi['surum'].'
<br>Tarih: &nbsp;'.$tt_bilgi['tarih'].'
<br>Demo: &nbsp;'.$tt_bilgi['demo'].'
<br>Açıklama: &nbsp;'.$tt_bilgi['aciklama'].'
<br>
<br>
<center>
'.$tt_bilgi['uygulama'].'<br>
'.$tt_bilgi['kullanici'].'
</center>
	</td>
	</tr>';

endforeach;
?>

</table>

<br>
<?php echo $yanlis_kullananlar; ?>


<?php endif; ?>

</div>
</div>
</div>
