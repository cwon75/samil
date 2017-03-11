<? 
header ("Expires: Mon, 26 Jul 2001 12:00:00 GMT");     
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("cache-control: no-cache,must-revalidate"); 
header("pragma: no-cache") ; 


$now1 = date("Ymd");

$openDay="20170310";



if($now1 >= $openDay){


function is_mobile(){
    return preg_match('/phone|samsung|lgtel|mobile|[^A]skt|nokia|blackberry|android|sony/i', $_SERVER['HTTP_USER_AGENT']);
}

$mobile_br="";   
if (is_mobile()){
	 $is_mobile = "mobile";
	 $mobile_br = "<BR>";
}

include_once("../samil_include/lib.php");

/*
$rs_list->clear();
$rs_list->set_table($_table['samilchildbapti']);
$rs_list->add_where("c_code='5050'");
$rs_list->select();

if($rs_list->num_rows() > 110) {
	echo "<script> alert('신청접수(100명)가 마감되었습니다.'); self.close();</script>";
	exit;
}
*/


$spam_chk_img.="<img src='../samil_include/kcaptcha.php?nocache=".time()."' onClick=\"this.src=this.src + '?nocache=' + Math.random()*999999999\" align='absmiddle' style='cursor:pointer'>";

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

	function ext1Check(obj){
		var jsons = {
				c_code : obj
			};
			$.ajax({
				type: 'POST',
				url: "orthoAjax.php",
				dataType: 'json',
				data: jsons, 
				cache: false,
				contentType: 'application/x-www-form-urlencoded;charset='+'UTF-8',
				success: function(json) {

					var code  = json[1].code;

					if(code =="1NON"){
						alert("베드로전후서와 설교는 마감되었습니다.");
						$("#c_ext1").val("").attr("selected", "selected");
					} else if(code =="2NON"){
						alert("인문학적 해석과 설교는 마감되었습니다.");
						$("#c_ext1").val("").attr("selected", "selected");

					}
					//alert(code);
					//document.location.reload();
						
				}, error: function(request, status, error){
					alert("Error..!!");
					return ;
				}
			});
	}

	function eventProc(){

		if(document.member_form.c_ext1.value == ""){
			alert("과정선택해주세요.");
			document.member_form.c_ext1.focus();
			return;
		}
		if(document.member_form.c_name.value == ""){
			alert("성명을 입력해주세요.");
			document.member_form.c_name.value = "";
			document.member_form.c_name.focus();
			return;
		}
		if(document.member_form.c_sex.value == ""){
			alert("성별을 선택해주세요.");
			document.member_form.c_sex.value = "";
			document.member_form.c_sex.focus();
			return;
		}
		if(document.member_form.c_birth.value == ""){
			alert("출생년도를 입력해주세요.");
			document.member_form.c_birth.value = "";
			document.member_form.c_birth.focus();
			return;
		}
		if(document.member_form.c_fphone2.value == ""){
			alert("연락처를 입력해주세요.");
			document.member_form.c_fphone2.value = "";
			document.member_form.c_fphone2.focus();
			return;
		}
		if(document.member_form.c_fphone3.value == ""){
			alert("연락처를 입력해주세요.");
			document.member_form.c_fphone3.value = "";
			document.member_form.c_fphone3.focus();
			return;
		}
		if(document.member_form.c_femail.value == ""){
			alert("이메일을 입력해주세요.");
			document.member_form.c_femail.focus();
			return;
		}
		if(document.member_form.c_mname.value == ""){
			alert("시무교회명을 입력해주세요.");
			document.member_form.c_mname.focus();
			return;
		}
		if(document.member_form.c_fsosok.value == ""){
			alert("직분을 선택해주세요.");
			document.member_form.c_fsosok.focus();
			return;
		}
		if(document.member_form.c_ext2.value == ""){
			alert("안수년도를 입력해주세요.");
			document.member_form.c_ext2.focus();
			return;
		}
		if(document.member_form.c_ext3.value == ""){
			alert("교단을 입력해주세요.");
			document.member_form.c_ext3.focus();
			return;
		}
		if(document.member_form.c_ext4.value == ""){
			alert("최종졸업 신학교를 입력해주세요.");
			document.member_form.c_ext4.focus();
			return;
		}
		if(document.member_form.c_ext5.value == ""){
			alert("오르도토메오아카데미 임하는 자세를 선택해 주세요.");
			document.member_form.c_ext5.focus();
			return;
		}
		if(document.member_form.c_pass.value == ""){
			alert("확인용 암호를 입력해 주세요.");
			document.member_form.c_pass.value = "";
			document.member_form.c_pass.focus();
			return;
		}
		if(document.member_form.spam_chk.value == ""){
			alert("좌측 문자를 입력해 주세요.");
			document.member_form.spam_chk.value = "";
			document.member_form.spam_chk.focus();
			return;
		}
	
		if(document.getElementById("agree").checked == false){
			alert("개인정보 수집에 동의 하셔야 합니다.");
			
			return false;
		}
		if(document.getElementById("notAgree").checked == true){
			alert("개인정보 수집에 동의 하셔야 합니다.");
			return false;
		}    
		if(document.getElementById("agree2").checked == false){
			alert("환불규정을 동의 하셔야 합니다.");
			
			return false;
		}
		if(document.getElementById("notAgree2").checked == true){
			alert("환불규정을 동의 하셔야 합니다.");
			return false;
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
			<a href="http://ortho.samilchurch.com/samil_ortho/orthoIden.php" target="_self">신청확인</a>
		</div>
	</header>

	<section class="cont">
		<h1 class="title">오르도토메오 아카데미 신청</h1>

		<section class="explan">
			<ul>

<li><h3>[오르도토메오 아카데미 신청안내]<h3></li>
<BR>
<li>등록인원의 제한에 따라 대기자가 발생할 수 있습니다.</li>
<li>순번에 따라 입금계좌 및 자세한 사항을 문자로 안내드리겠습니다.</li>


			</ul>
		</section>

<form name="member_form" id="member_form" method="post" action="orthoProc.php" onSubmit="return goSubmit()" enctype="multipart/form-data">
<input type="hidden" name="mode" value="join" />
<input type="hidden" name="num" value="" />
<input type="hidden" name="mobile" value="<?=$is_mobile?>" />

		<section class="input_wrap">
			<h2>신청자정보</h2>
			<table>
				<colgroup>
					<col width="25%">
					<col width="75%">
				</colgroup>
				<tbody>

				<tr>
					<th scope="col">과정선택(필수)</th>
					<td class="name">

						<select id="c_ext1" name="c_ext1" onChange="javascript:ext1Check(this.value);">
							<option value="">선택</option>
							<option value="1">베드로전후서와 설교</option>
							<option value="2">인문학적 해석과 설교</option>
						</select>
					</td>
				</tr>
				
				
				<tr>
					<th scope="col">성명</th>
					<td>
						<input type="text" name="c_name" value="" placeholder="홍길동" required hname="성명">
						<input type="radio" name="c_sex" value="남" required hname="성별"> 남</label> &nbsp;
						<label><input type="radio" name="c_sex" value="여" required hname="성별"> 여</label>
					</td>
				</tr>
				<tr>
					<th scope="col">출생년도</th>
					<td class="belong">
						<input type="number" name="c_birth" max="9999" maxlength="4" oninput="maxLengthCheck(this)" value="" placeholder="1970" required hname="출생년도">
					</td>
				</tr>
				<tr>
					<th scope="col">연락처</th>
					<td class="phone">
						<select name="c_fphone" required hname="연락처">
							<option value="010">010</option>
							<option value="011">011</option>
							<option value="016">016</option>
							<option value="017">017</option>
							<option value="018">018</option>
							<option value="019">019</option>
						</select>
						<input type="number" name="c_fphone2" max="9999" maxlength="4" oninput="maxLengthCheck(this)" required hname="연락처">
						<input type="number" name="c_fphone3" max="9999" maxlength="4" oninput="maxLengthCheck(this)" required hname="연락처">
					</td>
				</tr>
				<tr>
					<th scope="col">이메일</th>
					<td class="name">
						<input type="text" name="c_femail" value="" placeholder="email@email.com" required hname="email@email.com">
					</td>
				</tr>
				<tr>
					<th scope="col">시무교회명</th>
					<td class="belong">
						<input type="text" name="c_mname" value="" placeholder="시무교회명" required hname="시무교회명">
					</td>
				</tr>
				<tr>
					<th scope="col">직분</th>
					<td class="phone2">
						<select name="c_fsosok" required hname="직분">
							<option value="">선택</option>
							<option value="담임목사">담임목사</option>
							<option value="부목사">부목사</option>
							<option value="강도사">강도사</option>
							<option value="전도사">전도사</option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="col">안수년도(여교역자의 경우 졸업연도)</th>
					<td class="belong">
						<input type="number" name="c_ext2" max="9999" maxlength="4" oninput="maxLengthCheck(this)" value="" placeholder="2007" required hname="">
					</td>
				</tr>
				<tr>
					<th scope="col">교단</th>
					<td class="belong">
						<input type="text" name="c_ext3" value="" placeholder="장로교" required hname="장로교">
					</td>
				</tr>
				<tr>
					<th scope="col">최종졸업 신학교(학위)</th>
					<td class="belong">
						<input type="text" name="c_ext4" value="" placeholder="총신대학교(M.Div)" required hname="총신대학교(M.Div)">
					</td>
				</tr>
				<tr>
					<td colspan="2"><b>오르도토메오 아카데미에 성실하게 임할 것을 약속합니다.</b>&nbsp;&nbsp;&nbsp;&nbsp;
						<label><input type="radio" name="c_ext5" value="예" required hname="예"> 예</label>
						<label><input type="radio" name="c_ext5" value="아니요" required hname="아니오"> 아니요</label>
					</th>
				</tr>

				</tbody>
			</table>


			
			<table>
				<caption>기타 확인 정보</caption>
				<colgroup>
					<col width="25%">
					<col width="75%">
				</colgroup>
				<tbody>
				<tr>
					<th scope="col">확인용암호</th>
					<td class="belong">
						<input type="password" name="c_pass" class="input" maxlength="4" required hname="암호">
					</td>
				</tr>
				<tr>
					<th scope="col">스팸방지</th>
					<td>
						<div class="spam_wrap">
							<div class="spam_img">
							<?=$spam_chk_img?>
							</div>
							<div class="spam_input">
								 좌측의 문자를 입력해주세요.<br>
								 <input name="spam_chk" type="text" class="input" size="10" required hname="스팸방지코드">
							</div>
						</div>						
					</td>
				</tr>
				</tbody>
			</table>
			<div class="agree_wrap">
				<h2>개인정보 수집 및 활용 동의 안내</h2>
				<div class="agree">
					삼일교회 귀하<br>
					본인은 교회가 본인 및 기타 적합한 경로를 통해 수집한 본인 및 가족의 개인정보를 활용하는데 동의 합니다.<br>
					수집하는 개인정보의 항목<br>
					1.필수사항 : 성명, 휴대폰 번호, 이메일<br>
					개인정보 수집 -이용목적 : 수강생 선발 및 과정 운영, 향후 안내사항 발송 등<br>
					개인정보 보유 -이용기간 : 오르도토메오 종료1년 보관후 파기<br>
				</div>
				<div class="info">
					귀하께서는 본 동의 안내 문구를 숙지하셨으며, 안내문구에 대해 거절하실 수 있습니다.<br>
					단, 거절하신 경우에는 오르도토메오 아카데미 신청이 제한되실 수 있습니다.
					<p>
						<label for="radio0601"><input type="radio" id="agree" name="privacy" value="1"> 개인정보 수집 및 활용에 동의함</label>
						<label for="radio0602"><input type="radio" id="notAgree" name="privacy" value="2"> 동의하지 않음</label>
					</p>
				</div>
				
				<h2>환불규정 안내</h2>
				<div class="agree">
					-3월 28일 이전 취소 : 100% 환급<br>
					-3월 31일 이전 취소 : 50% 환급<br>
					-4월&nbsp;&nbsp;&nbsp;2일 이전 취소 : 20% 환급<br>
					-수업 시작일 이후 : 환급불가<br>
				</div>
				<div class="info">
					귀하께서는 본 동의 안내 문구를 숙지하셨으며, 안내문구에 대해 거절하실 수 있습니다.<br>
					단, 거절하신 경우에는 오르도토메오 아카데미 신청이 제한되실 수 있습니다.
					<p>
						<label for="radio0601"><input type="radio" id="agree2" name="refund" value="1"> 환불규정에 동의함</label>
						<label for="radio0602"><input type="radio" id="notAgree2" name="refund" value="2"> 동의하지 않음</label>
					</p>
				</div>

				<div class="button_area">
					<a href="#" onclick="javascript:eventProc();">등록</a>
					<a href="http://samilchurch.com" target="_self">나가기</a>
				</div>
			</div>
		</section>
	</form>
	</section>
</div>
<footer class="footer">2017삼일교회. All rights not reserved.</footer>
</body>
</html>

<? } else { ?>

<script language="javascript">
alert('아직은 모집기간이 아닙니다..!');
opener = self;
window.close();
</script> 

<? } ?>
