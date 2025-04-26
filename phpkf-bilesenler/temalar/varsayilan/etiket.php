<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

$yazilar = phpkf_tema_yazilar($etiket_kosul); // yazılar alınıyor

eval(phpkf_tema_sayfa_baslik()); // sayfa başlık göster

phpkf_tema_blok_goster(1); // sol blokları göster

phpkf_tema_blok_goster(2); // sağ blokları göster

if ($yazilar): // yazı varsa
?>
<div class="orta-blok">

<?php foreach ($yazilar as $yazi): // yazılar döngü - başı ?>

<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">
<a href="<?php echo $yazi['link']; ?>"><?php echo $yazi['baslik']; ?></a>
</div>

<div class="kutu-icerik">
<div class="yazi-icerik">
<?php
$yazi['icerik'] = stripslashes(strip_tags($yazi['icerik']));
if ($yazi['devami']!='') echo $yazi['icerik'].'<br /><br />'.$yazi['devami'];
elseif (mb_strlen($yazi['icerik']) > 1000) echo mb_substr($yazi['icerik'],0,1000, 'utf-8').'.....<br /><br /><a href="'.$yazi['link'].'">'.$l['devami_icin_tiklayin'].'</a>';
else echo $yazi['icerik'];
?>
</div>
<div class="clear"></div>
<?php
if ($etiketler = phpkf_tema_etiket($yazi['etiket']))
echo '<div class="yazi-etiket">'.$l['etiketler'].': '.$etiketler.'</div>';
?>
</div>

<div class="kutu-footer">
<span class="kutu-tarih" title="Tarih"><i><?php echo $yazi['yayin_tarihi']; ?></i></span>
<span class="kutu-yazar" title="Yazan"><a href="<?php echo $yazi['profil']; ?>"><?php echo $yazi['yazan']; ?></a></span>
<span class="kutu-okunma" title="Gösterim"><i><?php echo $yazi['goruntuleme'].' '.$l['kez_okundu']; ?></i></span>
<span class="kutu-yorum" title="Yorum"><a href="<?php echo $yazi['link']; ?>#yorumlar"><?php echo $yazi['yorum_sayi'].' '.$l['yorum']; ?></a></span>
</div>

</div>

<?php
// yazılar döngü - sonu
endforeach;

// Sayfalama bağlantıları
echo $TEMA_SAYFALAMA.'</div>';

// hiçbir yazı yoksa
else:
?>
<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $TEMA_SAYFA_BASLIK; ?></div>
<div class="kutu-icerik">

<center>
<br />
<form name="etiket_sayfasi" action="<?php echo $etiket_adres; ?>" method="get" onsubmit="return aramaYap(this, 'etiket', <?php echo $arama_seo; ?>)">
<input class="input-text" name="etiket" maxlength="100" placeholder="<?php echo $l['etiket_girin']; ?>" type="text" />
<button class="dugme dugme-mavi" type="submit"><?php echo $l['goster']; ?></button>
</form>
<?php
if ($etiket_sonuc_yok) // Arama sonuç vermezse
echo '<br /><br />'.$l['etiket_sonuc_yok'].'<br />';
?>
<br />
</center>

</div>
</div>
</div>

<?php endif; // koşul sonu ?>
