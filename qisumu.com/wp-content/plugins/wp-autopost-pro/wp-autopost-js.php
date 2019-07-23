<script type="text/javascript">
jQuery(function($){
   $("h3.hndle").click(function(){$(this).next(".inside").slideToggle('fast');});
});

function addNew(){
  if(document.getElementById("new_config_name").value=='')return;
  document.getElementById("myform").submit();
}

function testFetch(){
  document.getElementById("saction").value='testFetch';
  document.getElementById("myform").submit();
}
function AddRowType1(){
 var TRLastIndex = findObj("Type1TRLastIndex",document);
 var rowID = parseInt(TRLastIndex.value);

 var table = findObj("OptionType1",document);
 
 var newTR = table.insertRow(table.rows.length);
 newTR.id = "type1" + rowID; 

 var newTD1=newTR.insertCell(0);
 newTD1.innerHTML = '<input type="text" name="type1_para1[]" value="" style="width:100%">';
 
 var newTD2=newTR.insertCell(1);
 newTD2.innerHTML = '<input type="text" name="type1_para2[]" value="" style="width:100%">';

 var newTD3=newTR.insertCell(2);
 newTD3.innerHTML = '<input type="button" class="button"  value="<?php echo __('Delete'); ?>"  onclick="deleteRowType1(\'type1'+rowID+'\')"/>';

 TRLastIndex.value = (rowID + 1).toString() ;

}

function deleteRowType1(rowid){
 var table = findObj("OptionType1",document);
 var signItem = findObj(rowid,document);
 var rowIndex = signItem.rowIndex;
 table.deleteRow(rowIndex);
}

function AddRowType2(){
 var TRLastIndex = findObj("Type2TRLastIndex",document);
 var rowID = parseInt(TRLastIndex.value);

 var table = findObj("OptionType2",document);
 
 var newTR = table.insertRow(table.rows.length);
 newTR.id = "type2" + rowID;  

 var newTD1=newTR.insertCell(0);
 newTD1.innerHTML = '<input type="text" name="type2_para1[]" value="">';
 
 var newTD2=newTR.insertCell(1);
 newTD2.innerHTML = '<select name="type2_para2[]" ><option value="0"><?php echo __('No'); ?></option><option value="1" ><?php echo __('Yes'); ?></option></select>';

 var newTD3=newTR.insertCell(2);
 newTD3.innerHTML = '<input type="button" class="button"  value="<?php echo __('Delete'); ?>"  onclick="deleteRowType2(\'type2'+rowID+'\')"/>';
 
 TRLastIndex.value = (rowID + 1).toString() ;

}
function deleteRowType2(rowid){
 var table = findObj("OptionType2",document);
 var signItem = findObj(rowid,document);
 var rowIndex = signItem.rowIndex;
 table.deleteRow(rowIndex);
}

function AddRowType3(){
 var TRLastIndex = findObj("Type3TRLastIndex",document);
 var rowID = parseInt(TRLastIndex.value);

 var table = findObj("OptionType3",document);
 
 var newTR = table.insertRow(table.rows.length);
 newTR.id = "type3" + rowID; 

 var newTD1=newTR.insertCell(0);
 newTD1.innerHTML = '<input type="text" name="type3_para1[]" value="" style="width:100%">';
 
 var newTD2=newTR.insertCell(1);
 newTD2.innerHTML = '<input type="text" name="type3_para2[]" value="" style="width:100%">';

 var newTD3=newTR.insertCell(2);
 newTD3.innerHTML = '<input type="button" class="button"  value="<?php echo __('Delete'); ?>"  onclick="deleteRowType3(\'type3'+rowID+'\')"/>';
 
 TRLastIndex.value = (rowID + 1).toString() ;

}
function deleteRowType3(rowid){
 var table = findObj("OptionType3",document);
 var signItem = findObj(rowid,document);
 var rowIndex = signItem.rowIndex;
 table.deleteRow(rowIndex);
}

function AddRowType4(){
 var TRLastIndex = findObj("Type4TRLastIndex",document);
 var rowID = parseInt(TRLastIndex.value);

 var table = findObj("OptionType4",document);
 
 var newTR = table.insertRow(table.rows.length);
 newTR.id = "type4" + rowID; 

 var newTD1=newTR.insertCell(0);
 newTD1.innerHTML = '<input type="text" name="type4_para1[]" value="" style="width:100%">';
 
 var newTD2=newTR.insertCell(1);
 newTD2.innerHTML = '<input type="text" name="type4_para2[]" value="" style="width:100%">';

 var newTD3=newTR.insertCell(2);
 newTD3.innerHTML = '<input type="button" class="button"  value="<?php echo __('Delete'); ?>"  onclick="deleteRowType4(\'type4'+rowID+'\')"/>';
 
 TRLastIndex.value = (rowID + 1).toString() ;
}

function deleteRowType4(rowid){
 var table = findObj("OptionType4",document);
 var signItem = findObj(rowid,document);
 var rowIndex = signItem.rowIndex;
 table.deleteRow(rowIndex);
}

function AddRowType5(){
 var TRLastIndex = findObj("Type5TRLastIndex",document);
 var rowID = parseInt(TRLastIndex.value);

 var table = findObj("OptionType5",document);
 
 var newTR = table.insertRow(table.rows.length);
 newTR.id = "type5" + rowID; 

 var newTD1=newTR.insertCell(0);
 newTD1.innerHTML = '<input type="text" name="type5_para1[]" value="" style="width:100%" />';
 
 var newTD2=newTR.insertCell(1);
 newTD2.innerHTML = '<input type="text" name="type5_para2[]" value="0" size="1" />';

 var newTD3=newTR.insertCell(2);
 newTD3.innerHTML = '<input type="button" class="button"  value="<?php echo __('Delete'); ?>"  onclick="deleteRowType5(\'type5'+rowID+'\')"/>';
 
 TRLastIndex.value = (rowID + 1).toString() ;
}

function deleteRowType5(rowid){
 var table = findObj("OptionType5",document);
 var signItem = findObj(rowid,document);
 var rowIndex = signItem.rowIndex;
 table.deleteRow(rowIndex);
}

function SaveOption1(){
  document.getElementById("saction6").value='SaveOption1';
  document.getElementById("myform6").submit();
}
function SaveOption5(){
  document.getElementById("saction6").value='SaveOption5';
  document.getElementById("myform6").submit();
}
function SaveOption2(){
  document.getElementById("myform7").submit();
}
function SaveOption3(){
  document.getElementById("myform8").submit();
}
function SaveOption4(){
  document.getElementById("myform9").submit();
}
function SaveConfigOption(){
  document.getElementById("myform11").submit();
}

function edit(){
  if(document.getElementById("config_name").value=='')return;
  document.getElementById("myform1").submit();
}


function save2(){
  if(document.getElementById("source_type").value==0 && document.getElementById("urls").value==''){
	 alert("<?php echo __('Please enter URL!','wp-autopost'); ?>");
	 return;
  }
  if(document.getElementById("source_type").value==1 && document.getElementById("url").value==''){
	 alert("<?php echo __('Please enter URL!','wp-autopost'); ?>");
	 return;
  }
  if(document.getElementById("a_match_type").value==0 && document.getElementById("a_selector_0").value==''){
	 alert("<?php echo __('Please enter Article URL matching rules!','wp-autopost'); ?>");
	 return;
  }
  if(document.getElementById("a_match_type").value==1 && document.getElementById("a_selector_1").value==''){
	 alert("<?php echo __('Please enter Article URL matching rules!','wp-autopost'); ?>");
	 return;
  }
  document.getElementById("myform2").submit();
}
function test2(){
  if(document.getElementById("source_type").value==0 && document.getElementById("urls").value==''){
	 alert("<?php echo __('Please enter URL!','wp-autopost'); ?>");
	 return;
  }
  if(document.getElementById("source_type").value==1 && document.getElementById("url").value==''){
	 alert("<?php echo __('Please enter URL!','wp-autopost'); ?>");
	 return;
  }  
  if(document.getElementById("a_match_type").value==0 && document.getElementById("a_selector_0").value==''){
	 alert("<?php echo __('Please enter Article URL matching rules!','wp-autopost'); ?>");
	 return;
  }
  if(document.getElementById("a_match_type").value==1 && document.getElementById("a_selector_1").value==''){
	 alert("<?php echo __('Please enter Article URL matching rules!','wp-autopost'); ?>");
	 return;
  }
  document.getElementById("saction2").value='test2';
  document.getElementById("myform2").submit();
}
function save3(){
  if(document.getElementById("title_match_type").value==0 && document.getElementById("title_selector_0").value==''){
	 alert("<?php echo __('Please enter The Article Title Matching Rules!','wp-autopost'); ?>");
	 return;
  }
  if(document.getElementById("title_match_type").value==1 && document.getElementById("title_selector_1").value==''){
	 alert("<?php echo __('Please enter The Article Title Matching Rules!','wp-autopost'); ?>");
	 return;
  }
  if(document.getElementById("content_match_type_0").value==0 && document.getElementById("content_selector_0_0").value==''){
	  alert("<?php echo __('Please enter The Article Content Matching Rules!','wp-autopost'); ?>");
	 return;
  }
  if(document.getElementById("content_match_type_0").value==1 && document.getElementById("content_selector_1_0").value==''){
	  alert("<?php echo __('Please enter The Article Content Matching Rules!','wp-autopost'); ?>");
	 return;
  }
  document.getElementById("myform3").submit();
}
function showTest3(){ 
  jQuery("#test3").show();	
}
function test3(){
  if(document.getElementById("testUrl").value==''){
	 alert("<?php echo __('Please enter the URL of test!','wp-autopost'); ?>");
	 return;
  }
  document.getElementById("saction3").value='test3';
  document.getElementById("myform3").submit();
}
function changePostType(){
  document.getElementById("saction1").value='changePostType';
  document.getElementById("myform1").submit(); 
}

function save15(){
  document.getElementById("myform15").submit();
}
function showTestCookie(){ 
  jQuery("#testCookie").show();	
}
function testCookie(){
  if(document.getElementById("testcCookieUrl").value==''){
	 alert("<?php echo __('Please enter the URL of test!','wp-autopost'); ?>");
	 return;
  }
  document.getElementById("saction15").value='testCookie';
  document.getElementById("myform15").submit();
}


jQuery(document).ready(function($){    
	
	$('#published_interval').change(function(){
	    var theValue = $(this).val();
		$("#published_interval_1").val(theValue);
	});

	$('#published_interval_1').change(function(){
	    var theValue = $(this).val();
		$("#published_interval").val(theValue);
	});


	$('#post_scheduled').change(function(){
	    var sSwitch = $(this).val();
		if(sSwitch == 0){
           $("#post_scheduled_more").hide();
		}else{
           $("#post_scheduled_more").show();
		}
	});
	
	$('.charset').change(function(){
	    var sSwitch = $(this).val();
		if(sSwitch == 0){
           $("#ohterSet").hide();
		}else{
           $("#ohterSet").show();
		}
	});
    
	$('#download_img').change(function(){
	    var sSwitch = $(this).val();
		if(sSwitch == 0){
           $("#img_insert_attachment_div").hide();
		}else{
           $("#img_insert_attachment_div").show();
		}
	});

	$('#set_featured_image').change(function(){
	    var sSwitch = $(this).val();
		if(sSwitch == 0){
           $("#set_featured_image_div").hide();
		}else{
           $("#set_featured_image_div").show();
		}
	});

	$('#download_attach').change(function(){
	    var sSwitch = $(this).val();
		if(sSwitch == 0){
           $(".download_attach_option").hide();
		}else{
           $(".download_attach_option").show();
		}
	});

	$('#auto_tags').change(function(){
	    var sSwitch = $(this).val();
		if(sSwitch == 0){
           $("#tags_div").hide();
		}else{
           $("#tags_div").show();
		}
	});

	$('#auto_excerpt').change(function(){
	    var sSwitch = $(this).val();
		if(sSwitch == 0){
           $("#auto_excerpt_div").hide();
		}else{
           $("#auto_excerpt_div").show();
		}
	});


	$('.source_type').change(function(){
	    var sSwitch = $(this).val();
        $("#source_type").val(sSwitch);
		if(sSwitch == 0){
           $("#urlArea1").show();
	       $("#urlArea2").hide();
		}else{
           $("#urlArea2").show();
	       $("#urlArea1").hide();;
		}
	});

	$('.a_match_type').change(function(){
	    var sSwitch = $(this).val();
        $("#a_match_type").val(sSwitch);
		if(sSwitch == 0){
           $("#a_match_0").show();
	       $("#a_match_1").hide();
		}else{
           $("#a_match_1").show();
	       $("#a_match_0").hide();;
		}
	});

	$('.title_match_type').change(function(){
	    var sSwitch = $(this).val();
        $("#title_match_type").val(sSwitch);
		if(sSwitch == 0){
           $("#title_match_0").show();
	       $("#title_match_1").hide();
		}else{
           $("#title_match_1").show();
	       $("#title_match_0").hide();
		}
	});

	$('#fecth_paged').change(function(){
		if(document.getElementById("fecth_paged").checked==true){
          $("#page").show();
		}else{
          $("#page").hide();
		}
	});

	$('.fecth_paged_type').change(function(){
	    var sSwitch = $(this).val();
		if(sSwitch == 0){
           $("#page_match_0").show();
	       $("#page_match_1").hide();
		}else{
           $("#page_match_1").show();
	       $("#page_match_0").hide();;
		}
	});  

	$('#add_source_url').change(function(){
		if(document.getElementById("add_source_url").checked==true){
          $("#source_url_custom_fields").show();
		}else{
          $("#source_url_custom_fields").hide();
		}
	});

	$('#use_rewriter').change(function(){
	    var sSwitch = $(this).val();
		if(sSwitch == 0){
           $("#WordAi").hide();
		   $("#MicrosoftTranslator").hide();
		   $("#SpinRewriter").hide();
		}else if(sSwitch == 1){
           $("#MicrosoftTranslator").show();

		   $("#WordAi").hide();
		   $("#SpinRewriter").hide();
		}else if(sSwitch == 2){
           $("#WordAi").show();

		   $("#MicrosoftTranslator").hide();
		   $("#SpinRewriter").hide();
		}else if(sSwitch == 3){
           $("#SpinRewriter").show();

		   $("#MicrosoftTranslator").hide();
		   $("#WordAi").hide();
		}
	});

	$('#copy_task_id').change(function(){
        var sSwitchValue = $(this).val();
		if(sSwitchValue!=0){
          var sSwitch = $(this).find("option:selected").text();
		  $("#new_config_name").val(sSwitch+'_copy');
		}else{
          $("#new_config_name").val('');
		}
    });

    $('#rewrite_origi_language').change(function(){
        var sSwitch = $(this).find("option:selected").text();
		$("#rewrite_origi_language_span").html(sSwitch);
    });

	$('#rewrite_trans_language').change(function(){
        var sSwitch = $(this).find("option:selected").text();
		$("#rewrite_trans_language_span").html(sSwitch);
    });

	$('#wordai_spinner').change(function(){
	    var sSwitch = $(this).val();
		if(sSwitch == 1){
           
		   $("#standard_quality").show();
		   $("#turing_quality").hide();
           
		   $("#standard_nonested").show();
		   $("#turing_nonested").hide();

		}else if(sSwitch == 2){
           $("#standard_quality").hide();
		   $("#turing_quality").show();

		   $("#standard_nonested").hide();
		   $("#turing_nonested").show();
		}
	});
	


	$('#post_method').change(function(){
	    var sSwitch = $(this).val();
		if(sSwitch == -1){
           $("#translated_cat").hide();
		}else{
           $("#translated_cat").show();
		}
	}); 

});



function addMoreMR(){
 var cmrNum = parseInt(document.getElementById("cmrNum").value);
 
 cmrNum = cmrNum+1;
 document.getElementById("cmrNum").value = cmrNum;

 var TRLastIndex = findObj("cmrTRLastIndex",document);
 var rowID = parseInt(TRLastIndex.value);
 
 var table = findObj("cmr",document);
 var newTR = table.insertRow(table.rows.length);
 newTR.id = "cmr" + rowID;

 var newTD1=newTR.insertCell(0);
 
 newTD1.innerHTML = '<div><input type="hidden" id="content_match_type_'+cmrNum+'" value="0" />'+
	   '<input class="content_match_type_'+cmrNum+'" type="radio" name="content_match_type_'+cmrNum+'" value="0"  checked="true" /><?php echo __("Use CSS Selector","wp-autopost"); ?>&nbsp;&nbsp;&nbsp;'+
	   '<input class="content_match_type_'+cmrNum+'" type="radio" name="content_match_type_'+cmrNum+'" value="1" /><?php echo __("Use Wildcards Match Pattern","wp-autopost"); ?>&nbsp;&nbsp;&nbsp;'+
	   '<input type="checkbox" name="outer_'+cmrNum+'" /> <?php echo __("Contain The Outer HTML Text","wp-autopost"); ?></div>'+ 
	   '<span id="content_match_0_'+cmrNum+'" >'+
       '<?php echo __("CSS Selector","wp-autopost"); ?>: <input type="text" name="content_selector_0_'+cmrNum+'" id="content_selector_0_'+cmrNum+'" size="40" value="">'+     
       ' <span class="clickBold" id="index_'+cmrNum+'"><?php echo __("Index","wp-autopost"); ?></span><span id="index_num_'+cmrNum+'" style="display:none;">: <input type="text" name="index_'+cmrNum+'" size="1" value="0" /><input type="hidden" id="index_show_'+cmrNum+'" value="0" /></span>'+
       ' </span>'+
	   '<span id="content_match_1_'+cmrNum+'"  style="display:none;" ><?php echo __("Matching Rule","wp-autopost"); ?>: <input type="text" name="content_selector_1_'+cmrNum+'" id="content_selector_1_'+cmrNum+'" size="65" value=""> </span>'+
	   '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo __("To: ","wp-autopost"); ?> <select name="objective_'+cmrNum+'" id="objective_'+cmrNum+'" ><option value="0" ><?php echo __('Post Content','wp-autopost'); ?></option><option value="2" ><?php echo __('Post Excerpt','wp-autopost'); ?></option><option value="3" ><?php echo __('Post Tags','wp-autopost'); ?></option><option value="4" ><?php echo __('Featured Image'); ?></option><option value="1" ><?php echo __('Post Date','wp-autopost'); ?></option><option value="-1" ><?php echo __('Custom Fields'); ?></option></select>'+	   
       '<span><input id="objective_customfields_'+cmrNum+'" name="objective_customfields_'+cmrNum+'" style="display:none;" type="text" value="" /></span>'+      
       ' <input type="button" class="button"  value="<?php echo __('Delete'); ?>"  onclick="deleteRowCmr(\'cmr'+rowID+'\')"/>';
 


 TRLastIndex.value = (rowID + 1).toString() ; 
 jQuery(function($){
	$('.content_match_type_'+cmrNum).change(function(){
	    var sSwitch = $(this).val();
        $("#content_match_type_"+cmrNum).val(sSwitch);
		if(sSwitch == 0){
           $("#content_match_0_"+cmrNum).show();
	       $("#content_match_1_"+cmrNum).hide();
		}else{
           $("#content_match_1_"+cmrNum).show();
	       $("#content_match_0_"+cmrNum).hide();;
		}
	});
	
	$('#objective_'+cmrNum).change(function(){
	    var sSwitch = $(this).val();
		if(sSwitch == -1){
           $("#objective_customfields_"+cmrNum).show();
		}else{
           $("#objective_customfields_"+cmrNum).hide();
		}
    });

    $('#index_'+cmrNum).click(function(){
	   var s = $('#index_show_'+cmrNum).val(); 
	   if(s==0){
	     $("#index_num_"+cmrNum).show();
		 $('#index_show_'+cmrNum).val('1');
	   }else{
         $("#index_num_"+cmrNum).hide();
		 $('#index_show_'+cmrNum).val('0');
	   }
    });

 
 });  
}

function deleteRowCmr(rowid){
  var table = findObj("cmr",document);
  var signItem = findObj(rowid,document);
  var rowIndex = signItem.rowIndex;
  table.deleteRow(rowIndex);
}


function AddRowType14(){
 var TRLastIndex = findObj("Type14TRLastIndex",document);
 var rowID = parseInt(TRLastIndex.value);

 var table = findObj("OptionType14",document);
 
 var newTR = table.insertRow(table.rows.length);
 newTR.id = "type14" + rowID;
 

 var newTD1=newTR.insertCell(0);
 newTD1.innerHTML = '<input type="text" name="type14_para1[]" value="" />';

 var newTD1=newTR.insertCell(1);
 newTD1.innerHTML = '<input type="text" name="type14_para2[]" size="1" value="0" />';
 
 var newTD2=newTR.insertCell(2);
 newTD2.innerHTML = '<input type="text" name="type14_para3[]" size="8" value="" />';

 var newTD1=newTR.insertCell(3);
 newTD1.innerHTML = '<input type="text" name="type14_para4[]" size="60" value="" />';

 var newTD3=newTR.insertCell(4);
 newTD3.innerHTML = '<input type="button" class="button"  value="<?php echo __('Delete'); ?>"  onclick="deleteRowType14(\'type14'+rowID+'\')"/>';

 
 TRLastIndex.value = (rowID + 1).toString() ;
}

function deleteRowType14(rowid){
 var table = findObj("OptionType14",document);
 var signItem = findObj(rowid,document);
 var rowIndex = signItem.rowIndex;
 table.deleteRow(rowIndex);
}

function SaveOption14(){
  document.getElementById("myform14").submit();
}


function AddRowType6(){
 var TRLastIndex = findObj("Type6TRLastIndex",document);
 var rowID = parseInt(TRLastIndex.value);

 var table = findObj("OptionType6",document);
 
 var newTR = table.insertRow(table.rows.length);
 newTR.id = "type6" + rowID; 

 var newTD1=newTR.insertCell(0);
 newTD1.innerHTML = 
	 '<?php echo __("HTML Element (Use CSS Selector)","wp-autopost"); ?>:<input type="text" name="type6_para1[]" value="" >&nbsp;&nbsp;&nbsp;'+
     '<?php echo __("Index","wp-autopost"); ?>:<input type="text" name="type6_para2[]" value="1" size="2">&nbsp;&nbsp;&nbsp;'+	  
	 '<select name="type6_para3[]" ><option value="0"><?php echo __("Behind","wp-autopost"); ?></option><option value="1"><?php echo __("Front","wp-autopost"); ?></option></select>&nbsp;&nbsp;&nbsp;'+	  
	 '<table><tr><td><?php echo __("Content","wp-autopost"); ?><br/>(<i>HTML</i>):</td><td><textarea name="type6_para4[]" id="type6_para4[]" cols="102" rows="3"></textarea></td><td><input type="button" class="button"  value="<?php echo __("Delete"); ?>"  onclick="deleteRowType6(\'type6'+rowID+'\')"/></td></tr></table>';
 
 TRLastIndex.value = (rowID + 1).toString() ;
}

function deleteRowType6(rowid){
 var table = findObj("OptionType6",document);
 var signItem = findObj(rowid,document);
 var rowIndex = signItem.rowIndex;
 table.deleteRow(rowIndex);
}

function SaveOption6(){
  document.getElementById("myform10").submit();
}


function DeleteCustomField(key){
  document.getElementById("custom_field_key").value=key;
  document.getElementById("saction12").value='DeleteCustomField'; 
  document.getElementById("myform12").submit();
}
function newCustomField(){
  document.getElementById("saction12").value='newCustomField';
  document.getElementById("myform12").submit();
}

function updateAll(){
  document.getElementById("saction").value='updateAll';
  document.getElementById("myform").submit();
}
function changePerPage(){
  document.getElementById("saction").value='changePerPage';
  document.getElementById("myform").submit();
}
</script>