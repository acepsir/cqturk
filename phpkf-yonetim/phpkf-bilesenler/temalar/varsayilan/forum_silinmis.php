<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();
eval(phpkf_tema_sayfa_baslik());
include_once('menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $tema_sayfa_baslik; ?></div>
<div class="kutu-icerik">


<table cellspacing="1" cellpadding="3" width="100%" border="0" align="center" class="tablo-ana" style="margin-top:15px">
	<tr>
	<td colspan="7" class="tablo-baslik" align="center" valign="middle">Silinen Başlıklar</td>
	</tr>
	<tr class="tablo-baslik" style="height:30px">
	<td align="center">Sıra</td>
	<td align="center">Başlık</td>
	<td align="center">Forum</td>
	<td align="center" width="110">Yazan</td>
	<td align="center" width="65">Cevap</td>
	<td align="center" width="75">Gösterim</td>
	<td align="center" width="180">Son ileti</td>
	</tr>

<?php
if ($vt->num_rows($vtsonuc10)):
$sira = 1;

while ($konular = $vt->fetch_assoc($vtsonuc10))
{
	$konu_baslik = '<a href="'.$dosya_konu_silinmis.'?k='.$konular['id'].'">'.$konular['mesaj_baslik'].'</a>';
	$forum_baslik = '<a href="../forum.php?f='.$konular['hangi_forumdan'].'">'.$tumforum_satir[$konular['hangi_forumdan']].'</a>';
	$konu_acan = '<a href="../profil.php?kim='.$konular['yazan'].'">'.$konular['yazan'].'</a>';


	// cevap varsa
	if ($konular['cevap_sayi'] == 0)
	$konu_sonyazan = '<a href="../profil.php?kim='.$konular['yazan'].'">'.$konular['yazan'].'</a>';

	// cevap yoksa
	else $konu_sonyazan = '<a href="../profil.php?kim='.$konular['son_cevap_yazan'].'">'.$konular['son_cevap_yazan'].'</a>';

	$konu_sontarih = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $konular['son_mesaj_tarihi'], $ayarlar['tarih'], true);

	echo '<tr class="liste-veri" bgcolor="#ffffff">
	<td align="center" width="37" height="30"><b>'.$sira.'</b></td>
	<td align="left">&nbsp;'.$konu_baslik.'</td>
	<td align="left">&nbsp;'.$forum_baslik.'</td>
	<td align="center">'.$konu_acan.'</td>
	<td align="center">'.$konular['cevap_sayi'].'</td>
	<td align="center">'.$konular['goruntuleme'].'</td>
	<td align="left"><b>Yazan: </b>'.$konu_sonyazan.'<br><b>Tarih: </b>'.$konu_sontarih.'</td>
	</tr>';
	$sira++;
}

else:
?>

<tr>
<td align="center" height="50" colspan="7" class="liste-etiket" bgcolor="#ffffff">Silinen başlık yok</td>
</tr>

<?php endif; ?>


</table>
<br>
<br>



<table cellspacing="1" cellpadding="3" width="100%" border="0" align="center" class="tablo-ana">
	<tr>
	<td colspan="7" class="tablo-baslik" align="center" valign="middle">Silinen Cevaplar</td>
	</tr>
	<tr class="tablo-baslik" style="height:30px">
	<td align="center">Sıra</td>
	<td align="center">Başlık</td>
	<td align="center">Forum</td>
	<td align="center" width="110">Cevap Yazan</td>
	<td align="center" width="65">Cevap</td>
	<td align="center" width="75">Gösterim</td>
	<td align="center" width="180">Tarih</td>
	</tr>

<?php
if ($vt->num_rows($vtsonuc11)):
$sira = 1;

while ($cevaplar = $vt->fetch_assoc($vtsonuc11))
{
	// cevabın konusunun bilgileri çekiliyor
	$vtsorgu = "SELECT id,cevap_sayi,goruntuleme,mesaj_baslik,silinmis FROM $tablo_mesajlar WHERE id='$cevaplar[hangi_basliktan]'";
	$vtsonuc12 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$konular = $vt->fetch_assoc($vtsonuc12);


	// cevabın konusu silinmişse cevap bölümünde gösterme
	if ($konular['silinmis'] == 1) continue;


	// cevabın kaçıncı sırada olduğu hesaplanıyor
	$vtsonuc9 = $vt->query("SELECT id FROM $tablo_cevaplar WHERE silinmis='0' AND hangi_basliktan='$cevaplar[hangi_basliktan]' AND id < $cevaplar[id]") or die ($vt->hata_ver());
	$cavabin_sirasi = $vt->num_rows($vtsonuc9);

	$sayfaya_git = ($cavabin_sirasi / $ayarlar['ksyfkota']);
	settype($sayfaya_git,'integer');
	$sayfaya_git = ($sayfaya_git * $ayarlar['ksyfkota']);

	if ($sayfaya_git != 0) $sayfaya_git = '&amp;ks='.$sayfaya_git;
	else $sayfaya_git = '';


	// bağlantılar oluşturuluyor
	$cevap_baslik = '<a href="'.$dosya_konu_silinmis.'?k='.$konular['id'].$sayfaya_git.'#c'.$cevaplar['id'].'">'.$konular['mesaj_baslik'].' &raquo; '.$cevaplar['cevap_baslik'].'</a>';
	$forum_baslik = '<a href="../forum.php?f='.$cevaplar['hangi_forumdan'].'">'.$tumforum_satir[$cevaplar['hangi_forumdan']].'</a>';
	$cevap_yazan = '<a href="../profil.php?kim='.$cevaplar['cevap_yazan'].'">'.$cevaplar['cevap_yazan'].'</a>';

	$cevap_tarihi = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $cevaplar['tarih'], $ayarlar['tarih'], true);

	echo '<tr class="liste-veri" bgcolor="#ffffff">
	<td align="center" width="30" height="30"><b>'.$sira.'</b></td>
	<td align="left">&nbsp;'.$cevap_baslik.'</td>
	<td align="left">&nbsp;'.$forum_baslik.'</td>
	<td align="center">'.$cevap_yazan.'</td>
	<td align="center">'.$konular['cevap_sayi'].'</td>
	<td align="center">'.$konular['goruntuleme'].'</td>
	<td align="center">'.$cevap_tarihi.'</td>
	</tr>';

	$sira++;
}

else:
?>

<tr>
<td align="center" height="50" colspan="7" class="liste-etiket" bgcolor="#ffffff">Silinen cevap yok</td>
</tr>

<?php endif; ?>

</table>
<br>
<br>


<table cellspacing="1" cellpadding="3" width="100%" border="0" align="center" class="tablo-ana" style="margin-bottom:20px">
	<tr>
	<td colspan="7" class="tablo-baslik" align="center" valign="middle">Silinen Profil Yorumları</td>
	</tr>
	<tr class="tablo-baslik" style="height:30px">
	<td align="center">Sıra</td>
	<td align="center" width="90">Profil</td>
	<td align="center" width="90">Yazan</td>
	<td align="center" width="115">Tarih</td>
	<td align="center">Yorum</td>
	<td align="center">Geri</td>
	<td align="center">Sil</td>
	</tr>

<?php
if ($vt->num_rows($vtsonuc13)):
$sira = 1;

while ($yorumlar = $vt->fetch_assoc($vtsonuc13))
{
	$yorum_uye = '<a href="../profil.php?u='.$yorumlar['uye_id'].'">'.$yorumlar['uye_adi'].'</a>';
	$yorum_yazan = '<a href="../profil.php?u='.$yorumlar['yazan_id'].'">'.$yorumlar['yazan'].'</a>';
	$yorum_tarihi = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $yorumlar['tarih'], $ayarlar['tarih'], true);
	$yorum = bbcode_acik(ifadeler($yorumlar['yorum_icerik']), 0);

	$geri = '<a href="'.$dosya_adi.'?kurtary='.$yorumlar['id'].'&amp;yo='.$yo.'">'.$gerial_simge.'</a>';
	$sil = '<a href="'.$dosya_adi.'?sily='.$yorumlar['id'].'&amp;yo='.$yo.'" onclick="return window.confirm(\'Bu yorumu kalıcı olarak silmek istediğinize emin misiniz?\')">'.$sil_simge.'</a>';

	echo '<tr class="liste-veri" bgcolor="#ffffff">
	<td align="center" width="30" height="30"><b>'.$sira.'</b></td>
	<td align="center">'.$yorum_uye.'</td>
	<td align="center">'.$yorum_yazan.'</td>
	<td align="center">'.$yorum_tarihi.'</td>
	<td align="left" valign="middle">'.$yorum.'</td>
	<td align="center" width="30" height="30">'.$geri.'</td>
	<td align="center" width="30" height="30">'.$sil.'</td>
	</tr>';

	$sira++;
}

else:
?>

<tr>
<td align="center" height="50" colspan="7" class="liste-etiket" bgcolor="#ffffff">Silinen profil yorumu yok</td>
</tr>

<?php endif; ?>

</table>

</div>
</div>
</div>
