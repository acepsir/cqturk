<?php
/*
 +-=========================================================================-+
 |                              phpKF Forum v3.00                            |
 +---------------------------------------------------------------------------+
 |                  Telif - Copyright (c) 2007 - 2019 phpKF                  |
 |                    www.phpKF.com   -   phpKF@phpKF.com                    |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkarma ve satma hakları sadece phpKF`ye aittir. |
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  phpKF.com/telif.php  adresini ziyaret edin. |
 +-=========================================================================-+*/


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');

$dosya_adi = 'ozel_izinler.php';


// Simgeler
$duzenle_simge = '<img src="phpkf-bilesenler/temalar/varsayilan/resimler/duzenle.png" width="16" height="16" alt="d" style="margin-left:5px; margin-right:5px" title="'.$ly['degistir'].'" />';



if (empty($_GET['sayfa'])) $_GET['sayfa'] = 0;
else $_GET['sayfa'] = @zkTemizle($_GET['sayfa']);

if (empty($_GET['kul_ara'])) $_GET['kul_ara'] = '%';
else
{
	$_GET['kul_ara'] = @zkTemizle(trim($_GET['kul_ara']));
	$_GET['kul_ara'] = @str_replace('*','%',$_GET['kul_ara']);
}



// Forum adları alınıyor
$vtsorgu = "SELECT id,forum_baslik FROM $tablo_forumlar ORDER BY id";
$forumlar_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

while ($forumlar_satir = $vt->fetch_assoc($forumlar_sonuc))
{
	$fid = $forumlar_satir['id'];
	$forum_baslik[$fid] = $forumlar_satir['forum_baslik'];
}



// SORGU SONUCUNDAKİ TOPLAM SONUÇ SAYISI ALINIYOR

$vtsonuc9 = $vt->query("SELECT kulid FROM $tablo_ozel_izinler WHERE kulad LIKE '$_GET[kul_ara]%'") or die ($vt->hata_ver());
$satir_sayi = $vt->num_rows($vtsonuc9);


$ozelizinler_kota = 30;

$toplam_sayfa = ($satir_sayi / $ozelizinler_kota);
settype($toplam_sayfa,'integer');

if (($satir_sayi % $ozelizinler_kota) != 0) $toplam_sayfa++;



//	ÖZEL İZİNLİ KULLANICILARIN BİLGİLERİ ÇEKİLİYOR	//

if ((isset($_GET['sirala'])) AND ($_GET['sirala'] == 'fnoters'))
{
	$vtsorgu = "SELECT * FROM $tablo_ozel_izinler WHERE kulad LIKE '$_GET[kul_ara]%' ORDER BY fno DESC LIMIT $_GET[sayfa],$ozelizinler_kota";
}

elseif ((isset($_GET['sirala'])) AND ($_GET['sirala'] == 'ad_AdanZye'))
{
	$vtsorgu = "SELECT * FROM $tablo_ozel_izinler WHERE kulad LIKE '$_GET[kul_ara]%' ORDER BY kulad LIMIT $_GET[sayfa],$ozelizinler_kota";
}

elseif ((isset($_GET['sirala'])) AND ($_GET['sirala'] == 'ad_ZdenAya'))
{
	$vtsorgu = "SELECT * FROM $tablo_ozel_izinler WHERE kulad LIKE '$_GET[kul_ara]%' ORDER BY kulad DESC LIMIT $_GET[sayfa],$ozelizinler_kota";
}

elseif ((isset($_GET['sirala'])) AND ($_GET['sirala'] == 'izinegore'))
{
	$vtsorgu = "SELECT * FROM $tablo_ozel_izinler WHERE kulad LIKE '$_GET[kul_ara]%' ORDER BY yonetme DESC, fno LIMIT $_GET[sayfa],$ozelizinler_kota";
}

elseif ((isset($_GET['sirala'])) AND ($_GET['sirala'] == 'grup'))
{
	$vtsorgu = "SELECT * FROM $tablo_ozel_izinler WHERE kulad LIKE '$_GET[kul_ara]%' ORDER BY grup DESC, fno LIMIT $_GET[sayfa],$ozelizinler_kota";
}

else
{
	$vtsorgu = "SELECT * FROM $tablo_ozel_izinler WHERE kulad LIKE '$_GET[kul_ara]%' ORDER BY fno LIMIT $_GET[sayfa],$ozelizinler_kota";
	$_GET['sirala'] = '';
}

$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());




$kul_ara = str_replace('%','*',$_GET['kul_ara']);


$tema_sayfa_icerik = '
<form action="'.$dosya_adi.'" name="kul_ara" method="get">

<table cellspacing="10" width="100%" cellpadding="0" border="0" align="center" class="tablo_ici">
	<tr>
	<td class="liste-veri" valign="bottom" height="35" align="left">
<input class="input-text" type="text" name="kul_ara" size="20" maxlength="20" value="'.$kul_ara.'" />
&nbsp;<input type="submit" value="Ara" class="dugme dugme-mavi" />
	</td>
	<td class="liste-veri" valign="bottom" align="right">
<select name="sirala" class="input-select">
<option value="1">Forum Sırasına göre</option>
<option value="fnoters"'.(((isset($_GET['sirala']))AND($_GET['sirala'] == 'fnoters'))?' selected="selected"':'').'>Forum Sırasına göre tersten</option>
<option value="ad_AdanZye"'.(((isset($_GET['sirala']))AND($_GET['sirala'] == 'ad_AdanZye'))?' selected="selected"':'').'Kullanıcı adına göre A\'dan Z\'ye</option>
<option value="ad_ZdenAya"'.(((isset($_GET['sirala']))AND($_GET['sirala'] == 'ad_ZdenAya'))?' selected="selected"':'').'Kullanıcı adına göre Z\'den A\'ya</option>
<option value="izinegore"'.(((isset($_GET['sirala']))AND($_GET['sirala'] == 'izinegore'))?' selected="selected"':'').'Yetkisine göre(Yardımcılar önde)</option>
<option value="grup"'.(((isset($_GET['sirala']))AND($_GET['sirala'] == 'grup'))?' selected="selected"':'').'Gruplar önde</option>
</select>
&nbsp;<input type="submit" value="üyeleri sırala" class="dugme dugme-mavi" />
	</td>
	</tr>
	
	<tr>
	<td colspan="2">


<table cellspacing="1" width="100%" cellpadding="8" border="0" align="center" class="tablo-ana" style="margin-top:10px">
	<tr class="tablo-baslik">
	<td align="center" width="30">&nbsp;</td>
	<td align="center">Üye veya Grup Adı</td>
	<td align="center" width="220">Forum Adı</td>
	<td align="center" width="45">Okuma</td>
	<td align="center" width="45">Konu</td>
	<td align="center" width="45">Cevap</td>
	<td align="center" width="50">Yönetme</td>
	</tr>';




if ($satir_sayi == 0)
{
$tema_sayfa_icerik .= '<tr class="tablo-satir">
<td colspan="9" align="center" height="70" valign="center">
Aradığınız koşula uyan özel izinli üye yok !
</td>
</tr>';
}


while ($ozelizinler_satir = $vt->fetch_array($vtsonuc2))
{
	$tema_sayfa_icerik .= '<tr class="tablo-satir">';


	if ($ozelizinler_satir['grup'] == 0)
	$tema_sayfa_icerik .= '<td align="center">
	<a href="uye_degistir.php?u='.$ozelizinler_satir['kulid'].'" title="Kullanıcı profilini değiştir">'.$duzenle_simge.'</a>
	</td>

	<td align="left" title="Kullanıcı yetkilerini değiştir"><b>Üye:</b>
&nbsp;&nbsp;<a href="forum_uye_izinleri.php?kim='.$ozelizinler_satir['kulad'].'">'.$ozelizinler_satir['kulad'].'</a>';


	else $tema_sayfa_icerik .= '<td align="center" width="30">
	<a href="uye_gruplar.php?duzenle='.$ozelizinler_satir['grup'].'#duzenle" title="Grubu Düzenle">'.$duzenle_simge.'</a>
	</td>

	<td align="left" title="Grup yetkilerini değiştir"><b>Grup:</b>
&nbsp;<a href="forum_uye_izinleri.php?grup='.$ozelizinler_satir['grup'].'">'.$ozelizinler_satir['kulad'].'</a>';


	$tema_sayfa_icerik .= '</td>
	<td align="left"><a href="../forum.php?f='.$ozelizinler_satir['fno'].'">'.$forum_baslik[$ozelizinler_satir['fno']].'</a>
	</td>
	<td align="center">'.(($ozelizinler_satir['okuma']==0)?'var':'<b>yok</b>').'</td>
	<td align="center">'.(($ozelizinler_satir['konu_acma']==1)?'var':'<b>yok</b>').'</td>
	<td align="center">'.(($ozelizinler_satir['yazma']==0)?'var':'<b>yok</b>').'</td>
	<td align="center">'.(($ozelizinler_satir['yonetme']==0)?'var':'<b>yok</b>').'</td>
	</tr>';
}


$tema_sayfa_icerik .= '
</table>
<br>';





$tema_sayfa_icerik .= '<span id="sayfalama">';

if ($satir_sayi > $ozelizinler_kota):

$tema_sayfa_icerik .= '
<table cellspacing="1" cellpadding="2" border="0" align="right" class="tablo_border">
	<tr>
	<td class="forum_baslik">
Toplam '.$toplam_sayfa.' Sayfa:&nbsp;
	</td>';

if ($_GET['sayfa'] != 0)
{
	$tema_sayfa_icerik .= '<td bgcolor="#ffffff" class="liste-veri" title="ilk sayfaya git">';
	$tema_sayfa_icerik .= '&nbsp;<a href="'.$dosya_adi.'?sayfa=0&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">&laquo;ilk</a>&nbsp;</td>';

	$tema_sayfa_icerik .= '<td bgcolor="#ffffff" class="liste-veri" title="önceki sayfaya git">';
	$tema_sayfa_icerik .= '&nbsp;<a href="'.$dosya_adi.'?sayfa='.($_GET['sayfa'] - $ozelizinler_kota).'&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">&lt;</a>&nbsp;</td>';
}

for ($sayi=0,$sayfa_sinir=$_GET['sayfa']; $sayi < $toplam_sayfa; $sayi++)
{
	if ($sayi < (($_GET['sayfa'] / $ozelizinler_kota) - 3));
	else
	{
		$sayfa_sinir++;
		if ($sayfa_sinir >= ($_GET['sayfa'] + 8)) {break;}
		if (($sayi == 0) and ($_GET['sayfa'] == 0))
		{
			$tema_sayfa_icerik .= '<td bgcolor="#ffffff" class="liste-veri" title="Şu an bulunduğunuz sayfa">';
			$tema_sayfa_icerik .= '&nbsp;<b>[1]</b>&nbsp;</td>';
		}

		elseif (($sayi + 1) == (($_GET['sayfa'] / $ozelizinler_kota) + 1))
		{
			$tema_sayfa_icerik .= '<td bgcolor="#ffffff" class="liste-veri" title="Şu an bulunduğunuz sayfa">';
			$tema_sayfa_icerik .= '&nbsp;<b>['.($sayi + 1).']</b>&nbsp;</td>';
		}

		else
		{
			$tema_sayfa_icerik .= '<td bgcolor="#ffffff" class="liste-veri" title="'.($sayi + 1).' numaralı sayfaya git">';

			$tema_sayfa_icerik .= '&nbsp;<a href="'.$dosya_adi.'?sayfa='.($sayi * $ozelizinler_kota).'&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">'.($sayi + 1).'</a>&nbsp;</td>';
		}
	}
}
if ($_GET['sayfa'] < ($satir_sayi - $ozelizinler_kota))
{
	$tema_sayfa_icerik .= '<td bgcolor="#ffffff" class="liste-veri" title="sonraki sayfaya git">';
	$tema_sayfa_icerik .= '&nbsp;<a href="'.$dosya_adi.'?sayfa='.($_GET['sayfa'] + $ozelizinler_kota).'&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">&gt;</a>&nbsp;</td>';

	$tema_sayfa_icerik .= '<td bgcolor="#ffffff" class="liste-veri" title="son sayfaya git">';
	$tema_sayfa_icerik .= '&nbsp;<a href="'.$dosya_adi.'?sayfa='.(($toplam_sayfa - 1) * $ozelizinler_kota).'&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">son&raquo;</a>&nbsp;</td>';
}

$tema_sayfa_icerik .= '</tr>
</table>';

endif;

$tema_sayfa_icerik .= '</span>';





$tema_sayfa_icerik .= '
<div class="liste-veri" align="left"><font size="1">
Aradığınız koşula uyan özel izinli üye ve grup sayısı: <b><?php echo $satir_sayi ?></b>
<br>Yönetme yetkisi verilen üye o bölümün yardımcısı olur.
</font></div>


</td></tr></table>
</form>';


// tema dosyası yükleniyor
$sayfa_adi = $ly['ozel_izinler'];
$tema_sayfa_baslik = $ly['ozel_izinler'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>