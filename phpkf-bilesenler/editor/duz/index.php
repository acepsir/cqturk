<?php if (!defined('PHPKF_ICINDEN')) exit(); ?>
<div id="<?php echo $duzenleyici_id; ?>_div" style="display:none"></div>
<div style="clear:both"></div>

<script type="text/javascript"><!-- //
function islem_ifade(deger1,deger2){
if(document.form1){if(document.form1.ifade.checked==false)document.form1.ifade.checked=true;}
document.getElementById(duzenleyici_id).value+=" "+deger2+" ";
document.getElementById(duzenleyici_id).focus();
return false;
}
// -->
</script>