<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();
eval(phpkf_tema_sayfa_baslik());
include_once('menu.php');
?>

<script type="text/javascript"><!-- //
function denetle()
{ 
	var dogruMu = true;
	for (var i=0; i<9; i++)
	{
		if (document.form1.elements[i].value=="")
		{ 
			dogruMu = false;
			alert(jsl["isaretli_alanlar_zorunludur"]);
			break
		}
	}

	if (document.form1.ysifre.value != document.form1.ysifre2.value)
	{
		dogruMu = false;
		alert(jsl["sifreler_uyusmuyor"]);
	}
	return dogruMu;
}
//  -->
</script>


<form name="form1" action="phpkf-bilesenler/uye_degistir_yap.php" method="post" enctype="multipart/form-data" onSubmit="return denetle()">
<input type="hidden" name="profil_degisti_mi" value="form_dolu" />
<input type="hidden" name="MAX_FILE_SIZE" value="1022999" />
<input type="hidden" name="id" value="<?php echo $satir['id']; ?>" />
<input type="hidden" name="yo" value="<?php echo $yo; ?>" />



<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $tema_sayfa_baslik; ?></div>
<div class="kutu-icerik">


<table cellspacing="0" cellpadding="0" width="650" border="0" align="center">
	<tr>
	<td align="center" valign="top">

<table cellspacing="0" cellpadding="0" border="0" align="center">
	<tr>
	<td align="center" class="liste-veri" height="25">
<a href="uyeler.php"><?php echo $ly['etkin_uyeler']; ?></a> &nbsp; | &nbsp;
<a href="uyeler.php?kip=etkisiz"><?php echo $ly['etkin_olmayan_uyeler']; ?></a> &nbsp; | &nbsp;
<a href="uyeler.php?kip=engelli"><?php echo $ly['engellenmis_uyeler']; ?></a> &nbsp; | &nbsp;
<a href="yeni_uye.php"><?php echo $ly['yeni_uye_ekle']; ?></a>
	</td>
	</tr>
</table>




<table cellspacing="1" width="97%" cellpadding="6" border="0" align="center" bgcolor="#e0e0e0">
	<tr>
	<td bgcolor="#ececec" align="center" style="color:#555555; border:1px solid #ffffff" colspan="2"><b><?php echo $l['uyelik_bilgileri']; ?></b></td>
	</tr>

	<tr class="tablo_ici">
	<td width="50%"><?php echo $l['kullanici_adi']; ?></td>
	<td width="50%" align="left">
<b><?php echo $satir['kullanici_adi'] ?></b> &nbsp; 
<font size="-2" style="font-weight: normal">
<i>(<?php echo $l['kullanici_adi_degistirilemez']; ?>)</i>
</font>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $l['ad_soyad']; ?> <font size="1">*</font></td>
	<td align="left">
<input class="input-text" type="text" name="gercek_ad" size="35" maxlength="30" value="<?php echo $satir['gercek_ad'] ?>" required />
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left">
<?php echo $l['sifre']; ?> <font size="1">*</font>
<br>
<font size="1" style="font-weight: normal">
<i><?php echo $l['degismeyecekse_dokunma']; ?></i>
</font>
	</td>
	<td align="left">
<input class="input-text" type="password" name="ysifre" size="35" maxlength="20" value="sifre_degismedi" required />
	</td>
	</tr>
	
	<tr class="tablo_ici">
	<td align="left"><?php echo $l['yeni_sifre'].' '.$l['tekrar']; ?> <font size="1">*</font></td>
	<td align="left">
<input class="input-text" type="password" name="ysifre2" size="35" maxlength="20" value="sifre_degismedi" required />

<script type="text/javascript"><!-- //
document.form1.ysifre.setAttribute("autocomplete","off"); 
document.form1.ysifre2.setAttribute("autocomplete","off"); 
//  -->
</script>

	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $l['eposta_adresi']; ?> <font size="1">*</font></td>
	<td align="left">
<input class="input-text" type="text" name="posta" size="35" maxlength="70" value="<?php echo $satir['posta'] ?>" required />
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $l['dogum_tarihi']; ?> <font size="1">*</font>
<font size="1" style="font-weight: normal">
<br><i><?php echo $ly['ornek'] ?>: 01-01-1981</i>
</font>
	</td>
	<td align="left">
<input class="input-text" type="text" name="dogum_tarihi" size="10" maxlength="10" value="<?php echo $satir['dogum_tarihi'] ?>" required />
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $l['konum']; ?></td>
	<td align="left">
<input class="input-text" type="text" name="sehir" size="35" maxlength="50" value="<?php echo $satir['sehir']; ?>" />
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $l['web_sitesi']; ?></td>
	<td align="left">
<input class="input-text" type="text" name="web" size="35" maxlength="70" value="<?php echo $satir['web'] ?>" />
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $l['cinsiyet']; ?></td>
	<td align="left">
<select class="input-select" name="cinsiyet">
<option value="0"><?php echo $l['secin']; ?></option>
<?php
// Cinsiyet seçimi
echo '<option value="1"';
if ($satir['cinsiyet'] == '1') echo ' selected="selected"';
echo '>'.$l['erkek'].'</option>
<option value="2"';
if ($satir['cinsiyet'] == '2') echo ' selected="selected"';
echo '>'.$l['kadin'].'</option>';
?>
</select>
	</td>
	</tr>


<?php
// forum tema seçimi alanı
if ($forum_kullan == '1')
{
	$temalar = explode(',',$ayarlar['tema_secenek']);
	$adet = count($temalar);

	$uye_tema = '
	<tr class="tablo_ici">
	<td align="left">Seçilebilir Forum Temaları</td>
	<td align="left">
	<select class="input-select" name="tema_secim">';

	for ($i=0; $adet-1 > $i; $i++)
	{
		if ($satir['temadizini'] != $temalar[$i])
			$uye_tema .= '<option value="'.$temalar[$i].'">'.$temalar[$i].'</option>';
		else $uye_tema .= '<option value="'.$temalar[$i].'" selected="selected">'.$temalar[$i].'</option>';
	}

	$uye_tema .= '</select>
	</td>
	</tr>';

	echo $uye_tema;
}

// portal tema seçimi alanı
if ($portal_kullan == '1')
{
	$ptemalar = explode(',', $ayarlar['tema_secenek_portal']);
	$adet = count($ptemalar);

	$uye_tema = '
	<tr class="tablo_ici">
	<td align="left">Seçilebilir Portal Temaları</td>
	<td align="left">
	<select class="input-select" name="tema_secimp">';

	for ($i=0; $adet-1 > $i; $i++)
	{
		if ($satir['temadizinip'] != $ptemalar[$i])
			$uye_tema .= '<option value="'.$ptemalar[$i].'">'.$ptemalar[$i].'</option>';
		else $uye_tema .= '<option value="'.$ptemalar[$i].'" selected="selected">'.$ptemalar[$i].'</option>';
	}

	$uye_tema .= '
	</select>
	</td>
	</tr>';

	echo $uye_tema;
}
?>





	<tr>
	<td bgcolor="#ececec" align="center" style="color:#555555; border:1px solid #ffffff" colspan="2"><b><?php echo $ly['yetkiler'];?></b></td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $ly['yetkisi'];?> <font size="1">*</font></td>
	<td align="left">
<?php
	echo '<input type="hidden" name="eski_yetki" value="'.$satir['yetki'].'" />
	<select class="input-select" name="yetki">
	<option value="0"';

	if ($satir['yetki'] == 0) echo ' selected="selected"';
	echo '>'.$l['yetkisiz'].'</option>';

	echo '<option value="3"';
	if ($satir['yetki'] == 3) echo ' selected="selected"';
	echo '>'.$l['blm_yrd'].'</option>';

	echo '<option value="2"';
	if ($satir['yetki'] == 2) echo ' selected="selected"';
	echo '>'.$l['yardimci'].'</option>';

	echo '<option value="1"';
	if ($satir['yetki'] == 1) echo ' selected="selected"';
	echo '>'.$l['yonetici'].'</option></select> &nbsp; ';
?>
<a href="forum_uye_izinleri.php?kim=<?php echo $satir['kullanici_adi']?>" class="liste-veri">Diğer Yetkiler</a>
	</td>
	</tr>


	<tr class="tablo_ici">
	<td align="left">
Birincil Grup <font size="1">*</font><br>
<font size="1" style="font-weight: normal">
<i>Seçilen grup yetkilendirilmişse<br>bu seçim üyenin yetkisini etkiler.</i>
</font>
	</td>
	<td align="left">
<select class="input-select" name="grup">

<?php
	// Grupların bilgileri çekiliyor
	$vtsorgu = "SELECT id,grup_adi,uyeler FROM $tablo_gruplar ORDER BY id";
	$vtsonuc_grup = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$grup_secimi = '';
	$grup_secimi2 = '';
	$grup_uyesi = false;

	if ($vt->num_rows($vtsonuc_grup))
	{
		while ($satir_grup = $vt->fetch_assoc($vtsonuc_grup))
		{
			if ($satir_grup['id'] == $satir['grupid'])
			{
				$grup_secimi .= '<option value="'.$satir_grup['id'].'" selected="selected">'.$satir_grup['grup_adi'].'</option>';
				$grup_secimi2 .= '<option value="'.$satir_grup['id'].'">'.$satir_grup['grup_adi'].'</option>';
				$grup_uyesi = true;
			}

			elseif (preg_match("/$satir[id],/", $satir_grup['uyeler']))
			{
				$grup_secimi .= '<option value="'.$satir_grup['id'].'">'.$satir_grup['grup_adi'].'</option>';
				$grup_secimi2 .= '<option value="'.$satir_grup['id'].'" selected="selected">'.$satir_grup['grup_adi'].'</option>';
				$grup_uyesi = true;
			}

			else
			{
				$grup_secimi .= '<option value="'.$satir_grup['id'].'">'.$satir_grup['grup_adi'].'</option>';
				$grup_secimi2 .= '<option value="'.$satir_grup['id'].'">'.$satir_grup['grup_adi'].'</option>';
				$grup_uyesi = false;
			}
		}
	}

	else
	{
		$grup_secimi .= '<option value="0">Henüz grup oluşturulmamış &nbsp;</option>';
		$grup_secimi2 .= '<option value="0">Henüz grup oluşturulmamış &nbsp;</option>';
		$grup_uyesi = false;
	}

	if ($grup_uyesi == true) echo '<option value="0">Hiçbir gruba dahil değil &nbsp;</option>'.$grup_secimi.'</select> &nbsp; ';
	else echo '<option value="0" selected="selected">Hiçbir gruba dahil değil &nbsp;</option>'.$grup_secimi.'</select> &nbsp; ';
?>

	</td>
	</tr>


	<tr class="tablo_ici">
	<td align="left" valign="top">
Ek Gruplar<br>
<font size="1" style="font-weight: normal">
<i>Bu seçim üyenin yetkisini <u>etkilemez</u>.<br>
CTRL tuşuna basılı tutarak çoklu seçim yapabilirsiniz.</i>
</font>
	</td>
	<td align="left">
<select class="input-select" name="grupc[]"  multiple="multiple" size="5" style="height:unset">
<?php echo $grup_secimi2.'</select> &nbsp; '; ?>
	</td>
	</tr>


	<tr class="tablo_ici">
	<td align="left">
Özel Ad
<br>
<font size="1" style="font-weight: normal">
<i>Üyeye özel ad verdiğinizde sadece bilgileri altında görünecektir, herhangi bir yetki değişikliği olmayacaktır.</i>
</font>
	</td>
	<td align="left">
<input class="input-text" type="text" name="ozel_ad" size="35" maxlength="30" value="<?php echo $satir['ozel_ad'] ?>">
	</td>
	</tr>










	<tr>
	<td bgcolor="#ececec" align="center" style="color:#555555; border:1px solid #ffffff" colspan="2"><b><?php echo $l['sosyal_aglar']; ?></b></td>
	</tr>


	<tr class="tablo_ici">
	<td align="left"><?php echo $l['facebook']; ?></td>
	<td align="left">
<input class="input-text" type="text" name="aim" size="35" maxlength="70" value="<?php echo $satir['aim'] ?>" />
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $l['twitter']; ?></td>
	<td align="left">
<input class="input-text" type="text" name="skype" size="35" maxlength="70" value="<?php echo $satir['skype'] ?>" />
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $l['skype']; ?></td>
	<td align="left">
<input class="input-text" type="text" name="msn" size="35" maxlength="70" value="<?php echo $satir['msn'] ?>" />
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $l['yahoo']; ?></td>
	<td align="left">
<input class="input-text" type="text" name="yahoo" size="35" maxlength="70" value="<?php echo $satir['yahoo'] ?>" />
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $l['icq']; ?></td>
	<td align="left">
<input class="input-text" type="text" name="icq" size="35" maxlength="30" value="<?php echo $satir['icq'] ?>" />
	</td>
	</tr>




<?php if ( ($ayarlar['uye_resim_yukle'] == 1) OR ($ayarlar['uye_resim_galerisi'] == 1) ): ?>


	<tr>
	<td bgcolor="#ececec" align="center" style="color:#555555; border:1px solid #ffffff" colspan="2"><b><?php echo $l['resim_ayarlari']; ?></b></td>
	</tr>


	<tr class="tablo_ici">
	<td class="liste-veri" colspan="2" align="left">
<?php echo $resim_yukleme_bilgi; ?>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td valign="top" align="left"><?php echo $l['gecerli_resim']; ?></td>
	<td class="liste-veri" align="left">
<?php
if ( (isset($_POST['secim_yap'])) AND
	(isset($_POST['galeri_resimi'])) AND
	($_POST['galeri_resimi'] != '') )
echo '<img src="../'.$_POST['galeri_resimi'].'" alt="'.$l['uye_resmi'].'">&nbsp;
<label style="cursor: pointer;">
<input type="checkbox" name="resim_sil" />'.$l['gecerli_resmi_sil'].'</label>';

elseif ($satir['resim'])
{
	if (preg_match('/^(\/|http:|https:|ftp:)/i', $satir['resim']))
		echo '<img src="'.$satir['resim'].'" alt="'.$l['uye_resmi'].'">&nbsp;
		<label style="cursor: pointer;">
		<input type="checkbox" name="resim_sil" />'.$l['gecerli_resmi_sil'].'</label>';


	else
		echo '<img src="../'.$satir['resim'].'" alt="'.$l['uye_resmi'].'">&nbsp;
		<label style="cursor: pointer;">
		<input type="checkbox" name="resim_sil" />'.$l['gecerli_resmi_sil'].'</label>';
}

else echo $l['yok'];
?>
	</td>
	</tr>

<?php if ($ayarlar['uye_resim_yukle'] == 1): ?>

	<tr class="tablo_ici">
	<td align="left">
<?php echo $l['resim_yukle']; ?>
<br><font size="1" style="font-weight: normal">
<i><?php echo $l['resim_yukleyin']; ?></i>
</font>
	</td>
	<td align="left">
<input class="input-text" name="resim_yukle" type="file" size="30" />
	</td>
	</tr>

<?php endif; if ($ayarlar['uye_resim_galerisi'] == 1): ?>

	<tr class="tablo_ici">
	<td align="left"><?php echo $l['galeriden_resim_sec']; ?></td>
	<td class="liste-veri" align="left">
<a href="../<?php echo $phpkf_dosyalar['profil']; ?>?kip=pgaleri&amp;kim=<?php echo $satir['id'] ?>"><u>Galeriyi Göster</u></a>
<input class="input-text" type="hidden" name="uzak_resim2" size="40" maxlength="150" value="<?php

if ( (isset($_POST['secim_yap'])) AND
	(isset($_POST['galeri_resimi'])) AND
	($_POST['galeri_resimi'] != '') )

echo $_POST['galeri_resimi'];

?>" />
	</td>
	</tr>

<?php endif; endif; ?>





	<tr>
	<td bgcolor="#ececec" align="center" style="color:#555555; border:1px solid #ffffff" colspan="2"><b><?php echo $l['secenekler']; ?></b></td>
	</tr>


	<tr class="tablo_ici">
	<td align="left"><?php echo $l['dogum_goster']; ?></td>
	<td class="liste-veri" align="left">
<label style="cursor: pointer;">
<input type="radio" name="dogum_tarihi_goster" value="1" <?php if ($satir['dogum_tarihi_goster'] == 1) echo 'checked="checked"' ?> />
<?php echo $l['tarih']; ?></label>&nbsp;&nbsp;
<label style="cursor: pointer;">
<input type="radio" name="dogum_tarihi_goster" value="2" <?php if ($satir['dogum_tarihi_goster'] == 2) echo 'checked="checked"' ?> />
<?php echo $l['yas']; ?></label>&nbsp;&nbsp;
<label style="cursor: pointer;">
<input type="radio" name="dogum_tarihi_goster" value="0" <?php if ($satir['dogum_tarihi_goster'] == 0) echo 'checked="checked"' ?> />
<?php echo $l['gizle']; ?></label>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $l['eposta_goster']; ?></td>
	<td class="liste-veri" align="left">
<label style="cursor: pointer;">
<input type=radio name="posta_goster" value="1" <?php if ($satir['posta_goster'] == 1) echo 'checked="checked"' ?> />
<?php echo $l['evet']; ?></label>&nbsp;&nbsp;
<label style="cursor: pointer;">
<input type="radio" name="posta_goster" value="0" <?php if ($satir['posta_goster'] == 0) echo 'checked="checked"' ?> />
<?php echo $l['hayir']; ?></label>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $l['konum_goster']; ?></td>
	<td class="liste-veri" align="left">
<label style="cursor: pointer;">
<input type="radio" name="sehir_goster" value="1" <?php if ($satir['sehir_goster'] == 1) echo 'checked="checked"' ?> />
<?php echo $l['evet']; ?></label>&nbsp;&nbsp;
<label style="cursor: pointer;">
<input type="radio" name="sehir_goster" value="0" <?php if ($satir['sehir_goster'] == 0) echo 'checked="checked"' ?> />
<?php echo $l['hayir']; ?></label>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $l['cevrimici_goster']; ?></td>
	<td class="liste-veri" align="left">
<label style="cursor: pointer;">
<input type="radio" name="gizli" value="0" <?php if($satir['gizli'] == 0) echo 'checked="checked"' ?> />
<?php echo $l['evet']; ?></label>&nbsp;&nbsp;
<label style="cursor: pointer;">
<input type="radio" name="gizli" value="1" <?php if($satir['gizli'] == 1) echo 'checked="checked"' ?> />
<?php echo $l['hayir']; ?></label>
	</td>
	</tr>


	<tr>
	<td bgcolor="#ececec" align="center" style="color:#555555; border:1px solid #ffffff" colspan="2"><?php echo $l['imza']; ?></td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="center" colspan="2">
<div style="height:5px"></div>
<textarea class="input-text yorum-textarea" cols="66" rows="5" name="imza" onkeyup="imzaUzunluk()" style="width: 520px; height:100px"><?php echo $satir['imza'] ?></textarea>

<div align="left" style="width:527px;">
<div style="height:10px"></div>
<?php echo $imza_bilgi; ?>
<div id="imza_uzunluk"><?php echo $l['karakter_sayisi']; ?>:</div>
<div style="height:5px"></div>
</div>
	</td>
	</tr>


	<tr>
	<td bgcolor="#ececec" align="center" style="color:#555555; border:1px solid #ffffff" colspan="2"><?php echo $l['hakkinda']; ?></td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="center" colspan="2">
<div style="height:5px"></div>
<textarea class="input-text yorum-textarea" cols="66" rows="5" name="hakkinda" onkeyup="hakkindaUzunluk()" style="width: 520px; height:100px"><?php echo $satir['hakkinda'] ?></textarea>

<div align="left" style="width:527px;">
<div style="height:10px"></div>
<?php echo $hakkinda_bilgi; ?>
<div id="hakkinda_uzunluk"><?php echo $l['karakter_sayisi']; ?>:</div>
<div style="height:5px"></div>
</div>

<?php echo $javascript_kodu2; ?>

	</td>
	</tr>

</table>

	<tr>
	<td colspan="2" align="left" class="liste-veri">
<div style="height:5px"></div>
<font size="1"><i>&nbsp;&nbsp; <?php echo $l['isaretli_alanlar_zorunludur']; ?></i></font>
	</td>
	</tr>

	<tr>
	<td class="tablo_ici" height="5"></td>
	</tr>

	<tr>
	<td class="tablo_ici" align="center">
<input class="dugme dugme-mavi" type="submit" value="<?php echo $l['gonder']; ?>" /> &nbsp; &nbsp; 
<input class="dugme dugme-mavi" type="reset" value="<?php echo $l['temizle']; ?>" />
	</td>
	</tr>

	<tr>
	<td class="tablo_ici" height="5"></td>
	</tr>
</table>



</div>
</div>
</div>

</form>

<div style="clear:both;"></div>