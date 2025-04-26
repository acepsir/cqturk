<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();
eval(phpkf_tema_sayfa_baslik());
?>

<style type="text/css" scoped="scoped">
@import url("../temalar/varsayilan/css/sablon.css");
@import url("phpkf-bilesenler/temalar/varsayilan/css/yonetim.css");
@import url("../phpkf-bilesenler/sablon.php");
</style>

<div class="link-agaci"><?php echo $forum_anasayfa.$ust_forum_baslik.$alt_forum_baslik.$konu_baslik; ?></div>

<div style="float: left; position: relative; width: 100%; height: 40px;">
<div style="float: right; position: relative; width: 50%" class="sayfalama"><?php echo $sayfalama_cikis; ?></div>
</div>

<table cellspacing="1" width="100%" cellpadding="4" border="0" align="center" class="tablo-ana">

<?php if ($_GET['ks'] < 1 ): ?>

	<tr>
	<td colspan="2" class="forum-kategori-alt-baslik" align="left">
<a name="c0"></a>
<?php echo $mesaj_satir['mesaj_baslik']; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <font class="liste-veri" style="color: #ffffff;"><i>(gösterim sayısı: <?php echo $mesaj_satir['goruntuleme']; ?>)</i></font>
	</td>
	</tr>

	<tr class="liste-etiket tablo-baslik" bgcolor="#f5f5f5">
	<td width="170" align="center" class="mobil-gizle">Yazan</td>
	<td width="100%" align="center">Konu içeriği</td>
	</tr>

	<tr class="liste-veri tablo-ici">
	<td width="170" valign="top" rowspan="2" align="left" class="mobil-gizle">
<img src="../temalar/varsayilan/resimler/bosluk170.gif" width="170" height="1" border="0" style="display:block;height:0px" alt="boşluk">

<div class="yazar-bilgi"><b><?php echo $konu_acan; ?></b></div>
<div class="yazar-bilgi">[<?php echo $konu_acan_adi; ?>]</div>
<div class="yazar-bilgi"><?php echo $konu_acan_yetkisi; ?></div>
<div class="yazar-bilgi"><div style="max-width:160px; max-height:160px"><?php echo $konu_acan_resmi; ?></div></div>
<div class="yazar-bilgi">
	<font size="1" face="verdana">
Kayıt Tarihi: <?php echo $konu_acan_kayit; ?>
<br>
İleti Sayısı: <?php echo NumaraBicim($konu_acan_mesajsayi); ?>
<br>
Konum: <?php echo $konu_acan_sehir; ?>
<br>
Durum: <?php echo $konu_acan_durum; ?>
<br>
<br>
<?php echo $konu_acan_eposta; ?>
<?php echo $konu_acan_web; ?>
<br>
<?php echo $konu_acan_ozel; ?>
<br>
</font>
</div>

	</td>

	<td valign="top" height="150" align="left">
<div align="left" style="width:52%; float:left; position:relative; padding-left:10px; margin-top:10px">
<div class="masa-gizle tablet-gizle">
<b>Konu Yazan:</b> <?php echo $konu_acan; ?><br>
</div>
<b>Konu Tarihi: </b> <?php echo $konu_tarihi; ?>
</div>
<div align="right" style="width:45%; float:right; position:relative; padding-top:4px">
<?php echo $konu_alinti_duzenle; ?>
</div>


<div style="width: 100%; float: left; position: relative;">
<hr size="1" style="border:0;border-bottom: 2px solid #ccc">
<br>
</div>

<div style="width:99%; margin:auto; position:relative; overflow:auto; word-wrap:break-word; text-wrap:suppress">

<?php echo $konu_icerik; ?>

<br><br>
</div>
	</td>
	</tr>

	<tr>
	<td height="23" class="liste-veri tablo-ici" align="left">
<?php echo $konu_acan_imza.$konu_degisme; ?>
	</td>
	</tr>


<?php endif; // konu sadece ilk sayfada gösteriliyor ?>






<?php
// SADECE BAŞLIĞIN CEVAPLARI VARSA WHILE DÖNGÜSÜNE GİRİLİYOR //

if (isset($satir_sayi)):
while ($cevap_satir = $vt->fetch_assoc($cevap)):

$vtsorgu = "SELECT id,kullanici_adi,gercek_ad,resim,katilim_tarihi,mesaj_sayisi,sehir_goster,sehir,web,imza,yetki,son_hareket,gizli,engelle,hangi_sayfada,sayfano,ozel_ad 
FROM $tablo_kullanicilar WHERE kullanici_adi='$cevap_satir[cevap_yazan]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$cevap_sahibi = $vt->fetch_assoc($vtsonuc);



//  CEVAP TABLOLARI - BAŞI  //

$cevap_aname = '<a name="c'.$cevap_satir['id'].'"></a>';

$ileti_no++;


if ($cevap_sahibi['engelle'] != 1) $cevap_yazan = '<a href="../profil.php?u='.$cevap_sahibi['id'].'">'.$cevap_satir['cevap_yazan'].'</a>';

else $cevap_yazan = '<a href="../profil.php?u='.$cevap_sahibi['id'].'"><s>'.$cevap_satir['cevap_yazan'].'</s></a>';


if (!empty($cevap_sahibi['gercek_ad']))
	$cevap_yazan_adi = $cevap_sahibi['gercek_ad'];

else $cevap_yazan_adi = '';


if (!empty($cevap_sahibi['ozel_ad']))
	$cevap_yazan_yetkisi = '<font class="ozel_ad"><u>'.$cevap_sahibi['ozel_ad'].'</u></font>';

elseif ($cevap_sahibi['id'] == 1)
	$cevap_yazan_yetkisi = '<font class="kurucu"><u>'.$ayarlar['kurucu'].'</u></font>';

elseif ($cevap_sahibi['yetki'] == 1)
	$cevap_yazan_yetkisi = '<font class="yonetici"><u>'.$ayarlar['yonetici'].'</u></font>';

elseif ($cevap_sahibi['yetki'] == 2)
	$cevap_yazan_yetkisi = '<font class="yardimci"><u>'.$ayarlar['yardimci'].'</u></font>';

else $cevap_yazan_yetkisi = '<font class="kullanici">'.$ayarlar['kullanici'].'</font>';


if ($cevap_sahibi['resim'] != '')
{
	if (preg_match('/^(\/|http:|https:|ftp:)/i', $cevap_sahibi['resim']))
		$cevap_yazan_resmi = '<img src="'.$cevap_sahibi['resim'].'" alt="Kullanıcı Resmi" style="max-width:98%" />';

	else $cevap_yazan_resmi = '<img src="../'.$cevap_sahibi['resim'].'" alt="Kullanıcı Resmi" style="max-width:98%" />';
}

elseif ($ayarlar['v-uye_resmi'] != '')
{
	if (preg_match('/^(\/|http:|https:|ftp:)/i', $ayarlar['v-uye_resmi']))
		$cevap_yazan_resmi = '<img src="'.$ayarlar['v-uye_resmi'].'" alt="Varsayılan Kullanıcı Resmi" style="max-width:98%" />';

	else $cevap_yazan_resmi = '<img src="../'.$ayarlar['v-uye_resmi'].'" alt="Varsayılan Kullanıcı Resmi" style="max-width:98%" />';
}

else $cevap_yazan_resmi = '';


if (!empty($cevap_sahibi['katilim_tarihi']))
	$cevap_yazan_kayit = zaman('d.m.Y', $ayarlar['saat_dilimi'], false, $cevap_sahibi['katilim_tarihi'], $ayarlar['tarih'], true);

else $cevap_yazan_kayit ='';


if (!empty($cevap_sahibi['mesaj_sayisi']))
	$cevap_yazan_mesajsayi = $cevap_sahibi['mesaj_sayisi'];

else $cevap_yazan_mesajsayi = '';


if ($cevap_sahibi['sehir_goster'] == 1)
	$cevap_yazan_sehir = $cevap_sahibi['sehir'];

else $cevap_yazan_sehir = 'Gizli';


if (empty($cevap_sahibi['gercek_ad']))
	$cevap_yazan_durum = '<font color="#FF0000">üye silinmiş</font>';

elseif ($cevap_sahibi['engelle'] == 1)
	$cevap_yazan_durum = '<font color="#FF0000">üye uzaklaştırılmış</font>';

elseif ($cevap_sahibi['gizli'] == 1)
	$cevap_yazan_durum = '<font color="#FF0000">Gizli</font>';

elseif ( (($cevap_sahibi['son_hareket'] + $zaman_asimi) > $tarih ) AND
		($cevap_sahibi['sayfano'] != '-1') )
	$cevap_yazan_durum = '<font color="#339900">Forumda</font>';

else $cevap_yazan_durum = '<font color="#FF0000">Forumda Değil</font>';


$cevap_yazan_eposta = '<a title="Forum üzerinden e-posta gönder" href="../eposta.php?kim='.$cevap_sahibi['kullanici_adi'].'">E-Posta Gönder</a>';


if ($cevap_sahibi['web'])
	$cevap_yazan_web = '<br><a target="_blank" href="'.$cevap_sahibi['web'].'">Web Adresi</a>';

else $cevap_yazan_web = '';


$cevap_yazan_ozel = '<a href="../oi_yaz.php?ozel_kime='.$cevap_sahibi['kullanici_adi'].'">Özel ileti Gönder</a>';

$cevap_tarihi = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $cevap_satir['tarih'], $ayarlar['tarih'], true);

$cevap_alinti_duzenle = '';


// SİL VE GERİ YÜKLE OLUŞTURULUYOR

if ( ($mesaj_satir['silinmis'] != 1) AND ($cevap_satir['silinmis'] == 1) )
$cevap_alinti_duzenle .= '<a href="'.$dosya_forum_silinmis.'?kurtarc='.$cevap_satir['id'].'&amp;ks='.$_GET['ks'].'&amp;yo='.$yo.'"><img '.$simge_gerial.' alt="Bu cevabı geri yükle" title="Bu cevabı geri yükle"></a>&nbsp;&nbsp;<a href="'.$dosya_forum_silinmis.'?silc='.$cevap_satir['id'].'&amp;yo='.$yo.'"><img '.$simge_sil.' alt="Bu cevabı kalıcı olarak sil" title="Bu cevabı kalıcı olarak sil" onclick="return window.confirm(\'Bu cevabı kalıcı olarak silmek istediğinize emin misiniz?\')"></a>&nbsp;&nbsp;';

$cevap_alinti_duzenle .= '<a href="forum_ip_yonetimi.php?kip=1&amp;ip='.$cevap_satir['yazan_ip'].'"><img '.$simge_ip.' alt="Bu cevabı yazanın ip adresi" title="Bu cevabı yazanın ip adresi"></a>&nbsp;&nbsp;';



// CEVAPLARIN İÇERİĞİ YAZDIRILIYOR
// VARSA İMZA VE DEĞİŞTİRME BİLGİLERİ YAZDIRILIYOR


if ($cevap_satir['ifade'] == 1)
	$cevap_satir['cevap_icerik'] = ifadeler($cevap_satir['cevap_icerik']);

if ( ($cevap_satir['bbcode_kullan'] == 1) AND ($ayarlar['bbcode'] == 1) )
	$cevap_icerik = bbcode_acik($cevap_satir['cevap_icerik'],$cevap_satir['id']);

else $cevap_icerik = bbcode_kapali($cevap_satir['cevap_icerik']);

if ( (isset($cevap_sahibi['imza'])) and ($cevap_sahibi['imza']!='') )
{
	if ($ayarlar['bbcode'] == 1) $cevap_yazan_imza = bbcode_acik(ifadeler($cevap_sahibi['imza']),1);
	else $cevap_yazan_imza = bbcode_kapali(ifadeler($cevap_sahibi['imza']));
}

else $cevap_yazan_imza = '';




//  İLETİ DEĞİŞTİRİLME BİLGİLERİ  //

$cevap_degisme = '';

if ($cevap_satir['degistirme_sayisi'] != 0):
	$cevap_degisme .= '<hr class="ileti_degisim_bilgi" /><font size="1"><i> Bu ileti en son <b>'.$cevap_satir['degistiren'].'</b>
tarafından <b>'.zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $cevap_satir['degistirme_tarihi'], $ayarlar['tarih'], true).'</b> tarihinde, toplamda '.$cevap_satir['degistirme_sayisi'].' kez değiştirilmiştir.</i></font>&nbsp;<a href="forum_ip_yonetimi.php?kip=1&amp;ip='.$cevap_satir['degistiren_ip'].'"><img '.$simge_ip.' alt="Bu konuyu değiştirenin ip adresi" title="Bu konuyu değiştirenin ip adresi"></a>';
endif;



echo '
	<tr>
	<td colspan="2" class="forum-kategori-alt-baslik" align="left">
'.$cevap_aname.'
<div style="float: left; text-align: left; width: 70%">'.$cevap_satir['cevap_baslik'].'</div>
<div style="float: right; text-align: right; font-size: 11px; position: relative; top: 3px; width: 30%">
Cevap: '.$ileti_no.' &nbsp; 
</div>
	</td>
	</tr>

	<tr class="liste-etiket tablo-baslik" bgcolor="#f5f5f5">
	<td width="170" align="center" class="mobil-gizle">Yazan</td>
	<td width="100%" align="center">Cevap içeriği</td>
	</tr>

	<tr class="liste-veri tablo-ici">
	<td width="170" valign="top" rowspan="2" align="left" class="mobil-gizle">
<img src="../temalar/varsayilan/resimler/bosluk170.gif" width="170" height="1" border="0" style="display:block;height:0px" alt="boşluk">
<div class="yazar-bilgi"><b>'.$cevap_yazan.'</b></div>
<div class="yazar-bilgi">['.$cevap_yazan_adi.']</div>
<div class="yazar-bilgi">'.$cevap_yazan_yetkisi.'</div>
<div class="yazar-bilgi"><div style="max-width:160px; max-height:160px">'.$cevap_yazan_resmi.'</div></div>
<div class="yazar-bilgi"><font size="1" face="verdana">
Kayıt Tarihi: '.$cevap_yazan_kayit.'
<br>
İleti Sayısı: '.$cevap_yazan_mesajsayi.'
<br>
Konum: '.$cevap_yazan_sehir.'
<br>
Durum: '.$cevap_yazan_durum.'
<br>
<br>'
.$cevap_yazan_eposta.'<br>'
.$cevap_yazan_web.'<br>'
.$cevap_yazan_ozel.'<br>
</font>
</div>


	</td>

	<td valign="top" height="150" align="left">
<div align="left" style="width:52%; float:left; position:relative; padding-left:10px; margin-top:10px">
<div class="masa-gizle tablet-gizle">
<b>Cevap Yazan:</b> '.$cevap_yazan.'<br>
</div>
<b>Cevap Tarihi: </b> '.$cevap_tarihi.'
</div>
<div align="right" style="width:45%; float:right; position:relative; padding-top:4px">
'.$cevap_alinti_duzenle.'
</div>


<div style="width: 100%; float: left; position: relative;">
<hr size="1" style="border:0;border-bottom: 2px solid #ccc">
<br>
</div>

<div style="width: 100%; float: left; position: relative; overflow: auto; word-wrap: break-word; text-wrap: suppress;">
'.$cevap_icerik.'
<br><br>
</div>
	</td>
	</tr>

	<tr>
	<td height="23" class="liste-veri tablo-ici" align="left">
'.$cevap_yazan_imza.$cevap_degisme.'
	</td>
	</tr>
';

endwhile;
endif;

?>

</table>

<div style="float: left; position: relative; width: 100%;margin-top:10px">
<div style="float: right; position: relative; width: 50%" class="sayfalama"><?php echo $sayfalama_cikis; ?></div>
</div>
<div class="clear"></div>

<div class="link-agaci"><?php echo $forum_anasayfa.$ust_forum_baslik.$alt_forum_baslik.$konu_baslik; ?></div>

