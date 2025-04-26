<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();
eval(phpkf_tema_sayfa_baslik());
include_once('menu.php');
?>

<style type="text/css">
.genel-menu ul li ul.dropdown-menu2{
	display:block !important;
}
</style>


<div style="position:absolute;right:27px;top:50px;text-align:left;width:264px; border: 1px solid #000;background:#ededed;z-index:1000;color:#333333">


<div style="border-bottom:1px solid #FFFFFF;clear:both;padding:10px;text-align:center"><b><?php echo $ly['renkler']; ?></b></div>

<form name="renkyolla" action="phpkf-bilesenler/renkuygula.php" method="post">
<?php echo $renk_form; ?>


<div style="float:left;width:110px;height:40px;margin:5px;padding:5px;text-align:left;border:1px solid #ffffff">
<div id="kRenk1">
<b id="renkad1"><?php echo $ly['artalan']; ?></b>
<br>
<input class="jscolor {onFineChange:'RenkVer(this)',mode:'HSV',width:243,height:150,closable:true,closeText:'Kapat'}" type="text" name="renk1" value="<?php echo $renk_artalan1 ?>" style="cursor:pointer;width:100px">
</div></div>

<div style="float:left;width:110px;height:40px;margin:5px;padding:5px;text-align:left;border:1px solid #ffffff">
<div id="kRenk2">
<b id="renkad2"><?php echo $ly['yazi_rengi']; ?></b>
<br>
<input class="jscolor {onFineChange:'RenkVer(this)',mode:'HSV',width:243,height:150,closable:true,closeText:'Kapat'}" type="text" name="renk2" value="<?php echo $renk_anayazi ?>" style="cursor:pointer;width:100px">
</div></div>

<div style="float:left;width:110px;height:40px;margin:5px;padding:5px;text-align:left;border:1px solid #ffffff">
<div id="kRenk3">
<b id="renkad3"><?php echo $ly['link']; ?></b>
<br>
<input class="jscolor {onFineChange:'RenkVer(this)',mode:'HSV',width:243,height:150,closable:true,closeText:'Kapat'}" type="text" name="renk3" value="<?php echo $renk_link ?>" style="cursor:pointer;width:100px">
</div></div>

<div style="float:left;width:110px;height:40px;margin:5px;padding:5px;text-align:left;border:1px solid #ffffff">
<div id="kRenk4">
<b id="renkad4"><?php echo $ly['link_hover']; ?></b>
<br>
<input class="jscolor {onFineChange:'RenkVer(this)',mode:'HSV',width:243,height:150,closable:true,closeText:'Kapat'}" type="text" name="renk4" value="<?php echo $renk_linkhover ?>" style="cursor:pointer;width:100px">
</div></div>



<div class="clear" style="margin:5px;padding:10px;text-align:left;border:1px solid #ffffff">
<center>
<input class="dugme dugme-mavi" type="submit" name="uygula" value="<?php echo $ly['uygula']; ?>" />
</center>
</div>



<div class="clear" style="margin:5px;padding:7px 0;text-align:left;border:1px solid #ffffff">

<div style="width:120px;float:left;margin:3px">
<label style="cursor:pointer"><input type="radio" name="renkk" value="artalan" checked="checked" onclick="RenkAl(this.value)"><?php echo $ly['ana_renkler']; ?></label></div>

<div style="width:120px;float:left;margin:3px">
<label style="cursor:pointer"><input type="radio" name="renkk" value="site-baslik" onclick="RenkAl(this.value)"><?php echo $ly['baslik_alani']; ?></label></div>

<div style="width:120px;float:left;margin:3px">
<label style="cursor:pointer"><input type="radio" name="renkk" value="genel-menu" onclick="RenkAl(this.value)"><?php echo $ly['menu']; ?></label></div>

<div style="width:120px;float:left;margin:3px">
<label style="cursor:pointer"><input type="radio" name="renkk" value="blokkatman" onclick="RenkAl(this.value)"><?php echo $ly['blok_kenar']; ?></label></div>

<div style="width:120px;float:left;margin:3px">
<label style="cursor:pointer"><input type="radio" name="renkk" value="menubag" onclick="RenkAl(this.value)"><?php echo $ly['alt_menu']; ?></label></div>

<div style="width:120px;float:left;margin:3px">
<label style="cursor:pointer"><input type="radio" name="renkk" value="ickatman" onclick="RenkAl(this.value)"><?php echo $ly['blok_ic']; ?></label></div>

<div class="clear"></div>
</div>





<div class="clear" style="margin:5px;padding:10px 7px;text-align:left;border:1px solid #ffffff">
<?php echo $sablonlar ?>
</div>


<div class="clear" style="margin:5px;padding:5px 7px;text-align:left;border:1px solid #ffffff">
<center>
<br>
<input class="input-text" type="text" name="sablon" value="" placeholder="<?php echo $ly['sablon_adi']; ?>" style="width:85%">
<br><br>
<input class="dugme dugme-mavi" type="submit" name="kaydet" value="<?php echo $ly['farkli_kaydet']; ?>">
</center>
</div>


</form>

</div>






<div class="orta-blok">
<div class="phpkf-blok-kutusu" id="phpkf-blok-kutusu">
<div class="kutu-baslik" style="text-align:center"><?php echo $tema_sayfa_baslik; ?></div>
<div class="kutu-icerik kayit-form">


<br><br>
<h1>&nbsp; &nbsp; <?php echo $tema_sayfa_baslik; ?>:</h1>

<div style="text-align:left;padding:10px 0 0 20px;">
<?php echo $ly['tema_renk_degisim_bilgi']; ?>
<br>
<br>
<h2><a href="javascript:void(0)"><?php echo $ly['ornek_baglanti_rengi']; ?></a></h2>
<h2><a href="javascript:void(0)" id="link_ustune"><?php echo $ly['ornek_baglanti_hover_rengi']; ?></a></h2>
</div>

</div>
</div>
</div>



<script type="text/javascript"><!-- //
function getElementsByClassName(classname, node){
if(!node) node = document.getElementsByTagName("body")[0];
else node = document.getElementsByTagName(node)[0];
var a = [];
var re = new RegExp('\\b' + classname + '\\b');
var els = node.getElementsByTagName("*");
for(var i=0,j=els.length; i<j; i++)
if(re.test(els[i].className))a.push(els[i]);
return a;
}


function RenkVer(){
var renk1 = document.renkyolla.renk1.value;
var renk2 = document.renkyolla.renk2.value;
var renk3 = document.renkyolla.renk3.value;
var renk4 = document.renkyolla.renk4.value;
var secenek = document.renkyolla;

for(var i=0; i < secenek.length; i++) if (secenek[i].checked) var katman = secenek[i].value;

if (katman == 'artalan'){
	document.body.style.background = "#"+renk1;

	var katman2 = getElementsByClassName('phpkf-blok-kutusu','body');
	for (i=0;i<katman2.length;i++) katman2[i].style.color = "#"+renk2;

	var katman3 = document.getElementById('phpkf-blok-kutusu').getElementsByTagName('a');
	for (var i = 0; i<katman3.length; i++) katman3[i].style.color = "#"+renk3;

	var katman4 = document.getElementById("link_ustune");
	katman4.style.color = "#"+renk4;

	document.renkyolla.artalan1.value = renk1;
	document.renkyolla.anayazi.value = renk2;
	document.renkyolla.link.value = renk3;
	document.renkyolla.linkhover.value = renk4;
}

else if (katman == 'blokkatman'){
	$(".phpkf-blok-kutusu").css("border-top:2px solid#"+renk1+";border-bottom:2px solid#"+renk2+";border-left:1px solid#"+renk3+";border-right:1px solid#"+renk4);
	document.renkyolla.katmanust.value = renk1;
	document.renkyolla.katmanalt.value = renk2;
	document.renkyolla.katmansol.value = renk3;
	document.renkyolla.katmansag.value = renk4;
}

else if (katman == 'ickatman'){
	$(".phpkf-blok-kutusu").css("background:#"+renk1);
	$(".phpkf-blok-kutusu .kutu-icerik ul.kutu-liste li > a").css("color:#"+renk2);
	$(".kutu-baslik").css("background:#"+renk3+";color:#"+renk4);
	document.renkyolla.ickatman.value = renk1;
	document.renkyolla.bloklink.value = renk2;
	document.renkyolla.blokbaslik.value = renk3;
	document.renkyolla.blokbaslikyazi.value = renk4;
}

else if (katman == 'site-baslik'){
	$("#site-baslik").css("background:#"+renk1);
	$("#baslikyazi").css("color:#"+renk2);
	document.renkyolla.sitebaslik.value = renk1;
	document.renkyolla.baslikyazi.value = renk2;
}

else if (katman == 'genel-menu'){
	$(".genel-menu").css("background:#"+renk1+";border-top:1px solid#"+renk2+";border-bottom:1px solid#"+renk3);
	document.renkyolla.menuler1.value = renk1;
	document.renkyolla.menuler2.value = renk2;
	document.renkyolla.menuler3.value = renk3;
}

else if (katman == 'menubag'){
	$(".dropdown-menu2").css("background:#"+renk1);
	$(".genel-menu ul a").css("color:#"+renk3);
	var katman1 = getElementsByClassName('dropdown-menu2');
	var katman2 = document.getElementById("genel-menu").getElementsByTagName('ul');
	for (a=0;a<katman2.length;a++){
	katman3 = katman2[a].getElementsByTagName('a');
	for (i=0;i<katman3.length;i++) katman3[0].style.background = "#"+renk2;
	}
	document.renkyolla.menubag1.value = renk1;
	document.renkyolla.menubag2.value = renk2;
	document.renkyolla.menubag3.value = renk3;
}


}






function RenkAl(katman){

if (katman == 'artalan'){
document.getElementById('kRenk2').style.display = "inline";
document.getElementById('kRenk3').style.display = "inline";
document.getElementById('kRenk4').style.display = "inline";
document.renkyolla.renk1.value = document.renkyolla.artalan1.value;
document.renkyolla.renk2.value = document.renkyolla.anayazi.value;
document.renkyolla.renk3.value = document.renkyolla.link.value;
document.renkyolla.renk4.value = document.renkyolla.linkhover.value;
document.getElementById('renkad1').innerHTML = '<?php echo $ly['artalan']; ?>';
document.getElementById('renkad2').innerHTML = '<?php echo $ly['yazi_rengi']; ?>';
document.getElementById('renkad3').innerHTML = '<?php echo $ly['link']; ?>';
document.getElementById('renkad4').innerHTML = '<?php echo $ly['link_hover']; ?>';
}

else if (katman == 'blokkatman'){
document.getElementById('kRenk2').style.display = "inline";
document.getElementById('kRenk3').style.display = "inline";
document.getElementById('kRenk4').style.display = "inline";
document.renkyolla.renk1.value = document.renkyolla.katmanust.value;
document.renkyolla.renk2.value = document.renkyolla.katmanalt.value;
document.renkyolla.renk3.value = document.renkyolla.katmansol.value;
document.renkyolla.renk4.value = document.renkyolla.katmansag.value;
document.getElementById('renkad1').innerHTML = '<?php echo $ly['ust_cizgi']; ?>';
document.getElementById('renkad2').innerHTML = '<?php echo $ly['alt_cizgi']; ?>';
document.getElementById('renkad3').innerHTML = '<?php echo $ly['sol_cizgi']; ?>';
document.getElementById('renkad4').innerHTML = '<?php echo $ly['sag_cizgi']; ?>';
}

else if (katman == 'ickatman'){
document.getElementById('kRenk2').style.display = "inline";
document.getElementById('kRenk3').style.display = "inline";
document.getElementById('kRenk4').style.display = "inline";
document.renkyolla.renk1.value = document.renkyolla.ickatman.value;
document.renkyolla.renk2.value = document.renkyolla.bloklink.value;
document.renkyolla.renk3.value = document.renkyolla.blokbaslik.value;
document.renkyolla.renk4.value = document.renkyolla.blokbaslikyazi.value;
document.getElementById('renkad1').innerHTML = '<?php echo $ly['artalan']; ?>';
document.getElementById('renkad2').innerHTML = '<?php echo $ly['link']; ?>';
document.getElementById('renkad3').innerHTML = '<?php echo $ly['baslik']; ?>';
document.getElementById('renkad4').innerHTML = '<?php echo $ly['baslik_yazi']; ?>';
}

else if (katman == 'anayazi'){
document.getElementById('kRenk2').style.display = "none";
document.getElementById('kRenk3').style.display = "none";
document.getElementById('kRenk4').style.display = "none";
document.renkyolla.renk1.value = document.renkyolla.anayazi.value;
document.getElementById('renkad1').innerHTML = '<?php echo $ly['yazi_rengi']; ?>';
document.getElementById('renkad2').innerHTML = '';
document.getElementById('renkad3').innerHTML = '';
document.getElementById('renkad4').innerHTML = '';
}

else if (katman == 'site-baslik'){
document.getElementById('kRenk2').style.display = "inline";
document.getElementById('kRenk3').style.display = "none";
document.getElementById('kRenk4').style.display = "none";
document.renkyolla.renk1.value = document.renkyolla.sitebaslik.value;
document.renkyolla.renk2.value = document.renkyolla.baslikyazi.value;
document.getElementById('renkad1').innerHTML = '<?php echo $ly['artalan']; ?>';
document.getElementById('renkad2').innerHTML = '<?php echo $ly['yazi_rengi']; ?>';
document.getElementById('renkad3').innerHTML = '';
document.getElementById('renkad4').innerHTML = '';
}

else if (katman == 'genel-menu'){
document.getElementById('kRenk2').style.display = "inline";
document.getElementById('kRenk3').style.display = "inline";
document.getElementById('kRenk4').style.display = "none";
document.renkyolla.renk1.value = document.renkyolla.menuler1.value;
document.renkyolla.renk2.value = document.renkyolla.menuler2.value;
document.renkyolla.renk3.value = document.renkyolla.menuler3.value;
document.getElementById('renkad1').innerHTML = '<?php echo $ly['artalan']; ?>';
document.getElementById('renkad2').innerHTML = '<?php echo $ly['ust_cizgi']; ?>';
document.getElementById('renkad3').innerHTML = '<?php echo $ly['alt_cizgi']; ?>';
document.getElementById('renkad4').innerHTML = '';
}

else if (katman == 'menubag'){
document.getElementById('kRenk2').style.display = "inline";
document.getElementById('kRenk3').style.display = "inline";
document.getElementById('kRenk4').style.display = "none";
document.renkyolla.renk1.value = document.renkyolla.menubag1.value;
document.renkyolla.renk2.value = document.renkyolla.menubag2.value;
document.renkyolla.renk3.value = document.renkyolla.menubag3.value;
document.getElementById('renkad1').innerHTML = '<?php echo $ly['artalan']; ?>';
document.getElementById('renkad2').innerHTML = '<?php echo $ly['link_hover']; ?>';
document.getElementById('renkad3').innerHTML = '<?php echo $ly['link']; ?>';
document.getElementById('renkad4').innerHTML = '';
}


document.renkyolla.renk1.focus();
document.renkyolla.renk1.blur();
document.renkyolla.renk2.focus();
document.renkyolla.renk2.blur();
document.renkyolla.renk3.focus();
document.renkyolla.renk3.blur();
document.renkyolla.renk4.focus();
document.renkyolla.renk4.blur();
}



// link üstüne gidince aldığı renk sayfa yüklendikten sonra id link_ustune katmanına atanıyor
var katman2 = document.getElementById("link_ustune");
katman2.style.color = "#"+document.renkyolla.linkhover.value;

var katman1 = getElementsByClassName('dropdown-menu2');
var katman3 = document.getElementById("genel-menu").getElementsByTagName('ul');
for (a=0;a<katman3.length;a++){
	katman2 = katman3[a].getElementsByTagName('a');
	for (i=0;i<katman2.length;i++) katman2[0].style.background = "#"+document.renkyolla.menubag2.value;
}

document.renkyolla.renkk[0].checked="checked";

RenkAl("artalan");

</script>

<script type="text/javascript" src="../phpkf-bilesenler/eklentiler/jscolor_eklentisi/jscolor.js"></script>
