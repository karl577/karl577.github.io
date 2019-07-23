<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="<%plugin_path%>/template/libs/mwt/3.2/mwt.min.css"/>
  <style>
  input[type='text'] {background:#fff;}
  </style>
  <script src="<%plugin_path%>/template/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="<%plugin_path%>/template/libs/requirejs/2.1.9/require.js"></script>
  <%js_script%>
  <script>
    var jq=jQuery.noConflict();
    jq(document).ready(function($) {
        require.config({
            baseUrl: "<%plugin_path%>/template/views/src/",
            packages: [
                {name:'mwt', location:'<%plugin_path%>/template/libs/mwt/3.2', main:'mwt.min'}
            ]
        });
        require(["wxmember/page","mwt"],function(mainpage){
            mainpage.execute(); 
        });
    });
  </script>
<!-- qisumu.com Baidu tongji analytics -->
<script>
var _hmt = _hmt || [];
(function() {
var hm = document.createElement("script");
hm.src = "https://hm.baidu.com/hm.js?cd8191d648355b940efdb3f1ba7fb3a0";
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(hm, s);
})();
</script>
</head>
<body>
  <div id="bar-div" style="margin-bottom:10px;"></div>
  <div id="grid-div"></div>
</body>
</html>
