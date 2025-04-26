<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

eval(phpkf_tema_sayfa_baslik()); // sayfa başlık göster
?>
<table width="100%" cellspacing="1" cellpadding="10" border="0" align="center" class="tablo-ana">
<tr class="liste-veri tablo-ust">
<td align="center" colspan="5" height="20">
<font class="kurucu"><?php echo $l['kurucu']; ?></font> - 
<font class="yonetici"><?php echo $l['yonetici']; ?></font> -
<font class="yardimci"><?php echo $l['yardimci']; ?></font> -
<font class="blm_yrd"><?php echo $l['blm_yrd']; ?></font>
<?php echo $gizli; ?>
</td>
</tr>

<tr align="center">
<td class="tablo-baslik" width="160"><?php echo $l['uye_adi']; ?></td>
<td class="tablo-baslik mobil-gizle" align="center" width="100"><?php echo $l['son_giris']; ?></td>
<td class="tablo-baslik mobil-gizle" align="center" width="100"><?php echo $l['son_hareket']; ?></td>
<td class="tablo-baslik" align="center"><?php echo $l['bulundugu_sayfa']; ?></td>
<?php if ($gizli != ''): ?>
<td class="tablo-baslik" align="center" width="110"><?php echo $l['ipadresi']; ?></td>
<?php endif; ?>
</tr>

<tr class="liste-veri tablo-ici">
<td align="center" colspan="5" height="30">
<b><?php echo $kullanici_sayi.' '.$l['uye'].' '.$l['cevrimici'].' '.$gizli_sayi; ?></b>
</td>
</tr>

<?php foreach($uyeler as $uye): ?>
<tr class="liste-veri tablo-satir">
<td align="left"><?php echo $uye['baglanti']; ?></td>
<td class="mobil-gizle" align="center"><?php echo $uye['son_giris']; ?></td>
<td class="mobil-gizle" align="center"><?php echo $uye['son_hareket']; ?></td>
<td align="left"><?php echo $uye['sayfa']; ?></td>
<?php if ($gizli != ''): ?><td align="center"><?php echo $uye['ip']; ?></td><?php endif; ?>
</tr>
<?php endforeach; ?>


<tr class="liste-veri tablo-ici">
<td align="center" colspan="5" height="30">
<b><?php echo $misafir_sayi.' '.$l['misafir'].' '.$l['cevrimici']; ?></b>
</td>
</tr>

<?php foreach($misafirler as $misafir): ?>
<tr class="liste-veri tablo-satir">
<td align="left"><?php echo $misafir['misafir_bot']; ?></td>
<td class="mobil-gizle" align="center"><?php echo $misafir['son_giris']; ?></td>
<td class="mobil-gizle" align="center"><?php echo $misafir['son_hareket']; ?></td>
<td align="left"><?php echo $misafir['sayfa']; ?></td>
<?php if ($gizli != ''): ?><td align="center"><?php echo $misafir['ip']; ?></td><?php endif; ?>
</tr>
<?php endforeach; ?>

</table>


<div class="liste-veri" style="margin-top:7px">
<font size="1"><?php echo $cevrimici_bilgi; ?></font>
</div>


<div style="height:30px"></div>
<?php echo $TEMA_SAYFALAMA; // Sayfalama bağlantıları ?>
<div style="height:30px"></div>
