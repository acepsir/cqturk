<?php
if (!defined('PHPKF_ICINDEN')) exit();

if ($duzenleyici_bicim == 'bbcode') $duzenleyici_plugin = "extraPlugins: 'bbcode',";
else $duzenleyici_plugin = '';
?>

<!--    CKEditor - BAŞI    -->

<script src="https://cdn.ckeditor.com/4.12.1/full-all/ckeditor.js"></script>

<script type="text/javascript"><!-- //
ckeditor = CKEDITOR.replace(
	duzenleyici_id,
	{
		<?php echo $duzenleyici_plugin; ?>
		width:'',
		height:'350px',
	}
);

CKEDITOR.disableAutoInline = true;

ckeditor.addCommand("dyukle", {
	exec: function(edt) {
		YuklemeAcKapat("<?php echo $duzenleyici_id; ?>");
	}
});

ckeditor.ui.addButton('SuperButton', {
	command: 'dyukle',
	toolbar: 'insert',
	label: editorl["dosya_yukleme"],
	icon: '<?php echo $anadizin; ?>phpkf-bilesenler/editor/ckeditor/dyukle.png'
});

function islem_ifade(deger1,deger2){
	deger2 = "&nbsp;"+deger2+"&nbsp;";
	var oEditor = CKEDITOR.instances.mesaj_icerik;
	oEditor.insertHtml(deger2);
	if(document.form1.ifade.checked==false)document.form1.ifade.checked=true;
	return false;
}
// -->
</script>

<!--    CKEditor - SONU    -->