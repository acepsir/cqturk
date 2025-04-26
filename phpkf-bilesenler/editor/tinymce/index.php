<?php
if (!defined('PHPKF_ICINDEN')) exit();

if (!isset($tinymce_dizin)) echo '<script src="'.$ayarlar['tinymce_dosya'].'"></script>';

$tinymce_dizin = $anadizin.$ayarlar['tinymce_dizin'];
$eklentiler_dizin = $anadizin.'phpkf-bilesenler/eklentiler';

// BBCode için
if ($duzenleyici_bicim == 'bbcode')
	$ayarlar['tinymce_plugins'] = '"bbcode '.substr($ayarlar['tinymce_plugins'],1);
?>

<!--    TinyMCE - BAŞI    -->

<script type="text/javascript"><!-- //
var tinymce_dizin = "<?php echo $tinymce_dizin; ?>";
var eklentiler_dizin = "<?php echo $eklentiler_dizin; ?>";

// harici fonksiyonlar
<?php echo $ayarlar['tinymce_harici']."\r\n".$ayarlar['tinymce_harici_plugins']; ?>


tinyMCE.init({
// Dil dosyası
<?php
if ($ayarlar['tinymce_language'] == ''){
if ($site_dili == 'en');
elseif ($site_dili == 'tr') echo 'language:"tr_TR",language_url:tinymce_dizin+"/langs/tr_TR.js",';
elseif ($site_dili == 'az') echo 'language:"az",language_url:tinymce_dizin+"/langs/az.js",';
else{
if ($site_dili=='hr') $tinymce_lang = 'he_IL';
elseif ($site_dili=='ko') $tinymce_lang = 'ko_KR';
elseif ($site_dili=='pt') $tinymce_lang = 'pt_PT';
elseif (($site_dili=='fr')OR($site_dili=='hu')OR($site_dili=='th')) $tinymce_lang = $site_dili.'_'.strtoupper($site_dili);
else $tinymce_lang = $site_dili;
echo 'language:"'.$tinymce_lang.'",language_url:"https://olli-suutari.github.io/tinyMCE-4-translations/'.$tinymce_lang.'.js",';
}}
else{if ($site_dili != 'en') echo $ayarlar['tinymce_language'];}
?>


// Genel Ayarlar
<?php echo $ayarlar['tinymce_init']; ?>


// Düğmeler
toolbar1: "<?php echo $ayarlar['tinymce_toolbar']; ?>",


// Eklentiler
plugins: [
<?php echo $ayarlar['tinymce_plugins']; ?>
],


// Dahili Fonksiyonlar
setup: function(ed) {
<?php echo $ayarlar['tinymce_dahili']; ?>
},


// Biçimler Menüsü
style_formats: [
<?php echo $ayarlar['tinymce_style']; ?>
],


// Başlık ve Paragraf
block_formats: "Paragraph=p;Header 1=h1;Header 2=h2;Header 3=h3;Header 4=h4;Header 5=h5",

});

function islem_ifade(deger1,deger2){
	deger2 = "&nbsp;"+deger2+"&nbsp;";
	tinyMCE.activeEditor.selection.setContent(deger2);
	return false;
}
// -->
</script>

<!--    TinyMCE - SONU    -->
