document.writeln("<div class=\"moquu_id\" >");
document.writeln("  <div class=\"theme fLeft\">");
document.writeln("<form name=\'form1\' method=\'POST\' action=\'/u/tuyiyi.php\'>");
document.writeln("<input type=\"hidden\" name=\"fmdo\" value=\"login\">");
document.writeln("<input type=\"hidden\" name=\"dopost\" value=\"login\">");
document.writeln("<input type=\"hidden\" name=\"gourl\" value=\"<?php if(!empty($gourl)) echo $gourl;?>\">");
document.writeln("      <p style=\"text-align: right;\" class=\"mB10\"/>");
document.writeln("      <ul>");
document.writeln("        <li><span>用户名：</span>");
document.writeln("          <input class=\"intxt\" id=\"txtUsername\" type=\"text\" name=\"userid\"/><em id=\"_userid\">(禁止使用中文与特殊符号)</em> </li>");
document.writeln("        <li><span>登陆密码：</span>");
document.writeln("          <input id=\"txtPassword\" type=\"password\" name=\"pwd\" class=\"intxt\" /></li>");
document.writeln("        ");
document.writeln("          <li><span>验证码：</span>");
document.writeln("            <input type=\"text\" class=\"intxt\" style=\"width: 200px; text-transform: uppercase;\" id=\"vdcode\" name=\"vdcode\"/><img id=\"vdimgck\" align=\"absmiddle\" onClick=\"this.src=this.src+\'?\'\" style=\"cursor: pointer;\" alt=\"看不清？点击更换\" src=\"../imgId\"/></li>");
document.writeln("        <li style=\" display:none\"><input checked=\"checked\"  type=\"radio\" value=\"2592000\" name=\"keeptime\" id=\"ra1\"/>");
document.writeln("                          <label for=\"ra1\">一月</label>");
document.writeln("                          <input type=\"radio\" value=\"604800\" name=\"keeptime\" id=\"ra2\"/>");
document.writeln("                          <label for=\"ra2\">一周</label>");
document.writeln("                          <input type=\"radio\" value=\"86400\" name=\"keeptime\"  id=\"ra3\"/>");
document.writeln("                          <label for=\"ra3\">一天</label>");
document.writeln("                          <input type=\"radio\" value=\"0\" name=\"keeptime\"  id=\"ra4\"/>");
document.writeln("                          <label for=\"ra4\">即时</label></li>");
document.writeln("        <li style=\"margin-top:30px;\"><span>&nbsp;</span>");
document.writeln("          <button type=\"submit\" id=\"btnSignCheck\" class=\"button\">确认登录</button><a style=\"line-height:40px; margin-left:10px;\" href=\"/u/id\" >注册帐号</a><a style=\"line-height:40px; margin-left:10px;\" href=\"/u/pass\" >忘记密码</a>");
document.writeln("        </li>");
document.writeln("      </ul>");
document.writeln("    </form>");
document.writeln("  </div>");
document.writeln("</div></div>");