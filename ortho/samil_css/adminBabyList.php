<? 
header("Progma:no-cache") ; 
header("Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0");


include_once("../samil_include/lib.php");

$smb_id = $_SESSION['ss_mb_id'];
$smb_num = $_SESSION['ss_mb_num'];
$smb_name = $_SESSION['ss_mb_name'];
$smb_level = $_SESSION['ss_mb_level'];
$smb_state = $_SESSION['ss_mb_state'];

if(!$smb_id) {
	rg_href("http://www.samilchurch.com");
}


$ss_1   = $_POST['ss_1'];
$ss_kw   = $_POST['kw'];
$order   = $_GET['order'];

if($order == "") $order = "ASC";
$porder = $order;

$rs_list->clear();
$rs_list->set_table($_table['samilchildbapti']);
$rs_list->add_where("c_code='2016'");
switch ($ss_1) {
	case '1' : $rs_list->add_where("c_name LIKE '%$ss_kw%' "); break;
	case '2' : $rs_list->add_where("c_fname LIKE '%$ss_kw%' "); break;
	case '3' : $rs_list->add_where("c_mname LIKE '%$ss_kw%' "); break;
	case '4' : $rs_list->add_where("c_fphone LIKE '%$ss_kw%' "); break;
	case '7' : $rs_list->add_where("c_femail LIKE '%$ss_kw%' "); break;
}

if($order == "ASC"){
	$rs_list->add_order("c_num ASC");
	$order = "DESC";
	$orderImg = "▲";
} else if($order == "DESC"){
	$rs_list->add_order("c_num DESC");
	$order = "ASC";
	$orderImg = "▼";
}


$rs_list->select();
$page_info=$rs_list->select_list($page,20,10);


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>:::: 삼일교회 ::::</title>
<link rel="stylesheet" type="text/css" href="/samil_admin/css/style.css">
<script src="/samil_js/common.js"></script>
<script src="/samil_js/lib.validate.js"></script>
<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>


	function clickLayer(vals){
		var urlX =""+vals
		var widthX = 500;
		var heightX = 300;
		var titleX ="패스워드 수정";


		//document.getElementById("c_date").value = vals;

		document.getElementById("mb_pass").value = "";
		document.getElementById("mb_pass1").value = "";
		//document.getElementById("c_gubun2").value = "";
		//document.getElementById("c_sche1").value = "";
		//document.getElementById("c_sche2").value = "";


		//$("#btnview").hide();
		
		$('#layerPop').load(urlX).dialog({
			autoOpen: true,
			modal:true,
			width:widthX,
			maxWidth:widthX,
			maxHeight:heightX,
			resizable:true,
			title:titleX,
			open: function() {
			$(this).css({
			'overflow-x':'hidden',
			'overflow-y':'auto',
			});
			}
		});
	}

	function schChek(){

		var mb_pass =  document.getElementById("mb_pass").value;
		var mb_pass1 =  document.getElementById("mb_pass1").value;
		//var mb_state =  document.getElementById("mb_state").value;

		if(mb_pass == "" || mb_pass1 == "") {
			alert('내용이 입력하세요.');
			return ;
		}
		
		if(mb_pass != mb_pass1) {
			alert('암호입력된 내용이 일치하지 않습니다.');
			return ;
		}

		
//		alert('c_gubun=='+c_gubun);
		

		var date = {
				c_code : "U" ,
				mb_id : "<?=$smb_id?>" ,
				mb_pass : mb_pass
			};
			$.ajax({
				type: 'POST',
				url: "memberEProc.php",
				dataType: 'json',
				data: date, 
				cache: false,
				contentType: 'application/x-www-form-urlencoded;charset='+'UTF-8',
				success: function(json) {

					var code  = json[1].code;
					alert(code);
					
					$("#layerPop").dialog("close"); 
						
				}, error: function(request, status, error){
					alert("Error..!!");
					return ;
				}
			});

		
	}



	// 회원아이디 목록창
	function member_list_popup(url_path,form_info)
	{
		// 다중선택여부|폼네임|key필드명|값받을폼이름|표시될폼이름|표시형식$mb_id($mb_name)
		window_open(url_path+'member_list_popup.php?form_info='+form_info,'member_list_popup','scrollbars=yes,width=600,height=600');
	}

	function member_del(){
		if(!chk_checkbox(list_form,'chk_nums[]',true)){
			alert('한명이상 선택 하세요.');
			return;
		}
	}	

	function goSubmit(){
		//if(document.getElementById("ss_1").value == ""){
		//	alert("선택하세요..");
		//	document.getElementById("ss_1").focus();
		//	return false;
		//}
	}

</script>
</head>
<body>

<div id="layerPop" style="display:none;">
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_content">
<input type="hidden" name="c_date" id="c_date"/>
<input type="hidden" name="c_num" id="c_num"/>
<input type="hidden" name="c_code" id="c_code"/>
	<tr>
		<td width="100" align="center" bgcolor="#F0F0F4"><strong>비밀번호</strong></td>
		<td><input name="mb_pass" type="password" id="mb_pass" type="text" value="" size="20" maxlength="20" class="input">&nbsp;&nbsp;<strong>암호확인</strong><input type="password" class="input" name="mb_pass1" id="mb_pass1"  size="20" hname="암호확인">
      <BR>4자 이상 12이하로 입력해주세요. </td>
	</tr>
	<!--
	<tr>
		<td width="100" align="center" bgcolor="#F0F0F4"><strong>사용부서</strong></td>
		<td><select name="mb_state" id="mb_state"  hname="암호확인" class="input">
			<option value="">선택하세요</option>
			<option value="1">유아세례</option>
			<option value="2">대청부_제자훈련원(성장반,제자반,사역반)</option>
			<option value="3">청장년_제자훈련원(성장반,제자반,사역반)</option>
			<option value="6">결혼예비학교</option>
			<option value="7">태아부모학교</option>
			<option value="8">삼일기세관아카데미(입문과정)</option>
			<option value="9">삼일기세관아카데미(심화과정)</option>
			<option value="10">중보기도학교</option>
			<option value="11">큐티(Q.T)학교</option>
			<option value="0">기타</option>
		</select>
		</td>
	</tr>
	-->
</table>
<BR>
<table width="250" border="0" align="center">
	<tr>
		<td align="center">
			<input type="button" value=" 수   정 " onClick="javascript:schChek()" class="button">&nbsp;
		</td>
	</tr>
</table>

</div>



<a name=top></a>
<!-- Begin Wrapper -->
<div id="wrapper">
	<!-- Begin Header -->
	<div id="header">
		
		<div id="headerlogo">
			<div id="headerlogoimg">
				<div><a href="../main/index.php"><img src="../images/samil_logo.JPG"  /></a></div>
			</div>
		</div>
		<div id="headeruser">
			<div id="headerusera1">
			<div id="headeruserinfo">
				<div>
<input type="button" value=" 패스워드변경 " onclick="javascript:clickLayer();" class="button">&nbsp;&nbsp;<input type="button" value=" 로그아웃 " onclick="location.href='login.php?logout'" class="button">
			<br>	<br>	
			접속자 : <?=$smb_name?>(<?=$smb_id?>)
			</div>
			</div>
			</div>
		</div>
		
		<div style="clear:both"></div>
		<ul>
			<li ><H1><font color="white">유아세례 신청자 확인 Admin</font></H1></li>
		</ul>	 
	</div>

 <!-- End Header -->
<div id="mainindex">
<div style="margin:0 auto;width:100%">



<table border="0" cellspacing="0" cellpadding="0" width="100%" class="site_content">
  <tr>
    <td bgcolor="#F7F7F7">삼일교회 > 유아세례신청자</td>
  </tr>
</table>
<br>
<table width="100%" cellspacing="0" style="border-collapse:collapse;table-layout:auto">
<form name="search_form" method="post" onSubmit="return goSubmit()" enctype="multipart/form-data">
	<tr> 
		<td>
검색: <select name="ss_1">
<option value="">선택하세요</option>
<option value="1">아기이름</option>
<option value="2">아버지이름</option>
<option value="3">어머니이름</option>
<option value="4">연락처</option>
<option value="7">이메일</option>
			</select>
			<input name="kw" type="text" id="kw" value="" size="14" class="input"> <input type="submit" name="검색" value="검색" class="button"> 
		</td>
		<td align="right"> <input type="button" value=" 전체액셀출력 " onclick="location.href='adminChildExcel.php'" class="button"> &nbsp;&nbsp;&nbsp; 
		Total : 
			<?=$page_info['total_rows']?>
			(<?=$page_info['page']?>/<?=$page_info['total_page']?>)</td>
    </tr>
</form>
</table>
<br>
<form name="list_form" method="post" enctype="multipart/form-data" action="?">
<input name="mode" type="hidden" value="">
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_list" onmouseover="list_over_color(event,'#FFE6E6',1)" onmouseout='list_out_color(event)'>
	<tr align="center" bgcolor="#F0F0F4">
		<td width="20"><input type="checkbox" onClick="set_checkbox(list_form,'chk_nums[]',this.checked)" class="none"></td>
		<!-- <td width="30" >수정</td>  -->
		<td width="30" >삭제</td>
		<td width="40"><B><a href="adminChildList.php?page=<?=$page?>&order=<?=$order?>"><?=$orderImg?>번호</a></B></td>
		<td>아기이름(성별)</td>
		<td>아기이름뜻</td>
		<td>유아<br>생년월일</td>
		<td>아버지<br>이름</td>
		<td>아버지소속</td>
		<td>아버지 연락처</td>
		<td>아버지 이메일</td>
		<td>아버지<BR>세례여부</td>
		<td>아버지<BR>새가족<BR>등록여부</td>
		<td>어머니<br>이름</td>
		<td>어머니 소속</td>
		<td>어머니 연락처</td>
		<td>어머니 이메일</td>
		<td>어머니<BR>세례여부</td>
		<td>어머니<BR>새가족<BR>등록여부</td>
		<td>신청일</td>
	</tr>
<?
if($rs_list->num_rows()>0) {
	while($R=$rs_list->fetch()) {
		$c_num   = $R['c_num'];
		$c_name   = $R['c_name'];
		$c_sex    = $R['c_sex'];
		$c_name2  = $R['c_name2'];
		$c_birth  = $R['c_birth'];
		$c_fname  = $R['c_fname'];
		$c_fsosok = $R['c_fsosok'];
		$c_fphone = $R['c_fphone'];
		$c_femail = $R['c_femail'];
		$c_fbapti = $R['c_fbapti'];
		$c_fnewm  = $R['c_fnewm'];
		$c_mname  = $R['c_mname'];
		$c_msosok = $R['c_msosok'];
		$c_mphone = $R['c_mphone'];
		$c_memail = $R['c_memail'];
		$c_mbapti = $R['c_mbapti'];
		$c_mnewm  = $R['c_mnewm'];
		$c_etc    = $R['c_etc'];
		$c_date    = $R['c_date'];		
?>		

	<tr height="25">
		<td align="center"><input type=checkbox name="chk_nums[]" value="3" class=none></td>
		<!-- <td align="center"><a href="member_edit.php?&page=1&mode=modify&num=3">수정</a></td> -->
		<td align="center"><a href="#" onClick="confirm_del('adminChildedit.php?page=<?=$page?>&mode=delete&num=<?=$c_num?>')">삭제</a></td>
			<td align="center"><?=$c_num?></td>
			<td align="center" title="<?=$c_etc?>"><?=$c_name?>(<?=$c_sex?>)</td>  
			<td align="center"><?=$c_name2?></td> 
			<td align="center"><?=$c_birth?></td> 
			<td align="center"><?=$c_fname?></td> 
			<td align="center"><?=$c_fsosok?></td>
			<td align="center"><?=$c_fphone?></td>
			<td align="center"><?=$c_femail?></td>
			<td align="center"><?=$c_fbapti?></td>
			<td align="center"><?=$c_fnewm?></td> 
			<td align="center"><?=$c_mname?></td> 
			<td align="center"><?=$c_msosok?></td>
			<td align="center"><?=$c_mphone?></td>
			<td align="center"><?=$c_memail?></td>
			<td align="center"><?=$c_mbapti?></td>
			<td align="center"><?=$c_mnewm?></td> 
			<td align="center"><?=$c_date?></td>
	</tr>

<?		
		
	}
}


?>	
	
	
	
	
</table>
</form>
<table width="100%">
	<tr>
		<td height="50" width="150">
		<input type="button" value="일괄삭제" class="button" onClick="member_del();">&nbsp;
		</td>
		<td align="center"><?=rg_navi_display($page_info,$_get_param[2]."&order=".$porder); ?></td>
	</tr>
</table>


</div>
 <!-- End Right Column -->
 </div>
<div class="float_null" style="clear:both;"></div>
 <!-- Begin Footer -->
	<div id="footer">Copyleft ⓒ 2016 삼일교회. All rights not reserved.</div>
 <!-- End Footer -->
 
</div>

<!-- End Wrapper -->
</body></html>