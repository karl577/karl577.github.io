var xmlhttp;
if (window.XMLHttpRequest)
  xmlhttp=new XMLHttpRequest();
else
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

function sc_show (stat, plugin_url, blog_url) {

  document.getElementById("sc_stats_title").innerHTML = '<img src="'+plugin_url+'" title="The stats are loading..." alt="The stats are loading,,," border="0">';
  xmlhttp.onreadystatechange=sc_change_stat;
  xmlhttp.open("GET",blog_url+"/wp-admin/admin-ajax.php?action=scstats&reqstats="+stat,true);
  xmlhttp.send(); 
}

function sc_change_stat () {

  if (xmlhttp.readyState==4 && xmlhttp.status==200) {

     var rt = xmlhttp.responseText;
     var scdata = rt.split('~');
     document.getElementById("sc_stats_title").innerHTML = scdata[0];
     document.getElementById("sc_lds").innerHTML = scdata[1];
     document.getElementById("sc_lws").innerHTML = scdata[2];
     document.getElementById("sc_lms").innerHTML = scdata[3];

  }
}
