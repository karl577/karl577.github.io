<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$__FORMHASH = FORMHASH;$return = <<<EOF

<script type="text/javascript">
var xiaomytitle ="������΢�Ź��ں�����URL";
var btntitle =  "������ȡ";
//���ڻ�ȡ���ݣ������ĵȺ�...
var loadtitle = "�����������ݣ������ĵȺ�...";
var laodfail = "��ȡ����ʧ��";
var laodsucess = "��ȡ���ݳɹ�";
var formhash = "{$__FORMHASH}";
</script>
<link rel="stylesheet" href="source/plugin/xiaomy_getwxarticle/css/xiaomy.css" type="text/css" />
<script src="source/plugin/xiaomy_getwxarticle/js/xiaomy.js" type="text/javascript" type="text/javascript"></script>
<a id="xiaomywechat" title="�ɼ�΢�Ź��ں�����" onClick="openxiaomyDialog('xiaomywechat')" href='javascript:void(0);' >
΢��
</a>

EOF;
?>