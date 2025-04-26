<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

eval(phpkf_tema_sayfa_baslik()); // sayfa başlık göster
?>

<div class="profil-orta-blok">

<div class="phpkf-blok-kutusu profil-goruntule-blok">
<div class="kutu-baslik profil-baslik"><?php echo $TEMA_SAYFA_BASLIK; ?></div>
<div class="kutu-icerik profil-goruntule-ic">

<div class="sol-kisim">
<div class="sol-icerik">
<div class="avatar">
<div class="baslik-avatar"><?php echo $l['uye_resmi']; ?></div>
<?php echo $TEMA_PROFIL['uye_resim']; ?>
</div>

<ul class="profil-sol-menu">
<li><a href="javascript:void(0)" onclick="profilGoster('uyelik-bilgi','imza','baglantilar')"><?php echo $l['uyelik_bilgileri']; ?></a></li>
<li><a href="javascript:void(0)" onclick="profilGoster('baglantilar','uyelik-bilgi','imza')"><?php echo $l['baglantilar']; ?></a></li>
<li><a href="javascript:void(0)" onclick="profilGoster('imza','uyelik-bilgi','baglantilar')"><?php echo $l['hakkinda'].' - '.$l['imza']; ?></a></li>
</ul>

</div>
</div><!-- sol kısım -->



<div class="sag-kisim">
<div class="sag-icerik">
<!-- ÜYE BİLGİLERİ -->
<div id="uyelik-bilgi">

<div class="profil-kutusu">
<div class="baslik"><b><?php echo $l['uye_bilgileri']; ?></b></div>
<div class="kutu-ic">

<div class="kutu-liste">
<div class="liste-sol"><?php echo $l['uye_adi']; ?>:</div>
<div class="liste-sag"><?php echo $TEMA_PROFIL['uye_adi']; ?></div>
<div class="clear"></div>
</div>

<div class="kutu-liste">
<div class="liste-sol"><?php echo $l['ad_soyad']; ?>:</div>
<div class="liste-sag"><?php echo $TEMA_PROFIL['tam_adi']; ?></div>
<div class="clear"></div>
</div>

<div class="kutu-liste">
<div class="liste-sol"><?php echo $l['yetki']; ?>:</div>
<div class="liste-sag"><?php echo $TEMA_PROFIL['uye_yetki']; ?></div>
<div class="clear"></div>
</div>

<div class="kutu-liste">
<div class="liste-sol"><?php echo $l['konum']; ?>:</div>
<div class="liste-sag"><?php echo $TEMA_PROFIL['uye_sehir']; ?></div>
<div class="clear"></div>
</div>

<div class="kutu-liste">
<div class="liste-sol"><?php echo $l['cinsiyet']; ?>:</div>
<div class="liste-sag"><?php echo $TEMA_PROFIL['uye_cinsiyet']; ?></div>
<div class="clear"></div>
</div>

<div class="kutu-liste">
<div class="liste-sol"><?php echo $TEMA_PROFIL['dogum_yas']; ?>:</div>
<div class="liste-sag"><?php echo $TEMA_PROFIL['uye_dogum']; ?></div>
<div class="clear"></div>
</div>

<div class="kutu-liste">
<div class="liste-sol"><?php echo $l['kayit_tarihi']; ?>:</div>
<div class="liste-sag"><?php echo $TEMA_PROFIL['uye_katilim']; ?></div>
<div class="clear"></div>
</div>

<div class="kutu-liste">
<div class="liste-sol"><?php echo $l['son_giris']; ?>:</div>
<div class="liste-sag"><?php echo $TEMA_PROFIL['uye_giris']; ?></div>
<div class="clear"></div>
</div>

<div class="kutu-liste">
<div class="liste-sol"><?php echo $l['yorum_sayisi']; ?>:</div>
<div class="liste-sag"><?php echo $TEMA_PROFIL['yorum_sayisi']; ?></div>
<div class="clear"></div>
</div>

<div class="kutu-liste">
<div class="liste-sol"><?php echo $l['durum']; ?>:</div>
<div class="liste-sag"><?php echo $TEMA_PROFIL['uye_durum']; ?></div>
<div class="clear"></div>
</div>

</div>
</div>

<div class="profil-kutusu">
<div class="baslik"><b><?php echo $l['son_bulundugu_sayfa']; ?></b></div>
<div class="kutu-ic">
<p><?php echo $TEMA_PROFIL['uye_sayfa']; ?></p>
</div>
</div>

</div>


<!-- HAKKINDA -->

<div id="imza">
<div class="profil-kutusu">
<div class="baslik"><b><?php echo $l['imza']; ?></b></div>
<div class="kutu-ic">
<?php echo $TEMA_PROFIL['uye_imza']; ?>
</div>
</div>
<br />
<div class="profil-kutusu">
<div class="baslik"><b><?php echo $l['hakkinda']; ?></b></div>
<div class="kutu-ic">
<?php echo $TEMA_PROFIL['uye_hakkinda']; ?>
</div>
</div>
</div>


<!-- BAĞLANTILAR -->

<div class="profil-kutusu" id="baglantilar">
<div class="baslik"><b><?php echo $l['baglantilar']; ?></b></div>
<div class="kutu-ic">

<div class="kutu-liste">
<div class="liste-sol"><?php echo $l['eposta']; ?>:</div>
<div class="liste-sag"><?php echo $TEMA_PROFIL['uye_eposta']; ?></div>
<div class="clear"></div>
</div>

<div class="kutu-liste">
<div class="liste-sol"><?php echo $l['ozel_ileti']; ?>:</div>
<div class="liste-sag"><?php echo $TEMA_PROFIL['uye_oi']; ?></div>
<div class="clear"></div>
</div>

<div class="kutu-liste">
<div class="liste-sol"><?php echo $l['web_sitesi']; ?>:</div>
<div class="liste-sag"><?php echo $TEMA_PROFIL['uye_web']; ?></div>
<div class="clear"></div>
</div>

<div class="kutu-liste">
<div class="liste-sol"><?php echo $l['facebook']; ?>:</div>
<div class="liste-sag"><?php echo $TEMA_PROFIL['uye_facebook']; ?></div>
<div class="clear"></div>
</div>

<div class="kutu-liste">
<div class="liste-sol"><?php echo $l['twitter']; ?>:</div>
<div class="liste-sag"><?php echo $TEMA_PROFIL['uye_twitter']; ?></div>
<div class="clear"></div>
</div>

<div class="kutu-liste">
<div class="liste-sol"><?php echo $l['skype']; ?>:</div>
<div class="liste-sag"><?php echo $TEMA_PROFIL['uye_msn']; ?></div>
<div class="clear"></div>
</div>

<div class="kutu-liste">
<div class="liste-sol"><?php echo $l['yahoo']; ?>:</div>
<div class="liste-sag"><?php echo $TEMA_PROFIL['uye_yahoo']; ?></div>
<div class="clear"></div>
</div>

<div class="kutu-liste">
<div class="liste-sol"><?php echo $l['icq']; ?>:</div>
<div class="liste-sag"><?php echo $TEMA_PROFIL['uye_icq']; ?></div>
<div class="clear"></div>
</div>

</div>
</div>
</div>

</div><!-- sağ kısım -->

<div class="clear"></div>

</div>
</div>

</div>

<script type="text/javascript">
profilGoster('uyelik-bilgi','imza','baglantilar');
</script>
