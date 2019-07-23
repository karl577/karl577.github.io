<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$ndsvtreturn = <<<EOF

<a href="plugin.php?id=nds_votekick:nds_votekickcp&amp;tid={$_G['tid']}" id="k_votekickt" onclick="showWindow(this.id, this.href, 'get', 0);" onmouseover="this.title ='»¹²î{$votemargin}Æ±'"> <i><img src="static/image/common/recyclebin.gif" alt="ÌßÀ¬»øÌû" />ÌßÀ¬»øÌû<span id="votes" >{$votes}</span>&frasl;<span id="votemax">{$votemax}</span> </i></a>
<script type="text/javascript">
function votekickupdate() {
var obj = $('votes');
obj.innerHTML = parseInt(obj.innerHTML) + 1;
}
</script>
 
EOF;
?>
       