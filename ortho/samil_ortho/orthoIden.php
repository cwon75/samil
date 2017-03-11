<? 
header ("Expires: Mon, 26 Jul 2001 12:00:00 GMT");     
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("Progma:no-cache") ; 
header("Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0");
?>
<?
include_once("../samil_include/lib.php");


$c_name   = $_POST['c_name'];
$c_femail  = $_POST['c_femail'];
$c_pass   = $_POST['c_pass'];

$rs_list->clear();
$rs_list->set_table($_table['samilchildbapti']);
$rs_list->add_where("c_code='5050' AND c_name='$c_name' AND c_femail='$c_femail' AND c_pass='$c_pass'");
$rs_list->select();

if($c_name != null && $rs_list->num_rows()==0) echo "<script>alert('내용을 잘못 입력하셨거나. 신정내역에 없습니다.');</script>";

$result_data ="";
if($rs_list->num_rows()>0) $result_data ="ok";


?>
<!DOCTYPE html>
<html lang="ko">
<head>
<title>삼일교회2016 : 성령에 이끌리는 교회 - 오르도토메오 신청페이지</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="Content-Script-Type" content="text/javascript"/>
<meta http-equiv="Content-Style-Type" content="text/css"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<meta name="robots" content="noindex, nofollow, noarchive"/>
<meta name="googlebot" content="noindex, nofollow, noarchive"/>

<link href="css/style.css" rel="stylesheet">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"  ></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
	});


	function eventProc(){
	
		if(document.member_form.c_name.value == ""){
			alert("성명을 입력해 주세요.");
			document.member_form.c_name.value = "";
			document.member_form.c_name.focus();
			return;
		}
		if(document.member_form.c_femail.value == ""){
			alert("이메일을 입력해 주세요.");
			document.member_form.c_femail.value = "";
			document.member_form.c_femail.focus();
			return;
		}
		if(document.member_form.c_pass.value == ""){
			alert("확인용 암호를 입력해 주세요.");
			document.member_form.c_pass.value = "";
			document.member_form.c_pass.focus();
			return;
		}

	    document.member_form.submit();
	}

	//maxlength 체크
	function maxLengthCheck(object){
		if (object.value.length > object.maxLength){
			object.value = object.value.slice(0, object.maxLength);
		}    
	}


</script>

</head>

<body>
<div class="wrap">
	<header class="header_wrap">
		<div class="header">
			<h1 class="logo">삼일교회 : 성령에 이끌리는 교회</h1>
			<a href="http://ortho.samilchurch.com/samil_ortho/orthoEdit.php" target="_self">신청하기</a>
		</div>
	</header>

	<section class="cont">
		<h1 class="title">오르도토메오 아카데미 신청</h1>

		<section class="explan">
			<ul>

<li><h3>[오르도토메오 아카데미 신청안내]<h3></li>
<BR>
<li>오르도토메오 아카데미에 신청해 주셔서 감사합니다.</li>
<li>등록인원의 제한에 따라 대기자가 발생할 수 있습니다.</li>
<li>순번에 따라 입금계좌 및 자세한 사항을 문자로 안내드리겠습니다.</li>
			</ul>
		</section>


<form name="member_form" id="member_form" method="post" action="orthoIden.php" onSubmit="return goSubmit()" enctype="multipart/form-data">
<input type="hidden" name="mode" value="join" />
<input type="hidden" name="num" value="" />

<? if($result_data != "ok") { ?>




		<section class="input_wrap">
			<h2>신청확인</h2>
			<table>
				<colgroup>
					<col width="25%">
					<col width="75%">
				</colgroup>
				<tbody>
				<tr>
					<th scope="col">성명</th>
					<td class="name">
						<input type="text" name="c_name" value="" placeholder="홍길동" required hname="성명">
					</td>
				</tr>
				<tr>
					<th scope="col">이메일주소</th>
					<td class="name">
						<input type="text" name="c_femail" value="" placeholder="email@email.com" required hname="email@email.com">
					</td>
				</tr>
				<tr>
					<th scope="col">확인용암호</th>
					<td class="phone">
						<input name="c_pass" type="password" maxlength="4" class="input" size="8" required hname="암호" >
					</td>
				</tr>
				</tbody>
			</table>
				
				<div class="button_area">
					<a href="#" onclick="javascript:eventProc();">조회</a>
					<a href="http://samilchurch.com" target="_self">나가기</a>
				</div>
			</div>

<? }else if($result_data == "ok") { ?>

		<section class="input_wrap">
			<h2>신청자정보</h2>
			<table>
				<colgroup>
					<col width="20%">
					<col width="20%">
					<col width="20%">
					<col width="20%">
				</colgroup>
				<tbody>
<?
	while($R=$rs_list->fetch()) {
		$c_num   = $R['c_num'];
		$c_name   = $R['c_name'];
		$c_sex   = $R['c_sex'];
		$c_birth  = $R['c_birth'];
		$c_mname  = $R['c_mname'];
		$c_fsosok = $R['c_fsosok'];
		$c_fphone = $R['c_fphone'];
		$c_ext1  = $R['c_ext1'];
		$c_ext2  = $R['c_ext2'];
		$c_ext3  = $R['c_ext3'];
		$c_ext4  = $R['c_ext4'];
		$c_ext5  = $R['c_ext5'];
		$c_ext6  = $R['c_ext6'];
		$c_ext7  = $R['c_ext7'];
		$c_etc    = $R['c_etc'];
?>		

				<tr>
					<th scope="col"><center>신청번호</center></th>
					<th scope="col"><center>이름(성별)</center></th>
					<th scope="col"><center>직분</center></th>
					<th scope="col"><center>출생년도</center></th>
				</tr>
				<tr>
					<td align="center"><?=$c_num?></td>
					<td align="center"><?=$c_name?>(<?=$c_sex?>)</td>			
					<td align="center"><?=$c_fsosok?></td>
					<td align="center"><?=$c_birth?></td> 
				</tr>
				<tr>
					<th scope="col"><center>연락처</center></th>
					<th scope="col"><center>시무교회명</center></th>
					<th scope="col"><center>안수년도</center></th>
					<th scope="col"><center>신청구분</center></th>		
				</tr>
				<tr>
					<td align="center"><?=$c_fphone?></td> 
					<td align="center"><?=$c_mname?></td> 
					<td align="center"><?=$c_ext2?></td>
					<td align="center"><? if($c_ext1==1) { echo "베드로전후서와설교";  }else if($c_ext1==2){ echo "인문학적해석과설교"; }?></td>			
				</tr>
<?	} ?>	
	


				</tbody>
			</table>
				
				<div class="button_area">
					<a href="http://samilchurch.com" target="_self">나가기</a>
				</div>
			</div>
<? } ?>

		</section>
	</form>

	</section>



</div>
<footer class="footer">2017삼일교회. All rights not reserved.</footer>
</body>
</html>
