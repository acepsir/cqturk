<?php
if (!defined('PHPKF_ICINDEN')) exit();
$sceditor_dizin = $duzenleyici_dizin.'phpkf-bilesenler/editor/sceditor';

// HTML için
if ( (isset($duzenleyici_bicim)) AND ($duzenleyici_bicim == 'html') )
{
	$duzenleyici_plugin = 'plugins: "xhtml", format: "xhtml",';
	$duzenleyici_js_ek = '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sceditor/2.1.3/jquery.sceditor.xhtml.min.js"></script>';
}

// BBCode için
else
{
	$duzenleyici_plugin = 'plugins: "bbcode", format: "bbcode",';
	$duzenleyici_js_ek = '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sceditor/2.1.3/jquery.sceditor.bbcode.min.js"></script>';
}
?>

<!--    SCEditor - BAŞI    -->

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sceditor/2.1.3/jquery.sceditor.min.js"></script>
<?php
echo $duzenleyici_js_ek;
if ($site_dili == 'tr') echo '<script type="text/javascript" src="'.$sceditor_dizin.'/languages/tr.js"></script>';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sceditor/2.1.3/themes/default.min.css" type="text/css" media="all" />

<style type="text/css">
.sceditor-button-dyukle div {
background-image:url("<?php echo $duzenleyici_dizin; ?>phpkf-bilesenler/editor/sceditor/dyukle.png");}
</style>

<script type="text/javascript"><!-- //
$(function() {
	// Yükleme düğmesi
	$.sceditor.command.set("dyukle",{
		exec: function(){YuklemeAcKapat("<?php echo $duzenleyici_id; ?>");},
		txtExec: function(){YuklemeAcKapat("<?php echo $duzenleyici_id; ?>");},
		tooltip: editorl["dosya_yukleme"],
	});

	$("#<?php echo $duzenleyici_id; ?>").sceditor({
		width: "626",
		height: "400",
		emoticonsRoot: "https://www.sceditor.com/",
		toolbar: "bold,italic,underline,strike,subscript,superscript|left,center,right,justify|"+
		"font,size,color,removeformat|cut,copy,paste,pastetext|bulletlist,orderedlist,indent,outdent|"+ 
		"table|code,quote|horizontalrule,image,email,link,unlink|"+
		"emoticon,youtube,date,time|ltr,rtl|print,maximize,source,dyukle",
		<?php echo $duzenleyici_plugin; ?>
	});
});


function islem_ifade(deger1,deger2){
	deger2 = " "+deger2+" ";
	$("#<?php echo $duzenleyici_id; ?>").sceditor("instance").insert(deger2);
	return false;
}
//  -->
</script>

<!--    SCEditor - SONU    -->
